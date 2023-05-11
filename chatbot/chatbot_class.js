// CLASE JS PARA LA CONFIGURACIÓN DEL CHATBOT DE INICIO
class Chatbot {

	/** Repersenta el objeto chatbot
	* @constructor */
	constructor() {
		/** 
		 @param {int} textnum_questions define el numero de preguntas maxumo del cuestionario //0..15
		 */
		this.num_questions = 16
		/** 
 @param {string} name define el numero de preguntas maxumo del cuestionario //0..15
 */
		this.name = "";
		/** 
 @param {int} cont define el numero de preguntas maxumo del cuestionario //0..15
 */
		this.cont = 0
		/** 
 @param {Array} responses define el numero de preguntas maxumo del cuestionario //0..15
 */
		this.responses = [];
	}

	/**
	 * 
	 * @returns numero de preguntas del asistente
	 */
	getNum_questions() {
		return this.num_questions;
	}
	/**
	 * 
	 * @returns nombre aportado por el usuario
	 */
	getName() {
		return this.name;
	}
	/**
	 * 
	 * @param {string} text Nombre introducido por el usuario
	 */
	setName(text) {
		this.name = text;
	}
	/**
	 * 
	 * @returns contador de pregunta actual
	 */
	getCont() {
		return this.cont;
	}
	/**
	 * 
	 * @param {*} cont Contador de pregunta actual
	 */
	setCont(cont) {
		this.cont = cont;
	}
	/**
	 * 
	 * @returns array con las respuestas del usuario
	 */
	getResponses() {
		return this.responses;
	}

	/**
	 * Almacena la respuesta del usuario a la pregunta actual
	 * @param {*} cont Contador de pregunta actual
	 * @param {*} value Valor numerico de la respues del usuario
	 */
	setResponses(cont, value) {
		this.responses[cont] = value;
	}

	/**
	 * Concatena el string recibido a la cadena de mensaje enviados por el chat.
	 * @param {*} text Mensaje
	 */
	add(text) {
		$(".form_chatbot").append(text);
		$(".form_chatbot").scrollTop($(".form_chatbot")[0].scrollHeight);
	}

	/**
	 * Función para simular interacción y la escritura del asistente
	 */
	typing() {
		var replay = '<div class="bot-inbox inbox dots"><div class="icon"><img src="../assets/img/idea.png" alt="funny GIF"></div><div class="px-3"><span class="writing"></span></div></div>';
		this.add(replay);
		$('.send').attr('disabled', true);//Deshabilitamos el input de entrada de mensajes mientras el asistente esta escribiendo 
	}

	/**
	 * Función que conforma el mensaje que envia el asistente al usuario
	 * @param {*} result 
	 */
	mensaje(result) {
		var replay = '<div class="bot-inbox inbox"><div class="icon"><img src="../assets/img/idea.png" alt="funny GIF"></div><div class="msg-header"><p>' + result + '</p></div></div>';
		this.add(replay);
	}

