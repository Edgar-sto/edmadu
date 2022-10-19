<?php

/**Clases necesarias */
require_once '../../class/conexion.php';
require_once '../../class/C.consumo.telefonico.php';

$conexion = conexion_global( '10.9.2.244','soporte','Z3pu0rg','telefonia',);

/**DATOS OBTENIDOS POR METODO POST */
//$carrier_form     = $_POST['carrier'];
echo $date_start_form  = $_POST['fecha_inicio'];
//echo "<br>";
echo $date_end_form    = $_POST['fecha_termino'];

$consumo_por_dia= new C_consumo_telefonico($conexion, $date_start_form, $date_end_form);
$consumo_por_dia->consumoPorCampania();