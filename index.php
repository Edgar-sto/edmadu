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
$conexion = conexion_local('telefonia', '10.9.2.147');
$conexion_21 = conexion_21('telefonia', '10.9.2.21');

?> 
<!-- Start content-wrapper-->
<div class="content-wrapper">
	<div class="container-fluid">
		<!-- START Fila N -->
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

		<!--
			FILA UNO
			DESGLOSE GENERAL
		-->
		<div class="card mt-3">
			<div class="card-content">
				<div id="fila-uno-consumo-dividido-carrier" class="row row-group m-0 p-4">
					<!-- INFORMACIÖN -->
					<div class="col-12 text-center">
						<div class="card m-3" style="width: 100%;">
							<div class="card-header">
								<h5 class="card-title">Consumo</h5>
							</div>
							<div class="card-body">
								<div class="table-responsive-lg card-text">
									<?php
									$porcentaje = new ConsumoPorCarrier($conexion, $date, $date, prefijos_marcatel);
									$porcentaje->porcentaje();
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!--
			FILA DOS 
			DESGLOSE POR DÍA
		-->
		<div class="card mt-3">
			<div id="consumo-diario" class="card-content">
				<label for="floatingInputValue">Datos por día</label>
				<div id="consumoDiarioCarriers" class="row">
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

		<!--
			FILA TRES
			DESGLOSE POR REPORTE
		-->
		
		<div class="card mt-3">
			<!--Distribucion de consumo por Reporte -->
			<div class="card-content">
				<div class=" col col-12">
					<section class="card mt-3" style="width:100%; height: 420px;">
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
						<div id="consumoPorReportes" class="body tab-content dataWeek y-hiden1" style="height: 400px;">
							<!--
								Área de impresión de resultados por Formulario
							-->
							<div id="reporte_mtel" class="tab-pane active" role="tabpanel">
								<h6 class="tab-header text-center">
									<small class="badge badge-sm float-center badge-light">
										Del Día <?php echo $date; ?> al día <?php echo $date; ?> en Minutos
									</small>
								</h6>
								<div class="table-responsive dataWeek y-hiden1">
									<table class="table table-sm" style="font-size:1rem;">
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
								<div class="table-responsive dataWeek y-hiden1">
									<table class="table table-sm" style="font-size:1rem;">
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
								<div class="table-responsive dataWeek y-hiden1">
									<table class="table table-sm" style="font-size:1rem;">
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
								<div class="table-responsive dataWeek y-hiden1">
									<table class="table table-sm" style="font-size:1rem;">
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
			</div>
			<!--Distribucion graficada -->
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