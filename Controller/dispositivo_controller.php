<?php
/**
 * Controlador de los dispositivos
 * 
 * @author Verónica Terán Molina <vteran@ucm.es>
 */

include_once(realpath(dirname(__FILE__, 2))) . '/Model/dispositivo_model.php';
/**
 * Clase controlador para la gestion del modelo relativo a los dispositivos
 */
class dispositivo_controller
{
	/**
	 * Variable para acceder a la logica del modelo relativo a los dispositivos
	 * @var dispositivo_model $disp_model
	 * @access protected
	 */
	protected $disp_model;

	/**
	 * Construcctor de la clase
	 * 
	 * Creamos el el objeto $disp_model
	 */
	public function __construct()
	{

		$this->disp_model = new dispositivo_model();
	}


	/**
	 * Añadir dispositivo nuevo
	 * 
	 * Llama al modelo para la creacion de un nuevo dispositivo
	 * @return boolean
	 */
	public function altaDispositivo()
	{
		
		$nombre = $_POST['nombre'];
		$marca = $_POST['marca'];
		if (!empty($_POST['caracteristicas_cam'])) {
			$caracteristicas_cam = implode(",", $_POST['caracteristicas_cam']);
		} else {
			$caracteristicas_cam = "";
		}
		$so = $_POST['so'];
		$pulgadas = $_POST['pulgadas'];
		$alto = $_POST['alto'];
		$ancho = $_POST['ancho'];
		$grosor = $_POST['grosor'];
		$peso = $_POST['peso'];
		$pantalla = intval($_POST['alto']) * intval($_POST['ancho']);
		$tipo_pantalla = $_POST['tipo_pantalla'];
		$tasa_refresco = $_POST['tasa_refresco'];
		$resolucion_a = $_POST['resolucion_a'];
		$resolucion_b = $_POST['resolucion_b'];
		$resolucion = intval($_POST['resolucion_a']) * intval($_POST['resolucion_b']);
		$ram = $_POST['ram'];
		$memoria_interna = $_POST['memoria_interna'];
		if (isset($_POST['ampliable_sd'])) {
			$ampliable_sd = $_POST['ampliable_sd'];
		} else {
			$ampliable_sd = 0;
		}
		if (isset($_POST['seguridad_facial'])) {
			$seguridad_facial = $_POST['seguridad_facial'];
		} else {
			$seguridad_facial = 0;
		}
		if (isset($_POST['seguridad_huella'])) {
			$seguridad_huella = $_POST['seguridad_huella'];
		} else {
			$seguridad_huella = 0;
		}
		$cam_trasera = $_POST['cam_trasera'];

		if (!empty($_POST['caracteristicas_cam'])) {
			$caracteristicas_cam = implode(",", $_POST['caracteristicas_cam']);
		} else {
			$caracteristicas_cam = "";
		}
		$flash = $_POST['flash'];
		if (isset($_POST['estabilizacion_opt'])) {
			$estabilizacion_opt = $_POST['estabilizacion_opt'];
		} else {
			$estabilizacion_opt = 0;
		}
		if (isset($_POST['slow_motion'])) {
			$slow_motion = $_POST['slow_motion'];
		} else {
			$slow_motion = 0;
		}
		$cam_frontal = $_POST['cam_frontal'];

		$cam_otras = $_POST['cam_otras'];

		$lente_teleobjetivo = $_POST['lente_teleobjetivo'];
		$lente_gran_angular = $_POST['lente_gran_angular'];
		$lente_macro = $_POST['lente_macro'];
		if (isset($_POST['infrarojos'])) {
			$infrarojos = $_POST['infrarojos'];
		} else {
			$infrarojos = 0;
		}
		if (isset($_POST['jack'])) {
			$jack = $_POST['jack'];
		} else {
			$jack = 0;
		}
		if (isset($_POST['nfc'])) {
			$nfc = $_POST['nfc'];
		} else {
			$nfc = 0;
		}
		if (!empty($_POST['sensores'])) {
			$sensores = implode(",", $_POST['sensores']);
		} else {
			$sensores = "";
		}
		$usb_tipo = $_POST['usb_tipo'];
		if (isset($_POST['usb_carga'])) {
			$usb_carga = $_POST['usb_carga'];
		} else {
			$usb_carga = 0;
		}
		if (isset($_POST['usb_otg'])) {
			$usb_otg = $_POST['usb_otg'];
		} else {
			$usb_otg = 0;
		}
		if (isset($_POST['usb_masivo'])) {
			$usb_masivo = $_POST['usb_masivo'];
		} else {
			$usb_masivo = 0;
		}
		$bateria = $_POST['bateria'];
		if (isset($_POST['conexion'])) {
			$conexion = $_POST['conexion'];
		} else {
			$conexion = 0;
		}
		if (isset($_POST['pantalla_curva'])) {
			$pantalla_curva = $_POST['pantalla_curva'];
		} else {
			$pantalla_curva = 0;
		}
		$resistencia = $_POST['resistencia'];
		$carga_rapida = $_POST['carga_rapida'];
		$otros = $_POST['otros'];
		$fecha = $_POST['fecha'];
		$precio = $_POST['precio'];
		$colores = $_POST['colores'];
		if (isset($_POST['destacada'])) {
			$destacada = $_POST["destacada"];
		} else {
			$destacada = "";
		}
		if (isset($_POST['galeria'])) {
			$galeria = $_POST["galeria"];
		} else {
			$galeria = "";
		}
		if (isset($_POST['interes'])) {
			$interes = $_POST["interes"];
		} else {
			$interes = "";
		}

		$data = $this->disp_model->alta_dispositivo(
			$nombre,
			$marca,
			$so,
			$pulgadas,
			$alto,
			$ancho,
			$grosor,
			$peso,
			$pantalla,
			$tipo_pantalla,
			$tasa_refresco,
			$resolucion,
			$resolucion_a,
			$resolucion_b,
			$ram,
			$memoria_interna,
			$ampliable_sd,
			$seguridad_facial,
			$seguridad_huella,
			$cam_trasera,
			$caracteristicas_cam,
			$flash,
			$estabilizacion_opt,
			$slow_motion,
			$cam_frontal,
			$cam_otras,
			$lente_teleobjetivo,
			$lente_gran_angular,
			$lente_macro,
			$infrarojos,
			$jack,
			$nfc,
			$sensores,
			$usb_tipo,
			$usb_carga,
			$usb_otg,
			$usb_masivo,
			$bateria,
			$conexion,
			$pantalla_curva,
			$resistencia,
			$carga_rapida,
			$otros,
			$fecha,
			$precio,
			$colores,
			$destacada,
			$galeria,
			$interes
		);
		return $data;

	}
	/**
	 * Eliminar un dispositivo
	 * 
	 * Llama al modelo para la eliminacion del dispositivo de entrada
	 * @param int $disp identificador del dispositivo a eliminar
	 * @return void
	 */
	public function eliminarDispositivo($disp)
	{
		$this->disp_model->eliminarDispositivo($disp);
	}

