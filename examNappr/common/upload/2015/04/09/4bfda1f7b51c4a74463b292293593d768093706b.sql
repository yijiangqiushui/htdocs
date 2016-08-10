/*
SQLyog 企业版 - MySQL GUI v8.14 
MySQL - 5.0.22-community-nt : Database - cms
*********************************************************************
*/
/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`cms` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `cms`;

/*Table structure for table `adinfo` */

DROP TABLE IF EXISTS `adinfo`;

CREATE TABLE `adinfo` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `title_id` INT(11) NOT NULL DEFAULT '0' COMMENT '标题ID',
  `ad_type_id` INT(11) NOT NULL DEFAULT '0' COMMENT '广告类型：横幅、侧边等',
  `description` TINYTEXT COMMENT '广告描述',
  PRIMARY KEY  (`id`),
  KEY `FK_adinfo_title` (`ad_type_id`),
  CONSTRAINT `FK_adinfo_title` FOREIGN KEY (`ad_type_id`) REFERENCES `titleinfo` (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

/*Data for the table `adinfo` */

/*Table structure for table `admincat` */

DROP TABLE IF EXISTS `admincat`;

CREATE TABLE `admincat` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `cat_name` VARCHAR(60) NOT NULL DEFAULT '' COMMENT '分类名称',
  `upper_cat` TINYTEXT COMMENT '上级分类',
  `upper_id` INT(11) NOT NULL DEFAULT '0' COMMENT '上级分类Id',
  `is_forbidden` TINYINT(4) NOT NULL DEFAULT '0' COMMENT '是否禁用',
  `priviledges` TEXT COMMENT '权限',
  `is_leaf` TINYINT(4) NOT NULL DEFAULT '0' COMMENT '是否叶子结点',
  PRIMARY KEY  (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

/*Data for the table `admincat` */

/*Table structure for table `admininfo` */

DROP TABLE IF EXISTS `admininfo`;

CREATE TABLE `admininfo` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `cat_id` INT(11) NOT NULL COMMENT '所属分类Id',
  `category` VARCHAR(90) NOT NULL DEFAULT '' COMMENT '所属分类',
  `username` VARCHAR(32) NOT NULL DEFAULT '' COMMENT '用户名称',
  `pwd` VARCHAR(40) NOT NULL DEFAULT '' COMMENT '用户密码',
  `real_name` VARCHAR(32) NOT NULL DEFAULT '' COMMENT '用户真实姓名',
  `email` VARCHAR(40) NOT NULL DEFAULT '' COMMENT '用户邮箱',
  `is_forbidden` TINYINT(4) NOT NULL DEFAULT '0' COMMENT '用户是否被禁用',
  `add_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '用户添加时间',
  `last_date` TIMESTAMP NULL DEFAULT NULL COMMENT '用户最后登录时间',
  `last_ip` VARCHAR(15) DEFAULT NULL COMMENT '用户最后登录Ip',
  PRIMARY KEY  (`id`),
  KEY `FK_admininfo` (`cat_id`),
  CONSTRAINT `FK_admininfo` FOREIGN KEY (`cat_id`) REFERENCES `admincat` (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `admininfo` */

/*Table structure for table `answerevaluate` */

DROP TABLE IF EXISTS `answerevaluate`;

CREATE TABLE `answerevaluate` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `answer_id` INT(11) NOT NULL DEFAULT '0' COMMENT '回复Id',
  `evaluation` TINYTEXT NOT NULL COMMENT '简短评价',
  PRIMARY KEY  (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

/*Data for the table `answerevaluate` */

/*Table structure for table `answerinfo` */

DROP TABLE IF EXISTS `answerinfo`;

CREATE TABLE `answerinfo` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `question_id` INT(11) NOT NULL DEFAULT '0' COMMENT '标题Id',
  `content` TEXT NOT NULL COMMENT '评论内容',
  `answer_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '评论时间',
  `member_id` INT(11) NOT NULL DEFAULT '0' COMMENT '评论人姓名',
  `is_used` TINYINT(4) NOT NULL DEFAULT '0' COMMENT '答案是否采纳',
  PRIMARY KEY  (`id`),
  KEY `FK_answerinfo_member` (`member_id`),
  KEY `FK_answerinfo` (`question_id`),
  CONSTRAINT `FK_answerinfo` FOREIGN KEY (`question_id`) REFERENCES `questioninfo` (`id`),
  CONSTRAINT `FK_answerinfo_member` FOREIGN KEY (`member_id`) REFERENCES `memberinfo` (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

/*Data for the table `answerinfo` */

/*Table structure for table `applyinfo` */

DROP TABLE IF EXISTS `applyinfo`;

CREATE TABLE `applyinfo` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `job_id` INT(11) NOT NULL DEFAULT '0',
  `fullname` VARCHAR(36) NOT NULL COMMENT '姓名',
  `age` INT(11) NOT NULL DEFAULT '0' COMMENT '年龄',
  `gender` VARCHAR(6) NOT NULL COMMENT '性别',
  `birth_year` TINYINT(4) NOT NULL DEFAULT '0' COMMENT '出生年份',
  `birth_month` TINYINT(4) NOT NULL DEFAULT '0' COMMENT '出生月份',
  `education` VARCHAR(12) NOT NULL COMMENT '文化程度',
  `is_married` TINYINT(4) NOT NULL DEFAULT '0' COMMENT '是否结婚',
  `phone` VARCHAR(15) NOT NULL COMMENT '联系电话',
  `email` VARCHAR(40) DEFAULT NULL,
  `location` TINYTEXT NOT NULL COMMENT '现居住地',
  `reg_residence` VARCHAR(18) NOT NULL COMMENT '户口',
  `self evaluation` TINYTEXT NOT NULL COMMENT '自我评价',
  `resume_file` TINYTEXT NOT NULL COMMENT '提示简历上插入照片',
  PRIMARY KEY  (`id`),
  KEY `FK_applyinfo` (`job_id`),
  CONSTRAINT `FK_applyinfo` FOREIGN KEY (`job_id`) REFERENCES `jobinfo` (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

/*Data for the table `applyinfo` */

/*Table structure for table `blogcat` */

DROP TABLE IF EXISTS `blogcat`;

CREATE TABLE `blogcat` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `member_id` INT(11) NOT NULL,
  `cat_name` VARCHAR(50) NOT NULL DEFAULT '',
  PRIMARY KEY  (`id`),
  KEY `FK_blogcat` (`member_id`),
  CONSTRAINT `FK_blogcat` FOREIGN KEY (`member_id`) REFERENCES `memberinfo` (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

/*Data for the table `blogcat` */

/*Table structure for table `blogcomment` */

DROP TABLE IF EXISTS `blogcomment`;

CREATE TABLE `blogcomment` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `blog_id` INT(11) NOT NULL DEFAULT '0' COMMENT '标题Id',
  `content` TEXT NOT NULL COMMENT '评论内容',
  `comment_grade` TINYINT(4) NOT NULL COMMENT '评价标准好评或差评',
  `comment_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '评论时间',
  `member_id` INT(11) NOT NULL DEFAULT '0' COMMENT '评论人姓名',
  PRIMARY KEY  (`id`),
  KEY `FK_blogcomment` (`blog_id`),
  CONSTRAINT `FK_blogcomment` FOREIGN KEY (`blog_id`) REFERENCES `bloginfo` (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

/*Data for the table `blogcomment` */

/*Table structure for table `bloginfo` */

DROP TABLE IF EXISTS `bloginfo`;

CREATE TABLE `bloginfo` (
  `id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '搜索ID',
  `member_id` INT(11) NOT NULL DEFAULT '0' COMMENT '会员ID',
  `cat_id` INT(11) NOT NULL DEFAULT '0',
  `title` VARCHAR(150) NOT NULL DEFAULT '' COMMENT '信息标题',
  `content` MEDIUMTEXT NOT NULL COMMENT '文章内容',
  `tags` TINYTEXT COMMENT '文章标签',
  `is_check` TINYINT(4) NOT NULL DEFAULT '0' COMMENT '信息是否可以被检索',
  `is_forbodden` TINYINT(4) NOT NULL DEFAULT '0' COMMENT '信息是否被禁用',
  `is_recommend` TINYINT(4) NOT NULL DEFAULT '0' COMMENT '是否推荐',
  `sort_no` INT(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `add_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '添加时间',
  `edit_time` TIMESTAMP NULL DEFAULT NULL COMMENT '修改时间',
  `read_num` INT(11) NOT NULL DEFAULT '0' COMMENT '阅读人数',
  `comment_num` INT(11) NOT NULL DEFAULT '0' COMMENT '评论人数',
  `recommend_num` INT(11) NOT NULL DEFAULT '0' COMMENT '受推荐数量',
  `copied_num` INT(11) NOT NULL DEFAULT '0' COMMENT '转载数量',
  PRIMARY KEY  (`id`),
  KEY `FK_bloginfo_member` (`member_id`),
  KEY `FK_bloginfo` (`cat_id`),
  CONSTRAINT `FK_bloginfo` FOREIGN KEY (`cat_id`) REFERENCES `blogcat` (`id`),
  CONSTRAINT `FK_bloginfo_member` FOREIGN KEY (`member_id`) REFERENCES `memberinfo` (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

/*Data for the table `bloginfo` */

/*Table structure for table `commentinfo` */

DROP TABLE IF EXISTS `commentinfo`;

CREATE TABLE `commentinfo` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `title_id` INT(11) NOT NULL DEFAULT '0' COMMENT '标题Id',
  `content` TEXT NOT NULL COMMENT '评论内容',
  `comment_grade` TINYINT(4) NOT NULL COMMENT '评价标准好评或差评',
  `comment_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '评论时间',
  `member_id` INT(11) NOT NULL DEFAULT '0' COMMENT '评论人姓名',
  PRIMARY KEY  (`id`),
  KEY `FK_commentinfo_member` (`member_id`),
  KEY `FK_commentinfo` (`title_id`),
  CONSTRAINT `FK_commentinfo` FOREIGN KEY (`title_id`) REFERENCES `titleinfo` (`id`),
  CONSTRAINT `FK_commentinfo_member` FOREIGN KEY (`member_id`) REFERENCES `memberinfo` (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

/*Data for the table `commentinfo` */

/*Table structure for table `contentinfo` */

DROP TABLE IF EXISTS `contentinfo`;

CREATE TABLE `contentinfo` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `title_id` INT(11) NOT NULL DEFAULT '0' COMMENT '标题Id',
  `brief_ctnt` TINYTEXT,
  `content` MEDIUMTEXT NOT NULL COMMENT '文章内容',
  `brief_title` VARCHAR(60) NOT NULL DEFAULT '' COMMENT '简短标题',
  `priviledges` TINYINT(4) NOT NULL DEFAULT '0' COMMENT '开放浏览、待审核、注册会员、高级会员等 ',
  `coin` INT(11) NOT NULL DEFAULT '0' COMMENT '下载文章需要多少积分',
  `tags` TINYTEXT COMMENT '文章标签',
  `source` VARCHAR(90) NOT NULL DEFAULT '' COMMENT '文章来源',
  PRIMARY KEY  (`id`),
  KEY `FK_contentinfo` (`title_id`),
  CONSTRAINT `FK_contentinfo` FOREIGN KEY (`title_id`) REFERENCES `titleinfo` (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

/*Data for the table `contentinfo` */

/*Table structure for table `fileinfo` */

DROP TABLE IF EXISTS `fileinfo`;

CREATE TABLE `fileinfo` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `title_id` INT(11) NOT NULL DEFAULT '0',
  `file_path` TINYTEXT NOT NULL COMMENT '文件夹路径',
  `file_ext` VARCHAR(5) NOT NULL DEFAULT '' COMMENT '文件后缀名',
  `file_size` INT(11) NOT NULL DEFAULT '0',
  `brief_ctnt` TINYTEXT COMMENT '简单介绍',
  PRIMARY KEY  (`id`),
  KEY `FK_fileinfo` (`title_id`),
  CONSTRAINT `FK_fileinfo` FOREIGN KEY (`title_id`) REFERENCES `titleinfo` (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

/*Data for the table `fileinfo` */

/*Table structure for table `guestbook` */

DROP TABLE IF EXISTS `guestbook`;

CREATE TABLE `guestbook` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `content` TEXT NOT NULL COMMENT '评论内容',
  `post_time` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP COMMENT '评论时间',
  `member_id` INT(11) NOT NULL DEFAULT '0' COMMENT '评论人姓名',
  `reply` TEXT COMMENT '回复',
  `gender` VARCHAR(6) DEFAULT NULL COMMENT '性别',
  `qq` VARCHAR(12) DEFAULT NULL,
  `email` VARCHAR(40) DEFAULT NULL,
  `icon` TINYINT(4) DEFAULT NULL COMMENT '头像选择',
  PRIMARY KEY  (`id`),
  KEY `FK_guestbook` (`member_id`),
  CONSTRAINT `FK_guestbook` FOREIGN KEY (`member_id`) REFERENCES `memberinfo` (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

/*Data for the table `guestbook` */

/*Table structure for table `ipallowed` */

DROP TABLE IF EXISTS `ipallowed`;

CREATE TABLE `ipallowed` (
  `id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '被允许IP访问的ID',
  `ip` VARCHAR(15) NOT NULL DEFAULT '' COMMENT 'ip地址',
  `is_allowed` TINYINT(4) NOT NULL COMMENT 'ip是否被禁用',
  `forbidden_date` DATE NOT NULL COMMENT 'ip禁止时间',
  PRIMARY KEY  (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

/*Data for the table `ipallowed` */

/*Table structure for table `ipforbidden` */

DROP TABLE IF EXISTS `ipforbidden`;

CREATE TABLE `ipforbidden` (
  `id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '被禁止IP访问的ID',
  `ip` VARCHAR(15) NOT NULL DEFAULT '' COMMENT 'ip地址',
  `is_forbidden` TINYINT(4) NOT NULL COMMENT 'ip是否被禁用',
  `allowed_date` DATE NOT NULL COMMENT 'ip解封时间',
  PRIMARY KEY  (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

/*Data for the table `ipforbidden` */

/*Table structure for table `jobinfo` */

DROP TABLE IF EXISTS `jobinfo`;

CREATE TABLE `jobinfo` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `title_id` INT(11) NOT NULL DEFAULT '0',
  `work_location` TINYTEXT NOT NULL COMMENT '工作地点',
  `responsibility` TEXT NOT NULL COMMENT '工作职责',
  `qualification` TEXT NOT NULL COMMENT '任职资格',
  `memo` TINYTEXT NOT NULL COMMENT '备忘',
  `add_time` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`),
  KEY `FK_jobinfo` (`title_id`),
  CONSTRAINT `FK_jobinfo` FOREIGN KEY (`title_id`) REFERENCES `titleinfo` (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

/*Data for the table `jobinfo` */

/*Table structure for table `linkinfo` */

DROP TABLE IF EXISTS `linkinfo`;

CREATE TABLE `linkinfo` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `title_id` INT(11) NOT NULL DEFAULT '0' COMMENT '标题Id',
  `url_js` TINYTEXT NOT NULL COMMENT '连接地址或js调用函数',
  `is_url_js` TINYINT(4) NOT NULL DEFAULT '0' COMMENT '选择点击类型，链接或js',
  PRIMARY KEY  (`id`),
  KEY `FK_linkinfo` (`title_id`),
  CONSTRAINT `FK_linkinfo` FOREIGN KEY (`title_id`) REFERENCES `titleinfo` (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

/*Data for the table `linkinfo` */

/*Table structure for table `loginfo` */

DROP TABLE IF EXISTS `loginfo`;

CREATE TABLE `loginfo` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `admin_id` INT(11) NOT NULL DEFAULT '0',
  `operation` VARCHAR(36) NOT NULL,
  `log` TINYTEXT NOT NULL,
  `oprt_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`),
  KEY `FK_loginfo` (`admin_id`),
  CONSTRAINT `FK_loginfo` FOREIGN KEY (`admin_id`) REFERENCES `admininfo` (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

/*Data for the table `loginfo` */

/*Table structure for table `membercard` */

DROP TABLE IF EXISTS `membercard`;

CREATE TABLE `membercard` (
  `member_id` INT(11) NOT NULL,
  `card_no` VARCHAR(20) NOT NULL COMMENT '会员卡号',
  PRIMARY KEY  (`member_id`),
  CONSTRAINT `FK_membercard` FOREIGN KEY (`member_id`) REFERENCES `memberinfo` (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

/*Data for the table `membercard` */

/*Table structure for table `membergroup` */

DROP TABLE IF EXISTS `membergroup`;

CREATE TABLE `membergroup` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `group_name` VARCHAR(20) NOT NULL COMMENT '会员组名称',
  `priviledges` TEXT NOT NULL COMMENT '会员权限',
  `point` INT(11) NOT NULL COMMENT '会员积分',
  PRIMARY KEY  (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

/*Data for the table `membergroup` */

/*Table structure for table `memberinfo` */

DROP TABLE IF EXISTS `memberinfo`;

CREATE TABLE `memberinfo` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `group_id` INT(11) NOT NULL COMMENT '会员组Id',
  `username` VARCHAR(32) NOT NULL DEFAULT '' COMMENT '会员用户名',
  `pwd` VARCHAR(32) NOT NULL COMMENT '会员注册密码',
  `encrypt` VARCHAR(10) NOT NULL DEFAULT '' COMMENT '补充加密',
  `phone` VARCHAR(15) NOT NULL DEFAULT '' COMMENT '会员注册电话',
  `email` VARCHAR(40) NOT NULL DEFAULT '' COMMENT '会员注册邮箱',
  `nickname` VARCHAR(20) NOT NULL COMMENT '会员昵称',
  `icon` VARCHAR(30) NOT NULL COMMENT '会员头像',
  `reg_date` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP COMMENT '会员注册时间',
  `overdue_date` TIMESTAMP NULL DEFAULT NULL COMMENT '会员过期时间',
  `point` INT(11) NOT NULL COMMENT '会员积分',
  `login_date` TIMESTAMP NULL DEFAULT NULL COMMENT '会员登录时间',
  `last_date` TIMESTAMP NULL DEFAULT NULL COMMENT '会员最后登录时间',
  PRIMARY KEY  (`id`),
  KEY `FK_memberinfo_group` (`group_id`),
  CONSTRAINT `FK_memberinfo_group` FOREIGN KEY (`group_id`) REFERENCES `membergroup` (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

/*Data for the table `memberinfo` */

/*Table structure for table `msginfo` */

DROP TABLE IF EXISTS `msginfo`;

CREATE TABLE `msginfo` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(150) NOT NULL COMMENT '标题',
  `receiver_id` INT(11) NOT NULL DEFAULT '0' COMMENT '接收者ID',
  `member_id` INT(11) NOT NULL DEFAULT '0' COMMENT '发送者ID',
  `content` TEXT NOT NULL COMMENT '发送信息内容',
  `send_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `receiver_del` TINYINT(4) NOT NULL DEFAULT '0',
  `sender_del` TINYINT(4) NOT NULL DEFAULT '0',
  `receiver_viewed` TINYINT(4) NOT NULL DEFAULT '0',
  PRIMARY KEY  (`id`),
  KEY `FK_msginfo` (`member_id`),
  CONSTRAINT `FK_msginfo` FOREIGN KEY (`member_id`) REFERENCES `memberinfo` (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

/*Data for the table `msginfo` */

/*Table structure for table `noticeinfo` */

DROP TABLE IF EXISTS `noticeinfo`;

CREATE TABLE `noticeinfo` (
  `id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '公告ID',
  `title_id` INT(11) NOT NULL DEFAULT '0' COMMENT '标题ID',
  `content` VARCHAR(20) NOT NULL COMMENT '公告内容',
  `start_date` DATE NOT NULL COMMENT '发布时间',
  `end_date` DATE NOT NULL COMMENT '下线时间',
  `admin_id` INT(11) NOT NULL COMMENT '此公告由谁发布',
  PRIMARY KEY  (`id`),
  KEY `FK_noticeinfo` (`title_id`),
  CONSTRAINT `FK_noticeinfo` FOREIGN KEY (`title_id`) REFERENCES `titleinfo` (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

/*Data for the table `noticeinfo` */

/*Table structure for table `orderinfo` */

DROP TABLE IF EXISTS `orderinfo`;

CREATE TABLE `orderinfo` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `order_no` VARCHAR(15) NOT NULL,
  `member_id` INT(11) NOT NULL DEFAULT '0',
  `member_name` VARCHAR(36) DEFAULT NULL,
  `address` VARCHAR(90) NOT NULL DEFAULT '',
  `email` VARCHAR(40) DEFAULT NULL,
  `phone` VARCHAR(15) NOT NULL DEFAULT '',
  `total_price` FLOAT NOT NULL DEFAULT '0',
  `is_invoice` TINYINT(4) NOT NULL DEFAULT '0',
  `invoice_name` VARCHAR(60) DEFAULT NULL,
  PRIMARY KEY  (`id`),
  KEY `FK_orderinfo` (`member_id`),
  CONSTRAINT `FK_orderinfo` FOREIGN KEY (`member_id`) REFERENCES `memberinfo` (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

/*Data for the table `orderinfo` */

/*Table structure for table `orderiteminfo` */

DROP TABLE IF EXISTS `orderiteminfo`;

CREATE TABLE `orderiteminfo` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `order_id` INT(11) NOT NULL DEFAULT '0',
  `title_id` INT(11) NOT NULL DEFAULT '0' COMMENT '跟productinfo关联',
  PRIMARY KEY  (`id`),
  KEY `FK_orderiteminfo` (`title_id`),
  KEY `FK_orderiteminfo_item` (`order_id`),
  CONSTRAINT `FK_orderiteminfo` FOREIGN KEY (`title_id`) REFERENCES `titleinfo` (`id`),
  CONSTRAINT `FK_orderiteminfo_item` FOREIGN KEY (`order_id`) REFERENCES `orderinfo` (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

/*Data for the table `orderiteminfo` */

/*Table structure for table `paramsetter` */

DROP TABLE IF EXISTS `paramsetter`;

CREATE TABLE `paramsetter` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `cat_id` INT(11) NOT NULL DEFAULT '0' COMMENT '某一分类下产品全部使用该参数',
  `parameters` TEXT COMMENT '扩展参数：参数名,参数类型(text,number,checkbox,radio),选项1&选项2|参数名...',
  PRIMARY KEY  (`id`),
  KEY `FK_paramsetter` (`cat_id`),
  CONSTRAINT `FK_paramsetter` FOREIGN KEY (`cat_id`) REFERENCES `titlecat` (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

/*Data for the table `paramsetter` */

/*Table structure for table `productinfo` */

DROP TABLE IF EXISTS `productinfo`;

CREATE TABLE `productinfo` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `title_id` INT(11) NOT NULL,
  `price` FLOAT NOT NULL DEFAULT '0',
  `discount_price` FLOAT NOT NULL DEFAULT '0' COMMENT '折扣价格，促销价',
  `disc_start_date` DATE DEFAULT NULL,
  `discount_days` TINYINT(4) NOT NULL DEFAULT '0',
  `brief_ctnt` TINYTEXT,
  `description` TEXT COMMENT '产品描述',
  `store_quantity` INT(11) NOT NULL DEFAULT '0' COMMENT '产品数量',
  `sell_quantity` INT(11) NOT NULL DEFAULT '0',
  `parameters` TEXT COMMENT '扩展参数：参数名,值',
  `param_name_1` FLOAT DEFAULT NULL COMMENT '扩展参数',
  `param_unit_1` VARCHAR(10) DEFAULT NULL COMMENT '单位',
  `param_name_2` FLOAT DEFAULT NULL COMMENT '扩展参数',
  `param_unit_2` VARCHAR(10) DEFAULT NULL COMMENT '单位',
  `param_name_3` FLOAT DEFAULT NULL COMMENT '扩展参数',
  `param_unit_3` VARCHAR(10) DEFAULT NULL COMMENT '单位',
  PRIMARY KEY  (`id`),
  KEY `FK_productinfo` (`title_id`),
  CONSTRAINT `FK_productinfo` FOREIGN KEY (`title_id`) REFERENCES `titleinfo` (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

/*Data for the table `productinfo` */

/*Table structure for table `questioncat` */

DROP TABLE IF EXISTS `questioncat`;

CREATE TABLE `questioncat` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `cat_name` VARCHAR(50) NOT NULL DEFAULT '',
  `upper_cat` TINYTEXT,
  `upper_id` INT(11) NOT NULL,
  `is_leaf` TINYINT(4) NOT NULL DEFAULT '0',
  `sort_no` INT(11) NOT NULL DEFAULT '0',
  `is_forbidden` TINYINT(4) NOT NULL DEFAULT '0',
  `is_recommend` TINYINT(4) NOT NULL DEFAULT '0',
  PRIMARY KEY  (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

/*Data for the table `questioncat` */

/*Table structure for table `questioninfo` */

DROP TABLE IF EXISTS `questioninfo`;

CREATE TABLE `questioninfo` (
  `id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '搜索ID',
  `member_id` INT(11) NOT NULL DEFAULT '0' COMMENT '会员ID',
  `cat_id` INT(11) NOT NULL DEFAULT '0',
  `category` VARCHAR(90) DEFAULT NULL,
  `title` VARCHAR(150) NOT NULL DEFAULT '' COMMENT '信息标题',
  `content` MEDIUMTEXT NOT NULL COMMENT '文章内容',
  `is_check` TINYINT(4) NOT NULL DEFAULT '0' COMMENT '信息是否可以被检索',
  `is_forbodden` TINYINT(4) NOT NULL DEFAULT '0' COMMENT '信息是否被禁用',
  `is_recommend` TINYINT(4) NOT NULL DEFAULT '0' COMMENT '是否推荐',
  `sort_no` INT(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `add_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '添加时间',
  `edit_time` TIMESTAMP NULL DEFAULT NULL COMMENT '修改时间',
  `read_num` INT(11) NOT NULL DEFAULT '0' COMMENT '阅读人数',
  `reply_num` INT(11) NOT NULL DEFAULT '0' COMMENT '回复人数',
  PRIMARY KEY  (`id`),
  KEY `FK_questioninfo` (`cat_id`),
  KEY `FK_questioninfo_member` (`member_id`),
  CONSTRAINT `FK_questioninfo` FOREIGN KEY (`cat_id`) REFERENCES `questioncat` (`id`),
  CONSTRAINT `FK_questioninfo_member` FOREIGN KEY (`member_id`) REFERENCES `memberinfo` (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

/*Data for the table `questioninfo` */

/*Table structure for table `report` */

DROP TABLE IF EXISTS `report`;

CREATE TABLE `report` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `member_id` INT(11) NOT NULL DEFAULT '0' COMMENT '举报人ID',
  `blog_id` INT(11) NOT NULL DEFAULT '0',
  `reason` TINYTEXT NOT NULL COMMENT '举报原因，可以列出几个常见原因供选择',
  PRIMARY KEY  (`id`),
  KEY `FK_report` (`member_id`),
  KEY `FK_report_blog` (`blog_id`),
  CONSTRAINT `FK_report` FOREIGN KEY (`member_id`) REFERENCES `memberinfo` (`id`),
  CONSTRAINT `FK_report_blog` FOREIGN KEY (`blog_id`) REFERENCES `bloginfo` (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

/*Data for the table `report` */

/*Table structure for table `sensitiveinfo` */

DROP TABLE IF EXISTS `sensitiveinfo`;

CREATE TABLE `sensitiveinfo` (
  `id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '敏感词ID',
  `snstv_words` VARCHAR(20) NOT NULL DEFAULT '' COMMENT '敏感词',
  `rplce_words` VARCHAR(20) NOT NULL DEFAULT '' COMMENT '替换词',
  `snstv_grade` TINYINT(4) NOT NULL COMMENT '敏感级别，如果为一般级别可用替换词替换；如果为危险级别直接过滤掉',
  PRIMARY KEY  (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

/*Data for the table `sensitiveinfo` */

/*Table structure for table `siteinfo_cn` */

DROP TABLE IF EXISTS `siteinfo_cn`;

CREATE TABLE `siteinfo_cn` (
  `id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '站点ID',
  `site_name` VARCHAR(20) NOT NULL DEFAULT '' COMMENT '网站名称',
  `company` VARCHAR(60) NOT NULL,
  `domain` VARCHAR(30) NOT NULL DEFAULT '' COMMENT '网站域名',
  `page_title` VARCHAR(60) NOT NULL DEFAULT '' COMMENT '网站标题',
  `keywords` VARCHAR(60) NOT NULL DEFAULT '' COMMENT '网站关键字',
  `description` TINYTEXT NOT NULL COMMENT '网站描述',
  `copyright` TINYTEXT NOT NULL,
  `support` TINYTEXT NOT NULL COMMENT '技术支持：北京千松科技发展有限公司',
  `icp` VARCHAR(30) NOT NULL DEFAULT '未备案',
  PRIMARY KEY  (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

/*Data for the table `siteinfo_cn` */

INSERT  INTO `siteinfo_cn`(`id`,`site_name`,`company`,`domain`,`page_title`,`keywords`,`description`,`copyright`,`support`,`icp`) VALUES (1,'测试1','测试1','D','测试1','测试1','测试1','测试1','测试1','未备案');

/*Table structure for table `siteinfo_en` */

DROP TABLE IF EXISTS `siteinfo_en`;

CREATE TABLE `siteinfo_en` (
  `id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '站点ID',
  `site_name` VARCHAR(20) NOT NULL DEFAULT '' COMMENT '网站名称',
  `domain` VARCHAR(30) NOT NULL DEFAULT '' COMMENT '网站域名',
  `company` VARCHAR(60) NOT NULL,
  `page_title` VARCHAR(60) NOT NULL DEFAULT '' COMMENT '网站标题',
  `keywords` VARCHAR(60) NOT NULL DEFAULT '' COMMENT '网站关键字',
  `description` TINYTEXT NOT NULL COMMENT '网站描述',
  `copyright` TINYTEXT NOT NULL,
  `support` TINYTEXT NOT NULL COMMENT '技术支持：北京千松科技发展有限公司',
  `icp` VARCHAR(30) NOT NULL DEFAULT '未备案',
  PRIMARY KEY  (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

/*Data for the table `siteinfo_en` */

/*Table structure for table `softwareinfo` */

DROP TABLE IF EXISTS `softwareinfo`;

CREATE TABLE `softwareinfo` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `title_id` INT(11) NOT NULL COMMENT '跟fileinfo关联',
  `lang` VARCHAR(18) NOT NULL COMMENT '软件语言，中文、英文或多国语言',
  `is_local` VARCHAR(12) NOT NULL COMMENT '软件性质，国产软件或国内软件',
  `is_authorized` VARCHAR(18) NOT NULL COMMENT '免费、共享、试用、正式',
  `os` VARCHAR(60) NOT NULL COMMENT '应用平台，操作系统',
  `description` TEXT NOT NULL COMMENT '软件描述',
  PRIMARY KEY  (`id`),
  KEY `FK_softwareinfo` (`title_id`),
  CONSTRAINT `FK_softwareinfo` FOREIGN KEY (`title_id`) REFERENCES `titleinfo` (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

/*Data for the table `softwareinfo` */

/*Table structure for table `statistics` */

DROP TABLE IF EXISTS `statistics`;

CREATE TABLE `statistics` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `ip` CHAR(15) NOT NULL DEFAULT '' COMMENT '访问IP',
  `area` VARCHAR(65) NOT NULL DEFAULT '' COMMENT '所在区域',
  `time` DATETIME NOT NULL COMMENT '访问时间',
  `href` TINYTEXT NOT NULL COMMENT '当前访问页面',
  `referrer` TINYTEXT COMMENT '访问来路',
  `browser` VARCHAR(32) NOT NULL DEFAULT '' COMMENT '所使用的浏览器',
  `os` VARCHAR(32) NOT NULL DEFAULT '' COMMENT '所使用得操作系统',
  `language` VARCHAR(32) NOT NULL DEFAULT '' COMMENT '客户端语言',
  `screen` VARCHAR(32) NOT NULL DEFAULT '' COMMENT '屏幕分辨率',
  `charset` VARCHAR(15) NOT NULL DEFAULT '' COMMENT '网页字符集',
  `domain` VARCHAR(60) NOT NULL DEFAULT '' COMMENT '网站来路域名',
  PRIMARY KEY  (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

/*Data for the table `statistics` */

/*Table structure for table `sysinfo` */

DROP TABLE IF EXISTS `sysinfo`;

CREATE TABLE `sysinfo` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `company` VARCHAR(90) NOT NULL COMMENT '公司名称',
  `phone` VARCHAR(15) DEFAULT NULL COMMENT '联系电话',
  `fax` VARCHAR(15) DEFAULT NULL COMMENT '传真',
  `website` VARCHAR(60) DEFAULT NULL COMMENT '公司网站',
  `update_server` VARCHAR(30) DEFAULT NULL COMMENT '系统更新服务器地址',
  `developers` TEXT NOT NULL COMMENT '开发团队成员',
  `sys_ver` VARCHAR(10) NOT NULL COMMENT '系统版本',
  `serial_no` VARCHAR(60) DEFAULT NULL COMMENT '序列号',
  `is_auth` TINYINT(4) NOT NULL DEFAULT '0' COMMENT '是否授权',
  `ip_frbdn_alwd` TINYINT(4) NOT NULL DEFAULT '0' COMMENT '0-只限制IP段访问，1-只允许IP段访问',
  `is_rewrite_url` TINYINT(4) NOT NULL DEFAULT '0' COMMENT '是否重写URL',
  `is_generate_html` TINYINT(4) NOT NULL DEFAULT '0' COMMENT '是否生成静态文件',
  PRIMARY KEY  (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

/*Data for the table `sysinfo` */

/*Table structure for table `titlecat` */

DROP TABLE IF EXISTS `titlecat`;

CREATE TABLE `titlecat` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `info_type` TINYINT(4) NOT NULL DEFAULT '0' COMMENT '信息类型：content,file,link,notice,ad,vote',
  `cat_name` VARCHAR(50) NOT NULL DEFAULT '',
  `upper_cat` TINYTEXT,
  `upper_id` INT(11) NOT NULL,
  `is_leaf` TINYINT(4) NOT NULL DEFAULT '0',
  `is_edit_only` TINYINT(4) NOT NULL DEFAULT '0' COMMENT '当前分类下的信息不可随意删除、添加，只可编辑（如网站相关：关于我们、联系我们）',
  `sort_no` INT(11) NOT NULL DEFAULT '0',
  `is_forbidden` TINYINT(4) NOT NULL DEFAULT '0',
  `is_recommend` TINYINT(4) NOT NULL DEFAULT '0',
  PRIMARY KEY  (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

/*Data for the table `titlecat` */

/*Table structure for table `titleinfo` */

DROP TABLE IF EXISTS `titleinfo`;

CREATE TABLE `titleinfo` (
  `id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '搜索ID',
  `admin_id` INT(11) NOT NULL DEFAULT '0' COMMENT '管理员ID',
  `cat_id` INT(11) NOT NULL DEFAULT '0',
  `category` VARCHAR(90) DEFAULT NULL,
  `title` VARCHAR(150) NOT NULL DEFAULT '' COMMENT '信息标题',
  `author` VARCHAR(90) NOT NULL DEFAULT '' COMMENT '信息作者',
  `thumbnail` VARCHAR(150) DEFAULT NULL COMMENT '信息缩略图',
  `tags` TINYTEXT COMMENT '查询标签',
  `is_check` TINYINT(4) NOT NULL DEFAULT '0' COMMENT '信息是否可以被检索',
  `is_forbodden` TINYINT(4) NOT NULL DEFAULT '0' COMMENT '信息是否被禁用',
  `is_recommend` TINYINT(4) NOT NULL DEFAULT '0' COMMENT '是否推荐',
  `sort_no` INT(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `add_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '添加时间',
  `edit_time` TIMESTAMP NULL DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY  (`id`),
  KEY `FK_titleinfo` (`cat_id`),
  KEY `FK_titleinfo_admin` (`admin_id`),
  CONSTRAINT `FK_titleinfo` FOREIGN KEY (`cat_id`) REFERENCES `titlecat` (`id`),
  CONSTRAINT `FK_titleinfo_admin` FOREIGN KEY (`admin_id`) REFERENCES `admininfo` (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

/*Data for the table `titleinfo` */

/*Table structure for table `voteinfo` */

DROP TABLE IF EXISTS `voteinfo`;

CREATE TABLE `voteinfo` (
  `id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '投票ID',
  `title_id` INT(11) NOT NULL DEFAULT '0',
  `items` TEXT NOT NULL COMMENT '投票名称和投票数量',
  `time_start` DATE NOT NULL COMMENT '投票开始时间',
  `time_end` DATE NOT NULL COMMENT '投票结束时间',
  `description` TEXT NOT NULL COMMENT '投票描述',
  `is_allowed_view` TINYINT(4) NOT NULL DEFAULT '1',
  `is_guest_vote` TINYINT(4) NOT NULL DEFAULT '0',
  `days_ip` TINYINT(4) NOT NULL DEFAULT '0' COMMENT '限制IP投票',
  `is_display` TINYINT(4) NOT NULL DEFAULT '1',
  PRIMARY KEY  (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

/*Data for the table `voteinfo` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
