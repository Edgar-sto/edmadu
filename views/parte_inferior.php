<!--Start Back To Top Button-->
<a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
<!--End Back To Top Button-->

<!--Start footer-->
<footer class="footer">
	<div class="container">
		<div class="text-center">
			Copyright © 2022 Edmadu.com
		</div>
	</div>
</footer>
<!--End footer-->

<!--start color switcher-->
<div class="right-sidebar">
	<div class="switcher-icon">
		<i class="zmdi zmdi-settings zmdi-hc-spin"></i>
	</div>
	<div class="right-sidebar-content">
		<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sint iste iusto praesentium magni doloremque impedit dicta animi laborum, quaerat eos cumque deleniti dolore labore officiis expedita, incidunt veniam optio pariatur!</p>

	</div> 
</div>
<!--end color switcher-->

</div>
<!--End wrapper-->

<!-- Bootstrap core JavaScript-->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

<!-- simplebar js -->
<script src="assets/plugins/simplebar/js/simplebar.js"></script>
<!-- sidebar-menu js -->
<script src="assets/js/sidebar-menu.js"></script>
<!-- loader scripts -->
<script src="assets/js/jquery.loading-indicator.js"></script>
<!-- Custom scripts -->
<script src="assets/js/app-script.js"></script>
<!-- Chart js -->

<script src="assets/plugins/Chart.js/Chart.min.js"></script>

<!-- Index js -->
<script src="assets/js/index.js"></script>


<!-- SCRIPT OBTENER TELEFONIA MENSUAL -->
<script>
	/*Control oculto */
	$('#tbl_telefonia_mensual').hide();

	$('#btn_down').click(function() {
		$('#tbl_telefonia_mensual').show(200);
	});
	$('#btn_up').click(function() {
		$('#tbl_telefonia_mensual').hide(200);
	});
	// $('#btn_telefonia_mensual').click(function() {
	// 	$('#tbl_telefonia_mensual').hide(200);
	// });

	/**Obtener datos telefonía*/
	$('#btn_telefonia_mensual').click(function() {
		$.ajax({
			url: 'views/reporte_telefonia_mensual.php',
			type: 'POST',
			data: $('#form_telefonia_mensual').serialize(),
			beforeSend: function() {
				$("#resultado_telefonia_mensual").html("<div style='text-align:center;'><samp>Calculando registros consumidos...</samp><br><br><br><img src='assets/images/loading/ajax-loader.gif' alt='Telefonia Mensual'></div>");
			},
			success: function(res) {
				$('#resultado_telefonia_mensual').html(res);
			}
		});
	});

	$('#btn_telefonia_mensual').click(function() {
		$.ajax({
			url: 'views/reporte_telefonia_sucursales.php',
			type: 'POST',
			data: $('#form_telefonia_mensual').serialize(),
			beforeSend: function() {
				$("#resultadoTelefoniaCentrosInternos").html("<div style='text-align:center;'><samp>Calculando registros Internos consumidos...</samp><br><br><br><img src='assets/images/loading/ajax-loader.gif' alt='Telefonia Mensual'></div>");
			},
			success: function(res) {
				$('#resultadoTelefoniaCentrosInternos').html(res);
			}
		});
	});

	$('#btn_telefonia_mensual').click(function() {
		$.ajax({
			url: 'views/reporte_telefonia_desgloseGral.php',
			type: 'POST',
			data: $('#form_telefonia_mensual').serialize(),
			beforeSend: function() {
				$("#desgloseGeneral").html("<div style='text-align:center;'><samp>Calculando registros Internos consumidos...</samp><br><br><br><img src='assets/images/loading/ajax-loader.gif' alt='Telefonia Mensual'></div>");
			},
			success: function(res) {
				$('#desgloseGeneral').html(res);
			}
		});
	});


	$('#btn_exp_tele_excel').click(function() {
		$.ajax({
			url: 'export/ex_reporte_telefonia_excel.php',
			type: 'POST',
			data: $('#form_telefonia_mensual').serialize(),
			beforeSend: function() {
				$("#desgloseGeneral").html("<div style='text-align:center;'><samp>Calculando registros Internos consumidos...</samp><br><br><br><img src='assets/images/loading/ajax-loader.gif' alt='Telefonia Mensual'></div>");
			},
			success: function(res) {
				$('#desgloseGeneral').html(res);
			}
		});
	});
</script>

