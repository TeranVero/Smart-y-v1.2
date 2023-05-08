<?php
class Usuario {
    private $nombre;
    private $apellidos;
    private $email;
    private $fecha;
    private $nombreUsuario;
    private $pass;
    private $ocupacion;
    private $intereses;
    private $marcas;


    public function __construct( $nombre, $apellidos, $email, $fecha, $nombreUsuario,$pass,$ocupacion,
    $intereses,$marcas) {
        $this->nombre = $nombre;
        $this->apellidos=$apellidos;
        $this->email = $email;
        $this->fecha=$fecha;
        $this->nombreUsuario=$nombreUsuario;
        $this->pass=$pass;
        $this->ocupacion=$ocupacion;
        $this->intereses=$intereses;
        $this->marcas=$marcas;
    }

	/**
	 * @return mixed
	 */
	public function getNombre() {
		return $this->nombre;
	}
	
	/**
	 * @param mixed $nombre 
	 * @return self
	 */
	public function setNombre($nombre): self {
		$this->nombre = $nombre;
		return $this;
	}
	
	/**
	 * @return mixed
	 */
	public function getApellidos() {
		return $this->apellidos;
	}
	
	/**
	 * @param mixed $apellidos 
	 * @return self
	 */
	public function setApellidos($apellidos): self {
		$this->apellidos = $apellidos;
		return $this;
	}
	
	/**
	 * @return mixed
	 */
	public function getEmail() {
		return $this->email;
	}
	
	/**
	 * @param mixed $email 
	 * @return self
	 */
	public function setEmail($email): self {
		$this->email = $email;
		return $this;
	}
	
	/**
	 * @return mixed
	 */
	public function getFecha() {
		return $this->fecha;
	}
	
	/**
	 * @param mixed $fecha 
	 * @return self
	 */
	public function setFecha($fecha): self {
		$this->fecha = $fecha;
		return $this;
	}
	
	/**
	 * @return mixed
	 */
	public function getNombreUsuario() {
		return $this->nombreUsuario;
	}
	
	/**
	 * @param mixed $nombreUsuario 
	 * @return self
	 */
	public function setNombreUsuario($nombreUsuario): self {
		$this->nombreUsuario = $nombreUsuario;
		return $this;
	}
	
	/**
	 * @return mixed
	 */
	public function getPass() {
		return $this->pass;
	}
	
	/**
	 * @param mixed $pass 
	 * @return self
	 */
	public function setPass($pass): self {
		$this->pass = $pass;
		return $this;
	}
	
	/**
	 * @return mixed
	 */
	public function getOcupacion() {
		return $this->ocupacion;
	}
	
	/**
	 * @param mixed $ocupacion 
	 * @return self
	 */
	public function setOcupacion($ocupacion): self {
		$this->ocupacion = $ocupacion;
		return $this;
	}
	
	/**
	 * @return mixed
	 */
	public function getIntereses() {
		return $this->intereses;
	}
	
	/**
	 * @param mixed $intereses 
	 * @return self
	 */
	public function setIntereses($intereses): self {
		$this->intereses = $intereses;
		return $this;
	}
	
	/**
	 * @return mixed
	 */
	public function getMarcas() {
		return $this->marcas;
	}
	
	/**
	 * @param mixed $marcas 
	 * @return self
	 */
	public function setMarcas($marcas): self {
		$this->marcas = $marcas;
		return $this;
	}
}
?>