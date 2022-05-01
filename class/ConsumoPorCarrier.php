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

                ?>
                <tr>
                    <td><?php echo $tipo_; ?></td>
                    <td class="text-right"><?php echo number_format($total_ / 60); ?></td>
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
                $row_consumo->Total;
                $row_consumo->Tipo;
            ?>
                <tr>
                    <td><?php echo $row_consumo->Tipo; ?></td>
                    <td class="text-right"><?php echo number_format($row_consumo->Total); ?></td>
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
        WHERE fecha_inicio>='{$this->start_date} 00:00:00' AND fecha_termino<='{$this->end_date}23:59:59'
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
                    </svg></i>Haz
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

    public function consumoPorCentrosInternos() {
        
    }
}
