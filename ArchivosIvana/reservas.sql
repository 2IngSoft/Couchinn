-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-07-2016 a las 20:20:21
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
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `idRESERVA` int(10) NOT NULL,
  `idPUBLICACIONES` mediumint(5) NOT NULL,
  `idUSUARIOS` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_final` date NOT NULL,
  `descripcion` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  `fecha_alta` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`idRESERVA`, `idPUBLICACIONES`, `idUSUARIOS`, `fecha_inicio`, `fecha_final`, `descripcion`, `estado`, `fecha_alta`) VALUES
(1, 1, 8, '2016-06-22', '2016-06-27', 'Somos un grupo de 3 chicos de la PLata.', NULL, '2016-06-30 17:46:39');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`idRESERVA`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `idRESERVA` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
