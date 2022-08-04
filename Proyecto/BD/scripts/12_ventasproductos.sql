CREATE TABLE `ventasproductos` (
  `LibrodId` int NOT NULL,
  `VentaId` int NOT NULL,
  `VentasProdCantidad` int NOT NULL,
  `VentasProdPrecioVenta` decimal(9,2) NOT NULL,
  PRIMARY KEY (`LibrodId`,`VentaId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
