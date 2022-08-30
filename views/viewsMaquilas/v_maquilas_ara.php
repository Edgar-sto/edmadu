<?php
include_once '../../class/conexion.php';
include_once '../../class/prefijos.php';
include_once '../../class/MaquilaClass.php';
$fecha_inicio   =   $_POST['fecha_inicio'];
$fecha_fin      =   $_POST['fecha_termino'];
$conexion = conexion_local('telefonia', '10.9.2.147');
$conexion21 = conexion_21('telefonia', '10.9.2.21');

$ara_maqui = new MaquilaClass($conexion,$fecha_inicio,$fecha_fin);
$ara_maqui->obt_numero_reporte();

foreach ($ara_maqui->obt_numero_reporte() as $reporte) {
    ?>
    <div class="col col-12">
        <div class="card m-3" style="width: 100%;">
            <div class="card-header">
                <h5 class="card-title"><?php echo "10.9.2.".$reporte; ?></h5>
            </div>
            <div class="card-body">
                <div class="table-responsive-lg card-text">
                    <table class="table table-sm table-hover">
                        <thead class="">
                            <tr>
                                <th colspan="7" class="text-center"><?php echo $reporte; ?></th>
                            </tr>
                            <tr>
                                <th scope="col">Prefijo</th>
                                <th scope="col">Campaña</th>
                                <th scope="col">Grupo</th>
                                <th scope="col">Tipo</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $ara_maquila_consumo = new MaquilaClass($conexion21,$fecha_inicio,$fecha_fin);
                                $ara_maquila_consumo->maquilas_ara($reporte);
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php
}
