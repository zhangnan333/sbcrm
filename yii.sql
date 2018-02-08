/*
 Navicat MySQL Data Transfer

 Source Server         : myself
 Source Server Version : 50721
 Source Host           : localhost
 Source Database       : yii

 Target Server Version : 50721
 File Encoding         : utf-8

 Date: 02/08/2018 17:00:58 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `business`
-- ----------------------------
DROP TABLE IF EXISTS `business`;
CREATE TABLE `business` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `c_status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '0咨询 1签约 2暂停 4停缴 8终止',
  `business_name` varchar(255) NOT NULL DEFAULT '' COMMENT '企业名称',
  `address` varchar(255) DEFAULT '' COMMENT '地址',
  `tel` varchar(20) DEFAULT NULL COMMENT '电话',
  `buy_date` date NOT NULL DEFAULT '1970-01-01' COMMENT '签约时间',
  `over_date` date NOT NULL DEFAULT '1970-01-01' COMMENT '合同到期时间',
  `linkman` varchar(50) NOT NULL DEFAULT '' COMMENT '联系人',
  `min_sprice` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '最低服务费',
  `unit_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '每人服务费',
  `kf_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '客户专员',
  `responsible` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '负责人',
  `personnel` varchar(10) DEFAULT NULL COMMENT '人事负责人',
  `finance` varchar(10) DEFAULT NULL COMMENT '财务负责人',
  `comment_info` text COMMENT '备注',
  `mobile` int(11) DEFAULT NULL COMMENT '电话',
  `email` varchar(255) DEFAULT NULL COMMENT '邮件',
  `change_personnel_day` int(11) NOT NULL DEFAULT '1',
  `pay_day` int(11) NOT NULL DEFAULT '1',
  `pay_type` int(11) NOT NULL,
  `fax` varchar(50) DEFAULT NULL COMMENT '传真',
  `express` varchar(50) DEFAULT NULL COMMENT '快递',
  `bill` varchar(50) DEFAULT NULL COMMENT '发票/台账',
  `service_info` varchar(255) DEFAULT NULL COMMENT '服务项目',
  `contract_no` char(30) DEFAULT NULL COMMENT '合同编号',
  PRIMARY KEY (`id`),
  UNIQUE KEY `business_name` (`business_name`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='企业客户';

-- ----------------------------
--  Records of `business`
-- ----------------------------
BEGIN;
INSERT INTO `business` VALUES ('1', '1', '个人客户中心', 'sdfsdfs', 'dfsdfsd', '2013-05-01', '2018-02-08', 'sdfsdf', '0.00', '0.00', '0', '0', null, null, '', null, null, '19700101', '19700101', '0', null, null, null, null, null), ('6', '1', '伟蓝', '地球', '1888888888', '2018-01-01', '2020-01-01', '大声道', '500.00', '20.00', '4', '5', '安达市', 'ad', '已签约', '1888888888', '111@qwwq.com', '12', '12', '0', '112121', '地球', '1', '企鹅', null);
COMMIT;

-- ----------------------------
--  Table structure for `customer`
-- ----------------------------
DROP TABLE IF EXISTS `customer`;
CREATE TABLE `customer` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '姓名',
  `id_card` char(18) NOT NULL DEFAULT '' COMMENT '身份证号',
  `sex` enum('男','女','0') NOT NULL DEFAULT '0' COMMENT '性别',
  `hk_addr` varchar(255) DEFAULT '' COMMENT '户口所在地',
  `mobile` varchar(15) DEFAULT NULL COMMENT '手机',
  `phone` varchar(50) DEFAULT NULL COMMENT '电话',
  `buy_date` date NOT NULL DEFAULT '1970-01-01' COMMENT '????????',
  `over_date` date NOT NULL DEFAULT '1970-01-01' COMMENT '??????',
  `kf_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '客户专员',
  `responsible` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '负责人',
  `comment_info` text COMMENT '备注',
  `b_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '企业ID',
  `c_status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '0咨询 1签约 2暂停 4停缴 8终止',
  `wages` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '工资',
  `ssf_type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '社保类型',
  `service_charge` decimal(8,2) DEFAULT '0.00' COMMENT 'æœåŠ¡è´¹',
  `sc_type` enum('month','semester','year') DEFAULT 'month' COMMENT 'ç¼´è´¹æ–¹å¼',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_mobile` (`name`,`mobile`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='客户表';

-- ----------------------------
--  Records of `customer`
-- ----------------------------
BEGIN;
INSERT INTO `customer` VALUES ('1', 'Flowf', '1111111222333', '男', '', '', '', '2013-05-01', '2013-11-01', '4', '5', '参保月推算三个月内的可被养老保险和公积金，有小额利息。', '1', '1', '6000.00', '4', '0.00', 'month'), ('2', 'Jobs', '11111111111', '男', '', 'ddd', '', '2013-05-01', '2013-10-31', '0', '0', '', '1', '1', '5000.00', '0', '0.00', 'month'), ('3', '韩必记', '222222222222222222', '男', '', '8613855142280', '8613855142280', '2013-05-10', '2013-10-10', '0', '0', 'sdfdsfsdf', '2', '1', '6000.00', '0', '0.00', 'month'), ('4', 'Han BiJi', '342444444', '男', '合肥', '13855142280', '13855142280', '2013-05-01', '2013-06-01', '0', '0', '', '1', '1', '3000.00', '0', '0.00', 'month'), ('5', '123', '123123123123123123', '女', '深圳市罗湖区深南东路2001号鸿昌广场3903-E', '13555555555', '0755-68545454', '2013-05-01', '2014-04-30', '0', '0', '', '5', '1', '4400.00', '0', '0.00', 'month'), ('7', '李三', '612727199409085422', '男', '123', '18999999999', '18999999999', '2018-01-02', '2018-03-31', '4', '5', '', '6', '1', '3000.00', '3', '25.00', 'month');
COMMIT;

-- ----------------------------
--  Table structure for `customer_recharge`
-- ----------------------------
DROP TABLE IF EXISTS `customer_recharge`;
CREATE TABLE `customer_recharge` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `u_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `u_type` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '1个人，2企业',
  `money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '金额',
  `money_entry` datetime DEFAULT NULL COMMENT '到帐时间',
  `send_bank_name` varchar(255) NOT NULL DEFAULT '' COMMENT '付款银行',
  `send_bank_card` varchar(255) NOT NULL DEFAULT '' COMMENT '付款卡号',
  `bank_name` varchar(255) NOT NULL DEFAULT '' COMMENT '收款银行',
  `bank_card` varchar(255) NOT NULL DEFAULT '' COMMENT '收款卡号',
  `data_entry` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '数据导入系统时间',
  `admin_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '操作人',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='客户充值记录';

-- ----------------------------
--  Records of `customer_recharge`
-- ----------------------------
BEGIN;
INSERT INTO `customer_recharge` VALUES ('2', '1', '1', '5000.00', '2013-05-21 00:00:00', 'icbc', '222222', 'ccb', '444444', '2013-05-22 15:04:24', '1'), ('3', '2', '1', '6000.00', '2013-05-11 00:00:00', 'icbc', '222222', 'ccb', '444444', '2013-05-22 15:04:51', '1'), ('4', '4', '1', '200.00', '2013-05-21 00:00:00', 'icbc', '222222', 'ccb', '444444', '2013-05-22 19:52:01', '1'), ('5', '3', '2', '5000.00', '2013-05-21 00:00:00', 'icbc', '222222', 'ccb', '444444', '2013-05-22 20:37:11', '1'), ('6', '2', '2', '5000.00', '2013-05-15 00:00:00', 'icbc', '222222', 'ccb', '444444', '2013-05-22 20:38:07', '1'), ('7', '6', '2', '12344.00', '2018-01-01 00:00:00', '招商', '12121212', '招商', '211212', '2018-02-08 15:11:31', '1'), ('8', '6', '2', '1234.00', '2018-01-01 00:00:00', '招商', '213', '招商', '123123', '2018-02-08 15:21:59', '1'), ('9', '6', '2', '11111.00', '2018-01-01 00:00:00', '招商', '12', '招商', '1212', '2018-02-08 15:25:35', '1');
COMMIT;

-- ----------------------------
--  Table structure for `customer_ssf`
-- ----------------------------
DROP TABLE IF EXISTS `customer_ssf`;
CREATE TABLE `customer_ssf` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `u_id` int(11) unsigned NOT NULL DEFAULT '0',
  `ssf_id` int(11) unsigned NOT NULL DEFAULT '0',
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `add_user` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=68 DEFAULT CHARSET=utf8 COMMENT='员工社保项';

-- ----------------------------
--  Records of `customer_ssf`
-- ----------------------------
BEGIN;
INSERT INTO `customer_ssf` VALUES ('11', '3', '1', '2013-05-11 19:53:16', '1'), ('12', '3', '2', '2013-05-11 19:53:16', '1'), ('13', '3', '3', '2013-05-11 19:53:16', '1'), ('25', '5', '1', '2013-05-23 15:41:55', '1'), ('26', '5', '2', '2013-05-23 15:41:55', '1'), ('27', '5', '3', '2013-05-23 15:41:55', '1'), ('36', '4', '2', '2013-06-14 22:21:53', '1'), ('37', '4', '3', '2013-06-14 22:21:53', '1'), ('38', '4', '4', '2013-06-14 22:21:53', '1'), ('39', '4', '5', '2013-06-14 22:21:53', '1'), ('47', '2', '1', '2013-07-09 22:25:30', '1'), ('48', '2', '2', '2013-07-09 22:25:30', '1'), ('49', '2', '3', '2013-07-09 22:25:30', '1'), ('50', '2', '4', '2013-07-09 22:25:30', '1'), ('51', '2', '5', '2013-07-09 22:25:30', '1'), ('52', '2', '6', '2013-07-09 22:25:30', '1'), ('53', '2', '7', '2013-07-09 22:25:30', '1'), ('54', '1', '2', '2013-07-23 21:46:00', '1'), ('55', '1', '3', '2013-07-23 21:46:00', '1'), ('56', '1', '4', '2013-07-23 21:46:00', '1'), ('57', '1', '6', '2013-07-23 21:46:00', '1'), ('58', '1', '7', '2013-07-23 21:46:00', '1'), ('59', '1', '8', '2013-07-23 21:46:00', '1'), ('60', '1', '1', '2013-07-23 21:46:00', '1'), ('61', '7', '2', '2018-02-08 14:31:53', '1'), ('62', '7', '3', '2018-02-08 14:31:53', '1'), ('63', '7', '4', '2018-02-08 14:31:53', '1'), ('64', '7', '6', '2018-02-08 14:31:53', '1'), ('65', '7', '7', '2018-02-08 14:31:53', '1'), ('66', '7', '8', '2018-02-08 14:31:53', '1'), ('67', '7', '1', '2018-02-08 14:31:53', '1');
COMMIT;

-- ----------------------------
--  Table structure for `customer_ssf_snap`
-- ----------------------------
DROP TABLE IF EXISTS `customer_ssf_snap`;
CREATE TABLE `customer_ssf_snap` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ssf_id` int(11) unsigned NOT NULL DEFAULT '0',
  `ssf_name` varchar(255) NOT NULL DEFAULT '',
  `base_number` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `business` decimal(5,2) unsigned NOT NULL DEFAULT '0.00',
  `personal` decimal(5,2) unsigned NOT NULL DEFAULT '0.00',
  `is_change` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0不 1变',
  `ssf_date` char(7) NOT NULL DEFAULT '0000-00',
  `ssf_order` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `usd` (`ssf_id`,`ssf_date`)
) ENGINE=MyISAM AUTO_INCREMENT=87 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='客户社保基金快照';

-- ----------------------------
--  Records of `customer_ssf_snap`
-- ----------------------------
BEGIN;
INSERT INTO `customer_ssf_snap` VALUES ('1', '1', '医疗保险', '2600.00', '20.00', '2.00', '1', '2013-06', '0'), ('2', '2', '失业保险', '1600.00', '2.00', '1.00', '0', '2013-06', '0'), ('3', '3', '残保金', '4595.00', '0.40', '0.00', '0', '2013-06', '0'), ('4', '4', '工伤保险', '1600.00', '0.40', '0.00', '0', '2013-06', '0'), ('5', '5', '医疗保险固定', '0.00', '8.00', '4.00', '0', '2013-06', '0'), ('6', '6', '养老保险', '1600.00', '14.00', '8.00', '1', '2013-06', '0'), ('7', '7', '生育保险', '2757.00', '0.50', '0.00', '1', '2013-06', '0'), ('8', '1', '医疗保险', '2600.00', '20.00', '2.00', '1', '2013-05', '0'), ('9', '2', '失业保险', '1600.00', '2.00', '1.00', '0', '2013-05', '0'), ('10', '3', '残保金', '4595.00', '0.40', '0.00', '0', '2013-05', '0'), ('11', '4', '工伤保险', '1600.00', '0.40', '0.00', '0', '2013-05', '0'), ('12', '5', '医疗保险固定', '0.00', '8.00', '4.00', '0', '2013-05', '0'), ('13', '6', '养老保险', '1600.00', '14.00', '8.00', '1', '2013-05', '0'), ('14', '7', '生育保险', '2757.00', '0.50', '0.00', '1', '2013-05', '0'), ('15', '1', '医疗保险', '2600.00', '20.00', '2.00', '1', '2013-5', '0'), ('16', '2', '失业保险', '1600.00', '2.00', '1.00', '0', '2013-5', '0'), ('17', '3', '残保金', '4595.00', '0.40', '0.00', '0', '2013-5', '0'), ('18', '4', '工伤保险', '1600.00', '0.40', '0.00', '0', '2013-5', '0'), ('19', '5', '医疗保险固定', '0.00', '8.00', '4.00', '0', '2013-5', '0'), ('20', '6', '养老保险', '1600.00', '14.00', '8.00', '1', '2013-5', '0'), ('21', '7', '生育保险', '2757.00', '0.50', '0.00', '1', '2013-5', '0'), ('22', '1', '医疗保险', '2600.00', '20.00', '2.00', '1', '2013-4', '0'), ('23', '2', '失业保险', '1600.00', '2.00', '1.00', '0', '2013-4', '0'), ('24', '3', '残保金', '4595.00', '0.40', '0.00', '0', '2013-4', '0'), ('25', '4', '工伤保险', '1600.00', '0.40', '0.00', '0', '2013-4', '0'), ('26', '5', '医疗保险固定', '0.00', '8.00', '4.00', '0', '2013-4', '0'), ('27', '6', '养老保险', '1600.00', '14.00', '8.00', '1', '2013-4', '0'), ('28', '7', '生育保险', '2757.00', '0.50', '0.00', '1', '2013-4', '0'), ('29', '1', '医疗保险', '2600.00', '20.00', '2.00', '1', '2013-6', '0'), ('30', '2', '失业保险', '1600.00', '2.00', '1.00', '0', '2013-6', '0'), ('31', '3', '残保金', '4595.00', '0.40', '0.00', '0', '2013-6', '0'), ('32', '4', '工伤保险', '1600.00', '0.40', '0.00', '0', '2013-6', '0'), ('33', '5', '医疗保险固定', '0.00', '8.00', '4.00', '0', '2013-6', '0'), ('34', '6', '养老保险', '1600.00', '14.00', '8.00', '1', '2013-6', '0'), ('35', '7', '生育保险', '2757.00', '0.50', '0.00', '1', '2013-6', '0'), ('36', '1', '医疗保险', '2600.00', '20.00', '2.00', '1', '2013-01', '0'), ('37', '2', '失业保险', '1600.00', '2.00', '1.00', '0', '2013-01', '0'), ('38', '3', '残保金', '4595.00', '0.40', '0.00', '0', '2013-01', '0'), ('39', '4', '工伤保险', '1600.00', '0.40', '0.00', '0', '2013-01', '0'), ('40', '5', '医疗保险固定', '0.00', '8.00', '4.00', '0', '2013-01', '0'), ('41', '6', '养老保险', '1600.00', '14.00', '8.00', '1', '2013-01', '0'), ('42', '7', '生育保险', '2757.00', '0.50', '0.00', '1', '2013-01', '0'), ('43', '1', '医疗保险', '2600.00', '20.00', '2.00', '1', '2013-04', '0'), ('44', '2', '失业保险', '1600.00', '2.00', '1.00', '0', '2013-04', '0'), ('45', '3', '残保金', '4595.00', '0.40', '0.00', '0', '2013-04', '0'), ('46', '4', '工伤保险', '1600.00', '0.40', '0.00', '0', '2013-04', '0'), ('47', '5', '医疗保险固定', '0.00', '8.00', '4.00', '0', '2013-04', '0'), ('48', '6', '养老保险', '1600.00', '14.00', '8.00', '1', '2013-04', '0'), ('49', '7', '生育保险', '2757.00', '0.50', '0.00', '1', '2013-04', '0'), ('71', '1', '医疗保险', '2600.00', '20.00', '2.00', '1', '2013-07', '0'), ('72', '2', '失业保险', '1600.00', '2.00', '1.00', '0', '2013-07', '0'), ('73', '3', '残保金', '4595.00', '0.40', '0.00', '0', '2013-07', '0'), ('74', '4', '工伤保险', '1600.00', '0.40', '0.00', '0', '2013-07', '0'), ('75', '5', '医疗保险固定', '0.00', '8.00', '4.00', '0', '2013-07', '0'), ('76', '6', '养老保险', '1600.00', '14.00', '8.00', '1', '2013-07', '0'), ('77', '7', '生育保险', '2757.00', '0.50', '0.00', '1', '2013-07', '0'), ('78', '8', '住房公积金', '1600.00', '5.00', '5.00', '1', '2013-07', '0'), ('79', '1', '医疗保险', '2600.00', '20.00', '2.00', '1', '2018-02', '0'), ('80', '2', '失业保险', '1600.00', '2.00', '1.00', '0', '2018-02', '0'), ('81', '3', '残保金', '4595.00', '0.40', '0.00', '0', '2018-02', '0'), ('82', '4', '工伤保险', '1600.00', '0.40', '0.00', '0', '2018-02', '0'), ('83', '5', '医疗保险固定', '0.00', '8.00', '4.00', '0', '2018-02', '0'), ('84', '6', '养老保险', '1600.00', '14.00', '8.00', '1', '2018-02', '0'), ('85', '7', '生育保险', '2757.00', '0.50', '0.00', '1', '2018-02', '0'), ('86', '8', '住房公积金', '1600.00', '5.00', '5.00', '1', '2018-02', '0');
COMMIT;

-- ----------------------------
--  Table structure for `documents`
-- ----------------------------
DROP TABLE IF EXISTS `documents`;
CREATE TABLE `documents` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sort_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '分类 0内容公告',
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '标题',
  `info` text COMMENT '内容',
  `user_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '发布人',
  `post_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '发布时间',
  `update_time` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `sort_id` (`sort_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='文档';

-- ----------------------------
--  Table structure for `documents_sort`
-- ----------------------------
DROP TABLE IF EXISTS `documents_sort`;
CREATE TABLE `documents_sort` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sort_name` varchar(255) NOT NULL DEFAULT '' COMMENT '分类名称',
  `sort_note` text COMMENT '分类说明',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='文档分类';

-- ----------------------------
--  Table structure for `m_role`
-- ----------------------------
DROP TABLE IF EXISTS `m_role`;
CREATE TABLE `m_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_pid` varchar(255) NOT NULL COMMENT '菜单ID',
  `s_name` int(5) NOT NULL COMMENT '用户列表',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
--  Records of `m_role`
-- ----------------------------
BEGIN;
INSERT INTO `m_role` VALUES ('5', '1,3,38,6,24,26,27,28,29,30,31', '1');
COMMIT;

-- ----------------------------
--  Table structure for `ssf`
-- ----------------------------
DROP TABLE IF EXISTS `ssf`;
CREATE TABLE `ssf` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ssf_type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '项目类型 0通用',
  `ssf_name` varchar(255) NOT NULL DEFAULT '',
  `base_number` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `business` decimal(5,2) unsigned NOT NULL DEFAULT '0.00',
  `personal` decimal(5,2) unsigned NOT NULL DEFAULT '0.00',
  `is_change` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0不 1变',
  `ssf_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ssf_order` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='social security fund';

-- ----------------------------
--  Records of `ssf`
-- ----------------------------
BEGIN;
INSERT INTO `ssf` VALUES ('1', '4', '医疗保险', '2600.00', '20.00', '2.00', '1', '2013-05-13 13:23:33', '0'), ('2', '0', '失业保险', '1600.00', '2.00', '1.00', '0', '2013-05-13 13:38:22', '0'), ('3', '0', '残保金', '4595.00', '0.40', '0.00', '0', '2013-05-13 13:38:26', '0'), ('4', '0', '工伤保险', '1600.00', '0.40', '0.00', '0', '2013-06-14 21:42:25', '0'), ('5', '3', '医疗保险固定', '0.00', '8.00', '4.00', '0', '2013-06-14 22:21:34', '0'), ('6', '0', '养老保险', '1600.00', '14.00', '8.00', '1', '2013-06-24 23:19:49', '0'), ('7', '0', '生育保险', '2757.00', '0.50', '0.00', '1', '2013-06-24 23:21:46', '0'), ('8', '0', '住房公积金', '1600.00', '5.00', '5.00', '1', '2013-07-23 21:39:40', '0');
COMMIT;

-- ----------------------------
--  Table structure for `ssf_report`
-- ----------------------------
DROP TABLE IF EXISTS `ssf_report`;
CREATE TABLE `ssf_report` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `u_id` int(11) unsigned NOT NULL DEFAULT '0',
  `ssf_money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '社保总费用',
  `paid_money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '实付',
  `pai_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '支付时间',
  `ssf_date` char(7) NOT NULL DEFAULT '' COMMENT '社保月份',
  `admin_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uid_ssf_date` (`u_id`,`ssf_date`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='社保扣款记录';

-- ----------------------------
--  Records of `ssf_report`
-- ----------------------------
BEGIN;
INSERT INTO `ssf_report` VALUES ('1', '1', '2754.78', '2754.78', '2013-06-25 09:06:47', '2013-06', '1'), ('2', '2', '1172.78', '1172.78', '2013-06-25 09:07:05', '2013-06', '1'), ('3', '4', '84.78', '84.78', '2013-06-25 09:11:19', '2013-06', '1'), ('4', '7', '1732.78', '1732.78', '2018-02-08 15:12:12', '2018-02', '1');
COMMIT;

-- ----------------------------
--  Table structure for `ssf_types`
-- ----------------------------
DROP TABLE IF EXISTS `ssf_types`;
CREATE TABLE `ssf_types` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '名称',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='社保基金项目分组';

-- ----------------------------
--  Records of `ssf_types`
-- ----------------------------
BEGIN;
INSERT INTO `ssf_types` VALUES ('1', '非深户住院'), ('2', '非深户综合'), ('3', '非深户劳务工'), ('4', '深户住院');
COMMIT;

-- ----------------------------
--  Table structure for `sys_admin`
-- ----------------------------
DROP TABLE IF EXISTS `sys_admin`;
CREATE TABLE `sys_admin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `rid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '角色ID',
  `user_name` varchar(255) NOT NULL DEFAULT '' COMMENT '用户名',
  `user_pass` char(32) NOT NULL DEFAULT '' COMMENT '密码',
  `name` varchar(255) DEFAULT NULL COMMENT '姓名',
  `last_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '最后登录时间',
  `last_ip` int(11) unsigned NOT NULL DEFAULT '0' COMMENT 'IP',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='系统用户';

-- ----------------------------
--  Records of `sys_admin`
-- ----------------------------
BEGIN;
INSERT INTO `sys_admin` VALUES ('1', '1', 'admin', '980ac217c6b51e7dc41040bec1edfec8', '管理员', '0000-00-00 00:00:00', '0'), ('4', '8', 'hbj', '980ac217c6b51e7dc41040bec1edfec8', '韩必记', '0000-00-00 00:00:00', '0'), ('5', '9', '陈XX', '980ac217c6b51e7dc41040bec1edfec8', '陈XX', '0000-00-00 00:00:00', '0');
COMMIT;

-- ----------------------------
--  Table structure for `sys_menu`
-- ----------------------------
DROP TABLE IF EXISTS `sys_menu`;
CREATE TABLE `sys_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `m_name` varchar(50) NOT NULL COMMENT '菜单名称',
  `m_parent` int(11) NOT NULL COMMENT '上级',
  `m_path` varchar(255) NOT NULL COMMENT '目录',
  `m_order` int(11) NOT NULL COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
--  Records of `sys_menu`
-- ----------------------------
BEGIN;
INSERT INTO `sys_menu` VALUES ('1', '客户中心', '0', 'business/admin', '0'), ('2', '产品中心', '0', 'customer/admin', '2'), ('3', '社保基金项管理', '0', 'ssf/admin', '3'), ('6', '系统设置', '0', '#', '6'), ('17', '友情链接', '4', 'linkfirends/admin', '17'), ('19', '广告管理', '4', 'webAdsmanageSort/admin', '19'), ('20', '留言管理', '4', 'webGuestbook/admin', '20'), ('21', '汇率管理', '4', 'webCurrency/admin', '21'), ('23', '打折码', '4', 'webCoupon/admin', '23'), ('24', '系统变量', '6', 'sysVariate/admin', '24'), ('26', '系统菜单', '6', 'sysMenu/admin', '26'), ('27', '角色菜单分配', '6', 'mRole/admin', '27'), ('28', '权限分配', '6', 'sysRoleAcl/admin', '28'), ('29', '系统用户', '6', 'sysAdmin/admin', '29'), ('30', '角色管理', '6', 'sysRole/admin', '30'), ('31', ' 权限管理', '6', 'sysRoleSource/admin', '31'), ('38', '社保类型', '3', 'ssfTypes/admin', '5');
COMMIT;

-- ----------------------------
--  Table structure for `sys_role`
-- ----------------------------
DROP TABLE IF EXISTS `sys_role`;
CREATE TABLE `sys_role` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) NOT NULL DEFAULT '' COMMENT '角色名称',
  `role_info` text COMMENT '角色说明',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='角色';

-- ----------------------------
--  Records of `sys_role`
-- ----------------------------
BEGIN;
INSERT INTO `sys_role` VALUES ('1', '系统管理员', '系统管理员'), ('8', '客服', ''), ('9', '业务人员', '');
COMMIT;

-- ----------------------------
--  Table structure for `sys_role_acl`
-- ----------------------------
DROP TABLE IF EXISTS `sys_role_acl`;
CREATE TABLE `sys_role_acl` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `rid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '角色ID',
  `controller` varchar(255) NOT NULL DEFAULT '' COMMENT '控制器',
  `action` varchar(255) NOT NULL DEFAULT '' COMMENT '方法',
  `access` enum('deny','allow') NOT NULL DEFAULT 'deny' COMMENT '权限',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='角色权限表';

-- ----------------------------
--  Records of `sys_role_acl`
-- ----------------------------
BEGIN;
INSERT INTO `sys_role_acl` VALUES ('1', '1', '*', '*', 'allow');
COMMIT;

-- ----------------------------
--  Table structure for `sys_role_source`
-- ----------------------------
DROP TABLE IF EXISTS `sys_role_source`;
CREATE TABLE `sys_role_source` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '上级ID',
  `source_value` varchar(255) NOT NULL DEFAULT '' COMMENT '资源内容',
  `source_name` varchar(255) NOT NULL DEFAULT '' COMMENT '资源名称',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='角色资源表';

-- ----------------------------
--  Records of `sys_role_source`
-- ----------------------------
BEGIN;
INSERT INTO `sys_role_source` VALUES ('1', '0', '*', '所有'), ('2', '0', 'sysRole', '角色'), ('3', '2', 'admin', '列表'), ('4', '2', 'create', '添加'), ('5', '2', 'delete', '删除'), ('6', '2', 'view', '查看'), ('7', '0', 'sysRoleAcl', '权限分配'), ('8', '7', 'admin', '列表'), ('9', '7', 'delete', '删除'), ('10', '7', 'create', '添加'), ('11', '7', 'update', '修改'), ('12', '7', 'view', '查看'), ('13', '1', '*', '所有'), ('28', '0', 'loginLogs', '登录日志'), ('31', '0', 'orders', '订单管理');
COMMIT;

-- ----------------------------
--  Table structure for `visit_log`
-- ----------------------------
DROP TABLE IF EXISTS `visit_log`;
CREATE TABLE `visit_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `u_type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1个人用户 2企业用户',
  `u_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '客户ID',
  `info` text NOT NULL,
  `vu_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '回访人',
  `visit_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `u_type` (`u_type`,`u_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='Visit the log';

-- ----------------------------
--  Records of `visit_log`
-- ----------------------------
BEGIN;
INSERT INTO `visit_log` VALUES ('1', '1', '1', '<p>sdfdsfsdfdf</p>', '1', '2013-05-08 17:21:09'), ('2', '1', '1', '<p>sdfsdfsdfsdfsdf</p>', '1', '2013-05-08 17:22:50'), ('3', '1', '1', '<p>dsfsdfdsfsdfsdf</p>', '1', '2013-05-08 17:22:58'), ('4', '1', '1', '<p><img src=\"http://localhost/sbCrm/uploads/visitLog/ac56ef1ab3959e5703f1579c745d71bf92.gif\" style=\"\"></p>', '1', '2013-05-08 17:23:14'), ('5', '2', '1', '<p>sdfsdfdsf</p>', '1', '2013-05-08 17:55:55');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
