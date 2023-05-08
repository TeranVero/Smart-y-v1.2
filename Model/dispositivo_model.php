<?php
/**
 * Modelo donde se define la logica para gestionar la bbdd de los dispositivos
 * 
 * @author Verónica Terán Molina <vteran@ucm.es>
 */

require_once "configBD.php";
require_once "recomendador.php";


/**
 * Clase del modelo
 * 
 * Hereda la conexion a la base de datos desde la clase configBD
 */
class dispositivo_model extends configBD
{

	/**
	 * Devuelve el id del ultimo elemento insertado en la tabla 'dispositivos'
	 * @return array
	 */
	public function last_disp()
	{

		$query = "SELECT MAX(`disp_id`) FROM dispositivos";
		$disp_id = $this->BD->query($query) or die($this->BD->error . " en la línea " . (__LINE__ - 1));

		return $disp_id->fetch_assoc();
	}
	/**
	 * Alta dispositivo nuevo
	 * 
	 * Inserta un nuevo dispositivo en la tabla con los valores de entrada
	 * 
	 * @param string $nombre
	 * @param string $marca
	 * @param string $so
	 * @param string $pulgadas
	 * @param string $alto
	 * @param string $ancho
	 * @param string $grosor
	 * @param string $peso
	 * @param string $pantalla
	 * @param string $tipo_pantalla
	 * @param string $tasa_refresco
	 * @param string $resolucion
	 * @param string $resolucion_a
	 * @param string $resolucion_b
	 * @param string $ram
	 * @param string $memoria_interna
	 * @param string $ampliable_sd
	 * @param string $seguridad_facial
	 * @param string $seguridad_huella
	 * @param string $cam_trasera
	 * @param string $caracteristicas_cam
	 * @param string $flash
	 * @param string $estabilizacion_opt
	 * @param string $slow_motion
	 * @param string $cam_frontal
	 * @param string $cam_otras
	 * @param string $lente_teleobjetivo
	 * @param string $lente_gran_angular
	 * @param string $lente_macro
	 * @param string $infrarojos
	 * @param string $jack
	 * @param string $nfc
	 * @param string $sensores
	 * @param string $usb_tipo
	 * @param string $usb_carga
	 * @param string $usb_otg
	 * @param string $usb_masivo
	 * @param string $bateria
	 * @param string $conexion
	 * @param string $pantalla_curva
	 * @param string $resistencia
	 * @param string $carga_rapida
	 * @param string $otros
	 * @param string $fecha
	 * @param string $precio
	 * @param string $colores
	 * @param string $destacada
	 * @param string $galeria
	 * @param string $interes
	 * @return bool|mysqli_result
	 */
	public function alta_dispositivo(
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
	) {

		$query = sprintf(
			"INSERT INTO dispositivos(nombre,
			marca,
			so,
			pulgadas, 
			alto,
			ancho,
			grosor,
			peso, 
			pantalla,
			tipo_pantalla, 
			tasa_refresco, 
			resolucion, 
			resolucion_a,
			resolucion_b,
		  	ram,
		   	memoria_interna,
		 	ampliable_sd,
		  	seguridad_facial,
		   	seguridad_huella,
		    cam_trasera,
			caracteristicas_cam,
			flash,
			estabilizacion_opt,
		 	slow_motion,
		  	cam_frontal,
		   	cam_otras,
			lente_teleobjetivo,
			lente_macro,
			lente_gran_angular, 
			infrarojos,
			jack,
			nfc,
			sensores,
			usb_tipo,
		    usb_carga,
			usb_otg,
			usb_masivo,
			bateria,
			conexion, 
		  	pantalla_curva,
		    resistencia,
			carga_rapida,
			otros,
			fecha,
			precio,
			colores) VALUES ('%s','%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s','%s','%s','%s','%s', '%s', '%s', '%s', '%s', '%s','%s', '%s','%s', '%s', '%s','%s','%s','%s', '%s', '%s', '%s', '%s', '%s', '%s','%s','%s','%s','%s', '%s', '%s', '%s', '%s', '%s','%s', '%s', '%s', '%d', '%s')",
			$this->BD->real_escape_string($nombre),
			$this->BD->real_escape_string($marca),
			$this->BD->real_escape_string($so),
			$this->BD->real_escape_string($pulgadas),
			$this->BD->real_escape_string($alto),
			$this->BD->real_escape_string($ancho),
			$this->BD->real_escape_string($grosor),
			$this->BD->real_escape_string($peso),
			$this->BD->real_escape_string($pantalla),
			$this->BD->real_escape_string($tipo_pantalla),
			$this->BD->real_escape_string($tasa_refresco),
			$this->BD->real_escape_string($resolucion),
			$this->BD->real_escape_string($resolucion_a),
			$this->BD->real_escape_string($resolucion_b),
			$this->BD->real_escape_string($ram),
			$this->BD->real_escape_string($memoria_interna),
			$this->BD->real_escape_string($ampliable_sd),
			$this->BD->real_escape_string($seguridad_facial),
			$this->BD->real_escape_string($seguridad_huella),
			$this->BD->real_escape_string($cam_trasera),
			$this->BD->real_escape_string($caracteristicas_cam),
			$this->BD->real_escape_string($flash),
			$this->BD->real_escape_string($estabilizacion_opt),
			$this->BD->real_escape_string($slow_motion),
			$this->BD->real_escape_string($cam_frontal),
			$this->BD->real_escape_string($cam_otras),
			$this->BD->real_escape_string($lente_teleobjetivo),
			$this->BD->real_escape_string($lente_macro),
			$this->BD->real_escape_string($lente_gran_angular),
			$this->BD->real_escape_string($infrarojos),
			$this->BD->real_escape_string($jack),
			$this->BD->real_escape_string($nfc),
			$this->BD->real_escape_string($sensores),
			$this->BD->real_escape_string($usb_tipo),
			$this->BD->real_escape_string($usb_carga),
			$this->BD->real_escape_string($usb_otg),
			$this->BD->real_escape_string($usb_masivo),
			$this->BD->real_escape_string($bateria),
			$this->BD->real_escape_string($conexion),
			$this->BD->real_escape_string($pantalla_curva),
			$this->BD->real_escape_string($resistencia),
			$this->BD->real_escape_string($carga_rapida),
			$this->BD->real_escape_string($otros),
			$this->BD->real_escape_string($fecha),
			$this->BD->real_escape_string($precio),
			$this->BD->real_escape_string($colores),
		);

