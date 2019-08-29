-- MySQL dump 10.16  Distrib 10.1.30-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: GetURI
-- ------------------------------------------------------
-- Server version	10.1.30-MariaDB

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
-- Table structure for table `Institution`
--

DROP TABLE IF EXISTS `Institution`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Institution` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Institution`
--

LOCK TABLES `Institution` WRITE;
/*!40000 ALTER TABLE `Institution` DISABLE KEYS */;
INSERT INTO `Institution` VALUES (1,'Institution 1'),(3,'Institution UPDATED'),(4,'FBI');
/*!40000 ALTER TABLE `Institution` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `SClass`
--

DROP TABLE IF EXISTS `SClass`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SClass` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SClass`
--

LOCK TABLES `SClass` WRITE;
/*!40000 ALTER TABLE `SClass` DISABLE KEYS */;
INSERT INTO `SClass` VALUES (1,'SClass 1'),(2,'SClass UPDATED'),(10,'Test Class');
/*!40000 ALTER TABLE `SClass` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Student`
--

DROP TABLE IF EXISTS `Student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Student` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `place` int(11) NOT NULL,
  `since` date NOT NULL,
  `points` float NOT NULL,
  `tried` int(11) NOT NULL,
  `submission` int(11) NOT NULL,
  `idInstitution` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Student`
--

LOCK TABLES `Student` WRITE;
/*!40000 ALTER TABLE `Student` DISABLE KEYS */;
INSERT INTO `Student` VALUES (1,'STUDENT 1',100,'2000-02-01',140.7,9,10,1),(2,'STUDENT 2',200,'2010-02-10',123.7,23,4,1),(4,'Student UPDATED',444,'2010-02-14',144.4,44,44,1),(5,'Student FBI',111,'2011-11-11',111.11,11,11,4);
/*!40000 ALTER TABLE `Student` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Student_has_SClass`
--

DROP TABLE IF EXISTS `Student_has_SClass`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Student_has_SClass` (
  `idStudent` int(11) NOT NULL,
  `idSClass` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Student_has_SClass`
--

LOCK TABLES `Student_has_SClass` WRITE;
/*!40000 ALTER TABLE `Student_has_SClass` DISABLE KEYS */;
INSERT INTO `Student_has_SClass` VALUES (1,2),(2,2),(4,1),(1,7),(2,10),(4,10),(5,10);
/*!40000 ALTER TABLE `Student_has_SClass` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-08-06 20:15:05
