<?php

class DateTele21
{

    public function __construct($conexion, $start_date, $end_date, $prefijos, $reportes)
    {
        $this->conexion  =  $conexion;
        $this->begin_date  =  $start_date;
        $this->end_date  =  $end_date;
        $this->prefijos  =  $prefijos;
        $this->reporte   =  $reportes;
    }

    public function rastreoDeConsumoPorCarrier()
    {

        foreach ($this->prefijos AS $carrier => $prefijos) {
?>
        <tr>
            <td><?php echo $carrier;  
                ?></td>
            <?php
            foreach ($this->reporte as $reporte) {

                $queryDate = "SELECT
                (SELECT DISTINCT (DATE_FORMAT(u_start_time,'%Y-%m-%d')) FROM reporte_5
                WHERE u_start_time>='{$this->begin_date} 00:00:00'  AND  u_start_time<='{$this->end_date} 23:59:59'
                AND d_carrier_prefix IN ('{$prefijos}')  ORDER BY u_start_time) AS rep_5,
                (SELECT DISTINCT (DATE_FORMAT(u_start_time,'%Y-%m-%d')) FROM reporte_6
                WHERE u_start_time>='{$this->begin_date} 00:00:00'  AND  u_start_time<='{$this->end_date} 23:59:59'
                AND d_carrier_prefix IN ('{$prefijos}')  ORDER BY u_start_time) AS rep_6,
                (SELECT DISTINCT (DATE_FORMAT(u_start_time,'%Y-%m-%d')) FROM reporte_8
                WHERE u_start_time>='{$this->begin_date} 00:00:00'  AND  u_start_time<='{$this->end_date} 23:59:59'
                AND d_carrier_prefix IN ('{$prefijos}')  ORDER BY u_start_time) AS rep_8,
                (SELECT DISTINCT (DATE_FORMAT(u_start_time,'%Y-%m-%d')) FROM reporte_9
                WHERE u_start_time>='{$this->begin_date} 00:00:00'  AND  u_start_time<='{$this->end_date} 23:59:59'
                AND d_carrier_prefix IN ('{$prefijos}')  ORDER BY u_start_time) AS rep_9,
                (SELECT DISTINCT (DATE_FORMAT(u_start_time,'%Y-%m-%d')) FROM reporte_11
                WHERE u_start_time>='{$this->begin_date} 00:00:00'  AND  u_start_time<='{$this->end_date} 23:59:59'
                AND d_carrier_prefix IN ('{$prefijos}')  ORDER BY u_start_time) AS rep_11,
                (SELECT DISTINCT (DATE_FORMAT(u_start_time,'%Y-%m-%d')) FROM reporte_14
                WHERE u_start_time>='{$this->begin_date} 00:00:00'  AND  u_start_time<='{$this->end_date} 23:59:59'
                AND d_carrier_prefix IN ('{$prefijos}')  ORDER BY u_start_time) AS rep_14,
                (SELECT DISTINCT (DATE_FORMAT(u_start_time,'%Y-%m-%d')) FROM reporte_15
                WHERE u_start_time>='{$this->begin_date} 00:00:00'  AND  u_start_time<='{$this->end_date} 23:59:59'
                AND d_carrier_prefix IN ('{$prefijos}')  ORDER BY u_start_time) AS rep_15,
                (SELECT DISTINCT (DATE_FORMAT(u_start_time,'%Y-%m-%d')) FROM reporte_22
                WHERE u_start_time>='{$this->begin_date} 00:00:00'  AND  u_start_time<='{$this->end_date} 23:59:59'
                AND d_carrier_prefix IN ('{$prefijos}')  ORDER BY u_start_time) AS rep_22,
                (SELECT DISTINCT (DATE_FORMAT(u_start_time,'%Y-%m-%d')) FROM reporte_27
                WHERE u_start_time>='{$this->begin_date} 00:00:00'  AND  u_start_time<='{$this->end_date} 23:59:59'
                AND d_carrier_prefix IN ('{$prefijos}')  ORDER BY u_start_time) AS rep_27,
                (SELECT DISTINCT (DATE_FORMAT(u_start_time,'%Y-%m-%d')) FROM reporte_28
                WHERE u_start_time>='{$this->begin_date} 00:00:00'  AND  u_start_time<='{$this->end_date} 23:59:59'
                AND d_carrier_prefix IN ('{$prefijos}')  ORDER BY u_start_time) AS rep_28,
                (SELECT DISTINCT (DATE_FORMAT(u_start_time,'%Y-%m-%d')) FROM reporte_29
                WHERE u_start_time>='{$this->begin_date} 00:00:00'  AND  u_start_time<='{$this->end_date} 23:59:59'
                AND d_carrier_prefix IN ('{$prefijos}')  ORDER BY u_start_time) AS rep_29,
                (SELECT DISTINCT (DATE_FORMAT(u_start_time,'%Y-%m-%d')) FROM reporte_30
                WHERE u_start_time>='{$this->begin_date} 00:00:00'  AND  u_start_time<='{$this->end_date} 23:59:59'
                AND d_carrier_prefix IN ('{$prefijos}')  ORDER BY u_start_time) AS rep_30,
                (SELECT DISTINCT (DATE_FORMAT(u_start_time,'%Y-%m-%d')) FROM reporte_34
                WHERE u_start_time>='{$this->begin_date} 00:00:00'  AND  u_start_time<='{$this->end_date} 23:59:59'
                AND d_carrier_prefix IN ('{$prefijos}')  ORDER BY u_start_time) AS rep_34,
                (SELECT DISTINCT (DATE_FORMAT(u_start_time,'%Y-%m-%d')) FROM reporte_35
                WHERE u_start_time>='{$this->begin_date} 00:00:00'  AND  u_start_time<='{$this->end_date} 23:59:59'
                AND d_carrier_prefix IN ('{$prefijos}')  ORDER BY u_start_time) AS rep_35,
                (SELECT DISTINCT (DATE_FORMAT(u_start_time,'%Y-%m-%d')) FROM reporte_36
                WHERE u_start_time>='{$this->begin_date} 00:00:00'  AND  u_start_time<='{$this->end_date} 23:59:59'
                AND d_carrier_prefix IN ('{$prefijos}')  ORDER BY u_start_time) AS rep_36,
                (SELECT DISTINCT (DATE_FORMAT(u_start_time,'%Y-%m-%d')) FROM reporte_37
                WHERE u_start_time>='{$this->begin_date} 00:00:00'  AND  u_start_time<='{$this->end_date} 23:59:59'
                AND d_carrier_prefix IN ('{$prefijos}')  ORDER BY u_start_time) AS rep_37,
                (SELECT DISTINCT (DATE_FORMAT(u_start_time,'%Y-%m-%d')) FROM reporte_38
                WHERE u_start_time>='{$this->begin_date} 00:00:00'  AND  u_start_time<='{$this->end_date} 23:59:59'
                AND d_carrier_prefix IN ('{$prefijos}')  ORDER BY u_start_time) AS rep_38,
                (SELECT DISTINCT (DATE_FORMAT(u_start_time,'%Y-%m-%d')) FROM reporte_39
                WHERE u_start_time>='{$this->begin_date} 00:00:00'  AND  u_start_time<='{$this->end_date} 23:59:59'
                AND d_carrier_prefix IN ('{$prefijos}')  ORDER BY u_start_time) AS rep_39,
                (SELECT DISTINCT (DATE_FORMAT(u_start_time,'%Y-%m-%d')) FROM reporte_40
                WHERE u_start_time>='{$this->begin_date} 00:00:00'  AND  u_start_time<='{$this->end_date} 23:59:59'
                AND d_carrier_prefix IN ('{$prefijos}')  ORDER BY u_start_time) AS rep_40,
                (SELECT DISTINCT (DATE_FORMAT(u_start_time,'%Y-%m-%d')) FROM reporte_41
                WHERE u_start_time>='{$this->begin_date} 00:00:00'  AND  u_start_time<='{$this->end_date} 23:59:59'
                AND d_carrier_prefix IN ('{$prefijos}')  ORDER BY u_start_time) AS rep_41,
                (SELECT DISTINCT (DATE_FORMAT(u_start_time,'%Y-%m-%d')) FROM reporte_42
                WHERE u_start_time>='{$this->begin_date} 00:00:00'  AND  u_start_time<='{$this->end_date} 23:59:59'
                AND d_carrier_prefix IN ('{$prefijos}')  ORDER BY u_start_time) AS rep_42,
                (SELECT DISTINCT (DATE_FORMAT(u_start_time,'%Y-%m-%d')) FROM reporte_43
                WHERE u_start_time>='{$this->begin_date} 00:00:00'  AND  u_start_time<='{$this->end_date} 23:59:59'
                AND d_carrier_prefix IN ('{$prefijos}')  ORDER BY u_start_time) AS rep_43,
                (SELECT DISTINCT (DATE_FORMAT(u_start_time,'%Y-%m-%d')) FROM reporte_44
                WHERE u_start_time>='{$this->begin_date} 00:00:00'  AND  u_start_time<='{$this->end_date} 23:59:59'
                AND d_carrier_prefix IN ('{$prefijos}')  ORDER BY u_start_time) AS rep_44,
                (SELECT DISTINCT (DATE_FORMAT(u_start_time,'%Y-%m-%d')) FROM reporte_45
                WHERE u_start_time>='{$this->begin_date} 00:00:00'  AND  u_start_time<='{$this->end_date} 23:59:59'
                AND d_carrier_prefix IN ('{$prefijos}')  ORDER BY u_start_time) AS rep_45,
                (SELECT DISTINCT (DATE_FORMAT(u_start_time,'%Y-%m-%d')) FROM reporte_46
                WHERE u_start_time>='{$this->begin_date} 00:00:00'  AND  u_start_time<='{$this->end_date} 23:59:59'
                AND d_carrier_prefix IN ('{$prefijos}')  ORDER BY u_start_time) AS rep_46,
                (SELECT DISTINCT (DATE_FORMAT(u_start_time,'%Y-%m-%d')) FROM reporte_47
                WHERE u_start_time>='{$this->begin_date} 00:00:00'  AND  u_start_time<='{$this->end_date} 23:59:59'
                AND d_carrier_prefix IN ('{$prefijos}')  ORDER BY u_start_time) AS rep_47,
                (SELECT DISTINCT (DATE_FORMAT(u_start_time,'%Y-%m-%d')) FROM reporte_48
                WHERE u_start_time>='{$this->begin_date} 00:00:00'  AND  u_start_time<='{$this->end_date} 23:59:59'
                AND d_carrier_prefix IN ('{$prefijos}')  ORDER BY u_start_time) AS rep_48,
                (SELECT DISTINCT (DATE_FORMAT(u_start_time,'%Y-%m-%d')) FROM reporte_57
                WHERE u_start_time>='{$this->begin_date} 00:00:00'  AND  u_start_time<='{$this->end_date} 23:59:59'
                AND d_carrier_prefix IN ('{$prefijos}')  ORDER BY u_start_time) AS rep_57,
                (SELECT DISTINCT (DATE_FORMAT(u_start_time,'%Y-%m-%d')) FROM reporte_60
                WHERE u_start_time>='2022-03-07 00:00:00'  AND  u_start_time<='2022-03-07 23:59:59'
                AND d_carrier_prefix IN ('{$prefijos}')  ORDER BY u_start_time) AS rep_60,
                (SELECT DISTINCT (DATE_FORMAT(u_start_time,'%Y-%m-%d')) FROM reporte_201
                WHERE u_start_time>='{$this->begin_date} 00:00:00'  AND  u_start_time<='{$this->end_date} 23:59:59'
                AND d_carrier_prefix IN ('{$prefijos}')  ORDER BY u_start_time) AS rep_201;";


                $answer = $this->conexion->query($queryDate);

                while ($row_date = $answer->fetch_object()) {
                    //$row_date->rep_5;
                    ?>
                    <td class="table-success text-dark"><?php echo $row_date->rep_5; ?></td>
                    <td class="table-success text-dark"><?php echo $row_date->rep_6; ?></td>
                    <td class="table-success text-dark"><?php echo $row_date->rep_8; ?></td>
                    <td class="table-success text-dark"><?php echo $row_date->rep_9; ?></td>
                    <td class="table-success text-dark"><?php echo $row_date->rep_11; ?></td>
                    <td class="table-success text-dark"><?php echo $row_date->rep_14; ?></td>
                    <td class="table-success text-dark"><?php echo $row_date->rep_15; ?></td>
                    <td class="table-success text-dark"><?php echo $row_date->rep_22; ?></td>
                    <td class="table-success text-dark"><?php echo $row_date->rep_27; ?></td>
                    <td class="table-success text-dark"><?php echo $row_date->rep_28; ?></td>
                    <td class="table-success text-dark"><?php echo $row_date->rep_29; ?></td>
                    <td class="table-success text-dark"><?php echo $row_date->rep_30; ?></td>
                    <td class="table-success text-dark"><?php echo $row_date->rep_34; ?></td>
                    <td class="table-success text-dark"><?php echo $row_date->rep_35; ?></td>
                    <td class="table-success text-dark"><?php echo $row_date->rep_36; ?></td>
                    <td class="table-success text-dark"><?php echo $row_date->rep_37; ?></td>
                    <td class="table-success text-dark"><?php echo $row_date->rep_38; ?></td>
                    <td class="table-success text-dark"><?php echo $row_date->rep_39; ?></td>
                    <td class="table-success text-dark"><?php echo $row_date->rep_40; ?></td>
                    <td class="table-success text-dark"><?php echo $row_date->rep_41; ?></td>
                    <td class="table-success text-dark"><?php echo $row_date->rep_42; ?></td>
                    <td class="table-success text-dark"><?php echo $row_date->rep_43; ?></td>
                    <td class="table-success text-dark"><?php echo $row_date->rep_44; ?></td>
                    <td class="table-success text-dark"><?php echo $row_date->rep_45; ?></td>
                    <td class="table-success text-dark"><?php echo $row_date->rep_46; ?></td>
                    <td class="table-success text-dark"><?php echo $row_date->rep_47; ?></td>
                    <td class="table-success text-dark"><?php echo $row_date->rep_48; ?></td>
                    <td class="table-success text-dark"><?php echo $row_date->rep_57; ?></td>
                    <td class="table-success text-dark"><?php echo $row_date->rep_60; ?></td>
                    <td class="table-success text-dark"><?php echo $row_date->rep_201; ?></td>
                    <?php
                }
            }
            ?>
        </tr>
        <?php
        }
    }
}
