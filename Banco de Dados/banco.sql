-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema db_banco_digital
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema db_banco_digital
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `db_banco_digital` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci ;
USE `db_banco_digital` ;

-- -----------------------------------------------------
-- Table `db_banco_digital`.`Correntista`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_banco_digital`.`Correntista` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `cpf` CHAR(11) NOT NULL,
  `data_nasc` DATE NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `senha` VARCHAR(255) NOT NULL,
  `data_cadastro` TIMESTAMP NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `cpf_UNIQUE` (`cpf` ASC) VISIBLE)
ENGINE = InnoDB
AUTO_INCREMENT = 1;


-- -----------------------------------------------------
-- Table `db_banco_digital`.`Conta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_banco_digital`.`Conta` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `tipo` ENUM("C", "P") NOT NULL,
  `saldo` DOUBLE NOT NULL,
  `limite` DOUBLE NOT NULL,
  `data_abertura` TIMESTAMP NOT NULL,
  `id_cliente` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_conta_correntista_idx` (`id_cliente` ASC) VISIBLE,
  CONSTRAINT `fk_conta_correntista`
    FOREIGN KEY (`id_cliente`)
    REFERENCES `db_banco_digital`.`Correntista` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1;


-- -----------------------------------------------------
-- Table `db_banco_digital`.`Chave_Pix`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_banco_digital`.`Chave_Pix` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `chave` VARCHAR(150) NOT NULL,
  `tipo` VARCHAR(10) NOT NULL,
  `id_conta` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_id_conta_idx` (`id_conta` ASC) VISIBLE,
  UNIQUE INDEX `chave_UNIQUE` (`chave` ASC) VISIBLE,
  CONSTRAINT `fk_chave_pix_conta`
    FOREIGN KEY (`id_conta`)
    REFERENCES `db_banco_digital`.`Conta` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1;


-- -----------------------------------------------------
-- Table `db_banco_digital`.`Transacao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_banco_digital`.`Transacao` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `valor` DOUBLE NOT NULL,
  `data_transacao` TIMESTAMP NOT NULL,
  `id_conta_enviou` INT NOT NULL,
  `id_conta_recebeu` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_conta_enviou_transacao_idx` (`id_conta_enviou` ASC) VISIBLE,
  INDEX `fk_conta_recebeu_transacao_idx` (`id_conta_recebeu` ASC) VISIBLE,
  CONSTRAINT `fk_conta_enviou_transacao`
    FOREIGN KEY (`id_conta_enviou`)
    REFERENCES `db_banco_digital`.`Conta` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_conta_recebeu_transacao`
    FOREIGN KEY (`id_conta_recebeu`)
    REFERENCES `db_banco_digital`.`Conta` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
