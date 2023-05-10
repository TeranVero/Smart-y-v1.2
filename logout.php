<?php
/**
 * Fichero php que realiza el cierre de sesión del usuario
 * 
 * @author Verónica Terán Molina <vteran@ucm.es>
 */

	session_start();
	session_destroy();
	header("location:..");
?>
