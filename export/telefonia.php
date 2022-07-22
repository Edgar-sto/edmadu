<?php
include_once '../class/conexion.php';
include_once '../class/sucursalesExternas.php';
// include_once '../class/ConsumoPorCarrier.php';
// include_once '../class/ReporteTelefoniaMensual.php';
// include_once '../class/ObtenerSucursal.php';
// include_once '../class/SucursalesInternas.php';
// include_once '../class/SucursalesExternas.php';


$conexion = conexion_local("telefonia", "10.9.2.234");
$carrier = $_POST['carrier'];
$fecha_inicio = $_POST['fecha_inicio'];
$fecha_termino = $_POST['fecha_termino'];


$docuname="TELEFONIA.xls";
header('Content-type: application/vnd.ms-excel'); 
header('Content-Disposition: attachment; filename='.$docuname);
header('Pragma: no-cache');
header('Expires: 0');

//DEFINIR PREFIJOS A USAR
if ($carrier == 'marcatel') {
    $prefijos_individuales = array("15", "777");
    $prefijos_junto = "15','777";
} else if ($carrier == 'mcm') {
    $prefijos_individuales = array("11", "999");
    $prefijos_junto = "11','999";
} else if ($carrier == "ipcom") {
    $prefijos_individuales = array("28", "444");
    $prefijos_junto = "28','444";
} else if ($carrier == "hazz") {
    $prefijos_individuales = array("14", "555");
    $prefijos_junto = "14','555";
} else {
    $prefijos_individuales = array("15", "777", "11", "999", "28", "444", "14", "555");
    $prefijos_juntos_minutos = array("15','777','11','999','28','444");
    $prefijos_juntos_segundos = array("14','555");
}
?>
<div class="row">
    <div class="col-lg-6 col-lg-12 table-responsive" id=" ">
        <table class="table table-sm" style="font-size: 0.6em;">
			<thead class="text-center align-middle">:w

				<tr class="">
					<th scope="col" colspan="3">
						<h4 class="uppercasse"><?php echo $carrier ?></h4>
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
				$desgloseGeneral= new ConsumoPorCarrier($conexion,$fecha_inicio, $fecha_termino, $prefijos_junto);
                $desgloseGeneral->consumoDividido();
				?>
			</tbody>
		</table>
    </div>
</div>