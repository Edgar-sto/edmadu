<?php 

class ConsumoPorDia {

    public function __construct($conexion,$start_date,$end_date,$prefijos)
    {
        $this->conexion =   $conexion;
        $this->start_date =   $start_date;
        $this->end_date =  $end_date;
        $this->prefijo = $prefijos;
    }

    public function desgloseDiario(){
        $queryFechas="SELECT SUBSTRING(fecha_inicio,1,10) AS fecha FROM reporte_telefonia
        WHERE fecha_inicio BETWEEN '{$this->start_date} 00:00:00' AND '{$this->end_date} 23:59:59' GROUP BY fecha";
        $answerFechas=$this->conexion->query($queryFechas);
        //echo "<br>";
        while ($rowFecha=$answerFechas->fetch_object())
        {
            /**Vasriable con fecha */
            $rowFecha->fecha;
            /*Línea TOTAL por carrier DIA POR DIA rango de fechas */
            ?>
            <tr>
                <td class="table-active">
                    <strong><?php echo $rowFecha->fecha;?></strong>
                </td>                
            <?php
            foreach ($this->prefijo as $prefijo)
            {
                switch ($prefijo) {
                    case "15','777":
                        $costo_movil=0.11;
                        $costo_fijo=0.04;
                        break;

                    case "28','444":
                        $costo_movil=0.11;
                        $costo_fijo=0.04;
                        break;
                    
                    case "11','999":
                        $costo_movil=0.11;
                        $costo_fijo=0.05;
                        break;
                    
                    default:
                        $costo_movil_haz=0.09/60;
                        $costo_fijo_haz=0.04/60;
                        
                        $costo_movil= $costo_movil_haz;
                        $costo_fijo=  $costo_fijo_haz;
                        break;
                }
                $queryConsumos = "SELECT
                (SELECT SUM(consumo) FROM reporte_telefonia
                WHERE fecha_inicio BETWEEN '{$rowFecha->fecha} 00:00:00' AND '{$rowFecha->fecha} 23:59:59'
                AND prefijo IN ('{$prefijo}') AND tipo IN ('movil','drop_movil','buzon_movil')) AS movil,

                (SELECT SUM(consumo) FROM reporte_telefonia
                WHERE fecha_inicio BETWEEN '{$rowFecha->fecha} 00:00:00' AND '{$rowFecha->fecha} 23:59:59'
                AND prefijo IN ('{$prefijo}') AND tipo IN ('fijo','drop_fijo','buzon_fijo')) AS fijo;";
                //echo "<br>";
                $answerConsumo=$this->conexion->query($queryConsumos);
                while ($rowConsumo=$answerConsumo->fetch_object())
                {   
                    $movil= $rowConsumo->movil;
                    $fijo = $rowConsumo->fijo;    
                    
                    $movil_ =   $movil * $costo_movil;
                    $fijo_  =   $fijo  * $costo_fijo;

                ?>
                    <td class=""><?php echo number_format($movil,2);?></td>
                    <td class=""><?php echo number_format($fijo,2);?></td>
                    <td class=""><?php echo "$" . number_format($movil_,2);?></td>
                    <td class=""><?php echo "$" . number_format($fijo_,2);?></td>
                <?php
                }
            }
            ?>
            </tr>
            <?php
        }
        /*Línea TOTAL por carrier FECHA INCIAL A FECHA TERMINAL */
        ?>
            <tr>
                <td class="table-active">
                    <strong><?php echo $this->start_date . " al " . $this->end_date;?></strong>
                </td> 
                <?php
                foreach ($this->prefijo as $prefijo)
                {
                    switch ($prefijo) {
                        case "15','777":
                            $costo_movil=0.11;
                            $costo_fijo=0.04;
                            break;
    
                        case "28','444":
                            $costo_movil=0.11;
                            $costo_fijo=0.04;
                            break;
                        
                        case "11','999":
                            $costo_movil=0.11;
                            $costo_fijo=0.05;
                            break;
                        
                        default:
                            $costo_movil_haz=0.09/60;
                            $costo_fijo_haz=0.04/60;
                            
                            $costo_movil= $costo_movil_haz;
                            $costo_fijo=  $costo_fijo_haz;
                            break;
                    }
                    $queryConsumos = "SELECT
                    (SELECT SUM(consumo) FROM reporte_telefonia
                    WHERE fecha_inicio>='{$this->start_date} 00:00:00' AND fecha_inicio<='{$this->end_date} 23:59:59'
                    AND prefijo IN ('{$prefijo}') AND tipo IN ('movil','drop_movil','buzon_movil')) AS movil,

                    (SELECT SUM(consumo) FROM reporte_telefonia
                    WHERE fecha_inicio>='{$this->start_date} 00:00:00' AND fecha_inicio<='{$this->end_date} 23:59:59'
                    AND prefijo IN ('{$prefijo}') AND tipo IN ('fijo','drop_fijo','buzon_fijo')) AS fijo;";
                    //echo "<br>";
                    $answerConsumo=$this->conexion->query($queryConsumos);
                    while ($rowConsumo=$answerConsumo->fetch_object())
                    {   
                        $movil_= $rowConsumo->movil*$costo_movil;
                        $fijo_ = $rowConsumo->fijo*$costo_fijo;    
                    ?> 
                        <td class=""><?php echo number_format($rowConsumo->movil,2);?></td>
                        <td class=""><?php echo number_format($rowConsumo->fijo,2);?></td>
                        <td class=""><?php echo "$" .number_format($movil_,2);?></td>
                        <td class=""><?php echo "$" .number_format($fijo_,2);?></td>
                    <?php
                    }
                }
            ?>
            </tr>
            <?php
    }

}