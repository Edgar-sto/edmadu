<?php

include_once '../../class/DateTele21.php';
include_once '../../class/conexion.php';
include_once '../../class/prefijos.php';

$conexion       =   conexion_21('telefonia','10.9.2.21');
$start_date     =   $_POST['start_date_21'];
$end_date       =   $_POST['end_date_21'];

$reportes = array("5","6","8","9","11","14","15","22","27","28","29","30", "34", "35", "36","37", "38","39","40", "41", "42", "43", "44", "45", "46", "47", "48","57","60","201");

$dailyPhoneBill = new DateTele21($conexion,$start_date,$end_date,all_prefijos,$reportes);
?>

<div class="col col-lg-12 col-lg-6 col-lg-3 table-responsive">
        <table class="table table-sm table-borderless" style="font-size:0.5em;">
        <thead>
            <tr>
                <th scope="col">Reportes</th>
                <?php 
                    foreach ($reportes as $value) {
                        echo "<td>".$value."</td>";
                    }           
                ?>
            </tr>
        </thead>
        <tbody>
            <?php
                $dailyPhoneBill->rastreoDeConsumoPorCarrier();  
            ?>
        </tbody>
    </table>
</div>