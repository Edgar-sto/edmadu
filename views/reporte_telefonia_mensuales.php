<?php
include '../class/conexion.php';

include_once '../class/ReporteTelefoniaMensual.php';
include_once '../class/ObtenerSucursal.php';

$conexion = conexion_local("telefonia", "10.9.2.234");
$carrier = $_POST['carrier'];
$fecha_inicio = $_POST['fecha_inicio'];
$fecha_termino = $_POST['fecha_termino'];

switch ($carrier) {
    case 'marcatel':
        $carrier_name           =  "marcatel";
        $prefijos_juntos        =  "15','777";
        $prefijos_individuales  =  array("15", "777");
    break;

    case 'mcm':
        $carrier_name           =  "mcm";             
        $prefijos_juntos        =  "11','999";        
        $prefijos_individuales  =  array("11", "999");
        break;

    case 'ipcom':
        $carrier_name           =  "ipcom";
        $prefijos_juntos        =  "28','444";
        $prefijos_individuales  =  array("28", "444");
        break;
    
    default:
        $carrier_name            =  "haz";
        $prefijos_juntos         =   "14','555";
        $prefijos_individuales   =  array("14", "555");
        break;
}
?>
    <h5><?php echo $carrier_name; ?></h5>
<?php

    $consulta = "SELECT DISTINCT reporte FROM reporte_telefonia
            WHERE fecha_inicio>='{$fecha_inicio} 00:00:00' and fecha_termino<='{$fecha_termino} 23:59:59'
            AND prefijo IN ('{$prefijos_juntos}') ORDER BY reporte";
    $resultado = $conexion->query($consulta);
    while ($row = $resultado->fetch_object()) {
        /**REPORTE */
        $row->reporte;
?>  
    <br>
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
                <th scope="col">Evento</th>
                <th scope="col">Consumo</th>
            </tr>
        </thead>
        <tbody>
            <!-- <tr><td colspan="7"></td></tr> -->
            <?php

                $query  =  "SELECT DISTINCT a.prefijo, a.campania, a.grupo, SUM(consumo) AS Total,
                (CASE WHEN tipo = 'movil' THEN 'Movil'
                  WHEN tipo = 'drop_movil'  THEN 'Drop Movil'
                  WHEN tipo = 'buzon_movil'  THEN 'Buzon Movil'
                  WHEN tipo = 'fijo'  THEN 'Fijo'
                  WHEN tipo = 'drop_fijo'  THEN 'Drop Fijo'
                  WHEN tipo = 'buzon_fijo'  THEN 'Buzon Fijo'
                  END ) AS Tipo
                FROM reporte_telefonia a
                WHERE prefijo IN ('{$prefijos_juntos}')
                  AND fecha_inicio>='{$fecha_inicio} 00:00:00'
                  AND fecha_termino<='{$fecha_termino} 23:59:59'
                  AND reporte='{$row->reporte}'
                  GROUP BY prefijo, campania, grupo, tipo,reporte
                ORDER BY prefijo,campania,grupo ASC;";

                $answer = $conexion->query($query);
                while ($row_answer=$answer->fetch_object()) {
                    $row_answer->prefijo;
                    $row_answer->campania;
                    $row_answer->grupo;
                    $row_answer->Total;
                    $row_answer->Tipo;
                    ?>
                    <tr>
                        <td><?php echo $row_answer->prefijo; ?></td>
                        <td><?php echo $row_answer->campania;?></td>
                        <td>
                            <?php
                            switch ($row_answer->Tipo) {
                                case 'Movil':
                                    $group = new sucursal($conexion,$row_answer->grupo);
                                    $group->obtSucursal();
                                    foreach ($group->obtSucursal() as $sucursalValue) {
                                        echo $sucursalValue." ";
                                    }
                                    break;

                                case 'Fijo':
                                    $group = new sucursal($conexion,$row_answer->grupo);
                                    $group->obtSucursal();
                                    foreach ($group->obtSucursal() as $sucursalValue) {
                                        echo $sucursalValue." ";
                                    }
                                    break;

                                case 'Drop Movil':
                                    echo "DROP MOVIL";
                                    break;

                                case 'Drop Fijo':
                                    echo "DROP FIJO";
                                    break;
                                
                                case 'Buzon Movil':
                                    echo "BUZON MOVIL";
                                    break;

                                case 'Buzon Fijo':
                                    echo "BUZON FIJO";
                                    break;
                            }
                            ?>
                        </td>
                        <td><?php echo $row_answer->grupo;?></td>
                        <td><?php echo $row_answer->Tipo;?></td>
                        <td></td>
                        <td class="text-right"><?php echo number_format($row_answer->Total);?></td>
                    </tr>
                    <?php
                }
            ?>
        </tbody>
    </table>
    </div>
<?php
    }
