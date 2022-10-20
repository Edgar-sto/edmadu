<?php

/**Clases necesarias */
require_once '../../class/conexion.php';
require_once '../../class/C.consumo.fechas.php';

$conexion = conexion_global( '10.9.2.244','soporte','Z3pu0rg','telefonia',);

/**DATOS OBTENIDOS POR METODO POST */
//$carrier_form     = $_POST['carrier'];
$date_start_form  = $_POST['fechaInicialConsumo'];
//echo "<br>";
$date_end_form    = $_POST['fechaFinalConsumo'];

$fechasAlDia = new C_consumo_fechas($conexion, $date_start_form, $date_end_form);
$fechasAlDia->fechasConConsumoPorDias();