<?php
require_once 'views/parte_superior.php';
require_once 'class/conexion.php';
$conexion = conexion_global( '10.9.2.244','soporte','Z3pu0rg','telefonia',);
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta name="description" content="" />
	<meta name="author" content="" />
	<title>Dashtreme Edmadu</title>
	<!--favicon-->
	<link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
	<!-- Normalize CSS -->
	<link rel="stylesheet" href="assets/css/normalize.css">
	<!-- Vector CSS -->
	<link href="assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
	<!-- simplebar CSS-->
	<link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<!-- Bootstrap core CSS-->
	<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
	<!-- animate CSS-->
	<link href="assets/css/animate.css" rel="stylesheet" type="text/css" />
	<!-- Icons CSS-->
	<link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
	<!-- Sidebar CSS-->
	<link href="assets/css/sidebar-menu.css" rel="stylesheet" />
	<!-- Custom Style-->
	<link href="assets/css/app-style.css" rel="stylesheet" />
	<!-- Diseño de botnos Vicis-->
	<link rel="stylesheet" href="assets/css/vicis.css">
	<!-- Fuentes google JETBRAINS-->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono&display=swap" rel="stylesheet">
	<!-- Query -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script>
		$(()=> {
			// page is now ready, initialize the calendar...
			$('#calendar').fullCalendar({
				dayClick: function() {
    				alert('Se dio clic en un dia!');
  				}
			// put your options and callbacks here
			})
		});
	</script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
	<!-- <script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/canvas2image.js"></script>
	<script src="assets/js/html2canvas.min.js"></script> -->
	<style>	
		.contenedor-otros {
            display: grid;
            grid-template-columns: auto auto auto;
            align-items:flex-start;            
            row-gap: 18px;
            column-gap: 35px;
            margin: auto;
        }
		/* Hide scrollbar for Chrome, Safari and Opera */
        .hide_scrollbar,#resultado_telefonia_mensual::-webkit-scrollbar {
            display: none;
			-webkit-appearance: none;
        }

        /* Hide scrollbar for IE, Edge and Firefox */
        .hide_scrollbar,#resultado_telefonia_mensual {
            -ms-overflow-style: none;
            /* IE and Edge */
            scrollbar-width: none;
            /* Firefox */
        }
		#resultado_telefonia_mensual {
			height: 535px;
			/*background: rgb(112, 128, 144,0.2);*/
			overflow-y: scroll;
		}
		/* .fondo-modal {
			background-image: url("assets/images/bg-themes/4modal.png");
		} */

		.xy-hiden1 {
			overflow-y: scroll;
			overflow-x: scroll;
			scrollbar-width: none;
			-ms-overflow-style: none;
			-webkit-appearance: none;
		}

		.x-hiden1 {
			overflow-x: scroll;
			scrollbar-width: none;
			-ms-overflow-style: none;
			-webkit-appearance: none;
		}

		.y-hiden1 {
			overflow-y: scroll;
			scrollbar-width: none;
			-ms-overflow-style: none;
			-webkit-appearance: none;
		}

		.dataWeek {
			height: 430px;
			font-size: 0.6875rem;
			scrollbar-width: none;
			overflow-y: scroll;
			-ms-overflow-style: none;
		}
		/* EDGE */
		.dataWeek::-webkit-scrollbar {
 			display: none;
		}
		.y-hiden1::-webkit-scrollbar {
 			display: none;
		}

		body {
			font-family: 'JetBrains Mono', monospace;
		}
	</style>
</head>

