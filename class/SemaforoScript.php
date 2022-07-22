<?php

class SemaforoScript {

    function __construct($conexion, $date, $date2) {
        $this->conexion   = $conexion;
        $this->date_start = $date;
        $this->date_end   = $date2;
    }

    //  SETES
    // public function setConexion ($conexion) {
    //     $this->conexion  = $conexion;
    // }

    // public function setDate_start ($date) {
    //     $this->date_start;
    // }

    // public function setDate_end ($date2) {
    //     $this->date_end;
    // }

    //  GETES
    // public function getconexion () {
    //     return $this->conexion;
    // }

    // public function getdate_start () {
    //     return $this->date_start;
    // }

    // public function getdate_end () {
    //     return $this->date_end;
    // }

    public function semaforo() {
        //$datos = array();
    
        $query = "SELECT
        (SELECT DISTINCT(DATE_FORMAT(fecha_inicio,'%Y-%m-%d')) FROM reporte_telefonia
        WHERE fecha_inicio>='{$this->date_start} 00:00:00' AND fecha_termino<='{$this->date_end} 23:59:59') AS principal,
        
        (SELECT DISTINCT(DATE_FORMAT(fecha_inicio,'%Y-%m-%d')) FROM reporte_telefonia_eventos
        WHERE fecha_inicio>='{$this->date_start} 00:00:00' AND fecha_termino<='{$this->date_end} 23:59:59') AS eventos,
        
        (SELECT DISTINCT(DATE_FORMAT(fecha_inicio,'%Y-%m-%d')) FROM reporte_telefonia_second
        WHERE fecha_inicio>='{$this->date_start} 00:00:00' AND fecha_termino<='{$this->date_end} 23:59:59') AS segundos;";

        $anwer = $this->conexion->query($query);

        while ($w = $anwer->fetch_object()) {
            $w->principal;
            $w->eventos;
            $w->segundos;


            if (!isset($w->principal)) {
                $principal = "0";
                $fondo = "bg-danger";
            } else {
                $principal = $w->principal;
                $fondo = "bg-success";
            }

            if (!isset($w->eventos)){
                $eventos = "0";
                $fondo_eventos = "bg-danger";
            } else {
                $eventos = $w->eventos;
                $fondo_eventos = "bg-success";
            }

            if (!isset($w->segundos)){
                $segundos = "0";
                $fondo_segundos = "bg-danger";
            } else {
                $segundos = $w->segundos;
                $fondo_segundos = "bg-success";
            }
            ?>
                <div class="col-lg-4 <?php echo $fondo ?>">
                    <?php echo $principal ?>
                </div>
                <div class="col-lg-4 <?php echo $fondo_eventos ?>">
                    <?php echo $eventos ?>
                </div>
                <div class="col-lg-4 <?php echo $fondo_segundos ?>">
                    <?php echo $segundos ?>
                </div>
            <?php
            //array_push($datos,$principal,$eventos,$segundos);
            //var_dump ($datos);
        }
        //return $datos;
    }

}
