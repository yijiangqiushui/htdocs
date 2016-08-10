/*
SQLyog 企业版 - MySQL GUI v8.14 
MySQL - 5.0.22-community-nt : Database - examine
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`examine` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `examine`;

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

insert  into `admincat`(`id`,`exclusive_name`,`catName`,`upperCat`,`upperID`,`isForbidden`,`userPrivileges`,`isLast`,`isDel`) values (1,'','通州','.',0,0,'priviliges,concats_,admincats_',0,0),(2,'leader','领导','.1.',1,0,'priviliges,concats_,admincats_,concat_query,file_query,seal_query,sms_query,sms_reply,smslistcat_query,smslistinfo_query,smslistinfo_export,admincat_query,admininfo_query,loginfo_query',1,0),(3,'','策划部','.1.',1,0,'priviliges,concats_.2,admincats_,concat_query,concat_add,concat_del,concat_edit,concat_disable,concat_enable,sms_query,file_add,file_query,file_del,file_edit,find_red,file_detail,remakes_red,file_cancel,file_report,seal_add,seal_query,seal_del,seal_edit,seal_getNo,seal_status,seal_reject,seal_cancel,seal_report,sms_add,sms_reply,sms_del,sms_report,smslistcat_query,smslistcat_add,smslistcat_del,smslistcat_edit,smslistinfo_query,smslistinfo_add,smslistinfo_del,smslistinfo_edit,smslistinfo_import,smslistinfo_export,drafter,maker,file_red,make_red,sealer,admincat_query,admincat_add,admincat_edit,admincat_del,admincat_disable,admincat_enable,admininfo_query,admininfo_add,admininfo_edit,admininfo_del,admininfo_disable,admininfo_enable,loginfo_query,data_backup,data_restore,smslistcat_disable1,smslistcat_enable1',1,0),(4,'','技术部','.1.',1,0,'priviliges,concats_.1,admincats_4,concat_query,file_query,seal_query,sms_query,sms_reply,smslistcat_query,smslistinfo_query,smslistinfo_export,admincat_query,admininfo_query,loginfo_query,sms_add,sms_del,smslistinfo_add,smslistinfo_del,smslistinfo_edit',1,0),(5,'','市场部','.1.',1,0,'priviliges,concats_,admincats_',1,0),(6,'','西直门','.',0,0,'priviliges,concats_.1,admincats_6,smslistcat_disable,smslistcat_enable',1,0);

/*Table structure for table `admininfo` */

DROP TABLE IF EXISTS `admininfo`;

CREATE TABLE `admininfo` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `ntid` tinytext COMMENT '设备ID',
  `seed` tinytext COMMENT 'SHA1种子码',
  `category` varchar(90) NOT NULL,
  `exclusive_name` varchar(90) default '',
  `usr` varchar(32) NOT NULL,
  `pwd` varchar(40) default NULL,
  `phone` varchar(15) default NULL,
  `email` varchar(35) default NULL,
  `qq` varchar(12) default NULL,
  `isForbidden` int(1) NOT NULL default '0',
  `addedDate` timestamp NULL default CURRENT_TIMESTAMP,
  `lastIP` varchar(15) default NULL,
  `lastLoginTime` timestamp NULL default NULL,
  `isDel` tinyint(1) default '0' COMMENT '0 未删除',
  `userPrivileges` text,
  `realname` varchar(32) NOT NULL,
  `isManager` tinyint(1) default '0' COMMENT '0不是',
  `managerMoreBm` text,
  `ids` text COMMENT '可导出他人通讯录id：分组',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `admininfo` */

