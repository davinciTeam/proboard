ALTER TABLE `projects`
  DROP `code_end`,
  DROP `code_start`,
  DROP `code_date`,
  DROP `iteration_end`,
  DROP `iteration_start`,
  DROP `iteration_date`;

ALTER TABLE `projects` ADD `code_review_start` DATETIME NOT NULL AFTER `description`, ADD `code_review_end` DATETIME NOT NULL AFTER `code_review_start`, ADD `iteration_start` DATETIME NOT NULL AFTER `code_review_end`, ADD `iteration_end` DATETIME NOT NULL AFTER `iteration_start`;