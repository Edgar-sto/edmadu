<?php

class TeleLogs{

    public function __construct($conexion,$fecha,$ip)
    {
        $this->conexion = $conexion;
        $this->fecha  = $fecha;
        $this->ip     = $ip;
    }

    public function registro_log_por_btn() {

        $insert_log="INSERT INTO `control_log_scripts` (`id_log`, `name_script`,`estatus`, `fecha`, `fecha_registro`)
        VALUES (NULL, 'Consulta por boton', '{$this->ip}', '{$this->fecha}', current_timestamp());";

        $insert_inicio = $this->conexion->query($insert_log);
    }

    public function busqueda_log() {
        $search_logs="SELECT * from control_log_scripts
        WHERE fecha_registro>='{$this->fecha} 00:00:00'
        AND fecha_registro<='{$this->fecha} 23:59:59';";

        $answer = $this->conexion->query($search_logs);
        $datos = array();

        while ($row=$answer->fetch_object()){
            $row->name_script;
            $row->estatus;
            $row->fecha;
            $row->fecha_registro;
            //array_push($datos,$row->name_script,$row->estatus,$row->fecha,$row->fecha_registro);
            ?>
            <tr>
                <td class="text-left"><?php echo $row->name_script; ?></td>
                <td class="text-left"><?php echo $row->estatus;?></td>
                <td><?php echo $row->fecha;?></td>
                <td><?php echo $row->fecha_registro;?></td> 
            </tr>
            <?php
        }
        //return $datos;

    }




}