	/**
	 * Modificar un dispositivo
	 * 
	 * Llama a la funcdion del modelo para la modificacion de la ficha del dispositivo de entrada
	 * @param int $disp identificador del dispoditivo a modificar
	 * @return bool
	 */
	public function modificarDispositivo($disp)
	{
		$nombre = $_POST['nombre'];
		$marca = $_POST['marca'];
		if (!empty($_POST['caracteristicas_cam'])) {
			$caracteristicas_cam = implode(",", $_POST['caracteristicas_cam']);
		} else {
			$caracteristicas_cam = "";
		}
		$so = $_POST['so'];
		$pulgadas = $_POST['pulgadas'];
		$alto = $_POST['alto'];
		$ancho = $_POST['ancho'];
		$grosor = $_POST['grosor'];
		$peso = $_POST['peso'];
		$pantalla = intval($_POST['alto']) * intval($_POST['ancho']);
		$tipo_pantalla = $_POST['tipo_pantalla'];
		$tasa_refresco = $_POST['tasa_refresco'];
		$resolucion_a = $_POST['resolucion_a'];
		$resolucion_b = $_POST['resolucion_b'];
		$resolucion = intval($_POST['resolucion_a']) * intval($_POST['resolucion_b']);
		$ram = $_POST['ram'];
		$memoria_interna = $_POST['memoria_interna'];
		if (isset($_POST['ampliable_sd'])) {
			$ampliable_sd = $_POST['ampliable_sd'];
		} else {
			$ampliable_sd = 0;
		}
		if (isset($_POST['seguridad_facial'])) {
			$seguridad_facial = $_POST['seguridad_facial'];
		} else {
			$seguridad_facial = 0;
		}
		if (isset($_POST['seguridad_huella'])) {
			$seguridad_huella = $_POST['seguridad_huella'];
		} else {
			$seguridad_huella = 0;
		}
		$cam_trasera = $_POST['cam_trasera'];

		if (!empty($_POST['caracteristicas_cam'])) {
			$caracteristicas_cam = implode(",", $_POST['caracteristicas_cam']);
		} else {
			$caracteristicas_cam = "";
		}
		$flash = $_POST['flash'];
		if (isset($_POST['estabilizacion_opt'])) {
			$estabilizacion_opt = $_POST['estabilizacion_opt'];
		} else {
			$estabilizacion_opt = 0;
		}
		if (isset($_POST['slow_motion'])) {
			$slow_motion = $_POST['slow_motion'];
		} else {
			$slow_motion = 0;
		}
		$cam_frontal = $_POST['cam_frontal'];

		$cam_otras = $_POST['cam_otras'];

		$lente_teleobjetivo = $_POST['lente_teleobjetivo'];
		$lente_gran_angular = $_POST['lente_gran_angular'];
		$lente_macro = $_POST['lente_macro'];
		if (isset($_POST['infrarojos'])) {
			$infrarojos = $_POST['infrarojos'];
		} else {
			$infrarojos = 0;
		}
		if (isset($_POST['jack'])) {
			$jack = $_POST['jack'];
		} else {
			$jack = 0;
		}
		if (isset($_POST['nfc'])) {
			$nfc = $_POST['nfc'];
		} else {
			$nfc = 0;
		}
		if (!empty($_POST['sensores'])) {
			$sensores = implode(",", $_POST['sensores']);
		} else {
			$sensores = "";
		}
		$usb_tipo = $_POST['usb_tipo'];
		if (isset($_POST['usb_carga'])) {
			$usb_carga = $_POST['usb_carga'];
		} else {
			$usb_carga = 0;
		}
		if (isset($_POST['usb_otg'])) {
			$usb_otg = $_POST['usb_otg'];
		} else {
			$usb_otg = 0;
		}
		if (isset($_POST['usb_masivo'])) {
			$usb_masivo = $_POST['usb_masivo'];
		} else {
			$usb_masivo = 0;
		}
		$bateria = $_POST['bateria'];
		if (isset($_POST['conexion'])) {
			$conexion = $_POST['conexion'];
		} else {
			$conexion = 0;
		}
		if (isset($_POST['pantalla_curva'])) {
			$pantalla_curva = $_POST['pantalla_curva'];
		} else {
			$pantalla_curva = 0;
		}
		$resistencia = $_POST['resistencia'];
		$carga_rapida = $_POST['carga_rapida'];
		$otros = $_POST['otros'];
		if (isset($_POST['fecha'])) {
			$fecha = $_POST['fecha'];
		} else {
			$fecha = "0000-00-00";
		}
		$precio = $_POST['precio'];
		$colores = $_POST['colores'];
		if (isset($_POST['destacada'])) {
			$destacada = $_POST["destacada"];
		} else {
			$destacada = "";
		}
		if (isset($_POST['galeria'])) {
			$galeria = $_POST["galeria"];
		} else {
			$galeria = "";
		}
		if (isset($_POST['interes'])) {
			$interes = $_POST["interes"];
		} else {
			$interes = "";
		}

		return $this->disp_model->modificarFicha(
			$disp,
			$nombre,
			$marca,
			$so,
			$pulgadas,
			$alto,
			$ancho,
			$grosor,
			$peso,
			$pantalla,
			$tipo_pantalla,
			$tasa_refresco,
			$resolucion,
			$resolucion_a,
			$resolucion_b,
			$ram,
			$memoria_interna,
			$ampliable_sd,
			$seguridad_facial,
			$seguridad_huella,
			$cam_trasera,
			$caracteristicas_cam,
			$flash,
			$estabilizacion_opt,
			$slow_motion,
			$cam_frontal,
			$cam_otras,
			$lente_teleobjetivo,
			$lente_gran_angular,
			$lente_macro,
			$infrarojos,
			$jack,
			$nfc,
			$sensores,
			$usb_tipo,
			$usb_carga,
			$usb_otg,
			$usb_masivo,
			$bateria,
			$conexion,
			$pantalla_curva,
			$resistencia,
			$carga_rapida,
			$otros,
			$fecha,
			$precio,
			$colores,
			$destacada,
			$galeria,
			$interes
		);
	}

