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

insert  into `admininfo`(`id`,`department`,`user_type`,`username`,`password`,`realname`,`phone`,`email`,`qq`,`isForbidden`,`addDate`,`lastIP`,`isDel`,`ntid`,`seed`,`lastLoginTime`) values (1,0,3,'super','592d510020d3eacdc3d5c89e2e148f7467de3e82','超级管理员','13774774787','22@gmail.com','11111',0,NULL,'222.128.151.121',NULL,NULL,NULL,'2015-12-16 14:41:22'),(5,0,1,'suy','592d510020d3eacdc3d5c89e2e148f7467de3e82','苏颖','13774774787','suying@qq.com','19874568785',0,NULL,'222.128.151.121',0,NULL,NULL,'2015-12-16 14:39:34'),(6,0,1,'kangly','592d510020d3eacdc3d5c89e2e148f7467de3e82','康连元','15487895624','kanglianyuan@qq.com','7458452',0,NULL,NULL,0,NULL,NULL,NULL),(7,1,1,'gengdl','592d510020d3eacdc3d5c89e2e148f7467de3e82','耿大乐','13487784521','gengdale@qq.com','8521354',0,NULL,NULL,0,NULL,NULL,NULL),(8,1,1,'guohj','592d510020d3eacdc3d5c89e2e148f7467de3e82','郭华杰','18956532549','guohuajie@qq.com','45123354',0,NULL,NULL,0,NULL,NULL,NULL),(9,2,1,'songlj','592d510020d3eacdc3d5c89e2e148f7467de3e82','宋李杰','13654897856','songlijie@qq.com','1554895645',0,NULL,NULL,0,NULL,NULL,NULL),(10,2,1,'jinz','592d510020d3eacdc3d5c89e2e148f7467de3e82','金竹','15458956532','jinzhu@qq.com','5451345455',0,NULL,NULL,0,NULL,NULL,NULL),(11,2,1,'wangzh','592d510020d3eacdc3d5c89e2e148f7467de3e82','王振海','18745895456','wangzhenghai@qq.com','45512645312',0,NULL,NULL,0,NULL,NULL,NULL);

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

/*Table structure for table `co_construct` */

DROP TABLE IF EXISTS `co_construct`;

