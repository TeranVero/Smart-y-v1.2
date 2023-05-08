<?php
/**
 * Fichero php para la lectura de fichero .csv
 * 
 * @author Verónica Terán Molina <vteran@ucm.es>
 */

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
			'puntos_fuertes' => explode(',',$row[48]));
	}
	$output = array('column' => $column, 'row_data'=> $row_data);
	$arr=mb_convert_encoding($output,'ISO-8859-1','UTF-8');
	echo json_encode($arr);
}
?>
