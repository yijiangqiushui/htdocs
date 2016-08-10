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

/*Table structure for table `admincat` */

DROP TABLE IF EXISTS `admincat`;

CREATE TABLE `admincat` (
  `id` int(20) NOT NULL auto_increment,
  `exclusive_name` char(32) default '' COMMENT '专有名称',
  `catName` varchar(50) NOT NULL,
  `upperCat` tinytext NOT NULL,
  `upperID` int(20) default '0',
  `isForbidden` tinyint(1) default '0',
  `userPrivileges` text,
  `isLast` tinyint(1) NOT NULL default '1',
  `isDel` tinyint(1) default '0' COMMENT '0 未删除',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `admincat` */

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

insert  into `admininfo`(`id`,`department`,`user_type`,`username`,`password`,`realname`,`phone`,`email`,`qq`,`isForbidden`,`addDate`,`lastIP`,`isDel`,`ntid`,`seed`,`lastLoginTime`) values (1,-1,3,'super','013b973fe5d09a1a9360becdd3a0a511de73c05a','张三','1','22@gmail.com','11111',0,NULL,'127.0.0.1',NULL,NULL,NULL,'2016-01-18 21:33:42'),(5,0,2,'suy','013b973fe5d09a1a9360becdd3a0a511de73c05a','苏颖','13774774787','suying@qq.com','19874568785',0,NULL,'127.0.0.1',0,NULL,NULL,'2016-01-18 17:13:50'),(6,0,1,'kangly','013b973fe5d09a1a9360becdd3a0a511de73c05a','康连元','15487895624','kanglianyuan@qq.com','7458452',0,NULL,'192.168.1.20',0,NULL,NULL,'2016-01-17 15:13:40'),(7,1,2,'gengdl','013b973fe5d09a1a9360becdd3a0a511de73c05a','耿大乐','13487784521','gengdale@qq.com','8521354',0,NULL,'127.0.0.1',0,NULL,NULL,'2016-01-18 17:56:50'),(8,1,1,'guohj','013b973fe5d09a1a9360becdd3a0a511de73c05a','郭华杰','18956532549','guohuajie@qq.com','45123354',0,NULL,NULL,0,NULL,NULL,NULL),(9,2,2,'songlj','013b973fe5d09a1a9360becdd3a0a511de73c05a','宋李杰','13654897856','songlijie@qq.com','1554895645',0,NULL,NULL,0,NULL,NULL,NULL),(10,2,1,'jinz','013b973fe5d09a1a9360becdd3a0a511de73c05a','金竹','15458956532','jinzhu@qq.com','5451345455',0,NULL,NULL,0,NULL,NULL,NULL),(11,NULL,NULL,'wangzh','013b973fe5d09a1a9360becdd3a0a511de73c05a','王振海','18745895456','wangzhenghai@qq.com','45512645312',0,NULL,NULL,0,NULL,NULL,NULL),(12,0,2,'dep1','013b973fe5d09a1a9360becdd3a0a511de73c05a','李四','15114291155','5647899@qq.com','5647899',0,NULL,NULL,0,NULL,NULL,NULL),(13,0,2,'dep2','013b973fe5d09a1a9360becdd3a0a511de73c05a','那五','15662997888','5555588899@qq.com','5555588899',0,NULL,NULL,0,NULL,NULL,NULL),(14,0,2,'dep3','013b973fe5d09a1a9360becdd3a0a511de73c05a','这六','13594553835','789776789@qq.com','789776789',0,NULL,NULL,0,NULL,NULL,NULL),(15,2,1,'tianj','013b973fe5d09a1a9360becdd3a0a511de73c05a','田','2','33@gmail.com','33333',0,NULL,'127.0.0.1',0,NULL,NULL,'2016-01-17 19:14:01'),(16,3,1,'clerk','013b973fe5d09a1a9360becdd3a0a511de73c05a','科员','13689556666','89881791298@qq.com','89881791298',0,NULL,'127.0.0.1',0,NULL,NULL,'2015-12-29 16:43:49'),(17,3,2,'chief','013b973fe5d09a1a9360becdd3a0a511de73c05a','科长','15114225555','7891892@qq.com','7891892',0,NULL,'192.168.1.20',0,NULL,NULL,'2016-01-17 11:22:13');

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

insert  into `aptitude_name`(`id`,`org_code`,`project_id`,`approve_org`,`name`,`validity`,`aptitude_code`) values (1,'密码：123','','','','',''),(2,'zgf001','','','','','');

/*Table structure for table `attach_list` */

DROP TABLE IF EXISTS `attach_list`;

CREATE TABLE `attach_list` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `project_id` varchar(255) default '0',
  `file_type` varchar(45) default NULL,
  `size` varchar(45) default NULL,
  `path` varchar(255) NOT NULL,
  `introduction` tinytext COMMENT '介绍',
  `subtable_id` int(11) default NULL COMMENT '表ID',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `attach_list` */

insert  into `attach_list`(`id`,`name`,`project_id`,`file_type`,`size`,`path`,`introduction`,`subtable_id`) values (1,'EasyUi message 用法.docx','kno1453087433','docx','14.84KB','/website/html/upload/kno1453087433/EasyUi message 用法.docx',NULL,20),(2,'Form表单.docx','kno1453087433','docx','17.51KB','/website/html/upload/kno1453087433/Form表单.docx',NULL,20),(3,'iframe.docx','kno1453087433','docx','13.49KB','/website/html/upload/kno1453087433/iframe.docx',NULL,20),(4,'Jquery easy UI 上中下三栏布局.docx','kno1453087433','docx','32.19KB','/website/html/upload/kno1453087433/Jquery easy UI 上中下三栏布局.docx',NULL,20),(5,'JQuery中$.ajax()方法参数详解.docx','kno1453087433','docx','17.24KB','/website/html/upload/kno1453087433/JQuery中$.ajax()方法参数详解.docx',NULL,20),(6,'mysql 常用语句.docx','kno1453087433','docx','33.29KB','/website/html/upload/kno1453087433/mysql 常用语句.docx',NULL,20),(7,'PHP mysql 函数.docx','kno1453087433','docx','16.85KB','/website/html/upload/kno1453087433/PHP mysql 函数.docx',NULL,20),(8,'post和get区别.docx','kno1453087433','docx','16.58KB','/website/html/upload/kno1453087433/post和get区别.docx',NULL,20),(9,'window对象jpg.jpg','kno1453087433','jpg','74.32KB','/website/html/upload/kno1453087433/window对象jpg.jpg',NULL,20),(10,'高宽自适应.docx','kno1453087433','docx','17.09KB','/website/html/upload/kno1453087433/高宽自适应.docx',NULL,20),(11,'各个height比较.docx','kno1453087433','docx','34.55KB','/website/html/upload/kno1453087433/各个height比较.docx',NULL,20),(12,'问题.docx','kno1453087433','docx','12.27KB','/website/html/upload/kno1453087433/问题.docx',NULL,20),(14,'2015-12-16_084607.jpg','dev1453101198','jpg','111.69KB','/website/html/upload/dev1453101198/2015-12-16_084607.jpg','好的啊',1),(15,'2015-12-16_084628.jpg','dev1453101198','jpg','200.14KB','/website/html/upload/dev1453101198/2015-12-16_084628.jpg','非常棒啊',1),(16,'2015-12-16_084557.jpg','dev1453101198','jpg','102.86KB','/website/html/upload/dev1453101198/2015-12-16_084557.jpg','好',12),(17,'2015-12-16_084557.jpg','dev1453101198','jpg','102.86KB','/website/html/upload/dev1453101198/2015-12-16_084557.jpg',NULL,15),(18,'2015-12-16_084607.jpg','dev1453101198','jpg','111.69KB','/website/html/upload/dev1453101198/2015-12-16_084607.jpg',NULL,15),(19,'2015-12-16_084557.jpg','dev1453101198','jpg','102.86KB','/website/html/upload/dev1453101198/2015-12-16_084557.jpg','啊啊',14),(20,'2015-12-16_084607.jpg','dev1453101198','jpg','111.69KB','/website/html/upload/dev1453101198/2015-12-16_084607.jpg',NULL,14),(21,'2015-12-16_084628.jpg','dev1453101198','jpg','200.14KB','/website/html/upload/dev1453101198/2015-12-16_084628.jpg',NULL,14),(22,'2015-12-13_184718.jpg','dev1453101198','jpg','462.85KB','/website/html/upload/dev1453101198/2015-12-13_184718.jpg',NULL,18),(23,'2015-12-16_084607.jpg','dev1453101198','jpg','111.69KB','/website/html/upload/dev1453101198/2015-12-16_084607.jpg',NULL,18),(24,'表单填写页.jpg','dev1453101023','jpg','2.43MB','/website/html/upload/dev1453101023/表单填写页.jpg','',1),(25,'2015-12-13_184718.jpg','dev1453106590','jpg','462.85KB','/website/html/upload/dev1453106590/2015-12-13_184718.jpg',NULL,12),(26,'2015-12-16_084557.jpg','dev1453106590','jpg','102.86KB','/website/html/upload/dev1453106590/2015-12-16_084557.jpg',NULL,12),(27,'QQ截图20160118162517.png','dev1453101496','png','213.9KB','/website/html/upload/dev1453101496/QQ截图20160118162517.png','bug\n',14),(28,'EasyUi message 用法.docx','sci1453111441','docx','14.84KB','/website/html/upload/sci1453111441/EasyUi message 用法.docx',NULL,19),(29,'Form表单.docx','sci1453111441','docx','17.51KB','/website/html/upload/sci1453111441/Form表单.docx',NULL,19),(30,'iframe.docx','sci1453111441','docx','13.49KB','/website/html/upload/sci1453111441/iframe.docx',NULL,19),(31,'Jquery easy UI 上中下三栏布局.docx','sci1453111441','docx','32.19KB','/website/html/upload/sci1453111441/Jquery easy UI 上中下三栏布局.docx',NULL,19),(32,'JQuery中$.ajax()方法参数详解.docx','sci1453111441','docx','17.24KB','/website/html/upload/sci1453111441/JQuery中$.ajax()方法参数详解.docx',NULL,19),(33,'mysql 常用语句.docx','sci1453111441','docx','33.29KB','/website/html/upload/sci1453111441/mysql 常用语句.docx',NULL,19),(34,'PHP mysql 函数.docx','sci1453111441','docx','16.85KB','/website/html/upload/sci1453111441/PHP mysql 函数.docx',NULL,19),(35,'post和get区别.docx','sci1453111441','docx','16.58KB','/website/html/upload/sci1453111441/post和get区别.docx',NULL,19),(36,'window对象jpg.jpg','sci1453111441','jpg','74.32KB','/website/html/upload/sci1453111441/window对象jpg.jpg',NULL,19),(37,'高宽自适应.docx','sci1453111441','docx','17.09KB','/website/html/upload/sci1453111441/高宽自适应.docx',NULL,19),(38,'各个height比较.docx','sci1453111441','docx','34.55KB','/website/html/upload/sci1453111441/各个height比较.docx',NULL,19),(39,'问题.docx','sci1453111441','docx','12.27KB','/website/html/upload/sci1453111441/问题.docx',NULL,19),(41,'2015-12-13_184718.jpg','dev1453117545','jpg','462.85KB','/website/html/upload/dev1453117545/2015-12-13_184718.jpg',NULL,1),(42,'2015-12-16_084557.jpg','dev1453117545','jpg','102.86KB','/website/html/upload/dev1453117545/2015-12-16_084557.jpg',NULL,12),(44,'2015-12-16_084557.jpg','dev1453117545','jpg','102.86KB','/website/html/upload/dev1453117545/2015-12-16_084557.jpg',NULL,15),(45,'2015-12-13_184718.jpg','dev1453117545','jpg','462.85KB','/website/html/upload/dev1453117545/2015-12-13_184718.jpg',NULL,18),(46,'2015-12-16_084557.jpg','dev1453124865','jpg','102.86KB','/website/html/upload/dev1453124865/2015-12-16_084557.jpg',NULL,1);

/*Table structure for table `check_material` */

DROP TABLE IF EXISTS `check_material`;

CREATE TABLE `check_material` (
  `id` int(20) NOT NULL auto_increment,
  `project_id` varchar(30) default NULL,
  `org_suggest` text,
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
  `exe_standard` varchar(30) default NULL,
  `appraisal_date` varchar(30) default NULL,
  `host_org` varchar(255) default NULL,
  `identify_date` varchar(255) default NULL,
  `product_standard` varchar(255) default NULL,
  `quality_approve` text,
  `market_open` varchar(255) default NULL COMMENT '市场开拓 占有情况',
  `appraisal_org` varchar(30) default NULL,
  `final_opinion` text,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `check_material` */

insert  into `check_material`(`id`,`project_id`,`org_suggest`,`factory_area`,`factory_sum`,`rebuild_sum`,`rebuild_area`,`tec_num`,`tec_hour`,`manage_num`,`manage_hour`,`total_person`,`total_class`,`market_occupy`,`patent`,`patent_type`,`patent_state`,`product_name`,`product_level`,`exe_standard`,`appraisal_date`,`host_org`,`identify_date`,`product_standard`,`quality_approve`,`market_open`,`appraisal_org`,`final_opinion`) values (1,'dev1453097272','挺好的',0,0,0,0,2,2,2,2,4,4,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'44','1452096000','44','patent_project_expect','33333333333333',NULL,NULL);

/*Table structure for table `check_status` */

DROP TABLE IF EXISTS `check_status`;

CREATE TABLE `check_status` (
  `id` int(11) NOT NULL auto_increment,
  `project_id` varchar(30) default NULL,
  `ispass` int(11) default NULL,
  `pdf_url` text,
  `rate` float default NULL,
  `opinion` text,
  `check_time` varchar(50) default NULL,
  `html` text,
  `report` text,
  `array_sections` text,
  `array_paras` text,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `check_status` */

insert  into `check_status`(`id`,`project_id`,`ispass`,`pdf_url`,`rate`,`opinion`,`check_time`,`html`,`report`,`array_sections`,`array_paras`) values (1,'dev1453097272',1,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL),(2,'dev1453098333',1,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL),(3,'dev1453099069',1,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL),(4,'dev1453101023',1,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL),(5,'dev1453101198',1,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL),(6,'dev1453103161',1,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL),(7,'sci1453106574',0,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL),(8,'sci1453106749',0,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL),(9,'dev1453111213',0,NULL,0,NULL,NULL,'http://check_report.zhujian.com/down_html/2016-01-18/dev1453111213_2016-01-18_22_07_18_65.htm',NULL,NULL,NULL),(10,'sci1453111441',0,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL),(11,'sci1453111643',1,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL),(12,'sci1453111876',1,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL),(13,'kno1453111975',1,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL),(14,'dev1453113981',1,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL),(15,'dev1453114020',1,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL),(16,'dev1453117545',1,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL),(17,'kno1453119627',0,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL),(18,'dev1453119675',1,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL),(20,'dev1453122231',1,NULL,0,NULL,NULL,'http://check_report.zhujian.com/down_html/2016-01-18/dev1453122231_2016-01-18_22_07_18_51.htm',NULL,NULL,NULL),(21,'dev1453122355',1,NULL,0,NULL,NULL,'http://check_report.zhujian.com/down_html/2016-01-18/dev1453122355_2016-01-18_22_07_18_89.htm',NULL,NULL,NULL),(22,'dev1453123795',1,NULL,0,NULL,NULL,'http://check_report.zhujian.com/down_html/2016-01-18/dev1453123795_2016-01-18_22_07_18_58.htm',NULL,NULL,NULL),(23,'dev1453125144',0,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `co_construct` */

DROP TABLE IF EXISTS `co_construct`;

CREATE TABLE `co_construct` (
  `id` int(11) NOT NULL auto_increment,
  `project_id` varchar(255) default NULL,
  `partner_name` varchar(255) default NULL,
  `company_scale` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `co_construct` */

insert  into `co_construct`(`id`,`project_id`,`partner_name`,`company_scale`) values (4,'dev1453097272','1','1'),(5,'dev1453097272','2','2');

/*Table structure for table `contentinfo` */

DROP TABLE IF EXISTS `contentinfo`;

CREATE TABLE `contentinfo` (
  `id` int(11) NOT NULL auto_increment,
  `category` varchar(50) NOT NULL,
  `title` varchar(150) NOT NULL,
  `content` mediumtext NOT NULL,
  `operator` varchar(32) NOT NULL,
  `source` varchar(150) default NULL,
  `filePath` varchar(80) default NULL,
  `sortNo` int(11) NOT NULL default '0',
  `isForbidden` tinyint(1) NOT NULL default '0',
  `isRecommend` tinyint(1) NOT NULL default '0',
  `releaseTime` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `countClick` int(11) default '0',
  `briefIntro` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `contentinfo` */

/*Table structure for table `coorg_info` */

DROP TABLE IF EXISTS `coorg_info`;

CREATE TABLE `coorg_info` (
  `org_code` varchar(11) default NULL,
  `coorg_name` varchar(50) default NULL,
  `coorg_code` varchar(11) default NULL,
  `register_fund` double default NULL,
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

/*Table structure for table `equipment_list` */

DROP TABLE IF EXISTS `equipment_list`;

CREATE TABLE `equipment_list` (
  `id` int(20) NOT NULL auto_increment,
  `project_id` varchar(30) default NULL,
  `equipment_name` varchar(20) default NULL,
  `equipment_price` float(20,0) default NULL,
  `equipment_num` int(20) default NULL,
  `equipment_fund` float(20,0) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `equipment_list` */

insert  into `equipment_list`(`id`,`project_id`,`equipment_name`,`equipment_price`,`equipment_num`,`equipment_fund`) values (3,'dev1453097272','1',1,1,0),(4,'dev1453097272','2',2,2,0);

/*Table structure for table `experts` */

DROP TABLE IF EXISTS `experts`;

CREATE TABLE `experts` (
  `zj_project_id` varchar(30) default NULL,
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

insert  into `experts`(`zj_project_id`,`id`,`project_id`,`expert_name`,`expert_org`,`expert_job`,`expert_major`,`expert_phone`,`expert_sign`,`expert_divide`,`expert_id`) values ('dev1453101198',1,'','好好','千松','学生','计算机','13782654125',NULL,'0','130324199208194244'),(NULL,2,'dev1453101198','今天','千松','经理','计算机','13785641256',NULL,'1','130324569856214521'),(NULL,3,'dev1453101198','明天','千松','经理','财政','13865412563',NULL,'','130324569856214521'),('dev1453103161',4,'','11','11','12','12','18303306252',NULL,'1','130131199212302455'),('dev1453103161',5,'','22','22','130131199212302455','130131199212302455','18303306252',NULL,'1','130131199212302455'),('dev1453101496',9,'','曾轶可','湖南卫视','网吧网管','网吧网管','13931853559',NULL,'0','130181199304185715'),('dev1453101496',10,'','胡彦斌','浙江卫视','网吧小网管','网吧小网管','11111111111',NULL,'1','130181199304181111'),('dev1453106590',13,'','好好','千松','经理','计算机','13782654125',NULL,'1','130324199208194244'),(NULL,16,'dev1453101496','陈奕迅','北京千松','网管','计算机','13931852559',NULL,'0','135265325624561'),(NULL,17,'dev1453101496','李荣浩','百度','前台','计算机','13931852559',NULL,'0','135265325624562'),('dev1453112447',18,'','','','','','',NULL,'1',''),(NULL,19,'dev1453103161','','','','','',NULL,'1',''),('dev1453117545',22,'','啊','百度','经理','计算机','13786541256',NULL,'1','130324194403134545'),('dev1453117545',23,'','是','阿里','经理','计算机','15845214521',NULL,'1','130324194403134545'),(NULL,27,'dev1453117545','啊','啊','在','在','13785641254',NULL,'1','130324556565555555'),('dev1453122587',28,'','高工','灌灌灌灌灌','发的谁说的','地方地方','15145885411',NULL,'1','331155198502050024'),('dev1453122587',29,'','的撒打算','的撒打算','的谁说的','的谁说的','15145885411',NULL,'','331155198502050024');

/*Table structure for table `finish_target` */

DROP TABLE IF EXISTS `finish_target`;

CREATE TABLE `finish_target` (
  `id` int(11) NOT NULL auto_increment,
  `project_id` varchar(30) default NULL,
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
  `task_project_id` varchar(30) default NULL,
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

/*Table structure for table `genious_info` */

DROP TABLE IF EXISTS `genious_info`;

CREATE TABLE `genious_info` (
  `id` int(11) NOT NULL auto_increment,
  `project_id` varchar(30) default NULL,
  `genious_name` varchar(30) default NULL,
  `genious_sex` varchar(30) default NULL,
  `genious_birth` varchar(30) default NULL,
  `genious_nation` varchar(30) default NULL,
  `genious_party` varchar(30) default NULL,
  `genious_native` varchar(30) default NULL,
  `genious_edu` varchar(30) default NULL,
  `genious_grade` varchar(30) default NULL,
  `genious_major` varchar(30) default NULL,
  `genious_devote` varchar(30) default NULL,
  `major_post` varchar(30) default NULL,
  `administ_post` varchar(30) default NULL,
  `genious_address` varchar(30) default NULL,
  `genious_phone` varchar(30) default NULL,
  `company_name` varchar(30) default NULL,
  `regist_time` varchar(30) default NULL,
  `is_hightec_prise` varchar(30) default NULL,
  `contacts` varchar(30) default NULL,
  `contact_phone` varchar(30) default NULL,
  `email` varchar(30) default NULL,
  `corp_name` varchar(30) default NULL,
  `serving_time` varchar(30) default NULL,
  `work_force` varchar(30) default NULL,
  `college_num` varchar(30) default NULL,
  `research_num` varchar(30) default NULL,
  `job_resume` varchar(1000) default NULL,
  `work_product` text,
  `honor_title` text,
  `situation` text,
  `project_thing` text,
  `unit_opinion` text,
  `first_opinion` text,
  `review_opinion` text,
  `final_opinion` text,
  `corp_grade` varchar(20) default NULL,
  `flag` int(10) default NULL,
  `statement` text,
  `high_tech` varchar(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `genious_info` */

insert  into `genious_info`(`id`,`project_id`,`genious_name`,`genious_sex`,`genious_birth`,`genious_nation`,`genious_party`,`genious_native`,`genious_edu`,`genious_grade`,`genious_major`,`genious_devote`,`major_post`,`administ_post`,`genious_address`,`genious_phone`,`company_name`,`regist_time`,`is_hightec_prise`,`contacts`,`contact_phone`,`email`,`corp_name`,`serving_time`,`work_force`,`college_num`,`research_num`,`job_resume`,`work_product`,`honor_title`,`situation`,`project_thing`,`unit_opinion`,`first_opinion`,`review_opinion`,`final_opinion`,`corp_grade`,`flag`,`statement`,`high_tech`) values (1,'','郑艳艳','女','1989-07-01','汉','共产党','辽宁省','1','','计算机','软件','侧搜','测试','辽宁省','15124290380','北京千松科技发展有限公司','2016-01-18','','','','986412145@qq.com','','2016-01-18','5','8','4','测试','在线申报系统\r\n\r\n前言\r\n在线申报系统网址：http://b.bjqskj.com:8080/website/html/view/template/\r\n获取申报账号和密码两种方式：\r\n（1）	注册\r\n（2）	后台分配账号和密码\r\n\r\n注册\r\n输入网址，进入在线申报系统首页，点击“注册”，进行注册，用于获取登录系统的账号和密码，如图：\r\n \r\n进入注册页面，分两部分填写注册信息：用户信息、企业信息\r\n填写用户相关信息（注意：*为必填），填写完用户信息后点击“下一步”，继续填写企业信息，如图：\r\n \r\n继续填写企业相关信息（注意：*为必填），填写完成后，点击“确定”，完成注册，弹出提示窗口“注册成功，即将进行跳转”，点击弹窗中“确定”，跳回系统首页，如图：\r\n \r\n\r\n登录\r\n输入网址，进入在线申报系统首页（注册后，跳转回首页），在用户登录栏输入用户名、密码和验证码，点击“登录”，验证登录后，即可进入系统申报项目，如图：\r\n \r\n登录成功后，进入系统，默认显示“我的项目”中“进行项目”的项目列表，如图：\r\n \r\n\r\n申报项目\r\n点击“申报项目”，创建新项目。创建新项目主要分为两部分：选择项目类型、填写项目基本信息。\r\n选择项目类型：选择想要新建项目的类型，点击“正在申报”，即可进入下一步——填写项目基本信息。（注意：显示“正在申报”的项目类型才可选择，显示“申报已结束”或“申报未开始”的项目类型不能选择）\r\n \r\n填写项目基本信息：填写项目名称、选择所属领域、开始时间和结束时间，点击“保存”，即完成项目的创建，如图：\r\n \r\n创建项目成功后，自动跳转到“我的项目”中“进行项目”的项目列表，显示创建的新项目（显示项目的名称、申报起止日期、项目阶段、申报状态等信息），如下图：    \r\n \r\n申报阶段\r\n项目创建成功后，填报申报阶段文件（申报书、实施方案等）。步骤如下：\r\n（1）点击项目列表中“正在受理”，如图： \r\n \r\n（2）进入受理页面，上部显示项目基本信息、下部显示申报阶段可填写的文件。点击“填写”，即可进行实施方案填写，如图：\r\n \r\n（3）进入填写页面（以“项目实施方案为例”），左侧显示需要填写信息的标题，选择左侧标题，右侧可进行相应信息的填写。默认情况：左侧第一个标题被选中（项目承担单位基本信息），右侧可填写“项目承担单位基本信息”，如图：\r\n \r\n注意：\r\n（1）填写信息后，点击“保存”，信息才可保存。\r\n（2）点击“保存”后，如果信息填写完全，则左侧标题后面会出现小对勾（证明该标题下所有信息已全部填写），并且“保存“后，自动跳到下一标题信息，可继续进行填写。如图：\r\n \r\n（3） “上传附件“上传的是该文件中的一些图、表信息，以图片（.jpg、.png等）的形式上传。点击”“，可选择一个或多个图片\r\n\r\n立项阶段\r\n\r\n\r\n实施阶段\r\n\r\n验收阶段\r\n\r\n\r\n\r\n','在线申报系统\r\n\r\n前言\r\n在线申报系统网址：http://b.bjqskj.com:8080/website/html/view/template/\r\n获取申报账号和密码两种方式：\r\n（1）	注册\r\n（2）	后台分配账号和密码\r\n\r\n注册\r\n输入网址，进入在线申报系统首页，点击“注册”，进行注册，用于获取登录系统的账号和密码，如图：\r\n \r\n进入注册页面，分两部分填写注册信息：用户信息、企业信息\r\n填写用户相关信息（注意：*为必填），填写完用户信息后点击“下一步”，继续填写企业信息，如图：\r\n \r\n继续填写企业相关信息（注意：*为必填），填写完成后，点击“确定”，完成注册，弹出提示窗口“注册成功，即将进行跳转”，点击弹窗中“确定”，跳回系统首页，如图：\r\n \r\n\r\n登录\r\n输入网址，进入在线申报系统首页（注册后，跳转回首页），在用户登录栏输入用户名、密码和验证码，点击“登录”，验证登录后，即可进入系统申报项目，如图：\r\n \r\n登录成功后，进入系统，默认显示“我的项目”中“进行项目”的项目列表，如图：\r\n \r\n\r\n申报项目\r\n点击“申报项目”，创建新项目。创建新项目主要分为两部分：选择项目类型、填写项目基本信息。\r\n选择项目类型：选择想要新建项目的类型，点击“正在申报”，即可进入下一步——填写项目基本信息。（注意：显示“正在申报”的项目类型才可选择，显示“申报已结束”或“申报未开始”的项目类型不能选择）\r\n \r\n填写项目基本信息：填写项目名称、选择所属领域、开始时间和结束时间，点击“保存”，即完成项目的创建，如图：\r\n \r\n创建项目成功后，自动跳转到“我的项目”中“进行项目”的项目列表，显示创建的新项目（显示项目的名称、申报起止日期、项目阶段、申报状态等信息），如下图：    \r\n \r\n申报阶段\r\n项目创建成功后，填报申报阶段文件（申报书、实施方案等）。步骤如下：\r\n（1）点击项目列表中“正在受理”，如图： \r\n \r\n（2）进入受理页面，上部显示项目基本信息、下部显示申报阶段可填写的文件。点击“填写”，即可进行实施方案填写，如图：\r\n \r\n（3）进入填写页面（以“项目实施方案为例”），左侧显示需要填写信息的标题，选择左侧标题，右侧可进行相应信息的填写。默认情况：左侧第一个标题被选中（项目承担单位基本信息），右侧可填写“项目承担单位基本信息”，如图：\r\n \r\n注意：\r\n（1）填写信息后，点击“保存”，信息才可保存。\r\n（2）点击“保存”后，如果信息填写完全，则左侧标题后面会出现小对勾（证明该标题下所有信息已全部填写），并且“保存“后，自动跳到下一标题信息，可继续进行填写。如图：\r\n \r\n（3） “上传附件“上传的是该文件中的一些图、表信息，以图片（.jpg、.png等）的形式上传。点击”“，可选择一个或多个图片\r\n\r\n立项阶段\r\n\r\n\r\n实施阶段\r\n\r\n验收阶段\r\n\r\n\r\n\r\n','在线申报系统\r\n\r\n前言\r\n在线申报系统网址：http://b.bjqskj.com:8080/website/html/view/template/\r\n获取申报账号和密码两种方式：\r\n（1）	注册\r\n（2）	后台分配账号和密码\r\n\r\n注册\r\n输入网址，进入在线申报系统首页，点击“注册”，进行注册，用于获取登录系统的账号和密码，如图：\r\n \r\n进入注册页面，分两部分填写注册信息：用户信息、企业信息\r\n填写用户相关信息（注意：*为必填），填写完用户信息后点击“下一步”，继续填写企业信息，如图：\r\n \r\n继续填写企业相关信息（注意：*为必填），填写完成后，点击“确定”，完成注册，弹出提示窗口“注册成功，即将进行跳转”，点击弹窗中“确定”，跳回系统首页，如图：\r\n \r\n\r\n登录\r\n输入网址，进入在线申报系统首页（注册后，跳转回首页），在用户登录栏输入用户名、密码和验证码，点击“登录”，验证登录后，即可进入系统申报项目，如图：\r\n \r\n登录成功后，进入系统，默认显示“我的项目”中“进行项目”的项目列表，如图：\r\n \r\n\r\n申报项目\r\n点击“申报项目”，创建新项目。创建新项目主要分为两部分：选择项目类型、填写项目基本信息。\r\n选择项目类型：选择想要新建项目的类型，点击“正在申报”，即可进入下一步——填写项目基本信息。（注意：显示“正在申报”的项目类型才可选择，显示“申报已结束”或“申报未开始”的项目类型不能选择）\r\n \r\n填写项目基本信息：填写项目名称、选择所属领域、开始时间和结束时间，点击“保存”，即完成项目的创建，如图：\r\n \r\n创建项目成功后，自动跳转到“我的项目”中“进行项目”的项目列表，显示创建的新项目（显示项目的名称、申报起止日期、项目阶段、申报状态等信息），如下图：    \r\n \r\n申报阶段\r\n项目创建成功后，填报申报阶段文件（申报书、实施方案等）。步骤如下：\r\n（1）点击项目列表中“正在受理”，如图： \r\n \r\n（2）进入受理页面，上部显示项目基本信息、下部显示申报阶段可填写的文件。点击“填写”，即可进行实施方案填写，如图：\r\n \r\n（3）进入填写页面（以“项目实施方案为例”），左侧显示需要填写信息的标题，选择左侧标题，右侧可进行相应信息的填写。默认情况：左侧第一个标题被选中（项目承担单位基本信息），右侧可填写“项目承担单位基本信息”，如图：\r\n \r\n注意：\r\n（1）填写信息后，点击“保存”，信息才可保存。\r\n（2）点击“保存”后，如果信息填写完全，则左侧标题后面会出现小对勾（证明该标题下所有信息已全部填写），并且“保存“后，自动跳到下一标题信息，可继续进行填写。如图：\r\n \r\n（3） “上传附件“上传的是该文件中的一些图、表信息，以图片（.jpg、.png等）的形式上传。点击”“，可选择一个或多个图片\r\n\r\n立项阶段\r\n\r\n\r\n实施阶段\r\n\r\n验收阶段\r\n\r\n\r\n\r\n',NULL,'在线申报系统\r\n\r\n前言\r\n在线申报系统网址：http://b.bjqskj.com:8080/website/html/view/template/\r\n获取申报账号和密码两种方式：\r\n（1）	注册\r\n（2）	后台分配账号和密码\r\n\r\n注册\r\n输入网址，进入在线申报系统首页，点击“注册”，进行注册，用于获取登录系统的账号和密码，如图：\r\n \r\n进入注册页面，分两部分填写注册信息：用户信息、企业信息\r\n填写用户相关信息（注意：*为必填），填写完用户信息后点击“下一步”，继续填写企业信息，如图：\r\n \r\n继续填写企业相关信息（注意：*为必填），填写完成后，点击“确定”，完成注册，弹出提示窗口“注册成功，即将进行跳转”，点击弹窗中“确定”，跳回系统首页，如图：\r\n \r\n\r\n登录\r\n输入网址，进入在线申报系统首页（注册后，跳转回首页），在用户登录栏输入用户名、密码和验证码，点击“登录”，验证登录后，即可进入系统申报项目，如图：\r\n \r\n登录成功后，进入系统，默认显示“我的项目”中“进行项目”的项目列表，如图：\r\n \r\n\r\n申报项目\r\n点击“申报项目”，创建新项目。创建新项目主要分为两部分：选择项目类型、填写项目基本信息。\r\n选择项目类型：选择想要新建项目的类型，点击“正在申报”，即可进入下一步——填写项目基本信息。（注意：显示“正在申报”的项目类型才可选择，显示“申报已结束”或“申报未开始”的项目类型不能选择）\r\n \r\n填写项目基本信息：填写项目名称、选择所属领域、开始时间和结束时间，点击“保存”，即完成项目的创建，如图：\r\n \r\n创建项目成功后，自动跳转到“我的项目”中“进行项目”的项目列表，显示创建的新项目（显示项目的名称、申报起止日期、项目阶段、申报状态等信息），如下图：    \r\n \r\n申报阶段\r\n项目创建成功后，填报申报阶段文件（申报书、实施方案等）。步骤如下：\r\n（1）点击项目列表中“正在受理”，如图： \r\n \r\n（2）进入受理页面，上部显示项目基本信息、下部显示申报阶段可填写的文件。点击“填写”，即可进行实施方案填写，如图：\r\n \r\n（3）进入填写页面（以“项目实施方案为例”），左侧显示需要填写信息的标题，选择左侧标题，右侧可进行相应信息的填写。默认情况：左侧第一个标题被选中（项目承担单位基本信息），右侧可填写“项目承担单位基本信息”，如图：\r\n \r\n注意：\r\n（1）填写信息后，点击“保存”，信息才可保存。\r\n（2）点击“保存”后，如果信息填写完全，则左侧标题后面会出现小对勾（证明该标题下所有信息已全部填写），并且“保存“后，自动跳到下一标题信息，可继续进行填写。如图：\r\n \r\n（3） “上传附件“上传的是该文件中的一些图、表信息，以图片（.jpg、.png等）的形式上传。点击”“，可选择一个或多个图片\r\n\r\n立项阶段\r\n\r\n\r\n实施阶段\r\n\r\n验收阶段\r\n\r\n\r\n\r\n',NULL,NULL,NULL,'4',1,NULL,'否'),(2,'sci1453106749','郑艳艳','女','','','','','2','','','','','','','15124290358','北京千松科技发展有限公司','','','','','986412145@qq.com','','2016-01-19','','','','','在线申报系统\r\n\r\n前言\r\n在线申报系统网址：http://b.bjqskj.com:8080/website/html/view/template/\r\n获取申报账号和密码两种方式：\r\n（1）	注册\r\n（2）	后台分配账号和密码\r\n\r\n注册\r\n输入网址，进入在线申报系统首页，点击“注册”，进行注册，用于获取登录系统的账号和密码，如图：\r\n \r\n进入注册页面，分两部分填写注册信息：用户信息、企业信息\r\n填写用户相关信息（注意：*为必填），填写完用户信息后点击“下一步”，继续填写企业信息，如图：\r\n \r\n继续填写企业相关信息（注意：*为必填），填写完成后，点击“确定”，完成注册，弹出提示窗口“注册成功，即将进行跳转”，点击弹窗中“确定”，跳回系统首页，如图：\r\n \r\n\r\n登录\r\n输入网址，进入在线申报系统首页（注册后，跳转回首页），在用户登录栏输入用户名、密码和验证码，点击“登录”，验证登录后，即可进入系统申报项目，如图：\r\n \r\n登录成功后，进入系统，默认显示“我的项目”中“进行项目”的项目列表，如图：\r\n \r\n\r\n申报项目\r\n点击“申报项目”，创建新项目。创建新项目主要分为两部分：选择项目类型、填写项目基本信息。\r\n选择项目类型：选择想要新建项目的类型，点击“正在申报”，即可进入下一步——填写项目基本信息。（注意：显示“正在申报”的项目类型才可选择，显示“申报已结束”或“申报未开始”的项目类型不能选择）\r\n \r\n填写项目基本信息：填写项目名称、选择所属领域、开始时间和结束时间，点击“保存”，即完成项目的创建，如图：\r\n \r\n创建项目成功后，自动跳转到“我的项目”中“进行项目”的项目列表，显示创建的新项目（显示项目的名称、申报起止日期、项目阶段、申报状态等信息），如下图：    \r\n \r\n申报阶段\r\n项目创建成功后，填报申报阶段文件（申报书、实施方案等）。步骤如下：\r\n（1）点击项目列表中“正在受理”，如图： \r\n \r\n（2）进入受理页面，上部显示项目基本信息、下部显示申报阶段可填写的文件。点击“填写”，即可进行实施方案填写，如图：\r\n \r\n（3）进入填写页面（以“项目实施方案为例”），左侧显示需要填写信息的标题，选择左侧标题，右侧可进行相应信息的填写。默认情况：左侧第一个标题被选中（项目承担单位基本信息），右侧可填写“项目承担单位基本信息”，如图：\r\n \r\n注意：\r\n（1）填写信息后，点击“保存”，信息才可保存。\r\n（2）点击“保存”后，如果信息填写完全，则左侧标题后面会出现小对勾（证明该标题下所有信息已全部填写），并且“保存“后，自动跳到下一标题信息，可继续进行填写。如图：\r\n \r\n（3） “上传附件“上传的是该文件中的一些图、表信息，以图片（.jpg、.png等）的形式上传。点击”选择文件“，可选择一张或多张图片，进行上传。可编辑每张图片的说明介绍，给该图片\r\n\r\n立项阶段\r\n\r\n\r\n实施阶段\r\n\r\n验收阶段\r\n\r\n\r\n\r\n','在线申报系统\r\n\r\n前言\r\n在线申报系统网址：http://b.bjqskj.com:8080/website/html/view/template/\r\n获取申报账号和密码两种方式：\r\n（1）	注册\r\n（2）	后台分配账号和密码\r\n\r\n注册\r\n输入网址，进入在线申报系统首页，点击“注册”，进行注册，用于获取登录系统的账号和密码，如图：\r\n \r\n进入注册页面，分两部分填写注册信息：用户信息、企业信息\r\n填写用户相关信息（注意：*为必填），填写完用户信息后点击“下一步”，继续填写企业信息，如图：\r\n \r\n继续填写企业相关信息（注意：*为必填），填写完成后，点击“确定”，完成注册，弹出提示窗口“注册成功，即将进行跳转”，点击弹窗中“确定”，跳回系统首页，如图：\r\n \r\n\r\n登录\r\n输入网址，进入在线申报系统首页（注册后，跳转回首页），在用户登录栏输入用户名、密码和验证码，点击“登录”，验证登录后，即可进入系统申报项目，如图：\r\n \r\n登录成功后，进入系统，默认显示“我的项目”中“进行项目”的项目列表，如图：\r\n \r\n\r\n申报项目\r\n点击“申报项目”，创建新项目。创建新项目主要分为两部分：选择项目类型、填写项目基本信息。\r\n选择项目类型：选择想要新建项目的类型，点击“正在申报”，即可进入下一步——填写项目基本信息。（注意：显示“正在申报”的项目类型才可选择，显示“申报已结束”或“申报未开始”的项目类型不能选择）\r\n \r\n填写项目基本信息：填写项目名称、选择所属领域、开始时间和结束时间，点击“保存”，即完成项目的创建，如图：\r\n \r\n创建项目成功后，自动跳转到“我的项目”中“进行项目”的项目列表，显示创建的新项目（显示项目的名称、申报起止日期、项目阶段、申报状态等信息），如下图：    \r\n \r\n申报阶段\r\n项目创建成功后，填报申报阶段文件（申报书、实施方案等）。步骤如下：\r\n（1）点击项目列表中“正在受理”，如图： \r\n \r\n（2）进入受理页面，上部显示项目基本信息、下部显示申报阶段可填写的文件。点击“填写”，即可进行实施方案填写，如图：\r\n \r\n（3）进入填写页面（以“项目实施方案为例”），左侧显示需要填写信息的标题，选择左侧标题，右侧可进行相应信息的填写。默认情况：左侧第一个标题被选中（项目承担单位基本信息），右侧可填写“项目承担单位基本信息”，如图：\r\n \r\n注意：\r\n（1）填写信息后，点击“保存”，信息才可保存。\r\n（2）点击“保存”后，如果信息填写完全，则左侧标题后面会出现小对勾（证明该标题下所有信息已全部填写），并且“保存“后，自动跳到下一标题信息，可继续进行填写。如图：\r\n \r\n（3） “上传附件“上传的是该文件中的一些图、表信息，以图片（.jpg、.png等）的形式上传。点击”选择文件“，可选择一张或多张图片，进行上传。可编辑每张图片的说明介绍，给该图片\r\n\r\n立项阶段\r\n\r\n\r\n实施阶段\r\n\r\n验收阶段\r\n\r\n\r\n\r\n','在线申报系统\r\n\r\n前言\r\n在线申报系统网址：http://b.bjqskj.com:8080/website/html/view/template/\r\n获取申报账号和密码两种方式：\r\n（1）	注册\r\n（2）	后台分配账号和密码\r\n\r\n注册\r\n输入网址，进入在线申报系统首页，点击“注册”，进行注册，用于获取登录系统的账号和密码，如图：\r\n \r\n进入注册页面，分两部分填写注册信息：用户信息、企业信息\r\n填写用户相关信息（注意：*为必填），填写完用户信息后点击“下一步”，继续填写企业信息，如图：\r\n \r\n继续填写企业相关信息（注意：*为必填），填写完成后，点击“确定”，完成注册，弹出提示窗口“注册成功，即将进行跳转”，点击弹窗中“确定”，跳回系统首页，如图：\r\n \r\n\r\n登录\r\n输入网址，进入在线申报系统首页（注册后，跳转回首页），在用户登录栏输入用户名、密码和验证码，点击“登录”，验证登录后，即可进入系统申报项目，如图：\r\n \r\n登录成功后，进入系统，默认显示“我的项目”中“进行项目”的项目列表，如图：\r\n \r\n\r\n申报项目\r\n点击“申报项目”，创建新项目。创建新项目主要分为两部分：选择项目类型、填写项目基本信息。\r\n选择项目类型：选择想要新建项目的类型，点击“正在申报”，即可进入下一步——填写项目基本信息。（注意：显示“正在申报”的项目类型才可选择，显示“申报已结束”或“申报未开始”的项目类型不能选择）\r\n \r\n填写项目基本信息：填写项目名称、选择所属领域、开始时间和结束时间，点击“保存”，即完成项目的创建，如图：\r\n \r\n创建项目成功后，自动跳转到“我的项目”中“进行项目”的项目列表，显示创建的新项目（显示项目的名称、申报起止日期、项目阶段、申报状态等信息），如下图：    \r\n \r\n申报阶段\r\n项目创建成功后，填报申报阶段文件（申报书、实施方案等）。步骤如下：\r\n（1）点击项目列表中“正在受理”，如图： \r\n \r\n（2）进入受理页面，上部显示项目基本信息、下部显示申报阶段可填写的文件。点击“填写”，即可进行实施方案填写，如图：\r\n \r\n（3）进入填写页面（以“项目实施方案为例”），左侧显示需要填写信息的标题，选择左侧标题，右侧可进行相应信息的填写。默认情况：左侧第一个标题被选中（项目承担单位基本信息），右侧可填写“项目承担单位基本信息”，如图：\r\n \r\n注意：\r\n（1）填写信息后，点击“保存”，信息才可保存。\r\n（2）点击“保存”后，如果信息填写完全，则左侧标题后面会出现小对勾（证明该标题下所有信息已全部填写），并且“保存“后，自动跳到下一标题信息，可继续进行填写。如图：\r\n \r\n（3） “上传附件“上传的是该文件中的一些图、表信息，以图片（.jpg、.png等）的形式上传。点击”选择文件“，可选择一张或多张图片，进行上传。可编辑每张图片的说明介绍，给该图片\r\n\r\n立项阶段\r\n\r\n\r\n实施阶段\r\n\r\n验收阶段\r\n\r\n\r\n\r\n',NULL,'在线申报系统\r\n\r\n前言\r\n在线申报系统网址：http://b.bjqskj.com:8080/website/html/view/template/\r\n获取申报账号和密码两种方式：\r\n（1）	注册\r\n（2）	后台分配账号和密码\r\n\r\n注册\r\n输入网址，进入在线申报系统首页，点击“注册”，进行注册，用于获取登录系统的账号和密码，如图：\r\n \r\n进入注册页面，分两部分填写注册信息：用户信息、企业信息\r\n填写用户相关信息（注意：*为必填），填写完用户信息后点击“下一步”，继续填写企业信息，如图：\r\n \r\n继续填写企业相关信息（注意：*为必填），填写完成后，点击“确定”，完成注册，弹出提示窗口“注册成功，即将进行跳转”，点击弹窗中“确定”，跳回系统首页，如图：\r\n \r\n\r\n登录\r\n输入网址，进入在线申报系统首页（注册后，跳转回首页），在用户登录栏输入用户名、密码和验证码，点击“登录”，验证登录后，即可进入系统申报项目，如图：\r\n \r\n登录成功后，进入系统，默认显示“我的项目”中“进行项目”的项目列表，如图：\r\n \r\n\r\n申报项目\r\n点击“申报项目”，创建新项目。创建新项目主要分为两部分：选择项目类型、填写项目基本信息。\r\n选择项目类型：选择想要新建项目的类型，点击“正在申报”，即可进入下一步——填写项目基本信息。（注意：显示“正在申报”的项目类型才可选择，显示“申报已结束”或“申报未开始”的项目类型不能选择）\r\n \r\n填写项目基本信息：填写项目名称、选择所属领域、开始时间和结束时间，点击“保存”，即完成项目的创建，如图：\r\n \r\n创建项目成功后，自动跳转到“我的项目”中“进行项目”的项目列表，显示创建的新项目（显示项目的名称、申报起止日期、项目阶段、申报状态等信息），如下图：    \r\n \r\n申报阶段\r\n项目创建成功后，填报申报阶段文件（申报书、实施方案等）。步骤如下：\r\n（1）点击项目列表中“正在受理”，如图： \r\n \r\n（2）进入受理页面，上部显示项目基本信息、下部显示申报阶段可填写的文件。点击“填写”，即可进行实施方案填写，如图：\r\n \r\n（3）进入填写页面（以“项目实施方案为例”），左侧显示需要填写信息的标题，选择左侧标题，右侧可进行相应信息的填写。默认情况：左侧第一个标题被选中（项目承担单位基本信息），右侧可填写“项目承担单位基本信息”，如图：\r\n \r\n注意：\r\n（1）填写信息后，点击“保存”，信息才可保存。\r\n（2）点击“保存”后，如果信息填写完全，则左侧标题后面会出现小对勾（证明该标题下所有信息已全部填写），并且“保存“后，自动跳到下一标题信息，可继续进行填写。如图：\r\n \r\n（3） “上传附件“上传的是该文件中的一些图、表信息，以图片（.jpg、.png等）的形式上传。点击”选择文件“，可选择一张或多张图片，进行上传。可编辑每张图片的说明介绍，给该图片\r\n\r\n立项阶段\r\n\r\n\r\n实施阶段\r\n\r\n验收阶段\r\n\r\n\r\n\r\n',NULL,NULL,NULL,'1',1,NULL,'否');

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

/*Table structure for table `incubator` */

DROP TABLE IF EXISTS `incubator`;

CREATE TABLE `incubator` (
  `special` text,
  `running` text,
  `influence` text,
  `service_job` text,
  `abstract` text,
  `project_id` varchar(30) default NULL,
  `id` int(100) NOT NULL auto_increment,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `incubator` */

insert  into `incubator`(`special`,`running`,`influence`,`service_job`,`abstract`,`project_id`,`id`) values ('','简明扼要的介绍平台功能、定位、搭建方式及运行服务情况( 限600字）\r\n简明扼要的介绍平台功能、定位、搭建方式及运行服务情况( 限600字）\r\n简明扼要的介绍平台功能、定位、搭建方式及运行服务情况( 限600字）\r\n简明扼要的介绍平台功能、定位、搭建方式及运行服务情况( 限600字）\r\n简明扼要的介绍平台功能、定位、搭建方式及运行服务情况( 限600字）\r\n简明扼要的介绍平台功能、定位、搭建方式及运行服务情况( 限600字）\r\n',NULL,'支持市级以上科技企业孵化器资质认定及后期运营项目支持市级以上科技企业孵化器资质认定及后期运营项目支持市级以上科技企业孵化器资质认定及后期运营项目支持市级以上科技企业孵化器资质认定及后期运营项目支持市级以上科技企业孵化器资质认定及后期运营项目支持市级以上科技企业孵化器资质认定及后期运营项目','ok\r\n','sci1453109921',1);

/*Table structure for table `influ_event` */

DROP TABLE IF EXISTS `influ_event`;

CREATE TABLE `influ_event` (
  `id` int(11) NOT NULL auto_increment,
  `org_code` varchar(30) default NULL,
  `name` varchar(30) default NULL,
  `time` varchar(30) default NULL,
  `place` varchar(30) default NULL,
  `theme` varchar(30) default NULL,
  `effect` varchar(30) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `influ_event` */

/*Table structure for table `instrument_list` */

DROP TABLE IF EXISTS `instrument_list`;

CREATE TABLE `instrument_list` (
  `id` int(20) NOT NULL auto_increment,
  `project_id` varchar(30) default NULL,
  `test_name` varchar(20) default NULL,
  `test_num` int(20) default NULL,
  `test_fund` float(20,0) default NULL,
  `test_price` float(20,0) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `instrument_list` */

insert  into `instrument_list`(`id`,`project_id`,`test_name`,`test_num`,`test_fund`,`test_price`) values (2,'dev1453097272','1',1,0,1),(3,'dev1453097272','2',2,0,2);

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

insert  into `intellectual_property`(`id`,`org_code`,`patent_num`,`invent_patent`,`functional_patent`,`other_patent`,`patent_design`) values (1,'qskj001',7,3,NULL,NULL,NULL),(2,'机构代码',22,22,NULL,NULL,NULL),(3,'',0,0,NULL,NULL,NULL),(4,'密码：123',0,0,0,0,0),(5,'zgf001',0,0,0,0,0),(6,'6666666-y',5,5,NULL,NULL,NULL);

/*Table structure for table `last_target` */

DROP TABLE IF EXISTS `last_target`;

CREATE TABLE `last_target` (
  `id` int(11) NOT NULL auto_increment,
  `project_id` varchar(30) default NULL,
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

insert  into `last_target`(`id`,`project_id`,`employ_num`,`year_profit`,`industry_num`,`tax_sum`,`industry_add`,`foreign_tax`,`sell_sum`,`market_share`,`year`) values (1,'dev1453097272',2,2,2,2,2,2,2,2,NULL),(2,'kno1453111975',7,7.6,8,8,8,8,8,8,NULL),(3,'kno1453119627',1,11,11,11,11,11,11,11,NULL);

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

insert  into `legal_person`(`id`,`org_code`,`legal_code`,`legal_name`,`legal_sex`,`legal_edu`,`legal_birth`,`legal_time`,`legal_phone`,`legal_id`) values (1,'zgf001',NULL,'朱国锋',1,NULL,NULL,NULL,'',''),(2,'qskj001','','李明',1,'博士','2016-01-06','2016-01-22','18303306282',NULL),(3,'密码：123','','马三秒',1,NULL,NULL,NULL,'13931853559',''),(4,'',NULL,'legal_name',1,'','','','13796541256',NULL),(5,'机构代码','legal_name','legal_name',0,'中专','2016-01-01','2016-01-08','13796541256',NULL),(6,'123456','千夜','千夜',1,NULL,NULL,NULL,'15147551255',NULL),(7,'6666666-y',NULL,'杨松',1,'学士','','','15124290380',NULL),(8,'lynda',NULL,'lynda',1,NULL,NULL,NULL,'13865412563',NULL);

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
  `token` varchar(50) default NULL,
  `celphone` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `login_info` */

insert  into `login_info`(`id`,`username`,`password`,`org_code`,`isForbidden`,`lastIP`,`addDate`,`user_type`,`department`,`realname`,`address`,`phone`,`email`,`token`,`celphone`) values (1,'mc','592d510020d3eacdc3d5c89e2e148f7467de3e82','密码：123',0,NULL,NULL,0,NULL,'马闯','','83212332','ma@qq.com',NULL,'13931853559'),(2,'李明','eadb034df421eca651dd5daf60c7072fe8f48a14','qskj001',0,NULL,NULL,0,NULL,'李明','','18303306272','1151143484@qq.com',NULL,'18303305252'),(3,'zgf','592d510020d3eacdc3d5c89e2e148f7467de3e82','zgf001',0,NULL,NULL,0,NULL,'朱国锋','','010-12345678','464799127@qq.com',NULL,'15683694386'),(4,'11','ed829d3d8d9c144028b1470112c28cae081d928f','qskj001',0,NULL,NULL,0,NULL,'李明','','010-9999999','1524241@qq.com',NULL,'18303306252'),(5,'username','8390aa92784af5d915044b92032f61a41eab365b','机构代码',0,NULL,NULL,0,NULL,'contact','','010-65412365','12233511@qq.com',NULL,'13785621325'),(6,'22','044a4f4a3ef0f87a61651231743619979e8d195d','qskj001',0,NULL,NULL,0,NULL,'22','','010-8888888','22@qq.com',NULL,'18303306252'),(7,'33','79f522d3dcf14e115e6c4405e6d60fa430e11738','qskj001',0,NULL,NULL,0,NULL,'22','','010-888888','33@qq.com',NULL,'18303306252'),(8,'44','4021ba0922992279b6c34924db6e45be9d6ba331','qskj001',0,NULL,NULL,0,NULL,'33333333','','010-88888888','33@qq.com',NULL,'18303306252'),(9,'fred','592d510020d3eacdc3d5c89e2e148f7467de3e82','123456',0,NULL,NULL,0,NULL,'西蒙','','010-14552488','789934248@qq.com',NULL,'15114241114'),(10,'55','016bea14a5087dbca4142e7790e227933941727e','qskj001',0,NULL,NULL,0,NULL,'55','','010-5555555','555@qq.com',NULL,'18303306272'),(11,'zyy','592d510020d3eacdc3d5c89e2e148f7467de3e82','6666666-y',0,NULL,NULL,0,NULL,'郑艳艳','','010-66157731','986412145@qq.com',NULL,'15124290380'),(12,'66','37de990b321dfb0764b0ea56f57c9b53db568827','qskj001',0,NULL,NULL,0,NULL,'66','','010-88888888','66@qq.com',NULL,'18303306282'),(13,'lynda','a67b5f856ffb58b0fed58cc2209fd50521b4e8d9','lynda',0,NULL,NULL,0,NULL,'lynda','','010-555555','1223351187@qq.com','a985c43bb0aa4a548615d81d8094acbd','13782112452');

/*Table structure for table `main_product` */

DROP TABLE IF EXISTS `main_product`;

CREATE TABLE `main_product` (
  `id` int(11) NOT NULL auto_increment,
  `org_code` varchar(30) default NULL,
  `main_product` varchar(100) default NULL,
  `sale_ratio` float default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `main_product` */

insert  into `main_product`(`id`,`org_code`,`main_product`,`sale_ratio`) values (47,'机构代码','1',1),(48,'机构代码','1',1),(49,'机构代码','1',1),(50,'机构代码','1',1),(58,'','',0),(67,'6666666-y','测试',3.4),(68,'6666666-y','测试2',4.3),(71,'qskj001','555',555),(72,'qskj001','666',666);

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
  `project_id` varchar(30) default NULL,
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
  `start_end` varchar(30) default NULL,
  `modify_content` text,
  `modify_reason` text,
  `org_suggest` text,
  `office_suggest` text,
  `vice_suggest` tinytext,
  `director_suggest` text,
  `remark` text,
  `project_name` varchar(100) default NULL,
  `project_money` double default NULL,
  `finmoney` double default NULL,
  `othermoney` double default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `modify_apply` */

insert  into `modify_apply`(`engineer_suggest`,`id`,`project_id`,`start_end`,`modify_content`,`modify_reason`,`org_suggest`,`office_suggest`,`vice_suggest`,`director_suggest`,`remark`,`project_name`,`project_money`,`finmoney`,`othermoney`) values ('',1,'dev1453101198','2016-01-11——2016-01-24','好','好','好','','','','好','11',22,11,11),('',2,'dev1453103161','2016-01-07——2016-01-29','项目调整申请信息','项目调整申请信息','项目调整申请信息','','','','项目调整申请信息','生态环境建设专项003',22,11,11),('',3,'dev1453101496','2016-01-18——2016-01-31','12345568。。。12345568。。。12345568。。。12345568。。。12345568。。。','12345568。。。','12345568。。。','','','','无备注事项','支持创新平台建设项目_马闯test1',54545548998.9,4444.9,54545544554),('',4,'dev1453114014','2016-01-06——2016-01-28','3','3','33','','','','3','城市建设与管理专项0010',6,3,3),('',5,'dev1453117545','2016-01-08——2016-01-24','好','好','好','','','','好','111之生态环境建设专项',33445,11,33434);

/*Table structure for table `notice` */

DROP TABLE IF EXISTS `notice`;

CREATE TABLE `notice` (
  `id` int(11) NOT NULL auto_increment,
  `time` datetime default NULL,
  `title` varchar(255) default NULL,
  `content` text,
  `is_recommend` int(1) default '0',
  `type` varchar(255) default NULL,
  `author` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `notice` */

/*Table structure for table `org_info` */

DROP TABLE IF EXISTS `org_info`;

CREATE TABLE `org_info` (
  `maked_name` varchar(30) default NULL,
  `ismake` varchar(10) default NULL,
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
  `register_fund` double default NULL,
  `contact_address` varchar(50) default NULL,
  `register_address` varchar(50) default NULL,
  `linkman_email` varchar(50) default NULL,
  `org_trade` varchar(20) default NULL,
  `local_foreign` double default NULL,
  `research_content` varchar(1000) default NULL,
  `investment` varchar(500) default NULL,
  `service_type` varchar(50) default NULL,
  `website` varchar(50) default NULL,
  `asset_total` double default NULL,
  `listed` int(11) default NULL,
  `listed_code` varchar(50) default NULL,
  `main_product` varchar(50) default NULL,
  `credit_rate` varchar(10) default NULL,
  `feature` varchar(500) default NULL,
  `company_summary` varchar(1000) default NULL,
  `last_contractNum` int(11) default NULL,
  `last_contractPrice` double default NULL,
  `predict_contractNum` int(11) default NULL,
  `predict_contractPrice` double default NULL,
  `predict_servicePrice` double default NULL,
  `hatch_type` varchar(30) default NULL,
  `legal_pub_pic` varchar(255) default NULL,
  `legal_reg_pic` varchar(255) default NULL,
  `manager` varchar(20) default NULL,
  `total_money` varchar(30) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `org_info` */

insert  into `org_info`(`maked_name`,`ismake`,`id`,`org_code`,`org_name`,`relationship`,`legal_person`,`org_type`,`org_address`,`register_town`,`register_time`,`postal`,`fax`,`email`,`certi_code`,`develop_area`,`org_leader`,`leader_contact`,`dev_leader`,`dev_contact`,`finance_leader`,`finance_contact`,`linkman`,`linkman_contact`,`ratification_num`,`username`,`org_bank`,`account`,`leader_org`,`phone`,`coorg_code`,`register_fund`,`contact_address`,`register_address`,`linkman_email`,`org_trade`,`local_foreign`,`research_content`,`investment`,`service_type`,`website`,`asset_total`,`listed`,`listed_code`,`main_product`,`credit_rate`,`feature`,`company_summary`,`last_contractNum`,`last_contractPrice`,`predict_contractNum`,`predict_contractPrice`,`predict_servicePrice`,`hatch_type`,`legal_pub_pic`,`legal_reg_pic`,`manager`,`total_money`) values (NULL,NULL,1,'密码：123','三秒科技','上下级','马三秒','央企',NULL,'北京市通州区','2016-01-19','050000','0310-989899','83212332@qq.com','jsd12345678','北京市通州区玉带河东街286号','马闯','13931853559','戴维','13931853559','朱国峰','13931853559','马闯','13931853559','beats285642956323','唐思辰','工商银行','1234564526432',NULL,'83212332',NULL,0,'河北省石家庄辛集玉带河东街286号','河北省石家庄辛集玉带河东街286号','','',NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'/website/html/upload/legal/2016-01-18/d003f0b2088e062213b6e6879e167ff2.jpg','/website/html/upload/legal/2016-01-18/ddbb74b507d3d4d3ac0ffc1da56ed4dc.jpg',NULL,NULL),(NULL,NULL,2,'qskj001','邯郸大集团','子公司','李明','2',NULL,'邯郸市','2016-01-04','000000','010-88888888','121@qq.com','010kkkl','是的','李明','010-88888888','李明','010-88888888','李明','010-88888888','李明','18303306272','010kkkl','56','中行','123456',NULL,'010-8888880',NULL,5,'通讯地址001','注册地址',NULL,'02',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'5','[\"1\",\"2\",null,null,null,null]',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'/website/html/upload/legal/2016-01-18/','/website/html/upload/legal/2016-01-18/',NULL,NULL),('','是',3,'zgf001','北京千松科技发展有限公司',NULL,NULL,'','',NULL,'','','','464799127@qq.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','',NULL,NULL,NULL,NULL,NULL,'010-12345678',NULL,0,'通州区科技馆','通州区科技馆','','',NULL,'','民营企业','','',0,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'/website/html/upload/legal/2016-01-18/','/website/html/upload/legal/2016-01-18/','',NULL),(NULL,NULL,4,'机构代码','org_name','11','legal_name','11',NULL,'11','2016-01-07','101100','0000-123456','12233655@qq.com','111','111','11','13865412563','大名','13865412563','11','13865412563','contact','13785621325','111','好好的','啊啊','123544',NULL,'010-789456',NULL,222.3,'contactaddress','registeraddress',NULL,'啊啊',3.3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'22','[\"1\",null,null,null,null,null]',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'/website/html/upload/legal/2016-01-18/93c0ac32a051ec42f5d20ee0085e08b1.jpg','/website/html/upload/legal/2016-01-18/93c0ac32a051ec42f5d20ee0085e08b1.jpg',NULL,NULL),(NULL,NULL,5,'','org_name',NULL,NULL,'5',NULL,NULL,'','','','12233655@qq.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','',NULL,NULL,'中行','123456',NULL,'010-132456',NULL,0,'contactaddress','registeraddress',NULL,'',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'23','[\"1\",\"2\",null,null,null,null]',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'/website/html/upload/legal/2016-01-18/2e00537b35fc4dbc98aa1fd12df48590.jpg','/website/html/upload/legal/2016-01-18/93c0ac32a051ec42f5d20ee0085e08b1.jpg',NULL,NULL),(NULL,NULL,6,'123456','北京亿松科技有限公司','上下级','千夜','私企',NULL,'通州','2016-01-04','121255','010-1555478','1555554278@qq.com','432434wee-666','科技综合区','赵君度','15514442555','宁立欢','15114225588','苏文芳','13115222588','西蒙','15114241114','899008-9908','辉科技教育','故予以','12366563225455212',NULL,'010-14552488',NULL,NULL,'北京市通州区玉桥街道','北京市通州区玉桥街道',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'/website/html/upload/legal/2016-01-18/','/website/html/upload/legal/2016-01-18/',NULL,NULL),(NULL,NULL,7,'6666666-y','北京千松科技发展有限公司',NULL,NULL,'',NULL,NULL,'2016-01-18','101100','','986412145@qq.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','',NULL,NULL,'测试','66666',NULL,'010-60551583',NULL,5.4444,'北京市通州区玉带河东街268号','北京市通州区玉带河东街268号',NULL,'测试',5.22,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'测试','[\"1\",null,\"3\",null,null,null]',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'/website/html/upload/legal/2016-01-18/','/website/html/upload/legal/2016-01-18/',NULL,NULL),(NULL,NULL,8,'lynda','Alibaba',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'12233655@qq.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'123456',NULL,NULL,'newzealand','newzealand',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'/website/html/upload/legal/2016-01-18/','/website/html/upload/legal/2016-01-18/',NULL,NULL);

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

/*Table structure for table `patent_feasibility` */

DROP TABLE IF EXISTS `patent_feasibility`;

CREATE TABLE `patent_feasibility` (
  `project_id` varchar(30) NOT NULL,
  `id` int(11) NOT NULL auto_increment,
  `project_summary` text,
  `social_mean` text,
  `advan_risks` text,
  `plan_target` text,
  `org_info` text,
  `basic_principle` text,
  `foreign_patents` text,
  `coop_org` text,
  `patent_tort` text,
  `results_ident` text,
  `quality_stable` text,
  `domestic_market` text,
  `international_market` text,
  `financing_scheme` text,
  `invest_estimate` text,
  `thing_estimate` text,
  `invest_use_plan` text,
  `financial_analysis` text,
  `un_analy` text,
  `finan_analy` text,
  `social_results` text,
  `project_schedule` text,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `patent_feasibility` */

insert  into `patent_feasibility`(`project_id`,`id`,`project_summary`,`social_mean`,`advan_risks`,`plan_target`,`org_info`,`basic_principle`,`foreign_patents`,`coop_org`,`patent_tort`,`results_ident`,`quality_stable`,`domestic_market`,`international_market`,`financing_scheme`,`invest_estimate`,`thing_estimate`,`invest_use_plan`,`financial_analysis`,`un_analy`,`finan_analy`,`social_results`,`project_schedule`) values ('kno1453111975',1,'\r\n（1）	注册\r\n（2）	后台分配账号和密码\r\n\r\n注册\r\n输入网址，进入在线申报系统首页，点击“注册”，进行注册，用于获取登录系统的账号和密码，如图：\r\n \r\n进入注册页面，分两部分填写注册信息：用户信息、企业信息\r\n填写用户相关信息（注意：*为必填），填写完用户信息后点击“下一步”，继续填写企业信息，如图：\r\n \r\n继续填写企业相关信息（注意：*为必填），填写完成后，点击“确定”，完成注册，弹出提示窗口“注册成功，即将进行跳转”，点击弹窗中“确定”，跳回系统首页，如图：\r\n \r\n\r\n登录\r\n输入网址，进入在线申报系统首页（注册后，跳转回首页），在用户登录栏输入用户名、密码和验证码，点击“登录”，验证登录后，即可进入系统申报项目，如图：\r\n','在线申报系统\r\n\r\n前言\r\n在线申报系统网址：http://b.bjqskj.com:8080/website/html/view/template/\r\n获取申报账号和密码两种方式：\r\n（1）	注册\r\n（2）	后台分配账号和密码\r\n\r\n注册\r\n输入网址，进入在线申报系统首页，点击“注册”，进行注册，用于获取登录系统的账号和密码，如图：\r\n \r\n进入注册页面，分两部分填写注册信息：用户信息、企业信息\r\n填写用户相关信息（注意：*为必填），填写完用户信息后点击“下一步”，继续填写企业信息，如图：\r\n \r\n继续填写企业相关信息（注意：*为必填），填写完成后，点击“确定”，完成注册，弹出提示窗口“注册成功，即将进行跳转”，点击弹窗中“确定”，跳回系统首页，如图：\r\n \r\n\r\n登录\r\n输入网址，进入在线申报系统首页（注册后，跳转回首页），在用户登录栏输入用户名、密码和验证码，点击“登录”，验证登录后，即可进入系统申报项目，如图：\r\n在线申报系统\r\n\r\n前言\r\n在线申报系统网址：http://b.bjqskj.com:8080/website/html/view/template/\r\n获取申报账号和密码两种方式：\r\n（1）	注册\r\n（2）	后台分配账号和密码\r\n\r\n注册\r\n输入网址，进入在线申报系统首页，点击“注册”，进行注册，用于获取登录系统的账号和密码，如图：\r\n \r\n进入注册页面，分两部分填写注册信息：用户信息、企业信息\r\n填写用户相关信息（注意：*为必填），填写完用户信息后点击“下一步”，继续填写企业信息，如图：\r\n \r\n继续填写企业相关信息（注意：*为必填），填写完成后，点击“确定”，完成注册，弹出提示窗口“注册成功，即将进行跳转”，点击弹窗中“确定”，跳回系统首页，如图：\r\n \r\n\r\n登录\r\n输入网址，进入在线申报系统首页（注册后，跳转回首页），在用户登录栏输入用户名、密码和验证码，点击“登录”，验证登录后，即可进入系统申报项目，如图：\r\n在线申报系统\r\n\r\n前言\r\n在线申报系统网址：http://b.bjqskj.com:8080/website/html/view/template/\r\n获取申报账号和密码两种方式：\r\n（1）	注册\r\n（2）	后台分配账号和密码\r\n\r\n注册\r\n输入网址，进入在线申报系统首页，点击“注册”，进行注册，用于获取登录系统的账号和密码，如图：\r\n \r\n进入注册页面，分两部分填写注册信息：用户信息、企业信息\r\n填写用户相关信息（注意：*为必填），填写完用户信息后点击“下一步”，继续填写企业信息，如图：\r\n \r\n继续填写企业相关信息（注意：*为必填），填写完成后，点击“确定”，完成注册，弹出提示窗口“注册成功，即将进行跳转”，点击弹窗中“确定”，跳回系统首页，如图：\r\n \r\n\r\n登录\r\n输入网址，进入在线申报系统首页（注册后，跳转回首页），在用户登录栏输入用户名、密码和验证码，点击“登录”，验证登录后，即可进入系统申报项目，如图：\r\n','在线申报系统\r\n\r\n前言\r\n在线申报系统网址：http://b.bjqskj.com:8080/website/html/view/template/\r\n获取申报账号和密码两种方式：\r\n（1）	注册\r\n（2）	后台分配账号和密码\r\n\r\n注册\r\n输入网址，进入在线申报系统首页，点击“注册”，进行注册，用于获取登录系统的账号和密码，如图：\r\n \r\n进入注册页面，分两部分填写注册信息：用户信息、企业信息\r\n填写用户相关信息（注意：*为必填），填写完用户信息后点击“下一步”，继续填写企业信息，如图：\r\n \r\n继续填写企业相关信息（注意：*为必填），填写完成后，点击“确定”，完成注册，弹出提示窗口“注册成功，即将进行跳转”，点击弹窗中“确定”，跳回系统首页，如图：\r\n \r\n\r\n登录\r\n输入网址，进入在线申报系统首页（注册后，跳转回首页），在用户登录栏输入用户名、密码和验证码，点击“登录”，验证登录后，即可进入系统申报项目，如图：\r\n在线申报系统\r\n\r\n前言\r\n在线申报系统网址：http://b.bjqskj.com:8080/website/html/view/template/\r\n获取申报账号和密码两种方式：\r\n（1）	注册\r\n（2）	后台分配账号和密码\r\n\r\n注册\r\n输入网址，进入在线申报系统首页，点击“注册”，进行注册，用于获取登录系统的账号和密码，如图：\r\n \r\n进入注册页面，分两部分填写注册信息：用户信息、企业信息\r\n填写用户相关信息（注意：*为必填），填写完用户信息后点击“下一步”，继续填写企业信息，如图：\r\n \r\n继续填写企业相关信息（注意：*为必填），填写完成后，点击“确定”，完成注册，弹出提示窗口“注册成功，即将进行跳转”，点击弹窗中“确定”，跳回系统首页，如图：\r\n \r\n\r\n登录\r\n输入网址，进入在线申报系统首页（注册后，跳转回首页），在用户登录栏输入用户名、密码和验证码，点击“登录”，验证登录后，即可进入系统申报项目，如图：\r\n在线申报系统\r\n\r\n前言\r\n在线申报系统网址：http://b.bjqskj.com:8080/website/html/view/template/\r\n获取申报账号和密码两种方式：\r\n（1）	注册\r\n（2）	后台分配账号和密码\r\n\r\n注册\r\n输入网址，进入在线申报系统首页，点击“注册”，进行注册，用于获取登录系统的账号和密码，如图：\r\n \r\n进入注册页面，分两部分填写注册信息：用户信息、企业信息\r\n填写用户相关信息（注意：*为必填），填写完用户信息后点击“下一步”，继续填写企业信息，如图：\r\n \r\n继续填写企业相关信息（注意：*为必填），填写完成后，点击“确定”，完成注册，弹出提示窗口“注册成功，即将进行跳转”，点击弹窗中“确定”，跳回系统首页，如图：\r\n \r\n\r\n登录\r\n输入网址，进入在线申报系统首页（注册后，跳转回首页），在用户登录栏输入用户名、密码和验证码，点击“登录”，验证登录后，即可进入系统申报项目，如图：\r\n','在线申报系统\r\n\r\n前言\r\n在线申报系统网址：http://b.bjqskj.com:8080/website/html/view/template/\r\n获取申报账号和密码两种方式：\r\n（1）	注册\r\n（2）	后台分配账号和密码\r\n\r\n注册\r\n输入网址，进入在线申报系统首页，点击“注册”，进行注册，用于获取登录系统的账号和密码，如图：\r\n \r\n进入注册页面，分两部分填写注册信息：用户信息、企业信息\r\n填写用户相关信息（注意：*为必填），填写完用户信息后点击“下一步”，继续填写企业信息，如图：\r\n \r\n继续填写企业相关信息（注意：*为必填），填写完成后，点击“确定”，完成注册，弹出提示窗口“注册成功，即将进行跳转”，点击弹窗中“确定”，跳回系统首页，如图：\r\n \r\n\r\n登录\r\n输入网址，进入在线申报系统首页（注册后，跳转回首页），在用户登录栏输入用户名、密码和验证码，点击“登录”，验证登录后，即可进入系统申报项目，如图：\r\n在线申报系统\r\n\r\n前言\r\n在线申报系统网址：http://b.bjqskj.com:8080/website/html/view/template/\r\n获取申报账号和密码两种方式：\r\n（1）	注册\r\n（2）	后台分配账号和密码\r\n\r\n注册\r\n输入网址，进入在线申报系统首页，点击“注册”，进行注册，用于获取登录系统的账号和密码，如图：\r\n \r\n进入注册页面，分两部分填写注册信息：用户信息、企业信息\r\n填写用户相关信息（注意：*为必填），填写完用户信息后点击“下一步”，继续填写企业信息，如图：\r\n \r\n继续填写企业相关信息（注意：*为必填），填写完成后，点击“确定”，完成注册，弹出提示窗口“注册成功，即将进行跳转”，点击弹窗中“确定”，跳回系统首页，如图：\r\n \r\n\r\n登录\r\n输入网址，进入在线申报系统首页（注册后，跳转回首页），在用户登录栏输入用户名、密码和验证码，点击“登录”，验证登录后，即可进入系统申报项目，如图：\r\n在线申报系统\r\n\r\n前言\r\n在线申报系统网址：http://b.bjqskj.com:8080/website/html/view/template/\r\n获取申报账号和密码两种方式：\r\n（1）	注册\r\n（2）	后台分配账号和密码\r\n\r\n注册\r\n输入网址，进入在线申报系统首页，点击“注册”，进行注册，用于获取登录系统的账号和密码，如图：\r\n \r\n进入注册页面，分两部分填写注册信息：用户信息、企业信息\r\n填写用户相关信息（注意：*为必填），填写完用户信息后点击“下一步”，继续填写企业信息，如图：\r\n \r\n继续填写企业相关信息（注意：*为必填），填写完成后，点击“确定”，完成注册，弹出提示窗口“注册成功，即将进行跳转”，点击弹窗中“确定”，跳回系统首页，如图：\r\n \r\n\r\n登录\r\n输入网址，进入在线申报系统首页（注册后，跳转回首页），在用户登录栏输入用户名、密码和验证码，点击“登录”，验证登录后，即可进入系统申报项目，如图：\r\n','在线申报系统\r\n\r\n前言\r\n在线申报系统网址：http://b.bjqskj.com:8080/website/html/view/template/\r\n获取申报账号和密码两种方式：\r\n（1）	注册\r\n（2）	后台分配账号和密码\r\n\r\n注册\r\n输入网址，进入在线申报系统首页，点击“注册”，进行注册，用于获取登录系统的账号和密码，如图：\r\n \r\n进入注册页面，分两部分填写注册信息：用户信息、企业信息\r\n填写用户相关信息（注意：*为必填），填写完用户信息后点击“下一步”，继续填写企业信息，如图：\r\n \r\n继续填写企业相关信息（注意：*为必填），填写完成后，点击“确定”，完成注册，弹出提示窗口“注册成功，即将进行跳转”，点击弹窗中“确定”，跳回系统首页，如图：\r\n \r\n\r\n登录\r\n输入网址，进入在线申报系统首页（注册后，跳转回首页），在用户登录栏输入用户名、密码和验证码，点击“登录”，验证登录后，即可进入系统申报项目，如图：\r\n在线申报系统\r\n\r\n前言\r\n在线申报系统网址：http://b.bjqskj.com:8080/website/html/view/template/\r\n获取申报账号和密码两种方式：\r\n（1）	注册\r\n（2）	后台分配账号和密码\r\n\r\n注册\r\n输入网址，进入在线申报系统首页，点击“注册”，进行注册，用于获取登录系统的账号和密码，如图：\r\n \r\n进入注册页面，分两部分填写注册信息：用户信息、企业信息\r\n填写用户相关信息（注意：*为必填），填写完用户信息后点击“下一步”，继续填写企业信息，如图：\r\n \r\n继续填写企业相关信息（注意：*为必填），填写完成后，点击“确定”，完成注册，弹出提示窗口“注册成功，即将进行跳转”，点击弹窗中“确定”，跳回系统首页，如图：\r\n \r\n\r\n登录\r\n输入网址，进入在线申报系统首页（注册后，跳转回首页），在用户登录栏输入用户名、密码和验证码，点击“登录”，验证登录后，即可进入系统申报项目，如图：\r\n\r\n','在线申报系统\r\n\r\n前言\r\n在线申报系统网址：http://b.bjqskj.com:8080/website/html/view/template/\r\n获取申报账号和密码两种方式：\r\n（1）	注册\r\n（2）	后台分配账号和密码\r\n\r\n注册\r\n输入网址，进入在线申报系统首页，点击“注册”，进行注册，用于获取登录系统的账号和密码，如图：\r\n \r\n进入注册页面，分两部分填写注册信息：用户信息、企业信息\r\n填写用户相关信息（注意：*为必填），填写完用户信息后点击“下一步”，继续填写企业信息，如图：\r\n \r\n继续填写企业相关信息（注意：*为必填），填写完成后，点击“确定”，完成注册，弹出提示窗口“注册成功，即将进行跳转”，点击弹窗中“确定”，跳回系统首页，如图：\r\n \r\n\r\n登录\r\n输入网址，进入在线申报系统首页（注册后，跳转回首页），在用户登录栏输入用户名、密码和验证码，点击“登录”，验证登录后，即可进入系统申报项目，如图：\r\n','在线申报系统\r\n\r\n前言\r\n在线申报系统网址：http://b.bjqskj.com:8080/website/html/view/template/\r\n获取申报账号和密码两种方式：\r\n（1）	注册\r\n（2）	后台分配账号和密码\r\n\r\n注册\r\n输入网址，进入在线申报系统首页，点击“注册”，进行注册，用于获取登录系统的账号和密码，如图：\r\n \r\n进入注册页面，分两部分填写注册信息：用户信息、企业信息\r\n填写用户相关信息（注意：*为必填），填写完用户信息后点击“下一步”，继续填写企业信息，如图：\r\n \r\n继续填写企业相关信息（注意：*为必填），填写完成后，点击“确定”，完成注册，弹出提示窗口“注册成功，即将进行跳转”，点击弹窗中“确定”，跳回系统首页，如图：\r\n \r\n\r\n登录\r\n输入网址，进入在线申报系统首页（注册后，跳转回首页），在用户登录栏输入用户名、密码和验证码，点击“登录”，验证登录后，即可进入系统申报项目，如图：\r\n','在线申报系统\r\n\r\n前言\r\n在线申报系统网址：http://b.bjqskj.com:8080/website/html/view/template/\r\n获取申报账号和密码两种方式：\r\n（1）	注册\r\n（2）	后台分配账号和密码\r\n\r\n注册\r\n输入网址，进入在线申报系统首页，点击“注册”，进行注册，用于获取登录系统的账号和密码，如图：\r\n \r\n进入注册页面，分两部分填写注册信息：用户信息、企业信息\r\n填写用户相关信息（注意：*为必填），填写完用户信息后点击“下一步”，继续填写企业信息，如图：\r\n \r\n继续填写企业相关信息（注意：*为必填），填写完成后，点击“确定”，完成注册，弹出提示窗口“注册成功，即将进行跳转”，点击弹窗中“确定”，跳回系统首页，如图：\r\n \r\n\r\n登录\r\n输入网址，进入在线申报系统首页（注册后，跳转回首页），在用户登录栏输入用户名、密码和验证码，点击“登录”，验证登录后，即可进入系统申报项目，如图：\r\n','在线申报系统\r\n\r\n前言\r\n在线申报系统网址：http://b.bjqskj.com:8080/website/html/view/template/\r\n获取申报账号和密码两种方式：\r\n（1）	注册\r\n（2）	后台分配账号和密码\r\n\r\n注册\r\n输入网址，进入在线申报系统首页，点击“注册”，进行注册，用于获取登录系统的账号和密码，如图：\r\n \r\n进入注册页面，分两部分填写注册信息：用户信息、企业信息\r\n填写用户相关信息（注意：*为必填），填写完用户信息后点击“下一步”，继续填写企业信息，如图：\r\n \r\n继续填写企业相关信息（注意：*为必填），填写完成后，点击“确定”，完成注册，弹出提示窗口“注册成功，即将进行跳转”，点击弹窗中“确定”，跳回系统首页，如图：\r\n \r\n\r\n登录\r\n输入网址，进入在线申报系统首页（注册后，跳转回首页），在用户登录栏输入用户名、密码和验证码，点击“登录”，验证登录后，即可进入系统申报项目，如图：\r\n','在线申报系统\r\n\r\n前言\r\n在线申报系统网址：http://b.bjqskj.com:8080/website/html/view/template/\r\n获取申报账号和密码两种方式：\r\n（1）	注册\r\n（2）	后台分配账号和密码\r\n\r\n注册\r\n输入网址，进入在线申报系统首页，点击“注册”，进行注册，用于获取登录系统的账号和密码，如图：\r\n \r\n进入注册页面，分两部分填写注册信息：用户信息、企业信息\r\n填写用户相关信息（注意：*为必填），填写完用户信息后点击“下一步”，继续填写企业信息，如图：\r\n \r\n继续填写企业相关信息（注意：*为必填），填写完成后，点击“确定”，完成注册，弹出提示窗口“注册成功，即将进行跳转”，点击弹窗中“确定”，跳回系统首页，如图：\r\n \r\n\r\n登录\r\n输入网址，进入在线申报系统首页（注册后，跳转回首页），在用户登录栏输入用户名、密码和验证码，点击“登录”，验证登录后，即可进入系统申报项目，如图：\r\n','在线申报系统\r\n\r\n前言\r\n在线申报系统网址：http://b.bjqskj.com:8080/website/html/view/template/\r\n获取申报账号和密码两种方式：\r\n（1）	注册\r\n（2）	后台分配账号和密码\r\n\r\n注册\r\n输入网址，进入在线申报系统首页，点击“注册”，进行注册，用于获取登录系统的账号和密码，如图：\r\n \r\n进入注册页面，分两部分填写注册信息：用户信息、企业信息\r\n填写用户相关信息（注意：*为必填），填写完用户信息后点击“下一步”，继续填写企业信息，如图：\r\n \r\n继续填写企业相关信息（注意：*为必填），填写完成后，点击“确定”，完成注册，弹出提示窗口“注册成功，即将进行跳转”，点击弹窗中“确定”，跳回系统首页，如图：\r\n \r\n\r\n登录\r\n输入网址，进入在线申报系统首页（注册后，跳转回首页），在用户登录栏输入用户名、密码和验证码，点击“登录”，验证登录后，即可进入系统申报项目，如图：\r\n在线申报系统\r\n\r\n前言\r\n在线申报系统网址：http://b.bjqskj.com:8080/website/html/view/template/\r\n获取申报账号和密码两种方式：\r\n（1）	注册\r\n（2）	后台分配账号和密码\r\n\r\n注册\r\n输入网址，进入在线申报系统首页，点击“注册”，进行注册，用于获取登录系统的账号和密码，如图：\r\n \r\n进入注册页面，分两部分填写注册信息：用户信息、企业信息\r\n填写用户相关信息（注意：*为必填），填写完用户信息后点击“下一步”，继续填写企业信息，如图：\r\n \r\n继续填写企业相关信息（注意：*为必填），填写完成后，点击“确定”，完成注册，弹出提示窗口“注册成功，即将进行跳转”，点击弹窗中“确定”，跳回系统首页，如图：\r\n \r\n\r\n登录\r\n输入网址，进入在线申报系统首页（注册后，跳转回首页），在用户登录栏输入用户名、密码和验证码，点击“登录”，验证登录后，即可进入系统申报项目，如图：\r\n','在线申报系统\r\n\r\n前言\r\n在线申报系统网址：http://b.bjqskj.com:8080/website/html/view/template/\r\n获取申报账号和密码两种方式：\r\n（1）	注册\r\n（2）	后台分配账号和密码\r\n\r\n注册\r\n输入网址，进入在线申报系统首页，点击“注册”，进行注册，用于获取登录系统的账号和密码，如图：\r\n \r\n进入注册页面，分两部分填写注册信息：用户信息、企业信息\r\n填写用户相关信息（注意：*为必填），填写完用户信息后点击“下一步”，继续填写企业信息，如图：\r\n \r\n继续填写企业相关信息（注意：*为必填），填写完成后，点击“确定”，完成注册，弹出提示窗口“注册成功，即将进行跳转”，点击弹窗中“确定”，跳回系统首页，如图：\r\n \r\n\r\n登录\r\n输入网址，进入在线申报系统首页（注册后，跳转回首页），在用户登录栏输入用户名、密码和验证码，点击“登录”，验证登录后，即可进入系统申报项目，如图：\r\n在线申报系统\r\n\r\n前言\r\n在线申报系统网址：http://b.bjqskj.com:8080/website/html/view/template/\r\n获取申报账号和密码两种方式：\r\n（1）	注册\r\n（2）	后台分配账号和密码\r\n\r\n注册\r\n输入网址，进入在线申报系统首页，点击“注册”，进行注册，用于获取登录系统的账号和密码，如图：\r\n \r\n进入注册页面，分两部分填写注册信息：用户信息、企业信息\r\n填写用户相关信息（注意：*为必填），填写完用户信息后点击“下一步”，继续填写企业信息，如图：\r\n \r\n继续填写企业相关信息（注意：*为必填），填写完成后，点击“确定”，完成注册，弹出提示窗口“注册成功，即将进行跳转”，点击弹窗中“确定”，跳回系统首页，如图：\r\n \r\n\r\n登录\r\n输入网址，进入在线申报系统首页（注册后，跳转回首页），在用户登录栏输入用户名、密码和验证码，点击“登录”，验证登录后，即可进入系统申报项目，如图：\r\n在线申报系统\r\n\r\n前言\r\n在线申报系统网址：http://b.bjqskj.com:8080/website/html/view/template/\r\n获取申报账号和密码两种方式：\r\n（1）	注册\r\n（2）	后台分配账号和密码\r\n\r\n注册\r\n输入网址，进入在线申报系统首页，点击“注册”，进行注册，用于获取登录系统的账号和密码，如图：\r\n \r\n进入注册页面，分两部分填写注册信息：用户信息、企业信息\r\n填写用户相关信息（注意：*为必填），填写完用户信息后点击“下一步”，继续填写企业信息，如图：\r\n \r\n继续填写企业相关信息（注意：*为必填），填写完成后，点击“确定”，完成注册，弹出提示窗口“注册成功，即将进行跳转”，点击弹窗中“确定”，跳回系统首页，如图：\r\n \r\n\r\n登录\r\n输入网址，进入在线申报系统首页（注册后，跳转回首页），在用户登录栏输入用户名、密码和验证码，点击“登录”，验证登录后，即可进入系统申报项目，如图：\r\n','在线申报系统\r\n\r\n前言\r\n在线申报系统网址：http://b.bjqskj.com:8080/website/html/view/template/\r\n获取申报账号和密码两种方式：\r\n（1）	注册\r\n（2）	后台分配账号和密码\r\n\r\n注册\r\n输入网址，进入在线申报系统首页，点击“注册”，进行注册，用于获取登录系统的账号和密码，如图：\r\n \r\n进入注册页面，分两部分填写注册信息：用户信息、企业信息\r\n填写用户相关信息（注意：*为必填），填写完用户信息后点击“下一步”，继续填写企业信息，如图：\r\n \r\n继续填写企业相关信息（注意：*为必填），填写完成后，点击“确定”，完成注册，弹出提示窗口“注册成功，即将进行跳转”，点击弹窗中“确定”，跳回系统首页，如图：\r\n \r\n\r\n登录\r\n输入网址，进入在线申报系统首页（注册后，跳转回首页），在用户登录栏输入用户名、密码和验证码，点击“登录”，验证登录后，即可进入系统申报项目，如图：\r\n在线申报系统\r\n\r\n前言\r\n在线申报系统网址：http://b.bjqskj.com:8080/website/html/view/template/\r\n获取申报账号和密码两种方式：\r\n（1）	注册\r\n（2）	后台分配账号和密码\r\n\r\n注册\r\n输入网址，进入在线申报系统首页，点击“注册”，进行注册，用于获取登录系统的账号和密码，如图：\r\n \r\n进入注册页面，分两部分填写注册信息：用户信息、企业信息\r\n填写用户相关信息（注意：*为必填），填写完用户信息后点击“下一步”，继续填写企业信息，如图：\r\n \r\n继续填写企业相关信息（注意：*为必填），填写完成后，点击“确定”，完成注册，弹出提示窗口“注册成功，即将进行跳转”，点击弹窗中“确定”，跳回系统首页，如图：\r\n \r\n\r\n登录\r\n输入网址，进入在线申报系统首页（注册后，跳转回首页），在用户登录栏输入用户名、密码和验证码，点击“登录”，验证登录后，即可进入系统申报项目，如图：\r\n在线申报系统\r\n\r\n前言\r\n在线申报系统网址：http://b.bjqskj.com:8080/website/html/view/template/\r\n获取申报账号和密码两种方式：\r\n（1）	注册\r\n（2）	后台分配账号和密码\r\n\r\n注册\r\n输入网址，进入在线申报系统首页，点击“注册”，进行注册，用于获取登录系统的账号和密码，如图：\r\n \r\n进入注册页面，分两部分填写注册信息：用户信息、企业信息\r\n填写用户相关信息（注意：*为必填），填写完用户信息后点击“下一步”，继续填写企业信息，如图：\r\n \r\n继续填写企业相关信息（注意：*为必填），填写完成后，点击“确定”，完成注册，弹出提示窗口“注册成功，即将进行跳转”，点击弹窗中“确定”，跳回系统首页，如图：\r\n \r\n\r\n登录\r\n输入网址，进入在线申报系统首页（注册后，跳转回首页），在用户登录栏输入用户名、密码和验证码，点击“登录”，验证登录后，即可进入系统申报项目，如图：\r\n','在线申报系统\r\n\r\n前言\r\n在线申报系统网址：http://b.bjqskj.com:8080/website/html/view/template/\r\n获取申报账号和密码两种方式：\r\n（1）	注册\r\n（2）	后台分配账号和密码\r\n\r\n注册\r\n输入网址，进入在线申报系统首页，点击“注册”，进行注册，用于获取登录系统的账号和密码，如图：\r\n \r\n进入注册页面，分两部分填写注册信息：用户信息、企业信息\r\n填写用户相关信息（注意：*为必填），填写完用户信息后点击“下一步”，继续填写企业信息，如图：\r\n \r\n继续填写企业相关信息（注意：*为必填），填写完成后，点击“确定”，完成注册，弹出提示窗口“注册成功，即将进行跳转”，点击弹窗中“确定”，跳回系统首页，如图：\r\n \r\n\r\n登录\r\n输入网址，进入在线申报系统首页（注册后，跳转回首页），在用户登录栏输入用户名、密码和验证码，点击“登录”，验证登录后，即可进入系统申报项目，如图：\r\n在线申报系统\r\n\r\n前言\r\n在线申报系统网址：http://b.bjqskj.com:8080/website/html/view/template/\r\n获取申报账号和密码两种方式：\r\n（1）	注册\r\n（2）	后台分配账号和密码\r\n\r\n注册\r\n输入网址，进入在线申报系统首页，点击“注册”，进行注册，用于获取登录系统的账号和密码，如图：\r\n \r\n进入注册页面，分两部分填写注册信息：用户信息、企业信息\r\n填写用户相关信息（注意：*为必填），填写完用户信息后点击“下一步”，继续填写企业信息，如图：\r\n \r\n继续填写企业相关信息（注意：*为必填），填写完成后，点击“确定”，完成注册，弹出提示窗口“注册成功，即将进行跳转”，点击弹窗中“确定”，跳回系统首页，如图：\r\n \r\n\r\n登录\r\n输入网址，进入在线申报系统首页（注册后，跳转回首页），在用户登录栏输入用户名、密码和验证码，点击“登录”，验证登录后，即可进入系统申报项目，如图：\r\n','在线申报系统\r\n\r\n前言\r\n在线申报系统网址：http://b.bjqskj.com:8080/website/html/view/template/\r\n获取申报账号和密码两种方式：\r\n（1）	注册\r\n（2）	后台分配账号和密码\r\n\r\n注册\r\n输入网址，进入在线申报系统首页，点击“注册”，进行注册，用于获取登录系统的账号和密码，如图：\r\n \r\n进入注册页面，分两部分填写注册信息：用户信息、企业信息\r\n填写用户相关信息（注意：*为必填），填写完用户信息后点击“下一步”，继续填写企业信息，如图：\r\n \r\n继续填写企业相关信息（注意：*为必填），填写完成后，点击“确定”，完成注册，弹出提示窗口“注册成功，即将进行跳转”，点击弹窗中“确定”，跳回系统首页，如图：\r\n \r\n\r\n登录\r\n输入网址，进入在线申报系统首页（注册后，跳转回首页），在用户登录栏输入用户名、密码和验证码，点击“登录”，验证登录后，即可进入系统申报项目，如图：\r\n在线申报系统\r\n\r\n前言\r\n在线申报系统网址：http://b.bjqskj.com:8080/website/html/view/template/\r\n获取申报账号和密码两种方式：\r\n（1）	注册\r\n（2）	后台分配账号和密码\r\n\r\n注册\r\n输入网址，进入在线申报系统首页，点击“注册”，进行注册，用于获取登录系统的账号和密码，如图：\r\n \r\n进入注册页面，分两部分填写注册信息：用户信息、企业信息\r\n填写用户相关信息（注意：*为必填），填写完用户信息后点击“下一步”，继续填写企业信息，如图：\r\n \r\n继续填写企业相关信息（注意：*为必填），填写完成后，点击“确定”，完成注册，弹出提示窗口“注册成功，即将进行跳转”，点击弹窗中“确定”，跳回系统首页，如图：\r\n \r\n\r\n登录\r\n输入网址，进入在线申报系统首页（注册后，跳转回首页），在用户登录栏输入用户名、密码和验证码，点击“登录”，验证登录后，即可进入系统申报项目，如图：\r\n','在线申报系统\r\n\r\n前言\r\n在线申报系统网址：http://b.bjqskj.com:8080/website/html/view/template/\r\n获取申报账号和密码两种方式：\r\n（1）	注册\r\n（2）	后台分配账号和密码\r\n\r\n注册\r\n输入网址，进入在线申报系统首页，点击“注册”，进行注册，用于获取登录系统的账号和密码，如图：\r\n \r\n进入注册页面，分两部分填写注册信息：用户信息、企业信息\r\n填写用户相关信息（注意：*为必填），填写完用户信息后点击“下一步”，继续填写企业信息，如图：\r\n \r\n继续填写企业相关信息（注意：*为必填），填写完成后，点击“确定”，完成注册，弹出提示窗口“注册成功，即将进行跳转”，点击弹窗中“确定”，跳回系统首页，如图：\r\n \r\n\r\n登录\r\n输入网址，进入在线申报系统首页（注册后，跳转回首页），在用户登录栏输入用户名、密码和验证码，点击“登录”，验证登录后，即可进入系统申报项目，如图：\r\n在线申报系统\r\n\r\n前言\r\n在线申报系统网址：http://b.bjqskj.com:8080/website/html/view/template/\r\n获取申报账号和密码两种方式：\r\n（1）	注册\r\n（2）	后台分配账号和密码\r\n\r\n注册\r\n输入网址，进入在线申报系统首页，点击“注册”，进行注册，用于获取登录系统的账号和密码，如图：\r\n \r\n进入注册页面，分两部分填写注册信息：用户信息、企业信息\r\n填写用户相关信息（注意：*为必填），填写完用户信息后点击“下一步”，继续填写企业信息，如图：\r\n \r\n继续填写企业相关信息（注意：*为必填），填写完成后，点击“确定”，完成注册，弹出提示窗口“注册成功，即将进行跳转”，点击弹窗中“确定”，跳回系统首页，如图：\r\n \r\n\r\n登录\r\n输入网址，进入在线申报系统首页（注册后，跳转回首页），在用户登录栏输入用户名、密码和验证码，点击“登录”，验证登录后，即可进入系统申报项目，如图：\r\n','在线申报系统\r\n\r\n前言\r\n在线申报系统网址：http://b.bjqskj.com:8080/website/html/view/template/\r\n获取申报账号和密码两种方式：\r\n（1）	注册\r\n（2）	后台分配账号和密码\r\n\r\n注册\r\n输入网址，进入在线申报系统首页，点击“注册”，进行注册，用于获取登录系统的账号和密码，如图：\r\n \r\n进入注册页面，分两部分填写注册信息：用户信息、企业信息\r\n填写用户相关信息（注意：*为必填），填写完用户信息后点击“下一步”，继续填写企业信息，如图：\r\n \r\n继续填写企业相关信息（注意：*为必填），填写完成后，点击“确定”，完成注册，弹出提示窗口“注册成功，即将进行跳转”，点击弹窗中“确定”，跳回系统首页，如图：\r\n \r\n\r\n登录\r\n输入网址，进入在线申报系统首页（注册后，跳转回首页），在用户登录栏输入用户名、密码和验证码，点击“登录”，验证登录后，即可进入系统申报项目，如图：\r\n在线申报系统\r\n\r\n前言\r\n在线申报系统网址：http://b.bjqskj.com:8080/website/html/view/template/\r\n获取申报账号和密码两种方式：\r\n（1）	注册\r\n（2）	后台分配账号和密码\r\n\r\n注册\r\n输入网址，进入在线申报系统首页，点击“注册”，进行注册，用于获取登录系统的账号和密码，如图：\r\n \r\n进入注册页面，分两部分填写注册信息：用户信息、企业信息\r\n填写用户相关信息（注意：*为必填），填写完用户信息后点击“下一步”，继续填写企业信息，如图：\r\n \r\n继续填写企业相关信息（注意：*为必填），填写完成后，点击“确定”，完成注册，弹出提示窗口“注册成功，即将进行跳转”，点击弹窗中“确定”，跳回系统首页，如图：\r\n \r\n\r\n登录\r\n输入网址，进入在线申报系统首页（注册后，跳转回首页），在用户登录栏输入用户名、密码和验证码，点击“登录”，验证登录后，即可进入系统申报项目，如图：\r\n','在线申报系统\r\n\r\n前言\r\n在线申报系统网址：http://b.bjqskj.com:8080/website/html/view/template/\r\n获取申报账号和密码两种方式：\r\n（1）	注册\r\n（2）	后台分配账号和密码\r\n\r\n注册\r\n输入网址，进入在线申报系统首页，点击“注册”，进行注册，用于获取登录系统的账号和密码，如图：\r\n \r\n进入注册页面，分两部分填写注册信息：用户信息、企业信息\r\n填写用户相关信息（注意：*为必填），填写完用户信息后点击“下一步”，继续填写企业信息，如图：\r\n \r\n继续填写企业相关信息（注意：*为必填），填写完成后，点击“确定”，完成注册，弹出提示窗口“注册成功，即将进行跳转”，点击弹窗中“确定”，跳回系统首页，如图：\r\n \r\n\r\n登录\r\n输入网址，进入在线申报系统首页（注册后，跳转回首页），在用户登录栏输入用户名、密码和验证码，点击“登录”，验证登录后，即可进入系统申报项目，如图：\r\n在线申报系统\r\n\r\n前言\r\n在线申报系统网址：http://b.bjqskj.com:8080/website/html/view/template/\r\n获取申报账号和密码两种方式：\r\n（1）	注册\r\n（2）	后台分配账号和密码\r\n\r\n注册\r\n输入网址，进入在线申报系统首页，点击“注册”，进行注册，用于获取登录系统的账号和密码，如图：\r\n \r\n进入注册页面，分两部分填写注册信息：用户信息、企业信息\r\n填写用户相关信息（注意：*为必填），填写完用户信息后点击“下一步”，继续填写企业信息，如图：\r\n \r\n继续填写企业相关信息（注意：*为必填），填写完成后，点击“确定”，完成注册，弹出提示窗口“注册成功，即将进行跳转”，点击弹窗中“确定”，跳回系统首页，如图：\r\n \r\n\r\n登录\r\n输入网址，进入在线申报系统首页（注册后，跳转回首页），在用户登录栏输入用户名、密码和验证码，点击“登录”，验证登录后，即可进入系统申报项目，如图：\r\n','在线申报系统\r\n\r\n前言\r\n在线申报系统网址：http://b.bjqskj.com:8080/website/html/view/template/\r\n获取申报账号和密码两种方式：\r\n（1）	注册\r\n（2）	后台分配账号和密码\r\n\r\n注册\r\n输入网址，进入在线申报系统首页，点击“注册”，进行注册，用于获取登录系统的账号和密码，如图：\r\n \r\n进入注册页面，分两部分填写注册信息：用户信息、企业信息\r\n填写用户相关信息（注意：*为必填），填写完用户信息后点击“下一步”，继续填写企业信息，如图：\r\n \r\n继续填写企业相关信息（注意：*为必填），填写完成后，点击“确定”，完成注册，弹出提示窗口“注册成功，即将进行跳转”，点击弹窗中“确定”，跳回系统首页，如图：\r\n \r\n\r\n登录\r\n输入网址，进入在线申报系统首页（注册后，跳转回首页），在用户登录栏输入用户名、密码和验证码，点击“登录”，验证登录后，即可进入系统申报项目，如图：\r\n在线申报系统\r\n\r\n前言\r\n在线申报系统网址：http://b.bjqskj.com:8080/website/html/view/template/\r\n获取申报账号和密码两种方式：\r\n（1）	注册\r\n（2）	后台分配账号和密码\r\n\r\n注册\r\n输入网址，进入在线申报系统首页，点击“注册”，进行注册，用于获取登录系统的账号和密码，如图：\r\n \r\n进入注册页面，分两部分填写注册信息：用户信息、企业信息\r\n填写用户相关信息（注意：*为必填），填写完用户信息后点击“下一步”，继续填写企业信息，如图：\r\n \r\n继续填写企业相关信息（注意：*为必填），填写完成后，点击“确定”，完成注册，弹出提示窗口“注册成功，即将进行跳转”，点击弹窗中“确定”，跳回系统首页，如图：\r\n \r\n\r\n登录\r\n输入网址，进入在线申报系统首页（注册后，跳转回首页），在用户登录栏输入用户名、密码和验证码，点击“登录”，验证登录后，即可进入系统申报项目，如图：\r\n','在线申报系统\r\n\r\n前言\r\n在线申报系统网址：http://b.bjqskj.com:8080/website/html/view/template/\r\n获取申报账号和密码两种方式：\r\n（1）	注册\r\n（2）	后台分配账号和密码\r\n\r\n注册\r\n输入网址，进入在线申报系统首页，点击“注册”，进行注册，用于获取登录系统的账号和密码，如图：\r\n \r\n进入注册页面，分两部分填写注册信息：用户信息、企业信息\r\n填写用户相关信息（注意：*为必填），填写完用户信息后点击“下一步”，继续填写企业信息，如图：\r\n \r\n继续填写企业相关信息（注意：*为必填），填写完成后，点击“确定”，完成注册，弹出提示窗口“注册成功，即将进行跳转”，点击弹窗中“确定”，跳回系统首页，如图：\r\n \r\n\r\n登录\r\n输入网址，进入在线申报系统首页（注册后，跳转回首页），在用户登录栏输入用户名、密码和验证码，点击“登录”，验证登录后，即可进入系统申报项目，如图：\r\n在线申报系统\r\n\r\n前言\r\n在线申报系统网址：http://b.bjqskj.com:8080/website/html/view/template/\r\n获取申报账号和密码两种方式：\r\n（1）	注册\r\n（2）	后台分配账号和密码\r\n\r\n注册\r\n输入网址，进入在线申报系统首页，点击“注册”，进行注册，用于获取登录系统的账号和密码，如图：\r\n \r\n进入注册页面，分两部分填写注册信息：用户信息、企业信息\r\n填写用户相关信息（注意：*为必填），填写完用户信息后点击“下一步”，继续填写企业信息，如图：\r\n \r\n继续填写企业相关信息（注意：*为必填），填写完成后，点击“确定”，完成注册，弹出提示窗口“注册成功，即将进行跳转”，点击弹窗中“确定”，跳回系统首页，如图：\r\n \r\n\r\n登录\r\n输入网址，进入在线申报系统首页（注册后，跳转回首页），在用户登录栏输入用户名、密码和验证码，点击“登录”，验证登录后，即可进入系统申报项目，如图：\r\n','在线申报系统\r\n\r\n前言\r\n在线申报系统网址：http://b.bjqskj.com:8080/website/html/view/template/\r\n获取申报账号和密码两种方式：\r\n（1）	注册\r\n（2）	后台分配账号和密码\r\n\r\n注册\r\n输入网址，进入在线申报系统首页，点击“注册”，进行注册，用于获取登录系统的账号和密码，如图：\r\n \r\n进入注册页面，分两部分填写注册信息：用户信息、企业信息\r\n填写用户相关信息（注意：*为必填），填写完用户信息后点击“下一步”，继续填写企业信息，如图：\r\n \r\n继续填写企业相关信息（注意：*为必填），填写完成后，点击“确定”，完成注册，弹出提示窗口“注册成功，即将进行跳转”，点击弹窗中“确定”，跳回系统首页，如图：\r\n \r\n\r\n登录\r\n输入网址，进入在线申报系统首页（注册后，跳转回首页），在用户登录栏输入用户名、密码和验证码，点击“登录”，验证登录后，即可进入系统申报项目，如图：\r\n在线申报系统\r\n\r\n前言\r\n在线申报系统网址：http://b.bjqskj.com:8080/website/html/view/template/\r\n获取申报账号和密码两种方式：\r\n（1）	注册\r\n（2）	后台分配账号和密码\r\n\r\n注册\r\n输入网址，进入在线申报系统首页，点击“注册”，进行注册，用于获取登录系统的账号和密码，如图：\r\n \r\n进入注册页面，分两部分填写注册信息：用户信息、企业信息\r\n填写用户相关信息（注意：*为必填），填写完用户信息后点击“下一步”，继续填写企业信息，如图：\r\n \r\n继续填写企业相关信息（注意：*为必填），填写完成后，点击“确定”，完成注册，弹出提示窗口“注册成功，即将进行跳转”，点击弹窗中“确定”，跳回系统首页，如图：\r\n \r\n\r\n登录\r\n输入网址，进入在线申报系统首页（注册后，跳转回首页），在用户登录栏输入用户名、密码和验证码，点击“登录”，验证登录后，即可进入系统申报项目，如图：\r\n','在线申报系统\r\n\r\n前言\r\n在线申报系统网址：http://b.bjqskj.com:8080/website/html/view/template/\r\n获取申报账号和密码两种方式：\r\n（1）	注册\r\n（2）	后台分配账号和密码\r\n\r\n注册\r\n输入网址，进入在线申报系统首页，点击“注册”，进行注册，用于获取登录系统的账号和密码，如图：\r\n \r\n进入注册页面，分两部分填写注册信息：用户信息、企业信息\r\n填写用户相关信息（注意：*为必填），填写完用户信息后点击“下一步”，继续填写企业信息，如图：\r\n \r\n继续填写企业相关信息（注意：*为必填），填写完成后，点击“确定”，完成注册，弹出提示窗口“注册成功，即将进行跳转”，点击弹窗中“确定”，跳回系统首页，如图：\r\n \r\n\r\n登录\r\n输入网址，进入在线申报系统首页（注册后，跳转回首页），在用户登录栏输入用户名、密码和验证码，点击“登录”，验证登录后，即可进入系统申报项目，如图：\r\n'),('kno1453119627',2,'1、申请项目的概述。','1、申请项目的概述。','1、申请项目的概述。','1、申请项目的概述。','1、申请项目的概述。','1、申请项目的概述。','1、申请项目的概述。','1、申请项目的概述。','1、申请项目的概述。','1、申请项目的概述。','1、申请项目的概述。','1、申请项目的概述。','1、申请项目的概述。','1、申请项目的概述。','1、申请项目的概述。','1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。','1、申请项目的概述。','1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。','1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。','1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。','1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。','1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。1、申请项目的概述。');

/*Table structure for table `patent_list` */

DROP TABLE IF EXISTS `patent_list`;

CREATE TABLE `patent_list` (
  `id` int(11) NOT NULL auto_increment,
  `project_id` varchar(30) default NULL,
  `patent_name` varchar(30) default NULL,
  `patent_code` varchar(20) default NULL,
  `patent_type` varchar(255) default NULL,
  `patent_state` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `patent_list` */

insert  into `patent_list`(`id`,`project_id`,`patent_name`,`patent_code`,`patent_type`,`patent_state`) values (9,'dev1453097272','1',NULL,'',''),(10,'dev1453097272','2',NULL,'',''),(11,'dev1453097272','3',NULL,'1','1'),(16,'kno1453111975','测1','科技666',NULL,NULL),(17,'kno1453111975','测2','6666',NULL,NULL),(30,'kno1453119627','name1','1',NULL,NULL),(31,'kno1453119627','name2','2',NULL,NULL),(32,'kno1453119627','name3','3',NULL,NULL),(33,'kno1453119627','name4','4',NULL,NULL);

/*Table structure for table `pro_check_pri_map` */

DROP TABLE IF EXISTS `pro_check_pri_map`;

CREATE TABLE `pro_check_pri_map` (
  `id` int(11) NOT NULL auto_increment,
  `admin_info_id` int(11) NOT NULL,
  `project_type_id` int(11) NOT NULL,
  `admin_info_lend_id` int(11) NOT NULL,
  `project_type_para_id` tinyint(4) NOT NULL default '0',
  `status` tinyint(4) default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `pro_uniq` (`admin_info_id`,`project_type_id`,`project_type_para_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `pro_check_pri_map` */

insert  into `pro_check_pri_map`(`id`,`admin_info_id`,`project_type_id`,`admin_info_lend_id`,`project_type_para_id`,`status`) values (2,9,14,0,0,0);

/*Table structure for table `pro_check_user_list` */

DROP TABLE IF EXISTS `pro_check_user_list`;

CREATE TABLE `pro_check_user_list` (
  `id` int(11) NOT NULL auto_increment,
  `project_id` varchar(45) NOT NULL,
  `admin_info_id` int(11) NOT NULL,
  `type` tinyint(4) default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `cu_uniq` (`project_id`,`admin_info_id`,`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `pro_check_user_list` */

/*Table structure for table `pro_pri_list` */

DROP TABLE IF EXISTS `pro_pri_list`;

CREATE TABLE `pro_pri_list` (
  `id` int(11) NOT NULL auto_increment,
  `admin_info_id` int(11) NOT NULL,
  `prival` varchar(45) default NULL,
  `status` tinyint(4) default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `ap_uniq` (`admin_info_id`,`prival`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `pro_pri_list` */

/*Table structure for table `produce` */

DROP TABLE IF EXISTS `produce`;

CREATE TABLE `produce` (
  `produce_name` varchar(255) default NULL,
  `produce_level` int(11) default NULL,
  `project_id` varchar(30) default NULL,
  `id` int(11) NOT NULL auto_increment,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `produce` */

insert  into `produce`(`produce_name`,`produce_level`,`project_id`,`id`) values ('1',0,'dev1453097272',1),('2',0,'dev1453097272',2);

/*Table structure for table `produce_award` */

DROP TABLE IF EXISTS `produce_award`;

CREATE TABLE `produce_award` (
  `id` int(11) NOT NULL auto_increment,
  `project_id` varchar(30) default NULL,
  `award_name` varchar(30) default NULL,
  `award_dep` varchar(30) default NULL,
  `award_level` varchar(30) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `produce_award` */

insert  into `produce_award`(`id`,`project_id`,`award_name`,`award_dep`,`award_level`) values (5,'dev1453097272','33','33','33'),(6,'dev1453097272','44','44','44');

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
  `year_tax` double default NULL,
  `year_profit` double default NULL,
  `year_income` double default NULL,
  `predict_inspectax` float default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `profit_tax` */

insert  into `profit_tax`(`id`,`org_code`,`lastmarket_income`,`last_tax`,`last_profit`,`last_totalincome`,`last_totalprofit`,`last_industryval`,`last_industrytax`,`last_industryadd`,`last_industrycreative`,`last_productsale`,`last_techexpend`,`main_product`,`sale_ratio`,`predict_income`,`predict_tax`,`predict_profit`,`lasthalf_income`,`lasthalf_tax`,`lasthalf_profit`,`year_tax`,`year_profit`,`year_income`,`predict_inspectax`) values (1,'qskj001',NULL,NULL,NULL,2,NULL,NULL,5,3,6,4,7,NULL,NULL,NULL,NULL,NULL,NULL,4,1,34,32,12,NULL),(2,'机构代码',NULL,NULL,NULL,1,NULL,NULL,1,1,1,1,1,NULL,NULL,NULL,NULL,NULL,NULL,1,1,NULL,NULL,NULL,NULL),(3,'',NULL,NULL,NULL,0,NULL,NULL,0,0,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,0,0,NULL,NULL,NULL,NULL),(4,'密码：123',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,1e+011,0,0,0,0,NULL,NULL,NULL,NULL),(5,'zgf001',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,100000,0,0,0,0,NULL,NULL,NULL,NULL),(6,'6666666-y',NULL,NULL,NULL,5.65,NULL,NULL,5.777,5.33,5.99,6.99,6.222,NULL,NULL,NULL,NULL,NULL,NULL,5.666,5.66,NULL,NULL,NULL,NULL);

/*Table structure for table `project_ann_plan` */

DROP TABLE IF EXISTS `project_ann_plan`;

CREATE TABLE `project_ann_plan` (
  `id` int(11) NOT NULL auto_increment,
  `project_id` varchar(30) default NULL,
  `plan_year` varchar(10) default NULL,
  `task_plan_content` text,
  `plan_content` text,
  `task_project_id` varchar(20) default NULL,
  `task_plan_year` varchar(10) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `project_ann_plan` */

insert  into `project_ann_plan`(`id`,`project_id`,`plan_year`,`task_plan_content`,`plan_content`,`task_project_id`,`task_plan_year`) values (1,'dev1453098333','2016',NULL,'页面很美。',NULL,NULL),(2,'dev1453098333','2017',NULL,'页面很美。',NULL,NULL),(3,'dev1453098333','2018',NULL,'页面很美。',NULL,NULL),(4,'dev1453098333','2019',NULL,'页面很美。',NULL,NULL),(5,'dev1453098333','2020',NULL,'页面很美。',NULL,NULL),(9,'dev1453101198','2016',NULL,'啊啊',NULL,NULL),(10,'dev1453101496','2016',NULL,'1\r\n2\r\n3\r\n4\r\n5\r\n6\r\n7\r\n8\r\n9\r\n10\r\n11\r\n12\r\n13\r\n14\r\n15\r\n16\r\n17\r\n18\r\n19\r\n20\r\n21\r\n22\r\n23\r\n24\r\n25',NULL,NULL),(11,'dev1453101496','2017',NULL,'1\r\n2\r\n3\r\n4\r\n5\r\n6\r\n7\r\n8\r\n9\r\n10\r\n11\r\n12\r\n13\r\n14\r\n15\r\n16\r\n17\r\n18\r\n19\r\n20\r\n21\r\n22\r\n23\r\n24\r\n25',NULL,NULL),(12,'dev1453101596','2016',NULL,'项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度',NULL,NULL),(13,'dev1453101596','2017',NULL,'项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度',NULL,NULL),(14,NULL,NULL,'好',NULL,'dev1453101198','2016'),(15,'dev1453103161','2016',NULL,'项目技术方案与技术路线',NULL,NULL),(16,'dev1453103161','2017',NULL,'项目技术方案与技术路线',NULL,NULL),(17,'dev1453103161','2018',NULL,'项目技术方案与技术路线',NULL,NULL),(18,NULL,NULL,'项目各年度任务目标、考核指标及研究开发内容完成的计划进度\r\n项目各年度任务目标、考核指标及研究开发内容完成的计划进度\r\n项目各年度任务目标、考核指标及研究开发内容完成的计划进度\r\n项目各年度任务目标、考核指标及研究开发内容完成的计划进度\r\n项目各年度任务目标、考核指标及研究开发内容完成的计划进度\r\n项目各年度任务目标、考核指标及研究开发内容完成的计划进度\r\n项目各年度任务目标、考核指标及研究开发内容完成的计划进度\r\n项目各年度任务目标、考核指标及研究开发内容完成的计划进度\r\n项目各年度任务目标、考核指标及研究开发内容完成的计划进度\r\n项目各年度任务目标、考核指标及研究开发内容完成的计划进度\r\n项目各年度任务111111111111111111目标、考核指标及研究开发内容完成的计划进度\r\n项目各年度任务目标、考核指标及研究开发内容完成的计划进度\r\n项目各年度任务目标、考核指标及研究开发内容完成的计划进度\r\n项目各年度任务目标、考核指标及研究开发内容完成的计划进度\r\n',NULL,'dev1453101496','2016'),(19,NULL,NULL,'项目各年度任务目标、考核指标及研究开发内容完成的计划进度\r\n项目各年度任务目标、考核指标及研究开发内容完成的计划进度\r\n项目各年度任务目标、考核指标及研究开发内容完成的计划进度\r\n项目各年度任务目标、考核指标及研究开发内容完成的计划进度\r\n项目各年度任务目标、考核指标及研究开发内容完成的计划进度\r\n项目各年度任务目标、考核指标及研究开发内容完成的计划进度\r\n项目各年度任务目标、考核指标及研究开发内容完成的计划进度\r\n2项目各年度任务目标、考核指标及研究开发内容完成的计划进度\r\n项目各年度任务目标、考核指标及研究开发内容完成的计划进度\r\n项目各年度任务目标、考核指标及研究开发内容完成的计划进度\r\n项目各年度任务目标、考核指标及研究开发内容完成的计划进度\r\n项目各年度任务目标、考核指标及研究开发内容完成的计划进度\r\n',NULL,'dev1453101496','2017'),(20,NULL,NULL,'项目各年度任务目标、考核指标及研究开发内容完成的计划进度\r\n项目各年度任务目标、考核指标及研究开发内容完成的计划进度\r\n项目各年度任务目标、考核指标及研究5433333333333333333333333开发内容完成的计划进度\r\n项目各年度任务目标、考核指标及研究开发内容完成的计划进度\r\n项目各年度任务目标、考核指标及研究开发内容完成的计划进度\r\n项目各年度任务目标、考核指标及研究开发内容完成的计划进度\r\n项目各年度任务目标、考核指标及研究开发内容完成的计划进度\r\n项目各年度任务目标、考核指标及研究开发内容完成的计划进度\r\n项目各年度任务目标、考核指标及研究开发内容完成的计划进度\r\n项目各年度任务目标、考核指标及研究开发内容完成的计划进度\r\n项目各年度任务目标、考核指标及研究开发内容完成的计划进度\r\n项目各年度任务目标、考核指标及研究开发内容完成的计划进度\r\n项目各年度任务目标、考核指标及研究开发内容完成的计划进度\r\n项目各年度任务目标、考核指标及研究开发内容完成的计划进度\r\n项目各年度任务目标、考核指标及研究开发内容完成的计划进度\r\n项目各年度任务目标、考核指标及研究开发内容完成的计划进度\r\n项目各年度任务目标、考核指标及研究开发内容完成的计划进度\r\n项目各年度任务目标、考核指标及研究开发内容完成的计划进度\r\n项目各年度任务目标、考核指标及研究开发内容完成的计划进度\r\n项目各年度任务目标、考核指标及研究开发内容完成的计划进度\r\n项目各年度任务目标、考核指标及研究开发内容完成的计划进度\r\n项目各年度任务目标、考核指标及研究开发内容完成的计划进度\r\n',NULL,'dev1453101496','2018'),(24,NULL,NULL,'好',NULL,'dev1453106590','2016'),(25,NULL,NULL,'好',NULL,'dev1453106590','2017'),(26,NULL,NULL,'',NULL,'dev1453103161',''),(27,NULL,NULL,'',NULL,'dev1453103161','2017'),(28,NULL,NULL,'',NULL,'dev1453103161','2018'),(29,NULL,NULL,'',NULL,'dev1453103161','2019'),(30,'sci1453102606','2016',NULL,'项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度',NULL,NULL),(31,'sci1453102606','2017',NULL,'项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度',NULL,NULL),(32,'sci1453102606','2018',NULL,'项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度',NULL,NULL),(33,'sci1453102606','2019',NULL,'项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度',NULL,NULL),(42,NULL,NULL,'1111',NULL,'sci1453109921',''),(43,NULL,NULL,'222',NULL,'sci1453109921',''),(44,NULL,NULL,'项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度',NULL,'dev1453101596','2016'),(45,NULL,NULL,'项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度',NULL,'dev1453101596','2017'),(46,NULL,NULL,'项目各年度任务目标、考核指标及研究开发内容完成的计划项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度',NULL,'dev1453101596','2018'),(47,NULL,NULL,'项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度项目各年度任务目标、考核指标及研究开发内容完成的计划进度',NULL,'dev1453101596','2019'),(48,NULL,NULL,'啊',NULL,'dev1453117545','2016'),(49,'dev1453122587','2016',NULL,'写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 ',NULL,NULL),(50,'dev1453122587','2017',NULL,'写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 ',NULL,NULL),(53,NULL,NULL,'  数百家覆盖全国优秀的合作伙伴。年轻充满活力，团结的公司团队。优秀的管理，国内唯一的白牌服务器/储存产品LV4级售后平台，专业的市场团队人员，多年经验积累的FAE工程师和国内数十家上市公司/行业领头企业的认证供应商。',NULL,'dev1453122587','2016'),(54,NULL,NULL,'',NULL,'dev1453122587','');

/*Table structure for table `project_assessment` */

DROP TABLE IF EXISTS `project_assessment`;

CREATE TABLE `project_assessment` (
  `id` int(11) NOT NULL auto_increment,
  `expectation_target_icome` varchar(255) default NULL,
  `expectation_target_year` varchar(255) default NULL,
  `expectation_target_profit` varchar(255) default NULL,
  `project_id` varchar(30) default NULL,
  `expectation_target_earning` varchar(255) default NULL,
  `expectation_target_tax` varchar(255) default NULL,
  `previous_year_icome` varchar(255) default NULL,
  `previous_year_year` varchar(255) default NULL,
  `previous_year_profit` varchar(255) default NULL,
  `after_year_earning` varchar(255) default NULL,
  `previous_year_earning` varchar(255) default NULL,
  `after_year_tax` varchar(255) default NULL,
  `after_year_profit` varchar(255) default NULL,
  `after_year_icome` varchar(255) default NULL,
  `after_year_year` varchar(255) default NULL,
  `previous_year_tax` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `project_assessment` */

insert  into `project_assessment`(`id`,`expectation_target_icome`,`expectation_target_year`,`expectation_target_profit`,`project_id`,`expectation_target_earning`,`expectation_target_tax`,`previous_year_icome`,`previous_year_year`,`previous_year_profit`,`after_year_earning`,`previous_year_earning`,`after_year_tax`,`after_year_profit`,`after_year_icome`,`after_year_year`,`previous_year_tax`) values (1,'3','3','3','dev1453097272','3','3','3','3','3','3','3','3','3','3','3','3');

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

/*Table structure for table `project_check_relative` */

DROP TABLE IF EXISTS `project_check_relative`;

CREATE TABLE `project_check_relative` (
  `id` int(11) NOT NULL auto_increment,
  `project_type_id` int(11) default NULL,
  `table_type_id` int(11) default NULL,
  `subtable_id` int(11) default NULL,
  `weight` float default NULL,
  `status` tinyint(4) default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `ch_uniq` (`project_type_id`,`table_type_id`,`subtable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `project_check_relative` */

insert  into `project_check_relative`(`id`,`project_type_id`,`table_type_id`,`subtable_id`,`weight`,`status`) values (1,1,1,4,0.2,0),(2,1,1,5,0.3,0),(3,1,1,6,0.4,0),(4,12,20,1965,1,0),(5,11,22,1981,0.3,0),(6,11,22,1983,0.5,0),(7,29,1,2,0.2,0),(8,29,1,3,0.2,0),(9,29,1,4,0.2,0),(10,29,1,5,0.2,0),(11,29,1,6,0.2,0),(12,29,1,9,0.2,0),(13,29,1,10,0.2,0),(14,29,1,11,0.2,0),(15,30,1,2,0.2,0),(16,30,1,3,0.2,0),(17,30,1,4,0.2,0),(18,30,1,5,0.2,0),(19,30,1,6,0.2,0),(20,30,1,9,0.2,0),(21,30,1,10,0.2,0),(22,30,1,11,0.2,0),(23,31,1,2,0.2,0),(24,31,1,3,0.2,0),(25,31,1,4,0.2,0),(26,31,1,5,0.2,0),(27,31,1,6,0.2,0),(28,31,1,9,0.2,0),(29,31,1,10,0.2,0),(30,31,1,11,0.2,0),(31,33,1,2,0.2,-1),(32,33,1,3,0,-1),(33,33,1,4,0.2,-1),(34,33,1,5,0.2,-1),(35,33,1,6,0.2,-1),(36,33,1,9,0.2,-1),(37,33,1,10,0.2,-1),(38,33,1,11,0.2,-1),(39,11,22,1982,NULL,0),(40,11,22,1984,NULL,0),(41,11,22,1985,NULL,0),(42,11,22,1986,NULL,0),(43,11,22,1987,NULL,0),(44,11,22,1988,NULL,0),(45,36,3,1918,NULL,0);

/*Table structure for table `project_content` */

DROP TABLE IF EXISTS `project_content`;

CREATE TABLE `project_content` (
  ` id` int(11) NOT NULL auto_increment,
  `project_id` varchar(30) default NULL,
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
  `task_project_id` varchar(30) default NULL,
  `project_id` varchar(30) NOT NULL,
  `subject` varchar(20) default NULL,
  `other_total` varchar(300) default NULL,
  `patent_out` float default NULL,
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
  `task_project_id` varchar(30) default NULL,
  `project_id` varchar(30) NOT NULL,
  `subject` year(4) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `project_fund_tech` */

/*Table structure for table `project_info` */

DROP TABLE IF EXISTS `project_info`;

CREATE TABLE `project_info` (
  `zj_project_lzsj` varchar(20) default NULL,
  `project_lzsj` varchar(20) default NULL,
  `project_zxzj_name` varbinary(100) default NULL,
  `end_time` varchar(10) default NULL,
  `start_time` varchar(10) default NULL,
  `promoney` varchar(50) default NULL,
  `argument_time` varchar(10) default NULL,
  `task_delegation_task` text,
  `task_tech_way` text,
  `others_material` text,
  `id` int(11) NOT NULL auto_increment,
  `task_project_id` varchar(30) default NULL,
  `project_id` varchar(30) NOT NULL,
  `principal_id` int(11) default NULL,
  `undertake_id` varchar(30) default NULL,
  `cooperate_id` int(11) default NULL,
  `project_meaning` text,
  `project_mission` text,
  `project_aim` text,
  `project_kpi` text,
  `task_project_content` text,
  `project_content` text,
  `tech_way` text,
  `project_manage` text,
  `delegation_task` text,
  `project_risk` text,
  `task_project_expect` text,
  `project_expect` text,
  `project_effect` text,
  `leader_opinion` text,
  `zj_expert_opinion` text,
  `expert_opinion` text,
  `org_opinion` text,
  `office_opinion` text,
  `head_opinion` text,
  `director_opinion` text,
  `project_status` text,
  `project_type` text,
  `project_step` varchar(20) default NULL,
  `other_condition` text,
  `business_id` varchar(30) default NULL,
  `ispass` int(11) default '0',
  `leader_name` varchar(20) default NULL,
  `leader_sex` varchar(2) default '0',
  `leader_birth` time default NULL,
  `leader_ID` varchar(30) default NULL,
  `leader_edu` varchar(10) default NULL,
  `leader_major` varchar(10) default NULL,
  `leader_phone` varchar(20) default NULL,
  `leader_address` text,
  `leader_fax` varchar(20) default NULL,
  `leader_email` varchar(50) default NULL,
  `leader_achieve` text,
  `leader_job` varchar(50) default NULL,
  `tech_pos` varchar(30) default NULL,
  `leader_postal` varchar(20) default NULL,
  `leader_tele` varchar(20) default NULL,
  `org_code` varchar(30) default NULL,
  `project_name` varchar(50) default NULL,
  `project_match` text COMMENT '、项目研究所需的配套条件及来源',
  `project_start` varchar(100) default NULL,
  `project_end` varchar(100) default NULL,
  `project_stage` int(11) default '0',
  `project_condition` int(11) default '1',
  `department` varchar(30) default NULL,
  `project_engineer` varchar(30) default NULL,
  `project_place` varchar(50) default NULL,
  `tech_area` varchar(50) default NULL,
  `project_advantage` text,
  `tech_level` varchar(50) default NULL,
  `project_fund` double default NULL,
  `support_fund` double default NULL,
  `support_way` varchar(20) default NULL,
  `allocate_time` varchar(50) default NULL,
  `property_name` varchar(100) default NULL,
  `coproject_summary` text,
  `tech_achieve` text,
  `social_benefit` text,
  `planfinish_time` varchar(30) default NULL,
  `coorg` varchar(50) default NULL,
  `project_main` text,
  `start_end` varchar(100) default NULL,
  `project_summary` text,
  `user_id` int(11) default NULL,
  `stage_process` varchar(20) default NULL,
  `file_path` text,
  `project_money` varchar(100) NOT NULL,
  `project_argtime` varchar(100) default NULL,
  `isDelete` int(11) default '0',
  `create_time` varchar(30) NOT NULL,
  `is_save` int(2) unsigned default '0',
  `task_org_code` varchar(30) default NULL,
  `task_project_mission` text,
  `task_project_aim` text,
  `task_project_kpi` text,
  `task_project_manage` text,
  `extra_info` text,
  `other_solution` text,
  `quality_certifi` text,
  `save_year` text,
  `is_check` tinyint(4) default '0',
  `patent_other_condition` text,
  `patent_project_expect` text,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `project_info` */

insert  into `project_info`(`zj_project_lzsj`,`project_lzsj`,`project_zxzj_name`,`end_time`,`start_time`,`promoney`,`argument_time`,`task_delegation_task`,`task_tech_way`,`others_material`,`id`,`task_project_id`,`project_id`,`principal_id`,`undertake_id`,`cooperate_id`,`project_meaning`,`project_mission`,`project_aim`,`project_kpi`,`task_project_content`,`project_content`,`tech_way`,`project_manage`,`delegation_task`,`project_risk`,`task_project_expect`,`project_expect`,`project_effect`,`leader_opinion`,`zj_expert_opinion`,`expert_opinion`,`org_opinion`,`office_opinion`,`head_opinion`,`director_opinion`,`project_status`,`project_type`,`project_step`,`other_condition`,`business_id`,`ispass`,`leader_name`,`leader_sex`,`leader_birth`,`leader_ID`,`leader_edu`,`leader_major`,`leader_phone`,`leader_address`,`leader_fax`,`leader_email`,`leader_achieve`,`leader_job`,`tech_pos`,`leader_postal`,`leader_tele`,`org_code`,`project_name`,`project_match`,`project_start`,`project_end`,`project_stage`,`project_condition`,`department`,`project_engineer`,`project_place`,`tech_area`,`project_advantage`,`tech_level`,`project_fund`,`support_fund`,`support_way`,`allocate_time`,`property_name`,`coproject_summary`,`tech_achieve`,`social_benefit`,`planfinish_time`,`coorg`,`project_main`,`start_end`,`project_summary`,`user_id`,`stage_process`,`file_path`,`project_money`,`project_argtime`,`isDelete`,`create_time`,`is_save`,`task_org_code`,`task_project_mission`,`task_project_aim`,`task_project_kpi`,`task_project_manage`,`extra_info`,`other_solution`,`quality_certifi`,`save_year`,`is_check`,`patent_other_condition`,`patent_project_expect`) values (NULL,NULL,NULL,'1453478400','1452096000',NULL,NULL,NULL,NULL,NULL,13,NULL,'dev1453101596',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'6',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'zgf001','1-18-支持创新平台建设项目',NULL,NULL,NULL,3,1,'发展计划科','',NULL,'电子信息',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,'0,1,2,3',NULL,'',NULL,0,'1453101596',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL),('2016-01-11',NULL,'申报项目','1454169600','1453046400',NULL,NULL,'（项目的组织管理和协调措施应能保障项目的正常实施；应能落实项目实施所需配套条件；项目负责人应能切实履行项目管理职责；应能落实项目任务所需的研究团队和配套仪器设备、经费等条件，有完善的科技管理制度。）如有委托研究的任务，受托单位确保委托任务完成的措施；如有多家单位承担项目任务，阐明项目的任务分工及相应的目标和考核指标。）\r\n（项目的组织管理和协调措施应能保障项目的正常实施；应能落实项目实施所需配套条件；项目负责人应能切实履行项目管理职责；应能落实项目任务所需的研究团队和配套仪器设备、经费等条件，有完善的科技管理制度。）如有委托研究的任务，受托单位确保委托任务完成的措施；如有多家单位承担项目任务，阐明项目的任务分工及相应的目标和考核指标。）\r\n（项目的组织管理和协调措施应能保障项目的正常实施；应能落实项目实施所需配套条件；项目负责人应能切实履行项目管理职责；应能落实项目任务所需的研究团队和配套仪器设备、经费等条件，有完善的科技管理制度。）如有委托研究的任务，受托单位确保委托任务完成的措施；如有多家单位承担项目任务，阐明项目的任务分工及相应的目标和考核指标。）\r\n（项目的组织管理和协调措施应能保障项目的正常实施；应能落实项目实施所需配套条件；项目负责人应能切实履行项目管理职责；应能落实项目任务所需的研究团队和配套仪器设备、经费等条件，有完善的科技管理制度。）如有委托研究的任务，受托单位确保委托任务完成的措施；如有多家单位承担项目任务，阐明项目的任务分工及相应的目标和考核指标。）\r\n（项目的组织管理和协调措施应能保障项目的正常实施；应能落实项目实施所需配套条件；项目负责人应能切实履行项目管理职责；应能落实项目任务所需的研究团队和配套仪器设备、经费等条件，有完善的科技管理制度。）如有委托研究的任务，受托单位确保委托任务完成的措施；如有多家单位承担项目任务，阐明项目的任务分工及相应的目标和考核指标。）\r\n（项目的组织管理和协调措施应能保障项目的正常实施；应能落实项目实施所需配套条件；项目负责人应能切实履行项目管理职责；应能落实项目任务所需的研究团队和配套仪器设备、经费等条件，有完善的科技管理制度。）如有委托研究的任务，受托单位确保委托任务完成的措施；如有多家单位承担项目任务，阐明项目的任务分工及相应的目标和考核指标。）\r\n（项目的组织管理和协调措施应能保障项目的正常实施；应能落实项目实施所需配套条件；项目负责人应能切实履行项目管理职责；应能落实项目任务所需的研究团队和配套仪器设备、经费等条件，有完善的科技管理制度。）如有委托研究的任务，受托单位确保委托任务完成的措施；如有多家单位承担项目任务，阐明项目的任务分工及相应的目标和考核指标。）\r\n（项目的组织管理和协调措施应能保障项目的正常实施；应能落实项目实施所需配套条件；项目负责人应能切实履行项目管理职责；应能落实项目任务所需的研究团队和配套仪器设备、经费等条件，有完善的科技管理制度。）如有委托研究的任务，受托单位确保委托任务完成的措施；如有多家单位承担项目任务，阐明项目的任务分工及相应的目标和考核指标。）\r\n（项目的组织管理和协调措施应能保障项目的正常实施；应能落实项目实施所需配套条件；项目负责人应能切实履行项目管理职责；应能落实项目任务所需的研究团队和配套仪器设备、经费等条件，有完善的科技管理制度。）如有委托研究的任务，受托单位确保委托任务完成的措施；如有多家单位承担项目任务，阐明项目的任务分工及相应的目标和考核指标。）\r\n（项目的组织管理和协调措施应能保障项目的正常实施；应能落实项目实施所需配套条件；项目负责人应能切实履行项目管理职责；应能落实项目任务所需的研究团队和配套仪器设备、经费等条件，有完善的科技管理制度。）如有委托研究的任务，受托单位确保委托任务完成的措施；如有多家单位承担项目任务，阐明项目的任务分工及相应的目标和考核指标。）\r\n（项目的组织管理和协调措施应能保障项目的正常实施；应能落实项目实施所需配套条件；项目负责人应能切实履行项目管理职责；应能落实项目任务所需的研究团队和配套仪器设备、经费等条件，有完善的科技管理制度。）如有委托研究的任务，受托单位确保委托任务完成的措施；如有多家单位承担项目任务，阐明项目的任务分工及相应的目标和考核指标。）\r\n（项目的组织管理和协调措施应能保障项目的正常实施；应能落实项目实施所需配套条件；项目负责人应能切实履行项目管理职责；应能落实项目任务所需的研究团队和配套仪器设备、经费等条件，有完善的科技管理制度。）如有委托研究的任务，受托单位确保委托任务完成的措施；如有多家单位承担项目任务，阐明项目的任务分工及相应的目标和考核指标。）\r\n（项目的组织管理和协调措施应能保障项目的正常实施；应能落实项目实施所需配套条件；项目负责人应能切实履行项目管理职责；应能落实项目任务所需的研究团队和配套仪器设备、经费等条件，有完善的科技管理制度。）如有委托研究的任务，受托单位确保委托任务完成的措施；如有多家单位承担项目任务，阐明项目的任务分工及相应的目标和考核指标。）\r\n（项目的组织管理和协调措施应能保障项目的正常实施；应能落实项目实施所需配套条件；项目负责人应能切实履行项目管理职责；应能落实项目任务所需的研究团队和配套仪器设备、经费等条件，有完善的科技管理制度。）如有委托研究的任务，受托单位确保委托任务完成的措施；如有多家单位承担项目任务，阐明项目的任务分工及相应的目标和考核指标。）\r\n（项目的组织管理和协调措施应能保障项目的正常实施；应能落实项目实施所需配套条件；项目负责人应能切实履行项目管理职责；应能落实项目任务所需的研究团队和配套仪器设备、经费等条件，有完善的科技管理制度。）如有委托研究的任务，受托单位确保委托任务完成的措施；如有多家单位承担项目任务，阐明项目的任务分工及相应的目标和考核指标。）\r\n（项目的组织管理和协调措施应能保障项目的正常实施；应能落实项目实施所需配套条件；项目负责人应能切实履行项目管理职责；应能落实项目任务所需的研究团队和配套仪器设备、经费等条件，有完善的科技管理制度。）如有委托研究的任务，受托单位确保委托任务完成的措施；如有多家单位承担项目任务，阐明项目的任务分工及相应的目标和考核指标。）\r\n（项目的组织管理和协调措施应能保障项目的正常实施；应能落实项目实施所需配套条件；项目负责人应能切实履行项目管理职责；应能落实项目任务所需的研究团队和配套仪器设备、经费等条件，有完善的科技管理制度。）如有委托研究的任务，受托单位确保委托任务完成的措施；如有多家单位承担项目任务，阐明项目的任务分工及相应的目标和考核指标。）\r\n（项目的组织管理和协调措施应能保障项目的正常实施；应能落实项目实施所需配套条件；项目负责人应能切实履行项目管理职责；应能落实项目任务所需的研究团队和配套仪器设备、经费等条件，有完善的科技管理制度。）如有委托研究的任务，受托单位确保委托任务完成的措施；如有多家单位承担项目任务，阐明项目的任务分工及相应的目标和考核指标。）\r\n（项目的组织管理和协调措施应能保障项目的正常实施；应能落实项目实施所需配套条件；项目负责人应能切实履行项目管理职责；应能落实项目任务所需的研究团队和配套仪器设备、经费等条件，有完善的科技管理制度。）如有委托研究的任务，受托单位确保委托任务完成的措施；如有多家单位承担项目任务，阐明项目的任务分工及相应的目标和考核指标。）\r\n（项目的组织管理和协调措施应能保障项目的正常实施；应能落实项目实施所需配套条件；项目负责人应能切实履行项目管理职责；应能落实项目任务所需的研究团队和配套仪器设备、经费等条件，有完善的科技管理制度。）如有委托研究的任务，受托单位确保委托任务完成的措施；如有多家单位承担项目任务，阐明项目的任务分工及相应的目标和考核指标。）\r\n（项目的组织管理和协调措施应能保障项目的正常实施；应能落实项目实施所需配套条件；项目负责人应能切实履行项目管理职责；应能落实项目任务所需的研究团队和配套仪器设备、经费等条件，有完善的科技管理制度。）如有委托研究的任务，受托单位确保委托任务完成的措施；如有多家单位承担项目任务，阐明项目的任务分工及相应的目标和考核指标。）\r\n（项目的组织管理和协调措施应能保障项目的正常实施；应能落实项目实施所需配套条件；项目负责人应能切实履行项目管理职责；应能落实项目任务所需的研究团队和配套仪器设备、经费等条件，有完善的科技管理制度。）如有委托研究的任务，受托单位确保委托任务完成的措施；如有多家单位承担项目任务，阐明项目的任务分工及相应的目标和考核指标。）\r\n（项目的组织管理和协调措施应能保障项目的正常实施；应能落实项目实施所需配套条件；项目负责人应能切实履行项目管理职责；应能落实项目任务所需的研究团队和配套仪器设备、经费等条件，有完善的科技管理制度。）如有委托研究的任务，受托单位确保委托任务完成的措施；如有多家单位承担项目任务，阐明项目的任务分工及相应的目标和考核指标。）\r\n（项目的组织管理和协调措施应能保障项目的正常实施；应能落实项目实施所需配套条件；项目负责人应能切实履行项目管理职责；应能落实项目任务所需的研究团队和配套仪器设备、经费等条件，有完善的科技管理制度。）如有委托研究的任务，受托单位确保委托任务完成的措施；如有多家单位承担项目任务，阐明项目的任务分工及相应的目标和考核指标。）\r\n（项目的组织管理和协调措施应能保障项目的正常实施；应能落实项目实施所需配套条件；项目负责人应能切实履行项目管理职责；应能落实项目任务所需的研究团队和配套仪器设备、经费等条件，有完善的科技管理制度。）如有委托研究的任务，受托单位确保委托任务完成的措施；如有多家单位承担项目任务，阐明项目的任务分工及相应的目标和考核指标。）\r\n','（依据项目任务要求，结合国内外技术发展和本单位实际情况确定，论证前应充分分析和阐述技术方案与技术路线，对不同方案和路线加以比较和论证说明。）\r\n（依据项目任务要求，结合国内外技术发展和本单位实际情况确定，论证前应充分分析和阐述技术方案与技术路线，对不同方案和路线加以比较和论证说明。）\r\n（依据项目任务要求，结合国内外技术发展和本单位实际情况确定，论证前应充分分析和阐述技术方案与技术路线，对不同方案和路线加以比较和论证说明。）\r\n（依据项目任务要求，结合国内外技术发展和本单位实际情况确定，论证前应充分分析和阐述技术方案与技术路线，对不同方案和路线加以比较和论证说明。）\r\n（依据项目任务要求，结合国内外技术发展和本单位实际情况确定，论证前应充分分析和阐述技术方案与技术路线，对不同方案和路线加以比较和论证说明。）\r\n（依据项目任务要求，结合国内外技术发展和本单位实际情况确定，论证前应充分分析和阐述技术方案与技术路线，对不同方案和路线加以比较和论证说明。）\r\n（依据项目任务要求，结合国内外技术发展和本单位实际情况确定，论证前应充分分析和阐述技术方案与技术路线，对不同方案和路线加以比较和论证说明。）\r\n（依据项目任务要求，结合国内外技术发展和本单位实际情况确定，论证前应充分分析和阐述技术方案与技术路线，对不同方案和路线加以比较和论证说明。）\r\n（依据项目任务要求，结合国内外技术发展和本单位实际情况确定，论证前应充分分析和阐述技术方案与技术路线，对不同方案和路线加以比较和论证说明。）\r\n（依据项目任务要求，结合国内外技术发展和本单位实际情况确定，论证前应充分分析和阐述技术方案与技术路线，对不同方案和路线加以比较和论证说明。）\r\n（依据项目任务要求，结合国内外技术发展和本单位实际情况确定，论证前应充分分析和阐述技术方案与技术路线，对不同方案和路线加以比较和论证说明。）\r\n（依据项目任务要求，结合国内外技术发展和本单位实际情况确定，论证前应充分分析和阐述技术方案与技术路线，对不同方案和路线加以比较和论证说明。）\r\n（依据项目任务要求，结合国内外技术发展和本单位实际情况确定，论证前应充分分析和阐述技术方案与技术路线，对不同方案和路线加以比较和论证说明。）\r\n（依据项目任务要求，结合国内外技术发展和本单位实际情况确定，论证前应充分分析和阐述技术方案与技术路线，对不同方案和路线加以比较和论证说明。）\r\n（依据项目任务要求，结合国内外技术发展和本单位实际情况确定，论证前应充分分析和阐述技术方案与技术路线，对不同方案和路线加以比较和论证说明。）\r\n（依据项目任务要求，结合国内外技术发展和本单位实际情况确定，论证前应充分分析和阐述技术方案与技术路线，对不同方案和路线加以比较和论证说明。）\r\n（依据项目任务要求，结合国内外技术发展和本单位实际情况确定，论证前应充分分析和阐述技术方案与技术路线，对不同方案和路线加以比较和论证说明。）\r\n（依据项目任务要求，结合国内外技术发展和本单位实际情况确定，论证前应充分分析和阐述技术方案与技术路线，对不同方案和路线加以比较和论证说明。）\r\n（依据项目任务要求，结合国内外技术发展和本单位实际情况确定，论证前应充分分析和阐述技术方案与技术路线，对不同方案和路线加以比较和论证说明。）\r\n（依据项目任务要求，结合国内外技术发展和本单位实际情况确定，论证前应充分分析和阐述技术方案与技术路线，对不同方案和路线加以比较和论证说明。）\r\n（依据项目任务要求，结合国内外技术发展和本单位实际情况确定，论证前应充分分析和阐述技术方案与技术路线，对不同方案和路线加以比较和论证说明。）\r\n（依据项目任务要求，结合国内外技术发展和本单位实际情况确定，论证前应充分分析和阐述技术方案与技术路线，对不同方案和路线加以比较和论证说明。）\r\n（依据项目任务要求，结合国内外技术发展和本单位实际情况确定，论证前应充分分析和阐述技术方案与技术路线，对不同方案和路线加以比较和论证说明。）\r\n（依据项目任务要求，结合国内外技术发展和本单位实际情况确定，论证前应充分分析和阐述技术方案与技术路线，对不同方案和路线加以比较和论证说明。）\r\n（依据项目任务要求，结合国内外技术发展和本单位实际情况确定，论证前应充分分析和阐述技术方案与技术路线，对不同方案和路线加以比较和论证说明。）\r\n（依据项目任务要求，结合国内外技术发展和本单位实际情况确定，论证前应充分分析和阐述技术方案与技术路线，对不同方案和路线加以比较和论证说明。）\r\n（依据项目任务要求，结合国内外技术发展和本单位实际情况确定，论证前应充分分析和阐述技术方案与技术路线，对不同方案和路线加以比较和论证说明。）\r\n（依据项目任务要求，结合国内外技术发展和本单位实际情况确定，论证前应充分分析和阐述技术方案与技术路线，对不同方案和路线加以比较和论证说明。）\r\n（依据项目任务要求，结合国内外技术发展和本单位实际情况确定，论证前应充分分析和阐述技术方案与技术路线，对不同方案和路线加以比较和论证说明。）\r\n（依据项目任务要求，结合国内外技术发展和本单位实际情况确定，论证前应充分分析和阐述技术方案与技术路线，对不同方案和路线加以比较和论证说明。）\r\n（依据项目任务要求，结合国内外技术发展和本单位实际情况确定，论证前应充分分析和阐述技术方案与技术路线，对不同方案和路线加以比较和论证说明。）\r\n（依据项目任务要求，结合国内外技术发展和本单位实际情况确定，论证前应充分分析和阐述技术方案与技术路线，对不同方案和路线加以比较和论证说明。）\r\n（依据项目任务要求，结合国内外技术发展和本单位实际情况确定，论证前应充分分析和阐述技术方案与技术路线，对不同方案和路线加以比较和论证说明。）\r\n（依据项目任务要求，结合国内外技术发展和本单位实际情况确定，论证前应充分分析和阐述技术方案与技术路线，对不同方案和路线加以比较和论证说明。）\r\n（依据项目任务要求，结合国内外技术发展和本单位实际情况确定，论证前应充分分析和阐述技术方案与技术路线，对不同方案和路线加以比较和论证说明。）\r\n（依据项目任务要求，结合国内外技术发展和本单位实际情况确定，论证前应充分分析和阐述技术方案与技术路线，对不同方案和路线加以比较和论证说明。）\r\n',NULL,12,NULL,'dev1453101496',NULL,NULL,NULL,'1\r\n2\r\n3\r\n4\r\n5\r\n6\r\n7\r\n8\r\n9\r\n10\r\n11\r\n12\r\n13\r\n14\r\n15\r\n16\r\n17\r\n18\r\n19\r\n20\r\n21\r\n22\r\n23\r\n24\r\n25','项目任务','项目目标','考核指标','  （项目主要研发内容、关键技术及创新点，对完成项目目标和考核指标的重要性）\r\n  （项目主要研发内容、关键技术及创新点，对完成项目目标和考核指标的重要性）\r\n  （项目主要研发内容、关键技术及创新点，对完成项目目标和考核指标的重要性）\r\n  （项目主要研发内容、关键技术及创新点，对完成项目目标和考核指标的重要性）\r\n  （项目主要研发内容、关键技术及创新点，对完成项目目标和考核指标的重要性）\r\n  （项目主要研发内容、关键技术及创新点，对完成项目目标和考核指标的重要性）\r\n  （项目主要研发内容、关键技术及创新点，对完成项目目标和考核指标的重要性）\r\n  （项目主要研发内容、关键技术及创新点，对完成项目目标和考核指标的重要性）\r\n  （项目主要研发内容、关键技术及创新点，对完成项目目标和考核指标的重要性）\r\n  （项目主要研发内容、关键技术及创新点，对完成项目目标和考核指标的重要性）\r\n  （项目主要研发内容、关键技术及创新点，对完成项目目标和考核指标的重要性）\r\n  （项目主要研发内容、关键技术及创新点，对完成项目目标和考核指标的重要性）\r\n  （项目主要研发内容、关键技术及创新点，对完成项目目标和考核指标的重要性）\r\n  （项目主要研发内容、关键技术及创新点，对完成项目目标和考核指标的重要性）\r\n  （项目主要研发内容、关键技术及创新点，对完成项目目标和考核指标的重要性）\r\n  （项目主要研发内容、关键技术及创新点，对完成项目目标和考核指标的重要性）\r\n  （项目主要研发内容、关键技术及创新点，对完成项目目标和考核指标的重要性）\r\n  （项目主要研发内容、关键技术及创新点，对完成项目目标和考核指标的重要性）\r\n  （项目主要研发内容、关键技术及创新点，对完成项目目标和考核指标的重要性）\r\n  （项目主要研发内容、关键技术及创新点，对完成项目目标和考核指标的重要性）\r\n  （项目主要研发内容、关键技术及创新点，对完成项目目标和考核指标的重要性）\r\n  （项目主要研发内容、关键技术及创新点，对完成项目目标和考核指标的重要性）\r\n  （项目主要研发内容、关键技术及创新点，对完成项目目标和考核指标的重要性）\r\n  （项目主要研发内容、关键技术及创新点，对完成项目目标和考核指标的重要性）\r\n  （项目主要研发内容、关键技术及创新点，对完成项目目标和考核指标的重要性）\r\n  （项目主要研发内容、关键技术及创新点，对完成项目目标和考核指标的重要性）\r\n  （项目主要研发内容、关键技术及创新点，对完成项目目标和考核指标的重要性）\r\n  （项目主要研发内容、关键技术及创新点，对完成项目目标和考核指标的重要性）\r\n  （项目主要研发内容、关键技术及创新点，对完成项目目标和考核指标的重要性）\r\n  （项目主要研发内容、关键技术及创新点，对完成项目目标和考核指标的重要性）\r\n  （项目主要研发内容、关键技术及创新点，对完成项目目标和考核指标的重要性）\r\n  （项目主要研发内容、关键技术及创新点，对完成项目目标和考核指标的重要性）\r\n','项目研究开发内容','1\r\n2\r\n3\r\n4\r\n5\r\n6\r\n7\r\n8\r\n9\r\n10\r\n11\r\n12\r\n13\r\n14\r\n15\r\n16\r\n17\r\n18\r\n19\r\n20\r\n21\r\n22\r\n23\r\n24\r\n25','1\r\n2\r\n3\r\n4\r\n5\r\n6\r\n7\r\n8\r\n9\r\n10\r\n11\r\n12\r\n13\r\n14\r\n15\r\n16\r\n17\r\n18\r\n19\r\n20\r\n21\r\n22\r\n23\r\n24\r\n25','1\r\n2\r\n3\r\n4\r\n5\r\n6\r\n7\r\n8\r\n9\r\n10\r\n11\r\n12\r\n13\r\n14\r\n15\r\n16\r\n17\r\n18\r\n19\r\n20\r\n21\r\n22\r\n23\r\n24\r\n25','1、    （风险含市场风险、技术风险、政策风险、管理风险等，风险分析需说明有可能存在的风险。）\r\n1、    （风险含市场风险、技术风险、政策风险、管理风险等，风险分析需说明有可能存在的风险。）\r\n1、    （风险含市场风险、技术风险、政策风险、管理风险等，风险分析需说明有可能存在的风险。）\r\n1、    （风险含市场风险、技术风险、政策风险、管理风险等，风险分析需说明有可能存在的风险。）\r\n1、    （风险含市场风险、技术风险、政策风险、管理风险等，风险分析需说明有可能存在的风险。）\r\n1、    （风险含市场风险、技术风险、政策风险、管理风险等，风险分析需说明有可能存在的风险。）\r\n1、    （风险含市场风险、技术风险、政策风险、管理风险等，风险分析需说明有可能存在的风险。）\r\n1、    （风险含市场风险、技术风险、政策风险、管理风险等，风险分析需说明有可能存在的风险。）\r\n1、    （风险含市场风险、技术风险、政策风险、管理风险等，风险分析需说明有可能存在的风险。）\r\n1、    （风险含市场风险、技术风险、政策风险、管理风险等，风险分析需说明有可能存在的风险。）\r\n1、    （风险含市场风险、技术风险、政策风险、管理风险等，风险分析需说明有可能存在的风险。）\r\n1、    （风险含市场风险、技术风险、政策风险、管理风险等，风险分析需说明有可能存在的风险。）\r\n1、    （风险含市场风险、技术风险、政策风险、管理风险等，风险分析需说明有可能存在的风险。）\r\n1、    （风险含市场风险、技术风险、政策风险、管理风险等，风险分析需说明有可能存在的风险。）\r\n1、    （风险含市场风险、技术风险、政策风险、管理风险等，风险分析需说明有可能存在的风险。）\r\n1、    （风险含市场风险、技术风险、政策风险、管理风险等，风险分析需说明有可能存在的风险。）\r\n1、    （风险含市场风险、技术风险、政策风险、管理风险等，风险分析需说明有可能存在的风险。）\r\n1、    （风险含市场风险、技术风险、政策风险、管理风险等，风险分析需说明有可能存在的风险。）\r\n1、    （风险含市场风险、技术风险、政策风险、管理风险等，风险分析需说明有可能存在的风险。）\r\n1、    （风险含市场风险、技术风险、政策风险、管理风险等，风险分析需说明有可能存在的风险。）\r\n1、    （风险含市场风险、技术风险、政策风险、管理风险等，风险分析需说明有可能存在的风险。）\r\n1、    （风险含市场风险、技术风险、政策风险、管理风险等，风险分析需说明有可能存在的风险。）\r\n1、    （风险含市场风险、技术风险、政策风险、管理风险等，风险分析需说明有可能存在的风险。）\r\n1、    （风险含市场风险、技术风险、政策风险、管理风险等，风险分析需说明有可能存在的风险。）\r\n1、    （风险含市场风险、技术风险、政策风险、管理风险等，风险分析需说明有可能存在的风险。）\r\n1、    （风险含市场风险、技术风险、政策风险、管理风险等，风险分析需说明有可能存在的风险。）\r\n1、    （风险含市场风险、技术风险、政策风险、管理风险等，风险分析需说明有可能存在的风险。）\r\n1、    （风险含市场风险、技术风险、政策风险、管理风险等，风险分析需说明有可能存在的风险。）\r\n1、    （风险含市场风险、技术风险、政策风险、管理风险等，风险分析需说明有可能存在的风险。）\r\n1、    （风险含市场风险、技术风险、政策风险、管理风险等，风险分析需说明有可能存在的风险。）\r\n1、    （风险含市场风险、技术风险、政策风险、管理风险等，风险分析需说明有可能存在的风险。）\r\n1、    （风险含市场风险、技术风险、政策风险、管理风险等，风险分析需说明有可能存在的风险。）\r\n','预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理\r\n\r\n\r\n预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理\r\n预期成果形式、知识产权归属于管理\r\n预期成果形式、知识产权归属于管理\r\n预期成果形式、知识产权归属于管理\r\n预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理','1\r\n2\r\n3\r\n4\r\n5\r\n6\r\n7\r\n8\r\n9\r\n10\r\n11\r\n12\r\n13\r\n14\r\n15\r\n16\r\n17\r\n18\r\n19\r\n20\r\n21\r\n22\r\n23\r\n24\r\n25','1\r\n2\r\n3\r\n4\r\n5\r\n6\r\n7\r\n8\r\n9\r\n10\r\n11\r\n12\r\n13\r\n14\r\n15\r\n16\r\n17\r\n18\r\n19\r\n20\r\n21\r\n22\r\n23\r\n24\r\n25',NULL,'论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论论论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论论论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论论论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论论论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论论论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论论论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论论论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论论论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论论论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论论论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论论论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论论论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论论论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论论论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论论论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论论论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论论论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论论论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论论论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论论论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论论论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论论论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论论论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论论论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论论论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论论论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论论论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论证意见论论意见证意见论证意见','（论证意见）\r\n（论证意见）\r\n（论证意见）\r\n（论证意见）\r\n（论证意见）\r\n（论证意见）\r\n（论证意见）\r\n（论证意见）\r\n（论证意见）\r\n（论证意见）\r\n（论证意见）\r\n（论证意见）\r\n（论证意见）\r\n（论证意见）\r\n（论证意见）\r\n（论证意见）\r\n（论证意见）\r\n',NULL,NULL,NULL,NULL,'项目相关行业、领域国内外研究发展现状、趋势以及本单位在相关领域的工作基础项目相关行业、领域国内外研究发展现状、趋势以及本单位在相关领域的工作基础项目相关行业、领域国内外研究发展现状、趋势以及本单位在相关领域的工作基础项目相关行业、领域国内外研究发展现状、趋势以及本单位在相关领域的工作基础项目相关行业、领域国内外研究发展现状、趋势以及本单位在相关领域的工作基础项目相关行业、领域国内外研究发展现状、趋势以及本单位在相关领域的工作基础项目相关行业、领域国内外研究发展现状、趋势以及本单位在相关领域的工作基础项目相关行业、领域国内外研究发展现状、趋势以及本单位在相关领域的工作基础项目相关行业、领域国内外研究发展现状、趋势以及本单位在相关领域的工作基础项目相关行业、领域国内外研究发展现状、趋势以及本单位在相关领域的工作基础项目相关行业、领域国内外研究发展现状、趋势以及本单位在相关领域的工作基础项目相关行业、领域国内外研究发展现状、趋势以及本单位在相关领域的工作基础','6',NULL,'11其他条款。。。。。。','KJ2016CX003',0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'密码：123','支持创新平台建设项目_马闯test1',NULL,NULL,NULL,3,1,'发展计划科','马闯',NULL,'环境保护',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'0,1,2,3',NULL,'申报项目','2016-01-18',0,'1453101496',0,NULL,'1、项目任务：（项目任务应明确科技工作在解决实际问题中的责任和完成工作的范围、界限，即项目全部工作和成果的整体描述。）1、项目任务：（项目任务应明确科技工作在解决实际问题中的责任和完成工作的范围、界限，即项目全部工作和成果的整体描述。）1、项目任务：（项目任务应明确科技工作在解决实际问题中的责任和完成工作的范围、界限，即项目全部工作和成果的整体描述。）1、项目任务：（项目任务应明确科技工作在解决实际问题中的责任和完成工作的范围、界限，即项目全部工作和成果的整体描述。）1、项目任务：（项目任务应明确科技工作在解决实际问题中的责任和完成工作的范围、界限，即项目全部工作和成果的整体描述。）1、项目任务：（项目任务应明确科技工作在解决实际问题中的责任和完成工作的范围、界限，即项目全部工作和成果的整体描述。）1、项目任务：（项目任务应明确科技工作在解决实际问题中的责任和完成工作的范围、界限，即项目全部工作和成果的整体描述。）1、项目任务：（项目任务应明确科技工作在解决实际问题中的责任和完成工作的范围、界限，即项目全部工作和成果的整体描述。）1、项目任务：（项目任务应明确科技工作在解决实际问题中的责任和完成工作的范围、界限，即项目全部工作和成果的整体描述。）1、项目任务：（项目任务应明确科技工作在解决实际问题中的责任和完成工作的范围、界限，即项目全部工作和成果的整体描述。）1、项目任务：（项目任务应明确科技工作在解决实际问题中的责任和完成工作的范围、界限，即项目全部工作和成果的整体描述。）1、项目任务：（项目任务应明确科技工作在解决实际问题中的责任和完成工作的范围、界限，即项目全部工作和成果的整体描述。）1、项目任务：（项目任务应明确科技工作在解决实际问题中的责任和完成工作的范围、界限，即项目全部工作和成果的整体描述。）1、项目任务：（项目任务应明确科技工作在解决实际问题中的责任和完成工作的范围、界限，即项目全部工作和成果的整体描述。）1、项目任务：（项目任务应明确科技工作在解决实际问题中的责任和完成工作的范围、界限，即项目全部工作和成果的整体描述。）1、项目任务：（项目任务应明确科技工作在解决实际问题中的责任和完成工作的范围、界限，即项目全部工作和成果的整体描述。）1、项目任务：（项目任务应明确科技工作在解决实际问题中的责任和完成工作的范围、界限，即项目全部工作和成果的整体描述。）1、项目任务：（项目任务应明确科技工作在解决实际问题中的责任和完成工作的范围、界限，即项目全部工作和成果的整体描述。）1、项目任务：（项目任务应明确科技工作在解决实际问题中的责任和完成工作的范围、界限，即项目全部工作和成果的整体描述。）1、项目任务：（项目任务应明确科技工作在解决实际问题中的责任和完成工作的范围、界限，即项目全部工作和成果的整体描述。）1、项目任务：（项目任务应明确科技工作在解决实际问题中的责任和完成工作的范围、界限，即项目全部工作和成果的整体描述。）1、项目任务：（项目任务应明确科技工作在解决实际问题中的责任和完成工作的范围、界限，即项目全部工作和成果的整体描述。）1、项目任务：（项目任务应明确科技工作在解决实际问题中的责任和完成工作的范围、界限，即项目全部工作和成果的整体描述。）1、项目任务：（项目任务应明确科技工作在解决实际问题中的责任和完成工作的范围、界限，即项目全部工作和成果的整体描述。）1、项目任务：（项目任务应明确科技工作在解决实际问题中的责任和完成工作的范围、界限，即项目全部工作和成果的整体描述。）1、项目任务：（项目任务应明确科技工作在解决实际问题中的责任和完成工作的范围、界限，即项目全部工作和成果的整体描述。）1、项目任务：（项目任务应明确科技工作在解决实际问题中的责任和完成工作的范围、界限，即项目全部工作和成果的整体描述。）1、项目任务：（项目任务应明确科技工作在解决实际问题中的责任和完成工作的范围、界限，即项目全部工作和成果的整体描述。）1、项目任务：（项目任务应明确科技工作在解决实际问题中的责任和完成工作的范围、界限，即项目全部工作和成果的整体描述。）1、项目任务：（项目任务应明确科技工作在解决实际问题中的责任和完成工作的范围、界限，即项目全部工作和成果的整体描述。）1、项目任务：（项目任务应明确科技工作在解决实际问题中的责任和完成工作的范围、界限，即项目全部工作和成果的整体描述。）1、项目任务：（项目任务应明确科技工作在解决实际问题中的责任和完成工作的范围、界限，即项目全部工作和成果的整体描述。）1、项目任务：（项目任务应明确科技工作在解决实际问题中的责任和完成工作的范围、界限，即项目全部工作和成果的整体描述。）1、项目任务：（项目任务应明确科技工作在解决实际问题中的责任和完成工作的范围、界限，即项目全部工作和成果的整体描述。）','2、项目目标：（项目目标内容应完整、明确，并能够考查项目完成的程度和实际效果。包括定性、定量两个部分，定性的内容应概括项目预期效果的几个方面，定量的内容应说明预期效果的程度和范围。）\r\n2、项目目标：（项目目标内容应完整、明确，并能够考查项目完成的程度和实际效果。包括定性、定量两个部分，定性的内容应概括项目预期效果的几个方面，定量的内容应说明预期效果的程度和范围。）\r\n2、项目目标：（项目目标内容应完整、明确，并能够考查项目完成的程度和实际效果。包括定性、定量两个部分，定性的内容应概括项目预期效果的几个方面，定量的内容应说明预期效果的程度和范围。）\r\n2、项目目标：（项目目标内容应完整、明确，并能够考查项目完成的程度和实际效果。包括定性、定量两个部分，定性的内容应概括项目预期效果的几个方面，定量的内容应说明预期效果的程度和范围。）\r\n2、项目目标：（项目目标内容应完整、明确，并能够考查项目完成的程度和实际效果。包括定性、定量两个部分，定性的内容应概括项目预期效果的几个方面，定量的内容应说明预期效果的程度和范围。）\r\n2、项目目标：（项目目标内容应完整、明确，并能够考查项目完成的程度和实际效果。包括定性、定量两个部分，定性的内容应概括项目预期效果的几个方面，定量的内容应说明预期效果的程度和范围。）\r\n2、项目目标：（项目目标内容应完整、明确，并能够考查项目完成的程度和实际效果。包括定性、定量两个部分，定性的内容应概括项目预期效果的几个方面，定量的内容应说明预期效果的程度和范围。）\r\n2、项目目标：（项目目标内容应完整、明确，并能够考查项目完成的程度和实际效果。包括定性、定量两个部分，定性的内容应概括项目预期效果的几个方面，定量的内容应说明预期效果的程度和范围。）\r\n2、项目目标：（项目目标内容应完整、明确，并能够考查项目完成的程度和实际效果。包括定性、定量两个部分，定性的内容应概括项目预期效果的几个方面，定量的内容应说明预期效果的程度和范围。）\r\n2、项目目标：（项目目标内容应完整、明确，并能够考查项目完成的程度和实际效果。包括定性、定量两个部分，定性的内容应概括项目预期效果的几个方面，定量的内容应说明预期效果的程度和范围。）\r\n2、项目目标：（项目目标内容应完整、明确，并能够考查项目完成的程度和实际效果。包括定性、定量两个部分，定性的内容应概括项目预期效果的几个方面，定量的内容应说明预期效果的程度和范围。）\r\n2、项目目标：（项目目标内容应完整、明确，并能够考查项目完成的程度和实际效果。包括定性、定量两个部分，定性的内容应概括项目预期效果的几个方面，定量的内容应说明预期效果的程度和范围。）\r\n2、项目目标：（项目目标内容应完整、明确，并能够考查项目完成的程度和实际效果。包括定性、定量两个部分，定性的内容应概括项目预期效果的几个方面，定量的内容应说明预期效果的程度和范围。）\r\n2、项目目标：（项目目标内容应完整、明确，并能够考查项目完成的程度和实际效果。包括定性、定量两个部分，定性的内容应概括项目预期效果的几个方面，定量的内容应说明预期效果的程度和范围。）\r\n2、项目目标：（项目目标内容应完整、明确，并能够考查项目完成的程度和实际效果。包括定性、定量两个部分，定性的内容应概括项目预期效果的几个方面，定量的内容应说明预期效果的程度和范围。）\r\n2、项目目标：（项目目标内容应完整、明确，并能够考查项目完成的程度和实际效果。包括定性、定量两个部分，定性的内容应概括项目预期效果的几个方面，定量的内容应说明预期效果的程度和范围。）\r\n2、项目目标：（项目目标内容应完整、明确，并能够考查项目完成的程度和实际效果。包括定性、定量两个部分，定性的内容应概括项目预期效果的几个方面，定量的内容应说明预期效果的程度和范围。）\r\n2、项目目标：（项目目标内容应完整、明确，并能够考查项目完成的程度和实际效果。包括定性、定量两个部分，定性的内容应概括项目预期效果的几个方面，定量的内容应说明预期效果的程度和范围。）\r\n2、项目目标：（项目目标内容应完整、明确，并能够考查项目完成的程度和实际效果。包括定性、定量两个部分，定性的内容应概括项目预期效果的几个方面，定量的内容应说明预期效果的程度和范围。）\r\n2、项目目标：（项目目标内容应完整、明确，并能够考查项目完成的程度和实际效果。包括定性、定量两个部分，定性的内容应概括项目预期效果的几个方面，定量的内容应说明预期效果的程度和范围。）\r\n2、项目目标：（项目目标内容应完整、明确，并能够考查项目完成的程度和实际效果。包括定性、定量两个部分，定性的内容应概括项目预期效果的几个方面，定量的内容应说明预期效果的程度和范围。）\r\n2、项目目标：（项目目标内容应完整、明确，并能够考查项目完成的程度和实际效果。包括定性、定量两个部分，定性的内容应概括项目预期效果的几个方面，定量的内容应说明预期效果的程度和范围。）\r\n2、项目目标：（项目目标内容应完整、明确，并能够考查项目完成的程度和实际效果。包括定性、定量两个部分，定性的内容应概括项目预期效果的几个方面，定量的内容应说明预期效果的程度和范围。）\r\n2、项目目标：（项目目标内容应完整、明确，并能够考查项目完成的程度和实际效果。包括定性、定量两个部分，定性的内容应概括项目预期效果的几个方面，定量的内容应说明预期效果的程度和范围。）\r\n2、项目目标：（项目目标内容应完整、明确，并能够考查项目完成的程度和实际效果。包括定性、定量两个部分，定性的内容应概括项目预期效果的几个方面，定量的内容应说明预期效果的程度和范围。）\r\n','3、考核指标：（考核指标应体现项目目标预期完成程度和水平，以及对项目各项研究开发内容预期完成情况的考核。指标体系应系统、完整，客观可检查） （项目目标和考核指标应能够系统、完整地表达任务完成情况，具有成果的依附形式或载体，体现实际效果，可查、可测、可看。）\r\n3、考核指标：（考核指标应体现项目目标预期完成程度和水平，以及对项目各项研究开发内容预期完成情况的考核。指标体系应系统、完整，客观可检查） （项目目标和考核指标应能够系统、完整地表达任务完成情况，具有成果的依附形式或载体，体现实际效果，可查、可测、可看。）\r\n3、考核指标：（考核指标应体现项目目标预期完成程度和水平，以及对项目各项研究开发内容预期完成情况的考核。指标体系应系统、完整，客观可检查） （项目目标和考核指标应能够系统、完整地表达任务完成情况，具有成果的依附形式或载体，体现实际效果，可查、可测、可看。）\r\n3、考核指标：（考核指标应体现项目目标预期完成程度和水平，以及对项目各项研究开发内容预期完成情况的考核。指标体系应系统、完整，客观可检查） （项目目标和考核指标应能够系统、完整地表达任务完成情况，具有成果的依附形式或载体，体现实际效果，可查、可测、可看。）\r\n3、考核指标：（考核指标应体现项目目标预期完成程度和水平，以及对项目各项研究开发内容预期完成情况的考核。指标体系应系统、完整，客观可检查） （项目目标和考核指标应能够系统、完整地表达任务完成情况，具有成果的依附形式或载体，体现实际效果，可查、可测、可看。）\r\n3、考核指标：（考核指标应体现项目目标预期完成程度和水平，以及对项目各项研究开发内容预期完成情况的考核。指标体系应系统、完整，客观可检查） （项目目标和考核指标应能够系统、完整地表达任务完成情况，具有成果的依附形式或载体，体现实际效果，可查、可测、可看。）\r\n3、考核指标：（考核指标应体现项目目标预期完成程度和水平，以及对项目各项研究开发内容预期完成情况的考核。指标体系应系统、完整，客观可检查） （项目目标和考核指标应能够系统、完整地表达任务完成情况，具有成果的依附形式或载体，体现实际效果，可查、可测、可看。）\r\n3、考核指标：（考核指标应体现项目目标预期完成程度和水平，以及对项目各项研究开发内容预期完成情况的考核。指标体系应系统、完整，客观可检查） （项目目标和考核指标应能够系统、完整地表达任务完成情况，具有成果的依附形式或载体，体现实际效果，可查、可测、可看。）\r\n3、考核指标：（考核指标应体现项目目标预期完成程度和水平，以及对项目各项研究开发内容预期完成情况的考核。指标体系应系统、完整，客观可检查） （项目目标和考核指标应能够系统、完整地表达任务完成情况，具有成果的依附形式或载体，体现实际效果，可查、可测、可看。）\r\n3、考核指标：（考核指标应体现项目目标预期完成程度和水平，以及对项目各项研究开发内容预期完成情况的考核。指标体系应系统、完整，客观可检查） （项目目标和考核指标应能够系统、完整地表达任务完成情况，具有成果的依附形式或载体，体现实际效果，可查、可测、可看。）\r\n3、考核指标：（考核指标应体现项目目标预期完成程度和水平，以及对项目各项研究开发内容预期完成情况的考核。指标体系应系统、完整，客观可检查） （项目目标和考核指标应能够系统、完整地表达任务完成情况，具有成果的依附形式或载体，体现实际效果，可查、可测、可看。）\r\n3、考核指标：（考核指标应体现项目目标预期完成程度和水平，以及对项目各项研究开发内容预期完成情况的考核。指标体系应系统、完整，客观可检查） （项目目标和考核指标应能够系统、完整地表达任务完成情况，具有成果的依附形式或载体，体现实际效果，可查、可测、可看。）\r\n3、考核指标：（考核指标应体现项目目标预期完成程度和水平，以及对项目各项研究开发内容预期完成情况的考核。指标体系应系统、完整，客观可检查） （项目目标和考核指标应能够系统、完整地表达任务完成情况，具有成果的依附形式或载体，体现实际效果，可查、可测、可看。）\r\n3、考核指标：（考核指标应体现项目目标预期完成程度和水平，以及对项目各项研究开发内容预期完成情况的考核。指标体系应系统、完整，客观可检查） （项目目标和考核指标应能够系统、完整地表达任务完成情况，具有成果的依附形式或载体，体现实际效果，可查、可测、可看。）\r\n3、考核指标：（考核指标应体现项目目标预期完成程度和水平，以及对项目各项研究开发内容预期完成情况的考核。指标体系应系统、完整，客观可检查） （项目目标和考核指标应能够系统、完整地表达任务完成情况，具有成果的依附形式或载体，体现实际效果，可查、可测、可看。）\r\n3、考核指标：（考核指标应体现项目目标预期完成程度和水平，以及对项目各项研究开发内容预期完成情况的考核。指标体系应系统、完整，客观可检查） （项目目标和考核指标应能够系统、完整地表达任务完成情况，具有成果的依附形式或载体，体现实际效果，可查、可测、可看。）\r\n3、考核指标：（考核指标应体现项目目标预期完成程度和水平，以及对项目各项研究开发内容预期完成情况的考核。指标体系应系统、完整，客观可检查） （项目目标和考核指标应能够系统、完整地表达任务完成情况，具有成果的依附形式或载体，体现实际效果，可查、可测、可看。）\r\n3、考核指标：（考核指标应体现项目目标预期完成程度和水平，以及对项目各项研究开发内容预期完成情况的考核。指标体系应系统、完整，客观可检查） （项目目标和考核指标应能够系统、完整地表达任务完成情况，具有成果的依附形式或载体，体现实际效果，可查、可测、可看。）\r\n3、考核指标：（考核指标应体现项目目标预期完成程度和水平，以及对项目各项研究开发内容预期完成情况的考核。指标体系应系统、完整，客观可检查） （项目目标和考核指标应能够系统、完整地表达任务完成情况，具有成果的依附形式或载体，体现实际效果，可查、可测、可看。）\r\n3、考核指标：（考核指标应体现项目目标预期完成程度和水平，以及对项目各项研究开发内容预期完成情况的考核。指标体系应系统、完整，客观可检查） （项目目标和考核指标应能够系统、完整地表达任务完成情况，具有成果的依附形式或载体，体现实际效果，可查、可测、可看。）\r\n3、考核指标：（考核指标应体现项目目标预期完成程度和水平，以及对项目各项研究开发内容预期完成情况的考核。指标体系应系统、完整，客观可检查） （项目目标和考核指标应能够系统、完整地表达任务完成情况，具有成果的依附形式或载体，体现实际效果，可查、可测、可看。）\r\n3、考核指标：（考核指标应体现项目目标预期完成程度和水平，以及对项目各项研究开发内容预期完成情况的考核。指标体系应系统、完整，客观可检查） （项目目标和考核指标应能够系统、完整地表达任务完成情况，具有成果的依附形式或载体，体现实际效果，可查、可测、可看。）\r\n3、考核指标：（考核指标应体现项目目标预期完成程度和水平，以及对项目各项研究开发内容预期完成情况的考核。指标体系应系统、完整，客观可检查） （项目目标和考核指标应能够系统、完整地表达任务完成情况，具有成果的依附形式或载体，体现实际效果，可查、可测、可看。）\r\n3、考核指标：（考核指标应体现项目目标预期完成程度和水平，以及对项目各项研究开发内容预期完成情况的考核。指标体系应系统、完整，客观可检查） （项目目标和考核指标应能够系统、完整地表达任务完成情况，具有成果的依附形式或载体，体现实际效果，可查、可测、可看。）\r\n','（项目的组织管理和协调措施应能保障项目的正常实施；应能落实项目实施所需配套条件；项目负责人应能切实履行项目管理职责；应能落实项目任务所需的研究团队和配套仪器设备、经费等条件，有完善的科技管理制度。）\r\n（项目的组织管理和协调措施应能保障项目的正常实施；应能落实项目实施所需配套条件；项目负责人应能切实履行项目管理职责；应能落实项目任务所需的研究团队和配套仪器设备、经费等条件，有完善的科技管理制度。）\r\n（项目的组织管理和协调措施应能保障项目的正常实施；应能落实项目实施所需配套条件；项目负责人应能切实履行项目管理职责；应能落实项目任务所需的研究团队和配套仪器设备、经费等条件，有完善的科技管理制度。）\r\n（项目的组织管理和协调措施应能保障项目的正常实施；应能落实项目实施所需配套条件；项目负责人应能切实履行项目管理职责；应能落实项目任务所需的研究团队和配套仪器设备、经费等条件，有完善的科技管理制度。）\r\n（项目的组织管理和协调措施应能保障项目的正常实施；应能落实项目实施所需配套条件；项目负责人应能切实履行项目管理职责；应能落实项目任务所需的研究团队和配套仪器设备、经费等条件，有完善的科技管理制度。）\r\n（项目的组织管理和协调措施应能保障项目的正常实施；应能落实项目实施所需配套条件；项目负责人应能切实履行项目管理职责；应能落实项目任务所需的研究团队和配套仪器设备、经费等条件，有完善的科技管理制度。）\r\n（项目的组织管理和协调措施应能保障项目的正常实施；应能落实项目实施所需配套条件；项目负责人应能切实履行项目管理职责；应能落实项目任务所需的研究团队和配套仪器设备、经费等条件，有完善的科技管理制度。）\r\n（项目的组织管理和协调措施应能保障项目的正常实施；应能落实项目实施所需配套条件；项目负责人应能切实履行项目管理职责；应能落实项目任务所需的研究团队和配套仪器设备、经费等条件，有完善的科技管理制度。）\r\n（项目的组织管理和协调措施应能保障项目的正常实施；应能落实项目实施所需配套条件；项目负责人应能切实履行项目管理职责；应能落实项目任务所需的研究团队和配套仪器设备、经费等条件，有完善的科技管理制度。）\r\n（项目的组织管理和协调措施应能保障项目的正常实施；应能落实项目实施所需配套条件；项目负责人应能切实履行项目管理职责；应能落实项目任务所需的研究团队和配套仪器设备、经费等条件，有完善的科技管理制度。）\r\n（项目的组织管理和协调措施应能保障项目的正常实施；应能落实项目实施所需配套条件；项目负责人应能切实履行项目管理职责；应能落实项目任务所需的研究团队和配套仪器设备、经费等条件，有完善的科技管理制度。）\r\n（项目的组织管理和协调措施应能保障项目的正常实施；应能落实项目实施所需配套条件；项目负责人应能切实履行项目管理职责；应能落实项目任务所需的研究团队和配套仪器设备、经费等条件，有完善的科技管理制度。）\r\n（项目的组织管理和协调措施应能保障项目的正常实施；应能落实项目实施所需配套条件；项目负责人应能切实履行项目管理职责；应能落实项目任务所需的研究团队和配套仪器设备、经费等条件，有完善的科技管理制度。）\r\n（项目的组织管理和协调措施应能保障项目的正常实施；应能落实项目实施所需配套条件；项目负责人应能切实履行项目管理职责；应能落实项目任务所需的研究团队和配套仪器设备、经费等条件，有完善的科技管理制度。）\r\n（项目的组织管理和协调措施应能保障项目的正常实施；应能落实项目实施所需配套条件；项目负责人应能切实履行项目管理职责；应能落实项目任务所需的研究团队和配套仪器设备、经费等条件，有完善的科技管理制度。）\r\n（项目的组织管理和协调措施应能保障项目的正常实施；应能落实项目实施所需配套条件；项目负责人应能切实履行项目管理职责；应能落实项目任务所需的研究团队和配套仪器设备、经费等条件，有完善的科技管理制度。）\r\n（项目的组织管理和协调措施应能保障项目的正常实施；应能落实项目实施所需配套条件；项目负责人应能切实履行项目管理职责；应能落实项目任务所需的研究团队和配套仪器设备、经费等条件，有完善的科技管理制度。）\r\n（项目的组织管理和协调措施应能保障项目的正常实施；应能落实项目实施所需配套条件；项目负责人应能切实履行项目管理职责；应能落实项目任务所需的研究团队和配套仪器设备、经费等条件，有完善的科技管理制度。）\r\n（项目的组织管理和协调措施应能保障项目的正常实施；应能落实项目实施所需配套条件；项目负责人应能切实履行项目管理职责；应能落实项目任务所需的研究团队和配套仪器设备、经费等条件，有完善的科技管理制度。）\r\n（项目的组织管理和协调措施应能保障项目的正常实施；应能落实项目实施所需配套条件；项目负责人应能切实履行项目管理职责；应能落实项目任务所需的研究团队和配套仪器设备、经费等条件，有完善的科技管理制度。）\r\n（项目的组织管理和协调措施应能保障项目的正常实施；应能落实项目实施所需配套条件；项目负责人应能切实履行项目管理职责；应能落实项目任务所需的研究团队和配套仪器设备、经费等条件，有完善的科技管理制度。）\r\n（项目的组织管理和协调措施应能保障项目的正常实施；应能落实项目实施所需配套条件；项目负责人应能切实履行项目管理职责；应能落实项目任务所需的研究团队和配套仪器设备、经费等条件，有完善的科技管理制度。）\r\n（项目的组织管理和协调措施应能保障项目的正常实施；应能落实项目实施所需配套条件；项目负责人应能切实履行项目管理职责；应能落实项目任务所需的研究团队和配套仪器设备、经费等条件，有完善的科技管理制度。）\r\n（项目的组织管理和协调措施应能保障项目的正常实施；应能落实项目实施所需配套条件；项目负责人应能切实履行项目管理职责；应能落实项目任务所需的研究团队和配套仪器设备、经费等条件，有完善的科技管理制度。）\r\n（项目的组织管理和协调措施应能保障项目的正常实施；应能落实项目实施所需配套条件；项目负责人应能切实履行项目管理职责；应能落实项目任务所需的研究团队和配套仪器设备、经费等条件，有完善的科技管理制度。）\r\n（项目的组织管理和协调措施应能保障项目的正常实施；应能落实项目实施所需配套条件；项目负责人应能切实履行项目管理职责；应能落实项目任务所需的研究团队和配套仪器设备、经费等条件，有完善的科技管理制度。）\r\n（项目的组织管理和协调措施应能保障项目的正常实施；应能落实项目实施所需配套条件；项目负责人应能切实履行项目管理职责；应能落实项目任务所需的研究团队和配套仪器设备、经费等条件，有完善的科技管理制度。）\r\n（项目的组织管理和协调措施应能保障项目的正常实施；应能落实项目实施所需配套条件；项目负责人应能切实履行项目管理职责；应能落实项目任务所需的研究团队和配套仪器设备、经费等条件，有完善的科技管理制度。）\r\n（项目的组织管理和协调措施应能保障项目的正常实施；应能落实项目实施所需配套条件；项目负责人应能切实履行项目管理职责；应能落实项目任务所需的研究团队和配套仪器设备、经费等条件，有完善的科技管理制度。）\r\n（项目的组织管理和协调措施应能保障项目的正常实施；应能落实项目实施所需配套条件；项目负责人应能切实履行项目管理职责；应能落实项目任务所需的研究团队和配套仪器设备、经费等条件，有完善的科技管理制度。）\r\n（项目的组织管理和协调措施应能保障项目的正常实施；应能落实项目实施所需配套条件；项目负责人应能切实履行项目管理职责；应能落实项目任务所需的研究团队和配套仪器设备、经费等条件，有完善的科技管理制度。）\r\n（项目的组织管理和协调措施应能保障项目的正常实施；应能落实项目实施所需配套条件；项目负责人应能切实履行项目管理职责；应能落实项目任务所需的研究团队和配套仪器设备、经费等条件，有完善的科技管理制度。）\r\n（项目的组织管理和协调措施应能保障项目的正常实施；应能落实项目实施所需配套条件；项目负责人应能切实履行项目管理职责；应能落实项目任务所需的研究团队和配套仪器设备、经费等条件，有完善的科技管理制度。）\r\n（项目的组织管理和协调措施应能保障项目的正常实施；应能落实项目实施所需配套条件；项目负责人应能切实履行项目管理职责；应能落实项目任务所需的研究团队和配套仪器设备、经费等条件，有完善的科技管理制度。）\r\n（项目的组织管理和协调措施应能保障项目的正常实施；应能落实项目实施所需配套条件；项目负责人应能切实履行项目管理职责；应能落实项目任务所需的研究团队和配套仪器设备、经费等条件，有完善的科技管理制度。）\r\n（项目的组织管理和协调措施应能保障项目的正常实施；应能落实项目实施所需配套条件；项目负责人应能切实履行项目管理职责；应能落实项目任务所需的研究团队和配套仪器设备、经费等条件，有完善的科技管理制度。）\r\n（项目的组织管理和协调措施应能保障项目的正常实施；应能落实项目实施所需配套条件；项目负责人应能切实履行项目管理职责；应能落实项目任务所需的研究团队和配套仪器设备、经费等条件，有完善的科技管理制度。）\r\n',NULL,NULL,NULL,NULL,0,NULL,NULL),(NULL,NULL,NULL,'1453996800','1451923200',NULL,NULL,NULL,NULL,NULL,3,NULL,'dev1453097272',NULL,NULL,NULL,'项目的实施目标及考核指标（具有明确的可考核性）\r\n\r\n〔包括1、主要经济指\r\n',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'11','批量（规模）生产',NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'qskj001','liming-专利实施项目ie 11',NULL,NULL,NULL,3,1,'发展计划科','',NULL,'新材料','[\"1\",\"2\",null,null,null]','国际领先水平',NULL,NULL,NULL,NULL,NULL,'2222222',NULL,NULL,'0002-01-07',NULL,NULL,NULL,NULL,2,'0,1,2,3',NULL,'',NULL,1,'1453097272',0,NULL,NULL,NULL,'项目的实施目标及考核指标（具有明确的可考核性）\r\n\r\n〔包括1、主要经济指\r\n',NULL,NULL,NULL,NULL,NULL,1,'项目的实施目标及考核指标（具有明确的可考核性）\r\n\r\n〔包括1、主要经济指\r\n','fffffffffffffffffffffffffff'),(NULL,NULL,NULL,'1454169600','1451577600',NULL,NULL,NULL,NULL,NULL,4,NULL,'dev1453097453',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'3',NULL,NULL,'KJ2016CX002',0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'123456','科技与文化、卫生、教育融合发展专项--测试',NULL,NULL,NULL,4,1,'发展计划科','李四',NULL,'先进制造与自动化',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,9,'0,1,2,3',NULL,'',NULL,0,'1453097453',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016',0,NULL,NULL),('2016-01-12',NULL,'统计信息','1453564800','1452441600',NULL,NULL,'好','好',NULL,11,NULL,'dev1453101198',NULL,NULL,NULL,'好','啊啊','啊啊','啊啊','好','啊啊','啊啊','啊啊','啊啊','方案','说是','管理','管理',NULL,'好好 的','好',NULL,NULL,NULL,NULL,'啊啊','1',NULL,'好棒的','KJ2016CX001',0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'机构代码','11',NULL,NULL,NULL,4,1,'发展计划科','苏颖',NULL,'生物医药',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,5,'0,1,2,3',NULL,'统计信息','2016-01-12',0,'1453101198',1,NULL,'哈哦','好','好','好',NULL,NULL,NULL,'2015',0,NULL,NULL),(NULL,NULL,NULL,'1454169600','1453046400',NULL,NULL,NULL,NULL,NULL,7,NULL,'dev1453098333',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'密码：123','生态环境建设专项',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'电子信息',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'0,1,2,3',NULL,'',NULL,0,'1453098333',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL),(NULL,NULL,NULL,'1453564800','1452528000',NULL,NULL,NULL,NULL,NULL,8,NULL,'dev1453099069',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'11',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'机构代码','专利实施项目测试',NULL,NULL,NULL,3,1,'发展计划科','',NULL,'电子信息',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,5,'0,1,2,3',NULL,'',NULL,0,'1453099069',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL),(NULL,NULL,NULL,'1485792000','1453046400',NULL,NULL,NULL,NULL,NULL,10,NULL,'dev1453101023',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'6666666-y','生态环境建设专项——demo',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'能源与节能',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,11,'0,1,2,3',NULL,'',NULL,0,'1453101023',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL),(NULL,NULL,NULL,'1453305600','1452182400',NULL,NULL,NULL,NULL,NULL,14,NULL,'sci1453102584',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'7',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'zgf001','1-18支持初创期科技企业孵化器、大学科技园发展项目',NULL,NULL,NULL,0,1,'科技综合科','',NULL,'电子信息',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,'0,1,2,3',NULL,'',NULL,0,'1453102584',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL),(NULL,NULL,NULL,'1454083200','1452182400',NULL,NULL,NULL,NULL,NULL,15,NULL,'sci1453102606',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'8',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'zgf001','1-18-支持市级以上科技企业孵化器资质认定及后期运营项目',NULL,NULL,NULL,0,1,'科技综合科','',NULL,'电子信息',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,'0,1,2,3',NULL,'',NULL,0,'1453102606',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL),('2016-01-18',NULL,'findPlanPart','1453996800','1452096000',NULL,NULL,'务：（项目任务应明确科技工作在解决实际问题中的责任','务：（项目任务应明确科技工作在解决实际问题中的责任',NULL,16,NULL,'dev1453103161',NULL,NULL,NULL,'、项目的目的、意义及必要性    ','、项目的目的、意义及必要性    ','、项目的目的、意义及必要性    ','、项目的目的、意义及必要性    ','务：（项目任务应明确科技工作在解决实际问题中的责任','、项目的目的、意义及必要性    ','项目技术方案与技术路线','项目技术方案与技术路线','项目技术方案与技术路线','市场风险、技术风险、政策风险、管理','var tbody = $(obj).parents(\"tbody\");//不可调换位置\r\n	var tr = obj.parentNode.parentNode;\r\n	var tbody = tr.parentNode;\r\n	tbody.removeChild(tr);\r\n	var row = 0;\r\n	$(tbody).children(\"tr\").each(function () {\r\n		if (row != 0) {\r\n			$(this).find(\"input\").each(function () {\r\n				var name = $(this).prop(\"name\");\r\n				if (name != \"\" &&(name.indexOf(\"[\")!=-1)) {\r\n					var newName = name.split(\"[\");\r\n					newName[0] = newName[0] + \"[\" + (row - 1) + \"]\";\r\n					$(this).prop(\"name\", newName[0]);\r\n				}\r\n			});\r\n		}\r\n		row++;\r\n	});','期成果形式、知识产权归属于管','1、项目完成后的经济社会效益分析及成果推广方案\r\n （项目完成后的经济社会效益分析应与项目的目的、意义及必要性相对应。成果推广方案应明确',NULL,'ssssss','imp_plan',NULL,NULL,NULL,NULL,'、项目的目的、意义及必要性    ','1',NULL,'findPlanPart',NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'qskj001','生态环境建设专项003',NULL,NULL,NULL,3,1,'发展计划科','',NULL,'新材料',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,2,'0,1,2,3',NULL,'findPlanPart','2016-01-04',0,'1453103161',0,NULL,'务：（项目任务应明确科技工作在解决实际问题中的责任','务：（项目任务应明确科技工作在解决实际问题中的责任','务：（项目任务应明确科技工作在解决实际问题中的责任','务：（项目任务应明确科技工作在解决实际问题中的责任',NULL,NULL,NULL,NULL,0,NULL,NULL),(NULL,NULL,NULL,'1454169600','1453046400',NULL,NULL,NULL,NULL,NULL,17,NULL,'sci1453106574',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'12',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'6666666-y','科技创新人才资助与奖励——测试',NULL,NULL,NULL,0,1,'科技综合科','',NULL,'先进制造与自动化',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,11,'0',NULL,'',NULL,0,'1453106574',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL),('2016-01-28',NULL,'统计信息','1454169600','1451577600',NULL,NULL,'好','好',NULL,18,NULL,'dev1453106590',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'好',NULL,NULL,NULL,NULL,NULL,'好',NULL,NULL,NULL,'不搭理',NULL,NULL,NULL,NULL,NULL,NULL,'2',NULL,'好','KJ2016CX004',0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'机构代码','城市建设与管理',NULL,NULL,NULL,3,1,'发展计划科','康连元',NULL,'生物医药',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,5,'0,1,2,3',NULL,'',NULL,0,'1453106590',0,NULL,'好','哈','好','好',NULL,NULL,NULL,NULL,0,NULL,NULL),(NULL,NULL,NULL,'1454169600','1453046400',NULL,NULL,NULL,NULL,NULL,19,NULL,'sci1453106749',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'12',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'6666666-y','科技创新人才资助与奖励——demo',NULL,NULL,NULL,0,1,'科技综合科','',NULL,'环境保护',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,11,'0',NULL,'',NULL,0,'1453106749',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL),(NULL,NULL,NULL,'1453564800','1452096000',NULL,NULL,NULL,NULL,NULL,20,NULL,'dev1453107699',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,'3',NULL,NULL,'KJ2016CX005',0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'机构代码','3科技与文化、卫生、教育融合发展专项',NULL,NULL,NULL,4,1,'发展计划科','李四',NULL,'电子信息',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,5,'0,1,2,3',NULL,'',NULL,0,'1453107699',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2006',0,NULL,NULL),(NULL,NULL,NULL,'1453651200','1452528000',NULL,NULL,NULL,NULL,NULL,21,NULL,'dev1453108525',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'4',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'机构代码','4科技农业发展专项',NULL,NULL,NULL,5,1,'发展计划科','',NULL,'生物医药',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,5,'0,1,2,3',NULL,'',NULL,0,'1453108525',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL),(NULL,NULL,NULL,'1453564800','1452096000',NULL,NULL,NULL,NULL,NULL,22,NULL,'dev1453108987',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'4',NULL,NULL,'KJ2016CX006',0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'机构代码','科技农业发展专项44',NULL,NULL,NULL,3,1,'发展计划科','那五',NULL,'电子信息',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,5,'0,1,2,3',NULL,'',NULL,0,'1453108987',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL),(NULL,NULL,NULL,'1453737600','1451923200',NULL,NULL,'7','5',NULL,23,NULL,'sci1453109921',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'4',NULL,NULL,NULL,NULL,NULL,'预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'8',NULL,NULL,'KJ2016ZH001',0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'密码：123','支持市级以上科技企业孵化器资质认定及后期运营项目',NULL,NULL,NULL,1,1,'科技综合科','史玉柱',NULL,'电子信息',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'0,1,2,3',NULL,'',NULL,0,'1453109921',0,NULL,'1','2','3','6',NULL,NULL,NULL,NULL,0,NULL,NULL),(NULL,NULL,NULL,'1454169600','1453046400',NULL,NULL,NULL,NULL,NULL,24,NULL,'dev1453110069',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'6666666-y','城市建设与管理专项----demo',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'先进制造与自动化',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,11,'0,1,2,3',NULL,'',NULL,0,'1453110069',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL),(NULL,NULL,NULL,'1454169600','1453046400',NULL,NULL,NULL,NULL,NULL,25,NULL,'dev1453110191',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'3',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'6666666-y','科技与文化、卫生、教育融合发展专项——测试',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'先进制造与自动化',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,11,'0,1,2,3',NULL,'',NULL,0,'1453110191',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL),(NULL,NULL,NULL,'1454169600','1453046400',NULL,NULL,NULL,NULL,NULL,26,NULL,'dev1453111213',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'33',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'6666666-y','测试---demo',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'能源与节能',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,11,'0,1',NULL,'',NULL,0,'1453111213',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL),(NULL,NULL,NULL,'1454169600','1453046400',NULL,NULL,NULL,NULL,NULL,27,NULL,'dev1453111314',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'33',NULL,NULL,'KJ2016CX007',0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'6666666-y','测试---demo2',NULL,NULL,NULL,1,1,'发展计划科','苏颖',NULL,'能源与节能',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,11,'0,1',NULL,'',NULL,0,'1453111314',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL),(NULL,NULL,NULL,'1454169600','1453046400',NULL,NULL,NULL,NULL,NULL,28,NULL,'dev1453111413',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'33',NULL,NULL,'KJ2016CX008',0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'6666666-y','测试——demo',NULL,NULL,NULL,1,1,'发展计划科','康连元',NULL,'能源与节能',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,11,'0,1',NULL,'',NULL,0,'1453111413',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL),(NULL,NULL,NULL,'1453305600','1452182400',NULL,NULL,NULL,NULL,NULL,29,NULL,'sci1453111441',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'12',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'zgf001','1-18-科技创新人才资助与奖励',NULL,NULL,NULL,0,1,'科技综合科','',NULL,'电子信息',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,'0',NULL,'',NULL,0,'1453111441',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL),(NULL,NULL,NULL,'1453651200','1451577600',NULL,NULL,NULL,NULL,NULL,30,NULL,'dev1453111637',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'123456','城市建设与管理专项--测试',NULL,NULL,NULL,5,1,'发展计划科','',NULL,'新材料',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,9,'0,1,2,3',NULL,'',NULL,0,'1453111637',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL),(NULL,NULL,NULL,'1454169600','1453046400',NULL,NULL,NULL,NULL,NULL,31,NULL,'sci1453111643',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'12',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'6666666-y','科技创新人才资助与奖励——测试',NULL,NULL,NULL,0,1,'科技综合科','',NULL,'先进制造与自动化',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,11,'0',NULL,'',NULL,0,'1453111643',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL),(NULL,NULL,NULL,'1454169600','1453046400',NULL,NULL,NULL,NULL,NULL,32,NULL,'sci1453111876',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'12',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'6666666-y','科技创新人才资助与奖励-------test',NULL,NULL,NULL,0,1,'科技综合科','',NULL,'先进制造与自动化',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,11,'0',NULL,'',NULL,0,'1453111876',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL),(NULL,NULL,NULL,'1477843200','1453046400',NULL,NULL,NULL,NULL,NULL,33,NULL,'kno1453111975',NULL,NULL,NULL,'在线申报系统\r\n\r\n前言\r\n在线申报系统网址：http://b.bjqskj.com:8080/website/html/view/template/\r\n获取申报账号和密码两种方式：\r\n（1）	注册\r\n（2）	后台分配账号和密码\r\n\r\n注册\r\n输入网址，进入在线申报系统首页，点击“注册”，进行注册，用于获取登录系统的账号和密码，如图：\r\n \r\n进入注册页面，分两部分填写注册信息：用户信息、企业信息\r\n填写用户相关信息（注意：*为必填），填写完用户信息后点击“下一步”，继续填写企业信息，如图：\r\n \r\n继续填写企业相关信息（注意：*为必填），填写完成后，点击“确定”，完成注册，弹出提示窗口“注册成功，即将进行跳转”，点击弹窗中“确定”，跳回系统首页，如图：\r\n \r\n\r\n登录\r\n输入网址，进入在线申报系统首页（注册后，跳转回首页），在用户登录栏输入用户名、密码和验证码，点击“登录”，验证登录后，即可进入系统申报项目，如图：\r\n在线申报系统\r\n\r\n前言\r\n在线申报系统网址：http://b.bjqskj.com:8080/website/html/view/template/\r\n获取申报账号和密码两种方式：\r\n（1）	注册\r\n（2）	后台分配账号和密码\r\n\r\n注册\r\n输入网址，进入在线申报系统首页，点击“注册”，进行注册，用于获取登录系统的账号和密码，如图：\r\n \r\n进入注册页面，分两部分填写注册信息：用户信息、企业信息\r\n填写用户相关信息（注意：*为必填），填写完用户信息后点击“下一步”，继续填写企业信息，如图：\r\n \r\n继续填写企业相关信息（注意：*为必填），填写完成后，点击“确定”，完成注册，弹出提示窗口“注册成功，即将进行跳转”，点击弹窗中“确定”，跳回系统首页，如图：\r\n \r\n\r\n登录\r\n输入网址，进入在线申报系统首页（注册后，跳转回首页），在用户登录栏输入用户名、密码和验证码，点击“登录”，验证登录后，即可进入系统申报项目，如图：\r\n',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'11','中试阶段',NULL,'ZS2016CQ001',0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'6666666-y','专利实施项目——demo',NULL,NULL,NULL,1,1,'知识产权科','金竹',NULL,'能源与节能','[\"1\",null,null,\"4\",null]','国内领先水平',NULL,NULL,NULL,NULL,NULL,'测',NULL,NULL,'2016-01-18',NULL,NULL,NULL,NULL,11,'0,1,2,3',NULL,'',NULL,0,'1453111975',0,NULL,NULL,NULL,'在线申报系统\r\n\r\n前言\r\n在线申报系统网址：http://b.bjqskj.com:8080/website/html/view/template/\r\n获取申报账号和密码两种方式：\r\n（1）	注册\r\n（2）	后台分配账号和密码\r\n\r\n注册\r\n输入网址，进入在线申报系统首页，点击“注册”，进行注册，用于获取登录系统的账号和密码，如图：\r\n \r\n进入注册页面，分两部分填写注册信息：用户信息、企业信息\r\n填写用户相关信息（注意：*为必填），填写完用户信息后点击“下一步”，继续填写企业信息，如图：\r\n \r\n继续填写企业相关信息（注意：*为必填），填写完成后，点击“确定”，完成注册，弹出提示窗口“注册成功，即将进行跳转”，点击弹窗中“确定”，跳回系统首页，如图：\r\n \r\n\r\n登录\r\n输入网址，进入在线申报系统首页（注册后，跳转回首页），在用户登录栏输入用户名、密码和验证码，点击“登录”，验证登录后，即可进入系统申报项目，如图：\r\n在线申报系统\r\n\r\n前言\r\n在线申报系统网址：http://b.bjqskj.com:8080/website/html/view/template/\r\n获取申报账号和密码两种方式：\r\n（1）	注册\r\n（2）	后台分配账号和密码\r\n\r\n注册\r\n输入网址，进入在线申报系统首页，点击“注册”，进行注册，用于获取登录系统的账号和密码，如图：\r\n \r\n进入注册页面，分两部分填写注册信息：用户信息、企业信息\r\n填写用户相关信息（注意：*为必填），填写完用户信息后点击“下一步”，继续填写企业信息，如图：\r\n \r\n继续填写企业相关信息（注意：*为必填），填写完成后，点击“确定”，完成注册，弹出提示窗口“注册成功，即将进行跳转”，点击弹窗中“确定”，跳回系统首页，如图：\r\n \r\n\r\n登录\r\n输入网址，进入在线申报系统首页（注册后，跳转回首页），在用户登录栏输入用户名、密码和验证码，点击“登录”，验证登录后，即可进入系统申报项目，如图：\r\n',NULL,NULL,NULL,NULL,NULL,0,'在线申报系统\r\n\r\n前言\r\n在线申报系统网址：http://b.bjqskj.com:8080/website/html/view/template/\r\n获取申报账号和密码两种方式：\r\n（1）	注册\r\n（2）	后台分配账号和密码\r\n\r\n注册\r\n输入网址，进入在线申报系统首页，点击“注册”，进行注册，用于获取登录系统的账号和密码，如图：\r\n \r\n进入注册页面，分两部分填写注册信息：用户信息、企业信息\r\n填写用户相关信息（注意：*为必填），填写完用户信息后点击“下一步”，继续填写企业信息，如图：\r\n \r\n继续填写企业相关信息（注意：*为必填），填写完成后，点击“确定”，完成注册，弹出提示窗口“注册成功，即将进行跳转”，点击弹窗中“确定”，跳回系统首页，如图：\r\n \r\n\r\n登录\r\n输入网址，进入在线申报系统首页（注册后，跳转回首页），在用户登录栏输入用户名、密码和验证码，点击“登录”，验证登录后，即可进入系统申报项目，如图：\r\n \r\n登录成功后，进入系统，默认显示“我的项目”中“进行项目”的项目列表，如图：\r\n \r\n\r\n申报项目\r\n点击“申报项目”，创建新项目。创建新项目主要分为两部分：选择项目类型、填写项目基本信息。\r\n选择项目类型：选择想要新建项目的类型，点击“正在申报”，即可进入下一步——填写项目基本信息。（注意：显示“正在申报”的项目类型才可选择，显示“申报已结束”或“申报未开始”的项目类型不能选择）\r\n \r\n填写项目基本信息：填写项目名称、选择所属领域、开始时间和结束时间，点击“保存”，即完成项目的创建，如图：\r\n \r\n创建项目成功后，自动跳转到“我的项目”中“进行项目”的项目列表，显示创建的新项目（显示项目的名称、申报起止日期、项目阶段、申报状态等信息），如下图：    \r\n \r\n申报阶段\r\n项目创建成功后，填报申报阶段文件（申报书、实施方案等）。步骤如下：\r\n（1）点击项目列表中“正在受理”，如图： \r\n \r\n（2）进入受理页面，上部显示项目基本信息、下部显示申报阶段可填写的文件。点击“填写”，即可进行实施方案填写，如图：\r\n \r\n（3）进入填写页面（以“项目实施方案为例”），左侧显示需要填写信息的标题，选择左侧标题，右侧可进行相应信息的填写。默认情况：左侧第一个标题被选中（项目承担单位基本信息），右侧可填写“项目承担单位基本信息”，如图：\r\n \r\n注意：\r\n（1）一些填写项填写前存在规则说明，按照规则填写，如果填写格式不正确，会弹出相应提示。如图：\r\n \r\n（1）填写信息后，点击“保存”，信息才可保存。\r\n（2）点击“保存”后，如果信息填写完全，则左侧标题后面会出现小对勾（证明该标题下所有信息已全部填写），并且“保存“后，自动跳到下一标题信息，可继续进行填写。如图：\r\n \r\n（3） “上传附件“上传的是该文件中的一些图、表信息，以图片（.jpg、.png等）的形式上传。点击”选择文件“，可选择一张或多张图片，进行上传。上传后，显示附件列表，在附件列表中，可对图片进行说明介绍。如图：\r\n\r\n立项阶段\r\n\r\n\r\n实施阶段\r\n\r\n验收阶段\r\n\r\n\r\n\r\n','在线申报系统\r\n\r\n前言\r\n在线申报系统网址：http://b.bjqskj.com:8080/website/html/view/template/\r\n获取申报账号和密码两种方式：\r\n（1）	注册\r\n（2）	后台分配账号和密码\r\n\r\n注册\r\n输入网址，进入在线申报系统首页，点击“注册”，进行注册，用于获取登录系统的账号和密码，如图：\r\n \r\n进入注册页面，分两部分填写注册信息：用户信息、企业信息\r\n填写用户相关信息（注意：*为必填），填写完用户信息后点击“下一步”，继续填写企业信息，如图：\r\n \r\n继续填写企业相关信息（注意：*为必填），填写完成后，点击“确定”，完成注册，弹出提示窗口“注册成功，即将进行跳转”，点击弹窗中“确定”，跳回系统首页，如图：\r\n \r\n\r\n登录\r\n输入网址，进入在线申报系统首页（注册后，跳转回首页），在用户登录栏输入用户名、密码和验证码，点击“登录”，验证登录后，即可进入系统申报项目，如图：\r\n在线申报系统\r\n\r\n前言\r\n在线申报系统网址：http://b.bjqskj.com:8080/website/html/view/template/\r\n获取申报账号和密码两种方式：\r\n（1）	注册\r\n（2）	后台分配账号和密码\r\n\r\n注册\r\n输入网址，进入在线申报系统首页，点击“注册”，进行注册，用于获取登录系统的账号和密码，如图：\r\n \r\n进入注册页面，分两部分填写注册信息：用户信息、企业信息\r\n填写用户相关信息（注意：*为必填），填写完用户信息后点击“下一步”，继续填写企业信息，如图：\r\n \r\n继续填写企业相关信息（注意：*为必填），填写完成后，点击“确定”，完成注册，弹出提示窗口“注册成功，即将进行跳转”，点击弹窗中“确定”，跳回系统首页，如图：\r\n \r\n\r\n登录\r\n输入网址，进入在线申报系统首页（注册后，跳转回首页），在用户登录栏输入用户名、密码和验证码，点击“登录”，验证登录后，即可进入系统申报项目，如图：\r\n'),(NULL,NULL,NULL,'1463760000','1451577600',NULL,NULL,NULL,NULL,NULL,34,NULL,'dev1453112079',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'6',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'123456','支持创新平台建设项目--测试',NULL,NULL,NULL,5,1,'发展计划科','',NULL,'新材料',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,9,'0,1,2,3',NULL,'',NULL,0,'1453112079',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL),('2016-01-18',NULL,'科技农业','1453564800','1451577600',NULL,NULL,NULL,NULL,NULL,35,NULL,'dev1453112447',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'4',NULL,NULL,'KJ2016CX009',0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'机构代码','444科技农业',NULL,NULL,NULL,3,1,'发展计划科','苏颖',NULL,'生物医药',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,5,'0,1,2,3',NULL,'',NULL,0,'1453112447',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL),(NULL,NULL,NULL,'1453132800','1451577600',NULL,NULL,NULL,NULL,NULL,36,NULL,'dev1453113981',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1',NULL,NULL,'KJ2016CX011',0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'123456','生态环境建设专项--测试2',NULL,NULL,NULL,1,1,'发展计划科','康连元',NULL,'环境保护',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,9,'0,1,2,3',NULL,'',NULL,0,'1453113981',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL),(NULL,NULL,NULL,'1453651200','1452182400',NULL,NULL,NULL,NULL,NULL,37,NULL,'dev1453114020',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1',NULL,NULL,'KJ2016CX010',0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'机构代码','生态环境建设',NULL,NULL,NULL,1,1,'发展计划科','苏颖',NULL,'生物医药',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,5,'0,1,2,3',NULL,'',NULL,0,'1453114020',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL),(NULL,NULL,NULL,'1453910400','1452009600',NULL,NULL,NULL,NULL,NULL,38,NULL,'dev1453114014',NULL,NULL,NULL,'111','1、项目的目的、意义及必要性    ','1、项目的目的、意义及必要性    ','1、项目的目的、意义及必要性    ',NULL,'1、项目的目的、意义及必要性    ','1、项目的目的、意义及必要性    ','1、项目的目的、意义及必要性    ','1、项目的目的、意义及必要性    ','1、项目的目的、意义及必要性    ','预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理预期成果形式、知识产权归属于管理','1、项目的目的、意义及必要性    ','1、项目的目的、意义及必要性    ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1、项目的目的、意义及必要性    ','2',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'qskj001','城市建设与管理专项0010',NULL,NULL,NULL,3,1,'发展计划科','',NULL,'新材料',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,2,'0,1,2,3',NULL,'',NULL,0,'1453114014',0,NULL,NULL,NULL,NULL,NULL,'{\"2\":{\"items\":[]},\"3\":{\"items\":[]},\"4\":{\"items\":[]},\"5\":{\"items\":[]},\"6\":{\"items\":[]},\"9\":{\"items\":[]},\"10\":{\"items\":[]},\"11\":{\"items\":[]}}',NULL,NULL,NULL,0,NULL,NULL),(NULL,NULL,NULL,'1453478400','1451577600',NULL,NULL,NULL,NULL,NULL,39,NULL,'sci1453114185',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'8',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'zgf001','1-18支持市级以上科技企业孵化器资质认定及后期运营项目',NULL,NULL,NULL,0,1,'科技综合科','',NULL,'电子信息',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,'0,1,2,3',NULL,'',NULL,0,'1453114185',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL),('2016-01-07',NULL,'专项名称','1453564800','1452182400',NULL,NULL,'啊','啊',NULL,40,NULL,'dev1453117545',NULL,NULL,NULL,'ss','去','啊','啊','啊','好','好','啊',' 啊','啊','好','啊','啊',NULL,'好','好',NULL,NULL,NULL,NULL,'好','1',NULL,'遵守规则','KJ2016CX012',0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'机构代码','111之生态环境建设专项',NULL,NULL,NULL,4,1,'发展计划科','康连元',NULL,'能源与节能',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,5,'0,1,2,3',NULL,'专项名称','2016-01-11',0,'1453117545',1,NULL,'hao ','hao ','好','啊','{\"2\":{\"items\":[{\"name\":\"extra_1453114463000\",\"val\":\"\\u597d\"}]},\"3\":{\"items\":[]},\"4\":{\"items\":[]},\"5\":{\"items\":[]},\"6\":{\"items\":[]},\"9\":{\"items\":[]},\"10\":{\"items\":[]},\"11\":{\"items\":[]}}',NULL,NULL,'2016',0,NULL,NULL),(NULL,NULL,NULL,'1453910400','1452182400',NULL,NULL,NULL,NULL,NULL,41,NULL,'kno1453119627',NULL,NULL,NULL,'市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'11','中试阶段',NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'qskj001','专利实施项-liming ',NULL,NULL,NULL,3,1,'知识产权科','',NULL,'能源与节能','[\"1\",\"2\",\"3\",null,null]','国内先进水平',NULL,NULL,NULL,NULL,NULL,'项目简介',NULL,NULL,'2016-01-12',NULL,NULL,NULL,NULL,2,'0,1,2,3',NULL,'',NULL,0,'1453119627',0,NULL,NULL,NULL,'市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项',NULL,NULL,NULL,NULL,NULL,0,'其他条款','识产权归属\r\n识产权归属\r\n识产权归属\r\n识产权归属\r\n识产权归属\r\n识产权归属\r\n识产权归属\r\n识产权归属\r\n识产权归属\r\n识产权归属\r\n识产权归属\r\n识产权归属\r\n识产权归属\r\n识产权归属\r\n识产权归属\r\n识产权归属\r\n识产权归属\r\n识产权归属\r\n识产权归属\r\n识产权归属\r\n识产权归属\r\n识产权归属\r\n识产权归属\r\n识产权归属\r\n识产权归属\r\n识产权归属\r\n识产权归属\r\n识产权归属\r\n识产权归属\r\n识产权归属\r\n识产权归属\r\n识产权归属\r\n识产权归属\r\n识产权归属\r\n识产权归属\r\n识产权归属\r\n识产权归属\r\n识产权归属\r\n'),(NULL,NULL,NULL,'1453219200','1451577600',NULL,NULL,NULL,NULL,NULL,42,NULL,'dev1453119675',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1',NULL,NULL,'KJ2016CX013',0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'123456','生态环境建设专项--测试3',NULL,NULL,NULL,1,1,'发展计划科','那五',NULL,'环境保护',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,9,'0,1,2,3',NULL,'',NULL,0,'1453119675',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL),(NULL,NULL,NULL,'1454169600','1451664000',NULL,NULL,NULL,NULL,NULL,47,NULL,'dev1453123795',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1',NULL,NULL,'KJ2016CX014',0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'6666666-y','生态环境建设专项生态环境建设专项',NULL,NULL,NULL,4,1,'发展计划科','康连元',NULL,'生物医药',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,11,'0,1,2,3',NULL,'',NULL,0,'1453123795',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016',0,NULL,NULL),(NULL,NULL,NULL,'1453564800','1451664000',NULL,NULL,NULL,NULL,NULL,44,NULL,'dev1453122231',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1',NULL,NULL,'KJ2016CX016',0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'6666666-y','ttt',NULL,NULL,NULL,2,1,'发展计划科','康连元',NULL,'生物医药',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,11,'0,1,2,3',NULL,'',NULL,0,'1453122231',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL),(NULL,NULL,NULL,'1454169600','1451664000',NULL,NULL,NULL,NULL,NULL,45,NULL,'dev1453122355',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'6666666-y','bvbvb',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'电子信息',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,11,'0,1,2,3',NULL,'',NULL,0,'1453122355',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL),('2016-01-05',NULL,'大神的萨达发到','1454169600','1451577600',NULL,NULL,'  数百家覆盖全国优秀的合作伙伴。年轻充满活力，团结的公司团队。优秀的管理，国内唯一的白牌服务器/储存产品LV4级售后平台，专业的市场团队人员，多年经验积累的FAE工程师和国内数十家上市公司/行业领头企业的认证供应商。  数百家覆盖全国优秀的合作伙伴。年轻充满活力，团结的公司团队。优秀的管理，国内唯一的白牌服务器/储存产品LV4级售后平台，专业的市场团队人员，多年经验积累的FAE工程师和国内数十家上市公司/行业领头企业的认证供应商。  数百家覆盖全国优秀的合作伙伴。年轻充满活力，团结的公司团队。优秀的管理，国内唯一的白牌服务器/储存产品LV4级售后平台，专业的市场团队人员，多年经验积累的FAE工程师和国内数十家上市公司/行业领头企业的认证供应商。  数百家覆盖全国优秀的合作伙伴。年轻充满活力，团结的公司团队。优秀的管理，国内唯一的白牌服务器/储存产品LV4级售后平台，专业的市场团队人员，多年经验积累的FAE工程师和国内数十家上市公司/行业领头企业的认证供应商。  数百家覆盖全国优秀的合作伙伴。年轻充满活力，团结的公司团队。优秀的管理，国内唯一的白牌服务器/储存产品LV4级售后平台，专业的市场团队人员，多年经验积累的FAE工程师和国内数十家上市公司/行业领头企业的认证供应商。  数百家覆盖全国优秀的合作伙伴。年轻充满活力，团结的公司团队。优秀的管理，国内唯一的白牌服务器/储存产品LV4级售后平台，专业的市场团队人员，多年经验积累的FAE工程师和国内数十家上市公司/行业领头企业的认证供应商。  数百家覆盖全国优秀的合作伙伴。年轻充满活力，团结的公司团队。优秀的管理，国内唯一的白牌服务器/储存产品LV4级售后平台，专业的市场团队人员，多年经验积累的FAE工程师和国内数十家上市公司/行业领头企业的认证供应商。','  数百家覆盖全国优秀的合作伙伴。年轻充满活力，团结的公司团队。优秀的管理，国内唯一的白牌服务器/储存产品LV4级售后平台，专业的市场团队人员，多年经验积累的FAE工程师和国内数十家上市公司/行业领头企业的认证供应商。  数百家覆盖全国优秀的合作伙伴。年轻充满活力，团结的公司团队。优秀的管理，国内唯一的白牌服务器/储存产品LV4级售后平台，专业的市场团队人员，多年经验积累的FAE工程师和国内数十家上市公司/行业领头企业的认证供应商。  数百家覆盖全国优秀的合作伙伴。年轻充满活力，团结的公司团队。优秀的管理，国内唯一的白牌服务器/储存产品LV4级售后平台，专业的市场团队人员，多年经验积累的FAE工程师和国内数十家上市公司/行业领头企业的认证供应商。  数百家覆盖全国优秀的合作伙伴。年轻充满活力，团结的公司团队。优秀的管理，国内唯一的白牌服务器/储存产品LV4级售后平台，专业的市场团队人员，多年经验积累的FAE工程师和国内数十家上市公司/行业领头企业的认证供应商。',NULL,46,NULL,'dev1453122587',NULL,NULL,NULL,'写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 ','写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 ','写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 ','写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 ','  数百家覆盖全国优秀的合作伙伴。年轻充满活力，团结的公司团队。优秀的管理，国内唯一的白牌服务器/储存产品LV4级售后平台，专业的市场团队人员，多年经验积累的FAE工程师和国内数十家上市公司/行业领头企业的认证供应商。  数百家覆盖全国优秀的合作伙伴。年轻充满活力，团结的公司团队。优秀的管理，国内唯一的白牌服务器/储存产品LV4级售后平台，专业的市场团队人员，多年经验积累的FAE工程师和国内数十家上市公司/行业领头企业的认证供应商。  数百家覆盖全国优秀的合作伙伴。年轻充满活力，团结的公司团队。优秀的管理，国内唯一的白牌服务器/储存产品LV4级售后平台，专业的市场团队人员，多年经验积累的FAE工程师和国内数十家上市公司/行业领头企业的认证供应商。  数百家覆盖全国优秀的合作伙伴。年轻充满活力，团结的公司团队。优秀的管理，国内唯一的白牌服务器/储存产品LV4级售后平台，专业的市场团队人员，多年经验积累的FAE工程师和国内数十家上市公司/行业领头企业的认证供应商。  数百家覆盖全国优秀的合作伙伴。年轻充满活力，团结的公司团队。优秀的管理，国内唯一的白牌服务器/储存产品LV4级售后平台，专业的市场团队人员，多年经验积累的FAE工程师和国内数十家上市公司/行业领头企业的认证供应商。  数百家覆盖全国优秀的合作伙伴。年轻充满活力，团结的公司团队。优秀的管理，国内唯一的白牌服务器/储存产品LV4级售后平台，专业的市场团队人员，多年经验积累的FAE工程师和国内数十家上市公司/行业领头企业的认证供应商。  数百家覆盖全国优秀的合作伙伴。年轻充满活力，团结的公司团队。优秀的管理，国内唯一的白牌服务器/储存产品LV4级售后平台，专业的市场团队人员，多年经验积累的FAE工程师和国内数十家上市公司/行业领头企业的认证供应商。  数百家覆盖全国优秀的合作伙伴。年轻充满活力，团结的公司团队。优秀的管理，国内唯一的白牌服务器/储存产品LV4级售后平台，专业的市场团队人员，多年经验积累的FAE工程师和国内数十家上市公司/行业领头企业的认证供应商。','写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 ','写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 ','写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 ','写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 ','写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 ','  数百家覆盖全国优秀的合作伙伴。年轻充满活力，团结的公司团队。优秀的管理，国内唯一的白牌服务器/储存产品LV4级售后平台，专业的市场团队人员，多年经验积累的FAE工程师和国内数十家上市公司/行业领头企业的认证供应商。  数百家覆盖全国优秀的合作伙伴。年轻充满活力，团结的公司团队。优秀的管理，国内唯一的白牌服务器/储存产品LV4级售后平台，专业的市场团队人员，多年经验积累的FAE工程师和国内数十家上市公司/行业领头企业的认证供应商。  数百家覆盖全国优秀的合作伙伴。年轻充满活力，团结的公司团队。优秀的管理，国内唯一的白牌服务器/储存产品LV4级售后平台，专业的市场团队人员，多年经验积累的FAE工程师和国内数十家上市公司/行业领头企业的认证供应商。  数百家覆盖全国优秀的合作伙伴。年轻充满活力，团结的公司团队。优秀的管理，国内唯一的白牌服务器/储存产品LV4级售后平台，专业的市场团队人员，多年经验积累的FAE工程师和国内数十家上市公司/行业领头企业的认证供应商。  数百家覆盖全国优秀的合作伙伴。年轻充满活力，团结的公司团队。优秀的管理，国内唯一的白牌服务器/储存产品LV4级售后平台，专业的市场团队人员，多年经验积累的FAE工程师和国内数十家上市公司/行业领头企业的认证供应商。  数百家覆盖全国优秀的合作伙伴。年轻充满活力，团结的公司团队。优秀的管理，国内唯一的白牌服务器/储存产品LV4级售后平台，专业的市场团队人员，多年经验积累的FAE工程师和国内数十家上市公司/行业领头企业的认证供应商。  数百家覆盖全国优秀的合作伙伴。年轻充满活力，团结的公司团队。优秀的管理，国内唯一的白牌服务器/储存产品LV4级售后平台，专业的市场团队人员，多年经验积累的FAE工程师和国内数十家上市公司/行业领头企业的认证供应商。  数百家覆盖全国优秀的合作伙伴。年轻充满活力，团结的公司团队。优秀的管理，国内唯一的白牌服务器/储存产品LV4级售后平台，专业的市场团队人员，多年经验积累的FAE工程师和国内数十家上市公司/行业领头企业的认证供应商。  数百家覆盖全国优秀的合作伙伴。年轻充满活力，团结的公司团队。优秀的管理，国内唯一的白牌服务器/储存产品LV4级售后平台，专业的市场团队人员，多年经验积累的FAE工程师和国内数十家上市公司/行业领头企业的认证供应商。  数百家覆盖全国优秀的合作伙伴。年轻充满活力，团结的公司团队。优秀的管理，国内唯一的白牌服务器/储存产品LV4级售后平台，专业的市场团队人员，多年经验积累的FAE工程师和国内数十家上市公司/行业领头企业的认证供应商。  数百家覆盖全国优秀的合作伙伴。年轻充满活力，团结的公司团队。优秀的管理，国内唯一的白牌服务器/储存产品LV4级售后平台，专业的市场团队人员，多年经验积累的FAE工程师和国内数十家上市公司/行业领头企业的认证供应商。','写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 ','写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 ',NULL,'  数百家覆盖全国优秀的合作伙伴。年轻充满活力，团结的公司团队。优秀的管理，国内唯一的白牌服务器/储存产品LV4级售后平台，专业的市场团队人员，多年经验积累的FAE工程师和国内数十家上市公司/行业领头企业的认证供应商。  数百家覆盖全国优秀的合作伙伴。年轻充满活力，团结的公司团队。优秀的管理，国内唯一的白牌服务器/储存产品LV4级售后平台，专业的市场团队人员，多年经验积累的FAE工程师和国内数十家上市公司/行业领头企业的认证供应商。  数百家覆盖全国优秀的合作伙伴。年轻充满活力，团结的公司团队。优秀的管理，国内唯一的白牌服务器/储存产品LV4级售后平台，专业的市场团队人员，多年经验积累的FAE工程师和国内数十家上市公司/行业领头企业的认证供应商。  数百家覆盖全国优秀的合作伙伴。年轻充满活力，团结的公司团队。优秀的管理，国内唯一的白牌服务器/储存产品LV4级售后平台，专业的市场团队人员，多年经验积累的FAE工程师和国内数十家上市公司/行业领头企业的认证供应商。  数百家覆盖全国优秀的合作伙伴。年轻充满活力，团结的公司团队。优秀的管理，国内唯一的白牌服务器/储存产品LV4级售后平台，专业的市场团队人员，多年经验积累的FAE工程师和国内数十家上市公司/行业领头企业的认证供应商。  数百家覆盖全国优秀的合作伙伴。年轻充满活力，团结的公司团队。优秀的管理，国内唯一的白牌服务器/储存产品LV4级售后平台，专业的市场团队人员，多年经验积累的FAE工程师和国内数十家上市公司/行业领头企业的认证供应商。  数百家覆盖全国优秀的合作伙伴。年轻充满活力，团结的公司团队。优秀的管理，国内唯一的白牌服务器/储存产品LV4级售后平台，专业的市场团队人员，多年经验积累的FAE工程师和国内数十家上市公司/行业领头企业的认证供应商。  数百家覆盖全国优秀的合作伙伴。年轻充满活力，团结的公司团队。优秀的管理，国内唯一的白牌服务器/储存产品LV4级售后平台，专业的市场团队人员，多年经验积累的FAE工程师和国内数十家上市公司/行业领头企业的认证供应商。  数百家覆盖全国优秀的合作伙伴。年轻充满活力，团结的公司团队。优秀的管理，国内唯一的白牌服务器/储存产品LV4级售后平台，专业的市场团队人员，多年经验积累的FAE工程师和国内数十家上市公司/行业领头企业的认证供应商。  数百家覆盖全国优秀的合作伙伴。年轻充满活力，团结的公司团队。优秀的管理，国内唯一的白牌服务器/储存产品LV4级售后平台，专业的市场团队人员，多年经验积累的FAE工程师和国内数十家上市公司/行业领头企业的认证供应商。  数百家覆盖全国优秀的合作伙伴。年轻充满活力，团结的公司团队。优秀的管理，国内唯一的白牌服务器/储存产品LV4级售后平台，专业的市场团队人员，多年经验积累的FAE工程师和国内数十家上市公司/行业领头企业的认证供应商。  数百家覆盖全国优秀的合作伙伴。年轻充满活力，团结的公司团队。优秀的管理，国内唯一的白牌服务器/储存产品LV4级售后平台，专业的市场团队人员，多年经验积累的FAE工程师和国内数十家上市公司/行业领头企业的认证供应商。  数百家覆盖全国优秀的合作伙伴。年轻充满活力，团结的公司团队。优秀的管理，国内唯一的白牌服务器/储存产品LV4级售后平台，专业的市场团队人员，多年经验积累的FAE工程师和国内数十家上市公司/行业领头企业的认证供应商。  数百家覆盖全国优秀的合作伙伴。年轻充满活力，团结的公司团队。优秀的管理，国内唯一的白牌服务器/储存产品LV4级售后平台，专业的市场团队人员，多年经验积累的FAE工程师和国内数十家上市公司/行业领头企业的认证供应商。  数百家覆盖全国优秀的合作伙伴。年轻充满活力，团结的公司团队。优秀的管理，国内唯一的白牌服务器/储存产品LV4级售后平台，专业的市场团队人员，多年经验积累的FAE工程师和国内数十家上市公司/行业领头企业的认证供应商。',NULL,NULL,NULL,NULL,NULL,'写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 ','2',NULL,'  数百家覆盖全国优秀的合作伙伴。年轻充满活力，团结的公司团队。优秀的管理，国内唯一的白牌服务器/储存产品LV4级售后平台，专业的市场团队人员，多年经验积累的FAE工程师和国内数十家上市公司/行业领头企业的认证供应商。  数百家覆盖全国优秀的合作伙伴。年轻充满活力，团结的公司团队。优秀的管理，国内唯一的白牌服务器/储存产品LV4级售后平台，专业的市场团队人员，多年经验积累的FAE工程师和国内数十家上市公司/行业领头企业的认证供应商。  数百家覆盖全国优秀的合作伙伴。年轻充满活力，团结的公司团队。优秀的管理，国内唯一的白牌服务器/储存产品LV4级售后平台，专业的市场团队人员，多年经验积累的FAE工程师和国内数十家上市公司/行业领头企业的认证供应商。','KJ2016CX015',0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'123456','城市建设与管理专项--测试02',NULL,NULL,NULL,1,1,'发展计划科','那五',NULL,'新材料',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,9,'0,1,2,3',NULL,'',NULL,0,'1453122587',0,NULL,'  数百家覆盖全国优秀的合作伙伴。年轻充满活力，团结的公司团队。优秀的管理，国内唯一的白牌服务器/储存产品LV4级售后平台，专业的市场团队人员，多年经验积累的FAE工程师和国内数十家上市公司/行业领头企业的认证供应商。  数百家覆盖全国优秀的合作伙伴。年轻充满活力，团结的公司团队。优秀的管理，国内唯一的白牌服务器/储存产品LV4级售后平台，专业的市场团队人员，多年经验积累的FAE工程师和国内数十家上市公司/行业领头企业的认证供应商。  数百家覆盖全国优秀的合作伙伴。年轻充满活力，团结的公司团队。优秀的管理，国内唯一的白牌服务器/储存产品LV4级售后平台，专业的市场团队人员，多年经验积累的FAE工程师和国内数十家上市公司/行业领头企业的认证供应商。','  数百家覆盖全国优秀的合作伙伴。年轻充满活力，团结的公司团队。优秀的管理，国内唯一的白牌服务器/储存产品LV4级售后平台，专业的市场团队人员，多年经验积累的FAE工程师和国内数十家上市公司/行业领头企业的认证供应商。  数百家覆盖全国优秀的合作伙伴。年轻充满活力，团结的公司团队。优秀的管理，国内唯一的白牌服务器/储存产品LV4级售后平台，专业的市场团队人员，多年经验积累的FAE工程师和国内数十家上市公司/行业领头企业的认证供应商。  数百家覆盖全国优秀的合作伙伴。年轻充满活力，团结的公司团队。优秀的管理，国内唯一的白牌服务器/储存产品LV4级售后平台，专业的市场团队人员，多年经验积累的FAE工程师和国内数十家上市公司/行业领头企业的认证供应商。  数百家覆盖全国优秀的合作伙伴。年轻充满活力，团结的公司团队。优秀的管理，国内唯一的白牌服务器/储存产品LV4级售后平台，专业的市场团队人员，多年经验积累的FAE工程师和国内数十家上市公司/行业领头企业的认证供应商。','  数百家覆盖全国优秀的合作伙伴。年轻充满活力，团结的公司团队。优秀的管理，国内唯一的白牌服务器/储存产品LV4级售后平台，专业的市场团队人员，多年经验积累的FAE工程师和国内数十家上市公司/行业领头企业的认证供应商。  数百家覆盖全国优秀的合作伙伴。年轻充满活力，团结的公司团队。优秀的管理，国内唯一的白牌服务器/储存产品LV4级售后平台，专业的市场团队人员，多年经验积累的FAE工程师和国内数十家上市公司/行业领头企业的认证供应商。  数百家覆盖全国优秀的合作伙伴。年轻充满活力，团结的公司团队。优秀的管理，国内唯一的白牌服务器/储存产品LV4级售后平台，专业的市场团队人员，多年经验积累的FAE工程师和国内数十家上市公司/行业领头企业的认证供应商。  数百家覆盖全国优秀的合作伙伴。年轻充满活力，团结的公司团队。优秀的管理，国内唯一的白牌服务器/储存产品LV4级售后平台，专业的市场团队人员，多年经验积累的FAE工程师和国内数十家上市公司/行业领头企业的认证供应商。','  数百家覆盖全国优秀的合作伙伴。年轻充满活力，团结的公司团队。优秀的管理，国内唯一的白牌服务器/储存产品LV4级售后平台，专业的市场团队人员，多年经验积累的FAE工程师和国内数十家上市公司/行业领头企业的认证供应商。  数百家覆盖全国优秀的合作伙伴。年轻充满活力，团结的公司团队。优秀的管理，国内唯一的白牌服务器/储存产品LV4级售后平台，专业的市场团队人员，多年经验积累的FAE工程师和国内数十家上市公司/行业领头企业的认证供应商。  数百家覆盖全国优秀的合作伙伴。年轻充满活力，团结的公司团队。优秀的管理，国内唯一的白牌服务器/储存产品LV4级售后平台，专业的市场团队人员，多年经验积累的FAE工程师和国内数十家上市公司/行业领头企业的认证供应商。  数百家覆盖全国优秀的合作伙伴。年轻充满活力，团结的公司团队。优秀的管理，国内唯一的白牌服务器/储存产品LV4级售后平台，专业的市场团队人员，多年经验积累的FAE工程师和国内数十家上市公司/行业领头企业的认证供应商。  数百家覆盖全国优秀的合作伙伴。年轻充满活力，团结的公司团队。优秀的管理，国内唯一的白牌服务器/储存产品LV4级售后平台，专业的市场团队人员，多年经验积累的FAE工程师和国内数十家上市公司/行业领头企业的认证供应商。  数百家覆盖全国优秀的合作伙伴。年轻充满活力，团结的公司团队。优秀的管理，国内唯一的白牌服务器/储存产品LV4级售后平台，专业的市场团队人员，多年经验积累的FAE工程师和国内数十家上市公司/行业领头企业的认证供应商。',NULL,NULL,NULL,NULL,0,NULL,NULL),(NULL,NULL,NULL,'1453651200','1451577600',NULL,NULL,NULL,NULL,NULL,48,NULL,'dev1453124865',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'机构代码','city construction',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'生物医药',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,5,'0,1,2,3',NULL,'',NULL,0,'1453124865',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL),(NULL,NULL,NULL,'1454169600','1451664000',NULL,NULL,NULL,NULL,NULL,49,NULL,'dev1453125144',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'6666666-y','34545',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'电子信息',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,11,'0,1,2,3',NULL,'',NULL,0,'1453125144',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL);

/*Table structure for table `project_invest` */

DROP TABLE IF EXISTS `project_invest`;

CREATE TABLE `project_invest` (
  `id` int(11) NOT NULL auto_increment,
  `project_id` varchar(30) default NULL,
  `invest_total` double default NULL,
  `invested` double default NULL,
  `fixed_invest` double default NULL,
  `invested_bank` double default NULL,
  `invested_gov` double default NULL,
  `planadd` double default NULL,
  `planadd_bank` double default NULL,
  `planadd_gov` double default NULL,
  `planaddsrc` double default NULL,
  `planaddsrc_com` double default NULL,
  `planaddsrc_bank` double default NULL,
  `planaddsrc_fin` double default NULL,
  `planaddsrc_finpat` double default NULL,
  `planaddsrc_finother` double default NULL,
  `planaddsrc_other` double default NULL,
  `patent_use` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `project_invest` */

insert  into `project_invest`(`id`,`project_id`,`invest_total`,`invested`,`fixed_invest`,`invested_bank`,`invested_gov`,`planadd`,`planadd_bank`,`planadd_gov`,`planaddsrc`,`planaddsrc_com`,`planaddsrc_bank`,`planaddsrc_fin`,`planaddsrc_finpat`,`planaddsrc_finother`,`planaddsrc_other`,`patent_use`) values (1,'dev1453097272',88,44,NULL,22,22,44,22,22,NULL,22,222,44,22,22,2,1),(2,'kno1453111975',20,10,NULL,5,5,10,5,5,NULL,8,8,10,5,5,8,3),(3,'kno1453119627',114,35,NULL,12,23,79,34,45,NULL,12,23,79,34,45,56,2);

/*Table structure for table `project_member` */

DROP TABLE IF EXISTS `project_member`;

CREATE TABLE `project_member` (
  `id` int(11) NOT NULL auto_increment,
  `project_id` varchar(30) default NULL,
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
  `project_process` text NOT NULL,
  `fund_use` text,
  `problem_action` text,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `project_middle` */

insert  into `project_middle`(`id`,`project_id`,`project_process`,`fund_use`,`problem_action`) values (1,'dev1453101198','中期报告','中期报告 ','中期报告'),(2,'dev1453103161','项目进展情况','项目进展情况','项目进展情况项目进展情况项目进展情况'),(3,'dev1453106590','',NULL,NULL),(4,'dev1453114014','项目进展情况','项目进展情况项目进展情况','项目进展情况项目进展情况'),(5,'dev1453117545','啊','啊','啊');

/*Table structure for table `project_mission` */

DROP TABLE IF EXISTS `project_mission`;

CREATE TABLE `project_mission` (
  `id` int(11) NOT NULL auto_increment,
  `project_id` varchar(30) default NULL,
  `year` int(11) default NULL,
  `implement` varchar(500) default NULL,
  `sessionone` varchar(500) default NULL,
  `sessiontwo` varchar(500) default NULL,
  `sessionthree` varchar(500) default NULL,
  `sessionfour` varchar(500) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `project_mission` */

insert  into `project_mission`(`id`,`project_id`,`year`,`implement`,`sessionone`,`sessiontwo`,`sessionthree`,`sessionfour`) values (1,'dev1453097272',0,NULL,'项目的实施目标及考核指标（具有明确的可考核性）\r\n\r\n〔包括1、主要经济指\r\n','项目的实施目标及考核指标（具有明确的可考核性）\r\n\r\n〔包括1、主要经济指\r\n','项目的实施目标及考核指标（具有明确的可考核性）\r\n\r\n〔包括1、主要经济指\r\n','项目的实施目标及考核指标（具有明确的可考核性）\r\n\r\n〔包括1、主要经济指\r\n'),(2,'kno1453111975',0,NULL,'在线申报系统\r\n\r\n前言\r\n在线申报系统网址：http://b.bjqskj.com:8080/website/html/view/template/\r\n获取申报账号和密码两种方式：\r\n（1）	注册\r\n（2）	后台分配账号和密码\r\n\r\n注册\r\n输入网址，进入在线申报系统首页，点击“注册”，进行注册，用于获取登录系统的账号和密码，如图：\r\n \r\n进入注册页面，分两部分填写注册信息：用户信息、企业信息\r\n填写用户相关信息（注意：*为必填），填写完用户信息后点击“下一步”，继续填写企业信息，如图：\r\n \r\n继续填写企业相关信息（注意：*为必填），填写完成后，点击“确定”，完成注册，弹出提示窗口“注册成功，即将进行跳转”，点击弹窗中“确定”，跳回系统首页，如图：\r\n \r\n\r\n登录\r\n输入网址，进入在线申报系统首页（注册后，跳转回首页），在用户登录栏输入用户名、密码和验证码，点击“登录”，验证登录后，即可进入系统申报项目，如图：\r\n','在线申报系统\r\n\r\n前言\r\n在线申报系统网址：http://b.bjqskj.com:8080/website/html/view/template/\r\n获取申报账号和密码两种方式：\r\n（1）	注册\r\n（2）	后台分配账号和密码\r\n\r\n注册\r\n输入网址，进入在线申报系统首页，点击“注册”，进行注册，用于获取登录系统的账号和密码，如图：\r\n \r\n进入注册页面，分两部分填写注册信息：用户信息、企业信息\r\n填写用户相关信息（注意：*为必填），填写完用户信息后点击“下一步”，继续填写企业信息，如图：\r\n \r\n继续填写企业相关信息（注意：*为必填），填写完成后，点击“确定”，完成注册，弹出提示窗口“注册成功，即将进行跳转”，点击弹窗中“确定”，跳回系统首页，如图：\r\n \r\n\r\n登录\r\n输入网址，进入在线申报系统首页（注册后，跳转回首页），在用户登录栏输入用户名、密码和验证码，点击“登录”，验证登录后，即可进入系统申报项目，如图：\r\n','在线申报系统\r\n\r\n前言\r\n在线申报系统网址：http://b.bjqskj.com:8080/website/html/view/template/\r\n获取申报账号和密码两种方式：\r\n（1）	注册\r\n（2）	后台分配账号和密码\r\n\r\n注册\r\n输入网址，进入在线申报系统首页，点击“注册”，进行注册，用于获取登录系统的账号和密码，如图：\r\n \r\n进入注册页面，分两部分填写注册信息：用户信息、企业信息\r\n填写用户相关信息（注意：*为必填），填写完用户信息后点击“下一步”，继续填写企业信息，如图：\r\n \r\n继续填写企业相关信息（注意：*为必填），填写完成后，点击“确定”，完成注册，弹出提示窗口“注册成功，即将进行跳转”，点击弹窗中“确定”，跳回系统首页，如图：\r\n \r\n\r\n登录\r\n输入网址，进入在线申报系统首页（注册后，跳转回首页），在用户登录栏输入用户名、密码和验证码，点击“登录”，验证登录后，即可进入系统申报项目，如图：\r\n','在线申报系统\r\n\r\n前言\r\n在线申报系统网址：http://b.bjqskj.com:8080/website/html/view/template/\r\n获取申报账号和密码两种方式：\r\n（1）	注册\r\n（2）	后台分配账号和密码\r\n\r\n注册\r\n输入网址，进入在线申报系统首页，点击“注册”，进行注册，用于获取登录系统的账号和密码，如图：\r\n \r\n进入注册页面，分两部分填写注册信息：用户信息、企业信息\r\n填写用户相关信息（注意：*为必填），填写完用户信息后点击“下一步”，继续填写企业信息，如图：\r\n \r\n继续填写企业相关信息（注意：*为必填），填写完成后，点击“确定”，完成注册，弹出提示窗口“注册成功，即将进行跳转”，点击弹窗中“确定”，跳回系统首页，如图：\r\n \r\n\r\n登录\r\n输入网址，进入在线申报系统首页（注册后，跳转回首页），在用户登录栏输入用户名、密码和验证码，点击“登录”，验证登录后，即可进入系统申报项目，如图：\r\n'),(3,'kno1453119627',0,NULL,'市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收','市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收','市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收','市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收、利润等）； 2、主要技术指标：如项市场规模、效益（包括销售收入、上缴税收');

/*Table structure for table `project_org` */

DROP TABLE IF EXISTS `project_org`;

CREATE TABLE `project_org` (
  `id` int(11) NOT NULL auto_increment,
  `task_project_id` varchar(20) default NULL,
  `project_id` varchar(30) default NULL,
  `org_id` int(11) default NULL,
  `project_name` varchar(30) default NULL,
  `org_name` varchar(30) default NULL,
  `org_duty` varchar(100) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `project_org` */

insert  into `project_org`(`id`,`task_project_id`,`project_id`,`org_id`,`project_name`,`org_name`,`org_duty`) values (11,NULL,'dev1453097453',NULL,NULL,'',''),(12,NULL,'dev1453101198',NULL,NULL,'1','1'),(13,NULL,'dev1453101198',NULL,NULL,'22','2'),(14,NULL,'dev1453101198',NULL,NULL,'2','2'),(15,NULL,'dev1453101198',NULL,NULL,'2','2'),(18,'dev1453101198',NULL,NULL,NULL,'千松','啊啊'),(19,'dev1453101198',NULL,NULL,NULL,'抢电脑','版本'),(20,NULL,'dev1453101496',NULL,NULL,'北京千松','硬件'),(21,NULL,'dev1453101496',NULL,NULL,'北京航宇','软件'),(26,NULL,'dev1453103161',NULL,NULL,'单位名称','主要任务分工'),(27,NULL,'dev1453103161',NULL,NULL,'单位名称','主要任务分工'),(28,NULL,'dev1453103161',NULL,NULL,'单位名称','主要任务分工'),(45,'dev1453101496',NULL,NULL,NULL,'北京千松','东莞'),(46,'dev1453101496',NULL,NULL,NULL,'华北小鸟','拆东西'),(48,'dev1453103161',NULL,NULL,NULL,'1','1'),(49,'dev1453103161',NULL,NULL,NULL,'2','2'),(52,'dev1453101596',NULL,NULL,NULL,'',''),(53,'dev1453106590',NULL,NULL,NULL,'千松','大部分'),(74,NULL,'dev1453114014',NULL,NULL,'千松','收钱'),(75,NULL,'dev1453114014',NULL,NULL,'万松','发钱'),(76,NULL,'dev1453114014',NULL,NULL,'已送','没钱'),(80,NULL,'dev1453117545',NULL,NULL,'千松','后台'),(82,'dev1453117545',NULL,NULL,NULL,'1','1'),(83,NULL,'dev1453122587',NULL,NULL,'惠普','电脑生产'),(85,'dev1453122587',NULL,NULL,NULL,'看看','看看');

/*Table structure for table `project_patent` */

DROP TABLE IF EXISTS `project_patent`;

CREATE TABLE `project_patent` (
  `id` int(11) NOT NULL auto_increment,
  `project_id` varchar(30) default NULL,
  `patent_num` int(11) default NULL,
  `invent_num` int(11) default NULL,
  `function_patent` int(11) default NULL,
  `patent_design` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `project_patent` */

insert  into `project_patent`(`id`,`project_id`,`patent_num`,`invent_num`,`function_patent`,`patent_design`) values (1,'dev1453097272',0,0,0,0),(2,'kno1453111975',15,5,5,5),(3,'kno1453119627',44,11,11,22);

/*Table structure for table `project_principal` */

DROP TABLE IF EXISTS `project_principal`;

CREATE TABLE `project_principal` (
  `main_division` varchar(255) default NULL,
  `id` int(11) NOT NULL auto_increment,
  `task_project_id` varchar(50) default NULL,
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
  `leader_achieve` text,
  `tech_pos` varchar(50) default NULL,
  `leader_postal` varchar(20) default NULL,
  `leader_tele` varchar(20) default NULL,
  `leader_job` varchar(30) default NULL,
  `leader_opinion` text,
  `work_org` text,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `project_principal` */

insert  into `project_principal`(`main_division`,`id`,`task_project_id`,`project_id`,`leader_name`,`leader_sex`,`leader_birth`,`leader_ID`,`leader_edu`,`leader_major`,`leader_phone`,`leader_address`,`leader_fax`,`leader_email`,`leader_achieve`,`tech_pos`,`leader_postal`,`leader_tele`,`leader_job`,`leader_opinion`,`work_org`) values (NULL,1,NULL,'dev1453097453','',0,'','','','','','','','','','','','','',NULL,NULL),(NULL,2,NULL,'dev1453097272','李明',0,'2016-01-12',NULL,'4',NULL,NULL,NULL,NULL,NULL,NULL,'校长',NULL,NULL,'老师',NULL,NULL),(NULL,3,NULL,'dev1453101198','1',1,'0001-01-01','130325462154123652','3','计算机','13865412563','通州区','0000-123456','123516@qq.com','好业绩','技术','101100','13856221452','管理员',NULL,NULL),(NULL,4,NULL,'dev1453098333','',NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,5,NULL,'dev1453101496','礼拜',0,'2016-01-04','135655689465995656','2','计算机','13931853559','北京千松','0418-60551583','15356965656@qq.com','毕业答辩没有通过。','技工','056300','15356965656','工程师',NULL,NULL),('大部分',6,'dev1453101198',NULL,'啊啊',0,'2016-01-06',NULL,'3','计算机',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'经理',NULL,'千松'),(NULL,7,NULL,'dev1453103161','李明',0,'2016-01-07','130131199212302222','','计算机','010-88888888','邯郸','010-8888888','333@qq.com','sssssssssss','程序员','000000','18303306252','实习',NULL,NULL),('网管',8,'dev1453101496',NULL,'张三',0,'2016-01-05',NULL,'1','网管',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'网管',NULL,'飞扬网吧'),('加息噢诶',9,'dev1453103161',NULL,'李明',1,'2016-01-05',NULL,'','计算机',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'校长',NULL,'我'),('',10,'dev1453101596',NULL,'姓名',0,'2016-01-14',NULL,'2','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,''),(NULL,11,NULL,'dev1453106590','撒名',NULL,NULL,NULL,NULL,NULL,'13752631456',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('大部分',12,'dev1453106590',NULL,'意义',1,'2016-01-21',NULL,'5','计算机',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'经理',NULL,'千松'),(NULL,13,NULL,'dev1453112447','大名鼎鼎',NULL,NULL,NULL,NULL,NULL,'13856412563',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,14,NULL,'dev1453114020','笨蛋',NULL,NULL,NULL,NULL,NULL,'13785632145',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,15,NULL,'kno1453111975','测试',1,'2016-01-11',NULL,'2',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,16,NULL,'sci1453109921','林书豪',NULL,NULL,NULL,NULL,NULL,'15612355326',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,17,NULL,'dev1453114014','李明',0,'2016-01-20','1201231252523252622','2','驾驶','18303305262','通讯地址','101-88888888','10101@qq.com','我就是一个大好人','教师','000000','18303305262','教师',NULL,NULL),(NULL,18,NULL,'dev1453117545','朱博士',1,'2016-01-01','130324568974561236','4','开发','13762564569','百度','0000-123456','122335@qq.com','得到','技术员','101100','13452136541','项目经理',NULL,NULL),(NULL,19,NULL,'kno1453119627','李明',0,'2016-01-06',NULL,'3',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('后台',20,'dev1453117545',NULL,'啊啊',0,'2016-01-07',NULL,'','计算机',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'经理',NULL,'气啊送'),(NULL,21,NULL,'dev1453122587','苏文定',0,'2016-01-05','214444198702050012','3','计算机','13115224788','北京市通州区','010-45225587','255455858@qq.com','写过PHP+MySQL的程序员都知道有时间差，UNIX时间戳和格式化日期是我们常打交道的两个时间表示形式，Unix时间戳存储、处理方便，但是不直观，格式化日期直观，但是处理起来不如Unix时间戳那么自如，所以有的时候需要互相转换，下面给出互相转换的几种转换方式。 ','高工','100000','15114458887','组长',NULL,NULL),('看看',22,'dev1453122587',NULL,'看看',1,'2016-01-05',NULL,'','看看',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'看看',NULL,'看看');

/*Table structure for table `project_summary` */

DROP TABLE IF EXISTS `project_summary`;

CREATE TABLE `project_summary` (
  `id` int(11) NOT NULL auto_increment,
  `project_id` varchar(30) NOT NULL,
  `assign_plan` text,
  `actual_plan` varchar(200) default NULL,
  `assign_target` text,
  `actual_target` varchar(200) default NULL,
  `assign_research` text,
  `actual_research` varchar(200) default NULL,
  `achievement` text,
  `other_suggest` text,
  `problem` varchar(200) default NULL,
  `generalize_plan` text,
  `org_suggest` text,
  `chair_suggest` varchar(200) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `project_summary` */

insert  into `project_summary`(`id`,`project_id`,`assign_plan`,`actual_plan`,`assign_target`,`actual_target`,`assign_research`,`actual_research`,`achievement`,`other_suggest`,`problem`,`generalize_plan`,`org_suggest`,`chair_suggest`) values (1,'dev1453101198','好',NULL,'好',NULL,'好',NULL,'好','好',NULL,'好','好',NULL),(2,'dev1453101496','1',NULL,'顶顶顶顶顶',NULL,'主要研发内容主要研发内容主要研发内容主要研发内容主要研发内容主要研发内容主要研发内容主要研发内容主要研发内容主要研发内容主要研发内容主要研发内容主要研发内容主要研发内容主要研发内容主要研发内容主要研发内容主要研发内容主要研发内容主要研发内容主要研发内容主要研发内容主要研发内容主要研发内容主要研发内容主要研发内容主要研发内容主要研发内容主要研发内容主要研发内容主要研发内容主要研发内容主要研发内容主要研发内容主要研发内容主要研发内容主要研发内容主要研发内容主要研发内容主要研发内容主要研发内容主要研发内容主要研发内容主要研发内容主要研发内容主要研发内容主要研发内容主要研发内容主要研发内容主要研发内容主要研发内容主要研发内容',NULL,'1\r\n2\r\n3\r\n4\r\n5\r\n6\r\n7\r\n8\r\n9\r\n10\r\n成果信息','1\r\n2\r\n3\r\n4\r\n5\r\n6\r\n7\r\n8\r\n9\r\n10\r\n其它说明及存在问题',NULL,'成果及推广应用计划\r\n成果及推广应用计划成果及推广应用计划\r\n成果及推广应用计划\r\n成果及推广应用计划\r\n成果及推广应用计划\r\n成果及推广应用计划\r\n\r\nv成果及推广应用计划\r\n成果及推广应用计划\r\n成果及推广应用计划\r\n成果及推广应用计划','意见111',NULL),(3,'dev1453117545','啊啊',NULL,'啊',NULL,'啊',NULL,'啊','啊',NULL,'啊','啊',NULL);

/*Table structure for table `project_target` */

DROP TABLE IF EXISTS `project_target`;

CREATE TABLE `project_target` (
  `id` int(11) NOT NULL auto_increment,
  `project_id` varchar(30) default NULL,
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
  `apply_start` varchar(50) default NULL,
  `apply_end` varchar(50) default NULL,
  `attatch_name` varchar(300) default NULL,
  `apply_stage` int(11) default '1',
  `setup_stage` int(11) default '1',
  `carry_stage` int(11) default '1',
  `check_stage` int(11) default '1',
  `project_leader` varchar(20) default NULL,
  `project_table` text COMMENT '存储四个阶段的project_table的表单，采用json编码',
  `is_new` tinyint(4) default '0',
  `is_delete` int(11) default '0',
  `is_public` tinyint(4) default '0' COMMENT '发布标记，0默认未发布，1发布',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `project_type` */

insert  into `project_type`(`id`,`name`,`isfather`,`father`,`dep_type`,`apply_status`,`apply_start`,`apply_end`,`attatch_name`,`apply_stage`,`setup_stage`,`carry_stage`,`check_stage`,`project_leader`,`project_table`,`is_new`,`is_delete`,`is_public`) values (1,'生态环境建设专项',1,1,0,1,'1453046400','1454255999','1,12,13,14,15,16,17,18',1,1,1,1,NULL,NULL,1,0,1),(2,'城市建设与管理专项',1,2,0,1,'1453046400','1454255999','1,12,13,14,15,16,17,18',1,1,1,1,NULL,NULL,1,0,1),(3,'科技与文化、卫生、教育融合发展专项',1,3,0,1,'1453046400','1454255999','1,12,13,14,15,16,17,18',1,1,1,1,NULL,NULL,1,0,1),(4,'科技农业发展专项',1,4,0,1,'1453046400','1454255999','1,12,13,14,15,16,17,18',1,1,1,1,NULL,NULL,1,0,1),(5,'科技服务业促进专项',1,0,-1,0,NULL,NULL,'1,5,12,13,14,15,16,17,18',1,1,1,1,NULL,NULL,1,0,1),(6,'支持创新平台建设项目',0,5,0,1,'1453046400','1454255999','1,5,12,13,14,15,16,17,18',1,1,1,1,NULL,NULL,1,0,1),(7,'支持初创期科技企业孵化器、大学科技园发展项目',0,5,1,1,'1453046400','1454255999','1,9,12,13,14,15,16,17,18',1,1,1,1,NULL,NULL,1,0,1),(8,'支持市级以上科技企业孵化器资质认定及后期运营项目',0,5,1,1,'1453046400','1454255999','1,9,12,13,14,15,16,17,18',1,1,1,1,NULL,NULL,1,0,1),(9,'支持市级以上大学科技园资质认定及后期运营项目',0,5,1,1,'1453046400','1454255999','1,9,12,13,14,15,16,17,18',1,1,1,1,NULL,NULL,1,0,1),(10,'支持重点功能区及园区建设项目',0,5,0,1,'1453046400','1454255999','1,12,13,14,15,16,17,18',1,1,1,1,NULL,NULL,1,0,1),(11,'专利实施项目',1,11,2,1,'1453046400','1454255999','21,22,23,24,25,26',1,1,1,1,NULL,NULL,1,0,1),(12,'科技创新人才资助与奖励',1,12,1,1,'1453046400','1454255999','19,20',1,0,0,0,NULL,NULL,1,0,1),(35,'',1,0,-1,0,NULL,NULL,'3,12,14,16',1,1,1,1,NULL,NULL,1,0,0),(36,'新年项目',1,35,0,0,NULL,NULL,'3,12,14,16',1,1,1,1,NULL,NULL,1,0,0);

/*Table structure for table `researchers` */

DROP TABLE IF EXISTS `researchers`;

CREATE TABLE `researchers` (
  `id` int(11) NOT NULL auto_increment,
  `project_id` varchar(30) NOT NULL,
  `researcher_name` varchar(20) default NULL,
  `researcher_sex` varchar(20) default NULL,
  `researcher_birth` varchar(20) default NULL,
  `researcher_ID` varchar(20) default NULL,
  `researcher_pos` varchar(20) default NULL,
  `researcher_job` varchar(20) default NULL,
  `researcher_edu` varchar(20) default NULL,
  `researcher_major` varchar(20) default NULL,
  `task_project_id` varchar(30) NOT NULL,
  `researcher_org` varchar(20) default NULL,
  `researcher_work` varchar(20) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `researchers` */

insert  into `researchers`(`id`,`project_id`,`researcher_name`,`researcher_sex`,`researcher_birth`,`researcher_ID`,`researcher_pos`,`researcher_job`,`researcher_edu`,`researcher_major`,`task_project_id`,`researcher_org`,`researcher_work`) values (23,'dev1453097453','魏泊天','男','1987-01-20','210451198701200014','高工','经理','大专','计算机','','万紫千红公司','监管'),(24,'dev1453097453','方法','女','2016-01-11','210415197802051144','就','就','高中','方法','','发啊','发发'),(25,'dev1453097453','jjj ','1','2016-01-01','210415197802051144','ff','ff','3','ff','','ff','ff'),(26,'dev1453101198','大名','0','2016-01-02','130325154126321452','技术员','管理员','1','计算机','','千松科技','打不跟'),(27,'dev1453101198','夏天','0','2016-01-02','130325154126321452','技术员','管理员','2','财务','','千松科技','小不跟'),(29,'','好的','0','2016-01-01','135624456321231111','经理','经理','3','经费','dev1453101198','千松','往往'),(30,'dev1453101496','姓名','0','2016-01-08','135655689465995656','技术职称','职务','0','从事专业','','工作单位','主要分工'),(31,'dev1453101496','姓名1','0','2016-01-09','135655689465995656','技术职称','职务','0','从事专业','','工作单位','主要分工'),(36,'dev1453103161','liming','0','2016-01-05','125212523232625252','liming','liming','0','计算机','','学院','老大'),(37,'dev1453103161','125212523232625252','0','2016-01-05','125212523232625252','','s','3','','','',''),(49,'','李荣浩','0','2016-01-12','135655612565561488','网管','网管','5','网管','dev1453101496','网管','网管'),(50,'','林忆莲','0','2016-01-05','135655612565561488','大网管','大网管','0','大网管','dev1453101496','大网管','大网管'),(53,'','','0','','','','','0','','dev1453103161','',''),(54,'','','0','','','','','0','','dev1453103161','',''),(57,'','','0','','','','','0','','dev1453101596','',''),(58,'','一一一','0','2016-01-06','130324562136547896','经理','经理','0','经理','dev1453106590','',''),(70,'dev1453114014','李明','0','2016-01-05','130125212512522222','教师','教师','2','教师','','邯郸学院','学习'),(74,'dev1453117545','www','男','2016-01-01','130324156412563211','经理','组长','初中','技术','','千松','朱'),(77,'','啊','0','2016-01-01','130325412564512522','职称','经理','0','计算机','dev1453117545','千松','后台'),(78,'','啊','0','2016-01-01',' 132123121111111111','职称','经理','0','计算机','dev1453117545','千松','前台'),(79,'dev1453122587','苏蝉儿','女','2016-01-06','211455198802050012','业务员','支援','本科','财务','','兴隆','财务'),(80,'dev1453122587','苏志欢','','2016-01-12','211455198602050012','业务员','支援','','大家','','阿萨德撒娇','撒打算'),(83,'','看看','0','2016-01-01','210455199202021111','看看','看看','0','看看','dev1453122587','看看','看看'),(84,'','看看','','2016-01-01','210455199202021111','看看','看看','','看看','dev1453122587','看看','看看');

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

insert  into `run_status`(`id`,`org_code`,`the_year`,`prof_tech`,`total_income`,`rent_income`,`property_income`,`invest_income`,`public_tec_income`,`other_income`,`profit`,`hand_tax`,`seed_total_fund`,`seed_inve_sum`,`hatch_com_num`,`public_inve_sum`,`public_service_income`) values (1,'密码：123','2016',NULL,1,1,1,1,1,1,1,1,1,1,1,1,2),(2,'密码：123','2017',NULL,1,1,1,1,1,1,2,2,2,2,2,2,2),(3,'密码：123','2018',NULL,1,1,1,1,1,1,2,2,2,2,2,2,2),(4,'密码：123','2014',NULL,1,1,1,1,1,1,1,1,1,1,1,1,1),(5,'密码：123','2015',NULL,1,1,0,1,1,1,0,1,1,0,1,1,0);

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

insert  into `shareholder_info`(`id`,`org_code`,`shareholder_name`,`stock_ratio`) values (5,'qskj001','3',3),(6,'qskj001','4',4),(7,'zgf001','',0);

/*Table structure for table `staff_info` */

DROP TABLE IF EXISTS `staff_info`;

CREATE TABLE `staff_info` (
  `middel_pos` int(11) default NULL,
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

insert  into `staff_info`(`middel_pos`,`id`,`org_code`,`staff_num`,`junior`,`undergraduate`,`graduate`,`doctor`,`junior_ratio`,` undergraduate_ratio`,`graduate_ratio`,`doctor_ratio`,`service_num`,`researcher_num`) values (33,1,'qskj001',0,6,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,2),(NULL,2,'机构代码',33,22,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,22),(NULL,3,'',0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(NULL,4,'密码：123',0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(NULL,5,'zgf001',0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(NULL,6,'6666666-y',3,4,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,5);

/*Table structure for table `subtable_list` */

DROP TABLE IF EXISTS `subtable_list`;

CREATE TABLE `subtable_list` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `st_name` varchar(255) default 'default',
  `tpl_url` varchar(255) default NULL,
  `relative_fields` varchar(50) default NULL COMMENT '关联字段',
  `db_fields` varchar(100) default NULL COMMENT '数据表中的字段名称',
  `db_table` varchar(100) default NULL,
  `is_check` int(11) default '0' COMMENT '0',
  `table_type_id` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `subtable_list` */

insert  into `subtable_list`(`id`,`name`,`st_name`,`tpl_url`,`relative_fields`,`db_fields`,`db_table`,`is_check`,`table_type_id`) values (1,'项目承担单位基本信息','org_info','/website/html/view/template/apply/attach_1/org_info.php',NULL,NULL,NULL,0,1),(2,'项目的目的、意义及必要性','project_mean','/website/html/view/template/apply/attach_1/project_meaning.php','project_id','project_meaning','project_info',1,1),(3,'项目相关行业、领域国内外研究发展现状、趋势以及本单位在相关领域的工作基础','work_base','/website/html/view/template/apply/attach_1/project_status.php','project_id','project_status','project_info',1,1),(4,'项目任务与目标、考核指标','project_target','/website/html/view/template/apply/attach_1/project_target.php','project_id','project_mission,project_aim,project_kpi','project_info',1,1),(5,'项目研究开发内容','project_content','/website/html/view/template/apply/attach_1/project_content.php','project_id','project_content','project_info',1,1),(6,'项目技术方案与技术路线','tech_route','/website/html/view/template/apply/attach_1/project_techway.php','project_id','tech_way,project_manage,delegation_task','project_info',1,1),(7,'项目各年度任务目标、考核指标及研究开发内容完成的计划进度','project_plan','/website/html/view/template/apply/attach_1/project_ann_plan.php',NULL,NULL,NULL,0,1),(8,'项目经费预算','project_budget','/website/html/view/template/apply/attach_1/project_money.php',NULL,NULL,NULL,0,1),(9,'项目实施的风险分析及规避预案','project_risk','/website/html/view/template/apply/attach_1/project_risk.php','project_id','project_risk','project_info',1,1),(10,'预期成果形式、知识产权归属与管理','expect_manage','/website/html/view/template/apply/attach_1/project_expert_form.php','project_id','project_expect','project_info',1,1),(11,'项目完成后的经济社会效益分析及成果推广方案','recommend_plan','/website/html/view/template/apply/attach_1/project_economy_effect.php','project_id','project_effect','project_info',1,1),(12,'项目承担单位、参加单位、项目负责人、项目研究人员','project_member','/website/html/view/template/apply/attach_1/project_member.php',NULL,NULL,NULL,0,1),(13,'项目承担单位基本信息','default','/website/html/view/template/Projectapp/org_info.php',NULL,NULL,NULL,0,12),(14,'项目的任务、目标及考核指标','project_target','/website/html/view/template/Projectapp/task_project_target.php',NULL,NULL,NULL,0,12),(15,'主要研究开发内容','default','/website/html/view/template/Projectapp/task_project_content.php',NULL,NULL,NULL,0,12),(16,'项目技术方案与技术路线','default','/website/html/view/template/Projectapp/task_project_techway.php',NULL,NULL,NULL,0,12),(17,'项目各年度任务目标、考核指标及研究开发内容完成的计划进度','default','/website/html/view/template/Projectapp/task_project_ann_plan.php','project_id',NULL,NULL,0,12),(18,'项目经费预算','default','/website/html/view/template/Projectapp/task_project_money.php',NULL,NULL,NULL,0,12),(19,'预期成果形式、知识产权归属于管理','default','/website/html/view/template/Projectapp/task_project_expert_form.php',NULL,NULL,NULL,0,12),(20,'项目承担单位、参加单位、项目负责人、项目研究人员','default','/website/html/view/template/Projectapp/task_project_member.php',NULL,NULL,NULL,0,12),(21,'其他条款','default','/website/html/view/template/Projectapp/other_condition.php',NULL,NULL,NULL,0,12),(22,'任务书各方','default','/website/html/view/template/Projectapp/plan_parties.php',NULL,NULL,NULL,0,12),(27,'项目主要参加人员登记表','main_staff','/website/html/view/template/apply/patent_implement/attach3_patent/main_staff.php',NULL,NULL,NULL,0,21),(28,'单位提供相关材料清单','stuff_list','/website/html/view/template/apply/patent_implement/attach3_patent/stuff_list.php',NULL,NULL,NULL,0,21),(29,'项目经费总预算','pro_fund','/website/html/view/template/apply/patent_implement/patent_grant/pro_fund.php',NULL,NULL,NULL,0,23),(30,'项目承担单位、协作单位、主要人员','pro_member','/website/html/view/template/apply/patent_implement/patent_grant/pro_menber.php',NULL,NULL,NULL,0,23),(31,'通州区专利实施项目经费总决算表','project_fund','/website/html/view/template/apply/patent_implement/project_summary/project_fund.php',NULL,NULL,NULL,0,23),(32,'协议书各方','book_others','/website/html/view/template/apply/patent_implement/patent_grant/book_others.php',NULL,NULL,NULL,0,23),(33,'企业基本情况','org_info','/website/html/view/template/apply/patent_implement/attach3_patent/org_info.php',NULL,NULL,NULL,0,21),(34,'项目基本情况','project_info','/website/html/view/template/apply/patent_implement/attach3_patent/project_info.php','project_id','patent_name,patent_code','patent_list',1,21),(35,'项目资金情况','project_fund','/website/html/view/template/apply/patent_implement/attach3_patent/project_fund.php',NULL,NULL,NULL,0,21),(36,'区知识产权局审批意见','community_opinion','/website/html/view/template/apply/patent_implement/attach3_patent/community_opinion.php',NULL,NULL,NULL,0,21),(37,'项目的实施目标及考核指标','pro_target','/website/html/view/template/apply/patent_implement/patent_grant/pro_target.php',NULL,NULL,NULL,0,23),(38,'项目实施主要内容及意义','pro_meaning','/website/html/view/template/apply/patent_implement/patent_grant/pro_meaning.php',NULL,NULL,NULL,0,23),(39,'项目实施计划和阶段任务','pro_doing','/website/html/view/template/apply/patent_implement/patent_grant/pro_doing.php',NULL,NULL,NULL,0,23),(40,'项目预期成果提供形式、知识产权归属','pro_belong','/website/html/view/template/apply/patent_implement/patent_grant/pro_belong.php',NULL,NULL,NULL,0,23),(41,'其他条款','other_rule','/website/html/view/template/apply/patent_implement/patent_grant/other_rule.php',NULL,NULL,NULL,0,23),(42,'课题资金使用情况','item_fund','/website/html/view/template/apply/patent_implement/work_summary/item_fund.php',NULL,NULL,NULL,0,25),(43,'课题实施过程经验总结及下一步工作计划','item_plan','/website/html/view/template/apply/patent_implement/work_summary/item_plan.php',NULL,NULL,NULL,0,25),(44,'课题的经济、社会效益分析','item_profit','/website/html/view/template/apply/patent_implement/work_summary/item_profit.php',NULL,NULL,NULL,0,25),(45,'项目目标及考核指标完成情况','project_target','/website/html/view/template/apply/patent_implement/work_summary/profit_target.php',NULL,NULL,NULL,0,25),(46,'课题实施过程中所作的具体工作','project_detail','/website/html/view/template/apply/patent_implement/work_summary/project_detail.php',NULL,NULL,NULL,0,25),(47,'项目立项背景和基本情况','project_back','/website/html/view/template/apply/patent_implement/work_summary/project_back.php',NULL,NULL,NULL,0,25),(48,'项目资金使用情况','funds_use','/website/html/view/template/apply/patent_implement/check_material/funds_use.php',NULL,NULL,NULL,0,18),(1913,'合作单位基本情况','coorg_info','/website/html/view/template/apply/attach_2/coorg_info.php',NULL,NULL,NULL,0,2),(1914,'项目基本情况','project_info','/website/html/view/template/apply/attach_2/project_info.php',NULL,NULL,NULL,0,2),(1915,'签署意见及承诺','approve','/website/html/view/template/Projectapp/project_opinion_promise.php','project_id','leader_opinion','project_principle',1,2),(1916,'申报单位基本情况','org_info','/website/html/view/template/apply/attach_3/org_info.html',NULL,NULL,NULL,0,3),(1917,'项目基本情况','project_info','/website/html/view/template/apply/attach_3/project_info.php',NULL,NULL,NULL,0,3),(1918,'签署意见及承诺','approve','/website/html/view/template/Projectapp/project_opinion_promise.php','project_id','leader_opinion','project_principle',1,3),(1919,'申报单位基本情况','default','/website/html/view/template/apply/attach_4/org_info.html',NULL,NULL,NULL,0,4),(1920,'项目基本情况','default','/website/html/view/template/apply/attach_4/project_info.php',NULL,NULL,NULL,0,4),(1921,'签署意见及承诺','approve','/website/html/view/template/Projectapp/project_opinion_promise.php','project_id','leader_opinion','project_principle',1,4),(1922,'申报单位基本情况','org_info','/website/html/view/template/apply/attach_5/org_info.html',NULL,NULL,NULL,0,5),(1923,'技术合同登记奖励资金申报表','org_info','/website/html/view/template/apply/attach_6/org_info.php',NULL,NULL,NULL,0,6),(1924,'支持技术输出能力提升项目申报书','default','/website/html/view/template/apply/attach_7/org_info.html',NULL,NULL,NULL,0,7),(1925,'申报单位基本情况','default','/website/html/view/template/apply/attach_8/org_info.html',NULL,NULL,NULL,0,8),(1926,'基本信息','default','/website/html/view/template/apply/attach_9/org.php',NULL,NULL,NULL,0,9),(1927,'孵化场地及管理团队','default','/website/html/view/template/apply/attach_9/manager_team.html',NULL,NULL,NULL,0,9),(1928,'经营状况','default','/website/html/view/template/apply/attach_9/manage_state.html',NULL,NULL,NULL,0,9),(1929,'服务能力','default','/website/html/view/template/apply/attach_9/service.html',NULL,NULL,NULL,0,9),(1930,'孵化成效','default','/website/html/view/template/apply/attach_9/hatch.html',NULL,NULL,NULL,0,9),(1931,'申报单位运行模式及特点','org_special','/website/html/view/template/apply/attach_9/special.html','project_id','special','incubator',1,9),(1932,'申报单位公共服务平台或公共技术平台运行情况','org_run','/website/html/view/template/apply/attach_9/running.html','project_id','running','incubator',1,9),(1933,'申报单位近两年发生的对单位发展有影响的事件','org_influence','/website/html/view/template/apply/attach_9/influence.html','project_id','influence','incubator',1,9),(1934,'申报单位上一年度开展的孵化服务工作','org_service','/website/html/view/template/apply/attach_9/service_job.html','project_id','service_job','incubator',1,9),(1935,'申报项目简介','org_abstract','/website/html/view/template/apply/attach_9/abstract.html','project_id','abstract','incubator',1,9),(1936,'基本信息','default','/website/html/view/template/apply/attach_10/org.php',NULL,NULL,NULL,0,10),(1937,'服务团队','default','/website/html/view/template/apply/attach_10/service_team.html',NULL,NULL,NULL,0,10),(1938,'经营状况','default','/website/html/view/template/apply/attach_10/manager.html',NULL,NULL,NULL,0,10),(1939,'服务能力','default','/website/html/view/template/apply/attach_10/service.html',NULL,NULL,NULL,0,10),(1940,'申报单位运行模式及特点','org_special','/website/html/view/template/apply/attach_10/special.html','project_id','special','support_scitec',1,10),(1941,'申报单位科技服务情况','org_service_thing','/website/html/view/template/apply/attach_10/service_thing.html','project_id','service_thing','support_scitec',1,10),(1942,'申报单位近二年开展的科技服务工作','org_service_job','/website/html/view/template/apply/attach_10/service_job.html','project_id','service_job','support_scitec',1,10),(1943,'申报项目简介','org_abtract','/website/html/view/template/apply/attach_10/abstract.html','project_id','abstract','support_scitec',1,10),(1944,'通州区高新技术企业认定服务机构资助资金申请表','default','/website/html/view/template/apply/attach_11/org.php',NULL,NULL,NULL,0,11),(1945,'专家组论证意见','default','/website/html/view/template/Projectapp/expert_arguments.php',NULL,NULL,NULL,0,13),(1946,'项目实施方案论证专家签字表','default','/website/html/view/template/Projectapp/expert_sign.php',NULL,NULL,NULL,0,13),(1948,'调整申请表申请基本信息','default','/website/html/view/template/Implement/modify_apply.php',NULL,NULL,NULL,0,14),(1949,'项目进展情况','project_process','/website/html/view/template/Implement/middle.php','project_id','project_process','middle_report',1,15),(1950,'经费使用情况','fund_use','/website/html/view/template/Implement/project_fund_use.php','project_id','fund_use','middle_report',1,15),(1951,'存在问题及采取措施','problem_action','/website/html/view/template/Implement/project_problem_action.php','project_id','problem_action','middle_report',1,15),(1952,'项目验收专家组意见','accept_expert_opinion','/website/html/view/template/Acceptance/expert_arguments.php','project_id','expert_opinion','project_info',1,16),(1953,'验收专家组签字','default','/website/html/view/template/Acceptance/expert_sign.php',NULL,NULL,NULL,0,16),(1954,'项目经费总决算表','default','/website/html/view/template/total_fund.php',NULL,NULL,NULL,0,17),(1955,'任务目标','assign_plan','/website/html/view/template/Acceptance/project_goal.php','project_id','assign_plan','project_summary',1,18),(1956,'考核指标','assign_target','/website/html/view/template/project_kpi.php','project_id','assign_target','project_summary',1,18),(1957,'主要研究内容','assign_research','/website/html/view/template/project_chief_content.php','project_id','assign_research','project_summary',1,18),(1958,'成果信息','achievement','/website/html/view/template/project_achievement.php','project_id','achievement','project_summary',1,18),(1959,'其他说明及存在问题','other_suggest','/website/html/view/template/project_other_suggest.php','project_id','other_suggest','project_summary',1,18),(1960,'成果及推广应用计划','generalize_plan','/website/html/view/template/project_generalize_plan.php','project_id','generalize_plan','project_summary',1,18),(1961,'单位意见','org_suggest','/website/html/view/template/project_org_suggest.php','project_id','org_suggest','project_summary',1,18),(1962,'基本情况','default','/website/html/view/template/apply/genious_award/org_info.php',NULL,NULL,NULL,0,18),(1963,'2014年度主要工作实绩','work_product','/website/html/view/template/apply/genious_award/work_product.php','project_id','work_product','genious_info',1,20),(1964,'2014年度突出贡献及获得的荣誉称号情况','honor_title','/website/html/view/template/apply/genious_award/honor_title.php','project_id','honor_title','genious_info',1,20),(1965,'申报科技创新人才奖励项目情况阐述','situation','/website/html/view/template/apply/genious_award/situation.php','project_id','situation','genious_info',1,20),(1966,'填表声明','statement','/website/html/view/template/apply/genious_award/statement.php','project_id','statement','genious_info',1,20),(1967,'推荐单位意见','unit_opinion','/website/html/view/template/apply/genious_award/unit_opinion.php','project_id','unit_opinion','genious_info',1,20),(1968,'区科学技术委员会初审意见','first_opinion','/website/html/view/template/apply/genious_award/first_opinion.php','project_id','first_opinion','genious_info',1,20),(1969,'评审意见','review_opinion','/website/html/view/template/apply/genious_award/review_opinion.php','project_id','review_opinion','genious_info',1,20),(1970,'区人才工作领导小组审批意见','final_opinion','/website/html/view/template/apply/genious_award/final_opinion.php','project_id','final_opinion','genious_info',1,20),(1971,'基本情况','default','/website/html/view/template/apply/genious_support/org_info.php',NULL,NULL,NULL,0,19),(1972,'2014年度主要工作实绩','work_product','/website/html/view/template/apply/genious_support/work_product.php','project_id','work_product','genious_info',1,19),(1973,'2014年度突出贡献及获得的荣誉称号情况','honor_title','/website/html/view/template/apply/genious_support/honor_title.php','project_id','honor_title','genious_info',1,19),(1974,'申报科技创新人才奖励项目情况阐述','situation','/website/html/view/template/apply/genious_support/situation.php','project_id','situation','genious_info',1,19),(1975,'填表声明','statement','/website/html/view/template/apply/genious_support/statement.php','project_id','statement','genious_info',1,19),(1976,'推荐单位意见','unit_opinion','/website/html/view/template/apply/genious_support/unit_opinion.php','project_id','unit_opinion','genious_info',1,19),(1977,'区科学技术委员会初审意见','first_opinion','/website/html/view/template/apply/genious_support/first_opinion.php','project_id','first_opinion','genious_info',1,19),(1978,'评审意见','review_opinion','/website/html/view/template/apply/genious_support/review_opinion.php','project_id','review_opinion','genious_info',1,19),(1979,'区人才工作领导小组审批意见','final_opinion','/website/html/view/template/apply/genious_support/final_opinion.php','project_id','final_opinion','genious_info',1,19),(1981,'概述','abstract','/website/html/view/template/apply/patent_implement/attach4_patent/abstract.php','project_id','project_summary,social_mean,,advan_risks,plan_target','patent_feasibility',1,22),(1982,'申报企业情况','org_info','/website/html/view/template/apply/patent_implement/attach4_patent/org_info.php','project_id','org_info','patent_feasibility',1,22),(1983,'技术可行性分析','tec_invalid_ana','/website/html/view/template/apply/patent_implement/attach4_patent/tec_invalid_ana.php','project_id','basic_principle,foreign_patents,coop_org','patent_feasibility',1,22),(1984,'项目成熟程度','project_extent','/website/html/view/template/apply/patent_implement/attach4_patent/project_extent.php','project_id','patent_tort,results_ident,quality_stable','patent_feasibility',1,22),(1985,'市场需求情况','market_situation','/website/html/view/template/apply/patent_implement/attach4_patent/market_situation.php','project_id','domestic_market,international_market','patent_feasibility',1,22),(1986,'投资估算及资金筹措','invest_analysis','/website/html/view/template/apply/patent_implement/attach4_patent/invest_analysis.php','project_id','invest_estimate,financing_scheme,invest_use_plan','patent_feasibility',1,22),(1987,'经济和社会效益分析','economy_profit','/website/html/view/template/apply/patent_implement/attach4_patent/economy_profit.php','project_id','thing_estimate,financial_analysis,un_analy,finan_analy,social_results','patent_feasibility',1,22),(1988,'项目实施进度计划','project_effect','/website/html/view/template/apply/patent_implement/attach4_patent/project_effect.php','project_id','project_schedule','patent_feasibility',1,22),(1989,'项目单位基本情况','default','/website/html/view/template/apply/patent_implement/check_material/unit_info.php',NULL,NULL,NULL,0,24),(1990,'项目基本情况','default','/website/html/view/template/apply/patent_implement/check_material/org_info.php',NULL,NULL,NULL,0,24),(1991,'项目实施过程中企业通过质量认证情况','quality_approve','/website/html/view/template/apply/patent_implement/check_material/authent.php','project_id','quality_approve','check_material',1,24),(1992,'项目经济考核指标及完成情况','default','/website/html/view/template/apply/patent_implement/check_material/index_complete.php',NULL,NULL,NULL,0,24),(1993,'项目（产品）推广扩散情况','default','/website/html/view/template/apply/patent_implement/check_material/spread.php',NULL,NULL,NULL,0,24),(1994,'项目实施过程中企业研发新专利、开发新产品情况','default','/website/html/view/template/apply/patent_implement/check_material/develop.php',NULL,NULL,NULL,0,24),(1995,'项目实施过程中人才培训情况','default','/website/html/view/template/apply/patent_implement/check_material/talent_training.php',NULL,NULL,NULL,0,24),(1996,'项目资金使用情况','default','/website/html/view/template/apply/patent_implement/check_material/funds_use.php',NULL,NULL,NULL,0,24),(1997,'项目单位能力改善提高情况','default','/website/html/view/template/apply/patent_implement/check_material/improve.php',NULL,NULL,NULL,0,24),(1998,'项目单位意见','org_suggest','/website/html/view/template/apply/patent_implement/check_material/unit_opinion.php','project_id','org_suggest','check_material',1,24),(1999,'知识产权局验收意见','final_opinion','/website/html/view/template/apply/patent_implement/check_material/final_opinion.php','project_id','final_opinion','check_material',1,24),(2001,'通州区专利实施项目经费总决算表','default','/website/html/view/template/apply/patent_implement/project_summary/project_fund.php',NULL,NULL,NULL,0,26);

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

/*Table structure for table `support_scitec` */

DROP TABLE IF EXISTS `support_scitec`;

CREATE TABLE `support_scitec` (
  `id` int(11) NOT NULL auto_increment,
  `project_id` varchar(100) default NULL,
  `special` text,
  `service_thing` text,
  `service_job` text,
  `abstract` text,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `support_scitec` */

/*Table structure for table `table_data` */

DROP TABLE IF EXISTS `table_data`;

CREATE TABLE `table_data` (
  `id` int(11) NOT NULL auto_increment,
  `project_id` varchar(20) default NULL COMMENT '项目的project_id',
  `subtable_id` int(11) default NULL COMMENT '子表的ID',
  `data` text COMMENT '数据JSON化存储',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `project_id` (`project_id`,`subtable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `table_data` */

insert  into `table_data`(`id`,`project_id`,`subtable_id`,`data`) values (1,'dev1453097272',27,'{\"subtable_id\":\"27\",\"eqpt_name\":[\"1\",\"2\"],\"sex\":{\"2\":\"0\",\"3\":\"0\"},\"age\":[\"\",\"\"],\"rule\":[\"\",\"\"],\"major\":[\"\",\"\"],\"depart\":[\"\",\"\"],\"task\":[\"\",\"\"]}'),(2,'dev1453097272',28,'{\"subtable_id\":\"28\",\"serial_number\":{\"2\":\"3\",\"3\":\"4\"},\"stuff_name\":{\"2\":\"11\",\"3\":\"22\"},\"comment\":\"22\"}'),(3,'dev1453101198',17,'{\"subtable_id\":\"17\",\"year\":[\"2016\",\"2017\",\"2018\"],\"total1_fund\":[\"1.00\",\"1.00\",\"1.00\",\"3.00\"],\"total2_fund\":[\"1.00\",\"1.00\",\"1.00\",\"3.00\"],\"total3_fund\":[\"1.00\",\"1.00\",\"1.00\",\"3.00\"],\"year_total\":[\"3.00\",\"3.00\",\"3.00\"],\"total_total\":\"9.00\",\"p_m_year\":[\"2016\",\"2017\",\"2018\"],\"teach1_fund\":[\"0.00\",\"1.00\",\"0.00\",\"3.00\",\"4.00\",\"4.00\",\"4.00\",\"4.00\",\"4.00\",\"4.00\",\"5.00\"],\"teach2_fund\":[\"0.00\",\"1.00\",\"3.00\",\"0.00\",\"4.00\",\"4.00\",\"4.00\",\"4.00\",\"4.00\",\"4.00\",\"5.00\"],\"teach3_fund\":[\"0.00\",\"0.00\",\"3.00\",\"0.00\",\"4.00\",\"4.00\",\"4.00\",\"4.00\",\"4.00\",\"4.00\",\"5.00\"],\"teach_actual_fund\":[\"2.00\",\"2.00\",\"15.00\",\"15.00\",\"24.00\",\"24.00\",\"24.00\",\"24.00\",\"24.00\",\"27.00\",\"30.00\"],\"other1_fund\":[\"0.00\",\"0.00\",\"3.00\",\"4.00\",\"4.00\",\"4.00\",\"4.00\",\"4.00\",\"4.00\",\"5.00\",\"5.00\"],\"other2_fund\":[\"1.00\",\"0.00\",\"3.00\",\"4.00\",\"4.00\",\"4.00\",\"4.00\",\"4.00\",\"4.00\",\"5.00\",\"5.00\"],\"other3_fund\":[\"1.00\",\"0.00\",\"3.00\",\"4.00\",\"4.00\",\"4.00\",\"4.00\",\"4.00\",\"4.00\",\"5.00\",\"5.00\"],\"total1\":\"70.00\",\"total2\":\"71.00\",\"total3\":\"70.00\",\"total4\":\"211.00\",\"total5\":\"98.00\",\"total_other\":\"113.00\",\"eqpt_name\":[\"\",\"\"],\"eqpt_model\":[\"\",\"\"],\"plan_money\":[\"\",\"\"],\"actual_num\":[\"\",\"\"],\"actual_pay\":[\"\",\"\"],\"fund_src\":[\"\",\"\"],\"buy_time\":[\"\",\"\"],\"main_use\":[\"\",\"\"],\"project_match\":\"\\u6765\\u6e90\"}'),(4,'dev1453097272',30,'{\"subtable_id\":\"30\",\"org_name\":\"\\u90af\\u90f8\\u5927\\u96c6\\u56e2\",\"coorg\":\"\\u6cb3\\u5317\\u5de5\\u7a0b\",\"name\":[\"\\u674e\\u660e\"],\"gender\":[\"0\"],\"ages\":[\"21\"],\"edu\":\"\\u672c\\u79d1\",\"pos\":[\"\\u6821\\u957f\"],\"sub\":[\"\\u8ba1\\u7b97\\u673a\"],\"work\":[\"\\u90af\\u90f8\\u5b66\\u9662\"],\"mission\":[\"\\u7ba1\\u7406\"]}'),(5,'dev1453097272',32,'{\"subtable_id\":\"32\",\"b_name\":\"\\u90af\\u90f8\\u5927\\u96c6\\u56e2\",\"b_code\":\"qskj001\",\"b_leader\":\"\\u9879\\u76ee\\u7684\\u5b9e\\u65bd\\u76ee\\u6807\\u53ca\\u8003\\u6838\\u6307\\u6807\\uff08\\u5177\\u6709\\u660e\\u786e\\u7684\\u53ef\\u8003\\u6838\\u6027\\uff09\",\"b_pro_lead\":\"\\u9879\\u76ee\\u7684\\u5b9e\\u65bd\\u76ee\\u6807\\u53ca\\u8003\\u6838\\u6307\\u6807\\uff08\\u5177\\u6709\\u660e\\u786e\\u7684\\u53ef\\u8003\\u6838\\u6027\\uff09\",\"b_finance_lead\":\"\\u9879\\u76ee\\u7684\\u5b9e\\u65bd\\u76ee\\u6807\\u53ca\\u8003\\u6838\\u6307\\u6807\\uff08\\u5177\\u6709\\u660e\\u786e\\u7684\\u53ef\\u8003\\u6838\\u6027\\uff09\",\"b_address\":\"\\u9879\\u76ee\\u7684\\u5b9e\\u65bd\\u76ee\\u6807\\u53ca\\u8003\\u6838\\u6307\\u6807\\uff08\\u5177\\u6709\\u660e\\u786e\\u7684\\u53ef\\u8003\\u6838\\u6027\\uff09\",\"b_contact\":\"\\u9879\\u76ee\\u7684\\u5b9e\\u65bd\\u76ee\\u6807\\u53ca\\u8003\\u6838\\u6307\\u6807\\uff08\\u5177\\u6709\\u660e\\u786e\\u7684\\u53ef\\u8003\\u6838\\u6027\\uff09\",\"b_con_address\":\"\\u9879\\u76ee\\u7684\\u5b9e\\u65bd\\u76ee\\u6807\\u53ca\\u8003\\u6838\\u6307\\u6807\\uff08\\u5177\\u6709\\u660e\\u786e\\u7684\\u53ef\\u8003\\u6838\\u6027\\uff09\",\"b_postal\":\"010020\",\"b_phone\":\"010-8888888\",\"b_fax\":\"010-8888888\",\"b_email\":\"000@qq.com\",\"b_count\":\"liming \",\"b_bank\":\"\\u4e2d\\u884c\",\"b_number\":\"121252\",\"save_display\":\"\"}'),(6,'dev1453097272',47,'{\"subtable_id\":\"47\",\"project_back1\":\"\\u9879\\u76ee\\u7acb\\u9879\\u80cc\\u666f\\u548c\\u57fa\\u672c\\u60c5\\u51b5\",\"project_back2\":\"\\t\\t\\u9879\\u76ee\\u7acb\\u9879\\u80cc\\u666f\\u548c\\u57fa\\u672c\\u60c5\\u51b5\\t\\t\\t\"}'),(7,'dev1453097272',46,'{\"subtable_id\":\"46\",\"project_detail1\":\"\\u9879\\u76ee\\u7acb\\u9879\\u80cc\\u666f\\u548c\\u57fa\\u672c\\u60c5\\u51b5\"}'),(8,'dev1453097272',45,'{\"subtable_id\":\"45\",\"project_target1\":\"\\u9879\\u76ee\\u7acb\\u9879\\u80cc\\u666f\\u548c\\u57fa\\u672c\\u60c5\\u51b5\"}'),(9,'dev1453097272',44,'{\"subtable_id\":\"44\",\"item_profit1\":\"\\u9879\\u76ee\\u7acb\\u9879\\u80cc\\u666f\\u548c\\u57fa\\u672c\\u60c5\\u51b5\"}'),(10,'dev1453097272',42,'{\"subtable_id\":\"42\",\"item_fund1\":\"\\u9879\\u76ee\\u7acb\\u9879\\u80cc\\u666f\\u548c\\u57fa\\u672c\\u60c5\\u51b5\"}'),(11,'dev1453097272',43,'{\"subtable_id\":\"43\",\"item_plan1\":\"\\u9879\\u76ee\\u7acb\\u9879\\u80cc\\u666f\\u548c\\u57fa\\u672c\\u60c5\\u51b5\"}'),(12,'dev1453101198',18,'{\"subtable_id\":\"18\",\"year\":[\"2014\",\"2015\",\"2016\"],\"total1_fund\":[\"1\",\"1\",\"1\",\"3.00\"],\"total2_fund\":[\"1\",\"1\",\"1\",\"3.00\"],\"total3_fund\":[\"1\",\"1\",\"1\",\"3.00\"],\"year_total\":[\"3.00\",\"3.00\",\"3.00\"],\"total_total\":\"9.00\",\"p_m_year\":[\"2014\",\"2015\",\"2016\"],\"teach1_fund\":[\"0.00\",\"1\",\"1\",\"1\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"1\",\"1\",\"3\"],\"teach2_fund\":[\"1\",\"1\",\"1\",\"1\",\"1\",\"1\",\"0.00\",\"0.00\",\"0.00\",\"1\",\"3\"],\"teach3_fund\":[\"1\",\"1\",\"1\",\"1\",\"1\",\"0.00\",\"1\",\"1\",\"1\",\"1\",\"3\"],\"teach_actual_fund\":[\"5.00\",\"6.00\",\"6.00\",\"3.00\",\"2.00\",\"1.00\",\"1.00\",\"2.00\",\"4.00\",\"20.00\",\"18.00\"],\"other1_fund\":[\"1\",\"1\",\"1\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"1\",\"3\"],\"other2_fund\":[\"1\",\"1\",\"1\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"1\",\"13\",\"3\"],\"other3_fund\":[\"1\",\"1\",\"1\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"1\",\"1\",\"3\",\"3\"],\"total1\":\"15.00\",\"total2\":\"30.00\",\"total3\":\"23.00\",\"total4\":\"68.00\",\"total5\":\"30.00\",\"total_other\":\"38.00\",\"eqpt_name\":[\"\\u597d\",\"\\u5e2e\"],\"eqpt_model\":[\"11\",\"22\"],\"actual_num\":[\"2\",\"22\"],\"actual_pay\":[\"11\",\"22\"],\"fund_src\":[\"\\u9879\\u76ee\\u8d44\\u91d1\",\"\\u9879\\u76ee\\u8d44\\u91d1\"],\"buy_time\":[\"2016-01-01\",\"2016-01-02\"],\"main_use\":[\"\\u6253\\u5370\",\"\\u6709\\u7684\"]}'),(13,'dev1453097272',31,'{\"subtable_id\":\"31\",\"project_name\":\"liming-\\u4e13\\u5229\\u5b9e\\u65bd\\u9879\\u76eeie 11\",\"business_id\":\"\",\"start_end_time\":\"2016-01-06~2016-01-06\",\"org_name\":\"\\u90af\\u90f8\\u5927\\u96c6\\u56e2\",\"bgt_fund\":[\"6\",\"6\",\"6\",\"6\",\"66\"],\"actual_fund1\":[\"6\",\"6\",\"6\",\"6\",\"6\"],\"bgt_fund_total\":\"90\",\"actualsrc_fund_total\":\"30\",\"budget_fund\":[\"1\",\"2\",\"3\",\"4\",\"5\",\"6\",\"7\",\"8\",\"9\",\"12\",\"13\"],\"actual_fund\":[\"1\",\"2\",\"3\",\"4\",\"5\",\"6\",\"7\",\"8\",\"9\",\"12\",\"3\"],\"patent_out\":[\"1\",\"2\",\"3\",\"4\",\"5\",\"6\",\"7\",\"8\",\"9\",\"12\",\"13\"],\"total\":[\"70\",\"60\",\"70\"]}'),(14,'dev1453103161',17,'{\"subtable_id\":\"17\",\"year\":[\"2016\",\"2017\",\"2018\"],\"total1_fund\":[\"1.00\",\"1.00\",\"1.00\",\"3.00\"],\"total2_fund\":[\"2.00\",\"2.00\",\"2.00\",\"6.00\"],\"total3_fund\":[\"3.00\",\"3.00\",\"3.00\",\"9.00\"],\"year_total\":[\"6.00\",\"6.00\",\"6.00\"],\"total_total\":\"18.00\",\"p_m_year\":[\"2016\",\"2017\",\"2018\"],\"teach1_fund\":[\"1.00\",\"3.00\",\"5.00\",\"7.00\",\"9.00\",\"11.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\"],\"teach2_fund\":[\"1.00\",\"3.00\",\"5.00\",\"7.00\",\"9.00\",\"11.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\"],\"teach3_fund\":[\"1.00\",\"3.00\",\"5.00\",\"7.00\",\"9.00\",\"11.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\"],\"teach_actual_fund\":[\"9.00\",\"21.00\",\"33.00\",\"45.00\",\"57.00\",\"69.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\"],\"other1_fund\":[\"2.00\",\"4.00\",\"6.00\",\"8.00\",\"10.00\",\"12.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\"],\"other2_fund\":[\"2.00\",\"4.00\",\"6.00\",\"8.00\",\"10.00\",\"12.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\"],\"other3_fund\":[\"2.00\",\"4.00\",\"6.00\",\"8.00\",\"10.00\",\"12.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\"],\"total1\":\"78.00\",\"total2\":\"78.00\",\"total3\":\"78.00\",\"total4\":\"234.00\",\"total5\":\"108.00\",\"total_other\":\"126.00\",\"eqpt_name\":[\"\"],\"eqpt_model\":[\"\"],\"plan_money\":[\"\"],\"actual_num\":[\"\"],\"actual_pay\":[\"\"],\"fund_src\":[\"\"],\"buy_time\":[\"\"],\"main_use\":[\"\"],\"project_match\":\"\"}'),(15,'dev1453101496',17,'{\"subtable_id\":\"17\",\"year\":[\"2016\",\"2017\",\"2018\"],\"total1_fund\":[\"11.00\",\"1.00\",\"1.00\",\"13.00\"],\"total2_fund\":[\"1.00\",\"1.00\",\"1.00\",\"3.00\"],\"total3_fund\":[\"1.00\",\"1.00\",\"1.00\",\"3.00\"],\"year_total\":[\"13.00\",\"3.00\",\"3.00\"],\"total_total\":\"19.00\",\"p_m_year\":[\"2016\",\"2017\",\"2018\"],\"teach1_fund\":[\"1.00\",\"1.00\",\"1.00\",\"1.00\",\"1.00\",\"1.00\",\"1.00\",\"1.00\",\"1.00\",\"1.00\",\"0.00\"],\"teach2_fund\":[\"1.00\",\"0.00\",\"1.00\",\"1.00\",\"1111.00\",\"1.00\",\"1\",\"1.00\",\"1.00\",\"1.00\",\"1.00\"],\"teach3_fund\":[\"1.00\",\"1.00\",\"1.00\",\"1.00\",\"1.00\",\"1.00\",\"11.00\",\"11.00\",\"1.00\",\"1.00\",\"1.00\"],\"teach_actual_fund\":[\"6.00\",\"5.00\",\"6.00\",\"6.00\",\"1116.00\",\"16.00\",\"16.00\",\"16.00\",\"6.00\",\"6.00\",\"15.00\"],\"other1_fund\":[\"1.00\",\"1.00\",\"1.00\",\"1.00\",\"1.00\",\"11.00\",\"1.00\",\"1.00\",\"1.00\",\"1.00\",\"1.00\"],\"other2_fund\":[\"1.00\",\"1.00\",\"1.00\",\"1.00\",\"1.00\",\"1.00\",\"1.00\",\"1.00\",\"1.00\",\"1.00\",\"1.00\"],\"other3_fund\":[\"1.00\",\"1.00\",\"1.00\",\"1.00\",\"1.00\",\"1.00\",\"1.00\",\"1.00\",\"1.00\",\"1.00\",\"11.00\"],\"total1\":\"31.00\",\"total2\":\"1131.00\",\"total3\":\"52.00\",\"total4\":\"1214.00\",\"total5\":\"1161.00\",\"total_other\":\"53.00\",\"eqpt_name\":[\"1\"],\"eqpt_model\":[\"1\"],\"plan_money\":[\"1.00\"],\"actual_num\":[\"1\"],\"actual_pay\":[\"0.00\"],\"fund_src\":[\"1\"],\"buy_time\":[\"2016-01-13\"],\"main_use\":[\"1\"],\"project_match\":\"3\\u3001\\u9879\\u76ee\\u7814\\u7a76\\u6240\\u9700\\u7684\\u914d\\u5957\\u6761\\u4ef6\\u53ca\\u6765\\u6e90\\uff08\\u4e0e\\u9879\\u76ee\\u7814\\u7a76\\u76f8\\u5173\\u7684\\u5176\\u4ed6\\u4eea\\u5668\\u8bbe\\u5907\\u7b49\\u5171\\u4eab\\u6027\\u8d44\\u6e90\\u3001\\u627f\\u62c5\\u5355\\u4f4d\\u7684\\u4fdd\\u969c\\u63aa\\u65bd\\uff0c\\u5305\\u62ec\\u627f\\u8bfa\\u7684\\u7814\\u53d1\\u961f\\u4f0d\\u3001\\u8d44\\u91d1\\u3001\\u7814\\u53d1\\u8bbe\\u5907\\u548c\\u573a\\u5730\\u3001\\u9879\\u76ee\\u7ba1\\u7406\\u7b49\\u652f\\u6491\\u6761\\u4ef6\\u3002\\u8981\\u5145\\u5206\\u8003\\u8651\\u7ecf\\u6d4e\\u3001\\u6280\\u672f\\u7b49\\u65b9\\u9762\\u7684\\u53ef\\u884c\\u6027\\u3002\\uff09\\r\\n3\\u3001\\u9879\\u76ee\\u7814\\u7a76\\u6240\\u9700\\u7684\\u914d\\u5957\\u6761\\u4ef6\\u53ca\\u6765\\u6e90\\uff08\\u4e0e\\u9879\\u76ee\\u7814\\u7a76\\u76f8\\u5173\\u7684\\u5176\\u4ed6\\u4eea\\u5668\\u8bbe\\u5907\\u7b49\\u5171\\u4eab\\u6027\\u8d44\\u6e90\\u3001\\u627f\\u62c5\\u5355\\u4f4d\\u7684\\u4fdd\\u969c\\u63aa\\u65bd\\uff0c\\u5305\\u62ec\\u627f\\u8bfa\\u7684\\u7814\\u53d1\\u961f\\u4f0d\\u3001\\u8d44\\u91d1\\u3001\\u7814\\u53d1\\u8bbe\\u5907\\u548c\\u573a\\u5730\\u3001\\u9879\\u76ee\\u7ba1\\u7406\\u7b49\\u652f\\u6491\\u6761\\u4ef6\\u3002\\u8981\\u5145\\u5206\\u8003\\u8651\\u7ecf\\u6d4e\\u3001\\u6280\\u672f\\u7b49\\u65b9\\u9762\\u7684\\u53ef\\u884c\\u6027\\u3002\\uff09\\r\\n3\\u3001\\u9879\\u76ee\\u7814\\u7a76\\u6240\\u9700\\u7684\\u914d\\u5957\\u6761\\u4ef6\\u53ca\\u6765\\u6e90\\uff08\\u4e0e\\u9879\\u76ee\\u7814\\u7a76\\u76f8\\u5173\\u7684\\u5176\\u4ed6\\u4eea\\u5668\\u8bbe\\u5907\\u7b49\\u5171\\u4eab\\u6027\\u8d44\\u6e90\\u3001\\u627f\\u62c5\\u5355\\u4f4d\\u7684\\u4fdd\\u969c\\u63aa\\u65bd\\uff0c\\u5305\\u62ec\\u627f\\u8bfa\\u7684\\u7814\\u53d1\\u961f\\u4f0d\\u3001\\u8d44\\u91d1\\u3001\\u7814\\u53d1\\u8bbe\\u5907\\u548c\\u573a\\u5730\\u3001\\u9879\\u76ee\\u7ba1\\u7406\\u7b49\\u652f\\u6491\\u6761\\u4ef6\\u3002\\u8981\\u5145\\u5206\\u8003\\u8651\\u7ecf\\u6d4e\\u3001\\u6280\\u672f\\u7b49\\u65b9\\u9762\\u7684\\u53ef\\u884c\\u6027\\u3002\\uff09\\r\\n3\\u3001\\u9879\\u76ee\\u7814\\u7a76\\u6240\\u9700\\u7684\\u914d\\u5957\\u6761\\u4ef6\\u53ca\\u6765\\u6e90\\uff08\\u4e0e\\u9879\\u76ee\\u7814\\u7a76\\u76f8\\u5173\\u7684\\u5176\\u4ed6\\u4eea\\u5668\\u8bbe\\u5907\\u7b49\\u5171\\u4eab\\u6027\\u8d44\\u6e90\\u3001\\u627f\\u62c5\\u5355\\u4f4d\\u7684\\u4fdd\\u969c\\u63aa\\u65bd\\uff0c\\u5305\\u62ec\\u627f\\u8bfa\\u7684\\u7814\\u53d1\\u961f\\u4f0d\\u3001\\u8d44\\u91d1\\u3001\\u7814\\u53d1\\u8bbe\\u5907\\u548c\\u573a\\u5730\\u3001\\u9879\\u76ee\\u7ba1\\u7406\\u7b49\\u652f\\u6491\\u6761\\u4ef6\\u3002\\u8981\\u5145\\u5206\\u8003\\u8651\\u7ecf\\u6d4e\\u3001\\u6280\\u672f\\u7b49\\u65b9\\u9762\\u7684\\u53ef\\u884c\\u6027\\u3002\\uff09\\r\\n3\\u3001\\u9879\\u76ee\\u7814\\u7a76\\u6240\\u9700\\u7684\\u914d\\u5957\\u6761\\u4ef6\\u53ca\\u6765\\u6e90\\uff08\\u4e0e\\u9879\\u76ee\\u7814\\u7a76\\u76f8\\u5173\\u7684\\u5176\\u4ed6\\u4eea\\u5668\\u8bbe\\u5907\\u7b49\\u5171\\u4eab\\u6027\\u8d44\\u6e90\\u3001\\u627f\\u62c5\\u5355\\u4f4d\\u7684\\u4fdd\\u969c\\u63aa\\u65bd\\uff0c\\u5305\\u62ec\\u627f\\u8bfa\\u7684\\u7814\\u53d1\\u961f\\u4f0d\\u3001\\u8d44\\u91d1\\u3001\\u7814\\u53d1\\u8bbe\\u5907\\u548c\\u573a\\u5730\\u3001\\u9879\\u76ee\\u7ba1\\u7406\\u7b49\\u652f\\u6491\\u6761\\u4ef6\\u3002\\u8981\\u5145\\u5206\\u8003\\u8651\\u7ecf\\u6d4e\\u3001\\u6280\\u672f\\u7b49\\u65b9\\u9762\\u7684\\u53ef\\u884c\\u6027\\u3002\\uff09\\r\\n3\\u3001\\u9879\\u76ee\\u7814\\u7a76\\u6240\\u9700\\u7684\\u914d\\u5957\\u6761\\u4ef6\\u53ca\\u6765\\u6e90\\uff08\\u4e0e\\u9879\\u76ee\\u7814\\u7a76\\u76f8\\u5173\\u7684\\u5176\\u4ed6\\u4eea\\u5668\\u8bbe\\u5907\\u7b49\\u5171\\u4eab\\u6027\\u8d44\\u6e90\\u3001\\u627f\\u62c5\\u5355\\u4f4d\\u7684\\u4fdd\\u969c\\u63aa\\u65bd\\uff0c\\u5305\\u62ec\\u627f\\u8bfa\\u7684\\u7814\\u53d1\\u961f\\u4f0d\\u3001\\u8d44\\u91d1\\u3001\\u7814\\u53d1\\u8bbe\\u5907\\u548c\\u573a\\u5730\\u3001\\u9879\\u76ee\\u7ba1\\u7406\\u7b49\\u652f\\u6491\\u6761\\u4ef6\\u3002\\u8981\\u5145\\u5206\\u8003\\u8651\\u7ecf\\u6d4e\\u3001\\u6280\\u672f\\u7b49\\u65b9\\u9762\\u7684\\u53ef\\u884c\\u6027\\u3002\\uff09\\r\\n\"}'),(16,'dev1453101198',1954,'{\"subtable_id\":\"1954\",\"bgt_fund\":[\"3.00\",\"3.00\",\"3.00\"],\"reduce_fund\":[\"0.00\",\"0.00\",\"0.00\"],\"actual_fund\":[\"0.00\",\"0.00\",\"0.00\"],\"bgt_fund_total\":\"9\",\"reduce_fund_total\":\"0\",\"actual_fund_total\":\"0\",\"teach_budget_fund\":[\"2\",\"3\",\"3\",\"3\",\"2\",\"1\",\"1\",\"1\",\"2\",\"3\",\"9\"],\"teach_reduce_fund\":[\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\"],\"teach_adjust_fund\":[\"2\",\"3\",\"3\",\"3\",\"2\",\"1\",\"1\",\"1\",\"2\",\"3\",\"9\"],\"teach_actual_fund\":[\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\"],\"other_budget_fund\":[\"3\",\"3\",\"3\",\"0\",\"0\",\"0\",\"0\",\"1\",\"2\",\"17\",\"9\"],\"other_reduce_fund\":[\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\"],\"other_adjust_fund\":[\"3\",\"3\",\"3\",\"0\",\"0\",\"0\",\"0\",\"1\",\"2\",\"17\",\"9\"],\"other_actual_fund\":[\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\"],\"all_fund_tech_total\":\"68\",\"teach_reduce_fund_total\":\"0\",\"adjust_fund_total\":\"68\",\"teach_actual_fund_total\":\"0\",\"fund_tech_total\":\"0\",\"fund_other_total\":\"0\",\"eqpt_name\":[\"\\u597d\"],\"eqpt_model\":[\"k001\"],\"plan_money\":[\"222\"],\"actual_num\":[\"22\"],\"actual_pay\":[\"22\"],\"fund_src\":[\"\\u5343\\u677e\"],\"buy_time\":[\"2016-01-01\"],\"main_use\":[\"\\u597d\"]}'),(17,'dev1453103161',18,'{\"subtable_id\":\"18\",\"year\":[\"2014\",\"2015\",\"2016\"],\"total1_fund\":[\"2\",\"2\",\"0.00\",\"4.00\"],\"total2_fund\":[\"0.00\",\"0.00\",\"0.00\",\"0.00\"],\"total3_fund\":[\"0.00\",\"0.00\",\"0.00\",\"0.00\"],\"year_total\":[\"2.00\",\"2.00\",\"0.00\"],\"total_total\":\"4.00\",\"p_m_year\":[\"2014\",\"2015\",\"2016\"],\"teach1_fund\":[\"1\",\"2\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\"],\"teach2_fund\":[\"1\",\"2\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\"],\"teach3_fund\":[\"1\",\"2\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\"],\"teach_actual_fund\":[\"9.00\",\"6.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\"],\"other1_fund\":[\"2\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\"],\"other2_fund\":[\"2\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\"],\"other3_fund\":[\"2\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\"],\"total1\":\"5.00\",\"total2\":\"5.00\",\"total3\":\"5.00\",\"total4\":\"15.00\",\"total5\":\"9.00\",\"total_other\":\"6.00\",\"eqpt_name\":[\"1\"],\"eqpt_model\":[\"1\"],\"actual_num\":[\"1\"],\"actual_pay\":[\"1\"],\"fund_src\":[\"1\"],\"buy_time\":[\"0001-01-01\"],\"main_use\":[\"1\"]}'),(18,'dev1453106590',18,'{\"subtable_id\":\"18\",\"year\":[\"2014\",\"2015\",\"2016\"],\"total1_fund\":[\"0.00\",\"1\",\"1\",\"2.00\"],\"total2_fund\":[\"1\",\"1\",\"1\",\"3.00\"],\"total3_fund\":[\"1\",\"1\",\"1\",\"3.00\"],\"year_total\":[\"2.00\",\"3.00\",\"3.00\"],\"total_total\":\"8.00\",\"p_m_year\":[\"2014\",\"2015\",\"2016\"],\"teach1_fund\":[\"0.00\",\"1\",\"1\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\"],\"teach2_fund\":[\"1\",\"1\",\"1\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\"],\"teach3_fund\":[\"1\",\"1\",\"1\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\"],\"teach_actual_fund\":[\"5.00\",\"6.00\",\"6.00\",\"0.00\",\"2.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\"],\"other1_fund\":[\"1\",\"1\",\"1\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\"],\"other2_fund\":[\"1\",\"1\",\"1\",\"0.00\",\"1\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\"],\"other3_fund\":[\"1\",\"1\",\"1\",\"0.00\",\"1\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\"],\"total1\":\"5.00\",\"total2\":\"7.00\",\"total3\":\"7.00\",\"total4\":\"19.00\",\"total5\":\"8.00\",\"total_other\":\"11.00\",\"eqpt_name\":[\"\\u554a\"],\"eqpt_model\":[\"22\"],\"actual_num\":[\"22\"],\"actual_pay\":[\"22\"],\"fund_src\":[\"\\u8d22\\u52a1\"],\"buy_time\":[\"2016-01-01\"],\"main_use\":[\"\\u6253\\u5370\"]}'),(19,'dev1453103161',1954,'{\"subtable_id\":\"1954\",\"bgt_fund\":[\"2.00\",\"2.00\",\"0.00\"],\"reduce_fund\":[\"0.00\",\"0.00\",\"0.00\"],\"actual_fund\":[\"0.00\",\"0.00\",\"0.00\"],\"bgt_fund_total\":\"4\",\"reduce_fund_total\":\"0\",\"actual_fund_total\":\"0\",\"teach_budget_fund\":[\"3\",\"6\",\"0\",\"0\",\"0\",\"0\",\"0\",\"0\",\"0\",\"0\",\"0\"],\"teach_reduce_fund\":[\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\"],\"teach_adjust_fund\":[\"3\",\"6\",\"0\",\"0\",\"0\",\"0\",\"0\",\"0\",\"0\",\"0\",\"0\"],\"teach_actual_fund\":[\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\"],\"other_budget_fund\":[\"6\",\"0\",\"0\",\"0\",\"0\",\"0\",\"0\",\"0\",\"0\",\"0\",\"0\"],\"other_reduce_fund\":[\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\"],\"other_adjust_fund\":[\"6\",\"0\",\"0\",\"0\",\"0\",\"0\",\"0\",\"0\",\"0\",\"0\",\"0\"],\"other_actual_fund\":[\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\"],\"all_fund_tech_total\":\"15\",\"teach_reduce_fund_total\":\"0\",\"adjust_fund_total\":\"15\",\"teach_actual_fund_total\":\"0\",\"fund_tech_total\":\"0\",\"fund_other_total\":\"0\",\"eqpt_name\":[\"1\"],\"eqpt_model\":[\"11\"],\"plan_money\":[\"1\"],\"actual_num\":[\"11\"],\"actual_pay\":[\"11\"],\"fund_src\":[\"111\"],\"buy_time\":[\"2016-01-14\"],\"main_use\":[\"111\"]}'),(20,'dev1453101496',1954,'{\"subtable_id\":\"1954\",\"bgt_fund\":[\"\",\"\",\"\"],\"reduce_fund\":[\"1\",\"1\",\"1\"],\"actual_fund\":[\"1\",\"1\",\"1\"],\"bgt_fund_total\":\"0\",\"reduce_fund_total\":\"3\",\"actual_fund_total\":\"3\",\"teach_budget_fund\":[\"0\",\"0\",\"0\",\"0\",\"0\",\"0\",\"0\",\"0\",\"0\",\"0\",\"0\"],\"teach_reduce_fund\":[\"1\",\"1\",\"1\",\"44334\",\"1\",\"1\",\"1\",\"1\",\"1\",\"1\",\"1\"],\"teach_adjust_fund\":[\"-1\",\"-1\",\"-1\",\"-44334\",\"-1\",\"-1\",\"-1\",\"-1\",\"-1\",\"-1\",\"-1\"],\"teach_actual_fund\":[\"1\",\"1\",\"3\",\"3\",\"33\",\"3\",\"1\",\"3\",\"3\",\"30\",\"1\"],\"other_budget_fund\":[\"0\",\"0\",\"0\",\"0\",\"0\",\"0\",\"0\",\"0\",\"0\",\"0\",\"0\"],\"other_reduce_fund\":[\"1\",\"1\",\"3343\",\"1\",\"1\",\"1\",\"1\",\"1\",\"1\",\"1\",\"1\"],\"other_adjust_fund\":[\"-1\",\"-1\",\"-3343\",\"-1\",\"-1\",\"-1\",\"-1\",\"-1\",\"-1\",\"-1\",\"-1\"],\"other_actual_fund\":[\"1\",\"3\",\"3\",\"3\",\"30\",\"1\",\"30\",\"3\",\"3\",\"44444\",\"1\"],\"all_fund_tech_total\":\"0\",\"teach_reduce_fund_total\":\"47697\",\"adjust_fund_total\":\"-47697\",\"teach_actual_fund_total\":\"44604\",\"fund_tech_total\":\"82\",\"fund_other_total\":\"44522\",\"eqpt_name\":[\"3333\"],\"eqpt_model\":[\"33\\u7684\\u53d1vd\"],\"plan_money\":[\"33\"],\"actual_num\":[\"544\"],\"actual_pay\":[\"3333\"],\"fund_src\":[\"333\"],\"buy_time\":[\"0333-01-04\"],\"main_use\":[\"\\u8df3\\u697c\"]}'),(21,'kno1453111975',27,'{\"subtable_id\":\"27\",\"eqpt_name\":[\"1\",\"2\"],\"sex\":[\"1\",\"0\"],\"age\":[\"1\",\"2\"],\"rule\":[\"1\",\"2\"],\"major\":[\"1\",\"2\"],\"depart\":[\"1\",\"2\"],\"task\":[\"1\",\"2\"]}'),(22,'kno1453111975',28,'{\"subtable_id\":\"28\",\"serial_number\":[\"1\",\"2\",\"3\"],\"stuff_name\":[\"\\u6d4b\\u8bd51\",\"\\u6d4b\\u8bd52\",\"\\u6d4b\\u8bd53\"],\"comment\":\"\\u6d4b\"}'),(23,'sci1453109921',18,'{\"subtable_id\":\"18\",\"year\":[\"2014\",\"2015\",\"2016\"],\"total1_fund\":[\"0.00\",\"1\",\"1\",\"2.00\"],\"total2_fund\":[\"1\",\"1\",\"1\",\"3.00\"],\"total3_fund\":[\"1\",\"1\",\"1\",\"3.00\"],\"year_total\":[\"2.00\",\"3.00\",\"4.00\"],\"total_total\":\"8.00\",\"p_m_year\":[\"2014\",\"2015\",\"2016\"],\"teach1_fund\":[\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"444\",\"0.00\",\"0.00\",\"0.00\",\"0.00\"],\"teach2_fund\":[\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\"],\"teach3_fund\":[\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"444\",\"0.00\",\"0.00\",\"0.00\",\"0.00\"],\"teach_actual_fund\":[\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"1332.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\"],\"other1_fund\":[\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\"],\"other2_fund\":[\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"444\",\"0.00\",\"0.00\",\"0.00\",\"0.00\"],\"other3_fund\":[\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\"],\"total1\":\"444.00\",\"total2\":\"444.00\",\"total3\":\"444.00\",\"total4\":\"1332.00\",\"total5\":\"888.00\",\"total_other\":\"444.00\",\"eqpt_name\":[\"\"],\"eqpt_model\":[\"\"],\"actual_num\":[\"\"],\"actual_pay\":[\"\"],\"fund_src\":[\"\"],\"buy_time\":[\"\"],\"main_use\":[\"\"]}'),(24,'kno1453111975',29,'{\"subtable_id\":\"29\",\"first_year\":\"2016\",\"second_year\":\"\",\"third_year\":\"\",\"first_value\":[\"0.0\",\"0.0\",\"0.0\",\"0.0\",\"0.0\",\"0.0\"],\"second_value\":[\"0.0\",\"0.0\",\"0.0\",\"0.0\",\"0.0\",\"0.0\"],\"third_value\":[\"0.0\",\"0.0\",\"0.0\",\"0.0\",\"0.0\",\"0.0\"],\"total\":[\"0.0\",\"0.0\",\"0.0\",\"0.0\",\"0.0\",\"0.0\"],\"first\":\"\",\"second\":\"\",\"third\":\"\",\"total_queue\":[\"0.0\",\"0.0\",\"0.0\",\"0.0\"],\"out_year\":[\"\",\"\",\"\"],\"teach_budget_fund\":[\"0.0\",\"0.0\",\"0.0\",\"0.0\",\"0.0\",\"0.0\",\"0.0\",\"0.0\",\"0.0\",\"0.0\",\"0.0\"],\"teach_reduce_fund\":[\"0.0\",\"0.0\",\"0.0\",\"0.0\",\"0.0\",\"0.0\",\"0.0\",\"0.0\",\"0.0\",\"0.0\",\"0.0\"],\"teach_adjust_fund\":[\"0.0\",\"0.0\",\"0.0\",\"0.0\",\"0.0\",\"0.0\",\"0.0\",\"0.0\",\"0.0\",\"0.0\",\"0.0\"],\"teach_actual_fund\":[\"0.0\",\"0.0\",\"0.0\",\"0.0\",\"0.0\",\"0.0\",\"0.0\",\"0.0\",\"0.0\",\"0.0\",\"0.0\"],\"other_budget_fund\":[\"0.0\",\"0.0\",\"0.0\",\"0.0\",\"0.0\",\"0.0\",\"0.0\",\"0.0\",\"0.0\",\"0.0\",\"0.0\"],\"other_reduce_fund\":[\"0.0\",\"0.0\",\"0.0\",\"0.0\",\"0.0\",\"0.0\",\"0.0\",\"0.0\",\"0.0\",\"0.0\",\"0.0\"],\"other_adjust_fund\":[\"0.0\",\"0.0\",\"0.0\",\"0.0\",\"0.0\",\"0.0\",\"0.0\",\"0.0\",\"0.0\",\"0.0\",\"0.0\"],\"other_actual_fund\":[\"0.0\",\"0.0\",\"0.0\",\"0.0\",\"0.0\",\"0.0\",\"0.0\",\"0.0\",\"0.0\",\"0.0\",\"0.0\"],\"all_fund_tech_total\":\"0.0\",\"teach_reduce_fund_total\":\"0.0\",\"adjust_fund_total\":\"0.0\",\"total_total\":\"0.0\",\"fund_tech_total\":\"0.0\",\"fund_other_total\":\"0.0\",\"names\":[\"\\u6d4b\\u8bd51\",\"2\"],\"types\":[\"1\",\"3\"],\"nums\":[\"3\",\"\\u7684\"],\"pays\":[\"6.8\",\"\\u7684\"],\"sour\":[\"\\u6d4b\\u8bd5\",\"\\u6d4b2\"],\"time\":[\"2016-01-18\",\"2016-01-19\"],\"function\":[\"\\u6d4b\\u8bd5\",\"2\"],\"con_way\":\"\\u6d4b\\u8bd5\"}'),(25,'kno1453111975',30,'{\"subtable_id\":\"30\",\"org_name\":\"\\u5317\\u4eac\\u5343\\u677e\\u79d1\\u6280\\u53d1\\u5c55\\u6709\\u9650\\u516c\\u53f8\",\"coorg\":\"\\u6d4b\\u8bd5\",\"name\":[\"1\",\"2\"],\"gender\":[\"1\",\"0\"],\"ages\":[\"4\",\"\\u53d1\"],\"edu\":\"\\u7855\\u58eb\",\"pos\":[\"\\u6d4b\",\"\\u6d4b2\"],\"sub\":[\"\\u6d4b\",\"\\u6d4b2\"],\"work\":[\"\\u6d4b\",\"\\u6d4b2\"],\"mission\":[\"\\u6d4b\",\"\\u6d4b2\"]}'),(26,'kno1453119627',27,'{\"subtable_id\":\"27\",\"eqpt_name\":[\"name1\",\"name1\",\"name1\",\"name1\",\"name1\"],\"sex\":[\"0\",\"0\",\"1\",\"1\",\"1\"],\"age\":[\"12\",\"23\",\"34\",\"45\",\"56\"],\"rule\":[\"\\u6559\\u5e08\",\"\\u6821\\u957f\",\"\\u8001\\u5e08\",\"\\u4e3b\\u4efb\",\"\\u73ed\\u957f\"],\"major\":[\"\\u8ba1\\u7b97\\u673a\",\"\\u82f1\\u8bed\",\"\\u8bed\\u6587\",\"\\u9ad8\\u6570\",\"\\u6c47\\u7f16\"],\"dept\":[\"\\u90af\\u90f8\\u5b66\\u9662\",\"\\u90af\\u90f8\\u5b66\\u9662\",\"\\u90af\\u90f8\\u5b66\\u9662\",\"\\u90af\\u90f8\\u5b66\\u9662\",\"\\u90af\\u90f8\\u5b66\\u9662\"],\"task\":[\"\\u6559\\u5e08\",\"\\u8001\\u5927\",\"\\u9a7e\\u9a76\",\"\\u4e0d\\u884c\",\"\\u597d\\u4eba\"]}'),(27,'kno1453119627',28,'{\"subtable_id\":\"28\",\"serial_number\":[\"6\"],\"stuff_name\":[\"111\"],\"comment\":\"222222222\"}'),(28,'kno1453119627',29,'{\"subtable_id\":\"29\",\"first_year\":\"2016\",\"second_year\":\"2017\",\"third_year\":\"2018\",\"first_value\":[\"2\",\"2\",\"4\",\"4\",\"4\",\"4\"],\"second_value\":[\"2\",\"3\",\"3\",\"4\",\"0.0\",\"44\"],\"third_value\":[\"2\",\"3\",\"0.0\",\"0.0\",\"0.0\",\"444\"],\"total\":[\"6\",\"8\",\"7\",\"8\",\"4\",\"492\"],\"first\":\"2016\",\"second\":\"2017\",\"third\":\"2018\",\"total_queue\":[\"18\",\"54\",\"447\",\"519\"],\"out_year\":[\"2016\",\"2017\",\"2018\"],\"teach_budget_fund\":[\"4\",\"4\",\"4\",\"2\",\"2\",\"6\",\"8\",\"0\",\"8\",\"0.0\",\"4\"],\"teach_reduce_fund\":[\"4\",\"4\",\"0.0\",\"2\",\"2\",\"6\",\"8\",\"0\",\"7\",\"0.0\",\"4\"],\"teach_adjust_fund\":[\"0.0\",\"0.0\",\"0.0\",\"2\",\"2\",\"6\",\"8\",\"0\",\"7\",\"0.0\",\"4\"],\"teach_actual_fund\":[\"8\",\"8\",\"4\",\"6\",\"6\",\"18\",\"24\",\"0\",\"22\",\"0\",\"12\"],\"other_budget_fund\":[\"4\",\"4\",\"44\",\"2\",\"2\",\"7\",\"9\",\"8\",\"0.0\",\"0.0\",\"0.0\"],\"other_reduce_fund\":[\"4\",\"4\",\"4\",\"2\",\"2\",\"7\",\"9\",\"8\",\"0.0\",\"5\",\"5\"],\"other_adjust_fund\":[\"0.0\",\"0.0\",\"0.0\",\"2\",\"2\",\"77\",\"99\",\"8\",\"6\",\"0.0\",\"5\"],\"other_actual_fund\":[\"8\",\"8\",\"48\",\"6\",\"6\",\"91\",\"117\",\"24\",\"6\",\"5\",\"10\"],\"all_fund_tech_total\":\"122\",\"teach_reduce_fund_total\":\"87\",\"adjust_fund_total\":\"6\",\"total_total\":\"437\",\"fund_tech_total\":\"108\",\"fund_other_total\":\"329\",\"names\":[\"\\u540d \\u79f0\",\"\\u540d \\u79f0\"],\"types\":[\"\\u5361\\u554a\\u554a\",\"\\u5361\\u554a\\u554a\"],\"nums\":[\"23\",\"23\"],\"pays\":[\"23.1\",\"23.1\"],\"sour\":[\"\\u81ea\\u52a9\",\"\\u81ea\\u52a9\"],\"time\":[\"2016-01-06\",\"2016-01-15\"],\"function\":[\"\\u5927\\u5bb6\",\"\\u5927\\u5bb6\"],\"con_way\":\"2\\u3001\\u9879\\u76ee\\u5b9e\\u65bd\\u6240\\u9700\\u7684\\u5176\\u4ed6\\u914d\\u5957\\u6761\\u4ef6\\u548c\\u89e3\\u51b3\\u529e\\u6cd5\\uff1a\"}'),(29,'dev1453117545',18,'{\"subtable_id\":\"18\",\"year\":[\"2014\",\"2015\",\"2016\"],\"total1_fund\":[\"1\",\"1\",\"1\",\"3.00\"],\"total2_fund\":[\"1\",\"1\",\"1\",\"3.00\"],\"total3_fund\":[\"1\",\"1\",\"1\",\"3.00\"],\"year_total\":[\"1\",\"1\",\"1\"],\"total_total\":\"9.00\",\"p_m_year\":[\"2014\",\"2015\",\"2016\"],\"teach1_fund\":[\"1\",\"1\",\"1\",\"1\",\"1\",\"1\",\"1\",\"1\",\"1\",\"1\",\"1\"],\"teach2_fund\":[\"1\",\"1\",\"1\",\"1\",\"1\",\"1\",\"1\",\"1\",\"1\",\"1\",\"1\"],\"teach3_fund\":[\"1\",\"1\",\"1\",\"1\",\"1\",\"0.00\",\"1\",\"1\",\"1\",\"1\",\"1\"],\"teach_actual_fund\":[\"6.00\",\"6.00\",\"5.00\",\"6.00\",\"6.00\",\"5.00\",\"6.00\",\"6.00\",\"6.00\",\"6.00\",\"6.00\"],\"other1_fund\":[\"1\",\"1\",\"0.00\",\"1\",\"1\",\"1\",\"1\",\"1\",\"1\",\"1\",\"1\"],\"other2_fund\":[\"1\",\"1\",\"1\",\"1\",\"1\",\"1\",\"1\",\"1\",\"1\",\"1\",\"1\"],\"other3_fund\":[\"1\",\"1\",\"1\",\"1\",\"1\",\"1\",\"1\",\"1\",\"1\",\"1\",\"1\"],\"total1\":\"21.00\",\"total2\":\"22.00\",\"total3\":\"21.00\",\"total4\":\"64.00\",\"total5\":\"32.00\",\"total_other\":\"32.00\",\"eqpt_name\":[\"\\u662f\"],\"eqpt_model\":[\"233\"],\"actual_num\":[\"22\"],\"actual_pay\":[\"33\"],\"fund_src\":[\"33\"],\"buy_time\":[\"2016-01-01\"],\"main_use\":[\"\\u7c89\\u5237\"]}'),(30,'kno1453119627',30,'{\"subtable_id\":\"30\",\"org_name\":\"\\u90af\\u90f8\\u5927\\u96c6\\u56e2\",\"coorg\":\"\\u6c38\\u5e74\\u5c0f\\u96c6\\u56e2\",\"name\":{\"0\":\"name1\",\"1\":\"name2\",\"3\":\"name3\"},\"gender\":{\"3\":\"1\",\"4\":\"1\"},\"ages\":{\"0\":\"12\",\"1\":\"23\",\"3\":\"34\"},\"edu\":\"\\u7855\\u58eb\",\"pos\":{\"0\":\"\\u8001\\u5e08\",\"1\":\"\\u6559\\u5e08\",\"3\":\"\\u6559\\u5e08\"},\"sub\":{\"0\":\"\\u6559\\u5e08\",\"1\":\"\\u6559\\u5e08\",\"3\":\"\\u6559\\u5e08\"},\"work\":{\"0\":\"\\u90af\\u90f8\\u5b66\\u9662\",\"1\":\"\\u90af\\u90f8\\u5b66\\u9662\",\"3\":\"\\u90af\\u90f8\\u5b66\\u9662\"},\"mission\":{\"0\":\"\\u5b66\\u4e60\",\"1\":\"\\u5b66\\u4e60\",\"3\":\"\\u5b66\\u4e60\"}}'),(31,'kno1453119627',32,'{\"subtable_id\":\"32\",\"b_name\":\"\\u90af\\u90f8\\u5927\\u96c6\\u56e2\",\"b_code\":\"qskj001\",\"b_leader\":\"\\u674e\\u6653\\u660e\",\"b_pro_lead\":\"\\u674e\\u6653\\u660e\",\"b_finance_lead\":\"\\u674e\\u6653\\u660e\",\"b_address\":\"\\u674e\\u6653\\u660e\",\"b_contact\":\"\\u674e\\u6653\\u660e\",\"b_con_address\":\"\\u674e\\u6653\\u660e\",\"b_postal\":\"000000\",\"b_phone\":\"18302202020\",\"b_fax\":\"010-88888888\",\"b_email\":\"0000@qq.com\",\"b_count\":\"\\u674e\\u6653\\u660e\",\"b_bank\":\"\\u674e\\u6653\\u660e\",\"b_number\":\"10201012202\",\"save_display\":\"\"}'),(32,'dev1453117545',1954,'{\"subtable_id\":\"1954\",\"bgt_fund\":[\"1\",\"1\",\"1\"],\"reduce_fund\":[\"0.00\",\"0.00\",\"0.00\"],\"actual_fund\":[\"0.00\",\"0.00\",\"0.00\"],\"bgt_fund_total\":\"3\",\"reduce_fund_total\":\"0\",\"actual_fund_total\":\"0\",\"teach_budget_fund\":[\"3\",\"3\",\"3\",\"3\",\"3\",\"2\",\"3\",\"3\",\"3\",\"3\",\"3\"],\"teach_reduce_fund\":[\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\"],\"teach_adjust_fund\":[\"3\",\"3\",\"3\",\"3\",\"3\",\"2\",\"3\",\"3\",\"3\",\"3\",\"3\"],\"teach_actual_fund\":[\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\"],\"other_budget_fund\":[\"3\",\"3\",\"2\",\"3\",\"3\",\"3\",\"3\",\"3\",\"3\",\"3\",\"3\"],\"other_reduce_fund\":[\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\"],\"other_adjust_fund\":[\"3\",\"3\",\"2\",\"3\",\"3\",\"3\",\"3\",\"3\",\"3\",\"3\",\"3\"],\"other_actual_fund\":[\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\"],\"all_fund_tech_total\":\"64\",\"teach_reduce_fund_total\":\"0\",\"adjust_fund_total\":\"64\",\"teach_actual_fund_total\":\"0\",\"fund_tech_total\":\"0\",\"fund_other_total\":\"0\",\"eqpt_name\":[\"1\"],\"eqpt_model\":[\"1\"],\"plan_money\":[\"1\"],\"actual_num\":[\"1\"],\"actual_pay\":[\"1\"],\"fund_src\":[\"1\"],\"buy_time\":[\"2016-01-01\"],\"main_use\":[\"1\"]}'),(33,'dev1453124865',17,'{\"subtable_id\":\"17\",\"year\":[\"2016\",\"2017\",\"2018\"],\"total1_fund\":[\"0.00\",\"0.00\",\"0.00\",\"0.00\"],\"total2_fund\":[\"0.00\",\"0.00\",\"0.00\",\"0.00\"],\"total3_fund\":[\"0.00\",\"0.00\",\"0.00\",\"0.00\"],\"year_total\":[\"0.00\",\"0.00\",\"0.00\"],\"total_total\":\"0.00\",\"p_m_year\":[\"2016\",\"2017\",\"2018\"],\"teach1_fund\":[\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\"],\"teach2_fund\":[\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\"],\"teach3_fund\":[\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\"],\"teach_actual_fund\":[\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\"],\"other1_fund\":[\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\"],\"other2_fund\":[\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\"],\"other3_fund\":[\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\",\"0.00\"],\"total1\":\"0.00\",\"total2\":\"0.00\",\"total3\":\"0.00\",\"total4\":\"0.00\",\"total5\":\"0.00\",\"total_other\":\"0.00\",\"eqpt_name\":[\"\",\"\",\"\",\"\",\"\"],\"eqpt_model\":[\"\",\"\",\"\",\"\",\"\"],\"plan_money\":[\"\",\"\",\"\",\"\",\"\"],\"actual_num\":[\"\",\"\",\"\",\"\",\"\"],\"actual_pay\":[\"\",\"\",\"\",\"\",\"\"],\"fund_src\":[\"\",\"\",\"\",\"\",\"\"],\"buy_time\":[\"\",\"\",\"\",\"\",\"\"],\"main_use\":[\"\",\"\",\"\",\"\",\"\"],\"project_match\":\"\"}');

/*Table structure for table `table_status` */

DROP TABLE IF EXISTS `table_status`;

CREATE TABLE `table_status` (
  `id` int(11) NOT NULL auto_increment,
  `table_name` varchar(30) default NULL,
  `last_modify` varchar(30) default NULL,
  `table_status` int(11) default '1',
  `project_id` varchar(30) default NULL,
  `project_stage` int(11) default NULL,
  `approval_opinion` text,
  `approval_time` varchar(50) default NULL,
  `open` int(11) default '1',
  `check_repeat` int(11) default '1',
  `iscomplete` varchar(100) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `table_status` */

insert  into `table_status`(`id`,`table_name`,`last_modify`,`table_status`,`project_id`,`project_stage`,`approval_opinion`,`approval_time`,`open`,`check_repeat`,`iscomplete`) values (1,'1','1453097073',4,'dev1453097073',0,NULL,NULL,1,1,NULL),(2,'12','1453097073',4,'dev1453097073',1,NULL,NULL,1,1,NULL),(3,'1','1453097179',1,'dev1453097179',0,NULL,NULL,1,1,NULL),(4,'12','1453097179',1,'dev1453097179',1,NULL,NULL,1,1,NULL),(5,'21','1453101964',4,'dev1453097272',0,'不错啊','1453103034',1,1,'[1,1,1,0,1]'),(6,'22','1453101969',2,'dev1453097272',0,NULL,NULL,1,1,NULL),(7,'23','1453102971',4,'dev1453097272',1,'                              \n                      ','1453103043',1,1,'[1,1,1,0,1,1,0,1,1,0]'),(8,'24','1453102976',4,'dev1453097272',3,'3333333                              \n                      ','1453103074',1,1,'[1,1,1,1,1,1,1,0,0,1,0]'),(9,'25','1453102980',4,'dev1453097272',3,'444                              \n                      ','1453103089',1,1,'[1,1,1,1,1,1,0]'),(10,'26','1453102984',2,'dev1453097272',3,NULL,NULL,1,1,NULL),(11,'1','1453104245',4,'dev1453097453',0,'同意                              \r\n                      ','1453104339',1,1,NULL),(12,'12','1453104375',1,'dev1453097453',1,'同意                              \r\n                      ','1453104418',1,1,NULL),(13,'13','1453104394',4,'dev1453097453',1,'同意                              \r\n                      ','1453104430',1,1,NULL),(14,'14','1453104460',4,'dev1453097453',2,'同意                              \r\n                      ','1453104503',1,1,NULL),(15,'15','1453104470',4,'dev1453097453',2,'同意                              \r\n                      ','1453104513',1,1,NULL),(16,'16','1453104543',4,'dev1453097453',3,'同意                              \r\n                      ','1453104574',1,1,NULL),(17,'17','1453104549',4,'dev1453097453',3,'同意                              \r\n                      ','1453104589',1,1,NULL),(18,'18','1453104555',4,'dev1453097453',3,'同意                              \r\n                      ','1453104598',1,1,NULL),(19,'1','1453097719',1,'dev1453097719',0,NULL,NULL,1,1,NULL),(20,'12','1453097719',1,'dev1453097719',1,NULL,NULL,1,1,NULL),(21,'1','1453098118',1,'dev1453098118',0,NULL,NULL,1,1,NULL),(22,'12','1453098118',1,'dev1453098118',1,NULL,NULL,1,1,NULL),(23,'1','1453098333',1,'dev1453098333',0,NULL,NULL,1,1,'[0,0,0,0,0,0,1,0,0,0,0,0,0]'),(24,'12','1453098333',1,'dev1453098333',1,NULL,NULL,1,1,NULL),(25,'13','1453098333',1,'dev1453098333',1,NULL,NULL,1,1,NULL),(26,'14','1453098333',1,'dev1453098333',2,NULL,NULL,1,1,NULL),(27,'15','1453098333',1,'dev1453098333',2,NULL,NULL,1,1,NULL),(28,'16','1453098333',1,'dev1453098333',3,NULL,NULL,0,1,NULL),(29,'17','1453098333',1,'dev1453098333',3,NULL,NULL,0,1,NULL),(30,'18','1453098333',1,'dev1453098333',3,NULL,NULL,0,1,NULL),(31,'21','1453099069',1,'dev1453099069',0,NULL,NULL,1,1,NULL),(32,'22','1453099069',1,'dev1453099069',0,NULL,NULL,1,1,NULL),(33,'23','1453099069',1,'dev1453099069',1,NULL,NULL,1,1,NULL),(34,'24','1453099069',1,'dev1453099069',3,NULL,NULL,1,1,NULL),(35,'25','1453099069',1,'dev1453099069',3,NULL,NULL,1,1,NULL),(36,'26','1453099069',1,'dev1453099069',3,NULL,NULL,1,1,NULL),(37,'1','1453099433',1,'dev1453099433',0,NULL,NULL,1,1,NULL),(38,'12','1453099433',1,'dev1453099433',1,NULL,NULL,1,1,NULL),(39,'1','1453101023',1,'dev1453101023',0,NULL,NULL,1,1,NULL),(40,'12','1453101023',1,'dev1453101023',1,NULL,NULL,1,1,NULL),(41,'13','1453101023',1,'dev1453101023',1,NULL,NULL,1,1,NULL),(42,'14','1453101023',1,'dev1453101023',2,NULL,NULL,1,1,NULL),(43,'15','1453101023',1,'dev1453101023',2,NULL,NULL,0,1,NULL),(44,'16','1453101023',1,'dev1453101023',3,NULL,NULL,0,1,NULL),(45,'17','1453101023',1,'dev1453101023',3,NULL,NULL,0,1,NULL),(46,'18','1453101023',1,'dev1453101023',3,NULL,NULL,0,1,NULL),(47,'1','1453105875',4,'dev1453101198',0,'                       通过                              \r\n                             \r\n                      ','1453105907',1,1,'[1,1,1,1,1,1,1,0,1,1,1,1,0]'),(48,'12','1453103183',4,'dev1453101198',1,'通过                              \r\n                      ','1453103469',1,1,'[1,1,1,1,1,1,1,1,1,0,0]'),(49,'13','1453103517',4,'dev1453101198',1,'通过                              \r\n                      ','1453103544',1,1,'[1,0]'),(50,'14','1453103733',4,'dev1453101198',2,'通过                              \r\n                      ','1453103790',1,1,'[1,0]'),(51,'15','1453103671',4,'dev1453101198',2,'好                              \r\n                      ','1453103816',1,1,'[1,1,1,0]'),(52,'16','1453103934',4,'dev1453101198',3,'通过                              \r\n                      ','1453104123',1,1,'[1,1]'),(53,'17','1453104138',4,'dev1453101198',3,'好                              \r\n                      ','1453104236',1,1,'{\"0\":1,\"undefined\":1}'),(54,'18','1453104198',4,'dev1453101198',3,'通过                              \r\n                      ','1453105791',1,1,'[1,1,1,1,1,1,1,0]'),(55,'1','1453105107',4,'dev1453101496',0,'小伙子干得不错。                              \r\n                      ','1453105271',1,1,'[1,1,1,1,1,1,1,1,1,1,1,1,0]'),(56,'5','1453105098',1,'dev1453101496',0,'审核通过并，，没有问题了。                              \r\n                      ','1453105293',1,1,NULL),(57,'12','1453106446',4,'dev1453101496',1,'                              \r\n                      ','1453106971',1,1,'[1,1,1,1,1,0,1,1,1,0,0]'),(58,'13','1453106930',4,'dev1453101496',1,'小伙子做的不错，                              \r\n                      ','1453107028',1,1,'[1,0]'),(59,'14','1453107388',4,'dev1453101496',2,'                              \r\n                      ','1453107415',1,1,'[1,0]'),(60,'15','1453107393',4,'dev1453101496',2,'                              \r\n                      ','1453107423',1,1,NULL),(61,'16','1453101496',1,'dev1453101496',3,NULL,NULL,1,1,'[1,1]'),(62,'17','1453101496',1,'dev1453101496',3,NULL,NULL,1,1,NULL),(63,'18','1453101496',1,'dev1453101496',3,NULL,NULL,1,1,'[1,1,1,1,1,1,1,0]'),(64,'1','1453101596',1,'dev1453101596',0,NULL,NULL,1,1,'[0,0,0,1,0,0,0,0,0,0,0,0,0]'),(65,'5','1453101596',1,'dev1453101596',0,NULL,NULL,1,1,NULL),(66,'12','1453101596',1,'dev1453101596',1,NULL,NULL,1,1,'[0,0,0,0,1,0,1,0,0,0,0]'),(67,'13','1453101596',1,'dev1453101596',1,NULL,NULL,1,1,NULL),(68,'14','1453101596',1,'dev1453101596',2,NULL,NULL,1,1,NULL),(69,'15','1453101596',1,'dev1453101596',2,NULL,NULL,0,1,NULL),(70,'16','1453101596',1,'dev1453101596',3,NULL,NULL,0,1,NULL),(71,'17','1453101596',1,'dev1453101596',3,NULL,NULL,0,1,NULL),(72,'18','1453101596',1,'dev1453101596',3,NULL,NULL,0,1,NULL),(73,'1','1453102584',1,'sci1453102584',0,NULL,NULL,1,1,NULL),(74,'9','1453102584',1,'sci1453102584',0,NULL,NULL,1,1,NULL),(75,'12','1453102584',1,'sci1453102584',1,NULL,NULL,1,1,NULL),(76,'13','1453102584',1,'sci1453102584',1,NULL,NULL,1,1,NULL),(77,'14','1453102584',1,'sci1453102584',2,NULL,NULL,1,1,NULL),(78,'15','1453102584',1,'sci1453102584',2,NULL,NULL,0,1,NULL),(79,'16','1453102584',1,'sci1453102584',3,NULL,NULL,0,1,NULL),(80,'17','1453102584',1,'sci1453102584',3,NULL,NULL,0,1,NULL),(81,'18','1453102584',1,'sci1453102584',3,NULL,NULL,0,1,NULL),(82,'1','1453102606',1,'sci1453102606',0,NULL,NULL,1,1,'[0,0,0,0,0,0,1,0,0,0,0,0,0]'),(83,'9','1453102606',1,'sci1453102606',0,NULL,NULL,1,1,NULL),(84,'12','1453102606',1,'sci1453102606',1,NULL,NULL,1,1,NULL),(85,'13','1453102606',1,'sci1453102606',1,NULL,NULL,1,1,NULL),(86,'14','1453102606',1,'sci1453102606',2,NULL,NULL,1,1,NULL),(87,'15','1453102606',1,'sci1453102606',2,NULL,NULL,0,1,NULL),(88,'16','1453102606',1,'sci1453102606',3,NULL,NULL,0,1,NULL),(89,'17','1453102606',1,'sci1453102606',3,NULL,NULL,0,1,NULL),(90,'18','1453102606',1,'sci1453102606',3,NULL,NULL,0,1,NULL),(91,'1','1453111743',2,'dev1453103161',0,NULL,NULL,1,1,'[0,1,1,1,1,1,1,0,1,1,1,0,0]'),(92,'12','1453103161',1,'dev1453103161',1,NULL,NULL,1,1,'[0,1,1,1,0,1,1,0,1,0,0]'),(93,'13','1453103161',1,'dev1453103161',1,NULL,NULL,1,1,'[1,0]'),(94,'14','1453103161',1,'dev1453103161',2,NULL,NULL,1,1,'[1,0]'),(95,'15','1453103161',1,'dev1453103161',2,NULL,NULL,1,1,'[1,1,1,0]'),(96,'16','1453103161',1,'dev1453103161',3,NULL,NULL,1,1,'[1,1]'),(97,'17','1453103161',1,'dev1453103161',3,NULL,NULL,1,1,'[1]'),(98,'18','1453107310',2,'dev1453103161',3,NULL,NULL,1,1,NULL),(99,'1','1453106574',1,'sci1453106574',0,NULL,NULL,1,1,NULL),(100,'19','1453106574',1,'sci1453106574',0,NULL,NULL,1,1,NULL),(101,'20','1453106574',1,'sci1453106574',0,NULL,NULL,1,1,NULL),(102,'1','1453106597',4,'dev1453106590',0,'                              \r\n                      ','1453106623',1,1,NULL),(103,'12','1453107084',4,'dev1453106590',1,'                              \r\n                      ','1453107366',1,1,'[1,1,1,1,1,1,1,0,1,0,0]'),(104,'13','1453107258',4,'dev1453106590',1,'                              \r\n                      ','1453107392',1,1,'[1,0]'),(105,'14','1453107417',4,'dev1453106590',2,'                              \r\n                      ','1453107511',1,1,NULL),(106,'15','1453107453',4,'dev1453106590',2,'                              \r\n                      ','1453107522',1,1,NULL),(107,'16','1453106590',1,'dev1453106590',3,NULL,NULL,1,1,NULL),(108,'17','1453106590',1,'dev1453106590',3,NULL,NULL,1,1,NULL),(109,'18','1453106590',1,'dev1453106590',3,NULL,NULL,1,1,NULL),(110,'19','1453106749',1,'sci1453106749',0,NULL,NULL,1,1,'[0,1,1,1,1,0]'),(111,'20','1453106749',1,'sci1453106749',0,NULL,NULL,1,1,NULL),(112,'1','1453107706',4,'dev1453107699',0,'                              \r\n                      ','1453107736',1,1,NULL),(113,'12','1453107790',4,'dev1453107699',1,'                              \r\n                      ','1453107823',1,1,NULL),(114,'13','1453107801',4,'dev1453107699',1,'                              \r\n                      ','1453107874',1,1,NULL),(115,'14','1453107902',4,'dev1453107699',2,'                              \r\n                      ','1453107939',1,1,NULL),(116,'15','1453107913',4,'dev1453107699',2,'                              \r\n                      ','1453107983',1,1,NULL),(117,'16','1453108115',4,'dev1453107699',3,'                              \r\n                      ','1453108293',1,1,NULL),(118,'17','1453108247',4,'dev1453107699',3,'                              \r\n                      ','1453108328',1,1,NULL),(119,'18','1453108266',4,'dev1453107699',3,'                              \r\n                      ','1453108301',1,1,NULL),(120,'1','1453108547',3,'dev1453108525',0,'                              \r\n                      ','1453108955',1,1,NULL),(121,'12','1453108525',1,'dev1453108525',1,NULL,NULL,1,1,NULL),(122,'13','1453108525',1,'dev1453108525',1,NULL,NULL,1,1,NULL),(123,'14','1453108525',1,'dev1453108525',2,NULL,NULL,1,1,NULL),(124,'15','1453108525',1,'dev1453108525',2,NULL,NULL,0,1,NULL),(125,'16','1453108525',1,'dev1453108525',3,NULL,NULL,0,1,NULL),(126,'17','1453108525',1,'dev1453108525',3,NULL,NULL,0,1,NULL),(127,'18','1453108525',1,'dev1453108525',3,NULL,NULL,0,1,NULL),(128,'1','1453108995',4,'dev1453108987',0,'                              \r\n                      ','1453109022',1,1,NULL),(129,'12','1453109107',4,'dev1453108987',1,'                              \r\n                      ','1453109126',1,1,NULL),(130,'13','1453109148',4,'dev1453108987',1,'                              \r\n                      ','1453109351',1,1,NULL),(131,'14','1453109370',4,'dev1453108987',2,'                              \r\n                      ','1453109517',1,1,NULL),(132,'15','1453109412',4,'dev1453108987',2,'                              \r\n                      ','1453109511',1,1,NULL),(133,'16','1453109550',2,'dev1453108987',3,NULL,NULL,1,1,NULL),(134,'17','1453109558',2,'dev1453108987',3,NULL,NULL,1,1,NULL),(135,'18','1453109566',2,'dev1453108987',3,NULL,NULL,1,1,NULL),(136,'1','1453114315',4,'sci1453109921',0,'                              \r\n                      ','1453114370',1,1,NULL),(137,'9','1453114340',4,'sci1453109921',0,'                              \r\n                      ','1453114376',1,1,'[0,0,1,0,0,0,1,0,1,1]'),(138,'12','1453109921',1,'sci1453109921',1,NULL,NULL,1,1,'[1,1,1,1,1,0,1,0,0,0,0]'),(139,'13','1453109921',1,'sci1453109921',1,NULL,NULL,1,1,NULL),(140,'14','1453109921',1,'sci1453109921',2,NULL,NULL,1,1,NULL),(141,'15','1453109921',1,'sci1453109921',2,NULL,NULL,0,1,NULL),(142,'16','1453109921',1,'sci1453109921',3,NULL,NULL,0,1,NULL),(143,'17','1453109921',1,'sci1453109921',3,NULL,NULL,0,1,NULL),(144,'18','1453109921',1,'sci1453109921',3,NULL,NULL,0,1,NULL),(145,'1','1453110069',1,'dev1453110069',0,NULL,NULL,1,1,NULL),(146,'12','1453110069',1,'dev1453110069',1,NULL,NULL,1,1,NULL),(147,'13','1453110069',1,'dev1453110069',1,NULL,NULL,1,1,NULL),(148,'14','1453110069',1,'dev1453110069',2,NULL,NULL,1,1,NULL),(149,'15','1453110069',1,'dev1453110069',2,NULL,NULL,0,1,NULL),(150,'16','1453110069',1,'dev1453110069',3,NULL,NULL,0,1,NULL),(151,'17','1453110069',1,'dev1453110069',3,NULL,NULL,0,1,NULL),(152,'18','1453110069',1,'dev1453110069',3,NULL,NULL,0,1,NULL),(153,'1','1453110191',1,'dev1453110191',0,NULL,NULL,1,1,NULL),(154,'12','1453110191',1,'dev1453110191',1,NULL,NULL,1,1,NULL),(155,'13','1453110191',1,'dev1453110191',1,NULL,NULL,1,1,NULL),(156,'14','1453110191',1,'dev1453110191',2,NULL,NULL,1,1,NULL),(157,'15','1453110191',1,'dev1453110191',2,NULL,NULL,0,1,NULL),(158,'16','1453110191',1,'dev1453110191',3,NULL,NULL,0,1,NULL),(159,'17','1453110191',1,'dev1453110191',3,NULL,NULL,0,1,NULL),(160,'18','1453110191',1,'dev1453110191',3,NULL,NULL,0,1,NULL),(161,'1','1453111240',2,'dev1453111213',0,NULL,NULL,1,1,NULL),(162,'12','1453111213',1,'dev1453111213',1,NULL,NULL,1,1,NULL),(163,'1','1453111321',2,'dev1453111314',0,NULL,NULL,1,1,NULL),(164,'12','1453111314',1,'dev1453111314',1,NULL,NULL,1,1,NULL),(165,'1','1453111422',2,'dev1453111413',0,NULL,NULL,1,1,NULL),(166,'12','1453111413',1,'dev1453111413',1,NULL,NULL,1,1,NULL),(167,'19','1453111441',1,'sci1453111441',0,NULL,NULL,1,1,NULL),(168,'20','1453111441',1,'sci1453111441',0,NULL,NULL,1,1,NULL),(169,'1','1453111644',4,'dev1453111637',0,'同意                              \r\n                      ','1453111689',1,1,NULL),(170,'12','1453111637',1,'dev1453111637',1,NULL,NULL,1,1,NULL),(171,'13','1453111637',1,'dev1453111637',1,NULL,NULL,1,1,NULL),(172,'14','1453111637',1,'dev1453111637',2,NULL,NULL,1,1,NULL),(173,'15','1453111637',1,'dev1453111637',2,NULL,NULL,0,1,NULL),(174,'16','1453111637',1,'dev1453111637',3,NULL,NULL,0,1,NULL),(175,'17','1453111637',1,'dev1453111637',3,NULL,NULL,0,1,NULL),(176,'18','1453111637',1,'dev1453111637',3,NULL,NULL,0,1,NULL),(177,'19','1453111643',1,'sci1453111643',0,NULL,NULL,1,1,NULL),(178,'20','1453111643',1,'sci1453111643',0,NULL,NULL,1,1,NULL),(179,'19','1453111876',1,'sci1453111876',0,NULL,NULL,1,1,NULL),(180,'20','1453111876',1,'sci1453111876',0,NULL,NULL,1,1,NULL),(181,'21','1453117297',4,'kno1453111975',0,'审核通过                              \r\n                      ','1453117733',1,1,'[0,1,1,1,1]'),(182,'22','1453117558',4,'kno1453111975',0,'在线申报系统\r\n\r\n前言\r\n在线申报系统网址：http://b.bjqskj.com:8080/website/html/view/template/\r\n获取申报账号和密码两种方式：\r\n（1）	注册\r\n（2）	后台分配账号和密码\r\n\r\n注册\r\n输入网址，进入在线申报系统首页，点击“注册”，进行注册，用于获取登录系统的账号和密码，如图：\r\n \r\n进入注册页面，分两部分填写注册信息：用户信息、企业信息\r\n填写用户相关信息（注意：*为必填），填写完用户信息后点击“下一步”，继续填写企业信息，如图：\r\n \r\n继续填写企业相关信息（注意：*为必填），填写完成后，点击“确定”，完成注册，弹出提示窗口“注册成功，即将进行跳转”，点击弹窗中“确定”，跳回系统首页，如图：\r\n \r\n\r\n登录\r\n输入网址，进入在线申报系统首页（注册后，跳转回首页），在用户登录栏输入用户名、密码和验证码，点击“登录”，验证登录后，即可进入系统申报项目，如图：\r\n                              \r\n                      ','1453117758',1,1,'[1,1,1,1,1,1,1,1,0]'),(183,'23','1453111975',1,'kno1453111975',1,NULL,NULL,1,1,'[1,1,1,0,1,1,0,1,0,0]'),(184,'24','1453111975',1,'kno1453111975',3,NULL,NULL,1,1,NULL),(185,'25','1453111975',1,'kno1453111975',3,NULL,NULL,1,1,NULL),(186,'26','1453111975',1,'kno1453111975',3,NULL,NULL,0,1,NULL),(187,'1','1453112086',4,'dev1453112079',0,'同意                              \r\n                      ','1453113899',1,1,NULL),(188,'5','1453112094',4,'dev1453112079',0,'同意                              \r\n                      ','1453113907',1,1,NULL),(189,'12','1453112079',1,'dev1453112079',1,NULL,NULL,1,1,NULL),(190,'13','1453112079',1,'dev1453112079',1,NULL,NULL,1,1,NULL),(191,'14','1453112079',1,'dev1453112079',2,NULL,NULL,1,1,NULL),(192,'15','1453112079',1,'dev1453112079',2,NULL,NULL,0,1,NULL),(193,'16','1453112079',1,'dev1453112079',3,NULL,NULL,0,1,NULL),(194,'17','1453112079',1,'dev1453112079',3,NULL,NULL,0,1,NULL),(195,'18','1453112079',1,'dev1453112079',3,NULL,NULL,0,1,NULL),(196,'1','1453112455',4,'dev1453112447',0,'                              \r\n                      ','1453112751',1,1,NULL),(197,'12','1453112615',4,'dev1453112447',1,'                              \r\n                      ','1453112736',1,1,'[1,0,0,0,0,0,0,0,0,0,0]'),(198,'13','1453112679',4,'dev1453112447',1,'                              \r\n                      ','1453112743',1,1,NULL),(199,'14','1453112447',6,'dev1453112447',2,NULL,NULL,1,1,NULL),(200,'15','1453112447',1,'dev1453112447',2,NULL,NULL,0,1,NULL),(201,'16','1453112447',1,'dev1453112447',3,NULL,NULL,1,1,NULL),(202,'17','1453112447',1,'dev1453112447',3,NULL,NULL,1,1,NULL),(203,'18','1453112447',1,'dev1453112447',3,NULL,NULL,1,1,NULL),(204,'1','1453113987',2,'dev1453113981',0,NULL,NULL,1,1,NULL),(205,'12','1453113981',1,'dev1453113981',1,NULL,NULL,1,1,NULL),(206,'13','1453113981',1,'dev1453113981',1,NULL,NULL,1,1,NULL),(207,'14','1453113981',1,'dev1453113981',2,NULL,NULL,1,1,NULL),(208,'15','1453113981',1,'dev1453113981',2,NULL,NULL,0,1,NULL),(209,'16','1453113981',1,'dev1453113981',3,NULL,NULL,0,1,NULL),(210,'17','1453113981',1,'dev1453113981',3,NULL,NULL,0,1,NULL),(211,'18','1453113981',1,'dev1453113981',3,NULL,NULL,0,1,NULL),(212,'1','1453114149',4,'dev1453114020',0,'                              \r\n                      ','1453114259',1,1,'[1,0,0,0,0,0,0,0,0,0,0,0,0]'),(213,'12','1453114020',1,'dev1453114020',1,NULL,NULL,1,1,NULL),(214,'13','1453114020',1,'dev1453114020',1,NULL,NULL,1,1,NULL),(215,'14','1453114020',1,'dev1453114020',2,NULL,NULL,1,1,NULL),(216,'15','1453114020',1,'dev1453114020',2,NULL,NULL,0,1,NULL),(217,'16','1453114020',1,'dev1453114020',3,NULL,NULL,0,1,NULL),(218,'17','1453114020',1,'dev1453114020',3,NULL,NULL,0,1,NULL),(219,'18','1453114020',1,'dev1453114020',3,NULL,NULL,0,1,NULL),(220,'1','1453114014',1,'dev1453114014',0,NULL,NULL,1,1,'[1,1,1,1,1,1,0,0,1,1,1,1,0]'),(221,'12','1453114014',1,'dev1453114014',1,NULL,NULL,1,1,'[0,0,0,0,0,0,1,0,0,0,0]'),(222,'13','1453114014',1,'dev1453114014',1,NULL,NULL,1,1,NULL),(223,'14','1453119561',2,'dev1453114014',2,NULL,NULL,1,1,'[1,0]'),(224,'15','1453114014',1,'dev1453114014',2,NULL,NULL,1,1,'[1,1,1,0]'),(225,'16','1453114014',1,'dev1453114014',3,NULL,NULL,1,1,NULL),(226,'17','1453119528',2,'dev1453114014',3,NULL,NULL,1,1,NULL),(227,'18','1453114014',1,'dev1453114014',3,NULL,NULL,1,1,NULL),(228,'1','1453114185',1,'sci1453114185',0,NULL,NULL,1,1,NULL),(229,'9','1453114185',1,'sci1453114185',0,NULL,NULL,1,1,NULL),(230,'12','1453114185',1,'sci1453114185',1,NULL,NULL,1,1,NULL),(231,'13','1453114185',1,'sci1453114185',1,NULL,NULL,1,1,NULL),(232,'14','1453114185',1,'sci1453114185',2,NULL,NULL,1,1,NULL),(233,'15','1453114185',1,'sci1453114185',2,NULL,NULL,0,1,NULL),(234,'16','1453114185',1,'sci1453114185',3,NULL,NULL,0,1,NULL),(235,'17','1453114185',1,'sci1453114185',3,NULL,NULL,0,1,NULL),(236,'18','1453114185',1,'sci1453114185',3,NULL,NULL,0,1,NULL),(237,'1','1453119142',4,'dev1453117545',0,'通过                              \r\n                      ','1453121998',1,1,'[1,1,1,1,1,1,1,0,1,1,1,1,0]'),(238,'12','1453121639',4,'dev1453117545',1,'通过                              \r\n                      ','1453121946',1,1,'[1,1,1,1,1,1,1,1,1,1,0]'),(239,'13','1453121785',4,'dev1453117545',1,'                              \r\n                      ','1453122014',1,1,'[1,0]'),(240,'14','1453122084',4,'dev1453117545',2,'啊啊                              \r\n                      ','1453122195',1,1,'[1,0]'),(241,'15','1453122163',4,'dev1453117545',2,'啊                              \r\n                      ','1453122206',1,1,'[1,1,1,0]'),(242,'16','1453122411',4,'dev1453117545',3,'啊                              \r\n                      ','1453122762',1,1,'[1,1]'),(243,'17','1453122693',4,'dev1453117545',3,'啊                              \r\n                      ','1453122774',1,1,'[1]'),(244,'18','1453122728',4,'dev1453117545',3,'啊                              \r\n                      ','1453122786',1,1,'[1,1,1,1,1,1,1,0]'),(245,'21','1453120194',2,'kno1453119627',0,NULL,NULL,1,1,'[1,1,1,1,1]'),(246,'22','1453120263',2,'kno1453119627',0,NULL,NULL,1,1,'[1,1,1,1,1,1,1,1,0]'),(247,'23','1453123170',2,'kno1453119627',1,NULL,NULL,1,1,'[1,1,1,1,1,1,0,1,1,0]'),(248,'24','1453119627',1,'kno1453119627',3,NULL,NULL,1,1,NULL),(249,'25','1453119627',1,'kno1453119627',3,NULL,NULL,1,1,NULL),(250,'26','1453119627',1,'kno1453119627',3,NULL,NULL,1,1,NULL),(251,'1','1453119680',4,'dev1453119675',0,'同意                              \r\n                      ','1453121984',1,1,NULL),(252,'12','1453119675',1,'dev1453119675',1,NULL,NULL,1,1,NULL),(253,'13','1453119675',1,'dev1453119675',1,NULL,NULL,1,1,NULL),(254,'14','1453119675',1,'dev1453119675',2,NULL,NULL,1,1,NULL),(255,'15','1453119675',1,'dev1453119675',2,NULL,NULL,0,1,NULL),(256,'16','1453119675',1,'dev1453119675',3,NULL,NULL,0,1,NULL),(257,'17','1453119675',1,'dev1453119675',3,NULL,NULL,0,1,NULL),(258,'18','1453119675',1,'dev1453119675',3,NULL,NULL,0,1,NULL),(267,'1','1453122237',4,'dev1453122231',0,'                              \r\n                      ','1453122290',1,1,NULL),(268,'12','1453124993',4,'dev1453122231',1,'       \r\n                      ','1453125016',1,1,NULL),(269,'13','1453124997',4,'dev1453122231',1,'       \r\n                      ','1453125024',1,1,NULL),(270,'14','1453122231',1,'dev1453122231',2,NULL,NULL,1,1,NULL),(271,'15','1453122231',1,'dev1453122231',2,NULL,NULL,0,1,NULL),(272,'16','1453122231',1,'dev1453122231',3,NULL,NULL,0,1,NULL),(273,'17','1453122231',1,'dev1453122231',3,NULL,NULL,0,1,NULL),(274,'18','1453122231',1,'dev1453122231',3,NULL,NULL,0,1,NULL),(275,'1','1453122359',4,'dev1453122355',0,'                              \r\n                      ','1453122467',1,1,NULL),(276,'12','1453122355',1,'dev1453122355',1,NULL,NULL,1,1,NULL),(277,'13','1453122355',1,'dev1453122355',1,NULL,NULL,1,1,NULL),(278,'14','1453122355',1,'dev1453122355',2,NULL,NULL,1,1,NULL),(279,'15','1453122355',1,'dev1453122355',2,NULL,NULL,0,1,NULL),(280,'16','1453122355',1,'dev1453122355',3,NULL,NULL,0,1,NULL),(281,'17','1453122355',1,'dev1453122355',3,NULL,NULL,0,1,NULL),(282,'18','1453122355',1,'dev1453122355',3,NULL,NULL,0,1,NULL),(283,'1','1453123996',4,'dev1453122587',0,'通过       \r\n                      ','1453124077',1,1,'[1,1,1,1,1,1,1,0,1,1,1,1,0]'),(284,'12','1453125961',2,'dev1453122587',1,NULL,NULL,1,1,'[0,1,1,1,1,0,1,1,1,1,0]'),(285,'13','1453122587',1,'dev1453122587',1,NULL,NULL,1,1,'[1,0]'),(286,'14','1453122587',1,'dev1453122587',2,NULL,NULL,1,1,NULL),(287,'15','1453122587',1,'dev1453122587',2,NULL,NULL,0,1,NULL),(288,'16','1453122587',1,'dev1453122587',3,NULL,NULL,0,1,NULL),(289,'17','1453122587',1,'dev1453122587',3,NULL,NULL,0,1,NULL),(290,'18','1453122587',1,'dev1453122587',3,NULL,NULL,0,1,NULL),(291,'1','1453123803',4,'dev1453123795',0,'                              \r\n                      ','1453123866',1,1,NULL),(292,'12','1453123890',4,'dev1453123795',1,'12                              \r\n                      ','1453123926',1,1,NULL),(293,'13','1453123894',4,'dev1453123795',1,'34                              \r\n                      ','1453123933',1,1,NULL),(294,'14','1453123795',6,'dev1453123795',2,NULL,NULL,1,1,NULL),(295,'15','1453123972',4,'dev1453123795',2,'55                              \r\n                      ','1453123986',1,1,NULL),(296,'16','1453124008',4,'dev1453123795',3,'78                              \r\n                      ','1453124034',1,1,NULL),(297,'17','1453124012',4,'dev1453123795',3,'99                              \r\n                      ','1453124042',1,1,NULL),(298,'18','1453124020',4,'dev1453123795',3,'00                              \r\n                      ','1453124050',1,1,NULL),(299,'1','1453125046',2,'dev1453124865',0,NULL,NULL,1,1,NULL),(300,'12','1453124865',1,'dev1453124865',1,NULL,NULL,1,1,NULL),(301,'13','1453124865',1,'dev1453124865',1,NULL,NULL,1,1,NULL),(302,'14','1453124865',1,'dev1453124865',2,NULL,NULL,1,1,NULL),(303,'15','1453124865',1,'dev1453124865',2,NULL,NULL,0,1,NULL),(304,'16','1453124865',1,'dev1453124865',3,NULL,NULL,0,1,NULL),(305,'17','1453124865',1,'dev1453124865',3,NULL,NULL,0,1,NULL),(306,'18','1453124865',1,'dev1453124865',3,NULL,NULL,0,1,NULL),(307,'1','1453125144',1,'dev1453125144',0,NULL,NULL,1,1,NULL),(308,'12','1453125144',1,'dev1453125144',1,NULL,NULL,1,1,NULL),(309,'13','1453125144',1,'dev1453125144',1,NULL,NULL,1,1,NULL),(310,'14','1453125144',1,'dev1453125144',2,NULL,NULL,1,1,NULL),(311,'15','1453125144',1,'dev1453125144',2,NULL,NULL,0,1,NULL),(312,'16','1453125144',1,'dev1453125144',3,NULL,NULL,0,1,NULL),(313,'17','1453125144',1,'dev1453125144',3,NULL,NULL,0,1,NULL),(314,'18','1453125144',1,'dev1453125144',3,NULL,NULL,0,1,NULL);

/*Table structure for table `table_type` */

DROP TABLE IF EXISTS `table_type`;

CREATE TABLE `table_type` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(30) default NULL,
  `stage` int(11) default NULL,
  `open` int(11) default NULL,
  `sort` int(11) default NULL,
  `url` text,
  `reserve1` varchar(30) default NULL,
  `reserve2` varchar(30) default NULL,
  `reserve3` varchar(30) default NULL,
  `pdf_url` text,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `table_type` */

insert  into `table_type`(`id`,`name`,`stage`,`open`,`sort`,`url`,`reserve1`,`reserve2`,`reserve3`,`pdf_url`) values (1,'北京市通州区科技计划项目实施方案',0,1,NULL,'/website/html/view/template/apply/attach_1/attach1_main.php',NULL,NULL,NULL,'/extends/word/wordPrint/attach1_data.php'),(2,'通州区支持产学研合作项目申请书',0,1,NULL,'/website/html/view/template/apply/attach_2/attach2_main.php',NULL,NULL,NULL,'/extends/word/wordPrint/attach2_data.php'),(3,'通州区支持科技成果转化项目申报书',0,1,NULL,'/website/html/view/template/apply/attach_3/attach3_main.php',NULL,NULL,NULL,'/extends/word/wordPrint/attach3_data.php'),(4,'通州区支持承担市级以上科技项目申报书',0,1,NULL,'/website/html/view/template/apply/attach_4/attach4_main.php',NULL,NULL,NULL,'/extends/word/wordPrint/attach4_data.php'),(5,'通州区支持创新平台建设项目申报书',0,1,NULL,'/website/html/view/template/apply/attach_5/attach5_main.php',NULL,NULL,NULL,'/extends/word/wordPrint/attach5_data.php'),(6,'通州区技术合同登记奖励资金申报表',0,1,NULL,'/website/html/view/template/apply/attach_6/attach6_main.php',NULL,NULL,NULL,'/extends/word/wordPrint/attach6_data.php'),(7,'通州区支持技术输出能力提升项目申报书',0,1,NULL,'/website/html/view/template/apply/attach_7/attach7_main.php',NULL,NULL,NULL,'/extends/word/wordPrint/attach7_data.php'),(8,'通州区支持购买区内单位技术服务项目申报书',0,1,NULL,'/website/html/view/template/apply/attach_8/attach8_main.php',NULL,NULL,NULL,'/extends/word/wordPrint/attach8_data.php'),(9,'通州区支持科技企业孵化器大学科技园发展项目申报书',0,1,NULL,'/website/html/view/template/apply/attach_9/attach9_main.php',NULL,NULL,NULL,'/extends/word/wordPrint/attach9_data.php'),(10,'通州区支持科技服务机构发展项目申报书',0,1,NULL,'/website/html/view/template/apply/attach_10/attach10_main.php',NULL,NULL,NULL,'/extends/word/wordPrint/attach10_data.php'),(11,'通州区高新技术企业认定服务机构资助资金申请表',0,1,NULL,'/website/html/view/template/apply/attach_11/attach11_main.php',NULL,NULL,NULL,'/extends/word/wordPrint/attach11_data.php'),(12,'北京市通州区科技计划项目任务书',1,1,NULL,'/website/html/view/template/assignment.php',NULL,NULL,NULL,'/extends/word/wordPrint/assignment_data.php'),(13,'专家名单及专家论证意见',1,1,NULL,'/website/html/view/template/expert_solution.php',NULL,NULL,NULL,'/extends/word/wordPrint/expert_solution_data.php'),(14,'北京市通州区科技计划项目调整申请表',2,1,NULL,'/website/html/view/template/modify_solution.php',NULL,NULL,NULL,'/extends/word/wordPrint/modify_solution_data.php'),(15,'项目工作中期报告',2,0,NULL,'/website/html/view/template/middle_solution.php',NULL,NULL,NULL,'/extends/word/wordPrint/middle_solution_data.php'),(16,'项目验收专家组意见',3,0,NULL,'/website/html/view/template/expertProAccept.php',NULL,NULL,NULL,'/extends/word/wordPrint/expertProAccept_data.php'),(17,'项目经费总决算表',3,0,NULL,'/website/html/view/template/total_fundf.php',NULL,NULL,NULL,'/extends/word/wordPrint/TotalFund_data.php'),(18,'项目总结报告书',3,0,NULL,'/website/html/view/template/accept_project_summary.php',NULL,NULL,NULL,'/extends/word/wordPrint/accept_project_summary_data.php'),(19,'通州区科技创新人才资助申报推荐表',0,1,NULL,'/website/html/view/template/apply/genious_support/genious_support.php',NULL,NULL,NULL,'/extends/word/wordPrint/genious_support_data.php'),(20,'通州区科技创新人才奖励申报推荐表',0,1,NULL,'/website/html/view/template/apply/genious_award/genious_award.php',NULL,NULL,NULL,'/extends/word/wordPrint/genious_award_data.php'),(21,'北京通州区专利实施项目申报书',0,1,NULL,'/website/html/view/template/apply/patent_implement/attach3_patent/attach3_patent_main.php',NULL,NULL,NULL,'/extends/word/wordPrint/attach3_patent_data.php'),(22,'通州区专利实施项目可行性分析研究报告',0,1,NULL,'/website/html/view/template/apply/patent_implement/attach4_patent/attach4_patent_main.php',NULL,NULL,NULL,'/extends/word/wordPrint/attach4_patent_data.php'),(23,'项目资助协议书',1,1,NULL,'/website/html/view/template/apply/patent_implement/patent_grant/patent_grant_main.php',NULL,NULL,NULL,'/extends/word/wordPrint/patent_grant_main_data.php'),(24,'通州区专利实施项目验收报告书',3,1,NULL,'/website/html/view/template/apply/patent_implement/check_material/check_material.php',NULL,NULL,NULL,'/extends/word/wordPrint/check_material_data.php'),(25,'通州区专利实施项目工作总结报告',3,1,NULL,'/website/html/view/template/apply/patent_implement/work_summary/work_summary_main.php',NULL,NULL,NULL,'/extends/word/wordPrint/work_summary_data.php'),(26,'通州区专利实施项目经费总决算表',3,0,NULL,'/website/html/view/template/apply/patent_implement/project_summary/project_summary_main.php',NULL,NULL,NULL,'/extends/word/wordPrint/project_summary_main_data.php');

/*Table structure for table `table_type_relative` */

DROP TABLE IF EXISTS `table_type_relative`;

CREATE TABLE `table_type_relative` (
  `id` int(11) NOT NULL auto_increment,
  `project_type_id` int(11) default NULL,
  `para_id` tinyint(4) default NULL,
  `table_type_id` int(11) default NULL,
  `alias_name` varchar(255) default NULL,
  `subtable_list_id` int(11) default NULL,
  `is_new` tinyint(4) default NULL,
  `rules` text,
  `sort_id` int(11) default NULL,
  `status` tinyint(4) default NULL,
  `is_edit` int(11) default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `st_uniq` (`project_type_id`,`para_id`,`table_type_id`,`subtable_list_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `table_type_relative` */

insert  into `table_type_relative`(`id`,`project_type_id`,`para_id`,`table_type_id`,`alias_name`,`subtable_list_id`,`is_new`,`rules`,`sort_id`,`status`,`is_edit`) values (1,0,0,1,NULL,1,NULL,NULL,NULL,0,1),(2,0,0,1,NULL,2,NULL,NULL,NULL,0,1),(3,0,0,1,NULL,3,NULL,NULL,NULL,0,1),(4,0,0,1,NULL,4,NULL,NULL,NULL,0,1),(5,0,0,1,NULL,5,NULL,NULL,NULL,0,1),(6,0,0,1,NULL,6,NULL,NULL,NULL,0,1),(7,0,0,1,NULL,7,NULL,NULL,NULL,0,1),(8,0,0,1,NULL,8,NULL,NULL,NULL,0,1),(9,0,0,1,NULL,9,NULL,NULL,NULL,0,1),(10,0,0,1,NULL,10,NULL,NULL,NULL,0,1),(11,0,0,1,NULL,11,NULL,NULL,NULL,0,1),(12,0,0,1,NULL,12,NULL,NULL,NULL,0,1),(13,0,0,2,NULL,1912,NULL,NULL,NULL,0,0),(14,0,0,2,NULL,1913,NULL,NULL,NULL,0,0),(15,0,0,2,NULL,1914,NULL,NULL,NULL,0,0),(16,0,0,2,NULL,1915,NULL,NULL,NULL,0,0),(17,0,0,3,NULL,1916,NULL,NULL,NULL,0,0),(18,0,0,3,NULL,1917,NULL,NULL,NULL,0,0),(19,0,0,3,NULL,1918,NULL,NULL,NULL,0,0),(20,0,0,4,NULL,1919,NULL,NULL,NULL,0,0),(21,0,0,4,NULL,1920,NULL,NULL,NULL,0,0),(22,0,0,4,NULL,1921,NULL,NULL,NULL,0,0),(23,0,0,5,NULL,1922,NULL,NULL,NULL,0,0),(24,0,0,6,NULL,1923,NULL,NULL,NULL,0,0),(25,0,0,7,NULL,1924,NULL,NULL,NULL,0,0),(26,0,0,8,NULL,1925,NULL,NULL,NULL,0,0),(27,0,0,9,NULL,1926,NULL,NULL,NULL,0,0),(28,0,0,9,NULL,1927,NULL,NULL,NULL,0,0),(29,0,0,9,NULL,1928,NULL,NULL,NULL,0,0),(30,0,0,9,NULL,1929,NULL,NULL,NULL,0,0),(31,0,0,9,NULL,1930,NULL,NULL,NULL,0,0),(32,0,0,9,NULL,1931,NULL,NULL,NULL,0,0),(33,0,0,9,NULL,1932,NULL,NULL,NULL,0,0),(34,0,0,9,NULL,1933,NULL,NULL,NULL,0,0),(35,0,0,9,NULL,1934,NULL,NULL,NULL,0,0),(36,0,0,9,NULL,1935,NULL,NULL,NULL,0,0),(37,0,0,10,NULL,1936,NULL,NULL,NULL,0,0),(38,0,0,10,NULL,1937,NULL,NULL,NULL,0,0),(39,0,0,10,NULL,1938,NULL,NULL,NULL,0,0),(40,0,0,10,NULL,1939,NULL,NULL,NULL,0,0),(41,0,0,10,NULL,1940,NULL,NULL,NULL,0,0),(42,0,0,10,NULL,1941,NULL,NULL,NULL,0,0),(43,0,0,10,NULL,1942,NULL,NULL,NULL,0,0),(44,0,0,10,NULL,1943,NULL,NULL,NULL,0,0),(45,0,0,11,NULL,1944,NULL,NULL,NULL,0,0),(46,0,1,12,NULL,13,NULL,NULL,NULL,0,1),(47,0,1,12,NULL,14,NULL,NULL,NULL,0,1),(48,0,1,12,NULL,15,NULL,NULL,NULL,0,1),(49,0,1,12,NULL,16,NULL,NULL,NULL,0,1),(50,0,1,12,NULL,17,NULL,NULL,NULL,0,1),(51,0,1,12,NULL,18,NULL,NULL,NULL,0,1),(52,0,1,12,NULL,19,NULL,NULL,NULL,0,1),(53,0,1,12,NULL,20,NULL,NULL,NULL,0,1),(54,0,1,12,NULL,21,NULL,NULL,NULL,0,1),(55,0,1,12,NULL,22,NULL,NULL,NULL,0,1),(56,0,1,13,NULL,1945,NULL,NULL,NULL,0,0),(57,0,1,13,NULL,1946,NULL,NULL,NULL,0,0),(58,0,2,14,NULL,1948,NULL,NULL,NULL,0,0),(59,0,2,15,NULL,1949,NULL,NULL,NULL,0,0),(60,0,2,15,NULL,1950,NULL,NULL,NULL,0,0),(61,0,2,15,NULL,1951,NULL,NULL,NULL,0,0),(62,0,3,16,NULL,1952,NULL,NULL,NULL,0,0),(63,0,3,16,NULL,1953,NULL,NULL,NULL,0,0),(64,0,3,17,NULL,1954,NULL,NULL,NULL,0,0),(65,0,3,18,NULL,1955,NULL,NULL,NULL,0,0),(66,0,3,18,NULL,1956,NULL,NULL,NULL,0,0),(67,0,3,18,NULL,1957,NULL,NULL,NULL,0,0),(68,0,3,18,NULL,1958,NULL,NULL,NULL,0,0),(69,0,3,18,NULL,1959,NULL,NULL,NULL,0,0),(70,0,3,18,NULL,1960,NULL,NULL,NULL,0,0),(71,0,3,18,NULL,1961,NULL,NULL,NULL,0,0),(72,0,3,18,NULL,1962,NULL,NULL,NULL,0,0),(73,0,0,19,NULL,1971,NULL,NULL,NULL,0,0),(74,0,0,19,NULL,1972,NULL,NULL,NULL,0,0),(75,0,0,19,NULL,1973,NULL,NULL,NULL,0,0),(76,0,0,19,NULL,1974,NULL,NULL,NULL,0,0),(77,0,0,19,NULL,1975,NULL,NULL,NULL,0,0),(78,0,0,19,NULL,1976,NULL,NULL,NULL,0,0),(79,0,0,19,NULL,1977,NULL,NULL,NULL,0,0),(80,0,0,19,NULL,1978,NULL,NULL,NULL,0,0),(81,0,0,19,NULL,1979,NULL,NULL,NULL,0,0),(82,0,0,20,NULL,1963,NULL,NULL,NULL,0,0),(83,0,0,20,NULL,1964,NULL,NULL,NULL,0,0),(84,0,0,20,NULL,1965,NULL,NULL,NULL,0,0),(85,0,0,20,NULL,1966,NULL,NULL,NULL,0,0),(86,0,0,20,NULL,1967,NULL,NULL,NULL,0,0),(87,0,0,20,NULL,1968,NULL,NULL,NULL,0,0),(88,0,0,20,NULL,1969,NULL,NULL,NULL,0,0),(89,0,0,20,NULL,1970,NULL,NULL,NULL,0,0),(90,0,0,21,NULL,27,NULL,NULL,NULL,0,0),(91,0,0,21,NULL,28,NULL,NULL,NULL,0,0),(92,0,0,21,NULL,33,NULL,NULL,NULL,0,0),(93,0,0,21,NULL,34,NULL,NULL,NULL,0,0),(94,0,0,21,NULL,35,NULL,NULL,NULL,0,0),(95,0,0,21,NULL,36,NULL,NULL,NULL,0,0),(96,0,0,22,NULL,1981,NULL,NULL,NULL,0,0),(97,0,0,22,NULL,1982,NULL,NULL,NULL,0,0),(98,0,0,22,NULL,1983,NULL,NULL,NULL,0,0),(99,0,0,22,NULL,1984,NULL,NULL,NULL,0,0),(100,0,0,22,NULL,1985,NULL,NULL,NULL,0,0),(101,0,0,22,NULL,1986,NULL,NULL,NULL,0,0),(102,0,0,22,NULL,1987,NULL,NULL,NULL,0,0),(103,0,0,22,NULL,1988,NULL,NULL,NULL,0,0),(104,0,1,23,NULL,29,NULL,NULL,NULL,0,0),(105,0,1,23,NULL,30,NULL,NULL,NULL,0,0),(106,0,1,23,NULL,31,NULL,NULL,NULL,0,0),(107,0,1,23,NULL,32,NULL,NULL,NULL,0,0),(108,0,1,23,NULL,37,NULL,NULL,NULL,0,0),(109,0,1,23,NULL,38,NULL,NULL,NULL,0,0),(110,0,1,23,NULL,39,NULL,NULL,NULL,0,0),(111,0,1,23,NULL,40,NULL,NULL,NULL,0,0),(112,0,1,23,NULL,41,NULL,NULL,NULL,0,0),(113,0,3,24,NULL,1989,NULL,NULL,NULL,0,0),(114,0,3,24,NULL,1990,NULL,NULL,NULL,0,0),(115,0,3,24,NULL,1991,NULL,NULL,NULL,0,0),(116,0,3,24,NULL,1992,NULL,NULL,NULL,0,0),(117,0,3,24,NULL,1993,NULL,NULL,NULL,0,0),(118,0,3,24,NULL,1994,NULL,NULL,NULL,0,0),(119,0,3,24,NULL,1995,NULL,NULL,NULL,0,0),(120,0,3,24,NULL,1996,NULL,NULL,NULL,0,0),(121,0,3,24,NULL,1997,NULL,NULL,NULL,0,0),(122,0,3,24,NULL,1998,NULL,NULL,NULL,0,0),(123,0,3,24,NULL,1999,NULL,NULL,NULL,0,0),(124,0,3,25,NULL,42,NULL,NULL,NULL,0,0),(125,0,3,25,NULL,43,NULL,NULL,NULL,0,0),(126,0,3,25,NULL,44,NULL,NULL,NULL,0,0),(127,0,3,25,NULL,45,NULL,NULL,NULL,0,0),(128,0,3,25,NULL,46,NULL,NULL,NULL,0,0),(129,0,3,25,NULL,47,NULL,NULL,NULL,0,0),(130,0,3,26,NULL,2001,NULL,NULL,NULL,0,0),(2913,1,0,1,NULL,1,NULL,NULL,0,0,1),(2914,1,0,1,NULL,2,1,'{\"items\":[{\"name\":\"project_meaning\",\"subtitle\":\"项目的目的、意义及必要性\",\"tip\":\"  \",\"status\":-1},{\"name\":\"extra_1453114463000\",\"subtitle\":\"请输入小标题\",\"tip\":\"请输入说明\",\"status\":0}],\"table_name\":\"项目的目的、意义及必要性\"}',0,0,1),(2915,1,0,1,NULL,3,NULL,NULL,0,0,1),(2916,1,0,1,NULL,4,NULL,NULL,0,0,1),(2917,1,0,1,NULL,5,NULL,NULL,0,0,1),(2918,1,0,1,NULL,6,NULL,NULL,0,0,1),(2919,1,0,1,NULL,7,NULL,NULL,0,0,1),(2920,1,0,1,NULL,8,NULL,NULL,0,0,1),(2921,1,0,1,NULL,9,NULL,NULL,0,0,1),(2922,1,0,1,NULL,10,NULL,NULL,0,0,1),(2923,1,0,1,NULL,11,NULL,NULL,0,0,1),(2924,1,0,1,NULL,12,NULL,NULL,0,0,1),(2925,1,1,12,NULL,13,NULL,NULL,0,-1,1),(2926,1,1,12,NULL,14,1,'{\"items\":[{\"name\":\"project_mission\",\"subtitle\":\"项目任务：\",\"tip\":\"项目任务应明确科技工作在解决实际问题中的责任和完成工作的范围、界限，即项目全部工作和成果的整体描述。\",\"status\":0},{\"name\":\"project_aim\",\"subtitle\":\"项目目标：\",\"tip\":\"项目目标内容应完整、明确，并能够考查项目完成的程度和实际效果。包括定性、定量两个部分，定性的内容应概括项目预期效果的几个方面，定量的内容应说明预期效果的程度和范围。\",\"status\":-1},{\"name\":\"project_kpi\",\"subtitle\":\"考核指标：\",\"tip\":\"考核指标应体现项目目标预期完成程度和水平，以及对项目各项研究开发内容预期完成情况的考核。指标体系应系统、完整，客观可检查）  （项目目标和考核指标应能够系统、完整地表达任务完成情况，具有成果的依附形式或载体，体现实际效果，可查、可测、可看。\",\"status\":-1}],\"table_name\":\"项目任务与目标、考核指标\"}',0,-1,1),(2927,1,1,12,NULL,15,NULL,NULL,0,-1,1),(2928,1,1,12,NULL,16,NULL,NULL,0,-1,1),(2929,1,1,12,NULL,17,NULL,NULL,0,-1,1),(2930,1,1,12,NULL,18,NULL,NULL,0,0,1),(2931,1,1,12,NULL,19,NULL,NULL,0,0,1),(2932,1,1,12,NULL,20,NULL,NULL,0,0,1),(2933,1,1,12,NULL,21,NULL,NULL,0,0,1),(2934,1,1,12,NULL,22,NULL,NULL,0,0,1),(2935,1,1,13,NULL,1945,NULL,NULL,0,0,0),(2936,1,1,13,NULL,1946,NULL,NULL,0,0,0),(2937,1,2,14,NULL,1948,NULL,NULL,0,0,0),(2938,1,2,15,NULL,1949,NULL,NULL,0,0,0),(2939,1,2,15,NULL,1950,NULL,NULL,0,0,0),(2940,1,2,15,NULL,1951,NULL,NULL,0,0,0),(2941,1,3,16,NULL,1952,NULL,NULL,0,0,0),(2942,1,3,16,NULL,1953,NULL,NULL,0,0,0),(2943,1,3,17,NULL,1954,NULL,NULL,0,0,0),(2944,1,3,18,NULL,1955,NULL,NULL,0,0,0),(2945,1,3,18,NULL,1956,NULL,NULL,0,0,0),(2946,1,3,18,NULL,1957,NULL,NULL,0,0,0),(2947,1,3,18,NULL,1958,NULL,NULL,0,0,0),(2948,1,3,18,NULL,1959,NULL,NULL,0,0,0),(2949,1,3,18,NULL,1960,NULL,NULL,0,0,0),(2950,1,3,18,NULL,1961,NULL,NULL,0,0,0),(2951,1,3,18,NULL,1962,NULL,NULL,0,0,0),(2952,2,0,1,NULL,1,NULL,NULL,0,0,1),(2953,2,0,1,NULL,2,NULL,NULL,0,0,1),(2954,2,0,1,NULL,3,NULL,NULL,0,0,1),(2955,2,0,1,NULL,4,NULL,NULL,0,0,1),(2956,2,0,1,NULL,5,NULL,NULL,0,0,1),(2957,2,0,1,NULL,6,NULL,NULL,0,0,1),(2958,2,0,1,NULL,7,NULL,NULL,0,0,1),(2959,2,0,1,NULL,8,NULL,NULL,0,0,1),(2960,2,0,1,NULL,9,NULL,NULL,0,0,1),(2961,2,0,1,NULL,10,NULL,NULL,0,0,1),(2962,2,0,1,NULL,11,NULL,NULL,0,0,1),(2963,2,0,1,NULL,12,NULL,NULL,0,0,1),(2964,2,1,12,NULL,13,NULL,NULL,0,0,1),(2965,2,1,12,NULL,14,NULL,NULL,0,0,1),(2966,2,1,12,NULL,15,NULL,NULL,0,0,1),(2967,2,1,12,NULL,16,NULL,NULL,0,0,1),(2968,2,1,12,NULL,17,NULL,NULL,0,0,1),(2969,2,1,12,NULL,18,NULL,NULL,0,0,1),(2970,2,1,12,NULL,19,NULL,NULL,0,0,1),(2971,2,1,12,NULL,20,NULL,NULL,0,0,1),(2972,2,1,12,NULL,21,NULL,NULL,0,0,1),(2973,2,1,12,NULL,22,NULL,NULL,0,0,1),(2974,2,1,13,NULL,1945,NULL,NULL,0,0,0),(2975,2,1,13,NULL,1946,NULL,NULL,0,0,0),(2976,2,2,14,NULL,1948,NULL,NULL,0,0,0),(2977,2,2,15,NULL,1949,NULL,NULL,0,0,0),(2978,2,2,15,NULL,1950,NULL,NULL,0,0,0),(2979,2,2,15,NULL,1951,NULL,NULL,0,0,0),(2980,2,3,16,NULL,1952,NULL,NULL,0,0,0),(2981,2,3,16,NULL,1953,NULL,NULL,0,0,0),(2982,2,3,17,NULL,1954,NULL,NULL,0,0,0),(2983,2,3,18,NULL,1955,NULL,NULL,0,0,0),(2984,2,3,18,NULL,1956,NULL,NULL,0,0,0),(2985,2,3,18,NULL,1957,NULL,NULL,0,0,0),(2986,2,3,18,NULL,1958,NULL,NULL,0,0,0),(2987,2,3,18,NULL,1959,NULL,NULL,0,0,0),(2988,2,3,18,NULL,1960,NULL,NULL,0,0,0),(2989,2,3,18,NULL,1961,NULL,NULL,0,0,0),(2990,2,3,18,NULL,1962,NULL,NULL,0,0,0),(2991,3,0,1,NULL,1,NULL,NULL,0,0,1),(2992,3,0,1,NULL,2,NULL,NULL,0,0,1),(2993,3,0,1,NULL,3,NULL,NULL,0,0,1),(2994,3,0,1,NULL,4,NULL,NULL,0,0,1),(2995,3,0,1,NULL,5,NULL,NULL,0,0,1),(2996,3,0,1,NULL,6,NULL,NULL,0,0,1),(2997,3,0,1,NULL,7,NULL,NULL,0,0,1),(2998,3,0,1,NULL,8,NULL,NULL,0,0,1),(2999,3,0,1,NULL,9,NULL,NULL,0,0,1),(3000,3,0,1,NULL,10,NULL,NULL,0,0,1),(3001,3,0,1,NULL,11,NULL,NULL,0,0,1),(3002,3,0,1,NULL,12,NULL,NULL,0,0,1),(3003,3,1,12,NULL,13,NULL,NULL,0,0,1),(3004,3,1,12,NULL,14,NULL,NULL,0,0,1),(3005,3,1,12,NULL,15,NULL,NULL,0,0,1),(3006,3,1,12,NULL,16,NULL,NULL,0,0,1),(3007,3,1,12,NULL,17,NULL,NULL,0,0,1),(3008,3,1,12,NULL,18,NULL,NULL,0,0,1),(3009,3,1,12,NULL,19,NULL,NULL,0,0,1),(3010,3,1,12,NULL,20,NULL,NULL,0,0,1),(3011,3,1,12,NULL,21,NULL,NULL,0,0,1),(3012,3,1,12,NULL,22,NULL,NULL,0,0,1),(3013,3,1,13,NULL,1945,NULL,NULL,0,0,0),(3014,3,1,13,NULL,1946,NULL,NULL,0,0,0),(3015,3,2,14,NULL,1948,NULL,NULL,0,0,0),(3016,3,2,15,NULL,1949,NULL,NULL,0,0,0),(3017,3,2,15,NULL,1950,NULL,NULL,0,0,0),(3018,3,2,15,NULL,1951,NULL,NULL,0,0,0),(3019,3,3,16,NULL,1952,NULL,NULL,0,0,0),(3020,3,3,16,NULL,1953,NULL,NULL,0,0,0),(3021,3,3,17,NULL,1954,NULL,NULL,0,0,0),(3022,3,3,18,NULL,1955,NULL,NULL,0,0,0),(3023,3,3,18,NULL,1956,NULL,NULL,0,0,0),(3024,3,3,18,NULL,1957,NULL,NULL,0,0,0),(3025,3,3,18,NULL,1958,NULL,NULL,0,0,0),(3026,3,3,18,NULL,1959,NULL,NULL,0,0,0),(3027,3,3,18,NULL,1960,NULL,NULL,0,0,0),(3028,3,3,18,NULL,1961,NULL,NULL,0,0,0),(3029,3,3,18,NULL,1962,NULL,NULL,0,0,0),(3030,4,0,1,NULL,1,NULL,NULL,0,0,1),(3031,4,0,1,NULL,2,NULL,NULL,0,0,1),(3032,4,0,1,NULL,3,NULL,NULL,0,0,1),(3033,4,0,1,NULL,4,NULL,NULL,0,0,1),(3034,4,0,1,NULL,5,NULL,NULL,0,0,1),(3035,4,0,1,NULL,6,NULL,NULL,0,0,1),(3036,4,0,1,NULL,7,NULL,NULL,0,0,1),(3037,4,0,1,NULL,8,NULL,NULL,0,0,1),(3038,4,0,1,NULL,9,NULL,NULL,0,0,1),(3039,4,0,1,NULL,10,NULL,NULL,0,0,1),(3040,4,0,1,NULL,11,NULL,NULL,0,0,1),(3041,4,0,1,NULL,12,NULL,NULL,0,0,1),(3042,4,1,12,NULL,13,NULL,NULL,0,0,1),(3043,4,1,12,NULL,14,NULL,NULL,0,0,1),(3044,4,1,12,NULL,15,NULL,NULL,0,0,1),(3045,4,1,12,NULL,16,NULL,NULL,0,0,1),(3046,4,1,12,NULL,17,NULL,NULL,0,0,1),(3047,4,1,12,NULL,18,NULL,NULL,0,0,1),(3048,4,1,12,NULL,19,NULL,NULL,0,0,1),(3049,4,1,12,NULL,20,NULL,NULL,0,0,1),(3050,4,1,12,NULL,21,NULL,NULL,0,0,1),(3051,4,1,12,NULL,22,NULL,NULL,0,0,1),(3052,4,1,13,NULL,1945,NULL,NULL,0,0,0),(3053,4,1,13,NULL,1946,NULL,NULL,0,0,0),(3054,4,2,14,NULL,1948,NULL,NULL,0,0,0),(3055,4,2,15,NULL,1949,NULL,NULL,0,0,0),(3056,4,2,15,NULL,1950,NULL,NULL,0,0,0),(3057,4,2,15,NULL,1951,NULL,NULL,0,0,0),(3058,4,3,16,NULL,1952,NULL,NULL,0,0,0),(3059,4,3,16,NULL,1953,NULL,NULL,0,0,0),(3060,4,3,17,NULL,1954,NULL,NULL,0,0,0),(3061,4,3,18,NULL,1955,NULL,NULL,0,0,0),(3062,4,3,18,NULL,1956,NULL,NULL,0,0,0),(3063,4,3,18,NULL,1957,NULL,NULL,0,0,0),(3064,4,3,18,NULL,1958,NULL,NULL,0,0,0),(3065,4,3,18,NULL,1959,NULL,NULL,0,0,0),(3066,4,3,18,NULL,1960,NULL,NULL,0,0,0),(3067,4,3,18,NULL,1961,NULL,NULL,0,0,0),(3068,4,3,18,NULL,1962,NULL,NULL,0,0,0),(3069,6,0,1,NULL,1,NULL,NULL,0,0,1),(3070,6,0,1,NULL,2,NULL,NULL,0,0,1),(3071,6,0,1,NULL,3,NULL,NULL,0,0,1),(3072,6,0,1,NULL,4,NULL,NULL,0,0,1),(3073,6,0,1,NULL,5,NULL,NULL,0,0,1),(3074,6,0,1,NULL,6,NULL,NULL,0,0,1),(3075,6,0,1,NULL,7,NULL,NULL,0,0,1),(3076,6,0,1,NULL,8,NULL,NULL,0,0,1),(3077,6,0,1,NULL,9,NULL,NULL,0,0,1),(3078,6,0,1,NULL,10,NULL,NULL,0,0,1),(3079,6,0,1,NULL,11,NULL,NULL,0,0,1),(3080,6,0,1,NULL,12,NULL,NULL,0,0,1),(3081,6,0,5,NULL,1922,NULL,NULL,0,0,0),(3082,6,1,12,NULL,13,NULL,NULL,0,0,1),(3083,6,1,12,NULL,14,NULL,NULL,0,0,1),(3084,6,1,12,NULL,15,NULL,NULL,0,0,1),(3085,6,1,12,NULL,16,NULL,NULL,0,0,1),(3086,6,1,12,NULL,17,NULL,NULL,0,0,1),(3087,6,1,12,NULL,18,NULL,NULL,0,0,1),(3088,6,1,12,NULL,19,NULL,NULL,0,0,1),(3089,6,1,12,NULL,20,NULL,NULL,0,0,1),(3090,6,1,12,NULL,21,NULL,NULL,0,0,1),(3091,6,1,12,NULL,22,NULL,NULL,0,0,1),(3092,6,1,13,NULL,1945,NULL,NULL,0,0,0),(3093,6,1,13,NULL,1946,NULL,NULL,0,0,0),(3094,6,2,14,NULL,1948,NULL,NULL,0,0,0),(3095,6,2,15,NULL,1949,NULL,NULL,0,0,0),(3096,6,2,15,NULL,1950,NULL,NULL,0,0,0),(3097,6,2,15,NULL,1951,NULL,NULL,0,0,0),(3098,6,3,16,NULL,1952,NULL,NULL,0,0,0),(3099,6,3,16,NULL,1953,NULL,NULL,0,0,0),(3100,6,3,17,NULL,1954,NULL,NULL,0,0,0),(3101,6,3,18,NULL,1955,NULL,NULL,0,0,0),(3102,6,3,18,NULL,1956,NULL,NULL,0,0,0),(3103,6,3,18,NULL,1957,NULL,NULL,0,0,0),(3104,6,3,18,NULL,1958,NULL,NULL,0,0,0),(3105,6,3,18,NULL,1959,NULL,NULL,0,0,0),(3106,6,3,18,NULL,1960,NULL,NULL,0,0,0),(3107,6,3,18,NULL,1961,NULL,NULL,0,0,0),(3108,6,3,18,NULL,1962,NULL,NULL,0,0,0),(3427,14,0,1,NULL,1,NULL,NULL,0,0,1),(3428,14,0,1,NULL,2,1,'{\"items\":[{\"name\":\"project_meaning\",\"subtitle\":\"项目的目的、意义及必要性\",\"tip\":\"  \",\"status\":0},{\"name\":\"extra_1453096933000\",\"subtitle\":\"标题1\",\"tip\":\"请输入说明\",\"status\":0}],\"table_name\":\"项目的目的、意义及必要性\"}',0,0,1),(3429,14,0,1,NULL,3,NULL,NULL,0,0,1),(3430,14,0,1,NULL,4,NULL,NULL,0,0,1),(3431,14,0,1,NULL,5,NULL,NULL,0,0,1),(3432,14,0,1,NULL,6,NULL,NULL,0,0,1),(3433,14,0,1,NULL,7,NULL,NULL,0,0,1),(3434,14,0,1,NULL,8,NULL,NULL,0,0,1),(3435,14,0,1,NULL,9,NULL,NULL,0,0,1),(3436,14,0,1,NULL,10,NULL,NULL,0,0,1),(3437,14,0,1,NULL,11,NULL,NULL,0,0,1),(3438,14,0,1,NULL,12,NULL,NULL,0,0,1),(3461,7,0,1,NULL,1,NULL,NULL,0,0,1),(3462,7,0,1,NULL,2,NULL,NULL,0,0,1),(3463,7,0,1,NULL,3,NULL,NULL,0,0,1),(3464,7,0,1,NULL,4,NULL,NULL,0,0,1),(3465,7,0,1,NULL,5,NULL,NULL,0,0,1),(3466,7,0,1,NULL,6,NULL,NULL,0,0,1),(3467,7,0,1,NULL,7,NULL,NULL,0,0,1),(3468,7,0,1,NULL,8,NULL,NULL,0,0,1),(3469,7,0,1,NULL,9,NULL,NULL,0,0,1),(3470,7,0,1,NULL,10,NULL,NULL,0,0,1),(3471,7,0,1,NULL,11,NULL,NULL,0,0,1),(3472,7,0,1,NULL,12,NULL,NULL,0,0,1),(3473,7,0,9,NULL,1926,NULL,NULL,0,0,0),(3474,7,0,9,NULL,1927,NULL,NULL,0,0,0),(3475,7,0,9,NULL,1928,NULL,NULL,0,0,0),(3476,7,0,9,NULL,1929,NULL,NULL,0,0,0),(3477,7,0,9,NULL,1930,NULL,NULL,0,0,0),(3478,7,0,9,NULL,1931,NULL,NULL,0,0,0),(3479,7,0,9,NULL,1932,NULL,NULL,0,0,0),(3480,7,0,9,NULL,1933,NULL,NULL,0,0,0),(3481,7,0,9,NULL,1934,NULL,NULL,0,0,0),(3482,7,0,9,NULL,1935,NULL,NULL,0,0,0),(3483,7,1,12,NULL,13,NULL,NULL,0,0,1),(3484,7,1,12,NULL,14,NULL,NULL,0,0,1),(3485,7,1,12,NULL,15,NULL,NULL,0,0,1),(3486,7,1,12,NULL,16,NULL,NULL,0,0,1),(3487,7,1,12,NULL,17,NULL,NULL,0,0,1),(3488,7,1,12,NULL,18,NULL,NULL,0,0,1),(3489,7,1,12,NULL,19,NULL,NULL,0,0,1),(3490,7,1,12,NULL,20,NULL,NULL,0,0,1),(3491,7,1,12,NULL,21,NULL,NULL,0,0,1),(3492,7,1,12,NULL,22,NULL,NULL,0,0,1),(3493,7,1,13,NULL,1945,NULL,NULL,0,0,0),(3494,7,1,13,NULL,1946,NULL,NULL,0,0,0),(3495,7,2,14,NULL,1948,NULL,NULL,0,0,0),(3496,7,2,15,NULL,1949,NULL,NULL,0,0,0),(3497,7,2,15,NULL,1950,NULL,NULL,0,0,0),(3498,7,2,15,NULL,1951,NULL,NULL,0,0,0),(3499,7,3,16,NULL,1952,NULL,NULL,0,0,0),(3500,7,3,16,NULL,1953,NULL,NULL,0,0,0),(3501,7,3,17,NULL,1954,NULL,NULL,0,0,0),(3502,7,3,18,NULL,1955,NULL,NULL,0,0,0),(3503,7,3,18,NULL,1956,NULL,NULL,0,0,0),(3504,7,3,18,NULL,1957,NULL,NULL,0,0,0),(3505,7,3,18,NULL,1958,NULL,NULL,0,0,0),(3506,7,3,18,NULL,1959,NULL,NULL,0,0,0),(3507,7,3,18,NULL,1960,NULL,NULL,0,0,0),(3508,7,3,18,NULL,1961,NULL,NULL,0,0,0),(3509,7,3,18,NULL,1962,NULL,NULL,0,0,0),(3510,8,0,1,NULL,1,NULL,NULL,0,0,1),(3511,8,0,1,NULL,2,NULL,NULL,0,0,1),(3512,8,0,1,NULL,3,NULL,NULL,0,0,1),(3513,8,0,1,NULL,4,NULL,NULL,0,0,1),(3514,8,0,1,NULL,5,NULL,NULL,0,0,1),(3515,8,0,1,NULL,6,NULL,NULL,0,0,1),(3516,8,0,1,NULL,7,NULL,NULL,0,0,1),(3517,8,0,1,NULL,8,NULL,NULL,0,0,1),(3518,8,0,1,NULL,9,NULL,NULL,0,0,1),(3519,8,0,1,NULL,10,NULL,NULL,0,0,1),(3520,8,0,1,NULL,11,NULL,NULL,0,0,1),(3521,8,0,1,NULL,12,NULL,NULL,0,0,1),(3522,8,0,9,NULL,1926,NULL,NULL,0,0,0),(3523,8,0,9,NULL,1927,NULL,NULL,0,0,0),(3524,8,0,9,NULL,1928,NULL,NULL,0,0,0),(3525,8,0,9,NULL,1929,NULL,NULL,0,0,0),(3526,8,0,9,NULL,1930,NULL,NULL,0,0,0),(3527,8,0,9,NULL,1931,NULL,NULL,0,0,0),(3528,8,0,9,NULL,1932,NULL,NULL,0,0,0),(3529,8,0,9,NULL,1933,NULL,NULL,0,0,0),(3530,8,0,9,NULL,1934,NULL,NULL,0,0,0),(3531,8,0,9,NULL,1935,NULL,NULL,0,0,0),(3532,8,1,12,NULL,13,NULL,NULL,0,0,1),(3533,8,1,12,NULL,14,NULL,NULL,0,0,1),(3534,8,1,12,NULL,15,NULL,NULL,0,0,1),(3535,8,1,12,NULL,16,NULL,NULL,0,0,1),(3536,8,1,12,NULL,17,NULL,NULL,0,0,1),(3537,8,1,12,NULL,18,NULL,NULL,0,0,1),(3538,8,1,12,NULL,19,NULL,NULL,0,0,1),(3539,8,1,12,NULL,20,NULL,NULL,0,0,1),(3540,8,1,12,NULL,21,NULL,NULL,0,0,1),(3541,8,1,12,NULL,22,NULL,NULL,0,0,1),(3542,8,1,13,NULL,1945,NULL,NULL,0,0,0),(3543,8,1,13,NULL,1946,NULL,NULL,0,0,0),(3544,8,2,14,NULL,1948,NULL,NULL,0,0,0),(3545,8,2,15,NULL,1949,NULL,NULL,0,0,0),(3546,8,2,15,NULL,1950,NULL,NULL,0,0,0),(3547,8,2,15,NULL,1951,NULL,NULL,0,0,0),(3548,8,3,16,NULL,1952,NULL,NULL,0,0,0),(3549,8,3,16,NULL,1953,NULL,NULL,0,0,0),(3550,8,3,17,NULL,1954,NULL,NULL,0,0,0),(3551,8,3,18,NULL,1955,NULL,NULL,0,0,0),(3552,8,3,18,NULL,1956,NULL,NULL,0,0,0),(3553,8,3,18,NULL,1957,NULL,NULL,0,0,0),(3554,8,3,18,NULL,1958,NULL,NULL,0,0,0),(3555,8,3,18,NULL,1959,NULL,NULL,0,0,0),(3556,8,3,18,NULL,1960,NULL,NULL,0,0,0),(3557,8,3,18,NULL,1961,NULL,NULL,0,0,0),(3558,8,3,18,NULL,1962,NULL,NULL,0,0,0),(3559,9,0,1,NULL,1,NULL,NULL,0,0,1),(3560,9,0,1,NULL,2,NULL,NULL,0,0,1),(3561,9,0,1,NULL,3,NULL,NULL,0,0,1),(3562,9,0,1,NULL,4,NULL,NULL,0,0,1),(3563,9,0,1,NULL,5,NULL,NULL,0,0,1),(3564,9,0,1,NULL,6,NULL,NULL,0,0,1),(3565,9,0,1,NULL,7,NULL,NULL,0,0,1),(3566,9,0,1,NULL,8,NULL,NULL,0,0,1),(3567,9,0,1,NULL,9,NULL,NULL,0,0,1),(3568,9,0,1,NULL,10,NULL,NULL,0,0,1),(3569,9,0,1,NULL,11,NULL,NULL,0,0,1),(3570,9,0,1,NULL,12,NULL,NULL,0,0,1),(3571,9,0,9,NULL,1926,NULL,NULL,0,0,0),(3572,9,0,9,NULL,1927,NULL,NULL,0,0,0),(3573,9,0,9,NULL,1928,NULL,NULL,0,0,0),(3574,9,0,9,NULL,1929,NULL,NULL,0,0,0),(3575,9,0,9,NULL,1930,NULL,NULL,0,0,0),(3576,9,0,9,NULL,1931,NULL,NULL,0,0,0),(3577,9,0,9,NULL,1932,NULL,NULL,0,0,0),(3578,9,0,9,NULL,1933,NULL,NULL,0,0,0),(3579,9,0,9,NULL,1934,NULL,NULL,0,0,0),(3580,9,0,9,NULL,1935,NULL,NULL,0,0,0),(3581,9,1,12,NULL,13,NULL,NULL,0,0,1),(3582,9,1,12,NULL,14,NULL,NULL,0,0,1),(3583,9,1,12,NULL,15,NULL,NULL,0,0,1),(3584,9,1,12,NULL,16,NULL,NULL,0,0,1),(3585,9,1,12,NULL,17,NULL,NULL,0,0,1),(3586,9,1,12,NULL,18,NULL,NULL,0,0,1),(3587,9,1,12,NULL,19,NULL,NULL,0,0,1),(3588,9,1,12,NULL,20,NULL,NULL,0,0,1),(3589,9,1,12,NULL,21,NULL,NULL,0,0,1),(3590,9,1,12,NULL,22,NULL,NULL,0,0,1),(3591,9,1,13,NULL,1945,NULL,NULL,0,0,0),(3592,9,1,13,NULL,1946,NULL,NULL,0,0,0),(3593,9,2,14,NULL,1948,NULL,NULL,0,0,0),(3594,9,2,15,NULL,1949,NULL,NULL,0,0,0),(3595,9,2,15,NULL,1950,NULL,NULL,0,0,0),(3596,9,2,15,NULL,1951,NULL,NULL,0,0,0),(3597,9,3,16,NULL,1952,NULL,NULL,0,0,0),(3598,9,3,16,NULL,1953,NULL,NULL,0,0,0),(3599,9,3,17,NULL,1954,NULL,NULL,0,0,0),(3600,9,3,18,NULL,1955,NULL,NULL,0,0,0),(3601,9,3,18,NULL,1956,NULL,NULL,0,0,0),(3602,9,3,18,NULL,1957,NULL,NULL,0,0,0),(3603,9,3,18,NULL,1958,NULL,NULL,0,0,0),(3604,9,3,18,NULL,1959,NULL,NULL,0,0,0),(3605,9,3,18,NULL,1960,NULL,NULL,0,0,0),(3606,9,3,18,NULL,1961,NULL,NULL,0,0,0),(3607,9,3,18,NULL,1962,NULL,NULL,0,0,0),(3608,11,0,21,NULL,27,NULL,NULL,0,0,0),(3609,11,0,21,NULL,28,NULL,NULL,0,0,0),(3610,11,0,21,NULL,33,NULL,NULL,0,0,0),(3611,11,0,21,NULL,34,NULL,NULL,0,0,0),(3612,11,0,21,NULL,35,NULL,NULL,0,0,0),(3613,11,0,21,NULL,36,NULL,NULL,0,0,0),(3614,11,0,22,NULL,1981,NULL,NULL,0,0,0),(3615,11,0,22,NULL,1982,NULL,NULL,0,0,0),(3616,11,0,22,NULL,1983,NULL,NULL,0,0,0),(3617,11,0,22,NULL,1984,NULL,NULL,0,0,0),(3618,11,0,22,NULL,1985,NULL,NULL,0,0,0),(3619,11,0,22,NULL,1986,NULL,NULL,0,0,0),(3620,11,0,22,NULL,1987,NULL,NULL,0,0,0),(3621,11,0,22,NULL,1988,NULL,NULL,0,0,0),(3622,11,1,23,NULL,29,NULL,NULL,0,0,0),(3623,11,1,23,NULL,30,NULL,NULL,0,0,0),(3624,11,1,23,NULL,31,NULL,NULL,0,0,0),(3625,11,1,23,NULL,32,NULL,NULL,0,0,0),(3626,11,1,23,NULL,37,NULL,NULL,0,0,0),(3627,11,1,23,NULL,38,NULL,NULL,0,0,0),(3628,11,1,23,NULL,39,NULL,NULL,0,0,0),(3629,11,1,23,NULL,40,NULL,NULL,0,0,0),(3630,11,1,23,NULL,41,NULL,NULL,0,0,0),(3631,11,3,24,NULL,1989,NULL,NULL,0,0,0),(3632,11,3,24,NULL,1990,NULL,NULL,0,0,0),(3633,11,3,24,NULL,1991,NULL,NULL,0,0,0),(3634,11,3,24,NULL,1992,NULL,NULL,0,0,0),(3635,11,3,24,NULL,1993,NULL,NULL,0,0,0),(3636,11,3,24,NULL,1994,NULL,NULL,0,0,0),(3637,11,3,24,NULL,1995,NULL,NULL,0,0,0),(3638,11,3,24,NULL,1996,NULL,NULL,0,0,0),(3639,11,3,24,NULL,1997,NULL,NULL,0,0,0),(3640,11,3,24,NULL,1998,NULL,NULL,0,0,0),(3641,11,3,24,NULL,1999,NULL,NULL,0,0,0),(3642,11,3,25,NULL,42,NULL,NULL,0,0,0),(3643,11,3,25,NULL,43,NULL,NULL,0,0,0),(3644,11,3,25,NULL,44,NULL,NULL,0,0,0),(3645,11,3,25,NULL,45,NULL,NULL,0,0,0),(3646,11,3,25,NULL,46,NULL,NULL,0,0,0),(3647,11,3,25,NULL,47,NULL,NULL,0,0,0),(3648,11,3,26,NULL,2001,NULL,NULL,0,0,0),(3666,16,0,1,NULL,1,NULL,NULL,0,0,1),(3667,16,0,1,NULL,2,NULL,NULL,0,0,1),(3668,16,0,1,NULL,3,NULL,NULL,0,0,1),(3669,16,0,1,NULL,4,NULL,NULL,0,0,1),(3670,16,0,1,NULL,5,NULL,NULL,0,0,1),(3671,16,0,1,NULL,6,NULL,NULL,0,0,1),(3672,16,0,1,NULL,7,NULL,NULL,0,0,1),(3673,16,0,1,NULL,8,NULL,NULL,0,0,1),(3674,16,0,1,NULL,9,NULL,NULL,0,0,1),(3675,16,0,1,NULL,10,NULL,NULL,0,0,1),(3676,16,0,1,NULL,11,NULL,NULL,0,0,1),(3677,16,0,1,NULL,12,NULL,NULL,0,0,1),(3678,17,0,1,NULL,1,NULL,NULL,0,0,1),(3679,17,0,1,NULL,2,NULL,NULL,0,0,1),(3680,17,0,1,NULL,3,NULL,NULL,0,0,1),(3681,17,0,1,NULL,4,NULL,NULL,0,0,1),(3682,17,0,1,NULL,5,NULL,NULL,0,0,1),(3683,17,0,1,NULL,6,NULL,NULL,0,0,1),(3684,17,0,1,NULL,7,NULL,NULL,0,0,1),(3685,17,0,1,NULL,8,NULL,NULL,0,0,1),(3686,17,0,1,NULL,9,NULL,NULL,0,0,1),(3687,17,0,1,NULL,10,NULL,NULL,0,0,1),(3688,17,0,1,NULL,11,NULL,NULL,0,0,1),(3689,17,0,1,NULL,12,NULL,NULL,0,0,1),(3719,18,0,1,NULL,1,NULL,NULL,0,0,1),(3720,18,0,1,NULL,2,1,'{\"items\":[{\"name\":\"project_meaning\",\"subtitle\":\"项目的目的、意义及必要性\",\"tip\":\"  \",\"status\":0},{\"name\":\"extra_1453105146000\",\"subtitle\":\"demo\",\"tip\":\"请输入说明\",\"status\":0}],\"table_name\":\"项目的目的、意义及必要性\"}',0,0,1),(3721,18,0,1,NULL,3,1,'{\"items\":[{\"name\":\"project_status\",\"subtitle\":\"\",\"tip\":\"  \",\"status\":0},{\"name\":\"extra_1453105164000\",\"subtitle\":\"测试\",\"tip\":\"请输入说明\",\"status\":0}],\"table_name\":\"项目相关行业、领域国内外研究发展现状、趋势以及本单位在相关领域的工作基础\"}',0,0,1),(3722,18,0,1,NULL,4,NULL,NULL,0,0,1),(3723,18,0,1,NULL,5,1,'{\"items\":[{\"name\":\"project_content\",\"subtitle\":\"\",\"tip\":\"项目主要研发内容、关键技术及创新点，对完成项目目标和考核指标的重要性\",\"status\":0},{\"name\":\"extra_1453105279000\",\"subtitle\":\"测试\",\"tip\":\"请输入说明\",\"status\":0}],\"table_name\":\"项目研究开发内容\"}',0,0,1),(3724,18,0,1,NULL,6,1,'{\"items\":[{\"name\":\"tech_way\",\"subtitle\":\"技术方案与技术路线\",\"tip\":\"依据项目任务要求，结合国内外技术发展和本单位实际情况确定，论证前应充分分析和阐述技术方案与技术路线，对不同方案和路线加以比较和论证说明。\",\"status\":0},{\"name\":\"project_manage\",\"subtitle\":\"项目组织实施与管理措施\",\"tip\":\"项目的组织管理和协调措施应能保障项目的正常实施；应能落实项目实施所需配套条件；项目负责人应能切实履行项目管理职责；应能落实项目任务所需的研究团队和配套仪器设备、经费等条件，有完善的科技管理制度。\",\"status\":0},{\"name\":\"delegation_task\",\"subtitle\":\"项目委托任务\",\"tip\":\"需另附委托或合作协议\",\"status\":0},{\"name\":\"extra_1453105303000\",\"subtitle\":\"请输入小标题\",\"tip\":\"请输入说明\",\"status\":0}],\"table_name\":\"项目技术方案与技术路线\"}',0,0,1),(3725,18,0,1,NULL,7,NULL,NULL,0,0,1),(3726,18,0,1,NULL,8,NULL,NULL,0,0,1),(3727,18,0,1,NULL,9,1,'{\"items\":[{\"name\":\"project_risk\",\"subtitle\":\"   \",\"tip\":\"风险含市场风险、技术风险、政策风险、管理风险等，风险分析需说明有可能存在的风险。\",\"status\":0},{\"name\":\"extra_1453105329000\",\"subtitle\":\"请输入小标题\",\"tip\":\"请输入说明\",\"status\":0}],\"table_name\":\"项目实施的风险分析及规避预案\"}',0,0,1),(3728,18,0,1,NULL,10,1,'{\"items\":[{\"name\":\"project_expect\",\"subtitle\":\"预期成果形式、知识产权归测属于管理\",\"tip\":\"  \",\"status\":0},{\"name\":\"extra_1453105363000\",\"subtitle\":\"请输入小标题\",\"tip\":\"请输入说明\",\"status\":0}],\"table_name\":\"预期成果形式、知识产权归属于管理测\"}',0,0,1),(3729,18,0,1,NULL,11,1,'{\"items\":[{\"name\":\"project_effect\",\"subtitle\":\"项目完成后的经济社会效益分析及成果推广方案\",\"tip\":\"项目完成后的经济社会效益分析应与项目的目的、意义及必要性相对应。成果推广方案应明确项目成果的应用推广领域、拟采取的具体推广措施或推广计划等。\",\"status\":0},{\"name\":\"extra_1453105375000\",\"subtitle\":\"请输入小标题\",\"tip\":\"请输入说明\",\"status\":0}],\"table_name\":\"项目完成后的经济社会效益分析及成果推广方案测试\"}',0,0,1),(3730,18,0,1,NULL,12,NULL,NULL,0,0,1),(3731,19,0,1,NULL,1,NULL,NULL,0,0,1),(3732,19,0,1,NULL,2,NULL,NULL,0,0,1),(3733,19,0,1,NULL,3,NULL,NULL,0,0,1),(3734,19,0,1,NULL,4,NULL,NULL,0,0,1),(3735,19,0,1,NULL,5,NULL,NULL,0,0,1),(3736,19,0,1,NULL,6,NULL,NULL,0,0,1),(3737,19,0,1,NULL,7,NULL,NULL,0,0,1),(3738,19,0,1,NULL,8,NULL,NULL,0,0,1),(3739,19,0,1,NULL,9,NULL,NULL,0,0,1),(3740,19,0,1,NULL,10,NULL,NULL,0,0,1),(3741,19,0,1,NULL,11,NULL,NULL,0,0,1),(3742,19,0,1,NULL,12,NULL,NULL,0,0,1),(3743,20,0,1,NULL,1,NULL,NULL,0,0,1),(3744,20,0,1,NULL,2,NULL,NULL,0,0,1),(3745,20,0,1,NULL,3,NULL,NULL,0,0,1),(3746,20,0,1,NULL,4,NULL,NULL,0,0,1),(3747,20,0,1,NULL,5,NULL,NULL,0,0,1),(3748,20,0,1,NULL,6,NULL,NULL,0,0,1),(3749,20,0,1,NULL,7,NULL,NULL,0,0,1),(3750,20,0,1,NULL,8,NULL,NULL,0,0,1),(3751,20,0,1,NULL,9,NULL,NULL,0,0,1),(3752,20,0,1,NULL,10,NULL,NULL,0,0,1),(3753,20,0,1,NULL,11,NULL,NULL,0,0,1),(3754,20,0,1,NULL,12,NULL,NULL,0,0,1),(3755,21,0,1,NULL,1,NULL,NULL,0,0,1),(3756,21,0,1,NULL,2,NULL,NULL,0,0,1),(3757,21,0,1,NULL,3,NULL,NULL,0,0,1),(3758,21,0,1,NULL,4,NULL,NULL,0,0,1),(3759,21,0,1,NULL,5,NULL,NULL,0,0,1),(3760,21,0,1,NULL,6,NULL,NULL,0,0,1),(3761,21,0,1,NULL,7,NULL,NULL,0,0,1),(3762,21,0,1,NULL,8,NULL,NULL,0,0,1),(3763,21,0,1,NULL,9,NULL,NULL,0,0,1),(3764,21,0,1,NULL,10,NULL,NULL,0,0,1),(3765,21,0,1,NULL,11,NULL,NULL,0,0,1),(3766,21,0,1,NULL,12,NULL,NULL,0,0,1),(3767,23,0,1,NULL,1,NULL,NULL,0,0,1),(3768,23,0,1,NULL,2,NULL,NULL,0,0,1),(3769,23,0,1,NULL,3,NULL,NULL,0,0,1),(3770,23,0,1,NULL,4,NULL,NULL,0,0,1),(3771,23,0,1,NULL,5,NULL,NULL,0,0,1),(3772,23,0,1,NULL,6,NULL,NULL,0,0,1),(3773,23,0,1,NULL,7,NULL,NULL,0,0,1),(3774,23,0,1,NULL,8,NULL,NULL,0,0,1),(3775,23,0,1,NULL,9,NULL,NULL,0,0,1),(3776,23,0,1,NULL,10,NULL,NULL,0,0,1),(3777,23,0,1,NULL,11,NULL,NULL,0,0,1),(3778,23,0,1,NULL,12,NULL,NULL,0,0,1),(3779,24,0,1,NULL,1,NULL,NULL,0,0,1),(3780,24,0,1,NULL,2,NULL,NULL,0,0,1),(3781,24,0,1,NULL,3,NULL,NULL,0,0,1),(3782,24,0,1,NULL,4,NULL,NULL,0,0,1),(3783,24,0,1,NULL,5,NULL,NULL,0,0,1),(3784,24,0,1,NULL,6,NULL,NULL,0,0,1),(3785,24,0,1,NULL,7,NULL,NULL,0,0,1),(3786,24,0,1,NULL,8,NULL,NULL,0,0,1),(3787,24,0,1,NULL,9,NULL,NULL,0,0,1),(3788,24,0,1,NULL,10,NULL,NULL,0,0,1),(3789,24,0,1,NULL,11,NULL,NULL,0,0,1),(3790,24,0,1,NULL,12,NULL,NULL,0,0,1),(3791,25,0,1,NULL,1,NULL,NULL,0,0,1),(3792,25,0,1,NULL,2,NULL,NULL,0,0,1),(3793,25,0,1,NULL,3,NULL,NULL,0,0,1),(3794,25,0,1,NULL,4,NULL,NULL,0,0,1),(3795,25,0,1,NULL,5,NULL,NULL,0,0,1),(3796,25,0,1,NULL,6,NULL,NULL,0,0,1),(3797,25,0,1,NULL,7,NULL,NULL,0,0,1),(3798,25,0,1,NULL,8,NULL,NULL,0,0,1),(3799,25,0,1,NULL,9,NULL,NULL,0,0,1),(3800,25,0,1,NULL,10,NULL,NULL,0,0,1),(3801,25,0,1,NULL,11,NULL,NULL,0,0,1),(3802,25,0,1,NULL,12,NULL,NULL,0,0,1),(3803,26,0,1,NULL,1,NULL,NULL,0,0,1),(3804,26,0,1,NULL,2,NULL,NULL,0,0,1),(3805,26,0,1,NULL,3,NULL,NULL,0,0,1),(3806,26,0,1,NULL,4,NULL,NULL,0,0,1),(3807,26,0,1,NULL,5,NULL,NULL,0,0,1),(3808,26,0,1,NULL,6,NULL,NULL,0,0,1),(3809,26,0,1,NULL,7,NULL,NULL,0,0,1),(3810,26,0,1,NULL,8,NULL,NULL,0,0,1),(3811,26,0,1,NULL,9,NULL,NULL,0,0,1),(3812,26,0,1,NULL,10,NULL,NULL,0,0,1),(3813,26,0,1,NULL,11,NULL,NULL,0,0,1),(3814,26,0,1,NULL,12,NULL,NULL,0,0,1),(3815,27,0,1,NULL,1,NULL,NULL,0,0,1),(3816,27,0,1,NULL,2,NULL,NULL,0,0,1),(3817,27,0,1,NULL,3,NULL,NULL,0,0,1),(3818,27,0,1,NULL,4,NULL,NULL,0,0,1),(3819,27,0,1,NULL,5,NULL,NULL,0,0,1),(3820,27,0,1,NULL,6,NULL,NULL,0,0,1),(3821,27,0,1,NULL,7,NULL,NULL,0,0,1),(3822,27,0,1,NULL,8,NULL,NULL,0,0,1),(3823,27,0,1,NULL,9,NULL,NULL,0,0,1),(3824,27,0,1,NULL,10,NULL,NULL,0,0,1),(3825,27,0,1,NULL,11,NULL,NULL,0,0,1),(3826,27,0,1,NULL,12,NULL,NULL,0,0,1),(3827,28,0,1,NULL,1,NULL,NULL,0,0,1),(3828,28,0,1,NULL,2,NULL,NULL,0,0,1),(3829,28,0,1,NULL,3,NULL,NULL,0,0,1),(3830,28,0,1,NULL,4,NULL,NULL,0,0,1),(3831,28,0,1,NULL,5,NULL,NULL,0,0,1),(3832,28,0,1,NULL,6,NULL,NULL,0,0,1),(3833,28,0,1,NULL,7,NULL,NULL,0,0,1),(3834,28,0,1,NULL,8,NULL,NULL,0,0,1),(3835,28,0,1,NULL,9,NULL,NULL,0,0,1),(3836,28,0,1,NULL,10,NULL,NULL,0,0,1),(3837,28,0,1,NULL,11,NULL,NULL,0,0,1),(3838,28,0,1,NULL,12,NULL,NULL,0,0,1),(3839,29,0,1,NULL,1,NULL,NULL,0,0,1),(3840,29,0,1,NULL,2,NULL,NULL,0,0,1),(3841,29,0,1,NULL,3,NULL,NULL,0,0,1),(3842,29,0,1,NULL,4,NULL,NULL,0,0,1),(3843,29,0,1,NULL,5,NULL,NULL,0,0,1),(3844,29,0,1,NULL,6,NULL,NULL,0,0,1),(3845,29,0,1,NULL,7,NULL,NULL,0,0,1),(3846,29,0,1,NULL,8,NULL,NULL,0,0,1),(3847,29,0,1,NULL,9,NULL,NULL,0,0,1),(3848,29,0,1,NULL,10,NULL,NULL,0,0,1),(3849,29,0,1,NULL,11,NULL,NULL,0,0,1),(3850,29,0,1,NULL,12,NULL,NULL,0,0,1),(3851,30,0,1,NULL,1,NULL,NULL,0,0,1),(3852,30,0,1,NULL,2,NULL,NULL,0,0,1),(3853,30,0,1,NULL,3,NULL,NULL,0,0,1),(3854,30,0,1,NULL,4,NULL,NULL,0,0,1),(3855,30,0,1,NULL,5,NULL,NULL,0,0,1),(3856,30,0,1,NULL,6,NULL,NULL,0,0,1),(3857,30,0,1,NULL,7,NULL,NULL,0,0,1),(3858,30,0,1,NULL,8,NULL,NULL,0,0,1),(3859,30,0,1,NULL,9,NULL,NULL,0,0,1),(3860,30,0,1,NULL,10,NULL,NULL,0,0,1),(3861,30,0,1,NULL,11,NULL,NULL,0,0,1),(3862,30,0,1,NULL,12,NULL,NULL,0,0,1),(3863,31,0,1,NULL,1,NULL,NULL,0,0,1),(3864,31,0,1,NULL,2,NULL,NULL,0,0,1),(3865,31,0,1,NULL,3,NULL,NULL,0,0,1),(3866,31,0,1,NULL,4,NULL,NULL,0,0,1),(3867,31,0,1,NULL,5,NULL,NULL,0,0,1),(3868,31,0,1,NULL,6,NULL,NULL,0,0,1),(3869,31,0,1,NULL,7,NULL,NULL,0,0,1),(3870,31,0,1,NULL,8,NULL,NULL,0,0,1),(3871,31,0,1,NULL,9,NULL,NULL,0,0,1),(3872,31,0,1,NULL,10,NULL,NULL,0,0,1),(3873,31,0,1,NULL,11,NULL,NULL,0,0,1),(3874,31,0,1,NULL,12,NULL,NULL,0,0,1),(4015,32,0,2,NULL,1912,NULL,NULL,0,0,0),(4016,32,0,2,NULL,1913,NULL,NULL,0,0,0),(4017,32,0,2,NULL,1914,NULL,NULL,0,0,0),(4018,32,0,2,NULL,1915,NULL,NULL,0,0,0),(4019,12,0,19,NULL,1971,NULL,NULL,0,0,0),(4020,12,0,19,NULL,1972,NULL,NULL,0,0,0),(4021,12,0,19,NULL,1973,NULL,NULL,0,0,0),(4022,12,0,19,NULL,1974,NULL,NULL,0,0,0),(4023,12,0,19,NULL,1975,NULL,NULL,0,0,0),(4024,12,0,19,NULL,1976,NULL,NULL,0,0,0),(4025,12,0,19,NULL,1977,NULL,NULL,0,0,0),(4026,12,0,19,NULL,1978,NULL,NULL,0,0,0),(4027,12,0,19,NULL,1979,NULL,NULL,0,0,0),(4028,12,0,20,NULL,1963,NULL,NULL,0,0,0),(4029,12,0,20,NULL,1964,NULL,NULL,0,0,0),(4030,12,0,20,NULL,1965,NULL,NULL,0,0,0),(4031,12,0,20,NULL,1966,NULL,NULL,0,0,0),(4032,12,0,20,NULL,1967,NULL,NULL,0,0,0),(4033,12,0,20,NULL,1968,NULL,NULL,0,0,0),(4034,12,0,20,NULL,1969,NULL,NULL,0,0,0),(4035,12,0,20,NULL,1970,NULL,NULL,0,0,0),(4036,10,0,1,NULL,1,NULL,NULL,0,0,1),(4037,10,0,1,NULL,2,NULL,NULL,0,0,1),(4038,10,0,1,NULL,3,NULL,NULL,0,0,1),(4039,10,0,1,NULL,4,NULL,NULL,0,0,1),(4040,10,0,1,NULL,5,NULL,NULL,0,0,1),(4041,10,0,1,NULL,6,NULL,NULL,0,0,1),(4042,10,0,1,NULL,7,NULL,NULL,0,0,1),(4043,10,0,1,NULL,8,NULL,NULL,0,0,1),(4044,10,0,1,NULL,9,NULL,NULL,0,0,1),(4045,10,0,1,NULL,10,NULL,NULL,0,0,1),(4046,10,0,1,NULL,11,NULL,NULL,0,0,1),(4047,10,0,1,NULL,12,NULL,NULL,0,0,1),(4048,10,1,12,NULL,13,NULL,NULL,0,0,1),(4049,10,1,12,NULL,14,NULL,NULL,0,0,1),(4050,10,1,12,NULL,15,NULL,NULL,0,0,1),(4051,10,1,12,NULL,16,NULL,NULL,0,0,1),(4052,10,1,12,NULL,17,NULL,NULL,0,0,1),(4053,10,1,12,NULL,18,NULL,NULL,0,0,1),(4054,10,1,12,NULL,19,NULL,NULL,0,0,1),(4055,10,1,12,NULL,20,NULL,NULL,0,0,1),(4056,10,1,12,NULL,21,NULL,NULL,0,0,1),(4057,10,1,12,NULL,22,NULL,NULL,0,0,1),(4058,10,1,13,NULL,1945,NULL,NULL,0,0,0),(4059,10,1,13,NULL,1946,NULL,NULL,0,0,0),(4060,10,2,14,NULL,1948,NULL,NULL,0,0,0),(4061,10,2,15,NULL,1949,NULL,NULL,0,0,0),(4062,10,2,15,NULL,1950,NULL,NULL,0,0,0),(4063,10,2,15,NULL,1951,NULL,NULL,0,0,0),(4064,10,3,16,NULL,1952,NULL,NULL,0,0,0),(4065,10,3,16,NULL,1953,NULL,NULL,0,0,0),(4066,10,3,17,NULL,1954,NULL,NULL,0,0,0),(4067,10,3,18,NULL,1955,NULL,NULL,0,0,0),(4068,10,3,18,NULL,1956,NULL,NULL,0,0,0),(4069,10,3,18,NULL,1957,NULL,NULL,0,0,0),(4070,10,3,18,NULL,1958,NULL,NULL,0,0,0),(4071,10,3,18,NULL,1959,NULL,NULL,0,0,0),(4072,10,3,18,NULL,1960,NULL,NULL,0,0,0),(4073,10,3,18,NULL,1961,NULL,NULL,0,0,0),(4074,10,3,18,NULL,1962,NULL,NULL,0,0,0),(4075,33,0,1,NULL,1,NULL,NULL,0,0,1),(4076,33,0,1,NULL,2,NULL,NULL,0,0,1),(4077,33,0,1,NULL,3,NULL,NULL,0,0,1),(4078,33,0,1,NULL,4,NULL,NULL,0,0,1),(4079,33,0,1,NULL,5,NULL,NULL,0,-1,1),(4080,33,0,1,NULL,6,NULL,NULL,0,0,1),(4081,33,0,1,NULL,7,NULL,NULL,0,0,1),(4082,33,0,1,NULL,8,NULL,NULL,0,0,1),(4083,33,0,1,NULL,9,NULL,NULL,0,0,1),(4084,33,0,1,NULL,10,NULL,NULL,0,0,1),(4085,33,0,1,NULL,11,NULL,NULL,0,0,1),(4086,33,0,1,NULL,12,NULL,NULL,0,0,1),(4087,33,1,12,NULL,13,NULL,NULL,0,0,1),(4088,33,1,12,NULL,14,1,'{\"items\":[{\"name\":\"project_mission\",\"subtitle\":\"项目任务：\",\"tip\":\"项目任务应明确科技工作在解决实际问题中的责任和完成工作的范围、界限，即项目全部工作和成果的整体描述。\",\"status\":0},{\"name\":\"project_aim\",\"subtitle\":\"项目目标：\",\"tip\":\"项目目标内容应完整、明确，并能够考查项目完成的程度和实际效果。包括定性、定量两个部分，定性的内容应概括项目预期效果的几个方面，定量的内容应说明预期效果的程度和范围。\",\"status\":0},{\"name\":\"project_kpi\",\"subtitle\":\"考核指标：\",\"tip\":\"考核指标应体现项目目标预期完成程度和水平，以及对项目各项研究开发内容预期完成情况的考核。指标体系应系统、完整，客观可检查）  （项目目标和考核指标应能够系统、完整地表达任务完成情况，具有成果的依附形式或载体，体现实际效果，可查、可测、可看。\",\"status\":0},{\"name\":\"extra_1453110973000\",\"subtitle\":\"ceshi\",\"tip\":\"请输入说明\",\"status\":0}],\"table_name\":\"项目任务与目标、考核指标\"}',0,0,1),(4089,33,1,12,NULL,15,1,'{\"items\":[{\"name\":\"project_content\",\"subtitle\":\" \",\"tip\":\"项目主要研发内容、关键技术及创新点，对完成项目目标和考核指标的重要性）\",\"status\":0},{\"name\":\"extra_1453110986000\",\"subtitle\":\"demo\",\"tip\":\"请输入说明\",\"status\":0},{\"name\":\"extra_1453110998000\",\"subtitle\":\"请输入小标题\",\"tip\":\"请输入说明\",\"status\":0}],\"table_name\":\"项目研究开发内容\"}',0,-1,1),(4090,33,1,12,NULL,16,NULL,NULL,0,-1,1),(4091,33,1,12,NULL,17,NULL,NULL,0,0,1),(4092,33,1,12,NULL,18,NULL,NULL,0,0,1),(4093,33,1,12,NULL,19,1,'{\"items\":[{\"name\":\"project_expect\",\"subtitle\":\"\",\"tip\":\" \",\"status\":0},{\"name\":\"extra_1453111060000\",\"subtitle\":\"ces \",\"tip\":\"请输入说明\",\"status\":0}],\"table_name\":\"预期成果形式、知识产权归属于管理\"}',0,0,1),(4094,33,1,12,NULL,20,NULL,NULL,0,0,1),(4095,33,1,12,NULL,21,1,'{\"items\":[{\"name\":\"other_condition\",\"subtitle\":\"\",\"tip\":\" \",\"status\":0},{\"name\":\"extra_1453111077000\",\"subtitle\":\"请输入小标题\",\"tip\":\"请输入说明\",\"status\":0}],\"table_name\":\"其他条款\"}',0,0,1),(4096,33,1,12,NULL,22,NULL,NULL,0,-1,1),(4097,34,0,1,NULL,1,NULL,NULL,0,0,1),(4098,34,0,1,NULL,2,NULL,NULL,0,0,1),(4099,34,0,1,NULL,3,NULL,NULL,0,0,1),(4100,34,0,1,NULL,4,NULL,NULL,0,0,1),(4101,34,0,1,NULL,5,NULL,NULL,0,0,1),(4102,34,0,1,NULL,6,NULL,NULL,0,0,1),(4103,34,0,1,NULL,7,NULL,NULL,0,0,1),(4104,34,0,1,NULL,8,NULL,NULL,0,0,1),(4105,34,0,1,NULL,9,NULL,NULL,0,0,1),(4106,34,0,1,NULL,10,NULL,NULL,0,0,1),(4107,34,0,1,NULL,11,NULL,NULL,0,0,1),(4108,34,0,1,NULL,12,NULL,NULL,0,0,1),(4125,36,0,3,NULL,1916,NULL,NULL,0,0,0),(4126,36,0,3,NULL,1917,NULL,NULL,0,0,0),(4127,36,0,3,NULL,1918,NULL,NULL,0,0,0),(4128,36,1,12,NULL,13,NULL,NULL,0,0,1),(4129,36,1,12,NULL,14,1,'{\"items\":[{\"name\":\"project_mission\",\"subtitle\":\"项目任务：\",\"tip\":\"项目任务应明确科技工作在解决实际问题中的责任和完成工作的范围、界限，即项目全部工作和成果的整体描述。\",\"status\":0},{\"name\":\"project_aim\",\"subtitle\":\"项目目标：\",\"tip\":\"项目目标内容应完整、明确，并能够考查项目完成的程度和实际效果。包括定性、定量两个部分，定性的内容应概括项目预期效果的几个方面，定量的内容应说明预期效果的程度和范围。\",\"status\":-1},{\"name\":\"project_kpi\",\"subtitle\":\"考核指标：\",\"tip\":\"考核指标应体现项目目标预期完成程度和水平，以及对项目各项研究开发内容预期完成情况的考核。指标体系应系统、完整，客观可检查）  （项目目标和考核指标应能够系统、完整地表达任务完成情况，具有成果的依附形式或载体，体现实际效果，可查、可测、可看。\",\"status\":-1}],\"table_name\":\"项目任务与目标、考核指标\"}',0,0,1),(4130,36,1,12,NULL,15,NULL,NULL,0,0,1),(4131,36,1,12,NULL,16,NULL,NULL,0,0,1),(4132,36,1,12,NULL,17,NULL,NULL,0,0,1),(4133,36,1,12,NULL,18,NULL,NULL,0,0,1),(4134,36,1,12,NULL,19,NULL,NULL,0,0,1),(4135,36,1,12,NULL,20,NULL,NULL,0,0,1),(4136,36,1,12,NULL,21,NULL,NULL,0,0,1),(4137,36,1,12,NULL,22,NULL,NULL,0,0,1),(4138,36,2,14,NULL,1948,NULL,NULL,0,0,0),(4139,36,3,16,NULL,1952,NULL,NULL,0,0,0),(4140,36,3,16,NULL,1953,NULL,NULL,0,0,0);

/*Table structure for table `target_complete` */

DROP TABLE IF EXISTS `target_complete`;

CREATE TABLE `target_complete` (
  `project_id` varchar(30) default NULL,
  `year` varchar(30) default NULL,
  `income` float default NULL,
  `profit` float default NULL,
  `for_income` float default NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `target_complete` */

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

/*Table structure for table `tech_transfer` */

DROP TABLE IF EXISTS `tech_transfer`;

CREATE TABLE `tech_transfer` (
  `id` int(11) NOT NULL auto_increment,
  `project_id` varchar(30) default NULL,
  `receiver` varchar(255) default NULL,
  `company_scale` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tech_transfer` */

insert  into `tech_transfer`(`id`,`project_id`,`receiver`,`company_scale`) values (4,'dev1453097272','1','1'),(5,'dev1453097272','2','2');

/*Table structure for table `technical_contract` */

DROP TABLE IF EXISTS `technical_contract`;

CREATE TABLE `technical_contract` (
  `id` int(11) NOT NULL auto_increment,
  `org_code` varchar(11) default NULL,
  `contract_code` varchar(11) default NULL,
  `project_name` varchar(30) default NULL,
  `affirm_time` varchar(20) default NULL,
  `contract_price` double default NULL,
  `year` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `technical_contract` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
