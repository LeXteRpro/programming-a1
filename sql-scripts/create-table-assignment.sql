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