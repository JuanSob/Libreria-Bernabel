-- MySQL dump 10.13  Distrib 8.0.28, for Win64 (x86_64)
--
-- Host: localhost    Database: proyectolibreria
-- ------------------------------------------------------
-- Server version	8.0.28

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
  `UsuarioId` int NOT NULL AUTO_INCREMENT,
  `UsuarioEmail` varchar(80) NOT NULL,
  `UsuarioNombre` varchar(80) NOT NULL,
  `UsuarioPswd` varchar(128) NOT NULL,
  `UsuarioFching` datetime NOT NULL,
  `UsuarioPswdEst` char(3) NOT NULL,
  `UsuarioPswdExp` datetime NOT NULL,
  `UsuarioEst` char(3) NOT NULL,
  `UsuarioActCod` varchar(128) NOT NULL,
  `UsuarioPswdChg` varchar(128) NOT NULL,
  `UsuarioTipo` char(3) NOT NULL,
  `ClienteDireccion` varchar(180) DEFAULT NULL,
  `ClienteTelefono` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`UsuarioId`),
  UNIQUE KEY `UsuarioEmail_UNIQUE` (`UsuarioEmail`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (7,'admin@demo.com','Juan','$2y$10$D5lvyPk0Ce/fbQRf.CMUw.U0LiEH/ja9veB3IKh7/ZoyzAjlv3qr2','2022-07-25 16:35:37','ACT','2022-10-23 00:00:00','ACT','81704e1e52c4124d3ca5ed6d7dde8948c0e5c68df64cd47f9bb3ed6da8fd83c6','2022-07-25 16:35:37','ADM',NULL,NULL),(9,'vini05@gmail.com','Vinicius','$2y$10$4H9IEGQI.q5.2lVns2u0bed1b3lJADM5aeQUWKHyj.zFKMhUwMLhm','2022-07-26 00:22:02','ACT','2022-10-24 00:00:00','ACT','2bf718385f76bcf024914831e3c4f196b1c5ff0e93a2eff7497f95c9e2237de3','2022-07-26 00:22:02','PBL',NULL,NULL);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-07-30 12:58:56
