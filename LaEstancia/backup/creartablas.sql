-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-03-2021 a las 13:53:50
-- Versión del servidor: 5.7.9
-- Versión de PHP: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
  `tipo` varchar(100) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `pago` varchar(100) DEFAULT NULL,
  KEY `fk_caja` (`caja`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `caja_chica`
--

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
  `tipo` varchar(100) DEFAULT NULL,
  `pago` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


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
) ENGINE=MyISAM AUTO_INCREMENT=165 DEFAULT CHARSET=utf8;

--
--
-- Estructura de tabla para la tabla `mesas`
--

DROP TABLE IF EXISTS `mesas`;
CREATE TABLE IF NOT EXISTS `mesas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numero_mesa` int(11) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=99 DEFAULT CHARSET=utf8;

--
-- Estructura de tabla para la tabla `productos`
--

DROP TABLE IF EXISTS `productos`;
CREATE TABLE IF NOT EXISTS `productos` (
  `nombre` varchar(100) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `codigo` varchar(20) DEFAULT NULL,
  `categoria` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
--
-- Estructura de tabla para la tabla `proveedores`
--

DROP TABLE IF EXISTS `proveedores`;
CREATE TABLE IF NOT EXISTS `proveedores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=59 DEFAULT CHARSET=utf8;

--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `contrasena` varchar(500) DEFAULT NULL,
  `rol` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
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


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
