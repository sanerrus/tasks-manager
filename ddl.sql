SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema tasks
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema tasks
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `tasks` DEFAULT CHARACTER SET utf8 ;
USE `tasks` ;

-- -----------------------------------------------------
-- Table `tasks`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tasks`.`users` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(64) NOT NULL,
  `is_active` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COMMENT = 'Таблица пользователей (простая)';

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'user 1',1),(2,'user 2',1),(3,'user 3',1),(4,'user 4',1),(5,'user 5',1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;


-- -----------------------------------------------------
-- Table `tasks`.`task_statuses`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tasks`.`task_statuses` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COMMENT = 'Таблица статусов задач';

LOCK TABLES `task_statuses` WRITE;
/*!40000 ALTER TABLE `task_statuses` DISABLE KEYS */;
INSERT INTO `task_statuses` VALUES (1,'Взят в работу'),(3,'Ожидает деплоя'),(2,'Передан на тестирование');
/*!40000 ALTER TABLE `task_statuses` ENABLE KEYS */;
UNLOCK TABLES;


-- -----------------------------------------------------
-- Table `tasks`.`tasks`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tasks`.`tasks` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(256) NOT NULL,
  `is_open` TINYINT(1) NOT NULL DEFAULT 1,
  `users_id` INT UNSIGNED NOT NULL,
  `task_statuses_id` INT UNSIGNED,
  `create_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` DATETIME NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `fk_tasks_1_idx` (`users_id` ASC),
  INDEX `fk_tasks_2_idx` (`task_statuses_id` ASC),
  CONSTRAINT `fk_tasks_1`
    FOREIGN KEY (`users_id`)
    REFERENCES `tasks`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tasks_2`
    FOREIGN KEY (`task_statuses_id`)
    REFERENCES `tasks`.`task_statuses` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `tasks`.`task_extension`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tasks`.`task_extension` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `tasks_id` INT UNSIGNED NOT NULL,
  `description` VARCHAR(2048) NULL,
  `create_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` DATETIME NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `fk_task_extension_1_idx` (`tasks_id` ASC),
  CONSTRAINT `fk_task_extension_1`
    FOREIGN KEY (`tasks_id`)
    REFERENCES `tasks`.`tasks` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
