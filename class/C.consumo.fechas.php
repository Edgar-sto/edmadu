<?php

class C_consumo_fechas
{
    public function __construct($conexion, $fecha_inicio, $fecha_termino)
    {
        $this->conexion     =   $conexion;
        $this->start_date   =   $fecha_inicio;
        $this->end_date     =   $fecha_termino;
    }

    public function fechasConConsumoAlDia(){
        $semanas = array('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31','32','33','34','35','36','37','38','39','40','41','42','43','44','45','46','47','48','49','50','51','52');
        $vici = array("5","6","8","9","11","14","15","22","27","28","29","30","34","35","36","37","38","39","40","41","42","43","44","45","46","47","48","57","60","74","75","76","79","201");
        ?>
        <tr class="" style="width: 100%; display: grid; grid-gap: 1.7rem; grid-template-columns: 100px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px;">
            <td class="text-left fs-6"" ><?php echo $this->start_date;?></td>
            <?php
            foreach ($vici as $reporte) {
                
                $queryFechas="SELECT DISTINCT reporte,fechaAConsultar,fechaConConsumo FROM fechasConConsumo
                    WHERE fechaAConsultar>='$this->start_date' AND fechaAConsultar<='$this->end_date'
                    AND reporte='Reporte {$reporte}'
                    GROUP BY reporte,fechaAConsultar
                    ORDER BY fechaAConsultar,reporte";
                $answerFechas=$this->conexion->query($queryFechas);
                while ($rowFechas=$answerFechas->fetch_object()) {
                    $rowFechas->reporte;
                    $rowFechas->fechaAConsultar;
                    $rowFechas->fechaConConsumo;
                    if ($rowFechas->fechaConConsumo == "1") {
                        $textColor="text-success";
                        $fondoColor="bg-success";
                    } else {
                        $textColor="text-danger";
                        $fondoColor="bg-danger";
                    }
                    ?>
                        <td class="<?php echo $textColor." ".$fondoColor;?> text-center"><?php echo $rowFechas->fechaConConsumo;?></td>
                    <?php

                }
            }
        ?>
        </tr>
        <?php
    }

    public function fechasConConsumoPorDias() {
        $vici = array("5","6","8","9","11","14","15","22","27","28","29","30","34","35","36","37","38","39","40","41","42","43","44","45","46","47","48","57","60","74","75","76","79","201");
        $queryVariasFechas="SELECT SUBSTRING(fechaAConsultar,1,10) AS fecha
            FROM fechasConConsumo
            WHERE fechaAConsultar
            BETWEEN '{$this->start_date} 00:00:00' AND '{$this->end_date} 23:59:59'
            GROUP BY fechaAConsultar";
        $answerVariasFechas=$this->conexion->query($queryVariasFechas);
        while ($rowVariasFechas=$answerVariasFechas->fetch_object()){
            $rowVariasFechas->fecha."\n";
            ?>
            <tr class="" style="width: 100%; display: grid; grid-gap: 1.7rem; grid-template-columns: 100px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px;">
                <td class="text-left fs-6"" ><?php echo $rowVariasFechas->fecha;?></td>
                <?php
                foreach ($vici as $reporte) {
                    $queryFechas="SELECT DISTINCT reporte,fechaAConsultar,fechaConConsumo FROM fechasConConsumo
                        WHERE fechaAConsultar>='$rowVariasFechas->fecha' AND fechaAConsultar<='$rowVariasFechas->fecha'
                        AND reporte='Reporte {$reporte}'
                        GROUP BY reporte,fechaAConsultar
                        ORDER BY fechaAConsultar,reporte";
                    $answerFechas=$this->conexion->query($queryFechas);
                    while ($rowFechas=$answerFechas->fetch_object()) {
                        $rowFechas->reporte;
                        $rowFechas->fechaAConsultar;
                        $rowFechas->fechaConConsumo;
                        if ($rowFechas->fechaConConsumo == "1") {
                            $textColor="text-success";
                            $fondoColor="bg-success";
                        } else {
                            $textColor="text-danger";
                            $fondoColor="bg-danger";
                        }
                        ?>
                            <td class="<?php echo $textColor." ".$fondoColor;?> text-center"><?php echo $rowFechas->fechaConConsumo;?></td>
                        <?php

                    }
                }
                ?>
            </tr>
            <?php
        }



    }


}