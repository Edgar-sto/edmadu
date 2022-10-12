<?php 
require_once 'views/parte_superior.php';
require_once 'class/prefijos.php';
require_once 'class/conexion.php';
require_once 'class/fecha2022.php';
require_once 'class/FechaReportes.php';
require_once 'class/ConsumoPorCarrier.php';
require_once 'class/SucursalesInternas.php';
require_once 'class/SemaforoScript.php';
$conexion = conexion_local('telefonia', '10.9.2.147');
$conexion_21 = conexion_21('telefonia', '10.9.2.21');
?> 
<!-- Start content-wrapper-->
<div class="content-wrapper">
	<div class="container-fluid">
		<!-- FORMULARIO  -->
		<div class="card mt-1">
			<form id="form_maquilas" method="POST">
				<table id="tbl_telefonia_maquilas" class="table">
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
									<label for="input-1">Cliente</label>
									<select name="cliente" id="cliente" class="form-control"> 
										<option value="hsbc">HSBC</option>
										<option value="invex">INVEX</option>
									</select>
								</div>
							</td>
							<td>
								<div class="form-group">
									<label for="input-1">Acción</label><br>
									<input id="btn_consumo_maquilas" name="btn_consumo_maquilas" type="button" class="btn btn-light" value="Buscar">
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
						<div id="answer-week">
							
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

