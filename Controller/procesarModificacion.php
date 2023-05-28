<?php
/**
 * Fichero php para procesar la modificacion de los datos del perfil del usuario
 * 
 * @author Verónica Terán Molina <vteran@ucm.es>
 */

require '../init.php';
require_once("usuarios_controller.php");

$usuarios_controler = new usuarios_controller();
$directorio = '../public_html/galerias/';


if (!empty($_POST["file_json"])) {
	//Decodificamos el string y obtenemos la imagen en base64
	$parts = explode(";base64,", $_POST["file_json"]);
	$strblob = base64_decode($parts[1]);

	//Creamos la nueva ruta
	$uuid = uniqid();
	$pathfile = $directorio . $uuid . ".png";
	$_POST["avatar"] = $uuid . ".png";

	//Guardamos el archivo final recortado en la nueva ruta
	file_put_contents($pathfile, $strblob);
}

$usuario=$_GET['usuario'];
if ($usuarios_controler->modificarDatos($usuario)) {
	if ($_SESSION["isUser"]) {
		$_SESSION["intereses"] = $_POST['interes'];
		$_SESSION["login"] = true;
		$_SESSION["nombre"] = $_POST['nombre'];
		$_SESSION["apellidos"] = $_POST['apellidos'];
		$_SESSION["fecha"] = $_POST['fecha'];
		// return header('Location: ../perfil/' . $usuario . '');
		echo 1;
	} else {
		// return header('Location: ../gestion/usuarios');
		echo 2;
	}
}else{
	echo 0;
}
