<?php
//DESCOMENTAR CUANDO LA BASE ESTE EN UN SERVIDOR

// function conexion_local ($nombre_base,$servidor){
//     date_default_timezone_set ('America/Mexico_City');
//     $fecha     =   date('Y-m-d'); //Datos a guardar date('Y-m-d')
//     $user       =   "3dg4rm4n";
//     $password   =   "secretosdenegus";
//     $conection  =   new mysqli($servidor,$user,$password,$nombre_base);
//     if ($conection -> connect_errno) {
//         echo "Failed to connect to MySQL: " . $conection -> connect_error;
//         exit();
//     }
//     return $conection;
// }

function conexion_21 ($nombre_base,$servidor){
    date_default_timezone_set ('America/Mexico_City');
    $fecha     =   date('Y-m-d'); //Datos a guardar date('Y-m-d')
    $user       =   "EdgarTele";
    $password   =   "**tele++fonia2";
    $conection  =   new mysqli($servidor,$user,$password,$nombre_base);
    if ($conection -> connect_errno) {
        echo "Failed to connect to MySQL: " . $conection -> connect_error;
        exit();
    }
    return $conection;
}

function conexion_global ($servidor,$usuario,$password,$basededatos){
    $conection  =   new mysqli($servidor,$usuario,$password,$basededatos);
    if ($conection -> connect_errno) {
        echo "Failed to connect to MySQL: " . $conection -> connect_error;
        exit();
    }
    return $conection;
}


/*USAR SOLO EN MI PC*/
function conexion_local ($nombre_base,$servidor){
    date_default_timezone_set ('America/Mexico_City');
    $fecha     =   date('Y-m-d'); //Datos a guardar date('Y-m-d')
    $user       =   "3dg4rm4n";
    $password   =   "secretosdenegus";
    $conection  =   new mysqli($servidor,$user,$password,$nombre_base);
    if ($conection -> connect_errno) {
        echo "Failed to connect to MySQL: " . $conection -> connect_error;
        exit();
    }
    return $conection;
}