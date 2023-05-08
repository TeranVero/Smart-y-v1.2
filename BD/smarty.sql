-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-03-2023 a las 22:02:28
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
-- Estructura de tabla para la tabla `caracteristicas_camara`
--

CREATE TABLE `caracteristicas_camara` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `caracteristicas_camara`
--

INSERT INTO `caracteristicas_camara` (`id`, `nombre`, `descripcion`) VALUES
(8, 'Video con Zoom de audio', ''),
(9, 'Flash True Tone', ''),
(10, 'Zoom óptico de alejamiento x2', ''),
(11, 'Zoom optico', ''),
(12, 'Zoom digital', ''),
(13, 'Grabación de vídeo a 4K', ''),
(14, 'Grabación de vídeo a 8K', ''),
(15, 'Estabilización óptica de imagen (OIS)', '');

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
(0, 'Primera pregunta: Vamos a empezar por algo facil, el tamaño', 'Quiero un móvil pequeño, manejable con una sola mano que me quepa en cualquier sitio. (plegados);Quiero un movil normal;No me importa utilizar el móvil con dos manos, pero que quepa en el bolsillo de mis pantalones más ajustados;Me gustan grandes, cuanto más mejor;Quiero un movil que pueda llevar en cualquier sitio, sin renunciar a un gran tamaño de pantalla', 'dispositivos.ancho*dispositivos.alto<8600;dispositivos.ancho*dispositivos.alto BETWEN 8601 AND 11600;dispositivos.ancho*dispositivos.alto BETWEEN 11601 AND 12600;dispositivos.ancho*dispositivos.alto>12600;dispositivos.ancho*dispositivos.alto = -1'),
(1, '¿Cómo prefieres que se vea la pantalla?', 'Mientras se vea, no me importa;Colores realistas;Colores vivos y negros puros', 'tipo_pantalla=\'lcd\' OR tipo_pantalla=\'oled\';tipo_pantalla = \'lcd\';tipo_pantalla =\'oled\''),
(2, 'Cuando hago alguna búsqueda, o abro cualquier aplicación en mi dispositivo\r\n', 'Con que no se quede colgado me vale;Necesito que responda a mis acciones con mucha fluidez, que sea más rápido que yo', 'tasa_refresco < 90;tasa_refresco > 90');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_sensores`
--

CREATE TABLE `detalle_sensores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `detalle_sensores`
--

