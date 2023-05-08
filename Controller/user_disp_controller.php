<?php
/**
 * Controlador para la gestion del modelo relativo a las tablas de relacion disp-usuario
 * Tablas:
 * 	- 'user_disp_dislike'
 * 	- 'user_disp_fav'
 * 	- 'user_disp_use'
 * 
 * @author Verónica Terán Molina <vteran@ucm.es>
 */
include_once(realpath(dirname(__FILE__, 2))) . '/Model/user_disp_model.php';

/**
 * Clase controlador user_disp_controller
 */
class user_disp_controller
{

	/**
	 * Modelo  para llamar a las funciones relativas a las tablas reacion usuario-dispositivo
	 * @var user_disp_model modelo 
	 * @access public
	 */
	public $user_disp_model;

	/**
	 * Modelo  para llamar a las funciones relativas al usuario
	 * @var usuarios_model modelo
	 * @access public
	 */
	public $usuarios_model;
	/**
	 * Modelo para llamar a las funciones relativas al usuario
	 * @var usuarios_model modelo 
	 * @access public
	 */

	/**
	 * Constructor de la clase
	 * 
	 * Se crean los objetos de los diferentes modelos
	 */
	function __construct()
	{
		$this->user_disp_model = new user_disp_model();
		$this->usuarios_model = new usuarios_model();
	}


	/**
	 * Comprobar favorito
	 * 
	 * Devuelve true si el dispositivo 'disp' es favorito del usuario 'user'
	 * 
	 * @param integer $user identificador del usuario
	 * @param integer $disp identificador del dispositivo 
	 * @return bool
	 */
	public function isFav($user, $disp)
	{
		return $this->user_disp_model->isFav($user, $disp);
	}
	/**
	 * Añadir/eliminar dispositivo como favorito
	 * 
	 * Comprueba si el dispositivo 'disp' es favorito del usuario 'user', en caso de no tenerlo en favoritos, se añade. Si ya es favorito,
	 * se elimina como favorito.
	 * 
	 * @param integer $user identificador del usuario
	 * @param integer $disp identificador del dispositivo
	 * @return void
	 */
	public function checkFav($user, $disp)
	{

		if ($this->isFav($user, $disp)) {
			//si el usuario tiene el dispositivo como favorito, lo quitamos.
			$this->user_disp_model->deleteFav($user, $disp);
		} else {
			$this->user_disp_model->addFav($user, $disp);

			/* Cuando el usuario 'user' añade el dispositivo 'disp' como favorito, se comprueba si el dispositivo existe como recomendacion para
			el usuario. Si lo añade como favorito, se elimina como recomendacion
			*/
			if ($this->user_disp_model->existeRecomendacion($user, $disp)) {
				$this->user_disp_model->deleteRecomendacion($user, $disp);
			}
		}
	}
	
	/**
	 * Añadir dispositivo como favorito
	 * 
	 * Añade el dispositivo 'disp' como favorito del usuario 'user'
	 * 
	 * @param integer $user identificador del usuario
	 * @param integer $disp identificador del dispositivo
	 * @return void
	 */
	public function addFav($user,$disp){
		return $this->user_disp_model->addFav($user, $disp);
	}

	/**
	 * Obtener favoritos
	 * 
	 * Devuelve los dispositivo favoritos del usuario 'user'
	 * 
	 * @param integer $user identificador del usuario
	 * @return bool|mysqli_result  array asociativo con los id de los dispositivos favoritos
	 */
	public function getFav($user)
	{
		return $this->user_disp_model->getFav($user);
	}

	/**
	 * Comprobar no recomendado
	 * 
	 * Devuelve true si el dispositivo 'disp' esta marcado como no recomendado por el usuario 'user'
	 * 
	 * @param integer $user identificador del usuario
	 * @param integer $disp identificador del dispositivo
	 * @return bool
	 */
	public function isDislike($user, $disp)
	{
		return $this->user_disp_model->isDislike($user, $disp);
	}
	/**
	 * Añadir/eliminar dispositivo como no recomendado
	 * 
	 * Comprueba si el dispositivo 'disp' esta marcado como no recomendado por el usuario 'user', en caso de no tenerlo, se añade. Si ya esta marcado,
	 * se elimina.
	 * 
	 * @param integer $user identificador del usuario
	 * @param integer $disp identificador del dispositivo
	 * @return void
	 */
	public function checkDislike($user, $disp)
	{
		if ($this->isDislike($user, $disp)) {
			//si el usuario tiene el dispositivo como no recomendado, lo quitamos del listado
			$this->user_disp_model->deleteDislike($user, $disp);
		} else {
			$this->user_disp_model->addDislike($user, $disp);
		}
	}

