<?php
include '../clases/conexion.php';
include '../clases/obtenerSucursal.php';

$conexion = conexion_dc_centos("telefonia", "127.0.0.1");
$carrier = $_POST['carrier'];
$fecha_inicio = $_POST['fecha_inicio'];
$fecha_termino = $_POST['fecha_termino'];

//INSTANCIA DE CLASE PARA DEFINIR PREFIJOS A USAR
if ($carrier == 'Marcatel') {
    $prefijos = array("15", "777");
} else if ($carrier == 'MCM') {
    $prefijos = array("11", "999");
} else if ($carrier == "Ipcom") {
    $prefijos = array("28", "444");
} else if ($carrier == "Hazz") {
    $prefijos = array("14", "555");
} else {
    $prefijos = array("15", "777", "11", "999", "28", "444", "14", "555");
}
?>
    <div class="container">
        <div class="row text-center">
            <a class="" role="button" href="http://127.0.0.1/definitivo/reporte_tel/excel/reporte_excel.php?fecha_inicio=<?php echo "{$fecha_inicio}"; ?>&&fecha_termino=<?php echo "{$fecha_termino}"; ?>&&carrier=<?php echo "{$carrier}"; ?>">
                <svg class="icon icon-tabler icon-tabler-file-download" width="24" height="24" viewBox="0 0 24 24" stroke-width="1" stroke="#00b341" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                    <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
                    <line x1="12" y1="11" x2="12" y2="17"></line>
                    <polyline points="9 14 12 17 15 14"></polyline>
                </svg>
            </a>
        </div>
    </div>
