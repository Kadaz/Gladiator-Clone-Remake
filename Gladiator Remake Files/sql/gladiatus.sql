/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50718
Source Host           : localhost:3306
Source Database       : gladiatus

Target Server Type    : MYSQL
Target Server Version : 50718
File Encoding         : 65001

Date: 2025-05-26 16:27:42
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `battle_logs`
-- ----------------------------
DROP TABLE IF EXISTS `battle_logs`;
CREATE TABLE `battle_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `player_id` int(11) NOT NULL,
  `timestamp` datetime DEFAULT CURRENT_TIMESTAMP,
  `type` varchar(20) DEFAULT 'normal',
  `zone` varchar(20) DEFAULT 'arena',
  PRIMARY KEY (`id`),
  KEY `player_id` (`player_id`),
  CONSTRAINT `battle_logs_ibfk_1` FOREIGN KEY (`player_id`) REFERENCES `gracze` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=215 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of battle_logs
-- ----------------------------
INSERT INTO `battle_logs` VALUES ('1', '6', '2025-05-22 02:48:09', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('2', '7', '2025-05-22 02:49:37', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('3', '7', '2025-05-22 03:03:49', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('4', '7', '2025-05-22 03:15:47', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('5', '7', '2025-05-22 03:15:56', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('6', '7', '2025-05-22 03:16:18', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('7', '7', '2025-05-22 03:16:24', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('8', '7', '2025-05-22 03:16:28', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('9', '7', '2025-05-22 03:16:33', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('10', '7', '2025-05-22 03:16:37', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('11', '7', '2025-05-22 03:16:41', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('12', '8', '2025-05-22 03:20:07', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('13', '8', '2025-05-22 03:20:28', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('14', '8', '2025-05-22 03:25:32', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('15', '8', '2025-05-22 03:26:03', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('16', '8', '2025-05-22 03:26:08', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('17', '8', '2025-05-22 03:26:12', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('18', '8', '2025-05-22 03:26:19', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('19', '8', '2025-05-22 03:26:50', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('20', '8', '2025-05-22 03:26:55', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('21', '8', '2025-05-22 03:27:01', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('22', '3', '2025-05-22 03:27:58', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('23', '3', '2025-05-22 03:28:10', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('24', '3', '2025-05-22 03:28:17', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('25', '3', '2025-05-22 03:28:23', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('26', '3', '2025-05-22 03:29:14', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('27', '3', '2025-05-22 03:37:48', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('28', '3', '2025-05-22 03:37:55', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('29', '3', '2025-05-22 03:38:09', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('30', '3', '2025-05-22 03:38:35', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('31', '3', '2025-05-22 03:38:40', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('32', '6', '2025-05-22 04:13:45', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('33', '7', '2025-05-22 18:36:31', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('34', '7', '2025-05-22 22:41:35', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('35', '7', '2025-05-22 22:41:47', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('36', '7', '2025-05-22 22:42:02', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('37', '7', '2025-05-22 22:42:07', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('38', '7', '2025-05-22 22:42:18', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('39', '7', '2025-05-22 23:07:18', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('40', '7', '2025-05-22 23:07:31', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('41', '6', '2025-05-22 23:12:39', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('42', '6', '2025-05-23 00:47:58', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('43', '6', '2025-05-23 00:48:10', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('44', '6', '2025-05-23 01:20:49', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('45', '7', '2025-05-23 01:32:59', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('46', '7', '2025-05-23 01:33:04', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('47', '7', '2025-05-23 01:33:08', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('48', '7', '2025-05-23 01:33:14', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('49', '7', '2025-05-23 01:33:20', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('50', '7', '2025-05-23 01:35:16', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('51', '7', '2025-05-23 01:46:02', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('52', '7', '2025-05-23 01:59:29', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('53', '7', '2025-05-23 01:59:34', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('54', '7', '2025-05-23 01:59:37', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('55', '6', '2025-05-23 02:29:39', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('56', '6', '2025-05-23 02:29:42', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('57', '6', '2025-05-23 02:29:45', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('58', '6', '2025-05-23 02:29:49', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('59', '6', '2025-05-23 02:29:52', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('60', '6', '2025-05-23 02:29:56', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('61', '6', '2025-05-23 02:29:59', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('62', '6', '2025-05-23 02:30:02', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('63', '6', '2025-05-23 02:30:06', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('64', '6', '2025-05-23 02:30:08', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('65', '6', '2025-05-23 02:47:14', 'dungeon', 'arena');
INSERT INTO `battle_logs` VALUES ('66', '6', '2025-05-23 02:47:15', 'dungeon', 'arena');
INSERT INTO `battle_logs` VALUES ('67', '6', '2025-05-23 02:47:16', 'dungeon', 'arena');
INSERT INTO `battle_logs` VALUES ('68', '6', '2025-05-23 02:47:16', 'dungeon', 'arena');
INSERT INTO `battle_logs` VALUES ('69', '6', '2025-05-23 02:47:17', 'dungeon', 'arena');
INSERT INTO `battle_logs` VALUES ('70', '6', '2025-05-23 02:47:18', 'dungeon', 'arena');
INSERT INTO `battle_logs` VALUES ('71', '6', '2025-05-23 02:47:18', 'dungeon', 'arena');
INSERT INTO `battle_logs` VALUES ('72', '6', '2025-05-23 02:47:19', 'dungeon', 'arena');
INSERT INTO `battle_logs` VALUES ('73', '6', '2025-05-23 02:47:20', 'dungeon', 'arena');
INSERT INTO `battle_logs` VALUES ('74', '6', '2025-05-23 02:47:20', 'dungeon', 'arena');
INSERT INTO `battle_logs` VALUES ('75', '7', '2025-05-23 02:52:17', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('76', '7', '2025-05-23 02:57:23', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('77', '7', '2025-05-23 04:02:21', 'normal', 'dungeon');
INSERT INTO `battle_logs` VALUES ('78', '7', '2025-05-23 04:02:41', 'normal', 'dungeon');
INSERT INTO `battle_logs` VALUES ('79', '7', '2025-05-23 04:04:41', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('80', '6', '2025-05-23 15:35:10', 'normal', 'arena_boss');
INSERT INTO `battle_logs` VALUES ('81', '6', '2025-05-23 15:35:20', 'normal', 'arena_boss');
INSERT INTO `battle_logs` VALUES ('82', '6', '2025-05-23 15:35:34', 'normal', 'arena_boss');
INSERT INTO `battle_logs` VALUES ('83', '6', '2025-05-23 15:35:40', 'normal', 'arena_boss');
INSERT INTO `battle_logs` VALUES ('84', '6', '2025-05-23 15:35:51', 'normal', 'arena_boss');
INSERT INTO `battle_logs` VALUES ('85', '6', '2025-05-23 15:48:42', 'normal', 'arena_boss');
INSERT INTO `battle_logs` VALUES ('86', '6', '2025-05-23 15:48:57', 'normal', 'arena_boss');
INSERT INTO `battle_logs` VALUES ('87', '6', '2025-05-23 15:49:28', 'normal', 'arena_boss');
INSERT INTO `battle_logs` VALUES ('88', '6', '2025-05-23 15:50:43', 'normal', 'arena_boss');
INSERT INTO `battle_logs` VALUES ('89', '6', '2025-05-23 15:50:56', 'normal', 'arena_boss');
INSERT INTO `battle_logs` VALUES ('90', '7', '2025-05-23 15:59:09', 'normal', 'arena_boss');
INSERT INTO `battle_logs` VALUES ('91', '7', '2025-05-23 16:11:59', 'normal', 'arena_boss');
INSERT INTO `battle_logs` VALUES ('92', '7', '2025-05-23 21:51:52', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('93', '7', '2025-05-23 22:10:59', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('94', '7', '2025-05-23 22:11:28', 'normal', 'arena_boss');
INSERT INTO `battle_logs` VALUES ('95', '7', '2025-05-23 22:42:57', 'normal', 'event_halloween');
INSERT INTO `battle_logs` VALUES ('96', '7', '2025-05-23 22:43:24', 'normal', 'event_halloween');
INSERT INTO `battle_logs` VALUES ('97', '7', '2025-05-23 22:43:30', 'normal', 'event_halloween');
INSERT INTO `battle_logs` VALUES ('98', '7', '2025-05-23 22:43:36', 'normal', 'event_halloween');
INSERT INTO `battle_logs` VALUES ('99', '7', '2025-05-23 22:43:42', 'normal', 'event_halloween');
INSERT INTO `battle_logs` VALUES ('100', '7', '2025-05-23 22:44:10', 'normal', 'event_christmas');
INSERT INTO `battle_logs` VALUES ('101', '7', '2025-05-23 22:44:15', 'normal', 'event_christmas');
INSERT INTO `battle_logs` VALUES ('102', '7', '2025-05-23 23:15:50', 'normal', 'event_christmas');
INSERT INTO `battle_logs` VALUES ('103', '7', '2025-05-23 23:15:58', 'normal', 'event_christmas');
INSERT INTO `battle_logs` VALUES ('104', '7', '2025-05-23 23:16:04', 'normal', 'event_christmas');
INSERT INTO `battle_logs` VALUES ('105', '7', '2025-05-23 23:16:10', 'normal', 'event_christmas');
INSERT INTO `battle_logs` VALUES ('106', '7', '2025-05-23 23:16:20', 'normal', 'event_christmas');
INSERT INTO `battle_logs` VALUES ('107', '7', '2025-05-23 23:16:27', 'normal', 'event_christmas');
INSERT INTO `battle_logs` VALUES ('108', '7', '2025-05-23 23:16:47', 'normal', 'event_halloween');
INSERT INTO `battle_logs` VALUES ('109', '7', '2025-05-23 23:16:51', 'normal', 'event_halloween');
INSERT INTO `battle_logs` VALUES ('110', '7', '2025-05-24 00:11:28', 'normal', 'event_halloween');
INSERT INTO `battle_logs` VALUES ('111', '7', '2025-05-24 00:11:39', 'normal', 'event_halloween');
INSERT INTO `battle_logs` VALUES ('112', '7', '2025-05-24 00:11:45', 'normal', 'event_halloween');
INSERT INTO `battle_logs` VALUES ('113', '7', '2025-05-24 00:35:20', 'normal', 'event_halloween');
INSERT INTO `battle_logs` VALUES ('114', '6', '2025-05-24 02:00:47', 'normal', 'event_christmas');
INSERT INTO `battle_logs` VALUES ('115', '6', '2025-05-24 02:01:02', 'normal', 'event_christmas');
INSERT INTO `battle_logs` VALUES ('116', '6', '2025-05-24 02:01:08', 'normal', 'event_christmas');
INSERT INTO `battle_logs` VALUES ('117', '6', '2025-05-24 02:01:12', 'normal', 'event_christmas');
INSERT INTO `battle_logs` VALUES ('118', '6', '2025-05-24 02:01:36', 'normal', 'event_halloween');
INSERT INTO `battle_logs` VALUES ('119', '6', '2025-05-24 02:01:44', 'normal', 'event_halloween');
INSERT INTO `battle_logs` VALUES ('120', '6', '2025-05-24 02:01:49', 'normal', 'event_halloween');
INSERT INTO `battle_logs` VALUES ('121', '6', '2025-05-24 02:18:51', 'normal', 'event_christmas');
INSERT INTO `battle_logs` VALUES ('122', '8', '2025-05-25 02:03:44', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('123', '8', '2025-05-25 02:04:03', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('124', '8', '2025-05-25 02:24:17', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('125', '8', '2025-05-25 02:24:32', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('126', '8', '2025-05-25 03:11:08', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('127', '8', '2025-05-25 03:11:15', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('128', '8', '2025-05-25 03:11:24', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('129', '8', '2025-05-25 03:11:51', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('130', '8', '2025-05-25 03:12:00', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('131', '6', '2025-05-25 03:13:39', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('132', '6', '2025-05-25 03:13:48', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('133', '6', '2025-05-25 03:14:04', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('134', '6', '2025-05-25 03:14:10', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('135', '8', '2025-05-25 03:21:13', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('136', '8', '2025-05-25 03:21:21', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('137', '8', '2025-05-25 03:22:04', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('138', '6', '2025-05-25 03:22:36', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('139', '6', '2025-05-25 03:26:16', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('140', '6', '2025-05-25 03:26:26', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('141', '6', '2025-05-25 03:26:46', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('142', '6', '2025-05-25 03:41:45', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('143', '6', '2025-05-25 03:46:25', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('144', '7', '2025-05-25 03:46:52', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('145', '7', '2025-05-25 03:49:16', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('146', '7', '2025-05-25 03:49:32', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('147', '7', '2025-05-25 03:49:57', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('148', '7', '2025-05-25 03:53:06', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('149', '7', '2025-05-25 03:54:18', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('150', '7', '2025-05-25 03:54:40', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('151', '7', '2025-05-25 03:54:45', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('152', '7', '2025-05-25 03:55:05', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('153', '7', '2025-05-25 03:55:13', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('154', '6', '2025-05-25 14:44:17', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('155', '6', '2025-05-25 14:44:31', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('156', '6', '2025-05-25 14:44:39', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('157', '6', '2025-05-25 14:45:04', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('158', '6', '2025-05-25 14:45:10', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('159', '6', '2025-05-25 14:45:29', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('160', '6', '2025-05-25 14:45:39', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('161', '6', '2025-05-25 14:57:16', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('162', '6', '2025-05-25 14:57:23', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('163', '7', '2025-05-25 15:08:01', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('164', '7', '2025-05-25 15:08:09', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('165', '7', '2025-05-25 15:08:14', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('166', '7', '2025-05-25 15:08:31', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('167', '7', '2025-05-25 15:09:47', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('168', '7', '2025-05-25 15:09:57', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('169', '7', '2025-05-25 15:14:35', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('170', '7', '2025-05-25 15:14:43', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('171', '7', '2025-05-25 15:19:36', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('172', '7', '2025-05-25 15:19:56', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('173', '8', '2025-05-25 15:20:24', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('174', '8', '2025-05-25 15:29:51', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('175', '8', '2025-05-25 15:30:05', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('176', '8', '2025-05-25 15:30:12', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('177', '8', '2025-05-25 15:30:24', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('178', '6', '2025-05-25 15:31:02', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('179', '7', '2025-05-25 15:38:22', 'normal', 'dungeon');
INSERT INTO `battle_logs` VALUES ('180', '7', '2025-05-25 15:41:25', 'normal', 'arena_boss');
INSERT INTO `battle_logs` VALUES ('181', '7', '2025-05-25 15:41:35', 'normal', 'arena_boss');
INSERT INTO `battle_logs` VALUES ('182', '7', '2025-05-25 15:42:27', 'normal', 'arena_boss');
INSERT INTO `battle_logs` VALUES ('183', '7', '2025-05-25 15:43:09', 'normal', 'dungeon');
INSERT INTO `battle_logs` VALUES ('184', '8', '2025-05-25 15:47:41', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('185', '8', '2025-05-25 15:47:47', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('186', '8', '2025-05-25 15:47:51', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('187', '8', '2025-05-25 15:47:56', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('188', '8', '2025-05-25 15:48:00', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('189', '9', '2025-05-25 15:49:57', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('190', '9', '2025-05-25 15:50:11', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('191', '9', '2025-05-25 15:51:01', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('192', '9', '2025-05-25 15:52:23', 'normal', 'arena_boss');
INSERT INTO `battle_logs` VALUES ('193', '9', '2025-05-25 15:53:03', 'normal', 'dungeon');
INSERT INTO `battle_logs` VALUES ('194', '9', '2025-05-25 15:54:09', 'normal', 'dungeon');
INSERT INTO `battle_logs` VALUES ('195', '9', '2025-05-25 15:55:26', 'normal', 'arena_boss');
INSERT INTO `battle_logs` VALUES ('196', '9', '2025-05-25 16:00:41', 'normal', 'arena_boss');
INSERT INTO `battle_logs` VALUES ('197', '9', '2025-05-25 16:01:47', 'normal', 'dungeon');
INSERT INTO `battle_logs` VALUES ('198', '6', '2025-05-25 16:07:29', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('199', '9', '2025-05-25 16:39:00', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('200', '3', '2025-05-25 16:44:56', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('201', '3', '2025-05-25 16:45:17', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('202', '3', '2025-05-25 16:45:25', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('203', '3', '2025-05-25 16:46:08', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('204', '3', '2025-05-25 16:59:57', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('205', '3', '2025-05-25 17:18:45', 'normal', 'arena_boss');
INSERT INTO `battle_logs` VALUES ('206', '3', '2025-05-25 17:19:01', 'normal', 'dungeon');
INSERT INTO `battle_logs` VALUES ('207', '3', '2025-05-25 17:19:23', 'normal', 'arena_boss');
INSERT INTO `battle_logs` VALUES ('208', '3', '2025-05-25 22:59:59', 'normal', 'dungeon');
INSERT INTO `battle_logs` VALUES ('209', '3', '2025-05-25 23:00:44', 'normal', 'boss');
INSERT INTO `battle_logs` VALUES ('210', '3', '2025-05-25 23:00:44', 'normal', 'arena_boss');
INSERT INTO `battle_logs` VALUES ('211', '3', '2025-05-26 01:46:11', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('212', '3', '2025-05-26 01:46:20', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('213', '3', '2025-05-26 01:59:45', 'normal', 'arena');
INSERT INTO `battle_logs` VALUES ('214', '3', '2025-05-26 02:00:52', 'normal', 'arena');

-- ----------------------------
-- Table structure for `br`
-- ----------------------------
DROP TABLE IF EXISTS `br`;
CREATE TABLE `br` (
  `id_code` int(11) NOT NULL AUTO_INCREMENT,
  `id_user_r` varchar(24) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `login_user_r` varchar(24) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `code` text NOT NULL,
  `pais` varchar(24) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `used` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of br
-- ----------------------------

-- ----------------------------
-- Table structure for `enemies`
-- ----------------------------
DROP TABLE IF EXISTS `enemies`;
CREATE TABLE `enemies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `min_hp` int(11) DEFAULT NULL,
  `max_hp` int(11) DEFAULT NULL,
  `min_dmg` int(11) DEFAULT NULL,
  `max_dmg` int(11) DEFAULT NULL,
  `xp_reward` int(11) DEFAULT NULL,
  `gold_reward` int(11) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `is_boss` tinyint(1) NOT NULL DEFAULT '0',
  `event_type` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of enemies
-- ----------------------------
INSERT INTO `enemies` VALUES ('1', 'Enemy Lv1', '1', '35', '59', '2', '7', '12', '6', '1_1.jpg', '0', null);
INSERT INTO `enemies` VALUES ('2', 'Enemy Lv2', '2', '40', '64', '2', '7', '14', '7', '1_1.jpg', '0', null);
INSERT INTO `enemies` VALUES ('3', 'Enemy Lv3', '3', '45', '69', '2', '7', '16', '8', '1_1.jpg', '0', null);
INSERT INTO `enemies` VALUES ('4', 'Enemy Lv4', '4', '50', '74', '2', '7', '18', '9', '1_1.jpg', '0', null);
INSERT INTO `enemies` VALUES ('5', 'Enemy Lv5', '5', '55', '79', '3', '8', '20', '10', '1_2.jpg', '0', null);
INSERT INTO `enemies` VALUES ('6', 'Enemy Lv6', '6', '60', '84', '3', '8', '22', '11', '1_3.jpg', '0', null);
INSERT INTO `enemies` VALUES ('7', 'Enemy Lv7', '7', '65', '89', '3', '8', '24', '12', '1_3.jpg', '0', null);
INSERT INTO `enemies` VALUES ('8', 'Enemy Lv8', '8', '70', '94', '3', '8', '26', '13', '1_3.jpg', '0', null);
INSERT INTO `enemies` VALUES ('9', 'Enemy Lv9', '9', '75', '99', '3', '8', '28', '14', '1_3.jpg', '0', null);
INSERT INTO `enemies` VALUES ('10', 'Enemy Lv10', '10', '80', '104', '4', '9', '30', '15', '1_4.jpg', '0', null);
INSERT INTO `enemies` VALUES ('11', 'Enemy Lv11', '11', '85', '109', '4', '9', '32', '16', '1_4.jpg', '0', null);
INSERT INTO `enemies` VALUES ('12', 'Enemy Lv12', '12', '90', '114', '4', '9', '34', '17', '1_4.jpg', '0', null);
INSERT INTO `enemies` VALUES ('13', 'Enemy Lv13', '13', '95', '119', '4', '9', '36', '18', '1_4.jpg', '0', null);
INSERT INTO `enemies` VALUES ('14', 'Enemy Lv14', '14', '100', '124', '4', '9', '38', '19', '1_5.jpg', '0', null);
INSERT INTO `enemies` VALUES ('15', 'Enemy Lv15', '15', '105', '129', '5', '10', '40', '20', '1_5.jpg', '0', null);
INSERT INTO `enemies` VALUES ('16', 'Enemy Lv16', '16', '110', '134', '5', '10', '42', '21', '1_5.jpg', '0', null);
INSERT INTO `enemies` VALUES ('17', 'Enemy Lv17', '17', '115', '139', '5', '10', '44', '22', '1_5.jpg', '0', null);
INSERT INTO `enemies` VALUES ('18', 'Enemy Lv18', '18', '120', '144', '5', '10', '46', '23', '1_6.jpg', '0', null);
INSERT INTO `enemies` VALUES ('19', 'Enemy Lv19', '19', '125', '149', '5', '10', '48', '24', '1_6.jpg', '0', null);
INSERT INTO `enemies` VALUES ('20', 'Enemy Lv20', '20', '130', '154', '6', '11', '50', '25', '1_6.jpg', '0', null);
INSERT INTO `enemies` VALUES ('21', 'Enemy Lv21', '21', '135', '159', '6', '11', '52', '26', '1_6.jpg', '0', null);
INSERT INTO `enemies` VALUES ('22', 'Enemy Lv22', '22', '140', '164', '6', '11', '54', '27', '1_7.jpg', '0', null);
INSERT INTO `enemies` VALUES ('23', 'Enemy Lv23', '23', '145', '169', '6', '11', '56', '28', '1_7.jpg', '0', null);
INSERT INTO `enemies` VALUES ('24', 'Enemy Lv24', '24', '150', '174', '6', '11', '58', '29', '1_7.jpg', '0', null);
INSERT INTO `enemies` VALUES ('25', 'Enemy Lv25', '25', '155', '179', '7', '12', '60', '30', '1_7.jpg', '0', null);
INSERT INTO `enemies` VALUES ('26', 'Enemy Lv26', '26', '160', '184', '7', '12', '62', '31', '1_8.jpg', '0', null);
INSERT INTO `enemies` VALUES ('27', 'Enemy Lv27', '27', '165', '189', '7', '12', '64', '32', '1_8.jpg', '0', null);
INSERT INTO `enemies` VALUES ('28', 'Enemy Lv28', '28', '170', '194', '7', '12', '66', '33', '1_8.jpg', '0', null);
INSERT INTO `enemies` VALUES ('29', 'Enemy Lv29', '29', '175', '199', '7', '12', '68', '34', '1_8.jpg', '0', null);
INSERT INTO `enemies` VALUES ('30', 'Enemy Lv30', '30', '180', '204', '8', '13', '70', '35', '1_9.jpg', '0', null);
INSERT INTO `enemies` VALUES ('31', 'Enemy Lv31', '31', '185', '209', '8', '13', '72', '36', '1_9.jpg', '0', null);
INSERT INTO `enemies` VALUES ('32', 'Enemy Lv32', '32', '190', '214', '8', '13', '74', '37', '1_9.jpg', '0', null);
INSERT INTO `enemies` VALUES ('33', 'Enemy Lv33', '33', '195', '219', '8', '13', '76', '38', '1_9.jpg', '0', null);
INSERT INTO `enemies` VALUES ('34', 'Enemy Lv34', '34', '200', '224', '8', '13', '78', '39', '1_10.jpg', '0', null);
INSERT INTO `enemies` VALUES ('35', 'Enemy Lv35', '35', '205', '229', '9', '14', '80', '40', '1_10.jpg', '0', null);
INSERT INTO `enemies` VALUES ('36', 'Enemy Lv36', '36', '210', '234', '9', '14', '82', '41', '1_10.jpg', '0', null);
INSERT INTO `enemies` VALUES ('37', 'Enemy Lv37', '37', '215', '239', '9', '14', '84', '42', '1_10.jpg', '0', null);
INSERT INTO `enemies` VALUES ('38', 'Enemy Lv38', '38', '220', '244', '9', '14', '86', '43', '1_11.jpg', '0', null);
INSERT INTO `enemies` VALUES ('39', 'Enemy Lv39', '39', '225', '249', '9', '14', '88', '44', '1_11.jpg', '0', null);
INSERT INTO `enemies` VALUES ('40', 'Enemy Lv40', '40', '230', '254', '10', '15', '90', '45', '1_11.jpg', '0', null);
INSERT INTO `enemies` VALUES ('41', 'Enemy Lv41', '41', '235', '259', '10', '15', '92', '46', '1_11.jpg', '0', null);
INSERT INTO `enemies` VALUES ('42', 'Enemy Lv42', '42', '240', '264', '10', '15', '94', '47', '1_12.jpg', '0', null);
INSERT INTO `enemies` VALUES ('43', 'Enemy Lv43', '43', '245', '269', '10', '15', '96', '48', '1_12.jpg', '0', null);
INSERT INTO `enemies` VALUES ('44', 'Enemy Lv44', '44', '250', '274', '10', '15', '98', '49', '1_12.jpg', '0', null);
INSERT INTO `enemies` VALUES ('45', 'Enemy Lv45', '45', '255', '279', '11', '16', '100', '50', '1_12.jpg', '0', null);
INSERT INTO `enemies` VALUES ('46', 'Enemy Lv46', '46', '260', '284', '11', '16', '102', '51', '1_13.jpg', '0', null);
INSERT INTO `enemies` VALUES ('47', 'Enemy Lv47', '47', '265', '289', '11', '16', '104', '52', '1_13.jpg', '0', null);
INSERT INTO `enemies` VALUES ('48', 'Enemy Lv48', '48', '270', '294', '11', '16', '106', '53', '1_13.jpg', '0', null);
INSERT INTO `enemies` VALUES ('49', 'Enemy Lv49', '49', '275', '299', '11', '16', '108', '54', '1_13.jpg', '0', null);
INSERT INTO `enemies` VALUES ('50', 'Enemy Lv50', '50', '280', '304', '12', '17', '110', '55', '1_14.jpg', '0', null);
INSERT INTO `enemies` VALUES ('51', 'Enemy Lv51', '51', '285', '309', '12', '17', '112', '56', '1_14.jpg', '0', null);
INSERT INTO `enemies` VALUES ('52', 'Enemy Lv52', '52', '290', '314', '12', '17', '114', '57', '1_14.jpg', '0', null);
INSERT INTO `enemies` VALUES ('53', 'Enemy Lv53', '53', '295', '319', '12', '17', '116', '58', '1_14.jpg', '0', null);
INSERT INTO `enemies` VALUES ('54', 'Enemy Lv54', '54', '300', '324', '12', '17', '118', '59', '1_15.jpg', '0', null);
INSERT INTO `enemies` VALUES ('55', 'Enemy Lv55', '55', '305', '329', '13', '18', '120', '60', '1_15.jpg', '0', null);
INSERT INTO `enemies` VALUES ('56', 'Enemy Lv56', '56', '310', '334', '13', '18', '122', '61', '1_15.jpg', '0', null);
INSERT INTO `enemies` VALUES ('57', 'Enemy Lv57', '57', '315', '339', '13', '18', '124', '62', '1_15.jpg', '0', null);
INSERT INTO `enemies` VALUES ('58', 'Enemy Lv58', '58', '320', '344', '13', '18', '126', '63', '2_1.jpg', '0', null);
INSERT INTO `enemies` VALUES ('59', 'Enemy Lv59', '59', '325', '349', '13', '18', '128', '64', '2_1.jpg', '0', null);
INSERT INTO `enemies` VALUES ('60', 'Enemy Lv60', '60', '330', '354', '14', '19', '130', '65', '2_1.jpg', '0', null);
INSERT INTO `enemies` VALUES ('61', 'Enemy Lv61', '61', '335', '359', '14', '19', '132', '66', '2_1.jpg', '0', null);
INSERT INTO `enemies` VALUES ('62', 'Enemy Lv62', '62', '340', '364', '14', '19', '134', '67', '2_2.jpg', '0', null);
INSERT INTO `enemies` VALUES ('63', 'Enemy Lv63', '63', '345', '369', '14', '19', '136', '68', '2_2.jpg', '0', null);
INSERT INTO `enemies` VALUES ('64', 'Enemy Lv64', '64', '350', '374', '14', '19', '138', '69', '2_2.jpg', '0', null);
INSERT INTO `enemies` VALUES ('65', 'Enemy Lv65', '65', '355', '379', '15', '20', '140', '70', '2_2.jpg', '0', null);
INSERT INTO `enemies` VALUES ('66', 'Enemy Lv66', '66', '360', '384', '15', '20', '142', '71', '2_3.jpg', '0', null);
INSERT INTO `enemies` VALUES ('67', 'Enemy Lv67', '67', '365', '389', '15', '20', '144', '72', '2_3.jpg', '0', null);
INSERT INTO `enemies` VALUES ('68', 'Enemy Lv68', '68', '370', '394', '15', '20', '146', '73', '2_3.jpg', '0', null);
INSERT INTO `enemies` VALUES ('69', 'Enemy Lv69', '69', '375', '399', '15', '20', '148', '74', '2_3.jpg', '0', null);
INSERT INTO `enemies` VALUES ('70', 'Enemy Lv70', '70', '380', '404', '16', '21', '150', '75', '2_4.jpg', '0', null);
INSERT INTO `enemies` VALUES ('71', 'Enemy Lv71', '71', '385', '409', '16', '21', '152', '76', '2_4.jpg', '0', null);
INSERT INTO `enemies` VALUES ('72', 'Enemy Lv72', '72', '390', '414', '16', '21', '154', '77', '2_4.jpg', '0', null);
INSERT INTO `enemies` VALUES ('73', 'Enemy Lv73', '73', '395', '419', '16', '21', '156', '78', '2_4.jpg', '0', null);
INSERT INTO `enemies` VALUES ('74', 'Enemy Lv74', '74', '400', '424', '16', '21', '158', '79', '2_5.jpg', '0', null);
INSERT INTO `enemies` VALUES ('75', 'Enemy Lv75', '75', '405', '429', '17', '22', '160', '80', '2_5.jpg', '0', null);
INSERT INTO `enemies` VALUES ('76', 'Enemy Lv76', '76', '410', '434', '17', '22', '162', '81', '2_5.jpg', '0', null);
INSERT INTO `enemies` VALUES ('77', 'Enemy Lv77', '77', '415', '439', '17', '22', '164', '82', '2_5.jpg', '0', null);
INSERT INTO `enemies` VALUES ('78', 'Enemy Lv78', '78', '420', '444', '17', '22', '166', '83', '2_6.jpg', '0', null);
INSERT INTO `enemies` VALUES ('79', 'Enemy Lv79', '79', '425', '449', '17', '22', '168', '84', '2_6.jpg', '0', null);
INSERT INTO `enemies` VALUES ('80', 'Enemy Lv80', '80', '430', '454', '18', '23', '170', '85', '2_6.jpg', '0', null);
INSERT INTO `enemies` VALUES ('81', 'Enemy Lv81', '81', '435', '459', '18', '23', '172', '86', '2_6.jpg', '0', null);
INSERT INTO `enemies` VALUES ('82', 'Enemy Lv82', '82', '440', '464', '18', '23', '174', '87', '3_1.jpg', '0', null);
INSERT INTO `enemies` VALUES ('83', 'Enemy Lv83', '83', '445', '469', '18', '23', '176', '88', '3_1.jpg', '0', null);
INSERT INTO `enemies` VALUES ('84', 'Enemy Lv84', '84', '450', '474', '18', '23', '178', '89', '3_1.jpg', '0', null);
INSERT INTO `enemies` VALUES ('85', 'Enemy Lv85', '85', '455', '479', '19', '24', '180', '90', '3_1.jpg', '0', null);
INSERT INTO `enemies` VALUES ('86', 'Enemy Lv86', '86', '460', '484', '19', '24', '182', '91', '3_2.jpg', '0', null);
INSERT INTO `enemies` VALUES ('87', 'Enemy Lv87', '87', '465', '489', '19', '24', '184', '92', '3_2.jpg', '0', null);
INSERT INTO `enemies` VALUES ('88', 'Enemy Lv88', '88', '470', '494', '19', '24', '186', '93', '3_2.jpg', '0', null);
INSERT INTO `enemies` VALUES ('89', 'Enemy Lv89', '89', '475', '499', '19', '24', '188', '94', '3_2.jpg', '0', null);
INSERT INTO `enemies` VALUES ('90', 'Enemy Lv90', '90', '480', '504', '20', '25', '190', '95', '3_3.jpg', '0', null);
INSERT INTO `enemies` VALUES ('91', 'Enemy Lv91', '91', '485', '509', '20', '25', '192', '96', '3_3.jpg', '0', null);
INSERT INTO `enemies` VALUES ('92', 'Enemy Lv92', '92', '490', '514', '20', '25', '194', '97', '3_3.jpg', '0', null);
INSERT INTO `enemies` VALUES ('93', 'Enemy Lv93', '93', '495', '519', '20', '25', '196', '98', '3_3.jpg', '0', null);
INSERT INTO `enemies` VALUES ('94', 'Enemy Lv94', '94', '500', '524', '20', '25', '198', '99', '3_3.jpg', '0', null);
INSERT INTO `enemies` VALUES ('95', 'Enemy Lv95', '95', '505', '529', '21', '26', '200', '100', '3_3.jpg', '0', null);
INSERT INTO `enemies` VALUES ('96', 'Enemy Lv96', '96', '510', '534', '21', '26', '202', '101', '3_3.jpg', '0', null);
INSERT INTO `enemies` VALUES ('97', 'Enemy Lv97', '97', '515', '539', '21', '26', '204', '102', '3_3.jpg', '0', null);
INSERT INTO `enemies` VALUES ('98', 'Enemy Lv98', '98', '520', '544', '21', '26', '206', '103', '3_3.jpg', '0', null);
INSERT INTO `enemies` VALUES ('99', 'Enemy Lv99', '99', '525', '549', '21', '26', '208', '104', '3_3.jpg', '0', null);
INSERT INTO `enemies` VALUES ('100', 'Enemy Lv100', '100', '530', '554', '22', '27', '210', '105', '3_16.jpg', '0', null);
INSERT INTO `enemies` VALUES ('101', 'Cave Rat', '20', '150', '180', '8', '10', '80', '20', '1_1.jpg', '1', null);
INSERT INTO `enemies` VALUES ('102', 'Zombie Miner', '40', '180', '220', '10', '14', '100', '40', '2_2.jpg', '1', null);
INSERT INTO `enemies` VALUES ('103', 'Underground Lurker', '60', '70', '80', '11', '17', '120', '60', '1_14.jpg', '1', null);
INSERT INTO `enemies` VALUES ('104', 'Wailing Specter', '80', '60', '75', '15', '20', '150', '80', '3_6.jpg', '1', null);
INSERT INTO `enemies` VALUES ('105', 'Buried Champion', '95', '80', '95', '20', '22', '200', '100', '3_10.jpg', '1', null);
INSERT INTO `enemies` VALUES ('106', 'Titanus the Arena Champion', '100', '120', '150', '25', '30', '250', '150', '12.gif', '1', null);
INSERT INTO `enemies` VALUES ('107', 'Pumpkin Fiend', '20', '60', '80', '10', '15', '100', '50', 'pumpkin.png', '0', 'halloween');
INSERT INTO `enemies` VALUES ('108', 'Haunted Armor', '30', '90', '110', '15', '22', '150', '75', 'haunted.png', '0', 'halloween');
INSERT INTO `enemies` VALUES ('109', 'Evil Snowman', '25', '70', '100', '12', '18', '120', '60', 'Snowman.png', '0', 'christmas');
INSERT INTO `enemies` VALUES ('110', 'Grinchling', '35', '100', '130', '18', '25', '180', '100', 'grinchling.png', '0', 'christmas');

