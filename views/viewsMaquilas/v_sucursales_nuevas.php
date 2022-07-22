<?php
include_once '../../class/conexion.php';
include_once '../../class/RevisarExistenciaSucursales.php';
$d_start = $_POST['date_sucursal_start'];
$d_end   = $_POST['date_sucursal_end'];


$conexion = conexion_local('telefonia','10.9.2.234');


?>

<div class="col-12 table-responsive xy-hiden" style="">
         
    <table class="table table-lg" style="font-size: .85rem">
        <thead class="text-center align-middle">
            <tr class="">
                <th scope="col" colspan="3">
                    <h4>Sucuarsales Maquilas</h4>
                </th>
            </tr>
            <tr>
                <th scope="col">Reporte</th>
                <th scope="col">Campania</th>
                <th scope="col">Nombre_grupo</th>
                <th scope="col">Campaña</th>
            </tr>
        </thead>
        <tbody>
          <?php
            $sucursalesExistentes = new RevisarExistenciaSucursales($conexion,$d_start,$d_end);
            $sucursalesExistentes->revisarSucursales();
          ?>
        </tbody>
    </table>    
</div>
