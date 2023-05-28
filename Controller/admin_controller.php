<?php
/**
 * Fichero php para las funcionalidades realizadas por parte del usuario admin
 * 
 * @author Verónica Terán Molina <vteran@ucm.es>
 */


include('../init.php');
include_once('dispositivo_controller.php');
include_once('usuarios_controller.php');


/**
 * Declaramos los controladores que controlan los modelos de "usuarios" y "dispositivos"
 */
$dispositivo_controller = new dispositivo_controller();
$usuarios_controller = new usuarios_controller();

switch ($_POST["accion"]) {

	/**
	 * Opción para la búsqueda de usuarios por texto/nombre
	 */
	case "buscar_usuario": {
			$texto = $_POST["nombre"];
			$usuarios = $usuarios_controller->buscarUser($texto);
			echo '<div class="list-group list-group-radio mt-0 gap-2 border-0 ">';
			while ($row = $usuarios->fetch_assoc()) {
				if ($row["user_id"] != $_SESSION["user_id"] && $row["admin"] != 1) {
					echo '<div class="position-relative usuarios">
					<input class="form-check-input position-absolute top-50 end-0 me-3 fs-5" type="radio" name="listGroupRadioGrid" id="' . $row['user_id'] . '" value="' . $row['nombreUsuario'] . '">
					<label class="list-group-item py-3 pe-5" for="' . $row['user_id'] . '">
					  <strong class="fw-semibold">' . $row['nombreUsuario'] . '</strong>
					    <span class="d-block small opacity-75">' . $row['nombre'] . ' ' . $row['apellidos'] . '</span>
					    <span class="d-block small opacity-50">' . $row['email'] . '</span>
					</label>
				  </div>';
				}
			}
			echo '</div>';
			break;
		}

	/**
	 * Opción que elimina el usuario seleccionado
	 */
	case "eliminar_usuario": {
			$nombreUsuario = $_POST["nombreUsuario"];
			$usuarios_controller->eliminarUser($nombreUsuario);
			break;
		}

	/**
	 * Opción para la búsqueda de dispositivos por nombre del modelo
	 */
	case "buscar_disp": {
			$directorio = '../public_html/galerias/';
			$texto = $_POST["texto"];
			$disp = $dispositivo_controller->buscarDisp($texto);
			while ($row = $disp->fetch_assoc()) {
				$imagen = $dispositivo_controller->getDestacada($row["disp_id"]); //Obtenemos la imagen destacada del dispositivo

				echo "<div class='col-md-4 col-8 mb-3 p-md-4'>
			<button  id='result-disp' class='col-12 p-0 disp rounded justify-content-center ' value=" . $row['disp_id'] . " id=" . $row['disp_id'] . ">
			<div class='p-3 d-flex flex-column align-items-center'>";
				if ($imagen != NULL) {
					echo "<img class='p-3' src='../public_html/galerias/" . $imagen['imagen'] . "' height='70' width='70'>";
				}
				echo '<p>' . $row["nombre"] . '</p>
			<p>' . $row["ram"] . ' GB <img src="../assets/img/separador.png" height="10" width="10"> ' . $row["memoria_interna"] . ' GB</p>
			</div>
			</button></div>';
			}
			break;
		}

	/**
	 * Opción para eliminar el dispositivo seleccionado
	 */	
	case "eliminar_disp": {
			$disp = $_POST["disp_id"];
			$dispositivo_controller->eliminarDispositivo($disp);
			break;
		}

	

	/**
	 * Opción que gestiona la carga de las imagenes de forma masiva.
	 */	
	case "carga_masiva_img": {
			echo var_dump($_FILES);
		}
}