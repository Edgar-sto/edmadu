<?php
include_once '../../class/conexion.php';
include_once '../../class/prefijos.php';
include_once '../../class/MaquilaClass.php';
$fecha_inicio   =   $_POST['fecha_inicio'];
$fecha_fin      =   $_POST['fecha_termino'];
$conexion = conexion_global('10.9.2.244','soporte','Z3pu0rg','telefonia');

$maquilas = new MaquilaClass($conexion,$fecha_inicio,$fecha_fin);
$maquilas->obt_vici_maquila();


foreach ($maquilas->obt_vici_maquila() AS $vici) {
    ?>
    <div class="col col-12">
        <div class="card m-3" style="width: 100%;">
            <div class="card-header">
                <h5 class="card-title"><?php echo $vici; ?></h5>
            </div>
            <div class="card-body">
                <!-- <p class="card-text"> -->
                    <div class="table-responsive-lg card-text">
                    <table class="table table-sm table-hover">
                        <thead class="">
                            <tr>
                                <th scope="col">Sucursal</th>
                                <th scope="col">Campaña Interna</th>
                                <th scope="col">Grupo Vici</th>
                                <th scope="col">Detalles</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            
                            $maquilas->obt_maquilas($vici);
                            //$maquilas->detector_maquilas($vici);                           
                            // foreach ($maquilas->obt_maquilas($vici) as $key) {
                            //     echo $key." ";
                            // }
                        ?>
                        </tbody>
                    </table>
                    </div>
                    
                <!-- </p> -->
            </div>
        </div>
    </div>
    <?php
}