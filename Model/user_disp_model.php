<?php
/**
 * Modelo donde se define la logica para gestionar las tablas de relaciones entre usuarios y dispositivos
 * 
 * @author Verónica Terán Molina <vteran@ucm.es>
 */
include_once 'configBD.php';
include_once 'recomendador.php';


/**
 * Clase del modelo
 * 
 * Hereda la conexion a la base de datos desde la clase configBD
 */
class user_disp_model extends configBD
{


        /**
         * Dispositivo favorito
         * 
         * Comprueba si el dispositivo 'disp' esta marcado como favorito por el usuario 'user'
         * 
         * @param int $user identificador del usuario
         * @param int $disp identificador del dispositivo
         * @return bool
         */
        public function isFav($user, $disp)
        {

                $query = "SELECT * FROM user_disp_fav WHERE disp_id = '$disp' and user_id='$user'";
                $favorito = $this->BD->query($query) or die($this->BD->error . " en la línea " . (__LINE__ - 1));
                if ($favorito->fetch_assoc())
                        return true; //Devuelve true si el usuario tiene el dispositivo como fav
                else
                        return false;

        }


        /**
         * Añadir favorito
         * 
         * Inserta el dispositivo 'disp' como favorito del usuario 'user'
         * 
         * @param int $user identificador del usuario
         * @param int $disp identificador del dispositivo
         * @return void
         */
        public function addFav($user, $disp)
        {
                $query = "INSERT INTO user_disp_fav(user_id,disp_id) VALUES ($user,$disp)";
                $this->BD->query($query) or die($this->BD->error . " en la línea " . (__LINE__ - 1));

                /**
                 *Al añadir un dispositivo como favorito, se inicia la recomendacion a usuarios "cercanos"
                 */
                $recomendador = new Recomendador();
                $recomendador->recomendador_por_usuarios($user, $disp, "fav");

                echo "add";
        }

        /**
         * Eliminar favorito
         * 
         * Elimina el dispositivo 'disp' como favorito del usuarios 'user'
         * 
         * @param int $user identificador del usuario
         * @param int $disp identificador del dispositivo
         * @return void
         */
        public function deleteFav($user, $disp)
        {

                $query = "DELETE FROM user_disp_fav where user_id='$user' and disp_id='$disp'";
                $this->BD->query($query) or die($this->BD->error . " en la línea " . (__LINE__ - 1));

                echo "delete";
        }

        /**
         * Obtener favoritos
         * 
         * Devuelve los dispositivos marcados como favoritos por el usuario 'user9 de entrada
         * 
         * @param int $user identificador del usuario
         * 
         * @return bool|mysqli_result array asociativo con los campos de la consulta
         */
        public function getFav($user)
        {

                $query = "SELECT disp_id FROM user_disp_fav WHERE user_id='$user'";
                $favoritos = $this->BD->query($query) or die($this->BD->error . " en la línea " . (__LINE__ - 1));
                return $favoritos;
        }
        /**
         * Dispositivo no recomendado
         * 
         * Comprueba si el dispositivo 'disp' ha sido marcado como no recomendar por el usuario 'user'
         * 
         * @param int $user identificador del usuarios
         * @param int $disp identificador del dispositivo
         * @return bool
         */
        public function isDislike($user, $disp)
        {

                $query = "SELECT * FROM user_disp_dislike WHERE disp_id = '$disp' and user_id='$user'";
                $dislike = $this->BD->query($query) or die($this->BD->error . " en la línea " . (__LINE__ - 1));
                if ($dislike->fetch_assoc())
                        return true;
                else
                        return false;

        }


        /**
         * Añadir no recomendado
         * 
         * Inserta el dispositivo 'disp' como no recomendado por el usuario 'user'. Posteriormente, incrementa la 
         * valoracion negativa del dispositivo
         * 
         * @param int $user identificador del usuario
         * @param int $disp identificador del dispositivo
         * @return void
         */
        public function addDislike($user, $disp)
        {


                $query = "INSERT INTO user_disp_dislike(user_id,disp_id) VALUES ($user,$disp)";
                $this->BD->query($query) or die($this->BD->error . " en la línea " . (__LINE__ - 1));

                $query = "UPDATE dispositivos set dislikes = dislikes+1 where disp_id =$disp";
                $this->BD->query($query) or die($this->BD->error . " en la línea " . (__LINE__ - 1));



                echo "add";
        }

        /**
         * Eliminar no recomendado
         * 
         * Elimina el dispositivo 'disp' como no recomendado del usuario 'user', además decrementa la valoracion negativa 
         * del dispositivo
         * 
         * @param int $user identificador del usuario
         * @param int $disp identificador del dispositivo
         * @return void
         */
        public function deleteDislike($user, $disp)
        {
                $query = "DELETE FROM user_disp_dislike where user_id='$user' and disp_id='$disp'";
                $this->BD->query($query) or die($this->BD->error . " en la línea " . (__LINE__ - 1));

                $query = "UPDATE dispositivos set dislikes = dislikes-1 where disp_id =$disp";
                $this->BD->query($query) or die($this->BD->error . " en la línea " . (__LINE__ - 1));

                echo "delete";
        }

