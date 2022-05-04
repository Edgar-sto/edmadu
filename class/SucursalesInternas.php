<?php
class SucursalesInternas
{

    public function __construct($conexion, $f_inicio, $f_termino, $carrier, $prefijo)
    {
        $this->conexion     =   $conexion;
        $this->f_inicio     =   $f_inicio;
        $this->f_termino    =   $f_termino;
        $this->carrier      =   $carrier;
        $this->prefijo      =   $prefijo;
    }

    public function consumoEscorza()
    {
        /****campañas y grupos****/
        $campañas_grupos_escorza = array(
            "HSBC BT"  => "ADMIN-ESPECIALBALANC','HSBC-STO-ESCOR-LOWBT','HSBC-STO-ESCOR-MEDBT','HSBC-STO-ESCOR-TOPBT','LAB-BT','ADMIN-ESPECIALSUPERV','HSBC-STO-ESCORZA-BT','STO_BALANCE_TRASNFER",
            "HSBC LEC" => "HSBC-STO-ESCORZA-LEC",
            "HSBC MA"  => "HSBC-GERENTES','HSBC-STO-ESCORZA-MA','HSBC-STO-LABESCO-MA','ADMIN','VALIDACION','HSBC-STO-ESCORZA-M','ESPECIAL-CAMPAA','STO-FORMALIZACION','HSBC-STO-ESCORZA-CEC",
            "HSBC PPM" => "HSBC-PPM','LAB-PPM','ADMIN-ESPECIALPPM",
            "HSBC SG"  => "HSBC-SEGUROS','STO-STO-ESC-LABSEGUR",
            "HSBC CONS" => "n/a",
            "HSBC GA"  => "n/a",
            "HSBC AC"  => "n/a",
            "HSBC COM" => "n/a",

            "Santander MA" => "SANTANDER-STO-ESCORZ','LAB-ESC-SANT','SANTADER-STO-ESC-LAB','SANTAN-FORMALIZACION",

            "INVEX CE" => "n/a",
            "INVEX MA" => "n/a"
        );
        $all_prefijos      =   array(
            'Marcatel'    =>  "15','777",
            'MCM'         =>  "11','999",
            'Ipcom'       =>  "28','444",
            'Haz'         =>  "14','555"
        );
        ?>
        <table class="table table-hover" style="font-size: 10px;">
            <thead class="thead-inverse table-light  text-center">
                <tr>
                    <th class="fs-5" colspan="7"><?php echo $this->carrier; ?></th>
                </tr>
                <tr class="text-right">
                    <th class="text-center"><strong>Campaña</strong></th>
                    <th><strong>Movil</strong></th>
                    <th><strong>Fijo</strong></th>
                    <th><strong>Total</strong></th>
                    <th><strong>$ Movil</strong></th>
                    <th><strong>$ Fijo</strong></th>
                    <th><strong>$ Total</strong></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($campañas_grupos_escorza as $campanias => $grupos) {
                    switch ($this->prefijo) {
                        case "15','777":
                            $costo_movil = 0.11;
                            $costo_fijo = 0.04;
                            break;

                        case "28','444":
                            $costo_movil = 0.11;
                            $costo_fijo = 0.04;
                            break;

                        case "11','999":
                            $costo_movil = 0.11;
                            $costo_fijo = 0.05;
                            break;

                        case "14','555":
                            $costo_movil = 0.09 / 60;
                            $costo_fijo = 0.04 / 60;
                            break;
                    }
                    if ($campanias == "HSBC BT" || $campanias == "HSBC LEC" || $campanias == "HSBC MA" || $campanias == "HSBC PPM" || $campanias == "HSBC SG" || $campanias == "HSBC CONS" || $campanias == "HSBC GA" || $campanias == "HSBC AC" || $campanias == "HSBC COM") {
                        $fondobg = "table-danger";
                    } elseif ($campanias == "Santander MA") {
                        $fondobg = "table-warning";
                    } else {
                        $fondobg = "table-success";
                    }

                    $query_escorza_hsbc =
                        "SELECT
                            (SELECT SUM(consumo) FROM reporte_telefonia
                            WHERE fecha_inicio>='{$this->f_inicio} 00:00:00' AND fecha_termino<='{$this->f_termino} 23:59:59'
                            AND grupo IN ('{$grupos}')
                            AND tipo='movil' AND prefijo IN ('{$this->prefijo}')) AS movil,
                            (SELECT SUM(consumo) FROM reporte_telefonia
                            WHERE fecha_inicio>='{$this->f_inicio} 00:00:00' AND fecha_termino<='{$this->f_termino} 23:59:59'
                            AND grupo IN ('{$grupos}')
                            AND tipo='fijo' AND prefijo IN ('{$this->prefijo}')) AS fijo;";

                    $resultado_esc_hsbc = $this->conexion->query($query_escorza_hsbc);
                    while ($row_esc_hsbc = $resultado_esc_hsbc->fetch_object()) {
                        $consumo_movil    = $row_esc_hsbc->movil;
                        $consumo_fijo     = $row_esc_hsbc->fijo;
                        $total_min        = $consumo_movil + $consumo_fijo;

                        $con_movil = $consumo_movil * $costo_movil;
                        $con_fijo = $consumo_fijo * $costo_fijo;
                        $total_con = $con_movil + $con_fijo;
                ?>

                        <tr class="text-right">
                            <td class="<?php echo $fondobg; ?> text-center"><?php echo $campanias ?></td>
                            <td><?php echo number_format($consumo_movil); ?></td>
                            <td><?php echo number_format($consumo_fijo); ?></td>
                            <td><?php echo number_format($total_min); ?></td>
                            <td><?php echo "$" . number_format($con_movil, 2); ?></td>
                            <td><?php echo "$" . number_format($con_fijo, 2); ?></td>
                            <td scope="row"><?php echo "$" . number_format($total_con, 2); ?></td>
                        </tr>

                <?php
                    }
                }
                ?>
            </tbody>
        </table>
        <?php
    }

