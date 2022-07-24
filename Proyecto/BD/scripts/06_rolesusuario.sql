CREATE TABLE `proyectolibreria`.`rolesusuario` (
  `UsuarioId` INT NOT NULL,
  `RolId` VARCHAR(15) NOT NULL,
  `RolUsuarioEst` CHAR(3) NOT NULL,
  `RolUsuarioFch` DATETIME NOT NULL,
  `RolUsuarioExp` DATETIME NOT NULL,
  PRIMARY KEY (`UsuarioId`, `RolId`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;