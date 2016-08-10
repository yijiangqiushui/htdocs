/*
Navicat MySQL Data Transfer

Source Server         : project
Source Server Version : 50041
Source Host           : david:3306
Source Database       : project

Target Server Type    : MYSQL
Target Server Version : 50041
File Encoding         : 65001

Date: 2015-12-19 17:37:33
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `table_type_relative`
-- ----------------------------
DROP TABLE IF EXISTS `table_type_relative`;
CREATE TABLE `table_type_relative` (
  `id` int(11) NOT NULL default '0',
  `project_type_id` int(11) default NULL,
  `para_id` tinyint(4) default NULL,
  `table_type_id` int(11) default NULL,
  `subtable_list_id` int(11) default NULL,
  `is_new` tinyint(4) default NULL,
  `rules` text,
  `sort_id` int(11) default NULL,
  `status` tinyint(4) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `st_uniq` (`project_type_id`,`para_id`,`table_type_id`,`subtable_list_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of table_type_relative
-- ----------------------------
INSERT INTO `table_type_relative` VALUES ('0', '0', '0', '1', '1', null, null, null, null);
INSERT INTO `table_type_relative` VALUES ('1', '0', '0', '1', '2', null, null, null, null);
