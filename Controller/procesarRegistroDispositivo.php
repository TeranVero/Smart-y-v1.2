<?php
/**
 * Fichero php para procesar el registro de dispositivos
 * 
 * @author Verónica Terán Molina <vteran@ucm.es>
 */


include_once "dispositivo_controller.php"; 
$directorio = '../public_html/galerias/';
$dispositivo_controller = new dispositivo_controller();


//Almacenamos la imagen destacada en la variable global $_POST para poder usarla al guardar en la bbdd
if(empty($_POST['destacada']))
{
$_POST['destacada']=$_FILES['destacada']['name'];
}
if(empty($_POST['galeria'])){
if(!empty($_FILES['galeria'])){
	$_POST['galeria'] = $_FILES['galeria']['name'];
}
}

//Una vez insertado el dispositivo, almacenamos las imagenes en el servidor
if($dispositivo_controller->altaDispositivo()) {
	move_uploaded_file($_FILES['destacada']["tmp_name"], $directorio.$_FILES['destacada']["name"]);
	if(!empty($_POST['galeria'])){
		$cont=0;
		while($cont < count($_FILES['galeria']["name"])){
			move_uploaded_file($_FILES['galeria']["tmp_name"][$cont], $directorio.$_FILES['galeria']["name"][$cont]);
			$cont++;
		}
	}
	echo 1;
}else{
	echo 0;
}





?>
