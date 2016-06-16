USE `internprise`;
-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: localhost    Database: internprise
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.9-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Dumping data for table `administradores`
--

LOCK TABLES `administradores` WRITE;
/*!40000 ALTER TABLE `administradores` DISABLE KEYS */;
INSERT INTO `administradores` VALUES (1,'Pedro ','De la Rosa','Universidad Complutense de Madrid','Hombre','Av. Séneca, 2',28040,'Madrid','Madrid','España','www.ucm.es','914520400'),(2,'Luis','Fernandez','Universidad Autonoma de Madrid','Hombre','Calle Barcelona, 22',28015,'Madrid','Madrid','España','www.uam.es','913320201'),(3,'Sonia','Garcia','Universidad Rey Juan Carlos','Mujer','Calle Brasil, 4',28032,'Madrid','Madrid','España','www.urjc.es','914202122');
/*!40000 ALTER TABLE `administradores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `aptitudes`
--

LOCK TABLES `aptitudes` WRITE;
/*!40000 ALTER TABLE `aptitudes` DISABLE KEYS */;
INSERT INTO `aptitudes` VALUES (1,'Java'),(2,'C++'),(3,'Linux'),(4,'PHP'),(5,'Python'),(6,'Bash'),(7,'Perl'),(8,'HTML5'),(9,'Ruby');
/*!40000 ALTER TABLE `aptitudes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `aptitudes_estudiantes`
--

LOCK TABLES `aptitudes_estudiantes` WRITE;
/*!40000 ALTER TABLE `aptitudes_estudiantes` DISABLE KEYS */;
INSERT INTO `aptitudes_estudiantes` VALUES (2,1),(2,2),(4,4),(4,7),(4,8),(5,1),(6,6),(7,9),(7,5),(7,3);
/*!40000 ALTER TABLE `aptitudes_estudiantes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `aptitudes_ofertas`
--

LOCK TABLES `aptitudes_ofertas` WRITE;
/*!40000 ALTER TABLE `aptitudes_ofertas` DISABLE KEYS */;
INSERT INTO `aptitudes_ofertas` VALUES (1,3),(1,4),(2,4),(2,5),(3,6),(4,8),(5,9);
/*!40000 ALTER TABLE `aptitudes_ofertas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `demandas`
--

LOCK TABLES `demandas` WRITE;
/*!40000 ALTER TABLE `demandas` DISABLE KEYS */;
/*!40000 ALTER TABLE `demandas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `empresas`
--

LOCK TABLES `empresas` WRITE;
/*!40000 ALTER TABLE `empresas` DISABLE KEYS */;
INSERT INTO `empresas` VALUES (3,'B-82387770','Everis Spain S.L','Av. de Manoteras, 52','Madrid','Madrid',28050,'España','917 49 00 00','http://www.everis.com/spain/'),(4,'B-78361482','Oracle SRL','Calle José Echegaray, 6B','Las Rozas','Madrid ',28232,'España','902 30 23 02','https://www.oracle.com/es/'),(5,'B-12345121','Accenture S.L.','Calle Fray Luis, 3D','Getafe','Madrid ',28034,'España','902 20 23 12','https://www.accenture.com/es-e'),(6,'B-32225122','Indra S.L.','Calle Fernando, 1A','Alcala de Henares','Madrid ',28031,'España','902 12 32 15','http://www.indracompany.com'),(7,'B-56345123','Coritel S.L.','Av Romero, 4I','Alcobendas','Madrid ',28123,'España','902 94 32 63','https://www.coritel.es'),(8,'B-95345124','Esprinet S.L.','Calle Ponferrada, 5B','Parla','Madrid ',28016,'España','902 42 31 55','http://www.esprinet.com'),(9,'B-83345125','Lenovo S.L.','Calle Trueba, 4A','Madrid','Madrid ',28012,'España','902 65 62 23','http://www.lenovo.com'),(10,'B-23345126','HP S.L.','Av Santo Domingo, 4H','Getafe','Madrid ',28010,'España','902 12 52 68','http://www8.hp.com/es/es/home.');
/*!40000 ALTER TABLE `empresas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `estudiantes`
--

LOCK TABLES `estudiantes` WRITE;
/*!40000 ALTER TABLE `estudiantes` DISABLE KEYS */;
INSERT INTO `estudiantes` VALUES (2,'51231129S','Universidad Complutense de Madrid',1,'Juan Antonio','Pérez Santos','C/Del Rosal 15,3ºB','Hombre','Española','1993-11-26','Brunete','Madrid','España','12345','http://www.juanan.co',0,'Analista de Datos','Madrid Centro','Desarrollador Web',2,'',0,'',0,'Bachillerato de Ciencias Naturales','Colegio Europeo de Madrid','','','','','Español','A1','Inglés','A1','','A1','Microsoft SQL Server Cerified Professional',30,'',0,'',0,'671233111','91666777','juanan','https://plus.google.com/juanan','https://linkedin.com/juanan','https://twitter.com/juanan',NULL),(3,'12345678A','Universidad Autonoma',2,'Jose Luis','Garcia Santos','C/Barcelona 1,4ºA','Hombre','Española','1989-12-22','Alcala de Henares','Madrid','España',NULL,'',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,'32231112B','Universidad Rey Juan Carlos',1,'Francisco','Alonso Perez','C/Del Pez 23,1ºC','Hombre','Española','1987-05-12','Madrid','Madrid','España',NULL,'',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(5,'42231113H','Universidad Politecnica',3,'Ingrid','Rodriguez Fernandez','C/Fray Luis 20,5ºH','Mujer','Española','1994-02-04','Oviedo','Oviedo','España',NULL,'',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(6,'12231129R','Universidad Complutense de Madrid',4,'Esther','Ruiz Otero','C/Barquillo 3,1ºI','Mujer','Española','1989-10-12','Getafe','Madrid','España',NULL,'',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(7,'64231125A','Universidad Politecnica',1,'Pedro','Lopez Garcia','C/Perdida 2,8ºC','Hombre','Española','1994-10-04','Parla','Madrid','España',NULL,'',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(8,'87231128J','Universidad Complutense de Madrid',2,'Rodrigo','Fernandez Garcia','C/Federico Lorca 34,4ºE','Hombre','Española','1984-04-23','Madrid','Madrid','España',NULL,'',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `estudiantes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `grados`
--

LOCK TABLES `grados` WRITE;
/*!40000 ALTER TABLE `grados` DISABLE KEYS */;
INSERT INTO `grados` VALUES (1,'Grado en Ingeniería Informática'),(2,'Grado en Ingeniería del Software'),(3,'Grado en Ingeniería de Computadores'),(4,'Doble grado en Ingeniería Informática-Matemáticas');
/*!40000 ALTER TABLE `grados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `grados_ofertas`
--

LOCK TABLES `grados_ofertas` WRITE;
/*!40000 ALTER TABLE `grados_ofertas` DISABLE KEYS */;
INSERT INTO `grados_ofertas` VALUES (1,1),(1,2),(1,3),(1,4),(2,2),(3,1),(4,2),(5,1),(5,3),(5,4);
/*!40000 ALTER TABLE `grados_ofertas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `ofertas`
--

LOCK TABLES `ofertas` WRITE;
/*!40000 ALTER TABLE `ofertas` DISABLE KEYS */;
INSERT INTO `ofertas` VALUES (1,4,'Administrador de sistemas Solaris',650,'2016-05-15','2016-11-15',6,2,'Precisamos incorporar un perfil Administrador seniorde sistemas Unix con alto conocimiento en Solaris y especialista en Almacenamiento & Backup.','','Requisitos:\r\n· Solvencia técnica contrastable','Ingles: nivel avanzado C1','Conocimientos avanzados en eipos Sun/Oracle Solaris e IBM AIX tanto e nivel hardware como software\r\no Conocimientos avanzados en equipos Intel y/o power a nivel de Red Hat Enterprise Linux y/o similar','Aceptada','2016-05-02 23:26:48'),(2,3,'Desarrollador Java Junior',400,'2016-06-01','2016-09-01',5,4,'desarrollo de aplicaciones java','','Requisitos mínimos:\r\n- No se necesita experiencia laboral previa\r\n- Motivación por aprender y crecer dentro de una compañía con un gran plan de carrera profesional\r\n- Pasión por la programación\r\n-','ninguno',' Team Player\r\n\r\nValorable experiencia en:\r\n- Servidor de aplicaciones Tomcat o JBOSS\r\n- Control de versiones SVN o GIT\r\n- JQuery, Servicios Web Axis 2.0, Axis\r\n- Delphi 7','Pendiente','2016-05-03 23:26:48'),(3,3,'Programador Web',550,'2016-05-19','2016-05-30',4,5,'Programador web con experiencia en Ajax','','estar en ultimo curso de carrera','ingles nivel intermedio','conocimientos de Ajax','Aceptada','2016-05-13 00:00:00'),(4,3,'Programador C++',700,'2016-05-24','2016-05-30',2,8,'Programar apliaciones en c++','','estar en ultimo curso de GII','Ingles nivel avanzado','','Pendiente','2016-05-13 00:00:00'),(5,3,'Programador Python',600,'2016-05-14','2016-05-29',3,7,'Programador Python 2.7 y 3.5 con disponibilidad inmediata','aptitudes','req minimos','idiomas','req deseables','Pendiente','2016-05-13 00:00:00');
/*!40000 ALTER TABLE `ofertas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'superuser@internprise.com','$2y$12$75ranccGsqq9G7/c1VuXgujWl/g962lXc2igW.aQ9yKredn9zaBFS','Admin'),(2,'usuario@ucm.es','$2y$12$75ranccGsqq9G7/c1VuXgujWl/g962lXc2igW.aQ9yKredn9zaBFS','Estudiante'),(3,'rrhh@everis.com','$2y$12$75ranccGsqq9G7/c1VuXgujWl/g962lXc2igW.aQ9yKredn9zaBFS','Empresa'),(4,'empleo@oracle.com','$2y$12$75ranccGsqq9G7/c1VuXgujWl/g962lXc2igW.aQ9yKredn9zaBFS','Empresa'),(5,'usuario1@ucm.es','$2y$12$75ranccGsqq9G7/c1VuXgujWl/g962lXc2igW.aQ9yKredn9zaBFS','Estudiante'),(6,'usuario2@ucm.es','$2y$12$75ranccGsqq9G7/c1VuXgujWl/g962lXc2igW.aQ9yKredn9zaBFS','Estudiante'),(7,'usuario3@ucm.es','$2y$12$75ranccGsqq9G7/c1VuXgujWl/g962lXc2igW.aQ9yKredn9zaBFS','Estudiante'),(8,'usuario4@ucm.es','$2y$12$75ranccGsqq9G7/c1VuXgujWl/g962lXc2igW.aQ9yKredn9zaBFS','Estudiante'),(9,'usuario5@ucm.es','$2y$12$75ranccGsqq9G7/c1VuXgujWl/g962lXc2igW.aQ9yKredn9zaBFS','Estudiante'),(10,'usuario6@ucm.es','$2y$12$75ranccGsqq9G7/c1VuXgujWl/g962lXc2igW.aQ9yKredn9zaBFS','Estudiante'),(11,'empleo1@oracle.com','$2y$12$75ranccGsqq9G7/c1VuXgujWl/g962lXc2igW.aQ9yKredn9zaBFS','Empresa'),(12,'empleo@coritel.com','$2y$12$75ranccGsqq9G7/c1VuXgujWl/g962lXc2igW.aQ9yKredn9zaBFS','Empresa'),(13,'empleo@accenture.com','$2y$12$75ranccGsqq9G7/c1VuXgujWl/g962lXc2igW.aQ9yKredn9zaBFS','Empresa'),(14,'empleo@hp.com','$2y$12$75ranccGsqq9G7/c1VuXgujWl/g962lXc2igW.aQ9yKredn9zaBFS','Empresa');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'internprise'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-06-16 22:37:51


