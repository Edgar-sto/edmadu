<?php

class ReporteTelefoniaMensual {
    public $conexion;
    public $carrier;
    public $fecha_inicio;
    public $fecha_termino;

    function __construct($conexion,$carrier,$fecha_inicio,$fecha_termino){
        $this->conexion     =   $conexion;
        $this->carrier      =   $carrier;
        $this->f_inicio     =   $fecha_inicio;
        $this->f_termino    =   $fecha_termino;
    }

    function reporte_telefonia() {
        //DEFINIR PREFIJOS A USAR
        if ($this->carrier == 'marcatel') {
            $prefijos_individuales = array("15", "777");
            $prefijos_junto = "15','777";
        } else if ($this->carrier == 'mcm') {
            $prefijos_individuales = array("11", "999");
            $prefijos_junto = "11','999";
        } else if ($this->carrier == "ipcom") {
            $prefijos_individuales = array("28", "444");
            $prefijos_junto = "28','444";
        } else if ($this->carrier == "hazz") {
            $prefijos_individuales = array("14", "555");
            $prefijos_junto = "14','555";
        } else {
            $prefijos_individuales = array("15", "777", "11", "999", "28", "444", "14", "555");
            $prefijos_juntos_minutos = array("15','777','11','999','28','444");
            $prefijos_juntos_segundos = array("14','555");
        }

        $query_reportes = "SELECT DISTINCT reporte FROM reporte_telefonia
            WHERE fecha_inicio>='{$this->f_inicio} 00:00:00' and fecha_termino<='{$this->f_termino} 23:59:59'
            AND prefijo IN ('{$prefijos_junto}') ORDER BY reporte";
        $answer_reportes = $this->conexion->query($query_reportes);
        while($row_reportes=$answer_reportes->fetch_object()){
            $this->carrier;
            $row_reportes->reporte;
            ?>
            <div class="table-responsive-lg">
                <table class="table table-sm table-hover">
                    <thead class="">
                        <tr>
                            <th colspan="7" class="text-center"><?php echo $row_reportes->reporte; ?></th>
                        </tr>
                        <tr>
                            <th scope="col">ID.Campaña</th>
                            <th scope="col">Prefijos</th>
                            <th scope="col">Sucursal</th>
                            <th scope="col">Grupo</th>
                            <th scope="col">Evento</th>
                            <th scope="col">Consumo Movil</th>
                            <th scope="col">Consumo Fijo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $query_consumo = "SELECT DISTINCT reporte,campania,grupo,prefijo,
                            (CASE
                                WHEN tipo = 'movil' THEN 'Movil'
                                WHEN tipo = 'drop_movil' THEN 'Drop Movil'
                                WHEN tipo = 'buzon_movil' THEN 'Buzon Movil'
                                WHEN tipo = 'fijo' THEN 'Fijo'
                                WHEN tipo = 'drop_fijo' THEN 'Drop Fijo'
                                WHEN tipo = 'buzon_fijo' THEN 'Buzon Fijo'
                            END )
                            AS TipoConsumo,
                            SUM(consumo) AS Total
                            FROM reporte_telefonia
                            WHERE fecha_inicio>='2022-03-01 00:00:00'
                            AND fecha_termino<='2022-03-31 23:59:59'
                            AND prefijo IN ('{$prefijos_individuales}')
                            AND reporte = '{$row_reportes->reporte}'
                            GROUP BY reporte,campania,grupo,prefijo,tipo
                            ORDER BY reporte,campania,prefijo DESC;";

                            $answer_consumo = $this->conexion->query($query_consumo);
                            while ($row_consumo=$answer_consumo->fetch_object()) {
                                $row_consumo->reporte;
                                $row_consumo->campania;
                                $row_consumo->grupo;
                                $row_consumo->prefijo;
                                $row_consumo->TipoConsumo;
                                $row_consumo->Total;
                                ?>
                                <tr>
                                    <td><?php echo $row_consumo->campania; ?></td>
                                    <td><?php echo $row_consumo->prefijo;  ?></td>
                                    <td>
                                        <?php
                                            var_dump($row_consumo->grupo);
                                            if ($row_consumo->grupo == "N/A" && $row_consumo->TipoConsumo == "Drop Movil" ) {
                                                $query_sucursal_maquila = "SELECT sucursal,campania FROM sucu_campa_grup WHERE nombre_grupo = '{$this->grupo}' AND tipo='E'" ;
                                                $answer_sucursal_maquilas=$this->conexion->query($query_sucursal_maquila);
                                                while ($row_sucu_maqui=$answer_sucursal_maquilas->fetch_object()){
                                                    $row_sucu_maqui->sucursal;
                                                    $row_sucu_maqui->campania;
                                                    ?>
                                                    <td><?php echo $row_sucu_maqui->sucursal." ".$row_sucu_maqui->campania;  ?></td>
                                                    <?php
                                                }
                                            } else {
                                                $query_sucursal_campania="SELECT sucursal,campania FROM sucu_campa_grup
                                                WHERE nombre_grupo='{$row_consumo->grupo}' GROUP BY sucursal,campania;";
                                                $answer_sucursal_campania=$this->conexion->query($query_sucursal_campania);
                                                while ($row_suc_camp=$answer_sucursal_campania->fetch_object()) {
                                                    $row_suc_camp->sucursal;
                                                    $row_suc_camp->campania;
                                                    ?>
                                                    <td><?php echo $row_suc_camp->sucursal." ".$row_suc_camp->campania;  ?></td>
                                                    <?php
                                                }
                                            }
                                        ?>                                    
                                    </td>
                                    <td><?php  echo $row_consumo->grupo; ?></td>
                                    <td><?php echo $row_consumo->TipoConsumo; ?></td>
                                    <td><?php echo $row_consumo->Total; ?></td>
                                </tr>
                                <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <?php
        }
        
    }
}