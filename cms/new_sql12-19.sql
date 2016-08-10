/*
SQLyog 企业版 - MySQL GUI v8.14 
MySQL - 5.0.41-community-nt : Database - project_monitor
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

USE `project`;

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

insert  into `contentinfo`(`id`,`category`,`title`,`content`,`operator`,`source`,`filePath`,`sortNo`,`isForbidden`,`isRecommend`,`releaseTime`,`countClick`,`briefIntro`) values (53,'','技术','','',NULL,NULL,0,0,0,'2015-12-16 21:27:53',0,''),(54,'','方案','','',NULL,NULL,0,0,0,'2015-12-16 21:27:53',0,''),(55,'','可行性','','',NULL,NULL,0,0,0,'2015-12-16 21:27:53',0,''),(57,'','放到','','',NULL,NULL,0,0,0,'2015-12-16 21:27:53',0,''),(58,'','技术','','',NULL,NULL,0,0,0,'2015-12-16 21:30:19',0,''),(59,'','方案','','',NULL,NULL,0,0,0,'2015-12-16 21:30:19',0,''),(60,'','可行性','','',NULL,NULL,0,0,0,'2015-12-16 21:30:19',0,''),(61,'','放到','','',NULL,NULL,0,0,0,'2015-12-16 21:30:19',0,''),(62,'s0e','旧的项目方案','','',NULL,NULL,0,0,0,'2015-12-16 22:32:14',0,''),(63,'s1e','新的项目方案','','',NULL,NULL,0,0,0,'2015-12-16 22:32:23',0,''),(64,'s1e','112','','',NULL,NULL,0,0,0,'2015-12-19 11:02:30',0,''),(65,'1','212','','',NULL,'/uploadFiles/contentFiles/201512/66dae2a75cf283b0c504b5269cf2747d.txt',0,0,0,'2015-12-19 13:16:15',0,''),(66,'1','啊阿道夫','<p>撒的发撒的发</p>','',NULL,NULL,0,0,0,'2015-12-19 13:23:56',0,''),(67,'1','1123','<p>123123</p>','',NULL,NULL,0,0,0,'2015-12-19 13:24:37',0,'');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
