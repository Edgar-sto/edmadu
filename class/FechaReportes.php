<?php

class FechasReportes { 

    public function __construct($conexion, $fecha_inicio, $fecha_termino)
    {
        $this->conexion =   $conexion;
        $this->start_date   =   $fecha_inicio;
        $this->end_date     =   $fecha_termino;
    }

    public function reporteConConsumo (){
    $reportes = array("5", "6", "8", "9", "11", "14", "15", "22","27", "28","29", "30", "34", "35", "36","37", "38","39","40", "41", "42", "43", "44", "45", "46", "47", "48","57","60","201");

        foreach ($reportes as $value) {
            $consulta="SELECT DISTINCT (DATE_FORMAT(u_start_time,'%Y-%m-%d')) AS fecha FROM reporte_{$value}	
            WHERE u_start_time>='{$this->start_date} 00:00:00'  AND  u_start_time<='{$this->end_date} 23:59:59';";
            $respuesta = $this->conexion->query($consulta);
            while ($row= $respuesta->fetch_object()){
                $row->fecha;
                if (empty($row->fecha)) {
                    ?>
                        <div class="orden_fechas_hijo col">
                            <label for="">Reporte <?php echo $value; ?></label>
                            <p class="btn-outline-secondary parrafo_fecha">0</p>
                        </div>
                    <?php
                } else {
                    ?>
                        <div class="orden_fechas_hijo col">
                            <label for="">Reporte <?php echo $value; ?></label>
                            <p class="btn-outline-secondary parrafo_fecha"><?php echo $row->fecha; ?></p>
                        </div>
                    <?php   
                }
            }
        }
    }
}