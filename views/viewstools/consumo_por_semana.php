<?php

$semanas = array('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31','32','33','34','35','36','37','38','39','40','41','42','43','44','45','46','47','48','49','50','51','52');


foreach ($semanas AS $value) {
    $queryConsumoSemanal = "SELECT  DISTINCT (tipo_consumo), name, carrier, prefijo, consumo,
        (CASE WHEN tipo_marcacion = 'movil' THEN 'Movil'
            WHEN tipo_marcacion = 'fijo'  THEN 'Fijo'
            END ) AS Tipo
        FROM consumo_semanal
        WHERE name = 'Semana {$value}'
        GROUP BY tipo_consumo, carrier, prefijo, consumo, tipo_marcacion;";

        ?>
        <table class="table" >
                <thead>
                    <tr>
                        <th class="text-capitalize text-center" style="font-size: 18px;" colspan="4">Semana <?php echo $value; ?></th>
                    </tr>
                    <tr>
                        <th>Carrier</th>
                        <th>Tipo</th>
                        <th>Tipo Marcacion</th>
                        <th>Consumo</th>
                    </tr>
                </thead>
                <tbody>
        <?php
    $answerConsumoSemanal = $conexion->query($queryConsumoSemanal);
    while ($w = $answerConsumoSemanal->fetch_object()) {
        $w->tipo_consumo;
        $w->name;
        $w->carrier;
        $w->prefijo;
        $w->consumo;
        $w->Tipo;
        if ($w->tipo_consumo == 'minutos') {

        } else {
            ?>
            <tr class="table-active">
                <td><?php echo $w->carrier;?></td>
                <td class="text-capitalize"><?php echo $w->tipo_consumo;?></td>
                <td><?php echo $w->Tipo;?></td>
                <td><?php echo $w->consumo;?></td>
            </tr>
            <?php
        }
    }//Llave cierre while consulta
    ?>
            </tbody>
        </table>
        <br>
    <?php
}//Llave cierre foreach

