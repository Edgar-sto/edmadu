<?php
require_once 'views/parte_superior.php';
require_once 'class/prefijos.php';
require_once 'class/conexion.php';
require_once 'class/fecha2022.php';
require_once 'class/FechaReportes.php';
require_once 'class/ConsumoPorCarrier.php';
require_once 'class/SucursalesInternas.php';
require_once 'class/SemaforoScript.php';
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
					<div class="col col-sm">
						<a class="bg-active text-capitalize" data-toggle="collapse" href="#datos_telefonia" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">
							Telefonia
							<!-- <small class="badge float-right badge-light">Edgar</small> -->
						</a>
					</div>
				</div>
				<br>
				<div class="row row-group m-0">
					<div class="collapse multi-collapse col-12 col-6" id="datos_telefonia">

						<div class="card card-body">
							<div class="table-responsive">
								<h5 class="card-title text-capitalize">Datos Telefonía</h5>
								<p class="card-text table-responsive xy-hiden">
									<table class="table table-dark" style="font-size: 0.6875rem;">
										<thead>
											<tr class="text-top">
												<th rowspan="2">Carrier</th>
												<th rowspan="2" >Prefijo</th>
												<th colspan="2" class="text-center">Costos</th>
												<th rowspan="2">Porcentaje</th>
											</tr>
											<tr>
												<th>Movil</th>
												<th>Fijo</th>
											</tr>
										</thead>
										<tbody class="table-light"> 
											<tr>
												<td>Marcatel</td>
												<td>15 - 777</td>
												<td>$ 0.11</td>
												<td>$ 0.04</td>
												<td>5%</td>
											</tr>
											<tr>
												<td>MCM</td>
												<td>11 - 999</td>
												<td>$ 0.11</td>
												<td>$ 0.05</td>
												<td>5%</td>
											</tr>
											<tr>
												<td>Ipcom</td>
												<td>28 - 444</td>
												<td>$ 0.11</td>
												<td>$ 0.04</td>
												<td>20%</td>
											</tr>
											<tr>
												<td>Haz</td>
												<td>14 - 555</td>
												<td>$ 0.09/60</td>
												<td>$ 0.04/60</td>
												<td>70%</td>
											</tr>
										</tbody>
									</table>
								</p>
								<p class="card-text table-responsive xy-hiden">
									<table class="table table-dark" style="font-size: 0.6875rem;">
										<thead>
											<tr class="text-top">
												<th >Tipo Consumo</th>
												<th >Dial Status</th>
												<th >Grupo</th>
												<th >Status</th>
												<th >Tipo</th>
											</tr>
										</thead>
										<tbody class="table-light"> 
											<tr>
												<td>DROP</td>
												<td>ANSWER</td>
												<td> </td>
												<td>NOT IN (NA,AA)</td>
												<td>movil - fijo</td>
											</tr>
											<tr>
												<td>BUZON</td>
												<td>ANSWER</td>
												<td> </td>
												<td>IN (NA,AA)</td>
												<td>movil - fijo</td>
											</tr>
											<tr>
												<td>CAMPAÑA0</td>
												<td>ANSWER</td>
												<td> </td>
												<td> </td>
												<td>movil - fijo</td>
											</tr>
										</tbody>
									</table>
								</p>
								<p class="card-text table-responsive xy-hiden">
									<table class="table table-dark" style="font-size: 0.6875rem;">
										<thead>
											<tr class="text-top">
												<th >Vicis Externos</th>
												<th >Vicis Intrusos</th>
											</tr>
										</thead>
										<tbody class="table-light"> 
											<tr>
												<td>10.9.2.22</td>
												<td>10.9.2.39</td>
											</tr>
											<tr>
												<td>10.9.2.27</td>
												<td>10.9.2.48</td>
											</tr>
											<tr>
												<td>10.9.2.28</td>
												<td> </td>
											</tr>
											<tr>
												<td>10.9.2.41</td>
												<td> </td>
											</tr>
											<tr>
												<td>10.9.2.57</td>
												<td> </td>
											</tr>
										</tbody>
									</table>
								</p>
							</div>
						</div>

					</div>
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
		<!-- SEMAFORO  -->
		<div class="card mt-1">
			<div class="card-content">
				<div class="col-12 table-responsive xy-hiden">
					<div id="resultado-semaforo" class="text-center">
						<label for="">Semaforo</label>
						<div class="row">
							<div class="col-lg-4">Principal</div>
							<div class="col-lg-4">Eventos</div>
							<div class="col-lg-4">Segundos</div>
						</div>
						<div class="row">
							<?php
								$semaforo = new SemaforoScript($conexion, $date, $date);
								$semaforo->semaforo();
							?>
						</div>
					</div>
				</div>
			</div>
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
					<!-- CONSUMO ADMINISTRATIVO -->
					<!-- <div class="col-12 table-responsive xy-hiden">
						<h4>Administrativo</h4>
						<hr>
						<?php
							$consumo_admin = new SucursalesInternas($conexion,$date, $date, $carrier,$prefijos_junto);
							$consumo_admin->consumoAdministrativo();
						?>
					</div>
					</div> -->
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

		<!-- FILA CONSUMO POR SEMANA -->
		<div class="card mt-3">
			<div class="card-content">
				<div class="card-header">Consumo por Semana</div>
				<div id="consumo-por-semana" class="col-12 table-responsive dataWeek">
					<?php
						include_once 'views/viewstools/consumo_por_semana.php';
					?>
				</div>
			</div>
		</div>

		<!-- FILA consumo por dia 
			No se a agregado a index.html
		-->
		<!-- FILA consumo dividido por día en minutos -->
		<div id="consumoDiarioCarriers" class="">
			<div class="card mt-3">
				<div id="consumo-diario">
					
				</div>
			</div>
		</div>
		
		<!-- FILA consumo dividido por día en segundos -->
		<div id="consumoDiarioCarriersSegundos" class="">
			<div class="card mt-3">
				<div id="consumo-diario-segundos">
					
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
