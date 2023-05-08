<?php
/**
 * Fichero php para procesar el login de usuarios
 * 
 * @author Verónica Terán Molina <vteran@ucm.es>
 */
require '../init.php';
require_once("usuarios_controller.php");

$usuarios_controler = new usuarios_controller();
$pass = $_POST["password"];
$usuario = $_POST["usuario"];

$_SESSION["login"] = false;

if ($usuarios_controler->existeUsuario($usuario)) {
	$_SESSION["login"] = true;
	$user = $usuarios_controler->getUser($usuario);

	//Inicializamos la variable globlal de sesion
	$_SESSION["user_id"] = $user["user_id"];
	$_SESSION["nombreUsuario"] = $user['nombreUsuario'];
	$_SESSION["email"] = $user['email'];

	if (password_verify($pass, $user["contrasena"])) {
		if ($user["admin"] == 1) {
			$_SESSION["isAdmin"] = true;
			$_SESSION["isUser"] = false;

		} else {
			$_SESSION["isUser"] = true;
			$_SESSION["isAdmin"] = false;
		}
		echo "<script>history.back();</script>";
	} else {
		echo "* ¡Contraseña incorrecta!";
		$_SESSION["login"] = false;
		unset($_SESSION["login"]);
	}
} else {
	echo "* ¡El nombre de usuario introducido no existe!";
	unset($_SESSION["login"]);
}

?>