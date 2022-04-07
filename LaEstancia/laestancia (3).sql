-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 12-01-2021 a las 12:48:35
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
) ENGINE=MyISAM AUTO_INCREMENT=134 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `comandas`
--

INSERT INTO `comandas` (`id`, `num_comanda`, `mesa`, `mozo`, `fecha`, `metodo_pago`) VALUES
(86, 1, 1, 5, '2020-12-30 09:43:15', 'POSNET'),
(87, 2, 1, 5, '2021-01-03 16:12:00', 'EFECTIVO'),
(88, 3, 1, 5, '2021-01-03 16:42:24', 'EFECTIVO'),
(89, 4, 2, 5, '2021-01-03 16:43:01', 'EFECTIVO'),
(90, 5, 2, 8, '2021-01-03 17:19:40', 'POSNET'),
(91, 6, 2, 5, '2021-01-03 17:21:24', 'EFECTIVO'),
(92, 7, 1, 8, '2021-01-04 01:55:33', 'EFECTIVO'),
(93, 8, 1, 5, '2021-01-04 01:58:16', 'POSNET'),
(94, 9, 2, 8, '2021-01-04 02:00:29', 'EFECTIVO'),
(95, 10, 1, 8, '2021-01-04 02:06:14', 'EFECTIVO'),
(96, 11, 1, 5, '2021-01-04 02:32:47', 'POSNET'),
(97, 12, 2, 8, '2021-01-04 02:33:13', 'EFECTIVO'),
(98, 13, 1, 5, '2021-01-04 02:34:06', 'POSNET'),
(99, 14, 1, 5, '2021-01-04 02:42:46', 'EFECTIVO'),
(100, 15, 1, 5, '2021-01-04 11:47:36', 'POSNET'),
(101, 16, 13, 8, '2021-01-04 11:47:56', 'EFECTIVO'),
(102, 17, 1, 5, '2021-01-04 16:10:38', 'EFECTIVO'),
(103, 18, 2, 5, '2021-01-04 16:11:09', 'POSNET'),
(104, 19, 17, 8, '2021-01-04 16:11:31', 'POSNET'),
(105, 20, 1, 5, '2021-01-04 16:15:40', 'EFECTIVO'),
(106, 21, 2, 5, '2021-01-04 16:15:55', 'POSNET'),
(107, 22, 13, 5, '2021-01-04 16:17:53', 'POSNET'),
(108, 23, 2, 8, '2021-01-04 16:18:21', 'EFECTIVO'),
(109, 24, 1, 5, '2021-01-04 16:26:10', 'POSNET'),
(110, 25, 1, 5, '2021-01-04 16:33:54', 'EFECTIVO'),
(111, 26, 2, 5, '2021-01-04 16:34:14', 'POSNET'),
(112, 27, 1, 0, '2021-01-04 16:36:24', 'EFECTIVO'),
(113, 28, 1, 5, '2021-01-04 16:39:25', 'EFECTIVO'),
(114, 29, 1, 5, '2021-01-04 16:41:00', 'EFECTIVO'),
(115, 30, 2, 8, '2021-01-04 16:41:41', 'EFECTIVO'),
(116, 31, 1, 8, '2021-01-04 17:33:36', 'EFECTIVO'),
(117, 32, 1, 5, '2021-01-04 19:00:00', 'EFECTIVO'),
(118, 33, 1, 8, '2021-01-04 19:09:52', 'EFECTIVO'),
(119, 34, 1, 8, '2021-01-04 20:12:28', 'EFECTIVO'),
(120, 35, 16, 5, '2021-01-04 20:33:57', 'EFECTIVO'),
(121, 36, 1, 8, '2021-01-05 02:15:53', 'EFECTIVO'),
(122, 37, 1, 8, '2021-01-05 02:23:06', 'POSNET'),
(123, 38, 1, 8, '2021-01-05 03:28:35', 'EFECTIVO'),
(124, 39, 1, 8, '2021-01-05 03:40:23', 'EFECTIVO'),
(125, 40, 1, 8, '2021-01-05 13:08:31', 'EFECTIVO'),
(126, 41, 1, 8, '2021-01-05 13:59:07', 'EFECTIVO'),
(127, 42, 1, 8, '2021-01-05 14:01:39', 'EFECTIVO'),
(128, 43, 1, 8, '2021-01-05 14:04:24', 'EFECTIVO'),
(129, 44, 1, 8, '2021-01-05 14:11:47', 'EFECTIVO'),
(130, 45, 1, 8, '2021-01-05 14:15:51', 'EFECTIVO'),
(131, 46, 3, 8, '2021-01-06 01:52:54', 'EFECTIVO'),
(132, 47, 1, 8, '2021-01-07 18:51:00', 'EFECTIVO'),
(133, 48, 1, 9, '2021-01-07 18:57:56', 'EFECTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesas`
--

DROP TABLE IF EXISTS `mesas`;
CREATE TABLE IF NOT EXISTS `mesas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numero_mesa` int(11) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=74 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `mesas`
--

INSERT INTO `mesas` (`id`, `numero_mesa`, `estado`) VALUES
(1, 1, 0),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 5, 1),
(6, 6, 1),
(7, 7, 1),
(8, 8, 1),
(9, 9, 1),
(10, 10, 1),
(67, 29, 1),
(66, 28, 1),
(65, 27, 1),
(64, 26, 1),
(63, 25, 1),
(62, 24, 1),
(61, 23, 1),
(60, 22, 1),
(59, 21, 1),
(58, 20, 1),
(57, 19, 1),
(56, 18, 1),
(55, 17, 1),
(54, 16, 1),
(53, 15, 1),
(52, 14, 1),
(51, 13, 1),
(50, 12, 1),
(49, 11, 1),
(68, 30, 1),
(69, 31, 1),
(70, 32, 1),
(71, 33, 1),
(72, 34, 1),
(73, 35, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

DROP TABLE IF EXISTS `productos`;
CREATE TABLE IF NOT EXISTS `productos` (
  `nombre` varchar(100) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `codigo` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

DROP TABLE IF EXISTS `proveedores`;
CREATE TABLE IF NOT EXISTS `proveedores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id`, `nombre`) VALUES
(1, 'CAVAS DEL ARTESANO'),
(2, 'GOYENECHEA'),
(3, 'DISTRIMAX');

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
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `contrasena`, `rol`) VALUES
(2, 'diegoadmin', '$2y$04$wA7SR2ncPzTtlU2jTiZWgOf5YS5rD5i8ur9FG6v2cYGrukbJjAIV6', 'admin'),
(9, 'agustin', '$2y$04$wv7dNQLLjTg4lvwRTQ5ZNemoh/KPke/EP2L3BPHnYpDacD2PiTGkq', 'mozo'),
(6, 'cajero', '$2y$04$DaqJHdZzTax9lXf.Hp.QIO56vu3jmIa63Hsck6v8JGv7Asw2Pmphe', 'cajero'),
(7, 'admin', '$2y$04$iu5TgHVMS/D0DJCi.QF90eHO..CB6woiPu0IloT1NO9vys9le4.7O', 'admin'),
(8, 'Mariel', '$2y$04$05zxEbvaapnCMVb2oVDjZ.KxGZqRjDmuntmWkb954NbZZOIh.W6G6', 'mozo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

DROP TABLE IF EXISTS `ventas`;
CREATE TABLE IF NOT EXISTS `ventas` (
  `producto` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `comanda` int(11) NOT NULL,
  `fecha` datetime DEFAULT NULL,
  KEY `fk_comanda` (`comanda`),
  KEY `fk_producto` (`producto`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