    public function consumoRevolucion()
    {
        /****campañas y grupos****/
        $campañas_grupos_revolucion = array(
            "HSBC BT"  => "BALANCE_TRASNFER_REV','HSBC-STO-REVO-BT",
            "HSBC LEC" => "n/a",
            "HSBC MA"  => "HSBC-REVOLUCION",
            "HSBC PPM" => "n/a",
            "HSBC SG"  => "HSBC-STO-REVO-SEGURO",
            "HSBC CONS" => "ADMIN-ESPECIALSUPERV','HSBC-STO-LABREV-COS','HSBC-STO-REV-CON-VAL','HSBC-STO-REV-CONSUMO','HSBC-CONSUMOS','ADMIN-ESPECIALCONSUM','LAB-CONSUMOS",
            "HSBC GA"  => "HSBC-STO-LABREV-GA','HSBC-STO-REV-GA','LAB-G4",
            "HSBC AC"  => "n/a",
            "HSBC COM" => "n/a",

            "Santander MA" => "SANTADER-STO-REV-LAB','SANTANDER-STO-REVO','SANTANDER-STO-ESP",

            "INVEX CE" => "STO-ACELERADOR','STO-ACELERADOR2','STO-INDIGO','STO-PROCERO','Camp_Especiales",
            "INVEX MA" => "STO-LAB','STO-MO','STO-VALDA','1800','01800"
        );
        $all_prefijos      =   array(
            'Marcatel'    =>  "15','777",
            'MCM'         =>  "11','999",
            'Ipcom'       =>  "28','444",
            'Haz'         =>  "14','555"
        );
        ?>
        <table class="table table-hover" style="font-size: 10px;">
            <thead class="thead-inverse table-light  text-center">
                <tr>
                    <th class="fs-5" colspan="7"><?php echo $this->carrier; ?></th>
                </tr>
                <tr class="text-right">
                    <th class="text-center"><strong>Campaña</strong></th>
                    <th><strong>Movil</strong></th>
                    <th><strong>Fijo</strong></th>
                    <th><strong>Total</strong></th>
                    <th><strong>$ Movil</strong></th>
                    <th><strong>$ Fijo</strong></th>
                    <th><strong>$ Total</strong></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($campañas_grupos_revolucion as $campanias => $grupos) {
                    switch ($this->prefijo) {
                        case "15','777":
                            $costo_movil = 0.11;
                            $costo_fijo = 0.04;
                            break;

                        case "28','444":
                            $costo_movil = 0.11;
                            $costo_fijo = 0.04;
                            break;

                        case "11','999":
                            $costo_movil = 0.11;
                            $costo_fijo = 0.05;
                            break;

                        case "14','555":
                            $costo_movil = 0.09 / 60;
                            $costo_fijo = 0.04 / 60;
                            break;
                    }
                    if ($campanias == "HSBC BT" || $campanias == "HSBC LEC" || $campanias == "HSBC MA" || $campanias == "HSBC PPM" || $campanias == "HSBC SG" || $campanias == "HSBC CONS" || $campanias == "HSBC GA" || $campanias == "HSBC AC" || $campanias == "HSBC COM") {
                        $fondobg = "table-danger";
                    } elseif ($campanias == "Santander MA") {
                        $fondobg = "table-warning";
                    } else {
                        $fondobg = "table-success";
                    }

                    $query_escorza_hsbc =
                        "SELECT
                            (SELECT SUM(consumo) FROM reporte_telefonia
                            WHERE fecha_inicio>='{$this->f_inicio} 00:00:00' AND fecha_termino<='{$this->f_termino} 23:59:59'
                            AND grupo IN ('{$grupos}')
                            AND tipo='movil' AND prefijo IN ('{$this->prefijo}')) AS movil,
                            (SELECT SUM(consumo) FROM reporte_telefonia
                            WHERE fecha_inicio>='{$this->f_inicio} 00:00:00' AND fecha_termino<='{$this->f_termino} 23:59:59'
                            AND grupo IN ('{$grupos}')
                            AND tipo='fijo' AND prefijo IN ('{$this->prefijo}')) AS fijo;";

                    $resultado_esc_hsbc = $this->conexion->query($query_escorza_hsbc);
                    while ($row_esc_hsbc = $resultado_esc_hsbc->fetch_object()) {
                        $consumo_movil    = $row_esc_hsbc->movil;
                        $consumo_fijo     = $row_esc_hsbc->fijo;
                        $total_min        = $consumo_movil + $consumo_fijo;

                        $con_movil = $consumo_movil * $costo_movil;
                        $con_fijo = $consumo_fijo * $costo_fijo;
                        $total_con = $con_movil + $con_fijo;
                ?>

                        <tr class="text-right">
                            <td class="<?php echo $fondobg; ?> text-center"><?php echo $campanias ?></td>
                            <td><?php echo number_format($consumo_movil); ?></td>
                            <td><?php echo number_format($consumo_fijo); ?></td>
                            <td><?php echo number_format($total_min); ?></td>
                            <td><?php echo "$" . number_format($con_movil, 2); ?></td>
                            <td><?php echo "$" . number_format($con_fijo, 2); ?></td>
                            <td scope="row"><?php echo "$" . number_format($total_con, 2); ?></td>
                        </tr>

                <?php
                    }
                }
                ?>
            </tbody>
        </table>
        <?php
    }