	/**
	 * Función encargada de generar y enviar las diferentes preguntas del asistente al usuario
	 */
	question() {
		var disp_id = "";
		this.typing();
		if (this.cont <= this.num_questions - 1) { //Si el contador es menor que el numero total de preguntas, accedemos a la base de datos para mostrar la pregunta
			var cont=this.cont;
			var documento=$(documento);
			setTimeout(() => {
				var http = new XMLHttpRequest();
				var url = "chatbot/chatbot_controller.php";
				var cont = this.cont;
				var params = "text=&cont=" + this.cont + "&accion=pregunta";
				http.open("POST", url, true); //Llamada al archivo "chatbotBD" para traer de la base de datos para mostrar la siguiente pregunta
				http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				http.send(params);
				http.onreadystatechange = function () { //Si la respuesta del servidor es correcta mostramos la pregunta con las diferentes opciones
					if (http.readyState == 4 && http.status == 200) {
						var replay = '<div class="bot-inbox inbox"><div class="icon"><img src="../assets/img/idea.png" alt="funny GIF"></div><div class="msg-header"><p>' + http.responseText + '</p></div></div>';
						$(".form_chatbot").append(replay);
						$(".form_chatbot").scrollTop($(".form_chatbot")[0].scrollHeight);
						$(".dots").hide();//Escondemos los puntos suspensivos del asistente
						$('.send').attr('disabled', false);//habilitamos input de entrada del usuario.
						$('.send').focus();
					}
				}

			}, 2000);
		} else { //Si se ha llegado a la última pregunta, se muestra el resultado obtenido
			setTimeout(() => {
				var resultado = JSON.stringify(this.responses);
				var http = new XMLHttpRequest();
				var url = "../chatbot/chatbot_controller.php";
				var cont = this.cont;
				var params = "resultado=" + resultado + "&accion=resultado";
				//Llamada al archivo "chatbotBD" para obtener de la BBDD los ids de acuerdo al filtrado aportado por el usuario.
				http.open("POST", url, true);
				http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				http.send(params);

				http.onreadystatechange = function () {//Si la respuesta del servidor es correcta, mostramos el mensaje con la recomendación encontrada
					if (http.readyState == 4 && http.status == 200) {
						var response = http.responseText;
						if (response.length != 0) {
							var text = "<p><span>¡Enhorabuena! Hemos encontrado estos dispositivos que pueden ser perfectos para ti! Si quieres seguir <strong>recomendaciones personalizadas</strong> y estar al dia de las últimas novedades, ¡se <strong><em>Smart-y</em></strong> y registrate <strong><a href='../registro' data-bs-toggle='tooltip' data-bs-title='Resgistraté'> AQUÍ </strong></a>!</span></p><button class='btn_result border rounded m-2 text-center'>¡Ver recomendación!</button>";
							var replay = '<div class="bot-inbox inbox"><div class="icon"><img src="../assets/img/idea.png" alt="funny GIF"></div><div class="msg-header">' + text + '</div></div>';
							$(".form_chatbot").append(replay);
							$(".form_chatbot").scrollTop($(".form_chatbot")[0].scrollHeight); $(".dots").hide();
							window.sessionStorage.setItem("result", response);
							//Cuando se pulsa en el botón "Ver recomendacion" se redirige a la vista de las recomendaciones
							$('.btn_result').click(function (e) {
								e.preventDefault();
								window.location.href = '../recomendacion_asistente?id=' + response;
							});


						} else { //Si no se ha encontrado una recomendación que cumpla todos los requisitos, el asistente muestra un mensaje informativo
							var text = "¡Vaya! Nuesta base de datos esta algo limitada actualmente y me temo que no hemos encontrado un dispositivo que cumpla todos esos requisitos...¿Quieres volver a intentarlo? Si lo prefieres puedes buscar tú mismo <a href='/busqueda.php?texto='''><strong>aquí</strong></a> <button class='btn btn_reset border rounded m-2 text-center bg-light-subtle'>Intentar de nuevo!</button>";
							var replay = '<div class="bot-inbox inbox"><div class="icon"><img src="../assets/img/idea.png" alt="funny GIF"></div><div class="msg-header"><p>' + text + '</p></div></div>';
							$(".form_chatbot").append(replay);
							$(".form_chatbot").scrollTop($(".form_chatbot")[0].scrollHeight); $(".dots").hide();
							window.sessionStorage.removeItem("result")
						}
					}
				}

			}, 4000);
		}
	}

	/**
	 * Fución que envia la opción de respuesta del usuario pulsada por el usuario
	 * @param {*} value String de la opcion seleccionada
	 * @param {*} id Identificador de la opcion seleccionada
	 * @param {*} name Identificador de la pregunta contestada

	 */
	response(value, id, name) {
		if(name<this.cont){
			var msg = '<div class="user-inbox inbox"><div class="msg-header"><p>' + value + '</p></div></div>';
			this.add(msg);
			this.setResponses(name,id);
			this.question();

		}else{
			var msg = '<div class="user-inbox inbox"><div class="msg-header"><p>' + value + '</p></div></div>';
			this.add(msg);
			this.setResponses(this.cont,id);
			//Una vez almacenada, aumentamos cont para mostrar la siguiente pregunta
			this.cont++;
			this.question();
		}

	}