-- ----------------------------
-- Table structure for `enemy_item_drops`
-- ----------------------------
DROP TABLE IF EXISTS `enemy_item_drops`;
CREATE TABLE `enemy_item_drops` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `enemy_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `drop_chance` float NOT NULL,
  PRIMARY KEY (`id`),
  KEY `enemy_id` (`enemy_id`),
  KEY `item_id` (`item_id`),
  CONSTRAINT `enemy_item_drops_ibfk_1` FOREIGN KEY (`enemy_id`) REFERENCES `enemies` (`id`) ON DELETE CASCADE,
  CONSTRAINT `enemy_item_drops_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of enemy_item_drops
-- ----------------------------
INSERT INTO `enemy_item_drops` VALUES ('1', '101', '121', '0.3');
INSERT INTO `enemy_item_drops` VALUES ('2', '101', '122', '0.3');
INSERT INTO `enemy_item_drops` VALUES ('3', '101', '123', '0.3');
INSERT INTO `enemy_item_drops` VALUES ('4', '101', '124', '0.3');
INSERT INTO `enemy_item_drops` VALUES ('5', '101', '125', '0.3');
INSERT INTO `enemy_item_drops` VALUES ('6', '102', '221', '0.3');
INSERT INTO `enemy_item_drops` VALUES ('7', '102', '222', '0.3');
INSERT INTO `enemy_item_drops` VALUES ('8', '102', '223', '0.3');
INSERT INTO `enemy_item_drops` VALUES ('9', '102', '224', '0.3');
INSERT INTO `enemy_item_drops` VALUES ('10', '102', '225', '0.3');
INSERT INTO `enemy_item_drops` VALUES ('11', '103', '321', '0.25');
INSERT INTO `enemy_item_drops` VALUES ('12', '103', '322', '0.25');
INSERT INTO `enemy_item_drops` VALUES ('13', '103', '323', '0.25');
INSERT INTO `enemy_item_drops` VALUES ('14', '103', '324', '0.25');
INSERT INTO `enemy_item_drops` VALUES ('15', '103', '325', '0.25');
INSERT INTO `enemy_item_drops` VALUES ('16', '104', '421', '0.2');
INSERT INTO `enemy_item_drops` VALUES ('17', '104', '422', '0.2');
INSERT INTO `enemy_item_drops` VALUES ('18', '104', '423', '0.2');
INSERT INTO `enemy_item_drops` VALUES ('19', '104', '424', '0.2');
INSERT INTO `enemy_item_drops` VALUES ('20', '104', '425', '0.2');
INSERT INTO `enemy_item_drops` VALUES ('21', '105', '496', '0.15');
INSERT INTO `enemy_item_drops` VALUES ('22', '105', '497', '0.15');
INSERT INTO `enemy_item_drops` VALUES ('23', '105', '498', '0.15');
INSERT INTO `enemy_item_drops` VALUES ('24', '105', '499', '0.15');
INSERT INTO `enemy_item_drops` VALUES ('25', '105', '500', '0.15');
INSERT INTO `enemy_item_drops` VALUES ('26', '106', '521', '0.2');
INSERT INTO `enemy_item_drops` VALUES ('27', '106', '522', '0.25');
INSERT INTO `enemy_item_drops` VALUES ('28', '106', '523', '0.3');
INSERT INTO `enemy_item_drops` VALUES ('29', '106', '524', '0.2');
INSERT INTO `enemy_item_drops` VALUES ('30', '106', '525', '0.2');
INSERT INTO `enemy_item_drops` VALUES ('31', '106', '625', '0.1');
INSERT INTO `enemy_item_drops` VALUES ('32', '106', '523', '0.1');
INSERT INTO `enemy_item_drops` VALUES ('33', '106', '825', '0.1');
INSERT INTO `enemy_item_drops` VALUES ('34', '106', '875', '0.1');
INSERT INTO `enemy_item_drops` VALUES ('35', '106', '925', '0.1');

-- ----------------------------
-- Table structure for `enemy_skills`
-- ----------------------------
DROP TABLE IF EXISTS `enemy_skills`;
CREATE TABLE `enemy_skills` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `enemy_id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `description` text,
  `damage` int(11) DEFAULT '0',
  `healing` int(11) DEFAULT '0',
  `chance_to_use` int(11) DEFAULT '100',
  `cooldown_seconds` int(11) DEFAULT '10',
  PRIMARY KEY (`id`),
  KEY `enemy_id` (`enemy_id`),
  CONSTRAINT `enemy_skills_ibfk_1` FOREIGN KEY (`enemy_id`) REFERENCES `enemies` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of enemy_skills
-- ----------------------------
INSERT INTO `enemy_skills` VALUES ('1', '1', 'Smash', 'Heavy blow dealing high damage', '20', '0', '50', '10');
INSERT INTO `enemy_skills` VALUES ('2', '2', 'Regenerate', 'Heals itself with dark energy', '0', '15', '40', '15');
INSERT INTO `enemy_skills` VALUES ('3', '3', 'Shadow Fire', 'Burns you with cursed flames', '10', '0', '70', '8');

-- ----------------------------
-- Table structure for `equipped_items`
-- ----------------------------
DROP TABLE IF EXISTS `equipped_items`;
CREATE TABLE `equipped_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `player_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `slot` enum('helmet','armor','weapon','shield','ring','boots','gloves') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `player_id` (`player_id`),
  KEY `item_id` (`item_id`),
  CONSTRAINT `equipped_items_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of equipped_items
-- ----------------------------

-- ----------------------------
-- Table structure for `event_item_drops`
-- ----------------------------
DROP TABLE IF EXISTS `event_item_drops`;
CREATE TABLE `event_item_drops` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_type` varchar(50) NOT NULL,
  `item_id` int(11) NOT NULL,
  `drop_chance` float NOT NULL,
  PRIMARY KEY (`id`),
  KEY `item_id` (`item_id`),
  CONSTRAINT `event_item_drops_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of event_item_drops
-- ----------------------------
INSERT INTO `event_item_drops` VALUES ('1', 'christmas', '926', '0.25');
INSERT INTO `event_item_drops` VALUES ('2', 'christmas', '927', '0.15');
INSERT INTO `event_item_drops` VALUES ('3', 'christmas', '928', '0.1');
INSERT INTO `event_item_drops` VALUES ('4', 'halloween', '929', '0.3');
INSERT INTO `event_item_drops` VALUES ('5', 'halloween', '930', '0.2');
INSERT INTO `event_item_drops` VALUES ('6', 'halloween', '931', '0.1');

-- ----------------------------
-- Table structure for `gracze`
-- ----------------------------
DROP TABLE IF EXISTS `gracze`;
CREATE TABLE `gracze` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gracz` int(11) NOT NULL DEFAULT '0',
  `login` varchar(24) COLLATE utf8_polish_ci NOT NULL,
  `haslo` varchar(40) COLLATE utf8_polish_ci NOT NULL,
  `email` varchar(40) COLLATE utf8_polish_ci NOT NULL,
  `plec` tinyint(4) NOT NULL DEFAULT '0',
  `avatar` tinyint(4) NOT NULL DEFAULT '1',
  `pregunta` text COLLATE utf8_polish_ci NOT NULL,
  `respuesta` text COLLATE utf8_polish_ci NOT NULL,
  `rank` int(1) NOT NULL DEFAULT '1',
  `nivel` int(1) NOT NULL DEFAULT '1',
  `exp` int(1) NOT NULL DEFAULT '0',
  `exp_max` int(1) NOT NULL DEFAULT '10',
  `honor` int(1) NOT NULL DEFAULT '0',
  `fama` int(1) NOT NULL DEFAULT '0',
  `victorias` int(1) NOT NULL DEFAULT '0',
  `perdidas` int(1) NOT NULL DEFAULT '0',
  `oro_robado` int(1) NOT NULL DEFAULT '0',
  `oro_perdido` int(1) NOT NULL DEFAULT '0',
  `atak` int(5) NOT NULL DEFAULT '0',
  `obrona` int(3) NOT NULL DEFAULT '0',
  `sila` int(1) NOT NULL DEFAULT '5',
  `sila_i` int(1) NOT NULL DEFAULT '0',
  `sila_max` int(1) NOT NULL DEFAULT '10',
  `zrecznosc` int(1) NOT NULL DEFAULT '5',
  `zrecznosc_i` int(1) NOT NULL DEFAULT '0',
  `zrecznosc_max` int(1) NOT NULL DEFAULT '10',
  `wyrzymalosc` int(1) NOT NULL DEFAULT '5',
  `wyrzymalosc_i` int(1) NOT NULL DEFAULT '0',
  `wyrzymalosc_max` int(1) NOT NULL DEFAULT '10',
  `constitucion` int(1) NOT NULL DEFAULT '5',
  `constitucion_i` int(1) NOT NULL DEFAULT '0',
  `constitucion_max` int(1) NOT NULL DEFAULT '10',
  `carisma` int(1) NOT NULL DEFAULT '5',
  `carisma_i` int(1) NOT NULL DEFAULT '0',
  `carisma_max` int(1) NOT NULL DEFAULT '10',
  `inteligencja` int(1) NOT NULL DEFAULT '5',
  `inteligencja_i` int(1) NOT NULL DEFAULT '0',
  `inteligencja_max` int(1) NOT NULL DEFAULT '10',
  `mdchance` int(1) NOT NULL DEFAULT '0',
  `dhchance` int(1) NOT NULL DEFAULT '0',
  `ctchance` int(1) NOT NULL DEFAULT '0',
  `zycie` int(100) NOT NULL DEFAULT '100',
  `zycie_max` int(100) NOT NULL DEFAULT '100',
  `obrazenia_min` int(1) NOT NULL DEFAULT '0',
  `obrazenia_max` int(3) NOT NULL DEFAULT '2',
  `zloto` int(100) NOT NULL DEFAULT '150',
  `zloto_skarbiec` int(11) NOT NULL,
  `punkty` int(11) NOT NULL,
  `pracuje` int(11) NOT NULL,
  `ostatnia_walka_pvp` int(11) NOT NULL,
  `ostatnia_walka_pvc` int(11) NOT NULL,
  `ostatnio_zregenerowano` int(11) NOT NULL,
  `titulo` varchar(24) COLLATE utf8_polish_ci NOT NULL DEFAULT 'Newbie',
  `arena_level` int(11) NOT NULL,
  `rubies` int(11) NOT NULL DEFAULT '0',
  `centurion_time` int(11) NOT NULL,
  `reportes` int(1) NOT NULL DEFAULT '0',
  `mensajes` int(1) NOT NULL DEFAULT '0',
  `noticias` int(1) NOT NULL DEFAULT '0',
  `bendicion1_type` int(11) NOT NULL,
  `bendicion1_time` int(11) NOT NULL,
  `bendicion2_type` int(11) NOT NULL,
  `bendicion2_time` int(11) NOT NULL,
  `bendicion3_type` int(11) NOT NULL,
  `bendicion3_time` int(11) NOT NULL,
  `bendicion4_type` int(11) NOT NULL,
  `bendicion4_time` int(11) NOT NULL,
  `ostatnia_aktywnosc` int(11) NOT NULL DEFAULT '0',
  `username_locked` tinyint(1) NOT NULL DEFAULT '0',
  `lock_login` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- ----------------------------
-- Records of gracze
-- ----------------------------
INSERT INTO `gracze` VALUES ('3', '1', 'tolis', 'e10adc3949ba59abbe56e057f20f883e', 'tolis@test1.com', '0', '3', 'dgfdg', 'gfdgfd', '1', '2', '148', '200', '0', '0', '9', '0', '0', '0', '0', '121', '15', '5', '10', '10', '0', '10', '5', '0', '10', '5', '0', '10', '5', '0', '10', '5', '0', '10', '0', '0', '0', '280', '100', '0', '2', '52', '0', '0', '0', '1747529809', '0', '1748220654', 'Newbie', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1748220654', '0', '0');
INSERT INTO `gracze` VALUES ('4', '2', 'Kadaz', 'e10adc3949ba59abbe56e057f20f883e', 'solidus8422@gmail.com', '0', '1', 'tolis', 'tolis', '1', '1', '0', '10', '0', '0', '0', '3', '0', '0', '0', '0', '5', '0', '10', '5', '0', '10', '5', '0', '10', '5', '0', '10', '5', '0', '10', '5', '0', '10', '0', '0', '0', '100', '100', '0', '2', '120', '0', '0', '0', '0', '0', '1747529610', 'Newbie', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1747529610', '0', '0');
INSERT INTO `gracze` VALUES ('5', '0', 'test', '25f9e794323b453885f5181f1b624d0b', 'test@gmail.com', '0', '1', 'test', 'test', '1', '1', '0', '10', '0', '0', '0', '2', '0', '0', '0', '0', '5', '0', '10', '5', '0', '10', '5', '0', '10', '5', '0', '10', '5', '0', '10', '5', '0', '10', '0', '0', '0', '100', '100', '0', '2', '130', '0', '0', '0', '0', '0', '0', 'Newbie', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0');
INSERT INTO `gracze` VALUES ('6', '0', 'test2', 'ad0234829205b9033196ba818f7a872b', 'test2@gmail.com', '0', '1', 'test', 'test', '1', '1', '22', '10000', '0', '0', '0', '1', '0', '0', '0', '19', '126', '0', '0', '2', '0', '0', '5', '0', '10', '5', '0', '10', '5', '0', '10', '5', '0', '10', '0', '0', '0', '110', '100', '0', '2', '990427', '0', '0', '0', '0', '0', '1748265567', 'Newbie', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1748265567', '0', '0');
INSERT INTO `gracze` VALUES ('7', '0', 'test3', '8ad8757baa8564dc136c1e07507f4a98', 'test3@gmail.com', '0', '1', 'test3', 'test3', '1', '1', '0', '100', '0', '0', '0', '0', '0', '0', '0', '0', '13', '0', '10', '5', '0', '10', '5', '0', '10', '5', '0', '10', '5', '0', '10', '5', '0', '10', '0', '0', '0', '140', '100', '0', '2', '3098', '0', '0', '0', '0', '0', '1748177006', 'Newbie', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1748177006', '0', '0');
INSERT INTO `gracze` VALUES ('8', '0', 'test4', '86985e105f79b95d6bc918fb45ec7727', 'test4@gmail.com', '0', '3', 'test4', 'test4', '1', '1', '92', '300', '0', '0', '1', '4', '0', '0', '0', '0', '15', '0', '10', '5', '0', '10', '5', '0', '10', '5', '0', '10', '5', '0', '10', '5', '0', '10', '0', '0', '0', '150', '100', '0', '2', '541', '0', '0', '0', '1747576645', '0', '1748177288', 'Newbie', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1748177288', '0', '0');
INSERT INTO `gracze` VALUES ('9', '0', 'test5', 'e3d704f3542b44a621ebed70dc0efe13', 'test5@gmail.com', '0', '1', 'test5', 'test5', '1', '2', '6', '10', '0', '0', '0', '0', '0', '0', '0', '0', '19', '0', '10', '5', '0', '10', '5', '0', '10', '5', '0', '10', '5', '0', '10', '5', '0', '10', '0', '0', '0', '170', '100', '0', '2', '457', '0', '0', '0', '0', '0', '1748180632', 'Newbie', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1748180632', '0', '0');

-- ----------------------------
-- Table structure for `guilds`
-- ----------------------------
DROP TABLE IF EXISTS `guilds`;
CREATE TABLE `guilds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `tag` varchar(10) NOT NULL,
  `description` text,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `flag` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tag` (`tag`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of guilds
-- ----------------------------
INSERT INTO `guilds` VALUES ('1', 'test', 'test', 'test the guild', '2025-05-24 20:56:28', null);
INSERT INTO `guilds` VALUES ('2', 'test2', 'test2', 'test2', '2025-05-24 21:42:15', null);
INSERT INTO `guilds` VALUES ('3', 'test3', 'test3', 'test3', '2025-05-24 23:43:42', '');
INSERT INTO `guilds` VALUES ('4', 'test4', 'test4', 'test4', '2025-05-25 00:41:42', '1-6.png');

-- ----------------------------
-- Table structure for `guild_chat`
-- ----------------------------
DROP TABLE IF EXISTS `guild_chat`;
CREATE TABLE `guild_chat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guild_id` int(11) NOT NULL,
  `player_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `guild_id` (`guild_id`),
  KEY `player_id` (`player_id`),
  CONSTRAINT `guild_chat_ibfk_1` FOREIGN KEY (`guild_id`) REFERENCES `guilds` (`id`) ON DELETE CASCADE,
  CONSTRAINT `guild_chat_ibfk_2` FOREIGN KEY (`player_id`) REFERENCES `gracze` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of guild_chat
-- ----------------------------
INSERT INTO `guild_chat` VALUES ('1', '1', '6', 'hi', '2025-05-24 21:03:32');
INSERT INTO `guild_chat` VALUES ('2', '1', '6', 'hi all', '2025-05-24 21:03:53');
INSERT INTO `guild_chat` VALUES ('3', '1', '6', 'hi', '2025-05-24 21:13:36');
INSERT INTO `guild_chat` VALUES ('4', '3', '7', 'gh', '2025-05-24 23:45:17');
INSERT INTO `guild_chat` VALUES ('5', '4', '6', 'hg', '2025-05-25 01:15:33');
INSERT INTO `guild_chat` VALUES ('6', '4', '8', 'hi ragezone', '2025-05-25 01:33:56');

-- ----------------------------
-- Table structure for `guild_members`
-- ----------------------------
DROP TABLE IF EXISTS `guild_members`;
CREATE TABLE `guild_members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guild_id` int(11) NOT NULL,
  `player_id` int(11) NOT NULL,
  `role` enum('leader','officer','member') DEFAULT 'member',
  `joined_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `guild_id` (`guild_id`),
  KEY `player_id` (`player_id`),
  CONSTRAINT `guild_members_ibfk_1` FOREIGN KEY (`guild_id`) REFERENCES `guilds` (`id`) ON DELETE CASCADE,
  CONSTRAINT `guild_members_ibfk_2` FOREIGN KEY (`player_id`) REFERENCES `gracze` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of guild_members
-- ----------------------------
INSERT INTO `guild_members` VALUES ('7', '3', '7', 'leader', '2025-05-24 23:43:42');
INSERT INTO `guild_members` VALUES ('8', '4', '6', 'leader', '2025-05-25 00:41:42');
INSERT INTO `guild_members` VALUES ('10', '4', '8', 'member', '2025-05-25 01:17:38');

-- ----------------------------
-- Table structure for `guild_storage`
-- ----------------------------
DROP TABLE IF EXISTS `guild_storage`;
CREATE TABLE `guild_storage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guild_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `added_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `guild_id` (`guild_id`),
  KEY `item_id` (`item_id`),
  KEY `added_by` (`added_by`),
  CONSTRAINT `guild_storage_ibfk_1` FOREIGN KEY (`guild_id`) REFERENCES `guilds` (`id`) ON DELETE CASCADE,
  CONSTRAINT `guild_storage_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE,
  CONSTRAINT `guild_storage_ibfk_3` FOREIGN KEY (`added_by`) REFERENCES `gracze` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of guild_storage
-- ----------------------------
INSERT INTO `guild_storage` VALUES ('1', '1', '1', '6', '2025-05-24 21:13:28');

-- ----------------------------
-- Table structure for `items`
-- ----------------------------
DROP TABLE IF EXISTS `items`;
CREATE TABLE `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` text,
  `type` varchar(20) NOT NULL,
  `attack_bonus` int(11) DEFAULT '0',
  `defense_bonus` int(11) DEFAULT '0',
  `sell_value` int(11) NOT NULL DEFAULT '10',
  `value` int(11) NOT NULL DEFAULT '0',
  `price` int(11) NOT NULL DEFAULT '0',
  `image` varchar(255) DEFAULT 'default.png',
  `slot` varchar(20) NOT NULL DEFAULT 'misc',
  `dex_bonus` int(11) DEFAULT '0',
  `level_required` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=932 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of items
