<?php
/**
 * Fichero php que implementa la vista del perfil del usuario 'nombreUsuario'
 * 
 * @author Verónica Terán Molina <vteran@ucm.es>
 */

include_once('header.php');
include_once 'Controller/usuarios_controller.php';
include_once "Controller/dispositivo_controller.php";

$nombreUsuario = $_GET["usuario"];
$usuarios_controller = new usuarios_controller();

if ($usuarios_controller->existeUsuario($nombreUsuario)) {
	$usuario = $usuarios_controller->getUser($nombreUsuario);
	$intereses = $usuarios_controller->getInteresesUser($usuario["user_id"]);
	$marcas = $usuarios_controller->getMarcasUser($usuario["user_id"]);
	?>

	<div class="container p-4">
		<div class="row justify-content-center">
			<div class="col">
				<div class="card user-card-full">
					<div class="row   ">
						<div class="col-sm-3  user-profile">
							<div class="card-block text-center text-white">
								<div class="avatar_perfil">
									<?php $img = $usuarios_controller->getAvatarUser($usuario["nombreUsuario"]) ?>
									<img src="../public_html/galerias/<?php echo $img ?>" class="img-radius "
										alt="User-Profile-Image" id="img_avatar">
								</div>
								<h5 class="f-w-600">
									<?php echo $usuario['nombre'] ?>
									<?php echo $usuario['apellidos'] ?>
								</h5>
								<div class=''>
									<a href='modificar_perfil?usuario=<?php echo $_SESSION["nombreUsuario"] ?>'
										id='editar_perfil' class='mx-1  ' data-bs-toggle='tooltip'
										data-bs-placement='bottom' title='Editar'><img src='../assets/img/editar.png'
											height='20' width='20'></a>
								</div>
							</div>
						</div>
						<div class="col-sm-9 ">
							<div class="card-block">
								<h6 class="m-b-20 p-b-5 b-b-default f-w-600">Información</h6>
								<div class="row">
									<div class="col-sm-4">
										<p class="m-b-10 f-w-600">Usuario</p>
										<h6 class="text-muted f-w-400">
											<?php echo $usuario['nombreUsuario'] ?>
										</h6>
									</div>
									<div class="col-sm-4">
										<p class="m-b-10 f-w-600">Email</p>
										<h6 class="text-muted f-w-400">
											<?php echo $usuario['email'] ?>
										</h6>
									</div>
									<div class="col-sm-4">
										<p class="m-b-10 f-w-600">Fecha de nacimiento</p>
										<h6 class="text-muted f-w-400">
											<?php echo $usuario['fecha'] ?>
										</h6>
									</div>
								</div>
								<h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600 ">Perfil detallado</h6>
								<div class="row info-profile">
									<div class="col-sm-4">
										<p class="m-b-10 f-w-600">Ocupación</p>

										<h6 class="text-muted f-w-400">
											<?php echo $usuario['ocupacion'] ?>
										</h6>
									</div>
									<div class="col-sm-4">
										<p class="m-b-10 f-w-600 ">Intereses</p>
										<?php
										while ($interes_id = $intereses->fetch_assoc()) {
											if (!empty($interes_id)) {
												$interes = $usuarios_controller->getInteres($interes_id["interes_id"]); ?>
												<h6 class='text-muted f-w-400 interes'><img src='../assets/img/menos.png' height='16'
														width='16' class='m-auto'>
													<?php echo $interes["interes"] ?>
												</h6>
											<?php }
										}
										?>
									</div>
									<div class="col-sm-4">
										<p class="m-b-10 f-w-600">Marcas</p>
										<?php
										while ($marca_id = $marcas->fetch_assoc()) {
											if (!empty($marca_id)) {
												$marca = $usuarios_controller->getMarca($marca_id["marca_id"]); ?>
												<h6 class='text-muted f-w-400 interes'><img src='../assets/img/menos.png' height='16'
														width='16' class='m-auto'>
													<?php echo $marca["marca"] ?>
												</h6>
											<?php }
										}
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php } else {
	echo "<br><div id='login' align='center'>El usuario que busca ha borrado su cuenta.</div>";
} ?>

<?php include_once("footer.php")
	?>