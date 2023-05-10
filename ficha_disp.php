<?php 
/**
 * Fichero php que implementa la vista de la ficha con la informacion del dispositivo
 * 
 * @author Verónica Terán Molina <vteran@ucm.es>
 */

include_once('header.php');
include_once 'Controller/mis_dispositivos_recomendaciones_controller.php';
include_once "Controller/dispositivo_controller.php";
include_once "Controller/usuarios_controller.php";
?>

<?php
$dispositivo_controller = new dispositivo_controller();
$disp = $dispositivo_controller->getDisp($_GET['disp']);
$usuarios_controller = new usuarios_controller();

$destacada = $dispositivo_controller->getDestacada($_GET['disp']);
$gallery = $dispositivo_controller->getGaleria(($_GET['disp']));

?>

<!--Modal RECOMENDAR DISP A UN CONTACTO-->
<div class="modal fade" id="modal_recomendar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
	aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="staticBackdropLabel">Recomendar dispositivo a un contacto</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="row result_modal justify-content-center"></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success btn-recomendar"
					onclick="recomendar_contacto();">Recomendar</button>
			</div>
		</div>
	</div>
</div>


<div class="container px-4 px-md-0 mb-md-5 mt-md-5 mt-4">
	<div class="row ficha_disp p-md-3 py-3 pb-md-4 mb-3 mb-md-5 rounded">
		<div class="col-md-2 col-5 imagen">
			<?php include_once('templates/galeria.php'); ?>
		</div>
		<div class="col-md-6 col-7 precio_icons">
			<div class="row pe-3 pe-md-0">
				<div class="col-md-8 ps-2 border rounded precios_disp d-flex flex-column">
					<?php $precios = $dispositivo_controller->getListadoPrecios($disp['disp_id']);
					while ($precio = $precios->fetch_assoc()) { ?>
						<div class="row enlace my-1">
							<div class="imagen col-md-6 col-6">
								<img class='imagen_shop' src="../assets/img/<?php echo $precio['img'] ?>" with='100'
									height='200'>
							</div>
							<div class="col-md-4 col-6 precio">
								<button class='border btn-master rounded-pill btn_precio'>
									<a class='precio_link' href='<?php echo $precio['url'] ?>'> <?php echo $precio['precio'] . " €" ?></a></button>
							</div>
						</div>
					<?php } ?>
				</div>
			</div> 
			<div class="row row_icon_ficha">
				<div class="col-md-5 col-9 d-flex border rounded mt-md-2 ficha_disp_icons mt-3">
					<?php if (isset($_SESSION['user_id']) && $user_disp_controller->isFav($_SESSION['user_id'], $disp['disp_id'])) { ?>
						<div class="icon_fav icon col-md-4 d-flex justify-content-center"
							id='<?php echo $disp['disp_id'] ?>' data-bs-toggle="tooltip" data-bs-placement="top"
							data-bs-custom-class="custom-tooltip" data-bs-title="Eliminar favorito">
							<img src="../assets/img/favorito_on.png" width="40" height="40">
						</div>
					<?php } else { ?>
						<div class="icon_fav icon col-md-4 d-flex justify-content-center"
							id='<?php echo $disp['disp_id']; ?>' data-bs-toggle="tooltip" data-bs-placement="top"
							data-bs-custom-class="custom-tooltip" data-bs-title="Añadir favorito">
							<img src="../assets/img/favorito_off.png" width="40" height="40">
						</div>
					<?php } ?>
					<?php if (isset($_SESSION['user_id']) && $user_disp_controller->isUsed($_SESSION['user_id'], $disp['disp_id'])) { ?>
						<div class="icon_use border-end icon col-md-4 d-flex justify-content-center"
							id='<?php echo $disp['disp_id'] ?>' data-bs-toggle="tooltip" data-bs-placement="top"
							data-bs-custom-class="custom-tooltip" data-bs-title="¡Lo tengo!">
							<img src="../assets/img/use_on.png" width="40" height="40">
						</div>
					<?php } else { ?>
						<div class="icon_use border-end icon col-md-4 d-flex justify-content-center"
							id='<?php echo $disp['disp_id']; ?>' data-bs-toggle="tooltip" data-bs-placement="top"
							data-bs-custom-class="custom-tooltip" data-bs-title="¡Lo tengo!">
							<img src="../assets/img/use_off.png" width="40" height="40">
						</div>
					<?php } ?>
					<?php if (isset($_SESSION['user_id']) && $user_disp_controller->isDislike($_SESSION['user_id'], $disp['disp_id'])) { ?>
						<div class="icon_dislike icon col-md-4 d-flex justify-content-center"
							id='<?php echo $disp['disp_id'] ?>' data-bs-toggle="tooltip" data-bs-placement="top"
							data-bs-custom-class="custom-tooltip" data-bs-title="Me gusta">
							<img src="../assets/img/dislike_on.png" width="35" height="35">
						</div>
					<?php } else { ?>
						<div class="icon_dislike icon col-md-4 d-flex justify-content-center"
							id='<?php echo $disp['disp_id']; ?>' data-bs-toggle="tooltip" data-bs-placement="top"
							data-bs-custom-class="custom-tooltip" data-bs-title="No recomendar">
							<img src="../assets/img/dislike_off.png" width="35" height="35">
						</div>
					<?php } ?>
				</div>
			</div>

		</div>
		<div class="col-md-4 col-12 d-flex align-items-center justify-content-center pt-4">
			<button type="button" class="recomendar-contacto" data-bs-toggle="modal" data-bs-target="#modal_recomendar"
				onclick="obtener_contactos();">Recomendar dispositivo</button>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12 ficha_especificaciones">
			<div class="panel panel-default">
				<div class="detalle detalle-color">
					<h3 class="title_group">Modelo</h3>
					<p><span class="title_espf">Nombre: </span>
						<?php echo $disp['nombre'] ?>
					</p>
					<p><span class="title_espf">Marca: </span>
						<?php echo $disp['marca'] ?>
					</p>
					<p><span class="title_espf">Fecha de salida: </span>
						<?php echo $disp['fecha'] ?>
					</p>
					<p><span class="title_espf">Colores: </span>
						<?php echo $disp['colores'] ?>
					</p>
					<?php $array = explode(',', $disp['colores']);
					?>
					<p><span class="title_espf">Precio: </span>
						<?php echo $disp['precio'] . '€' ?>
					</p>
				</div>
				<div class="detalle detalle-color">
					<h3 class="title_group">Pantalla y diseño</h3>
					<p><span class="title_espf">Tasa de refresco: </span>
						<?php echo $disp['tasa_refresco'] . ' Hz' ?>
					</p>
					<p><span class="title_espf">Resolucion: </span>
						<?php echo $disp['resolucion_a'] . ' x ' . $disp['resolucion_b'] . ' pixelex' ?>
					</p>
					<p><span class="title_espf">Pulgadas: </span>
						<?php echo $disp['pulgadas'] . ' pulgadas' ?>
					</p>
					<p><span class="title_espf">Tipo de pantalla: </span>
						<?php echo $disp['tipo_pantalla'] ?>
					</p>
					<p><span class="title_espf">Tamaño: </span>
						<?php echo $disp['alto'] . ' x ' . $disp['ancho'] . ' x ' . $disp['grosor'] . ' (cm)' ?>
					</p>
					<p><span class="title_espf">Peso: </span>
						<?php echo $disp['peso'] . ' gr' ?>
					</p>
					<p><span class="title_espf">Resistencia: </span>
						<?php echo $disp['resistencia'] ?>
					</p>
					<?php if ($disp['pantalla_curva'] == 1) {
						echo '<img src="../assets/img/check.png" class="me-2"/>';
					} else {
						echo '<img src="../assets/img/nocheck.png" class="me-2"/>';
					}
					echo 'Pantalla curva';
					?>
					</p>
				</div>
				<div class="detalle detalle-color">
					<h3 class="title_group">Porcesador</h3>
					<p><span class="title_espf">Memoria ram: </span>
						<?php echo $disp['ram'] . ' GB' ?>
					</p>
				</div>
				<div class="detalle detalle-color">
					<h3 class="title_group">Almacenamiento</h3>
					<p><span class="title_espf">Memoria interna: </span>
						<?php echo $disp['memoria_interna'] . ' GB' ?>
					</p>
				</div>
				<div class="detalle detalle-color">
					<h3 class="title_group">Seguridad</h3>
					<p>
						<?php if ($disp['seguridad_facial'] == 1) {
							echo '<img src="../assets/img/check.png" class="me-2"/>';
						} else {
							echo '<img src="../assets/img/nocheck.png" class="me-2"/>';
						}
						echo 'Seguridad avanzada como reconocimiento facial o iris';
						?>
					</p>
					<p>
						<?php if ($disp['seguridad_huella'] == 1) {
							echo '<img src="../assets/img/check.png" class="me-2"/>';
						} else {
							echo '<img src="../assets/img/nocheck.png" class="me-2"/>';
						}
						echo 'Huella dactilar';
						?>
					</p>
				</div>
				<div class="detalle detalle-color">
					<h3 class="title_group">Fotografía</h3>
					<p><span class="title_espf">Cámara trasera: </span>
						<?php echo $disp['cam_trasera'] . ' Mpx' ?>
					</p>
					<?php if (!empty($disp['lente_teleobjetivo'])) { ?>
						<p><span class="title_espf">Lente teleobjetivo: </span>
							<?php echo $disp['lente_teleobjetivo'] . ' Mpx' ?>
						</p>
					<?php } ?>
					<?php if (!empty($disp['lente_macro'])) { ?>
						<p><span class="title_espf">Lente macro: </span>
							<?php echo $disp['lente_macro'] . ' Mpx' ?>
						</p>
					<?php } ?>
					<?php if (!empty($disp['lente_gran_angular'])) { ?>
						<p><span class="title_espf">Lente gran angular: </span>
							<?php echo $disp['lente_gran_angular'] . ' Mpx' ?>
						</p>
					<?php } ?>
					<p><span class="title_espf">Flash: </span>
						<?php echo $disp['flash'] ?>
					</p>
					<p>
						<?php
						echo '<div class="saber_mas">';
						if ($disp['estabilizacion_opt'] == 1) {
							echo '<img src="../assets/img/check.png" class="me-2"/>';
						} else {
							echo '<img src="../assets/img/nocheck.png" class="me-2"/>';
						}
						echo '<span>Estabilización óptica</span><button class=" saber_mas data-bs-toggle="popover" data-bs-title="title" data-bs-content=""> ¿Para que sirve? </button></div>';
						?>
					</p>

					<p><span class="title_espf">Caracteristicas Cámara trasera: </span></p>
					<?php
					foreach (explode(',', $disp['caracteristicas_cam']) as $c) {
						if (!empty($c)) {
							$array = $dispositivo_controller->getCaracteristicasCam_c($c);
							echo '<div  class="saber_mas"><img src="../assets/img/flecha.png" class="me-2"/><span id="' . $c . '">' . $array['nombre'] . '</span><button id="' . $c . '" class="border saber_mas data-bs-toggle="popover" data-bs-title="Popover title" data-bs-content=""> ¿Para que sirve? </button></div>';
						}
						?>

					<?php }
					?>
					<p class="mt-md-3"><span class="title_espf ">Caracteristicas extra: </span></p>
					<?php $array = explode(',', $disp['cam_otras']);					
					foreach ($array as $c) {
						if (!empty($c)) {
							echo '<div class="saber_mas ms-5"><img src="../assets/img/extra.png" class="me-2"/><span  class="saber_mas">' . $c . '</span><button class=" saber_mas data-bs-toggle="popover" data-bs-title="title" data-bs-content=""> ¿Para que sirve? </button></div> ';
						}
					}
					?>
				</div>
				<div class="detalle detalle-color">
					<h3 class="title_group">Batería</h3>
					<p><span class="title_espf">Batería: </span>
						<?php echo $disp['bateria'] . ' mAh' ?>
					</p>
					<p><span class="title_espf">Carga rápida: </span>
						<?php echo $disp['carga_rapida'] . ' W' ?>
					</p>
				</div>
				<div class="detalle detalle-color">
					<h3 class="title_group">Conectividad</h3>
					<p>
						<?php
						echo '<div  class="saber_mas">';
						if ($disp['conexion'] == 1) {
							echo '<img src="../assets/img/check.png" class="me-2"/>';
						} else {
							echo '<img src="../assets/img/nocheck.png" class="me-2"/>';
						}
						echo '<span>Conexión 5G</span><button class=" saber_mas data-bs-toggle="popover" data-bs-title="title" data-bs-content=""> ¿Para que sirve? </button></div>';
						?>
					</p>

				</div>
				<div class="detalle detalle-color">
					<h3 class="title_group">Sistema operativo</h3>
					<p><span class="title_espf">Sitema operativo: </span>
						<?php echo $disp['so'] ?>
					</p>
				</div>
				<div class="detalle detalle-color">
					<h3 class="title_group">Usb</h3>
					<p><span class="title_espf">Usb tipo: </span>
						<?php echo $disp['usb_tipo'] . ' mAh' ?>
					</p>
					<p>
						<?php if ($disp['usb_carga'] == 1) {
							echo '<img src="../assets/img/check.png" class="me-2"/>';
						} else {
							echo '<img src="../assets/img/nocheck.png" class="me-2"/>';
						}
						echo 'Usb carga';
						?>
					</p>
					<p>
						<?php
						echo '<div  class="saber_mas">';
						if ($disp['usb_otg'] == 1) {
							echo '<img src="../assets/img/check.png" class="me-2"/>';
						} else {
							echo '<img src="../assets/img/nocheck.png" class="me-2"/>';
						}
						echo '<span>Usb otg</span><button id="" class="border saber_mas" data-bs-toggle="popover" data-bs-title="Popover title" data-bs-content=""> ¿Para que sirve? </button></div>';
						?>
					</p>
					<p>
						<?php
						echo '<div  class="saber_mas">';
						if ($disp['usb_masivo'] == 1) {
							echo '<img src="../assets/img/check.png" class="me-2"/>';
						} else {
							echo '<img src="../assets/img/nocheck.png" class="me-2"/>';
						}
						echo '<span>Usb masivo</span><button id="" class="border saber_mas" data-bs-toggle="popover" data-bs-title="Popover title" data-bs-content=""> ¿Para que sirve? </button></div>';
						?>
					</p>

				</div>
				<div class="detalle detalle-color">
					<h3 class="title_group">Sensores</h3>
					<p>
						<?php if ($disp['infrarojos'] == 1) {
							echo '<img src="../assets/img/check.png" class="me-2"/>';
						} else {
							echo '<img src="../assets/img/nocheck.png" class="me-2"/>';
						}
						echo 'Infrarrojos';
						?>
					</p>
					<p>
						<?php if ($disp['jack'] == 1) {
							echo '<img src="../assets/img/check.png" class="me-2"/>';
						} else {
							echo '<img src="../assets/img/nocheck.png" class="me-2"/>';
						}
						echo 'Conector jack, para cascos con cable';
						?>
					</p>
					<p>
						<?php
						echo '<div  class="saber_mas">';
						if ($disp['nfc'] == 1) {
							echo '<img src="../assets/img/check.png" class="me-2"/>';
						} else {
							echo '<img src="../assets/img/nocheck.png" class="me-2"/>';
						}
						echo '<span>NFC</span><button class=" saber_mas data-bs-toggle="popover" data-bs-title="title" data-bs-content=""> ¿Para que sirve? </button></div>';

						?>
					</p>
					<p><span class="title_espf">Otros sensores: </span></p>
					<?php
					foreach (explode(',', $disp['sensores']) as $s) {
						if (!empty($c)) {
							$array = $dispositivo_controller->getSensores_s($s);
							echo '<div class="saber_mas"><img src="../assets/img/flecha.png" class="me-2"/><span  class="saber_mas" id="' . $c . '">' . $array['nombre'] . '</span><button id="' . $c . '" class="border saber_mas data-bs-toggle="popover" data-bs-title="Popover title" data-bs-content=""> ¿Para que sirve? </button></div> ';
						}
					}
					?>
					</p>
				</div>
				<div class="detalle detalle-color">
					<h3 class="title_group">Especificaciones extra</h3>
					<?php $array = explode(',', $disp['otros']);
					foreach ($array as $c) {
						if (!empty($c)) {
							echo '<p class="ms-5"><img src="../assets/img/extra.png" class="me-2"/>' . $c . '</p>';
						}
					}
					?>
					</p>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include("footer.php"); ?>


