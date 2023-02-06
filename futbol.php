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

$output = array();
exec("systeminfo | find \"Processor\"", $output);

echo "<h2>Información del procesador</h2>";
echo "<ul>";
foreach ($output as $line) {
    echo "<li>" . $line . "</li>";
}
echo "</ul>";


<!--End content-wrapper-->
<?php
require_once  'views/parte_inferior.php';
?>
