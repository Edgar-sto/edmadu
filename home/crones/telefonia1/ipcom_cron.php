<?php

$prefijos    =   array("28","444");
$tamaño_prefijos = count($prefijos);
echo "Busqueda del dia $date\n";
echo "\n";

$insert_inicio="INSERT INTO `control_log_scripts` (`id_log`, `name_script`,`estatus`, `fecha`, `fecha_registro`)
VALUES (NULL, 'Consumo Ipcom', 'Inicio', '{$date}', current_timestamp());";

if ($insert_inicio =   mysqli_query($conexionlocal, $insert_inicio)) {
    echo " |--Log de inicio Guardado exitosamente";
    echo "\n";
} else {
    echo " |--No se pudo guardar log";
    echo "\n";
}

for ($p = 0; $p < $tamaño_prefijos; $p++) {
    $prefijo = $prefijos[$p];
    $consultar_reportes = "SELECT DISTINCT (SUBSTRING(reporte,8,3)) as Reporte FROM consumo_total_reporte
    WHERE fecha_inicio>='$date 00:00:00' AND fecha_termino<='$date 23:59:59'
    AND prefijo IN ('$prefijo');";
    $resultado_reportes = mysqli_query($conexionlocal, $consultar_reportes);
    while ($mostrar_reportes = mysqli_fetch_assoc($resultado_reportes)) {
        $reporte = $mostrar_reportes['Reporte'];
        //$reporte = "36";
        echo "\n";
        echo "  Reporte $reporte con el prefijo $prefijo\n";
        echo "\n";
        $query_campaña = "SELECT DISTINCT d_campaign_id AS campaing
            FROM reporte_{$reporte}
            WHERE u_start_time>='$date 00:00:00'
            AND  u_start_time<='$date 23:59:59'
            AND c_dialstatus IN ('ANSWER')
            AND d_carrier_prefix ='$prefijo'
            ORDER BY d_campaign_id;";
        $resultado_query_campaña =   mysqli_query($conexion, $query_campaña);
        while ($mostrar_query_campaña   =   mysqli_fetch_assoc($resultado_query_campaña)) {
            $campaing   =   $mostrar_query_campaña['campaing']; //Resultado de la campaña
            if (empty($campaing)) {
                //espacio vacio no hace nada
            } else {
                $query_grupo = "SELECT DISTINCT (d_user_group)
                    FROM reporte_{$reporte}
                    WHERE u_start_time>='$date 00:00:00'
                    AND  u_start_time<='$date 23:59:59'
                    AND c_dialstatus in ('ANSWER')
                    AND d_campaign_id ='$campaing'
                    AND d_carrier_prefix ='$prefijo'
                    ORDER BY d_user_group;";
                $resultado_query_grupo  = mysqli_query($conexion, $query_grupo);
                while ($mostrar_res_query_grupo = mysqli_fetch_assoc($resultado_query_grupo)) {
                    $grupo = $mostrar_res_query_grupo['d_user_group']; //Resultado del grupo
                    if (empty($grupo)) {
                        //espacio vacio no hace nada
                    } else {
                        $query_sum_mf = "SELECT
                            (SELECT SUM(redondea_a_minutos) FROM reporte_{$reporte}
                            where u_start_time>='$date 00:00:00'  and  u_start_time<='$date 23:59:59'
                            AND c_dialstatus IN ('ANSWER') AND d_campaign_id='$campaing' AND d_carrier_prefix IN  ('$prefijo')
                            AND d_user_group='$grupo' AND d_tipo_numero='movil') AS MOVIL,
                            (SELECT SUM(redondea_a_minutos) FROM reporte_{$reporte}
                            where u_start_time>='$date 00:00:00'  and  u_start_time<='$date 23:59:59'
                            AND c_dialstatus IN ('ANSWER') AND d_campaign_id='$campaing' AND d_carrier_prefix IN  ('$prefijo')
                            AND d_user_group='$grupo' AND d_tipo_numero='fijo') AS FIJO;";
                        $resultado_query_sum_mf =   mysqli_query($conexion, $query_sum_mf);
                        while ($mostrar_query_sum_mf = mysqli_fetch_assoc($resultado_query_sum_mf)) {
                            $movil  =   $mostrar_query_sum_mf['MOVIL'];
                            $fijo   =   $mostrar_query_sum_mf['FIJO'];
                            if (!isset($movil)) {
                                $movil__ = "0";
                            } else {
                                $movil__ = $movil;
                            }
                            if (!isset($fijo)) {
                                $fijo__ = "0";
                            } else {
                                $fijo__ = $fijo;
                            }

                            $insertar_movil = "INSERT INTO `reporte_telefonia` (`id_consumo`,`reporte`, `fecha_inicio`,`fecha_termino`, `campania`, `grupo`, `prefijo`, `tipo`, `consumo`)
                                VALUES (NULL,'10.9.2.$reporte','$date 00:00:00','$date 23:59:59','$campaing','$grupo','$prefijo','movil','$movil__');";
                            
                            if (mysqli_query($conexionlocal, $insertar_movil)) {
                                echo "  Consumo Movil agregado con exito";
                                echo "\n";
                            } else {
                                echo "  Error: " . $insertar_movil . "<br>" . mysqli_error($conexionlocal);
                            }
                            $insertar_fijo = "INSERT INTO `reporte_telefonia` (`id_consumo`,`reporte`, `fecha_inicio`,`fecha_termino`, `campania`, `grupo`, `prefijo`, `tipo`, `consumo`)
                                VALUES (NULL,'10.9.2.$reporte','$date 00:00:00','$date 23:59:59','$campaing','$grupo','$prefijo','fijo','$fijo__');";
                            if (mysqli_query($conexionlocal, $insertar_fijo)) {
                                echo "  Consumo Fijo agregado con exito";
                                echo "\n";
                            } else {
                                echo "  Error: " . $insertar_fijo . "<br>" . mysqli_error($conexionlocal);
                            }
                        }
                    }
                    //Fin MOVIL Y FIJO
                }
                //Inicio DROP-BUZON
                $query_sum_drop_buzon = "SELECT
                    (SELECT SUM(redondea_a_minutos) FROM reporte_{$reporte}
                    where u_start_time>='$date 00:00:00'  and  u_start_time<='$date 23:59:59'
                    AND c_dialstatus IN ('ANSWER') AND d_campaign_id='$campaing' AND d_carrier_prefix IN  ('$prefijo')
                    AND d_user_group='' AND d_status NOT IN ('NA', 'AA') AND d_tipo_numero='movil') AS movilDROPS,
                    (SELECT SUM(redondea_a_minutos) FROM reporte_{$reporte}
                    where u_start_time>='$date 00:00:00'  and  u_start_time<='$date 23:59:59'
                    AND c_dialstatus IN ('ANSWER') AND d_campaign_id='$campaing' AND d_carrier_prefix IN  ('$prefijo')
                    AND d_user_group='' AND d_status NOT IN ('NA', 'AA') AND d_tipo_numero='fijo') AS fijoDROPS,
                    (SELECT SUM(redondea_a_minutos) FROM reporte_{$reporte}
                    where u_start_time>='$date 00:00:00'  and  u_start_time<='$date 23:59:59'
                    AND c_dialstatus IN ('ANSWER') AND d_campaign_id='$campaing' AND d_carrier_prefix IN  ('$prefijo')
                    AND d_user_group='' AND d_status IN ('NA', 'AA') AND d_tipo_numero='movil') AS movilbuzon,
                    (SELECT SUM(redondea_a_minutos) FROM reporte_{$reporte}
                    where u_start_time>='$date 00:00:00'  and  u_start_time<='$date 23:59:59'
                    AND c_dialstatus IN ('ANSWER') AND d_campaign_id='$campaing' AND d_carrier_prefix IN  ('$prefijo')
                    AND d_user_group='' AND d_status IN ('NA', 'AA') AND d_tipo_numero='fijo') AS fijobuzon ";
                //Fin DROP-BUZON
                $resultado_query_sum_drop_buzon    =   mysqli_query($conexion, $query_sum_drop_buzon);
                while ($mostrar_query_sum_drop_buzon   =   mysqli_fetch_assoc($resultado_query_sum_drop_buzon)) {
                    $m_drop =   $mostrar_query_sum_drop_buzon['movilDROPS'];echo "\n";
                    $f_drop =   $mostrar_query_sum_drop_buzon['fijoDROPS'];echo "\n";
                    $m_buzon =   $mostrar_query_sum_drop_buzon['movilbuzon'];echo "\n";
                    $f_buzon =   $mostrar_query_sum_drop_buzon['fijobuzon'];echo "\n";

                    if (!isset($m_drop)) {
                        $movil_drop = "0";
                    } else {
                        $movil_drop = $m_drop;
                    }
                    if (!isset($f_drop)) {
                        $fijo_drop = "0";
                    } else {
                        $fijo_drop = $f_drop;
                    }
                    if (!isset($m_buzon)) {
                        $movil_buzon = "0";
                    } else {
                        $movil_buzon = $m_buzon;
                    }
                    if (!isset($f_buzon)) {
                        $fijo_buzon = "0";
                    }else {
                        $fijo_buzon = $f_buzon;
                    }

                    echo $insertar_drop_movil = "INSERT INTO `reporte_telefonia` (`id_consumo`,`reporte`, `fecha_inicio`,`fecha_termino`, `campania`, `grupo`, `prefijo`, `tipo`, `consumo`)
                    VALUES (NULL,'10.9.2.$reporte','$date 00:00:00','$date 23:59:59','$campaing','N/A','$prefijo','drop_movil','$movil_drop');";
                    //$insertar_drop =   mysqli_query($conexionlocal, $insertar_drop);
                    if (mysqli_query($conexionlocal, $insertar_drop_movil)) {
                        echo "  Consumo Drop Movil agregado con exito";
                        echo "\n";
                    } else {
                        echo "  Error: " . $insertar_drop_movil . "<br>" . mysqli_error($conexionlocal);
                        echo "\n";
                    }
                    //echo "\n";
                    echo $insertar_drop_fijo = "INSERT INTO `reporte_telefonia` (`id_consumo`,`reporte`, `fecha_inicio`,`fecha_termino`, `campania`, `grupo`, `prefijo`, `tipo`, `consumo`)
                    VALUES (NULL,'10.9.2.$reporte','$date 00:00:00','$date 23:59:59','$campaing','N/A','$prefijo','drop_fijo','$fijo_drop');";
                    //$insertar_drop =   mysqli_query($conexionlocal, $insertar_drop);
                    if (mysqli_query($conexionlocal, $insertar_drop_fijo)) {
                        echo "  Consumo Drop Fijo agregado con exito";
                        echo "\n";
                    } else {
                        echo "  Error: " . $insertar_drop_fijo . "<br>" . mysqli_error($conexionlocal);
                        echo "\n";
                    }
                    /**INSERTAR DATOS DE BUZON */
                    //echo "\n";
                    echo $insertar_buzon_movil = "INSERT INTO `reporte_telefonia` (`id_consumo`,`reporte`, `fecha_inicio`,`fecha_termino`, `campania`, `grupo`, `prefijo`, `tipo`, `consumo`)
                    VALUES (NULL,'10.9.2.$reporte','$date 00:00:00','$date 23:59:59','$campaing','N/A','$prefijo','buzon_movil','$movil_buzon');";
                    //$insertar_drop =   mysqli_query($conexionlocal, $insertar_drop);
                    if (mysqli_query($conexionlocal, $insertar_buzon_movil)) {
                        echo "  Consumo Búzon Movil agregado con exito";
                        echo "\n";
                    } else {
                        echo "  Error: " . $insertar_buzon_movil . "<br>" . mysqli_error($conexionlocal);
                        echo "\n";
                    }
                    //echo "\n";
                    echo $insertar_buzon_fijo = "INSERT INTO `reporte_telefonia` (`id_consumo`,`reporte`, `fecha_inicio`,`fecha_termino`, `campania`, `grupo`, `prefijo`, `tipo`, `consumo`)
                    VALUES (NULL,'10.9.2.$reporte','$date 00:00:00','$date 23:59:59','$campaing','N/A','$prefijo','buzon_fijo','$fijo_buzon');";
                    //$insertar_drop =   mysqli_query($conexionlocal, $insertar_drop);
                    if (mysqli_query($conexionlocal, $insertar_buzon_fijo)) {
                        echo "  Consumo Búzon Fijo agregado con exito";
                        echo "\n";
                    } else {
                        echo "  Error: " . $insertar_buzon_fijo . "<br>" . mysqli_error($conexionlocal);
                        echo "\n";
                    }
                }
            }
        }
    }
}
$insert_inicio="INSERT INTO `control_log_scripts` (`id_log`, `name_script`,`estatus`, `fecha`, `fecha_registro`)
VALUES (NULL, 'Consumo Ipcom', 'Termino', '{$date}', current_timestamp());";

if ($insert_inicio =   mysqli_query($conexionlocal, $insert_inicio)) {
    echo " |--Log finalizado, Guardado exitosamente";
    echo "\n";
} else {
    echo " |--No se pudo guardar log";
    echo "\n";
}
