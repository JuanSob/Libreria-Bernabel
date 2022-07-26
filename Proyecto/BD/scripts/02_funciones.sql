CREATE TABLE `proyectolibreria`.`funciones` (
  `FuncionId` VARCHAR(255) NOT NULL,
  `FuncionDsc` VARCHAR(45) NOT NULL,
  `FuncionEst` CHAR(3) NOT NULL,
  `FuncionTipo` CHAR(3) NOT NULL,
  PRIMARY KEY (`FuncionId`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;
