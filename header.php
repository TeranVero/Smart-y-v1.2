<?php
/**
 * Plantilla php que implementa la vista de la cabecera
 * 
 * @author Verónica Terán Molina <vteran@ucm.es>
 */

include('init.php');

?>
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html">
	<title>Smart-y</title>
	<link rel="stylesheet" href="../assets/css/style_scss.css" type="text/css">
	<link rel="stylesheet" href="../chatbot/css/chat_style.css" type="text/css">
	<link href="../assets/bootstrap-5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://unpkg.com/jquery@3/dist/jquery.min.js"></script>
	<script src="../chatbot/chatbot_class.js"></script>
	<script src="../assets/bootstrap-5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
	<script src="../assets/js/smart-y.js"></script>
	<script src="../assets/js/hasEventListener.js"></script>
	<link rel=" icon" href="../logo_small.png" type="image/x-icon">
	<link rel="stylesheet" href="../node_modules/flickity/dist/flickity.min.css">
	<script src="https://fengyuanchen.github.io/cropperjs/js/cropper.js"></script>
	<link href="https://fengyuanchen.github.io/cropperjs/css/cropper.css" rel="stylesheet" />
	<link rel="stylesheet" href="../node_modules/@fancyapps/ui/dist/fancybox.css">
	<script src="../node_modules/flickity/dist/flickity.pkgd.min.js"></script>
	<script src="https://smtpjs.com/v3/smtp.js"></script>
</head>

