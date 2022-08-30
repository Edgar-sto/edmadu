<?php

/**Clases necesarias */
require_once '../../class/conexion.php';
require_once '../../class/prefijos.php';
require_once '../../class/fecha2022.php';
require_once '../../class/SucursalesInternas.php';

$conexion = conexion_local('telefonia', '127.0.0.1');

/**DATOS OBTENIDOS POR METODO POST */
//$carrier_form     = $_POST['carrier'];
$date_start_form  = $_POST['fecha_inicio'];
//echo "<br>";
$date_end_form    = $_POST['fecha_termino'];

?>

<!--ESCORZA - REVOLUCION -->
<div class="row">
    <!-- ESCORZA -->
    <div class="col-lg-12 table-responsive xy-hiden" id=" ">
        <h4 class="card-header">Escorza</h4>
        <hr>
        <div class="row">
            <div class="col-sm-6 col">
                <!--Marcatel -->
                <?php
                $consumo_escorza_mtel = new SucursalesInternas($conexion, $date_start_form, $date_end_form, carrier_mtel, prefijos_marcatel);
                $consumo_escorza_mtel->consumoEscorza();
                ?>
            </div>
            <div class="col-sm-6 col">
                <!--MCM -->
                <?php
                $consumo_escorza_mcm = new SucursalesInternas($conexion, $date_start_form, $date_end_form, carrier_mcm, prefijos_mcm);
                $consumo_escorza_mcm->consumoEscorza();
                ?>
            </div>
            <div class="col-sm-6 col">
                <!--Ipcom -->
                <?php
                $consumo_escorza_ipcom = new SucursalesInternas($conexion, $date_start_form, $date_end_form, carrier_ipcom, prefijos_ipcom);
                $consumo_escorza_ipcom->consumoEscorza();
                ?>
            </div>
            <div class="col-sm-6 col">
                <!--Haz -->
                <?php
                $consumo_escorza_haz = new SucursalesInternas($conexion, $date_start_form, $date_end_form, carrier_haz, prefijos_haz);
                $consumo_escorza_haz->consumoEscorza();
                ?>
            </div>
        </div>
    </div>
    <!--REVOLUCION -->
    <div class="col-lg-12 table-responsive xy-hiden" id=" ">
        <h4 class="card-header">Revolución</h4>
        <hr>
        <div class="row">
            <div class="col-sm-6 col">
                <!--Marcatel -->
                <?php
                $consumo_revolucion_mtel = new SucursalesInternas($conexion, $date_start_form, $date_end_form, carrier_mtel, prefijos_marcatel);
                $consumo_revolucion_mtel->consumoRevolucion();
                ?>
            </div>
            <div class="col-sm-6 col">
                <!--MCM -->
                <?php
                $consumo_revolucion_mcm = new SucursalesInternas($conexion, $date_start_form, $date_end_form, carrier_mcm, prefijos_mcm);
                $consumo_revolucion_mcm->consumoRevolucion();
                ?>
            </div>
            <div class="col-sm-6 col">
                <!--Ipcom -->
                <?php
                $consumo_revolucion_ipcom = new SucursalesInternas($conexion, $date_start_form, $date_end_form, carrier_ipcom, prefijos_ipcom);
                $consumo_revolucion_ipcom->consumoRevolucion();
                ?>
            </div>
            <div class="col-sm-6 col">
                <!--Haz -->
                <?php
                $consumo_revolucion_haz = new SucursalesInternas($conexion, $date_start_form, $date_end_form, carrier_haz, prefijos_haz);
                $consumo_revolucion_haz->consumoRevolucion();
                ?>
            </div>
        </div>
    </div>