        /**
         * Obtener no recomendados
         * 
         * Devuelve todos los dispositivos no recomendados del usuario 'user'
         * 
         * @param int $user identificacion del usuario
         * @return bool|mysqli_result array asociativo con los campos de la consulta
         */
        public function getDislike($user)
        {

                $query = "SELECT disp_id FROM user_disp_dislike WHERE user_id='$user'";
                $favoritos = $this->BD->query($query) or die($this->BD->error . " en la línea " . (__LINE__ - 1));
                return $favoritos;
        }


        /**
         * Dispositivo usado
         * 
         * Comprueba si el dispositivo 'disp' ha sido marcado como usado por el usuario 'user'
         * 
         * @param int $user identificador del usuario
         * @param int $disp identificador del dispositivo
         * @return bool
         */
        public function isUsed($user, $disp)
        {
                $query = "SELECT * FROM user_disp_use WHERE disp_id = '$disp' and user_id='$user'";
                $use = $this->BD->query($query) or die($this->BD->error . " en la línea " . (__LINE__ - 1));
                if ($use->fetch_assoc()) {
                        return true;
                } else {
                        return false;
                }
        }


        /**
         * Añadir usado
         * 
         * Inserta el dispositivo 'disp' como usado por el usuario 'user'
         * 
         * @param int $user identificador del usuario
         * @param int $disp identificador del dispositivo
         * @return void
         */
        public function addUse($user, $disp)
        {
                $query = "INSERT INTO user_disp_use(user_id,disp_id) VALUES ($user,$disp)";
                $this->BD->query($query) or die($this->BD->error . " en la línea " . (__LINE__ - 1));

                echo "add";
        }

        /**
         * Eliminar usado
         * 
         * Elimina el dispositivo 'disp' como no usado del usuario 'user'
         * 
         * @param int $user identificador del usuario
         * @param int $disp  identificador del dispositivo
         * @return void
         */
        public function deleteUse($user, $disp)
        {
                $query = "DELETE FROM user_disp_use where user_id='$user' and disp_id='$disp'";
                $this->BD->query($query) or die($this->BD->error . " en la línea " . (__LINE__ - 1));

                echo "delete";
        }

        /**
         * Obtener usados
         * 
         * Devuelve todos los dispositivos marcados como usados por el usuario 'user' de entrada
         * 
         * @param int $user identificador del usuario
         * @return bool|mysqli_result array asociativo con los campos de la consulta
         */
        public function getUsed($user)
        {
                $query = "SELECT disp_id FROM user_disp_use WHERE user_id='$user'";
                $used = $this->BD->query($query) or die($this->BD->error . " en la línea " . (__LINE__ - 1));
                return $used;
        }

        /**
         * Obtener todos los dispositivos del usuario 'user'
         * 
         * @param int $user identificador del usuario
         * @return bool|mysqli_result array asociativo con los campos de la consulta
         */
        public function getDispAll($user)
        {
                $query = "SELECT disp_id FROM user_disp_use WHERE user_id='$user' UNION SELECT disp_id FROM user_disp_fav WHERE user_id='$user' UNION SELECT disp_id FROM user_disp_dislike WHERE user_id='$user'";
                $all = $this->BD->query($query) or die($this->BD->error . " en la línea " . (__LINE__ - 1));
                return $all;
        }

        /**
	 * Existe recomendacion
         * 
         * Compriueba si el dispositivo 'disp' existe dentro de las recomendaciones del usuario 'user'
         * 
	 * @param int $user identificador del usuario
	 * @param int $disp identificador del dispositivo
	 * @return bool
	 */
	public function existeRecomendacion($user, $disp)
	{

		$query = "SELECT * FROM user_recomendaciones WHERE disp_id='$disp' and user_id='$user'";
		$data = $this->BD->query($query) or die($this->BD->error . " en la línea " . (__LINE__ - 1));

		if ($data->fetch_assoc())
			return true;
		else
			return false;
	}

	/**
	 * Añadir recomendacion
         * 
         * Inserta el dispositivo 'disp' dentro de las recomendaciones del usuario 'user'
         * 
	 * @param int $user identificador del usuario
	 * @param int $disp identificador del dispositivo
	 * @return bool|mysqli_result
	 */
	public function addRecomendacion($user, $disp)
	{
		$query = "INSERT INTO user_recomendaciones(user_id,disp_id) VALUES ($user,$disp)";
		$data = $this->BD->query($query) or die($this->BD->error . " en la línea " . (__LINE__ - 1));

		return $data;
	}

	/**
	 * Eliminar recomendacion
         * 
         * Elimina el dispositivo 'disp' de las recomendaciones del usuario 'user'
         * 
	 * @param int $user identificador del usuario
 	 * @param mixed $disp identificador del dispositivo
	 * @return bool|mysqli_result
	 */
	public function deleteRecomendacion($user, $disp)
	{

		$query = "DELETE FROM user_recomendaciones where user_id='$user' and disp_id='$disp'";
		$data = $this->BD->query($query) or die($this->BD->error . " en la línea " . (__LINE__ - 1));

		return $data;
	}

	/**
	 * Obtener recomendaciones
         * 
         * Devuelve las recomendaciones del usuario 'user' de entrada
         * 
	 * @param int $user identificador del usuario
	 * @return bool|mysqli_result array asociativo con los campos de la consulta
	 */
	public function getRecomendaciones($user)
	{

		$query = "SELECT disp_id FROM user_recomendaciones WHERE user_id='$user'";
		$favoritos = $this->BD->query($query) or die($this->BD->error . " en la línea " . (__LINE__ - 1));

		return $favoritos;
	}


}
?>