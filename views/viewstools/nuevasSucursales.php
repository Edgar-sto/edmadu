<?php
include_once '../../class/conexion.php';
include_once '../../class/NuevasSucursales.php';
$vici       =   $_POST['vici'];
$sucursal   =   $_POST['name_sucursal_nueva'];
$tipo       =   $_POST['tipo'];
$campania   =   $_POST['campania']; 
$name_group =   $_POST['nameGrupo_sucursal_nueva'];
$conexion = conexion_local('telefonia', '10.9.2.147');

// if (isset($sucursal) || isset($name_group)) {
//     echo "Llena los campos correspondientes!";
// } else {
    $nueva_sucursal = new NuevasSucursales($conexion,$vici,$sucursal,$tipo,$campania,$name_group);
    $nueva_sucursal->agregarSucursal();
//}


?>