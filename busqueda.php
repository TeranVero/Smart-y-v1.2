<?php
/**
 * Fichero php que implementa la vista de busqueda de dispositivos
 * 
 * @author Verónica Terán Molina <vteran@ucm.es>
 */

include_once "Controller/dispositivo_controller.php";
include_once "Controller/mis_dispositivos_recomendaciones_controller.php";
include_once('header.php');


$dispositivo_controller = new dispositivo_controller();
$directorio = '../public_html/galerias/';
$texto_tootip = "texto";
$disp = $_GET["nombre"];
$disp_array = $dispositivo_controller->buscarDisp($disp);

?>
<div class="container  px-4 p-md-0 ">
	<div class="row">
		<div class="num_resultados p-2">
			<span><strong><?php echo $disp_array->num_rows; ?></strong> resultados encontrados</span>
		</div>
	</div>

	<div id='disp busqueda' class="row resultados px-md-5 pd-3">
		<?php while ($disp = $disp_array->fetch_assoc()) {
			
			$imagen = $dispositivo_controller->getDestacada($disp["disp_id"]);
			include('templates/search.php');
		}
		?>
	</div>

</div>

<?php
include_once("footer.php"); ?>