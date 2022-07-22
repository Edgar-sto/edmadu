<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

include_once '/home/crones/sos/conexion.php';
$conexion = conexion_21('telefonia', '10.9.2.21');
$conexionlocal = conexion_local('telefonia', '10.9.2.234');
date_default_timezone_set('America/Mexico_City');
//$fechas = array(/*"01","02","03","04","05","06","07",*/"08"/*,"09","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28"/*,"29","30","31"*/);
//$date="2022-06-29";
$date = new DateTime();
$date->sub(new DateInterval('P1D'));
$date = $date->format('Y-m-d');

 
//echo "Ejecución de Scrip para obtener el consumo en segundos\n";
echo "\n";
echo "---------------------------------------------\n";
echo "-       Consumo de Telefonia Minutos.       -\n";
echo "---------------------------------------------\n";
echo "-           DÍA: ".$date."                 -\n";
echo "---------------------------------------------\n";
echo "1.-Total Por Reporte\n2.-Marcatel.\n3.-MCM.\n4.-Ipcom.\n5.-Haz.\n6.-Consumo Administrativo.\n";
echo "\n";
echo "Ejecutando SCRIPT Consumo total por reporte\n";
echo "... Preparando siguiente Script Marcatel ...\n";

    include_once '/home/crones/telefonia1/total_reporte_cron.php';

echo "\n";
echo "Ejecutando SCRIPT Consumo Marcatel\n";
echo "... Preparando siguiente Script MCM ...\n";

    include_once '/home/crones/telefonia1/marcatel_cron.php';

echo "\n";
echo "Ejecutando SCRIPT Consumo MCM\n";
echo "... Preparando siguiente Script Haz ...\n";

    include_once '/home/crones/telefonia1/mcm_cron.php';

echo "\n";
echo "Ejecutando SCRIPT Consumo Haz\n";
echo "... Preparando siguiente Script Consumo Administrativo ...\n";

    include_once '/home/crones/telefonia1/haz_cron_A.php';
    include_once '/home/crones/telefonia1/haz_cron_B.php';
    include_once '/home/crones/telefonia1/haz_cron_C.php';
    include_once '/home/crones/telefonia1/haz_cron_D.php';
    include_once '/home/crones/telefonia1/haz_cron_E.php';

echo "\n";
echo "Ejecutando SCRIPT Consumo Administrativo\n";
echo "... Preparando siguiente Script Ipcom ...\n";

    include_once '/home/crones/telefonia1/consumo_administrativo.php';

echo "\n";
echo "Ejecutando SCRIPT Consumo Ipcom\n";

    include_once '/home/crones/telefonia1/ipcom_cron.php';
