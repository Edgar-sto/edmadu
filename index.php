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
							
							foreach ($meses AS $mes) {
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

							foreach ($anno2022 AS $mese => $d) {
								?>							
								<div class="collapse multi-collapse" id="<?php echo $mese; ?>">
									<div class="card card-body">
										<div class="table-responsive">
											<h5 class="card-title text-capitalize"><?php echo $mese; ?></h5>
											<p class="card-text">
												<?php foreach ( $d AS $dia) { ?>
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
					<table id="tbl_telefonia_mensual" class="table">
						<tbody class="text-center form-group">
							<tr>
								<td>
									<div class="form-group">
										<label for="input-1">Carrier</label>
										<select id="carrier" name="carrier" class="form-control">
											<option value="#">--Seleccionar Carrier--</option>
											<option value="marcatel">Marcatel</option>
											<option value="mcm">MCM</option>
											<option value="ipcom">Ipcom</option>
											<option value="hazz">Haz</option>
										</select>
									</div>
								</td>
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
		<h6 class="tab-header text-left">
			<small class="badge badge-sm float-center badge-light">
				Información del día <?php echo $date; ?>
			</small>
		</h6>
		<!-- FILA DISTRIBUCION DE CONSUMO POR CARRIER MINUTOS-->
		<div class="card mt-3">
			<div class="card-content">
				<div id="fila-uno-consumo-dividido-carrier" class="row row-group m-0">
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

		<!-- FILA  "Consumo por vici" - "Porcentaje del dia anterior por carrier" - "Costo movil fijo por carrier"-->
		<div class="row">
			<!-- <div class="col-lg-4 col-xl-4 col-12 "> -->
			<!--Distribucion de consumo por Reporte -->
			<div class="col-lg-6 col-lg-4 col-12 ">
				<section class="card" style="height: 465px;">
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

				</section>
			</div>
			<!--Distribucion graficada -->
		</div>


		<!-- FILA distribucion por centro, campaña, carrier -->
		<div class="card mt-3">
			<!--ESCORZA - REVOLUCION -->
			<div class="row">
					<!-- ESCORZA -->
					<div class="col-lg-12 table-responsive xy-hiden" id=" " >
						<h4>Escorza</h4>
						<hr>
						<div class="row">
							<div class="col-sm-6 col">
								<!--Marcatel -->
								<?php
									$consumo_escorza_mtel = new SucursalesInternas($conexion, $date, $date, carrier_mtel, prefijos_marcatel);
									$consumo_escorza_mtel->consumoEscorza();
								?>
							</div>
							<div class="col-sm-6 col">
								<!--MCM -->
								<?php
									$consumo_escorza_mcm = new SucursalesInternas($conexion, $date, $date, carrier_mcm, prefijos_mcm);
									$consumo_escorza_mcm->consumoEscorza();
								?>
							</div>
							<div class="col-sm-6 col">
								<!--Ipcom -->
								<?php
									$consumo_escorza_ipcom = new SucursalesInternas($conexion, $date, $date, carrier_ipcom, prefijos_ipcom);
									$consumo_escorza_ipcom->consumoEscorza();
								?>
							</div>
							<div class="col-sm-6 col">
								<!--Haz -->
								<?php
									$consumo_escorza_haz = new SucursalesInternas($conexion, $date, $date, carrier_haz, prefijos_haz);
									$consumo_escorza_haz->consumoEscorza();
								?>
							</div>
						</div>
					</div>
					<!--REVOLUCION -->
					<div class="col-lg-12 table-responsive xy-hiden" id=" ">
						<h4>Revolución</h4>
						<hr>
						<div class="row">
							<div class="col-sm-6 col">
								<!--Marcatel -->
								<?php
									$consumo_revolucion_mtel = new SucursalesInternas($conexion, $date, $date, carrier_mtel, prefijos_marcatel);
									$consumo_revolucion_mtel->consumoRevolucion();
								?>
							</div>
							<div class="col-sm-6 col">
								<!--MCM -->
								<?php
									$consumo_revolucion_mcm = new SucursalesInternas($conexion, $date, $date, carrier_mcm, prefijos_mcm);
									$consumo_revolucion_mcm->consumoRevolucion();
								?>
							</div>
							<div class="col-sm-6 col">
								<!--Ipcom -->
								<?php
									$consumo_revolucion_ipcom = new SucursalesInternas($conexion, $date, $date, carrier_ipcom, prefijos_ipcom);
									$consumo_revolucion_ipcom->consumoRevolucion();
								?>
							</div>
							<div class="col-sm-6 col">
								<!--Haz -->
								<?php
									$consumo_revolucion_haz = new SucursalesInternas($conexion, $date, $date, carrier_haz, prefijos_haz);
									$consumo_revolucion_haz->consumoRevolucion();
								?>
							</div>
						</div>
					</div>
				</div>
				<br>
				<!--TLAJOMULCO - DROP BUZON - ADMINISTRATIVO -->
				<div class="row">
					<!--TLAJOMULCO -->
					<div class="col-lg-12 table-responsive xy-hiden" id=" ">
						<h4>Tlajomulco</h4>
						<hr>
						<div class="row">
							<div class="col-sm-6 col">
								<!--Marcatel -->
								<?php
									$consumo_tlajomulco_mtel = new SucursalesInternas($conexion, $date, $date, carrier_mtel, prefijos_marcatel);
									$consumo_tlajomulco_mtel->consumoTlajomulco();
								?>
							</div>
							<div class="col-sm-6 col">
								<!--MCM -->
								<?php
									$consumo_tlajomulco_mcm = new SucursalesInternas($conexion, $date, $date, carrier_mcm, prefijos_mcm);
									$consumo_tlajomulco_mcm->consumoTlajomulco();
								?>
							</div>
							<div class="col-sm-6 col">
								<!--Ipcom -->
								<?php
									$consumo_tlajomulco_ipcom = new SucursalesInternas($conexion, $date, $date, carrier_ipcom, prefijos_ipcom);
									$consumo_tlajomulco_ipcom->consumoTlajomulco();
								?>
							</div>
							<div class="col-sm-6 col">
								<!--Haz -->
								<?php
									$consumo_tlajomulco_haz = new SucursalesInternas($conexion, $date, $date, carrier_haz, prefijos_haz);
									$consumo_tlajomulco_haz->consumoTlajomulco();
								?>
							</div>
						</div>
					</div>
					<!--DROP BUZON - ADMINISTRATIVO -->
					<div class="col-lg-12 table-responsive" id=" ">
						<div class="row">
							<!--DROP BUZON-->
							<div class="col-lg-12 table-responsive xy-hiden" id=" ">
								<h4>Drop - Buzón</h4>
								<hr>
								<div class="row">
									<div class="col-sm-6 col">
										<!--Marcatel -->
										<?php
											$consumo_drop_buzon_mtel = new SucursalesInternas($conexion, $date, $date, carrier_mtel, prefijos_marcatel);
											$consumo_drop_buzon_mtel->consumoDropBuzon();
										?>
									</div>
									<div class="col-sm-6 col">
										<!--MCM -->
										<?php
											$consumo_drop_buzon_mcm = new SucursalesInternas($conexion, $date, $date, carrier_mcm, prefijos_mcm);
											$consumo_drop_buzon_mcm->consumoDropBuzon();
										?>
									</div>
									<div class="col-sm-6 col">
										<!--Ipcom -->
										<?php
											$consumo_drop_buzon_ipcom = new SucursalesInternas($conexion, $date, $date, carrier_ipcom, prefijos_ipcom);
											$consumo_drop_buzon_ipcom->consumoDropBuzon();
										?>
									</div>
									<div class="col-sm-6 col">
										<!--Haz -->
										<?php
											$consumo_drop_buzon_haz = new SucursalesInternas($conexion, $date, $date, carrier_haz, prefijos_haz);
											$consumo_drop_buzon_haz->consumoDropBuzon();
										?>
									</div>
								</div>
							</div>
							<br>
							<br>
							<!--ADMINISTRATIVO-->
							<div class="col-lg-12 table-responsive xy-hiden" id=" ">
								<h4>Administrativo</h4>
								<hr>
								<div class="row">
									<div class="col-sm-6 col">
										<!--Marcatel -->
										<?php
											$consumo_admin_mtel = new SucursalesInternas($conexion, $date, $date, carrier_mtel, prefijos_marcatel);
											$consumo_admin_mtel->consumoAdministrativo();
										?>
									</div>
									<div class="col-sm-6 col">
										<!--MCM -->
										<?php
											$consumo_admin_mcm = new SucursalesInternas($conexion, $date, $date, carrier_mcm, prefijos_mcm);
											$consumo_admin_mcm->consumoAdministrativo();
										?>
									</div>
									<div class="col-sm-6 col">
										<!--Ipcom -->
										<?php
											$consumo_admin_ipcom = new SucursalesInternas($conexion, $date, $date, carrier_ipcom, prefijos_ipcom);
											$consumo_admin_ipcom->consumoAdministrativo();
										?>
									</div>
									<div class="col-sm-6 col">
										<!--Haz -->
										<?php
											$consumo_admin_haz = new SucursalesInternas($conexion, $date, $date, carrier_haz, prefijos_haz);
											$consumo_admin_haz->consumoAdministrativo();
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
		</div>

		<!-- FILA "Grafica" - "Fechas de reportes" -->
		<div class="row">
			<div class="col-12 col-lg-8 col-xl-8">
				<div class="card" style="height: 465px;">
					<div class="card-header">Site Traffic
						<div class="card-action">
							<div class="dropdown">
								<a href="javascript:void();" class="dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown">
									<i class="icon-options"></i>
								</a>
								<div class="dropdown-menu dropdown-menu-right">
									<a class="dropdown-item" href="javascript:void();">Action</a>
									<a class="dropdown-item" href="javascript:void();">Another action</a>
									<a class="dropdown-item" href="javascript:void();">Something else here</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="javascript:void();">Separated link</a>
								</div>
							</div>
						</div>
					</div>
					<div class="card-body">
						<ul class="list-inline">
							<li class="list-inline-item"><i class="fa fa-circle mr-2 text-white"></i>New Visitor
							</li>
							<li class="list-inline-item"><i class="fa fa-circle mr-2 text-light"></i>Old Visitor
							</li>
						</ul>
						<div class="chart-container-1">
							<canvas id="chart1"></canvas>
						</div>
					</div>

					<div class="row m-0 row-group text-center border-top border-light-3">
						<div class="col-12 col-lg-4">
							<div class="p-3">
								<h5 class="mb-0">45.87M</h5>
								<small class="mb-0">Overall Visitor <span> <i class="fa fa-arrow-up"></i>
										2.43%</span></small>
							</div>
						</div>
						<div class="col-12 col-lg-4">
							<div class="p-3">
								<h5 class="mb-0">15:48</h5>
								<small class="mb-0">Visitor Duration <span> <i class="fa fa-arrow-up"></i>
										12.65%</span></small>
							</div>
						</div>
						<div class="col-12 col-lg-4">
							<div class="p-3">
								<h5 class="mb-0">245.65</h5>
								<small class="mb-0">Pages/Visit <span> <i class="fa fa-arrow-up"></i>
										5.62%</span></small>
							</div>
						</div>
					</div>

				</div>
			</div>

			<!--Reportes comprobación por fecha -->
			<div class="col-lg-4 col-xl-4 col-12">
				<section class="card">
					<div class="card-header">Reportes con consumo</div>
					<div id="fechitas" class="body" style="height: 300px; overflow-y: scroll; scrollbar-width: none; -ms-overflow-style: none;">
						<div class="row">
							<?php
							// $sihayconsumo = new FechasReportes($conexion_21,$date,$date);
							// $sihayconsumo->reporteConConsumo();
							?>
						</div>
					</div>
				</section>
			</div>
		</div>

		<!--TABLA CONSUMO POR CAMPANIA-->
		<div class="row">
			<div class="col-12 col-lg-12">
				<div class="card">
					<div class="card-header">Recent Order Tables
						<div class="card-action">
							<div class="dropdown">
								<a href="javascript:void();" class="dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown">
									<i class="icon-options"></i>
								</a>
								<div class="dropdown-menu dropdown-menu-right">
									<a class="dropdown-item" href="javascript:void();">Action</a>
									<a class="dropdown-item" href="javascript:void();">Another action</a>
									<a class="dropdown-item" href="javascript:void();">Something else here</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="javascript:void();">Separated link</a>
								</div>
							</div>
						</div>
					</div>
					<div class="table-responsive">
						<table class="table align-items-center table-flush table-borderless">
							<thead>
								<tr>
									<th>Product</th>
									<th>Photo</th>
									<th>Product ID</th>
									<th>Amount</th>
									<th>Date</th>
									<th>Shipping</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>Iphone 5</td>
									<td><img src="https://via.placeholder.com/110x110" class="product-img" alt="product img"></td>
									<td>#9405822</td>
									<td>$ 1250.00</td>
									<td>03 Aug 2017</td>
									<td>
										<div class="progress shadow" style="height: 3px;">
											<div class="progress-bar" role="progressbar" style="width: 90%">
											</div>
										</div>
									</td>
								</tr>

								<tr>
									<td>Earphone GL</td>
									<td><img src="https://via.placeholder.com/110x110" class="product-img" alt="product img"></td>
									<td>#9405820</td>
									<td>$ 1500.00</td>
									<td>03 Aug 2017</td>
									<td>
										<div class="progress shadow" style="height: 3px;">
											<div class="progress-bar" role="progressbar" style="width: 60%">
											</div>
										</div>
									</td>
								</tr>

								<tr>
									<td>HD Hand Camera</td>
									<td><img src="https://via.placeholder.com/110x110" class="product-img" alt="product img"></td>
									<td>#9405830</td>
									<td>$ 1400.00</td>
									<td>03 Aug 2017</td>
									<td>
										<div class="progress shadow" style="height: 3px;">
											<div class="progress-bar" role="progressbar" style="width: 70%">
											</div>
										</div>
									</td>
								</tr>

								<tr>
									<td>Clasic Shoes</td>
									<td><img src="https://via.placeholder.com/110x110" class="product-img" alt="product img"></td>
									<td>#9405825</td>
									<td>$ 1200.00</td>
									<td>03 Aug 2017</td>
									<td>
										<div class="progress shadow" style="height: 3px;">
											<div class="progress-bar" role="progressbar" style="width: 100%">
											</div>
										</div>
									</td>
								</tr>

								<tr>
									<td>Hand Watch</td>
									<td><img src="https://via.placeholder.com/110x110" class="product-img" alt="product img"></td>
									<td>#9405840</td>
									<td>$ 1800.00</td>
									<td>03 Aug 2017</td>
									<td>
										<div class="progress shadow" style="height: 3px;">
											<div class="progress-bar" role="progressbar" style="width: 40%">
											</div>
										</div>
									</td>
								</tr>

								<tr>
									<td>Clasic Shoes</td>
									<td><img src="https://via.placeholder.com/110x110" class="product-img" alt="product img"></td>
									<td>#9405825</td>
									<td>$ 1200.00</td>
									<td>03 Aug 2017</td>
									<td>
										<div class="progress shadow" style="height: 3px;">
											<div class="progress-bar" role="progressbar" style="width: 100%">
											</div>
										</div>
									</td>
								</tr>

							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<!--End Row-->

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