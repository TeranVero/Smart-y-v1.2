<?php
/**
 * Fichero php para procesar el registro de usuarios
 * 
 * @author Verónica Terán Molina <vteran@ucm.es>
 */

require '../init.php';
require_once("usuarios_controller.php");
$usuarios_controller = new usuarios_controller();

if (!$usuarios_controller->existeUsuario($_POST["usuario"])) {
	if (!$usuarios_controller->existeEmail($_POST["email"])) {
		if ($usuarios_controller->altaUsuario()) {
			//Si el alta ha sido correcta, inicializamos la variable global de sesion
			if (empty($_SESSION)) {
				$_SESSION["login"] = true;
				$_SESSION["nombre"] = $_POST['nombre'];
				$_SESSION["apellidos"] = $_POST['apellidos'];
				$_SESSION["fecha"] = $_POST['fecha'];
				$_SESSION["nombreUsuario"] = $_POST['usuario'];
				$_SESSION["email"] = $_POST['email'];
				$_SESSION["isUser"] = true;
				$_SESSION["user_id"] = $usuarios_controller->getUser($_POST['usuario'])["user_id"];
			}
			echo "1";
		}
	} else {
		echo "correo";
	}
} else {
	echo "user";
}