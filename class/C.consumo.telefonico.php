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
            AND tipo IN ('movil','Buzon Movil','Drop Movil')
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
        AND tipo IN ('movil','Buzon Movil','Drop Movil')
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
        AND tipo IN ('movil','Buzon Movil','Drop Movil')
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
        AND tipo IN ('movil','Buzon Movil','Drop Movil')
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
                <td class="text-uppercase text-left">HAZ</td>
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
            <tr class="badge-light w-100" >
                <td colspan="4">Del día:<?php echo $this->start_date;?></td>
                <td colspan="5">Al día: <?php echo $this->end_date;?></td>
            </tr>
        <?php
    }

    public function consumoPorDia() {
        $carriers = array ("marcatel","mcm","haz");

        $query_obtener_dias="SELECT SUBSTRING(fecha_inicio,1,10) AS fecha
                            FROM reporte_mensual
                            WHERE fecha_inicio
                            BETWEEN '{$this->start_date} 00:00:00' AND '{$this->end_date} 23:59:59'
                            GROUP BY fecha";

        $answer_dias=$this->conexion->query($query_obtener_dias);
        while ($row_dias=$answer_dias->fetch_object()) {
            $row_dias->fecha;
            ?>
                <tr>
                <td class="table-active text-center">
                    <strong><?php echo $row_dias->fecha;?></strong>
                </td>                
            <?php
            
            foreach ($carriers AS $carrier){

                $query_carrier="SELECT costo_movil,costo_fijo,prefijos
                                FROM telefonia_carrier
                                WHERE carrier = '{$carrier}'";

                $answer_carrier=$this->conexion->query($query_carrier);
                
                while ($row_carrier=$answer_carrier->fetch_object()) {
                    $row_carrier->costo_movil;
                    $row_carrier->costo_fijo;
                    $row_carrier->prefijos;

                    $query_consumo_diario="SELECT 
                        (SELECT
                            SUM(consumo) AS total
                        FROM reporte_mensual
                        WHERE fecha_inicio>='{$this->start_date} 00:00:00'  AND  fecha_termino<='{$this->end_date} 23:59:59'
                        AND tipo IN ('movil','Buzon Movil','Drop Movil')
                        AND prefijo IN ('{$row_carrier->prefijos}')) AS movil,
                        
                        (SELECT
                            SUM(consumo) AS total
                        FROM reporte_mensual
                        WHERE fecha_inicio>='{$this->start_date} 00:00:00'  AND  fecha_termino<='{$this->end_date} 23:59:59'
                        AND tipo IN ('fijo','Buzon Fijo','Drop Fijo')
                        AND prefijo IN ('{$row_carrier->prefijos}')) AS fijo;";
                        $answer_consumo_diario=$this->conexion->query($query_consumo_diario);
                        while ($row_consumo_diario=$answer_consumo_diario->fetch_object()) {
                            $row_consumo_diario->movil;
                            $row_consumo_diario->fijo;
                            $total_movil_diario=$row_consumo_diario->movil*$row_carrier->costo_movil;
                            $total_fijo_diario=$row_consumo_diario->fijo*$row_carrier->costo_fijo;
                            ?>
                                <td class="text-right"><?php echo "$" . number_format($total_movil_diario,2);?></td>
                                <td class="text-right"><?php echo "$" . number_format($total_fijo_diario,2);?></td>
                            <?php
                        }
                }
            }
            ?>
                </tr>
                <?php
        }

        //TOTAL DEL RANGO DE LAS FECHAS ENVIADAS
        ?>
            <tr>
                <td class="table-active text-center">
                    <strong><?php echo $this->start_date . " al " . $this->end_date;?></strong>
                </td>                
            <?php
            
            foreach ($carriers AS $carrier){

                $query_carrier="SELECT costo_movil,costo_fijo,prefijos
                                FROM telefonia_carrier
                                WHERE carrier = '{$carrier}'";

                $answer_carrier=$this->conexion->query($query_carrier);
                
                while ($row_carrier=$answer_carrier->fetch_object()) {
                    $row_carrier->costo_movil;
                    $row_carrier->costo_fijo;
                    $row_carrier->prefijos;

                    $query_consumo_diario="SELECT 
                        (SELECT
                            SUM(consumo) AS total
                        FROM reporte_mensual
                        WHERE fecha_inicio>='{$this->start_date} 00:00:00'  AND  fecha_termino<='{$this->end_date} 23:59:59'
                        AND tipo IN ('movil','Buzon Movil','Drop Movil')
                        AND prefijo IN ('{$row_carrier->prefijos}')) AS movil,
                        
                        (SELECT
                            SUM(consumo) AS total
                        FROM reporte_mensual
                        WHERE fecha_inicio>='{$this->start_date} 00:00:00'  AND  fecha_termino<='{$this->end_date} 23:59:59'
                        AND tipo IN ('fijo','Buzon Fijo','Drop Fijo')
                        AND prefijo IN ('{$row_carrier->prefijos}')) AS fijo;";
                        $answer_consumo_diario=$this->conexion->query($query_consumo_diario);
                        while ($row_consumo_diario=$answer_consumo_diario->fetch_object()) {
                            $row_consumo_diario->movil;
                            $row_consumo_diario->fijo;
                            $total_movil_diario=$row_consumo_diario->movil*$row_carrier->costo_movil;
                            $total_fijo_diario=$row_consumo_diario->fijo*$row_carrier->costo_fijo;
                            ?>
                                <td class="text-right"><?php echo "$" . number_format($total_movil_diario,2);?></td>
                                <td class="text-right"><?php echo "$" . number_format($total_fijo_diario,2);?></td>
                            <?php
                        }
                }
            }
            ?>
            </tr>
            <?php
    }

    public function desgloseDiaPorDia(){
        $prefijos_individuales = array("15','777", "11','999", "14','555");
        echo $queryFechas="SELECT SUBSTRING(fecha_inicio,1,10) AS fecha FROM reporte_mensual
        WHERE fecha_inicio BETWEEN '{$this->start_date} 00:00:00' AND '{$this->end_date} 23:59:59' AND
        reporte='10.9.2.201' GROUP BY fecha";
        $answerFechas=$this->conexion->query($queryFechas);
        //echo "<br>";
        while ($rowFecha=$answerFechas->fetch_object())
        {
            /**Vasriable con fecha */
            $rowFecha->fecha;
            /*Línea TOTAL por carrier DIA POR DIA rango de fechas */
            ?>
            <tr>
                <td class="table-active text-center">
                    <strong><?php echo $rowFecha->fecha;?></strong>
                </td>                
            <?php
            foreach ($prefijos_individuales as $prefijo)
            {
                switch ($prefijo) {
                    case "15','777":
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
                $queryConsumos="SELECT 
                    (SELECT
                        SUM(consumo) AS total
                    FROM reporte_mensual
                    WHERE fecha_inicio>='{$rowFecha->fecha} 00:00:00'  AND  fecha_termino<='{$rowFecha->fecha} 23:59:59'
                    AND tipo IN ('movil','Buzon Movil','Drop Movil')
                    AND prefijo IN ('{$prefijo}')) AS movil,
                    
                    (SELECT
                        SUM(consumo) AS total
                    FROM reporte_mensual
                    WHERE fecha_inicio>='{$rowFecha->fecha} 00:00:00'  AND  fecha_termino<='{$rowFecha->fecha} 23:59:59'
                    AND tipo IN ('fijo','Buzon Fijo','Drop Fijo')
                    AND prefijo IN ('{$prefijo}')) AS fijo;";

                // echo $queryConsumos = "SELECT
                // (SELECT SUM(consumo) FROM reporte_mensual
                // WHERE fecha_inicio BETWEEN '{$rowFecha->fecha} 00:00:00' AND '{$rowFecha->fecha} 23:59:59'
                // AND prefijo IN ('{$prefijo}') AND tipo IN ('movil','drop_movil','buzon_movil')) AS movil,

                // (SELECT SUM(consumo) FROM reporte_mensual
                // WHERE fecha_inicio BETWEEN '{$rowFecha->fecha} 00:00:00' AND '{$rowFecha->fecha} 23:59:59'
                // AND prefijo IN ('{$prefijo}') AND tipo IN ('fijo','drop_fijo','buzon_fijo')) AS fijo;";
                //echo "<br>";
                $answerConsumo=$this->conexion->query($queryConsumos);
                while ($rowConsumo=$answerConsumo->fetch_object())
                {   
                    $movil= $rowConsumo->movil;
                    $fijo = $rowConsumo->fijo;    
                    
                    $movil_ =   $movil * $costo_movil;
                    $fijo_  =   $fijo  * $costo_fijo;

                ?>
                    <td class="text-right"><?php echo "$" . number_format($movil_,2);?></td>
                    <td class="text-right"><?php echo "$" . number_format($fijo_,2);?></td>
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
                <td class="table-active text-center">
                    <strong><?php echo $this->start_date . " al " . $this->end_date;?></strong>
                </td> 
                <?php
                foreach ($prefijos_individuales as $prefijo)
                {
                    switch ($prefijo) {
                        case "15','777":
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
                    $queryConsumos="SELECT 
                    (SELECT
                        SUM(consumo) AS total
                    FROM reporte_mensual
                    WHERE fecha_inicio>='{$this->start_date} 00:00:00'  AND  fecha_termino<='{$this->end_date} 23:59:59'
                    AND tipo IN ('movil','Buzon Movil','Drop Movil')
                    AND prefijo IN ('{$prefijo}')) AS movil,
                    
                    (SELECT
                        SUM(consumo) AS total
                    FROM reporte_mensual
                    WHERE fecha_inicio>='{$this->start_date} 00:00:00'  AND  fecha_termino<='{$this->end_date} 23:59:59'
                    AND tipo IN ('fijo','Buzon Fijo','Drop Fijo')
                    AND prefijo IN ('{$prefijo}')) AS fijo;";

                    //echo "<br>";
                    $answerConsumo=$this->conexion->query($queryConsumos);
                    while ($rowConsumo=$answerConsumo->fetch_object())
                    {   
                        $movil_= $rowConsumo->movil*$costo_movil;
                        $fijo_ = $rowConsumo->fijo*$costo_fijo;    
                    ?> 
                        <td class="text-right table-active"><?php echo "$" .number_format($movil_,2);?></td>
                        <td class="text-right table-active"><?php echo "$" .number_format($fijo_,2);?></td>
                    <?php
                    }
                }
            ?>
            </tr>
            <?php
    }

    public function consumoPorCampania() {
        $clientes = array('HSBC','INVEX','Santander','Royal Prestige','ExpoChina');
        $carriers = array ("marcatel","mcm","haz");
        foreach ($clientes AS $cliente) {
            switch ($cliente) {
                case 'HSBC':            $fondoCliente="bg-danger-light2";   $fondoCampania="bg-danger"; break;
                case 'INVEX':           $fondoCliente="bg-success-light2";  $fondoCampania="bg-success";break;
                case 'Santander':       $fondoCliente="bg-info-light2";     $fondoCampania="bg-info";   break;
                case 'Royal Prestige':  $fondoCliente="bg-primary-light2";  $fondoCampania="bg-primary";break;
                case 'ExpoChina':       $fondoCliente="bg-warning-light2";  $fondoCampania="bg-warning";break;
            }
            ?>
                <tr class="text-center bg-white text-dark">
                    <td colspan="7">
                        Del día <?php echo $this->start_date ." al dia ".$this->end_date; ?>
                    </td>
                </tr>
                <tr class="text-center <?php echo $fondoCliente?>">
                    <td colspan="7" class="table-active">
                            <?php echo $cliente; ?>
                    </td>
                </tr>
                
            <?php
                $query_cliente="SELECT * FROM campanias_clientes WHERE cliente = '{$cliente}'";
                $answer_cliente=$this->conexion->query($query_cliente);
                while ($row_cliente=$answer_cliente->fetch_object()) {
                    $row_cliente->cliente;
                    $row_cliente->campania;
                    $row_cliente->siglas;
                    $row_cliente->vicis;
                    ?>
                    <tr class="text-left <?php echo $fondoCampania?>">
                        <td colspan="7"><?php echo $row_cliente->campania."(". $row_cliente->siglas.")"?></td>
                    </tr>
                        <tr class="text-lg-center bg-light" style="font-size:medium;">
                            <th scope="col">Carrier</th>
                            <th scope="col" colspan="2">Movil</th>
                            <th scope="col" colspan="2">Fijo</th>
                            <th scope="col" colspan="2">Total</th>
                        </tr>
                        
                        <?php
                        foreach ($carriers as $value) {
                            $query_carrier="SELECT costo_movil,costo_fijo,prefijos
                                    FROM telefonia_carrier
                                    WHERE carrier = '{$value}'";
                            $answer_carrier=$this->conexion->query($query_carrier);
                            while ($consumoCampania=$answer_carrier->fetch_object()) {
                                $consumoCampania->costo_movil;
                                $consumoCampania->costo_fijo;
                                $consumoCampania->prefijos;
                                $queryConsumoCamapania="SELECT 
                                    (SELECT
                                        SUM(consumo) AS total
                                    FROM reporte_mensual
                                    WHERE fecha_inicio>='{$this->start_date} 00:00:00'  AND  fecha_termino<='{$this->end_date} 23:59:59'
                                    AND tipo IN ('movil','Buzon Movil','Drop Movil')
                                    AND reporte IN ('{$row_cliente->vicis}')
                                    AND prefijo IN ('{$consumoCampania->prefijos}')) AS movil,

                                    (SELECT
                                        SUM(consumo) AS total
                                    FROM reporte_mensual
                                    WHERE fecha_inicio>='{$this->start_date} 00:00:00'  AND  fecha_termino<='{$this->end_date} 23:59:59'
                                    AND tipo IN ('fijo','Buzon Fijo','Drop Fijo')
                                    AND reporte IN ('{$row_cliente->vicis}')
                                    AND prefijo IN ('{$consumoCampania->prefijos}')) AS fijo;";
                                $answer_marcatel=$this->conexion->query($queryConsumoCamapania);
                                while ($rowConsumo=$answer_marcatel->fetch_object()) {
                                    $rowConsumo->movil;
                                    $rowConsumo->fijo;
                                    $costomovilCampania = $rowConsumo->movil * $consumoCampania->costo_movil;
                                    $costofijoCampania  = $rowConsumo->fijo * $consumoCampania->costo_fijo;
                                    $costototalCampania = $costomovilCampania+$costofijoCampania;
                                    ?>
                                    <tr>
                                        <td><?php echo  $value;?></td>
                                        <td class="text-right">$</td>
                                        <td><?php echo number_format($costomovilCampania,2);?></td>
                                        <td class="text-right">$</td>
                                        <td><?php echo number_format($costofijoCampania,2);?></td>
                                        <td class="text-right">$</td>
                                        <td><?php echo number_format($costototalCampania,2);?></td>
                                    </tr>
                                    <?php
                                }
                            }
                        }
                        ?>
                    <tr>
                        <td colspan="4"></td>
                    </tr>
                    <?php
                }
                ?>
                
            <?php
        }
    }

    public function consumoPorCampaniaAll() {
        $clientes = array('HSBC','INVEX','Santander','Royal Prestige');
        $carriers = array ("marcatel","mcm","haz");
        
        foreach ($clientes AS $cliente) {

            switch ($cliente) {
                case 'HSBC':
                    $campaniaCliente = array (
                        "MA" => "10.9.2.5','10.9.2.22','10.9.2.27','10.9.2.28','10.9.2.39','10.9.2.48','10.9.2.57','10.9.2.74','10.9.2.76','10.9.2.79",
                        "V-F" => "10.9.2.6','10.9.2.47",
                        "Act" => "10.9.2.15",
                        "CON" => "10.9.2.11",
                        "GA" => "10.9.2.44",
                        "LEC" => "10.9.2.8",
                        "CEC" => "10.9.2.60",
                        "BT" => "10.9.2.45",
                        "PPM" => "10.9.2.201",
                    );
                    $fondoCliente="bg-danger-light2";
                    $fondoCampania="bg-danger";
                    break;
                
                case 'INVEX':
                    $campaniaCliente = array (
                        "MAI" => "10.9.2.37','10.9.2.41",
                        "CEI" => "10.9.2.36"
                    );
                    $fondoCliente="bg-success-light2";
                    $fondoCampania="bg-success";
                    break;
                
                case 'Santander':
                    $campaniaCliente = array (
                        "MAS" => "10.9.2.29"  
                    );
                    $fondoCliente="bg-info-light2";
                    $fondoCampania="bg-info";
                    break;
                    
                case 'Royal Prestige':
                    $campaniaCliente = array (
                        "RP" => "10.9.2.30"
                    );
                    $fondoCliente="bg-primary-light2";
                    $fondoCampania="bg-primary";
                    break;
            } ?>
                <tr class="text-center bg-white text-dark">
                    <td colspan="8">
                        Del día <?php echo $this->start_date ." al dia ".$this->end_date; ?>
                    </td>
                </tr>
                <tr class="text-left <?php echo $fondoCliente?>">
                    <td colspan="8" class="table-active">
                            <?php echo $cliente; ?>
                    </td>
                </tr>
                <tr class="text-center">
                    <td scope="col" class="align-middle">Campaña</td>
                    <td scope="col" >Marcatel</td>
                    <td scope="col" >MCM</td>
                    <td scope="col" >Haz</td>
                    <td scope="col" >Total</td>
                </tr>
            <?php
            foreach ($campaniaCliente as $campania => $vicis) {
                
                $queryConsumo="SELECT 
                (SELECT
                    SUM(consumo*0.11) AS pesos
                FROM reporte_mensual
                WHERE fecha_inicio>='{$this->start_date} 00:00:00'  AND  fecha_termino<='{$this->end_date} 23:59:59'
                AND tipo IN ('movil','Buzon Movil','Drop Movil')
                AND reporte IN ('{$vicis}')
                AND prefijo IN ('15','777')) AS mtel_movil,
                
                (SELECT
                    SUM(consumo*0.04) AS total
                FROM reporte_mensual
                WHERE fecha_inicio>='{$this->start_date} 00:00:00'  AND  fecha_termino<='{$this->end_date} 23:59:59'
                AND tipo IN ('fijo','Buzon Fijo','Drop Fijo')
                AND reporte IN ('{$vicis}')
                AND prefijo IN ('15','777')) AS mtel_fijo,
                
                (SELECT
                    SUM(consumo*0.11) AS pesos
                FROM reporte_mensual
                WHERE fecha_inicio>='{$this->start_date} 00:00:00'  AND  fecha_termino<='{$this->end_date} 23:59:59'
                AND tipo IN ('movil','Buzon Movil','Drop Movil')
                AND reporte IN ('{$vicis}')
                AND prefijo IN ('11','999')) AS mcm_movil,
                
                (SELECT
                    SUM(consumo*0.05) AS total
                FROM reporte_mensual
                WHERE fecha_inicio>='{$this->start_date} 00:00:00'  AND  fecha_termino<='{$this->end_date} 23:59:59'
                AND tipo IN ('fijo','Buzon Fijo','Drop Fijo')
                AND reporte IN ('{$vicis}')
                AND prefijo IN ('11','999')) AS mcm_fijo,
                
                (SELECT
                    SUM(consumo*0.0015) AS total
                FROM reporte_mensual
                WHERE fecha_inicio>='{$this->start_date} 00:00:00'  AND  fecha_termino<='{$this->end_date} 23:59:59'
                AND tipo IN ('movil','Buzon Movil','Drop Movil')
                AND reporte IN ('{$vicis}')
                AND prefijo IN ('14','555')) AS haz_movil,
                
                (SELECT
                    SUM(consumo*0.000666667) AS total
                FROM reporte_mensual
                WHERE fecha_inicio>='{$this->start_date} 00:00:00'  AND  fecha_termino<='{$this->end_date} 23:59:59'
                AND tipo IN ('fijo','Buzon Fijo','Drop Fijo')
                AND reporte IN ('{$vicis}')
                AND prefijo IN ('14','555')) AS haz_fijo;";

                $answerConsumo=$this->conexion->query($queryConsumo);
                while ($rowConsumo=$answerConsumo->fetch_object()){
                    $mtel_movil     =   number_format($rowConsumo->mtel_movil,2);
                    $mtel_fijo      =   number_format($rowConsumo->mtel_fijo,2);
                    $t_mtel         =   $rowConsumo->mtel_movil + $rowConsumo->mtel_fijo;
                    $to_mtel        =   number_format($t_mtel,2);

                    $mcm_movil      =   number_format($rowConsumo->mcm_movil,2);
                    $mcm_fijo       =   number_format($rowConsumo->mcm_fijo,2);
                    $t_mcm          =   $rowConsumo->mcm_movil + $rowConsumo->mcm_fijo;
                    $to_mcm         =   number_format($t_mcm,2);
                    

                    $haz_movil      =   number_format($rowConsumo->haz_movil,2);
                    $haz_fijo       =   number_format($rowConsumo->haz_fijo,2);
                    $t_haz          =   $rowConsumo->haz_movil + $rowConsumo->haz_fijo;
                    $to_haz         =   number_format($t_haz,2);


                    $totalCampanias =   $rowConsumo->mtel_movil+$rowConsumo->mtel_fijo+$rowConsumo->mcm_movil+$rowConsumo->mcm_fijo+$rowConsumo->haz_movil+$rowConsumo->haz_fijo;
                    $totalCam =   number_format($totalCampanias,2);
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
                    // echo "-------------------------------------------------------------------------------------------------------------------------\n";
                    // printf ("|%s\t|$%7s\t|$%7s\t|$%7s\t|$%7s\t|$%7s\t|$%7s\t|$%7s\t|\n",$campania,$mtel_movil,$mtel_fijo,$mcm_movil,$mcm_fijo,$haz_movil,$haz_fijo,$totalCam);
                }   
            }
            // echo "-------------------------------------------------------------------------------------------------------------------------\n";        
            //echo "░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░\n\n";
        }
    }

   
}