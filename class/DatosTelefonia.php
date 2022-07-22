<?php
    class DatosTelefonia {

        // public function __construct($conexion)
        // {
        //     $this->conexion = $conexion;
        // }

        function conexion_global ($servidor,$usuario,$password,$basededatos){
            $conection  =   new mysqli($servidor,$usuario,$password,$basededatos);
            if ($conection -> connect_errno) {
                echo "Failed to connect to MySQL: " . $conection -> connect_error;
                exit();
            }
            return $conection;
        }

        public function obtener_grupo ($conection) {

            $conexion = conexion_global("10.9.2.234","3dg4rm4n","secretosdenegus","telefonia");

            $query_group = "SELECT DISTINCT reporte,campania,grupo FROM reporte_telefonia
            WHERE fecha_inicio>='2022-07-01 00:00:00' and fecha_termino<='2022-07-15 23:59:59'
            AND grupo != 'N/A'";
            $asnwer_group = $conexion->query($query_group);
            while ($row=$asnwer_group->fetch_object()) {
                echo $row->reporte;
                echo $row->campania;
                echo $row->grupo;
            }

        }
    }
?>