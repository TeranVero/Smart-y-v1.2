<?php
/**
 * Fichero php que implementa la vista relativa a la gestión de dispositivos y configuraciones del usuario admin
 * 
 * @author Verónica Terán Molina <vteran@ucm.es>
 */
include_once('header.php');
include_once('Controller/dispositivo_controller.php');
include_once('Controller/usuarios_controller.php');

$dispositivo_controller = new dispositivo_controller();
$usuarios_controller = new usuarios_controller(); ?>
<div class="title">
	<h1>Gestión de dispositivos</h1>
</div>

<div class=" container">
	<div class="buscador row justify-content-center">
		<div class=" col-md-10 col-12 ">
			<div class="row">
				<div class=" col-9 my-3 pe-0 d-flex" role="search">
					<input class="form-control me-2" id="buscar_disp" type="search" placeholder="Buscar dispositivo"
						aria-label="Buscar">
					<button class="btn btn-outline-primary" id="buscar" onclick="buscar_disp();">Buscar</button>
				</div>
				<div class="col-3 d-flex ">
					<button id='eliminar' class='mx-1' data-bs-toggle='tooltip' data-bs-placement='bottom'
						title='Eliminar' disabled><img src='../assets/img/delete-disp.png' height='30' width='35'></button>
					<button id='editar' class='mx-1' data-bs-toggle='tooltip' data-bs-placement='bottom' title='Editar'
						disabled><img src='../assets/img/compose.png' height='30' width='35'></button>
				</div>
			</div>
		</div>
		<div class="col-md-2 col-12 d-flex mb-3 mb-md-0 justify-content-center align-items-center">
			<button class='mx-1 btn btn-outline-success' onclick='agregar()'>Añadir nuevo</button>
		</div>
	</div>
	<div class="row mt-3 justify-content-center" id="result"></div>
</div>

