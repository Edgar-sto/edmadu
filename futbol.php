<?php
require_once 'views/parte_superior.php';
require_once 'class/prefijos.php';
require_once 'class/conexion.php';
require_once 'class/fecha2022.php';
require_once 'class/FechaReportes.php';
require_once 'class/ConsumoPorCarrier.php';
require_once 'class/SucursalesInternas.php';
$conexion = conexion_local('telefonia', '127.0.0.1');
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
						<div class="col col-sm">
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
				<div id="fila-uno-consumo-dividido-carrier" class="row row-group m-0">
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
			<div class="col-lg-6 col-lg-4 col-12 ">
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
					</div>
				</section>
			</div>
			<!--Distribucion graficada -->
		</div>

		<!-- FILA consumo por dia -->
		<div id="consumoDiarioCarriers" class="collapse multi-collapse">
			<div class="card mt-3">
				<div id="consumo-diario">
					
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