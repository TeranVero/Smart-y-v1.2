<?php
include_once((realpath(dirname(__FILE__, 2))) . "/Model/configBD.php");

/**
 * Clase que representa el objeto chatbotBD para gestionar bbdd
 * 
 * Implementa el modelo del asistente, gestionando unicamente los accesos a la
 * bbdd correspondiente
 */
class chatbotBD extends configBD
{

   /**
    * Funcion para obtener la pregunta actual
    *
    * Se obtiene el contador que representa el indice de la siguiente pregunta, para posteriormente acceder a la bbdd
    * y obtener los string de la pregunta y los valores correspondientes
    * @return string
    */
   public function pregunta()
   {
      $cont = $_POST["cont"];

      $questions = "SELECT * FROM chatbot where id=$cont";
      $data = $this->BD->query($questions) or die($this->BD->error . " en la línea " . (__LINE__ - 1));
      return $data->fetch_assoc();
   }

   
   /**
    * Función para obtener el resultado de la recomendacion asistida
    *
    * Se recibe la variable "resultado" donde se alamacenan todos los id de las opciones seleccionadas por el usuario. Posteriormente 
    * se obtiene de la bbdd 'chatbot' los valores que equivalen a los ids de las respuestas y que conformaran la query final para realizar
    * la consulta y búsqueda de los dispositivos
    * 
    * @return string Devolvemos el resultado de la recomendacion con los dispositivos encontrados.
    */
   public function resultado()
   {
      $resultado = json_decode($_POST["resultado"]);
      $query = "";
      foreach ($resultado as $id => $key) {
         $questions = "SELECT valores FROM chatbot where chatbot.id=$id";
         $data = $this->BD->query($questions) or die($this->BD->error . " en la línea " . (__LINE__ - 1));

         $fetch_data = mysqli_fetch_assoc($data);
         $valores = explode(";", $fetch_data["valores"]); //Obtenemos los valores de respuesta (string) de la base de datos y lo convertimos en array.
         $query = $query . $valores[$key]; //Obtenemos el valor de acuerdo a la respuesta dada por el usuario con el boton seleccionado.
         if ($id < count($resultado) - 1) {
            $query = $query . " AND ";
         }

      }
      $final_query = "SELECT * FROM dispositivos WHERE " . $query;
      $data = $this->BD->query($final_query) or die($this->BD->error . " en la línea" . (__LINE__ - 1));
      return $data;
   }
}