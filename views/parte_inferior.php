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
	$('#btn_telefonia_mensual').click(function() {
		$('#tbl_telefonia_mensual').hide(200);
	});
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
				$("#resultado_telefonia_mensual_sucursales").html("<div style='text-align:center;'><samp>Calculando registros Internos consumidos...</samp><br><br><br><img src='assets/images/loading/ajax-loader.gif' alt='Telefonia Mensual'></div>");
			},
			success: function(res) {
				$('#resultado_telefonia_mensual_sucursales').html(res);
			}
		});
	});

	$('#btn_telefonia_mensual').click(function() {
		$.ajax({
			url: 'views/reporte_telefonia_sucursales_externas.php',
			type: 'POST',
			data: $('#form_telefonia_mensual').serialize(),
			beforeSend: function() {
				$("#resultado_telefonia_mensual_sucursales_externas").html("<div style='text-align:center;'><samp>Calculando registros Externos consumidos...</samp><br><br><br><img src='assets/images/loading/ajax-loader.gif' alt='Telefonia Mensual'></div>");
			},
			success: function(res) {
				$('#resultado_telefonia_mensual_sucursales_externas').html(res);
			}
		});
	});
</script>

<!-- SCRIPT BUSQUEDA INDEX -->
<script>
	$('#btn_consumo_index').click(function() {
		$.ajax({
			url: 'views/viewsIndex/distribucion_consumo_por_carrier.php',
			type: 'POST',
			data: $('#form_index').serialize(),
			beforeSend: function() {
				$("#distribucion_cosumo_por_carrier").html("<div style='text-align:center;'><samp>Calculando registros consumidos...</samp><br><br><br><img src='assets/images/loading/ajax-loader.gif' alt='Telefonia Mensual'></div>");
			},
			success: function(res) {
				$('#distribucion_cosumo_por_carrier').html(res);
			}
		});
	});
</script>
<script>
	function miAlerta(fecha) {
		//event.preventDefault();
		alert("Día " + fecha);
	}
</script>


</body>

</html>