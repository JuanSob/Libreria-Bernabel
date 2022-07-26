CREATE TABLE `proyectolibreria`.`funcionesroles` (
  `RolId` VARCHAR(15) NOT NULL,
  `FuncionId` VARCHAR(255) NOT NULL,
  `FuncionRolEst` CHAR(3) NOT NULL,
  `FuncionExp` DATETIME NOT NULL,
  PRIMARY KEY (`RolId`, `FuncionId`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;
