<?php
/**
 * Fichero php para procesar la modificacion de la ficha del dispositivo
 * 
 * @author Verónica Terán Molina <vteran@ucm.es>
 */

include_once "dispositivo_controller.php";

$dispositivo_controller = new dispositivo_controller();
$directorio = '../public_html/galerias/';

if (!empty($_FILES['destacada']['name'])) {
	$_POST['destacada'] = $_FILES['destacada']['name'];
}
if (!empty($_FILES['galeria']['name'][0])) {
	$_POST['galeria'] = $_FILES['galeria']['name'];
}

if ($dispositivo_controller->modificarDispositivo($_GET['dispositivo'])) {
	if (!empty($_FILES['destacada']['name'])) {
		move_uploaded_file($_FILES["destacada"]["tmp_name"], $directorio . $_FILES["destacada"]["name"]);
		$cont = 0;
		while ($cont < count($_FILES["galeria"]["name"])) {
			move_uploaded_file($_FILES["galeria"]["tmp_name"][$cont], $directorio . $_FILES["galeria"]["name"][$cont]);
			$cont++;
		}
	} else {
	}
	echo 1;
} else {
	echo 0;
}

?>
