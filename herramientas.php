<?php
require_once 'views/parte_superior.php';
?>
<!-- Start content-wrapper-->
<div class="content-wrapper">
	<div class="container-fluid">
        <!-- GENERADOR DE CONTRASEÑA Y CONVERTIDOR PX A REM-EM -->
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
        <!-- REVISAR EL LOG DE TELEFONIA -->
        <div class="row mt-3">
			<div class="col-lg-6">
				<div class="card">
					<div class="card-body">
					    <div class="card-title"><h4 class="h4">Log's Telefonia</h4></div>
                        <form id="form_logs" method="POST">
                            <table id="tbl_telefonia_21" class="table">
                                <tbody class="text-center form-group">
                                    <tr>
                                        <td>
                                            <div class="form-group">
                                                <label for="input-1">Fecha</label>
                                                <input id="date_logs" name="date_logs" type="date" class="form-control">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <label for="input-1">Botón</label><br>
                                                <input id="btn_logs" name="btn_logs" type="button" class="btn btn-light" value="Buscar">
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                        <div id="resultado_logs" class="card-content">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- NÚMEROS BLOQUEADOS ANA -->
        <div class="row mt-3">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-body">
					    <div class="card-title"><h4 class="h4">Números Ana</h4></div>
                        <form id="form_ana" method="POST">
                            <table id="tbl_ana" class="table">
                                <tbody class="text-center form-group">
                                    <tr>
                                        <td>
                                            <div class="form-group">
                                                <label for="input-1">VICI</label>
                                                <select name="vici" id="vici" class="form-control">
                                                    <?php
                                                        include_once 'class/vicisReportes.php';
                                                        //var_dump($vicis_reportes);
                                                        foreach ($vicis_reportes AS $vc) {
                                                            ?>
                                                            <option value="<?php echo $vc; ?>">10.9.2.<?php echo $vc; ?></option>
                                                            <?php
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="form-group">
                                                <label for="input-1">Número</label>
                                                <input id="numero_ana" name="numero_ana" type="text" class="form-control">
                                            </div>
                                        </td>

                                        <td>
                                            <div class="form-group">
                                                <label for="input-1">Fecha inicio</label>
                                                <input id="date_ana_start" name="date_ana_start" type="date" class="form-control">
                                            </div>
                                        </td>

                                        <td>
                                            <div class="form-group">
                                                <label for="input-1">Fecha final</label>
                                                <input id="date_ana_end" name="date_ana_end" type="date" class="form-control">
                                            </div>
                                        </td>

                                        <td>
                                            <div class="form-group">
                                                <label for="input-1">Botón</label><br>
                                                <input id="btn_numeros_ana" name="btn_numeros_ana" type="button" class="btn btn-light" value="Buscar">
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                        <div id="resultado_ana" class="card-content">

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