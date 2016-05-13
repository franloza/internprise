-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-05-2016 a las 02:06:51
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 7.0.5

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
  `fecha_creacion` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ofertas`
--

INSERT INTO `ofertas` (`id_oferta`, `id_empresa`, `puesto`, `sueldo`, `fecha_incio`, `fecha_fin`, `horas`, `plazas`, `descripcion`, `estado`, `fecha_creacion`) VALUES
(1, 4, 'Administrador de sistemas Solaris', '650', '2016-05-15', '2016-11-15', 6, 2, 'Precisamos incorporar un perfil Administrador seniorde sistemas Unix con alto conocimiento en Solaris y especialista en Almacenamiento & Backup.\r\n\r\nRequisitos:\r\n· Solvencia técnica contrastable\r\no Conocimientos avanzados en equipos Sun/Oracle Solaris e IBM AIX tanto e nivel hardware como software\r\no Conocimientos avanzados en equipos Intel y/o power a nivel de Red Hat Enterprise Linux y/o similar\r\no Conocimientos de administración en equipamiento de sistemas de almacenamiento y backup de EMC\r\no Conocimientos de administración de software de automatización y orquestación de sistemas operativos, ya sean maquinas físicas, virtuales o contenedores\r\no Conocimientos de administración de productos Cloud de tipo IaaS como por ejemplo AWS (Amazon), GCE (Google) y Azure (Microsoft)\r\no Experiencia en soporte, mantenimiento y evolución de los sistemas indicados anteriormente', 'Aceptada', '2016-05-02 23:26:48'),
(2, 3, 'Desarrollador Java Junior', '400', '2016-06-01', '2016-09-01', 5, 4, 'Requisitos mínimos:\r\n- No se necesita experiencia laboral previa\r\n- Motivación por aprender y crecer dentro de una compañía con un gran plan de carrera profesional\r\n- Pasión por la programación\r\n- Team Player\r\n\r\nValorable experiencia en:\r\n- Servidor de aplicaciones Tomcat o JBOSS\r\n- Control de versiones SVN o GIT\r\n- JQuery, Servicios Web Axis 2.0, Axis\r\n- Delphi 7', 'Aceptada', '2016-05-03 23:26:48'),
(3, 3, 'Programador Web', '550', '2016-05-19', '2016-05-30', 4, 5, 'Programador web con experiencia en Ajax', 'Aceptada', '2016-05-13 00:00:00'),
(4, 3, 'Programador C++', '700', '2016-05-24', '2016-05-30', 2, 8, 'Programador c++ con POO', 'Pendiente', '2016-05-13 00:00:00'),
(5, 3, 'Programador Python', '600', '2016-05-14', '2016-05-29', 3, 7, 'Programador Python 2.7 y 3.5 con disponibilidad inmediata', 'Pendiente', '2016-05-13 00:00:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ofertas`
--
ALTER TABLE `ofertas`
  ADD PRIMARY KEY (`id_oferta`),
  ADD KEY `ofertas_empresas_id_usuario_fk` (`id_empresa`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ofertas`
--
ALTER TABLE `ofertas`
  MODIFY `id_oferta` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ofertas`
--
ALTER TABLE `ofertas`
  ADD CONSTRAINT `ofertas_empresas_id_usuario_fk` FOREIGN KEY (`id_empresa`) REFERENCES `empresas` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
