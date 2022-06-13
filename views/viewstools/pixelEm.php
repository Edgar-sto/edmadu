<?php
 include_once '../../class/PixelEm.php';

$pixel = $_POST['tamaniopixel'];

$conversionPixEm = new PixelEm($pixel);
//$conversionPixEm -> convertirPixelEm($pixel);

echo '<div class="alert alert-success">Tamaño en EM: <strong>'.$conversionPixEm -> convertirPixelEm($pixel).'</strong></div>';

?>