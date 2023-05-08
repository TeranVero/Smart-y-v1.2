<?php
/**
 * Fichero php que implementa la vista de las recomendaciones del usuario 'user'
 * 
 * @author Verónica Terán Molina <vteran@ucm.es>
 */

include_once 'Controller/user_disp_controller.php';
include_once "Controller/dispositivo_controller.php";
include_once('header.php');


$user_disp_controller = new user_disp_controller();
$dispositivo_controller = new dispositivo_controller();
$usuarios_controller = new usuarios_controller();
$directorio = '../public_html/galerias/';
$texto_tootip = "";

$user = $usuarios_controller->getUser($_GET['usuario']);
$disp_array_id = $user_disp_controller->getRecomendaciones($user["user_id"]);

?>


<style>
	.eliminar-recomendacion {
		display: inline-flex !important;
	}

	.guardar-recomendacion{
		display: inline-flex !important;
		justify-content: center;
	}
	.row_icons {
        display: none !important;
    }
</style>

<div class="container px-4 px-md-0 mt-md-5 mt-4">
	<div class="row">
		<div class="">
			<h5>En esta sección encontrarás todas las recomendaciones personalizadas que Smart-y realiza perodicamente
				solo para ti:</h5>
		</div>
	</div>
	<div class="row">
		<div class="num_resultados p-2">
			<span><strong>
					<?php echo $disp_array_id->num_rows; ?>
				</strong> resultados encontrados</span>
		</div>
	</div>
	<div id='disp busqueda' class="row resultados">
		<?php while ($disp_id = $disp_array_id->fetch_assoc()) {
			$imagen = $dispositivo_controller->getDestacada($disp_id["disp_id"]);
			$disp = $dispositivo_controller->getDisp($disp_id["disp_id"]);
			include('templates/search.php');
		}
		?>
	</div>
</div>

<?php
include_once("footer.php"); ?>

<script>
	$(".eliminar-recomendacion").click(function () {
		$user = <?php echo $user["user_id"]; ?>;
		$disp = this.id;
		$.ajax({
			type: "POST",
			url: "../Controller/mis_dispositivos_recomendaciones_controller.php",
			cache: false,
			data: {
				disp: $disp,
				user: <?php echo $user["user_id"]; ?>,
				accion: "eliminar_recomendacion"
			},
		}).done(function (respuesta) {
			location.reload();
		});

	});

	$(".guardar-recomendacion").click(function () {
		$user = <?php echo $user["user_id"]; ?>;
		$disp = this.id;
		$.ajax({
			type: "POST",
			url: "../Controller/mis_dispositivos_recomendaciones_controller.php",
			cache: false,
			data: {
				disp: $disp,
				user: <?php echo $user["user_id"]; ?>,
				accion: "guardar_recomendacion"
			},
		}).done(function (respuesta) {
			const toast = new bootstrap.Toast($('#recomendacion_guardada'));
			toast.show();
			location.reload();
		});

	});
</script>