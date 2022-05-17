<?php

include_once '../../class/GeneradorDePass.php';

$tamanio_pass = $_POST['chars'];

$new_pass = new GeneradorDePass($tamanio_pass);
?>


<div class="alert alert-success">Contraseña generada: 
    <strong>
        <?php echo $new_pass->generatePasswordLevelSeven() ; ?>
    </strong>
</div>