<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

date_default_timezone_set('America/Mexico_City');
//$date="2022-04-15";
$dia = new DateTime();
$dia->sub(new DateInterval('P1D'));
$dia = $dia->format('Y-m-d'); //Datos a guardar date('Y-m-d')
if (
    //ENERO
    $dia == "2022-01-09" || $dia == "2022-01-16" || $dia == "2022-01-23" || $dia == "2022-01-30" ||
    //FEBRERO
    $dia == "2022-02-06" || $dia == "2022-02-13" || $dia == "2022-02-20" || $dia == "2022-02-27" ||
    //MARZO
    $dia == "2022-03-06" || $dia == "2022-03-13" || $dia == "2022-03-20" || $dia == "2022-03-27" ||
    //ABRIL
    $dia == "2022-04-03" || $dia == "2022-04-10" || $dia == "2022-04-17" || $dia == "2022-04-24" ||
    //MAYO
    $dia == "2022-05-01" || $dia == "2022-05-08" || $dia == "2022-05-15" || $dia == "2022-05-22" || $dia == "2022-05-29" || 
    //JUNIO
    $dia == "2022-06-05" || $dia == "2022-06-12" || $dia == "2022-06-19" || $dia == "2022-06-26" ||
    //JULIO
    $dia == "2022-07-03" || $dia == "2022-07-10" || $dia == "2022-07-17" || $dia == "2022-07-24" || $dia == "2022-07-31" ||
    //AGOSTO
    $dia == "2022-08-07" || $dia == "2022-08-14" || $dia == "2022-08-21" || $dia == "2022-08-28" ||
    //SEPTIEMBRE
    $dia == "2022-09-04" || $dia == "2022-09-11" || $dia == "2022-09-18" || $dia == "2022-09-25" ||
    //OCTUBRE
    $dia == "2022-10-02" || $dia == "2022-10-09" || $dia == "2022-10-16" || $dia == "2022-10-23" || $dia == "2022-10-30" ||
    //NOVIEMBRE
    $dia == "2022-11-06" || $dia == "2022-11-13" || $dia == "2022-11-20" || $dia == "2022-11-27" || 
    //DICIEMBRE
    $dia == "2022-12-04" || $dia == "2022-12-11" || $dia == "2022-12-18" || $dia == "2022-12-25"
) {
    $date = new DateTime();
    $date->sub(new DateInterval('P2D'));
    $date = $date->format('Y-m-d');
} else { // format failed
    $date = new DateTime();
    $date->sub(new DateInterval('P1D'));
    $date = $date->format('Y-m-d');
}
?>