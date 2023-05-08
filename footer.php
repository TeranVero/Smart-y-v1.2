<?php
/**
 * Fichero php que implementa la vista del footer
 * 
 * @author Verónica Terán Molina <vteran@ucm.es>
 */
?>
</main>
<footer id="main-footer" data-delighter>
	<div class="container-fluid border-top d-flex justify-content-center align-items-center">
		<div class="row ">
			<div class="col-12 p-3 ">
				<img src="../assets/img/logo_2.png" alt="" height="120" width="120">
			</div>
		</div>
	</div>
</footer>
</body>

</html>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
	integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
	crossorigin="anonymous"></script>

<script>
	//Boton desplazamiento arriba
	$('.arriba').click(function () {
		$('body, html').animate({
			scrollTop: '0px'
		}, 300);
	});
	$(window).scroll(function () {
		if ($(this).scrollTop() > 0) {
			$('.arriba').slideDown(300);
		} else {
			$('.arriba').slideUp(300);
		}
	});

	const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
	const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

	//Determina el tab actual del menu de navegacion para resaltar
	var URLactual = window.location.pathname; 
	URLactual = URLactual.split('/')
	if (URLactual[1] == "") {
		$('.index').addClass('active');
	} else {
		$('.' + URLactual[1]).addClass('active');
	}

	
	 //Efecto hover sobre los iconos "favorito", "no recomendar" y "usado"
	 $(".row_info").hover(function () {
		$(this).find('.icons').addClass('icons-visible');
		$(this).find('.row_icons').addClass('row_icons_style');
	}, function () {
		$(this).find('.icons').removeClass('icons-visible');
		$(this).find('.row_icons').removeClass('row_icons_style');

	});

	/***
	 * Funcionalidad AÑADIR A FAVORITOS, USADOS Y NO RECOMENDAR
	 */
	$(".icon_dislike").click(function () {
		$img = $(this).find('img');
		$this = $(this);
		$this.css("transform", "scale(1.2)");
		setTimeout(() => {
			$this.css("transform", "scale(1)");
		}, 200);
		//Si el usuario esta registrado, se llama al controlador para agregar como no recomendado
		<?php
		if (isset($_SESSION["login"]) && ($_SESSION["login"] == true)) { ?>
			$user = <?php echo $_SESSION["user_id"] ?>;
			console.log($user);
			$disp = this.id;
			$.ajax({
				url: '../Controller/mis_dispositivos_recomendaciones_controller.php',
				type: 'POST',
				data: {
					user: $user,
					disp: $disp,
					accion: 'dislike'
				},
				success: function (resp) {
					if (resp === "add") {
						$img.attr('src', '../assets/img/dislike_on.png');
						$this.tooltip('dispose');
						const bsTooltip = new bootstrap.Tooltip($this);
						bsTooltip._config.title = 'Me gusta';
					} else {
						$img.attr('src', '../assets/img/dislike_off.png');
						$this.tooltip('dispose');
						const bsTooltip = new bootstrap.Tooltip($this);
						bsTooltip._config.title = 'No recomendar';
					}
				}
			});
		<?php } else { ?>
			const toast = new bootstrap.Toast($('#alert_toast'));
			toast.show();
		<?php } ?>
	});
	$(".icon_fav").click(function () {
		$img = $(this).find('img');
		$this = $(this);
		$this.css("transform", "scale(1.2)");
		setTimeout(() => {
			$this.css("transform", "scale(1)");
		}, 200);
		<?php if (isset($_SESSION["login"]) && ($_SESSION["login"] == true)) { ?>
			$user = <?php echo $_SESSION["user_id"] ?>;
			$disp = this.id;
			$.ajax({
				url: '../Controller/mis_dispositivos_recomendaciones_controller.php',
				type: 'POST',
				data: {
					user: $user,
					disp: $disp,
					accion: 'fav'
				},
				success: function (resp) {
					console.log(resp);
					if (resp === "add") {
						$img.attr('src', '../assets/img/favorito_on.png');
						$this.tooltip('dispose');
						const bsTooltip = new bootstrap.Tooltip($this);
						bsTooltip._config.title = 'Eliminar favorito';
					} else {
						$img.attr('src', '../assets/img/favorito_off.png');
						$this.tooltip('dispose');
						const bsTooltip = new bootstrap.Tooltip($this);
						bsTooltip._config.title = 'Añadir favorito';
					}
				}
			}).then(function (resp) {
			});
		<?php } else { ?>
			const toast = new bootstrap.Toast($('#alert_toast'));
			toast.show();
		<?php } ?>
	});
	$(".icon_use").click(function () {
		$img = $(this).find('img');
		$this = $(this);
		$this.css("transform", "scale(1.2)");
		setTimeout(() => {
			$this.css("transform", "scale(1)");
		}, 200);
		<?php if (isset($_SESSION["login"]) && ($_SESSION["login"] == true)) { ?>
			$user = <?php echo $_SESSION["user_id"] ?>;
			$disp = this.id;
			$.ajax({
				url: '../Controller/mis_dispositivos_recomendaciones_controller.php',
				type: 'POST',
				data: {
					user: $user,
					disp: $disp,
					accion: 'use'
				},
				success: function (resp) {
					if (resp === "add") {
						$img.attr('src', '../assets/img/use_on.png');
						$this.tooltip('dispose');
						$this.tooltip('dispose');
						const bsTooltip = new bootstrap.Tooltip($this);
						bsTooltip._config.title = '¡Lo tengo!';
					} else {
						$img.attr('src', '../assets/img/use_off.png');
						$this.tooltip('dispose');
						$this.tooltip('dispose');
						const bsTooltip = new bootstrap.Tooltip($this);
						bsTooltip._config.title = '¡Lo tengo!';
					}
				}
			}).then(function (resp) {
			});
		<?php } else { ?>
			const toast = new bootstrap.Toast($('#alert_toast'));
			toast.show();
		<?php } ?>
	});

	//Transformacion automatica primera letra mayuscula en buscadores e inputs 
	$("input[type='search']").keyup(function () {
		var palabra = this.value;
		if (!this.value) return;
		var mayuscula = palabra.substring(0, 1).toUpperCase();
		if (palabra.length > 0) {
			var minuscula = palabra.substring(1).toLowerCase();
		}
		this.value = mayuscula.concat(minuscula);
	});


</script>
