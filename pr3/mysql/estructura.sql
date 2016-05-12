-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-05-2016 a las 23:43:25
-- Versión del servidor: 10.1.9-MariaDB
-- Versión de PHP: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `internprise`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradores`
--

CREATE TABLE `administradores` (
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
  `telefono` varchar(12) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aptitudes`
--

CREATE TABLE `aptitudes` (
  `id_aptitud` int(6) NOT NULL,
  `nombre_aptitud` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aptitudes_estudiantes`
--

CREATE TABLE `aptitudes_estudiantes` (
  `id_estudiante` int(6) DEFAULT NULL,
  `id_aptitud` int(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aptitudes_ofertas`
--

CREATE TABLE `aptitudes_ofertas` (
  `id_oferta` int(6) NOT NULL,
  `id_aptitud` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `demandas`
--

CREATE TABLE `demandas` (
  `id_demanda` int(6) NOT NULL,
  `id_oferta` int(6) NOT NULL,
  `id_estudiante` int(6) NOT NULL,
  `estado` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

CREATE TABLE `empresas` (
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

CREATE TABLE `estudiantes` (
  `id_usuario` int(6) NOT NULL,
  `dni` varchar(10) NOT NULL,
  `nombre_universidad` varchar(50) NOT NULL,
  `id_Grado` int(6) NOT NULL,
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
  `web` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='direccion';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grados`
--

CREATE TABLE `grados` (
  `id_grado` int(6) NOT NULL,
  `nombre_grado` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grados_ofertas`
--

CREATE TABLE `grados_ofertas` (
  `id_oferta` int(11) NOT NULL,
  `id_grado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ofertas`
--

CREATE TABLE `ofertas` (
  `id_oferta` int(6) NOT NULL,
  `id_empresa` int(6) NOT NULL,
  `puesto` varchar(60) CHARACTER SET latin1 NOT NULL,
  `sueldo` decimal(6,0) NOT NULL,
  `fecha_incio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `horas` int(4) NOT NULL,
  `plazas` int(4) NOT NULL,
  `descripcion` mediumtext CHARACTER SET latin1 NOT NULL,
  `estado` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_creacion` DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(6) NOT NULL,
  `email` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(72) COLLATE utf8_spanish_ci NOT NULL,
  `rol` varchar(12) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `aptitudes`
--
ALTER TABLE `aptitudes`
  ADD PRIMARY KEY (`id_aptitud`);

--
-- Indices de la tabla `aptitudes_estudiantes`
--
ALTER TABLE `aptitudes_estudiantes`
  ADD KEY `aptitudes_estudiantes_aptitudes_id_aptitud_fk` (`id_aptitud`),
  ADD KEY `aptitudes_estudiantes_estudiantes_id_usuario_fk` (`id_estudiante`);

--
-- Indices de la tabla `aptitudes_ofertas`
--
ALTER TABLE `aptitudes_ofertas`
  ADD KEY `aptitudes_ofertas_ofertas_id_oferta_fk` (`id_oferta`),
  ADD KEY `aptitudes_ofertas_aptitudes_id_aptitud_fk` (`id_aptitud`);

--
-- Indices de la tabla `demandas`
--
ALTER TABLE `demandas`
  ADD PRIMARY KEY (`id_demanda`,`id_oferta`,`id_estudiante`),
  ADD KEY `demandas_ofertas_id_oferta_fk` (`id_oferta`),
  ADD KEY `demandas_estudiantes_id_usuario_fk` (`id_estudiante`);

--
-- Indices de la tabla `empresas`
--
ALTER TABLE `empresas`
  ADD KEY `empresas_usuarios_id_usuario_fk` (`id_usuario`);

--
-- Indices de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `grados`
--
ALTER TABLE `grados`
  ADD PRIMARY KEY (`id_grado`);

--
-- Indices de la tabla `grados_ofertas`
--
ALTER TABLE `grados_ofertas`
  ADD KEY `grados_ofertas_grados_id_grado_fk` (`id_grado`),
  ADD KEY `grados_ofertas_ofertas_id_oferta_fk` (`id_oferta`);

--
-- Indices de la tabla `ofertas`
--
ALTER TABLE `ofertas`
  ADD PRIMARY KEY (`id_oferta`),
  ADD KEY `ofertas_empresas_id_usuario_fk` (`id_empresa`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `aptitudes`
--
ALTER TABLE `aptitudes`
  MODIFY `id_aptitud` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `ofertas`
--
ALTER TABLE `ofertas`
  MODIFY `id_oferta` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD CONSTRAINT `administradores_usuarios_id_usuario_fk` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `aptitudes_estudiantes`
--
ALTER TABLE `aptitudes_estudiantes`
  ADD CONSTRAINT `aptitudes_estudiantes_aptitudes_id_aptitud_fk` FOREIGN KEY (`id_aptitud`) REFERENCES `aptitudes` (`id_aptitud`),
  ADD CONSTRAINT `aptitudes_estudiantes_estudiantes_id_usuario_fk` FOREIGN KEY (`id_estudiante`) REFERENCES `estudiantes` (`id_usuario`);

--
-- Filtros para la tabla `aptitudes_ofertas`
--
ALTER TABLE `aptitudes_ofertas`
  ADD CONSTRAINT `aptitudes_ofertas_aptitudes_id_aptitud_fk` FOREIGN KEY (`id_aptitud`) REFERENCES `aptitudes` (`id_aptitud`),
  ADD CONSTRAINT `aptitudes_ofertas_ofertas_id_oferta_fk` FOREIGN KEY (`id_oferta`) REFERENCES `ofertas` (`id_oferta`);

--
-- Filtros para la tabla `demandas`
--
ALTER TABLE `demandas`
  ADD CONSTRAINT `demandas_estudiantes_id_usuario_fk` FOREIGN KEY (`id_estudiante`) REFERENCES `estudiantes` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `demandas_ofertas_id_oferta_fk` FOREIGN KEY (`id_oferta`) REFERENCES `ofertas` (`id_oferta`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `empresas`
--
ALTER TABLE `empresas`
  ADD CONSTRAINT `empresas_usuarios_id_usuario_fk` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD CONSTRAINT `estudiantes_usuarios_id_usuario_fk` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `grados_ofertas`
--
ALTER TABLE `grados_ofertas`
  ADD CONSTRAINT `grados_ofertas_grados_id_grado_fk` FOREIGN KEY (`id_grado`) REFERENCES `grados` (`id_grado`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `grados_ofertas_ofertas_id_oferta_fk` FOREIGN KEY (`id_oferta`) REFERENCES `ofertas` (`id_oferta`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ofertas`
--
ALTER TABLE `ofertas`
  ADD CONSTRAINT `ofertas_empresas_id_usuario_fk` FOREIGN KEY (`id_empresa`) REFERENCES `empresas` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
