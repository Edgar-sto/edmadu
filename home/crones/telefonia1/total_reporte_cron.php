<?php


$prefijos    =   array("11", "14", "15", "28", "444", "555", "777", "999");
$tamaño_prefijos = count($prefijos);

echo "Consumo del día $date\n";
$insert_inicio="INSERT INTO `control_log_scripts` (`id_log`, `name_script`,`estatus`, `fecha`, `fecha_registro`)
VALUES (NULL, 'Consumo Total', 'Inicio', '{$date}', current_timestamp());";

if ($insert_inicio =   mysqli_query($conexionlocal, $insert_inicio)) {
    echo " |--Log de inicio Guardado exitosamente";
    echo "\n";
} else {
    echo " |--No se pudo guardar log";
    echo "\n";
}

$servidores = array("5", "6", "8", "9", "11", "14", "15", "22","27", "28","29", "30", "34", "35", "36","37", "38","39","40", "41", "42", "43", "44", "45", "46", "47", "48","57","60","201");
$tamanio_array = count($servidores);
for ($x = 0; $x < $tamanio_array; $x++) {
    $reporte    =   $servidores[$x];
    echo "   |-Reporte $reporte.";
    echo "\n";
    for ($prefix = 0; $prefix < $tamaño_prefijos; $prefix++) {
        $prefijo = $prefijos[$prefix];
        echo "     |-Prefijo $prefijo ------ ";
        //echo "\n";
        $query_consumo_diario_por_reporte = "SELECT SUM(redondea_a_minutos) AS total FROM reporte_$reporte
                            WHERE u_start_time>='$date 00:00:00' AND  u_start_time<='$date 23:59:59'
                            AND c_dialstatus IN ('ANSWER') AND d_carrier_prefix  IN  ('$prefijo')";
        $query  =   mysqli_query($conexion, $query_consumo_diario_por_reporte) or die(mysqli_error($conexion));
        while ($row = mysqli_fetch_assoc($query)) {
            //var_dump($row['total']);
            if (empty($row['total'])) {
                //espacio vacio no hace nada
                echo " SIN DATOS \n";
            } else {
                //echo "\n";
                $insert = "INSERT INTO `consumo_total_reporte` (`id_consumo_total`,`reporte`,`fecha_inicio`,`fecha_termino`,`prefijo`,`consumo`)
                                VALUES (NULL, '10.9.2.{$reporte}','{$date} 00:00:00','{$date} 23:59:59','{$prefijo}','{$row['total']}')";
                //echo "\n";
                //$insertar_ =   mysqli_query($conexionlocal, $insert);
                if ($insertar_ =   mysqli_query($conexionlocal, $insert)) {
                    echo " DATOS GUARDADOS.";
                    echo "\n";
                } else {
                    echo " Los datos de la fecha {$date} del Reporte {$reporte} no se guardo en la Base.";
                    echo "\n";
                }
            }
        }
    }
}

$insert_fin="INSERT INTO `control_log_scripts` (`id_log`, `name_script`,`estatus`, `fecha`, `fecha_registro`)
VALUES (NULL, 'Consumo Total', 'Inicio', '{$date}', current_timestamp());";

if ($insert_fin =   mysqli_query($conexionlocal, $insert_fin)) {
    echo " |--Log de finalizacion Guardado exitosamente.";
    echo "\n";
} else {
    echo " |--No se pudo guardar log de finilización.";
    echo "\n";
}