	/**
	 * Obtener dispositivo
	 * 
	 * Llama al modelo para obtener toda la información guardada del dispositivo de entrada
	 * @param int $disp_id identificador del dispositivo 
	 * @return array array asociativo con los valores del dispositivo
	 */
	public function getDisp($disp_id)
	{
		return $this->disp_model->getDispositivo($disp_id);
	}

	/**
	 * Obtener imagen destacada
	 * 
	 * Llama al modelo para obtener la imagen destacada del dispositivo de entrada
	 * 
	 * @param int $disp_id identificador del dispositivo
	 * @return array array asociativo con la informacion relativa a la imagen 
	 */
	public function getDestacada($disp_id)
	{
		return $this->disp_model->getDestacada($disp_id);
	}

	/**
	 * Obtener galeria
	 * 
	 * Llama al modelo para obtener las imagenes que conforman la galeria del dispositivo de entrada
	 * 
	 * @param int $disp_id identificador del dispositivo
	 * @return mysqli_result array asociativo con la informacion relativa a las imagenes
	 */
	public function getGaleria($disp_id)
	{
		return $this->disp_model->getGaleria($disp_id);
	}

	/**
	 * Buscar dispositivo
	 * 
	 * Llama al modelo para obtener la informacion del dispositivo de entrada
	 * @param string $disp nombre o modelo del dispositivo.
	 * @return mysqli_result  array asociativo con la informacion del dispositivo
	 */
	public function buscarDisp($disp)
	{
		$array_disp = $this->disp_model->buscarDisp($disp);

		 return $array_disp;

		
	}

