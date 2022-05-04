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
						<!-- <div class="row"> -->
						<?php
                            function generatePassword($length)
                            {
                                $key = "";
                                $pattern = "1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
                                //$pattern = "1234567890abcdefghijklmñnopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ.-_*/=[]{}#@|~¬&()?¿";
                                $max = strlen($pattern)-1;
                                for($i = 0; $i < $length; $i++){
                                    $key .= substr($pattern, mt_rand(0,$max), 1);
                                }
                                return $key;
                            }

                            if (isset($_POST['submitChars'])) {
                                $length = (int)$_POST['chars'];
                                echo '<div class="alert alert-success">Contraseña generada: <strong>'.generatePassword($length).'</strong></div>';
                            }
                        ?>
                        <form action="herramientas.php" method="post">
                            <div class="form-group">
                                <label for="chars">Número de caracteres</label>
                                <input class="form-control" type="text" name="chars" value="8" maxlength="1">
                                <small id="emailHelp" class="form-text text-muted">Introduce un número de caracteres para generar la contraseña.</small>
                            </div>                
                            <button type="submit" name="submitChars" class="btn btn-primary">Enviar</button>
                        </form>
						<!-- </div> -->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
require_once  'views/parte_inferior.php';
?>