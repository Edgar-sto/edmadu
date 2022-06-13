<?php
class SucursalesExternas
{

    public function __construct($conexion, $f_inicio, $f_termino, $carrier, $prefijo)
    {
        $this->conexion     =   $conexion;
        $this->f_inicio     =   $f_inicio;
        $this->f_termino    =   $f_termino;
        $this->carrier      =   $carrier;
        $this->prefijo      =   $prefijo;
    }

    public function consumoExternoHsbc(){
        ?>
        <table class="table table-hover" style="font-size: 10px;">
            <thead class="thead-inverse table-light  text-center">
                <tr>
                    <th class="fs-5" colspan="9"><?php echo $this->carrier; ?></th>
                </tr>
                <tr class="text-right">
                    <th class="text-center"><strong>Campaña</strong></th>
                    <th><strong>Ubicación</strong></th>
                    <th><strong>Tipo</strong></th>
                    <th><strong>Movil</strong></th>
                    <th><strong>Fijo</strong></th>
                    <th><strong>Drop Movil</strong></th>
                    <th><strong>Drop Fijo</strong></th>
                    <th><strong>Buzon Movil</strong></th>
                    <th><strong>Buzon Fijo</strong></th>
                </tr>
            </thead>
            <tbody>
                <?php
                switch ($this->prefijo) {
                    case "15','777":
                        $costo_movil = 0.11;
                        $costo_fijo = 0.04;
                        break;

                    case "28','444":
                        $costo_movil = 0.11;
                        $costo_fijo = 0.04;
                        break;

                    case "11','999":
                        $costo_movil = 0.11;
                        $costo_fijo = 0.05;
                        break;

                    case "14','555":
                        $costo_movil = 0.09 / 60;
                        $costo_fijo = 0.04 / 60;
                        break;
                }
                $centros_externos_hsbc = "SELECT DISTINCT(nombre_grupo),sucursal FROM sucu_campa_grup
                WHERE tipo='E'  ORDER BY sucursal;";
                $answer_ext_hsbc = $this->conexion->query($centros_externos_hsbc);
                while ($row_cons_ext_hsbc = $answer_ext_hsbc->fetch_object()) {
                    $row_cons_ext_hsbc->nombre_grupo;
                    $row_cons_ext_hsbc->sucursal;

                    $search_campania_group="SELECT DISTINCT campania,reporte FROM reporte_telefonia
                    WHERE fecha_inicio>='{$this->f_inicio} 00:00:00' AND fecha_termino<='{$this->f_termino} 23:59:59'
                    AND prefijo IN ('{$this->prefijo}')
                    AND grupo='{$row_cons_ext_hsbc->nombre_grupo}';";
                    $answer_campania_group=$this->conexion->query($search_campania_group);
                    while ($row_cam_group=$answer_campania_group->fetch_object()) {
                        $row_cam_group->campania;
                        $row_cam_group->reporte;
                        
                        if ($row_cam_group->reporte == '10.9.2.41') {
                            $fondo = "table-success";
                        } else {
                            $fondo = "table-active";
                        }

                        if (empty($row_cam_group->campania) || empty($row_cam_group->reporte)){

                        } else {
                            if ($row_cam_group->reporte=='10.9.2.5' || $row_cam_group->reporte == '10.9.2.9' ||     $row_cam_group->reporte=='10.9.2.29' || $row_cam_group->reporte=='10.9.2.40' || $row_cam_group->reporte=='10.9.2.48')
                            {
                                $consumo_maquilas_hsbc = "SELECT
                                (SELECT SUM(consumo) FROM reporte_telefonia
                                WHERE fecha_inicio>='{$this->f_inicio} 00:00:00' AND fecha_termino<='{$this->f_termino} 23:59:59'
                                AND grupo='{$row_cons_ext_hsbc->nombre_grupo}' AND prefijo IN ('{$this->prefijo}') AND tipo='movil' AND campania='{$row_cam_group->campania}' AND reporte='{$row_cam_group->reporte}') AS movil,
                                            
                                (SELECT SUM(consumo) FROM reporte_telefonia
                                WHERE fecha_inicio>='{$this->f_inicio} 00:00:00' AND fecha_termino<='{$this->f_termino} 23:59:59'
                                AND grupo='{$row_cons_ext_hsbc->nombre_grupo}' AND prefijo IN ('{$this->prefijo}') AND tipo='fijo' AND campania='{$row_cam_group->campania}' AND reporte='{$row_cam_group->reporte}') AS fijo,
                                            
                                (SELECT SUM(consumo) FROM reporte_telefonia
                                WHERE fecha_inicio>='{$this->f_inicio} 00:00:00' AND fecha_termino<='{$this->f_termino} 23:59:59'
                                AND grupo='' AND prefijo IN ('{$this->prefijo}') AND tipo='drop_movil' AND campania='{$row_cam_group->campania}' AND reporte='{$row_cam_group->reporte}') AS drop_movil,
                                            
                                (SELECT SUM(consumo) FROM reporte_telefonia
                                WHERE fecha_inicio>='{$this->f_inicio} 00:00:00' AND fecha_termino<='{$this->f_termino} 23:59:59'
                                AND grupo='' AND prefijo IN ('{$this->prefijo}') AND tipo='drop_fijo' AND campania='{$row_cam_group->campania}' AND reporte='{$row_cam_group->reporte}') AS drop_fijo,
                                            
                                            
                                (SELECT SUM(consumo) FROM reporte_telefonia
                                WHERE fecha_inicio>='{$this->f_inicio} 00:00:00' AND fecha_termino<='{$this->f_termino} 23:59:59'
                                AND grupo='' AND prefijo IN ('{$this->prefijo}') AND tipo='buzon_movil' AND campania='{$row_cam_group->campania}' AND reporte='{$row_cam_group->reporte}') AS buzon_movil,
                                             
                                (SELECT SUM(consumo) FROM reporte_telefonia
                                WHERE fecha_inicio>='{$this->f_inicio} 00:00:00' AND fecha_termino<='{$this->f_termino} 23:59:59'
                                AND grupo='' AND prefijo IN ('{$this->prefijo}') AND tipo='buzon_fijo' AND campania='{$row_cam_group->campania}' AND reporte='{$row_cam_group->reporte}') AS buzon_fijo;";
                            } else {
                                $consumo_maquilas_hsbc = "SELECT
                                (SELECT SUM(consumo) FROM reporte_telefonia
                                WHERE fecha_inicio>='{$this->f_inicio} 00:00:00' AND fecha_termino<='{$this->f_termino} 23:59:59'
                                AND grupo='{$row_cons_ext_hsbc->nombre_grupo}' AND prefijo IN ('{$this->prefijo}') AND tipo='movil' AND campania='{$row_cam_group->campania}' AND reporte='{$row_cam_group->reporte}') AS movil,
                                            
                                (SELECT SUM(consumo) FROM reporte_telefonia
                                WHERE fecha_inicio>='{$this->f_inicio} 00:00:00' AND fecha_termino<='{$this->f_termino} 23:59:59'
                                AND grupo='{$row_cons_ext_hsbc->nombre_grupo}' AND prefijo IN ('{$this->prefijo}') AND tipo='fijo' AND campania='{$row_cam_group->campania}' AND reporte='{$row_cam_group->reporte}') AS fijo,
                                            
                                (SELECT SUM(consumo) FROM reporte_telefonia
                                WHERE fecha_inicio>='{$this->f_inicio} 00:00:00' AND fecha_termino<='{$this->f_termino} 23:59:59'
                                AND grupo='N/A' AND prefijo IN ('{$this->prefijo}') AND tipo='drop_movil' AND campania='{$row_cam_group->campania}' AND reporte='{$row_cam_group->reporte}') AS drop_movil,
                                            
                                (SELECT SUM(consumo) FROM reporte_telefonia
                                WHERE fecha_inicio>='{$this->f_inicio} 00:00:00' AND fecha_termino<='{$this->f_termino} 23:59:59'
                                AND grupo='N/A' AND prefijo IN ('{$this->prefijo}') AND tipo='drop_fijo' AND campania='{$row_cam_group->campania}' AND reporte='{$row_cam_group->reporte}') AS drop_fijo,
                                            
                                            
                                (SELECT SUM(consumo) FROM reporte_telefonia
                                WHERE fecha_inicio>='{$this->f_inicio} 00:00:00' AND fecha_termino<='{$this->f_termino} 23:59:59'
                                AND grupo='N/A' AND prefijo IN ('{$this->prefijo}') AND tipo='buzon_movil' AND campania='{$row_cam_group->campania}' AND reporte='{$row_cam_group->reporte}') AS buzon_movil,
                                             
                                (SELECT SUM(consumo) FROM reporte_telefonia
                                WHERE fecha_inicio>='{$this->f_inicio} 00:00:00' AND fecha_termino<='{$this->f_termino} 23:59:59'
                                AND grupo='N/A' AND prefijo IN ('{$this->prefijo}') AND tipo='buzon_fijo' AND campania='{$row_cam_group->campania}' AND reporte='{$row_cam_group->reporte}') AS buzon_fijo;";
                            }
                            $answer_consumo_maquilas_hsbc = $this->conexion->query($consumo_maquilas_hsbc);
                            while ($row_consumo_maq_hsbc=$answer_consumo_maquilas_hsbc->fetch_object()) {
                                $row_consumo_maq_hsbc->movil;
                                $row_consumo_maq_hsbc->fijo;
                                $row_consumo_maq_hsbc->drop_movil;
                                $row_consumo_maq_hsbc->drop_fijo;
                                $row_consumo_maq_hsbc->buzon_movil;
                                $row_consumo_maq_hsbc->buzon_fijo;

                                $movil  =  $row_consumo_maq_hsbc->movil * $costo_movil;
                                $fijo   =  $row_consumo_maq_hsbc->fijo  * $costo_fijo;
                                $drop_movil  =  $row_consumo_maq_hsbc->drop_movil * $costo_movil;
                                $drop_fijo  =  $row_consumo_maq_hsbc->drop_fijo * $costo_fijo;
                                $buzon_movil  =  $row_consumo_maq_hsbc->buzon_movil * $costo_movil;
                                $buzon_fijo  =  $row_consumo_maq_hsbc->buzon_fijo * $costo_fijo;


                                ?>
                                <tr class="text-right">
                                    <td class=" text-center align-content-center <?php echo $fondo?>" rowspan="2"><?php echo $row_cons_ext_hsbc->sucursal; ?></td>
                                    <td class=" text-center"><?php echo $row_cam_group->reporte; ?></td>
                                    <td class=" text-center">Minutos</td>
                                    <td><?php echo number_format($row_consumo_maq_hsbc->movil); ?></td>
                                    <td><?php echo number_format($row_consumo_maq_hsbc->fijo); ?></td>
                                    <td><?php echo number_format($row_consumo_maq_hsbc->drop_movil); ?></td>
                                    <td><?php echo number_format($row_consumo_maq_hsbc->drop_fijo); ?></td>
                                    <td><?php echo number_format($row_consumo_maq_hsbc->buzon_movil); ?></td>
                                    <td><?php echo number_format($row_consumo_maq_hsbc->buzon_fijo); ?></td>
                                </tr>
                                <tr class="text-right">
                                    <td class=" text-center"><?php echo $row_cam_group->campania; ?></td>
                                    <td class=" text-center">$ Pesos</td>
                                    <td><?php echo "$" . number_format($movil, 2); ?></td>
                                    <td><?php echo "$" . number_format($fijo, 2); ?></td>
                                    <td><?php echo "$" . number_format($drop_movil, 2); ?></td>
                                    <td><?php echo "$" . number_format($drop_fijo, 2); ?></td>
                                    <td><?php echo "$" . number_format($buzon_movil, 2); ?></td>
                                    <td><?php echo "$" . number_format($buzon_fijo, 2); ?></td>
                                </tr>
                                <?php
                            }
                        }
                    }
                }
                ?>
            </tbody>
        </table>
        <?php
    }

