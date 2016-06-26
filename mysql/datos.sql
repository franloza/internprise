-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 26, 2016 at 11:12 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `internprise`
--

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `email`, `password`, `rol`) VALUES
(1, 'superuser@internprise.com', '$2y$12$75ranccGsqq9G7/c1VuXgujWl/g962lXc2igW.aQ9yKredn9zaBFS', 'Admin'),
(2, 'usuario@ucm.es', '$2y$12$75ranccGsqq9G7/c1VuXgujWl/g962lXc2igW.aQ9yKredn9zaBFS', 'Estudiante'),
(3, 'rrhh@everis.com', '$2y$12$75ranccGsqq9G7/c1VuXgujWl/g962lXc2igW.aQ9yKredn9zaBFS', 'Empresa'),
(4, 'empleo@oracle.com', '$2y$12$75ranccGsqq9G7/c1VuXgujWl/g962lXc2igW.aQ9yKredn9zaBFS', 'Empresa'),
(5, 'usuario1@ucm.es', '$2y$12$75ranccGsqq9G7/c1VuXgujWl/g962lXc2igW.aQ9yKredn9zaBFS', 'Estudiante'),
(6, 'usuario2@ucm.es', '$2y$12$75ranccGsqq9G7/c1VuXgujWl/g962lXc2igW.aQ9yKredn9zaBFS', 'Estudiante'),
(7, 'usuario3@ucm.es', '$2y$12$75ranccGsqq9G7/c1VuXgujWl/g962lXc2igW.aQ9yKredn9zaBFS', 'Estudiante'),
(8, 'usuario4@ucm.es', '$2y$12$75ranccGsqq9G7/c1VuXgujWl/g962lXc2igW.aQ9yKredn9zaBFS', 'Estudiante'),
(9, 'usuario5@ucm.es', '$2y$12$75ranccGsqq9G7/c1VuXgujWl/g962lXc2igW.aQ9yKredn9zaBFS', 'Estudiante'),
(11, 'empleo@coritel.com', '$2y$12$75ranccGsqq9G7/c1VuXgujWl/g962lXc2igW.aQ9yKredn9zaBFS', 'Empresa'),
(12, 'empleo@accenture.com', '$2y$12$75ranccGsqq9G7/c1VuXgujWl/g962lXc2igW.aQ9yKredn9zaBFS', 'Empresa'),
(13, 'empleo@hp.com', '$2y$12$75ranccGsqq9G7/c1VuXgujWl/g962lXc2igW.aQ9yKredn9zaBFS', 'Empresa'),
(15, 'franloza@ucm.es', '$2y$06$KAIBvEb3OKaW4f1U/NCsaue3Vj5eMs37kbK16q43J2pQTpu3nLuKa', 'Estudiante'),
(16, 'pepegvf@gmail.com', '$2y$06$Hi5T3EELDYh2U71nY0vDyu4XQiKzuGNKwNxnPApIj6KPAr.A63CUa', 'Estudiante');

--
-- Dumping data for table `administradores`
--

INSERT INTO `administradores` (`id_usuario`, `nombre`, `apellidos`, `nombre_universidad`, `sexo`, `dirección`, `cp`, `localidad`, `provincia`, `pais`, `web`, `telefono`) VALUES
(1, 'Pedro ', 'De la Rosa', 'Universidad Complutense de Madrid', 'Hombre', 'Av. Séneca, 2', 28040, 'Madrid', 'Madrid', 'España', 'www.ucm.es', '914520400'),
(2, 'Luis', 'Fernandez', 'Universidad Autonoma de Madrid', 'Hombre', 'Calle Barcelona, 22', 28015, 'Madrid', 'Madrid', 'España', 'www.uam.es', '913320201'),
(3, 'Sonia', 'Garcia', 'Universidad Rey Juan Carlos', 'Mujer', 'Calle Brasil, 4', 28032, 'Madrid', 'Madrid', 'España', 'www.urjc.es', '914202122');

--
-- Dumping data for table `empresas`
--

