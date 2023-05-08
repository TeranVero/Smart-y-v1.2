<?php
/**
 * Archivo para la conexion a la bbdd
 * 
 * @author Verónica Terán Molina <vteran@ucm.es>
 */


 /**
  * Clase para establecer la conexion
  */
 abstract class configBD{

	/**
	 * Nombre del host de la bbdd
	 * @var string
	 * @access private
	 */
	private $BD_HOST ='localhost';
	/**
	 * Nombre de la bbdd
	 * @var string
	 * @access private
	 */
	private $BD_NAME= 'vteran';
	/**
	 * Nombre de usuario de la bbdd
	 * @var string
	 * @access private
	 */
	private $BD_USER= 'vteran';
	/**
	 * Contraseña de la bbdd
	 * @var string
	 * @access private
	 */
	private $BD_PASS ='MacSolTeam7';
	/**
	 * Ruta raiz del sitio
	 * @var string
	 * @access private
	 */
	private $RAIZ_APP= 'http://localhost/Smart-y';
	/**
	 * Objeto bbdd
	 * @var mysqli
	 * @access protected
	 */
	protected $BD;
	

	/**
	 * Constructor de la clase
	 * 
	 * Creamos e inicalizamos la conexion a la bbdd
	 */
	public function __construct(){
		//register_shutdown_function('cierraConexion');
		$this->BD = new mysqli($this->BD_HOST, $this->BD_USER, $this->BD_PASS, $this->BD_NAME);
        

		if ($this->BD->connect_errno) {
			echo "Error de conexión a la BD: (" . $this->BD->connect_errno . ") " . utf8_encode($this->BD->connect_error);
			exit();
		  }
	  
		  if (!$this->BD->set_charset("utf8")) {
			echo "Error al configurar la codificación de la BD: (" . $this->BD->errno . ") " . utf8_encode($this->BD->error);
			exit();
		  }
	}

	/**
	 * Cerrar conexion
	 * @return void
	 */
	function cierraConexion() {
	  // Sólo hacer uso de global para cerrar la conexion !!
	  global $BD;
	  if ( isset($BD) && ! $BD->connect_errno ) {
		$BD->close();
	  }
	}
}

?>
