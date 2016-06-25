-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-06-2016 a las 17:20:40
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `couchinn`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudades`
--

CREATE TABLE `ciudades` (
  `idCIUDADES` int(11) NOT NULL,
  `NOMBRE` varchar(50) NOT NULL,
  `idPROVINCIAS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELACIONES PARA LA TABLA `ciudades`:
--   `idPROVINCIAS`
--       `provincias` -> `idPROVINCIAS`
--

--
-- Volcado de datos para la tabla `ciudades`
--

INSERT INTO `ciudades` (`idCIUDADES`, `NOMBRE`, `idPROVINCIAS`) VALUES
(1, 'La Plata', 1),
(2, 'Córdoba', 5),
(3, 'Villa Carlos Paz', 5),
(4, 'Usuahia', 22),
(5, 'Posadas', 13),
(6, 'San Fernando del Valle de Catamarca', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

CREATE TABLE `imagenes` (
  `idIMAGENES` int(11) NOT NULL,
  `IMAGEN` text NOT NULL,
  `idPUBLICACIONES` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELACIONES PARA LA TABLA `imagenes`:
--   `idPUBLICACIONES`
--       `publicaciones` -> `idPUBLICACIONES`
--

--
-- Volcado de datos para la tabla `imagenes`
--

INSERT INTO `imagenes` (`idIMAGENES`, `IMAGEN`, `idPUBLICACIONES`) VALUES
(120, 'imagenes_usuarios/php425D_Fondo_Main_3.jpg', 52),
(121, 'imagenes_usuarios/php425E_img-1.png', 52),
(122, 'imagenes_usuarios/php654A_img-2.png', 53),
(123, 'imagenes_usuarios/php656B_lenny_concentrado.png', 53),
(124, 'imagenes_usuarios/phpF82C_casa_2.jpg', 54),
(125, 'imagenes_usuarios/_img-3.png', 54),
(126, 'imagenes_usuarios/phpF84D_lenny_concentrado.png', 54),
(127, 'imagenes_usuarios/phpEE3B_casa_1.jpg', 55),
(128, 'imagenes_usuarios/phpEE4C_casa_2.jpg', 55),
(129, 'imagenes_usuarios/phpEE4D_casa_3.jpg', 55),
(130, 'imagenes_usuarios/phpEE5D_casa_4.jpg', 55),
(131, 'imagenes_usuarios/phpEE5E_casa_5.jpg', 55),
(132, 'imagenes_usuarios/phpEE5F_CouchInnLogo.png', 55),
(133, 'imagenes_usuarios/phpEE70_Fondo_Main_3.jpg', 55),
(134, 'imagenes_usuarios/phpEE71_img-1.png', 55),
(135, 'imagenes_usuarios/phpEE82_img-2.png', 55),
(136, 'imagenes_usuarios/_img-3.png', 55),
(137, 'imagenes_usuarios/phpEEB2_lenny_concentrado.png', 55);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntasdeseguridad`
--

CREATE TABLE `preguntasdeseguridad` (
  `idPREGUNTASDESEGURIDAD` int(11) NOT NULL,
  `TEXTO` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELACIONES PARA LA TABLA `preguntasdeseguridad`:
--

--
-- Volcado de datos para la tabla `preguntasdeseguridad`
--

INSERT INTO `preguntasdeseguridad` (`idPREGUNTASDESEGURIDAD`, `TEXTO`) VALUES
(1, 'Nombre de tu primera mascota:'),
(2, 'Nombre de tu abuelo:'),
(3, 'Nombre de tu mejor amigo/a:'),
(4, 'Nombre del primer lugar donde vacacionaste:');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincias`
--

CREATE TABLE `provincias` (
  `idPROVINCIAS` int(11) NOT NULL,
  `NOMBRE` varchar(54) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELACIONES PARA LA TABLA `provincias`:
--

--
-- Volcado de datos para la tabla `provincias`
--

INSERT INTO `provincias` (`idPROVINCIAS`, `NOMBRE`) VALUES
(1, 'Buenos Aires'),
(2, 'Catamarca'),
(3, 'Chaco'),
(4, 'Chubut'),
(5, 'Córdoba'),
(6, 'Corrientes'),
(7, 'Entre Ríos'),
(8, 'Formosa'),
(9, 'Jujuy'),
(10, 'La Pampa'),
(11, 'La Rioja'),
(12, 'Mendoza'),
(13, 'Misiones'),
(14, 'Neuquén'),
(15, 'Río Negro'),
(16, 'Salta'),
(17, 'San Juan'),
(18, 'San Luis'),
(19, 'Santa Cruz'),
(20, 'Santa Fe'),
(21, 'Santiago Del Estero'),
(22, 'Tierra del Fuego'),
(23, 'Tucumán');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicaciones`
--

CREATE TABLE `publicaciones` (
  `idPUBLICACIONES` int(11) NOT NULL,
  `FECHA_ALTA` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `TITULO` varchar(50) NOT NULL,
  `CAPACIDAD` int(11) NOT NULL,
  `DESCRIPCION` text NOT NULL,
  `idUSUARIOS` int(11) NOT NULL,
  `idCIUDADES` int(11) NOT NULL,
  `idTIPOS_DE_HOSPEDAJES` int(11) NOT NULL,
  `ACTIVA` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELACIONES PARA LA TABLA `publicaciones`:
--   `idCIUDADES`
--       `ciudades` -> `idCIUDADES`
--   `idTIPOS_DE_HOSPEDAJES`
--       `tipos_de_hospedajes` -> `idTIPOSDEHOSPEDAJES`
--   `idUSUARIOS`
--       `usuarios` -> `idUSUARIOS`
--

--
-- Volcado de datos para la tabla `publicaciones`
--

INSERT INTO `publicaciones` (`idPUBLICACIONES`, `FECHA_ALTA`, `TITULO`, `CAPACIDAD`, `DESCRIPCION`, `idUSUARIOS`, `idCIUDADES`, `idTIPOS_DE_HOSPEDAJES`, `ACTIVA`) VALUES
(52, '2016-06-22 14:26:41', 'Curiosa cabaña en el lago', 2, 'Esta curiosa cabaña en el lago de carlos paz es una particular forma de pasar un finde semana si te gusta la pesca', 60, 3, 3, 0),
(53, '2016-06-22 14:09:17', 'Raro departamento en las ruinas', 4, 'Te vas a sentir como en la antigua grecia en este raro departamento', 60, 1, 2, 1),
(54, '2016-06-22 14:12:06', 'Casa en la playa :D', 6, 'Esta es una elegante casa de playa a lo "Tony Stark"', 60, 5, 1, 1),
(55, '2016-06-22 14:33:54', 'Lenny es un grande', 4, 'afsdkajsdfñkjsñdaj ñskadjf ñskjdfñsk jñ', 60, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_de_hospedajes`
--

CREATE TABLE `tipos_de_hospedajes` (
  `idTIPOSDEHOSPEDAJES` int(11) NOT NULL,
  `NOMBRE` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELACIONES PARA LA TABLA `tipos_de_hospedajes`:
--

--
-- Volcado de datos para la tabla `tipos_de_hospedajes`
--

INSERT INTO `tipos_de_hospedajes` (`idTIPOSDEHOSPEDAJES`, `NOMBRE`) VALUES
(1, 'casita'),
(2, 'departamento'),
(3, 'cabañita');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUSUARIOS` int(11) NOT NULL,
  `NOMBRE` varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `APELLIDO` varchar(20) NOT NULL,
  `FECHANAC` date NOT NULL,
  `EMAIL` varchar(35) NOT NULL,
  `TELEFONO` varchar(15) DEFAULT NULL,
  `CONTRASEÑA` varchar(20) NOT NULL,
  `RESPUESTASEG` varchar(20) NOT NULL,
  `FECHADEALTA` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `idPREGUNTASDESEGURIDAD` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELACIONES PARA LA TABLA `usuarios`:
--   `idPREGUNTASDESEGURIDAD`
--       `preguntasdeseguridad` -> `idPREGUNTASDESEGURIDAD`
--

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUSUARIOS`, `NOMBRE`, `APELLIDO`, `FECHANAC`, `EMAIL`, `TELEFONO`, `CONTRASEÑA`, `RESPUESTASEG`, `FECHADEALTA`, `idPREGUNTASDESEGURIDAD`) VALUES
(1, 'Angélica', 'Portacelutti', '1986-06-02', 'angelica.portacelutti@gmail.com', '', 'Angelica', 'Fido', '2016-06-02 19:52:58', 1),
(60, 'Lenny', 'Leonard', '1989-01-01', 'lenny.leonard@gmail.com', '', 'lennyleo', 'Carl Carlson', '2016-06-02 20:05:06', 3),
(64, 'Ralph', 'Gorgory', '2016-06-15', 'ralph.gorgory@gmail.com', '', 'ralph', 'uiii', '2016-06-03 05:35:27', 4),
(65, 'b', 'b', '1998-01-01', 'b@b', '', 'holahola', 'hola', '2016-06-04 07:49:23', 2),
(66, 'Carl', 'Carlson', '1989-04-23', 'carl.carlson@gmail.com', '454645', 'carlcarl', 'Lenny Leonard', '2016-06-04 08:19:21', 1),
(67, 'Juan', 'Perez', '1998-01-01', 'juan.perez@gmail.com', '4567894', 'chauchau', 'Tito', '2016-06-04 13:47:17', 3),
(68, 'Andres', 'Rodriguezñ', '1996-06-20', 'andrurodr@sadsada', '', 'andresro', 'dak', '2016-06-15 15:35:26', 1),
(69, 'Lautaro', 'Aguirre', '1998-02-16', 'lau.aguirre@gmail', '', 'Lautarito', 'Daisy', '2016-06-17 16:12:26', 1),
(70, 'Vicky', 'Manchitas', '1998-06-04', 'vicky.manchitas@gmail.com', '', 'manchitas', 'yo', '2016-06-19 15:50:17', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  ADD PRIMARY KEY (`idCIUDADES`);

--
-- Indices de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD PRIMARY KEY (`idIMAGENES`);

--
-- Indices de la tabla `preguntasdeseguridad`
--
ALTER TABLE `preguntasdeseguridad`
  ADD PRIMARY KEY (`idPREGUNTASDESEGURIDAD`);

--
-- Indices de la tabla `provincias`
--
ALTER TABLE `provincias`
  ADD PRIMARY KEY (`idPROVINCIAS`);

--
-- Indices de la tabla `publicaciones`
--
ALTER TABLE `publicaciones`
  ADD PRIMARY KEY (`idPUBLICACIONES`);

--
-- Indices de la tabla `tipos_de_hospedajes`
--
ALTER TABLE `tipos_de_hospedajes`
  ADD PRIMARY KEY (`idTIPOSDEHOSPEDAJES`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUSUARIOS`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  MODIFY `idCIUDADES` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  MODIFY `idIMAGENES` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;
--
-- AUTO_INCREMENT de la tabla `preguntasdeseguridad`
--
ALTER TABLE `preguntasdeseguridad`
  MODIFY `idPREGUNTASDESEGURIDAD` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `provincias`
--
ALTER TABLE `provincias`
  MODIFY `idPROVINCIAS` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT de la tabla `publicaciones`
--
ALTER TABLE `publicaciones`
  MODIFY `idPUBLICACIONES` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT de la tabla `tipos_de_hospedajes`
--
ALTER TABLE `tipos_de_hospedajes`
  MODIFY `idTIPOSDEHOSPEDAJES` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUSUARIOS` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
