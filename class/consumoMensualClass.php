<?php

class consumoMensualClass {

    public function __construct($conexion,$conexion21,$carrier,$date_start,$date_end)
    {
        $this->conexion     =   $conexion;
        $this->conexion21     =   $conexion21;
        $this->carrier      =   $carrier;
        $this->date_start   =   $date_start;
        $this->date_end     =   $date_end;
    }

    public function cdrtelefonia(){
        
        switch ($this->carrier) {
            case 'marcatel':
                $prefijos =  "15','777";
                break;

            case 'mcm':
                $prefijos    =  "11','999";
                break;
            
            default:
                $prefijos     =   "14','555";
                break;
        }
        ?>
            <table class="table"> 
                <thead style="font-size: 1.3rem;">
                    <tr class="table-active">
                        <th scope="col">Reporte</th>
                        <th scope="col" >Carrier</th>
                        <th scope="col" >Campañath>
                        <th scope="col" >Grupo</th>
                        <th scope="col" >Tipo</th>
                        <th scope="col" >Consumo</th>
                    </tr>
                </thead>
                <tbody>
        <?php
                $queryBusquedaReporte = "SELECT DISTINCT SUBSTRING(reporte,8,3) AS reporte from reporte_mensual
                WHERE fecha_inicio>='{$this->date_start} 00:00:00' AND fecha_termino<='{$this->date_end} 23:59:59'
                AND prefijo IN ('{$prefijos}');";
                $answerBusquedaReporte=$this->conexion->query($queryBusquedaReporte);
                while ($a=$answerBusquedaReporte->fetch_object()) {
                    echo $a->reporte."\n";    
                    $queryConsumoTelefonico="SELECT DISTINCT u_server_ip AS reporte, d_carrier_prefix AS carrier, d_campaign_id AS campania, d_user_group AS grupo,
                    IF (d_tipo_numero='movil',
                        IF (d_user_group = '', IF (d_status NOT IN ('NA', 'AA'),'Drop Movil','Buzon Movil'),
                            'Movil'),
                        IF (d_user_group = '', IF (d_status NOT IN ('NA', 'AA'),'Drop Fijo','Buzon Fijo'),
                            'Fijo')
                    ) AS tipo,    
                    SUM(redondea_a_minutos) AS Total
                    FROM reporte_{$a->reporte}
                    WHERE d_carrier_prefix IN ('{$prefijos}')
                    AND u_start_time>='{$this->date_start} 00:00:00'
                    AND u_start_time<='{$this->date_end} 23:59:59'
                    AND c_dialstatus = 'ANSWER'
                    GROUP BY d_carrier_prefix, d_campaign_id,d_user_group, Tipo 
                    ORDER BY d_carrier_prefix, d_campaign_id, d_user_group ASC;";

                    $answerConsumoTelefonico=$this->conexion21->query($queryConsumoTelefonico);
                    while ($rowConsumoTelefonico=$answerConsumoTelefonico->fetch_object()) {
                        ?>
                        <tr>
                             <td><?php echo $rowConsumoTelefonico->reporte;?></td>
                             <td><?php echo $rowConsumoTelefonico->carrier;?></td>
                             <td><?php echo $rowConsumoTelefonico->campania;?></td>
                             <td><?php echo $rowConsumoTelefonico->grupo;?></td>
                             <td><?php echo $rowConsumoTelefonico->tipo;?></td>
                             <td><?php echo $rowConsumoTelefonico->Total;?></td>
                        </tr>
                        <?php
                     }
                }
        ?>   
                </tbody>
            </table>
        <?php
    }
}