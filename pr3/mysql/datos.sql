-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-05-2016 a las 23:46:26
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

--
-- Volcado de datos para la tabla `administradores`
--

INSERT INTO `administradores` (`id_usuario`, `nombre`, `apellidos`, `nombre_universidad`, `sexo`, `dirección`, `cp`, `localidad`, `provincia`, `pais`, `web`, `telefono`) VALUES
(1, 'Pedro ', 'De la Rosa', 'Universidad Complutense de Madrid', 'Hombre', 'Av. Séneca, 2', 28040, 'Madrid', 'Madrid', 'España', 'www.ucm.es', '914520400');

--
-- Volcado de datos para la tabla `aptitudes`
--

INSERT INTO `aptitudes` (`id_aptitud`, `nombre_aptitud`) VALUES
(1, 'Java'),
(2, 'C++'),
(3, 'Linux'),
(4, 'PHP'),
(5, 'Solaris');

--
-- Volcado de datos para la tabla `aptitudes_estudiantes`
--

INSERT INTO `aptitudes_estudiantes` (`id_estudiante`, `id_aptitud`) VALUES
(2, 1),
(2, 2),
(2, 3);

--
-- Volcado de datos para la tabla `aptitudes_ofertas`
--

INSERT INTO `aptitudes_ofertas` (`id_oferta`, `id_aptitud`) VALUES
(1, 3),
(1, 5);

--
-- Volcado de datos para la tabla `empresas`
--

INSERT INTO `empresas` (`id_usuario`, `cif`, `razon_social`, `direccion`, `localidad`, `provincia`, `cp`, `pais`, `telefono`, `web`) VALUES
(3, 'B-82387770', 'Everis Spain S.L', 'Av. de Manoteras, 52', 'Madrid', 'Madrid', 28050, 'España', '917 49 00 00', 'http://www.everis.com/spain/'),
(4, 'B-78361482', 'Oracle Ibérica SRL', 'Calle José Echegaray, 6B', 'Las Rozas', 'Madrid ', 28232, 'España', '902 30 23 02', 'https://www.oracle.com/es/');

--
-- Volcado de datos para la tabla `estudiantes`
--

INSERT INTO `estudiantes` (`id_usuario`, `dni`, `nombre_universidad`, `id_Grado`, `nombre`, `apellidos`, `direccion`, `sexo`, `nacionalidad`, `fecha_nacimiento`, `localidad`, `provincia`, `pais`, `telefono`, `web`) VALUES
(2, '51231129S', 'Universidad Complutense de Madrid', 1, 'Juan Anntonio', 'Pérez Santos', 'C/Del Rosal 15,3ºB', 'Hombre', 'Española', '1993-11-26', 'Brunete', 'Madrid', 'España', '652886413', '');

--
-- Volcado de datos para la tabla `grados`
--

INSERT INTO `grados` (`id_grado`, `nombre_grado`) VALUES
(1, 'Grado en Ingeniería Informática'),
(2, 'Grado en Ingeniería del Software'),
(3, 'Grado en Ingeniería de Computadores'),
(4, 'Doble grado en Ingeniería Informática-Matemáticas');

--
-- Volcado de datos para la tabla `grados_ofertas`
--

INSERT INTO `grados_ofertas` (`id_oferta`, `id_grado`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(2, 1);

--
-- Volcado de datos para la tabla `ofertas`
--

INSERT INTO `ofertas` (`id_oferta`, `id_empresa`, `puesto`, `sueldo`, `fecha_incio`, `fecha_fin`, `horas`, `plazas`, `descripcion`, `estado`) VALUES
(1, 4, 'Administrador de sistemas Solaris', '650', '2016-05-15', '2016-11-15', 6, 2, 'Precisamos incorporar un perfil Administrador seniorde sistemas Unix con alto conocimiento en Solaris y especialista en Almacenamiento & Backup.\r\n\r\nRequisitos:\r\n· Solvencia técnica contrastable\r\no Conocimientos avanzados en equipos Sun/Oracle Solaris e IBM AIX tanto e nivel hardware como software\r\no Conocimientos avanzados en equipos Intel y/o power a nivel de Red Hat Enterprise Linux y/o similar\r\no Conocimientos de administración en equipamiento de sistemas de almacenamiento y backup de EMC\r\no Conocimientos de administración de software de automatización y orquestación de sistemas operativos, ya sean maquinas físicas, virtuales o contenedores\r\no Conocimientos de administración de productos Cloud de tipo IaaS como por ejemplo AWS (Amazon), GCE (Google) y Azure (Microsoft)\r\no Experiencia en soporte, mantenimiento y evolución de los sistemas indicados anteriormente', 'Aceptada'),
(2, 3, 'Desarrollador Java Junior', '400', '2016-06-01', '2016-09-01', 5, 4, 'Requisitos mínimos:\r\n- No se necesita experiencia laboral previa\r\n- Motivación por aprender y crecer dentro de una compañía con un gran plan de carrera profesional\r\n- Pasión por la programación\r\n- Team Player\r\n\r\nValorable experiencia en:\r\n- Servidor de aplicaciones Tomcat o JBOSS\r\n- Control de versiones SVN o GIT\r\n- JQuery, Servicios Web Axis 2.0, Axis\r\n- Delphi 7', 'Pendiente');

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `email`, `password`, `rol`) VALUES
(1, 'superuser@internprise.com', 'aprobamos2016', 'Admin'),
(2, 'usuario@ucm.es', 'aprobamos2016', 'Estudiante'),
(3, 'rrhh@everis.com', 'aprobamos2016', 'Empresa'),
(4, 'empleo@oracle.com', 'aprobamos2016', 'Empresa');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
