<?php
/**
 * Fichero php que implementa la vista relativa a la gestión de usuarios y configuraciones del usuario admin
 * 
 * @author Verónica Terán Molina <vteran@ucm.es>
 */

include_once('header.php');
include_once "Controller/usuarios_controller.php";


$usuarios_controller = new usuarios_controller();
?>


<div class="title">
	<h3>Gestión de usuarios</h3>
</div>

<div class=" container ">
	<div class="row buscador justify-content-center">
		<div class="col-md-10 col-12">
			<div class="row">
				<div class=" col-9 my-3 pe-0 d-flex" role="search">
					<input class="form-control me-2" id="buscar_usuario" type="search" placeholder="Buscar usuario"
						aria-label="Buscar">
					<button class="btn btn-outline-primary" id="buscar" onclick="buscar_usuario();">Buscar</button>
				</div>
				<div class="col-3 d-flex">
					<button type="button" id='eliminar' class='mx-1' data-bs-toggle='tooltip' data-bs-placement='bottom'
						title='Eliminar' disabled><img src='../assets/img/delete-disp.png' height='30' width='35'></button>
					<button type="button" id='editar' class='mx-1' data-bs-toggle='tooltip' data-bs-placement='bottom'
						title='Editar' disabled><img src='../assets/img/compose.png' height='30' width='35'></button>
				</div>
			</div>
		</div>
		<div class="col-md-2 col-12 d-flex mb-3 mb-md-0 justify-content-center align-items-center">
			<button class='mx-1 btn btn-outline-success' onclick="agregar();">Añadir nuevo</button>
		</div>
	</div>
	<div class="row  p-3  ">
		<div id="result"></div>
	</div>
</div>

