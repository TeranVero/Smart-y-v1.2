<?php
/**
 * Clase donde se implementan los dos metodos para la recomendación intelogente  existentes en el sistema
 * 
 *  - Recomendador por nuevo dispositivo: al añadir nuevo dispositivo, se recomendará éste a aquellos usuarios que
 *    dispongan de uno o más similares a los del nuevo dispositivo
 *  - Recomendador por usuarios: se recomendaran los dispositivos favoritos del usuario 1 a todos los usuarios cercanos
 *  a éste. Se considerará como usuario cercano todo aquel usuario que cumpla con los requisitos en un 75% o más
 * 
 * @author Verónica Terán Molina <vteran@ucm.es>
 */

require_once "usuarios_model.php";
require_once "dispositivo_model.php";
require_once "user_disp_model.php";

/**
 * Clase Recomendador
 */
class Recomendador
{

    /**
     * Modelo de los usuarios
     * @var usuarios_model
     */
    private $usuarios_model;
    /**
     * Modelo de los dispositivos
     * @var dispositivo_model
     */
    private $dispositivo_model;
    /**
     * Modelo de las relaciones entre dispositivos y usuarios
     * @var user_disp_model
     */
    private $user_disp_model;


    /**
     * Constructor de la clase
     * 
     * Se inicializan los diferentes modelos
     */
    public function __construct()
    {
        $this->usuarios_model = new usuarios_model();
        $this->dispositivo_model = new dispositivo_model();
        $this->user_disp_model = new user_disp_model();
    }

    /**
     * Recomendar a usuario
     * 
     * Metodo que devuelve true si el usuario 'user_1' es cercano al usuario 'user_2' para recomendar
     * 
     * @param int $user_1 identificador de usuario
     * @param int $user_2 identificador del usuario
     * @return bool
     */
    public function es_cercano($user_1, $user_2)
    {
        $info_usuario1 = $this->usuarios_model->getUser_id($user_1);
        $info_usuario2 = $this->usuarios_model->getUser_id($user_2);
        $recomendar = false;

        /*Se comprueba si la diferencia de edad entre user_1 y user_2 es de un rango [-5,+5]*/
        $date_user_1 = new DateTime($info_usuario1["fecha"]);
        $date_user_2 = new DateTime($info_usuario2["fecha"]);

        $rango_edad = $date_user_1->diff($date_user_2);
        if ($rango_edad->y == 5) { //Si la diferencia esta dentro del rango, se contabiliza el 100%
            $total_edad = 100;
        } else
            $total_edad = 0;

        /*Se comprueba el porcentaje de intereses similares entre user_1 y user_2*/
        $intereses_user_1 = $this->usuarios_model->getInteresesUser($user_1);
        $intereses_user_2 = $this->usuarios_model->getInteresesUser($user_2);
        $array1 = [];
        while ($u = $intereses_user_1->fetch_assoc()) {
            array_push($array1, $u["interes_id"]);
        }
        $array2 = [];
        while ($d = $intereses_user_2->fetch_assoc()) {
            array_push($array2, $d["interes_id"]);
        }
        $interes_comun = count(array_intersect($array1, $array2));
        if ($intereses_user_1->num_rows != 0) {
            $total_interes = ($interes_comun * 100) / $intereses_user_1->num_rows; //Porcentaje de intereses similares
        } else {
            $total_interes = 0;
        }

        /*Se comprueba el porcentaje de marcas similares entre user_1 y user_2*/
        $marcas_user_1 = $this->usuarios_model->getMarcasUser($user_1);
        $marcas_user_2 = $this->usuarios_model->getMarcasUser($user_2);
        while ($u = $marcas_user_1->fetch_assoc()) {
            array_push($array1, $u["marca_id"]);
        }
        $array2 = [];
        while ($d = $marcas_user_2->fetch_assoc()) {
            array_push($array2, $d["marca_id"]);
        }
        $marcas_comun = count(array_intersect($array1, $array2));
        if ($marcas_user_1->num_rows != 0) {
            $total_marcas = ($marcas_comun * 100) / $marcas_user_1->num_rows;
        } else {
            $total_marcas = 0;
        }

        /*Se comprueba la ocupacion de user_1 y user_2*/
        $ocp_user_1 = $info_usuario1["ocupacion"];
        $ocp_user_2 = $info_usuario2["ocupacion"];
        if ($ocp_user_1 == $ocp_user_2) {
            $total_ocupacion = 100; //Si los dos usuarios tienen la misma ocpacion, se contabiliza el 100%
        } else {
            $total_ocupacion = 0;
        }

        //A continuacion se calcula la cercania de los usuarios de acuerdo a los pesos que tiene cada atributo
        $suma_total = (0.1 * $total_edad) + (0.5 * $total_interes) + (0.35 * $total_marcas) + (0.05 * $total_ocupacion);

        if ($suma_total >= 75) {
            $recomendar = true;
        }

        return $recomendar;
    }




