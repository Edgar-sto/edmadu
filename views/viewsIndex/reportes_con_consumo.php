<?php

/**Clases necesarias */
require_once '../../class/conexion.php';
require_once '../../class/prefijos.php';
require_once '../../class/fecha2022.php';
require_once '../../class/ConsumoPorCarrier.php';

$conexion = conexion_local('telefonia', '10.9.2.147');

/**DATOS OBTENIDOS POR METODO POST */
//echo $carrier_form = $_POST['carrier'];
$date_start_form  =  $_POST['fecha_inicio'];
$date_end_form  =  $_POST['fecha_termino'];

?>

<div id="reporte_mtel" class="tab-pane active" role="tabpanel">
    <h6 class="tab-header text-center">
        <small class="badge badge-sm float-center badge-light">
            Del Día <?php echo $date_start_form; ?> al día <?php echo $date_end_form; ?> en Minutos
        </small>
    </h6>
    <div class="table-responsive" style="overflow-x: scroll; scrollbar-width: none; -ms-overflow-style: none;">
        <table class="table table-sm" style="font-size:8px;">
            <thead>
                <tr>
                    <th scope="col">Reporte</th>
                    <th scope="col">Movil</th>
                    <th scope="col">Fijo</th>
                    <th scope="col">Total</th>
                </tr>
            </thead>
            <tbody class="text-right">
                <?php
                $reporte_mtel = new ConsumoPorCarrier($conexion, $date_start_form, $date_end_form, prefijos_marcatel);
                $reporte_mtel->distribucion_por_reportes();
                ?>
            </tbody>
        </table>
    </div>
</div>

<div id="reporte_mcm" class="tab-pane" role="tabpanel">
    <h6 class="tab-header text-center">
        <small class="badge badge-sm float-center badge-light">
            Del Día <?php echo $date_start_form; ?> al día <?php echo $date_end_form; ?> en Minutos
        </small>
    </h6>
    <div class="table-responsive" style="overflow-x: scroll; scrollbar-width: none; -ms-overflow-style: none;">
        <table class="table table-sm" style="font-size:8px;">
            <thead>
                <tr>
                    <th scope="col">Reporte</th>
                    <th scope="col">Movil</th>
                    <th scope="col">Fijo</th>
                    <th scope="col">Total</th>
                </tr>
            </thead>
            <tbody class="text-right">
                <?php
                $reporte_mcm = new ConsumoPorCarrier($conexion, $date_start_form, $date_end_form, prefijos_mcm);
                $reporte_mcm->distribucion_por_reportes();
                ?>
            </tbody>
        </table>
    </div>
</div>

<div id="reporte_ipcom" class="tab-pane" role="tabpanel">
    <h6 class="tab-header text-center">
        <small class="badge badge-sm float-center badge-light">
            Del Día <?php echo $date_start_form; ?> al día <?php echo $date_end_form; ?> en Minutos
        </small>
    </h6>
    <div class="table-responsive" style="overflow-x: scroll; scrollbar-width: none; -ms-overflow-style: none;">
        <table class="table table-sm" style="font-size:8px;">
            <thead>
                <tr>
                    <th scope="col">Reporte</th>
                    <th scope="col">Movil</th>
                    <th scope="col">Fijo</th>
                    <th scope="col">Total</th>
                </tr>
            </thead>
            <tbody class="text-right">
                <?php
                $reporte_ipcom = new ConsumoPorCarrier($conexion, $date_start_form, $date_end_form, prefijos_ipcom);
                $reporte_ipcom->distribucion_por_reportes();
                ?>
            </tbody>
        </table>
    </div>
</div>

<div id="reporte_haz" class="tab-pane" role="tabpanel">
    <h6 class="tab-header text-center">
        <small class="badge badge-sm float-center badge-light">
            Del Día <?php echo $date_start_form; ?> al día <?php echo $date_end_form; ?> en Segundos
        </small>
    </h6>
    <div class="table-responsive" style="overflow-x: scroll; scrollbar-width: none; -ms-overflow-style: none;">
        <table class="table table-sm" style="font-size:8px;">
            <thead>
                <tr>
                    <th scope="col">Reporte</th>
                    <th scope="col">Movil</th>
                    <th scope="col">Fijo</th>
                    <th scope="col">Total</th>
                </tr>
            </thead>
            <tbody class="text-right">
                <?php
                $reporte_haz = new ConsumoPorCarrier($conexion, $date_start_form, $date_end_form, prefijos_haz);
                $reporte_haz->distribucion_por_reportes();
                ?>
            </tbody>
        </table>
    </div>
</div>