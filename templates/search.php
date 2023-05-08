<?php
/**
 * Plantilla php que implementa la vista del listado de dispositivos
 * 
 * @author Verónica Terán Molina <vteran@ucm.es>
 */

?>
<div class="col-md-4 col-12 row_info mb-3 " value="<?php echo $disp['disp_id'] ?>"
	id="disp-<?php echo $disp['disp_id'] ?>">
	<div class="link_ficha border rounded  m-3 justify-content-center p-3">
		<a class=" " href="/ficha_disp/<?php echo $disp['disp_id'] ?>" id="<?php echo $disp['nombre'] ?>">
			<div class="row justify-content-center">
				<?php if ($imagen != NULL) { ?>
					<img class='img_disp col-4  col-md-3' src='<?php echo $directorio . $imagen['imagen'] ?>' height='70'
						width='70'>
				<?php } ?>
				<div class="info_disp col-md-9 col-9 d-flex flex-column ms-md-4 ms-lg-0 text-center">
					<div class="title_disp border-bottom"><span>
							<?php echo $disp["nombre"]; ?>
						</span></div>
					<div class="other_disp d-flex flex-column pt-2">
						<span class="text-center">
							<?php echo $disp["marca"]; ?>
						</span>

						<span class="text-center">
							<?php echo $disp["memoria_interna"]; ?>GB <img src='../assets/img/separador.png' height="10"
								width="10">
							<?php echo $disp["ram"]; ?>GB
						</span>

					</div>
				</div>
			</div>
		</a>
		<div class="row_icons icons border rounded">
			<?php
			if (isset($_SESSION['user_id']) && $user_disp_controller->isFav($_SESSION['user_id'], $disp['disp_id'])) { ?>
				<div class="icon_fav icon" id='<?php echo $disp['disp_id'] ?>' data-bs-toggle="tooltip"
					data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Eliminar favorito">
					<img src="../assets/img/favorito_on.png" width="40" height="40">
				</div>
			<?php } else { ?>
				<div class="icon_fav icon" id='<?php echo $disp['disp_id']; ?>' data-bs-toggle="tooltip"
					data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Añadir favorito">
					<img src="../assets/img/favorito_off.png" width="40" height="40">
				</div>
			<?php } ?>
			<?php if (isset($_SESSION['user_id']) && $user_disp_controller->isUsed($_SESSION['user_id'], $disp['disp_id'])) { ?>
				<div class="icon_use border-end pe-2 icon" id='<?php echo $disp['disp_id'] ?>' data-bs-toggle="tooltip"
					data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="¡Lo tengo!">
					<img src="../assets/img/use_on.png" width="40" height="40">
				</div>
			<?php } else { ?>
				<div class="icon_use border-end pe-2 icon" id='<?php echo $disp['disp_id']; ?>' data-bs-toggle="tooltip"
					data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="¡Lo tengo!">
					<img src="../assets/img/use_off.png" width="40" height="40">
				</div>
			<?php } ?>
			<?php if (isset($_SESSION['user_id']) && $user_disp_controller->isDislike($_SESSION['user_id'], $disp['disp_id'])) { ?>
				<div class="icon_dislike icon" id='<?php echo $disp['disp_id'] ?>' data-bs-toggle="tooltip"
					data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Me gusta">
					<img src="../assets/img/dislike_on.png" width="35" height="35">
				</div>
			<?php } else { ?>
				<div class="icon_dislike icon" id='<?php echo $disp['disp_id']; ?>' data-bs-toggle="tooltip"
					data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="No recomendar">
					<img src="../assets/img/dislike_off.png" width="35" height="35">
				</div>
			<?php } ?>
		</div>
		<div class="row justify-content-center">
			<button class="col-3 position-absolute  rounded-pill  eliminar-recomendacion" id="<?php echo $disp['disp_id'] ?>">
				Eliminar
			</button>
			<button class="col-7 rounded  guardar-recomendacion bg-success bg-gradient" id="<?php echo $disp['disp_id'] ?>">
				Guardar recomendación
			</button>
		</div>
	</div>

</div>