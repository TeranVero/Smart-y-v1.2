<?php
/**
 * Fichero php que implementa la vista para las recomendaciones encontradas por el asistente de la pagina de inicio
 * 
 * @author Verónica Terán Molina <vteran@ucm.es>
 */

require_once("Controller/user_disp_controller.php");
require_once("Controller/dispositivo_controller.php");
include_once('header.php');


$array_disp = explode(',', $_REQUEST["id"]);
$directorio = '../public_html/galerias/';
$texto_tootip = "";
$user_disp_controller = new user_disp_controller();
$dispositivo_controller = new dispositivo_controller();
?>


<div class="container   ">
	<div class="row">
		<div class="title my-3">
			<h4>¡Este es el resultado que Smart-y ha encontrado para ti!</h4>
			<p>Guarda en favoritos los dispositivos que prefieras si no quieres perderlos, ¡asi podrás verlo siempre que
				quieras entrando en <strong>Mis dispositivos</strong>!
			</p>
			<img src="../assets/img/flecha_abajo.png" width="45">

		</div>
	</div>
	<div id='disp recomendacion' class="row resultados">
		<?php
		foreach ($array_disp as $disp_id) {
			$disp = $dispositivo_controller->getDisp($disp_id);
			$imagen = $dispositivo_controller->getDestacada($disp["disp_id"]);
			include("templates/search.php");
		}
		?>
	</div>
</div>



<?php include_once("footer.php");?>