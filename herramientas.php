<?php
require_once 'views/parte_superior.php';
?>
<!-- Start content-wrapper-->
<div class="content-wrapper">
	<div class="container-fluid">
		<div class="row mt-3">
			<div class="col-lg-6">
				<div class="card">
					<div class="card-body">
					<div class="card-title"><h4 class="h4">Generador de contraseñas</h4></div>
                    <div id="resultado_generador_de_contraseña">

                    </div>
						
                        <form id="form-generador-pass" method="post">
                            <div class="form-group">
                                <label for="chars">Número de caracteres</label>
                                <input class="form-control" type="text" name="chars" value="8" maxlength="1">
                                <small id="emailHelp" class="form-text text-muted">Introduce un número de caracteres para generar la contraseña.</small>
                            </div>                
                            <button id="btn-generador-pass" type="button" name="submitChars" class="btn btn-light">Generar</button>
                        </form>
						<!-- </div> -->
					</div>
				</div>
			</div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title"><h4 class="h4">Convertidor PX -> EM</h4></div>
                        <div id="convertion-pixel-em">

                        </div>
                            <form id="form-pixel-em" method="POST">
                                <label for="tamaniopixel">Convertidor de PX a EM</label>
                                <input class="form-control" type="text" name="tamaniopixel">
                                <small id="smallpixel" class="form-text text-muted">Introduce un número en pixel</small>
                                <button id="btn-pixel-em" type="button" name="submitPixel" class="btn btn-light">Convertir</button>
                            </form>
                    </div>
                </div>
            </div>
		</div>

        <div class="row mt-3">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-body">
					    <div class="card-title"><h4 class="h4">Dias telefonia 21</h4></div>
                        <form id="form_telefonia_21" method="POST">
                            <table id="tbl_telefonia_21" class="table">
                                <tbody class="text-center form-group">
                                    <tr>
                                        <td>
                                            <div class="form-group">
                                                <label for="input-1">Fecha inicio</label>
                                                <input id="start_date_21" name="start_date_21" type="date" class="form-control">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <label for="input-1">Fecha termino</label>
                                                <input id="end_date_21" name="end_date_21" type="date" class="form-control">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <label for="input-1">Acción</label><br>
                                                <input id="btn_telefonia_21" name="btn_telefonia_21" type="button" class="btn btn-light" value="Buscar">
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                        <div id="resultado_tele_21" class="card-content">

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