insert  into `admininfo`(`id`,`ntid`,`seed`,`category`,`exclusive_name`,`usr`,`pwd`,`phone`,`email`,`qq`,`isForbidden`,`addedDate`,`lastIP`,`lastLoginTime`,`isDel`,`userPrivileges`,`realname`,`isManager`,`managerMoreBm`,`ids`) values (1,NULL,NULL,'.','','super','592d510020d3eacdc3d5c89e2e148f7467de3e82','10010','10010@qq.com','10010',0,'2015-05-15 10:48:40','192.168.0.100','2015-05-26 18:30:43',0,NULL,'超级管理员',0,NULL,NULL),(2,'','','.1.4.','','xiaoma','592d510020d3eacdc3d5c89e2e148f7467de3e82','13548964578','125486321@qq.com','',0,'2015-05-15 11:08:07','127.0.0.1','2015-05-26 14:57:07',0,'priviliges,concats_.1,admincats_4,concat_query,file_query,seal_query,sms_query,sms_add,sms_reply,sms_del,smslistcat_query,smslistinfo_query,smslistinfo_add,smslistinfo_del,smslistinfo_edit,smslistinfo_export,admincat_query,admininfo_query,loginfo_query','马擎天',0,'','3:13,14,15-'),(3,'a98d4cddaadafb4b2e9c4398d8decab3','FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF','.1.3.','drafter,sealer,','xiangqian','592d510020d3eacdc3d5c89e2e148f7467de3e82','15936284879','15487953245@qq.com','15936284879',0,'2015-05-15 11:19:33','192.168.0.100','2015-05-26 18:01:27',0,'priviliges,concats_.2,admincats_,drafter,file_add,maker,file_query,file_del,file_edit,file_red,find_red,file_detail,make_red,remakes_red,file_cancel,file_report,seal_add,sealer,seal_query,seal_del,seal_edit,seal_getNo,seal_status,seal_reject,seal_cancel,seal_report,sms_query,sms_add,sms_reply,sms_del,sms_report,smslistcat_query,smslistcat_add,smslistcat_del,smslistcat_edit,smslistinfo_query,smslistinfo_add,smslistinfo_del,smslistinfo_edit,smslistinfo_import,smslistinfo_export,admincat_query,admincat_add,admincat_edit,admincat_del,admincat_disable,admincat_enable,admininfo_query,admininfo_add,admininfo_edit,admininfo_del,admininfo_disable,admininfo_enable,loginfo_query,data_backup,data_restore','李向前',1,'',NULL),(4,'','','.1.3.','','lili','592d510020d3eacdc3d5c89e2e148f7467de3e82','15896356895','45787965185@qq.com','',0,'2015-05-15 11:44:02','127.0.0.1','2015-05-26 12:26:25',0,'priviliges,concats_.2,admincats_.0,sms_query,sms_add,sms_reply,sms_del,sms_report,smslistcat_query,smslistcat_add,smslistcat_del,smslistcat_edit,smslistinfo_query,smslistinfo_add,smslistinfo_del,smslistinfo_edit,smslistinfo_import,smslistinfo_export,admincat_query,admincat_add,admincat_edit,admincat_del,admincat_disable,admincat_enable,admininfo_query,admininfo_add,admininfo_edit,admininfo_del,admininfo_disable,admininfo_enable','王丽丽',0,'',NULL),(5,'','','.1.2.','','yangsong','592d510020d3eacdc3d5c89e2e148f7467de3e82','60551593','60551593@qq.com','',0,'2015-05-15 15:40:19','127.0.0.1','2015-05-26 13:35:22',0,'priviliges,concats_,admincats_,concat_query,file_query,seal_query,sms_query,sms_reply,smslistcat_query,smslistinfo_query,smslistinfo_export,admincat_query,admininfo_query,loginfo_query','杨松',0,'.1,.2','3:13,14,15-'),(6,'','','.1.3.','','songqiang','592d510020d3eacdc3d5c89e2e148f7467de3e82','15896325874','1548963256@qq.com','',0,'2015-05-15 17:20:03','127.0.0.1','2015-05-26 11:57:36',0,'priviliges,concats_.2,admincats_3','宋强',0,'',NULL),(7,'','','.6.','','liuhuan','592d510020d3eacdc3d5c89e2e148f7467de3e82','15894662254','liuhuan@163.com','',0,'2015-05-26 13:50:10','127.0.0.1',NULL,0,'priviliges,concats_.1,admincats_6,smslistcat_disable,smslistcat_enable','刘欢',0,'',NULL);

/*Table structure for table `apply` */

DROP TABLE IF EXISTS `apply`;

