ALTER TABLE `project`.`project_info` 
ADD COLUMN `is_check` TINYINT NULL DEFAULT 0 AFTER `save_year`;
update project.project_info set is_check=1 where id>1;