<!--Modal agregar nuevo usuario-->
<div class='modal fade' id='modal_agregar' tabindex="-1" role="dialog" aria-labelledby='exampleModalLabel'>
	<div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
		<div class='modal-content'>
			<div class=' modal-header'>
				<h4 class="modal-title text-center">Introduzca los datos del nuevo usuario</h4>
				<button type='button' class='col-1 btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
			</div>
			<div class='modal-body mb-4 justify-content-center'>
				<form class="row g-3 my-5 form_registro needs-validation" method="POST" enctype="multipart/form-data"
					id="form_nuevo_user" novalidate action="javascript:void(0)">
					<div class="col-md-4">
						<label for="nombre" class="form-label">Nombre</label>
						<input type="nombre" name="nombre" class="form-control" id="nombre" required>
					</div>
					<div class="col-md-4">
						<label for="apellidos" class="form-label">Apellidos</label>
						<input type="apellidos" name="apellidos" class="form-control" id="apellidos" required>
					</div>
					<div class="col-md-4">
						<label for="fecha" class="form-label">Fecha</label>
						<input type="date" name="fecha" class="form-control" id="fecha" required>
					</div>
					<div class="col-12">
						<label for="usuario" class="form-label">Usuario</label>
						<input type="usuario" name="usuario" class="form-control" id="usuario" required>
					</div>
					<div class="col-12">
						<label for="email" class="form-label">Email</label>
						<input type="text" class="form-control" id="email" required onchange="comprobarCorreo(this)"
							name="email" maxlength="50" size="14" required>
					</div>
					<div class="val_email col-md-12"></div>
					<div class="col-12 d-flex">
						<div class="col-6">
							<label for="password" class="form-label">Contraseña</label>
							<input type="password" name="password" id="pass" class="form-control" id="password"
								required>
						</div>
						<div class="col-6">
							<label for="password2" class="form-label">Reescribe contraseña</label>
							<input type="password" id="pass2" name="password2" class="form-control" id="password2"
								required onchange="confirmPassword()">
						</div>
					</div>
					<div class="val_pass col-md-12"></div>
					<div class="col-md-6">
						<label for="ocupacion" class="form-label">
							<h6>Trabajo/ocupación</h6>
						</label>
						<select class="form-select" aria-label="" name="ocupacion">
							<?php $list_ocp = $usuarios_controller->getListadoOcupaciones();
							while ($ocp = $list_ocp->fetch_assoc()) { ?>
								<option value="<?php echo $ocp["id_ocupacion"] ?>"><?php echo $ocp["descripcion"] ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-md-12 p-2">
						Marcas preferidas
					</div>
					<div class="val_checks col-md-6 mt-0"></div>
					<div class="col-12 check_marcas mt-0">
						<?php
						$list_marcas = $usuarios_controller->getListadoMarcas();
						while ($marca = $list_marcas->fetch_assoc()) { ?>
							<div class="form-check">
								<input class="form-check-input" type="checkbox" id="<?php echo $marca["marca"] ?>"
									name="marcas[]" value="<?php echo $marca["marca_id"] ?>">
								<label class="form-check-label" for="gridCheck">
									<?php echo $marca["marca"] ?>
								</label>
							</div>
						<?php } ?>
					</div>
					<div class="col-md-12 p-2">¿Cuales de los siguientes puntos te interesan más?</div>
					<div class="val_checks col-md-6 mt-0"></div>
					<div class="col-12 check_intereses">
						<?php
						$list_intereses = $usuarios_controller->getListadoIntereses();
						while ($interes = $list_intereses->fetch_assoc()) { ?>
							<div class="form-check">
								<input class="form-check-input" type="checkbox" id="<?php echo $marca["nombre"] ?>"
									name="interes[]" value="<?php echo $interes["interes_id"] ?>">
								<label class="form-check-label" for="gridCheck">
									<?php echo $interes["interes"] ?>
								</label>
							</div>
						<?php } ?>
					</div>
					<div class="mensaje"></div>
					<div class="col-12 d-flex justify-content-center align-items-center">
						<button type="submit" class="btn btn-primary">Resgistrar</button>
					</div>
				</form>

			</div>
		</div>
	</div>
</div>

<!-- Modal confirmacion eliminar usuario-->
<div class='modal fade' id='modal_confirmacion' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
	<div class='modal-dialog modal-dialog-centered'>
		<div class='modal-content'>
			<div class=' modal-header'>
				<div class='col-11 d-flex justify-content-center'><img src='../assets/img/advertencia.png' width='40'
						height='40'></div>
				<button type='button' class='col-1 btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
			</div>
			<div class='modal-body d-flex justify-content-center'>
				<span>¿Estas seguro que deseas eliminar este usuario?</span>
			</div>
			<div class='modal-body d-flex justify-content-center'>
				<button type='button' class='btn  btn-primary cancelar m-auto' data-bs-dismiss='modal'>Cancelar</button>
				<button type='button' class='btn btn-primary confirmar m-auto'
					onclick='eliminar_usuario()'>Confirmar</button>
			</div>
		</div>
	</div>
</div>


<!-- Modal mensaje de aviso-->
<div class='modal fade' id='modal_warning' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'
	data-backdrop="false">
	<div class='modal-dialog modal-dialog-centered modal-sm'>
		<div class='modal-content'>
			<div class='modal-body modal_warning d-flex justify-content-center'>
				<span class="result_msg text-center"></span>
			</div>
		</div>
	</div>
</div>


<script>
	let valoresCheck = '';
	$(document).ajaxComplete(function () {
		$('input[name="listGroupRadioGrid"]').click(function () {
			console.log(this);
			valoresCheck = this.value;
			$("#eliminar").removeAttr("disabled");
			$("#editar").removeAttr("disabled");
			$("#eliminar").css("opacity", "1");
			$("#editar").css("opacity", "1");
		})
	});

	$("#eliminar").click(function () {
		$("#modal_confirmacion").modal("show");
	});

	$("#editar").click(function () {
		modificar();
	});

	function buscar_usuario() {
		$("#eliminar").attr("disabled", true);
		$("#editar").attr("disabled", true);
		$("#eliminar").css("opacity", "0.2");
		$("#editar").css("opacity", "0.2");
		var nombre = $("#buscar_usuario").val();
		$.ajax({
			type: "POST",
			url: "../Controller/admin_controller.php",
			cache: false,
			data: {
				nombre: nombre,
				accion: "buscar_usuario"
			}
		}).done(function (respuesta) {
			$("#result").html(respuesta);
		});
	}

	function modificar() {
		location.href = "../modificar_perfil/" + valoresCheck;
		buscar_usuario();
	}

	function agregar() {
		$("#modal_agregar").modal("show");
	}

	function correoValido(correo) {
		var compr = correo.split("@");
		if (compr[1]) {
			compr = compr[1].split(".");
			if (compr[1]) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	function comprobarCorreo(correo) {
		if (!correoValido($(correo).val())) {
			$('.val_email').html("<div class='p-2 text-danger-emphasis bg-danger-subtle border border-danger-subtle rounded-3'>El email introducido no es valido, por favor reviselo</div>");
		} else {
			$('.val_email').html("");
		}
	}

	function confirmPassword() {
		if ($('#pass').val() == $('#pass2').val()) {
			$('.val_pass').html("");
			return true;
		} else {
			$('.val_pass').html("<div class='p-2 text-danger-emphasis bg-danger-subtle border border-danger-subtle rounded-3'>No coinciden las contraseñas, por favor reviselo</div>");
			$('#pass').val('');
			$('#pass2').val('');
			return false;
		}
	}

	var forms = document.querySelectorAll('.needs-validation');
	Array.prototype.slice.call(forms).forEach(function (form) {
		form.addEventListener('submit', function (event) {
			if ($('input[name="interes[]"]:checked').length == 0) {
				$('.val_checks').html("<div class='p-2 text-danger-emphasis bg-danger-subtle border border-danger-subtle rounded-3'>¡Por favor, marca al menos uno!</div>");
			} else {
				if (!form.checkValidity()) { } else {
					$.ajax({
						url: '../Controller/procesarRegistro.php',
						type: 'POST',
						data: $('#form_nuevo_user').serialize()
					}).then(function (resp) {
						if (resp === '1') {
							$("#modal_agregar").modal("hide");
							const edit_toast = document.getElementById('user_add_ok_toast')
							edit_toast.addEventListener('hidden.bs.toast', () => {
								buscar_usuario();
							})
							const toast = new bootstrap.Toast($('#user_add_ok_toast'));
							toast.show();
						} else if (resp === 'user') {
							const edit_toast = document.getElementById('user_exists_toast')
							edit_toast.addEventListener('hidden.bs.toast', () => {
							})
							const toast = new bootstrap.Toast($('#user_exists_toast'));
							toast.show();
						} else if (resp === 'correo') {
							const edit_toast = document.getElementById('email_exists_toast')
							edit_toast.addEventListener('hidden.bs.toast', () => {
							})
							const toast = new bootstrap.Toast($('#email_exists_toast'));
							toast.show();
						}
					});
				}
			}
			form.classList.add('was-validated')
		}, false)
	})

	function eliminar_usuario() {
		$.ajax({
			type: "POST",
			url: "../Controller/admin_controller.php",
			cache: false,
			data: {
				nombreUsuario: valoresCheck,
				accion: "eliminar_usuario"
			},
		}).done(function (respuesta) {
			$('#modal_confirmacion').modal('hide');
			buscar_usuario();
		});
	}
</script>

<?php include("footer.php");
?>