<!-- SCRIPT BUSQUEDA INDEX POR FORMULARIO-->
<script>
	$('#btn_consumo_index').click(function() {
		$.ajax({
			url: 'views/viewsIndex/consumo_dividido_carrier.php',
			type: 'POST',
			data: $('#form_index').serialize(),
			beforeSend: function() {
				$("#fila-uno-consumo-dividido-carrier").html("<div class='text-center'><samp>Calculando registros consumidos...</samp><br><img src='assets/images/loading/ajax-loader.gif' alt='Consumo'></div>");
			},
			success: function(res) {
				$('#fila-uno-consumo-dividido-carrier').html(res);
			}
		});
	});

	$('#btn_consumo_index').click(function() {
		$.ajax({
			url: 'views/viewsIndex/reportes_con_consumo.php',
			type: 'POST',
			data: $('#form_index').serialize(),
			beforeSend: function() {
				$("#consumoPorReportes").html("<div style='text-align:center; width: 100%; height: 100vh;'><samp>Calculando registros consumidos...</samp><br><br><img src='assets/images/loading/ajax-loader.gif' alt='Consumo'></div>");
			},
			success: function(res) {
				$('#consumoPorReportes').html(res);
			}
		});
	});

	$('#btn_consumo_index').click(function() {
		$.ajax({
			url: 'views/viewsIndex/porcentaje_por_carrier.php',
			type: 'POST',
			data: $('#form_index').serialize(),
			beforeSend: function() {
				$("#porcentaje-por-carrier").html("<div style='text-align:center;'><samp>Calculando registros consumidos...</samp><br><br><img src='assets/images/loading/ajax-loader.gif' alt='Consumo'></div>");
			},
			success: function(res) {
				$('#porcentaje-por-carrier').html(res);
			}
		});
	});

	$('#btn_consumo_index').click(function() {
		$.ajax({
			url: 'views/viewsIndex/consumo_centros_internos.php',
			type: 'POST',
			data: $('#form_index').serialize(),
			beforeSend: function() {
				$("#centros-internos").html("<div style='text-align:center;'><samp>Calculando registros consumidos...</samp><br><br><img src='assets/images/loading/ajax-loader.gif' alt='Consumo'></div>");
			},
			success: function(res) {
				$('#centros-internos').html(res);
			}
		});
	});

	$('#btn_consumo_index').click(function() {
		$.ajax({
			url: 'views/viewsIndex/consumo_por_dia.php',
			type: 'POST',
			data: $('#form_index').serialize(),
			beforeSend: function() {
				$("#consumo-diario").html("<div style='text-align:center;'><samp>Calculando registros consumidos...</samp><br><br><img src='assets/images/loading/ajax-loader.gif' alt='Consumo'></div>");
			},
			success: function(res) {
				$('#consumo-diario').html(res);
			}
		});
	});

	$('#btn_consumo_index').click(function() {
		$.ajax({
			url: 'views/viewsIndex/consumo_por_dia_segundos.php',
			type: 'POST',
			data: $('#form_index').serialize(),
			beforeSend: function() {
				$("#consumo-diario-segundos").html("<div style='text-align:center;'><samp>Calculando registros consumidos...</samp><br><br><img src='assets/images/loading/ajax-loader.gif' alt='Consumo'></div>");
			},
			success: function(res) {
				$('#consumo-diario-segundos').html(res);
			}
		});
	});

	$('#btn_consumo_index').click(function() {
		$.ajax({
			url: 'views/viewstools/semaforo_script.php',
			type: 'POST',
			data: $('#form_index').serialize(),
			beforeSend: function() {
				$("#resultado-semaforo").html("<div style='text-align:center;'><samp>Calculando registros consumidos...</samp><br><br><img src='assets/images/loading/ajax-loader.gif' alt='Consumo'></div>");
			},
			success: function(res) {
				$('#resultado-semaforo').html(res);
			}
		});
	});
</script>


<!-- SCRIPT definitivo consumotelefonico.php-->
<script>
	$('#btn_consumo_telefonico').click(function() {
		$.ajax({
			url: 'views/viewconsumotelefonico/v.consumo.telefonico.php',
			type: 'POST',
			data: $('#form_consumo_telefonia').serialize(),
			beforeSend: function() {
				$("#tConsumoPorCarrier").html("<div class='text-center'><samp>Calculando registros consumidos...</samp><br><img src='assets/images/loading/ajax-loader.gif' alt='Consumo'></div>");
			},
			success: function(res) {
				$('#tConsumoPorCarrier').html(res);
			}
		});
	});

	$('#btn_consumo_telefonico').click(function() {
		$.ajax({
			url: 'views/viewconsumotelefonico/v.consumo.telefonico.por.dia.php',
			type: 'POST',
			data: $('#form_consumo_telefonia').serialize(),
			beforeSend: function() {
				$("#tConsumoPorDia").html("<div class='text-center'><samp>Calculando registros consumidos...</samp><br><img src='assets/images/loading/ajax-loader.gif' alt='Consumo'></div>");
			},
			success: function(res) {
				$('#tConsumoPorDia').html(res);
			}
		});
	});
