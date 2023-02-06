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

// Ejecutar comando de Linux "free -h"
$output = shell_exec('free -h');

// Separar la salida en líneas
$lines = explode("\n", $output);

// Tomar solo la línea 2 y separar en partes
$parts = explode(" ", $lines[1]);

// Eliminar partes vacías
$parts = array_filter($parts, function($value) {
  return !empty($value);
});

// Asignar partes a variables
$total_mem = $parts[1];
$used_mem = $parts[2];
$free_mem = $parts[3];
?>

<!-- Mostrar información en una tabla HTML ordenada -->
<table>
  <tr>
    <th>Memoria total</th>
    <td><?php echo $total_mem; ?></td>
  </tr>
  <tr>
    <th>Memoria utilizada</th>
    <td><?php echo $used_mem; ?></td>
  </tr>
  <tr>
    <th>Memoria libre</th>
    <td><?php echo $free_mem; ?></td>
  </tr>
</table>

<!--End content-wrapper-->
<?php
require_once  'views/parte_inferior.php';
?>
