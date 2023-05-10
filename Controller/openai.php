<?php 
/**
 * Fichero php acceder a la api de "ChatGPT" y obtener información relativa a especificaciones complejas
 * 
 * @author Verónica Terán Molina <vteran@ucm.es>
 */

require '../vendor/autoload.php';
use Orhanerday\OpenAi\OpenAi;


$text = $_GET['text'];//obtenemos la especificacion del dispositivos del que queremos obtener la información
  
$open_ai_key =getenv('OPENAI_API_KEY');
$open_ai = new OpenAi($open_ai_key);

  $complete=$open_ai->completion([
  'model'=>'text-curie-001',
  'prompt'=>'The following is a conversation with an AI assistant. The assistant is helpful, creative, smart,
  savvy in mobile device technologies and does not ask questions.
  \n\nHuman: Hello, who are you?\nAI: I am an AI created by OpenAI.\nHuman: ¿quien eres?
  \nAI: Soy un asistente artificial creado por OpenAI.
  \nHuman: en que eres un experto?
  \nAI: Soy un experto en tecnologías móviles.
  \nHuman: ¿qué es Flash True Tone?
  \nAI: True Tone Flash es una tecnología de Apple que permite ajustar la temperatura de color 
  de la pantalla para mejorar la calidad de imagen. Es compatible con ciertos dispositivos Apple como los últimos iPhone y iPads
  Human: ¿que es'.$text.'?
  AI:',
  'temperature'=>0.2,
  'max_tokens'=>100,
  'top_p'=>1,
  'frequency_penalty'=>0,
  'presence_penalty'=>0.6,
  'stop'=>[" Human:", " AI:"]
  ]
 );
$arr = json_decode($complete, true);
echo $arr["choices"][0]["text"]; 
?>
