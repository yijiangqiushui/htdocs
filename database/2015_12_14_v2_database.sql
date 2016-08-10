/*
SQLyog 企业版 - MySQL GUI v8.14 
MySQL - 5.0.41-community-nt : Database - project
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`project` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `project`;

/*Table structure for table `admininfo` */

DROP TABLE IF EXISTS `admininfo`;

CREATE TABLE `admininfo` (
  `id` int(11) NOT NULL auto_increment,
  `department` int(11) default NULL,
  `user_type` int(11) default NULL,
  `username` varchar(30) default NULL,
  `password` varchar(100) default NULL,
  `realname` varchar(30) default NULL,
  `phone` varchar(30) default NULL,
  `email` varchar(50) default NULL,
  `qq` varchar(30) default NULL,
  `isForbidden` int(11) default '0',
  `addDate` varchar(50) default NULL,
  `lastIP` varchar(30) default NULL,
  `isDel` int(11) default '0',
  `ntid` tinytext COMMENT '设备id',
  `seed` tinytext COMMENT '种子码',
  `lastLoginTime` timestamp NULL default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `admininfo` */

insert  into `admininfo`(`id`,`department`,`user_type`,`username`,`password`,`realname`,`phone`,`email`,`qq`,`isForbidden`,`addDate`,`lastIP`,`isDel`,`ntid`,`seed`,`lastLoginTime`) values (1,0,3,'super','013b973fe5d09a1a9360becdd3a0a511de73c05a','张三','1','22@gmail.com','11111',0,NULL,'127.0.0.1',NULL,NULL,NULL,'2015-12-14 10:24:37'),(5,0,1,'suy','013b973fe5d09a1a9360becdd3a0a511de73c05a','苏颖','13774774787','suying@qq.com','19874568785',0,NULL,NULL,0,NULL,NULL,NULL),(6,0,1,'kangly','013b973fe5d09a1a9360becdd3a0a511de73c05a','康连元','15487895624','kanglianyuan@qq.com','7458452',0,NULL,NULL,0,NULL,NULL,NULL),(7,1,1,'gengdl','013b973fe5d09a1a9360becdd3a0a511de73c05a','耿大乐','13487784521','gengdale@qq.com','8521354',0,NULL,NULL,0,NULL,NULL,NULL),(8,1,1,'guohj','013b973fe5d09a1a9360becdd3a0a511de73c05a','郭华杰','18956532549','guohuajie@qq.com','45123354',0,NULL,NULL,0,NULL,NULL,NULL),(9,2,1,'songlj','013b973fe5d09a1a9360becdd3a0a511de73c05a','宋李杰','13654897856','songlijie@qq.com','1554895645',0,NULL,NULL,0,NULL,NULL,NULL),(10,2,1,'jinz','013b973fe5d09a1a9360becdd3a0a511de73c05a','金竹','15458956532','jinzhu@qq.com','5451345455',0,NULL,NULL,0,NULL,NULL,NULL),(11,NULL,NULL,'wangzh','013b973fe5d09a1a9360becdd3a0a511de73c05a','王振海','18745895456','wangzhenghai@qq.com','45512645312',0,NULL,NULL,0,NULL,NULL,NULL);

/*Table structure for table `apply_award` */

DROP TABLE IF EXISTS `apply_award`;

CREATE TABLE `apply_award` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `org_code` varchar(128) default NULL,
  `project_id` varchar(128) default NULL,
  `expect_contractNums` float default NULL,
  `expect_contractMoney` float default NULL,
  `previous_taxes` float default NULL,
  `check_amount` float default NULL,
  `award_level` int(11) default NULL,
  `sc_opinion` varchar(128) default NULL,
  `contractMoney` float default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `apply_award` */

insert  into `apply_award`(`id`,`org_code`,`project_id`,`expect_contractNums`,`expect_contractMoney`,`previous_taxes`,`check_amount`,`award_level`,`sc_opinion`,`contractMoney`) values (1,'012345678',NULL,1,1111,1,1,1,NULL,NULL);

/*Table structure for table `aptitude_name` */

DROP TABLE IF EXISTS `aptitude_name`;

CREATE TABLE `aptitude_name` (
  `id` int(11) NOT NULL auto_increment,
  `org_code` varchar(11) default NULL,
  `project_id` varchar(11) default NULL,
  `approve_org` varchar(30) default NULL,
  `name` varchar(30) default NULL,
  `validity` varchar(20) default NULL,
  `aptitude_code` varchar(20) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `aptitude_name` */

/*Table structure for table `check_material` */

DROP TABLE IF EXISTS `check_material`;

CREATE TABLE `check_material` (
  `id` int(20) NOT NULL auto_increment,
  `project_id` varchar(20) default NULL,
  `org_suggest` varchar(500) default NULL,
  `factory_area` float(20,0) default NULL,
  `factory_sum` float(20,0) default NULL,
  `rebuild_sum` float(20,0) default NULL,
  `rebuild_area` float(20,0) default NULL,
  `tec_num` int(11) default NULL,
  `tec_hour` float default NULL,
  `manage_num` int(11) default NULL,
  `manage_hour` float default NULL,
  `total_person` int(11) default NULL,
  `total_class` float default NULL,
  `market_occupy` varchar(200) default NULL,
  `patent` varchar(30) default NULL,
  `patent_type` varchar(30) default NULL,
  `patent_state` varchar(30) default NULL,
  `product_name` varchar(30) default NULL,
  `product_level` int(10) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `check_material` */

/*Table structure for table `coorg_info` */

DROP TABLE IF EXISTS `coorg_info`;

CREATE TABLE `coorg_info` (
  `org_code` varchar(11) default NULL,
  `coorg_name` varchar(50) default NULL,
  `coorg_code` varchar(11) default NULL,
  `register_fund` float default NULL,
  `register_address` varchar(50) default NULL,
  `org_type` varchar(30) default NULL,
  `contact_address` varchar(50) default NULL,
  `postal` varchar(30) default NULL,
  `linkman_email` varchar(20) default NULL,
  `linkman_contact` varchar(20) default NULL,
  `linkman` varchar(11) default NULL,
  `main_product` varchar(20) default NULL,
  `org_trade` varchar(11) default NULL,
  `coorg_summary` varchar(500) default NULL,
  `id` int(11) NOT NULL auto_increment,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `coorg_info` */

insert  into `coorg_info`(`org_code`,`coorg_name`,`coorg_code`,`register_fund`,`register_address`,`org_type`,`contact_address`,`postal`,`linkman_email`,`linkman_contact`,`linkman`,`main_product`,`org_trade`,`coorg_summary`,`id`) values ('千松','北京昂宇科技发展有限公司','e123',1000,'通州区科技馆','国企','北京市通州区玉带河286号','100000','412723197002154623','010-60551593','杨会计',NULL,NULL,'好',20);

/*Table structure for table `effect_event` */

DROP TABLE IF EXISTS `effect_event`;

CREATE TABLE `effect_event` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(30) default NULL,
  `time` varchar(30) default NULL,
  `place` varchar(100) default NULL,
  `theme` varchar(100) default NULL,
  `effect` varchar(500) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `effect_event` */

/*Table structure for table `equipment` */

DROP TABLE IF EXISTS `equipment`;

CREATE TABLE `equipment` (
  `id` int(11) NOT NULL auto_increment,
  `project_id` varchar(30) NOT NULL,
  `task_eqpt_name` varchar(20) default NULL,
  `eqpt_name` varchar(20) default NULL,
  `task_eqpt_model` varchar(20) default NULL,
  `eqpt_model` varchar(20) default NULL,
  `task_plan_money` float default NULL,
  `plan_money` float default NULL,
  `task_actual_num` int(11) default NULL,
  `actual_num` int(11) default NULL,
  `task_actual_pay` float default NULL,
  `actual_pay` float default NULL,
  `task_fund_src` varchar(50) default NULL,
  `fund_src` varchar(50) default NULL,
  `task_buy_time` varchar(20) default NULL,
  `buy_time` varchar(20) default NULL,
  `task_main_use` varchar(50) default NULL,
  `main_use` varchar(50) default NULL,
  `task_project_id` varchar(30) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `equipment` */

insert  into `equipment`(`id`,`project_id`,`task_eqpt_name`,`eqpt_name`,`task_eqpt_model`,`eqpt_model`,`task_plan_money`,`plan_money`,`task_actual_num`,`actual_num`,`task_actual_pay`,`actual_pay`,`task_fund_src`,`fund_src`,`task_buy_time`,`buy_time`,`task_main_use`,`main_use`,`task_project_id`) values (2,'dev1449795502',NULL,'2',NULL,'2',NULL,2,NULL,2,NULL,2,NULL,'2',NULL,'2',NULL,'2',NULL),(3,'dev1449795502',NULL,'',NULL,'',NULL,0,NULL,0,NULL,0,NULL,'',NULL,'',NULL,'',NULL),(7,'dev1449816291',NULL,'1',NULL,'1',NULL,1,NULL,1,NULL,1,NULL,'1',NULL,'1',NULL,'1',NULL),(8,'dev1449816291',NULL,'',NULL,'',NULL,0,NULL,0,NULL,0,NULL,'',NULL,'',NULL,'',NULL),(15,'dev1449820432',NULL,'2',NULL,'2',NULL,2,NULL,2,NULL,2,NULL,'2',NULL,'22',NULL,'2',NULL),(74,'dev1449823942',NULL,'2',NULL,'2',NULL,2,NULL,2,NULL,2,NULL,'2',NULL,'2',NULL,'2',NULL),(75,'dev1449823942',NULL,'4',NULL,'4',NULL,4,NULL,4,NULL,4,NULL,'4',NULL,'4',NULL,'4',NULL),(76,'dev1449823942',NULL,'2',NULL,'2',NULL,2,NULL,2,NULL,2,NULL,'2',NULL,'2',NULL,'2',NULL),(77,'dev1449823942',NULL,'4',NULL,'44444444444',NULL,0,NULL,0,NULL,0,NULL,'4',NULL,'44444444444',NULL,'44444',NULL),(78,'dev1449823942',NULL,'44444444',NULL,'444444',NULL,0,NULL,0,NULL,0,NULL,'44444',NULL,'4444',NULL,'4',NULL),(97,'dev1449824019',NULL,'1',NULL,'1',NULL,1,NULL,1,NULL,1,NULL,'1',NULL,'1',NULL,'1',NULL),(99,'dev1449831949',NULL,'1',NULL,'1',NULL,1,NULL,1,NULL,1,NULL,'1',NULL,'1',NULL,'1',NULL),(100,'dev1449804673',NULL,'11',NULL,'1',NULL,1,NULL,1,NULL,1,NULL,'1',NULL,'1',NULL,'1',NULL),(101,'dev1449804673',NULL,'1',NULL,'1',NULL,1,NULL,0,NULL,0,NULL,'1',NULL,'1',NULL,'1',NULL),(102,'dev1449804673',NULL,'1',NULL,'1',NULL,1,NULL,1,NULL,1,NULL,'1',NULL,'1',NULL,'1',NULL),(104,'dev1449846462',NULL,'2',NULL,'22',NULL,2,NULL,2,NULL,2,NULL,'22',NULL,'2',NULL,'2',NULL),(105,'dev1449849004',NULL,'1',NULL,'1',NULL,1,NULL,1,NULL,1,NULL,'1',NULL,'1',NULL,'1',NULL),(107,'dev1449975160',NULL,'1',NULL,'1',NULL,1,NULL,1,NULL,1,NULL,'1',NULL,'1',NULL,'1',NULL),(108,'dev1449989729',NULL,'1',NULL,'1',NULL,1,NULL,1,NULL,1,NULL,'1',NULL,'1',NULL,'1',NULL),(109,'dev1450053084',NULL,'1',NULL,'1',NULL,1,NULL,1,NULL,0,NULL,'',NULL,'',NULL,'',NULL);

/*Table structure for table `equipment_list` */

DROP TABLE IF EXISTS `equipment_list`;

CREATE TABLE `equipment_list` (
  `id` int(20) NOT NULL auto_increment,
  `project_id` varchar(20) default NULL,
  `equipment_name` varchar(20) default NULL,
  `equipment_price` float(20,0) default NULL,
  `equipment_num` int(20) default NULL,
  `equipment_fund` float(20,0) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `equipment_list` */

/*Table structure for table `experts` */

DROP TABLE IF EXISTS `experts`;

CREATE TABLE `experts` (
  `id` int(11) NOT NULL auto_increment,
  `project_id` varchar(30) NOT NULL,
  `expert_name` varchar(20) default NULL,
  `expert_org` varchar(20) default NULL,
  `expert_job` varchar(20) default NULL,
  `expert_major` varchar(20) default NULL,
  `expert_phone` varchar(20) default NULL,
  `expert_sign` varchar(20) default NULL,
  `expert_divide` varchar(20) default NULL,
  `expert_id` varchar(30) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `experts` */

insert  into `experts`(`id`,`project_id`,`expert_name`,`expert_org`,`expert_job`,`expert_major`,`expert_phone`,`expert_sign`,`expert_divide`,`expert_id`) values (2,'dev1449728333','2','2','2','2','2','2','2','2'),(3,'dev1449728333','2','2','2','2','2','2','2','2'),(4,'dev1449821637','2','2','2','2','2','','2','2'),(5,'dev1449821637','2','2','2','2','2','','2','2'),(6,'dev1449821637','2','2','2','2','2','','2','2'),(7,'dev1449821637','2','','','','','','',''),(8,'dev1449821637','2','2','2','2','2','2','2','2'),(9,'dev1449821637','2','2','2','2','2','2','2','2'),(10,'dev1449821637','2','2','2','2','2','2','2','2'),(11,'dev1449821637','2','2','2','2','2','2','2','2'),(12,'dev1449821637','','','','','','','',''),(13,'dev1449732172','踩踩踩','踩踩踩','踩踩踩','踩踩踩','踩踩踩','踩踩踩','踩踩踩','踩踩踩'),(14,'dev1449732172','','','踩踩踩','踩踩踩','踩踩踩','踩踩踩','','踩踩踩'),(15,'dev1449732172','','','踩踩踩','','','','',''),(16,'dev1449732172','','','','踩踩踩','','','',''),(17,'dev1449831949','ff','f','f','ff','ff','ff','ff','ff'),(18,'dev1449831949','ff','f','f','ff','ff','ff','ff','ff'),(19,'dev1449846462','','','','','','','',''),(20,'dev1449846462','','','','','','','',''),(21,'dev1449846462','','','','','','','',''),(22,'dev1449846462','','','','','','','',''),(23,'dev1449849004','1','1','1','1','1','1','1','1'),(24,'dev1449849004','1','1','1','1','1','1','1','1');

/*Table structure for table `finish_target` */

DROP TABLE IF EXISTS `finish_target`;

CREATE TABLE `finish_target` (
  `id` int(11) NOT NULL auto_increment,
  `project_id` varchar(11) default NULL,
  `employ_num` int(11) default NULL,
  `year_profit` float default NULL,
  `industry_num` float default NULL,
  `tax_sum` float default NULL,
  `industry_add` float default NULL,
  `foreign_tax` float default NULL,
  `sell_sum` float default NULL,
  `market_share` float default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `finish_target` */

/*Table structure for table `fund_src` */

DROP TABLE IF EXISTS `fund_src`;

CREATE TABLE `fund_src` (
  `the_year` varchar(10) default NULL,
  `id` int(11) NOT NULL auto_increment,
  `project_id` varchar(30) NOT NULL,
  `bgt_fund` varchar(200) default NULL,
  `reduce_fund` varchar(200) default NULL,
  `fund_total` varchar(300) default NULL,
  `actual_fund` varchar(200) default NULL,
  `src_type` varchar(20) default NULL,
  `bgt_fund_total` float default NULL,
  `reduce_fund_total` float default NULL,
  `actual_fund_total` float default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `fund_src` */

insert  into `fund_src`(`the_year`,`id`,`project_id`,`bgt_fund`,`reduce_fund`,`fund_total`,`actual_fund`,`src_type`,`bgt_fund_total`,`reduce_fund_total`,`actual_fund_total`) values (NULL,2,'dev1449795502','2_2_2','2_2_2',NULL,'2_2_2',NULL,NULL,NULL,NULL),(NULL,3,'dev1449804673','1_1_1','1_1_1',NULL,'1_1_1',NULL,1,1,0),(NULL,4,'dev1449816291','1_1_1','1_1_1',NULL,'1_1_1',NULL,NULL,NULL,NULL),(NULL,5,'dev1449823942','1_1_1','1_1_1',NULL,'1_1_1',NULL,444,4.44444e+012,0),(NULL,6,'dev1449820432','222222_2_2','2_2_2',NULL,'2_22_2',NULL,NULL,NULL,NULL),(NULL,7,'dev1449824019','2_2_2','2_2_2',NULL,'2_2_2',NULL,222,222,0),(NULL,8,'dev1449831949','1_1_11','11_11_1',NULL,'1_1_1',NULL,NULL,NULL,NULL),(NULL,9,'dev1449846462','1_1_1','11_1_1',NULL,'1_1_1',NULL,1,1,0),(NULL,10,'dev1449849004','1_1_1','1_1_1',NULL,'1_1_1',NULL,NULL,NULL,NULL),(NULL,11,'dev1449975160','1_1_1','1_1_1',NULL,'0_0_0',NULL,3,3,0),(NULL,12,'dev1449989729','1_1_11111','1_1_1',NULL,'0_0_11110',NULL,NULL,NULL,NULL);

/*Table structure for table `hatch_place` */

DROP TABLE IF EXISTS `hatch_place`;

CREATE TABLE `hatch_place` (
  `id` int(11) default NULL,
  `project_id` varchar(30) default NULL,
  `total_area` float default NULL,
  `office_area` float default NULL,
  `hatch_area` float default NULL,
  `public_area` float default NULL,
  `avg_rent` float default NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `hatch_place` */

/*Table structure for table `hatch_result` */

DROP TABLE IF EXISTS `hatch_result`;

CREATE TABLE `hatch_result` (
  `id` bigint(20) NOT NULL auto_increment,
  `org_code` varchar(64) default NULL,
  `finish_com_num` bigint(20) default NULL,
  `acquire_num` bigint(20) default NULL,
  `list_num` bigint(20) default NULL,
  `tec_product_num` bigint(20) default NULL,
  `overseas` bigint(20) default NULL,
  `qr_genious_num` bigint(20) default NULL,
  `mainboard` bigint(20) default NULL,
  `hj_num` bigint(20) default NULL,
  `mid_num` bigint(20) default NULL,
  `gj_num` bigint(20) default NULL,
  `risk_inv_num` bigint(20) default NULL,
  `risk_inv_sum` bigint(20) default NULL,
  `high_sal_num` bigint(20) default NULL,
  `zgc_tech_num` bigint(20) default NULL,
  `settle_com_num` bigint(20) default NULL,
  `hatch_com_num` bigint(20) default NULL,
  `overseas_enter_nums` bigint(20) default NULL,
  `settle_com_profit` bigint(20) default NULL,
  `settle_com_tax` bigint(20) default NULL,
  `overthousand_com_num` bigint(20) default NULL,
  `com_know_num` bigint(20) default NULL,
  `position_num` bigint(20) default NULL,
  `research_fund` bigint(20) default NULL,
  `research_num` bigint(20) default NULL,
  `finance_num` bigint(20) default NULL,
  `finance_limit` bigint(20) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `hatch_result` */

/*Table structure for table `hatch_team` */

DROP TABLE IF EXISTS `hatch_team`;

CREATE TABLE `hatch_team` (
  `id` int(11) NOT NULL auto_increment,
  `project_id` varchar(30) default NULL,
  `total_area` float default NULL,
  `office_area` float default NULL,
  `hatch_area` float default NULL,
  `public_area` float default NULL,
  `avg_rent` float default NULL,
  `manage_num` int(11) default NULL,
  `doctor_num` int(11) default NULL,
  `master_num` int(11) default NULL,
  `college_num` int(11) default NULL,
  `junior_num` int(11) default NULL,
  `doctor_ratio` float default NULL,
  `master_ratio` float default NULL,
  `college_ratio` float default NULL,
  `junior_ratio` float default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `hatch_team` */

/*Table structure for table `instrument_list` */

DROP TABLE IF EXISTS `instrument_list`;

CREATE TABLE `instrument_list` (
  `id` int(20) NOT NULL auto_increment,
  `project_id` varchar(20) default NULL,
  `test_name` varchar(20) default NULL,
  `test_num` int(20) default NULL,
  `test_fund` float(20,0) default NULL,
  `test_price` float(20,0) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `instrument_list` */

/*Table structure for table `intellectual_property` */

DROP TABLE IF EXISTS `intellectual_property`;

CREATE TABLE `intellectual_property` (
  `id` int(11) NOT NULL auto_increment,
  `org_code` varchar(11) default NULL,
  `patent_num` int(11) default NULL,
  `invent_patent` int(11) default NULL,
  `functional_patent` int(11) default NULL,
  `other_patent` int(11) default NULL,
  `patent_design` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `intellectual_property` */

insert  into `intellectual_property`(`id`,`org_code`,`patent_num`,`invent_patent`,`functional_patent`,`other_patent`,`patent_design`) values (3,'123',0,0,0,0,0),(4,'千松',10,10,10,10,10),(5,'e123',10,10,10,10,10);

/*Table structure for table `last_target` */

DROP TABLE IF EXISTS `last_target`;

CREATE TABLE `last_target` (
  `id` int(11) NOT NULL auto_increment,
  `project_id` varchar(11) default NULL,
  `employ_num` int(11) default NULL,
  `year_profit` float default NULL,
  `industry_num` float default NULL,
  `tax_sum` float default NULL,
  `industry_add` float default NULL,
  `foreign_tax` float default NULL,
  `sell_sum` float default NULL,
  `market_share` float default NULL,
  `year` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `last_target` */

/*Table structure for table `legal_person` */

DROP TABLE IF EXISTS `legal_person`;

CREATE TABLE `legal_person` (
  `id` int(11) NOT NULL auto_increment,
  `org_code` varchar(50) default NULL,
  `legal_code` varchar(50) default NULL,
  `legal_name` varchar(20) default NULL,
  `legal_sex` int(5) default '1',
  `legal_edu` varchar(20) default NULL,
  `legal_birth` varchar(30) default NULL,
  `legal_time` varchar(30) default NULL,
  `legal_phone` varchar(20) default NULL,
  `legal_id` varchar(30) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `legal_person` */

insert  into `legal_person`(`id`,`org_code`,`legal_code`,`legal_name`,`legal_sex`,`legal_edu`,`legal_birth`,`legal_time`,`legal_phone`,`legal_id`) values (29,'10010',NULL,'杨',1,NULL,NULL,NULL,NULL,NULL),(30,'åæ¾',NULL,'wangyi ',1,NULL,NULL,NULL,NULL,NULL),(31,'bjqskj001',NULL,'杨柳',1,NULL,NULL,NULL,NULL,NULL),(32,'123',NULL,'ABC',1,NULL,NULL,NULL,'xx','xx'),(33,'123456',NULL,'马闯',1,NULL,NULL,NULL,NULL,NULL),(34,'千松',NULL,'杨松',1,NULL,NULL,NULL,'13401129692','412723197002154623'),(35,'e123',NULL,'杨松',1,NULL,NULL,NULL,'13401129692','412723197002154623'),(36,'012345678',NULL,'122',1,NULL,NULL,NULL,'12','112'),(37,'001',NULL,'李明',1,NULL,NULL,NULL,NULL,NULL),(38,'002',NULL,'lynda',1,NULL,NULL,NULL,NULL,NULL),(39,'',NULL,'liming',1,NULL,NULL,NULL,NULL,NULL),(40,'yyy',NULL,'yyy',1,NULL,NULL,NULL,NULL,NULL),(41,'ddd',NULL,'ddd',1,NULL,NULL,NULL,NULL,NULL),(42,'999',NULL,'99',1,NULL,NULL,NULL,NULL,NULL),(43,'111',NULL,'111',1,NULL,NULL,NULL,NULL,NULL),(44,'121302',NULL,'呼呼',1,NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `login_info` */

DROP TABLE IF EXISTS `login_info`;

CREATE TABLE `login_info` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(30) default NULL,
  `password` varchar(60) default NULL,
  `org_code` varchar(30) default NULL,
  `isForbidden` int(11) default '0',
  `lastIP` varchar(20) default NULL,
  `addDate` varchar(30) default NULL,
  `user_type` int(11) default '0',
  `department` int(11) default NULL,
  `realname` varchar(30) default NULL,
  `address` varchar(100) default NULL,
  `phone` varchar(20) default NULL,
  `email` varchar(30) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `login_info` */

insert  into `login_info`(`id`,`username`,`password`,`org_code`,`isForbidden`,`lastIP`,`addDate`,`user_type`,`department`,`realname`,`address`,`phone`,`email`) values (14,'李明','eadb034df421eca651dd5daf60c7072fe8f48a14','0021',0,'','',0,0,'李明','','15245858588',''),(15,'阿飞','','0021',0,'','',0,0,'','','',''),(17,'david','592d510020d3eacdc3d5c89e2e148f7467de3e82','bjqskj001',0,NULL,NULL,0,1,'戴伟','','15684229850',NULL),(18,'wangyi','','123',0,'','',0,0,'lynda','','18810531134',''),(19,'machuang','eadb034df421eca651dd5daf60c7072fe8f48a14','123456',0,NULL,NULL,0,1,'马闯','','123456',NULL),(20,'david1','592d510020d3eacdc3d5c89e2e148f7467de3e82','bjqs001',0,NULL,NULL,0,1,'戴伟','','15684229850',NULL),(21,'lyndawang','8175b5647ba094a1281ac01f8745c85a4cb96a51','0001',0,NULL,NULL,0,1,'lyndawang','','134243',NULL),(22,'1','187005ecfcbc95b9698b79763e19b24e28fbfd48','003',0,NULL,NULL,0,2,'李明','','18303306272',NULL),(24,NULL,NULL,'004',0,NULL,NULL,0,2,NULL,NULL,NULL,NULL),(25,NULL,NULL,'0021',0,NULL,NULL,0,2,NULL,NULL,NULL,NULL),(26,'haoren','a66495d0fb81d59c27745105659c14c195d92041','110',0,NULL,NULL,0,2,'haoren','','54545',NULL),(27,'rt','967b7062e4c5ac5633f9c2a9046b51abf95f05e5','rty',0,NULL,NULL,0,2,'r','','rt',NULL),(28,'liming','8a1aa9e75dd041984b095cb1190c9e1b0a53982f','120',0,NULL,NULL,0,NULL,'liming','','11111111','55555@qq.com'),(29,'222','ed829d3d8d9c144028b1470112c28cae081d928f','22',0,NULL,NULL,0,NULL,'22','','WWW','2222@QQ.OM'),(30,'QQ','5ba27701441e14eafb352a8f3d685b38514a2ab1','44',0,NULL,NULL,0,NULL,'QQ','','QQ','QQ@FFF.DDD'),(31,'fhsd','6c4f3db40d69c99b579d7223cc977b5b5b07b7c9','ry',0,NULL,NULL,0,NULL,'ghdf','','f','fh'),(32,'123','592d510020d3eacdc3d5c89e2e148f7467de3e82','123',0,NULL,NULL,0,NULL,'123','','123','55555'),(33,'yy','8605f3e21460bda0692be2eb15bde03cb1c4f974','yyy',0,NULL,NULL,0,NULL,'yyy','','yyy','yyy'),(34,'ddd','bcb17c4389bae9cba9c1fbd2d7fa540f372d6749','ddd',0,NULL,NULL,0,NULL,'ddd','','ddd','ddd'),(35,'999','c794b1000051828609cf74a525bac3b878e4584e','999',0,NULL,NULL,0,NULL,'99','','999','999'),(36,'111','82a26ded59af54c4d3ea209f716a7a37403a0c3e','111',0,NULL,NULL,0,NULL,'111','','111','111@11.com'),(37,'fred','eadb034df421eca651dd5daf60c7072fe8f48a14','121302',0,NULL,NULL,0,NULL,'fred','','15147875587','112554882@QQ.COM'),(38,'ma','187005ecfcbc95b9698b79763e19b24e28fbfd48','ma',0,NULL,NULL,0,NULL,'1','','1','1@q.com'),(39,'mac','187005ecfcbc95b9698b79763e19b24e28fbfd48','ma',0,NULL,NULL,0,NULL,'1','','1','1@q.com');

/*Table structure for table `manager_tab` */

DROP TABLE IF EXISTS `manager_tab`;

CREATE TABLE `manager_tab` (
  `third_year` int(11) default NULL,
  `first_year` int(11) default NULL,
  `second_year` int(11) default NULL,
  `third_pubtec_pro` float default NULL,
  `second_pubtec_pro` float default NULL,
  `first_pubtec_pro` float default NULL,
  `third_pubtec_invest` float default NULL,
  `second_pubtec_invest` float default NULL,
  `first_pubtec_invest` float default NULL,
  `second_tax` float default NULL,
  `third_tax` float default NULL,
  `
first_tax` float default NULL,
  `third_profit` float default NULL,
  `second_profit` float default NULL,
  `first_profit` float default NULL,
  `id` int(11) NOT NULL auto_increment,
  `third_other_rev` float default NULL,
  `second_other_rev` float default NULL,
  `first_other_rev` float default NULL,
  `third_tec_rev` float default NULL,
  `second_tec_rev` float default NULL,
  `first_tec_rev` float default NULL,
  `third_total_rev` float default NULL,
  `second_total_rev` float default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `manager_tab` */

/*Table structure for table `material_list` */

DROP TABLE IF EXISTS `material_list`;

CREATE TABLE `material_list` (
  `id` int(11) NOT NULL auto_increment,
  `project_id` varchar(11) default NULL,
  `name` varchar(30) default NULL,
  `remark` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `material_list` */

/*Table structure for table `modify_apply` */

DROP TABLE IF EXISTS `modify_apply`;

CREATE TABLE `modify_apply` (
  `engineer_suggest` varchar(200) default NULL,
  `id` int(11) NOT NULL auto_increment,
  `project_id` varchar(30) NOT NULL,
  `start_end` varchar(20) default NULL,
  `modify_content` varchar(200) default NULL,
  `modify_reason` varchar(200) default NULL,
  `org_suggest` varchar(200) default NULL,
  `office_suggest` varchar(200) default NULL,
  `vice_suggest` varchar(200) default NULL,
  `director_suggest` varchar(200) default NULL,
  `remark` varchar(200) default NULL,
  `project_name` varchar(100) default NULL,
  `project_money` float(100,0) default NULL,
  `finmoney` float(100,0) default NULL,
  `othermoney` float(100,0) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `modify_apply` */

insert  into `modify_apply`(`engineer_suggest`,`id`,`project_id`,`start_end`,`modify_content`,`modify_reason`,`org_suggest`,`office_suggest`,`vice_suggest`,`director_suggest`,`remark`,`project_name`,`project_money`,`finmoney`,`othermoney`) values ('1',1,'dev1449804673','1','1','1','1','1','1','1','1','1',1,1,1),('44',2,'dev1449820432','333','4','4','4','4','4','4','4','4',4,4,4),('ss',3,'dev1449821637','2015-11-30','ss','s','ss','ss','ss','ss','水水水水','once agin',0,0,0),('xx',4,'dev1449831949','S','S','Sxx','xxx','xx','xx','xx','xx','sS',0,0,0),('1',5,'dev1449726614','2015-11-30','1','1','1','1','1','1','1','xiangmu',1,1,1),('1',6,'dev1449846462','2015-11-30','1','1','1','1','1','2','3','自主研发项目 007',1,1,1);

/*Table structure for table `org_info` */

DROP TABLE IF EXISTS `org_info`;

CREATE TABLE `org_info` (
  `id` int(11) NOT NULL auto_increment,
  `org_code` varchar(30) NOT NULL default '',
  `org_name` varchar(30) default '',
  `relationship` varchar(20) default NULL,
  `legal_person` varchar(30) default NULL,
  `org_type` varchar(20) default NULL,
  `org_address` varchar(100) default NULL,
  `register_town` varchar(20) default NULL,
  `register_time` varchar(20) default NULL,
  `postal` varchar(20) default NULL,
  `fax` varchar(20) default NULL,
  `email` varchar(30) default NULL,
  `certi_code` varchar(50) default NULL,
  `develop_area` varchar(50) default NULL,
  `org_leader` varchar(20) default NULL,
  `leader_contact` varchar(20) default NULL,
  `dev_leader` varchar(20) default NULL,
  `dev_contact` varchar(20) default NULL,
  `finance_leader` varchar(20) default NULL,
  `finance_contact` varchar(20) default NULL,
  `linkman` varchar(20) default NULL,
  `linkman_contact` varchar(20) default NULL,
  `ratification_num` varchar(50) default NULL,
  `username` varchar(20) default NULL,
  `org_bank` varchar(30) default NULL,
  `account` varchar(50) default NULL,
  `leader_org` varchar(50) default NULL,
  `phone` varchar(20) default NULL,
  `coorg_code` varchar(50) default NULL,
  `register_fund` float default NULL,
  `contact_address` varchar(50) default NULL,
  `register_address` varchar(50) default NULL,
  `linkman_email` varchar(50) default NULL,
  `org_trade` varchar(20) default NULL,
  `local_foreign` float default NULL,
  `research_content` varchar(1000) default NULL,
  `investment` varchar(500) default NULL,
  `service_type` varchar(50) default NULL,
  `website` varchar(50) default NULL,
  `asset_total` float default NULL,
  `listed` int(11) default NULL,
  `listed_code` varchar(50) default NULL,
  `main_product` varchar(50) default NULL,
  `credit_rate` varchar(10) default NULL,
  `feature` varchar(500) default NULL,
  `company_summary` varchar(1000) default NULL,
  `last_contractNum` int(11) default NULL,
  `last_contractPrice` float default NULL,
  `predict_contractNum` int(11) default NULL,
  `predict_contractPrice` float default NULL,
  `predict_servicePrice` float default NULL,
  `hatch_type` varchar(30) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `org_info` */

insert  into `org_info`(`id`,`org_code`,`org_name`,`relationship`,`legal_person`,`org_type`,`org_address`,`register_town`,`register_time`,`postal`,`fax`,`email`,`certi_code`,`develop_area`,`org_leader`,`leader_contact`,`dev_leader`,`dev_contact`,`finance_leader`,`finance_contact`,`linkman`,`linkman_contact`,`ratification_num`,`username`,`org_bank`,`account`,`leader_org`,`phone`,`coorg_code`,`register_fund`,`contact_address`,`register_address`,`linkman_email`,`org_trade`,`local_foreign`,`research_content`,`investment`,`service_type`,`website`,`asset_total`,`listed`,`listed_code`,`main_product`,`credit_rate`,`feature`,`company_summary`,`last_contractNum`,`last_contractPrice`,`predict_contractNum`,`predict_contractPrice`,`predict_servicePrice`,`hatch_type`) values (36,'0021','千松科技','2','2','2是是是','2实施','2是恩恩','2016-02-02','5454','2','2','2','2','2','2534534','fds','2534534','2','264565654654','2','2','2',NULL,NULL,NULL,NULL,'255424552555',NULL,NULL,'通州区',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(37,'千松','北京千松科技发展有限公司','支公司','杨松','国企','通州区科技馆','通州区','2003','100000','66157731','yangsong@bjqs.com','mk123','通州区','杨松','15683694386','李志晓','13401129692','杨会计','18910713163','杨会计','010-60551593','ty123',NULL,NULL,NULL,NULL,NULL,NULL,1000,'北京市通州区玉带河286号','通州区科技馆','412723197002154623','软件',NULL,NULL,NULL,NULL,NULL,NULL,0,'s123','科普软件',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(38,'åæ¾','千松',NULL,'wangyi ',NULL,NULL,NULL,NULL,NULL,NULL,'122345@qq.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'wangyi','244442412',NULL,NULL,NULL,NULL,NULL,'12112131',NULL,NULL,'beijing',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(39,'bjqs001','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(40,'bjqskj001','北京万松科技有限公司','上下级的关系','杨柳','国营企业','北京市玉带河东街286号','玉带河乡镇','1991','211111','123456789','727470132@qq.com','123','玉带河东街','杨柳','15689456133','呵呵哒','13780557785','1234','4567','杨松','15684229850','123456',NULL,NULL,NULL,NULL,'15684229850',NULL,NULL,'北京市通州区',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(41,'123','1256','xx','ABC','xx','xx','xx','','xx','xx','1137188325@qq.com','xx','xx','xx','xxx','xx','xxx','xx','xxx','ABC','18813531134','xxxx',NULL,NULL,NULL,NULL,'18813531134',NULL,0,'ABC','xx','xx','xx',NULL,NULL,NULL,NULL,NULL,NULL,0,'xx','xx',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(42,'123456','马闯','的','马闯','看看','k','k','k','k','k','123@123.com','k','k','k','k','k','k','k','k','马闯','123','k',NULL,NULL,NULL,NULL,'123',NULL,NULL,'马闯',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(43,'012345678','2222',NULL,NULL,'1',NULL,NULL,NULL,'112',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'12','1',NULL,'1','1','1',NULL,NULL,NULL,12,'122','122','112@qq.com','1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(44,'0001','千松','上下级','杨松','222','北京市','北京','119','100000','222','122@qq.com','119','119','大舍大得','119','达到','119','撒','ii','123456','123456','wwwwwwwwww',NULL,NULL,NULL,NULL,'123456',NULL,NULL,'通州区',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(45,'008','qiansong','你猜','lynda','你猜','你猜','你猜','你猜','你猜','你猜','飘@qq.com','你猜','你猜','你猜','你猜','你猜','你猜','你猜','你猜','wangyi','14523525555','你猜',NULL,NULL,NULL,NULL,'58555',NULL,NULL,'北京',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(46,'008','qiansong',NULL,'lynda',NULL,NULL,NULL,NULL,NULL,NULL,'飘@qq.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'wangyi','14523525555',NULL,NULL,NULL,NULL,NULL,'58555',NULL,NULL,'北京',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(47,'008','qiansong',NULL,'lynda',NULL,NULL,NULL,NULL,NULL,NULL,'飘@qq.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'wangyi','14523525555',NULL,NULL,NULL,NULL,NULL,'58555',NULL,NULL,'北京',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(48,'0021','千松科技','2','2','2是是是','2实施','2是恩恩','2016-02-02','5454','2','2','2','2','2','2534534','fds','2534534','2','264565654654','2','2','2',NULL,NULL,NULL,NULL,'255424552555',NULL,NULL,'通州区',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(49,'110','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(50,'','liming',NULL,'liming',NULL,NULL,NULL,NULL,NULL,NULL,'liming@qq.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'liming','445566',NULL,NULL,NULL,NULL,NULL,'1234454',NULL,NULL,'liming',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(51,'rty','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(52,'120','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(53,'22','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(54,'44','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(55,'ry','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(56,'yyy','yyy',NULL,'yyy',NULL,NULL,NULL,NULL,NULL,NULL,'yyy',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'yyy','yyy',NULL,NULL,NULL,NULL,NULL,'yyy',NULL,NULL,'yyy',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(57,'ddd','ddd',NULL,'ddd',NULL,NULL,NULL,NULL,NULL,NULL,'ddd',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ddd','ddd',NULL,NULL,NULL,NULL,NULL,'ddd',NULL,NULL,'ddd',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(58,'999','999',NULL,'99',NULL,NULL,NULL,NULL,NULL,NULL,'99',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'99','999',NULL,NULL,NULL,NULL,NULL,'99',NULL,NULL,'99',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(59,'111','111','2','111','2','22','2','2','2','2','111@11.com','2','2','2','2','2','2','2','2','111','111','2',NULL,NULL,NULL,NULL,'111',NULL,NULL,'111',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(60,'121302','千松公司','','呼呼','私企','北京市','北京市通州区','2015-12-14','100000','1457-1255','114558@qq.com','ddasd-01','回家','哈哈','151444785555','哈哈','','','','呼呼','15114787878','',NULL,NULL,NULL,NULL,'15148238887',NULL,NULL,'北京市通州区',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(61,'ma','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `org_product` */

DROP TABLE IF EXISTS `org_product`;

CREATE TABLE `org_product` (
  `sale_ratio` float default NULL,
  `main_product` varchar(30) default NULL,
  `org_code` varchar(20) default NULL,
  `id` int(11) NOT NULL auto_increment,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `org_product` */

/*Table structure for table `patent_list` */

DROP TABLE IF EXISTS `patent_list`;

CREATE TABLE `patent_list` (
  `id` int(11) NOT NULL auto_increment,
  `project_id` varchar(11) default NULL,
  `patent_name` varchar(30) default NULL,
  `patent_code` varchar(20) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `patent_list` */

/*Table structure for table `profit_tax` */

DROP TABLE IF EXISTS `profit_tax`;

CREATE TABLE `profit_tax` (
  `id` int(11) NOT NULL auto_increment,
  `org_code` varchar(11) default NULL,
  `lastmarket_income` float default NULL,
  `last_tax` float default NULL,
  `last_profit` float default NULL,
  `last_totalincome` float default NULL,
  `last_totalprofit` float default NULL,
  `last_industryval` float default NULL,
  `last_industrytax` float default NULL,
  `last_industryadd` float default NULL,
  `last_industrycreative` float default NULL,
  `last_productsale` float default NULL,
  `last_techexpend` float default NULL,
  `main_product` varchar(20) default NULL,
  `sale_ratio` float default NULL,
  `predict_income` float default NULL,
  `predict_tax` float default NULL,
  `predict_profit` float default NULL,
  `lasthalf_income` float default NULL,
  `lasthalf_tax` float default NULL,
  `lasthalf_profit` float default NULL,
  `predict_inspectax` float default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `profit_tax` */

insert  into `profit_tax`(`id`,`org_code`,`lastmarket_income`,`last_tax`,`last_profit`,`last_totalincome`,`last_totalprofit`,`last_industryval`,`last_industrytax`,`last_industryadd`,`last_industrycreative`,`last_productsale`,`last_techexpend`,`main_product`,`sale_ratio`,`predict_income`,`predict_tax`,`predict_profit`,`lasthalf_income`,`lasthalf_tax`,`lasthalf_profit`,`predict_inspectax`) values (2,'123',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,0,0,0),(3,'千松',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,2300,1500,1000,300,800,500);

/*Table structure for table `project_ann_plan` */

DROP TABLE IF EXISTS `project_ann_plan`;

CREATE TABLE `project_ann_plan` (
  `id` int(11) NOT NULL auto_increment,
  `project_id` varchar(20) default NULL,
  `plan_year` varchar(10) default NULL,
  `task_plan_content` varchar(200) default NULL,
  `plan_content` varchar(200) default NULL,
  `task_project_id` int(11) default NULL,
  `task_plan_year` varchar(10) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `project_ann_plan` */

insert  into `project_ann_plan`(`id`,`project_id`,`plan_year`,`task_plan_content`,`plan_content`,`task_project_id`,`task_plan_year`) values (19,'dev1449724707','2011',NULL,'号',NULL,NULL),(20,'dev1449724707','2012',NULL,'号',NULL,NULL),(21,'dev1449724707','2013',NULL,'号',NULL,NULL),(22,'dev1449724861','22',NULL,'22',NULL,NULL),(23,'dev1449724861','22',NULL,'22',NULL,NULL),(24,'dev1449724861','22',NULL,'2222',NULL,NULL),(25,'dev1449727488','2011',NULL,'号',NULL,NULL),(26,'dev1449727488','2012',NULL,'号',NULL,NULL),(27,'dev1449727488','2013',NULL,'好',NULL,NULL),(28,'dev1449728333','3',NULL,'3',NULL,NULL),(29,'dev1449728333','3',NULL,'3',NULL,NULL),(30,'dev1449728333','3',NULL,'3',NULL,NULL),(31,'dev1449729636','2011',NULL,'啊啊',NULL,NULL),(32,'dev1449729636','2012',NULL,'啊啊',NULL,NULL),(33,'dev1449729636','2013',NULL,'啊啊',NULL,NULL),(34,'dev1449733726','2',NULL,'2',NULL,NULL),(35,'dev1449733726','2',NULL,'2',NULL,NULL),(36,'dev1449733726','2',NULL,'2',NULL,NULL),(37,'dev1449733930','2011',NULL,'好',NULL,NULL),(38,'dev1449733930','2012',NULL,'好',NULL,NULL),(39,'dev1449733930','2013',NULL,'好',NULL,NULL),(40,'dev1449738698','2',NULL,'2',NULL,NULL),(41,'dev1449738698','2',NULL,'2',NULL,NULL),(42,'dev1449738698','2',NULL,'2',NULL,NULL),(43,'dev1449793701','李明',NULL,'李明',NULL,NULL),(44,'dev1449793701','李明',NULL,'李明',NULL,NULL),(45,'dev1449793701','李明',NULL,'李明',NULL,NULL),(46,'dev1449793951','李明',NULL,'李明',NULL,NULL),(47,'dev1449793951','李明',NULL,'李明',NULL,NULL),(48,'dev1449793951','李明',NULL,'李明',NULL,NULL),(49,'dev1449795363','8-59',NULL,'8-59',NULL,NULL),(50,'dev1449795363','8-59',NULL,'8-59',NULL,NULL),(51,'dev1449795363','8-59',NULL,'8-59',NULL,NULL),(52,'dev1449795502','2',NULL,'2',NULL,NULL),(53,'dev1449795502','2',NULL,'2',NULL,NULL),(54,'dev1449795502','2',NULL,'2',NULL,NULL),(58,'dev1449804673','2013',NULL,'什么啊什么啊什么啊什么啊',NULL,NULL),(59,'dev1449804673','2014',NULL,'什么啊什么啊什么啊什么啊',NULL,NULL),(60,'dev1449804673','2015',NULL,'什么啊什么啊什么啊什么啊',NULL,NULL),(64,'dev1449728991','2012',NULL,'222',NULL,NULL),(65,'dev1449728991','2013',NULL,'333',NULL,NULL),(66,'dev1449728991','2014',NULL,'444',NULL,NULL),(67,'dev1449816291','2100',NULL,'working',NULL,NULL),(68,'dev1449816291','2111',NULL,'working',NULL,NULL),(69,'dev1449816291','2112',NULL,'working',NULL,NULL),(73,'dev1449821283','2011',NULL,'working',NULL,NULL),(74,'dev1449821283','2012',NULL,'working',NULL,NULL),(75,'dev1449821283','2013',NULL,'working',NULL,NULL),(79,'dev1449821637','3',NULL,'3',NULL,NULL),(80,'dev1449821637','3',NULL,'3',NULL,NULL),(81,'dev1449821637','3',NULL,'3',NULL,NULL),(82,'dev1449823942','12',NULL,'你猜',NULL,NULL),(83,'dev1449823942','13',NULL,'你猜',NULL,NULL),(84,'dev1449823942','14',NULL,'你猜',NULL,NULL),(85,'dev1449820432','111',NULL,'11111ss',NULL,NULL),(86,'dev1449820432','11',NULL,'111ssss',NULL,NULL),(87,'dev1449820432','111',NULL,'1111s',NULL,NULL),(88,'dev1449831949','啊啊啊',NULL,'啊啊啊',NULL,NULL),(89,'dev1449831949','啊啊啊',NULL,'啊啊啊',NULL,NULL),(90,'dev1449831949','啊啊啊',NULL,'啊啊啊',NULL,NULL),(91,'dev1449846462','2013',NULL,'项目各年度任务目标、考核指标及研究开发内容完成的计划进度',NULL,NULL),(92,'dev1449846462','2014',NULL,'项目各年度任务目标、考核指标及研究开发内容完成的计划进度',NULL,NULL),(93,'dev1449846462','2015',NULL,'项目各年度任务目标、考核指标及研究开发内容完成的计划进度',NULL,NULL),(94,'dev1449849004','2011',NULL,'好',NULL,NULL),(95,'dev1449849004','2012',NULL,'好',NULL,NULL),(96,'dev1449849004','2013',NULL,'好',NULL,NULL),(106,'dev1449989729','2012',NULL,'222',NULL,NULL),(107,'dev1449989729','2013',NULL,'22',NULL,NULL),(108,'dev1449989729','2014',NULL,'2222',NULL,NULL),(109,'dev1449975160','什么 是是什么',NULL,'什么 是是什么.........................................................................',NULL,NULL),(110,'dev1449975160','什么 是是什么',NULL,'什么 是是什么',NULL,NULL),(111,'dev1449975160','什么 是是什么',NULL,'0.0.0.\r\n',NULL,NULL),(115,'dev1449990809','5443',NULL,'gfdgdf',NULL,NULL),(116,'dev1449990809','5443',NULL,'gdfgdfdg',NULL,NULL),(117,'dev1449990809','543543',NULL,'5435dfgfd',NULL,NULL),(130,NULL,NULL,'',NULL,0,'dd'),(131,NULL,NULL,'',NULL,0,'dd'),(132,NULL,NULL,'',NULL,0,'是是是');

/*Table structure for table `project_benefit` */

DROP TABLE IF EXISTS `project_benefit`;

CREATE TABLE `project_benefit` (
  `id` int(11) NOT NULL auto_increment,
  `project_id` varchar(50) default NULL,
  `year` int(11) default NULL,
  `output` float default NULL,
  `sale_income` float default NULL,
  `tax` float default NULL,
  `profit` float default NULL,
  `foreign_income` float default NULL,
  `new_member` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `project_benefit` */

/*Table structure for table `project_content` */

DROP TABLE IF EXISTS `project_content`;

CREATE TABLE `project_content` (
  ` id` int(11) NOT NULL auto_increment,
  `project_id` varchar(11) default NULL,
  `project_target` varchar(500) default NULL,
  `project_mean` varchar(500) default NULL,
  PRIMARY KEY  (` id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `project_content` */

/*Table structure for table `project_fund_other` */

DROP TABLE IF EXISTS `project_fund_other`;

CREATE TABLE `project_fund_other` (
  `the_year` varchar(10) default NULL,
  `id` int(11) NOT NULL auto_increment,
  `budget_fund` varchar(300) default NULL,
  `reduce_fund` varchar(300) default NULL,
  `adjust_fund` varchar(300) default NULL,
  `actual_fund` varchar(300) default NULL,
  `project_id` varchar(30) NOT NULL,
  `subject` varchar(20) default NULL,
  `other_total` varchar(300) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `project_fund_other` */

/*Table structure for table `project_fund_tech` */

DROP TABLE IF EXISTS `project_fund_tech`;

CREATE TABLE `project_fund_tech` (
  `fund_other_total` float unsigned default NULL,
  `fund_tech_total` float default NULL,
  `actual_fund_total` float default NULL,
  `adjust_fund_total` float default NULL,
  `reduce_fund_total` float default NULL,
  `budget_fund_total` float default NULL COMMENT '任务书预算经费总和',
  `tech_total` varchar(300) default NULL,
  `the_year` varchar(10) default NULL,
  `id` int(11) NOT NULL auto_increment,
  `budget_fund` varchar(300) default NULL,
  `reduce_fund` varchar(300) default NULL,
  `adjust_fund` varchar(300) default NULL,
  `actual_fund` varchar(300) default NULL,
  `project_id` varchar(30) NOT NULL,
  `subject` year(4) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `project_fund_tech` */

insert  into `project_fund_tech`(`fund_other_total`,`fund_tech_total`,`actual_fund_total`,`adjust_fund_total`,`reduce_fund_total`,`budget_fund_total`,`tech_total`,`the_year`,`id`,`budget_fund`,`reduce_fund`,`adjust_fund`,`actual_fund`,`project_id`,`subject`) values (NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,2,'2_2_2_2_2_2_2_2_2_2_2','2_2_2_2_2_2_2_2_2_2_2','2_2_2_2_2_2_2_2_2_2_2','2_2_2_2_2_2_2_2_2_2_2','dev1449795502',NULL),(1,1,1,1,1,0,NULL,NULL,3,'1_1_1_1_1_1_1_1_1_1_1','1_1_1_1_1_1_1_1_1_1_1','1_1_1_1_1_1_1_1_1_1_1','1_1_1_1_1_1_1_1_1_1_1','dev1449804673',NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,4,'1_1_1_1_1_1_1_1_1_1_1','1_1_1_1_1_1_1_1_1_1_1','1_1_1_1_1_1_1_1_1_1_1','1_1_1_1_1_1_1_1_1_1_1','dev1449816291',NULL),(4.44444e+007,4.44444e+006,4,44,4.44444e+012,0,NULL,NULL,5,'1_1_1_1_1_1_1_1_1_1_1','1_1_1_1_1_1_1_1_1_1_1','1_1_1_1_1_1_1_1_1_1_1','1_1_1_1_1_1_1_1_1_1_1','dev1449823942',NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,6,'22_2_2_2_2_2_2_2_2_2_3','2_2_2_2_2_2_2_2_2_2_2','2_2_2_2_2_22_2_2_2_22_22','2_2_2_22_2_2_2_2_2_2_2','dev1449820432',NULL),(2222,222,222,222,222,0,NULL,NULL,7,'2_2_2_2_2_2_2_2_2_2_2','2_2_2_2_2_2_2_2_2_2_2','2_2_2_2_2_2_2_2_2_2_2','2_2_2_2_2_2_2_2_2_2_2','dev1449824019',NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,8,'1_111_1_1_1_1_1_1_1_1_11','11_1_11_1_1_1_11_1_1_1_1','1_1_1_1_1_1_1_1_1_11_1','1_1_1_1_1_11_1_1_11_1_1','dev1449831949',NULL),(1,1,1,1,1,0,NULL,NULL,9,'1_2_2_2_2_2_2_2_2_2_2','1_2_2_2_2_2_2_22_2_2_2','2_2_2_2_2_2_2_2_2_2_2','2_2_2_22_2_2_2_2_22_22_22','dev1449846462',NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,10,'1_1_1_1_1_1_1_1_1_1_1','1_1_1_1_1_1_1_1_1_1_1','1_1_1_1_1_1_1_1_1_1_1','1_1_1_1_1_1_1_1_1_1_1','dev1449849004',NULL),(11,11,0,22,3,0,NULL,NULL,11,'1_1_1_1_1_1_1_1_1_1_1','1_1_1_1_1_1_1_1_1_1_1','1_1_1_1_1_1_1_1_1_1_1','1_1_1_1_1_1_1_1_1_1_1','dev1449975160',NULL),(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,12,'1_1_11_1_1_1_1_1_1_1_1','1_1_1_1_1_1_1_1_1_1_1','1_1_11_1_1_1_1_1_1_1_1','1_1_21_-9_1_-9_1_1_1_1_1','dev1449989729',NULL);

/*Table structure for table `project_info` */

DROP TABLE IF EXISTS `project_info`;

CREATE TABLE `project_info` (
  `task_delegation_task` varchar(200) default NULL,
  `task_tech_way` varchar(500) default NULL,
  `others_material` varchar(500) default NULL,
  `id` int(11) NOT NULL auto_increment,
  `project_id` varchar(30) NOT NULL,
  `principal_id` int(11) default NULL,
  `undertake_id` int(11) default NULL,
  `cooperate_id` int(11) default NULL,
  `project_meaning` varchar(500) default NULL,
  `project_mission` varchar(500) default NULL,
  `project_aim` varchar(200) default NULL,
  `project_kpi` varchar(200) default NULL,
  `task_project_content` varchar(500) default NULL,
  `project_content` varchar(500) default NULL,
  `tech_way` varchar(500) default NULL,
  `project_manage` varchar(500) default NULL,
  `delegation_task` varchar(200) default NULL,
  `project_risk` varchar(200) default NULL,
  `task_project_expect` varchar(200) default NULL,
  `project_expect` varchar(200) default NULL,
  `project_effect` varchar(200) default NULL,
  `leader_opinion` varchar(200) default NULL,
  `expert_opinion` varchar(200) default NULL,
  `org_opinion` varchar(200) default NULL,
  `office_opinion` varchar(200) default NULL,
  `head_opinion` varchar(200) default NULL,
  `director_opinion` varchar(200) default NULL,
  `project_status` varchar(200) default NULL,
  `project_type` varchar(200) default NULL,
  `project_step` varchar(20) default NULL,
  `other_condition` varchar(200) default NULL,
  `business_id` varchar(30) default NULL,
  `ispass` int(11) default '0',
  `leader_name` varchar(20) default NULL,
  `leader_sex` varchar(2) default '0',
  `leader_birth` time default NULL,
  `leader_ID` varchar(30) default NULL,
  `leader_edu` varchar(10) default NULL,
  `leader_major` varchar(10) default NULL,
  `leader_phone` varchar(20) default NULL,
  `leader_address` varchar(100) default NULL,
  `leader_fax` varchar(20) default NULL,
  `leader_email` varchar(50) default NULL,
  `leader_achieve` varchar(200) default NULL,
  `leader_job` varchar(50) default NULL,
  `tech_pos` varchar(30) default NULL,
  `leader_postal` varchar(20) default NULL,
  `leader_tele` varchar(20) default NULL,
  `org_code` varchar(30) default NULL,
  `project_name` varchar(50) default NULL,
  `project_match` varchar(1000) default NULL COMMENT '、项目研究所需的配套条件及来源',
  `project_start` varchar(100) default NULL,
  `project_end` varchar(100) default NULL,
  `project_stage` int(11) default '0',
  `project_condition` int(11) default '1',
  `department` varchar(30) default NULL,
  `project_engineer` varchar(30) default NULL,
  `project_place` varchar(50) default NULL,
  `tech_area` varchar(50) default NULL,
  `project_advantage` varchar(500) default NULL,
  `tech_level` varchar(50) default NULL,
  `project_fund` double default NULL,
  `support_fund` double default NULL,
  `support_way` varchar(20) default NULL,
  `allocate_time` varchar(50) default NULL,
  `property_name` varchar(100) default NULL,
  `coproject_summary` varchar(1000) default NULL,
  `tech_achieve` varchar(500) default NULL,
  `social_benefit` varchar(500) default NULL,
  `planfinish_time` varchar(30) default NULL,
  `coorg` varchar(50) default NULL,
  `project_main` varchar(500) default NULL,
  `start_end` varchar(100) default NULL,
  `project_summary` varchar(1000) default NULL,
  `user_id` int(11) default NULL,
  `stage_process` varchar(20) default NULL,
  `file_path` varchar(500) default NULL,
  `project_money` varchar(100) NOT NULL,
  `project_argtime` varchar(100) default NULL,
  `isDelete` int(11) default '0',
  `create_time` varchar(30) NOT NULL,
  `is_save` int(2) unsigned default '0',
  `task_org_code` varchar(30) default NULL,
  `task_project_mission` varchar(500) default NULL,
  `task_project_aim` varchar(200) default NULL,
  `task_project_kpi` varchar(200) default NULL,
  `task_project_manage` varchar(500) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `project_info` */

insert  into `project_info`(`task_delegation_task`,`task_tech_way`,`others_material`,`id`,`project_id`,`principal_id`,`undertake_id`,`cooperate_id`,`project_meaning`,`project_mission`,`project_aim`,`project_kpi`,`task_project_content`,`project_content`,`tech_way`,`project_manage`,`delegation_task`,`project_risk`,`task_project_expect`,`project_expect`,`project_effect`,`leader_opinion`,`expert_opinion`,`org_opinion`,`office_opinion`,`head_opinion`,`director_opinion`,`project_status`,`project_type`,`project_step`,`other_condition`,`business_id`,`ispass`,`leader_name`,`leader_sex`,`leader_birth`,`leader_ID`,`leader_edu`,`leader_major`,`leader_phone`,`leader_address`,`leader_fax`,`leader_email`,`leader_achieve`,`leader_job`,`tech_pos`,`leader_postal`,`leader_tele`,`org_code`,`project_name`,`project_match`,`project_start`,`project_end`,`project_stage`,`project_condition`,`department`,`project_engineer`,`project_place`,`tech_area`,`project_advantage`,`tech_level`,`project_fund`,`support_fund`,`support_way`,`allocate_time`,`property_name`,`coproject_summary`,`tech_achieve`,`social_benefit`,`planfinish_time`,`coorg`,`project_main`,`start_end`,`project_summary`,`user_id`,`stage_process`,`file_path`,`project_money`,`project_argtime`,`isDelete`,`create_time`,`is_save`,`task_org_code`,`task_project_mission`,`task_project_aim`,`task_project_kpi`,`task_project_manage`) values (NULL,NULL,NULL,1550,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'科技成果转化项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'123456','wy-pig',NULL,NULL,NULL,0,1,NULL,'',NULL,'互联网和相关服务',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,0,'1449810810',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1551,'',NULL,NULL,NULL,'好','好','好','好',NULL,'好','好','好','好','好',NULL,'好','',NULL,NULL,'好',NULL,NULL,NULL,'好','科技成果转化项目',NULL,NULL,NULL,0,'11','01','00:00:11','11','11','11','11','11','11','111','大家好啊','11','11','11','11','123456','wy-pig',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'互联网和相关服务',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,15,'0,1,2,3',NULL,'',NULL,0,'1449810810',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1552,'',NULL,NULL,NULL,'22','22','22','22',NULL,'22','22','22','22','222',NULL,'222','',NULL,NULL,'2',NULL,NULL,NULL,'22','科技成果转化项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'123456','wy-pig',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'互联网和相关服务',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'0,1,2,3',NULL,'',NULL,0,'1449810810',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1553,'dev1449726361',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'bjqskj001',NULL,NULL,NULL,NULL,0,1,'发展计划科',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,17,'0,1,2,3',NULL,'',NULL,0,'1449726361',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1554,'dev1449726614',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,'',0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'bjqskj001','xiangmu',NULL,NULL,NULL,2,1,'发展计划科','',NULL,'互联网和相关服务',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,17,'0,1,2,3',NULL,'',NULL,0,'1449726614',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1555,'dev1449726854',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'10010',NULL,NULL,NULL,NULL,0,1,'发展计划科',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'0,1,2,3',NULL,'',NULL,0,'1449726854',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1556,'dev1449727470',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,'',0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'123',' xx',NULL,NULL,NULL,3,1,'发展计划科','',NULL,'软件和信息技术服务业',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'0,1,2,3',NULL,'',NULL,0,'1449727470',1,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1557,'dev1449727470',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,'',0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'123',' xx',NULL,NULL,NULL,3,1,'发展计划科','',NULL,'软件和信息技术服务业',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,18,'0,1,2,3',NULL,'',NULL,0,'1449727470',1,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1558,'',NULL,NULL,NULL,'好','好','好','好',NULL,'好','好','好','好','',NULL,'','',NULL,NULL,'好',NULL,NULL,NULL,'好','科技成果转化项目',NULL,NULL,NULL,0,'王依','0','00:00:00','111','啊啊','111','啊啊','11','啊啊','111','1142424','11','11','11','111','123456','wy-pig',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'互联网和相关服务',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'0,1,2,3',NULL,'',NULL,0,'1449810810',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1559,'',NULL,NULL,NULL,'好','好','好','好',NULL,'好','好','好','好','',NULL,'','',NULL,NULL,'好',NULL,NULL,NULL,'好','科技成果转化项目',NULL,NULL,NULL,0,'王依','0','00:00:00','111','啊啊','111','啊啊','11','啊啊','111','1142424','11','11','11','111','123456','wy-pig',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'互联网和相关服务',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,15,'0,1,2,3',NULL,'',NULL,0,'1449810810',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1560,'dev1449728243',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'科技成果转化项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'10010',NULL,NULL,NULL,NULL,0,1,'发展计划科',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'0,1,2,3',NULL,'',NULL,0,'1449728243',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1561,'dev1449728333',NULL,NULL,NULL,NULL,'3','3','3',NULL,'3','3','3','3',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,'',0,'2','2','00:00:02','2','2','2','2','2','2','2','2','2','2','2','2','10010','liming --自主研发项目 1',NULL,NULL,NULL,3,1,'发展计划科','',NULL,'软件和信息技术服务业',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'0,1,2,3',NULL,'',NULL,0,'1449728333',1,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1562,'dev1449728991',NULL,NULL,NULL,NULL,'','','',NULL,'','','','','',NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,'',0,'z','q','00:00:00','q','q','q','q','q','qq','q','q','qq','q','q','q','123456','test_马闯',NULL,NULL,NULL,3,1,'发展计划科','',NULL,'软件和信息技术服务业',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,19,'0,1,2,3',NULL,'',NULL,0,'1449728991',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,'11',1563,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'好',NULL,NULL,NULL,NULL,'科技成果转化项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'123456','wy-pig',NULL,NULL,NULL,0,1,NULL,'','通州','互联网和相关服务',NULL,'通州',NULL,NULL,NULL,NULL,NULL,'好','好','好',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,0,'1449810810',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1564,'dev1449729105',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'加强创新平台建设专项资金',NULL,NULL,'KJ2015CX001',0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'123','01',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'软件和信息技术服务业',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,18,'0',NULL,'',NULL,0,'1449729105',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1565,'dev1449729140',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'bjqskj001','tt',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'软件和信息技术服务业',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,17,'0,1,2,3',NULL,'',NULL,0,'1449729140',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1566,'',NULL,NULL,NULL,'好','好','好','好',NULL,'哈','哈','好','好','好',NULL,'好','',NULL,NULL,'好',NULL,NULL,NULL,'好','科技成果转化项目',NULL,NULL,NULL,0,'郑艳艳','01','00:00:00','11','11','软件开发','阿瑟帝国','11','66157731','111','啊啊','11','软件工程师','11','11','123456','wy-pig',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'互联网和相关服务',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,15,'0,1,2,3','/upload/dev1449729636/15-12-10/4720cad61fad4c20dabc1e2472227bcdbf094f13.jpg','',NULL,0,'1449810810',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1567,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'科技成果转化项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'123456','wy-pig',NULL,NULL,NULL,0,1,NULL,'',NULL,'互联网和相关服务',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,0,'1449810810',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1568,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'科技成果转化项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'123456','wy-pig',NULL,NULL,NULL,0,1,NULL,'',NULL,'互联网和相关服务',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,0,'1449810810',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1569,'dev1449730016',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,'',0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'bjqskj001','测试的项目002',NULL,NULL,NULL,3,1,'发展计划科','',NULL,'软件和信息技术服务业',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,17,'0,1,2,3',NULL,'',NULL,0,'1449730017',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1570,'com1449730038',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'支持为高新技术企业认定提供鉴证服务',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'123456','支持为高新技术企业认定提供鉴证服务_test_mac',NULL,NULL,NULL,0,1,'科技综合科','',NULL,'互联网和相关服务',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,19,'0',NULL,'',NULL,0,'1449730038',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1571,'dev1449731646',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'支持承担市级以上的科技项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'10010',NULL,NULL,NULL,NULL,0,1,'发展计划科',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'0',NULL,'',NULL,0,'1449731646',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1572,'dev1449731666',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'支持承担市级以上的科技项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'10010','liming - 支持承担市级以上的科技项目 3',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'互联网和相关服务',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'0',NULL,'',NULL,0,'1449731666',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1573,'dev1449731679',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'加强创新平台建设专项资金',NULL,NULL,'',0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'123','02',NULL,NULL,NULL,3,1,'发展计划科','',NULL,'软件和信息技术服务业',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,18,'0,1,2,3',NULL,'',NULL,0,'1449731679',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1574,'com1449732016',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'支持为高新技术企业认定提供鉴证服务',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'123456','mac',NULL,NULL,NULL,0,1,'科技综合科','',NULL,'软件和信息技术服务业',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,19,'0,1,2,3',NULL,'',NULL,0,'1449732016',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1575,'dev1449732172',NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'娃娃啊',NULL,NULL,NULL,NULL,'hhhhh','支持承担市级以上的科技项目',NULL,NULL,'KJ2015CX005',0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'123456','ppp',NULL,NULL,NULL,1,1,'发展计划科','',NULL,'互联网和相关服务',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,19,'0,1,2,3',NULL,'',NULL,0,'1449732172',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1576,'com1449732214',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'支持技术转移',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'123456','kkk',NULL,NULL,NULL,0,1,'科技综合科','',NULL,'软件和信息技术服务业',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,19,'0,1,2,3',NULL,'',NULL,0,'1449732214',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1577,'dev1449732605',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'产学研合作项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'bjqskj001','测试的项003',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'技术推广和应用服务业',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,17,'0,1,2,3','/upload/dev1449732605/15-12-10/4445a55454d8469b56bf8bc989cfd4d03a8bb542.png','',NULL,0,'1449732605',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1578,'dev1449732905',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'科技成果转化项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'10010','liming - 科技成果转化项目 22',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'互联网和相关服务',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'0,1,2,3',NULL,'',NULL,0,'1449732906',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1579,'dev1449732956',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'支持承担市级以上的科技项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'10010','liming - 支持承担市级以上的科技项目 111',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'互联网和相关服务',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'0,1,2,3',NULL,'',NULL,0,'1449732956',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1580,'dev1449733163',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'10010',NULL,NULL,NULL,NULL,0,1,'发展计划科',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'0,1,2,3',NULL,'',NULL,0,'1449733163',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1581,'dev1449733272',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'10010','110自主研发项目',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'互联网和相关服务',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'0,1,2,3',NULL,'',NULL,0,'1449733272',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1582,'dev1449733402',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'10010','1',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'互联网和相关服务',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'0,1,2,3',NULL,'',NULL,0,'1449733402',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1583,'dev1449733415',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'10010','2',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'互联网和相关服务',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'0,1,2,3',NULL,'',NULL,0,'1449733415',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1584,'dev1449733429',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'10010','99自主研发项目',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'软件和信息技术服务业',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'0,1,2,3',NULL,'',NULL,0,'1449733429',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1585,'dev1449733457',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,'',0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'10010','为什么想出错的时候 他就是不出错呢 ？',NULL,NULL,NULL,3,1,'发展计划科','',NULL,'软件和信息技术服务业',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'0,1,2,3',NULL,'',NULL,0,'1449733457',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1586,'dev1449733598',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'10010','liming - 自主研发项目 22',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'软件和信息技术服务业',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'0,1,2,3',NULL,'',NULL,0,'1449733598',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1587,'dev1449733619',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'产学研合作项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'10010','1',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'软件和信息技术服务业',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'0,1,2,3',NULL,'',NULL,0,'1449733619',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1588,'com1449733669',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'支持初创期科技企业孵化器、大学科技园发展项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'10010','33',NULL,NULL,NULL,0,1,'科技综合科','',NULL,'软件和信息技术服务业',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'0,1,2,3',NULL,'',NULL,0,'1449733669',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1589,'dev1449733682',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'10010','333',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'互联网和相关服务',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'0,1,2,3',NULL,'',NULL,0,'1449733682',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1590,'',NULL,NULL,NULL,'2','2','2','2',NULL,'2','2','2','2','',NULL,'','',NULL,NULL,'3',NULL,NULL,NULL,'2','科技成果转化项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'123456','wy-pig',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'互联网和相关服务',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'0,1,2,3',NULL,'',NULL,0,'1449810810',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1591,'dev1449733744',NULL,NULL,NULL,'没有什么必要不必要的','这个是考核的目标','这个是考核的指标','这个是考核的',NULL,NULL,'技术方案以及技术的路线','技术路线','技术的路线哈哈',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'没有什么工作基础','自主研发项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'bjqskj001','自主研发项目测试001',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'软件和信息技术服务业',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,17,'0,1,2,3',NULL,'',NULL,0,'1449733744',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1592,'dev1449733930',NULL,NULL,NULL,NULL,'好','好','好',NULL,NULL,'好','好','好',NULL,NULL,'',NULL,NULL,'发送到 ',NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,'',0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'bjqskj001','昔年',NULL,NULL,NULL,3,1,'发展计划科','',NULL,'软件和信息技术服务业',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,15,'0,1,2,3',NULL,'',NULL,0,'1449733930',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1593,'dev1449735376',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'支持承担市级以上的科技项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'10010','支持承担市级以上的科技项目  liming ',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'软件和信息技术服务业',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'0,1,2,3',NULL,'',NULL,0,'1449735376',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1594,'com1449735781',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'支持为高新技术企业认定提供鉴证服务',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'10010','支持为高新技术企业认定提供鉴证服务 11',NULL,NULL,NULL,0,1,'科技综合科','',NULL,'互联网和相关服务',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'0,1,2,3',NULL,'',NULL,0,'1449735781',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1595,'dev1449736735',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'bjqskj001','测试的自主研发项目',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'软件和信息技术服务业',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,17,'0,1,2,3',NULL,'',NULL,0,'1449736735',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1596,'dev1449738663',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'10010',NULL,NULL,NULL,NULL,0,1,'发展计划科',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'0,1,2,3',NULL,'',NULL,0,'1449738663',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1597,'',NULL,NULL,NULL,'2','2','2','2',NULL,'2','2','2','2','',NULL,'','',NULL,NULL,'2w',NULL,NULL,NULL,'2','科技成果转化项目',NULL,NULL,NULL,0,'222','2','00:00:02','2','2','2','2','2','2','2','2','2','2','2','2','123456','wy-pig',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'互联网和相关服务',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'0,1,2,3',NULL,'',NULL,0,'1449810810',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1598,'dev1449738698',NULL,NULL,NULL,'www','66','66','66',NULL,'66','66','66','66','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'www',NULL,NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'10010',NULL,NULL,NULL,NULL,0,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,0,'',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1599,'dev1449739261',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'科技成果转化项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'bjqskj001',NULL,NULL,NULL,NULL,0,1,'发展计划科',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,15,'0,1,2,3',NULL,'',NULL,0,'1449739261',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1600,'dev1449741563',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'10010','对对对',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'软件和信息技术服务业',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'0,1,2,3',NULL,'',NULL,0,'1449741563',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1601,'dev1449742184',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'支持承担市级以上的科技项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'10010',NULL,NULL,NULL,NULL,0,1,'发展计划科',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,15,'0,1,2,3',NULL,'',NULL,1,'1449742184',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1602,'dev1449742458',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'10010','111',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'互联网和相关服务',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'0,1,2,3',NULL,'',NULL,0,'1449742458',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1603,'dev1449742467',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'10010','22',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'软件和信息技术服务业',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'0,1,2,3',NULL,'',NULL,0,'1449742467',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1604,'dev1449742475',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'10010','33',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'技术推广和应用服务业',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'0,1,2,3',NULL,'',NULL,0,'1449742475',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1605,'dev1449742482',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'10010','44',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'互联网和相关服务',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'0,1,2,3',NULL,'',NULL,0,'1449742482',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1606,'dev1449793674',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'10010',NULL,NULL,NULL,NULL,0,1,'发展计划科',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'0,1,2,3',NULL,'',NULL,0,'1449793674',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1607,'',NULL,NULL,NULL,'李明','李明','李明','李明',NULL,'李明','李明','李明','李明',NULL,NULL,NULL,NULL,NULL,NULL,'李明',NULL,NULL,NULL,'李明','科技成果转化项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'123456','wy-pig',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'互联网和相关服务',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'0,1,2,3',NULL,'',NULL,0,'1449810810',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1608,'dev1449793701',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,'','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'1','1','00:00:01','1','1','1','1','1','1','1','1','1','1','1','1','10010',NULL,NULL,NULL,NULL,0,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,0,'',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1609,'',NULL,NULL,NULL,'李明','李明','李明','李明',NULL,'李明','李明','李明','李明','李明',NULL,'李明','',NULL,NULL,'李明',NULL,NULL,NULL,'李明','科技成果转化项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'123456','wy-pig',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'互联网和相关服务',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'0,1,2,3',NULL,'',NULL,0,'1449810810',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1610,'dev1449793951',NULL,NULL,NULL,'李明','李明','李明','李明',NULL,'李明','李明','李明','李明',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'李明',NULL,NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'10010',NULL,NULL,NULL,NULL,0,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,0,'',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1611,'dev1449794525',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,'KJ2015CX001',0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'千松','work',NULL,NULL,NULL,1,1,'发展计划科','',NULL,'互联网和相关服务',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,15,'0,1,2,3',NULL,'',NULL,0,'1449794525',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1612,'dev1449794760',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'10010','12-11 8 - 45',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'软件和信息技术服务业',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'0,1,2,3',NULL,'',NULL,0,'1449794760',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1613,'dev1449795038',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'bjqskj001',NULL,NULL,NULL,NULL,0,1,'发展计划科',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,17,'0,1,2,3',NULL,'',NULL,0,'1449795038',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1614,'dev1449795125',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'10010',NULL,NULL,NULL,NULL,0,1,'发展计划科',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'0,1,2,3',NULL,'',NULL,0,'1449795125',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1615,'dev1449795166',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'bjqskj001','测试项目003',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'互联网和相关服务',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,17,'0,1,2,3',NULL,'',NULL,0,'1449795166',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1616,'dev1449795183',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'10010',NULL,NULL,NULL,NULL,0,1,'发展计划科',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'0,1,2,3',NULL,'',NULL,0,'1449795183',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1617,'dev1449795203',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'bjqskj001','测试项目004',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'互联网和相关服务',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,17,'0,1,2,3',NULL,'',NULL,0,'1449795203',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1618,'dev1449795277',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'10010',NULL,NULL,NULL,NULL,0,1,'发展计划科',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'0,1,2,3',NULL,'',NULL,0,'1449795277',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1619,'dev1449795363',NULL,NULL,NULL,'8-59','8-59','8-59','8-59',NULL,'8-59','8-59','8-59','8-59',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'8-59','自主研发项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'10010','8-55',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'软件和信息技术服务业',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'0,1,2,3',NULL,'',NULL,0,'1449795363',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1620,'dev1449795365',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'bjqskj001','测试项目005',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'技术推广和应用服务业',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,17,'0,1,2,3',NULL,'',NULL,0,'1449795365',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1621,'dev1449795399',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'10010',NULL,NULL,NULL,NULL,0,1,'发展计划科',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'0,1,2,3',NULL,'',NULL,0,'1449795399',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1622,'dev1449795502',NULL,NULL,NULL,'2','2','2','2',NULL,'2','2','2','2','../../../../../../website/html/view/template/total_fund.php',NULL,'../../../../../../website/html/view/template/total_fund.php','../../../../../../website/html/view/template/total_fund.php',NULL,NULL,'../../../../../../website/html/view/template/total_fund.php',NULL,NULL,NULL,'2','自主研发项目',NULL,NULL,NULL,0,'2','2','00:00:02','2','2','2','2','2','2','2','2','2','2','2','2','10010','8-58',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'软件和信息技术服务业',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'0,1,2,3',NULL,'',NULL,0,'1449795502',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1623,'dev1449795524',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'bjqskj001','测试项目006',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'互联网和相关服务',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,17,'0,1,2,3',NULL,'',NULL,0,'1449795524',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1624,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'total_funds',NULL,'total_funds','',NULL,NULL,'project_effect',NULL,NULL,NULL,NULL,'科技成果转化项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'123456','wy-pig',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'互联网和相关服务',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'0,1,2,3',NULL,'',NULL,0,'1449810810',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1625,'dev1449795743',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'bjqskj001','测试项目006',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'互联网和相关服务',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,17,'0,1,2,3',NULL,'',NULL,0,'1449795743',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1626,'dev1449795921',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'bjqskj001','测试项目007',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'软件和信息技术服务业',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,17,'0,1,2,3',NULL,'',NULL,0,'1449795921',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1627,'dev1449795935',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'bjqskj001','测试项目008',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'技术推广和应用服务业',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,17,'0,1,2,3',NULL,'',NULL,0,'1449795935',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1628,'dev1449795946',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'bjqskj001','测试项目009',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'互联网和相关服务',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,17,'0,1,2,3',NULL,'',NULL,0,'1449795946',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1629,'dev1449796002',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'bjqskj001','测试项目010',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'互联网和相关服务',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,17,'0,1,2,3',NULL,'',NULL,0,'1449796002',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1630,'dev1449796202',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'bjqskj001','自主研发项目测试001',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'互联网和相关服务',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,17,'0,1,2,3',NULL,'',NULL,0,'1449796202',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1631,'dev1449796589',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'bjqskj001','自主研发项目005',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'互联网和相关服务',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,17,'0,1,2,3',NULL,'',NULL,0,'1449796589',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1632,'dev1449804673',NULL,NULL,NULL,'什么啊什么啊什么啊什么啊','什么啊什么啊什么啊什么啊','什么啊什么啊什么啊什么啊','什么啊什么啊什么啊什么啊',NULL,'什么啊什么啊什么啊什么啊','什么啊什么啊什么啊什么啊','什么啊什么啊什么啊什么啊','什么啊什么啊什么啊什么啊','什么啊什么啊什么啊什么啊',NULL,'实施','project_expect',NULL,'一样','project_expect',NULL,NULL,NULL,'什么啊什么啊什么啊什么啊','自主研发项目',NULL,'other_condition_form','',0,'1','1','00:00:01','1','1','1','1','1','1','1','1','1','1','1','1','10010','午饭吃什么-自主研发项目 ',NULL,NULL,NULL,3,1,'发展计划科','',NULL,'互联网和相关服务',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'0,1,2,3',NULL,'',NULL,0,'1449804673',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1633,'dev1449810523',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'产学研合作项目',NULL,NULL,'KJ2015CX001',0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'千松','产学研合作项目-----wy',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'软件和信息技术服务业',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,15,'0',NULL,'',NULL,0,'1449810523',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1634,'dev1449810810',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'123456',NULL,NULL,NULL,NULL,0,1,'发展计划科',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,19,'0',NULL,'',NULL,0,'1449810810',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1635,'dev1449810838',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'科技成果转化项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'123456','科技成果转化项目',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'互联网和相关服务',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,19,'0',NULL,'',NULL,0,'1449810838',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1636,'com1449810886',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'支持技术输出能力提升项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'123456','支持技术输出能力提升项目',NULL,NULL,NULL,0,1,'科技综合科','',NULL,'互联网和相关服务',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,19,'0,1,2,3',NULL,'',NULL,0,'1449810886',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1637,'dev1449811384',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'产学研合作项目',NULL,NULL,'KJ2015CX001',0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'千松','产学研项目------wy2',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'软件和信息技术服务业',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,15,'0',NULL,'',NULL,0,'1449811384',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1638,'dev1449812670',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'产学研合作项目',NULL,NULL,'KJ2015CX001',0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'千松','产学研合作项目-----wy3',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'软件和信息技术服务业',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,15,'0',NULL,'',NULL,0,'1449812670',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1639,'dev1449814100',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'10010','苦苦追问',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'互联网和相关服务',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'0,1,2,3',NULL,'',NULL,0,'1449814100',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1640,'dev1449815200',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,'KJ2015CX001',0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'bjqskj001','猪猪--lm',NULL,NULL,NULL,1,1,'发展计划科','',NULL,'软件和信息技术服务业',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,15,'0,1,2,3',NULL,'',NULL,0,'1449815200',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1641,'dev1449815671',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,'KJ2015CX001',0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'bjqskj001','哎呀呀',NULL,NULL,NULL,1,1,'发展计划科','',NULL,'软件和信息技术服务业',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,15,'0,1,2,3',NULL,'',NULL,0,'1449815671',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1642,'dev1449816099',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,'KJ2015CX002',0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'bjqskj001','自主研发------',NULL,NULL,NULL,1,1,'发展计划科','',NULL,'互联网和相关服务',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,15,'0,1,2,3',NULL,'',NULL,0,'1449816099',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1643,'dev1449816291',NULL,NULL,NULL,NULL,'working','working','working',NULL,'working','working','working','',NULL,NULL,'working',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,'KJ2015CX003',0,'yiyi','0','00:12:22','2323224','1','232','111','2321','23213','213','213','312','1231','231','213','123456','最后一个',NULL,NULL,NULL,1,1,'发展计划科','',NULL,'互联网和相关服务',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,15,'0,1,2,3',NULL,'',NULL,0,'1449816291',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1644,'com1449816577',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'支持为高新技术企业认定提供鉴证服务',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'bjqskj001','支持为高新技术企业认定提供见证服务001',NULL,NULL,NULL,0,1,'科技综合科','',NULL,'软件和信息技术服务业',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,15,'0,1,2,3',NULL,'',NULL,0,'1449816577',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1645,'dev1449817998',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,'KJ2015CX004',0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'bjqskj001','测试--显示失败',NULL,NULL,NULL,1,1,'发展计划科','',NULL,'软件和信息技术服务业',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,15,'0,1,2,3',NULL,'',NULL,0,'1449817998',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1646,'dev1449819726',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,'KJ2015CX001',0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'10010','wangyi  is pig',NULL,NULL,NULL,1,1,'发展计划科','',NULL,'互联网和相关服务',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'0,1,2,3',NULL,'',NULL,0,'1449819726',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1647,'dev1449820432',NULL,NULL,NULL,'反反复复','ssss','sssssss','ssss',NULL,'111','哦哦哦','是是是','对对对','111',NULL,'111','11111',NULL,NULL,NULL,NULL,NULL,NULL,'111','自主研发项目',NULL,'休息休息','',0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'123456','自主研发项目test2222222',NULL,NULL,NULL,3,1,'发展计划科','',NULL,'软件和信息技术服务业',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,19,'0,1,2,3',NULL,'',NULL,0,'1449820432',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,'好',1648,'dev1449821283',NULL,NULL,NULL,'working','working','working','working',NULL,'working','working','working','working','working',NULL,'working','working',NULL,NULL,'working',NULL,NULL,NULL,'working','产学研合作项目',NULL,NULL,NULL,0,'11','0','00:00:11','11','11','11','1111','111','11','11','1111','11','11','11','11','千松','ceshi',NULL,NULL,NULL,0,1,'发展计划科','','通州','互联网和相关服务',NULL,'好',NULL,NULL,NULL,NULL,NULL,'好','好','好',NULL,NULL,NULL,NULL,NULL,15,'0',NULL,'',NULL,0,'1449821283',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1649,'dev1449821637',NULL,NULL,NULL,'2','3','3','3',NULL,'3','3','3','3','2',NULL,'22','22',NULL,'sis  wingfe ide yi de sh shenme uuan aiui de sjis d aa','2',NULL,NULL,NULL,'33','自主研发项目',NULL,'sssss','',0,'2','女','00:00:02','2','2','2','2','2','2','2','2','2','2','2','2','10010','once agin',NULL,NULL,NULL,3,1,'发展计划科','',NULL,'互联网和相关服务',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'0,1,2,3',NULL,'',NULL,0,'1449821637',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1650,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,0,'',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1651,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,0,'',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1652,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,0,'',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1653,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,0,'',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1654,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,0,'',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1655,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,0,'',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1656,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,0,'',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1657,'dev1449823454',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'10010','test1',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'互联网和相关服务',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'0,1,2,3',NULL,'',NULL,0,'1449823454',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1658,'dev1449823464',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'10010','test2',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'互联网和相关服务',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'0,1,2,3',NULL,'',NULL,0,'1449823464',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1659,'dev1449823472',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'科技成果转化项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'10010','test3',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'软件和信息技术服务业',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'0',NULL,'',NULL,0,'1449823472',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1660,'dev1449823482',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'产学研合作项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'10010','test4',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'互联网和相关服务',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'0',NULL,'',NULL,0,'1449823482',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1661,'com1449823489',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'支持技术输出能力提升项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'10010','test5',NULL,NULL,NULL,0,1,'科技综合科','',NULL,'软件和信息技术服务业',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'0,1,2,3',NULL,'',NULL,0,'1449823489',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1662,'dev1449823496',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'支持研发设计等服务机构发展项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'10010','test6',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'软件和信息技术服务业',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'0',NULL,'',NULL,0,'1449823496',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1663,'dev1449823561',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'10010','liming- test7',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'互联网和相关服务',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'0,1,2,3',NULL,'',NULL,0,'1449823561',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1664,'dev1449823602',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'10010','liming -- test 22',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'软件和信息技术服务业',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'0,1,2,3',NULL,'',NULL,0,'1449823602',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1665,'com1449823637',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','支持市级以上科技企业孵化器资质认证及后期运营项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0021','liming - yes ',NULL,NULL,NULL,0,1,'科技综合科','',NULL,'互联网和相关服务',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'0,1,2,3',NULL,'',NULL,0,'1449823637',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1666,'dev1449823942',NULL,NULL,NULL,'你猜','你猜','你猜','你猜',NULL,'你猜','你猜','你猜','你猜','你猜',NULL,'你猜','你猜',NULL,NULL,'你猜',NULL,NULL,NULL,'你猜','自主研发项目',NULL,NULL,NULL,0,'2','2','00:00:02','2','2','2','2','2','2','2','','2','2','2','2','001','piao - 自主研发项目 ',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'软件和信息技术服务业',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,22,'0,1,2,3',NULL,'',NULL,0,'1449823943',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1667,'dev1449824019',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'产学研合作项目',NULL,NULL,NULL,0,'1','1','00:00:01','1','1','1','1','1','1','1','1','1','1','1','1','001','piao - 产学研合作项目',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'软件和信息技术服务业',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,22,'0',NULL,'',NULL,0,'1449824019',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1668,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,0,'',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1669,'dev1449831880',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,'KJ2015CX006',0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0001','自主研发啦-----嘻嘻',NULL,NULL,NULL,1,1,'发展计划科','',NULL,'电子信息',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,21,'0,1,2,3',NULL,'',NULL,0,'1449831880',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1670,'dev1449831949',NULL,NULL,NULL,'啊啊啊','啊啊啊','啊啊啊','啊啊啊',NULL,'啊啊啊','啊啊啊','啊啊啊','啊啊啊','1',NULL,'1111','111',NULL,'ffff',' 写的',NULL,NULL,NULL,'啊啊啊','自主研发项目',NULL,'烦烦烦','',0,'11','0','00:00:11','11','11','11','11','11','11','11','','111','1','11','11','123456','正式的测试—first——马闯',NULL,NULL,NULL,3,1,'发展计划科','',NULL,'电子信息',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,19,'0,1,2,3',NULL,'',NULL,0,'1449831949',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1671,'dev1449833042',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'产学研合作项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0001','产学研项目',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'新材料',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,21,'0',NULL,'',NULL,0,'1449833042',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1672,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,0,'',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1673,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,0,'',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1674,'dev1449833482',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'003','自主研发项目 night',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'能源与节能',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,22,'0,1,2,3',NULL,'',NULL,0,'1449833482',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1675,'dev1449836878',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,'KJ2015CX007',0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0001','自主研发项目-------11111',NULL,NULL,NULL,1,1,'发展计划科','',NULL,'电子信息',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,21,'0,1,2,3',NULL,'',NULL,0,'1449836878',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1676,'dev1449838777',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0021','1',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'电子信息',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'0,1,2,3',NULL,'',NULL,0,'1449838777',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1677,'dev1449838783',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0021','2',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'生物医药',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'0,1,2,3',NULL,'',NULL,0,'1449838783',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1678,'dev1449838789',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0021','4',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'新材料',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'0,1,2,3',NULL,'',NULL,0,'1449838789',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1679,'dev1449838794',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0021','3',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'先进制造与自动化',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'0,1,2,3',NULL,'',NULL,0,'1449838794',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1680,'dev1449839187',NULL,NULL,NULL,'地对地导弹','地对地导弹','的的对的的坎坎坷坷 的的','快快快',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'擦擦擦顶顶顶顶顶v','自主研发项目',NULL,NULL,'KJ2015CX008',0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'123456','test2',NULL,NULL,NULL,1,1,'发展计划科','',NULL,'生物医药',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,19,'0,1,2,3',NULL,'',NULL,0,'1449839187',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1681,'com1449842834',NULL,NULL,NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'支持技术输出能力提升项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0021','支持技术输出能力提升项目001',NULL,NULL,NULL,0,1,'科技综合科','',NULL,'新材料',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'0,1,2,3','/upload/com1449842834/15-12-11/a00ba83d3a1c1112d15e7e8c8a3252e100248fb6.jpg','',NULL,0,'1449842834',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1682,'com1449843136',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'支持为高新技术企业认定提供鉴证服务',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0021','支持为高新技术企业认定提供鉴证服务001',NULL,NULL,NULL,0,1,'科技综合科','',NULL,'新材料',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'0,1,2,3',NULL,'',NULL,0,'1449843136',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1683,'com1449843942',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'支持为高新技术企业认定提供鉴证服务',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0021','支持为高新技术企业认定提供鉴证服务001',NULL,NULL,NULL,0,1,'科技综合科','',NULL,'能源与节能',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'0,1,2,3',NULL,'',NULL,0,'1449843942',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1684,'com1449843960',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'支持为高新技术企业认定提供鉴证服务',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0021','支持为高新技术企业认定提供鉴证服务002',NULL,NULL,NULL,0,1,'科技综合科','',NULL,'新材料',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'0,1,2,3',NULL,'',NULL,0,'1449843960',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1685,'dev1449844017',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'支持研发设计等服务机构发展项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0021','支持研发设计等服务机构发展项目001',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'生物医药',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'0',NULL,'',NULL,0,'1449844017',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1686,'com1449844049',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'支持为高新技术企业认定提供鉴证服务',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0021','支持为高新技术企业认定提供鉴证服务003',NULL,NULL,NULL,0,1,'科技综合科','',NULL,'能源与节能',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'0,1,2,3',NULL,'',NULL,0,'1449844049',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1687,'dev1449844059',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'支持重点功能区及园区建设申报指南',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0021','支持重点功能区及园区建设申报指南001',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'电子信息',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'0',NULL,'',NULL,0,'1449844059',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1688,'com1449844073',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'支持购买区内单位技术服务项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0021','支持购买区内单位技术服务项目001',NULL,NULL,NULL,0,1,'科技综合科','',NULL,'新材料',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'0,1,2,3',NULL,'',NULL,0,'1449844073',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1689,'dev1449846462',NULL,NULL,NULL,'没有','、项目任务：（项目任务应明确科技工作在解决实际问题中的责任和完成工作的范围、界限，即项目全部工作和成果的整体描述。）','、项目任务：（项目任务应明确科技工作在解决实际问题中的责任和完成工作的范围、界限，即项目全部工作和成果的整体描述。）','、项目任务：（项目任务应明确科技工作在解决实际问题中的责任和完成工作的范围、界限，即项目全部工作和成果的整体描述。）',NULL,'、项目任务：（项目任务应明确科技工作在解决实际问题中的责任和完成工作的范围、界限，即项目全部工作和成果的整体描述。）','（依据项目任务要求，结合国内外技术发展和本单位实际情况确定，论证前应充分分析和阐述技术方案与技术路线，对不同方案和路线加以比较和论证说明。）\r\n','（依据项目任务要求，结合国内外技术发展和本单位实际情况确定，论证前应充分分析和阐述技术方案与技术路线，对不同方案和路线加以比较和论证说明。）\r\n','（依据项目任务要求，结合国内外技术发展和本单位实际情况确定，论证前应充分分析和阐述技术方案与技术路线，对不同方案和路线加以比较和论证说明。）\r\n','风险含市场风险、技术风险、政策风险、管理风险等，风险分析需说明有可能存在的风险。）',NULL,'预期成果形式、知识产权归属于管理','（项目完成后的经济社会效益分析应与项目的目的、意义及必要性相对应。成果推广方案应明确项目成果的应用推广领域、拟采取的具体推广措施或推广计划等）',NULL,'论证专家组组长（签字）:','项目各年度任务目标、考核指标及研究开发内容完成的计划进度',NULL,NULL,NULL,'项目相关行业、领域国内外研究发展现状、趋势以及本单位在相关领域的工作基础','自主研发项目',NULL,'其他条款','',0,'1','1','00:00:01','1','1','1','1','1','1','1','1','1','1','1','1','0021','自主研发项目 007',NULL,NULL,NULL,3,1,'发展计划科','',NULL,'先进制造与自动化',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'0,1,2,3','/upload/dev1449846462/15-12-11/4f5734326194f590e13152a46b1abfd14b691ec2.jpg','',NULL,0,'1449846462',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1690,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,0,'',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1691,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,0,'',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1692,'dev1449849004',NULL,NULL,NULL,'好','好','好','好',NULL,'好','好','好','好','好',NULL,'好','好',NULL,'好','好',NULL,NULL,NULL,'好','自主研发项目',NULL,'好','KJ2015CX009',0,'好','男2','00:00:22','22','2','2','2','2','2','2','22','2','2','2','2','0001','自主研发----测试',NULL,NULL,NULL,2,1,'发展计划科','',NULL,'生物医药',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,21,'0,1,2,3','/upload/dev1449849004/15-12-11/da533c33b96b4507c2fcd1910d5d21a487592112.jpg','',NULL,0,'1449849004',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1693,'dev1449849541',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,NULL,0,'1','1','00:00:02','1','1','1','1','1','1','11','','1','1','1','1','0021','自主研发项目 333',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'新材料',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'0',NULL,'',NULL,0,'1449849541',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1694,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,0,'',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1695,'dev1449975160',NULL,NULL,NULL,'什么 是是什么','什么 是是什么','什么 是是什么','什么 是是什么',NULL,'什么 是是什么','什么 是是什么','什么 是是什么','什么 是是什么','什么 是是什么',NULL,'什么 是是什么','什么 是是什么',NULL,NULL,'什么 是是什么',NULL,NULL,NULL,'什么 是是什么','自主研发项目',NULL,NULL,NULL,0,'1','1','00:00:01','1','1','1','1','1','1','1','','1','1','1','1','0021','自主研发项目000020',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'生物医药',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'0',NULL,'',NULL,0,'1449975160',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1696,'dev1449983915',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'产学研合作项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0021','客户尽快结婚',NULL,NULL,NULL,2,1,'发展计划科','',NULL,'电子信息',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'2',NULL,'',NULL,0,'1449983915',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1697,'dev1449989729',NULL,NULL,NULL,'22222','22222222222','2222','222222222',NULL,'22222222','2222222','2222222222','2222222','人人人人人人人',NULL,'222','2222',NULL,NULL,'22222222',NULL,NULL,NULL,'2222222222','自主研发项目',NULL,NULL,NULL,0,'111','男','00:00:01','11','111','1','1','1','1','1','多大','1','1','1','1','111','自主研发_test',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'其他',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,36,'0',NULL,'',NULL,0,'1449989729',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1698,'dev1449990809',NULL,NULL,NULL,'','gdgdfgdfgdf','ggdfgdf','gdfgdf',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,NULL,0,'反倒是','1','00:00:00','1','1','1','1','1','1','1','1','1','2','1','1','0021','TEST',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'生物医药',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'0',NULL,'',NULL,0,'1449990809',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1699,'dev1449991023',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,'KJ2015CX010',0,'1','女','00:00:01','呃呃呃','1','1','1','1','1','1','1','1','1','1','1','111','mac___macmac___macmac___macmac___mac',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'生物医药',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,36,'0',NULL,'',NULL,0,'1449991023',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1700,'dev1449992343',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,'KJ2015CX011',0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'111','随便新建一个就好了——马闯',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'电子信息',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,36,'0',NULL,'',NULL,0,'1449992343',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1701,'dev1450000439',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'科技成果转化项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0001','科技成果转化项目',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'新材料',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,21,'0,1,2,3',NULL,'',NULL,0,'1450000439',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1702,'dev1450006688',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,'KJ2015CX012',0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0021','gggggggggggggggggggggggggggggggggggggggggggggggggg',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'电子信息',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'0',NULL,'',NULL,0,'1450006688',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1703,'dev1450006930',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0001','fgfgdfgfgd',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'电子信息',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,21,'0',NULL,'',NULL,0,'1450006931',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1704,'dev1450006932',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'121302','哈哈',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'电子信息',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,37,'0',NULL,'',NULL,0,'1450006932',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1705,'dev1450006972',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0001','发个梵蒂冈梵蒂冈',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'电子信息',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,21,'0',NULL,'',NULL,0,'1450006972',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1706,'dev1450007651',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,'KJ2015CX013',0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0021','aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa',NULL,NULL,NULL,2,1,'发展计划科','',NULL,'生物医药',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'0,1,2,3',NULL,'',NULL,0,'1450007651',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1707,'dev1450009975',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'123456','b',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'生物医药',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,19,'0,1,2,3',NULL,'',NULL,0,'1450009975',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1708,'dev1450010738',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0001','h',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'电子信息',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,21,'0,1,2,3',NULL,'',NULL,0,'1450010738',0,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,NULL,1709,'dev1450052978',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0021','自主研发项目 007',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'先进制造与自动化',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'0,1,2,3',NULL,'',NULL,0,'1450052978',0,NULL,NULL,NULL,NULL,NULL),('ss','ss',NULL,1710,'dev1450053084',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'888888888',NULL,'www','www','www',NULL,'是是是',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,'KJ2015CX014',0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0021','12-14',NULL,NULL,NULL,1,1,'发展计划科','',NULL,'先进制造与自动化',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,14,'0,1,2,3',NULL,'',NULL,0,'1450053084',0,'0021','ww','ww','ww','ss');

/*Table structure for table `project_invest` */

DROP TABLE IF EXISTS `project_invest`;

CREATE TABLE `project_invest` (
  `id` int(11) NOT NULL auto_increment,
  `project_id` varchar(30) default NULL,
  `invest_total` float default NULL,
  `invested` float default NULL,
  `fixed_invest` float default NULL,
  `invested_bank` float default NULL,
  `invested_gov` float default NULL,
  `planadd` float default NULL,
  `planadd_bank` float default NULL,
  `planadd_gov` float default NULL,
  `planaddsrc` float default NULL,
  `planaddsrc_com` float default NULL,
  `planaddsrc_bank` float default NULL,
  `planaddsrc_fin` float default NULL,
  `planaddsrc_finpat` float default NULL,
  `planaddsrc_finother` float default NULL,
  `planaddsrc_other` float default NULL,
  `patent_use` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `project_invest` */

insert  into `project_invest`(`id`,`project_id`,`invest_total`,`invested`,`fixed_invest`,`invested_bank`,`invested_gov`,`planadd`,`planadd_bank`,`planadd_gov`,`planaddsrc`,`planaddsrc_com`,`planaddsrc_bank`,`planaddsrc_fin`,`planaddsrc_finpat`,`planaddsrc_finother`,`planaddsrc_other`,`patent_use`) values (4,'dev1449727488',11,11,11,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(5,'dev1449821283',11,11,11,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `project_member` */

DROP TABLE IF EXISTS `project_member`;

CREATE TABLE `project_member` (
  `id` int(11) NOT NULL auto_increment,
  `project_id` varchar(11) default NULL,
  `name` varchar(11) default NULL,
  `sex` int(11) default NULL,
  `age` int(11) default NULL,
  `job` varchar(20) default NULL,
  `major` varchar(30) default NULL,
  `org` varchar(30) default NULL,
  `edu` varchar(11) default NULL,
  `mission` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `project_member` */

/*Table structure for table `project_middle` */

DROP TABLE IF EXISTS `project_middle`;

CREATE TABLE `project_middle` (
  `id` int(11) NOT NULL auto_increment,
  `project_id` varchar(30) default NULL,
  `project_process` varchar(200) NOT NULL,
  `fund_use` varchar(200) default NULL,
  `problem_action` varchar(200) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `project_middle` */

insert  into `project_middle`(`id`,`project_id`,`project_process`,`fund_use`,`problem_action`) values (4,'dev1449820432','们么么么么','们么么么么','哈哈哈哈哈哈哈'),(5,'dev1449831949','YYYY','YYYY','YYYYY'),(6,'dev1449733457','','问问','问问'),(7,'dev1449821637','',NULL,''),(8,'dev1449846462','一、项目进展情况','二、经费使用情况','三、存在问题及采取措施');

/*Table structure for table `project_mission` */

DROP TABLE IF EXISTS `project_mission`;

CREATE TABLE `project_mission` (
  `id` int(11) NOT NULL auto_increment,
  `project_id` varchar(11) default NULL,
  `year` int(11) default NULL,
  `implement` varchar(500) default NULL,
  `sessionone` varchar(500) default NULL,
  `sessiontwo` varchar(500) default NULL,
  `sessionthree` varchar(500) default NULL,
  `sessionfour` varchar(500) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `project_mission` */

/*Table structure for table `project_org` */

DROP TABLE IF EXISTS `project_org`;

CREATE TABLE `project_org` (
  `id` int(11) NOT NULL auto_increment,
  `project_id` varchar(20) default NULL,
  `org_id` int(11) default NULL,
  `project_name` varchar(30) default NULL,
  `org_name` varchar(30) default NULL,
  `org_duty` varchar(100) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `project_org` */

insert  into `project_org`(`id`,`project_id`,`org_id`,`project_name`,`org_name`,`org_duty`) values (3,'dev1449728333',NULL,NULL,'2','2'),(4,'dev1449728333',NULL,NULL,'2','2'),(5,'dev1449793701',NULL,NULL,'1','1'),(6,'dev1449793701',NULL,NULL,'1','1'),(7,'dev1449793701',NULL,NULL,'1','1'),(8,'dev1449793701',NULL,NULL,'1','1'),(9,'dev1449816291',NULL,NULL,'1','1'),(10,'dev1449823942',NULL,NULL,'1','1'),(11,'dev1449823942',NULL,NULL,'1','1'),(12,'dev1449823942',NULL,NULL,'11','1'),(13,'dev1449824019',NULL,NULL,'1','1'),(14,'dev1449824019',NULL,NULL,'1','1'),(15,'dev1449831949',NULL,NULL,'11','111'),(23,'dev1449821637',NULL,NULL,'s   实施 少时诵诗书s','s是是是         是     水水水水水水水水水水水水   事实上事实上 事实上事实上是'),(24,'dev1449849004',NULL,NULL,'2','2'),(25,'dev1449849004',NULL,NULL,'2','2');

/*Table structure for table `project_patent` */

DROP TABLE IF EXISTS `project_patent`;

CREATE TABLE `project_patent` (
  `id` int(11) NOT NULL auto_increment,
  `project_id` varchar(11) default NULL,
  `patent_num` int(11) default NULL,
  `invent_num` int(11) default NULL,
  `function_patent` int(11) default NULL,
  `patent_design` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `project_patent` */

/*Table structure for table `project_principal` */

DROP TABLE IF EXISTS `project_principal`;

CREATE TABLE `project_principal` (
  `id` int(11) NOT NULL auto_increment,
  `project_id` varchar(50) default NULL,
  `leader_name` varchar(50) default NULL,
  `leader_sex` int(11) default NULL,
  `leader_birth` varchar(20) default NULL,
  `leader_ID` varchar(20) default NULL,
  `leader_edu` varchar(20) default NULL,
  `leader_major` varchar(20) default NULL,
  `leader_phone` varchar(20) default NULL,
  `leader_address` varchar(50) default NULL,
  `leader_fax` varchar(20) default NULL,
  `leader_email` varchar(20) default NULL,
  `leader_achieve` varchar(100) default NULL,
  `tech_pos` varchar(50) default NULL,
  `leader_postal` varchar(20) default NULL,
  `leader_tele` varchar(20) default NULL,
  `leader_job` varchar(30) default NULL,
  `leader_opinion` varchar(500) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `project_principal` */

insert  into `project_principal`(`id`,`project_id`,`leader_name`,`leader_sex`,`leader_birth`,`leader_ID`,`leader_edu`,`leader_major`,`leader_phone`,`leader_address`,`leader_fax`,`leader_email`,`leader_achieve`,`tech_pos`,`leader_postal`,`leader_tele`,`leader_job`,`leader_opinion`) values (12,'dev1449724707','郑艳艳',NULL,NULL,NULL,NULL,NULL,'阿瑟帝国',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(13,'dev1449724861','2',NULL,NULL,NULL,NULL,NULL,'2',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(14,'dev1449727470','xx',NULL,NULL,NULL,NULL,NULL,'xxx',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(15,'dev1449727488','王依',NULL,NULL,NULL,NULL,NULL,'12242424',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(16,'dev1449729105','xx',NULL,NULL,NULL,NULL,NULL,'xx',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(17,'dev1449729636','郑艳艳',NULL,NULL,NULL,NULL,NULL,'13552283673',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(18,'dev1449731679','xx',NULL,NULL,NULL,NULL,NULL,'xx',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(19,'dev1449733744','杨松',NULL,NULL,NULL,NULL,NULL,'15684229850',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(20,'dev1449733726','2',NULL,NULL,NULL,NULL,NULL,'2',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(21,'dev1449736735','不是我啊',NULL,NULL,NULL,NULL,NULL,'133333',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(22,'dev1449738698','2',NULL,NULL,NULL,NULL,NULL,'2',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(23,'dev1449793701','李明',NULL,NULL,NULL,NULL,NULL,'121252222',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(24,'dev1449793951','李明李明',NULL,NULL,NULL,NULL,NULL,'李明李明',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(25,'dev1449795502','2',NULL,NULL,NULL,NULL,NULL,'2',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(26,'dev1449804673','2',NULL,NULL,NULL,NULL,NULL,'2',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'project_expect'),(27,'','k',NULL,NULL,NULL,NULL,NULL,'k',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(28,'dev1449728991','z',NULL,NULL,NULL,NULL,NULL,'z',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(29,'dev1449732172','bbbb',NULL,NULL,NULL,NULL,NULL,'bbbbb',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(30,'dev1449816291','郑艳艳',NULL,NULL,NULL,NULL,NULL,'13552283673',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(31,'dev1449821283','郑艳艳',NULL,NULL,NULL,NULL,NULL,'11',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'working'),(32,'dev1449820432','111',NULL,NULL,NULL,NULL,NULL,'111',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(33,'dev1449821637','2',NULL,NULL,NULL,NULL,NULL,'2',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2'),(34,'dev1449823942','你猜',NULL,NULL,NULL,NULL,NULL,'你猜',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'你猜'),(35,'dev1449831949','经济界',NULL,NULL,NULL,NULL,NULL,'解决你',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(36,'dev1449836878','aaaabbbbbcccccc',NULL,NULL,NULL,NULL,NULL,'121212',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(37,'dev1449819726','222',NULL,NULL,NULL,NULL,NULL,'2',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(38,'com1449842834','1',NULL,NULL,NULL,NULL,NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(39,'dev1449846462','李明',NULL,NULL,NULL,NULL,NULL,'18303306272',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'项目各年度任务目标、考核指标及研究开发内容完成的计划进度'),(40,'dev1449849004','王依',NULL,NULL,NULL,NULL,NULL,'123456789',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'好'),(41,'dev1449975160','..',NULL,NULL,NULL,NULL,NULL,'33',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'什么 是是什么'),(42,'dev1449839187','nba',NULL,NULL,NULL,NULL,NULL,'滴滴快的',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(43,'dev1449838777','1',NULL,NULL,NULL,NULL,NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(44,'dev1449849541','1',NULL,NULL,NULL,NULL,NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(45,'dev1449989729','2',NULL,NULL,NULL,NULL,NULL,'2',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2222222222'),(46,'dev1449991023','ok',NULL,NULL,NULL,NULL,NULL,'ok',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(47,'dev1449990809','fdfds',NULL,NULL,NULL,NULL,NULL,'12313123',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,''),(48,'dev1450006932','哈哈哈',NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(49,'dev1449726614','',NULL,NULL,NULL,NULL,NULL,'5676767',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `project_summary` */

DROP TABLE IF EXISTS `project_summary`;

CREATE TABLE `project_summary` (
  `id` int(11) NOT NULL auto_increment,
  `project_id` varchar(30) NOT NULL,
  `assign_plan` varchar(200) default NULL,
  `actual_plan` varchar(200) default NULL,
  `assign_target` varchar(200) default NULL,
  `actual_target` varchar(200) default NULL,
  `assign_research` varchar(200) default NULL,
  `actual_research` varchar(200) default NULL,
  `achievement` varchar(200) default NULL,
  `other_suggest` varchar(200) default NULL,
  `problem` varchar(200) default NULL,
  `generalize_plan` varchar(200) default NULL,
  `org_suggest` varchar(200) default NULL,
  `chair_suggest` varchar(200) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `project_summary` */

insert  into `project_summary`(`id`,`project_id`,`assign_plan`,`actual_plan`,`assign_target`,`actual_target`,`assign_research`,`actual_research`,`achievement`,`other_suggest`,`problem`,`generalize_plan`,`org_suggest`,`chair_suggest`) values (13,'','ww',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(14,'',NULL,NULL,NULL,NULL,'ww',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(15,'',NULL,NULL,NULL,NULL,NULL,NULL,'ww',NULL,NULL,NULL,NULL,NULL),(16,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ww',NULL,NULL,NULL,NULL),(17,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ww',NULL,NULL),(18,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ww',NULL),(19,'','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(20,'','好',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(21,'',NULL,NULL,NULL,NULL,'好',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(22,'',NULL,NULL,NULL,NULL,NULL,NULL,'良好',NULL,NULL,NULL,NULL,NULL),(23,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'好',NULL,NULL,NULL,NULL),(24,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'好',NULL,NULL),(25,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'好',NULL),(26,'','333',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(27,'',NULL,NULL,NULL,NULL,'333',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(28,'',NULL,NULL,NULL,NULL,NULL,NULL,'3333',NULL,NULL,NULL,NULL,NULL),(29,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'333',NULL,NULL,NULL,NULL),(30,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'33',NULL,NULL),(31,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'333',NULL),(32,'','33',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(33,'','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(34,'','呜呜呜呜',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(35,'','呜呜呜呜',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(36,'','通过',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(37,'','通过',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(38,'','恩恩',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(39,'','一样',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(40,'','wwwwwww',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(41,'','5555',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(42,'dev1449804673','66666',NULL,'wwww',NULL,'嘎嘎嘎',NULL,'ww','方法',NULL,' 谷歌','一样',NULL),(43,'dev1449831949','ffffff',NULL,NULL,NULL,'vvvvvvvvvvv',NULL,'ddd ','vvvvvvvvvvv',NULL,'vvvvvvvvvvvvvv','vvvvvvvvvvvv',NULL),(44,'',NULL,NULL,NULL,NULL,'ss',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(45,'',NULL,NULL,'eee ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(46,'',NULL,NULL,'wwwwwwwwwwwww',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(47,'',NULL,NULL,NULL,NULL,'wwwwwwwww',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(48,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'wwwwwwwwwwwwww',NULL,NULL,NULL,NULL),(49,'',NULL,NULL,NULL,NULL,'wwwwwww',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(50,'',NULL,NULL,NULL,NULL,'wwwwwww',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(51,'',NULL,NULL,NULL,NULL,'wwwwwww',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(52,'',NULL,NULL,NULL,NULL,'wwwwwwwsssss',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(53,'dev1449821637','00',NULL,'..',NULL,'..',NULL,'..','..',NULL,'..',NULL,NULL);

/*Table structure for table `project_target` */

DROP TABLE IF EXISTS `project_target`;

CREATE TABLE `project_target` (
  `id` int(11) NOT NULL auto_increment,
  `project_id` varchar(11) default NULL,
  `project_mission` varchar(500) default NULL,
  `project_aim` varchar(500) default NULL,
  `project_kpi` varchar(500) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `project_target` */

/*Table structure for table `project_type` */

DROP TABLE IF EXISTS `project_type`;

CREATE TABLE `project_type` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(30) default NULL,
  `isfather` int(11) default '0',
  `father` int(11) default NULL,
  `dep_type` int(20) default NULL,
  `apply_status` int(30) default '0',
  `apply_start` varchar(30) default NULL,
  `apply_end` varchar(30) default NULL,
  `attatch_name` varchar(300) default NULL,
  `apply_stage` int(11) default '1',
  `setup_stage` int(11) default '1',
  `carry_stage` int(11) default '1',
  `check_stage` int(11) default '1',
  `project_leader` varchar(20) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `project_type` */

insert  into `project_type`(`id`,`name`,`isfather`,`father`,`dep_type`,`apply_status`,`apply_start`,`apply_end`,`attatch_name`,`apply_stage`,`setup_stage`,`carry_stage`,`check_stage`,`project_leader`) values (1,'支持科技研发及成果转化专项资金',1,NULL,-1,1,'1449158400','1449158400',NULL,1,0,0,0,NULL),(2,'自主研发项目',0,1,0,1,'1448812800','1451059199','北京市通州区科技计划项目实施方案',1,1,1,1,NULL),(3,'产学研合作项目',0,1,0,1,'1449763200','','北京市通州区科技计划项目实施方案,通州区支持产学研合作项目申请书',0,0,1,0,NULL),(4,'科技成果转化项目',0,1,0,1,'1448899200','1450886399','北京市通州区科技计划项目实施方案,通州区支持科技成果转化项目申报书',1,1,1,1,NULL),(5,'支持承担市级以上的科技项目',0,1,0,1,'1449849600','1450367999','北京市通州区科技计划项目实施方案,通州区支持承担市级以上科技项目申报书',1,1,1,1,NULL),(6,'加强创新平台建设专项资金',1,6,0,0,NULL,NULL,'北京市通州区科技计划项目实施方案,通州区支持创新平台建设项目申报书',1,1,1,1,NULL),(7,'大力发展技术市场专项资金',1,NULL,-1,1,'1444838400','1449158400','',1,1,1,1,NULL),(8,'技术合同登记奖励',0,7,2,0,NULL,NULL,'通州区技术合同登记奖励资金申报表',1,0,0,0,NULL),(9,'支持技术输出能力提升项目',0,7,2,1,'1448899200','1450281599','北京市通州区科技计划项目实施方案,通州区支持技术输出能力提升项目申报书',0,1,1,0,NULL),(10,'支持购买区内单位技术服务项目',0,7,2,1,'1448899200','1450281599','北京市通州区科技计划项目实施方案,通州区支持购买区内单位技术服务项目申报书',1,1,1,1,NULL),(11,'支持科技企业孵化器和大学科技园发展专项资金',1,NULL,-1,1,'1444838400','1449158400',NULL,1,1,1,1,NULL),(12,'支持初创期科技企业孵化器、大学科技园发展项目',0,11,2,1,'1448899200','1451577599','北京市通州区科技计划项目实施方案,通州区支持科技企业孵化器大学科技园发展项目申报书',1,1,1,1,NULL),(13,'支持市级以上科技企业孵化器资质认证及后期运营项目',0,11,2,1,'1448899200','1450886399','北京市通州区科技计划项目实施方案,通州区支持科技企业孵化器大学科技园发展项目申报书',1,1,1,1,NULL),(14,'支持市级以上大学科技园资质认定及后期运营项目',0,11,2,1,'1451491200','1450886399','北京市通州区科技计划项目实施方案,通州区支持科技企业孵化器大学科技园发展项目申报书',1,1,1,1,NULL),(15,'支持科技服务机构发展专项资金',1,NULL,-1,1,'1444838400','1449158400',NULL,1,1,1,1,NULL),(16,'支持研发设计等服务机构发展项目',0,15,0,1,'1448899200','1450886399','北京市通州区科技计划项目实施方案,通州区支持科技服务机构发展项目申报书',1,0,0,1,NULL),(17,'支持技术转移',0,15,2,0,NULL,NULL,'北京市通州区科技计划项目实施方案,通州区支持科技服务机构发展项目申报书',1,1,1,1,NULL),(18,'知识产权服务机构发展项目',0,15,1,1,'1450713600','','北京市通州区科技计划项目实施方案,通州区支持科技服务机构发展项目申报书',1,1,1,1,NULL),(19,'支持为高新技术企业认定提供鉴证服务',0,15,2,1,'1444838400','','通州区高新技术企业认定服务机构资助资金申请表',1,1,1,1,NULL),(20,'支持重点功能区及园区建设申报指南',1,20,0,1,'1444838400','1449158400','北京市通州区科技计划项目实施方案',1,0,0,0,NULL),(21,'专利实施项目',1,21,1,1,'1444838400','1449158400',NULL,1,1,1,1,NULL),(28,'发展',0,0,1,1,'1431014400','1449158400',NULL,1,1,1,1,NULL),(29,'',0,0,1,1,'','',NULL,1,1,1,1,NULL);

/*Table structure for table `researchers` */

DROP TABLE IF EXISTS `researchers`;

CREATE TABLE `researchers` (
  `id` int(11) NOT NULL auto_increment,
  `project_id` varchar(30) NOT NULL,
  `researcher_name` varchar(20) default NULL,
  `researcher_sex` int(11) default NULL,
  `researcher_birth` varchar(20) default NULL,
  `researcher_ID` varchar(20) default NULL,
  `researcher_pos` varchar(20) default NULL,
  `researcher_job` varchar(20) default NULL,
  `researcher_edu` varchar(20) default NULL,
  `researcher_major` varchar(20) default NULL,
  `researcher_work` varchar(20) default NULL,
  `researcher_org` varchar(20) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `researchers` */

insert  into `researchers`(`id`,`project_id`,`researcher_name`,`researcher_sex`,`researcher_birth`,`researcher_ID`,`researcher_pos`,`researcher_job`,`researcher_edu`,`researcher_major`,`researcher_work`,`researcher_org`) values (6,'dev1449724707','',0,'','','','','','','',''),(7,'dev1449724707','',0,'','','','','','','',''),(8,'dev1449724707','',0,'','','','','','','',''),(9,'dev1449727488','',0,'','','','','','','',''),(10,'dev1449727488','',0,'','','','','','','',''),(11,'dev1449728333','2',2,'2','2','2','2','2','2','2','2'),(12,'dev1449729636','啊啊',0,'','','','','','','',''),(13,'dev1449738698','2',2,'2','2','2','2','2','2','2','2'),(14,'dev1449793701','1',1,'1','1','1','1','1','1','1','1'),(15,'dev1449793701','1',1,'1','1','1','1','1','1','1','1'),(16,'dev1449793701','1',1,'1','1','1','1','1','1','1','1'),(17,'dev1449795502','2',2,'2','2','2','2','2','2','2','2'),(18,'dev1449804673','1',0,'','','','','','','',''),(19,'dev1449728991','q',0,'q','q','q','q','q','q','q','q'),(20,'dev1449816291','23',23,'23','23','23','23','23','23','23','23'),(21,'dev1449821283','11',11,'11','11','11','11','11','11','11','11'),(28,'dev1449823942','2',2,'2','2','2','2','2','2','2','2'),(29,'dev1449823942','2',2,'2','2','2','22','2','2','2','2'),(30,'dev1449824019','',0,'','','','','','','',''),(31,'dev1449824019','',0,'','','','','','','',''),(32,'dev1449824019','',0,'','','','','','','',''),(33,'dev1449824019','',0,'','','','','','','',''),(34,'dev1449824019','',0,'','','','','','','',''),(35,'dev1449824019','',0,'','','','','','','',''),(36,'dev1449831949','1',1,'1','1','11','1','1','1','1','1'),(51,'dev1449821637','2',2,'2','2','2','2','2','2','2','2'),(52,'dev1449821637','2',2,'2','2','2','2','2','2','2','2'),(53,'dev1449846462','1',1,'1','1','1','1','1','1','1','1'),(54,'dev1449849004','2',2,'2','2','2','2','2','2','','2'),(55,'dev1449849004','',0,'','','','','','','',''),(56,'dev1449975160','',0,'','','','','','','',''),(59,'dev1449849541','',0,'','','','','','','',''),(66,'dev1449989729','1',0,'1','1','1','1','1','1','1','11'),(67,'dev1449989729','',0,'','','','','','','',''),(68,'dev1449989729','',0,'','','','','','','',''),(69,'dev1449989729','',0,'','','','','','','',''),(70,'dev1449989729','',0,'','','','','','','',''),(80,'dev1449991023','1',1,'1','1','1','1','1','1','1','111'),(81,'dev1449991023','1',1,'1','1','1','1','1','1','1','111'),(82,'dev1449991023','',0,'','','','','','','',''),(94,'dev1449990809','1',1,'','','','','','','','');

/*Table structure for table `run_status` */

DROP TABLE IF EXISTS `run_status`;

CREATE TABLE `run_status` (
  `id` int(11) NOT NULL auto_increment,
  `org_code` varchar(64) default NULL,
  `the_year` varchar(64) default NULL,
  `prof_tech` float default NULL,
  `total_income` float default NULL,
  `rent_income` float default NULL,
  `property_income` float default NULL,
  `invest_income` float default NULL,
  `public_tec_income` float default NULL,
  `other_income` float default NULL,
  `profit` float default NULL,
  `hand_tax` float default NULL,
  `seed_total_fund` float default NULL,
  `seed_inve_sum` float default NULL,
  `hatch_com_num` bigint(20) default NULL,
  `public_inve_sum` float default NULL,
  `public_service_income` float default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `run_status` */

/*Table structure for table `service_state` */

DROP TABLE IF EXISTS `service_state`;

CREATE TABLE `service_state` (
  `id` int(11) NOT NULL auto_increment,
  `org_code` varchar(11) default NULL,
  `company_name` varchar(30) default NULL,
  `service_time` varchar(11) default NULL,
  `contract_code` varchar(11) default NULL,
  `contract_price` float default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `service_state` */

/*Table structure for table `service_team` */

DROP TABLE IF EXISTS `service_team`;

CREATE TABLE `service_team` (
  `doctor_ratio` float default NULL,
  `id` int(11) NOT NULL auto_increment,
  `specialty` int(11) default NULL,
  `specialty_ratio` float default NULL,
  `total_num` int(11) default NULL,
  `regular_college_ratio` float default NULL,
  `regular_college` int(11) default NULL,
  `master_ratio` float default NULL,
  `master` int(11) default NULL,
  `service_num` int(11) default NULL,
  `doctor` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `service_team` */

/*Table structure for table `shareholder_info` */

DROP TABLE IF EXISTS `shareholder_info`;

CREATE TABLE `shareholder_info` (
  `id` int(11) NOT NULL auto_increment,
  `org_code` varchar(11) default NULL,
  `shareholder_name` varchar(11) default NULL,
  `stock_ratio` float default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `shareholder_info` */

/*Table structure for table `staff_info` */

DROP TABLE IF EXISTS `staff_info`;

CREATE TABLE `staff_info` (
  `id` int(11) NOT NULL auto_increment,
  `org_code` varchar(11) default NULL,
  `staff_num` int(11) default NULL,
  `junior` int(11) default NULL,
  `undergraduate` int(11) default NULL,
  `graduate` int(11) default NULL,
  `doctor` int(11) default NULL,
  `junior_ratio` float default NULL,
  ` undergraduate_ratio` float default NULL,
  `graduate_ratio` float default NULL,
  `doctor_ratio` float default NULL,
  `service_num` int(11) default NULL,
  `researcher_num` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `staff_info` */

insert  into `staff_info`(`id`,`org_code`,`staff_num`,`junior`,`undergraduate`,`graduate`,`doctor`,`junior_ratio`,` undergraduate_ratio`,`graduate_ratio`,`doctor_ratio`,`service_num`,`researcher_num`) values (2,'123',0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3,'千松',102,90,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,20);

/*Table structure for table `support_apply` */

DROP TABLE IF EXISTS `support_apply`;

CREATE TABLE `support_apply` (
  `id` int(11) NOT NULL auto_increment,
  `org_code` varchar(30) default NULL,
  `project_id` varchar(30) default NULL,
  `contractMoney` float default NULL,
  `predict_companyNum` int(11) default NULL,
  `predict_servicePrice` float default NULL,
  `apply_checkPrice` float default NULL,
  `apply_supPrice` float default NULL,
  `apply_suggest` varchar(1000) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `support_apply` */

/*Table structure for table `table_status` */

DROP TABLE IF EXISTS `table_status`;

CREATE TABLE `table_status` (
  `id` int(11) NOT NULL auto_increment,
  `table_name` varchar(30) default NULL,
  `last_modify` varchar(30) default NULL,
  `table_status` int(11) default '1',
  `project_id` varchar(30) default NULL,
  `project_stage` int(11) default NULL,
  `approval_opinion` varchar(300) default NULL,
  `approval_time` varchar(50) default NULL,
  `open` int(11) default '1',
  `check_repeat` int(11) default '1',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `table_status` */

insert  into `table_status`(`id`,`table_name`,`last_modify`,`table_status`,`project_id`,`project_stage`,`approval_opinion`,`approval_time`,`open`,`check_repeat`) values (8557,'项目任务书','1449724707',1,'dev1449724707',1,NULL,NULL,1,1),(8558,'专家名单及专家论证意见','1449724707',1,'dev1449724707',1,NULL,NULL,1,1),(8559,'课题调整申请表','1449724707',1,'dev1449724707',2,NULL,NULL,1,1),(8560,'项目中期报告','1449724707',1,'dev1449724707',2,NULL,NULL,0,1),(8561,'项目总结报告书','1449724707',1,'dev1449724707',3,NULL,NULL,0,1),(8562,'项目经费总决算表','1449724707',1,'dev1449724707',3,NULL,NULL,0,1),(8563,'项目验收专家组意见','1449724707',1,'dev1449724707',3,NULL,NULL,0,1),(8564,'北京市通州区科技计划项目实施方案','1449726235',2,'dev1449724707',0,NULL,NULL,1,1),(8565,'项目任务书','1449724861',1,'dev1449724861',1,NULL,NULL,1,1),(8566,'专家名单及专家论证意见','1449724861',1,'dev1449724861',1,NULL,NULL,1,1),(8567,'课题调整申请表','1449724861',1,'dev1449724861',2,NULL,NULL,1,1),(8568,'项目中期报告','1449724861',1,'dev1449724861',2,NULL,NULL,0,1),(8569,'项目总结报告书','1449724861',1,'dev1449724861',3,NULL,NULL,0,1),(8570,'项目经费总决算表','1449724861',1,'dev1449724861',3,NULL,NULL,0,1),(8571,'项目验收专家组意见','1449724861',1,'dev1449724861',3,NULL,NULL,0,1),(8572,'北京市通州区科技计划项目实施方案','1449724861',1,'dev1449724861',0,NULL,NULL,1,1),(8573,'项目任务书','1449726361',1,'dev1449726361',1,NULL,NULL,1,1),(8574,'专家名单及专家论证意见','1449726361',1,'dev1449726361',1,NULL,NULL,1,1),(8575,'课题调整申请表','1449726361',1,'dev1449726361',2,NULL,NULL,1,1),(8576,'项目中期报告','1449726361',1,'dev1449726361',2,NULL,NULL,0,1),(8577,'项目总结报告书','1449726361',1,'dev1449726361',3,NULL,NULL,0,1),(8578,'项目经费总决算表','1449726361',1,'dev1449726361',3,NULL,NULL,0,1),(8579,'项目验收专家组意见','1449726361',1,'dev1449726361',3,NULL,NULL,0,1),(8580,'北京市通州区科技计划项目实施方案','1449726361',1,'dev1449726361',0,NULL,NULL,1,1),(8581,'项目任务书','1449726971',4,'dev1449726614',1,'             \r\n              \r\n       ','1449726993',1,1),(8582,'专家名单及专家论证意见','1449726974',4,'dev1449726614',1,'             \r\n              \r\n       ','1449726998',1,1),(8583,'课题调整申请表','1449727011',4,'dev1449726614',2,NULL,'1449815005',1,1),(8584,'项目中期报告','1449726614',1,'dev1449726614',2,NULL,NULL,1,1),(8585,'项目总结报告书','1449726614',1,'dev1449726614',3,NULL,NULL,0,1),(8586,'项目经费总决算表','1449726614',1,'dev1449726614',3,NULL,NULL,0,1),(8587,'项目验收专家组意见','1449726614',1,'dev1449726614',3,NULL,NULL,0,1),(8588,'北京市通州区科技计划项目实施方案','1449726647',4,'dev1449726614',0,'             \r\n              \r\n       shenhetongguo','1449726941',1,2),(8589,'项目任务书','1449726854',1,'dev1449726854',1,NULL,NULL,1,1),(8590,'专家名单及专家论证意见','1449726854',1,'dev1449726854',1,NULL,NULL,1,1),(8591,'课题调整申请表','1449726854',1,'dev1449726854',2,NULL,NULL,1,1),(8592,'项目中期报告','1449726854',1,'dev1449726854',2,NULL,NULL,0,1),(8593,'项目总结报告书','1449726854',1,'dev1449726854',3,NULL,NULL,0,1),(8594,'项目经费总决算表','1449726854',1,'dev1449726854',3,NULL,NULL,0,1),(8595,'项目验收专家组意见','1449726854',1,'dev1449726854',3,NULL,NULL,0,1),(8596,'北京市通州区科技计划项目实施方案','1449726854',1,'dev1449726854',0,NULL,NULL,1,1),(8597,'项目任务书','1449728324',4,'dev1449727470',1,'             \r\n              \r\n       ','1449728377',1,2),(8598,'专家名单及专家论证意见','1449728327',4,'dev1449727470',1,'             \r\n              \r\n       ','1449728382',1,2),(8599,'课题调整申请表','1449733238',4,'dev1449727470',2,'             \r\n              \r\n       ','1449733304',1,2),(8600,'项目中期报告','1449733270',4,'dev1449727470',2,'             \r\n              \r\n       ','1449733311',1,2),(8601,'项目总结报告书','1449727470',4,'dev1449727470',3,'             \r\n              \r\n       ','1449838065',1,2),(8602,'项目经费总决算表','1449733627',4,'dev1449727470',3,'             \r\n              \r\n       ','1449733658',1,2),(8603,'项目验收专家组意见','1449733769',4,'dev1449727470',3,'             \r\n              \r\n       ','1449733957',1,2),(8604,'北京市通州区科技计划项目实施方案','1449727716',4,'dev1449727470',0,'             \r\n              \r\n       ','1449728262',1,2),(8605,'通州区支持产学研合作项目申请书','1449727920',4,'dev1449727470',0,'             \r\n              \r\n       ','1449728275',1,2),(8606,'项目任务书','1449728324',4,'dev1449727470',1,'             \r\n              \r\n       ','1449728377',1,2),(8607,'专家名单及专家论证意见','1449728327',4,'dev1449727470',1,'             \r\n              \r\n       ','1449728382',1,2),(8608,'课题调整申请表','1449733238',4,'dev1449727470',2,'             \r\n              \r\n       ','1449733304',1,2),(8609,'项目中期报告','1449733270',4,'dev1449727470',2,'             \r\n              \r\n       ','1449733311',1,2),(8610,'项目总结报告书','1449727470',4,'dev1449727470',3,'             \r\n              \r\n       ','1449838065',1,2),(8611,'项目经费总决算表','1449733627',4,'dev1449727470',3,'             \r\n              \r\n       ','1449733658',1,2),(8612,'项目验收专家组意见','1449733769',4,'dev1449727470',3,'             \r\n              \r\n       ','1449733957',1,2),(8613,'北京市通州区科技计划项目实施方案','1449727716',4,'dev1449727470',0,'             \r\n              \r\n       ','1449728262',1,2),(8614,'项目任务书','1449727488',1,'dev1449727488',1,NULL,NULL,1,1),(8615,'专家名单及专家论证意见','1449727488',1,'dev1449727488',1,NULL,NULL,1,1),(8616,'课题调整申请表','1449727488',1,'dev1449727488',2,NULL,NULL,1,1),(8617,'项目中期报告','1449727488',1,'dev1449727488',2,NULL,NULL,0,1),(8618,'项目总结报告书','1449727488',1,'dev1449727488',3,NULL,NULL,0,1),(8619,'项目经费总决算表','1449727488',1,'dev1449727488',3,NULL,NULL,0,1),(8620,'项目验收专家组意见','1449727488',1,'dev1449727488',3,NULL,NULL,0,1),(8621,'北京市通州区科技计划项目实施方案','1449728620',2,'dev1449727488',0,NULL,NULL,1,1),(8622,'通州区支持产学研合作项目申请书','1449729261',2,'dev1449727488',0,NULL,NULL,1,1),(8623,'项目任务书','1449727488',1,'dev1449727488',1,NULL,NULL,1,1),(8624,'专家名单及专家论证意见','1449727488',1,'dev1449727488',1,NULL,NULL,1,1),(8625,'课题调整申请表','1449727488',1,'dev1449727488',2,NULL,NULL,1,1),(8626,'项目中期报告','1449727488',1,'dev1449727488',2,NULL,NULL,0,1),(8627,'项目总结报告书','1449727488',1,'dev1449727488',3,NULL,NULL,0,1),(8628,'项目经费总决算表','1449727488',1,'dev1449727488',3,NULL,NULL,0,1),(8629,'项目验收专家组意见','1449727488',1,'dev1449727488',3,NULL,NULL,0,1),(8630,'北京市通州区科技计划项目实施方案','1449728620',2,'dev1449727488',0,NULL,NULL,1,1),(8631,'项目任务书','1449728243',1,'dev1449728243',1,NULL,NULL,1,1),(8632,'专家名单及专家论证意见','1449728243',1,'dev1449728243',1,NULL,NULL,1,1),(8633,'课题调整申请表','1449728243',1,'dev1449728243',2,NULL,NULL,1,1),(8634,'项目中期报告','1449728243',1,'dev1449728243',2,NULL,NULL,0,1),(8635,'项目总结报告书','1449728243',1,'dev1449728243',3,NULL,NULL,0,1),(8636,'项目经费总决算表','1449728243',1,'dev1449728243',3,NULL,NULL,0,1),(8637,'项目验收专家组意见','1449728243',1,'dev1449728243',3,NULL,NULL,0,1),(8638,'北京市通州区科技计划项目实施方案','1449728243',1,'dev1449728243',0,NULL,NULL,1,1),(8639,'通州区支持科技成果转化项目申报书','1449728243',1,'dev1449728243',0,NULL,NULL,1,1),(8640,'项目任务书','1449729776',4,'dev1449728333',1,'             \r\n              \r\n       ','1449730256',1,1),(8641,'专家名单及专家论证意见','1449729890',4,'dev1449728333',1,'             \r\n              \r\n       ','1449730268',1,1),(8642,'课题调整申请表','1449730513',4,'dev1449728333',2,NULL,'1449730547',1,1),(8643,'项目中期报告','1449730516',4,'dev1449728333',2,NULL,'1449730552',1,1),(8644,'项目总结报告书','1449730865',4,'dev1449728333',3,'             \r\n              \r\n       ','1449731024',1,1),(8645,'项目经费总决算表','1449730870',4,'dev1449728333',3,'             \r\n              \r\n       ','1449731038',1,1),(8646,'项目验收专家组意见','1449730986',4,'dev1449728333',3,'             \r\n              \r\n       ','1449731032',1,1),(8647,'北京市通州区科技计划项目实施方案','1449728363',4,'dev1449728333',0,NULL,'1449729400',1,2),(8648,'项目任务书','1449729745',4,'dev1449728991',1,'             \r\n              \r\n       ','1449729832',1,1),(8649,'专家名单及专家论证意见','1449729798',4,'dev1449728991',1,'             \r\n              \r\n       ','1449729841',1,1),(8650,'课题调整申请表','1449798403',4,'dev1449728991',2,'             \r\n              \r\n       ','1449816623',1,1),(8651,'项目中期报告','1449816173',4,'dev1449728991',2,'             \r\n              \r\n       ','1449816637',1,1),(8652,'项目总结报告书','1449817992',4,'dev1449728991',3,NULL,'1449818837',1,1),(8653,'项目经费总决算表','1449818258',4,'dev1449728991',3,'             \r\n              \r\n       ','1449819645',1,1),(8654,'项目验收专家组意见','1449819621',4,'dev1449728991',3,'             \r\n              \r\n       ','1449819652',1,1),(8655,'北京市通州区科技计划项目实施方案','1449729068',4,'dev1449728991',0,'             \r\n              \r\n小伙子干得不错。','1449729727',1,2),(8656,'北京市通州区科技计划项目实施方案','1449730970',4,'dev1449729105',0,'             \r\n                    \r\n                    \r\n                    \r\n              \r\n       sefe       \r\n              \r\n              \r\n       ','1449731006',1,2),(8657,'通州区支持创新平台建设项目申报书','1449731413',4,'dev1449729105',0,'             \r\n                    \r\n                    \r\n              \r\n              \r\n              \r\n       ','1449731435',1,1),(8658,'项目任务书','1449729140',1,'dev1449729140',1,NULL,NULL,1,1),(8659,'专家名单及专家论证意见','1449729140',1,'dev1449729140',1,NULL,NULL,1,1),(8660,'课题调整申请表','1449729140',1,'dev1449729140',2,NULL,NULL,1,1),(8661,'项目中期报告','1449729140',1,'dev1449729140',2,NULL,NULL,0,1),(8662,'项目总结报告书','1449729140',1,'dev1449729140',3,NULL,NULL,0,1),(8663,'项目经费总决算表','1449729140',1,'dev1449729140',3,NULL,NULL,0,1),(8664,'项目验收专家组意见','1449729140',1,'dev1449729140',3,NULL,NULL,0,1),(8665,'北京市通州区科技计划项目实施方案','1449729140',1,'dev1449729140',0,NULL,NULL,1,1),(8666,'项目任务书','1449729636',1,'dev1449729636',1,NULL,NULL,1,1),(8667,'专家名单及专家论证意见','1449729636',1,'dev1449729636',1,NULL,NULL,1,1),(8668,'课题调整申请表','1449729636',1,'dev1449729636',2,NULL,NULL,1,1),(8669,'项目中期报告','1449729636',1,'dev1449729636',2,NULL,NULL,0,1),(8670,'项目总结报告书','1449729636',1,'dev1449729636',3,NULL,NULL,0,1),(8671,'项目经费总决算表','1449729636',1,'dev1449729636',3,NULL,NULL,0,1),(8672,'项目验收专家组意见','1449729636',1,'dev1449729636',3,NULL,NULL,0,1),(8673,'北京市通州区科技计划项目实施方案','1449730150',2,'dev1449729636',0,NULL,'1449730085',1,2),(8674,'项目任务书','1449730210',4,'dev1449730016',1,'             \r\n              \r\n       审核通过并且提交','1449730618',1,1),(8675,'专家名单及专家论证意见','1449730214',4,'dev1449730016',1,'             \r\n              \r\n       审核通过，并且提交','1449730630',1,1),(8676,'课题调整申请表','1449731789',4,'dev1449730016',2,'             \r\n              \r\n       审核通过并提交','1449731828',1,1),(8677,'项目中期报告','1449731795',4,'dev1449730016',2,'             \r\n              \r\n       审核通过并提交','1449731838',1,1),(8678,'项目总结报告书','1449731865',4,'dev1449730016',3,'             \r\n              \r\n       审核通过并提交','1449731943',1,1),(8679,'项目经费总决算表','1449731868',4,'dev1449730016',3,'             \r\n              \r\n       审核通过并提交','1449731965',1,1),(8680,'项目验收专家组意见','1449731872',4,'dev1449730016',3,'             \r\n              \r\n       审核通过并提交','1449731954',1,1),(8681,'北京市通州区科技计划项目实施方案','1449730054',4,'dev1449730016',0,'             \r\n              \r\n审核通过的','1449730155',1,2),(8682,'通州区高新技术企业认定服务机构资助资金申请表','1449739295',2,'com1449730038',0,NULL,NULL,1,1),(8683,'北京市通州区科技计划项目实施方案','1449731646',1,'dev1449731646',0,NULL,NULL,1,1),(8684,'通州区支持承担市级以上科技项目申报书','1449731646',1,'dev1449731646',0,NULL,NULL,1,1),(8685,'北京市通州区科技计划项目实施方案','1449731666',1,'dev1449731666',0,NULL,NULL,1,1),(8686,'通州区支持承担市级以上科技项目申报书','1449731666',1,'dev1449731666',0,NULL,NULL,1,1),(8687,'项目任务书','1449731806',4,'dev1449731679',1,'             \r\n              \r\n       ','1449732114',1,1),(8688,'专家名单及专家论证意见','1449731865',4,'dev1449731679',1,'             \r\n              \r\n       ','1449732153',1,1),(8689,'课题调整申请表','1449732193',4,'dev1449731679',2,'             \r\n              \r\n       ','1449732214',1,1),(8690,'项目中期报告','1449732312',4,'dev1449731679',2,'             \r\n              \r\n       ','1449732335',1,1),(8691,'项目总结报告书','1449733435',4,'dev1449731679',3,'             \r\n              \r\n       ','1449733548',1,1),(8692,'项目经费总决算表','1449733444',4,'dev1449731679',3,'             \r\n              \r\n       ','1449733558',1,1),(8693,'项目验收专家组意见','1449733452',4,'dev1449731679',3,'             \r\n              \r\n       ','1449733567',1,1),(8694,'北京市通州区科技计划项目实施方案','1449731692',4,'dev1449731679',0,'             \r\n              \r\n       ','1449731772',1,2),(8695,'通州区支持创新平台建设项目申报书','1449731697',4,'dev1449731679',0,'             \r\n              \r\n       ','1449731759',1,1),(8696,'项目任务书','1449732016',1,'com1449732016',1,NULL,NULL,1,1),(8697,'专家名单及专家论证意见','1449732016',1,'com1449732016',1,NULL,NULL,1,1),(8698,'课题调整申请表','1449732016',1,'com1449732016',2,NULL,NULL,1,1),(8699,'项目中期报告','1449732016',1,'com1449732016',2,NULL,NULL,0,1),(8700,'项目总结报告书','1449732016',1,'com1449732016',3,NULL,NULL,0,1),(8701,'项目经费总决算表','1449732016',1,'com1449732016',3,NULL,NULL,0,1),(8702,'项目验收专家组意见','1449732016',1,'com1449732016',3,NULL,NULL,0,1),(8703,'通州区高新技术企业认定服务机构资助资金申请表','1449732016',1,'com1449732016',0,NULL,NULL,1,1),(8704,'项目任务书','1449732172',1,'dev1449732172',1,NULL,NULL,1,1),(8705,'专家名单及专家论证意见','1449732172',1,'dev1449732172',1,NULL,NULL,1,1),(8706,'课题调整申请表','1449732172',1,'dev1449732172',2,NULL,NULL,1,1),(8707,'项目中期报告','1449732172',1,'dev1449732172',2,NULL,NULL,0,1),(8708,'项目总结报告书','1449732172',1,'dev1449732172',3,NULL,NULL,0,1),(8709,'项目经费总决算表','1449732172',1,'dev1449732172',3,NULL,NULL,0,1),(8710,'项目验收专家组意见','1449732172',1,'dev1449732172',3,NULL,NULL,0,1),(8711,'北京市通州区科技计划项目实施方案','1449831103',4,'dev1449732172',0,'             \r\n              \r\n       ','1449831208',1,2),(8712,'通州区支持承担市级以上科技项目申报书','1449831108',4,'dev1449732172',0,'             \r\n              \r\n       ','1449831152',1,1),(8713,'项目任务书','1449732214',1,'com1449732214',1,NULL,NULL,1,1),(8714,'专家名单及专家论证意见','1449732214',1,'com1449732214',1,NULL,NULL,1,1),(8715,'课题调整申请表','1449732214',1,'com1449732214',2,NULL,NULL,1,1),(8716,'项目中期报告','1449732214',1,'com1449732214',2,NULL,NULL,0,1),(8717,'项目总结报告书','1449732214',1,'com1449732214',3,NULL,NULL,0,1),(8718,'项目经费总决算表','1449732214',1,'com1449732214',3,NULL,NULL,0,1),(8719,'项目验收专家组意见','1449732214',1,'com1449732214',3,NULL,NULL,0,1),(8720,'北京市通州区科技计划项目实施方案','1449741386',2,'com1449732214',0,NULL,NULL,1,1),(8721,'通州区支持科技服务机构发展项目申报书','1449732214',1,'com1449732214',0,NULL,NULL,1,1),(8722,'项目任务书','1449732605',1,'dev1449732605',1,NULL,NULL,1,1),(8723,'专家名单及专家论证意见','1449732605',1,'dev1449732605',1,NULL,NULL,1,1),(8724,'课题调整申请表','1449732605',1,'dev1449732605',2,NULL,NULL,1,1),(8725,'项目中期报告','1449732605',1,'dev1449732605',2,NULL,NULL,0,1),(8726,'项目总结报告书','1449732605',1,'dev1449732605',3,NULL,NULL,0,1),(8727,'项目经费总决算表','1449732605',1,'dev1449732605',3,NULL,NULL,0,1),(8728,'项目验收专家组意见','1449732605',1,'dev1449732605',3,NULL,NULL,0,1),(8729,'北京市通州区科技计划项目实施方案','1449733122',4,'dev1449732605',0,NULL,'1449817772',1,2),(8730,'通州区支持产学研合作项目申请书','1449732605',1,'dev1449732605',0,NULL,NULL,1,1),(8731,'项目任务书','1449732905',1,'dev1449732905',1,NULL,NULL,1,1),(8732,'专家名单及专家论证意见','1449732905',1,'dev1449732905',1,NULL,NULL,1,1),(8733,'课题调整申请表','1449732905',1,'dev1449732905',2,NULL,NULL,1,1),(8734,'项目中期报告','1449732905',1,'dev1449732905',2,NULL,NULL,0,1),(8735,'项目总结报告书','1449732905',1,'dev1449732905',3,NULL,NULL,0,1),(8736,'项目经费总决算表','1449732905',1,'dev1449732905',3,NULL,NULL,0,1),(8737,'项目验收专家组意见','1449732905',1,'dev1449732905',3,NULL,NULL,0,1),(8738,'北京市通州区科技计划项目实施方案','1449732905',1,'dev1449732905',0,NULL,NULL,1,1),(8739,'通州区支持科技成果转化项目申报书','1449732905',1,'dev1449732905',0,NULL,NULL,1,1),(8740,'项目任务书','1449732956',1,'dev1449732956',1,NULL,NULL,1,1),(8741,'专家名单及专家论证意见','1449732956',1,'dev1449732956',1,NULL,NULL,1,1),(8742,'课题调整申请表','1449732956',1,'dev1449732956',2,NULL,NULL,1,1),(8743,'项目中期报告','1449732956',1,'dev1449732956',2,NULL,NULL,0,1),(8744,'项目总结报告书','1449732956',1,'dev1449732956',3,NULL,NULL,0,1),(8745,'项目经费总决算表','1449732956',1,'dev1449732956',3,NULL,NULL,0,1),(8746,'项目验收专家组意见','1449732956',1,'dev1449732956',3,NULL,NULL,0,1),(8747,'北京市通州区科技计划项目实施方案','1449732956',1,'dev1449732956',0,NULL,NULL,1,1),(8748,'通州区支持承担市级以上科技项目申报书','1449732956',1,'dev1449732956',0,NULL,NULL,1,1),(8749,'项目任务书','1449733163',1,'dev1449733163',1,NULL,NULL,1,1),(8750,'专家名单及专家论证意见','1449733163',1,'dev1449733163',1,NULL,NULL,1,1),(8751,'课题调整申请表','1449733163',1,'dev1449733163',2,NULL,NULL,1,1),(8752,'项目中期报告','1449733163',1,'dev1449733163',2,NULL,NULL,0,1),(8753,'项目总结报告书','1449733163',1,'dev1449733163',3,NULL,NULL,0,1),(8754,'项目经费总决算表','1449733163',1,'dev1449733163',3,NULL,NULL,0,1),(8755,'项目验收专家组意见','1449733163',1,'dev1449733163',3,NULL,NULL,0,1),(8756,'北京市通州区科技计划项目实施方案','1449733163',1,'dev1449733163',0,NULL,NULL,1,1),(8757,'项目任务书','1449733272',1,'dev1449733272',1,NULL,NULL,1,1),(8758,'专家名单及专家论证意见','1449733272',1,'dev1449733272',1,NULL,NULL,1,1),(8759,'课题调整申请表','1449733272',1,'dev1449733272',2,NULL,NULL,1,1),(8760,'项目中期报告','1449733272',1,'dev1449733272',2,NULL,NULL,0,1),(8761,'项目总结报告书','1449733272',1,'dev1449733272',3,NULL,NULL,0,1),(8762,'项目经费总决算表','1449733272',1,'dev1449733272',3,NULL,NULL,0,1),(8763,'项目验收专家组意见','1449733272',1,'dev1449733272',3,NULL,NULL,0,1),(8764,'北京市通州区科技计划项目实施方案','1449733272',1,'dev1449733272',0,NULL,NULL,1,1),(8765,'项目任务书','1449733402',1,'dev1449733402',1,NULL,NULL,1,1),(8766,'专家名单及专家论证意见','1449733402',1,'dev1449733402',1,NULL,NULL,1,1),(8767,'课题调整申请表','1449733402',1,'dev1449733402',2,NULL,NULL,1,1),(8768,'项目中期报告','1449733402',1,'dev1449733402',2,NULL,NULL,0,1),(8769,'项目总结报告书','1449733402',1,'dev1449733402',3,NULL,NULL,0,1),(8770,'项目经费总决算表','1449733402',1,'dev1449733402',3,NULL,NULL,0,1),(8771,'项目验收专家组意见','1449733402',1,'dev1449733402',3,NULL,NULL,0,1),(8772,'北京市通州区科技计划项目实施方案','1449733402',1,'dev1449733402',0,NULL,NULL,1,1),(8773,'项目任务书','1449733415',1,'dev1449733415',1,NULL,NULL,1,1),(8774,'专家名单及专家论证意见','1449733415',1,'dev1449733415',1,NULL,NULL,1,1),(8775,'课题调整申请表','1449733415',1,'dev1449733415',2,NULL,NULL,1,1),(8776,'项目中期报告','1449733415',1,'dev1449733415',2,NULL,NULL,0,1),(8777,'项目总结报告书','1449733415',1,'dev1449733415',3,NULL,NULL,0,1),(8778,'项目经费总决算表','1449733415',1,'dev1449733415',3,NULL,NULL,0,1),(8779,'项目验收专家组意见','1449733415',1,'dev1449733415',3,NULL,NULL,0,1),(8780,'北京市通州区科技计划项目实施方案','1449733415',1,'dev1449733415',0,NULL,NULL,1,1),(8781,'项目任务书','1449733429',1,'dev1449733429',1,NULL,NULL,1,1),(8782,'专家名单及专家论证意见','1449733429',1,'dev1449733429',1,NULL,NULL,1,1),(8783,'课题调整申请表','1449733429',1,'dev1449733429',2,NULL,NULL,1,1),(8784,'项目中期报告','1449733429',1,'dev1449733429',2,NULL,NULL,0,1),(8785,'项目总结报告书','1449733429',1,'dev1449733429',3,NULL,NULL,0,1),(8786,'项目经费总决算表','1449733429',1,'dev1449733429',3,NULL,NULL,0,1),(8787,'项目验收专家组意见','1449733429',1,'dev1449733429',3,NULL,NULL,0,1),(8788,'北京市通州区科技计划项目实施方案','1449733429',1,'dev1449733429',0,NULL,NULL,1,1),(8789,'项目任务书','1449740205',4,'dev1449733457',1,NULL,'1449740228',1,1),(8790,'专家名单及专家论证意见','1449740210',4,'dev1449733457',1,NULL,'1449740240',1,1),(8791,'课题调整申请表','1449740270',4,'dev1449733457',2,NULL,'1449740292',1,1),(8792,'项目中期报告','1449740274',4,'dev1449733457',2,'             \r\n              \r\n       ','1449740326',1,1),(8793,'项目总结报告书','1449740342',4,'dev1449733457',3,NULL,'1449819927',1,1),(8794,'项目经费总决算表','1449740348',2,'dev1449733457',3,NULL,NULL,1,1),(8795,'项目验收专家组意见','1449740351',2,'dev1449733457',3,NULL,NULL,1,1),(8796,'北京市通州区科技计划项目实施方案','1449738499',4,'dev1449733457',0,NULL,'1449740181',1,2),(8797,'项目任务书','1449733598',1,'dev1449733598',1,NULL,NULL,1,1),(8798,'专家名单及专家论证意见','1449733598',1,'dev1449733598',1,NULL,NULL,1,1),(8799,'课题调整申请表','1449733598',1,'dev1449733598',2,NULL,NULL,1,1),(8800,'项目中期报告','1449733598',1,'dev1449733598',2,NULL,NULL,0,1),(8801,'项目总结报告书','1449733598',1,'dev1449733598',3,NULL,NULL,0,1),(8802,'项目经费总决算表','1449733598',1,'dev1449733598',3,NULL,NULL,0,1),(8803,'项目验收专家组意见','1449733598',1,'dev1449733598',3,NULL,NULL,0,1),(8804,'北京市通州区科技计划项目实施方案','1449733598',1,'dev1449733598',0,NULL,NULL,1,1),(8805,'项目任务书','1449733619',1,'dev1449733619',1,NULL,NULL,1,1),(8806,'专家名单及专家论证意见','1449733619',1,'dev1449733619',1,NULL,NULL,1,1),(8807,'课题调整申请表','1449733619',1,'dev1449733619',2,NULL,NULL,1,1),(8808,'项目中期报告','1449733619',1,'dev1449733619',2,NULL,NULL,0,1),(8809,'项目总结报告书','1449733619',1,'dev1449733619',3,NULL,NULL,0,1),(8810,'项目经费总决算表','1449733619',1,'dev1449733619',3,NULL,NULL,0,1),(8811,'项目验收专家组意见','1449733619',1,'dev1449733619',3,NULL,NULL,0,1),(8812,'北京市通州区科技计划项目实施方案','1449733619',1,'dev1449733619',0,NULL,NULL,1,1),(8813,'通州区支持产学研合作项目申请书','1449733619',1,'dev1449733619',0,NULL,NULL,1,1),(8814,'项目任务书','1449733669',1,'com1449733669',1,NULL,NULL,1,1),(8815,'专家名单及专家论证意见','1449733669',1,'com1449733669',1,NULL,NULL,1,1),(8816,'课题调整申请表','1449733669',1,'com1449733669',2,NULL,NULL,1,1),(8817,'项目中期报告','1449733669',1,'com1449733669',2,NULL,NULL,0,1),(8818,'项目总结报告书','1449733669',1,'com1449733669',3,NULL,NULL,0,1),(8819,'项目经费总决算表','1449733669',1,'com1449733669',3,NULL,NULL,0,1),(8820,'项目验收专家组意见','1449733669',1,'com1449733669',3,NULL,NULL,0,1),(8821,'北京市通州区科技计划项目实施方案','1449733669',1,'com1449733669',0,NULL,NULL,1,1),(8822,'通州区支持科技企业孵化器大学科技园发展项目申报书','1449733669',1,'com1449733669',0,NULL,NULL,1,1),(8823,'项目任务书','1449733682',1,'dev1449733682',1,NULL,NULL,1,1),(8824,'专家名单及专家论证意见','1449733682',1,'dev1449733682',1,NULL,NULL,1,1),(8825,'课题调整申请表','1449733682',1,'dev1449733682',2,NULL,NULL,1,1),(8826,'项目中期报告','1449733682',1,'dev1449733682',2,NULL,NULL,0,1),(8827,'项目总结报告书','1449733682',1,'dev1449733682',3,NULL,NULL,0,1),(8828,'项目经费总决算表','1449733682',1,'dev1449733682',3,NULL,NULL,0,1),(8829,'项目验收专家组意见','1449733682',1,'dev1449733682',3,NULL,NULL,0,1),(8830,'北京市通州区科技计划项目实施方案','1449733682',1,'dev1449733682',0,NULL,NULL,1,1),(8831,'项目任务书','1449733726',1,'dev1449733726',1,NULL,NULL,1,1),(8832,'专家名单及专家论证意见','1449733726',1,'dev1449733726',1,NULL,NULL,1,1),(8833,'课题调整申请表','1449733726',1,'dev1449733726',2,NULL,NULL,1,1),(8834,'项目中期报告','1449733726',1,'dev1449733726',2,NULL,NULL,0,1),(8835,'项目总结报告书','1449733726',1,'dev1449733726',3,NULL,NULL,0,1),(8836,'项目经费总决算表','1449733726',1,'dev1449733726',3,NULL,NULL,0,1),(8837,'项目验收专家组意见','1449733726',1,'dev1449733726',3,NULL,NULL,0,1),(8838,'北京市通州区科技计划项目实施方案','1449734443',2,'dev1449733726',0,NULL,NULL,1,1),(8839,'项目任务书','1449733744',1,'dev1449733744',1,NULL,NULL,1,1),(8840,'专家名单及专家论证意见','1449733744',1,'dev1449733744',1,NULL,NULL,1,1),(8841,'课题调整申请表','1449733744',1,'dev1449733744',2,NULL,NULL,1,1),(8842,'项目中期报告','1449733744',1,'dev1449733744',2,NULL,NULL,0,1),(8843,'项目总结报告书','1449733744',1,'dev1449733744',3,NULL,NULL,0,1),(8844,'项目经费总决算表','1449733744',1,'dev1449733744',3,NULL,NULL,0,1),(8845,'项目验收专家组意见','1449733744',1,'dev1449733744',3,NULL,NULL,0,1),(8846,'北京市通州区科技计划项目实施方案','1449733744',1,'dev1449733744',0,NULL,NULL,1,1),(8847,'项目任务书','1449734522',4,'dev1449733930',1,NULL,'1449734803',1,1),(8848,'专家名单及专家论证意见','1449736835',2,'dev1449733930',1,NULL,'1449734857',1,1),(8849,'课题调整申请表','1449734958',4,'dev1449733930',2,NULL,'1449734990',1,1),(8850,'项目中期报告','1449735380',4,'dev1449733930',2,NULL,'1449736197',1,1),(8851,'项目总结报告书','1449736611',4,'dev1449733930',3,NULL,'1449736922',1,1),(8852,'项目经费总决算表','1449736629',4,'dev1449733930',3,NULL,'1449736934',1,1),(8853,'项目验收专家组意见','1449736891',4,'dev1449733930',3,NULL,'1449736946',1,1),(8854,'北京市通州区科技计划项目实施方案','1449733936',4,'dev1449733930',0,NULL,'1449734059',1,2),(8855,'项目任务书','1449735376',1,'dev1449735376',1,NULL,NULL,1,1),(8856,'专家名单及专家论证意见','1449735376',1,'dev1449735376',1,NULL,NULL,1,1),(8857,'课题调整申请表','1449735376',1,'dev1449735376',2,NULL,NULL,1,1),(8858,'项目中期报告','1449735376',1,'dev1449735376',2,NULL,NULL,0,1),(8859,'项目总结报告书','1449735376',1,'dev1449735376',3,NULL,NULL,0,1),(8860,'项目经费总决算表','1449735376',1,'dev1449735376',3,NULL,NULL,0,1),(8861,'项目验收专家组意见','1449735376',1,'dev1449735376',3,NULL,NULL,0,1),(8862,'北京市通州区科技计划项目实施方案','1449735376',1,'dev1449735376',0,NULL,NULL,1,1),(8863,'通州区支持承担市级以上科技项目申报书','1449735376',1,'dev1449735376',0,NULL,NULL,1,1),(8864,'项目任务书','1449735781',1,'com1449735781',1,NULL,NULL,1,1),(8865,'专家名单及专家论证意见','1449735781',1,'com1449735781',1,NULL,NULL,1,1),(8866,'课题调整申请表','1449735781',1,'com1449735781',2,NULL,NULL,1,1),(8867,'项目中期报告','1449735781',1,'com1449735781',2,NULL,NULL,0,1),(8868,'项目总结报告书','1449735781',1,'com1449735781',3,NULL,NULL,0,1),(8869,'项目经费总决算表','1449735781',1,'com1449735781',3,NULL,NULL,0,1),(8870,'项目验收专家组意见','1449735781',1,'com1449735781',3,NULL,NULL,0,1),(8871,'通州区高新技术企业认定服务机构资助资金申请表','1449735781',1,'com1449735781',0,NULL,NULL,1,1),(8872,'项目任务书','1449736735',1,'dev1449736735',1,NULL,NULL,1,1),(8873,'专家名单及专家论证意见','1449736735',1,'dev1449736735',1,NULL,NULL,1,1),(8874,'课题调整申请表','1449736735',1,'dev1449736735',2,NULL,NULL,1,1),(8875,'项目中期报告','1449736735',1,'dev1449736735',2,NULL,NULL,0,1),(8876,'项目总结报告书','1449736735',1,'dev1449736735',3,NULL,NULL,0,1),(8877,'项目经费总决算表','1449736735',1,'dev1449736735',3,NULL,NULL,0,1),(8878,'项目验收专家组意见','1449736735',1,'dev1449736735',3,NULL,NULL,0,1),(8879,'北京市通州区科技计划项目实施方案','1449736735',1,'dev1449736735',0,NULL,NULL,1,1),(8880,'项目任务书','1449738663',1,'dev1449738663',1,NULL,NULL,1,1),(8881,'专家名单及专家论证意见','1449738663',1,'dev1449738663',1,NULL,NULL,1,1),(8882,'课题调整申请表','1449738663',1,'dev1449738663',2,NULL,NULL,1,1),(8883,'项目中期报告','1449738663',1,'dev1449738663',2,NULL,NULL,0,1),(8884,'项目总结报告书','1449738663',1,'dev1449738663',3,NULL,NULL,0,1),(8885,'项目经费总决算表','1449738663',1,'dev1449738663',3,NULL,NULL,0,1),(8886,'项目验收专家组意见','1449738663',1,'dev1449738663',3,NULL,NULL,0,1),(8887,'北京市通州区科技计划项目实施方案','1449802639',2,'dev1449738663',0,NULL,NULL,1,1),(8888,'项目任务书','1449738698',1,'dev1449738698',1,NULL,NULL,1,1),(8889,'专家名单及专家论证意见','1449738698',1,'dev1449738698',1,NULL,NULL,1,1),(8890,'课题调整申请表','1449738698',1,'dev1449738698',2,NULL,NULL,1,1),(8891,'项目中期报告','1449738698',1,'dev1449738698',2,NULL,NULL,0,1),(8892,'项目总结报告书','1449738698',1,'dev1449738698',3,NULL,NULL,0,1),(8893,'项目经费总决算表','1449738698',1,'dev1449738698',3,NULL,NULL,0,1),(8894,'项目验收专家组意见','1449738698',1,'dev1449738698',3,NULL,NULL,0,1),(8895,'北京市通州区科技计划项目实施方案','1449739085',2,'dev1449738698',0,NULL,NULL,1,1),(8896,'项目任务书','1449739261',1,'dev1449739261',1,NULL,NULL,1,1),(8897,'专家名单及专家论证意见','1449739261',1,'dev1449739261',1,NULL,NULL,1,1),(8898,'课题调整申请表','1449739261',1,'dev1449739261',2,NULL,NULL,1,1),(8899,'项目中期报告','1449739261',1,'dev1449739261',2,NULL,NULL,0,1),(8900,'项目总结报告书','1449739261',1,'dev1449739261',3,NULL,NULL,0,1),(8901,'项目经费总决算表','1449739261',1,'dev1449739261',3,NULL,NULL,0,1),(8902,'项目验收专家组意见','1449739261',1,'dev1449739261',3,NULL,NULL,0,1),(8903,'北京市通州区科技计划项目实施方案','1449739261',1,'dev1449739261',0,NULL,NULL,1,1),(8904,'通州区支持科技成果转化项目申报书','1449739261',1,'dev1449739261',0,NULL,NULL,1,1),(8905,'项目任务书','1449741563',1,'dev1449741563',1,NULL,NULL,1,2),(8906,'专家名单及专家论证意见','1449741563',1,'dev1449741563',1,NULL,NULL,1,2),(8907,'课题调整申请表','1449741563',1,'dev1449741563',2,NULL,NULL,1,2),(8908,'项目中期报告','1449741563',1,'dev1449741563',2,NULL,NULL,0,2),(8909,'项目总结报告书','1449741563',1,'dev1449741563',3,NULL,NULL,0,2),(8910,'项目经费总决算表','1449741563',1,'dev1449741563',3,NULL,NULL,0,2),(8911,'项目验收专家组意见','1449741563',1,'dev1449741563',3,NULL,NULL,0,2),(8912,'北京市通州区科技计划项目实施方案','1449741569',2,'dev1449741563',0,NULL,NULL,1,2),(8913,'项目任务书','1449742184',1,'dev1449742184',1,NULL,NULL,1,1),(8914,'专家名单及专家论证意见','1449742184',1,'dev1449742184',1,NULL,NULL,1,1),(8915,'课题调整申请表','1449742184',1,'dev1449742184',2,NULL,NULL,1,1),(8916,'项目中期报告','1449742184',1,'dev1449742184',2,NULL,NULL,0,1),(8917,'项目总结报告书','1449742184',1,'dev1449742184',3,NULL,NULL,0,1),(8918,'项目经费总决算表','1449742184',1,'dev1449742184',3,NULL,NULL,0,1),(8919,'项目验收专家组意见','1449742184',1,'dev1449742184',3,NULL,NULL,0,1),(8920,'北京市通州区科技计划项目实施方案','1449742288',2,'dev1449742184',0,NULL,NULL,1,1),(8921,'通州区支持承担市级以上科技项目申报书','1449742291',5,'dev1449742184',0,NULL,'1449806056',1,1),(8922,'项目任务书','1449742458',1,'dev1449742458',1,NULL,NULL,1,1),(8923,'专家名单及专家论证意见','1449742458',1,'dev1449742458',1,NULL,NULL,1,1),(8924,'课题调整申请表','1449742458',1,'dev1449742458',2,NULL,NULL,1,1),(8925,'项目中期报告','1449742458',1,'dev1449742458',2,NULL,NULL,0,1),(8926,'项目总结报告书','1449742458',1,'dev1449742458',3,NULL,NULL,0,1),(8927,'项目经费总决算表','1449742458',1,'dev1449742458',3,NULL,NULL,0,1),(8928,'项目验收专家组意见','1449742458',1,'dev1449742458',3,NULL,NULL,0,1),(8929,'北京市通州区科技计划项目实施方案','1449742458',1,'dev1449742458',0,NULL,NULL,1,1),(8930,'项目任务书','1449742467',1,'dev1449742467',1,NULL,NULL,1,1),(8931,'专家名单及专家论证意见','1449742467',1,'dev1449742467',1,NULL,NULL,1,1),(8932,'课题调整申请表','1449742467',1,'dev1449742467',2,NULL,NULL,1,1),(8933,'项目中期报告','1449742467',1,'dev1449742467',2,NULL,NULL,0,1),(8934,'项目总结报告书','1449742467',1,'dev1449742467',3,NULL,NULL,0,1),(8935,'项目经费总决算表','1449742467',1,'dev1449742467',3,NULL,NULL,0,1),(8936,'项目验收专家组意见','1449742467',1,'dev1449742467',3,NULL,NULL,0,1),(8937,'北京市通州区科技计划项目实施方案','1449742467',1,'dev1449742467',0,NULL,NULL,1,1),(8938,'项目任务书','1449742475',1,'dev1449742475',1,NULL,NULL,1,1),(8939,'专家名单及专家论证意见','1449742475',1,'dev1449742475',1,NULL,NULL,1,1),(8940,'课题调整申请表','1449742475',1,'dev1449742475',2,NULL,NULL,1,1),(8941,'项目中期报告','1449742475',1,'dev1449742475',2,NULL,NULL,0,1),(8942,'项目总结报告书','1449742475',1,'dev1449742475',3,NULL,NULL,0,1),(8943,'项目经费总决算表','1449742475',1,'dev1449742475',3,NULL,NULL,0,1),(8944,'项目验收专家组意见','1449742475',1,'dev1449742475',3,NULL,NULL,0,1),(8945,'北京市通州区科技计划项目实施方案','1449742475',1,'dev1449742475',0,NULL,NULL,1,1),(8946,'项目任务书','1449742482',1,'dev1449742482',1,NULL,NULL,1,1),(8947,'专家名单及专家论证意见','1449742482',1,'dev1449742482',1,NULL,NULL,1,1),(8948,'课题调整申请表','1449742482',1,'dev1449742482',2,NULL,NULL,1,1),(8949,'项目中期报告','1449742482',1,'dev1449742482',2,NULL,NULL,0,1),(8950,'项目总结报告书','1449742482',1,'dev1449742482',3,NULL,NULL,0,1),(8951,'项目经费总决算表','1449742482',1,'dev1449742482',3,NULL,NULL,0,1),(8952,'项目验收专家组意见','1449742482',1,'dev1449742482',3,NULL,NULL,0,1),(8953,'北京市通州区科技计划项目实施方案','1449742482',1,'dev1449742482',0,NULL,NULL,1,1),(8954,'项目任务书','1449793674',1,'dev1449793674',1,NULL,NULL,1,1),(8955,'专家名单及专家论证意见','1449793674',1,'dev1449793674',1,NULL,NULL,1,1),(8956,'课题调整申请表','1449793674',1,'dev1449793674',2,NULL,NULL,1,1),(8957,'项目中期报告','1449793674',1,'dev1449793674',2,NULL,NULL,0,1),(8958,'项目总结报告书','1449793674',1,'dev1449793674',3,NULL,NULL,0,1),(8959,'项目经费总决算表','1449793674',1,'dev1449793674',3,NULL,NULL,0,1),(8960,'项目验收专家组意见','1449793674',1,'dev1449793674',3,NULL,NULL,0,1),(8961,'北京市通州区科技计划项目实施方案','1449793674',1,'dev1449793674',0,NULL,NULL,1,1),(8962,'项目任务书','1449793701',1,'dev1449793701',1,NULL,NULL,1,1),(8963,'专家名单及专家论证意见','1449793701',1,'dev1449793701',1,NULL,NULL,1,1),(8964,'课题调整申请表','1449793701',1,'dev1449793701',2,NULL,NULL,1,1),(8965,'项目中期报告','1449793701',1,'dev1449793701',2,NULL,NULL,0,1),(8966,'项目总结报告书','1449793701',1,'dev1449793701',3,NULL,NULL,0,1),(8967,'项目经费总决算表','1449793701',1,'dev1449793701',3,NULL,NULL,0,1),(8968,'项目验收专家组意见','1449793701',1,'dev1449793701',3,NULL,NULL,0,1),(8969,'北京市通州区科技计划项目实施方案','1449793701',1,'dev1449793701',0,NULL,NULL,1,1),(8970,'项目任务书','1449793951',1,'dev1449793951',1,NULL,NULL,1,1),(8971,'专家名单及专家论证意见','1449793951',1,'dev1449793951',1,NULL,NULL,1,1),(8972,'课题调整申请表','1449793951',1,'dev1449793951',2,NULL,NULL,1,1),(8973,'项目中期报告','1449793951',1,'dev1449793951',2,NULL,NULL,0,1),(8974,'项目总结报告书','1449793951',1,'dev1449793951',3,NULL,NULL,0,1),(8975,'项目经费总决算表','1449793951',1,'dev1449793951',3,NULL,NULL,0,1),(8976,'项目验收专家组意见','1449793951',1,'dev1449793951',3,NULL,NULL,0,1),(8977,'北京市通州区科技计划项目实施方案','1449793951',1,'dev1449793951',0,NULL,NULL,1,1),(8978,'项目任务书','1449794525',1,'dev1449794525',1,NULL,NULL,1,1),(8979,'专家名单及专家论证意见','1449794525',1,'dev1449794525',1,NULL,NULL,1,1),(8980,'课题调整申请表','1449794525',1,'dev1449794525',2,NULL,NULL,1,1),(8981,'项目中期报告','1449794525',1,'dev1449794525',2,NULL,NULL,0,1),(8982,'项目总结报告书','1449794525',1,'dev1449794525',3,NULL,NULL,0,1),(8983,'项目经费总决算表','1449794525',1,'dev1449794525',3,NULL,NULL,0,1),(8984,'项目验收专家组意见','1449794525',1,'dev1449794525',3,NULL,NULL,0,1),(8985,'北京市通州区科技计划项目实施方案','1449795099',4,'dev1449794525',0,NULL,'1449814086',1,2),(8986,'项目任务书','1449794760',1,'dev1449794760',1,NULL,NULL,1,1),(8987,'专家名单及专家论证意见','1449794760',1,'dev1449794760',1,NULL,NULL,1,1),(8988,'课题调整申请表','1449794760',1,'dev1449794760',2,NULL,NULL,1,1),(8989,'项目中期报告','1449794760',1,'dev1449794760',2,NULL,NULL,0,1),(8990,'项目总结报告书','1449794760',1,'dev1449794760',3,NULL,NULL,0,1),(8991,'项目经费总决算表','1449794760',1,'dev1449794760',3,NULL,NULL,0,1),(8992,'项目验收专家组意见','1449794760',1,'dev1449794760',3,NULL,NULL,0,1),(8993,'北京市通州区科技计划项目实施方案','1449794760',1,'dev1449794760',0,NULL,NULL,1,1),(8994,'项目任务书','1449795038',1,'dev1449795038',1,NULL,NULL,1,1),(8995,'专家名单及专家论证意见','1449795038',1,'dev1449795038',1,NULL,NULL,1,1),(8996,'课题调整申请表','1449795038',1,'dev1449795038',2,NULL,NULL,1,1),(8997,'项目中期报告','1449795038',1,'dev1449795038',2,NULL,NULL,0,1),(8998,'项目总结报告书','1449795038',1,'dev1449795038',3,NULL,NULL,0,1),(8999,'项目经费总决算表','1449795038',1,'dev1449795038',3,NULL,NULL,0,1),(9000,'项目验收专家组意见','1449795038',1,'dev1449795038',3,NULL,NULL,0,1),(9001,'','1449795038',1,'dev1449795038',0,NULL,NULL,1,1),(9002,'项目任务书','1449795125',1,'dev1449795125',1,NULL,NULL,1,1),(9003,'专家名单及专家论证意见','1449795125',1,'dev1449795125',1,NULL,NULL,1,1),(9004,'课题调整申请表','1449795125',1,'dev1449795125',2,NULL,NULL,1,1),(9005,'项目中期报告','1449795125',1,'dev1449795125',2,NULL,NULL,0,1),(9006,'项目总结报告书','1449795125',1,'dev1449795125',3,NULL,NULL,0,1),(9007,'项目经费总决算表','1449795125',1,'dev1449795125',3,NULL,NULL,0,1),(9008,'项目验收专家组意见','1449795125',1,'dev1449795125',3,NULL,NULL,0,1),(9009,'北京市通州区科技计划项目实施方案','1449795125',1,'dev1449795125',0,NULL,NULL,1,1),(9010,'项目任务书','1449795166',1,'dev1449795166',1,NULL,NULL,1,1),(9011,'专家名单及专家论证意见','1449795166',1,'dev1449795166',1,NULL,NULL,1,1),(9012,'课题调整申请表','1449795166',1,'dev1449795166',2,NULL,NULL,1,1),(9013,'项目中期报告','1449795166',1,'dev1449795166',2,NULL,NULL,0,1),(9014,'项目总结报告书','1449795166',1,'dev1449795166',3,NULL,NULL,0,1),(9015,'项目经费总决算表','1449795166',1,'dev1449795166',3,NULL,NULL,0,1),(9016,'项目验收专家组意见','1449795166',1,'dev1449795166',3,NULL,NULL,0,1),(9017,'','1449795166',1,'dev1449795166',0,NULL,NULL,1,1),(9018,'项目任务书','1449795183',1,'dev1449795183',1,NULL,NULL,1,1),(9019,'专家名单及专家论证意见','1449795183',1,'dev1449795183',1,NULL,NULL,1,1),(9020,'课题调整申请表','1449795183',1,'dev1449795183',2,NULL,NULL,1,1),(9021,'项目中期报告','1449795183',1,'dev1449795183',2,NULL,NULL,0,1),(9022,'项目总结报告书','1449795183',1,'dev1449795183',3,NULL,NULL,0,1),(9023,'项目经费总决算表','1449795183',1,'dev1449795183',3,NULL,NULL,0,1),(9024,'项目验收专家组意见','1449795183',1,'dev1449795183',3,NULL,NULL,0,1),(9025,'北京市通州区科技计划项目实施方案','1449795183',1,'dev1449795183',0,NULL,NULL,1,1),(9026,'项目任务书','1449795203',1,'dev1449795203',1,NULL,NULL,1,1),(9027,'专家名单及专家论证意见','1449795203',1,'dev1449795203',1,NULL,NULL,1,1),(9028,'课题调整申请表','1449795203',1,'dev1449795203',2,NULL,NULL,1,1),(9029,'项目中期报告','1449795203',1,'dev1449795203',2,NULL,NULL,0,1),(9030,'项目总结报告书','1449795203',1,'dev1449795203',3,NULL,NULL,0,1),(9031,'项目经费总决算表','1449795203',1,'dev1449795203',3,NULL,NULL,0,1),(9032,'项目验收专家组意见','1449795203',1,'dev1449795203',3,NULL,NULL,0,1),(9033,'','1449795203',1,'dev1449795203',0,NULL,NULL,1,1),(9034,'项目任务书','1449795277',1,'dev1449795277',1,NULL,NULL,1,1),(9035,'专家名单及专家论证意见','1449795277',1,'dev1449795277',1,NULL,NULL,1,1),(9036,'课题调整申请表','1449795277',1,'dev1449795277',2,NULL,NULL,1,1),(9037,'项目中期报告','1449795277',1,'dev1449795277',2,NULL,NULL,0,1),(9038,'项目总结报告书','1449795277',1,'dev1449795277',3,NULL,NULL,0,1),(9039,'项目经费总决算表','1449795277',1,'dev1449795277',3,NULL,NULL,0,1),(9040,'项目验收专家组意见','1449795277',1,'dev1449795277',3,NULL,NULL,0,1),(9041,'北京市通州区科技计划项目实施方案','1449795277',1,'dev1449795277',0,NULL,NULL,1,1),(9042,'项目任务书','1449795363',1,'dev1449795363',1,NULL,NULL,1,1),(9043,'专家名单及专家论证意见','1449795363',1,'dev1449795363',1,NULL,NULL,1,1),(9044,'课题调整申请表','1449795363',1,'dev1449795363',2,NULL,NULL,1,1),(9045,'项目中期报告','1449795363',1,'dev1449795363',2,NULL,NULL,0,1),(9046,'项目总结报告书','1449795363',1,'dev1449795363',3,NULL,NULL,0,1),(9047,'项目经费总决算表','1449795363',1,'dev1449795363',3,NULL,NULL,0,1),(9048,'项目验收专家组意见','1449795363',1,'dev1449795363',3,NULL,NULL,0,1),(9049,'北京市通州区科技计划项目实施方案','1449795363',1,'dev1449795363',0,NULL,NULL,1,1),(9050,'项目任务书','1449795365',1,'dev1449795365',1,NULL,NULL,1,1),(9051,'专家名单及专家论证意见','1449795365',1,'dev1449795365',1,NULL,NULL,1,1),(9052,'课题调整申请表','1449795365',1,'dev1449795365',2,NULL,NULL,1,1),(9053,'项目中期报告','1449795365',1,'dev1449795365',2,NULL,NULL,0,1),(9054,'项目总结报告书','1449795365',1,'dev1449795365',3,NULL,NULL,0,1),(9055,'项目经费总决算表','1449795365',1,'dev1449795365',3,NULL,NULL,0,1),(9056,'项目验收专家组意见','1449795365',1,'dev1449795365',3,NULL,NULL,0,1),(9057,'','1449795365',1,'dev1449795365',0,NULL,NULL,1,1),(9058,'项目任务书','1449795399',1,'dev1449795399',1,NULL,NULL,1,1),(9059,'专家名单及专家论证意见','1449795399',1,'dev1449795399',1,NULL,NULL,1,1),(9060,'课题调整申请表','1449795399',1,'dev1449795399',2,NULL,NULL,1,1),(9061,'项目中期报告','1449795399',1,'dev1449795399',2,NULL,NULL,0,1),(9062,'项目总结报告书','1449795399',1,'dev1449795399',3,NULL,NULL,0,1),(9063,'项目经费总决算表','1449795399',1,'dev1449795399',3,NULL,NULL,0,1),(9064,'项目验收专家组意见','1449795399',1,'dev1449795399',3,NULL,NULL,0,1),(9065,'北京市通州区科技计划项目实施方案','1449795399',1,'dev1449795399',0,NULL,NULL,1,1),(9066,'项目任务书','1449795502',1,'dev1449795502',1,NULL,NULL,1,1),(9067,'专家名单及专家论证意见','1449795502',1,'dev1449795502',1,NULL,NULL,1,1),(9068,'课题调整申请表','1449795502',1,'dev1449795502',2,NULL,NULL,1,1),(9069,'项目中期报告','1449795502',1,'dev1449795502',2,NULL,NULL,0,1),(9070,'项目总结报告书','1449795502',1,'dev1449795502',3,NULL,NULL,0,1),(9071,'项目经费总决算表','1449795502',1,'dev1449795502',3,NULL,NULL,0,1),(9072,'项目验收专家组意见','1449795502',1,'dev1449795502',3,NULL,NULL,0,1),(9073,'北京市通州区科技计划项目实施方案','1449795502',1,'dev1449795502',0,NULL,NULL,1,1),(9074,'项目任务书','1449795524',1,'dev1449795524',1,NULL,NULL,1,1),(9075,'专家名单及专家论证意见','1449795524',1,'dev1449795524',1,NULL,NULL,1,1),(9076,'课题调整申请表','1449795524',1,'dev1449795524',2,NULL,NULL,1,1),(9077,'项目中期报告','1449795524',1,'dev1449795524',2,NULL,NULL,0,1),(9078,'项目总结报告书','1449795524',1,'dev1449795524',3,NULL,NULL,0,1),(9079,'项目经费总决算表','1449795524',1,'dev1449795524',3,NULL,NULL,0,1),(9080,'项目验收专家组意见','1449795524',1,'dev1449795524',3,NULL,NULL,0,1),(9081,'北京市通州区科技计划项目实施方案','1449795524',1,'dev1449795524',0,NULL,NULL,1,1),(9082,'项目任务书','1449795536',1,'dev1449795536',1,NULL,NULL,1,1),(9083,'专家名单及专家论证意见','1449795536',1,'dev1449795536',1,NULL,NULL,1,1),(9084,'课题调整申请表','1449795536',1,'dev1449795536',2,NULL,NULL,1,1),(9085,'项目中期报告','1449795536',1,'dev1449795536',2,NULL,NULL,0,1),(9086,'项目总结报告书','1449795536',1,'dev1449795536',3,NULL,NULL,0,1),(9087,'项目经费总决算表','1449795536',1,'dev1449795536',3,NULL,NULL,0,1),(9088,'项目验收专家组意见','1449795536',1,'dev1449795536',3,NULL,NULL,0,1),(9089,'北京市通州区科技计划项目实施方案','1449795975',2,'dev1449795536',0,NULL,NULL,1,1),(9090,'项目任务书','1449795743',1,'dev1449795743',1,NULL,NULL,1,1),(9091,'专家名单及专家论证意见','1449795743',1,'dev1449795743',1,NULL,NULL,1,1),(9092,'课题调整申请表','1449795743',1,'dev1449795743',2,NULL,NULL,1,1),(9093,'项目中期报告','1449795743',1,'dev1449795743',2,NULL,NULL,0,1),(9094,'项目总结报告书','1449795743',1,'dev1449795743',3,NULL,NULL,0,1),(9095,'项目经费总决算表','1449795743',1,'dev1449795743',3,NULL,NULL,0,1),(9096,'项目验收专家组意见','1449795743',1,'dev1449795743',3,NULL,NULL,0,1),(9097,'北京市通州区科技计划项目实施方案','1449795743',1,'dev1449795743',0,NULL,NULL,1,1),(9098,'项目任务书','1449795921',1,'dev1449795921',1,NULL,NULL,1,1),(9099,'专家名单及专家论证意见','1449795921',1,'dev1449795921',1,NULL,NULL,1,1),(9100,'课题调整申请表','1449795921',1,'dev1449795921',2,NULL,NULL,1,1),(9101,'项目中期报告','1449795921',1,'dev1449795921',2,NULL,NULL,0,1),(9102,'项目总结报告书','1449795921',1,'dev1449795921',3,NULL,NULL,0,1),(9103,'项目经费总决算表','1449795921',1,'dev1449795921',3,NULL,NULL,0,1),(9104,'项目验收专家组意见','1449795921',1,'dev1449795921',3,NULL,NULL,0,1),(9105,'北京市通州区科技计划项目实施方案','1449795921',1,'dev1449795921',0,NULL,NULL,1,1),(9106,'项目任务书','1449795935',1,'dev1449795935',1,NULL,NULL,1,1),(9107,'专家名单及专家论证意见','1449795935',1,'dev1449795935',1,NULL,NULL,1,1),(9108,'课题调整申请表','1449795935',1,'dev1449795935',2,NULL,NULL,1,1),(9109,'项目中期报告','1449795935',1,'dev1449795935',2,NULL,NULL,0,1),(9110,'项目总结报告书','1449795935',1,'dev1449795935',3,NULL,NULL,0,1),(9111,'项目经费总决算表','1449795935',1,'dev1449795935',3,NULL,NULL,0,1),(9112,'项目验收专家组意见','1449795935',1,'dev1449795935',3,NULL,NULL,0,1),(9113,'','1449795935',1,'dev1449795935',0,NULL,NULL,1,1),(9114,'项目任务书','1449795946',1,'dev1449795946',1,NULL,NULL,1,1),(9115,'专家名单及专家论证意见','1449795946',1,'dev1449795946',1,NULL,NULL,1,1),(9116,'课题调整申请表','1449795946',1,'dev1449795946',2,NULL,NULL,1,1),(9117,'项目中期报告','1449795946',1,'dev1449795946',2,NULL,NULL,0,1),(9118,'项目总结报告书','1449795946',1,'dev1449795946',3,NULL,NULL,0,1),(9119,'项目经费总决算表','1449795946',1,'dev1449795946',3,NULL,NULL,0,1),(9120,'项目验收专家组意见','1449795946',1,'dev1449795946',3,NULL,NULL,0,1),(9121,'','1449795946',1,'dev1449795946',0,NULL,NULL,1,1),(9122,'项目任务书','1449796002',1,'dev1449796002',1,NULL,NULL,1,1),(9123,'专家名单及专家论证意见','1449796002',1,'dev1449796002',1,NULL,NULL,1,1),(9124,'课题调整申请表','1449796002',1,'dev1449796002',2,NULL,NULL,1,1),(9125,'项目中期报告','1449796002',1,'dev1449796002',2,NULL,NULL,0,1),(9126,'项目总结报告书','1449796002',1,'dev1449796002',3,NULL,NULL,0,1),(9127,'项目经费总决算表','1449796002',1,'dev1449796002',3,NULL,NULL,0,1),(9128,'项目验收专家组意见','1449796002',1,'dev1449796002',3,NULL,NULL,0,1),(9129,'北京市通州区科技计划项目实施方案','1449796002',1,'dev1449796002',0,NULL,NULL,1,1),(9130,'项目任务书','1449796202',1,'dev1449796202',1,NULL,NULL,1,1),(9131,'专家名单及专家论证意见','1449796202',1,'dev1449796202',1,NULL,NULL,1,1),(9132,'课题调整申请表','1449796202',1,'dev1449796202',2,NULL,NULL,1,1),(9133,'项目中期报告','1449796202',1,'dev1449796202',2,NULL,NULL,0,1),(9134,'项目总结报告书','1449796202',1,'dev1449796202',3,NULL,NULL,0,1),(9135,'项目经费总决算表','1449796202',1,'dev1449796202',3,NULL,NULL,0,1),(9136,'项目验收专家组意见','1449796202',1,'dev1449796202',3,NULL,NULL,0,1),(9137,'','1449796202',1,'dev1449796202',0,NULL,NULL,1,1),(9138,'项目任务书','1449796589',1,'dev1449796589',1,NULL,NULL,1,1),(9139,'专家名单及专家论证意见','1449796589',1,'dev1449796589',1,NULL,NULL,1,1),(9140,'课题调整申请表','1449796589',1,'dev1449796589',2,NULL,NULL,1,1),(9141,'项目中期报告','1449796589',1,'dev1449796589',2,NULL,NULL,0,1),(9142,'项目总结报告书','1449796589',1,'dev1449796589',3,NULL,NULL,0,1),(9143,'项目经费总决算表','1449796589',1,'dev1449796589',3,NULL,NULL,0,1),(9144,'项目验收专家组意见','1449796589',1,'dev1449796589',3,NULL,NULL,0,1),(9145,'','1449796589',1,'dev1449796589',0,NULL,NULL,1,1),(9146,'项目任务书','1449812264',4,'dev1449804673',1,NULL,'1449813897',1,1),(9147,'专家名单及专家论证意见','1449855660',2,'dev1449804673',1,NULL,'1449838388',1,1),(9148,'课题调整申请表','1449814728',4,'dev1449804673',2,NULL,'1449816075',1,1),(9149,'项目中期报告','1449815195',4,'dev1449804673',2,NULL,'1449816085',1,1),(9150,'项目总结报告书','1449817580',4,'dev1449804673',3,NULL,'1449838375',1,1),(9151,'项目经费总决算表','1449817589',4,'dev1449804673',3,NULL,'1449838383',1,1),(9152,'项目验收专家组意见','1449804673',1,'dev1449804673',3,NULL,NULL,1,1),(9153,'北京市通州区科技计划项目实施方案','1449806035',4,'dev1449804673',0,NULL,'1449806268',1,2),(9154,'北京市通州区科技计划项目实施方案','1449810824',4,'dev1449810523',0,NULL,'1449811260',1,2),(9155,'通州区支持产学研合作项目申请书','1449810831',4,'dev1449810523',0,NULL,'1449810926',1,1),(9156,'','1449810810',1,'dev1449810810',0,NULL,NULL,1,1),(9157,'ͨ','1449810810',1,'dev1449810810',0,NULL,NULL,1,1),(9158,'','1449810838',1,'dev1449810838',0,NULL,NULL,1,1),(9159,'ͨ','1449810838',1,'dev1449810838',0,NULL,NULL,1,1),(9160,'项目任务书','1449810886',1,'com1449810886',1,NULL,NULL,1,1),(9161,'专家名单及专家论证意见','1449810886',1,'com1449810886',1,NULL,NULL,1,1),(9162,'课题调整申请表','1449810886',1,'com1449810886',2,NULL,NULL,1,1),(9163,'项目中期报告','1449810886',1,'com1449810886',2,NULL,NULL,0,1),(9164,'项目总结报告书','1449810886',1,'com1449810886',3,NULL,NULL,0,1),(9165,'项目经费总决算表','1449810886',1,'com1449810886',3,NULL,NULL,0,1),(9166,'项目验收专家组意见','1449810886',1,'com1449810886',3,NULL,NULL,0,1),(9167,'','1449810886',1,'com1449810886',0,NULL,NULL,1,1),(9168,'ͨ','1449810886',1,'com1449810886',0,NULL,NULL,1,1),(9169,'北京市通州区科技计划项目实施方案','1449811390',4,'dev1449811384',0,NULL,'1449811528',1,2),(9170,'通州区支持产学研合作项目申请书','1449811395',4,'dev1449811384',0,NULL,'1449811435',1,1),(9171,'北京市通州区科技计划项目实施方案','1449812689',4,'dev1449812670',0,NULL,'1449813266',1,2),(9172,'通州区支持产学研合作项目申请书','1449812693',4,'dev1449812670',0,NULL,'1449812717',1,1),(9173,'项目任务书','1449814100',1,'dev1449814100',1,NULL,NULL,1,1),(9174,'专家名单及专家论证意见','1449814100',1,'dev1449814100',1,NULL,NULL,1,1),(9175,'课题调整申请表','1449814100',1,'dev1449814100',2,NULL,NULL,1,1),(9176,'项目中期报告','1449814100',1,'dev1449814100',2,NULL,NULL,0,1),(9177,'项目总结报告书','1449814100',1,'dev1449814100',3,NULL,NULL,0,1),(9178,'项目经费总决算表','1449814100',1,'dev1449814100',3,NULL,NULL,0,1),(9179,'项目验收专家组意见','1449814100',1,'dev1449814100',3,NULL,NULL,0,1),(9180,'北京市通州区科技计划项目实施方案','1449814100',1,'dev1449814100',0,NULL,NULL,1,1),(9181,'项目任务书','1449815200',1,'dev1449815200',1,NULL,NULL,1,1),(9182,'专家名单及专家论证意见','1449815200',1,'dev1449815200',1,NULL,NULL,1,1),(9183,'课题调整申请表','1449815200',1,'dev1449815200',2,NULL,NULL,1,1),(9184,'项目中期报告','1449815200',1,'dev1449815200',2,NULL,NULL,0,1),(9185,'项目总结报告书','1449815200',1,'dev1449815200',3,NULL,NULL,0,1),(9186,'项目经费总决算表','1449815200',1,'dev1449815200',3,NULL,NULL,0,1),(9187,'项目验收专家组意见','1449815200',1,'dev1449815200',3,NULL,NULL,0,1),(9188,'北京市通州区科技计划项目实施方案','1449815212',4,'dev1449815200',0,NULL,'1449815333',1,2),(9189,'项目任务书','1449815671',1,'dev1449815671',1,NULL,NULL,1,1),(9190,'专家名单及专家论证意见','1449815671',1,'dev1449815671',1,NULL,NULL,1,1),(9191,'课题调整申请表','1449815671',1,'dev1449815671',2,NULL,NULL,1,1),(9192,'项目中期报告','1449815671',1,'dev1449815671',2,NULL,NULL,0,1),(9193,'项目总结报告书','1449815671',1,'dev1449815671',3,NULL,NULL,0,1),(9194,'项目经费总决算表','1449815671',1,'dev1449815671',3,NULL,NULL,0,1),(9195,'项目验收专家组意见','1449815671',1,'dev1449815671',3,NULL,NULL,0,1),(9196,'北京市通州区科技计划项目实施方案','1449815677',4,'dev1449815671',0,NULL,'1449815740',1,2),(9197,'项目任务书','1449816099',1,'dev1449816099',1,NULL,NULL,1,1),(9198,'专家名单及专家论证意见','1449816099',1,'dev1449816099',1,NULL,NULL,1,1),(9199,'课题调整申请表','1449816099',1,'dev1449816099',2,NULL,NULL,1,1),(9200,'项目中期报告','1449816099',1,'dev1449816099',2,NULL,NULL,0,1),(9201,'项目总结报告书','1449816099',1,'dev1449816099',3,NULL,NULL,0,1),(9202,'项目经费总决算表','1449816099',1,'dev1449816099',3,NULL,NULL,0,1),(9203,'项目验收专家组意见','1449816099',1,'dev1449816099',3,NULL,NULL,0,1),(9204,'北京市通州区科技计划项目实施方案','1449816111',4,'dev1449816099',0,NULL,'1449816154',1,2),(9205,'项目任务书','1449820776',2,'dev1449816291',1,NULL,NULL,1,1),(9206,'专家名单及专家论证意见','1449816291',1,'dev1449816291',1,NULL,NULL,1,1),(9207,'课题调整申请表','1449816291',1,'dev1449816291',2,NULL,NULL,1,1),(9208,'项目中期报告','1449816291',1,'dev1449816291',2,NULL,NULL,0,1),(9209,'项目总结报告书','1449816291',1,'dev1449816291',3,NULL,NULL,0,1),(9210,'项目经费总决算表','1449816291',1,'dev1449816291',3,NULL,NULL,0,1),(9211,'项目验收专家组意见','1449816291',1,'dev1449816291',3,NULL,NULL,0,1),(9212,'北京市通州区科技计划项目实施方案','1449816297',4,'dev1449816291',0,NULL,'1449816351',1,2),(9213,'项目任务书','1449816577',1,'com1449816577',1,NULL,NULL,1,1),(9214,'专家名单及专家论证意见','1449816577',1,'com1449816577',1,NULL,NULL,1,1),(9215,'课题调整申请表','1449816577',1,'com1449816577',2,NULL,NULL,1,1),(9216,'项目中期报告','1449816577',1,'com1449816577',2,NULL,NULL,0,1),(9217,'项目总结报告书','1449816577',1,'com1449816577',3,NULL,NULL,0,1),(9218,'项目经费总决算表','1449816577',1,'com1449816577',3,NULL,NULL,0,1),(9219,'项目验收专家组意见','1449816577',1,'com1449816577',3,NULL,NULL,0,1),(9220,'通州区高新技术企业认定服务机构资助资金申请表','1449816585',2,'com1449816577',0,NULL,NULL,1,1),(9221,'项目任务书','1449817998',1,'dev1449817998',1,NULL,NULL,1,1),(9222,'专家名单及专家论证意见','1449817998',1,'dev1449817998',1,NULL,NULL,1,1),(9223,'课题调整申请表','1449817998',1,'dev1449817998',2,NULL,NULL,1,1),(9224,'项目中期报告','1449817998',1,'dev1449817998',2,NULL,NULL,0,1),(9225,'项目总结报告书','1449817998',1,'dev1449817998',3,NULL,NULL,0,1),(9226,'项目经费总决算表','1449817998',1,'dev1449817998',3,NULL,NULL,0,1),(9227,'项目验收专家组意见','1449817998',1,'dev1449817998',3,NULL,NULL,0,1),(9228,'北京市通州区科技计划项目实施方案','1449818022',4,'dev1449817998',0,NULL,'1449818070',1,2),(9229,'项目任务书','1449819726',1,'dev1449819726',1,NULL,NULL,1,1),(9230,'专家名单及专家论证意见','1449819726',1,'dev1449819726',1,NULL,NULL,1,1),(9231,'课题调整申请表','1449819726',1,'dev1449819726',2,NULL,NULL,1,1),(9232,'项目中期报告','1449819726',1,'dev1449819726',2,NULL,NULL,0,1),(9233,'项目总结报告书','1449819726',1,'dev1449819726',3,NULL,NULL,0,1),(9234,'项目经费总决算表','1449819726',1,'dev1449819726',3,NULL,NULL,0,1),(9235,'项目验收专家组意见','1449819726',1,'dev1449819726',3,NULL,NULL,0,1),(9236,'北京市通州区科技计划项目实施方案','1449819733',4,'dev1449819726',0,NULL,'1449819887',1,2),(9237,'项目任务书','1449825021',4,'dev1449820432',1,'             \r\n              \r\n  小伙子干得不错。','1449825083',1,1),(9238,'专家名单及专家论证意见','1449825743',4,'dev1449820432',1,'             \r\n              \r\n       ','1449826312',1,1),(9239,'课题调整申请表','1449826500',4,'dev1449820432',2,'             \r\n              \r\n       小伙子干得不错。','1449826627',1,1),(9240,'项目中期报告','1449828234',4,'dev1449820432',2,'             \r\n              \r\n       ','1449828577',1,1),(9241,'项目总结报告书','1449820432',1,'dev1449820432',3,NULL,NULL,1,1),(9242,'项目经费总决算表','1449820432',1,'dev1449820432',3,NULL,NULL,1,1),(9243,'项目验收专家组意见','1449820432',1,'dev1449820432',3,NULL,NULL,1,1),(9244,'北京市通州区科技计划项目实施方案','1449822820',4,'dev1449820432',0,'             \r\n              \r\n       ','1449823997',1,2),(9245,'北京市通州区科技计划项目实施方案','1449821604',2,'dev1449821283',0,NULL,NULL,1,1),(9246,'通州区支持产学研合作项目申请书','1449821799',2,'dev1449821283',0,NULL,NULL,1,1),(9247,'项目任务书','1449822905',4,'dev1449821637',1,NULL,'1449823196',1,1),(9248,'专家名单及专家论证意见','1449823171',4,'dev1449821637',1,NULL,'1449823208',1,1),(9249,'课题调整申请表','1449838424',4,'dev1449821637',2,NULL,'1449838446',1,1),(9250,'项目中期报告','1449838428',4,'dev1449821637',2,NULL,'1449838565',1,1),(9251,'项目总结报告书','1449821637',1,'dev1449821637',3,NULL,NULL,1,1),(9252,'项目经费总决算表','1449821637',1,'dev1449821637',3,NULL,NULL,1,1),(9253,'项目验收专家组意见','1449821637',1,'dev1449821637',3,NULL,NULL,1,1),(9254,'北京市通州区科技计划项目实施方案','1449821780',4,'dev1449821637',0,NULL,'1449822008',1,2),(9255,'项目任务书','1449823454',1,'dev1449823454',1,NULL,NULL,1,1),(9256,'专家名单及专家论证意见','1449823454',1,'dev1449823454',1,NULL,NULL,1,1),(9257,'课题调整申请表','1449823454',1,'dev1449823454',2,NULL,NULL,1,1),(9258,'项目中期报告','1449823454',1,'dev1449823454',2,NULL,NULL,0,1),(9259,'项目总结报告书','1449823454',1,'dev1449823454',3,NULL,NULL,0,1),(9260,'项目经费总决算表','1449823454',1,'dev1449823454',3,NULL,NULL,0,1),(9261,'项目验收专家组意见','1449823454',1,'dev1449823454',3,NULL,NULL,0,1),(9262,'北京市通州区科技计划项目实施方案','1449823454',1,'dev1449823454',0,NULL,NULL,1,1),(9263,'项目任务书','1449823464',1,'dev1449823464',1,NULL,NULL,1,1),(9264,'专家名单及专家论证意见','1449823464',1,'dev1449823464',1,NULL,NULL,1,1),(9265,'课题调整申请表','1449823464',1,'dev1449823464',2,NULL,NULL,1,1),(9266,'项目中期报告','1449823464',1,'dev1449823464',2,NULL,NULL,0,1),(9267,'项目总结报告书','1449823464',1,'dev1449823464',3,NULL,NULL,0,1),(9268,'项目经费总决算表','1449823464',1,'dev1449823464',3,NULL,NULL,0,1),(9269,'项目验收专家组意见','1449823464',1,'dev1449823464',3,NULL,NULL,0,1),(9270,'北京市通州区科技计划项目实施方案','1449823464',1,'dev1449823464',0,NULL,NULL,1,1),(9271,'北京市通州区科技计划项目实施方案','1449823472',1,'dev1449823472',0,NULL,NULL,1,1),(9272,'通州区支持科技成果转化项目申报书','1449823472',1,'dev1449823472',0,NULL,NULL,1,1),(9273,'北京市通州区科技计划项目实施方案','1449823482',1,'dev1449823482',0,NULL,NULL,1,1),(9274,'通州区支持产学研合作项目申请书','1449823482',1,'dev1449823482',0,NULL,NULL,1,1),(9275,'项目任务书','1449823489',1,'com1449823489',1,NULL,NULL,1,1),(9276,'专家名单及专家论证意见','1449823489',1,'com1449823489',1,NULL,NULL,1,1),(9277,'课题调整申请表','1449823489',1,'com1449823489',2,NULL,NULL,1,1),(9278,'项目中期报告','1449823489',1,'com1449823489',2,NULL,NULL,0,1),(9279,'项目总结报告书','1449823489',1,'com1449823489',3,NULL,NULL,0,1),(9280,'项目经费总决算表','1449823489',1,'com1449823489',3,NULL,NULL,0,1),(9281,'项目验收专家组意见','1449823489',1,'com1449823489',3,NULL,NULL,0,1),(9282,'北京市通州区科技计划项目实施方案','1449823489',1,'com1449823489',0,NULL,NULL,1,1),(9283,'通州区支持技术输出能力提升项目申报书','1449823489',1,'com1449823489',0,NULL,NULL,1,1),(9284,'北京市通州区科技计划项目实施方案','1449823496',1,'dev1449823496',0,NULL,NULL,1,1),(9285,'通州区支持科技服务机构发展项目申报书','1449823496',1,'dev1449823496',0,NULL,NULL,1,1),(9286,'项目任务书','1449823561',1,'dev1449823561',1,NULL,NULL,1,1),(9287,'专家名单及专家论证意见','1449823561',1,'dev1449823561',1,NULL,NULL,1,1),(9288,'课题调整申请表','1449823561',1,'dev1449823561',2,NULL,NULL,1,1),(9289,'项目中期报告','1449823561',1,'dev1449823561',2,NULL,NULL,0,1),(9290,'项目总结报告书','1449823561',1,'dev1449823561',3,NULL,NULL,0,1),(9291,'项目经费总决算表','1449823561',1,'dev1449823561',3,NULL,NULL,0,1),(9292,'项目验收专家组意见','1449823561',1,'dev1449823561',3,NULL,NULL,0,1),(9293,'北京市通州区科技计划项目实施方案','1449823561',1,'dev1449823561',0,NULL,NULL,1,1),(9294,'项目任务书','1449823602',1,'dev1449823602',1,NULL,NULL,1,1),(9295,'专家名单及专家论证意见','1449823602',1,'dev1449823602',1,NULL,NULL,1,1),(9296,'课题调整申请表','1449823602',1,'dev1449823602',2,NULL,NULL,1,1),(9297,'项目中期报告','1449823602',1,'dev1449823602',2,NULL,NULL,0,1),(9298,'项目总结报告书','1449823602',1,'dev1449823602',3,NULL,NULL,0,1),(9299,'项目经费总决算表','1449823602',1,'dev1449823602',3,NULL,NULL,0,1),(9300,'项目验收专家组意见','1449823602',1,'dev1449823602',3,NULL,NULL,0,1),(9301,'北京市通州区科技计划项目实施方案','1449823602',1,'dev1449823602',0,NULL,NULL,1,1),(9302,'项目任务书','1449823637',1,'com1449823637',1,NULL,NULL,1,1),(9303,'专家名单及专家论证意见','1449823637',1,'com1449823637',1,NULL,NULL,1,1),(9304,'课题调整申请表','1449823637',1,'com1449823637',2,NULL,NULL,1,1),(9305,'项目中期报告','1449823637',1,'com1449823637',2,NULL,NULL,0,1),(9306,'项目总结报告书','1449823637',1,'com1449823637',3,NULL,NULL,0,1),(9307,'项目经费总决算表','1449823637',1,'com1449823637',3,NULL,NULL,0,1),(9308,'项目验收专家组意见','1449823637',1,'com1449823637',3,NULL,NULL,0,1),(9309,'北京市通州区科技计划项目实施方案','1449823637',1,'com1449823637',0,NULL,NULL,1,1),(9310,'通州区支持科技企业孵化器大学科技园发展项目申报书','1449823637',1,'com1449823637',0,NULL,NULL,1,1),(9311,'项目任务书','1449823942',1,'dev1449823942',1,NULL,NULL,1,1),(9312,'专家名单及专家论证意见','1449823942',1,'dev1449823942',1,NULL,NULL,1,1),(9313,'课题调整申请表','1449823942',1,'dev1449823942',2,NULL,NULL,1,1),(9314,'项目中期报告','1449823942',1,'dev1449823942',2,NULL,NULL,0,1),(9315,'项目总结报告书','1449823942',1,'dev1449823942',3,NULL,NULL,0,1),(9316,'项目经费总决算表','1449823942',1,'dev1449823942',3,NULL,NULL,0,1),(9317,'项目验收专家组意见','1449823942',1,'dev1449823942',3,NULL,NULL,0,1),(9318,'北京市通州区科技计划项目实施方案','1449824348',2,'dev1449823942',0,NULL,NULL,1,1),(9319,'北京市通州区科技计划项目实施方案','1449824019',1,'dev1449824019',0,NULL,NULL,1,1),(9320,'通州区支持产学研合作项目申请书','1449824019',1,'dev1449824019',0,NULL,NULL,1,1),(9321,'项目任务书','1449831880',1,'dev1449831880',1,NULL,NULL,1,1),(9322,'专家名单及专家论证意见','1449833157',2,'dev1449831880',1,NULL,NULL,1,1),(9323,'课题调整申请表','1449831880',1,'dev1449831880',2,NULL,NULL,1,1),(9324,'项目中期报告','1449831880',1,'dev1449831880',2,NULL,NULL,0,1),(9325,'项目总结报告书','1449831880',1,'dev1449831880',3,NULL,NULL,0,1),(9326,'项目经费总决算表','1449831880',1,'dev1449831880',3,NULL,NULL,0,1),(9327,'项目验收专家组意见','1449831880',1,'dev1449831880',3,NULL,NULL,0,1),(9328,'北京市通州区科技计划项目实施方案','1449831898',4,'dev1449831880',0,NULL,'1449832094',1,2),(9329,'项目任务书','1449833241',4,'dev1449831949',1,'             \r\n              \r\n       ','1449834006',1,1),(9330,'专家名单及专家论证意见','1449833967',4,'dev1449831949',1,'             \r\n              \r\n       ','1449834033',1,1),(9331,'课题调整申请表','1449834085',4,'dev1449831949',2,'             \r\n              \r\n       XIAOHOZ','1449834554',1,1),(9332,'项目中期报告','1449834728',4,'dev1449831949',2,'             \r\n                    \r\n                    \r\n              \r\n              BUXING呃呃呃呃呃呃v\r\n              \r\n       ','1449834733',1,1),(9333,'项目总结报告书','1449846665',2,'dev1449831949',3,NULL,NULL,1,1),(9334,'项目经费总决算表','1449846583',4,'dev1449831949',3,'             \r\n                    \r\n                    \r\n                    \r\n                    \r\n              \r\n     撒啊飒飒飒飒撒\r\n              \r\n              \r\n       ','1449846690',1,1),(9335,'项目验收专家组意见','1449846680',2,'dev1449831949',3,NULL,NULL,1,1),(9336,'北京市通州区科技计划项目实施方案','1449832278',4,'dev1449831949',0,'             \r\n              \r\n      小伙子干得不错。','1449832512',1,2),(9337,'北京市通州区科技计划项目实施方案','1449833042',1,'dev1449833042',0,NULL,NULL,1,1),(9338,'通州区支持产学研合作项目申请书','1449833042',1,'dev1449833042',0,NULL,NULL,1,1),(9339,'项目任务书','1449833482',1,'dev1449833482',1,NULL,NULL,1,1),(9340,'专家名单及专家论证意见','1449833482',1,'dev1449833482',1,NULL,NULL,1,1),(9341,'课题调整申请表','1449833482',1,'dev1449833482',2,NULL,NULL,1,1),(9342,'项目中期报告','1449833482',1,'dev1449833482',2,NULL,NULL,0,1),(9343,'项目总结报告书','1449833482',1,'dev1449833482',3,NULL,NULL,0,1),(9344,'项目经费总决算表','1449833482',1,'dev1449833482',3,NULL,NULL,0,1),(9345,'项目验收专家组意见','1449833482',1,'dev1449833482',3,NULL,NULL,0,1),(9346,'北京市通州区科技计划项目实施方案','1449833482',1,'dev1449833482',0,NULL,NULL,1,1),(9347,'项目任务书','1449836878',1,'dev1449836878',1,NULL,NULL,1,1),(9348,'专家名单及专家论证意见','1449836878',1,'dev1449836878',1,NULL,NULL,1,1),(9349,'课题调整申请表','1449836878',1,'dev1449836878',2,NULL,NULL,1,1),(9350,'项目中期报告','1449836878',1,'dev1449836878',2,NULL,NULL,0,1),(9351,'项目总结报告书','1449836878',1,'dev1449836878',3,NULL,NULL,0,1),(9352,'项目经费总决算表','1449836878',1,'dev1449836878',3,NULL,NULL,0,1),(9353,'项目验收专家组意见','1449836878',1,'dev1449836878',3,NULL,NULL,0,1),(9354,'北京市通州区科技计划项目实施方案','1449837171',4,'dev1449836878',0,NULL,'1449837232',1,2),(9355,'项目任务书','1449838777',1,'dev1449838777',1,NULL,NULL,1,1),(9356,'专家名单及专家论证意见','1449838777',1,'dev1449838777',1,NULL,NULL,1,1),(9357,'课题调整申请表','1449838777',1,'dev1449838777',2,NULL,NULL,1,1),(9358,'项目中期报告','1449838777',1,'dev1449838777',2,NULL,NULL,0,1),(9359,'项目总结报告书','1449838777',1,'dev1449838777',3,NULL,NULL,0,1),(9360,'项目经费总决算表','1449838777',1,'dev1449838777',3,NULL,NULL,0,1),(9361,'项目验收专家组意见','1449838777',1,'dev1449838777',3,NULL,NULL,0,1),(9362,'北京市通州区科技计划项目实施方案','1449838777',1,'dev1449838777',0,NULL,NULL,1,1),(9363,'项目任务书','1449838783',1,'dev1449838783',1,NULL,NULL,1,1),(9364,'专家名单及专家论证意见','1449838783',1,'dev1449838783',1,NULL,NULL,1,1),(9365,'课题调整申请表','1449838783',1,'dev1449838783',2,NULL,NULL,1,1),(9366,'项目中期报告','1449838783',1,'dev1449838783',2,NULL,NULL,0,1),(9367,'项目总结报告书','1449838783',1,'dev1449838783',3,NULL,NULL,0,1),(9368,'项目经费总决算表','1449838783',1,'dev1449838783',3,NULL,NULL,0,1),(9369,'项目验收专家组意见','1449838783',1,'dev1449838783',3,NULL,NULL,0,1),(9370,'北京市通州区科技计划项目实施方案','1449838783',1,'dev1449838783',0,NULL,NULL,1,1),(9371,'项目任务书','1449838789',1,'dev1449838789',1,NULL,NULL,1,1),(9372,'专家名单及专家论证意见','1449838789',1,'dev1449838789',1,NULL,NULL,1,1),(9373,'课题调整申请表','1449838789',1,'dev1449838789',2,NULL,NULL,1,1),(9374,'项目中期报告','1449838789',1,'dev1449838789',2,NULL,NULL,0,1),(9375,'项目总结报告书','1449838789',1,'dev1449838789',3,NULL,NULL,0,1),(9376,'项目经费总决算表','1449838789',1,'dev1449838789',3,NULL,NULL,0,1),(9377,'项目验收专家组意见','1449838789',1,'dev1449838789',3,NULL,NULL,0,1),(9378,'北京市通州区科技计划项目实施方案','1449838789',1,'dev1449838789',0,NULL,NULL,1,1),(9379,'项目任务书','1449838794',1,'dev1449838794',1,NULL,NULL,1,1),(9380,'专家名单及专家论证意见','1449838794',1,'dev1449838794',1,NULL,NULL,1,1),(9381,'课题调整申请表','1449838794',1,'dev1449838794',2,NULL,NULL,1,1),(9382,'项目中期报告','1449838794',1,'dev1449838794',2,NULL,NULL,0,1),(9383,'项目总结报告书','1449838794',1,'dev1449838794',3,NULL,NULL,0,1),(9384,'项目经费总决算表','1449838794',1,'dev1449838794',3,NULL,NULL,0,1),(9385,'项目验收专家组意见','1449838794',1,'dev1449838794',3,NULL,NULL,0,1),(9386,'北京市通州区科技计划项目实施方案','1449841972',2,'dev1449838794',0,NULL,NULL,1,1),(9387,'项目任务书','1449839187',1,'dev1449839187',1,NULL,NULL,1,1),(9388,'专家名单及专家论证意见','1449839187',1,'dev1449839187',1,NULL,NULL,1,1),(9389,'课题调整申请表','1449839187',1,'dev1449839187',2,NULL,NULL,1,1),(9390,'项目中期报告','1449839187',1,'dev1449839187',2,NULL,NULL,0,1),(9391,'项目总结报告书','1449839187',1,'dev1449839187',3,NULL,NULL,0,1),(9392,'项目经费总决算表','1449839187',1,'dev1449839187',3,NULL,NULL,0,1),(9393,'项目验收专家组意见','1449839187',1,'dev1449839187',3,NULL,NULL,0,1),(9394,'北京市通州区科技计划项目实施方案','1449839282',4,'dev1449839187',0,'             \r\n              \r\n       啊啊啊。','1449839404',1,2),(9395,'项目任务书','1449842834',1,'com1449842834',1,NULL,NULL,1,1),(9396,'专家名单及专家论证意见','1449842834',1,'com1449842834',1,NULL,NULL,1,1),(9397,'课题调整申请表','1449842834',1,'com1449842834',2,NULL,NULL,1,1),(9398,'项目中期报告','1449842834',1,'com1449842834',2,NULL,NULL,0,1),(9399,'项目总结报告书','1449842834',1,'com1449842834',3,NULL,NULL,0,1),(9400,'项目经费总决算表','1449842834',1,'com1449842834',3,NULL,NULL,0,1),(9401,'项目验收专家组意见','1449842834',1,'com1449842834',3,NULL,NULL,0,1),(9402,'北京市通州区科技计划项目实施方案','1449842868',2,'com1449842834',0,NULL,NULL,1,1),(9403,'通州区支持技术输出能力提升项目申报书','1449842934',4,'com1449842834',0,NULL,'1449843086',1,1),(9404,'项目任务书','1449843136',1,'com1449843136',1,NULL,NULL,1,1),(9405,'专家名单及专家论证意见','1449843136',1,'com1449843136',1,NULL,NULL,1,1),(9406,'课题调整申请表','1449843136',1,'com1449843136',2,NULL,NULL,1,1),(9407,'项目中期报告','1449843136',1,'com1449843136',2,NULL,NULL,0,1),(9408,'项目总结报告书','1449843136',1,'com1449843136',3,NULL,NULL,0,1),(9409,'项目经费总决算表','1449843136',1,'com1449843136',3,NULL,NULL,0,1),(9410,'项目验收专家组意见','1449843136',1,'com1449843136',3,NULL,NULL,0,1),(9411,'通州区高新技术企业认定服务机构资助资金申请表','1449843136',1,'com1449843136',0,NULL,NULL,1,1),(9412,'项目任务书','1449843942',1,'com1449843942',1,NULL,NULL,1,1),(9413,'专家名单及专家论证意见','1449843942',1,'com1449843942',1,NULL,NULL,1,1),(9414,'课题调整申请表','1449843942',1,'com1449843942',2,NULL,NULL,1,1),(9415,'项目中期报告','1449843942',1,'com1449843942',2,NULL,NULL,0,1),(9416,'项目总结报告书','1449843942',1,'com1449843942',3,NULL,NULL,0,1),(9417,'项目经费总决算表','1449843942',1,'com1449843942',3,NULL,NULL,0,1),(9418,'项目验收专家组意见','1449843942',1,'com1449843942',3,NULL,NULL,0,1),(9419,'通州区高新技术企业认定服务机构资助资金申请表','1449843942',1,'com1449843942',0,NULL,NULL,1,1),(9420,'项目任务书','1449843960',1,'com1449843960',1,NULL,NULL,1,1),(9421,'专家名单及专家论证意见','1449843960',1,'com1449843960',1,NULL,NULL,1,1),(9422,'课题调整申请表','1449843960',1,'com1449843960',2,NULL,NULL,1,1),(9423,'项目中期报告','1449843960',1,'com1449843960',2,NULL,NULL,0,1),(9424,'项目总结报告书','1449843960',1,'com1449843960',3,NULL,NULL,0,1),(9425,'项目经费总决算表','1449843960',1,'com1449843960',3,NULL,NULL,0,1),(9426,'项目验收专家组意见','1449843960',1,'com1449843960',3,NULL,NULL,0,1),(9427,'通州区高新技术企业认定服务机构资助资金申请表','1449843960',1,'com1449843960',0,NULL,NULL,1,1),(9428,'北京市通州区科技计划项目实施方案','1449844017',1,'dev1449844017',0,NULL,NULL,1,1),(9429,'通州区支持科技服务机构发展项目申报书','1449844017',1,'dev1449844017',0,NULL,NULL,1,1),(9430,'项目任务书','1449844049',1,'com1449844049',1,NULL,NULL,1,1),(9431,'专家名单及专家论证意见','1449844049',1,'com1449844049',1,NULL,NULL,1,1),(9432,'课题调整申请表','1449844049',1,'com1449844049',2,NULL,NULL,1,1),(9433,'项目中期报告','1449844049',1,'com1449844049',2,NULL,NULL,0,1),(9434,'项目总结报告书','1449844049',1,'com1449844049',3,NULL,NULL,0,1),(9435,'项目经费总决算表','1449844049',1,'com1449844049',3,NULL,NULL,0,1),(9436,'项目验收专家组意见','1449844049',1,'com1449844049',3,NULL,NULL,0,1),(9437,'通州区高新技术企业认定服务机构资助资金申请表','1449844049',1,'com1449844049',0,NULL,NULL,1,1),(9438,'北京市通州区科技计划项目实施方案','1449844059',1,'dev1449844059',0,NULL,NULL,1,1),(9439,'项目任务书','1449844073',1,'com1449844073',1,NULL,NULL,1,1),(9440,'专家名单及专家论证意见','1449844073',1,'com1449844073',1,NULL,NULL,1,1),(9441,'课题调整申请表','1449844073',1,'com1449844073',2,NULL,NULL,1,1),(9442,'项目中期报告','1449844073',1,'com1449844073',2,NULL,NULL,0,1),(9443,'项目总结报告书','1449844073',1,'com1449844073',3,NULL,NULL,0,1),(9444,'项目经费总决算表','1449844073',1,'com1449844073',3,NULL,NULL,0,1),(9445,'项目验收专家组意见','1449844073',1,'com1449844073',3,NULL,NULL,0,1),(9446,'北京市通州区科技计划项目实施方案','1449844073',1,'com1449844073',0,NULL,NULL,1,1),(9447,'通州区支持购买区内单位技术服务项目申报书','1449844073',1,'com1449844073',0,NULL,NULL,1,1),(9448,'项目任务书','1449847505',4,'dev1449846462',1,'             \r\n              \r\n       111111111','1449847995',1,1),(9449,'专家名单及专家论证意见','1449847569',4,'dev1449846462',1,'             \r\n              \r\n       33333333','1449848002',1,1),(9450,'课题调整申请表','1449848148',4,'dev1449846462',2,'             \r\n              \r\n       ','1449848244',1,1),(9451,'项目中期报告','1449848221',4,'dev1449846462',2,'             \r\n              \r\n       9999','1449848313',1,1),(9452,'项目总结报告书','1449848343',4,'dev1449846462',3,'             \r\n              \r\n       ','1449848388',1,1),(9453,'项目经费总决算表','1449848348',4,'dev1449846462',3,'             \r\n              \r\n       888','1449848694',1,1),(9454,'项目验收专家组意见','1449848374',2,'dev1449846462',3,NULL,NULL,1,1),(9455,'北京市通州区科技计划项目实施方案','1449846735',4,'dev1449846462',0,'             \r\n              \r\n       1234567890','1449847401',1,2),(9456,'项目任务书','1449849807',4,'dev1449849004',1,NULL,'1449855874',1,1),(9457,'专家名单及专家论证意见','1449855805',4,'dev1449849004',1,NULL,'1449855888',1,1),(9458,'课题调整申请表','1449849004',1,'dev1449849004',2,NULL,NULL,1,1),(9459,'项目中期报告','1449849004',1,'dev1449849004',2,NULL,NULL,1,1),(9460,'项目总结报告书','1449849004',1,'dev1449849004',3,NULL,NULL,0,1),(9461,'项目经费总决算表','1449849004',1,'dev1449849004',3,NULL,NULL,0,1),(9462,'项目验收专家组意见','1449849004',1,'dev1449849004',3,NULL,NULL,0,1),(9463,'北京市通州区科技计划项目实施方案','1449849274',4,'dev1449849004',0,'             \r\n              \r\n过了','1449849462',1,2),(9464,'北京市通州区科技计划项目实施方案','1449849541',1,'dev1449849541',0,NULL,NULL,1,1),(9465,'北京市通州区科技计划项目实施方案','1449990061',2,'dev1449975160',0,NULL,NULL,1,1),(9466,'课题调整申请表','1449985141',2,'dev1449983915',2,NULL,NULL,1,1),(9467,'项目中期报告','1449983915',1,'dev1449983915',2,NULL,NULL,0,1),(9468,'北京市通州区科技计划项目实施方案','1449990510',2,'dev1449989729',2,NULL,NULL,1,1),(9469,'北京市通州区科技计划项目实施方案','1450006400',2,'dev1449990809',0,NULL,NULL,1,1),(9470,'北京市通州区科技计划项目实施方案','1449992834',4,'dev1449991023',0,'             \r\n                    \r\n              \r\n              \r\n       ','1449992876',1,2),(9471,'北京市通州区科技计划项目实施方案','1449992800',4,'dev1449992343',0,'             \r\n              \r\n       ok','1449993004',1,2),(9472,'项目任务书','1450000439',1,'dev1450000439',1,NULL,NULL,1,1),(9473,'专家名单及专家论证意见','1450000439',1,'dev1450000439',1,NULL,NULL,1,1),(9474,'课题调整申请表','1450000439',1,'dev1450000439',2,NULL,NULL,1,1),(9475,'项目中期报告','1450000439',1,'dev1450000439',2,NULL,NULL,0,1),(9476,'项目总结报告书','1450000439',1,'dev1450000439',3,NULL,NULL,0,1),(9477,'项目经费总决算表','1450000439',1,'dev1450000439',3,NULL,NULL,0,1),(9478,'项目验收专家组意见','1450000439',1,'dev1450000439',3,NULL,NULL,0,1),(9479,'北京市通州区科技计划项目实施方案','1450002521',2,'dev1450000439',0,NULL,NULL,1,1),(9480,'通州区支持科技成果转化项目申报书','1450002524',2,'dev1450000439',0,NULL,NULL,1,1),(9481,'北京市通州区科技计划项目实施方案','1450006695',4,'dev1450006688',0,'             \r\n              \r\n       ','1450007064',1,2),(9482,'北京市通州区科技计划项目实施方案','1450006930',1,'dev1450006930',0,NULL,NULL,1,1),(9483,'北京市通州区科技计划项目实施方案','1450006932',1,'dev1450006932',0,NULL,NULL,1,1),(9484,'北京市通州区科技计划项目实施方案','1450010541',2,'dev1450006972',0,NULL,NULL,1,1),(9485,'项目任务书','1450011368',4,'dev1450007651',1,'             \r\n              \r\n       ','1450011395',1,2),(9486,'专家名单及专家论证意见','1450011038',4,'dev1450007651',1,'             \r\n                    \r\n              \r\n              \r\n       ','1450011400',1,2),(9487,'课题调整申请表','1450007651',1,'dev1450007651',2,NULL,NULL,1,2),(9488,'项目中期报告','1450007651',1,'dev1450007651',2,NULL,NULL,1,2),(9489,'项目总结报告书','1450007651',1,'dev1450007651',3,NULL,NULL,0,2),(9490,'项目经费总决算表','1450007651',1,'dev1450007651',3,NULL,NULL,0,2),(9491,'项目验收专家组意见','1450007651',1,'dev1450007651',3,NULL,NULL,0,2),(9492,'北京市通州区科技计划项目实施方案','1450007655',4,'dev1450007651',0,'             \r\n              \r\n       ','1450007769',1,2),(9493,'项目任务书','1450009975',1,'dev1450009975',1,NULL,NULL,1,1),(9494,'专家名单及专家论证意见','1450009975',1,'dev1450009975',1,NULL,NULL,1,1),(9495,'课题调整申请表','1450009975',1,'dev1450009975',2,NULL,NULL,1,1),(9496,'项目中期报告','1450009975',1,'dev1450009975',2,NULL,NULL,0,1),(9497,'项目总结报告书','1450009975',1,'dev1450009975',3,NULL,NULL,0,1),(9498,'项目经费总决算表','1450009975',1,'dev1450009975',3,NULL,NULL,0,1),(9499,'项目验收专家组意见','1450009975',1,'dev1450009975',3,NULL,NULL,0,1),(9500,'北京市通州区科技计划项目实施方案','1450009975',1,'dev1450009975',0,NULL,NULL,1,1),(9501,'项目任务书','1450010738',1,'dev1450010738',1,NULL,NULL,1,1),(9502,'专家名单及专家论证意见','1450010738',1,'dev1450010738',1,NULL,NULL,1,1),(9503,'课题调整申请表','1450010738',1,'dev1450010738',2,NULL,NULL,1,1),(9504,'项目中期报告','1450010738',1,'dev1450010738',2,NULL,NULL,0,1),(9505,'项目总结报告书','1450010738',1,'dev1450010738',3,NULL,NULL,0,1),(9506,'项目经费总决算表','1450010738',1,'dev1450010738',3,NULL,NULL,0,1),(9507,'项目验收专家组意见','1450010738',1,'dev1450010738',3,NULL,NULL,0,1),(9508,'北京市通州区科技计划项目实施方案','1450010738',1,'dev1450010738',0,NULL,NULL,1,1),(9509,'项目任务书','1450052978',1,'dev1450052978',1,NULL,NULL,1,1),(9510,'专家名单及专家论证意见','1450052978',1,'dev1450052978',1,NULL,NULL,1,1),(9511,'课题调整申请表','1450052978',1,'dev1450052978',2,NULL,NULL,1,1),(9512,'项目中期报告','1450052978',1,'dev1450052978',2,NULL,NULL,0,1),(9513,'项目总结报告书','1450052978',1,'dev1450052978',3,NULL,NULL,0,1),(9514,'项目经费总决算表','1450052978',1,'dev1450052978',3,NULL,NULL,0,1),(9515,'项目验收专家组意见','1450052978',1,'dev1450052978',3,NULL,NULL,0,1),(9516,'北京市通州区科技计划项目实施方案','1450052987',2,'dev1450052978',0,NULL,NULL,1,1),(9517,'项目任务书','1450053084',1,'dev1450053084',1,NULL,NULL,1,1),(9518,'专家名单及专家论证意见','1450053084',1,'dev1450053084',1,NULL,NULL,1,1),(9519,'课题调整申请表','1450053084',1,'dev1450053084',2,NULL,NULL,1,1),(9520,'项目中期报告','1450053084',1,'dev1450053084',2,NULL,NULL,0,1),(9521,'项目总结报告书','1450053084',1,'dev1450053084',3,NULL,NULL,0,1),(9522,'项目经费总决算表','1450053084',1,'dev1450053084',3,NULL,NULL,0,1),(9523,'项目验收专家组意见','1450053084',1,'dev1450053084',3,NULL,NULL,0,1),(9524,'北京市通州区科技计划项目实施方案','1450053088',4,'dev1450053084',0,NULL,'1450053266',1,2);

/*Table structure for table `team_form` */

DROP TABLE IF EXISTS `team_form`;

CREATE TABLE `team_form` (
  `service_num` int(11) default NULL,
  `id` int(11) default NULL,
  `project_id` varchar(30) default NULL,
  `manage_num` int(11) default NULL,
  `doctor_num` int(11) default NULL,
  `master_num` int(11) default NULL,
  `college_num` int(11) default NULL,
  `junior_num` int(11) default NULL,
  `doctor_ratio` float default NULL,
  `master_ratio` float default NULL,
  `college_ratio` float default NULL,
  `junior_ratio` float default NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `team_form` */

/*Table structure for table `tech_material` */

DROP TABLE IF EXISTS `tech_material`;

CREATE TABLE `tech_material` (
  `id` int(11) NOT NULL auto_increment,
  `project_id` varchar(50) default NULL,
  `intel_property` varchar(100) default NULL,
  `type` varchar(20) default NULL,
  `auth_code` varchar(50) default NULL,
  `others` varchar(100) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tech_material` */

insert  into `tech_material`(`id`,`project_id`,`intel_property`,`type`,`auth_code`,`others`) values (12,'dev1449727488','','','',NULL),(13,'dev1449727488','','','',NULL),(14,'dev1449727488','','','',NULL),(15,NULL,NULL,NULL,NULL,NULL),(16,'dev1449821283','好','好','好',NULL),(17,'dev1449821283','','','',NULL),(18,NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `technical_contract` */

DROP TABLE IF EXISTS `technical_contract`;

CREATE TABLE `technical_contract` (
  `id` int(11) NOT NULL auto_increment,
  `org_code` varchar(11) default NULL,
  `contract_code` varchar(11) default NULL,
  `project_name` varchar(30) default NULL,
  `affirm_time` varchar(20) default NULL,
  `contract_price` float default NULL,
  `year` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `technical_contract` */

insert  into `technical_contract`(`id`,`org_code`,`contract_code`,`project_name`,`affirm_time`,`contract_price`,`year`) values (11,'012345678','','','',0,NULL),(12,'012345678','','','',0,NULL),(13,'012345678','','','',0,NULL),(14,'012345678','','','',0,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
