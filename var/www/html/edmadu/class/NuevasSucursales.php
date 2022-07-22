<?php

class NuevasSucursales {

    public function __construct($conexion,$vici,$sucursal,$tipo,$campania,$name_group) {
        $this->conexion =   $conexion;
        $this->vici     =   $vici;
        $this->sucursal =   $sucursal;
        $this->tipo     =   $tipo;
        $this->campania =   $campania;
        $this->name     =   $name_group;
    }

    //SETES
    public function setConexion ($conexion) {
        $this->conexion  = $conexion;
    }
    public function setVici ($vici) {
        $this->vici     =   $vici;
    }
    public function setSucursal ($sucursal) {
        $this->sucursal =   $sucursal;   
    }
    public function setTipo ($tipo) {
        $this->tipo     =   $tipo;
    }
    public function setCampania ($campania) {
        $this->campania =   $campania;
    }
    public function setName ($name_group) {
        $this->name     =   $name_group;
    
    }

    //  GETES
    public function getconexion () {
        return $this->conexion;
    }
    public function getvici () {
        return $this->vici;
    }
    public function getsucursal () {
        return $this->sucursal;
    }
    public function gettipo () {
        return $this->tipo;
    }
    public function getcampania () {
        return $this->campania;
    }
    public function getname () {
        return $this->name;
    }

    public function agregarSucursal () {
        $consulta ="INSERT INTO `sucu_campa_grup` (`id_grupo`, `sucursal`, `tipo`, `campania`, `nombre_grupo`, `vici`, `fecha_registro`) VALUES (NULL, '{$this->sucursal}', '{$this->tipo}', '{$this->campania}', '{$this->name}', '10.9.2.{$this->vici}', CURRENT_TIMESTAMP);";
        
        if ($insertar = $this->conexion->query($consulta)) {
            echo "Sucursal Agregada \n NOMBRE: ".$this->sucursal."\nVICI: ".$this->vici;
            echo "\n";
        } else {
            echo " Error: " . $insertar . "<br>" . mysqli_error($this->conexion);
        }
    }




}