<!--Modal agregar nuevo dispositivo-->
<div class='modal fade' id='modal_agregar' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
	<div class="modal-dialog modal-lg modal-dialog-scrollable ">
		<div class='modal-content'>
			<div class=' modal-header'>
				<h4 class="modal-title text-center">Introduzca los datos del nuevo dispositivo</h4>
				<button type='button' class='col-1 btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
			</div>
			<div class='modal-body mb-4 d-flex justify-content-center'>
				<form class="row g-3 form_agregar_disp needs-validation" method="POST" enctype="multipart/form-data"
					id="form_agregar_disp" novalidate action="javascript:void(0)">
					<div class="especificacion">
						<h5 id="galeria">Galería</h5> <!--IMAGENES-->
						<div class="p-3 row">
							<div class="col-12 ">
								<label for="destacada" class="form-label">Imagen destacada</label>
								<input type="file" name="destacada" class="form-control" id="galeria"
									accept="image/png, .jpeg, .jpg, image/gif" required>
							</div>
							<div class="col-12 ">
								<label for="galeria" class="form-label">Galeria</label>
								<input type="file" name="galeria[]" class="form-control" id="galeria"
									accept="image/png, .jpeg, .jpg, image/gif" multiple>
							</div>
						</div>
					</div>
					<div class="especificacion">
						<h5 id="modelo">Modelo</h5><!--MODELO-->
						<div class="p-3">
							<div class=" col-md-12">
								<label for="nombre" class="form-label">Nombre</label>
								<input type="text" name="nombre" class="form-control" id="nombre" value="" required>
							</div>
							<div class=" col-md-12">
								<label for="marca" class="form-label">Marca</label>
								<input type="text" name="marca" class="form-control" id="marca" value="" required>
							</div>

							<div class="col-12">
								<label for="fecha" class="form-label">Fecha de salida</label>
								<input type="date" name="fecha" class="form-control" id="fecha" value="" required>
							</div>
							<div class="col-12">
								<label for="colores" class="form-label">Colores </label>
								<input type="text" name="colores" class="form-control" id="colores"
									placeholder="Colores separados por ',' " value="" required>
							</div>
							<div class="col-12 ">
								<label for="precio" class="form-label">Precio</label>
								<div class="input-group">
									<input type="text" name="precio" class="form-control" id="precio" value="" required>
									<span class="input-group-text">€</span>
								</div>
							</div>

						</div>
					</div>
					<div class="especificacion">
						<h5>Pantalla y diseño</h5><!--PANTALLA Y DISEÑO-->
						<div class="p-3 row">

							<div class="col-md-12">
								<label for="tasa_refresco" class="form-label">Tasa de refresco</label>
								<input type="text" name="tasa_refresco" class="form-control" id="tasa_refresco"
									value="" required>
							</div>

							<label for="resolucion" class="form-label">Resolución</label>
							<div class="col-md-12 d-flex">
								<div class="col-md-5">
									<input type="text" name="resolucion_a" class="form-control" id="resolucion_a"
										value="" required>
								</div>
								<div class="col-md-2 d-flex justify-content-center">
									<span>x</span>
								</div>
								<div class="col-md-5">
									<input type="text" name="resolucion_b" class="form-control" id="resolucion_b"
										value="" required>
								</div>
							</div>
							<div class="col-md-12 ">
								<label for="pulgadas" class="form-label">Pulgadas</label>
								<input type="text" name="pulgadas" class="form-control" id="pulgadas" value="" required>
							</div>
							<div class="col-md-12 ">
								<label for="tipo_pantalla" class="form-label">Tipo de pantalla</label>
								<select class="form-select" aria-label="" name="tipo_pantalla">
									<option value="..." selected>...</option>
									<option name="lcd" value="LCD">LCD</option>
									<option NAME="oled" value="OLED">OLED</option>
									<option NAME="oled" value="OLED">AMOLED</option>
								</select>
							</div>
							<div class="col-12">
								<input type="checkbox" name="pantalla_curva" class="form-check-input"
									id="pantalla_curva" value="1">
								<label for="pantalla_curva" class="form-label">Pantalla curva</label>
							</div>
							<div class="col-md-4 ">
								<label for="alto" class="form-label">Alto</label>
								<div class="input-group">
									<input type="text" name="alto" class="form-control" id="alto" value="" required>
									<span class="input-group-text">cm</span>
								</div>
							</div>
							<div class="col-md-4 ">

								<label for="ancho" class="form-label">Ancho</label>
								<div class="input-group">
									<input type="text" name="ancho" class="form-control" id="ancho" value="" required>
									<span class="input-group-text">cm</span>
								</div>
							</div>
							<div class="col-md-4 ">
								<label for="grosor" class="form-label">Grosor</label>
								<div class="input-group">
									<input type="text" name="grosor" class="form-control" id="grosor" value="" required>
									<span class="input-group-text">cm</span>
								</div>
							</div>
							<div class="col-md-12 ">
								<label for="peso" class="form-label">Peso</label>
								<div class="input-group">
									<input type="text" name="peso" class="form-control" id="peso" value="" required>
									<span class="input-group-text">gr</span>
								</div>
							</div>
							<div class="col-12">
								<label for="resistencia" class="form-label">Resistencia</label>
								<input type="text" name="resistencia" class="form-control" id="resistencia" value="" required>
							</div>
						</div>
					</div>
					<div class="especificacion">
						<h5>Procesador</h5><!--PROCESADOR-->
						<div class="p-3">
							<div class="col-12">
								<label for="ram" class="form-label">Memoria RAM</label>
								<div class="input-group">
									<input type="text" name="ram" class="form-control" id="ram" value="" required>
									<span class="input-group-text">GB</span>
								</div>
							</div>
						</div>
					</div>
					<div class="especificacion">
						<h5>Almacenamiento</h5><!--ALMACENAMIENTO-->
						<div class="p-3">
							<div class="col-12">
								<label for="memoria_interna" class="form-label">Almacenamiento interno</label>
								<div class="input-group">
									<input type="text" name="memoria_interna" class="form-control" id="memoria_interna"
										value="" required>
									<span class="input-group-text">GB</span>
								</div>
							</div>
							<div class="col-12">
								<input type="checkbox" name="ampliable_sd" class="form-check-input" id="ampliable_sd"
									value="1">
								<label for="ampliable_sd" class="form-label">Ampliable (sd)</label>
							</div>
						</div>
					</div>
					<div class="especificacion">
						<h5>Seguridad</h5> <!--SEGURIDAD-->
						<div class="p-3">
							<div class="col-12">
								<input type="checkbox" name="seguridad_facial" class="form-check-input"
									id="seguridad_facial" value="1">
								<label for="seguridad_facial" class="form-label">Seguridad avanzada (Iris-
									facial)</label>
							</div>
							<div class="col-12">
								<input type="checkbox" name="seguridad_huella" class="form-check-input"
									id="seguridad_huella" value="1">
								<label for="seguridad_huella" class="form-label">Huella dactilar</label>
							</div>
						</div>
					</div>
					<div class="especificacion">
						<h5>Fotografía</h5> <!--FOTOGRAFIA-->
						<div class="p-3 row">
							<div class="col-12">
								<label for="cam_trasera" class="form-label">Cámara trasera</label>
								<div class="input-group">
									<input type="text" name="cam_trasera" class="form-control" id="cam_trasera"
										value="" required>
									<span class="input-group-text">Mpx</span>
								</div>
							</div>
							<div class="col-12">
								<label for="lente_teleobjetivo" class="form-label">Lente teleobjetivo</label>
								<div class="input-group">
									<input type="text" name="lente_teleobjetivo" class="form-control"
										id="lente_teleobjetivo" value="" required>
									<span class="input-group-text">Mpx</span>
								</div>
							</div>
							<div class="col-12">
								<label for="lente_macro" class="form-label">Lente Macro</label>
								<div class="input-group">
									<input type="text" name="lente_macro" class="form-control" id="lente_macro"
										value="" required>
									<span class="input-group-text">Mpx</span>
								</div>
							</div>
							<div class="col-12">
								<label for="lente_gran_angular" class="form-label">Lente gran angular</label>
								<div class="input-group">
									<input type="text" name="lente_gran_angular" class="form-control"
										id="lente_gran_angular" placeholder="" value="" required>
									<span class="input-group-text">Mpx</span>
								</div>
							</div>
							<div class="col-12">
								<label for="flash" class="form-label">Flash</label>
								<input type="text" name="flash" class="form-control" id="flash" value="" required>
							</div>
							<div class="col-12">
								<input type="checkbox" name="estabilizacion_opt" class="form-check-input"
									id="estabilizacion_opt" value="1">
								<label for="estabilizacion_opt" class="form-label">Estabilización óptica</label>
							</div>
							<div class="col-12">
								<input type="checkbox" name="slow_motion" class="form-check-input" id="slow_motion"
									value="1">
								<label for="slow_motion" class="form-label">Slow Motion</label>
							</div>
							<div class="col-md-12 ">
								<button type="button" class="btn btn-light m-2" data-bs-toggle="collapse"
									data-bs-target="#caracteristicas_cam_collapse"><img
										src='../assets/img/flecha-hacia-abajo.png' height='15' width='15'> Caracteristicas
									cámara trasera</button>
								<div class=" flex-column border rounded p-3 collapse" id="caracteristicas_cam_collapse">
									<?php
									$carac = $dispositivo_controller->getCaracteristicasCam();
									while ($row = $carac->fetch_assoc()) { ?>
										<div>
											<input type="checkbox" name="caracteristicas_cam[]" class="form-check-input"
												value="<?php echo $row['id'] ?>">
											<label for="caracteristicas_cam" class="form-label">
												<?php echo $row['nombre'] ?>
											</label>
										</div>
									<?php }
									;

									?>
								</div>

							</div>
							<div class="col-12">
								<label for="cam_frontal" class="form-label">Cámara frontal</label>
								<div class="input-group">
									<input type="text" name="cam_frontal" class="form-control" id="cam_frontal"
										placeholder="" value="" required>
									<span class="input-group-text">Mpx</span>
								</div>
							</div>
							<div class="col-12">
								<label for="cam_otras" class="form-label">Caracteristicas extra </label>
								<input type="text" name="cam_otras" class="form-control" id="cam_otras"
									placeholder="Caracteristicas separadas por ','" value="" required>
							</div>
						</div>
					</div>

					<div class="especificacion">
						<h5>Batería</h5> <!--BATERIA-->
						<div class="p-3 row">
							<div class="col-12">
								<label for="bateria" class="form-label">Batería</label>
								<div class="input-group">
									<input type="text" name="bateria" class="form-control" id="bateria" value="" required>
									<span class="input-group-text">mAh</span>
								</div>
							</div>
							<div class="col-12">
								<label for="carga_rapida" class="form-label">Carga rápida</label>
								<div class="input-group">
									<input type="text" name="carga_rapida" class="form-control" id="carga_rapida"
										value="" required>
									<span class="input-group-text">W</span>
								</div>
							</div>
						</div>
					</div>
					<div class="especificacion">
						<h5>Conectividad</h5><!--CONECTIVIDAD-->
						<div class="p-3 row">
							<div class="col-12">
								<input type="checkbox" name="conexion" class="form-check-input" id="conexion" value="1">
								<label for="conexion" class="form-label">Conexión 5G</label>
							</div>
						</div>
					</div>
					<div class="especificacion">
						<h5>Sistema Operativo</h5><!--SISTEMA-->
						<div class="p-3 row">
							<div class="col-12">
								<label for="so" class="form-label">Sistema Operativo</label>
								<input type="text" name="so" class="form-control" id="so" value="" required>
							</div>
						</div>
					</div>
					<div class="especificacion">
						<h5>Usb</h5><!--USB-->
						<div class="p-3 row">
							<div class="col-12">
								<label for="usb_tipo" class="form-label">Usb tipo</label>
								<input type="text" name="usb_tipo" class="form-control" id="usb_tipo" value="" required>
							</div>
							<div class="col-12">
								<input type="checkbox" name="usb_carga" class="form-check-input" id="usb_carga"
									value="1">
								<label for="usb_carga" class="form-label">Carga</label>
							</div>
							<div class="col-12">
								<input type="checkbox" name="usb_otg" class="form-check-input" id="usb_otg" value="1">
								<label for="usb_otg" class="form-label">On the go</label>
							</div>
							<div class="col-12">
								<input type="checkbox" name="usb_masivo" class="form-check-input" id="usb_masivo"
									value="1">
								<label for="usb_masivo" class="form-label">Almacenamiento masivo</label>
							</div>
						</div>
					</div>
					<div class="especificacion">
						<h5>Sensores</h5><!--SENSORES-->
						<div class="p-3 row">
							<div class="col-12">
								<input type="checkbox" name="infrarojos" class="form-check-input" id="infrarojos"
									value="1">
								<label for="infrarojos" class="form-label">Infrarojos</label>
							</div>
							<div class="col-12">
								<input type="checkbox" name="jack" class="form-check-input" id="jack" value="1">
								<label for="jack" class="form-label">Jack</label>
							</div>
							<div class="col-12">
								<input type="checkbox" name="nfc" class="form-check-input" id="nfc" value="1">
								<label for="nfc" class="form-label">NFC</label>
							</div>
							<div class="col-12">
								<button type="button" class="btn btn-light m-2" data-bs-toggle="collapse"
									data-bs-target="#sensores_collapse"><img src='../assets/img/flecha-hacia-abajo.png'
										height='15' width='15'> Otros sensores</button>
								<div class=" flex-column border rounded p-3 collapse" id="sensores_collapse">
									<?php
									$sensores = $dispositivo_controller->getSensores();
									while ($row = $sensores->fetch_assoc()) { ?>
										<div>
											<input type="checkbox" name="sensores[]" class="form-check-input"
												value="<?php echo $row['id'] ?>">
											<label for="sensores" class="form-label">
												<?php echo $row['nombre'] ?>
											</label>
										</div>
									<?php }
									;
									?>
								</div>
							</div>
						</div>
					</div>
					<div class="especificacion">
						<h5>Especificaciones extra</h5><!--EXTRA-->
						<div class="p-3 row">
							<div class="col-12">
								<input type="text" name="otros" class="form-control" id="otros"
									placeholder="Especificaciones separadas por ','" value="" required>
							</div>
						</div>
					</div>
					<div class="especificacion">
						<h5>Puntos a destacar:</h5>
						<div class="p-3 row">
							<div class="col-12">
								<?php
								$list_intereses = $usuarios_controller->getListadoIntereses();
								while ($interes = $list_intereses->fetch_assoc()) { ?>
									<div class="form-check">
										<input class="form-check-input" type="checkbox"
											id="interes_<?php echo $interes["interes_id"] ?>" name="interes[]"
											value="<?php echo $interes["interes_id"] ?>">
										<label class="form-check-label" for="gridCheck">
											<?php echo $interes["interes"] ?>
										</label>
									</div>
								<?php } ?>
							</div>
						</div>
					</div>
					<div class="col-12 d-flex justify-content-center align-items-center">
						<button class="btn btn-primary añadir_disp">Añadir dispositivo</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>