<script>
	const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
	const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))

	$(window).on("load", function () {
		//Se obtiene el texto de la especificación que queremos conocer mas detalle
		let carac = document.querySelectorAll("div.saber_mas");
		$result = "";

		//Llamada a la api de OpenAi para preguntar y obtener la informacion
		carac.forEach(element => {
			$text = element.children[1].innerHTML;
			$.ajax({
				type: "GET",
				url: "../Controller/openai.php",
				data: {
					text: $text
				},
				success: function (response) {
					$result = response;
					const popover = new bootstrap.Popover(element.children[2])
					popover.setContent({
						'.popover-body': response
					})
				},
				complete: function (response) {
				}
			});
		});


	});

	function obtener_contactos() {
		$(".result_modal").html('<span class="loader m-md-5"></span>');
		$user_id = "<?php echo $_SESSION["user_id"] ?>";
		if ($user_id === "") {
			$(".result_modal").html("Necesitas estar registrado para poder recomendar a un contacto");
			$(".btn-recomendar").attr("disabled", true);
		} else {
			$.ajax({
				type: "POST",
				url: "../Controller/contactos_controller.php",
				cache: false,
				data: {
					user_id: $user_id,
					accion: "obtener_contactos"
				},
				success: function (respuesta) {
					if (respuesta === 'vacio') {
						$(".result_modal").html('No dispones de contactos para recomendar el dispositivo');
						$(".btn-recomendar").attr("disabled", true);
					} else {
						$(".result_modal").html(respuesta);
					}
				},
			});
		}

	}

	//Seleccionamos el contacto al que se quiere recomendar el dispositivo
	let contacto_id = '';
	$(document).ajaxComplete(function () {
		$('input[name="listGroupRadioGrid"]').click(function () {
			contacto_id = this.id;
		})
	});

	//Recomendar dispositivo a contacto
	function recomendar_contacto() {
		$.ajax({
			type: "POST",
			url: "../Controller/contactos_controller.php",
			cache: false,
			data: {
				disp_id: <?php echo $_GET["disp"] ?>,
				contacto_id: contacto_id,
				accion: "recomendar_contacto"
			},
		}).done(function (respuesta) {
			const edit_toast = document.getElementById('recomendar-contacto_ok_toast')
			edit_toast.addEventListener('hidden.bs.toast', () => {
				$("#modal_recomendar").modal("hide");
			});
			const toast = new bootstrap.Toast($('#recomendar-contacto_ok_toast'));
			toast.show();
		});
	}
</script>