    /**
     * Recomendador por usuarios cercanos
     * 
     * Algoritmo de recomendacion  por usuarios cercanos. Si el tipo de recomendacion equivale a "fav" por ser nuevo dispositivo favorito, 
     * entonces se recomienda el nuevo dispositivo favorito del usuario 'user_id_1' a los usuarios cercanos. 
     * En caso contrario, por ser modificacion de informacion del perfil o por alta de nuevo usuario, se realiza una recomendacion mutua entre los usuarios "cercanos"
     * de todos los dispositivos favoritos.
     * 
     * @param int $user_id_1 identificador del usuario
     * @param int $disp id dispositivo 
     * @param string tipo de recomendacion
     * @return void
     */
    public function recomendador_por_usuarios($user_id_1, $disp, $tipo_recomendacion)
    {
        $list_usuarios = $this->usuarios_model->getRestoUsers($user_id_1);
        $info_disp = $this->dispositivo_model->getDispositivo($disp);
        $porcentaje_users = ($list_usuarios->num_rows * 0.75);
        if ($tipo_recomendacion === "fav") {
            while ($user_2 = $list_usuarios->fetch_assoc()) {
                if ($this->es_cercano($user_id_1, $user_2["user_id"])) {
                    /* Si el usuario 'user_2' es cercano, se recomienda el dispositivo 'fav' siempre y cuando
                    no este dentro del listado de favoritos ni de recomendaciones del usuario 'user_2'
                    */
                    if (!$this->user_disp_model->isFav($user_2["user_id"], $disp) && !$this->user_disp_model->existeRecomendacion($user_2["user_id"], $disp)) {
                        /*Si los usuarios son cercanos, se recomienda
                        el dispositvo 'disp', siempre y cuando el dispositivo no haya sido valorado negativamente por mas del 75% de los usuarios*/
                        if ($info_disp['dislikes'] <= $porcentaje_users) {
                            $this->user_disp_model->addRecomendacion($user_2["user_id"], $disp);
                        }
                    }
                }
            }
        } else {
            /*Recomendacion por nuevo usuario o modificacion de perfil. Se realiza recomendacion mutua entre usuarios cercanos*/
            $user_favs = $this->user_disp_model->getFav($user_id_1);
            while ($user_2 = $list_usuarios->fetch_assoc()) {
                if ($this->es_cercano($user_id_1, $user_2["user_id"])) {
                    /* Si el usuario 'user_2' es cercano al usuario 'user_id_1', se recomienda el dispositivo 'fav' siempre y cuando
                    no este dentro del listado de favoritos ni de recomendaciones del usuario 'user_2'
                    */
                    while ($fav = $user_favs->fetch_assoc()) {
                        if (!$this->user_disp_model->isFav($user_2["user_id"], $fav["disp_id"]) && !$this->user_disp_model->existeRecomendacion($user_2["user_id"], $fav["disp_id"])) {
                            $info_disp = $this->dispositivo_model->getDispositivo($fav["disp_id"]);
                            if ($info_disp['dislikes'] <= $porcentaje_users) {

                                $this->user_disp_model->addRecomendacion($user_2["user_id"], $fav["disp_id"]);
                            }
                        }
                    }
                    $cercano_favs = $this->user_disp_model->getFav($user_2['user_id']);
                    while ($fav_cercano = $cercano_favs->fetch_assoc()) {
                        if (!$this->user_disp_model->isFav($user_id_1, $fav_cercano["disp_id"]) && !$this->user_disp_model->existeRecomendacion($user_id_1, $fav_cercano["disp_id"])) {
                            $info_disp = $this->dispositivo_model->getDispositivo($fav_cercano["disp_id"]);
                            if ($info_disp['dislikes'] <= $porcentaje_users) {

                                $this->user_disp_model->addRecomendacion($user_id_1, $fav_cercano["disp_id"]);
                            }
                        }
                    }
                }
            }
        }

    }

    /**
     * Recomendador por dispositivo nuevo
     * 
     * Algoritmo de recomendacion de un nuevo dispositivo añadido a todos aquellos usuarios que tengan como minimo un interes en comun
     * con el dispositvo
     * 
     * @param int $disp identificador del dispositivo nuevo 
     * @return void
     */
    public function recomendador_por_dispositivo_nuevo($disp)
    {
        $disp_interes = $this->dispositivo_model->getDispInteres($disp);
        $list_usuarios = $this->usuarios_model->getAllUsers();


        $array2 = []; //Guardamos los intereses del dispositivo en array2
        while ($interes = $disp_interes->fetch_assoc()) {

            array_push($array2, $interes["interes_id"]);
        }

        while ($usuario = $list_usuarios->fetch_assoc()) {

            $user_intereses = $this->usuarios_model->getInteresesUser($usuario["user_id"]);
            $array1 = []; //Guardamos los intereses del usuario en array1
            while ($u = $user_intereses->fetch_assoc()) {

                array_push($array1, $u["interes_id"]);
            }
            if (count(array_intersect($array1, $array2)) >= 1) {

                $this->user_disp_model->addRecomendacion($usuario["user_id"], $disp);

            }
        }
    }
}



?>