<?php
require_once 'views/parte_superior.php';
require_once 'class/prefijos.php';
require_once 'class/conexion.php';
require_once 'class/fecha2022.php';
require_once 'class/FechaReportes.php';
require_once 'class/C.consumo.telefonico.php';
$conexion = conexion_global( '10.9.2.244','soporte','Z3pu0rg','telefonia',);

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
		<!--    FILA UNO DESGLOSE GENERAL   -->
		<div class="card mt-3">
			<div class="card-content">
					<!-- INFORMACIÖN -->
					<div class="col-12 text-center">
						<div class="card mt-3" style="width: 100%;">
							<div class="card-header">
								<h5 class="card-title">Consumo Telefoníco</h5>
							</div>
							<div class="card-body">
								<div class="table-responsive-lg card-text">
                                    <h6 class="tab-header text-center">
                                        <small class="badge badge-sm float-center badge-light w-100">
                                            De  <?php echo $date;?>  al  <?php echo $date;?>
                                        </small>
                                    </h6>
                                    <table class="table"> 
                                        <thead style="font-size: 1.3rem;">
                                            <tr class="table-active">
                                                <th scope="col">Carrier</th>
                                                <th scope="col" colspan="2">Móvil</th>
                                                <th scope="col" colspan="2">Fijo</th>
                                                <th scope="col" colspan="2">Total</th>
                                                <th scope="col" colspan="2">Porcentaje</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $porcentaje = new C_consumo_telefonico($conexion, $date, $date);
                                                $porcentaje->consumoTotal();
                                            ?>
                                        </tbody>
                                    </table>
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
										// $consumo_por_dia= new ConsumoPorDia($conexion,$date,$date,prefijos_individuales_por_carrier);
										// $consumo_por_dia->desgloseDiario();
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