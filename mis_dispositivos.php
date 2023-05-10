<?php
/**
 * Fichero php que implementa la vista de los dispositivos del usuario 'user'
 * 
 * @author Verónica Terán Molina <vteran@ucm.es>
 */

include_once 'Controller/user_disp_controller.php';
include_once "Controller/usuarios_controller.php";
include_once "Controller/dispositivo_controller.php";
include_once('header.php');

$user_disp_controller = new user_disp_controller();
$dispositivo_controller = new dispositivo_controller();
$usuarios_controler = new usuarios_controller();
$directorio = '../public_html/galerias/';
$texto_tootip = "";

$user = $usuarios_controler->getUser($_GET['usuario']);
$disp_array = $user_disp_controller->getDispAll($user['user_id']);
?>

<style>
    .row_icons {
        display: none !important;
    }

    @media (max-width: 575.98px) {
        .info_disp.col-md-9.d-flex.flex-column.ms-4.ms-lg-0 {
            justify-content: space-around;
            align-items: center;
        }
    }
</style>


<div class="container px-4  px-sm-0 mt-md-5 mt-4">
    <div class="row resultados ">
        <div class="col-md-3 mb-4 mb-sm-0">
            <div class="list-group mis_dispositivos">
                <a href="#" class="favoritos_link list-group-item list-group-item-action"><span
                        class="icon-star"></span> Favoritos <span class="badge text-bg-warning rounded-pill">
                        <?php echo $user_disp_controller->getFav($user['user_id'])->num_rows ?>
                    </span></a>
                <a href="#" class="usados_link list-group-item list-group-item-action"><span class="icon-phone"></span>
                    Usados <span class="badge text-bg-warning rounded-pill">
                        <?php echo $user_disp_controller->getUsed($user['user_id'])->num_rows ?>
                    </span></a>
            </div>
        </div>
        <div class="col-md-9">
            <div id='disp' class='resultado_disp  row '>
                <?php while ($disp = $disp_array->fetch_assoc()) {
                    $imagen = $dispositivo_controller->getDestacada($disp["disp_id"]);
                    include('templates/search.php');
                } ?>
            </div>
        </div>
    </div>
</div>
<script>
    $('.favoritos_link').click(function () {
        $active = $('.list-group-item.active');
        $active.removeClass('active');
        $(this).addClass('active');
        $user = <?php echo $user['user_id']; ?>;
        $(".resultado_disp").html('<span class="loader"></span>');
        $.ajax({
            type: "post",
            url: "../Controller/mis_dispositivos_recomendaciones_controller.php",
            data: {
                accion: "mostrar_favs",
                user: $user
            },
            success: function (response) {
                $('.resultado_disp').fadeIn(1000).html(response);
            }
        });

    });

    $('.usados_link').click(function () {
        $active = $('.list-group-item.active');
        $active.removeClass('active');
        $(this).addClass('active');
        $user = <?php echo $user['user_id']; ?>;
        $(".resultado_disp").html('<span class="loader"></span>');
        $.ajax({
            type: "post",
            url: "../Controller/mis_dispositivos_recomendaciones_controller.php",
            data: {
                accion: "mostrar_usados",
                user: $user
            },
            success: function (response) {
                $('.resultado_disp').fadeIn(1000).html(response);
            }
        });

    });
</script>

<?php
include("footer.php"); ?>