<?php
/**
 * Fichero php que implementa la vista relativa a la subida masiva de dispositivos e imagenes, y configuraciones del usuario admin
 * 
 * @author Verónica Terán Molina <vteran@ucm.es>
 */

include_once('header.php'); ?>

<div class="title">
	<h1>Carga masiva</h1>
</div>
<div class="container   p-5 mb-5 ">
	<div class="row">
		<div class="col-md-12 d-flex justify-content-center pb-5"></div>
	</div>
	<div class="row">
		<div id='button-box-upload' class="col-md-12 mb-4 pb-4 border-bottom border-2">
			<h5>Carga del documento .csv:</h5>
			<div class="col-md-12 mb-3 pb-3 ">
				Descargar la <a href="public_html/download/plantilla.csv" download>plantilla</a> a rellenar para la
				carga masiva de dispositivos.
			</div>
			<form id='upload_csv' method='post' enctype='multipart/form-data' class="needs-validation" novalidate>
				<input type="file" name="csv_file" class="form-control" id="csv_file" accept=".csv" aria-label="Upload"
					required>
				<div class="col-12 mt-2"><span id='error_csv' style="color:#c54242"></span></div>
				<div class="col-12 mt-2"><span id='result_csv'></span></div>
				<button class="btn btn-primary mt-2" type='submit' name='upload' id='upload' value='Subir CSV'>Subir
					CSV</button>
			</form>
		</div>

		<div id='button-box-upload-img' class="col-md-12  ">
			<h5>Carga de las imagenes de los dispositivos:</h5>
			<form id='upload_img' method='post' enctype='multipart/form-data' class="">
				<input type="file" name="imagenes[]" class="form-control" id="imagenes"
					accept="image/png, .jpeg, .jpg, image/gif, .webp" multiple>
				<div class="col-12 mt-2"><span id='error_img' style="color:#c54242"></span></div>
				<div class="col-12 mt-2"><span id='result_img'></span></div>
				<button class="btn btn-primary mt-2" type='submit' name='upload' id='upload'
					value='Subir imagenes'>Subir imágenes</button>
			</form>
		</div>
	</div>
</div>

