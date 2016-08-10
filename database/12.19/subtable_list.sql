/*
Navicat MySQL Data Transfer

Source Server         : project
Source Server Version : 50041
Source Host           : david:3306
Source Database       : project

Target Server Type    : MYSQL
Target Server Version : 50041
File Encoding         : 65001

Date: 2015-12-19 12:18:48
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `subtable_list`
-- ----------------------------
DROP TABLE IF EXISTS `subtable_list`;
CREATE TABLE `subtable_list` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `tpl_url` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of subtable_list
-- ----------------------------
