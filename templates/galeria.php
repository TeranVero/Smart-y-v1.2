<?php
/**
 * Plantilla php que implementa la vista de la galeria de imagenes de cada dispositivo
 * 
 * @author Verónica Terán Molina <vteran@ucm.es>
 */

$directorio = '../public_html/galerias/'; //Directorio raiz donde se almacenan las imagenes de los dispositivos
?>
<div class="gallery ">
  <div class="gallery_image d-flex flex-wrap">
    <a data-fancybox="gallery" class="d-flex justify-content-center"
      href="<?php echo $directorio . $destacada['imagen'] ?>">
      <div class="gallery_div d-flex justify-content-center">
        <img class="rounded border p-2 img_gallery" src="<?php echo $directorio . $destacada['imagen'] ?>" />
        <span class="plus border rounded-pill p-2 icon-images"></span>
      </div>
    </a>
    <div class="d-none">
      <?php while ($row = $gallery->fetch_assoc()) { ?>
        <a data-fancybox="gallery" href="<?php echo $directorio . $row['imagen'] ?>">
          <img class="rounded" src="<?php echo $directorio . $row['imagen'] ?>" />
        </a>
      <?php } ?>
    </div>
  </div>

</div>

<script type="module">
  import { Fancybox } from "../node_modules/@fancyapps/ui/src/Fancybox/Fancybox.js";
</script>