    public function consumoExternoPorMaquila(){
        
        foreach ($this->prefijo as $carrier => $prefijo) {
            
            switch ($prefijo) {
                case "15','777":
                    $costo_movil = 0.11;
                    $costo_fijo = 0.04;
                    break;
    
                case "28','444":
                    $costo_movil = 0.11;
                    $costo_fijo = 0.04;
                    break;
    
                case "11','999":
                    $costo_movil = 0.11;
                    $costo_fijo = 0.05;
                    break;
    
                case "14','555":
                    $costo_movil = 0.09 / 60;
                    $costo_fijo = 0.04 / 60;
                    break;
            }
            







            $queryUno  =  "SELECT DISTINCT prefijo, campania, grupo, SUM(consumo) AS Total,
            (CASE WHEN tipo = 'movil' THEN 'Movil'
              WHEN tipo = 'drop_movil'  THEN 'Drop Movil'
              WHEN tipo = 'buzon_movil'  THEN 'Buzon Movil'
              WHEN tipo = 'fijo'  THEN 'Fijo'
              WHEN tipo = 'drop_fijo'  THEN 'Drop Fijo'
              WHEN tipo = 'buzon_fijo'  THEN 'Buzon Fijo'
              END ) AS Tipo
            FROM reporte_telefonia
            WHERE prefijo IN ('14','555')
              AND fecha_inicio>='2022-06-02 00:00:00'
              AND fecha_termino<='2022-06-02 23:59:59'
              AND reporte='10.9.2.22'
              GROUP BY prefijo, campania, grupo, tipo,reporte
            ORDER BY prefijo,campania,grupo ASC;";
        ?>
            <table class="table table-hover" style="font-size: 10px;">
                <thead class="thead-inverse table-light  text-center">
                    <tr>
                        <th class="fs-5" colspan="9"><?php echo $carrier; ?></th>
                    </tr>
                    <tr class="text-right">
                        <th class="text-center"><strong>Campaña</strong></th>
                        <th><strong>Ubicación</strong></th>
                        <th><strong>Tipo</strong></th>
                        <th><strong>Movil</strong></th>
                        <th><strong>Fijo</strong></th>
                        <th><strong>Drop Movil</strong></th>
                        <th><strong>Drop Fijo</strong></th>
                        <th><strong>Buzon Movil</strong></th>
                        <th><strong>Buzon Fijo</strong></th>
                    </tr>
                </thead>
            </table>
        <?php
        }//Llave de cierre de foreach carrier-prefijo
    }
}
?>