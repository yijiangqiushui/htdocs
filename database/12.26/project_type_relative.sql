/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50611
Source Host           : localhost:3306
Source Database       : project

Target Server Type    : MYSQL
Target Server Version : 50611
File Encoding         : 65001

Date: 2015-12-26 00:02:24
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for project_type_relative
-- ----------------------------
DROP TABLE IF EXISTS `project_type_relative`;
CREATE TABLE `project_type_relative` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_type_id` int(11) DEFAULT NULL,
  `table_type_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pt_tt_uniq` (`project_type_id`,`table_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of project_type_relative
-- ----------------------------
