<?php
require_once 'views/parte_superior.php';
require_once 'class/prefijos.php';
require_once 'class/conexion.php';
require_once 'class/fecha2022.php';
require_once 'class/FechaReportes.php';
require_once 'class/C.consumo.fechas.php';
$conexion = conexion_global( '10.9.2.244','soporte','Z3pu0rg','telefonia',);
$semanas = array('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31','32','33','34','35','36','37','38','39','40','41','42','43','44','45','46','47','48','49','50','51','52');
?> 
<!-- Start content-wrapper-->
<div class="content-wrapper">
	<div class="container-fluid">
        <!-- FORMULARIO  -->
		<div class="card mt-1">
			<form id="formFechasConConsumo" method="POST">
				<table id="tblFechasAlDia" class="table">
					<tbody class="text-center form-group">
						<tr>
							<td>
								<div class="form-group">
									<label for="input-1">Fecha inicio</label>
									<input id="fechaInicialConsumo" name="fechaInicialConsumo" type="date" class="form-control">
								</div>
							</td>
							<td>
								<div class="form-group">
									<label for="input-1">Fecha termino</label>
									<input id="fechaFinalConsumo" name="fechaFinalConsumo" type="date" class="form-control">
								</div>
							</td>
							<td>
								<div class="form-group">
									<label for="input-1">Acción</label><br>
									<input id="btnFechasConConsumo" name="btnFechasConConsumo" type="button" class="btn btn-light" value="Buscar">								</div>
							</td>
						</tr>
					</tbody>
				</table>
			</form>
		</div>

		<!--    FILA 1 DESGLOSE DE FECHAS CON CONSUMO -->
        <div class="card mt-3 container-fluid">
                <div class="card-content">
                    <!-- INFORMACIÖN -->
                    <div class="col-12 text-center">
                        <div class="card mt-3">
                            <div class="card-header">
                                <h5 class="card-title">Días con consumo</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive-lg card-text">
                                    <table class="table table-sm">
                                        <thead>
                                            <tr class="" style="width: 100%; display: grid; grid-gap: 1.65rem; grid-template-columns: 100px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px;">
                                                <td class="text-left">Día/Rep</td>
                                                <td class="text-center">5</td>
                                                <td class="text-center">6</td>
                                                <td class="text-center">8</td>
                                                <td class="text-center">9</td>
                                                <td class="text-center">11</td>
                                                <td class="text-center">14</td>
                                                <td class="text-center">15</td>
                                                <td class="text-center">22</td>
                                                <td class="text-center">27</td>
                                                <td class="text-center">28</td>
                                                <td class="text-center">29</td>
                                                <td class="text-center">30</td>
                                                <td class="text-center">34</td>
                                                <td class="text-center">35</td>
                                                <td class="text-center">36</td>
                                                <td class="text-center">37</td>
                                                <td class="text-center">38</td>
                                                <td class="text-center">39</td>
                                                <td class="text-center">40</td>
                                                <td class="text-center">41</td>
                                                <td class="text-center">42</td>
                                                <td class="text-center">43</td>
                                                <td class="text-center">44</td>
                                                <td class="text-center">45</td>
                                                <td class="text-center">46</td>
                                                <td class="text-center">47</td>
                                                <td class="text-center">48</td>
                                                <td class="text-center">57</td>
                                                <td class="text-center">60</td>
                                                <td class="text-center">74</td>
                                                <td class="text-center">75</td>
                                                <td class="text-center">76</td>
                                                <td class="text-center">77</td>
                                                <td class="text-center">201</td>
                                            </tr>
                                        </thead>
                                        <tbody id="tblFechasConConsumo">
                                            <!-- <tr class="" style="width: 100%; display: grid; grid-gap: 1.7rem; grid-template-columns: 100px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px 15px;"> -->
                                                <?php
                                                    $porcentaje = new C_consumo_fechas($conexion, $date, $date);
                                                    $porcentaje->fechasConConsumoAlDia();
                                                ?>
                                            <!-- </tr> -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div> 
    </div>
</div>




<!--End content-wrapper-->
<?php
require_once  'views/parte_inferior.php';
?>