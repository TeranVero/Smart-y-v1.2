<?php
/**
 * Controlador de los usuarios
 * 
 * @author Verónica Terán Molina <vteran@ucm.es>
 */
include_once(realpath(dirname(__FILE__, 2))) . "/Model/usuarios_model.php";

/**
 * Clase controlador para la gestion del modelo relativo a los usuarios
 */
class usuarios_controller
{

	/**
	 * Variable para acceder a la logica del modelo relativo a los usuarios
	 * @var usuarios_model $usuarios_model
	 * @access protected
	 */
	private $usuarios_model;
	/**
	 * Constructor de la clase controlador
	 * 
	 * Creamos el objeto $usuarios_model
	 */
	public function __construct()
	{
		$this->usuarios_model = new usuarios_model();
	}
	/**
	 * Alta usuario
	 * 
	 * Llama al modelo para añadir un usuario nuevo con los valores recibidos
	 * 
	 * @return bool
	 */
	function altaUsuario()
	{
		include_once(realpath(dirname(__FILE__, 2))) . "/Model/Usuario.php";
		$nombre = $_POST['nombre'];
		$apellidos = $_POST['apellidos'];
		$fecha = $_POST['fecha'];
		$nombreUsuario = $_POST['usuario'];
		$email = $_POST['email'];
		$pass = $_POST['password'];
		$ocupacion = $_POST['ocupacion'];
		$intereses = $_POST['interes'];
		$marcas = $_POST["marcas"];

		$obj_user=new Usuario($nombre,$apellidos,$email,$fecha,$nombreUsuario,$pass,$ocupacion,$intereses,$marcas);
		$data = $this->usuarios_model->altaUsuario($obj_user);

		return $data;
	}

	/**
	 * Eliminar usuario
	 * 
	 * Llama al modelo para eliminar el usuario de entrada
	 * 
	 * @param int $usuario identificador del usuario
	 * @return bool
	 */
	function eliminarUser($usuario)
	{
		$data = $this->usuarios_model->eliminarUser($usuario);
		return $data;
	}


	/**
	 * Existe nombre de usuario
	 * 
	 * Llama al modelo para comprobar si existe el usuario de entrada
	 * 
	 * @param string $usuario nombre de usuario del usuario
	 * @return bool
	 */
	function existeUsuario($usuario)
	{
		$data = $this->usuarios_model->existeUsuario($usuario);
		return $data;
	}

	/**
	 * Existe email
	 * 
	 * Llama al modelo para comprobar si existe el email de entrada
	 * 
	 * @param string $usuario email del usuario
	 * @return bool
	 */
	function existeEmail($usuario)
	{
		$data = $this->usuarios_model->existeEmail($usuario);
		return $data;
	}

	/**
	 * Llama al modelo para modificar la contraseña
	 * @return bool
	 */
	function modificarPass()
	{
		$nombreUsuario = $_POST['nombreUsuario'];
		$pass = $_POST['password'];
		$passhs = password_hash($pass, PASSWORD_BCRYPT);

		$data = $this->usuarios_model->modificarPass($pass, $passhs, $nombreUsuario);

		return $data;
	}

	/**
	 * Modificar datos
	 * 
	 * Llama al modelo para modificiar los datos del usuario de entrada con los valores recibidos
	 * 
	 * @param string $usuario nombre de usuario del usuario
	 * @return bool
	 */
	function modificarDatos($usuario)
	{
		$nombre = $_POST['nombre'];
		$apellidos = $_POST['apellidos'];
		$fecha = $_POST['fecha'];
		$ocupacion = $_POST['ocupacion'];
		$intereses = $_POST['interes'];
		$marcas = $_POST["marcas"];
		$user_id = $_POST['user_id'];
		if (isset($_POST["avatar"])) {
			$avatar = $_POST["avatar"];
		} else {
			$avatar = "";
		}
		$data = $this->usuarios_model->modificarDatos($user_id, $nombre, $apellidos, $fecha, $ocupacion, $intereses, $marcas, $avatar);
		return $data;
	}


	/**
	 * Obtener usurario
	 * 
	 * Llama al modelo para obtener la informacion el usuario 'usuario' de entrada
	 * 
	 * @param string $usuario nombre de usuario
	 * @return array array asociativo con la informacion del usuario
	 */
	function getUser($usuario)
	{
		$data = $this->usuarios_model->getUser($usuario);
		return $data;
	}

	/**
	 * Obtener usuario por id
	 * 
	 * Llama al modelo para obtener la informacion del usuario por el identificador de entrada
	 * 
	 * @param int $user_id identificador del usuario
	 * @return bool
	 */
	function getUser_id($user_id)
	{
		$data = $this->usuarios_model->getUser_id($user_id);
		return $data;
	}

