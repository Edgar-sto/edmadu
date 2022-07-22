 <?php

 class ConsumoPorSemana {

    public function __construct($conexion,$dateOne,$dateTwo) {
        $this->conexion = $conexion;
        $this->date_start = $dateOne;
        $this->date_end   = $dateTwo;
    }

    //SETES
    public function setConexion ($conexion) {
        $this->conexion = $conexion;
    }
    public function setDateONe ($dateOne) {
        $this->date_start = $dateOne;
    }
    public function setDateTwo ($dateTwo) {
         $this->date_end = $dateTwo;
    }
    //GETES
    public function getconexion () {
        return $this->conexion;
    }
    public function getdateOne () {
        return $this->date_start;
    }
    public function getdatetow () {
        return $this->date_end;
    }

    public function consumoSemana() {
        $query = "SELECT DISTINCT (tipo_consumo), name, carrier, prefijo, consumo, tipo_marcacion FROM consumo_semanal WHERE name''";
    }
       
 }
