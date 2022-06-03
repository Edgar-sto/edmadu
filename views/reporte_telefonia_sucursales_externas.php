<?php
include_once '../class/conexion.php';
include_once '../class/sucursalesExternas.php';


$conexion = conexion_local("telefonia", "10.9.2.234");
$carrier = $_POST['carrier'];
$fecha_inicio = $_POST['fecha_inicio'];
$fecha_termino = $_POST['fecha_termino'];

//$telefonia_consumida = new ReporteTelefoniaMensual($conexion,$carrier,$fecha_inicio,$fecha_termino);
//$telefonia_consumida -> reporte_telefonia();
//DEFINIR PREFIJOS A USAR
if ($carrier == 'marcatel') {
    $prefijos_individuales = array("15", "777");
    $prefijos_junto = "15','777";
} else if ($carrier == 'mcm') {
    $prefijos_individuales = array("11", "999");
    $prefijos_junto = "11','999";
} else if ($carrier == "ipcom") {
    $prefijos_individuales = array("28", "444");
    $prefijos_junto = "28','444";
} else if ($carrier == "hazz") {
    $prefijos_individuales = array("14", "555");
    $prefijos_junto = "14','555";
} else {
    $prefijos_individuales = array("15", "777", "11", "999", "28", "444", "14", "555");
    $prefijos_juntos_minutos = array("15','777','11','999','28','444");
    $prefijos_juntos_segundos = array("14','555");
}

?>

<div class="col-lg-6 col-lg-12 table-responsive" id=" ">
    <h4>Sucursales Externas</h4>
    <hr>
    <?php
        $consumo_externo_hsbc = new SucursalesExternas($conexion,$fecha_inicio,$fecha_termino,$carrier,$prefijos_junto);
        $consumo_externo_hsbc->consumoExternoHsbc();
    ?>
</div>