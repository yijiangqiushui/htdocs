ALTER TABLE `project_type`
MODIFY COLUMN `project_table`  text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '存储四个阶段的project_table的表单，采用json编码' AFTER `project_leader`,
MODIFY COLUMN `is_new`  tinyint(4) NULL DEFAULT 0 AFTER `project_table`;