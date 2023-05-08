<?php
/**
 * Fichero php para procesar el cambio de contraseña
 * 
 * @author Verónica Terán Molina <vteran@ucm.es>
 */

require '../init.php';
require_once("usuarios_controller.php");

$usuarios_controler = new usuarios_controller();

if ($usuarios_controler->modificarPass()) {
	return header('Location: ../login');

}


?>