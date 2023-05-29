<?php
/**
 * Fichero php que implementa la vista de los contactos
 * 
 * @author Verónica Terán Molina <vteran@ucm.es>
 */

include_once 'Controller/usuarios_controller.php';
include_once('header.php');


$usuarios_controller = new usuarios_controller();
$directorio = '../public_html/galerias/';
$texto_tootip = "";

$user = $usuarios_controller->getUser($_GET['usuario']);
$user_contactos = $usuarios_controller->obtenerContactos($user["user_id"]);
?>

<!--Modal AGREGAR CONTACTO-->
<div class="modal fade" id="modal_agregar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg ">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Agregar contacto nuevo</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class=" col-12 col-lg-9 my-3 d-flex" role="search">
                    <input class="form-control me-2" id="buscar_usuario" type="search" placeholder="Buscar usuario"
                        aria-label="Buscar">
                    <button class="btn btn-outline-primary" id="buscar" onclick="buscar_usuario();">Buscar</button>
                </div>
                <div class="result_modal">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="agregar_contacto();">Agregar</button>
            </div>
        </div>
    </div>
</div>

<div class="container px-4 px-md-0 ">
    <div class="row mb-lg-5">
        <div class=" col-12 col-lg-9 my-3 d-flex" role="search">
            <input class="form-control me-2" id="buscar_contacto" type="search" placeholder="Nombre contacto"
                aria-label="Buscar">
            <button class="btn btn-outline-primary" id="buscar" onclick="buscar_contacto();">Buscar contactos</button>
        </div>
        <div class="col-lg-3 col-12 d-flex justify-content-center mb-5 mb-lg-0">
            <button type="button" class=" border agregar-contactos " data-bs-toggle="modal"
                data-bs-target="#modal_agregar">
                <img src='../assets/img/add-contact.png' height='30' width='35'> Agregar contactos
            </button>
        </div>
    </div>
    <div class="row gx-5" id="result">
        <?php while ($contacto = $user_contactos->fetch_assoc()) { ?>
            <div class="col-sm-6 ">
                <div class="card user-card-full">
                    <div class="row">
                        <div class="col-md-3  contact-profile">
                            <div class="card-block text-center text-white">
                                <div class="avatar_perfil m-auto">
                                    <?php $img = $usuarios_controller->getAvatarUser($contacto["nombreUsuario"]) ?>
                                    <img src="../public_html/galerias/<?php echo $img ?>" class="img-radius"
                                        alt="User-Profile-Image">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <?php echo $contacto["nombreUsuario"] ?>
                                </h5>
                                <h6 class="card-text">
                                    <?php echo $contacto["nombre"] ?>
                                    <?php echo $contacto["apellidos"] ?>
                                </h6>
                                <p class="card-text"><small class="text-muted">
                                        <?php echo $contacto["email"] ?>
                                    </small></p>
                                <button type="button" class="eliminar-contacto"
                                    id="<?php echo $contacto["contacto_id"] ?>" onclick="eliminar_contacto(<?php echo $contacto['contacto_id'] ?>);">Eliminar</button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<?php include_once("footer.php"); ?>

<script>
    let contacto_id = '';

    $(document).ajaxComplete(function () {
        $('input[name="listGroupRadioGrid"]').click(function () {
            contacto_id = this.id;
        })

    });

    $(".agregar-contactos").click(function () {
        var nombre = '';
        $.ajax({
            type: "POST",
            url: "../Controller/admin_controller.php",
            cache: false,
            data: {
                nombre: nombre,
                accion: "buscar_usuario"
            }
        }).done(function (data, text, jqr) {
            $(".result_modal").html(data);

        });
    });
    function agregar_contacto() {
        $.ajax({
            type: "POST",
            url: "../Controller/contactos_controller.php",
            cache: false,
            data: {
                contacto_id: contacto_id,
                user_id: <?php echo $user["user_id"]; ?>,
                accion: "añadir_contacto"
            },
        }).done(function (respuesta) {
            if (respuesta == 1) {
                const modal = document.getElementById('modal_agregar')
                modal.addEventListener('hidden.bs.modal', event => {
                    location.reload();
                })
                const toast = new bootstrap.Toast($('#contact_add_ok_toast'));
                toast.show();

            } else {
                alert(respuesta);
            }
        });
    }
    //Funcion utilizada dentro del modal para agregar un nuevo contacto, dado que la busqueda la realiza sobre los usuarios en general
    function buscar_usuario() {
        var nombre = $("#buscar_usuario").val();
        $.ajax({
            type: "POST",
            url: "../Controller/admin_controller.php",
            cache: false,
            data: {
                nombre: nombre,
                accion: "buscar_usuario"
            }
        }).done(function (data, text, jqr) {
            $(".result_modal").html(data);
        });

    }
//Funcion utilizada para la busqueda exclusiva entre  los contactos del usuario
    function buscar_contacto(){
        var nombre = $("#buscar_contacto").val();
        $.ajax({
            type: "POST",
            url: "../Controller/contactos_controller.php",
            cache: false,
            data: {
                nombre: nombre,
                user_id: <?php echo $user["user_id"]; ?>,
                accion: "buscar_contactos"
            }
        }).done(function (data, text, jqr) {
            $("#result").html(data);
        });
    }

 

   function eliminar_contacto($id){
        $contacto_id = $id;
        $(".eliminar-contacto").addClass('disabled',true);
        $.ajax({
            type: "POST",
            url: "../Controller/contactos_controller.php",
            cache: false,
            data: {
                contacto_id: $contacto_id,
                user_id: <?php echo $user["user_id"]; ?>,
                accion: "eliminar_contacto"
            },
        }).done(function (respuesta) {
            buscar_contacto();
        });
}
</script>