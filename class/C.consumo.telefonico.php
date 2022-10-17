<?php

class C_consumo_telefonico
{
    public function __construct($conexion, $fecha_inicio, $fecha_termino)
    {
        $this->conexion     =   $conexion;
        $this->start_date   =   $fecha_inicio;
        $this->end_date     =   $fecha_termino;
    }
    

    //FUNCION USADA EN INDEX FILA UNO
    public function consumoPorCarrier()
    {
        $query_obtener_prefijo=("SELECT carrier,prefijos,costo_movil,costo_fijo FROM telefonia_carrier");
        $answer_obtener_prefijo=$this->conexion->query($query_obtener_prefijo);
        while ($row=$answer_obtener_prefijo->fetch_object()) {
            $row->carrier;
            $row->prefijos;
            $row->costo_movil;
            $row->costo_fijo;

            $query_consumo="SELECT 
            (SELECT
                SUM(consumo) AS total
            FROM reporte_mensual
            WHERE fecha_inicio>='{$this->start_date} 00:00:00'  AND  fecha_termino<='{$this->end_date} 23:59:59'
            AND tipo IN ('movil','Buzon MoviL','Drop MoviL')
            AND prefijo IN ('{$row->prefijos}')) AS movil,
            
            (SELECT
                SUM(consumo) AS total
            FROM reporte_mensual
            WHERE fecha_inicio>='{$this->start_date} 00:00:00'  AND  fecha_termino<='{$this->end_date} 23:59:59'
            AND tipo IN ('fijo','Buzon Fijo','Drop Fijo')
            AND prefijo IN ('{$row->prefijos}')) AS fijo;";
            $answer_consumo=$this->conexion->query($query_consumo);
            while ($rowConsumo=$answer_consumo->fetch_object()) {
                $rowConsumo->movil;
                $rowConsumo->fijo;

                $costomovil = $rowConsumo->movil * $row->costo_movil;
                $costofijo  = $rowConsumo->fijo * $row->costo_fijo;

                $costototal = $costomovil+$costofijo;

                //$porcent=round((($total_for_carrier/$total_consumido)*100),2); 
                ?>
                <tr>
                    <td class="text-uppercase text-left"><?php echo $row->carrier;?></td>
                    <td >
                        <span class="text-left">$</span>
                        <span class="text-right">
                            <?php echo number_format($costomovil,2);?>
                        </span>
                    </td>
                    <td class="text-left">$<span class="text-right"><?php echo number_format($costofijo,2);?></span></td>
                    <td class="text-left">$<span class="text-right"><?php echo number_format($costototal,2);?></span></td>
                </tr>
                <?php
            }
        }
    }