<!-- Modal confirmacion eliminar dispositivo-->
<div class='modal fade' id='modal_confirmacion' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
	<div class='modal-dialog modal-dialog-centered'>
		<div class='modal-content'>
			<div class=' modal-header'>
				<div class='col-11 d-flex justify-content-center'><img src='../assets/img/advertencia.png' width='40' height='40'>
				</div>
				<button type='button' class='col-1 btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
			</div>
			<div class='modal-body d-flex justify-content-center'>
				<span>¿Estas seguro que deseas eliminar el dispositivo?</span>
			</div>
			<div class='modal-footer d-flex justify-content-center'>
				<button type='button' class='btn  btn-primary cancelar m-1' data-bs-dismiss='modal'>Cancelar</button>
				<button type='button' class='btn btn-primary confirmar m-1' onclick='eliminar_disp()'>Confirmar</button>
			</div>
		</div>
	</div>
</div>

<!-- TOAST AVISO DISPOSITIVO AÑADIDO CORRECTAMENTE -->
<div class="toast-container position-fixed top-50 start-50 translate-middle p-3">
	<div id="disp_add_ok_toast" class="toast " role="alert" aria-live="assertive" aria-atomic="true"
		data-bs-delay="3000" style="--bs-bg-opacity: .7; background-color: #72ca47;">
		<div class="d-flex">
			<div class="toast-body">
				¡Dispositivo añadido correctamente!
			</div>
			<button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
				aria-label="Close"></button>
		</div>
	</div>
