<?php
/**
 * Fichero php que implementa la vista de cambio de contraseña
 * 
 * @author Verónica Terán Molina <vteran@ucm.es>
 */

include_once('header.php'); ?>

<div class="title row m-auto p-2">
	<h1 class="col-12">Cambiar contraseña</h1>
</div>

<div class=" container   d-flex justify-content-center align-items-center">
	<form method="POST" action="Controller/procesarCambioContrasena.php" class="form_login my-5">
		<div class="acceso"></div>
		<div class="row ">
			<h5 class="col-12"> Usuario</h5>
			<div class="form-floating col-12 g-0 mb-3">
				<input type="nombreUsuario" name="nombreUsuario" class="form-control" id="nombreUsuario" placeholder="Nombre Usuario"
					required>
				<label for="nombreUsuario">Nombre de usuario</label>
			</div>
			<h5 class="col-12 mt-3">Contraseña</h5>
			<div class="form-floating col-12 g-0 mb-3">
				<input type="password" name="password" class="form-control" id="pass" placeholder="Nueva contraseña"
					required>
				<label for="pass">Nueva contraseña</label>
			</div>
			<div class="form-floating col-12 g-0 mb-3">
				<input type="password" name="password2" class="form-control" id="pass2" placeholder="Repite contraseña"
					required onchange="confirmPassword()">
				<label for="pass2">Repite contraseña</label>
			</div>
		</div>
		<div class="row">
			<button type="submit" class="btn btn-outline-primary col-lg-4 col-8 m-auto mb-3 mb-lg-0">Cambiar</button>
		</div>
	</form>
</div>

<?php include("footer.php"); ?>

<script>
	function confirmPassword() {
		if ($('#pass').val() == $('#pass2').val()) {
			return true;
		} else {
			alert("No coinciden las contraseñas, por favor reviselo");
			$('#pass').val('');
			$('#pass2').val('');
			return false;
		}
	}
</script>