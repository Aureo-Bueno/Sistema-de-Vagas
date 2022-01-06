-- MySQL dump 10.13  Distrib 8.0.26, for Win64 (x86_64)
--
-- Host: localhost    Database: sistem_vagas
-- ------------------------------------------------------
-- Server version	8.0.26

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Aureo Bueno','aureo@live.com','$2y$10$IZB3TIpYA0aPP4U5Adls0ed3Idelm548Hko92MIFBTkYq2CZHpGnW'),(2,'Andre Pinheiro','andre@live.com','$2y$10$VPQ9hfi8oC/prTc7H2WNMe.yMxtBAp.tPT0OqclNFu4B4/fq2bB1q');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vagas`
--

DROP TABLE IF EXISTS `vagas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vagas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `descricao` text NOT NULL,
  `ativo` enum('s','n') NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vagas`
--

LOCK TABLES `vagas` WRITE;
/*!40000 ALTER TABLE `vagas` DISABLE KEYS */;
INSERT INTO `vagas` VALUES (4,'Programador FullStack','Backend PHP,JavaScript,NodeJS','s','2020-11-11 20:51:05'),(6,'Analista','Saiba Backend,PHPOO,MYSQL,JS','s','2020-11-11 21:42:45'),(8,'Programador C#','Programador Mobile','s','2020-11-13 17:18:06'),(9,'Programador C++','Programaçao Desktop.','n','2020-11-13 17:19:04'),(10,'Engenheiro de Software','Desejavel, ReactJS,NodeJS','s','2020-11-13 17:19:58'),(11,'Programador Frontend','Desejavel, HTML5, CSS3.','n','2020-11-13 17:20:40'),(12,'Analista Junior','Desejavel cursando Superior','s','2020-11-13 17:21:50'),(13,'Programador Pleno','Desejavel Backend','n','2020-11-13 17:22:14'),(14,'Programador Sênior','Fullstack','s','2020-11-13 17:23:39'),(15,'Engenheiro da Computação','Desenvolvedor C++ e Arduino','s','2020-11-13 18:02:20'),(16,'Backend','PHP,C#,JS,NODEJS','s','2020-11-13 20:31:54'),(18,'DataScience Junior','Data science','s','2020-11-13 20:33:31'),(19,'Programador VueJS','VueJS','s','2020-11-13 20:33:49'),(20,'Analista de sistemas Junior','CRUD,PHP E MYSQL','s','2020-11-13 20:34:48'),(21,'Analista de Sistemas Sênior','PHP Orientado a Objetos','s','2020-11-13 20:35:13');
/*!40000 ALTER TABLE `vagas` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-12-18 16:10:40
