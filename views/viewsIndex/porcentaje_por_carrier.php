<?php

/**Clases necesarias */
require_once '../../class/conexion.php';
require_once '../../class/prefijos.php';
require_once '../../class/fecha2022.php';
require_once '../../class/ConsumoPorCarrier.php';

$conexion = conexion_local('telefonia', '127.0.0.1');

/**DATOS OBTENIDOS POR METODO POST */
//echo $carrier_form = $_POST['carrier'];
$date_start_form  =  $_POST['fecha_inicio'];
$date_end_form  =  $_POST['fecha_termino'];

?>
<div id="idConsumoPorcentajes" class="tab-pane" style="font-size:9px;">
    <?php
    $total_all_min  =   new ConsumoPorCarrier($conexion, $date_start_form, $date_end_form, all_prefijos);
    $total_all_min->consumo_porcetnaje();
    ?>
</div>
<hr>
<div id="consumoDivididoPorCarrier">
    <div class="table-responsive">
        <table class="table align-items-center" style="font-size: 10px;">
            <thead>
                <tr>
                    <th scope="col">Carrier</th>
                    <th scope="col">Movil</th>
                    <th scope="col">Fijo</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $costoPesos = new ConsumoPorCarrier($conexion, $date_start_form, $date_end_form, all_prefijos);
                $costoPesos->consumoDivididoCarrierMovilFijo();
                ?>
            </tbody>
        </table>
    </div>
</div>