INSERT INTO `empresas` (`id_usuario`, `cif`, `razon_social`, `direccion`, `localidad`, `provincia`, `cp`, `pais`, `telefono`, `web`, `descripcion`, `avatar`) VALUES
(3, 'B-82387770', 'Everis Spain S.L', 'Av. de Manoteras, 52', 'Madrid', 'Madrid', 28050, 'España', '917 49 00 00', 'http://www.everis.com/spain/', 'Everis es una empresa de servicios y soluciones tecnológicas que comenzó su actividad en el año 2001. De capital 100% español en la actualidad factura más de 13 millones de euros con un equipo humano de más de 300 personas.', 'empresa-avatar.png'),
(4, 'B-78361482', 'Oracle SRL', 'Calle José Echegaray, 6B', 'Las Rozas', 'Madrid ', 28232, 'España', '902 30 23 02', 'https://www.oracle.com/es/', 'Oracle es una empresa de servicios y soluciones tecnológicas que comenzó su actividad en el año 2001. De capital 100% español en la actualidad factura más de 13 millones de euros con un equipo humano de más de 300 personas.', 'empresa-avatar.png'),
(12, 'B-12345121', 'Accenture S.L.', 'Calle Fray Luis, 3D', 'Getafe', 'Madrid ', 28034, 'España', '902 20 23 12', 'https://www.accenture.com/es-e', 'Accenture es una empresa de servicios y soluciones tecnológicas que comenzó su actividad en el año 2001. De capital 100% español en la actualidad factura más de 13 millones de euros con un equipo humano de más de 300 personas.', 'empresa-avatar.png'),
(11, 'B-56345123', 'Coritel S.L.', 'Av Romero, 4I', 'Alcobendas', 'Madrid ', 28123, 'España', '902 94 32 63', 'https://www.coritel.es', 'Coritel es una empresa de servicios y soluciones tecnológicas que comenzó su actividad en el año 2001. De capital 100% español en la actualidad factura más de 13 millones de euros con un equipo humano de más de 300 personas.', 'empresa-avatar.png'),
(13, 'B-23345126', 'HP S.L.', 'Av Santo Domingo, 4H', 'Getafe', 'Madrid ', 28010, 'España', '902 12 52 68', 'http://www8.hp.com/es/es/home.', 'HP es una empresa de servicios y soluciones tecnológicas que comenzó su actividad en el año 2001. De capital 100% español en la actualidad factura más de 13 millones de euros con un equipo humano de más de 300 personas.', 'empresa-avatar.png');

--
-- Dumping data for table `estudiantes`
--

INSERT INTO `estudiantes` (`id_usuario`, `dni`, `nombre_universidad`, `id_Grado`, `nombre`, `apellidos`, `direccion`, `sexo`, `nacionalidad`, `fecha_nacimiento`, `localidad`, `provincia`, `pais`, `cp`, `web`, `contratado`, `descripción`, `localización`, `experiencia_puesto_1`, `experiencia_duracion_1`, `experiencia_puesto_2`, `experiencia_duracion_2`, `experiencia_puesto_3`, `experiencia_duracion_3`, `estudios_titulo_1`, `estudios_centro_1`, `estudios_titulo_2`, `estudios_centro_2`, `estudios_titulo_3`, `estudios_centro_3`, `idiomas_idioma_1`, `idiomas_nivel_1`, `idiomas_idioma_2`, `idiomas_nivel_2`, `idiomas_idioma_3`, `idiomas_nivel_3`, `cursos_titulo_1`, `cursos_horas_1`, `cursos_titulo_2`, `cursos_horas_2`, `cursos_titulo_3`, `cursos_horas_3`, `telefono_movil`, `telefono_fijo`, `skype`, `google_plus`, `linkedin`, `twitter`, `avatar`) VALUES
(2, '51231129S', 'Universidad Complutense de Madrid', 1, 'Juan Antonio', 'Pérez Santos', 'C/Del Rosal 15,3ºB', 'Hombre', 'Española', '1993-11-26', 'Brunete', 'Madrid', 'España', '12345', 'http://www.juanan.co', 0, 'Analista de Datos', 'Madrid Centro', 'Desarrollador Web', 2, '', 0, '', 0, 'Bachillerato de Ciencias Naturales', 'Colegio Europeo de Madrid', '', '', '', '', 'Español', 'A1', 'Inglés', 'A1', '', 'A1', 'Microsoft SQL Server Cerified Professional', 30, '', 0, '', 0, '671233111', '91666777', 'juanan', 'https://plus.google.com/juanan', 'https://linkedin.com/juanan', 'https://twitter.com/juanan', 'estudiante-avatar.png'),
(5, '12345678A', 'Universidad Autonoma', 2, 'Jose Luis', 'Garcia Santos', 'C/Barcelona 1,4ºA', 'Hombre', 'Española', '1989-12-22', 'Alcala de Henares', 'Madrid', 'España', NULL, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'estudiante-avatar.png'),
(6, '32231112B', 'Universidad Rey Juan Carlos', 1, 'Francisco', 'Alonso Perez', 'C/Del Pez 23,1ºC', 'Hombre', 'Española', '1987-05-12', 'Madrid', 'Madrid', 'España', NULL, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'estudiante-avatar.png'),
(7, '42231113H', 'Universidad Politecnica', 3, 'Ingrid', 'Rodriguez Fernandez', 'C/Fray Luis 20,5ºH', 'Mujer', 'Española', '1994-02-04', 'Oviedo', 'Oviedo', 'España', NULL, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'estudiante-avatar.png'),
(8, '12231129R', 'Universidad Complutense de Madrid', 4, 'Esther', 'Ruiz Otero', 'C/Barquillo 3,1ºI', 'Mujer', 'Española', '1989-10-12', 'Getafe', 'Madrid', 'España', NULL, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'estudiante-avatar.png'),
(9, '64231125A', 'Universidad Politecnica', 1, 'Pedro', 'Lopez Garcia', 'C/Perdida 2,8ºC', 'Hombre', 'Española', '1994-10-04', 'Parla', 'Madrid', 'España', NULL, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'estudiante-avatar.png'),
(15, '51474260F', 'Universidad Complutense de Madrid', 1, 'Francisco ', 'Lozano', 'Calle Navaluenga', 'on', 'Española', '2016-06-29', 'Majadahonda', 'MADRID', 'españa', NULL, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, 'estudiante-avatar.png'),
(16, '50769853K', 'Universidad Complutense de Madrid', 6, 'Pepe', 'Maldonado', 'Calle Navaluenga 40', 'on', 'Spain', '2016-06-26', 'Majadahonda', 'Madrid', 'Spain', NULL, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, 'estudiante-avatar.png');