CREATE TABLE `apply` (
  `id` int(11) NOT NULL auto_increment,
  `total` int(11) default NULL COMMENT '件数',
  `use_time` date default NULL COMMENT '使用时间',
  `contentcat_id` varchar(20) default NULL COMMENT '用章部门或科室id',
  `reason` varchar(200) default NULL COMMENT '用章原因',
  `content` varchar(100) default NULL COMMENT '用章内容',
  `admin` varchar(30) default NULL COMMENT '印章管理员',
  `user` varchar(30) default NULL COMMENT '申请人',
  `category` varchar(30) default NULL,
  `setStatus` int(11) default '0',
  `is_forbidden` int(3) default NULL COMMENT '是否禁用，0启用1禁用',
  `is_recommend` int(3) default NULL COMMENT '0未推荐1推荐',
  `is_checked` int(11) default '0' COMMENT '1审核通过，0审核未通过',
  `end_time` varchar(30) default NULL COMMENT '截止时间',
  `addtime` date default NULL COMMENT '文件编号生成时间',
  `file_no` varchar(100) default NULL COMMENT '文件编号',
  `reject` int(3) default '0' COMMENT '驳回状态：0：未驳回，1：驳回',
  `dept` varchar(100) default NULL COMMENT '用章人',
  `isInvalid` int(1) default '0' COMMENT '0：有效未删除；1：无效；2：已删除',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `apply` */

insert  into `apply`(`id`,`total`,`use_time`,`contentcat_id`,`reason`,`content`,`admin`,`user`,`category`,`setStatus`,`is_forbidden`,`is_recommend`,`is_checked`,`end_time`,`addtime`,`file_no`,`reject`,`dept`,`isInvalid`) values (1,1,'2015-05-16',NULL,'111','科委党组',NULL,'xiangqian','.2.',0,NULL,NULL,0,NULL,NULL,NULL,0,'策划部',0),(2,1,'2015-05-21',NULL,'公用','科委党组',NULL,'李向前','.2.',0,NULL,NULL,0,NULL,NULL,NULL,0,'策划部',0),(3,1,'2015-05-25',NULL,'123','科委党组',NULL,'李向前','.2.',0,NULL,NULL,0,NULL,'2015-05-25','kwyz15052501',1,'策划部',0),(4,1,'2015-05-25',NULL,'恶趣味','科委党组',NULL,'李向前','.2.',0,NULL,NULL,0,NULL,NULL,NULL,1,'策划部',0);

/*Table structure for table `attachment` */

DROP TABLE IF EXISTS `attachment`;

CREATE TABLE `attachment` (
  `id` int(11) NOT NULL auto_increment,
  `content_id` int(11) NOT NULL default '0',
  `file_path` tinytext NOT NULL COMMENT '文件路径',
  `file_ext` varchar(5) NOT NULL default '' COMMENT '文件后缀名',
  `file_size` int(11) NOT NULL default '0',
  `file_name` varchar(100) default NULL COMMENT '文件名',
  `isred` int(1) default '0' COMMENT '是否为红头文件。0：否 1：是',
  `brief_ctnt` tinytext,
  `isopen` int(1) default '0' COMMENT '拟稿人是否查看：0：否 1：是',
  PRIMARY KEY  (`id`,`content_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `attachment` */

insert  into `attachment`(`id`,`content_id`,`file_path`,`file_ext`,`file_size`,`file_name`,`isred`,`brief_ctnt`,`isopen`) values (1,16,'upload/2015/05/26/575580dd5706cf3624efcdaac3b6fd9d861cfaf9.docx','1',0,'科委办公平台修改方案V1.1.docx',0,NULL,0);

/*Table structure for table `contentcat` */

DROP TABLE IF EXISTS `contentcat`;

CREATE TABLE `contentcat` (
  `id` int(11) NOT NULL auto_increment,
  `exclusive_name` char(32) default NULL COMMENT '不可删除，给该类设定的特定名称',
  `cat_name` varchar(50) NOT NULL default '',
  `upper_cat` varchar(20) default NULL,
  `upper_id` int(11) NOT NULL,
  `catname_all` tinytext,
  `is_leaf` tinyint(4) NOT NULL default '1',
  `is_forbidden` tinyint(4) NOT NULL default '0',
  `is_recommend` tinyint(4) NOT NULL default '1',
  `isDel` tinyint(1) default '0' COMMENT '0 未删除',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `contentcat` */

insert  into `contentcat`(`id`,`exclusive_name`,`cat_name`,`upper_cat`,`upper_id`,`catname_all`,`is_leaf`,`is_forbidden`,`is_recommend`,`isDel`) values (1,'','技术部','.',0,'',1,0,1,0),(2,'','策划部','.',0,'',1,0,1,0);

/*Table structure for table `dbhistory` */

DROP TABLE IF EXISTS `dbhistory`;

CREATE TABLE `dbhistory` (
  `id` int(10) NOT NULL auto_increment,
  `optname` varchar(50) NOT NULL,
  `optdate` varchar(50) NOT NULL,
  `dbname` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`,`optname`,`optdate`,`dbname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `dbhistory` */

/*Table structure for table `document` */

DROP TABLE IF EXISTS `document`;

CREATE TABLE `document` (
  `id` int(11) unsigned NOT NULL auto_increment COMMENT '查询id',
  `department` varchar(100) NOT NULL default '' COMMENT '部门',
  `addedDate` date default NULL COMMENT '拟稿日期',
  `author` varchar(100) NOT NULL default '' COMMENT '拟稿人',
  `types` varchar(30) NOT NULL COMMENT '文件类型',
  `file_level` varchar(10) default NULL COMMENT '加密级别',
  `file_no` varchar(100) default NULL COMMENT '编号',
  `file_name` varchar(200) default NULL COMMENT '名称',
  `file_content` varchar(6000) default NULL COMMENT '内容',
  `file_type` varchar(30) default NULL COMMENT '排版:1横排 2竖排',
  `number` varchar(15) default NULL COMMENT '份数',
  `category` varchar(100) default NULL,
  `addtime` date default NULL COMMENT '编码生成时间',
  `ismake` int(1) default '0' COMMENT '是否制作红头文件0：不可制作，1可制作，2：已上传，3：重新上传',
  `flag1` int(1) default '0' COMMENT '拟稿人状态：0：未操作 1：正在操作',
  `flag2` int(1) default '0' COMMENT '制文人状态：0：未操作 1：正在操作',
  `admin` varchar(100) default NULL COMMENT '制文人',
  `isInvalid` int(1) default '0' COMMENT '无效文件：0：有效，1：无效;2:已删除',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `document` */

insert  into `document`(`id`,`department`,`addedDate`,`author`,`types`,`file_level`,`file_no`,`file_name`,`file_content`,`file_type`,`number`,`category`,`addtime`,`ismake`,`flag1`,`flag2`,`admin`,`isInvalid`) values (1,'2','2015-05-15','xiangqian','党组','非密','kwzf15051501','第一次测试制作','第一次测试制作',NULL,'1','.2.','2015-05-15',0,0,1,'xiangqian',0),(2,'2','2015-05-21','李向前','党组','非密',NULL,'党政办公室','党政纪要',NULL,'1','.2.',NULL,0,0,0,NULL,0),(3,'0','2015-05-21','超级管理员','党组','非密',NULL,'机密文件','机密文件',NULL,'1','.',NULL,0,0,0,NULL,0),(4,'0','2015-05-21','超级管理员','党组','非密',NULL,'机密','机密',NULL,'1','.',NULL,0,0,0,NULL,0),(5,'0','2015-05-21','超级管理员','党组','非密',NULL,'制发文件','制发文件',NULL,'1','.',NULL,0,0,0,NULL,0),(6,'0','2015-05-21','超级管理员','党组','非密',NULL,'制发文件1','制发文件',NULL,'1','.',NULL,0,0,0,NULL,0),(7,'0','2015-05-21','超级管理员','党组','非密',NULL,'制发文件2','制发文件',NULL,'1','.',NULL,0,0,0,NULL,0),(8,'0','2015-05-21','超级管理员','党组','非密',NULL,'党组党组','党组党组',NULL,'1','.',NULL,0,0,0,NULL,0),(9,'0','2015-05-21','超级管理员','党组','非密',NULL,'第一次创建','第一次创建',NULL,'1','.',NULL,0,0,0,NULL,0),(13,'2','2015-05-21','李向前','党组','非密',NULL,'党组织','建设&nbsp;&nbsp;&nbsp; 1',NULL,'1','.2.',NULL,0,0,0,NULL,0),(14,'2','2015-05-23','李向前','党组','非密',NULL,'添加制发文件','添加制发文件',NULL,'1','.2.',NULL,0,0,0,NULL,0),(15,'2','2015-05-25','李向前','党组','非密','kwzf15052501','再次创建','&nbsp;&nbsp;&nbsp;123',NULL,'1','.2.','2015-05-25',0,0,1,'xiangqian',0),(16,'0','2015-05-26','超级管理员','党组','非密',NULL,'制发文件创建1','制发文件创建1',NULL,'1','.',NULL,0,0,0,NULL,0);

/*Table structure for table `loginfo` */

DROP TABLE IF EXISTS `loginfo`;

CREATE TABLE `loginfo` (
  `id` int(10) NOT NULL auto_increment,
  `opt` varchar(50) NOT NULL,
  `username` varchar(30) default NULL,
  `timedata` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `loginfo` */

insert  into `loginfo`(`id`,`opt`,`username`,`timedata`) values (1,'修改用户信息','超级管理员','2015-05-26 11:24:35'),(2,'修改用户信息','超级管理员','2015-05-26 12:25:59'),(3,'修改用户信息','超级管理员','2015-05-26 12:27:12'),(4,'创建制发文件','超级管理员','2015-05-26 12:30:05'),(5,'修改用户信息','超级管理员','2015-05-26 13:44:34'),(6,'修改用户信息','超级管理员','2015-05-26 13:46:26'),(7,'修改用户信息','超级管理员','2015-05-26 13:47:26'),(8,'添加用户信息','超级管理员','2015-05-26 13:50:11'),(9,'删除用户信息','超级管理员','2015-05-26 13:56:32'),(10,'恢复删除的用户信息','超级管理员','2015-05-26 13:56:38'),(11,'修改用户信息','超级管理员','2015-05-26 13:57:50'),(12,'修改通讯录信息','马擎天','2015-05-26 14:26:36'),(13,'修改用户信息','超级管理员','2015-05-26 14:58:40'),(14,'修改文件','李向前','2015-05-26 15:01:01'),(15,'删除文件','李向前','2015-05-26 15:01:19'),(16,'创建制发文件','李向前','2015-05-26 15:13:15'),(17,'创建制发文件','李向前','2015-05-26 15:14:39'),(18,'删除文件','李向前','2015-05-26 15:15:29');

/*Table structure for table `smsinfo` */

DROP TABLE IF EXISTS `smsinfo`;

CREATE TABLE `smsinfo` (
  `id` int(11) NOT NULL auto_increment,
  `content` text NOT NULL,
  `smsId` text,
  `smsPhone` text NOT NULL,
  `isSent` varchar(300) NOT NULL default '1',
  `admin_id` int(11) NOT NULL COMMENT '发件人',
  `sendtime` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `category` varchar(90) NOT NULL,
  `sentCount` int(11) default '0' COMMENT '已发送条数',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `smsinfo` */

insert  into `smsinfo`(`id`,`content`,`smsId`,`smsPhone`,`isSent`,`admin_id`,`sendtime`,`category`,`sentCount`) values (1,'下午开会【通州科委】请回复编号“0001”+要回复复的正文信息','9;10;11;12;','15888886666;13689586666;15963258963;18236957896;','1;1;1;1;',2,'2015-05-19 11:03:05','.1.4.',0),(2,'这只是一个测试【京顺晨】请回复编号“0002”+要回复复的正文信息','21;22;23;','15810071704;13552283673;13522543922;','1',2,'2015-05-20 09:56:29','.1.4.',0),(40,'测试信息【通州科委】','110;0;','15810071704;10010;','0;0;',3,'2015-05-25 13:57:49','.1.3.',0),(41,'这是一条测试信息【通州科委】请回复编号“0029”+要回复复的正文信息','110;112;0;','15810071704;13522543922;10010;','1;1;1;',3,'2015-05-25 18:34:35','.1.3.',0),(42,'打扰了【测试信息】请回复编号“002a”+要回复复的正文信息','0;','10010;','0;',3,'2015-05-26 17:28:11','.1.3.',0);

/*Table structure for table `smslistcat` */

DROP TABLE IF EXISTS `smslistcat`;

CREATE TABLE `smslistcat` (
  `id` int(11) NOT NULL auto_increment,
  `exclusive_name` char(32) default NULL COMMENT '不可删除，给该类设定的特定名称',
  `cat_name` varchar(50) NOT NULL default '',
  `upper_cat` varchar(20) default NULL,
  `upper_id` int(11) NOT NULL,
  `catname_all` tinytext,
  `is_leaf` tinyint(4) NOT NULL default '1',
  `is_forbidden` tinyint(4) NOT NULL default '0',
  `user_id` int(11) NOT NULL COMMENT '用户id',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `smslistcat` */

insert  into `smslistcat`(`id`,`exclusive_name`,`cat_name`,`upper_cat`,`upper_id`,`catname_all`,`is_leaf`,`is_forbidden`,`user_id`) values (13,NULL,'领导','.',0,NULL,0,0,3),(14,NULL,'总经理','.13.',13,NULL,1,0,3),(15,NULL,'副总经理','.13.',13,NULL,1,0,3),(16,NULL,'服务中心','.',0,NULL,0,0,3),(17,NULL,'工程','.16.',16,NULL,1,0,3),(18,NULL,'维护','.16.',16,NULL,1,0,3),(19,NULL,'西直门','.',0,NULL,0,0,3),(20,NULL,'技术部','.19.',19,NULL,1,0,3),(21,NULL,'领导','.',0,NULL,0,0,2),(22,NULL,'总经理','.21.',21,NULL,1,0,2),(23,NULL,'副总经理','.21.',21,NULL,1,0,2),(24,NULL,'服务中心','.',0,NULL,0,0,2),(25,NULL,'工程','.24.',24,NULL,1,0,2),(26,NULL,'维护','.24.',24,NULL,1,0,2),(27,NULL,'西直门','.',0,NULL,0,0,2),(28,NULL,'技术部','.27.',27,NULL,1,0,2),(71,NULL,'领导','.',0,NULL,0,0,4),(72,NULL,'副总经理','.71.',71,NULL,1,0,4),(73,NULL,'服务中心','.',0,NULL,0,0,4),(74,NULL,'工程','.73.',73,NULL,1,0,4),(75,NULL,'总经理','.71.',71,NULL,1,0,4),(76,NULL,'西直门','.',0,NULL,0,0,4),(77,NULL,'技术部','.76.',76,NULL,1,0,4),(78,NULL,'维护','.73.',73,NULL,1,0,4);

/*Table structure for table `smslistinfo` */

DROP TABLE IF EXISTS `smslistinfo`;

CREATE TABLE `smslistinfo` (
  `id` int(11) NOT NULL auto_increment COMMENT '搜索ID',
  `category` varchar(90) NOT NULL,
  `name` varchar(30) NOT NULL COMMENT '姓名',
  `tel` varchar(11) default '' COMMENT '手机号码',
  `company` varchar(50) default '' COMMENT '公司',
  `job` varchar(100) default '' COMMENT '职务',
  `admin_id` int(4) default NULL COMMENT '会员id',
  `add_time` timestamp NULL default CURRENT_TIMESTAMP,
  `ids` varchar(200) default NULL COMMENT '允许他人导出通讯录的他人id',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `smslistinfo` */

insert  into `smslistinfo`(`id`,`category`,`name`,`tel`,`company`,`job`,`admin_id`,`add_time`,`ids`) values (17,'.21.22.','杨松','15888886666','北京千松科技发展有限公司','总经理',2,'2015-05-19 09:04:26',NULL),(18,'.21.23.','张洪?','13689586666','北京千松科技发展有限公司','副总经理',2,'2015-05-19 09:04:26',NULL),(19,'.24.25.','刘文元','15963258963','','',2,'2015-05-19 09:04:26',NULL),(20,'.24.26.','张佳玉','18236957896','','',2,'2015-05-19 09:04:26',NULL),(21,'.27.28.','王乐','15810071704','','',2,'2015-05-19 09:04:26',NULL),(22,'.27.28.','高雪','13552283673','','',2,'2015-05-19 09:04:26',NULL),(23,'.27.28.','赵晓刚','13522543922','','',2,'2015-05-19 09:04:26',NULL),(24,'.27.28.','郑艳艳','15124290380','','',2,'2015-05-19 09:04:26',NULL),(97,'.71.72.','张洪?','13689586666','北京千松科技发展有限公司','副总',4,'2015-05-23 17:45:24',NULL),(99,'.73.74.','刘文元','15963258963','','',4,'2015-05-23 17:45:24',NULL),(100,'.71.75.','杨松','15888886666','北京千松科技发展有限公司','总经理',4,'2015-05-23 17:45:24',NULL),(101,'.76.77.','王乐','15810071704','','',4,'2015-05-23 17:45:24',NULL),(102,'.76.77.','高雪','13552283673','','',4,'2015-05-23 17:45:24',NULL),(103,'.76.77.','赵晓刚','13522543922','','',4,'2015-05-23 17:45:24',NULL),(104,'.76.77.','郑艳艳','1512429038','','',4,'2015-05-23 17:45:24',NULL),(105,'.73.78.','张佳玉','18236957896','','',4,'2015-05-23 17:45:24',NULL),(106,'.13.15.','张洪?','13689586666','北京千松科技发展有限公司','副总',3,'2015-05-25 10:47:37',NULL),(108,'.16.17.','刘文元','15963258963','','',3,'2015-05-25 10:47:37',NULL),(109,'.13.14.','杨松','15888886666','北京千松科技发展有限公司','总经理',3,'2015-05-25 10:47:37',NULL),(110,'.19.20.','王乐','15810071704','','',3,'2015-05-25 10:47:37',NULL),(111,'.19.20.','高雪','13552283673','','',3,'2015-05-25 10:47:37',NULL),(112,'.19.20.','赵晓刚','13522543922','','',3,'2015-05-25 10:47:37',NULL),(113,'.19.20.','郑艳艳','15124290380','','',3,'2015-05-25 10:47:37',NULL),(114,'.16.18.','张佳玉','18236957896','','',3,'2015-05-25 10:47:37',NULL);

/*Table structure for table `smsreply` */

DROP TABLE IF EXISTS `smsreply`;

CREATE TABLE `smsreply` (
  `id` int(11) NOT NULL auto_increment,
  `replyPhone` varchar(20) NOT NULL,
  `replyContent` text NOT NULL,
  `replyTime` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `smsreply` */

insert  into `smsreply`(`id`,`replyPhone`,`replyContent`,`replyTime`) values (1,'10010','截至2015年05月21日，您的帐户可用余额为17.50元。\r\n 本数据仅供参考，详情以当地营业厅查询为准。\r\n 【全场狂欢1折起 http://10010.com/0517】','2015-05-21 07:41:46'),(2,'10010','截至2015年05月21日，您的帐户可用余额为17.50元。\r\n 本数据仅供参考，详情以当地营业厅查询为准。\r\n 【全场狂欢1折起 http://10010.com/0517】','2015-05-21 07:44:47'),(3,'10010','截至2015年05月21日，您的帐户可用余额为17.50元。\r\n 本数据仅供参考，详情以当地营业厅查询为准。\r\n 【全场狂欢1折起 http://10010.com/0517】','2015-05-21 07:51:43'),(4,'10010','截至2015年05月21日，您的帐户可用余额为17.50元。\r\n 本数据仅供参考，详情以当地营业厅查询为准。\r\n 【全场狂欢1折起 http://10010.com/0517】','2015-05-21 07:51:46'),(5,'10010','截至2015年05月21日，您的帐户可用余额为17.50元。\r\n 本数据仅供参考，详情以当地营业厅查询为准。\r\n 【4G明星机99元抢 http://10010.com/0517 】','2015-05-21 08:19:12'),(6,'10010','截至2015年05月22日，您的帐户可用余额为17.50元。\r\n 本数据仅供参考，详情以当地营业厅查询为准。\r\n 【买4G就上 m.10010.com】','2015-05-22 10:09:16'),(7,'10010','截至2015年05月22日，您的帐户可用余额为17.50元。\r\n 本数据仅供参考，详情以当地营业厅查询为准。\r\n 【买4G就上 m.10010.com】','2015-05-22 10:09:08'),(8,'10010','截至2015年05月22日，您的帐户可用余额为17.50元。\r\n 本数据仅供参考，详情以当地营业厅查询为准。\r\n 【买4G就上 m.10010.com】','2015-05-22 03:17:03'),(9,'10010','截至2015年05月22日，您的帐户可用余额为17.40元。\r\n 本数据仅供参考，详情以当地营业厅查询为准。\r\n 【买4G就上 m.10010.com】','2015-05-22 03:17:03'),(10,'10010','截至2015年05月22日，您的帐户可用余额为17.40元。\r\n 本数据仅供参考，详情以当地营业厅查询为准。\r\n 【买4G就上 m.10010.com】','2015-05-22 06:08:41'),(11,'10010','截至2015年05月22日，您的帐户可用余额为17.20元。\r\n 本数据仅供参考，详情以当地营业厅查询为准。\r\n 【买4G就上 m.10010.com】','2015-05-22 06:09:53'),(12,'10010','截至2015年05月22日，您的帐户可用余额为17.20元。\r\n 本数据仅供参考，详情以当地营业厅查询为准。\r\n 【买4G就上 m.10010.com】','2015-05-22 06:11:54'),(13,'10010','截至2015年05月22日，您的帐户可用余额为17.20元。\r\n 本数据仅供参考，详情以当地营业厅查询为准。\r\n 【买4G就上 m.10010.com】','2015-05-22 06:11:47'),(15,'10010','截至2015年05月23日，您的帐户可用余额为17.20元。\r\n 本数据仅供参考，详情以当地营业厅查询为准。\r\n 【买4G就上 m.10010.com】','2015-05-23 02:07:48'),(16,'10010','尊敬的用户，请回复以下编码办理业务：\r\n 101：当月话费\r\n 102：可用余额\r\n 0：升级4G\r\n 1：话费及积分\r\n 2：账户查询\r\n 3：充值\r\n 4：客户服务\r\n 5：业务受理\r\n 6：增值业务\r\n 7：省份专区\r\n 9：流量包\r\n 【买4G就上 m.10010.com】','2015-05-23 02:28:09'),(17,'10010','截至2015年05月23日，您的帐户可用余额为17.20元。\r\n 本数据仅供参考，详情以当地营业厅查询为准。\r\n 【买4G就上 m.10010.com】','2015-05-23 02:28:09'),(18,'10010','尊敬的用户，请回复以下编码办理业务：\r\n 101：当月话费\r\n 102：可用余额\r\n 0：升级4G\r\n 1：话费及积分\r\n 2：账户查询\r\n 3：充值\r\n 4：客户服务\r\n 5：业务受理\r\n 6：增值业务\r\n 7：省份专区\r\n 9：流量包\r\n 【买4G就上 m.10010.com】','2015-05-23 03:02:44'),(19,'10010','尊敬的用户，请回复以下编码办理业务：\r\n 101：当月话费\r\n 102：可用余额\r\n 0：升级4G\r\n 1：话费及积分\r\n 2：账户查询\r\n 3：充值\r\n 4：客户服务\r\n 5：业务受理\r\n 6：增值业务\r\n 7：省份专区\r\n 9：流量包\r\n 【买4G就上 m.10010.com】','2015-05-23 03:14:09'),(20,'10010','尊敬的用户，请回复以下编码办理业务：\r\n 101：当月话费\r\n 102：可用余额\r\n 0：升级4G\r\n 1：话费及积分\r\n 2：账户查询\r\n 3：充值\r\n 4：客户服务\r\n 5：业务受理\r\n 6：增值业务\r\n 7：省份专区\r\n 9：流量包\r\n 【买4G就上 m.10010.com】','2015-05-23 03:34:42'),(21,'10010','截至2015年05月23日，您的帐户可用余额为16.70元。\r\n 本数据仅供参考，详情以当地营业厅查询为准。\r\n 【买4G就上 m.10010.com】','2015-05-23 03:34:54'),(22,'10010','尊敬的用户，请回复以下编码办理业务：\r\n 601：已订业务查询\r\n 5081：业务介绍\r\n 203：业务受理记录\r\n 5101：取消国际业务\r\n 724：申请增值业务\r\n 【买4G就上 m.10010.com】','2015-05-23 03:40:22'),(23,'10010','截至2015年05月23日，您的帐户可用余额为16.60元。\r\n 本数据仅供参考，详情以当地营业厅查询为准。\r\n 【买4G就上 m.10010.com】','2015-05-23 03:40:26'),(24,'10010','尊敬的用户，请回复以下编码办理业务：\r\n 101：当月话费\r\n 102：可用余额\r\n 0：升级4G\r\n 1：话费及积分\r\n 2：账户查询\r\n 3：充值\r\n 4：客户服务\r\n 5：业务受理\r\n 6：增值业务\r\n 7：省份专区\r\n 9：流量包\r\n 【买4G就上 m.10010.com】','2015-05-23 03:52:59'),(25,'10010','截至2015年05月23日，您的帐户可用余额为16.20元。\r\n 本数据仅供参考，详情以当地营业厅查询为准。\r\n 【买4G就上 m.10010.com】','2015-05-23 03:53:07'),(26,'10010','尊敬的用户，请回复以下编码办理业务：\r\n 101：当月话费\r\n 102：可用余额\r\n 0：升级4G\r\n 1：话费及积分\r\n 2：账户查询\r\n 3：充值\r\n 4：客户服务\r\n 5：业务受理\r\n 6：增值业务\r\n 7：省份专区\r\n 9：流量包\r\n 【买4G就上 m.10010.com】','2015-05-23 03:54:47'),(27,'10010','截至2015年05月23日，您的帐户可用余额为15.90元。\r\n 本数据仅供参考，详情以当地营业厅查询为准。\r\n 【买4G就上 m.10010.com】','2015-05-23 03:54:51'),(28,'10010','尊敬的用户，请回复以下编码办理业务：\r\n 101：当月话费\r\n 102：可用余额\r\n 0：升级4G\r\n 1：话费及积分\r\n 2：账户查询\r\n 3：充值\r\n 4：客户服务\r\n 5：业务受理\r\n 6：增值业务\r\n 7：省份专区\r\n 9：流量包\r\n 【买4G就上 m.10010.com】','2015-05-23 04:20:30'),(29,'10010','截至2015年05月23日，您的帐户可用余额为15.70元。\r\n 本数据仅供参考，详情以当地营业厅查询为准。\r\n 【买4G就上 m.10010.com】','2015-05-23 04:20:47'),(30,'10010','截至2015年05月25日，您的帐户可用余额为15.50元。\r\n 本数据仅供参考，详情以当地营业厅查询为准。\r\n 【买4G就上 m.10010.com】','2015-05-25 11:15:09'),(31,'10010','截至2015年05月25日，您的帐户可用余额为15.50元。\r\n 本数据仅供参考，详情以当地营业厅查询为准。\r\n 【买4G就上 m.10010.com】','2015-05-25 11:15:13'),(32,'10010','截至2015年05月25日，您的帐户可用余额为15.50元。\r\n 本数据仅供参考，详情以当地营业厅查询为准。\r\n 【买4G就上 m.10010.com】','2015-05-25 11:23:07'),(33,'10010','截至2015年05月25日，您的帐户可用余额为15.50元。\r\n 本数据仅供参考，详情以当地营业厅查询为准。\r\n 【买4G就上 m.10010.com】','2015-05-25 11:23:17'),(34,'10010','截至2015年05月25日，您的帐户可用余额为15.50元。\r\n 本数据仅供参考，详情以当地营业厅查询为准。\r\n 【买4G就上 m.10010.com】','2015-05-25 11:42:41'),(35,'10010','截至2015年05月25日，您的帐户可用余额为15.50元。\r\n 本数据仅供参考，详情以当地营业厅查询为准。\r\n 【买4G就上 m.10010.com】','2015-05-25 11:43:01'),(36,'10010','截至2015年05月25日，您的帐户可用余额为15.50元。\r\n 本数据仅供参考，详情以当地营业厅查询为准。\r\n 【买4G就上 m.10010.com】','2015-05-25 11:43:05'),(37,'10010','尊敬的用户，请回复以下编码办理业务：\r\n 101：当月话费\r\n 102：可用余额\r\n 0：升级4G\r\n 1：话费及积分\r\n 2：账户查询\r\n 3：充值\r\n 4：客户服务\r\n 5：业务受理\r\n 6：增值业务\r\n 7：省份专区\r\n 9：流量包\r\n 【买4G就上 m.10010.com】','2015-05-25 11:43:40'),(38,'10010','截至2015年05月25日，您的帐户可用余额为15.50元。\r\n 本数据仅供参考，详情以当地营业厅查询为准。\r\n 【买4G就上 m.10010.com】','2015-05-25 11:46:09'),(39,'10010','截至2015年05月25日，您的帐户可用余额为15.50元。\r\n 本数据仅供参考，详情以当地营业厅查询为准。\r\n 【买4G就上 m.10010.com】','2015-05-25 11:46:06'),(40,'10010','尊敬的用户，请回复以下编码办理业务：\r\n 101：当月话费\r\n 102：可用余额\r\n 0：升级4G\r\n 1：话费及积分\r\n 2：账户查询\r\n 3：充值\r\n 4：客户服务\r\n 5：业务受理\r\n 6：增值业务\r\n 7：省份专区\r\n 9：流量包\r\n 【买4G就上 m.10010.com】','2015-05-25 01:59:52'),(41,'10010','截至2015年05月25日，您的帐户可用余额为15.40元。\r\n 本数据仅供参考，详情以当地营业厅查询为准。\r\n 【买4G就上 m.10010.com】','2015-05-25 01:59:52'),(42,'10010','截至2015年05月26日，您的帐户可用余额为15.40元。\r\n 本数据仅供参考，详情以当地营业厅查询为准。\r\n 【买4G就上 m.10010.com】','2015-05-26 05:28:31');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