	/**
	 * Comprobar dispositivo usado
	 * 
	 * Devuelve true si el dispositivo 'disp' esta marcado como usado por el usuario 'user'
	 * 
	 * @param integer $user identificador del usuario
	 * @param integer $disp identificador del dispositivo
	 * @return bool
	 */
	public function isUsed($user, $disp)
	{
		return $this->user_disp_model->isUsed($user, $disp);
	}
	/**
	 * Añadir/eliminar dispositivo como no recomendado
	 * 
	 * Comprueba si el dispositivo 'disp' esta marcado como usado por el usuario 'user', en caso de no tenerlo, se añade. Si ya esta marcado,
	 * se elimina.
	 * 
	 * @param integer $user identificador del usuario
	 * @param integer $disp identificador del dispositivo
	 * @return void
	 */
	public function checkUse($user, $disp)
	{
		if ($this->isUsed($user, $disp)) {
			//si el usuario tiene el dispositivo como usado, lo quitamos del listado
			$this->user_disp_model->deleteUse($user, $disp);
		} else {
			$this->user_disp_model->addUse($user, $disp);
		}
	}

	/**
	 * Obtener dispositivos marcados como usado
	 * 
	 * Devuelve los dispositivo marcados como usados del usuario 'user'
	 * 
	 * @param integer $user identificador del usuario
	 * @return bool|mysqli_result  array asociativo con los id de los dispositivos usados
	 */
	public function getUsed($user)
	{
		return $this->user_disp_model->getUsed($user);
	}

	/**
	 * Obtener todos los dispositivos
	 * 
	 * Devuelve todos los dispositivos del usuario 'user'
	 * 
	 * @param integer $user identificador del usuario
	 * @return bool|mysqli_result  array asociativo con los id de los dispositivos
	 */
	public function getDispAll($user)
	{

		return $this->user_disp_model->getDispAll($user);
	}

	/**
	 * Existe recomendacion
	 * 
	 * Llama al modelo para comprobar si el dispostivo 'disp_id' esta en el listado de recomendaciones del usuario 'user_id'
	 * 
	 * @param int $user_id identificador del usuario
	 * @param int $disp_id identificador del dispositivo
	 * @return bool
	 */
	public function existeRecomendacion($user_id, $disp_id)
	{
		return $this->user_disp_model->existeRecomendacion($user_id, $disp_id);
	}
	/**
	 * Añadir recomendacion
	 * 
	 * Llama al modelo para añadir el dispositivo 'disp' como recomendacion para el usuario 'user'
	 * 
	 * @param int $user identificador del usuario
	 * @param int $disp identificador del dispositivo
	 * @return void
	 */
	public function addRecomendacion($user, $disp)
	{
		$this->user_disp_model->addRecomendacion($user, $disp);
	}
	/**
	 * Eliminar recomendacion
	 * 
	 * Llama al modelo para eliminar la recomendacion del dispositivo 'disp' del usuario 'user'
	 * 
	 * @param int $user identificador del usuario
	 * @param int $disp identificador del dispositivo
	 * @return mixed
	 */
	public function deteleRecomendacion($user, $disp)
	{
		return $this->user_disp_model->deleteRecomendacion($user, $disp);
	}

	/**
	 * Obtener recomendaciones
	 * 
	 * Llama al modelo para obtener el listado de dispositivos recomendados del usuario 'user' de entrada
	 * 
	 * @param int $user identificador del usuario
	 * @return bool|mysqli_result  array asociativo con el listado de recomendaciones del usuario
	 */
	public function getRecomendaciones($user)
	{
		return $this->user_disp_model->getRecomendaciones($user);
	}

}

?>