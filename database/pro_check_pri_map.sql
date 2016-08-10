CREATE TABLE `pro_check_pri_map` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_info_id` int(11) NOT NULL,
  `project_type_id` int(11) NOT NULL,
  `admin_info_lend_id` int(11) NOT NULL,
  `project_type_para_id` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `pro_uniq` (`admin_info_id`,`project_type_id`,`project_type_para_id`,`admin_info_lend_id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;