CREATE TABLE `co_construct` (
  `id` int(11) NOT NULL auto_increment,
  `project_id` varchar(30) default NULL,
  `partner_name` varchar(30) default NULL,
  `company_scale` varchar(30) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `co_construct` */

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
  `eqpt_name` varchar(20) default NULL,
  `eqpt_model` varchar(20) default NULL,
  `plan_money` float default NULL,
  `actual_num` int(11) default NULL,
  `actual_pay` float default NULL,
  `fund_src` varchar(50) default NULL,
  `buy_time` varchar(20) default NULL,
  `main_use` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `equipment` */

insert  into `equipment`(`id`,`project_id`,`eqpt_name`,`eqpt_model`,`plan_money`,`actual_num`,`actual_pay`,`fund_src`,`buy_time`,`main_use`) values (30,'dev1449884706','电子显微镜','ER200',40,1,40,'科技经费','2015年11月8日','微生物观察'),(31,'dev1449993371','1','1',1,11,1,'1','1','1'),(32,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(33,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(34,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(35,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(36,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(37,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(38,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(39,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(40,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(41,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(42,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(43,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(44,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(45,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(46,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(47,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(48,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(49,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(50,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(51,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(52,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(53,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(54,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(55,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);

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

insert  into `experts`(`id`,`project_id`,`expert_name`,`expert_org`,`expert_job`,`expert_major`,`expert_phone`,`expert_sign`,`expert_divide`,`expert_id`) values (20,'dev1449884706','朱俭','学校','研究生导师','计算机','15124290380','','组员','210921198907011127'),(21,'dev1449884706','朱俭','学校','研究生导师','计算机','15124290380','11','组员','210921198907011127'),(22,'dev1449884706','111','11','11','11','11','11','111','11'),(23,'dev1449884706','1','1','1','11','1','11','1','1'),(24,'dev1449884706','','','','','','','',''),(25,'dev1449884706','','','','','','','',''),(26,'dev1449884706','','','','','','','',''),(27,'dev1449993371','','','','','','','',''),(28,'dev1450227541','1','1','1','1','1','1','1','1'),(29,'dev1450227541','1','1','1','1','1','1','1','1'),(30,'dev1450227541','1','1','1','1','1','1','1','1'),(31,'dev1450227541','1','1','1','1','1','1','1','1');

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
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `fund_src` */

insert  into `fund_src`(`the_year`,`id`,`project_id`,`bgt_fund`,`reduce_fund`,`fund_total`,`actual_fund`,`src_type`) values (NULL,14,'dev1449884706','655_55_6666','66_44_44',NULL,'589_11_6622',NULL),(NULL,15,'dev1449993371','1_11_1','1_11_1',NULL,'0_0_0',NULL),(NULL,16,'Array','6_3_','Array',NULL,'4_1_1',NULL);

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

insert  into `legal_person`(`id`,`org_code`,`legal_code`,`legal_name`,`legal_sex`,`legal_edu`,`legal_birth`,`legal_time`,`legal_phone`,`legal_id`) values (40,'123456',NULL,'杨松',1,NULL,NULL,NULL,NULL,NULL),(41,'121301',NULL,'西蒙',1,NULL,NULL,NULL,NULL,NULL),(42,'001',NULL,'黎明',1,NULL,NULL,NULL,NULL,NULL),(43,'123',NULL,'马闯',1,NULL,NULL,NULL,NULL,NULL),(44,'mac_test1',NULL,'http://210.76.97.226',1,NULL,NULL,NULL,NULL,NULL),(45,'',NULL,'',1,NULL,NULL,NULL,NULL,NULL);

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

insert  into `login_info`(`id`,`username`,`password`,`org_code`,`isForbidden`,`lastIP`,`addDate`,`user_type`,`department`,`realname`,`address`,`phone`,`email`) values (39,'zhengyy','592d510020d3eacdc3d5c89e2e148f7467de3e82','123456',0,NULL,NULL,0,NULL,'郑艳艳','','15124290380','986412145@qq.com'),(40,'majw','592d510020d3eacdc3d5c89e2e148f7467de3e82',NULL,1,NULL,NULL,-1,NULL,NULL,NULL,NULL,NULL),(41,'fred','eadb034df421eca651dd5daf60c7072fe8f48a14','121301',0,NULL,NULL,0,NULL,'fred','','15144428869','15599445@qq.com'),(42,'tom','22e398107c38da4c5ee79ec7864190e27af3447f','001',0,NULL,NULL,0,NULL,'黎明','','1823255266','111@qq.com'),(43,'ma','187005ecfcbc95b9698b79763e19b24e28fbfd48','123',0,NULL,NULL,0,NULL,'1','','1','123@1.com'),(44,'machuang','592d510020d3eacdc3d5c89e2e148f7467de3e82','mac_test1',0,NULL,NULL,0,NULL,'ma','','123','1@1.com'),(45,'aa','eadb034df421eca651dd5daf60c7072fe8f48a14','saa',0,NULL,NULL,0,NULL,'aaa','','aaa','aaaaaaa@qq.com'),(46,'1256','eadb034df421eca651dd5daf60c7072fe8f48a14','aa',0,NULL,NULL,0,NULL,'152634','','15632','1137188325@qq.com'),(47,'zhujian','592d510020d3eacdc3d5c89e2e148f7467de3e82','11',0,NULL,NULL,0,NULL,'123','','123','aa@bb.cc'),(48,'demo','592d510020d3eacdc3d5c89e2e148f7467de3e82','111111',0,NULL,NULL,0,NULL,'zyy','','15124290380','9864132145@qq.com'),(49,'wangyi','7b067d6ae98889177af2e180b4fb4bfd46f37356','005',0,NULL,NULL,0,NULL,'王一','','1234455','wangyi@qq.com');

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

insert  into `org_info`(`id`,`org_code`,`org_name`,`relationship`,`legal_person`,`org_type`,`org_address`,`register_town`,`register_time`,`postal`,`fax`,`email`,`certi_code`,`develop_area`,`org_leader`,`leader_contact`,`dev_leader`,`dev_contact`,`finance_leader`,`finance_contact`,`linkman`,`linkman_contact`,`ratification_num`,`username`,`org_bank`,`account`,`leader_org`,`phone`,`coorg_code`,`register_fund`,`contact_address`,`register_address`,`linkman_email`,`org_trade`,`local_foreign`,`research_content`,`investment`,`service_type`,`website`,`asset_total`,`listed`,`listed_code`,`main_product`,`credit_rate`,`feature`,`company_summary`,`last_contractNum`,`last_contractPrice`,`predict_contractNum`,`predict_contractPrice`,`predict_servicePrice`,`hatch_type`) values (54,'123456','北京千松科技发展有限公司','科委','杨松','私营','通州区玉带河东街','通州中仓街道办事处','','郑艳艳','66551583','986412145@qq.com','QS12345620151120F','通州','欧阳艳艳','15124290380','李志晓','15124290380','李丽丽','010-60538850','杨松','15124290380','kw20007-1100F',NULL,NULL,NULL,NULL,'010-66157731',NULL,NULL,'北京通州区',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(55,'121301','北京千机变花都有限公司','上下','西蒙','私企','北京市通州区','玉河街道','2015-12-10','100000','010-1255522','155785666@qq.com','22541-dd-01','国贸','西蒙','15114428766','苏珊','15144222889','爱德华','15155549986','西蒙','15145889666','151213pz-001',NULL,NULL,NULL,NULL,'15542225558',NULL,NULL,'北京市通州区',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(56,'001','北京华尔街公司','子公司','黎明','私有','邯郸','邯郸001','注册时间','邯郸','邯郸单位传真','12524beijing@qq.com','邯郸高新证书号','邯郸所在高技术开发区','邯郸单位负责人','邯郸单位负责人联系方式','邯郸单位科技管理部门负责人','邯郸单位科技管理部门负责人联系方式','邯郸财务负责人','邯郸财务负责人联系方式','一名','12525525233','邯郸',NULL,NULL,NULL,NULL,'183033625',NULL,NULL,'中关村',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(57,'123','123','1','马闯','1','1','1','2015-12-08','1','1','123@11.com','1','1','1','123456789','1','121313131','1','14111111111','15350598259','15350598259','1',NULL,NULL,NULL,NULL,'15350598259',NULL,NULL,'15350598259',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(58,'mac_test1','http://210.76.97.226:8080/webs',NULL,'http://210.76.97.226:8080/webs',NULL,NULL,NULL,NULL,NULL,NULL,'/@1.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://210.76.97.226','http://210.76.97.226',NULL,NULL,NULL,NULL,NULL,'http://210.76.97.226',NULL,NULL,'http://210.76.97.226:8080/website/html/view/templa',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(59,'','1',NULL,'',NULL,'1',NULL,NULL,NULL,'1','111@qq.vvv',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','',NULL,NULL,NULL,NULL,NULL,'1',NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(60,'saa','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(61,'aa','','FFRCRGDHDGB','','FFFFF','zz','FFFFF','','zzzzz','dfrgrgr','','rgr','dd','FGBDFBF','fffffff','ffffff','ffffff','dd','','','','ffff',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(62,'11','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(63,'111111','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(64,'005','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);

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

/*Table structure for table `pro_check_pri_map` */

DROP TABLE IF EXISTS `pro_check_pri_map`;

CREATE TABLE `pro_check_pri_map` (
  `id` int(11) NOT NULL auto_increment,
  `admin_info_id` int(11) NOT NULL,
  `project_type_id` int(11) NOT NULL,
  `admin_info_lend_id` int(11) NOT NULL,
  `project_type_para_id` tinyint(4) NOT NULL default '0',
  `status` int(2) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `pro_check_pri_map` */

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
  `main_product` varchar(20) default NULL,/*这个字段在word文件是删除的*/
  `sale_ratio` float default NULL,  /*这个字段在word文件是删除的*/
  `predict_income` float default NULL,
  `predict_tax` float default NULL,
  `predict_profit` float default NULL,
  `lasthalf_income` float default NULL,
  `lasthalf_tax` float default NULL,
  `lasthalf_profit` float default NULL,
  `predict_inspectax` float default NULL,/*word文件中还有一个year字段，表示当前年份，类型为int*/
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `profit_tax` */

/*Table structure for table `project_ann_plan` */

DROP TABLE IF EXISTS `project_ann_plan`;

CREATE TABLE `project_ann_plan` (
  `id` int(11) NOT NULL auto_increment,
  `project_id` varchar(20) default NULL,
  `plan_year` varchar(10) default NULL,
  `plan_content` varchar(200) default NULL,
  `task_plan_year` varchar(10) default NULL,
  `task_plan_content` varchar(100) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `project_ann_plan` */

insert  into `project_ann_plan`(`id`,`project_id`,`plan_year`,`plan_content`,`task_plan_year`,`task_plan_content`) values (73,'dev1449884706','2014','2.	设计思路\r\n通州区科委在线申报及科技项目查新平台设计思路应是：围绕申报管理办法，以方便科委内部申报管理工作，增进工作效率为核心，以方便申报单位的数据报送为主要目的；经济实用、快速见效；以需求为导向、以应用促发展；数据交换、资源共享。\r\n对于系统的设计必须要与申报管理实施办法相适应，所有对于系统的设计必须以申报管理办法为最高原则，在此基础上充分考虑系统的可扩展性。\r\n1.	以方便科委内部的管理',NULL,NULL),(74,'dev1449884706','2015','2.	设计思路\r\n通州区科委在线申报及科技项目查新平台设计思路应是：围绕申报管理办法，以方便科委内部申报管理工作，增进工作效率为核心，以方便申报单位的数据报送为主要目的；经济实用、快速见效；以需求为导向、以应用促发展；数据交换、资源共享。\r\n对于系统的设计必须要与申报管理实施办法相适应，所有对于系统的设计必须以申报管理办法为最高原则，在此基础上充分考虑系统的可扩展性。\r\n1.	以方便科委内部的管理',NULL,NULL),(75,'dev1449884706','2016','2.	设计思路\r\n通州区科委在线申报及科技项目查新平台设计思路应是：围绕申报管理办法，以方便科委内部申报管理工作，增进工作效率为核心，以方便申报单位的数据报送为主要目的；经济实用、快速见效；以需求为导向、以应用促发展；数据交换、资源共享。\r\n对于系统的设计必须要与申报管理实施办法相适应，所有对于系统的设计必须以申报管理办法为最高原则，在此基础上充分考虑系统的可扩展性。\r\n1.	以方便科委内部的管理',NULL,NULL),(76,'dev1449990507','2013','2013年目标',NULL,NULL),(77,'dev1449990507','2014','2014年目标',NULL,NULL),(78,'dev1449990507','2015','2015年目标',NULL,NULL),(82,'dev1449993220','2001','项目各年度任务目标、考核指标及研究开发内容完成的计划进度',NULL,NULL),(83,'dev1449993220','2002','项目各年度任务目标、考核指标及研究开发内容完成的计划进度',NULL,NULL),(84,'dev1449993220','2003','项目各年度任务目标、考核指标及研究开发内容完成的计划进度',NULL,NULL),(85,'dev1449993371','1','1',NULL,NULL),(86,'dev1449993371','1','11',NULL,NULL),(87,'dev1449993371','1','1',NULL,NULL),(88,'dev1450227229','2012','fv  ',NULL,NULL),(89,'dev1450227229','2199','ff ',NULL,NULL),(90,'dev1450227229','2344','发愤忘食',NULL,NULL),(91,'dev1450227541','2011','奥',NULL,NULL),(92,'dev1450227541','2012','好',NULL,NULL),(93,'dev1450227541','2013','好',NULL,NULL);

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

insert  into `project_fund_tech`(`tech_total`,`the_year`,`id`,`budget_fund`,`reduce_fund`,`adjust_fund`,`actual_fund`,`project_id`,`subject`) values (NULL,NULL,14,'111_1_1_1_1_1_1_1_1_1_1','55_2_2_2_2_2_22_2_2_2_2','55_0_0_0_0_0_0_0_0_0_0','122_-887_-1_-1_-1_-1_-1_-1_-1_-1_-1','dev1449884706',NULL),(NULL,NULL,15,'1_1_1_11_1_1_11_11_111_1_1','1_1_1_1_1_1_1_1_1_1_1','1_1_1_1_1_1_1_1_1_1_11','1_1_1_11_1_1_11_1_111_1_11','dev1449993371',NULL),(NULL,NULL,16,'1_1_1_1_1_1_1_1_1_1_1','1_1_1_1_1_1_1_1_1_1_1','1_1_1_1_1_1_1_1_1_1_1','1_1_1_1_1_1_1_1_1_1_1','Array',NULL);

/*Table structure for table `project_info` */

DROP TABLE IF EXISTS `project_info`;

CREATE TABLE `project_info` (
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
  `project_content` varchar(500) default NULL,
  `tech_way` varchar(500) default NULL,
  `project_manage` varchar(500) default NULL,
  `delegation_task` varchar(200) default NULL,
  `project_risk` varchar(200) default NULL,
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
  `is_save` int(2) default '0',
  `task_project_mission` varchar(100) default NULL,
  `task_project_aim` varchar(100) default NULL,
  `task_project_kpi` varchar(100) default NULL,
  `task_project_content` varchar(100) default NULL,
  `task_tech_way` varchar(100) default NULL,
  `task_project_manage` varchar(100) default NULL,
  `task_delegation_task` varchar(100) default NULL,
  `task_project_expect` varchar(100) default NULL,
  PRIMARY KEY  (`id`,`create_time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `project_info` */

insert  into `project_info`(`others_material`,`id`,`project_id`,`principal_id`,`undertake_id`,`cooperate_id`,`project_meaning`,`project_mission`,`project_aim`,`project_kpi`,`project_content`,`tech_way`,`project_manage`,`delegation_task`,`project_risk`,`project_expect`,`project_effect`,`leader_opinion`,`expert_opinion`,`org_opinion`,`office_opinion`,`head_opinion`,`director_opinion`,`project_status`,`project_type`,`project_step`,`other_condition`,`business_id`,`ispass`,`leader_name`,`leader_sex`,`leader_birth`,`leader_ID`,`leader_edu`,`leader_major`,`leader_phone`,`leader_address`,`leader_fax`,`leader_email`,`leader_achieve`,`leader_job`,`tech_pos`,`leader_postal`,`leader_tele`,`org_code`,`project_name`,`project_match`,`project_start`,`project_end`,`project_stage`,`project_condition`,`department`,`project_engineer`,`project_place`,`tech_area`,`project_advantage`,`tech_level`,`project_fund`,`support_fund`,`support_way`,`allocate_time`,`property_name`,`coproject_summary`,`tech_achieve`,`social_benefit`,`planfinish_time`,`coorg`,`project_main`,`start_end`,`project_summary`,`user_id`,`stage_process`,`file_path`,`project_money`,`project_argtime`,`isDelete`,`create_time`,`is_save`,`task_project_mission`,`task_project_aim`,`task_project_kpi`,`task_project_content`,`task_tech_way`,`task_project_manage`,`task_delegation_task`,`task_project_expect`) values (NULL,1730,'dev1449863579',NULL,NULL,NULL,'“十二五”时期是科技改革发展具有里程碑意义的重要时期，党的十八大提出实施创新驱动发展战略，党中央、国务院以及市委、市政府先后召开了科技创新大会，科技在党和国家工作全局中的战略地位进一步提升。习近平总书记在视察北京重要讲话中明确了北京作为全国科技创新中心的新定位。区委、区政府制订出台《关于实施创新驱动发展战略 加快北京城市副中心建设的意见》，对今后我区科技创新工作作出全面部署。\r\n为了加快落实区政府颁布的《关于通州区支持科技创新暂行办法》，强化科技创新对经济、社会、文化、生态建设和发展的支撑引领作用，为了提高科技创新相关项目、资金的申报效率，为了避免因项目重复申报导致科技资源与经费的不合理配置甚至滋生腐败，为了提高科委本身的网络办公效率，通州区科委本着“强化科技流程管理，加强项目重复立项审查，实施有效监督”的原则提出开发“项目在线申报及查新平台”。\r\n',NULL,NULL,NULL,NULL,'三层体系结构包括表示层(Presentation)、功能层(Business Logic)、数据层（Data Service）。这种模式在逻辑上将应用功能分为三层：表示层（用户界面层）、功能层（业务逻辑层）、数据层。用户界面层是为客户提供应用服务的图形界面，有助于用户理解和高效的定位应用服务。业务逻辑层位于表示层和数据层之间，专门为实现业务逻辑提供了一个明确的层次，在这个层次封装了与系统关联的应用模型，并把用户表示层和数据库代码分开。这个层次提供用户界面层和数据服务之间的联系，主要功能是执行应用策略和封装应用模式，并将封装的模式呈现给客户应用程序。数据层是三层模式中最底层，他用来定义、维护、访问和更新数据并管理和满足应用服务对数据的请求。\r\n表示层（用户界面层）\r\n在表示层，用户可以通过浏览器向服务器发出请求。Browser/Server结构极大的简化了客户机的工作，客户端不需要安装、配置，直接通过操作系统自带的浏览器浏览、访问即可，服务器将担负更多的工作，对数据库的访问和应用程序的执行将在应用服务器上完成。\r\n在表示层中包含系统的显示逻辑，位于客户端。它的任务是由Web浏览器向Web','','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'123456','申报项目',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'电子信息',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,39,'0,1,2,3',NULL,'',NULL,0,'1449863579',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,1731,'dev1449884706',NULL,NULL,NULL,'“十二五”时期是科技改革发展具有里程碑意义的重要时期，党的十八大提出实施创新驱动发展战略，党中央、国务院以及市委、市政府先后召开了科技创新大会，科技在党和国家工作全局中的战略地位进一步提升。习近平总书记在视察北京重要讲话中明确了北京作为全国科技创新中心的新定位。区委、区政府制订出台《关于实施创新驱动发展战略 加快北京城市副中心建设的意见》，对今后我区科技创新工作作出全面部署。\r\n为了加快落实区政府颁布的《关于通州区支持科技创新暂行办法》，强化科技创新对经济、社会、文化、生态建','根据对通州区科委在线申报及科技项目查新平台需求可知，设计本系统时需遵循以下原则：\r\n1、扩展性\r\n对于增加新功能或者进行功能增强时，系统是否可以很好的支持？评判的标准就是新增或者增强功能所需的资源对原有系统的影响大小，如果需要很多的资源并且对原有系统会有负面影响导致部分功能需要修改时，扩展性就不算好。为此，本系统从以下几个方面实现扩展性：\r\n（1）标准的开发接口\r\n系统提供标准的开发接口及其详细的说明文档。\r\n（2）	系统需求分析\r\n','根据对通州区科委在线申报及科技项目查新平台需求可知，设计本系统时需遵循以下原则：\r\n1、扩展性\r\n对于增加新功能或者进行功能增强时，系统是否可以很好的支持？评判的标准就是新增或者增强功能所需的资源对原有系统的影响大小，如果需要很多的资源并且对原有系统会有负面影响导致部分功能需要修改时，扩展性就不算好。为此，本系统从以下几个方面实现扩展性：\r\n（1）标准的开发接口\r\n系统提供标准的开发接口及其详细的','根据对通州区科委在线申报及科技项目查新平台需求可知，设计本系统时需遵循以下原则：\r\n1、扩展性\r\n对于增加新功能或者进行功能增强时，系统是否可以很好的支持？评判的标准就是新增或者增强功能所需的资源对原有系统的影响大小，如果需要很多的资源并且对原有系统会有负面影响导致部分功能需要修改时，扩展性就不算好。为此，本系统从以下几个方面实现扩展性：\r\n（1）标准的开发接口\r\n系统提供标准的开发接口及其详细的','2.	设计思路\r\n通州区科委在线申报及科技项目查新平台设计思路应是：围绕申报管理办法，以方便科委内部申报管理工作，增进工作效率为核心，以方便申报单位的数据报送为主要目的；经济实用、快速见效；以需求为导向、以应用促发展；数据交换、资源共享。\r\n对于系统的设计必须要与申报管理实施办法相适应，所有对于系统的设计必须以申报管理办法为最高原则，在此基础上充分考虑系统的可扩展性。\r\n1.	以方便科委内部的管理工作，增进工作效率为核心\r\n通州区科委作为通州区科技创新相关申报的管理单位，其工作效率及管理能力的的高度将直接对申报的实施产生直接的影响，内网申报管理平台作为通州区科委科技创新相关申报的管理工具，必须以方便科委内部的管理工作，','2.	设计思路\r\n通州区科委在线申报及科技项目查新平台设计思路应是：围绕申报管理办法，以方便科委内部申报管理工作，增进工作效率为核心，以方便申报单位的数据报送为主要目的；经济实用、快速见效；以需求为导向、以应用促发展；数据交换、资源共享。\r\n对于系统的设计必须要与申报管理实施办法相适应，所有对于系统的设计必须以申报管理办法为最高原则，在此基础上充分考虑系统的可扩展性。\r\n1.	以方便科委内部的管理工作，增进工作效率为核心\r\n通州区科委作为通州区科技创新相关申报的管理单位，其工作效率及管理能力的的高度将直接对申报的实施产生直接的影响，内网申报管理平台作为通州区科委科技创新相关申报的管理工具，必须以方便科委内部的管理工作，','2.	设计思路\r\n通州区科委在线申报及科技项目查新平台设计思路应是：围绕申报管理办法，以方便科委内部申报管理工作，增进工作效率为核心，以方便申报单位的数据报送为主要目的；经济实用、快速见效；以需求为导向、以应用促发展；数据交换、资源共享。\r\n对于系统的设计必须要与申报管理实施办法相适应，所有对于系统的设计必须以申报管理办法为最高原则，在此基础上充分考虑系统的可扩展性。\r\n1.	以方便科委内部的管理工作，增进工作效率为核心\r\n通州区科委作为通州区科技创新相关申报的管理单位，其工作效率及管理能力的的高度将直接对申报的实施产生直接的影响，内网申报管理平台作为通州区科委科技创新相关申报的管理工具，必须以方便科委内部的管理工作，','2.	设计思路\r\n通州区科委在线申报及科技项目查新平台设计思路应是：围绕申报管理办法，以方便科委内部申报管理工作，增进工作效率为核心，以方便申报单位的数据报送为主要目的；经济实用、快速见效；以需求为导向、以应用促发展；数据交换、资源共享。\r\n对于系统的设计必须要与申报管理实施办法相适应，所有对于系统的设计必须以申报管理办法为最高原则，在此基础上充分考虑系统的可扩展性。\r\n1.	以方便科委内部的管理','2.	设计思路\r\n通州区科委在线申报及科技项目查新平台设计思路应是：围绕申报管理办法，以方便科委内部申报管理工作，增进工作效率为核心，以方便申报单位的数据报送为主要目的；经济实用、快速见效；以需求为导向、以应用促发展；数据交换、资源共享。\r\n对于系统的设计必须要与申报管理实施办法相适应，所有对于系统的设计必须以申报管理办法为最高原则，在此基础上充分考虑系统的可扩展性。\r\n1.	以方便科委内部的管理','2.	设计思路\r\n通州区科委在线申报及科技项目查新平台设计思路应是：围绕申报管理办法，以方便科委内部申报管理工作，增进工作效率为核心，以方便申报单位的数据报送为主要目的；经济实用、快速见效；以需求为导向、以应用促发展；数据交换、资源共享。\r\n对于系统的设计必须要与申报管理实施办法相适应，所有对于系统的设计必须以申报管理办法为最高原则，在此基础上充分考虑系统的可扩展性。\r\n1.	以方便科委内部的管理','2.	设计思路\r\n通州区科委在线申报及科技项目查新平台设计思路应是：围绕申报管理办法，以方便科委内部申报管理工作，增进工作效率为核心，以方便申报单位的数据报送为主要目的；经济实用、快速见效；以需求为导向、以应用促发展；数据交换、资源共享。\r\n对于系统的设计必须要与申报管理实施办法相适应，所有对于系统的设计必须以申报管理办法为最高原则，在此基础上充分考虑系统的可扩展性。\r\n1.	以方便科委内部的管理',NULL,NULL,NULL,NULL,NULL,NULL,'根据对通州区科委在线申报及科技项目查新平台需求可知，设计本系统时需遵循以下原则：\r\n1、扩展性\r\n对于增加新功能或者进行功能增强时，系统是否可以很好的支持？评判的标准就是新增或者增强功能所需的资源对原有系统的影响大小，如果需要很多的资源并且对原有系统会有负面影响导致部分功能需要修改时，扩展性就不算好。为此，本系统从以下几个方面实现扩展性：\r\n（1）标准的开发接口\r\n系统提供标准的开发接口及其详细的','自主研发项目',NULL,NULL,'KJ2015CX001',0,'郑艳艳','男','00:00:00','21092119890701','本科','开发','15124290380','西直门','010-66157731','986412145@qq.com','无','产品经理','无','101100','15124290380','123456','申报系统项目',NULL,NULL,NULL,3,1,'发展计划科','',NULL,'电子信息',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,39,'0,1,2,3',NULL,'',NULL,0,'1449884706',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,1732,'',NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'','','00:00:00','','','','','','','','','','','','','',NULL,NULL,NULL,NULL,0,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,0,'',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,1733,'',NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'','','00:00:00','','','','','','','','','','','','','',NULL,NULL,NULL,NULL,0,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,0,'',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,1734,'dev1449893738',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'产学研合作项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'d','项目',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'电子信息',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,39,'0,1,2,3',NULL,'',NULL,0,'1449893738',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,1735,'com1449893794',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'技术合同登记奖励',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'d','项目2',NULL,NULL,NULL,0,1,'科技综合科','',NULL,'电子信息',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,39,'0',NULL,'',NULL,0,'1449893794',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,1736,'dev1449976336',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,'KJ2015CX002',0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'123456','demo',NULL,NULL,NULL,3,1,'发展计划科','',NULL,'电子信息',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,39,'0,1,2,3',NULL,'',NULL,0,'1449976336',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,1737,'dev1449976944',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'123456','test',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'电子信息',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,39,'0,1,2,3',NULL,'',NULL,0,'1449976944',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,1738,'dev1449990507',NULL,NULL,NULL,'目的与意义和必要性','项目任务','项目目标','考核指标','项目内容','技术方案路线','管理措施','项目委托',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'相关行业的工作基础','自主研发项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'121301','花都大战',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'其他',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,41,'0,1,2,3',NULL,'',NULL,0,'1449990507',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,1739,'dev1449993220',NULL,NULL,NULL,'项目的目的、意义及必要性','项目任务与目标、考核指标\r\n\r\n1、项目任务：（项目任务应明确科技工作在解决实际问题中的责任和完成工作的范围、界限，即项目全部工作和成果的整体描述。）\r\n','、项目目标：（项目目标内容应完整、明确，并能够考查项目完成的程度和实际效果。包括定性、定量两个部分，定性的内容应概括项目预期效果的几个方面，定量的内容应说明预期效果的程度和范围。）\r\n','3、考核指标：（考核指标应体现项目目标预期完成程度和水平，以及对项目各项研究开发内容预期完成情况的考核。指标体系应系统、完整，客观可检查） （项目目标和考核指标应能够系统、完整地表达任务完成情况，具有成果的依附形式或载体，体现实际效果，可查、可测、可看。）\r\n','项目研究开发内容\r\n\r\n（项目主要研发内容、关键技术及创新点，对完成项目目标和考核指标的重要性）','项目技术方案与技术路线\r\n\r\n1、技术方案与技术路线\r\n（依据项目任务要求，结合国内外技术发展和本单位实际情况确定，论证前应充分分析和阐述技术方案与技术路线，对不同方案和路线加以比较和论证说明。）\r\n','2、项目组织实施与管理措施\r\n（项目的组织管理和协调措施应能保障项目的正常实施；应能落实项目实施所需配套条件；项目负责人应能切实履行项目管理职责；应能落实项目任务所需的研究团队和配套仪器设备、经费等条件，有完善的科技管理制度。）\r\n','3、项目委托任务（需另附委托或合作协议）\r\n（如有委托研究的任务，受托单位确保委托任务完成的措施；如有多家单位承担项目任务，阐明项目的任务分工及相应的目标和考核指标。）\r\n','（风险含市场风险、技术风险、政策风险、管理风险等，风险分析需说明有可能存在的风险。）\r\n','预期成果形式、知识产权归属于管理','（项目完成后的经济社会效益分析应与项目的目的、意义及必要性相对应。成果推广方案应明确项目成果的应用推广领域、拟采取的具体推广措施或推广计划等）',NULL,NULL,'项目承担单位\r\n意见',NULL,NULL,NULL,'项目相关行业、领域国内外研究发展现状、趋势以及本单位在相关领域的工作基础','自主研发项目',NULL,'其他条款','KJ2015CX003',0,'1','1','00:00:01','1','1','1','1','1','1','1','1','1','1','1','1','001','自主研发项目001',NULL,NULL,NULL,3,1,'发展计划科','',NULL,'环境保护',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,42,'0,1,2,3',NULL,'',NULL,0,'1449993221',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,1740,'dev1449993371',NULL,NULL,NULL,'111','1111','1111','11111','1111','111','111','111','1111','111','111',NULL,'tttt','1',NULL,NULL,NULL,'1111','自主研发项目',NULL,'hhhh','KJ2015CX004',0,'1','男','00:00:01','1','1','1','1','1','1','1','11','1','1','1','1','123','tttttttttttttttttttttttttttttttt',NULL,NULL,NULL,3,1,'发展计划科','',NULL,'生物医药',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,43,'0,1,2,3',NULL,'',NULL,0,'1449993371',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,1741,'dev1449993626',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'123','ff',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'生物医药',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,43,'0,1,2,3',NULL,'',NULL,0,'1449993626',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,1742,'dev1449995843',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'001','天天天天天',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'电子信息',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,42,'0,1,2,3',NULL,'',NULL,0,'1449995858',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,1743,'dev1449995930',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,'KJ2015CX005',0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'123','jm ',NULL,NULL,NULL,1,1,'发展计划科','',NULL,'生物医药',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,43,'0,1,2,3',NULL,'',NULL,0,'1449995930',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,1744,'',NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'','','00:00:00','','','','','','','','','','','','','',NULL,NULL,NULL,NULL,0,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,0,'',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,1745,'dev1449998670',NULL,NULL,NULL,'sddddddddsdsdsdsdsdsd',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ddddd',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,NULL,0,'q','男','00:00:01','wqw','q','q','q','q','qq','qqqq','jjj kkkuuutrrrrrrrffcdxbhfhyjykuujqqqqqqqq','q','q','q','qqq','mac_test1','ma',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,44,'0,1,2,3',NULL,'',NULL,0,'1449998671',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,1746,'dev1449999720',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'mac_test1','hgghgh',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'生物医药',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,44,'0,1,2,3',NULL,'',NULL,0,'1449999720',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,1747,'dev1450000263',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'科技成果转化项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'123456','科技成果转化项目',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'生物医药',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,39,'0,1,2,3',NULL,'',NULL,0,'1450000263',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,1748,'dev1450005381',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'科技成果转化项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'001','成果转化项目-----000001',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'新材料',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,42,'0,1,2,3',NULL,'',NULL,0,'1450005381',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,1749,'dev1450005855',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'支持承担市级以上的科技项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'001','支持承担市级以上-00009',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'新材料',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,42,'0,1,2,3',NULL,'',NULL,0,'1450005855',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,1750,'dev1450006957',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'产学研合作项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'001','黎明笨猪',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'新材料',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,42,'0,1,2,3',NULL,'',NULL,0,'1450006957',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,1751,'com1450007092',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'支持初创期科技企业孵化器、大学科技园发展项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'001','999猪猪',NULL,NULL,NULL,0,1,'科技综合科','',NULL,'能源与节能',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,42,'0',NULL,'',NULL,0,'1450007092',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,1752,'com1450007239',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'支持技术转移',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'001','支持技术转移----黎明是猪',NULL,NULL,NULL,0,1,'科技综合科','',NULL,'电子信息',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,42,'0',NULL,'',NULL,0,'1450007239',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,1753,'dev1450056126',NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'s',NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,'KJ2015CX006',0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'aa','01',NULL,NULL,NULL,1,1,'发展计划科','',NULL,'电子信息',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,46,'0,1,2,3',NULL,'',NULL,0,'1450056126',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,1754,'dev1450070504',NULL,NULL,NULL,'5',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'f','是',NULL,NULL,NULL,NULL,NULL,NULL,'的','支持承担市级以上的科技项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'123','大主宰',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'电子信息',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,43,'0,1,2,3',NULL,'',NULL,0,'1450070504',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,1755,'dev1450149540',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,'KJ2015CX007',0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'123456','测试',NULL,NULL,NULL,1,1,'发展计划科','',NULL,'电子信息',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,39,'0,1,2,3',NULL,'',NULL,0,'1450149541',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,1756,'dev1450149860',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'123456','测试',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'生物医药',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,39,'0,1,2,3',NULL,'',NULL,0,'1450149861',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,1757,'dev1450149860',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'123456','测试',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'生物医药',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,39,'0,1,2,3',NULL,'',NULL,0,'1450149861',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,1758,'dev1450150582',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'111111','测试',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'生物医药',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,48,'0,1,2,3',NULL,'',NULL,0,'1450150583',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,1759,'dev1450161606',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,'KJ2015CX008',0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'aa','02',NULL,NULL,NULL,1,1,'发展计划科','',NULL,'电子信息',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,46,'0,1,2,3',NULL,'',NULL,0,'1450161607',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,1760,'dev1450161916',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,'KJ2015CX010',0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'aa','03',NULL,NULL,NULL,1,1,'发展计划科','',NULL,'电子信息',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'0,1,2,3',NULL,'',NULL,0,'1450161917',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,1761,'dev1450167318',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'自主研发项目',NULL,NULL,'KJ2015CX009',0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'aa','03',NULL,NULL,NULL,1,1,'发展计划科','',NULL,'电子信息',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,46,'0,1,2,3',NULL,'',NULL,0,'1450167319',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,1762,'dev1450168576',NULL,NULL,NULL,'dd','ss','s','s','dd','d','d','d',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'d','自主研发项目',NULL,NULL,'KJ2015CX011',0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'aa','04',NULL,NULL,NULL,1,1,'发展计划科','',NULL,'电子信息',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,46,'0,1,2,3',NULL,'',NULL,0,'1450168576',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,1763,'dev1450227229',NULL,NULL,NULL,'吞吞吐吐','凑尺寸','谢谢','想','是是是','擦擦擦','擦擦擦','擦擦擦','jjj ','jkj','vvvvv',NULL,NULL,'1',NULL,NULL,NULL,'哈哈哈哈哈','自主研发项目',NULL,NULL,'KJ2015CX013',0,'1','女','00:00:01','1','1','1','1','1','1','1','111','1','1','1','1','123','自主研发项目12/16',NULL,NULL,NULL,1,1,'发展计划科','',NULL,'生物医药',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,43,'0,1,2,3',NULL,'',NULL,0,'1450227229',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,1764,'dev1450227541',NULL,NULL,NULL,'好','好','好','好','好','好','好','好 ','好','好','好',NULL,'好好好','好',NULL,NULL,NULL,'好','自主研发项目',NULL,'好','KJ2015CX012',0,'11','男','00:00:11','11','11','11','11','11','11','11','11','11','11','11','11','123','自主研发',NULL,NULL,NULL,1,1,'发展计划科','',NULL,'生物医药',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,43,'0,1,2,3',NULL,'',NULL,0,'1450227542',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,1765,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,0,'',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,1766,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,0,'',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,1767,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,0,'',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,1768,'dev1450231554',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1111',NULL,NULL,NULL,NULL,'支持承担市级以上的科技项目',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'123','支持承担市级以上的科技项目——马闯',NULL,NULL,NULL,0,1,'发展计划科','',NULL,'电子信息',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,43,'0,1,2,3',NULL,'',NULL,0,'1450231554',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,1769,'com1450237597',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'技术合同登记奖励',NULL,NULL,NULL,0,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'123','测试6',NULL,NULL,NULL,0,1,'科技综合科','',NULL,'生物医药',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,43,'0',NULL,'',NULL,0,'1450237597',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);

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

insert  into `project_middle`(`id`,`project_id`,`project_process`,`fund_use`,`problem_action`) values (9,'dev1449884706','2.	设计思路\r\n通州区科委在线申报及科技项目查新平台设计思路应是：围绕申报管理办法，以方便科委内部申报管理工作，增进工作效率为核心，以方便申报单位的数据报送为主要目的；经济实用、快速见效；以需求为导向、以应用促发展；数据交换、资源共享。\r\n对于系统的设计必须要与申报管理实施办法相适应，所有对于系统的设计必须以申报管理办法为最高原则，在此基础上充分考虑系统的可扩展性。\r\n1.	以方便科委内部的管理','2.	设计思路\r\n通州区科委在线申报及科技项目查新平台设计思路应是：围绕申报管理办法，以方便科委内部申报管理工作，增进工作效率为核心，以方便申报单位的数据报送为主要目的；经济实用、快速见效；以需求为导向、以应用促发展；数据交换、资源共享。\r\n对于系统的设计必须要与申报管理实施办法相适应，所有对于系统的设计必须以申报管理办法为最高原则，在此基础上充分考虑系统的可扩展性。\r\n1.	以方便科委内部的管理',NULL),(10,'dev1449993371','ttttt','gggggggggggg','ggggggggggg');

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

insert  into `project_org`(`id`,`project_id`,`org_id`,`project_name`,`org_name`,`org_duty`) values (46,'dev1449884706',NULL,NULL,'北京千松科技发展有限公司','开发'),(47,'dev1449884706',NULL,NULL,'千松','开发'),(51,'dev1449998670',NULL,NULL,'ddd','ddd'),(53,'dev1449993371',NULL,NULL,'','1'),(55,'dev1450227541',NULL,NULL,' 11','11');

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

insert  into `project_principal`(`id`,`project_id`,`leader_name`,`leader_sex`,`leader_birth`,`leader_ID`,`leader_edu`,`leader_major`,`leader_phone`,`leader_address`,`leader_fax`,`leader_email`,`leader_achieve`,`tech_pos`,`leader_postal`,`leader_tele`,`leader_job`,`leader_opinion`) values (34,'dev1449884706','郑艳艳',NULL,NULL,NULL,NULL,NULL,'15124290380',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2.	设计思路\r\n通州区科委在线申报及科技项目查新平台设计思路应是：围绕申报管理办法，以方便科委内部申报管理工作，增进工作效率为核心，以方便申报单位的数据报送为主要目的；经济实用、快速见效；以需求为导向、以应用促发展；数据交换、资源共享。\r\n对于系统的设计必须要与申报管理实施办法相适应，所有对于系统的设计必须以申报管理办法为最高原则，在此基础上充分考虑系统的可扩展性。\r\n1.	以方便科委内部的管理工作，增进工作效率为核心\r\n通州区科委作为通州区科技创新相关申报的管理单位，其工作效率及管理能力的的高度将直接对申报的实施产生直接的影响，内网申报管理平台作为通州区科委科技创新相关申报的管理工具，必须以方便科委内部的管理工作，'),(35,'dev1449990507','亚伦',NULL,NULL,NULL,NULL,NULL,'15544442668',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(36,'dev1449993220','邯郸项目负责人',NULL,NULL,NULL,NULL,NULL,'邯郸联系方式',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'、项目负责人 \r\n意见：'),(37,'dev1449993371','1',NULL,NULL,NULL,NULL,NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1'),(38,'dev1450056126','d',NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(39,'dev1450070504','烦烦烦',NULL,NULL,NULL,NULL,NULL,'15144444444',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(40,'dev1449995930','',NULL,NULL,NULL,NULL,NULL,'11111111111',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(41,'dev1450149540','测试',NULL,NULL,NULL,NULL,NULL,'15124290380',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(42,'dev1450167318','',NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(43,'dev1450168576','',NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(44,'dev1450227229','马续航',NULL,NULL,NULL,NULL,NULL,'1234455',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1'),(45,'dev1450227541','马闯',NULL,NULL,NULL,NULL,NULL,'1355228367',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'好');

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

insert  into `project_summary`(`id`,`project_id`,`assign_plan`,`actual_plan`,`assign_target`,`actual_target`,`assign_research`,`actual_research`,`achievement`,`other_suggest`,`problem`,`generalize_plan`,`org_suggest`,`chair_suggest`) values (17,'',NULL,NULL,'2.	设计思路\r\n通州区科委在线申报及科技项目查新平台设计思路应是：围绕申报管理办法，以方便科委内部申报管理工作，增进工作效率为核心，以方便申报单位的数据报送为主要目的；经济实用、快速见效；以需求为导向、以应用促发展；数据交换、资源共享。\r\n对于系统的设计必须要与申报管理实施办法相适应，所有对于系统的设计必须以申报管理办法为最高原则，在此基础上充分考虑系统的可扩展性。\r\n1.	以方便科委内部的管理',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(18,'',NULL,NULL,NULL,NULL,'2.	设计思路\r\n通州区科委在线申报及科技项目查新平台设计思路应是：围绕申报管理办法，以方便科委内部申报管理工作，增进工作效率为核心，以方便申报单位的数据报送为主要目的；经济实用、快速见效；以需求为导向、以应用促发展；数据交换、资源共享。\r\n对于系统的设计必须要与申报管理实施办法相适应，所有对于系统的设计必须以申报管理办法为最高原则，在此基础上充分考虑系统的可扩展性。\r\n1.	以方便科委内部的管理',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(19,'',NULL,NULL,NULL,NULL,NULL,NULL,'2.	设计思路\r\n通州区科委在线申报及科技项目查新平台设计思路应是：围绕申报管理办法，以方便科委内部申报管理工作，增进工作效率为核心，以方便申报单位的数据报送为主要目的；经济实用、快速见效；以需求为导向、以应用促发展；数据交换、资源共享。\r\n对于系统的设计必须要与申报管理实施办法相适应，所有对于系统的设计必须以申报管理办法为最高原则，在此基础上充分考虑系统的可扩展性。\r\n1.	以方便科委内部的管理',NULL,NULL,NULL,NULL,NULL),(20,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2.	设计思路\r\n通州区科委在线申报及科技项目查新平台设计思路应是：围绕申报管理办法，以方便科委内部申报管理工作，增进工作效率为核心，以方便申报单位的数据报送为主要目的；经济实用、快速见效；以需求为导向、以应用促发展；数据交换、资源共享。\r\n对于系统的设计必须要与申报管理实施办法相适应，所有对于系统的设计必须以申报管理办法为最高原则，在此基础上充分考虑系统的可扩展性。\r\n1.	以方便科委内部的管理',NULL,NULL,NULL,NULL),(21,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2.	设计思路\r\n通州区科委在线申报及科技项目查新平台设计思路应是：围绕申报管理办法，以方便科委内部申报管理工作，增进工作效率为核心，以方便申报单位的数据报送为主要目的；经济实用、快速见效；以需求为导向、以应用促发展；数据交换、资源共享。\r\n对于系统的设计必须要与申报管理实施办法相适应，所有对于系统的设计必须以申报管理办法为最高原则，在此基础上充分考虑系统的可扩展性。\r\n1.	以方便科委内部的管理',NULL,NULL),(22,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2.	设计思路\r\n通州区科委在线申报及科技项目查新平台设计思路应是：围绕申报管理办法，以方便科委内部申报管理工作，增进工作效率为核心，以方便申报单位的数据报送为主要目的；经济实用、快速见效；以需求为导向、以应用促发展；数据交换、资源共享。\r\n对于系统的设计必须要与申报管理实施办法相适应，所有对于系统的设计必须以申报管理办法为最高原则，在此基础上充分考虑系统的可扩展性。\r\n1.	以方便科委内部的管理',NULL),(23,'dev1449884706','2.	设计思路\r\n通州区科委在线申报及科技项目查新平台设计思路应是：围绕申报管理办法，以方便科委内部申报管理工作，增进工作效率为核心，以方便申报单位的数据报送为主要目的；经济实用、快速见效；以需求为导向、以应用促发展；数据交换、资源共享。\r\n对于系统的设计必须要与申报管理实施办法相适应，所有对于系统的设计必须以申报管理办法为最高原则，在此基础上充分考虑系统的可扩展性。\r\n1.	以方便科委内部的管理',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(24,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ggggg',NULL),(25,'',NULL,NULL,NULL,NULL,'ggggggggggg',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(26,'',NULL,NULL,NULL,NULL,NULL,NULL,'gggggggggggg',NULL,NULL,NULL,NULL,NULL),(27,'dev1449993371','gggggggggggggggggg',NULL,'ggggggg',NULL,'ggggggg',NULL,'ggggggggg','ggggggggg',NULL,'ggggggggggg','gggggggggg',NULL);

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
  `is_new` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `project_type` */

insert  into `project_type`(`id`,`name`,`isfather`,`father`,`dep_type`,`apply_status`,`apply_start`,`apply_end`,`attatch_name`,`apply_stage`,`setup_stage`,`carry_stage`,`check_stage`,`project_leader`,`is_new`) values (1,'支持科技研发及成果转化专项资金',1,NULL,-1,1,'1449158400','1449158400',NULL,1,0,0,0,NULL,0),(2,'自主研发项目',0,1,0,1,'1449590400','','北京市通州区科技计划项目实施方案',1,1,1,1,NULL,0),(3,'产学研合作项目',0,1,0,1,'1449676800','1451577599','北京市通州区科技计划项目实施方案,通州区支持产学研合作项目申请书',1,1,1,1,NULL,0),(4,'科技成果转化项目',0,1,0,1,'1449504000','1450367999','北京市通州区科技计划项目实施方案,通州区支持科技成果转化项目申报书',1,1,1,1,NULL,0),(5,'支持承担市级以上的科技项目',0,1,0,1,'1448899200','1450281599','北京市通州区科技计划项目实施方案,通州区支持承担市级以上科技项目申报书',1,1,1,1,NULL,0),(6,'加强创新平台建设专项资金',1,6,0,1,'1450108800','','北京市通州区科技计划项目实施方案,通州区支持创新平台建设项目申报书',1,1,1,1,NULL,0),(7,'大力发展技术市场专项资金',1,NULL,-1,1,'1444838400','1449158400','',1,0,0,0,NULL,0),(8,'技术合同登记奖励',0,7,2,1,'1448899200','1450886399','通州区技术合同登记奖励资金申报表',1,0,0,0,NULL,0),(9,'支持技术输出能力提升项目',0,7,2,1,'1448899200','1450281599','北京市通州区科技计划项目实施方案,通州区支持技术输出能力提升项目申报书',1,0,0,0,NULL,0),(10,'支持购买区内单位技术服务项目',0,7,2,1,'1448899200','1450281599','北京市通州区科技计划项目实施方案,通州区支持购买区内单位技术服务项目申报书',1,0,0,0,NULL,0),(11,'支持科技企业孵化器和大学科技园发展专项资金',1,NULL,-1,1,'1444838400','1449158400',NULL,1,0,0,0,NULL,0),(12,'支持初创期科技企业孵化器、大学科技园发展项目',0,11,2,1,'1448899200','1451577599','北京市通州区科技计划项目实施方案,通州区支持科技企业孵化器大学科技园发展项目申报书',1,0,0,0,NULL,0),(13,'支持市级以上科技企业孵化器资质认证及后期运营项目',0,11,2,1,'1448899200','1450886399','北京市通州区科技计划项目实施方案,通州区支持科技企业孵化器大学科技园发展项目申报书',1,0,0,0,NULL,0),(14,'支持市级以上大学科技园资质认定及后期运营项目',0,11,2,1,'1451491200','1450886399','北京市通州区科技计划项目实施方案,通州区支持科技企业孵化器大学科技园发展项目申报书',1,0,0,0,NULL,0),(15,'支持科技服务机构发展专项资金',1,NULL,-1,1,'1444838400','1449158400',NULL,1,0,0,0,NULL,0),(16,'支持研发设计等服务机构发展项目',0,15,0,1,'1448899200','1450886399','北京市通州区科技计划项目实施方案,通州区支持科技服务机构发展项目申报书',1,1,1,1,NULL,0),(17,'支持技术转移',0,15,2,1,'1448899200','1450799999','北京市通州区科技计划项目实施方案,通州区支持科技服务机构发展项目申报书',1,0,0,0,NULL,0),(18,'知识产权服务机构发展项目',0,15,1,1,'1450713600','','北京市通州区科技计划项目实施方案,通州区支持科技服务机构发展项目申报书',1,0,0,0,NULL,0),(19,'支持为高新技术企业认定提供鉴证服务',0,15,2,1,'1444838400','','通州区高新技术企业认定服务机构资助资金申请表',1,0,0,0,NULL,0),(20,'支持重点功能区及园区建设申报指南',1,20,0,1,'1444838400','1449158400','北京市通州区科技计划项目实施方案',1,0,0,0,NULL,0),(21,'专利实施项目',1,21,1,1,'1444838400','1449158400',NULL,1,0,0,0,NULL,0),(28,'发展',0,0,1,1,'1431014400','1449158400',NULL,1,0,0,0,NULL,0);

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

insert  into `researchers`(`id`,`project_id`,`researcher_name`,`researcher_sex`,`researcher_birth`,`researcher_ID`,`researcher_pos`,`researcher_job`,`researcher_edu`,`researcher_major`,`researcher_work`,`researcher_org`) values (51,'dev1449884706','郑艳艳',0,'1989年7月','21092119890701','无','产品','本科','软件','产品','千松'),(52,'dev1449884706','戴伟',0,'1990年','210921198907011127','无','开发','本科','软件','开发','千松'),(54,'dev1449993220','1',1,'1','','','','','','',''),(57,'dev1449998670','',0,'','','','','','','',''),(59,'dev1449993371','1',1,'','','','','','','',''),(62,'dev1450227229','1',1,'1','1','1','1','1','1','11','1'),(63,'dev1450227541','11',11,'11','11','11','11','11','11','11','11');

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
  `org_code` varchar(11) default NULL,/*这个字段在word文件中是删除的*/
  `company_name` varchar(30) default NULL,/*word文件中的service_state表还有project_id字段，类型为varchar(30)*/
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

insert  into `table_status`(`id`,`table_name`,`last_modify`,`table_status`,`project_id`,`project_stage`,`approval_opinion`,`approval_time`,`open`,`check_repeat`) values (9843,'项目任务书','1449863579',1,'dev1449863579',1,NULL,NULL,1,1),(9844,'专家名单及专家论证意见','1449863579',1,'dev1449863579',1,NULL,NULL,1,1),(9845,'课题调整申请表','1449863579',1,'dev1449863579',2,NULL,NULL,1,1),(9846,'项目中期报告','1449863579',1,'dev1449863579',2,NULL,NULL,0,1),(9847,'项目总结报告书','1449863579',1,'dev1449863579',3,NULL,NULL,0,1),(9848,'项目经费总决算表','1449863579',1,'dev1449863579',3,NULL,NULL,0,1),(9849,'项目验收专家组意见','1449863579',1,'dev1449863579',3,NULL,NULL,0,1),(9850,'北京市通州区科技计划项目实施方案','1449863579',1,'dev1449863579',0,NULL,NULL,1,1),(9851,'项目任务书','1449887623',4,'dev1449884706',1,'             \r\n              \r\n通关过','1449888032',1,1),(9852,'专家名单及专家论证意见','1449887994',4,'dev1449884706',1,'             \r\n              \r\n       通过','1449888121',1,1),(9853,'课题调整申请表','1449884706',1,'dev1449884706',2,NULL,NULL,1,1),(9854,'项目中期报告','1449888409',4,'dev1449884706',2,'             \r\n              \r\n       通过','1449888442',1,1),(9855,'项目总结报告书','1449888570',4,'dev1449884706',3,'             \r\n              \r\n       通过','1449888735',1,1),(9856,'项目经费总决算表','1449888681',4,'dev1449884706',3,'             \r\n              \r\n       ','1449888749',1,1),(9857,'项目验收专家组意见','1449888777',4,'dev1449884706',3,'             \r\n                    \r\n              \r\n              \r\n       ','1449888800',1,1),(9858,'北京市通州区科技计划项目实施方案','1449886295',4,'dev1449884706',0,'             \r\n              \r\n       通过','1449887183',1,2),(9859,'项目任务书','1449893738',1,'dev1449893738',1,NULL,NULL,1,1),(9860,'专家名单及专家论证意见','1449893738',1,'dev1449893738',1,NULL,NULL,1,1),(9861,'课题调整申请表','1449893738',1,'dev1449893738',2,NULL,NULL,1,1),(9862,'项目中期报告','1449893738',1,'dev1449893738',2,NULL,NULL,0,1),(9863,'项目总结报告书','1449893738',1,'dev1449893738',3,NULL,NULL,0,1),(9864,'项目经费总决算表','1449893738',1,'dev1449893738',3,NULL,NULL,0,1),(9865,'项目验收专家组意见','1449893738',1,'dev1449893738',3,NULL,NULL,0,1),(9866,'北京市通州区科技计划项目实施方案','1449893738',1,'dev1449893738',0,NULL,NULL,1,1),(9867,'通州区支持产学研合作项目申请书','1449893738',1,'dev1449893738',0,NULL,NULL,1,1),(9868,'通州区技术合同登记奖励资金申报表','1449893794',1,'com1449893794',0,NULL,NULL,1,1),(9869,'项目任务书','1449976688',4,'dev1449976336',1,'             \r\n              \r\n       ','1449976729',1,1),(9870,'专家名单及专家论证意见','1449976695',4,'dev1449976336',1,'             \r\n              \r\n       ','1449976737',1,1),(9871,'课题调整申请表','1449976336',1,'dev1449976336',2,NULL,NULL,1,1),(9872,'项目中期报告','1449976793',4,'dev1449976336',2,'             \r\n              \r\n       ','1449976807',1,1),(9873,'项目总结报告书','1449976336',1,'dev1449976336',3,NULL,NULL,1,1),(9874,'项目经费总决算表','1449976336',1,'dev1449976336',3,NULL,NULL,1,1),(9875,'项目验收专家组意见','1449976336',1,'dev1449976336',3,NULL,NULL,1,1),(9876,'北京市通州区科技计划项目实施方案','1449976381',4,'dev1449976336',0,'             \r\n              \r\n       ','1449976537',1,2),(9877,'项目任务书','1449976944',1,'dev1449976944',1,NULL,NULL,1,1),(9878,'专家名单及专家论证意见','1449976944',1,'dev1449976944',1,NULL,NULL,1,1),(9879,'课题调整申请表','1449976944',1,'dev1449976944',2,NULL,NULL,1,1),(9880,'项目中期报告','1449976944',1,'dev1449976944',2,NULL,NULL,0,1),(9881,'项目总结报告书','1449976944',1,'dev1449976944',3,NULL,NULL,0,1),(9882,'项目经费总决算表','1449976944',1,'dev1449976944',3,NULL,NULL,0,1),(9883,'项目验收专家组意见','1449976944',1,'dev1449976944',3,NULL,NULL,0,1),(9884,'北京市通州区科技计划项目实施方案','1449976944',1,'dev1449976944',0,NULL,NULL,1,1),(9885,'项目任务书','1449990507',1,'dev1449990507',1,NULL,NULL,1,1),(9886,'专家名单及专家论证意见','1449990507',1,'dev1449990507',1,NULL,NULL,1,1),(9887,'课题调整申请表','1449990507',1,'dev1449990507',2,NULL,NULL,1,1),(9888,'项目中期报告','1449990507',1,'dev1449990507',2,NULL,NULL,0,1),(9889,'项目总结报告书','1449990507',1,'dev1449990507',3,NULL,NULL,0,1),(9890,'项目经费总决算表','1449990507',1,'dev1449990507',3,NULL,NULL,0,1),(9891,'项目验收专家组意见','1449990507',1,'dev1449990507',3,NULL,NULL,0,1),(9892,'北京市通州区科技计划项目实施方案','1449990507',1,'dev1449990507',0,NULL,NULL,1,1),(9893,'项目任务书','1449995319',4,'dev1449993220',1,'             \r\n              \r\n       111','1449995393',1,1),(9894,'专家名单及专家论证意见','1449995357',4,'dev1449993220',1,'             \r\n              \r\n       ','1449995401',1,1),(9895,'课题调整申请表','1449995577',4,'dev1449993220',2,NULL,'1449995777',1,1),(9896,'项目中期报告','1449995613',4,'dev1449993220',2,'             \r\n              \r\n       hao ','1449995691',1,1),(9897,'项目总结报告书','1449995992',4,'dev1449993220',3,'             \r\n              \r\n       ','1449996095',1,1),(9898,'项目经费总决算表','1449996041',4,'dev1449993220',3,'             \r\n              \r\n       ','1449996112',1,1),(9899,'项目验收专家组意见','1449996056',4,'dev1449993220',3,'             \r\n              \r\n       ','1449996104',1,1),(9900,'北京市通州区科技计划项目实施方案','1449994148',4,'dev1449993220',0,'             \r\n              \r\n       hd  ','1449995217',1,2),(9901,'项目任务书','1449996548',4,'dev1449993371',1,'             \r\n              \r\n       ojiug','1449996998',1,1),(9902,'专家名单及专家论证意见','1449996933',4,'dev1449993371',1,'             \r\n              \r\n       ttttt','1449997014',1,1),(9903,'课题调整申请表','1449997428',4,'dev1449993371',2,'             \r\n              \r\n       ','1449997445',1,1),(9904,'项目中期报告','1449997494',4,'dev1449993371',2,'             \r\n              \r\n       ','1449997520',1,1),(9905,'项目总结报告书','1449997871',4,'dev1449993371',3,'             \r\n              \r\n       ','1449997988',1,1),(9906,'项目经费总决算表','1449997887',4,'dev1449993371',3,'             \r\n              \r\n       ','1449998011',1,1),(9907,'项目验收专家组意见','1449997967',4,'dev1449993371',3,'             \r\n              \r\n       ','1449997995',1,1),(9908,'北京市通州区科技计划项目实施方案','1449996053',4,'dev1449993371',0,'             \r\n              \r\n       ok ok','1449996449',1,2),(9909,'项目任务书','1449993626',1,'dev1449993626',1,NULL,NULL,1,1),(9910,'专家名单及专家论证意见','1449993626',1,'dev1449993626',1,NULL,NULL,1,1),(9911,'课题调整申请表','1449993626',1,'dev1449993626',2,NULL,NULL,1,1),(9912,'项目中期报告','1449993626',1,'dev1449993626',2,NULL,NULL,0,1),(9913,'项目总结报告书','1449993626',1,'dev1449993626',3,NULL,NULL,0,1),(9914,'项目经费总决算表','1449993626',1,'dev1449993626',3,NULL,NULL,0,1),(9915,'项目验收专家组意见','1449993626',1,'dev1449993626',3,NULL,NULL,0,1),(9916,'北京市通州区科技计划项目实施方案','1450006536',2,'dev1449993626',0,NULL,NULL,1,2),(9917,'项目任务书','1449995843',1,'dev1449995843',1,NULL,NULL,1,1),(9918,'专家名单及专家论证意见','1449995843',1,'dev1449995843',1,NULL,NULL,1,1),(9919,'课题调整申请表','1449995843',1,'dev1449995843',2,NULL,NULL,1,1),(9920,'项目中期报告','1449995843',1,'dev1449995843',2,NULL,NULL,0,1),(9921,'项目总结报告书','1449995843',1,'dev1449995843',3,NULL,NULL,0,1),(9922,'项目经费总决算表','1449995843',1,'dev1449995843',3,NULL,NULL,0,1),(9923,'项目验收专家组意见','1449995843',1,'dev1449995843',3,NULL,NULL,0,1),(9924,'北京市通州区科技计划项目实施方案','1449995887',2,'dev1449995843',0,NULL,NULL,1,2),(9925,'项目任务书','1449995930',1,'dev1449995930',1,NULL,NULL,1,1),(9926,'专家名单及专家论证意见','1449995930',1,'dev1449995930',1,NULL,NULL,1,1),(9927,'课题调整申请表','1449995930',1,'dev1449995930',2,NULL,NULL,1,1),(9928,'项目中期报告','1449995930',1,'dev1449995930',2,NULL,NULL,0,1),(9929,'项目总结报告书','1449995930',1,'dev1449995930',3,NULL,NULL,0,1),(9930,'项目经费总决算表','1449995930',1,'dev1449995930',3,NULL,NULL,0,1),(9931,'项目验收专家组意见','1449995930',1,'dev1449995930',3,NULL,NULL,0,1),(9932,'北京市通州区科技计划项目实施方案','1449996319',4,'dev1449995930',0,'             \r\n              \r\n       ','1450006594',1,2),(9933,'项目任务书','1449998670',1,'dev1449998670',1,NULL,NULL,1,1),(9934,'专家名单及专家论证意见','1449998670',1,'dev1449998670',1,NULL,NULL,1,1),(9935,'课题调整申请表','1449998670',1,'dev1449998670',2,NULL,NULL,1,1),(9936,'项目中期报告','1449998670',1,'dev1449998670',2,NULL,NULL,0,1),(9937,'项目总结报告书','1449998670',1,'dev1449998670',3,NULL,NULL,0,1),(9938,'项目经费总决算表','1449998670',1,'dev1449998670',3,NULL,NULL,0,1),(9939,'项目验收专家组意见','1449998670',1,'dev1449998670',3,NULL,NULL,0,1),(9940,'北京市通州区科技计划项目实施方案','1449998670',1,'dev1449998670',0,NULL,NULL,1,1),(9941,'项目任务书','1449999720',1,'dev1449999720',1,NULL,NULL,1,1),(9942,'专家名单及专家论证意见','1449999720',1,'dev1449999720',1,NULL,NULL,1,1),(9943,'课题调整申请表','1449999720',1,'dev1449999720',2,NULL,NULL,1,1),(9944,'项目中期报告','1449999720',1,'dev1449999720',2,NULL,NULL,0,1),(9945,'项目总结报告书','1449999720',1,'dev1449999720',3,NULL,NULL,0,1),(9946,'项目经费总决算表','1449999720',1,'dev1449999720',3,NULL,NULL,0,1),(9947,'项目验收专家组意见','1449999720',1,'dev1449999720',3,NULL,NULL,0,1),(9948,'北京市通州区科技计划项目实施方案','1449999720',1,'dev1449999720',0,NULL,NULL,1,1),(9949,'项目任务书','1450000263',1,'dev1450000263',1,NULL,NULL,1,1),(9950,'专家名单及专家论证意见','1450000263',1,'dev1450000263',1,NULL,NULL,1,1),(9951,'课题调整申请表','1450000263',1,'dev1450000263',2,NULL,NULL,1,1),(9952,'项目中期报告','1450000263',1,'dev1450000263',2,NULL,NULL,0,1),(9953,'项目总结报告书','1450000263',1,'dev1450000263',3,NULL,NULL,0,1),(9954,'项目经费总决算表','1450000263',1,'dev1450000263',3,NULL,NULL,0,1),(9955,'项目验收专家组意见','1450000263',1,'dev1450000263',3,NULL,NULL,0,1),(9956,'北京市通州区科技计划项目实施方案','1450000263',1,'dev1450000263',0,NULL,NULL,1,1),(9957,'通州区支持科技成果转化项目申报书','1450000263',1,'dev1450000263',0,NULL,NULL,1,1),(9958,'项目任务书','1450005381',1,'dev1450005381',1,NULL,NULL,1,1),(9959,'专家名单及专家论证意见','1450005381',1,'dev1450005381',1,NULL,NULL,1,1),(9960,'课题调整申请表','1450005381',1,'dev1450005381',2,NULL,NULL,1,1),(9961,'项目中期报告','1450005381',1,'dev1450005381',2,NULL,NULL,0,1),(9962,'项目总结报告书','1450005381',1,'dev1450005381',3,NULL,NULL,0,1),(9963,'项目经费总决算表','1450005381',1,'dev1450005381',3,NULL,NULL,0,1),(9964,'项目验收专家组意见','1450005381',1,'dev1450005381',3,NULL,NULL,0,1),(9965,'北京市通州区科技计划项目实施方案','1450005446',2,'dev1450005381',0,NULL,NULL,1,1),(9966,'通州区支持科技成果转化项目申报书','1450005450',2,'dev1450005381',0,NULL,NULL,1,1),(9967,'项目任务书','1450005855',1,'dev1450005855',1,NULL,NULL,1,1),(9968,'专家名单及专家论证意见','1450005855',1,'dev1450005855',1,NULL,NULL,1,1),(9969,'课题调整申请表','1450005855',1,'dev1450005855',2,NULL,NULL,1,1),(9970,'项目中期报告','1450005855',1,'dev1450005855',2,NULL,NULL,0,1),(9971,'项目总结报告书','1450005855',1,'dev1450005855',3,NULL,NULL,0,1),(9972,'项目经费总决算表','1450005855',1,'dev1450005855',3,NULL,NULL,0,1),(9973,'项目验收专家组意见','1450005855',1,'dev1450005855',3,NULL,NULL,0,1),(9974,'北京市通州区科技计划项目实施方案','1450005887',2,'dev1450005855',0,NULL,NULL,1,1),(9975,'通州区支持承担市级以上科技项目申报书','1450005891',2,'dev1450005855',0,NULL,NULL,1,1),(9976,'项目任务书','1450006957',1,'dev1450006957',1,NULL,NULL,1,1),(9977,'专家名单及专家论证意见','1450006957',1,'dev1450006957',1,NULL,NULL,1,1),(9978,'课题调整申请表','1450006957',1,'dev1450006957',2,NULL,NULL,1,1),(9979,'项目中期报告','1450006957',1,'dev1450006957',2,NULL,NULL,0,1),(9980,'项目总结报告书','1450006957',1,'dev1450006957',3,NULL,NULL,0,1),(9981,'项目经费总决算表','1450006957',1,'dev1450006957',3,NULL,NULL,0,1),(9982,'项目验收专家组意见','1450006957',1,'dev1450006957',3,NULL,NULL,0,1),(9983,'北京市通州区科技计划项目实施方案','1450006966',2,'dev1450006957',0,NULL,NULL,1,1),(9984,'通州区支持产学研合作项目申请书','1450006962',2,'dev1450006957',0,NULL,NULL,1,1),(9985,'北京市通州区科技计划项目实施方案','1450007096',2,'com1450007092',0,NULL,NULL,1,1),(9986,'通州区支持科技企业孵化器大学科技园发展项目申报书','1450007100',2,'com1450007092',0,NULL,NULL,1,1),(9987,'北京市通州区科技计划项目实施方案','1450007244',2,'com1450007239',0,NULL,NULL,1,1),(9988,'通州区支持科技服务机构发展项目申报书','1450007248',2,'com1450007239',0,NULL,NULL,1,1),(9989,'项目任务书','1450056126',1,'dev1450056126',1,NULL,NULL,1,1),(9990,'专家名单及专家论证意见','1450156024',4,'dev1450056126',1,'             \r\n              \r\n       ','1450161492',1,1),(9991,'课题调整申请表','1450056126',1,'dev1450056126',2,NULL,NULL,1,1),(9992,'项目中期报告','1450056126',1,'dev1450056126',2,NULL,NULL,0,1),(9993,'项目总结报告书','1450056126',1,'dev1450056126',3,NULL,NULL,0,1),(9994,'项目经费总决算表','1450056126',1,'dev1450056126',3,NULL,NULL,0,1),(9995,'项目验收专家组意见','1450056126',1,'dev1450056126',3,NULL,NULL,0,1),(9996,'北京市通州区科技计划项目实施方案','1450058105',4,'dev1450056126',0,'             \r\n              \r\n       ','1450068679',1,2),(9997,'项目任务书','1450070504',1,'dev1450070504',1,NULL,NULL,1,1),(9998,'专家名单及专家论证意见','1450070504',1,'dev1450070504',1,NULL,NULL,1,1),(9999,'课题调整申请表','1450070504',1,'dev1450070504',2,NULL,NULL,1,1),(10000,'项目中期报告','1450070504',1,'dev1450070504',2,NULL,NULL,0,1),(10001,'项目总结报告书','1450070504',1,'dev1450070504',3,NULL,NULL,0,1),(10002,'项目经费总决算表','1450070504',1,'dev1450070504',3,NULL,NULL,0,1),(10003,'项目验收专家组意见','1450070504',1,'dev1450070504',3,NULL,NULL,0,1),(10004,'北京市通州区科技计划项目实施方案','1450070504',1,'dev1450070504',0,NULL,NULL,1,1),(10005,'通州区支持承担市级以上科技项目申报书','1450070504',1,'dev1450070504',0,NULL,NULL,1,1),(10006,'项目任务书','1450149540',1,'dev1450149540',1,NULL,NULL,1,1),(10007,'专家名单及专家论证意见','1450149540',1,'dev1450149540',1,NULL,NULL,1,1),(10008,'课题调整申请表','1450149540',1,'dev1450149540',2,NULL,NULL,1,1),(10009,'项目中期报告','1450149540',1,'dev1450149540',2,NULL,NULL,0,1),(10010,'项目总结报告书','1450149540',1,'dev1450149540',3,NULL,NULL,0,1),(10011,'项目经费总决算表','1450149540',1,'dev1450149540',3,NULL,NULL,0,1),(10012,'项目验收专家组意见','1450149540',1,'dev1450149540',3,NULL,NULL,0,1),(10013,'北京市通州区科技计划项目实施方案','1450149597',4,'dev1450149540',0,'             \r\n              \r\n       ','1450149710',1,2),(10014,'项目任务书','1450149860',1,'dev1450149860',1,NULL,NULL,1,1),(10015,'专家名单及专家论证意见','1450149860',1,'dev1450149860',1,NULL,NULL,1,1),(10016,'课题调整申请表','1450149860',1,'dev1450149860',2,NULL,NULL,1,1),(10017,'项目中期报告','1450149860',1,'dev1450149860',2,NULL,NULL,0,1),(10018,'项目总结报告书','1450149860',1,'dev1450149860',3,NULL,NULL,0,1),(10019,'项目经费总决算表','1450149860',1,'dev1450149860',3,NULL,NULL,0,1),(10020,'项目验收专家组意见','1450149860',1,'dev1450149860',3,NULL,NULL,0,1),(10021,'北京市通州区科技计划项目实施方案','1450149860',1,'dev1450149860',0,NULL,NULL,1,1),(10022,'项目任务书','1450149860',1,'dev1450149860',1,NULL,NULL,1,1),(10023,'专家名单及专家论证意见','1450149860',1,'dev1450149860',1,NULL,NULL,1,1),(10024,'课题调整申请表','1450149860',1,'dev1450149860',2,NULL,NULL,1,1),(10025,'项目中期报告','1450149860',1,'dev1450149860',2,NULL,NULL,0,1),(10026,'项目总结报告书','1450149860',1,'dev1450149860',3,NULL,NULL,0,1),(10027,'项目经费总决算表','1450149860',1,'dev1450149860',3,NULL,NULL,0,1),(10028,'项目验收专家组意见','1450149860',1,'dev1450149860',3,NULL,NULL,0,1),(10029,'北京市通州区科技计划项目实施方案','1450149860',1,'dev1450149860',0,NULL,NULL,1,1),(10030,'项目任务书','1450150582',1,'dev1450150582',1,NULL,NULL,1,1),(10031,'专家名单及专家论证意见','1450150582',1,'dev1450150582',1,NULL,NULL,1,1),(10032,'课题调整申请表','1450150582',1,'dev1450150582',2,NULL,NULL,1,1),(10033,'项目中期报告','1450150582',1,'dev1450150582',2,NULL,NULL,0,1),(10034,'项目总结报告书','1450150582',1,'dev1450150582',3,NULL,NULL,0,1),(10035,'项目经费总决算表','1450150582',1,'dev1450150582',3,NULL,NULL,0,1),(10036,'项目验收专家组意见','1450150582',1,'dev1450150582',3,NULL,NULL,0,1),(10037,'北京市通州区科技计划项目实施方案','1450150582',1,'dev1450150582',0,NULL,NULL,1,1),(10038,'项目任务书','1450161606',1,'dev1450161606',1,NULL,NULL,1,1),(10039,'专家名单及专家论证意见','1450164878',4,'dev1450161606',1,'             \r\n              \r\n       ','1450166539',1,1),(10040,'课题调整申请表','1450161606',1,'dev1450161606',2,NULL,NULL,1,1),(10041,'项目中期报告','1450161606',1,'dev1450161606',2,NULL,NULL,0,1),(10042,'项目总结报告书','1450161606',1,'dev1450161606',3,NULL,NULL,0,1),(10043,'项目经费总决算表','1450161606',1,'dev1450161606',3,NULL,NULL,0,1),(10044,'项目验收专家组意见','1450161606',1,'dev1450161606',3,NULL,NULL,0,1),(10045,'北京市通州区科技计划项目实施方案','1450161680',4,'dev1450161606',0,'             \r\n              \r\n       ','1450161787',1,2),(10046,'项目任务书','1450161916',1,'dev1450161916',1,NULL,NULL,1,1),(10047,'专家名单及专家论证意见','1450161916',1,'dev1450161916',1,NULL,NULL,1,1),(10048,'课题调整申请表','1450161916',1,'dev1450161916',2,NULL,NULL,1,1),(10049,'项目中期报告','1450161916',1,'dev1450161916',2,NULL,NULL,0,1),(10050,'项目总结报告书','1450161916',1,'dev1450161916',3,NULL,NULL,0,1),(10051,'项目经费总决算表','1450161916',1,'dev1450161916',3,NULL,NULL,0,1),(10052,'项目验收专家组意见','1450161916',1,'dev1450161916',3,NULL,NULL,0,1),(10053,'北京市通州区科技计划项目实施方案','1450161916',4,'dev1450161916',0,'             \r\n              \r\n       ','1450168119',1,1),(10054,'项目任务书','1450167318',1,'dev1450167318',1,NULL,NULL,1,1),(10055,'专家名单及专家论证意见','1450167318',1,'dev1450167318',1,NULL,NULL,1,1),(10056,'课题调整申请表','1450167318',1,'dev1450167318',2,NULL,NULL,1,1),(10057,'项目中期报告','1450167318',1,'dev1450167318',2,NULL,NULL,0,1),(10058,'项目总结报告书','1450167318',1,'dev1450167318',3,NULL,NULL,0,1),(10059,'项目经费总决算表','1450167318',1,'dev1450167318',3,NULL,NULL,0,1),(10060,'项目验收专家组意见','1450167318',1,'dev1450167318',3,NULL,NULL,0,1),(10061,'北京市通州区科技计划项目实施方案','1450167437',4,'dev1450167318',0,'             \r\n              \r\n       ','1450167908',1,2),(10062,'项目任务书','1450168576',1,'dev1450168576',1,NULL,NULL,1,1),(10063,'专家名单及专家论证意见','1450170156',2,'dev1450168576',1,NULL,NULL,1,1),(10064,'课题调整申请表','1450168576',1,'dev1450168576',2,NULL,NULL,1,1),(10065,'项目中期报告','1450168576',1,'dev1450168576',2,NULL,NULL,0,1),(10066,'项目总结报告书','1450168576',1,'dev1450168576',3,NULL,NULL,0,1),(10067,'项目经费总决算表','1450168576',1,'dev1450168576',3,NULL,NULL,0,1),(10068,'项目验收专家组意见','1450168576',1,'dev1450168576',3,NULL,NULL,0,1),(10069,'北京市通州区科技计划项目实施方案','1450168671',4,'dev1450168576',0,'             \r\n              \r\n       ','1450169953',1,2),(10070,'项目任务书','1450227229',1,'dev1450227229',1,NULL,NULL,1,1),(10071,'专家名单及专家论证意见','1450227229',1,'dev1450227229',1,NULL,NULL,1,1),(10072,'课题调整申请表','1450227229',1,'dev1450227229',2,NULL,NULL,1,1),(10073,'项目中期报告','1450227229',1,'dev1450227229',2,NULL,NULL,0,1),(10074,'项目总结报告书','1450227229',1,'dev1450227229',3,NULL,NULL,0,1),(10075,'项目经费总决算表','1450227229',1,'dev1450227229',3,NULL,NULL,0,1),(10076,'项目验收专家组意见','1450227229',1,'dev1450227229',3,NULL,NULL,0,1),(10077,'北京市通州区科技计划项目实施方案','1450228310',4,'dev1450227229',0,'             \r\n              \r\n       ok','1450230234',1,2),(10078,'项目任务书','1450227541',1,'dev1450227541',1,NULL,NULL,1,1),(10079,'专家名单及专家论证意见','1450229320',4,'dev1450227541',1,'             \r\n              \r\n       好','1450229483',1,1),(10080,'课题调整申请表','1450227541',1,'dev1450227541',2,NULL,NULL,1,1),(10081,'项目中期报告','1450227541',1,'dev1450227541',2,NULL,NULL,0,1),(10082,'项目总结报告书','1450227541',1,'dev1450227541',3,NULL,NULL,0,1),(10083,'项目经费总决算表','1450227541',1,'dev1450227541',3,NULL,NULL,0,1),(10084,'项目验收专家组意见','1450227541',1,'dev1450227541',3,NULL,NULL,0,1),(10085,'北京市通州区科技计划项目实施方案','1450228795',4,'dev1450227541',0,'             \r\n              \r\n     审核通过','1450228943',1,2),(10086,'项目任务书','1450231554',1,'dev1450231554',1,NULL,NULL,1,1),(10087,'专家名单及专家论证意见','1450231554',1,'dev1450231554',1,NULL,NULL,1,1),(10088,'课题调整申请表','1450231554',1,'dev1450231554',2,NULL,NULL,1,1),(10089,'项目中期报告','1450231554',1,'dev1450231554',2,NULL,NULL,0,1),(10090,'项目总结报告书','1450231554',1,'dev1450231554',3,NULL,NULL,0,1),(10091,'项目经费总决算表','1450231554',1,'dev1450231554',3,NULL,NULL,0,1),(10092,'项目验收专家组意见','1450231554',1,'dev1450231554',3,NULL,NULL,0,1),(10093,'北京市通州区科技计划项目实施方案','1450231554',1,'dev1450231554',0,NULL,NULL,1,1),(10094,'通州区支持承担市级以上科技项目申报书','1450231554',1,'dev1450231554',0,NULL,NULL,1,1),(10095,'通州区技术合同登记奖励资金申报表','1450237597',1,'com1450237597',0,NULL,NULL,1,1);

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
  `receiver` varchar(100) default NULL,
  `company_scale` varchar(100) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tech_transfer` */

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

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