    public function consumoTotal() {
        $query_marcatel="SELECT 
        (SELECT
            SUM(consumo) AS total
        FROM reporte_mensual
        WHERE fecha_inicio>='{$this->start_date} 00:00:00'  AND  fecha_termino<='{$this->end_date} 23:59:59'
        AND tipo IN ('movil','Buzon MoviL','Drop MoviL')
        AND prefijo IN ('15','777')) AS movil,
        
        (SELECT
            SUM(consumo) AS total
        FROM reporte_mensual
        WHERE fecha_inicio>='{$this->start_date} 00:00:00'  AND  fecha_termino<='{$this->end_date} 23:59:59'
        AND tipo IN ('fijo','Buzon Fijo','Drop Fijo')
        AND prefijo IN ('15','777')) AS fijo;";
        $answer_marcatel=$this->conexion->query($query_marcatel);
        while ($rowConsumo=$answer_marcatel->fetch_object()) {
            $rowConsumo->movil;
            $rowConsumo->fijo;
            $costomovilMarcatel = $rowConsumo->movil * 0.11;
            $costofijoMarcatel  = $rowConsumo->fijo * 0.04;
            $costototalMarcatel = $costomovilMarcatel+$costofijoMarcatel;
        }

        $query_mcm="SELECT 
        (SELECT
            SUM(consumo) AS total
        FROM reporte_mensual
        WHERE fecha_inicio>='{$this->start_date} 00:00:00'  AND  fecha_termino<='{$this->end_date} 23:59:59'
        AND tipo IN ('movil','Buzon MoviL','Drop MoviL')
        AND prefijo IN ('11','999')) AS movil,
        
        (SELECT
            SUM(consumo) AS total
        FROM reporte_mensual
        WHERE fecha_inicio>='{$this->start_date} 00:00:00'  AND  fecha_termino<='{$this->end_date} 23:59:59'
        AND tipo IN ('fijo','Buzon Fijo','Drop Fijo')
        AND prefijo IN ('11','999')) AS fijo;";
        $answer_mcm=$this->conexion->query($query_mcm);
        while ($rowConsumo=$answer_mcm->fetch_object()) {
            $rowConsumo->movil;
            $rowConsumo->fijo;
            $costomovilMCM = $rowConsumo->movil * 0.11;
            $costofijoMCM  = $rowConsumo->fijo * 0.05;
            $costototalMCM = $costomovilMCM+$costofijoMCM;
        }

        $query_haz="SELECT 
        (SELECT
            SUM(consumo) AS total
        FROM reporte_mensual
        WHERE fecha_inicio>='{$this->start_date} 00:00:00'  AND  fecha_termino<='{$this->end_date} 23:59:59'
        AND tipo IN ('movil','Buzon MoviL','Drop MoviL')
        AND prefijo IN ('14','555')) AS movil,
        
        (SELECT
            SUM(consumo) AS total
        FROM reporte_mensual
        WHERE fecha_inicio>='{$this->start_date} 00:00:00'  AND  fecha_termino<='{$this->end_date} 23:59:59'
        AND tipo IN ('fijo','Buzon Fijo','Drop Fijo')
        AND prefijo IN ('14','555')) AS fijo;";
        $answer_haz=$this->conexion->query($query_haz);
        while ($rowConsumo=$answer_haz->fetch_object()) {
            $rowConsumo->movil;
            $rowConsumo->fijo;
            $costomovilHaz = $rowConsumo->movil * 0.0015;
            $costofijoHaz  = $rowConsumo->fijo * 0.000666667;
            $costototalHAZ = $costomovilHaz+$costofijoHaz;
        }

        $totalMovilCarriers = $costomovilHaz+$costomovilMarcatel+$costomovilMCM;
        $totalFijoCarriers  = $costofijoHaz+$costofijoMarcatel+$costofijoMCM;
        $total= $totalMovilCarriers + $totalFijoCarriers;

        $porcentMARCATEL=round((($costototalMarcatel/$total)*100),2);
        $porcentMCM=round((($costototalMCM/$total)*100),2);
        $porcentHAZ=round((($costototalHAZ/$total)*100),2);
        $porcentTOTAL=round((($total/$total)*100),2);
        ?>
            <tr>
                <td class="text-uppercase text-left">MARCATEL</td>
                <td class="text-right">$</td>
                <td class="text-right"><?php echo number_format($costomovilMarcatel,2);?></td>
                <td class="text-right">$</td>
                <td class="text-right"><?php echo number_format($costofijoMarcatel,2);?></td>
                <td class="text-right">$</td>
                <td class="text-right"><?php echo number_format($costototalMarcatel,2);?></td>
                <td class="text-right">%</td>
                <td ><?php echo $porcentMARCATEL;?></td>
            </tr>
            <tr>
                <td class="text-uppercase text-left">MCM</td>
                <td class="text-right">$</td>
                <td class="text-right"><?php echo number_format($costomovilMCM,2);?></td>
                <td class="text-right">$</td>
                <td class="text-right"><?php echo number_format($costofijoMCM,2);?></td>
                <td class="text-right">$</td>
                <td class="text-right"><?php echo number_format($costototalMCM,2);?></td>
                <td class="text-right">%</td>
                <td ><?php echo $porcentMCM;?></td>
            </tr>
            <tr>
                <td class="text-uppercase text-left">MCM</td>
                <td class="text-right">$</td>
                <td class="text-right"><?php echo number_format($costomovilHaz,2);?></td>
                <td class="text-right">$</td>
                <td class="text-right"><?php echo number_format($costofijoHaz,2);?></td>
                <td class="text-right">$</td>
                <td class="text-right"><?php echo number_format($costototalHAZ,2);?></td>
                <td class="text-right">%</td>
                <td ><?php echo $porcentHAZ;?></td>
            </tr>
            <tr class="table-active">
                <td class="text-uppercase text-left">Total</td>
                <td class="text-right">$</td>
                <td class="text-right"><?php echo number_format($totalMovilCarriers,2);?></td>
                <td class="text-right">$</td>
                <td class="text-right"><?php echo number_format($totalFijoCarriers,2);?></td>
                <td class="text-right">$</td>
                <td class="text-right"><?php echo number_format($total,2);?></td>
                <td class="text-right">%</td>
                <td ><?php echo $porcentTOTAL;?></td>
            </tr>
        <?php
    }
}