-- ----------------------------
INSERT INTO `items` VALUES ('1', 'Iron Sword', 'A sturdy sword made of iron.', 'weapon', '5', '0', '50', '0', '0', '1_2.gif', 'weapon', '0', '1');
INSERT INTO `items` VALUES ('2', 'Leather Armor', 'Simple protective armor.', 'armor', '0', '3', '40', '0', '0', '3_1.gif', 'armor', '0', '1');
INSERT INTO `items` VALUES ('3', 'Healing Potion', 'Restores 20 HP.', 'potion', '0', '0', '10', '0', '0', '01.png', 'misc', '2', '1');
INSERT INTO `items` VALUES ('8', 'Bronze Sword', null, 'weapon', '0', '0', '10', '5', '50', '1_2.gif', 'weapon', '0', '1');
INSERT INTO `items` VALUES ('9', 'Leather Armor', null, 'armor', '0', '0', '10', '3', '30', '3_1.gif', 'armor', '1', '1');
INSERT INTO `items` VALUES ('10', 'Iron Shield', null, 'shield', '0', '0', '10', '4', '40', 'm2_1.png', 'shield', '0', '1');
INSERT INTO `items` VALUES ('11', 'Health Potion', null, 'consumable', '0', '0', '10', '20', '15', '01.png', 'consumable', '0', '1');
INSERT INTO `items` VALUES ('12', 'Iron Helmet', 'Protects your head.', 'helmet', '0', '2', '20', '5', '0', '4_1.gif', 'helm', '0', '1');
INSERT INTO `items` VALUES ('13', 'Leather Boots', 'Sturdy boots.', 'boots', '0', '1', '15', '5', '0', 'm8_5.png', 'boots', '0', '1');
INSERT INTO `items` VALUES ('14', 'Gloves of Grip', 'Increases dexterity.', 'gloves', '0', '0', '25', '5', '0', '5_3.gif', 'gloves', '0', '1');
INSERT INTO `items` VALUES ('15', 'Rusty Sword', 'A dull but usable sword', 'weapon', '3', '0', '10', '5', '25', '1_2.gif', 'weapon', '0', '1');
INSERT INTO `items` VALUES ('16', 'Wooden Shield', 'Basic wooden shield', 'shield', '0', '3', '10', '4', '20', 'm2_1.png', 'shield', '0', '1');
INSERT INTO `items` VALUES ('17', 'Leather Armor', 'Simple armor of leather', 'armor', '0', '2', '10', '8', '30', '3_1.gif', 'armor', '1', '1');
INSERT INTO `items` VALUES ('18', 'Iron Sword', 'Stronger than rusty one', 'weapon', '6', '0', '10', '10', '60', '1_2.gif', 'weapon', '0', '2');
INSERT INTO `items` VALUES ('19', 'Steel Shield', 'Strong and solid', 'shield', '0', '5', '10', '9', '55', 'm2_1.png', 'shield', '0', '2');
INSERT INTO `items` VALUES ('20', 'Chainmail Armor', 'Decent protection', 'armor', '0', '4', '10', '12', '70', '3_1.gif', 'armor', '1', '2');
INSERT INTO `items` VALUES ('21', 'Battle Axe', 'Powerful and heavy', 'weapon', '9', '0', '10', '14', '90', 'm1_5.png', 'weapon', '0', '3');
INSERT INTO `items` VALUES ('22', 'Plate Armor', 'Heavy but sturdy', 'armor', '0', '6', '10', '18', '120', '3_1.gif', 'armor', '0', '4');
INSERT INTO `items` VALUES ('23', 'Elven Boots', 'Light and fast', 'boots', '0', '0', '10', '6', '40', 'm8_5.png', 'boots', '3', '1');
INSERT INTO `items` VALUES ('24', 'Iron Helm', 'Protects your head', 'helm', '0', '2', '10', '5', '35', '4_1.gif', 'helm', '0', '2');
INSERT INTO `items` VALUES ('25', 'Leather Gloves', 'Basic hand protection', 'gloves', '0', '1', '10', '3', '20', '5_3.gif', 'gloves', '1', '1');
INSERT INTO `items` VALUES ('26', 'Weapon of Level 1', null, 'weapon', '5', '0', '10', '10', '0', '1_2.gif', 'weapon', '0', '1');
INSERT INTO `items` VALUES ('27', 'Armor of Level 1', null, 'armor', '0', '5', '10', '10', '0', '3_1.gif', 'armor', '0', '1');
INSERT INTO `items` VALUES ('28', 'Ring of Level 1', null, 'ring', '1', '1', '10', '10', '0', 'm6_2.png', 'ring', '1', '1');
INSERT INTO `items` VALUES ('29', 'Necklace of Level 1', null, 'necklace', '2', '2', '10', '10', '0', 'm9_1.png', 'necklace', '2', '1');
INSERT INTO `items` VALUES ('30', 'Shield of Level 1', null, 'shield', '0', '10', '10', '10', '0', 'm2_1.png', 'shield', '0', '1');
INSERT INTO `items` VALUES ('31', 'Weapon of Level 2', null, 'weapon', '5', '0', '10', '20', '0', '1_2.gif', 'weapon', '0', '2');
INSERT INTO `items` VALUES ('32', 'Armor of Level 2', null, 'armor', '0', '5', '10', '20', '0', '3_1.gif', 'armor', '0', '2');
INSERT INTO `items` VALUES ('33', 'Ring of Level 2', null, 'ring', '1', '1', '10', '20', '0', 'm6_2.png', 'ring', '1', '2');
INSERT INTO `items` VALUES ('34', 'Necklace of Level 2', null, 'necklace', '2', '2', '10', '20', '0', 'm9_1.png', 'necklace', '2', '2');
INSERT INTO `items` VALUES ('35', 'Shield of Level 2', null, 'shield', '0', '10', '10', '20', '0', 'm2_1.png', 'shield', '0', '2');
INSERT INTO `items` VALUES ('36', 'Weapon of Level 3', null, 'weapon', '6', '0', '10', '30', '0', '1_2.gif', 'weapon', '0', '3');
INSERT INTO `items` VALUES ('37', 'Armor of Level 3', null, 'armor', '0', '6', '10', '30', '0', '3_1.gif', 'armor', '0', '3');
INSERT INTO `items` VALUES ('38', 'Ring of Level 3', null, 'ring', '1', '1', '10', '30', '0', 'm6_2.png', 'ring', '1', '3');
INSERT INTO `items` VALUES ('39', 'Necklace of Level 3', null, 'necklace', '2', '2', '10', '30', '0', 'm9_1.png', 'necklace', '2', '3');
INSERT INTO `items` VALUES ('40', 'Shield of Level 3', null, 'shield', '0', '11', '10', '30', '0', 'm2_1.png', 'shield', '0', '3');
INSERT INTO `items` VALUES ('41', 'Weapon of Level 4', null, 'weapon', '6', '0', '10', '40', '0', '1_2.gif', 'weapon', '0', '4');
INSERT INTO `items` VALUES ('42', 'Armor of Level 4', null, 'armor', '0', '6', '10', '40', '0', '3_1.gif', 'armor', '0', '4');
INSERT INTO `items` VALUES ('43', 'Ring of Level 4', null, 'ring', '1', '1', '10', '40', '0', 'm6_2.png', 'ring', '1', '4');
INSERT INTO `items` VALUES ('44', 'Necklace of Level 4', null, 'necklace', '2', '2', '10', '40', '0', 'm9_1.png', 'necklace', '2', '4');
INSERT INTO `items` VALUES ('45', 'Shield of Level 4', null, 'shield', '0', '11', '10', '40', '0', 'm2_1.png', 'shield', '0', '4');
INSERT INTO `items` VALUES ('46', 'Weapon of Level 5', null, 'weapon', '7', '0', '10', '50', '0', '1_2.gif', 'weapon', '0', '5');
INSERT INTO `items` VALUES ('47', 'Armor of Level 5', null, 'armor', '0', '7', '10', '50', '0', '3_1.gif', 'armor', '0', '5');
INSERT INTO `items` VALUES ('48', 'Ring of Level 5', null, 'ring', '1', '1', '10', '50', '0', '6_1.gif', 'ring', '1', '5');
INSERT INTO `items` VALUES ('49', 'Necklace of Level 5', null, 'necklace', '2', '2', '10', '50', '0', '9_1.gif', 'necklace', '2', '5');
INSERT INTO `items` VALUES ('50', 'Shield of Level 5', null, 'shield', '0', '12', '10', '50', '0', '2_1.gif', 'shield', '0', '5');
INSERT INTO `items` VALUES ('51', 'Weapon of Level 6', null, 'weapon', '7', '0', '10', '60', '0', '1_2.gif', 'weapon', '0', '6');
INSERT INTO `items` VALUES ('52', 'Armor of Level 6', null, 'armor', '0', '7', '10', '60', '0', '3_1.gif', 'armor', '0', '6');
INSERT INTO `items` VALUES ('53', 'Ring of Level 6', null, 'ring', '1', '1', '10', '60', '0', '6_1.gif', 'ring', '1', '6');
INSERT INTO `items` VALUES ('54', 'Necklace of Level 6', null, 'necklace', '2', '2', '10', '60', '0', '9_1.gif', 'necklace', '2', '6');
INSERT INTO `items` VALUES ('55', 'Shield of Level 6', null, 'shield', '0', '12', '10', '60', '0', '2_1.gif', 'shield', '0', '6');
INSERT INTO `items` VALUES ('56', 'Weapon of Level 7', null, 'weapon', '8', '0', '10', '70', '0', '1_2.gif', 'weapon', '0', '7');
INSERT INTO `items` VALUES ('57', 'Armor of Level 7', null, 'armor', '0', '8', '10', '70', '0', '3_1.gif', 'armor', '0', '7');
INSERT INTO `items` VALUES ('58', 'Ring of Level 7', null, 'ring', '1', '1', '10', '70', '0', '6_1.gif', 'ring', '1', '7');
INSERT INTO `items` VALUES ('59', 'Necklace of Level 7', null, 'necklace', '2', '2', '10', '70', '0', '9_1.gif', 'necklace', '2', '7');
INSERT INTO `items` VALUES ('60', 'Shield of Level 7', null, 'shield', '0', '12', '10', '70', '0', '2_1.gif', 'shield', '0', '7');
INSERT INTO `items` VALUES ('61', 'Weapon of Level 8', null, 'weapon', '8', '0', '10', '80', '0', '1_2.gif', 'weapon', '0', '8');
INSERT INTO `items` VALUES ('62', 'Armor of Level 8', null, 'armor', '0', '8', '10', '80', '0', '3_1.gif', 'armor', '0', '8');
INSERT INTO `items` VALUES ('63', 'Ring of Level 8', null, 'ring', '1', '1', '10', '80', '0', '6_1.gif', 'ring', '1', '8');
INSERT INTO `items` VALUES ('64', 'Necklace of Level 8', null, 'necklace', '2', '2', '10', '80', '0', '9_1.gif', 'necklace', '2', '8');
INSERT INTO `items` VALUES ('65', 'Shield of Level 8', null, 'shield', '0', '13', '10', '80', '0', '2_1.gif', 'shield', '0', '8');
INSERT INTO `items` VALUES ('66', 'Weapon of Level 9', null, 'weapon', '9', '0', '10', '90', '0', '1_2.gif', 'weapon', '0', '9');
INSERT INTO `items` VALUES ('67', 'Armor of Level 9', null, 'armor', '0', '9', '10', '90', '0', '3_1.gif', 'armor', '0', '9');
INSERT INTO `items` VALUES ('68', 'Ring of Level 9', null, 'ring', '1', '1', '10', '90', '0', '6_1.gif', 'ring', '1', '9');
INSERT INTO `items` VALUES ('69', 'Necklace of Level 9', null, 'necklace', '2', '2', '10', '90', '0', '9_1.gif', 'necklace', '2', '9');
INSERT INTO `items` VALUES ('70', 'Shield of Level 9', null, 'shield', '0', '13', '10', '90', '0', '2_1.gif', 'shield', '0', '9');
INSERT INTO `items` VALUES ('71', 'Weapon of Level 10', null, 'weapon', '9', '0', '10', '100', '0', '1_3.gif', 'weapon', '0', '10');
INSERT INTO `items` VALUES ('72', 'Armor of Level 10', null, 'armor', '0', '9', '10', '100', '0', '3_2.gif', 'armor', '0', '10');
INSERT INTO `items` VALUES ('73', 'Ring of Level 10', null, 'ring', '1', '1', '10', '100', '0', '6_1.gif', 'ring', '1', '10');
INSERT INTO `items` VALUES ('74', 'Necklace of Level 10', null, 'necklace', '3', '3', '10', '100', '0', '9_2.gif', 'necklace', '3', '10');
INSERT INTO `items` VALUES ('75', 'Shield of Level 10', null, 'shield', '0', '14', '10', '100', '0', '2_2.gif', 'shield', '0', '10');
INSERT INTO `items` VALUES ('76', 'Weapon of Level 11', null, 'weapon', '9', '0', '10', '110', '0', '1_3.gif', 'weapon', '0', '11');
INSERT INTO `items` VALUES ('77', 'Armor of Level 11', null, 'armor', '0', '9', '10', '110', '0', '3_2.gif', 'armor', '0', '11');
INSERT INTO `items` VALUES ('78', 'Ring of Level 11', null, 'ring', '1', '1', '10', '110', '0', '6_1.gif', 'ring', '1', '11');
INSERT INTO `items` VALUES ('79', 'Necklace of Level 11', null, 'necklace', '3', '3', '10', '110', '0', '9_2.gif', 'necklace', '3', '11');
INSERT INTO `items` VALUES ('80', 'Shield of Level 11', null, 'shield', '0', '14', '10', '110', '0', '2_2.gif', 'shield', '0', '11');
INSERT INTO `items` VALUES ('81', 'Weapon of Level 12', null, 'weapon', '10', '0', '10', '120', '0', '1_3.gif', 'weapon', '0', '12');
INSERT INTO `items` VALUES ('82', 'Armor of Level 12', null, 'armor', '0', '10', '10', '120', '0', '3_2.gif', 'armor', '0', '12');
INSERT INTO `items` VALUES ('83', 'Ring of Level 12', null, 'ring', '2', '2', '10', '120', '0', '6_1.gif', 'ring', '2', '12');
INSERT INTO `items` VALUES ('84', 'Necklace of Level 12', null, 'necklace', '3', '3', '10', '120', '0', '9_2.gif', 'necklace', '3', '12');
INSERT INTO `items` VALUES ('85', 'Shield of Level 12', null, 'shield', '0', '14', '10', '120', '0', '2_2.gif', 'shield', '0', '12');
INSERT INTO `items` VALUES ('86', 'Weapon of Level 13', null, 'weapon', '10', '0', '10', '130', '0', '1_3.gif', 'weapon', '0', '13');
INSERT INTO `items` VALUES ('87', 'Armor of Level 13', null, 'armor', '0', '10', '10', '130', '0', '3_2.gif', 'armor', '0', '13');
INSERT INTO `items` VALUES ('88', 'Ring of Level 13', null, 'ring', '2', '2', '10', '130', '0', '6_1.gif', 'ring', '2', '13');
INSERT INTO `items` VALUES ('89', 'Necklace of Level 13', null, 'necklace', '3', '3', '10', '130', '0', '9_2.gif', 'necklace', '3', '13');
INSERT INTO `items` VALUES ('90', 'Shield of Level 13', null, 'shield', '0', '15', '10', '130', '0', '2_2.gif', 'shield', '0', '13');
INSERT INTO `items` VALUES ('91', 'Weapon of Level 14', null, 'weapon', '11', '0', '10', '140', '0', '1_3.gif', 'weapon', '0', '14');
INSERT INTO `items` VALUES ('92', 'Armor of Level 14', null, 'armor', '0', '11', '10', '140', '0', '3_2.gif', 'armor', '0', '14');
INSERT INTO `items` VALUES ('93', 'Ring of Level 14', null, 'ring', '2', '2', '10', '140', '0', '6_1.gif', 'ring', '2', '14');
INSERT INTO `items` VALUES ('94', 'Necklace of Level 14', null, 'necklace', '3', '3', '10', '140', '0', '9_2.gif', 'necklace', '3', '14');
INSERT INTO `items` VALUES ('95', 'Shield of Level 14', null, 'shield', '0', '15', '10', '140', '0', '2_2.gif', 'shield', '0', '14');
INSERT INTO `items` VALUES ('96', 'Weapon of Level 15', null, 'weapon', '11', '0', '10', '150', '0', '1_3.gif', 'weapon', '0', '15');
INSERT INTO `items` VALUES ('97', 'Armor of Level 15', null, 'armor', '0', '11', '10', '150', '0', '3_2.gif', 'armor', '0', '15');
INSERT INTO `items` VALUES ('98', 'Ring of Level 15', null, 'ring', '2', '2', '10', '150', '0', '6_1.gif', 'ring', '2', '15');
INSERT INTO `items` VALUES ('99', 'Necklace of Level 15', null, 'necklace', '3', '3', '10', '150', '0', '9_2.gif', 'necklace', '3', '15');
INSERT INTO `items` VALUES ('100', 'Shield of Level 15', null, 'shield', '0', '16', '10', '150', '0', '2_2.gif', 'shield', '0', '15');
INSERT INTO `items` VALUES ('101', 'Weapon of Level 16', null, 'weapon', '12', '0', '10', '160', '0', '1_3.gif', 'weapon', '0', '16');
INSERT INTO `items` VALUES ('102', 'Armor of Level 16', null, 'armor', '0', '12', '10', '160', '0', '3_2.gif', 'armor', '0', '16');
INSERT INTO `items` VALUES ('103', 'Ring of Level 16', null, 'ring', '2', '2', '10', '160', '0', '6_1.gif', 'ring', '2', '16');
INSERT INTO `items` VALUES ('104', 'Necklace of Level 16', null, 'necklace', '3', '3', '10', '160', '0', '9_2.gif', 'necklace', '3', '16');
INSERT INTO `items` VALUES ('105', 'Shield of Level 16', null, 'shield', '0', '16', '10', '160', '0', '2_2.gif', 'shield', '0', '16');
INSERT INTO `items` VALUES ('106', 'Weapon of Level 17', null, 'weapon', '12', '0', '10', '170', '0', '1_3.gif', 'weapon', '0', '17');
INSERT INTO `items` VALUES ('107', 'Armor of Level 17', null, 'armor', '0', '12', '10', '170', '0', '3_2.gif', 'armor', '0', '17');
INSERT INTO `items` VALUES ('108', 'Ring of Level 17', null, 'ring', '2', '2', '10', '170', '0', '6_1.gif', 'ring', '2', '17');
INSERT INTO `items` VALUES ('109', 'Necklace of Level 17', null, 'necklace', '3', '3', '10', '170', '0', '9_2.gif', 'necklace', '3', '17');
INSERT INTO `items` VALUES ('110', 'Shield of Level 17', null, 'shield', '0', '16', '10', '170', '0', '2_2.gif', 'shield', '0', '17');
INSERT INTO `items` VALUES ('111', 'Weapon of Level 18', null, 'weapon', '13', '0', '10', '180', '0', '1_3.gif', 'weapon', '0', '18');
INSERT INTO `items` VALUES ('112', 'Armor of Level 18', null, 'armor', '0', '13', '10', '180', '0', '3_2.gif', 'armor', '0', '18');
INSERT INTO `items` VALUES ('113', 'Ring of Level 18', null, 'ring', '2', '2', '10', '180', '0', '6_1.gif', 'ring', '2', '18');
INSERT INTO `items` VALUES ('114', 'Necklace of Level 18', null, 'necklace', '3', '3', '10', '180', '0', '9_2.gif', 'necklace', '3', '18');
INSERT INTO `items` VALUES ('115', 'Shield of Level 18', null, 'shield', '0', '17', '10', '180', '0', '2_2.gif', 'shield', '0', '18');
INSERT INTO `items` VALUES ('116', 'Weapon of Level 19', null, 'weapon', '13', '0', '10', '190', '0', '1_3.gif', 'weapon', '0', '19');
INSERT INTO `items` VALUES ('117', 'Armor of Level 19', null, 'armor', '0', '13', '10', '190', '0', '3_2.gif', 'armor', '0', '19');
INSERT INTO `items` VALUES ('118', 'Ring of Level 19', null, 'ring', '2', '2', '10', '190', '0', '6_1.gif', 'ring', '2', '19');
INSERT INTO `items` VALUES ('119', 'Necklace of Level 19', null, 'necklace', '3', '3', '10', '190', '0', '9_2.gif', 'necklace', '3', '19');
INSERT INTO `items` VALUES ('120', 'Shield of Level 19', null, 'shield', '0', '17', '10', '190', '0', '2_2.gif', 'shield', '0', '19');
INSERT INTO `items` VALUES ('121', 'Weapon of Level 20', null, 'weapon', '14', '1', '10', '200', '0', '1_4.gif', 'weapon', '0', '20');
INSERT INTO `items` VALUES ('122', 'Armor of Level 20', null, 'armor', '1', '14', '10', '200', '0', '3_3.gif', 'armor', '0', '20');
INSERT INTO `items` VALUES ('123', 'Ring of Level 20', null, 'ring', '2', '2', '10', '200', '0', '6_2.gif', 'ring', '2', '20');
INSERT INTO `items` VALUES ('124', 'Necklace of Level 20', null, 'necklace', '4', '4', '10', '200', '0', '9_3.gif', 'necklace', '4', '20');
INSERT INTO `items` VALUES ('125', 'Shield of Level 20', null, 'shield', '0', '18', '10', '200', '0', '2_3.gif', 'shield', '0', '20');
INSERT INTO `items` VALUES ('126', 'Weapon of Level 21', null, 'weapon', '14', '1', '10', '210', '0', '1_4.gif', 'weapon', '0', '21');
INSERT INTO `items` VALUES ('127', 'Armor of Level 21', null, 'armor', '1', '14', '10', '210', '0', '3_3.gif', 'armor', '0', '21');
INSERT INTO `items` VALUES ('128', 'Ring of Level 21', null, 'ring', '2', '2', '10', '210', '0', '6_2.gif', 'ring', '2', '21');
INSERT INTO `items` VALUES ('129', 'Necklace of Level 21', null, 'necklace', '4', '4', '10', '210', '0', '9_3.gif', 'necklace', '4', '21');
INSERT INTO `items` VALUES ('130', 'Shield of Level 21', null, 'shield', '0', '18', '10', '210', '0', '2_3.gif', 'shield', '0', '21');
INSERT INTO `items` VALUES ('131', 'Weapon of Level 22', null, 'weapon', '14', '1', '10', '220', '0', '1_4.gif', 'weapon', '0', '22');
INSERT INTO `items` VALUES ('132', 'Armor of Level 22', null, 'armor', '1', '14', '10', '220', '0', '3_3.gif', 'armor', '0', '22');
INSERT INTO `items` VALUES ('133', 'Ring of Level 22', null, 'ring', '2', '2', '10', '220', '0', '6_2.gif', 'ring', '2', '22');
INSERT INTO `items` VALUES ('134', 'Necklace of Level 22', null, 'necklace', '4', '4', '10', '220', '0', '9_3.gif', 'necklace', '4', '22');
INSERT INTO `items` VALUES ('135', 'Shield of Level 22', null, 'shield', '0', '18', '10', '220', '0', '2_3.gif', 'shield', '0', '22');
INSERT INTO `items` VALUES ('136', 'Weapon of Level 23', null, 'weapon', '15', '1', '10', '230', '0', '1_4.gif', 'weapon', '0', '23');
INSERT INTO `items` VALUES ('137', 'Armor of Level 23', null, 'armor', '1', '15', '10', '230', '0', '3_3.gif', 'armor', '0', '23');
INSERT INTO `items` VALUES ('138', 'Ring of Level 23', null, 'ring', '3', '3', '10', '230', '0', '6_2.gif', 'ring', '3', '23');
INSERT INTO `items` VALUES ('139', 'Necklace of Level 23', null, 'necklace', '4', '4', '10', '230', '0', '9_3.gif', 'necklace', '4', '23');
INSERT INTO `items` VALUES ('140', 'Shield of Level 23', null, 'shield', '0', '19', '10', '230', '0', '2_3.gif', 'shield', '0', '23');
INSERT INTO `items` VALUES ('141', 'Weapon of Level 24', null, 'weapon', '15', '1', '10', '240', '0', '1_4.gif', 'weapon', '0', '24');
INSERT INTO `items` VALUES ('142', 'Armor of Level 24', null, 'armor', '1', '15', '10', '240', '0', '3_3.gif', 'armor', '0', '24');
INSERT INTO `items` VALUES ('143', 'Ring of Level 24', null, 'ring', '3', '3', '10', '240', '0', '6_2.gif', 'ring', '3', '24');
INSERT INTO `items` VALUES ('144', 'Necklace of Level 24', null, 'necklace', '4', '4', '10', '240', '0', '9_3.gif', 'necklace', '4', '24');
INSERT INTO `items` VALUES ('145', 'Shield of Level 24', null, 'shield', '0', '19', '10', '240', '0', '2_3.gif', 'shield', '0', '24');
INSERT INTO `items` VALUES ('146', 'Weapon of Level 25', null, 'weapon', '16', '1', '10', '250', '0', '1_4.gif', 'weapon', '0', '25');
INSERT INTO `items` VALUES ('147', 'Armor of Level 25', null, 'armor', '1', '16', '10', '250', '0', '3_3.gif', 'armor', '0', '25');
INSERT INTO `items` VALUES ('148', 'Ring of Level 25', null, 'ring', '3', '3', '10', '250', '0', '6_2.gif', 'ring', '3', '25');
INSERT INTO `items` VALUES ('149', 'Necklace of Level 25', null, 'necklace', '4', '4', '10', '250', '0', '9_3.gif', 'necklace', '4', '25');
INSERT INTO `items` VALUES ('150', 'Shield of Level 25', null, 'shield', '0', '20', '10', '250', '0', '2_3.gif', 'shield', '0', '25');
INSERT INTO `items` VALUES ('151', 'Weapon of Level 26', null, 'weapon', '16', '1', '10', '260', '0', '1_4.gif', 'weapon', '0', '26');
INSERT INTO `items` VALUES ('152', 'Armor of Level 26', null, 'armor', '1', '16', '10', '260', '0', '3_3.gif', 'armor', '0', '26');
INSERT INTO `items` VALUES ('153', 'Ring of Level 26', null, 'ring', '3', '3', '10', '260', '0', '6_2.gif', 'ring', '3', '26');
INSERT INTO `items` VALUES ('154', 'Necklace of Level 26', null, 'necklace', '4', '4', '10', '260', '0', '9_3.gif', 'necklace', '4', '26');
INSERT INTO `items` VALUES ('155', 'Shield of Level 26', null, 'shield', '0', '20', '10', '260', '0', '2_3.gif', 'shield', '0', '26');
INSERT INTO `items` VALUES ('156', 'Weapon of Level 27', null, 'weapon', '17', '1', '10', '270', '0', '1_4.gif', 'weapon', '0', '27');
INSERT INTO `items` VALUES ('157', 'Armor of Level 27', null, 'armor', '1', '17', '10', '270', '0', '3_3.gif', 'armor', '0', '27');
INSERT INTO `items` VALUES ('158', 'Ring of Level 27', null, 'ring', '3', '3', '10', '270', '0', '6_2.gif', 'ring', '3', '27');
INSERT INTO `items` VALUES ('159', 'Necklace of Level 27', null, 'necklace', '4', '4', '10', '270', '0', '9_3.gif', 'necklace', '4', '27');
INSERT INTO `items` VALUES ('160', 'Shield of Level 27', null, 'shield', '0', '20', '10', '270', '0', '2_3.gif', 'shield', '0', '27');
INSERT INTO `items` VALUES ('161', 'Weapon of Level 28', null, 'weapon', '17', '1', '10', '280', '0', '1_4.gif', 'weapon', '0', '28');
INSERT INTO `items` VALUES ('162', 'Armor of Level 28', null, 'armor', '1', '17', '10', '280', '0', '3_3.gif', 'armor', '0', '28');
INSERT INTO `items` VALUES ('163', 'Ring of Level 28', null, 'ring', '3', '3', '10', '280', '0', '6_2.gif', 'ring', '3', '28');
INSERT INTO `items` VALUES ('164', 'Necklace of Level 28', null, 'necklace', '4', '4', '10', '280', '0', '9_3.gif', 'necklace', '4', '28');
INSERT INTO `items` VALUES ('165', 'Shield of Level 28', null, 'shield', '0', '21', '10', '280', '0', '2_3.gif', 'shield', '0', '28');
INSERT INTO `items` VALUES ('166', 'Weapon of Level 29', null, 'weapon', '18', '1', '10', '290', '0', '1_4.gif', 'weapon', '0', '29');
INSERT INTO `items` VALUES ('167', 'Armor of Level 29', null, 'armor', '1', '18', '10', '290', '0', '3_3.gif', 'armor', '0', '29');
INSERT INTO `items` VALUES ('168', 'Ring of Level 29', null, 'ring', '3', '3', '10', '290', '0', '6_2.gif', 'ring', '3', '29');
INSERT INTO `items` VALUES ('169', 'Necklace of Level 29', null, 'necklace', '4', '4', '10', '290', '0', '9_3.gif', 'necklace', '4', '29');
INSERT INTO `items` VALUES ('170', 'Shield of Level 29', null, 'shield', '0', '21', '10', '290', '0', '2_3.gif', 'shield', '0', '29');
INSERT INTO `items` VALUES ('171', 'Weapon of Level 30', null, 'weapon', '18', '1', '10', '300', '0', '1_9.gif', 'weapon', '0', '30');
INSERT INTO `items` VALUES ('172', 'Armor of Level 30', null, 'armor', '1', '18', '10', '300', '0', '3_4.gif', 'armor', '0', '30');
INSERT INTO `items` VALUES ('173', 'Ring of Level 30', null, 'ring', '3', '3', '10', '300', '0', '6_2.gif', 'ring', '3', '30');
INSERT INTO `items` VALUES ('174', 'Necklace of Level 30', null, 'necklace', '5', '5', '10', '300', '0', '9_4.gif', 'necklace', '5', '30');
INSERT INTO `items` VALUES ('175', 'Shield of Level 30', null, 'shield', '0', '22', '10', '300', '0', '2_4.gif', 'shield', '0', '30');
INSERT INTO `items` VALUES ('176', 'Weapon of Level 31', null, 'weapon', '18', '1', '10', '310', '0', '1_9.gif', 'weapon', '0', '31');
INSERT INTO `items` VALUES ('177', 'Armor of Level 31', null, 'armor', '1', '18', '10', '310', '0', '3_4.gif', 'armor', '0', '31');
INSERT INTO `items` VALUES ('178', 'Ring of Level 31', null, 'ring', '3', '3', '10', '310', '0', '6_2.gif', 'ring', '3', '31');
INSERT INTO `items` VALUES ('179', 'Necklace of Level 31', null, 'necklace', '5', '5', '10', '310', '0', '9_4.gif', 'necklace', '5', '31');
INSERT INTO `items` VALUES ('180', 'Shield of Level 31', null, 'shield', '0', '22', '10', '310', '0', '2_4.gif', 'shield', '0', '31');
INSERT INTO `items` VALUES ('181', 'Weapon of Level 32', null, 'weapon', '19', '1', '10', '320', '0', '1_9.gif', 'weapon', '0', '32');
INSERT INTO `items` VALUES ('182', 'Armor of Level 32', null, 'armor', '1', '19', '10', '320', '0', '3_4.gif', 'armor', '0', '32');
INSERT INTO `items` VALUES ('183', 'Ring of Level 32', null, 'ring', '3', '3', '10', '320', '0', '6_2.gif', 'ring', '3', '32');
INSERT INTO `items` VALUES ('184', 'Necklace of Level 32', null, 'necklace', '5', '5', '10', '320', '0', '9_4.gif', 'necklace', '5', '32');
INSERT INTO `items` VALUES ('185', 'Shield of Level 32', null, 'shield', '0', '22', '10', '320', '0', '2_4.gif', 'shield', '0', '32');
INSERT INTO `items` VALUES ('186', 'Weapon of Level 33', null, 'weapon', '19', '1', '10', '330', '0', '1_9.gif', 'weapon', '0', '33');
INSERT INTO `items` VALUES ('187', 'Armor of Level 33', null, 'armor', '1', '19', '10', '330', '0', '3_4.gif', 'armor', '0', '33');
INSERT INTO `items` VALUES ('188', 'Ring of Level 33', null, 'ring', '3', '3', '10', '330', '0', '6_2.gif', 'ring', '3', '33');
INSERT INTO `items` VALUES ('189', 'Necklace of Level 33', null, 'necklace', '5', '5', '10', '330', '0', '9_4.gif', 'necklace', '5', '33');
INSERT INTO `items` VALUES ('190', 'Shield of Level 33', null, 'shield', '0', '23', '10', '330', '0', '2_4.gif', 'shield', '0', '33');
INSERT INTO `items` VALUES ('191', 'Weapon of Level 34', null, 'weapon', '20', '1', '10', '340', '0', '1_9.gif', 'weapon', '1', '34');
INSERT INTO `items` VALUES ('192', 'Armor of Level 34', null, 'armor', '1', '20', '10', '340', '0', '3_4.gif', 'armor', '1', '34');
INSERT INTO `items` VALUES ('193', 'Ring of Level 34', null, 'ring', '4', '4', '10', '340', '0', '6_2.gif', 'ring', '4', '34');
INSERT INTO `items` VALUES ('194', 'Necklace of Level 34', null, 'necklace', '5', '5', '10', '340', '0', '9_4.gif', 'necklace', '5', '34');
INSERT INTO `items` VALUES ('195', 'Shield of Level 34', null, 'shield', '1', '23', '10', '340', '0', '2_4.gif', 'shield', '0', '34');
INSERT INTO `items` VALUES ('196', 'Weapon of Level 35', null, 'weapon', '20', '1', '10', '350', '0', '1_9.gif', 'weapon', '1', '35');
INSERT INTO `items` VALUES ('197', 'Armor of Level 35', null, 'armor', '1', '20', '10', '350', '0', '3_4.gif', 'armor', '1', '35');
INSERT INTO `items` VALUES ('198', 'Ring of Level 35', null, 'ring', '4', '4', '10', '350', '0', '6_2.gif', 'ring', '4', '35');
INSERT INTO `items` VALUES ('199', 'Necklace of Level 35', null, 'necklace', '5', '5', '10', '350', '0', '9_4.gif', 'necklace', '5', '35');
INSERT INTO `items` VALUES ('200', 'Shield of Level 35', null, 'shield', '1', '24', '10', '350', '0', '2_4.gif', 'shield', '0', '35');
INSERT INTO `items` VALUES ('201', 'Weapon of Level 36', null, 'weapon', '21', '1', '10', '360', '0', '1_9.gif', 'weapon', '1', '36');
INSERT INTO `items` VALUES ('202', 'Armor of Level 36', null, 'armor', '1', '21', '10', '360', '0', '3_4.gif', 'armor', '1', '36');
INSERT INTO `items` VALUES ('203', 'Ring of Level 36', null, 'ring', '4', '4', '10', '360', '0', '6_2.gif', 'ring', '4', '36');
INSERT INTO `items` VALUES ('204', 'Necklace of Level 36', null, 'necklace', '5', '5', '10', '360', '0', '9_4.gif', 'necklace', '5', '36');
INSERT INTO `items` VALUES ('205', 'Shield of Level 36', null, 'shield', '1', '24', '10', '360', '0', '2_4.gif', 'shield', '0', '36');
INSERT INTO `items` VALUES ('206', 'Weapon of Level 37', null, 'weapon', '21', '1', '10', '370', '0', '1_9.gif', 'weapon', '1', '37');
INSERT INTO `items` VALUES ('207', 'Armor of Level 37', null, 'armor', '1', '21', '10', '370', '0', '3_4.gif', 'armor', '1', '37');
INSERT INTO `items` VALUES ('208', 'Ring of Level 37', null, 'ring', '4', '4', '10', '370', '0', '6_2.gif', 'ring', '4', '37');
INSERT INTO `items` VALUES ('209', 'Necklace of Level 37', null, 'necklace', '5', '5', '10', '370', '0', '9_4.gif', 'necklace', '5', '37');
INSERT INTO `items` VALUES ('210', 'Shield of Level 37', null, 'shield', '1', '24', '10', '370', '0', '2_4.gif', 'shield', '0', '37');
INSERT INTO `items` VALUES ('211', 'Weapon of Level 38', null, 'weapon', '22', '1', '10', '380', '0', '1_9.gif', 'weapon', '1', '38');
INSERT INTO `items` VALUES ('212', 'Armor of Level 38', null, 'armor', '1', '22', '10', '380', '0', '3_4.gif', 'armor', '1', '38');
INSERT INTO `items` VALUES ('213', 'Ring of Level 38', null, 'ring', '4', '4', '10', '380', '0', '6_2.gif', 'ring', '4', '38');
INSERT INTO `items` VALUES ('214', 'Necklace of Level 38', null, 'necklace', '5', '5', '10', '380', '0', '9_4.gif', 'necklace', '5', '38');
INSERT INTO `items` VALUES ('215', 'Shield of Level 38', null, 'shield', '1', '25', '10', '380', '0', '2_4.gif', 'shield', '0', '38');
INSERT INTO `items` VALUES ('216', 'Weapon of Level 39', null, 'weapon', '22', '1', '10', '390', '0', '1_9.gif', 'weapon', '1', '39');
INSERT INTO `items` VALUES ('217', 'Armor of Level 39', null, 'armor', '1', '22', '10', '390', '0', '3_4.gif', 'armor', '1', '39');
INSERT INTO `items` VALUES ('218', 'Ring of Level 39', null, 'ring', '4', '4', '10', '390', '0', '6_2.gif', 'ring', '4', '39');
INSERT INTO `items` VALUES ('219', 'Necklace of Level 39', null, 'necklace', '5', '5', '10', '390', '0', '9_4.gif', 'necklace', '5', '39');
INSERT INTO `items` VALUES ('220', 'Shield of Level 39', null, 'shield', '1', '25', '10', '390', '0', '2_4.gif', 'shield', '0', '39');
INSERT INTO `items` VALUES ('221', 'Weapon of Level 40', null, 'weapon', '23', '2', '10', '400', '0', '1_10.gif', 'weapon', '1', '40');
INSERT INTO `items` VALUES ('222', 'Armor of Level 40', null, 'armor', '2', '23', '10', '400', '0', '3_5.gif', 'armor', '1', '40');
INSERT INTO `items` VALUES ('223', 'Ring of Level 40', null, 'ring', '4', '4', '10', '400', '0', '6_3.gif', 'ring', '4', '40');
INSERT INTO `items` VALUES ('224', 'Necklace of Level 40', null, 'necklace', '6', '6', '10', '400', '0', '9_5.gif', 'necklace', '6', '40');
INSERT INTO `items` VALUES ('225', 'Shield of Level 40', null, 'shield', '1', '26', '10', '400', '0', '2_5.gif', 'shield', '0', '40');
INSERT INTO `items` VALUES ('226', 'Weapon of Level 41', null, 'weapon', '23', '2', '10', '410', '0', '1_10.gif', 'weapon', '1', '41');
INSERT INTO `items` VALUES ('227', 'Armor of Level 41', null, 'armor', '2', '23', '10', '410', '0', '3_5.gif', 'armor', '1', '41');
INSERT INTO `items` VALUES ('228', 'Ring of Level 41', null, 'ring', '4', '4', '10', '410', '0', '6_3.gif', 'ring', '4', '41');
INSERT INTO `items` VALUES ('229', 'Necklace of Level 41', null, 'necklace', '6', '6', '10', '410', '0', '9_5.gif', 'necklace', '6', '41');
INSERT INTO `items` VALUES ('230', 'Shield of Level 41', null, 'shield', '1', '26', '10', '410', '0', '2_5.gif', 'shield', '0', '41');
INSERT INTO `items` VALUES ('231', 'Weapon of Level 42', null, 'weapon', '23', '2', '10', '420', '0', '1_10.gif', 'weapon', '1', '42');
INSERT INTO `items` VALUES ('232', 'Armor of Level 42', null, 'armor', '2', '23', '10', '420', '0', '3_5.gif', 'armor', '1', '42');
INSERT INTO `items` VALUES ('233', 'Ring of Level 42', null, 'ring', '4', '4', '10', '420', '0', '6_3.gif', 'ring', '4', '42');
INSERT INTO `items` VALUES ('234', 'Necklace of Level 42', null, 'necklace', '6', '6', '10', '420', '0', '9_5.gif', 'necklace', '6', '42');
INSERT INTO `items` VALUES ('235', 'Shield of Level 42', null, 'shield', '1', '26', '10', '420', '0', '2_5.gif', 'shield', '0', '42');
INSERT INTO `items` VALUES ('236', 'Weapon of Level 43', null, 'weapon', '24', '2', '10', '430', '0', '1_10.gif', 'weapon', '1', '43');
INSERT INTO `items` VALUES ('237', 'Armor of Level 43', null, 'armor', '2', '24', '10', '430', '0', '3_5.gif', 'armor', '1', '43');
INSERT INTO `items` VALUES ('238', 'Ring of Level 43', null, 'ring', '4', '4', '10', '430', '0', '6_3.gif', 'ring', '4', '43');
INSERT INTO `items` VALUES ('239', 'Necklace of Level 43', null, 'necklace', '6', '6', '10', '430', '0', '9_5.gif', 'necklace', '6', '43');
INSERT INTO `items` VALUES ('240', 'Shield of Level 43', null, 'shield', '1', '27', '10', '430', '0', '2_5.gif', 'shield', '0', '43');
INSERT INTO `items` VALUES ('241', 'Weapon of Level 44', null, 'weapon', '24', '2', '10', '440', '0', '1_10.gif', 'weapon', '1', '44');
INSERT INTO `items` VALUES ('242', 'Armor of Level 44', null, 'armor', '2', '24', '10', '440', '0', '3_5.gif', 'armor', '1', '44');
INSERT INTO `items` VALUES ('243', 'Ring of Level 44', null, 'ring', '4', '4', '10', '440', '0', '6_3.gif', 'ring', '4', '44');
INSERT INTO `items` VALUES ('244', 'Necklace of Level 44', null, 'necklace', '6', '6', '10', '440', '0', '9_5.gif', 'necklace', '6', '44');
INSERT INTO `items` VALUES ('245', 'Shield of Level 44', null, 'shield', '1', '27', '10', '440', '0', '2_5.gif', 'shield', '0', '44');
INSERT INTO `items` VALUES ('246', 'Weapon of Level 45', null, 'weapon', '25', '2', '10', '450', '0', '1_10.gif', 'weapon', '1', '45');
INSERT INTO `items` VALUES ('247', 'Armor of Level 45', null, 'armor', '2', '25', '10', '450', '0', '3_5.gif', 'armor', '1', '45');
INSERT INTO `items` VALUES ('248', 'Ring of Level 45', null, 'ring', '5', '5', '10', '450', '0', '6_3.gif', 'ring', '5', '45');
INSERT INTO `items` VALUES ('249', 'Necklace of Level 45', null, 'necklace', '6', '6', '10', '450', '0', '9_5.gif', 'necklace', '6', '45');
INSERT INTO `items` VALUES ('250', 'Shield of Level 45', null, 'shield', '1', '28', '10', '450', '0', '2_5.gif', 'shield', '0', '45');
INSERT INTO `items` VALUES ('251', 'Weapon of Level 46', null, 'weapon', '25', '2', '10', '460', '0', '1_10.gif', 'weapon', '1', '46');
INSERT INTO `items` VALUES ('252', 'Armor of Level 46', null, 'armor', '2', '25', '10', '460', '0', '3_5.gif', 'armor', '1', '46');
INSERT INTO `items` VALUES ('253', 'Ring of Level 46', null, 'ring', '5', '5', '10', '460', '0', '6_3.gif', 'ring', '5', '46');
INSERT INTO `items` VALUES ('254', 'Necklace of Level 46', null, 'necklace', '6', '6', '10', '460', '0', '9_5.gif', 'necklace', '6', '46');
INSERT INTO `items` VALUES ('255', 'Shield of Level 46', null, 'shield', '1', '28', '10', '460', '0', '2_5.gif', 'shield', '0', '46');
INSERT INTO `items` VALUES ('256', 'Weapon of Level 47', null, 'weapon', '26', '2', '10', '470', '0', '1_10.gif', 'weapon', '1', '47');
INSERT INTO `items` VALUES ('257', 'Armor of Level 47', null, 'armor', '2', '26', '10', '470', '0', '3_5.gif', 'armor', '1', '47');
INSERT INTO `items` VALUES ('258', 'Ring of Level 47', null, 'ring', '5', '5', '10', '470', '0', '6_3.gif', 'ring', '5', '47');
INSERT INTO `items` VALUES ('259', 'Necklace of Level 47', null, 'necklace', '6', '6', '10', '470', '0', '9_5.gif', 'necklace', '6', '47');
INSERT INTO `items` VALUES ('260', 'Shield of Level 47', null, 'shield', '1', '28', '10', '470', '0', '2_5.gif', 'shield', '0', '47');
INSERT INTO `items` VALUES ('261', 'Weapon of Level 48', null, 'weapon', '26', '2', '10', '480', '0', '1_10.gif', 'weapon', '1', '48');
INSERT INTO `items` VALUES ('262', 'Armor of Level 48', null, 'armor', '2', '26', '10', '480', '0', '3_5.gif', 'armor', '1', '48');
INSERT INTO `items` VALUES ('263', 'Ring of Level 48', null, 'ring', '5', '5', '10', '480', '0', '6_3.gif', 'ring', '5', '48');
INSERT INTO `items` VALUES ('264', 'Necklace of Level 48', null, 'necklace', '6', '6', '10', '480', '0', '9_5.gif', 'necklace', '6', '48');
INSERT INTO `items` VALUES ('265', 'Shield of Level 48', null, 'shield', '1', '29', '10', '480', '0', '2_5.gif', 'shield', '0', '48');
INSERT INTO `items` VALUES ('266', 'Weapon of Level 49', null, 'weapon', '27', '2', '10', '490', '0', '1_10.gif', 'weapon', '1', '49');
INSERT INTO `items` VALUES ('267', 'Armor of Level 49', null, 'armor', '2', '27', '10', '490', '0', '3_5.gif', 'armor', '1', '49');
INSERT INTO `items` VALUES ('268', 'Ring of Level 49', null, 'ring', '5', '5', '10', '490', '0', '6_3.gif', 'ring', '5', '49');
INSERT INTO `items` VALUES ('269', 'Necklace of Level 49', null, 'necklace', '6', '6', '10', '490', '0', '9_5.gif', 'necklace', '6', '49');
INSERT INTO `items` VALUES ('270', 'Shield of Level 49', null, 'shield', '1', '29', '10', '490', '0', '2_5.gif', 'shield', '0', '49');
INSERT INTO `items` VALUES ('271', 'Weapon of Level 50', null, 'weapon', '27', '2', '10', '500', '0', 'm1_2.png', 'weapon', '1', '50');
INSERT INTO `items` VALUES ('272', 'Armor of Level 50', null, 'armor', '2', '27', '10', '500', '0', '3_6.gif', 'armor', '1', '50');
INSERT INTO `items` VALUES ('273', 'Ring of Level 50', null, 'ring', '5', '5', '10', '500', '0', '6_3.gif', 'ring', '5', '50');
INSERT INTO `items` VALUES ('274', 'Necklace of Level 50', null, 'necklace', '7', '7', '10', '500', '0', '9_5.gif', 'necklace', '7', '50');
INSERT INTO `items` VALUES ('275', 'Shield of Level 50', null, 'shield', '1', '30', '10', '500', '0', '2_6.gif', 'shield', '1', '50');
INSERT INTO `items` VALUES ('276', 'Weapon of Level 51', null, 'weapon', '27', '2', '10', '510', '0', '1_8.gif', 'weapon', '1', '51');
INSERT INTO `items` VALUES ('277', 'Armor of Level 51', null, 'armor', '2', '27', '10', '510', '0', '3_6.gif', 'armor', '1', '51');
INSERT INTO `items` VALUES ('278', 'Ring of Level 51', null, 'ring', '5', '5', '10', '510', '0', '6_3.gif', 'ring', '5', '51');
INSERT INTO `items` VALUES ('279', 'Necklace of Level 51', null, 'necklace', '7', '7', '10', '510', '0', '9_5.gif', 'necklace', '7', '51');
INSERT INTO `items` VALUES ('280', 'Shield of Level 51', null, 'shield', '1', '30', '10', '510', '0', '2_6.gif', 'shield', '1', '51');
INSERT INTO `items` VALUES ('281', 'Weapon of Level 52', null, 'weapon', '28', '2', '10', '520', '0', '1_8.gif', 'weapon', '1', '52');
INSERT INTO `items` VALUES ('282', 'Armor of Level 52', null, 'armor', '2', '28', '10', '520', '0', '3_6.gif', 'armor', '1', '52');
INSERT INTO `items` VALUES ('283', 'Ring of Level 52', null, 'ring', '5', '5', '10', '520', '0', '6_3.gif', 'ring', '5', '52');
INSERT INTO `items` VALUES ('284', 'Necklace of Level 52', null, 'necklace', '7', '7', '10', '520', '0', '9_5.gif', 'necklace', '7', '52');
INSERT INTO `items` VALUES ('285', 'Shield of Level 52', null, 'shield', '1', '30', '10', '520', '0', '2_6.gif', 'shield', '1', '52');
INSERT INTO `items` VALUES ('286', 'Weapon of Level 53', null, 'weapon', '28', '2', '10', '530', '0', '1_8.gif', 'weapon', '1', '53');
INSERT INTO `items` VALUES ('287', 'Armor of Level 53', null, 'armor', '2', '28', '10', '530', '0', '3_6.gif', 'armor', '1', '53');
INSERT INTO `items` VALUES ('288', 'Ring of Level 53', null, 'ring', '5', '5', '10', '530', '0', '6_3.gif', 'ring', '5', '53');
INSERT INTO `items` VALUES ('289', 'Necklace of Level 53', null, 'necklace', '7', '7', '10', '530', '0', '9_5.gif', 'necklace', '7', '53');
INSERT INTO `items` VALUES ('290', 'Shield of Level 53', null, 'shield', '1', '31', '10', '530', '0', '2_6.gif', 'shield', '1', '53');
INSERT INTO `items` VALUES ('291', 'Weapon of Level 54', null, 'weapon', '29', '2', '10', '540', '0', '1_8.gif', 'weapon', '1', '54');
INSERT INTO `items` VALUES ('292', 'Armor of Level 54', null, 'armor', '2', '29', '10', '540', '0', '3_6.gif', 'armor', '1', '54');
INSERT INTO `items` VALUES ('293', 'Ring of Level 54', null, 'ring', '5', '5', '10', '540', '0', '6_3.gif', 'ring', '5', '54');
INSERT INTO `items` VALUES ('294', 'Necklace of Level 54', null, 'necklace', '7', '7', '10', '540', '0', '9_5.gif', 'necklace', '7', '54');
INSERT INTO `items` VALUES ('295', 'Shield of Level 54', null, 'shield', '1', '31', '10', '540', '0', '2_6.gif', 'shield', '1', '54');
INSERT INTO `items` VALUES ('296', 'Weapon of Level 55', null, 'weapon', '29', '2', '10', '550', '0', '1_8.gif', 'weapon', '1', '55');
INSERT INTO `items` VALUES ('297', 'Armor of Level 55', null, 'armor', '2', '29', '10', '550', '0', '3_6.gif', 'armor', '1', '55');
INSERT INTO `items` VALUES ('298', 'Ring of Level 55', null, 'ring', '5', '5', '10', '550', '0', '6_3.gif', 'ring', '5', '55');
INSERT INTO `items` VALUES ('299', 'Necklace of Level 55', null, 'necklace', '7', '7', '10', '550', '0', '9_5.gif', 'necklace', '7', '55');
INSERT INTO `items` VALUES ('300', 'Shield of Level 55', null, 'shield', '1', '32', '10', '550', '0', '2_6.gif', 'shield', '1', '55');
INSERT INTO `items` VALUES ('301', 'Weapon of Level 56', null, 'weapon', '30', '2', '10', '560', '0', '1_8.gif', 'weapon', '1', '56');
INSERT INTO `items` VALUES ('302', 'Armor of Level 56', null, 'armor', '2', '30', '10', '560', '0', '3_6.gif', 'armor', '1', '56');
INSERT INTO `items` VALUES ('303', 'Ring of Level 56', null, 'ring', '6', '6', '10', '560', '0', '6_3.gif', 'ring', '6', '56');
INSERT INTO `items` VALUES ('304', 'Necklace of Level 56', null, 'necklace', '7', '7', '10', '560', '0', '9_5.gif', 'necklace', '7', '56');
INSERT INTO `items` VALUES ('305', 'Shield of Level 56', null, 'shield', '1', '32', '10', '560', '0', '2_6.gif', 'shield', '1', '56');
INSERT INTO `items` VALUES ('306', 'Weapon of Level 57', null, 'weapon', '30', '2', '10', '570', '0', '1_8.gif', 'weapon', '1', '57');
INSERT INTO `items` VALUES ('307', 'Armor of Level 57', null, 'armor', '2', '30', '10', '570', '0', '3_6.gif', 'armor', '1', '57');
INSERT INTO `items` VALUES ('308', 'Ring of Level 57', null, 'ring', '6', '6', '10', '570', '0', '6_3.gif', 'ring', '6', '57');
INSERT INTO `items` VALUES ('309', 'Necklace of Level 57', null, 'necklace', '7', '7', '10', '570', '0', '9_5.gif', 'necklace', '7', '57');
INSERT INTO `items` VALUES ('310', 'Shield of Level 57', null, 'shield', '1', '32', '10', '570', '0', '2_6.gif', 'shield', '1', '57');
INSERT INTO `items` VALUES ('311', 'Weapon of Level 58', null, 'weapon', '31', '2', '10', '580', '0', '1_8.gif', 'weapon', '1', '58');
INSERT INTO `items` VALUES ('312', 'Armor of Level 58', null, 'armor', '2', '31', '10', '580', '0', '3_6.gif', 'armor', '1', '58');
INSERT INTO `items` VALUES ('313', 'Ring of Level 58', null, 'ring', '6', '6', '10', '580', '0', '6_3.gif', 'ring', '6', '58');
INSERT INTO `items` VALUES ('314', 'Necklace of Level 58', null, 'necklace', '7', '7', '10', '580', '0', '9_5.gif', 'necklace', '7', '58');
INSERT INTO `items` VALUES ('315', 'Shield of Level 58', null, 'shield', '1', '33', '10', '580', '0', '2_6.gif', 'shield', '1', '58');
INSERT INTO `items` VALUES ('316', 'Weapon of Level 59', null, 'weapon', '31', '2', '10', '590', '0', '1_8.gif', 'weapon', '1', '59');
INSERT INTO `items` VALUES ('317', 'Armor of Level 59', null, 'armor', '2', '31', '10', '590', '0', '3_6.gif', 'armor', '1', '59');
INSERT INTO `items` VALUES ('318', 'Ring of Level 59', null, 'ring', '6', '6', '10', '590', '0', '6_3.gif', 'ring', '6', '59');
INSERT INTO `items` VALUES ('319', 'Necklace of Level 59', null, 'necklace', '7', '7', '10', '590', '0', '9_5.gif', 'necklace', '7', '59');
INSERT INTO `items` VALUES ('320', 'Shield of Level 59', null, 'shield', '1', '33', '10', '590', '0', '2_6.gif', 'shield', '1', '59');
INSERT INTO `items` VALUES ('321', 'Weapon of Level 60', null, 'weapon', '32', '3', '10', '600', '0', 'm1_5.png', 'weapon', '1', '60');
INSERT INTO `items` VALUES ('322', 'Armor of Level 60', null, 'armor', '3', '32', '10', '600', '0', 'm3_3.png', 'armor', '1', '60');
INSERT INTO `items` VALUES ('323', 'Ring of Level 60', null, 'ring', '6', '6', '10', '600', '0', '6_4.gif', 'ring', '6', '60');
INSERT INTO `items` VALUES ('324', 'Necklace of Level 60', null, 'necklace', '8', '8', '10', '600', '0', '9_6.gif', 'necklace', '8', '60');
INSERT INTO `items` VALUES ('325', 'Shield of Level 60', null, 'shield', '1', '34', '10', '600', '0', '2_7.gif', 'shield', '1', '60');
INSERT INTO `items` VALUES ('326', 'Weapon of Level 61', null, 'weapon', '32', '3', '10', '610', '0', 'm1_5.png', 'weapon', '1', '61');
INSERT INTO `items` VALUES ('327', 'Armor of Level 61', null, 'armor', '3', '32', '10', '610', '0', 'm3_3.png', 'armor', '1', '61');
INSERT INTO `items` VALUES ('328', 'Ring of Level 61', null, 'ring', '6', '6', '10', '610', '0', '6_4.gif', 'ring', '6', '61');
INSERT INTO `items` VALUES ('329', 'Necklace of Level 61', null, 'necklace', '8', '8', '10', '610', '0', '9_6.gif', 'necklace', '8', '61');
INSERT INTO `items` VALUES ('330', 'Shield of Level 61', null, 'shield', '1', '34', '10', '610', '0', '2_7.gif', 'shield', '1', '61');
INSERT INTO `items` VALUES ('331', 'Weapon of Level 62', null, 'weapon', '32', '3', '10', '620', '0', 'm1_5.png', 'weapon', '1', '62');
INSERT INTO `items` VALUES ('332', 'Armor of Level 62', null, 'armor', '3', '32', '10', '620', '0', 'm3_3.png', 'armor', '1', '62');
INSERT INTO `items` VALUES ('333', 'Ring of Level 62', null, 'ring', '6', '6', '10', '620', '0', '6_4.gif', 'ring', '6', '62');
INSERT INTO `items` VALUES ('334', 'Necklace of Level 62', null, 'necklace', '8', '8', '10', '620', '0', '9_6.gif', 'necklace', '8', '62');
INSERT INTO `items` VALUES ('335', 'Shield of Level 62', null, 'shield', '1', '34', '10', '620', '0', '2_7.gif', 'shield', '1', '62');
INSERT INTO `items` VALUES ('336', 'Weapon of Level 63', null, 'weapon', '33', '3', '10', '630', '0', 'm1_5.png', 'weapon', '1', '63');
INSERT INTO `items` VALUES ('337', 'Armor of Level 63', null, 'armor', '3', '33', '10', '630', '0', 'm3_3.png', 'armor', '1', '63');
INSERT INTO `items` VALUES ('338', 'Ring of Level 63', null, 'ring', '6', '6', '10', '630', '0', '6_4.gif', 'ring', '6', '63');
INSERT INTO `items` VALUES ('339', 'Necklace of Level 63', null, 'necklace', '8', '8', '10', '630', '0', '9_6.gif', 'necklace', '8', '63');
INSERT INTO `items` VALUES ('340', 'Shield of Level 63', null, 'shield', '1', '35', '10', '630', '0', '2_7.gif', 'shield', '1', '63');
INSERT INTO `items` VALUES ('341', 'Weapon of Level 64', null, 'weapon', '33', '3', '10', '640', '0', 'm1_5.png', 'weapon', '1', '64');
INSERT INTO `items` VALUES ('342', 'Armor of Level 64', null, 'armor', '3', '33', '10', '640', '0', 'm3_3.png', 'armor', '1', '64');
INSERT INTO `items` VALUES ('343', 'Ring of Level 64', null, 'ring', '6', '6', '10', '640', '0', '6_4.gif', 'ring', '6', '64');
INSERT INTO `items` VALUES ('344', 'Necklace of Level 64', null, 'necklace', '8', '8', '10', '640', '0', '9_6.gif', 'necklace', '8', '64');
INSERT INTO `items` VALUES ('345', 'Shield of Level 64', null, 'shield', '1', '35', '10', '640', '0', '2_7.gif', 'shield', '1', '64');
INSERT INTO `items` VALUES ('346', 'Weapon of Level 65', null, 'weapon', '34', '3', '10', '650', '0', 'm1_5.png', 'weapon', '1', '65');
INSERT INTO `items` VALUES ('347', 'Armor of Level 65', null, 'armor', '3', '34', '10', '650', '0', 'm3_3.png', 'armor', '1', '65');
INSERT INTO `items` VALUES ('348', 'Ring of Level 65', null, 'ring', '6', '6', '10', '650', '0', '6_4.gif', 'ring', '6', '65');
INSERT INTO `items` VALUES ('349', 'Necklace of Level 65', null, 'necklace', '8', '8', '10', '650', '0', '9_6.gif', 'necklace', '8', '65');
INSERT INTO `items` VALUES ('350', 'Shield of Level 65', null, 'shield', '1', '36', '10', '650', '0', '2_7.gif', 'shield', '1', '65');
INSERT INTO `items` VALUES ('351', 'Weapon of Level 66', null, 'weapon', '34', '3', '10', '660', '0', 'm1_5.png', 'weapon', '1', '66');
INSERT INTO `items` VALUES ('352', 'Armor of Level 66', null, 'armor', '3', '34', '10', '660', '0', 'm3_3.png', 'armor', '1', '66');
INSERT INTO `items` VALUES ('353', 'Ring of Level 66', null, 'ring', '6', '6', '10', '660', '0', '6_4.gif', 'ring', '6', '66');
INSERT INTO `items` VALUES ('354', 'Necklace of Level 66', null, 'necklace', '8', '8', '10', '660', '0', '9_6.gif', 'necklace', '8', '66');
INSERT INTO `items` VALUES ('355', 'Shield of Level 66', null, 'shield', '1', '36', '10', '660', '0', '2_7.gif', 'shield', '1', '66');
INSERT INTO `items` VALUES ('356', 'Weapon of Level 67', null, 'weapon', '35', '3', '10', '670', '0', 'm1_5.png', 'weapon', '2', '67');
INSERT INTO `items` VALUES ('357', 'Armor of Level 67', null, 'armor', '3', '35', '10', '670', '0', 'm3_3.png', 'armor', '2', '67');
INSERT INTO `items` VALUES ('358', 'Ring of Level 67', null, 'ring', '7', '7', '10', '670', '0', '6_4.gif', 'ring', '7', '67');
INSERT INTO `items` VALUES ('359', 'Necklace of Level 67', null, 'necklace', '8', '8', '10', '670', '0', '9_6.gif', 'necklace', '8', '67');
INSERT INTO `items` VALUES ('360', 'Shield of Level 67', null, 'shield', '2', '36', '10', '670', '0', '2_7.gif', 'shield', '1', '67');
INSERT INTO `items` VALUES ('361', 'Weapon of Level 68', null, 'weapon', '35', '3', '10', '680', '0', 'm1_5.png', 'weapon', '2', '68');
INSERT INTO `items` VALUES ('362', 'Armor of Level 68', null, 'armor', '3', '35', '10', '680', '0', 'm3_3.png', 'armor', '2', '68');
INSERT INTO `items` VALUES ('363', 'Ring of Level 68', null, 'ring', '7', '7', '10', '680', '0', '6_4.gif', 'ring', '7', '68');
INSERT INTO `items` VALUES ('364', 'Necklace of Level 68', null, 'necklace', '8', '8', '10', '680', '0', '9_6.gif', 'necklace', '8', '68');
INSERT INTO `items` VALUES ('365', 'Shield of Level 68', null, 'shield', '2', '37', '10', '680', '0', '2_7.gif', 'shield', '1', '68');
INSERT INTO `items` VALUES ('366', 'Weapon of Level 69', null, 'weapon', '36', '3', '10', '690', '0', 'm1_5.png', 'weapon', '2', '69');
INSERT INTO `items` VALUES ('367', 'Armor of Level 69', null, 'armor', '3', '36', '10', '690', '0', 'm3_3.png', 'armor', '2', '69');
INSERT INTO `items` VALUES ('368', 'Ring of Level 69', null, 'ring', '7', '7', '10', '690', '0', '6_4.gif', 'ring', '7', '69');
INSERT INTO `items` VALUES ('369', 'Necklace of Level 69', null, 'necklace', '8', '8', '10', '690', '0', '9_6.gif', 'necklace', '8', '69');
INSERT INTO `items` VALUES ('370', 'Shield of Level 69', null, 'shield', '2', '37', '10', '690', '0', '2_7.gif', 'shield', '1', '69');
INSERT INTO `items` VALUES ('371', 'Weapon of Level 70', null, 'weapon', '36', '3', '10', '700', '0', '1_15.gif', 'weapon', '2', '70');
INSERT INTO `items` VALUES ('372', 'Armor of Level 70', null, 'armor', '3', '36', '10', '700', '0', 'm3_4.png', 'armor', '2', '70');
INSERT INTO `items` VALUES ('373', 'Ring of Level 70', null, 'ring', '7', '7', '10', '700', '0', '6_4.gif', 'ring', '7', '70');
INSERT INTO `items` VALUES ('374', 'Necklace of Level 70', null, 'necklace', '9', '9', '10', '700', '0', 'm9_3.png', 'necklace', '9', '70');
INSERT INTO `items` VALUES ('375', 'Shield of Level 70', null, 'shield', '2', '38', '10', '700', '0', '2_8.gif', 'shield', '1', '70');
INSERT INTO `items` VALUES ('376', 'Weapon of Level 71', null, 'weapon', '36', '3', '10', '710', '0', '1_15.gif', 'weapon', '2', '71');
INSERT INTO `items` VALUES ('377', 'Armor of Level 71', null, 'armor', '3', '36', '10', '710', '0', 'm3_4.png', 'armor', '2', '71');
INSERT INTO `items` VALUES ('378', 'Ring of Level 71', null, 'ring', '7', '7', '10', '710', '0', '6_4.gif', 'ring', '7', '71');
INSERT INTO `items` VALUES ('379', 'Necklace of Level 71', null, 'necklace', '9', '9', '10', '710', '0', 'm9_3.png', 'necklace', '9', '71');
INSERT INTO `items` VALUES ('380', 'Shield of Level 71', null, 'shield', '2', '38', '10', '710', '0', '2_8.gif', 'shield', '1', '71');
INSERT INTO `items` VALUES ('381', 'Weapon of Level 72', null, 'weapon', '37', '3', '10', '720', '0', '1_15.gif', 'weapon', '2', '72');
INSERT INTO `items` VALUES ('382', 'Armor of Level 72', null, 'armor', '3', '37', '10', '720', '0', 'm3_4.png', 'armor', '2', '72');
INSERT INTO `items` VALUES ('383', 'Ring of Level 72', null, 'ring', '7', '7', '10', '720', '0', '6_4.gif', 'ring', '7', '72');
INSERT INTO `items` VALUES ('384', 'Necklace of Level 72', null, 'necklace', '9', '9', '10', '720', '0', 'm9_3.png', 'necklace', '9', '72');
INSERT INTO `items` VALUES ('385', 'Shield of Level 72', null, 'shield', '2', '38', '10', '720', '0', '2_8.gif', 'shield', '1', '72');
INSERT INTO `items` VALUES ('386', 'Weapon of Level 73', null, 'weapon', '37', '3', '10', '730', '0', '1_15.gif', 'weapon', '2', '73');
INSERT INTO `items` VALUES ('387', 'Armor of Level 73', null, 'armor', '3', '37', '10', '730', '0', 'm3_4.png', 'armor', '2', '73');
INSERT INTO `items` VALUES ('388', 'Ring of Level 73', null, 'ring', '7', '7', '10', '730', '0', '6_4.gif', 'ring', '7', '73');
INSERT INTO `items` VALUES ('389', 'Necklace of Level 73', null, 'necklace', '9', '9', '10', '730', '0', 'm9_3.png', 'necklace', '9', '73');
INSERT INTO `items` VALUES ('390', 'Shield of Level 73', null, 'shield', '2', '39', '10', '730', '0', '2_8.gif', 'shield', '1', '73');
INSERT INTO `items` VALUES ('391', 'Weapon of Level 74', null, 'weapon', '38', '3', '10', '740', '0', '1_15.gif', 'weapon', '2', '74');
INSERT INTO `items` VALUES ('392', 'Armor of Level 74', null, 'armor', '3', '38', '10', '740', '0', 'm3_4.png', 'armor', '2', '74');
INSERT INTO `items` VALUES ('393', 'Ring of Level 74', null, 'ring', '7', '7', '10', '740', '0', '6_4.gif', 'ring', '7', '74');
INSERT INTO `items` VALUES ('394', 'Necklace of Level 74', null, 'necklace', '9', '9', '10', '740', '0', 'm9_3.png', 'necklace', '9', '74');
INSERT INTO `items` VALUES ('395', 'Shield of Level 74', null, 'shield', '2', '39', '10', '740', '0', '2_8.gif', 'shield', '1', '74');
INSERT INTO `items` VALUES ('396', 'Weapon of Level 75', null, 'weapon', '38', '3', '10', '750', '0', '1_15.gif', 'weapon', '2', '75');
INSERT INTO `items` VALUES ('397', 'Armor of Level 75', null, 'armor', '3', '38', '10', '750', '0', 'm3_4.png', 'armor', '2', '75');
INSERT INTO `items` VALUES ('398', 'Ring of Level 75', null, 'ring', '7', '7', '10', '750', '0', '6_4.gif', 'ring', '7', '75');
INSERT INTO `items` VALUES ('399', 'Necklace of Level 75', null, 'necklace', '9', '9', '10', '750', '0', 'm9_3.png', 'necklace', '9', '75');
INSERT INTO `items` VALUES ('400', 'Shield of Level 75', null, 'shield', '2', '40', '10', '750', '0', '2_8.gif', 'shield', '1', '75');
INSERT INTO `items` VALUES ('401', 'Weapon of Level 76', null, 'weapon', '39', '3', '10', '760', '0', '1_15.gif', 'weapon', '2', '76');
INSERT INTO `items` VALUES ('402', 'Armor of Level 76', null, 'armor', '3', '39', '10', '760', '0', 'm3_4.png', 'armor', '2', '76');
INSERT INTO `items` VALUES ('403', 'Ring of Level 76', null, 'ring', '7', '7', '10', '760', '0', '6_4.gif', 'ring', '7', '76');
INSERT INTO `items` VALUES ('404', 'Necklace of Level 76', null, 'necklace', '9', '9', '10', '760', '0', 'm9_3.png', 'necklace', '9', '76');
INSERT INTO `items` VALUES ('405', 'Shield of Level 76', null, 'shield', '2', '40', '10', '760', '0', '2_8.gif', 'shield', '1', '76');
INSERT INTO `items` VALUES ('406', 'Weapon of Level 77', null, 'weapon', '39', '3', '10', '770', '0', '1_15.gif', 'weapon', '2', '77');
INSERT INTO `items` VALUES ('407', 'Armor of Level 77', null, 'armor', '3', '39', '10', '770', '0', 'm3_4.png', 'armor', '2', '77');
INSERT INTO `items` VALUES ('408', 'Ring of Level 77', null, 'ring', '7', '7', '10', '770', '0', '6_4.gif', 'ring', '7', '77');
INSERT INTO `items` VALUES ('409', 'Necklace of Level 77', null, 'necklace', '9', '9', '10', '770', '0', 'm9_3.png', 'necklace', '9', '77');
INSERT INTO `items` VALUES ('410', 'Shield of Level 77', null, 'shield', '2', '40', '10', '770', '0', '2_8.gif', 'shield', '1', '77');
INSERT INTO `items` VALUES ('411', 'Weapon of Level 78', null, 'weapon', '40', '3', '10', '780', '0', '1_15.gif', 'weapon', '2', '78');
INSERT INTO `items` VALUES ('412', 'Armor of Level 78', null, 'armor', '3', '40', '10', '780', '0', 'm3_4.png', 'armor', '2', '78');
INSERT INTO `items` VALUES ('413', 'Ring of Level 78', null, 'ring', '8', '8', '10', '780', '0', '6_4.gif', 'ring', '8', '78');
INSERT INTO `items` VALUES ('414', 'Necklace of Level 78', null, 'necklace', '9', '9', '10', '780', '0', 'm9_3.png', 'necklace', '9', '78');
INSERT INTO `items` VALUES ('415', 'Shield of Level 78', null, 'shield', '2', '41', '10', '780', '0', '2_8.gif', 'shield', '1', '78');
INSERT INTO `items` VALUES ('416', 'Weapon of Level 79', null, 'weapon', '40', '3', '10', '790', '0', '1_15.gif', 'weapon', '2', '79');
INSERT INTO `items` VALUES ('417', 'Armor of Level 79', null, 'armor', '3', '40', '10', '790', '0', 'm3_4.png', 'armor', '2', '79');
INSERT INTO `items` VALUES ('418', 'Ring of Level 79', null, 'ring', '8', '8', '10', '790', '0', '6_4.gif', 'ring', '8', '79');
INSERT INTO `items` VALUES ('419', 'Necklace of Level 79', null, 'necklace', '9', '9', '10', '790', '0', 'm9_3.png', 'necklace', '9', '79');
INSERT INTO `items` VALUES ('420', 'Shield of Level 79', null, 'shield', '2', '41', '10', '790', '0', '2_8.gif', 'shield', '1', '79');
INSERT INTO `items` VALUES ('421', 'Weapon of Level 80', null, 'weapon', '41', '4', '10', '800', '0', 'm1_6.png', 'weapon', '2', '80');
INSERT INTO `items` VALUES ('422', 'Armor of Level 80', null, 'armor', '4', '41', '10', '800', '0', 'm3_5.png', 'armor', '2', '80');
INSERT INTO `items` VALUES ('423', 'Ring of Level 80', null, 'ring', '8', '8', '10', '800', '0', 'm6_1.png', 'ring', '8', '80');
INSERT INTO `items` VALUES ('424', 'Necklace of Level 80', null, 'necklace', '10', '10', '10', '800', '0', 'm9_2.png', 'necklace', '10', '80');
INSERT INTO `items` VALUES ('425', 'Shield of Level 80', null, 'shield', '2', '42', '10', '800', '0', '2_9.gif', 'shield', '1', '80');
INSERT INTO `items` VALUES ('426', 'Weapon of Level 81', null, 'weapon', '41', '4', '10', '810', '0', 'm1_6.png', 'weapon', '2', '81');
INSERT INTO `items` VALUES ('427', 'Armor of Level 81', null, 'armor', '4', '41', '10', '810', '0', 'm3_5.png', 'armor', '2', '81');
INSERT INTO `items` VALUES ('428', 'Ring of Level 81', null, 'ring', '8', '8', '10', '810', '0', 'm6_1.png', 'ring', '8', '81');
INSERT INTO `items` VALUES ('429', 'Necklace of Level 81', null, 'necklace', '10', '10', '10', '810', '0', 'm9_2.png', 'necklace', '10', '81');
INSERT INTO `items` VALUES ('430', 'Shield of Level 81', null, 'shield', '2', '42', '10', '810', '0', '2_9.gif', 'shield', '1', '81');
INSERT INTO `items` VALUES ('431', 'Weapon of Level 82', null, 'weapon', '41', '4', '10', '820', '0', 'm1_6.png', 'weapon', '2', '82');
INSERT INTO `items` VALUES ('432', 'Armor of Level 82', null, 'armor', '4', '41', '10', '820', '0', 'm3_5.png', 'armor', '2', '82');
INSERT INTO `items` VALUES ('433', 'Ring of Level 82', null, 'ring', '8', '8', '10', '820', '0', 'm6_1.png', 'ring', '8', '82');
INSERT INTO `items` VALUES ('434', 'Necklace of Level 82', null, 'necklace', '10', '10', '10', '820', '0', 'm9_2.png', 'necklace', '10', '82');
INSERT INTO `items` VALUES ('435', 'Shield of Level 82', null, 'shield', '2', '42', '10', '820', '0', '2_9.gif', 'shield', '1', '82');
INSERT INTO `items` VALUES ('436', 'Weapon of Level 83', null, 'weapon', '42', '4', '10', '830', '0', 'm1_6.png', 'weapon', '2', '83');
INSERT INTO `items` VALUES ('437', 'Armor of Level 83', null, 'armor', '4', '42', '10', '830', '0', 'm3_5.png', 'armor', '2', '83');
INSERT INTO `items` VALUES ('438', 'Ring of Level 83', null, 'ring', '8', '8', '10', '830', '0', 'm6_1.png', 'ring', '8', '83');
INSERT INTO `items` VALUES ('439', 'Necklace of Level 83', null, 'necklace', '10', '10', '10', '830', '0', 'm9_2.png', 'necklace', '10', '83');
INSERT INTO `items` VALUES ('440', 'Shield of Level 83', null, 'shield', '2', '43', '10', '830', '0', '2_9.gif', 'shield', '1', '83');
INSERT INTO `items` VALUES ('441', 'Weapon of Level 84', null, 'weapon', '42', '4', '10', '840', '0', 'm1_6.png', 'weapon', '2', '84');
INSERT INTO `items` VALUES ('442', 'Armor of Level 84', null, 'armor', '4', '42', '10', '840', '0', 'm3_5.png', 'armor', '2', '84');
INSERT INTO `items` VALUES ('443', 'Ring of Level 84', null, 'ring', '8', '8', '10', '840', '0', 'm6_1.png', 'ring', '8', '84');
INSERT INTO `items` VALUES ('444', 'Necklace of Level 84', null, 'necklace', '10', '10', '10', '840', '0', 'm9_2.png', 'necklace', '10', '84');
INSERT INTO `items` VALUES ('445', 'Shield of Level 84', null, 'shield', '2', '43', '10', '840', '0', '2_9.gif', 'shield', '1', '84');
INSERT INTO `items` VALUES ('446', 'Weapon of Level 85', null, 'weapon', '43', '4', '10', '850', '0', 'm1_6.png', 'weapon', '2', '85');
INSERT INTO `items` VALUES ('447', 'Armor of Level 85', null, 'armor', '4', '43', '10', '850', '0', 'm3_5.png', 'armor', '2', '85');
INSERT INTO `items` VALUES ('448', 'Ring of Level 85', null, 'ring', '8', '8', '10', '850', '0', 'm6_1.png', 'ring', '8', '85');
INSERT INTO `items` VALUES ('449', 'Necklace of Level 85', null, 'necklace', '10', '10', '10', '850', '0', 'm9_2.png', 'necklace', '10', '85');
INSERT INTO `items` VALUES ('450', 'Shield of Level 85', null, 'shield', '2', '44', '10', '850', '0', '2_9.gif', 'shield', '1', '85');
INSERT INTO `items` VALUES ('451', 'Weapon of Level 86', null, 'weapon', '43', '4', '10', '860', '0', 'm1_6.png', 'weapon', '2', '86');
INSERT INTO `items` VALUES ('452', 'Armor of Level 86', null, 'armor', '4', '43', '10', '860', '0', 'm3_5.png', 'armor', '2', '86');
INSERT INTO `items` VALUES ('453', 'Ring of Level 86', null, 'ring', '8', '8', '10', '860', '0', 'm6_1.png', 'ring', '8', '86');
INSERT INTO `items` VALUES ('454', 'Necklace of Level 86', null, 'necklace', '10', '10', '10', '860', '0', 'm9_2.png', 'necklace', '10', '86');
INSERT INTO `items` VALUES ('455', 'Shield of Level 86', null, 'shield', '2', '44', '10', '860', '0', '2_9.gif', 'shield', '1', '86');
INSERT INTO `items` VALUES ('456', 'Weapon of Level 87', null, 'weapon', '44', '4', '10', '870', '0', 'm1_6.png', 'weapon', '2', '87');
INSERT INTO `items` VALUES ('457', 'Armor of Level 87', null, 'armor', '4', '44', '10', '870', '0', 'm3_5.png', 'armor', '2', '87');
INSERT INTO `items` VALUES ('458', 'Ring of Level 87', null, 'ring', '8', '8', '10', '870', '0', 'm6_1.png', 'ring', '8', '87');
INSERT INTO `items` VALUES ('459', 'Necklace of Level 87', null, 'necklace', '10', '10', '10', '870', '0', 'm9_2.png', 'necklace', '10', '87');
INSERT INTO `items` VALUES ('460', 'Shield of Level 87', null, 'shield', '2', '44', '10', '870', '0', '2_9.gif', 'shield', '1', '87');
INSERT INTO `items` VALUES ('461', 'Weapon of Level 88', null, 'weapon', '44', '4', '10', '880', '0', 'm1_6.png', 'weapon', '2', '88');
INSERT INTO `items` VALUES ('462', 'Armor of Level 88', null, 'armor', '4', '44', '10', '880', '0', 'm3_5.png', 'armor', '2', '88');
INSERT INTO `items` VALUES ('463', 'Ring of Level 88', null, 'ring', '8', '8', '10', '880', '0', 'm6_1.png', 'ring', '8', '88');
INSERT INTO `items` VALUES ('464', 'Necklace of Level 88', null, 'necklace', '10', '10', '10', '880', '0', 'm9_2.png', 'necklace', '10', '88');
INSERT INTO `items` VALUES ('465', 'Shield of Level 88', null, 'shield', '2', '45', '10', '880', '0', '2_9.gif', 'shield', '1', '88');
INSERT INTO `items` VALUES ('466', 'Weapon of Level 89', null, 'weapon', '45', '4', '10', '890', '0', 'm1_6.png', 'weapon', '2', '89');
INSERT INTO `items` VALUES ('467', 'Armor of Level 89', null, 'armor', '4', '45', '10', '890', '0', 'm3_5.png', 'armor', '2', '89');
INSERT INTO `items` VALUES ('468', 'Ring of Level 89', null, 'ring', '9', '9', '10', '890', '0', 'm6_1.png', 'ring', '9', '89');
INSERT INTO `items` VALUES ('469', 'Necklace of Level 89', null, 'necklace', '10', '10', '10', '890', '0', 'm9_2.png', 'necklace', '10', '89');
INSERT INTO `items` VALUES ('470', 'Shield of Level 89', null, 'shield', '2', '45', '10', '890', '0', '2_9.gif', 'shield', '1', '89');
INSERT INTO `items` VALUES ('471', 'Weapon of Level 90', null, 'weapon', '45', '4', '10', '900', '0', 'm1_4.png', 'weapon', '2', '90');
INSERT INTO `items` VALUES ('472', 'Armor of Level 90', null, 'armor', '4', '45', '10', '900', '0', 'm3_7.png', 'armor', '2', '90');
INSERT INTO `items` VALUES ('473', 'Ring of Level 90', null, 'ring', '9', '9', '10', '900', '0', 'm6_2.png', 'ring', '9', '90');
INSERT INTO `items` VALUES ('474', 'Necklace of Level 90', null, 'necklace', '11', '11', '10', '900', '0', 'm9_1.png', 'necklace', '11', '90');
INSERT INTO `items` VALUES ('475', 'Shield of Level 90', null, 'shield', '2', '46', '10', '900', '0', '2_10.gif', 'shield', '1', '90');
INSERT INTO `items` VALUES ('476', 'Weapon of Level 91', null, 'weapon', '45', '4', '10', '910', '0', 'm1_4.png', 'weapon', '2', '91');
INSERT INTO `items` VALUES ('477', 'Armor of Level 91', null, 'armor', '4', '45', '10', '910', '0', 'm3_7.png', 'armor', '2', '91');
INSERT INTO `items` VALUES ('478', 'Ring of Level 91', null, 'ring', '9', '9', '10', '910', '0', 'm6_2.png', 'ring', '9', '91');
INSERT INTO `items` VALUES ('479', 'Necklace of Level 91', null, 'necklace', '11', '11', '10', '910', '0', 'm9_1.png', 'necklace', '11', '91');
INSERT INTO `items` VALUES ('480', 'Shield of Level 91', null, 'shield', '2', '46', '10', '910', '0', '2_10.gif', 'shield', '1', '91');
INSERT INTO `items` VALUES ('481', 'Weapon of Level 92', null, 'weapon', '46', '4', '10', '920', '0', 'm1_4.png', 'weapon', '2', '92');
INSERT INTO `items` VALUES ('482', 'Armor of Level 92', null, 'armor', '4', '46', '10', '920', '0', 'm3_7.png', 'armor', '2', '92');
INSERT INTO `items` VALUES ('483', 'Ring of Level 92', null, 'ring', '9', '9', '10', '920', '0', 'm6_2.png', 'ring', '9', '92');
INSERT INTO `items` VALUES ('484', 'Necklace of Level 92', null, 'necklace', '11', '11', '10', '920', '0', 'm9_1.png', 'necklace', '11', '92');
INSERT INTO `items` VALUES ('485', 'Shield of Level 92', null, 'shield', '2', '46', '10', '920', '0', '2_10.gif', 'shield', '1', '92');
INSERT INTO `items` VALUES ('486', 'Weapon of Level 93', null, 'weapon', '46', '4', '10', '930', '0', 'm1_4.png', 'weapon', '2', '93');
INSERT INTO `items` VALUES ('487', 'Armor of Level 93', null, 'armor', '4', '46', '10', '930', '0', 'm3_7.png', 'armor', '2', '93');
INSERT INTO `items` VALUES ('488', 'Ring of Level 93', null, 'ring', '9', '9', '10', '930', '0', 'm6_2.png', 'ring', '9', '93');
INSERT INTO `items` VALUES ('489', 'Necklace of Level 93', null, 'necklace', '11', '11', '10', '930', '0', 'm9_1.png', 'necklace', '11', '93');
INSERT INTO `items` VALUES ('490', 'Shield of Level 93', null, 'shield', '2', '47', '10', '930', '0', '2_10.gif', 'shield', '1', '93');
INSERT INTO `items` VALUES ('491', 'Weapon of Level 94', null, 'weapon', '47', '4', '10', '940', '0', 'm1_4.png', 'weapon', '2', '94');
INSERT INTO `items` VALUES ('492', 'Armor of Level 94', null, 'armor', '4', '47', '10', '940', '0', 'm3_7.png', 'armor', '2', '94');
INSERT INTO `items` VALUES ('493', 'Ring of Level 94', null, 'ring', '9', '9', '10', '940', '0', 'm6_2.png', 'ring', '9', '94');
INSERT INTO `items` VALUES ('494', 'Necklace of Level 94', null, 'necklace', '11', '11', '10', '940', '0', 'm9_1.png', 'necklace', '11', '94');
INSERT INTO `items` VALUES ('495', 'Shield of Level 94', null, 'shield', '2', '47', '10', '940', '0', '2_10.gif', 'shield', '1', '94');
INSERT INTO `items` VALUES ('496', 'Weapon of Level 95', null, 'weapon', '47', '4', '10', '950', '0', 'm1_4.png', 'weapon', '2', '95');
INSERT INTO `items` VALUES ('497', 'Armor of Level 95', null, 'armor', '4', '47', '10', '950', '0', 'm3_7.png', 'armor', '2', '95');
INSERT INTO `items` VALUES ('498', 'Ring of Level 95', null, 'ring', '9', '9', '10', '950', '0', 'm6_2.png', 'ring', '9', '95');
INSERT INTO `items` VALUES ('499', 'Necklace of Level 95', null, 'necklace', '11', '11', '10', '950', '0', 'm9_1.png', 'necklace', '11', '95');
INSERT INTO `items` VALUES ('500', 'Shield of Level 95', null, 'shield', '2', '48', '10', '950', '0', '2_10.gif', 'shield', '1', '95');
INSERT INTO `items` VALUES ('501', 'Weapon of Level 96', null, 'weapon', '48', '4', '10', '960', '0', 'm1_4.png', 'weapon', '2', '96');
INSERT INTO `items` VALUES ('502', 'Armor of Level 96', null, 'armor', '4', '48', '10', '960', '0', 'm3_7.png', 'armor', '2', '96');
INSERT INTO `items` VALUES ('503', 'Ring of Level 96', null, 'ring', '9', '9', '10', '960', '0', 'm6_2.png', 'ring', '9', '96');
INSERT INTO `items` VALUES ('504', 'Necklace of Level 96', null, 'necklace', '11', '11', '10', '960', '0', 'm9_1.png', 'necklace', '11', '96');
INSERT INTO `items` VALUES ('505', 'Shield of Level 96', null, 'shield', '2', '48', '10', '960', '0', '2_10.gif', 'shield', '1', '96');
INSERT INTO `items` VALUES ('506', 'Weapon of Level 97', null, 'weapon', '48', '4', '10', '970', '0', 'm1_4.png', 'weapon', '2', '97');
INSERT INTO `items` VALUES ('507', 'Armor of Level 97', null, 'armor', '4', '48', '10', '970', '0', 'm3_7.png', 'armor', '2', '97');
INSERT INTO `items` VALUES ('508', 'Ring of Level 97', null, 'ring', '9', '9', '10', '970', '0', 'm6_2.png', 'ring', '9', '97');
INSERT INTO `items` VALUES ('509', 'Necklace of Level 97', null, 'necklace', '11', '11', '10', '970', '0', 'm9_1.png', 'necklace', '11', '97');
INSERT INTO `items` VALUES ('510', 'Shield of Level 97', null, 'shield', '2', '48', '10', '970', '0', '2_10.gif', 'shield', '1', '97');
INSERT INTO `items` VALUES ('511', 'Weapon of Level 98', null, 'weapon', '49', '4', '10', '980', '0', 'm1_4.png', 'weapon', '2', '98');
INSERT INTO `items` VALUES ('512', 'Armor of Level 98', null, 'armor', '4', '49', '10', '980', '0', 'm3_7.png', 'armor', '2', '98');
INSERT INTO `items` VALUES ('513', 'Ring of Level 98', null, 'ring', '9', '9', '10', '980', '0', 'm6_2.png', 'ring', '9', '98');
INSERT INTO `items` VALUES ('514', 'Necklace of Level 98', null, 'necklace', '11', '11', '10', '980', '0', 'm9_1.png', 'necklace', '11', '98');
INSERT INTO `items` VALUES ('515', 'Shield of Level 98', null, 'shield', '2', '49', '10', '980', '0', '2_10.gif', 'shield', '1', '98');
INSERT INTO `items` VALUES ('516', 'Weapon of Level 99', null, 'weapon', '49', '4', '10', '990', '0', 'm1_4.png', 'weapon', '2', '99');
INSERT INTO `items` VALUES ('517', 'Armor of Level 99', null, 'armor', '4', '49', '10', '990', '0', 'm3_7.png', 'armor', '2', '99');
INSERT INTO `items` VALUES ('518', 'Ring of Level 99', null, 'ring', '9', '9', '10', '990', '0', 'm6_2.png', 'ring', '9', '99');
INSERT INTO `items` VALUES ('519', 'Necklace of Level 99', null, 'necklace', '11', '11', '10', '990', '0', 'm9_1.png', 'necklace', '11', '99');
INSERT INTO `items` VALUES ('520', 'Shield of Level 99', null, 'shield', '2', '49', '10', '990', '0', '2_10.gif', 'shield', '1', '99');
INSERT INTO `items` VALUES ('521', 'Weapon of Level 100', null, 'weapon', '50', '5', '10', '1000', '0', 'm1_3.png', 'weapon', '3', '100');
INSERT INTO `items` VALUES ('522', 'Armor of Level 100', null, 'armor', '5', '50', '10', '1000', '0', 'm3_7.png', 'armor', '3', '100');
INSERT INTO `items` VALUES ('523', 'Ring of Level 100', null, 'ring', '10', '10', '10', '1000', '0', 'm6_4.png', 'ring', '10', '100');
INSERT INTO `items` VALUES ('524', 'Necklace of Level 100', null, 'necklace', '12', '12', '10', '1000', '0', 'm9_2.png', 'necklace', '12', '100');
INSERT INTO `items` VALUES ('525', 'Shield of Level 100', null, 'shield', '3', '50', '10', '1000', '0', '2_9.gif', 'shield', '2', '100');
INSERT INTO `items` VALUES ('526', 'Ring of Agility', null, 'misc', '0', '0', '10', '100', '0', '6_5.gif', 'ring2', '3', '10');
INSERT INTO `items` VALUES ('527', 'Ring of Strength', null, 'misc', '2', '1', '10', '120', '0', '6_5.gif', 'ring2', '0', '15');
INSERT INTO `items` VALUES ('528', 'Silver Ring of Strength +1', null, 'misc', '1', '0', '10', '50', '0', '6_5.gif', 'ring2', '0', '3');
INSERT INTO `items` VALUES ('529', 'Silver Ring of Strength +2', null, 'misc', '2', '0', '10', '60', '0', '6_5.gif', 'ring2', '0', '4');
INSERT INTO `items` VALUES ('530', 'Silver Ring of Strength +3', null, 'misc', '3', '0', '10', '70', '0', '6_5.gif', 'ring2', '0', '5');
INSERT INTO `items` VALUES ('531', 'Silver Ring of Strength +4', null, 'misc', '4', '0', '10', '80', '0', '6_5.gif', 'ring2', '0', '6');
INSERT INTO `items` VALUES ('532', 'Silver Ring of Strength +5', null, 'misc', '5', '0', '10', '90', '0', '6_5.gif', 'ring2', '0', '7');
INSERT INTO `items` VALUES ('533', 'Silver Ring of Strength +6', null, 'misc', '6', '0', '10', '100', '0', '6_5.gif', 'ring2', '0', '8');
INSERT INTO `items` VALUES ('534', 'Silver Ring of Strength +7', null, 'misc', '7', '0', '10', '110', '0', '6_5.gif', 'ring2', '0', '9');
INSERT INTO `items` VALUES ('535', 'Silver Ring of Strength +8', null, 'misc', '8', '0', '10', '120', '0', '6_5.gif', 'ring2', '0', '10');
INSERT INTO `items` VALUES ('536', 'Silver Ring of Strength +9', null, 'misc', '9', '0', '10', '130', '0', '6_5.gif', 'ring2', '0', '11');
INSERT INTO `items` VALUES ('537', 'Silver Ring of Strength +10', null, 'misc', '10', '0', '10', '140', '0', '6_5.gif', 'ring2', '0', '12');
INSERT INTO `items` VALUES ('538', 'Silver Ring of Strength +11', null, 'misc', '11', '0', '10', '150', '0', '6_5.gif', 'ring2', '0', '13');
INSERT INTO `items` VALUES ('539', 'Silver Ring of Strength +12', null, 'misc', '12', '0', '10', '160', '0', '6_5.gif', 'ring2', '0', '14');
INSERT INTO `items` VALUES ('540', 'Silver Ring of Strength +13', null, 'misc', '13', '0', '10', '170', '0', '6_5.gif', 'ring2', '0', '15');
INSERT INTO `items` VALUES ('541', 'Silver Ring of Strength +14', null, 'misc', '14', '0', '10', '180', '0', '6_5.gif', 'ring2', '0', '16');
INSERT INTO `items` VALUES ('542', 'Silver Ring of Strength +15', null, 'misc', '15', '0', '10', '190', '0', '6_5.gif', 'ring2', '0', '17');
INSERT INTO `items` VALUES ('543', 'Silver Ring of Strength +16', null, 'misc', '16', '0', '10', '200', '0', '6_5.gif', 'ring2', '0', '18');
INSERT INTO `items` VALUES ('544', 'Silver Ring of Strength +17', null, 'misc', '17', '0', '10', '210', '0', '6_5.gif', 'ring2', '0', '19');
INSERT INTO `items` VALUES ('545', 'Silver Ring of Strength +18', null, 'misc', '18', '0', '10', '220', '0', '6_6.gif', 'ring2', '0', '20');
INSERT INTO `items` VALUES ('546', 'Silver Ring of Strength +19', null, 'misc', '19', '0', '10', '230', '0', '6_6.gif', 'ring2', '0', '21');
INSERT INTO `items` VALUES ('547', 'Silver Ring of Strength +20', null, 'misc', '20', '0', '10', '240', '0', '6_6.gif', 'ring2', '0', '22');
INSERT INTO `items` VALUES ('548', 'Silver Ring of Strength +21', null, 'misc', '21', '0', '10', '250', '0', '6_6.gif', 'ring2', '0', '23');
INSERT INTO `items` VALUES ('549', 'Silver Ring of Strength +22', null, 'misc', '22', '0', '10', '260', '0', '6_6.gif', 'ring2', '0', '24');
INSERT INTO `items` VALUES ('550', 'Silver Ring of Strength +23', null, 'misc', '23', '0', '10', '270', '0', '6_6.gif', 'ring2', '0', '25');
INSERT INTO `items` VALUES ('551', 'Silver Ring of Strength +24', null, 'misc', '24', '0', '10', '280', '0', '6_6.gif', 'ring2', '0', '26');
INSERT INTO `items` VALUES ('552', 'Silver Ring of Strength +25', null, 'misc', '25', '0', '10', '290', '0', '6_6.gif', 'ring2', '0', '27');
INSERT INTO `items` VALUES ('553', 'Silver Ring of Strength +26', null, 'misc', '26', '0', '10', '300', '0', '6_6.gif', 'ring2', '0', '28');
INSERT INTO `items` VALUES ('554', 'Silver Ring of Strength +27', null, 'misc', '27', '0', '10', '310', '0', '6_6.gif', 'ring2', '0', '29');
INSERT INTO `items` VALUES ('555', 'Silver Ring of Strength +28', null, 'misc', '28', '0', '10', '320', '0', '6_6.gif', 'ring2', '0', '30');
INSERT INTO `items` VALUES ('556', 'Silver Ring of Strength +29', null, 'misc', '29', '0', '10', '330', '0', '6_6.gif', 'ring2', '0', '31');
INSERT INTO `items` VALUES ('557', 'Silver Ring of Strength +30', null, 'misc', '30', '0', '10', '340', '0', '6_6.gif', 'ring2', '0', '32');
INSERT INTO `items` VALUES ('558', 'Silver Ring of Strength +31', null, 'misc', '31', '0', '10', '350', '0', '6_6.gif', 'ring2', '0', '33');
INSERT INTO `items` VALUES ('559', 'Silver Ring of Strength +32', null, 'misc', '32', '0', '10', '360', '0', '6_6.gif', 'ring2', '0', '34');
INSERT INTO `items` VALUES ('560', 'Silver Ring of Strength +33', null, 'misc', '33', '0', '10', '370', '0', '6_6.gif', 'ring2', '0', '35');
INSERT INTO `items` VALUES ('561', 'Silver Ring of Strength +34', null, 'misc', '34', '0', '10', '380', '0', '6_6.gif', 'ring2', '0', '36');
INSERT INTO `items` VALUES ('562', 'Silver Ring of Strength +35', null, 'misc', '35', '0', '10', '390', '0', '6_6.gif', 'ring2', '0', '37');
INSERT INTO `items` VALUES ('563', 'Silver Ring of Strength +36', null, 'misc', '36', '0', '10', '400', '0', '6_6.gif', 'ring2', '0', '38');
INSERT INTO `items` VALUES ('564', 'Silver Ring of Strength +37', null, 'misc', '37', '0', '10', '410', '0', '6_6.gif', 'ring2', '0', '39');
INSERT INTO `items` VALUES ('565', 'Silver Ring of Strength +38', null, 'misc', '38', '0', '10', '420', '0', '6_7.gif', 'ring2', '0', '40');
INSERT INTO `items` VALUES ('566', 'Silver Ring of Strength +39', null, 'misc', '39', '0', '10', '430', '0', '6_7.gif', 'ring2', '0', '41');
INSERT INTO `items` VALUES ('567', 'Silver Ring of Strength +40', null, 'misc', '40', '0', '10', '440', '0', '6_7.gif', 'ring2', '0', '42');
INSERT INTO `items` VALUES ('568', 'Silver Ring of Strength +41', null, 'misc', '41', '0', '10', '450', '0', '6_7.gif', 'ring2', '0', '43');
INSERT INTO `items` VALUES ('569', 'Silver Ring of Strength +42', null, 'misc', '42', '0', '10', '460', '0', '6_7.gif', 'ring2', '0', '44');
INSERT INTO `items` VALUES ('570', 'Silver Ring of Strength +43', null, 'misc', '43', '0', '10', '470', '0', '6_7.gif', 'ring2', '0', '45');
INSERT INTO `items` VALUES ('571', 'Silver Ring of Strength +44', null, 'misc', '44', '0', '10', '480', '0', '6_7.gif', 'ring2', '0', '46');
INSERT INTO `items` VALUES ('572', 'Silver Ring of Strength +45', null, 'misc', '45', '0', '10', '490', '0', '6_7.gif', 'ring2', '0', '47');
INSERT INTO `items` VALUES ('573', 'Silver Ring of Strength +46', null, 'misc', '46', '0', '10', '500', '0', '6_7.gif', 'ring2', '0', '48');
INSERT INTO `items` VALUES ('574', 'Silver Ring of Strength +47', null, 'misc', '47', '0', '10', '510', '0', '6_7.gif', 'ring2', '0', '49');
INSERT INTO `items` VALUES ('575', 'Silver Ring of Strength +48', null, 'misc', '48', '0', '10', '520', '0', '6_7.gif', 'ring2', '0', '50');
INSERT INTO `items` VALUES ('576', 'Silver Ring of Strength +49', null, 'misc', '49', '0', '10', '530', '0', '6_7.gif', 'ring2', '0', '51');
INSERT INTO `items` VALUES ('577', 'Silver Ring of Strength +50', null, 'misc', '50', '0', '10', '540', '0', '6_7.gif', 'ring2', '0', '52');
INSERT INTO `items` VALUES ('578', 'Silver Ring of Strength +51', null, 'misc', '51', '0', '10', '550', '0', '6_7.gif', 'ring2', '0', '53');
INSERT INTO `items` VALUES ('579', 'Silver Ring of Strength +52', null, 'misc', '52', '0', '10', '560', '0', '6_7.gif', 'ring2', '0', '54');
INSERT INTO `items` VALUES ('580', 'Silver Ring of Strength +53', null, 'misc', '53', '0', '10', '570', '0', '6_7.gif', 'ring2', '0', '55');
INSERT INTO `items` VALUES ('581', 'Silver Ring of Strength +54', null, 'misc', '54', '0', '10', '580', '0', '6_7.gif', 'ring2', '0', '56');
INSERT INTO `items` VALUES ('582', 'Silver Ring of Strength +55', null, 'misc', '55', '0', '10', '590', '0', '6_7.gif', 'ring2', '0', '57');
INSERT INTO `items` VALUES ('583', 'Silver Ring of Strength +56', null, 'misc', '56', '0', '10', '600', '0', '6_7.gif', 'ring2', '0', '58');
INSERT INTO `items` VALUES ('584', 'Silver Ring of Strength +57', null, 'misc', '57', '0', '10', '610', '0', '6_7.gif', 'ring2', '0', '59');
INSERT INTO `items` VALUES ('585', 'Silver Ring of Strength +58', null, 'misc', '58', '0', '10', '620', '0', '6_8.gif', 'ring2', '0', '60');
INSERT INTO `items` VALUES ('586', 'Silver Ring of Strength +59', null, 'misc', '59', '0', '10', '630', '0', '6_8.gif', 'ring2', '0', '61');
INSERT INTO `items` VALUES ('587', 'Silver Ring of Strength +60', null, 'misc', '60', '0', '10', '640', '0', '6_8.gif', 'ring2', '0', '62');
INSERT INTO `items` VALUES ('588', 'Silver Ring of Strength +61', null, 'misc', '61', '0', '10', '650', '0', '6_8.gif', 'ring2', '0', '63');
INSERT INTO `items` VALUES ('589', 'Silver Ring of Strength +62', null, 'misc', '62', '0', '10', '660', '0', '6_8.gif', 'ring2', '0', '64');
INSERT INTO `items` VALUES ('590', 'Silver Ring of Strength +63', null, 'misc', '63', '0', '10', '670', '0', '6_8.gif', 'ring2', '0', '65');
INSERT INTO `items` VALUES ('591', 'Silver Ring of Strength +64', null, 'misc', '64', '0', '10', '680', '0', '6_8.gif', 'ring2', '0', '66');
INSERT INTO `items` VALUES ('592', 'Silver Ring of Strength +65', null, 'misc', '65', '0', '10', '690', '0', '6_8.gif', 'ring2', '0', '67');
INSERT INTO `items` VALUES ('593', 'Silver Ring of Strength +66', null, 'misc', '66', '0', '10', '700', '0', '6_8.gif', 'ring2', '0', '68');
INSERT INTO `items` VALUES ('594', 'Silver Ring of Strength +67', null, 'misc', '67', '0', '10', '710', '0', '6_8.gif', 'ring2', '0', '69');
INSERT INTO `items` VALUES ('595', 'Silver Ring of Strength +68', null, 'misc', '68', '0', '10', '720', '0', '6_8.gif', 'ring2', '0', '70');
INSERT INTO `items` VALUES ('596', 'Silver Ring of Strength +69', null, 'misc', '69', '0', '10', '730', '0', '6_8.gif', 'ring2', '0', '71');
INSERT INTO `items` VALUES ('597', 'Silver Ring of Strength +70', null, 'misc', '70', '0', '10', '740', '0', '6_8.gif', 'ring2', '0', '72');
INSERT INTO `items` VALUES ('598', 'Silver Ring of Strength +71', null, 'misc', '71', '0', '10', '750', '0', '6_8.gif', 'ring2', '0', '73');
INSERT INTO `items` VALUES ('599', 'Silver Ring of Strength +72', null, 'misc', '72', '0', '10', '760', '0', '6_8.gif', 'ring2', '0', '74');
INSERT INTO `items` VALUES ('600', 'Silver Ring of Strength +73', null, 'misc', '73', '0', '10', '770', '0', '6_8.gif', 'ring2', '0', '75');
INSERT INTO `items` VALUES ('601', 'Silver Ring of Strength +74', null, 'misc', '74', '0', '10', '780', '0', '6_8.gif', 'ring2', '0', '76');
INSERT INTO `items` VALUES ('602', 'Silver Ring of Strength +75', null, 'misc', '75', '0', '10', '790', '0', '6_8.gif', 'ring2', '0', '77');
INSERT INTO `items` VALUES ('603', 'Silver Ring of Strength +76', null, 'misc', '76', '0', '10', '800', '0', '6_8.gif', 'ring2', '0', '78');
INSERT INTO `items` VALUES ('604', 'Silver Ring of Strength +77', null, 'misc', '77', '0', '10', '810', '0', '6_8.gif', 'ring2', '0', '79');
INSERT INTO `items` VALUES ('605', 'Silver Ring of Strength +78', null, 'misc', '78', '0', '10', '820', '0', 'm6_3.png', 'ring2', '0', '80');
INSERT INTO `items` VALUES ('606', 'Silver Ring of Strength +79', null, 'misc', '79', '0', '10', '830', '0', 'm6_3.png', 'ring2', '0', '81');
INSERT INTO `items` VALUES ('607', 'Silver Ring of Strength +80', null, 'misc', '80', '0', '10', '840', '0', 'm6_3.png', 'ring2', '0', '82');
INSERT INTO `items` VALUES ('608', 'Silver Ring of Strength +81', null, 'misc', '81', '0', '10', '850', '0', 'm6_3.png', 'ring2', '0', '83');
INSERT INTO `items` VALUES ('609', 'Silver Ring of Strength +82', null, 'misc', '82', '0', '10', '860', '0', 'm6_3.png', 'ring2', '0', '84');
INSERT INTO `items` VALUES ('610', 'Silver Ring of Strength +83', null, 'misc', '83', '0', '10', '870', '0', 'm6_3.png', 'ring2', '0', '85');
INSERT INTO `items` VALUES ('611', 'Silver Ring of Strength +84', null, 'misc', '84', '0', '10', '880', '0', 'm6_3.png', 'ring2', '0', '86');
INSERT INTO `items` VALUES ('612', 'Silver Ring of Strength +85', null, 'misc', '85', '0', '10', '890', '0', 'm6_3.png', 'ring2', '0', '87');
INSERT INTO `items` VALUES ('613', 'Silver Ring of Strength +86', null, 'misc', '86', '0', '10', '900', '0', 'm6_3.png', 'ring2', '0', '88');
INSERT INTO `items` VALUES ('614', 'Silver Ring of Strength +87', null, 'misc', '87', '0', '10', '910', '0', 'm6_3.png', 'ring2', '0', '89');
INSERT INTO `items` VALUES ('615', 'Silver Ring of Strength +88', null, 'misc', '88', '0', '10', '920', '0', 'm6_4.png', 'ring2', '0', '90');
INSERT INTO `items` VALUES ('616', 'Silver Ring of Strength +89', null, 'misc', '89', '0', '10', '930', '0', 'm6_4.png', 'ring2', '0', '91');
INSERT INTO `items` VALUES ('617', 'Silver Ring of Strength +90', null, 'misc', '90', '0', '10', '940', '0', 'm6_4.png', 'ring2', '0', '92');
INSERT INTO `items` VALUES ('618', 'Silver Ring of Strength +91', null, 'misc', '91', '0', '10', '950', '0', 'm6_4.png', 'ring2', '0', '93');
INSERT INTO `items` VALUES ('619', 'Silver Ring of Strength +92', null, 'misc', '92', '0', '10', '960', '0', 'm6_4.png', 'ring2', '0', '94');
INSERT INTO `items` VALUES ('620', 'Silver Ring of Strength +93', null, 'misc', '93', '0', '10', '970', '0', 'm6_4.png', 'ring2', '0', '95');
INSERT INTO `items` VALUES ('621', 'Silver Ring of Strength +94', null, 'misc', '94', '0', '10', '980', '0', 'm6_4.png', 'ring2', '0', '96');
INSERT INTO `items` VALUES ('622', 'Silver Ring of Strength +95', null, 'misc', '95', '0', '10', '990', '0', 'm6_4.png', 'ring2', '0', '97');
INSERT INTO `items` VALUES ('623', 'Silver Ring of Strength +96', null, 'misc', '96', '0', '10', '1000', '0', 'm6_4.png', 'ring2', '0', '98');
INSERT INTO `items` VALUES ('624', 'Silver Ring of Strength +97', null, 'misc', '97', '0', '10', '1010', '0', 'm6_4.png', 'ring2', '0', '99');
INSERT INTO `items` VALUES ('625', 'Silver Ring of Strength +98', null, 'misc', '98', '0', '10', '1020', '0', 'm6_3.png', 'ring2', '0', '100');
INSERT INTO `items` VALUES ('626', 'Iron Helmet Lv1', 'Protects your head.', 'helmet', '0', '2', '20', '10', '0', '4_1.gif', 'helm', '0', '1');
INSERT INTO `items` VALUES ('627', 'Iron Helmet Lv2', 'Protects your head.', 'helmet', '0', '2', '20', '20', '0', '4_1.gif', 'helm', '0', '2');
INSERT INTO `items` VALUES ('628', 'Iron Helmet Lv3', 'Protects your head.', 'helmet', '0', '2', '20', '30', '0', '4_1.gif', 'helm', '0', '3');
INSERT INTO `items` VALUES ('629', 'Iron Helmet Lv4', 'Protects your head.', 'helmet', '0', '2', '20', '40', '0', '4_1.gif', 'helm', '0', '4');
INSERT INTO `items` VALUES ('630', 'Iron Helmet Lv5', 'Protects your head.', 'helmet', '0', '3', '20', '50', '0', '4_1.gif', 'helm', '0', '5');
INSERT INTO `items` VALUES ('631', 'Iron Helmet Lv6', 'Protects your head.', 'helmet', '0', '3', '30', '60', '10', '4_1.gif', 'helm', '0', '6');
INSERT INTO `items` VALUES ('632', 'Iron Helmet Lv7', 'Protects your head.', 'helmet', '0', '3', '30', '70', '10', '4_1.gif', 'helm', '0', '7');
INSERT INTO `items` VALUES ('633', 'Iron Helmet Lv8', 'Protects your head.', 'helmet', '0', '3', '30', '80', '10', '4_1.gif', 'helm', '0', '8');
INSERT INTO `items` VALUES ('634', 'Iron Helmet Lv9', 'Protects your head.', 'helmet', '0', '3', '30', '90', '10', '4_1.gif', 'helm', '0', '9');
INSERT INTO `items` VALUES ('635', 'Iron Helmet Lv10', 'Protects your head.', 'helmet', '0', '4', '30', '100', '10', '4_2.gif', 'helm', '0', '10');
INSERT INTO `items` VALUES ('636', 'Iron Helmet Lv11', 'Protects your head.', 'helmet', '0', '4', '40', '110', '20', '4_2.gif', 'helm', '0', '11');
INSERT INTO `items` VALUES ('637', 'Iron Helmet Lv12', 'Protects your head.', 'helmet', '0', '4', '40', '120', '20', '4_2.gif', 'helm', '0', '12');
INSERT INTO `items` VALUES ('638', 'Iron Helmet Lv13', 'Protects your head.', 'helmet', '0', '4', '40', '130', '20', '4_2.gif', 'helm', '0', '13');
INSERT INTO `items` VALUES ('639', 'Iron Helmet Lv14', 'Protects your head.', 'helmet', '0', '4', '40', '140', '20', '4_2.gif', 'helm', '0', '14');
INSERT INTO `items` VALUES ('640', 'Iron Helmet Lv15', 'Protects your head.', 'helmet', '0', '5', '40', '150', '20', '4_2.gif', 'helm', '0', '15');
INSERT INTO `items` VALUES ('641', 'Iron Helmet Lv16', 'Protects your head.', 'helmet', '0', '5', '50', '160', '30', '4_2.gif', 'helm', '0', '16');
INSERT INTO `items` VALUES ('642', 'Iron Helmet Lv17', 'Protects your head.', 'helmet', '0', '5', '50', '170', '30', '4_2.gif', 'helm', '0', '17');
INSERT INTO `items` VALUES ('643', 'Iron Helmet Lv18', 'Protects your head.', 'helmet', '0', '5', '50', '180', '30', '4_2.gif', 'helm', '0', '18');
INSERT INTO `items` VALUES ('644', 'Iron Helmet Lv19', 'Protects your head.', 'helmet', '0', '5', '50', '190', '30', '4_2.gif', 'helm', '0', '19');
INSERT INTO `items` VALUES ('645', 'Iron Helmet Lv20', 'Protects your head.', 'helmet', '0', '6', '50', '200', '30', '4_3.gif', 'helm', '0', '20');
INSERT INTO `items` VALUES ('646', 'Iron Helmet Lv21', 'Protects your head.', 'helmet', '0', '6', '60', '210', '40', '4_3.gif', 'helm', '0', '21');
INSERT INTO `items` VALUES ('647', 'Iron Helmet Lv22', 'Protects your head.', 'helmet', '0', '6', '60', '220', '40', '4_3.gif', 'helm', '0', '22');
INSERT INTO `items` VALUES ('648', 'Iron Helmet Lv23', 'Protects your head.', 'helmet', '0', '6', '60', '230', '40', '4_3.gif', 'helm', '0', '23');
INSERT INTO `items` VALUES ('649', 'Iron Helmet Lv24', 'Protects your head.', 'helmet', '0', '6', '60', '240', '40', '4_3.gif', 'helm', '0', '24');
INSERT INTO `items` VALUES ('650', 'Iron Helmet Lv25', 'Protects your head.', 'helmet', '0', '7', '60', '250', '40', '4_3.gif', 'helm', '0', '25');
INSERT INTO `items` VALUES ('651', 'Iron Helmet Lv26', 'Protects your head.', 'helmet', '0', '7', '70', '260', '50', '4_3.gif', 'helm', '0', '26');
INSERT INTO `items` VALUES ('652', 'Iron Helmet Lv27', 'Protects your head.', 'helmet', '0', '7', '70', '270', '50', '4_3.gif', 'helm', '0', '27');
INSERT INTO `items` VALUES ('653', 'Iron Helmet Lv28', 'Protects your head.', 'helmet', '0', '7', '70', '280', '50', '4_3.gif', 'helm', '0', '28');
INSERT INTO `items` VALUES ('654', 'Iron Helmet Lv29', 'Protects your head.', 'helmet', '0', '7', '70', '290', '50', '4_3.gif', 'helm', '0', '29');
INSERT INTO `items` VALUES ('655', 'Iron Helmet Lv30', 'Protects your head.', 'helmet', '0', '8', '70', '300', '50', '4_4.gif', 'helm', '0', '30');
INSERT INTO `items` VALUES ('656', 'Iron Helmet Lv31', 'Protects your head.', 'helmet', '0', '8', '80', '310', '60', '4_4.gif', 'helm', '0', '31');
INSERT INTO `items` VALUES ('657', 'Iron Helmet Lv32', 'Protects your head.', 'helmet', '0', '8', '80', '310', '60', '4_4.gif', 'helm', '0', '32');
INSERT INTO `items` VALUES ('658', 'Iron Helmet Lv33', 'Protects your head.', 'helmet', '0', '8', '80', '320', '60', '4_4.gif', 'helm', '0', '33');
INSERT INTO `items` VALUES ('659', 'Iron Helmet Lv34', 'Protects your head.', 'helmet', '0', '8', '80', '330', '60', '4_4.gif', 'helm', '0', '34');
INSERT INTO `items` VALUES ('660', 'Iron Helmet Lv35', 'Protects your head.', 'helmet', '0', '9', '80', '340', '60', '4_4.gif', 'helm', '0', '35');
INSERT INTO `items` VALUES ('661', 'Iron Helmet Lv36', 'Protects your head.', 'helmet', '0', '9', '90', '350', '70', '4_4.gif', 'helm', '0', '36');
INSERT INTO `items` VALUES ('662', 'Iron Helmet Lv37', 'Protects your head.', 'helmet', '0', '9', '90', '360', '70', '4_4.gif', 'helm', '0', '37');
INSERT INTO `items` VALUES ('663', 'Iron Helmet Lv38', 'Protects your head.', 'helmet', '0', '9', '90', '370', '70', '4_4.gif', 'helm', '0', '38');
INSERT INTO `items` VALUES ('664', 'Iron Helmet Lv39', 'Protects your head.', 'helmet', '0', '9', '90', '380', '70', '4_4.gif', 'helm', '0', '39');
INSERT INTO `items` VALUES ('665', 'Iron Helmet Lv40', 'Protects your head.', 'helmet', '0', '10', '90', '400', '70', '4_5.gif', 'helm', '0', '40');
INSERT INTO `items` VALUES ('666', 'Iron Helmet Lv41', 'Protects your head.', 'helmet', '0', '10', '100', '410', '80', '4_5.gif', 'helm', '0', '41');
INSERT INTO `items` VALUES ('667', 'Iron Helmet Lv42', 'Protects your head.', 'helmet', '0', '10', '100', '420', '80', '4_5.gif', 'helm', '0', '42');
INSERT INTO `items` VALUES ('668', 'Iron Helmet Lv43', 'Protects your head.', 'helmet', '0', '10', '100', '430', '80', '4_5.gif', 'helm', '0', '43');
INSERT INTO `items` VALUES ('669', 'Iron Helmet Lv44', 'Protects your head.', 'helmet', '0', '10', '100', '440', '80', '4_5.gif', 'helm', '0', '44');
INSERT INTO `items` VALUES ('670', 'Iron Helmet Lv45', 'Protects your head.', 'helmet', '0', '11', '100', '450', '80', '4_5.gif', 'helm', '0', '45');
INSERT INTO `items` VALUES ('671', 'Iron Helmet Lv46', 'Protects your head.', 'helmet', '0', '11', '110', '460', '90', '4_5.gif', 'helm', '0', '46');
INSERT INTO `items` VALUES ('672', 'Iron Helmet Lv47', 'Protects your head.', 'helmet', '0', '11', '110', '470', '90', '4_5.gif', 'helm', '0', '47');
INSERT INTO `items` VALUES ('673', 'Iron Helmet Lv48', 'Protects your head.', 'helmet', '0', '11', '110', '480', '90', '4_5.gif', 'helm', '0', '48');
INSERT INTO `items` VALUES ('674', 'Iron Helmet Lv49', 'Protects your head.', 'helmet', '0', '11', '110', '490', '90', '4_5.gif', 'helm', '0', '49');
INSERT INTO `items` VALUES ('675', 'Iron Helmet Lv50', 'Protects your head.', 'helmet', '0', '12', '110', '500', '90', '4_6.gif', 'helm', '0', '50');
INSERT INTO `items` VALUES ('676', 'Leather Boots Lv1', 'Sturdy boots.', 'boots', '0', '1', '15', '10', '0', 'm8_5.png', 'boots', '0', '1');
INSERT INTO `items` VALUES ('677', 'Leather Boots Lv2', 'Sturdy boots.', 'boots', '0', '1', '15', '20', '0', 'm8_5.png', 'boots', '0', '2');
INSERT INTO `items` VALUES ('678', 'Leather Boots Lv3', 'Sturdy boots.', 'boots', '0', '1', '15', '30', '0', 'm8_5.png', 'boots', '0', '3');
INSERT INTO `items` VALUES ('679', 'Leather Boots Lv4', 'Sturdy boots.', 'boots', '0', '1', '15', '40', '0', 'm8_5.png', 'boots', '0', '4');
INSERT INTO `items` VALUES ('680', 'Leather Boots Lv5', 'Sturdy boots.', 'boots', '0', '2', '15', '50', '0', '8_1.gif', 'boots', '0', '5');
INSERT INTO `items` VALUES ('681', 'Leather Boots Lv6', 'Sturdy boots.', 'boots', '0', '2', '25', '60', '10', '8_1.gif', 'boots', '0', '6');
INSERT INTO `items` VALUES ('682', 'Leather Boots Lv7', 'Sturdy boots.', 'boots', '0', '2', '25', '70', '10', '8_1.gif', 'boots', '0', '7');
INSERT INTO `items` VALUES ('683', 'Leather Boots Lv8', 'Sturdy boots.', 'boots', '0', '2', '25', '80', '10', '8_1.gif', 'boots', '0', '8');
INSERT INTO `items` VALUES ('684', 'Leather Boots Lv9', 'Sturdy boots.', 'boots', '0', '2', '25', '90', '10', '8_1.gif', 'boots', '0', '9');
INSERT INTO `items` VALUES ('685', 'Leather Boots Lv10', 'Sturdy boots.', 'boots', '0', '3', '25', '100', '10', '8_2.gif', 'boots', '0', '10');
INSERT INTO `items` VALUES ('686', 'Leather Boots Lv11', 'Sturdy boots.', 'boots', '0', '3', '35', '110', '20', '8_2.gif', 'boots', '0', '11');
INSERT INTO `items` VALUES ('687', 'Leather Boots Lv12', 'Sturdy boots.', 'boots', '0', '3', '35', '120', '20', '8_2.gif', 'boots', '0', '12');
INSERT INTO `items` VALUES ('688', 'Leather Boots Lv13', 'Sturdy boots.', 'boots', '0', '3', '35', '130', '20', '8_2.gif', 'boots', '0', '13');
INSERT INTO `items` VALUES ('689', 'Leather Boots Lv14', 'Sturdy boots.', 'boots', '0', '3', '35', '140', '20', '8_2.gif', 'boots', '0', '14');
INSERT INTO `items` VALUES ('690', 'Leather Boots Lv15', 'Sturdy boots.', 'boots', '0', '4', '35', '150', '20', '8_2.gif', 'boots', '0', '15');
INSERT INTO `items` VALUES ('691', 'Leather Boots Lv16', 'Sturdy boots.', 'boots', '0', '4', '45', '160', '30', '8_2.gif', 'boots', '0', '16');
INSERT INTO `items` VALUES ('692', 'Leather Boots Lv17', 'Sturdy boots.', 'boots', '0', '4', '45', '170', '30', '8_2.gif', 'boots', '0', '17');
INSERT INTO `items` VALUES ('693', 'Leather Boots Lv18', 'Sturdy boots.', 'boots', '0', '4', '45', '180', '30', '8_2.gif', 'boots', '0', '18');
INSERT INTO `items` VALUES ('694', 'Leather Boots Lv19', 'Sturdy boots.', 'boots', '0', '4', '45', '190', '30', '8_2.gif', 'boots', '0', '19');
INSERT INTO `items` VALUES ('695', 'Leather Boots Lv20', 'Sturdy boots.', 'boots', '0', '5', '45', '200', '30', '8_3.gif', 'boots', '0', '20');
INSERT INTO `items` VALUES ('696', 'Leather Boots Lv21', 'Sturdy boots.', 'boots', '0', '5', '55', '210', '40', '8_3.gif', 'boots', '0', '21');
INSERT INTO `items` VALUES ('697', 'Leather Boots Lv22', 'Sturdy boots.', 'boots', '0', '5', '55', '220', '40', '8_3.gif', 'boots', '0', '22');
INSERT INTO `items` VALUES ('698', 'Leather Boots Lv23', 'Sturdy boots.', 'boots', '0', '5', '55', '230', '40', '8_3.gif', 'boots', '0', '23');
INSERT INTO `items` VALUES ('699', 'Leather Boots Lv24', 'Sturdy boots.', 'boots', '0', '5', '55', '240', '40', '8_3.gif', 'boots', '0', '24');
INSERT INTO `items` VALUES ('700', 'Leather Boots Lv25', 'Sturdy boots.', 'boots', '0', '6', '55', '250', '40', '8_3.gif', 'boots', '0', '25');
INSERT INTO `items` VALUES ('701', 'Leather Boots Lv26', 'Sturdy boots.', 'boots', '0', '6', '65', '260', '50', '8_3.gif', 'boots', '0', '26');
INSERT INTO `items` VALUES ('702', 'Leather Boots Lv27', 'Sturdy boots.', 'boots', '0', '6', '65', '270', '50', '8_3.gif', 'boots', '0', '27');
INSERT INTO `items` VALUES ('703', 'Leather Boots Lv28', 'Sturdy boots.', 'boots', '0', '6', '65', '280', '50', '8_3.gif', 'boots', '0', '28');
INSERT INTO `items` VALUES ('704', 'Leather Boots Lv29', 'Sturdy boots.', 'boots', '0', '6', '65', '290', '50', '8_3.gif', 'boots', '0', '29');
INSERT INTO `items` VALUES ('705', 'Leather Boots Lv30', 'Sturdy boots.', 'boots', '0', '7', '65', '300', '50', '8_4.gif', 'boots', '0', '30');
INSERT INTO `items` VALUES ('706', 'Leather Boots Lv31', 'Sturdy boots.', 'boots', '0', '7', '75', '310', '60', '8_4.gif', 'boots', '0', '31');
INSERT INTO `items` VALUES ('707', 'Leather Boots Lv32', 'Sturdy boots.', 'boots', '0', '7', '75', '320', '60', '8_4.gif', 'boots', '0', '32');
INSERT INTO `items` VALUES ('708', 'Leather Boots Lv33', 'Sturdy boots.', 'boots', '0', '7', '75', '330', '60', '8_4.gif', 'boots', '0', '33');
INSERT INTO `items` VALUES ('709', 'Leather Boots Lv34', 'Sturdy boots.', 'boots', '0', '7', '75', '340', '60', '8_4.gif', 'boots', '0', '34');
INSERT INTO `items` VALUES ('710', 'Leather Boots Lv35', 'Sturdy boots.', 'boots', '0', '8', '75', '350', '60', '8_4.gif', 'boots', '0', '35');
INSERT INTO `items` VALUES ('711', 'Leather Boots Lv36', 'Sturdy boots.', 'boots', '0', '8', '85', '360', '70', '8_4.gif', 'boots', '0', '36');
INSERT INTO `items` VALUES ('712', 'Leather Boots Lv37', 'Sturdy boots.', 'boots', '0', '8', '85', '370', '70', '8_4.gif', 'boots', '0', '37');
INSERT INTO `items` VALUES ('713', 'Leather Boots Lv38', 'Sturdy boots.', 'boots', '0', '8', '85', '380', '70', '8_4.gif', 'boots', '0', '38');
INSERT INTO `items` VALUES ('714', 'Leather Boots Lv39', 'Sturdy boots.', 'boots', '0', '8', '85', '390', '70', '8_4.gif', 'boots', '0', '39');
INSERT INTO `items` VALUES ('715', 'Leather Boots Lv40', 'Sturdy boots.', 'boots', '0', '9', '85', '400', '70', '8_5.gif', 'boots', '0', '40');
INSERT INTO `items` VALUES ('716', 'Leather Boots Lv41', 'Sturdy boots.', 'boots', '0', '9', '95', '410', '80', '8_5.gif', 'boots', '0', '41');
INSERT INTO `items` VALUES ('717', 'Leather Boots Lv42', 'Sturdy boots.', 'boots', '0', '9', '95', '420', '80', '8_5.gif', 'boots', '0', '42');
INSERT INTO `items` VALUES ('718', 'Leather Boots Lv43', 'Sturdy boots.', 'boots', '0', '9', '95', '430', '80', '8_5.gif', 'boots', '0', '43');
INSERT INTO `items` VALUES ('719', 'Leather Boots Lv44', 'Sturdy boots.', 'boots', '0', '9', '95', '440', '80', '8_5.gif', 'boots', '0', '44');
INSERT INTO `items` VALUES ('720', 'Leather Boots Lv45', 'Sturdy boots.', 'boots', '0', '10', '95', '450', '80', '8_5.gif', 'boots', '0', '45');
INSERT INTO `items` VALUES ('721', 'Leather Boots Lv46', 'Sturdy boots.', 'boots', '0', '10', '105', '460', '90', '8_5.gif', 'boots', '0', '46');
INSERT INTO `items` VALUES ('722', 'Leather Boots Lv47', 'Sturdy boots.', 'boots', '0', '10', '105', '470', '90', '8_5.gif', 'boots', '0', '47');
INSERT INTO `items` VALUES ('723', 'Leather Boots Lv48', 'Sturdy boots.', 'boots', '0', '10', '105', '480', '90', '8_5.gif', 'boots', '0', '48');
INSERT INTO `items` VALUES ('724', 'Leather Boots Lv49', 'Sturdy boots.', 'boots', '0', '10', '105', '490', '90', '8_5.gif', 'boots', '0', '49');
INSERT INTO `items` VALUES ('725', 'Leather Boots Lv50', 'Sturdy boots.', 'boots', '0', '11', '105', '500', '90', '8_6.gif', 'boots', '0', '50');
INSERT INTO `items` VALUES ('726', 'Gloves of Grip Lv1', 'Increases dexterity.', 'gloves', '0', '0', '25', '10', '0', '5_3.gif', 'gloves', '0', '1');
INSERT INTO `items` VALUES ('727', 'Gloves of Grip Lv2', 'Increases dexterity.', 'gloves', '0', '0', '25', '20', '0', '5_3.gif', 'gloves', '0', '2');
INSERT INTO `items` VALUES ('728', 'Gloves of Grip Lv3', 'Increases dexterity.', 'gloves', '0', '0', '25', '30', '0', '5_3.gif', 'gloves', '0', '3');
INSERT INTO `items` VALUES ('729', 'Gloves of Grip Lv4', 'Increases dexterity.', 'gloves', '0', '0', '25', '40', '0', '5_3.gif', 'gloves', '0', '4');
INSERT INTO `items` VALUES ('730', 'Gloves of Grip Lv5', 'Increases dexterity.', 'gloves', '0', '1', '25', '50', '0', '5_1.gif', 'gloves', '0', '5');
INSERT INTO `items` VALUES ('731', 'Gloves of Grip Lv6', 'Increases dexterity.', 'gloves', '0', '1', '35', '60', '10', '5_1.gif', 'gloves', '0', '6');
INSERT INTO `items` VALUES ('732', 'Gloves of Grip Lv7', 'Increases dexterity.', 'gloves', '0', '1', '35', '70', '10', '5_1.gif', 'gloves', '0', '7');
INSERT INTO `items` VALUES ('733', 'Gloves of Grip Lv8', 'Increases dexterity.', 'gloves', '0', '1', '35', '80', '10', '5_1.gif', 'gloves', '0', '8');
INSERT INTO `items` VALUES ('734', 'Gloves of Grip Lv9', 'Increases dexterity.', 'gloves', '0', '1', '35', '90', '10', '5_1.gif', 'gloves', '0', '9');
INSERT INTO `items` VALUES ('735', 'Gloves of Grip Lv10', 'Increases dexterity.', 'gloves', '0', '2', '35', '100', '10', '5_2.gif', 'gloves', '0', '10');
INSERT INTO `items` VALUES ('736', 'Gloves of Grip Lv11', 'Increases dexterity.', 'gloves', '0', '2', '45', '110', '20', '5_2.gif', 'gloves', '1', '11');
INSERT INTO `items` VALUES ('737', 'Gloves of Grip Lv12', 'Increases dexterity.', 'gloves', '0', '2', '45', '120', '20', '5_2.gif', 'gloves', '1', '12');
INSERT INTO `items` VALUES ('738', 'Gloves of Grip Lv13', 'Increases dexterity.', 'gloves', '0', '2', '45', '130', '20', '5_2.gif', 'gloves', '1', '13');
INSERT INTO `items` VALUES ('739', 'Gloves of Grip Lv14', 'Increases dexterity.', 'gloves', '0', '2', '45', '140', '20', '5_2.gif', 'gloves', '1', '14');
INSERT INTO `items` VALUES ('740', 'Gloves of Grip Lv15', 'Increases dexterity.', 'gloves', '0', '3', '45', '150', '20', '5_2.gif', 'gloves', '1', '15');
INSERT INTO `items` VALUES ('741', 'Gloves of Grip Lv16', 'Increases dexterity.', 'gloves', '0', '3', '55', '160', '30', '5_2.gif', 'gloves', '1', '16');
INSERT INTO `items` VALUES ('742', 'Gloves of Grip Lv17', 'Increases dexterity.', 'gloves', '0', '3', '55', '170', '30', '5_2.gif', 'gloves', '1', '17');
INSERT INTO `items` VALUES ('743', 'Gloves of Grip Lv18', 'Increases dexterity.', 'gloves', '0', '3', '55', '180', '30', '5_2.gif', 'gloves', '1', '18');
INSERT INTO `items` VALUES ('744', 'Gloves of Grip Lv19', 'Increases dexterity.', 'gloves', '0', '3', '55', '190', '30', '5_2.gif', 'gloves', '1', '19');
INSERT INTO `items` VALUES ('745', 'Gloves of Grip Lv20', 'Increases dexterity.', 'gloves', '0', '4', '55', '200', '30', '5_3.gif', 'gloves', '1', '20');
INSERT INTO `items` VALUES ('746', 'Gloves of Grip Lv21', 'Increases dexterity.', 'gloves', '0', '4', '65', '210', '40', '5_3.gif', 'gloves', '2', '21');
INSERT INTO `items` VALUES ('747', 'Gloves of Grip Lv22', 'Increases dexterity.', 'gloves', '0', '4', '65', '220', '40', '5_3.gif', 'gloves', '2', '22');
INSERT INTO `items` VALUES ('748', 'Gloves of Grip Lv23', 'Increases dexterity.', 'gloves', '0', '4', '65', '230', '40', '5_3.gif', 'gloves', '2', '23');
INSERT INTO `items` VALUES ('749', 'Gloves of Grip Lv24', 'Increases dexterity.', 'gloves', '0', '4', '65', '240', '40', '5_3.gif', 'gloves', '2', '24');
INSERT INTO `items` VALUES ('750', 'Gloves of Grip Lv25', 'Increases dexterity.', 'gloves', '0', '5', '65', '250', '40', '5_3.gif', 'gloves', '2', '25');
INSERT INTO `items` VALUES ('751', 'Gloves of Grip Lv26', 'Increases dexterity.', 'gloves', '0', '5', '75', '260', '50', '5_3.gif', 'gloves', '2', '26');
INSERT INTO `items` VALUES ('752', 'Gloves of Grip Lv27', 'Increases dexterity.', 'gloves', '0', '5', '75', '270', '50', '5_3.gif', 'gloves', '2', '27');
INSERT INTO `items` VALUES ('753', 'Gloves of Grip Lv28', 'Increases dexterity.', 'gloves', '0', '5', '75', '280', '50', '5_3.gif', 'gloves', '2', '28');
INSERT INTO `items` VALUES ('754', 'Gloves of Grip Lv29', 'Increases dexterity.', 'gloves', '0', '5', '75', '290', '50', '5_3.gif', 'gloves', '2', '29');
INSERT INTO `items` VALUES ('755', 'Gloves of Grip Lv30', 'Increases dexterity.', 'gloves', '0', '6', '75', '300', '50', '5_4.gif', 'gloves', '2', '30');
INSERT INTO `items` VALUES ('756', 'Gloves of Grip Lv31', 'Increases dexterity.', 'gloves', '0', '6', '85', '310', '60', '5_4.gif', 'gloves', '3', '31');
INSERT INTO `items` VALUES ('757', 'Gloves of Grip Lv32', 'Increases dexterity.', 'gloves', '0', '6', '85', '320', '60', '5_4.gif', 'gloves', '3', '32');
INSERT INTO `items` VALUES ('758', 'Gloves of Grip Lv33', 'Increases dexterity.', 'gloves', '0', '6', '85', '330', '60', '5_4.gif', 'gloves', '3', '33');
INSERT INTO `items` VALUES ('759', 'Gloves of Grip Lv34', 'Increases dexterity.', 'gloves', '0', '6', '85', '340', '60', '5_4.gif', 'gloves', '3', '34');
INSERT INTO `items` VALUES ('760', 'Gloves of Grip Lv35', 'Increases dexterity.', 'gloves', '0', '7', '85', '350', '60', '5_4.gif', 'gloves', '3', '35');
INSERT INTO `items` VALUES ('761', 'Gloves of Grip Lv36', 'Increases dexterity.', 'gloves', '0', '7', '95', '360', '70', '5_4.gif', 'gloves', '3', '36');
INSERT INTO `items` VALUES ('762', 'Gloves of Grip Lv37', 'Increases dexterity.', 'gloves', '0', '7', '95', '370', '70', '5_4.gif', 'gloves', '3', '37');
INSERT INTO `items` VALUES ('763', 'Gloves of Grip Lv38', 'Increases dexterity.', 'gloves', '0', '7', '95', '380', '70', '5_4.gif', 'gloves', '3', '38');
INSERT INTO `items` VALUES ('764', 'Gloves of Grip Lv39', 'Increases dexterity.', 'gloves', '0', '7', '95', '390', '70', '5_4.gif', 'gloves', '3', '39');
INSERT INTO `items` VALUES ('765', 'Gloves of Grip Lv40', 'Increases dexterity.', 'gloves', '0', '8', '95', '400', '70', '5_5.gif', 'gloves', '3', '40');
INSERT INTO `items` VALUES ('766', 'Gloves of Grip Lv41', 'Increases dexterity.', 'gloves', '0', '8', '105', '410', '80', '5_5.gif', 'gloves', '4', '41');
INSERT INTO `items` VALUES ('767', 'Gloves of Grip Lv42', 'Increases dexterity.', 'gloves', '0', '8', '105', '420', '80', '5_5.gif', 'gloves', '4', '42');
INSERT INTO `items` VALUES ('768', 'Gloves of Grip Lv43', 'Increases dexterity.', 'gloves', '0', '8', '105', '430', '80', '5_5.gif', 'gloves', '4', '43');
INSERT INTO `items` VALUES ('769', 'Gloves of Grip Lv44', 'Increases dexterity.', 'gloves', '0', '8', '105', '440', '80', '5_5.gif', 'gloves', '4', '44');
INSERT INTO `items` VALUES ('770', 'Gloves of Grip Lv45', 'Increases dexterity.', 'gloves', '0', '9', '105', '450', '80', '5_5.gif', 'gloves', '4', '45');
INSERT INTO `items` VALUES ('771', 'Gloves of Grip Lv46', 'Increases dexterity.', 'gloves', '0', '9', '115', '460', '90', '5_5.gif', 'gloves', '4', '46');
INSERT INTO `items` VALUES ('772', 'Gloves of Grip Lv47', 'Increases dexterity.', 'gloves', '0', '9', '115', '470', '90', '5_5.gif', 'gloves', '4', '47');
INSERT INTO `items` VALUES ('773', 'Gloves of Grip Lv48', 'Increases dexterity.', 'gloves', '0', '9', '115', '480', '90', '5_5.gif', 'gloves', '4', '48');
INSERT INTO `items` VALUES ('774', 'Gloves of Grip Lv49', 'Increases dexterity.', 'gloves', '0', '9', '115', '490', '90', '5_5.gif', 'gloves', '4', '49');
INSERT INTO `items` VALUES ('775', 'Gloves of Grip Lv50', 'Increases dexterity.', 'gloves', '0', '10', '115', '500', '90', '5_6.gif', 'gloves', '4', '50');
INSERT INTO `items` VALUES ('776', 'Elven Boots Lv51', 'Light and fast', 'boots', '0', '17', '10', '510', '6', '8_6.gif', 'boots', '3', '51');
INSERT INTO `items` VALUES ('777', 'Elven Boots Lv52', 'Light and fast', 'boots', '0', '17', '10', '520', '6', '8_6.gif', 'boots', '3', '52');
INSERT INTO `items` VALUES ('778', 'Elven Boots Lv53', 'Light and fast', 'boots', '0', '17', '10', '530', '6', '8_6.gif', 'boots', '3', '53');
INSERT INTO `items` VALUES ('779', 'Elven Boots Lv54', 'Light and fast', 'boots', '0', '18', '20', '540', '16', '8_6.gif', 'boots', '3', '54');
INSERT INTO `items` VALUES ('780', 'Elven Boots Lv55', 'Light and fast', 'boots', '0', '18', '20', '550', '16', '8_6.gif', 'boots', '3', '55');
INSERT INTO `items` VALUES ('781', 'Elven Boots Lv56', 'Light and fast', 'boots', '0', '18', '20', '560', '16', '8_6.gif', 'boots', '3', '56');
INSERT INTO `items` VALUES ('782', 'Elven Boots Lv57', 'Light and fast', 'boots', '0', '19', '30', '570', '26', '8_6.gif', 'boots', '3', '57');
INSERT INTO `items` VALUES ('783', 'Elven Boots Lv58', 'Light and fast', 'boots', '0', '19', '30', '580', '26', '8_6.gif', 'boots', '3', '58');
INSERT INTO `items` VALUES ('784', 'Elven Boots Lv59', 'Light and fast', 'boots', '0', '19', '30', '590', '26', '8_6.gif', 'boots', '3', '59');
INSERT INTO `items` VALUES ('785', 'Elven Boots Lv60', 'Light and fast', 'boots', '0', '20', '40', '600', '36', '8_8.gif', 'boots', '3', '60');
INSERT INTO `items` VALUES ('786', 'Elven Boots Lv61', 'Light and fast', 'boots', '0', '20', '40', '610', '36', '8_8.gif', 'boots', '4', '61');
INSERT INTO `items` VALUES ('787', 'Elven Boots Lv62', 'Light and fast', 'boots', '0', '20', '40', '620', '36', '8_8.gif', 'boots', '4', '62');
INSERT INTO `items` VALUES ('788', 'Elven Boots Lv63', 'Light and fast', 'boots', '0', '21', '50', '630', '46', '8_8.gif', 'boots', '4', '63');
INSERT INTO `items` VALUES ('789', 'Elven Boots Lv64', 'Light and fast', 'boots', '0', '21', '50', '640', '46', '8_8.gif', 'boots', '4', '64');
INSERT INTO `items` VALUES ('790', 'Elven Boots Lv65', 'Light and fast', 'boots', '0', '21', '50', '650', '46', '8_8.gif', 'boots', '4', '65');
INSERT INTO `items` VALUES ('791', 'Elven Boots Lv66', 'Light and fast', 'boots', '0', '22', '60', '660', '56', '8_8.gif', 'boots', '4', '66');
INSERT INTO `items` VALUES ('792', 'Elven Boots Lv67', 'Light and fast', 'boots', '0', '22', '60', '670', '56', '8_8.gif', 'boots', '4', '67');
INSERT INTO `items` VALUES ('793', 'Elven Boots Lv68', 'Light and fast', 'boots', '0', '22', '60', '680', '56', '8_8.gif', 'boots', '4', '68');
INSERT INTO `items` VALUES ('794', 'Elven Boots Lv69', 'Light and fast', 'boots', '0', '23', '70', '690', '66', '8_8.gif', 'boots', '4', '69');
INSERT INTO `items` VALUES ('795', 'Elven Boots Lv70', 'Light and fast', 'boots', '0', '23', '70', '700', '66', '8_10.gif', 'boots', '4', '70');
INSERT INTO `items` VALUES ('796', 'Elven Boots Lv71', 'Light and fast', 'boots', '0', '23', '70', '710', '66', '8_10.gif', 'boots', '5', '71');
INSERT INTO `items` VALUES ('797', 'Elven Boots Lv72', 'Light and fast', 'boots', '0', '24', '80', '720', '76', '8_10.gif', 'boots', '5', '72');
INSERT INTO `items` VALUES ('798', 'Elven Boots Lv73', 'Light and fast', 'boots', '0', '24', '80', '730', '76', '8_10.gif', 'boots', '5', '73');
INSERT INTO `items` VALUES ('799', 'Elven Boots Lv74', 'Light and fast', 'boots', '0', '24', '80', '740', '76', '8_10.gif', 'boots', '5', '74');
INSERT INTO `items` VALUES ('800', 'Elven Boots Lv75', 'Light and fast', 'boots', '0', '25', '90', '750', '86', '8_10.gif', 'boots', '5', '75');
INSERT INTO `items` VALUES ('801', 'Elven Boots Lv76', 'Light and fast', 'boots', '0', '25', '90', '760', '86', '8_10.gif', 'boots', '5', '76');
INSERT INTO `items` VALUES ('802', 'Elven Boots Lv77', 'Light and fast', 'boots', '0', '25', '90', '770', '86', '8_10.gif', 'boots', '5', '77');
INSERT INTO `items` VALUES ('803', 'Elven Boots Lv78', 'Light and fast', 'boots', '0', '26', '100', '780', '96', '8_10.gif', 'boots', '5', '78');
INSERT INTO `items` VALUES ('804', 'Elven Boots Lv79', 'Light and fast', 'boots', '0', '26', '100', '790', '96', '8_10.gif', 'boots', '5', '79');
INSERT INTO `items` VALUES ('805', 'Elven Boots Lv80', 'Light and fast', 'boots', '0', '26', '100', '800', '96', 'm8_3.png', 'boots', '5', '80');
INSERT INTO `items` VALUES ('806', 'Elven Boots Lv81', 'Light and fast', 'boots', '0', '27', '110', '810', '106', 'm8_3.png', 'boots', '6', '81');
INSERT INTO `items` VALUES ('807', 'Elven Boots Lv82', 'Light and fast', 'boots', '0', '27', '110', '820', '106', 'm8_3.png', 'boots', '6', '82');
INSERT INTO `items` VALUES ('808', 'Elven Boots Lv83', 'Light and fast', 'boots', '0', '27', '110', '830', '106', 'm8_3.png', 'boots', '6', '83');
INSERT INTO `items` VALUES ('809', 'Elven Boots Lv84', 'Light and fast', 'boots', '0', '28', '120', '840', '116', 'm8_3.png', 'boots', '6', '84');
INSERT INTO `items` VALUES ('810', 'Elven Boots Lv85', 'Light and fast', 'boots', '0', '28', '120', '850', '116', 'm8_3.png', 'boots', '6', '85');
INSERT INTO `items` VALUES ('811', 'Elven Boots Lv86', 'Light and fast', 'boots', '0', '28', '120', '860', '116', 'm8_3.png', 'boots', '6', '86');
INSERT INTO `items` VALUES ('812', 'Elven Boots Lv87', 'Light and fast', 'boots', '0', '29', '130', '870', '126', 'm8_3.png', 'boots', '6', '87');
INSERT INTO `items` VALUES ('813', 'Elven Boots Lv88', 'Light and fast', 'boots', '0', '29', '130', '880', '126', 'm8_3.png', 'boots', '6', '88');
INSERT INTO `items` VALUES ('814', 'Elven Boots Lv89', 'Light and fast', 'boots', '0', '29', '130', '890', '126', 'm8_3.png', 'boots', '6', '89');
INSERT INTO `items` VALUES ('815', 'Elven Boots Lv90', 'Light and fast', 'boots', '0', '30', '140', '900', '136', 'm8_5.png', 'boots', '6', '90');
INSERT INTO `items` VALUES ('816', 'Elven Boots Lv91', 'Light and fast', 'boots', '0', '30', '140', '910', '136', 'm8_5.png', 'boots', '7', '91');
INSERT INTO `items` VALUES ('817', 'Elven Boots Lv92', 'Light and fast', 'boots', '0', '30', '140', '920', '136', 'm8_5.png', 'boots', '7', '92');
INSERT INTO `items` VALUES ('818', 'Elven Boots Lv93', 'Light and fast', 'boots', '0', '31', '150', '930', '146', 'm8_5.png', 'boots', '7', '93');
INSERT INTO `items` VALUES ('819', 'Elven Boots Lv94', 'Light and fast', 'boots', '0', '31', '150', '940', '146', 'm8_5.png', 'boots', '7', '94');
INSERT INTO `items` VALUES ('820', 'Elven Boots Lv95', 'Light and fast', 'boots', '0', '31', '150', '950', '146', 'm8_5.png', 'boots', '7', '95');
INSERT INTO `items` VALUES ('821', 'Elven Boots Lv96', 'Light and fast', 'boots', '0', '32', '160', '960', '156', 'm8_5.png', 'boots', '7', '96');
INSERT INTO `items` VALUES ('822', 'Elven Boots Lv97', 'Light and fast', 'boots', '0', '32', '160', '970', '156', 'm8_5.png', 'boots', '7', '97');
INSERT INTO `items` VALUES ('823', 'Elven Boots Lv98', 'Light and fast', 'boots', '0', '32', '160', '980', '156', 'm8_5.png', 'boots', '7', '98');
INSERT INTO `items` VALUES ('824', 'Elven Boots Lv99', 'Light and fast', 'boots', '0', '33', '170', '990', '166', 'm8_5.png', 'boots', '7', '99');
INSERT INTO `items` VALUES ('825', 'Elven Boots Lv100', 'Light and fast', 'boots', '0', '33', '170', '1000', '166', '8_9.gif', 'boots', '7', '100');
INSERT INTO `items` VALUES ('826', 'Iron Helm Lv51', 'Protects your head', 'helm', '0', '19', '10', '510', '5', 'm4_10.png', 'helm', '0', '51');
INSERT INTO `items` VALUES ('827', 'Iron Helm Lv52', 'Protects your head', 'helm', '0', '19', '10', '520', '5', 'm4_10.png', 'helm', '0', '52');
INSERT INTO `items` VALUES ('828', 'Iron Helm Lv53', 'Protects your head', 'helm', '0', '19', '10', '530', '5', 'm4_10.png', 'helm', '0', '53');
INSERT INTO `items` VALUES ('829', 'Iron Helm Lv54', 'Protects your head', 'helm', '0', '20', '20', '540', '15', 'm4_10.png', 'helm', '0', '54');
INSERT INTO `items` VALUES ('830', 'Iron Helm Lv55', 'Protects your head', 'helm', '0', '20', '20', '550', '15', 'm4_10.png', 'helm', '0', '55');
INSERT INTO `items` VALUES ('831', 'Iron Helm Lv56', 'Protects your head', 'helm', '0', '20', '20', '560', '15', 'm4_10.png', 'helm', '0', '56');
INSERT INTO `items` VALUES ('832', 'Iron Helm Lv57', 'Protects your head', 'helm', '0', '21', '30', '570', '25', 'm4_10.png', 'helm', '0', '57');
INSERT INTO `items` VALUES ('833', 'Iron Helm Lv58', 'Protects your head', 'helm', '0', '21', '30', '580', '25', 'm4_10.png', 'helm', '0', '58');
INSERT INTO `items` VALUES ('834', 'Iron Helm Lv59', 'Protects your head', 'helm', '0', '21', '30', '590', '25', 'm4_10.png', 'helm', '0', '59');
INSERT INTO `items` VALUES ('835', 'Iron Helm Lv60', 'Protects your head', 'helm', '0', '22', '40', '600', '35', 'm4_10.png', 'helm', '0', '60');
INSERT INTO `items` VALUES ('836', 'Iron Helm Lv61', 'Protects your head', 'helm', '0', '22', '40', '610', '35', 'm4_10.png', 'helm', '0', '61');
INSERT INTO `items` VALUES ('837', 'Iron Helm Lv62', 'Protects your head', 'helm', '0', '22', '40', '620', '35', 'm4_10.png', 'helm', '0', '62');
INSERT INTO `items` VALUES ('838', 'Iron Helm Lv63', 'Protects your head', 'helm', '0', '23', '50', '630', '45', 'm4_10.png', 'helm', '0', '63');
INSERT INTO `items` VALUES ('839', 'Iron Helm Lv64', 'Protects your head', 'helm', '0', '23', '50', '640', '45', 'm4_10.png', 'helm', '0', '64');
INSERT INTO `items` VALUES ('840', 'Iron Helm Lv65', 'Protects your head', 'helm', '0', '23', '50', '650', '45', 'm4_10.png', 'helm', '0', '65');
INSERT INTO `items` VALUES ('841', 'Iron Helm Lv66', 'Protects your head', 'helm', '0', '24', '60', '660', '55', 'm4_10.png', 'helm', '0', '66');
INSERT INTO `items` VALUES ('842', 'Iron Helm Lv67', 'Protects your head', 'helm', '0', '24', '60', '670', '55', 'm4_10.png', 'helm', '0', '67');
INSERT INTO `items` VALUES ('843', 'Iron Helm Lv68', 'Protects your head', 'helm', '0', '24', '60', '680', '55', 'm4_10.png', 'helm', '0', '68');
INSERT INTO `items` VALUES ('844', 'Iron Helm Lv69', 'Protects your head', 'helm', '0', '25', '70', '690', '65', 'm4_10.png', 'helm', '0', '69');
INSERT INTO `items` VALUES ('845', 'Iron Helm Lv70', 'Protects your head', 'helm', '0', '25', '70', '700', '65', 'm4_10.png', 'helm', '0', '70');
INSERT INTO `items` VALUES ('846', 'Iron Helm Lv71', 'Protects your head', 'helm', '0', '25', '70', '710', '65', 'm4_10.png', 'helm', '0', '71');
INSERT INTO `items` VALUES ('847', 'Iron Helm Lv72', 'Protects your head', 'helm', '0', '26', '80', '720', '75', 'm4_10.png', 'helm', '0', '72');
INSERT INTO `items` VALUES ('848', 'Iron Helm Lv73', 'Protects your head', 'helm', '0', '26', '80', '730', '75', 'm4_10.png', 'helm', '0', '73');
INSERT INTO `items` VALUES ('849', 'Iron Helm Lv74', 'Protects your head', 'helm', '0', '26', '80', '740', '75', 'm4_10.png', 'helm', '0', '74');
INSERT INTO `items` VALUES ('850', 'Iron Helm Lv75', 'Protects your head', 'helm', '0', '27', '90', '750', '85', 'm4_10.png', 'helm', '0', '75');
INSERT INTO `items` VALUES ('851', 'Iron Helm Lv76', 'Protects your head', 'helm', '0', '27', '90', '760', '85', 'm4_10.png', 'helm', '0', '76');
INSERT INTO `items` VALUES ('852', 'Iron Helm Lv77', 'Protects your head', 'helm', '0', '27', '90', '770', '85', 'm4_10.png', 'helm', '0', '77');
INSERT INTO `items` VALUES ('853', 'Iron Helm Lv78', 'Protects your head', 'helm', '0', '28', '100', '780', '95', 'm4_10.png', 'helm', '0', '78');
INSERT INTO `items` VALUES ('854', 'Iron Helm Lv79', 'Protects your head', 'helm', '0', '28', '100', '790', '95', 'm4_10.png', 'helm', '0', '79');
INSERT INTO `items` VALUES ('855', 'Iron Helm Lv80', 'Protects your head', 'helm', '0', '28', '100', '800', '95', 'm4_10.png', 'helm', '0', '80');
INSERT INTO `items` VALUES ('856', 'Iron Helm Lv81', 'Protects your head', 'helm', '0', '29', '110', '810', '105', 'm4_10.png', 'helm', '0', '81');
INSERT INTO `items` VALUES ('857', 'Iron Helm Lv82', 'Protects your head', 'helm', '0', '29', '110', '820', '105', 'm4_10.png', 'helm', '0', '82');
INSERT INTO `items` VALUES ('858', 'Iron Helm Lv83', 'Protects your head', 'helm', '0', '29', '110', '830', '105', 'm4_10.png', 'helm', '0', '83');
INSERT INTO `items` VALUES ('859', 'Iron Helm Lv84', 'Protects your head', 'helm', '0', '30', '120', '840', '115', 'm4_10.png', 'helm', '0', '84');
INSERT INTO `items` VALUES ('860', 'Iron Helm Lv85', 'Protects your head', 'helm', '0', '30', '120', '850', '115', 'm4_10.png', 'helm', '0', '85');
INSERT INTO `items` VALUES ('861', 'Iron Helm Lv86', 'Protects your head', 'helm', '0', '30', '120', '860', '115', 'm4_10.png', 'helm', '0', '86');
INSERT INTO `items` VALUES ('862', 'Iron Helm Lv87', 'Protects your head', 'helm', '0', '31', '130', '870', '125', 'm4_10.png', 'helm', '0', '87');
INSERT INTO `items` VALUES ('863', 'Iron Helm Lv88', 'Protects your head', 'helm', '0', '31', '130', '880', '125', 'm4_10.png', 'helm', '0', '88');
INSERT INTO `items` VALUES ('864', 'Iron Helm Lv89', 'Protects your head', 'helm', '0', '31', '130', '890', '125', 'm4_10.png', 'helm', '0', '89');
INSERT INTO `items` VALUES ('865', 'Iron Helm Lv90', 'Protects your head', 'helm', '0', '32', '140', '900', '135', 'm4_10.png', 'helm', '0', '90');
INSERT INTO `items` VALUES ('866', 'Iron Helm Lv91', 'Protects your head', 'helm', '0', '32', '140', '910', '135', 'm4_10.png', 'helm', '0', '91');
INSERT INTO `items` VALUES ('867', 'Iron Helm Lv92', 'Protects your head', 'helm', '0', '32', '140', '920', '135', 'm4_10.png', 'helm', '0', '92');
INSERT INTO `items` VALUES ('868', 'Iron Helm Lv93', 'Protects your head', 'helm', '0', '33', '150', '930', '145', 'm4_10.png', 'helm', '0', '93');
INSERT INTO `items` VALUES ('869', 'Iron Helm Lv94', 'Protects your head', 'helm', '0', '33', '150', '940', '145', 'm4_10.png', 'helm', '0', '94');
INSERT INTO `items` VALUES ('870', 'Iron Helm Lv95', 'Protects your head', 'helm', '0', '33', '150', '950', '145', 'm4_10.png', 'helm', '0', '95');
INSERT INTO `items` VALUES ('871', 'Iron Helm Lv96', 'Protects your head', 'helm', '0', '34', '160', '960', '155', 'm4_10.png', 'helm', '0', '96');
INSERT INTO `items` VALUES ('872', 'Iron Helm Lv97', 'Protects your head', 'helm', '0', '34', '160', '970', '155', 'm4_10.png', 'helm', '0', '97');
INSERT INTO `items` VALUES ('873', 'Iron Helm Lv98', 'Protects your head', 'helm', '0', '34', '160', '980', '155', 'm4_10.png', 'helm', '0', '98');
INSERT INTO `items` VALUES ('874', 'Iron Helm Lv99', 'Protects your head', 'helm', '0', '35', '170', '990', '165', 'm4_10.png', 'helm', '0', '99');
INSERT INTO `items` VALUES ('875', 'Iron Helm Lv100', 'Protects your head', 'helm', '0', '35', '170', '1000', '165', 'm4_12.png', 'helm', '0', '100');
INSERT INTO `items` VALUES ('876', 'Leather Gloves Lv51', 'Basic hand protection', 'gloves', '0', '18', '10', '510', '3', '5_6.gif', 'gloves', '1', '51');
INSERT INTO `items` VALUES ('877', 'Leather Gloves Lv52', 'Basic hand protection', 'gloves', '0', '18', '10', '520', '3', '5_6.gif', 'gloves', '1', '52');
INSERT INTO `items` VALUES ('878', 'Leather Gloves Lv53', 'Basic hand protection', 'gloves', '0', '18', '10', '530', '3', '5_6.gif', 'gloves', '1', '53');
INSERT INTO `items` VALUES ('879', 'Leather Gloves Lv54', 'Basic hand protection', 'gloves', '0', '19', '20', '540', '13', '5_6.gif', 'gloves', '1', '54');
INSERT INTO `items` VALUES ('880', 'Leather Gloves Lv55', 'Basic hand protection', 'gloves', '0', '19', '20', '550', '13', '5_6.gif', 'gloves', '1', '55');
INSERT INTO `items` VALUES ('881', 'Leather Gloves Lv56', 'Basic hand protection', 'gloves', '0', '19', '20', '560', '13', '5_6.gif', 'gloves', '1', '56');
INSERT INTO `items` VALUES ('882', 'Leather Gloves Lv57', 'Basic hand protection', 'gloves', '0', '20', '30', '570', '23', '5_6.gif', 'gloves', '1', '57');
INSERT INTO `items` VALUES ('883', 'Leather Gloves Lv58', 'Basic hand protection', 'gloves', '0', '20', '30', '580', '23', '5_6.gif', 'gloves', '1', '58');
INSERT INTO `items` VALUES ('884', 'Leather Gloves Lv59', 'Basic hand protection', 'gloves', '0', '20', '30', '590', '23', '5_6.gif', 'gloves', '1', '59');
INSERT INTO `items` VALUES ('885', 'Leather Gloves Lv60', 'Basic hand protection', 'gloves', '0', '21', '40', '600', '33', '5_7.gif', 'gloves', '1', '60');
INSERT INTO `items` VALUES ('886', 'Leather Gloves Lv61', 'Basic hand protection', 'gloves', '0', '21', '40', '610', '33', '5_7.gif', 'gloves', '1', '61');
INSERT INTO `items` VALUES ('887', 'Leather Gloves Lv62', 'Basic hand protection', 'gloves', '0', '21', '40', '620', '33', '5_7.gif', 'gloves', '1', '62');
INSERT INTO `items` VALUES ('888', 'Leather Gloves Lv63', 'Basic hand protection', 'gloves', '0', '22', '50', '630', '43', '5_7.gif', 'gloves', '1', '63');
INSERT INTO `items` VALUES ('889', 'Leather Gloves Lv64', 'Basic hand protection', 'gloves', '0', '22', '50', '640', '43', '5_7.gif', 'gloves', '1', '64');
INSERT INTO `items` VALUES ('890', 'Leather Gloves Lv65', 'Basic hand protection', 'gloves', '0', '22', '50', '650', '43', '5_7.gif', 'gloves', '1', '65');
INSERT INTO `items` VALUES ('891', 'Leather Gloves Lv66', 'Basic hand protection', 'gloves', '0', '23', '60', '660', '53', '5_7.gif', 'gloves', '1', '66');
INSERT INTO `items` VALUES ('892', 'Leather Gloves Lv67', 'Basic hand protection', 'gloves', '0', '23', '60', '670', '53', '5_7.gif', 'gloves', '1', '67');
INSERT INTO `items` VALUES ('893', 'Leather Gloves Lv68', 'Basic hand protection', 'gloves', '0', '23', '60', '680', '53', '5_7.gif', 'gloves', '1', '68');
INSERT INTO `items` VALUES ('894', 'Leather Gloves Lv69', 'Basic hand protection', 'gloves', '0', '24', '70', '690', '63', '5_7.gif', 'gloves', '1', '69');
INSERT INTO `items` VALUES ('895', 'Leather Gloves Lv70', 'Basic hand protection', 'gloves', '0', '24', '70', '700', '63', '5_8.gif', 'gloves', '1', '70');
INSERT INTO `items` VALUES ('896', 'Leather Gloves Lv71', 'Basic hand protection', 'gloves', '0', '24', '70', '710', '63', '5_8.gif', 'gloves', '1', '71');
INSERT INTO `items` VALUES ('897', 'Leather Gloves Lv72', 'Basic hand protection', 'gloves', '0', '25', '80', '720', '73', '5_8.gif', 'gloves', '1', '72');
INSERT INTO `items` VALUES ('898', 'Leather Gloves Lv73', 'Basic hand protection', 'gloves', '0', '25', '80', '730', '73', '5_8.gif', 'gloves', '1', '73');
INSERT INTO `items` VALUES ('899', 'Leather Gloves Lv74', 'Basic hand protection', 'gloves', '0', '25', '80', '740', '73', '5_8.gif', 'gloves', '1', '74');
INSERT INTO `items` VALUES ('900', 'Leather Gloves Lv75', 'Basic hand protection', 'gloves', '0', '26', '90', '750', '83', '5_8.gif', 'gloves', '1', '75');
INSERT INTO `items` VALUES ('901', 'Leather Gloves Lv76', 'Basic hand protection', 'gloves', '0', '26', '90', '7650', '83', '5_8.gif', 'gloves', '1', '76');
INSERT INTO `items` VALUES ('902', 'Leather Gloves Lv77', 'Basic hand protection', 'gloves', '0', '26', '90', '770', '83', '5_8.gif', 'gloves', '1', '77');
INSERT INTO `items` VALUES ('903', 'Leather Gloves Lv78', 'Basic hand protection', 'gloves', '0', '27', '100', '780', '93', '5_8.gif', 'gloves', '1', '78');
INSERT INTO `items` VALUES ('904', 'Leather Gloves Lv79', 'Basic hand protection', 'gloves', '0', '27', '100', '790', '93', '5_8.gif', 'gloves', '1', '79');
INSERT INTO `items` VALUES ('905', 'Leather Gloves Lv80', 'Basic hand protection', 'gloves', '0', '27', '100', '800', '93', '5_9.gif', 'gloves', '1', '80');
INSERT INTO `items` VALUES ('906', 'Leather Gloves Lv81', 'Basic hand protection', 'gloves', '0', '28', '110', '810', '103', '5_9.gif', 'gloves', '1', '81');
INSERT INTO `items` VALUES ('907', 'Leather Gloves Lv82', 'Basic hand protection', 'gloves', '0', '28', '110', '820', '103', '5_9.gif', 'gloves', '1', '82');
INSERT INTO `items` VALUES ('908', 'Leather Gloves Lv83', 'Basic hand protection', 'gloves', '0', '28', '110', '830', '103', '5_9.gif', 'gloves', '1', '83');
INSERT INTO `items` VALUES ('909', 'Leather Gloves Lv84', 'Basic hand protection', 'gloves', '0', '29', '120', '840', '113', '5_9.gif', 'gloves', '1', '84');
INSERT INTO `items` VALUES ('910', 'Leather Gloves Lv85', 'Basic hand protection', 'gloves', '0', '29', '120', '850', '113', '5_9.gif', 'gloves', '1', '85');
INSERT INTO `items` VALUES ('911', 'Leather Gloves Lv86', 'Basic hand protection', 'gloves', '0', '29', '120', '860', '113', '5_9.gif', 'gloves', '1', '86');
INSERT INTO `items` VALUES ('912', 'Leather Gloves Lv87', 'Basic hand protection', 'gloves', '0', '30', '130', '870', '123', '5_9.gif', 'gloves', '1', '87');
INSERT INTO `items` VALUES ('913', 'Leather Gloves Lv88', 'Basic hand protection', 'gloves', '0', '30', '130', '880', '123', '5_9.gif', 'gloves', '1', '88');
INSERT INTO `items` VALUES ('914', 'Leather Gloves Lv89', 'Basic hand protection', 'gloves', '0', '30', '130', '890', '123', '5_9.gif', 'gloves', '1', '89');
INSERT INTO `items` VALUES ('915', 'Leather Gloves Lv90', 'Basic hand protection', 'gloves', '0', '31', '140', '900', '133', '5_9.gif', 'gloves', '1', '90');
INSERT INTO `items` VALUES ('916', 'Leather Gloves Lv91', 'Basic hand protection', 'gloves', '0', '31', '140', '910', '133', '5_9.gif', 'gloves', '1', '91');
INSERT INTO `items` VALUES ('917', 'Leather Gloves Lv92', 'Basic hand protection', 'gloves', '0', '31', '140', '920', '133', '5_9.gif', 'gloves', '1', '92');
INSERT INTO `items` VALUES ('918', 'Leather Gloves Lv93', 'Basic hand protection', 'gloves', '0', '32', '150', '930', '143', '5_9.gif', 'gloves', '1', '93');
INSERT INTO `items` VALUES ('919', 'Leather Gloves Lv94', 'Basic hand protection', 'gloves', '0', '32', '150', '940', '143', '5_9.gif', 'gloves', '1', '94');
INSERT INTO `items` VALUES ('920', 'Leather Gloves Lv95', 'Basic hand protection', 'gloves', '0', '32', '150', '950', '143', '5_9.gif', 'gloves', '1', '95');
INSERT INTO `items` VALUES ('921', 'Leather Gloves Lv96', 'Basic hand protection', 'gloves', '0', '33', '160', '960', '153', '5_9.gif', 'gloves', '1', '96');
INSERT INTO `items` VALUES ('922', 'Leather Gloves Lv97', 'Basic hand protection', 'gloves', '0', '33', '160', '970', '153', '5_9.gif', 'gloves', '1', '97');
INSERT INTO `items` VALUES ('923', 'Leather Gloves Lv98', 'Basic hand protection', 'gloves', '0', '33', '160', '980', '153', '5_9.gif', 'gloves', '1', '98');
INSERT INTO `items` VALUES ('924', 'Leather Gloves Lv99', 'Basic hand protection', 'gloves', '0', '34', '170', '990', '163', '5_9.gif', 'gloves', '1', '99');
INSERT INTO `items` VALUES ('925', 'Leather Gloves Lv100', 'Basic hand protection', 'gloves', '0', '34', '170', '100', '163', '5_9.gif', 'gloves', '1', '100');
INSERT INTO `items` VALUES ('926', 'Santa\'s Hat', 'Christmas Hat', 'helm', '10', '10', '100', '10000', '10000', 'Santa\'s_Hat.png', 'helm', '1', '1');
INSERT INTO `items` VALUES ('927', 'Frost Blade', 'Christmas Weapon', 'weapon', '20', '0', '100', '10000', '10000', 'Frost_Blade.png', 'weapon', '0', '1');
INSERT INTO `items` VALUES ('928', 'Reindeer Amulet', 'Christmas Amulet', 'necklace', '10', '10', '10', '10000', '10000', 'Reindeer_Amulet.png', 'necklace', '10', '1');
INSERT INTO `items` VALUES ('929', 'Witch\'s Broom', 'Halloween', 'weapon', '5', '20', '100', '10000', '10000', 'Witch\'s_Broom.png', 'weapon', '0', '1');
INSERT INTO `items` VALUES ('930', 'Pumpkin Helm', 'Halloween', 'helm', '0', '20', '100', '10000', '10000', 'Pumpkin_Helm.png', 'helm', '0', '1');
INSERT INTO `items` VALUES ('931', 'Ghost Cloak', 'Halloween', 'armor', '0', '20', '100', '10000', '10000', 'Ghost_Cloak.png', 'armor', '3', '1');

