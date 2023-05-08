<?php
if (isset($_POST['accion'])) {
  switch ($_POST['accion']) {
    /**
     * Opción que trae de la bbdd la pregunta correspondiente junto con las opciones disponibles
     */
    case 'pregunta': {
        require("chatbotBD.php");
        $chatbot = new chatbotBD();
        $chat = $chatbot->pregunta();
        $num_pregunta=$chat['id'];
        echo "<p> <strong>Pregunta " . ($num_pregunta+ 1) . "</strong>";
        echo "-" . $chat['pregunta'] . "</p>";
        $respuestas = explode(';', $chat['respuestas']);
        echo "<div class='respuestas'>";
        foreach ($respuestas as $key => $respuesta) {
          echo "<button class='btn_respuesta  border w-auto rounded mb-1 px-3 py-2 text-decoration-none ' id='$key' value='$respuesta' name='$num_pregunta'>$respuesta</button>";
        }
        echo "</div>";
        break;
      }

    /**
     * Opcion que devuelve de la bbdd el resultado de los posibles dispositivos que cumplan con los requisitos del usuario 
     */
    case 'resultado': {
        require("chatbotBD.php");
        $chatbot = new chatbotBD();
        $chat = $chatbot->resultado();
        $array_disp_id = [];
        while ($row = $chat->fetch_assoc()) {
          array_push($array_disp_id, $row["disp_id"]);
        }
        $disp_id = implode(",", $array_disp_id);
        echo $disp_id; //Devolvemos el resultado con los disp_id encontrados de acuerdo a las respuestas del usuario separador por ','
                       //para asi formar la url necesaria
        break;
      }


  }
}