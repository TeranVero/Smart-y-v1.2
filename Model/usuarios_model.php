<?php
/**
 * Modelo donde se define la logica para gestionar las bbdd relativas a usuarios
 * 
 * @author Verónica Terán Molina <vteran@ucm.es>
 */

require_once "configBD.php";
include_once 'recomendador.php';

/**
 * Clase del modelo
 * 
 * Hereda la conexion a la base de datos desde la clase configBD
 */
class usuarios_model extends configBD
{
	/**
	 * Alta usuario
	 * 
	 * Inserta un nuevo usuario con los valores de entrada
	 * @param Usuario $obj_user
	 * @return bool|mysqli_result
	 */
	function altaUsuario($obj_user)
	{
		$pass = password_hash($obj_user->getPass(), PASSWORD_BCRYPT);

		$query = sprintf("INSERT INTO usuarios (nombre, apellidos, fecha, nombreUsuario, email, contrasena, ocupacion) VALUES ('%s','%s', '%s', '%s', '%s', '%s', '%s')", $this->BD->real_escape_string($obj_user->getNombre()), $this->BD->real_escape_string($obj_user->getApellidos()), $this->BD->real_escape_string($obj_user->getFecha()), $this->BD->real_escape_string($obj_user->getNombreUsuario()), $this->BD->real_escape_string($obj_user->getEmail()), $this->BD->real_escape_string($pass), $this->BD->real_escape_string($obj_user->getOcupacion()));
		$data = $this->BD->query($query) or die($this->BD->error . " en la línea " . (__LINE__ - 1));

		$user_id = mysqli_insert_id($this->BD);

		//Inserta la relacion entre el usuario y los intereses y marcas seleccionados
		if ($data) {
			foreach ($obj_user->getIntereses() as $interes_id) {
				$query = sprintf("INSERT INTO user_intereses (user_id, interes_id) VALUES ('%u','%u')", $this->BD->real_escape_string($user_id), $this->BD->real_escape_string($interes_id));
				$data = $this->BD->query($query) or die($this->BD->error . " en la línea " . (__LINE__ - 1));
			}
			foreach ($obj_user->getMarcas() as $marca_id) {
				$query = sprintf("INSERT INTO user_marcas (user_id, marca_id) VALUES ('%u','%u')", $this->BD->real_escape_string($user_id), $this->BD->real_escape_string($marca_id));
				$data = $this->BD->query($query) or die($this->BD->error . " en la línea " . (__LINE__ - 1));
			}

			//Ejecutamos la recomendacion de dispositivos favoritos de los usuarios cercanos de manera
			//asincrona
			//Ejecutamos la recomendacion de dispositivos favoritos de los usuarios cercanos de manera
			//asincrona
			// $pid = pcntl_fork();
			// if ($pid == -1) {
			// 	die("Error al crear proceso hijo");
			// } else if ($pid) {
			// } else {
				$recomendador = new Recomendador();
				$recomendador->recomendador_por_usuarios($user_id, 0, "add");
			//}

		} else
			return false;


		return $data;
	}

	/**
	 * Eliminar usuario
	 * 
	 * @param string $usuario nombre de usuarios del usuario
	 * @return bool|mysqli_result
	 */
	function eliminarUser($usuario)
	{
		$query = "DELETE FROM usuarios WHERE nombreUsuario = '$usuario'";
		$data = $this->BD->query($query) or die($this->BD->error . " en la línea " . (__LINE__ - 1));
		return $data;
	}


	/**
	 * Existe nombre de usuario
	 * 
	 * Comprueba si existe el mismo nombre de usuario del usuario de entrada
	 * 
	 * @param string $usuario nombre de usuario del usuario
	 * @return bool
	 */
	function existeUsuario($usuario)
	{

		$query = "SELECT nombreUsuario FROM usuarios WHERE BINARY nombreUsuario='$usuario'";
		$data = $this->BD->query($query) or die($this->BD->error . " en la línea " . (__LINE__ - 1));

		if ($data->fetch_assoc())
			return true;
		else
			return false;
	}

	/**
	 * Existe email
	 * 
	 * Comprueba si existe el email
	 * 
	 * @param string $email
	 * @return bool
	 */
	function existeEmail($email)
	{

		$query = "SELECT email FROM usuarios WHERE BINARY email='$email'";
		$data = $this->BD->query($query) or die($this->BD->error . " en la línea " . (__LINE__ - 1));

		if ($data->fetch_assoc())
			return true;
		else
			return false;
	}