    public function consumoTlajomulco()
    {
        /****campañas y grupos****/
        $campañas_grupos_tlajomulco = array(
            "HSBC BT"  => "BALANCE_TRANSFER_TLA','HSBC-STO-TLA-BT','HSBC-STO-TLAJO-LOWBT','HSBC-STO-TLAJO-MEDBT','HSBC-STO-TLAJO-TOPBT','HSBC-STO-TLALAB-BT",
            "HSBC LEC" => "n/a",
            "HSBC MA"  => "HSBC_TLAJOMULCO','HSBC-TLAJOMULCO','HSBC-STO-LABTLA-MA','ADMIN-ESPECIAL-SUPER",
            "HSBC PPM" => "n/a",
            "HSBC SG"  => "",
            "HSBC CONS" => "",
            "HSBC GA"  => "ADMIN-ESPECIAL-GA','HSBC-STO-TLA-GA-VAL','HSBC-STO-TLAJO-GA','ADMIN-ESPE-GERENTES",
            "HSBC AC"  => "HSBC-STO-TLAJO-ACT','HSBC-STO-TLAJO-ACTIV",
            "HSBC COM" => "HSBC-COM",

            "Santander MA" => "SANTANDER-STO-TLAJO",

            "INVEX CE" => "n/a",
            "INVEX MA" => "n/a"
        );
        $all_prefijos      =   array(
            'Marcatel'    =>  "15','777",
            'MCM'         =>  "11','999",
            'Ipcom'       =>  "28','444",
            'Haz'         =>  "14','555"
        );
        ?>
        <table class="table table-hover" style="font-size: 10px;">
            <thead class="thead-inverse table-light  text-center">
                <tr>
                    <th class="fs-5" colspan="7"><?php echo $this->carrier; ?></th>
                </tr>
                <tr class="text-right">
                    <th class="text-center"><strong>Campaña</strong></th>
                    <th><strong>Movil</strong></th>
                    <th><strong>Fijo</strong></th>
                    <th><strong>Total</strong></th>
                    <th><strong>$ Movil</strong></th>
                    <th><strong>$ Fijo</strong></th>
                    <th><strong>$ Total</strong></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($campañas_grupos_tlajomulco as $campanias => $grupos) {
                    switch ($this->prefijo) {
                        case "15','777":
                            $costo_movil = 0.11;
                            $costo_fijo = 0.04;
                            break;

                        case "28','444":
                            $costo_movil = 0.11;
                            $costo_fijo = 0.04;
                            break;

                        case "11','999":
                            $costo_movil = 0.11;
                            $costo_fijo = 0.05;
                            break;

                        case "14','555":
                            $costo_movil = 0.09 / 60;
                            $costo_fijo = 0.04 / 60;
                            break;
                    }
                    if ($campanias == "HSBC BT" || $campanias == "HSBC LEC" || $campanias == "HSBC MA" || $campanias == "HSBC PPM" || $campanias == "HSBC SG" || $campanias == "HSBC CONS" || $campanias == "HSBC GA" || $campanias == "HSBC AC" || $campanias == "HSBC COM") {
                        $fondobg = "table-danger";
                    } elseif ($campanias == "Santander MA") {
                        $fondobg = "table-warning";
                    } else {
                        $fondobg = "table-success";
                    }

                    $query_escorza_hsbc =
                        "SELECT
                            (SELECT SUM(consumo) FROM reporte_telefonia
                            WHERE fecha_inicio>='{$this->f_inicio} 00:00:00' AND fecha_termino<='{$this->f_termino} 23:59:59'
                            AND grupo IN ('{$grupos}')
                            AND tipo='movil' AND prefijo IN ('{$this->prefijo}')) AS movil,
                            (SELECT SUM(consumo) FROM reporte_telefonia
                            WHERE fecha_inicio>='{$this->f_inicio} 00:00:00' AND fecha_termino<='{$this->f_termino} 23:59:59'
                            AND grupo IN ('{$grupos}')
                            AND tipo='fijo' AND prefijo IN ('{$this->prefijo}')) AS fijo;";

                    $resultado_esc_hsbc = $this->conexion->query($query_escorza_hsbc);
                    while ($row_esc_hsbc = $resultado_esc_hsbc->fetch_object()) {
                        $consumo_movil    = $row_esc_hsbc->movil;
                        $consumo_fijo     = $row_esc_hsbc->fijo;
                        $total_min        = $consumo_movil + $consumo_fijo;

                        $con_movil = $consumo_movil * $costo_movil;
                        $con_fijo = $consumo_fijo * $costo_fijo;
                        $total_con = $con_movil + $con_fijo;
                ?>

                        <tr class="text-right">
                            <td class="<?php echo $fondobg; ?> text-center"><?php echo $campanias ?></td>
                            <td><?php echo number_format($consumo_movil); ?></td>
                            <td><?php echo number_format($consumo_fijo); ?></td>
                            <td><?php echo number_format($total_min); ?></td>
                            <td><?php echo "$" . number_format($con_movil, 2); ?></td>
                            <td><?php echo "$" . number_format($con_fijo, 2); ?></td>
                            <td scope="row"><?php echo "$" . number_format($total_con, 2); ?></td>
                        </tr>

                <?php
                    }
                }
                ?>
            </tbody>
        </table>
        <?php
    }