	/**
	 * Obtener resto de usuarios
	 * 
	 * Llama al modelo para obtener el listado de usuarios excepto el usuario 'user_id'
	 * 
	 * @param mixed $user_id identificador del usuario
	 * @return bool|mysqli_result	array asociativo con el listado de usuarios
	 */
	function getRestoUsers($user_id)
	{
		$data = $this->usuarios_model->getRestoUsers($user_id);
		return $data;
	}

	/**
	 * Llama al modelo para obtener todos los usuarios
	 * 
	 * @return bool|mysqli_result array asociativo con el listado de usuarios.
	 */
	function getAllUsers()
	{
		$data = $this->usuarios_model->getAllUsers();
		return $data;
	}

	/**
	 * Buscar usuario
	 * 
	 * Llama al modelo para obtener la informacion del usuario de entrada
	 * 
	 * @param string $texto nombre de usuario del usuario
	 * @return bool|mysqli_result array asociativo con el listado de usuarios
	 */
	function buscarUser($texto)
	{
		$data = $this->usuarios_model->buscarUser($texto);

		return $data;

	}

	/**
	 * Obtener intereses
	 * 
	 * Llama al modelo para obtener los intereses del usuario 'user_id' de entrada
	 * 
	 * @param int $user_id identificador del usuario
	 * @return bool|mysqli_result array asociativo con el listado de intereses del usuario
	 */
	function getInteresesUser($user_id)
	{

		$data = $this->usuarios_model->getInteresesUser($user_id);
		return $data;
	}

	/**
	 * Obtener marcas
	 * 
	 * Llama al modelo para obtener las marcas del usuario 'user_id' de entrada
	 * 
	 * @param int $user_id identificador del usuario
	 * @return bool|mysqli_result  array asociativo con el listado de marcas del usuario
	 */
	function getMarcasUser($user_id)
	{

		$data = $this->usuarios_model->getMarcasUser($user_id);

		return $data;
	}

	/**
	 * Obtener ocupacion del usuario de entrada
	 * 
	 * Llama al modelo para obtener la ocupacion del usuario 'user_id' de entrada
	 * 
	 * @param int $user_id identificador del usuario
	 * @return bool|mysqli_result  array asociativo con la ocupacion del usuario
	 */
	function getOcupacionUser($user_id)
	{

		$data = $this->usuarios_model->getOcupacionUser($user_id);

		return $data;
	}

	/**
	 * Obtener avatar
	 * 
	 * Llama al modelo para obtener la imagen del perfil del usuario 'usuario' de entrada
	 * @param string $usuario nombre de usuario del usuario
	 * @return string nombre del archivo
	 */
	function getAvatarUser($usuario)
	{
		$data = $this->usuarios_model->getAvatarUser($usuario);
		return $data;
	}

	/**
	 * Obtener listado de marcas
	 * 
	 * Llama al modelo para obtener el listado de marcas disponibles para seleccionar por los usuarios
	 * 
	 * @return bool|mysqli_result  array asociativo con el listado de marcas
	 */
	public function getListadoMarcas()
	{
		return $this->usuarios_model->getListadoMarcas();
	}
	/**
	 * Obtener ocupaciones
	 * 
	 * Llama al modelo para obtener el listado de ocupaciones disponibles para seleccionar por los usuarios
	 * 
	 * @return bool|mysqli_result  array asociativo con el listado de ocupaciones
	 */
	public function getListadoOcupaciones()
	{
		return $this->usuarios_model->getListadoOcupaciones();
	}
	/**
	 * Obtener intereses
	 * 
	 * Llama al modelo para obtener el listado de intereses disponibles para seleccionar por los usuarios
	 * 
	 * @return bool|mysqli_result  array asociativo con el listado de intereses
	 */
	public function getListadoIntereses()
	{
		return $this->usuarios_model->getListadoIntereses();
	}
	/**
	 * Obtener interes
	 * 
	 * Llama al modelo para obtener el interes 'interes_id' de entrada
	 * 
	 * @param int $interes_id identificador del interes
	 * @return bool|mysqli_result  array asociarivo con la informacion del interes
	 */
	public function getInteres($interes_id)
	{
		return $this->usuarios_model->getInteres($interes_id);
	}
	/**
	 * Obtener marca
	 * 
	 * Llama al modelo para obtener la marca 'marca_id' de entrada
	 * 
	 * @param int $marca_id identificador de la marca
	 * @return bool|mysqli_result  array asociativo con la informacion de la marca
	 */
	public function getMarca($marca_id)
	{
		return $this->usuarios_model->getMarca($marca_id);
	}

	

