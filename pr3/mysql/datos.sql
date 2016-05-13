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
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `email`, `password`, `rol`) VALUES
(1, 'superuser@internprise.com', 'aprobamos2016', 'Admin'),
(2, 'usuario@ucm.es', 'aprobamos2016', 'Estudiante'),
(3, 'rrhh@everis.com', 'aprobamos2016', 'Empresa'),
(4, 'empleo@oracle.com', 'aprobamos2016', 'Empresa');


--
-- Volcado de datos para la tabla `administradores`
--

INSERT INTO `administradores` (`id_usuario`, `nombre`, `apellidos`, `nombre_universidad`, `sexo`, `dirección`, `cp`, `localidad`, `provincia`, `pais`, `web`, `telefono`) VALUES
(1, 'Pedro ', 'De la Rosa', 'Universidad Complutense de Madrid', 'Hombre', 'Av. Séneca, 2', 28040, 'Madrid', 'Madrid', 'España', 'www.ucm.es', '914520400'),
(2, 'Luis', 'Fernandez', 'Universidad Autonoma de Madrid', 'Hombre', 'Calle Barcelona, 22', 28015, 'Madrid', 'Madrid', 'España', 'www.uam.es', '913320201'),
(3, 'Sonia', 'Garcia', 'Universidad Rey Juan Carlos', 'Mujer', 'Calle Brasil, 4', 28032, 'Madrid', 'Madrid', 'España', 'www.urjc.es', '914202122');
--
-- Volcado de datos para la tabla `empresas`
--

INSERT INTO `empresas` (`id_usuario`, `cif`, `razon_social`, `direccion`, `localidad`, `provincia`, `cp`, `pais`, `telefono`, `web`) VALUES
(3, 'B-82387770', 'Everis Spain S.L', 'Av. de Manoteras, 52', 'Madrid', 'Madrid', 28050, 'España', '917 49 00 00', 'http://www.everis.com/spain/'),
(4, 'B-78361482', 'Oracle SRL', 'Calle José Echegaray, 6B', 'Las Rozas', 'Madrid ', 28232, 'España', '902 30 23 02', 'https://www.oracle.com/es/'),
(5, 'B-12345121', 'Accenture S.L.', 'Calle Fray Luis, 3D', 'Getafe', 'Madrid ', 28034, 'España', '902 20 23 12', 'https://www.accenture.com/es-es/'),
(6, 'B-32225122', 'Indra S.L.', 'Calle Fernando, 1A', 'Alcala de Henares', 'Madrid ', 28031, 'España', '902 12 32 15', 'http://www.indracompany.com'),
(7, 'B-56345123', 'Coritel S.L.', 'Av Romero, 4I', 'Alcobendas', 'Madrid ', 28123, 'España', '902 94 32 63', 'https://www.coritel.es'),
(8, 'B-95345124', 'Esprinet S.L.', 'Calle Ponferrada, 5B', 'Parla', 'Madrid ', 28016, 'España', '902 42 31 55', 'http://www.esprinet.com'),
(9, 'B-83345125', 'Lenovo S.L.', 'Calle Trueba, 4A', 'Madrid', 'Madrid ', 28012, 'España', '902 65 62 23', 'http://www.lenovo.com'),
(10,'B-23345126', 'HP S.L.', 'Av Santo Domingo, 4H', 'Getafe', 'Madrid ', 28010, 'España', '902 12 52 68', 'http://www8.hp.com/es/es/home.html');

--
-- Volcado de datos para la tabla `estudiantes`
--

INSERT INTO `estudiantes` (`id_usuario`, `dni`, `nombre_universidad`, `id_Grado`, `nombre`, `apellidos`, `direccion`, `sexo`, `nacionalidad`, `fecha_nacimiento`, `localidad`, `provincia`, `pais`, `telefono`, `web`) VALUES
(2, '51231129S', 'Universidad Complutense de Madrid', 1, 'Juan Anntonio', 'Pérez Santos', 'C/Del Rosal 15,3ºB', 'Hombre', 'Española', '1993-11-26', 'Brunete', 'Madrid', 'España', '652886413', ''),
(3, '12345678A', 'Universidad Autonoma', 2, 'Jose Luis', 'Garcia Santos', 'C/Barcelona 1,4ºA', 'Hombre', 'Española', '1989-12-22', 'Alcala de Henares', 'Madrid', 'España', '637124365', ''),
(4, '32231112B', 'Universidad Rey Juan Carlos', 1, 'Francisco', 'Alonso Perez', 'C/Del Pez 23,1ºC', 'Hombre', 'Española', '1987-05-12', 'Madrid', 'Madrid', 'España', '612987643', ''),
(5, '42231113H', 'Universidad Politecnica', 3, 'Ingrid', 'Rodriguez Fernandez', 'C/Fray Luis 20,5ºH', 'Mujer', 'Española', '1994-02-04', 'Oviedo', 'Oviedo', 'España', '64215825', ''),
(6, '12231129R', 'Universidad Complutense de Madrid', 4, 'Esther', 'Ruiz Otero', 'C/Barquillo 3,1ºI', 'Mujer', 'Española', '1989-10-12', 'Getafe', 'Madrid', 'España', '62752817', ''),
(7, '64231125A', 'Universidad Politecnica', 1, 'Pedro', 'Lopez Garcia', 'C/Perdida 2,8ºC', 'Hombre', 'Española', '1994-10-04', 'Parla', 'Madrid', 'España', '652583423', ''),
(8, '87231128J', 'Universidad Complutense de Madrid', 2, 'Rodrigo', 'Fernandez Garcia', 'C/Federico Lorca 34,4ºE', 'Hombre', 'Española', '1984-04-23', 'Madrid', 'Madrid', 'España', '672986112', '');