INSERT INTO `detalle_sensores` (`id`, `nombre`, `descripcion`) VALUES
(8, 'Radio FM', ''),
(9, 'Computer Sync\r\n', ''),
(10, 'OTA Sync', ''),
(11, 'Compartir internet', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dispositivos`
--

CREATE TABLE `dispositivos` (
  `disp_id` int(11) NOT NULL,
  `marca` varchar(20) NOT NULL,
  `so` varchar(200) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `pulgadas` double NOT NULL,
  `alto` double NOT NULL,
  `ancho` double NOT NULL,
  `grosor` double NOT NULL,
  `peso` int(11) NOT NULL,
  `pantalla` varchar(50) NOT NULL,
  `tipo_pantalla` varchar(20) NOT NULL,
  `colores` varchar(500) NOT NULL,
  `tasa_refresco` varchar(50) NOT NULL,
  `resolucion_a` int(11) NOT NULL,
  `resolucion_b` int(11) NOT NULL,
  `resolucion` varchar(50) NOT NULL,
  `ram` varchar(50) NOT NULL,
  `memoria_interna` varchar(50) NOT NULL,
  `ampliable_sd` tinyint(1) NOT NULL DEFAULT 0,
  `seguridad_facial` tinyint(1) NOT NULL DEFAULT 0,
  `seguridad_huella` tinyint(1) NOT NULL DEFAULT 0,
  `cam_trasera` varchar(50) NOT NULL,
  `caracteristicas_cam` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `flash` varchar(100) NOT NULL,
  `estabilizacion_opt` int(11) NOT NULL,
  `slow_motion` varchar(200) NOT NULL,
  `cam_frontal` varchar(50) NOT NULL,
  `cam_otras` longtext NOT NULL,
  `infrarojos` tinyint(1) NOT NULL DEFAULT 0,
  `sensores` longtext NOT NULL,
  `jack` tinyint(1) NOT NULL DEFAULT 0,
  `nfc` tinyint(1) NOT NULL DEFAULT 0,
  `bateria` int(5) NOT NULL,
  `conexion` tinyint(1) NOT NULL DEFAULT 0,
  `pantalla_curva` tinyint(1) NOT NULL DEFAULT 0,
  `resistencia` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `carga_rapida` tinyint(1) NOT NULL DEFAULT 0,
  `fecha` date NOT NULL,
  `precio` double NOT NULL,
  `lente_teleobjetivo` varchar(20) NOT NULL,
  `lente_gran_angular` varchar(20) NOT NULL,
  `lente_macro` varchar(20) NOT NULL,
  `usb_tipo` varchar(20) NOT NULL,
  `usb_carga` tinyint(1) NOT NULL DEFAULT 0,
  `usb_otg` tinyint(1) NOT NULL DEFAULT 0,
  `usb_masivo` tinyint(1) NOT NULL DEFAULT 0,
  `otros` longtext NOT NULL,
  `dislikes` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `dispositivos`
--

INSERT INTO `dispositivos` (`disp_id`, `marca`, `so`, `nombre`, `pulgadas`, `alto`, `ancho`, `grosor`, `peso`, `pantalla`, `tipo_pantalla`, `colores`, `tasa_refresco`, `resolucion_a`, `resolucion_b`, `resolucion`, `ram`, `memoria_interna`, `ampliable_sd`, `seguridad_facial`, `seguridad_huella`, `cam_trasera`, `caracteristicas_cam`, `flash`, `estabilizacion_opt`, `slow_motion`, `cam_frontal`, `cam_otras`, `infrarojos`, `sensores`, `jack`, `nfc`, `bateria`, `conexion`, `pantalla_curva`, `resistencia`, `carga_rapida`, `fecha`, `precio`, `lente_teleobjetivo`, `lente_gran_angular`, `lente_macro`, `usb_tipo`, `usb_carga`, `usb_otg`, `usb_masivo`, `otros`, `dislikes`) VALUES
(29, 'apple', 'ios16', 'Iphone 13', 6.1, 146.7, 71.5, 7.7, 174, '10366', 'OLED', 'rojo,rosa,azul', '', 0, 0, '0', '1', '128', 0, 1, 0, '12', '8,9,10,11,14', 'Dual LED', 1, '1', '12', 'Lente gran angular 120º,Modo Retrato con efecto bokeh avanzado y Control de Profundidad,Zoom óptico 2x,Zoom digital 5x', 0, '8,9,11', 0, 1, 0, 0, 0, '1', 20, '2021-09-01', 859, '', '12', '', 'ligthning', 1, 1, 1, '', 8),
(70, 'Apple', 'IOS16', 'Iphone 14', 0, 0, 0, 0, 0, '0', 'LCD', '', '', 0, 0, '0', '4', '128', 0, 1, 0, '', '', '', 0, '0', '', '', 0, '', 0, 1, 0, 0, 0, '', 0, '0000-00-00', 919, '', '', '', '', 1, 1, 1, '', 3),
(71, '', '', 'xiaomi mi10', 0, 175.5, 71.5, 0, 0, '12425', 'LCD', '', '100', 0, 0, '0', '8', '128', 0, 0, 0, '50', '10,11', '', 0, '0', '', '', 0, '8,9', 0, 1, 0, 0, 0, '', 0, '0000-00-00', 0, '', '8', '2', '', 0, 0, 0, '', 2),
(81, '', '', 'prueba', 0, 0, 0, 0, 0, '0', 'LCD', '', '', 0, 0, '0', '', '', 0, 0, 0, '', '', '', 0, '0', '', '', 0, '', 0, 0, 0, 0, 0, '', 0, '0000-00-00', 0, '', '', '', '', 0, 0, 0, '', 0),
(84, '', '', 'prueba 2', 0, 0, 0, 0, 0, '0', '...', '', '', 0, 0, '0', '', '', 0, 0, 0, '', '', '', 0, '0', '', '', 0, '', 0, 0, 0, 0, 0, '', 0, '0000-00-00', 0, '', '', '', '', 0, 0, 0, '', 0),
(128, 'apple', 'ios16', 'Iphone 13 mini', 5.8, 146.7, 71.5, 7.7, 174, '10366', 'OLED', 'rojo,rosa,azul,verde,negro', '', 0, 0, '0', '0', '0', 0, 0, 1, '', '8,11', 'Dual LED', 0, '1', '', '', 0, '8,1', 0, 1, 0, 0, 0, '', 20, '0000-00-00', 859, '', '12', '', 'ligthning', 1, 0, 1, 'MagSafe wireless charging 15W', 1),
(129, 'xiaomi', 'miu', 'xiaomi mi12', 0, 0, 0, 0, 0, '0', '', '', '', 0, 0, '0', '', '', 0, 0, 0, '', '', '', 0, '', '', '', 1, '', 0, 0, 0, 0, 0, '', 0, '0000-00-00', 0, '', '', '', '', 0, 0, 0, '', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `disp_interes`
--

CREATE TABLE `disp_interes` (
  `disp_id` int(11) NOT NULL,
  `interes_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `disp_interes`
--

INSERT INTO `disp_interes` (`disp_id`, `interes_id`) VALUES
(29, 1),
(29, 2),
(29, 3),
(70, 1),
(70, 3),
(70, 4),
(70, 5),
(128, 2),
(128, 3),
(128, 6),
(129, 1),
(129, 2),
(129, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `galeria_disp`
--

CREATE TABLE `galeria_disp` (
  `disp_id` int(11) NOT NULL,
  `imagen` varchar(200) NOT NULL,
  `destacada` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `galeria_disp`
--

INSERT INTO `galeria_disp` (`disp_id`, `imagen`, `destacada`) VALUES
(29, '2020Desktops-Sunday-16.jpg', 1),
(29, 'thumb_548572_default_big.jpeg', 0),
(70, 'apple-iphone-14-pro-morado-02.png', 1),
(70, 'apple-iphone-14-pro-morado-04.png', 0),
(70, 'apple-iphone-14-pro-morado-04.png', 0),
(71, 'thumb_323504_phone_front_big.jpeg', 1),
(71, '', 0),
(81, '958483-esprit-home-10-as-creation-papel-pintado.jpg', 1),
(81, '', 0),
(84, 'Snapshot 2020-06-28 13.03.42.png', 1),
(84, '', 0),
(128, 'apple-iphone-14-pro-morado-02.png', 1),
(128, 'apple-iphone-14-pro-morado-04.png', 0),
(128, 'apple-iphone-14-pro-morado-04 (1).png', 0),
(129, '', 1),
(129, '', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `intereses`
--

CREATE TABLE `intereses` (
  `interes_id` int(11) NOT NULL,
  `interes` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `intereses`
--

INSERT INTO `intereses` (`interes_id`, `interes`) VALUES
(1, 'Fotografía y diseño'),
(2, 'Gamer pro'),
(3, 'Tecnologías y ultimas novedades'),
(4, 'Entretenimiento a tope'),
(5, 'Uso de redes sociales'),
(6, 'Estructura, diseño e interfaz llamativa'),
(7, 'Estilo de vida');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `marca_id` int(11) NOT NULL,
  `marca` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`marca_id`, `marca`) VALUES
(1, 'Apple'),
(2, 'Samsung'),
(3, 'Xiaomi'),
(4, 'Huawei'),
(5, 'Oppo'),
(6, 'POCO'),
(7, 'Lg'),
(8, 'Google'),
(9, 'One Plus'),
(10, 'Meizu');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ocupaciones`
--

CREATE TABLE `ocupaciones` (
  `descripcion` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ocupaciones`
--

INSERT INTO `ocupaciones` (`descripcion`) VALUES
('Agricultura, ganadería, silvicultura y pesca'),
('Industrias extractivas'),
('Industria manufacturera'),
('Suministro de energía eléctrica, gas, vapor y aire acondicionado'),
('Suministro de agua, actividades de saneamiento, gestión de residuos y descontaminación'),
('Construcción'),
('Comercio al por mayor y al por menor, reparación de vehículos de motor y motocicletas'),
('Transporte y almacenamiento'),
('Hostelería'),
('Información y telecomunicaciones'),
('Actividades financieras y de seguros'),
('Actividades inmobiliarias'),
('Actividades profesionales, científicas y técnicas'),
('Actividades administrativas y servicios auxiliares'),
('Administración Pública y Defensa, seguridad social obligatoria'),
('Educación'),
('Actividades sanitarias y de servicios sociales'),
('Actividades artísticas, recreativas y de entretenimiento'),
('Otros servicios'),
('Actividades de los hogares como empleadores de personal doméstico, como productores de bienes y servicios para uso propio'),
('Actividades de organizaciones y organismos extraterritoriales');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `precios_por_disp`
--

CREATE TABLE `precios_por_disp` (
  `shop` varchar(500) NOT NULL,
  `disp_id` int(11) NOT NULL,
  `url` varchar(2000) NOT NULL,
  `precio` double NOT NULL,
  `img` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `precios_por_disp`
--

INSERT INTO `precios_por_disp` (`shop`, `disp_id`, `url`, `precio`, `img`) VALUES
('mediamarkt', 29, 'https://www.mediamarkt.es/es/product/_apple-iphone-13-medianoche-128-gb-5g-61-oled-super-retina-xdr-chip-a15-bionic-ios-1518038.html', 819, 'mediamarkt.svg'),
('tecnomari', 29, 'https://tecnomari.es/moviles-iphone/apple-iphone-13-128gb-medianoche/', 730, 'tecnomari.png'),
('fnac', 29, 'https://www.fnac.es/Apple-iPhone-13-6-1-128GB-Medianoche-Telefono-movil-Smartphone/a8721834#omnsearchpos=12', 829, 'fnac.svg'),
('mediamarkt', 70, 'https://www.mediamarkt.es/es/product/_apple-iphone-14-medianoche-128-gb-5g-61-oled-super-retina-xdr-chip-a15-bionic-ios-1540174.html', 899, 'mediamarkt.svg'),
('mediamarkt', 71, 'https://www.mediamarkt.es/es/product/_mvil-mi-10t-xiaomi-plata-128-gb-667--qua-94408338.html', 606, 'mediamarkt.svg'),
('amazon', 29, 'https://www.amazon.es/Apple-iPhone-13-128-GB-Blanco/dp/B09G98QYSD/ref=sr_1_1_sspa?keywords=iphone+13+128gb&qid=1677202159&sprefix=iphone+13+128%2Caps%2C239&sr=8-1-spons&sp_csd=d2lkZ2V0TmFtZT1zcF9hdGY&psc=1', 819, 'amazon.svg'),
('mediamarkt', 70, 'https://www.amazon.es/dp/B0BDKBLF8C/ref=twister_B0BDRNGTQ2?_encoding=UTF8&psc=1', 919, 'mediamarkt.svg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_contactos`
--

CREATE TABLE `user_contactos` (
  `user_id` int(11) NOT NULL,
  `contacto_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `user_contactos`
--

INSERT INTO `user_contactos` (`user_id`, `contacto_id`) VALUES
(107, 70),
(107, 106),
(107, 14),
(107, 58);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_disp_dislike`
--

CREATE TABLE `user_disp_dislike` (
  `user_id` int(11) NOT NULL,
  `disp_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `user_disp_dislike`
--

INSERT INTO `user_disp_dislike` (`user_id`, `disp_id`) VALUES
(96, 71),
(96, 29),
(104, 29),
(104, 29),
(104, 29),
(104, 29),
(104, 70),
(104, 70),
(104, 71),
(13, 71),
(58, 70),
(107, 128);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_disp_fav`
--

CREATE TABLE `user_disp_fav` (
  `user_id` int(11) NOT NULL,
  `disp_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `user_disp_fav`
--

INSERT INTO `user_disp_fav` (`user_id`, `disp_id`) VALUES
(107, 70);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_disp_use`
--

CREATE TABLE `user_disp_use` (
  `user_id` int(11) NOT NULL,
  `disp_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `user_disp_use`
--

INSERT INTO `user_disp_use` (`user_id`, `disp_id`) VALUES
(96, 70),
(13, 71),
(104, 70),
(104, 29),
(58, 29),
(58, 71),
(107, 70),
(107, 81),
(70, 29),
(107, 71),
(107, 128);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_intereses`
--

CREATE TABLE `user_intereses` (
  `user_id` int(11) NOT NULL,
  `interes_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `user_intereses`
--

INSERT INTO `user_intereses` (`user_id`, `interes_id`) VALUES
(14, 1),
(14, 3),
(107, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_marcas`
--

CREATE TABLE `user_marcas` (
  `user_id` int(11) NOT NULL,
  `marca_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `user_marcas`
--

INSERT INTO `user_marcas` (`user_id`, `marca_id`) VALUES
(14, 1),
(14, 2),
(107, 1),
(107, 5),
(107, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_recomendaciones`
--

CREATE TABLE `user_recomendaciones` (
  `user_id` int(11) NOT NULL,
  `disp_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `user_recomendaciones`
--

INSERT INTO `user_recomendaciones` (`user_id`, `disp_id`) VALUES
(14, 70),
(104, 70),
(106, 70),
(70, 70);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `user_id` int(11) NOT NULL,
  `nombreUsuario` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contrasena` varchar(60) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `fecha` date NOT NULL,
  `ocupacion` varchar(200) NOT NULL,
  `intereses` longtext NOT NULL,
  `marcas` longtext NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0,
  `avatar` varchar(300) NOT NULL DEFAULT 'no_avatar.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`user_id`, `nombreUsuario`, `email`, `contrasena`, `nombre`, `apellidos`, `fecha`, `ocupacion`, `intereses`, `marcas`, `admin`, `avatar`) VALUES
(13, 'admin2', 'admin@gmail.com', '$2y$10$BMM39TF3AhJ83DOgxYH6v.A0WnKkmOrbHz1Gh7t.YZX3usHM91bEq', 'admin', 'admin', '2022-10-03', '', '', '', 1, 'no_avatar.png'),
(14, 'mperez', 'manuel@gmail.com', '$2y$10$U3TKkhY1dHQABRk38kv7MORSLhiSq490BO.jbR9rWgkcH.FBbm9jO', 'manuel', 'Perez Garcia', '1998-07-15', 'Agricultura, ganadería, silvicultura y pesca', '', '', 0, 'no_avatar.png'),
(58, 'vero23', 'vteran@gmail.com', '$2y$10$5HhH6Hrobjs4NBaCYK84f.hKANcrg6HiPqrUfCQ5lvzyjSqWSl826', 'Veronica', 'Teran Molina', '0000-00-00', 'Agricultura, ganadería, silvicultura y pesca', 'fotografia,juegos', '', 0, 'no_avatar.png'),
(70, 'veronica4', 'vero@gmail.com', '$2y$10$edIDt1K61V8hxhZXbDJe1uLmHWsLyGderaNghPiczd2z.fSvDkM0.', '', '', '0000-00-00', '', 'fotografia,entretenimiento,cine', '', 0, 'no_avatar.png'),
(96, 'admin2', 'admin2@gmail.com', '$2y$10$EzmtHC6gL59IPOt1AIDzN.q0dW3yYugnY9Ht4Sc6YT/yvOi3jEVQi', 'vero', 'teran', '2023-01-26', '', 'diseño,estilo_de_vida', '', 1, 'no_avatar.png'),
(104, 'teranvero2023', 'vero@gmail.com', '$2y$10$8xoTnK9g3grIuWA4Z.E.eOeuNL7vPlyU/MGq/xeEUpSIYM4hSMw72', 'vero', 'teran', '2023-01-19', '', 'fotografia,juegos', '', 0, 'avatar.jpg'),
(106, 'pablop', 'pablop@gmail.com', '$2y$10$bVJWnnLe3Q1byoUTSOQYSumtkg.fqPghnkp30q9qF3POpgo1uXjiG', 'pablo', 'perez', '2023-02-03', '', 'tecnologias,entretenimiento,redes sociales', '', 0, 'no_avatar.png'),
(107, 'vteran', 'veronica@gmail.com', '$2y$10$IjbZcVdiJSPe0yGOVZ9SQO62yY6/CaKGIZjjgEWXsij36Pbuvflce', 'veronica', 'teran molina', '0000-00-00', 'Agricultura, ganadería, silvicultura y pesca', 'fotografia', 'Apple,Samsung,Xiaomi', 0, '642346281fda4.png');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `caracteristicas_camara`
--
ALTER TABLE `caracteristicas_camara`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `chatbot`
--
ALTER TABLE `chatbot`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_sensores`
--
ALTER TABLE `detalle_sensores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `dispositivos`
--
ALTER TABLE `dispositivos`
  ADD PRIMARY KEY (`disp_id`);

--
-- Indices de la tabla `disp_interes`
--
ALTER TABLE `disp_interes`
  ADD KEY `disp_id` (`disp_id`) USING BTREE,
  ADD KEY `interes_id` (`interes_id`) USING BTREE;

--
-- Indices de la tabla `galeria_disp`
--
ALTER TABLE `galeria_disp`
  ADD KEY `disp_id` (`disp_id`);

--
-- Indices de la tabla `intereses`
--
ALTER TABLE `intereses`
  ADD PRIMARY KEY (`interes_id`);

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`marca_id`);

--
-- Indices de la tabla `precios_por_disp`
--
ALTER TABLE `precios_por_disp`
  ADD KEY `disp_id` (`disp_id`);

--
-- Indices de la tabla `user_contactos`
--
ALTER TABLE `user_contactos`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `contacto_id` (`contacto_id`);

--
-- Indices de la tabla `user_disp_dislike`
--
ALTER TABLE `user_disp_dislike`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `disp_id` (`disp_id`);

--
-- Indices de la tabla `user_disp_fav`
--
ALTER TABLE `user_disp_fav`
  ADD KEY `disp_id` (`disp_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `user_disp_use`
--
ALTER TABLE `user_disp_use`
  ADD KEY `disp_id` (`disp_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `user_intereses`
--
ALTER TABLE `user_intereses`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `interes_id` (`interes_id`);

--
-- Indices de la tabla `user_marcas`
--
ALTER TABLE `user_marcas`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `marca_id` (`marca_id`);

--
-- Indices de la tabla `user_recomendaciones`
--
ALTER TABLE `user_recomendaciones`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `disp_id` (`disp_id`),
  ADD KEY `disp_id_2` (`disp_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `caracteristicas_camara`
--
ALTER TABLE `caracteristicas_camara`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `chatbot`
--
ALTER TABLE `chatbot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `detalle_sensores`
--
ALTER TABLE `detalle_sensores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `dispositivos`
--
ALTER TABLE `dispositivos`
  MODIFY `disp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT de la tabla `intereses`
--
ALTER TABLE `intereses`
  MODIFY `interes_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `marca_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `disp_interes`
--
ALTER TABLE `disp_interes`
  ADD CONSTRAINT `disp_interes_ibfk_1` FOREIGN KEY (`disp_id`) REFERENCES `dispositivos` (`disp_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `disp_interes_ibfk_2` FOREIGN KEY (`interes_id`) REFERENCES `intereses` (`interes_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `galeria_disp`
--
ALTER TABLE `galeria_disp`
  ADD CONSTRAINT `galeria_disp_ibfk_1` FOREIGN KEY (`disp_id`) REFERENCES `dispositivos` (`disp_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `precios_por_disp`
--
ALTER TABLE `precios_por_disp`
  ADD CONSTRAINT `precios_por_disp_ibfk_1` FOREIGN KEY (`disp_id`) REFERENCES `dispositivos` (`disp_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `user_contactos`
--
ALTER TABLE `user_contactos`
  ADD CONSTRAINT `user_contactos_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_contactos_ibfk_2` FOREIGN KEY (`contacto_id`) REFERENCES `usuarios` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `user_disp_dislike`
--
ALTER TABLE `user_disp_dislike`
  ADD CONSTRAINT `user_disp_dislike_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_disp_dislike_ibfk_2` FOREIGN KEY (`disp_id`) REFERENCES `dispositivos` (`disp_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `user_disp_fav`
--
ALTER TABLE `user_disp_fav`
  ADD CONSTRAINT `user_disp_fav_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
  ADD CONSTRAINT `user_disp_dislike_ibfk_2` FOREIGN KEY (`disp_id`) REFERENCES `dispositivos` (`disp_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `user_disp_use`
--
ALTER TABLE `user_disp_use`
  ADD CONSTRAINT `user_disp_use_ibfk_2` FOREIGN KEY (`disp_id`) REFERENCES `dispositivos` (`disp_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_disp_use_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `user_intereses`
--
ALTER TABLE `user_intereses`
  ADD CONSTRAINT `user_intereses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_intereses_ibfk_2` FOREIGN KEY (`interes_id`) REFERENCES `intereses` (`interes_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `user_marcas`
--
ALTER TABLE `user_marcas`
  ADD CONSTRAINT `user_marcas_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_marcas_ibfk_2` FOREIGN KEY (`marca_id`) REFERENCES `marcas` (`marca_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `user_recomendaciones`
--
ALTER TABLE `user_recomendaciones`
  ADD CONSTRAINT `user_recomendaciones_ibfk_1` FOREIGN KEY (`disp_id`) REFERENCES `dispositivos` (`disp_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_recomendaciones_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
