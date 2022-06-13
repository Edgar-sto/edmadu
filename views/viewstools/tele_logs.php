<?php
include_once '../../class/TeleLogs.php';
include_once '../../class/conexion.php';

$fecha = $_POST['date_logs'];
$ip    = $_SERVER['REMOTE_ADDR'];
$conexion = conexion_local('telefonia', '10.9.2.234');

$insertarLogDeConsultas = new TeleLogs($conexion,$fecha,$ip);
$insertarLogDeConsultas->registro_log_por_btn();




?>
<div class="table-responsive">
    <table class="table table-hover" style="font-size: 11px;">
        <thead>
            <tr class="text-center h4 ">
                <th scope="col">Script</th>
                <th scope="col">Estado</th>
                <th scope="col">Fecha del consumo</th>
                <th scope="col">Fecha del registro</th>
            </tr>
        </thead>
        <tbody class="text-right">
                <?php 
                    $insertarLogDeConsultas->busqueda_log();
                ?>
        </tbody>
    </table>
</div>