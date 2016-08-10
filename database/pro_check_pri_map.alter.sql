ALTER TABLE `project`.`pro_check_pri_map` 
ADD COLUMN `status` TINYINT NULL DEFAULT 0 AFTER `project_type_para_id`;
ALTER TABLE `project`.`pro_check_pri_map` 
DROP INDEX `pro_uniq` ,
ADD UNIQUE INDEX `pro_uniq` (`admin_info_id` ASC, `project_type_id` ASC, `project_type_para_id` ASC);