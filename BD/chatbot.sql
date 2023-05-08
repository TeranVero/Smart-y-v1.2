-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-01-2023 a las 20:23:51
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `smarty`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chatbot`
--

CREATE TABLE `chatbot` (
  `id` int(11) NOT NULL,
  `pregunta` varchar(1000) NOT NULL,
  `respuestas` varchar(1000) NOT NULL,
  `valores` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `chatbot`
--

INSERT INTO `chatbot` (`id`, `pregunta`, `respuestas`, `valores`) VALUES
(0, 'Vamos a empezar por algo facil, el tamaño', 'Quiero un móvil pequeño, manejable con una sola mano que me quepa en cualquier sitio. (plegados);Quiero un movil normal;No me importa utilizar el móvil con dos manos, pero que quepa en el bolsillo de mis pantalones más ajustados;Me gustan grandes, cuanto más mejor;Quiero un movil que pueda llevar en cualquier sitio, sin renunciar a un gran tamaño de pantalla', 'dispositivos.ancho*dispositivos.alto<8600;dispositivos.ancho*dispositivos.alto BETWEN 8601 AND 11600;dispositivos.ancho*dispositivos.alto BETWEEN 11601 AND 12600;dispositivos.ancho*dispositivos.alto>12600;dispositivos.ancho*dispositivos.alto = -1'),
(1, '¿Cómo prefieres que se vea la pantalla?', 'Mientras se vea, no me importa;Colores realistas;Colores vivos y negros puros', 'tipo_pantalla=lcd AND tipo_pantalla=oled;tipo_pantalla = lcd;tipo_pantalla =oled'),
(2, 'Cuando hago alguna búsqueda, o abro cualquier aplicación en mi dispositivo\r\n', 'Necesito que responda a mis acciones con mucha fluidez, que sea más rápido que yo;Con que no se quede colgado me vale', 'tasa_refresco < 90;tasa_refresco > 90'),
(3, 'El móvil lo voy a usar para…', 'Mensajería, llamadas y alguna app más;Mensajería, fotografía, juegos, productividad…;Para todo, sin límites, hasta quiero jugar en realidad virtual', 'dispositivos.resolucion_a*resolucion_b < 2073600;dispositivos.resolucion_a*resolucion_b BETWEEN 2073600 AND 3686400;dispositivos.resolucion_a*resolucion_b > 3686400'),
(4, 'Cuando uso el móvil…', 'Me centro en la aplicación que estoy usando;Suelo tener varias aplicaciones abiertas a la vez;Todo lo anterior, hasta varios juegos a la vez', 'dispositivos.ram<6;dispositivos.ram BETWEEN 6 AND 8;dispositivos.ram > 8'),
(5, 'En el móvil me gusta tener…', 'Poca cosa,las apps diarias y alguna foto;Muchas aplicaciones y bastantes fotografías y vídeos;Es mi ordenador de bolsillo, hasta películas hay', 'dispositivos.memoria_interna<=64;dispositivos.disp_id IN (SELECT dispositivos.disp_id FROM dispositivos WHERE dispositivos.ampliable_sd =1 and dispositivos.memoria_interna BETWEEN 64 and 127 UNION SELECT dispositivos.disp_id FROM dispositivos WHERE dispositivos.ampliable_sd =0 and dispositivos.memoria_interna BETWEEN 128 and 255); dispositivos.memoria_interna >= 256'),
(6, 'En cuanto a la seguridad de mi dispositivo…', 'Con pin/patrón me vale;Quiero seguridad avanzada, como lector de huella, iris o facial', 'dispositivos.seguridad_facial=0 and dispositivos.seguridad_huella=0;dispositivos.seguridad_facial=1 or dispositivos.seguridad_huella=1'),
(7, 'En casa utilizo mi móvil…', 'Como fuera de ella, apps, juegos, mensajería...;Con el móvil controlo mi casa, aire acondicionado, televisión, hasta la lavadora la controlo con él', 'dispositivos.infrarojos=0;dispositivos.infrarojos=1'),
(8, '¡Mira que paisaje tan bonito! Hagamos una foto…', 'Para subirla después a redes sociales y se la enseño a un par de amigos.;Yo quiero además poder conectar el móvil a una televisión y presentar mi galería de fotografía;¡Me encantan las fotos! Me gusta poder controlar todos los aspectos de la cámara, edición posterior y después enseñarlas a lo grande, televisión, póster...', 'dispositivos.cam_trasera<12;dispositivos.cam_trasera BETWEEN 12 AND 47;dispositivos.cam_trasera>=48'),
(9, '¡Selfie!', '¿Eso qué es?;Venga, que hace mucho que no subo nada;¡Venga, todos juntos, en panorámico, y con desenfoque del paisaje!', 'dispositivos.cam_frontal<8;dispositivos.cam_frontal BETWEEN 8 AND 12;dispositivos.cam_frontal>12'),
(10, 'Si te digo que para escuchar música por cable necesitas un adaptador…', 'Ni hablar, quiero poder conectar mis cascos directamente, luego esos adaptadores se pierden, se rompen o te faltan;Ya es momento de modernizarse, ¡para algo existe el bluetooth!', 'dispositivos.jack=1;dispositivos.jack=0'),
(11, 'Cuando uso mucho mi móvil…', 'No me importa cargarlo varias veces al día;Con que me dure el dia entero me vale;¡Quiero que la bateria me dure varios dias!', 'dispositivos.bateria<3500;dispositivos.bateria BETWEEN 3500 AND 6000;dispositivos.bateria>6000'),
(12, 'Me gusta cargar el telefono', 'Durante toda la noche;Durante un par de horas como máximo;¡Lo pongo un rato y listo!', 'dispositivos.carga_rapida<25;dispositivos.carga_rapida BETWEEN 25 AND 50;dispositivos.carga_rapida >50'),
(13, '¡Ya llega la conexión ultra rápida 5G!', 'La quiero;No me interesa, con que pueda enviar mensajes y navegar desde cualquier parte me sirve', 'dispositivos.conexion=1;dispositivos.conexion=0'),
(14, 'Quiero que mi nuevo movil', 'Tenga una pantalla plana y que el protector de pantalla sea facil de colocar;Quiero pantalla hasta en los bordes', 'dispositivos.pantalla_curva=0;dispositivos.pantalla_curva=1'),
(15, 'Y por último...¿Que pretendo conseguir con mi nuevo móvil?', 'Quiero algo funcional, económico, que pueda hacer un poco de todo;Quiero un móvil elegante, que haga de todo y ser la envidia de todo el mundo', 'dispositivos.precio<800;dispositivos.precio>=800');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `chatbot`
--
ALTER TABLE `chatbot`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `chatbot`
--
ALTER TABLE `chatbot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
