CREATE TABLE `proyectolibreria`.`media` (
  `MediaId` INT NOT NULL AUTO_INCREMENT,
  `MediaDoc` VARCHAR(80) NOT NULL,
  `MediaPath` VARCHAR(150) NOT NULL,
  `LibrodId` INT NULL DEFAULT NULL,
  PRIMARY KEY (`MediaId`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;