	/**
	 * Modificar contraseña
	 * 
	 * Modifica la contraseña de usuario 'user_id' de entrada
	 * 
	 * @param string $pass
	 * @param string $passhs contraseña hash
	 * @param string $user_id identificador del usuario
	 * @return bool|mysqli_result
	 */
	function modificarPass($pass, $passhs, $nombreUsuario)
	{

		$query = sprintf("UPDATE usuarios SET contrasena = '%s' WHERE nombreUsuario = '$nombreUsuario'", $this->BD->real_escape_string($passhs));

		$data = $this->BD->query($query) or die($this->BD->error . " en la línea " . (__LINE__ - 1));

		return $data;
	}

	/**
	 * Modificar datos
	 * 
	 * Modifica los datos del usuario 'user_id' por los datos de entrada
	 * @param int $user_id
	 * @param string $nombre
	 * @param string $apellidos
	 * @param string $fecha
	 * @param string $ocupacion
	 * @param string $intereses
	 * @param string $marcas
	 * @param string $avatar
	 * @return bool|mysqli_result
	 */
	function modificarDatos($user_id, $nombre, $apellidos, $fecha, $ocupacion, $intereses, $marcas, $avatar)
	{
		$query = sprintf("UPDATE usuarios SET nombre = '%s', apellidos ='%s', fecha = '%s', ocupacion = '%s' WHERE user_id = '$user_id'", $this->BD->real_escape_string($nombre), $this->BD->real_escape_string($apellidos), $this->BD->real_escape_string($fecha), $this->BD->real_escape_string($ocupacion));
		$data = $this->BD->query($query) or die($this->BD->error . " en la línea " . (__LINE__ - 1));

		if ($data) {

			if (!empty($avatar)) {

				$query1 = sprintf("UPDATE usuarios SET avatar= '%s' where user_id = '$user_id'", $this->BD->real_escape_string($avatar));
				$data = $this->BD->query($query1) or die($this->BD->error . " en la línea " . (__LINE__ - 1));
			}

			$query = sprintf("DELETE FROM user_intereses WHERE user_id=$user_id");
			$data = $this->BD->query($query) or die($this->BD->error . " en la línea " . (__LINE__ - 1));

			$query = sprintf("DELETE FROM user_marcas WHERE user_id=$user_id");
			$data = $this->BD->query($query) or die($this->BD->error . " en la línea " . (__LINE__ - 1));

			foreach ($intereses as $interes_id) {
				$query = sprintf("INSERT INTO user_intereses (user_id, interes_id) VALUES ('%u','%u')", $this->BD->real_escape_string($user_id), $this->BD->real_escape_string($interes_id));
				$data = $this->BD->query($query) or die($this->BD->error . " en la línea " . (__LINE__ - 1));
			}
			foreach ($marcas as $marca_id) {
				$query = sprintf("INSERT INTO user_marcas (user_id, marca_id) VALUES ('%u','%u')", $this->BD->real_escape_string($user_id), $this->BD->real_escape_string($marca_id));
				$data = $this->BD->query($query) or die($this->BD->error . " en la línea " . (__LINE__ - 1));
			}

			//Ejecutamos la recomendacion de dispositivos favoritos de los usuarios cercanos de manera
			//asincrona
			// $pid = pcntl_fork();
			// if ($pid == -1) {
			// 	die("Error al crear proceso hijo");
			// } else if ($pid) {
			// } else {
				$recomendador = new Recomendador();
				$recomendador->recomendador_por_usuarios($user_id, 0, "add");
			//}
		} else {
			return false;
		}
		return $data;
	}

	/**
	 * Obtener usuario
	 * 
	 * Devuelve los datos del usuario de entrada 'usuario'
	 * @param string $usuario nombre de usuario del usuario
	 * @return array|bool|null array asociativo con los campos de la consulta
	 */
	function getUser($usuario)
	{

		$query = "SELECT * FROM usuarios WHERE nombreUsuario = '$usuario'";
		$perfil = $this->BD->query($query) or die($this->BD->error . " en la línea " . (__LINE__ - 1));

		return $perfil->fetch_assoc();
	}
	/**
	 * Obtener usuario por id
	 * 
	 * Devuelve los datos del usuario de entrada 'user_id'
	 * @param int $user_id identificador del usuario
	 * @return array|bool|null array asociativo con los campos de la consulta
	 */
	function getUser_id($user_id)
	{

		$query = "SELECT * FROM usuarios WHERE user_id = '$user_id'";
		$perfil = $this->BD->query($query) or die($this->BD->error . " en la línea " . (__LINE__ - 1));

		return $perfil->fetch_assoc();
	}

