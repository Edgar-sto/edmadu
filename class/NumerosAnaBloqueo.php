<?php

class NumerosAnaBloqueo {

    //CONSTRUCTOR
    public function __construct($conexion, $date_start, $date_end, $numero)
    {   
        $this->conexion = $conexion;
        $this->f_start  = $date_start;
        $this->f_end    = $date_end;
        $this->numero   = $numero;
    }
    //  SETES
    public function setConexion ($conexion) {
        $this->conexion  = $conexion;
    }
    public function setDateStar ($date_start) {
        $this->f_start  =  $date_start;
    }

    public function setDateEnd ($date_end){
        $this->f_end  =  $date_end;
    }

    public function setNumero ($numero) {
        $this->numero;
    }

    //  GETES
    public function getconexion () {
        return $this->conexion;
    }

    public function getdatestart () {
        return $this->f_start;
    }

    public function getdateend () {
        return $this->f_end;
    }

    public function getnumero () {
        return $this->numero;
    }

    public function numeroBloqueo () {
        $datos = array ();
        $queryUno = "SELECT call_date, phone_number, status FROM vicidial_log_archive WHERE phone_number IN ('{$this->numero}')
        AND call_date>='{$this->f_start} 00:00:00' AND call_date<='{$this->f_end} 23:00:00';";
        $answer=$this->conexion->query($queryUno);
        ?>
        <table class="table">
                <thead>
                    <tr>
                        <th>fecha</th>
                        <th>numero</th>
                        <th>estatus</th>
                    </tr>
                </thead>
                <tbody>
        <?php
        while ($x=$answer->fetch_object()) {
            $x->call_date;
            $x->phone_number;
            $x->status;
            ?>
            
                    <tr>
                        <td><?php echo $x->call_date?></td>
                        <td><?php echo $x->phone_number?></td>
                        <td><?php echo $x->status?></td>
                    </tr>
                


            <?php
            // array_push($datos,$x->call_date,$x->phone_number,$x->status);
            // implode("  ",$datos);
        }
        ?>
                </tbody>
            </table>
        <?php
        //return $datos;
    
    
    /*datos obtener
     * call_date
     * phone_number
     * status
     * 5540858884
     * 2022-05-13   22-04-26
     * 
     */
    }
    



}