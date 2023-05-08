<?php
/**
 * Fichero php para las funcionalidades relativas a los dispositivos del usuario
 * 
 * @author Verónica Terán Molina <vteran@ucm.es>
 */

include_once(realpath(dirname(__FILE__, 2))) . '/Controller/user_disp_controller.php';
include_once(realpath(dirname(__FILE__, 2))) . "/Controller/usuarios_controller.php";
include_once(realpath(dirname(__FILE__, 2))) . "/Controller/dispositivo_controller.php";


$user_disp_controller = new user_disp_controller();
$dispositivo_controller = new dispositivo_controller();
$usuarios_controler = new usuarios_controller();
$directorio = '../public_html/galerias/';

if (isset($_POST["accion"])) {
  switch ($_POST["accion"]) {

    /**
     * Opción mostrar dispositivos favoritos del usuario 'user'
     */
    case 'mostrar_favs':
      $disp_array = $user_disp_controller->getFav($_POST['user']);

      while ($d = $disp_array->fetch_assoc()) {
        $disp = $dispositivo_controller->getDisp($d['disp_id']);
        $imagen = $dispositivo_controller->getDestacada($d["disp_id"]);
        include('../templates/search.php');
      }
      break;

    /**
     * Opcion mostrar los dispositivos usados del usuario 'user' 
     */
    case 'mostrar_usados':
      $disp_array = $user_disp_controller->getUsed($_POST['user']);

      while ($d = $disp_array->fetch_assoc()) {
        $disp = $dispositivo_controller->getDisp($d['disp_id']);
        $imagen = $dispositivo_controller->getDestacada($d["disp_id"]);
        include('../templates/search.php');
      }
      break;

    /**
     * Opcion para añadir el dispositivo 'disp' como favorito del usuario 'user'
     */
    case 'fav': {
        if (isset($_POST['user']) && isset($_POST['disp'])) {
          $user = $_POST['user'];
          $disp = $_POST['disp'];
          $user_disp_controller->checkFav($user, $disp);
        }
        break;
      }
    /**
     * Opcion para añadir el dispositivo 'disp' como usado del usuario 'user'
     */
    case 'use': {
        if (isset($_POST['user']) && isset($_POST['disp'])) {
          $user = $_POST['user'];
          $disp = $_POST['disp'];
          $user_disp_controller->checkUse($user, $disp);
        }
        break;
      }
    /**
     * Opcion para añadir el dispositivo 'disp' como no recomendados del usuario 'user'
     */
    case 'dislike': {
        if (isset($_POST['user']) && isset($_POST['disp'])) {
          $user = $_POST['user'];
          $disp = $_POST['disp'];
          $user_disp_controller->checkDislike($user, $disp);

        }
        break;

      }
    case 'favoritos': {
        echo var_dump($user_disp_controller->getFav($_POST['user']));
        break;
      }

    /**
     * Opción para eliminar el dispositivo 'disp' del listado de recomendaciones del usuario 'user'
     */
    case "eliminar_recomendacion": {
        if (isset($_POST['user']) && isset($_POST['disp'])) {
          $user = $_POST['user'];
          $disp = $_POST['disp'];
          echo $user_disp_controller->deteleRecomendacion($user, $disp);
        }
        break;
      }

    case "guardar_recomendacion":{
      if (isset($_POST['user']) && isset($_POST['disp'])) {
        $user = $_POST['user'];
        $disp = $_POST['disp'];
      /* Cuando el usuario 'user' acepta la recomendacion, el dispositivo se registra como favorito
      del usuario
			*/
        echo $user_disp_controller->addFav($user,$disp);
        echo $user_disp_controller->deteleRecomendacion($user, $disp);
      }
      break;
    }
  }

}