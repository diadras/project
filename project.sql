-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALid_DATES';

-- -----------------------------------------------------
-- Schema project
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema project
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `project` DEFAULT CHARACTER SET utf8 ;
USE `project` ;

-- -----------------------------------------------------
-- Table `project`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `project`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(45) NOT NULL,
  `password` TEXT NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `level` INT NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `project`.`posts`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `project`.`posts` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `photodata` TEXT NOT NULL,
  `recipe` TEXT NULL,
  `gebruikers_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_posts_gebruikers1_idx` (`gebruikers_id` ASC),
  CONSTRAINT `fk_posts_gebruikers1`
    FOREIGN KEY (`gebruikers_id`)
    REFERENCES `project`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `project`.`hashtags`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `project`.`hashtags` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `data` TEXT NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `project`.`category`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `project`.`category` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `project`.`message`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `project`.`message` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `data` TEXT NOT NULL,
  `users_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_message_users1_idx` (`users_id` ASC),
  CONSTRAINT `fk_message_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `project`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `project`.`posts_has_hashtags`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `project`.`posts_has_hashtags` (
  `posts_id` INT NOT NULL
  `hashtags_id` INT NOT NULL,
  PRIMARY KEY (`posts_id`, `hashtags_id`),
  INDEX `fk_posts_has_hashtags_hashtags1_idx` (`hashtags_id` ASC),
  INDEX `fk_posts_has_hashtags_posts1_idx` (`posts_id` ASC),
  CONSTRAINT `fk_posts_has_hashtags_posts1`
    FOREIGN KEY (`posts_id`)
    REFERENCES `project`.`posts` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_posts_has_hashtags_hashtags1`
    FOREIGN KEY (`hashtags_id`)
    REFERENCES `project`.`hashtags` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `project`.`posts_has_category`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `project`.`posts_has_category` (
  `posts_id` INT NOT NULL,
  `category_id` INT NOT NULL,
  PRIMARY KEY (`posts_id`, `category_id`),
  INDEX `fk_posts_has_category_category1_idx` (`category_id` ASC),
  INDEX `fk_posts_has_category_posts1_idx` (`posts_id` ASC),
  CONSTRAINT `fk_posts_has_category_posts1`
    FOREIGN KEY (`posts_id`)
    REFERENCES `project`.`posts` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_posts_has_category_category1`
    FOREIGN KEY (`category_id`)
    REFERENCES `project`.`category` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