--
-- Dumping data for table `grados`
--

INSERT INTO `grados` (`id_grado`, `nombre_grado`) VALUES
(1, 'Grado en Ingeniería Informática'),
(2, 'Grado en Ingeniería del Software'),
(3, 'Grado en Ingeniería de Computadores'),
(4, 'Doble grado en Ingeniería Informática-Matemáticas'),
(5, 'Grado en Marketing'),
(6, 'Grado en Ciencias Políticas'),
(7, 'Grado en Derecho'),
(8, 'Grado en Trollear'),
(9, 'Grado en Ciencias Económicas'),
(10, 'Grado en Administración y Dirección de Empresas'),
(11, 'Grado en Ingeniería Electrónica'),
(12, 'Grado en Ingeniería Industrial');

--
-- Dumping data for table `aptitudes`
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
(9, 'Ruby'),
(16, 'Groovy'),
(17, 'Haskell'),
(18, 'Oratoria'),
(19, 'ORACLE SQL'),
(20, 'Buen pulso'),
(21, 'Toque con el azucar'),
(22, 'Entorno Oracle'),
(23, 'Bolsa'),
(24, 'Broker'),
(25, 'Liderazgo'),
(26, 'HTML'),
(27, 'Javascript'),
(28, 'Manejar la escoba'),
(29, 'y la fregona'),
(30, 'Manos de técnico'),
(31, 'Electrotecnia');


--
-- Dumping data for table `ofertas`
--