    public function consumoDropBuzon()
    {
        ?>
        <table class="table table-hover" style="font-size: 10px;">
            <thead class="thead-inverse table-light  text-center">
                <tr>
                    <th class="fs-5" colspan="7"><?php echo $this->carrier; ?></th>
                </tr>
                <tr class="text-right">
                    <th class="text-center"><strong>Campaña</strong></th>
                    <th><strong>Movil</strong></th>
                    <th><strong>Fijo</strong></th>
                    <th><strong>Total</strong></th>
                    <th><strong>$ Movil</strong></th>
                    <th><strong>$ Fijo</strong></th>
                    <th><strong>$ Total</strong></th>
                </tr>
            </thead>
            <tbody>
                <?php
                switch ($this->prefijo) {
                    case "15','777":
                        $costo_movil = 0.11;
                        $costo_fijo = 0.04;
                        break;

                    case "28','444":
                        $costo_movil = 0.11;
                        $costo_fijo = 0.04;
                        break;

                    case "11','999":
                        $costo_movil = 0.11;
                        $costo_fijo = 0.05;
                        break;

                    case "14','555":
                        $costo_movil = 0.09 / 60;
                        $costo_fijo = 0.04 / 60;
                        break;
                }
                $drop_buzon = "SELECT
                            (SELECT SUM(consumo) FROM reporte_telefonia
                            WHERE fecha_inicio>='{$this->f_inicio} 00:00:00' AND fecha_termino<='{$this->f_termino} 23:59:59'
                            AND grupo IN ('N/A')  AND tipo='drop_movil' AND prefijo IN ('{$this->prefijo}')
                            AND reporte NOT IN ('10.9.2.39','10.9.2.22','10.9.2.27','10.9.2.28','10.9.2.38','10.9.2.41','10.9.2.57')) AS dropmovil,
                            
                            (SELECT SUM(consumo) FROM reporte_telefonia
                            WHERE fecha_inicio>='{$this->f_inicio} 00:00:00' AND fecha_termino<='{$this->f_termino} 23:59:59'
                            AND grupo IN ('N/A') AND tipo='drop_fijo' AND prefijo IN ('{$this->prefijo}')
                            AND reporte NOT IN ('10.9.2.39','10.9.2.22','10.9.2.27','10.9.2.28','10.9.2.38','10.9.2.41','10.9.2.57')) AS dropfijo,
                            
                            
                            (SELECT SUM(consumo) FROM reporte_telefonia
                            WHERE fecha_inicio>='{$this->f_inicio} 00:00:00' AND fecha_termino<='{$this->f_termino} 23:59:59'
                            AND grupo IN ('N/A') AND tipo='buzon_movil' AND prefijo IN ('{$this->prefijo}')
                            AND reporte NOT IN ('10.9.2.39','10.9.2.22','10.9.2.27','10.9.2.28','10.9.2.38','10.9.2.41','10.9.2.57')) AS buzonmovil,
                            
                            (SELECT SUM(consumo) FROM reporte_telefonia
                            WHERE fecha_inicio>='{$this->f_inicio} 00:00:00' AND fecha_termino<='{$this->f_termino} 23:59:59'
                            AND grupo IN ('N/A') AND tipo='buzon_fijo' AND prefijo IN ('{$this->prefijo}')
                            AND reporte NOT IN ('10.9.2.39','10.9.2.22','10.9.2.27','10.9.2.28','10.9.2.38','10.9.2.41','10.9.2.57','10.9.2.39')) AS buzonfijo;";
                $answer_Drop_buzon = $this->conexion->query($drop_buzon);
                while ($row_drop_buzon = $answer_Drop_buzon->fetch_object()) {
                    $dropmovil    = $row_drop_buzon->dropmovil;
                    $dropfijo     = $row_drop_buzon->dropfijo;
                    $buzonmovil   = $row_drop_buzon->buzonmovil;
                    $buzonfijo    = $row_drop_buzon->buzonfijo;

                    $t_min_drop    =    $dropmovil + $dropfijo;
                    $t_min_buzon   =    $buzonmovil + $buzonfijo;

                    $total_dropmovil    = $dropmovil  *   $costo_movil;
                    $total_dropfijo     = $dropfijo   *   $costo_fijo;
                    $total_drop         = $total_dropmovil + $total_dropfijo;


                    $total_buzonmovil   = $buzonmovil *   $costo_movil;
                    $total_buzonfijo    = $buzonfijo  *   $costo_fijo;
                    $total_buzon        = $total_buzonmovil + $total_buzonfijo;
                ?>

                    <tr class="text-right">
                        <td class="bg-secondaru">DROP</td>
                        <td><?php echo number_format($dropmovil); ?></td>
                        <td><?php echo number_format($dropfijo); ?></td>
                        <td><?php echo number_format($t_min_drop); ?></td>

                        <td><?php echo "$" . number_format($total_dropmovil, 2); ?></td>
                        <td><?php echo "$" . number_format($total_dropfijo, 2); ?></td>
                        <td scope="row"><?php echo "$" . number_format($total_drop, 2); ?></td>
                    </tr>

                    <tr class="text-right">
                        <td class="bg-secondaru">BUZÓN</td>
                        <td><?php echo number_format($buzonmovil); ?></td>
                        <td><?php echo number_format($buzonfijo); ?></td>
                        <td><?php echo number_format($t_min_buzon); ?></td>

                        <td><?php echo "$" . number_format($total_buzonmovil, 2); ?></td>
                        <td><?php echo "$" . number_format($total_buzonfijo, 2); ?></td>
                        <td scope="row"><?php echo "$" . number_format($total_buzon, 2); ?></td>
                    </tr>

                <?php
                }
                ?>
            </tbody>
        </table>
        <?php
    }

