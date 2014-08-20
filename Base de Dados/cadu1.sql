-- MySQL dump 10.13  Distrib 5.1.37, for debian-linux-gnu (i486)
--
-- Host: localhost    Database: 
-- ------------------------------------------------------
-- Server version	5.1.37-1ubuntu5.1

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
-- Current Database: `ACESSOS`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `ACESSOS` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `ACESSOS`;

--
-- Table structure for table `ARQ_SISTEMAS`
--

DROP TABLE IF EXISTS `ARQ_SISTEMAS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ARQ_SISTEMAS` (
  `ID_ROTINA` int(11) NOT NULL,
  `ID_ARQUIVO` varchar(50) NOT NULL,
  PRIMARY KEY (`ID_ARQUIVO`,`ID_ROTINA`),
  KEY `FK_ARQ_SISTEMAS_1` (`ID_ROTINA`),
  CONSTRAINT `FK_ARQ_SISTEMAS_1` FOREIGN KEY (`ID_ROTINA`) REFERENCES `ROTINAS` (`ID_ROTINA`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ARQ_SISTEMAS`
--

LOCK TABLES `ARQ_SISTEMAS` WRITE;
/*!40000 ALTER TABLE `ARQ_SISTEMAS` DISABLE KEYS */;
/*!40000 ALTER TABLE `ARQ_SISTEMAS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CIDADES_GBM`
--

DROP TABLE IF EXISTS `CIDADES_GBM`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CIDADES_GBM` (
  `ID_CIDADE` int(11) NOT NULL,
  `ID_BATALHAO` int(11) NOT NULL,
  `ID_COMPANIA` int(11) NOT NULL,
  `ID_PELOTAO` int(11) NOT NULL,
  `ID_GRUPAMENTO` int(11) NOT NULL,
  PRIMARY KEY (`ID_CIDADE`,`ID_BATALHAO`,`ID_COMPANIA`,`ID_PELOTAO`,`ID_GRUPAMENTO`),
  KEY `FK_CIDADES_GBM_1` (`ID_GRUPAMENTO`,`ID_BATALHAO`,`ID_COMPANIA`,`ID_PELOTAO`),
  CONSTRAINT `FK_CIDADES_GBM_1` FOREIGN KEY (`ID_GRUPAMENTO`, `ID_BATALHAO`, `ID_COMPANIA`, `ID_PELOTAO`) REFERENCES `CADASTROS`.`GRUPAMENTO` (`ID_GRUPAMENTO`, `ID_BATALHAO`, `ID_COMPANIA`, `ID_PELOTAO`),
  CONSTRAINT `FK_CIDADES_GBM_2` FOREIGN KEY (`ID_CIDADE`) REFERENCES `CADASTROS`.`CIDADE` (`ID_CIDADE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CIDADES_GBM`
--

LOCK TABLES `CIDADES_GBM` WRITE;
/*!40000 ALTER TABLE `CIDADES_GBM` DISABLE KEYS */;
INSERT INTO `CIDADES_GBM` VALUES (8105,1,1,1,1);
/*!40000 ALTER TABLE `CIDADES_GBM` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CIDADES_USR`
--

DROP TABLE IF EXISTS `CIDADES_USR`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CIDADES_USR` (
  `ID_CIDADE` int(11) NOT NULL,
  `ID_USUARIO` varchar(20) NOT NULL,
  PRIMARY KEY (`ID_CIDADE`,`ID_USUARIO`),
  KEY `FK_CIDADES_USR_2` (`ID_USUARIO`),
  CONSTRAINT `FK_CIDADES_USR_1` FOREIGN KEY (`ID_CIDADE`) REFERENCES `CADASTROS`.`CIDADE` (`ID_CIDADE`),
  CONSTRAINT `FK_CIDADES_USR_2` FOREIGN KEY (`ID_USUARIO`) REFERENCES `USUARIO` (`ID_USUARIO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CIDADES_USR`
--

LOCK TABLES `CIDADES_USR` WRITE;
/*!40000 ALTER TABLE `CIDADES_USR` DISABLE KEYS */;
INSERT INTO `CIDADES_USR` VALUES (8105,'carlos');
/*!40000 ALTER TABLE `CIDADES_USR` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `MODULOS`
--

DROP TABLE IF EXISTS `MODULOS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `MODULOS` (
  `ID_MODULO` int(11) NOT NULL AUTO_INCREMENT,
  `NM_MODULO` varchar(50) NOT NULL,
  `NM_DIR_MODULO` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID_MODULO`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MODULOS`
--

LOCK TABLES `MODULOS` WRITE;
/*!40000 ALTER TABLE `MODULOS` DISABLE KEYS */;
INSERT INTO `MODULOS` VALUES (1,'ACESSSOS','../acessos'),(6,'SOLICITAÇÕES','../solicitacoes'),(8,'PROTOCOLO','../protocolo'),(9,'ANÁLISE','../analise'),(10,'EDIFICACAO','../edificacoes'),(11,'FINANCEIRO','../financeiro'),(12,'CADASTROS','../cadastros'),(13,'HABITE-SE','../habitese'),(14,'FUNCIONAMENTO','../funcionamento'),(15,'MANUTENÇÃO','../manutencao'),(16,'GERENCIAL','../gerencial'),(17,'MISCELÂNEA','../misc');
/*!40000 ALTER TABLE `MODULOS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PERFILAMENTO_ACESSO`
--

DROP TABLE IF EXISTS `PERFILAMENTO_ACESSO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PERFILAMENTO_ACESSO` (
  `ID_ROTINA` int(11) NOT NULL,
  `ID_PERFIL` int(11) NOT NULL,
  `CH_CONSULTA` enum('N','S') NOT NULL DEFAULT 'N',
  `CH_INCLUSAO` enum('N','S') NOT NULL DEFAULT 'N',
  `CH_ALTERACAO` enum('N','S') NOT NULL DEFAULT 'N',
  `CH_EXCLUSAO` enum('N','S') NOT NULL DEFAULT 'N',
  PRIMARY KEY (`ID_ROTINA`,`ID_PERFIL`),
  KEY `ID_PERFIL` (`ID_PERFIL`),
  KEY `CH_CONSULTA` (`CH_CONSULTA`),
  KEY `CH_INCLUSAO` (`CH_INCLUSAO`),
  KEY `CH_ALTERACAO` (`CH_ALTERACAO`),
  KEY `CH_EXCLUSAO` (`CH_EXCLUSAO`),
  CONSTRAINT `PERFILAMENTO_ACESSO_ibfk_1` FOREIGN KEY (`ID_ROTINA`) REFERENCES `ROTINAS` (`ID_ROTINA`) ON UPDATE CASCADE,
  CONSTRAINT `PERFILAMENTO_ACESSO_ibfk_2` FOREIGN KEY (`ID_PERFIL`) REFERENCES `PERFIS` (`ID_PERFIL`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PERFILAMENTO_ACESSO`
--

LOCK TABLES `PERFILAMENTO_ACESSO` WRITE;
/*!40000 ALTER TABLE `PERFILAMENTO_ACESSO` DISABLE KEYS */;
INSERT INTO `PERFILAMENTO_ACESSO` VALUES (1,1,'S','S','S','S'),(1,2,'N','N','N','N'),(1,3,'N','N','N','N'),(1,4,'N','N','N','N'),(1,5,'S','S','S','S'),(2,1,'S','S','S','S'),(2,2,'N','N','N','N'),(2,3,'N','N','N','N'),(2,4,'N','N','N','N'),(2,5,'N','N','N','N'),(3,1,'S','S','S','S'),(3,2,'N','N','N','N'),(3,3,'N','N','N','N'),(3,4,'N','N','N','N'),(3,5,'N','N','N','N'),(4,1,'S','S','S','S'),(4,2,'N','N','N','N'),(4,3,'N','N','N','N'),(4,4,'S','S','S','S'),(4,5,'N','N','N','N'),(5,1,'S','S','S','S'),(5,2,'S','S','S','S'),(5,3,'S','S','S','S'),(5,4,'S','S','S','S'),(5,5,'S','S','S','S'),(6,1,'S','S','S','S'),(6,2,'S','S','S','S'),(6,3,'S','S','S','S'),(6,4,'S','S','S','S'),(6,5,'S','S','S','S'),(7,1,'S','S','S','S'),(7,2,'N','N','N','N'),(7,3,'N','N','N','N'),(7,4,'N','N','N','N'),(7,5,'N','N','N','N'),(8,1,'S','S','S','S'),(8,2,'S','S','S','S'),(8,3,'S','S','S','S'),(8,4,'S','S','S','S'),(8,5,'S','S','S','S'),(9,1,'S','S','S','S'),(9,2,'S','S','S','S'),(9,3,'S','S','S','S'),(9,4,'S','S','S','S'),(9,5,'S','S','S','S'),(10,1,'S','S','S','S'),(10,2,'S','S','S','S'),(10,3,'S','S','S','S'),(10,4,'S','S','S','S'),(10,5,'S','S','S','S'),(11,1,'S','S','S','S'),(11,2,'S','S','S','S'),(11,3,'S','S','S','S'),(11,4,'S','S','S','S'),(11,5,'S','S','S','S'),(12,1,'S','S','S','S'),(12,2,'S','S','S','S'),(12,3,'S','S','S','S'),(12,4,'S','S','S','S'),(12,5,'S','S','S','S'),(13,1,'S','S','S','S'),(13,2,'S','S','S','S'),(13,3,'S','S','S','S'),(13,4,'S','S','S','S'),(13,5,'S','S','S','S'),(14,1,'S','S','S','S'),(14,2,'S','S','S','S'),(14,3,'S','S','S','S'),(14,4,'S','S','S','S'),(14,5,'S','S','S','S'),(15,1,'S','S','S','S'),(15,2,'N','N','N','N'),(15,3,'N','N','N','N'),(15,4,'N','N','N','N'),(15,5,'S','S','S','S'),(16,1,'S','S','S','S'),(16,2,'N','N','N','N'),(16,3,'N','N','N','N'),(16,4,'N','N','N','N'),(16,5,'S','S','S','S'),(17,1,'S','S','S','S'),(17,2,'S','S','S','S'),(17,3,'N','N','N','N'),(17,4,'N','N','N','N'),(17,5,'S','S','S','S'),(18,1,'S','S','S','S'),(18,2,'S','S','S','S'),(18,3,'N','N','N','N'),(18,4,'N','N','N','N'),(18,5,'S','S','S','S'),(19,1,'S','S','S','S'),(19,2,'S','S','S','S'),(19,3,'N','N','N','N'),(19,4,'N','N','N','N'),(19,5,'S','S','S','S'),(20,1,'S','S','S','S'),(20,2,'S','S','S','S'),(20,3,'N','N','N','N'),(20,4,'N','N','N','N'),(20,5,'S','S','S','S'),(21,1,'S','S','S','S'),(21,2,'S','S','S','S'),(21,3,'N','N','N','N'),(21,4,'N','N','N','N'),(21,5,'S','S','S','S'),(22,1,'S','S','S','S'),(22,2,'S','S','S','S'),(22,3,'S','S','S','S'),(22,4,'S','S','S','S'),(22,5,'S','S','S','S'),(23,1,'S','S','S','S'),(23,2,'S','S','S','S'),(23,3,'S','S','S','S'),(23,4,'N','N','N','N'),(23,5,'S','S','S','S'),(24,1,'S','S','S','S'),(24,2,'S','S','S','S'),(24,3,'S','S','S','S'),(24,4,'N','N','N','N'),(24,5,'S','S','S','S'),(25,1,'S','S','S','S'),(25,2,'S','S','S','S'),(25,3,'S','S','S','S'),(25,4,'S','S','S','S'),(25,5,'S','S','S','S'),(26,1,'S','S','S','S'),(26,2,'S','S','S','S'),(26,3,'S','S','S','S'),(26,4,'S','S','S','S'),(26,5,'S','S','S','S'),(27,1,'S','S','S','S'),(27,2,'S','S','S','S'),(27,3,'S','S','S','S'),(27,4,'S','S','S','S'),(27,5,'S','S','S','S'),(28,1,'S','S','S','S'),(28,2,'S','S','S','S'),(28,3,'S','S','S','S'),(28,4,'S','S','S','S'),(28,5,'S','S','S','S'),(29,1,'S','S','S','S'),(29,2,'S','S','S','S'),(29,3,'S','S','S','S'),(29,4,'S','S','S','S'),(29,5,'S','S','S','S'),(30,1,'S','S','S','S'),(30,2,'S','S','S','S'),(30,3,'S','S','S','S'),(30,4,'S','S','S','S'),(30,5,'S','S','S','S'),(31,1,'S','S','S','S'),(31,2,'S','S','S','S'),(31,3,'S','S','S','S'),(31,4,'S','S','S','S'),(31,5,'S','S','S','S'),(32,1,'S','S','S','S'),(32,2,'S','S','S','S'),(32,3,'S','S','S','S'),(32,4,'S','S','S','S'),(32,5,'S','S','S','S'),(33,1,'S','S','S','S'),(33,2,'S','S','S','S'),(33,3,'S','S','S','S'),(33,4,'S','S','S','S'),(33,5,'S','S','S','S'),(34,1,'S','S','S','S'),(34,2,'S','S','S','S'),(34,3,'S','S','S','S'),(34,4,'S','S','S','S'),(34,5,'S','S','S','S'),(35,1,'S','S','S','S'),(35,2,'S','S','S','S'),(35,3,'S','S','S','S'),(35,4,'S','S','S','S'),(35,5,'S','S','S','S'),(36,1,'S','S','S','S'),(36,2,'S','S','S','S'),(36,3,'S','S','S','S'),(36,4,'S','S','S','S'),(36,5,'S','S','S','S'),(37,1,'S','S','S','S'),(37,2,'S','S','S','S'),(37,3,'S','S','S','S'),(37,4,'S','S','S','S'),(37,5,'S','S','S','S'),(38,1,'S','S','S','S'),(38,2,'S','S','S','S'),(38,3,'S','S','S','S'),(38,4,'S','S','S','S'),(38,5,'S','S','S','S'),(39,1,'S','S','S','S'),(39,2,'S','S','S','S'),(39,3,'S','S','S','S'),(39,4,'S','S','S','S'),(39,5,'S','S','S','S'),(40,1,'S','S','S','S'),(40,2,'S','S','S','S'),(40,3,'S','S','S','S'),(40,4,'S','S','S','S'),(40,5,'S','S','S','S'),(41,1,'S','S','S','S'),(41,2,'S','S','S','S'),(41,3,'S','S','S','S'),(41,4,'S','S','S','S'),(41,5,'S','S','S','S'),(42,1,'S','S','S','S'),(42,2,'S','S','S','S'),(42,3,'S','S','S','S'),(42,4,'S','S','S','S'),(42,5,'S','S','S','S'),(43,1,'S','S','S','S'),(43,2,'S','S','S','S'),(43,3,'S','S','S','S'),(43,4,'S','S','S','S'),(43,5,'S','S','S','S'),(44,1,'S','S','S','S'),(44,2,'S','S','S','S'),(44,3,'S','S','S','S'),(44,4,'S','S','S','S'),(44,5,'S','S','S','S'),(45,1,'S','S','S','S'),(45,2,'S','S','S','S'),(45,3,'N','N','N','N'),(45,4,'N','N','N','N'),(45,5,'S','S','S','S'),(46,1,'S','S','S','S'),(46,2,'S','S','S','S'),(46,3,'S','S','S','S'),(46,4,'S','S','S','S'),(46,5,'S','S','S','S'),(47,1,'S','S','S','S'),(47,2,'S','S','S','S'),(47,3,'S','S','S','S'),(47,4,'S','S','S','S'),(47,5,'S','S','S','S'),(48,1,'S','S','S','S'),(48,2,'S','S','S','S'),(48,3,'S','S','S','S'),(48,4,'S','S','S','S'),(48,5,'S','S','S','S'),(49,1,'S','S','S','S'),(49,2,'S','S','S','S'),(49,3,'S','S','S','S'),(49,4,'S','S','S','S'),(49,5,'S','S','S','S'),(50,1,'S','S','S','S'),(50,2,'S','S','S','S'),(50,3,'S','S','S','S'),(50,4,'S','S','S','S'),(50,5,'S','S','S','S'),(51,1,'S','S','S','S'),(51,2,'S','S','S','S'),(51,3,'S','S','S','S'),(51,4,'S','S','S','S'),(51,5,'S','S','S','S'),(52,1,'S','S','S','S'),(52,2,'S','S','S','S'),(52,3,'S','S','S','S'),(52,4,'S','S','S','S'),(52,5,'S','S','S','S'),(53,1,'S','S','S','S'),(53,2,'S','S','S','S'),(53,3,'S','S','S','S'),(53,4,'S','S','S','S'),(53,5,'S','S','S','S'),(54,1,'S','S','S','S'),(54,2,'S','S','S','S'),(54,3,'S','S','S','S'),(54,4,'S','S','S','S'),(54,5,'S','S','S','S'),(55,1,'S','S','S','S'),(55,2,'S','S','S','S'),(55,3,'S','S','S','S'),(55,4,'S','S','S','S'),(55,5,'S','S','S','S'),(56,1,'S','S','S','S'),(56,2,'S','S','S','S'),(56,3,'S','S','S','S'),(56,4,'S','S','S','S'),(56,5,'S','S','S','S'),(57,1,'S','S','S','S'),(57,2,'S','S','S','S'),(57,3,'S','S','S','S'),(57,4,'S','S','S','S'),(57,5,'S','S','S','S'),(58,1,'S','S','S','S'),(58,2,'S','S','S','S'),(58,3,'S','S','S','S'),(58,4,'S','S','S','S'),(58,5,'S','S','S','S'),(59,1,'S','S','S','S'),(59,2,'S','S','S','S'),(59,3,'S','S','S','S'),(59,4,'S','S','S','S'),(59,5,'S','S','S','S'),(60,1,'S','S','S','S'),(60,2,'S','S','S','S'),(60,3,'S','S','S','S'),(60,4,'S','S','S','S'),(60,5,'S','S','S','S'),(61,1,'S','S','S','S'),(61,2,'S','S','S','S'),(61,3,'S','S','S','S'),(61,4,'S','S','S','S'),(61,5,'S','S','S','S'),(62,1,'S','S','S','S'),(62,2,'S','S','S','S'),(62,3,'S','S','S','S'),(62,4,'S','S','S','S'),(62,5,'S','S','S','S'),(63,1,'S','S','S','S'),(63,2,'S','S','S','S'),(63,3,'S','S','S','S'),(63,4,'S','S','S','S'),(63,5,'S','S','S','S'),(64,1,'S','S','S','S'),(64,2,'S','S','S','S'),(64,3,'S','S','S','S'),(64,4,'S','S','S','S'),(64,5,'S','S','S','S'),(65,1,'S','S','S','S'),(65,2,'S','S','S','S'),(65,3,'S','S','S','S'),(65,4,'S','S','S','S'),(65,5,'S','S','S','S'),(66,1,'S','S','S','S'),(66,2,'S','S','S','S'),(66,3,'S','S','S','S'),(66,4,'S','S','S','S'),(66,5,'S','S','S','S'),(67,1,'S','S','S','S'),(67,2,'S','S','S','S'),(67,3,'S','S','S','S'),(67,4,'S','S','S','S'),(67,5,'S','S','S','S'),(68,1,'S','S','S','S'),(68,2,'S','S','S','S'),(68,3,'S','S','S','S'),(68,4,'S','S','S','S'),(68,5,'S','S','S','S'),(69,1,'S','S','S','S'),(69,2,'S','S','S','S'),(69,3,'S','S','S','S'),(69,4,'S','S','S','S'),(69,5,'S','S','S','S'),(70,1,'S','S','S','S'),(70,2,'S','S','S','S'),(70,3,'S','S','S','S'),(70,4,'S','S','S','S'),(70,5,'S','S','S','S'),(71,1,'S','S','S','S'),(71,2,'S','S','S','S'),(71,3,'S','S','S','S'),(71,4,'S','S','S','S'),(71,5,'S','S','S','S'),(72,1,'S','S','S','S'),(72,2,'S','S','S','S'),(72,3,'S','S','S','S'),(72,4,'S','S','S','S'),(72,5,'S','S','S','S'),(73,1,'S','S','S','S'),(73,2,'S','S','S','S'),(73,3,'S','S','S','S'),(73,4,'S','S','S','S'),(73,5,'S','S','S','S'),(74,1,'S','S','S','S'),(74,2,'S','S','S','S'),(74,3,'S','S','S','S'),(74,4,'S','S','S','S'),(74,5,'S','S','S','S'),(75,1,'S','S','S','S'),(75,2,'S','S','S','S'),(75,3,'N','N','N','N'),(75,4,'S','S','S','S'),(75,5,'S','S','S','S'),(76,1,'S','S','S','S'),(76,2,'S','S','S','S'),(76,3,'N','N','N','N'),(76,4,'S','S','S','S'),(76,5,'S','S','S','S'),(77,1,'S','S','S','S'),(77,2,'S','S','S','S'),(77,3,'N','N','N','N'),(77,4,'S','S','S','S'),(77,5,'S','S','S','S'),(78,1,'S','S','S','S'),(78,2,'S','S','S','S'),(78,3,'N','N','N','N'),(78,4,'S','S','S','S'),(78,5,'S','S','S','S'),(79,1,'S','S','S','S'),(79,2,'S','S','S','S'),(79,3,'N','N','N','N'),(79,4,'N','N','N','N'),(79,5,'S','S','S','S'),(80,1,'S','S','S','S'),(80,2,'S','S','S','S'),(80,3,'N','N','N','N'),(80,4,'S','S','S','S'),(80,5,'S','S','S','S'),(81,1,'S','S','S','S'),(81,2,'S','S','S','S'),(81,3,'N','N','N','N'),(81,4,'S','S','S','S'),(81,5,'S','S','S','S'),(82,1,'S','S','S','S'),(82,2,'S','S','S','S'),(82,3,'N','N','N','N'),(82,4,'N','N','N','N'),(82,5,'S','S','S','S'),(83,1,'S','S','S','S'),(83,2,'S','S','S','S'),(83,3,'N','N','N','N'),(83,4,'N','N','N','N'),(83,5,'S','S','S','S'),(84,1,'S','S','S','S'),(84,2,'S','S','S','S'),(84,3,'N','N','N','N'),(84,4,'N','N','N','N'),(84,5,'S','S','S','S'),(85,1,'S','S','S','S'),(85,2,'N','N','N','N'),(85,3,'N','N','N','N'),(85,4,'N','N','N','N'),(85,5,'S','S','S','S'),(86,1,'S','S','S','S'),(86,2,'N','N','N','N'),(86,3,'N','N','N','N'),(86,4,'N','N','N','N'),(86,5,'S','S','S','S'),(87,1,'S','S','S','S'),(87,2,'N','N','N','N'),(87,3,'N','N','N','N'),(87,4,'N','N','N','N'),(87,5,'S','S','S','S'),(88,1,'S','S','S','S'),(88,2,'N','N','N','N'),(88,3,'N','N','N','N'),(88,4,'N','N','N','N'),(88,5,'S','S','S','S'),(89,1,'S','S','S','S'),(89,2,'N','N','N','N'),(89,3,'N','N','N','N'),(89,4,'N','N','N','N'),(89,5,'S','S','S','S'),(90,1,'S','S','S','S'),(90,2,'S','S','S','S'),(90,3,'N','N','N','N'),(90,4,'N','N','N','N'),(90,5,'S','S','S','S'),(91,1,'S','S','S','S'),(91,2,'N','N','N','N'),(91,3,'N','N','N','N'),(91,4,'N','N','N','N'),(91,5,'N','N','N','N'),(92,1,'S','S','S','S'),(92,2,'N','N','N','N'),(92,3,'N','N','N','N'),(92,4,'N','N','N','N'),(92,5,'S','S','S','S'),(93,1,'S','S','S','S'),(93,2,'N','N','N','N'),(93,3,'N','N','N','N'),(93,4,'N','N','N','N'),(93,5,'S','S','S','S'),(94,1,'S','S','S','S'),(94,2,'N','N','N','N'),(94,3,'N','N','N','N'),(94,4,'N','N','N','N'),(94,5,'S','S','S','S'),(95,1,'S','S','S','S'),(95,2,'N','N','N','N'),(95,3,'N','N','N','N'),(95,4,'N','N','N','N'),(95,5,'N','N','N','N'),(96,1,'S','S','S','S'),(96,2,'N','N','N','N'),(96,3,'N','N','N','N'),(96,4,'N','N','N','N'),(96,5,'S','S','S','S'),(97,1,'S','S','S','S'),(97,2,'S','S','S','S'),(97,3,'S','S','S','S'),(97,4,'S','S','S','S'),(97,5,'S','S','S','S'),(98,1,'S','S','S','S'),(98,2,'S','S','S','S'),(98,3,'S','S','S','S'),(98,4,'S','S','S','S'),(98,5,'S','S','S','S'),(99,1,'S','S','S','S'),(99,2,'S','S','S','S'),(99,4,'S','S','S','S'),(99,5,'S','S','S','S'),(100,1,'S','S','S','S'),(100,5,'S','S','S','S'),(101,1,'S','S','S','S'),(101,5,'S','S','S','S'),(102,1,'S','S','S','S'),(102,5,'S','S','S','S'),(103,1,'S','S','S','S');
/*!40000 ALTER TABLE `PERFILAMENTO_ACESSO` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PERFILAMENTO_ACESSO_USER`
--

DROP TABLE IF EXISTS `PERFILAMENTO_ACESSO_USER`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PERFILAMENTO_ACESSO_USER` (
  `ID_ROTINA` int(11) NOT NULL,
  `ID_USUARIO` varchar(20) NOT NULL,
  `CH_CONSULTA` enum('N','S') NOT NULL DEFAULT 'N',
  `CH_INCLUSAO` enum('N','S') NOT NULL DEFAULT 'N',
  `CH_ALTERACAO` enum('N','S') NOT NULL DEFAULT 'N',
  `CH_EXCLUSAO` enum('N','S') NOT NULL DEFAULT 'N',
  PRIMARY KEY (`ID_ROTINA`,`ID_USUARIO`),
  KEY `FK_PERFILAMENTO_ACESSO_USER_1` (`ID_USUARIO`),
  CONSTRAINT `FK_PERFILAMENTO_ACESSO_USER_1` FOREIGN KEY (`ID_USUARIO`) REFERENCES `USUARIO` (`ID_USUARIO`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_PERFILAMENTO_ACESSO_USER_2` FOREIGN KEY (`ID_ROTINA`) REFERENCES `ROTINAS` (`ID_ROTINA`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PERFILAMENTO_ACESSO_USER`
--

LOCK TABLES `PERFILAMENTO_ACESSO_USER` WRITE;
/*!40000 ALTER TABLE `PERFILAMENTO_ACESSO_USER` DISABLE KEYS */;
/*!40000 ALTER TABLE `PERFILAMENTO_ACESSO_USER` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PERFIS`
--

DROP TABLE IF EXISTS `PERFIS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PERFIS` (
  `ID_PERFIL` int(11) NOT NULL AUTO_INCREMENT,
  `NM_PERFIL` varchar(50) NOT NULL,
  PRIMARY KEY (`ID_PERFIL`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PERFIS`
--

LOCK TABLES `PERFIS` WRITE;
/*!40000 ALTER TABLE `PERFIS` DISABLE KEYS */;
INSERT INTO `PERFIS` VALUES (1,'ADMINISTRADOR'),(2,'USUARIO'),(3,'ANALISTA'),(4,'VISTORIADOR'),(5,'GERENTE');
/*!40000 ALTER TABLE `PERFIS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `POSTO_GRADUACAO`
--

DROP TABLE IF EXISTS `POSTO_GRADUACAO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `POSTO_GRADUACAO` (
  `ID_POSTO` int(11) NOT NULL AUTO_INCREMENT,
  `NM_POSTO` varchar(100) NOT NULL,
  `NM_REDUZIDO_POSTO` varchar(50) NOT NULL,
  `NR_NIVEL` int(11) NOT NULL,
  PRIMARY KEY (`ID_POSTO`),
  KEY `NR_NIVEL` (`NR_NIVEL`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `POSTO_GRADUACAO`
--

LOCK TABLES `POSTO_GRADUACAO` WRITE;
/*!40000 ALTER TABLE `POSTO_GRADUACAO` DISABLE KEYS */;
INSERT INTO `POSTO_GRADUACAO` VALUES (17,'CIVIL','CIVIL',15);
/*!40000 ALTER TABLE `POSTO_GRADUACAO` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ROTINAS`
--

DROP TABLE IF EXISTS `ROTINAS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ROTINAS` (
  `ID_ROTINA` int(11) NOT NULL AUTO_INCREMENT,
  `NM_ROTINA` varchar(50) NOT NULL,
  `NM_ARQ_ROTINA` varchar(50) NOT NULL,
  `ID_MODULO` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_ROTINA`),
  UNIQUE KEY `NM_ARQ_ROTINA` (`NM_ARQ_ROTINA`),
  KEY `ID_MODULO` (`ID_MODULO`),
  CONSTRAINT `ROTINAS_ibfk_1` FOREIGN KEY (`ID_MODULO`) REFERENCES `MODULOS` (`ID_MODULO`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ROTINAS`
--

LOCK TABLES `ROTINAS` WRITE;
/*!40000 ALTER TABLE `ROTINAS` DISABLE KEYS */;
INSERT INTO `ROTINAS` VALUES (1,'CADASTRO DE USUÁRIOS','usuario.php',1),(2,'CADASTRO DE ROTINAS','rotinas.php',1),(3,'CADASTRO DE PERFIS','perfis.php',1),(4,'PERFILAMENTO DE USUÁRIOS','perfilamento.php',1),(5,'ADMINISTRADOR','index3.php',1),(6,'INICIAL','index2.php',1),(7,'CADASTRO DE MODULOS','modulos.php',1),(8,'SOLICITAÇÃO PENDENTE DE PROJETO','pendente.php',8),(9,'PROTOCOLO DE ANALISE','protocolo.php',8),(10,'ANÁLISE PENDENTE','analise_pen.php',9),(11,'ANÁLISE DE PROJETO','analise.php',9),(12,'CADASTRO DE EDIFICAÇÃO','edificacao.php',10),(13,'SISTEMA DE SEGURANÇA CONTRA INCÊNDIOS','seguranca.php',10),(14,'ENGENHEIRO','engenheiro.php',10),(15,'GERENCIAMENTO DA LOTAÇÃO','cidade_lotacao.php',1),(16,'GERENCIAMENTO DE CIDADES POR USUÁRIO','cidade_usuario.php',1),(17,'CADASTRO DE INDICES','indice.php',11),(18,'COTAÇÕES','cotacao.php',11),(19,'CADASTROS DE SERVIÇOS','servicos.php',11),(20,'CADASTRO DO TIPO DE SERVIÇO','tp_servicos.php',11),(21,'CADASTRO DE FÓRMULAS','formula.php',11),(22,'BAIXA TAXA PROJETO','baixa_projeto.php',11),(23,'LOGRADOUROS PENDENTES','pen_logradouro.php',12),(24,'CADASTRO LOGRADOURO','cad_logradouro.php',12),(25,'SOLICITACAO HABITESE','solic_habitise.php',6),(26,'SOLICITAÇÃO PROJETO','solicitacao.php',6),(27,'HABITE-SE PENDENTE','pend_habitese.php',8),(28,'PROTOCOLAMENTO HABITE-SE','prot_habitese.php',8),(29,'HABITE-SE PENDENTE','pen_habitese.php',13),(30,'VISTORIA DE HABITE-SE','vist_habitese.php',13),(31,'2ª VIA DE COMPROVANTES','proj_rel.php',9),(32,'BAIXA DE COBRANÇA HABITE-SE','baixa_habitese.php',11),(33,'SOLICITAÇÃO DE FUNCIONAMENTO','solic_funcionamento.php',6),(34,'FUNCIONAMENTO PENDENTE','pend_funcionamento.php',8),(35,'PROTOCOLO DE FUNCIONAMENTO','prot_funcionamento.php',8),(36,'PROTOCOLOS PEDENTES','pen_funcionamento.php',14),(37,'VISTORIA DE FUNCIONAMENTO','vist_funcionamento.php',14),(38,'SOLICITAÇÃO DE MANUTENÇÃO','solic_manutencao.php',6),(39,'MANUTENÇÃO PENDENTE','pend_manutencao.php',8),(40,'PROTOCOLO DE MANUTENÇÃO','prot_manutencao.php',8),(41,'VISTORIA MANUTENÇÃO PENDENTE','pen_manutencao.php',15),(42,'VISTORIA DE MANUTENÇÃO','vist_manutencao.php',15),(43,'BAIXA COBRANÇA DE FUNCIONAMENTO','baixa_funcionamento_pen.php',11),(44,'BAIXA COBRANÇA DE MANUTENÇÃO','baixa_manutencao_pen.php',11),(45,'ARQUIVO BESC','upload_besc.php',11),(46,'SOLICITAÇÃO DE ACOMPANHAMENTO','solicitação de acompanhamento',6),(47,'ACOMPANHAMENTO DE PROCESSOS','acomp_solic.php',6),(48,'BAIXA FUNCIONAMENTO PENDENTE','baixa_funcionamento.php',11),(49,'2ª VIA DE COMPROVANTES','func_rel.php',14),(50,'2ª VIA DE COMPROVANTES','hab_rel.php',13),(51,'2ª VIA DE COMPROVANTES','man_rel.php',15),(52,'RETIRADA DE PROJETO','retirada_proj.php',9),(53,'ADEQUAÇÃO PENDENTE','analise_ind.php',9),(54,'RETORNO PENDENTE','retorno_pen.php',9),(55,'SOLICITAÇÃO PROJETO DE FUNCIONAMENTO','solic_analise_func_local.php',6),(56,'SOLIC. PENDENTE ANALISE FUN.','pend_an_func.php',8),(57,'PROTOCOLO ANALISE FUNCIONAMENTO','prot_an_func.php',8),(58,'ANALISE PROJETO FUNCIONAMENTO','vist_an_func.php',14),(59,'ANALISE FUNCIONAMENTO PENDENTE','pen_an_func.php',14),(60,'RETIRADA PROJETO FUNCIONAMENTO','retirada_an_func.php',14),(61,'RETORNO PENDENTE PROJETO FUNCIONAMENTO','retorno_pen_an_func.php',14),(62,'ADEQUAÇÃO PROJETO FUNCIONAMENTO','adequacao_ind_an_func.php',14),(63,'BAIXA PROJETO FUNCIONAMENTO PENDENTE','baixa_an_funcionamento.php',11),(64,'ADEQUAÇÃO','adequacao_ind_hab.php',13),(65,'RETIRADA DE HABITE-SE','retirada_hab.php',13),(66,'RETORNO PENDENTE HABITE-SE','retorno_pen_hab.php',13),(67,'RETORNO PENDENTE FUNCIONAMENTO','retorno_pen_func.php',14),(68,'ADEQUAÇÃO FUNCIONAMENTO','adequacao_ind_func.php',14),(69,'RETIRADA FUNCIONAMENTO','retirada_func.php',14),(70,'RETIRADA DE MANUTENÇÃO','retirada_manut.php',15),(71,'RETORNO PENDENTE MANUTENÇAO','retorno_pen_manut.php',15),(72,'ADEQUAÇÃO MANUTENÇÃO','adequacao_ind_manut.php',15),(73,'PESQUISA CNPJ PROJETO','acomp_solic_local.php',6),(74,'PESQUISA PROCESSO POR CNPJ','source_acomp.php',6),(75,'BOLETO PROJETO','boleto_projeto.php',11),(76,'BOLETO HABITESE','boleto_habitese.php',11),(77,'BOLETO FUNCIONAMENTO','boleto_funcionamento.php',11),(78,'BOLETO MANUTENCAO','boleto_manutencao.php',11),(79,'DADOS BANCÁRIOS','dados_bancarios.php',12),(80,'ALTERAÇÃO BOLETO','boleto_projeto_alt.php',16),(81,'BOLETO AVULSO','boleto_avulso.php',11),(82,'RELATÓRIO GERENCIAL','rel_atividades.php',16),(83,'RELATÓRIO DE QUITADOS','rel_quitados_find.php',11),(84,'RELATÓRIO DE INADIMPLENTES','rel_inadimplentes_find.php',11),(85,'EXCLUSÃO GERAL','excluir.php',16),(86,'ALTERAÇÃO STATUS ANALISE','alt_analise.php',16),(87,'ALTERAÇÃO STATUS HABITE-SE','alt_vist_habitese.php',16),(88,'ALTERAÇÃO STATUS FUNCIONAMENTO','alt_vist_funcionamento.php',16),(89,'ALTERAÇÃO STATUS MANUTENÇÃO','alt_vist_manutencao.php',16),(90,'VERSÃO SIGAT','versao.php',16),(91,'LINHA DE COMANDO','linha_comando.php',16),(92,'SERVIDORES DANCO DE DADOS','servidores_bd.php',16),(93,'TOP 10','top10.php',17),(94,'TOP 10 PADRÃO','top10padrao.php',17),(95,'CONFIGURAÇÃO TOP 10','configuracao_top10.php',1),(96,'UPLOAD BANCO DO BRASIL','upload_bb.php',11),(97,'PROTOCOLOS PEDENTES','pen_funcionamento_eventos.php',14),(98,'SOLICITAçãO DE FUNCIONAMENTO','solic_funcionamento_local_eventos.php',6),(99,'BAIXA COBRANÇA AVULSA','baixa_avulso.php',11),(100,'CONSULTA DE VIABILIDADE','viabilidade.php',14),(101,'MESCLAR RE','mesclar_re.php',10),(102,'ALTERAR LOGRADOURO','mesclar_logra.php',12),(103,'COMPLEMENTO DE SERVIçO','boleto_complemento.php',11),(104,'COMPLEMENTO DE SERVIçO','boleto_complemento_deservico.php',11);
/*!40000 ALTER TABLE `ROTINAS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `USUARIO`
--

DROP TABLE IF EXISTS `USUARIO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `USUARIO` (
  `ID_USUARIO` varchar(20) NOT NULL,
  `PS_SENHA` varchar(40) DEFAULT NULL,
  `NM_USUARIO` varchar(100) DEFAULT NULL,
  `ID_BATALHAO` int(11) DEFAULT NULL,
  `ID_COMPANIA` int(11) DEFAULT NULL,
  `ID_PELOTAO` int(11) DEFAULT NULL,
  `ID_PERFIL` int(11) DEFAULT NULL,
  `ID_POSTO` int(11) DEFAULT NULL,
  `ID_GRUPAMENTO` int(11) DEFAULT NULL,
  `ID_CIDADE` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_USUARIO`),
  KEY `FK_USUARIO_3` (`ID_GRUPAMENTO`,`ID_BATALHAO`,`ID_COMPANIA`,`ID_PELOTAO`),
  KEY `ID_PERFIL` (`ID_PERFIL`),
  KEY `ID_POSTO` (`ID_POSTO`),
  KEY `FK_USUARIO_4` (`ID_CIDADE`),
  CONSTRAINT `FK_USUARIO_4` FOREIGN KEY (`ID_CIDADE`) REFERENCES `CADASTROS`.`CIDADE` (`ID_CIDADE`),
  CONSTRAINT `USUARIO_ibfk_1` FOREIGN KEY (`ID_PERFIL`) REFERENCES `PERFIS` (`ID_PERFIL`),
  CONSTRAINT `USUARIO_ibfk_2` FOREIGN KEY (`ID_POSTO`) REFERENCES `POSTO_GRADUACAO` (`ID_POSTO`),
  CONSTRAINT `USUARIO_ibfk_3` FOREIGN KEY (`ID_GRUPAMENTO`) REFERENCES `CADASTROS`.`GRUPAMENTO` (`ID_GRUPAMENTO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `USUARIO`
--

LOCK TABLES `USUARIO` WRITE;
/*!40000 ALTER TABLE `USUARIO` DISABLE KEYS */;
INSERT INTO `USUARIO` VALUES ('carlos','d41d8cd98f00b204e9800998ecf8427e','CARLOS EDUARDO SOUSA',1,0,0,1,17,0,8105);
/*!40000 ALTER TABLE `USUARIO` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Current Database: `CADASTROS`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `CADASTROS` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `CADASTROS`;

--
-- Table structure for table `BAIRROS`
--

DROP TABLE IF EXISTS `BAIRROS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `BAIRROS` (
  `ID_CIDADE` int(11) NOT NULL,
  `ID_BAIRROS` int(11) NOT NULL AUTO_INCREMENT,
  `NM_BAIRROS` varchar(100) NOT NULL,
  `NM_FONETICA` varchar(100) DEFAULT NULL,
  `DT_AGUARDO` date DEFAULT NULL,
  `CH_AGUARDO` enum('S','N') NOT NULL DEFAULT 'N',
  `ID_USUARIO` varchar(20) NOT NULL,
  PRIMARY KEY (`ID_BAIRROS`,`ID_CIDADE`),
  UNIQUE KEY `UQ_BAIRROS_1` (`ID_CIDADE`,`NM_BAIRROS`),
  KEY `FK_BAIRROS_2` (`ID_USUARIO`),
  CONSTRAINT `FK_BAIRROS_2` FOREIGN KEY (`ID_USUARIO`) REFERENCES `ACESSOS`.`USUARIO` (`ID_USUARIO`) ON UPDATE CASCADE,
  CONSTRAINT `FK_BARROS_1` FOREIGN KEY (`ID_CIDADE`) REFERENCES `CIDADE` (`ID_CIDADE`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `BAIRROS`
--

LOCK TABLES `BAIRROS` WRITE;
/*!40000 ALTER TABLE `BAIRROS` DISABLE KEYS */;
INSERT INTO `BAIRROS` VALUES (8105,1,'CENTRO','SIMTRU','2010-06-11','N','carlos');
/*!40000 ALTER TABLE `BAIRROS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `BATALHAO`
--

DROP TABLE IF EXISTS `BATALHAO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `BATALHAO` (
  `ID_BATALHAO` int(11) NOT NULL,
  `NM_BATALHAO` varchar(100) NOT NULL,
  PRIMARY KEY (`ID_BATALHAO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `BATALHAO`
--

LOCK TABLES `BATALHAO` WRITE;
/*!40000 ALTER TABLE `BATALHAO` DISABLE KEYS */;
INSERT INTO `BATALHAO` VALUES (1,'1º BBM'),(2,'2º BBM'),(3,'3º BBM'),(4,'4º BBM'),(5,'5º BBM'),(6,'6º BBM'),(7,'7º BBM'),(8,'8º BBM'),(9,'9º BBM'),(10,'10º BBM'),(11,'11º BBM'),(12,'12º BBM'),(13,'13º BBM'),(14,'14º BBM'),(15,'15º BBM'),(16,'16º BBM');
/*!40000 ALTER TABLE `BATALHAO` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CEP`
--

DROP TABLE IF EXISTS `CEP`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CEP` (
  `ID_CEP` int(11) NOT NULL,
  `ID_LOGRADOURO` int(11) NOT NULL,
  `ID_CIDADE` int(11) NOT NULL,
  `DE_COMPLEMENTO` varchar(255) DEFAULT NULL,
  `DT_AGUARDO` date DEFAULT NULL,
  `CH_AGUARDO` enum('S','N') NOT NULL DEFAULT 'N',
  `ID_USUARIO` varchar(20) NOT NULL,
  PRIMARY KEY (`ID_CEP`,`ID_LOGRADOURO`,`ID_CIDADE`),
  KEY `FK_CEP_1` (`ID_LOGRADOURO`,`ID_CIDADE`),
  KEY `FK_CEP_2` (`ID_USUARIO`),
  CONSTRAINT `FK_CEP_1` FOREIGN KEY (`ID_LOGRADOURO`, `ID_CIDADE`) REFERENCES `LOGRADOURO` (`ID_LOGRADOURO`, `ID_CIDADE`) ON UPDATE CASCADE,
  CONSTRAINT `FK_CEP_2` FOREIGN KEY (`ID_USUARIO`) REFERENCES `ACESSOS`.`USUARIO` (`ID_USUARIO`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CEP`
--

LOCK TABLES `CEP` WRITE;
/*!40000 ALTER TABLE `CEP` DISABLE KEYS */;
INSERT INTO `CEP` VALUES (88047000,1,8105,NULL,'2010-06-11','N','carlos');
/*!40000 ALTER TABLE `CEP` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CIDADE`
--

DROP TABLE IF EXISTS `CIDADE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CIDADE` (
  `ID_CIDADE` int(11) NOT NULL AUTO_INCREMENT,
  `NM_CIDADE` varchar(50) NOT NULL,
  `ID_UF` char(2) NOT NULL,
  `AGENCIA` int(3) DEFAULT NULL,
  `CONTA` int(8) DEFAULT NULL,
  `CONVENIO` varchar(11) DEFAULT NULL,
  `carteira` varchar(2) NOT NULL,
  `CONTRATO` int(8) DEFAULT NULL,
  `INSTRUCAO` varchar(200) DEFAULT NULL,
  `ENDERECO` varchar(60) DEFAULT NULL,
  `CEDENTE` varchar(60) DEFAULT NULL,
  `CH_MAIL` enum('S','N') DEFAULT NULL,
  `id_banco` varchar(11) NOT NULL,
  `VIABILIDADE_AUTOMATICA` enum('S','N') NOT NULL DEFAULT 'S',
  PRIMARY KEY (`ID_CIDADE`),
  UNIQUE KEY `NM_CIDADE` (`NM_CIDADE`),
  KEY `FK_CIDADE_1` (`ID_UF`),
  CONSTRAINT `FK_CIDADE_1` FOREIGN KEY (`ID_UF`) REFERENCES `UF` (`ID_UF`)
) ENGINE=InnoDB AUTO_INCREMENT=8106 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CIDADE`
--

LOCK TABLES `CIDADE` WRITE;
/*!40000 ALTER TABLE `CIDADE` DISABLE KEYS */;
INSERT INTO `CIDADE` VALUES (8105,'FLORIANOPOLIS','SC',3215,65412,'321654','18',0,'teste','ana','carlos',NULL,'1','S');
/*!40000 ALTER TABLE `CIDADE` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CIDADE_SERVIDOR`
--

DROP TABLE IF EXISTS `CIDADE_SERVIDOR`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CIDADE_SERVIDOR` (
  `ID_CIDADE` int(11) DEFAULT NULL,
  `ID_SERVIDOR` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CIDADE_SERVIDOR`
--

LOCK TABLES `CIDADE_SERVIDOR` WRITE;
/*!40000 ALTER TABLE `CIDADE_SERVIDOR` DISABLE KEYS */;
INSERT INTO `CIDADE_SERVIDOR` VALUES (8105,3);
/*!40000 ALTER TABLE `CIDADE_SERVIDOR` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `COMPANIA`
--

DROP TABLE IF EXISTS `COMPANIA`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `COMPANIA` (
  `ID_BATALHAO` int(11) NOT NULL,
  `ID_COMPANIA` int(11) NOT NULL,
  `NM_COMPANIA` varchar(100) NOT NULL,
  PRIMARY KEY (`ID_COMPANIA`,`ID_BATALHAO`),
  KEY `FK_COMPANIA_1` (`ID_BATALHAO`),
  CONSTRAINT `FK_COMPANIA_1` FOREIGN KEY (`ID_BATALHAO`) REFERENCES `BATALHAO` (`ID_BATALHAO`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `COMPANIA`
--

LOCK TABLES `COMPANIA` WRITE;
/*!40000 ALTER TABLE `COMPANIA` DISABLE KEYS */;
INSERT INTO `COMPANIA` VALUES (1,0,'--------------------------'),(2,0,'--------------------------'),(3,0,'--------------------------'),(4,0,'--------------------------'),(5,0,'--------------------------'),(6,0,'--------------------------'),(7,0,'--------------------------'),(8,0,'--------------------------'),(9,0,'--------------------------'),(10,0,'--------------------------'),(11,0,'--------------------------'),(12,0,'--------------------------'),(13,0,'--------------------------'),(14,0,'--------------------------'),(15,0,'--------------------------'),(16,0,'--------------------------'),(1,1,'1º1ª CCB'),(1,2,'1º 2ª CCB');
/*!40000 ALTER TABLE `COMPANIA` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `GRUPAMENTO`
--

DROP TABLE IF EXISTS `GRUPAMENTO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `GRUPAMENTO` (
  `ID_BATALHAO` int(11) NOT NULL,
  `ID_COMPANIA` int(11) NOT NULL,
  `ID_PELOTAO` int(11) NOT NULL,
  `ID_GRUPAMENTO` int(11) NOT NULL,
  `NM_GRUPAMENTO` varchar(100) NOT NULL,
  `ID_CIDADE` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_GRUPAMENTO`,`ID_BATALHAO`,`ID_COMPANIA`,`ID_PELOTAO`),
  KEY `FK_GRUPAMENTO_1` (`ID_PELOTAO`,`ID_BATALHAO`,`ID_COMPANIA`),
  KEY `FK_GRUPAMENTO_2` (`ID_CIDADE`),
  CONSTRAINT `FK_GRUPAMENTO_1` FOREIGN KEY (`ID_PELOTAO`, `ID_BATALHAO`, `ID_COMPANIA`) REFERENCES `PELOTAO` (`ID_PELOTAO`, `ID_BATALHAO`, `ID_COMPANIA`),
  CONSTRAINT `FK_GRUPAMENTO_2` FOREIGN KEY (`ID_CIDADE`) REFERENCES `CIDADE` (`ID_CIDADE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `GRUPAMENTO`
--

LOCK TABLES `GRUPAMENTO` WRITE;
/*!40000 ALTER TABLE `GRUPAMENTO` DISABLE KEYS */;
INSERT INTO `GRUPAMENTO` VALUES (1,0,0,0,'--------------------------',NULL),(2,0,0,0,'--------------------------',NULL),(3,0,0,0,'--------------------------',NULL),(4,0,0,0,'--------------------------',NULL),(5,0,0,0,'--------------------------',NULL),(6,0,0,0,'--------------------------',NULL),(7,0,0,0,'--------------------------',NULL),(8,0,0,0,'--------------------------',NULL),(9,0,0,0,'--------------------------',NULL),(10,0,0,0,'--------------------------',NULL),(11,0,0,0,'--------------------------',NULL),(12,0,0,0,'--------------------------',NULL),(13,0,0,0,'--------------------------',NULL),(14,0,0,0,'--------------------------',NULL),(15,0,0,0,'--------------------------',NULL),(16,0,0,0,'--------------------------',NULL),(1,1,1,1,'1º 1ª 1º 1º GBM',NULL),(1,1,2,1,'1º 1ª 2º 1º GBM',NULL),(1,2,1,1,'1º 2ª 1º 1º GBM',NULL),(1,1,1,2,'1º 1ª 1º 2º GBM',NULL),(1,1,2,2,'1º 1ª 2º 2º GBM',NULL),(1,2,1,2,'1º 2ª 1º 2º GBM',NULL);
/*!40000 ALTER TABLE `GRUPAMENTO` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `LOGRADOURO`
--

DROP TABLE IF EXISTS `LOGRADOURO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `LOGRADOURO` (
  `ID_CIDADE` int(11) NOT NULL,
  `ID_LOGRADOURO` int(8) NOT NULL AUTO_INCREMENT,
  `NM_LOGRADOURO` varchar(100) NOT NULL,
  `NM_FONETICA` varchar(150) DEFAULT NULL,
  `ID_BAIRROS` int(11) DEFAULT NULL,
  `ID_CIDADE_BAIRROS` int(11) DEFAULT NULL,
  `ID_TP_LOGRADOURO` int(11) NOT NULL,
  `DT_AGUARDO` date DEFAULT NULL,
  `CH_AGUARDO` enum('S','N') NOT NULL DEFAULT 'N',
  `ID_USUARIO` varchar(20) NOT NULL,
  PRIMARY KEY (`ID_LOGRADOURO`,`ID_CIDADE`),
  KEY `IX_LOGRADOURO_1` (`NM_LOGRADOURO`),
  KEY `IX_LOGRADOURO_2` (`NM_FONETICA`),
  KEY `FK_LOGRADOURO_1` (`ID_CIDADE`),
  KEY `FK_LOGRADOURO_2` (`ID_TP_LOGRADOURO`),
  KEY `FK_LOGRADOURO_3` (`ID_USUARIO`),
  KEY `FK_LOGRADOURO_4` (`ID_BAIRROS`,`ID_CIDADE_BAIRROS`),
  CONSTRAINT `FK_LOGRADOURO_4` FOREIGN KEY (`ID_BAIRROS`, `ID_CIDADE_BAIRROS`) REFERENCES `BAIRROS` (`ID_BAIRROS`, `ID_CIDADE`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `LOGRADOURO_ibfk_1` FOREIGN KEY (`ID_CIDADE`) REFERENCES `CIDADE` (`ID_CIDADE`) ON UPDATE CASCADE,
  CONSTRAINT `LOGRADOURO_ibfk_2` FOREIGN KEY (`ID_TP_LOGRADOURO`) REFERENCES `TP_LOGRADOURO` (`ID_TP_LOGRADOURO`) ON UPDATE CASCADE,
  CONSTRAINT `LOGRADOURO_ibfk_3` FOREIGN KEY (`ID_USUARIO`) REFERENCES `ACESSOS`.`USUARIO` (`ID_USUARIO`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `LOGRADOURO`
--

LOCK TABLES `LOGRADOURO` WRITE;
/*!40000 ALTER TABLE `LOGRADOURO` DISABLE KEYS */;
INSERT INTO `LOGRADOURO` VALUES (8105,1,'ANA MARIA BITENCOURT','ANA0MARIA0BITIMKOURT',1,8105,208,'2010-06-11','N','carlos');
/*!40000 ALTER TABLE `LOGRADOURO` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PELOTAO`
--

DROP TABLE IF EXISTS `PELOTAO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PELOTAO` (
  `ID_BATALHAO` int(11) NOT NULL,
  `ID_COMPANIA` int(11) NOT NULL,
  `ID_PELOTAO` int(11) NOT NULL,
  `NM_PELOTAO` varchar(100) NOT NULL,
  PRIMARY KEY (`ID_PELOTAO`,`ID_BATALHAO`,`ID_COMPANIA`),
  KEY `FK_PELOTAO_1` (`ID_COMPANIA`,`ID_BATALHAO`),
  CONSTRAINT `FK_PELOTAO_1` FOREIGN KEY (`ID_COMPANIA`, `ID_BATALHAO`) REFERENCES `COMPANIA` (`ID_COMPANIA`, `ID_BATALHAO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PELOTAO`
--

LOCK TABLES `PELOTAO` WRITE;
/*!40000 ALTER TABLE `PELOTAO` DISABLE KEYS */;
INSERT INTO `PELOTAO` VALUES (1,0,0,'--------------------------'),(2,0,0,'--------------------------'),(3,0,0,'--------------------------'),(4,0,0,'--------------------------'),(5,0,0,'--------------------------'),(6,0,0,'--------------------------'),(7,0,0,'--------------------------'),(8,0,0,'--------------------------'),(9,0,0,'--------------------------'),(10,0,0,'--------------------------'),(11,0,0,'--------------------------'),(12,0,0,'--------------------------'),(13,0,0,'--------------------------'),(14,0,0,'--------------------------'),(15,0,0,'--------------------------'),(16,0,0,'--------------------------'),(1,1,1,'1° 1ª 1° PBM'),(1,2,1,'1° 2ª 1ª PBM'),(1,1,2,'1° 1ª 2° PBM'),(1,2,2,'1° 2ª 1° PBM');
/*!40000 ALTER TABLE `PELOTAO` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PESSOA`
--

DROP TABLE IF EXISTS `PESSOA`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PESSOA` (
  `ID_CNPJ_CPF` varchar(14) NOT NULL,
  `ID_CIDADE` int(11) NOT NULL,
  `ID_TP_PESSOA` enum('S','P','A') NOT NULL DEFAULT 'A',
  `NM_PESSOA` varchar(100) NOT NULL,
  `NM_PESSOA_FONETICA` varchar(100) DEFAULT NULL,
  `NR_FONE` int(12) DEFAULT NULL,
  `DE_EMAIL_PESSOA` varchar(255) DEFAULT NULL,
  `CH_JURIDICA` enum('S','N') DEFAULT 'N',
  `NM_CONTATO` varchar(100) DEFAULT NULL,
  `NM_CONTATO_FONETICO` varchar(100) DEFAULT NULL,
  `NM_FANTASIA` varchar(100) DEFAULT NULL,
  `NM_FANTASIA_FONETICO` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`ID_CNPJ_CPF`,`ID_CIDADE`),
  KEY `FK_PESSOA_1` (`ID_CIDADE`),
  KEY `IX_PESSOA_1` (`CH_JURIDICA`),
  KEY `IX_PESSOA_2` (`NM_CONTATO`),
  KEY `IX_PESSOA_3` (`NM_CONTATO_FONETICO`),
  KEY `IX_PESSOA_4` (`NM_FANTASIA`),
  KEY `IX_PESSOA_5` (`NM_FANTASIA_FONETICO`),
  KEY ` IX_PESSOA_6` (`ID_TP_PESSOA`),
  CONSTRAINT `FK_PESSOA_1` FOREIGN KEY (`ID_CIDADE`) REFERENCES `CIDADE` (`ID_CIDADE`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PESSOA`
--

LOCK TABLES `PESSOA` WRITE;
/*!40000 ALTER TABLE `PESSOA` DISABLE KEYS */;
INSERT INTO `PESSOA` VALUES ('03193466921',8105,'A','EMPRESAS LTDA','IMPRISAS0UTDA',99998000,'carlos@email.com.br','N','CARLOS','KARLUS','EMPRESAS','IMPRISAS');
/*!40000 ALTER TABLE `PESSOA` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TP_ABANDONO`
--

DROP TABLE IF EXISTS `TP_ABANDONO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TP_ABANDONO` (
  `ID_TP_ABANDONO` int(11) NOT NULL AUTO_INCREMENT,
  `NM_TP_ABANDONO` varchar(50) NOT NULL,
  PRIMARY KEY (`ID_TP_ABANDONO`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TP_ABANDONO`
--

LOCK TABLES `TP_ABANDONO` WRITE;
/*!40000 ALTER TABLE `TP_ABANDONO` DISABLE KEYS */;
INSERT INTO `TP_ABANDONO` VALUES (1,'BLOCO AUTÔNOMO'),(2,'CENTRAL DE BATERIAS'),(3,'PLACA (NÃO LUMINOSA)');
/*!40000 ALTER TABLE `TP_ABANDONO` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TP_ADUCAO`
--

DROP TABLE IF EXISTS `TP_ADUCAO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TP_ADUCAO` (
  `ID_ADUCAO` int(11) NOT NULL AUTO_INCREMENT,
  `NM_ADUCAO` varchar(100) NOT NULL,
  PRIMARY KEY (`ID_ADUCAO`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TP_ADUCAO`
--

LOCK TABLES `TP_ADUCAO` WRITE;
/*!40000 ALTER TABLE `TP_ADUCAO` DISABLE KEYS */;
INSERT INTO `TP_ADUCAO` VALUES (1,'GRAVITACIONAL'),(3,'POR BOMBAS');
/*!40000 ALTER TABLE `TP_ADUCAO` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TP_ALARME_INCENDIO`
--

DROP TABLE IF EXISTS `TP_ALARME_INCENDIO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TP_ALARME_INCENDIO` (
  `ID_TP_ALARME_INCENDIO` int(11) NOT NULL AUTO_INCREMENT,
  `NM_TP_ALARME_INCENDIO` varchar(30) NOT NULL,
  PRIMARY KEY (`ID_TP_ALARME_INCENDIO`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TP_ALARME_INCENDIO`
--

LOCK TABLES `TP_ALARME_INCENDIO` WRITE;
/*!40000 ALTER TABLE `TP_ALARME_INCENDIO` DISABLE KEYS */;
INSERT INTO `TP_ALARME_INCENDIO` VALUES (1,'COM DETECÇÃO'),(2,'SEM DETECÇÃO');
/*!40000 ALTER TABLE `TP_ALARME_INCENDIO` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TP_ATERRAMENTO`
--

DROP TABLE IF EXISTS `TP_ATERRAMENTO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TP_ATERRAMENTO` (
  `ID_TP_ATERRAMENTO` int(11) NOT NULL AUTO_INCREMENT,
  `NM_TP_ATERRAMENTO` varchar(50) NOT NULL,
  PRIMARY KEY (`ID_TP_ATERRAMENTO`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TP_ATERRAMENTO`
--

LOCK TABLES `TP_ATERRAMENTO` WRITE;
/*!40000 ALTER TABLE `TP_ATERRAMENTO` DISABLE KEYS */;
INSERT INTO `TP_ATERRAMENTO` VALUES (1,'CONDUTORES EM ANEL'),(2,'ATERRAMENTO NATURAL PELAS FUNDAÇÕES'),(3,'HASTES VERTICAIS');
/*!40000 ALTER TABLE `TP_ATERRAMENTO` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TP_CAPTORES`
--

DROP TABLE IF EXISTS `TP_CAPTORES`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TP_CAPTORES` (
  `ID_TP_CAPTORES` int(11) NOT NULL AUTO_INCREMENT,
  `NM_TP_CAPTORES` varchar(50) NOT NULL,
  PRIMARY KEY (`ID_TP_CAPTORES`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TP_CAPTORES`
--

LOCK TABLES `TP_CAPTORES` WRITE;
/*!40000 ALTER TABLE `TP_CAPTORES` DISABLE KEYS */;
INSERT INTO `TP_CAPTORES` VALUES (1,'HASTES'),(2,'CABOS ESTICADOS'),(3,'CONDUTORES EM MALHA');
/*!40000 ALTER TABLE `TP_CAPTORES` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TP_CONSTRUCAO`
--

DROP TABLE IF EXISTS `TP_CONSTRUCAO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TP_CONSTRUCAO` (
  `ID_TP_CONSTRUCAO` int(11) NOT NULL AUTO_INCREMENT,
  `NM_TP_CONSTRUCAO` varchar(30) NOT NULL,
  PRIMARY KEY (`ID_TP_CONSTRUCAO`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TP_CONSTRUCAO`
--

LOCK TABLES `TP_CONSTRUCAO` WRITE;
/*!40000 ALTER TABLE `TP_CONSTRUCAO` DISABLE KEYS */;
INSERT INTO `TP_CONSTRUCAO` VALUES (1,'ALVENARIA'),(2,'MADEIRA'),(3,'MISTA'),(4,'METÁLICA');
/*!40000 ALTER TABLE `TP_CONSTRUCAO` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TP_ILU_EMER`
--

DROP TABLE IF EXISTS `TP_ILU_EMER`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TP_ILU_EMER` (
  `ID_ILU_EMERG` int(11) NOT NULL AUTO_INCREMENT,
  `NM_ILU_EMERG` varchar(30) NOT NULL,
  PRIMARY KEY (`ID_ILU_EMERG`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TP_ILU_EMER`
--

LOCK TABLES `TP_ILU_EMER` WRITE;
/*!40000 ALTER TABLE `TP_ILU_EMER` DISABLE KEYS */;
INSERT INTO `TP_ILU_EMER` VALUES (1,'BLOCO AUTONOMO'),(2,'CENTRAL DE BATERIAS');
/*!40000 ALTER TABLE `TP_ILU_EMER` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TP_INSTALACAO`
--

DROP TABLE IF EXISTS `TP_INSTALACAO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TP_INSTALACAO` (
  `ID_TP_INSTALACAO` int(11) NOT NULL AUTO_INCREMENT,
  `NM_TP_INSTALACAO` varchar(30) NOT NULL,
  PRIMARY KEY (`ID_TP_INSTALACAO`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TP_INSTALACAO`
--

LOCK TABLES `TP_INSTALACAO` WRITE;
/*!40000 ALTER TABLE `TP_INSTALACAO` DISABLE KEYS */;
INSERT INTO `TP_INSTALACAO` VALUES (1,'PREDIAL'),(2,'INDUSTRIAL'),(3,'VEÍCULAR');
/*!40000 ALTER TABLE `TP_INSTALACAO` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TP_LOGRADOURO`
--

DROP TABLE IF EXISTS `TP_LOGRADOURO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TP_LOGRADOURO` (
  `ID_TP_LOGRADOURO` int(11) NOT NULL AUTO_INCREMENT,
  `NM_TP_LOGRADOURO` varchar(100) NOT NULL,
  `NM_REDUZ_TP_LOGRADOURO` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ID_TP_LOGRADOURO`),
  KEY `IX_TP_LOGRADOURO_1` (`NM_TP_LOGRADOURO`),
  KEY `IX_TP_LOGRADOURO_3` (`NM_REDUZ_TP_LOGRADOURO`)
) ENGINE=InnoDB AUTO_INCREMENT=246 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TP_LOGRADOURO`
--

LOCK TABLES `TP_LOGRADOURO` WRITE;
/*!40000 ALTER TABLE `TP_LOGRADOURO` DISABLE KEYS */;
INSERT INTO `TP_LOGRADOURO` VALUES (65,'AREA','A'),(66,'ACESSO','AC'),(68,'ACERTAR','ACERTAR'),(70,'AEROPORTO','AER'),(71,'ALAMEDA','AL'),(75,'ASSENTAMENTO','ASSENT'),(79,'AVENIDA','AV'),(83,'BAIRRO','BAIRRO'),(84,'BALNEARIO','BAL'),(85,'BARRA','BAR'),(86,'BECO','BC'),(91,'RODOVIA FEDERAL','BR'),(92,'BOSQUE','BSQ'),(98,'CAMINHO','CAM'),(100,'CENTRO','CENTRO'),(101,'CHACARA','CH'),(104,'CIDADE','CID'),(106,'CONJUNTO','CJ'),(107,'CONJUNTO HABITACIONAL','CJ H'),(108,'CONJUNTO RESIDENCIAL','CJ R'),(109,'CLINICA','CLN'),(112,'CONDOMINIO','COND'),(118,'CONTORNO VIARIO','CTN VIARIO'),(121,'DISTRITO','DT'),(126,'ESTRADA','EST'),(127,'ESTACIONAMENTO','ESTC'),(128,'ESTRADA GERAL','ESTR GERAL'),(130,'ESTRADA ESTADUAL','ESTRADA ES'),(139,'FAZENDA','FAZ'),(143,'FORTE','FTE'),(147,'ILHA','IA'),(148,'INTERIOR','INT'),(149,'JARDIM','JD'),(151,'LAGEADO','LAGDO'),(152,'LATERAL','LAT'),(153,'LADEIRA','LD'),(155,'LAGOA','LGA'),(156,'LINHA','LN'),(157,'LOCALIDADE','LOC'),(158,'LOTEAMENTO','LOT'),(159,'LARGO','LRG'),(160,'MARGEM','MG'),(161,'MARGEM DIREITA','MGD'),(163,'MARGINAL','MGL'),(166,'MORRO','MRO'),(168,'MUNICIPIO','MUN'),(169,'NUCLEO','NUC'),(173,'PARTICULAR','PARTIC'),(174,'PASSEIO','PAS'),(177,'PRACA','PC'),(182,'PRAIA','PR'),(184,'PARQUE','PRQ'),(185,'PASSARELA','PSA'),(186,'PASSAGEM','PSG'),(191,'QUADRA','Q'),(196,'RAMAL','RAM'),(197,'RDR','RDR'),(198,'RECANTO','REC'),(203,'RODOVIA','ROD'),(205,'ROTULA','ROT'),(208,'RUA','R  '),(212,'SITIO','SIT'),(213,'SERVIDAO','SRV'),(215,'SERTAO','STAO'),(218,'TERMINAL','TER'),(219,'TIFA','TF'),(221,'TRANSVERSAL','TRANSV'),(223,'TREVO','TRV'),(225,'TRAVESSA','TV'),(228,'VIA','V'),(231,'VIA EXPRESSA','V-EXP'),(239,'VILA','VL'),(244,'RODOVIA ESTADUAL','ROD-E'),(245,'ACESSO NORTE','ACSN');
/*!40000 ALTER TABLE `TP_LOGRADOURO` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TP_OCUPACAO`
--

DROP TABLE IF EXISTS `TP_OCUPACAO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TP_OCUPACAO` (
  `ID_OCUPACAO` int(11) NOT NULL AUTO_INCREMENT,
  `NM_OCUPACAO` varchar(50) NOT NULL,
  PRIMARY KEY (`ID_OCUPACAO`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TP_OCUPACAO`
--

LOCK TABLES `TP_OCUPACAO` WRITE;
/*!40000 ALTER TABLE `TP_OCUPACAO` DISABLE KEYS */;
INSERT INTO `TP_OCUPACAO` VALUES (1,'RESIDENCIAL PRIVATIVA MULTIFAMILIAR'),(2,'RESIDENCIAL PRIVATIVA UNIFAMILIAR'),(6,'RESIDENCIAL COLETIVA'),(7,'RESIDENCIAL TRANSITÓRIA'),(8,'COMERCIAL'),(9,'INDUSTRIAL'),(10,'MISTA'),(11,'PÚBLICA'),(12,'ESCOLAR'),(13,'HOSPITALAR E LABORATORIAL'),(14,'GARAGENS'),(15,'REUNIÄO DE PÚBLICO'),(16,'EDIFICAÇÖES ESPECIAIS'),(17,'DEPÓSITO DE INFLAMÁVEIS'),(18,'DEPÓSITO DE EXPLOSIVOS E MUNIÇÕES');
/*!40000 ALTER TABLE `TP_OCUPACAO` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TP_PARA_RAIO`
--

DROP TABLE IF EXISTS `TP_PARA_RAIO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TP_PARA_RAIO` (
  `ID_TP_PARA_RAIO` int(11) NOT NULL AUTO_INCREMENT,
  `NM_TP_PARA_RAIO` varchar(30) NOT NULL,
  PRIMARY KEY (`ID_TP_PARA_RAIO`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TP_PARA_RAIO`
--

LOCK TABLES `TP_PARA_RAIO` WRITE;
/*!40000 ALTER TABLE `TP_PARA_RAIO` DISABLE KEYS */;
INSERT INTO `TP_PARA_RAIO` VALUES (1,'ELETROGEOMÉTRICO'),(2,'FRANKLIN'),(3,'FARADAY');
/*!40000 ALTER TABLE `TP_PARA_RAIO` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TP_RECIPIENTE`
--

DROP TABLE IF EXISTS `TP_RECIPIENTE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TP_RECIPIENTE` (
  `ID_TP_RECIPIENTE` int(11) NOT NULL AUTO_INCREMENT,
  `NM_TP_RECIPIENTE` varchar(30) NOT NULL,
  PRIMARY KEY (`ID_TP_RECIPIENTE`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TP_RECIPIENTE`
--

LOCK TABLES `TP_RECIPIENTE` WRITE;
/*!40000 ALTER TABLE `TP_RECIPIENTE` DISABLE KEYS */;
INSERT INTO `TP_RECIPIENTE` VALUES (1,'TRANSPORTÁVEL'),(2,'RECARREGÁVEL');
/*!40000 ALTER TABLE `TP_RECIPIENTE` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TP_RISCO`
--

DROP TABLE IF EXISTS `TP_RISCO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TP_RISCO` (
  `ID_RISCO` int(11) NOT NULL AUTO_INCREMENT,
  `NM_RISCO` varchar(30) NOT NULL,
  PRIMARY KEY (`ID_RISCO`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TP_RISCO`
--

LOCK TABLES `TP_RISCO` WRITE;
/*!40000 ALTER TABLE `TP_RISCO` DISABLE KEYS */;
INSERT INTO `TP_RISCO` VALUES (1,'LEVE'),(2,'MÉDIO'),(3,'ELEVADO');
/*!40000 ALTER TABLE `TP_RISCO` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TP_SITUACAO`
--

DROP TABLE IF EXISTS `TP_SITUACAO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TP_SITUACAO` (
  `ID_SITUACAO` int(11) NOT NULL AUTO_INCREMENT,
  `NM_SITUACAO` varchar(30) NOT NULL,
  PRIMARY KEY (`ID_SITUACAO`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TP_SITUACAO`
--

LOCK TABLES `TP_SITUACAO` WRITE;
/*!40000 ALTER TABLE `TP_SITUACAO` DISABLE KEYS */;
INSERT INTO `TP_SITUACAO` VALUES (1,'EXISTENTE'),(2,'NOVA'),(3,'EM CONSTRUÇÃO');
/*!40000 ALTER TABLE `TP_SITUACAO` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `UF`
--

DROP TABLE IF EXISTS `UF`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `UF` (
  `ID_UF` char(2) NOT NULL,
  `NM_UF` varchar(50) NOT NULL,
  PRIMARY KEY (`ID_UF`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `UF`
--

LOCK TABLES `UF` WRITE;
/*!40000 ALTER TABLE `UF` DISABLE KEYS */;
INSERT INTO `UF` VALUES ('SC','SANTA CATARINA');
/*!40000 ALTER TABLE `UF` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Current Database: `COBRANCA`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `COBRANCA` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `COBRANCA`;

--
-- Table structure for table `ARQUIVO_BESC`
--

DROP TABLE IF EXISTS `ARQUIVO_BESC`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ARQUIVO_BESC` (
  `ID_BESC` int(11) NOT NULL AUTO_INCREMENT,
  `ID_CIDADE` int(11) NOT NULL,
  `NUM_AG` int(5) NOT NULL,
  `NUM_CC` int(13) NOT NULL,
  `NM_EMPRESA` varchar(30) NOT NULL,
  `DT_PROCESSAMENTO` date NOT NULL,
  `CICLO` int(8) NOT NULL,
  `H_SEQUENCIA` int(6) NOT NULL,
  `NUM_AG_C` int(5) NOT NULL,
  `NUM_CC_C` int(13) NOT NULL,
  `COD_DOC` varchar(16) NOT NULL,
  `COD_CONVENIO` int(5) NOT NULL,
  `OCORRENCIA` int(2) NOT NULL,
  `DT_PGTO` date NOT NULL,
  `NUM_PARCELA` int(8) NOT NULL,
  `DIAS_UTEIS` int(2) NOT NULL,
  `DT_CREDITO` date NOT NULL,
  `DT_VENCIMENTO` date NOT NULL,
  `VL_TITULO` decimal(17,2) NOT NULL,
  `COD_AG_COB` int(5) NOT NULL,
  `VL_DESCONTO` decimal(17,2) NOT NULL,
  `VL_COBRADO` decimal(17,2) NOT NULL,
  `VL_ACRESCIMO` decimal(17,2) NOT NULL,
  `VL_TARIFA` decimal(17,2) NOT NULL,
  `L_SEQUENCIA` int(6) NOT NULL,
  `QTD_TITULOS` int(12) DEFAULT NULL,
  `BAIXADO` enum('S','N') NOT NULL DEFAULT 'N',
  PRIMARY KEY (`ID_BESC`,`ID_CIDADE`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ARQUIVO_BESC`
--

LOCK TABLES `ARQUIVO_BESC` WRITE;
/*!40000 ALTER TABLE `ARQUIVO_BESC` DISABLE KEYS */;
/*!40000 ALTER TABLE `ARQUIVO_BESC` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `COBRANCA_BOLETO`
--

DROP TABLE IF EXISTS `COBRANCA_BOLETO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `COBRANCA_BOLETO` (
  `ID_CIDADE` int(11) NOT NULL,
  `ID_COBRANCA_BOLETO` int(11) NOT NULL AUTO_INCREMENT,
  `SICOOB` int(11) DEFAULT NULL,
  `ID_CNPJ_CPF` varchar(14) DEFAULT NULL,
  `ID_CIDADE_PESSOA` int(11) DEFAULT NULL,
  `ID_PROTOCOLO` int(11) DEFAULT NULL,
  `ID_CIDADE_PROTOCOLO` int(11) DEFAULT NULL,
  `ID_PROT_HABITESE` int(11) DEFAULT NULL,
  `ID_CIDADE_PROT_HABITESE` int(11) DEFAULT NULL,
  `ID_PROT_FUNC` int(11) DEFAULT NULL,
  `ID_CIDADE_PROT_FUNC` int(11) DEFAULT NULL,
  `ID_PROT_MANUTENCAO` int(11) DEFAULT NULL,
  `ID_CIDADE_PROT_MANUTENCAO` int(11) DEFAULT NULL,
  `ID_PROT_ANALISE_FUNC` int(11) DEFAULT NULL,
  `ID_CIDADE_AN_FUNC` int(11) DEFAULT NULL,
  `ID_PROT_AVULSO` int(11) DEFAULT NULL,
  `CH_TIPO_COBRANCA` enum('P','H','F','M','O','G') NOT NULL,
  `NR_PARCELA` int(2) NOT NULL,
  `DT_GERACAO` date NOT NULL,
  `DT_VENCIMENTO` date NOT NULL,
  `VL_TOTAL_COBRADO` decimal(17,2) NOT NULL,
  `VL_COBRANCA_DOC` decimal(17,2) NOT NULL,
  `VL_DESC_ABATIMENTO` decimal(17,2) NOT NULL DEFAULT '0.00',
  `VL_OUTRAS_DEDUCOES` decimal(17,2) NOT NULL DEFAULT '0.00',
  `VL_MULTA_MORA` decimal(17,2) NOT NULL DEFAULT '0.00',
  `VL_OUTROS_ACRESCIMOS` decimal(17,2) NOT NULL DEFAULT '0.00',
  `VL_COBRANCA` decimal(17,2) NOT NULL,
  `DT_PAGAMENTO` date DEFAULT NULL,
  `VL_PAGO` decimal(17,2) DEFAULT NULL,
  `MOTIVO` text,
  `ST_GERADO` set('0','1') NOT NULL,
  PRIMARY KEY (`ID_COBRANCA_BOLETO`,`ID_CIDADE`),
  KEY `IX_COBRANCA_BOLETO_1` (`CH_TIPO_COBRANCA`),
  KEY `IX_COBRANCA_BOLETO_2` (`NR_PARCELA`),
  KEY `IX_COBRANCA_BOLETO_3` (`DT_VENCIMENTO`),
  KEY `IX_COBRANCA_BOLETO_4` (`DT_GERACAO`),
  KEY `IX_COBRANCA_BOLETO_5` (`DT_PAGAMENTO`),
  KEY `FK_COBRANCA_BOLETO_2` (`ID_CNPJ_CPF`,`ID_CIDADE_PESSOA`),
  KEY `FK_COBRANCA_BOLETO_3` (`ID_PROTOCOLO`,`ID_CIDADE_PROTOCOLO`),
  KEY `FK_COBRANCA_BOLETO_4` (`ID_PROT_HABITESE`,`ID_CIDADE_PROT_HABITESE`),
  KEY `ID_CIDADE` (`ID_CIDADE`),
  KEY `FK_COBRANCA_BOLETO_5` (`ID_PROT_FUNC`,`ID_CIDADE_PROT_FUNC`),
  KEY `FK_COBRANCA_BOLETO_6` (`ID_PROT_MANUTENCAO`,`ID_CIDADE_PROT_MANUTENCAO`),
  KEY `FK_COBRANCA_BOLETO_7` (`ID_PROT_ANALISE_FUNC`,`ID_CIDADE_AN_FUNC`),
  CONSTRAINT `COBRANCA_BOLETO_ibfk_1` FOREIGN KEY (`ID_CIDADE`) REFERENCES `CADASTROS`.`CIDADE` (`ID_CIDADE`) ON UPDATE CASCADE,
  CONSTRAINT `COBRANCA_BOLETO_ibfk_2` FOREIGN KEY (`ID_CNPJ_CPF`) REFERENCES `CADASTROS`.`PESSOA` (`ID_CNPJ_CPF`) ON UPDATE CASCADE,
  CONSTRAINT `COBRANCA_BOLETO_ibfk_3` FOREIGN KEY (`ID_PROTOCOLO`) REFERENCES `PROJETO`.`PROTOCOLOS` (`ID_PROTOCOLO`) ON UPDATE CASCADE,
  CONSTRAINT `COBRANCA_BOLETO_ibfk_4` FOREIGN KEY (`ID_PROT_HABITESE`) REFERENCES `HABITESE`.`PROT_HABITESE` (`ID_PROT_HABITESE`) ON UPDATE CASCADE,
  CONSTRAINT `FK_COBRANCA_BOLETO_5` FOREIGN KEY (`ID_PROT_FUNC`, `ID_CIDADE_PROT_FUNC`) REFERENCES `FUNCIONAMENTO`.`PROT_FUNCIONAMENTO` (`ID_PROT_FUNC`, `ID_CIDADE`) ON UPDATE CASCADE,
  CONSTRAINT `FK_COBRANCA_BOLETO_6` FOREIGN KEY (`ID_PROT_MANUTENCAO`, `ID_CIDADE_PROT_MANUTENCAO`) REFERENCES `MANUTENCAO`.`PROT_MANUTENCAO` (`ID_PROT_MANUTENCAO`, `ID_CIDADE`) ON UPDATE CASCADE,
  CONSTRAINT `FK_COBRANCA_BOLETO_7` FOREIGN KEY (`ID_PROT_ANALISE_FUNC`, `ID_CIDADE_AN_FUNC`) REFERENCES `FUNCIONAMENTO`.`PROT_ANALISE_FUNC` (`ID_PROT_ANALISE_FUNC`, `ID_CIDADE`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `COBRANCA_BOLETO`
--

LOCK TABLES `COBRANCA_BOLETO` WRITE;
/*!40000 ALTER TABLE `COBRANCA_BOLETO` DISABLE KEYS */;
INSERT INTO `COBRANCA_BOLETO` VALUES (8105,1,NULL,'03193466921',8105,NULL,NULL,NULL,NULL,1,8105,NULL,NULL,NULL,NULL,NULL,'F',1,'2010-06-15','2010-06-20','849.15','849.15','0.00','0.00','0.00','0.00','849.15',NULL,NULL,NULL,''),(8105,2,NULL,'03193466921',8105,NULL,NULL,NULL,NULL,2,8105,NULL,NULL,NULL,NULL,NULL,'F',1,'2010-06-17','2010-06-22','260.49','260.49','0.00','0.00','0.00','0.00','260.49',NULL,NULL,NULL,''),(8105,3,NULL,'03193466921',8105,NULL,NULL,NULL,NULL,3,8105,NULL,NULL,NULL,NULL,NULL,'F',1,'2010-06-18','2010-06-23','849.15','849.15','0.00','0.00','0.00','0.00','849.15',NULL,NULL,NULL,''),(8105,4,NULL,'03193466921',8105,NULL,NULL,NULL,NULL,4,8105,NULL,NULL,NULL,NULL,NULL,'F',1,'2010-06-18','2010-06-23','849.15','849.15','0.00','0.00','0.00','0.00','849.15','2010-06-18','849.15',NULL,''),(8105,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL,6,8105,NULL,NULL,NULL,NULL,NULL,'F',1,'2010-06-18','2010-06-23','849.15','849.15','0.00','0.00','0.00','0.00','849.15',NULL,NULL,NULL,''),(8105,6,NULL,NULL,NULL,NULL,NULL,NULL,NULL,7,8105,NULL,NULL,NULL,NULL,NULL,'F',1,'2010-06-18','2010-06-23','849.15','849.15','0.00','0.00','0.00','0.00','849.15',NULL,NULL,NULL,''),(8105,7,NULL,NULL,NULL,NULL,NULL,NULL,NULL,8,8105,NULL,NULL,NULL,NULL,NULL,'F',1,'2010-06-18','2010-06-23','849.15','849.15','0.00','0.00','0.00','0.00','849.15',NULL,NULL,NULL,''),(8105,8,NULL,NULL,NULL,NULL,NULL,NULL,NULL,9,8105,NULL,NULL,NULL,NULL,NULL,'F',1,'2010-06-18','2010-06-23','849.15','849.15','0.00','0.00','0.00','0.00','849.15',NULL,NULL,NULL,''),(8105,9,NULL,NULL,NULL,NULL,NULL,NULL,NULL,10,8105,NULL,NULL,NULL,NULL,NULL,'F',1,'2010-06-18','2010-06-23','849.15','849.15','0.00','0.00','0.00','0.00','849.15',NULL,NULL,NULL,''),(8105,10,NULL,NULL,NULL,NULL,NULL,NULL,NULL,11,8105,NULL,NULL,NULL,NULL,NULL,'F',1,'2010-06-18','2010-06-23','849.15','849.15','0.00','0.00','0.00','0.00','849.15',NULL,NULL,NULL,''),(8105,11,NULL,NULL,NULL,NULL,NULL,NULL,NULL,12,8105,NULL,NULL,NULL,NULL,NULL,'F',1,'2010-06-18','2010-06-23','849.15','849.15','0.00','0.00','0.00','0.00','849.15',NULL,NULL,NULL,''),(8105,12,NULL,NULL,NULL,NULL,NULL,NULL,NULL,13,8105,NULL,NULL,NULL,NULL,NULL,'F',1,'2010-06-18','2010-06-23','849.15','849.15','0.00','0.00','0.00','0.00','849.15',NULL,NULL,NULL,''),(8105,13,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,8105,NULL,NULL,NULL,NULL,NULL,'F',1,'2010-06-18','2010-06-23','849.15','849.15','0.00','0.00','0.00','0.00','849.15',NULL,NULL,NULL,''),(8105,14,NULL,NULL,NULL,NULL,NULL,NULL,NULL,15,8105,NULL,NULL,NULL,NULL,NULL,'F',1,'2010-06-18','2010-06-23','849.15','849.15','0.00','0.00','0.00','0.00','849.15',NULL,NULL,NULL,''),(8105,15,NULL,NULL,NULL,NULL,NULL,NULL,NULL,16,8105,NULL,NULL,NULL,NULL,NULL,'F',1,'2010-06-18','2010-06-23','260.49','260.49','0.00','0.00','0.00','0.00','260.49',NULL,NULL,NULL,''),(8105,16,NULL,NULL,NULL,NULL,NULL,NULL,NULL,17,8105,NULL,NULL,NULL,NULL,NULL,'F',1,'2010-06-18','2010-06-23','260.49','260.49','0.00','0.00','0.00','0.00','260.49',NULL,NULL,NULL,''),(8105,17,NULL,NULL,NULL,NULL,NULL,NULL,NULL,18,8105,NULL,NULL,NULL,NULL,NULL,'F',1,'2010-06-18','2010-06-23','260.49','260.49','0.00','0.00','0.00','0.00','260.49',NULL,NULL,NULL,''),(8105,18,NULL,NULL,NULL,NULL,NULL,NULL,NULL,19,8105,NULL,NULL,NULL,NULL,NULL,'F',1,'2010-06-18','2010-06-23','260.49','260.49','0.00','0.00','0.00','0.00','260.49',NULL,NULL,NULL,''),(8105,19,NULL,NULL,NULL,NULL,NULL,NULL,NULL,20,8105,NULL,NULL,NULL,NULL,NULL,'F',1,'2010-06-18','2010-06-23','260.49','260.49','0.00','0.00','0.00','0.00','260.49',NULL,NULL,NULL,''),(8105,20,NULL,NULL,NULL,NULL,NULL,NULL,NULL,21,8105,NULL,NULL,NULL,NULL,NULL,'F',1,'2010-06-18','2010-06-23','849.15','849.15','0.00','0.00','0.00','0.00','849.15',NULL,NULL,NULL,'');
/*!40000 ALTER TABLE `COBRANCA_BOLETO` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `COTACAO`
--

DROP TABLE IF EXISTS `COTACAO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `COTACAO` (
  `ID_INDICE` int(11) NOT NULL,
  `ID_DT_COTACAO` date NOT NULL,
  `ID_CIDADE` int(11) NOT NULL,
  `VL_COTACAO` decimal(17,6) NOT NULL,
  PRIMARY KEY (`ID_DT_COTACAO`,`ID_INDICE`,`ID_CIDADE`),
  KEY `FK_COTACAO_1` (`ID_INDICE`),
  KEY `FK_COTACAO_2` (`ID_CIDADE`),
  CONSTRAINT `FK_COTACAO_1` FOREIGN KEY (`ID_INDICE`) REFERENCES `INDICE` (`ID_INDICE`),
  CONSTRAINT `FK_COTACAO_2` FOREIGN KEY (`ID_CIDADE`) REFERENCES `CADASTROS`.`CIDADE` (`ID_CIDADE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `COTACAO`
--

LOCK TABLES `COTACAO` WRITE;
/*!40000 ALTER TABLE `COTACAO` DISABLE KEYS */;
/*!40000 ALTER TABLE `COTACAO` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `FORMULA`
--

DROP TABLE IF EXISTS `FORMULA`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `FORMULA` (
  `ID_FORMULA` int(11) NOT NULL AUTO_INCREMENT,
  `ID_TP_SERVICO` int(11) NOT NULL,
  `ID_SERVICO` int(11) NOT NULL,
  `ID_CIDADE` int(11) NOT NULL,
  `ID_INDICE` int(11) DEFAULT NULL,
  `NM_FORMULA` varchar(50) NOT NULL,
  `NR_MAX_PARCELA` int(3) NOT NULL DEFAULT '1',
  `VL_MIN_PARCELA` decimal(17,2) NOT NULL DEFAULT '0.00',
  `VL_MAX_PARCELA` decimal(17,2) DEFAULT NULL,
  `CH_BASE_AREA` enum('S','N') NOT NULL DEFAULT 'S',
  `VL_MIN_AREA` decimal(17,2) DEFAULT NULL,
  `VL_MAX_AREA` decimal(17,2) DEFAULT NULL,
  `NR_PRAZO_VENCTO` int(3) NOT NULL DEFAULT '15',
  `DE_FORMULA` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID_FORMULA`,`ID_TP_SERVICO`,`ID_SERVICO`,`ID_CIDADE`),
  KEY `IX_FORMULA_1` (`NM_FORMULA`),
  KEY `IX_FORMULA_2` (`CH_BASE_AREA`),
  KEY `FK_FORMULA_2` (`ID_INDICE`),
  KEY `FK_FORMULA_3` (`ID_TP_SERVICO`,`ID_SERVICO`,`ID_CIDADE`),
  KEY `IX_FORMULA_3` (`VL_MIN_AREA`),
  KEY `IX_FORMULA_4` (`VL_MAX_AREA`),
  CONSTRAINT `FK_FORMULA_2` FOREIGN KEY (`ID_INDICE`) REFERENCES `INDICE` (`ID_INDICE`),
  CONSTRAINT `FK_FORMULA_3` FOREIGN KEY (`ID_TP_SERVICO`, `ID_SERVICO`, `ID_CIDADE`) REFERENCES `TP_SERVICO` (`ID_TP_SERVICO`, `ID_SERVICO`, `ID_CIDADE`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `FORMULA`
--

LOCK TABLES `FORMULA` WRITE;
/*!40000 ALTER TABLE `FORMULA` DISABLE KEYS */;
INSERT INTO `FORMULA` VALUES (15,15,9,8105,NULL,'FUNCIONAMENTO ATÉ 85M2',1,'0.00','99999999999999.00','S','0.00','85.00',5,'$RESULTADO=15*1.0641'),(16,17,9,8105,NULL,'FUNCIONAMENTO ACIMA DE 85M2',1,'0.00','99999999999999.00','S','85.00','99999999999999.00',5,'$RESULTADO=(15*1.0641)+(($VL_AREA-85)*0.20*1.0641)');
/*!40000 ALTER TABLE `FORMULA` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `INDICE`
--

DROP TABLE IF EXISTS `INDICE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `INDICE` (
  `ID_INDICE` int(11) NOT NULL AUTO_INCREMENT,
  `NM_INDICE` varchar(50) NOT NULL,
  `NM_REDUZ_INDICE` varchar(15) DEFAULT NULL,
  `CH_PERIODICIDADE` enum('D','Q','M','B','T','S','A') NOT NULL DEFAULT 'D',
  PRIMARY KEY (`ID_INDICE`),
  KEY `IX_INDICE_1` (`NM_INDICE`),
  KEY `IX_INDICE_2` (`NM_REDUZ_INDICE`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `INDICE`
--

LOCK TABLES `INDICE` WRITE;
/*!40000 ALTER TABLE `INDICE` DISABLE KEYS */;
INSERT INTO `INDICE` VALUES (4,'METRO QUADRADO','M²','A'),(7,'VISTORIA DE FUNCIONAMENTO ATÉ 100 METROS','VIST. ATÉ 100MT','M'),(19,'VISTORIA','VISTORIA','A');
/*!40000 ALTER TABLE `INDICE` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `SERVICO`
--

DROP TABLE IF EXISTS `SERVICO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SERVICO` (
  `ID_CIDADE` int(11) NOT NULL,
  `ID_SERVICO` int(11) NOT NULL AUTO_INCREMENT,
  `NM_SERVICO` varchar(50) NOT NULL,
  `CH_BOLETO_CCBSC` enum('S','N') NOT NULL DEFAULT 'S',
  `CH_OPERACAO` enum('P','H','F','M','T','G') NOT NULL,
  PRIMARY KEY (`ID_SERVICO`,`ID_CIDADE`),
  KEY `IX_SERVICO_1` (`CH_BOLETO_CCBSC`),
  KEY `FK_SERVICO_1` (`ID_CIDADE`),
  CONSTRAINT `FK_SERVICO_1` FOREIGN KEY (`ID_CIDADE`) REFERENCES `CADASTROS`.`CIDADE` (`ID_CIDADE`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SERVICO`
--

LOCK TABLES `SERVICO` WRITE;
/*!40000 ALTER TABLE `SERVICO` DISABLE KEYS */;
INSERT INTO `SERVICO` VALUES (8105,9,'VISTORIA DE FUNCIONAMENTO','N','F');
/*!40000 ALTER TABLE `SERVICO` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TP_SERVICO`
--

DROP TABLE IF EXISTS `TP_SERVICO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TP_SERVICO` (
  `ID_TP_SERVICO` int(11) NOT NULL AUTO_INCREMENT,
  `ID_SERVICO` int(11) NOT NULL,
  `ID_CIDADE` int(11) NOT NULL,
  `NM_TP_SERVICO` varchar(50) NOT NULL,
  PRIMARY KEY (`ID_TP_SERVICO`,`ID_SERVICO`,`ID_CIDADE`),
  KEY `FK_TP_SERVICO_1` (`ID_SERVICO`,`ID_CIDADE`),
  CONSTRAINT `FK_TP_SERVICO_1` FOREIGN KEY (`ID_SERVICO`, `ID_CIDADE`) REFERENCES `SERVICO` (`ID_SERVICO`, `ID_CIDADE`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TP_SERVICO`
--

LOCK TABLES `TP_SERVICO` WRITE;
/*!40000 ALTER TABLE `TP_SERVICO` DISABLE KEYS */;
INSERT INTO `TP_SERVICO` VALUES (15,9,8105,'FUNCIONAMENTO ATÉ 85M2'),(17,9,8105,'FUNCIONAMENTO ACIMA DE 85M2');
/*!40000 ALTER TABLE `TP_SERVICO` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Current Database: `EDIFICACOES`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `EDIFICACOES` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `EDIFICACOES`;

--
-- Table structure for table `CARACTERISTICA_EDIFICACAO`
--

DROP TABLE IF EXISTS `CARACTERISTICA_EDIFICACAO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CARACTERISTICA_EDIFICACAO` (
  `ID_CIDADE` int(11) NOT NULL,
  `ID_EDIFICACAO` int(11) NOT NULL,
  `ID_CARC_EDIFICACAO` int(11) NOT NULL AUTO_INCREMENT,
  `CH_ATIVO` enum('N','S') NOT NULL,
  `DT_CARC_EDIFICACAO` date NOT NULL,
  `ID_ANALISE` int(11) DEFAULT NULL,
  `ID_CIDADE_ANALISE` int(11) DEFAULT NULL,
  `CH_SIS_PREVENTIVO_EXTINTOR` enum('N','S') NOT NULL DEFAULT 'N',
  `ID_ADUCAO` int(11) DEFAULT NULL,
  `CH_COMB_GLP` enum('N','S') NOT NULL DEFAULT 'N',
  `ID_TP_RECIPIENTE` int(11) DEFAULT NULL,
  `CH_COMB_GN` enum('N','S') NOT NULL DEFAULT 'N',
  `ID_TP_INSTALACAO` int(11) DEFAULT NULL,
  `ID_TP_ALARME_INCENDIO` int(11) DEFAULT NULL,
  `NR_ESCADA_COMUM` int(11) NOT NULL DEFAULT '0',
  `NR_ESCADA_PROTEGIDA` int(11) NOT NULL DEFAULT '0',
  `NR_ESCADA_ENC` int(11) NOT NULL DEFAULT '0',
  `NR_ESCADA_PROVA_FUMACA` int(11) NOT NULL DEFAULT '0',
  `NR_ESCADA_PRESSU` int(11) NOT NULL DEFAULT '0',
  `NR_RAMPA` int(11) NOT NULL DEFAULT '0',
  `NR_ELEV_EMERGENCIA` int(11) NOT NULL DEFAULT '0',
  `NR_RESG_AEREO` int(11) NOT NULL DEFAULT '0',
  `NR_PASSARELA` int(11) NOT NULL DEFAULT '0',
  `ID_TP_PARA_RAIO` int(11) DEFAULT NULL,
  `ID_TP_CAPTORES` int(11) DEFAULT NULL,
  `ID_TP_ATERRAMENTO` int(11) DEFAULT NULL,
  `ID_TP_ABANDONO` int(11) DEFAULT NULL,
  `CH_SPRINKLER` enum('N','S') NOT NULL DEFAULT 'N',
  `CH_MULSYFIRE` enum('N','S') NOT NULL DEFAULT 'N',
  `CH_FIXO_CO2` enum('N','S') NOT NULL DEFAULT 'N',
  `CH_ANCORA_CABO` enum('N','S') NOT NULL DEFAULT 'N',
  `DE_OUTROS` varchar(255) DEFAULT NULL,
  `ID_ILU_EMERG` int(11) DEFAULT NULL,
  `DE_PLANO_ACAO` text,
  `NR_DETEC_FUMACA` int(11) DEFAULT NULL,
  `NR_DETEC_VEL` int(11) DEFAULT NULL,
  `NR_DETEC_QMC` int(11) DEFAULT NULL,
  `NR_PONTOS` int(11) DEFAULT NULL,
  `NR_PQS` int(11) DEFAULT NULL,
  `NR_AGUA` int(11) DEFAULT NULL,
  `NR_ESPUMA` int(11) DEFAULT NULL,
  `NR_CO2` int(11) DEFAULT NULL,
  `QTD_GLP` int(11) DEFAULT NULL,
  `QTD_GN` int(11) DEFAULT NULL,
  `NR_DETEC_INCEDIO` int(11) DEFAULT NULL,
  `PONTOS_INSTALADOS` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID_CARC_EDIFICACAO`,`ID_CIDADE`,`ID_EDIFICACAO`),
  KEY `IX_CARACTERISTICA_EDIFICACAO_1` (`CH_ATIVO`),
  KEY `IX_CARACTERISTICA_EDIFICACAO_2` (`DT_CARC_EDIFICACAO`),
  KEY `FK_CARACTERISTICA_EDIFICACAO_1` (`ID_EDIFICACAO`,`ID_CIDADE`),
  KEY `FK_CARACTERISTICA_EDIFICACAO_2` (`ID_ADUCAO`),
  KEY `FK_CARACTERISTICA_EDIFICACAO_3` (`ID_TP_RECIPIENTE`),
  KEY `FK_CARACTERISTICA_EDIFICACAO_4` (`ID_TP_INSTALACAO`),
  KEY `FK_CARACTERISTICA_EDIFICACAO_5` (`ID_TP_ALARME_INCENDIO`),
  KEY `FK_CARACTERISTICA_EDIFICACAO_6` (`ID_TP_PARA_RAIO`),
  KEY `FK_CARACTERISTICA_EDIFICACAO_7` (`ID_TP_CAPTORES`),
  KEY `FK_CARACTERISTICA_EDIFICACAO_8` (`ID_TP_ATERRAMENTO`),
  KEY `FK_CARACTERISTICA_EDIFICACAO_9` (`ID_TP_ABANDONO`),
  KEY `FK_CARACTERISTICA_EDIFICACAO_10` (`ID_ILU_EMERG`),
  KEY `FK_CARACTERISTICA_EDIFICACAO_11` (`ID_ANALISE`,`ID_CIDADE_ANALISE`),
  CONSTRAINT `FK_CARACTERISTICA_EDIFICACAO_1` FOREIGN KEY (`ID_EDIFICACAO`, `ID_CIDADE`) REFERENCES `EDIFICACAO` (`ID_EDIFICACAO`, `ID_CIDADE`) ON UPDATE CASCADE,
  CONSTRAINT `FK_CARACTERISTICA_EDIFICACAO_10` FOREIGN KEY (`ID_ILU_EMERG`) REFERENCES `CADASTROS`.`TP_ILU_EMER` (`ID_ILU_EMERG`) ON UPDATE CASCADE,
  CONSTRAINT `FK_CARACTERISTICA_EDIFICACAO_11` FOREIGN KEY (`ID_ANALISE`, `ID_CIDADE_ANALISE`) REFERENCES `PROJETO`.`ANALISE` (`ID_ANALISE`, `ID_CIDADE`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_CARACTERISTICA_EDIFICACAO_2` FOREIGN KEY (`ID_ADUCAO`) REFERENCES `CADASTROS`.`TP_ADUCAO` (`ID_ADUCAO`) ON UPDATE CASCADE,
  CONSTRAINT `FK_CARACTERISTICA_EDIFICACAO_3` FOREIGN KEY (`ID_TP_RECIPIENTE`) REFERENCES `CADASTROS`.`TP_RECIPIENTE` (`ID_TP_RECIPIENTE`) ON UPDATE CASCADE,
  CONSTRAINT `FK_CARACTERISTICA_EDIFICACAO_4` FOREIGN KEY (`ID_TP_INSTALACAO`) REFERENCES `CADASTROS`.`TP_INSTALACAO` (`ID_TP_INSTALACAO`) ON UPDATE CASCADE,
  CONSTRAINT `FK_CARACTERISTICA_EDIFICACAO_5` FOREIGN KEY (`ID_TP_ALARME_INCENDIO`) REFERENCES `CADASTROS`.`TP_ALARME_INCENDIO` (`ID_TP_ALARME_INCENDIO`) ON UPDATE CASCADE,
  CONSTRAINT `FK_CARACTERISTICA_EDIFICACAO_6` FOREIGN KEY (`ID_TP_PARA_RAIO`) REFERENCES `CADASTROS`.`TP_PARA_RAIO` (`ID_TP_PARA_RAIO`) ON UPDATE CASCADE,
  CONSTRAINT `FK_CARACTERISTICA_EDIFICACAO_7` FOREIGN KEY (`ID_TP_CAPTORES`) REFERENCES `CADASTROS`.`TP_CAPTORES` (`ID_TP_CAPTORES`) ON UPDATE CASCADE,
  CONSTRAINT `FK_CARACTERISTICA_EDIFICACAO_8` FOREIGN KEY (`ID_TP_ATERRAMENTO`) REFERENCES `CADASTROS`.`TP_ATERRAMENTO` (`ID_TP_ATERRAMENTO`) ON UPDATE CASCADE,
  CONSTRAINT `FK_CARACTERISTICA_EDIFICACAO_9` FOREIGN KEY (`ID_TP_ABANDONO`) REFERENCES `CADASTROS`.`TP_ABANDONO` (`ID_TP_ABANDONO`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CARACTERISTICA_EDIFICACAO`
--

LOCK TABLES `CARACTERISTICA_EDIFICACAO` WRITE;
/*!40000 ALTER TABLE `CARACTERISTICA_EDIFICACAO` DISABLE KEYS */;
INSERT INTO `CARACTERISTICA_EDIFICACAO` VALUES (8105,1,1,'N','0000-00-00',NULL,NULL,'N',NULL,'N',NULL,'N',NULL,NULL,0,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL,'N','N','N','N',NULL,NULL,NULL,0,0,0,0,0,0,0,0,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `CARACTERISTICA_EDIFICACAO` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `EDIFICACAO`
--

DROP TABLE IF EXISTS `EDIFICACAO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `EDIFICACAO` (
  `ID_CIDADE` int(11) NOT NULL,
  `ID_EDIFICACAO` int(11) NOT NULL AUTO_INCREMENT,
  `ID_CNPJ_CPF_PROPRIETARIO` varchar(14) NOT NULL,
  `ID_CIDADE_PESSOA` int(11) NOT NULL,
  `NM_EDIFICACAO` varchar(100) NOT NULL,
  `NM_EDIFICACAO_FONETICA` varchar(100) DEFAULT NULL,
  `NM_FANTASIA_1` varchar(100) DEFAULT NULL,
  `NM_FANTASIA_FONETICA_1` varchar(100) DEFAULT NULL,
  `NM_FANTASIA_2` varchar(100) DEFAULT NULL,
  `NM_FANTASIA_FONETICA_2` varchar(100) DEFAULT NULL,
  `NR_EDIFICACAO` int(11) DEFAULT NULL,
  `NM_COMPLEMENTO` varchar(50) DEFAULT NULL,
  `VL_AREA_CONSTRUIDA` decimal(17,2) NOT NULL,
  `VL_ALTURA` decimal(17,2) NOT NULL,
  `VL_AREA_TIPO` decimal(17,2) NOT NULL,
  `NR_PAVIMENTOS` int(11) NOT NULL,
  `NR_BLOCOS` int(11) NOT NULL,
  `ID_RISCO` int(11) NOT NULL,
  `ID_SITUACAO` int(11) NOT NULL,
  `ID_TP_CONSTRUCAO` int(11) NOT NULL,
  `ID_OCUPACAO` int(11) NOT NULL,
  `ID_CEP` int(11) NOT NULL,
  `ID_LOGRADOURO` int(11) NOT NULL,
  `ID_CIDADE_CEP` int(11) NOT NULL,
  `ID_LOGRADOURO_ANTIGO` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_EDIFICACAO`,`ID_CIDADE`),
  KEY `IX_EDIFICACAO_1` (`NM_EDIFICACAO`),
  KEY `IX_EDIFICACAO_2` (`NM_EDIFICACAO_FONETICA`),
  KEY `IX_EDIFICACAO_3` (`NM_FANTASIA_1`),
  KEY `IX_EDIFICACAO_4` (`NM_FANTASIA_FONETICA_1`),
  KEY `IX_EDIFICACAO_5` (`NM_FANTASIA_2`),
  KEY `IX_EDIFICACAO_6` (`NM_FANTASIA_FONETICA_2`),
  KEY `FK_EDIFICACAO_1` (`ID_CIDADE`),
  KEY `FK_EDIFICACAO_2` (`ID_CNPJ_CPF_PROPRIETARIO`,`ID_CIDADE_PESSOA`),
  KEY `FK_EDIFICACAO_3` (`ID_RISCO`),
  KEY `FK_EDIFICACAO_4` (`ID_SITUACAO`),
  KEY `FK_EDIFICACAO_5` (`ID_TP_CONSTRUCAO`),
  KEY `FK_EDIFICACAO_6` (`ID_OCUPACAO`),
  KEY `FK_EDIFICACAO_7` (`ID_CEP`,`ID_LOGRADOURO`,`ID_CIDADE_CEP`),
  CONSTRAINT `FK_EDIFICACAO_1` FOREIGN KEY (`ID_CIDADE`) REFERENCES `CADASTROS`.`CIDADE` (`ID_CIDADE`) ON UPDATE CASCADE,
  CONSTRAINT `FK_EDIFICACAO_2` FOREIGN KEY (`ID_CNPJ_CPF_PROPRIETARIO`, `ID_CIDADE_PESSOA`) REFERENCES `CADASTROS`.`PESSOA` (`ID_CNPJ_CPF`, `ID_CIDADE`) ON UPDATE CASCADE,
  CONSTRAINT `FK_EDIFICACAO_3` FOREIGN KEY (`ID_RISCO`) REFERENCES `CADASTROS`.`TP_RISCO` (`ID_RISCO`) ON UPDATE CASCADE,
  CONSTRAINT `FK_EDIFICACAO_4` FOREIGN KEY (`ID_SITUACAO`) REFERENCES `CADASTROS`.`TP_SITUACAO` (`ID_SITUACAO`) ON UPDATE CASCADE,
  CONSTRAINT `FK_EDIFICACAO_5` FOREIGN KEY (`ID_TP_CONSTRUCAO`) REFERENCES `CADASTROS`.`TP_CONSTRUCAO` (`ID_TP_CONSTRUCAO`) ON UPDATE CASCADE,
  CONSTRAINT `FK_EDIFICACAO_6` FOREIGN KEY (`ID_OCUPACAO`) REFERENCES `CADASTROS`.`TP_OCUPACAO` (`ID_OCUPACAO`) ON UPDATE CASCADE,
  CONSTRAINT `FK_EDIFICACAO_7` FOREIGN KEY (`ID_CEP`, `ID_LOGRADOURO`, `ID_CIDADE_CEP`) REFERENCES `CADASTROS`.`CEP` (`ID_CEP`, `ID_LOGRADOURO`, `ID_CIDADE`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `EDIFICACAO`
--

LOCK TABLES `EDIFICACAO` WRITE;
/*!40000 ALTER TABLE `EDIFICACAO` DISABLE KEYS */;
INSERT INTO `EDIFICACAO` VALUES (8105,1,'03193466921',8105,'PLAZA EMPRESAS','PLAZA0IMPRISAS','PLAZA EMPRESAS','PLAZA0IMPRISAS','PLAZA EMPRESAS','PLAZA0IMPRISAS',1234,NULL,'3000.00','1.00','1.00',1,1,1,1,1,8,88047000,1,8105,NULL);
/*!40000 ALTER TABLE `EDIFICACAO` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ENGENHEIRO`
--

DROP TABLE IF EXISTS `ENGENHEIRO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ENGENHEIRO` (
  `ID_CREA` varchar(7) NOT NULL,
  `NM_ENGENHEIRO` varchar(100) NOT NULL,
  `NM_ENGENHEIRO_FONETICA` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID_CREA`),
  KEY `IX_ENGENHEIRO_2` (`NM_ENGENHEIRO_FONETICA`),
  KEY `IX_ENGENHEIRO_1` (`NM_ENGENHEIRO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ENGENHEIRO`
--

LOCK TABLES `ENGENHEIRO` WRITE;
/*!40000 ALTER TABLE `ENGENHEIRO` DISABLE KEYS */;
/*!40000 ALTER TABLE `ENGENHEIRO` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ENG_EDIFICACAO`
--

DROP TABLE IF EXISTS `ENG_EDIFICACAO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ENG_EDIFICACAO` (
  `ID_EDIFICACAO` int(11) NOT NULL,
  `ID_CIDADE` int(11) NOT NULL,
  `ID_CREA` varchar(7) NOT NULL,
  `ID_TP_ENG` enum('P','H','F','M','T') NOT NULL,
  PRIMARY KEY (`ID_EDIFICACAO`,`ID_CIDADE`,`ID_CREA`,`ID_TP_ENG`),
  KEY `FK_ENG_EDIFICACAO_2` (`ID_CREA`),
  CONSTRAINT `FK_ENG_EDIFICACAO_1` FOREIGN KEY (`ID_EDIFICACAO`, `ID_CIDADE`) REFERENCES `EDIFICACAO` (`ID_EDIFICACAO`, `ID_CIDADE`) ON UPDATE CASCADE,
  CONSTRAINT `FK_ENG_EDIFICACAO_2` FOREIGN KEY (`ID_CREA`) REFERENCES `ENGENHEIRO` (`ID_CREA`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ENG_EDIFICACAO`
--

LOCK TABLES `ENG_EDIFICACAO` WRITE;
/*!40000 ALTER TABLE `ENG_EDIFICACAO` DISABLE KEYS */;
/*!40000 ALTER TABLE `ENG_EDIFICACAO` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ESTABELECIMENTO`
--

DROP TABLE IF EXISTS `ESTABELECIMENTO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ESTABELECIMENTO` (
  `ID_ESTABELECIMENTO` int(11) NOT NULL AUTO_INCREMENT,
  `ID_EDIFICACAO` int(11) NOT NULL,
  `ID_CIDADE` int(11) NOT NULL,
  `NM_ESTABELECIMENTO` varchar(100) NOT NULL,
  `NM_ESTABELECIMENTO_FONETICO` varchar(100) DEFAULT NULL,
  `VL_AREA` decimal(17,2) NOT NULL DEFAULT '0.00',
  `NR_PAVIMENTO` int(5) NOT NULL DEFAULT '1',
  `NM_BLOCO` varchar(50) DEFAULT NULL,
  `DT_CADASTRO` date NOT NULL,
  `ID_EDIFICACAO_ANTIGO` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_ESTABELECIMENTO`,`ID_EDIFICACAO`,`ID_CIDADE`),
  KEY `IX_ESTABELECIMENTO_1` (`NM_ESTABELECIMENTO`),
  KEY `IX_ESTABELECIMENTO_2` (`NM_ESTABELECIMENTO_FONETICO`),
  KEY `FK_ESTABELECIMENTO_1` (`ID_EDIFICACAO`,`ID_CIDADE`),
  CONSTRAINT `FK_ESTABELECIMENTO_1` FOREIGN KEY (`ID_EDIFICACAO`, `ID_CIDADE`) REFERENCES `EDIFICACAO` (`ID_EDIFICACAO`, `ID_CIDADE`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ESTABELECIMENTO`
--

LOCK TABLES `ESTABELECIMENTO` WRITE;
/*!40000 ALTER TABLE `ESTABELECIMENTO` DISABLE KEYS */;
INSERT INTO `ESTABELECIMENTO` VALUES (1,1,8105,'PLAZA EMPRESAS','PLAZA0IMPRISAS','3000.00',1,'TODOS','2010-06-17',NULL),(2,1,8105,'SUB SOLO','SUB0SULU','1234.00',0,NULL,'2010-06-18',NULL);
/*!40000 ALTER TABLE `ESTABELECIMENTO` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Current Database: `FUNCIONAMENTO`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `FUNCIONAMENTO` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `FUNCIONAMENTO`;

--
-- Table structure for table `ANALISE_FUNC`
--

DROP TABLE IF EXISTS `ANALISE_FUNC`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ANALISE_FUNC` (
  `ID_CIDADE` int(11) NOT NULL,
  `ID_ANALISE_FUNC` int(11) NOT NULL AUTO_INCREMENT,
  `ID_PROT_ANALISE_FUNC` int(11) NOT NULL,
  `ID_CNPJ_EMPRESA` varchar(14) NOT NULL,
  `ID_CIDADE_EMPRESA` int(11) NOT NULL,
  `CH_PARECER` enum('D','I') NOT NULL,
  `DE_INDEFERIMENTO` text,
  `ID_USUARIO` varchar(20) NOT NULL,
  `DT_ANALISE` date NOT NULL,
  `CH_SIS_PREVENTIVO_EXTINTOR` enum('N','S') NOT NULL DEFAULT 'N',
  `ID_ADUCAO` int(11) DEFAULT NULL,
  `CH_COMB_GLP` enum('N','S') NOT NULL DEFAULT 'N',
  `ID_TP_RECIPIENTE` int(11) DEFAULT NULL,
  `CH_COMB_GN` enum('N','S') NOT NULL DEFAULT 'N',
  `ID_TP_INSTALACAO` int(11) DEFAULT NULL,
  `ID_TP_ALARME_INCENDIO` int(11) DEFAULT NULL,
  `NR_ESCADA_COMUM` int(11) NOT NULL DEFAULT '0',
  `NR_ESCADA_PROTEGIDA` int(11) NOT NULL DEFAULT '0',
  `NR_ESCADA_ENC` int(11) NOT NULL DEFAULT '0',
  `NR_ESCADA_PROVA_FUMACA` int(11) NOT NULL DEFAULT '0',
  `NR_ESCADA_PRESSU` int(11) NOT NULL DEFAULT '0',
  `NR_RAMPA` int(11) NOT NULL DEFAULT '0',
  `NR_ELEV_EMERGENCIA` int(11) NOT NULL DEFAULT '0',
  `NR_RESG_AEREO` int(11) NOT NULL DEFAULT '0',
  `NR_PASSARELA` int(11) NOT NULL DEFAULT '0',
  `ID_TP_PARA_RAIO` int(11) DEFAULT NULL,
  `ID_TP_CAPTORES` int(11) DEFAULT NULL,
  `ID_TP_ATERRAMENTO` int(11) DEFAULT NULL,
  `ID_TP_ABANDONO` int(11) DEFAULT NULL,
  `CH_SPRINKLER` enum('N','S') NOT NULL DEFAULT 'N',
  `CH_MULSYFIRE` enum('N','S') NOT NULL DEFAULT 'N',
  `CH_FIXO_CO2` enum('N','S') NOT NULL DEFAULT 'N',
  `CH_ANCORA_CABO` enum('N','S') NOT NULL DEFAULT 'N',
  `DE_OUTROS` varchar(255) DEFAULT NULL,
  `ID_ILU_EMERG` int(11) DEFAULT NULL,
  `DE_PLANO_ACAO` text,
  PRIMARY KEY (`ID_ANALISE_FUNC`,`ID_CIDADE`),
  KEY `IX_ANALISE_FUNC_1` (`CH_PARECER`),
  KEY `IX_ANALISE_FUNC_2` (`DT_ANALISE`),
  KEY `FK_ANALISE_FUNC_1` (`ID_PROT_ANALISE_FUNC`,`ID_CIDADE`),
  KEY `FK_ANALISE_FUNC_2` (`ID_CNPJ_EMPRESA`,`ID_CIDADE_EMPRESA`),
  KEY `FK_ANALISE_FUNC_3` (`ID_USUARIO`),
  KEY `FK_ANALISE_FUNC_4` (`ID_ADUCAO`),
  KEY `FK_ANALISE_FUNC_5` (`ID_TP_RECIPIENTE`),
  KEY `FK_ANALISE_FUNC_6` (`ID_TP_INSTALACAO`),
  KEY `FK_ANALISE_FUNC_7` (`ID_TP_ALARME_INCENDIO`),
  KEY `FK_ANALISE_FUNC_8` (`ID_TP_PARA_RAIO`),
  KEY `FK_ANALISE_FUNC_9` (`ID_TP_CAPTORES`),
  KEY `FK_ANALISE_FUNC_10` (`ID_TP_ATERRAMENTO`),
  KEY `FK_ANALISE_FUNC_11` (`ID_TP_ABANDONO`),
  KEY `FK_ANALISE_FUNC_12` (`ID_ILU_EMERG`),
  CONSTRAINT `FK_ANALISE_FUNC_1` FOREIGN KEY (`ID_PROT_ANALISE_FUNC`, `ID_CIDADE`) REFERENCES `PROT_ANALISE_FUNC` (`ID_PROT_ANALISE_FUNC`, `ID_CIDADE`) ON UPDATE CASCADE,
  CONSTRAINT `FK_ANALISE_FUNC_10` FOREIGN KEY (`ID_TP_ATERRAMENTO`) REFERENCES `CADASTROS`.`TP_ATERRAMENTO` (`ID_TP_ATERRAMENTO`) ON UPDATE CASCADE,
  CONSTRAINT `FK_ANALISE_FUNC_11` FOREIGN KEY (`ID_TP_ABANDONO`) REFERENCES `CADASTROS`.`TP_ABANDONO` (`ID_TP_ABANDONO`) ON UPDATE CASCADE,
  CONSTRAINT `FK_ANALISE_FUNC_12` FOREIGN KEY (`ID_ILU_EMERG`) REFERENCES `CADASTROS`.`TP_ILU_EMER` (`ID_ILU_EMERG`) ON UPDATE CASCADE,
  CONSTRAINT `FK_ANALISE_FUNC_2` FOREIGN KEY (`ID_CNPJ_EMPRESA`, `ID_CIDADE_EMPRESA`) REFERENCES `CADASTROS`.`PESSOA` (`ID_CNPJ_CPF`, `ID_CIDADE`) ON UPDATE CASCADE,
  CONSTRAINT `FK_ANALISE_FUNC_3` FOREIGN KEY (`ID_USUARIO`) REFERENCES `ACESSOS`.`USUARIO` (`ID_USUARIO`) ON UPDATE CASCADE,
  CONSTRAINT `FK_ANALISE_FUNC_4` FOREIGN KEY (`ID_ADUCAO`) REFERENCES `CADASTROS`.`TP_ADUCAO` (`ID_ADUCAO`) ON UPDATE CASCADE,
  CONSTRAINT `FK_ANALISE_FUNC_5` FOREIGN KEY (`ID_TP_RECIPIENTE`) REFERENCES `CADASTROS`.`TP_RECIPIENTE` (`ID_TP_RECIPIENTE`) ON UPDATE CASCADE,
  CONSTRAINT `FK_ANALISE_FUNC_6` FOREIGN KEY (`ID_TP_INSTALACAO`) REFERENCES `CADASTROS`.`TP_INSTALACAO` (`ID_TP_INSTALACAO`) ON UPDATE CASCADE,
  CONSTRAINT `FK_ANALISE_FUNC_7` FOREIGN KEY (`ID_TP_ALARME_INCENDIO`) REFERENCES `CADASTROS`.`TP_ALARME_INCENDIO` (`ID_TP_ALARME_INCENDIO`) ON UPDATE CASCADE,
  CONSTRAINT `FK_ANALISE_FUNC_8` FOREIGN KEY (`ID_TP_PARA_RAIO`) REFERENCES `CADASTROS`.`TP_PARA_RAIO` (`ID_TP_PARA_RAIO`) ON UPDATE CASCADE,
  CONSTRAINT `FK_ANALISE_FUNC_9` FOREIGN KEY (`ID_TP_CAPTORES`) REFERENCES `CADASTROS`.`TP_CAPTORES` (`ID_TP_CAPTORES`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ANALISE_FUNC`
--

LOCK TABLES `ANALISE_FUNC` WRITE;
/*!40000 ALTER TABLE `ANALISE_FUNC` DISABLE KEYS */;
/*!40000 ALTER TABLE `ANALISE_FUNC` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PROT_ANALISE_FUNC`
--

DROP TABLE IF EXISTS `PROT_ANALISE_FUNC`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PROT_ANALISE_FUNC` (
  `ID_CIDADE` int(11) NOT NULL,
  `ID_PROT_ANALISE_FUNC` int(11) NOT NULL AUTO_INCREMENT,
  `ID_SOLICITACAO` int(11) NOT NULL,
  `ID_TIPO_SOLICITACAO` enum('S','P','FS','FP') NOT NULL,
  `CH_ANALISE` enum('N','S') NOT NULL DEFAULT 'N',
  `DT_PROTOCOLO` date NOT NULL,
  `ID_USUARIO` varchar(20) NOT NULL,
  `ID_TP_SERVICO` int(11) DEFAULT NULL,
  `ID_SERVICO` int(11) DEFAULT NULL,
  `ID_CIDADE_TP_SERVICO` int(11) DEFAULT NULL,
  `CH_STATUS_RETIRADA` enum('A','R','N') DEFAULT 'A',
  `DT_RETIRADA` date DEFAULT NULL,
  `NM_SOLIC_RETIRADA` varchar(100) DEFAULT NULL,
  `DT_RETORNO` date DEFAULT NULL,
  `NR_RETIRADAS` int(8) DEFAULT NULL,
  `ID_USUARIO_RET` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ID_PROT_ANALISE_FUNC`,`ID_CIDADE`),
  KEY `IX_PROT_ANALISE_FUNC_1` (`DT_PROTOCOLO`),
  KEY `IX_PROT_ANALISE_FUNC_2` (`CH_ANALISE`),
  KEY `IX_PROT_ANALISE_FUNC_3` (`CH_STATUS_RETIRADA`),
  KEY `FK_PROT_ANALISE_FUNC_1` (`ID_USUARIO`),
  KEY `FK_PROT_ANALISE_FUNC_2` (`ID_SOLICITACAO`,`ID_CIDADE`,`ID_TIPO_SOLICITACAO`),
  KEY `FK_PROT_ANALISE_FUNC_3` (`ID_TP_SERVICO`,`ID_SERVICO`,`ID_CIDADE_TP_SERVICO`),
  KEY `FK_PROT_ANALISE_FUNC_4` (`ID_USUARIO_RET`),
  CONSTRAINT `FK_PROT_ANALISE_FUNC_1` FOREIGN KEY (`ID_USUARIO`) REFERENCES `ACESSOS`.`USUARIO` (`ID_USUARIO`) ON UPDATE CASCADE,
  CONSTRAINT `FK_PROT_ANALISE_FUNC_2` FOREIGN KEY (`ID_SOLICITACAO`, `ID_CIDADE`, `ID_TIPO_SOLICITACAO`) REFERENCES `SOLICITACAO`.`SOLICITACAO` (`ID_SOLICITACAO`, `ID_CIDADE`, `ID_TIPO_SOLICITACAO`) ON UPDATE CASCADE,
  CONSTRAINT `FK_PROT_ANALISE_FUNC_3` FOREIGN KEY (`ID_TP_SERVICO`, `ID_SERVICO`, `ID_CIDADE_TP_SERVICO`) REFERENCES `COBRANCA`.`TP_SERVICO` (`ID_TP_SERVICO`, `ID_SERVICO`, `ID_CIDADE`) ON UPDATE CASCADE,
  CONSTRAINT `FK_PROT_ANALISE_FUNC_4` FOREIGN KEY (`ID_USUARIO_RET`) REFERENCES `ACESSOS`.`USUARIO` (`ID_USUARIO`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PROT_ANALISE_FUNC`
--

LOCK TABLES `PROT_ANALISE_FUNC` WRITE;
/*!40000 ALTER TABLE `PROT_ANALISE_FUNC` DISABLE KEYS */;
/*!40000 ALTER TABLE `PROT_ANALISE_FUNC` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PROT_FUNCIONAMENTO`
--

DROP TABLE IF EXISTS `PROT_FUNCIONAMENTO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PROT_FUNCIONAMENTO` (
  `ID_PROT_FUNC` int(11) NOT NULL AUTO_INCREMENT,
  `ID_CIDADE` int(11) NOT NULL,
  `ID_SOLIC_FUNC` int(11) NOT NULL,
  `ID_TP_FUNC` enum('S','P') NOT NULL,
  `CH_VISTORIADO` enum('S','N') NOT NULL DEFAULT 'N',
  `DT_PROTOCOLADO` date NOT NULL,
  `ID_TP_SERVICO` int(11) NOT NULL,
  `ID_SERVICO` int(11) NOT NULL,
  `ID_CIDADE_SERVICO` int(11) NOT NULL,
  `VL_VISTORIA` decimal(17,2) NOT NULL DEFAULT '0.00',
  `ID_USUARIO` varchar(20) NOT NULL,
  `CH_STATUS_RETIRADA` enum('V','R','N') DEFAULT 'V',
  `DT_RETIRADA` date DEFAULT NULL,
  `NM_SOLIC_RETIRADA` varchar(100) DEFAULT NULL,
  `DT_RETORNO` date DEFAULT NULL,
  `NR_RETIRADAS` int(8) DEFAULT NULL,
  `ID_USUARIO_RET` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ID_PROT_FUNC`,`ID_CIDADE`),
  KEY `IX_PROT_FUNCIONAMENTO_1` (`DT_PROTOCOLADO`),
  KEY `IX_PROT_FUNCIONAMENTO_2` (`CH_VISTORIADO`),
  KEY `FK_PROT_FUNCIONAMENTO_1` (`ID_SOLIC_FUNC`,`ID_CIDADE`,`ID_TP_FUNC`),
  KEY `FK_PROT_FUNCIONAMENTO_2` (`ID_TP_SERVICO`,`ID_SERVICO`,`ID_CIDADE_SERVICO`),
  KEY `FK_PROT_FUNCIONAMENTO_3` (`ID_USUARIO`),
  KEY `FK_PROT_FUNCIONAMENTO_4` (`ID_USUARIO_RET`),
  KEY `IX_PROT_FUNCIONAMENTO_3` (`CH_STATUS_RETIRADA`),
  CONSTRAINT `FK_PROT_FUNCIONAMENTO_1` FOREIGN KEY (`ID_SOLIC_FUNC`, `ID_CIDADE`, `ID_TP_FUNC`) REFERENCES `SOLICITACAO`.`SOLIC_FUNCIONAMENTO` (`ID_SOLIC_FUNC`, `ID_CIDADE`, `ID_TP_FUNC`) ON UPDATE CASCADE,
  CONSTRAINT `FK_PROT_FUNCIONAMENTO_2` FOREIGN KEY (`ID_TP_SERVICO`, `ID_SERVICO`, `ID_CIDADE_SERVICO`) REFERENCES `COBRANCA`.`TP_SERVICO` (`ID_TP_SERVICO`, `ID_SERVICO`, `ID_CIDADE`) ON UPDATE CASCADE,
  CONSTRAINT `FK_PROT_FUNCIONAMENTO_3` FOREIGN KEY (`ID_USUARIO`) REFERENCES `ACESSOS`.`USUARIO` (`ID_USUARIO`) ON UPDATE CASCADE,
  CONSTRAINT `FK_PROT_FUNCIONAMENTO_4` FOREIGN KEY (`ID_USUARIO_RET`) REFERENCES `ACESSOS`.`USUARIO` (`ID_USUARIO`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PROT_FUNCIONAMENTO`
--

LOCK TABLES `PROT_FUNCIONAMENTO` WRITE;
/*!40000 ALTER TABLE `PROT_FUNCIONAMENTO` DISABLE KEYS */;
INSERT INTO `PROT_FUNCIONAMENTO` VALUES (1,8105,1,'P','S','2010-06-15',17,9,8105,'4000.00','carlos','V',NULL,NULL,NULL,NULL,NULL),(2,8105,2,'P','S','2010-06-17',17,9,8105,'1234.00','carlos','V',NULL,NULL,NULL,NULL,NULL),(3,8105,3,'P','S','2010-06-18',17,9,8105,'4000.00','carlos','V',NULL,NULL,NULL,NULL,NULL),(4,8105,4,'P','S','2010-06-18',17,9,8105,'4000.00','carlos','V',NULL,NULL,NULL,NULL,NULL),(5,8105,5,'P','N','2010-06-18',15,9,8105,'1234.00','carlos','V',NULL,NULL,NULL,NULL,NULL),(6,8105,6,'P','N','2010-06-18',17,9,8105,'4000.00','carlos','V',NULL,NULL,NULL,NULL,NULL),(7,8105,6,'P','N','2010-06-18',17,9,8105,'4000.00','carlos','V',NULL,NULL,NULL,NULL,NULL),(8,8105,7,'P','N','2010-06-18',17,9,8105,'4000.00','carlos','V',NULL,NULL,NULL,NULL,NULL),(9,8105,7,'P','N','2010-06-18',17,9,8105,'4000.00','carlos','V',NULL,NULL,NULL,NULL,NULL),(10,8105,7,'P','N','2010-06-18',17,9,8105,'4000.00','carlos','V',NULL,NULL,NULL,NULL,NULL),(11,8105,7,'P','N','2010-06-18',17,9,8105,'4000.00','carlos','V',NULL,NULL,NULL,NULL,NULL),(12,8105,7,'P','N','2010-06-18',17,9,8105,'4000.00','carlos','V',NULL,NULL,NULL,NULL,NULL),(13,8105,7,'P','N','2010-06-18',17,9,8105,'4000.00','carlos','V',NULL,NULL,NULL,NULL,NULL),(14,8105,8,'P','N','2010-06-18',17,9,8105,'4000.00','carlos','V',NULL,NULL,NULL,NULL,NULL),(15,8105,8,'P','N','2010-06-18',17,9,8105,'4000.00','carlos','V',NULL,NULL,NULL,NULL,NULL),(16,8105,9,'P','N','2010-06-18',17,9,8105,'1234.00','carlos','V',NULL,NULL,NULL,NULL,NULL),(17,8105,9,'P','N','2010-06-18',17,9,8105,'1234.00','carlos','V',NULL,NULL,NULL,NULL,NULL),(18,8105,9,'P','N','2010-06-18',17,9,8105,'1234.00','carlos','V',NULL,NULL,NULL,NULL,NULL),(19,8105,9,'P','N','2010-06-18',17,9,8105,'1234.00','carlos','V',NULL,NULL,NULL,NULL,NULL),(20,8105,9,'P','N','2010-06-18',17,9,8105,'1234.00','carlos','V',NULL,NULL,NULL,NULL,NULL),(21,8105,10,'P','N','2010-06-18',17,9,8105,'4000.00','carlos','V',NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `PROT_FUNCIONAMENTO` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `VISTORIA_FUNCIONAMENTO`
--

DROP TABLE IF EXISTS `VISTORIA_FUNCIONAMENTO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `VISTORIA_FUNCIONAMENTO` (
  `ID_VISTORIA_FUNC` int(11) NOT NULL AUTO_INCREMENT,
  `ID_CIDADE` int(11) NOT NULL,
  `ID_PROT_FUNC` int(11) NOT NULL,
  `ID_CNPJ_EMPRESA` varchar(14) NOT NULL,
  `ID_CIDADE_EMPRESA` int(11) NOT NULL,
  `CH_PARECER` enum('D','I') NOT NULL,
  `DE_OBSERVACOES` text,
  `DT_VIST_FUNC` date NOT NULL,
  `ID_USUARIO` varchar(20) NOT NULL,
  `CH_STATUS_VENCIDA` enum('V','N') DEFAULT NULL,
  `ID_VISTORIADOR` varchar(20) NOT NULL,
  PRIMARY KEY (`ID_VISTORIA_FUNC`,`ID_CIDADE`),
  KEY `IX_VISTORIA_FUNCIONAMENTO_1` (`DT_VIST_FUNC`),
  KEY `IX_VISTORIA_FUNCIONAMENTO_2` (`CH_PARECER`),
  KEY `FK_VISTORIA_FUNCIONAMENTO_1` (`ID_PROT_FUNC`,`ID_CIDADE`),
  KEY `FK_VISTORIA_FUNCIONAMENTO_2` (`ID_CNPJ_EMPRESA`,`ID_CIDADE_EMPRESA`),
  KEY `FK_VISTORIA_FUNCIONAMENTO_3` (`ID_USUARIO`),
  CONSTRAINT `FK_VISTORIA_FUNCIONAMENTO_1` FOREIGN KEY (`ID_PROT_FUNC`, `ID_CIDADE`) REFERENCES `PROT_FUNCIONAMENTO` (`ID_PROT_FUNC`, `ID_CIDADE`) ON UPDATE CASCADE,
  CONSTRAINT `FK_VISTORIA_FUNCIONAMENTO_2` FOREIGN KEY (`ID_CNPJ_EMPRESA`, `ID_CIDADE_EMPRESA`) REFERENCES `CADASTROS`.`PESSOA` (`ID_CNPJ_CPF`, `ID_CIDADE`) ON UPDATE CASCADE,
  CONSTRAINT `FK_VISTORIA_FUNCIONAMENTO_3` FOREIGN KEY (`ID_USUARIO`) REFERENCES `ACESSOS`.`USUARIO` (`ID_USUARIO`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `VISTORIA_FUNCIONAMENTO`
--

LOCK TABLES `VISTORIA_FUNCIONAMENTO` WRITE;
/*!40000 ALTER TABLE `VISTORIA_FUNCIONAMENTO` DISABLE KEYS */;
INSERT INTO `VISTORIA_FUNCIONAMENTO` VALUES (1,8105,1,'03193466921',8105,'I','teste 1','2010-06-18','carlos',NULL,''),(2,8105,2,'03193466921',8105,'D','ok','2010-06-18','carlos',NULL,''),(3,8105,3,'03193466921',8105,'D','ok','2010-06-18','carlos',NULL,'carlos'),(4,8105,4,'03193466921',8105,'I','não há pagamento até o presente momento - dia 20/03/2010.','2010-06-18','carlos',NULL,'carlos'),(5,8105,4,'03193466921',8105,'I','X','2010-06-18','carlos',NULL,'carlos');
/*!40000 ALTER TABLE `VISTORIA_FUNCIONAMENTO` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `VIST_ANALISE_ESTAB`
--

DROP TABLE IF EXISTS `VIST_ANALISE_ESTAB`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `VIST_ANALISE_ESTAB` (
  `ID_ANALISE_FUNC` int(11) NOT NULL,
  `ID_CIDADE_ANALISE_VIST` int(11) NOT NULL,
  `ID_ESTABELECIMENTO` int(11) NOT NULL,
  `ID_EDIFICACAO` int(11) NOT NULL,
  `ID_CIDADE_ESTAB` int(11) NOT NULL,
  PRIMARY KEY (`ID_ANALISE_FUNC`,`ID_CIDADE_ANALISE_VIST`,`ID_ESTABELECIMENTO`,`ID_EDIFICACAO`,`ID_CIDADE_ESTAB`),
  KEY `FK_VIST_ANALISE_ESTAB_1` (`ID_ANALISE_FUNC`,`ID_CIDADE_ANALISE_VIST`),
  KEY `FK_VIST_ANALISE_ESTAB_2` (`ID_ESTABELECIMENTO`,`ID_EDIFICACAO`,`ID_CIDADE_ESTAB`),
  CONSTRAINT `FK_VIST_ANALISE_ESTAB_1` FOREIGN KEY (`ID_ANALISE_FUNC`, `ID_CIDADE_ANALISE_VIST`) REFERENCES `ANALISE_FUNC` (`ID_ANALISE_FUNC`, `ID_CIDADE`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_VIST_ANALISE_ESTAB_2` FOREIGN KEY (`ID_ESTABELECIMENTO`, `ID_EDIFICACAO`, `ID_CIDADE_ESTAB`) REFERENCES `EDIFICACOES`.`ESTABELECIMENTO` (`ID_ESTABELECIMENTO`, `ID_EDIFICACAO`, `ID_CIDADE`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `VIST_ANALISE_ESTAB`
--

LOCK TABLES `VIST_ANALISE_ESTAB` WRITE;
/*!40000 ALTER TABLE `VIST_ANALISE_ESTAB` DISABLE KEYS */;
/*!40000 ALTER TABLE `VIST_ANALISE_ESTAB` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `VIST_ESTAB`
--

DROP TABLE IF EXISTS `VIST_ESTAB`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `VIST_ESTAB` (
  `ID_VISTORIA_FUNC` int(11) NOT NULL,
  `ID_CIDADE_VISTORIA` int(11) NOT NULL,
  `ID_ESTABELECIMENTO` int(11) NOT NULL,
  `ID_EDIFICACAO` int(11) NOT NULL,
  `ID_CIDADE_ESTAB` int(11) NOT NULL,
  `ID_EDIFICACAO_ANTIGO` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_VISTORIA_FUNC`,`ID_CIDADE_VISTORIA`,`ID_ESTABELECIMENTO`,`ID_EDIFICACAO`,`ID_CIDADE_ESTAB`),
  KEY `FK_VIST_ESTAB_2` (`ID_ESTABELECIMENTO`,`ID_EDIFICACAO`,`ID_CIDADE_ESTAB`),
  CONSTRAINT `FK_VIST_ESTAB_1` FOREIGN KEY (`ID_VISTORIA_FUNC`, `ID_CIDADE_VISTORIA`) REFERENCES `VISTORIA_FUNCIONAMENTO` (`ID_VISTORIA_FUNC`, `ID_CIDADE`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_VIST_ESTAB_2` FOREIGN KEY (`ID_ESTABELECIMENTO`, `ID_EDIFICACAO`, `ID_CIDADE_ESTAB`) REFERENCES `EDIFICACOES`.`ESTABELECIMENTO` (`ID_ESTABELECIMENTO`, `ID_EDIFICACAO`, `ID_CIDADE`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `VIST_ESTAB`
--

LOCK TABLES `VIST_ESTAB` WRITE;
/*!40000 ALTER TABLE `VIST_ESTAB` DISABLE KEYS */;
INSERT INTO `VIST_ESTAB` VALUES (1,8105,1,1,8105,NULL),(2,8105,2,1,8105,NULL),(3,8105,1,1,8105,NULL),(4,8105,1,1,8105,NULL),(5,8105,1,1,8105,NULL);
/*!40000 ALTER TABLE `VIST_ESTAB` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Current Database: `HABITESE`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `HABITESE` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `HABITESE`;

--
-- Table structure for table `PROT_HABITESE`
--

DROP TABLE IF EXISTS `PROT_HABITESE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PROT_HABITESE` (
  `ID_PROT_HABITESE` int(11) NOT NULL AUTO_INCREMENT,
  `ID_CIDADE` int(11) NOT NULL,
  `ID_PROTOCOLO` int(11) NOT NULL,
  `ID_CIDADE_PROTOCOLO` int(11) NOT NULL,
  `ID_SOLIC_HABITESE` int(11) NOT NULL,
  `ID_TP_HABITESE` enum('S','H') NOT NULL,
  `CH_ANTIGO` enum('S','N') NOT NULL DEFAULT 'N',
  `DT_PROT_HABITESE` date NOT NULL,
  `ID_TP_SERVICO` int(11) NOT NULL,
  `ID_SERVICO` int(11) NOT NULL,
  `ID_CIDADE_TP_SERVICO` int(11) NOT NULL,
  `VL_AREA_VISTORIADA` decimal(17,2) NOT NULL DEFAULT '0.00',
  `CH_VISTORIADO` enum('S','N') NOT NULL DEFAULT 'N',
  `ID_USUARIO` varchar(20) NOT NULL,
  `CH_STATUS_RETIRADA` enum('V','R','N') DEFAULT 'V',
  `DT_RETIRADA` date DEFAULT NULL,
  `NM_SOLIC_RETIRADA` varchar(100) DEFAULT NULL,
  `DT_RETORNO` date DEFAULT NULL,
  `NR_RETIRADAS` int(8) DEFAULT NULL,
  `ID_USUARIO_RET` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ID_PROT_HABITESE`,`ID_CIDADE`),
  KEY `FK_PROT_HABITESE_1` (`ID_PROTOCOLO`,`ID_CIDADE_PROTOCOLO`),
  KEY `FK_PROT_HABITESE_2` (`ID_SOLIC_HABITESE`,`ID_CIDADE`,`ID_TP_HABITESE`),
  KEY `FK_PROT_HABITESE_3` (`ID_TP_SERVICO`,`ID_SERVICO`,`ID_CIDADE_TP_SERVICO`),
  KEY `FK_PROT_HABITESE_4` (`ID_USUARIO`),
  KEY `FK_PROT_HABITESE_5` (`ID_USUARIO_RET`),
  KEY `IX_PROT_HABITESE_1` (`CH_STATUS_RETIRADA`),
  CONSTRAINT `FK_PROT_HABITESE_1` FOREIGN KEY (`ID_PROTOCOLO`, `ID_CIDADE_PROTOCOLO`) REFERENCES `PROJETO`.`PROTOCOLOS` (`ID_PROTOCOLO`, `ID_CIDADE`) ON UPDATE CASCADE,
  CONSTRAINT `FK_PROT_HABITESE_2` FOREIGN KEY (`ID_SOLIC_HABITESE`, `ID_CIDADE`, `ID_TP_HABITESE`) REFERENCES `SOLICITACAO`.`SOLIC_HABITESE` (`ID_SOLIC_HABITESE`, `ID_CIDADE`, `ID_TP_HABITESE`) ON UPDATE CASCADE,
  CONSTRAINT `FK_PROT_HABITESE_3` FOREIGN KEY (`ID_TP_SERVICO`, `ID_SERVICO`, `ID_CIDADE_TP_SERVICO`) REFERENCES `COBRANCA`.`TP_SERVICO` (`ID_TP_SERVICO`, `ID_SERVICO`, `ID_CIDADE`) ON UPDATE CASCADE,
  CONSTRAINT `FK_PROT_HABITESE_4` FOREIGN KEY (`ID_USUARIO`) REFERENCES `ACESSOS`.`USUARIO` (`ID_USUARIO`) ON UPDATE CASCADE,
  CONSTRAINT `FK_PROT_HABITESE_5` FOREIGN KEY (`ID_USUARIO_RET`) REFERENCES `ACESSOS`.`USUARIO` (`ID_USUARIO`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PROT_HABITESE`
--

LOCK TABLES `PROT_HABITESE` WRITE;
/*!40000 ALTER TABLE `PROT_HABITESE` DISABLE KEYS */;
/*!40000 ALTER TABLE `PROT_HABITESE` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `VISTORIA_HABITESE`
--

DROP TABLE IF EXISTS `VISTORIA_HABITESE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `VISTORIA_HABITESE` (
  `ID_VISTO_HABITESE` int(11) NOT NULL AUTO_INCREMENT,
  `ID_CIDADE` int(11) NOT NULL,
  `ID_CNPJ_CPF_SOLICITANTE` varchar(14) NOT NULL,
  `ID_CIDADE_PESSOA` int(11) NOT NULL,
  `CH_PARECER` enum('P','D','I') NOT NULL,
  `DE_INDEFERIMENTO` text,
  `DT_VISTO_HABITESE` date NOT NULL,
  `ID_PROT_HABITESE` int(11) NOT NULL,
  `ID_EDIFICACAO` int(11) NOT NULL,
  `ID_CIDADE_EDIFICACAO` int(11) NOT NULL,
  `ID_USUARIO` varchar(20) NOT NULL,
  `ID_EDIFICACAO_ANTIGO` int(11) DEFAULT NULL,
  `ID_VISTORIADOR` varchar(20) NOT NULL,
  PRIMARY KEY (`ID_VISTO_HABITESE`,`ID_CIDADE`),
  KEY `FK_VISTORIA_HABITESE_1` (`ID_CNPJ_CPF_SOLICITANTE`,`ID_CIDADE_PESSOA`),
  KEY `FK_VISTORIA_HABITESE_2` (`ID_PROT_HABITESE`,`ID_CIDADE`),
  KEY `FK_VISTORIA_HABITESE_3` (`ID_EDIFICACAO`,`ID_CIDADE_EDIFICACAO`),
  KEY `FK_VISTORIA_HABITESE_4` (`ID_USUARIO`),
  CONSTRAINT `FK_VISTORIA_HABITESE_4` FOREIGN KEY (`ID_USUARIO`) REFERENCES `ACESSOS`.`USUARIO` (`ID_USUARIO`) ON UPDATE CASCADE,
  CONSTRAINT `FK_VISTORIA_HABITISE_1` FOREIGN KEY (`ID_CNPJ_CPF_SOLICITANTE`, `ID_CIDADE_PESSOA`) REFERENCES `CADASTROS`.`PESSOA` (`ID_CNPJ_CPF`, `ID_CIDADE`) ON UPDATE CASCADE,
  CONSTRAINT `FK_VISTORIA_HABITISE_2` FOREIGN KEY (`ID_PROT_HABITESE`, `ID_CIDADE`) REFERENCES `PROT_HABITESE` (`ID_PROT_HABITESE`, `ID_CIDADE`) ON UPDATE CASCADE,
  CONSTRAINT `FK_VISTORIA_HABITISE_3` FOREIGN KEY (`ID_EDIFICACAO`, `ID_CIDADE_EDIFICACAO`) REFERENCES `EDIFICACOES`.`EDIFICACAO` (`ID_EDIFICACAO`, `ID_CIDADE`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `VISTORIA_HABITESE`
--

LOCK TABLES `VISTORIA_HABITESE` WRITE;
/*!40000 ALTER TABLE `VISTORIA_HABITESE` DISABLE KEYS */;
/*!40000 ALTER TABLE `VISTORIA_HABITESE` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Current Database: `MANUTENCAO`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `MANUTENCAO` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `MANUTENCAO`;

--
-- Table structure for table `PROT_MANUTENCAO`
--

DROP TABLE IF EXISTS `PROT_MANUTENCAO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PROT_MANUTENCAO` (
  `ID_PROT_MANUTENCAO` int(11) NOT NULL AUTO_INCREMENT,
  `ID_CIDADE` int(11) NOT NULL,
  `ID_SOLIC_MANUTENCAO` int(11) NOT NULL,
  `ID_TP_MANUTENCAO` enum('S','F','J') NOT NULL,
  `CH_VISTORIADO` enum('S','N') NOT NULL DEFAULT 'N',
  `DT_PROTOCOLADO` date NOT NULL,
  `ID_TP_SERVICO` int(11) NOT NULL,
  `ID_SERVICO` int(11) NOT NULL,
  `ID_CIDADE_SERVICO` int(11) NOT NULL,
  `ID_USUARIO` varchar(20) NOT NULL,
  `CH_STATUS_RETIRADA` enum('V','R','N') DEFAULT 'V',
  `DT_RETIRADA` date DEFAULT NULL,
  `NM_SOLIC_RETIRADA` varchar(100) DEFAULT NULL,
  `DT_RETORNO` date DEFAULT NULL,
  `NR_RETIRADAS` int(8) DEFAULT NULL,
  `ID_USUARIO_RET` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ID_PROT_MANUTENCAO`,`ID_CIDADE`),
  KEY `IX_PROT_FUNCIONAMENTO_1` (`DT_PROTOCOLADO`),
  KEY `IX_PROT_FUNCIONAMENTO_2` (`CH_VISTORIADO`),
  KEY `FK_PROT_MANUTENCAO_1` (`ID_SOLIC_MANUTENCAO`,`ID_CIDADE`,`ID_TP_MANUTENCAO`),
  KEY `FK_PROT_MANUTENCAO_2` (`ID_TP_SERVICO`,`ID_SERVICO`,`ID_CIDADE_SERVICO`),
  KEY `FK_PROT_MANUTENCAO_3` (`ID_USUARIO`),
  KEY `FK_PROT_MANUTENCAO_4` (`ID_USUARIO_RET`),
  CONSTRAINT `FK_PROT_MANUTENCAO_1` FOREIGN KEY (`ID_SOLIC_MANUTENCAO`, `ID_CIDADE`, `ID_TP_MANUTENCAO`) REFERENCES `SOLICITACAO`.`SOLIC_MANUTENCAO` (`ID_SOLIC_MANUTENCAO`, `ID_CIDADE`, `ID_TP_MANUTENCAO`) ON UPDATE CASCADE,
  CONSTRAINT `FK_PROT_MANUTENCAO_2` FOREIGN KEY (`ID_TP_SERVICO`, `ID_SERVICO`, `ID_CIDADE_SERVICO`) REFERENCES `COBRANCA`.`TP_SERVICO` (`ID_TP_SERVICO`, `ID_SERVICO`, `ID_CIDADE`) ON UPDATE CASCADE,
  CONSTRAINT `FK_PROT_MANUTENCAO_3` FOREIGN KEY (`ID_USUARIO`) REFERENCES `ACESSOS`.`USUARIO` (`ID_USUARIO`) ON UPDATE CASCADE,
  CONSTRAINT `FK_PROT_MANUTENCAO_4` FOREIGN KEY (`ID_USUARIO_RET`) REFERENCES `ACESSOS`.`USUARIO` (`ID_USUARIO`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PROT_MANUTENCAO`
--

LOCK TABLES `PROT_MANUTENCAO` WRITE;
/*!40000 ALTER TABLE `PROT_MANUTENCAO` DISABLE KEYS */;
/*!40000 ALTER TABLE `PROT_MANUTENCAO` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Current Database: `PROJETO`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `PROJETO` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `PROJETO`;

--
-- Table structure for table `ANALISE`
--

DROP TABLE IF EXISTS `ANALISE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ANALISE` (
  `ID_CIDADE` int(11) NOT NULL,
  `ID_ANALISE` int(11) NOT NULL AUTO_INCREMENT,
  `ID_PROTOCOLO` int(11) NOT NULL,
  `ID_CNPJ_CPF_SOLICITANTE` varchar(14) NOT NULL,
  `ID_CIDADE_PESSOA` int(11) NOT NULL,
  `ID_EDIFICACAO` int(11) NOT NULL,
  `ID_CIDADE_EDIFICACAO` int(11) NOT NULL,
  `CH_PARCER` enum('P','D','I') NOT NULL,
  `DE_INDEFERIMENTO` text,
  `ID_USUARIO` varchar(20) NOT NULL,
  `DT_ANALISE` date NOT NULL,
  `ID_EDIFICACAO_ANTIGO` int(11) DEFAULT NULL,
  `ID_VISTORIADOR` varchar(20) NOT NULL,
  PRIMARY KEY (`ID_ANALISE`,`ID_CIDADE`),
  KEY `IX_ANALISE_1` (`CH_PARCER`),
  KEY `IX_ANALISE_2` (`DT_ANALISE`),
  KEY `FK_ANALISE_1` (`ID_PROTOCOLO`,`ID_CIDADE`),
  KEY `FK_ANALISE_2` (`ID_CNPJ_CPF_SOLICITANTE`,`ID_CIDADE_PESSOA`),
  KEY `FK_ANALISE_3` (`ID_EDIFICACAO`,`ID_CIDADE_EDIFICACAO`),
  KEY `FK_ANALISE_4` (`ID_USUARIO`),
  CONSTRAINT `FK_ANALISE_1` FOREIGN KEY (`ID_PROTOCOLO`, `ID_CIDADE`) REFERENCES `PROTOCOLOS` (`ID_PROTOCOLO`, `ID_CIDADE`) ON UPDATE CASCADE,
  CONSTRAINT `FK_ANALISE_2` FOREIGN KEY (`ID_CNPJ_CPF_SOLICITANTE`, `ID_CIDADE_PESSOA`) REFERENCES `CADASTROS`.`PESSOA` (`ID_CNPJ_CPF`, `ID_CIDADE`) ON UPDATE CASCADE,
  CONSTRAINT `FK_ANALISE_3` FOREIGN KEY (`ID_EDIFICACAO`, `ID_CIDADE_EDIFICACAO`) REFERENCES `EDIFICACOES`.`EDIFICACAO` (`ID_EDIFICACAO`, `ID_CIDADE`) ON UPDATE CASCADE,
  CONSTRAINT `FK_ANALISE_4` FOREIGN KEY (`ID_USUARIO`) REFERENCES `ACESSOS`.`USUARIO` (`ID_USUARIO`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ANALISE`
--

LOCK TABLES `ANALISE` WRITE;
/*!40000 ALTER TABLE `ANALISE` DISABLE KEYS */;
/*!40000 ALTER TABLE `ANALISE` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PROTOCOLOS`
--

DROP TABLE IF EXISTS `PROTOCOLOS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PROTOCOLOS` (
  `ID_CIDADE` int(11) NOT NULL,
  `ID_PROTOCOLO` int(11) NOT NULL AUTO_INCREMENT,
  `ID_SOLICITACAO` int(11) NOT NULL,
  `ID_TIPO_SOLICITACAO` enum('S','P','FS','FP') NOT NULL,
  `CH_ANALISE` enum('N','S') NOT NULL DEFAULT 'N',
  `DT_PROTOCOLO` date NOT NULL,
  `ID_USUARIO` varchar(20) NOT NULL,
  `ID_TP_SERVICO` int(11) DEFAULT NULL,
  `ID_SERVICO` int(11) DEFAULT NULL,
  `ID_CIDADE_TP_SERVICO` int(11) DEFAULT NULL,
  `CH_STATUS_RETIRADA` enum('A','R','N') DEFAULT 'A',
  `DT_RETIRADA` date DEFAULT NULL,
  `NM_SOLIC_RETIRADA` varchar(100) DEFAULT NULL,
  `DT_RETORNO` date DEFAULT NULL,
  `NR_RETIRADAS` int(8) DEFAULT NULL,
  `ID_USUARIO_RET` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ID_PROTOCOLO`,`ID_CIDADE`),
  KEY `IX_PROTOCOLOS_1` (`DT_PROTOCOLO`),
  KEY `IX_PROTOCOLOS_2` (`CH_ANALISE`),
  KEY `FK_PROTOCOLOS_1` (`ID_USUARIO`),
  KEY `FK_PROTOCOLOS_2` (`ID_SOLICITACAO`,`ID_CIDADE`,`ID_TIPO_SOLICITACAO`),
  KEY `FK_PROTOCOLOS_3` (`ID_TP_SERVICO`,`ID_SERVICO`,`ID_CIDADE_TP_SERVICO`),
  KEY `FK_PROTOCOLOS_4` (`ID_USUARIO_RET`),
  KEY `IX_PROTOCOLOS_3` (`CH_STATUS_RETIRADA`),
  CONSTRAINT `FK_PROTOCOLOS_1` FOREIGN KEY (`ID_USUARIO`) REFERENCES `ACESSOS`.`USUARIO` (`ID_USUARIO`) ON UPDATE CASCADE,
  CONSTRAINT `FK_PROTOCOLOS_2` FOREIGN KEY (`ID_SOLICITACAO`, `ID_CIDADE`, `ID_TIPO_SOLICITACAO`) REFERENCES `SOLICITACAO`.`SOLICITACAO` (`ID_SOLICITACAO`, `ID_CIDADE`, `ID_TIPO_SOLICITACAO`) ON UPDATE CASCADE,
  CONSTRAINT `FK_PROTOCOLOS_3` FOREIGN KEY (`ID_TP_SERVICO`, `ID_SERVICO`, `ID_CIDADE_TP_SERVICO`) REFERENCES `COBRANCA`.`TP_SERVICO` (`ID_TP_SERVICO`, `ID_SERVICO`, `ID_CIDADE`) ON UPDATE CASCADE,
  CONSTRAINT `FK_PROTOCOLOS_4` FOREIGN KEY (`ID_USUARIO_RET`) REFERENCES `ACESSOS`.`USUARIO` (`ID_USUARIO`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PROTOCOLOS`
--

LOCK TABLES `PROTOCOLOS` WRITE;
/*!40000 ALTER TABLE `PROTOCOLOS` DISABLE KEYS */;
/*!40000 ALTER TABLE `PROTOCOLOS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Current Database: `SOLICITACAO`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `SOLICITACAO` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `SOLICITACAO`;

--
-- Table structure for table `DESC_ANALISE_FUNC`
--

DROP TABLE IF EXISTS `DESC_ANALISE_FUNC`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `DESC_ANALISE_FUNC` (
  `ID_CIDADE` int(11) NOT NULL,
  `ID_SOLICITACAO` int(11) NOT NULL,
  `ID_TIPO_SOLICITACAO` enum('S','P','FS','FP') NOT NULL,
  `ID_DESC_ANALISE_FUNC` int(11) NOT NULL AUTO_INCREMENT,
  `NM_DESC_ANALISE_FUNC` varchar(50) NOT NULL,
  `NR_PAVIMENTO` int(5) NOT NULL,
  `NM_BLOCO` varchar(50) DEFAULT NULL,
  `VL_AREA_DESC_FUNC` decimal(17,2) NOT NULL,
  PRIMARY KEY (`ID_DESC_ANALISE_FUNC`,`ID_CIDADE`,`ID_SOLICITACAO`,`ID_TIPO_SOLICITACAO`),
  KEY `FK_DESC_ANALISE_FUNC_1` (`ID_SOLICITACAO`,`ID_CIDADE`,`ID_TIPO_SOLICITACAO`),
  CONSTRAINT `FK_DESC_ANALISE_FUNC_1` FOREIGN KEY (`ID_SOLICITACAO`, `ID_CIDADE`, `ID_TIPO_SOLICITACAO`) REFERENCES `SOLICITACAO` (`ID_SOLICITACAO`, `ID_CIDADE`, `ID_TIPO_SOLICITACAO`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `DESC_ANALISE_FUNC`
--

LOCK TABLES `DESC_ANALISE_FUNC` WRITE;
/*!40000 ALTER TABLE `DESC_ANALISE_FUNC` DISABLE KEYS */;
/*!40000 ALTER TABLE `DESC_ANALISE_FUNC` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `DESC_FUNCIONAMENTO`
--

DROP TABLE IF EXISTS `DESC_FUNCIONAMENTO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `DESC_FUNCIONAMENTO` (
  `ID_CIDADE` int(11) NOT NULL,
  `ID_SOLIC_FUNC` int(11) NOT NULL,
  `ID_TP_FUNC` enum('S','P') NOT NULL,
  `ID_DESC_FUNC` int(11) NOT NULL AUTO_INCREMENT,
  `NM_DESC_FUNC` varchar(50) NOT NULL,
  `NR_PAVIMENTO` int(5) NOT NULL,
  `NM_BLOCO` varchar(50) DEFAULT NULL,
  `VL_AREA_DESC_FUNC` decimal(17,2) NOT NULL,
  PRIMARY KEY (`ID_DESC_FUNC`,`ID_CIDADE`,`ID_SOLIC_FUNC`,`ID_TP_FUNC`),
  KEY `FK_DESC_FUNCIONAMENTO_1` (`ID_SOLIC_FUNC`,`ID_CIDADE`,`ID_TP_FUNC`),
  CONSTRAINT `FK_DESC_FUNCIONAMENTO_1` FOREIGN KEY (`ID_SOLIC_FUNC`, `ID_CIDADE`, `ID_TP_FUNC`) REFERENCES `SOLIC_FUNCIONAMENTO` (`ID_SOLIC_FUNC`, `ID_CIDADE`, `ID_TP_FUNC`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `DESC_FUNCIONAMENTO`
--

LOCK TABLES `DESC_FUNCIONAMENTO` WRITE;
/*!40000 ALTER TABLE `DESC_FUNCIONAMENTO` DISABLE KEYS */;
INSERT INTO `DESC_FUNCIONAMENTO` VALUES (8105,1,'P',1,'ÁREA TOTAL DA EDIFICAÇÃO',1,'TODOS','4000.00'),(8105,2,'P',2,'SUB SOLO',0,NULL,'1234.00'),(8105,3,'P',3,'ÁREA TOTAL DA EDIFICAÇÃO',1,'TODOS','4000.00'),(8105,4,'P',4,'ÁREA TOTAL DA EDIFICAÇÃO',1,'TODOS','4000.00'),(8105,5,'P',5,'ÁREA TOTAL DA EDIFICAÇÃO',1,'TODOS','1234.00'),(8105,6,'P',6,'ÁREA TOTAL DA EDIFICAÇÃO',1,'TODOS','4000.00'),(8105,7,'P',7,'ÁREA TOTAL DA EDIFICAÇÃO',1,'TODOS','4000.00'),(8105,8,'P',8,'ÁREA TOTAL DA EDIFICAÇÃO',1,'TODOS','4000.00'),(8105,9,'P',9,'ÁREA TOTAL DA EDIFICAÇÃO',1,'TODOS','1234.00'),(8105,10,'P',10,'ÁREA TOTAL DA EDIFICAÇÃO',1,'TODOS','4000.00');
/*!40000 ALTER TABLE `DESC_FUNCIONAMENTO` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `DESC_VISTORIAS`
--

DROP TABLE IF EXISTS `DESC_VISTORIAS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `DESC_VISTORIAS` (
  `ID_CIDADE` int(11) NOT NULL,
  `ID_SOLIC_HABITESE` int(11) NOT NULL,
  `ID_TP_HABITESE` enum('S','H') NOT NULL,
  `ID_DESC_VISTORIAS` int(11) NOT NULL AUTO_INCREMENT,
  `NM_DESC_VISTORIAS` varchar(50) NOT NULL,
  `VL_AREA_DESC_VISTORIAS` decimal(17,2) NOT NULL,
  PRIMARY KEY (`ID_DESC_VISTORIAS`,`ID_CIDADE`,`ID_SOLIC_HABITESE`,`ID_TP_HABITESE`),
  KEY `FK_DESC_VISTORIAS_1` (`ID_SOLIC_HABITESE`,`ID_CIDADE`,`ID_TP_HABITESE`),
  CONSTRAINT `FK_DESC_VISTORIAS_1` FOREIGN KEY (`ID_SOLIC_HABITESE`, `ID_CIDADE`, `ID_TP_HABITESE`) REFERENCES `SOLIC_HABITESE` (`ID_SOLIC_HABITESE`, `ID_CIDADE`, `ID_TP_HABITESE`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `DESC_VISTORIAS`
--

LOCK TABLES `DESC_VISTORIAS` WRITE;
/*!40000 ALTER TABLE `DESC_VISTORIAS` DISABLE KEYS */;
/*!40000 ALTER TABLE `DESC_VISTORIAS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `SOLICITACAO`
--

DROP TABLE IF EXISTS `SOLICITACAO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SOLICITACAO` (
  `ID_CIDADE` int(11) NOT NULL,
  `ID_SOLICITACAO` int(11) NOT NULL AUTO_INCREMENT,
  `ID_TIPO_SOLICITACAO` enum('S','P','FS','FP') NOT NULL,
  `CH_PAGO` enum('S','N') NOT NULL DEFAULT 'N',
  `CNPJ_CPF_SOLICITANTE` varchar(14) NOT NULL,
  `NM_SOLICITANTE` varchar(100) NOT NULL,
  `NM_FANTASIA_EMPRESA` varchar(100) DEFAULT NULL,
  `NM_CONTATO` varchar(100) DEFAULT NULL,
  `NR_FONE_SOLICITANTE` int(12) DEFAULT NULL,
  `DE_EMAIL_SOLICITANTE` varchar(200) DEFAULT NULL,
  `CNPJ_CPF_PROPRIETARIO` varchar(14) NOT NULL,
  `NM_PROPRIETARIO` varchar(100) NOT NULL,
  `NR_FONE_PROPRIETARIO` int(12) DEFAULT NULL,
  `DE_EMAIL_PROPRIETARIO` varchar(200) DEFAULT NULL,
  `NM_EDIFICACOES_LX` varchar(100) NOT NULL,
  `NM_FANTASIA` varchar(100) DEFAULT NULL,
  `NM_LOGRADOURO` varchar(100) NOT NULL,
  `NR_EDIFICACOES_LX` int(11) DEFAULT NULL,
  `NR_CEP` int(8) DEFAULT NULL,
  `NM_BAIRRO` varchar(50) NOT NULL,
  `NM_COMPLEMENTO` varchar(50) DEFAULT NULL,
  `VL_AREA_CONTRUIDA` decimal(17,2) NOT NULL,
  `VL_ALTURA` decimal(17,2) NOT NULL,
  `VL_AREA_TIPO` decimal(17,2) NOT NULL,
  `NR_PAVIMENTOS` int(5) NOT NULL DEFAULT '1',
  `NR_BLOCOS` int(5) NOT NULL DEFAULT '1',
  `CH_SIS_PREVENTIVO_EXTINTOR` enum('N','S') NOT NULL DEFAULT 'N',
  `NR_ESCADA_COMUM` int(3) DEFAULT '0',
  `NR_ESCADA_PROTEGIDA` int(3) DEFAULT '0',
  `NR_ESCADA_ENC` int(3) DEFAULT '0',
  `NR_ESCADA_PROVA_FUMACA` int(3) DEFAULT '0',
  `NR_ESCADA_PRESSU` int(3) DEFAULT '0',
  `NR_RAMPA` int(3) DEFAULT '0',
  `NR_ELEV_EMERGENCIA` int(3) DEFAULT '0',
  `NR_RESG_AEREO` int(3) DEFAULT '0',
  `NR_PASSARELA` int(3) DEFAULT '0',
  `ID_RISCO` int(11) DEFAULT NULL,
  `ID_SITUACAO` int(11) DEFAULT NULL,
  `ID_TP_CONSTRUCAO` int(11) DEFAULT NULL,
  `ID_OCUPACAO` int(11) DEFAULT NULL,
  `ID_TP_ALARME_INCENDIO` int(11) DEFAULT NULL,
  `ID_ILU_EMERG` int(11) DEFAULT NULL,
  `ID_TP_PARA_RAIO` int(11) DEFAULT NULL,
  `NR_CREA_1` varchar(7) DEFAULT NULL,
  `NM_ENGENHEIRO_1` varchar(100) DEFAULT NULL,
  `NR_CREA_2` varchar(7) DEFAULT NULL,
  `NM_ENGENHEIRO_2` varchar(100) DEFAULT NULL,
  `NR_CREA_3` varchar(7) DEFAULT NULL,
  `NM_ENGENHEIRO_3` varchar(100) DEFAULT NULL,
  `CH_COMB_GN` enum('N','S') NOT NULL DEFAULT 'N',
  `CH_COMB_GLP` enum('N','S') NOT NULL DEFAULT 'N',
  `ID_TP_RECIPIENTE` int(11) DEFAULT NULL,
  `ID_TP_INSTALACAO` int(11) DEFAULT NULL,
  `CH_ABANDONO` enum('N','S') NOT NULL DEFAULT 'N',
  `CH_FIXO_CO2` enum('N','S') NOT NULL DEFAULT 'N',
  `CH_SPRINKLER` enum('N','S') NOT NULL DEFAULT 'N',
  `CH_ANCORA_CABO` enum('N','S') NOT NULL DEFAULT 'N',
  `CH_MULSYFIRE` enum('N','S') NOT NULL DEFAULT 'N',
  `NM_OUTROS` varchar(30) DEFAULT NULL,
  `CH_PROTOCOLADO` enum('S','P','A') NOT NULL,
  `ID_ADUCAO` int(11) DEFAULT NULL,
  `DT_SOLICITACAO` date NOT NULL,
  `ID_TP_LOGRADOURO` int(11) NOT NULL,
  `CH_AGUARDO_LOGRADOURO` enum('S','N') NOT NULL DEFAULT 'N',
  `DT_AGUARDO_LOGRADOURO` date DEFAULT NULL,
  `ID_CEP` int(11) DEFAULT NULL,
  `ID_LOGRADOURO` int(11) DEFAULT NULL,
  `ID_CIDADE_CEP` int(11) DEFAULT NULL,
  `ID_USUARIO` varchar(20) DEFAULT NULL,
  `ID_LOGRADOURO_ANTIGO` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_SOLICITACAO`,`ID_CIDADE`,`ID_TIPO_SOLICITACAO`),
  KEY `FK_EDIFICACOES_1` (`ID_CIDADE`),
  KEY `FK_SOLICITACAO_2` (`ID_TP_ALARME_INCENDIO`),
  KEY `FK_EDIFICACOES_3` (`ID_ILU_EMERG`),
  KEY `FK_EDIFICACOES_4` (`ID_RISCO`),
  KEY `FK_EDIFICACOES_5` (`ID_TP_CONSTRUCAO`),
  KEY `FK_EDIFICACOES_6` (`ID_OCUPACAO`),
  KEY `FK_EDIFICACOES_7` (`ID_SITUACAO`),
  KEY `FK_EDIFICACOES_8` (`ID_ADUCAO`),
  KEY `FK_EDIFICACOES_9` (`ID_TP_INSTALACAO`),
  KEY `FK_EDIFICACOES_10` (`ID_TP_PARA_RAIO`),
  KEY `FK_EDIFICACOES_11` (`ID_TP_RECIPIENTE`),
  KEY `FK_SOLICITACAO_12` (`ID_TP_LOGRADOURO`),
  KEY `FK_SOLICITACAO_13` (`ID_USUARIO`),
  KEY `FK_SOLICITACAO_14` (`ID_CEP`,`ID_LOGRADOURO`,`ID_CIDADE_CEP`),
  CONSTRAINT `FK_EDIFICACOES_1` FOREIGN KEY (`ID_CIDADE`) REFERENCES `CADASTROS`.`CIDADE` (`ID_CIDADE`) ON UPDATE CASCADE,
  CONSTRAINT `FK_EDIFICACOES_10` FOREIGN KEY (`ID_TP_PARA_RAIO`) REFERENCES `CADASTROS`.`TP_PARA_RAIO` (`ID_TP_PARA_RAIO`) ON UPDATE CASCADE,
  CONSTRAINT `FK_EDIFICACOES_11` FOREIGN KEY (`ID_TP_RECIPIENTE`) REFERENCES `CADASTROS`.`TP_RECIPIENTE` (`ID_TP_RECIPIENTE`) ON UPDATE CASCADE,
  CONSTRAINT `FK_EDIFICACOES_3` FOREIGN KEY (`ID_ILU_EMERG`) REFERENCES `CADASTROS`.`TP_ILU_EMER` (`ID_ILU_EMERG`) ON UPDATE CASCADE,
  CONSTRAINT `FK_EDIFICACOES_4` FOREIGN KEY (`ID_RISCO`) REFERENCES `CADASTROS`.`TP_RISCO` (`ID_RISCO`) ON UPDATE CASCADE,
  CONSTRAINT `FK_EDIFICACOES_5` FOREIGN KEY (`ID_TP_CONSTRUCAO`) REFERENCES `CADASTROS`.`TP_CONSTRUCAO` (`ID_TP_CONSTRUCAO`) ON UPDATE CASCADE,
  CONSTRAINT `FK_EDIFICACOES_6` FOREIGN KEY (`ID_OCUPACAO`) REFERENCES `CADASTROS`.`TP_OCUPACAO` (`ID_OCUPACAO`) ON UPDATE CASCADE,
  CONSTRAINT `FK_EDIFICACOES_7` FOREIGN KEY (`ID_SITUACAO`) REFERENCES `CADASTROS`.`TP_SITUACAO` (`ID_SITUACAO`) ON UPDATE CASCADE,
  CONSTRAINT `FK_EDIFICACOES_8` FOREIGN KEY (`ID_ADUCAO`) REFERENCES `CADASTROS`.`TP_ADUCAO` (`ID_ADUCAO`) ON UPDATE CASCADE,
  CONSTRAINT `FK_EDIFICACOES_9` FOREIGN KEY (`ID_TP_INSTALACAO`) REFERENCES `CADASTROS`.`TP_INSTALACAO` (`ID_TP_INSTALACAO`) ON UPDATE CASCADE,
  CONSTRAINT `FK_SOLICITACAO_12` FOREIGN KEY (`ID_TP_LOGRADOURO`) REFERENCES `CADASTROS`.`TP_LOGRADOURO` (`ID_TP_LOGRADOURO`) ON UPDATE CASCADE,
  CONSTRAINT `FK_SOLICITACAO_13` FOREIGN KEY (`ID_USUARIO`) REFERENCES `ACESSOS`.`USUARIO` (`ID_USUARIO`) ON UPDATE CASCADE,
  CONSTRAINT `FK_SOLICITACAO_14` FOREIGN KEY (`ID_CEP`, `ID_LOGRADOURO`, `ID_CIDADE_CEP`) REFERENCES `CADASTROS`.`CEP` (`ID_CEP`, `ID_LOGRADOURO`, `ID_CIDADE`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_SOLICITACAO_2` FOREIGN KEY (`ID_TP_ALARME_INCENDIO`) REFERENCES `CADASTROS`.`TP_ALARME_INCENDIO` (`ID_TP_ALARME_INCENDIO`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SOLICITACAO`
--

LOCK TABLES `SOLICITACAO` WRITE;
/*!40000 ALTER TABLE `SOLICITACAO` DISABLE KEYS */;
/*!40000 ALTER TABLE `SOLICITACAO` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `SOLIC_FUNCIONAMENTO`
--

DROP TABLE IF EXISTS `SOLIC_FUNCIONAMENTO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SOLIC_FUNCIONAMENTO` (
  `ID_CIDADE` int(11) NOT NULL,
  `ID_SOLIC_FUNC` int(11) NOT NULL AUTO_INCREMENT,
  `ID_TP_FUNC` enum('S','P','J') NOT NULL,
  `CH_PAGO` enum('S','N') NOT NULL DEFAULT 'N',
  `CH_TP_FUNC` enum('T','P') NOT NULL DEFAULT 'T',
  `ID_PROT_JUNTA_COMERCIAL` int(11) DEFAULT NULL,
  `NR_CNPJ_EMPRESA` varchar(14) NOT NULL,
  `NM_RAZAO_SOCIAL` varchar(100) NOT NULL,
  `NM_FANTASIA_EMPRESA` varchar(100) NOT NULL,
  `NM_CONTATO` varchar(100) NOT NULL,
  `NR_FONE_EMPRESA` int(12) NOT NULL,
  `DE_EMAIL_EMPRESA` varchar(200) NOT NULL,
  `NR_CNPJ_CPF_PROPRIETARIO` varchar(14) NOT NULL,
  `NM_PROPRIETARIO` varchar(100) NOT NULL,
  `NR_FONE_PROPRIETARIO` int(12) DEFAULT NULL,
  `DE_EMAIL_PROPRIETARIO` varchar(200) DEFAULT NULL,
  `NM_EDIFICACOES` varchar(100) NOT NULL,
  `NM_FANTASIA` varchar(100) DEFAULT NULL,
  `ID_TP_LOGRADOURO` int(11) NOT NULL,
  `NM_LOGRADOURO` varchar(100) NOT NULL,
  `NR_EDIFICACOES` int(11) DEFAULT NULL,
  `ID_CEP` int(11) DEFAULT NULL,
  `ID_LOGRADOURO` int(11) DEFAULT NULL,
  `ID_CIDADE_CEP` int(11) DEFAULT NULL,
  `NR_CEP` int(8) DEFAULT NULL,
  `NM_BAIRRO` varchar(50) NOT NULL,
  `NM_COMPLEMENTO` varchar(50) DEFAULT NULL,
  `VL_AREA_CONSTRUIDA` decimal(17,2) NOT NULL,
  `CH_PROTOCOLADO` enum('S','P','V') NOT NULL,
  `DT_SOLICITACAO` date NOT NULL,
  `CH_AGUARDO_LOGRADOURO` enum('S','N') NOT NULL DEFAULT 'N',
  `DT_AGUARDO_LOGRADOURO` date DEFAULT NULL,
  `ID_USUARIO` varchar(20) DEFAULT NULL,
  `ID_RISCO` int(11) NOT NULL,
  `ID_TP_CONSTRUCAO` int(11) NOT NULL,
  `ID_OCUPACAO` int(11) NOT NULL,
  `ID_SITUACAO` int(11) NOT NULL,
  `NR_PAVIMENTOS` int(11) NOT NULL DEFAULT '1',
  `NR_BLOCOS` int(11) NOT NULL DEFAULT '1',
  `DATA_INICIAL` date DEFAULT NULL,
  `DATA_FINAL` date DEFAULT NULL,
  `PROTOCOLO_REGIN` varchar(20) DEFAULT NULL,
  `ID_LOGRADOURO_ANTIGO` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_SOLIC_FUNC`,`ID_CIDADE`,`ID_TP_FUNC`),
  KEY `IX_SOLIC_FUNCIONAMENTO_1` (`CH_PAGO`),
  KEY `IX_SOLIC_FUNCIONAMENTO_2` (`CH_TP_FUNC`),
  KEY `IX_SOLIC_FUNCIONAMENTO_3` (`DT_SOLICITACAO`),
  KEY `IX_SOLIC_FUNCIONAMENTO_4` (`CH_PROTOCOLADO`),
  KEY `FK_SOLIC_FUNCIONAMENTO_1` (`ID_CIDADE`),
  KEY `FK_SOLIC_FUNCIONAMENTO_2` (`ID_CEP`,`ID_LOGRADOURO`,`ID_CIDADE_CEP`),
  KEY `FK_SOLIC_FUNCIONAMENTO_3` (`ID_USUARIO`),
  KEY `FK_SOLIC_FUNCIONAMENTO_4` (`ID_TP_LOGRADOURO`),
  KEY `FK_SOLIC_FUNCIONAMENTO_5` (`ID_RISCO`),
  KEY `FK_SOLIC_FUNCIONAMENTO_6` (`ID_TP_CONSTRUCAO`),
  KEY `FK_SOLIC_FUNCIONAMENTO_7` (`ID_OCUPACAO`),
  KEY `FK_SOLIC_FUNCIONAMENTO_8` (`ID_SITUACAO`),
  CONSTRAINT `FK_SOLIC_FUNCIONAMENTO_1` FOREIGN KEY (`ID_CIDADE`) REFERENCES `CADASTROS`.`CIDADE` (`ID_CIDADE`) ON UPDATE CASCADE,
  CONSTRAINT `FK_SOLIC_FUNCIONAMENTO_2` FOREIGN KEY (`ID_CEP`, `ID_LOGRADOURO`, `ID_CIDADE_CEP`) REFERENCES `CADASTROS`.`CEP` (`ID_CEP`, `ID_LOGRADOURO`, `ID_CIDADE`) ON UPDATE CASCADE,
  CONSTRAINT `FK_SOLIC_FUNCIONAMENTO_3` FOREIGN KEY (`ID_USUARIO`) REFERENCES `ACESSOS`.`USUARIO` (`ID_USUARIO`) ON UPDATE CASCADE,
  CONSTRAINT `FK_SOLIC_FUNCIONAMENTO_4` FOREIGN KEY (`ID_TP_LOGRADOURO`) REFERENCES `CADASTROS`.`TP_LOGRADOURO` (`ID_TP_LOGRADOURO`) ON UPDATE CASCADE,
  CONSTRAINT `FK_SOLIC_FUNCIONAMENTO_5` FOREIGN KEY (`ID_RISCO`) REFERENCES `CADASTROS`.`TP_RISCO` (`ID_RISCO`) ON UPDATE CASCADE,
  CONSTRAINT `FK_SOLIC_FUNCIONAMENTO_6` FOREIGN KEY (`ID_TP_CONSTRUCAO`) REFERENCES `CADASTROS`.`TP_CONSTRUCAO` (`ID_TP_CONSTRUCAO`) ON UPDATE CASCADE,
  CONSTRAINT `FK_SOLIC_FUNCIONAMENTO_7` FOREIGN KEY (`ID_OCUPACAO`) REFERENCES `CADASTROS`.`TP_OCUPACAO` (`ID_OCUPACAO`) ON UPDATE CASCADE,
  CONSTRAINT `FK_SOLIC_FUNCIONAMENTO_8` FOREIGN KEY (`ID_SITUACAO`) REFERENCES `CADASTROS`.`TP_SITUACAO` (`ID_SITUACAO`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SOLIC_FUNCIONAMENTO`
--

LOCK TABLES `SOLIC_FUNCIONAMENTO` WRITE;
/*!40000 ALTER TABLE `SOLIC_FUNCIONAMENTO` DISABLE KEYS */;
INSERT INTO `SOLIC_FUNCIONAMENTO` VALUES (8105,1,'P','N','T',NULL,'03193466921','EMPRESAS LTDA','EMPRESAS','CARLOS',99998000,'carlos@email.com.br','03193466921','EMPRESAS LTDA',99998000,'carlos@email.com.br','PLAZA EMPRESAS','PLAZA EMPRESAS',208,'ANA MARIA BITENCOURT',1234,NULL,NULL,NULL,88047000,'CENTRO',NULL,'4000.00','V','2010-06-15','S','2010-06-15','carlos',1,1,8,1,1,1,NULL,NULL,NULL,NULL),(8105,2,'P','N','P',NULL,'03193466921','ESTACIONAMENTOS','ESTACIONAMENTOS','CARLOS',99998000,'carlos@email.com.br','03193466921','ESTACIONAMENTOS',99998000,'carlos@email.com.br','PLAZA EMPRESAS','PLAZA EMPRESAS',208,'ANA MARIA BITENCOURT',100,88047000,1,8105,88047000,'CENTRO',NULL,'1234.00','V','2010-06-17','N','2010-06-17','carlos',1,1,8,1,1,1,NULL,NULL,NULL,NULL),(8105,3,'P','N','T',NULL,'03193466921','EMPRESAS LTDA','EMPRESAS','CARLOS',99998000,'carlos@email.com.br','03193466921','EMPRESAS LTDA',99998000,'carlos@email.com.br','PLAZA EMPRESAS','EMPRESAS',208,'ANA MARIA BITENCOURT',1234,88047000,1,8105,88047000,'CENTRO',NULL,'4000.00','V','2010-06-18','N','2010-06-18','carlos',1,1,8,1,1,1,NULL,NULL,NULL,NULL),(8105,4,'P','N','T',NULL,'03193466921','EMPRESAS LTDA','EMPRESAS','CARLOS',99998000,'carlos@email.com.br','03193466921','EMPRESAS LTDA',99998000,'carlos@email.com.br','PLAZA EMPRESAS','EMPRESAS',208,'ANA MARIA BITENCOURT',1234,88047000,1,8105,88047000,'CENTRO',NULL,'4000.00','V','2010-06-18','N','2010-06-18','carlos',1,1,8,1,1,1,NULL,NULL,NULL,NULL),(8105,5,'P','N','T',NULL,'03193466921','ESTACIONAMENTOS','ESTACIONAMENTOS','CARLOS',99998000,'carlos@email.com.br','03193466921','ESTACIONAMENTOS',99998000,'carlos@email.com.br','PLAZA EMPRESAS','ESTACIONAMENTOS',208,'ANA MARIA BITENCOURT',100,88047000,1,8105,88047000,'CENTRO',NULL,'1234.00','P','2010-06-18','N','2010-06-18','carlos',1,1,8,1,1,1,NULL,NULL,NULL,NULL),(8105,6,'P','N','T',NULL,'03193466921','EMPRESAS LTDA','EMPRESAS','CARLOS',99998000,'carlos@email.com.br','03193466921','EMPRESAS LTDA',99998000,'carlos@email.com.br','PLAZA EMPRESAS','EMPRESAS',208,'ANA MARIA BITENCOURT',1234,88047000,1,8105,88047000,'CENTRO',NULL,'4000.00','P','2010-06-18','N','2010-06-18','carlos',1,1,8,1,1,1,NULL,NULL,NULL,NULL),(8105,7,'P','N','T',NULL,'03193466921','EMPRESAS LTDA','EMPRESAS','CARLOS',99998000,'carlos@email.com.br','03193466921','EMPRESAS LTDA',99998000,'carlos@email.com.br','PLAZA EMPRESAS','EMPRESAS',208,'ANA MARIA BITENCOURT',1234,NULL,NULL,NULL,88047000,'CENTRO',NULL,'4000.00','P','2010-06-18','S','2010-06-18','carlos',1,1,8,1,1,1,NULL,NULL,NULL,NULL),(8105,8,'P','N','T',NULL,'03193466921','EMPRESAS LTDA','EMPRESAS','CARLOS',99998000,'carlos@email.com.br','03193466921','EMPRESAS LTDA',99998000,'carlos@email.com.br','PLAZA EMPRESAS','EMPRESAS',208,'ANA MARIA BITENCOURT',1234,88047000,1,8105,88047000,'CENTRO',NULL,'4000.00','P','2010-06-18','N','2010-06-18','carlos',1,1,8,1,1,1,NULL,NULL,NULL,NULL),(8105,9,'P','N','T',NULL,'03193466921','ESTACIONAMENTOS','ESTACIONAMENTOS','CARLOS',99998000,'carlos@email.com.br','03193466921','ESTACIONAMENTOS',99998000,'carlos@email.com.br','PLAZA EMPRESAS','ESTACIONAMENTOS',208,'ANA MARIA BITENCOURT',100,88047000,1,8105,88047000,'CENTRO',NULL,'1234.00','P','2010-06-18','N','2010-06-18','carlos',1,1,8,1,1,1,NULL,NULL,NULL,NULL),(8105,10,'P','N','T',NULL,'03193466921','EMPRESAS LTDA','EMPRESAS','CARLOS',99998000,'carlos@email.com.br','03193466921','EMPRESAS LTDA',99998000,'carlos@email.com.br','PLAZA EMPRESAS','EMPRESAS',208,'ANA MARIA BITENCOURT',1234,88047000,1,8105,88047000,'CENTRO',NULL,'4000.00','P','2010-06-18','N','2010-06-18','carlos',1,1,8,1,1,1,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `SOLIC_FUNCIONAMENTO` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `SOLIC_HABITESE`
--

DROP TABLE IF EXISTS `SOLIC_HABITESE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SOLIC_HABITESE` (
  `ID_CIDADE` int(11) NOT NULL,
  `ID_SOLIC_HABITESE` int(11) NOT NULL AUTO_INCREMENT,
  `ID_TP_HABITESE` enum('S','H') NOT NULL,
  `CH_PAGO` enum('S','N') NOT NULL DEFAULT 'N',
  `CH_TP_HABITESE` enum('T','P') NOT NULL DEFAULT 'T',
  `ID_PROTOCOLO` int(11) NOT NULL,
  `ID_CIDADE_PROTOCOLO` int(11) NOT NULL,
  `NR_CNPJ_CPF_SOLICITANTE` varchar(14) NOT NULL,
  `NM_SOLICITANTE` varchar(100) NOT NULL,
  `NR_FONE_SOLICITANTE` int(12) DEFAULT NULL,
  `DE_EMAIL_SOLICITANTE` varchar(200) DEFAULT NULL,
  `NR_CNPJ_CPF_PROPRIETARIO` varchar(14) NOT NULL,
  `NM_PROPRIETARIO` varchar(100) NOT NULL,
  `NR_FONE_PROPRIETARIO` int(12) DEFAULT NULL,
  `DE_EMAIL_PROPRIETARIO` varchar(200) DEFAULT NULL,
  `NM_EDIFICACOES` varchar(100) NOT NULL,
  `NM_FANTASIA` varchar(100) DEFAULT NULL,
  `ID_TP_LOGRADOURO` int(11) NOT NULL,
  `ID_LOGRADOURO` int(11) DEFAULT NULL,
  `NM_LOGRADOURO` varchar(100) NOT NULL,
  `NR_EDIFICACOES` int(11) DEFAULT NULL,
  `ID_CEP` int(11) DEFAULT NULL,
  `ID_CIDADE_CEP` int(11) DEFAULT NULL,
  `NR_CEP` int(8) DEFAULT NULL,
  `NM_BAIRRO` varchar(50) NOT NULL,
  `NM_COMPLEMENTO` varchar(50) DEFAULT NULL,
  `VL_AREA_CONSTRUIDA` decimal(17,2) NOT NULL,
  `NR_CREA_1` varchar(7) NOT NULL,
  `NM_ENGENHEIRO_1` varchar(100) NOT NULL,
  `NR_CREA_2` varchar(7) DEFAULT NULL,
  `NM_ENGENHEIRO_2` varchar(100) DEFAULT NULL,
  `NR_CREA_3` varchar(7) DEFAULT NULL,
  `NM_ENGENHEIRO_3` varchar(100) DEFAULT NULL,
  `CH_PROTOCOLADO` enum('S','P','V') NOT NULL,
  `DT_SOLICITACAO` date NOT NULL,
  `CH_AGUARDO_LOGRADOURO` enum('S','N') NOT NULL DEFAULT 'N',
  `DT_AGUARDO_LOGRADOURO` date DEFAULT NULL,
  `ID_USUARIO` varchar(20) DEFAULT NULL,
  `ID_LOGRADOURO_ANTIGO` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_SOLIC_HABITESE`,`ID_CIDADE`,`ID_TP_HABITESE`),
  KEY `FK_SOLIC_HABITESE_1` (`ID_CIDADE`),
  KEY `FK_SOLIC_HABITESE_2` (`ID_TP_LOGRADOURO`),
  KEY `FK_SOLIC_HABITESE_3` (`ID_CEP`,`ID_LOGRADOURO`,`ID_CIDADE_CEP`),
  KEY `FK_SOLIC_HABITESE_4` (`ID_USUARIO`),
  KEY `FK_SOLIC_HABITESE_5` (`ID_PROTOCOLO`,`ID_CIDADE_PROTOCOLO`),
  CONSTRAINT `FK_SOLIC_HABITESE_1` FOREIGN KEY (`ID_CIDADE`) REFERENCES `CADASTROS`.`CIDADE` (`ID_CIDADE`) ON UPDATE CASCADE,
  CONSTRAINT `FK_SOLIC_HABITESE_2` FOREIGN KEY (`ID_TP_LOGRADOURO`) REFERENCES `CADASTROS`.`TP_LOGRADOURO` (`ID_TP_LOGRADOURO`) ON UPDATE CASCADE,
  CONSTRAINT `FK_SOLIC_HABITESE_3` FOREIGN KEY (`ID_CEP`, `ID_LOGRADOURO`, `ID_CIDADE_CEP`) REFERENCES `CADASTROS`.`CEP` (`ID_CEP`, `ID_LOGRADOURO`, `ID_CIDADE`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_SOLIC_HABITESE_4` FOREIGN KEY (`ID_USUARIO`) REFERENCES `ACESSOS`.`USUARIO` (`ID_USUARIO`) ON UPDATE CASCADE,
  CONSTRAINT `FK_SOLIC_HABITESE_5` FOREIGN KEY (`ID_PROTOCOLO`, `ID_CIDADE_PROTOCOLO`) REFERENCES `PROJETO`.`PROTOCOLOS` (`ID_PROTOCOLO`, `ID_CIDADE`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SOLIC_HABITESE`
--

LOCK TABLES `SOLIC_HABITESE` WRITE;
/*!40000 ALTER TABLE `SOLIC_HABITESE` DISABLE KEYS */;
/*!40000 ALTER TABLE `SOLIC_HABITESE` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `SOLIC_MANUTENCAO`
--

DROP TABLE IF EXISTS `SOLIC_MANUTENCAO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SOLIC_MANUTENCAO` (
  `ID_CIDADE` int(11) NOT NULL,
  `ID_SOLIC_MANUTENCAO` int(11) NOT NULL AUTO_INCREMENT,
  `ID_TP_MANUTENCAO` enum('S','F','J') NOT NULL,
  `CH_PAGO` enum('S','N') NOT NULL DEFAULT 'N',
  `NR_CNPJCPF_SOLICITANTE` varchar(14) NOT NULL,
  `NM_SOLICITANTE` varchar(100) NOT NULL,
  `NR_FONE_SOLICITANTE` int(12) NOT NULL,
  `DE_EMAIL_SOLICITANTE` varchar(200) NOT NULL,
  `NR_CNPJ_CPF_PROPRIETARIO` varchar(14) NOT NULL,
  `NM_PROPRIETARIO` varchar(100) NOT NULL,
  `NR_FONE_PROPRIETARIO` int(12) DEFAULT NULL,
  `DE_EMAIL_PROPRIETARIO` varchar(200) DEFAULT NULL,
  `NM_EDIFICACOES` varchar(100) NOT NULL,
  `NM_FANTASIA` varchar(100) DEFAULT NULL,
  `ID_TP_LOGRADOURO` int(11) DEFAULT NULL,
  `NM_LOGRADOURO` varchar(100) DEFAULT NULL,
  `NR_EDIFICACOES` int(11) DEFAULT NULL,
  `ID_CEP` int(11) DEFAULT NULL,
  `ID_LOGRADOURO` int(11) DEFAULT NULL,
  `ID_CIDADE_CEP` int(11) DEFAULT NULL,
  `NR_CEP` int(8) DEFAULT NULL,
  `NM_BAIRRO` varchar(50) DEFAULT NULL,
  `NM_COMPLEMENTO` varchar(50) DEFAULT NULL,
  `NR_PAVIMENTOS` int(11) DEFAULT '1',
  `NR_BLOCOS` int(11) DEFAULT '1',
  `VL_AREA_CONSTRUIDA` decimal(17,2) NOT NULL,
  `CH_PROTOCOLADO` enum('S','P','V') NOT NULL,
  `DT_SOLICITACAO` date NOT NULL,
  `CH_AGUARDO_LOGRADOURO` enum('S','N') NOT NULL DEFAULT 'N',
  `DT_AGUARDO_LOGRADOURO` date DEFAULT NULL,
  `ID_USUARIO` varchar(20) DEFAULT NULL,
  `ID_RISCO` int(11) DEFAULT NULL,
  `ID_TP_CONSTRUCAO` int(11) DEFAULT NULL,
  `ID_OCUPACAO` int(11) DEFAULT NULL,
  `ID_SITUACAO` int(11) DEFAULT NULL,
  `ID_LOGRADOURO_ANTIGO` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_SOLIC_MANUTENCAO`,`ID_CIDADE`,`ID_TP_MANUTENCAO`),
  KEY `IX_SOLIC_FUNCIONAMENTO_1` (`CH_PAGO`),
  KEY `IX_SOLIC_FUNCIONAMENTO_2` (`DT_SOLICITACAO`),
  KEY `IX_SOLIC_FUNCIONAMENTO_3` (`CH_PROTOCOLADO`),
  KEY `FK_SOLIC_MANUTENCAO_1` (`ID_RISCO`),
  KEY `FK_SOLIC_MANUTENCAO_2` (`ID_TP_CONSTRUCAO`),
  KEY `FK_SOLIC_MANUTENCAO_3` (`ID_OCUPACAO`),
  KEY `FK_SOLIC_MANUTENCAO_4` (`ID_SITUACAO`),
  KEY `FK_SOLIC_MANUTENCAO_5` (`ID_CIDADE`),
  KEY `FK_SOLIC_MANUTENCAO_6` (`ID_CEP`,`ID_LOGRADOURO`,`ID_CIDADE_CEP`),
  KEY `FK_SOLIC_MANUTENCAO_7` (`ID_TP_LOGRADOURO`),
  KEY `FK_SOLIC_MANUTENCAO_8` (`ID_USUARIO`),
  CONSTRAINT `FK_SOLIC_MANUTENCAO_1` FOREIGN KEY (`ID_RISCO`) REFERENCES `CADASTROS`.`TP_RISCO` (`ID_RISCO`) ON UPDATE CASCADE,
  CONSTRAINT `FK_SOLIC_MANUTENCAO_2` FOREIGN KEY (`ID_TP_CONSTRUCAO`) REFERENCES `CADASTROS`.`TP_CONSTRUCAO` (`ID_TP_CONSTRUCAO`) ON UPDATE CASCADE,
  CONSTRAINT `FK_SOLIC_MANUTENCAO_3` FOREIGN KEY (`ID_OCUPACAO`) REFERENCES `CADASTROS`.`TP_OCUPACAO` (`ID_OCUPACAO`) ON UPDATE CASCADE,
  CONSTRAINT `FK_SOLIC_MANUTENCAO_4` FOREIGN KEY (`ID_SITUACAO`) REFERENCES `CADASTROS`.`TP_SITUACAO` (`ID_SITUACAO`) ON UPDATE CASCADE,
  CONSTRAINT `FK_SOLIC_MANUTENCAO_5` FOREIGN KEY (`ID_CIDADE`) REFERENCES `CADASTROS`.`CIDADE` (`ID_CIDADE`) ON UPDATE CASCADE,
  CONSTRAINT `FK_SOLIC_MANUTENCAO_6` FOREIGN KEY (`ID_CEP`, `ID_LOGRADOURO`, `ID_CIDADE_CEP`) REFERENCES `CADASTROS`.`CEP` (`ID_CEP`, `ID_LOGRADOURO`, `ID_CIDADE`) ON UPDATE CASCADE,
  CONSTRAINT `FK_SOLIC_MANUTENCAO_7` FOREIGN KEY (`ID_TP_LOGRADOURO`) REFERENCES `CADASTROS`.`TP_LOGRADOURO` (`ID_TP_LOGRADOURO`) ON UPDATE CASCADE,
  CONSTRAINT `FK_SOLIC_MANUTENCAO_8` FOREIGN KEY (`ID_USUARIO`) REFERENCES `ACESSOS`.`USUARIO` (`ID_USUARIO`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SOLIC_MANUTENCAO`
--

LOCK TABLES `SOLIC_MANUTENCAO` WRITE;
/*!40000 ALTER TABLE `SOLIC_MANUTENCAO` DISABLE KEYS */;
/*!40000 ALTER TABLE `SOLIC_MANUTENCAO` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Current Database: `logs_old`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `logs_old` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `logs_old`;

--
-- Current Database: `mysql`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `mysql` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `mysql`;

--
-- Table structure for table `columns_priv`
--

DROP TABLE IF EXISTS `columns_priv`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `columns_priv` (
  `Host` char(60) COLLATE utf8_bin NOT NULL DEFAULT '',
  `Db` char(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `User` char(16) COLLATE utf8_bin NOT NULL DEFAULT '',
  `Table_name` char(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `Column_name` char(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Column_priv` set('Select','Insert','Update','References') CHARACTER SET utf8 NOT NULL DEFAULT '',
  PRIMARY KEY (`Host`,`Db`,`User`,`Table_name`,`Column_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column privileges';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `columns_priv`
--

LOCK TABLES `columns_priv` WRITE;
/*!40000 ALTER TABLE `columns_priv` DISABLE KEYS */;
/*!40000 ALTER TABLE `columns_priv` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db`
--

DROP TABLE IF EXISTS `db`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db` (
  `Host` char(60) COLLATE utf8_bin NOT NULL DEFAULT '',
  `Db` char(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `User` char(16) COLLATE utf8_bin NOT NULL DEFAULT '',
  `Select_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Insert_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Update_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Delete_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Create_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Drop_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Grant_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `References_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Index_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Alter_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Create_tmp_table_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Lock_tables_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Create_view_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Show_view_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Create_routine_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Alter_routine_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Execute_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  PRIMARY KEY (`Host`,`Db`,`User`),
  KEY `User` (`User`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Database privileges';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db`
--

LOCK TABLES `db` WRITE;
/*!40000 ALTER TABLE `db` DISABLE KEYS */;
/*!40000 ALTER TABLE `db` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event`
--

DROP TABLE IF EXISTS `event`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `event` (
  `db` char(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `name` char(64) NOT NULL DEFAULT '',
  `body` longblob NOT NULL,
  `definer` char(77) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `execute_at` datetime DEFAULT NULL,
  `interval_value` int(11) DEFAULT NULL,
  `interval_field` enum('YEAR','QUARTER','MONTH','DAY','HOUR','MINUTE','WEEK','SECOND','MICROSECOND','YEAR_MONTH','DAY_HOUR','DAY_MINUTE','DAY_SECOND','HOUR_MINUTE','HOUR_SECOND','MINUTE_SECOND','DAY_MICROSECOND','HOUR_MICROSECOND','MINUTE_MICROSECOND','SECOND_MICROSECOND') DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_executed` datetime DEFAULT NULL,
  `starts` datetime DEFAULT NULL,
  `ends` datetime DEFAULT NULL,
  `status` enum('ENABLED','DISABLED','SLAVESIDE_DISABLED') NOT NULL DEFAULT 'ENABLED',
  `on_completion` enum('DROP','PRESERVE') NOT NULL DEFAULT 'DROP',
  `sql_mode` set('REAL_AS_FLOAT','PIPES_AS_CONCAT','ANSI_QUOTES','IGNORE_SPACE','NOT_USED','ONLY_FULL_GROUP_BY','NO_UNSIGNED_SUBTRACTION','NO_DIR_IN_CREATE','POSTGRESQL','ORACLE','MSSQL','DB2','MAXDB','NO_KEY_OPTIONS','NO_TABLE_OPTIONS','NO_FIELD_OPTIONS','MYSQL323','MYSQL40','ANSI','NO_AUTO_VALUE_ON_ZERO','NO_BACKSLASH_ESCAPES','STRICT_TRANS_TABLES','STRICT_ALL_TABLES','NO_ZERO_IN_DATE','NO_ZERO_DATE','INVALID_DATES','ERROR_FOR_DIVISION_BY_ZERO','TRADITIONAL','NO_AUTO_CREATE_USER','HIGH_NOT_PRECEDENCE','NO_ENGINE_SUBSTITUTION','PAD_CHAR_TO_FULL_LENGTH') NOT NULL DEFAULT '',
  `comment` char(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `originator` int(10) unsigned NOT NULL,
  `time_zone` char(64) CHARACTER SET latin1 NOT NULL DEFAULT 'SYSTEM',
  `character_set_client` char(32) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `collation_connection` char(32) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `db_collation` char(32) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `body_utf8` longblob,
  PRIMARY KEY (`db`,`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Events';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `func`
--

DROP TABLE IF EXISTS `func`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `func` (
  `name` char(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `ret` tinyint(1) NOT NULL DEFAULT '0',
  `dl` char(128) COLLATE utf8_bin NOT NULL DEFAULT '',
  `type` enum('function','aggregate') CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User defined functions';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `func`
--

LOCK TABLES `func` WRITE;
/*!40000 ALTER TABLE `func` DISABLE KEYS */;
/*!40000 ALTER TABLE `func` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `help_category`
--

DROP TABLE IF EXISTS `help_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `help_category` (
  `help_category_id` smallint(5) unsigned NOT NULL,
  `name` char(64) NOT NULL,
  `parent_category_id` smallint(5) unsigned DEFAULT NULL,
  `url` char(128) NOT NULL,
  PRIMARY KEY (`help_category_id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='help categories';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `help_category`
--

LOCK TABLES `help_category` WRITE;
/*!40000 ALTER TABLE `help_category` DISABLE KEYS */;
INSERT INTO `help_category` VALUES (0,'Polygon properties',24,''),(1,'Column Types',15,''),(2,'Geometry constructors',24,''),(3,'WKT',24,''),(4,'Numeric Functions',22,''),(5,'GeometryCollection properties',24,''),(6,'Data Manipulation',15,''),(7,'Administration',15,''),(8,'MBR',24,''),(9,'Control flow functions',22,''),(10,'Transactions',15,''),(11,'Geometry relations',24,''),(12,'Functions and Modifiers for Use with GROUP BY Clauses',22,''),(13,'WKB',24,''),(14,'Date and Time Functions',22,''),(15,'Contents',0,''),(16,'Point properties',24,''),(17,'Encryption Functions',22,''),(18,'LineString properties',24,''),(19,'Geometry properties',24,''),(20,'Logical operators',22,''),(21,'Miscellaneous Functions',22,''),(22,'Functions',15,''),(23,'String Functions',22,''),(24,'Geographic features',15,''),(25,'Information Functions',22,''),(26,'Comparison operators',22,''),(27,'Bit Functions',22,''),(28,'Data Definition',15,'');
/*!40000 ALTER TABLE `help_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `help_keyword`
--

DROP TABLE IF EXISTS `help_keyword`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `help_keyword` (
  `help_keyword_id` int(10) unsigned NOT NULL,
  `name` char(64) NOT NULL,
  PRIMARY KEY (`help_keyword_id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='help keywords';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `help_keyword`
--

LOCK TABLES `help_keyword` WRITE;
/*!40000 ALTER TABLE `help_keyword` DISABLE KEYS */;
INSERT INTO `help_keyword` VALUES (0,'MIN'),(1,'JOIN'),(2,'SERIALIZABLE'),(3,'REPLACE'),(4,'RETURNS'),(5,'MASTER_SSL_CA'),(6,'NCHAR'),(7,'COLUMNS'),(8,'WORK'),(9,'DATETIME'),(10,'MODE'),(11,'OPEN'),(12,'INTEGER'),(13,'ESCAPE'),(14,'VALUE'),(15,'GEOMETRYCOLLECTIONFROMWKB'),(16,'DROP'),(17,'SQL_BIG_RESULT'),(18,'EVENTS'),(19,'MONTH'),(20,'REGEXP'),(21,'DUPLICATE'),(22,'LINESTRINGFROMTEXT.'),(23,'UNLOCK'),(24,'INNODB'),(25,'YEAR_MONTH'),(26,'LOCK'),(27,'NDB'),(28,'CHECK'),(29,'FULL'),(30,'INT4'),(31,'BY'),(32,'NO'),(33,'MINUTE'),(34,'DATA'),(35,'DAY'),(36,'RAID_CHUNKSIZE'),(37,'SHARE'),(38,'REAL'),(39,'SEPARATOR'),(40,'DELETE'),(41,'ON'),(42,'CHANGED'),(43,'CLOSE'),(44,'USE'),(45,'WHERE'),(46,'SPATIAL'),(47,'SQL_BUFFER_RESULT'),(48,'IGNORE'),(49,'QUICK'),(50,'SIGNED'),(51,'FALSE'),(52,'POLYGONFROMWKB'),(53,'NDBCLUSTER'),(54,'LEVEL'),(55,'FORCE'),(56,'BINARY'),(57,'TO'),(58,'CHANGE'),(59,'HOUR_MINUTE'),(60,'UPDATE'),(61,'INTO'),(62,'FEDERATED'),(63,'VARYING'),(64,'HOUR_SECOND'),(65,'VARIABLE'),(66,'ROLLBACK'),(67,'MAX'),(68,'RTREE'),(69,'PROCEDURE'),(70,'TIMESTAMP'),(71,'IMPORT'),(72,'AGAINST'),(73,'CHECKSUM'),(74,'INSERT'),(75,'COUNT'),(76,'LONGBINARY'),(77,'THEN'),(78,'ENGINES'),(79,'DAY_SECOND'),(80,'EXISTS'),(81,'BOOLEAN'),(82,'DEFAULT'),(83,'MOD'),(84,'TYPE'),(85,'NO_WRITE_TO_BINLOG'),(86,'RESET'),(87,'BIGINT'),(88,'SET'),(89,'DATE'),(90,'STATUS'),(91,'FULLTEXT'),(92,'COMMENT'),(93,'MASTER_CONNECT_RETRY'),(94,'INNER'),(95,'STOP'),(96,'MASTER_LOG_FILE'),(97,'MRG_MYISAM'),(98,'PRECISION'),(99,'TRAILING'),(100,'LONG'),(101,'ELSE'),(102,'IO_THREAD'),(103,'FROM'),(104,'READ'),(105,'LEFT'),(106,'MINUTE_SECOND'),(107,'COMPACT'),(108,'DEC'),(109,'FOR'),(110,'WARNINGS'),(111,'MIN_ROWS'),(112,'STRING'),(113,'FUNCTION'),(114,'ENCLOSED'),(115,'AGGREGATE'),(116,'FIELDS'),(117,'INT3'),(118,'ARCHIVE'),(119,'AVG_ROW_LENGTH'),(120,'ADD'),(121,'FLOAT4'),(122,'STRIPED'),(123,'VIEW'),(124,'REPEATABLE'),(125,'INFILE'),(126,'ORDER'),(127,'USING'),(128,'MIDDLEINT'),(129,'UNSIGNED'),(130,'GEOMETRYFROMTEXT'),(131,'INDEXES'),(132,'FOREIGN'),(133,'CACHE'),(134,'HOSTS'),(135,'COMMIT'),(136,'SCHEMAS'),(137,'LEADING'),(138,'LOAD'),(139,'SQL_CACHE'),(140,'CONVERT'),(141,'DYNAMIC'),(142,'POLYGONFROMTEXT'),(143,'BYTE'),(144,'LINESTRINGFROMWKB'),(145,'GLOBAL'),(146,'BERKELEYDB'),(147,'WHEN'),(148,'HAVING'),(149,'AS'),(150,'STARTING'),(151,'AUTOCOMMIT'),(152,'GRANTS'),(153,'OUTER'),(154,'FLOOR'),(155,'AFTER'),(156,'STD'),(157,'DISABLE'),(158,'CSV'),(159,'OUTFILE'),(160,'LOW_PRIORITY'),(161,'BDB'),(162,'SCHEMA'),(163,'SONAME'),(164,'POW'),(165,'MULTIPOINTFROMWKB'),(166,'INDEX'),(167,'MULTIPOINTFROMTEXT'),(168,'BACKUP'),(169,'MULTILINESTRINGFROMWKB'),(170,'EXTENDED'),(171,'CROSS'),(172,'NATIONAL'),(173,'GROUP'),(174,'ZEROFILL'),(175,'MASTER_PASSWORD'),(176,'RELAY_LOG_FILE'),(177,'TRUE'),(178,'CHARACTER'),(179,'MASTER_USER'),(180,'ENGINE'),(181,'TABLE'),(182,'INSERT_METHOD'),(183,'CASCADE'),(184,'RELAY_LOG_POS'),(185,'SQL_CALC_FOUND_ROWS'),(186,'MYISAM'),(187,'MODIFY'),(188,'MATCH'),(189,'MASTER_LOG_POS'),(190,'DESC'),(191,'DISTINCTROW'),(192,'TIME'),(193,'NUMERIC'),(194,'GEOMETRYCOLLECTIONFROMTEXT'),(195,'RAID_CHUNKS'),(196,'FLUSH'),(197,'CREATE'),(198,'ISAM'),(199,'INT2'),(200,'PROCESSLIST'),(201,'LOGS'),(202,'HEAP'),(203,'SOUNDS'),(204,'BETWEEN'),(205,'MULTILINESTRINGFROMTEXT'),(206,'PACK_KEYS'),(207,'VALUES'),(208,'FAST'),(209,'VARCHARACTER'),(210,'SHOW'),(211,'ALL'),(212,'REDUNDANT'),(213,'USER_RESOURCES'),(214,'PARTIAL'),(215,'BINLOG'),(216,'END'),(217,'SECOND'),(218,'AND'),(219,'FLOAT8'),(220,'PREV'),(221,'HOUR'),(222,'SELECT'),(223,'DATABASES'),(224,'OR'),(225,'MASTER_SSL_CIPHER'),(226,'SQL_SLAVE_SKIP_COUNTER'),(227,'BOTH'),(228,'BOOL'),(229,'YEAR'),(230,'MASTER_PORT'),(231,'CONCURRENT'),(232,'UNIQUE'),(233,'MASTER_SSL'),(234,'DATE_ADD'),(235,'LIKE'),(236,'IN'),(237,'COLUMN'),(238,'DUMPFILE'),(239,'MEMORY'),(240,'CEIL'),(241,'QUERY'),(242,'MASTER_HOST'),(243,'LINES'),(244,'SQL_THREAD'),(245,'MULTIPOLYGONFROMWKB'),(246,'MASTER_SSL_CERT'),(247,'DAY_MINUTE'),(248,'TRANSACTION'),(249,'DATE_SUB'),(250,'GEOMETRYFROMWKB'),(251,'INT1'),(252,'RENAME'),(253,'RIGHT'),(254,'ALTER'),(255,'MAX_ROWS'),(256,'STRAIGHT_JOIN'),(257,'NATURAL'),(258,'VARIABLES'),(259,'ESCAPED'),(260,'SHA1'),(261,'RAID_TYPE'),(262,'CHAR'),(263,'OFFSET'),(264,'NEXT'),(265,'SQL_LOG_BIN'),(266,'ERRORS'),(267,'TEMPORARY'),(268,'SQL_SMALL_RESULT'),(269,'COMMITTED'),(270,'DELAY_KEY_WRITE'),(271,'BEGIN'),(272,'MEDIUM'),(273,'INTERVAL'),(274,'DAY_HOUR'),(275,'REFERENCES'),(276,'AES_ENCRYPT'),(277,'ISOLATION'),(278,'INT8'),(279,'RESTRICT'),(280,'IS'),(281,'UNCOMMITTED'),(282,'NOT'),(283,'DES_KEY_FILE'),(284,'COMPRESSED'),(285,'START'),(286,'IF'),(287,'SAVEPOINT'),(288,'PRIMARY'),(289,'LAST'),(290,'INNOBASE'),(291,'LIMIT'),(292,'KEYS'),(293,'KEY'),(294,'MERGE'),(295,'SQL_NO_CACHE'),(296,'DELAYED'),(297,'CONSTRAINT'),(298,'SERIAL'),(299,'ACTION'),(300,'WRITE'),(301,'SESSION'),(302,'DATABASE'),(303,'NULL'),(304,'USE_FRM'),(305,'SLAVE'),(306,'TERMINATED'),(307,'ASC'),(308,'OPTIONALLY'),(309,'ENABLE'),(310,'DIRECTORY'),(311,'LOCAL'),(312,'DISTINCT'),(313,'MASTER_SSL_KEY'),(314,'TABLES'),(315,'<>'),(316,'HIGH_PRIORITY'),(317,'BTREE'),(318,'FIRST'),(319,'TYPES'),(320,'MASTER'),(321,'FIXED'),(322,'RAID0'),(323,'MULTIPOLYGONFROMTEXT'),(324,'ROW_FORMAT');
/*!40000 ALTER TABLE `help_keyword` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `help_relation`
--

DROP TABLE IF EXISTS `help_relation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `help_relation` (
  `help_topic_id` int(10) unsigned NOT NULL,
  `help_keyword_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`help_keyword_id`,`help_topic_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='keyword-topic relation';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `help_relation`
--

LOCK TABLES `help_relation` WRITE;
/*!40000 ALTER TABLE `help_relation` DISABLE KEYS */;
INSERT INTO `help_relation` VALUES (377,0),(280,1),(349,2),(329,3),(126,4),(147,5),(335,6),(271,7),(108,8),(298,9),(61,10),(280,10),(77,11),(271,11),(126,12),(394,12),(301,13),(189,14),(79,15),(19,16),(60,16),(126,16),(148,16),(218,16),(366,16),(280,17),(185,18),(20,19),(395,20),(116,21),(39,22),(23,23),(271,24),(369,24),(20,25),(23,26),(280,26),(369,27),(369,28),(271,29),(369,29),(394,30),(34,31),(59,31),(280,31),(286,31),(329,31),(366,31),(369,31),(369,32),(373,32),(20,33),(86,34),(329,34),(369,34),(20,35),(369,36),(280,37),(126,38),(246,38),(286,39),(369,40),(373,40),(0,41),(373,41),(24,42),(77,43),(0,44),(34,45),(59,45),(77,45),(165,46),(366,46),(280,47),(0,48),(59,48),(116,48),(280,48),(329,48),(366,48),(24,49),(34,49),(264,49),(298,50),(304,51),(63,52),(369,53),(349,54),(0,55),(203,56),(235,56),(298,56),(335,56),(147,57),(361,57),(147,58),(366,58),(20,59),(116,60),(280,60),(373,60),(30,61),(116,61),(280,61),(369,62),(203,63),(20,64),(95,65),(108,66),(361,66),(377,67),(165,68),(280,69),(69,70),(149,70),(329,71),(61,72),(369,73),(116,74),(385,74),(338,75),(225,76),(103,77),(271,78),(20,79),(19,80),(118,80),(148,80),(218,80),(15,81),(61,81),(116,82),(189,82),(366,82),(369,82),(136,83),(366,84),(369,84),(258,85),(264,85),(372,85),(25,86),(113,86),(208,86),(173,87),(30,88),(59,88),(108,88),(144,88),(166,88),(366,88),(373,88),(389,88),(20,89),(96,89),(207,89),(298,89),(40,90),(175,90),(271,90),(290,90),(165,91),(366,91),(369,91),(369,92),(147,93),(0,94),(37,95),(147,96),(369,97),(246,98),(357,99),(225,100),(103,101),(37,102),(257,102),(34,103),(86,103),(185,103),(271,103),(280,103),(285,103),(357,103),(23,104),(77,104),(349,104),(0,105),(20,106),(369,107),(163,108),(271,109),(280,109),(271,110),(369,111),(126,112),(126,113),(329,114),(126,115),(271,116),(329,116),(198,117),(369,118),(366,119),(369,119),(42,120),(366,120),(130,121),(369,122),(19,123),(121,123),(349,124),(329,125),(34,126),(59,126),(280,126),(286,126),(366,126),(0,127),(34,127),(198,128),(15,129),(93,129),(130,129),(163,129),(246,129),(298,129),(394,129),(324,130),(271,131),(366,132),(369,132),(373,132),(113,133),(107,134),(271,134),(108,135),(271,136),(357,137),(86,138),(285,138),(329,138),(280,139),(298,140),(369,141),(313,142),(367,143),(353,144),(95,145),(144,145),(349,145),(369,146),(103,147),(280,148),(0,149),(23,149),(280,149),(329,150),(108,151),(271,152),(0,153),(173,154),(366,155),(321,156),(366,157),(329,158),(369,158),(280,159),(23,160),(30,160),(34,160),(59,160),(116,160),(329,160),(369,161),(118,162),(148,162),(166,162),(271,162),(126,163),(382,164),(365,165),(0,166),(42,166),(60,166),(165,166),(271,166),(366,166),(369,166),(332,167),(282,168),(214,169),(24,170),(264,170),(0,171),(203,172),(335,172),(280,173),(15,174),(93,174),(130,174),(163,174),(246,174),(394,174),(147,175),(147,176),(304,177),(166,178),(203,178),(335,178),(147,179),(271,180),(290,180),(366,180),(369,180),(24,181),(42,181),(117,181),(218,181),(264,181),(271,181),(282,181),(285,181),(372,181),(369,182),(19,183),(218,183),(369,183),(373,183),(147,184),(280,185),(369,186),(366,187),(61,188),(147,189),(259,190),(280,190),(286,190),(280,191),(247,192),(297,192),(298,192),(163,193),(193,194),(369,195),(113,196),(42,197),(118,197),(126,197),(165,197),(271,197),(369,197),(369,198),(181,199),(271,200),(235,201),(271,201),(290,201),(369,202),(299,203),(109,204),(78,205),(369,206),(30,207),(24,208),(203,209),(40,210),(107,210),(175,210),(185,210),(235,210),(290,210),(240,211),(280,211),(369,212),(258,213),(369,214),(185,215),(103,216),(20,217),(109,218),(248,218),(246,219),(77,220),(20,221),(30,222),(202,222),(271,223),(102,224),(147,225),(144,226),(357,227),(15,228),(81,228),(20,229),(147,230),(329,231),(366,232),(147,233),(20,234),(271,235),(299,235),(61,236),(185,236),(280,236),(366,237),(280,238),(280,239),(350,240),(113,241),(147,242),(329,243),(37,244),(257,244),(90,245),(147,246),(20,247),(108,248),(349,248),(20,249),(106,250),(15,251),(366,252),(0,253),(42,254),(121,254),(366,254),(369,255),(0,256),(280,256),(0,257),(271,258),(329,259),(224,260),(369,261),(298,262),(367,262),(280,263),(77,264),(389,265),(271,266),(218,267),(280,268),(349,269),(369,270),(108,271),(24,272),(20,273),(20,274),(369,275),(373,275),(391,276),(349,277),(93,278),(19,279),(218,279),(373,279),(292,280),(349,281),(118,282),(244,282),(258,283),(369,284),(108,285),(257,285),(19,286),(118,286),(148,286),(218,286),(361,287),(366,288),(77,289),(369,290),(34,291),(59,291),(77,291),(185,291),(280,291),(271,292),(366,292),(42,293),(116,293),(366,293),(369,293),(373,293),(369,294),(280,295),(30,296),(116,296),(385,296),(366,297),(369,297),(189,298),(369,298),(369,299),(373,299),(23,300),(95,301),(349,301),(118,302),(148,302),(271,302),(292,303),(373,303),(264,304),(25,305),(37,305),(107,305),(175,305),(257,305),(329,306),(280,307),(286,307),(329,308),(366,309),(369,310),(23,311),(258,311),(264,311),(329,311),(372,311),(227,312),(280,312),(286,312),(305,312),(338,312),(377,312),(147,313),(23,314),(271,314),(390,315),(116,316),(280,316),(165,317),(77,318),(366,318),(369,318),(271,319),(40,320),(86,320),(147,320),(208,320),(235,320),(285,320),(163,321),(369,321),(369,322),(156,323),(369,324);
/*!40000 ALTER TABLE `help_relation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `help_topic`
--

DROP TABLE IF EXISTS `help_topic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `help_topic` (
  `help_topic_id` int(10) unsigned NOT NULL,
  `name` char(64) NOT NULL,
  `help_category_id` smallint(5) unsigned NOT NULL,
  `description` text NOT NULL,
  `example` text NOT NULL,
  `url` char(128) NOT NULL,
  PRIMARY KEY (`help_topic_id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='help topics';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `help_topic`
--

LOCK TABLES `help_topic` WRITE;
/*!40000 ALTER TABLE `help_topic` DISABLE KEYS */;
INSERT INTO `help_topic` VALUES (0,'JOIN',6,'MySQL supports the following JOIN syntaxes for the\ntable_references part of SELECT statements and multiple-table\nDELETE and UPDATE statements:\n\ntable_reference, table_reference\ntable_reference [INNER | CROSS] JOIN table_reference [join_condition]\ntable_reference STRAIGHT_JOIN table_reference\ntable_reference LEFT [OUTER] JOIN table_reference join_condition\ntable_reference NATURAL [LEFT [OUTER]] JOIN table_reference\n{ OJ table_reference LEFT OUTER JOIN table_reference\n    ON conditional_expr }\ntable_reference RIGHT [OUTER] JOIN table_reference join_condition\ntable_reference NATURAL [RIGHT [OUTER]] JOIN table_reference\n\ntable_reference is defined as:\n\ntbl_name [[AS] alias]\n    [[USE INDEX (key_list)]\n      | [IGNORE INDEX (key_list)]\n      | [FORCE INDEX (key_list)]]\n\njoin_condition is defined as:\n\nON conditional_expr | USING (column_list)\n','mysql> SELECT table1.* FROM table1\n    ->        LEFT JOIN table2 ON table1.id=table2.id\n    ->        WHERE table2.id IS NULL;',''),(1,'HEX',23,'   HEX(N_or_S)\n\nIf N_OR_S is a number, returns a string representation of the hexadecimal\nvalue of N, where N is a longlong (BIGINT) number.\nThis is equivalent to CONV(N,10,16).\n\nFrom MySQL 4.0.1 and up,\nif N_OR_S is a string, returns a hexadecimal string of N_OR_S\nwhere each character in N_OR_S is converted to two hexadecimal digits.\n','mysql> SELECT HEX(255);\n        -> \'FF\'\nmysql> SELECT 0x616263;\n        -> \'abc\'\nmysql> SELECT HEX(\'abc\');\n        -> 616263',''),(2,'REPLACE',23,'   REPLACE(str,from_str,to_str)\nReturns the string str with all occurrences of the string\nfrom_str replaced by the string to_str.\n','mysql> SELECT REPLACE(\'www.mysql.com\', \'w\', \'Ww\');\n        -> \'WwWwWw.mysql.com\'',''),(3,'REPEAT',23,'   REPEAT(str,count)\nReturns a string consisting of the string str repeated count\ntimes. If count <= 0, returns an empty string. Returns NULL if\nstr or count are NULL.\n','mysql> SELECT REPEAT(\'MySQL\', 3);\n        -> \'MySQLMySQLMySQL\'',''),(4,'CONTAINS',11,'   Contains(g1,g2)\nReturns 1 or 0 to indicate whether or not g1 completely contains\ng2.\n','',''),(5,'SRID',19,'   SRID(g)\nReturns an integer indicating the Spatial Reference System ID for the geometry\nvalue g.\n\nIn MySQL, the SRID value is just an integer associated with the geometry\nvalue. All calculations are done assuming Euclidean (planar) geometry.\n','mysql> SELECT SRID(GeomFromText(\'LineString(1 1,2 2)\',101));\n+-----------------------------------------------+\n| SRID(GeomFromText(\'LineString(1 1,2 2)\',101)) |\n+-----------------------------------------------+\n|                                           101 |\n+-----------------------------------------------+',''),(6,'CURRENT_TIMESTAMP',14,'   CURRENT_TIMESTAMP\n   CURRENT_TIMESTAMP()\n\nCURRENT_TIMESTAMP and CURRENT_TIMESTAMP() are synonyms for\nNOW().\n','',''),(7,'VARIANCE',12,'   VARIANCE(expr)\nReturns the population standard variance of expr.  This is an\nextension to standard SQL, available in MySQL 4.1 or later.  As of MySQL\n5.0.3, the standard SQL function VAR_POP() can be used instead.\n','',''),(8,'VAR_SAMP',12,'   VAR_SAMP(expr)\nReturns the sample variance of expr.  That is, the denominator is the\nnumber of rows minus one.  This function was added in MySQL 5.0.3.\n','',''),(9,'CONCAT',23,'   CONCAT(str1,str2,...)\nReturns the string that results from concatenating the arguments.  Returns\nNULL if any argument is NULL.  May have one or more arguments.\nIf all arguments are non-binary strings, the result is a non-binary string.\nIf the arguments include any binary strings, the result is a binary string.\nA numeric argument is converted to its equivalent binary string form.\n','mysql> SELECT CONCAT(\'My\', \'S\', \'QL\');\n        -> \'MySQL\'\nmysql> SELECT CONCAT(\'My\', NULL, \'QL\');\n        -> NULL\nmysql> SELECT CONCAT(14.3);\n        -> \'14.3\'',''),(10,'GEOMETRY HIERARCHY',24,'Geometry is the base class. It\'s an abstract class.\nThe instantiable subclasses of Geometry are restricted to zero-, one-,\nand two-dimensional geometric objects that exist in\ntwo-dimensional coordinate space. All instantiable geometry classes are\ndefined so that valid instances of a geometry class are topologically closed\n(that is, all defined geometries include their boundary).\n\nThe base Geometry class has subclasses for Point,\nCurve, Surface, and GeometryCollection:\n\n\n --- Point represents zero-dimensional objects.\n\n --- Curve represents one-dimensional objects, and has subclass\nLineString, with sub-subclasses Line and LinearRing.\n\n --- Surface is designed for two-dimensional objects and\nhas subclass Polygon.\n\n --- GeometryCollection\nhas specialized zero-, one-, and two-dimensional collection classes named\nMultiPoint, MultiLineString, and MultiPolygon\nfor modeling geometries corresponding to collections of\nPoints, LineStrings, and Polygons, respectively.\nMultiCurve and MultiSurface are introduced as abstract superclasses\nthat generalize the collection interfaces to handle Curves and Surfaces.\n\n\nGeometry, Curve, Surface, MultiCurve,\nand MultiSurface are defined as non-instantiable classes.\nThey define a common set of methods for their subclasses and\nare included for extensibility.\n\nPoint, LineString, Polygon, GeometryCollection,\nMultiPoint, MultiLineString, and\nMultiPolygon are instantiable classes.\n','',''),(11,'CHAR FUNCTION',23,'   CHAR(N,...)\nCHAR() interprets the arguments as integers and returns a string\nconsisting of the characters given by the code values of those\nintegers. NULL values are skipped.\n','mysql> SELECT CHAR(77,121,83,81,\'76\');\n        -> \'MySQL\'\nmysql> SELECT CHAR(77,77.3,\'77.3\');\n        -> \'MMM\'',''),(12,'DATETIME',1,'A date and time combination.  The supported range is \'1000-01-01\n00:00:00\' to \'9999-12-31 23:59:59\'.  MySQL displays\nDATETIME values in \'YYYY-MM-DD HH:MM:SS\' format, but allows you\nto assign values to DATETIME columns using either strings or numbers.\n','',''),(13,'LOWER',23,'   LOWER(str)\nReturns the string str with all characters changed to lowercase\naccording to the current character set mapping (the default is ISO-8859-1\nLatin1).\n','mysql> SELECT LOWER(\'QUADRATICALLY\');\n        -> \'quadratically\'',''),(14,'MONTH',14,'   MONTH(date)\nReturns the month for date, in the range 1 to 12.\n','mysql> SELECT MONTH(\'1998-02-03\');\n        -> 2',''),(15,'TINYINT',1,'   TINYINT[(M)] [UNSIGNED] [ZEROFILL]\n\nA very small integer. The signed range is -128 to 127. The\nunsigned range is 0 to 255.\n','',''),(16,'ISCLOSED',18,'   IsClosed(ls)\nReturns 1 if the LineString value ls is closed\n(that is, its StartPoint() and EndPoint() values are the same).\nReturns 0 if ls is not closed, and -1 if it is NULL.\n','mysql> SET @ls = \'LineString(1 1,2 2,3 3)\';\nmysql> SELECT IsClosed(GeomFromText(@ls));\n+-----------------------------+\n| IsClosed(GeomFromText(@ls)) |\n+-----------------------------+\n|                           0 |\n+-----------------------------+',''),(17,'MASTER_POS_WAIT',21,'   MASTER_POS_WAIT(log_name,log_pos[,timeout])\n\nThis function is useful for control of master/slave synchronization.\nIt blocks until the slave has read and applied all updates up to the specified\nposition in the master log.\nThe return value is the number of log events it had to wait for to get to\nthe specified position.  The function returns NULL if the slave SQL thread\nis not started, the slave\'s master information is not initialized, the\narguments are incorrect, or an error occurs. It returns -1 if the\ntimeout has been exceeded. If the slave SQL thread stops while\nMASTER_POS_WAIT() is waiting, the function returns NULL.\nIf the slave is past the specified position, the function returns\nimmediately.\n','SELECT MASTER_POS_WAIT(\'master_log_file\', master_log_pos)',''),(18,'^',27,'   ^\nBitwise XOR:\n','mysql> SELECT 1 ^ 1;\n        -> 0\nmysql> SELECT 1 ^ 0;\n        -> 1\nmysql> SELECT 11 ^ 3;\n        -> 8',''),(19,'DROP VIEW',24,'DROP VIEW removes one or more views. You must have the DROP\nprivilege for each view.\n\nYou can use the keywords IF EXISTS to prevent an error from occurring\nfor views that don\'t exist.  When this clause is given, a NOTE is\ngenerated for each non-existent view.\nSee also : [SHOW WARNINGS,  , SHOW WARNINGS].\n\nRESTRICT and CASCADE, if given, are parsed and ignored.\n','DROP VIEW [IF EXISTS]\n    view_name [, view_name] ...\n    [RESTRICT | CASCADE]',''),(20,'DATE OPERATIONS',14,'   DATE_ADD(date,INTERVAL expr type)\n   DATE_SUB(date,INTERVAL expr type)\n\nThese functions perform date arithmetic.\ndate is a DATETIME or DATE value specifying the starting\ndate.  expr is an expression specifying the interval value to be added\nor subtracted from the starting date.  expr is a string; it may start\nwith a \'-\' for negative intervals.  type is a keyword indicating\nhow the expression should be interpreted.\n','mysql> SELECT \'1997-12-31 23:59:59\' + INTERVAL 1 SECOND;\n        -> \'1998-01-01 00:00:00\'\nmysql> SELECT INTERVAL 1 DAY + \'1997-12-31\';\n        -> \'1998-01-01\'\nmysql> SELECT \'1998-01-01\' - INTERVAL 1 SECOND;\n        -> \'1997-12-31 23:59:59\'\nmysql> SELECT DATE_ADD(\'1997-12-31 23:59:59\',\n    ->                 INTERVAL 1 SECOND);\n        -> \'1998-01-01 00:00:00\'\nmysql> SELECT DATE_ADD(\'1997-12-31 23:59:59\',\n    ->                 INTERVAL 1 DAY);\n        -> \'1998-01-01 23:59:59\'\nmysql> SELECT DATE_ADD(\'1997-12-31 23:59:59\',\n    ->                 INTERVAL \'1:1\' MINUTE_SECOND);\n        -> \'1998-01-01 00:01:00\'\nmysql> SELECT DATE_SUB(\'1998-01-01 00:00:00\',\n    ->                 INTERVAL \'1 1:1:1\' DAY_SECOND);\n        -> \'1997-12-30 22:58:59\'\nmysql> SELECT DATE_ADD(\'1998-01-01 00:00:00\',\n    ->                 INTERVAL \'-1 10\' DAY_HOUR);\n        -> \'1997-12-30 14:00:00\'\nmysql> SELECT DATE_SUB(\'1998-01-02\', INTERVAL 31 DAY);\n        -> \'1997-12-02\'\nmysql> SELECT DATE_ADD(\'1992-12-31 23:59:59.000002\',\n    ->            INTERVAL \'1.999999\' SECOND_MICROSECOND);\n        -> \'1993-01-01 00:00:01.000001\'',''),(21,'WITHIN',11,'   Within(g1,g2)\nReturns 1 or 0 to indicate whether or not g1 is spatially within\ng2.\n','',''),(22,'WEEK',14,'   WEEK(date[,mode])\nThe function returns the week number for date.  The two-argument form\nof WEEK() allows you to specify whether the week starts on Sunday or\nMonday and whether the return value should be in the range from 0 to\n53 or from 1 to 53. If the mode argument is\nomitted, the value of the default_week_format system variable is\nused (or 0 before MySQL 4.0.14).\nSee also : [Server system variables].\n\nThe following table describes how the mode argument works:\n\n     	 First day 	 	\n   Mode 	 of week 	 Range 	 Week 1 is the first week...\n   0 	 Sunday 	 0-53 	 with a Sunday in this year\n   1 	 Monday 	 0-53 	 with more than 3 days this year\n   2 	 Sunday 	 1-53 	 with a Sunday in this year\n   3 	 Monday 	 1-53 	 with more than 3 days this year\n   4 	 Sunday 	 0-53 	 with more than 3 days this year\n   5 	 Monday 	 0-53 	 with a Monday in this year\n   6 	 Sunday 	 1-53 	 with more than 3 days this year\n   7 	 Monday 	 1-53 	 with a Monday in this year\n  \n\nA mode value of 3 can be used as of MySQL 4.0.5.\nValues of 4 and above can be used as of MySQL 4.0.17.\n','mysql> SELECT WEEK(\'1998-02-20\');\n        -> 7\nmysql> SELECT WEEK(\'1998-02-20\',0);\n        -> 7\nmysql> SELECT WEEK(\'1998-02-20\',1);\n        -> 8\nmysql> SELECT WEEK(\'1998-12-31\',1);\n        -> 53',''),(23,'LOCK',10,'LOCK TABLES locks tables for the current thread.  If any of the tables\nare locked by other threads, it blocks until all locks can be acquired.\nUNLOCK TABLES releases any locks held by the current thread.\nAll tables that are locked by the current thread are implicitly unlocked\nwhen the thread issues another LOCK TABLES, or when the connection\nto the server is closed.\n\nA table lock protects only against inappropriate reads or writes by other\nclients. The client holding the lock, even a read lock, can perform\ntable-level operations such as DROP TABLE.\n','LOCK TABLES\n    tbl_name [AS alias] {READ [LOCAL] | [LOW_PRIORITY] WRITE}\n    [, tbl_name [AS alias] {READ [LOCAL] | [LOW_PRIORITY] WRITE}] ...\nUNLOCK TABLES',''),(24,'CHECK',7,'Checks a table or tables for errors.  CHECK TABLE works for\nMyISAM and InnoDB tables.  For MyISAM tables, the key statistics are updated.\n\nAs of MySQL 5.0.2, CHECK TABLE also can check views for problems, such\nas tables that are referenced in the view definition that no longer exist.\n','CHECK TABLE tbl_name [, tbl_name] ... [option] ...\n\noption = {QUICK | FAST | MEDIUM | EXTENDED | CHANGED}',''),(25,'RESET SLAVE',7,'RESET SLAVE\n\nMakes the slave forget its replication position in the master\'s binary logs.\nThis statement is meant to be used for a clean start: It deletes the\n*master.info and *relay-log.info files, all the relay logs,\nand starts a new relay log.\n\nNote: All relay logs are deleted, even if they have not been\ntotally executed by the slave SQL thread.  (This is a condition likely to\nexist on a replication slave if you have issued a STOP SLAVE\nstatement or if the slave is highly loaded.)\n\nConnection information stored in the *master.info file is immediately\nreset using any values specified in the corresponding startup options.\nThis information includes values such as master host, master port, master\nuser, and master password.  If the slave SQL thread was in the middle of\nreplicating temporary tables when it was stopped, and RESET SLAVE\nis issued, these replicated temporary tables are deleted on the slave.\n\nThis statement was named FLUSH SLAVE before MySQL 3.23.26.\n','',''),(26,'POLYGON',2,'   Polygon(ls1,ls2,...)\nConstructs a WKB Polygon value from a number of WKB LineString\narguments. If any argument does not represent the WKB of a LinearRing\n(that is, not a closed and simple LineString) the return value\nis NULL.\n','',''),(27,'MINUTE',14,'   MINUTE(time)\nReturns the minute for time, in the range 0 to 59.\n','mysql> SELECT MINUTE(\'98-02-03 10:05:03\');\n        -> 5',''),(28,'DAY',14,'   DAY(date)\n\nDAY() is a synonym for DAYOFMONTH().\nIt is available as of MySQL 4.1.1.\n','',''),(29,'MID',23,'   MID(str,pos,len)\n\nMID(str,pos,len) is a synonym for\nSUBSTRING(str,pos,len).\n','',''),(30,'REPLACE INTO',6,'REPLACE works exactly like INSERT, except that if an old\nrecord in the table has the same value as a new record for a PRIMARY\nKEY or a UNIQUE index, the old record is deleted before the new\nrecord is inserted.\nSee also : [INSERT, ,INSERT].\n\nNote that unless the table has a PRIMARY KEY or UNIQUE index,\nusing a REPLACE statement makes no sense. It becomes equivalent to\nINSERT, because there is no index to be used to determine whether a new\nrow duplicates another.\n\nValues for all columns are taken from the values specified in the\nREPLACE statement.  Any missing columns are set to their default\nvalues, just as happens for INSERT.  You can\'t refer to values from\nthe current row and use them in the new row.  If you use an assignment such\nas SET col_name = col_name + 1, the reference to the\ncolumn name on the right hand side is treated as\nDEFAULT(col_name), so the assignment is equivalent to SET\ncol_name = DEFAULT(col_name) + 1.\n\nTo be able to use REPLACE, you must have INSERT and\nDELETE privileges for the table.\n','REPLACE [LOW_PRIORITY | DELAYED]\n    [INTO] tbl_name [(col_name,...)]\n    VALUES ({expr | DEFAULT},...),(...),...',''),(31,'UUID',21,'   UUID()\n\nReturns a Universal Unique Identifier (UUID) generated\naccording to ``DCE 1.1: Remote Procedure Call\'\' (Appendix A)\nCAE (Common Applications Environment) Specifications\npublished by The Open Group in October 1997 (Document Number C706).\n\nA UUID is designed as a number that is globally unique in space and\ntime. Two calls to UUID() are expected to generate two different\nvalues, even if these calls are performed on two separate computers that are\nnot connected to each other.\n\nA UUID is a 128-bit number represented by a string\nof five hexadecimal numbers in aaaaaaaa-bbbb-cccc-dddd-eeeeeeeeeeee\nformat:\n\n\n --- The first three numbers are generated from a timestamp.\n\n --- The fourth number preserves temporal uniqueness in case the timestamp value loses\nmonotonicity (for example, due to daylight saving time).\n\n --- The fifth number is an IEEE 802 node number that provides spatial uniqueness.  A\nrandom number is substituted if the latter is not available (for example,\nbecause the host computer has no Ethernet card, or we do not know how to\nfind the hardware address of an interface on your operating system).  In\nthis case, spatial uniqueness cannot be guaranteed. Nevertheless, a\ncollision should have /very/ low probability.\n\nCurrently, the MAC address of an interface is taken into account only on\nFreeBSD and Linux. On other operating systems, MySQL uses a randomly generated\n48-bit number.\n','mysql> SELECT UUID();\n        -> \'6ccd780c-baba-1026-9564-0040f4311e29\'',''),(32,'LINESTRING',2,'   LineString(pt1,pt2,...)\nConstructs a WKB LineString value from a number of WKB Point\narguments.  If any argument is not a WKB Point, the return value\nis NULL.  If the number of Point arguments is less than two,\nthe return value is NULL.\n','',''),(33,'CONNECTION_ID',25,'   CONNECTION_ID()\nReturns the connection ID (thread ID) for the connection.\nEvery connection has its own unique ID.\n','mysql> SELECT CONNECTION_ID();\n        -> 23786',''),(34,'DELETE',6,'DELETE deletes rows from tbl_name that satisfy the condition\ngiven by where_definition, and returns the number of records deleted.\n\nIf you issue a DELETE statement with no WHERE clause, all\nrows are deleted.  A faster way to do this, when you don\'t want to know\nthe number of deleted rows, is to use TRUNCATE TABLE.\nSee also : [TRUNCATE,  , TRUNCATE].\n','DELETE [LOW_PRIORITY] [QUICK] [IGNORE] FROM tbl_name\n       [WHERE where_definition]\n       [ORDER BY ...]\n       [LIMIT row_count]',''),(35,'ROUND',4,'   ROUND(X)\n   ROUND(X,D)\nReturns the argument X, rounded to the nearest integer.\nWith two arguments, returns X rounded to D decimals.\nD can be negative to round D digits left of the decimal\npoint of the value X.\n','mysql> SELECT ROUND(-1.23);\n        -> -1\nmysql> SELECT ROUND(-1.58);\n        -> -2\nmysql> SELECT ROUND(1.58);\n        -> 2\nmysql> SELECT ROUND(1.298, 1);\n        -> 1.3\nmysql> SELECT ROUND(1.298, 0);\n        -> 1\nmysql> SELECT ROUND(23.298, -1);\n        -> 20',''),(36,'NULLIF',9,'   NULLIF(expr1,expr2)\nReturns NULL if expr1 = expr2 is true, else returns expr1.\nThis is the same as CASE WHEN expr1 = expr2 THEN NULL ELSE expr1 END.\n','mysql> SELECT NULLIF(1,1);\n        -> NULL\nmysql> SELECT NULLIF(1,2);\n        -> 1',''),(37,'STOP SLAVE',7,'STOP SLAVE [thread_type [, thread_type] ... ]\n\nthread_type: IO_THREAD | SQL_THREAD\n\nStops the slave threads.\nSTOP SLAVE requires the SUPER privilege.\n\nLike START SLAVE, as of MySQL 4.0.2, this statement\nmay be used with the IO_THREAD and SQL_THREAD options to name\nthe thread or threads to stop.\n','',''),(38,'TIMEDIFF',14,'   TIMEDIFF(expr,expr2)\n\n\nTIMEDIFF() returns the time between the start time\nexpr and the end time expr2.\nexpr and expr2 are time or date-and-time expressions, but both\nmust be of the same type.\n','mysql> SELECT TIMEDIFF(\'2000:01:01 00:00:00\',\n    ->                 \'2000:01:01 00:00:00.000001\');\n        -> \'-00:00:00.000001\'\nmysql> SELECT TIMEDIFF(\'1997-12-31 23:59:59.000001\',\n    ->                 \'1997-12-30 01:01:01.000002\');\n        -> \'46:58:57.999999\'',''),(39,'LINEFROMTEXT',3,'   LineFromText(wkt[,srid])\n   LineStringFromText(wkt[,srid])\nConstructs a LINESTRING value using its WKT representation and SRID.\n','',''),(40,'SHOW MASTER STATUS',6,'SHOW MASTER STATUS\n\nProvides status information on the binary log files of the master.\n','',''),(41,'ADDTIME',14,'   ADDTIME(expr,expr2)\n\n\nADDTIME() adds expr2 to expr and returns the result.\nexpr is a time or datetime expression, and expr2 is a time\nexpression.\n','mysql> SELECT ADDTIME(\'1997-12-31 23:59:59.999999\',\n    ->                \'1 1:1:1.000002\');\n        -> \'1998-01-02 01:01:01.000001\'\nmysql> SELECT ADDTIME(\'01:00:00.999999\', \'02:00:00.999998\');\n        -> \'03:00:01.999997\'',''),(42,'SPATIAL',24,'MySQL can create spatial indexes using syntax similar to that for creating\nregular indexes, but extended with the SPATIAL keyword.\nSpatial columns that are indexed currently must be declared NOT NULL.\nThe following examples demonstrate how to create spatial indexes.\n\n\n   With CREATE TABLE:\n\nmysql> CREATE TABLE geom (g GEOMETRY NOT NULL, SPATIAL INDEX(g));\n\n   With ALTER TABLE:\n\nmysql> ALTER TABLE geom ADD SPATIAL INDEX(g);\n\n   With CREATE INDEX:\n\nmysql> CREATE SPATIAL INDEX sp_index ON geom (g);\n\n\nTo drop spatial indexes, use ALTER TABLE or DROP INDEX:\n\n\n   With ALTER TABLE:\n\nmysql> ALTER TABLE geom DROP INDEX g;\n\n   With DROP INDEX:\n\nmysql> DROP INDEX sp_index ON geom;\n\n\nExample: Suppose that a table geom contains more than 32,000 geometries,\nwhich are stored in the column g of type GEOMETRY.\nThe table also has an AUTO_INCREMENT column fid for storing\nobject ID values.\n','',''),(43,'TIMESTAMPDIFF',14,'   TIMESTAMPDIFF(interval,datetime_expr1,datetime_expr2)\n\nReturns the integer difference between the date or datetime expressions\ndatetime_expr1 and\ndatetime_expr2. The unit for the result is given by the\ninterval argument. The legal values for interval are the same as\nthose listed in the description of the TIMESTAMPADD() function.\n','',''),(44,'UPPER',23,'   UPPER(str)\nReturns the string str with all characters changed to uppercase\naccording to the current character set mapping (the default is ISO-8859-1\nLatin1).\n','mysql> SELECT UPPER(\'Hej\');\n        -> \'HEJ\'',''),(45,'FROM_UNIXTIME',14,'   FROM_UNIXTIME(unix_timestamp)\n   FROM_UNIXTIME(unix_timestamp,format)\nReturns a representation of the unix_timestamp argument as a value in\n\'YYYY-MM-DD HH:MM:SS\' or YYYYMMDDHHMMSS format, depending on\nwhether the function is used in a string or numeric context.\n\nmysql> SELECT FROM_UNIXTIME(875996580);\n        -> \'1997-10-04 22:23:00\'\nmysql> SELECT FROM_UNIXTIME(875996580) + 0;\n        -> 19971004222300\n\nIf format is given, the result is formatted according to the\nformat string. format may contain the same specifiers as\nthose listed in the entry for the DATE_FORMAT() function.\n','mysql> SELECT FROM_UNIXTIME(UNIX_TIMESTAMP(),\n    ->                      \'%Y %D %M %h:%i:%s %x\');\n        -> \'2003 6th August 06:22:58 2003\'',''),(46,'MEDIUMBLOB',1,'   MEDIUMBLOB\n\nA BLOB column with a maximum length of 16,777,215\n(2^24 - 1) bytes.\n','',''),(47,'IFNULL',9,'   IFNULL(expr1,expr2)\nIf expr1 is not NULL, IFNULL() returns expr1,\nelse it returns expr2.  IFNULL() returns a numeric or string\nvalue, depending on the context in which it is used.\n','mysql> SELECT IFNULL(1,0);\n        -> 1\nmysql> SELECT IFNULL(NULL,10);\n        -> 10\nmysql> SELECT IFNULL(1/0,10);\n        -> 10\nmysql> SELECT IFNULL(1/0,\'yes\');\n        -> \'yes\'',''),(48,'LEAST',26,'   LEAST(value1,value2,...)\nWith two or more arguments, returns the smallest (minimum-valued) argument.\nThe arguments are compared using the following rules.\n\n --- If the return value is used in an INTEGER context or all arguments\nare integer-valued, they are compared as integers.\n\n --- If the return value is used in a REAL context or all arguments are\nreal-valued, they are compared as reals.\n\n --- If any argument is a case-sensitive string, the arguments are compared\nas case-sensitive strings.\n\n --- In other cases, the arguments are compared as case-insensitive strings.\n','mysql> SELECT LEAST(2,0);\n        -> 0\nmysql> SELECT LEAST(34.0,3.0,5.0,767.0);\n        -> 3.0\nmysql> SELECT LEAST(\'B\',\'A\',\'C\');\n        -> \'A\'',''),(49,'=',26,'   =\nEqual:\n','mysql> SELECT 1 = 0;\n        -> 0\nmysql> SELECT \'0\' = 0;\n        -> 1\nmysql> SELECT \'0.0\' = 0;\n        -> 1\nmysql> SELECT \'0.01\' = 0;\n        -> 0\nmysql> SELECT \'.01\' = 0.01;\n        -> 1',''),(50,'REVERSE',23,'   REVERSE(str)\nReturns the string str with the order of the characters reversed.\n','mysql> SELECT REVERSE(\'abc\');\n        -> \'cba\'',''),(51,'ISNULL',26,'   ISNULL(expr)\nIf expr is NULL, ISNULL() returns 1, otherwise\nit returns 0.\n','mysql> SELECT ISNULL(1+1);\n        -> 0\nmysql> SELECT ISNULL(1/0);\n        -> 1',''),(52,'BINARY',1,'   BINARY(M)\n\nThe BINARY type is similar to the CHAR type, but stores\nbinary byte strings rather than non-binary character strings.\n\nThis type was added in MySQL 4.1.2.\n','',''),(53,'BOUNDARY',19,'   Boundary(g)\nReturns a geometry that is the closure of the combinatorial boundary of the\ngeometry value g.\n','',''),(54,'CREATE USER',7,'The CREATE USER statement creates new MySQL accounts.  To use it, you\nmust have the global CREATE USER privilege or the INSERT\nprivilege for the mysql database.\nFor each account, CREATE USER creates a new record in the\nmysql.user table that has no privileges. An error occurs if the\naccount already exists.\n\nThe account can be given a password with the optional IDENTIFIED\nBY clause.  The user value and the password are given the same way\nas for the GRANT statement.  In particular, to specify the password\nin plain text, omit the PASSWORD keyword. To specify the password\nas the hashed value as returned by the PASSWORD() function, include\nthe keyword PASSWORD.\nSee also : [GRANT,  , GRANT].\n\nThe CREATE USER statement was added in MySQL 5.0.2.\n\n\n  @subsubsection DROP USER Syntax\n\n\n\nDROP USER user [, user] ...\n\nThe DROP USER statement deletes one or more MySQL accounts.\nTo use it, you\nmust have the global CREATE USER privilege or the DELETE\nprivilege for the mysql database.\nEach account is named using the same format as for GRANT\nor REVOKE; for example, \'jeffrey\'@@\'localhost\'.  The user and\nhost parts of the account name correspond to the User and Host\ncolumn values of the user table record for the account.\n\nDROP USER was added in MySQL 4.1.1 and originally removed only\naccounts that have no privileges.  In MySQL 5.0.2, it was modified to also\nremove account privileges.  This means that the procedure for removing an\naccount depends on your version of MySQL.\n\nAs of MySQL 5.0.2, remove an account and its privileges as follows:\n\nDROP USER user;\n\nThe statement removes privilege records for the account from all grant tables.\n\nFrom MySQL 4.1.1 to 5.0.1, DROP USER deletes only MySQL accounts that\ndon\'t have any privileges. In these MySQL versions, it serves only to remove\neach account record from the user table. To remove a MySQL account, you\nshould use the following procedure, performing the steps in the order shown:\n\n@enumerate\n --- Use SHOW GRANTS to determine what privileges the account has.\nSee also : [SHOW GRANTS,  , SHOW GRANTS].\n --- Use REVOKE to revoke the privileges displayed by SHOW GRANTS.\nThis removes records for the account from all the grant tables except the\nuser table, and revokes any global privileges listed in the user\ntable.\nSee also : [GRANT,  , GRANT].\n --- Delete the account by using DROP USER to remove the user table\nrecord.\n@end enumerate\n\nDROP USER does not automatically close any open user sessions. Rather, in\nthe event that a user with an open session is dropped, the command does not take\neffect until that user\'s session is closed. Once the session is closed, the user\nis dropped, and that user\'s next attempt to log in will fail. This is by design.\n\nBefore MySQL 4.1.1, DROP USER is not available.  You should first\nrevoke the account privileges as just described. Then delete the user\ntable record and flush the grant tables like this:\n\nmysql> DELETE FROM mysql.user\n    -> WHERE User=\'user_name\' and Host=\'host_name\';\nmysql> FLUSH PRIVILEGES;\n\n\n  @subsubsection GRANT and REVOKE Syntax\n\n\n\n\nGRANT priv_type [(column_list)] [, priv_type [(column_list)]] ...\n    ON [object_type] {tbl_name | * | *.* | db_name.*}\n    TO user [IDENTIFIED BY [PASSWORD] \'password\']\n        [, user [IDENTIFIED BY [PASSWORD] \'password\']] ...\n    [REQUIRE\n        NONE |\n        [{SSL| X509}]\n        [CIPHER \'cipher\' [AND]]\n        [ISSUER \'issuer\' [AND]]\n        [SUBJECT \'subject\']]\n    [WITH with_option [with_option] ...]\n\nobject_type =\n    TABLE\n  | FUNCTION\n  | PROCEDURE\n\nwith_option =\n    GRANT OPTION\n  | MAX_QUERIES_PER_HOUR count\n  | MAX_UPDATES_PER_HOUR count\n  | MAX_CONNECTIONS_PER_HOUR count\n  | MAX_USER_CONNECTIONS count\n\nREVOKE priv_type [(column_list)] [, priv_type [(column_list)]] ...\n    ON [object_type] {tbl_name | * | *.* | db_name.*}\n    FROM user [, user] ...\n\nREVOKE ALL PRIVILEGES, GRANT OPTION FROM user [, user] ...\n\n\nThe GRANT and REVOKE statements allow system administrators to\ncreate MySQL user accounts and to grant rights to and revoke them from\naccounts.  GRANT and REVOKE are implemented in MySQL 3.22.11\nor later. For earlier MySQL versions, these statements do nothing.\n\nMySQL account information is stored in the tables of the mysql\ndatabase. This database and the access control system are discussed\nextensively in [MySQL Database Administration], which you should consult\nfor additional details.\n\nIf the grant tables contain privilege records that contain mixed-case\ndatabase or table names and the lower_case_table_names system\nvariable is set, REVOKE cannot be used to revoke the privileges. It\nwill be necessary to manipulate the grant tables directly. (GRANT\nwill not create such records when lower_case_table_names is set,\nbut such records might have been created prior to setting the variable.)\n\nPrivileges can be granted at several levels:\n\n   Global level\nGlobal privileges apply to all databases on a given server. These privileges\nare stored in the mysql.user table.\nGRANT ALL ON *.* and\nREVOKE ALL ON *.* grant and revoke only global privileges.\n\n   Database level\nDatabase privileges apply to all objects in a given database. These privileges\nare stored in the mysql.db and mysql.host tables.\nGRANT ALL ON db_name.* and\nREVOKE ALL ON db_name.* grant and revoke only database privileges.\n\n   Table level\nTable privileges apply to all columns in a given table. These privileges are\nstored in the mysql.tables_priv table.\nGRANT ALL ON db_name.tbl_name and\nREVOKE ALL ON db_name.tbl_name grant and revoke only table privileges.\n\n   Column level\nColumn privileges apply to single columns in a given table. These privileges are\nstored in the mysql.columns_priv table.\nWhen using REVOKE, you must specify the same columns that were granted.\n\n   Routine level\nThe CREATE ROUTINE, ALTER ROUTINE, EXECUTE, and\nGRANT privileges apply to stored routines. They can be granted at the\nglobal and database levels. Also, except for CREATE ROUTINE, these\nprivileges can be granted at the routine level for individual routines and\nare stored in the mysql.procs_priv table.\n\n  \n\nThe object_type clause was added in MySQL 5.0.6.  It should be\nspecified as TABLE, FUNCTION, or PROCEDURE when the\nfollowing object is a table, a stored function, or a stored procedure.  To\nuse this clause when upgrading from a version of MySQL older than 5.0.6, you\nmust upgrade your grant tables.\nSee also : [Upgrading-grant-tables].\n','CREATE USER user [IDENTIFIED BY [PASSWORD] \'password\']\n    [, user [IDENTIFIED BY [PASSWORD] \'password\']] ...',''),(55,'POINT',2,'   Point(x,y)\nConstructs a WKB Point using its coordinates.\n','',''),(56,'CURRENT_USER',25,'   CURRENT_USER()\nReturns the username and hostname combination that the current session was\nauthenticated as. This value corresponds to the MySQL account that\ndetermines your access privileges. It can be different from the value of\nUSER().\n','mysql> SELECT USER();\n        -> \'davida@localhost\'\nmysql> SELECT * FROM mysql.user;\nERROR 1044: Access denied for user \'\'@\'localhost\' to\ndatabase \'mysql\'\nmysql> SELECT CURRENT_USER();\n        -> \'@localhost\'',''),(57,'LCASE',23,'   LCASE(str)\n\nLCASE() is a synonym for LOWER().\n','',''),(58,'<=',26,'   <=\nLess than or equal:\n','mysql> SELECT 0.1 <= 2;\n        -> 1',''),(59,'UPDATE',6,'The UPDATE statement updates columns in existing table rows with\nnew values.  The SET clause indicates which columns to modify\nand the values they should be given.  The WHERE clause, if given,\nspecifies which rows should be updated.  Otherwise, all rows are updated. If\nthe ORDER BY clause is specified, the rows are updated in the\norder that is specified. The LIMIT clause places a limit on the\nnumber of rows that can be updated.\n\nThe UPDATE statement supports the following modifiers:\n\n\n --- If you specify the LOW_PRIORITY keyword, execution of the\nUPDATE is delayed until no other clients are reading from the table.\n\n --- If you specify the IGNORE keyword, the update statement does not\nabort even if errors occur during the update.  Rows for which duplicate-key\nconflicts occur are not updated. Rows for which columns are updated to\nvalues that would cause data conversion errors are updated to the closet\nvalid values instead.\n','UPDATE [LOW_PRIORITY] [IGNORE] tbl_name\n    SET col_name1=expr1 [, col_name2=expr2 ...]\n    [WHERE where_definition]\n    [ORDER BY ...]\n    [LIMIT row_count]',''),(60,'DROP INDEX',28,'DROP INDEX drops the index named index_name from the table\ntbl_name.  In MySQL 3.22 or later, DROP INDEX is mapped to an\nALTER TABLE statement to drop the index.  See also : [ALTER TABLE, ,\nALTER TABLE].  DROP INDEX doesn\'t do anything prior to MySQL\n3.22.\n','DROP INDEX index_name ON tbl_name',''),(61,'MATCH AGAINST',23,'As of MySQL 3.23.23, MySQL has support for full-text indexing\nand searching.  A full-text index in MySQL is an index of type\nFULLTEXT.  FULLTEXT indexes are used with MyISAM tables\nonly and can be created from CHAR, VARCHAR,\nor TEXT columns at CREATE TABLE time or added later with\nALTER TABLE or CREATE INDEX.  For large datasets, it is\nmuch faster to load your data into a table that has no FULLTEXT\nindex, then create the index with ALTER TABLE (or\nCREATE INDEX).  Loading data into a table that has an existing\nFULLTEXT index could be significantly slower.\n','mysql> SELECT id, body, MATCH (title,body) AGAINST\n    -> (\'Security implications of running MySQL as root\') AS score\n    -> FROM articles WHERE MATCH (title,body) AGAINST\n    -> (\'Security implications of running MySQL as root\');\n+----+-------------------------------------+-----------------+\n| id | body                                | score           |\n+----+-------------------------------------+-----------------+\n|  4 | 1. Never run mysqld as root. 2. ... | 1.5219271183014 |\n|  6 | When configured properly, MySQL ... | 1.3114095926285 |\n+----+-------------------------------------+-----------------+\n2 rows in set (0.00 sec)',''),(62,'ABS',4,'   ABS(X)\nReturns the absolute value of X.\n','mysql> SELECT ABS(2);\n        -> 2\nmysql> SELECT ABS(-32);\n        -> 32',''),(63,'POLYFROMWKB',13,'   PolyFromWKB(wkb[,srid])\n   PolygonFromWKB(wkb[,srid])\nConstructs a POLYGON value using its WKB representation and SRID.\n','',''),(64,'NOT LIKE',23,'   expr NOT LIKE pat [ESCAPE \'escape-char\']\n\nThis is the same as NOT (expr LIKE pat [ESCAPE \'escape-char\']).\n','',''),(65,'SPACE',23,'   SPACE(N)\nReturns a string consisting of N space characters.\n','mysql> SELECT SPACE(6);\n        -> \'      \'',''),(66,'MBR DEFINITION',8,'Every geometry occupies some position in space. The exterior of\na geometry is all space not occupied by the geometry. The interior\nis the space occupied by the geometry. The boundary is the\ninterface between the geometry\'s interior and exterior.\n\n --- Its MBR (Minimum Bounding Rectangle), or Envelope.\nThis is the bounding geometry, formed by the minimum and maximum (X,Y)\ncoordinates:\n','((MINX MINY, MAXX MINY, MAXX MAXY, MINX MAXY, MINX MINY))',''),(67,'GEOMETRYCOLLECTION',2,'   GeometryCollection(g1,g2,...)\nConstructs a WKB GeometryCollection. If any argument is not a\nwell-formed WKB representation of a geometry, the return value is\nNULL.\n','',''),(68,'*',4,'   *\nMultiplication:\n','mysql> SELECT 3*5;\n        -> 15\nmysql> SELECT 18014398509481984*18014398509481984.0;\n        -> 324518553658426726783156020576256.0\nmysql> SELECT 18014398509481984*18014398509481984;\n        -> 0',''),(69,'TIMESTAMP',1,'   TIMESTAMP[(M)]\n\nA timestamp.  The range is \'1970-01-01 00:00:00\' to partway through the\nyear 2037.\n\nA TIMESTAMP column is useful for recording the date and time of an\nINSERT or UPDATE operation. The first TIMESTAMP column\nin a table is automatically set to the date and time of the most recent\noperation if you don\'t assign it a value yourself.  You can also set any\nTIMESTAMP column to the current date and time by assigning it a\nNULL value.\n\nFrom MySQL 4.1 on, TIMESTAMP is returned as a string with the format\n\'YYYY-MM-DD HH:MM:SS\'. If you want to obtain the value as a number,\nyou should add +0 to the timestamp column. Different timestamp\ndisplay widths are not supported.\n\nIn MySQL 4.0 and earlier, TIMESTAMP values are displayed in\nYYYYMMDDHHMMSS, YYMMDDHHMMSS, YYYYMMDD, or YYMMDD\nformat, depending on whether M is 14 (or missing), 12,\n8, or 6, but allows you to assign values to TIMESTAMP\ncolumns using either strings or numbers.\nThe M argument affects only how a TIMESTAMP column is displayed,\nnot storage.  Its values always are stored using four bytes each.\nFrom MySQL 4.0.12, the --new option can be used\nto make the server behave as in MySQL 4.1.\n\nNote that TIMESTAMP(M) columns where M is 8 or 14 are reported to\nbe numbers, whereas other TIMESTAMP(M) columns are reported to be\nstrings.  This is just to ensure that you can reliably dump and restore\nthe table with these types.\n','',''),(70,'DES_DECRYPT',17,'   DES_DECRYPT(crypt_str[,key_str])\n\nDecrypts a string encrypted with DES_ENCRYPT().\nOn error, this function returns NULL.\n\nNote that this function works only if MySQL has been configured with\nSSL support. See also : [Secure connections].\n\nIf no key_str argument is given, DES_DECRYPT() examines\nthe first byte of the encrypted string to determine the DES key number\nthat was used to encrypt the original string, and then reads the key\nfrom the DES key file to decrypt the message.  For this to work,\nthe user must have the SUPER privilege. The key file can be specified\nwith the --des-key-file server option.\n\nIf you pass this function a key_str argument, that string\nis used as the key for decrypting the message.\n\nIf the crypt_str argument doesn\'t look like an encrypted string,\nMySQL returns the given crypt_str.\n','',''),(71,'CHECKSUM',7,'\nReports a table checksum.\n\nIf QUICK is specified, the live table checksum is reported if it is\navailable, or NULL otherwise.  This is very fast.  A live checksum\nis enabled by specifying the CHECKSUM=1 table option, currently\nsupported only for MyISAM tables.\nSee also : [CREATE TABLE,  , CREATE TABLE].\n\nIn EXTENDED mode the whole table is read row by row and the checksum\nis calculated. This can be very slow for large tables.\n\nBy default, if neither QUICK nor EXTENDED is specified, MySQL\nreturns a live checksum if the table storage engine supports it and scans\nthe table otherwise.\n\nCHECKSUM TABLE returns NULL for non-existent tables.\nAs of MySQL 5.0.3, a warning is generated for this condition.\n\nThis statement is implemented in MySQL 4.1.1.\n\n\n  @subsubsection OPTIMIZE TABLE Syntax\n\n\n\n\nOPTIMIZE [LOCAL | NO_WRITE_TO_BINLOG] TABLE tbl_name [, tbl_name] ...\n\nOPTIMIZE TABLE should be used if you have deleted a large part of a\ntable or if you have made many changes to a table with variable-length rows\n(tables that have VARCHAR, BLOB, or TEXT columns).\nDeleted records are maintained in a linked list and subsequent INSERT\noperations reuse old record positions. You can use OPTIMIZE TABLE to\nreclaim the unused space and to defragment the data file.\n','CHECKSUM TABLE tbl_name [, tbl_name] ... [ QUICK | EXTENDED ]',''),(72,'ENDPOINT',18,'   EndPoint(ls)\nReturns the Point that is the end point of the LineString value\nls.\n','mysql> SET @ls = \'LineString(1 1,2 2,3 3)\';\nmysql> SELECT AsText(EndPoint(GeomFromText(@ls)));\n+-------------------------------------+\n| AsText(EndPoint(GeomFromText(@ls))) |\n+-------------------------------------+\n| POINT(3 3)                          |\n+-------------------------------------+',''),(73,'CACHE INDEX',6,'The CACHE INDEX statement assigns table indexes to a specific key\ncache. It is used only for MyISAM tables.\n\nThe following statement assigns indexes from the tables t1,\nt2, and t3 to the key cache named hot_cache:\n\nmysql> CACHE INDEX t1, t2, t3 IN hot_cache;\n+---------+--------------------+----------+----------+\n| Table   | Op                 | Msg_type | Msg_text |\n+---------+--------------------+----------+----------+\n| test.t1 | assign_to_keycache | status   | OK       |\n| test.t2 | assign_to_keycache | status   | OK       |\n| test.t3 | assign_to_keycache | status   | OK       |\n+---------+--------------------+----------+----------+\n','CACHE INDEX\n  tbl_index_list [, tbl_index_list] ...\n  IN key_cache_name\n\ntbl_index_list:\n  tbl_name [[INDEX|KEY] (index_name[, index_name] ...)]',''),(74,'COMPRESS',23,'   COMPRESS(string_to_compress)\nCompresses a string. This function requires MySQL to have been compiled\nwith a compression library such as zlib. Otherwise, the return\nvalue is always NULL. The compressed string can be uncompressed with\nUNCOMPRESS().\n','mysql> SELECT LENGTH(COMPRESS(REPEAT(\'a\',1000)));\n        -> 21\nmysql> SELECT LENGTH(COMPRESS(\'\'));\n        -> 0\nmysql> SELECT LENGTH(COMPRESS(\'a\'));\n        -> 13\nmysql> SELECT LENGTH(COMPRESS(REPEAT(\'a\',16)));\n        -> 15',''),(75,'COUNT',12,'   COUNT(expr)\nReturns a count of the number of non-NULL values in the rows\nretrieved by a SELECT statement.\n','mysql> SELECT student.student_name,COUNT(*)\n    ->        FROM student,course\n    ->        WHERE student.student_id=course.student_id\n    ->        GROUP BY student_name;',''),(76,'INSERT',23,'   INSERT(str,pos,len,newstr)\nReturns the string str, with the substring beginning at position\npos and len characters long replaced by the string\nnewstr.  Returns the original string if pos is not within\nthe length of the string.  Replaces the rest of the string from position\npos is len is not within the length of the rest of the string.\nReturns NULL if any argument is null.\n','mysql> SELECT INSERT(\'Quadratic\', 3, 4, \'What\');\n        -> \'QuWhattic\'\nmysql> SELECT INSERT(\'Quadratic\', -1, 4, \'What\');\n        -> \'Quadratic\'\nmysql> SELECT INSERT(\'Quadratic\', 3, 100, \'What\');\n        -> \'QuWhat\'',''),(77,'HANDLER',6,'The HANDLER statement provides direct access to table storage engine\ninterfaces.  It is available for MyISAM tables as MySQL 4.0.0 and\nInnoDB tables as of MySQL 4.0.3.\n','HANDLER tbl_name OPEN [ AS alias ]\nHANDLER tbl_name READ index_name { = | >= | <= | < } (value1,value2,...)\n    [ WHERE where_condition ] [LIMIT ... ]\nHANDLER tbl_name READ index_name { FIRST | NEXT | PREV | LAST }\n    [ WHERE where_condition ] [LIMIT ... ]\nHANDLER tbl_name READ { FIRST | NEXT }\n    [ WHERE where_condition ] [LIMIT ... ]\nHANDLER tbl_name CLOSE',''),(78,'MLINEFROMTEXT',3,'   MLineFromText(wkt[,srid])\n   MultiLineStringFromText(wkt[,srid])\nConstructs a MULTILINESTRING value using its WKT representation and SRID.\n','',''),(79,'GEOMCOLLFROMWKB',13,'   GeomCollFromWKB(wkb[,srid])\n   GeometryCollectionFromWKB(wkb[,srid])\nConstructs a GEOMETRYCOLLECTION value using its WKB representation and SRID.\n','',''),(80,'RENAME TABLE',28,'RENAME TABLE tbl_name TO new_tbl_name\n    [, tbl_name2 TO new_tbl_name2] ...\n\nThis statement renames one or more tables.  It was added in MySQL 3.23.23.\n\nThe rename operation is done atomically, which means that no other thread\ncan access any of the tables while the rename is running. For example,\nif you have an existing table old_table, you can create another\ntable new_table that has the same structure but is empty, and then\nreplace the existing table with the empty one as follows:\n','CREATE TABLE new_table (...);\nRENAME TABLE old_table TO backup_table, new_table TO old_table;',''),(81,'BOOLEAN',1,'   BOOL\n   BOOLEAN\nThese are synonyms for TINYINT(1).\nThe BOOLEAN synonym was added in MySQL 4.1.0.\nA value of zero is considered false. Non-zero values are considered true.\n\nIn the future,\nfull boolean type handling will be introduced in accordance with standard SQL.\n','',''),(82,'DEFAULT',21,'   DEFAULT(col_name)\nReturns the default value for a table column.\nStarting from MySQL 5.0.2, you get an error if the column doesn\'t have\na default value.\n','mysql> UPDATE t SET i = DEFAULT(i)+1 WHERE id < 100;',''),(83,'TINYTEXT',1,'   TINYTEXT\n\nA TEXT column with a maximum length of 255\n(2^8 - 1) characters.\n','',''),(84,'DECODE',17,'   DECODE(crypt_str,pass_str)\nDecrypts the encrypted string crypt_str using pass_str as the\npassword.  crypt_str should be a string returned from\nENCODE().\n','',''),(85,'<=>',26,'   <=>\nNULL-safe equal.\nThis operator performs an equality comparison like the = operator, but\nreturns 1 rather than NULL if both operands are NULL,\nand 0 rather than NULL if one operand is NULL.\n','mysql> SELECT 1 <=> 1, NULL <=> NULL, 1 <=> NULL;\n        -> 1, 1, 0\nmysql> SELECT 1 = 1, NULL = NULL, 1 = NULL;\n        -> 1, NULL, NULL',''),(86,'LOAD DATA FROM MASTER',6,'LOAD DATA FROM MASTER\n\nTakes a snapshot of the master and copies it to the slave.  It updates the\nvalues of MASTER_LOG_FILE and MASTER_LOG_POS so that the slave\nstarts replicating from the correct position. Any table and database\nexclusion rules specified with the --replicate-*-do-* and\n--replicate-*-ignore-* options are honored.\n--replicate-rewrite-db is /not/ taken into account (because one user\ncould, with this option, set up a non-unique mapping such as\n--replicate-rewrite-db=db1->db3 and\n--replicate-rewrite-db=db2->db3, which would confuse the slave when\nit loads the master\'s tables).\n\nUse of this statement is subject to the following conditions:\n\n\n --- It works only with MyISAM tables.  Attempting to load a\nnon-MyISAM table results in the error:\n\nERROR 1189 (08S01): Net error reading from master\n\n --- It acquires a global read lock on the master while taking the snapshot,\nwhich prevents updates on the master during the load operation.\n\n\nIn the future, it is planned to make this statement work with\nInnoDB tables and to remove the need for a global read lock by using\nnon-blocking online backup.\n\nIf you are loading big tables, you might have to increase the values\nof net_read_timeout and net_write_timeout\non both your master and slave servers.\nSee also : [Server system variables].\n\nNote that LOAD DATA FROM MASTER does /not/ copy any\ntables from the mysql database.  This makes it easy to have\ndifferent users and privileges on the master and the slave.\n\nThe LOAD DATA FROM MASTER statement\nrequires the replication account that is used to connect to the master\nto have the RELOAD and SUPER privileges on the master and the\nSELECT privilege for all master tables you want to load. All\nmaster tables for which the user does not have the SELECT privilege are\nignored by LOAD DATA FROM MASTER. This is because the\nmaster hides them from the user: LOAD DATA FROM MASTER calls\nSHOW DATABASES to know the master databases to load, but\nSHOW DATABASES returns only databases for which the user has\nsome privilege.\nSee [SHOW DATABASES,  , SHOW DATABASES].\nOn the slave\'s side, the user that issues LOAD DATA FROM MASTER should\nhave grants to drop and create the databases and tables that are copied.\n','',''),(87,'RESET',6,'The RESET statement is used to clear the state of various server\noperations. It also acts as a stronger\nversion of the FLUSH statement.  See also : [FLUSH, , FLUSH].\n','RESET reset_option [, reset_option] ...',''),(88,'GET_LOCK',21,'   GET_LOCK(str,timeout)\nTries to obtain a lock with a name given by the string str, with a\ntimeout of timeout seconds.  Returns 1 if the lock was obtained\nsuccessfully, 0 if the attempt timed out (for example, because another\nclient has previously locked the name), or NULL if an error\noccurred (such as running out of memory or the thread was killed with\nmysqladmin kill).  If you have a lock obtained with GET_LOCK(),\nit is released when you execute\nRELEASE_LOCK(), execute a new GET_LOCK(), or your connection\nterminates (either normally or abnormally).\n\nThis function can be used to implement application locks or to\nsimulate record locks.  Names are locked on a server-wide basis.\nIf a name has been locked by one client, GET_LOCK() blocks\nany request by another client for a lock with the same name. This\nallows clients that agree on a given lock name to use the name to\nperform cooperative advisory locking.\n','mysql> SELECT GET_LOCK(\'lock1\',10);\n        -> 1\nmysql> SELECT IS_FREE_LOCK(\'lock2\');\n        -> 1\nmysql> SELECT GET_LOCK(\'lock2\',10);\n        -> 1\nmysql> SELECT RELEASE_LOCK(\'lock2\');\n        -> 1\nmysql> SELECT RELEASE_LOCK(\'lock1\');\n        -> NULL',''),(89,'UCASE',23,'   UCASE(str)\n\nUCASE() is a synonym for UPPER().\n','',''),(90,'MPOLYFROMWKB',13,'   MPolyFromWKB(wkb[,srid])\n   MultiPolygonFromWKB(wkb[,srid])\nConstructs a MULTIPOLYGON value using its WKB representation and SRID.\n','',''),(91,'DO',6,'DO executes the expressions but doesn\'t return any results.  This is\nshorthand for SELECT expr, ..., but has the advantage that it\'s\nslightly faster when you don\'t care about the result.\n\nDO is useful mainly with functions that have side effects, such as\nRELEASE_LOCK().\n','DO expr [, expr] ...',''),(92,'CURTIME',14,'   CURTIME()\n\nReturns the current time as a value in \'HH:MM:SS\' or HHMMSS\nformat, depending on whether the function is used in a string or numeric\ncontext.\n','mysql> SELECT CURTIME();\n        -> \'23:50:26\'\nmysql> SELECT CURTIME() + 0;\n        -> 235026',''),(93,'BIGINT',1,'   BIGINT[(M)] [UNSIGNED] [ZEROFILL]\nA large integer. The signed range is -9223372036854775808 to\n9223372036854775807. The unsigned range is 0 to\n18446744073709551615.\n','',''),(94,'CHAR_LENGTH',23,'   CHAR_LENGTH(str)\n\nReturns the length of the string str, measured in characters.\nA multi-byte character counts as a single character.\nThis means that for a string containing five two-byte characters,\nLENGTH() returns 10, whereas CHAR_LENGTH() returns\n5.\n','',''),(95,'SET',6,'SET sets different types of variables that affect the operation of the\nserver or your client. It can be used to assign values to user variables or\nsystem variables.\n','SET variable_assignment [, variable_assignment] ...\n\nvariable_assignment:\n      user_var_name = expr\n    | [GLOBAL | SESSION] system_var_name = expr\n    | @@[global. | session.]system_var_name = expr',''),(96,'DATE',1,'A date.  The supported range is \'1000-01-01\' to \'9999-12-31\'.\nMySQL displays DATE values in \'YYYY-MM-DD\' format, but\nallows you to assign values to DATE columns using either strings or\nnumbers.\n','',''),(97,'CONV',23,'   CONV(N,from_base,to_base)\nConverts numbers between different number bases.  Returns a string\nrepresentation of the number N, converted from base from_base\nto base to_base.  Returns NULL if any argument is NULL.\nThe argument N is interpreted as an integer, but may be specified as\nan integer or a string.  The minimum base is 2 and the maximum base is\n36.  If to_base is a negative number, N is regarded as a\nsigned number.  Otherwise, N is treated as unsigned.  CONV() works\nwith 64-bit precision.\n','mysql> SELECT CONV(\'a\',16,2);\n        -> \'1010\'\nmysql> SELECT CONV(\'6E\',18,8);\n        -> \'172\'\nmysql> SELECT CONV(-17,10,-18);\n        -> \'-H\'\nmysql> SELECT CONV(10+\'10\'+\'10\'+0xa,10,10);\n        -> \'40\'',''),(98,'EXTRACT',14,'   EXTRACT(type FROM date)\n\nThe EXTRACT() function uses the same kinds of interval type\nspecifiers as DATE_ADD() or DATE_SUB(), but extracts parts\nfrom the date rather than performing date arithmetic.\n','mysql> SELECT EXTRACT(YEAR FROM \'1999-07-02\');\n       -> 1999\nmysql> SELECT EXTRACT(YEAR_MONTH FROM \'1999-07-02 01:02:03\');\n       -> 199907\nmysql> SELECT EXTRACT(DAY_MINUTE FROM \'1999-07-02 01:02:03\');\n       -> 20102\nmysql> SELECT EXTRACT(MICROSECOND\n    ->                FROM \'2003-01-02 10:30:00.00123\');\n        -> 123',''),(99,'ENCRYPT',17,'   ENCRYPT(str[,salt])\nEncrypt str using the Unix crypt() system call. The\nsalt argument should be a string with two characters.\n(As of MySQL 3.22.16, salt may be longer than two characters.)\nIf no salt argument is given, a random value is used.\n','mysql> SELECT ENCRYPT(\'hello\');\n        -> \'VxuFAJXVARROc\'',''),(100,'OLD_PASSWORD',17,'   OLD_PASSWORD(str)\n\nOLD_PASSWORD() is available as of MySQL 4.1, when the implementation of\nPASSWORD() was changed to improve security. OLD_PASSWORD()\nreturns the value of the pre-4.1 implementation of PASSWORD().\n[Password hashing].\n\n   PASSWORD(str)\nCalculates and returns a password string from the plaintext password\nstr, or NULL if the argument was NULL. This is\nthe function that is used for encrypting MySQL passwords for storage\nin the Password column of the user grant table.\n','',''),(101,'FORMAT',21,'   FORMAT(X,D)\nFormats the number X to a format like \'#,###,###.##\', rounded\nto D decimals, and returns the result as a string.\nIf D is 0, the result has no\ndecimal point or fractional part.\n','mysql> SELECT FORMAT(12332.123456, 4);\n        -> \'12,332.1235\'\nmysql> SELECT FORMAT(12332.1,4);\n        -> \'12,332.1000\'\nmysql> SELECT FORMAT(12332.2,0);\n        -> \'12,332\'',''),(102,'||',20,'   OR\n   ||\nLogical OR.\nWhen both operands are non-NULL, the result is 1 if any\noperand is non-zero, and 0 otherwise.  With a NULL operand,\nthe result is 1 if the other operand is non-zero, and NULL\notherwise.  If both operands are NULL, the result is NULL.\n','mysql> SELECT 1 || 1;\n        -> 1\nmysql> SELECT 1 || 0;\n        -> 1\nmysql> SELECT 0 || 0;\n        -> 0\nmysql> SELECT 0 || NULL;\n        -> NULL\nmysql> SELECT 1 || NULL;\n        -> 1',''),(103,'CASE',9,'   CASE value WHEN [compare-value] THEN result [WHEN [compare-value] THEN result ...] [ELSE result] END\n   CASE WHEN [condition] THEN result [WHEN [condition] THEN result ...] [ELSE result] END\n\nThe first version returns the result where\nvalue=compare-value. The second version returns the\nresult for the first condition that is true. If there was no matching result\nvalue, the result after ELSE is returned, or NULL if there is\nno ELSE part.\n','mysql> SELECT CASE 1 WHEN 1 THEN \'one\'\n    ->     WHEN 2 THEN \'two\' ELSE \'more\' END;\n        -> \'one\'\nmysql> SELECT CASE WHEN 1>0 THEN \'true\' ELSE \'false\' END;\n        -> \'true\'\nmysql> SELECT CASE BINARY \'B\'\n    ->     WHEN \'a\' THEN 1 WHEN \'b\' THEN 2 END;\n        -> NULL',''),(104,'BIT_LENGTH',23,'   BIT_LENGTH(str)\nReturns the length of the string str in bits.\n','mysql> SELECT BIT_LENGTH(\'text\');\n        -> 32',''),(105,'EXTERIORRING',0,'   ExteriorRing(poly)\nReturns the exterior ring of the Polygon value poly\nas a LineString.\n','mysql> SET @poly =\n    -> \'Polygon((0 0,0 3,3 3,3 0,0 0),(1 1,1 2,2 2,2 1,1 1))\';\nmysql> SELECT AsText(ExteriorRing(GeomFromText(@poly)));\n+-------------------------------------------+\n| AsText(ExteriorRing(GeomFromText(@poly))) |\n+-------------------------------------------+\n| LINESTRING(0 0,0 3,3 3,3 0,0 0)           |\n+-------------------------------------------+',''),(106,'GEOMFROMWKB',13,'   GeomFromWKB(wkb[,srid])\n   GeometryFromWKB(wkb[,srid])\nConstructs a geometry value of any type using its WKB representation and SRID.\n','',''),(107,'SHOW SLAVE HOSTS',6,'SHOW SLAVE HOSTS\n\nDisplays a list of slaves currently registered with the master.\nAny slave not started with the --report-host=slave_name\noption is not visible in that list.\n','',''),(108,'START TRANSACTION',10,'By default, MySQL runs with autocommit mode enabled. This means that\nas soon as you execute a statement that updates (modifies) a table,\nMySQL stores the update on disk.\n\nIf you are using transaction-safe tables (like InnoDB or BDB),\nyou can disable autocommit mode with the following statement:\n\nSET AUTOCOMMIT=0;\n\nAfter disabling autocommit mode by setting the AUTOCOMMIT variable to\nzero, you must use COMMIT to store your changes to disk or\nROLLBACK if you want to ignore the changes you have made since\nthe beginning of your transaction.\n\nIf you want to disable autocommit mode for a single series of\nstatements, you can use the START TRANSACTION statement:\n','START TRANSACTION;\nSELECT @A:=SUM(salary) FROM table1 WHERE type=1;\nUPDATE table2 SET summary=@A WHERE type=1;\nCOMMIT;',''),(109,'BETWEEN AND',26,'   expr BETWEEN min AND max\nIf expr is greater than or equal to min and expr is\nless than or equal to max, BETWEEN returns 1,\notherwise it returns 0.  This is equivalent to the expression\n(min <= expr AND expr <= max) if all the arguments are of the\nsame type. Otherwise type conversion takes place according to the rules\ndescribed at the beginning of this section, but applied to all the three\narguments. Note: Before MySQL\n4.0.5, arguments were converted to the type of expr instead.\n','mysql> SELECT 1 BETWEEN 2 AND 3;\n        -> 0\nmysql> SELECT \'b\' BETWEEN \'a\' AND \'c\';\n        -> 1\nmysql> SELECT 2 BETWEEN 2 AND \'3\';\n        -> 1\nmysql> SELECT 2 BETWEEN 2 AND \'x-3\';\n        -> 0',''),(110,'MULTIPOLYGON',2,'   MultiPolygon(poly1,poly2,...)\nConstructs a WKB MultiPolygon value from a set of WKB Polygon\narguments.\nIf any argument is not a WKB Polygon, the return value is NULL.\n','',''),(111,'TIME_FORMAT',14,'   TIME_FORMAT(time,format)\nThis is used like the DATE_FORMAT() function, but the\nformat string may contain only those format specifiers that handle\nhours, minutes, and seconds.  Other specifiers produce a NULL value or\n0.\n','',''),(112,'LEFT',23,'   LEFT(str,len)\nReturns the leftmost len characters from the string str.\n','mysql> SELECT LEFT(\'foobarbar\', 5);\n        -> \'fooba\'',''),(113,'FLUSH QUERY CACHE',7,'You can defragment the query cache to better utilize its memory\nwith the FLUSH QUERY CACHE statement.\nThe statement does not remove any queries from the cache.\n\nThe RESET QUERY CACHE statement removes all query results from the\nquery cache.  The FLUSH TABLES statement also does this.\n','',''),(114,'RAND',4,'   RAND()\n   RAND(N)\nReturns a random floating-point value in the range from 0 to 1.0.\nIf an integer argument N is specified, it is used as the seed value\n(producing a repeatable sequence).\n','mysql> SELECT RAND();\n        -> 0.9233482386203\nmysql> SELECT RAND(20);\n        -> 0.15888261251047\nmysql> SELECT RAND(20);\n        -> 0.15888261251047\nmysql> SELECT RAND();\n        -> 0.63553050033332\nmysql> SELECT RAND();\n        -> 0.70100469486881',''),(115,'RPAD',23,'   RPAD(str,len,padstr)\nReturns the string str, right-padded with the string padstr\nto a length of len characters. If str is longer\nthan len, the return value is shortened to len characters.\n','mysql> SELECT RPAD(\'hi\',5,\'?\');\n        -> \'hi???\'\nmysql> SELECT RPAD(\'hi\',1,\'?\');\n        -> \'h\'',''),(116,'INSERT INTO',6,'INSERT inserts new rows into an existing table.  The INSERT ...\nVALUES and INSERT ... SET forms of the statement insert rows based\non explicitly specified values.  The INSERT ... SELECT form inserts\nrows selected from another table or tables.  The INSERT ... VALUES\nform with multiple value lists is supported in MySQL 3.22.5 or\nlater.  The INSERT ... SET syntax is supported in MySQL\n3.22.10 or later.\nINSERT ... SELECT is discussed further in\nSee also : [INSERT SELECT,  , INSERT SELECT].\n','INSERT [LOW_PRIORITY | DELAYED | HIGH_PRIORITY] [IGNORE]\n    [INTO] tbl_name [(col_name,...)]\n    VALUES ({expr | DEFAULT},...),(...),...\n    [ ON DUPLICATE KEY UPDATE col_name=expr, ... ]',''),(117,'RESTORE',7,'\nRESTORE TABLE tbl_name [, tbl_name] ... FROM \'/path/to/backup/directory\'\n\nRestores the table or tables from a backup that was made with BACKUP\nTABLE. Existing tables are not overwritten; if you try to restore over\nan existing table, you get an error.  Just as BACKUP TABLE,\nRESTORE TABLE currently works only for MyISAM tables.\nThe directory should be specified as a full pathname.\n\nThe backup for each table consists of its *.frm format file and\n*.MYD data file. The restore operation restores those files, then\nuses them to rebuild the *.MYI index file.  Restoring takes longer\nthan backing up due to the need to rebuild the indexes. The more indexes the\ntable has, the longer it takes.\n','',''),(118,'CREATE DATABASE',28,'CREATE DATABASE creates a database with the given name.  To use\nCREATE DATABASE, you need the CREATE privilege on the database.\n','CREATE {DATABASE | SCHEMA} [IF NOT EXISTS] db_name\n    [create_specification [, create_specification] ...]\n\ncreate_specification:\n    [DEFAULT] CHARACTER SET charset_name\n  | [DEFAULT] COLLATE collation_name',''),(119,'VAR_POP',12,'   VAR_POP(expr)\nReturns the population standard variance of expr.  It considers rows\nas the whole population, not as a sample, so it has the number of rows as\nthe denominator.  This function was added in MySQL 5.0.3.  Before 5.0.3, you\ncan use VARIANCE(), which is equivalent but not standard SQL.\n','',''),(120,'ELT',23,'   ELT(N,str1,str2,str3,...)\nReturns str1 if N = 1, str2 if N =\n2, and so on.  Returns NULL if N is less than 1\nor greater than the number of arguments.  ELT() is the complement of\nFIELD().\n','mysql> SELECT ELT(1, \'ej\', \'Heja\', \'hej\', \'foo\');\n        -> \'ej\'\nmysql> SELECT ELT(4, \'ej\', \'Heja\', \'hej\', \'foo\');\n        -> \'foo\'',''),(121,'ALTER VIEW',24,'This statement changes the definition of an existing view.\nThe syntax is similar to that for CREATE VIEW.\nSee also : [CREATE VIEW,  , CREATE VIEW].\nThis statement requires the CREATE VIEW and DELETE privileges\nfor the view, and some privilege for each column referred to in the\nSELECT statement.\n','ALTER [ALGORITHM = {UNDEFINED | MERGE | TEMPTABLE}]\n    VIEW view_name [(column_list)]\n    AS select_statement\n    [WITH [CASCADED | LOCAL] CHECK OPTION]',''),(122,'~',27,'   ~\nInvert all bits.\n','mysql> SELECT 5 & ~1;\n        -> 4',''),(123,'CONCAT_WS',23,'   CONCAT_WS(separator,str1,str2,...)\n\nCONCAT_WS() stands for CONCAT With Separator and is a special form of\nCONCAT().  The first argument is the separator for the rest of the\narguments.\nThe separator is added between the strings to be concatenated.\nThe separator can be a string as can the rest of the\narguments. If the separator is NULL, the result is NULL.\nThe function skips any NULL values after the\nseparator argument.\n','mysql> SELECT CONCAT_WS(\',\',\'First name\',\'Second name\',\'Last Name\');\n        -> \'First name,Second name,Last Name\'\nmysql> SELECT CONCAT_WS(\',\',\'First name\',NULL,\'Last Name\');\n        -> \'First name,Last Name\'',''),(124,'ROW_COUNT',25,'   ROW_COUNT()\n\nROW_COUNT() returns the number of rows updated, inserted, or deleted\nby the preceding statement.  This is the same as the row count that the\nmysql client displays and the value from the\nmysql_affected_rows() C API function.\n','mysql> INSERT INTO t VALUES(1),(2),(3);\nQuery OK, 3 rows affected (0.00 sec)\nRecords: 3  Duplicates: 0  Warnings: 0\n\nmysql> SELECT ROW_COUNT();\n+-------------+\n| ROW_COUNT() |\n+-------------+\n|           3 |\n+-------------+\n1 row in set (0.00 sec)\n\nmysql> DELETE FROM t WHERE i IN(1,2);\nQuery OK, 2 rows affected (0.00 sec)\n\nmysql> SELECT ROW_COUNT();\n+-------------+\n| ROW_COUNT() |\n+-------------+\n|           2 |\n+-------------+\n1 row in set (0.00 sec)',''),(125,'ASIN',4,'   ASIN(X)\nReturns the arc sine of X, that is, the value whose sine is\nX. Returns NULL if X is not in the range -1 to\n1.\n','mysql> SELECT ASIN(0.2);\n        -> 0.201358\nmysql> SELECT ASIN(\'foo\');\n        -> 0.000000',''),(126,'FUNCTION',22,'A user-defined function (UDF) is a way to extend MySQL with a new\nfunction that works like a native (built-in) MySQL function such as\nABS() or CONCAT().\n\nfunction_name is the name that should be used in SQL statements to\ninvoke the function.  The RETURNS clause indicates the type of the\nfunction\'s return value.  shared_library_name is the basename of the\nshared object file that contains the code that implements the function. The\nfile must be located in a directory that is searched by your system\'s\ndynamic linker.\n\nTo create a function, you must have the INSERT and privilege for the\nmysql database.  To drop a function, you must have the DELETE\nprivilege for the mysql database.  This is because CREATE\nFUNCTION adds a row to the mysql.func system table that records the\nfunction\'s name, type, and shared library name, and DROP FUNCTION\ndeletes the function\'s row from that table.  If you do not have this table,\nyou should run the mysql_fix_privilege_tables script to create it.\nSee also : [Upgrading-grant-tables].\n','CREATE [AGGREGATE] FUNCTION function_name RETURNS {STRING|INTEGER|REAL}\n       SONAME shared_library_name\n\nDROP FUNCTION function_name',''),(127,'SIGN',4,'   SIGN(X)\nReturns the sign of the argument as -1, 0, or 1, depending\non whether X is negative, zero, or positive.\n','mysql> SELECT SIGN(-32);\n        -> -1\nmysql> SELECT SIGN(0);\n        -> 0\nmysql> SELECT SIGN(234);\n        -> 1',''),(128,'SEC_TO_TIME',14,'   SEC_TO_TIME(seconds)\nReturns the seconds argument, converted to hours, minutes, and seconds,\nas a value in \'HH:MM:SS\' or HHMMSS format, depending on whether\nthe function is used in a string or numeric context.\n','mysql> SELECT SEC_TO_TIME(2378);\n        -> \'00:39:38\'\nmysql> SELECT SEC_TO_TIME(2378) + 0;\n        -> 3938',''),(129,'YEAR TYPE',1,'   YEAR[(2|4)]\n\nA year in two-digit or four-digit format. The default is four-digit format.\nIn four-digit format, the\nallowable values are 1901 to 2155, and 0000.\nIn two-digit format, the allowable values are\n70 to 69, representing years from\n1970 to 2069.  MySQL displays YEAR values in\nYYYY format, but allows you to assign values to YEAR columns\nusing either strings or numbers. The YEAR type is unavailable prior\nto MySQL 3.22.\n','',''),(130,'FLOAT',1,'   FLOAT(p) [UNSIGNED] [ZEROFILL]\n\nA floating-point number.  p represents the precision. It can be from\n0 to 24 for a single-precision floating-point number and from 25 to 53 for a\ndouble-precision floating-point number. These types are like the FLOAT\nand DOUBLE types described immediately following.  FLOAT(p)\nhas the same range as the corresponding FLOAT and DOUBLE\ntypes, but the display width and number of decimals are undefined.\n\nAs of MySQL 3.23, this is a true floating-point value.  In\nearlier MySQL versions, FLOAT(p) always has two decimals.\n\nThis syntax is provided for ODBC compatibility.\n\nUsing FLOAT might give you some unexpected problems because\nall calculations in MySQL are done with double precision.\nSee also : [No matching rows].\n\n   FLOAT[(M,D)] [UNSIGNED] [ZEROFILL]\n\nA small (single-precision) floating-point number.  Allowable values are\n-3.402823466E+38 to -1.175494351E-38, 0,\nand 1.175494351E-38 to 3.402823466E+38.  If UNSIGNED is\nspecified, negative values are disallowed.  M is the display width and\nD is the number of significant digits. FLOAT without arguments or\nFLOAT(p) (where p is in the range from 0 to 24) stands for a\nsingle-precision floating-point number.\n','',''),(131,'LOCATE',23,'   LOCATE(substr,str)\n   LOCATE(substr,str,pos)\n\nThe first syntax\nreturns the position of the first occurrence of substring substr\nin string str.\nThe second syntax\nreturns the position of the first occurrence of substring substr in\nstring str, starting at position pos.\nReturns 0 if substr is not in str.\n','',''),(132,'CHARSET',25,'   CHARSET(str)\nReturns the character set of the string argument.\n','mysql> SELECT CHARSET(\'abc\');\n        -> \'latin1\'\nmysql> SELECT CHARSET(CONVERT(\'abc\' USING utf8));\n        -> \'utf8\'\nmysql> SELECT CHARSET(USER());\n        -> \'utf8\'',''),(133,'PURGE MASTER LOGS BEFORE TO',6,'PURGE {MASTER | BINARY} LOGS TO \'log_name\'\nPURGE {MASTER | BINARY} LOGS BEFORE \'date\'\n\nDeletes all the binary logs listed in the log\nindex that are strictly prior to the specified log or date.\nThe logs also are removed from the list recorded in the log index file,\nso that the given log becomes the first.\n','',''),(134,'SUBDATE',14,'   SUBDATE(date,INTERVAL expr type)\n   SUBDATE(expr,days)\n\nWhen invoked with the INTERVAL form of the second argument,\nSUBDATE() is a synonym for DATE_SUB().\nFor information on the INTERVAL argument, see the\ndiscussion for DATE_ADD().\n\nmysql> SELECT DATE_SUB(\'1998-01-02\', INTERVAL 31 DAY);\n        -> \'1997-12-02\'\nmysql> SELECT SUBDATE(\'1998-01-02\', INTERVAL 31 DAY);\n        -> \'1997-12-02\'\n\nAs of MySQL 4.1.1, the second syntax is allowed, where expr is a date\nor datetime expression and days is the number of days to be\nsubtracted from expr.\n\nmysql> SELECT SUBDATE(\'1998-01-02 12:00:00\', 31);\n        -> \'1997-12-02 12:00:00\'\n\nNote that you can\'t use format \"%X%V\" to convert a year-week\nstring to date as a year-week doesn\'t uniquely identify a year-month if the\nweek crosses a month boundary.  If you want to convert a year-week to a date\nyou can do it by also specifying the week day:\n\nmysql> select str_to_date(\'200442 Monday\', \'%X%V %W\');\n-> 2004-10-18\n','',''),(135,'DAYOFYEAR',14,'   DAYOFYEAR(date)\nReturns the day of the year for date, in the range 1 to\n366.\n','mysql> SELECT DAYOFYEAR(\'1998-02-03\');\n        -> 34',''),(136,'%',4,'   MOD(N,M)\n   N % M\n   N MOD M\nModulo operation.\nReturns the remainder of N divided by M.\n','mysql> SELECT MOD(234, 10);\n        -> 4\nmysql> SELECT 253 % 7;\n        -> 1\nmysql> SELECT MOD(29,9);\n        -> 2\nmysql> SELECT 29 MOD 9;\n        -> 2',''),(137,'LONGTEXT',1,'   LONGTEXT\n\nA TEXT column with a maximum length of 4,294,967,295 or\n4GB (2^32 - 1) characters.  Up to MySQL\n3.23, the client/server protocol and MyISAM tables had a limit\nof 16MB per communication packet / table row. From MySQL 4.0, the maximum\nallowed length of LONGTEXT columns depends on the\nconfigured maximum packet size in the client/server protocol and available\nmemory.\n','',''),(138,'DISJOINT',11,'   Disjoint(g1,g2)\nReturns 1 or 0 to indicate whether or not g1 is spatially disjoint\nfrom (does not intersect) g2.\n','',''),(139,'KILL',6,'Each connection to mysqld runs in a separate thread.  You can see\nwhich threads are running with the SHOW PROCESSLIST statement and kill\na thread with the KILL thread_id statement.\n\nAs of MySQL 5.0.0, KILL allows the optional CONNECTION or\nQUERY modifiers:\n\n\n --- KILL CONNECTION is the same as KILL with no modifier:\nIt terminates the connection associated with the given thread_id.\n\n --- KILL QUERY terminates the statement that the connection currently\nis executing, but leaves the connection intact.\n\n\nIf you have the PROCESS privilege, you can see all threads.\nIf you have the SUPER privilege, you can kill all threads and\nstatements.  Otherwise, you can see and kill only your own threads and\nstatements.\n\nYou can also use the mysqladmin processlist and mysqladmin kill\ncommands to examine and kill threads.\n\nNote: You currently cannot use KILL with the Embedded MySQL\nServer library, because the embedded server merely runs inside the threads\nof the host application, it does not create connection threads of its own.\n','KILL [CONNECTION | QUERY] thread_id',''),(140,'ASTEXT',3,'   AsText(g)\nConverts a value in internal geometry format to its WKT representation\nand returns the string result.\n','mysql> SELECT AsText(g) FROM geom;\n+-------------------------+\n| AsText(p1)              |\n+-------------------------+\n| POINT(1 1)              |\n| LINESTRING(0 0,1 1,2 2) |\n+-------------------------+',''),(141,'LPAD',23,'   LPAD(str,len,padstr)\nReturns the string str, left-padded with the string padstr\nto a length of len characters. If str is longer\nthan len, the return value is shortened to len characters.\n','mysql> SELECT LPAD(\'hi\',4,\'??\');\n        -> \'??hi\'\nmysql> SELECT LPAD(\'hi\',1,\'??\');\n        -> \'h\'',''),(142,'OVERLAPS',11,'   Overlaps(g1,g2)\nReturns 1 or 0 to indicate whether or not g1 spatially overlaps\ng2.\nThe term /spatially overlaps/ is used if two\ngeometries intersect and their intersection results in a geometry of the\nsame dimension but not equal to either of the given geometries.\n','',''),(143,'NUMGEOMETRIES',5,'   NumGeometries(gc)\nReturns the number of geometries in the GeometryCollection value\ngc.\n','mysql> SET @gc = \'GeometryCollection(Point(1 1),LineString(2 2, 3 3))\';\nmysql> SELECT NumGeometries(GeomFromText(@gc));\n+----------------------------------+\n| NumGeometries(GeomFromText(@gc)) |\n+----------------------------------+\n|                                2 |\n+----------------------------------+',''),(144,'SET GLOBAL SQL_SLAVE_SKIP_COUNTER',7,'SET GLOBAL SQL_SLAVE_SKIP_COUNTER = n\n\nSkip the next n events from the master. This is\nuseful for recovering from replication stops caused by a statement.\n\nThis statement is valid only when the slave thread is not running.\nOtherwise, it produces an error.\n\nBefore MySQL 4.0, omit the GLOBAL keyword from the statement.\n','',''),(145,'MONTHNAME',14,'   MONTHNAME(date)\nReturns the full name of the month for date.\n','mysql> SELECT MONTHNAME(\'1998-02-05\');\n        -> \'February\'',''),(146,'MBREQUAL',8,'   MBREqual(g1,g2)\nReturns 1 or 0 to indicate whether or not the Minimum Bounding Rectangles of\nthe two geometries g1 and g2 are the same.\n','',''),(147,'CHANGE MASTER TO',6,'\nCHANGE MASTER TO master_def [, master_def] ...\n\nmaster_def:\n      MASTER_HOST = \'host_name\'\n    | MASTER_USER = \'user_name\'\n    | MASTER_PASSWORD = \'password\'\n    | MASTER_PORT = port_num\n    | MASTER_CONNECT_RETRY = count\n    | MASTER_LOG_FILE = \'master_log_name\'\n    | MASTER_LOG_POS = master_log_pos\n    | RELAY_LOG_FILE = \'relay_log_name\'\n    | RELAY_LOG_POS = relay_log_pos\n    | MASTER_SSL = {0|1}\n    | MASTER_SSL_CA = \'ca_file_name\'\n    | MASTER_SSL_CAPATH = \'ca_directory_name\'\n    | MASTER_SSL_CERT = \'cert_file_name\'\n    | MASTER_SSL_KEY = \'key_file_name\'\n    | MASTER_SSL_CIPHER = \'cipher_list\'\n\nChanges the parameters that the slave server uses for connecting to and\ncommunicating with the master server.\n\nMASTER_USER, MASTER_PASSWORD, MASTER_SSL,\nMASTER_SSL_CA, MASTER_SSL_CAPATH, MASTER_SSL_CERT,\nMASTER_SSL_KEY, and MASTER_SSL_CIPHER provide information for\nthe slave about how to connect to its master.\n\nThe relay log options (RELAY_LOG_FILE and RELAY_LOG_POS) are\navailable beginning with MySQL 4.0.\n\nThe SSL options\n(MASTER_SSL,\nMASTER_SSL_CA,\nMASTER_SSL_CAPATH,\nMASTER_SSL_CERT,\nMASTER_SSL_KEY,\nand\nMASTER_SSL_CIPHER)\nare available beginning with MySQL 4.1.1.\nYou can change these options even on slaves that are compiled without SSL\nsupport. They are saved to the *master.info file, but are ignored\nuntil you use a server that has SSL support enabled.\n\nIf you don\'t specify a given parameter, it keeps its old\nvalue, except as indicated in the following discussion. For example, if the password to connect to your MySQL master has\nchanged, you just need to issue these statements\nto tell the slave about the new password:\n\nmysql> STOP SLAVE; -- if replication was running\nmysql> CHANGE MASTER TO MASTER_PASSWORD=\'new3cret\';\nmysql> START SLAVE; -- if you want to restart replication\n\nThere is no need to specify the parameters that do\nnot change (host, port, user, and so forth).\n\nMASTER_HOST and MASTER_PORT are the hostname (or IP address) of\nthe master host and its TCP/IP port. Note that if MASTER_HOST is\nequal to localhost, then, like in other parts of MySQL, the port\nmay be ignored (if Unix socket files can be used, for example).\n\nIf you specify MASTER_HOST or MASTER_PORT,\nthe slave assumes that the master server is different than\nbefore (even if you specify a host or port value that is\nthe same as the current value.) In this case, the old values for the master\nbinary log name and position are considered no longer applicable, so if you\ndo not specify MASTER_LOG_FILE and MASTER_LOG_POS in the\nstatement, MASTER_LOG_FILE=\'\' and MASTER_LOG_POS=4 are\nsilently appended to it.\n\nMASTER_LOG_FILE and MASTER_LOG_POS are the coordinates\nat which the slave I/O thread should begin reading from the master the\nnext time the thread starts.\nIf you specify either of them, you can\'t specify RELAY_LOG_FILE or\nRELAY_LOG_POS.\nIf neither of MASTER_LOG_FILE or MASTER_LOG_POS are\nspecified, the slave uses the last coordinates of the /slave SQL thread/\nbefore CHANGE MASTER was issued. This ensures that\nreplication has no discontinuity, even if the slave SQL thread was late\ncompared to the slave I/O thread, when you just want to change, say, the\npassword to use. This safe behavior was introduced starting from MySQL\n4.0.17 and 4.1.1. (Before these versions, the coordinates used were\nthe last coordinates of the slave I/O thread before CHANGE MASTER\nwas issued. This caused the SQL thread to possibly lose some events\nfrom the master, thus breaking replication.)\n\nCHANGE MASTER /deletes all relay log files/ and starts\na new one, unless you specify RELAY_LOG_FILE or\nRELAY_LOG_POS. In that case, relay logs are kept;\nas of MySQL 4.1.1 the relay_log_purge global variable\nis set silently to 0.\n\nCHANGE MASTER TO updates the contents of the *master.info and\n*relay-log.info files.\n\nCHANGE MASTER is useful for setting up a slave when you have\nthe snapshot of the master and have recorded the log and the offset\ncorresponding to it.  After loading the snapshot into the slave, you\ncan run CHANGE MASTER TO MASTER_LOG_FILE=\'log_name_on_master\',\nMASTER_LOG_POS=log_offset_on_master on the slave.\n\nExamples:\n\nmysql> CHANGE MASTER TO\n    ->     MASTER_HOST=\'master2.mycompany.com\',\n    ->     MASTER_USER=\'replication\',\n    ->     MASTER_PASSWORD=\'bigs3cret\',\n    ->     MASTER_PORT=3306,\n    ->     MASTER_LOG_FILE=\'master2-bin.001\',\n    ->     MASTER_LOG_POS=4,\n    ->     MASTER_CONNECT_RETRY=10;\n\nmysql> CHANGE MASTER TO\n    ->     RELAY_LOG_FILE=\'slave-relay-bin.006\',\n    ->     RELAY_LOG_POS=4025;\n','',''),(148,'DROP DATABASE',28,'DROP DATABASE drops all tables in the database and deletes the\ndatabase.  Be /very/ careful with this statement!\nTo use DROP DATABASE, you need the DROP privilege on the\ndatabase.\n\nIn MySQL 3.22 or later, you can use the keywords IF EXISTS\nto prevent an error from occurring if the database doesn\'t exist.\n\nDROP SCHEMA can be used as of MySQL 5.0.2.\n','DROP {DATABASE | SCHEMA} [IF EXISTS] db_name',''),(149,'TIMESTAMP FUNCTION',14,'   TIMESTAMP(expr)\n   TIMESTAMP(expr,expr2)\n\nWith one argument, returns the date or datetime expression expr\nas a datetime value.\nWith two arguments, adds the time expression expr2 to the\ndate or datetime expression expr and returns a datetime value.\n','mysql> SELECT TIMESTAMP(\'2003-12-31\');\n        -> \'2003-12-31 00:00:00\'\nmysql> SELECT TIMESTAMP(\'2003-12-31 12:00:00\',\'12:00:00\');\n        -> \'2004-01-01 00:00:00\'',''),(150,'CHARACTER_LENGTH',23,'   CHARACTER_LENGTH(str)\n\nCHARACTER_LENGTH() is a synonym for CHAR_LENGTH().\n','',''),(151,'CREATE VIEW  ALGORITHM MERGE TEMPTABLE WITH CHECK OPTION',24,'','CREATE [OR REPLACE] [ALGORITHM = {UNDEFINED | MERGE | TEMPTABLE}]\n    VIEW view_name [(column_list)]\n    AS select_statement\n    [WITH [CASCADED | LOCAL] CHECK OPTION]',''),(152,'TIMESTAMPDIFF FUNCTION',14,'','mysql> SELECT TIMESTAMPDIFF(MONTH,\'2003-02-01\',\'2003-05-01\');\n        -> 3\nmysql> SELECT TIMESTAMPDIFF(YEAR,\'2002-05-01\',\'2001-01-01\');\n        -> -1',''),(153,'CRC32',4,'   CRC32(expr)\nComputes a cyclic redundancy check value and returns a 32-bit unsigned value.\nThe result is NULL if the argument is NULL.\nThe argument is expected be a string and is treated as one if it is not.\n','mysql> SELECT CRC32(\'MySQL\');\n        -> 3259397556',''),(154,'XOR',20,'   XOR\nLogical XOR.\nReturns NULL if either operand is NULL.\nFor non-NULL operands, evaluates to 1 if an odd number\nof operands is non-zero,\notherwise 0 is returned.\n','mysql> SELECT 1 XOR 1;\n        -> 0\nmysql> SELECT 1 XOR 0;\n        -> 1\nmysql> SELECT 1 XOR NULL;\n        -> NULL\nmysql> SELECT 1 XOR 1 XOR 1;\n        -> 1',''),(155,'STARTPOINT',18,'   StartPoint(ls)\nReturns the Point that is the start point of the LineString value\nls.\n','mysql> SET @ls = \'LineString(1 1,2 2,3 3)\';\nmysql> SELECT AsText(StartPoint(GeomFromText(@ls)));\n+---------------------------------------+\n| AsText(StartPoint(GeomFromText(@ls))) |\n+---------------------------------------+\n| POINT(1 1)                            |\n+---------------------------------------+',''),(156,'MPOLYFROMTEXT',3,'   MPolyFromText(wkt[,srid])\n   MultiPolygonFromText(wkt[,srid])\nConstructs a MULTIPOLYGON value using its WKT representation and SRID.\n','',''),(157,'MBRINTERSECTS',8,'   MBRIntersects(g1,g2)\nReturns 1 or 0 to indicate whether or not the Minimum Bounding Rectangles of\nthe two geometries g1 and g2 intersect.\n','',''),(158,'BIT_OR',12,'   BIT_OR(expr)\nReturns the bitwise OR of all bits in expr. The calculation is\nperformed with 64-bit (BIGINT) precision.\n','',''),(159,'YEARWEEK',14,'   YEARWEEK(date)\n   YEARWEEK(date,start)\nReturns year and week for a date.  The start argument works exactly\nlike the start argument to WEEK().  The year in the\nresult may be\ndifferent from the year in the date argument for the first and the last\nweek of the year.\n','mysql> SELECT YEARWEEK(\'1987-01-01\');\n        -> 198653',''),(160,'NOT BETWEEN',26,'   expr NOT BETWEEN min AND max\nThis is the same as NOT (expr BETWEEN min AND max).\n','',''),(161,'LOG10',4,'   LOG10(X)\nReturns the base-10 logarithm of X.\n','mysql> SELECT LOG10(2);\n        -> 0.301030\nmysql> SELECT LOG10(100);\n        -> 2.000000\nmysql> SELECT LOG10(-100);\n        -> NULL',''),(162,'SQRT',4,'   SQRT(X)\nReturns the non-negative square root of X.\n','mysql> SELECT SQRT(4);\n        -> 2.000000\nmysql> SELECT SQRT(20);\n        -> 4.472136',''),(163,'DECIMAL',1,'   DECIMAL[(M[,D])] [UNSIGNED] [ZEROFILL]\n\n\nFor MySQL 5.0.3 and above:\n\nA packed ``exact\'\' fixed-point number. M is the total number of\ndigits and D is the number of decimals.  The decimal point and\n(for negative numbers) the \'-\' sign are not counted in M.\nIf D is 0, values have no\ndecimal point or fractional part.  The maximum number of digits\n(M) for DECIMAL is 64. The maximum number of supported\ndecimals (D) is 30.  If UNSIGNED is specified, negative\nvalues are disallowed.\n\nIf D is omitted, the default is 0.  If M is omitted, the\ndefault is 10.\n\nAll basic calculations (+, -, *, /) with DECIMAL columns are\ndone with a precision of 64 decimal digits.\n\nBefore MySQL 5.0.3:\n\nAn unpacked fixed-point number.  Behaves like a CHAR column;\n``unpacked\'\' means the number is stored as a string, using one character for\neach digit of the value.  M is the total number of digits and\nD is the number of decimals.  The decimal point and (for negative\nnumbers) the \'-\' sign are not counted in M, although space for\nthem is reserved. If D is 0, values have no decimal point or\nfractional part.  The maximum range of DECIMAL values is the same as\nfor DOUBLE, but the actual range for a given DECIMAL column\nmay be constrained by the choice of M and D.  If\nUNSIGNED is specified, negative values are disallowed.\n\nIf D is omitted, the default is 0.  If M is omitted, the\ndefault is 10.\n\nBefore MySQL 3.23:\n\nAs just described, with the exception that the M value must be large\nenough to include the space needed for the sign and the decimal point\ncharacters.\n\n   DEC[(M[,D])] [UNSIGNED] [ZEROFILL]\n   NUMERIC[(M[,D])] [UNSIGNED] [ZEROFILL]\n   FIXED[(M[,D])] [UNSIGNED] [ZEROFILL]\n\nThese are synonyms for DECIMAL.  The FIXED synonym was added\nin MySQL 4.1.0 for compatibility with other servers.\n','',''),(164,'GEOMETRYN',5,'   GeometryN(gc,n)\nReturns the n-th geometry in the GeometryCollection value\ngc.  Geometry numbers begin at 1.\n','mysql> SET @gc = \'GeometryCollection(Point(1 1),LineString(2 2, 3 3))\';\nmysql> SELECT AsText(GeometryN(GeomFromText(@gc),1));\n+----------------------------------------+\n| AsText(GeometryN(GeomFromText(@gc),1)) |\n+----------------------------------------+\n| POINT(1 1)                             |\n+----------------------------------------+',''),(165,'CREATE INDEX',28,'In MySQL 3.22 or later, CREATE INDEX is mapped to an\nALTER TABLE statement to create indexes.\nSee also : [ALTER TABLE, , ALTER TABLE].\nThe CREATE INDEX statement doesn\'t do anything prior\nto MySQL 3.22.\n','CREATE [UNIQUE|FULLTEXT|SPATIAL] INDEX index_name\n    [USING index_type]\n    ON tbl_name (index_col_name,...)\n\nindex_col_name:\n    col_name [(length)] [ASC | DESC]',''),(166,'ALTER DATABASE',28,'\nALTER DATABASE allows you to change the overall characteristics of a\ndatabase.  These characteristics are stored in the *db.opt file in the\ndatabase directory.\nTo use ALTER DATABASE, you need the ALTER privilege on the\ndatabase.\n','ALTER {DATABASE | SCHEMA} [db_name]\n    alter_specification [, alter_specification] ...\n\nalter_specification:\n    [DEFAULT] CHARACTER SET charset_name\n  | [DEFAULT] COLLATE collation_name',''),(167,'<<',27,'Shifts a longlong (BIGINT) number to the left.\n   <<\n','mysql> SELECT 1 << 2;\n        -> 4',''),(168,'MD5',17,'   MD5(str)\nCalculates an MD5 128-bit checksum for the string. The value is returned\nas a binary string of 32 hex digits,\nor NULL if the argument was NULL.\nThe return value can, for example, be used as a hash key.\n','mysql> SELECT MD5(\'testing\');\n        -> \'ae2b1fca515949e5d54fb22b8ed95575\'',''),(169,'<',26,'   <\nLess than:\n','mysql> SELECT 2 < 2;\n        -> 0',''),(170,'UNIX_TIMESTAMP',14,'   UNIX_TIMESTAMP()\n   UNIX_TIMESTAMP(date)\nIf called with no argument, returns a Unix timestamp (seconds since\n\'1970-01-01 00:00:00\' GMT) as an unsigned integer. If\nUNIX_TIMESTAMP() is called with a date argument, it\nreturns the value of the argument as seconds since \'1970-01-01\n00:00:00\' GMT.  date may be a DATE string, a\nDATETIME string, a TIMESTAMP, or a number in the format\nYYMMDD or YYYYMMDD in local time.\n','mysql> SELECT UNIX_TIMESTAMP();\n        -> 882226357\nmysql> SELECT UNIX_TIMESTAMP(\'1997-10-04 22:23:00\');\n        -> 875996580',''),(171,'DAYOFMONTH',14,'   DAYOFMONTH(date)\nReturns the day of the month for date, in the range 1 to\n31.\n','mysql> SELECT DAYOFMONTH(\'1998-02-03\');\n        -> 3',''),(172,'ASCII',23,'   ASCII(str)\nReturns the numeric value of the leftmost character of the string\nstr. Returns 0 if str is the empty string.  Returns\nNULL if str is NULL.\nASCII() works for characters with numeric values from 0 to\n255.\n','mysql> SELECT ASCII(\'2\');\n        -> 50\nmysql> SELECT ASCII(2);\n        -> 50\nmysql> SELECT ASCII(\'dx\');\n        -> 100',''),(173,'DIV',4,'Integer division.\nSimilar to FLOOR() but safe with BIGINT values.\n','mysql> SELECT 5 DIV 2;\n        -> 2',''),(174,'RENAME USER',7,'The RENAME USER statement renames existing MySQL accounts.\nTo use it, you must have the global CREATE USER privilege or\nthe UPDATE privilege for the mysql database.\nAn error occurs if any old account does not exist or any new\naccount exists.  The old_user and new_user values are given the\nsame way as for the GRANT statement.\n','RENAME USER old_user TO new_user\n    [, old_user TO new_user] ...',''),(175,'SHOW SLAVE STATUS',7,'SHOW SLAVE STATUS\n\nProvides status information on\nessential parameters of the slave threads. If you issue this statement using\nthe\nmysql client, you can use a \\G statement terminator rather than\nsemicolon to get a more readable vertical layout:\n\nmysql> SHOW SLAVE STATUS\\G\n*************************** 1. row ***************************\n       Slave_IO_State: Waiting for master to send event\n          Master_Host: localhost\n          Master_User: root\n          Master_Port: 3306\n        Connect_Retry: 3\n      Master_Log_File: gbichot-bin.005\n  Read_Master_Log_Pos: 79\n       Relay_Log_File: gbichot-relay-bin.005\n        Relay_Log_Pos: 548\nRelay_Master_Log_File: gbichot-bin.005\n     Slave_IO_Running: Yes\n    Slave_SQL_Running: Yes\n      Replicate_Do_DB:\n  Replicate_Ignore_DB:\n           Last_Errno: 0\n           Last_Error:\n         Skip_Counter: 0\n  Exec_Master_Log_Pos: 79\n      Relay_Log_Space: 552\n      Until_Condition: None\n       Until_Log_File:\n        Until_Log_Pos: 0\n   Master_SSL_Allowed: No\n   Master_SSL_CA_File:\n   Master_SSL_CA_Path:\n      Master_SSL_Cert:\n    Master_SSL_Cipher:\n       Master_SSL_Key:\nSeconds_Behind_Master: 8\n','',''),(176,'GEOMETRY',24,'MySQL provides a standard way of creating spatial columns for\ngeometry types, for example, with CREATE TABLE or ALTER TABLE.\nCurrently, spatial columns are supported only for MyISAM tables.\n','mysql> CREATE TABLE geom (g GEOMETRY);\nQuery OK, 0 rows affected (0.02 sec)',''),(177,'NUMPOINTS',18,'   NumPoints(ls)\nReturns the number of points in the LineString value ls.\n','mysql> SET @ls = \'LineString(1 1,2 2,3 3)\';\nmysql> SELECT NumPoints(GeomFromText(@ls));\n+------------------------------+\n| NumPoints(GeomFromText(@ls)) |\n+------------------------------+\n|                            3 |\n+------------------------------+',''),(178,'&',27,'   &\nBitwise AND:\n','mysql> SELECT 29 & 15;\n        -> 13',''),(179,'LOCALTIMESTAMP',14,'   LOCALTIMESTAMP\n   LOCALTIMESTAMP()\n\nLOCALTIMESTAMP and LOCALTIMESTAMP() are synonyms for\nNOW().\n','',''),(180,'ADDDATE',14,'   ADDDATE(date,INTERVAL expr type)\n   ADDDATE(expr,days)\n\nWhen invoked with the INTERVAL form of the second argument,\nADDDATE() is a synonym for DATE_ADD().  The related\nfunction SUBDATE() is a synonym for DATE_SUB().\nFor information on the INTERVAL argument, see the\ndiscussion for DATE_ADD().\n\nmysql> SELECT DATE_ADD(\'1998-01-02\', INTERVAL 31 DAY);\n        -> \'1998-02-02\'\nmysql> SELECT ADDDATE(\'1998-01-02\', INTERVAL 31 DAY);\n        -> \'1998-02-02\'\n\nAs of MySQL 4.1.1, the second syntax is allowed, where expr is a date\nor datetime expression and days is the number of days to be added to\nexpr.\n\nmysql> SELECT ADDDATE(\'1998-01-02\', 31);\n        -> \'1998-02-02\'\n','',''),(181,'SMALLINT',1,'   SMALLINT[(M)] [UNSIGNED] [ZEROFILL]\n\nA small integer. The signed range is -32768 to 32767. The\nunsigned range is 0 to 65535.\n','',''),(182,'ORD',23,'   ORD(str)\nIf the leftmost character of the string str is a multi-byte character,\nreturns the code for that character, calculated from the numeric values\nof its constituent bytes using this formula:\n\n  (1st byte code)\n+ (2nd byte code * 256)\n+ (3rd byte code * 256^2) ...\n\nIf the leftmost character is not a multi-byte character, ORD()\nreturns the same value as the ASCII() function.\n','mysql> SELECT ORD(\'2\');\n        -> 50',''),(183,'ENVELOPE',19,'   Envelope(g)\nReturns the Minimum Bounding Rectangle (MBR) for the geometry value g.\nThe result is returned as a Polygon value.\n\nmysql> SELECT AsText(Envelope(GeomFromText(\'LineString(1 1,2 2)\')));\n+-------------------------------------------------------+\n| AsText(Envelope(GeomFromText(\'LineString(1 1,2 2)\'))) |\n+-------------------------------------------------------+\n| POLYGON((1 1,2 1,2 2,1 2,1 1))                        |\n+-------------------------------------------------------+\n\nThe polygon is defined by the corner points of the bounding box:\n\nPOLYGON((MINX MINY, MAXX MINY, MAXX MAXY, MINX MAXY, MINX MINY))\n','',''),(184,'IS_FREE_LOCK',21,'   IS_FREE_LOCK(str)\nChecks whether the lock named str is free to use (that is, not locked).\nReturns 1 if the lock is free (no one is using the lock),\n0 if the lock is in use, and\nNULL on errors (such as incorrect arguments).\n','',''),(185,'SHOW BINLOG',6,'SHOW BINLOG EVENTS\n   [IN \'log_name\'] [FROM pos] [LIMIT [offset,] row_count]\n\nShows the events in the binary log.\nIf you do not specify \'log_name\', the first binary log is displayed.\n','',''),(186,'TOUCHES',11,'   Touches(g1,g2)\nReturns 1 or 0 to indicate whether or not g1 spatially touches\ng2. Two geometries /spatially touch/ if the interiors of\nthe geometries do not intersect, but the boundary of one of the geometries\nintersects either the boundary or the interior of the other.\n','',''),(187,'TIMESTAMPADD FUNCTION',14,'','mysql> SELECT TIMESTAMPADD(MINUTE,1,\'2003-01-02\');\n        -> \'2003-01-02 00:01:00\'\nmysql> SELECT TIMESTAMPADD(WEEK,1,\'2003-01-02\');\n        -> \'2003-01-09\'',''),(188,'INET_ATON',21,'   INET_ATON(expr)\nGiven the dotted-quad representation of a network address as a string,\nreturns an integer that represents the numeric value of the address.\nAddresses may be 4- or 8-byte addresses.\n','mysql> SELECT INET_ATON(\'209.207.224.40\');\n        -> 3520061480',''),(189,'AUTO_INCREMENT',1,'The AUTO_INCREMENT attribute can be used to generate a unique\nidentity for new rows:\n','CREATE TABLE animals (\n             id MEDIUMINT NOT NULL AUTO_INCREMENT,\n             name CHAR(30) NOT NULL,\n             PRIMARY KEY (id)\n             );\nINSERT INTO animals (name) VALUES (\'dog\'),(\'cat\'),(\'penguin\'),\n                                  (\'lax\'),(\'whale\'),(\'ostrich\');\nSELECT * FROM animals;',''),(190,'UNCOMPRESS',23,'   UNCOMPRESS(string_to_uncompress)\nUncompresses a string compressed by the COMPRESS() function.\nIf the argument is not a compressed value, the result is NULL.\nThis function requires MySQL to have been compiled with a compression library\nsuch as zlib. Otherwise, the return value is always NULL.\n','mysql> SELECT UNCOMPRESS(COMPRESS(\'any string\'));\n        -> \'any string\'\nmysql> SELECT UNCOMPRESS(\'any string\');\n        -> NULL',''),(191,'ISSIMPLE',19,'   IsSimple(g)\n\nCurrently, this function is a placeholder and should not be used.\nIf implemented, its behavior will be as described in the next paragraph.\n\nReturns 1 if the geometry value g has no anomalous geometric points,\nsuch as self-intersection or self-tangency. IsSimple() returns 0 if the\nargument is not simple, and -1 if it is NULL.\n\nThe description of each instantiable geometric class given earlier in\nthe chapter includes the specific conditions that cause an instance of\nthat class to be classified as not simple.\n','',''),(192,'- BINARY',4,'   -\nSubtraction:\n','mysql> SELECT 3-5;\n        -> -2',''),(193,'GEOMCOLLFROMTEXT',3,'   GeomCollFromText(wkt[,srid])\n   GeometryCollectionFromText(wkt[,srid])\nConstructs a GEOMETRYCOLLECTION value using its WKT representation and SRID.\n','',''),(194,'WKT DEFINITION',3,'The Well-Known Text (WKT) representation of Geometry is designed to\nexchange geometry data in ASCII form.\n','',''),(195,'CURRENT_TIME',14,'   CURRENT_TIME\n   CURRENT_TIME()\n\nCURRENT_TIME and CURRENT_TIME() are synonyms for\nCURTIME().\n','',''),(196,'LAST_INSERT_ID',25,'   LAST_INSERT_ID()\n   LAST_INSERT_ID(expr)\nReturns the last automatically generated value that was inserted into\nan AUTO_INCREMENT column.\n','mysql> SELECT LAST_INSERT_ID();\n        -> 195',''),(197,'LAST_DAY',14,'   LAST_DAY(date)\n\nTakes a date or datetime value and returns the corresponding value for the\nlast day of the month.  Returns NULL if the argument is invalid.\n','mysql> SELECT LAST_DAY(\'2003-02-05\');\n        -> \'2003-02-28\'\nmysql> SELECT LAST_DAY(\'2004-02-05\');\n        -> \'2004-02-29\'\nmysql> SELECT LAST_DAY(\'2004-01-01 01:01:01\');\n        -> \'2004-01-31\'\nmysql> SELECT LAST_DAY(\'2003-03-32\');\n        -> NULL',''),(198,'MEDIUMINT',1,'   MEDIUMINT[(M)] [UNSIGNED] [ZEROFILL]\n\nA medium-size integer. The signed range is -8388608 to\n8388607. The unsigned range is 0 to 16777215.\n','',''),(199,'FLOOR',4,'   FLOOR(X)\nReturns the largest integer value not greater than X.\n','mysql> SELECT FLOOR(1.23);\n        -> 1\nmysql> SELECT FLOOR(-1.23);\n        -> -2',''),(200,'RTRIM',23,'   RTRIM(str)\nReturns the string str with trailing space characters removed.\n','mysql> SELECT RTRIM(\'barbar   \');\n        -> \'barbar\'',''),(201,'DEGREES',4,'   DEGREES(X)\nReturns the argument X, converted from radians to degrees.\n','mysql> SELECT DEGREES(PI());\n        -> 180.000000',''),(202,'EXPLAIN',6,'The EXPLAIN statement can be used either as a synonym for\nDESCRIBE or as a way to obtain information about how MySQL executes\na SELECT statement:\n\n --- The EXPLAIN tbl_name syntax is synonymous with DESCRIBE tbl_name\nor\nSHOW COLUMNS FROM tbl_name.\n --- When you precede a SELECT statement with the keyword EXPLAIN,\nMySQL explains how it would process the SELECT, providing\ninformation about how tables are joined and in which order.\n','EXPLAIN tbl_name',''),(203,'VARCHAR',1,'   [NATIONAL] VARCHAR(M) [BINARY]\n\nA variable-length string.  M represents the maximum column length.\nThe range of M is 1 to 255 before MySQL 4.0.2, 0 to 255 as of MySQL\n4.0.2, and 0 to 65,535 as of MySQL 5.0.3. (The maximum actual length of a\nVARCHAR in MySQL 5.0 is determined by the maximum row size and the\ncharacter set you use. The maximum effective length is 65,532 bytes.)\n\nNote: Before 5.0.3, trailing spaces were removed when\nVARCHAR values were stored, which differs from the standard SQL\nspecification.\n\nFrom MySQL 4.1.0 to 5.0.2, a VARCHAR column with a length\nspecification greater than 255 is converted to the smallest TEXT\ntype that can hold values of the given length.  For example,\nVARCHAR(500) is converted to TEXT, and\nVARCHAR(200000) is converted to MEDIUMTEXT.  This is a\ncompatibility feature.  However, this conversion affects trailing-space\nremoval.\n\nVARCHAR is shorthand for CHARACTER VARYING.\n\nAs of MySQL 4.1.2, the BINARY attribute is shorthand for specifying\nthe binary collation of the column character set.  Sorting and comparison is\nbased on numeric character values.  Before 4.1.2, BINARY attribute\ncauses the column to be treated as a binary string.  Sorting and comparison\nis based on numeric byte values.\n\nStarting from MySQL 5.0.3, VARCHAR is stored with a one-byte or\ntwo-byte length prefix + data.  The length prefix is two bytes if the\nVARCHAR column is declared with a length greater than 255.\n','',''),(204,'UNHEX',23,'   UNHEX(str)\n\nDoes the opposite of HEX(str). That is, it interprets each pair of\nhexadecimal digits in the argument as a number and converts it to the\ncharacter represented by the number. The resulting characters are returned as\na binary string.\n','mysql> SELECT UNHEX(\'4D7953514C\');\n        -> \'MySQL\'\nmysql> SELECT 0x4D7953514C;\n        -> \'MySQL\'\nmysql> SELECT UNHEX(HEX(\'string\'));\n        -> \'string\'\nmysql> SELECT HEX(UNHEX(\'1267\'));\n        -> \'1267\'',''),(205,'- UNARY',4,'   -\nUnary minus. Changes the sign of the argument.\n','mysql> SELECT - 2;\n        -> -2',''),(206,'COS',4,'   COS(X)\nReturns the cosine of X, where X is given in radians.\n','mysql> SELECT COS(PI());\n        -> -1.000000',''),(207,'DATE FUNCTION',14,'   DATE(expr)\n\nExtracts the date part of the date or datetime expression expr.\n','mysql> SELECT DATE(\'2003-12-31 01:02:03\');\n        -> \'2003-12-31\'',''),(208,'RESET MASTER',6,'RESET MASTER\n\nDeletes all binary logs listed in the index file,\nresets the binary log index file to be empty, and creates a new binary log\nfile.\n\nThis statement was named FLUSH MASTER before MySQL 3.23.26.\n','',''),(209,'TAN',4,'   TAN(X)\nReturns the tangent of X, where X is given in radians.\n','mysql> SELECT TAN(PI()+1);\n        -> 1.557408',''),(210,'PI',4,'   PI()\nReturns the value of PI. The default number of decimals displayed is five, but\nMySQL internally uses the full double-precision value for PI.\n','mysql> SELECT PI();\n        -> 3.141593\nmysql> SELECT PI()+0.000000000000000000;\n        -> 3.141592653589793116',''),(211,'WEEKOFYEAR',14,'   WEEKOFYEAR(date)\n\nReturns the calendar week of the date as a number in the\nrange from 1 to 53. It is a compatibility function\nthat is equivalent to WEEK(date,3).\n','mysql> SELECT WEEKOFYEAR(\'1998-02-20\');\n        -> 8',''),(212,'/',4,'   /\nDivision:\n','mysql> SELECT 3/5;\n        -> 0.60',''),(213,'STDDEV_SAMP',12,'   STDDEV_SAMP(expr)\nReturns the sample standard deviation of expr (the square root of\nVAR_SAMP().  This function was added in MySQL 5.0.3.\n','',''),(214,'MLINEFROMWKB',13,'   MLineFromWKB(wkb[,srid])\n   MultiLineStringFromWKB(wkb[,srid])\nConstructs a MULTILINESTRING value using its WKB representation and SRID.\n','',''),(215,'UNCOMPRESSED_LENGTH',23,'   UNCOMPRESSED_LENGTH(compressed_string)\nReturns the length of a compressed string before compression.\n','mysql> SELECT UNCOMPRESSED_LENGTH(COMPRESS(REPEAT(\'a\',30)));\n        -> 30',''),(216,'LOG2',4,'   LOG2(X)\nReturns the base-2 logarithm of X.\n','mysql> SELECT LOG2(65536);\n        -> 16.000000\nmysql> SELECT LOG2(-100);\n        -> NULL',''),(217,'SUBTIME',14,'   SUBTIME(expr,expr2)\n\n\nSUBTIME() subtracts expr2 from expr and returns the result.\nexpr is a time or datetime expression, and expr2 is a time\nexpression.\n','mysql> SELECT SUBTIME(\'1997-12-31 23:59:59.999999\',\n    ->                \'1 1:1:1.000002\');\n        -> \'1997-12-30 22:58:58.999997\'\nmysql> SELECT SUBTIME(\'01:00:00.999999\', \'02:00:00.999998\');\n        -> \'-00:59:59.999999\'',''),(218,'DROP TABLE',28,'DROP TABLE removes one or more tables. You must have the DROP\nprivilege for each table. All table data and the table\ndefinition are /removed/, so /be careful/ with this statement!\n\nIn MySQL 3.22 or later, you can use the keywords IF EXISTS\nto prevent an error from occurring for tables that don\'t exist.  As of\nMySQL 4.1, a NOTE is generated for each non-existent table when\nusing IF EXISTS.\nSee also : [SHOW WARNINGS,  , SHOW WARNINGS].\n\nRESTRICT and CASCADE are allowed to make porting easier.\nFor the moment, they do nothing.\n\nNote: DROP TABLE automatically commits the current\nactive transaction, unless you are using MySQL 4.1 or higher and the\nTEMPORARY keyword.\n','DROP [TEMPORARY] TABLE [IF EXISTS]\n    tbl_name [, tbl_name] ...\n    [RESTRICT | CASCADE]',''),(219,'DUAL',22,'SELECT ... FROM DUAL is an alias for SELECT ....\n(To be compatible with some other databases).\n','',''),(220,'INSTR',23,'   INSTR(str,substr)\nReturns the position of the first occurrence of substring substr in\nstring str. This is the same as the two-argument form of\nLOCATE(), except that the arguments are swapped.\n','mysql> SELECT INSTR(\'foobarbar\', \'bar\');\n        -> 4\nmysql> SELECT INSTR(\'xbar\', \'foobar\');\n        -> 0',''),(221,'NOW',14,'   NOW()\n\nReturns the current date and time as a value in \'YYYY-MM-DD HH:MM:SS\'\nor YYYYMMDDHHMMSS format, depending on whether the function is used in\na string or numeric context.\n','mysql> SELECT NOW();\n        -> \'1997-12-15 23:50:26\'\nmysql> SELECT NOW() + 0;\n        -> 19971215235026',''),(222,'>=',26,'   >=\nGreater than or equal:\n','mysql> SELECT 2 >= 2;\n        -> 1',''),(223,'EXP',4,'   EXP(X)\nReturns the value of e (the base of natural logarithms) raised to\nthe power of X.\n','mysql> SELECT EXP(2);\n        -> 7.389056\nmysql> SELECT EXP(-2);\n        -> 0.135335',''),(224,'SHA',17,'   SHA1(str)\n   SHA(str)\nCalculates an SHA1 160-bit checksum for the string, as described in\nRFC 3174 (Secure Hash Algorithm). The value is returned as a string of 40 hex\ndigits, or NULL if the argument was NULL.\nOne of the possible uses for this function is as a hash key. You can\nalso use it as a cryptographically safe function for storing passwords.\n','mysql> SELECT SHA1(\'abc\');\n        -> \'a9993e364706816aba3e25717850c26c9cd0d89d\'',''),(225,'LONGBLOB',1,'   LONGBLOB\n\nA BLOB column with a maximum length of 4,294,967,295 or\n4GB (2^32 - 1) bytes.  Up to MySQL\n3.23, the client/server protocol and MyISAM tables had a limit\nof 16MB per communication packet / table row. From MySQL 4.0, the maximum\nallowed length of LONGBLOB columns depends on the\nconfigured maximum packet size in the client/server protocol and available\nmemory.\n','',''),(226,'POINTN',18,'   PointN(ls,n)\nReturns the n-th point in the Linestring value ls.\nPoint numbers begin at 1.\n','mysql> SET @ls = \'LineString(1 1,2 2,3 3)\';\nmysql> SELECT AsText(PointN(GeomFromText(@ls),2));\n+-------------------------------------+\n| AsText(PointN(GeomFromText(@ls),2)) |\n+-------------------------------------+\n| POINT(2 2)                          |\n+-------------------------------------+',''),(227,'SUM',12,'   SUM([DISTINCT] expr)\nReturns the sum of expr.  If the return set has no rows,\nSUM() returns NULL.\nThe DISTINCT keyword can be used as of MySQL 5.0.0 to sum only the\ndistinct values of expr.\n','',''),(228,'OCT',23,'   OCT(N)\nReturns a string representation of the octal value of N, where\nN is a longlong (BIGINT)number.  This is equivalent to\nCONV(N,10,8).\nReturns NULL if N is NULL.\n','mysql> SELECT OCT(12);\n        -> \'14\'',''),(229,'SYSDATE',14,'   SYSDATE()\n\nSYSDATE() is a synonym for NOW().\n','',''),(230,'ASBINARY',13,'   AsBinary(g)\nConverts a value in internal geometry format to its WKB representation\nand returns the binary result.\n','SELECT AsBinary(g) FROM geom;',''),(231,'MAKEDATE',14,'   MAKEDATE(year,dayofyear)\n\nReturns a date, given year and day-of-year values.\ndayofyear must be greater than 0 or the result is NULL.\n','mysql> SELECT MAKEDATE(2001,31), MAKEDATE(2001,32);\n        -> \'2001-01-31\', \'2001-02-01\'\nmysql> SELECT MAKEDATE(2001,365), MAKEDATE(2004,365);\n        -> \'2001-12-31\', \'2004-12-30\'\nmysql> SELECT MAKEDATE(2001,0);\n        -> NULL',''),(232,'BINARY OPERATOR',23,'   BINARY\nThe BINARY operator casts the string following it to a binary string.\nThis is an easy way to force a column comparison to be done byte by byte\nrather than character by character. This causes the comparison to be\ncase sensitive even\nif the column isn\'t defined as BINARY or BLOB.\nBINARY also causes trailing spaces to be significant.\n','mysql> SELECT \'a\' = \'A\';\n        -> 1\nmysql> SELECT BINARY \'a\' = \'A\';\n        -> 0\nmysql> SELECT \'a\' = \'a \';\n        -> 1\nmysql> SELECT BINARY \'a\' = \'a \';\n        -> 0',''),(233,'MBROVERLAPS',8,'   MBROverlaps(g1,g2)\nReturns 1 or 0 to indicate whether or not the Minimum Bounding Rectangles of\nthe two geometries g1 and g2 overlap.\n','',''),(234,'SOUNDEX',23,'   SOUNDEX(str)\nReturns a soundex string from str. Two strings that sound almost the\nsame should have identical soundex strings. A standard soundex string\nis four characters long, but the SOUNDEX() function returns an\narbitrarily long string. You can use SUBSTRING() on the result to get\na standard soundex string.  All non-alphabetic characters are ignored in the\ngiven string. All international alphabetic characters outside the A-Z range\nare treated as vowels.\n','mysql> SELECT SOUNDEX(\'Hello\');\n        -> \'H400\'\nmysql> SELECT SOUNDEX(\'Quadratically\');\n        -> \'Q36324\'',''),(235,'SHOW MASTER LOGS',6,'SHOW MASTER LOGS\nSHOW BINARY LOGS\n\nLists the binary log files on the server. This statement is used as part of\nthe procedure described in [PURGE MASTER LOGS,  , PURGE MASTER LOGS]\nfor determining which logs can be purged.\n\nmysql> SHOW BINARY LOGS;\n+---------------+-----------+\n| Log_name      | File_size |\n+---------------+-----------+\n| binlog.000015 |    724935 |\n| binlog.000016 |    733481 |\n+---------------+-----------+\n','',''),(236,'MBRTOUCHES',8,'   MBRTouches(g1,g2)\nReturns 1 or 0 to indicate whether or not the Minimum Bounding Rectangles of\nthe two geometries g1 and g2 touch.\n','',''),(237,'INSERT SELECT',6,'INSERT [LOW_PRIORITY | HIGH_PRIORITY] [IGNORE]\n    [INTO] tbl_name [(col_name,...)]\n    SELECT ...\n    [ ON DUPLICATE KEY UPDATE col_name=expr, ... ]\n\nWith INSERT ... SELECT, you can quickly insert many rows\ninto a table from one or many tables.\n','INSERT INTO tbl_temp2 (fld_id)\n    SELECT tbl_temp1.fld_order_id\n    FROM tbl_temp1 WHERE tbl_temp1.fld_order_id > 100;',''),(238,'VARBINARY',1,'   VARBINARY(M)\n\nThe VARBINARY type is similar to the VARCHAR type, but stores\nbinary byte strings rather than non-binary character strings.\n\nThis type was added in MySQL 4.1.2.\n','',''),(239,'LOAD INDEX',6,'The LOAD INDEX INTO CACHE statement preloads a table index into the\nkey cache to which it has been assigned by an explicit CACHE INDEX\nstatement, or into the default key cache otherwise.  LOAD INDEX INTO\nCACHE is used only for MyISAM tables.\n\nThe IGNORE LEAVES modifier causes only blocks for the non-leaf\nnodes of the index to be preloaded.\n','LOAD INDEX INTO CACHE\n  tbl_index_list [, tbl_index_list] ...\n\ntbl_index_list:\n  tbl_name\n    [[INDEX|KEY] (index_name[, index_name] ...)]\n    [IGNORE LEAVES]',''),(240,'UNION',6,'UNION is used to combine the result from many SELECT\nstatements into one result set.  UNION is available from MySQL 4.0.0\non.\n\nSelected columns listed in corresponding positions of each SELECT\nstatement should have the same type. (For example, the first column selected\nby the first statement should have the same type as the first column selected\nby the other statements.) The column names used in\nthe first SELECT statement are used as the column names for the\nresults returned.\n','SELECT ...\nUNION [ALL | DISTINCT]\nSELECT ...\n  [UNION [ALL | DISTINCT]\n   SELECT ...]',''),(241,'TO_DAYS',14,'   TO_DAYS(date)\nGiven a date date, returns a daynumber (the number of days since year\n0).\n','mysql> SELECT TO_DAYS(950501);\n        -> 728779\nmysql> SELECT TO_DAYS(\'1997-10-07\');\n        -> 729669',''),(242,'NOT REGEXP',23,'   expr NOT REGEXP pat\n   expr NOT RLIKE pat\n\nThis is the same as NOT (expr REGEXP pat).\n','',''),(243,'NOT IN',26,'   expr NOT IN (value,...)\nThis is the same as NOT (expr IN (value,...)).\n','',''),(244,'!',20,'   NOT\n   !\nLogical NOT.\nEvaluates to 1 if the operand is 0,\nto 0 if the operand is non-zero,\nand NOT NULL returns NULL.\n','mysql> SELECT NOT 10;\n        -> 0\nmysql> SELECT NOT 0;\n        -> 1\nmysql> SELECT NOT NULL;\n        -> NULL\nmysql> SELECT ! (1+1);\n        -> 0\nmysql> SELECT ! 1+1;\n        -> 1',''),(245,'TEXT TYPE',1,'   TEXT[(M)]\n\nA TEXT column with a maximum length of 65,535\n(2^16 - 1) characters.\n\nBeginning with MySQL 4.1, an optional length M can be given.\nMySQL will create the column as the smallest TEXT type largest\nenough to hold values M characters long.\n','',''),(246,'DOUBLE',1,'   DOUBLE[(M,B)] [UNSIGNED] [ZEROFILL]\n\nA normal-size (double-precision) floating-point number. Allowable values are\n-1.7976931348623157E+308 to -2.2250738585072014E-308,\n0, and 2.2250738585072014E-308 to 1.7976931348623157E+308.\nIf UNSIGNED is specified, negative values are disallowed. M is the\ndisplay width and B is the number of bits of precision. DOUBLE\nwithout arguments or FLOAT(p) (where p is in the range from\n25 to 53) stands for a double-precision floating-point number. A\nsingle-precision floating-point number is accurate to approximately 7 decimal\nplaces; a double-precision floating-point number is accurate to approximately 15\ndecimal places.\n\n   DOUBLE PRECISION[(M,D)] [UNSIGNED] [ZEROFILL]\n   REAL[(M,D)] [UNSIGNED] [ZEROFILL]\n\nThese are synonyms for DOUBLE.\nException: If the server SQL mode includes the REAL_AS_FLOAT option,\nREAL is a synonym for FLOAT rather than DOUBLE.\n','',''),(247,'TIME',1,'   TIME\n\nA time.  The range is \'-838:59:59\' to \'838:59:59\'.\nMySQL displays TIME values in \'HH:MM:SS\' format, but\nallows you to assign values to TIME columns using either strings or\nnumbers.\n','',''),(248,'&&',20,'   AND\n   &&\nLogical AND.\nEvaluates to 1 if all operands are non-zero and not NULL,\nto 0 if one or more operands are 0,\notherwise NULL is returned.\n','mysql> SELECT 1 && 1;\n        -> 1\nmysql> SELECT 1 && 0;\n        -> 0\nmysql> SELECT 1 && NULL;\n        -> NULL\nmysql> SELECT 0 && NULL;\n        -> 0\nmysql> SELECT NULL && 0;\n        -> 0',''),(249,'X',16,'   X(p)\nReturns the X-coordinate value for the point p as a double-precision\nnumber.\n','mysql> SELECT X(GeomFromText(\'Point(56.7 53.34)\'));\n+--------------------------------------+\n| X(GeomFromText(\'Point(56.7 53.34)\')) |\n+--------------------------------------+\n|                                 56.7 |\n+--------------------------------------+',''),(250,'FOUND_ROWS',25,'\nA SELECT statement may include a LIMIT clause to restrict the\nnumber of rows the server returns to the client.\nIn some cases, it is desirable to know how many rows the statement would have\nreturned without the LIMIT, but without running the statement again.\nTo get this row count, include a SQL_CALC_FOUND_ROWS option in the\nSELECT statement, then invoke FOUND_ROWS() afterward:\n','mysql> SELECT SQL_CALC_FOUND_ROWS * FROM tbl_name\n    -> WHERE id > 100 LIMIT 10;\nmysql> SELECT FOUND_ROWS();',''),(251,'SYSTEM_USER',25,'   SYSTEM_USER()\n\nSYSTEM_USER() is a synonym for USER().\n','',''),(252,'CROSSES',11,'   Crosses(g1,g2)\nReturns 1 if g1 spatially crosses g2.\nReturns NULL if g1 is a Polygon or a MultiPolygon,\nor if g2 is a Point or a MultiPoint.\nOtherwise, returns 0.\n\nThe term /spatially crosses/ denotes a spatial relation between two given\ngeometries that has the following properties:\n\n\n --- The two geometries intersect\n\n --- Their intersection results in a geometry that has\na dimension that is one less than the maximum dimension of the two given\ngeometries\n\n --- Their intersection is not equal to either of the two given geometries\n','',''),(253,'TRUNCATE TABLE',6,'TRUNCATE TABLE empties a table completely.\nLogically, this is equivalent to a DELETE statement that deletes all\nrows, but there are practical differences under some circumstances.\n\nFor InnoDB before version 5.0.3, TRUNCATE TABLE is\nmapped to DELETE, so there is no difference.  Starting with\nMySQL/InnoDB-5.0.3, fast TRUNCATE TABLE is available.  The\noperation is still mapped to DELETE if there are foreign\nkey constraints that reference the table.\n\nFor other storage engines, TRUNCATE TABLE differs from\nDELETE FROM in the following ways from MySQL 4.0 and up:\n\n --- Truncate operations drop and re-create the table, which is much faster\nthan deleting rows one by one.\n --- Truncate operations are not transaction-safe; you get an error if\nyou have an active transaction or an active table lock.\n --- The number of deleted rows is not returned.\n --- As long as the table definition file *tbl_name.frm is\nvalid, the table can be re-created as an empty table with TRUNCATE\nTABLE, even if the data or index files have become corrupted.\n --- The table handler does not remember the last used AUTO_INCREMENT\nvalue, but starts counting from the beginning.  This is true even for\nMyISAM and InnoDB, which normally does not reuse sequence values.\n\nIn MySQL 3.23, TRUNCATE TABLE is mapped to\nCOMMIT; DELETE FROM tbl_name, so it behaves like DELETE.\nSee also : [DELETE,  , DELETE].\n\nTRUNCATE TABLE is an Oracle SQL extension.\nThis statement was added in MySQL 3.23.28, although from 3.23.28\nto 3.23.32, the keyword TABLE must be omitted.\n','TRUNCATE TABLE tbl_name',''),(254,'CURRENT_DATE',14,'   CURRENT_DATE\n   CURRENT_DATE()\n\nCURRENT_DATE and CURRENT_DATE() are synonyms for\nCURDATE().\n','',''),(255,'BIT_XOR',12,'   BIT_XOR(expr)\nReturns the bitwise XOR of all bits in expr. The calculation is\nperformed with 64-bit (BIGINT) precision.\n','',''),(256,'AREA',0,'   Area(poly)\nReturns as a double-precision number the area of the Polygon value\npoly, as measured in its spatial reference system.\n','mysql> SET @poly = \'Polygon((0 0,0 3,3 0,0 0),(1 1,1 2,2 1,1 1))\';\nmysql> SELECT Area(GeomFromText(@poly));\n+---------------------------+\n| Area(GeomFromText(@poly)) |\n+---------------------------+\n|                         4 |\n+---------------------------+',''),(257,'START SLAVE',7,'START SLAVE [thread_type [, thread_type] ... ]\nSTART SLAVE [SQL_THREAD] UNTIL\n    MASTER_LOG_FILE = \'log_name\', MASTER_LOG_POS = log_pos\nSTART SLAVE [SQL_THREAD] UNTIL\n    RELAY_LOG_FILE = \'log_name\', RELAY_LOG_POS = log_pos\n\nthread_type: IO_THREAD | SQL_THREAD\n\nSTART SLAVE with no options starts both of the slave threads.\nThe I/O thread reads queries from the master server and stores them in the\nrelay log.  The SQL thread reads the relay log and executes the\nqueries.\nSTART SLAVE requires the SUPER privilege.\n\nIf START SLAVE succeeds in starting the slave threads, it\nreturns without any error. However, even in that case, it might be that the slave\nthreads start and then later stop (for example, because they don\'t manage to\nconnect to the master or read its binary logs, or some other\nproblem). START SLAVE does not warn you about this. You must\ncheck your slave\'s error log for error messages generated by\nthe slave threads, or check that they are running fine with SHOW\nSLAVE STATUS.\n','',''),(258,'FLUSH',6,'You should use the FLUSH statement if you want to clear some of the\ninternal caches MySQL uses.  To execute FLUSH, you must have\nthe RELOAD privilege.\n','FLUSH [LOCAL | NO_WRITE_TO_BINLOG] flush_option [, flush_option] ...',''),(259,'DESCRIBE',7,'{DESCRIBE | DESC} tbl_name [col_name | wild]\n\nDESCRIBE provides information about the columns in a table.  It is a\nshortcut for SHOW COLUMNS FROM. As of MySQL 5.0.1, these statements\nalso display information for views.\n','',''),(260,'STDDEV_POP',12,'   STDDEV_POP(expr)\nReturns the population standard deviation of expr (the square root of\nVAR_POP()).  This function was added in MySQL 5.0.3.  Before 5.0.3,\nyou can use STD() or STDDEV(), which are equivalent but not\nstandard SQL.\n','',''),(261,'SUBSTRING',23,'   SUBSTRING(str,pos)\n   SUBSTRING(str FROM pos)\n   SUBSTRING(str,pos,len)\n   SUBSTRING(str FROM pos FOR len)\n\nThe forms without a len argument\nreturn a substring from string str starting at position pos.\nThe forms with a len argument\nreturn a substring len characters long from string str,\nstarting at position pos.\nThe forms that use FROM are standard SQL syntax.\n','mysql> SELECT SUBSTRING(\'Quadratically\',5);\n        -> \'ratically\'\nmysql> SELECT SUBSTRING(\'foobarbar\' FROM 4);\n        -> \'barbar\'\nmysql> SELECT SUBSTRING(\'Quadratically\',5,6);\n        -> \'ratica\'',''),(262,'ISEMPTY',19,'   IsEmpty(g)\nReturns 1 if the geometry value g is the empty geometry, 0 if it is not\nempty, and -1 if the argument is NULL.\nIf the geometry is empty, it represents the empty point set.\n','',''),(263,'LTRIM',23,'   LTRIM(str)\nReturns the string str with leading space characters removed.\n','mysql> SELECT LTRIM(\'  barbar\');\n        -> \'barbar\'',''),(264,'REPAIR',7,'REPAIR TABLE repairs a possibly corrupted table.\nBy default,\nit has the same effect as myisamchk --recover tbl_name.\nREPAIR TABLE works only on MyISAM tables.\n','REPAIR [LOCAL | NO_WRITE_TO_BINLOG] TABLE\n    tbl_name [, tbl_name] ... [QUICK] [EXTENDED] [USE_FRM]',''),(265,'INTERSECTS',11,'   Intersects(g1,g2)\nReturns 1 or 0 to indicate whether or not g1 spatially intersects\ng2.\n','',''),(266,'MBRDISJOINT',8,'   MBRDisjoint(g1,g2)\nReturns 1 or 0 to indicate whether or not the Minimum Bounding Rectangles of\nthe two geometries g1 and g2 are disjoint (do not intersect).\n','',''),(267,'SUBSTRING_INDEX',23,'   SUBSTRING_INDEX(str,delim,count)\nReturns the substring from string str before count\noccurrences of the delimiter delim.\nIf count is positive, everything to the left of the final delimiter\n(counting from the left) is returned.\nIf count is negative, everything to the right of the final delimiter\n(counting from the right) is returned.\n','mysql> SELECT SUBSTRING_INDEX(\'www.mysql.com\', \'.\', 2);\n        -> \'www.mysql\'\nmysql> SELECT SUBSTRING_INDEX(\'www.mysql.com\', \'.\', -2);\n        -> \'mysql.com\'',''),(268,'ENCODE',17,'   ENCODE(str,pass_str)\nEncrypt str using pass_str as the password.\nTo decrypt the result, use DECODE().\n\nThe result is a binary string of the same length as str.\nIf you want to save it in a column, use a BLOB column type.\n','',''),(269,'TRUNCATE',4,'   TRUNCATE(X,D)\nReturns the number X, truncated to D decimals.  If D\nis 0, the result has no decimal point or fractional part.\nD can be negative to truncate (make zero) D digits left of the\ndecimal point of the value X.\n','mysql> SELECT TRUNCATE(1.223,1);\n        -> 1.2\nmysql> SELECT TRUNCATE(1.999,1);\n        -> 1.9\nmysql> SELECT TRUNCATE(1.999,0);\n        -> 1\nmysql> SELECT TRUNCATE(-1.999,1);\n        -> -1.9\nmysql> SELECT TRUNCATE(122,-2);\n       -> 100',''),(270,'TIMESTAMPADD',14,'   TIMESTAMPADD(interval,int_expr,datetime_expr)\n\nAdds the integer expression int_expr to the date or datetime expression\ndatetime_expr. The unit for int_expr is given by the\ninterval argument, which should be one of the following values:\nFRAC_SECOND,\nSECOND,\nMINUTE,\nHOUR,\nDAY,\nWEEK,\nMONTH,\nQUARTER,\nor\nYEAR.\n\nThe interval value may be specified using one of keywords as shown,\nor with a prefix of SQL_TSI_. For example, DAY or\nSQL_TSI_DAY both are legal.\n','',''),(271,'SHOW',6,'\nSHOW has many forms that provide information about databases,\ntables, columns, or status information about the server.\nThis section describes those following:\n\nSHOW [FULL] COLUMNS FROM tbl_name [FROM db_name] [LIKE \'pattern\']\nSHOW CREATE DATABASE db_name\nSHOW CREATE TABLE tbl_name\nSHOW DATABASES [LIKE \'pattern\']\nSHOW ENGINE engine_name {LOGS | STATUS }\nSHOW [STORAGE] ENGINES\nSHOW ERRORS [LIMIT [offset,] row_count]\nSHOW GRANTS FOR user\nSHOW INDEX FROM tbl_name [FROM db_name]\nSHOW INNODB STATUS\nSHOW [BDB] LOGS\nSHOW PRIVILEGES\nSHOW [FULL] PROCESSLIST\nSHOW [GLOBAL | SESSION] STATUS [LIKE \'pattern\']\nSHOW TABLE STATUS [FROM db_name] [LIKE \'pattern\']\nSHOW [OPEN] TABLES [FROM db_name] [LIKE \'pattern\']\nSHOW [GLOBAL | SESSION] VARIABLES [LIKE \'pattern\']\nSHOW WARNINGS [LIMIT [offset,] row_count]\n\n\nThe SHOW statement also has forms that provide information about\nreplication master and slave servers and are described in [Replication\nSQL]:\n\nSHOW BINLOG EVENTS\nSHOW MASTER LOGS\nSHOW MASTER STATUS\nSHOW SLAVE HOSTS\nSHOW SLAVE STATUS\n\nIf the syntax for a given SHOW statement includes a LIKE\n\'pattern\' part, \'pattern\' is a string that can contain the SQL \'%\'\nand \'_\' wildcard characters.\nThe pattern is useful for restricting statement output to matching values.\n','',''),(272,'GREATEST',26,'   GREATEST(value1,value2,...)\nWith two or more arguments, returns the largest (maximum-valued) argument.\nThe arguments are compared using the same rules as for LEAST().\n','mysql> SELECT GREATEST(2,0);\n        -> 2\nmysql> SELECT GREATEST(34.0,3.0,5.0,767.0);\n        -> 767.0\nmysql> SELECT GREATEST(\'B\',\'A\',\'C\');\n        -> \'C\'',''),(273,'OCTETLENGTH',23,'   OCTET_LENGTH(str)\n\nOCTET_LENGTH() is a synonym for LENGTH().\n','',''),(274,'SECOND',14,'   SECOND(time)\nReturns the second for time, in the range 0 to 59.\n','mysql> SELECT SECOND(\'10:05:03\');\n        -> 3',''),(275,'BIT_AND',12,'   BIT_AND(expr)\nReturns the bitwise AND of all bits in expr. The calculation is\nperformed with 64-bit (BIGINT) precision.\n','mysql> SELECT order.custid, customer.name, MAX(payments)\n    ->        FROM order,customer\n    ->        WHERE order.custid = customer.custid\n    ->        GROUP BY order.custid;',''),(276,'ATAN2',4,'   ATAN(Y,X)\n   ATAN2(Y,X)\nReturns the arc tangent of the two variables X and Y. It is\nsimilar to calculating the arc tangent of Y / X, except that the\nsigns of both arguments are used to determine the quadrant of the\nresult.\n','mysql> SELECT ATAN(-2,2);\n        -> -0.785398\nmysql> SELECT ATAN2(PI(),0);\n        -> 1.570796',''),(277,'MBRCONTAINS',8,'   MBRContains(g1,g2)\nReturns 1 or 0 to indicate whether or not the Minimum Bounding Rectangle of\ng1 contains the Minimum Bounding Rectangle of g2.\n','mysql> SET @g1 = GeomFromText(\'Polygon((0 0,0 3,3 3,3 0,0 0))\');\nmysql> SET @g2 = GeomFromText(\'Point(1 1)\');\nmysql> SELECT MBRContains(@g1,@g2), MBRContains(@g2,@g1);\n----------------------+----------------------+\n| MBRContains(@g1,@g2) | MBRContains(@g2,@g1) |\n+----------------------+----------------------+\n|                    1 |                    0 |\n+----------------------+----------------------+',''),(278,'HOUR',14,'   HOUR(time)\nReturns the hour for time. The range of the return value is\n0 to 23 for time-of-day values.\n','mysql> SELECT HOUR(\'10:05:03\');\n        -> 10',''),(279,'TYPE SET',1,'   SET(\'value1\',\'value2\',...)\n\nA set.  A string object that can have zero or more values, each of which must\nbe chosen from the list of values \'value1\', \'value2\',\n... A SET column can have a maximum of 64 members.\nSET values are represented internally as integers.\n  \n','',''),(280,'SELECT',6,'SELECT is used to retrieve rows selected from one or more tables.\nSupport for UNION statements and subqueries is available as of MySQL\n4.0 and 4.1, respectively.\nSee [UNION,  , UNION] and [Subqueries].\n\n --- Each select_expr indicates a column you want to retrieve.\n\n --- table_references indicates the table or tables from which to retrieve rows.\nIts syntax is described in [JOIN,  , JOIN].\n\n --- where_definition consists of the keyword WHERE followed by\nan expression that indicates the condition or conditions that rows\nmust satisfy to be selected.\n\n\nSELECT can also be used to retrieve rows computed without reference to\nany table.\n','SELECT\n    [ALL | DISTINCT | DISTINCTROW ]\n      [HIGH_PRIORITY]\n      [STRAIGHT_JOIN]\n      [SQL_SMALL_RESULT] [SQL_BIG_RESULT] [SQL_BUFFER_RESULT]\n      [SQL_CACHE | SQL_NO_CACHE] [SQL_CALC_FOUND_ROWS]\n    select_expr, ...\n    [INTO OUTFILE \'file_name\' export_options\n      | INTO DUMPFILE \'file_name\']\n    [FROM table_references\n      [WHERE where_definition]\n      [GROUP BY {col_name | expr | position}\n        [ASC | DESC], ... [WITH ROLLUP]]\n      [HAVING where_definition]\n      [ORDER BY {col_name | expr | position}\n        [ASC | DESC] , ...]\n      [LIMIT {[offset,] row_count | row_count OFFSET offset}]\n      [PROCEDURE procedure_name(argument_list)]\n      [FOR UPDATE | LOCK IN SHARE MODE]]',''),(281,'COT',4,'   COT(X)\nReturns the cotangent of X.\n','mysql> SELECT COT(12);\n        -> -1.57267341\nmysql> SELECT COT(0);\n        -> NULL',''),(282,'BACKUP TABLE',7,'Note: This statement is deprecated. We are working on a better\nreplacement for it that will provide online backup capabilities.\nIn the meantime, the mysqlhotcopy script can be used instead.\n\nBACKUP TABLE copies to the backup directory the minimum number of\ntable files needed to restore the table, after flushing any buffered changes\nto disk. The statement works only for MyISAM tables.  It copies the\n*.frm definition  and *.MYD data files. The *.MYI\nindex file can be rebuilt from those two files.\nThe directory should be specified as a full pathname.\n','BACKUP TABLE tbl_name [, tbl_name] ... TO \'/path/to/backup/directory\'',''),(283,'LOAD_FILE',23,'   LOAD_FILE(file_name)\nReads the file and returns the file contents as a string.  The file\nmust be located on the server, you must specify the full pathname to the\nfile, and you must have the FILE privilege.  The file must\nbe readable by all and be smaller than max_allowed_packet bytes.\n\nIf the file doesn\'t exist or cannot be read because one of the preceding\nconditions is not satisfied, the function returns NULL.\n','mysql> UPDATE tbl_name\n           SET blob_column=LOAD_FILE(\'/tmp/picture\')\n           WHERE id=1;',''),(284,'POINTFROMTEXT',3,'   PointFromText(wkt[,srid])\nConstructs a POINT value using its WKT representation and SRID.\n','',''),(285,'LOAD TABLE FROM MASTER',6,'LOAD TABLE tbl_name FROM MASTER\n\nTransfers a copy of the table from master to the slave. This statement is\nimplemented mainly for debugging of LOAD DATA FROM MASTER.\nIt requires that the account used for connecting to the master server has the\nRELOAD and SUPER privileges on the master and the\nSELECT privilege on the master table to load.\nOn the slave side, the user that issues LOAD TABLE FROM MASTER should\nhave privileges to drop and create the table.\n\nThe conditions for LOAD DATA FROM MASTER apply here, too. For\nexample, LOAD TABLE FROM MASTER works only for MyISAM tables.\nThe timeout notes for LOAD DATA FROM MASTER apply as well.\n','',''),(286,'GROUP_CONCAT',12,'   GROUP_CONCAT(expr)\nThis function returns a string result with the concatenated non-NULL\nvalues from a group.  It returns NULL if there are no non-NULL\nvalues. The full syntax is as follows:\n\nGROUP_CONCAT([DISTINCT] expr [,expr ...]\n             [ORDER BY {unsigned_integer | col_name | expr}\n                 [ASC | DESC] [,col_name ...]]\n             [SEPARATOR str_val])\n','mysql> SELECT student_name,\n    ->     GROUP_CONCAT(test_score)\n    ->     FROM student\n    ->     GROUP BY student_name;',''),(287,'DATE_FORMAT',14,'   DATE_FORMAT(date,format)\nFormats the date value according to the format string. The\nfollowing specifiers may be used in the format string:\n\n     Specifier 	 Description\n   %a 	 Abbreviated weekday name (Sun..Sat)\n   %b 	 Abbreviated month name (Jan..Dec)\n   %c 	 Month, numeric (0..12)\n   %D 	 Day of the month with English suffix (0th, 1st, 2nd, 3rd, ...)\n   %d 	 Day of the month, numeric (00..31)\n   %e 	 Day of the month, numeric (0..31)\n   %f 	 Microseconds (000000..999999)\n   %H 	 Hour (00..23)\n   %h 	 Hour (01..12)\n   %I 	 Hour (01..12)\n   %i 	 Minutes, numeric (00..59)\n   %j 	 Day of year (001..366)\n   %k 	 Hour (0..23)\n   %l 	 Hour (1..12)\n   %M 	 Month name (January..December)\n   %m 	 Month, numeric (00..12)\n   %p 	 AM or PM\n   %r 	 Time, 12-hour (hh:mm:ss followed by AM or PM)\n   %S 	 Seconds (00..59)\n   %s 	 Seconds (00..59)\n   %T 	 Time, 24-hour (hh:mm:ss)\n   %U 	 Week (00..53), where Sunday is the first day of the week\n   %u 	 Week (00..53), where Monday is the first day of the week\n   %V 	 Week (01..53), where Sunday is the first day of the week; used with %X\n   %v 	 Week (01..53), where Monday is the first day of the week; used with %x\n   %W 	 Weekday name (Sunday..Saturday)\n   %w 	 Day of the week (0=Sunday..6=Saturday)\n   %X 	 Year for the week where Sunday is the first day of the week, numeric, four digits; used with %V\n   %x 	 Year for the week, where Monday is the first day of the week, numeric, four digits; used with %v\n   %Y 	 Year, numeric, four digits\n   %y 	 Year, numeric, two digits\n   %% 	 A literal \'%\'.\n  \n\nAll other characters are copied to the result without interpretation.\n\nThe %v, %V, %x, and %X format specifiers are\navailable as of MySQL 3.23.8.  %f is available as of MySQL 4.1.1.\n\nAs of MySQL 3.23, the \'%\' character is required before\nformat specifier characters.  In earlier versions of MySQL,\n\'%\' was optional.\n\nThe reason the ranges for the month and day specifiers begin with zero\nis that MySQL allows incomplete dates such as \'2004-00-00\' to be\nstored as of MySQL 3.23.\n','mysql> SELECT DATE_FORMAT(\'1997-10-04 22:23:00\', \'%W %M %Y\');\n        -> \'Saturday October 1997\'\nmysql> SELECT DATE_FORMAT(\'1997-10-04 22:23:00\', \'%H:%i:%s\');\n        -> \'22:23:00\'\nmysql> SELECT DATE_FORMAT(\'1997-10-04 22:23:00\',\n                          \'%D %y %a %d %m %b %j\');\n        -> \'4th 97 Sat 04 10 Oct 277\'\nmysql> SELECT DATE_FORMAT(\'1997-10-04 22:23:00\',\n                          \'%H %k %I %r %T %S %w\');\n        -> \'22 22 10 10:23:00 PM 22:23:00 00 6\'\nmysql> SELECT DATE_FORMAT(\'1999-01-01\', \'%X %V\');\n        -> \'1998 52\'',''),(288,'BENCHMARK',25,'   BENCHMARK(count,expr)\nThe BENCHMARK() function executes the expression expr\nrepeatedly count times.  It may be used to time how fast MySQL\nprocesses the expression.  The result value is always 0.  The intended\nuse is from within the mysql client, which reports query execution times:\n','mysql> SELECT BENCHMARK(1000000,ENCODE(\'hello\',\'goodbye\'));\n+----------------------------------------------+\n| BENCHMARK(1000000,ENCODE(\'hello\',\'goodbye\')) |\n+----------------------------------------------+\n|                                            0 |\n+----------------------------------------------+\n1 row in set (4.74 sec)',''),(289,'YEAR',14,'   YEAR(date)\nReturns the year for date, in the range 1000 to 9999.\n','mysql> SELECT YEAR(\'98-02-03\');\n        -> 1998',''),(290,'SHOW ENGINE',6,'SHOW ENGINE displays log or status information about storage engines.\nThe following statements currently are supported:\n\nSHOW ENGINE BDB LOGS\nSHOW ENGINE INNODB STATUS\n\nSHOW ENGINE BDB LOGS displays status information about existing\nBDB log files. It returns the following fields:\n\n\n   File\nThe full path to the log file.\n\n   Type\nThe log file type (BDB for Berkeley DB log files).\n\n   Status\nThe status of the log file (FREE if the file can be removed, or\nIN USE if the file is needed by the transaction subsystem)\n\n  \n\nSHOW ENGINE INNODB STATUS displays extensive information about the\nstate of the InnoDB storage engine.\n\nOlder (and now deprecated) synonyms for these statements are SHOW [BDB]\nLOGS and SHOW INNODB STATUS.\n\nSHOW ENGINE can be used as of MySQL 4.1.2.\n','SHOW ENGINE engine_name {LOGS | STATUS }',''),(291,'RELEASE_LOCK',21,'   RELEASE_LOCK(str)\nReleases the lock named by the string str that was obtained with\nGET_LOCK(). Returns 1 if the lock was released, 0 if the\nlock wasn\'t locked by this thread (in which case the lock is not released),\nand NULL if the named lock didn\'t exist.  The lock does not exist if\nit was never obtained by a call to GET_LOCK() or if it has previously\nbeen released.\n\nThe DO statement is convenient to use with RELEASE_LOCK().\nSee also : [DO,  , DO].\n','',''),(292,'IS NULL',26,'   IS NULL\n   IS NOT NULL\nTests whether a value is or is not NULL.\n','mysql> SELECT 1 IS NULL, 0 IS NULL, NULL IS NULL;\n        -> 0, 0, 1\nmysql> SELECT 1 IS NOT NULL, 0 IS NOT NULL, NULL IS NOT NULL;\n        -> 1, 1, 0',''),(293,'CONVERT_TZ',14,'   CONVERT_TZ(dt,from_tz,to_tz)\n\nCONVERT_TZ()\nconverts a datetime value dt from time zone given by from_tz\nto the time zone given by to_tz and returns the resulting value.\nTime zones may be specified as described in [Time zone support].\nThis function returns NULL if the arguments are invalid.\n','mysql> SELECT CONVERT_TZ(\'2004-01-01 12:00:00\',\'GMT\',\'MET\');\n        -> \'2004-01-01 13:00:00\'\nmysql> SELECT CONVERT_TZ(\'2004-01-01 12:00:00\',\'+00:00\',\'-07:00\');\n        -> \'2004-01-01 05:00:00\'',''),(294,'TIME_TO_SEC',14,'   TIME_TO_SEC(time)\nReturns the time argument, converted to seconds.\n','mysql> SELECT TIME_TO_SEC(\'22:23:00\');\n        -> 80580\nmysql> SELECT TIME_TO_SEC(\'00:39:38\');\n        -> 2378',''),(295,'WEEKDAY',14,'   WEEKDAY(date)\nReturns the weekday index for\ndate (0 = Monday, 1 = Tuesday, ... 6 = Sunday).\n','mysql> SELECT WEEKDAY(\'1998-02-03 22:23:00\');\n        -> 1\nmysql> SELECT WEEKDAY(\'1997-11-05\');\n        -> 2',''),(296,'EXPORT_SET',23,'   EXPORT_SET(bits,on,off[,separator[,number_of_bits]])\nReturns a string in which for every bit set in the value bits, you\nget an on string and for every reset bit you get an off\nstring.  Bits in bits are examined from right to left (from low-order\nto high-order bits). Strings are added to the result from left to right,\nseparated by the separator string (default \',\'). The number of\nbits examined is given by number_of_bits (default 64).\n','mysql> SELECT EXPORT_SET(5,\'Y\',\'N\',\',\',4);\n        -> \'Y,N,Y,N\'\nmysql> SELECT EXPORT_SET(6,\'1\',\'0\',\',\',10);\n        -> \'0,1,1,0,0,0,0,0,0,0\'',''),(297,'TIME FUNCTION',14,'   TIME(expr)\n\nExtracts the time part of the time or datetime expression expr.\n','mysql> SELECT TIME(\'2003-12-31 01:02:03\');\n        -> \'01:02:03\'\nmysql> SELECT TIME(\'2003-12-31 01:02:03.000123\');\n        -> \'01:02:03.000123\'',''),(298,'CAST',23,'The CAST() and CONVERT() functions can be used to take a\nvalue of one type and produce a value of another type.\n\nThe type can be one of the following values:\n\n --- BINARY\n --- CHAR\n --- DATE\n --- DATETIME\n --- SIGNED [INTEGER]\n --- TIME\n --- UNSIGNED [INTEGER]\n\nBINARY produces a binary string. See the entry for the BINARY\noperator in this section for a description of how this affects comparisons.\n\nCAST() and CONVERT() are available as of MySQL 4.0.2.\nThe CHAR conversion type is available as of 4.0.6.\nThe USING form of CONVERT() is available as of 4.1.0.\n\nCAST() and CONVERT(... USING ...) are standard SQL syntax.\nThe non-USING form of CONVERT() is ODBC syntax.\n\nCONVERT() with USING is used to convert data between different\ncharacter sets.  In MySQL, transcoding names are the same as the\ncorresponding character set names.  For example, this statement converts\nthe string \'abc\' in the server\'s default character set to the\ncorresponding string in the utf8 character set:\n\nSELECT CONVERT(\'abc\' USING utf8);\n\n  \n\nThe cast functions are useful when you want to create a column with\na specific type in a CREATE ... SELECT statement:\n','SELECT enum_col FROM tbl_name ORDER BY CAST(enum_col AS CHAR);',''),(299,'SOUNDS LIKE',23,'   expr1 SOUNDS LIKE expr2\n\nThis is the same as SOUNDEX(expr1) = SOUNDEX(expr2). It is\navailable only in MySQL 4.1 or later.\n','',''),(300,'PERIOD_DIFF',14,'   PERIOD_DIFF(P1,P2)\nReturns the number of months between periods P1 and P2.\nP1 and P2 should be in the format YYMM or YYYYMM.\nNote that the period arguments P1 and P2 are /not/\ndate values.\n','mysql> SELECT PERIOD_DIFF(9802,199703);\n        -> 11',''),(301,'LIKE',23,'   expr LIKE pat [ESCAPE \'escape-char\']\nPattern matching using\nSQL simple regular expression comparison. Returns 1 (TRUE) or 0\n(FALSE).  If either expr or pat is NULL, the result is\nNULL.\n\nThe pattern need not be a literal string. For example, it can be specified\nas a string expression or table column.\n\nWith LIKE you can use the following two wildcard characters\nin the pattern:\n\n     Character 	 Description\n   % 	 Matches any number of characters, even zero characters\n   _ 	 Matches exactly one character\n  \n','mysql> SELECT \'David!\' LIKE \'David_\';\n        -> 1\nmysql> SELECT \'David!\' LIKE \'%D%v%\';\n        -> 1',''),(302,'MULTIPOINT',2,'   MultiPoint(pt1,pt2,...)\nConstructs a WKB MultiPoint value using WKB Point arguments.\nIf any argument is not a WKB Point, the return value is NULL.\n','',''),(303,'>>',27,'   >>\nShifts a longlong (BIGINT) number to the right.\n','mysql> SELECT 4 >> 2;\n        -> 1',''),(304,'TRUE FALSE',22,'TRUE and FALSE added as alias for 1 and 0, respectively.\n','',''),(305,'AVG',12,'   AVG([DISTINCT] expr)\nReturns the average value of expr.\nThe DISTINCT option can be used as of MySQL 5.0.3 to return the averge\nof the distinct values of expr.\n','mysql> SELECT student_name, AVG(test_score)\n    ->        FROM student\n    ->        GROUP BY student_name;',''),(306,'MBRWITHIN',8,'   MBRWithin(g1,g2)\nReturns 1 or 0 to indicate whether or not the Minimum Bounding Rectangle\nof g1 is within the Minimum Bounding Rectangle of g2.\n','mysql> SET @g1 = GeomFromText(\'Polygon((0 0,0 3,3 3,3 0,0 0))\');\nmysql> SET @g2 = GeomFromText(\'Polygon((0 0,0 5,5 5,5 0,0 0))\');\nmysql> SELECT MBRWithin(@g1,@g2), MBRWithin(@g2,@g1);\n+--------------------+--------------------+\n| MBRWithin(@g1,@g2) | MBRWithin(@g2,@g1) |\n+--------------------+--------------------+\n|                  1 |                  0 |\n+--------------------+--------------------+',''),(307,'IN',26,'   expr IN (value,...)\nReturns 1 if expr is any of the values in the IN list,\nelse returns 0.  If all values are constants, they are\nevaluated according to the type of expr and sorted. The search for the\nitem then is done using a binary search. This means IN is very quick\nif the IN value list consists entirely of constants.  If expr\nis a case-sensitive string expression, the string comparison is performed in\ncase-sensitive fashion.\n','mysql> SELECT 2 IN (0,3,5,\'wefwf\');\n        -> 0\nmysql> SELECT \'wefwf\' IN (0,3,5,\'wefwf\');\n        -> 1',''),(308,'QUOTE',23,'   QUOTE(str)\nQuotes a string to produce a result that can be used as a properly escaped\ndata value in an SQL statement.  The string is returned surrounded by single\nquotes and with each instance of single quote (\'\'\'), backslash (\'\\\'),\nASCII NUL, and Control-Z preceded by a backslash.  If the argument is\nNULL, the return value is the word ``NULL\'\' without surrounding\nsingle quotes.\nThe QUOTE() function was added in MySQL 4.0.3.\n','mysql> SELECT QUOTE(\'Don\\\'t!\');\n        -> \'Don\\\'t!\'\nmysql> SELECT QUOTE(NULL);\n        -> NULL',''),(309,'SESSION_USER',25,'   SESSION_USER()\n\nSESSION_USER() is a synonym for USER().\n','',''),(310,'QUARTER',14,'   QUARTER(date)\nReturns the quarter of the year for date, in the range 1\nto 4.\n','mysql> SELECT QUARTER(\'98-04-01\');\n        -> 2',''),(311,'POSITION',23,'   POSITION(substr IN str)\n\nPOSITION(substr IN str) is a synonym for LOCATE(substr,str).\n','mysql> SELECT LOCATE(\'bar\', \'foobarbar\');\n        -> 4\nmysql> SELECT LOCATE(\'xbar\', \'foobar\');\n        -> 0\nmysql> SELECT LOCATE(\'bar\', \'foobarbar\',5);\n        -> 7',''),(312,'IS_USED_LOCK',21,'   IS_USED_LOCK(str)\nChecks whether the lock named str is in use (that is, locked).\nIf so, it returns the connection identifier of the client that holds\nthe lock.\nOtherwise, it returns NULL.\n','',''),(313,'POLYFROMTEXT',3,'   PolyFromText(wkt[,srid])\n   PolygonFromText(wkt[,srid])\nConstructs a POLYGON value using its WKT representation and SRID.\n','',''),(314,'DES_ENCRYPT',17,'   DES_ENCRYPT(str[,(key_num|key_str)])\n\nEncrypts the string with the given key using the Triple-DES algorithm.\nOn error, this function returns NULL.\n\nNote that this function works only if MySQL has been configured with\nSSL support. See also : [Secure connections].\n\nThe encryption key to use is chosen based on the second argument to\nDES_ENCRYPT(), if one was given:\n\n     Argument 	 Description\n   No argument 	\nThe first key from the DES key file is used.\n   key_num 	\nThe given key number (0-9) from the DES key file is used.\n   key_str 	\nThe given key string is used to encrypt str.\n  \n\nThe key file can be specified with the --des-key-file server option.\n\nThe return string is a binary string where the first character\nis CHAR(128 | key_num).\n\nThe 128 is added to make it easier to recognize an encrypted key.\nIf you use a string key, key_num is 127.\n\nThe string length for the result is\nnew_len = orig_len + (8-(orig_len % 8))+1.\n','key_num des_key_str',''),(315,'LENGTH',23,'   LENGTH(str)\nReturns the length of the string str, measured in bytes.\nA multi-byte character counts as multiple bytes.\nThis means that for a string containing five two-byte characters,\nLENGTH() returns 10, whereas CHAR_LENGTH() returns\n5.\n','mysql> SELECT LENGTH(\'text\');\n        -> 4',''),(316,'STR_TO_DATE',14,'   STR_TO_DATE(str,format)\nThis is the reverse function of the DATE_FORMAT() function. It takes a\nstring str and a format string format.\nSTR_TO_DATE() returns a DATETIME value if the format\nstring contains both date and time parts, or a DATE or TIME\nvalue if the string contains only date or time parts.\n\nThe date, time, or datetime values contained in str should be given\nin the format indicated by format. For the specifiers that can be\nused in format, see the table in the DATE_FORMAT() function\ndescription. All other characters are just taken verbatim, thus not being\ninterpreted.\nIf str contains an illegal date, time, or datetime value,\nSTR_TO_DATE() returns NULL.  Starting from MySQL 5.0.3, an\nillegal value also produces a warning.\n','@c next example commented out until format string becomes optional\n@c mysql> SELECT STR_TO_DATE(\'2003-10-03\');\n@c         -> 2003-10-03 00:00:00\nmysql> SELECT STR_TO_DATE(\'03.10.2003 09.20\',\n    ->                    \'%d.%m.%Y %H.%i\');\n        -> \'2003-10-03 09:20:00\'\nmysql> SELECT STR_TO_DATE(\'10arp\', \'%carp\');\n        -> \'0000-10-00 00:00:00\'\nmysql> SELECT STR_TO_DATE(\'2003-15-10 00:00:00\',\n    ->                    \'%Y-%m-%d %H:%i:%s\');\n        -> NULL',''),(317,'Y',16,'   Y(p)\nReturns the Y-coordinate value for the point p as a double-precision\nnumber.\n','mysql> SELECT Y(GeomFromText(\'Point(56.7 53.34)\'));\n+--------------------------------------+\n| Y(GeomFromText(\'Point(56.7 53.34)\')) |\n+--------------------------------------+\n|                                53.34 |\n+--------------------------------------+',''),(318,'NUMINTERIORRINGS',0,'   NumInteriorRings(poly)\nReturns the number of interior rings in the Polygon value poly.\n','mysql> SET @poly =\n    -> \'Polygon((0 0,0 3,3 3,3 0,0 0),(1 1,1 2,2 2,2 1,1 1))\';\nmysql> SELECT NumInteriorRings(GeomFromText(@poly));\n+---------------------------------------+\n| NumInteriorRings(GeomFromText(@poly)) |\n+---------------------------------------+\n|                                     1 |\n+---------------------------------------+',''),(319,'INTERIORRINGN',0,'   InteriorRingN(poly,n)\nReturns the n-th interior ring for the Polygon value\npoly as a LineString.\nRing numbers begin at 1.\n','mysql> SET @poly =\n    -> \'Polygon((0 0,0 3,3 3,3 0,0 0),(1 1,1 2,2 2,2 1,1 1))\';\nmysql> SELECT AsText(InteriorRingN(GeomFromText(@poly),1));\n+----------------------------------------------+\n| AsText(InteriorRingN(GeomFromText(@poly),1)) |\n+----------------------------------------------+\n| LINESTRING(1 1,1 2,2 2,2 1,1 1)              |\n+----------------------------------------------+',''),(320,'UTC_TIME',14,'   UTC_TIME\n   UTC_TIME()\nReturns the current UTC time as a value in \'HH:MM:SS\' or HHMMSS\nformat, depending on whether the function is used in a string or numeric\ncontext.\n','mysql> SELECT UTC_TIME(), UTC_TIME() + 0;\n        -> \'18:07:53\', 180753',''),(321,'STDDEV',12,'   STD(expr)\n   STDDEV(expr)\nReturns the population standard deviation of expr.  This is an\nextension to standard SQL. The STDDEV() form of this function is\nprovided for Oracle compatibility. As of MySQL 5.0.3, the standard SQL\nfunction STDDEV_POP() can be used instead.\n','',''),(322,'PERIOD_ADD',14,'   PERIOD_ADD(P,N)\nAdds N months to period P (in the format YYMM or\nYYYYMM). Returns a value in the format YYYYMM.\nNote that the period argument P is /not/ a date value.\n','mysql> SELECT PERIOD_ADD(9801,2);\n        -> 199803',''),(323,'|',27,'   |\nBitwise OR:\n','mysql> SELECT 29 | 15;\n        -> 31',''),(324,'GEOMFROMTEXT',3,'   GeomFromText(wkt[,srid])\n   GeometryFromText(wkt[,srid])\nConstructs a geometry value of any type using its WKT representation and SRID.\n','',''),(325,'RIGHT',23,'   RIGHT(str,len)\nReturns the rightmost len characters from the string str.\n','mysql> SELECT RIGHT(\'foobarbar\', 4);\n        -> \'rbar\'',''),(326,'DATEDIFF',14,'   DATEDIFF(expr,expr2)\n\n\nDATEDIFF() returns the number of days between the start date\nexpr and the end date expr2.\nexpr and expr2 are date or date-and-time expressions.\nOnly the date parts of the values are used in the calculation.\n','mysql> SELECT DATEDIFF(\'1997-12-31 23:59:59\',\'1997-12-30\');\n        -> 1\nmysql> SELECT DATEDIFF(\'1997-11-30 23:59:59\',\'1997-12-31\');\n        -> -31',''),(327,'BIN',23,'   BIN(N)\nReturns a string representation of the binary value of N, where\nN is a longlong (BIGINT) number.  This is equivalent to\nCONV(N,10,2).  Returns NULL if N is NULL.\n','mysql> SELECT BIN(12);\n        -> \'1100\'',''),(328,'MULTILINESTRING',2,'   MultiLineString(ls1,ls2,...)\nConstructs a WKB MultiLineString value using WKB LineString\narguments.  If any argument is not a WKB LineString, the return\nvalue is NULL.\n','',''),(329,'LOAD DATA',6,'The LOAD DATA INFILE statement reads rows from a text file into a\ntable at a very high speed.\nFor more information about the efficiency of INSERT versus\nLOAD DATA INFILE and speeding up LOAD DATA INFILE,\n[Insert speed].\n\nAs of MySQL 4.1, the character set indicated by the\ncharacter_set_database system variable is used to interpret the\ninformation in the file.  SET NAMES and the setting of\ncharacter_set_client do not affect input interpretation.\n\nYou can also load data files by using the mysqlimport utility; it\noperates by sending a LOAD DATA INFILE statement to the server.  The\n--local option causes mysqlimport to read data files from the\nclient host.  You can specify the --compress option to get better\nperformance over slow networks if the client and server support the\ncompressed protocol.\nSee also : [mysqlimport,  , mysqlimport].\n\nIf you specify the LOW_PRIORITY keyword, execution of the\nLOAD DATA statement is delayed until no other clients are reading\nfrom the table.\n\nIf you specify the CONCURRENT keyword with a MyISAM table that\nsatisfies the condition for concurrent inserts (that is, it contains no free\nblocks in the middle),\nthen other threads can retrieve data from the table while LOAD DATA\nis executing. Using this option affects the performance of LOAD DATA\na bit, even if no other thread is using the table at the same time.\n\nIf the LOCAL keyword is specified, it is\ninterpreted with respect to the client end of the connection:\n\n\n --- If LOCAL is specified, the file is read by the client program on the\nclient host and sent to the server. The file can be given as a full pathname\nto specify its exact location. If given as a relative pathname, the name is\ninterpreted relative to the directory in which the client program was started.\n\n --- If LOCAL is not specified, the\nfile must be located on the server host and is read directly by the server.\n\n\nLOCAL is available in MySQL 3.22.6 or later.\n\nWhen locating files on the server host, the server uses the following rules:\n\n --- If an absolute pathname is given, the server uses the pathname as is.\n\n --- If a relative pathname with one or more leading components is given,\nthe server searches for the file relative to the server\'s data directory.\n\n --- If a filename with no leading components is given, the server looks for\nthe file in the database directory of the default database.\n\nNote that these rules mean that a file named as *./myfile.txt is read from\nthe server\'s data directory, whereas the same file named as *myfile.txt is\nread from the database directory of the default database.  For example,\nthe following LOAD DATA statement reads the file *data.txt\nfrom the database directory for db1 because db1 is the current\ndatabase, even though the statement explicitly loads the file into a\ntable in the db2 database:\n\nmysql> USE db1;\nmysql> LOAD DATA INFILE \'data.txt\' INTO TABLE db2.my_table;\n\nNote that Windows pathnames are specified using forward slashes rather than\nbackslashes.  If you do use backslashes, you must double them.\n\nFor security reasons, when reading text files located on the server, the\nfiles must either reside in the database directory or be readable by all.\nAlso, to use LOAD DATA INFILE on server files, you must have the\nFILE privilege.\n','LOAD DATA [LOW_PRIORITY | CONCURRENT] [LOCAL] INFILE \'file_name.txt\'\n    [REPLACE | IGNORE]\n    INTO TABLE tbl_name\n    [FIELDS\n        [TERMINATED BY \'\\t\']\n        [[OPTIONALLY] ENCLOSED BY \'\']\n        [ESCAPED BY \'\\\\\' ]\n    ]\n    [LINES\n        [STARTING BY \'\']\n        [TERMINATED BY \'\\n\']\n    ]\n    [IGNORE number LINES]\n    [(col_name,...)]',''),(330,'BLOB TYPE',1,'   BLOB[(M)]\n\nA BLOB column with a maximum length of 65,535\n(2^16 - 1) bytes.\n\nBeginning with MySQL 4.1, an optional length M can be given.\nMySQL will create the column as the smallest BLOB type largest\nenough to hold values M bytes long.\n','',''),(331,'LOCALTIME',14,'   LOCALTIME\n   LOCALTIME()\n\nLOCALTIME and LOCALTIME() are synonyms for\nNOW().\n','',''),(332,'MPOINTFROMTEXT',3,'   MPointFromText(wkt[,srid])\n   MultiPointFromText(wkt[,srid])\nConstructs a MULTIPOINT value using its WKT representation and SRID.\n','',''),(333,'BLOB',1,'A BLOB is a binary large object that can hold a variable amount of\ndata.  The four BLOB types, TINYBLOB, BLOB,\nMEDIUMBLOB, and LONGBLOB, differ only in the maximum length of\nthe values they can hold.\n','',''),(334,'PASSWORD',17,'','mysql> SELECT PASSWORD(\'badpwd\');\n        -> \'7f84554057dd964b\'',''),(335,'CHAR',1,'   [NATIONAL] CHAR(M) [BINARY | ASCII | UNICODE]\n\nA fixed-length string that is always right-padded with spaces to the\nspecified length when stored.  M represents the column length.  The\nrange of M is 0 to 255 characters (1 to 255 prior to MySQL 3.23).\n\nNote: Trailing spaces are removed when CHAR values are\nretrieved.\n\nFrom MySQL 4.1.0 to 5.0.2, a CHAR column with a length specification\ngreater than 255 is converted to the smallest TEXT type that can hold\nvalues of the given length.  For example, CHAR(500) is converted to\nTEXT, and CHAR(200000) is converted to MEDIUMTEXT.\nThis is a compatibility feature.  However, this conversion causes the column\nto become a variable-length column, and also affects trailing-space removal.\n\nCHAR is shorthand for CHARACTER.\nNATIONAL CHAR (or its equivalent short form, NCHAR) is the\nstandard SQL way to define that a CHAR column should use the default\ncharacter set.  This is the default in MySQL.\n\nAs of MySQL 4.1.2, the BINARY attribute is shorthand for specifying\nthe binary collation of the column character set.  Sorting and comparison is\nbased on numeric character values.  Before 4.1.2, BINARY attribute\ncauses the column to be treated as a binary string.  Sorting and comparison\nis based on numeric byte values.\n\nFrom MySQL 4.1.0 on, column type CHAR BYTE is an alias for\nCHAR BINARY. This is a compatibility feature.\n\nFrom MySQL 4.1.0 on, the ASCII attribute can be specified for\nCHAR. It assigns the latin1 character set.\n\nFrom MySQL 4.1.1 on, the UNICODE attribute can be specified for\nCHAR. It assigns the ucs2 character set.\n\nMySQL allows you to create a column of type CHAR(0). This is mainly\nuseful when you have to be compliant with some old applications that depend\non the existence of a column but that do not actually use the value.  This\nis also quite nice when you need a column that can take only two values: A\nCHAR(0) column that is not defined as NOT NULL occupies only\none bit and can take only the values NULL and \'\' (the empty\nstring).\n\n   CHAR\nThis is a synonym for CHAR(1).\n','',''),(336,'UTC_DATE',14,'   UTC_DATE\n   UTC_DATE()\nReturns the current UTC date as a value in \'YYYY-MM-DD\' or\nYYYYMMDD format, depending on whether the function is used in a\nstring or numeric context.\n','mysql> SELECT UTC_DATE(), UTC_DATE() + 0;\n        -> \'2003-08-14\', 20030814',''),(337,'DIMENSION',19,'   Dimension(g)\nReturns the inherent dimension of the geometry value g. The result\ncan be -1, 0, 1, or 2. (The meaning of these values is given in\n[GIS class geometry].)\n','mysql> SELECT Dimension(GeomFromText(\'LineString(1 1,2 2)\'));\n+------------------------------------------------+\n| Dimension(GeomFromText(\'LineString(1 1,2 2)\')) |\n+------------------------------------------------+\n|                                              1 |\n+------------------------------------------------+',''),(338,'COUNT DISTINCT',12,'   COUNT(DISTINCT expr,[expr...])\nReturns a count of the number of different non-NULL values.\n','mysql> SELECT COUNT(DISTINCT results) FROM student;',''),(339,'BIT',1,'   BIT[(M)]\n\nA bit-field type. M indicates the number of bits per value, from 1 to\n64. The default is 1 if M is omitted.\n\nThis data type was added in MySQL 5.0.3 for MyISAM, and extended\nin 5.0.5 to MEMORY, InnoDB, and BDB.  Before 5.0.3,\nBIT is a synonym for TINYINT(1).\n','',''),(340,'EQUALS',11,'   Equals(g1,g2)\nReturns 1 or 0 to indicate whether or not g1 is spatially equal to\ng2.\n','',''),(341,'SHOW CREATE VIEW',24,'This statement shows a CREATE VIEW statement that creates\nthe given view.\n','SHOW CREATE VIEW view_name',''),(342,'INTERVAL',26,'   INTERVAL(N,N1,N2,N3,...)\nReturns 0 if N < N1, 1 if N < N2\nand so on or -1 if N is NULL. All arguments are treated\nas integers.  It is required that N1 < N2 < N3 <\n... < Nn for this function to work correctly. This is because\na binary search is used (very fast).\n','mysql> SELECT INTERVAL(23, 1, 15, 17, 30, 44, 200);\n        -> 3\nmysql> SELECT INTERVAL(10, 1, 10, 100, 1000);\n        -> 2\nmysql> SELECT INTERVAL(22, 23, 30, 44, 200);\n        -> 0',''),(343,'FROM_DAYS',14,'   FROM_DAYS(N)\nGiven a daynumber N, returns a DATE value.\n','mysql> SELECT FROM_DAYS(729669);\n        -> \'1997-10-07\'',''),(344,'BIT_COUNT',27,'   BIT_COUNT(N)\nReturns the number of bits that are set in the argument N.\n','mysql> SELECT BIT_COUNT(29);\n        -> 4',''),(345,'UTC_TIMESTAMP',14,'   UTC_TIMESTAMP\n   UTC_TIMESTAMP()\nReturns the current UTC date and time as a value in \'YYYY-MM-DD HH:MM:SS\'\nor YYYYMMDDHHMMSS format, depending on whether the function is used in\na string or numeric context.\n','mysql> SELECT UTC_TIMESTAMP(), UTC_TIMESTAMP() + 0;\n        -> \'2003-08-14 18:08:04\', 20030814180804',''),(346,'+',4,'   +\nAddition:\n','mysql> SELECT 3+5;\n        -> 8',''),(347,'INET_NTOA',21,'   INET_NTOA(expr)\nGiven a numeric network address (4 or 8 byte), returns the dotted-quad\nrepresentation of the address as a string.\n','mysql> SELECT INET_NTOA(3520061480);\n        -> \'209.207.224.40\'',''),(348,'ACOS',4,'   ACOS(X)\nReturns the arc cosine of X, that is, the value whose cosine is\nX. Returns NULL if X is not in the range -1 to\n1.\n','mysql> SELECT ACOS(1);\n        -> 0.000000\nmysql> SELECT ACOS(1.0001);\n        -> NULL\nmysql> SELECT ACOS(0);\n        -> 1.570796',''),(349,'ISOLATION',10,'SET [GLOBAL | SESSION] TRANSACTION ISOLATION LEVEL\n{ READ UNCOMMITTED | READ COMMITTED | REPEATABLE READ | SERIALIZABLE }\n\nThis statement\nsets the transaction isolation level for the next transaction, globally, or\nfor the current session.\n\nThe default behavior of SET TRANSACTION is to set the isolation level\nfor the next (not yet\nstarted) transaction.  If you use the GLOBAL keyword, the statement\nsets the default transaction level globally for all new connections\ncreated from that point on. Existing connections are unaffected.\nYou need the SUPER\nprivilege to do this.  Using the SESSION keyword sets the\ndefault transaction level for all future transactions performed on the\ncurrent connection.\n\nFor descriptions of each InnoDB transaction isolation level, see\n[InnoDB transaction isolation, InnoDB transaction isolation].\nInnoDB supports each of these levels\nfrom MySQL 4.0.5 on. The default level is REPEATABLE READ.\n\nYou can set the initial default global isolation level for mysqld with\nthe --transaction-isolation option.\nSee also : [Server options].\n','',''),(350,'CEILING',4,'   CEILING(X)\n   CEIL(X)\nReturns the smallest integer value not less than X.\n','mysql> SELECT CEILING(1.23);\n        -> 2\nmysql> SELECT CEIL(-1.23);\n        -> -1',''),(351,'SIN',4,'   SIN(X)\nReturns the sine of X, where X is given in radians.\n','mysql> SELECT SIN(PI());\n        -> 0.000000',''),(352,'DAYOFWEEK',14,'   DAYOFWEEK(date)\nReturns the weekday index\nfor date (1 = Sunday, 2 = Monday, ..., 7 =\nSaturday).  These index values correspond to the ODBC standard.\n','mysql> SELECT DAYOFWEEK(\'1998-02-03\');\n        -> 3',''),(353,'LINEFROMWKB',13,'   LineFromWKB(wkb[,srid])\n   LineStringFromWKB(wkb[,srid])\nConstructs a LINESTRING value using its WKB representation and SRID.\n','',''),(354,'GEOMETRYTYPE',19,'   GeometryType(g)\nReturns as a string the name of the geometry type of which\nthe geometry instance g is a member.\nThe name corresponds to one of the instantiable Geometry subclasses.\n','mysql> SELECT GeometryType(GeomFromText(\'POINT(1 1)\'));\n+------------------------------------------+\n| GeometryType(GeomFromText(\'POINT(1 1)\')) |\n+------------------------------------------+\n| POINT                                    |\n+------------------------------------------+',''),(355,'GRANT TYPES',7,'For the GRANT and REVOKE statements, priv_type can be\nspecified as any of the following:\n\n     Privilege 	 Meaning\n   ALL [PRIVILEGES] 	 Sets all simple privileges except GRANT OPTION\n   ALTER  	 Allows use of ALTER TABLE\n   ALTER ROUTINE  	 Alter or drop stored routines\n   CREATE 	 Allows use of CREATE TABLE\n   CREATE ROUTINE 	 Create stored routines\n   CREATE TEMPORARY TABLES 	 Allows use of CREATE TEMPORARY TABLE\n   CREATE USER 	 Allows use of CREATE USER, DROP USER, RENAME USER, and REVOKE ALL PRIVILEGES.\n   CREATE VIEW 	 Allows use of CREATE VIEW\n   DELETE 	 Allows use of DELETE\n   DROP 	 Allows use of DROP TABLE\n   EXECUTE 	 Allows the user to run stored routines\n   FILE 	 Allows use of SELECT ... INTO OUTFILE and LOAD DATA INFILE\n   INDEX 	 Allows use of CREATE INDEX and DROP INDEX\n   INSERT 	 Allows use of INSERT\n   LOCK TABLES 	 Allows use of LOCK TABLES on tables for which you have the SELECT privilege\n   PROCESS 	 Allows use of SHOW FULL PROCESSLIST\n   REFERENCES 	 Not implemented\n   RELOAD 	 Allows use of FLUSH\n   REPLICATION CLIENT 	 Allows the user to ask where slave or master servers are\n   REPLICATION SLAVE 	 Needed for replication slaves (to read binary log events from the master)\n   SELECT 	 Allows use of SELECT\n   SHOW DATABASES 	 SHOW DATABASES shows all databases\n   SHOW VIEW 	 Allows use of SHOW CREATE VIEW\n   SHUTDOWN 	 Allows use of mysqladmin shutdown\n   SUPER 	 Allows use of CHANGE MASTER, KILL,\nPURGE MASTER LOGS, and SET GLOBAL statements, the mysqladmin debug command; allows you to connect (once) even if max_connections is reached\n   UPDATE 	 Allows use of UPDATE\n   USAGE 	 Synonym for ``no privileges\'\'\n   GRANT OPTION 	 Allows privileges to be granted\n  \n','',''),(356,'CREATE VIEW',24,'This statement creates a new view, or replaces an existing one if the\nOR REPLACE clause is given. The select_statement is a\nSELECT statement that provides the definition of the view.\nThe statement can select from base tables or other views.\n\nThis statement requires the CREATE VIEW privilege for the view, and\nsome privilege for each column selected by the SELECT statement.\nFor columns used elsewhere in the SELECT statement you must have\nthe SELECT privilege.  If the OR REPLACE clause is present,\nyou must also have the DELETE privilege for the view.\n\nA view belongs to a database.  By default, a new view is created in the\ncurrent database.  To create the view explicitly in a given database,\nspecify the name as db_name.view_name when you create it.\n\nmysql> CREATE VIEW test.v AS SELECT * FROM t;\n\nTables and views share the same namespace within a database, so a database\ncannot contain a table and a view that have the same name.\n\nViews must have unique column names with no duplicates, just like base\ntables.  By default, the names of the columns retrieved by the SELECT\nstatement are used for the view column names.  To define explicit names for\nthe view columns, the optional column_list clause can be given as a\nlist of comma-separated identifiers.  The number of names in\ncolumn_list must be the same as the number of columns retrieved by the\nSELECT statement.\n\nColumns retrieved by the SELECT statement can be simple references to\ntable columns. They can also be expressions that use functions, constant\nvalues, operators, and so forth.\n\nUnqualified table or view names in the SELECT statement are\ninterpreted with respect to the default database.  A view can refer to\ntables or views in other databases by qualifying the table or view name with\nthe proper database name.\n\nA view can be created from many kinds of SELECT statements.  It can\nrefer to base tables or other views.  It can use joins, UNION, and\nsubqueries.  The SELECT need not even refer to any tables. The\nfollowing example defines a view that selects two columns from another\ntable, as well as an expression calculated from those columns:\n\nmysql> CREATE TABLE t (qty INT, price INT);\nmysql> INSERT INTO t VALUES(3, 50);\nmysql> CREATE VIEW v AS SELECT qty, price, qty*price AS value FROM t;\nmysql> SELECT * FROM v;\n+------+-------+-------+\n| qty  | price | value |\n+------+-------+-------+\n|    3 |    50 |   150 |\n+------+-------+-------+\n\nA view definition is subject to the following restrictions:\n\n\n --- The SELECT statement cannot contain a subquery in the FROM\nclause.\n\n --- The SELECT statement cannot refer to system or user variables.\n\n --- The SELECT statement cannot refer to prepared statement parameters.\n\n --- Within a stored routine, the definition cannot refer to routine\nparameters or local variables.\n\n --- Any table or view referred to in the definition must exist.  However, after\na view has been created, it is possible to drop a table or view that the\ndefinition refers to.  To check a view definition for problems of this kind,\nuse the CHECK TABLE statement.\n\n --- The definition cannot refer to a TEMPORARY table, and you cannot\ncreate a TEMPORARY view.\n\n --- The tables named in the view definition must already exist.\n\n --- You cannot associate a trigger with a view.\n\n\nORDER BY is allowed in a view definition, but it is ignored if you\nselect from a view using a statement that has its own ORDER BY.\n\nFor other options or clauses in the definition, they are added to the\noptions or clauses of the statement that references the view, but the effect\nis undefined.  For example, if a view definition includes a LIMIT\nclause, and you select from the view using a statement that has its own\nLIMIT clause, it is undefined which limit applies.  This same\nprinciple applies to options such as ALL, DISTINCT, or\nSQL_SMALL_RESULT that follow the SELECT keyword, and to\nclauses such as INTO, FOR UPDATE, LOCK IN SHARE MODE,\nand PROCEDURE.\n\nIf you create a view and then change the query processing environment by\nchanging system variables, that may affect the results you get from the\nview:\n\nmysql> CREATE VIEW v AS SELECT CHARSET(CHAR(65)), COLLATION(CHAR(65));\nQuery OK, 0 rows affected (0.00 sec)\n\nmysql> SET NAMES \'latin1\';\nQuery OK, 0 rows affected (0.00 sec)\n\nmysql> SELECT * FROM v;\n+-------------------+---------------------+\n| CHARSET(CHAR(65)) | COLLATION(CHAR(65)) |\n+-------------------+---------------------+\n| latin1            | latin1_swedish_ci   |\n+-------------------+---------------------+\n1 row in set (0.00 sec)\n\nmysql> SET NAMES \'utf8\';\nQuery OK, 0 rows affected (0.00 sec)\n\nmysql> SELECT * FROM v;\n+-------------------+---------------------+\n| CHARSET(CHAR(65)) | COLLATION(CHAR(65)) |\n+-------------------+---------------------+\n| utf8              | utf8_general_ci     |\n+-------------------+---------------------+\n1 row in set (0.00 sec)\n\nThe optional ALGORITHM clause is a MySQL extension to standard SQL.\nALGORITHM takes three values: MERGE, TEMPTABLE, or\nUNDEFINED. The default algorithm is UNDEFINED if no\nALGORITHM clause is present.  The algorithm affects how MySQL\nprocesses the view.\n\nFor MERGE, the text of a statement that refers to the view and the view\ndefinition are merged such that parts of the view definition replace\ncorresponding parts of the statement.\n\nFor TEMPTABLE, the results from the view are retrieved into a\ntemporary table, which then is used to execute the statement.\n\nFor UNDEFINED, MySQL chooses which algorithm to use.  It prefers\nMERGE over TEMPTABLE if possible, because MERGE is\nusually more efficient and because a view cannot be updatable if a temporary\ntable is used.\n\nA reason to choose TEMPTABLE explicitly is that locks can be released\non underlying tables after the temporary table has been created and before\nit is used to finish processing the statement.  This might result in quicker\nlock release than the MERGE algorithm so that other clients that use\nthe view are not blocked as long.\n\nA view algorithm can be UNDEFINED three ways:\n\n\n --- No ALGORITHM clause is present in the CREATE VIEW statement.\n\n --- The CREATE VIEW statement has an explicit ALGORITHM = UNDEFINED\nclause.\n\n --- ALGORITHM = MERGE is specified for a view that can be processed only\nwith a temporary table.  In this case, MySQL generates a warning and sets\nthe algorithm to UNDEFINED.\n\n\n\nAs mentioned earlier, MERGE is handled by merging corresponding parts\nof a view definition into the statement that refers to the view.  The\nfollowing examples briefly illustrate how the MERGE algorithm works.\nThe examples assume that there is a view v_merge that has this\ndefinition:\n\nCREATE ALGORITHM = MERGE VIEW v_merge (vc1, vc2) AS\nSELECT c1, c2 FROM t WHERE c3 > 100;\n\nExample 1: Suppose that we issue this statement:\n\nSELECT * FROM v_merge;\n\nMySQL handles the statement as follows:\n\n\n --- v_merge becomes t\n\n --- * becomes vc1, vc2, which corresponds to c1, c2\n\n --- The view WHERE clause is added\n\n\nThe resulting statement to be executed becomes:\n\nSELECT c1, c2 FROM t WHERE c3 > 100;\n\nExample 2: Suppose that we issue this statement:\n\nSELECT * FROM v_merge WHERE vc1 < 100;\n\nThis statement is handled similarly to the previous one, except that\nvc1 < 100 becomes c1 < 100 and the view WHERE clause is\nadded to the statement WHERE clause using an AND connective\n(and parentheses are added to make sure the parts of the clause are executed\nwith correct precedence).  The resulting statement to be executed becomes:\n\nSELECT c1, c2 FROM t WHERE (c3 > 100) AND (c1 < 100);\n\nEffectively, the statement to be executed has a WHERE clause of this\nform:\n\nWHERE (select WHERE) AND (view WHERE)\n\nThe MERGE algorithm requires a one-to relationship between the rows\nin the view and the rows in the underlying table. If this relationship does\nnot hold, a temporary table must be used instead.  Lack of a one-to-one\nrelationship occurs if the view contains any of a number of constructs:\n\n\n --- Aggregate functions (SUM(), MIN(), MAX(),\nCOUNT(), and so forth)\n\n --- DISTINCT\n\n --- GROUP BY\n\n --- HAVING\n\n --- UNION or UNION ALL\n\n --- Refers only to literal values (in this case, there is no underlying table)\n\n\nSome views are updatable. That is, you can use them in statements such as\nUPDATE, DELETE, or INSERT to update the contents of the\nunderlying table.  For a view to be updatable, there must be a one-to\nrelationship between the rows in the view and the rows in the underlying\ntable.  There are also certain other constructs that make a view\nnon-updatable. To be more specific, a view is not updatable if it contains\nany of the following:\n\n\n --- Aggregate functions (SUM(), MIN(), MAX(),\nCOUNT(), and so forth)\n\n --- DISTINCT\n\n --- GROUP BY\n\n --- HAVING\n\n --- UNION or UNION ALL\n\n --- Subquery in the select list\n\n --- Join\n\n --- Non-updatable view in the FROM clause\n\n --- A subquery in the WHERE clause that refers to a table in the\nFROM clause\n\n --- Refers only to literal values (in this case, there is no underlying table to\nupdate)\n\n --- ALGORITHM = TEMPTABLE (use of a temporary table always makes a view\nnon-updatable)\n\n\nWith respect to insertability (being updatable with INSERT\nstatements), an updatable view is insertable if it also satisfies these\nadditional requirements for the view columns:\n\n\n --- There must be no duplicate view column names.\n\n --- The view must contain all columns in the base table that do not have a\ndefault value.\n\n --- The view columns must be simple column references and not derived columns.\nA derived column is one that is not a simple column reference but is derived\nfrom an expression.  These are examples of derived columns:\n\n3.14159\ncol1 + 3\nUPPER(col2)\ncol3 / col4\n(subquery)\n\n\nA view that has a mix of simple column references and derived columns is not\ninsertable, but it can be updatable if you update only those columns that\nare not derived.  Consider this view:\n\nCREATE VIEW v AS SELECT col1, 1 AS col2 FROM t;\n\nThis view is not insertable because col2 is derived from an\nexpression. But it is updatable if the update does not try to update\ncol2.  This update is allowable:\n\nUPDATE v SET col1 = 0;\n\nThis update is not allowable because it attempts to update a derived column:\n\nUPDATE v SET col2 = 0;\n\nIt is sometimes possible for a multiple-table view to be updatable, assuming\nthat it can be processed with the MERGE algorithm.  For this to work,\nthe view must use an inner join (not an outer join or a UNION). Also,\nonly a single table in the view definition can be updated, so the SET\nclause must name only columns from one of the tables in the view.  Views\nthat use UNION ALL are disallowed even though they might be\ntheoretically updatable, because the implementation uses temporary tables to\nprocess them.\n\n\nFor a multiple-table updatable view, INSERT can work if it inserts into a\nsingle table.  DELETE is not supported.\n\nThe WITH CHECK OPTION clause can be given for an updatable view to\nprevent inserts or updates to rows except those for which the WHERE\nclause in the select_statement is true.\n','',''),(357,'TRIM',23,'   TRIM([{BOTH | LEADING | TRAILING} [remstr] FROM] str)\n   TRIM(remstr FROM] str)\nReturns the string str with all remstr prefixes and/or suffixes\nremoved. If none of the specifiers BOTH, LEADING, or\nTRAILING is given, BOTH is assumed. If remstr is optional\nand not specified, spaces are removed.\n','mysql> SELECT TRIM(\'  bar   \');\n        -> \'bar\'\nmysql> SELECT TRIM(LEADING \'x\' FROM \'xxxbarxxx\');\n        -> \'barxxx\'\nmysql> SELECT TRIM(BOTH \'x\' FROM \'xxxbarxxx\');\n        -> \'bar\'\nmysql> SELECT TRIM(TRAILING \'xyz\' FROM \'barxxyz\');\n        -> \'barx\'',''),(358,'IS',26,'   IS boolean_value\n   IS NOT boolean_value\nTests whether a value against a boolean value, where boolean_value can\nbe TRUE, FALSE, or UNKNOWN.\n','mysql> SELECT 1 IS TRUE, 0 IS FALSE, NULL IS UNKNOWN;\n        -> 1, 1, 1\nmysql> SELECT 1 IS NOT UNKNOWN, 0 IS NOT UNKNOWN, NULL IS NOT UNKNOWN;\n        -> 1, 1, 0',''),(359,'GET_FORMAT',14,'   GET_FORMAT(DATE|TIME|DATETIME, \'EUR\'|\'USA\'|\'JIS\'|\'ISO\'|\'INTERNAL\')\nReturns a format string. This function is useful in combination with the\nDATE_FORMAT() and the STR_TO_DATE() functions.\nThe three possible values for the first argument\nand the five possible values for the second argument result in 15 possible\nformat strings (for the specifiers used, see the table in the\nDATE_FORMAT() function description).\n     Function Call 	 Result\n   GET_FORMAT(DATE,\'USA\') 	 \'%m.%d.%Y\'\n   GET_FORMAT(DATE,\'JIS\') 	 \'%Y-%m-%d\'\n   GET_FORMAT(DATE,\'ISO\') 	 \'%Y-%m-%d\'\n   GET_FORMAT(DATE,\'EUR\') 	 \'%d.%m.%Y\'\n   GET_FORMAT(DATE,\'INTERNAL\') 	 \'%Y%m%d\'\n   GET_FORMAT(DATETIME,\'USA\') 	 \'%Y-%m-%d-%H.%i.%s\'\n   GET_FORMAT(DATETIME,\'JIS\') 	 \'%Y-%m-%d %H:%i:%s\'\n   GET_FORMAT(DATETIME,\'ISO\') 	 \'%Y-%m-%d %H:%i:%s\'\n   GET_FORMAT(DATETIME,\'EUR\') 	 \'%Y-%m-%d-%H.%i.%s\'\n   GET_FORMAT(DATETIME,\'INTERNAL\') 	 \'%Y%m%d%H%i%s\'\n   GET_FORMAT(TIME,\'USA\') 	 \'%h:%i:%s %p\'\n   GET_FORMAT(TIME,\'JIS\') 	 \'%H:%i:%s\'\n   GET_FORMAT(TIME,\'ISO\') 	 \'%H:%i:%s\'\n   GET_FORMAT(TIME,\'EUR\') 	 \'%H.%i.%S\'\n   GET_FORMAT(TIME,\'INTERNAL\') 	 \'%H%i%s\'\n  \nISO format is ISO 9075, not ISO 8601.\n\nAs of MySQL 4.1.4, TIMESTAMP can also be used;\nGET_FORMAT() returns the same values as for DATETIME.\n','mysql> SELECT DATE_FORMAT(\'2003-10-03\',GET_FORMAT(DATE,\'EUR\'));\n        -> \'03.10.2003\'\nmysql> SELECT STR_TO_DATE(\'10.31.2003\',GET_FORMAT(DATE,\'USA\'));\n        -> 2003-10-31\n@c Following is commented out because not yet implemented\n@c mysql> SET DATE_FORMAT=GET_FORMAT(DATE, \'USA\'); SELECT \'2003-10-31\';\n@c         -> 10-31-2003',''),(360,'TINYBLOB',1,'   TINYBLOB\n\nA BLOB column with a maximum length of 255\n(2^8 - 1) bytes.\n','',''),(361,'SAVEPOINT',10,'SAVEPOINT identifier\nROLLBACK TO SAVEPOINT identifier\n\nStarting from MySQL 4.0.14 and 4.1.1, InnoDB supports the SQL statements\nSAVEPOINT and ROLLBACK TO SAVEPOINT.\n','',''),(362,'IF',9,'   IF(expr1,expr2,expr3)\nIf expr1 is TRUE (expr1 <> 0 and expr1 <> NULL) then\nIF() returns expr2, else it returns expr3.\nIF() returns a numeric or string value, depending on the context\nin which it is used.\n','mysql> SELECT IF(1>2,2,3);\n        -> 3\nmysql> SELECT IF(1<2,\'yes\',\'no\');\n        -> \'yes\'\nmysql> SELECT IF(STRCMP(\'test\',\'test1\'),\'no\',\'yes\');\n        -> \'no\'',''),(363,'PURGE',6,'','PURGE MASTER LOGS TO \'mysql-bin.010\';\nPURGE MASTER LOGS BEFORE \'2003-04-02 22:46:26\';',''),(364,'USER',25,'   USER()\n\nReturns the current MySQL username and hostname.\n','mysql> SELECT USER();\n        -> \'davida@localhost\'',''),(365,'MPOINTFROMWKB',13,'   MPointFromWKB(wkb[,srid])\n   MultiPointFromWKB(wkb[,srid])\nConstructs a MULTIPOINT value using its WKB representation and SRID.\n','',''),(366,'ALTER TABLE',28,'ALTER TABLE allows you to change the structure of an existing table.\nFor example, you can add or delete columns, create or destroy indexes, change\nthe type of existing columns, or rename columns or the table itself.  You can\nalso change the comment for the table and type of the table.\n','ALTER [IGNORE] TABLE tbl_name\n    alter_specification [, alter_specification] ...\n\nalter_specification:\n    ADD [COLUMN] column_definition [FIRST | AFTER col_name ]\n  | ADD [COLUMN] (column_definition,...)\n  | ADD INDEX [index_name] [index_type] (index_col_name,...)\n  | ADD [CONSTRAINT [symbol]]\n        PRIMARY KEY [index_type] (index_col_name,...)\n  | ADD [CONSTRAINT [symbol]]\n        UNIQUE [index_name] [index_type] (index_col_name,...)\n  | ADD [FULLTEXT|SPATIAL] [index_name] (index_col_name,...)\n  | ADD [CONSTRAINT [symbol]]\n        FOREIGN KEY [index_name] (index_col_name,...)\n        [reference_definition]\n  | ALTER [COLUMN] col_name {SET DEFAULT literal | DROP DEFAULT}\n  | CHANGE [COLUMN] old_col_name column_definition\n        [FIRST|AFTER col_name]\n  | MODIFY [COLUMN] column_definition [FIRST | AFTER col_name]\n  | DROP [COLUMN] col_name\n  | DROP PRIMARY KEY\n  | DROP INDEX index_name\n  | DROP FOREIGN KEY fk_symbol\n  | DISABLE KEYS\n  | ENABLE KEYS\n  | RENAME [TO] new_tbl_name\n  | ORDER BY col_name\n  | CONVERT TO CHARACTER SET charset_name [COLLATE collation_name]\n  | [DEFAULT] CHARACTER SET charset_name [COLLATE collation_name]\n  | DISCARD TABLESPACE\n  | IMPORT TABLESPACE\n  | table_options',''),(367,'CHAR BYTE',22,'CHAR BYTE is an alias for CHAR BINARY.\n','',''),(368,'MERGE',7,'\n@menu\n* MERGE table problems::        MERGE Table Problems\n@end menu\n\nThe MERGE storage engine was introduced in MySQL 3.23.25. It\nis also known as the MRG_MyISAM engine.\n\nA MERGE table is a collection of identical MyISAM tables that\ncan be used as one.  ``Identical\'\' means that all tables have\nidentical column and index information.  You can\'t merge tables in which the\ncolumns are listed in a different order, don\'t have exactly the same columns, or\nhave the indexes in different order.  However, any or all of the tables can be\ncompressed with myisampack.\nSee also : [myisampack, , myisampack].\nDifferences in table options such as AVG_ROW_LENGTH, MAX_ROWS,\nor PACK_KEYS do not matter.\n','mysql> CREATE TABLE t1 (\n    ->    a INT NOT NULL AUTO_INCREMENT PRIMARY KEY,\n    ->    message CHAR(20));\nmysql> CREATE TABLE t2 (\n    ->    a INT NOT NULL AUTO_INCREMENT PRIMARY KEY,\n    ->    message CHAR(20));\nmysql> INSERT INTO t1 (message) VALUES (\'Testing\'),(\'table\'),(\'t1\');\nmysql> INSERT INTO t2 (message) VALUES (\'Testing\'),(\'table\'),(\'t2\');\nmysql> CREATE TABLE total (\n    ->    a INT NOT NULL AUTO_INCREMENT,\n    ->    message CHAR(20), INDEX(a))\n    ->    TYPE=MERGE UNION=(t1,t2) INSERT_METHOD=LAST;',''),(369,'CREATE TABLE',28,'CREATE TABLE creates a table with the given name.\nYou must have the CREATE privilege for the table.\n\nRules for allowable table names are given in [Legal names].\nBy default, the table is created in the current database.\nAn error occurs if the table exists, if there is no current database,\nor if the database does not exist.\n','CREATE [TEMPORARY] TABLE [IF NOT EXISTS] tbl_name\n    [(create_definition,...)]\n    [table_options] [select_statement]',''),(370,'>',26,'   >\nGreater than:\n','mysql> SELECT 2 > 2;\n        -> 0',''),(371,'MICROSECOND',14,'   MICROSECOND(expr)\n\nReturns the microseconds from the time or datetime expression expr as a\nnumber in the range from 0 to 999999.\n','mysql> SELECT MICROSECOND(\'12:00:00.123456\');\n        -> 123456\nmysql> SELECT MICROSECOND(\'1997-12-31 23:59:59.000010\');\n        -> 10',''),(372,'ANALYZE',7,'This statement analyzes and stores the key distribution for a table.\nDuring the analysis, the table is locked with a read lock.  This works on\nMyISAM and BDB tables and (as of MySQL 4.0.13) InnoDB\ntables. For MyISAM tables, this\nstatement is equivalent to using myisamchk -a.\n\nMySQL uses the stored key distribution to decide the order in which\ntables should be joined when you perform a join on something other than a\nconstant.\n','ANALYZE [LOCAL | NO_WRITE_TO_BINLOG] TABLE tbl_name [, tbl_name] ...',''),(373,'CONSTRAINT',7,'The syntax of a foreign key constraint definition in InnoDB looks like\nthis:\n\n[CONSTRAINT symbol] FOREIGN KEY [id] (index_col_name, ...)\n    REFERENCES tbl_name (index_col_name, ...)\n    [ON DELETE {RESTRICT | CASCADE | SET NULL | NO ACTION}]\n    [ON UPDATE {RESTRICT | CASCADE | SET NULL | NO ACTION}]\n','CREATE TABLE product (category INT NOT NULL, id INT NOT NULL,\n                      price DECIMAL,\n                      PRIMARY KEY(category, id)) TYPE=INNODB;\nCREATE TABLE customer (id INT NOT NULL,\n                      PRIMARY KEY (id)) TYPE=INNODB;\nCREATE TABLE product_order (no INT NOT NULL AUTO_INCREMENT,\n                      product_category INT NOT NULL,\n                      product_id INT NOT NULL,\n                      customer_id INT NOT NULL,\n                      PRIMARY KEY(no),\n                      INDEX (product_category, product_id),\n                      FOREIGN KEY (product_category, product_id)\n                        REFERENCES product(category, id)\n                        ON UPDATE CASCADE ON DELETE RESTRICT,\n                      INDEX (customer_id),\n                      FOREIGN KEY (customer_id)\n                        REFERENCES customer(id)) TYPE=INNODB;',''),(374,'FIELD',23,'   FIELD(str,str1,str2,str3,...)\nReturns the index of str in the str1, str2,\nstr3, ... list.\nReturns 0 if str is not found.\n\nIf all arguments to FIELD() are strings, all arguments are compared\nas strings. If all arguments are numbers, they are compared as\nnumbers.  Otherwise, the arguments are compared as double.\n\nIf str is NULL, the return value is 0 because\nNULL fails equality comparison with any value.\nFIELD() is the complement of ELT().\n','mysql> SELECT FIELD(\'ej\', \'Hej\', \'ej\', \'Heja\', \'hej\', \'foo\');\n        -> 2\nmysql> SELECT FIELD(\'fo\', \'Hej\', \'ej\', \'Heja\', \'hej\', \'foo\');\n        -> 0',''),(375,'MAKETIME',14,'   MAKETIME(hour,minute,second)\n\nReturns a time value calculated from the hour, minute, and\nsecond arguments.\n','mysql> SELECT MAKETIME(12,15,30);\n        -> \'12:15:30\'',''),(376,'CURDATE',14,'   CURDATE()\n\nReturns the current date as a value in \'YYYY-MM-DD\' or YYYYMMDD\nformat, depending on whether the function is used in a string or numeric\ncontext.\n','mysql> SELECT CURDATE();\n        -> \'1997-12-15\'\nmysql> SELECT CURDATE() + 0;\n        -> 19971215',''),(377,'MIN MAX',12,'   MIN([DISTINCT] expr)\n   MAX([DISTINCT] expr)\nReturns the minimum or maximum value of expr.  MIN() and\nMAX() may take a string argument; in such cases they return the\nminimum or maximum string value. See also : [MySQL indexes].\nThe DISTINCT keyword can be used as of MySQL 5.0.0 to find the minimum\nor maximum of the distinct values of expr; this is supported, but\nproduces the same result as omitting DISTINCT.\n','mysql> SELECT student_name, MIN(test_score), MAX(test_score)\n    ->        FROM student\n    ->        GROUP BY student_name;',''),(378,'SET PASSWORD',7,'','SET PASSWORD = PASSWORD(\'some password\')\nSET PASSWORD FOR user = PASSWORD(\'some password\')',''),(379,'ENUM',1,'   ENUM(\'value1\',\'value2\',...)\n\nAn enumeration.  A string object that can have only one value, chosen\nfrom the list of values \'value1\', \'value2\', ...,\nNULL or the special \'\' error value.  An ENUM column can\nhave a maximum of 65,535 distinct values.\nENUM values are represented internally as integers.\n','',''),(380,'DATABASE',25,'   DATABASE()\nReturns the default (current) database name.\nAs of MySQL 4.1, the string has the utf8 character set.\n','mysql> SELECT DATABASE();\n        -> \'test\'',''),(381,'POINTFROMWKB',13,'   PointFromWKB(wkb[,srid])\nConstructs a POINT value using its WKB representation and SRID.\n','',''),(382,'POWER',4,'   POW(X,Y)\n   POWER(X,Y)\nReturns the value of X raised to the power of Y.\n','mysql> SELECT POW(2,2);\n        -> 4.000000\nmysql> SELECT POW(2,-2);\n        -> 0.250000',''),(383,'ATAN',4,'   ATAN(X)\nReturns the arc tangent of X, that is, the value whose tangent is\nX.\n','mysql> SELECT ATAN(2);\n        -> 1.107149\nmysql> SELECT ATAN(-2);\n        -> -1.107149',''),(384,'STRCMP',23,'   STRCMP(expr1,expr2)\nSTRCMP()\nreturns 0 if the strings are the same, -1 if the first\nargument is smaller than the second according to the current sort order,\nand 1 otherwise.\n','mysql> SELECT STRCMP(\'text\', \'text2\');\n        -> -1\nmysql> SELECT STRCMP(\'text2\', \'text\');\n        -> 1\nmysql> SELECT STRCMP(\'text\', \'text\');\n        -> 0',''),(385,'INSERT DELAYED',6,'The DELAYED option for the INSERT statement is a\nMySQL extension to standard SQL that is very useful if you have clients\nthat can\'t wait for the INSERT to complete.  This is a common\nproblem when you use MySQL for logging and you also\nperiodically run SELECT and UPDATE statements that take a\nlong time to complete.  DELAYED was introduced in MySQL\n3.22.15.\n\nWhen a client uses INSERT DELAYED, it gets an okay from the server at\nonce, and the row is queued to be inserted when the table is not in use by\nany other thread.\n\nAnother major benefit of using INSERT DELAYED is that inserts\nfrom many clients are bundled together and written in one block. This is much\nfaster than doing many separate inserts.\n\nThere are some constraints on the use of DELAYED:\n\n\n --- INSERT DELAYED works only with ISAM, MyISAM, and (beginning\nwith MySQL 4.1) MEMORY tables.\nFor MyISAM tables, if there are no free blocks in the middle of the\ndata file, concurrent SELECT and INSERT statements are supported.\nUnder these circumstances, you very seldom need to use INSERT\nDELAYED with MyISAM.\nSee also : [MyISAM storage engine, , MyISAM storage engine].\nSee also : [MEMORY storage engine, , MEMORY storage engine].\n\n --- INSERT DELAYED should be used only for INSERT statements that\nspecify value lists. This is enforced as of MySQL 4.0.18.  The server ignores\nDELAYED for INSERT DELAYED ... SELECT statements.\n\n --- The server ignores\nDELAYED for INSERT DELAYED ... ON DUPLICATE UPDATE statements.\n\n --- Because the statement returns immediately before the rows are inserted,\nyou cannot use LAST_INSERT_ID() to get the AUTO_INCREMENT\nvalue the statement might generate.\n\n --- DELAYED rows are not visible to SELECT statements until they\nactually have been inserted.\n\n --- DELAYED are ignored on slaves, because this could cause the slave to\nhave different data than the master.\n','INSERT DELAYED ...',''),(386,'MEDIUMTEXT',1,'   MEDIUMTEXT\n\nA TEXT column with a maximum length of 16,777,215\n(2^24 - 1) characters.\n','',''),(387,'LN',4,'   LN(X)\nReturns the natural logarithm of X.\n','mysql> SELECT LN(2);\n        -> 0.693147\nmysql> SELECT LN(-2);\n        -> NULL',''),(388,'LOG',4,'   LOG(X)\n   LOG(B,X)\nIf called with one parameter, this function returns the natural logarithm\nof X.\n','mysql> SELECT LOG(2);\n        -> 0.693147\nmysql> SELECT LOG(-2);\n        -> NULL',''),(389,'SET SQL_LOG_BIN',6,'SET SQL_LOG_BIN = {0|1}\n\nDisables or enables binary logging for the current connection\n(SQL_LOG_BIN is a session variable)\nif the client connects using an account that has the SUPER privilege.\nThe statement is refused with an error if the client does not have that\nprivilege. (Before MySQL 4.1.2, the statement was simply ignored in that case.)\n','',''),(390,'!=',26,'   <>\n   !=\nNot equal:\n','mysql> SELECT \'.01\' <> \'0.01\';\n        -> 1\nmysql> SELECT .01 <> \'0.01\';\n        -> 0\nmysql> SELECT \'zapp\' <> \'zappp\';\n        -> 1',''),(391,'AES_DECRYPT',17,'   AES_ENCRYPT(str,key_str)\n   AES_DECRYPT(crypt_str,key_str)\nThese functions allow encryption and decryption of data using the official\nAES (Advanced Encryption Standard) algorithm, previously known as \"Rijndael.\"\nEncoding with a 128-bit key length is used, but you can extend it up to\n256 bits by modifying the source. We chose 128 bits because it is much\nfaster and it is usually secure enough.\n\nThe input arguments may be any length. If either argument is NULL,\nthe result of this function is also NULL.\n\nBecause AES is a block-level algorithm, padding is used to encode uneven length\nstrings and so the result string length may be calculated as\n16*(trunc(string_length/16)+1).\n\nIf AES_DECRYPT() detects invalid data or incorrect padding, it\nreturns NULL. However, it is possible for AES_DECRYPT()\nto return a non-NULL value (possibly garbage) if the input data or\nthe key is invalid.\n\nYou can use the AES functions to store data in an encrypted form by\nmodifying your queries:\n','INSERT INTO t VALUES (1,AES_ENCRYPT(\'text\',\'password\'));',''),(392,'DAYNAME',14,'   DAYNAME(date)\nReturns the name of the weekday for date.\n','mysql> SELECT DAYNAME(\'1998-02-05\');\n        -> \'Thursday\'',''),(393,'COERCIBILITY',25,'   COERCIBILITY(str)\nReturns the collation coercibility value of the string argument.\n','mysql> SELECT COERCIBILITY(\'abc\' COLLATE latin1_swedish_ci);\n        -> 0\nmysql> SELECT COERCIBILITY(USER());\n        -> 3\nmysql> SELECT COERCIBILITY(\'abc\');\n        -> 4',''),(394,'INT',1,'   INT[(M)] [UNSIGNED] [ZEROFILL]\n\nA normal-size integer. The signed range is -2147483648 to\n2147483647.  The unsigned range is 0 to 4294967295.\n\n   INTEGER[(M)] [UNSIGNED] [ZEROFILL]\n\nThis is a synonym for INT.\n','',''),(395,'RLIKE',23,'   expr REGEXP pat\n   expr RLIKE pat\n\nPerforms a pattern match of a string expression expr against a pattern\npat.  The pattern can be an extended regular expression.  The syntax\nfor regular expressions is discussed in [Regexp].  Returns 1\nif expr matches pat, otherwise returns 0.  If either\nexpr or pat is NULL, the result is NULL.\nRLIKE is a synonym for REGEXP, provided for mSQL\ncompatibility.\n\nThe pattern need not be a literal string. For example, it can be specified\nas a string expression or table column.\n\nNote: Because MySQL uses the C escape syntax in strings (for example,\n\'\\n\' to represent newline), you must double any \'\\\' that you\nuse in your REGEXP strings.\n\nAs of MySQL 3.23.4, REGEXP is not case sensitive for normal (not\nbinary) strings.\n','mysql> SELECT \'Monty!\' REGEXP \'m%y%%\';\n        -> 0\nmysql> SELECT \'Monty!\' REGEXP \'.*\';\n        -> 1\nmysql> SELECT \'new*\\n*line\' REGEXP \'new\\\\*.\\\\*line\';\n        -> 1\nmysql> SELECT \'a\' REGEXP \'A\', \'a\' REGEXP BINARY \'A\';\n        -> 1  0\nmysql> SELECT \'a\' REGEXP \'^[a-d]\';\n        -> 1',''),(396,'GLENGTH',18,'   GLength(ls)\nReturns as a double-precision number the length of the LineString\nvalue ls in its associated spatial reference.\n','mysql> SET @ls = \'LineString(1 1,2 2,3 3)\';\nmysql> SELECT GLength(GeomFromText(@ls));\n+----------------------------+\n| GLength(GeomFromText(@ls)) |\n+----------------------------+\n|            2.8284271247462 |\n+----------------------------+',''),(397,'RADIANS',4,'   RADIANS(X)\nReturns the argument X, converted from degrees to radians.\n','mysql> SELECT RADIANS(90);\n        -> 1.570796',''),(398,'COLLATION',25,'   COLLATION(str)\nReturns the collation for the character set of the string argument.\n','mysql> SELECT COLLATION(\'abc\');\n        -> \'latin1_swedish_ci\'\nmysql> SELECT COLLATION(_utf8\'abc\');\n        -> \'utf8_general_ci\'',''),(399,'COALESCE',26,'   COALESCE(value,...)\nReturns the first non-NULL value in the list.\n','mysql> SELECT COALESCE(NULL,1);\n        -> 1\nmysql> SELECT COALESCE(NULL,NULL,NULL);\n        -> NULL',''),(400,'VERSION',25,'   VERSION()\nReturns a string that indicates the MySQL server version.\nAs of MySQL 4.1, the string has the utf8 character set.\n','mysql> SELECT VERSION();\n        -> \'4.1.3-beta-log\'',''),(401,'MAKE_SET',23,'   MAKE_SET(bits,str1,str2,...)\nReturns a set value (a string containing substrings separated by \',\'\ncharacters) consisting of the strings that have the corresponding bit in\nbits set.  str1 corresponds to bit 0, str2 to bit 1,\nand so on.  NULL values in str1, str2, ...\nare not appended to the result.\n','mysql> SELECT MAKE_SET(1,\'a\',\'b\',\'c\');\n        -> \'a\'\nmysql> SELECT MAKE_SET(1 | 4,\'hello\',\'nice\',\'world\');\n        -> \'hello,world\'\nmysql> SELECT MAKE_SET(1 | 4,\'hello\',\'nice\',NULL,\'world\');\n        -> \'hello\'\nmysql> SELECT MAKE_SET(0,\'a\',\'b\',\'c\');\n        -> \'\'',''),(402,'FIND_IN_SET',23,'   FIND_IN_SET(str,strlist)\nReturns a value 1 to N if the string str is in the string list\nstrlist consisting of N substrings. A string list is a string\ncomposed of substrings separated by \',\' characters. If the first\nargument is a constant string and the second is a column of type SET,\nthe FIND_IN_SET() function is optimized to use bit arithmetic.\nReturns 0 if str is not in strlist or if strlist\nis the empty string.  Returns NULL if either argument is NULL.\nThis function does not work properly if the first argument contains a comma\n(\',\') character.\n','mysql> SELECT FIND_IN_SET(\'b\',\'a,b,c,d\');\n        -> 2','');
/*!40000 ALTER TABLE `help_topic` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `host`
--

DROP TABLE IF EXISTS `host`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `host` (
  `Host` char(60) COLLATE utf8_bin NOT NULL DEFAULT '',
  `Db` char(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `Select_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Insert_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Update_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Delete_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Create_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Drop_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Grant_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `References_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Index_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Alter_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Create_tmp_table_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Lock_tables_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Create_view_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Show_view_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Create_routine_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Alter_routine_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Execute_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  PRIMARY KEY (`Host`,`Db`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Host privileges;  Merged with database privileges';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `host`
--

LOCK TABLES `host` WRITE;
/*!40000 ALTER TABLE `host` DISABLE KEYS */;
/*!40000 ALTER TABLE `host` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ndb_binlog_index`
--

DROP TABLE IF EXISTS `ndb_binlog_index`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ndb_binlog_index` (
  `Position` bigint(20) unsigned NOT NULL,
  `File` varchar(255) NOT NULL,
  `epoch` bigint(20) unsigned NOT NULL,
  `inserts` bigint(20) unsigned NOT NULL,
  `updates` bigint(20) unsigned NOT NULL,
  `deletes` bigint(20) unsigned NOT NULL,
  `schemaops` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`epoch`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ndb_binlog_index`
--

LOCK TABLES `ndb_binlog_index` WRITE;
/*!40000 ALTER TABLE `ndb_binlog_index` DISABLE KEYS */;
/*!40000 ALTER TABLE `ndb_binlog_index` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plugin`
--

DROP TABLE IF EXISTS `plugin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `plugin` (
  `name` char(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `dl` char(128) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='MySQL plugins';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plugin`
--

LOCK TABLES `plugin` WRITE;
/*!40000 ALTER TABLE `plugin` DISABLE KEYS */;
/*!40000 ALTER TABLE `plugin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proc`
--

DROP TABLE IF EXISTS `proc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proc` (
  `db` char(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `name` char(64) NOT NULL DEFAULT '',
  `type` enum('FUNCTION','PROCEDURE') NOT NULL,
  `specific_name` char(64) NOT NULL DEFAULT '',
  `language` enum('SQL') NOT NULL DEFAULT 'SQL',
  `sql_data_access` enum('CONTAINS_SQL','NO_SQL','READS_SQL_DATA','MODIFIES_SQL_DATA') NOT NULL DEFAULT 'CONTAINS_SQL',
  `is_deterministic` enum('YES','NO') NOT NULL DEFAULT 'NO',
  `security_type` enum('INVOKER','DEFINER') NOT NULL DEFAULT 'DEFINER',
  `param_list` blob NOT NULL,
  `returns` char(64) NOT NULL DEFAULT '',
  `body` longblob NOT NULL,
  `definer` char(77) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `sql_mode` set('REAL_AS_FLOAT','PIPES_AS_CONCAT','ANSI_QUOTES','IGNORE_SPACE','NOT_USED','ONLY_FULL_GROUP_BY','NO_UNSIGNED_SUBTRACTION','NO_DIR_IN_CREATE','POSTGRESQL','ORACLE','MSSQL','DB2','MAXDB','NO_KEY_OPTIONS','NO_TABLE_OPTIONS','NO_FIELD_OPTIONS','MYSQL323','MYSQL40','ANSI','NO_AUTO_VALUE_ON_ZERO','NO_BACKSLASH_ESCAPES','STRICT_TRANS_TABLES','STRICT_ALL_TABLES','NO_ZERO_IN_DATE','NO_ZERO_DATE','INVALID_DATES','ERROR_FOR_DIVISION_BY_ZERO','TRADITIONAL','NO_AUTO_CREATE_USER','HIGH_NOT_PRECEDENCE') NOT NULL DEFAULT '',
  `comment` char(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`db`,`name`,`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Stored Procedures';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proc`
--

LOCK TABLES `proc` WRITE;
/*!40000 ALTER TABLE `proc` DISABLE KEYS */;
/*!40000 ALTER TABLE `proc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `procs_priv`
--

DROP TABLE IF EXISTS `procs_priv`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `procs_priv` (
  `Host` char(60) COLLATE utf8_bin NOT NULL DEFAULT '',
  `Db` char(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `User` char(16) COLLATE utf8_bin NOT NULL DEFAULT '',
  `Routine_name` char(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `Routine_type` enum('FUNCTION','PROCEDURE') COLLATE utf8_bin NOT NULL,
  `Grantor` char(77) COLLATE utf8_bin NOT NULL DEFAULT '',
  `Proc_priv` set('Execute','Alter Routine','Grant') CHARACTER SET utf8 NOT NULL DEFAULT '',
  `Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Host`,`Db`,`User`,`Routine_name`,`Routine_type`),
  KEY `Grantor` (`Grantor`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Procedure privileges';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `procs_priv`
--

LOCK TABLES `procs_priv` WRITE;
/*!40000 ALTER TABLE `procs_priv` DISABLE KEYS */;
/*!40000 ALTER TABLE `procs_priv` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servers`
--

DROP TABLE IF EXISTS `servers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `servers` (
  `Server_name` char(64) NOT NULL DEFAULT '',
  `Host` char(64) NOT NULL DEFAULT '',
  `Db` char(64) NOT NULL DEFAULT '',
  `Username` char(64) NOT NULL DEFAULT '',
  `Password` char(64) NOT NULL DEFAULT '',
  `Port` int(4) NOT NULL DEFAULT '0',
  `Socket` char(64) NOT NULL DEFAULT '',
  `Wrapper` char(64) NOT NULL DEFAULT '',
  `Owner` char(64) NOT NULL DEFAULT '',
  PRIMARY KEY (`Server_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='MySQL Foreign Servers table';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servers`
--

LOCK TABLES `servers` WRITE;
/*!40000 ALTER TABLE `servers` DISABLE KEYS */;
/*!40000 ALTER TABLE `servers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tables_priv`
--

DROP TABLE IF EXISTS `tables_priv`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tables_priv` (
  `Host` char(60) COLLATE utf8_bin NOT NULL DEFAULT '',
  `Db` char(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `User` char(16) COLLATE utf8_bin NOT NULL DEFAULT '',
  `Table_name` char(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `Grantor` char(77) COLLATE utf8_bin NOT NULL DEFAULT '',
  `Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Table_priv` set('Select','Insert','Update','Delete','Create','Drop','Grant','References','Index','Alter','Create View','Show view') CHARACTER SET utf8 NOT NULL DEFAULT '',
  `Column_priv` set('Select','Insert','Update','References') CHARACTER SET utf8 NOT NULL DEFAULT '',
  PRIMARY KEY (`Host`,`Db`,`User`,`Table_name`),
  KEY `Grantor` (`Grantor`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table privileges';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tables_priv`
--

LOCK TABLES `tables_priv` WRITE;
/*!40000 ALTER TABLE `tables_priv` DISABLE KEYS */;
/*!40000 ALTER TABLE `tables_priv` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `time_zone`
--

DROP TABLE IF EXISTS `time_zone`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `time_zone` (
  `Time_zone_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Use_leap_seconds` enum('Y','N') NOT NULL DEFAULT 'N',
  PRIMARY KEY (`Time_zone_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Time zones';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `time_zone`
--

LOCK TABLES `time_zone` WRITE;
/*!40000 ALTER TABLE `time_zone` DISABLE KEYS */;
/*!40000 ALTER TABLE `time_zone` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `time_zone_leap_second`
--

DROP TABLE IF EXISTS `time_zone_leap_second`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `time_zone_leap_second` (
  `Transition_time` bigint(20) NOT NULL,
  `Correction` int(11) NOT NULL,
  PRIMARY KEY (`Transition_time`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Leap seconds information for time zones';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `time_zone_leap_second`
--

LOCK TABLES `time_zone_leap_second` WRITE;
/*!40000 ALTER TABLE `time_zone_leap_second` DISABLE KEYS */;
/*!40000 ALTER TABLE `time_zone_leap_second` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `time_zone_name`
--

DROP TABLE IF EXISTS `time_zone_name`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `time_zone_name` (
  `Name` char(64) NOT NULL,
  `Time_zone_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`Name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Time zone names';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `time_zone_name`
--

LOCK TABLES `time_zone_name` WRITE;
/*!40000 ALTER TABLE `time_zone_name` DISABLE KEYS */;
/*!40000 ALTER TABLE `time_zone_name` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `time_zone_transition`
--

DROP TABLE IF EXISTS `time_zone_transition`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `time_zone_transition` (
  `Time_zone_id` int(10) unsigned NOT NULL,
  `Transition_time` bigint(20) NOT NULL,
  `Transition_type_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`Time_zone_id`,`Transition_time`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Time zone transitions';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `time_zone_transition`
--

LOCK TABLES `time_zone_transition` WRITE;
/*!40000 ALTER TABLE `time_zone_transition` DISABLE KEYS */;
/*!40000 ALTER TABLE `time_zone_transition` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `time_zone_transition_type`
--

DROP TABLE IF EXISTS `time_zone_transition_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `time_zone_transition_type` (
  `Time_zone_id` int(10) unsigned NOT NULL,
  `Transition_type_id` int(10) unsigned NOT NULL,
  `Offset` int(11) NOT NULL DEFAULT '0',
  `Is_DST` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `Abbreviation` char(8) NOT NULL DEFAULT '',
  PRIMARY KEY (`Time_zone_id`,`Transition_type_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Time zone transition types';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `time_zone_transition_type`
--

LOCK TABLES `time_zone_transition_type` WRITE;
/*!40000 ALTER TABLE `time_zone_transition_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `time_zone_transition_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `Host` char(60) COLLATE utf8_bin NOT NULL DEFAULT '',
  `User` char(16) COLLATE utf8_bin NOT NULL DEFAULT '',
  `Password` char(41) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL DEFAULT '',
  `Select_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Insert_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Update_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Delete_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Create_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Drop_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Reload_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Shutdown_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Process_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `File_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Grant_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `References_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Index_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Alter_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Show_db_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Super_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Create_tmp_table_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Lock_tables_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Execute_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Repl_slave_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Repl_client_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Create_view_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Show_view_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Create_routine_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Alter_routine_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Create_user_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `ssl_type` enum('','ANY','X509','SPECIFIED') CHARACTER SET utf8 NOT NULL DEFAULT '',
  `ssl_cipher` blob NOT NULL,
  `x509_issuer` blob NOT NULL,
  `x509_subject` blob NOT NULL,
  `max_questions` int(11) unsigned NOT NULL DEFAULT '0',
  `max_updates` int(11) unsigned NOT NULL DEFAULT '0',
  `max_connections` int(11) unsigned NOT NULL DEFAULT '0',
  `max_user_connections` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`Host`,`User`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users and global privileges';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES ('localhost','sigat','*4F4349A8A74DA2E6ED17947BFDB2ED1FEA2ECD34','Y','Y','Y','Y','N','N','N','N','N','N','N','N','N','N','N','N','N','N','N','N','N','N','N','N','N','N','','','','',0,0,0,0),('%.cb.sc.gov.br','sigat','*4F4349A8A74DA2E6ED17947BFDB2ED1FEA2ECD34','Y','Y','Y','Y','N','N','N','N','N','N','N','N','N','N','N','N','N','N','N','N','N','N','N','N','N','N','','','','',0,0,0,0),('localhost','marceloawk','*DC2D6B52998B7BA682D9C0EA117ACB42DF114E36','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','','','','',0,0,0,0),('%','carlos','*56293C419E3D9AF7E274AACE5E33745E70F144C0','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','','','','',0,0,0,0),('%.cb.sc.gov.br','marceloawk','*DC2D6B52998B7BA682D9C0EA117ACB42DF114E36','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','','','','',0,0,0,0);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_info`
--

DROP TABLE IF EXISTS `user_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_info` (
  `User` varchar(16) COLLATE utf8_bin NOT NULL,
  `Full_name` varchar(60) COLLATE utf8_bin DEFAULT NULL,
  `Description` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `Email` varchar(80) COLLATE utf8_bin DEFAULT NULL,
  `Contact_information` text COLLATE utf8_bin,
  `Icon` blob,
  PRIMARY KEY (`User`),
  KEY `user_info_Full_name` (`Full_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Stores additional user information';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_info`
--

LOCK TABLES `user_info` WRITE;
/*!40000 ALTER TABLE `user_info` DISABLE KEYS */;
INSERT INTO `user_info` VALUES ('ederagem','Ederson de Moura','Adminstrador','ederagem@cb.sc.gov.br','Agem Consultoria',''),('edsonagem','Edson O. Lessa Junior','Adminstrador DBA','edsonagem@cb.sc.gov.br','Agem Consultoria',''),('sigat','Sigat ','Sistema de Gerenciamento de Atividades Tecnicas','sigatreports@cb.sc.gov.br','Conta do Sistema Sigat',''),('slave','Slave','Usuario Replicacao','unixreports@cb.sc.gov.br','Conta usada para a replicacao dos servidores',''),('staff','Staff','Usuario Scripts CGis','unixreports@cb.sc.gov.br','Conta usado pelos scripts CGIs para visualizar status da replicacao',''),('marquesagem','Cristian Marques Santos','Programador','marquesagem@cb.sc.gov.br','Agem Consultoria',''),('backup','Backup','Usúario de Backup','','Usuado para efetuar backup do banco de dados','');
/*!40000 ALTER TABLE `user_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Current Database: `netoffice`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `netoffice` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `netoffice`;

--
-- Table structure for table `assignments`
--

DROP TABLE IF EXISTS `assignments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `assignments` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `task` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `owner` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `assigned_to` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `comments` text,
  `assigned` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assignments`
--

LOCK TABLES `assignments` WRITE;
/*!40000 ALTER TABLE `assignments` DISABLE KEYS */;
/*!40000 ALTER TABLE `assignments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `attendants`
--

DROP TABLE IF EXISTS `attendants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `attendants` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `project` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `meeting` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `member` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `published` char(1) NOT NULL DEFAULT '',
  `attended` char(1) NOT NULL DEFAULT '',
  `authorized` char(1) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attendants`
--

LOCK TABLES `attendants` WRITE;
/*!40000 ALTER TABLE `attendants` DISABLE KEYS */;
/*!40000 ALTER TABLE `attendants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bookmarks`
--

DROP TABLE IF EXISTS `bookmarks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bookmarks` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `owner` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `category` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `name` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `description` text,
  `shared` char(1) NOT NULL DEFAULT '',
  `home` char(1) NOT NULL DEFAULT '',
  `comments` char(1) NOT NULL DEFAULT '',
  `users` varchar(255) DEFAULT NULL,
  `created` varchar(16) DEFAULT NULL,
  `modified` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bookmarks`
--

LOCK TABLES `bookmarks` WRITE;
/*!40000 ALTER TABLE `bookmarks` DISABLE KEYS */;
/*!40000 ALTER TABLE `bookmarks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bookmarks_categories`
--

DROP TABLE IF EXISTS `bookmarks_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bookmarks_categories` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bookmarks_categories`
--

LOCK TABLES `bookmarks_categories` WRITE;
/*!40000 ALTER TABLE `bookmarks_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `bookmarks_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `calendar`
--

DROP TABLE IF EXISTS `calendar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `calendar` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `owner` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `subject` varchar(155) DEFAULT NULL,
  `description` text,
  `shortname` varchar(155) DEFAULT NULL,
  `date_start` varchar(10) DEFAULT NULL,
  `date_end` varchar(10) DEFAULT NULL,
  `time_start` varchar(155) DEFAULT NULL,
  `time_end` varchar(155) DEFAULT NULL,
  `reminder` char(1) NOT NULL DEFAULT '',
  `recurring` char(1) NOT NULL DEFAULT '',
  `recur_day` char(1) NOT NULL DEFAULT '',
  `project` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `calendar`
--

LOCK TABLES `calendar` WRITE;
/*!40000 ALTER TABLE `calendar` DISABLE KEYS */;
/*!40000 ALTER TABLE `calendar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `files`
--

DROP TABLE IF EXISTS `files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `files` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `owner` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `project` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `task` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `name` varchar(255) DEFAULT NULL,
  `date` varchar(16) DEFAULT NULL,
  `size` varchar(155) DEFAULT NULL,
  `extension` varchar(155) DEFAULT NULL,
  `comments` varchar(255) DEFAULT NULL,
  `comments_approval` varchar(255) DEFAULT NULL,
  `approver` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `date_approval` varchar(16) DEFAULT NULL,
  `upload` varchar(16) DEFAULT NULL,
  `published` char(1) NOT NULL DEFAULT '',
  `status` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `vc_status` varchar(255) NOT NULL DEFAULT '0',
  `vc_version` varchar(255) NOT NULL DEFAULT '0.0',
  `vc_parent` int(10) unsigned NOT NULL DEFAULT '0',
  `phase` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `files`
--

LOCK TABLES `files` WRITE;
/*!40000 ALTER TABLE `files` DISABLE KEYS */;
/*!40000 ALTER TABLE `files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `holiday`
--

DROP TABLE IF EXISTS `holiday`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `holiday` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `date` varchar(10) DEFAULT NULL,
  `comments` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `holiday`
--

LOCK TABLES `holiday` WRITE;
/*!40000 ALTER TABLE `holiday` DISABLE KEYS */;
/*!40000 ALTER TABLE `holiday` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logs`
--

DROP TABLE IF EXISTS `logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logs` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(155) DEFAULT NULL,
  `password` varchar(155) DEFAULT NULL,
  `ip` varchar(155) DEFAULT NULL,
  `session` varchar(155) DEFAULT NULL,
  `compt` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `last_visite` varchar(16) DEFAULT NULL,
  `connected` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logs`
--

LOCK TABLES `logs` WRITE;
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
INSERT INTO `logs` VALUES (1,'admin','adpexzg3FUZAk','10.193.4.104','a6f606efe2e46c84adec5829878fa0a6',4,'2008-10-03 09:57','1223038627'),(2,'haroldo','haZwiRWpj3xfc','189.64.81.93','2455e6e24da45ea6db7c6ea045e6ce63',2,'2008-09-24 10:51',NULL),(3,'santin','saFUa1HM4T0uM','10.193.4.159','000b95f07ab592ffc4cdbefa5af14e13',4,'2008-09-24 17:02','1222286816'),(4,'cristianawk','orPQjvUTxbDUs','10.193.4.104','a6f606efe2e46c84adec5829878fa0a6',2,'2008-09-30 10:15','1222780514');
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `meetings`
--

DROP TABLE IF EXISTS `meetings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meetings` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `project` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `priority` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `status` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `name` varchar(155) DEFAULT NULL,
  `agenda` text,
  `location` text,
  `minutes` text,
  `chairman` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `recorder` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `date` varchar(10) DEFAULT NULL,
  `start_time` varchar(5) DEFAULT NULL,
  `end_time` varchar(5) DEFAULT NULL,
  `reminder` char(1) NOT NULL DEFAULT '0',
  `reminder_time1` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `reminder_time2` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `created` varchar(16) DEFAULT NULL,
  `modified` varchar(16) DEFAULT NULL,
  `published` char(1) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `meetings`
--

LOCK TABLES `meetings` WRITE;
/*!40000 ALTER TABLE `meetings` DISABLE KEYS */;
/*!40000 ALTER TABLE `meetings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `meetings_attachment`
--

DROP TABLE IF EXISTS `meetings_attachment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meetings_attachment` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `owner` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `project` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `meeting` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `name` varchar(255) DEFAULT NULL,
  `date` varchar(16) DEFAULT NULL,
  `size` varchar(155) DEFAULT NULL,
  `extension` varchar(155) DEFAULT NULL,
  `comments` varchar(255) DEFAULT NULL,
  `comments_approval` varchar(255) DEFAULT NULL,
  `approver` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `date_approval` varchar(16) DEFAULT NULL,
  `upload` varchar(16) DEFAULT NULL,
  `published` char(1) NOT NULL DEFAULT '',
  `status` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `vc_status` varchar(255) NOT NULL DEFAULT '0',
  `vc_version` varchar(255) NOT NULL DEFAULT '0.0',
  `vc_parent` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `meetings_attachment`
--

LOCK TABLES `meetings_attachment` WRITE;
/*!40000 ALTER TABLE `meetings_attachment` DISABLE KEYS */;
/*!40000 ALTER TABLE `meetings_attachment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `meetings_time`
--

DROP TABLE IF EXISTS `meetings_time`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meetings_time` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `project` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `meeting` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `owner` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `date` varchar(16) DEFAULT NULL,
  `hours` float(10,2) NOT NULL DEFAULT '0.00',
  `comments` text,
  `created` varchar(16) DEFAULT NULL,
  `modified` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `meetings_time`
--

LOCK TABLES `meetings_time` WRITE;
/*!40000 ALTER TABLE `meetings_time` DISABLE KEYS */;
/*!40000 ALTER TABLE `meetings_time` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `members` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `organization` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `login` varchar(155) DEFAULT NULL,
  `password` varchar(155) DEFAULT NULL,
  `name` varchar(155) DEFAULT NULL,
  `title` varchar(155) DEFAULT NULL,
  `email_work` varchar(155) DEFAULT NULL,
  `email_home` varchar(155) DEFAULT NULL,
  `phone_work` varchar(155) DEFAULT NULL,
  `phone_home` varchar(155) DEFAULT NULL,
  `mobile` varchar(155) DEFAULT NULL,
  `fax` varchar(155) DEFAULT NULL,
  `comments` text,
  `profil` char(1) NOT NULL DEFAULT '',
  `created` varchar(16) DEFAULT NULL,
  `logout_time` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `last_page` varchar(255) DEFAULT NULL,
  `timezone` char(3) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `members`
--

LOCK TABLES `members` WRITE;
/*!40000 ALTER TABLE `members` DISABLE KEYS */;
INSERT INTO `members` VALUES (1,1,'admin','adpexzg3FUZAk','Administrator',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0','2008-09-23 16:06',0,NULL,''),(2,1,'demo','devFxxVFZsuos','Demo user',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1','2008-09-23 16:06',0,NULL,''),(3,1,'haroldo','haZwiRWpj3xfc','Luis Haroldo','Coronel','haroldo@cb.sc.gov.br',NULL,'','','','','','5','2008-09-24 10:15',0,NULL,'0'),(4,1,'santin','saFUa1HM4T0uM','Lazaro Santin','Marjor','santin@cb.sc.gov.br',NULL,'','','','','','1','2008-09-24 10:16',0,NULL,'0'),(5,1,'duarte','duGZfRix1euVw','Sgd Duarte','Sargento','duarte@cb.sc.gov.br',NULL,'','','','','','1','2008-09-24 10:17',0,NULL,'0'),(6,1,'cristianawk','orPQjvUTxbDUs','Cristian Marques','Gerente','cristianawk@cb.sc.gov.br',NULL,'','','','','','1','2008-09-24 10:17',0,NULL,'0'),(7,1,'solicitante','soLijZyAMHoDk','solicitante','usuario','',NULL,'','','','','','2','2008-09-24 10:18',0,NULL,'0'),(8,1,'marceloawk','maUCOExdjwHSU','Marcelo Viana','Analista de Sistemas','marceloawk@cb.sc.gov.br',NULL,'','','','','','1','2008-09-24 10:18',0,NULL,'0'),(9,1,'rogerawk','roUkj8jeb1PeI','Roger Januario','Analista de Sistemas','rogerawk@cb.sc.gov.br',NULL,'','','','','','1','2008-09-24 10:18',0,NULL,'0'),(10,1,'luanaawk','luVyFnbiBA8AA','Luana Becker','programadora','luanaawk@cb.sc.gov.br',NULL,'','','','','','1','2008-09-24 10:19',0,NULL,'0'),(11,1,'rocha','ronCaH4/z4PSk','Eduardo Rocha','Capitão','rocha@cb.sc.gov.br',NULL,'','','','','','1','2008-09-24 10:26',0,NULL,'0');
/*!40000 ALTER TABLE `members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notes`
--

DROP TABLE IF EXISTS `notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notes` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `project` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `owner` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topic` varchar(255) DEFAULT NULL,
  `subject` varchar(155) DEFAULT NULL,
  `description` text,
  `date` varchar(10) DEFAULT NULL,
  `published` char(1) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notes`
--

LOCK TABLES `notes` WRITE;
/*!40000 ALTER TABLE `notes` DISABLE KEYS */;
/*!40000 ALTER TABLE `notes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `member` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `taskAssignment` char(1) NOT NULL DEFAULT '0',
  `removeProjectTeam` char(1) NOT NULL DEFAULT '0',
  `addProjectTeam` char(1) NOT NULL DEFAULT '0',
  `newTopic` char(1) NOT NULL DEFAULT '0',
  `newPost` char(1) NOT NULL DEFAULT '0',
  `statusTaskChange` char(1) NOT NULL DEFAULT '0',
  `priorityTaskChange` char(1) NOT NULL DEFAULT '0',
  `duedateTaskChange` char(1) NOT NULL DEFAULT '0',
  `clientAddTask` char(1) NOT NULL DEFAULT '0',
  `meetingAssignment` char(1) NOT NULL DEFAULT '0',
  `statusMeetingChange` char(1) NOT NULL DEFAULT '0',
  `priorityMeetingChange` char(1) NOT NULL DEFAULT '0',
  `locationMeetingChange` char(1) NOT NULL DEFAULT '0',
  `timeMeetingChange` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES (1,1,'0','0','0','0','0','0','0','0','0','0','0','0','0','0'),(2,2,'0','0','0','0','0','0','0','0','0','0','0','0','0','0'),(3,3,'0','0','0','0','0','0','0','0','0','0','0','0','0','0'),(4,4,'0','0','0','0','0','0','0','0','0','0','0','0','0','0'),(5,5,'0','0','0','0','0','0','0','0','0','0','0','0','0','0'),(6,6,'0','0','0','0','0','0','0','0','0','0','0','0','0','0'),(7,7,'0','0','0','0','0','0','0','0','0','0','0','0','0','0'),(8,8,'0','0','0','0','0','0','0','0','0','0','0','0','0','0'),(9,9,'0','0','0','0','0','0','0','0','0','0','0','0','0','0'),(10,10,'0','0','0','0','0','0','0','0','0','0','0','0','0','0'),(11,11,'0','0','0','0','0','0','0','0','0','0','0','0','0','0');
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `organizations`
--

DROP TABLE IF EXISTS `organizations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `organizations` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `zip_code` varchar(155) DEFAULT NULL,
  `city` varchar(155) DEFAULT NULL,
  `country` varchar(155) DEFAULT NULL,
  `phone` varchar(155) DEFAULT NULL,
  `fax` varchar(155) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `email` varchar(155) DEFAULT NULL,
  `comments` text,
  `created` varchar(16) DEFAULT NULL,
  `extension_logo` char(3) NOT NULL DEFAULT '',
  `owner` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `organizations`
--

LOCK TABLES `organizations` WRITE;
/*!40000 ALTER TABLE `organizations` DISABLE KEYS */;
INSERT INTO `organizations` VALUES (1,'CBMSC  - Corpo de Bombeiros Militar de Santa Catarina','',NULL,NULL,NULL,NULL,'',NULL,'www.cb.sc.gov.br','diti@cb.sc.gov.br','','2008-09-23 16:06','',0),(2,'Jucesc','JUnta comercial de Florianópolis',NULL,NULL,NULL,NULL,'048 ',NULL,'','','skype da programadore Maria Tereza\r\nTelefone:(048) 3212-5531 Fax: (048) 3223-5562 E-mail: presidente@jucesc.sc.gov. br Website: http://www.jucesc.sc.gov.br Antônio Carlos Zimmermann Presidente','2008-09-24 15:07','',0),(3,'SAU','CBMSC /DiTI',NULL,NULL,NULL,NULL,'',NULL,'','','Servicó de atendimento ao Usuário','2008-09-24 16:00','',0);
/*!40000 ALTER TABLE `organizations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phases`
--

DROP TABLE IF EXISTS `phases`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phases` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `order_num` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `status` varchar(10) DEFAULT NULL,
  `name` varchar(155) DEFAULT NULL,
  `date_start` varchar(10) DEFAULT NULL,
  `date_end` varchar(10) DEFAULT NULL,
  `comments` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phases`
--

LOCK TABLES `phases` WRITE;
/*!40000 ALTER TABLE `phases` DISABLE KEYS */;
INSERT INTO `phases` VALUES (1,1,0,'0','Concept',NULL,NULL,NULL),(2,1,1,'0','Planning',NULL,NULL,NULL),(3,1,2,'0','Development',NULL,NULL,NULL),(4,1,3,'0','Testing',NULL,NULL,NULL),(5,1,4,'0','Rollout',NULL,NULL,NULL),(6,1,5,'0','Maintenance',NULL,NULL,NULL);
/*!40000 ALTER TABLE `phases` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `topic` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `member` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `created` varchar(16) DEFAULT NULL,
  `message` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projects` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `organization` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `owner` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `priority` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `status` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `name` varchar(155) DEFAULT NULL,
  `description` text,
  `url_dev` varchar(255) DEFAULT NULL,
  `url_prod` varchar(255) DEFAULT NULL,
  `created` varchar(16) DEFAULT NULL,
  `modified` varchar(16) DEFAULT NULL,
  `published` char(1) NOT NULL DEFAULT '',
  `upload_max` varchar(155) DEFAULT NULL,
  `phase_set` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `type` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
INSERT INTO `projects` VALUES (1,1,4,5,3,'Integração e193 X Emape','1-Elaboração de aplicativo que realize a leitura de arquivo serializado em direto&#341;orio FTP, e inserção das informações na Base de dado do e193, \r\n2-Exportações de dados do e193 cliente para o sefvidor EMAPE!','http://10.193.4.106','http://10.193.4.55','2008-09-24 14:54',NULL,'1','51200',2,'1');
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reports`
--

DROP TABLE IF EXISTS `reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reports` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `owner` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `name` varchar(155) DEFAULT NULL,
  `projects` varchar(255) DEFAULT NULL,
  `members` varchar(255) DEFAULT NULL,
  `priorities` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `date_due_start` varchar(10) DEFAULT NULL,
  `date_due_end` varchar(10) DEFAULT NULL,
  `created` varchar(16) DEFAULT NULL,
  `date_complete_start` varchar(10) DEFAULT NULL,
  `date_complete_end` varchar(10) DEFAULT NULL,
  `clients` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reports`
--

LOCK TABLES `reports` WRITE;
/*!40000 ALTER TABLE `reports` DISABLE KEYS */;
/*!40000 ALTER TABLE `reports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `services` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(155) DEFAULT NULL,
  `name_print` varchar(155) DEFAULT NULL,
  `hourly_rate` float(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(32) NOT NULL,
  `ipaddr` varchar(16) NOT NULL,
  `session_data` longtext,
  `last_access` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`,`ipaddr`),
  KEY `last_access` (`last_access`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('2455e6e24da45ea6db7c6ea045e6ce63','189.64.81.93','',1222264513),('000b95f07ab592ffc4cdbefa5af14e13','10.193.4.159','browserSession|N;idSession|s:1:\"4\";timezoneSession|s:1:\"0\";languageSession|s:2:\"pt\";loginSession|s:6:\"santin\";passwordSession|s:13:\"saFUa1HM4T0uM\";nameSession|s:13:\"Lazaro Santin\";ipSession|s:12:\"10.193.4.159\";dateunixSession|s:10:\"1222286576\";dateSession|s:19:\"24-09-2008 17:02:56\";profilSession|s:1:\"1\";logouttimeSession|s:1:\"0\";tokenSession|s:32:\"b6f96cfea248bd2769414f881cebb4fd\";lastvisiteSession|s:16:\"2008-09-24 15:00\";',1222286816),('a6f606efe2e46c84adec5829878fa0a6','10.193.4.104','',1225365942);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sorting`
--

DROP TABLE IF EXISTS `sorting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sorting` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `member` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `home_projects` varchar(155) DEFAULT NULL,
  `home_tasks` varchar(155) DEFAULT NULL,
  `home_discussions` varchar(155) DEFAULT NULL,
  `home_reports` varchar(155) DEFAULT NULL,
  `projects` varchar(155) DEFAULT NULL,
  `organizations` varchar(155) DEFAULT NULL,
  `project_tasks` varchar(155) DEFAULT NULL,
  `discussions` varchar(155) DEFAULT NULL,
  `project_discussions` varchar(155) DEFAULT NULL,
  `users` varchar(155) DEFAULT NULL,
  `team` varchar(155) DEFAULT NULL,
  `tasks` varchar(155) DEFAULT NULL,
  `report_tasks` varchar(155) DEFAULT NULL,
  `assignment` varchar(155) DEFAULT NULL,
  `reports` varchar(155) DEFAULT NULL,
  `files` varchar(155) DEFAULT NULL,
  `organization_projects` varchar(155) DEFAULT NULL,
  `notes` varchar(155) DEFAULT NULL,
  `calendar` varchar(155) DEFAULT NULL,
  `phases` varchar(155) DEFAULT NULL,
  `support_requests` varchar(155) DEFAULT NULL,
  `bookmarks` varchar(155) DEFAULT NULL,
  `tasks_time` varchar(155) DEFAULT NULL,
  `meetings` varchar(155) DEFAULT NULL,
  `meetings_attachment` varchar(155) DEFAULT NULL,
  `meetings_time` varchar(155) DEFAULT NULL,
  `calendar_view` varchar(155) DEFAULT NULL,
  `tasks_closed` varchar(155) DEFAULT NULL,
  `milestones` varchar(155) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sorting`
--

LOCK TABLES `sorting` WRITE;
/*!40000 ALTER TABLE `sorting` DISABLE KEYS */;
INSERT INTO `sorting` VALUES (1,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,4,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(5,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(6,6,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(7,7,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(8,8,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(9,9,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(10,10,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(11,11,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `sorting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `support_posts`
--

DROP TABLE IF EXISTS `support_posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `support_posts` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `request_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `message` text,
  `date` varchar(16) DEFAULT NULL,
  `owner` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `project` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `support_posts`
--

LOCK TABLES `support_posts` WRITE;
/*!40000 ALTER TABLE `support_posts` DISABLE KEYS */;
/*!40000 ALTER TABLE `support_posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `support_requests`
--

DROP TABLE IF EXISTS `support_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `support_requests` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `status` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `member` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `priority` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `subject` varchar(255) DEFAULT NULL,
  `message` text,
  `owner` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `date_open` varchar(16) DEFAULT NULL,
  `date_close` varchar(16) DEFAULT NULL,
  `project` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `support_requests`
--

LOCK TABLES `support_requests` WRITE;
/*!40000 ALTER TABLE `support_requests` DISABLE KEYS */;
/*!40000 ALTER TABLE `support_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tasks` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `project` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `priority` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `status` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `owner` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `assigned_to` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `name` varchar(155) DEFAULT NULL,
  `description` text,
  `start_date` varchar(10) DEFAULT NULL,
  `due_date` varchar(10) DEFAULT NULL,
  `estimated_time` varchar(10) DEFAULT NULL,
  `actual_time` varchar(10) DEFAULT NULL,
  `comments` text,
  `completion` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `created` varchar(16) DEFAULT NULL,
  `modified` varchar(16) DEFAULT NULL,
  `assigned` varchar(16) DEFAULT NULL,
  `published` char(1) NOT NULL DEFAULT '',
  `parent_phase` int(10) unsigned NOT NULL DEFAULT '0',
  `complete_date` varchar(10) DEFAULT NULL,
  `service` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `milestone` char(1) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tasks`
--

LOCK TABLES `tasks` WRITE;
/*!40000 ALTER TABLE `tasks` DISABLE KEYS */;
/*!40000 ALTER TABLE `tasks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tasks_time`
--

DROP TABLE IF EXISTS `tasks_time`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tasks_time` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `project` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `task` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `owner` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `date` varchar(16) DEFAULT NULL,
  `hours` float(10,2) NOT NULL DEFAULT '0.00',
  `comments` text,
  `created` varchar(16) DEFAULT NULL,
  `modified` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tasks_time`
--

LOCK TABLES `tasks_time` WRITE;
/*!40000 ALTER TABLE `tasks_time` DISABLE KEYS */;
/*!40000 ALTER TABLE `tasks_time` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teams`
--

DROP TABLE IF EXISTS `teams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teams` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `project` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `member` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `published` char(1) NOT NULL DEFAULT '',
  `authorized` char(1) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teams`
--

LOCK TABLES `teams` WRITE;
/*!40000 ALTER TABLE `teams` DISABLE KEYS */;
INSERT INTO `teams` VALUES (1,1,4,'1','0'),(2,1,9,'1','0'),(3,1,8,'1','0');
/*!40000 ALTER TABLE `teams` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `topics`
--

DROP TABLE IF EXISTS `topics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `topics` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `project` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `owner` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `subject` varchar(155) DEFAULT NULL,
  `status` char(1) NOT NULL DEFAULT '',
  `last_post` varchar(16) DEFAULT NULL,
  `posts` smallint(5) unsigned NOT NULL DEFAULT '0',
  `published` char(1) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `topics`
--

LOCK TABLES `topics` WRITE;
/*!40000 ALTER TABLE `topics` DISABLE KEYS */;
/*!40000 ALTER TABLE `topics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `updates`
--

DROP TABLE IF EXISTS `updates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `updates` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `type` char(1) NOT NULL DEFAULT '',
  `item` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `member` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `comments` text,
  `created` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `updates`
--

LOCK TABLES `updates` WRITE;
/*!40000 ALTER TABLE `updates` DISABLE KEYS */;
/*!40000 ALTER TABLE `updates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Current Database: `receitas`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `receitas` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `receitas`;

--
-- Table structure for table `captadas`
--

DROP TABLE IF EXISTS `captadas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `captadas` (
  `cd_captada` int(11) NOT NULL AUTO_INCREMENT,
  `cd_cidade` int(11) NOT NULL,
  `cd_item` int(11) NOT NULL,
  `cd_mes` int(11) NOT NULL,
  `dt_ano` year(4) NOT NULL,
  `dt_registro` datetime NOT NULL,
  `ds_usuario` varchar(50) NOT NULL,
  `vl_valor` decimal(10,2) NOT NULL,
  PRIMARY KEY (`cd_captada`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `captadas`
--

LOCK TABLES `captadas` WRITE;
/*!40000 ALTER TABLE `captadas` DISABLE KEYS */;
INSERT INTO `captadas` VALUES (1,8093,0,1,2006,'2008-12-17 11:38:10','marceloawk','12.00'),(2,8093,4,12,2006,'2008-12-17 11:38:19','marceloawk','120.00'),(3,8093,2,1,2006,'2008-12-17 11:38:29','marceloawk','445.00'),(4,8093,0,1,2008,'2008-12-18 15:52:16','rocha','0.00'),(5,8093,0,2,2008,'2008-12-18 15:52:27','rocha','0.00'),(6,8199,0,1,2008,'2009-02-09 16:33:47','romaldo','-3281.25'),(7,8199,1,2,2008,'2009-02-09 16:34:39','romaldo','-6834.45'),(8,8199,0,2,2008,'2009-02-09 16:36:08','romaldo','-9617.32'),(9,8199,0,3,2008,'2009-02-09 16:37:32','romaldo','-61361.72'),(10,8199,1,3,2008,'2009-02-09 16:38:07','romaldo','-3962.00'),(11,8199,0,4,2008,'2009-02-09 16:39:07','romaldo','-6586.80'),(12,8199,1,4,2008,'2009-02-09 16:39:30','romaldo','-3110.17'),(13,8199,0,5,2008,'2009-02-09 16:41:09','romaldo','-2931.60'),(14,8199,0,6,2008,'2009-02-09 16:42:02','romaldo','-3477.45'),(15,8199,0,7,2008,'2009-02-09 16:42:54','romaldo','-3358.39'),(16,8199,1,7,2008,'2009-02-09 16:43:18','romaldo','-11727.52'),(17,8199,0,8,2008,'2009-02-09 16:44:02','romaldo','-1570.31'),(18,8199,1,8,2008,'2009-02-09 16:44:30','romaldo','-7924.00'),(19,8199,0,9,2008,'2009-02-09 16:44:54','romaldo','-4076.45'),(20,8199,0,10,2008,'2009-02-09 16:46:42','romaldo','-4435.84'),(21,8199,1,10,2008,'2009-02-09 16:46:59','romaldo','-7924.00'),(22,8199,0,11,2008,'2009-02-09 16:48:59','romaldo','-2744.03'),(23,8199,1,11,2008,'2009-02-09 16:47:59','romaldo','-3962.00'),(24,8199,0,12,2008,'2009-02-09 16:49:47','romaldo','-2274.83'),(25,8199,1,12,2008,'2009-02-09 16:50:03','romaldo','-3962.00'),(26,8199,0,1,2009,'2009-02-09 16:56:11','romaldo','-5090.00'),(27,8199,1,1,2009,'2009-02-09 17:07:29','romaldo','-7191.03'),(28,9939,2,5,2006,'2009-02-13 18:00:15','marceloawk','765.00'),(29,8199,1,2,2009,'2009-05-11 13:12:53','romaldo','-3189.41'),(30,8199,0,2,2009,'2009-05-11 13:14:16','romaldo','-16857.28'),(31,8199,1,3,2009,'2009-05-11 13:14:42','romaldo','-3962.00'),(32,8199,0,3,2009,'2009-05-11 13:15:14','romaldo','-68027.91'),(33,8199,1,4,2009,'2009-05-11 13:16:22','romaldo','-3962.00'),(34,8199,0,4,2009,'2009-05-11 13:16:46','romaldo','-6596.29'),(35,8199,1,5,2009,'2009-06-04 13:22:52','sprotte','-3962.00'),(36,8199,0,5,2009,'2009-06-04 13:24:05','sprotte','-4991.45');
/*!40000 ALTER TABLE `captadas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categorias` (
  `cd_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `ds_categoria` varchar(100) NOT NULL,
  PRIMARY KEY (`cd_categoria`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (1,'Custeio'),(2,'Investimentos administrativo'),(3,'Investimentos operacional');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `itens`
--

DROP TABLE IF EXISTS `itens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `itens` (
  `cd_item` int(11) NOT NULL AUTO_INCREMENT,
  `cd_categoria` int(11) NOT NULL,
  `ds_item` varchar(100) NOT NULL,
  `nr_ordem` smallint(6) NOT NULL,
  PRIMARY KEY (`cd_item`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `itens`
--

LOCK TABLES `itens` WRITE;
/*!40000 ALTER TABLE `itens` DISABLE KEYS */;
INSERT INTO `itens` VALUES (1,1,'Salário Bruto (menos hora extra e adicional)',0),(2,1,'Hora extra/adicional noturno',0),(3,1,'Diárias/passagens',0),(4,1,'Cursos',0),(5,1,'Combustíveis/Lubrificantes',0),(6,1,'Alimentação',0),(7,1,'Fardamento',0),(8,1,'Manutenção de Viaturas',0),(9,1,'Manutenção Embarcação',0),(10,1,'Manutenção Equipamentos diversos',0),(11,1,'Manutenção Instalação Física',0),(12,1,'Material de expediente',0),(13,1,'Material de limpeza',0),(14,1,'Telefone',0),(15,1,'Energia Elétrica',0),(16,1,'Ciasc',0),(17,1,'Água',0),(18,1,'GLP',0),(19,1,'Outros',0),(20,2,'Mobiliário',0),(21,2,'Obras e Instalações',0),(22,2,'Comunicação e Informática',0),(23,3,'Viaturas',0),(24,3,'Embarcações',0),(25,3,'Equipamento operacional para viatura',0),(26,3,'Perícia e Atividade técnica',0),(27,3,'Equipamento de resgate e salvamento',0),(28,3,'Equipamento proteção individual',0),(29,3,'Equipamento pré hospitalar',0),(30,3,'Comunicação e Informátcia',0),(31,3,'Equipamentos diversos',0);
/*!40000 ALTER TABLE `itens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `meses`
--

DROP TABLE IF EXISTS `meses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meses` (
  `cd_mes` int(11) NOT NULL AUTO_INCREMENT,
  `ds_mes` varchar(50) NOT NULL,
  `ds_abreviatura` varchar(50) NOT NULL,
  PRIMARY KEY (`cd_mes`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `meses`
--

LOCK TABLES `meses` WRITE;
/*!40000 ALTER TABLE `meses` DISABLE KEYS */;
INSERT INTO `meses` VALUES (1,'janeiro','Jan'),(2,'fevereiro','Fev'),(3,'marco','Mar'),(4,'abril','Abr'),(5,'maio','Mai'),(6,'junho','Jun'),(7,'julho','Jul'),(8,'agosto','Ago'),(9,'setembro','Set'),(10,'outubro','Out'),(11,'novembro','Nov'),(12,'dezembro','Dez');
/*!40000 ALTER TABLE `meses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `valores`
--

DROP TABLE IF EXISTS `valores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `valores` (
  `cd_valor` int(11) NOT NULL AUTO_INCREMENT,
  `cd_cidade` int(11) NOT NULL,
  `cd_item` int(11) NOT NULL,
  `cd_mes` int(11) NOT NULL,
  `vl_valor` decimal(10,2) NOT NULL,
  `ds_usuario` varchar(50) NOT NULL,
  `dt_registro` datetime NOT NULL,
  `st_fonte` set('local','estado') NOT NULL,
  `dt_ano` year(4) NOT NULL,
  PRIMARY KEY (`cd_valor`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `valores`
--

LOCK TABLES `valores` WRITE;
/*!40000 ALTER TABLE `valores` DISABLE KEYS */;
INSERT INTO `valores` VALUES (1,8093,1,1,'1.00','marceloawk','2008-12-18 12:12:24','local',2006),(2,8093,1,2,'2.00','marceloawk','2008-12-18 12:12:36','local',2006),(3,8093,20,2,'20.00','marceloawk','2008-12-18 12:12:51','local',2006),(4,8093,24,2,'200.00','marceloawk','2008-12-18 12:13:06','local',2006),(5,8093,26,12,'1000.00','marceloawk','2008-12-18 12:13:30','local',2006),(6,9939,2,4,'23.00','marceloawk','2009-02-13 17:55:15','estado',2007);
/*!40000 ALTER TABLE `valores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Current Database: `regin`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `regin` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `regin`;

--
-- Table structure for table `protocolos`
--

DROP TABLE IF EXISTS `protocolos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `protocolos` (
  `protocolo` varchar(20) NOT NULL,
  `protocolo_alvara` varchar(9) DEFAULT NULL,
  `status` set('aprovado','pendente','pendente2','reprovado','reprovado2','aprovado3','pendente3','reprovado3') DEFAULT NULL,
  `finalizado` set('0','1') NOT NULL DEFAULT '0',
  `ID_CIDADE` int(11) NOT NULL,
  PRIMARY KEY (`protocolo`),
  UNIQUE KEY `protocolo` (`protocolo`),
  UNIQUE KEY `protocolo_3` (`protocolo`),
  KEY `protocolo_2` (`protocolo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `protocolos`
--

LOCK TABLES `protocolos` WRITE;
/*!40000 ALTER TABLE `protocolos` DISABLE KEYS */;
INSERT INTO `protocolos` VALUES ('99900001293265',NULL,'pendente2','0',0),('99900001291726','092439314','pendente2','0',0),('99900001291556',NULL,'pendente2','0',0),('99900001291513','092316476','reprovado2','0',0),('99900001290711','092221548','aprovado','0',0),('99900001290428',NULL,'pendente2','0',0),('99900001290207',NULL,'pendente2','0',0),('99900001289721','092717012','pendente2','0',0),('99900001289705','092441130','pendente2','0',0),('99900001289411','092366317','aprovado','0',0),('99900001288369',NULL,'pendente2','0',0),('99900001288237','092848117','pendente2','0',0),('99900001287737','092443400','pendente2','0',0),('99900001287273','092316590','pendente2','0',0),('99900001287168',NULL,'pendente2','0',0),('99900001287133','092709087','pendente2','0',0),('99900001287095','092443753','pendente2','0',0),('99900001287060',NULL,'reprovado2','0',0),('99900001285378','092439012','pendente2','0',0),('99900001285211','092439900','aprovado','0',0),('99900001284126',NULL,'pendente2','0',0),('99900001283553','092440010','aprovado','0',0),('99900001283340',NULL,'pendente2','0',0),('99900001283103',NULL,'pendente2','0',0),('99900001282620',NULL,'pendente2','0',0),('99900001282450',NULL,'pendente2','0',0),('99900001282182',NULL,'pendente2','0',0),('99900001282158','092635636','aprovado','0',0),('99900001281313','092269893','aprovado','0',0),('99900001281046',NULL,'pendente2','0',0),('99900001281003',NULL,'reprovado2','0',0),('99900001280678',NULL,'aprovado','0',0),('99900001279629',NULL,'reprovado2','0',0),('99900001279084',NULL,'pendente2','0',0),('99900001278932','092316409','aprovado','0',0),('99900001278738','092632700','pendente2','0',0),('99900001278720','092596673','reprovado2','0',0),('99900001278541',NULL,'reprovado2','0',0),('99900001278355','092441629','aprovado','0',0),('99900001276980',NULL,'pendente2','0',0),('99900001276972','092441530','aprovado','0',0),('99900001275925',NULL,'reprovado2','0',0),('99900001275011',NULL,'pendente2','0',0),('99900001275003',NULL,'pendente2','0',0),('99900001274708','092443346','pendente2','0',0),('99900001274554',NULL,'pendente2','0',0),('99900001274171',NULL,'pendente2','0',0),('99900001274120','092593739','aprovado','0',0),('99900001274007',NULL,'reprovado2','0',0),('99900001273973','092596754','aprovado','0',0),('99900001273965','092650759','pendente2','0',0),('99900001273949','092315690','pendente2','0',0),('99900001270990',NULL,'pendente2','0',0),('99900001270885','092636470','pendente2','0',0),('99900001270222',NULL,'pendente2','0',0),('99900001269143','092636454','aprovado','0',0),('99900001267930',NULL,'reprovado2','0',0),('99900001267205','092443770','aprovado','0',0),('99900001267175',NULL,'pendente2','0',0),('99900001267043','092710263','pendente2','0',0),('99900001266721','092315313','aprovado','0',0),('99900001266462',NULL,'reprovado2','0',0),('99900001263749',NULL,'reprovado2','0',0),('99900001263714',NULL,'reprovado2','0',0),('99900001263692',NULL,'reprovado2','0',0),('99900001263676',NULL,'pendente2','0',0),('99900001263650',NULL,'pendente2','0',0),('99900001263625',NULL,'pendente2','0',0),('99900001263617',NULL,'pendente2','0',0),('99900001263609',NULL,'reprovado2','0',0),('99900001263587',NULL,'reprovado2','0',0),('99900001263560',NULL,'reprovado2','0',0),('99900001263544',NULL,'pendente2','0',0),('99900001263528',NULL,'pendente2','0',0),('99900001263471',NULL,'reprovado2','0',0),('99900001263463',NULL,'pendente2','0',0),('99900001263323','092441211','pendente2','0',0),('99900001263315',NULL,'pendente2','0',0),('99900001263234',NULL,'pendente2','0',0),('99900001263099',NULL,'pendente2','0',0),('99900001263064',NULL,'pendente2','0',0),('99900001262858',NULL,'pendente2','0',0),('99900001262548',NULL,'pendente2','0',0),('99900001262130','092493378','pendente2','0',0),('99900001260278',NULL,'reprovado2','0',0),('99900001258540',NULL,'pendente2','0',0),('99900001255444',NULL,'pendente2','0',0),('99900001255070',NULL,'pendente2','0',0),('99900001251074',NULL,'reprovado2','0',0),('99900001247654',NULL,'reprovado2','0',0),('99900001246160',NULL,'pendente2','0',0),('99900001245635',NULL,'pendente2','0',0),('99900001245481',NULL,'reprovado2','0',0),('99900001245228',NULL,'pendente2','0',0),('99900001240757',NULL,'pendente2','0',0),('99900001235176',NULL,'reprovado2','0',0),('99900001234811',NULL,'pendente2','0',0),('99900001234188',NULL,'pendente2','0',0),('99900001232584',NULL,'pendente2','0',0),('99900001231286','091780721','reprovado2','0',0),('99900001227947',NULL,'pendente2','0',0),('99900001227556','091780950','pendente2','0',0),('99900001227130',NULL,'pendente2','0',0),('99900001227033',NULL,'pendente2','0',0),('99900001223569',NULL,'reprovado2','0',0),('99900001222201',NULL,'reprovado2','0',0),('99900001216325','092298451','pendente2','0',0),('99900001216171','091780144','pendente2','0',0),('99900001215507',NULL,'pendente2','0',0),('99900001215396','091780403','reprovado2','0',0),('99900001215370',NULL,'pendente2','0',0),('99900001211528','091779154','reprovado2','0',0),('99900001210432','091780195','pendente2','0',0),('99900001207601',NULL,'pendente2','0',0),('99900001206613',NULL,'pendente2','0',0),('99900001206346',NULL,'pendente2','0',0),('99900001204920',NULL,'pendente2','0',0),('99900001204874',NULL,'reprovado2','0',0),('99900001204130',NULL,'reprovado2','0',0),('99900001202758',NULL,'pendente2','0',0),('99900001200461','091779502','reprovado2','0',0),('99900001199536',NULL,'reprovado2','0',0),('99900001198610',NULL,'pendente2','0',0),('99900001197401',NULL,'reprovado2','0',0),('99900001195670','091779219','pendente2','0',0),('99900001192701',NULL,'pendente3','0',0),('99900001192256','091780470','pendente2','0',0),('99900001192051','091778611','reprovado2','0',0),('99900001191268',NULL,'reprovado2','0',0),('99900001190440','091778301','reprovado2','0',0),('99900001190067','091780012','reprovado2','0',0),('99900001187708',NULL,'reprovado2','0',0),('99900001186248',NULL,'reprovado2','0',0),('99900001185489','091778590','pendente2','0',0),('99900001185055','091778328','pendente2','0',0),('99900001182196','091777950','pendente2','0',0),('99900001181785','091778573','reprovado2','0',0),('99900001181297',NULL,'pendente2','0',0),('99900001181270',NULL,'pendente2','0',0),('99900001174517',NULL,'pendente2','0',0),('99900001174193',NULL,'pendente2','0',0),('99900001173995',NULL,'reprovado2','0',0),('99900001170457','091778450','pendente2','0',0),('99900001162683','091779782','pendente2','0',0),('99900001162470','091777372','pendente2','0',0),('99900001161865',NULL,'reprovado2','0',0),('99900001159771','092131352','reprovado2','0',0),('99900001158031','091777755','pendente2','0',0),('99900001155946',NULL,'reprovado2','0',0),('99900001149881',NULL,'reprovado2','0',0),('99900001147854','091776635','pendente2','0',0),('99900001146157',NULL,'pendente2','0',0),('99900001139363','091775809','reprovado2','0',0),('99900001135040',NULL,'pendente2','0',0),('99900001134990',NULL,'pendente2','0',0),('99900001134264','091775981','reprovado2','0',0),('99900001133861',NULL,'pendente2','0',0),('99900001129066','091776155','pendente2','0',0),('99900001128353','091776104','pendente2','0',0),('99900001125516','091776848','pendente2','0',0),('99900001123246',NULL,'reprovado2','0',0),('99900001123076','091775663','pendente2','0',0),('99900001122959',NULL,'reprovado2','0',0),('99900001121995','091776945','pendente2','0',0),('99900001117173','091775582','reprovado2','0',0),('99900001116835',NULL,'pendente2','0',0),('99900001112872',NULL,'reprovado2','0',0),('99900001112775',NULL,'reprovado2','0',0),('99900001112740','091776589','reprovado2','0',0),('99900001109464','091776074','pendente2','0',0),('99900001105060',NULL,'reprovado2','0',0),('99900001099582',NULL,'pendente2','0',0),('99900001099310','091774845','reprovado2','0',0),('99900001098780','091773873','pendente2','0',0),('99900001098039',NULL,'reprovado2','0',0),('99900001094530','091773601','reprovado2','0',0),('99900001091824',NULL,'pendente2','0',0),('99900001086839','091776180','reprovado2','0',0),('99900001086588',NULL,'reprovado2','0',0),('99900001086502','091773709','reprovado2','0',0),('99900001075837',NULL,'pendente2','0',0),('99900001075675',NULL,'pendente2','0',0),('99900001075020',NULL,'pendente2','0',0),('99900001075012',NULL,'pendente2','0',0),('99900001072366','091774179','pendente2','0',0),('99900001071629',NULL,'reprovado2','0',0),('99900001071491',NULL,'pendente2','0',0),('99900001066668',NULL,'pendente2','0',0),('99900001066650',NULL,'pendente2','0',0),('99900001066609',NULL,'reprovado2','0',0),('99900001066595',NULL,'reprovado2','0',0),('99900001066579',NULL,'reprovado2','0',0),('99900001066560',NULL,'reprovado2','0',0),('99900001066552',NULL,'pendente2','0',0),('99900001066544',NULL,'pendente2','0',0),('99900001066536',NULL,'reprovado2','0',0),('99900001066528',NULL,'pendente2','0',0),('99900001066510',NULL,'reprovado2','0',0),('99900001066501',NULL,'pendente2','0',0),('99900001066498',NULL,'pendente2','0',0),('99900001066480',NULL,'reprovado2','0',0),('99900001066471',NULL,'reprovado2','0',0),('99900001066463',NULL,'pendente2','0',0),('99900001066455',NULL,'pendente2','0',0),('99900001066447',NULL,'reprovado2','0',0),('99900001066439',NULL,'pendente2','0',0),('99900001066420',NULL,'pendente2','0',0),('99900001066412',NULL,'reprovado2','0',0),('99900001066404',NULL,'reprovado2','0',0),('99900001066390',NULL,'pendente2','0',0),('99900001066382',NULL,'pendente2','0',0),('99900001066374',NULL,'pendente2','0',0),('99900001066366',NULL,'pendente2','0',0),('99900001066358',NULL,'reprovado2','0',0),('99900001066340',NULL,'reprovado2','0',0),('99900001063502',NULL,'reprovado2','0',0),('99900001063480',NULL,'pendente2','0',0),('99900001063197',NULL,'reprovado2','0',0),('99900001063170',NULL,'reprovado2','0',0),('99900001063162',NULL,'pendente2','0',0),('99900001063146',NULL,'reprovado2','0',0),('99900001063103',NULL,'reprovado2','0',0),('99900001063090',NULL,'reprovado2','0',0),('99900001063081',NULL,'pendente2','0',0),('99900001063073',NULL,'reprovado2','0',0),('99900001061313',NULL,'reprovado2','0',0),('99900001061305',NULL,'reprovado2','0',0),('99900001061291',NULL,'reprovado2','0',0),('99900001061283',NULL,'reprovado2','0',0),('99900001061275',NULL,'reprovado2','0',0),('99900001061267',NULL,'reprovado2','0',0),('99900001061240',NULL,'reprovado2','0',0),('99900001061216',NULL,'reprovado2','0',0),('99900001061135',NULL,'reprovado2','0',0),('99900001061119',NULL,'reprovado2','0',0),('99900001061100',NULL,'reprovado2','0',0),('99900001061070',NULL,'reprovado2','0',0),('99900001061046',NULL,'reprovado2','0',0),('99900001061020',NULL,'reprovado2','0',0),('99900001061011',NULL,'reprovado2','0',0),('99900001060996',NULL,'reprovado2','0',0),('99900001060988',NULL,'reprovado2','0',0),('99900001060970',NULL,'reprovado2','0',0),('99900001060961',NULL,'reprovado2','0',0),('99900001060945',NULL,'reprovado2','0',0),('99900001060546',NULL,'reprovado2','0',0),('99900001060511',NULL,'pendente2','0',0),('99900001060449',NULL,'pendente2','0',0),('99900001060430',NULL,'pendente2','0',0),('99900001060414',NULL,'pendente2','0',0),('99900001060406','091775213','reprovado2','0',0),('99900001059858','091774438','pendente2','0',0),('99900001055607','091772168','pendente2','0',0),('99900001055500','091772397','pendente2','0',0),('99900001054848',NULL,'reprovado2','0',0),('99900001054830',NULL,'reprovado2','0',0),('99900001054821',NULL,'reprovado2','0',0),('99900001054813',NULL,'reprovado2','0',0),('99900001054805',NULL,'reprovado2','0',0),('99900001054791',NULL,'reprovado2','0',0),('99900001054783',NULL,'reprovado2','0',0),('99900001054775',NULL,'reprovado2','0',0),('99900001054759',NULL,'reprovado2','0',0),('99900001054740',NULL,'reprovado2','0',0),('99900001054732',NULL,'reprovado2','0',0),('99900001054724',NULL,'reprovado2','0',0),('99900001054716',NULL,'reprovado2','0',0),('99900001054708',NULL,'reprovado2','0',0),('99900001054678',NULL,'reprovado2','0',0),('99900001054660',NULL,'reprovado2','0',0),('99900001054643',NULL,'reprovado2','0',0),('99900001054627',NULL,'reprovado2','0',0),('99900001054619',NULL,'reprovado2','0',0),('99900001054600',NULL,'reprovado2','0',0),('99900001051555',NULL,'pendente2','0',0),('99900001050265','091264928','pendente2','0',0),('99900001050222','091772699','reprovado2','0',0),('99900001045750','091771951','pendente2','0',0),('99900001045172',NULL,'pendente2','0',0),('99900001042874','091264685','pendente2','0',0),('99900001042181','091775000','pendente2','0',0),('99900001040618',NULL,'pendente2','0',0),('99900001040294',NULL,'pendente2','0',0),('99900001029509','091264669','pendente2','0',0),('99900001029487','091772281','pendente2','0',0),('99900001027590','091264766','pendente2','0',0),('99900001027360',NULL,'pendente2','0',0),('99900001022253','091181453','pendente2','0',0),('99900001021648',NULL,'reprovado2','0',0),('99900001019074','091772222','pendente2','0',0),('99900001018728','091264243','reprovado2','0',0),('99900001015842','091772664','pendente2','0',0),('99900001014684','091180708','reprovado2','0',0),('99900001014668',NULL,'pendente2','0',0),('99900001012487','091772710','pendente2','0',0),('99900001012398','091180686','pendente2','0',0),('99900001010921',NULL,'pendente2','0',0),('99900001010905',NULL,'reprovado2','0',0),('99900001010891',NULL,'pendente2','0',0),('99900001010875',NULL,'pendente2','0',0),('99900001010816',NULL,'reprovado2','0',0),('99900001010808',NULL,'pendente2','0',0),('99900001010786',NULL,'pendente2','0',0),('99900001010778',NULL,'pendente2','0',0),('99900001010760',NULL,'reprovado2','0',0),('99900001010751',NULL,'reprovado2','0',0),('99900001010735',NULL,'reprovado2','0',0),('99900001010727',NULL,'pendente2','0',0),('99900001010719',NULL,'pendente2','0',0),('99900001010700',NULL,'reprovado2','0',0),('99900001010697',NULL,'pendente2','0',0),('99900001010689',NULL,'pendente2','0',0),('99900001010409','091180759','pendente2','0',0),('99900001008722',NULL,'reprovado2','0',0),('99900001008641',NULL,'reprovado2','0',0),('99900001008617',NULL,'reprovado2','0',0),('99900001008595',NULL,'reprovado2','0',0),('99900001008501',NULL,'reprovado2','0',0),('99900001008498',NULL,'reprovado2','0',0),('99900001008480',NULL,'reprovado2','0',0),('99900001008471',NULL,'pendente2','0',0),('99900001008463',NULL,'reprovado2','0',0),('99900001008455',NULL,'reprovado2','0',0),('99900001008447',NULL,'reprovado2','0',0),('99900001008439',NULL,'pendente2','0',0),('99900001008420',NULL,'pendente2','0',0),('99900001008404',NULL,'reprovado2','0',0),('99900001008390',NULL,'pendente2','0',0),('99900001008382',NULL,'reprovado2','0',0),('99900001008374',NULL,'reprovado2','0',0),('99900001008366',NULL,'pendente2','0',0),('99900001007505','091772753','reprovado2','0',0),('99900001007483',NULL,'reprovado2','0',0),('99900001006703','091180074','reprovado2','0',0),('99900001005464',NULL,'pendente2','0',0),('99900001005251','091179971','pendente2','0',0),('99900001005090',NULL,'reprovado2','0',0),('99900001005065',NULL,'reprovado2','0',0),('99900001005057',NULL,'reprovado2','0',0),('99900001004964',NULL,'reprovado2','0',0),('99900001004956',NULL,'reprovado2','0',0),('99900001004948',NULL,'reprovado2','0',0),('99900001004930',NULL,'reprovado2','0',0),('99900001004913',NULL,'reprovado2','0',0),('99900001004905',NULL,'reprovado2','0',0),('99900001004891',NULL,'reprovado2','0',0),('99900001004875',NULL,'reprovado2','0',0),('99900001004859',NULL,'reprovado2','0',0),('99900001003526','091179750','pendente2','0',0),('99900001001825','091178770','reprovado2','0',0),('99900001000098','091181690','reprovado2','0',0),('99900000999393',NULL,'reprovado2','0',0),('99900000998877','091179440','pendente2','0',0),('99900000997404','091180236','pendente2','0',0),('99900000992712',NULL,'pendente2','0',0),('99900000987808','091179858','pendente2','0',0),('99900000986437',NULL,'pendente2','0',0),('99900000984043','091179130','pendente2','0',0),('99900000982385','091177847','pendente2','0',0),('99900000981370','091343399','reprovado2','0',0),('99900000979929','091177286','pendente2','0',0),('99900000979643',NULL,'pendente2','0',0),('99900000979007',NULL,'pendente2','0',0),('99900000978736','091177782','pendente2','0',0),('99900000978388','091178118','pendente2','0',0),('99900000975320','091179645','pendente2','0',0),('99900000974560','091773156','pendente2','0',0),('99900000974013',NULL,'pendente2','0',0),('99900000973742','091178533','pendente2','0',0),('99900000973114',NULL,'pendente2','0',0),('99900000972061',NULL,'pendente2','0',0),('99900000971561',NULL,'pendente2','0',0),('99900000971529',NULL,'pendente2','0',0),('99900000971502',NULL,'pendente2','0',0),('99900000971499',NULL,'pendente2','0',0),('99900000971472','091181666','pendente2','0',0),('99900000971456',NULL,'pendente2','0',0),('99900000971375',NULL,'pendente2','0',0),('99900000971294',NULL,'pendente2','0',0),('99900000971286',NULL,'pendente2','0',0),('99900000971278',NULL,'reprovado2','0',0),('99900000971189',NULL,'pendente2','0',0),('99900000971014',NULL,'pendente2','0',0),('99900000970980',NULL,'pendente2','0',0),('99900000970930',NULL,'reprovado2','0',0),('99900000970867',NULL,'pendente2','0',0),('99900000970859',NULL,'pendente2','0',0),('99900000970840',NULL,'pendente2','0',0),('99900000970751',NULL,'pendente2','0',0),('99900000970220',NULL,'pendente2','0',0),('99900000970212',NULL,'pendente2','0',0),('99900000970204',NULL,'reprovado2','0',0),('99900000970140',NULL,'reprovado2','0',0),('99900000970085',NULL,'pendente2','0',0),('99900000969591',NULL,'pendente2','0',0),('99900000969460',NULL,'pendente2','0',0),('99900000969443',NULL,'pendente2','0',0),('99900000969230',NULL,'pendente2','0',0),('99900000969117',NULL,'pendente2','0',0),('99900000969028',NULL,'pendente2','0',0),('99900000969001',NULL,'pendente2','0',0),('99900000968978',NULL,'pendente2','0',0),('99900000968625',NULL,'pendente2','0',0),('99900000968498',NULL,'pendente2','0',0),('99900000968358',NULL,'pendente2','0',0),('99900000968242',NULL,'pendente2','0',0),('99900000968030',NULL,'pendente2','0',0),('99900000968021',NULL,'pendente2','0',0),('99900000968013',NULL,'pendente2','0',0),('99900000967904','091522200','pendente2','0',0),('99900000967890',NULL,'pendente2','0',0),('99900000967688',NULL,'pendente2','0',0),('99900000967670',NULL,'pendente2','0',0),('99900000967661',NULL,'pendente2','0',0),('99900000967610',NULL,'pendente2','0',0),('99900000967572','091152356','pendente2','0',0),('99900000967513',NULL,'pendente2','0',0),('99900000967505',NULL,'pendente2','0',0),('99900000967475',NULL,'pendente2','0',0),('99900000967467',NULL,'pendente2','0',0),('99900000967440',NULL,'pendente2','0',0),('99900000967432',NULL,'pendente2','0',0),('99900000967424',NULL,'pendente2','0',0),('99900000967408',NULL,'pendente2','0',0),('99900000967262',NULL,'pendente2','0',0),('99900000967157',NULL,'pendente2','0',0),('99900000967130',NULL,'pendente2','0',0),('99900000967041',NULL,'pendente2','0',0),('99900000966614',NULL,'pendente2','0',0),('99900000966606',NULL,'pendente2','0',0),('99900000966460',NULL,'pendente2','0',0),('99900000966436',NULL,'pendente2','0',0),('99900000966363',NULL,'pendente2','0',0),('99900000966339',NULL,'reprovado2','0',0),('99900000966320',NULL,'pendente2','0',0),('99900000966312',NULL,'pendente2','0',0),('99900000966061',NULL,'pendente2','0',0),('99900000965952',NULL,'pendente2','0',0),('99900000965936',NULL,'pendente2','0',0),('99900000965898',NULL,'pendente2','0',0),('99900000965758',NULL,'pendente2','0',0),('99900000965561',NULL,'pendente2','0',0),('99900000965421',NULL,'pendente2','0',0),('99900000965286',NULL,'pendente2','0',0),('99900000965189',NULL,'pendente2','0',0),('99900000964956',NULL,'reprovado2','0',0),('99900000964573','091195462','pendente2','0',0),('99900000964492',NULL,'pendente2','0',0),('99900000964484',NULL,'pendente2','0',0),('99900000964425',NULL,'pendente2','0',0),('99900000964409','091151961','pendente2','0',0),('99900000964298',NULL,'pendente2','0',0),('99900000964271',NULL,'pendente2','0',0),('99900000963844',NULL,'pendente2','0',0),('99900000963836',NULL,'pendente2','0',0),('99900000963747',NULL,'pendente2','0',0),('99900000963720',NULL,'reprovado2','0',0),('99900000963690',NULL,'pendente2','0',0),('99900000963682',NULL,'pendente2','0',0),('99900000963674',NULL,'pendente2','0',0),('99900000963666',NULL,'pendente2','0',0),('99900000963470',NULL,'pendente2','0',0),('99900000963461',NULL,'pendente2','0',0),('99900000963437',NULL,'pendente2','0',0),('99900000963313',NULL,'pendente2','0',0),('99900000963305',NULL,'pendente2','0',0),('99900000963291',NULL,'pendente2','0',0),('99900000963283',NULL,'pendente2','0',0),('99900000963267',NULL,'pendente2','0',0),('99900000963232',NULL,'pendente2','0',0),('99900000963224',NULL,'pendente2','0',0),('99900000963208',NULL,'pendente2','0',0),('99900000963160',NULL,'pendente2','0',0),('99900000963135',NULL,'pendente2','0',0),('99900000963119',NULL,'pendente2','0',0),('99900000963100',NULL,'pendente2','0',0),('99900000963038',NULL,'reprovado2','0',0),('99900000963003',NULL,'reprovado2','0',0),('99900000962970','091151716','pendente2','0',0),('99900000962953',NULL,'pendente2','0',0),('99900000962937',NULL,'pendente2','0',0),('99900000962856',NULL,'pendente2','0',0),('99900000962830','091176441','pendente2','0',0),('99900000962821',NULL,'pendente2','0',0),('99900000962759',NULL,'pendente2','0',0),('99900000962678',NULL,'pendente2','0',0),('99900000962562',NULL,'pendente2','0',0),('99900000962449',NULL,'pendente2','0',0),('99900000962198',NULL,'pendente2','0',0),('99900000961809','091098947','pendente2','0',0),('99900000961795',NULL,'pendente2','0',0),('99900000961582',NULL,'pendente2','0',0),('99900000961574',NULL,'pendente2','0',0),('99900000961434',NULL,'pendente2','0',0),('99900000961167',NULL,'pendente2','0',0),('99900000960977',NULL,'pendente2','0',0),('99900000960969',NULL,'pendente2','0',0),('99900000960950',NULL,'pendente2','0',0),('99900000960926',NULL,'pendente2','0',0),('99900000960640',NULL,'pendente2','0',0),('99900000960489','091150124','pendente2','0',0),('99900000960470',NULL,'pendente2','0',0),('99900000960225',NULL,'pendente2','0',0),('99900000960039',NULL,'pendente2','0',0),('99900000959812',NULL,'pendente2','0',0),('99900000959804',NULL,'pendente2','0',0),('99900000959790',NULL,'reprovado2','0',0),('99900000959774',NULL,'pendente2','0',0),('99900000959731',NULL,'pendente2','0',0),('99900000959715',NULL,'pendente2','0',0),('99900000959669',NULL,'reprovado2','0',0),('99900000959650',NULL,'pendente2','0',0),('99900000959642',NULL,'reprovado2','0',0),('99900000959634',NULL,'pendente2','0',0),('99900000959596',NULL,'pendente2','0',0),('99900000959545',NULL,'pendente2','0',0),('99900000959529',NULL,'pendente2','0',0),('99900000959510',NULL,'pendente2','0',0),('99900000959502',NULL,'pendente2','0',0),('99900000959464',NULL,'pendente2','0',0),('99900000959448',NULL,'pendente2','0',0),('99900000959430',NULL,'pendente2','0',0),('99900000959421','090747658','pendente2','0',0),('99900000959243',NULL,'pendente2','0',0),('99900000959170',NULL,'pendente2','0',0),('99900000959090',NULL,'pendente2','0',0),('99900000959065',NULL,'pendente2','0',0),('99900000957801',NULL,'pendente2','0',0),('99900000957771',NULL,'pendente2','0',0),('99900000957712',NULL,'pendente2','0',0),('99900000957704',NULL,'pendente2','0',0),('99900000957674',NULL,'pendente2','0',0),('99900000957607',NULL,'reprovado2','0',0),('99900000957593',NULL,'pendente2','0',0),('99900000957542','090745329','pendente2','0',0),('99900000957240',NULL,'pendente2','0',0),('99900000957232',NULL,'pendente2','0',0),('99900000957216',NULL,'pendente2','0',0),('99900000957194',NULL,'pendente2','0',0),('99900000957143',NULL,'pendente2','0',0),('99900000957135',NULL,'pendente2','0',0),('99900000957127',NULL,'pendente2','0',0),('99900000957054',NULL,'pendente2','0',0),('99900000956953',NULL,'pendente2','0',0),('99900000956848',NULL,'pendente2','0',0),('99900000956830','091150639','pendente2','0',0),('99900000956783',NULL,'pendente2','0',0),('99900000956775',NULL,'pendente2','0',0),('99900000956732',NULL,'pendente2','0',0),('99900000956708',NULL,'pendente2','0',0),('99900000956171',NULL,'pendente2','0',0),('99900000956058','091151139','pendente2','0',0),('99900000956040',NULL,'pendente2','0',0),('99900000956031',NULL,'pendente2','0',0),('99900000955930',NULL,'pendente2','0',0),('99900000955922',NULL,'pendente2','0',0),('99900000955914',NULL,'pendente2','0',0),('99900000955590',NULL,'pendente2','0',0),('99900000955523',NULL,'pendente2','0',0),('99900000955515',NULL,'pendente2','0',0),('99900000955450',NULL,'pendente2','0',0),('99900000955442',NULL,'pendente2','0',0),('99900000955418',NULL,'pendente2','0',0),('99900000955353',NULL,'pendente2','0',0),('99900000955310',NULL,'pendente2','0',0),('99900000955264','091151163','pendente2','0',0),('99900000955256',NULL,'pendente2','0',0),('99900000955221',NULL,'pendente2','0',0),('99900000955191',NULL,'pendente2','0',0),('99900000955043',NULL,'reprovado2','0',0),('99900000955035',NULL,'pendente2','0',0),('99900000955027',NULL,'pendente2','0',0),('99900000954969',NULL,'pendente2','0',0),('99900000954950',NULL,'pendente2','0',0),('99900000954934',NULL,'pendente2','0',0),('99900000954870',NULL,'pendente2','0',0),('99900000954861',NULL,'pendente2','0',0),('99900000954845',NULL,'pendente2','0',0),('99900000954764',NULL,'pendente2','0',0),('99900000954640',NULL,'pendente2','0',0),('99900000954624',NULL,'pendente2','0',0),('99900000954594',NULL,'pendente2','0',0),('99900000954470',NULL,'pendente2','0',0),('99900000954152',NULL,'pendente2','0',0),('99900000953970',NULL,'pendente2','0',0),('99900000953962',NULL,'pendente2','0',0),('99900000953822','091193370','pendente2','0',0),('99900000953814',NULL,'pendente2','0',0),('99900000953504',NULL,'pendente2','0',0),('99900000953482',NULL,'pendente2','0',0),('99900000953237',NULL,'pendente2','0',0),('99900000953121',NULL,'pendente2','0',0),('99900000953113',NULL,'pendente2','0',0),('99900000953105',NULL,'pendente2','0',0),('99900000952850',NULL,'pendente2','0',0),('99900000952400',NULL,'pendente2','0',0),('99900000952338','091234905','pendente2','0',0),('99900000952320',NULL,'pendente2','0',0),('99900000952311',NULL,'pendente2','0',0),('99900000952290',NULL,'pendente2','0',0),('99900000952125',NULL,'pendente2','0',0),('99900000952117',NULL,'pendente2','0',0),('99900000952109',NULL,'pendente2','0',0),('99900000952052',NULL,'pendente2','0',0),('99900000952036',NULL,'pendente2','0',0),('99900000951951',NULL,'pendente2','0',0),('99900000951781',NULL,'pendente2','0',0),('99900000951773',NULL,'pendente2','0',0),('99900000951749',NULL,'pendente2','0',0),('99900000951730',NULL,'pendente2','0',0),('99900000951722',NULL,'pendente2','0',0),('99900000951668',NULL,'pendente2','0',0),('99900000951641','091177197','pendente2','0',0),('99900000951609',NULL,'pendente2','0',0),('99900000951595',NULL,'pendente2','0',0),('99900000951552',NULL,'pendente2','0',0),('99900000951544',NULL,'pendente2','0',0),('99900000951510',NULL,'pendente2','0',0),('99900000951455',NULL,'pendente2','0',0),('99900000951340',NULL,'pendente2','0',0),('99900000951331',NULL,'pendente2','0',0),('99900000951285',NULL,'pendente2','0',0),('99900000951250','091007763','pendente2','0',0),('99900000951129',NULL,'pendente2','0',0),('99900000951056','091008603','pendente2','0',0),('99900000951030',NULL,'pendente2','0',0),('99900000950971',NULL,'pendente2','0',0),('99900000950831',NULL,'pendente2','0',0),('99900000950750',NULL,'pendente2','0',0),('99900000950688',NULL,'pendente2','0',0),('99900000950459',NULL,'pendente2','0',0),('99900000950335','091148332','pendente2','0',0),('99900000949930',NULL,'pendente2','0',0),('99900000949922',NULL,'pendente2','0',0),('99900000949914',NULL,'pendente2','0',0),('99900000949825',NULL,'pendente2','0',0),('99900000949817',NULL,'pendente2','0',0),('99900000949710',NULL,'pendente2','0',0),('99900000949701',NULL,'pendente2','0',0),('99900000949620',NULL,'pendente2','0',0),('99900000948985',NULL,'pendente2','0',0),('99900000948950',NULL,'pendente2','0',0),('99900000948900',NULL,'pendente2','0',0),('99900000948829',NULL,'pendente2','0',0),('99900000948691',NULL,'pendente2','0',0),('99900000948675',NULL,'pendente2','0',0),('99900000948632',NULL,'pendente2','0',0),('99900000948616','091176140','reprovado2','0',0),('99900000948578',NULL,'pendente2','0',0),('99900000948560',NULL,'pendente2','0',0),('99900000948543',NULL,'pendente2','0',0),('99900000948438',NULL,'pendente2','0',0),('99900000948420',NULL,'pendente2','0',0),('99900000948411','091008077','pendente2','0',0),('99900000948403',NULL,'pendente2','0',0),('99900000948357',NULL,'pendente2','0',0),('99900000948306',NULL,'pendente2','0',0),('99900000948276','091209137','pendente2','0',0),('99900000948195',NULL,'pendente2','0',0),('99900000948160',NULL,'pendente2','0',0),('99900000948055',NULL,'pendente2','0',0),('99900000948047','090747569','pendente2','0',0),('99900000948020',NULL,'pendente2','0',0),('99900000948004','091095409','pendente2','0',0),('99900000947857','091229049','pendente2','0',0),('99900000947849','090745124','pendente2','0',0),('99900000947695',NULL,'pendente2','0',0),('99900000947440',NULL,'pendente2','0',0),('99900000947237',NULL,'pendente2','0',0),('99900000947229',NULL,'pendente2','0',0),('99900000947210',NULL,'pendente2','0',0),('99900000947091',NULL,'pendente2','0',0),('99900000947083','091216109','pendente2','0',0),('99900000947075',NULL,'pendente2','0',0),('99900000946923',NULL,'pendente2','0',0),('99900000946885',NULL,'pendente2','0',0),('99900000946699','091150485','pendente2','0',0),('99900000946680',NULL,'pendente2','0',0),('99900000946478',NULL,'reprovado2','0',0),('99900000946460',NULL,'pendente2','0',0),('99900000946443',NULL,'pendente2','0',0),('99900000946222',NULL,'pendente2','0',0),('99900000946192',NULL,'pendente2','0',0),('99900000946095','091150531','pendente2','0',0),('99900000946044','091151295','pendente2','0',0),('99900000945951',NULL,'pendente2','0',0),('99900000945897','091149231','pendente2','0',0),('99900000945757','091149193','pendente2','0',0),('99900000945625','090136390','pendente2','0',0),('99900000945420','091192404','pendente2','0',0),('99900000945188','091237351','pendente2','0',0),('99900000945161',NULL,'pendente2','0',0),('99900000945145',NULL,'pendente2','0',0),('99900000945056',NULL,'pendente2','0',0),('99900000945048',NULL,'pendente2','0',0),('99900000945030',NULL,'pendente2','0',0),('99900000945013',NULL,'pendente2','0',0),('99900000945005',NULL,'pendente2','0',0),('99900000944971',NULL,'pendente2','0',0),('99900000944947',NULL,'reprovado2','0',0),('99900000944874',NULL,'reprovado2','0',0),('99900000944823','090136578','pendente2','0',0),('99900000944785',NULL,'pendente2','0',0),('99900000944750',NULL,'pendente2','0',0),('99900000944742',NULL,'pendente2','0',0),('99900000944696',NULL,'reprovado2','0',0),('99900000944688',NULL,'pendente2','0',0),('99900000944580',NULL,'pendente2','0',0),('99900000944521',NULL,'pendente2','0',0),('99900000944491','091264855','pendente2','0',0),('99900000944483','090136276','pendente2','0',0),('99900000944360',NULL,'pendente2','0',0),('99900000944203',NULL,'pendente2','0',0),('99900000944041',NULL,'pendente2','0',0),('99900000944033',NULL,'pendente2','0',0),('99900000944025',NULL,'pendente2','0',0),('99900000943568',NULL,'pendente2','0',0),('99900000943339',NULL,'pendente2','0',0),('99900000943193',NULL,'pendente2','0',0),('99900000943185',NULL,'pendente2','0',0),('99900000943150',NULL,'pendente2','0',0),('99900000943142','091149215','pendente2','0',0),('99900000942782',NULL,'pendente2','0',0),('99900000942693',NULL,'pendente2','0',0),('99900000942286',NULL,'pendente2','0',0),('99900000942243',NULL,'pendente2','0',0),('99900000942235',NULL,'pendente2','0',0),('99900000942030','091148480','pendente2','0',0),('99900000941530',NULL,'pendente2','0',0),('99900000941182','091149410','pendente2','0',0),('99900000941166',NULL,'pendente2','0',0),('99900000941085',NULL,'pendente2','0',0),('99900000941026',NULL,'pendente2','0',0),('99900000941018',NULL,'pendente2','0',0),('99900000940909',NULL,'pendente2','0',0),('99900000940860',NULL,'pendente2','0',0),('99900000940801',NULL,'pendente2','0',0),('99900000940798',NULL,'pendente2','0',0),('99900000940771',NULL,'pendente2','0',0),('99900000940755',NULL,'reprovado2','0',0),('99900000940747',NULL,'pendente2','0',0),('99900000940550',NULL,'pendente2','0',0),('99900000940542',NULL,'pendente2','0',0),('99900000940518',NULL,'pendente2','0',0),('99900000940496','091192196','pendente2','0',0),('99900000940461',NULL,'pendente2','0',0),('99900000940364','091264812','reprovado2','0',0),('99900000940330','091150906','pendente2','0',0),('99900000940313','090900715','pendente2','0',0),('99900000940305','091149037','pendente2','0',0),('99900000940160',NULL,'pendente2','0',0),('99900000940151',NULL,'pendente2','0',0),('99900000940143',NULL,'pendente2','0',0),('99900000940127',NULL,'pendente2','0',0),('99900000940054','091148537','pendente2','0',0),('99900000940046',NULL,'pendente2','0',0),('99900000939919',NULL,'pendente2','0',0),('99900000939862','091192307','pendente2','0',0),('99900000939854',NULL,'pendente2','0',0),('99900000939510',NULL,'pendente2','0',0),('99900000939412','091119499','pendente2','0',0),('99900000939323',NULL,'pendente2','0',0),('99900000939285',NULL,'pendente2','0',0),('99900000939200',NULL,'reprovado2','0',0),('99900000939196','091194849','pendente2','0',0),('99900000939170',NULL,'pendente2','0',0),('99900000939161',NULL,'pendente2','0',0),('99900000939013',NULL,'pendente2','0',0),('99900000939005',NULL,'pendente2','0',0),('99900000938971',NULL,'pendente2','0',0),('99900000938777',NULL,'pendente2','0',0),('99900000938742',NULL,'pendente2','0',0),('99900000938661',NULL,'pendente2','0',0),('99900000938610',NULL,'pendente2','0',0),('99900000938602',NULL,'pendente2','0',0),('99900000938505',NULL,'pendente2','0',0),('99900000938491',NULL,'pendente2','0',0),('99900000938378',NULL,'pendente2','0',0),('99900000938351',NULL,'pendente2','0',0),('99900000938262',NULL,'pendente2','0',0),('99900000938254','090901045','pendente2','0',0),('99900000937525',NULL,'pendente2','0',0),('99900000937479',NULL,'pendente2','0',0),('99900000937380',NULL,'pendente2','0',0),('99900000937169',NULL,'pendente2','0',0),('99900000937150',NULL,'pendente2','0',0),('99900000937100',NULL,'pendente2','0',0),('99900000936928',NULL,'pendente2','0',0),('99900000936901','091119960','pendente2','0',0),('99900000936898',NULL,'pendente2','0',0),('99900000936782',NULL,'pendente2','0',0),('99900000936758',NULL,'pendente2','0',0),('99900000936731',NULL,'pendente2','0',0),('99900000936723',NULL,'pendente2','0',0),('99900000936707',NULL,'pendente2','0',0),('99900000936669','090135571','pendente2','0',0),('99900000936642',NULL,'reprovado2','0',0),('99900000936626',NULL,'pendente2','0',0),('99900000936596',NULL,'pendente2','0',0),('99900000936464',NULL,'pendente2','0',0),('99900000936340',NULL,'pendente2','0',0),('99900000936324',NULL,'pendente2','0',0),('99900000936286',NULL,'pendente2','0',0),('99900000936235','091239257','reprovado2','0',0),('99900000936162',NULL,'pendente2','0',0),('99900000936154',NULL,'pendente2','0',0),('99900000936146',NULL,'pendente2','0',0),('99900000936138',NULL,'pendente2','0',0),('99900000936120','090984927','pendente2','0',0),('99900000936030',NULL,'pendente2','0',0),('99900000936022',NULL,'pendente2','0',0),('99900000935956',NULL,'reprovado2','0',0),('99900000935948',NULL,'pendente2','0',0),('99900000935930','091238595','reprovado2','0',0),('99900000935867',NULL,'pendente2','0',0),('99900000935832',NULL,'pendente2','0',0),('99900000935824',NULL,'pendente2','0',0),('99900000935816','091008115','pendente2','0',0),('99900000934879',NULL,'pendente2','0',0),('99900000934860',NULL,'pendente2','0',0),('99900000934852',NULL,'pendente2','0',0),('99900000934836',NULL,'pendente2','0',0),('99900000934828',NULL,'pendente2','0',0),('99900000934798','091193524','pendente2','0',0),('99900000934780',NULL,'pendente2','0',0),('99900000934771',NULL,'pendente2','0',0),('99900000934631',NULL,'pendente2','0',0),('99900000934623',NULL,'reprovado2','0',0),('99900000934615','090984870','pendente2','0',0),('99900000934607',NULL,'reprovado2','0',0),('99900000934526',NULL,'pendente2','0',0),('99900000934518',NULL,'reprovado2','0',0),('99900000934356',NULL,'pendente2','0',0),('99900000934348','091199654','pendente2','0',0),('99900000933872','091177391','reprovado2','0',0),('99900000933767',NULL,'pendente2','0',0),('99900000933635',NULL,'pendente2','0',0),('99900000933503',NULL,'pendente2','0',0),('99900000933490',NULL,'reprovado2','0',0),('99900000933368',NULL,'pendente2','0',0),('99900000933139',NULL,'pendente2','0',0),('99900000933112',NULL,'pendente2','0',0),('99900000933104','090760930','pendente2','0',0),('99900000933007',NULL,'pendente2','0',0),('99900000932990',NULL,'pendente2','0',0),('99900000932981',NULL,'pendente2','0',0),('99900000932930','091150949','pendente2','0',0),('99900000932795',NULL,'pendente2','0',0),('99900000932752',NULL,'pendente2','0',0),('99900000932680',NULL,'pendente2','0',0),('99900000932671',NULL,'pendente2','0',0),('99900000932663',NULL,'pendente2','0',0),('99900000932647',NULL,'pendente2','0',0),('99900000932639',NULL,'pendente2','0',0),('99900000932590','091124310','pendente2','0',0),('99900000932531',NULL,'pendente2','0',0),('99900000932230',NULL,'reprovado2','0',0),('99900000932221','090136675','pendente2','0',0),('99900000932159',NULL,'pendente2','0',0),('99900000932140',NULL,'pendente2','0',0),('99900000932132',NULL,'pendente2','0',0),('99900000932124','090984340','pendente2','0',0),('99900000931748',NULL,'pendente2','0',0),('99900000931624',NULL,'pendente2','0',0),('99900000931241','090622405','pendente2','0',0),('99900000930911','091116082','pendente2','0',0),('99900000930903','090747313','pendente2','0',0),('99900000930636',NULL,'pendente2','0',0),('99900000930482',NULL,'pendente2','0',0),('99900000929875',NULL,'pendente2','0',0),('99900000929387','091216273','pendente2','0',0),('99900000929247',NULL,'pendente2','0',0),('99900000929174','090743806','pendente2','0',0),('99900000929131','091149452','pendente2','0',0),('99900000929077',NULL,'pendente2','0',0),('99900000928771','091177367','pendente2','0',0),('99900000928763',NULL,'pendente2','0',0),('99900000928674',NULL,'pendente2','0',0),('99900000928534',NULL,'reprovado2','0',0),('99900000928488','091098769','pendente2','0',0),('99900000928445',NULL,'pendente2','0',0),('99900000928437',NULL,'pendente2','0',0),('99900000928410',NULL,'pendente2','0',0),('99900000928356',NULL,'pendente2','0',0),('99900000928348',NULL,'pendente2','0',0),('99900000928313',NULL,'pendente2','0',0),('99900000928291',NULL,'pendente2','0',0),('99900000928283','090621506','pendente2','0',0),('99900000928275',NULL,'pendente2','0',0),('99900000928240',NULL,'pendente2','0',0),('99900000928216',NULL,'pendente2','0',0),('99900000928208',NULL,'pendente2','0',0),('99900000928194',NULL,'pendente2','0',0),('99900000928011',NULL,'pendente2','0',0),('99900000927970',NULL,'pendente2','0',0),('99900000927961','091192552','pendente2','0',0),('99900000927899',NULL,'pendente2','0',0),('99900000927872',NULL,'pendente2','0',0),('99900000927864',NULL,'pendente2','0',0),('99900000927783',NULL,'pendente2','0',0),('99900000927775',NULL,'pendente2','0',0),('99900000927767',NULL,'pendente2','0',0),('99900000927660','090984226','pendente2','0',0),('99900000927651',NULL,'pendente2','0',0),('99900000927643',NULL,'pendente2','0',0),('99900000927597',NULL,'pendente2','0',0),('99900000927309','090900693','pendente2','0',0),('99900000927295',NULL,'reprovado2','0',0),('99900000927252',NULL,'pendente2','0',0),('99900000927210',NULL,'pendente2','0',0),('99900000927163',NULL,'pendente2','0',0),('99900000927147','091150337','pendente2','0',0),('99900000927090',NULL,'pendente2','0',0),('99900000926957',NULL,'pendente2','0',0),('99900000926922','091177804','pendente2','0',0),('99900000926876',NULL,'pendente2','0',0),('99900000926825','091177251','pendente2','0',0),('99900000926809',NULL,'pendente2','0',0),('99900000926787',NULL,'pendente2','0',0),('99900000926760',NULL,'pendente2','0',0),('99900000926744',NULL,'pendente2','0',0),('99900000926701',NULL,'pendente2','0',0),('99900000925411',NULL,'pendente2','0',0),('99900000925373','091149258','pendente2','0',0),('99900000925349',NULL,'pendente2','0',0),('99900000925330',NULL,'pendente2','0',0),('99900000925314',NULL,'pendente2','0',0),('99900000925217',NULL,'pendente2','0',0),('99900000925209',NULL,'reprovado2','0',0),('99900000925187',NULL,'reprovado2','0',0),('99900000925179',NULL,'reprovado2','0',0),('99900000925160',NULL,'pendente2','0',0),('99900000925101',NULL,'pendente2','0',0),('99900000925098',NULL,'pendente2','0',0),('99900000925063',NULL,'pendente2','0',0),('99900000925047','091211433','pendente2','0',0),('99900000924970',NULL,'pendente2','0',0),('99900000924814',NULL,'pendente2','0',0),('99900000924792',NULL,'pendente2','0',0),('99900000924784','090984773','pendente2','0',0),('99900000924776',NULL,'pendente2','0',0),('99900000924741',NULL,'pendente2','0',0),('99900000924466',NULL,'pendente2','0',0),('99900000924270',NULL,'pendente2','0',0),('99900000924261',NULL,'pendente2','0',0),('99900000924253','090136470','pendente2','0',0),('99900000924245',NULL,'pendente2','0',0),('99900000924113',NULL,'pendente2','0',0),('99900000924040',NULL,'pendente2','0',0),('99900000924024',NULL,'pendente2','0',0),('99900000923613',NULL,'pendente2','0',0),('99900000923605',NULL,'pendente2','0',0),('99900000923346',NULL,'pendente2','0',0),('99900000923222',NULL,'pendente2','0',0),('99900000923052',NULL,'pendente2','0',0),('99900000923001',NULL,'pendente2','0',0),('99900000922927',NULL,'pendente2','0',0),('99900000922854',NULL,'pendente2','0',0),('99900000922773',NULL,'pendente2','0',0),('99900000922765',NULL,'pendente2','0',0),('99900000922730',NULL,'pendente2','0',0),('99900000922722',NULL,'pendente2','0',0),('99900000922633',NULL,'pendente2','0',0),('99900000922609',NULL,'pendente2','0',0),('99900000922307',NULL,'pendente2','0',0),('99900000922188','090876423','pendente2','0',0),('99900000922072',NULL,'pendente2','0',0),('99900000922048',NULL,'pendente2','0',0),('99900000921718',NULL,'pendente2','0',0),('99900000921661','090747364','pendente2','0',0),('99900000921645',NULL,'pendente2','0',0),('99900000921475','090063295','pendente2','0',0),('99900000921459',NULL,'pendente2','0',0),('99900000921351',NULL,'pendente2','0',0),('99900000921343','090899229','pendente2','0',0),('99900000921149','090984803','pendente2','0',0),('99900000920797',NULL,'pendente2','0',0),('99900000920789',NULL,'pendente2','0',0),('99900000920754','091095123','pendente2','0',0),('99900000920746','090135946','pendente2','0',0),('99900000920614','090900030','pendente2','0',0),('99900000920584','090983203','pendente2','0',0),('99900000920452','091174422','pendente2','0',0),('99900000920444',NULL,'pendente2','0',0),('99900000920428','091098327','pendente2','0',0),('99900000920290','091005310','pendente2','0',0),('99900000920126',NULL,'pendente2','0',0),('99900000920118',NULL,'pendente2','0',0),('99900000920010',NULL,'pendente2','0',0),('99900000919861',NULL,'pendente2','0',0),('99900000919624',NULL,'pendente2','0',0),('99900000919179',NULL,'pendente2','0',0),('99900000919080',NULL,'pendente2','0',0),('99900000919071',NULL,'pendente2','0',0),('99900000918920',NULL,'pendente2','0',0),('99900000918660',NULL,'pendente2','0',0),('99900000918601','090874790','pendente2','0',0),('99900000918520',NULL,'pendente2','0',0),('99900000918512',NULL,'pendente2','0',0),('99900000918482',NULL,'pendente2','0',0),('99900000918440',NULL,'pendente2','0',0),('99900000918423',NULL,'pendente2','0',0),('99900000918407',NULL,'pendente2','0',0),('99900000918393','090899253','pendente2','0',0),('99900000918385','091173388','pendente2','0',0),('99900000918369','090860403','pendente2','0',0),('99900000918350',NULL,'pendente2','0',0),('99900000918288',NULL,'pendente2','0',0),('99900000918270',NULL,'pendente2','0',0),('99900000918237','091099323','pendente2','0',0),('99900000918210',NULL,'pendente2','0',0),('99900000918083',NULL,'pendente2','0',0),('99900000918075','091177529','pendente2','0',0),('99900000918067',NULL,'pendente2','0',0),('99900000917800',NULL,'pendente2','0',0),('99900000917796',NULL,'pendente2','0',0),('99900000917770',NULL,'pendente2','0',0),('99900000917605','091174554','pendente2','0',0),('99900000917516',NULL,'pendente2','0',0),('99900000917397','090135415','pendente2','0',0),('99900000917176',NULL,'pendente2','0',0),('99900000916765','090899512','pendente2','0',0),('99900000916692',NULL,'pendente2','0',0),('99900000916595',NULL,'pendente2','0',0),('99900000916587',NULL,'pendente2','0',0),('99900000916382',NULL,'reprovado2','0',0),('99900000916064',NULL,'pendente2','0',0),('99900000915890',NULL,'pendente2','0',0),('99900000915653','091174627','pendente2','0',0),('99900000915459','091189870','pendente2','0',0),('99900000915432',NULL,'reprovado2','0',0),('99900000915424',NULL,'pendente2','0',0),('99900000914886',NULL,'pendente2','0',0),('99900000914720',NULL,'pendente2','0',0),('99900000914711',NULL,'pendente2','0',0),('99900000914690',NULL,'pendente2','0',0),('99900000914681',NULL,'pendente2','0',0),('99900000914665','091191300','pendente2','0',0),('99900000914657',NULL,'pendente2','0',0),('99900000914630',NULL,'pendente2','0',0),('99900000914622',NULL,'pendente2','0',0),('99900000914606',NULL,'pendente2','0',0),('99900000914592',NULL,'pendente2','0',0),('99900000914584',NULL,'pendente2','0',0),('99900000914541',NULL,'pendente2','0',0),('99900000914320',NULL,'pendente2','0',0),('99900000914312',NULL,'pendente2','0',0),('99900000914150',NULL,'pendente2','0',0),('99900000914142',NULL,'pendente2','0',0),('99900000914126',NULL,'pendente2','0',0),('99900000914053',NULL,'pendente2','0',0),('99900000914045','091123283','pendente2','0',0),('99900000914029',NULL,'pendente2','0',0),('99900000913839',NULL,'pendente2','0',0),('99900000913820',NULL,'pendente2','0',0),('99900000913812','091136229','pendente2','0',0),('99900000913715','091174449','pendente2','0',0),('99900000913634','091177324','pendente2','0',0),('99900000913367','091098424','pendente2','0',0),('99900000913170',NULL,'pendente2','0',0),('99900000913162',NULL,'pendente2','0',0),('99900000912891',NULL,'pendente2','0',0),('99900000912760','090877837','pendente2','0',0),('99900000912743',NULL,'pendente2','0',0),('99900000912522',NULL,'pendente2','0',0),('99900000912484',NULL,'reprovado2','0',0),('99900000912425',NULL,'pendente2','0',0),('99900000912247',NULL,'pendente2','0',0),('99900000912158',NULL,'pendente2','0',0),('99900000911992',NULL,'pendente2','0',0),('99900000911984',NULL,'pendente2','0',0),('99900000911933',NULL,'pendente2','0',0),('99900000911925',NULL,'pendente2','0',0),('99900000911917',NULL,'pendente2','0',0),('99900000911712',NULL,'pendente2','0',0),('99900000911615',NULL,'pendente2','0',0),('99900000911607','091175267','pendente2','0',0),('99900000911550',NULL,'pendente2','0',0),('99900000911500',NULL,'pendente2','0',0),('99900000911488',NULL,'pendente2','0',0),('99900000911291',NULL,'pendente2','0',0),('99900000911232',NULL,'pendente2','0',0),('99900000911224',NULL,'pendente2','0',0),('99900000911216',NULL,'pendente2','0',0),('99900000911100','090982568','pendente2','0',0),('99900000911089',NULL,'pendente2','0',0),('99900000911070',NULL,'pendente2','0',0),('99900000910589',NULL,'pendente2','0',0),('99900000910414','090743776','pendente2','0',0),('99900000910384',NULL,'pendente2','0',0),('99900000909955',NULL,'pendente2','0',0),('99900000909815',NULL,'pendente2','0',0),('99900000909807',NULL,'pendente2','0',0),('99900000909793',NULL,'pendente2','0',0),('99900000909785',NULL,'pendente2','0',0),('99900000909564',NULL,'pendente2','0',0),('99900000909394',NULL,'pendente2','0',0),('99900000909335','090742389','pendente2','0',0),('99900000909297',NULL,'pendente2','0',0),('99900000909246','091005671','pendente2','0',0),('99900000909220',NULL,'pendente2','0',0),('99900000909203',NULL,'pendente2','0',0),('99900000908770',NULL,'pendente2','0',0),('99900000908762',NULL,'pendente2','0',0),('99900000908509',NULL,'pendente2','0',0),('99900000908495',NULL,'reprovado2','0',0),('99900000908339',NULL,'pendente2','0',0),('99900000908304',NULL,'pendente2','0',0),('99900000908088',NULL,'pendente2','0',0),('99900000908070','091214530','pendente2','0',0),('99900000908061',NULL,'pendente2','0',0),('99900000908037',NULL,'pendente2','0',0),('99900000908029','090860071','pendente2','0',0),('99900000907928',NULL,'pendente2','0',0),('99900000907863',NULL,'pendente2','0',0),('99900000907855','091064163','pendente2','0',0),('99900000907847',NULL,'pendente2','0',0),('99900000907812','091192846','pendente2','0',0),('99900000907782',NULL,'pendente2','0',0),('99900000907774',NULL,'pendente2','0',0),('99900000907740',NULL,'pendente2','0',0),('99900000907715','091175291','pendente2','0',0),('99900000907650',NULL,'pendente2','0',0),('99900000907642',NULL,'pendente2','0',0),('99900000907634',NULL,'pendente2','0',0),('99900000907626',NULL,'pendente2','0',0),('99900000907570',NULL,'reprovado2','0',0),('99900000907537','090897366','pendente2','0',0),('99900000907243',NULL,'pendente2','0',0),('99900000907154',NULL,'pendente2','0',0),('99900000907120',NULL,'pendente2','0',0),('99900000907111',NULL,'pendente2','0',0),('99900000906948','091119472','pendente2','0',0),('99900000906930','090982851','pendente2','0',0),('99900000906913','090617070','pendente2','0',0),('99900000906905','091193753','pendente2','0',0),('99900000906654',NULL,'pendente2','0',0),('99900000906646',NULL,'pendente2','0',0),('99900000906450','091175070','pendente2','0',0),('99900000906336',NULL,'pendente2','0',0),('99900000906328','091234271','pendente2','0',0),('99900000906140',NULL,'pendente2','0',0),('99900000906131','091005655','pendente2','0',0),('99900000906123','091116341','pendente2','0',0),('99900000905801',NULL,'pendente2','0',0),('99900000905798',NULL,'pendente2','0',0),('99900000905720',NULL,'pendente2','0',0),('99900000905526',NULL,'pendente2','0',0),('99900000905496','091096600','pendente2','0',0),('99900000905488','091099307','pendente2','0',0),('99900000904953','091180090','pendente2','0',0),('99900000904813','091041260','pendente2','0',0),('99900000904678','090618289','reprovado2','0',0),('99900000904570',NULL,'pendente2','0',0),('99900000904538',NULL,'pendente2','0',0),('99900000904449',NULL,'pendente2','0',0),('99900000904414','090135547','pendente2','0',0),('99900000904287','091174198','pendente2','0',0),('99900000904279',NULL,'pendente2','0',0),('99900000904244',NULL,'pendente2','0',0),('99900000904228',NULL,'pendente2','0',0),('99900000904180',NULL,'pendente2','0',0),('99900000904163',NULL,'pendente2','0',0),('99900000904147',NULL,'pendente2','0',0),('99900000904112','090981804','pendente2','0',0),('99900000904104','090618173','pendente2','0',0),('99900000904090',NULL,'pendente2','0',0),('99900000904082',NULL,'pendente2','0',0),('99900000904074',NULL,'reprovado2','0',0),('99900000904058',NULL,'pendente2','0',0),('99900000903914',NULL,'pendente2','0',0),('99900000903906','090618300','pendente2','0',0),('99900000903850','091063221','pendente2','0',0),('99900000903710',NULL,'pendente2','0',0),('99900000903566',NULL,'pendente2','0',0),('99900000903493','090958446','pendente2','0',0),('99900000903272','090997450','pendente2','0',0),('99900000903264',NULL,'pendente2','0',0),('99900000903248',NULL,'pendente2','0',0),('99900000903116','091119413','pendente2','0',0),('99900000902209',NULL,'pendente2','0',0),('99900000902187',NULL,'pendente2','0',0),('99900000901962',NULL,'pendente2','0',0),('99900000901393','090999223','pendente2','0',0),('99900000901288',NULL,'pendente2','0',0),('99900000901180',NULL,'pendente2','0',0),('99900000901008',NULL,'pendente2','0',0),('99900000900958',NULL,'pendente2','0',0),('99900000900940','091099056','pendente2','0',0),('99900000900931','091174066','pendente2','0',0),('99900000900877','090062973','pendente2','0',0),('99900000900842',NULL,'pendente2','0',0),('99900000900834',NULL,'pendente2','0',0),('99900000900818',NULL,'pendente2','0',0),('99900000900788',NULL,'pendente2','0',0),('99900000900737','091175038','pendente2','0',0),('99900000900729',NULL,'pendente2','0',0),('99900000900680',NULL,'pendente2','0',0),('99900000900664','090063252','pendente2','0',0),('99900000900591',NULL,'pendente2','0',0),('99900000900583',NULL,'pendente2','0',0),('99900000900478','091165539','pendente2','0',0),('99900000900451','091116848','pendente2','0',0),('99900000900419',NULL,'pendente2','0',0),('99900000900362',NULL,'pendente2','0',0),('99900000900354',NULL,'pendente2','0',0),('99900000900346','091172292','pendente2','0',0),('99900000900257','091006422','pendente2','0',0),('99900000900214',NULL,'pendente2','0',0),('99900000899933','090616545','pendente2','0',0),('99900000899844',NULL,'pendente2','0',0),('99900000899810','090617240','pendente2','0',0),('99900000899631','090997115','pendente2','0',0),('99900000899615','090937074','pendente2','0',0),('99900000899372',NULL,'pendente2','0',0),('99900000899348','090875656','pendente2','0',0),('99900000899097',NULL,'pendente2','0',0),('99900000899089',NULL,'pendente2','0',0),('99900000899062','091210593','pendente2','0',0),('99900000898953',NULL,'pendente2','0',0),('99900000898562',NULL,'pendente2','0',0),('99900000898406',NULL,'pendente2','0',0),('99900000898279','091041562','pendente2','0',0),('99900000898147','090999266','pendente2','0',0),('99900000897809',NULL,'pendente2','0',0),('99900000897795','091004276','pendente2','0',0),('99900000897604',NULL,'pendente2','0',0),('99900000897540','090887506','pendente2','0',0),('99900000897418','090937120','pendente2','0',0),('99900000897400','090617312','pendente2','0',0),('99900000897086','090859740','pendente2','0',0),('99900000897043',NULL,'pendente2','0',0),('99900000896918',NULL,'pendente2','0',0),('99900000896870','090823834','pendente2','0',0),('99900000896853',NULL,'pendente2','0',0),('99900000896667','091192790','pendente2','0',0),('99900000896659',NULL,'pendente2','0',0),('99900000896632',NULL,'pendente2','0',0),('99900000896624',NULL,'pendente2','0',0),('99900000896616','090984366','pendente2','0',0),('99900000896608',NULL,'pendente2','0',0),('99900000896586','090885643','pendente2','0',0),('99900000896560','090799542','pendente2','0',0),('99900000896543','091096383','pendente2','0',0),('99900000896535','090897536','pendente2','0',0),('99900000896403','091148510','pendente2','0',0),('99900000896365','091063485','pendente2','0',0),('99900000896349',NULL,'pendente2','0',0),('99900000896225','091059399','pendente2','0',0),('99900000896179','090982681','pendente2','0',0),('99900000896055','091064139','pendente2','0',0),('99900000896004',NULL,'pendente2','0',0),('99900000895997','090898672','pendente2','0',0),('99900000895989','090135245','pendente2','0',0),('99900000895920','091148286','pendente2','0',0),('99900000895911','091123356','pendente2','0',0),('99900000895890','090875168','pendente2','0',0),('99900000895709','091095875','pendente2','0',0),('99900000895652','090135350','pendente2','0',0),('99900000895644',NULL,'pendente2','0',0),('99900000895490','090871030','pendente2','0',0),('99900000895369',NULL,'pendente2','0',0),('99900000894478',NULL,'pendente2','0',0),('99900000894460',NULL,'pendente2','0',0),('99900000894451',NULL,'pendente2','0',0),('99900000894427','091176123','pendente2','0',0),('99900000893773','090900537','pendente2','0',0),('99900000893714',NULL,'pendente2','0',0),('99900000893641',NULL,'pendente2','0',0),('99900000893633',NULL,'pendente2','0',0),('99900000893625',NULL,'pendente2','0',0),('99900000893595','090616774','pendente2','0',0),('99900000893587','091238064','pendente2','0',0),('99900000893510','090615450','pendente2','0',0),('99900000893501',NULL,'pendente2','0',0),('99900000893455','091041848','pendente2','0',0),('99900000893315','090958691','pendente2','0',0),('99900000893307',NULL,'pendente2','0',0),('99900000893293',NULL,'pendente2','0',0),('99900000893285',NULL,'pendente2','0',0),('99900000893226','090135393','pendente2','0',0),('99900000893129',NULL,'pendente2','0',0),('99900000893072',NULL,'pendente2','0',0),('99900000893064',NULL,'pendente2','0',0),('99900000893056',NULL,'pendente2','0',0),('99900000892858','090135300','pendente2','0',0),('99900000892831',NULL,'pendente2','0',0),('99900000892823',NULL,'pendente2','0',0),('99900000892742',NULL,'pendente2','0',0),('99900000892530','090852320','pendente2','0',0),('99900000892300',NULL,'pendente2','0',0),('99900000892297',NULL,'pendente2','0',0),('99900000892041','090135504','pendente2','0',0),('99900000892033','090885600','pendente2','0',0),('99900000892025',NULL,'pendente2','0',0),('99900000891924',NULL,'reprovado2','0',0),('99900000891916','091099358','pendente2','0',0),('99900000891657',NULL,'pendente2','0',0),('99900000891649',NULL,'pendente2','0',0),('99900000891452',NULL,'pendente2','0',0),('99900000891355',NULL,'pendente2','0',0),('99900000891223','090897730','pendente2','0',0),('99900000891150',NULL,'pendente2','0',0),('99900000891142','091208823','pendente2','0',0),('99900000891061',NULL,'pendente2','0',0),('99900000890499',NULL,'pendente2','0',0),('99900000890480',NULL,'pendente2','0',0),('99900000890472',NULL,'pendente2','0',0),('99900000890316','090957156','pendente2','0',0),('99900000889920','090746201','pendente2','0',0),('99900000889903',NULL,'pendente2','0',0),('99900000889814',NULL,'pendente2','0',0),('99900000889806',NULL,'reprovado2','0',0),('99900000889792',NULL,'pendente2','0',0),('99900000889776','090982169','pendente2','0',0),('99900000889350','091178584','pendente2','0',0),('99900000889342',NULL,'pendente2','0',0),('99900000889296','090829441','pendente2','0',0),('99900000889202',NULL,'pendente2','0',0),('99900000889199','090982142','pendente2','0',0),('99900000889091','090617479','pendente2','0',0),('99900000889075','091166616','pendente2','0',0),('99900000889059','091175690','pendente2','0',0),('99900000888966','090829794','reprovado2','0',0),('99900000888958','091775566','pendente2','0',0),('99900000888850','090620992','pendente2','0',0),('99900000888842',NULL,'pendente2','0',0),('99900000888834',NULL,'pendente2','0',0),('99900000888796',NULL,'pendente2','0',0),('99900000888770',NULL,'pendente2','0',0),('99900000888583',NULL,'pendente2','0',0),('99900000888540','090135229','pendente2','0',0),('99900000888389','090935276','pendente2','0',0),('99900000888087','090994361','pendente2','0',0),('99900000888052',NULL,'pendente2','0',0),('99900000887650',NULL,'pendente2','0',0),('99900000887641',NULL,'pendente2','0',0),('99900000887625',NULL,'pendente2','0',0),('99900000887439',NULL,'pendente2','0',0),('99900000887358','090799240','pendente2','0',0),('99900000887307',NULL,'pendente2','0',0),('99900000887110','090898036','pendente2','0',0),('99900000886750','091095948','pendente2','0',0),('99900000886491',NULL,'pendente2','0',0),('99900000886483',NULL,'pendente2','0',0),('99900000886475',NULL,'pendente2','0',0),('99900000886467',NULL,'pendente2','0',0),('99900000886300','090995066','pendente2','0',0),('99900000886130',NULL,'pendente2','0',0),('99900000886009',NULL,'pendente2','0',0),('99900000885991',NULL,'pendente2','0',0),('99900000885983',NULL,'pendente2','0',0),('99900000885940','091101832','pendente2','0',0),('99900000885819','090981332','pendente2','0',0),('99900000885800','091111692','pendente2','0',0),('99900000885762',NULL,'pendente2','0',0),('99900000885754','090978773','pendente2','0',0),('99900000885738',NULL,'pendente2','0',0),('99900000885703','090996879','pendente2','0',0),('99900000885690',NULL,'pendente2','0',0),('99900000885681',NULL,'pendente2','0',0),('99900000885630','090827937','pendente2','0',0),('99900000885606',NULL,'pendente2','0',0),('99900000885592','090617002','pendente2','0',0),('99900000885584',NULL,'pendente2','0',0),('99900000885568','090745990','pendente2','0',0),('99900000885517','090982274','pendente2','0',0),('99900000885479','090997778','pendente2','0',0),('99900000885428','090062647','pendente2','0',0),('99900000885410','091058813','pendente2','0',0),('99900000885070',NULL,'pendente2','0',0),('99900000884960',NULL,'pendente2','0',0),('99900000884928','090243110','pendente2','0',0),('99900000884910',NULL,'pendente2','0',0),('99900000884901','091042372','pendente2','0',0),('99900000884650',NULL,'pendente2','0',0),('99900000884642',NULL,'pendente2','0',0),('99900000884634',NULL,'pendente2','0',0),('99900000884626',NULL,'pendente2','0',0),('99900000884219',NULL,'pendente2','0',0),('99900000883930',NULL,'pendente2','0',0),('99900000883280','090897170','reprovado2','0',0),('99900000883131',NULL,'pendente2','0',0),('99900000882666',NULL,'pendente2','0',0),('99900000882542',NULL,'pendente2','0',0),('99900000882313','090827910','pendente2','0',0),('99900000882305',NULL,'pendente2','0',0),('99900000882151','091337348','pendente2','0',0),('99900000882143','090828461','pendente2','0',0),('99900000882054','091041511','pendente2','0',0),('99900000882020','090984900','pendente2','0',0),('99900000881953','090994345','pendente2','0',0),('99900000881929',NULL,'pendente2','0',0),('99900000881910','090982339','pendente2','0',0),('99900000881066',NULL,'reprovado2','0',0),('99900000881058',NULL,'pendente2','0',0),('99900000881040',NULL,'pendente2','0',0),('99900000881023','090979842','pendente2','0',0),('99900000880990','090994647','pendente2','0',0),('99900000880981','090135202','pendente2','0',0),('99900000880973',NULL,'reprovado2','0',0),('99900000880957',NULL,'pendente2','0',0),('99900000880949',NULL,'reprovado2','0',0),('99900000880922',NULL,'pendente2','0',0),('99900000880906',NULL,'pendente2','0',0),('99900000880892',NULL,'pendente2','0',0),('99900000880884',NULL,'pendente2','0',0),('99900000880841','090505620','pendente2','0',0),('99900000880833',NULL,'pendente2','0',0),('99900000880825','091191696','pendente2','0',0),('99900000880809',NULL,'pendente2','0',0),('99900000880795',NULL,'pendente2','0',0),('99900000880787',NULL,'pendente2','0',0),('99900000880779','090875605','pendente2','0',0),('99900000880760',NULL,'pendente2','0',0),('99900000880744',NULL,'pendente2','0',0),('99900000880736','091095816','pendente2','0',0),('99900000880710','091064198','pendente2','0',0),('99900000880698',NULL,'pendente2','0',0),('99900000880680','090998898','pendente2','0',0),('99900000880671',NULL,'pendente2','0',0),('99900000880655',NULL,'pendente2','0',0),('99900000880620','091113075','pendente2','0',0),('99900000880590',NULL,'pendente2','0',0),('99900000880582',NULL,'pendente2','0',0),('99900000880353','091101530','pendente2','0',0),('99900000880345','090933842','pendente2','0',0),('99900000880337','091096146','pendente2','0',0),('99900000880230','090875346','pendente2','0',0),('99900000880191','090744640','pendente2','0',0),('99900000880108',NULL,'pendente2','0',0),('99900000880019',NULL,'pendente2','0',0),('99900000880000',NULL,'pendente2','0',0),('99900000879967','090760980','pendente2','0',0),('99900000879940',NULL,'pendente2','0',0),('99900000879924',NULL,'pendente2','0',0),('99900000879622','090741714','pendente2','0',0),('99900000879410',NULL,'pendente2','0',0),('99900000879401',NULL,'pendente2','0',0),('99900000879347',NULL,'pendente2','0',0),('99900000879266','090135172','pendente2','0',0),('99900000879258','090443713','pendente2','0',0),('99900000879134','091191815','pendente2','0',0),('99900000879126','091041155','pendente2','0',0),('99900000879118',NULL,'pendente2','0',0),('99900000879070',NULL,'pendente2','0',0),('99900000879053','090875389','pendente2','0',0),('99900000879010','091117623','pendente2','0',0),('99900000878995','090898842','reprovado2','0',0),('99900000878987',NULL,'pendente2','0',0),('99900000878960','090760654','reprovado2','0',0),('99900000878901',NULL,'pendente2','0',0),('99900000878871',NULL,'pendente2','0',0),('99900000878863',NULL,'pendente2','0',0),('99900000878855',NULL,'pendente2','0',0),('99900000878839','091005230','pendente2','0',0),('99900000878804','090744071','pendente2','0',0),('99900000878731',NULL,'reprovado2','0',0),('99900000878723',NULL,'pendente2','0',0),('99900000878715','090871235','pendente2','0',0),('99900000878707',NULL,'pendente2','0',0),('99900000878693','090984048','pendente2','0',0),('99900000878626',NULL,'pendente2','0',0),('99900000878618','090444108','pendente2','0',0),('99900000878529',NULL,'pendente2','0',0),('99900000878430','090994299','pendente2','0',0),('99900000878413',NULL,'pendente2','0',0),('99900000878391',NULL,'pendente2','0',0),('99900000878286',NULL,'pendente2','0',0),('99900000878049','090135261','pendente2','0',0),('99900000878030','090117484','pendente2','0',0),('99900000878014','090886623','pendente2','0',0),('99900000878006','090243579','pendente2','0',0),('99900000877786',NULL,'pendente2','0',0),('99900000877778',NULL,'pendente2','0',0),('99900000877590',NULL,'pendente2','0',0),('99900000877573',NULL,'pendente2','0',0),('99900000877549','090224752','pendente2','0',0),('99900000877301',NULL,'pendente2','0',0),('99900000877093','090797396','pendente2','0',0),('99900000877077','090885228','pendente2','0',0),('99900000877069',NULL,'pendente2','0',0),('99900000877000','090878710','pendente2','0',0),('99900000876658',NULL,'reprovado2','0',0),('99900000876461',NULL,'pendente2','0',0),('99900000876399','090875400','pendente2','0',0),('99900000876038',NULL,'pendente2','0',0),('99900000875902',NULL,'pendente2','0',0),('99900000875872',NULL,'pendente2','0',0),('99900000875864',NULL,'pendente2','0',0),('99900000875856','090743156','pendente2','0',0),('99900000875724',NULL,'pendente2','0',0),('99900000875716',NULL,'pendente2','0',0),('99900000875708',NULL,'pendente2','0',0),('99900000875546','090617061','pendente2','0',0),('99900000875457',NULL,'pendente2','0',0),('99900000875384',NULL,'pendente2','0',0),('99900000875376',NULL,'pendente2','0',0),('99900000875163',NULL,'pendente2','0',0),('99900000875104',NULL,'pendente2','0',0),('99900000875090',NULL,'pendente2','0',0),('99900000875082','090893255','pendente2','0',0),('99900000874949',NULL,'pendente2','0',0),('99900000874930','090875222','pendente2','0',0),('99900000874922',NULL,'reprovado2','0',0),('99900000874906',NULL,'pendente2','0',0),('99900000874884',NULL,'pendente2','0',0),('99900000874825',NULL,'pendente2','0',0),('99900000874817','090878582','pendente2','0',0),('99900000874809',NULL,'pendente2','0',0),('99900000874795','090134753','pendente2','0',0),('99900000874787','091060281','pendente2','0',0),('99900000874760',NULL,'pendente2','0',0),('99900000874698',NULL,'pendente2','0',0),('99900000874680',NULL,'pendente2','0',0),('99900000874663',NULL,'reprovado2','0',0),('99900000874655','090189310','pendente2','0',0),('99900000874639','091111587','pendente2','0',0),('99900000874620','090860055','pendente2','0',0),('99900000874566','090800133','pendente2','0',0),('99900000874361',NULL,'pendente2','0',0),('99900000874353',NULL,'pendente2','0',0),('99900000874345',NULL,'pendente2','0',0),('99900000874337','091064538','pendente2','0',0),('99900000874329','090878310','pendente2','0',0),('99900000874310',NULL,'reprovado2','0',0),('99900000874299',NULL,'pendente2','0',0),('99900000874280','090852613','pendente2','0',0),('99900000874272','090878337','pendente2','0',0),('99900000874094','090979893','pendente2','0',0),('99900000874027',NULL,'pendente2','0',0),('99900000873926',NULL,'pendente2','0',0),('99900000873799',NULL,'pendente2','0',0),('99900000873322',NULL,'pendente2','0',0),('99900000873217','090851862','pendente2','0',0),('99900000873063','091060206','pendente2','0',0),('99900000873047','090824580','pendente2','0',0),('99900000872890','090984196','pendente2','0',0),('99900000872741',NULL,'pendente2','0',0),('99900000872733','090875079','pendente2','0',0),('99900000872636','091042216','pendente2','0',0),('99900000871591','090957458','pendente2','0',0),('99900000871443','090829492','pendente2','0',0),('99900000871370',NULL,'reprovado2','0',0),('99900000871249',NULL,'pendente2','0',0),('99900000871214',NULL,'pendente2','0',0),('99900000871192',NULL,'pendente2','0',0),('99900000871184','090893760','pendente2','0',0),('99900000871176','090852109','pendente2','0',0),('99900000871109','090874870','pendente2','0',0),('99900000871060','090615719','pendente2','0',0),('99900000871044','090765770','pendente2','0',0),('99900000871001','090798511','pendente2','0',0),('99900000870978','091058015','pendente2','0',0),('99900000870889','090616790','pendente2','0',0),('99900000870846','090877756','pendente2','0',0),('99900000870706',NULL,'pendente2','0',0),('99900000870684','090243293','pendente2','0',0),('99900000870595','090982886','pendente2','0',0),('99900000870579','090939824','pendente2','0',0),('99900000870536',NULL,'pendente2','0',0),('99900000870390',NULL,'pendente2','0',0),('99900000870072',NULL,'pendente2','0',0),('99900000870064',NULL,'pendente2','0',0),('99900000869384','090799470','pendente2','0',0),('99900000869325','090445945','pendente2','0',0),('99900000869317','090826124','pendente2','0',0),('99900000869287','090905750','pendente2','0',0),('99900000869015',NULL,'pendente2','0',0),('99900000869007',NULL,'pendente2','0',0),('99900000868884',NULL,'pendente2','0',0),('99900000868876',NULL,'pendente2','0',0),('99900000868809',NULL,'pendente2','0',0),('99900000868558',NULL,'pendente2','0',0),('99900000868540','090764404','pendente2','0',0),('99900000868507',NULL,'pendente2','0',0),('99900000868469',NULL,'pendente2','0',0),('99900000868221','090715187','pendente2','0',0),('99900000868213',NULL,'pendente2','0',0),('99900000868051','090851978','pendente2','0',0),('99900000867950','090800176','pendente2','0',0),('99900000867942','091120012','pendente2','0',0),('99900000867934','090957652','pendente2','0',0),('99900000867730',NULL,'pendente2','0',0),('99900000867721','090886887','pendente2','0',0),('99900000867713','091041040','pendente2','0',0),('99900000867624',NULL,'pendente2','0',0),('99900000867608',NULL,'pendente2','0',0),('99900000867594',NULL,'pendente2','0',0),('99900000867586','090799232','pendente2','0',0),('99900000867551',NULL,'pendente2','0',0),('99900000867535',NULL,'pendente2','0',0),('99900000867527','090738705','pendente2','0',0),('99900000867519',NULL,'pendente2','0',0),('99900000867500','090829204','pendente2','0',0),('99900000867454','090899172','pendente2','0',0),('99900000867446',NULL,'pendente2','0',0),('99900000867365',NULL,'pendente2','0',0),('99900000867306','090828054','pendente2','0',0),('99900000867233','091041236','pendente2','0',0),('99900000867225',NULL,'pendente2','0',0),('99900000867144','090243390','pendente2','0',0),('99900000867128',NULL,'pendente2','0',0),('99900000867101',NULL,'pendente2','0',0),('99900000866962','090738667','pendente2','0',0),('99900000866660',NULL,'pendente2','0',0),('99900000866610',NULL,'pendente2','0',0),('99900000866571','090743407','pendente2','0',0),('99900000866300','090852818','pendente2','0',0),('99900000866261',NULL,'pendente2','0',0),('99900000866253',NULL,'pendente2','0',0),('99900000866245',NULL,'pendente2','0',0),('99900000866105',NULL,'pendente2','0',0),('99900000865885','090243315','pendente2','0',0),('99900000865877','090794346','pendente2','0',0),('99900000865850','090982037','pendente2','0',0),('99900000865834',NULL,'reprovado2','0',0),('99900000865826','090616847','pendente2','0',0),('99900000865532','091191912','pendente2','0',0),('99900000865524','091063531','pendente2','0',0),('99900000865516',NULL,'pendente2','0',0),('99900000865346',NULL,'pendente2','0',0),('99900000865338',NULL,'pendente2','0',0),('99900000864986','090615565','pendente2','0',0),('99900000864978','090524527','pendente2','0',0),('99900000864960',NULL,'pendente2','0',0),('99900000864455',NULL,'pendente2','0',0),('99900000864161',NULL,'pendente2','0',0),('99900000864153','090738314','pendente2','0',0),('99900000864099',NULL,'pendente2','0',0),('99900000863971','090136144','pendente2','0',0),('99900000863963',NULL,'pendente2','0',0),('99900000863947','090957466','pendente2','0',0),('99900000863777',NULL,'pendente2','0',0),('99900000863718','090798937','pendente2','0',0),('99900000863670',NULL,'pendente2','0',0),('99900000863548',NULL,'pendente2','0',0),('99900000863360','090738330','pendente2','0',0),('99900000863351','090799283','pendente2','0',0),('99900000863297','090886240','pendente2','0',0),('99900000863289','090994159','pendente2','0',0),('99900000863246','090874587','pendente2','0',0),('99900000863203','090981626','pendente2','0',0),('99900000863173','090739051','pendente2','0',0),('99900000863165','091192897','pendente2','0',0),('99900000863157',NULL,'pendente2','0',0),('99900000863130','090133544','pendente2','0',0),('99900000863033',NULL,'pendente2','0',0),('99900000863009','090777077','pendente2','0',0),('99900000862908',NULL,'pendente2','0',0),('99900000862860','090795342','pendente2','0',0),('99900000862835','091064350','pendente2','0',0),('99900000862800','090885503','pendente2','0',0),('99900000862797','090800206','pendente2','0',0),('99900000862720','090892410','pendente2','0',0),('99900000862614','090243374','pendente2','0',0),('99900000862460','090570707','pendente2','0',0),('99900000862452',NULL,'pendente2','0',0),('99900000862444','090795989','pendente2','0',0),('99900000862410',NULL,'pendente2','0',0),('99900000862290','090851757','pendente2','0',0),('99900000861740',NULL,'pendente2','0',0),('99900000861618','090118359','pendente2','0',0),('99900000861430','090851587','pendente2','0',0),('99900000861421',NULL,'pendente2','0',0),('99900000861340','090744659','pendente2','0',0),('99900000861332',NULL,'pendente2','0',0),('99900000861294',NULL,'pendente2','0',0),('99900000861286','090765370','pendente2','0',0),('99900000861278',NULL,'pendente2','0',0),('99900000861260',NULL,'pendente2','0',0),('99900000861251',NULL,'pendente2','0',0),('99900000861235',NULL,'pendente2','0',0),('99900000861014','090876512','pendente2','0',0),('99900000861006','091041589','pendente2','0',0),('99900000860948','091095140','pendente2','0',0),('99900000860921','090876474','reprovado2','0',0),('99900000860883',NULL,'pendente2','0',0),('99900000860867',NULL,'pendente2','0',0),('99900000860859','090872274','pendente2','0',0),('99900000860816',NULL,'pendente2','0',0),('99900000860760',NULL,'pendente2','0',0),('99900000860751','090851838','pendente2','0',0),('99900000860719',NULL,'pendente2','0',0),('99900000860700','091118530','pendente2','0',0),('99900000860603','090688953','pendente2','0',0),('99900000860590',NULL,'pendente2','0',0),('99900000860530',NULL,'pendente2','0',0),('99900000860450',NULL,'pendente2','0',0),('99900000860441','090446305','pendente2','0',0),('99900000860425',NULL,'pendente2','0',0),('99900000860417',NULL,'pendente2','0',0),('99900000860360','090871375','pendente2','0',0),('99900000860328',NULL,'pendente2','0',0),('99900000860247','090798775','pendente2','0',0),('99900000860239',NULL,'pendente2','0',0),('99900000860220',NULL,'pendente2','0',0),('99900000860204','090799399','pendente2','0',0),('99900000859915','090614615','pendente2','0',0),('99900000859761','090614208','pendente2','0',0),('99900000855782','090117468','pendente2','0',0),('99900000852961',NULL,'pendente2','0',0),('99900000850845',NULL,'pendente2','0',0),('99900000850330',NULL,'pendente2','0',0),('99900000847097','090615476','pendente2','0',0),('99900000847046','090613295','pendente2','0',0),('99900000846392',NULL,'reprovado2','0',0),('99900000845590',NULL,'pendente2','0',0),('99900000844055','090615204','pendente2','0',0),('99900000841064','090616715','reprovado2','0',0),('99900000841056','090613333','pendente2','0',0),('99900000840904','090617380','pendente2','0',0),('99900000838349',NULL,'reprovado2','0',0),('99900000836400','090612418','pendente2','0',0),('99900000835331',NULL,'pendente2','0',0),('99900000834467','090613546','pendente2','0',0),('99900000832600',NULL,'pendente2','0',0),('99900000831190',NULL,'pendente2','0',0),('99900000830917','090612965','pendente2','0',0),('99900000827908','090613023','reprovado2','0',0),('99900000827690','090613694','pendente2','0',0),('99900000827479',NULL,'reprovado2','0',0),('99900000827215','090614046','reprovado2','0',0),('99900000819719','090612280','pendente2','0',0),('99900000817511',NULL,'pendente2','0',0),('99900000817082','090611799','pendente2','0',0),('99900000816604','090612264','reprovado2','0',0),('99900000810525','090610890','pendente2','0',0),('99900000809136','090610768','pendente2','0',0),('99900000807010','090610571','pendente2','0',0),('99900000806366','090611403','pendente2','0',0),('99900000804290','090612531','pendente2','0',0),('99900000803995',NULL,'pendente2','0',0),('99900000803928',NULL,'pendente2','0',0),('99900000802786',NULL,'reprovado2','0',0),('99900000802450','090610857','pendente2','0',0),('99900000802271','090615000','pendente2','0',0),('99900000801364','090609220','pendente2','0',0),('99900000799530',NULL,'pendente2','0',0),('99900000798860','090609913','pendente2','0',0),('99900000798320','090613090','pendente2','0',0),('99900000798088',NULL,'pendente2','0',0),('99900000797588','090609360','pendente2','0',0),('99900000796913',NULL,'pendente2','0',0),('99900000791768',NULL,'pendente2','0',0),('99900000791059','090616863','pendente2','0',0),('99900000790303','090609794','pendente2','0',0),('99900000786667','090608895','pendente2','0',0),('99900000786144','090616987','pendente2','0',0),('99900000785571','090386116','reprovado2','0',0),('99900000784567','090608844','pendente2','0',0),('99900000783889',NULL,'pendente2','0',0),('99900000783722','090608810','pendente2','0',0),('99900000783536',NULL,'pendente2','0',0),('99900000783501','090385837','pendente2','0',0),('99900000780871','090385110','pendente2','0',0),('99900000780758','090609050','reprovado2','0',0),('99900000780650','090385926','pendente2','0',0),('99900000780545',NULL,'pendente2','0',0),('99900000780529','090612310','pendente2','0',0),('99900000780499',NULL,'pendente2','0',0),('99900000780146','090608950','pendente2','0',0),('99900000777862',NULL,'pendente2','0',0),('99900000777846',NULL,'pendente2','0',0),('99900000777790','090385101','reprovado2','0',0),('99900000777188','090610296','pendente2','0',0),('99900000773360','090385454','pendente2','0',0),('99900000772127','090609247','pendente2','0',0),('99900000770850',NULL,'pendente2','0',0),('99900000770680',NULL,'pendente2','0',0),('99900000769045','090609549','reprovado2','0',0),('99900000768464',NULL,'pendente2','0',0),('99900000764787','090386329','pendente2','0',0),('99900000764710','090383982','pendente2','0',0),('99900000759724',NULL,'pendente2','0',0),('99900000756792',NULL,'pendente2','0',0),('99900000756334','090383958','pendente2','0',0),('99900000754587','090383494','pendente2','0',0),('99900000750476','090382269','pendente2','0',0),('99900000750026','090381955','pendente2','0',0),('99900000749354','090381777','pendente2','0',0),('99900000749320','090383290','pendente2','0',0),('99900000744670','090381831','pendente2','0',0),('99900000744271',NULL,'pendente2','0',0),('99900000742082','090380924','pendente2','0',0),('99900000741299','090610644','pendente2','0',0),('99900000738239','090380940','pendente2','0',0),('99900000737780',NULL,'pendente2','0',0),('99900000735841','090380606','pendente2','0',0),('99900000735698',NULL,'pendente2','0',0),('99900000732443','090382161','pendente2','0',0),('99900000726338','090380525','pendente2','0',0),('99900000726133','090380550','pendente2','0',0),('99900000725587',NULL,'pendente2','0',0),('99900000723703','090380495','reprovado2','0',0),('99900000722561','090380096','pendente2','0',0),('99900000722146','090616260','pendente2','0',0),('99900000719684',NULL,'pendente2','0',0),('99900000716189','090378849','pendente2','0',0),('99900000714658',NULL,'pendente2','0',0),('99900000714640',NULL,'pendente2','0',0),('99900000713279','090379420','reprovado2','0',0),('99900000713201',NULL,'pendente2','0',0),('99800000709450','090380290','pendente2','0',0),('99800000707732',NULL,'pendente2','0',0),('99800000706108',NULL,'pendente2','0',0),('99800000703753','090153820','reprovado2','0',0),('99800000699187','083556273','pendente2','0',0),('99800000697230',NULL,'pendente2','0',0),('99800000697028','083557512','pendente2','0',0),('99800000696501','090383559','pendente2','0',0),('99800000696188','083556664','pendente2','0',0),('99800000692360','083557130','pendente2','0',0),('99800000691615',NULL,'pendente2','0',0),('99800000691550',NULL,'pendente2','0',0),('99800000687600',NULL,'pendente2','0',0),('99800000686557',NULL,'pendente2','0',0),('99800000682330',NULL,'pendente2','0',0),('99800000677965','090380380','pendente2','0',0),('99800000675431','083555900','pendente2','0',0),('99800000674168','090154797','reprovado2','0',0),('99800000673366','083555951','pendente2','0',0),('99800000673285',NULL,'pendente2','0',0),('99800000666629','083556761','pendente2','0',0),('99800000666440','083360409','pendente2','0',0),('99800000666173','083555161','pendente2','0',0),('99800000663123','083359230','pendente2','0',0),('99800000661643','083359532','pendente2','0',0),('99800000661007','083358498','reprovado2','0',0),('99800000659568','083359559','reprovado2','0',0),('99800000658081',NULL,'pendente2','0',0),('99800000657808','083555285','pendente2','0',0),('99800000655090','083360093','pendente2','0',0),('99800000654060',NULL,'pendente2','0',0),('99800000652350','083358447','pendente2','0',0),('99800000650919','083358340','pendente2','0',0),('99800000646717',NULL,'pendente2','0',0),('99800000643815','083359834','pendente2','0',0),('99800000642363',NULL,'pendente2','0',0),('99800000638579','083357815','pendente2','0',0),('99800000634190',NULL,'pendente2','0',0),('99800000632279','083396551','pendente2','0',0),('99800000632147',NULL,'pendente2','0',0),('99800000631299',NULL,'pendente2','0',0),('99800000628654',NULL,'pendente2','0',0),('99800000627909','082988080','reprovado2','0',0),('99800000627828',NULL,'pendente2','0',0),('99800000627682','083359877','pendente2','0',0),('99800000626651',NULL,'pendente2','0',0),('99800000626333',NULL,'pendente2','0',0),('99800000624560',NULL,'pendente2','0',0),('99800000624462',NULL,'pendente2','0',0),('99800000624250',NULL,'pendente2','0',0),('99800000624225',NULL,'pendente2','0',0),('99800000624187',NULL,'pendente2','0',0),('99800000624063',NULL,'pendente2','0',0),('99800000620254',NULL,'pendente2','0',0),('99800000620211',NULL,'pendente2','0',0),('99800000617873','082988714','pendente2','0',0),('99800000614726','082986320','pendente2','0',0),('99800000610194','082987734','pendente2','0',0),('99800000607061',NULL,'pendente2','0',0),('99800000603805','082986568','pendente2','0',0),('99800000599735','082986720','pendente2','0',0),('99800000597350',NULL,'pendente2','0',0),('99800000597287',NULL,'pendente2','0',0),('99800000597279',NULL,'pendente2','0',0),('99800000597244',NULL,'pendente2','0',0),('99800000594091','082988021','pendente2','0',0),('99800000594083','082985480','pendente2','0',0),('99800000593923',NULL,'pendente2','0',0),('99800000593524',NULL,'pendente2','0',0),('99800000593494','082986398','pendente2','0',0),('99800000592374','082985367','pendente2','0',0),('99800000591807','082985448','reprovado2','0',0),('99800000587494','082987068','reprovado2','0',0),('99800000586943',NULL,'pendente2','0',0),('99800000586579','082983836','pendente2','0',0),('99800000585017','082984832','pendente3','0',0),('99800000584886','082986258','pendente2','0',0),('99800000584401',NULL,'pendente2','0',0),('99800000584371',NULL,'pendente2','0',0),('99800000581950','083358595','pendente2','0',0),('99800000581437','082984018','reprovado2','0',0),('99900001296957','092851720','pendente2','0',0),('99900001296876',NULL,'pendente2','0',0),('99900001295535','092708021','pendente2','0',0),('99900001295292','092442463','pendente2','0',0),('99900001295136','092440517','pendente2','0',0),('99900001302043','092440070','aprovado','0',0),('99900001301756','092720730','pendente2','0',0),('99900001301616','092708013','aprovado','0',0),('99900001301543',NULL,'pendente2','0',0),('99900001300679','092715826','aprovado','0',0),('99900001300512','092441734','aprovado','0',0),('99900001300342',NULL,'pendente2','0',0),('99900001304356',NULL,'reprovado2','0',0),('99900001303554',NULL,'pendente2','0',0),('99900001305387',NULL,'reprovado2','0',0),('99900001306570','092628630','pendente2','0',0),('99900001306421','092441408','aprovado','0',0),('99900001305042',NULL,'pendente2','0',0),('99900001309366',NULL,'reprovado2','0',0),('99900001309331',NULL,'reprovado2','0',0),('99900001306928',NULL,'pendente2','0',0),('99900001311611','092442080','aprovado','0',0),('99900001311581',NULL,'pendente2','0',0),('99900001311484',NULL,'reprovado2','0',0),('99900001311468',NULL,'pendente2','0',0),('99900001311417','093123205','aprovado','0',0),('99900001311271',NULL,'aprovado','0',0),('99900001310607','092714420','reprovado2','0',0),('99900001313991','092441564','pendente2','0',0),('99900001313320','092717519','pendente2','0',0),('99900001315722',NULL,'pendente2','0',0),('99900001315552',NULL,'reprovado2','0',0),('99900001315528','092440215','pendente2','0',0),('99900001315420',NULL,'pendente2','0',0),('99900001315382','092439985','aprovado','0',0),('99900001319604',NULL,'reprovado2','0',0),('99900001319590','092848370','reprovado2','0',0),('99900001319574','092440134','aprovado','0',0),('99900001319477',NULL,'pendente2','0',0),('99900001322923',NULL,'aprovado','0',0),('99900001321170','092833586','pendente2','0',0),('99900001325000','092440312','aprovado','0',0),('99900001324551',NULL,'aprovado','0',0),('99900001323610','092438571','pendente2','0',0),('99900001328131',NULL,'pendente2','0',0),('99900001327720',NULL,'reprovado2','0',0),('99900001331582','092438644','pendente2','0',0),('99900001331388','092849970','pendente2','0',0),('99900001329774','092715842','pendente2','0',0),('99900001329103','092515762','reprovado2','0',0),('99900001335707','092734731','pendente2','0',0),('99900001335502','092994369','pendente2','0',0),('99900001335030',NULL,'reprovado2','0',0),('99900001335022','092910467','pendente2','0',0),('99900001334158',NULL,'pendente2','0',0),('99900001334018',NULL,'pendente2','0',0),('99900001333992',NULL,'pendente2','0',0),('99900001333984',NULL,'pendente2','0',0),('99900001333429','092819621','aprovado','0',0),('99900001333275','092964710','aprovado','0',0),('99900001332953','092847471','pendente2','0',0),('99900001332643',NULL,'aprovado','0',0),('99900001336690',NULL,'pendente2','0',0),('99900001336487','092828426','pendente2','0',0),('99900001336304',NULL,'pendente2','0',0),('99900001342495','092847501','aprovado','0',0),('99900001341812',NULL,'pendente2','0',0),('99900001340689','092851274','pendente2','0',0),('99900001340344','092715966','pendente2','0',0),('99900001338560',NULL,'pendente2','0',0),('99900001338510','092438458','pendente2','0',0),('99900001343114','092600301','pendente2','0',0),('99900001345192','092910416','pendente2','0',0),('99900001345079',NULL,'reprovado2','0',0),('99900001344951',NULL,'reprovado2','0',0),('99900001344706',NULL,'pendente2','0',0),('99900001344587',NULL,'pendente2','0',0),('99900001345826',NULL,'pendente2','0',0),('99900001349813','092836097','pendente2','0',0),('99900001348906','092849903','pendente2','0',0),('99900001348671','092847455','aprovado','0',0),('99900001348582',NULL,'pendente2','0',0),('99900001348051','092851606','pendente2','0',0),('99900001351869','092438903','pendente2','0',0),('99900001351559','092439942','pendente2','0',0),('99900001351397',NULL,'pendente2','0',0),('99900001350498',NULL,'pendente2','0',0),('99900001350234',NULL,'pendente2','0',0),('99900001354167','092848141','aprovado','0',0),('99900001354132','092878660','pendente2','0',0),('99900001353381','092835309','aprovado','0',0),('99900001352679',NULL,'pendente2','0',0),('99900001352571','092994393','reprovado2','0',0),('99900001358170','092848931','pendente2','0',0),('99900001357832',NULL,'pendente2','0',0),('99900001357719',NULL,'reprovado3','0',0),('99900001357654',NULL,'pendente2','0',0),('99900001357646','092820336','pendente2','0',0),('99900001357638',NULL,'pendente2','0',0),('99900001363611',NULL,'pendente2','0',0),('99900001363441','092720714','aprovado','0',0),('99900001361643','092848095','aprovado','0',0),('99900001360906',NULL,'pendente2','0',0),('99900001360361',NULL,'pendente2','0',0),('99900001358847','092878784','pendente2','0',0),('99900001366637','092852947','pendente2','0',0),('99900001366483',NULL,'pendente2','0',0),('99900001366238',NULL,'pendente2','0',0),('99900001366114','093197977','pendente2','0',0),('99900001365797','092315828','aprovado','0',0),('99900001365401','093106220','pendente2','0',0),('99900001370278','092849148','aprovado','0',0),('99900001369075',NULL,'pendente2','0',0),('99900001368290',NULL,'reprovado2','0',0),('99900001367846',NULL,'pendente2','0',0),('99900001367684',NULL,'pendente2','0',0),('99900001367528',NULL,'pendente2','0',0),('99900001367226',NULL,'pendente2','0',0),('99900001367129','092848346','pendente2','0',0),('99900001366858','092849229','pendente2','0',0),('99900001374923','092852874','aprovado','0',0),('99900001374737','092852505','pendente2','0',0),('99900001374150',NULL,'aprovado','0',0),('99900001373790','093200463','reprovado2','0',0),('99900001373781',NULL,'pendente2','0',0),('99900001373366','092850162','pendente2','0',0),('99900001373358',NULL,'reprovado2','0',0),('99900001372505','092909868','pendente2','0',0),('99900001371517','092985246','pendente2','0',0),('99900001377086','093199449','pendente2','0',0),('99900001375962',NULL,'pendente2','0',0),('99900001382012',NULL,'pendente2','0',0),('99900001386549','092852262','pendente2','0',0),('99900001388029',NULL,'pendente2','0',0),('99900001390384','092519253','pendente2','0',0),('99900001393219',NULL,'aprovado','0',0),('99900001395785','093198345','pendente2','0',0),('99900001403133','092439250','pendente2','0',0),('99900001406329',NULL,'pendente2','0',0),('99900001408100',NULL,'pendente2','0',0),('99900001409980','093121318','pendente2','0',0),('99900001411829',NULL,'pendente2','0',0),('99900001412957',NULL,'pendente2','0',0),('99900001415140',NULL,'pendente2','0',0),('99900001424289','093198299','pendente2','0',0),('99900001425218',NULL,'pendente2','0',0),('99900001428101',NULL,'pendente2','0',0),('99900001427709','093200528','aprovado','0',0),('99900001430947',NULL,'pendente2','0',0),('99900001433865','092438920','pendente2','0',0),('99900001432940',NULL,'pendente2','0',0),('99900001432125','092849610','pendente2','0',0),('99900001430629','093593813','pendente2','0',0),('99900001429132','093198981','pendente2','0',0),('99900001429094',NULL,'pendente2','0',0),('99900001428594',NULL,'pendente2','0',0),('99900001428209','093202253','pendente2','0',0),('99900001427040',NULL,'pendente2','0',0),('99900001425072',NULL,'pendente2','0',0),('99900001424955',NULL,'reprovado2','0',0),('99900001423916','093099029','pendente2','0',0),('99900001421832','092852599','pendente2','0',0),('99900001421506','092852130','reprovado2','0',0),('99900001421158',NULL,'pendente2','0',0),('99900001420046',NULL,'pendente2','0',0),('99900001419307','092911552','reprovado2','0',0),('99900001418963','093198248','reprovado2','0',0),('99900001417983','093198329','pendente2','0',0),('99900001417860',NULL,'pendente2','0',0),('99900001417088',NULL,'pendente2','0',0),('99900001416839',NULL,'reprovado2','0',0),('99900001416154',NULL,'reprovado2','0',0),('99900001414534',NULL,'pendente2','0',0),('99900001413678',NULL,'reprovado2','0',0),('99900001412949',NULL,'pendente2','0',0),('99900001409972','093198434','pendente2','0',0),('99900001409581',NULL,'reprovado2','0',0),('99900001408909',NULL,'reprovado2','0',0),('99900001408330',NULL,'pendente2','0',0),('99900001407848',NULL,'pendente2','0',0),('99900001407821',NULL,'reprovado2','0',0),('99900001407163',NULL,'pendente2','0',0),('99900001407066','092851819','pendente2','0',0),('99900001406957','093123515','pendente2','0',0),('99900001405632','092851584','pendente2','0',0),('99900001405454',NULL,'reprovado2','0',0),('99900001404385',NULL,'pendente2','0',0),('99900001404113',NULL,'pendente2','0',0),('99900001401866','093100892','reprovado2','0',0),('99900001400592','092851908','aprovado','0',0),('99900001400509',NULL,'reprovado2','0',0),('99900001400380',NULL,'pendente2','0',0),('99900001400177','093243634','pendente2','0',0),('99900001399942',NULL,'pendente2','0',0),('99900001399322',NULL,'pendente2','0',0),('99900001396951',NULL,'pendente2','0',0),('99900001396919','093198833','pendente2','0',0),('99900001395726',NULL,'pendente2','0',0),('99900001395610',NULL,'pendente2','0',0),('99900001395580',NULL,'pendente2','0',0),('99900001394797','093200358','aprovado','0',0),('99900001394347',NULL,'aprovado','0',0),('99900001394320','092919278','pendente2','0',0),('99900001393090',NULL,'reprovado2','0',0),('99900001392107',NULL,'pendente2','0',0),('99900001391542',NULL,'pendente2','0',0),('99900001391399',NULL,'reprovado2','0',0),('99900001389718',NULL,'pendente2','0',0),('99900001389645',NULL,'pendente2','0',0),('99900001385976',NULL,'reprovado2','0',0),('99900001385631','092989152','reprovado2','0',0),('99900001384490','092850537','pendente2','0',0),('99900001383523','093199767','pendente2','0',0),('99900001381784',NULL,'pendente2','0',0),('99900001380532',NULL,'reprovado2','0',0),('99900001380320','092850839','pendente2','0',0),('99900001379976',NULL,'pendente2','0',0),('99900001379267','092849938','pendente2','0',0),('99900001378759',NULL,'reprovado2','0',0),('99900001378554',NULL,'pendente2','0',0),('99900001377671',NULL,'reprovado2','0',0),('99900001377507',NULL,'pendente2','0',0),('99900001377485',NULL,'pendente2','0',0),('99900001377426','093199430','pendente2','0',0),('99900001370618',NULL,'pendente2','0',0),('99900001258362','092314724','aprovado','0',0),('99900001438158','093107170','aprovado','0',0),('99900001437984',NULL,'pendente2','0',0),('99900001437909',NULL,'pendente2','0',0),('99900001437550',NULL,'pendente2','0',0),('99900001437380',NULL,'pendente2','0',0),('99900001437194','093199112','pendente2','0',0),('99900001439570','093199414','pendente2','0',0),('99900001439545',NULL,'pendente2','0',0),('99900001442813','092998593','pendente2','0',0),('99900001441884',NULL,'reprovado2','0',0),('99900001441817',NULL,'pendente2','0',0),('99900001441167','093199651','pendente2','0',0),('99900001442988',NULL,'reprovado2','0',0),('99900001442937',NULL,'pendente2','0',0),('99900001445928',NULL,'aprovado','0',0),('99900001445723','093123442','pendente2','0',0),('99900001445391','093316313','pendente2','0',0),('99900001444280','093594259','aprovado','0',0),('99900001447122',NULL,'pendente2','0',0),('99900001447831','093097913','pendente2','0',0),('99900001449729','093200102','pendente2','0',0),('99900001449060',NULL,'pendente2','0',0),('99900001448854',NULL,'pendente2','0',0),('99900001458817',NULL,'pendente2','0',0),('99900001458329',NULL,'pendente2','0',0),('99900001458132',NULL,'pendente2','0',0),('99900001456326','093199546','pendente2','0',0),('99900001454781','093200145','reprovado2','0',0),('99900001453114','093244533','aprovado','0',0),('99900001452029',NULL,'pendente2','0',0),('99900001450352','092852238','pendente2','0',0),('99900001462148','093150750','pendente2','0',0),('99900001463462',NULL,'pendente2','0',0),('99900001463152',NULL,'pendente2','0',0),('99900001464060',NULL,'pendente2','0',0),('99900001463756',NULL,'pendente2','0',0),('99900001469398',NULL,'pendente2','0',0),('99900001467654','093201460','pendente2','0',0),('99900001467301','093199783','pendente2','0',0),('99900001467255',NULL,'pendente2','0',0),('99900001473417','093111860','pendente2','0',0),('99900001472798','093200650','pendente2','0',0),('99900001472658',NULL,'reprovado2','0',0),('99900001472429','093141955','pendente2','0',0),('99900001472399',NULL,'aprovado','0',0),('99900001472380','093200250','aprovado','0',0),('99900001472275',NULL,'pendente2','0',0),('99900001471252','093199848','pendente2','0',0),('99900001473905',NULL,'pendente2','0',0),('99900001476220','093200935','pendente2','0',0),('99900001476114','093201010','aprovado','0',0),('99900001477730',NULL,'pendente2','0',0),('99900001477463',NULL,'pendente2','0',0),('99900001477366',NULL,'pendente2','0',0),('99900001477021',NULL,'reprovado2','0',0),('99900001476831',NULL,'pendente2','0',0),('99900001479768',NULL,'reprovado2','0',0),('99900001478362','093201559','pendente2','0',0),('99900001480260',NULL,'pendente2','0',0),('99900001480049',NULL,'pendente2','0',0),('99900001486969',NULL,'reprovado2','0',0),('99900001486810',NULL,'pendente2','0',0),('99900001486756','093200951','pendente2','0',0),('99900001486624',NULL,'pendente2','0',0),('99900001486560',NULL,'pendente2','0',0),('99900001485830',NULL,'pendente2','0',0),('99900001485687',NULL,'pendente2','0',0),('99900001485466',NULL,'pendente2','0',0),('99900001485083','093151713','reprovado2','0',0),('99900001484702',NULL,'pendente2','0',0),('99900001484001',NULL,'pendente2','0',0),('99900001482734',NULL,'pendente2','0',0),('99900001482009',NULL,'pendente2','0',0),('99900001481754',NULL,'pendente2','0',0),('99900001488040',NULL,'reprovado2','0',0),('99900001490354','092989225','aprovado','0',0),('99900001492454','093594186','reprovado2','0',0),('99900001491717',NULL,'pendente2','0',0),('99900001491636',NULL,'pendente2','0',0),('99900001491059','093208499','pendente2','0',0),('99900001490982',NULL,'pendente2','0',0),('99900001496646',NULL,'pendente2','0',0),('99900001496336','093157347','reprovado2','0',0),('99900001496115','093202679','pendente2','0',0),('99900001496042',NULL,'pendente2','0',0),('99900001495798',NULL,'pendente2','0',0),('99900001495445',NULL,'reprovado2','0',0),('99900001498355','093165560','pendente2','0',0),('99900001501607','093594003','aprovado','0',0),('99900001500104',NULL,'pendente2','0',0),('99900001500090',NULL,'pendente2','0',0),('99900001503103',NULL,'pendente2','0',0),('99900001502620',NULL,'pendente2','0',0),('99900001506595',NULL,'reprovado2','0',0),('99900001506200',NULL,'pendente2','0',0),('99900001505076',NULL,'pendente2','0',0),('99900001504843',NULL,'pendente2','0',0),('99900001504410',NULL,'pendente2','0',0),('99900001504029',NULL,'pendente2','0',0),('99900001503995','093206968','reprovado2','0',0),('99900001515918',NULL,'pendente2','0',0),('99900001513184',NULL,'reprovado2','0',0),('99900001513010',NULL,'reprovado2','0',0),('99900001512900','093165609','pendente2','0',0),('99900001512889',NULL,'pendente2','0',0),('99900001512382',NULL,'aprovado','0',0),('99900001511777','093210272','pendente2','0',0),('99900001511343',NULL,'aprovado','0',0),('99900001511092',NULL,'pendente2','0',0),('99900001509950',NULL,'pendente2','0',0),('99900001509179','093593872','pendente2','0',0),('99900001508679',NULL,'pendente2','0',0),('99900001508547',NULL,'pendente2','0',0),('99900001519905',NULL,'pendente2','0',0),('99900001519735',NULL,'aprovado','0',0),('99900001519450',NULL,'pendente2','0',0),('99900001519034',NULL,'pendente2','0',0),('99900001518267',NULL,'aprovado','0',0),('99900001520920',NULL,'pendente2','0',0),('99900001524852',NULL,'pendente2','0',0),('99900001524410',NULL,'pendente2','0',0),('99900001524283',NULL,'pendente2','0',0),('99900001523740','093290578','pendente2','0',0),('99900001525417','093163614','pendente2','0',0),('99900001525409',NULL,'pendente2','0',0),('99900001528289',NULL,'reprovado2','0',0),('99900001528033','093290500','reprovado2','0',0),('99900001527975',NULL,'pendente2','0',0),('99900001531514','093629893','reprovado2','0',0),('99900001531280',NULL,'reprovado2','0',0),('99900001530135',NULL,'pendente2','0',0),('99900001528726',NULL,'pendente2','0',0),('99900001528467',NULL,'pendente2','0',0),('99900001533223',NULL,'reprovado2','0',0),('99900001533215',NULL,'pendente2','0',0),('99900001532960',NULL,'pendente2','0',0),('99900001535803',NULL,'aprovado','0',0),('99900001533703',NULL,'pendente2','0',0),('99900001536664',NULL,'pendente2','0',0),('99900001536346',NULL,'pendente2','0',0),('99900001536249',NULL,'pendente2','0',0),('99900001537717',NULL,'pendente2','0',0),('99900001540904',NULL,'pendente2','0',0),('99900001540351',NULL,'pendente2','0',0),('99900001540203',NULL,'pendente2','0',0),('99900001540084',NULL,'pendente2','0',0),('99900001539264',NULL,'pendente2','0',0),('99900001539116',NULL,'pendente2','0',0),('99900001538470',NULL,'reprovado2','0',0),('99900001538349',NULL,'pendente2','0',0),('99900001541331',NULL,'pendente2','0',0),('99900001543407',NULL,'pendente2','0',0),('99900001543121',NULL,'pendente2','0',0),('99900001543040',NULL,'pendente2','0',0),('99900001542966',NULL,'pendente2','0',0),('99900001545639',NULL,'pendente2','0',0),('99900001544454',NULL,'pendente2','0',0),('99900001544314',NULL,'pendente2','0',0),('99900001549227',NULL,'pendente2','0',0),('99900001547461',NULL,'pendente2','0',0),('99900001547453',NULL,'pendente2','0',0),('99900001553860',NULL,'reprovado2','0',0),('99900001553682',NULL,'reprovado2','0',0),('99900001553135',NULL,'pendente2','0',0),('99900001552864',NULL,'reprovado2','0',0),('99900001552694',NULL,'reprovado2','0',0),('99900001552015',NULL,'pendente2','0',0),('99900001550551',NULL,'pendente2','0',0),('99900001550519',NULL,'pendente2','0',0),('99900001556819',NULL,'reprovado2','0',0),('99900001556215',NULL,'pendente2','0',0),('99900001555561',NULL,'pendente2','0',0),('99900001555294',NULL,'pendente2','0',0),('99900001554883',NULL,'pendente2','0',0);
/*!40000 ALTER TABLE `protocolos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Current Database: `sigat_log`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `sigat_log` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `sigat_log`;

--
-- Current Database: `teste`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `teste` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `teste`;

--
-- Table structure for table `CIDADE`
--

DROP TABLE IF EXISTS `CIDADE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CIDADE` (
  `ID_CIDADE` int(11) NOT NULL AUTO_INCREMENT,
  `NM_CIDADE` varchar(60) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`ID_CIDADE`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CIDADE`
--

LOCK TABLES `CIDADE` WRITE;
/*!40000 ALTER TABLE `CIDADE` DISABLE KEYS */;
INSERT INTO `CIDADE` VALUES (1,'FLORIANOPOLIS'),(2,'SÃO JOSÉ'),(3,'PALHOÇA');
/*!40000 ALTER TABLE `CIDADE` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `EDIFICACOES`
--

DROP TABLE IF EXISTS `EDIFICACOES`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `EDIFICACOES` (
  `ID_EDIFICACAO` int(11) NOT NULL AUTO_INCREMENT,
  `ID_CIDADE` int(11) NOT NULL,
  `CPF_CNPJ` varchar(14) CHARACTER SET latin1 NOT NULL,
  `NM_EDIFICACAO` varchar(100) CHARACTER SET latin1 NOT NULL,
  `NM_FANTASIA` varchar(60) CHARACTER SET latin1 NOT NULL,
  `NM_LOGRADOURO` varchar(100) CHARACTER SET latin1 NOT NULL,
  `NM_BAIRRO` varchar(60) CHARACTER SET latin1 NOT NULL,
  `NR_CEP` int(8) NOT NULL,
  `NR` int(10) NOT NULL,
  `AREA_TOTAL` decimal(17,2) NOT NULL,
  `NR_ALTURA` decimal(17,2) NOT NULL,
  `AREA_PAVIMENTO` decimal(17,2) NOT NULL,
  `RISCO` varchar(50) CHARACTER SET latin1 NOT NULL,
  `OCUPACAO` varchar(50) CHARACTER SET latin1 NOT NULL,
  `SITUACAO` varchar(50) CHARACTER SET latin1 NOT NULL,
  `TIPO` varchar(50) CHARACTER SET latin1 NOT NULL,
  `NR_PAVIMENTO` int(11) NOT NULL,
  `NR_BLOCO` int(11) NOT NULL,
  `NM_PROPRIETARIO` varchar(50) CHARACTER SET latin1 NOT NULL,
  `FONE` int(11) NOT NULL,
  `EMAIL` varchar(60) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`ID_EDIFICACAO`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `EDIFICACOES`
--

LOCK TABLES `EDIFICACOES` WRITE;
/*!40000 ALTER TABLE `EDIFICACOES` DISABLE KEYS */;
INSERT INTO `EDIFICACOES` VALUES (1,1,'01822623923','DULCEMAR BECKER','DULCEMAR BECKER','logradouro','centro',88000100,102,'100.00','2.00','2.00','Leve','Residencial privativa multifamiliar','Existente','Alvenaria',1,1,'joaozinho',12345678,'teste@teste.com.br'),(6,1,'1','DULCEMAR BECKER','margarida da silva','disneylandia','disnopolandia',88070450,45,'122.00','1.10','100.00','Leve','Residencial privativa multifamiliar','Existente','Alvenaria',1,1,'lu',8,'jhjfefefefder'),(3,1,'123456789','DULCEMAR BECKER','TESTE','LIBERATO BITENCOURT','ESTREITO',88070450,12,'122.00','1.10','100.00','Médio','','Existente','Alvenaria',3,5,'ED.MARIA G.B.HESSMAN',12345678,'HBGVHGVHGVHGVGVGVGVGVG'),(4,1,'123456789','MARIA G.B..HESSMAN ED.','TESTE','LIBERATO BITENCOURT','ESTREITO',88070450,12,'122.00','1.10','100.00','Médio','Escolar','Existente','Alvenaria',1,50,'joselito patolino margaretes',12345678,'HBGVHGVHGVHGVGVGVGVGVG'),(5,1,'123456789','MARIA G.B..HESSMAN ED.','TESTE','LIBERATO BITENCOURT','ESTREITO',88070450,12,'122.00','1.10','100.00','Médio','Industrial','Existente','Alvenaria',3,5,'ED.MARIA G.B.HESSMAN',12345678,'HBGVHGVHGVHGVGVGVGVGVG'),(7,1,'123456789','TESTE','LUANA','LIBERATO BITENCOURT','ESTREITO',88070450,12,'122.00','1.10','100.00','Elevado','Comercial','Nova','Madeira',2,21,'LUANA',12345678,'LUANA'),(8,1,'123456789','TESTE','LUANA','LIBERATO BITENCOURT','ESTREITO',88070450,12,'122.00','1.10','100.00','Elevado','Comercial','Nova','Madeira',2,21,'LUANA',12345678,'LUANA'),(9,1,'123456789','TESTE','LUANA','LIBERATO BITENCOURT','ESTREITO',88070450,12,'122.00','1.10','100.00','Elevado','Comercial','Nova','Madeira',2,21,'LUANA',12345678,'LUANA'),(10,1,'123456789','MARIA G.B..HESSMAN ED.','TESTE','LIBERATO BITENCOURT','ESTREITO',88070450,12,'122.00','1.10','100.00','Leve','Residencial privativa multifamiliar','Existente','Alvenaria',1,1,'ED.MARIA G.B.HESSMAN',12345678,'HBGVHGVHGVHGVGVGVGVGVG'),(11,1,'123456789','MARIA G.B..HESSMAN ED.','TESTE','LIBERATO BITENCOURT','ESTREITO',88070450,12,'122.00','1.10','100.00','Médio','Escolar','Existente','Alvenaria',1,1,'pato donald',12345678,'HBGVHGVHGVHGVGVGVGVGVG'),(12,1,'01822623923','Nome da edificacao','LUANA','LIBERATO BITENCOURT','ESTREITO',88000100,102,'100.00','1.10','100.00','Médio','Residencial privativa unifamiliar','Nova','Madeira',3,1,'LUANA',12345678,'HBGVHGVHGVHGVGVGVGVGVG'),(13,1,'01822623923','MARIA G.B..HESSMAN ED.','LUANA','LIBERATO BITENCOURT','ESTREITO',88000100,102,'100.00','1.10','100.00','Leve','Residencial privativa unifamiliar','Existente','Alvenaria',1,1,'ED.MARIA G.B.HESSMAN',12345678,'HBGVHGVHGVHGVGVGVGVGVG'),(14,1,'01822623923','MARIA G.B..HESSMAN ED.','LUANA','LIBERATO BITENCOURT','ESTREITO',88000100,102,'100.00','1.10','100.00','Leve','Residencial privativa unifamiliar','Existente','Alvenaria',1,1,'ED.MARIA G.B.HESSMAN',12345678,'HBGVHGVHGVHGVGVGVGVGVG'),(15,1,'01822623923','MARIA G.B..HESSMAN ED.','LUANA','LIBERATO BITENCOURT','ESTREITO',88000100,102,'100.00','1.10','100.00','Leve','Residencial privativa unifamiliar','Existente','Alvenaria',1,1,'luluzinha',12345678,'HBGVHGVHGVHGVGVGVGVGVG'),(16,1,'01822623923','MARIA G.B..HESSMAN ED.','LUANA','LIBERATO BITENCOURT','ESTREITO',88000100,102,'100.00','1.10','100.00','Leve','Residencial privativa multifamiliar','Existente','Alvenaria',1,1,'marcelo',12345678,'jhjfefefefder'),(17,1,'123456789','mercado jose','mercado jose','LIBERATO BITENCOURT','ESTREITO',88000100,102,'100.00','2.00','100.00','Leve','Comercial','Existente','Mista',1,1,'jose silva',12345678,'asfd@asdf'),(18,2,'123456789','mercado luana','mercadinho','gil costa','ipiranga',88070450,688,'800.00','7.00','400.00','Leve','Comercial','Nova','Mista',2,2,'luana becker',12345678,'luanabecker@unisul.br');
/*!40000 ALTER TABLE `EDIFICACOES` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `EFETIVO`
--

DROP TABLE IF EXISTS `EFETIVO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `EFETIVO` (
  `LOGIN` varchar(20) CHARACTER SET latin1 NOT NULL,
  `NM_EFETIVO` varchar(50) CHARACTER SET latin1 NOT NULL,
  `PERFIL` varchar(20) CHARACTER SET latin1 NOT NULL,
  `BATALHAO` varchar(11) CHARACTER SET latin1 NOT NULL,
  `COMPANHIA` varchar(11) CHARACTER SET latin1 NOT NULL,
  `PELOTAO` varchar(11) CHARACTER SET latin1 NOT NULL,
  `GRUPAMENTO` varchar(11) CHARACTER SET latin1 NOT NULL,
  `ID_CIDADE` int(11) NOT NULL,
  `FONE` varchar(11) CHARACTER SET latin1 NOT NULL,
  `SENHA` varchar(32) CHARACTER SET latin1 NOT NULL,
  `EMAIL` varchar(50) CHARACTER SET latin1 NOT NULL,
  `POSTO` varchar(11) CHARACTER SET latin1 NOT NULL,
  `ID_EFETIVO` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`ID_EFETIVO`),
  UNIQUE KEY `LOGIN` (`LOGIN`,`NM_EFETIVO`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `EFETIVO`
--

LOCK TABLES `EFETIVO` WRITE;
/*!40000 ALTER TABLE `EFETIVO` DISABLE KEYS */;
INSERT INTO `EFETIVO` VALUES ('carlos','carlos eduardo','Vistoriador','1Âº BBM','1','1','1',1,'12345678','81dc9bdb52d04dc20036dbd8313ed055','carlos.sousa@unisul.br','Civil',5);
/*!40000 ALTER TABLE `EFETIVO` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `SOLIC_HABITESE`
--

DROP TABLE IF EXISTS `SOLIC_HABITESE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SOLIC_HABITESE` (
  `NM_SOLICITANTE` varchar(50) CHARACTER SET latin1 NOT NULL,
  `CPF_CNPJ_SOLICITANTE` varchar(20) CHARACTER SET latin1 NOT NULL,
  `FONE_SOLICITANTE` int(11) NOT NULL,
  `EMAIL_SOLICITANTE` varchar(60) CHARACTER SET latin1 NOT NULL,
  `NM_EDIFICACAO` varchar(50) CHARACTER SET latin1 NOT NULL,
  `NM_FANTASIA` varchar(50) CHARACTER SET latin1 NOT NULL,
  `NM_LOGRADOURO` varchar(50) CHARACTER SET latin1 NOT NULL,
  `NR` int(11) NOT NULL,
  `ID_CIDADE` int(11) NOT NULL,
  `NR_CEP` varchar(20) CHARACTER SET latin1 NOT NULL,
  `NM_BAIRRO` varchar(50) CHARACTER SET latin1 NOT NULL,
  `AREA_TOTAL` decimal(17,2) NOT NULL,
  `ID_SOLIC_HABITESE` int(11) NOT NULL AUTO_INCREMENT,
  `NM_ENGENHEIRO1` varchar(50) CHARACTER SET latin1 NOT NULL,
  `NM_ENGENHEIRO2` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `NM_ENGENHEIRO3` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `CREA1` int(11) NOT NULL,
  `CREA2` int(11) DEFAULT NULL,
  `CREA3` int(11) DEFAULT NULL,
  `TIPO_AREA_VIST` varchar(20) CHARACTER SET latin1 NOT NULL,
  `NM_AREA` varchar(30) CHARACTER SET latin1 DEFAULT NULL,
  `AREA_PARCIAL` decimal(17,2) DEFAULT NULL,
  `STATUS` varchar(10) CHARACTER SET latin1 NOT NULL,
  `DATA` date NOT NULL,
  `PARECER` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `VISTORIADOR` varchar(50) CHARACTER SET latin1 NOT NULL,
  `DESC` text CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`ID_SOLIC_HABITESE`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SOLIC_HABITESE`
--

LOCK TABLES `SOLIC_HABITESE` WRITE;
/*!40000 ALTER TABLE `SOLIC_HABITESE` DISABLE KEYS */;
INSERT INTO `SOLIC_HABITESE` VALUES ('Alberto Carlos Silveira','01822623923',1234,'asfd@asdf','MARIA G.B..HESSMAN ED.','LUANA','LIBERATO BITENCOURT',102,1,'88000100','ESTREITO','2.00',4,'joao','','',1234569,0,0,'Total','huhjh','10.00','V','2009-11-03','Deferido','luana','todos sistemas preventivos de acordo.'),('lulu lulu','01822623923',1234,'asfd@asdf','MARIA G.B..HESSMAN ED.','LUANA','LIBERATO BITENCOURT',102,1,'88000100','ESTREITO','0.00',7,'joao','','',1234569,0,0,'Total','TESTE','10.00','V','2009-10-14','DEFERIDO','JOSE',''),('jujuba','01822623923',1234,'asfd@asdf','MARIA G.B..HESSMAN ED.','LUANA','LIBERATO BITENCOURT',102,1,'88000100','ESTREITO','2.00',8,'joao','juliana','jujuba',1234569,1237891,9876543,'Total','TESTE','0.00','V','2009-10-14','DEFERIDO','','aaaaaaa'),('marcelo viana','01822623923',1234,'asfd@asdf','MARIA G.B..HESSMAN ED.','LUANA','LIBERATO BITENCOURT',102,1,'88000100','ESTREITO','2.00',9,'joao','juliana','',1234569,1237891,9876543,'Total','','0.00','P','2009-10-14','','LULU','');
/*!40000 ALTER TABLE `SOLIC_HABITESE` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `SOLIC_PROJETO`
--

DROP TABLE IF EXISTS `SOLIC_PROJETO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SOLIC_PROJETO` (
  `ID_SOLIC_PROJETO` int(11) NOT NULL AUTO_INCREMENT,
  `NM_SOLICITANTE` varchar(60) CHARACTER SET latin1 NOT NULL,
  `EMAIL_SOLICITANTE` varchar(60) CHARACTER SET latin1 NOT NULL,
  `FONE_SOLICITANTE` varchar(11) CHARACTER SET latin1 NOT NULL,
  `CPF_CNPJ_SOLICITANTE` varchar(20) CHARACTER SET latin1 NOT NULL,
  `NM_EDIFICACAO` varchar(60) CHARACTER SET latin1 NOT NULL,
  `NM_FANTASIA` varchar(60) CHARACTER SET latin1 NOT NULL,
  `NM_LOGRADOURO` varchar(60) CHARACTER SET latin1 NOT NULL,
  `NR` int(11) NOT NULL,
  `ID_CIDADE` int(11) NOT NULL,
  `NR_CEP` varchar(11) CHARACTER SET latin1 NOT NULL,
  `AREA_TOTAL` decimal(17,2) NOT NULL,
  `AREA_PAVIMENTO` decimal(17,2) NOT NULL,
  `NR_ALTURA` decimal(17,2) NOT NULL,
  `OCUPACAO` varchar(50) CHARACTER SET latin1 NOT NULL,
  `RISCO` varchar(50) CHARACTER SET latin1 NOT NULL,
  `SITUACAO` varchar(50) CHARACTER SET latin1 NOT NULL,
  `TIPO` varchar(50) CHARACTER SET latin1 NOT NULL,
  `NR_PAVIMENTO` int(50) NOT NULL,
  `NR_BLOCO` int(50) NOT NULL,
  `TP_ADUCAO` varchar(30) CHARACTER SET latin1 NOT NULL,
  `PREVENTIVO_EXTINTOR` varchar(50) CHARACTER SET latin1 NOT NULL,
  `NM_ENGENHEIRO1` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `NM_ENGENHEIRO2` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `NM_ENGENHEIRO3` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `CREA1` varchar(12) CHARACTER SET latin1 DEFAULT NULL,
  `CREA2` varchar(12) CHARACTER SET latin1 DEFAULT NULL,
  `CREA3` varchar(12) CHARACTER SET latin1 DEFAULT NULL,
  `NR_ESCADA_COMUM` varchar(11) CHARACTER SET latin1 DEFAULT NULL,
  `NR_ESCADA_PROTEGIDA` varchar(11) CHARACTER SET latin1 DEFAULT NULL,
  `NR_ESCADA_ENCLAUSURADA` varchar(11) CHARACTER SET latin1 DEFAULT NULL,
  `NR_ESCADA_PROVA` varchar(11) CHARACTER SET latin1 DEFAULT NULL,
  `NR_PASSARELA` varchar(11) CHARACTER SET latin1 DEFAULT NULL,
  `NR_ESCADA_PRESSU` varchar(11) CHARACTER SET latin1 DEFAULT NULL,
  `NR_RAMPA` varchar(11) CHARACTER SET latin1 DEFAULT NULL,
  `NR_ELEVADOR` varchar(11) CHARACTER SET latin1 DEFAULT NULL,
  `NR_LOCAL` varchar(11) CHARACTER SET latin1 DEFAULT NULL,
  `SISTEMA_ALARME` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `ILUMINACAO_EMERGENCIA` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `PROTECAO_DESCARGA` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `RECIPIENTE` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `TIPO_INSTALACAO` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `OUTROS` varchar(60) CHARACTER SET latin1 DEFAULT NULL,
  `NM_BAIRRO` varchar(50) CHARACTER SET latin1 NOT NULL,
  `STATUS` varchar(10) CHARACTER SET latin1 NOT NULL,
  `DATA` date NOT NULL,
  `PARECER` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `VISTORIADOR` varchar(50) CHARACTER SET latin1 NOT NULL,
  `DESC` text CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`ID_SOLIC_PROJETO`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SOLIC_PROJETO`
--

LOCK TABLES `SOLIC_PROJETO` WRITE;
/*!40000 ALTER TABLE `SOLIC_PROJETO` DISABLE KEYS */;
INSERT INTO `SOLIC_PROJETO` VALUES (1,'LU2110','asfd@asdf','1234','0','DULCEMAR BECKER','','LIBERATO BITENCOURT',102,0,'88000100','100.00','0.00','0.00','','','','',0,0,'','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ESTREITO','P','0000-00-00','DEFERIDO','TESTE','GYGYGYGYGY222'),(2,'LU2110','asfd@asdf','1234','0','DULCEMAR BECKER','','LIBERATO BITENCOURT',102,0,'88000100','100.00','0.00','0.00','','','','',0,0,'','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ESTREITO','P','0000-00-00','DEFERIDO','TESTE',''),(4,'LU2110','asfd@asdf','1234','01822623923','DULCEMAR BECKER','LUANA','LIBERATO BITENCOURT',102,1,'88000100','100.00','234.00','23.00','Residencial privativa multifamiliar','Leve','Existente','Alvenaria',2,1,'','','teste','','','1234569','','','','','','','','','','','','','','','','','','ESTREITO','','0000-00-00','DEFERIDO','TESTE',''),(5,'LU2110','asfd@asdf','1234','01822623923','DULCEMAR BECKER','LUANA','LIBERATO BITENCOURT',102,1,'88000100','100.00','234.00','23.00','Residencial privativa multifamiliar','Leve','Existente','Alvenaria',2,1,'','','teste','','','1234569','','','','','','','','','','','','','','','','','','ESTREITO','','0000-00-00','DEFERIDO','TESTE',''),(6,'LU2110','asfd@asdf','1234','01822623923','DULCEMAR BECKER','LUANA','LIBERATO BITENCOURT',102,1,'88000100','100.00','234.00','23.00','Residencial privativa multifamiliar','Leve','Existente','Alvenaria',2,2,'','','','','','','','','','','','','','','','','','','','','','','','ESTREITO','','0000-00-00','DEFERIDO','TESTE',''),(7,'LU2110','asfd@asdf','1234','01822623923','DULCEMAR BECKER','LUANA','LIBERATO BITENCOURT',102,1,'88000100','100.00','234.00','23.00','Residencial privativa multifamiliar','Leve','Existente','Alvenaria',2,2,'','','','','','','','','','','','','','','','','','','','','','','','ESTREITO','','0000-00-00','DEFERIDO','TESTE',''),(8,'LU2110','asfd@asdf','1234','01822623923','DULCEMAR BECKER','LUANA','LIBERATO BITENCOURT',102,1,'88000100','100.00','234.00','23.00','Residencial privativa multifamiliar','Leve','Existente','Alvenaria',2,2,'','','','','','','','','','','','','','','','','','','','','','','','ESTREITO','','0000-00-00','DEFERIDO','TESTE',''),(9,'LU2110','asfd@asdf','1234','01822623923','DULCEMAR BECKER','LUANA','LIBERATO BITENCOURT',102,1,'88000100','100.00','234.00','23.00','Residencial privativa multifamiliar','Leve','Existente','Alvenaria',2,2,'','','','','','','','','','','','','','','','','','','','','','','','ESTREITO','','0000-00-00','DEFERIDO','TESTE',''),(11,'LU2110','asfd@asdf','1234','01822623923','DULCEMAR BECKER','LUANA','LIBERATO BITENCOURT',102,1,'88000100','100.00','234.00','23.00','Residencial privativa multifamiliar','Leve','Existente','Alvenaria',2,2,'','','','','','','','','','','','','','','','','','','','','','','','ESTREITO','','0000-00-00','DEFERIDO','TESTE',''),(12,'LU2110','asfd@asdf','1234','01822623923','DULCEMAR BECKER','LUANA','LIBERATO BITENCOURT',102,1,'88000100','100.00','234.00','23.00','Residencial privativa unifamiliar','Leve','Existente','Alvenaria',2,2,'','N','joazinho','juliana','jujuba','1234569','1237891','9876543','7','7','7','7','7','7','7','7','7','','','','','','','ESTREITO','','0000-00-00','DEFERIDO','TESTE',''),(13,'LU2110','asfd@asdf','1234','01822623923','DULCEMAR BECKER','LUANA','LIBERATO BITENCOURT',102,1,'88000100','100.00','234.00','23.00','Residencial privativa unifamiliar','Leve','Existente','Alvenaria',2,2,'','N','joazinho','juliana','jujuba','1234569','1237891','9876543','7','7','7','7','7','7','7','7','7','','','','','','','centro','V','0000-00-00','DEFERIDO','luana','teste'),(14,'LU2110','asfd@asdf','1234','01822623923','DULCEMAR BECKER','LUANA','LIBERATO BITENCOURT',102,1,'88000100','100.00','234.00','23.00','Residencial privativa multifamiliar','Leve','Existente','Alvenaria',2,2,'Por bombas','','joao','juliana','jujuba','1234569','1237891','9876543','9','9','6','6','6','9','7','6','6','','','','','','teste','ESTREITO','','0000-00-00','DEFERIDO','TESTE',''),(15,'LU2110','asfd@asdf','1234','01822623923','DULCEMAR BECKER','LUANA','LIBERATO BITENCOURT',102,1,'88000100','100.00','234.00','23.00','Residencial privativa multifamiliar','Leve','Existente','Alvenaria',2,1,'Gravitacional','','joao','juliana','jujuba','1234569','1237891','9876543','2','2','2','1','3','2','2','2','1','Com detecção','Bloco autônomo','Eletrogeométrico','Transportável','Predial','hjhgjgyghgg','ESTREITO','','0000-00-00','DEFERIDO','TESTE',''),(16,'LU2110','asfd@asdf','1234','01822623923','DULCEMAR BECKER','LUANA','LIBERATO BITENCOURT',102,1,'88000100','100.00','234.00','23.00','Residencial privativa unifamiliar','Leve','Existente','Alvenaria',2,2,'Gravitacional','','joao','juliana','jujuba','1234569','1237891','9876543','3','3','2','2','2','4','3','3','3','Com detecção','Bloco autônomo','Eletrogeométrico','Transportável','Predial','ab','ESTREITO','','0000-00-00','DEFERIDO','TESTE',''),(17,'LU2110','asfd@asdf','1234','01822623923','DULCEMAR BECKER','LUANA','LIBERATO BITENCOURT',102,1,'88000100','100.00','234.00','23.00','Residencial privativa unifamiliar','Leve','Existente','Alvenaria',2,2,'Gravitacional','N','joao','juliana','jujuba','1234569','1237891','9876543','3','3','2','2','2','4','3','3','3','Com detecção','Bloco autônomo','Eletrogeométrico','Transportável','Predial','ab','ESTREITO','','0000-00-00','DEFERIDO','TESTE',''),(18,'LU2110','asfd@asdf','1234','01822623923','DULCEMAR BECKER','LUANA','LIBERATO BITENCOURT',102,1,'88000100','100.00','234.00','23.00','Residencial privativa unifamiliar','Leve','Existente','Alvenaria',2,2,'Gravitacional','N','joao','juliana','jujuba','1234569','1237891','9876543','9','9','7','6','6','9','7','6','6','Com detecção','Bloco autônomo','Eletrogeométrico','Recarregável','Predial','novo teste','ESTREITO','','0000-00-00','DEFERIDO','TESTE',''),(19,'LU2110','asfd@asdf','1234','01822623923','DULCEMAR BECKER','LUANA','LIBERATO BITENCOURT',102,1,'88000100','100.00','234.00','23.00','Residencial privativa multifamiliar','Médio','Nova','Madeira',2,2,'Gravitacional','S','joao','juliana','jujuba','1234569','1237891','9876543','1','1','1','1','1','1','1','1','1','Com detecção','Bloco autônomo','Eletrogeométrico','Transportável','Predial','iiiiii','ESTREITO','','0000-00-00','DEFERIDO','TESTE',''),(21,'LU2110','asfd@asdf','1234','01822623923','DULCEMAR BECKER','LUANA','LIBERATO BITENCOURT',102,1,'88000100','100.00','234.00','23.00','Residencial privativa unifamiliar','Leve','Existente','Alvenaria',2,2,'','S','joao','','','1234569','','','0','0','0','0','0','0','0','0','0','','','','','','','ESTREITO','E','0000-00-00','DEFERIDO','TESTE',''),(22,'LU2110','asfd@asdf','1234','01822623923','DULCEMAR BECKER','LUANA','LIBERATO BITENCOURT',102,1,'88000100','100.00','234.00','23.00','Residencial privativa unifamiliar','Leve','Existente','Alvenaria',2,2,'','','joao','','','1234569','','','0','0','0','0','0','0','0','0','0','','','','','','','ESTREITO','V','0000-00-00','DEFERIDO','luana','teste'),(23,'LU2110','asfd@asdf','1234','01822623923','DULCEMAR BECKER','LUANA','LIBERATO BITENCOURT',102,1,'88000100','100.00','234.00','23.00','Residencial privativa unifamiliar','Médio','Nova','Madeira',2,2,'','S','joao','','','1234569','','','0','0','0','0','0','0','0','0','0','','','','','','','ESTREITO','A','0000-00-00','DEFERIDO','TESTE',''),(24,'LU2110','asfd@asdf','1234','01822623923','DULCEMAR BECKER','LUANA','LIBERATO BITENCOURT',102,1,'88000100','100.00','234.00','23.00','Residencial privativa unifamiliar','Médio','Existente','Alvenaria',2,1,'','','joao','','','1234569','','','0','0','0','0','0','0','0','0','0','','','','','','','ESTREITO','','0000-00-00','DEFERIDO','TESTE',''),(25,'LU2110','asfd@asdf','1234','01822623923','DULCEMAR BECKER','LUANA','LIBERATO BITENCOURT',102,1,'88000100','100.00','234.00','23.00','Residencial privativa unifamiliar','Médio','Existente','Alvenaria',2,1,'','','joao','','','1234569','','','0','0','0','0','0','0','0','0','0','','','','','','','ESTREITO','V','2009-09-17','DEFERIDO','TESTE',''),(28,'LU2110','asfd@asdf','1234','01822623923','DULCEMAR BECKER','LUANA','LIBERATO BITENCOURT',102,1,'88000100','100.00','234.00','23.00','Residencial privativa multifamiliar','Leve','Existente','Alvenaria',2,2,'Gravitacional','','joazinho','','','1234569','','','2','2','2','2','1','2','2','2','1','Com detecção','Bloco autônomo','Eletrogeométrico','Transportável','Predial','','ESTREITO','V','2009-10-13','DEFERIDO','luana','deferido após análise.'),(30,'LU2110','asfd@asdf','1234','01822623923','DULCEMAR BECKER','LUANA','LIBERATO BITENCOURT',102,1,'88000100','100.00','234.00','23.00','Residencial privativa multifamiliar','Leve','Existente','Alvenaria',2,1,'','','joao','','','1234569','','','0','0','0','0','0','0','0','0','0','','','','','','','ESTREITO','V','2009-10-14','DEFERIDO','lalalalla','obs'),(31,'LU2110','asfd@asdf','1234','01822623923','DULCEMAR BECKER','LUANA','LIBERATO BITENCOURT',102,1,'88000100','100.00','234.00','23.00','Residencial privativa multifamiliar','Leve','Existente','Alvenaria',2,1,'','','joao','','','1234569','','','0','0','0','0','0','0','0','0','0','','','','','','','disnopolandia','V','2009-10-14','DEFERIDO','analista','bahbahbahbahbahbah'),(34,'LU2110','asfd@asdf','1234','01822623923','DULCEMAR BECKER','LUANA','LIBERATO BITENCOURT',102,1,'88070450','122.00','234.00','23.00','Residencial privativa multifamiliar','Leve','Existente','Alvenaria',2,1,'Por bombas','','joao','','','1234569','','','3','1','1','1','1','1','1','1','1','Com detecção','Bloco autônomo','Eletrogeométrico','Transportável','Predial','','ESTREITO','V','2009-10-21','DEFERIDO','luana','teste');
/*!40000 ALTER TABLE `SOLIC_PROJETO` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2010-06-19 12:21:34
