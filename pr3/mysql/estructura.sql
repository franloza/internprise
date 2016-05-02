-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-04-2016 a las 12:46:33
-- Versión del servidor: 5.6.16
-- Versión de PHP: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `internprise`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradores`
--

CREATE TABLE IF NOT EXISTS `administradores` (
  `id_usuario` int(6) NOT NULL,
  `nombre` varchar(60) CHARACTER SET latin1 NOT NULL,
  `apellidos` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `nombre_universidad` varchar(60) CHARACTER SET latin1 NOT NULL,
  `sexo` varchar(6) CHARACTER SET latin1 NOT NULL,
  `dirección` varchar(100) CHARACTER SET latin1 NOT NULL,
  `cp` int(5) NOT NULL,
  `localidad` varchar(20) CHARACTER SET latin1 NOT NULL,
  `provincia` varchar(20) CHARACTER SET latin1 NOT NULL,
  `pais` varchar(20) CHARACTER SET latin1 NOT NULL,
  `web` varchar(40) CHARACTER SET latin1 NOT NULL,
  `telefono` varchar(12) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aptitudes`
--

CREATE TABLE IF NOT EXISTS `aptitudes` (
  `id_aptitud` int(6) NOT NULL AUTO_INCREMENT,
  `nombre_aptitud` varchar(20) NOT NULL,
  `id_estudiante` int(6) NOT NULL,
  PRIMARY KEY (`id_aptitud`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aptitudes_ofertas`
--

CREATE TABLE IF NOT EXISTS `aptitudes_ofertas` (
  `id_oferta` int(6) NOT NULL,
  `aptitud` varchar(30) NOT NULL,
  PRIMARY KEY (`id_oferta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `demandas`
--

CREATE TABLE IF NOT EXISTS `demandas` (
  `id_demanda` int(6) NOT NULL,
  `id_oferta` int(6) NOT NULL,
  `id_estudiante` int(6) NOT NULL,
  `estado` varchar(20) NOT NULL,
  PRIMARY KEY (`id_demanda`,`id_oferta`,`id_estudiante`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

CREATE TABLE IF NOT EXISTS `empresas` (
  `id_usuario` int(6) NOT NULL,
  `cif` varchar(20) NOT NULL,
  `razon_social` varchar(50) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `localidad` varchar(20) NOT NULL,
  `provincia` varchar(20) NOT NULL,
  `cp` int(6) NOT NULL,
  `pais` varchar(20) NOT NULL,
  `telefono` varchar(12) NOT NULL,
  `web` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiantes`
--

CREATE TABLE IF NOT EXISTS `estudiantes` (
  `id_usuario` int(6) NOT NULL,
  `dni` varchar(10) NOT NULL,
  `nombre_universidad` varchar(50) NOT NULL,
  `grado` varchar(30) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `sexo` varchar(12) NOT NULL,
  `nacionalidad` varchar(20) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `localidad` varchar(20) NOT NULL,
  `provincia` varchar(20) NOT NULL,
  `pais` varchar(20) NOT NULL,
  `telefono` varchar(12) NOT NULL,
  `web` varchar(20) NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='direccion';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grados`
--

CREATE TABLE IF NOT EXISTS `grados` (
  `id_usuario_admin` int(6) NOT NULL,
  `nombre_grado` int(30) NOT NULL,
  PRIMARY KEY (`id_usuario_admin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ofertas`
--

CREATE TABLE IF NOT EXISTS `ofertas` (
  `id_oferta` int(6) NOT NULL AUTO_INCREMENT,
  `puesto` varchar(30) CHARACTER SET latin1 NOT NULL,
  `sueldo` decimal(6,0) NOT NULL,
  `fecha_incio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `horas` int(4) NOT NULL,
  `plazas` int(4) NOT NULL,
  `descripcion` mediumtext CHARACTER SET latin1 NOT NULL,
  `estado` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_oferta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int(6) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(18) COLLATE utf8_spanish_ci NOT NULL,
  `rol` varchar(12) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
