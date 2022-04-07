-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 30-12-2020 a las 15:05:59
-- Versión del servidor: 5.7.31
-- Versión de PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `laestancia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cajas`
--

DROP TABLE IF EXISTS `cajas`;
CREATE TABLE IF NOT EXISTS `cajas` (
  `num_caja` int(11) NOT NULL,
  `fecha_apertura` datetime DEFAULT NULL,
  `estado` varchar(1) NOT NULL,
  `fecha_cierre` datetime DEFAULT NULL,
  PRIMARY KEY (`num_caja`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cajas`
--

INSERT INTO `cajas` (`num_caja`, `fecha_apertura`, `estado`, `fecha_cierre`) VALUES
(1, '2020-12-30 09:43:04', 'c', '2020-12-30 10:07:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja_chica`
--

DROP TABLE IF EXISTS `caja_chica`;
CREATE TABLE IF NOT EXISTS `caja_chica` (
  `ingreso` decimal(10,2) DEFAULT '0.00',
  `egreso` decimal(10,2) DEFAULT '0.00',
  `detalle` varchar(300) DEFAULT NULL,
  `caja` int(11) DEFAULT NULL,
  `comanda` int(11) DEFAULT NULL,
  KEY `fk_caja` (`caja`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `caja_chica`
--

INSERT INTO `caja_chica` (`ingreso`, `egreso`, `detalle`, `caja`, `comanda`) VALUES
('0.00', '116.00', 'DESCUENTO DE 20% MESA:1 ', 1, 1),
('580.00', '0.00', 'POSNET', 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja_grande`
--

DROP TABLE IF EXISTS `caja_grande`;
CREATE TABLE IF NOT EXISTS `caja_grande` (
  `ingreso` decimal(10,0) DEFAULT NULL,
  `egreso` decimal(10,0) DEFAULT NULL,
  `detalle` varchar(100) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `tipo` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `caja_grande`
--

INSERT INTO `caja_grande` (`ingreso`, `egreso`, `detalle`, `fecha`, `tipo`) VALUES
('1000', '0', 'CAJA', '2020-12-26 21:34:15', 'POSNET'),
('1151', '0', 'CAJA', '2020-12-26 21:34:15', 'EFECTIVO'),
('0', '800', 'CAJA', '2020-12-26 21:34:15', 'EFECTIVO'),
('1500', '0', 'caja folclore x6 ', '2020-12-26 21:47:05', 'CAVAS DEL ARTESANO'),
('1000', '0', 'CAJA', '2020-12-28 13:05:48', 'POSNET'),
('1151', '0', 'CAJA', '2020-12-28 13:05:48', 'EFECTIVO'),
('0', '0', 'CAJA', '2020-12-28 13:05:48', 'EFECTIVO'),
('1000', '0', 'CAJA', '2020-12-28 13:10:07', 'POSNET'),
('2834', '0', 'CAJA', '2020-12-28 13:10:07', 'EFECTIVO'),
('0', '0', 'CAJA', '2020-12-28 13:10:07', 'EFECTIVO'),
('2000', '0', 'CAJA', '2020-12-28 13:18:41', 'POSNET'),
('3395', '0', 'CAJA', '2020-12-28 13:18:41', 'EFECTIVO'),
('0', '0', 'CAJA', '2020-12-28 13:18:41', 'EFECTIVO'),
('2000', '0', 'CAJA', '2020-12-28 18:09:23', 'POSNET'),
('3956', '0', 'CAJA', '2020-12-28 18:09:23', 'EFECTIVO'),
('0', '0', 'CAJA', '2020-12-28 18:09:23', 'EFECTIVO'),
('2000', '0', 'CAJA', '2020-12-28 18:38:02', 'POSNET'),
('4236', '0', 'CAJA', '2020-12-28 18:38:02', 'EFECTIVO'),
('0', '0', 'CAJA', '2020-12-28 18:38:02', 'EFECTIVO'),
('2400', '0', 'CAJA', '2020-12-28 18:53:35', 'POSNET'),
('5437', '0', 'CAJA', '2020-12-28 18:53:35', 'EFECTIVO'),
('0', '0', 'CAJA', '2020-12-28 18:53:35', 'EFECTIVO'),
('2400', '0', 'CAJA', '2020-12-28 19:01:24', 'POSNET'),
('6237', '0', 'CAJA', '2020-12-28 19:01:24', 'EFECTIVO'),
('0', '0', 'CAJA', '2020-12-28 19:01:24', 'EFECTIVO'),
('2400', '0', 'CAJA', '2020-12-28 19:18:37', 'POSNET'),
('6237', '0', 'CAJA', '2020-12-28 19:18:37', 'EFECTIVO'),
('0', '0', 'CAJA', '2020-12-28 19:18:37', 'EFECTIVO'),
('2400', '0', 'CAJA', '2020-12-28 19:40:04', 'POSNET'),
('7887', '0', 'CAJA', '2020-12-28 19:40:04', 'EFECTIVO'),
('0', '0', 'CAJA', '2020-12-28 19:40:04', 'EFECTIVO'),
('2400', '0', 'CAJA', '2020-12-28 19:40:18', 'POSNET'),
('7887', '0', 'CAJA', '2020-12-28 19:40:18', 'EFECTIVO'),
('0', '0', 'CAJA', '2020-12-28 19:40:18', 'EFECTIVO'),
('2400', '0', 'CAJA', '2020-12-28 19:43:24', 'POSNET'),
('7887', '0', 'CAJA', '2020-12-28 19:43:24', 'EFECTIVO'),
('0', '0', 'CAJA', '2020-12-28 19:43:24', 'EFECTIVO'),
('2400', '0', 'CAJA', '2020-12-28 19:43:42', 'POSNET'),
('7887', '0', 'CAJA', '2020-12-28 19:43:42', 'EFECTIVO'),
('0', '0', 'CAJA', '2020-12-28 19:43:42', 'EFECTIVO'),
('2400', '0', 'CAJA', '2020-12-29 10:59:48', 'POSNET'),
('12732', '0', 'CAJA', '2020-12-29 10:59:48', 'EFECTIVO'),
('0', '3696', 'CAJA', '2020-12-29 10:59:48', 'EFECTIVO'),
('3242', '0', 'CAJA', '2020-12-29 11:03:32', 'POSNET'),
('13293', '0', 'CAJA', '2020-12-29 11:03:32', 'EFECTIVO'),
('0', '56', 'CAJA', '2020-12-29 11:03:32', 'EFECTIVO'),
('2500', '0', 'caja vino c 6', '2020-12-29 11:04:07', 'GOYENECHEA'),
('4112', '0', 'CAJA', '2020-12-29 11:09:35', 'POSNET'),
('13293', '0', 'CAJA', '2020-12-29 11:09:35', 'EFECTIVO'),
('0', '0', 'CAJA', '2020-12-29 11:09:35', 'EFECTIVO'),
('4112', '0', 'CAJA', '2020-12-29 11:25:15', 'POSNET'),
('13293', '0', 'CAJA', '2020-12-29 11:25:15', 'EFECTIVO'),
('0', '0', 'CAJA', '2020-12-29 11:25:15', 'EFECTIVO'),
('4112', '0', 'CAJA', '2020-12-29 19:37:11', 'POSNET'),
('15314', '0', 'CAJA', '2020-12-29 19:37:11', 'EFECTIVO'),
('0', '812', 'CAJA', '2020-12-29 19:37:11', 'EFECTIVO'),
('4112', '0', 'CAJA', '2020-12-29 20:01:38', 'POSNET'),
('15314', '0', 'CAJA', '2020-12-29 20:01:38', 'EFECTIVO'),
('0', '84', 'CAJA', '2020-12-29 20:01:38', 'EFECTIVO'),
('4692', '0', 'CAJA', '2020-12-29 20:02:25', 'POSNET'),
('15314', '0', 'CAJA', '2020-12-29 20:02:25', 'EFECTIVO'),
('0', '58', 'CAJA', '2020-12-29 20:02:25', 'EFECTIVO'),
('580', '0', 'CAJA', '2020-12-30 10:07:07', 'POSNET'),
('0', '116', 'CAJA', '2020-12-30 10:07:07', 'EFECTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comandas`
--

DROP TABLE IF EXISTS `comandas`;
CREATE TABLE IF NOT EXISTS `comandas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `num_comanda` int(11) NOT NULL,
  `mesa` int(11) NOT NULL,
  `mozo` int(11) NOT NULL,
  `fecha` datetime DEFAULT NULL,
  `metodo_pago` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `mesa` (`mesa`),
  KEY `mozo` (`mozo`)
) ENGINE=MyISAM AUTO_INCREMENT=87 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `comandas`
--

INSERT INTO `comandas` (`id`, `num_comanda`, `mesa`, `mozo`, `fecha`, `metodo_pago`) VALUES
(86, 1, 1, 5, '2020-12-30 09:43:15', 'POSNET');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesas`
--

DROP TABLE IF EXISTS `mesas`;
CREATE TABLE IF NOT EXISTS `mesas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numero_mesa` int(11) DEFAULT NULL,
  `sector` varchar(50) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=70 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `mesas`
--

INSERT INTO `mesas` (`id`, `numero_mesa`, `sector`, `estado`) VALUES
(1, 1, 'afuera', 1),
(2, 2, 'afuera', 1),
(3, 3, 'afuera vereda', 1),
(4, 4, 'afuera vereda', 1),
(5, 5, '', 1),
(6, 6, '', 1),
(7, 7, '', 1),
(8, 8, '', 1),
(9, 9, '', 1),
(10, 10, '', 1),
(67, 29, '', 1),
(66, 28, '', 1),
(65, 27, '', 1),
(64, 26, '', 1),
(63, 25, '', 1),
(62, 24, '', 1),
(61, 23, '', 1),
(60, 22, '', 1),
(59, 21, '', 1),
(58, 20, '', 1),
(57, 19, '', 1),
(56, 18, '', 1),
(55, 17, '', 1),
(54, 16, '', 1),
(53, 15, '', 1),
(52, 14, '', 1),
(51, 13, '', 1),
(50, 12, '', 1),
(49, 11, '', 1),
(68, 30, '', 1),
(69, 31, '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mozos`
--

DROP TABLE IF EXISTS `mozos`;
CREATE TABLE IF NOT EXISTS `mozos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `contacto` int(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

DROP TABLE IF EXISTS `productos`;
CREATE TABLE IF NOT EXISTS `productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `codigo` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `precio`, `codigo`) VALUES
(1, 'CERVEZA IMPERIAL IPA 1L', '280.50', '1017'),
(8, 'MEDIDA DE FERNET', '200.00', '1013'),
(14, 'PIZZA ESPECIAL ', '320.00', '1018'),
(7, 'PAPAS ATR ', '290.00', '1011'),
(13, 'HAMBURGUESA DOBLE QUESO', '200.00', '1014');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

DROP TABLE IF EXISTS `proveedores`;
CREATE TABLE IF NOT EXISTS `proveedores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id`, `nombre`) VALUES
(1, 'CAVAS DEL ARTESANO'),
(2, 'GOYENECHEA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `contrasena` varchar(500) DEFAULT NULL,
  `rol` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `contrasena`, `rol`) VALUES
(2, 'diegoadmin', '$2y$04$wA7SR2ncPzTtlU2jTiZWgOf5YS5rD5i8ur9FG6v2cYGrukbJjAIV6', 'admin'),
(5, 'Fausto', '$2y$04$5vOKSb7x6K6Z4UEVHlxEIeFHavBS/Hc80ivsB93o5k/Utvsdy2FKG', 'mozo'),
(6, 'cajero', '$2y$04$mH8LP2raAO7RVoiLBYl0KO9CTpPcxEWLnEOpadrL4rE.jxgdNhOTC', 'cajero'),
(7, 'admin', '$2y$04$iu5TgHVMS/D0DJCi.QF90eHO..CB6woiPu0IloT1NO9vys9le4.7O', 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

DROP TABLE IF EXISTS `ventas`;
CREATE TABLE IF NOT EXISTS `ventas` (
  `producto` int(11) DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `comanda` int(11) NOT NULL,
  `fecha` datetime DEFAULT NULL,
  KEY `producto` (`producto`),
  KEY `comanda` (`comanda`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`producto`, `cantidad`, `comanda`, `fecha`) VALUES
(1011, 2, 1, '2020-12-30 09:43:21');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
