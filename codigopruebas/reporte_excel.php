<?php
include '../clases/conexion.php';
include '../clases/searchReporte.php';
include '../clases/selecCarrier.php';
include '../clases/searchCampania.php';
include '../clases/searchGrupo.php';
include '../clases/searchConsumo.php';

$conexion = conexion_dc_centos('telefonia', '127.0.0.1');
$fecha_inicio   =   $_GET['fecha_inicio'];
$fecha_termino  =   $_GET['fecha_termino'];
$carrier        =   $_GET['carrier'];
//Seccion para exportar a excel debe estar activa si o si
//$name=".$conexion."-".$fecha_inicio."-".$fecha_termino.xls";
$docuname="TELEFONIA.xls";
header('Content-type: application/vnd.ms-excel'); 
header('Content-Disposition: attachment; filename='.$docuname);
header('Pragma: no-cache');
header('Expires: 0');
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

//INSTANCIA PARA OBTENER LOS REPORTES CON EL PREFIJO SELECCIONADO
$tam_prefijo = count($prefijos);
for ($i=0; $i < $tam_prefijo; $i++) { 
    $prefix=$prefijos[$i];

    $consulta = "SELECT DISTINCT reporte FROM reporte_telefonia
            WHERE fecha_inicio>='{$fecha_inicio} 00:00:00' and fecha_termino<='{$fecha_termino} 23:59:59'
            AND prefijo IN ('{$prefix}') ORDER BY reporte";
    $resultado = $conexion->query($consulta);
    while ($row = $resultado->fetch_object()) {
        $row->reporte;
?>     
    <div class="table-responsive-lg">
    <table class="table table-sm table-hover table-bordered border-dark align-middle caption-top">
        <thead class="table-primary">
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
                    
                    if ($row_grupo->grupo == 'N/A') {
                        
                    } else {
                        ?>
                        <tr>
                            <td><?php echo $row_camp->campania; ?></td>
                            <td><?php echo $prefix; ?></td>
                            <td></td>
                            <td><?php echo $row_grupo->grupo; ?></td>
                            <td></td>
                            <td><?php echo $row_mf->movil;?> </td>
                            <td><?php echo $row_mf->fijo; ?> </td>
                        </tr>
                        <?php
                    }
                } /**CIERRE WHILE OBTENER CONSUMO FIJO-MOVIL */
            }/**CIERRE WHILE OBTENER GRUPOS */
                $query_dmovil_dfijo = "SELECT 
                (SELECT SUM(consumo) FROM reporte_telefonia
                WHERE fecha_inicio>='{$fecha_inicio} 00:00:00' and fecha_termino<='{$fecha_termino} 23:59:59'
                AND tipo='drop_movil' AND reporte='{$row->reporte}' AND prefijo IN ('{$prefix}') AND campania='{$row_camp->campania}'
                AND grupo='N/A') AS drop_movil,
                (SELECT SUM(consumo) FROM reporte_telefonia
                WHERE fecha_inicio>='{$fecha_inicio} 00:00:00' and fecha_termino<='{$fecha_termino} 23:59:59'
                AND tipo='drop_fijo' AND reporte='{$row->reporte}' AND prefijo IN ('{$prefix}') AND campania='{$row_camp->campania}'
                AND grupo='N/A') AS drop_fijo";
                    
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
                        <td><?php echo $row_drop->drop_movil;?></td>
                        <td><?php echo $row_drop->drop_fijo; ?></td>
                    </tr>
                    <?php
                }
                $query_Bmovil_bfijo ="SELECT 
                (SELECT SUM(consumo) FROM reporte_telefonia
                WHERE fecha_inicio>='{$fecha_inicio} 00:00:00' and fecha_termino<='{$fecha_termino} 23:59:59'
                AND tipo='buzon_movil' AND reporte='{$row->reporte}' AND prefijo IN ('{$prefix}') AND campania='{$row_camp->campania}'
                AND grupo='N/A') AS buzon_movil,
                (SELECT SUM(consumo) FROM reporte_telefonia
                WHERE fecha_inicio>='{$fecha_inicio} 00:00:00' and fecha_termino<='{$fecha_termino} 23:59:59'
                AND tipo='buzon_fijo' AND reporte='{$row->reporte}' AND prefijo IN ('{$prefix}') AND campania='{$row_camp->campania}'
                AND grupo='N/A') AS buzon_fijo";
                
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
                        <td><?php echo $row_buzon->buzon_fijo;?> </td>
                        <td><?php echo $row_buzon->buzon_fijo;?> </td>
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
}/**CIERRE DE FOR PARA RECORRER PREFIJOS */
?>