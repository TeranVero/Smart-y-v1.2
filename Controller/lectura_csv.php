<?php
/**
 * Fichero php para la lectura de fichero .csv
 * 
 * @author Verónica Terán Molina <vteran@ucm.es>
 */

 include_once('dispositivo_controller.php');

 $dispositivo_controller=new dispositivo_controller();

if(!empty($_FILES['csv_file']['name'])){

	$file_data = fopen($_FILES['csv_file']['tmp_name'],'r');
	$column = fgetcsv($file_data,null,';','"','/');
	while($row = fgetcsv($file_data,null,';','"','/')){
		$row = array_map("utf8_encode", $row);
		$row_data[] = array('marca'=>$row[0],
			'so'=>$row[1],
			'nombre'=>$row[2],
			'pulgadas'=>$row[3],
			'alto'=>$row[4],
			'ancho'=>$row[5],
			'grosor'=>$row[6],
			'peso'=>$row[7],
			'pantalla'=>$row[8],
			'tipo_pantalla'=>$row[9],
			'colores' => $row[10],
			'tasa_refresco'=>$row[11],
			'resolucion_a'=>$row[12],
			'resolucion_b'=>$row[13],
			'resolucion'=>$row[14],
			'ram'=>$row[15],
			'memoria_interna'=>$row[16],
			'ampliable_sd'=>$row[17],
			'seguridad_facial'=>$row[18],
			'seguridad_huella'=>$row[19],
			'cam_trasera'=>$row[20],
			'caracteristicas_cam'=>explode(',',$row[21]),
			'flash'=>$row[22],
			'estabilizacion_opt'=>$row[23],
			'slow_motion'=>$row[24],
			'cam_frontal'=>$row[25],
			'cam_otras'=>$row[26],
			'infrarojos'=>$row[27],
			'sensores'=> explode(',',$row[28]),
			'jack'=>$row[29],
			'nfc'=>$row[30],
			'bateria'=>$row[31],
			'conexion'=>$row[32],
			'pantalla_curva'=>$row[33],
			'resistencia'=>$row[34],
			'carga_rapida'=>$row[35],
			'fecha'=>$row[36],
			'precio'=>$row[37],
			'lente_teleobjetivo'=>$row[38],
			'lente_gran_angular'=>$row[39],
			'lente_macro'=>$row[40],
			'usb_tipo'=>$row[41],
			'usb_carga'=>$row[42],
			'usb_otg'=>$row[43],
			'usb_masivo'=>$row[44],
			'otros'=>$row[45],
			'destacada' => $row[46],
			'galeria' => explode(',',$row[47]),
			'interes' => explode(',',$row[48]));
	}
	$output = array('column' => $column, 'row_data'=> $row_data);	

			if ($output['row_data']) {

				for ( $i = 0; $i < count($output['row_data']); $i++) {
					$_POST['marca'] = $output['row_data'][$i]['marca'];
					$_POST['so']= $output['row_data'][$i]['so'];
					$_POST['nombre']= $output['row_data'][$i]['nombre'];
					$_POST['colores']= $output['row_data'][$i]['colores'];
					$_POST['pulgadas']= $output['row_data'][$i]['pulgadas'];
					$_POST['alto']= $output['row_data'][$i]['alto'];
					$_POST['ancho']= $output['row_data'][$i]['ancho'];
					$_POST['grosor']= $output['row_data'][$i]['grosor'];
					$_POST['peso']= $output['row_data'][$i]['peso'];
					$_POST['pantalla']= $output['row_data'][$i]['pantalla'];
					$_POST['tipo_pantalla']= $output['row_data'][$i]['tipo_pantalla'];
					$_POST['colores']= $output['row_data'][$i]['colores'];
					$_POST['tasa_refresco']= $output['row_data'][$i]['tasa_refresco'];
					$_POST['resolucion']= $output['row_data'][$i]['resolucion'];
					$_POST['resolucion_a']= $output['row_data'][$i]['resolucion_a'];
					$_POST['resolucion_b']= $output['row_data'][$i]['resolucion_b'];
					$_POST['ram']= $output['row_data'][$i]['ram'];
					$_POST['memoria_interna']= $output['row_data'][$i]['memoria_interna'];
					$_POST['ampliable_sd']= $output['row_data'][$i]['ampliable_sd'];
					$_POST['seguridad_facial']= $output['row_data'][$i]['seguridad_facial'];
					$_POST['seguridad_huella']= $output['row_data'][$i]['seguridad_huella'];
					$_POST['cam_trasera']= $output['row_data'][$i]['cam_trasera'];
					$_POST['caracteristicas_cam']= $output['row_data'][$i]['caracteristicas_cam'];
					$_POST['flash']= $output['row_data'][$i]['flash'];
					$_POST['estabilizacion_opt']= $output['row_data'][$i]['estabilizacion_opt'];
					$_POST['slow_motion']= $output['row_data'][$i]['slow_motion'];
					$_POST['cam_frontal']= $output['row_data'][$i]['cam_frontal'];
					$_POST['cam_otras']= $output['row_data'][$i]['cam_otras'];
					$_POST['infrarojos']= $output['row_data'][$i]['infrarojos'];
					$_POST['sensores']= $output['row_data'][$i]['sensores'];
					$_POST['jack']= $output['row_data'][$i]['jack'];
					$_POST['nfc']= $output['row_data'][$i]['nfc'];
					$_POST['bateria']= $output['row_data'][$i]['bateria'];
					$_POST['conexion']= $output['row_data'][$i]['conexion'];
					$_POST['pantalla_curva']= $output['row_data'][$i]['pantalla_curva'];
					$_POST['resistencia']= $output['row_data'][$i]['resistencia'];
					$_POST['carga_rapida']= $output['row_data'][$i]['carga_rapida'];
					$_POST['fecha']= $output['row_data'][$i]['fecha'];
					$_POST['precio']= $output['row_data'][$i]['precio'];
					$_POST['lente_teleobjetivo']= $output['row_data'][$i]['lente_teleobjetivo'];
					$_POST['lente_macro']= $output['row_data'][$i]['lente_macro'];
					$_POST['lente_gran_angular']= $output['row_data'][$i]['lente_gran_angular'];
					$_POST['flash']= $output['row_data'][$i]['flash'];
					$_POST['usb_carga']= $output['row_data'][$i]['usb_carga'];
					$_POST['usb_otg']= $output['row_data'][$i]['usb_otg'];
					$_POST['usb_tipo']= $output['row_data'][$i]['usb_tipo'];
					$_POST['usb_masivo']= $output['row_data'][$i]['usb_masivo'];
					$_POST['otros']= $output['row_data'][$i]['otros'];
					$_POST['destacada']= $output['row_data'][$i]['destacada'];
					$_POST['galeria']= $output['row_data'][$i]['galeria'];
					$_POST['interes']= $output['row_data'][$i]['interes']; 

					echo $dispositivo_controller->altaDispositivo();
				}
			}

	}

?>
