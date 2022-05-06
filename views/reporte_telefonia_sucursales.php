<?php
include_once '../class/conexion.php';
include_once '../class/SucursalesInternas.php';


$conexion = conexion_local("telefonia", "127.0.0.1");
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
<!--ESCORZA - REVOLUCION -->
<div class="row">
    <!-- ESCORZA -->
    <div class="col-lg-6 table-responsive" id=" ">
        <h4>Escorza</h4>
        <hr>
        <?php
            $consumo_escorza = new SucursalesInternas($conexion,$fecha_inicio,$fecha_termino,$carrier,$prefijos_junto);
            $consumo_escorza->consumoEscorza();
        ?>
    </div>
    <!--REVOLUCION -->
    <div class="col-lg-6 table-responsive" id=" ">
        <h4>Revolución</h4>
        <hr>
        <?php
            $consumo_revolucion = new SucursalesInternas($conexion,$fecha_inicio,$fecha_termino,$carrier,$prefijos_junto);
            $consumo_revolucion->consumoRevolucion();
        ?>
    </div>
</div>
<br>
<!--TLAJOMULCO - DROP BUZON - ADMINISTRATIVO -->
<div class="row">
    <!--TLAJOMULCO -->
    <div class="col-lg-6 table-responsive" id=" ">
        <h4>Tlajomulco</h4>
        <hr>
        <?php
            $consumo_tlajomulco = new SucursalesInternas($conexion,$fecha_inicio,$fecha_termino,$carrier,$prefijos_junto);
            $consumo_tlajomulco->consumoTlajomulco();
        ?>
    </div>
    <!--DROP BUZON - ADMINISTRATIVO -->
    <div class="col-lg-6 table-responsive" id=" ">
        <div class="row">
            <!--DROP BUZON-->
            <div class="col-lg-12 table-responsive" id=" ">
                <h4>Drop - Buzón</h4>
                <hr>
                <?php
                    $consumo_drop_buzon = new SucursalesInternas($conexion,$fecha_inicio,$fecha_termino,$carrier,$prefijos_junto);
                    $consumo_drop_buzon->consumoDropBuzon();
                ?>
            </div>
            <br>
            <br>
            <!--ADMINISTRATIVO-->
            <div class="col-lg-12 table-responsive" id=" ">
                <h4>Administrativo</h4>
                <hr>
                <?php
                    $consumo_admin = new SucursalesInternas($conexion,$fecha_inicio,$fecha_termino,$carrier,$prefijos_junto);
                    $consumo_admin->consumoAdministrativo();
                ?>
            </div>
        </div>
    </div>
</div>