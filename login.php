<?php
/**
 * Fichero php que implementa la vista login
 * 
 * @author Verónica Terán Molina <vteran@ucm.es>
 */

include_once('header.php');

?>
<div class="title">
	<h1> </h1>
</div>

<div class=" container">
	<div class="row justify-content-center mx-3 mx-md-0">
		<form method="POST" action="javascript:void(0)" class="form_login my-5 col-md-6 col-12">
			<div class="acceso"></div>
			<div class="row ">
				<div class="form-floating g-0 mb-3">
					<input type="text" name="usuario" id="usuario" class="form-control" placeholder="Usuario" required>
					<label for="usuario">Nombre de usuario</label>
				</div>
			</div>
			<div class="row">
				<div class="form-floating g-0 mb-3">
					<input type="password" name="password" id="pass" class="form-control" placeholder="Contraseña"
						required>
					<label for="pass">Contraseña</label>
					<a href="cambiar_contrasena"> ¿Olvidaste tu contraseña?</a>
				</div>
			</div>
			<div class="row">
				<button id="acceder" class="btn btn-outline-warning col-lg-4 col-8 m-auto mb-3 mb-lg-0">Iniciar
					sesión</button>
				<button type="button" id="registro" class="btn btn-outline-primary col-lg-4 col-8 m-auto mb-3 mb-lg-0 ">Registrate</button>

			</div>


		</form>
	</div>
</div>
<script>
	$(".form_login").submit(function () {
		$.ajax({
			url: '../Controller/procesarLogin',
			type: 'POST',
			data: jQuery('form').serialize()
		}).then(function (resp) {
			$('.acceso').html(resp);
		});
	});

	$("#registro").click(function(){
		location.href = "../registro.php";
	});


</script>
<?php include_once("footer.php"); ?>