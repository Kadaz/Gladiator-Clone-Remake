/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50718
Source Host           : localhost:3306
Source Database       : gladiatus

Target Server Type    : MYSQL
Target Server Version : 50718
File Encoding         : 65001

Date: 2025-05-18 23:56:30
*/

SET FOREIGN_KEY_CHECKS=0;

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
  `name` varchar(50) NOT NULL,
  `hp` int(11) NOT NULL,
  `min_damage` int(11) NOT NULL,
  `max_damage` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of enemies
-- ----------------------------
INSERT INTO `enemies` VALUES ('1', 'Training Dummy', '50', '0', '5');
INSERT INTO `enemies` VALUES ('2', 'Forest Goblin', '60', '5', '10');
INSERT INTO `enemies` VALUES ('3', 'Cave Spider', '45', '8', '12');
INSERT INTO `enemies` VALUES ('4', 'Bandit', '70', '10', '15');
INSERT INTO `enemies` VALUES ('5', 'Fire Imp', '55', '7', '14');

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- ----------------------------
-- Records of gracze
-- ----------------------------
INSERT INTO `gracze` VALUES ('3', '1', 'tolis', 'e10adc3949ba59abbe56e057f20f883e', 'tolis@test1.com', '0', '3', 'dgfdg', 'gfdgfd', '1', '3', '312', '300', '0', '0', '9', '0', '0', '0', '0', '18', '49', '0', '10', '24', '0', '10', '5', '0', '10', '5', '0', '10', '5', '0', '10', '5', '0', '10', '0', '0', '0', '190', '100', '0', '2', '1555', '0', '0', '0', '1747529809', '0', '1747533530', 'Newbie', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1747533530', '0', '0');
INSERT INTO `gracze` VALUES ('4', '2', 'Kadaz', 'e10adc3949ba59abbe56e057f20f883e', 'solidus8422@gmail.com', '0', '1', 'tolis', 'tolis', '1', '1', '0', '10', '0', '0', '0', '3', '0', '0', '0', '0', '5', '0', '10', '5', '0', '10', '5', '0', '10', '5', '0', '10', '5', '0', '10', '5', '0', '10', '0', '0', '0', '100', '100', '0', '2', '120', '0', '0', '0', '0', '0', '1747529610', 'Newbie', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1747529610', '0', '0');
INSERT INTO `gracze` VALUES ('5', '0', 'test', '25f9e794323b453885f5181f1b624d0b', 'test@gmail.com', '0', '1', 'test', 'test', '1', '1', '0', '10', '0', '0', '0', '2', '0', '0', '0', '0', '5', '0', '10', '5', '0', '10', '5', '0', '10', '5', '0', '10', '5', '0', '10', '5', '0', '10', '0', '0', '0', '100', '100', '0', '2', '130', '0', '0', '0', '0', '0', '0', 'Newbie', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0');
INSERT INTO `gracze` VALUES ('6', '0', 'test2', 'ad0234829205b9033196ba818f7a872b', 'test2@gmail.com', '0', '1', 'test', 'test', '1', '2', '69', '100', '0', '0', '0', '1', '0', '0', '0', '0', '7', '0', '10', '5', '0', '10', '5', '0', '10', '5', '0', '10', '5', '0', '10', '5', '0', '10', '0', '0', '0', '110', '100', '0', '2', '306', '0', '0', '0', '0', '0', '0', 'Newbie', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0');
INSERT INTO `gracze` VALUES ('7', '0', 'test3', '8ad8757baa8564dc136c1e07507f4a98', 'test3@gmail.com', '0', '1', 'test3', 'test3', '1', '1', '0', '10', '0', '0', '0', '0', '0', '0', '0', '0', '5', '0', '10', '5', '0', '10', '5', '0', '10', '5', '0', '10', '5', '0', '10', '5', '0', '10', '0', '0', '0', '100', '100', '0', '2', '100', '0', '0', '0', '0', '0', '1747599526', 'Newbie', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1747599526', '0', '0');
INSERT INTO `gracze` VALUES ('8', '0', 'test4', '86985e105f79b95d6bc918fb45ec7727', 'test4@gmail.com', '0', '3', 'test4', 'test4', '1', '3', '50', '300', '0', '0', '1', '4', '0', '0', '0', '0', '9', '0', '10', '5', '0', '10', '5', '0', '10', '5', '0', '10', '5', '0', '10', '5', '0', '10', '0', '0', '0', '120', '100', '0', '2', '230', '0', '0', '0', '1747576645', '0', '1747578193', 'Newbie', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1747578193', '0', '0');

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of items
-- ----------------------------
INSERT INTO `items` VALUES ('1', 'Iron Sword', 'A sturdy sword made of iron.', 'weapon', '5', '0', '50', '0', '0', 'm1_1.png', 'weapon', '0');
INSERT INTO `items` VALUES ('2', 'Leather Armor', 'Simple protective armor.', 'armor', '0', '3', '40', '0', '0', 'default.png', 'armor', '0');
INSERT INTO `items` VALUES ('3', 'Healing Potion', 'Restores 20 HP.', 'potion', '0', '0', '10', '0', '0', 'default.png', 'misc', '2');
INSERT INTO `items` VALUES ('8', 'Bronze Sword', null, 'weapon', '0', '0', '10', '5', '50', 'default.png', 'weapon', '0');
INSERT INTO `items` VALUES ('9', 'Leather Armor', null, 'armor', '0', '0', '10', '3', '30', 'default.png', 'armor', '1');
INSERT INTO `items` VALUES ('10', 'Iron Shield', null, 'shield', '0', '0', '10', '4', '40', 'default.png', 'shield', '0');
INSERT INTO `items` VALUES ('11', 'Health Potion', null, 'consumable', '0', '0', '10', '20', '15', 'default.png', 'consumable', '0');
INSERT INTO `items` VALUES ('12', 'Iron Helmet', 'Protects your head.', 'helmet', '0', '2', '20', '0', '0', 'helmet.png', 'helm', '0');
INSERT INTO `items` VALUES ('13', 'Leather Boots', 'Sturdy boots.', 'boots', '0', '1', '15', '0', '0', 'boots.png', 'boots', '0');
INSERT INTO `items` VALUES ('14', 'Gloves of Grip', 'Increases dexterity.', 'gloves', '0', '0', '25', '0', '0', 'gloves.png', 'gloves', '0');

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
  PRIMARY KEY (`id`),
  KEY `player_id` (`player_id`),
  KEY `item_id` (`item_id`),
  CONSTRAINT `player_items_ibfk_1` FOREIGN KEY (`player_id`) REFERENCES `gracze` (`id`),
  CONSTRAINT `player_items_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of player_items
-- ----------------------------
INSERT INTO `player_items` VALUES ('2', '3', '1', '1', '1');
INSERT INTO `player_items` VALUES ('3', '3', '1', '1', '0');
INSERT INTO `player_items` VALUES ('4', '3', '1', '1', '0');
INSERT INTO `player_items` VALUES ('5', '3', '1', '1', '0');
INSERT INTO `player_items` VALUES ('6', '3', '2', '1', '0');
INSERT INTO `player_items` VALUES ('7', '3', '2', '1', '1');
INSERT INTO `player_items` VALUES ('8', '3', '10', '1', '1');
INSERT INTO `player_items` VALUES ('9', '3', '8', '1', '0');
INSERT INTO `player_items` VALUES ('10', '3', '11', '1', '1');
INSERT INTO `player_items` VALUES ('11', '3', '10', '1', '0');
INSERT INTO `player_items` VALUES ('12', '6', '1', '1', '1');
INSERT INTO `player_items` VALUES ('13', '6', '2', '1', '1');
INSERT INTO `player_items` VALUES ('14', '6', '3', '1', '1');
INSERT INTO `player_items` VALUES ('15', '6', '11', '1', '1');
INSERT INTO `player_items` VALUES ('16', '6', '1', '1', '0');
INSERT INTO `player_items` VALUES ('17', '8', '1', '1', '1');
INSERT INTO `player_items` VALUES ('18', '8', '2', '1', '0');
INSERT INTO `player_items` VALUES ('19', '8', '8', '1', '0');
INSERT INTO `player_items` VALUES ('20', '8', '10', '1', '1');
INSERT INTO `player_items` VALUES ('21', '7', '1', '1', '1');
INSERT INTO `player_items` VALUES ('22', '7', '2', '1', '0');
INSERT INTO `player_items` VALUES ('23', '7', '3', '1', '1');
INSERT INTO `player_items` VALUES ('24', '7', '8', '1', '0');

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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of player_skill_cooldowns
-- ----------------------------
INSERT INTO `player_skill_cooldowns` VALUES ('1', '3', '1', '2025-05-15 21:25:06');
INSERT INTO `player_skill_cooldowns` VALUES ('2', '3', '1', '2025-05-15 21:27:12');
INSERT INTO `player_skill_cooldowns` VALUES ('3', '3', '1', '2025-05-15 21:27:15');
INSERT INTO `player_skill_cooldowns` VALUES ('4', '3', '2', '2025-05-15 21:27:20');
INSERT INTO `player_skill_cooldowns` VALUES ('5', '3', '1', '2025-05-15 21:27:29');
INSERT INTO `player_skill_cooldowns` VALUES ('6', '3', '1', '2025-05-15 21:41:18');
INSERT INTO `player_skill_cooldowns` VALUES ('7', '3', '2', '2025-05-15 21:41:27');
INSERT INTO `player_skill_cooldowns` VALUES ('8', '3', '1', '2025-05-15 21:41:36');
INSERT INTO `player_skill_cooldowns` VALUES ('9', '3', '1', '2025-05-15 21:41:44');
INSERT INTO `player_skill_cooldowns` VALUES ('10', '3', '1', '2025-05-15 21:42:11');
INSERT INTO `player_skill_cooldowns` VALUES ('11', '3', '1', '2025-05-15 21:43:07');
INSERT INTO `player_skill_cooldowns` VALUES ('12', '3', '1', '2025-05-15 21:43:09');
INSERT INTO `player_skill_cooldowns` VALUES ('13', '3', '1', '2025-05-15 21:44:32');
INSERT INTO `player_skill_cooldowns` VALUES ('14', '3', '2', '2025-05-15 21:44:36');
INSERT INTO `player_skill_cooldowns` VALUES ('15', '3', '1', '2025-05-15 21:45:50');
INSERT INTO `player_skill_cooldowns` VALUES ('16', '3', '1', '2025-05-15 21:46:10');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of skills
-- ----------------------------
INSERT INTO `skills` VALUES ('1', 'Power Strike', 'Deals extra 10 damage.', '10', '0', '2', '10');
INSERT INTO `skills` VALUES ('2', 'First Aid', 'Heals 10 HP.', '0', '10', '3', '10');
