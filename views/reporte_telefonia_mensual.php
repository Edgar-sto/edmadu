<?php
include '../class/conexion.php';
include_once '../class/ReporteTelefoniaMensual.php';
include_once '../class/ObtenerSucursal.php';

$conexion = conexion_global("10.9.2.244","soporte","Z3pu0rg","telefonia");
$conexion21 = conexion_21("telefonia", "10.9.2.21");
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
// $tam_prefijo = count($prefijos);
// for ($i=0; $i < $tam_prefijo; $i++) { 
//     $prefix=$prefijos[$i];

//foreach ($prefijos_junto as $prefix){

    $consulta = "SELECT DISTINCT reporte, SUBSTRING(reporte,8,3) as reporte2  FROM reporte_mensual
            WHERE fecha_inicio>='{$fecha_inicio} 00:00:00' and fecha_termino<='{$fecha_termino} 23:59:59'
            AND prefijo IN ('{$prefijos_junto}') ORDER BY reporte";
    $resultado = $conexion->query($consulta);
    while ($row = $resultado->fetch_object()) {
        /**REPORTE */
        $row->reporte."\n";
        $row->reporte2;

        // $group = new sucursal($conexion,$nombre_grupo);
        //                                         $group->obtSucursal();
        //                                         foreach ($group->obtSucursal() as $sucursalValue) {
        //                                             echo $sucursalValue." ";
        //                                         }
    ?>  
    <div class="table-responsive-lg">
        <table class="table table-hover" style="font-size: 11px;">
            <thead>
                <tr>
                    <th colspan="7" class="text-center h4 table-light"><?php echo $row->reporte; ?></th>
                </tr>
                <tr>
                    <th scope="col">Prefijos</th>
                    <th scope="col">ID.Campaña</th>
                    <th scope="col">Sucursal</th>
                    <th scope="col">Grupo</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Consumo</th>
                </tr>
            </thead>
            <tbody class="text-right">
                <tr><td colspan="7"></td></tr>
                <?php  
                $queryConsumo="SELECT DISTINCT d_carrier_prefix,d_campaign_id, d_user_group,
                    IF (d_tipo_numero='movil',
                        IF (d_user_group = '', IF (d_status NOT IN ('NA', 'AA'),'Drop MoviL','Buzon MoviL'),
                    'Movil'),
                        IF (d_user_group = '', IF (d_status NOT IN ('NA', 'AA'),'Drop Fijo','Buzon Fijo'),
                    'Fijo')) AS Tipo,
                    SUM(redondea_a_minutos) AS Total
                    FROM reporte_{$row->reporte2}
                    WHERE d_carrier_prefix IN ('{$prefijos_junto}')
                    AND u_start_time>='{$fecha_inicio} 00:00:00'
                    AND u_start_time<='{$fecha_termino} 23:59:59'
                    AND c_dialstatus = 'ANSWER'
                    GROUP BY d_carrier_prefix,d_campaign_id,d_user_group, Tipo 
                    ORDER BY d_carrier_prefix,d_campaign_id, d_user_group ASC;";
                $answerConsumo=$conexion21->query($queryConsumo);
                while ($rowConsumo=$answerConsumo->fetch_object()) {
                    echo $rowConsumo->d_carrier_prefix."\n";
                    echo $rowConsumo->d_campaign_id."\n";
                    echo $rowConsumo->d_user_group."\n";
                    echo $rowConsumo->Tipo."\n";
                    echo $rowConsumo->Total."\n";
                    ?>
<tr class="text-right">
                        <td class="text-center"><?php echo $campania; ?></td>
                        <!-- <td>$<?php echo $mtel_movil; ?></td>
                        <td>$<?php echo $mtel_fijo; ?></td> -->
                        <td>$<?php echo $to_mtel; ?></td>

                        <!-- <td>$<?php echo $mcm_movil; ?></td>
                        <td>$<?php echo $mcm_fijo; ?></td> -->
                        <td>$<?php echo $to_mcm; ?></td>

                        <!-- <td>$<?php echo $haz_movil; ?></td>
                        <td>$<?php echo $haz_fijo; ?></td> -->
                        <td>$<?php echo $to_haz; ?></td>

                        <td>$<?php echo $totalCam; ?></td>
                    </tr>

                    <?php
                }
                ?>            
            </tbody>
        </table>
    </div>
    <?php
}