    public function consumoAdministrativo()
    {
        ?>
        <table class="table table-hover" style="font-size: 10px;">
            <thead class="thead-inverse table-light  text-center">
                <tr>
                    <th class="fs-5" colspan="7"><?php echo $this->carrier; ?></th>
                </tr>
                <tr class="text-right">
                    <th class="text-center"><strong>Campaña</strong></th>
                    <th><strong>Movil</strong></th>
                    <th><strong>Fijo</strong></th>
                    <th><strong>Total</strong></th>
                    <th><strong>$ Movil</strong></th>
                    <th><strong>$ Fijo</strong></th>
                    <th><strong>$ Total</strong></th>
                </tr>
            </thead>
            <tbody>
                <?php
                switch ($this->prefijo) {
                    case "15','777":
                        $costo_movil = 0.11;
                        $costo_fijo = 0.04;
                        break;

                    case "28','444":
                        $costo_movil = 0.11;
                        $costo_fijo = 0.04;
                        break;

                    case "11','999":
                        $costo_movil = 0.11;
                        $costo_fijo = 0.05;
                        break;

                    case "14','555":
                        $costo_movil = 0.09 / 60;
                        $costo_fijo = 0.04 / 60;
                        break;
                }
                $query_consumo_admin = "SELECT
                (SELECT SUM(consumo) FROM consumo_administrativo c WHERE c.fecha_inicio>='{$this->f_inicio} 00:00:00' AND c.fecha_termino<='{$this->f_termino} 23:59:59' AND tipo='celular' AND carrier IN ('{$this->carrier}')) AS movil,
                (SELECT SUM(consumo) FROM consumo_administrativo c WHERE c.fecha_inicio>='{$this->f_inicio} 00:00:00' AND c.fecha_termino<='{$this->f_termino} 23:59:59' AND tipo='fijo' AND carrier IN ('{$this->carrier}')) AS fijo,
                (SELECT SUM(consumo) FROM consumo_administrativo c WHERE c.fecha_inicio>='{$this->f_inicio} 00:00:00' AND c.fecha_termino<='{$this->f_termino} 23:59:59' AND tipo='NA' AND carrier IN ('{$this->carrier}')) AS na;";
                $answer_consumo_admin = $this->conexion->query($query_consumo_admin);
                while ($row_consumo_admin=$answer_consumo_admin->fetch_object()) {
                    $row_consumo_admin->movil;
                    $row_consumo_admin->na;
                    $fijo  =  $row_consumo_admin->fijo;
                    $movil  =  $row_consumo_admin->movil + $row_consumo_admin->na;
                    $fij_mov  =  $fijo + $movil;

                    $fijo_pesos  =  $fijo * $costo_fijo;
                    $movil_pesos  =  $movil * $costo_movil;

                    $total_pesos  =  $fijo_pesos + $movil_pesos;
                ?>

                    <tr class="text-right">
                        <td class="bg-secondaru">Administrativo</td>
                        <td><?php echo number_format($fijo); ?></td>
                        <td><?php echo number_format($movil); ?></td>
                        <td><?php echo number_format($fij_mov); ?></td>

                        <td><?php echo "$" . number_format($fijo_pesos, 2); ?></td>
                        <td><?php echo "$" . number_format($movil_pesos, 2); ?></td>
                        <td scope="row"><?php echo "$" . number_format($total_pesos, 2); ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <?php
    }
}