</script>

<!-- SCRIPT HERRAMIENTAS-->
<script>
	$('#btn-pixel-em').click(function() {
		$.ajax({
			url: 'views/viewstools/pixelEm.php',
			type: 'POST',
			data: $('#form-pixel-em').serialize(),
			beforeSend: function() {
				$("#convertion-pixel-em").html("<div style='text-align:center;'><samp>Calculando registros consumidos...</samp><br><br><img src='assets/images/loading/ajax-loader.gif' alt='Consumo'></div>");
			},
			success: function(res) {
				$('#convertion-pixel-em').html(res);
			}
		});
	});

	$('#btn_logs').click(function() {
		$.ajax({
			url: 'views/viewstools/tele_logs.php',
			type: 'POST',
			data: $('#form_logs').serialize(),
			beforeSend: function() {
				$("#resultado_logs").html("<div style='text-align:center;'><samp>Calculando registros consumidos...</samp><br><br><img src='assets/images/loading/ajax-loader.gif' alt='Consumo'></div>");
			},
			success: function(res) {
				$('#resultado_logs').html(res);
			}
		});
	});

	$('#btn-generador-pass').click(function() {
		$.ajax({
			url: 'views/viewstools/generadorDePass.php',
			type: 'POST',
			data: $('#form-generador-pass').serialize(),
			beforeSend: function() {
				$("#resultado_generador_de_contraseña").html("<div style='text-align:center;'><samp>Calculando registros consumidos...</samp><br><br><img src='assets/images/loading/ajax-loader.gif' alt='Consumo'></div>");
			},
			success: function(res) {
				$('#resultado_generador_de_contraseña').html(res);
			}
		});
	});

	$('#btn_numeros_ana').click(function() {
		$.ajax({
			url: 'views/viewstools/numerosAna.php',
			type: 'POST',
			data: $('#form_ana').serialize(),
			beforeSend: function() {
				$("#resultado_ana").html("<div style='text-align:center;'><samp>Calculando registros consumidos...</samp><br><br><img src='assets/images/loading/ajax-loader.gif' alt='Consumo'></div>");
			},
			success: function(res) {
				$('#resultado_ana').html(res);
			}
		});
	});

	$('#btn_agregar_nueva_sucursal').click(function() {
		$.ajax({
			url: 'views/viewstools/nuevasSucursales.php',
			type: 'POST',
			data: $('#form_nuevas_sucursales').serialize(),
			beforeSend: function() {
				$("#resultadoSucursalNueva").html("<div style='text-align:center;'><samp>Calculando registros consumidos...</samp><br><br><img src='assets/images/loading/ajax-loader.gif' alt='Consumo'></div>");
			},
			success: function(res) {
				$('#resultadoSucursalNueva').html(res);
			}
		});
	});

	$('#btn_sucursal_vicidial').click(function() {
		$.ajax({
			url: 'views/viewsMaquilas/v_sucursales_nuevas.php',
			type: 'POST',
			data: $('#form_sucursal_vicidial').serialize(),
			beforeSend: function() {
				$("#resultado_sucursal_vicidial").html("<div style='text-align:center;'><samp>Calculando registros consumidos...</samp><br><br><img src='assets/images/loading/ajax-loader.gif' alt='Consumo'></div>");
			},
			success: function(res) {
				$('#resultado_sucursal_vicidial').html(res);
			}
		});
	});
</script>

<!-- SCRIPT PAGINA MAQUILAS-->
<script>
	$('#btn_consumo_maquilas').click(function() {
		$.ajax({
			url: 'views/viewsMaquilas/v_maquilas.php',
			type: 'POST',
			data: $('#form_maquilas').serialize(),
			beforeSend: function() {
				$("#answer-week").html("<div style='text-align:center;'><samp>Calculando registros consumidos...</samp><br><br><img src='assets/images/loading/ajax-loader.gif' alt='Consumo'></div>");
			},
			success: function(res) {
				$('#answer-week').html(res);
			}
		});
	});
</script>

</body>

</html>
