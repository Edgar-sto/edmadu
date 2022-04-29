<?php
require_once 'views/parte_superior.php';
require_once 'class/prefijos.php';
require_once 'class/conexion.php';
require_once 'class/fecha2022.php';
require_once 'class/ConsumoPorCarrier.php';
?>
	<!-- Start content-wrapper-->
	<div class="content-wrapper">
		<div class="container-fluid">
			<!--Start Dashboard Content-->
			<!-- FILA DISTRIBUCION DE CONSUMO POR CARRIER MINUTOS-->
			<div class="card mt-3">
				<div class="card-content">
					<div class="row row-group m-0">
						<div class="col-12 col-lg-6 col-xl-3 border-light">
							<!-- <div class="card-body text-center"> -->
								<table class="table table-sm">
									<thead class="text-center align-middle">
										<tr class="">
											<th scope="col" colspan="2"><h4>Marcatel</h4></th>
										</tr>
									</thead>
									<tbody>
										<?php
											$conexion = conexion_local('telefonia','127.0.0.1');
											$consumo_marcatel = new ConsumoPorCarrier($conexion,$date,$date,prefijos_marcatel);
											$consumo_marcatel->consumoDividido();
										?>
									</tbody>
								</table>
							<!-- </div> -->
						</div>
						<div class="col-12 col-lg-6 col-xl-3 border-light">
							<!-- <div class="card-body"> -->
								<table class="table table-sm">
									<thead class="text-center align-middle">
										<tr class="">
											<th scope="col" colspan="2"><h4>MCM</h4></th>
										</tr>
									</thead>
									<tbody>
										<?php
											$conexion = conexion_local('telefonia','127.0.0.1');
											$consumo_marcatel = new ConsumoPorCarrier($conexion,$date,$date,prefijos_mcm);
											$consumo_marcatel->consumoDividido();
										?>
									</tbody>
								</table>
							<!-- </div> -->
						</div>
						<div class="col-12 col-lg-6 col-xl-3 border-light">
							<!-- <div class="card-body"> -->
								<table class="table table-sm">
									<thead class="text-center align-middle">
										<tr class="">
											<th scope="col" colspan="2"><h4>Ipcom</h4></th>
										</tr>
									</thead>
									<tbody>
										<?php
											$conexion = conexion_local('telefonia','127.0.0.1');
											$consumo_marcatel = new ConsumoPorCarrier($conexion,$date,$date,prefijos_ipcom);
											$consumo_marcatel->consumoDividido();
										?>
									</tbody>
								</table>
							<!-- </div> -->
						</div>
						<div class="col-12 col-lg-6 col-xl-3 border-light">
							<!-- <div class="card-body"> -->
								<table class="table table-sm">
									<thead class="text-center align-middle">
										<tr class="">
											<th scope="col" colspan="2"><h4>Haz</h4></th>
										</tr>
									</thead>
									<tbody>
										<?php
											$conexion = conexion_local('telefonia','127.0.0.1');
											$consumo_marcatel = new ConsumoPorCarrier($conexion,$date,$date,prefijos_haz);
											$consumo_marcatel->consumoDividido();
										?>
									</tbody>
								</table>
								<!-- <h5 class="text-white mb-0">5630 <span class="float-right"><i class="fa fa-envira"></i></span></h5>
								<div class="progress my-3" style="height:3px;">
									<div class="progress-bar" style="width:55%"></div>
								</div>
								<p class="mb-0 text-white small-font">Messages <span class="float-right">+2.2% <i class="zmdi zmdi-long-arrow-up"></i></span></p> -->
							<!-- </div> -->
						</div>
					</div>
				</div>
			</div>
			<!-- FILA GRAFICAS PESOS -->
			<div class="row">
				<div class="col-12 col-lg-8 col-xl-8">
					<div class="card" style="height: 500px;">
						<div class="card-header">Site Traffic
							<div class="card-action">
								<div class="dropdown">
									<a href="javascript:void();" class="dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown">
										<i class="icon-options"></i>
									</a>
									<div class="dropdown-menu dropdown-menu-right">
										<a class="dropdown-item" href="javascript:void();">Action</a>
										<a class="dropdown-item" href="javascript:void();">Another action</a>
										<a class="dropdown-item" href="javascript:void();">Something else here</a>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="javascript:void();">Separated link</a>
									</div>
								</div>
							</div>
						</div>
						<div class="card-body">
							<ul class="list-inline">
								<li class="list-inline-item"><i class="fa fa-circle mr-2 text-white"></i>New Visitor
								</li>
								<li class="list-inline-item"><i class="fa fa-circle mr-2 text-light"></i>Old Visitor
								</li>
							</ul>
							<div class="chart-container-1">
								<canvas id="chart1"></canvas>
							</div>
						</div>

						<div class="row m-0 row-group text-center border-top border-light-3">
							<div class="col-12 col-lg-4">
								<div class="p-3">
									<h5 class="mb-0">45.87M</h5>
									<small class="mb-0">Overall Visitor <span> <i class="fa fa-arrow-up"></i>
											2.43%</span></small>
								</div>
							</div>
							<div class="col-12 col-lg-4">
								<div class="p-3">
									<h5 class="mb-0">15:48</h5>
									<small class="mb-0">Visitor Duration <span> <i class="fa fa-arrow-up"></i>
											12.65%</span></small>
								</div>
							</div>
							<div class="col-12 col-lg-4">
								<div class="p-3">
									<h5 class="mb-0">245.65</h5>
									<small class="mb-0">Pages/Visit <span> <i class="fa fa-arrow-up"></i>
											5.62%</span></small>
								</div>
							</div>
						</div>

					</div>
				</div>

				<div class="col-12 col-lg-4 col-xl-4">
					<div class="card" style="height: 500px;">
						<div class="card-header">Costo carrier
							<div class="card-action">
								<div class="dropdown">
									<a href="javascript:void();" class="dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown">
										<i class="icon-options"></i>
									</a>
									<div class="dropdown-menu dropdown-menu-right">
										<a class="dropdown-item" href="javascript:void();">Action</a>
										<a class="dropdown-item" href="javascript:void();">Another action</a>
										<a class="dropdown-item" href="javascript:void();">Something else here</a>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="javascript:void();">Separated link</a>
									</div>
								</div>
							</div>
						</div>
						<div class="card-body">
							<div class="chart-container-2">
								<?php
									$total_mtel 	= new ConsumoPorCarrier($conexion, $date, $date, prefijos_marcatel);
									$total_mcm 		= new ConsumoPorCarrier($conexion, $date, $date, prefijos_mcm);
									$total_ipcom 	= new ConsumoPorCarrier($conexion, $date, $date, prefijos_ipcom);
									$total_haz 		= new ConsumoPorCarrier($conexion, $date, $date, prefijos_haz);
								?>
								<!-- <canvas id="chart2"></canvas> -->
								<canvas id="myChart"></canvas>
								<script>
								const ctx = document.getElementById('myChart').getContext('2d');
								ctx.canvas.width = 300;
								ctx.canvas.height = 50;
								
								const myChart = new Chart(ctx, {
									type: 'doughnut',
									data: {
										//labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
										datasets: [{
											//label: '# of Votes',
											data: [
                                				<?php echo $total_mtel->consumoMovilFijoUnido() ?>,
                                				<?php echo $total_mcm->consumoMovilFijoUnido() ?>,
                                				<?php echo $total_ipcom->consumoMovilFijoUnido() ?>,
                              					<?php echo $total_haz->consumoMovilFijoUnido() ?>
                            				],
											backgroundColor: [
												'rgba(255, 99, 132, 0.2)',
												'rgba(54, 162, 235, 0.2)',
												'rgba(255, 206, 86, 0.2)',
												'rgba(75, 192, 192, 0.2)'
												
											],
											borderColor: [
												'rgba(255, 99, 132, 1)',
												'rgba(54, 162, 235, 1)',
												'rgba(255, 206, 86, 1)',
												'rgba(75, 192, 192, 1)'
											],
											borderWidth: 1
										}]
									},
									options: {
										scales: {
											y: {
												beginAtZero: true
											}
										}
									}
								}).Doughnut(doughnutData);;
								</script>
							</div>
						</div>
						<div class="table-responsive">
							<table class="table align-items-center">
								<tbody>
									<tr>
										<td><i class="fa fa-circle text-white mr-2"></i> Direct</td>
										<td>$5856</td>
										<td>+55%</td>
									</tr>
									<tr>
										<td><i class="fa fa-circle text-light-1 mr-2"></i>Affiliate</td>
										<td>$2602</td>
										<td>+25%</td>
									</tr>
									<tr>
										<td><i class="fa fa-circle text-light-2 mr-2"></i>E-mail</td>
										<td>$1802</td>
										<td>+15%</td>
									</tr>
									<tr>
										<td><i class="fa fa-circle text-light-3 mr-2"></i>Other</td>
										<td>$1105</td>
										<td>+5%</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<!--End Row-->

			<div class="row">
				<div class="col-12 col-lg-12">
					<div class="card">
						<div class="card-header">Recent Order Tables
							<div class="card-action">
								<div class="dropdown">
									<a href="javascript:void();" class="dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown">
										<i class="icon-options"></i>
									</a>
									<div class="dropdown-menu dropdown-menu-right">
										<a class="dropdown-item" href="javascript:void();">Action</a>
										<a class="dropdown-item" href="javascript:void();">Another action</a>
										<a class="dropdown-item" href="javascript:void();">Something else here</a>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="javascript:void();">Separated link</a>
									</div>
								</div>
							</div>
						</div>
						<div class="table-responsive">
							<table class="table align-items-center table-flush table-borderless">
								<thead>
									<tr>
										<th>Product</th>
										<th>Photo</th>
										<th>Product ID</th>
										<th>Amount</th>
										<th>Date</th>
										<th>Shipping</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Iphone 5</td>
										<td><img src="https://via.placeholder.com/110x110" class="product-img" alt="product img"></td>
										<td>#9405822</td>
										<td>$ 1250.00</td>
										<td>03 Aug 2017</td>
										<td>
											<div class="progress shadow" style="height: 3px;">
												<div class="progress-bar" role="progressbar" style="width: 90%">
												</div>
											</div>
										</td>
									</tr>

									<tr>
										<td>Earphone GL</td>
										<td><img src="https://via.placeholder.com/110x110" class="product-img" alt="product img"></td>
										<td>#9405820</td>
										<td>$ 1500.00</td>
										<td>03 Aug 2017</td>
										<td>
											<div class="progress shadow" style="height: 3px;">
												<div class="progress-bar" role="progressbar" style="width: 60%">
												</div>
											</div>
										</td>
									</tr>

									<tr>
										<td>HD Hand Camera</td>
										<td><img src="https://via.placeholder.com/110x110" class="product-img" alt="product img"></td>
										<td>#9405830</td>
										<td>$ 1400.00</td>
										<td>03 Aug 2017</td>
										<td>
											<div class="progress shadow" style="height: 3px;">
												<div class="progress-bar" role="progressbar" style="width: 70%">
												</div>
											</div>
										</td>
									</tr>

									<tr>
										<td>Clasic Shoes</td>
										<td><img src="https://via.placeholder.com/110x110" class="product-img" alt="product img"></td>
										<td>#9405825</td>
										<td>$ 1200.00</td>
										<td>03 Aug 2017</td>
										<td>
											<div class="progress shadow" style="height: 3px;">
												<div class="progress-bar" role="progressbar" style="width: 100%">
												</div>
											</div>
										</td>
									</tr>

									<tr>
										<td>Hand Watch</td>
										<td><img src="https://via.placeholder.com/110x110" class="product-img" alt="product img"></td>
										<td>#9405840</td>
										<td>$ 1800.00</td>
										<td>03 Aug 2017</td>
										<td>
											<div class="progress shadow" style="height: 3px;">
												<div class="progress-bar" role="progressbar" style="width: 40%">
												</div>
											</div>
										</td>
									</tr>

									<tr>
										<td>Clasic Shoes</td>
										<td><img src="https://via.placeholder.com/110x110" class="product-img" alt="product img"></td>
										<td>#9405825</td>
										<td>$ 1200.00</td>
										<td>03 Aug 2017</td>
										<td>
											<div class="progress shadow" style="height: 3px;">
												<div class="progress-bar" role="progressbar" style="width: 100%">
												</div>
											</div>
										</td>
									</tr>

								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<!--End Row-->

			<!--End Dashboard Content-->

			<!--start overlay-->
			<div class="overlay toggle-menu"></div>
			<!--end overlay-->

		</div>
		<!-- End container-fluid-->
	</div>
	<!--End content-wrapper-->
<?php
require_once  'views/parte_inferior.php';
?>