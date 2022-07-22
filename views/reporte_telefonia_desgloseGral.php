<?php
include_once '../class/conexion.php';
include_once '../class/sucursalesExternas.php';
include_once '../class/ConsumoPorCarrier.php';


$conexion = conexion_local("telefonia", "10.9.2.234");
$carrier = $_POST['carrier'];
$fecha_inicio = $_POST['fecha_inicio'];
$fecha_termino = $_POST['fecha_termino'];

//$telefonia_consumida = new ReporteTelefoniaMensual($conexion,$carrier,$fecha_inicio,$fecha_termino);
//$telefonia_consumida -> reporte_telefonia();
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
			<thead class="text-center align-middle">
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

<div class="row text-center">
    <div class="col-12">
        <a class="" role="button" href="http://10.9.2.234/edmadu/export/telefonia.php?fecha_inicio=<?php echo "{$fecha_inicio}"; ?>&&fecha_termino=<?php echo "{$fecha_termino}"; ?>&&carrier=<?php echo "{$carrier}"; ?>">
            <svg class="icon icon-tabler icon-tabler-file-download" width="24" height="24" viewBox="0 0 24 24" stroke-width="1" stroke="#00b341" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
                <line x1="12" y1="11" x2="12" y2="17"></line>
                <polyline points="9 14 12 17 15 14"></polyline>
            </svg>
        </a>
    </div>
</div>