		$data = $this->BD->query($query) or die($this->BD->error . " en la línea " . (__LINE__ - 1));

		$id_ultimo_insert = mysqli_insert_id($this->BD);

		//Si insertar el dispositivo ha ido correctamente, insertamos las imagenes en la tabla correspondiente
		if ($data) {
			$query1 = sprintf("INSERT INTO galeria_disp(disp_id, imagen, destacada) VALUES ('%s','%s', '%s')", $this->BD->real_escape_string($id_ultimo_insert), $this->BD->real_escape_string($destacada), '1');

			$data1 = $this->BD->query($query1) or die($this->BD->error . " en la línea " . (__LINE__ - 1));

			if ($data1 && ($galeria != null)) {
				foreach ($galeria as $nombre) {
					$query2 = sprintf("INSERT INTO galeria_disp(disp_id, imagen, destacada) VALUES ('%s','%s', '%s')", $this->BD->real_escape_string($id_ultimo_insert), $this->BD->real_escape_string($nombre), '0');

					$data2 = $this->BD->query($query2) or die($this->BD->error . " en la línea " . (__LINE__ - 1));
				}
				//Una vez insertadas las imagenes, creamos la relacion entre el dispositivo y los intereses seleccionados	
				if ($data2) {
					foreach ($interes as $i) {
						$query3 = sprintf("INSERT INTO disp_interes(disp_id, interes_id) VALUES ('%u','%s')", $this->BD->real_escape_string($id_ultimo_insert), $this->BD->real_escape_string($i));
						$data3 = $this->BD->query($query3) or die($this->BD->error . " en la línea " . (__LINE__ - 1));
					}
					//Si todo ha ido correctamente, se inicia el proceso de recomendacion por dispositivo nuevo.
					if ($data3) {
						$last_id = $this->last_disp(); //obtenermos ultimo dispositivo insertado
						$recomendador = new Recomendador();
						$recomendador->recomendador_por_dispositivo_nuevo($last_id["MAX(`disp_id`)"]);
						return $data3;
					} else {
						return false;
					}


				}
			}
		} else {
			return false;
		}
		return $data;
	}
	/**
	 * Eliminar dispositivo
	 * 
	 * Elima el dispositivo 'disp_id' de entrada
	 * 
	 * @param int $disp_id identidicador del dispositivo
	 * @return bool|mysqli_result
	 */
	public function eliminarDispositivo($disp_id)
	{

		$query = "DELETE FROM dispositivos WHERE disp_id LIKE '$disp_id'";

		$data = $this->BD->query($query) or die($this->BD->error . " en la línea " . (__LINE__ - 1));
		return $data;
	}
	/**
	 * Existe dispositivo
	 * 
	 * Comprueba si existe el dispositivo 'disp' de entrada
	 * @param int $disp identificador de entrada
	 * @return bool
	 */
	public function existeDispositivo($disp)
	{

		$query = "SELECT nombre FROM dispositivo WHERE BINARY nombre= '$disp'";
		$data = $this->BD->query($query) or die($this->BD->error . " en la línea " . (__LINE__ - 1));

		if ($data->fetch_assoc())
			return true;
		else
			return false;
	}
	/**
	 * Modificar ficha
	 * 
	 * Modifica los datos de la ficha del dispositivo de entrada 'disp_id' con los valores de entrada
	 * @param int $disp_id
	 * @param string $nombre
	 * @param string $marca
	 * @param string $so
	 * @param string $pulgadas
	 * @param string $alto
	 * @param string $ancho
	 * @param string $grosor
	 * @param string $peso
	 * @param string $pantalla
	 * @param string $tipo_pantalla
	 * @param string $tasa_refresco
	 * @param string $resolucion
	 * @param string $resolucion_a
	 * @param string $resolucion_b
	 * @param string $ram
	 * @param string $memoria_interna
	 * @param string $ampliable_sd
	 * @param string $seguridad_facial
	 * @param string $seguridad_huella
	 * @param string $cam_trasera
	 * @param string $caracteristicas_cam
	 * @param string $flash
	 * @param string $estabilizacion_opt
	 * @param string $slow_motion
	 * @param string $cam_frontal
	 * @param string $cam_otras
	 * @param string $lente_teleobjetivo
	 * @param string $lente_gran_angular
	 * @param string $lente_macro
	 * @param string $infrarojos
	 * @param string $jack
	 * @param string $nfc
	 * @param string $sensores
	 * @param string $usb_tipo
	 * @param string $usb_carga
	 * @param string $usb_otg
	 * @param string $usb_masivo
	 * @param string $bateria
	 * @param string $conexion
	 * @param string $pantalla_curva
	 * @param string $resistencia
	 * @param string $carga_rapida
	 * @param string $otros
	 * @param string $fecha
	 * @param string $precio
	 * @param string $colores
	 * @param string $destacada
	 * @param string $galeria
	 * @param string $interes
	 * @return bool|mysqli_result
	 */
	public function modificarFicha(
		$disp_id,
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
	) {


		$query = sprintf("UPDATE dispositivos SET nombre = '%s', pulgadas ='%s', pantalla = '%s', tasa_refresco = '%s', resolucion = '%s', resolucion_a = '%s',resolucion_b = '%s', ram = '%s', memoria_interna = '%s', seguridad_facial = '%s', seguridad_huella = '%s', cam_trasera = '%s', cam_frontal = '%s', infrarojos = '%s', jack = '%s', nfc = '%s', bateria = '%s', conexion = '%s', pantalla_curva = '%s', resistencia = '%s', carga_rapida = '%s', fecha = '%s', precio = '%s', marca = '%s', so = '%s', alto = '%s', ancho = '%s', grosor = '%s', peso = '%s', tipo_pantalla = '%s', ampliable_sd = '%s', caracteristicas_cam = '%s', flash = '%s', estabilizacion_opt = '%s', slow_motion = '%s', cam_otras = '%s', sensores = '%s', colores = '%s', lente_teleobjetivo = '%s', lente_macro = '%s', lente_gran_angular = '%s', usb_tipo = '%s', usb_carga = '%s', usb_otg = '%s', usb_masivo = '%s', otros = '%s' WHERE disp_id = '$disp_id'", $this->BD->real_escape_string($nombre), $this->BD->real_escape_string($pulgadas), $this->BD->real_escape_string($pantalla), $this->BD->real_escape_string($tasa_refresco), $this->BD->real_escape_string($resolucion), $this->BD->real_escape_string($resolucion_a), $this->BD->real_escape_string($resolucion_b), $this->BD->real_escape_string($ram), $this->BD->real_escape_string($memoria_interna), $this->BD->real_escape_string($seguridad_facial), $this->BD->real_escape_string($seguridad_huella), $this->BD->real_escape_string($cam_trasera), $this->BD->real_escape_string($cam_frontal), $this->BD->real_escape_string($infrarojos), $this->BD->real_escape_string($jack), $this->BD->real_escape_string($nfc), $this->BD->real_escape_string($bateria), $this->BD->real_escape_string($conexion), $this->BD->real_escape_string($pantalla_curva), $this->BD->real_escape_string($resistencia), $this->BD->real_escape_string($carga_rapida), $this->BD->real_escape_string($fecha), $this->BD->real_escape_string($precio), $this->BD->real_escape_string($marca), $this->BD->real_escape_string($so), $this->BD->real_escape_string($alto), $this->BD->real_escape_string($ancho), $this->BD->real_escape_string($grosor), $this->BD->real_escape_string($peso), $this->BD->real_escape_string($tipo_pantalla), $this->BD->real_escape_string($ampliable_sd), $this->BD->real_escape_string($caracteristicas_cam), $this->BD->real_escape_string($flash), $this->BD->real_escape_string($estabilizacion_opt), $this->BD->real_escape_string($slow_motion), $this->BD->real_escape_string($cam_otras), $this->BD->real_escape_string($sensores), $this->BD->real_escape_string($colores), $this->BD->real_escape_string($lente_teleobjetivo), $this->BD->real_escape_string($lente_macro), $this->BD->real_escape_string($lente_gran_angular), $this->BD->real_escape_string($usb_tipo), $this->BD->real_escape_string($usb_carga), $this->BD->real_escape_string($usb_otg), $this->BD->real_escape_string($usb_masivo), $this->BD->real_escape_string($otros));

		$data = $this->BD->query($query) or die($this->BD->error . " en la línea " . (__LINE__ - 1));


		if ($data) {
			if (!empty($destacada)) {
				$query1 = sprintf("UPDATE galeria_disp SET imagen= '%s' where disp_id='$disp_id' and destacada=1", $this->BD->real_escape_string($destacada));

				$data1 = $this->BD->query($query1) or die($this->BD->error . " en la línea " . (__LINE__ - 1));
				if ($data1 && ($galeria != null)) {
					foreach ($galeria as $nombre) {
						$query2 = sprintf("UPDATE galeria_disp SET imagen='%s' where disp_id='$disp_id' and destacada=0", $this->BD->real_escape_string($nombre));

						$data2 = $this->BD->query($query2) or die($this->BD->error . " en la línea " . (__LINE__ - 1));
					}
				}
			}

			/*Si la modificacion de los datos y la imagen ha ido correctamente, eliminamos la relacion entre el dispositivo
			y los antiguos intereses y añadimos los nuevos datos*/
			if ($data) {
				$query = sprintf("DELETE FROM disp_interes WHERE disp_id='$disp_id'");
				$data = $this->BD->query($query) or die($this->BD->error . " en la línea " . (__LINE__ - 1));

				foreach ($interes as $i) {
					$query3 = sprintf("INSERT INTO disp_interes(disp_id, interes_id) VALUES ('%u','%s')", $this->BD->real_escape_string($disp_id), $this->BD->real_escape_string($i));
					$data3 = $this->BD->query($query3) or die($this->BD->error . " en la línea " . (__LINE__ - 1));

				}
				return $data3;
			} else {
				return false;
			}

		} else {
			return false;
		}
	}
	/**
	 * Obtener dispositivo
	 * 
	 * Devuelve la informacion del dispositivo 'disp' de entrada
	 * 
	 * @param int $disp identificador del dispositivo
	 * @return array|bool|null array asociativo con los campos de la consulta
	 */
	public function getDispositivo($disp)
	{

		$query = "SELECT * FROM dispositivos WHERE disp_id = '$disp'";
		$dispositivo = $this->BD->query($query) or die($this->BD->error . " en la línea " . (__LINE__ - 1));

		return $dispositivo->fetch_assoc();
	}
	/**
	 * Obtener imagen destacada
	 * 
	 * Devuelve la imagen destacada del dispositivo 'disp' de entrada
	 * 
	 * @param int $disp identificador del dispositivo
	 * @return array|bool|null array aspciativo con los campos de la consulta
	 */
	public function getDestacada($disp)
	{
		$query = "SELECT * FROM galeria_disp where disp_id='$disp' AND destacada='1'";

		$imagen = $this->BD->query($query) or die($this->BD->error . " en la línea " . (__LINE__ - 1));

		return $imagen->fetch_assoc();
	}

	/**
	 * Obtener galeria
	 * 
	 * Devuelve las iamgenes de la galeria del dispositivo 'disp'
	 * 
	 * @param int $disp identificador del dispostivo
	 * @return bool|mysqli_result array asociativo con las filas de las imagenes
	 */
	public function getGaleria($disp)
	{
		$query = "SELECT * FROM galeria_disp where disp_id='$disp' and destacada='0'";
		$gallery = $this->BD->query($query) or die($this->BD->error . " en la línea " . (__LINE__ - 1));

		return $gallery;
	}
	/**
	 * Buscar dispositivo
	 * 
	 * Devuelve la informacion de los dispositivos que coincida con el texto de entrada
	 * 
	 * @param string $texto modelo del dispositivo
	 * @return bool|mysqli_result
	 */
	public function buscarDisp($texto)
	{

		$query = "SELECT * FROM dispositivos where nombre like '%" . $texto . "%' ORDER BY nombre ASC";
		$data = $this->BD->query($query) or die($this->BD->error . " en la línea " . (__LINE__ - 1));


		return $data;
	}

	/**
	 * Obtener caracterisitcas de la camara
	 * 
	 * Devuelve el listado de caracterisitcas de la camara
	 * 
	 * @return bool|mysqli_result
	 */
	public function getCaracteristicasCam()
	{

		$query = "SELECT id, nombre FROM caracteristicas_camara ";
		$query = $this->BD->query($query) or die($this->BD->error . " en la línea " . (__LINE__ - 1));

		return $query;
	}

	/**
	 * Obtener caracteristica
	 * 
	 * Devuelve la descripcion de la caracterisitca de entrada 'c'
	 * 
	 * @param int $c identificador de la caracteristica
	 * @return array|bool|null array asociativo con los campos de la consulta
	 */
	public function getCaracteristicasCam_c($c)
	{

		$query = "SELECT nombre FROM caracteristicas_camara where id=$c ";
		$query = $this->BD->query($query) or die($this->BD->error . " en la línea " . (__LINE__ - 1));

		return $query->fetch_assoc();
	}

	/**
	 * Obtener sensor
	 * 
	 * Devuelve la descripcion del sensor de entrada 's'
	 * 
	 * @param int $s identificador del sensor
	 * @return array|bool|null
	 */
	public function getSensores_s($s)
	{

		$query = "SELECT nombre FROM detalle_sensores where id=$s ";
		$query = $this->BD->query($query) or die($this->BD->error . " en la línea " . (__LINE__ - 1));

		return $query->fetch_assoc();
	}

	/**
	 * Obtener sensores
	 * 
	 * Devuelve el listado de sensores
	 * 
	 * @return bool|mysqli_result array asociativo con los campos de la consulta
	 */
	public function getSensores()
	{

		$query = "SELECT id, nombre FROM detalle_sensores ";
		$query = $this->BD->query($query) or die($this->BD->error . " en la línea " . (__LINE__ - 1));

		return $query;
	}

	/**
	 * Obtener precios
	 * 
	 * Devuelve el listado de precios del dispositivo 'disp' de entrada
	 * 
	 * @param int $disp identificador del dispositivo
	 * @return bool|mysqli_result array asociativo con el listado de precios
	 */
	public function getListadoPrecios($disp)
	{
		$query = "SELECT `url`,`precio`,`img` FROM `precios_por_disp` WHERE `disp_id`=$disp";
		$query = $this->BD->query($query) or die($this->BD->error . " en la línea " . (__LINE__ - 1));

		return $query;
	}

	/**
	 * Obtener intereses por dispositvo
	 * 
	 * Devuelve los intereses del dispositivo 'disp' de entrada
	 * 
	 * @param int $disp identificador del dispositivo
	 * @return bool|mysqli_result array asociativo con los campos de la consulta
	 */
	public function getDispInteres($disp)
	{
		//echo var_dump($disp);
		$query = "SELECT * FROM disp_interes WHERE disp_id = '$disp'";
		$query = $this->BD->query($query) or die($this->BD->error . " en la línea " . (__LINE__ - 1));

		return $query;
	}


}