</div>


<script>
	let selected = '';
	$(document).on("click", '.disp', function (event) {
		$(".btn-active").removeClass("btn-active");
		selected = this.value;
		$("#eliminar").removeAttr("disabled");
		$("#editar").removeAttr("disabled");
		$("#eliminar").css("opacity", "1");
		$("#editar").css("opacity", "1");
		console.log(this);
		$(this).addClass("btn-active");
	});

	$("#eliminar").click(function () {
		$("#modal_confirmacion").modal("show");
	});

	$("#editar").click(function () {
		modificar();
	});

	function buscar_disp() {
		var texto = $("#buscar_disp").val();
		$("#eliminar").attr("disabled", true);
		$("#editar").attr("disabled", true);
		$("#eliminar").css("opacity", "0.2");
		$("#editar").css("opacity", "0.2");
		$.ajax({
			type: "POST",
			url: "../Controller/admin_controller.php",
			cache: false,
			data: {
				texto: texto,
				accion: "buscar_disp"
			}
		}).done(function (respuesta) {
			$("#result").html(respuesta);
		});
	}

	function modificar() {
		location.href = "../modificar_ficha/" + selected;
	}

	function agregar() {
		$("#modal_agregar").modal("show");
	}

	function eliminar_disp() {
		$.ajax({
			type: "POST",
			url: "../Controller/admin_controller.php",
			cache: false,
			data: {
				disp_id: selected,
				accion: "eliminar_disp"
			}
		}).done(function (respuesta) {
			$('#modal_confirmacion').modal('hide');
			buscar_disp();
		});
	}

	var forms = document.querySelectorAll('.needs-validation');
	Array.prototype.slice.call(forms).forEach(function (form) {
		form.addEventListener('submit', function (event) {
				if (!form.checkValidity()) { } else {
					$.ajax({
						url: '../Controller/procesarRegistroDispositivo.php',
						method: "POST",
						data: new FormData($("#form_agregar_disp")[0]),
						processData: false,
						contentType: false,
						success: function (data) {
						var msg = data;
						if (data == 1) {
							$("#modal_agregar").modal("hide");
							const edit_toast = document.getElementById('disp_add_ok_toast')
							edit_toast.addEventListener('hidden.bs.toast', () => {
								buscar_disp();
							})
							const toast = new bootstrap.Toast($('#disp_add_ok_toast'));
							toast.show();
						}
					},
						error: function (data) {
							alert("Error al añadir el dispositivo")
						}
					});
				}
			
			form.classList.add('was-validated')
		}, false)
	})
</script>

<?php include("footer.php");
?>