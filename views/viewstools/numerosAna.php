<?php
    include_once '/var/www/html/edmadu/class/conexion.php';
    include_once '/var/www/html/edmadu/class/NumerosAnaBloqueo.php';
    $vici  =  $_POST['vici'];
    $numero = $_POST['numero_ana'];
    $date_start = $_POST['date_ana_start'];
    $date_end   = $_POST['date_ana_end'];

    if ($vici == '36' || $vici == '201') {
        $serverDB = '10.9.2.'.$vici;
        $userDB = 'cron';
        $passDB = '1234';
        $nombreDB  = 'asterisk';
    } else {
        $serverDB = '10.9.2.'.$vici;
        $userDB = 'cron';
        $passDB = '@l**pbx++t3l3';
        $nombreDB  = 'asterisk';
    }
    $conexion = conexion_vici($serverDB,$userDB,$passDB,$nombreDB);
    $num_bloque = new NumerosAnaBloqueo($conexion, $date_start, $date_end, $numero);
    $num_bloque->numeroBloqueo();

    // foreach ($num_bloque->numeroBloqueo() AS $resultados) {
    //     echo $resultados;
    //     echo "\n";
    // }
    
    