<script>

	//Lectura del fichero csv
	$("#upload_csv").submit(function (e) {
		e.preventDefault();
		$("#error_csv").html("");
		$("#result_csv").html("Subiendo fichero...");
		jQuery.ajax({
			url: '../Controller/lectura_csv.php',
			method: "POST",
			data: new FormData(this),
			dataType: 'json',
			contentType: false,
			cache: false,
			processData: false,
			success: function (data) {
				//Si lectura correcta, insertamos los dispositivos
				$result = data;
				if (data.row_data) {
					for (var i = 0; i < data.row_data.length; i++) {
						var marca = data.row_data[i].marca;
						var so = data.row_data[i].so;
						var nombre = data.row_data[i].nombre;
						var colores = data.row_data[i].colores;
						var pulgadas = data.row_data[i].pulgadas;
						var alto = data.row_data[i].alto;
						var ancho = data.row_data[i].ancho;
						var grosor = data.row_data[i].grosor;
						var peso = data.row_data[i].peso;
						var pantalla = data.row_data[i].pantalla;
						var tipo_pantalla = data.row_data[i].tipo_pantalla;
						var colores = data.row_data[i].colores;
						var tasa_refresco = data.row_data[i].tasa_refresco;
						var resolucion = data.row_data[i].resolucion;
						var resolucion_a = data.row_data[i].resolucion_a;
						var resolucion_b = data.row_data[i].resolucion_b;
						var ram = data.row_data[i].ram;
						var memoria_interna = data.row_data[i].memoria_interna;
						var ampliable_sd = data.row_data[i].ampliable_sd;
						var seguridad_facial = data.row_data[i].seguridad_facial;
						var seguridad_huella = data.row_data[i].seguridad_huella;
						var cam_trasera = data.row_data[i].cam_trasera;
						var caracteristicas_cam = data.row_data[i].caracteristicas_cam;
						var flash = data.row_data[i].flash;
						var estabilizacion_opt = data.row_data[i].estabilizacion_opt;
						var slow_motion = data.row_data[i].slow_motion;
						var cam_frontal = data.row_data[i].cam_frontal;
						var cam_otras = data.row_data[i].cam_otras;
						var infrarojos = data.row_data[i].infrarojos;
						var sensores = data.row_data[i].sensores;
						var jack = data.row_data[i].jack;
						var nfc = data.row_data[i].nfc;
						var bateria = data.row_data[i].bateria;
						var conexion = data.row_data[i].conexion;
						var pantalla_curva = data.row_data[i].pantalla_curva;
						var resistencia = data.row_data[i].resistencia;
						var carga_rapida = data.row_data[i].carga_rapida;
						var fecha = data.row_data[i].fecha;
						var precio = data.row_data[i].precio;
						var lente_teleobjetivo = data.row_data[i].lente_teleobjetivo;
						var lente_macro = data.row_data[i].lente_macro;
						var lente_gran_angular = data.row_data[i].lente_gran_angular;
						var flash = data.row_data[i].flash;
						var usb_carga = data.row_data[i].usb_carga;
						var usb_otg = data.row_data[i].$usb_otg;
						var usb_tipo = data.row_data[i].usb_tipo;
						var usb_masivo = data.row_data[i].usb_masivo;
						var otros = data.row_data[i].otros;
						var destacada = data.row_data[i].destacada;
						var galeria = data.row_data[i].galeria;
						var puntos_fuertes = data.row_data[i].puntos_fuertes;

						jQuery.ajax({
							url: '../Controller/admin_controller.php',
							type: "POST",
							data: {
								nombre: nombre,
								marca: marca,
								so: so,
								pulgadas: pulgadas,
								alto: alto,
								ancho: ancho,
								grosor: grosor,
								peso: peso,
								pantalla: pantalla,
								tipo_pantalla: tipo_pantalla,
								colores: colores,
								tasa_refresco: tasa_refresco,
								resolucion: resolucion,
								resolucion_a: resolucion_a,
								resolucion_b: resolucion_b,
								ram: ram,
								memoria_interna: memoria_interna,
								ampliable_sd: ampliable_sd,
								seguridad_facial: seguridad_facial,
								seguridad_huella: seguridad_huella,
								cam_trasera: cam_trasera,
								caracteristicas_cam: caracteristicas_cam,
								flash: flash,
								estabilizacion_opt: estabilizacion_opt,
								slow_motion: slow_motion,
								cam_frontal: cam_frontal,
								cam_otras: cam_otras,
								infrarojos: infrarojos,
								sensores: sensores,
								jack: jack,
								nfc: nfc,
								bateria: bateria,
								conexion: conexion,
								pantalla_curva: pantalla_curva,
								resistencia: resistencia,
								carga_rapida: carga_rapida,
								fecha: fecha,
								precio: precio,
								lente_teleobjetivo: lente_teleobjetivo,
								lente_macro: lente_macro,
								lente_gran_angular: lente_gran_angular,
								usb_tipo: usb_tipo,
								usb_carga: usb_carga,
								usb_otg: usb_otg,
								usb_masivo: usb_masivo,
								otros: otros,
								destacada: destacada,
								galeria: galeria,
								interes: puntos_fuertes,
								accion: "carga_masiva_disp"
							},
							success: function (data) {
								$("#result_csv").html("<img src='../assets/img/comprobado.png' width= '40' height= '40' class='m-3'>¡Los dispositivos han sido añadidos correctamente!");
							},
							error: function (data) {
								$("#error_csv").html("Error carga masiva");
							},
						});
					}
				}
			},
			error: function (data) {
				console.log(data);
				$("#error_csv").html("<img src='../assets/img/notification.png' alt='' height='20' width='20' class='mx-1'>Introduzca un arhivo csv válido");

			}
		});
	});

	jQuery("#upload_img").on('submit', function (event) {
		$("#error_img").html("");
		$("#result_img").html("Subiendo imagenes...");

		event.preventDefault();
		jQuery.ajax({
			url: '../Controller/carga_imgs.php',
			type: "POST",
			data: new FormData(this),
			dataType: 'text',
			contentType: false,
			cache: false,
			processData: false,
			success: function (data) {
				console.log(data);
				if (data == 'ok') {
					$("#result_img").html("<img src='../assets/img/comprobado.png' width= '40' height= '40' class='m-3'>¡Las imagenes han sido añadidas correctamente!");
				} else {
					$("#error_img").html("<img src='../assets/img/notification.png' alt='' height='20' width='20' class='mx-1'>Introduzca un arhivo csv válido");
				}
			},
			error: function (data) { 
				$("#error_csv").html("Error carga masiva");
			}
		});
	});
</script>

<?php include_once("footer.php");
?>