ALTER TABLE `projects` DROP ` members `;

CREATE TABLE `demoautentication`.`members` ( `id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(100) NOT NULL , PRIMARY KEY (`id`)) ENGINE = MyISAM;

CREATE TABLE `demoautentication`.`project_members` ( `id` INT NOT NULL AUTO_INCREMENT , `project_id` INT NOT NULL , `member_id` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = MyISAM;