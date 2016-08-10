ALTER TABLE `project_type` ADD `project_table` TEXT NOT NULL COMMENT '存储四个阶段的project_table的表单，采用json编码' AFTER `project_leader`;


CREATE TABLE `project_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT '大表格的名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT '大表格';


CREATE TABLE `project_table_struct` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_table_id` int(11) DEFAULT NULL COMMENT '外键关联project_table.id',
  `name` varchar(255) DEFAULT NULL COMMENT '子表名称',
  `type` enum('html','json') DEFAULT NULL COMMENT '表格生成的类型',
  `html` varchar(255) DEFAULT NULL COMMENT '当type=html时，此为html表单的地址',
  `json` text COMMENT '当type=json时，此为jsontoform的json字符串',
  PRIMARY KEY (`id`),
  KEY `project_table_id_fk` (`project_table_id`),
  CONSTRAINT `project_table_id_fk` FOREIGN KEY (`project_table_id`) REFERENCES `project_table` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='项目子表-结构表';


CREATE TABLE `project_table_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT NULL COMMENT '外键project.id',
  `project_table_struct_id` int(11) DEFAULT NULL COMMENT '外键project_table_struct.id',
  `data` int(11) DEFAULT NULL COMMENT 'json编码的字符串数据',
  PRIMARY KEY (`id`),
  KEY `project_info_id_fk` (`project_id`),
  KEY `project_table_struct_id_fk` (`project_table_struct_id`),
  CONSTRAINT `project_info_id_fk` FOREIGN KEY (`project_id`) REFERENCES `project_info` (`id`),
  CONSTRAINT `project_table_struct_id_fk` FOREIGN KEY (`project_table_struct_id`) REFERENCES `project_table_struct` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='项目子表-数据表project_table_data（用于存储每个项目、每个子表信息）'