<body>
	<button class="arriba icon-flecha-arriba"></button>
	<header>
		<div>
			<nav class="navbar navbar-expand-md  fixed-top mb-3">
				<div class="container-fluid">
					<a class="navbar-brand mx-0" href="index">
						<img src="../assets/img/logo_2.png" alt="" width="100"></img>
					</a>
					<button class="navbar-toggler p-0 border-0" type="button" id="navbarSideCollapse"
						aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="navbar-collapse offcanvas-collapse" id="navbarCollapse">
						<ul class="navbar-nav me-auto mb-2 mb-lg-0">
							<li class="nav-item nav-item-index">
								<a class="nav-link index" aria-current="page" href="/index">Home</a>
							</li>
							<li class="nav-item nav-item-contacto">
								<a class="nav-link saber_mas" href="saber_mas">Sobre "Smart-y"</a>
							</li>
							<li class="nav-item nav-item-buscador">
								<form id="form_buscador_dispositivo" method="GET" action="/busqueda">
									<div class="input-group">
										<input type="search" class="form-control" placeholder="Nombre o modelo"
											id="buscador_dispositivo" 2aria-label="Search" name="nombre" value="">
										<button type="submit" class="btn btn-outline-secondary">
											Buscar dispositivo
										</button>
									</div>
								</form>
							</li>
						</ul>

						<ul class="navbar-nav ">
							<?php
							include_once "Controller/usuarios_controller.php";
							$usuarios = new usuarios_controller();
							$usuarios->procesaUsuario();
							?>
						</ul>
					</div>
				</div>
			</nav>

			<?php
			/**
			 * Submenu en funcion de inicio de sesion por usuario admin o registrado
			 */
			if (isset($_SESSION['isUser']) && $_SESSION['isUser'] == true) { ?>
				<div class="nav-scroller shadow-sm d-flex  collapse mb-4 mb-lg-5" id="sub_menu">
					<nav class="nav" aria-label="Secondary navigation">
						<a class="nav-link perfil text-warning-emphasis" aria-current="page"
							href="/perfil/<?php echo $_SESSION["nombreUsuario"] ?>">Mi perfil</a>
						<a class="nav-link dispositivos text-warning-emphasis"
							href="/dispositivos/<?php echo $_SESSION["nombreUsuario"] ?>">Mis dispositivos</a>
						<a class="nav-link recomendaciones text-warning-emphasis"
							href="/recomendaciones/<?php echo $_SESSION["nombreUsuario"] ?>">
							Mis recomendaciones
						</a>
						<a class="nav-link contactos text-warning-emphasis"
							href="/contactos/<?php echo $_SESSION["nombreUsuario"] ?>">Contactos</a>
					</nav>
				</div>
			<?php } else if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true) { ?>
					<div class="nav-scroller bg-body shadow-sm d-flex justify-content-center collapse mb-4 mb-lg-5"
						id="sub_menu">
						<nav class="nav" aria-label="Secondary navigation">
							<a class="nav-link  admin-gestion-usuarios text-warning-emphasis" aria-current="page"
								href="/gestion/usuarios " >Usuarios</a>
							<a class="nav-link admin-gestion-dispositivos text-warning-emphasis" href="/gestion/dispositivos">
								Dispositivos
							</a>
							<a class="nav-link admin-upload text-warning-emphasis" href="/gestion/upload">Carga masiva</a>
						</nav>
					</div>
			<?php } ?>
		</div>
	</header>

	<!-- TOAST AVISO USUARIO SIN CUENTA -->
	<div class="toast-container position-fixed top-50 start-50 translate-middle p-3">
		<div id="alert_toast" class="toast " role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="3000"
			style="--bs-bg-opacity: .7; background-color: #fff3cf;">
			<div class="d-flex">
				<div class="toast-body">
					¡Lo siento! Necesitas tener una cuenta para eso .
				</div>
				<button type="button" class="btn-close text-dark me-2 m-auto" data-bs-dismiss="toast"
					aria-label="Close"></button>
			</div>
		</div>
	</div>

	<!-- TOAST AVISO USUARIO AÑADIDO CORRECTAMENTE (para "registro.php" y "gestion-usuarios.php") -->
	<div class="toast-container position-fixed top-50 start-50 translate-middle p-3">
		<div id="user_add_ok_toast" class="toast " role="alert" aria-live="assertive" aria-atomic="true"
			data-bs-delay="3000" style="--bs-bg-opacity: .7; background-color: #72ca47;">
			<div class="d-flex">
				<div class="toast-body">
					¡Usuario añadido correctamente!
				</div>
				<button type="button" class="btn-close text-dark me-2 m-auto" data-bs-dismiss="toast"
					aria-label="Close"></button>
			</div>
		</div>
	</div>

	<!-- TOAST AVISO USUARIO YA EXISTE (para "registro.php" y "gestion-usuarios.php") -->
	<div class="toast-container position-fixed top-50 start-50 translate-middle p-3">
		<div id="user_exists_toast" class="toast " role="alert" aria-live="assertive" aria-atomic="true"
			data-bs-delay="4000" style="--bs-bg-opacity: .7; background-color: #db2637;">
			<div class="d-flex">
				<div class="toast-body">
					¡El nombre de usuario introducido ya existe! Por favor, introduce otro usuario.
				</div>
				<button type="button" class="btn-close text-dark me-2 m-auto" data-bs-dismiss="toast"
					aria-label="Close"></button>
			</div>
		</div>
	</div>
	<!-- TOAST AVISO EMAIL YA EXISTE (para "registro.php" y "gestion-usuarios.php") -->
	<div class="toast-container position-fixed top-50 start-50 translate-middle p-3">
		<div id="email_exists_toast" class="toast " role="alert" aria-live="assertive" aria-atomic="true"
			data-bs-delay="3000" style="--bs-bg-opacity: .7; background-color: #db2637;">
			<div class="d-flex">
				<div class="toast-body">
					¡El email introducido ya esta registrado!
				</div>
				<button type="button" class="btn-close text-dark me-2 m-auto" data-bs-dismiss="toast"
					aria-label="Close"></button>
			</div>
		</div>
	</div>

	<!-- TOAST AVISO CONTACTO AÑADIDO CORRECTAMENTE -->
	<div class="toast-container position-fixed top-50 start-50 translate-middle p-3">
		<div id="contact_add_ok_toast" class="toast " role="alert" aria-live="assertive" aria-atomic="true"
			data-bs-delay="4000">
			<div class="d-flex">
				<div class="toast-body">
					¡Contacto añadido correctamente!
				</div>
			</div>
		</div>
	</div>

	<!-- TOAST AVISO RECOMEMDACION ENVIADA A CONTACTO CORRECTAMENTE  -->
	<div class="toast-container position-fixed top-50 start-50 translate-middle p-3">
		<div id="recomendar-contacto_ok_toast" class="toast " role="alert" aria-live="assertive" aria-atomic="true"
			data-bs-delay="3000">
			<div class="d-flex">
				<div class="toast-body">
					¡Recomendación enviada a tu contacto!
				</div>
			</div>
		</div>
	</div>

		<!-- TOAST AVISO RECOMENDACION GUARDADA -->
		<div class="toast-container position-fixed top-50 start-50 translate-middle p-3">
		<div id="recomendacion_guardada" class="toast " role="alert" aria-live="assertive" aria-atomic="true">
			<div class="d-flex">
				<div class="toast-body">
					¡Recomendación guardada como dispositivo favorito!
				</div>
			</div>
		</div>
	</div>

	<main>

<script>
	(() => {
		'use strict'
		document.querySelector('#navbarSideCollapse').addEventListener('click', () => {
		document.querySelector('.offcanvas-collapse').classList.toggle('open')
		})
	})()
</script>