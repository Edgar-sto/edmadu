<?php

/**Clases necesarias */
require_once '../../class/conexion.php';
require_once '../../class/prefijos.php';
require_once '../../class/fecha2022.php';
require_once '../../class/ConsumoPorDia.php';

$conexion = conexion_local('telefonia', '10.9.2.147');

/**DATOS OBTENIDOS POR METODO POST */
//$carrier_form     = $_POST['carrier'];
$date_start_form  = $_POST['fecha_inicio'];
//echo "<br>";
$date_end_form    = $_POST['fecha_termino'];

?>
<label for="floatingInputValue">Datos por día</label>
<div class="row">
    <div class="col col-lg-12 col-lg-6 col-lg-3 table-responsive">
        <table class="table table-sm table-hover table-borderless" style="font-size:0.625em;">
            <thead class="text-center align-middle">
                <tr class="">
                    <th scope="col" rowspan="2" class="align-middle">Fechas</th>
                    <th scope="col" colspan="2">Marcatel</th>
                    <th scope="col" colspan="2">MCM</th>
                    <th scope="col" colspan="2">Ipcom</th>
                    <th scope="col" colspan="2">Haz</th> 
                </tr>
                <tr class="">
                    <th scope="col">$ Movil</th>
                    <th scope="col">$ Fijo</th>
                    <th scope="col">$ Movil</th>
                    <th scope="col">$ Fijo</th>
                    <th scope="col">$ Movil</th>
                    <th scope="col">$ Fijo</th>
                    <th scope="col">$ Movil</th>
                    <th scope="col">$ Fijo</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $consumo= new ConsumoPorDia($conexion,$date_start_form,$date_end_form,prefijos_individuales_por_carrier);
                    $consumo->desgloseDiario();
                ?>
            </tbody>
        </table>
    </div>
</div>