<body class="bg-theme bg-theme1">
	<div id="wrapper">
		<!--Start sidebar-wrapper-->
		<div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true" style="font-size: 0.6rem;">
			<div class="brand-logo">
				<a href="index.php" href="javascript:void();">
					<img src="assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
					<h5 class="logo-text">DashBoard Edmadu</h5>
				</a>
			</div>
			<ul class="sidebar-menu do-nicescrol">
				<li class="sidebar-header">MENU DE NAVEGACIÓN</li>
				<!--DASHBOARD-->
				<li>
					<a href="index.php">
						<i class="zmdi zmdi-view-dashboard"></i> <span>Home</span>
					</a>
				</li>
				<!--SEARCH STATUS CARRIER-->
				<li>
					<a href="search_status.php">
						<svg class="icon icon-tabler icon-tabler-search" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
							<path stroke="none" d="M0 0h24v24H0z" fill="none"/>
							<circle cx="10" cy="10" r="7" />
							<line x1="21" y1="21" x2="15" y2="15" />
						  </svg>
						<span>Status carrier</span>
					</a>
				</li>
				<!--SIP ERROR-->
				<li>
					<a href="sip_cause_error.php">
						<svg class="icon icon-tabler icon-tabler-bug" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
							<path stroke="none" d="M0 0h24v24H0z" fill="none"/>
							<path d="M9 9v-1a3 3 0 0 1 6 0v1" />
							<path d="M8 9h8a6 6 0 0 1 1 3v3a5 5 0 0 1 -10 0v-3a6 6 0 0 1 1 -3" />
							<line x1="3" y1="13" x2="7" y2="13" />
							<line x1="17" y1="13" x2="21" y2="13" />
							<line x1="12" y1="20" x2="12" y2="14" />
							<line x1="4" y1="19" x2="7.35" y2="17" />
							<line x1="20" y1="19" x2="16.65" y2="17" />
							<line x1="4" y1="7" x2="7.75" y2="9.4" />
							<line x1="20" y1="7" x2="16.25" y2="9.4" />
						</svg>
						<span>SIP Error</span>
					</a>
				</li>
				<!--VICIS Y SERVICIOS-->
				<li>
					<a href="vicis.php">
						<svg class="icon icon-tabler icon-tabler-phone" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
							<path stroke="none" d="M0 0h24v24H0z" fill="none"/>
							<path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" />
						  </svg>
						<span>Vicis</span>
					</a>
				</li>
				<!--DISTRIBUCION SERVERS-->
				<!-- <li>
					<a href="distribucionServer.php">
					<svg class="icon icon-tabler icon-tabler-server" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
						<path stroke="none" d="M0 0h24v24H0z" fill="none"/>
						<rect x="3" y="4" width="18" height="8" rx="3" />
						<rect x="3" y="12" width="18" height="8" rx="3" />
						<line x1="7" y1="8" x2="7" y2="8.01" />
						<line x1="7" y1="16" x2="7" y2="16.01" />
					</svg>
						<span>Distribución Server</span>
					</a>
				</li> -->
				<!--REPORTE TELEFONIA-->
				<li>
					<a href="reporte_telefonia.php">
						<svg class="icon icon-tabler icon-tabler-file-report" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
							<path stroke="none" d="M0 0h24v24H0z" fill="none"/>
							<circle cx="17" cy="17" r="4" />
							<path d="M17 13v4h4" />
							<path d="M12 3v4a1 1 0 0 0 1 1h4" />
							<path d="M11.5 21h-6.5a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v2m0 3v4" />
						</svg>
						<span>Telefonia</span>
						<small class="badge float-right badge-light">Reporte</small>
					</a>
				</li>
				<!--REPORTE TELEFONIA-->
				<!-- <li> -->
					<!--a href="/reporteTelefonia"-->
					<!-- <a data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">
						<svg class="icon icon-tabler icon-tabler-file-report" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
							<path stroke="none" d="M0 0h24v24H0z" fill="none"/>
							<circle cx="17" cy="17" r="4" />
							<path d="M17 13v4h4" />
							<path d="M12 3v4a1 1 0 0 0 1 1h4" />
							<path d="M11.5 21h-6.5a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v2m0 3v4" />
						</svg>
						<span>Reporte Telefonia</span>
						<small class="badge float-right badge-light">Edgar</small>
					</a> -->
					<!-- <div class="collapse multi-collapse" id="multiCollapseExample1">
						<div class="card card-body">
							<form action="/buscarConsumo" method="POST" >
								<div class="row d-block p-2">
									<div class="col col-sm">
										<label for="input-1">Carrier</label>
										<select id="carrier" name="carrier" class="form-control">
											<option value="#">--Seleccionar Carrier--</option>
											<option value="marcatel">Marcatel</option>
											<option value="mcm">MCM</option>
											<option value="ipcom">Ipcom</option>
											<option value="hazz">Haz</option>
										</select>
									</div>
									<div class="row d-block p-2">
										<div class="col col-sm">
											<label for="input-1">Fecha Inicio</label>
											<input id="fecha_inicio" name="fecha_inicio" type="date" class="form-control">
										</div>
									</div>
									<div class="row d-block p-2">
										<div class="col col-sm">
											<label for="input-1">Fecha Termino</label>
											<input id="fecha_termino" name="fecha_termino" type="date" class="form-control">
										</div>
									</div>
									<div class="row d-block p-2 text center">
										<div class="col col-sm">
											<button id="btn_busqueda_consumo" type="submit" class="btn btn-light px-5 p-4" value="Porcesar" name="btn_busqueda_consumo">Buscar</button>
										</div>
									</div>
								</div>
							</form>
						</div>
					  </div> -->
				<!-- </li> -->
				<!--HERRAMIENTA-->
				<li>
					<a href="herramientas.php">
					<svg class="icon icon-tabler icon-tabler-tools" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
						<path stroke="none" d="M0 0h24v24H0z" fill="none"/>
						<path d="M3 21h4l13 -13a1.5 1.5 0 0 0 -4 -4l-13 13v4" />
						<line x1="14.5" y1="5.5" x2="18.5" y2="9.5" />
						<polyline points="12 8 7 3 3 7 8 12" />
						<line x1="7" y1="8" x2="5.5" y2="9.5" />
						<polyline points="16 12 21 17 17 21 12 16" />
						<line x1="16" y1="17" x2="14.5" y2="18.5" />
					</svg>
					<span>Herramientas</span>
						<small class="badge float-right badge-light">Varios</small>
					</a>
				</li>
				<!--FUTBOL-->
				<!-- <li>
					<a href="futbol.php">
					<svg class="icon icon-tabler icon-tabler-atom" width="28" height="28" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
						<path stroke="none" d="M0 0h24v24H0z" fill="none"/>
						<line x1="12" y1="12" x2="12" y2="12.01" />
						<path d="M12 2a4 10 0 0 0 -4 10a4 10 0 0 0 4 10a4 10 0 0 0 4 -10a4 10 0 0 0 -4 -10" transform="rotate(45 12 12)" />
						<path d="M12 2a4 10 0 0 0 -4 10a4 10 0 0 0 4 10a4 10 0 0 0 4 -10a4 10 0 0 0 -4 -10" transform="rotate(-45 12 12)" />
					</svg>
					<span>Edgar</span>
						<small class="badge float-right badge-light">∴</small>
					</a>
				</li> -->
				<!--MAQUILAS-->
				<!-- <li>
					<a href="telefoniaSemanal.php">
					<svg class="icon icon-tabler icon-tabler-building-factory" width="28" height="28" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
						<path stroke="none" d="M0 0h24v24H0z" fill="none"/>
						<path d="M4 21c1.147 -4.02 1.983 -8.027 2 -12h6c.017 3.973 .853 7.98 2 12" />
						<path d="M12.5 13h4.5c.025 2.612 .894 5.296 2 8" />
						<path d="M9 5a2.4 2.4 0 0 1 2 -1a2.4 2.4 0 0 1 2 1a2.4 2.4 0 0 0 2 1a2.4 2.4 0 0 0 2 -1a2.4 2.4 0 0 1 2 -1a2.4 2.4 0 0 1 2 1" />
						<line x1="3" y1="21" x2="22" y2="21" />
						</svg>
					<span>Maquilas</span>
						<small class="badge float-right badge-light">Telefonia Semanal</small>
					</a>
				</li> -->
				<!--NUEVO PANEL TELEFONIA-->
				<li>
					<a href="consumotelefonico.php">
					<svg class="icon icon-tabler icon-tabler-coin" width="28" height="28" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
						<path stroke="none" d="M0 0h24v24H0z" fill="none"/>
						<circle cx="12" cy="12" r="9" />
						<path d="M14.8 9a2 2 0 0 0 -1.8 -1h-2a2 2 0 0 0 0 4h2a2 2 0 0 1 0 4h-2a2 2 0 0 1 -1.8 -1" />
						<path d="M12 6v2m0 8v2" />
					</svg>
					<span>Telefonia</span>
					<small class="badge float-right badge-light">Consumo</small>
					</a>
				</li>
				<!-- Fechas -->
				<li>
					<a href="fechas.php">
					<svg class="icon icon-tabler icon-tabler-calendar-stats" width="28" height="28" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
						<path stroke="none" d="M0 0h24v24H0z" fill="none"/>
						<path d="M11.795 21h-6.795a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v4" />
						<path d="M18 14v4h4" />
						<circle cx="18" cy="18" r="4" />
						<path d="M15 3v4" />
						<path d="M7 3v4" />
						<path d="M3 11h16" />
					</svg>
						<span>Días</span>
						<small class="badge float-right badge-light">con consumo</small>
					</a>
				</li>
				<!-- futbol -->
				<li>
					<a href="futbol.php">
					<svg class="icon icon-tabler icon-tabler-calendar-stats" width="28" height="28" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
						<path stroke="none" d="M0 0h24v24H0z" fill="none"/>
						<path d="M11.795 21h-6.795a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v4" />
						<path d="M18 14v4h4" />
						<circle cx="18" cy="18" r="4" />
						<path d="M15 3v4" />
						<path d="M7 3v4" />
						<path d="M3 11h16" />
					</svg>
						<span>Días</span>
						<small class="badge float-right badge-light">con consumo</small>
					</a>
				</li>
			</ul>

		</div>
		<!--End sidebar-wrapper-->

		<!--Start topbar header-->
		<header class="topbar-nav">
			<nav class="navbar navbar-expand fixed-top">
				<ul class="navbar-nav mr-auto align-items-center">
					<li class="nav-item">
						<a class="nav-link toggle-menu" href="javascript:void();">
							<i class="icon-menu menu-icon"></i>
						</a>
					</li>
					<li class="nav-item">
						<!-- <form class="search-bar">
							<input type="text" class="form-control" placeholder="Enter keywords">
							<a href="javascript:void();"><i class="icon-magnifier"></i></a>
						</form>
					</li> -->
				</ul>
				
				<!-- <ul class="navbar-nav align-items-center right-nav-link">
					<li class="nav-item dropdown-lg">
						<a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown"
							href="javascript:void();">
							<i class="fa fa-envelope-open-o"></i></a>
					</li>
					<li class="nav-item dropdown-lg">
						<a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown"
							href="javascript:void();">
							<i class="fa fa-bell-o"></i></a>
					</li>
					<li class="nav-item language">
						<a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown"
							href="javascript:void();"><i class="fa fa-flag"></i></a>
						<ul class="dropdown-menu dropdown-menu-right">
							<li class="dropdown-item"> <i class="flag-icon flag-icon-gb mr-2"></i> English</li>
							<li class="dropdown-item"> <i class="flag-icon flag-icon-fr mr-2"></i> French</li>
							<li class="dropdown-item"> <i class="flag-icon flag-icon-cn mr-2"></i> Chinese</li>
							<li class="dropdown-item"> <i class="flag-icon flag-icon-de mr-2"></i> German</li>
						</ul>
					</li>
					<li class="nav-item">
						<a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#">
							<span class="user-profile"><img src="https://via.placeholder.com/110x110" class="img-circle"
									alt="user avatar"></span>
						</a>
						<ul class="dropdown-menu dropdown-menu-right">
							<li class="dropdown-item user-details">
								<a href="javaScript:void();">
									<div class="media">
										<div class="avatar"><img class="align-self-start mr-3"
												src="https://via.placeholder.com/110x110" alt="user avatar"></div>
										<div class="media-body">
											<h6 class="mt-2 user-title">Sarajhon Mccoy</h6>
											<p class="user-subtitle">mccoy@example.com</p>
										</div>
									</div>
								</a>
							</li>
							<li class="dropdown-divider"></li>
							<li class="dropdown-item"><i class="icon-envelope mr-2"></i> Inbox</li>
							<li class="dropdown-divider"></li>
							<li class="dropdown-item"><i class="icon-wallet mr-2"></i> Account</li>
							<li class="dropdown-divider"></li>
							<li class="dropdown-item"><i class="icon-settings mr-2"></i> Setting</li>
							<li class="dropdown-divider"></li>
							<li class="dropdown-item"><i class="icon-power mr-2"></i> Logout</li>
						</ul>
					</li>
				</ul> -->
			</nav>
		</header>
		<!--End topbar header-->

		<!-- <div class="clearfix"></div> -->
	