INSERT INTO `ofertas` (`id_oferta`, `id_empresa`, `puesto`, `sueldo`, `fecha_incio`, `fecha_fin`, `horas`, `plazas`, `descripcion`, `reqMinimos`, `idiomas`, `estado`, `fecha_creacion`) VALUES
(1, 4, 'Administrador de sistemas Solaris', '650', '2016-05-15', '2016-11-15', 6, 2, 'Precisamos incorporar un perfil Administrador seniorde sistemas Unix con alto conocimiento en Solaris y especialista en Almacenamiento & Backup.', 'Requisitos:\r\n· Solvencia técnica contrastable', 'Ingles: nivel avanzado C1', 'Aceptada', '2016-05-02 23:26:48'),
(2, 3, 'Desarrollador Java Junior', '400', '2016-06-01', '2016-09-01', 5, 4, 'desarrollo de aplicaciones java', 'Requisitos mínimos:\r\n- No se necesita experiencia laboral previa\r\n- Motivación por aprender y crecer dentro de una compañía con un gran plan de carrera profesional\r\n- Pasión por la programación\r\n-', 'ninguno', 'Pendiente', '2016-05-03 23:26:48'),
(3, 3, 'Programador Web', '550', '2016-05-19', '2016-05-30', 4, 5, 'Programador web con experiencia en Ajax', 'estar en ultimo curso de carrera', 'ingles nivel intermedio', 'Aceptada', '2016-05-13 00:00:00'),
(4, 3, 'Programador C++', '700', '2016-05-24', '2016-05-30', 2, 8, 'Programar apliaciones en c++', 'estar en ultimo curso de GII', 'Ingles nivel avanzado', 'Pendiente', '2016-05-13 00:00:00'),
(5, 3, 'Programador Python', '600', '2016-05-14', '2016-05-29', 3, 7, 'Programador Python 2.7 y 3.5 con disponibilidad inmediata', 'req minimos', 'idiomas', 'Pendiente', '2016-06-25 23:00:00'),
(6, 3, 'Becario', '400', '2016-06-27', '2016-07-01', 1, 7, 'ssdscc', 'fcf', 'INgles', 'Pendiente', '2016-06-26 20:16:28'),
(7, 3, 'Bufete ', '7', '2016-06-27', '2016-06-28', 1, 8, 'sdfsdf', 'df', 'Húngaro', 'Aceptada', '2016-06-26 20:20:04'),
(8, 4, 'Analista programador', '455', '2016-06-29', '2016-07-13', 4, 3, 'Ven a trabajar con nosotros y entraras en un muy buen ambiente de trabajo rodeado de los mejores ingenieros.', 'Se requiere un conocimiento medio de programación, sobre todo en la orientada a objetos como Java.', 'Ingles Nivel Medio-Alto', 'Pendiente', '2016-06-26 20:33:44'),
(9, 4, 'El de los cafés', '569', '2016-06-27', '2016-06-28', 1, 100, 'Despega en tu carrera profesional.', 'Ser capaz de ir a la máquina de los cafes, pedir un capuchino y llevarselo al jefe.', 'Español', 'Pendiente', '2016-06-26 20:36:08'),
(10, 4, 'Soporte Técnico', '670', '2016-09-14', '2017-06-14', 8, 3, 'Atiende todas las dudas de nuestros clientes.', '', 'Inglés nivel medio', 'Pendiente', '2016-06-26 20:38:44'),
(11, 11, 'Analista de mercados', '800', '2016-06-21', '2016-06-22', 5, 4, 'Adentrate en el mundo del mercado de valores.', 'Tener un conocimiento amplio de como están los mercados en la actualidad y saber prever su futuro.', 'Inglés, Francés, Polcaco', 'Pendiente', '2016-06-26 20:42:19'),
(12, 11, 'Jefe de Proyecto', '900', '2016-06-30', '2017-05-11', 8, 1, 'Se nuestro jefe de proyecto, buscamos a gente con ganas de emprender nuevas ideas y desarrollarlas para crear soluciones informáticas punteras.', 'Ser capaz de coordinar eficientemente a un equipo unido para un mismo fin.', 'Inglés, Alemán', 'Pendiente', '2016-06-26 20:45:10'),
(13, 11, 'Becario fregasuelos', '3', '2016-06-28', '2016-07-21', 2, 55, 'Friega todo el día es divertido!!!', 'Barrer en silencio para no molestar a los trabajadores.', 'None', 'Pendiente', '2016-06-26 20:46:58'),
(14, 13, 'Reparador de Portátiles', '780', '2016-06-21', '2016-10-06', 4, 7, 'Se te da bien la electrónica? entonces ven a trabajar con nosotros y aprenderás mucho más...', 'Saber como buscar los fallos de los portátiles y su posterior arreglo.', '', 'Pendiente', '2016-06-26 21:02:35');



--
-- Dumping data for table `aptitudes_estudiantes`
--

INSERT INTO `aptitudes_estudiantes` (`id_estudiante`, `id_aptitud`) VALUES
(2, 4),
(2, 7),
(2, 8),
(5, 1),
(6, 6),
(7, 9),
(7, 5),
(7, 3),
(8, 16),
(9, 17),
(9, 2);

--
-- Dumping data for table `aptitudes_ofertas`
--

INSERT INTO `aptitudes_ofertas` (`id_oferta`, `id_aptitud`) VALUES
(1, 3),
(1, 4),
(2, 4),
(2, 5),
(3, 6),
(4, 8),
(5, 9),
(6, 1),
(7, 18),
(8, 19),
(8, 1),
(8, 4),
(9, 20),
(9, 21),
(10, 22),
(11, 23),
(11, 24),
(12, 25),
(12, 18),
(12, 4),
(12, 26),
(12, 27),
(13, 28),
(13, 29),
(14, 30),
(14, 31);

--
-- Dumping data for table `contratos`
--

INSERT INTO `contratos` (`id_contrato`, `id_oferta`, `id_estudiante`, `estado`) VALUES
(1, 2, 2, 'Activo'),
(2, 3, 5, 'Activo'),
(3, 4, 6, 'Expirado'),
(4, 7, 16, 'Activo');

--
-- Dumping data for table `demandas`
--

INSERT INTO `demandas` (`id_demanda`, `id_oferta`, `id_estudiante`, `estado`, `comentarios`, `fecha_solicitud`) VALUES
(1, 7, 16, 'Aceptada', NULL, '2016-06-26 20:22:00');


--
-- Dumping data for table `grados_ofertas`
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
(5, 4),
(6, 1),
(6, 5),
(7, 6),
(7, 7),
(8, 1),
(8, 3),
(8, 2),
(9, 1),
(9, 8),
(10, 1),
(10, 2),
(11, 9),
(11, 10),
(12, 1),
(12, 2),
(12, 3),
(13, 9),
(13, 10),
(14, 11),
(14, 12);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
