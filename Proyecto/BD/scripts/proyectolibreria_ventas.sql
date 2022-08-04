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
-- Table structure for table `ventas`
--

DROP TABLE IF EXISTS `ventas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ventas` (
  `VentaId` int NOT NULL AUTO_INCREMENT,
  `VentaFecha` datetime NOT NULL,
  `VentaISV` decimal(9,2) NOT NULL,
  `VentaEst` varchar(10) NOT NULL,
  `VentaLinkDevolucion` varchar(100) DEFAULT NULL,
  `VentaLinkOrden` varchar(100) DEFAULT NULL,
  `VentaCantidadTotal` decimal(9,2) DEFAULT NULL,
  `VentaComisionPayPal` decimal(9,2) DEFAULT NULL,
  `VentaCantidadNeta` decimal(9,2) DEFAULT NULL,
  `ClienteDireccion` char(180) DEFAULT NULL,
  `ClienteTelefono` char(20) DEFAULT NULL,
  `UsuarioId` int DEFAULT NULL,
  PRIMARY KEY (`VentaId`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ventas`
--

LOCK TABLES `ventas` WRITE;
/*!40000 ALTER TABLE `ventas` DISABLE KEYS */;
INSERT INTO `ventas` VALUES (1,'2022-08-03 21:36:49',0.15,'ENVIADO','https://api.sandbox.paypal.com/v2/payments/captures/2WD071132T234090C/refund','https://api.sandbox.paypal.com/v2/checkout/orders/1W427880D8893963T',5515.89,277.66,5238.23,'Francisco Morazan, Tegucigalpa, El trapiche,','96341265',9),(2,'2022-08-03 21:41:14',0.15,'PND','https://api.sandbox.paypal.com/v2/payments/captures/44G87270RL7729157/refund','https://api.sandbox.paypal.com/v2/checkout/orders/9JA26690YS343461C',2709.58,140.18,2569.40,'Francisco Morazan, Tegucigalpa, El trapiche, El trapiche','96341265',9),(3,'2022-08-03 21:46:14',0.15,'ENVIADO','https://api.sandbox.paypal.com/v2/payments/captures/5AM10989F5018815A/refund','https://api.sandbox.paypal.com/v2/checkout/orders/2UX68557Y1894710W',1654.67,88.38,1566.29,'Francisco Morazan, Tegucigalpa, El trapiche,','96341265',9),(4,'2022-08-03 21:52:42',0.15,'PND','https://api.sandbox.paypal.com/v2/payments/captures/451327401W973154G/refund','https://api.sandbox.paypal.com/v2/checkout/orders/63V45299J5962564N',5515.89,277.66,5238.23,'Francisco Morazan, Tegucigalpa, El trapiche,','96341265',9),(5,'2022-08-03 21:55:26',0.15,'PND','https://api.sandbox.paypal.com/v2/payments/captures/1KA44867N0976305N/refund','https://api.sandbox.paypal.com/v2/checkout/orders/59977619YV551904X',3217.03,164.98,3052.06,'Francisco Morazan, Tegucigalpa, El trapiche,','96341265',9),(6,'2022-08-03 21:59:17',0.15,'PND','https://api.sandbox.paypal.com/v2/payments/captures/61W92052GM5898243/refund','https://api.sandbox.paypal.com/v2/checkout/orders/5N306309NR016910E',3612.78,184.37,3428.41,'Francisco Morazan, Tegucigalpa, El trapiche,','96341265',9),(7,'2022-08-03 22:01:32',0.15,'PND','https://api.sandbox.paypal.com/v2/payments/captures/5CH75121L20360640/refund','https://api.sandbox.paypal.com/v2/checkout/orders/03K48985H02684703',1608.52,86.17,1522.35,'Francisco Morazan, Tegucigalpa, El trapiche,','96341265',9),(8,'2022-08-03 22:53:43',0.15,'ENVIADO','https://api.sandbox.paypal.com/v2/payments/captures/2D835562H6349933G/refund','https://api.sandbox.paypal.com/v2/checkout/orders/58P46067841629237',3981.52,202.54,3778.98,'Francisco Morazan, Tegucigalpa, El trapiche,','96341265',9);
/*!40000 ALTER TABLE `ventas` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-08-03 23:39:08