	/**
	 * Añadir contacto
	 * 
	 * Llama al modelo para añadir al usuario 'contacto_id' como contacto del usuario 'user_id'
	 * 
	 * @param int $user_id identificador del usuario 
	 * @param int $contacto_id identificador del usuario contacto
	 * @return bool
	 */
	public function añadirContacto($user_id, $contacto_id)
	{
		return $this->usuarios_model->añadirContacto($user_id, $contacto_id);
	}

	/**
	 * Eliminar contacto
	 * 
	 * Llama al modelo para eliminar el usuario 'contacto_id' de los contactos del usuario 'user_id' de entrada
	 * 
	 * @param int $user_id identificador del usuario
	 * @param int $contacto_id identificador del usuario contacto
	 * @return bool
	 */
	public function eliminarContacto($user_id, $contacto_id)
	{
		return $this->usuarios_model->eliminarContacto($user_id, $contacto_id);
	}

	/**
	 * Obtener contactos
	 * 
	 * Llama al modelo para obtener los contactos del usuario 'user_id' de entrada
	 * 
	 * @param int $user_id identificador del usuario
	 * @return bool|mysqli_result  array asociativo del listado de contactos
	 */
	public function obtenerContactos($user_id)
	{
		return $this->usuarios_model->obtenerContactos($user_id);
	}

	/**
	 * Existe contacto
	 * 
	 * Llama al modelo para comprobar si el usuario 'contacto_id' es un contacto del usuario 'user_id' de entrada
	 * @param int $user_id identificador del usuario
	 * @param int $contacto_id identificador del usuario contacto
	 * @return bool
	 */
	public function existeContacto($user_id, $contacto_id)
	{
		return $this->usuarios_model->existeContacto($user_id, $contacto_id);
	}

	/**
	 * Buscar contacto
	 * 
	 * Llama al modelo buscar el contato con nombre de usuario 'texto' en la red de contactos del usuario 'user_id'
	 * @param int $user_id identificador del usuario
	 * @param int $texto nombre del contacto
	 * @return bool|mysqli_result  array asociativo del listado de contactos
	 */
	public function buscarContacto($texto, $user_id)
	{
		return $this->usuarios_model->buscarContacto($texto,$user_id);
	}

	/**
	 * Procesar cabecera
	 * 
	 * Actualiza la cabecera del menu segun la sesion del usuario
	 * 
	 * @return void
	 */
	function procesaUsuario()
	{
		if (!isset($_SESSION["login"]) || $_SESSION["login"] == false) {
			echo '
			<li class="nav-item d-flex justify-content-center">
			<button type="button" class=" btn btn-warning me-2"><a href="/login" class="nav-link link-dark p-0 .text-warning-emphasis">Acceso</a></button>
			<button type="button" class=" btn btn-primary me-2"><a href="/registro" class="nav-link link-dark p-0 text-light">Registrate</a></button>
			</li>
			';
		} else {
			if (isset($_SESSION["isUser"]) && ($_SESSION["isUser"] == true)) {
				echo '<li class="dropdown text-end ">
          <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="../public_html/galerias/' . $this->getAvatarUser($_SESSION["nombreUsuario"]) . '" alt="mdo" width="40" height="40" class="rounded-circle avatar">
          </a>
          <ul class="dropdown-menu dropdown-menu-lg-end shadow" style="">
		  <li><a class="dropdown-item perfil"  href="/perfil/' . $_SESSION["nombreUsuario"] . '"  >Cuenta</a></li>
		  <li><hr class="dropdown-divider"></li>
		  <li><div class="d-flex"><a class="dropdown-item" href="../logout">Salir<img src="../assets/img/cerrar-sesion.png" alt="mdo" width="20" height="20" class="m-auto"></a></div></li>
			  
          </ul>
			</li>';
			} else {
				echo '
				<li class="nav-item dropdown">
					<a href="#" class="nav-link dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside" aria-expanded="false">
						<strong>Bienvenido, Admin </strong><img src="../assets/img/perfil.png" alt="mdo" width="32" height="32" class="rounded-circle">
					</a>
			  		<ul class="dropdown-menu dropdown-menu-lg-end shadow" aria-labelledby="dropdownUser2" style="">
					  	<li><h6 class="dropdown-header">Configuración</h6></li>
						<li><a class="dropdown-item usuarios" href="/admin/usuarios">Usuarios</a></li>
						<li><a class="dropdown-item dispositivos" href="/admin/dispositivos">Dispositivos</a></li>
						<li><a class="dropdown-item upload" href="/admin/upload">Carga masiva</a></li>
						<li><hr class="dropdown-divider"></li>
						<li><div class="d-flex"><a class="dropdown-item" href="../logout">Salir<img src="../assets/img/cerrar-sesion.png" alt="mdo" width="20" height="20" class="m-auto"></a></div></li>
			  		</ul>
				</li>';
			}
		}
	}
}





?>