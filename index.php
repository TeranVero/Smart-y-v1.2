<?php
/**
 * Fichero php que implementa la vista index
 * 
 * @author Verónica Terán Molina <vteran@ucm.es>
 */

include_once('header.php');

?>

<style>
#sub_menu{
	display: none !important;
}
</style>
<div class="container  ">
	<div class="row resultado_busqueda">
		<div class=" col-md-10">
		</div>
	</div>
	<div class=" mx-lg-5 mx-2 row wrapper   my-5">
			<div class="chat_title col-md-12">
				<span>Asistente Smart-y</span>
			</div>

			<div class="form_chatbot pt-3" id="form_chatbot_id">
				<div class="bot-inbox inbox">
					<div class="icon">
						<img src="../assets/img/idea.png" alt="funny GIF">
					</div>
					<div class="msg-header">
						<p>¡Hola! Bienvenido a <strong>Smart-y</strong></p>
					</div>
				</div>
			</div>
				<div class="col-md-12 sugerencias d-flex pb-1 d-none">
					<button class=" w-auto rounded-pill bg-secondary-subtle text-reset px-2 me-2 border d-flex justify-content-center align-items-center text-decoration-none sugerencia" disabled>Adelante</button>
					<button class=" w-auto rounded-pill bg-secondary-subtle text-reset px-2 me-2 border d-flex justify-content-center align-items-center text-decoration-none sugerencia" disabled>Si</button>
					<button class=" w-auto rounded-pill bg-secondary-subtle text-reset px-2 me-2 border d-flex justify-content-center align-items-center text-decoration-none  sugerencia" disabled>Ayuda</button>

				</div>
			<div class=" typing-field input-data">
				<div class="col-md-11 pe-0">
					<form action="javascript:void(0)" method="post" id="send_form" class="send">
						<input type="search" class="form-control send" placeholder="Escribe algo aquí.." id="data" 2aria-label="Search" name="text">
					</form>
				</div>
				<div class="col-md-1 p-0 text-center">
					<a href="javascript:void(0)" class="send_btn"><img src="../assets/img/enviar.png" width="35" height="35"></a>
				</div>
			</div>
	</div>

</div>
<?php
include_once("footer.php");
?>


