<?php

/**Clases necesarias */
require_once '../../class/conexion.php';
require_once '../../class/prefijos.php';
require_once '../../class/fecha2022.php';
require_once '../../class/ConsumoPorCarrier.php';

$conexion = conexion_local('telefonia', '127.0.0.1');

/**DATOS OBTENIDOS POR METODO POST */
//$carrier_form     = $_POST['carrier'];
$date_start_form  = $_POST['fecha_inicio'];
//echo "<br>";
$date_end_form    = $_POST['fecha_termino'];

?>
<!-- <div class="container">
    <h6 class="tab-header text-left"> -->
        <!-- ** Agregar Algoritmo para mostrar las fechas correctas al seleccionarlas ** -->
        <!-- <small class="badge badge-sm float-center badge-light">
            Información del día <?php echo $date_start_form; ?> al <?php echo $date_end_form; ?>
        </small>
    </h6>
</div> -->

<!-- INFORMACIÖN -->
<div class="col-12 text-center">
	<div class="card m-3" style="width: 100%;">
		<div class="card-header">
			<h5 class="card-title">Consumo</h5>
		</div>
		<div class="card-body">
			<div class="table-responsive-lg card-text">
				<?php
				$porcentaje = new ConsumoPorCarrier($conexion, $date_start_form, $date_end_form, prefijos_marcatel);
				$porcentaje->porcentaje();
				?>
			</div>
		</div>
	</div>
</div>


<!-- MARCATEL -->
<!-- <div class="col-12 col-lg-6 col-sm-3 table-responsive xy-hiden">
    <table class="table table-sm" style="font-size: 0.6em;">
        <thead class="text-center align-middle">
            <tr class="">
                <th scope="col" colspan="3">
                    <h4>Marcatel</h4>
                </th>
            </tr>
            <tr>
                <th scope="col">Tipo</th>
                <th scope="col">Minutos</th>
                <th scope="col">Pesos</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // $consumo_marcatel = new ConsumoPorCarrier($conexion, $date_start_form, $date_end_form, prefijos_marcatel);
            // $consumo_marcatel->consumoDividido();
            ?>
        </tbody>
    </table>
</div> -->
<!-- MCM -->
<!-- <div class="col-12 col-lg-6 col-sm-3 table-responsive xy-hiden">
    <table class="table table-sm" style="font-size: 0.6em;">
        <thead class="text-center align-middle">
            <tr class="">
                <th scope="col" colspan="3">
                    <h4>MCM</h4>
                </th>
            </tr>
            <tr>
                <th scope="col">Tipo</th>
                <th scope="col">Minutos</th>
                <th scope="col">Pesos</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // $consumo_marcatel = new ConsumoPorCarrier($conexion, $date_start_form, $date_end_form, prefijos_mcm);
            // $consumo_marcatel->consumoDividido();
            ?>
        </tbody>
    </table>
</div> -->
<!-- IPCOM -->
<!-- <div class="col-12 col-lg-6 col-sm-3 table-responsive xy-hiden">
    <table class="table table-sm" style="font-size: 0.6em;">
        <thead class="text-center align-middle">
            <tr class="">
                <th scope="col" colspan="3">
                    <h4>Ipcom</h4>
                </th>
            </tr>
            <tr>
                <th scope="col">Tipo</th>
                <th scope="col">Minutos</th>
                <th scope="col">Pesos</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // $consumo_marcatel = new ConsumoPorCarrier($conexion, $date_start_form, $date_end_form, prefijos_ipcom);
            // $consumo_marcatel->consumoDividido();
            ?>
        </tbody>
    </table>
</div> -->
<!-- HAZ -->
<!-- <div class="col-12 col-lg-6 col-sm-3 table-responsive xy-hiden">
    <table class="table table-sm" style="font-size: 0.6em;">
        <thead class="text-center align-middle">
            <tr class="">
                <th scope="col" colspan="3">
                    <h4>Haz</h4>
                </th>
            </tr>
            <tr>
                <th scope="col">Tipo</th>
                <th scope="col">Minutos</th>
                <th scope="col">Pesos</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // $consumo_marcatel = new ConsumoPorCarrier($conexion, $date_start_form, $date_end_form, prefijos_haz);
            // $consumo_marcatel->consumoDividido();
            ?>
        </tbody>
    </table>
</div> -->
