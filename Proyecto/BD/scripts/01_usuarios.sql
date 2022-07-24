CREATE TABLE `proyectolibreria`.`usuarios` (
  `UsuarioId` INT NOT NULL AUTO_INCREMENT,
  `UsuarioEmail` VARCHAR(80) NOT NULL,
  `UsuarioNombre` VARCHAR(80) NOT NULL,
  `UsuarioPswd` VARCHAR(128) NOT NULL,
  `UsuarioFching` DATETIME NOT NULL,
  `UsuarioPswdEst` CHAR(3) NOT NULL,
  `UsuarioPswdExp` DATETIME NOT NULL,
  `UsuarioEst` CHAR(3) NOT NULL,
  `UsuarioActCod` VARCHAR(128) NOT NULL,
  `UsuarioPswdChg` VARCHAR(128) NOT NULL,
  `UsuarioTipo` CHAR(3) NOT NULL,
  `ClienteDireccion` VARCHAR(180) NULL DEFAULT NULL,
  `ClienteTelefono` VARCHAR(20) NULL DEFAULT NULL,
  PRIMARY KEY (`UsuarioId`),
  UNIQUE INDEX `UsuarioEmail_UNIQUE` (`UsuarioEmail` ASC) VISIBLE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;
