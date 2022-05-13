<?php
require_once 'views/parte_superior.php';
?>
<!-- Start content-wrapper-->
<div class="content-wrapper">
	<div class="container-fluid">
		<div class="row mt-3">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-body">
					<div class="card-title"><h4 class="h4">Reporte Telefonía</h4></div>
						<!-- <div class="row"> -->
						<div id="content" class="col-lg-12">
							<nav class="navbar navbar-light">
								<button class="btn btn-light px-5">Marcatel</button>
								<button class="btn btn-light px-5">MCM</button>
								<button class="btn btn-light px-5">Ipcom</button>
								<button class="btn btn-light px-5">Haz</button>
								<button class="btn btn-light px-5">Voices</button>
								<button id="btn_down" class="btn btn-light px-5">
									<svg class="icon icon-tabler icon-tabler-arrow-down-circle" width="16" height="16" viewBox="0 0 24 24" stroke-width="1.5" stroke="#53b13a" fill="none" stroke-linecap="round" stroke-linejoin="round">
										<path stroke="none" d="M0 0h24v24H0z" fill="none" />
										<circle cx="12" cy="12" r="9" />
										<line x1="8" y1="12" x2="12" y2="16" />
										<line x1="12" y1="8" x2="12" y2="16" />
										<line x1="16" y1="12" x2="12" y2="16" />
									</svg>
								</button>
								<button id="btn_up" class="btn btn-light px-5">
									<svg class="icon icon-tabler icon-tabler-arrow-up-circle" width="16" height="16" viewBox="0 0 24 24" stroke-width="1.5" stroke="#e7000f" fill="none" stroke-linecap="round" stroke-linejoin="round">
										<path stroke="none" d="M0 0h24v24H0z" fill="none" />
										<circle cx="12" cy="12" r="9" />
										<line x1="12" y1="8" x2="8" y2="12" />
										<line x1="12" y1="8" x2="12" y2="16" />
										<line x1="16" y1="12" x2="12" y2="8" />
									</svg>
								</button>
							</nav>
							<!-- START FORMULARIOS -->
							<div>
								<form id="form_telefonia_mensual" method="POST">
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
														<input id="btn_telefonia_mensual" name="btn_telefonia_mensual" type="button" class="btn btn-light" value="Buscar">
													</div>
												</td>
											</tr>
										</tbody>
									</table>
								</form>
							</div>
							<!-- END FORMULARIOS -->
						</div>
						<!-- </div> -->
					</div>
				</div>
			</div>
		</div>
		<div class="row mt-1">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-body">
						<div id="resultado_telefonia_mensual">

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
		<div class="row mt-1">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-body">
						<div id="resultado_telefonia_mensual_sucursales_externas">

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