<?php



 
$tam_prefijo = count($prefijos);
for ($i=0; $i < $tam_prefijo; $i++) { 
    $prefix=$prefijos[$i];

    $consulta = "SELECT DISTINCT reporte FROM reporte_telefonia
            WHERE fecha_inicio>='{$fecha_inicio} 00:00:00' and fecha_termino<='{$fecha_termino} 23:59:59'
            AND prefijo IN ('{$prefix}') ORDER BY reporte";
    $resultado = $conexion->query($consulta);
    while ($row = $resultado->fetch_object()) {
        /**REPORTE */
        $row->reporte;
?>
    <div class="table-responsive-lg">
    <table class="table table-sm table-hover table-bordered border-dark align-middle caption-top table-secondary">
        <thead class="table-dark">
            <tr>
                <th colspan="7" class="text-center"><?php echo $row->reporte; ?></th>
            </tr>
            <tr>
                <th scope="col">ID.Campaña</th>
                <th scope="col">Prefijos</th>
                <th scope="col">Sucursal</th>
                <th scope="col">Grupo</th>
                <th scope="col">Evento</th>
                <th scope="col">Consumo Movil</th>
                <th scope="col">Consumo Fijo</th>
            </tr>
        </thead>
        <tbody>
<?php
        $query_campania="SELECT DISTINCT campania FROM reporte_telefonia
        WHERE fecha_inicio>='{$fecha_inicio} 00:00:00' and fecha_termino<='{$fecha_termino} 23:59:59'
        AND reporte='{$row->reporte}' AND prefijo IN ('{$prefix}')";

        $resultado_campania=$conexion->query($query_campania);
        while ($row_camp = $resultado_campania->fetch_object()) {
            $row_camp->campania;

            $query_grupos="SELECT DISTINCT grupo FROM reporte_telefonia
            WHERE fecha_inicio>='{$fecha_inicio} 00:00:00' and fecha_termino<='{$fecha_termino} 23:59:59'
            AND prefijo IN ('{$prefix}') AND reporte='{$row->reporte}' AND campania='{$row_camp->campania}'";

            $resultado_grupos = $conexion->query($query_grupos);
            while ($row_grupo=$resultado_grupos->fetch_object()) {
                $row_grupo->grupo;
                $nombre_grupo = $row_grupo->grupo;

                $query_movil_fijo = "SELECT
                (SELECT SUM(consumo) FROM reporte_telefonia
                WHERE fecha_inicio>='{$fecha_inicio} 00:00:00' and fecha_termino<='{$fecha_termino} 23:59:59'
                AND tipo='movil' AND reporte='{$row->reporte}' AND prefijo IN ('{$prefix}') AND campania='{$row_camp->campania}'
                AND grupo='{$row_grupo->grupo}') AS movil,
                (SELECT SUM(consumo) FROM reporte_telefonia
                WHERE fecha_inicio>='{$fecha_inicio} 00:00:00' and fecha_termino<='{$fecha_termino} 23:59:59'
                AND tipo='fijo' AND reporte='{$row->reporte}' AND prefijo IN ('{$prefix}') AND campania='{$row_camp->campania}'
                AND grupo='{$row_grupo->grupo}') AS fijo";
                
                $resultado_mf=$conexion->query($query_movil_fijo);
                $array_mf=array();
                while($row_mf=$resultado_mf->fetch_object()){
                    $row_mf->movil;
                    $row_mf->fijo;
                    
                    // if ($row_grupo->grupo == 'DROP MOVIL' || $row_grupo->grupo == 'DROP FIJO' || $row_grupo->grupo == 'BUZON MOVIL' || $row_grupo->grupo == 'BUZON FIJO') {
                    if ($row_grupo->grupo == 'N/A') 
                    {
                        
                    } else {
                        ?>
                        <tr>
                            <td><?php echo $row_camp->campania; ?></td>
                            <td><?php echo $prefix; ?></td>
                            <td>
                                <?php 
                                    $group = new sucursal($conexion,$nombre_grupo);
                                    $group->obtSucursal();
                                    foreach ($group->obtSucursal() as $sucursalValue) {
                                        echo $sucursalValue." ";
                                    }
                                ?>
                            </td>
                            <td><?php echo $row_grupo->grupo; ?></td>
                            <td></td>
                            <td><?php echo number_format($row_mf->movil);?> </td>
                            <td><?php echo number_format($row_mf->fijo); ?> </td>
                        </tr>
                        <?php
                    }
                } /**CIERRE WHILE OBTENER CONSUMO FIJO-MOVIL */
            }/**CIERRE WHILE OBTENER GRUPOS */
                $query_dmovil_dfijo = "SELECT 
                (SELECT SUM(consumo) FROM reporte_telefonia
                WHERE fecha_inicio>='{$fecha_inicio} 00:00:00' and fecha_termino<='{$fecha_termino} 23:59:59'
                AND tipo='drop_movil' AND reporte='{$row->reporte}' AND prefijo IN ('{$prefix}') AND campania='{$row_camp->campania}'
                AND grupo='DROP MOVIL') AS drop_movil,
                (SELECT SUM(consumo) FROM reporte_telefonia
                WHERE fecha_inicio>='{$fecha_inicio} 00:00:00' and fecha_termino<='{$fecha_termino} 23:59:59'
                AND tipo='drop_fijo' AND reporte='{$row->reporte}' AND prefijo IN ('{$prefix}') AND campania='{$row_camp->campania}'
                AND grupo='DROP FIJO') AS drop_fijo";
                    
                $resultado_DropMF=$conexion->query($query_dmovil_dfijo);
                while ($row_drop=$resultado_DropMF->fetch_object()) {
                    $row_drop->drop_movil;
                    $row_drop->drop_fijo;
                    ?>
                    <tr class="table-warning">
                        <td><?php echo $row_camp->campania; ?></td>
                        <td><?php echo $prefix; ?></td>
                        <td></td>
                        <td>DROP</td>
                        <td></td>
                        <td><?php echo number_format($row_drop->drop_movil);?></td>
                        <td><?php echo number_format($row_drop->drop_fijo); ?></td>
                    </tr>
                    <?php
                }
                $query_Bmovil_bfijo ="SELECT 
                (SELECT SUM(consumo) FROM reporte_telefonia
                WHERE fecha_inicio>='{$fecha_inicio} 00:00:00' and fecha_termino<='{$fecha_termino} 23:59:59'
                AND tipo='buzon_movil' AND reporte='{$row->reporte}' AND prefijo IN ('{$prefix}') AND campania='{$row_camp->campania}'
                AND grupo='BUZON MOVIL') AS buzon_movil,
                (SELECT SUM(consumo) FROM reporte_telefonia
                WHERE fecha_inicio>='{$fecha_inicio} 00:00:00' and fecha_termino<='{$fecha_termino} 23:59:59'
                AND tipo='buzon_fijo' AND reporte='{$row->reporte}' AND prefijo IN ('{$prefix}') AND campania='{$row_camp->campania}'
                AND grupo='BUZON FIJO') AS buzon_fijo";
                
                $resultado_buzonMF=$conexion->query($query_Bmovil_bfijo);
                while ($row_buzon=$resultado_buzonMF->fetch_object()) {
                    $row_buzon->buzon_movil;
                    $row_buzon->buzon_fijo;
                    ?>
                    <tr class="table-warning">
                        <td><?php echo $row_camp->campania; ?></td>
                        <td><?php echo $prefix; ?></td>
                        <td></td>
                        <td>BUZON</td>
                        <td></td>
                        <td><?php echo number_format($row_buzon->buzon_movil);?> </td>
                        <td><?php echo number_format($row_buzon->buzon_fijo);?> </td>
                    </tr>
                    <?php
                }/**CIERRE WHILE BUZON */
                    ?>
                    <tr class="table-warning">
                        <td><?php echo $row_camp->campania; ?></td>
                        <td><?php echo $prefix; ?></td>
                        <td></td>
                        <td>CAMPAÑA0</td>
                        <td></td>
                        <td>0</td>
                        <td>0</td>
                    </tr>
                    <?php
        }/**CIERRE DE WHILE OBTNER CAMPAÑAS */ 
    }/**CIERRE DE WHILE OBTENER REPORTES */
    ?></div><?php
}/**CIERRE DE FOR PARA RECORRER PREFIJOS */
?>