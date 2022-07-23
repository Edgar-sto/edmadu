 <?php
	include_once '../class/conexion.php';
	include_once '../class/sucursalesExternas.php';
	include_once '../class/ConsumoPorCarrier.php';
	include_once '../class/ReporteTelefoniaMensual.php';
	include_once '../class/ObtenerSucursal.php';
	include_once '../class/SucursalesInternas.php';
	include_once '../class/SucursalesExternas.php';


	$conexion = conexion_local("telefonia", "10.9.2.234");
	$carrier = $_POST['carrier'];
	$fecha_inicio = $_POST['fecha_inicio'];
	$fecha_termino = $_POST['fecha_termino'];


	$docuname = "TELEFONIA.xls";
	header('Content-type: application/vnd.ms-excel');
	header('Content-Disposition: attachment; filename=' . $docuname);
	header('Pragma: no-cache');
	header('Expires: 0');

	//DEFINIR PREFIJOS A USAR
	if ($carrier == 'marcatel') {
		$prefijos_individuales = array("15", "777");
		$prefijos_junto = "15','777";
	} else if ($carrier == 'mcm') {
		$prefijos_individuales = array("11", "999");
		$prefijos_junto = "11','999";
	} else if ($carrier == "ipcom") {
		$prefijos_individuales = array("28", "444");
		$prefijos_junto = "28','444";
	} else if ($carrier == "hazz") {
		$prefijos_individuales = array("14", "555");
		$prefijos_junto = "14','555";
	} else {
		$prefijos_individuales = array("15", "777", "11", "999", "28", "444", "14", "555");
		$prefijos_juntos_minutos = array("15','777','11','999','28','444");
		$prefijos_juntos_segundos = array("14','555");
	}

	?>
	<table class="table table-sm" style="font-size: 0.6em;">
		<thead class="text-center align-middle">:w

			<tr class="">
				<th scope="col" colspan="3">
					<h4 class="uppercasse"><?php echo $carrier ?></h4>
				</th>
			</tr>
			<tr>
				<th scope="col">Tipo</th>
				<th scope="col">Minutos</th>
				<th scope="col">Pesos</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$desgloseGeneral = new ConsumoPorCarrier($conexion, $fecha_inicio, $fecha_termino, $prefijos_junto);
				$desgloseGeneral->consumoDividido();
				?>
		</tbody>
	</table>

 		<?php
			$consulta = "SELECT DISTINCT reporte FROM reporte_telefonia
            WHERE fecha_inicio>='{$fecha_inicio} 00:00:00' and fecha_termino<='{$fecha_termino} 23:59:59'
            AND prefijo IN ('{$prefijos_junto}') ORDER BY reporte";
			$resultado = $conexion->query($consulta);
			while ($row = $resultado->fetch_object()) {
				/**REPORTE */
				$row->reporte;
			?>
 				<table class="table table-hover" style="font-size: 11px;">
 					<thead>
 						<tr>
 							<th colspan="7" class="text-center h4 table-light"><?php echo $row->reporte; ?></th>
 						</tr>
 						<tr>
 							<th scope="col">ID.Campaña</th>
 							<th scope="col">Prefijos</th>
 							<th scope="col">Sucursal</th>
 							<th scope="col">Grupo</th>
 							<th scope="col">Evento</th>
 							<th scope="col">Consumo Movil</th>
 							<th scope="col">Consumo Fijo</th>
 						</tr>
 					</thead>
 					<tbody class="text-right">
 						<tr>
 							<td colspan="7"></td>
 						</tr>
 						<?php
							foreach ($prefijos_individuales as $prefijo) {

								$query_campania = "SELECT DISTINCT campania FROM reporte_telefonia
				WHERE fecha_inicio>='{$fecha_inicio} 00:00:00' and fecha_termino<='{$fecha_termino} 23:59:59'
				AND reporte='{$row->reporte}' AND prefijo IN ('{$prefijo}')";

								$resultado_campania = $conexion->query($query_campania);
								while ($row_camp = $resultado_campania->fetch_object()) {
									$row_camp->campania;

									$query_grupos = "SELECT DISTINCT grupo FROM reporte_telefonia
					WHERE fecha_inicio>='{$fecha_inicio} 00:00:00' and fecha_termino<='{$fecha_termino} 23:59:59'
					AND prefijo IN ('{$prefijo}') AND reporte='{$row->reporte}' AND campania='{$row_camp->campania}'";

									$resultado_grupos = $conexion->query($query_grupos);
									while ($row_grupo = $resultado_grupos->fetch_object()) {
										$row_grupo->grupo;
										$nombre_grupo = $row_grupo->grupo;

										$query_movil_fijo = "SELECT
						(SELECT SUM(consumo) FROM reporte_telefonia
						WHERE fecha_inicio>='{$fecha_inicio} 00:00:00' and fecha_termino<='{$fecha_termino} 23:59:59'
						AND tipo='movil' AND reporte='{$row->reporte}' AND prefijo IN ('{$prefijo}') AND campania='{$row_camp->campania}'
						AND grupo='{$row_grupo->grupo}') AS movil,
						(SELECT SUM(consumo) FROM reporte_telefonia
						WHERE fecha_inicio>='{$fecha_inicio} 00:00:00' and fecha_termino<='{$fecha_termino} 23:59:59'
						AND tipo='fijo' AND reporte='{$row->reporte}' AND prefijo IN ('{$prefijo}') AND campania='{$row_camp->campania}'
						AND grupo='{$row_grupo->grupo}') AS fijo;";

										$resultado_mf = $conexion->query($query_movil_fijo);
										$array_mf = array();
										while ($row_mf = $resultado_mf->fetch_object()) {
											$row_mf->movil;
											$row_mf->fijo;

											if ($row_grupo->grupo == 'N/A') {
											} else {
							?>
 											<tr>
 												<td><?php echo $row_camp->campania; ?></td>
 												<td><?php echo $prefijo; ?></td>


 												<td>
 													<?php
														$group = new sucursal($conexion, $nombre_grupo);
														$group->obtSucursal();
														foreach ($group->obtSucursal() as $sucursalValue) {
															echo $sucursalValue . " ";
														}
														?>
 												</td>



 												<td><?php echo $row_grupo->grupo; ?></td>
 												<td></td>

 												<td><?php echo $row_mf->movil; ?> </td>
 												<td><?php echo $row_mf->fijo; ?> </td>
 											</tr>
 									<?php
											}
										}
										/**CIERRE WHILE OBTENER CONSUMO FIJO-MOVIL */
									}
									/**CIERRE WHILE OBTENER GRUPOS */
									$query_dmovil_dfijo = "SELECT 
						(SELECT SUM(consumo) FROM reporte_telefonia
						WHERE fecha_inicio>='{$fecha_inicio} 00:00:00' and fecha_termino<='{$fecha_termino} 23:59:59'
						AND tipo='drop_movil' AND reporte='{$row->reporte}' AND prefijo IN ('{$prefijo}') AND campania='{$row_camp->campania}'
						AND grupo='N/A') AS drop_movil,
						(SELECT SUM(consumo) FROM reporte_telefonia
						WHERE fecha_inicio>='{$fecha_inicio} 00:00:00' and fecha_termino<='{$fecha_termino} 23:59:59'
						AND tipo='drop_fijo' AND reporte='{$row->reporte}' AND prefijo IN ('{$prefijo}') AND campania='{$row_camp->campania}'
						AND grupo='N/A') AS drop_fijo;";

									$resultado_DropMF = $conexion->query($query_dmovil_dfijo);
									while ($row_drop = $resultado_DropMF->fetch_object()) {
										$row_drop->drop_movil;
										$row_drop->drop_fijo;
										?>
 									<tr class="">
 										<td><?php echo $row_camp->campania; ?></td>
 										<td><?php echo $prefijo; ?></td>
 										<td></td>
 										<td>DROP</td>
 										<td></td>
 										<td><?php echo $row_drop->drop_movil; ?></td>
 										<td><?php echo $row_drop->drop_fijo; ?></td>
 									</tr>
 								<?php
									}
									$query_Bmovil_bfijo = "SELECT 
						(SELECT SUM(consumo) FROM reporte_telefonia
						WHERE fecha_inicio>='{$fecha_inicio} 00:00:00' and fecha_termino<='{$fecha_termino} 23:59:59'
						AND tipo='buzon_movil' AND reporte='{$row->reporte}' AND prefijo IN ('{$prefijo}') AND campania='{$row_camp->campania}'
						AND grupo='N/A') AS buzon_movil,
						(SELECT SUM(consumo) FROM reporte_telefonia
						WHERE fecha_inicio>='{$fecha_inicio} 00:00:00' and fecha_termino<='{$fecha_termino} 23:59:59'
						AND tipo='buzon_fijo' AND reporte='{$row->reporte}' AND prefijo IN ('{$prefijo}') AND campania='{$row_camp->campania}'
						AND grupo='N/A') AS buzon_fijo;";

									$resultado_buzonMF = $conexion->query($query_Bmovil_bfijo);
									while ($row_buzon = $resultado_buzonMF->fetch_object()) {
										$row_buzon->buzon_movil;
										$row_buzon->buzon_fijo;
									?>
 									<tr>
 										<td><?php echo $row_camp->campania; ?></td>
 										<td><?php echo $prefijo; ?></td>
 										<td></td>
 										<td>BUZON</td>
 										<td></td>
 										<td><?php echo $row_buzon->buzon_movil; ?> </td>
 										<td><?php echo $row_buzon->buzon_fijo; ?> </td>
 									</tr>
 								<?php
									}
									/**CIERRE WHILE BUZON */
									?>
 								<tr>
 									<td><?php echo $row_camp->campania; ?></td>
 									<td><?php echo $prefijo; ?></td>
 									<td></td>
 									<td>CAMPAÑA0</td>
 									<td></td>
 									<td>0</td>
 									<td>0</td>
 								</tr>
 						<?php
								}
							}
							?>
 					</tbody>
 				</table>
 		<?php
			}
			?>


 <div class="row">
 	<div class="col-lg-6 col-lg-12 table-responsive" id=" ">
 		<h4>Sucursales Internas</h4>
 		<!--ESCORZA - REVOLUCION -->
 		<div class="row">
 			<!-- ESCORZA -->
 			<div class="col-lg-6 table-responsive" id=" ">
 				<h4>Escorza</h4>
 				<hr>
 				<?php
					$consumo_escorza = new SucursalesInternas($conexion, $fecha_inicio, $fecha_termino, $carrier, $prefijos_junto);
					$consumo_escorza->consumoEscorza();
					?>
 			</div>
 			<!--REVOLUCION -->
 			<div class="col-lg-6 table-responsive" id=" ">
 				<h4>Revolución</h4>
 				<hr>
 				<?php
					$consumo_revolucion = new SucursalesInternas($conexion, $fecha_inicio, $fecha_termino, $carrier, $prefijos_junto);
					$consumo_revolucion->consumoRevolucion();
					?>
 			</div>
 		</div>
 		<br>
 		<!--TLAJOMULCO - DROP BUZON - ADMINISTRATIVO -->
 		<div class="row">
 			<!--TLAJOMULCO -->
 			<div class="col-lg-6 table-responsive" id=" ">
 				<h4>Tlajomulco</h4>
 				<hr>
 				<?php
					$consumo_tlajomulco = new SucursalesInternas($conexion, $fecha_inicio, $fecha_termino, $carrier, $prefijos_junto);
					$consumo_tlajomulco->consumoTlajomulco();
					?>
 			</div>
 			<!--DROP BUZON - ADMINISTRATIVO -->
 			<div class="col-lg-6 table-responsive" id=" ">
 				<div class="row">
 					<!--DROP BUZON-->
 					<div class="col-lg-12 table-responsive" id=" ">
 						<h4>Drop - Buzón</h4>
 						<hr>
 						<?php
							$consumo_drop_buzon = new SucursalesInternas($conexion, $fecha_inicio, $fecha_termino, $carrier, $prefijos_junto);
							$consumo_drop_buzon->consumoDropBuzon();
							?>
 					</div>
 					<br>
 					<br>
 					<!--ADMINISTRATIVO-->
 					<div class="col-lg-12 table-responsive" id=" ">
 						<h4>Administrativo</h4>
 						<hr>
 						<?php
							$consumo_admin = new SucursalesInternas($conexion, $fecha_inicio, $fecha_termino, $carrier, $prefijos_junto);
							$consumo_admin->consumoAdministrativo();
							?>
 					</div>
 				</div>
 			</div>
 		</div>
 	</div>
 </div>