<?php
/**
 * Fichero php que implementa la vista para modificar los datos del perfil del usuario 'user'
 * 
 * @author Verónica Terán Molina <vteran@ucm.es>
 */

include_once('header.php');
include_once 'Controller/usuarios_controller.php';
include_once "Controller/dispositivo_controller.php";


$usuarios_controller = new usuarios_controller();
$dispositivo_controller = new dispositivo_controller();
$directorio = '../public_html/galerias/';

if ($usuarios_controller->existeUsuario($_GET['usuario'])) {
	$user = $usuarios_controller->getUser($_GET['usuario']);
	$intereses = $usuarios_controller->getInteresesUser($user["user_id"]);
	$marcas = $usuarios_controller->getMarcasUser($user["user_id"]);
?>

	<style>
		.label {
			cursor: pointer;
		}

		.progress {
			display: none;
			margin-bottom: 1rem;
		}

		.alert {
			display: none;
		}

		.modal-img-container img {
			max-width: 100%;
		}

		@media (max-width: 575.98px) {
			.modal-img-container {
				max-height: 70vh !important;
			}
		}
	</style>

	<!-- Modal recorte de avatar -->
	<div class="modal fade" id="cropAvatarmodal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
		aria-labelledby="modalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modalLabel">Recorte avatar</h5>
					<button type="button" class="col-1 btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body cropAvatarmodal">
					<div class="modal-img-container">
						<img id="uploadedAvatar" src="">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn  btn-secondary" data-bs-dismiss="modal">Cancelar</button>
					<button type="button" class="btn btn-success" id="crop">Recortar</button>
				</div>
			</div>
		</div>
	</div>

	<div class=" container mt-md-5 mt-4  ">
		<div class="row">
			<div class="title">
				<h5>Modificar perfil</h5>
			</div>
		</div>
		<div class="row  mb-5 justify-content-center align-items-center">
			<form class="row g-3 mb-5" id="form_mod"
				action="javascript:void(0)"  method="POST"
				enctype="multipart/form-data">
				<div class=" col-12">
					<textarea class="d-none" name="file_json" id="file_json"></textarea>
					<img class="rounded" id="profile-img" src="<?php echo $directorio . $user["avatar"] ?>" alt="avatar">

					<label class="label custom-file-upload btn btn-warning ml-3">
						<input type="file" class="d-none" id="file-input" name="image" accept="image/*">
						Modificar avatar
					</label>
				</div>
				<div class="col-md-4">
					<label for="nombre" class="form-label">Nombre</label>
					<input type="nombre" name="nombre" class="form-control" id="nombre"
						value="<?php echo $user["nombre"] ?>">
				</div>
				<div class="col-md-4">
					<label for="apellidos" class="form-label">Apellidos</label>
					<input type="apellidos" name="apellidos" class="form-control" id="apellidos"
						value="<?php echo $user["apellidos"] ?>">
				</div>
				<div class="col-md-4">
					<label for="fecha" class="form-label">Fecha de nacimiento</label>
					<input type="date" name="fecha" class="form-control" id="fecha" value="<?php echo $user["fecha"] ?>">
				</div>
				<div class="col-12">
					<label for="email" class="form-label">Nombre de usuario</label>
					<input class="form-control" name="nombreUsuario" type="text" id="nombreUsuario"
						value="<?php echo $user["nombreUsuario"] ?>" readonly disabled>
					<input class="d-none" name="user_id" type="text" id="user_id" value="<?php echo $user["user_id"]; ?>">
				</div>
				<div class="col-12">
					<label for="email" class="form-label">Email</label>
					<input type="text" class="form-control" id="email" required onchange="comprobarCorreo(this)"
						name="email" maxlength="50" size="14" value="<?php echo $user["email"] ?>" readonly disabled>
				</div>
				<div class="col-md-6">
					<label for="ocupacion" class="form-label">
						<h6>Trabajo/ocupación</h6>
					</label>
					<select class="form-select" aria-label="" name="ocupacion" id="ocupacion">
						<?php $list_ocp = $usuarios_controller->getListadoOcupaciones();
						while ($ocp = $list_ocp->fetch_assoc()) { ?>
							<option value="<?php echo $ocp["id_ocupacion"] ?>"><?php echo $ocp["descripcion"] ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="col-md-12 p-2">
					<h6>Selecciona tus marcas preferidas</h6>
				</div>
				<div class="val_checks col-md-6 mt-0"></div>
				<div class="col-12 check_marcas mt-0">
					<?php
					$list_marcas = $usuarios_controller->getListadoMarcas();
					while ($marca = $list_marcas->fetch_assoc()) { ?>
						<div class="form-check">
							<input class="form-check-input" type="checkbox" id="marca_<?php echo $marca["marca_id"] ?>"
								name="marcas[]" value="<?php echo $marca["marca_id"] ?>">
							<label class="form-check-label" for="gridCheck">
								<?php echo $marca["marca"] ?>
							</label>
						</div>

					<?php } ?>
				</div>
				<div class="col-12">
					<label for="intereses" class="form-label">
						<h6>¿Cuales de los siguientes puntos valoras más para el uso de tu dispositivo?</h6>
					</label>
					<?php
					$list_intereses = $usuarios_controller->getListadoIntereses();

					while ($interes = $list_intereses->fetch_assoc()) { ?>
						<div class="form-check">
							<input class="form-check-input" type="checkbox" id="interes_<?php echo $interes["interes_id"] ?>"
								name="interes[]" value="<?php echo $interes["interes_id"] ?>">
							<label class="form-check-label" for="gridCheck">
								<?php echo $interes["interes"] ?>
							</label>
						</div>
					<?php } ?>
				</div>
			</form>
			<div class="row">
				<div class="col-12 d-flex justify-content-center align-items-center">
					<button class="btn btn-danger mx-2" onclick="history.back()">Cancelar</button>
					<button class="btn btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#modal_confirmacion">Modificar</button>
				</div>
			</div>
		</div>
	</div>

<?php } else {
	echo "<br><div id='login' align='center'>El usuario que busca ha borrado su cuenta.</div>";
}
?>

<!-- Modal confirmacion-->
<div class="modal fade" id="modal_confirmacion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content m-3 m-sm-0">
			<div class=" modal-header">
				<button type="button" class="col-1 btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body d-flex justify-content-center">
				<div class="row justify-content-center">
					<div class="col-11 d-flex justify-content-center"><img src="../assets/img/advertencia.png" width="40"
							height="40"></div>
					<span class="col-12 text-center">¿Estas seguro que deseas realizar la modificación?</span>
					<span class="loader d-none col-12 mt-2"></span>
				</div>
			</div>
			<div class="modal-footer d-flex justify-content-center">
				<button type="button" class="btn  btn-primary cancelar" data-bs-dismiss="modal">Cancelar</button>
				<button type="button" class="btn btn-primary confirmar">Confirmar</button>
			</div>
		</div>
	</div>
</div>


<script>
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
			alert("El email introducido no es valido, por favor reviselo");
			$('#email').val('');
		}
	}

	$(".confirmar").click(function () {
		// $("#form_mod").submit();
		$.ajax({
						url: '../Controller/procesarModificacion.php?usuario=<?php echo $_GET['usuario'] ?>',
						method: "POST",
						data: new FormData($("#form_mod")[0]),
						processData: false,
						contentType: false,
						success: function (data) {
							if(data==1){
								location.reload();
							}else if(data==2){
								location.href='../gestion/usuarios';
							}
					},
						error: function (data) {
							alert("Error al modificar el usuario")
						}
					});
		$('.loader').removeClass("d-none");
	});

	<?php
	while ($interes = $intereses->fetch_assoc()) {
		?>
		$("#interes_<?php echo $interes["interes_id"] ?>").attr("checked", true);
	<?php }

	while ($marca = $marcas->fetch_assoc()) {
	?>
		$("#marca_<?php echo $marca["marca_id"] ?>").attr("checked", true);
	<?php } ?>

	<?php if ($user['ocupacion'] != null) { ?>
		$('#ocupacion option[value="<?php echo $user['ocupacion']; ?>"]').attr('selected', true);
	<?php } ?>

	$("#galeria").change(function () {
		$(".recorte").removeClass('d-none');
	});

	//Evento para el recorte de la imagen del avatar una vez cargada
	window.addEventListener('DOMContentLoaded', function () {
		var avatar = document.getElementById('profile-img');
		var image = document.getElementById('uploadedAvatar');
		var input = document.getElementById('file-input');
		var cropBtn = document.getElementById('crop');
		var $modal = $('#cropAvatarmodal');
		var cropper;
		input.addEventListener('change', function (e) {
			var files = e.target.files;
			var done = function (url) {
				image.src = url;
				$modal.modal('show');
			};

			if (files && files.length > 0) {
				let file = files[0];
				reader = new FileReader();
				reader.onload = function (e) {
					done(reader.result);
				};
				reader.readAsDataURL(file);
			}
		});
		$modal.on('shown.bs.modal', function () {
			cropper = new Cropper(image, {
				viewMode: 0,
				dragMode: 'move',
				aspectRatio: 1,
				responsive: true,
				highlight: false,
			});
		}).on('hidden.bs.modal', function () {
			cropper.destroy();
			cropper = null;
		});
		cropBtn.addEventListener('click', function () {
			var canvas;
			$modal.modal('hide');
			if (cropper) {
				canvas = cropper.getCroppedCanvas({
					width: 160,
					height: 160,
				});
				avatar.src = canvas.toDataURL();
				document.getElementById('file_json').innerHTML = canvas.toDataURL();
			}
		});
	});

</script>
<?php include("footer.php") ?>