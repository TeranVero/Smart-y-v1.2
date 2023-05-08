<?php
/**
 * Fichero php para las funcionalidades relativas a los contactos
 * 
 * @author Verónica Terán Molina <vteran@ucm.es>
 */

include_once('usuarios_controller.php');
include_once('user_disp_controller.php');

//Se crea el controlador de los usuarios para las gestiones de la bbdd (todas las acciones relativas a la bbdd de usuarios se gestionan desde
//usuario_controller)
$usuarios_controller = new usuarios_controller();
$user_disp_controller = new user_disp_controller();

switch ($_POST["accion"]) {

  /**
   * Opción para añadir un contacto nuevo
   * 
   */
  case "añadir_contacto": {
      $contacto_id = $_POST["contacto_id"]; //Nuevo contacto
      $user_id = $_POST["user_id"]; //usuario que realiza la acción
      if ($usuarios_controller->existeContacto($user_id, $contacto_id)) {
        echo "El usuario ya es tu contacto";
      } else {
        $res = $usuarios_controller->añadirContacto($user_id, $contacto_id);
        echo $res;

      }
      break;
    }

  /**
   * Opción para eliminar un contacto
   */
  case "eliminar_contacto": {
      $contacto_id = $_POST["contacto_id"]; //contacto a eliminar
      $user_id = $_POST["user_id"]; //usuario que realiza la accion
      echo $usuarios_controller->eliminarContacto($user_id, $contacto_id);
      break;
    }

  /**
   * Opción que devuelve todos los contactos del usuario 'user_id'
   */
  case "obtener_contactos": {
      $user_id = $_POST["user_id"];
      $user_contactos = $usuarios_controller->obtenerContactos($user_id);

      if ($user_contactos->num_rows === 0) {
        echo "vacio";
      } else {
        echo '<div class="list-group list-group-radio mt-0 gap-2 border-0 w-75">';
        while ($contacto = $user_contactos->fetch_assoc()) {
          $row = $usuarios_controller->getUser_id($contacto["contacto_id"]);
          echo '<div class="position-relative usuarios">
					<input class="form-check-input position-absolute top-50 end-0 me-3 fs-5" type="radio" name="listGroupRadioGrid" id="' . $row['user_id'] . '" value="' . $row['nombreUsuario'] . '">
					<label class="list-group-item py-3 pe-5" for="' . $row['user_id'] . '">
					  <strong class="fw-semibold">' . $row['nombreUsuario'] . '</strong>
					    <span class="d-block small opacity-75">' . $row['nombre'] . ' ' . $row['apellidos'] . '</span>
					    <span class="d-block small opacity-50">' . $row['email'] . '</span>
					</label>
				  </div>';
        }
        echo '</div>';
      }
      break;
    }

  /**
   * Opción para recomendar el dispositivo 'disp_id' al usuario 'contacto_id', donde 'contacto_id' es un contacto del usuario.
   */  
  case "recomendar_contacto": {
      $contacto_id = $_POST["contacto_id"];
      $disp_id = $_POST["disp_id"];
      if (!$user_disp_controller->existeRecomendacion($contacto_id, $disp_id)) {
        echo $user_disp_controller->addRecomendacion($contacto_id, $disp_id);
      }
      break;
    }

  /**
	 * Opción para la búsqueda de contactos por texto/nombre
	 */
  case "buscar_contactos":{
    $texto = $_POST["nombre"];
    $user_id =$_POST["user_id"];
			$user_contactos = $usuarios_controller->buscarContacto($texto,$user_id);
			while ($contacto = $user_contactos->fetch_assoc()) {
        echo '<div class="col-sm-6 ">
            <div class="card user-card-full">
                <div class="row">
                    <div class="col-md-3  contact-profile">
                        <div class="card-block text-center text-white">
                            <div class="avatar_perfil m-auto">';
                                $img = $usuarios_controller->getAvatarUser($contacto["nombreUsuario"]);
                                echo '<img src="../public_html/galerias/'.$img.'" class="img-radius"
                                    alt="User-Profile-Image">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="card-body">
                            <h5 class="card-title">'
                               .$contacto["nombreUsuario"].
                           ' </h5>
                            <h6 class="card-text">'
                             . $contacto["nombre"].
                              $contacto["apellidos"].
                           '</h6>
                            <p class="card-text"><small class="text-muted">'
                                 . $contacto["email"].
                           ' </small></p>
                            <button type="button" class="eliminar-contacto"
                                id="'.$contacto["contacto_id"].'">Eliminar</button>

                        </div>
                    </div>
                </div>
            </div>
        </div>';
     }
  }

}
?>