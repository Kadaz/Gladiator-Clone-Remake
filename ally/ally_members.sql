-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 16-08-2012 a las 04:54:12
-- Versión del servidor: 5.5.16
-- Versión de PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `erpg`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ally_miembros`
--

CREATE TABLE IF NOT EXISTS `ally_miembros` (
  -- ID
  `id` int(11) NOT NULL AUTO_INCREMENT,
  -- ID del usuario
  `usuario_id` int(11) NOT NULL,
  -- Nombre del usuario
  `nombre_usuario` varchar(24) NOT NULL,
  -- ID de la aly
  `ally_id` int(11) NOT NULL,
  -- 1 o mas = Unido a la aly
  `ally_ms` tinyint(4) NOT NULL DEFAULT '0',
  -- Oro donado
  `oro` int(11) NOT NULL,
  -- Rank en la aly 1 = Miembro, 2 = ADM, 3 = Creador
  `rank` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `id` (`id`,`ally_id`,`ally_ms`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
