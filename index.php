<?php
require_once 'views/parte_superior.php';
require_once 'class/prefijos.php';
require_once 'class/conexion.php';
require_once 'class/fecha2022.php';
require_once 'class/FechaReportes.php';
require_once 'class/ConsumoPorCarrier.php';
require_once 'class/SucursalesInternas.php';
require_once 'class/SucursalesExternas.php';
require_once 'class/ConsumoPorDia.php';
$conexion = conexion_local('telefonia', '10.9.2.234');
$conexion_21 = conexion_21('telefonia', '10.9.2.21');
?> 
<!-- Start content-wrapper-->
<div class="content-wrapper">
	<div class="container-fluid">
		<!-- START Fila N -->
		<!-- CALENDARIO  -->
		<div class="card mt-1 mb-1">
			<div class="card-content">
				<div class="row row-group m-0">
					<?php

					foreach ($meses as $mes) {

					?>
						<div class="col col-sm text-center">
							<a class="bg-active text-capitalize" data-toggle="collapse" href="#<?php echo $mes; ?>" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">
								<?php echo $mes; ?>
								<!-- <small class="badge float-right badge-light">Edgar</small> -->
							</a>
						</div>
						<br>
					<?php
					}

					foreach ($anno2022 as $mese => $d) {
					?>
						<div class="collapse multi-collapse" id="<?php echo $mese; ?>">
							<div class="card card-body">
								<div class="table-responsive">
									<h5 class="card-title text-capitalize"><?php echo $mese; ?></h5>
									<p class="card-text">
										<?php foreach ($d as $dia) { ?>
											<a href="#" class="link-light" onclick="miAlerta('2022-<?php echo $mese; ?>-<?php echo $dia; ?>')"><?php echo $dia; ?></a>
										<?php } ?>
									</p>
								</div>
							</div>
							<script>
								function miAlerta(fecha) {
									//event.preventDefault();
									alert("Día" + fecha);
								}
							</script>
						</div>
					<?php
					}
					?>
				</div>
			</div>
		</div>
		<!-- FORMULARIO  -->
		<div class="card mt-1">
			<form id="form_index" method="POST">
				<table id="tbl_telefonia_index" class="table">
					<tbody class="text-center form-group">
						<tr>
							<td>
								<div class="form-group">
									<label for="input-1">Fecha inicio</label>
									<input id="fecha_inicio" name="fecha_inicio" type="date" class="form-control">
								</div>
							</td>
							<td>
								<div class="form-group">
									<label for="input-1">Fecha termino</label>
									<input id="fecha_termino" name="fecha_termino" type="date" class="form-control">
								</div>
							</td>
							<td>
								<div class="form-group">
									<label for="input-1">Acción</label><br>
									<input id="btn_consumo_index" name="btn_consumo_index" type="button" class="btn btn-light" value="Buscar">
								</div>
							</td>
						</tr>
					</tbody>
				</table>
			</form>
		</div>
		<!-- END Fila N -->

		<!--Start Dashboard Content-->
		<!-- FILA UNO DISTRIBUCION DE CONSUMO POR CARRIER MINUTOS-->
		<div class="card mt-3">
			<div class="card-content">
				<div id="fila-uno-consumo-dividido-carrier" class="row row-group m-0 p-4">
					<!--
						Área de impresión de resultados por Formulario
					-->
					<!-- MARCATEL -->
					<div class="col-12 col-lg-6 col-sm-3 table-responsive xy-hiden">
						<!-- <div class="card-body text-center"> -->
						<table class="table table-sm" style="font-size: 0.6em;">
							<thead class="text-center align-middle">
								<tr class="">
									<th scope="col" colspan="3">
										<h4>Marcatel</h4>
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
								$consumo_marcatel = new ConsumoPorCarrier($conexion, $date, $date, prefijos_marcatel);
								$consumo_marcatel->consumoDividido();
								?>
							</tbody>
						</table>
						<!-- </div> -->
					</div>
					<!-- MCM -->
					<div class="col-12 col-lg-6 col-sm-3 table-responsive xy-hiden">
						<!-- <div class="card-body"> -->
						<table class="table table-sm" style="font-size: 0.6em;">
							<thead class="text-center align-middle">
								<tr class="">
									<th scope="col" colspan="3">
										<h4>MCM</h4>
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
								$consumo_marcatel = new ConsumoPorCarrier($conexion, $date, $date, prefijos_mcm);
								$consumo_marcatel->consumoDividido();
								?>
							</tbody>
						</table>
						<!-- </div> -->
					</div>
					<!-- IPCOM -->
					<div class="col-12 col-lg-6 col-sm-3 table-responsive xy-hiden">
						<!-- <div class="card-body"> -->
						<table class="table table-sm" style="font-size: 0.6em;">
							<thead class="text-center align-middle">
								<tr class="">
									<th scope="col" colspan="3">
										<h4>Ipcom</h4>
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
								$consumo_marcatel = new ConsumoPorCarrier($conexion, $date, $date, prefijos_ipcom);
								$consumo_marcatel->consumoDividido();
								?>
							</tbody>
						</table>
						<!-- </div> -->
					</div>
					<!-- HAZ -->
					<div class="col-12 col-lg-6 col-sm-3 table-responsive xy-hiden">
						<!-- <div class="card-body"> -->
						<table class="table table-sm" style="font-size: 0.6em;">
							<thead class="text-center align-middle">
								<tr class="">
									<th scope="col" colspan="3">
										<h4>Haz</h4>
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
								$consumo_marcatel = new ConsumoPorCarrier($conexion, $date, $date, prefijos_haz);
								$consumo_marcatel->consumoDividido();
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

		<!-- FILA DOS "Consumo por vici" - "Porcentaje del dia anterior por carrier" - "Costo movil fijo por carrier"-->
		<div class="row">
			<!-- <div class="col-lg-4 col-xl-4 col-12 "> -->
			<!--Distribucion de consumo por Reporte -->
			<div class="col-lg-6 col-lg-4 col-12 ">
				<section class="card" style="height: 420px;">
					<div class="card-header">Consumo por vici
						<header>
							<ul class="nav nav-tabs">
								<li class="nav-item col col-sm active">
									<a class="nav-link " href="#reporte_mtel" data-toggle="tab">Mtel</a>
								</li>
								<li class="nav-item col col-sm">
									<a class="nav-link " href="#reporte_mcm" data-toggle="tab">Mcm</a>
								</li>
								<li class="nav-item col col-sm">
									<a class="nav-link " href="#reporte_ipcom" data-toggle="tab">Ipcom</a>
								</li>
								<li class="nav-item col col-sm">
									<a class="nav-link " href="#reporte_haz" data-toggle="tab">Haz</a>
								</li>
							</ul>
						</header>
					</div>
					<div id="consumoPorReportes" class="body tab-content" style="height: 400px; overflow-y: scroll; scrollbar-width: none; -ms-overflow-style: none;">
						<!--
							Área de impresión de resultados por Formulario
						-->
						<div id="reporte_mtel" class="tab-pane active" role="tabpanel">
							<h6 class="tab-header text-center">
								<small class="badge badge-sm float-center badge-light">
									Del Día <?php echo $date; ?> al día <?php echo $date; ?> en Minutos
								</small>
							</h6>
							<div class="table-responsive" style="overflow-x: scroll; scrollbar-width: none; -ms-overflow-style: none;">
								<table class="table table-sm" style="font-size:8px;">
									<thead>
										<tr>
											<th scope="col">Reporte</th>
											<th scope="col">Movil</th>
											<th scope="col">Fijo</th>
											<th scope="col">Total</th>
										</tr>
									</thead>
									<tbody class="text-right">
										<?php
										$reporte_mtel = new ConsumoPorCarrier($conexion, $date, $date, prefijos_marcatel);
										$reporte_mtel->distribucion_por_reportes();
										?>
									</tbody>
								</table>
							</div>
						</div>

						<div id="reporte_mcm" class="tab-pane" role="tabpanel">
							<h6 class="tab-header text-center">
								<small class="badge badge-sm float-center badge-light">
									Del Día <?php echo $date; ?> al día <?php echo $date; ?> en Minutos
								</small>
							</h6>
							<div class="table-responsive" style="overflow-x: scroll; scrollbar-width: none; -ms-overflow-style: none;">
								<table class="table table-sm" style="font-size:8px;">
									<thead>
										<tr>
											<th scope="col">Reporte</th>
											<th scope="col">Movil</th>
											<th scope="col">Fijo</th>
											<th scope="col">Total</th>
										</tr>
									</thead>
									<tbody class="text-right">
										<?php
										$reporte_mcm = new ConsumoPorCarrier($conexion, $date, $date, prefijos_mcm);
										$reporte_mcm->distribucion_por_reportes();
										?>
									</tbody>
								</table>
							</div>
						</div>

						<div id="reporte_ipcom" class="tab-pane" role="tabpanel">
							<h6 class="tab-header text-center">
								<small class="badge badge-sm float-center badge-light">
									Del Día <?php echo $date; ?> al día <?php echo $date; ?> en Minutos
								</small>
							</h6>
							<div class="table-responsive" style="overflow-x: scroll; scrollbar-width: none; -ms-overflow-style: none;">
								<table class="table table-sm" style="font-size:8px;">
									<thead>
										<tr>
											<th scope="col">Reporte</th>
											<th scope="col">Movil</th>
											<th scope="col">Fijo</th>
											<th scope="col">Total</th>
										</tr>
									</thead>
									<tbody class="text-right">
										<?php
										$reporte_ipcom = new ConsumoPorCarrier($conexion, $date, $date, prefijos_ipcom);
										$reporte_ipcom->distribucion_por_reportes();
										?>
									</tbody>
								</table>
							</div>
						</div>

						<div id="reporte_haz" class="tab-pane" role="tabpanel">
							<h6 class="tab-header text-center">
								<small class="badge badge-sm float-center badge-light">
									Del Día <?php echo $date; ?> al día <?php echo $date; ?> en Segundos
								</small>
							</h6>
							<div class="table-responsive" style="overflow-x: scroll; scrollbar-width: none; -ms-overflow-style: none;">
								<table class="table table-sm" style="font-size:8px;">
									<thead>
										<tr>
											<th scope="col">Reporte</th>
											<th scope="col">Movil</th>
											<th scope="col">Fijo</th>
											<th scope="col">Total</th>
										</tr>
									</thead>
									<tbody class="text-right">
										<?php
										$reporte_haz = new ConsumoPorCarrier($conexion, $date, $date, prefijos_haz);
										$reporte_haz->distribucion_por_reportes();
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</section>
			</div>
			<!-- Porcentaje consumo -->
			<div id="contenido" class="col-lg-6 col-lg-4 col-12">
				<section class="card">
					<div class="card-header">Porcetaje por carrier</div>
					<div id="porcentaje-por-carrier">
						<!--
								Área de impresión de resultados por Formulario
							-->
						<div id="idConsumoPorcentajes" class="tab-pane" style="font-size:9px;">
							<?php
							$total_all_min  =   new ConsumoPorCarrier($conexion, $date, $date, all_prefijos);
							$total_all_min->consumo_porcetnaje();
							?>
						</div>
						<hr>
						<div id="consumoDivididoPorCarrier">
							<div class="table-responsive">
								<table class="table align-items-center" style="font-size: 10px;">
									<thead>
										<tr>
											<th scope="col">Carrier</th>
											<th scope="col">Movil</th>
											<th scope="col">Fijo</th>
											<th scope="col">Total</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$costoPesos = new ConsumoPorCarrier($conexion, $date, $date, all_prefijos);
										$costoPesos->consumoDivididoCarrierMovilFijo();
										?>
									</tbody>
								</table>
							</div>
						</div>
						<div class="btn-img row">
							<div class="col">
								<!-- <input type="button" id="crearimagen" class="form-control btn btn-light" value="Crear Imagen"> -->
								<button id="crearimagen" class="form-control">Crear imagen</button>
							</div>
							<div class="col">
								<!-- El div id="img-out" sera el contenedor en donde visualizaremos la imagen exportada -->
								<div id="salidaimg" align="center"></div>
							</div>
						</div>
					</div>
				</section>
			</div>
			<!--Distribucion graficada -->
		</div>

		<!-- FILA consumo por dia 
			No se a agregado a index.html
		-->
		<div id="consumoDiarioCarriers" class="">
			<div class="card mt-3">
				<div id="consumo-diario">
				<label for="floatingInputValue">Datos por día</label>
				<div class="row">
					<div class="col col-lg-12 col-lg-6 col-lg-3 table-responsive">
						<table class="table table-sm table-hover table-borderless" style="font-size:0.625em;">
							<thead class="text-center align-middle">
								<tr class="">
									<th scope="col" rowspan="2" class="align-middle">Fechas</th>
									<th scope="col" colspan="2">Marcatel</th>
									<th scope="col" colspan="2">MCM</th>
									<th scope="col" colspan="2">Ipcom</th>
									<th scope="col" colspan="2">Haz</th> 
								</tr>
								<tr class="">
									<th scope="col">$ Movil</th>
									<th scope="col">$ Fijo</th>
									<th scope="col">$ Movil</th>
									<th scope="col">$ Fijo</th>
									<th scope="col">$ Movil</th>
									<th scope="col">$ Fijo</th>
									<th scope="col">$ Movil</th>
									<th scope="col">$ Fijo</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									$consumo_por_dia= new ConsumoPorDia($conexion,$date,$date,prefijos_individuales_por_carrier);
									$consumo_por_dia->desgloseDiario();
								?>
							</tbody>
						</table>
					</div>
				</div>
				</div>
			</div>
		</div>

		<div id="consumoDiarioCarriersSegundos" class="">
			<div class="card mt-3">
				<div id="consumo-diario-segundos">
					
				</div>
			</div>
		</div>

		<!-- FILA DISTRIBUCIÓN CE CONSUMO POR CENTROS -->
		<div class="card mt-3">
			<h3 class="card-title p-2">Sucusales Internas</h3>
			<h6 class="tab-header text-center">
				<small class="badge badge-sm float-center badge-light">
					De  <?php echo $date;?>  al  <?php echo $date;?>
				</small>
			</h6>
			<div class="row card-content">
				<div class="col-lg-12">
					<h4 class="card-header p-3">Escorza</h4>
				</div>
				<div class="col-lg-3 card-body table-responsive">	
					<?php
						$EscorzaMtel = new SucursalesInternas($conexion,$date,$date,carrier_mtel,prefijos_marcatel);
						$EscorzaMtel->consumoEscorza();
					?>
				</div>
				<div class="col-lg-3 card-body table-responsive">
					<?php
						$EscorzaMcm = new SucursalesInternas($conexion,$date,$date,carrier_mcm,prefijos_mcm);
						$EscorzaMcm->consumoEscorza();
					?>
				</div>
				<div class="col-lg-3 card-body table-responsive">
					<?php
						$EscorzaHaz = new SucursalesInternas($conexion,$date,$date,carrier_haz,prefijos_haz);
						$EscorzaHaz->consumoEscorza();
					?>
				</div>
				<div class="col-lg-3 card-body table-responsive">
					<?php
						$EscorzaIpcom = new SucursalesInternas($conexion,$date,$date,carrier_ipcom,prefijos_ipcom);
						$EscorzaIpcom->consumoEscorza();
					?>
				</div>
			</div>
			<br>
			<div class="row card-content">
				<div class="col-lg-12">
					<h4 class="card-header p-3">Revolución</h4>
				</div>
				<div class="col-lg-3 card-body table-responsive">	
					<?php
						$EscorzaMtel = new SucursalesInternas($conexion,$date,$date,carrier_mtel,prefijos_marcatel);
						$EscorzaMtel->consumoRevolucion();
					?>
				</div>
				<div class="col-lg-3 card-body table-responsive">
					<?php
						$EscorzaMcm = new SucursalesInternas($conexion,$date,$date,carrier_mcm,prefijos_mcm);
						$EscorzaMcm->consumoRevolucion();
					?>
				</div>
				<div class="col-lg-3 card-body table-responsive">
					<?php
						$EscorzaHaz = new SucursalesInternas($conexion,$date,$date,carrier_haz,prefijos_haz);
						$EscorzaHaz->consumoRevolucion();
					?>
				</div>
				<div class="col-lg-3 card-body table-responsive">
					<?php
						$EscorzaIpcom = new SucursalesInternas($conexion,$date,$date,carrier_ipcom,prefijos_ipcom);
						$EscorzaIpcom->consumoRevolucion();
					?>
				</div>
			</div>
			<br>
			<div class="row card-content">
				<div class="col-lg-12">
					<h4 class="card-header p-3">Tlájomulco</h4>
				</div>
				<div class="col-lg-3 card-body table-responsive">	
					<?php
						$EscorzaMtel = new SucursalesInternas($conexion,$date,$date,carrier_mtel,prefijos_marcatel);
						$EscorzaMtel->consumoTlajomulco();
					?>
				</div>
				<div class="col-lg-3 card-body table-responsive">
					<?php
						$EscorzaMcm = new SucursalesInternas($conexion,$date,$date,carrier_mcm,prefijos_mcm);
						$EscorzaMcm->consumoTlajomulco();
					?>
				</div>
				<div class="col-lg-3 card-body table-responsive">
					<?php
						$EscorzaHaz = new SucursalesInternas($conexion,$date,$date,carrier_haz,prefijos_haz);
						$EscorzaHaz->consumoTlajomulco();
					?>
				</div>
				<div class="col-lg-3 card-body table-responsive">
					<?php
						$EscorzaIpcom = new SucursalesInternas($conexion,$date,$date,carrier_ipcom,prefijos_ipcom);
						$EscorzaIpcom->consumoTlajomulco();
					?>
				</div>
			</div>
			<br>
			<div class="row card-content">
				<div class="col-lg-12">
					<h4 class="card-header p-3">Drop - Buzón</h4>
				</div>
				<div class="col-lg-3 card-body table-responsive">	
					<?php
						$EscorzaMtel = new SucursalesInternas($conexion,$date,$date,carrier_mtel,prefijos_marcatel);
						$EscorzaMtel->consumoDropBuzon();
					?>
				</div>
				<div class="col-lg-3 card-body table-responsive">
					<?php
						$EscorzaMcm = new SucursalesInternas($conexion,$date,$date,carrier_mcm,prefijos_mcm);
						$EscorzaMcm->consumoDropBuzon();
					?>
				</div>
				<div class="col-lg-3 card-body table-responsive">
					<?php
						$EscorzaHaz = new SucursalesInternas($conexion,$date,$date,carrier_haz,prefijos_haz);
						$EscorzaHaz->consumoDropBuzon();
					?>
				</div>
				<div class="col-lg-3 card-body table-responsive">
					<?php
						$EscorzaIpcom = new SucursalesInternas($conexion,$date,$date,carrier_ipcom,prefijos_ipcom);
						$EscorzaIpcom->consumoDropBuzon();
					?>
				</div>
			</div>
			<br>
			<div class="row card-content">
				<div class="col-lg-12">
					<h4 class="card-header p-3">Administrativo</h4>
				</div>
				<div class="col-lg-3 card-body table-responsive">	
					<?php
						$EscorzaMtel = new SucursalesInternas($conexion,$date,$date,carrier_mtel,prefijos_marcatel);
						$EscorzaMtel->consumoAdministrativo();
					?>
				</div>
				<div class="col-lg-3 card-body table-responsive">
					<?php
						$EscorzaMcm = new SucursalesInternas($conexion,$date,$date,carrier_mcm,prefijos_mcm);
						$EscorzaMcm->consumoAdministrativo();
					?>
				</div>
				<div class="col-lg-3 card-body table-responsive">
					<?php
						$EscorzaHaz = new SucursalesInternas($conexion,$date,$date,carrier_haz,prefijos_haz);
						$EscorzaHaz->consumoAdministrativo();
					?>
				</div>
				<div class="col-lg-3 card-body table-responsive">
					<?php
						$EscorzaIpcom = new SucursalesInternas($conexion,$date,$date,carrier_ipcom,prefijos_ipcom);
						$EscorzaIpcom->consumoAdministrativo();
					?>
				</div>
			</div>
		</div>
		

		
		

		<!--End Dashboard Content-->

		<!--start overlay-->
		<div class="overlay toggle-menu"></div>
		<!--end overlay-->

	</div>
	<!-- End container-fluid-->
</div>
<!--End content-wrapper-->
<?php
require_once  'views/parte_inferior.php';
?>