-- ----------------------------
-- Table structure for `mensajes`
-- ----------------------------
DROP TABLE IF EXISTS `mensajes`;
CREATE TABLE `mensajes` (
  `id_msj` int(11) NOT NULL AUTO_INCREMENT,
  `id_user_r` varchar(24) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `login_user_r` varchar(24) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `id_user_s` int(11) NOT NULL,
  `login_user_s` varchar(24) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `mensaje` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `report` int(11) NOT NULL DEFAULT '0',
  `leido` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_msj`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mensajes
-- ----------------------------
INSERT INTO `mensajes` VALUES ('3', '8', 'test4', '3', '0', 'ddfdsf', '2025-05-17 16:12:53', '0', '0');
INSERT INTO `mensajes` VALUES ('10', '8', 'test4', '3', 'tolis', 'hi', '2025-05-18 00:59:46', '0', '1');
INSERT INTO `mensajes` VALUES ('8', '8', 'test4', '3', 'tolis', 'hi olll', '2025-05-17 17:09:36', '0', '0');
INSERT INTO `mensajes` VALUES ('9', '8', 'test4', '3', 'tolis', 'fsdfsd', '2025-05-18 00:38:04', '0', '0');
INSERT INTO `mensajes` VALUES ('11', '3', 'tolis', '8', 'test4', 'hi all', '2025-05-18 01:00:58', '0', '0');

-- ----------------------------
-- Table structure for `news`
-- ----------------------------
DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `titul` varchar(24) NOT NULL,
  `tekst` text NOT NULL,
  `autor` varchar(24) NOT NULL,
  `link` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `obrazek` varchar(40) CHARACTER SET utf8 NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of news
-- ----------------------------

-- ----------------------------
-- Table structure for `notifications`
-- ----------------------------
DROP TABLE IF EXISTS `notifications`;
CREATE TABLE `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `player_id` int(11) NOT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `seen` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of notifications
-- ----------------------------

-- ----------------------------
-- Table structure for `players`
-- ----------------------------
DROP TABLE IF EXISTS `players`;
CREATE TABLE `players` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `strength` int(11) DEFAULT '10',
  `defense` int(11) DEFAULT '10',
  `hp` int(11) DEFAULT '100',
  `gold` int(11) DEFAULT '0',
  `experience` int(11) DEFAULT '0',
  `level` int(11) DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of players
-- ----------------------------
INSERT INTO `players` VALUES ('1', '3', 'Tolis', '10', '10', '100', null, null, '1', '2025-05-15 15:42:11');

-- ----------------------------
-- Table structure for `player_items`
-- ----------------------------
DROP TABLE IF EXISTS `player_items`;
CREATE TABLE `player_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `player_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1',
  `equipped` tinyint(1) NOT NULL DEFAULT '0',
  `position` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `player_id` (`player_id`),
  KEY `item_id` (`item_id`),
  CONSTRAINT `player_items_ibfk_1` FOREIGN KEY (`player_id`) REFERENCES `gracze` (`id`),
  CONSTRAINT `player_items_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=150 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of player_items
-- ----------------------------
INSERT INTO `player_items` VALUES ('2', '3', '1', '1', '0', '0');
INSERT INTO `player_items` VALUES ('3', '3', '1', '1', '0', '0');
INSERT INTO `player_items` VALUES ('4', '3', '1', '1', '0', '0');
INSERT INTO `player_items` VALUES ('5', '3', '1', '1', '1', '0');
INSERT INTO `player_items` VALUES ('6', '3', '2', '1', '1', '0');
INSERT INTO `player_items` VALUES ('7', '3', '2', '1', '0', '0');
INSERT INTO `player_items` VALUES ('8', '3', '10', '1', '0', '0');
INSERT INTO `player_items` VALUES ('9', '3', '8', '1', '0', '0');
INSERT INTO `player_items` VALUES ('10', '3', '11', '1', '1', '0');
INSERT INTO `player_items` VALUES ('11', '3', '10', '1', '1', '0');
INSERT INTO `player_items` VALUES ('13', '6', '2', '1', '1', '0');
INSERT INTO `player_items` VALUES ('17', '8', '1', '1', '1', '0');
INSERT INTO `player_items` VALUES ('18', '8', '2', '1', '0', '0');
INSERT INTO `player_items` VALUES ('19', '8', '8', '1', '0', '0');
INSERT INTO `player_items` VALUES ('20', '8', '10', '1', '1', '0');
INSERT INTO `player_items` VALUES ('21', '7', '1', '1', '0', '0');
INSERT INTO `player_items` VALUES ('22', '7', '2', '1', '0', '0');
INSERT INTO `player_items` VALUES ('23', '7', '3', '1', '1', '0');
INSERT INTO `player_items` VALUES ('26', '6', '10', '1', '0', '0');
INSERT INTO `player_items` VALUES ('31', '6', '11', '1', '1', '0');
INSERT INTO `player_items` VALUES ('41', '6', '108', '1', '0', '0');
INSERT INTO `player_items` VALUES ('47', '6', '604', '1', '0', '0');
INSERT INTO `player_items` VALUES ('50', '6', '818', '1', '0', '0');
INSERT INTO `player_items` VALUES ('51', '6', '896', '1', '0', '0');
INSERT INTO `player_items` VALUES ('62', '6', '872', '1', '0', '0');
INSERT INTO `player_items` VALUES ('80', '6', '367', '1', '0', '0');
INSERT INTO `player_items` VALUES ('105', '6', '474', '1', '0', '0');
INSERT INTO `player_items` VALUES ('110', '6', '474', '1', '0', '0');
INSERT INTO `player_items` VALUES ('111', '7', '25', '1', '0', '0');
INSERT INTO `player_items` VALUES ('112', '7', '25', '1', '0', '0');
INSERT INTO `player_items` VALUES ('113', '7', '25', '1', '0', '0');
INSERT INTO `player_items` VALUES ('121', '6', '600', '1', '0', '0');
INSERT INTO `player_items` VALUES ('122', '6', '567', '1', '0', '0');
INSERT INTO `player_items` VALUES ('123', '6', '567', '1', '0', '0');
INSERT INTO `player_items` VALUES ('124', '6', '15', '1', '0', '0');
INSERT INTO `player_items` VALUES ('125', '6', '219', '1', '0', '0');
INSERT INTO `player_items` VALUES ('126', '6', '60', '1', '0', '0');
INSERT INTO `player_items` VALUES ('127', '6', '60', '1', '1', '0');
INSERT INTO `player_items` VALUES ('128', '6', '516', '1', '1', '0');
INSERT INTO `player_items` VALUES ('129', '6', '516', '1', '0', '0');
INSERT INTO `player_items` VALUES ('130', '6', '516', '1', '0', '0');
INSERT INTO `player_items` VALUES ('131', '6', '542', '1', '0', '0');
INSERT INTO `player_items` VALUES ('132', '6', '542', '1', '0', '0');
INSERT INTO `player_items` VALUES ('133', '6', '372', '1', '0', '0');
INSERT INTO `player_items` VALUES ('134', '6', '103', '1', '0', '0');
INSERT INTO `player_items` VALUES ('135', '6', '103', '1', '0', '0');
INSERT INTO `player_items` VALUES ('136', '6', '103', '1', '0', '0');
INSERT INTO `player_items` VALUES ('139', '7', '10', '1', '0', '0');
INSERT INTO `player_items` VALUES ('140', '7', '27', '1', '0', '0');
INSERT INTO `player_items` VALUES ('141', '7', '31', '1', '0', '0');
INSERT INTO `player_items` VALUES ('142', '7', '3', '1', '0', '0');
INSERT INTO `player_items` VALUES ('143', '7', '11', '1', '0', '0');
INSERT INTO `player_items` VALUES ('144', '7', '121', '1', '1', '0');
INSERT INTO `player_items` VALUES ('145', '7', '121', '1', '0', '0');
INSERT INTO `player_items` VALUES ('146', '6', '929', '1', '0', '0');
INSERT INTO `player_items` VALUES ('147', '6', '929', '1', '0', '0');
INSERT INTO `player_items` VALUES ('148', '6', '931', '1', '0', '0');
INSERT INTO `player_items` VALUES ('149', '3', '626', '1', '1', '0');

-- ----------------------------
-- Table structure for `player_quests`
-- ----------------------------
DROP TABLE IF EXISTS `player_quests`;
CREATE TABLE `player_quests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `player_id` int(11) NOT NULL,
  `quest_id` int(11) NOT NULL,
  `status` enum('active','completed') NOT NULL DEFAULT 'active',
  PRIMARY KEY (`id`),
  KEY `player_id` (`player_id`),
  KEY `quest_id` (`quest_id`),
  CONSTRAINT `player_quests_ibfk_1` FOREIGN KEY (`player_id`) REFERENCES `gracze` (`id`) ON DELETE CASCADE,
  CONSTRAINT `player_quests_ibfk_2` FOREIGN KEY (`quest_id`) REFERENCES `quests` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of player_quests
-- ----------------------------
INSERT INTO `player_quests` VALUES ('1', '3', '1', 'completed');
INSERT INTO `player_quests` VALUES ('2', '3', '2', 'completed');
INSERT INTO `player_quests` VALUES ('3', '6', '1', 'completed');

-- ----------------------------
-- Table structure for `player_skills`
-- ----------------------------
DROP TABLE IF EXISTS `player_skills`;
CREATE TABLE `player_skills` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `player_id` int(11) NOT NULL,
  `skill_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `player_id` (`player_id`),
  KEY `skill_id` (`skill_id`),
  CONSTRAINT `player_skills_ibfk_1` FOREIGN KEY (`player_id`) REFERENCES `gracze` (`id`),
  CONSTRAINT `player_skills_ibfk_2` FOREIGN KEY (`skill_id`) REFERENCES `skills` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of player_skills
-- ----------------------------
INSERT INTO `player_skills` VALUES ('1', '3', '1');
INSERT INTO `player_skills` VALUES ('2', '3', '2');

-- ----------------------------
-- Table structure for `player_skill_cooldowns`
-- ----------------------------
DROP TABLE IF EXISTS `player_skill_cooldowns`;
CREATE TABLE `player_skill_cooldowns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `player_id` int(11) NOT NULL,
  `skill_id` int(11) NOT NULL,
  `cooldown_until` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `player_id` (`player_id`),
  KEY `skill_id` (`skill_id`),
  CONSTRAINT `player_skill_cooldowns_ibfk_1` FOREIGN KEY (`player_id`) REFERENCES `gracze` (`id`),
  CONSTRAINT `player_skill_cooldowns_ibfk_2` FOREIGN KEY (`skill_id`) REFERENCES `skills` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of player_skill_cooldowns
-- ----------------------------

-- ----------------------------
-- Table structure for `potwory`
-- ----------------------------
DROP TABLE IF EXISTS `potwory`;
CREATE TABLE `potwory` (
  `potwor` int(11) NOT NULL AUTO_INCREMENT,
  `nazwa` text COLLATE utf8_polish_ci NOT NULL,
  `typ` varchar(12) COLLATE utf8_polish_ci NOT NULL,
  `obrazek` text COLLATE utf8_polish_ci NOT NULL,
  `atak` int(11) NOT NULL,
  `atak_max` int(11) NOT NULL,
  `obrona` int(11) NOT NULL,
  `obrona_max` int(11) NOT NULL,
  `sila` int(1) NOT NULL,
  `sila_max` int(1) NOT NULL,
  `zrecznosc` int(1) NOT NULL,
  `zrecznosc_max` int(1) NOT NULL,
  `wyrzymalosc` int(1) NOT NULL,
  `wyrzymalosc_max` int(1) NOT NULL,
  `constitucion` int(1) NOT NULL,
  `constitucion_max` int(1) NOT NULL,
  `carisma` int(1) NOT NULL,
  `carisma_max` int(1) NOT NULL,
  `inteligencja` int(1) NOT NULL,
  `inteligencja_max` int(1) NOT NULL,
  `mdchance` int(1) NOT NULL DEFAULT '0',
  `mdchance_max` int(1) NOT NULL DEFAULT '0',
  `dhchance` int(1) NOT NULL DEFAULT '0',
  `dhchance_max` int(1) NOT NULL DEFAULT '0',
  `ctchance` int(1) NOT NULL DEFAULT '0',
  `ctchance_max` int(1) NOT NULL DEFAULT '0',
  `zycie` int(11) NOT NULL,
  `zycie_max` int(11) NOT NULL,
  `obrazenia_min` int(11) NOT NULL,
  `obrazenia_min_max` int(11) NOT NULL,
  `obrazenia_max` int(11) NOT NULL,
  `obrazenia_max_max` int(11) NOT NULL,
  `exp` int(11) NOT NULL,
  `exp_max` int(11) NOT NULL,
  `oro_min` int(11) NOT NULL,
  `oro_max` int(11) NOT NULL,
  `rubies` int(11) NOT NULL,
  `chance_rubies_1` int(11) NOT NULL,
  `chance_rubies_2` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `map` varchar(12) COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`potwor`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- ----------------------------
-- Records of potwory
-- ----------------------------

-- ----------------------------
-- Table structure for `przedmioty`
-- ----------------------------
DROP TABLE IF EXISTS `przedmioty`;
CREATE TABLE `przedmioty` (
  `przedmiot` int(11) NOT NULL AUTO_INCREMENT,
  `nazwa` text COLLATE utf8_polish_ci NOT NULL,
  `typ` varchar(24) COLLATE utf8_polish_ci NOT NULL,
  `cena_kup` int(11) NOT NULL,
  `cena_sprzedaj` int(11) NOT NULL,
  `rubies` int(11) NOT NULL,
  `atak` int(11) NOT NULL,
  `obrona` int(11) NOT NULL,
  `sila` int(1) NOT NULL,
  `zrecznosc` int(1) NOT NULL,
  `wyrzymalosc` int(1) NOT NULL,
  `inteligencja` int(1) NOT NULL,
  `carisma` int(1) NOT NULL,
  `constitucion` int(1) NOT NULL,
  `mdchance` int(1) NOT NULL,
  `dhchance` int(1) NOT NULL,
  `ctchance` int(1) NOT NULL,
  `zycie_max` int(11) NOT NULL,
  `obrazenia_min` int(11) NOT NULL,
  `obrazenia_max` int(11) NOT NULL,
  `obrazek` varchar(40) CHARACTER SET utf8 NOT NULL DEFAULT '0_0',
  `level` varchar(11) COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`przedmiot`),
  KEY `typ` (`typ`,`cena_kup`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- ----------------------------
-- Records of przedmioty
-- ----------------------------

-- ----------------------------
-- Table structure for `przedmioty_gracze`
-- ----------------------------
DROP TABLE IF EXISTS `przedmioty_gracze`;
CREATE TABLE `przedmioty_gracze` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gracz_id` int(11) NOT NULL,
  `przedmiot_id` int(11) NOT NULL,
  `zalozony` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `gracz_id` (`gracz_id`,`przedmiot_id`,`zalozony`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- ----------------------------
-- Records of przedmioty_gracze
-- ----------------------------

-- ----------------------------
-- Table structure for `quests`
-- ----------------------------
DROP TABLE IF EXISTS `quests`;
CREATE TABLE `quests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `reward_gold` int(11) DEFAULT '0',
  `reward_exp` int(11) DEFAULT '0',
  `gold_reward` int(11) NOT NULL DEFAULT '0',
  `exp_reward` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of quests
-- ----------------------------
INSERT INTO `quests` VALUES ('1', 'Kill 5 Rats', 'Clean the tavern cellar by killing 5 rats.', '50', '10', '100', '50');
INSERT INTO `quests` VALUES ('2', 'Deliver Message', 'Deliver a message to the blacksmith.', '20', '5', '0', '0');
INSERT INTO `quests` VALUES ('3', 'Win a Duel', 'Win one arena battle against another player.', '100', '20', '0', '0');

-- ----------------------------
-- Table structure for `report_fight`
-- ----------------------------
DROP TABLE IF EXISTS `report_fight`;
CREATE TABLE `report_fight` (
  `report` int(11) NOT NULL AUTO_INCREMENT,
  `user_id_d` int(11) NOT NULL,
  `user_d` varchar(24) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `titul` text NOT NULL,
  `text` text NOT NULL,
  `user_id_a` int(11) NOT NULL,
  `user_a` varchar(24) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `user_g` varchar(24) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`report`),
  KEY `user_id` (`user_id_d`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of report_fight
-- ----------------------------

-- ----------------------------
-- Table structure for `skills`
-- ----------------------------
DROP TABLE IF EXISTS `skills`;
CREATE TABLE `skills` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` text,
  `damage` int(11) DEFAULT '0',
  `healing` int(11) DEFAULT '0',
  `cooldown` int(11) DEFAULT '0',
  `cooldown_seconds` int(11) NOT NULL DEFAULT '10',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of skills
-- ----------------------------
INSERT INTO `skills` VALUES ('1', 'Power Strike', 'Deals extra 10 damage.', '10', '0', '2', '10');
INSERT INTO `skills` VALUES ('2', 'First Aid', 'Heals 10 HP.', '0', '10', '3', '15');
INSERT INTO `skills` VALUES ('3', 'Fireball', 'Burns enemy with fire.', '15', '0', '3', '12');
INSERT INTO `skills` VALUES ('4', 'Shield Bash', 'Stuns enemy and deals small damage.', '5', '0', '4', '20');
INSERT INTO `skills` VALUES ('5', 'Battle Cry', 'Boosts your strength temporarily.', '0', '0', '5', '30');
INSERT INTO `skills` VALUES ('6', 'Quick Heal', 'Restores 25 HP.', '0', '25', '5', '20');
INSERT INTO `skills` VALUES ('7', 'Piercing Arrow', 'Ignores some enemy defense.', '20', '0', '6', '15');
INSERT INTO `skills` VALUES ('8', 'Magic Barrier', 'Reduces damage taken for 3 turns.', '0', '0', '7', '40');
INSERT INTO `skills` VALUES ('9', 'Lightning Strike', 'High critical chance hit.', '25', '0', '8', '20');
INSERT INTO `skills` VALUES ('10', 'Divine Blessing', 'Heals and increases all stats temporarily.', '0', '15', '10', '60');

-- ----------------------------
-- Table structure for `skill_unlocks`
-- ----------------------------
DROP TABLE IF EXISTS `skill_unlocks`;
CREATE TABLE `skill_unlocks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `skill_id` int(11) NOT NULL,
  `unlock_level` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `skill_id` (`skill_id`),
  CONSTRAINT `skill_unlocks_ibfk_1` FOREIGN KEY (`skill_id`) REFERENCES `skills` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of skill_unlocks
-- ----------------------------
INSERT INTO `skill_unlocks` VALUES ('1', '1', '1');
INSERT INTO `skill_unlocks` VALUES ('2', '2', '1');
INSERT INTO `skill_unlocks` VALUES ('3', '3', '5');
INSERT INTO `skill_unlocks` VALUES ('4', '4', '10');
INSERT INTO `skill_unlocks` VALUES ('5', '5', '15');
INSERT INTO `skill_unlocks` VALUES ('6', '6', '20');
INSERT INTO `skill_unlocks` VALUES ('7', '7', '30');
INSERT INTO `skill_unlocks` VALUES ('8', '8', '40');
INSERT INTO `skill_unlocks` VALUES ('9', '9', '60');
INSERT INTO `skill_unlocks` VALUES ('10', '10', '80');
