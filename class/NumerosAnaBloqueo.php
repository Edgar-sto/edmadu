<?php

class NumerosAnaBloqueo {

    public function __construct($conexion, $date_start, $date_end)
    {   
        $this->conexion = $conexion;
        $this->f_start  = $date_start;
        $this->f_end    = $date_end;
    }

    public function setConexion ($conexion) {
        $this->conexion  = $conexion;
    }
    public function setDateStar ($date_start) {
        $this->f_start  =  $date_start;
    }

    public function getconexion () {
        return $this->conexion;
    }
    public 



}