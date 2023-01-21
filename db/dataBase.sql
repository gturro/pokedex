-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema pokedex
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `pokedex` ;

-- -----------------------------------------------------
-- Schema pokedex
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `pokedex` DEFAULT CHARACTER SET utf8 ;
USE `pokedex` ;

-- -----------------------------------------------------
-- Table `pokedex`.`regiones`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pokedex`.`regiones` ;

CREATE TABLE IF NOT EXISTS `pokedex`.`regiones` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pokedex`.`pokemons`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pokedex`.`pokemons` ;

CREATE TABLE IF NOT EXISTS `pokedex`.`pokemons` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `numero` VARCHAR(3) NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  `altura` INT NULL,
  `peso` DECIMAL(5,2) NULL,
  `evolucion` VARCHAR(45) NULL,
  `imagen` VARCHAR(255) NULL,
  `regiones_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `numero_UNIQUE` (`numero` ASC),
  UNIQUE INDEX `nombre_UNIQUE` (`nombre` ASC),
  UNIQUE INDEX `imagen_UNIQUE` (`imagen` ASC),
  INDEX `fk_pokemons_regiones_idx` (`regiones_id` ASC),
  CONSTRAINT `fk_pokemons_regiones`
    FOREIGN KEY (`regiones_id`)
    REFERENCES `pokedex`.`regiones` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pokedex`.`tipos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pokedex`.`tipos` ;

CREATE TABLE IF NOT EXISTS `pokedex`.`tipos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `nobre_UNIQUE` (`nombre` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pokedex`.`tipos_has_pokemons`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pokedex`.`tipos_has_pokemons` ;

CREATE TABLE IF NOT EXISTS `pokedex`.`tipos_has_pokemons` (
  `tipos_id` INT NOT NULL,
  `pokemons_id` INT NOT NULL,
  PRIMARY KEY (`tipos_id`, `pokemons_id`),
  INDEX `fk_tipos_has_pokemons_pokemons1_idx` (`pokemons_id` ASC),
  INDEX `fk_tipos_has_pokemons_tipos1_idx` (`tipos_id` ASC),
  CONSTRAINT `fk_tipos_has_pokemons_tipos1`
    FOREIGN KEY (`tipos_id`)
    REFERENCES `pokedex`.`tipos` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tipos_has_pokemons_pokemons1`
    FOREIGN KEY (`pokemons_id`)
    REFERENCES `pokedex`.`pokemons` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `pokedex`.`regiones`
-- -----------------------------------------------------
START TRANSACTION;
USE `pokedex`;
INSERT INTO `pokedex`.`regiones` (`id`, `nombre`) VALUES (1, 'Kanto');
INSERT INTO `pokedex`.`regiones` (`id`, `nombre`) VALUES (2, 'Jotho');
INSERT INTO `pokedex`.`regiones` (`id`, `nombre`) VALUES (3, 'Hoenn');
INSERT INTO `pokedex`.`regiones` (`id`, `nombre`) VALUES (4, 'Sinnoh ');
INSERT INTO `pokedex`.`regiones` (`id`, `nombre`) VALUES (5, 'Teselia');

COMMIT;


-- -----------------------------------------------------
-- Data for table `pokedex`.`pokemons`
-- -----------------------------------------------------
START TRANSACTION;
USE `pokedex`;

INSERT INTO `pokedex`.`pokemons` (`id`, `numero`, `nombre`, `altura`, `peso`, `evolucion`, `imagen`, `regiones_id`) VALUES (DEFAULT, "001", "Bulbasur", 70, 6.9, "Not evolved", "/pokedex/media/pokemons/001.png", 1);
INSERT INTO `pokedex`.`pokemons` (`id`, `numero`, `nombre`, `altura`, `peso`, `evolucion`, `imagen`, `regiones_id`) VALUES (DEFAULT, "002", "Ivysaur", 100, 13, "First evolution", "/pokedex/media/pokemons/002.png", 1);
INSERT INTO `pokedex`.`pokemons` (`id`, `numero`, `nombre`, `altura`, `peso`, `evolucion`, `imagen`, `regiones_id`) VALUES (DEFAULT, "003","Venusaur", 200, 100, "Second evolution", "/pokedex/media/pokemons/003.png", 1);
INSERT INTO `pokedex`.`pokemons` (`id`, `numero`, `nombre`, `altura`, `peso`, `evolucion`, `imagen`, `regiones_id`) VALUES (DEFAULT, "004", "Charmander", 60, 8.5,  "Not evolved", "/pokedex/media/pokemons/004.png", 2);
INSERT INTO `pokedex`.`pokemons` (`id`, `numero`, `nombre`, `altura`, `peso`, `evolucion`, `imagen`, `regiones_id`) VALUES (DEFAULT, "005", "Charmeleon", 110, 19, "First evolution", "/pokedex/media/pokemons/005.png", 2);
INSERT INTO `pokedex`.`pokemons` (`id`, `numero`, `nombre`, `altura`, `peso`, `evolucion`, `imagen`, `regiones_id`) VALUES (DEFAULT, "006", "Charizard", 170, 90.5, "Second evolution", "/pokedex/media/pokemons/006.png", 2);
INSERT INTO `pokedex`.`pokemons` (`id`, `numero`, `nombre`, `altura`, `peso`, `evolucion`, `imagen`, `regiones_id`) VALUES (DEFAULT, "007", "Squirtle", 50, 9, "Not evolved", "/pokedex/media/pokemons/007.png", 1);
INSERT INTO `pokedex`.`pokemons` (`id`, `numero`, `nombre`, `altura`, `peso`, `evolucion`, `imagen`, `regiones_id`) VALUES (DEFAULT, "008", "Wartortle", 100, 22.5, "First evolution", "/pokedex/media/pokemons/008.png", 1);
INSERT INTO `pokedex`.`pokemons` (`id`, `numero`, `nombre`, `altura`, `peso`, `evolucion`, `imagen`, `regiones_id`) VALUES (DEFAULT, "009", "Blastoise", 160, 85.5, "Second evolution", "/pokedex/media/pokemons/009.png", 1);
INSERT INTO `pokedex`.`pokemons` (`id`, `numero`, `nombre`, `altura`, `peso`, `evolucion`, `imagen`, `regiones_id`) VALUES (DEFAULT, "010", "Caterpie", 30, 2.9, "Not evolved", "/pokedex/media/pokemons/010.png", 3);    
INSERT INTO `pokedex`.`pokemons` (`id`, `numero`, `nombre`, `altura`, `peso`, `evolucion`, `imagen`, `regiones_id`) VALUES (DEFAULT, "666", "Satan", 200, 100, "Second evolution", "/pokedex/media/pokemons/666.png", 4);    
INSERT INTO `pokedex`.`pokemons` (`id`, `numero`, `nombre`, `altura`, `peso`, `evolucion`, `imagen`, `regiones_id`) VALUES (DEFAULT, "114", "Yolandi Visser", 156, 45, "First evolution", "/pokedex/media/pokemons/114.png", 4);    
INSERT INTO `pokedex`.`pokemons` (`id`, `numero`, `nombre`, `altura`, `peso`, `evolucion`, `imagen`, `regiones_id`) VALUES (DEFAULT, "999", "Sauron", 280, 175, "Second evolution", "/pokedex/media/pokemons/999.png", 4);    
COMMIT;


-- -----------------------------------------------------
-- Data for table `pokedex`.`tipos`
-- -----------------------------------------------------
START TRANSACTION;
USE `pokedex`;
INSERT INTO `pokedex`.`tipos` (`id`, `nombre`) VALUES (1, 'Grass');
INSERT INTO `pokedex`.`tipos` (`id`, `nombre`) VALUES (2, 'Poison');
INSERT INTO `pokedex`.`tipos` (`id`, `nombre`) VALUES (3, 'Fire');
INSERT INTO `pokedex`.`tipos` (`id`, `nombre`) VALUES (4, 'Flying');
INSERT INTO `pokedex`.`tipos` (`id`, `nombre`) VALUES (5, 'Water');
INSERT INTO `pokedex`.`tipos` (`id`, `nombre`) VALUES (6, 'Electric');
INSERT INTO `pokedex`.`tipos` (`id`, `nombre`) VALUES (7, 'Fairy');
INSERT INTO `pokedex`.`tipos` (`id`, `nombre`) VALUES (8, 'Bug');
INSERT INTO `pokedex`.`tipos` (`id`, `nombre`) VALUES (9, 'Fighting');
INSERT INTO `pokedex`.`tipos` (`id`, `nombre`) VALUES (10, 'Psychic');

COMMIT;


-- -----------------------------------------------------
-- Data for table `pokedex`.`tipos_has_pokemons`
-- -----------------------------------------------------
START TRANSACTION;
USE `pokedex`;

INSERT INTO `pokedex`.`tipos_has_pokemons` (`tipos_id`, `pokemons_id`) VALUES (1, 1);
INSERT INTO `pokedex`.`tipos_has_pokemons` (`tipos_id`, `pokemons_id`) VALUES (2, 1);
INSERT INTO `pokedex`.`tipos_has_pokemons` (`tipos_id`, `pokemons_id`) VALUES (1, 2);
INSERT INTO `pokedex`.`tipos_has_pokemons` (`tipos_id`, `pokemons_id`) VALUES (2, 2);
INSERT INTO `pokedex`.`tipos_has_pokemons` (`tipos_id`, `pokemons_id`) VALUES (1, 3);
INSERT INTO `pokedex`.`tipos_has_pokemons` (`tipos_id`, `pokemons_id`) VALUES (2, 3);
INSERT INTO `pokedex`.`tipos_has_pokemons` (`tipos_id`, `pokemons_id`) VALUES (3, 4);
INSERT INTO `pokedex`.`tipos_has_pokemons` (`tipos_id`, `pokemons_id`) VALUES (3, 5);
INSERT INTO `pokedex`.`tipos_has_pokemons` (`tipos_id`, `pokemons_id`) VALUES (3, 6);
INSERT INTO `pokedex`.`tipos_has_pokemons` (`tipos_id`, `pokemons_id`) VALUES (4, 6);
INSERT INTO `pokedex`.`tipos_has_pokemons` (`tipos_id`, `pokemons_id`) VALUES (5, 7);
INSERT INTO `pokedex`.`tipos_has_pokemons` (`tipos_id`, `pokemons_id`) VALUES (5, 8);
INSERT INTO `pokedex`.`tipos_has_pokemons` (`tipos_id`, `pokemons_id`) VALUES (5, 9);
INSERT INTO `pokedex`.`tipos_has_pokemons` (`tipos_id`, `pokemons_id`) VALUES (8, 10);
INSERT INTO `pokedex`.`tipos_has_pokemons` (`tipos_id`, `pokemons_id`) VALUES (3, 11);
INSERT INTO `pokedex`.`tipos_has_pokemons` (`tipos_id`, `pokemons_id`) VALUES (9, 11);
INSERT INTO `pokedex`.`tipos_has_pokemons` (`tipos_id`, `pokemons_id`) VALUES (10, 11);
INSERT INTO `pokedex`.`tipos_has_pokemons` (`tipos_id`, `pokemons_id`) VALUES (7, 12);
INSERT INTO `pokedex`.`tipos_has_pokemons` (`tipos_id`, `pokemons_id`) VALUES (9, 12);
INSERT INTO `pokedex`.`tipos_has_pokemons` (`tipos_id`, `pokemons_id`) VALUES (10, 12);
INSERT INTO `pokedex`.`tipos_has_pokemons` (`tipos_id`, `pokemons_id`) VALUES (3, 13);
INSERT INTO `pokedex`.`tipos_has_pokemons` (`tipos_id`, `pokemons_id`) VALUES (6, 13);
INSERT INTO `pokedex`.`tipos_has_pokemons` (`tipos_id`, `pokemons_id`) VALUES (9, 13);
INSERT INTO `pokedex`.`tipos_has_pokemons` (`tipos_id`, `pokemons_id`) VALUES (10, 13);
COMMIT;

SELECT * from pokemons;
SELECT * from tipos;
-- SELECT tipos_has_pokemons.tipos_id, tipos.nombre FROM tipos_has_pokemons INNER JOIN tipos ON tipos.id = tipos_has_pokemons.tipos_id WHERE tipos_has_pokemons.pokemons_id = 1; --
-- SELECT * from pokemons INNER JOIN tipos_has_pokemons WHERE tipos_has_pokemons.pokemons_id = pokemons.id;
SELECT * FROM tipos_has_pokemons;
 

-- SELECT tipos_has_pokemons.tipos_id as typeID, tipos.nombre as typeName FROM tipos_has_pokemons INNER JOIN tipos ON tipos.id = tipos_has_pokemons.tipos_id WHERE tipos_has_pokemons.pokemons_id = 1;

-- DELETE FROM pokemons where id = 6;
-- UPDATE pokemons SET numero = "222" WHERE id = 4;

-- INSERT INTO tipos_has_pokemons SELECT tipos.id, 1 FROM tipos WHERE tipos.nombre = "Lucha";
