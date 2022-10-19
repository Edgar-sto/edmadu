<?php

class C_consumo_fechas
{
    public function __construct($conexion, $fecha_inicio, $fecha_termino)
    {
        $this->conexion     =   $conexion;
        $this->start_date   =   $fecha_inicio;
        $this->end_date     =   $fecha_termino;
    }


}