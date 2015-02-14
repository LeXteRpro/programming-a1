USE `<DATABASE NAME>`;

CREATE TABLE `assignment-test` (
  `assignment_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `course_code` VARCHAR(45) NULL,
  `teacher` VARCHAR(45) NULL,
  `due_date` TIMESTAMP NULL,
  `complete` INT(1) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`assignment_id`));

INSERT INTO `assignment`
	(`assignment_id`, `name`,           `course_code`, `teacher`) VALUES
	(NULL,            'test of colors', 'L0G1M0',      'stephen');

ALTER TABLE `assignment`
CHANGE COLUMN `due_date` `due_date` VARCHAR(45) NULL DEFAULT NULL ;



CREATE TABLE `courses` (
  `course_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`course_id`),
  UNIQUE INDEX `code_UNIQUE` (`code` ASC));


INSERT INTO `php`.`courses` (`course_id`, `code`) VALUES (NULL, 'comp1045');
INSERT INTO `php`.`courses` (`code`) VALUES ('gnedNo');
INSERT INTO `php`.`courses` (`code`) VALUES ('comp1001');
