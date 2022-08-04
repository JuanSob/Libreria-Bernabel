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
  PRIMARY KEY (`VentaId`),
  KEY `IX_Relationship9` (`UsuarioId`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;