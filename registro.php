<?php
/**
 * Fichero php que implementa la vista para el registro de usuarios
 * 
 * @author Verónica Terán Molina <vteran@ucm.es>
 */

include_once('header.php');
include_once "Controller/usuarios_controller.php";


$usuarios_controller = new usuarios_controller();
?>


<title>Registro</title>
<div class=" container   mb-5 justify-content-center align-items-center">
	<div class="row title pt-3">
		<?php if (isset($_SESSION["isAdmin"])) { ?>
			<h1 class="col-12"> Alta nuevo usuario</h1>
		<?php } else { ?>
			<h1 class="col-12"> Be smarty</h1>
		<?php } ?>
	</div>
	<div class="row">
		<form class="p-5 g-3 mb-3 form_registro needs-validation" novalidate action="javascript:void(0)" method="POST">
			<div class="row">
				<div class="col-md-4">
					<label for="nombre" class="form-label">
						<h6>Nombre</h6>
					</label>
					<input type="nombre" name="nombre" class="form-control" id="nombre" required>
				</div>
				<div class="col-md-4">
					<label for="apellidos" class="form-label">
						<h6>Apellidos</h6>
					</label>
					<input type="apellidos" name="apellidos" class="form-control" id="apellidos" required>
				</div>
				<div class="col-md-4">
					<label for="fecha" class="form-label">
						<h6>Fecha de nacimiento</h6>
					</label>
					<input type="date" name="fecha" class="form-control" id="fecha" required>
				</div>
			</div>
			<div class="row">
				<div class="col-12 pt-3">
					<label for="usuario" class="form-label">
						<h6>Nombre de usuario</h6>
					</label>
					<input type="usuario" name="usuario" class="form-control" id="usuario" required>
				</div>
			</div>
			<div class="row">
				<div class="col-12 pt-3">
					<label for="email" class="form-label">
						<h6>Email</h6>
					</label>
					<input type="text" class="form-control" id="email" required onchange="comprobarCorreo(this)"
						name="email" maxlength="50" size="14">
				</div>
				<div class="val_email col-md-12 mt-0"></div>
			</div>
			<div class="row">
				<div class="col-md-6 col-12 pe-lg-2 mt-3">
					<label for="password" class="form-label">
						<h6>Contraseña</h6>
					</label>
					<input type="password" name="password" id="pass" class="form-control" id="password" required>
				</div>
				<div class="col-md-6 col-12 mt-3">
					<label for="password2" class="form-label">
						<h6>Reescribe contraseña</h6>
					</label>
					<input type="password" id="pass2" name="password2" class="form-control" id="password2" required
						onchange="confirmPassword()">
				</div>
				<div class="val_pass col-md-12 mt-0"></div>
			</div>
			<div class="row">
				<div class="col-md-6 mt-3">
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
			</div>
			<div class="row">
				<div class="col-md-12 p-2 mt-3">
					<h6><img src='../assets/img/right.png' height='20' width='20' class="me-1">
						Selecciona tus marcas preferidas</h6>
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
			</div>
			<div class="row">
				<div class="col-md-12 p-2">
					<h6><img src='../assets/img/right.png' height='20' width='20' class="me-1 mt-3">
						¿Cuales de los siguientes puntos valoras más para el uso de tu dispositivo?</h6>
				</div>
				<div class="val_checks col-md-6 mt-0"></div>
				<div class="col-12 check_intereses mt-0">
					<?php
					$list_intereses = $usuarios_controller->getListadoIntereses();

					while ($interes = $list_intereses->fetch_assoc()) { ?>
						<div class="form-check">
							<input class="form-check-input" type="checkbox" id="<?php echo $interes["interes"] ?>"
								name="interes[]" value="<?php echo $interes["interes_id"] ?>">
							<label class="form-check-label" for="gridCheck">
								<?php echo $interes["interes"] ?>
							</label>
						</div>
					<?php } ?>
				</div>
			</div>
			<div class="col-12 d-flex justify-content-center align-items-center">
				<button type="submit" class="btn btn-primary">Resgistrar</button>
			</div>
		</form>
	</div>
</div>

<script>

	$(document).ready(function () {
		$("form").keypress(function (e) {
			if (e.which == 13) {
				return false;
			}
		});

	});

	function correoValido(correo) {
		var compr = correo.split("@");
		if (compr[1]) {
			compr = compr[1].split(".");
			if (compr[1])
				return true;
			else
				return false;
		} else
			return false;
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

	var forms = document.querySelectorAll('.needs-validation')

	Array.prototype.slice.call(forms).forEach(function (form) {
		form.addEventListener('submit', function (event) {
			if ($('input[name="interes[]"]:checked').length == 0) {
				$('.val_checks').html("<div class='p-2 text-danger-emphasis bg-danger-subtle border border-danger-subtle rounded-3'>¡Por favor, marca al menos uno!</div>");
			} else {
				if (!form.checkValidity()) {
					alert("Por favor, revisa los datos");
				} else {
					$.ajax({
						url: '../Controller/procesarRegistro.php',
						type: 'POST',
						data: $('.form_registro').serialize()
					}).then(function (resp) {
						if (resp === '1') {
							history.back();
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
</script>

<?php include_once("footer.php"); ?>