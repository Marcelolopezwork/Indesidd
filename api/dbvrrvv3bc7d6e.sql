-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-09-2022 a las 19:03:51
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbvrrvv3bc7d6e`
--
CREATE DATABASE IF NOT EXISTS `dbvrrvv3bc7d6e` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `dbvrrvv3bc7d6e`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adm_baneadas`
--

DROP TABLE IF EXISTS `adm_baneadas`;
CREATE TABLE `adm_baneadas` (
  `id` int(11) NOT NULL,
  `baneada` varchar(48) DEFAULT NULL,
  `descripcion` varchar(48) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `estado` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `adm_baneadas`
--

INSERT INTO `adm_baneadas` (`id`, `baneada`, `descripcion`, `fecha`, `estado`) VALUES
(1, 'este curso es una mierda', NULL, '2020-11-04', 'A'),
(2, 'este curso es una estafa', NULL, '2020-11-04', 'A'),
(3, 'este curso no sirve', NULL, '2020-11-04', 'A'),
(4, 'este curso es un fraude', NULL, '2020-11-04', 'A'),
(5, 'esta pagina es una mierda', NULL, '2020-11-04', 'A'),
(6, 'esta pagina es una estafa', NULL, '2020-11-04', 'A'),
(7, 'esta pagina es un fraude', NULL, '2020-11-04', 'A'),
(8, 'este curso es muy malo', NULL, '2020-11-04', 'A'),
(9, 'el curso es una mierda', NULL, '2020-11-04', 'A'),
(10, 'el curso es una estafa', NULL, '2020-11-04', 'A'),
(11, 'el curso no sirve', NULL, '2020-11-04', 'A'),
(12, 'el curso es una estafa', NULL, '2020-11-04', 'A'),
(13, 'el profesor es una mierda', NULL, '2020-11-04', 'A'),
(14, 'el porfesor es un vende humo', NULL, '2020-11-04', 'A'),
(15, 'el porfesor es una estafa', NULL, '2020-11-04', 'A'),
(16, 'el porfesor es un fraude', NULL, '2020-11-04', 'A'),
(17, 'el profesor es un gilipollas', NULL, '2020-11-04', 'A'),
(18, 'curso de mierda', NULL, '2020-11-04', 'A'),
(19, 'pagina de mierda', NULL, '2020-11-04', 'A'),
(20, 'profesor de mierda', NULL, '2020-11-04', 'A'),
(21, 'cursos de mierda', NULL, '2020-11-04', 'A'),
(22, 'profesores de mierda', NULL, '2020-11-04', 'A'),
(23, 'curso de porqueria', NULL, '2020-11-04', 'A'),
(24, 'pagina de porqueria', NULL, '2020-11-04', 'A'),
(25, 'profesor de porqueria', NULL, '2020-11-04', 'A'),
(26, 'el curso es malo', NULL, '2020-11-04', 'A'),
(27, 'el profesor es malo', NULL, '2020-11-04', 'A'),
(28, 'el curso no sirve', NULL, '2020-11-04', 'A'),
(29, 'el profesor no sirve', NULL, '2020-11-04', 'A'),
(30, 'mierda', NULL, '2020-11-04', 'A'),
(31, 'estafa', NULL, '2020-11-04', 'A'),
(32, 'fraude', NULL, '2020-11-04', 'A'),
(33, 'porqueria', NULL, '2020-11-04', 'A'),
(34, 'malo', NULL, '2020-11-04', 'A'),
(35, 'no sirve', NULL, '2020-11-04', 'A'),
(36, 'mojón', 'Se refiere al profesor', '2020-11-27', 'A'),
(37, 'tarado', 'Se refiere al profesor', '2020-11-27', 'A'),
(38, 'que le den por el culo', 'Se refiere al profesor', '2020-11-27', 'A'),
(39, 'cagada', NULL, '2021-02-02', 'A'),
(40, 'hdp', '', '2021-03-19', 'A'),
(41, 'hijo de puta', '', '2021-03-19', 'A'),
(42, 'hdp', '', '2021-03-19', 'X');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adm_descuentos`
--

DROP TABLE IF EXISTS `adm_descuentos`;
CREATE TABLE `adm_descuentos` (
  `id` int(11) NOT NULL,
  `codigo` varchar(16) DEFAULT NULL,
  `usuarioid` int(11) DEFAULT NULL,
  `descuento` int(11) DEFAULT NULL,
  `razon` text DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `fechauso` date DEFAULT NULL,
  `utilizado` char(1) DEFAULT NULL,
  `canjeado` int(11) DEFAULT NULL,
  `cursoid` int(11) DEFAULT NULL,
  `tipo` char(1) DEFAULT NULL,
  `estado` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `adm_descuentos`
--

INSERT INTO `adm_descuentos` (`id`, `codigo`, `usuarioid`, `descuento`, `razon`, `fecha`, `fechauso`, `utilizado`, `canjeado`, `cursoid`, `tipo`, `estado`) VALUES
(1, 'DSCTOTOTAL', 0, 50, 'lanzamiento', '2021-11-05', '2021-11-05', 'S', 0, NULL, 'X', 'T'),
(2, '591559AC0D91CA81', 37, 70, 'recompras', '2021-12-05', NULL, NULL, 300, NULL, 'R', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adm_interfaz`
--

DROP TABLE IF EXISTS `adm_interfaz`;
CREATE TABLE `adm_interfaz` (
  `id` int(11) NOT NULL,
  `posicion` int(11) DEFAULT NULL,
  `foto` varchar(64) DEFAULT NULL,
  `descripcion` mediumtext DEFAULT NULL,
  `posiciontexto` varchar(5) DEFAULT NULL,
  `persona` varchar(32) DEFAULT NULL,
  `cargo` varchar(32) DEFAULT NULL,
  `especialidad` varchar(32) DEFAULT NULL,
  `titulo` varchar(48) DEFAULT NULL,
  `texto` mediumtext DEFAULT NULL,
  `tipo` varchar(32) NOT NULL,
  `pagina` varchar(24) DEFAULT NULL,
  `estado` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `adm_interfaz`
--

INSERT INTO `adm_interfaz` (`id`, `posicion`, `foto`, `descripcion`, `posiciontexto`, `persona`, `cargo`, `especialidad`, `titulo`, `texto`, `tipo`, `pagina`, `estado`) VALUES
(1, 1, 'hero-principal.jpg', 'International Dental School by Cidesidd', 'right', NULL, NULL, NULL, NULL, NULL, 'home', 'index', 'A'),
(2, 2, 'hero-odontologia.jpg', 'Bienvenido a la mayor comunidad de conocimiento en odontología', 'left', NULL, NULL, NULL, NULL, NULL, 'home', 'index', 'A'),
(3, 3, 'hero-tecnicos-protesicos.jpg', 'Bienvenido a la mayor comunidad de conocimiento para técnicos de prótesis', 'left', NULL, NULL, NULL, NULL, NULL, 'home', 'index', 'A'),
(4, 4, 'hero-estetica-orofacial.jpg', 'Bienvenido a la mayor comunidad de conocimiento en estética orofacial', 'left', NULL, NULL, NULL, NULL, NULL, 'home', 'index', 'A'),
(5, 5, 'hero-auxiliar-dental.jpg', 'Bienvenido a la mayor comunidad de conocimiento para higienistas y auxiliares dentales', 'left', NULL, NULL, NULL, NULL, NULL, 'home', 'index', 'A'),
(6, 0, 'fundador-indesid.jpg', '“Creamos INDESID para ofrecer a los alumnos una plataforma transversal que se ajuste a sus horarios y exigencias, permitiendo una actualización formativa constante adaptada a la globalización y a los cambios tecnológicos que indudablemente moldearán el futuro de nuestra profesión.”', NULL, 'Hernán López', 'Fundador de Indesid', 'Especialista en Implantología', NULL, NULL, 'lema', 'index', 'A'),
(7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Los mejores expertos', 'Los profesores de INDESID son expertos y referentes del ámbito dental dispuestos a compartir su experiencia, sabiduría y práctica clínica contigo.', 'beneficios', 'index', 'A'),
(8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Cursos hechos para ti', 'Ofrecemos cursos en todas las especialidades y para todos los niveles. Tú eliges como, cuando y donde verlo. Pausa el curso y continúalo más tarde y reprodúcelo las veces que quieras.', 'beneficios', 'index', 'A'),
(9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Actualiza tus conocimientos', 'Hoy en día ser un buen profesional en el mundo dental implica renovarse y actualizar conocimientos constantemente. El futuro es digital. ¡Échale un vistazo a nuestra amplia oferta de cursos y no te quedes atrás!', 'beneficios', 'index', 'A'),
(10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Revolución académica', 'Con Indesid forma parte de la revolución académica en el sector odontológico.', 'beneficios', 'index', 'A'),
(11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Lorem ipsum Five', 'Vivamus turpis pellentesque arcu diam malesuada interdum risus. Ac turpis nibh in et tincidunt. Massa fringilla maecenas et turpis egestas. Quisque augue adipiscing lectus facilisis sodales ultrices nunc, odio. Cursus sit malesuada.', 'beneficios', 'index', 'X'),
(12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Lorem ipsum Six', 'In tempor ac velit ullamcorper quis et proin porta. Venenatis, egestas euismod diam convallis. Dolor ridiculus semper egestas senectus aliquam scelerisque vel rhoncus.', 'beneficios', 'index', 'X'),
(13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Gana dinero / Rentabiliza tu conocimiento', 'Sube tu curso y gana dinero cada vez que un estudiante lo compre. Visualiza al instante las compras de cada curso y cobra a través de PayPal.', 'beneficios', 'profesores', 'A'),
(14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Únete a la mayor comunidad de odontología online', 'Aprovecha nuestra activa comunidad de instructores para ayudarte en el proceso de creación de tu curso. Comparte tus conocimientos y ayuda a otros profesionales a avanzar en sus carreras y explorar sus inquietudes.', 'beneficios', 'profesores', 'A'),
(15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Digitalízate', 'La formación online es el futuro de la enseñanza. El alumno moderno quiere informarse al instante y en cualquier parte. Promociona tu marca personal por todo el mundo.', 'beneficios', 'profesores', 'A'),
(16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Lorem ipsum Cuatro', 'Lorem ipsum', 'beneficios', 'profesores', 'X'),
(17, 1, NULL, 'info@indesid.com', NULL, NULL, NULL, NULL, NULL, NULL, 'footer', 'all', 'A'),
(18, 2, NULL, '+51 999-000-9999', NULL, NULL, NULL, NULL, NULL, NULL, 'footer', 'all', 'A'),
(19, 3, NULL, 'Avenida Generalitat 5, 4º 1ª, Sant Just Desvern, 08960 Barcelona, España', NULL, NULL, NULL, NULL, NULL, NULL, 'footer', 'all', 'A'),
(20, NULL, NULL, 'Fórmate en <span class=\"text-light\">Odontología</span> con los expertos de cada especialidad', NULL, NULL, NULL, NULL, NULL, NULL, 'calltoaction', 'index', 'A'),
(21, NULL, NULL, 'Entérate de los mejores eventos <span class=\"text-aqua\">online</span> que tenemos preparados para ti', NULL, NULL, NULL, NULL, NULL, NULL, 'webinars', 'index', 'A'),
(22, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'cursosporcate', 'index', 'A'),
(23, NULL, 'se-un-profesor.jpg', 'Se parte de la mayor comunidad de formación online en el ámbito dental y muestra al mundo tus conocimientos. ', NULL, NULL, NULL, NULL, NULL, NULL, 'seunprofesor', 'index', 'A'),
(24, 4, NULL, 'En INDESID contamos con expertos en todas las áreas de la odontología que te acompañarán en tu formación. Podrás aprender las técnicas más actuales de la mano de reconocidos expertos en el sector.', NULL, NULL, NULL, NULL, 'Nuestros profesores', NULL, 'nuestrosprofesores', 'index', 'A'),
(25, NULL, NULL, 'Tu también puedes ser uno de nuestros <span class=\"text-aqua\">profesores</span> y ser parte de la comunidad odontológica', NULL, NULL, NULL, NULL, NULL, NULL, 'calltoactionprofe', 'index', 'A'),
(26, NULL, 'contacto.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'contacto', 'index', 'A'),
(27, 0, 'hero-profesor.jpg', 'Se parte de nuestra comunidad de profesores en todo el mundo', NULL, NULL, NULL, NULL, NULL, NULL, 'slider', 'profesores', 'A'),
(28, NULL, NULL, 'Muestra al mundo tus conocimientos y contribuye en la formación de miles de alumnos', NULL, NULL, NULL, NULL, NULL, NULL, 'calltoactionpagpro', 'profesores', 'A'),
(29, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'Miembros del Staff', NULL, 'staff', 'profesores', 'A'),
(30, 1, 'hero-profesor.jpg', 'Los mejores profesores de la comunidad odontológica', NULL, NULL, NULL, NULL, NULL, NULL, 'slider', 'profesores', 'A'),
(31, NULL, 'hero-alumno-logueado.jpg', 'Encuentra los cursos de tu interés', NULL, NULL, NULL, NULL, NULL, NULL, 'hero', 'cursos', 'A'),
(32, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'cursos', 'cursos', 'A'),
(33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'activafiltros', 'index', 'X'),
(34, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'activafiltros', 'cursos', 'X');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adm_notificaciones`
--

DROP TABLE IF EXISTS `adm_notificaciones`;
CREATE TABLE `adm_notificaciones` (
  `id` int(11) NOT NULL,
  `profesorid` int(11) DEFAULT NULL,
  `profesor` varchar(64) DEFAULT NULL,
  `notificacion` text DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `respuesta` text DEFAULT NULL,
  `fecharespuesta` date DEFAULT NULL,
  `estado` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `adm_notificaciones`
--

INSERT INTO `adm_notificaciones` (`id`, `profesorid`, `profesor`, `notificacion`, `fecha`, `respuesta`, `fecharespuesta`, `estado`) VALUES
(1, 8, 'Juan López', 'Estimado profesor López:\r\nAún no ha indicado si tiene algún curso para publicar en la plataforma.\r\nNos avisa por favor.\r\nGracias!', '2021-10-08', 'Estoy terminando de grabar los videos del curso. En cuanto los tenga todos revisados les enviaré mi propuesta. Muchas gracias.', '2021-10-08', 'T'),
(2, 12, 'Chelo López', 'Por favor actualice su CV. No escriba gfgfggffgfh', '2021-10-09', 'okey', '2021-10-09', 'T'),
(3, 21, 'Claudio  Iacono', 'hola', '2021-11-05', NULL, NULL, 'P'),
(4, 21, 'Claudio  Iacono', '9', '2021-11-05', NULL, NULL, 'P'),
(5, 21, 'Claudio  Iacono', 'uuu', '2021-11-05', NULL, NULL, 'P'),
(6, 17, 'Chelillo  Gutierrez', 'recuerdas tu contraseña?', '2021-12-05', NULL, NULL, 'P');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adm_pagos`
--

DROP TABLE IF EXISTS `adm_pagos`;
CREATE TABLE `adm_pagos` (
  `id` int(11) NOT NULL,
  `profesorid` int(11) DEFAULT NULL,
  `correo` varchar(96) DEFAULT NULL,
  `mes` char(2) DEFAULT NULL,
  `anio` varchar(4) DEFAULT NULL,
  `tarjeta` varchar(16) DEFAULT NULL,
  `titular` varchar(64) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `transaccion` varchar(64) DEFAULT NULL,
  `cuentaorigen` varchar(32) DEFAULT NULL,
  `cuentadestino` varchar(32) DEFAULT NULL,
  `monto` decimal(8,2) DEFAULT NULL,
  `status` varchar(16) DEFAULT NULL,
  `estado` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `adm_pagos`
--

INSERT INTO `adm_pagos` (`id`, `profesorid`, `correo`, `mes`, `anio`, `tarjeta`, `titular`, `fecha`, `transaccion`, `cuentaorigen`, `cuentadestino`, `monto`, `status`, `estado`) VALUES
(1, 4, 'barely@breathing.local', '10', '2021', NULL, 'Duncan Sheik', '2021-12-06', NULL, NULL, NULL, '0.00', 'Pagado', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adm_panel`
--

DROP TABLE IF EXISTS `adm_panel`;
CREATE TABLE `adm_panel` (
  `id` int(11) NOT NULL,
  `usuario` varchar(64) DEFAULT NULL,
  `contra` varchar(64) DEFAULT NULL,
  `nombre` varchar(32) DEFAULT NULL,
  `tipo` char(2) DEFAULT NULL,
  `rol` varchar(16) DEFAULT NULL,
  `ultimoacceso` datetime DEFAULT NULL,
  `pattern` varchar(64) DEFAULT NULL,
  `sesionactiva` char(1) DEFAULT NULL,
  `estado` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `adm_panel`
--

INSERT INTO `adm_panel` (`id`, `usuario`, `contra`, `nombre`, `tipo`, `rol`, `ultimoacceso`, `pattern`, `sesionactiva`, `estado`) VALUES
(1, 'YWRtaW5AaW5kZXNpZA==', 'fa34d533a171c692d99ca820ac6bff863b52819d', 'Admin Indesid', 'AD', 'Administrador', '2022-09-12 08:18:40', NULL, 'S', 'A'),
(2, 'bGlvbmVsQG1lc3NpLnBzZw==', '28651559650028f8fc1d2c8eb2055106d0cc9eb2', 'Lionel Messi', 'US', 'Usuario', '2021-10-08 09:01:01', NULL, 'S', 'A'),
(3, 'Y3Jpc3RpYW5vQHJvbmFsZG8ubXU=', '28651559650028f8fc1d2c8eb2055106d0cc9eb2', 'Cristiano Ronaldo', 'FI', 'Financiero', '2021-10-08 09:01:46', NULL, 'S', 'A'),
(4, 'bmV5QG1hci5wc2c=', '28651559650028f8fc1d2c8eb2055106d0cc9eb2', 'Neymar Jr', 'IZ', 'Contenido', '2021-10-08 09:02:24', NULL, 'S', 'A'),
(5, 'bWFyY2Vsb2xvcGV6d29ya0BnbWFpbC5jb20=', 'b2fe54350488d3d6b849ab04eadac4995533c5a8', 'Marcelo López', 'IZ', 'Contenido', '2021-11-11 01:24:14', 'marcelolopezwork@gmail.com', 'S', 'A'),
(6, 'bWFyY2Vsb0B0aGVwdWJsaXNoZXJsYWIuY29t', '3937e98c74ead6b196ea162769dad3abc48ed058', 'chelo', 'US', 'Usuario', '2021-11-11 01:19:48', 'marcelo@thepublisherlab.com', 'N', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

DROP TABLE IF EXISTS `alumnos`;
CREATE TABLE `alumnos` (
  `id` int(11) NOT NULL,
  `transaccionid` int(11) DEFAULT NULL,
  `usuarioid` int(11) DEFAULT NULL,
  `categoriaid` int(11) DEFAULT NULL,
  `profesorid` int(11) DEFAULT NULL,
  `cursoid` int(11) DEFAULT NULL,
  `claseid` int(11) DEFAULT NULL,
  `megusta` int(11) DEFAULT 0,
  `fecha` date DEFAULT NULL,
  `marca` int(11) DEFAULT NULL,
  `material` char(1) DEFAULT NULL,
  `completado` char(1) DEFAULT NULL,
  `nota` int(11) DEFAULT NULL,
  `certificado` date DEFAULT NULL,
  `estado` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`id`, `transaccionid`, `usuarioid`, `categoriaid`, `profesorid`, `cursoid`, `claseid`, `megusta`, `fecha`, `marca`, `material`, `completado`, `nota`, `certificado`, `estado`) VALUES
(1, 1, 1, 1, 1, 2, 1, 1, '2021-08-09', 2, NULL, 'N', NULL, NULL, 'A'),
(2, 2, 3, 1, 1, 2, 1, 1, '2021-08-31', 1, NULL, 'N', NULL, NULL, 'A'),
(3, 3, 9, 1, 1, 2, 1, 0, '2021-09-01', 1, NULL, 'N', NULL, NULL, 'A'),
(4, 4, 10, 1, 1, 1, 1, 1, '2021-09-01', 1, NULL, 'N', NULL, NULL, 'A'),
(5, 5, 4, 1, 6, 3, 1, 0, '2021-09-01', 1, NULL, 'N', NULL, NULL, 'A'),
(6, 6, 1, 1, 1, 1, 1, 1, '2021-09-01', 3, NULL, 'N', NULL, NULL, 'A'),
(7, 7, 11, 3, 3, 7, 1, 0, '2021-09-05', 1, NULL, 'N', NULL, NULL, 'A'),
(8, 8, 8, 3, 10, 10, 1, 0, '2021-09-07', 1, NULL, 'N', NULL, NULL, 'A'),
(9, 9, 9, 4, 5, 9, 1, 0, '2021-09-13', 1, NULL, 'N', NULL, NULL, 'A'),
(10, 10, 9, 2, 2, 6, 1, 0, '2021-09-13', 1, NULL, 'N', NULL, NULL, 'A'),
(11, 12, 1, 2, 2, 6, 1, 0, '2021-09-17', 0, NULL, 'N', NULL, NULL, 'X'),
(12, 13, 4, 3, 4, 8, 1, 0, '2021-10-08', 1, NULL, 'N', NULL, NULL, 'X'),
(13, 15, 21, 3, 10, 10, 1, 0, '2021-10-09', 1, NULL, 'N', NULL, NULL, 'X'),
(14, 17, 21, 1, 1, 1, 1, 1, '2021-10-09', 1, NULL, 'N', NULL, NULL, 'A'),
(15, 18, 21, 1, 1, 2, 1, 1, '2021-10-09', 1, NULL, 'N', NULL, NULL, 'A'),
(16, 19, 21, 3, 10, 10, 1, 0, '2021-10-09', 1, NULL, 'N', NULL, NULL, 'A'),
(17, 20, 33, 3, 3, 7, 1, 0, '2021-11-05', 2, NULL, 'N', NULL, NULL, 'A'),
(18, 21, 33, 3, 4, 8, 1, 0, '2021-11-06', 1, NULL, 'N', NULL, NULL, 'A'),
(19, 22, 1, 4, 7, 4, 1, 1, '2021-11-18', 2, NULL, 'N', NULL, NULL, 'A'),
(20, 23, 37, 4, 7, 4, 1, 1, '2021-12-05', 1, NULL, 'N', NULL, NULL, 'A'),
(21, 24, 11, 4, 5, 9, 1, 0, '2021-12-07', 2, NULL, 'N', NULL, NULL, 'X'),
(22, 26, 37, 3, 4, 8, 1, 0, '2022-01-02', 1, NULL, 'N', NULL, NULL, 'X');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `categoria` varchar(64) DEFAULT NULL,
  `color` varchar(12) DEFAULT NULL,
  `slug` varchar(64) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `estado` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `categoria`, `color`, `slug`, `fecha`, `estado`) VALUES
(1, 'Odontología', 'blue', 'odontologia', '2020-10-01', 'A'),
(2, 'Técnicos protésicos', 'green', 'tecnicos-protesicos', '2020-10-01', 'A'),
(3, 'Auxiliares dentales e higienistas', 'cyan', 'auxiliares-dentales-e-higienicos', '2020-10-01', 'A'),
(4, 'Estética orofacial', 'yellow', 'estetica-orofacial', '2020-10-01', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clases`
--

DROP TABLE IF EXISTS `clases`;
CREATE TABLE `clases` (
  `id` int(11) NOT NULL,
  `categoriaid` int(11) DEFAULT NULL,
  `cursoid` int(11) DEFAULT NULL,
  `moduloid` int(11) DEFAULT NULL,
  `orden` int(11) DEFAULT NULL,
  `clase` varchar(96) DEFAULT NULL,
  `slug` varchar(96) DEFAULT NULL,
  `video` varchar(128) DEFAULT NULL,
  `duracion` time DEFAULT NULL,
  `notas` char(1) DEFAULT NULL,
  `archivos` varchar(128) DEFAULT NULL,
  `estado` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `clases`
--

INSERT INTO `clases` (`id`, `categoriaid`, `cursoid`, `moduloid`, `orden`, `clase`, `slug`, `video`, `duracion`, `notas`, `archivos`, `estado`) VALUES
(1, 1, 1, 1, 1, 'Clase Introductoria', 'odontologia-microcelular-introductoria', 'https://vimeo.com/502358843', '00:02:22', NULL, NULL, 'A'),
(2, 1, 1, 1, 2, 'Clase Uno', 'odontologia-microcelular-uno', 'https://vimeo.com/502358844', '00:03:13', NULL, NULL, 'A'),
(3, 1, 1, 2, 3, 'Clase Dos', 'odontologia-microcelular-dos', 'https://vimeo.com/502358845', '00:04:15', NULL, NULL, 'A'),
(4, 1, 1, 2, 4, 'Clase Tres', 'odontologia-microcelular-tres', 'https://vimeo.com/502358846', '00:04:37', NULL, NULL, 'A'),
(5, 1, 1, 2, 5, 'Clase Cuatro', 'odontologia-microcelular-cuatro', 'https://vimeo.com/502358847', '00:03:10', NULL, NULL, 'A'),
(6, 1, 2, 3, 1, 'Clase Introductoria', 'implantes-de-titanio-en-adulto-mayor-introductoria', 'https://vimeo.com/502358863', '00:02:20', NULL, NULL, 'A'),
(7, 1, 2, 3, 2, 'Clase Uno', 'implantes-de-titanio-en-adulto-mayor-uno', 'https://vimeo.com/502358864', '00:07:12', NULL, NULL, 'A'),
(8, 1, 2, 4, 3, 'Clase Dos', 'implantes-de-titanio-en-adulto-mayor-dos', 'https://vimeo.com/502358865', '00:03:35', NULL, NULL, 'A'),
(9, 1, 2, 4, 4, 'Clase Tres', 'implantes-de-titanio-en-adulto-mayor-tres', 'https://vimeo.com/502358866', '00:03:18', NULL, NULL, 'A'),
(10, 1, 2, 5, 5, 'Clase Cuatro', 'implantes-de-titanio-en-adulto-mayor-cuatro', 'https://vimeo.com/502358867', '00:02:18', NULL, NULL, 'A'),
(11, 1, 2, 5, 6, 'Clase Cinco', 'implantes-de-titanio-en-adulto-mayor-cinco', 'https://vimeo.com/502358868', '00:05:16', NULL, NULL, 'A'),
(12, 1, 3, 6, 1, 'Clase Introductoria', 'mi-primer-curso-dental-introductoria', 'https://vimeo.com/502358843', '00:01:32', NULL, NULL, 'X'),
(13, 1, 3, 6, 2, 'Clase Uno', 'mi-primer-curso-dental-uno', 'https://vimeo.com/502358843', '00:11:23', NULL, NULL, 'X'),
(14, 1, 3, 7, 3, 'Clase Dos', 'mi-primer-curso-dental-dos', 'https://vimeo.com/502358843', '00:07:19', NULL, NULL, 'X'),
(15, 1, 3, 7, 4, 'Clase Tres', 'mi-primer-curso-dental-tres', 'https://vimeo.com/502358843', '00:05:44', NULL, NULL, 'X'),
(16, 1, 3, 8, 5, 'Clase Cuatro', 'mi-primer-curso-dental-cuatro', 'https://vimeo.com/502358843', '00:10:15', NULL, NULL, 'X'),
(17, 1, 3, 8, 6, 'Clase Cinco', 'mi-primer-curso-dental-cinco', 'https://vimeo.com/502358843', '00:02:33', NULL, NULL, 'X'),
(18, 4, 4, 9, 1, 'Clase Introductoria', 'tecnicas-aplicadas-a-molares-y-caninos-introductoria', 'https://vimeo.com/502358843', '00:02:17', NULL, NULL, 'A'),
(19, 4, 4, 9, 2, 'Clase Uno', 'tecnicas-aplicadas-a-molares-y-caninos-uno', 'https://vimeo.com/502358843', '00:06:11', NULL, NULL, 'A'),
(20, 4, 4, 10, 3, 'Clase Dos', 'tecnicas-aplicadas-a-molares-y-caninos-dos', 'https://vimeo.com/502358843', '00:13:45', NULL, NULL, 'A'),
(21, 4, 4, 10, 4, 'Clase Tres', 'tecnicas-aplicadas-a-molares-y-caninos-tres', 'https://vimeo.com/502358843', '00:04:54', NULL, NULL, 'A'),
(22, 2, 5, 11, 1, 'Clase Introductoria', 'mecanica-dental-con-implantes-3d-introductoria', 'https://vimeo.com/502358843', '00:04:19', NULL, NULL, 'A'),
(23, 2, 5, 11, 2, 'Clase Uno', 'mecanica-dental-con-implantes-3d-uno', 'https://vimeo.com/502358843', '00:11:20', NULL, NULL, 'A'),
(24, 2, 5, 11, 3, 'Clase Dos', 'mecanica-dental-con-implantes-3d-dos', 'https://vimeo.com/502358843', '00:07:13', NULL, NULL, 'A'),
(25, 2, 5, 12, 4, 'Clase Tres', 'mecanica-dental-con-implantes-3d-tres', 'https://vimeo.com/502358843', '00:13:49', NULL, NULL, 'A'),
(26, 2, 5, 12, 5, 'Clase Cuatro', 'mecanica-dental-con-implantes-3d-cuatro', 'https://vimeo.com/502358843', '00:03:20', NULL, NULL, 'A'),
(27, 2, 6, 13, 1, 'Clase Introductoria', 'impresiones-3d-en-poliuretano-introductoria', 'https://vimeo.com/502358843', '00:03:46', NULL, 'mat-27.zip', 'A'),
(28, 2, 6, 13, 2, 'Clase Uno', 'impresiones-3d-en-poliuretano-uno', 'https://vimeo.com/502358843', '00:10:13', NULL, NULL, 'A'),
(29, 2, 6, 14, 3, 'Clase Dos', 'impresiones-3d-en-poliuretano-dos', 'https://vimeo.com/502358843', '00:08:51', NULL, NULL, 'A'),
(30, 2, 6, 14, 4, 'Clase Tres', 'impresiones-3d-en-poliuretano-tres', 'https://vimeo.com/502358843', '00:13:42', NULL, NULL, 'A'),
(31, 2, 6, 15, 5, 'Clase Cuatro', 'impresiones-3d-en-poliuretano-cuatro', 'https://vimeo.com/502358843', '00:03:37', NULL, NULL, 'A'),
(32, 3, 7, 16, 1, 'Clase Introductoria', 'aspisectomia-digital-introductoria', 'https://vimeo.com/502358843', '00:11:23', NULL, NULL, 'X'),
(33, 3, 7, 16, 2, 'Clase Uno', 'aspisectomia-digital-uno', 'https://vimeo.com/502358843', '00:11:23', NULL, NULL, 'X'),
(34, 3, 7, 17, 3, 'Clase Dos', 'aspisectomia-digital-dos', 'https://vimeo.com/502358843', '00:11:23', NULL, NULL, 'X'),
(35, 3, 7, 17, 4, 'Clase Tres', 'aspisectomia-digital-tres', 'https://vimeo.com/502358843', '00:11:23', NULL, NULL, 'X'),
(36, 3, 7, 17, 5, 'Clase Cuatro', 'aspisectomia-digital-cuatro', 'https://vimeo.com/502358843', '00:11:23', NULL, NULL, 'X'),
(37, 3, 8, 18, 1, 'Clase Introductoria', 'higiene-bucodental-introductoria', 'https://vimeo.com/502358843', '00:02:23', NULL, NULL, 'A'),
(38, 3, 8, 18, 2, 'Clase Uno', 'higiene-bucodental-uno', 'https://vimeo.com/502358843', '00:14:19', NULL, NULL, 'A'),
(39, 3, 8, 19, 3, 'Clase Dos', 'higiene-bucodental-dos', 'https://vimeo.com/502358843', '00:08:37', NULL, NULL, 'A'),
(40, 3, 8, 19, 4, 'Clase Tres', 'higiene-bucodental-tres', 'https://vimeo.com/502358843', '00:11:03', NULL, NULL, 'A'),
(41, 3, 8, 20, 5, 'Clase Cuatro', 'higiene-bucodental-cuatro', 'https://vimeo.com/502358843', '00:15:41', NULL, NULL, 'A'),
(42, 3, 8, 20, 6, 'Clase Cinco', 'higiene-bucodental-cinco', 'https://vimeo.com/502358843', '00:02:23', NULL, NULL, 'A'),
(43, 4, 9, 21, 1, 'Clase Introductoria', 'introduccion-a-la-odontologia-molecular-introductoria', 'https://vimeo.com/502358843', '00:11:23', NULL, NULL, 'A'),
(44, 4, 9, 21, 2, 'Clase Uno', 'introduccion-a-la-odontologia-molecular-uno', 'https://vimeo.com/502358843', '00:11:23', NULL, NULL, 'A'),
(45, 4, 9, 22, 3, 'Clase Dos', 'introduccion-a-la-odontologia-molecular-dos', 'https://vimeo.com/502358843', '00:10:23', NULL, NULL, 'A'),
(46, 4, 9, 22, 4, 'Clase Tres', 'introduccion-a-la-odontologia-molecular-tres', 'https://vimeo.com/502358843', '00:10:23', NULL, NULL, 'A'),
(47, 4, 9, 22, 5, 'Clase Cuatro', 'introduccion-a-la-odontologia-molecular-cuatro', 'https://vimeo.com/502358843', '00:10:23', NULL, NULL, 'A'),
(48, 3, 10, 23, 1, 'Clase Introductoria', 'higiene-en-el-adulto-mayor-introductoria', 'https://vimeo.com/502358843', '00:11:20', NULL, NULL, 'A'),
(49, 3, 10, 23, 2, 'Clase Uno', 'higiene-en-el-adulto-mayor-uno', 'https://vimeo.com/502358843', '00:11:21', NULL, NULL, 'A'),
(50, 3, 10, 24, 3, 'Clase Dos', 'higiene-en-el-adulto-mayor-dos', 'https://vimeo.com/502358843', '00:11:22', NULL, NULL, 'A'),
(51, 3, 10, 24, 4, 'Clase Tres', 'higiene-en-el-adulto-mayor-tres', 'https://vimeo.com/502358843', '00:11:23', NULL, NULL, 'A'),
(52, 3, 10, 25, 5, 'Clase Cuatro', 'higiene-en-el-adulto-mayor-cuatro', 'https://vimeo.com/502358843', '00:11:24', NULL, NULL, 'A'),
(53, 3, 10, 25, 6, 'Clase Cinco', 'higiene-en-el-adulto-mayor-cinco', 'https://vimeo.com/502358843', '00:11:25', NULL, NULL, 'A'),
(54, 3, 10, 25, 7, 'Clase Seis', 'higiene-en-el-adulto-mayor-seis', 'https://vimeo.com/502358843', '00:11:26', NULL, 'mat-54.zip', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `claves`
--

DROP TABLE IF EXISTS `claves`;
CREATE TABLE `claves` (
  `id` int(11) NOT NULL,
  `correo` varchar(64) NOT NULL,
  `clave` varchar(96) NOT NULL,
  `usuarioid` int(11) NOT NULL,
  `ip` varchar(16) NOT NULL,
  `verificado` char(1) NOT NULL,
  `hash` varchar(96) NOT NULL,
  `fecha` date NOT NULL,
  `estado` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `claves`
--

INSERT INTO `claves` (`id`, `correo`, `clave`, `usuarioid`, `ip`, `verificado`, `hash`, `fecha`, `estado`) VALUES
(1, 'profesor@indesid.com', '$2y$10$MAX7dSXUGf3R6AbAmqvwEuIIouVugyzzNVS0LZ4VxfHk/9TOVYhKm', 2, '::1', '0', 'd38566ca5f020aea7c65f79944206e4b', '2022-09-11', 'P'),
(2, 'profesor@indesid.com', '$2y$10$MAX7dSXUGf3R6AbAmqvwEuIIouVugyzzNVS0LZ4VxfHk/9TOVYhKm', 2, '::1', '0', 'ec3e1a2df3a06a545d9467b1fef3317f', '2022-09-11', 'P'),
(3, 'profesor@indesid.com', '$2y$10$MAX7dSXUGf3R6AbAmqvwEuIIouVugyzzNVS0LZ4VxfHk/9TOVYhKm', 2, '::1', '0', 'e7b0722c0e0ff0f8da488697559d9b04', '2022-09-11', 'P'),
(4, 'profesor@indesid.com', '$2y$10$MAX7dSXUGf3R6AbAmqvwEuIIouVugyzzNVS0LZ4VxfHk/9TOVYhKm', 2, '::1', '0', 'ea75103b2345908d5c28e774a770d7a9', '2022-09-11', 'P');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

DROP TABLE IF EXISTS `comentarios`;
CREATE TABLE `comentarios` (
  `id` int(11) NOT NULL,
  `comentario` text DEFAULT NULL,
  `usuarioid` int(11) DEFAULT NULL,
  `cursoid` int(11) DEFAULT NULL,
  `profesorid` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `revisado` date DEFAULT NULL,
  `respuesta` text DEFAULT NULL,
  `estado` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto`
--

DROP TABLE IF EXISTS `contacto`;
CREATE TABLE `contacto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(96) DEFAULT NULL,
  `correo` varchar(64) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `pais` char(2) DEFAULT NULL,
  `mensaje` mediumtext DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `respuesta` date DEFAULT NULL,
  `estado` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

DROP TABLE IF EXISTS `cursos`;
CREATE TABLE `cursos` (
  `id` int(11) NOT NULL,
  `curso` varchar(64) DEFAULT NULL,
  `slug` varchar(64) DEFAULT NULL,
  `categoriaid` int(11) DEFAULT NULL,
  `descripcion` mediumtext DEFAULT NULL,
  `profesorid` int(11) DEFAULT NULL,
  `modulos` int(11) DEFAULT NULL,
  `clases` int(11) DEFAULT NULL,
  `megusta` int(11) DEFAULT NULL,
  `precioventa` decimal(7,2) DEFAULT NULL,
  `preciooferta` decimal(7,2) DEFAULT NULL,
  `ofertaactiva` char(1) DEFAULT NULL,
  `estudiantes` int(11) DEFAULT NULL,
  `nivel` char(1) DEFAULT NULL,
  `duraciontotal` time DEFAULT NULL,
  `audio` char(2) DEFAULT NULL,
  `subtitulos` char(2) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `fechalanzamiento` date DEFAULT NULL,
  `fechaactualizacion` date DEFAULT NULL,
  `publicado` char(1) DEFAULT NULL,
  `novedad` char(1) DEFAULT NULL,
  `comision` decimal(5,2) DEFAULT NULL,
  `imagen` varchar(96) DEFAULT NULL,
  `trailer` text DEFAULT NULL,
  `certificacion` varchar(64) DEFAULT NULL,
  `principal` char(1) DEFAULT NULL,
  `venta` char(1) DEFAULT NULL,
  `estado` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`id`, `curso`, `slug`, `categoriaid`, `descripcion`, `profesorid`, `modulos`, `clases`, `megusta`, `precioventa`, `preciooferta`, `ofertaactiva`, `estudiantes`, `nivel`, `duraciontotal`, `audio`, `subtitulos`, `fecha`, `fechalanzamiento`, `fechaactualizacion`, `publicado`, `novedad`, `comision`, `imagen`, `trailer`, `certificacion`, `principal`, `venta`, `estado`) VALUES
(1, 'Odontología microcelular', 'odontologia-microcelular', 1, 'Amet voluptatibus expedita reiciendis voluptate dolor cum quo at animi, illum quaerat consectetur neque aperiam veritatis aliquid culpa quibusdam corrupti iure nesciunt. Quaerat quasi amet iste nemo accusantium dolores nulla voluptas consequatur, ut dolore molestiae eius aut et officia a deleniti veritatis velit maiores. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Amet voluptatibus expedita reiciendis voluptate dolor cum quo at animi, illum quaerat consectetur neque aperiam veritatis aliquid culpa quibusdam corrupti iure nesciunt.', 1, 2, 5, 1, '199.00', '50.00', 'N', 3, 'B', '00:17:37', 'ES', 'NO', '2021-08-10', '2021-08-10', '2021-09-05', 'S', 'S', '50.00', 'curso-1.jpg', 'https://vimeo.com/502358843', NULL, 'S', 'S', 'A'),
(2, 'Implantes de titanio en Adulto Mayor', 'implantes-de-titanio-en-adulto-mayor', 1, 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 1, 3, 6, 1, '179.00', '149.00', 'N', 3, 'B', '00:23:59', 'ES', 'NO', '2021-08-10', '2021-08-10', '2021-09-05', 'S', 'S', '50.00', 'curso-2.jpg', 'https://vimeo.com/502358843', NULL, 'S', 'S', 'A'),
(3, 'Mi primer curso dental', 'mi-primer-curso-dental', 1, 'Consectetur adipisicing elit. Odit, laudantium? Eveniet adipisci aut magnam aperiam repellendus, sunt suscipit nihil nobis, error vel, corporis aspernatur ipsum quos fugiat itaque ipsa repudiandae.', 6, 3, 6, 0, '199.00', '179.00', 'N', 1, 'B', '00:54:23', 'ES', 'NO', '2021-09-01', '2021-09-01', '2021-09-01', 'N', 'N', '50.00', 'logo.jpg', 'https://vimeo.com/502358843', 'El profesor se dio d ebaja y no quiere q su curso continue', 'N', 'N', 'X'),
(4, 'Técnicas aplicadas a molares y caninos', 'tecnicas-aplicadas-a-molares-y-caninos', 4, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 7, 2, 4, 1, '179.00', '149.00', 'S', 2, 'B', '00:27:07', 'ES', 'NO', '2021-09-01', '2021-09-01', '2021-09-05', 'S', 'S', '50.00', 'curso-4.jpg', 'https://vimeo.com/502358843', NULL, 'S', 'S', 'A'),
(5, 'Mecánica dental con implantes 3D', 'mecanica-dental-con-implantes-3d', 2, 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quaerat quasi amet iste nemo accusantium dolores nulla voluptas consequatur, ut dolore molestiae eius aut et officia a deleniti veritatis velit maiores. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Amet voluptatibus expedita reiciendis voluptate dolor cum quo at animi, illum quaerat consectetur neque aperiam veritatis aliquid culpa quibusdam corrupti iure nesciunt.', 2, 2, 5, 0, '179.00', '149.00', 'N', 0, 'B', '00:40:01', 'ES', 'NO', '2021-09-02', '2021-09-02', '2021-09-03', 'S', 'S', '50.00', 'curso-5.jpg', 'https://vimeo.com/502358843', NULL, 'N', 'S', 'A'),
(6, 'Impresiones 3D en poliuretano', 'impresiones-3d-en-poliuretano', 2, 'Ut enim ad minim veniam, quis nostrud 3D exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 2, 3, 5, 0, '179.00', '149.00', 'N', 2, 'B', '00:40:09', 'ES', 'NO', '2021-09-02', '2021-09-02', '2021-09-03', 'S', 'S', '50.00', 'curso-6.jpg', 'https://vimeo.com/502358843', NULL, 'N', 'S', 'A'),
(7, 'Aspisectomía digital', 'aspisectomia-digital', 3, 'Lorem, ipsum consectetur adipisicing elit. Accusamus debitis corrupti laboriosam minima quis minus harum, enim modi distinctio. Id nobis consequuntur quas expedita vero, obcaecati accusamus provident.', 3, 2, 5, 0, '179.00', '149.00', 'N', 2, 'B', '00:56:55', 'ES', 'NO', '2021-09-02', '2021-09-02', '2021-09-03', 'N', 'N', '50.00', 'curso-7.jpg', 'https://vimeo.com/502358843', 'Esto es un test', 'N', 'N', 'X'),
(8, 'Higiene bucodental', 'higiene-bucodental', 3, 'Asit amet consectetur adipisicing elit. sunt quo laborum, ullam similique aliquam, error ea deleniti numquam quae nobis nesciunt sed repudiandae facilis sint nisi ducimus veniam. vel, labore.', 4, 3, 6, 0, '199.00', '179.00', 'N', 3, 'B', '00:54:26', 'ES', 'NO', '2021-09-02', '2021-09-02', '2021-09-03', 'S', 'S', '50.00', 'curso-8.jpg', 'https://vimeo.com/502358843', NULL, 'N', 'S', 'A'),
(9, 'Introducción a la Odontología Molecular', 'introduccion-a-la-odontologia-molecular', 4, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vulputate congue ultrices placerat fermentum quam neque. Sit nisl aliquet risus feugiat nunc tellus adipiscing vel non. Ut enim ut dolor tempus nisi quis. Sagittis felis dictum pulvinar et sollicitudin.', 5, 2, 5, 4, '199.00', '179.00', 'N', 2, 'B', '00:53:55', 'ES', 'NO', '2021-09-02', '2021-09-02', '2021-09-03', 'S', 'S', '40.00', 'curso-9.jpg', 'https://vimeo.com/502358843', NULL, 'N', 'S', 'A'),
(10, 'Higiene dental en el adulto mayor', 'higiene-dental-en-el-adulto-mayor', 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio.', 10, 3, 7, 0, '199.00', '179.00', 'N', 3, 'I', '01:19:41', 'ES', 'NO', '2021-09-06', '2021-09-06', '2021-09-07', 'S', 'S', '40.00', 'curso-10.jpg', 'https://vimeo.com/502358843', NULL, 'S', 'S', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `descuentos`
--

DROP TABLE IF EXISTS `descuentos`;
CREATE TABLE `descuentos` (
  `id` int(11) NOT NULL,
  `descuento` int(11) DEFAULT NULL,
  `preciooferta` decimal(7,2) DEFAULT NULL,
  `cursoid` int(11) DEFAULT NULL,
  `fechaini` date DEFAULT NULL,
  `fechafin` date DEFAULT NULL,
  `ocasion` varchar(72) DEFAULT NULL,
  `estado` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `descuentos`
--

INSERT INTO `descuentos` (`id`, `descuento`, `preciooferta`, `cursoid`, `fechaini`, `fechafin`, `ocasion`, `estado`) VALUES
(1, 50, '50.00', 1, '2021-11-05', '2021-11-05', 'lanzamiento', 'X'),
(2, 50, '149.00', 2, '2021-11-05', '2021-11-05', 'lanzamiento', 'X'),
(3, 50, '179.00', 3, '2021-11-05', '2021-11-05', 'lanzamiento', 'X'),
(4, 50, '149.00', 4, '2021-11-05', '2021-11-05', 'lanzamiento', 'X'),
(5, 50, '149.00', 5, '2021-11-05', '2021-11-05', 'lanzamiento', 'X'),
(6, 50, '149.00', 6, '2021-11-05', '2021-11-05', 'lanzamiento', 'X'),
(7, 50, '149.00', 7, '2021-11-05', '2021-11-05', 'lanzamiento', 'X'),
(8, 50, '179.00', 8, '2021-11-05', '2021-11-05', 'lanzamiento', 'X'),
(9, 50, '179.00', 9, '2021-11-05', '2021-11-05', 'lanzamiento', 'X'),
(10, 50, '179.00', 10, '2021-11-05', '2021-11-05', 'lanzamiento', 'X');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `devoluciones`
--

DROP TABLE IF EXISTS `devoluciones`;
CREATE TABLE `devoluciones` (
  `id` int(11) NOT NULL,
  `transaccionid` varchar(24) DEFAULT NULL,
  `monto` decimal(8,2) DEFAULT NULL,
  `curso` varchar(96) DEFAULT NULL,
  `cursoid` int(11) DEFAULT NULL,
  `usuarioid` int(11) DEFAULT NULL,
  `profesorid` int(11) DEFAULT NULL,
  `comision` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `motivo` text DEFAULT NULL,
  `razon` text DEFAULT NULL,
  `estado` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `devoluciones`
--

INSERT INTO `devoluciones` (`id`, `transaccionid`, `monto`, `curso`, `cursoid`, `usuarioid`, `profesorid`, `comision`, `fecha`, `motivo`, `razon`, `estado`) VALUES
(1, '11', '179.00', 'Impresiones 3D en poliuretano', 6, 9, 2, 50, '2021-09-14', 'El curso es demasiado básico y no llena mis expectativas.', 'El argumento no es válido', 'X'),
(2, '13', '199.00', 'Higiene bucodental', 8, 4, 4, 50, '2021-10-09', 'The course is in Spanish language without subtitles. Sorry I don&#39;t speak Spanish!', NULL, 'A'),
(3, '15', '199.00', 'Higiene dental en el adulto mayor', 10, 21, 10, 40, '2021-10-09', 'no me gusta el curso, en la descripción dice que es avanzado, pero es muy básico, todo lo que vi en el primer video ya lo vi en la uni', NULL, 'A'),
(4, '17', '199.00', 'Odontología microcelular', 1, 21, 1, 50, '2021-10-09', 'no me gusta el tono del profe xd', 'El profesor tiene una voz gutural y por lo tanto no es motivo válido para aprobar su solicitud', 'X'),
(5, '24', '199.00', 'Introducción a la Odontología Molecular', 9, 11, 5, 40, '2021-12-07', 'Sorry. Me equivoqué de curso. Quería comprar otro curso.', NULL, 'A'),
(6, '26', '199.00', 'Higiene bucodental', 8, 37, 4, 50, '2022-01-02', 'USARON MI TARJETA SIN MI CONSENTIMIENTO', NULL, 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulos`
--

DROP TABLE IF EXISTS `modulos`;
CREATE TABLE `modulos` (
  `id` int(11) NOT NULL,
  `categoriaid` int(11) DEFAULT NULL,
  `cursoid` int(11) DEFAULT NULL,
  `profesorid` int(11) DEFAULT NULL,
  `modulo` varchar(128) DEFAULT NULL,
  `clases` int(11) DEFAULT NULL,
  `estado` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `modulos`
--

INSERT INTO `modulos` (`id`, `categoriaid`, `cursoid`, `profesorid`, `modulo`, `clases`, `estado`) VALUES
(1, 1, 1, 1, 'Módulo Uno', 2, 'A'),
(2, 1, 1, 1, 'Módulo Dos', 3, 'A'),
(3, 1, 2, 1, 'Mod Uno', 2, 'A'),
(4, 1, 2, 1, 'Mod Dos', 2, 'A'),
(5, 1, 2, 1, 'Mod Tres', 2, 'A'),
(6, 1, 3, 6, 'Name One', 2, 'X'),
(7, 1, 3, 6, 'Name Two', 2, 'X'),
(8, 1, 3, 6, 'Name Three', 2, 'X'),
(9, 4, 4, 7, 'Módulo Uno', 2, 'A'),
(10, 4, 4, 7, 'Módulo Dos', 2, 'A'),
(11, 2, 5, 2, 'Mod Uno', 3, 'A'),
(12, 2, 5, 2, 'Mod Dos', 2, 'A'),
(13, 2, 6, 2, 'M1', 2, 'A'),
(14, 2, 6, 2, 'M2', 2, 'A'),
(15, 2, 6, 2, 'M3', 1, 'A'),
(16, 3, 7, 3, 'Mod One', 2, 'X'),
(17, 3, 7, 3, 'Mod Two', 3, 'X'),
(18, 3, 8, 4, 'M1', 2, 'A'),
(19, 3, 8, 4, 'M2', 2, 'A'),
(20, 3, 8, 4, 'M3', 2, 'A'),
(21, 4, 9, 5, 'Mod 01', 2, 'A'),
(22, 4, 9, 5, 'Mod 02', 3, 'A'),
(23, 3, 10, 10, 'Módulo 01', 2, 'A'),
(24, 3, 10, 10, 'Módulo 02', 2, 'A'),
(25, 3, 10, 10, 'Módulo 03', 3, 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `niveles`
--

DROP TABLE IF EXISTS `niveles`;
CREATE TABLE `niveles` (
  `id` int(11) NOT NULL,
  `nivel` varchar(24) DEFAULT NULL,
  `inicial` char(1) DEFAULT NULL,
  `estado` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `niveles`
--

INSERT INTO `niveles` (`id`, `nivel`, `inicial`, `estado`) VALUES
(1, 'Estudiante', 'E', 'A'),
(2, 'Técnica', 'T', 'A'),
(3, 'Bachiller', 'B', 'A'),
(4, 'Grado', 'G', 'A'),
(5, 'Máster', 'M', 'A'),
(6, 'Doctorado', 'D', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paises`
--

DROP TABLE IF EXISTS `paises`;
CREATE TABLE `paises` (
  `id` int(11) NOT NULL,
  `country` varchar(64) DEFAULT NULL,
  `pais` varchar(64) DEFAULT NULL,
  `iso` char(4) DEFAULT NULL,
  `prefix` char(2) DEFAULT NULL,
  `flag` tinyblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `paises`
--

INSERT INTO `paises` (`id`, `country`, `pais`, `iso`, `prefix`, `flag`) VALUES
(1, 'Afghanistan', 'Afganistán', '93', 'AF', 0xf09f87a6f09f87ab),
(2, 'Albania', 'Albania', '355', 'AL', 0xf09f87a6f09f87b1),
(3, 'Germany', 'Alemania', '49', 'DE', 0xf09f87a9f09f87aa),
(4, 'Andorra', 'Andorra', '376', 'AD', 0xf09f87a6f09f87a9),
(5, 'Angola', 'Angola', '244', 'AO', 0xf09f87a6f09f87b4),
(6, 'Anguilla', 'Anguila', '1264', 'AI', 0xf09f87a6f09f87ae),
(7, 'Antarctica', 'Antártica', '672', 'AQ', 0xf09f87a6f09f87b6),
(8, 'Antigua and Barbuda', 'Antigua y Barbuda', '1268', 'AG', 0xf09f87a6f09f87ac),
(9, 'Saudi Arabia', 'Arabia Saudita', '966', 'SA', 0xf09f87b8f09f87a6),
(10, 'Algeria', 'Argelia', '213', 'DZ', 0xf09f87a9f09f87bf),
(11, 'Argentina', 'Argentina', '54', 'AR', 0xf09f87a6f09f87b7),
(12, 'Armenia', 'Armenia', '374', 'AM', 0xf09f87a6f09f87b2),
(13, 'Aruba', 'Aruba', '297', 'AW', 0xf09f87a6f09f87bc),
(14, 'Australia', 'Australia', '61', 'AU', 0xf09f87a6f09f87ba),
(15, 'Austria', 'Austria', '43', 'AT', 0xf09f87a6f09f87b9),
(16, 'Azerbaijan', 'Azerbaiyán', '994', 'AZ', 0xf09f87a6f09f87bf),
(17, 'Bahamas', 'Bahamas', '1242', 'BS', 0xf09f87a7f09f87b8),
(18, 'Bangladesh', 'Bangladesh', '880', 'BD', 0xf09f87a7f09f87a9),
(19, 'Barbados', 'Barbados', '1246', 'BB', 0xf09f87a7f09f87a7),
(20, 'Bahrain', 'Baréin', '973', 'BH', 0xf09f87a7f09f87ad),
(21, 'Belgium', 'Bélgica', '32', 'BE', 0xf09f87a7f09f87aa),
(22, 'Belize', 'Belice', '501', 'BZ', 0xf09f87a7f09f87bf),
(23, 'Benin', 'Benín', '229', 'BJ', 0xf09f87a7f09f87af),
(24, 'Bermuda', 'Bermuda', '1441', 'BM', 0xf09f87a7f09f87b2),
(25, 'Belarus', 'Bielorrusia', '375', 'BY', 0xf09f87a7f09f87be),
(26, 'Bolivia, Plurinational State of bolivia', 'Bolivia', '591', 'BO', 0xf09f87a7f09f87b4),
(27, 'Bosnia and Herzegovina', 'Bosnia y Herzegovina', '387', 'BA', 0xf09f87a7f09f87a6),
(28, 'Botswana', 'Botsuana', '267', 'BW', 0xf09f87a7f09f87bc),
(29, 'Brazil', 'Brasil', '55', 'BR', 0xf09f87a7f09f87b7),
(30, 'Brunei Darussalam', 'Brunei', '673', 'BN', 0xf09f87a7f09f87b3),
(31, 'Bulgaria', 'Bulgaria', '359', 'BG', 0xf09f87a7f09f87ac),
(32, 'Burkina Faso', 'Burkina Faso', '226', 'BF', 0xf09f87a7f09f87ab),
(33, 'Burundi', 'Burundi', '257', 'BI', 0xf09f87a7f09f87ae),
(34, 'Bhutan', 'Bután', '975', 'BT', 0xf09f87a7f09f87b9),
(35, 'Cape Verde', 'Cabo Verde', '238', 'CV', 0xf09f87a8f09f87bb),
(36, 'Cambodia', 'Camboya', '855', 'KH', 0xf09f87b0f09f87ad),
(37, 'Cameroon', 'Camerún', '237', 'CM', 0xf09f87a8f09f87b2),
(38, 'Canada', 'Canadá', '1', 'CA', 0xf09f87a8f09f87a6),
(39, 'Chad', 'Chad', '235', 'TD', 0xf09f87b9f09f87a9),
(40, 'Chile', 'Chile', '56', 'CL', 0xf09f87a8f09f87b1),
(41, 'China', 'China', '86', 'CN', 0xf09f87a8f09f87b3),
(42, 'Cyprus', 'Chipre', '357', 'CY', 0xf09f87a8f09f87be),
(43, 'Colombia', 'Colombia', '57', 'CO', 0xf09f87a8f09f87b4),
(44, 'Comoros', 'Comoras', '269', 'KM', 0xf09f87b0f09f87b2),
(45, 'Korea, Democratic People\'s Republic of Korea', 'Corea del Norte', '850', 'KP', 0xf09f87b0f09f87b5),
(46, 'Korea, Republic of South Korea', 'Corea del Sur', '82', 'KR', 0xf09f87b0f09f87b7),
(47, 'Cote d\'Ivoire', 'Costa de Marfil', '225', 'CI', 0xf09f87a8f09f87ae),
(48, 'Costa Rica', 'Costa Rica', '506', 'CR', 0xf09f87a8f09f87b7),
(49, 'Croatia', 'Croacia', '385', 'HR', 0xf09f87adf09f87b7),
(50, 'Cuba', 'Cuba', '53', 'CU', 0xf09f87a8f09f87ba),
(51, 'Netherlands Antilles', 'Curazao', '599', 'AN', ''),
(52, 'Denmark', 'Dinamarca', '45', 'DK', 0xf09f87a9f09f87b0),
(53, 'Dominica', 'Dominica', '1767', 'DM', 0xf09f87a9f09f87b2),
(54, 'Ecuador', 'Ecuador', '593', 'EC', 0xf09f87aaf09f87a8),
(55, 'Egypt', 'Egipto', '20', 'EG', 0xf09f87aaf09f87ac),
(56, 'El Salvador', 'El Salvador', '503', 'SV', 0xf09f87b8f09f87bb),
(57, 'United Arab Emirates', 'Emiratos Árabes Unidos', '971', 'AE', 0xf09f87a6f09f87aa),
(58, 'Eritrea', 'Eritrea', '291', 'ER', 0xf09f87aaf09f87b7),
(59, 'Slovakia', 'Eslovaquia', '421', 'SK', 0xf09f87b8f09f87b0),
(60, 'Slovenia', 'Eslovenia', '386', 'SI', 0xf09f87b8f09f87ae),
(61, 'Spain', 'España', '34', 'ES', 0xf09f87aaf09f87b8),
(62, 'United States', 'Estados Unidos (USA)', '1', 'US', 0xf09f87baf09f87b8),
(63, 'Estonia', 'Estonia', '372', 'EE', 0xf09f87aaf09f87aa),
(64, 'Ethiopia', 'Etiopía', '251', 'ET', 0xf09f87aaf09f87b9),
(65, 'Fiji', 'Fiji', '679', 'FJ', 0xf09f87abf09f87af),
(66, 'Philippines', 'Filipinas', '63', 'PH', 0xf09f87b5f09f87ad),
(67, 'Finland', 'Finlandia', '358', 'FI', 0xf09f87abf09f87ae),
(68, 'France', 'Francia', '33', 'FR', 0xf09f87abf09f87b7),
(69, 'Gabon', 'Gabón', '241', 'GA', 0xf09f87acf09f87a6),
(70, 'Gambia', 'Gambia', '220', 'GM', 0xf09f87acf09f87b2),
(71, 'Georgia', 'Georgia', '995', 'GE', 0xf09f87acf09f87aa),
(72, 'South Georgia and the South Sandwich Islands', 'Georgia del Sur e Islas Sandwich del Sur', '500', 'GS', 0xf09f87acf09f87b8),
(73, 'Ghana', 'Ghana', '233', 'GH', 0xf09f87acf09f87ad),
(74, 'Gibraltar', 'Gibraltar', '350', 'GI', 0xf09f87acf09f87ae),
(75, 'Grenada', 'Granada', '1473', 'GD', 0xf09f87acf09f87a9),
(76, 'Greece', 'Grecia', '30', 'GR', 0xf09f87acf09f87b7),
(77, 'Greenland', 'Groenlandia', '299', 'GL', 0xf09f87acf09f87b1),
(78, 'Guadeloupe', 'Guadalupe', '590', 'GP', 0xf09f87acf09f87b5),
(79, 'Guam', 'Guam', '1671', 'GU', 0xf09f87acf09f87ba),
(80, 'Guatemala', 'Guatemala', '502', 'GT', 0xf09f87acf09f87b9),
(81, 'French Guiana', 'Guayana Francesa', '594', 'GF', 0xf09f87acf09f87ab),
(82, 'Guernsey', 'Guernsey', '44', 'GG', 0xf09f87acf09f87ac),
(83, 'Guinea', 'Guinea', '224', 'GN', 0xf09f87acf09f87b3),
(84, 'Guinea-Bissau', 'Guinea Bissau', '245', 'GW', 0xf09f87acf09f87bc),
(85, 'Equatorial Guinea', 'Guinea Ecuatorial', '240', 'GQ', 0xf09f87acf09f87b6),
(86, 'Guyana', 'Guyana', '592', 'GY', 0xf09f87acf09f87be),
(87, 'Haiti', 'Haití', '509', 'HT', 0xf09f87adf09f87b9),
(88, 'Honduras', 'Honduras', '504', 'HN', 0xf09f87adf09f87b3),
(89, 'Hong Kong', 'Hong Kong', '852', 'HK', 0xf09f87adf09f87b0),
(90, 'Hungary', 'Hungría', '36', 'HU', 0xf09f87adf09f87ba),
(91, 'India', 'India', '91', 'IN', 0xf09f87aef09f87b3),
(92, 'Indonesia', 'Indonesia', '62', 'ID', 0xf09f87aef09f87a9),
(93, 'Iraq', 'Irak', '964', 'IQ', 0xf09f87aef09f87b6),
(94, 'Iran, Islamic Republic of Persian Gulf', 'Irán', '98', 'IR', 0xf09f87aef09f87b7),
(95, 'Ireland', 'Irlanda', '353', 'IE', 0xf09f87aef09f87aa),
(96, 'Bouvet Island', 'Isla Bouvet', '47', 'BV', 0xf09f87a7f09f87bb),
(97, 'Isle of Man', 'Isla de Man', '44', 'IM', 0xf09f87aef09f87b2),
(98, 'Christmas Island', 'Isla de Pascua', '61', 'CX', 0xf09f87a8f09f87bd),
(99, 'Heard Island and Mcdonald Islands', 'Isla Heard e Isla Mcdonald', '672', 'HM', 0xf09f87adf09f87b2),
(100, 'Norfolk Island', 'Isla Norfolk', '672', 'NF', 0xf09f87b3f09f87ab),
(101, 'Iceland', 'Islandia', '354', 'IS', 0xf09f87aef09f87b8),
(102, 'Cayman Islands', 'Islas Caimán', '345', 'KY', 0xf09f87b0f09f87be),
(103, 'Cocos (Keeling) Islands', 'Islas Cocos', '61', 'CC', 0xf09f87a8f09f87a8),
(104, 'Cook Islands', 'Islas Cook', '682', 'CK', 0xf09f87a8f09f87b0),
(105, 'Åland Islands', 'Islas de Aland', '358', 'AX', 0xf09f87a6f09f87bd),
(106, 'Faroe Islands', 'Islas Faroe', '298', 'FO', 0xf09f87abf09f87b4),
(107, 'Falkland Islands (Malvinas)', 'Islas Malvinas', '500', 'FK', 0xf09f87abf09f87b0),
(108, 'Northern Mariana Islands', 'Islas Marianas del Norte', '1670', 'MP', 0xf09f87b2f09f87b5),
(109, 'Marshall Islands', 'Islas Marshall', '692', 'MH', 0xf09f87b2f09f87ad),
(110, 'Pitcairn', 'Islas Pitcairn', '64', 'PN', 0xf09f87b5f09f87b3),
(111, 'Solomon Islands', 'Islas Salomón', '677', 'SB', 0xf09f87b8f09f87a7),
(112, 'Svalbard and Jan Mayen', 'Islas Svalbard y Jan Mayen', '47', 'SJ', 0xf09f87b8f09f87af),
(113, 'Turks and Caicos Islands', 'Islas Turcos y Caicos', '1649', 'TC', 0xf09f87b9f09f87a8),
(114, 'Virgin Islands, British', 'Islas Vírgenes Británicas', '1284', 'VG', 0xf09f87bbf09f87ac),
(115, 'Virgin Islands, U.S.', 'Islas Vírgenes de los EE.UU.', '1340', 'VI', 0xf09f87bbf09f87ae),
(116, 'Israel', 'Israel', '972', 'IL', 0xf09f87aef09f87b1),
(117, 'Italy', 'Italia', '39', 'IT', 0xf09f87aef09f87b9),
(118, 'Jamaica', 'Jamaica', '1876', 'JM', 0xf09f87aff09f87b2),
(119, 'Japan', 'Japón', '81', 'JP', 0xf09f87aff09f87b5),
(120, 'Jersey', 'Jersey', '44', 'JE', 0xf09f87aff09f87aa),
(121, 'Jordan', 'Jordania', '962', 'JO', 0xf09f87aff09f87b4),
(122, 'Kazakhstan', 'Kazajistán', '7', 'KZ', 0xf09f87b0f09f87bf),
(123, 'Kenya', 'Kenia', '254', 'KE', 0xf09f87b0f09f87aa),
(124, 'Kyrgyzstan', 'Kirguistán', '996', 'KG', 0xf09f87b0f09f87ac),
(125, 'Kiribati', 'Kiribati', '686', 'KI', 0xf09f87b0f09f87ae),
(126, 'Kosovo', 'Kosovo', '383', 'XK', 0xf09f87bdf09f87b0),
(127, 'Kuwait', 'Kuwait', '965', 'KW', 0xf09f87b0f09f87bc),
(128, 'Laos', 'Laos', '856', 'LA', 0xf09f87b1f09f87a6),
(129, 'Lesotho', 'Lesoto', '266', 'LS', 0xf09f87b1f09f87b8),
(130, 'Latvia', 'Letonia', '371', 'LV', 0xf09f87b1f09f87bb),
(131, 'Lebanon', 'Líbano', '961', 'LB', 0xf09f87b1f09f87a7),
(132, 'Liberia', 'Liberia', '231', 'LR', 0xf09f87b1f09f87b7),
(133, 'Libyan Arab Jamahiriya', 'Libia', '218', 'LY', 0xf09f87b1f09f87be),
(134, 'Liechtenstein', 'Liechtenstein', '423', 'LI', 0xf09f87b1f09f87ae),
(135, 'Lithuania', 'Lituania', '370', 'LT', 0xf09f87b1f09f87b9),
(136, 'Luxembourg', 'Luxemburgo', '352', 'LU', 0xf09f87b1f09f87ba),
(137, 'Macao', 'Macao', '853', 'MO', 0xf09f87b2f09f87b4),
(138, 'Macedonia', 'Macedonia', '389', 'MK', 0xf09f87b2f09f87b0),
(139, 'Madagascar', 'Madagascar', '261', 'MG', 0xf09f87b2f09f87ac),
(140, 'Malaysia', 'Malasia', '60', 'MY', 0xf09f87b2f09f87be),
(141, 'Malawi', 'Malaui', '265', 'MW', 0xf09f87b2f09f87bc),
(142, 'Maldives', 'Maldivas', '960', 'MV', 0xf09f87b2f09f87bb),
(143, 'Mali', 'Malí', '223', 'ML', 0xf09f87b2f09f87b1),
(144, 'Malta', 'Malta', '356', 'MT', 0xf09f87b2f09f87b9),
(145, 'Morocco', 'Marruecos', '212', 'MA', 0xf09f87b2f09f87a6),
(146, 'Martinique', 'Martinica', '596', 'MQ', 0xf09f87b2f09f87b6),
(147, 'Mauritius', 'Mauricio', '230', 'MU', 0xf09f87b2f09f87ba),
(148, 'Mauritania', 'Mauritania', '222', 'MR', 0xf09f87b2f09f87b7),
(149, 'Mayotte', 'Mayotte', '262', 'YT', 0xf09f87bef09f87b9),
(150, 'Mexico', 'México', '52', 'MX', 0xf09f87b2f09f87bd),
(151, 'Micronesia, Federated States of Micronesia', 'Micronesia', '691', 'FM', 0xf09f87abf09f87b2),
(152, 'Moldova', 'Moldavia', '373', 'MD', 0xf09f87b2f09f87a9),
(153, 'Monaco', 'Mónaco', '377', 'MC', 0xf09f87b2f09f87a8),
(154, 'Mongolia', 'Mongolia', '976', 'MN', 0xf09f87b2f09f87b3),
(155, 'Montenegro', 'Montenegro', '382', 'ME', 0xf09f87b2f09f87aa),
(156, 'Montserrat', 'Montserrat', '1664', 'MS', 0xf09f87b2f09f87b8),
(157, 'Mozambique', 'Mozambique', '258', 'MZ', 0xf09f87b2f09f87bf),
(158, 'Myanmar', 'Myanmar', '95', 'MM', 0xf09f87b2f09f87b2),
(159, 'Namibia', 'Namibia', '264', 'NA', 0xf09f87b3f09f87a6),
(160, 'Nauru', 'Nauru', '674', 'NR', 0xf09f87b3f09f87b7),
(161, 'Nepal', 'Nepal', '977', 'NP', 0xf09f87b3f09f87b5),
(162, 'Nicaragua', 'Nicaragua', '505', 'NI', 0xf09f87b3f09f87ae),
(163, 'Niger', 'Níger', '227', 'NE', 0xf09f87b3f09f87aa),
(164, 'Nigeria', 'Nigeria', '234', 'NG', 0xf09f87b3f09f87ac),
(165, 'Niue', 'Niue', '683', 'NU', 0xf09f87b3f09f87ba),
(166, 'Norway', 'Noruega', '47', 'NO', 0xf09f87b3f09f87b4),
(167, 'New Caledonia', 'Nueva Caledonia', '687', 'NC', 0xf09f87b3f09f87a8),
(168, 'New Zealand', 'Nueva Zelanda', '64', 'NZ', 0xf09f87b3f09f87bf),
(169, 'Oman', 'Omán', '968', 'OM', 0xf09f87b4f09f87b2),
(170, 'Netherlands', 'Países Bajos', '31', 'NL', 0xf09f87b3f09f87b1),
(171, 'Pakistan', 'Pakistán', '92', 'PK', 0xf09f87b5f09f87b0),
(172, 'Palau', 'Palaos', '680', 'PW', 0xf09f87b5f09f87bc),
(173, 'Panama', 'Panamá', '507', 'PA', 0xf09f87b5f09f87a6),
(174, 'Papua New Guinea', 'Papúa Nueva Guinea', '675', 'PG', 0xf09f87b5f09f87ac),
(175, 'Paraguay', 'Paraguay', '595', 'PY', 0xf09f87b5f09f87be),
(176, 'Peru', 'Perú', '51', 'PE', 0xf09f87b5f09f87aa),
(177, 'French Polynesia', 'Polinesia Francesa', '689', 'PF', 0xf09f87b5f09f87ab),
(178, 'Poland', 'Polonia', '48', 'PL', 0xf09f87b5f09f87b1),
(179, 'Portugal', 'Portugal', '351', 'PT', 0xf09f87b5f09f87b9),
(180, 'Puerto Rico', 'Puerto Rico', '1939', 'PR', 0xf09f87b5f09f87b7),
(181, 'Qatar', 'Qatar', '974', 'QA', 0xf09f87b6f09f87a6),
(182, 'United Kingdom', 'Reino Unido', '44', 'GB', 0xf09f87acf09f87a7),
(183, 'Czech Republic', 'República Checa', '420', 'CZ', 0xf09f87a8f09f87bf),
(184, 'Central African Republic', 'República de África Central', '236', 'CF', 0xf09f87a8f09f87ab),
(185, 'Congo', 'República del Congo', '242', 'CG', 0xf09f87a8f09f87ac),
(186, 'Congo, The Democratic Republic of the Congo', 'República Democrática del Congo', '243', 'CD', 0xf09f87a8f09f87a9),
(187, 'Dominican Republic', 'República Dominicana', '1849', 'DO', 0xf09f87a9f09f87b4),
(188, 'Reunion', 'Reunión', '262', 'RE', 0xf09f87b7f09f87aa),
(189, 'Rwanda', 'Ruanda', '250', 'RW', 0xf09f87b7f09f87bc),
(190, 'Romania', 'Rumanía', '40', 'RO', 0xf09f87b7f09f87b4),
(191, 'Russia', 'Rusia', '7', 'RU', 0xf09f87b7f09f87ba),
(192, 'Samoa', 'Samoa', '685', 'WS', 0xf09f87bcf09f87b8),
(193, 'American Samoa', 'Samoa Americana', '1684', 'AS', 0xf09f87a6f09f87b8),
(194, 'Saint Barthelemy', 'San Bartolomé', '590', 'BL', 0xf09f87a7f09f87b1),
(195, 'Saint Kitts and Nevis', 'San Cristóbal y Nieves', '1869', 'KN', 0xf09f87b0f09f87b3),
(196, 'San Marino', 'San Marino', '378', 'SM', 0xf09f87b8f09f87b2),
(197, 'Saint Martin', 'San Martín', '590', 'MF', 0xf09f87b2f09f87ab),
(198, 'Saint Pierre and Miquelon', 'San Pedro y Miguelón', '508', 'PM', 0xf09f87b5f09f87b2),
(199, 'Saint Vincent and the Grenadines', 'San Vicente y las Granadinas', '1784', 'VC', 0xf09f87bbf09f87a8),
(200, 'Saint Helena, Ascension and Tristan Da Cunha', 'Santa Elena, Ascención y Tristán Da Cunha', '290', 'SH', 0xf09f87b8f09f87ad),
(201, 'Saint Lucia', 'Santa Lucía', '1758', 'LC', 0xf09f87b1f09f87a8),
(202, 'Sao Tome and Principe', 'Santo Tomé y Príncipe', '239', 'ST', 0xf09f87b8f09f87b9),
(203, 'Senegal', 'Senegal', '221', 'SN', 0xf09f87b8f09f87b3),
(204, 'Serbia', 'Serbia', '381', 'RS', 0xf09f87b7f09f87b8),
(205, 'Seychelles', 'Seychelles', '248', 'SC', 0xf09f87b8f09f87a8),
(206, 'Sierra Leone', 'Sierra Leona', '232', 'SL', 0xf09f87b8f09f87b1),
(207, 'Singapore', 'Singapur', '65', 'SG', 0xf09f87b8f09f87ac),
(208, 'Syrian Arab Republic', 'Siria', '963', 'SY', 0xf09f87b8f09f87be),
(209, 'Somalia', 'Somalia', '252', 'SO', 0xf09f87b8f09f87b4),
(210, 'Sri Lanka', 'Sri Lanka', '94', 'LK', 0xf09f87b1f09f87b0),
(211, 'Swaziland', 'Suazilandia', '268', 'SZ', 0xf09f87b8f09f87bf),
(212, 'South Africa', 'Sudáfrica', '27', 'ZA', 0xf09f87bff09f87a6),
(213, 'Sudan', 'Sudán', '249', 'SD', 0xf09f87b8f09f87a9),
(214, 'South Sudan', 'Sudán del Sur', '211', 'SS', 0xf09f87b8f09f87b8),
(215, 'Sweden', 'Suecia', '46', 'SE', 0xf09f87b8f09f87aa),
(216, 'Switzerland', 'Suiza', '41', 'CH', 0xf09f87a8f09f87ad),
(217, 'Suriname', 'Surinam', '597', 'SR', 0xf09f87b8f09f87b7),
(218, 'Thailand', 'Tailandia', '66', 'TH', 0xf09f87b9f09f87ad),
(219, 'Taiwan', 'Taiwán', '886', 'TW', 0xf09f87b9f09f87bc),
(220, 'Tanzania, United Republic of Tanzania', 'Tanzania', '255', 'TZ', 0xf09f87b9f09f87bf),
(221, 'Tajikistan', 'Tayikistán', '992', 'TJ', 0xf09f87b9f09f87af),
(222, 'British Indian Ocean Territory', 'Territorio Británico del Océano Índico', '246', 'IO', 0xf09f87aef09f87b4),
(223, 'French Southern Territories', 'Territorios del Sur Francés', '262', 'TF', 0xf09f87b9f09f87ab),
(224, 'Palestinian Territory, Occupied', 'Territorios Palestinos', '970', 'PS', 0xf09f87b5f09f87b8),
(225, 'Timor-Leste', 'Timor Oriental', '670', 'TL', 0xf09f87b9f09f87b1),
(226, 'Togo', 'Togo', '228', 'TG', 0xf09f87b9f09f87ac),
(227, 'Tokelau', 'Tokelau', '690', 'TK', 0xf09f87b9f09f87b0),
(228, 'Tonga', 'Tonga', '676', 'TO', 0xf09f87b9f09f87b4),
(229, 'Trinidad and Tobago', 'Trinidad y Tobago', '1868', 'TT', 0xf09f87b9f09f87b9),
(230, 'Tunisia', 'Túnez', '216', 'TN', 0xf09f87b9f09f87b3),
(231, 'Turkmenistan', 'Turkmenistán', '993', 'TM', 0xf09f87b9f09f87b2),
(232, 'Turkey', 'Turquía', '90', 'TR', 0xf09f87b9f09f87b7),
(233, 'Tuvalu', 'Tuvalu', '688', 'TV', 0xf09f87b9f09f87bb),
(234, 'Ukraine', 'Ucrania', '380', 'UA', 0xf09f87baf09f87a6),
(235, 'Uganda', 'Uganda', '256', 'UG', 0xf09f87baf09f87ac),
(236, 'Uruguay', 'Uruguay', '598', 'UY', 0xf09f87baf09f87be),
(237, 'Uzbekistan', 'Uzbekistán', '998', 'UZ', 0xf09f87baf09f87bf),
(238, 'Vanuatu', 'Vanuatu', '678', 'VU', 0xf09f87bbf09f87ba),
(239, 'Holy See (Vatican City State)', 'Vaticano', '379', 'VA', 0xf09f87bbf09f87a6),
(240, 'Venezuela, Bolivarian Republic of Venezuela', 'Venezuela', '58', 'VE', 0xf09f87bbf09f87aa),
(241, 'Vietnam', 'Vietnam', '84', 'VN', 0xf09f87bbf09f87b3),
(242, 'Wallis and Futuna', 'Wallis y Futuna', '681', 'WF', 0xf09f87bcf09f87ab),
(243, 'Yemen', 'Yemen', '967', 'YE', 0xf09f87bef09f87aa),
(244, 'Djibouti', 'Yibuti', '253', 'DJ', 0xf09f87a9f09f87af),
(245, 'Zambia', 'Zambia', '260', 'ZM', 0xf09f87bff09f87b2),
(246, 'Zimbabwe', 'Zimbabue', '263', 'ZW', 0xf09f87bff09f87bc);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `precios`
--

DROP TABLE IF EXISTS `precios`;
CREATE TABLE `precios` (
  `id` int(11) NOT NULL,
  `precio` int(11) DEFAULT NULL,
  `oferta` int(11) DEFAULT NULL,
  `estado` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `precios`
--

INSERT INTO `precios` (`id`, `precio`, `oferta`, `estado`) VALUES
(1, 199, 179, 'A'),
(2, 179, 149, 'A'),
(3, 149, 119, 'A'),
(4, 99, 79, 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesores`
--

DROP TABLE IF EXISTS `profesores`;
CREATE TABLE `profesores` (
  `id` int(11) NOT NULL,
  `nombres` varchar(32) DEFAULT NULL,
  `apellidos` varchar(32) DEFAULT NULL,
  `slug` varchar(64) DEFAULT NULL,
  `documento` varchar(24) DEFAULT NULL,
  `correo` varchar(72) DEFAULT NULL,
  `clave` varchar(64) DEFAULT NULL,
  `telefono` varchar(24) DEFAULT NULL,
  `genero` char(1) DEFAULT NULL,
  `edad` int(11) DEFAULT NULL,
  `sobremi` text DEFAULT NULL,
  `universidad` varchar(96) DEFAULT NULL,
  `especialidad` varchar(64) DEFAULT NULL,
  `nivelestudio` text DEFAULT NULL,
  `foto` varchar(96) DEFAULT NULL,
  `pais` char(2) DEFAULT NULL,
  `tipo` char(1) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `pattern` varchar(64) DEFAULT NULL,
  `rechazado` text DEFAULT NULL,
  `estado` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `profesores`
--

INSERT INTO `profesores` (`id`, `nombres`, `apellidos`, `slug`, `documento`, `correo`, `clave`, `telefono`, `genero`, `edad`, `sobremi`, `universidad`, `especialidad`, `nivelestudio`, `foto`, `pais`, `tipo`, `fecha`, `pattern`, `rechazado`, `estado`) VALUES
(1, 'Profesor', 'Indesid', 'profesor-indesid', '2222222222', 'profesor@indesid.com', '2', '999000999', 'M', 40, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatum harum, aliquam voluptatibus, ad exercitationem eveniet molestias dolore odit molestiae ducimus labore. Eveniet, velit laudantium. Ad neque magni nostrum atque esse.', 'Particular', 'Estética orofacial', 'Máster', 'profesor-indesid.jpg', 'ES', 'P', '2021-02-12', '$2y$10$MAX7dSXUGf3R6AbAmqvwEuIIouVugyzzNVS0LZ4VxfHk/9TOVYhKm', NULL, 'A'),
(2, 'Ali', 'Gatie', 'ali-gatie', '814015153', 'ali@gatie.local', '5', '+9642323424', 'M', 34, 'He is an Iraqi–Canadian singer and songwriter managed by SAL&CO. His 2019 song &#34;It&#39;s You&#34; charted worldwide, charting on the US Billboard Hot 100[1] and reaching the top 40 in Australia, Canada, Ireland and Sweden and the top 10 in New Zealand and in Germany.', 'Canadian Institutte', 'Técnicos protésicos', 'Técnica', 'ali-gatie.jpg', 'IQ', 'P', '2021-08-31', '$2y$10$MAX7dSXUGf3R6AbAmqvwEuIIouVugyzzNVS0LZ4VxfHk/9TOVYhKm', NULL, 'A'),
(3, 'Prefab', 'Sprout', 'prefab-sprout', '515535155', 'prefab@sprout.local', '6', '+5145125535', 'M', 43, 'Their subsequent albums, including 1985&#39;s Steve McQueen and 1990&#39;s Jordan: The Comeback, have been described by Paul Lester of The Guardian as &#34;some of the most beautiful and intelligent records of their era&#34;. Frontman Paddy McAloon is regarded as one of the great songwriters of his time and the band have been credited with producing some of the &#34;most beloved&#34; pop music of the 1980s and 1990s.', 'De Lima', 'Técnicos protésicos', 'Doctorado', 'prefab-sprout.jpg', 'BO', 'P', '2021-08-31', '$2y$10$MAX7dSXUGf3R6AbAmqvwEuIIouVugyzzNVS0LZ4VxfHk/9TOVYhKm', NULL, 'A'),
(4, 'Duncan', 'Sheik', 'duncan-sheik', '3012045810', 'barely@breathing.local', '7', '+51812450239', 'M', 33, 'Sheik is known for his 1996 debut single \"Barely Breathing\", which earned him a Grammy Award nomination for Best Male Pop Vocal Performance. He has composed music for motion pictures and Broadway musicals, winning the 2006 Tony Awards for Best Original Score and Best Orchestrations for his work on the musical Spring Awakening.', 'Texas', 'Estética orofacial', 'Grado', 'duncan-sheik.jpg', 'CR', 'P', '2021-08-31', '$2y$10$MAX7dSXUGf3R6AbAmqvwEuIIouVugyzzNVS0LZ4VxfHk/9TOVYhKm', NULL, 'A'),
(5, 'Lindsey', 'Buckingham', 'lindsey-buckingham', '1998', 'lbuck@fleetwoodmac.local', '12', '241255122', 'M', 71, 'Lindsey Adams Buckingham (born October 3, 1949) is an American singer, musician, songwriter, and producer, best known as the former lead guitarist and male lead singer of the music group Fleetwood Mac from 1975 to 1987 and 1997 to 2018. In addition to his tenure with Fleetwood Mac, Buckingham has released six solo albums and three live albums. As a member of Fleetwood Mac, he was inducted into the Rock and Roll Hall of Fame in 1998. In 2011, Buckingham was ranked 100th in Rolling Stone&#39;s 2011 list of &#34;The 100 Greatest Guitarists of All Time&#34;.', 'Dallas', 'Auxiliares dentales e higienistas', 'Máster', 'lindsey-buckingham.jpg', 'US', 'R', '2021-09-01', '$2y$10$MAX7dSXUGf3R6AbAmqvwEuIIouVugyzzNVS0LZ4VxfHk/9TOVYhKm', NULL, 'A'),
(6, 'Rosa María', 'Aldizábar', 'rosa-maria-aldizabar', '3214205478', 'rmaldizabar@gmail.local', '13', '+5198035013938', 'F', 37, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio.', 'Bandeirantes', 'Odontología', 'Máster', 'rosa-maria-aldizabar.jpg', 'BR', 'P', '2021-09-01', '$2y$10$MAX7dSXUGf3R6AbAmqvwEuIIouVugyzzNVS0LZ4VxfHk/9TOVYhKm', NULL, 'A'),
(7, 'Elisabet Sabariego', 'Palacio', 'elisabet-sabariego-palacio', '533375573', 'esabariego@gmail.local', '14', '+5162352553', 'F', 42, 'Máster Rehabilitación Minimamente Invasiva y Estética Dental (2015). Máster Implantología y Rehabilitación Implantosoportada (2017). Máster Cirugía Avanzada, Regeneración Ósea y Periodontal (2018). Curso Armonización Orofacial y Venopunción (2019). Curso Cirugía Mucogingival (regeneración tisular guiada) (2019). Postgrado Cirugía Oral y Medicina Oral SCOE (2020). Regeneración Titular Guíada y Concentrados Plaquetarios (2020)', 'Maristes Champagnat', 'Estética orofacial', 'Máster', 'elisabet-sabariego-palacio.jpg', 'ES', 'P', '2021-09-01', '$2y$10$MAX7dSXUGf3R6AbAmqvwEuIIouVugyzzNVS0LZ4VxfHk/9TOVYhKm', NULL, 'A'),
(8, 'Juan', 'López', 'juan-lopez', '625325362', 'jlopez@local.local', '15', '32541353', 'M', 40, 'Crofts lived in Mexico, Australia, and then Nashville, Tennessee, playing country music and making occasional hit singles. He currently resides on a ranch in the Texas Hill Country. Seals moved to Costa Rica and has lived on a coffee farm of and on since 1980, as well as in Nashville and southern Florida. ', 'De la Calle', 'Auxiliares dentales e higienistas', 'Máster', 'juan-lopez.jpg', 'BM', 'R', '2021-09-01', '$2y$10$MAX7dSXUGf3R6AbAmqvwEuIIouVugyzzNVS0LZ4VxfHk/9TOVYhKm', NULL, 'A'),
(9, 'Mariah', 'Carey', 'mariah-carey', '3154312515', 'mariah@carey.local', '16', '222990010', 'F', 46, 'Conocida como el «ave cantora suprema» por el Libro Guinness de los récords, es reconocida por su registro vocal de cinco octavas, su poder, su estilo melismático y por el uso del registro de silbido. Bajo la dirección del productor ejecutivo del sello Columbia Records, Tommy Mottola, Carey lanzó su álbum debut homónimo, Mariah Carey (1990). De este se desprendieron cuatro sencillos que llegaron al primer puesto en la lista Billboard Hot 100. Después de su matrimonio con Mottola y el éxito de sus álbumes posteriores, Music Box (1993) y Merry Christmas (1994), Carey se estableció como la artista con mayores ventas de Columbia.', 'Harvard', 'Odontología', 'Doctorado', 'mariah-carey.jpg', 'US', 'R', '2021-09-02', '$2y$10$MAX7dSXUGf3R6AbAmqvwEuIIouVugyzzNVS0LZ4VxfHk/9TOVYhKm', NULL, 'A'),
(10, 'Patrice', 'Rushen', 'patrice-rushen', '35255261135', 'prushen@forgetmenots.local', '17', '5352353254', 'F', 44, 'Como una pianista en formación clásica, Rushen ha dedicado mucho tiempo en la canalización de sus habilidades para hacer buena música. Ganó el Festival de Jazz de Monterrey en 1972, poniendo a Patrice como el centro de atención. La atención dada a este le valió un contrato con Prestige Records en 1973.', 'La Sorborne', 'Auxiliares dentales e higienistas', 'Bachiller', 'patrice-rushen.jpg', 'BE', 'R', '2021-09-06', '$2y$10$MAX7dSXUGf3R6AbAmqvwEuIIouVugyzzNVS0LZ4VxfHk/9TOVYhKm', NULL, 'A'),
(11, 'Gordon ', 'Sumner', 'gordon-sumner', '142414112555', 'gsumner@sting.local', '18', '41072891', 'M', 53, 'As a solo musician and a member of the Police, Sting has received 17 Grammy Awards: he won Song of the Year for &#34;Every Breath You Take&#34;, three Brit Awards, including Best British Male Artist in 1994 and Outstanding Contribution in 2002, a Golden Globe, an Emmy and four nominations for the Academy Award for Best Original Song. In 2019, he received a BMI Award for &#34;Every Breath You Take&#34; becoming the most-played song in radio history.', 'Police', 'Técnicos protésicos', 'Máster', 'nofoto.svg', 'GB', 'R', '2021-09-08', '$2y$10$MAX7dSXUGf3R6AbAmqvwEuIIouVugyzzNVS0LZ4VxfHk/9TOVYhKm', NULL, 'A'),
(12, 'Chelo', 'López', 'chelo-lopez', '001881524', 'marcelo@thepublisherlab.com', '20', '+51992988453', 'M', 28, 'Testing ---- ', 'Delima', 'Estética orofacial', 'Máster', 'nofoto.svg', 'PE', 'P', '2021-10-09', '$2y$10$MAX7dSXUGf3R6AbAmqvwEuIIouVugyzzNVS0LZ4VxfHk/9TOVYhKm', '20', 'A'),
(13, 'Kina', 'Granns', 'x-x-x', '418231N21', 'eedb0b6ab24925524657723f10257e6a70b002f1', '4d60185beac3d17b091fe0fb879009831839488b', '1535564544', 'F', 37, 'Lorem ipsum', 'Montreal University', 'Odontología', 'Doctorado', 'nofoto.svg', 'CA', 'Q', '2021-10-29', '4d60185beac3d17b091fe0fb879009831839488b', 'Se retira y no seguirá enseñando', 'X'),
(14, 'Rubeus', 'Hagrid', 'x-x-x', '4124214124', 'eedb0b6ab24925524657723f10257e6a70b002f1', '9f57176d78c5458b89afe7232459dc7172d1f3cd', '+51987987987', 'M', 99, 'Lorem ipsum', 'Hogwarts', 'Auxiliares dentales e higienistas', 'Doctorado', 'nofoto.svg', 'RO', 'Q', '2021-10-29', '9f57176d78c5458b89afe7232459dc7172d1f3cd', 'Está desactualizado', 'X'),
(15, 'Ron', 'Weasley', 'x-x-x', '434142421', 'eedb0b6ab24925524657723f10257e6a70b002f1', '3cb205cc8bfefb62cacc7bb30f97d4083fbc18e7', '+51714241351', 'M', 99, 'Lorem ipsum', 'Hogwarts', 'Odontología', 'Grado', 'nofoto.svg', 'RO', 'Q', '2021-10-29', '3cb205cc8bfefb62cacc7bb30f97d4083fbc18e7', 'No me parece rentable', 'X'),
(16, 'Harry', 'Potter', 'x-x-x', '100910911', 'eedb0b6ab24925524657723f10257e6a70b002f1', 'e07e48c0ee7f69a4a5834855733bccce0d445a9e', '987531171', 'M', 55, 'Lorem ipsum et cumdae', 'Universidad de La Vida', 'Odontología', 'Máster', 'nofoto.svg', 'PE', 'Q', '2021-10-29', 'e07e48c0ee7f69a4a5834855733bccce0d445a9e', 'No tengo preparado aún ningún curso', 'X'),
(17, 'Chelillo', ' Gutierrez', 'chelillo-gutierrez', '889887515', 'enlimaagencia@gmail.com', '26', '+519909884456', 'M', 35, 'tres', 'Catolica', 'Odontología', 'Doctorado', 'nofoto.svg', 'PE', 'P', '2021-10-30', '$2y$10$MAX7dSXUGf3R6AbAmqvwEuIIouVugyzzNVS0LZ4VxfHk/9TOVYhKm', '26', 'A'),
(18, 'Patty', 'Lopez', 'patty-lopez', '858585', 'pattylovil@gmail.com', '27', '+5199985858', 'F', 39, 'i', '9', 'Técnicos protésicos', 'Técnica', 'nofoto.svg', 'PR', 'P', '2021-10-30', '03d008895b2bda6fccbb0d9fa79488a5f337eca5', NULL, 'P'),
(19, 'Complicado', 'Tres', 'complicado-tres', '', 'complicado@agenciaenlima.com', '28', '99995585214', 'M', 39, 'Un nuevo test', 'Universidad Cobra', 'Técnicos protésicos', 'Grado', 'nofoto.svg', 'AI', 'R', '2021-10-30', '$2y$10$MAX7dSXUGf3R6AbAmqvwEuIIouVugyzzNVS0LZ4VxfHk/9TOVYhKm', '28', 'A'),
(20, 'Pruebas', 'Enlima', 'pruebas-enlima', '23452346656', 'pruebas@agenciaenlima.com', '29', '+5123423424422', 'M', 45, 'Lorem ipsum', 'La Calle', 'Estética orofacial', 'Bachiller', 'nofoto.svg', 'PY', 'P', '2021-10-30', '$2y$10$MAX7dSXUGf3R6AbAmqvwEuIIouVugyzzNVS0LZ4VxfHk/9TOVYhKm', NULL, 'A'),
(21, 'Claudio', ' Iacono', 'x-x-x', '', '4124a0b28bb55150c0059224e588d1c97455878e', 'cfcb8280cfc5f0d79cbd5d2168a71062b21fb0aa', '+399986985', 'M', 43, 'Claudio Iacono nació en Ischia en 1979. Se acercó a la fotografía desde una edad temprana, usando cámaras reflexivas analógicas con las que comenzó a desarrollar esta pasión. En 2001 descubrió la fotografía digital al comprar una nueva cámara con la que comenzó a experimentar en el campo artístico técnicas y tomas, retratando detalles, cortes, visiones de paisajes, objetos e individuos, favoreciendo siempre la búsqueda cuidadosa de los detalles. Sus imágenes nacen de una profunda pasión por la fotografía utilizada como herramienta para expresar emociones. Participa en varios concursos de fotografía con reconocimiento; y premios, y a veces colabora como fotógrafo con varios periódicos.', 'Ivoclar Vivadent ICDE ', 'Odontología', 'Grado', 'claudio-iacono.png', 'IT', 'Q', '2021-11-04', 'cfcb8280cfc5f0d79cbd5d2168a71062b21fb0aa', 'datos erróneos, tengo q volver a ingresarlos', 'X'),
(22, 'Hernán', 'López', 'hernan-lopez', '', 'hlopezrubin@gmail.com', '31', '+34619285462', 'M', 56, 'Licenciado en Odontología. Máster en Implantología, Rehabilitación Oral y Biomateriales, por la Escuela Europea de Implantología, Rehabilitación Oral y Biomateriales.\r\nDiplomado en Implantología y Prostodoncia por la Universidad Paris XII. Máster en\r\nOclusión y Prostodoncia. Dictante de varios cursos de oclusión y prótesis digital fija e\r\nimplantosoportada', 'Universidad de Buenos Aires', 'Odontología', 'Máster', 'hernan-lopez.jpg', 'ES', 'P', '2021-11-04', '$2y$10$MAX7dSXUGf3R6AbAmqvwEuIIouVugyzzNVS0LZ4VxfHk/9TOVYhKm', NULL, 'A'),
(23, 'José María', 'Argüedas', 'x-x-x', '998877665', '96e914f5905c13f41c294faee41c6bd025446cb6', '8451f0f31bd016ddd395ad2a926bf662d56b9323', '+5199887755', 'M', 55, 'Lorem ipsum', 'Upc', 'Odontología', 'Máster', 'nofoto.svg', 'PE', 'Q', '2021-11-05', '8451f0f31bd016ddd395ad2a926bf662d56b9323', 'información falsa', 'X'),
(24, 'Antonio ', 'Pugliatti', 'antonio-pugliatti', '', 'antoniopugliatti62@gmail.com', '34', '+34676435573', 'M', 59, 'Graduado en prótesis dental. Cursos de Gnathologia Estética, Metalurgia dental y microscopía. Consultor técnico para empresas italianas e Internacionales. Speaker en\r\nlos congresos A-I-O-P., A.N.T.L.O. y eventos. General Maganer GestimFZC Emirates\r\nArabes Unidos. Consultor Técnico Comercial Rhein83 Spain.', 'I.A.S.A Protésicos', 'Técnicos protésicos', 'Grado', 'antonio-pugliatti.jpg', 'IT', 'P', '2021-11-10', '$2y$10$MAX7dSXUGf3R6AbAmqvwEuIIouVugyzzNVS0LZ4VxfHk/9TOVYhKm', NULL, 'A'),
(25, 'Alfredo ', 'Salvi', 'alfredo-salvi', '', 'salvi3d@gmail.com', '35', '+34642367873', 'M', 65, 'Graduado en prótesis dental. Curso en Laboratorio Paolo Palma. Curso de ceramista\r\nestético con Willi Geller, Eugenio Buldrini, O. Brix, P. Fixter y M. Magni. Experto en\r\ntecnología CAD-CAM. Dictante sobre estética dental con materiales innovadores, implantología en laboratorio y nuevas tecnologías. Gerente de empresas de implantología, estética en metal cerámica, zirconio-cerámica y cerámica integral. Prescriptor\r\nde la tecnología CAD-CAM para Ivoclar, Diacem y Kavo.', 'Laboratorio Paolo Palma', 'Técnicos protésicos', 'Técnica', 'alfredo-salvi.jpg', 'ES', 'P', '2021-11-10', '$2y$10$MAX7dSXUGf3R6AbAmqvwEuIIouVugyzzNVS0LZ4VxfHk/9TOVYhKm', NULL, 'A'),
(26, 'Claudio', 'Iacono', 'claudio-iacono', 'AU9321395', 'claudioiaconodental@gmail.com', '36', '+393284226182', 'M', 42, 'La fotografia in ambito medico ormai ha acquisito un grande valore sia documentativo che di promozione del proprio lavoro. Nei miei corsi porterò a conoscenza dei partecipanti tutti i fondamenti della fotografia adattati all&#39;ambito medico.', 'Diploma superiore in ragioniere perito in informatica', 'Técnicos protésicos', 'Técnica', 'claudio-iacono.png', 'IT', 'P', '2021-12-05', '$2y$10$MAX7dSXUGf3R6AbAmqvwEuIIouVugyzzNVS0LZ4VxfHk/9TOVYhKm', NULL, 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `referidos`
--

DROP TABLE IF EXISTS `referidos`;
CREATE TABLE `referidos` (
  `id` int(11) NOT NULL,
  `referente` varchar(64) DEFAULT NULL,
  `profesorid` int(11) DEFAULT NULL,
  `referido` varchar(64) DEFAULT NULL,
  `referidoid` int(11) DEFAULT NULL,
  `correoreferido` varchar(72) DEFAULT NULL,
  `clave` varchar(64) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `estado` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `referidos`
--

INSERT INTO `referidos` (`id`, `referente`, `profesorid`, `referido`, `referidoid`, `correoreferido`, `clave`, `fecha`, `estado`) VALUES
(1, 'Prefab Sprout', 3, 'Lindsey Buckingham', 5, 'lbuck@fleetwoodmac.local', 'kN5PLdTBU21I', '2021-09-01', 'A'),
(2, 'Rosa María Aldizábar', 6, 'Juan López', 8, 'mlopez@local.local', 'R3K99zoLHp3', '2021-09-01', 'A'),
(3, 'Ali Gatie', 2, 'Mariah Carey', 9, 'mariah@carey.local', 'cszYEJyuEDsU', '2021-09-02', 'A'),
(4, 'Lindsey Buckingham', 5, 'Patrice Rushen', 10, 'prushen@forgetmenots.local', 'dcecRGfQq4sr', '2021-09-06', 'A'),
(5, 'Lindsey Buckingham', 5, 'Gordon  Sumner', 11, 'gsumner@sting.local', 'Whg9IL7tKmdm', '2021-09-08', 'A'),
(6, 'Profesor Indesid', 1, 'Kina Granns', 13, 'nicolas@musimagen.es', '2BGRs3dtRRrj', '2021-10-29', 'X'),
(7, 'Duncan Sheik', 4, 'Harry Potter', 16, 'nicolas@musimagen.es', 'I*oNqM7Q9Hf1DM', '2021-10-29', 'X'),
(8, 'Chelillo  Gutierrez', 17, 'Complicado Tres', 19, 'complicado@agenciaenlima.com', 'I*dbcU8SONzKc', '2021-10-30', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registrawebinar`
--

DROP TABLE IF EXISTS `registrawebinar`;
CREATE TABLE `registrawebinar` (
  `id` int(11) NOT NULL,
  `webinarid` int(11) DEFAULT NULL,
  `webinar` varchar(64) DEFAULT NULL,
  `nombre` varchar(64) DEFAULT NULL,
  `email` varchar(64) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `estado` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `rol` varchar(24) DEFAULT NULL,
  `abreviatura` char(2) DEFAULT NULL,
  `descripcion` varchar(96) DEFAULT NULL,
  `estado` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `rol`, `abreviatura`, `descripcion`, `estado`) VALUES
(1, 'Administrador', 'AD', 'Acceso total', 'A'),
(2, 'Usuario', 'US', 'Acceso a operador, transacciones y pagos', 'A'),
(3, 'Financiero', 'FI', 'Acceso a transacciones y pago a profesores', 'A'),
(4, 'Contenido', 'IZ', 'Acceso a interfaz gráfica', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_pivote`
--

DROP TABLE IF EXISTS `tabla_pivote`;
CREATE TABLE `tabla_pivote` (
  `id` int(11) NOT NULL,
  `transaccionid` int(11) NOT NULL,
  `usuarioid` int(11) NOT NULL,
  `categoriaid` int(11) NOT NULL,
  `profesorid` int(11) NOT NULL,
  `cursoid` int(11) NOT NULL,
  `claseid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tags`
--

DROP TABLE IF EXISTS `tags`;
CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `tag` mediumtext DEFAULT NULL,
  `categoria` varchar(64) DEFAULT NULL,
  `curso` varchar(64) DEFAULT NULL,
  `cursoid` int(11) DEFAULT NULL,
  `profesor` varchar(64) DEFAULT NULL,
  `profesorid` int(11) DEFAULT NULL,
  `estado` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tags`
--

INSERT INTO `tags` (`id`, `tag`, `categoria`, `curso`, `cursoid`, `profesor`, `profesorid`, `estado`) VALUES
(1, NULL, 'Odontología', 'Odontología microcelular', 1, 'profesor indesid', 1, 'A'),
(2, 'vejez salud tercera edad', 'Odontología', 'Implantes de titanio en Adulto Mayor', 2, 'profesor indesid', 1, 'A'),
(3, NULL, 'Odontología', 'Mi primer curso dental', 3, 'rosa maría aldizábar', 6, 'X'),
(4, NULL, 'Estética orofacial', 'Técnicas aplicadas a molares y caninos', 4, 'elisabet sabariego palacio', 7, 'A'),
(5, NULL, 'Técnicos protésicos', 'Mecánica dental con implantes 3D', 5, 'ali gatie', 2, 'A'),
(6, NULL, 'Técnicos protésicos', 'Impresiones 3D en poliuretano', 6, 'ali gatie', 2, 'A'),
(7, NULL, 'Auxiliares dentales e higienistas', 'Aspisectomía digital', 7, 'prefab sprout', 3, 'X'),
(8, NULL, 'Auxiliares dentales e higienistas', 'Higiene bucodental', 8, 'duncan sheik', 4, 'A'),
(9, NULL, 'Estética orofacial', 'Introducción a la Odontología Molecular', 9, 'lindsey buckingham', 5, 'A'),
(10, NULL, 'Auxiliares dentales e higienistas', 'Higiene dental en el adulto mayor', 10, 'patrice rushen', 10, 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transacciones`
--

DROP TABLE IF EXISTS `transacciones`;
CREATE TABLE `transacciones` (
  `id` int(11) NOT NULL,
  `transaccion` varchar(48) DEFAULT NULL,
  `pagador` varchar(48) DEFAULT NULL,
  `token` varchar(96) DEFAULT NULL,
  `monto` decimal(8,2) DEFAULT NULL,
  `curso` varchar(96) DEFAULT NULL,
  `cursoid` int(11) DEFAULT NULL,
  `usuarioid` int(11) DEFAULT NULL,
  `profesorid` int(11) DEFAULT NULL,
  `comision` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `estado` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `transacciones`
--

INSERT INTO `transacciones` (`id`, `transaccion`, `pagador`, `token`, `monto`, `curso`, `cursoid`, `usuarioid`, `profesorid`, `comision`, `fecha`, `estado`) VALUES
(1, NULL, '', '', '152.00', 'Implantes de titanio en Adulto Mayor', 2, 1, 1, 50, '2021-08-29', 'A'),
(2, NULL, '', '', '152.00', 'Implantes de titanio en Adulto Mayor', 2, 3, 1, 50, '2021-08-31', 'A'),
(3, NULL, '', '', '179.00', 'Implantes de titanio en Adulto Mayor', 2, 9, 1, 50, '2021-09-01', 'A'),
(4, NULL, '', '', '179.00', 'Odontología microcelular', 1, 10, 1, 50, '2021-09-01', 'A'),
(5, NULL, '', '', '159.00', 'Mi primer curso dental', 3, 4, 6, 50, '2021-09-01', 'A'),
(6, NULL, '', '', '159.00', 'Odontología microcelular', 1, 1, 1, 50, '2021-09-01', 'A'),
(7, NULL, '', '', '179.00', 'Aspisectomía digital', 7, 11, 3, 50, '2021-09-05', 'A'),
(8, NULL, '', '', '199.00', 'Higiene dental en el adulto mayor', 10, 8, 10, 40, '2021-09-07', 'A'),
(9, NULL, '', '', '199.00', 'Introducción a la Odontología Molecular', 9, 9, 5, 40, '2021-09-13', 'A'),
(10, NULL, '', '', '179.00', 'Impresiones 3D en poliuretano', 6, 9, 2, 50, '2021-09-13', 'A'),
(11, NULL, '', '', '-179.00', 'Impresiones 3D en poliuretano', 6, 9, 2, 50, '2021-09-14', 'X'),
(12, NULL, '', '', '179.00', 'Impresiones 3D en poliuretano', 6, 1, 2, 50, '2021-09-17', 'X'),
(13, NULL, '', '', '199.00', 'Higiene bucodental', 8, 4, 4, 50, '2021-10-08', 'A'),
(14, NULL, '', '', '-199.00', 'Higiene bucodental', 8, 4, 4, 50, '2021-10-09', 'A'),
(15, NULL, '', '', '199.00', 'Higiene dental en el adulto mayor', 10, 21, 10, 40, '2021-10-09', 'A'),
(16, NULL, '', '', '-199.00', 'Higiene dental en el adulto mayor', 10, 21, 10, 40, '2021-10-09', 'A'),
(17, NULL, '', '', '199.00', 'Odontología microcelular', 1, 21, 1, 50, '2021-10-09', 'A'),
(18, NULL, '', '', '179.00', 'Implantes de titanio en Adulto Mayor', 2, 21, 1, 50, '2021-10-09', 'A'),
(19, NULL, '', '', '199.00', 'Higiene dental en el adulto mayor', 10, 21, 10, 40, '2021-10-09', 'A'),
(20, NULL, '', '', '179.00', 'Aspisectomía digital', 7, 33, 3, 50, '2021-11-05', 'A'),
(21, NULL, '', '', '199.00', 'Higiene bucodental', 8, 33, 4, 50, '2021-11-06', 'A'),
(22, 'PAYID-MGLQGDI0DL797799Y1723138', 'ZR5GWRZM3TGMN', 'EC-92937103H9289981L', '179.00', 'Técnicas aplicadas a molares y caninos', 4, 1, 7, 50, '2021-11-18', 'A'),
(23, '5J33604827907201S', '8QSFDGNSAUC6E', '5U214471MG409284S', '179.00', 'Técnicas aplicadas a molares y caninos', 4, 37, 7, 50, '2021-12-05', 'A'),
(24, '95G93870A7289082U', 'ZR5GWRZM3TGMN', '95V49542KT746815J', '199.00', 'Introducción a la Odontología Molecular', 9, 11, 5, 40, '2021-12-07', 'A'),
(25, NULL, NULL, NULL, '-199.00', 'Introducción a la Odontología Molecular', 9, 11, 5, 40, '2021-12-22', 'A'),
(26, '15Y79925PK416270F', '8QSFDGNSAUC6E', '3N4371195J8365025', '199.00', 'Higiene bucodental', 8, 37, 4, 50, '2022-01-02', 'A'),
(27, NULL, NULL, NULL, '-199.00', 'Higiene bucodental', 8, 37, 4, 50, '2022-01-02', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombres` varchar(32) DEFAULT NULL,
  `apellidos` varchar(32) DEFAULT NULL,
  `correo` varchar(72) DEFAULT NULL,
  `clave` varchar(64) DEFAULT NULL,
  `especialidad` varchar(64) DEFAULT NULL,
  `nivelestudio` varchar(32) DEFAULT NULL,
  `genero` char(1) DEFAULT NULL,
  `edad` int(11) DEFAULT NULL,
  `foto` varchar(96) DEFAULT NULL,
  `pais` varchar(64) DEFAULT NULL,
  `telefono` varchar(16) DEFAULT NULL,
  `tipo` char(1) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `ultimoacceso` datetime DEFAULT NULL,
  `verificado` char(1) DEFAULT NULL,
  `hash` varchar(64) DEFAULT NULL,
  `estado` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombres`, `apellidos`, `correo`, `clave`, `especialidad`, `nivelestudio`, `genero`, `edad`, `foto`, `pais`, `telefono`, `tipo`, `fecha`, `ultimoacceso`, `verificado`, `hash`, `estado`) VALUES
(1, 'Alumno', 'Indesid', 'alumno@indesid.com', 'fe8b65ba4f60d31b438686d8740194bc21b8e647', 'Odontología', 'Bachiller', 'M', 32, 'alumno-indesid.jpg', 'VE', '999999000', 'U', '2021-02-12', '2022-09-12 06:13:14', '1', '000000000000000000x0', 'A'),
(2, 'Profesor', 'Indesid', 'profesor@indesid.com', '$2y$10$MAX7dSXUGf3R6AbAmqvwEuIIouVugyzzNVS0LZ4VxfHk/9TOVYhKm', 'Estética orofacial', 'Máster', 'M', 40, 'profesor-indesid.jpg', 'ES', '999000999', 'P', '2021-02-12', '2022-03-08 06:45:59', '1', 'ea75103b2345908d5c28e774a770d7a9', 'A'),
(3, 'Mark', 'Knopfler', 'nicolas@musimagen.es', '$2y$10$6.irtacHgYOuhSIX4hGQdu5oSDr0n3E5w98Y6Zq/P2XJM33Rkzslu', 'Estética orofacial', 'Máster', 'M', 43, 'nofoto.svg', 'GB', '+445724415512', 'U', '2021-08-14', '2021-08-31 06:43:30', '1', '0454fda1c2a6dd73c92a84cfe23b7516', 'A'),
(4, 'Alejandro', 'Manzano', 'alejandro@boyceavenue.local', '$2y$10$6.irtacHgYOuhSIX4hGQdu5oSDr0n3E5w98Y6Zq/P2XJM33Rkzslu', 'Auxiliares dentales e higienistas', 'Bachiller', 'M', 38, 'alejandro-manzano.jpeg', 'US', '+181236342123', 'U', '2021-08-14', '2021-10-09 12:59:45', '1', '000000000000000000x0', 'A'),
(5, 'Ali', 'Gatie', 'ali@gatie.local', '$2y$10$MAX7dSXUGf3R6AbAmqvwEuIIouVugyzzNVS0LZ4VxfHk/9TOVYhKm', 'Técnicos protésicos', 'Técnica', 'M', 34, 'ali-gatie.jpg', 'IQ', '+9642323424', 'P', '2021-08-14', '2021-09-02 11:16:06', '1', '000000000000000000x0', 'A'),
(6, 'Prefab', 'Sprout', 'prefab@sprout.local', '$2y$10$MAX7dSXUGf3R6AbAmqvwEuIIouVugyzzNVS0LZ4VxfHk/9TOVYhKm', 'Técnicos protésicos', 'Doctorado', 'M', 43, 'prefab-sprout.jpg', 'BO', '+182345125535', 'P', '2021-08-31', '2021-09-02 11:36:29', '1', '000000000000000000x0', 'A'),
(7, 'Duncan', 'Sheik', 'barely@breathing.local', '$2y$10$MAX7dSXUGf3R6AbAmqvwEuIIouVugyzzNVS0LZ4VxfHk/9TOVYhKm', 'Estética orofacial', 'Grado', 'M', 33, 'duncan-sheik.jpg', 'CR', '+51812450239', 'P', '2021-08-31', '2021-10-29 10:44:10', '1', '000000000000000000x0', 'A'),
(8, 'Alan', 'Parsons', 'aparson@ttoafc.local', '$2y$10$6.irtacHgYOuhSIX4hGQdu5oSDr0n3E5w98Y6Zq/P2XJM33Rkzslu', 'Auxiliares dentales e higienistas', 'Bachiller', 'M', 24, 'nofoto.svg', 'BE', '+51413556165', 'U', '2021-09-01', '2021-09-07 01:34:11', '1', '000000000000000000x0', 'A'),
(9, 'Andrés', 'Calamaro', 'acalamaro@altasuciedad.local', '$2y$10$6.irtacHgYOuhSIX4hGQdu5oSDr0n3E5w98Y6Zq/P2XJM33Rkzslu', 'Odontología', 'Bachiller', 'M', 25, 'nofoto.svg', 'AR', '+516124415', 'U', '2021-09-01', '2021-09-15 04:19:54', '1', '000000000000000000x0', 'A'),
(10, 'Boyce', 'Avenue', 'boyce@avenue.local', '$2y$10$6.irtacHgYOuhSIX4hGQdu5oSDr0n3E5w98Y6Zq/P2XJM33Rkzslu', 'Auxiliares dentales e higienistas', 'Técnica', 'M', 32, 'nofoto.svg', 'JE', '+5141415780', 'U', '2021-09-01', '2021-09-01 04:39:47', '1', '000000000000000000x0', 'A'),
(11, 'Ocean', 'Blue', 'oblue@sublime.local', '$2y$10$6.irtacHgYOuhSIX4hGQdu5oSDr0n3E5w98Y6Zq/P2XJM33Rkzslu', 'Técnicos protésicos', 'Bachiller', 'M', 33, 'nofoto.svg', 'PT', '+5134152515', 'U', '2021-09-01', '2021-12-07 06:37:16', '1', '000000000000000000x0', 'A'),
(12, 'Lindsey', 'Buckingham', 'lbuck@fleetwoodmac.local', '$2y$10$MAX7dSXUGf3R6AbAmqvwEuIIouVugyzzNVS0LZ4VxfHk/9TOVYhKm', 'Auxiliares dentales e higienistas', 'Máster', 'M', 71, 'lindsey-buckingham.jpg', 'US', '241255122', 'P', '2021-09-01', '2021-09-08 09:35:44', '1', '000000000000000000x0', 'A'),
(13, 'Rosa María', 'Aldizábar', 'rmaldizabar@gmail.local', '$2y$10$MAX7dSXUGf3R6AbAmqvwEuIIouVugyzzNVS0LZ4VxfHk/9TOVYhKm', 'Odontología', 'Máster', 'F', 37, 'rosa-maria-aldizabar.jpg', 'BR', '+5198035013938', 'P', '2021-09-01', '2021-09-01 08:52:38', '1', '000000000000000000x0', 'A'),
(14, 'Elisabet Sabariego', 'Palacio', 'esabariego@gmail.local', '$2y$10$MAX7dSXUGf3R6AbAmqvwEuIIouVugyzzNVS0LZ4VxfHk/9TOVYhKm', 'Estética orofacial', 'Máster', 'F', 42, 'elisabet-sabariego-palacio.jpg', 'ES', '+5162352553', 'P', '2021-09-01', '2021-09-01 06:42:37', '1', '000000000000000000x0', 'A'),
(15, 'Juan', 'López', 'jlopez@local.local', '$2y$10$MAX7dSXUGf3R6AbAmqvwEuIIouVugyzzNVS0LZ4VxfHk/9TOVYhKm', 'Auxiliares dentales e higienistas', 'Máster', 'M', 40, 'juan-lopez.jpg', 'BM', '32541353', 'P', '2021-09-01', '2021-10-08 09:10:42', '1', '000000000000000000x0', 'A'),
(16, 'Mariah', 'Carey', 'mariah@carey.local', '$2y$10$MAX7dSXUGf3R6AbAmqvwEuIIouVugyzzNVS0LZ4VxfHk/9TOVYhKm', 'Odontología', 'Doctorado', 'F', 46, 'mariah-carey.jpg', 'US', '222990010', 'P', '2021-09-02', '2021-09-06 06:26:16', '1', '000000000000000000x0', 'A'),
(17, 'Patrice', 'Rushen', 'prushen@forgetmenots.local', '$2y$10$MAX7dSXUGf3R6AbAmqvwEuIIouVugyzzNVS0LZ4VxfHk/9TOVYhKm', 'Auxiliares dentales e higienistas', 'Bachiller', 'F', 44, 'patrice-rushen.jpg', 'BE', '5352353254', 'P', '2021-09-06', '2021-09-06 10:51:55', '1', '000000000000000000x0', 'A'),
(18, 'Gordon ', 'Sumner', 'gsumner@sting.local', '$2y$10$MAX7dSXUGf3R6AbAmqvwEuIIouVugyzzNVS0LZ4VxfHk/9TOVYhKm', 'Técnicos protésicos', 'Máster', 'M', 53, 'nofoto.svg', 'GB', '41072891', 'P', '2021-09-08', '2021-09-08 09:38:38', '1', '000000000000000000x0', 'A'),
(19, 'Pedri', 'Gonzales', 'agenciaenlima2020@gmail.com', 'fa54188365f3de04265293732c2a6fc9d1772865', 'Estética orofacial', 'Grado', 'M', 21, 'nofoto.svg', 'PE', '+51999999999', 'U', '2021-10-09', '2021-10-09 10:26:45', '0', 'aa71c5ce1ff1b499696a4e81c98513f1', 'P'),
(20, 'Chelo', 'López', 'marcelo@thepublisherlab.com', '$2y$10$MAX7dSXUGf3R6AbAmqvwEuIIouVugyzzNVS0LZ4VxfHk/9TOVYhKm', 'Estética orofacial', 'Máster', 'M', 28, 'nofoto.svg', 'PE', '+51992988453', 'P', '2021-10-09', '2021-10-09 11:57:01', '1', 'dbc4889449e58296f7d9e67b82030fbc', 'A'),
(21, 'Pedro', 'Gonzales', 'tester@agenciaenlima.com', '$2y$10$6.irtacHgYOuhSIX4hGQdu5oSDr0n3E5w98Y6Zq/P2XJM33Rkzslu', 'Estética orofacial', 'Grado', 'M', 28, 'nofoto.svg', 'PE', '+5199899653', 'U', '2021-10-09', '2021-10-09 10:42:56', '1', '000000000000000000x0', 'A'),
(22, 'Kina', 'Granns', 'eedb0b6ab24925524657723f10257e6a70b002f1', '$2y$10$MAX7dSXUGf3R6AbAmqvwEuIIouVugyzzNVS0LZ4VxfHk/9TOVYhKm', 'Odontología', 'Doctorado', 'F', 37, 'nofoto.svg', 'CA', '1535564544', 'P', '2021-10-29', '2021-10-29 01:31:33', '1', '000000000000000000x0', 'A'),
(23, 'Rubeus', 'Hagrid', 'eedb0b6ab24925524657723f10257e6a70b002f1', '9f57176d78c5458b89afe7232459dc7172d1f3cd', 'Auxiliares dentales e higienistas', 'Doctorado', 'M', 99, 'nofoto.svg', 'RO', '+51987987987', 'Q', '2021-10-29', '2021-10-29 10:01:32', '9', '000000000000000000x1', 'X'),
(24, 'Ron', 'Weasley', 'eedb0b6ab24925524657723f10257e6a70b002f1', '3cb205cc8bfefb62cacc7bb30f97d4083fbc18e7', 'Odontología', 'Grado', 'M', 99, 'nofoto.svg', 'RO', '+51714241351', 'Q', '2021-10-29', '2021-10-29 10:39:24', '9', '000000000000000000x1', 'X'),
(25, 'Harry', 'Potter', 'eedb0b6ab24925524657723f10257e6a70b002f1', 'e07e48c0ee7f69a4a5834855733bccce0d445a9e', 'Odontología', 'Máster', 'M', 55, 'nofoto.svg', 'PE', '987531171', 'Q', '2021-10-29', '2021-10-29 11:08:45', '9', '000000000000000000x1', 'X'),
(26, 'Chelillo', ' Gutierrez', 'enlimaagencia@gmail.com', '$2y$10$MAX7dSXUGf3R6AbAmqvwEuIIouVugyzzNVS0LZ4VxfHk/9TOVYhKm', 'Odontología', 'Grado', 'M', 35, 'nofoto.svg', 'PE', '+519909884456', 'P', '2021-10-30', '2021-10-30 11:03:22', '1', 'f223082b9b6ce3e40921f9f2110c9a91', 'A'),
(27, 'Patty', 'Lopez', 'pattylovil@gmail.com', '03d008895b2bda6fccbb0d9fa79488a5f337eca5', 'Técnicos protésicos', 'Técnica', 'F', 39, 'nofoto.svg', 'PR', '+5199985858', 'P', '2021-10-30', '2021-10-30 10:50:33', '0', '81bb104866729000d2e3185eb0ddfd67', 'P'),
(28, 'Complicado', 'Tres', 'complicado@agenciaenlima.com', '$2y$10$MAX7dSXUGf3R6AbAmqvwEuIIouVugyzzNVS0LZ4VxfHk/9TOVYhKm', 'Técnicos protésicos', 'Grado', 'M', 39, 'nofoto.svg', 'AI', '99995585214', 'P', '2021-10-30', '2021-10-30 11:04:33', '1', '000000000000000000x0', 'A'),
(29, 'Pruebas', 'Enlima', 'pruebas@agenciaenlima.com', '$2y$10$MAX7dSXUGf3R6AbAmqvwEuIIouVugyzzNVS0LZ4VxfHk/9TOVYhKm', 'Estética orofacial', 'Bachiller', 'M', 45, 'nofoto.svg', 'PY', '+5123423424422', 'P', '2021-10-30', '2021-10-30 11:29:10', '1', '000000000000000000x0', 'A'),
(30, 'Claudio', ' Iacono', '4124a0b28bb55150c0059224e588d1c97455878e', 'cfcb8280cfc5f0d79cbd5d2168a71062b21fb0aa', 'Odontología', 'Grado', 'M', 43, 'claudio-iacono.png', 'IT', '+399986985', 'Q', '2021-11-04', '2021-11-11 01:09:23', '9', '000000000000000000x1', 'X'),
(31, 'Hernán', 'López', 'hlopezrubin@gmail.com', '$2y$10$MAX7dSXUGf3R6AbAmqvwEuIIouVugyzzNVS0LZ4VxfHk/9TOVYhKm', 'Odontología', 'Máster', 'M', 56, 'hernan-lopez.jpg', 'ES', '+34619285462', 'P', '2021-11-04', '2021-12-22 04:19:18', '1', '000000000000000000x0', 'A'),
(32, 'José María', 'Argüedas', '96e914f5905c13f41c294faee41c6bd025446cb6', '8451f0f31bd016ddd395ad2a926bf662d56b9323', 'Odontología', 'Máster', 'M', 55, 'nofoto.svg', 'PE', '+5199887755', 'Q', '2021-11-05', '2021-11-05 06:10:44', '9', '000000000000000000x1', 'X'),
(33, 'Christopher', 'Cross', 'nicomar@gmail.com', '$2y$10$6.irtacHgYOuhSIX4hGQdu5oSDr0n3E5w98Y6Zq/P2XJM33Rkzslu', 'Auxiliares dentales e higienistas', 'Bachiller', 'M', 45, 'nofoto.svg', 'PE', '+5199887766', 'U', '2021-11-05', '2021-11-05 07:27:42', '1', '000000000000000000x0', 'A'),
(34, 'Antonio ', 'Pugliatti', 'antoniopugliatti62@gmail.com', '$2y$10$MAX7dSXUGf3R6AbAmqvwEuIIouVugyzzNVS0LZ4VxfHk/9TOVYhKm', 'Técnicos protésicos', 'Grado', 'M', 59, 'antonio-pugliatti.jpg', 'IT', '+34676435573', 'P', '2021-11-10', '2022-01-07 07:29:15', '1', '000000000000000000x0', 'A'),
(35, 'Alfredo ', 'Salvi', 'salvi3d@gmail.com', '$2y$10$MAX7dSXUGf3R6AbAmqvwEuIIouVugyzzNVS0LZ4VxfHk/9TOVYhKm', 'Técnicos protésicos', 'Técnica', 'M', 65, 'alfredo-salvi.jpg', 'ES', '+34642367873', 'P', '2021-11-10', '2021-11-10 01:51:31', '1', '000000000000000000x0', 'A'),
(36, 'Claudio', 'Iacono', 'claudioiaconodental@gmail.com', '$2y$10$MAX7dSXUGf3R6AbAmqvwEuIIouVugyzzNVS0LZ4VxfHk/9TOVYhKm', 'Técnicos protésicos', 'Técnica', 'M', 42, 'claudio-iacono.png', 'IT', '+393284226182', 'P', '2021-12-05', '2021-12-05 01:09:46', '1', '000000000000000000x0', 'A'),
(37, 'Chelo', 'Vilches', 'marcelodavidlopezv@gmail.com', '$2y$10$6.irtacHgYOuhSIX4hGQdu5oSDr0n3E5w98Y6Zq/P2XJM33Rkzslu', 'Estética orofacial', 'Estudiante', 'M', 28, 'nofoto.svg', 'PE', '+51999669857', 'U', '2021-12-05', '2022-01-07 07:21:30', '1', '000000000000000000x0', 'A'),
(38, 'Casper', 'Ruud', 'casperuud@tennis.com', 'fe8b65ba4f60d31b438686d8740194bc21b8e647', 'Odontología', 'Grado', 'F', 23, 'nofoto.svg', '358', '251365436363', 'U', '2022-09-11', '2022-09-11 06:00:38', '0', '0e473b729358e403371d40fb', 'P');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visitantes`
--

DROP TABLE IF EXISTS `visitantes`;
CREATE TABLE `visitantes` (
  `id` int(11) NOT NULL,
  `cursoid` int(11) DEFAULT NULL,
  `ip` varchar(15) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `ciudad` varchar(64) DEFAULT NULL,
  `pais` varchar(64) DEFAULT NULL,
  `codpais` varchar(4) DEFAULT NULL,
  `continentcode` char(2) DEFAULT NULL,
  `estado` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `visitantes`
--

INSERT INTO `visitantes` (`id`, `cursoid`, `ip`, `fecha`, `ciudad`, `pais`, `codpais`, `continentcode`, `estado`) VALUES
(1, 1, '181.65.63.30', '2021-02-12 22:43:14', 'Lima', 'Perú', 'PE', 'SA', 'A'),
(2, 1, '181.65.63.30', '2021-02-14 21:25:45', 'Lima', 'Perú', 'PE', 'SA', 'A'),
(3, 2, '181.65.63.30', '2021-02-15 16:07:52', 'Lima', 'Perú', 'PE', 'SA', 'A'),
(4, 3, '181.65.63.30', '2021-02-15 16:42:17', 'Lima', 'Perú', 'PE', 'SA', 'A'),
(5, 6, '181.65.63.30', '2021-02-17 09:12:43', 'Lima', 'Perú', 'PE', 'SA', 'A'),
(6, 6, '181.65.63.30', '2021-02-26 01:07:51', 'Lima', 'Perú', 'PE', 'SA', 'A'),
(7, 6, '181.65.63.30', '2021-02-26 07:09:29', 'Lima', 'Perú', 'PE', 'SA', 'A'),
(8, 6, '181.65.63.30', '2021-02-26 07:09:52', 'Lima', 'Perú', 'PE', 'SA', 'A'),
(9, 1, '181.65.63.30', '2021-02-26 07:10:05', 'Lima', 'Perú', 'PE', 'SA', 'A'),
(10, 3, '190.234.105.134', '2021-02-26 07:48:57', 'Lima', 'Perú', 'PE', 'SA', 'A'),
(11, 6, '190.234.105.134', '2021-02-26 07:50:04', 'Lima', 'Perú', 'PE', 'SA', 'A'),
(12, 9, '190.234.105.134', '2021-02-26 07:52:35', 'Lima', 'Perú', 'PE', 'SA', 'A'),
(13, 3, '179.6.212.36', '2021-02-26 07:53:18', 'Lima', 'Perú', 'PE', 'SA', 'A'),
(14, 8, '63.106.251.203', '2021-03-13 11:08:00', 'Guadalupe Este', 'Kiribati', 'AX', 'EU', 'A'),
(15, 1, '57.170.248.116', '2021-03-04 18:25:00', 'Don Luciana', 'Antigua y Barbuda', 'BZ', 'SA', 'A'),
(16, 3, '1.173.194.197', '2021-03-02 20:09:00', 'Aranda Baja', 'Surinam', 'LA', 'SA', 'A'),
(17, 8, '129.41.182.24', '2021-03-15 21:38:00', 'Magdalena  Oeste', 'Líbano', 'HK', 'EU', 'A'),
(18, 6, '189.165.21.254', '2021-03-09 04:11:00', 'Puerto Amelia', 'Chad', 'IN', 'AS', 'A'),
(19, 8, '136.147.103.20', '2021-03-15 21:47:00', 'Flórez Baja', 'Nigeria', 'PA', 'SA', 'A'),
(20, 3, '34.243.75.247', '2021-03-05 13:16:00', 'Echevarría Alta', 'Cuba', 'PT', 'OC', 'A'),
(21, 4, '131.16.226.238', '2021-03-07 13:02:00', 'Don Alan Preciado', 'Ecuador', 'CU', 'AS', 'A'),
(22, 2, '226.149.113.43', '2021-03-06 13:31:00', 'Eduardo  Oeste', 'Emiratos Árabes Unidos', 'MZ', 'NA', 'A'),
(23, 4, '75.173.248.85', '2021-03-07 11:26:00', 'Don Manuel Salazar', 'Zambia', 'GW', 'AF', 'A'),
(24, 6, '89.81.134.143', '2021-03-12 01:33:00', 'San Valeria Soria', 'Benín', 'SR', 'OC', 'A'),
(25, 8, '29.53.45.69', '2021-03-10 08:20:00', 'Riojas  Oeste', 'Belice', 'YT', 'AS', 'A'),
(26, 3, '171.67.0.235', '2021-03-12 02:29:00', 'Renata  Oeste', 'Venezuela', 'HK', 'AS', 'A'),
(27, 7, '241.137.51.39', '2021-03-14 02:08:00', 'Lara Norte', 'Siria', 'KP', 'AF', 'A'),
(28, 1, '168.58.76.239', '2021-03-16 14:28:00', 'Juárez  Sur', 'Guyana', 'CU', 'EU', 'A'),
(29, 9, '209.98.7.135', '2021-03-08 06:48:00', 'Gral. Romina', 'Jamaica', 'IE', 'AF', 'A'),
(30, 4, '149.55.228.32', '2021-03-15 20:18:00', 'Gral. Valery ', 'Portugal', 'GH', 'OC', 'A'),
(31, 2, '252.23.227.171', '2021-03-15 16:14:00', 'Puerto Fernando Corrales', 'Ciudad del Vaticano', 'GQ', 'AF', 'A'),
(32, 8, '62.255.56.155', '2021-03-14 01:43:00', 'San Bruno Chapa', 'El Salvador', 'GG', 'EU', 'A'),
(33, 3, '71.174.202.32', '2021-03-13 08:53:00', 'Gral. Gael', 'Hungría', 'NC', 'OC', 'A'),
(34, 4, '69.161.195.80', '2021-06-12 10:16:41', '', 'Estados Unidos', 'US', 'NA', 'A'),
(35, 1, '69.161.195.80', '2021-06-12 10:16:49', '', 'Estados Unidos', 'US', 'NA', 'A'),
(36, 6, '190.234.105.97', '2021-06-13 01:35:45', 'Lima', 'Perú', 'PE', 'SA', 'A'),
(37, 12, '190.234.105.97', '2021-06-13 03:17:44', 'Lima', 'Perú', 'PE', 'SA', 'A'),
(38, 12, '181.65.63.12', '2021-06-14 11:19:14', 'Lima', 'Perú', 'PE', 'SA', 'A'),
(39, 6, '190.234.105.97', '2021-06-14 07:50:14', 'Lima', 'Perú', 'PE', 'SA', 'A'),
(40, 6, '190.234.105.97', '2021-06-15 04:49:33', 'Lima', 'Perú', 'PE', 'SA', 'A'),
(41, 1, '78.129.149.5', '2021-06-16 11:52:24', 'Upminster', 'Reino Unido', 'GB', 'EU', 'A'),
(42, 10, '78.129.149.5', '2021-06-16 11:53:46', 'Upminster', 'Reino Unido', 'GB', 'EU', 'A'),
(43, 2, '78.129.149.5', '2021-06-16 11:54:28', 'Upminster', 'Reino Unido', 'GB', 'EU', 'A'),
(44, 3, '78.129.149.5', '2021-06-16 11:55:09', 'Upminster', 'Reino Unido', 'GB', 'EU', 'A'),
(45, 4, '78.129.149.5', '2021-06-16 11:55:50', 'Upminster', 'Reino Unido', 'GB', 'EU', 'A'),
(46, 5, '78.129.149.5', '2021-06-16 11:57:53', 'Upminster', 'Reino Unido', 'GB', 'EU', 'A'),
(47, 6, '78.129.149.5', '2021-06-16 11:58:34', 'Upminster', 'Reino Unido', 'GB', 'EU', 'A'),
(48, 7, '78.129.149.5', '2021-06-16 11:59:14', 'Upminster', 'Reino Unido', 'GB', 'EU', 'A'),
(49, 9, '78.129.149.5', '2021-06-16 11:59:55', 'Upminster', 'Reino Unido', 'GB', 'EU', 'A'),
(50, 4, '179.6.76.120', '2021-06-16 10:57:24', '', 'Perú', 'PE', 'SA', 'A'),
(51, 5, '181.65.63.12', '2021-06-19 02:27:58', 'Lima', 'Perú', 'PE', 'SA', 'A'),
(52, 10, '190.234.105.97', '2021-06-29 04:55:25', 'Lima', 'Perú', 'PE', 'SA', 'A'),
(53, 2, '190.234.105.97', '2021-06-29 05:26:57', 'Lima', 'Perú', 'PE', 'SA', 'A'),
(54, 1, '190.234.105.97', '2021-06-29 05:27:42', 'Lima', 'Perú', 'PE', 'SA', 'A'),
(55, 2, '179.6.221.247', '2021-06-29 08:15:56', 'Lima', 'Perú', 'PE', 'SA', 'A'),
(56, 3, '81.44.174.159', '2021-06-30 01:12:37', 'Telde', 'España', 'ES', 'EU', 'A'),
(57, 3, '190.234.105.97', '2021-06-30 11:14:40', 'Lima', 'Perú', 'PE', 'SA', 'A'),
(58, 3, '31.4.242.181', '2021-06-30 02:05:39', 'Madrid', 'España', 'ES', 'EU', 'A'),
(59, 10, '181.65.63.50', '2021-06-30 04:58:49', 'Lima', 'Perú', 'PE', 'SA', 'A'),
(60, 3, '37.222.74.249', '2021-07-01 02:07:08', 'Ponferrada', 'España', 'ES', 'EU', 'A'),
(61, 3, '31.4.242.181', '2021-07-01 06:59:48', 'Madrid', 'España', 'ES', 'EU', 'A'),
(62, 3, '88.6.204.138', '2021-07-03 05:50:08', 'Lacunza', 'España', 'ES', 'EU', 'A'),
(63, 9, '88.6.204.138', '2021-07-03 06:15:54', 'Lacunza', 'España', 'ES', 'EU', 'A'),
(64, 2, '190.234.105.97', '2021-07-04 02:59:05', 'Lima', 'Perú', 'PE', 'SA', 'A'),
(65, 1, '190.234.105.97', '2021-07-04 02:59:59', 'Lima', 'Perú', 'PE', 'SA', 'A'),
(66, 3, '93.63.80.108', '2021-07-07 04:13:22', 'Padua', 'Italia', 'IT', 'EU', 'A'),
(67, 3, '179.6.77.165', '2021-07-08 10:40:20', '', 'Perú', 'PE', 'SA', 'A'),
(68, 1, '190.234.105.97', '2021-07-14 10:02:53', 'Lima', 'Perú', 'PE', 'SA', 'A'),
(69, 9, '181.65.63.50', '2021-07-15 08:15:12', 'Lima', 'Perú', 'PE', 'SA', 'A'),
(70, 9, '190.234.105.97', '2021-07-19 11:39:38', 'Lima', 'Perú', 'PE', 'SA', 'A'),
(71, 4, '83.63.205.235', '2021-07-19 03:20:46', 'Esplugues de Llobregat', 'España', 'ES', 'EU', 'A'),
(72, 9, '85.61.107.247', '2021-07-29 02:11:14', 'Barcelona', 'España', 'ES', 'EU', 'A'),
(73, 6, '190.234.105.97', '2021-07-31 08:12:50', 'Lima', 'Perú', 'PE', 'SA', 'A'),
(74, 3, '181.65.63.50', '2021-08-10 08:45:11', 'Lima', 'Perú', 'PE', 'SA', 'A'),
(75, 9, '181.65.63.50', '2021-08-10 08:46:44', 'Lima', 'Perú', 'PE', 'SA', 'A'),
(76, 9, '181.65.63.50', '2021-08-10 08:47:38', 'Lima', 'Perú', 'PE', 'SA', 'A'),
(77, 1, '78.129.149.5', '2021-08-16 08:26:34', 'Upminster', 'Reino Unido', 'GB', 'EU', 'A'),
(78, 1, '78.129.149.5', '2021-08-16 08:27:16', 'Upminster', 'Reino Unido', 'GB', 'EU', 'A'),
(79, 2, '78.129.149.5', '2021-08-16 08:27:57', 'Upminster', 'Reino Unido', 'GB', 'EU', 'A'),
(80, 3, '78.129.149.5', '2021-08-16 08:28:38', 'Upminster', 'Reino Unido', 'GB', 'EU', 'A'),
(81, 4, '78.129.149.5', '2021-08-16 08:29:19', 'Upminster', 'Reino Unido', 'GB', 'EU', 'A'),
(82, 4, '78.129.149.5', '2021-08-16 08:30:00', 'Upminster', 'Reino Unido', 'GB', 'EU', 'A'),
(83, 4, '78.129.149.5', '2021-08-16 08:30:41', 'Upminster', 'Reino Unido', 'GB', 'EU', 'A'),
(84, 5, '78.129.149.5', '2021-08-16 08:31:22', 'Upminster', 'Reino Unido', 'GB', 'EU', 'A'),
(85, 6, '78.129.149.5', '2021-08-16 08:32:03', 'Upminster', 'Reino Unido', 'GB', 'EU', 'A'),
(86, 7, '78.129.149.5', '2021-08-16 08:32:44', 'Upminster', 'Reino Unido', 'GB', 'EU', 'A'),
(87, 9, '78.129.149.5', '2021-08-16 08:33:25', 'Upminster', 'Reino Unido', 'GB', 'EU', 'A'),
(88, 6, '181.65.63.50', '2021-09-01 06:17:39', 'Lima', 'Perú', 'PE', 'SA', 'A'),
(89, 1, '181.65.63.50', '2021-09-01 06:44:58', 'Lima', 'Perú', 'PE', 'SA', 'A'),
(90, 4, '181.65.63.50', '2021-09-02 11:16:35', 'Lima', 'Perú', 'PE', 'SA', 'A'),
(91, 9, '181.65.63.50', '2021-09-02 11:30:18', 'Lima', 'Perú', 'PE', 'SA', 'A'),
(92, 5, '181.65.63.50', '2021-09-02 11:37:42', 'Lima', 'Perú', 'PE', 'SA', 'A'),
(93, 7, '181.65.63.50', '2021-09-02 01:01:41', 'Lima', 'Perú', 'PE', 'SA', 'A'),
(94, 2, '181.65.63.50', '2021-09-02 01:09:09', 'Lima', 'Perú', 'PE', 'SA', 'A'),
(95, 3, '200.88.113.29', '2021-09-29 07:04:36', 'Santo Domingo Este', 'República Dominicana', 'DO', 'NA', 'A'),
(96, 3, '66.249.83.107', '2021-09-29 07:04:37', NULL, 'Estados Unidos', 'US', 'NA', 'A'),
(97, 8, '181.65.63.199', '2021-10-08 10:18:08', 'Lima', 'Perú', 'PE', 'SA', 'A'),
(98, 2, '181.65.63.199', '2021-10-09 01:02:28', 'Lima', 'Perú', 'PE', 'SA', 'A'),
(99, 5, '181.65.63.199', '2021-10-09 10:33:53', 'Lima', 'Perú', 'PE', 'SA', 'A'),
(100, 10, '190.234.105.86', '2021-10-09 11:00:47', 'Lima', 'Perú', 'PE', 'SA', 'A'),
(101, 1, '190.234.105.86', '2021-10-09 11:09:40', 'Lima', 'Perú', 'PE', 'SA', 'A'),
(102, 2, '190.234.105.86', '2021-10-09 11:18:24', 'Lima', 'Perú', 'PE', 'SA', 'A'),
(103, 2, '181.65.63.199', '2021-10-13 12:01:43', 'Lima', 'Perú', 'PE', 'SA', 'A'),
(104, 6, '181.65.63.199', '2021-10-30 11:37:34', 'Lima', 'Perú', 'PE', 'SA', 'A'),
(105, 3, '181.65.63.199', '2021-10-30 11:50:39', 'Lima', 'Perú', 'PE', 'SA', 'A'),
(106, 2, '181.65.63.199', '2021-11-05 07:22:54', 'Lima', 'Perú', 'PE', 'SA', 'A'),
(107, 7, '181.65.63.199', '2021-11-05 07:45:46', 'Lima', 'Perú', 'PE', 'SA', 'A'),
(108, 7, '181.65.19.244', '2021-11-05 07:46:05', 'Lima', 'Perú', 'PE', 'SA', 'A'),
(109, 8, '181.65.63.199', '2021-11-06 12:31:57', 'Lima', 'Perú', 'PE', 'SA', 'A'),
(110, 9, '181.65.63.199', '2021-11-11 06:27:08', 'Lima', 'Perú', 'PE', 'SA', 'A'),
(111, 4, '181.65.63.199', '2021-11-18 08:50:32', 'Lima', 'Perú', 'PE', 'SA', 'A'),
(112, 5, '181.65.63.199', '2021-11-25 03:50:00', 'Lima', 'Perú', 'PE', 'SA', 'A'),
(113, 4, '181.65.19.244', '2021-12-05 03:08:53', 'Lima', 'Perú', 'PE', 'SA', 'A'),
(114, 9, '181.65.63.199', '2021-12-07 06:37:31', 'Lima', 'Perú', 'PE', 'SA', 'A'),
(115, 1, '181.65.63.199', '2021-12-07 06:45:03', 'Lima', 'Perú', 'PE', 'SA', 'A'),
(116, 10, '181.65.63.199', '2021-12-07 06:58:15', 'Lima', 'Perú', 'PE', 'SA', 'A'),
(117, 8, '181.65.19.244', '2022-01-02 09:09:22', 'Lima', 'Perú', 'PE', 'SA', 'A'),
(118, 2, '132.251.1.126', '2022-01-07 07:30:54', 'Lima', 'Perú', 'PE', 'SA', 'A'),
(119, 5, '181.65.63.63', '2022-02-25 11:49:18', 'Lima', 'Perú', 'PE', 'SA', 'A'),
(120, 10, '::1', '2022-09-08 03:00:43', '', '', '', '', 'A'),
(121, 1, '::1', '2022-09-09 11:32:35', '', '', '', '', 'A'),
(122, 2, '::1', '2022-09-09 11:33:27', '', '', '', '', 'A'),
(123, 4, '::1', '2022-09-09 12:12:19', '', '', '', '', 'A'),
(124, 6, '::1', '2022-09-09 12:42:14', '', '', '', '', 'A'),
(125, 5, '::1', '2022-09-09 12:43:18', '', '', '', '', 'A'),
(126, 10, '::1', '2022-09-10 05:35:04', '', '', '', '', 'A'),
(127, 10, '::1', '2022-09-10 05:35:29', '', '', '', '', 'A'),
(128, 1, '::1', '2022-09-11 12:04:37', '', '', '', '', 'A'),
(129, 1, '::1', '2022-09-11 12:04:50', '', '', '', '', 'A'),
(130, 1, '::1', '2022-09-11 12:06:18', '', '', '', '', 'A'),
(131, 1, '::1', '2022-09-11 12:06:36', '', '', '', '', 'A'),
(132, 1, '::1', '2022-09-11 12:07:02', '', '', '', '', 'A'),
(133, 1, '::1', '2022-09-11 12:07:04', '', '', '', '', 'A'),
(134, 1, '::1', '2022-09-11 12:07:32', '', '', '', '', 'A'),
(135, 6, '::1', '2022-09-11 12:08:21', '', '', '', '', 'A'),
(136, 6, '::1', '2022-09-11 12:08:27', '', '', '', '', 'A'),
(137, 10, '::1', '2022-09-11 12:10:20', '', '', '', '', 'A'),
(138, 9, '::1', '2022-09-11 12:11:08', '', '', '', '', 'A'),
(139, 2, '::1', '2022-09-12 09:21:59', '', '', '', '', 'A'),
(140, 5, '::1', '2022-09-12 11:26:57', '', '', '', '', 'A'),
(141, 6, '::1', '2022-09-12 06:13:18', '', '', '', '', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `webinars`
--

DROP TABLE IF EXISTS `webinars`;
CREATE TABLE `webinars` (
  `id` int(11) NOT NULL,
  `webinar` varchar(64) DEFAULT NULL,
  `slug` varchar(64) DEFAULT NULL,
  `categoriaid` int(11) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `profesorid` int(11) DEFAULT NULL,
  `ponente` varchar(96) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `plataforma` varchar(16) DEFAULT NULL,
  `imagen` varchar(96) DEFAULT NULL,
  `url` varchar(96) DEFAULT NULL,
  `horaini` varchar(5) DEFAULT NULL,
  `solicitud` date DEFAULT NULL,
  `publicado` char(1) DEFAULT NULL,
  `estado` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `webinars`
--

INSERT INTO `webinars` (`id`, `webinar`, `slug`, `categoriaid`, `descripcion`, `profesorid`, `ponente`, `fecha`, `plataforma`, `imagen`, `url`, `horaini`, `solicitud`, `publicado`, `estado`) VALUES
(1, 'Evento de Lanzamiento', 'Culminó', 1, 'Estaremos presentando el Lanzamiento oficial de la nueva web de Indesid', 1, 'Profesor Indesid', '2021-11-09', 'Facebook', 'logo.jpg', 'instagram.com/indesid', '12:00', '2021-10-29', 'N', 'X');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `adm_baneadas`
--
ALTER TABLE `adm_baneadas`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `adm_baneadas` ADD FULLTEXT KEY `Buscar` (`baneada`);

--
-- Indices de la tabla `adm_descuentos`
--
ALTER TABLE `adm_descuentos`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indices de la tabla `adm_interfaz`
--
ALTER TABLE `adm_interfaz`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `adm_notificaciones`
--
ALTER TABLE `adm_notificaciones`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indices de la tabla `adm_pagos`
--
ALTER TABLE `adm_pagos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `adm_panel`
--
ALTER TABLE `adm_panel`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`) USING BTREE;
ALTER TABLE `categorias` ADD FULLTEXT KEY `Buscar` (`categoria`);

--
-- Indices de la tabla `clases`
--
ALTER TABLE `clases`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indices de la tabla `claves`
--
ALTER TABLE `claves`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indices de la tabla `contacto`
--
ALTER TABLE `contacto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id`) USING BTREE;
ALTER TABLE `cursos` ADD FULLTEXT KEY `Buscar` (`curso`,`descripcion`);

--
-- Indices de la tabla `descuentos`
--
ALTER TABLE `descuentos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `devoluciones`
--
ALTER TABLE `devoluciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `modulos`
--
ALTER TABLE `modulos`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indices de la tabla `niveles`
--
ALTER TABLE `niveles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `paises`
--
ALTER TABLE `paises`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indices de la tabla `precios`
--
ALTER TABLE `precios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `profesores`
--
ALTER TABLE `profesores`
  ADD PRIMARY KEY (`id`) USING BTREE;
ALTER TABLE `profesores` ADD FULLTEXT KEY `Buscar` (`nombres`,`apellidos`);

--
-- Indices de la tabla `referidos`
--
ALTER TABLE `referidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `registrawebinar`
--
ALTER TABLE `registrawebinar`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tabla_pivote`
--
ALTER TABLE `tabla_pivote`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaccionid` (`transaccionid`),
  ADD KEY `usuarioid` (`usuarioid`),
  ADD KEY `categoriaid` (`categoriaid`),
  ADD KEY `profesorid` (`profesorid`),
  ADD KEY `cursoid` (`cursoid`),
  ADD KEY `claseid` (`claseid`);

--
-- Indices de la tabla `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `tags` ADD FULLTEXT KEY `Buscar` (`tag`,`categoria`,`curso`,`profesor`);

--
-- Indices de la tabla `transacciones`
--
ALTER TABLE `transacciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indices de la tabla `visitantes`
--
ALTER TABLE `visitantes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `webinars`
--
ALTER TABLE `webinars`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `adm_baneadas`
--
ALTER TABLE `adm_baneadas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de la tabla `adm_descuentos`
--
ALTER TABLE `adm_descuentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `adm_interfaz`
--
ALTER TABLE `adm_interfaz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `adm_notificaciones`
--
ALTER TABLE `adm_notificaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `adm_pagos`
--
ALTER TABLE `adm_pagos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `adm_panel`
--
ALTER TABLE `adm_panel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `clases`
--
ALTER TABLE `clases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de la tabla `claves`
--
ALTER TABLE `claves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `contacto`
--
ALTER TABLE `contacto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `descuentos`
--
ALTER TABLE `descuentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `devoluciones`
--
ALTER TABLE `devoluciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `modulos`
--
ALTER TABLE `modulos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `niveles`
--
ALTER TABLE `niveles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `paises`
--
ALTER TABLE `paises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT de la tabla `precios`
--
ALTER TABLE `precios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `profesores`
--
ALTER TABLE `profesores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `referidos`
--
ALTER TABLE `referidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `registrawebinar`
--
ALTER TABLE `registrawebinar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tabla_pivote`
--
ALTER TABLE `tabla_pivote`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `transacciones`
--
ALTER TABLE `transacciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `visitantes`
--
ALTER TABLE `visitantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT de la tabla `webinars`
--
ALTER TABLE `webinars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tabla_pivote`
--
ALTER TABLE `tabla_pivote`
  ADD CONSTRAINT `categoria_FK` FOREIGN KEY (`categoriaid`) REFERENCES `categorias` (`id`),
  ADD CONSTRAINT `clase_FK` FOREIGN KEY (`claseid`) REFERENCES `clases` (`id`),
  ADD CONSTRAINT `curso_FK` FOREIGN KEY (`cursoid`) REFERENCES `cursos` (`id`),
  ADD CONSTRAINT `profesor_FK` FOREIGN KEY (`profesorid`) REFERENCES `profesores` (`id`),
  ADD CONSTRAINT `transaccion_FK` FOREIGN KEY (`transaccionid`) REFERENCES `transacciones` (`id`),
  ADD CONSTRAINT `usuario_FK` FOREIGN KEY (`usuarioid`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