</div>
<br>
<!--TLAJOMULCO - DROP BUZON - ADMINISTRATIVO -->
<div class="row">
    <!--TLAJOMULCO -->
    <div class="col-lg-12 table-responsive xy-hiden" id=" ">
        <h4 class="card-header">Tlajomulco</h4>
        <hr>
        <div class="row">
            <div class="col-sm-6 col">
                <!--Marcatel -->
                <?php
                $consumo_tlajomulco_mtel = new SucursalesInternas($conexion, $date_start_form, $date_end_form, carrier_mtel, prefijos_marcatel);
                $consumo_tlajomulco_mtel->consumoTlajomulco();
                ?>
            </div>
            <div class="col-sm-6 col">
                <!--MCM -->
                <?php
                $consumo_tlajomulco_mcm = new SucursalesInternas($conexion, $date_start_form, $date_end_form, carrier_mcm, prefijos_mcm);
                $consumo_tlajomulco_mcm->consumoTlajomulco();
                ?>
            </div>
            <div class="col-sm-6 col">
                <!--Ipcom -->
                <?php
                $consumo_tlajomulco_ipcom = new SucursalesInternas($conexion, $date_start_form, $date_end_form, carrier_ipcom, prefijos_ipcom);
                $consumo_tlajomulco_ipcom->consumoTlajomulco();
                ?>
            </div>
            <div class="col-sm-6 col">
                <!--Haz -->
                <?php
                $consumo_tlajomulco_haz = new SucursalesInternas($conexion, $date_start_form, $date_end_form, carrier_haz, prefijos_haz);
                $consumo_tlajomulco_haz->consumoTlajomulco();
                ?>
            </div>
        </div>
    </div>
    <!--DROP BUZON - ADMINISTRATIVO -->
    <div class="col-lg-12 table-responsive" id=" ">
        <div class="row">
            <!--DROP BUZON-->
            <div class="col-lg-12 table-responsive xy-hiden" id=" ">
                <h4 class="card-header">Drop - Buzón</h4>
                <hr>
                <div class="row">
                    <div class="col-sm-6 col">
                        <!--Marcatel -->
                        <?php
                        $consumo_drop_buzon_mtel = new SucursalesInternas($conexion, $date_start_form, $date_end_form, carrier_mtel, prefijos_marcatel);
                        $consumo_drop_buzon_mtel->consumoDropBuzon();
                        ?>
                    </div>
                    <div class="col-sm-6 col">
                        <!--MCM -->
                        <?php
                        $consumo_drop_buzon_mcm = new SucursalesInternas($conexion, $date_start_form, $date_end_form, carrier_mcm, prefijos_mcm);
                        $consumo_drop_buzon_mcm->consumoDropBuzon();
                        ?>
                    </div>
                    <div class="col-sm-6 col">
                        <!--Ipcom -->
                        <?php
                        $consumo_drop_buzon_ipcom = new SucursalesInternas($conexion, $date_start_form, $date_end_form, carrier_ipcom, prefijos_ipcom);
                        $consumo_drop_buzon_ipcom->consumoDropBuzon();
                        ?>
                    </div>
                    <div class="col-sm-6 col">
                        <!--Haz -->
                        <?php
                        $consumo_drop_buzon_haz = new SucursalesInternas($conexion, $date_start_form, $date_end_form, carrier_haz, prefijos_haz);
                        $consumo_drop_buzon_haz->consumoDropBuzon();
                        ?>
                    </div>
                </div>
            </div>
            <br>
            <br>
            <!--ADMINISTRATIVO-->
            <div class="col-lg-12 table-responsive xy-hiden" id=" ">
                <h4 class="card-header">Administrativo</h4>
                <hr>
                <div class="row">
                    <div class="col-sm-6 col">
                        <!--Marcatel -->
                        <?php
                        $consumo_admin_mtel = new SucursalesInternas($conexion, $date_start_form, $date_end_form, carrier_mtel, prefijos_marcatel);
                        $consumo_admin_mtel->consumoAdministrativo();
                        ?>
                    </div>
                    <div class="col-sm-6 col">
                        <!--MCM -->
                        <?php
                        $consumo_admin_mcm = new SucursalesInternas($conexion, $date_start_form, $date_end_form, carrier_mcm, prefijos_mcm);
                        $consumo_admin_mcm->consumoAdministrativo();
                        ?>
                    </div>
                    <div class="col-sm-6 col">
                        <!--Ipcom -->
                        <?php
                        $consumo_admin_ipcom = new SucursalesInternas($conexion, $date_start_form, $date_end_form, carrier_ipcom, prefijos_ipcom);
                        $consumo_admin_ipcom->consumoAdministrativo();
                        ?>
                    </div>
                    <div class="col-sm-6 col">
                        <!--Haz -->
                        <?php
                        $consumo_admin_haz = new SucursalesInternas($conexion, $date_start_form, $date_end_form, carrier_haz, prefijos_haz);
                        $consumo_admin_haz->consumoAdministrativo();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>