	/**
	 * Funcion para la escucha del  usuario 
	 */
	listen() {
		var value = $("#data").val();
		var msg = '<div class="user-inbox inbox"><div class="msg-header"><p>' + value + '</p></div></div>';
		this.add(msg);
		$("#data").val("");
		//La primera entrada que se espera recibir es el nombre del usuario, si esta completo, se inicia la conversación
		if (this.name === "") {
			this.name = value;
			window.sessionStorage.setItem('name', this.name);
			this.typing();
			setTimeout(() => {
				this.mensaje("¡Encantado, " + value + "!");
				var msg = '¿Estas listo? Prueba a escribir "Si" o "Adelante" en el cuadro de texto de abajo, o escribe "Ayuda"';
				this.mensaje(msg);//Comienza el proceso de recomendacion
				$(".dots").hide();
				$('.send').attr('disabled', false);
				$('.send').focus();
			}, 2000);
			$(".sugerencias").removeClass('d-none');
			$('.sugerencia').attr('disabled', false);//Deshabilitamos el input de sugerencias
		}//Una vez el nomnbre esta completo se inicia la converdación, si la entrada es un "Si", empieza el proceso de recomendación
		else{
			if (value.toUpperCase() === "si".toUpperCase() || value.toUpperCase() === "adelante".toUpperCase()) {
				if (window.localStorage.getItem("recomendacion") == null) {
					window.localStorage.setItem("recomendacion", 1);
					this.mensaje('<p>¡Empezamos!</p>');
				}
				this.question(this.cont);//Enviamos la primera pregunta.
			} else if (value.toUpperCase() === "ayuda".toUpperCase()) {//Si el usuario escribe en algun momento el texto ayuda, se envia el siguiente mensaje
				msg = '<p>Contesta a cada pregunta pulsando sobre una de las posibles opciones que aparecen, de acuerdo a lo que más se acerque a tus necesidades</p><p>Al completar todas las respuestas ¡sabremos si hemos contrado tu dispositivo ideal!';
				this.mensaje(msg);
			} else {//Si el usuario escribe algun otro texto que no espera escuchar el asistente, muestra el siguiente mensaje
				msg = '<p>Lo siento, no puedo ayudarte. Escribe "Ayuda" o empieza el test.</p>';
				this.mensaje(msg);
			}
		}
	}

	/**
	 * Función que inicia el proceso de recomendación asistida
	 */
	run() {
		this.typing();
		var chat = this;
		setTimeout(() => {
			$(".dots").hide();
			var msg = "Sabemos lo dificil que puede ser encontrar el teléfono móvil perfecto... y más ¡si no entiendo lo que busco!";
			chat.mensaje(msg);
			this.typing();
		}, 2000);
		setTimeout(() => {
			var msg = "Gracias a <strong>16 sencillas preguntas</strong> te ayudaremos a encotrar el dispositivo más adecuado para tus necesidades, tu solo dinos que quieres y nosotros nos encargamos del resto"
			chat.mensaje(msg);
			$(".dots").hide();
			this.typing();
		}, 4000);
		setTimeout(() => {
			var msg = "Pero primero ¿Como te llamas?";
			chat.mensaje(msg);
			$(".dots").hide();
			$('.send').attr('disabled', false);
			$('.send').focus();
		}, 8000);
	}
}


$(document).ready(function () {
	
	var target = document.getElementById('form_chatbot_id');
	// Se crea un observador se los siguientes eventos
	var config = { attributes: true, childList: true, subtree: true };
	var observer = new MutationObserver(function (mutationRecords, observer) {
		
		$('.btn_respuesta').off('click');
		$(".btn_respuesta").on("click", function () {
			myChatbot.response(this.value, this.id,this.name);
		});

		$('.btn_reset').off('click');
		$(".btn_reset").on("click", function () {
			//Inicializamos a 0 todas las variables que determinan las preguntas y resultados.
			$cont = 0;
			myChatbot.cont = 0;
			$respuestas = [];
			myChatbot.question();//Volvemos a relalizar las preguntas.

		});


	});

	$(".send").on("submit", function () {

		myChatbot.listen();
	});
	$(".send_btn").on("click", function () {

		myChatbot.listen();
	});
	$(".sugerencia").on("click", function(){
		$("#data").val(this.innerHTML);
		myChatbot.listen();
	});

	observer.observe(target, config);
	let myChatbot = new Chatbot();
	myChatbot.run();
});
