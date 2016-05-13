/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : phyman

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2016-05-11 12:12:40
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `phyman_article`
-- ----------------------------
DROP TABLE IF EXISTS `phyman_article`;
CREATE TABLE `phyman_article` (
  `id` bigint(25) unsigned NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `uid` bigint(12) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `tid` bigint(8) DEFAULT NULL,
  `body` varchar(6000) DEFAULT NULL,
  `grade` varchar(20) DEFAULT '所有年级',
  `filedir` varchar(500) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of phyman_article
-- ----------------------------
INSERT INTO `phyman_article` VALUES ('96584681255862273', '物理电子学院', '201522040840', '2016-04-29 00:00:00', null, '<p>物理电子学院</p>\n<p>物理电子学院</p>\n<p>物理电子学院</p>\n<p>物理电子学院</p>\n<p>物理电子学院</p>\n<p>物理电子学院</p>\n<p>物理电子学院</p>\n<p>物理电子学院</p>', '研一;研二;研三', null);
INSERT INTO `phyman_article` VALUES ('96592189026467849', '123', '201522040840', '2016-05-05 00:00:00', null, '<p>111111111</p>', '大四;研一;', '1462378343.doc');
INSERT INTO `phyman_article` VALUES ('96592189026467851', 'ppt', '201522040840', '2016-05-05 00:00:00', null, '<p>111111111111</p>', '大一;大二;', '1462379137.ppt');
INSERT INTO `phyman_article` VALUES ('96592189026467857', 'rar', '201522040840', '2016-05-05 00:00:00', null, '<p>1111111</p>', '大二;大三;', '1462379514.rar');
INSERT INTO `phyman_article` VALUES ('96592189026467859', 'pptx', '201522040840', '2016-05-05 00:00:00', null, '<p>1111111</p>', '大三;研二;', '1462379574.pptx');
INSERT INTO `phyman_article` VALUES ('96592189026467861', '111', '201522040840', '2016-05-05 00:40:47', null, '<p>11111111</p>', '大二;研一;', '1');
INSERT INTO `phyman_article` VALUES ('96594638550335489', 'test', '201522040840', '2016-05-06 16:06:32', null, '<p>111</p>', '研一;大四;', '1462521992.doc');

-- ----------------------------
-- Table structure for `phyman_article_user96584681255862273`
-- ----------------------------
DROP TABLE IF EXISTS `phyman_article_user96584681255862273`;
CREATE TABLE `phyman_article_user96584681255862273` (
  `id` bigint(12) NOT NULL,
  `name` varchar(10) DEFAULT NULL,
  `grade` varchar(10) DEFAULT NULL,
  `checken` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of phyman_article_user96584681255862273
-- ----------------------------
INSERT INTO `phyman_article_user96584681255862273` VALUES ('201522040840', '林小艺', '研一', '1');
INSERT INTO `phyman_article_user96584681255862273` VALUES ('201522040841', '邓迪夫', '研一', '0');
INSERT INTO `phyman_article_user96584681255862273` VALUES ('201522040842', '周细磅', '研一', '0');
INSERT INTO `phyman_article_user96584681255862273` VALUES ('201522040843', '李娅', '研一', '1');
INSERT INTO `phyman_article_user96584681255862273` VALUES ('201522040844', '桂文超', '研一', '0');
INSERT INTO `phyman_article_user96584681255862273` VALUES ('201522040845', '张婷', '研一', '0');
INSERT INTO `phyman_article_user96584681255862273` VALUES ('201522040846', '吴义忠', '研一', '0');
INSERT INTO `phyman_article_user96584681255862273` VALUES ('201522040847', '丁仁杰', '研一', '0');
INSERT INTO `phyman_article_user96584681255862273` VALUES ('201522040848', '刘智超', '研一', '0');
INSERT INTO `phyman_article_user96584681255862273` VALUES ('201522040849', '赵健翔', '研一', '0');
INSERT INTO `phyman_article_user96584681255862273` VALUES ('201522040850', '黄澍程', '研一', '0');
INSERT INTO `phyman_article_user96584681255862273` VALUES ('201522040851', '张引', '研一', '0');
INSERT INTO `phyman_article_user96584681255862273` VALUES ('201522040852', '陈家林', '研一', '0');
INSERT INTO `phyman_article_user96584681255862273` VALUES ('201522040853', '李保山', '研一', '0');
INSERT INTO `phyman_article_user96584681255862273` VALUES ('201522040854', '王家福', '研一', '0');
INSERT INTO `phyman_article_user96584681255862273` VALUES ('201522040855', '李仕峰', '研一', '0');
INSERT INTO `phyman_article_user96584681255862273` VALUES ('201522040856', '刘美玉', '研一', '0');
INSERT INTO `phyman_article_user96584681255862273` VALUES ('201522040857', '盛昌建', '研一', '0');
INSERT INTO `phyman_article_user96584681255862273` VALUES ('201522040858', '王奇', '研一', '0');
INSERT INTO `phyman_article_user96584681255862273` VALUES ('201522040859', '黄娜', '研一', '0');
INSERT INTO `phyman_article_user96584681255862273` VALUES ('201522040860', '王影', '研一', '0');
INSERT INTO `phyman_article_user96584681255862273` VALUES ('201522040861', '王明寿', '研一', '0');
INSERT INTO `phyman_article_user96584681255862273` VALUES ('201522040862', '罗智', '研一', '0');
INSERT INTO `phyman_article_user96584681255862273` VALUES ('201522040863', '王兰', '研一', '0');
INSERT INTO `phyman_article_user96584681255862273` VALUES ('201522040864', '李洪平', '研一', '0');
INSERT INTO `phyman_article_user96584681255862273` VALUES ('201522040865', '金磊', '研一', '0');
INSERT INTO `phyman_article_user96584681255862273` VALUES ('201522040866', '毛伟', '研一', '0');
INSERT INTO `phyman_article_user96584681255862273` VALUES ('201522040867', '李一鸣', '研一', '0');
INSERT INTO `phyman_article_user96584681255862273` VALUES ('201522040868', '段正杰', '研一', '0');
INSERT INTO `phyman_article_user96584681255862273` VALUES ('201522040869', '彭坤', '研一', '0');
INSERT INTO `phyman_article_user96584681255862273` VALUES ('201522040870', '蔡雪丹', '研一', '0');
INSERT INTO `phyman_article_user96584681255862273` VALUES ('201522040871', '阚增辉', '研一', '0');
INSERT INTO `phyman_article_user96584681255862273` VALUES ('201522040872', '向飞龙', '研一', '0');
INSERT INTO `phyman_article_user96584681255862273` VALUES ('201522040873', '宋泽林', '研一', '0');
INSERT INTO `phyman_article_user96584681255862273` VALUES ('201522040874', '王盛', '研一', '0');
INSERT INTO `phyman_article_user96584681255862273` VALUES ('201522040875', '钟俊男', '研一', '0');
INSERT INTO `phyman_article_user96584681255862273` VALUES ('201522040876', '张海洋', '研一', '0');
INSERT INTO `phyman_article_user96584681255862273` VALUES ('201522040877', '杨君宇', '研一', '0');
INSERT INTO `phyman_article_user96584681255862273` VALUES ('201522040878', '李勇', '研一', '0');

-- ----------------------------
-- Table structure for `phyman_article_user96592189026467849`
-- ----------------------------
DROP TABLE IF EXISTS `phyman_article_user96592189026467849`;
CREATE TABLE `phyman_article_user96592189026467849` (
  `id` bigint(12) NOT NULL,
  `name` varchar(10) DEFAULT NULL,
  `grade` varchar(10) DEFAULT NULL,
  `checken` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of phyman_article_user96592189026467849
-- ----------------------------
INSERT INTO `phyman_article_user96592189026467849` VALUES ('201522040840', '林小艺', '研一', '1');
INSERT INTO `phyman_article_user96592189026467849` VALUES ('201522040841', '邓迪夫', '研一', '0');
INSERT INTO `phyman_article_user96592189026467849` VALUES ('201522040842', '周细磅', '研一', '0');
INSERT INTO `phyman_article_user96592189026467849` VALUES ('201522040843', '李娅', '研一', '0');
INSERT INTO `phyman_article_user96592189026467849` VALUES ('201522040844', '桂文超', '研一', '0');
INSERT INTO `phyman_article_user96592189026467849` VALUES ('201522040845', '张婷', '研一', '0');
INSERT INTO `phyman_article_user96592189026467849` VALUES ('201522040846', '吴义忠', '研一', '0');
INSERT INTO `phyman_article_user96592189026467849` VALUES ('201522040847', '丁仁杰', '研一', '0');
INSERT INTO `phyman_article_user96592189026467849` VALUES ('201522040848', '刘智超', '研一', '0');
INSERT INTO `phyman_article_user96592189026467849` VALUES ('201522040849', '赵健翔', '研一', '0');
INSERT INTO `phyman_article_user96592189026467849` VALUES ('201522040850', '黄澍程', '研一', '0');
INSERT INTO `phyman_article_user96592189026467849` VALUES ('201522040851', '张引', '研一', '0');
INSERT INTO `phyman_article_user96592189026467849` VALUES ('201522040852', '陈家林', '研一', '0');
INSERT INTO `phyman_article_user96592189026467849` VALUES ('201522040853', '李保山', '研一', '0');
INSERT INTO `phyman_article_user96592189026467849` VALUES ('201522040854', '王家福', '研一', '0');
INSERT INTO `phyman_article_user96592189026467849` VALUES ('201522040855', '李仕峰', '研一', '0');
INSERT INTO `phyman_article_user96592189026467849` VALUES ('201522040856', '刘美玉', '研一', '0');
INSERT INTO `phyman_article_user96592189026467849` VALUES ('201522040857', '盛昌建', '研一', '0');
INSERT INTO `phyman_article_user96592189026467849` VALUES ('201522040858', '王奇', '研一', '0');
INSERT INTO `phyman_article_user96592189026467849` VALUES ('201522040859', '黄娜', '研一', '0');
INSERT INTO `phyman_article_user96592189026467849` VALUES ('201522040860', '王影', '研一', '0');
INSERT INTO `phyman_article_user96592189026467849` VALUES ('201522040861', '王明寿', '研一', '0');
INSERT INTO `phyman_article_user96592189026467849` VALUES ('201522040862', '罗智', '研一', '0');
INSERT INTO `phyman_article_user96592189026467849` VALUES ('201522040863', '王兰', '研一', '0');
INSERT INTO `phyman_article_user96592189026467849` VALUES ('201522040864', '李洪平', '研一', '0');
INSERT INTO `phyman_article_user96592189026467849` VALUES ('201522040865', '金磊', '研一', '0');
INSERT INTO `phyman_article_user96592189026467849` VALUES ('201522040866', '毛伟', '研一', '0');
INSERT INTO `phyman_article_user96592189026467849` VALUES ('201522040867', '李一鸣', '研一', '0');
INSERT INTO `phyman_article_user96592189026467849` VALUES ('201522040868', '段正杰', '研一', '0');
INSERT INTO `phyman_article_user96592189026467849` VALUES ('201522040869', '彭坤', '研一', '0');
INSERT INTO `phyman_article_user96592189026467849` VALUES ('201522040870', '蔡雪丹', '研一', '0');
INSERT INTO `phyman_article_user96592189026467849` VALUES ('201522040871', '阚增辉', '研一', '0');
INSERT INTO `phyman_article_user96592189026467849` VALUES ('201522040872', '向飞龙', '研一', '0');
INSERT INTO `phyman_article_user96592189026467849` VALUES ('201522040873', '宋泽林', '研一', '0');
INSERT INTO `phyman_article_user96592189026467849` VALUES ('201522040874', '王盛', '研一', '0');
INSERT INTO `phyman_article_user96592189026467849` VALUES ('201522040875', '钟俊男', '研一', '0');
INSERT INTO `phyman_article_user96592189026467849` VALUES ('201522040876', '张海洋', '研一', '0');
INSERT INTO `phyman_article_user96592189026467849` VALUES ('201522040877', '杨君宇', '研一', '0');
INSERT INTO `phyman_article_user96592189026467849` VALUES ('201522040878', '李勇', '研一', '0');
INSERT INTO `phyman_article_user96592189026467849` VALUES ('201522040980', '林小艺', '研一', '0');

-- ----------------------------
-- Table structure for `phyman_article_user96592189026467851`
-- ----------------------------
DROP TABLE IF EXISTS `phyman_article_user96592189026467851`;
CREATE TABLE `phyman_article_user96592189026467851` (
  `id` bigint(12) NOT NULL,
  `name` varchar(10) DEFAULT NULL,
  `grade` varchar(10) DEFAULT NULL,
  `checken` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of phyman_article_user96592189026467851
-- ----------------------------

-- ----------------------------
-- Table structure for `phyman_article_user96592189026467857`
-- ----------------------------
DROP TABLE IF EXISTS `phyman_article_user96592189026467857`;
CREATE TABLE `phyman_article_user96592189026467857` (
  `id` bigint(12) NOT NULL,
  `name` varchar(10) DEFAULT NULL,
  `grade` varchar(10) DEFAULT NULL,
  `checken` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of phyman_article_user96592189026467857
-- ----------------------------

-- ----------------------------
-- Table structure for `phyman_article_user96592189026467859`
-- ----------------------------
DROP TABLE IF EXISTS `phyman_article_user96592189026467859`;
CREATE TABLE `phyman_article_user96592189026467859` (
  `id` bigint(12) NOT NULL,
  `name` varchar(10) DEFAULT NULL,
  `grade` varchar(10) DEFAULT NULL,
  `checken` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of phyman_article_user96592189026467859
-- ----------------------------

-- ----------------------------
-- Table structure for `phyman_article_user96592189026467860`
-- ----------------------------
DROP TABLE IF EXISTS `phyman_article_user96592189026467860`;
CREATE TABLE `phyman_article_user96592189026467860` (
  `id` bigint(12) NOT NULL,
  `name` varchar(10) DEFAULT NULL,
  `grade` varchar(10) DEFAULT NULL,
  `checken` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of phyman_article_user96592189026467860
-- ----------------------------

-- ----------------------------
-- Table structure for `phyman_article_user96592189026467861`
-- ----------------------------
DROP TABLE IF EXISTS `phyman_article_user96592189026467861`;
CREATE TABLE `phyman_article_user96592189026467861` (
  `id` bigint(12) NOT NULL,
  `name` varchar(10) DEFAULT NULL,
  `grade` varchar(10) DEFAULT NULL,
  `checken` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of phyman_article_user96592189026467861
-- ----------------------------
INSERT INTO `phyman_article_user96592189026467861` VALUES ('201522040840', '林小艺', '研一', '0');
INSERT INTO `phyman_article_user96592189026467861` VALUES ('201522040841', '邓迪夫', '研一', '0');
INSERT INTO `phyman_article_user96592189026467861` VALUES ('201522040842', '周细磅', '研一', '0');
INSERT INTO `phyman_article_user96592189026467861` VALUES ('201522040843', '李娅', '研一', '0');
INSERT INTO `phyman_article_user96592189026467861` VALUES ('201522040844', '桂文超', '研一', '0');
INSERT INTO `phyman_article_user96592189026467861` VALUES ('201522040845', '张婷', '研一', '0');
INSERT INTO `phyman_article_user96592189026467861` VALUES ('201522040846', '吴义忠', '研一', '0');
INSERT INTO `phyman_article_user96592189026467861` VALUES ('201522040847', '丁仁杰', '研一', '0');
INSERT INTO `phyman_article_user96592189026467861` VALUES ('201522040848', '刘智超', '研一', '0');
INSERT INTO `phyman_article_user96592189026467861` VALUES ('201522040849', '赵健翔', '研一', '0');
INSERT INTO `phyman_article_user96592189026467861` VALUES ('201522040850', '黄澍程', '研一', '0');
INSERT INTO `phyman_article_user96592189026467861` VALUES ('201522040851', '张引', '研一', '0');
INSERT INTO `phyman_article_user96592189026467861` VALUES ('201522040852', '陈家林', '研一', '0');
INSERT INTO `phyman_article_user96592189026467861` VALUES ('201522040853', '李保山', '研一', '0');
INSERT INTO `phyman_article_user96592189026467861` VALUES ('201522040854', '王家福', '研一', '0');
INSERT INTO `phyman_article_user96592189026467861` VALUES ('201522040855', '李仕峰', '研一', '0');
INSERT INTO `phyman_article_user96592189026467861` VALUES ('201522040856', '刘美玉', '研一', '0');
INSERT INTO `phyman_article_user96592189026467861` VALUES ('201522040857', '盛昌建', '研一', '0');
INSERT INTO `phyman_article_user96592189026467861` VALUES ('201522040858', '王奇', '研一', '0');
INSERT INTO `phyman_article_user96592189026467861` VALUES ('201522040859', '黄娜', '研一', '0');
INSERT INTO `phyman_article_user96592189026467861` VALUES ('201522040860', '王影', '研一', '0');
INSERT INTO `phyman_article_user96592189026467861` VALUES ('201522040861', '王明寿', '研一', '0');
INSERT INTO `phyman_article_user96592189026467861` VALUES ('201522040862', '罗智', '研一', '0');
INSERT INTO `phyman_article_user96592189026467861` VALUES ('201522040863', '王兰', '研一', '0');
INSERT INTO `phyman_article_user96592189026467861` VALUES ('201522040864', '李洪平', '研一', '0');
INSERT INTO `phyman_article_user96592189026467861` VALUES ('201522040865', '金磊', '研一', '0');
INSERT INTO `phyman_article_user96592189026467861` VALUES ('201522040866', '毛伟', '研一', '0');
INSERT INTO `phyman_article_user96592189026467861` VALUES ('201522040867', '李一鸣', '研一', '0');
INSERT INTO `phyman_article_user96592189026467861` VALUES ('201522040868', '段正杰', '研一', '0');
INSERT INTO `phyman_article_user96592189026467861` VALUES ('201522040869', '彭坤', '研一', '0');
INSERT INTO `phyman_article_user96592189026467861` VALUES ('201522040870', '蔡雪丹', '研一', '0');
INSERT INTO `phyman_article_user96592189026467861` VALUES ('201522040871', '阚增辉', '研一', '0');
INSERT INTO `phyman_article_user96592189026467861` VALUES ('201522040872', '向飞龙', '研一', '0');
INSERT INTO `phyman_article_user96592189026467861` VALUES ('201522040873', '宋泽林', '研一', '0');
INSERT INTO `phyman_article_user96592189026467861` VALUES ('201522040874', '王盛', '研一', '0');
INSERT INTO `phyman_article_user96592189026467861` VALUES ('201522040875', '钟俊男', '研一', '0');
INSERT INTO `phyman_article_user96592189026467861` VALUES ('201522040876', '张海洋', '研一', '0');
INSERT INTO `phyman_article_user96592189026467861` VALUES ('201522040877', '杨君宇', '研一', '0');
INSERT INTO `phyman_article_user96592189026467861` VALUES ('201522040878', '李勇', '研一', '0');
INSERT INTO `phyman_article_user96592189026467861` VALUES ('201522040980', '林小艺', '研一', '0');

-- ----------------------------
-- Table structure for `phyman_article_user96594638550335488`
-- ----------------------------
DROP TABLE IF EXISTS `phyman_article_user96594638550335488`;
CREATE TABLE `phyman_article_user96594638550335488` (
  `id` bigint(12) NOT NULL,
  `name` varchar(10) DEFAULT NULL,
  `grade` varchar(10) DEFAULT NULL,
  `checken` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of phyman_article_user96594638550335488
-- ----------------------------

-- ----------------------------
-- Table structure for `phyman_article_user96594638550335489`
-- ----------------------------
DROP TABLE IF EXISTS `phyman_article_user96594638550335489`;
CREATE TABLE `phyman_article_user96594638550335489` (
  `id` bigint(12) NOT NULL,
  `name` varchar(10) DEFAULT NULL,
  `grade` varchar(10) DEFAULT NULL,
  `checken` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of phyman_article_user96594638550335489
-- ----------------------------
INSERT INTO `phyman_article_user96594638550335489` VALUES ('201522040840', '林小艺', '研一', '1');
INSERT INTO `phyman_article_user96594638550335489` VALUES ('201522040841', '邓迪夫', '研一', '0');
INSERT INTO `phyman_article_user96594638550335489` VALUES ('201522040842', '周细磅', '研一', '0');
INSERT INTO `phyman_article_user96594638550335489` VALUES ('201522040843', '李娅', '研一', '0');
INSERT INTO `phyman_article_user96594638550335489` VALUES ('201522040844', '桂文超', '研一', '0');
INSERT INTO `phyman_article_user96594638550335489` VALUES ('201522040845', '张婷', '研一', '0');
INSERT INTO `phyman_article_user96594638550335489` VALUES ('201522040846', '吴义忠', '研一', '0');
INSERT INTO `phyman_article_user96594638550335489` VALUES ('201522040847', '丁仁杰', '研一', '0');
INSERT INTO `phyman_article_user96594638550335489` VALUES ('201522040848', '刘智超', '研一', '0');
INSERT INTO `phyman_article_user96594638550335489` VALUES ('201522040849', '赵健翔', '研一', '0');
INSERT INTO `phyman_article_user96594638550335489` VALUES ('201522040850', '黄澍程', '研一', '0');
INSERT INTO `phyman_article_user96594638550335489` VALUES ('201522040851', '张引', '研一', '0');
INSERT INTO `phyman_article_user96594638550335489` VALUES ('201522040852', '陈家林', '研一', '0');
INSERT INTO `phyman_article_user96594638550335489` VALUES ('201522040853', '李保山', '研一', '0');
INSERT INTO `phyman_article_user96594638550335489` VALUES ('201522040854', '王家福', '研一', '0');
INSERT INTO `phyman_article_user96594638550335489` VALUES ('201522040855', '李仕峰', '研一', '0');
INSERT INTO `phyman_article_user96594638550335489` VALUES ('201522040856', '刘美玉', '研一', '0');
INSERT INTO `phyman_article_user96594638550335489` VALUES ('201522040857', '盛昌建', '研一', '0');
INSERT INTO `phyman_article_user96594638550335489` VALUES ('201522040858', '王奇', '研一', '0');
INSERT INTO `phyman_article_user96594638550335489` VALUES ('201522040859', '黄娜', '研一', '0');
INSERT INTO `phyman_article_user96594638550335489` VALUES ('201522040860', '王影', '研一', '0');
INSERT INTO `phyman_article_user96594638550335489` VALUES ('201522040861', '王明寿', '研一', '0');
INSERT INTO `phyman_article_user96594638550335489` VALUES ('201522040862', '罗智', '研一', '0');
INSERT INTO `phyman_article_user96594638550335489` VALUES ('201522040863', '王兰', '研一', '0');
INSERT INTO `phyman_article_user96594638550335489` VALUES ('201522040864', '李洪平', '研一', '0');
INSERT INTO `phyman_article_user96594638550335489` VALUES ('201522040865', '金磊', '研一', '0');
INSERT INTO `phyman_article_user96594638550335489` VALUES ('201522040866', '毛伟', '研一', '0');
INSERT INTO `phyman_article_user96594638550335489` VALUES ('201522040867', '李一鸣', '研一', '0');
INSERT INTO `phyman_article_user96594638550335489` VALUES ('201522040868', '段正杰', '研一', '0');
INSERT INTO `phyman_article_user96594638550335489` VALUES ('201522040869', '彭坤', '研一', '0');
INSERT INTO `phyman_article_user96594638550335489` VALUES ('201522040870', '蔡雪丹', '研一', '0');
INSERT INTO `phyman_article_user96594638550335489` VALUES ('201522040871', '阚增辉', '研一', '0');
INSERT INTO `phyman_article_user96594638550335489` VALUES ('201522040872', '向飞龙', '研一', '0');
INSERT INTO `phyman_article_user96594638550335489` VALUES ('201522040873', '宋泽林', '研一', '0');
INSERT INTO `phyman_article_user96594638550335489` VALUES ('201522040874', '王盛', '研一', '0');
INSERT INTO `phyman_article_user96594638550335489` VALUES ('201522040875', '钟俊男', '研一', '0');
INSERT INTO `phyman_article_user96594638550335489` VALUES ('201522040876', '张海洋', '研一', '0');
INSERT INTO `phyman_article_user96594638550335489` VALUES ('201522040877', '杨君宇', '研一', '0');
INSERT INTO `phyman_article_user96594638550335489` VALUES ('201522040878', '李勇', '研一', '0');
INSERT INTO `phyman_article_user96594638550335489` VALUES ('201522040980', '林小艺', '研一', '0');

-- ----------------------------
-- Table structure for `phyman_authority`
-- ----------------------------
DROP TABLE IF EXISTS `phyman_authority`;
CREATE TABLE `phyman_authority` (
  `id` bigint(15) NOT NULL,
  `name` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of phyman_authority
-- ----------------------------
INSERT INTO `phyman_authority` VALUES ('10', '未注册');
INSERT INTO `phyman_authority` VALUES ('11', '管理员');
INSERT INTO `phyman_authority` VALUES ('12', '编辑');
INSERT INTO `phyman_authority` VALUES ('13', '用户');
INSERT INTO `phyman_authority` VALUES ('14', '注册出错');
INSERT INTO `phyman_authority` VALUES ('96458009013649411', '测试');
INSERT INTO `phyman_authority` VALUES ('96458009013649412', '测试');
INSERT INTO `phyman_authority` VALUES ('96458009013649423', '测试');

-- ----------------------------
-- Table structure for `phyman_grade`
-- ----------------------------
DROP TABLE IF EXISTS `phyman_grade`;
CREATE TABLE `phyman_grade` (
  `gid` int(2) NOT NULL,
  `gname` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`gid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of phyman_grade
-- ----------------------------
INSERT INTO `phyman_grade` VALUES ('0', '本科生');
INSERT INTO `phyman_grade` VALUES ('1', '大一');
INSERT INTO `phyman_grade` VALUES ('2', '大二');
INSERT INTO `phyman_grade` VALUES ('3', '大三');
INSERT INTO `phyman_grade` VALUES ('4', '大四');
INSERT INTO `phyman_grade` VALUES ('5', '研究生');
INSERT INTO `phyman_grade` VALUES ('6', '研一');
INSERT INTO `phyman_grade` VALUES ('7', '研二');
INSERT INTO `phyman_grade` VALUES ('8', '研三');
INSERT INTO `phyman_grade` VALUES ('9', '博士');
INSERT INTO `phyman_grade` VALUES ('10', '所有年级');

-- ----------------------------
-- Table structure for `phyman_qa`
-- ----------------------------
DROP TABLE IF EXISTS `phyman_qa`;
CREATE TABLE `phyman_qa` (
  `id` bigint(25) NOT NULL,
  `qid` bigint(12) NOT NULL,
  `qname` varchar(10) DEFAULT NULL,
  `aid` bigint(12) DEFAULT NULL,
  `aname` varchar(12) DEFAULT NULL,
  `question` varchar(3000) NOT NULL,
  `answer` varchar(3000) DEFAULT NULL,
  `qdate` datetime DEFAULT NULL,
  `adate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of phyman_qa
-- ----------------------------
INSERT INTO `phyman_qa` VALUES ('1', '201522040840', '林小艺', '201522040841', '邓迪夫', '物电学院问题测试1物电学院问题测试1物电学院问题测试1物电学院问题测试1物电学院问题测试1物电学院问题测试1', '没问题', '2016-03-25 00:00:00', '2016-03-26 00:00:00');
INSERT INTO `phyman_qa` VALUES ('2', '201522040840', '林小艺', '201522040841', '邓迪夫', '物电学院问题测试1', '没问题', '2015-02-25 00:00:00', '2016-03-26 00:00:00');
INSERT INTO `phyman_qa` VALUES ('3', '201522040840', '林小艺', '201522040841', '邓迪夫', '物电学院问题测试1物电学院问题测试1物电学院问题测试1物电学院问题测试1物电学院问题测试1物电学院问题测试1', '没问题', '2016-03-25 00:00:00', '2016-03-26 00:00:00');
INSERT INTO `phyman_qa` VALUES ('4', '201522040840', '林小艺', '201522040841', '邓迪夫', '物电学院问题测试1物电学院问题测试1物电学院问题测试1物电学院问题测试1物电学院问题测试1物电学院问题测试1', '没问题', '2016-03-25 00:00:00', '2016-03-26 00:00:00');
INSERT INTO `phyman_qa` VALUES ('5', '201522040840', '林小艺', null, '', '物电学院问题测试1物电学院问题测试1物电学院问题测试1物电学院问题测试1物电学院问题测试1物电学院问题测试1', 'NULL', '2016-03-25 00:00:00', null);
INSERT INTO `phyman_qa` VALUES ('6', '201522040840', '林小艺', '201522040840', '林小艺', '物电学院啦啦啦啦拉拉阿拉蕾', 'test2222222noproblem1111111', '2016-03-27 00:00:00', '2016-03-27 15:32:44');
INSERT INTO `phyman_qa` VALUES ('96536406645538821', '201522040840', '林小艺', '201522040840', '林小艺', 'TEST11111111111QUESTION', 'YES,NOPROBLEM', '2016-03-27 14:40:15', '2016-03-27 15:19:59');
INSERT INTO `phyman_qa` VALUES ('96561627280703507', '201522040840', '林小艺', '201522040840', '林小艺', '123', '111111111111111111111111111111111', '2016-04-14 01:21:20', '2016-04-30 21:21:54');
INSERT INTO `phyman_qa` VALUES ('96586201070305281', '201522040840', '林小艺', '201522040840', '林小艺', '11111111', '11111111111111', '2016-04-30 21:21:35', '2016-04-30 21:21:40');
INSERT INTO `phyman_qa` VALUES ('96588502585573405', '201522040843', '李娅', '201522040840', '林小艺', '11111111111111', '111111111', '2016-05-02 13:01:36', '2016-05-06 17:04:34');

-- ----------------------------
-- Table structure for `phyman_question`
-- ----------------------------
DROP TABLE IF EXISTS `phyman_question`;
CREATE TABLE `phyman_question` (
  `id` bigint(15) unsigned NOT NULL AUTO_INCREMENT,
  `uid` bigint(12) DEFAULT NULL,
  `body` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of phyman_question
-- ----------------------------

-- ----------------------------
-- Table structure for `phyman_reply`
-- ----------------------------
DROP TABLE IF EXISTS `phyman_reply`;
CREATE TABLE `phyman_reply` (
  `id` bigint(15) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID组成方式（年月日时分秒+这个时间段的第几个问题）',
  `uid` bigint(12) DEFAULT NULL,
  `qid` bigint(15) DEFAULT NULL,
  `body` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of phyman_reply
-- ----------------------------

-- ----------------------------
-- Table structure for `phyman_scan`
-- ----------------------------
DROP TABLE IF EXISTS `phyman_scan`;
CREATE TABLE `phyman_scan` (
  `userid` bigint(12) DEFAULT NULL,
  `scanname` varchar(100) DEFAULT NULL,
  `scanid` bigint(12) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of phyman_scan
-- ----------------------------
INSERT INTO `phyman_scan` VALUES ('201522040841', '讲座', '2', '邓迪夫');
INSERT INTO `phyman_scan` VALUES ('201522040840', '讲座', '2', '林小艺');
INSERT INTO `phyman_scan` VALUES ('201522040842', '讲座', '2', '周细磅');
INSERT INTO `phyman_scan` VALUES ('201522040843', '讲座', '2', '李娅');
INSERT INTO `phyman_scan` VALUES ('201522040844', '讲座', '2', '桂文超');
INSERT INTO `phyman_scan` VALUES ('201522040845', '讲座', '2', '张婷');
INSERT INTO `phyman_scan` VALUES ('201522040846', '讲座', '2', '吴义忠');
INSERT INTO `phyman_scan` VALUES ('201522040847', '讲座', '2', '丁仁杰');
INSERT INTO `phyman_scan` VALUES ('201522040848', '讲座', '2', '刘智超');
INSERT INTO `phyman_scan` VALUES ('201522040849', '讲座', '2', '赵健翔');
INSERT INTO `phyman_scan` VALUES ('201522040850', '讲座', '2', '黄澍程');
INSERT INTO `phyman_scan` VALUES ('201522040851', '讲座', '2', '张引');
INSERT INTO `phyman_scan` VALUES ('201522040852', '讲座', '2', '陈家林');
INSERT INTO `phyman_scan` VALUES ('201522040853', '讲座', '2', '李保山');
INSERT INTO `phyman_scan` VALUES ('201522040854', '讲座', '2', '王家福');
INSERT INTO `phyman_scan` VALUES ('201522040855', '讲座', '2', '李仕峰');
INSERT INTO `phyman_scan` VALUES ('201522040856', '讲座', '2', '刘美玉');
INSERT INTO `phyman_scan` VALUES ('201522040857', '讲座', '2', '盛昌建');
INSERT INTO `phyman_scan` VALUES ('201522040858', '讲座', '2', '王奇');
INSERT INTO `phyman_scan` VALUES ('201522040859', '讲座', '2', '黄娜');
INSERT INTO `phyman_scan` VALUES ('201522040860', '讲座', '2', '王影');
INSERT INTO `phyman_scan` VALUES ('201522040861', '讲座', '2', '王明寿');
INSERT INTO `phyman_scan` VALUES ('201522040862', '讲座', '2', '罗智');
INSERT INTO `phyman_scan` VALUES ('201522040863', '讲座', '2', '王兰');
INSERT INTO `phyman_scan` VALUES ('201522040864', '讲座', '2', '李洪平');
INSERT INTO `phyman_scan` VALUES ('201522040865', '讲座', '2', '金磊');
INSERT INTO `phyman_scan` VALUES ('201522040866', '讲座', '2', '毛伟');
INSERT INTO `phyman_scan` VALUES ('201522040867', '讲座', '2', '李一鸣');
INSERT INTO `phyman_scan` VALUES ('201522040868', '讲座', '2', '段正杰');
INSERT INTO `phyman_scan` VALUES ('201522040869', '讲座', '2', '彭坤');
INSERT INTO `phyman_scan` VALUES ('201522040870', '讲座', '2', '蔡雪丹');
INSERT INTO `phyman_scan` VALUES ('201522040871', '讲座', '2', '阚增辉');
INSERT INTO `phyman_scan` VALUES ('201522040872', '讲座', '2', '向飞龙');
INSERT INTO `phyman_scan` VALUES ('201522040873', '讲座', '2', '宋泽林');
INSERT INTO `phyman_scan` VALUES ('201522040874', '讲座', '2', '王盛');
INSERT INTO `phyman_scan` VALUES ('201522040875', '讲座', '2', '钟俊男');
INSERT INTO `phyman_scan` VALUES ('201522040876', '讲座', '2', '张海洋');
INSERT INTO `phyman_scan` VALUES ('201522040877', '讲座', '2', '杨君宇');
INSERT INTO `phyman_scan` VALUES ('201522040878', '讲座', '2', '李勇');
INSERT INTO `phyman_scan` VALUES ('201522040980', '讲座', '1', '林小艺');
INSERT INTO `phyman_scan` VALUES ('201522040840', '0', '0', '林小艺');
INSERT INTO `phyman_scan` VALUES ('201522040841', '0', '0', '邓迪夫');
INSERT INTO `phyman_scan` VALUES ('201522040842', '0', '0', '周细磅');
INSERT INTO `phyman_scan` VALUES ('201522040843', '0', '0', '李娅');
INSERT INTO `phyman_scan` VALUES ('201522040844', '0', '0', '桂文超');
INSERT INTO `phyman_scan` VALUES ('201522040845', '0', '0', '张婷');
INSERT INTO `phyman_scan` VALUES ('201522040846', '0', '0', '吴义忠');
INSERT INTO `phyman_scan` VALUES ('201522040847', '0', '0', '丁仁杰');
INSERT INTO `phyman_scan` VALUES ('201522040848', '0', '0', '刘智超');
INSERT INTO `phyman_scan` VALUES ('201522040849', '0', '0', '赵健翔');
INSERT INTO `phyman_scan` VALUES ('201522040850', '0', '0', '黄澍程');
INSERT INTO `phyman_scan` VALUES ('201522040851', '0', '0', '张引');
INSERT INTO `phyman_scan` VALUES ('201522040852', '0', '0', '陈家林');
INSERT INTO `phyman_scan` VALUES ('201522040853', '0', '0', '李保山');
INSERT INTO `phyman_scan` VALUES ('201522040854', '0', '0', '王家福');
INSERT INTO `phyman_scan` VALUES ('201522040855', '0', '0', '李仕峰');
INSERT INTO `phyman_scan` VALUES ('201522040856', '0', '0', '刘美玉');
INSERT INTO `phyman_scan` VALUES ('201522040857', '0', '0', '盛昌建');
INSERT INTO `phyman_scan` VALUES ('201522040858', '0', '0', '王奇');
INSERT INTO `phyman_scan` VALUES ('201522040859', '0', '0', '黄娜');
INSERT INTO `phyman_scan` VALUES ('201522040860', '0', '0', '王影');
INSERT INTO `phyman_scan` VALUES ('201522040861', '0', '0', '王明寿');
INSERT INTO `phyman_scan` VALUES ('201522040862', '0', '0', '罗智');
INSERT INTO `phyman_scan` VALUES ('201522040863', '0', '0', '王兰');
INSERT INTO `phyman_scan` VALUES ('201522040864', '0', '0', '李洪平');
INSERT INTO `phyman_scan` VALUES ('201522040865', '0', '0', '金磊');
INSERT INTO `phyman_scan` VALUES ('201522040866', '0', '0', '毛伟');
INSERT INTO `phyman_scan` VALUES ('201522040867', '0', '0', '李一鸣');
INSERT INTO `phyman_scan` VALUES ('201522040868', '0', '0', '段正杰');
INSERT INTO `phyman_scan` VALUES ('201522040869', '0', '0', '彭坤');
INSERT INTO `phyman_scan` VALUES ('201522040870', '0', '0', '蔡雪丹');
INSERT INTO `phyman_scan` VALUES ('201522040871', '0', '0', '阚增辉');
INSERT INTO `phyman_scan` VALUES ('201522040872', '0', '0', '向飞龙');
INSERT INTO `phyman_scan` VALUES ('201522040873', '0', '0', '宋泽林');
INSERT INTO `phyman_scan` VALUES ('201522040874', '0', '0', '王盛');
INSERT INTO `phyman_scan` VALUES ('201522040875', '0', '0', '钟俊男');
INSERT INTO `phyman_scan` VALUES ('201522040876', '0', '0', '张海洋');
INSERT INTO `phyman_scan` VALUES ('201522040877', '0', '0', '杨君宇');
INSERT INTO `phyman_scan` VALUES ('201522040878', '0', '0', '李勇');
INSERT INTO `phyman_scan` VALUES ('201522040980', '0', '0', '林小艺');
INSERT INTO `phyman_scan` VALUES ('201522040840', '讲座', '1', '林小艺');
INSERT INTO `phyman_scan` VALUES ('201522040841', '讲座', '1', '邓迪夫');
INSERT INTO `phyman_scan` VALUES ('201522040842', '讲座', '1', '周细磅');
INSERT INTO `phyman_scan` VALUES ('201522040843', '讲座', '1', '李娅');
INSERT INTO `phyman_scan` VALUES ('201522040844', '讲座', '1', '桂文超');
INSERT INTO `phyman_scan` VALUES ('201522040845', '讲座', '1', '张婷');
INSERT INTO `phyman_scan` VALUES ('201522040846', '讲座', '1', '吴义忠');
INSERT INTO `phyman_scan` VALUES ('201522040847', '讲座', '1', '丁仁杰');
INSERT INTO `phyman_scan` VALUES ('201522040848', '讲座', '1', '刘智超');
INSERT INTO `phyman_scan` VALUES ('201522040849', '讲座', '1', '赵健翔');
INSERT INTO `phyman_scan` VALUES ('201522040850', '讲座', '1', '黄澍程');
INSERT INTO `phyman_scan` VALUES ('201522040851', '讲座', '1', '张引');
INSERT INTO `phyman_scan` VALUES ('201522040852', '讲座', '1', '陈家林');
INSERT INTO `phyman_scan` VALUES ('201522040853', '讲座', '1', '李保山');
INSERT INTO `phyman_scan` VALUES ('201522040854', '讲座', '1', '王家福');
INSERT INTO `phyman_scan` VALUES ('201522040855', '讲座', '1', '李仕峰');
INSERT INTO `phyman_scan` VALUES ('201522040856', '讲座', '1', '刘美玉');
INSERT INTO `phyman_scan` VALUES ('201522040857', '讲座', '1', '盛昌建');
INSERT INTO `phyman_scan` VALUES ('201522040858', '讲座', '1', '王奇');
INSERT INTO `phyman_scan` VALUES ('201522040859', '讲座', '1', '黄娜');
INSERT INTO `phyman_scan` VALUES ('201522040860', '讲座', '1', '王影');
INSERT INTO `phyman_scan` VALUES ('201522040861', '讲座', '1', '王明寿');
INSERT INTO `phyman_scan` VALUES ('201522040862', '讲座', '1', '罗智');
INSERT INTO `phyman_scan` VALUES ('201522040863', '讲座', '1', '王兰');
INSERT INTO `phyman_scan` VALUES ('201522040864', '讲座', '1', '李洪平');
INSERT INTO `phyman_scan` VALUES ('201522040865', '讲座', '1', '金磊');
INSERT INTO `phyman_scan` VALUES ('201522040866', '讲座', '1', '毛伟');
INSERT INTO `phyman_scan` VALUES ('201522040867', '讲座', '1', '李一鸣');
INSERT INTO `phyman_scan` VALUES ('201522040868', '讲座', '1', '段正杰');
INSERT INTO `phyman_scan` VALUES ('201522040869', '讲座', '1', '彭坤');
INSERT INTO `phyman_scan` VALUES ('201522040870', '讲座', '1', '蔡雪丹');
INSERT INTO `phyman_scan` VALUES ('201522040871', '讲座', '1', '阚增辉');
INSERT INTO `phyman_scan` VALUES ('201522040872', '讲座', '1', '向飞龙');
INSERT INTO `phyman_scan` VALUES ('201522040873', '讲座', '1', '宋泽林');
INSERT INTO `phyman_scan` VALUES ('201522040874', '讲座', '1', '王盛');
INSERT INTO `phyman_scan` VALUES ('201522040875', '讲座', '1', '钟俊男');
INSERT INTO `phyman_scan` VALUES ('201522040876', '讲座', '1', '张海洋');
INSERT INTO `phyman_scan` VALUES ('201522040877', '讲座', '1', '杨君宇');
INSERT INTO `phyman_scan` VALUES ('201522040878', '讲座', '1', '李勇');
INSERT INTO `phyman_scan` VALUES ('201522040840', 'test1', '96586201070305325', '林小艺');
INSERT INTO `phyman_scan` VALUES ('201522040841', 'test1', '96586201070305325', '邓迪夫');
INSERT INTO `phyman_scan` VALUES ('201522040981', null, null, '班级');
INSERT INTO `phyman_scan` VALUES ('201522040980', '11111', '96594638550335493', '林小艺');
INSERT INTO `phyman_scan` VALUES ('201522040840', '11111', '96594638550335493', '林小艺');
INSERT INTO `phyman_scan` VALUES ('201522040981', 'TEE', '96594686751277057', '班级');
INSERT INTO `phyman_scan` VALUES ('201522040874', 'TEE', '96594686751277057', '王盛');
INSERT INTO `phyman_scan` VALUES ('201522040863', 'TEE', '96594686751277057', '王兰');
INSERT INTO `phyman_scan` VALUES ('201522040849', 'TEE', '96594686751277057', '赵健翔');
INSERT INTO `phyman_scan` VALUES ('201522040841', 'TEE', '96594686751277057', '邓迪夫');
INSERT INTO `phyman_scan` VALUES ('201522040840', 'TEE', '96594686751277057', '林小艺');
INSERT INTO `phyman_scan` VALUES ('201522040840', '1111111', '96601535831605249', '林小艺');
INSERT INTO `phyman_scan` VALUES ('201522040842', '1111111', '96601535831605249', '周细磅');

-- ----------------------------
-- Table structure for `phyman_scan_count`
-- ----------------------------
DROP TABLE IF EXISTS `phyman_scan_count`;
CREATE TABLE `phyman_scan_count` (
  `id` bigint(12) NOT NULL,
  `count` int(2) DEFAULT '0',
  `grade` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of phyman_scan_count
-- ----------------------------
INSERT INTO `phyman_scan_count` VALUES ('201522040840', '10', '研一');
INSERT INTO `phyman_scan_count` VALUES ('201522040841', '13', '研一');
INSERT INTO `phyman_scan_count` VALUES ('201522040842', '5', '研一');
INSERT INTO `phyman_scan_count` VALUES ('201522040843', '6', '研一');
INSERT INTO `phyman_scan_count` VALUES ('201522040844', '5', '研一');
INSERT INTO `phyman_scan_count` VALUES ('201522040845', '4', '研一');
INSERT INTO `phyman_scan_count` VALUES ('201522040846', '7', '研一');
INSERT INTO `phyman_scan_count` VALUES ('201522040847', '8', '研一');
INSERT INTO `phyman_scan_count` VALUES ('201522040848', '8', '研一');
INSERT INTO `phyman_scan_count` VALUES ('201522040849', '7', '研一');
INSERT INTO `phyman_scan_count` VALUES ('201522040850', '5', '研一');
INSERT INTO `phyman_scan_count` VALUES ('201522040851', '5', '研一');
INSERT INTO `phyman_scan_count` VALUES ('201522040852', '3', '研一');
INSERT INTO `phyman_scan_count` VALUES ('201522040853', '1', '研一');
INSERT INTO `phyman_scan_count` VALUES ('201522040854', '7', '研一');
INSERT INTO `phyman_scan_count` VALUES ('201522040855', '9', '研一');
INSERT INTO `phyman_scan_count` VALUES ('201522040856', '8', '研一');
INSERT INTO `phyman_scan_count` VALUES ('201522040857', '7', '研一');
INSERT INTO `phyman_scan_count` VALUES ('201522040858', '6', '研一');
INSERT INTO `phyman_scan_count` VALUES ('201522040859', '6', '研一');
INSERT INTO `phyman_scan_count` VALUES ('201522040860', '0', '研一');
INSERT INTO `phyman_scan_count` VALUES ('201522040861', '6', '研一');
INSERT INTO `phyman_scan_count` VALUES ('201522040862', '6', '研三');
INSERT INTO `phyman_scan_count` VALUES ('201522040863', '6', '大一');
INSERT INTO `phyman_scan_count` VALUES ('201522040864', '0', '研一');
INSERT INTO `phyman_scan_count` VALUES ('201522040865', '54', '研一');
INSERT INTO `phyman_scan_count` VALUES ('201522040866', '4', '研一');
INSERT INTO `phyman_scan_count` VALUES ('201522040867', '3', '研一');
INSERT INTO `phyman_scan_count` VALUES ('201522040868', '2', '研一');
INSERT INTO `phyman_scan_count` VALUES ('201522040869', '4', '研一');
INSERT INTO `phyman_scan_count` VALUES ('201522040870', '3', '研三');
INSERT INTO `phyman_scan_count` VALUES ('201522040871', '3', '大二');
INSERT INTO `phyman_scan_count` VALUES ('201522040872', '3', '研一');
INSERT INTO `phyman_scan_count` VALUES ('201522040873', '3', '大三');
INSERT INTO `phyman_scan_count` VALUES ('201522040874', '32', '研一');
INSERT INTO `phyman_scan_count` VALUES ('201522040875', '2', '研一');
INSERT INTO `phyman_scan_count` VALUES ('201522040876', '2', '大四');
INSERT INTO `phyman_scan_count` VALUES ('201522040877', '2', '研一');
INSERT INTO `phyman_scan_count` VALUES ('201522040878', '2', '研二');

-- ----------------------------
-- Table structure for `phyman_scan_type`
-- ----------------------------
DROP TABLE IF EXISTS `phyman_scan_type`;
CREATE TABLE `phyman_scan_type` (
  `id` bigint(25) NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of phyman_scan_type
-- ----------------------------

-- ----------------------------
-- Table structure for `phyman_type`
-- ----------------------------
DROP TABLE IF EXISTS `phyman_type`;
CREATE TABLE `phyman_type` (
  `id` bigint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID，主键，自动以此升序排列',
  `name` varchar(10) DEFAULT NULL COMMENT '文章、投票种类名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of phyman_type
-- ----------------------------
INSERT INTO `phyman_type` VALUES ('1', '时间');
INSERT INTO `phyman_type` VALUES ('2', '时间');

-- ----------------------------
-- Table structure for `phyman_user`
-- ----------------------------
DROP TABLE IF EXISTS `phyman_user`;
CREATE TABLE `phyman_user` (
  `id` bigint(12) NOT NULL AUTO_INCREMENT COMMENT '学号',
  `name` varchar(10) DEFAULT NULL,
  `psw` varchar(255) NOT NULL COMMENT '密码',
  `authority` varchar(8) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `grade` varchar(10) DEFAULT NULL,
  `mailbox` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=201522040982 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of phyman_user
-- ----------------------------
INSERT INTO `phyman_user` VALUES ('201522040840', '林小艺', '12345678', 'admin', null, '研一', null);
INSERT INTO `phyman_user` VALUES ('201522040841', '邓迪夫', 'c56d0e9a7ccec67b4ea131655038d604', 'admin', '', '研一', 'www.baidu.com');
INSERT INTO `phyman_user` VALUES ('201522040842', '周细磅', '201522040842', 'user', '0', '研一', '0');
INSERT INTO `phyman_user` VALUES ('201522040843', '李娅', '201522040843', 'user', '0', '研一', '0');
INSERT INTO `phyman_user` VALUES ('201522040844', '桂文超', '201522040844', 'user', '0', '研一', '0');
INSERT INTO `phyman_user` VALUES ('201522040845', '张婷', '201522040845', 'user', '0', '研一', '0');
INSERT INTO `phyman_user` VALUES ('201522040846', '吴义忠', '201522040846', 'user', '0', '研一', '0');
INSERT INTO `phyman_user` VALUES ('201522040847', '丁仁杰', '201522040847', 'user', '0', '研一', '0');
INSERT INTO `phyman_user` VALUES ('201522040848', '刘智超', '201522040848', 'user', '0', '研一', '0');
INSERT INTO `phyman_user` VALUES ('201522040849', '赵健翔', '201522040849', 'user', '0', '研一', '0');
INSERT INTO `phyman_user` VALUES ('201522040850', '黄澍程', '201522040850', 'user', '0', '研一', '0');
INSERT INTO `phyman_user` VALUES ('201522040851', '张引', '201522040851', 'user', '0', '研一', '0');
INSERT INTO `phyman_user` VALUES ('201522040852', '陈家林', '201522040852', 'user', '0', '研一', '0');
INSERT INTO `phyman_user` VALUES ('201522040853', '李保山', '201522040853', 'user', '0', '研一', '0');
INSERT INTO `phyman_user` VALUES ('201522040854', '王家福', '201522040854', 'user', '0', '研一', '0');
INSERT INTO `phyman_user` VALUES ('201522040855', '李仕峰', '201522040855', 'user', '0', '研一', '0');
INSERT INTO `phyman_user` VALUES ('201522040856', '刘美玉', '201522040856', 'user', '0', '研一', '0');
INSERT INTO `phyman_user` VALUES ('201522040857', '盛昌建', '201522040857', 'user', '0', '研一', '0');
INSERT INTO `phyman_user` VALUES ('201522040858', '王奇', '201522040858', 'admin', '0', '研一', '0');
INSERT INTO `phyman_user` VALUES ('201522040859', '黄娜', '201522040859', 'user', '0', '研一', '0');
INSERT INTO `phyman_user` VALUES ('201522040860', '王影', '201522040860', 'user', '0', '研一', '0');
INSERT INTO `phyman_user` VALUES ('201522040861', '王明寿', '201522040861', '学生', '0', '研一', '0');
INSERT INTO `phyman_user` VALUES ('201522040862', '罗智', '201522040862', 'user', '0', '研一', '0');
INSERT INTO `phyman_user` VALUES ('201522040863', '王兰', '201522040863', 'user', '0', '研一', '0');
INSERT INTO `phyman_user` VALUES ('201522040864', '李洪平', '201522040864', 'user', '0', '研一', '0');
INSERT INTO `phyman_user` VALUES ('201522040865', '金磊', '201522040865', 'user', '0', '研一', '0');
INSERT INTO `phyman_user` VALUES ('201522040866', '毛伟', '201522040866', 'user', '0', '研一', '0');
INSERT INTO `phyman_user` VALUES ('201522040867', '李一鸣', '201522040867', 'user', '0', '研一', '0');
INSERT INTO `phyman_user` VALUES ('201522040868', '段正杰', '201522040868', 'user', '0', '研一', '0');
INSERT INTO `phyman_user` VALUES ('201522040869', '彭坤', '201522040869', 'user', '0', '研一', '0');
INSERT INTO `phyman_user` VALUES ('201522040870', '蔡雪丹', '201522040870', 'user', '0', '研一', '0');
INSERT INTO `phyman_user` VALUES ('201522040871', '阚增辉', '201522040871', 'user', '0', '研一', '0');
INSERT INTO `phyman_user` VALUES ('201522040872', '向飞龙', '201522040872', 'user', '0', '研一', '0');
INSERT INTO `phyman_user` VALUES ('201522040873', '宋泽林', '201522040873', 'user', '0', '研一', '0');
INSERT INTO `phyman_user` VALUES ('201522040874', '王盛', '201522040874', 'user', '0', '研一', '0');
INSERT INTO `phyman_user` VALUES ('201522040875', '钟俊男', '201522040875', 'user', '0', '研一', '0');
INSERT INTO `phyman_user` VALUES ('201522040876', '张海洋', '201522040876', 'user', '0', '研一', '0');
INSERT INTO `phyman_user` VALUES ('201522040877', '杨君宇', '201522040877', 'user', '0', '研一', '0');
INSERT INTO `phyman_user` VALUES ('201522040878', '李勇', '201522040878', 'user', '0', '研一', '0');
INSERT INTO `phyman_user` VALUES ('201522040980', '林小艺', '12345678', 'admin', '0', '研一', '0');
INSERT INTO `phyman_user` VALUES ('201522040981', '班级', '姓名', '电话', '宿舍号', '专业', '导师');

-- ----------------------------
-- Table structure for `phyman_vote`
-- ----------------------------
DROP TABLE IF EXISTS `phyman_vote`;
CREATE TABLE `phyman_vote` (
  `id` bigint(15) unsigned NOT NULL AUTO_INCREMENT COMMENT '投票ID(年月日时分秒例如：20160102105801)',
  `title` varchar(100) DEFAULT NULL,
  `body` varchar(6000) DEFAULT NULL,
  `type` int(2) DEFAULT NULL,
  `begtime` datetime NOT NULL,
  `endtime` datetime NOT NULL,
  `uid` bigint(12) DEFAULT NULL COMMENT '投票发布者ID',
  `tid` bigint(5) DEFAULT NULL COMMENT '文章种类ID',
  `options` varchar(200) NOT NULL,
  `grade` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=96594638550335492 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of phyman_vote
-- ----------------------------
INSERT INTO `phyman_vote` VALUES ('96584681255862275', '物理电子学院', '', '0', '2016-04-29 00:00:00', '2016-04-30 00:00:00', null, null, '物理电子学院1;物理电子学院2;物理电子学院3;', '研一;');
INSERT INTO `phyman_vote` VALUES ('96594638550335491', 'test', '1111', '0', '2016-05-06 16:09:20', '2016-05-07 00:00:00', null, null, '1111;2222;333;', '研一;大四;');

-- ----------------------------
-- Table structure for `phyman_vote_options`
-- ----------------------------
DROP TABLE IF EXISTS `phyman_vote_options`;
CREATE TABLE `phyman_vote_options` (
  `vid` bigint(14) DEFAULT NULL COMMENT '投票ID',
  `content` varchar(255) DEFAULT NULL,
  `id` bigint(14) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of phyman_vote_options
-- ----------------------------
INSERT INTO `phyman_vote_options` VALUES ('96584681255862275', '物理电子学院1', '1');
INSERT INTO `phyman_vote_options` VALUES ('96584681255862275', '物理电子学院2', '2');
INSERT INTO `phyman_vote_options` VALUES ('96584681255862275', '物理电子学院3', '3');
INSERT INTO `phyman_vote_options` VALUES ('96594638550335491', '1111', '1');
INSERT INTO `phyman_vote_options` VALUES ('96594638550335491', '2222', '2');
INSERT INTO `phyman_vote_options` VALUES ('96594638550335491', '333', '3');

-- ----------------------------
-- Table structure for `phyman_vote_user96584681255862275`
-- ----------------------------
DROP TABLE IF EXISTS `phyman_vote_user96584681255862275`;
CREATE TABLE `phyman_vote_user96584681255862275` (
  `id` bigint(12) NOT NULL,
  `name` varchar(10) DEFAULT NULL,
  `grade` varchar(10) DEFAULT NULL,
  `choose` int(2) NOT NULL DEFAULT '0',
  `options` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of phyman_vote_user96584681255862275
-- ----------------------------
INSERT INTO `phyman_vote_user96584681255862275` VALUES ('201522040840', '林小艺', '研一', '1', '2;');
INSERT INTO `phyman_vote_user96584681255862275` VALUES ('201522040841', '邓迪夫', '研一', '0', null);
INSERT INTO `phyman_vote_user96584681255862275` VALUES ('201522040842', '周细磅', '研一', '0', null);
INSERT INTO `phyman_vote_user96584681255862275` VALUES ('201522040843', '李娅', '研一', '1', '2;');
INSERT INTO `phyman_vote_user96584681255862275` VALUES ('201522040844', '桂文超', '研一', '0', null);
INSERT INTO `phyman_vote_user96584681255862275` VALUES ('201522040845', '张婷', '研一', '0', null);
INSERT INTO `phyman_vote_user96584681255862275` VALUES ('201522040846', '吴义忠', '研一', '0', null);
INSERT INTO `phyman_vote_user96584681255862275` VALUES ('201522040847', '丁仁杰', '研一', '0', null);
INSERT INTO `phyman_vote_user96584681255862275` VALUES ('201522040848', '刘智超', '研一', '0', null);
INSERT INTO `phyman_vote_user96584681255862275` VALUES ('201522040849', '赵健翔', '研一', '1', '2;');
INSERT INTO `phyman_vote_user96584681255862275` VALUES ('201522040850', '黄澍程', '研一', '0', null);
INSERT INTO `phyman_vote_user96584681255862275` VALUES ('201522040851', '张引', '研一', '0', null);
INSERT INTO `phyman_vote_user96584681255862275` VALUES ('201522040852', '陈家林', '研一', '0', null);
INSERT INTO `phyman_vote_user96584681255862275` VALUES ('201522040853', '李保山', '研一', '0', null);
INSERT INTO `phyman_vote_user96584681255862275` VALUES ('201522040854', '王家福', '研一', '0', null);
INSERT INTO `phyman_vote_user96584681255862275` VALUES ('201522040855', '李仕峰', '研一', '0', null);
INSERT INTO `phyman_vote_user96584681255862275` VALUES ('201522040856', '刘美玉', '研一', '0', null);
INSERT INTO `phyman_vote_user96584681255862275` VALUES ('201522040857', '盛昌建', '研一', '0', null);
INSERT INTO `phyman_vote_user96584681255862275` VALUES ('201522040858', '王奇', '研一', '0', null);
INSERT INTO `phyman_vote_user96584681255862275` VALUES ('201522040859', '黄娜', '研一', '0', null);
INSERT INTO `phyman_vote_user96584681255862275` VALUES ('201522040860', '王影', '研一', '0', null);
INSERT INTO `phyman_vote_user96584681255862275` VALUES ('201522040861', '王明寿', '研一', '0', null);
INSERT INTO `phyman_vote_user96584681255862275` VALUES ('201522040862', '罗智', '研一', '0', null);
INSERT INTO `phyman_vote_user96584681255862275` VALUES ('201522040863', '王兰', '研一', '0', null);
INSERT INTO `phyman_vote_user96584681255862275` VALUES ('201522040864', '李洪平', '研一', '0', null);
INSERT INTO `phyman_vote_user96584681255862275` VALUES ('201522040865', '金磊', '研一', '0', null);
INSERT INTO `phyman_vote_user96584681255862275` VALUES ('201522040866', '毛伟', '研一', '0', null);
INSERT INTO `phyman_vote_user96584681255862275` VALUES ('201522040867', '李一鸣', '研一', '0', null);
INSERT INTO `phyman_vote_user96584681255862275` VALUES ('201522040868', '段正杰', '研一', '0', null);
INSERT INTO `phyman_vote_user96584681255862275` VALUES ('201522040869', '彭坤', '研一', '0', null);
INSERT INTO `phyman_vote_user96584681255862275` VALUES ('201522040870', '蔡雪丹', '研一', '0', null);
INSERT INTO `phyman_vote_user96584681255862275` VALUES ('201522040871', '阚增辉', '研一', '0', null);
INSERT INTO `phyman_vote_user96584681255862275` VALUES ('201522040872', '向飞龙', '研一', '0', null);
INSERT INTO `phyman_vote_user96584681255862275` VALUES ('201522040873', '宋泽林', '研一', '0', null);
INSERT INTO `phyman_vote_user96584681255862275` VALUES ('201522040874', '王盛', '研一', '0', null);
INSERT INTO `phyman_vote_user96584681255862275` VALUES ('201522040875', '钟俊男', '研一', '0', null);
INSERT INTO `phyman_vote_user96584681255862275` VALUES ('201522040876', '张海洋', '研一', '0', null);
INSERT INTO `phyman_vote_user96584681255862275` VALUES ('201522040877', '杨君宇', '研一', '0', null);
INSERT INTO `phyman_vote_user96584681255862275` VALUES ('201522040878', '李勇', '研一', '0', null);

-- ----------------------------
-- Table structure for `phyman_vote_user96594638550335490`
-- ----------------------------
DROP TABLE IF EXISTS `phyman_vote_user96594638550335490`;
CREATE TABLE `phyman_vote_user96594638550335490` (
  `id` bigint(12) NOT NULL,
  `name` varchar(10) DEFAULT NULL,
  `grade` varchar(10) DEFAULT NULL,
  `choose` int(2) NOT NULL DEFAULT '0',
  `options` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of phyman_vote_user96594638550335490
-- ----------------------------
INSERT INTO `phyman_vote_user96594638550335490` VALUES ('201522040840', '林小艺', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335490` VALUES ('201522040841', '邓迪夫', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335490` VALUES ('201522040842', '周细磅', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335490` VALUES ('201522040843', '李娅', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335490` VALUES ('201522040844', '桂文超', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335490` VALUES ('201522040845', '张婷', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335490` VALUES ('201522040846', '吴义忠', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335490` VALUES ('201522040847', '丁仁杰', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335490` VALUES ('201522040848', '刘智超', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335490` VALUES ('201522040849', '赵健翔', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335490` VALUES ('201522040850', '黄澍程', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335490` VALUES ('201522040851', '张引', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335490` VALUES ('201522040852', '陈家林', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335490` VALUES ('201522040853', '李保山', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335490` VALUES ('201522040854', '王家福', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335490` VALUES ('201522040855', '李仕峰', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335490` VALUES ('201522040856', '刘美玉', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335490` VALUES ('201522040857', '盛昌建', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335490` VALUES ('201522040858', '王奇', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335490` VALUES ('201522040859', '黄娜', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335490` VALUES ('201522040860', '王影', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335490` VALUES ('201522040861', '王明寿', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335490` VALUES ('201522040862', '罗智', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335490` VALUES ('201522040863', '王兰', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335490` VALUES ('201522040864', '李洪平', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335490` VALUES ('201522040865', '金磊', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335490` VALUES ('201522040866', '毛伟', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335490` VALUES ('201522040867', '李一鸣', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335490` VALUES ('201522040868', '段正杰', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335490` VALUES ('201522040869', '彭坤', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335490` VALUES ('201522040870', '蔡雪丹', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335490` VALUES ('201522040871', '阚增辉', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335490` VALUES ('201522040872', '向飞龙', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335490` VALUES ('201522040873', '宋泽林', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335490` VALUES ('201522040874', '王盛', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335490` VALUES ('201522040875', '钟俊男', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335490` VALUES ('201522040876', '张海洋', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335490` VALUES ('201522040877', '杨君宇', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335490` VALUES ('201522040878', '李勇', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335490` VALUES ('201522040980', '林小艺', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335490` VALUES ('201522040981', '班级', '专业', '0', null);

-- ----------------------------
-- Table structure for `phyman_vote_user96594638550335491`
-- ----------------------------
DROP TABLE IF EXISTS `phyman_vote_user96594638550335491`;
CREATE TABLE `phyman_vote_user96594638550335491` (
  `id` bigint(12) NOT NULL,
  `name` varchar(10) DEFAULT NULL,
  `grade` varchar(10) DEFAULT NULL,
  `choose` int(2) NOT NULL DEFAULT '0',
  `options` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of phyman_vote_user96594638550335491
-- ----------------------------
INSERT INTO `phyman_vote_user96594638550335491` VALUES ('201522040840', '林小艺', '研一', '1', '1;');
INSERT INTO `phyman_vote_user96594638550335491` VALUES ('201522040841', '邓迪夫', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335491` VALUES ('201522040842', '周细磅', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335491` VALUES ('201522040843', '李娅', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335491` VALUES ('201522040844', '桂文超', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335491` VALUES ('201522040845', '张婷', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335491` VALUES ('201522040846', '吴义忠', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335491` VALUES ('201522040847', '丁仁杰', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335491` VALUES ('201522040848', '刘智超', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335491` VALUES ('201522040849', '赵健翔', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335491` VALUES ('201522040850', '黄澍程', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335491` VALUES ('201522040851', '张引', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335491` VALUES ('201522040852', '陈家林', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335491` VALUES ('201522040853', '李保山', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335491` VALUES ('201522040854', '王家福', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335491` VALUES ('201522040855', '李仕峰', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335491` VALUES ('201522040856', '刘美玉', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335491` VALUES ('201522040857', '盛昌建', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335491` VALUES ('201522040858', '王奇', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335491` VALUES ('201522040859', '黄娜', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335491` VALUES ('201522040860', '王影', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335491` VALUES ('201522040861', '王明寿', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335491` VALUES ('201522040862', '罗智', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335491` VALUES ('201522040863', '王兰', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335491` VALUES ('201522040864', '李洪平', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335491` VALUES ('201522040865', '金磊', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335491` VALUES ('201522040866', '毛伟', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335491` VALUES ('201522040867', '李一鸣', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335491` VALUES ('201522040868', '段正杰', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335491` VALUES ('201522040869', '彭坤', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335491` VALUES ('201522040870', '蔡雪丹', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335491` VALUES ('201522040871', '阚增辉', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335491` VALUES ('201522040872', '向飞龙', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335491` VALUES ('201522040873', '宋泽林', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335491` VALUES ('201522040874', '王盛', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335491` VALUES ('201522040875', '钟俊男', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335491` VALUES ('201522040876', '张海洋', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335491` VALUES ('201522040877', '杨君宇', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335491` VALUES ('201522040878', '李勇', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335491` VALUES ('201522040980', '林小艺', '研一', '0', null);
INSERT INTO `phyman_vote_user96594638550335491` VALUES ('201522040981', '班级', '专业', '0', null);

-- ----------------------------
-- Table structure for `phymen_image`
-- ----------------------------
DROP TABLE IF EXISTS `phymen_image`;
CREATE TABLE `phymen_image` (
  `id` bigint(3) unsigned NOT NULL AUTO_INCREMENT,
  `address` varchar(255) DEFAULT NULL,
  `name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of phymen_image
-- ----------------------------

-- ----------------------------
-- View structure for `phyman_scans`
-- ----------------------------
DROP VIEW IF EXISTS `phyman_scans`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`127.0.0.1` SQL SECURITY DEFINER VIEW `phyman_scans` AS select `phyman_scan`.`username` AS `name`,count(0) AS `count`,`phyman_scan`.`userid` AS `id` from `phyman_scan` group by `phyman_scan`.`userid` ;

-- ----------------------------
-- View structure for `phyman_view_article`
-- ----------------------------
DROP VIEW IF EXISTS `phyman_view_article`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`127.0.0.1` SQL SECURITY DEFINER VIEW `phyman_view_article` AS select `article`.`id` AS `id`,`user`.`name` AS `name`,`article`.`title` AS `title`,`article`.`date` AS `date`,`type`.`name` AS `type`,`article`.`grade` AS `grade` from ((`phyman_article` `article` join `phyman_user` `user`) join `phyman_type` `type`) where ((`article`.`uid` = `user`.`id`) and (`article`.`tid` = `type`.`id`)) ;

-- ----------------------------
-- View structure for `phyman_view_article_user`
-- ----------------------------
DROP VIEW IF EXISTS `phyman_view_article_user`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`127.0.0.1` SQL SECURITY DEFINER VIEW `phyman_view_article_user` AS select `article`.`id` AS `id`,`user`.`id` AS `uid`,`user`.`name` AS `name`,`user`.`grade` AS `grade` from (`phyman_user` `user` join `phyman_article` `article`) where (`article`.`grade` like `user`.`grade`) ;

-- ----------------------------
-- View structure for `phyman_view_options`
-- ----------------------------
DROP VIEW IF EXISTS `phyman_view_options`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`127.0.0.1` SQL SECURITY DEFINER VIEW `phyman_view_options` AS select `opt`.`content` AS `options`,`vote`.`id` AS `id`,`opt`.`id` AS `oid` from (`phyman_vote` `vote` join `phyman_vote_options` `opt`) where (`vote`.`id` = `opt`.`vid`) ;

-- ----------------------------
-- View structure for `phyman_view_vote`
-- ----------------------------
DROP VIEW IF EXISTS `phyman_view_vote`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`127.0.0.1` SQL SECURITY DEFINER VIEW `phyman_view_vote` AS select `vote`.`id` AS `id`,`vote`.`title` AS `title`,`vote`.`begtime` AS `begtime`,`vote`.`endtime` AS `endtime`,`user`.`name` AS `name`,`type`.`name` AS `type`,`vote`.`grade` AS `grade` from ((`phyman_vote` `vote` join `phyman_user` `user`) join `phyman_type` `type`) where ((`vote`.`uid` = `user`.`id`) and (`vote`.`tid` = `type`.`id`)) ;

-- ----------------------------
-- View structure for `phyman_view_vote_user`
-- ----------------------------
DROP VIEW IF EXISTS `phyman_view_vote_user`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`127.0.0.1` SQL SECURITY DEFINER VIEW `phyman_view_vote_user` AS select `vote`.`id` AS `id`,`user`.`id` AS `uid`,`user`.`name` AS `name`,`user`.`grade` AS `grade` from (`phyman_vote` `vote` join `phyman_user` `user`) where (`vote`.`grade` like `user`.`grade`) ;
DROP TRIGGER IF EXISTS `afterinsert_on_user`;
DELIMITER ;;
CREATE TRIGGER `afterinsert_on_user` AFTER INSERT ON `phyman_user` FOR EACH ROW BEGIN 
     insert into phyman_scan (userid,username) values(new.id,new.name); 
END
;;
DELIMITER ;
