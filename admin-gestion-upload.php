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
				Descargar la <a href="../public_html/download/plantilla.csv" download>plantilla</a> a rellenar para la
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
				$("#result_csv").html("<img src='../assets/img/comprobado.png' width= '40' height= '40' class='m-3'>¡Los dispositivos han sido añadidos correctamente!");
			},
			error: function (data) {
				console.log(data);
				$("#result_csv").html("");
				$("#error_csv").html("<img src='../assets/img/notification.png' alt='' height='20' width='20' class='mx-1'>Error con el archivo");

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