	/**
	 * Buscar usuario
	 * 
	 * Devuelve el o los usuarios que tengan el nombre de usuario 'texto' de entrada
	 * @param string $texto texto a comparar con el nombre de usuario
	 * @return bool|mysqli_result array asociativo con el listado de usuarios
	 */
	function buscarUser($texto)
	{

		$query = "SELECT * FROM usuarios where nombreUsuario like '%" . $texto . "%' ";

		$usuarios = $this->BD->query($query) or die($this->BD->error . " en la línea " . (__LINE__ - 1));

		return $usuarios;
	}

	/**
	 * Obtener resto de usuarios
	 * 
	 * Devuelve todos los usuarios excepto el usuario de entrada 'user_id'
	 * @param int $user_id identificador del usuario
	 * @return bool|mysqli_result array asociativo con el listado de usuarios
	 */
	function getRestoUsers($user_id)
	{
		$query = "SELECT * FROM usuarios where user_id!=$user_id";
		$usuarios = $this->BD->query($query) or die($this->BD->error . " en la línea " . (__LINE__ - 1));

		return $usuarios;
	}

	/**
	 * Obtener todos los usuarios
	 * 
	 * @return bool|mysqli_result array asociatuvo con el listado de usuarios
	 */
	function getAllUsers()
	{
		$query = "SELECT * FROM usuarios";

		$usuarios = $this->BD->query($query) or die($this->BD->error . " en la línea " . (__LINE__ - 1));

		return $usuarios;
	}

	/**
	 * Obtener intereses de usuario
	 * 
	 * Devuelve los intereses del usuario 'user_id' de entrada
	 * 
	 * @param int $user_id identificador del usuario
	 * @return bool|mysqli_result array asociativo con el listado de intereses
	 */
	function getInteresesUser($user_id)
	{

		$query = "SELECT * FROM user_intereses WHERE user_id = '$user_id'";
		$query = $this->BD->query($query) or die($this->BD->error . " en la línea " . (__LINE__ - 1));

		return $query;
	}

	/**
	 * Obtener marcas de usuario
	 * 
	 * Devuelve las marcas del usuario 'user_id' de entrada
	 * 
	 * @param int $user_id identificador del usuario
	 * @return bool|mysqli_result array asociativo con el listado de marcas
	 */
	function getMarcasUser($user_id)
	{

		$query = "SELECT marca_id FROM user_marcas WHERE user_id = '$user_id'";
		$query = $this->BD->query($query) or die($this->BD->error . " en la línea " . (__LINE__ - 1));

		return $query;
	}


	/**
	 * Obtener avatar
	 * 
	 * Devuelve la imagen del perfil del usuario de entrada 'usuario'
	 * 
	 * @param string $usuario nombre de usuario
	 * @return string nombre de la imagen
	 */
	function getAvatarUser($usuario)
	{
		$img = "rg";

		$query = "SELECT usuarios.avatar FROM usuarios WHERE nombreUsuario = '$usuario'";
		$data = $this->BD->query($query) or die($this->BD->error . " en la línea " . (__LINE__ - 1));


		$perfil = $data->fetch_assoc();
		if (!empty($perfil)) {
			$img = $perfil["avatar"];
		}
		return $img;
	}

	/**
	 * Obtener intereses
	 * 
	 * Devuelve el listado de interes disponibles para seleccionar
	 * 
	 * @return bool|mysqli_result  array asociativo con el listado de intereses
	 */
	function getListadoIntereses()
	{
		$query = "SELECT * FROM `intereses`";
		$query = $this->BD->query($query) or die($this->BD->error . " en la línea " . (__LINE__ - 1));

		return $query;
	}

	/**
	 * Obtener ocupaciones
	 * 
	 * Devuelve el listado de ocupaciones disponibles para seleccionar
	 * 
	 * @return bool|mysqli_result array asociativo con el listado de ocupaciones
	 */
	function getListadoOcupaciones()
	{
		$query = "SELECT * FROM `ocupaciones`";
		$query = $this->BD->query($query) or die($this->BD->error . " en la línea " . (__LINE__ - 1));

		return $query;
	}

	/**
	 * Obtener marcas
	 * 
	 * Devuelve listado de marcas disponibles para seleccionar
	 * 
	 * @return bool|mysqli_result array asocitativo con el listado de marcas
	 */
	public function getListadoMarcas()
	{
		$query = "SELECT * FROM `marcas`";
		$query = $this->BD->query($query) or die($this->BD->error . " en la línea " . (__LINE__ - 1));

		return $query;
	}

