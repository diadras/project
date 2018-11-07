-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema project
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `project` DEFAULT CHARACTER SET utf8 ;
USE `project` ;

-- -----------------------------------------------------
-- Table `project`.`categories`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `project`.`categories` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `project`.`hashtags`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `project`.`hashtags` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `data` TEXT NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `project`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `project`.`users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(45) NOT NULL,
  `password` TEXT NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `level` INT(11) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `project`.`messages`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `project`.`messages` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `data` TEXT NOT NULL,
  `users_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_messages_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `project`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `project`.`posts`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `project`.`posts` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `photodata` TEXT NOT NULL,
  `recipe` TEXT NULL DEFAULT NULL,
  `users_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_posts_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `project`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `project`.`posts_has_categories`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `project`.`posts_has_categories` (
  `posts_id` INT(11) NOT NULL,
  `categories_id` INT(11) NOT NULL,
  PRIMARY KEY (`posts_id`, `categories_id`),
  CONSTRAINT `fk_posts_has_categories_categories1`
    FOREIGN KEY (`categories_id`)
    REFERENCES `project`.`categories` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_posts_has_categories_posts1`
    FOREIGN KEY (`posts_id`)
    REFERENCES `project`.`posts` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `project`.`posts_has_hashtags`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `project`.`posts_has_hashtags` (
  `posts_id` INT(11) NOT NULL,
  `hashtags_id` INT(11) NOT NULL,
  PRIMARY KEY (`posts_id`, `hashtags_id`),
  CONSTRAINT `fk_posts_has_hashtags_hashtags1`
    FOREIGN KEY (`hashtags_id`)
    REFERENCES `project`.`hashtags` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_posts_has_hashtags_posts1`
    FOREIGN KEY (`posts_id`)
    REFERENCES `project`.`posts` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
