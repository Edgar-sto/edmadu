<?php

    class MaquilaClass {
        public function __construct($conexion ,$fecha_inicio,$fecha_fin) {   
            $this->conexion     =   $conexion;
            $this->date_start   =   $fecha_inicio;
            $this->date_end     =   $fecha_fin;
        }//cierre contrstructor

        public function obt_vici_maquila() {
            $vici_array = array();
            $query_vicis="SELECT v.reporte , v.tipo_cliente
            FROM vicis v 
            WHERE tipo_cliente IN ('externo','intruso')";
            $answer_vicis=$this->conexion->query($query_vicis);
            while ($vc = $answer_vicis->fetch_object()) {
                $vc->reporte;
                $vc->tipo_cliente;
                array_push($vici_array,$vc->reporte);
            }
            return $vici_array;
        }

        public function obt_numero_reporte() {
            $reporte_array = array();
            $query_reporte="SELECT SUBSTRING(v.reporte,8,3) AS reporte
            FROM vicis v
            WHERE tipo_cliente IN ('externo','intruso')";
            $answer_vicis1=$this->conexion->query($query_reporte);
            while ($vc1 = $answer_vicis1->fetch_object()) {
                $vc1->reporte;
                array_push($reporte_array,$vc1->reporte);
            }
            return $reporte_array;
        }
 
        public function obt_maquilas($dato){
            $datos_uno = array();
            $query_maquilas ="SELECT DISTINCT a.sucursal, a.nombre_grupo, b.reporte, b.campania
                FROM sucu_campa_grup a
                JOIN reporte_telefonia b ON a.nombre_grupo = b.grupo 
                WHERE a.tipo='E'  
                AND b.fecha_inicio>='{$this->date_start} 00:00:00' AND b.fecha_termino<='{$this->date_end} 23:59:59'
                AND b.prefijo IN ('14','555','11','999','15','777','28','444')
                AND b.reporte = '{$dato}'
                GROUP BY a.sucursal, a.nombre_grupo, b.reporte, b.campania
                ORDER BY a.sucursal, reporte ASC;";

                $answer_maquilas=$this->conexion->query($query_maquilas);

                while ($w = $answer_maquilas->fetch_object()) {
                    $w->sucursal;
                    $w->nombre_grupo;
                    $w->reporte;
                    $w->campania;
                    //array_push($datos_uno,$w->sucursal,$w->campania);
                    ?>
                        <tr>
                            <td><?php echo $w->sucursal;?></td>
                            <td><?php echo $w->nombre_grupo;?></td>
                            <td><?php echo $w->campania;?></td>
                            <td>
                                <button type="button" class="btn btn-light" data-toggle="modal" data-target="#modalMaquila<?php echo $w->nombre_grupo.$w->campania; ?>">
                                    Información detallada
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="modalMaquila<?php echo $w->nombre_grupo.$w->campania; ?>" tabindex="-1" role="dialog" aria-labelledby="modalEscorzaTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-info">
                                                <h5 class="modal-title text-dark" id="exampleModalLongTitle"><?php echo $w->sucursal; ?></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body bg-light">
                                                <?php 
                                                    $all_prefijos = array('Haz'=>"14','555", 'Marcatel'=>"15','777", 'MCM'=>"11','999", 'Ipcom'=>"28','444");
                                                    //var_dump($all_prefijos);
                                                    foreach ($all_prefijos as $carrier_array => $prefijo_usado) {
                                                ?>
                                                        <table class="table table-hover text-light table-light table-striped" style="font-size: 0.6em;">
                                                            <thead class="thead-inverse text-center thead-dark">
                                                                <tr>
                                                                    <th class="fs-5 text-left" colspan="6"><?php echo $carrier_array; ?></th>
                                                                </tr>
                                                                <tr class="">
                                                                    <th class="text-center"><strong>Prefijo</strong></th>
                                                                    <th><strong>Campaña</strong></th>
                                                                    <th><strong>Grupo</strong></th>
                                                                    <th><strong>Tipo</strong></th>
                                                                    <th><strong>Minutos</strong></th>
                                                                    <th><strong>Pesos</strong></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="text-dark ">
                                                                <?php
                                                                    $query_consumo_maquila = "SELECT DISTINCT a.prefijo, a.campania, a.grupo, SUM(consumo) AS Total,
                                                                    (CASE WHEN tipo = 'movil' THEN 'Movil'
                                                                      WHEN tipo = 'drop_movil'  THEN 'Drop Movil'
                                                                      WHEN tipo = 'buzon_movil'  THEN 'Buzon Movil'
                                                                      WHEN tipo = 'fijo'  THEN 'Fijo'
                                                                      WHEN tipo = 'drop_fijo'  THEN 'Drop Fijo'
                                                                      WHEN tipo = 'buzon_fijo'  THEN 'Buzon Fijo'
                                                                      END ) AS Tipo
                                                                    FROM reporte_telefonia a
                                                                    WHERE prefijo IN ('{$prefijo_usado}')
                                                                      AND a.campania = '{$w->campania}'
                                                                      AND fecha_inicio>='{$this->date_start} 00:00:00'
                                                                      AND fecha_termino<='{$this->date_end} 23:59:59'
                                                                      AND grupo NOT IN ('HSBC-STO-ESCORZA-MA', 'ADMIN')
                                                                      AND reporte='{$dato}'
                                                                      GROUP BY prefijo, campania, grupo, tipo,reporte
                                                                    ORDER BY prefijo,campania,grupo ASC;";
                                                                    $answer_consumo_maquilas = $this->conexion->query($query_consumo_maquila);    
                                                                    while ($as = $answer_consumo_maquilas->fetch_object()) {

                                                                        switch ($prefijo_usado) {
                                                                            case "15','777":
                                                                                if ($as->Tipo == 'Movil' || $as->Tipo == 'Drop Movil' || $as->Tipo == 'Buzon Movil') {
                                                                                    $costo_ = 0.11;
                                                                                } else {
                                                                                    $costo_ = 0.04;
                                                                                }
                                                                                $total = $as->Total;
                                                                                break;
                                                    
                                                                            case "28','444":
                                                                                if ($as->Tipo == 'Movil' || $as->Tipo == 'Drop Movil' || $as->Tipo == 'Buzon Movil') {
                                                                                    $costo_ = 0.11;
                                                                                } else {
                                                                                    $costo_ = 0.04;
                                                                                }
                                                                                $total = $as->Total;
                                                                                break;
                                                    
                                                                            case "11','999":
                                                                                if ($as->Tipo == 'Movil' || $as->Tipo == 'Drop Movil' || $as->Tipo == 'Buzon Movil') {
                                                                                    $costo_ = 0.11;
                                                                                } else {
                                                                                    $costo_ = 0.05;
                                                                                }
                                                                                $total = $as->Total;
                                                                                break;
                                                    
                                                                            case "14','555":
                                                                                if ($as->Tipo == 'Movil' || $as->Tipo == 'Drop Movil' || $as->Tipo == 'Buzon Movil') {
                                                                                    $costo_ = 0.09 / 60;
                                                                                } else {
                                                                                    $costo_ = 0.04 / 60;
                                                                                }
                                                                                $total = $as->Total /60 ;
                                                                                break;
                                                                        }
                                                                        ?>
                                                                        <tr>
                                                                            <td><?php echo $as->prefijo;?></td>
                                                                            <td><?php echo $as->campania;?></td>
                                                                            <td><?php echo $as->grupo;?></td>
                                                                            <td><?php echo $as->Tipo;?></td>
                                                                            <td class="text-right">
                                                                                <?php

                                                                                    echo number_format($total);
                                                                                ?>
                                                                            </td>
                                                                            <td class="text-right">
                                                                                <?php
                                                                                    $total_pesos = $as->Total * $costo_;
                                                                                    echo "$ ".number_format($total_pesos,2);
                                                                                ?>
                                                                            </td>
                                                                        </tr>                                                                        
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                        <br>
                                                <?php
                                                    }
                                                ?>
                                            </div>
                                            <div class="modal-footer bg-info">
                                                <h6>STO VANGUARDIA </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr> 
                    <?php
                }
            //return $datos_uno;
        }

        public function maquilas_ara($reporte) {
                    
            $all_prefijos = array('Haz'=>"14','555", 'Marcatel'=>"15','777", 'MCM'=>"11','999", 'Ipcom'=>"28','444");
            foreach ($all_prefijos as $carrier => $value) {
                ?>
                <tr class="text-center table-dark text-dark">
                    <td colspan="5"><?php echo $carrier; ?></td>
                </tr>
                <?php 
                $maquilas_semanal="SELECT DISTINCT d_carrier_prefix, d_campaign_id, d_user_group,
                    IF (d_tipo_numero='movil',
                        IF (d_user_group = '', IF (d_status NOT IN ('NA', 'AA'),'Drop MoviL','Buzon Movil'),
                            'Movil'),
                        IF (d_user_group = '', IF (d_status NOT IN ('NA', 'AA'),'Drop Fijo','Buzon Fijo'),
                            'Fijo')
                    ) AS Tipo,    
                    SUM(redondea_a_minutos) AS Total
                    FROM reporte_{$reporte}
                    WHERE d_carrier_prefix IN ('{$value}')
                    AND u_start_time>='{$this->date_start} 00:00:00'
                    AND u_start_time<='{$this->date_end} 23:59:59'
                    AND c_dialstatus = 'ANSWER'
                    GROUP BY d_carrier_prefix, d_campaign_id, Tipo 
                    ORDER BY d_carrier_prefix, d_campaign_id, d_user_group,Tipo ASC;";
                $ans_maquilas_semanal=$this->conexion->query($maquilas_semanal);
                while ($rw=$ans_maquilas_semanal->fetch_object()) {
                    ?>
                        <tr>
                            <td><?php echo $rw->d_carrier_prefix; ?></td>
                            <td><?php echo $rw->d_campaign_id; ?></td>
                            <td><?php echo $rw->d_user_group; ?></td>
                            <td><?php echo $rw->Tipo; ?></td>
                            <td><?php echo $rw->Total; ?></td>
                        </tr>
                    <?php
                }
            }     
        }

        public function detector_maquilas($dato) {
           $query_detector="SELECT DISTINCT rt.campania, rt.grupo
           FROM reporte_telefonia rt
           WHERE fecha_inicio>='{$this->date_start} 00:00:00' AND fecha_termino<='{$this->date_end} 23:59:59'
           AND reporte='{$dato}' AND grupo !='N/A'
           ORDER BY rt.campania ASC";

            $answer_detector = $this->conexion ->query($query_detector);
            while ($row_content=$answer_detector->fetch_object()){
                //$reporte = $row_content->reporte;
                $campania = $row_content->campania;
                $grupo = $row_content->grupo;

                $query_dos = "SELECT DISTINCT sucursal, nombre_grupo, campania
                FROM sucu_campa_grup
                WHERE nombre_grupo = '{$grupo}';";
                //echo "<br>";

                $answer_dos = $this->conexion->query($query_dos);
                while ($row_dos=$answer_dos->fetch_object()) {
                    $sucursal = $row_dos->sucursal;
                    $nom_grupcliente = $row_dos->campania;
                    // var_dump($row_dos->sucursal);
                    // echo "<br>";
                    if (empty($sucursal)) {
                        $status_maquila = "Maquila NO reconocida";
                    } else {
                        $status_maquila = "Maquila reconocida";
                    }
                    ?>
                        <!--
                            No reconoce los resultados nullos
                        -->
                        <tr>
                            <td><?php echo $sucursal;?></td>
                            <td><?php echo $nom_grupcliente?></td>
                            <td><?php echo $campania?></td>
                            <td><?php echo $grupo?></td>
                            <td><?php echo $status_maquila?></td>
                            <td>
                                <button type="button" class="btn btn-light" data-toggle="modal" data-target="#modalMaquila<?php echo $grupo.$campania; ?>">
                                    Información detallada
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="modalMaquila<?php echo $grupo.$campania; ?>" tabindex="-1" role="dialog" aria-labelledby="modalEscorzaTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-info">
                                                <h5 class="modal-title text-dark" id="exampleModalLongTitle"><?php echo $sucursal; ?></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body bg-light">
                                                <?php 
                                                    $all_prefijos = array('Haz'=>"14','555", 'Marcatel'=>"15','777", 'MCM'=>"11','999", 'Ipcom'=>"28','444");
                                                    //var_dump($all_prefijos);
                                                    foreach ($all_prefijos as $carrier_array => $prefijo_usado) {
                                                ?>
                                                        <table class="table table-hover text-light table-light table-striped" style="font-size: 0.6em;">
                                                            <thead class="thead-inverse text-center thead-dark">
                                                                <tr>
                                                                    <th class="fs-5 text-left" colspan="6"><?php echo $carrier_array; ?></th>
                                                                </tr>
                                                                <tr class="">
                                                                    <th class="text-center"><strong>Prefijo</strong></th>
                                                                    <th><strong>Campaña</strong></th>
                                                                    <th><strong>Grupo</strong></th>
                                                                    <th><strong>Tipo</strong></th>
                                                                    <th><strong>Minutos</strong></th>
                                                                    <th><strong>Pesos</strong></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="text-dark ">
                                                                <?php
                                                                    $query_consumo_maquila = "SELECT DISTINCT a.prefijo, a.campania, a.grupo, SUM(consumo) AS Total,
                                                                    (CASE WHEN tipo = 'movil' THEN 'Movil'
                                                                      WHEN tipo = 'drop_movil'  THEN 'Drop Movil'
                                                                      WHEN tipo = 'buzon_movil'  THEN 'Buzon Movil'
                                                                      WHEN tipo = 'fijo'  THEN 'Fijo'
                                                                      WHEN tipo = 'drop_fijo'  THEN 'Drop Fijo'
                                                                      WHEN tipo = 'buzon_fijo'  THEN 'Buzon Fijo'
                                                                      END ) AS Tipo
                                                                    FROM reporte_telefonia a
                                                                    WHERE prefijo IN ('{$prefijo_usado}')
                                                                      AND a.campania = '{$campania}'
                                                                      AND fecha_inicio>='{$this->date_start} 00:00:00'
                                                                      AND fecha_termino<='{$this->date_end} 23:59:59'
                                                                      AND grupo NOT IN ('HSBC-STO-ESCORZA-MA', 'ADMIN')
                                                                      AND reporte='{$dato}'
                                                                      GROUP BY prefijo, campania, grupo, tipo,reporte
                                                                    ORDER BY prefijo,campania,grupo ASC;";
                                                                    $answer_consumo_maquilas = $this->conexion->query($query_consumo_maquila);    
                                                                    while ($as = $answer_consumo_maquilas->fetch_object()) {

                                                                        switch ($prefijo_usado) {
                                                                            case "15','777":
                                                                                if ($as->Tipo == 'Movil' || $as->Tipo == 'Drop Movil' || $as->Tipo == 'Buzon Movil') {
                                                                                    $costo_ = 0.11;
                                                                                } else {
                                                                                    $costo_ = 0.04;
                                                                                }
                                                                                $total = $as->Total;
                                                                                break;
                                                    
                                                                            case "28','444":
                                                                                if ($as->Tipo == 'Movil' || $as->Tipo == 'Drop Movil' || $as->Tipo == 'Buzon Movil') {
                                                                                    $costo_ = 0.11;
                                                                                } else {
                                                                                    $costo_ = 0.04;
                                                                                }
                                                                                $total = $as->Total;
                                                                                break;
                                                    
                                                                            case "11','999":
                                                                                if ($as->Tipo == 'Movil' || $as->Tipo == 'Drop Movil' || $as->Tipo == 'Buzon Movil') {
                                                                                    $costo_ = 0.11;
                                                                                } else {
                                                                                    $costo_ = 0.05;
                                                                                }
                                                                                $total = $as->Total;
                                                                                break;
                                                    
                                                                            case "14','555":
                                                                                if ($as->Tipo == 'Movil' || $as->Tipo == 'Drop Movil' || $as->Tipo == 'Buzon Movil') {
                                                                                    $costo_ = 0.09 / 60;
                                                                                } else {
                                                                                    $costo_ = 0.04 / 60;
                                                                                }
                                                                                $total = $as->Total /60 ;
                                                                                break;
                                                                        }
                                                                        ?>
                                                                        <tr>
                                                                            <td><?php echo $as->prefijo;?></td>
                                                                            <td><?php echo $as->campania;?></td>
                                                                            <td><?php echo $as->grupo;?></td>
                                                                            <td><?php echo $as->Tipo;?></td>
                                                                            <td class="text-right">
                                                                                <?php

                                                                                    echo number_format($total);
                                                                                ?>
                                                                            </td>
                                                                            <td class="text-right">
                                                                                <?php
                                                                                    $total_pesos = $as->Total * $costo_;
                                                                                    echo "$ ".number_format($total_pesos,2);
                                                                                ?>
                                                                            </td>
                                                                        </tr>                                                                        
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                        <br>
                                                <?php
                                                    }
                                                ?>
                                            </div>
                                            <div class="modal-footer bg-info">
                                                <h6>STO VANGUARDIA </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php

                }//Llave while query dos
            }//Llave while query uno
        }
    }//cierre de clase