	/**
	 * Obtener interes
	 * 
	 * Devuelve la descripcion del interes con identificador 'interes_id'
	 * 
	 * @param int $interes_id identificador interes
	 * @return array|bool|null array asociativo con los campos de la consulta
	 */
	public function getInteres($interes_id)
	{
		$query = "SELECT interes FROM `intereses` where interes_id=$interes_id";
		$query = $this->BD->query($query) or die($this->BD->error . " en la línea " . (__LINE__ - 1));

		return $query->fetch_assoc();
	}

	/**
	 * Obtener marca
	 * 
	 * Devuelve la descripcion de la marca con identificador 'marca_id'
	 * 
	 * @param int $marca_id identificador marca
	 * @return array|bool|null array asociativo con los campos de la consulta
	 */
	public function getMarca($marca_id)
	{
		$query = "SELECT marca FROM `marcas` where marca_id=$marca_id";
		$query = $this->BD->query($query) or die($this->BD->error . " en la línea " . (__LINE__ - 1));

		return $query->fetch_assoc();
	}


	/**
	 * Añadir contacto
	 * 
	 * Inserta el usuario 'contacto_id' como contacto del usuario 'user_id'
	 * 
	 * @param int $user_id identificador del usuario 
	 * @param int $contacto_id identificador del contacto
	 * @return bool|mysqli_result
	 */
	public function añadirContacto($user_id, $contacto_id)
	{
		$query = sprintf("INSERT INTO user_contactos (user_id, contacto_id) VALUES ('%s','%s')", $this->BD->real_escape_string($user_id), $this->BD->real_escape_string($contacto_id));

		$data = $this->BD->query($query) or die($this->BD->error . " en la línea " . (__LINE__ - 1));

		return $data;
	}

	/**
	 * Eliminar contacto
	 * 
	 * Elimina el usuario 'contacto_id' de los contactos del usuario 'user_id'
	 * 
	 * @param int $user_id identificador del usuario
	 * @param int $contacto_id identifiador del contacto
	 * @return bool|mysqli_result
	 */
	public function eliminarContacto($user_id, $contacto_id)
	{

		$query = "DELETE FROM user_contactos WHERE user_id = '$user_id' and contacto_id='$contacto_id'";

		$data = $this->BD->query($query) or die($this->BD->error . " en la línea " . (__LINE__ - 1));

		return $data;
	}

	/**
	 * Obtener contactos
	 * 
	 * Devuelve el listado de contactos del usuario 'user_id' de entrada
	 * 
	 * @param int $user_id identificador del usuario
	 * @return bool|mysqli_result array asociativo con el listado de contactos
	 */
	public function obtenerContactos($user_id)
	{
		$query = "SELECT * FROM `user_contactos` join usuarios where user_contactos.user_id='$user_id' and contacto_id=usuarios.user_id";

		$data = $this->BD->query($query) or die($this->BD->error . " en la línea " . (__LINE__ - 1));

		return $data;
	}

	/**
	 * Existe contacto
	 * 
	 * Comprueba si el usuario 'contacto_id' esta dentro de los contactos del usuario 'user_id'
	 * 
	 * @param int $user_id identificador del usuario
	 * @param int $contacto_id identificador del contacto
	 * @return bool
	 */
	public function existeContacto($user_id, $contacto_id)
	{
		$query = "SELECT contacto_id FROM user_contactos WHERE user_id='$user_id' and contacto_id='$contacto_id'";

		$data = $this->BD->query($query) or die($this->BD->error . " en la línea " . (__LINE__ - 1));

		if ($data->fetch_assoc()) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Buscar contacto
	 * 
	 * Devuelve el o los contacto que tengan el nombre de usuario 'texto' de entrada de la red de contactos del usuarios 'user_id'
	 * @param string $texto texto a comparar con el nombre de usuario
	 * @param int $user_id identificador del usuario
	 * @return bool|mysqli_result array asociativo con el listado de usuarios
	 */
	function buscarContacto($texto, $user_id)
	{

		$query = "SELECT * FROM `user_contactos` join usuarios where user_contactos.user_id='$user_id' and user_contactos.contacto_id=usuarios.user_id and usuarios.nombreUsuario like '%" . $texto . "%' ";

		$usuarios = $this->BD->query($query) or die($this->BD->error . " en la línea " . (__LINE__ - 1));

		return $usuarios;
	}
}