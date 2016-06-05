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
-- Table structure for table `administradores`
--

DROP TABLE IF EXISTS `administradores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
  `telefono` varchar(12) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id_usuario`),
  CONSTRAINT `administradores_usuarios_id_usuario_fk` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `aptitudes`
--

DROP TABLE IF EXISTS `aptitudes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aptitudes` (
  `id_aptitud` int(6) NOT NULL AUTO_INCREMENT,
  `nombre_aptitud` varchar(20) NOT NULL,
  PRIMARY KEY (`id_aptitud`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `aptitudes_estudiantes`
--

DROP TABLE IF EXISTS `aptitudes_estudiantes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aptitudes_estudiantes` (
  `id_estudiante` int(6) DEFAULT NULL,
  `id_aptitud` int(6) DEFAULT NULL,
  KEY `aptitudes_estudiantes_aptitudes_id_aptitud_fk` (`id_aptitud`),
  KEY `aptitudes_estudiantes_estudiantes_id_usuario_fk` (`id_estudiante`),
  CONSTRAINT `aptitudes_estudiantes_aptitudes_id_aptitud_fk` FOREIGN KEY (`id_aptitud`) REFERENCES `aptitudes` (`id_aptitud`),
  CONSTRAINT `aptitudes_estudiantes_estudiantes_id_usuario_fk` FOREIGN KEY (`id_estudiante`) REFERENCES `estudiantes` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `aptitudes_ofertas`
--

DROP TABLE IF EXISTS `aptitudes_ofertas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aptitudes_ofertas` (
  `id_oferta` int(6) NOT NULL,
  `id_aptitud` int(6) NOT NULL,
  KEY `aptitudes_ofertas_ofertas_id_oferta_fk` (`id_oferta`),
  KEY `aptitudes_ofertas_aptitudes_id_aptitud_fk` (`id_aptitud`),
  CONSTRAINT `aptitudes_ofertas_aptitudes_id_aptitud_fk` FOREIGN KEY (`id_aptitud`) REFERENCES `aptitudes` (`id_aptitud`),
  CONSTRAINT `aptitudes_ofertas_ofertas_id_oferta_fk` FOREIGN KEY (`id_oferta`) REFERENCES `ofertas` (`id_oferta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `demandas`
--

DROP TABLE IF EXISTS `demandas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `demandas` (
  `id_demanda` int(6) NOT NULL AUTO_INCREMENT,
  `id_oferta` int(6) NOT NULL,
  `id_estudiante` int(6) NOT NULL,
  `estado` varchar(20) NOT NULL,
  `comentarios` longtext,
  `fecha_solicitud` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_demanda`,`id_oferta`,`id_estudiante`),
  KEY `demandas_ofertas_id_oferta_fk` (`id_oferta`),
  KEY `demandas_estudiantes_id_usuario_fk` (`id_estudiante`),
  CONSTRAINT `demandas_estudiantes_id_usuario_fk` FOREIGN KEY (`id_estudiante`) REFERENCES `estudiantes` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `demandas_ofertas_id_oferta_fk` FOREIGN KEY (`id_oferta`) REFERENCES `ofertas` (`id_oferta`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `empresas`
--

DROP TABLE IF EXISTS `empresas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
  `web` varchar(30) NOT NULL,
  KEY `empresas_usuarios_id_usuario_fk` (`id_usuario`),
  CONSTRAINT `empresas_usuarios_id_usuario_fk` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `estudiantes`
--

DROP TABLE IF EXISTS `estudiantes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
  `web` varchar(20) NOT NULL,
  `contratado` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id_usuario`),
  CONSTRAINT `estudiantes_usuarios_id_usuario_fk` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='direccion';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `grados`
--

DROP TABLE IF EXISTS `grados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grados` (
  `id_grado` int(6) NOT NULL,
  `nombre_grado` varchar(50) NOT NULL,
  PRIMARY KEY (`id_grado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `grados_ofertas`
--

DROP TABLE IF EXISTS `grados_ofertas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grados_ofertas` (
  `id_oferta` int(11) NOT NULL,
  `id_grado` int(11) NOT NULL,
  KEY `grados_ofertas_grados_id_grado_fk` (`id_grado`),
  KEY `grados_ofertas_ofertas_id_oferta_fk` (`id_oferta`),
  CONSTRAINT `grados_ofertas_grados_id_grado_fk` FOREIGN KEY (`id_grado`) REFERENCES `grados` (`id_grado`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `grados_ofertas_ofertas_id_oferta_fk` FOREIGN KEY (`id_oferta`) REFERENCES `ofertas` (`id_oferta`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ofertas`
--

DROP TABLE IF EXISTS `ofertas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ofertas` (
  `id_oferta` int(6) NOT NULL AUTO_INCREMENT,
  `id_empresa` int(6) NOT NULL,
  `puesto` varchar(60) CHARACTER SET latin1 NOT NULL,
  `sueldo` decimal(6,0) NOT NULL,
  `fecha_incio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `horas` int(4) NOT NULL,
  `plazas` int(4) NOT NULL,
  `descripcion` mediumtext CHARACTER SET latin1 NOT NULL,
  `estado` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_oferta`),
  KEY `ofertas_empresas_id_usuario_fk` (`id_empresa`),
  CONSTRAINT `ofertas_empresas_id_usuario_fk` FOREIGN KEY (`id_empresa`) REFERENCES `empresas` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id_usuario` int(6) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(72) COLLATE utf8_spanish_ci NOT NULL,
  `rol` varchar(12) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-06-01 17:57:03


--
-- Table structure for table `contratos`
--

-- 
-- algunas dudas son:
--   que es mejor poner id_contrato, id_empresa, id_estudiante y asi luego
--   en la consulta se usa esos ids para sacar la empresa y el nombre y apellidos
--   del estudiante, o usamos en la tabla directamente esos datos¿?

DROP TABLE IF EXISTS `contratos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contratos` (
  `id_contrato` int(6) NOT NULL AUTO_INCREMENT,
--   `id_empresa` int(6) NOT NULL,
  `empresa` varchar(50) NOT NULL,
--   `id_estudiante` int(6) NOT NULL,
  `estudiante` int(6) NOT NULL,
  `puesto` varchar(60) CHARACTER SET latin1 NOT NULL,
  `fecha_inicio` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_fin` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `horas` int(4) NOT NULL,
  `salario` decimal(6,0) NOT NULL,
  `descripcion` longtext,
  `finalizado` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id_contrato`)

--  KEY `ofertas_empresas_id_usuario_fk` (`id_empresa`),
--  CONSTRAINT `ofertas_empresas_id_usuario_fk` FOREIGN KEY (`id_empresa`) REFERENCES `empresas` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE

--  KEY `demandas_estudiantes_id_usuario_fk` (`id_estudiante`),
--  CONSTRAINT `demandas_estudiantes_id_usuario_fk` FOREIGN KEY (`id_estudiante`) REFERENCES `estudiantes` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,

) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
