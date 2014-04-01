CREATE DATABASE  IF NOT EXISTS `dbProyectos` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `dbProyectos`;
-- MySQL dump 10.13  Distrib 5.6.12, for osx10.7 (x86_64)
--
-- Host: 127.0.0.1    Database: dbProyectos
-- ------------------------------------------------------
-- Server version	5.6.12

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
-- Table structure for table `Anexos`
--

DROP TABLE IF EXISTS `Anexos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Anexos` (
  `idAnexos` int(11) NOT NULL AUTO_INCREMENT,
  `nombreAnexo` varchar(45) DEFAULT NULL,
  `urlAnexo` varchar(45) DEFAULT NULL,
  `idTipoAnexo` int(11) DEFAULT NULL,
  `activo` binary(1) DEFAULT NULL,
  `fechaCreacion` datetime DEFAULT NULL,
  `idProyecto` int(11) DEFAULT NULL,
  `Anexoscol` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idAnexos`),
  KEY `fk_anexos_idx` (`idTipoAnexo`),
  KEY `fk_proyecto_idx` (`idProyecto`),
  CONSTRAINT `fk_anexos` FOREIGN KEY (`idTipoAnexo`) REFERENCES `tipoAdjunto` (`idtipoAdjunto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_proyecto` FOREIGN KEY (`idProyecto`) REFERENCES `Proyecto` (`idProyecto`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='define los anexos que estan alojados en google drive	';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Anexos`
--

LOCK TABLES `Anexos` WRITE;
/*!40000 ALTER TABLE `Anexos` DISABLE KEYS */;
/*!40000 ALTER TABLE `Anexos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Planificacion`
--

DROP TABLE IF EXISTS `Planificacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Planificacion` (
  `idPlanificacion` int(11) NOT NULL AUTO_INCREMENT,
  `idproyecto` int(11) NOT NULL,
  `mes1` varchar(11) DEFAULT NULL,
  `mes2` varchar(11) DEFAULT NULL,
  `mes3` varchar(11) DEFAULT NULL,
  `mes4` varchar(11) DEFAULT NULL,
  `estadoMes1` int(11) DEFAULT NULL,
  `estadoMes2` int(11) DEFAULT NULL,
  `estadoMes3` int(11) DEFAULT NULL,
  `estadoMes4` int(11) DEFAULT NULL,
  `fechacreacion` datetime DEFAULT NULL,
  `activo` int(11) DEFAULT NULL,
  PRIMARY KEY (`idPlanificacion`,`idproyecto`),
  KEY `fk_mes3_idx` (`estadoMes3`),
  KEY `fk_mes4_idx` (`estadoMes4`),
  KEY `fk_mes2_idx` (`estadoMes2`),
  KEY `fk_mes1_idx` (`estadoMes1`),
  CONSTRAINT `fk_mes1` FOREIGN KEY (`estadoMes1`) REFERENCES `etapaProyecto` (`idetapaProyecto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_mes2` FOREIGN KEY (`estadoMes2`) REFERENCES `etapaProyecto` (`idetapaProyecto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_mes3` FOREIGN KEY (`estadoMes3`) REFERENCES `etapaProyecto` (`idetapaProyecto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_mes4` FOREIGN KEY (`estadoMes4`) REFERENCES `etapaProyecto` (`idetapaProyecto`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Planificacion`
--

LOCK TABLES `Planificacion` WRITE;
/*!40000 ALTER TABLE `Planificacion` DISABLE KEYS */;
INSERT INTO `Planificacion` VALUES (1,1,'MARZO','ABRIL','MAYO','JUNIO',2,3,4,5,NULL,0),(2,2,'MARZO','ABRIL','MAYO','JUNIO',2,3,4,4,NULL,1),(3,6,'MARZO','ABRIL','MAYO','JUNIO',2,2,3,4,'2014-03-28 16:33:08',0),(4,1,'MARZO','ABRIL','MAYO','JUNIO',1,2,3,4,'2014-03-29 20:30:36',0),(5,14,'MARZO','ABRIL','MAYO','JUNIO',1,3,4,5,'2014-03-31 10:47:30',1),(6,6,'MARZO','ABRIL','MAYO','JUNIO',1,2,3,4,'2014-03-31 12:55:49',1),(7,1,'MARZO','ABRIL','MAYO','JUNIO',3,3,4,4,'2014-03-31 13:09:51',1),(8,16,'MARZO','ABRIL','MAYO','JUNIO',NULL,3,3,5,'2014-03-31 00:00:00',0),(9,16,'MARZO','ABRIL','MAYO','JUNIO',3,4,4,5,'2014-03-31 00:00:00',0),(10,20,'MARZO','ABRIL','MAYO','JUNIO',2,2,3,4,'2014-03-31 00:00:00',1),(11,16,'MARZO','ABRIL','MAYO','JUNIO',NULL,NULL,NULL,NULL,'2014-03-31 00:00:00',1);
/*!40000 ALTER TABLE `Planificacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Proyecto`
--

DROP TABLE IF EXISTS `Proyecto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Proyecto` (
  `idProyecto` int(11) NOT NULL AUTO_INCREMENT,
  `nombreProyecto` varchar(45) DEFAULT NULL,
  `descripcionProyecto` varchar(255) DEFAULT NULL,
  `jefeProyecto` varchar(45) DEFAULT NULL,
  `bpProyecto` varchar(45) DEFAULT NULL,
  `fechaSolicitud` date DEFAULT NULL,
  `fechaTermino` date DEFAULT NULL,
  `fechaRealTermino` date DEFAULT NULL,
  `nombreSolicitante` varchar(45) DEFAULT NULL,
  `idEmpresa` int(11) DEFAULT NULL,
  `financiadoPor` varchar(45) DEFAULT NULL,
  `idTipoProyecto` int(11) DEFAULT NULL,
  `areaCliente` varchar(45) DEFAULT NULL,
  `costoOneOff` int(11) DEFAULT NULL,
  `costoOnGoing` int(11) DEFAULT NULL,
  `beneficios` int(11) DEFAULT NULL,
  `idStatusProyecto` int(11) DEFAULT NULL,
  `idEtapaProyecto` int(11) DEFAULT NULL,
  `idSaludProyecto` int(11) DEFAULT NULL,
  `avance` int(11) DEFAULT NULL,
  `activo` int(11) DEFAULT NULL,
  `idTipoEstrategiaProyecto` int(11) DEFAULT NULL,
  `desviacionPresupuesto` int(11) DEFAULT NULL,
  `desviacionAlcance` int(11) DEFAULT NULL,
  `comentarioAlcance` varchar(255) DEFAULT NULL,
  `fechaUltimoAvance` date DEFAULT NULL,
  `desviacionTiempo` int(11) DEFAULT NULL,
  PRIMARY KEY (`idProyecto`),
  KEY `fk_status_idx` (`idStatusProyecto`),
  KEY `fk_etapa_idx` (`idEtapaProyecto`),
  KEY `fk_empresa_idx` (`idEmpresa`),
  KEY `fk_salud_idx` (`idSaludProyecto`),
  KEY `fk_estrategia_idx` (`idTipoEstrategiaProyecto`),
  CONSTRAINT `fk_empresa` FOREIGN KEY (`idEmpresa`) REFERENCES `empresas` (`idEmpresa`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_estrategia` FOREIGN KEY (`idTipoEstrategiaProyecto`) REFERENCES `estrategiaProyecto` (`idEstrategia`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_etapa` FOREIGN KEY (`idEtapaProyecto`) REFERENCES `etapaProyecto` (`idetapaProyecto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_salud` FOREIGN KEY (`idSaludProyecto`) REFERENCES `saludProyecto` (`idsaludProyecto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_status` FOREIGN KEY (`idStatusProyecto`) REFERENCES `statusProyecto` (`idstatusProyecto`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Proyecto`
--

LOCK TABLES `Proyecto` WRITE;
/*!40000 ALTER TABLE `Proyecto` DISABLE KEYS */;
INSERT INTO `Proyecto` VALUES (1,'Cambio Contrasena','Proyecto relacionado con la posibilidade de cambiar contraseña en windows','moises.bravo@rapazz.cl','moises.bravo@kcl.cl','2013-10-10','2014-03-31',NULL,'Gonzalo Salas',1,'KCC Sistema',1,'KCC Sistema',5700,0,1500,1,4,1,60,1,1,0,0,'9999l','2014-03-12',0),(2,'Sincronizacion Google','Sincroniza AD con GMAIL y con Telecom','moises.bravo@rapazz.cl','moises.bravo@rapazz.cl','2013-03-04','2014-03-31',NULL,'Carlos Rubio',1,'KCC Sistema',1,'KCC Sistema',15000,5600,45000,1,3,2,90,1,2,0,20,NULL,'2014-03-18',4),(3,'Listas de Distribucion','Listas ','moises.bravo@rapaz.cl','moises.bravo@rapazz.cl','2313-01-02','2014-05-09',NULL,'Macarena Cue',1,'KCC Sistema',2,'KCC Sistema',18000,14000,45000,3,4,3,10,1,1,12,15,'no se que comentario','2014-03-24',14),(4,'Proyecto 3',NULL,NULL,'moises.bravo@rapazz.cl','2014-03-27','2014-03-30',NULL,'juan pablo callejas',2,'juan pablo callejas',1,'todas',2000,2300,NULL,1,3,3,NULL,NULL,1,0,NULL,NULL,NULL,NULL),(5,'Proyecto tintin','Ejemplo',NULL,'moises.bravo@rapazz.cl','2013-04-23','2014-05-16',NULL,'Moises',1,'KCC',2,'SSS',1200,1300,1400,1,1,1,0,NULL,1,0,0,'0',NULL,0),(6,'Proyecto 5','RESUMEN EJECUTIVO','moises.bravo@rapazz.cl','moises.bravo@rapazz.cl','2014-03-20','2014-03-26',NULL,NULL,1,'NO LO SE',2,'SS',1200,4300,12000,1,4,1,12,NULL,2,12,18,'el proyecto se encuentra retrasado',NULL,14),(7,NULL,NULL,'moises.bravo@rapazz.cl',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,0,NULL,NULL,0,0,'0',NULL,0),(8,NULL,NULL,'moises.bravo@rapazz.cl',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,0,NULL,NULL,0,0,'0',NULL,0),(9,NULL,NULL,'moises.bravo@rapazz.cl',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,0,NULL,NULL,0,0,'0',NULL,0),(10,NULL,NULL,'moises.bravo@rapazz.cl',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,0,NULL,NULL,0,0,'0',NULL,0),(11,NULL,NULL,'moises.bravo@rapazz.cl',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,0,NULL,NULL,0,0,'0',NULL,0),(12,NULL,NULL,'moises.bravo@rapazz.cl',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,0,NULL,NULL,0,0,'0',NULL,0),(13,'Proyecto Gestion de Proyecto','Este es el resumen del proyecto','moises.bravo@rapazz.cl','juanpablo.callejas@kcl.cl','2013-12-23','2014-04-21',NULL,'Moises Bravo',1,'Moises bravo',1,'DCC',1500000,0,0,1,2,1,0,1,1,0,0,'0',NULL,0),(14,'Proyecto Minusvalido 1','AAAAA!!!','rodrigo.montes@kcl.cl','juanpablo.callejas@kcl.cl','2014-03-31','2014-04-01',NULL,'Moises Bravo',1,'Nadien',3,'IT',10000,100,50,1,1,2,0,1,1,0,0,'0',NULL,0),(15,'proyecto 8','esto es el comentario','moises.bravo@rapazz.cl',NULL,'2013-11-23','2013-12-23',NULL,'yo',1,'yo',1,'8',10,110,21230,1,2,2,0,NULL,NULL,0,0,'0',NULL,0),(16,'Proyecto de Prueba JPC','Resumen Ejecutivo del Proyecto','juanpablo.callejas@kcl.cl','juanpablo.callejas','2014-03-31','2014-09-30',NULL,'Raul Vasquez',1,'IT',1,'IT',1000,12000,5000000,1,3,2,10,1,1,20,10,'Comentario 1',NULL,30),(17,'Proyecto de Prueba JPC 2','Desarrollar Monitor para venta de equipos usados de Komatsu Arrienda','juanpablo.callejas@kcl.cl',NULL,'2014-04-23','2014-12-31',NULL,'Monitor de Equipos Usarios',4,'KCCA',1,'Ventas',12000,230,1200000,1,4,3,50,NULL,1,20,10,'Comentarios de Prueba',NULL,10),(18,'proyecto 7','hkhkjhjkhk','moises.bravo@rapazz.cl',NULL,'2013-11-23','2014-11-20',NULL,'yo',2,'no lo se',3,'uuu',150,118,200,1,2,2,0,NULL,1,0,0,'0',NULL,0),(19,'proyecto 11','jkljklj','moises.bravo@rapazz.cl','moises.bravo@rapazz.cl','2014-03-14','2014-05-14',NULL,'no lo se',2,'no lo se',1,'todas',1200,1200,12000,1,2,2,0,NULL,1,0,0,'0',NULL,0),(20,'Proyecto de Prueba JPC','CRM','juanpablo.callejas@kcl.cl','juanpablo.callejas@kcl.cl','2014-03-31','2014-10-31',NULL,'Alvari Pizarro',2,'DCC',2,'Ventas',1200,120,12000000,1,2,2,20,NULL,1,200000,20,'ccqcac',NULL,10);
/*!40000 ALTER TABLE `Proyecto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empresas`
--

DROP TABLE IF EXISTS `empresas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empresas` (
  `idEmpresa` int(11) NOT NULL AUTO_INCREMENT,
  `nombreEmpresa` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idEmpresa`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empresas`
--

LOCK TABLES `empresas` WRITE;
/*!40000 ALTER TABLE `empresas` DISABLE KEYS */;
INSERT INTO `empresas` VALUES (1,'KCC'),(2,'DCC'),(3,'KRCC'),(4,'KCCA'),(5,'KHSA'),(6,'KCH');
/*!40000 ALTER TABLE `empresas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estrategiaProyecto`
--

DROP TABLE IF EXISTS `estrategiaProyecto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estrategiaProyecto` (
  `idEstrategia` int(11) NOT NULL,
  `estrategiaProyecto` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idEstrategia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estrategiaProyecto`
--

LOCK TABLES `estrategiaProyecto` WRITE;
/*!40000 ALTER TABLE `estrategiaProyecto` DISABLE KEYS */;
INSERT INTO `estrategiaProyecto` VALUES (1,'Operacional'),(2,'Estrategico'),(3,'Innovacion');
/*!40000 ALTER TABLE `estrategiaProyecto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `etapaProyecto`
--

DROP TABLE IF EXISTS `etapaProyecto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `etapaProyecto` (
  `idetapaProyecto` int(11) NOT NULL AUTO_INCREMENT,
  `etapaProyecto` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idetapaProyecto`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='Marca las etapa del proyecto actual';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `etapaProyecto`
--

LOCK TABLES `etapaProyecto` WRITE;
/*!40000 ALTER TABLE `etapaProyecto` DISABLE KEYS */;
INSERT INTO `etapaProyecto` VALUES (1,'Iniciativa'),(2,'Pre-Evaluacion'),(3,'Evaluacion'),(4,'Ejecucion'),(5,'En produccion');
/*!40000 ALTER TABLE `etapaProyecto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `historialProyecto`
--

DROP TABLE IF EXISTS `historialProyecto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `historialProyecto` (
  `idhistorial` int(11) NOT NULL AUTO_INCREMENT,
  `idProyecto` int(11) NOT NULL,
  `fechaCreacion` datetime DEFAULT NULL,
  `avance` int(11) DEFAULT NULL,
  `comentario` text,
  `idSaludProyecto` int(11) DEFAULT NULL,
  `idEtapaProyecto` int(11) DEFAULT NULL,
  `idStatusProyecto` int(11) DEFAULT NULL,
  `desviacionPresupuesto` int(11) DEFAULT NULL,
  `desviacionAlcance` int(11) DEFAULT NULL,
  `desviacionTiempo` int(11) DEFAULT NULL,
  PRIMARY KEY (`idhistorial`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historialProyecto`
--

LOCK TABLES `historialProyecto` WRITE;
/*!40000 ALTER TABLE `historialProyecto` DISABLE KEYS */;
INSERT INTO `historialProyecto` VALUES (1,2,'2014-03-26 11:32:31',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2,2,'2014-03-26 11:33:15',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,2,'2014-03-26 11:35:53',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,2,'2014-03-26 11:36:32',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(5,2,'2014-03-26 11:36:45',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(6,2,'2014-03-26 11:37:04',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(7,2,'2014-03-26 11:38:32',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(8,3,'2014-03-26 11:39:36',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(9,2,'2014-03-26 11:48:22',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(10,1,'2014-03-26 11:50:33',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(11,2,'2014-03-26 11:59:15',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(12,3,'2014-03-26 12:02:21',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(13,1,'2014-03-26 12:06:26',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(14,3,'2014-03-26 12:07:07',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(15,2,'2014-03-26 12:10:06',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(16,3,'2014-03-26 12:13:51',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(17,1,'2014-03-26 15:09:21',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(18,1,'2014-03-26 16:06:54',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(19,3,'2014-03-26 16:08:29',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(20,2,'2014-03-26 16:10:52',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(21,2,'2014-03-26 16:11:36',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(22,2,'2014-03-26 16:29:14',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(23,2,'2014-03-26 16:38:09',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(24,2,'2014-03-26 16:44:02',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(25,2,'2014-03-26 16:44:17',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(26,2,'2014-03-26 16:48:21',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(27,3,'2014-03-26 16:48:38',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(28,2,'2014-03-26 16:58:35',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(29,3,'2014-03-26 16:58:54',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(30,2,'2014-03-26 17:11:57',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(31,3,'2014-03-26 17:13:25',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(32,2,'2014-03-26 17:29:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(33,1,'2014-03-26 18:59:06',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(34,2,'2014-03-26 19:51:33',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(35,2,'2014-03-26 19:52:22',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(36,2,'2014-03-26 19:53:32',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(37,2,'2014-03-26 19:53:54',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(38,2,'2014-03-26 19:54:08',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(39,2,'2014-03-26 20:01:01',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(40,2,'2014-03-26 20:01:23',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(41,2,'2014-03-26 20:41:05',NULL,'comentario',NULL,NULL,NULL,NULL,NULL,NULL),(42,1,'2014-03-26 21:42:43',10,'Comentario 33',1,1,NULL,4,12,8),(43,1,'2014-03-26 21:45:51',54,'esto es un comentario',3,4,3,2,6,4),(44,1,'2014-03-26 22:08:38',10,'no se',3,4,4,12,12,12),(45,3,'2014-03-26 22:16:00',7,'esto es 7',3,4,2,87,6,67),(46,2,'2014-03-26 22:46:04',2,'333',2,3,4,4,22,44),(47,1,'2014-03-26 23:00:31',0,'9999l',NULL,NULL,NULL,NULL,NULL,NULL),(48,1,'2014-03-26 23:02:12',0,'9999l',NULL,NULL,NULL,NULL,NULL,NULL),(49,1,'2014-03-26 23:06:50',0,'9999l',NULL,NULL,NULL,NULL,NULL,NULL),(50,1,'2014-03-26 23:08:18',0,'9999l',NULL,NULL,NULL,NULL,NULL,NULL),(51,1,'2014-03-26 23:10:23',0,'9999l',NULL,NULL,NULL,NULL,NULL,NULL),(52,1,'2014-03-26 23:10:55',0,'9999l',NULL,NULL,NULL,NULL,NULL,NULL),(53,3,'2014-03-26 23:12:47',10,'no se que comentario',3,4,3,12,15,14),(54,3,'2014-03-26 23:13:47',10,'no se que comentario',3,4,3,12,15,14),(55,3,'2014-03-26 23:15:39',10,'no se que comentario',3,4,3,12,15,14),(56,6,'2014-03-30 22:44:55',12,'el proyecto se encuentra retrasado',1,4,1,12,18,14),(57,16,'2014-03-31 16:05:33',10,'Comentario 1',2,2,1,20,10,30),(58,16,'2014-03-31 16:15:18',10,'Comentario 1',2,3,1,20,10,30),(59,17,'2014-03-31 16:23:59',50,'Comentarios de Prueba',3,4,1,20,10,10),(60,20,'2014-03-31 16:37:59',20,'ccqcac',2,2,1,200000,20,10),(61,16,'2014-03-31 16:45:00',10,'Comentario 1',2,3,1,20,10,30);
/*!40000 ALTER TABLE `historialProyecto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `saludProyecto`
--

DROP TABLE IF EXISTS `saludProyecto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `saludProyecto` (
  `idsaludProyecto` int(11) NOT NULL AUTO_INCREMENT,
  `saludProyecto` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idsaludProyecto`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `saludProyecto`
--

LOCK TABLES `saludProyecto` WRITE;
/*!40000 ALTER TABLE `saludProyecto` DISABLE KEYS */;
INSERT INTO `saludProyecto` VALUES (1,'Saludable'),(2,'En alerta'),(3,'Critico');
/*!40000 ALTER TABLE `saludProyecto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessionUsers`
--

DROP TABLE IF EXISTS `sessionUsers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessionUsers` (
  `idsessionUsers` int(11) NOT NULL AUTO_INCREMENT,
  `idUsers` varchar(45) DEFAULT NULL,
  `idSession` varchar(45) DEFAULT NULL,
  `fechaInicio` datetime DEFAULT NULL,
  `fechaFin` datetime DEFAULT NULL,
  `activo` bit(1) DEFAULT NULL,
  PRIMARY KEY (`idsessionUsers`),
  KEY `fk_users_idx` (`idUsers`),
  CONSTRAINT `fk_users` FOREIGN KEY (`idUsers`) REFERENCES `users` (`idUsers`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessionUsers`
--

LOCK TABLES `sessionUsers` WRITE;
/*!40000 ALTER TABLE `sessionUsers` DISABLE KEYS */;
/*!40000 ALTER TABLE `sessionUsers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `statusProyecto`
--

DROP TABLE IF EXISTS `statusProyecto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `statusProyecto` (
  `idstatusProyecto` int(11) NOT NULL AUTO_INCREMENT,
  `statusProyecto` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idstatusProyecto`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='si el proyecto esta en ejecucion detenido etc';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `statusProyecto`
--

LOCK TABLES `statusProyecto` WRITE;
/*!40000 ALTER TABLE `statusProyecto` DISABLE KEYS */;
INSERT INTO `statusProyecto` VALUES (1,'Activo'),(2,'Terminado'),(3,'Cancelado'),(4,'Postergado');
/*!40000 ALTER TABLE `statusProyecto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipoAdjunto`
--

DROP TABLE IF EXISTS `tipoAdjunto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipoAdjunto` (
  `idtipoAdjunto` int(11) NOT NULL AUTO_INCREMENT,
  `tipoAdjunto` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idtipoAdjunto`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='tabla que especifica el tipo de adjuntos.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipoAdjunto`
--

LOCK TABLES `tipoAdjunto` WRITE;
/*!40000 ALTER TABLE `tipoAdjunto` DISABLE KEYS */;
INSERT INTO `tipoAdjunto` VALUES (1,'Gantt'),(2,'Cotizacion'),(3,'Documento Inicio'),(4,'Documento Solicitud'),(5,'Plan de Pruebas'),(6,'CAB Sistemas'),(7,'Otro');
/*!40000 ALTER TABLE `tipoAdjunto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `idUsers` varchar(45) NOT NULL,
  `rol` varchar(45) DEFAULT NULL,
  `estado` varchar(45) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `bP` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idUsers`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('hhh@rapazz.cl','JP','1',NULL),('juanpablo.callejas@kcl.cl','JP','1','juanpablo.callejas@kcl.cl'),('moises.bravo@rapazz.cl','JP','1','juanpablo.calljeas@klcl.cl'),('rodrigo.montes@kcl.cl','JP','1','juanpablo.callejas@kcl.cl');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-04-01 14:49:22