--
-- Volcado de datos para la tabla `grados`
--

INSERT INTO `grados` (`id_grado`, `nombre_grado`) VALUES
(1, 'Grado en Ingeniería Informática'),
(2, 'Grado en Ingeniería del Software'),
(3, 'Grado en Ingeniería de Computadores'),
(4, 'Doble grado en Ingeniería Informática-Matemáticas');

--
-- Volcado de datos para la tabla `aptitudes`
--

INSERT INTO `aptitudes` (`id_aptitud`, `nombre_aptitud`) VALUES
(1, 'Java'),
(2, 'C++'),
(3, 'Linux'),
(4, 'PHP'),
(5, 'Python'),
(6, 'Bash'),
(7, 'Perl'),
(8, 'HTML5'),
(9, 'Ruby');

--
-- Volcado de datos para la tabla `ofertas`
--

INSERT INTO `ofertas` (`id_oferta`, `id_empresa`, `puesto`, `sueldo`, `fecha_incio`, `fecha_fin`, `horas`, `plazas`, `descripcion`, `estado`, `fecha_creacion`) VALUES
(1, 4, 'Administrador de sistemas Solaris', '650', '2016-05-15', '2016-11-15', 6, 2, 'Precisamos incorporar un perfil Administrador seniorde sistemas Unix con alto conocimiento en Solaris y especialista en Almacenamiento & Backup.\r\n\r\nRequisitos:\r\n· Solvencia técnica contrastable\r\no Conocimientos avanzados en equipos Sun/Oracle Solaris e IBM AIX tanto e nivel hardware como software\r\no Conocimientos avanzados en equipos Intel y/o power a nivel de Red Hat Enterprise Linux y/o similar\r\no Conocimientos de administración en equipamiento de sistemas de almacenamiento y backup de EMC\r\no Conocimientos de administración de software de automatización y orquestación de sistemas operativos, ya sean maquinas físicas, virtuales o contenedores\r\no Conocimientos de administración de productos Cloud de tipo IaaS como por ejemplo AWS (Amazon), GCE (Google) y Azure (Microsoft)\r\no Experiencia en soporte, mantenimiento y evolución de los sistemas indicados anteriormente', 'Aceptada', '2016-05-02 23:26:48'),
(2, 3, 'Desarrollador Java Junior', '400', '2016-06-01', '2016-09-01', 5, 4, 'Requisitos mínimos:\r\n- No se necesita experiencia laboral previa\r\n- Motivación por aprender y crecer dentro de una compañía con un gran plan de carrera profesional\r\n- Pasión por la programación\r\n- Team Player\r\n\r\nValorable experiencia en:\r\n- Servidor de aplicaciones Tomcat o JBOSS\r\n- Control de versiones SVN o GIT\r\n- JQuery, Servicios Web Axis 2.0, Axis\r\n- Delphi 7', 'Pendiente', '2016-05-03 23:26:48');
(3, 3, 'Programador Web', '550', '2016-05-19', '2016-05-30', 4, 5, 'Programador web con experiencia en Ajax', 'Aceptada', '2016-05-13 00:00:00'),
(4, 3, 'Programador C++', '700', '2016-05-24', '2016-05-30', 2, 8, 'Programador c++ con POO', 'Pendiente', '2016-05-13 00:00:00'),
(5, 3, 'Programador Python', '600', '2016-05-14', '2016-05-29', 3, 7, 'Programador Python 2.7 y 3.5 con disponibilidad inmediata', 'Pendiente', '2016-05-13 00:00:00');

--
-- Volcado de datos para la tabla `aptitudes_estudiantes`
--

INSERT INTO `aptitudes_estudiantes` (`id_estudiante`, `id_aptitud`) VALUES
(2, 1),
(2, 2),
(4, 4),
(4, 7),
(4, 8),
(5, 1),
(6, 6),
(7, 9),
(7, 5),
(7, 3);

--
-- Volcado de datos para la tabla `aptitudes_ofertas`
--

INSERT INTO `aptitudes_ofertas` (`id_oferta`, `id_aptitud`) VALUES
(1, 3),
(1, 4),
(2, 4),
(2, 5),
(3, 6),
(4, 8),
(5, 9);


--
-- Volcado de datos para la tabla `grados_ofertas`
--

INSERT INTO `grados_ofertas` (`id_oferta`, `id_grado`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(2, 2),
(3, 1),
(4, 2),
(5, 1),
(5, 3),
(5, 4);


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
