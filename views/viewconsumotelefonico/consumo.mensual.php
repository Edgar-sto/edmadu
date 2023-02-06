<?php
/**importar archivos necesarios*/
require_once '../../class/conexion.php';
require_once '../../class/C.consumo.fechas.php';
require_once '../../class/consumoMensualClass.php';

$conexion = conexion_global( '10.9.2.244','soporte','Z3pu0rg','telefonia');
$conexion21 = conexion_21('telefonia','10.9.2.21');

/**DATOS OBTENIDOS POR METODO POST */
//$carrier_form     = $_POST['carrier'];
$date_start    =   $_POST['fecha_inicio'];
//echo "<br>";
$date_end      =   $_POST['fecha_termino'];
$carrier       =   $_POST['carrier'];
$consumoMensual=    new consumoMensualClass($conexion,$conexion21,$carrier, $date_start, $date_end);
$consumoMensual->cdrtelefonia();
// $fechasAlDia = new C_consumo_fechas($conexion, $date_start_form, $date_end_form);
// $fechasAlDia->fechasConConsumoPorDias();