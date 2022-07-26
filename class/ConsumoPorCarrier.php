<?php

class ConsumoPorCarrier
{

    public function __construct($conexion, $fecha_inicio, $fecha_termino, $carrier)
    {
        $this->conexion     =   $conexion;
        $this->start_date   =   $fecha_inicio;
        $this->end_date     =   $fecha_termino;
        $this->carrier      =   $carrier;
    }

    public function consumoDividido()
    {
        switch ($this->carrier) {
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
        if ($this->carrier == "14','555") {
            $query_consumo = "SELECT SUM(consumo) AS Total,
            (CASE WHEN tipo = 'movil' THEN 'Movil'
                 WHEN tipo = 'drop_movil'  THEN 'Drop Movil'
                WHEN tipo = 'buzon_movil'  THEN 'Buzon Movil'
                WHEN tipo = 'fijo'  THEN 'Fijo'
                WHEN tipo = 'drop_fijo'  THEN 'Drop Fijo'
                WHEN tipo = 'buzon_fijo'  THEN 'Buzon Fijo'
            END ) AS Tipo
            FROM reporte_telefonia WHERE prefijo IN ('{$this->carrier}')
            AND fecha_inicio>='{$this->start_date} 00:00:00'
            AND fecha_termino<='{$this->end_date} 23:59:59'
            GROUP BY tipo
            ORDER BY tipo DESC;";

            $answer_consumo = $this->conexion->query($query_consumo);
            while ($row_consumo = $answer_consumo->fetch_object()) {
                $total_ = $row_consumo->Total;
                $tipo_  = $row_consumo->Tipo;
                
                switch ($tipo_) {
                    case 'Movil':
                            $total_pss  =  $total_ * $costo_movil;
                        break;
                    case 'Drop Movil':
                        $total_pss  =  $total_ * $costo_movil;
                        break;
                    case 'Buzon Movil':
                        $total_pss  =  $total_ * $costo_movil;
                        break;
                    case 'Fijo':
                        $total_pss  =  $total_ * $costo_fijo;
                        break;
                    case 'Drop Fijo':
                        $total_pss  =  $total_ * $costo_fijo;
                        break;
                    case 'Buzon Fijo':
                        $total_pss  =  $total_ * $costo_fijo;
                        break;
                }
                ?>
                <tr>
                    <td><?php echo $tipo_; ?></td>
                    <td class="text-right"><?php echo number_format($total_ / 60); ?></td>
                    <td class="text-right"><?php echo "$ ".number_format($total_pss,2); ?></td>
                </tr>
                <?php
            }
        } else {
            $query_consumo = "SELECT SUM(consumo) AS Total,
            (CASE WHEN tipo = 'movil' THEN 'Movil'
                 WHEN tipo = 'drop_movil'  THEN 'Drop Movil'
                WHEN tipo = 'buzon_movil'  THEN 'Buzon Movil'
                WHEN tipo = 'fijo'  THEN 'Fijo'
                WHEN tipo = 'drop_fijo'  THEN 'Drop Fijo'
                WHEN tipo = 'buzon_fijo'  THEN 'Buzon Fijo'
            END ) AS Tipo
            FROM reporte_telefonia WHERE prefijo IN ('{$this->carrier}')
            AND fecha_inicio>='{$this->start_date} 00:00:00'
            AND fecha_termino<='{$this->end_date} 23:59:59'
            GROUP BY tipo
            ORDER BY tipo DESC;";

            $answer_consumo = $this->conexion->query($query_consumo);
            while ($row_consumo = $answer_consumo->fetch_object()) {
                $total_ = $row_consumo->Total;
                $tipo_  = $row_consumo->Tipo;
                switch ($tipo_) {
                    case 'Movil':
                            $total_pss  =  $total_ * $costo_movil;
                        break;
                    case 'Drop Movil':
                        $total_pss  =  $total_ * $costo_movil;
                        break;
                    case 'Buzon Movil':
                        $total_pss  =  $total_ * $costo_movil;
                        break;
                    case 'Fijo':
                        $total_pss  =  $total_ * $costo_fijo;
                        break;
                    case 'Drop Fijo':
                        $total_pss  =  $total_ * $costo_fijo;
                        break;
                    case 'Buzon Fijo':
                        $total_pss  =  $total_ * $costo_fijo;
                        break;
                }
            ?>
                <tr>
                    <td><?php echo $row_consumo->Tipo; ?></td>
                    <td class="text-right"><?php echo number_format($row_consumo->Total); ?></td>
                    <td class="text-right"><?php echo "$ ".number_format($total_pss,2); ?></td>
                </tr>
            <?php
            }
        }
    }

    public function consumoDivididoCarrierMovilFijo()
    {
        $query_consumo_pesos = "SELECT
        (SELECT SUM(consumo) FROM reporte_telefonia
            WHERE fecha_inicio>='{$this->start_date} 00:00:00' AND fecha_termino<='{$this->end_date} 23:59:59'
            AND tipo IN ('movil','drop_movil','buzon_movil') AND prefijo IN ('15','777') )
            AS mtel_movil,

        (SELECT SUM(consumo) FROM reporte_telefonia
            WHERE fecha_inicio>='{$this->start_date} 00:00:00' AND fecha_termino<='{$this->end_date} 23:59:59'
            AND tipo IN ('fijo','drop_fijo','buzon_fijo') AND prefijo IN ('15','777') )
            AS mtel_fijo,
        
        (SELECT SUM(consumo) FROM reporte_telefonia
            WHERE fecha_inicio>='{$this->start_date} 00:00:00' AND fecha_termino<='{$this->end_date} 23:59:59'
            AND tipo IN ('movil','drop_movil','buzon_movil') AND prefijo IN ('11','999') )
            AS mcm_movil,
        
        (SELECT SUM(consumo) FROM reporte_telefonia
            WHERE fecha_inicio>='{$this->start_date} 00:00:00' AND fecha_termino<='{$this->end_date} 23:59:59'
            AND tipo IN ('fijo','drop_fijo','buzon_fijo') AND prefijo IN ('11','999') )
            AS mcm_fijo,
        
        (SELECT SUM(consumo) FROM reporte_telefonia
            WHERE fecha_inicio>='{$this->start_date} 00:00:00' AND fecha_termino<='{$this->end_date} 23:59:59'
            AND tipo IN ('movil','drop_movil','buzon_movil') AND prefijo IN ('28','444') )
            AS ipcom_movil,

        (SELECT SUM(consumo) FROM reporte_telefonia
         WHERE fecha_inicio>='{$this->start_date} 00:00:00' AND fecha_termino<='{$this->end_date} 23:59:59'
            AND tipo IN ('fijo','drop_fijo','buzon_fijo') AND prefijo IN ('28','444')
        ) AS ipcom_fijo,
        
        (SELECT SUM(consumo) FROM reporte_telefonia
        WHERE fecha_inicio>='{$this->start_date} 00:00:00' AND fecha_termino<='{$this->end_date} 23:59:59'
            AND tipo IN ('movil','drop_movil','buzon_movil') AND prefijo IN ('14','555') )
            AS haz_movil,
        
        (SELECT SUM(consumo) FROM reporte_telefonia
        WHERE fecha_inicio>='{$this->start_date} 00:00:00' AND fecha_termino<='{$this->end_date} 23:59:59'
            AND tipo IN ('fijo','drop_fijo','buzon_fijo') AND prefijo IN ('14','555') )
        AS haz_fijo;";

        $answer_consumo_pesos = $this->conexion->query($query_consumo_pesos);
        while ($row_consumo_pesos = $answer_consumo_pesos->fetch_object()) {
            $row_consumo_pesos->mtel_movil;
            $row_consumo_pesos->mtel_fijo;
            $row_consumo_pesos->mcm_movil;
            $row_consumo_pesos->mcm_fijo;
            $row_consumo_pesos->ipcom_movil;
            $row_consumo_pesos->ipcom_fijo;
            $row_consumo_pesos->haz_movil;
            $row_consumo_pesos->haz_fijo;

            $costo_movil     = 0.11;
            $costo_fijo      = 0.04;
            $costo_fijo_mcm  = 0.05;
            $costo_movil_haz = 0.09/60;
            $costo_fijo_haz  = 0.04/60;

            $pesos_mtel_movil = $row_consumo_pesos->mtel_movil  * $costo_movil;
            $pesos_mtel_fijo  = $row_consumo_pesos->mtel_fijo   * $costo_fijo;
            $pesos_mcm_movil  = $row_consumo_pesos->mcm_movil   * $costo_movil;
            $pesos_mcm_fijo   = $row_consumo_pesos->mcm_fijo    * $costo_fijo_mcm;
            $pesos_ipcom_movil= $row_consumo_pesos->ipcom_movil * $costo_movil;
            $pesos_ipcom_fijo = $row_consumo_pesos->ipcom_fijo  * $costo_fijo;
            $pesos_haz_movil  = $row_consumo_pesos->haz_movil   * $costo_movil_haz;
            $pesos_haz_fijo   = $row_consumo_pesos->haz_fijo    * $costo_fijo_haz;
            ?>
            <tr>
                <td>
                    <svg class="icon icon-tabler icon-tabler-phone" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" />
                    </svg></i> Marcatel
                </td>
                <td class="text-right"><?php echo "$ ".number_format($pesos_mtel_movil,2); ?></td>
                <td class="text-right"><?php echo "$ ".number_format($pesos_mtel_fijo,2); ?></td>
            </tr>
            <tr>
                <td>
                    <svg class="icon icon-tabler icon-tabler-phone" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" />
                    </svg></i> MCM
                </td>
                <td class="text-right"><?php echo "$ ".number_format($pesos_mcm_movil,2); ?></td>
                <td class="text-right"><?php echo "$ ".number_format($pesos_mcm_fijo,2); ?></td>
            </tr>
            <tr>
                <td>
                    <svg class="icon icon-tabler icon-tabler-phone" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" />
                    </svg></i> Ipcom
                </td>
                <td class="text-right"><?php echo "$ ".number_format($pesos_ipcom_movil,2); ?></td>
                <td class="text-right"><?php echo "$ ".number_format($pesos_ipcom_fijo,2); ?></td>
            </tr>
            <tr>
                <td>
                    <svg class="icon icon-tabler icon-tabler-phone" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" />
                    </svg></i> Haz
                </td>
                <td class="text-right"><?php echo "$ ".number_format($pesos_haz_movil,2); ?></td>
                <td class="text-right"><?php echo "$ ".number_format($pesos_haz_fijo,2); ?></td>
            </tr>
            <?php
        }
    }

    public function consumoMovilFijoUnido()
    {
        if ($this->carrier == "15','777" || $this->carrier == "28','444") {
            $costo_movil = 0.11;
            $costo_fijo = 0.04;
        }
        if ($this->carrier == "11','999") {
            $costo_movil = 0.11;
            $costo_fijo = 0.05;
        } else {
            $costo_movil = 0.09 / 60;
            $costo_fijo = 0.04 / 60;
        }

        if ($this->carrier == "14','555") {
            $query_consumo_total = "SELECT
            (SELECT SUM(consumo) FROM reporte_telefonia
            WHERE fecha_inicio>='{$this->start_date} 00:00:00' AND fecha_termino<='{$this->end_date} 23:59:59'
            AND tipo IN ('movil','drop_movil','buzon_movil') AND prefijo IN ('{$this->carrier}')) AS movil,

            (SELECT SUM(consumo) FROM reporte_telefonia
            WHERE fecha_inicio>='{$this->start_date} 00:00:00' AND fecha_termino<='{$this->end_date} 23:59:59'
            AND tipo IN ('fijo','drop_fijo','buzon_fijo') AND prefijo IN ('{$this->carrier}')) AS fijo;";

            $ans_consumo = $this->conexion->query($query_consumo_total);

            while ($row_consumo = $ans_consumo->fetch_object()) {
                $haz_movil = $row_consumo->movil / 60;
                $haz_fijo = $row_consumo->fijo / 60;

                echo $suma_m_f = $haz_movil + $haz_fijo;



                //echo number_format($suma_m_f);
            }
        } else {
            $query_consumo_total = "SELECT
            (SELECT SUM(consumo) FROM reporte_telefonia
            WHERE fecha_inicio>='{$this->start_date} 00:00:00' AND fecha_termino<='{$this->end_date} 23:59:59'
            AND tipo IN ('movil','drop_movil','buzon_movil') AND prefijo IN ('{$this->carrier}')) AS movil,

            (SELECT SUM(consumo) FROM reporte_telefonia
            WHERE fecha_inicio>='{$this->start_date} 00:00:00' AND fecha_termino<='{$this->end_date} 23:59:59'
            AND tipo IN ('fijo','drop_fijo','buzon_fijo') AND prefijo IN ('{$this->carrier}')) AS fijo;";

            $ans_consumo = $this->conexion->query($query_consumo_total);

            while ($row_consumo = $ans_consumo->fetch_object()) {
                // $carrier_movil  = $row_consumo->movil * $costo_movil;
                // $carrier_fijo   = $row_consumo->fijo * $costo_fijo;
                $row_consumo->movil;
                $row_consumo->fijo;
                echo $suma_m_f_ = $row_consumo->movil + $row_consumo->fijo;
                //echo number_format($suma_m_f);
            }
        }
    }

    public function distribucion_por_reportes()
    {
        switch ($this->carrier) {
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
        $query_obt_cam = "SELECT DISTINCT reporte FROM reporte_telefonia
        WHERE fecha_inicio>='{$this->start_date} 00:00:00' AND fecha_termino<='{$this->end_date} 23:59:59'
        AND prefijo IN ('{$this->carrier}') ORDER BY reporte;";

        $ans_cam = $this->conexion->query($query_obt_cam);
        while ($row_camp = $ans_cam->fetch_object()) {
            $row_camp->reporte;
            $query_obt_con = " SELECT
            (SELECT SUM(consumo) FROM reporte_telefonia
            WHERE fecha_inicio>='{$this->start_date} 00:00:00' AND fecha_termino<='{$this->end_date} 23:59:59'
            AND tipo IN ('movil','drop_movil','buzon_movil') AND reporte='{$row_camp->reporte}' AND prefijo IN ('{$this->carrier}')) AS movil,
            (SELECT SUM(consumo) FROM reporte_telefonia
            WHERE fecha_inicio>='{$this->start_date} 00:00:00' AND fecha_termino<='{$this->end_date} 23:59:59'
            AND tipo IN ('fijo','drop_fijo','buzon_fijo') AND reporte='{$row_camp->reporte}' AND prefijo IN ('{$this->carrier}') ) AS fijo;";

            $reportes_carrier = array();
            $ans_consumo = $this->conexion->query($query_obt_con);
            while ($row_consumo = $ans_consumo->fetch_object()) {
                $row_consumo->movil;
                $row_consumo->fijo;
                $row_total = $row_consumo->movil + $row_consumo->fijo;

                $movil_pesos = $row_consumo->movil * $costo_movil;
                $fijo_pesos  = $row_consumo->fijo  * $costo_fijo;
                $total_pesos = $movil_pesos + $fijo_pesos;

                //array_push($reportes_carrier,$row_camp->reporte,$row_consumo->movil,$row_consumo->fijo,$row_total);
                ?>
                <tr>
                    <!-- <td>
                        <img src="assets/images/avatars/vicidial.jpg" alt="Logo Vicidial" class="pull-left rounded-circle" style="width:10%; height:5vh;"/>
                    </td> -->
                    <td style="font-size:1.05em;" class="text-left">
                        <strong><?php echo $row_camp->reporte; ?></strong>
                    </td>
                    <td>
                        <?php echo "$ ".number_format($movil_pesos,2); ?>
                    </td>
                    <td>
                        <?php echo "$ ".number_format($fijo_pesos,2); ?>
                    </td>
                    <td>
                        <?php echo "$ ".number_format($total_pesos,2); ?>
                    </td>
                </tr>
                <?php
            }   
        }
        //return $reportes_carrier;
    }

    public function consumo_porcetnaje()
    {
        $all_prefijos_min   =   "15','777','11','999','28','444";
        $all_prefijos_seg   =   "14','555";
        $all_prefijos_mini      =   array(
            'Marcatel'    =>  "15','777",
            'MCM'         =>  "11','999",
            'Ipcom'       =>  "28','444");
        $all_prefijos_segu      =   array(
            'Haz'         =>  "14','555");


        $query_consumo_total_min = "SELECT
            (SELECT SUM(consumo) FROM reporte_telefonia
            WHERE fecha_inicio>='{$this->start_date} 00:00:00' AND fecha_termino<='{$this->end_date} 23:59:59'
            AND tipo IN ('movil','drop_movil','buzon_movil') AND prefijo IN ('{$all_prefijos_min}')) AS movil,
            (SELECT SUM(consumo) FROM reporte_telefonia
            WHERE fecha_inicio>='{$this->start_date} 00:00:00' AND fecha_termino<='{$this->end_date} 23:59:59'
            AND tipo IN ('fijo','drop_fijo','buzon_fijo') AND prefijo IN ('{$all_prefijos_min}')) AS fijo;";
            $ans_consumo = $this->conexion->query($query_consumo_total_min);
            while ($row_consumo = $ans_consumo->fetch_object()) 
            {
                $costo_movil=0.11;
                $costo_fijo=0.04;

                $movil = $row_consumo->movil * $costo_movil;
                $fijo = $row_consumo->fijo  * $costo_fijo;
                $suma_m_f = $movil + $fijo;
            }
        $query_consumo_total_seg = "SELECT
            (SELECT SUM(consumo) FROM reporte_telefonia
            WHERE fecha_inicio>='{$this->start_date} 00:00:00' AND fecha_termino<='{$this->end_date} 23:59:59'
            AND tipo IN ('movil','drop_movil','buzon_movil') AND prefijo IN ('{$all_prefijos_seg}')) AS movil,
            (SELECT SUM(consumo) FROM reporte_telefonia
            WHERE fecha_inicio>='{$this->start_date} 00:00:00' AND fecha_termino<='{$this->end_date} 23:59:59'
            AND tipo IN ('fijo','drop_fijo','buzon_fijo') AND prefijo IN ('{$all_prefijos_seg}')) AS fijo;";
            $ans_consumo = $this->conexion->query($query_consumo_total_seg);
            while ($row_consumo = $ans_consumo->fetch_object()) {

                $costo_movil_haz=0.09/60;
                $costo_fijo_haz=0.04/60;
                    
                $costo_movil= $costo_movil_haz;
                $costo_fijo=  $costo_fijo_haz;

                $movil = $row_consumo->movil * $costo_movil;
                $fijo = $row_consumo->fijo  * $costo_fijo;
                $suma_m_f_seg = $movil + $fijo;
            }

        $total_consumido    = $suma_m_f + $suma_m_f_seg;
        $total_consumido_   = number_format($total_consumido,2);
        ?>
        <h6 class="tab-header text-center">
		    <small class="badge badge-sm float-center badge-light">
                De  <?php echo $this->start_date;?>  al  <?php echo $this->end_date;?>
			</small>
		</h6>
        <div class="table-responsive">
			<table class="table table-sm"> 
				<thead>
					<tr>
						<th scope="col">Total General:</th>
						<th scope="col" colspan="2"><?php echo "$".$total_consumido_;?></th>
					</tr>
                    <tr>
						<th scope="col">Carrier</th>
						<th scope="col">Porcentaje</th>
						<th scope="col">Grafico</th>
					</tr>
				</thead>
				<tbody>
                <?php
                foreach ($all_prefijos_mini as $name_carrier => $prefijos) {
                    $query_for_carrier  = "SELECT
                        (SELECT SUM(consumo) FROM reporte_telefonia
                        WHERE fecha_inicio>='{$this->start_date} 00:00:00' AND fecha_termino<='{$this->end_date} 23:59:59'
                        AND tipo IN ('movil','drop_movil','buzon_movil') AND prefijo IN ('{$prefijos}')) AS movil,  
                        (SELECT SUM(consumo) FROM reporte_telefonia
                        WHERE fecha_inicio>='{$this->start_date} 00:00:00' AND fecha_termino<='{$this->end_date} 23:59:59'
                        AND tipo IN ('fijo','drop_fijo','buzon_fijo') AND prefijo IN ('{$prefijos}')) AS fijo;";
                    $ans_query_for_carrier = $this->conexion->query($query_for_carrier);
                    while ($row_for_carrier = $ans_query_for_carrier->fetch_object()) {
                        switch ($prefijos) {
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
                        }

                        $movil_all= $row_for_carrier->movil * $costo_movil;
                        $fijo_all = $row_for_carrier->fijo  * $costo_fijo;
                        $total_for_carrier= $movil_all+$fijo_all;

                        $porcent=round((($total_for_carrier/$total_consumido)*100),2);                
                        ?>
                        <tr>
                            <td><?php echo $name_carrier?></td>
                            <td class="text-right"><?php echo $porcent;?>%</td>
                            <td>
                                <div class="progress" style="height: 15px;">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" style="height: 15px; width:<?php echo $porcent;?>%"></div>
                                </div>
                            </td>
                        </tr>
                        <?php
                    }//Llave de cierre while FOR CARRIER
                }//Llave de cierre del forearch
                foreach ($all_prefijos_segu as $name_carrier => $prefijos) {
                    $query_for_carrier  = "SELECT
                        (SELECT SUM(consumo) FROM reporte_telefonia
                        WHERE fecha_inicio>='{$this->start_date} 00:00:00' AND fecha_termino<='{$this->end_date} 23:59:59'
                        AND tipo IN ('movil','drop_movil','buzon_movil') AND prefijo IN ('{$prefijos}')) AS movil,  
                        (SELECT SUM(consumo) FROM reporte_telefonia
                        WHERE fecha_inicio>='{$this->start_date} 00:00:00' AND fecha_termino<='{$this->end_date} 23:59:59'
                        AND tipo IN ('fijo','drop_fijo','buzon_fijo') AND prefijo IN ('{$prefijos}')) AS fijo;";
                    $ans_query_for_carrier = $this->conexion->query($query_for_carrier);
                    while ($row_for_carrier = $ans_query_for_carrier->fetch_object()) {
        
                        $costo_movil_haz=0.09/60;
                        $costo_fijo_haz=0.04/60;
        
                        $movil_haz = $row_for_carrier->movil * $costo_movil_haz;
                        $fijo_haz = $row_for_carrier->fijo  * $costo_fijo_haz;
                        
                        $total_for_carrier=$movil_haz + $fijo_haz;
        
                        $porcent=round((($total_for_carrier/$total_consumido)*100),2); 
                        ?>
                        <tr>
                            <td><?php echo $name_carrier?></td>
                            <td class="text-right"><?php echo $porcent;?>%</td>
                            <td>
                                <div class="progress" style="height: 15px;">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" style="height: 15px; width:<?php echo $porcent;?>%"></div>
                                </div>
                            </td>
                        </tr>
                        <?php
                    }//Llave de cierre while FOR CARRIER
                }//Llave de cierre del forearch
            ?>
				</tbody>
			</table>
		</div>
        <?php
    }

    public function consumoMovilFijo()
    {
        //TOTAL CONSUMIDO GENERAL CON TODOS LOS CARRIER
        //echo $this->carrier;
        $query_consumo_pesos = "SELECT
            (SELECT SUM(consumo) FROM reporte_telefonia
                WHERE fecha_inicio>='{$this->start_date} 00:00:00' AND fecha_termino<='{$this->end_date} 23:59:59'
                AND tipo IN ('movil','drop_movil','buzon_movil') AND prefijo IN ('15','777') )
                AS mtel_movil,

            (SELECT SUM(consumo) FROM reporte_telefonia
                WHERE fecha_inicio>='{$this->start_date} 00:00:00' AND fecha_termino<='{$this->end_date} 23:59:59'
                AND tipo IN ('fijo','drop_fijo','buzon_fijo') AND prefijo IN ('15','777') )
                AS mtel_fijo,
            
            (SELECT SUM(consumo) FROM reporte_telefonia
                WHERE fecha_inicio>='{$this->start_date} 00:00:00' AND fecha_termino<='{$this->end_date} 23:59:59'
                AND tipo IN ('movil','drop_movil','buzon_movil') AND prefijo IN ('11','999') )
                AS mcm_movil,
            
            (SELECT SUM(consumo) FROM reporte_telefonia
                WHERE fecha_inicio>='{$this->start_date} 00:00:00' AND fecha_termino<='{$this->end_date} 23:59:59'
                AND tipo IN ('fijo','drop_fijo','buzon_fijo') AND prefijo IN ('11','999') )
                AS mcm_fijo,
            
            (SELECT SUM(consumo) FROM reporte_telefonia
                WHERE fecha_inicio>='{$this->start_date} 00:00:00' AND fecha_termino<='{$this->end_date} 23:59:59'
                AND tipo IN ('movil','drop_movil','buzon_movil') AND prefijo IN ('28','444') )
                AS ipcom_movil,

            (SELECT SUM(consumo) FROM reporte_telefonia
                WHERE fecha_inicio>='{$this->start_date} 00:00:00' AND fecha_termino<='{$this->end_date} 23:59:59'
                AND tipo IN ('fijo','drop_fijo','buzon_fijo') AND prefijo IN ('28','444')) 
                AS ipcom_fijo,
            
            (SELECT SUM(consumo) FROM reporte_telefonia
                WHERE fecha_inicio>='{$this->start_date} 00:00:00' AND fecha_termino<='{$this->end_date} 23:59:59'
                AND tipo IN ('movil','drop_movil','buzon_movil') AND prefijo IN ('14','555') )
                AS haz_movil,
            
            (SELECT SUM(consumo) FROM reporte_telefonia
                WHERE fecha_inicio>='{$this->start_date} 00:00:00' AND fecha_termino<='{$this->end_date} 23:59:59'
                AND tipo IN ('fijo','drop_fijo','buzon_fijo') AND prefijo IN ('14','555') )
                AS haz_fijo;";

        $answer_consumo_pesos = $this->conexion->query($query_consumo_pesos);
        while ($row_consumo_pesos = $answer_consumo_pesos->fetch_object()) {

            $consumoEnMinutosMovil  =  $row_consumo_pesos->mtel_movil;
            $consumoEnMinutosFijo  =  $row_consumo_pesos->mtel_fijo;
            $consumoEnMinutosMovil  =  $row_consumo_pesos->mcm_movil;
            $consumoEnMinutosFijo  =  $row_consumo_pesos->mcm_fijo;
            $consumoEnMinutosMovil  =  $row_consumo_pesos->ipcom_movil;
            $consumoEnMinutosFijo  =  $row_consumo_pesos->ipcom_fijo;
            $consumoEnMinutosMovil  =  $row_consumo_pesos->haz_movil;
            $consumoEnMinutosFijo  =  $row_consumo_pesos->haz_fijo;

            //DATOS OBTENIDOS POR CONSULTA
            switch ($this->carrier) {
                
                case "15','777":
                    // $costo_movil = 0.11;
                    // $costo_fijo = 0.04;
                    $consumoEnMinutosMovil  =  $row_consumo_pesos->mtel_movil;
                    $consumoEnMinutosFijo  =  $row_consumo_pesos->mtel_fijo;
                    break;
    
                // case "28','444":
                //     $costo_movil = 0.11;
                //     $costo_fijo = 0.04;
                    $consumoEnMinutosMovil  =  $row_consumo_pesos->ipcom_movil;
                    $consumoEnMinutosFijo  =  $row_consumo_pesos->ipcom_fijo;
                    break;
    
                case "11','999":
                    // $costo_movil = 0.11;
                    // $costo_fijo = 0.05;
                    $consumoEnMinutosMovil  =  $row_consumo_pesos->mcm_movil;
                    $consumoEnMinutosFijo  =  $row_consumo_pesos->mcm_fijo;
                    break;
    
                case "14','555":
                    // $costo_movil = 0.09 / 60;
                    // $costo_fijo = 0.04 / 60;
                    $consumoEnMinutosMovil  =  $row_consumo_pesos->haz_movil;
                    $consumoEnMinutosFijo  =  $row_consumo_pesos->haz_fijo;
                    break;
            }
            
            $costo_movil     = 0.11;
            $costo_fijo      = 0.04;
            $costo_fijo_mcm  = 0.05;
            $costo_movil_haz = 0.09/60;
            $costo_fijo_haz  = 0.04/60;

            $pesos_total_general = ($row_consumo_pesos->mtel_movil  * $costo_movil) 
            + ($row_consumo_pesos->mtel_fijo   * $costo_fijo) 
            + ($row_consumo_pesos->mcm_movil   * $costo_movil) 
            + ($row_consumo_pesos->mcm_fijo    * $costo_fijo_mcm)
            + ($row_consumo_pesos->ipcom_movil * $costo_movil)
            + ($row_consumo_pesos->ipcom_fijo  * $costo_fijo)
            + ($row_consumo_pesos->haz_movil   * $costo_movil_haz)
            + ($row_consumo_pesos->haz_fijo    * $costo_fijo_haz);



            $pesos_consumo_movil = $consumoEnMinutosMovil  * $costo_movil;
            $pesos_consumo_fijo  = $consumoEnMinutosFijo   * $costo_fijo;
            $pesos_total_por_carrier  =  $pesos_consumo_fijo + $pesos_consumo_movil;

            $porcent=round((($pesos_total_por_carrier/$pesos_total_general)*100),2); 



            ?>
            <tr>
                <td><?php echo "$ ".$pesos_consumo_movil ;?></td>
                <td><?php echo "$ ".$pesos_consumo_fijo;?></td>
                <td><?php echo "$ ".$pesos_total_por_carrier;?></td>
            </tr>
            <tr>
                <td colspan="3">
                    <div>
                        <div class="progress" style="height: 15px;">
                            <p><?php echo $porcent;?>%</p><br/>
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" style="height: 15px; width:<?php echo $porcent;?>%"></div>
                        </div>
                    </div>
                </td>
            </tr>

            <?php


            //var_dump($totalPorCarrier,$pesos_consumo_movil,$pesos_consumo_fijo,$pesos_total);

        }
        //return $totalPorCarrier;
    }    
}
