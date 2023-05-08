<?php
/**
 * Fichero php para procesar subida masiva imagenes
 * 
 * @author Verónica Terán Molina <vteran@ucm.es>
 */

$directorio = '../public_html/galerias/';
$msg='ok';

$cont=0;
if(!empty($_FILES['imagenes']['name'][$cont])){
	while($cont<count($_FILES['imagenes']['name'])){
	move_uploaded_file($_FILES['imagenes']["tmp_name"][$cont], $directorio.$_FILES['imagenes']["name"][$cont]);
	$cont++;
}
}else{
	$msg='error';

}

echo $msg;

?>
