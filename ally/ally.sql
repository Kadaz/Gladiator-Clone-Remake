-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 16-08-2012 a las 04:54:16
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
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE IF NOT EXISTS `ally` (
  -- ID de la aly
  `id_ally` int(11) NOT NULL AUTO_INCREMENT,
  -- Nombre de la aly
  `nombre` varchar(24) NOT NULL,
  -- Fundador de la aly
  `fundador` varchar(24) NOT NULL,
  -- Descripcion de la aly
  `descripcion` text NOT NULL,
  -- Nivel de la aly
  `nivel` int(11) NOT NULL,
  -- Nivel de Banco
  `banco` int(11) NOT NULL,
  -- Nivel de Baños publicos
  `publics` int(11) NOT NULL,
  -- Nivel de Hospital
  `hospital` int(11) NOT NULL,
  -- Vida por hospital
  `vida` int(100) NOT NULL,
  -- Nivel de Muro
  `muro` int(11) NOT NULL,
  -- Defensa por muro
  `defensa` int(3) NOT NULL,
  -- Nivel de Tropas
  `trops` int(11) NOT NULL,
  -- Daño por tropas
  `damage` int(5) NOT NULL,
  -- Usuarios en la aly
  `cantidad_members` int(11) NOT NULL,
  -- Maximo de usuarios en la aly
  `max_members` int(11) NOT NULL,
  -- Victorias
  `victorias` int(11) NOT NULL,
  -- Perdidas
  `perdidas` int(11) NOT NULL,
  -- Peleas
  `derrotas` int(11) NOT NULL,  
  -- Oro en la aly
  `oro` int(100) NOT NULL,
  -- Fecha de creacion de la aly
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  -- 1 o mas = Aly reportada
  `report` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_ally`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