	/**
	 * Obtener listado de caracteristicas de camara
	 * 
	 * Llama al modelo para obtener el listado de los tipos de caracteristicas de las camaras
	 * 
	 * @return mysqli_result array asociativo con el listado
	 */
	public function getCaracteristicasCam()
	{
		return $this->disp_model->getCaracteristicasCam();
	}

	/**
	 * Obtener info de caracteristica
	 * 
	 * Llama al modelo para obtener la informacion de la caracteristica de entrada
	 * @param int $c identificador de la caracteristica
	 * @return array array asociativo con la informacion
	 */
	public function getCaracteristicasCam_c($c)
	{
		return $this->disp_model->getCaracteristicasCam_c($c);
	}

	/** 
	* Obtener el listado de sensores
	*
	* Llama al modelo para obtener el listado de sensores
	* @return mysqli_result array asociativo con el listado de sesores
	*/
	public function getSensores()
	{
		return $this->disp_model->getSensores();
	}
	/**
	 * Obtener info de sensor
	 * 
	 * Llama al modelo para obtener la informacion del sensor de entrada
	 * 
	 * @param int $s identificador del sensor
	 * @return array array asociativo con la informacion del sensor
	 */
	public function getSensores_s($s)
	{
		return $this->disp_model->getSensores_s($s);
	}

	/**
	 * Obtener listado de precios
	 * 
	 * Llama al modelo para obtener el listado de los diferentes precios del dispositivo de entrada
	 * 
	 * @param int $disp identificador del dispositivo
	 * @return mysqli_result array asociativo con el listado de sesores
	 */
	public function getListadoPrecios($disp)
	{
		return $this->disp_model->getListadoPrecios($disp);
	}

	/**
	 * Obtener puntos fuertes/intereses
	 * 
	 * Llama al modelo para obtener los puntos fuertes, o intereses en los que mas destaca el dispositivo de entrada.
	 * 
	 * @param int $disp identificador del dispositivo
	 * @return mysqli_result array asociativo con el listado de intereses
	 */
	public function getDispInteres($disp)
	{
		return $this->disp_model->getDispInteres($disp);
	}

}