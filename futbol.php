<?php
require_once 'views/parte_superior.php';
require_once 'class/conexion.php';
require_once 'class/fecha2022.php';
?>
<!-- Start content-wrapper-->
<div class="content-wrapper">
	<div class="container-fluid">
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

		<div class="row mt-1">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-body">
						<div id="distribucion_cosumo_por_carrier">

						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row mt-1">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-body">
						<div id="resultado_telefonia_mensual_sucursales">

						</div>
					</div>
				</div>
			</div>
		</div>
		
	</div>
</div>

<?php
require_once  'views/parte_inferior.php';
?>