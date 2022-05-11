<?php

/**Clases necesarias */
require_once '../../class/conexion.php';
require_once '../../class/prefijos.php';
require_once '../../class/fecha2022.php';
require_once '../../class/ConsumoPorCarrier.php';

$conexion = conexion_local('telefonia', '10.9.2.147');

/**DATOS OBTENIDOS POR METODO POST */
echo $carrier_form = $_POST['carrier'];
echo $date_start_form  =  $_POST['fecha_inicio'];
echo $date_end_form  =  $_POST['fecha_termino'];

?>

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
            $costoPesos = new ConsumoPorCarrier($conexion, $date, $date, all_prefijos);
            $costoPesos->consumoDivididoCarrierMovilFijo();
            ?>
        </tbody>
    </table>
</div>