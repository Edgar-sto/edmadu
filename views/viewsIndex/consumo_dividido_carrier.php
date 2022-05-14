<?php

/**Clases necesarias */
require_once '../../class/conexion.php';
require_once '../../class/prefijos.php';
require_once '../../class/fecha2022.php';
require_once '../../class/ConsumoPorCarrier.php';

$conexion = conexion_local('telefonia', '10.9.2.147');

/**DATOS OBTENIDOS POR METODO POST */
//$carrier_form     = $_POST['carrier'];
$date_start_form  = $_POST['fecha_inicio'];
//echo "<br>";
$date_end_form    = $_POST['fecha_termino'];

?>
<!-- <div class="container">
    <h6 class="tab-header text-left"> -->
        <!-- ** Agregar Algoritmo para mostrar las fechas correctas al seleccionarlas ** -->
        <!-- <small class="badge badge-sm float-center badge-light">
            Información del día <?php echo $date_start_form; ?> al <?php echo $date_end_form; ?>
        </small>
    </h6>
</div> -->

<!-- MARCATEL -->
<div class="col-12 col-lg-6 col-sm-3 table-responsive xy-hiden">
    <!-- <div class="card-body text-center"> -->
    <table class="table table-sm" style="font-size: 0.6em;">
        <thead class="text-center align-middle">
            <tr class="">
                <th scope="col" colspan="3">
                    <h4>Marcatel</h4>
                </th>
            </tr>
            <tr>
                <th scope="col">Tipo</th>
                <th scope="col">Minutos</th>
                <th scope="col">Pesos</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $consumo_marcatel = new ConsumoPorCarrier($conexion, $date_start_form, $date_end_form, prefijos_marcatel);
            $consumo_marcatel->consumoDividido();
            ?>
        </tbody>
    </table>
    <!-- </div> -->
</div>
<!-- MCM -->
<div class="col-12 col-lg-6 col-sm-3 table-responsive xy-hiden">
    <!-- <div class="card-body"> -->
    <table class="table table-sm" style="font-size: 0.6em;">
        <thead class="text-center align-middle">
            <tr class="">
                <th scope="col" colspan="3">
                    <h4>MCM</h4>
                </th>
            </tr>
            <tr>
                <th scope="col">Tipo</th>
                <th scope="col">Minutos</th>
                <th scope="col">Pesos</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $consumo_marcatel = new ConsumoPorCarrier($conexion, $date_start_form, $date_end_form, prefijos_mcm);
            $consumo_marcatel->consumoDividido();
            ?>
        </tbody>
    </table>
    <!-- </div> -->
</div>
<!-- IPCOM -->
<div class="col-12 col-lg-6 col-sm-3 table-responsive xy-hiden">
    <!-- <div class="card-body"> -->
    <table class="table table-sm" style="font-size: 0.6em;">
        <thead class="text-center align-middle">
            <tr class="">
                <th scope="col" colspan="3">
                    <h4>Ipcom</h4>
                </th>
            </tr>
            <tr>
                <th scope="col">Tipo</th>
                <th scope="col">Minutos</th>
                <th scope="col">Pesos</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $consumo_marcatel = new ConsumoPorCarrier($conexion, $date_start_form, $date_end_form, prefijos_ipcom);
            $consumo_marcatel->consumoDividido();
            ?>
        </tbody>
    </table>
    <!-- </div> -->
</div>
<!-- HAZ -->
<div class="col-12 col-lg-6 col-sm-3 table-responsive xy-hiden">
    <!-- <div class="card-body"> -->
    <table class="table table-sm" style="font-size: 0.6em;">
        <thead class="text-center align-middle">
            <tr class="">
                <th scope="col" colspan="3">
                    <h4>Haz</h4>
                </th>
            </tr>
            <tr>
                <th scope="col">Tipo</th>
                <th scope="col">Minutos</th>
                <th scope="col">Pesos</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $consumo_marcatel = new ConsumoPorCarrier($conexion, $date_start_form, $date_end_form, prefijos_haz);
            $consumo_marcatel->consumoDividido();
            ?>
        </tbody>
    </table>
</div>
