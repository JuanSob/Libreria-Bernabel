CREATE TABLE `proyectolibreria`.`libros` (
  `LibrodId` INT NOT NULL AUTO_INCREMENT,
  `LibroNombre` VARCHAR(120) NOT NULL,
  `LibroDescripcion` VARCHAR(500) NOT NULL,
  `LibroPrecioVenta` DECIMAL(9,2) NOT NULL,
  `LibroPrecioCompra` DECIMAL(9,2) NOT NULL,
  `LibroEst` CHAR(3) NOT NULL,
  `LibroStock` INT NOT NULL,
  PRIMARY KEY (`LibrodId`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;
