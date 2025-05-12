/*
 Navicat Premium Data Transfer

 Source Server         : localhost_3306
 Source Server Type    : MySQL
 Source Server Version : 100428
 Source Host           : localhost:3306
 Source Schema         : lashme_db

 Target Server Type    : MySQL
 Target Server Version : 100428
 File Encoding         : 65001

 Date: 28/03/2024 18:52:19
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `hash` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `salt` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES (1, 'lashmeadmin', '$2a$14$/l1kximigR4wcI9i6bctjeD1UcnK4iJZ5vWXVDyl0ArYYNpCwwd4.', 'Yf}c6xj=QT!U$tz(gb\'_he5?av*s9M');

-- ----------------------------
-- Table structure for order
-- ----------------------------
DROP TABLE IF EXISTS `order`;
CREATE TABLE `order`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `amount` int NOT NULL,
  `phone_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `time_of_order` datetime NOT NULL,
  `state_id` int NULL DEFAULT NULL,
  `discount` int NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `state_id_fk`(`state_id` ASC) USING BTREE,
  CONSTRAINT `state_id_fk` FOREIGN KEY (`state_id`) REFERENCES `state` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of order
-- ----------------------------

-- ----------------------------
-- Table structure for state
-- ----------------------------
DROP TABLE IF EXISTS `state`;
CREATE TABLE `state`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `state_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `delivery_cost` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of state
-- ----------------------------
INSERT INTO `state` VALUES (1, 'Al-Anbar', 3000);
INSERT INTO `state` VALUES (2, 'Babil', 3000);
INSERT INTO `state` VALUES (3, 'Baghdad', 2000);
INSERT INTO `state` VALUES (4, 'Basra', 3000);
INSERT INTO `state` VALUES (5, 'Dhi Qar', 3000);
INSERT INTO `state` VALUES (6, 'Al-Qādisiyyah', 3000);
INSERT INTO `state` VALUES (7, 'Diyala', 3000);
INSERT INTO `state` VALUES (8, 'Duhok', 3000);
INSERT INTO `state` VALUES (9, 'Erbil', 3000);
INSERT INTO `state` VALUES (10, 'Kirkuk', 3000);
INSERT INTO `state` VALUES (11, 'Maysan', 3000);
INSERT INTO `state` VALUES (12, 'Muthanna', 3000);
INSERT INTO `state` VALUES (13, 'Najaf', 3000);
INSERT INTO `state` VALUES (14, 'Ninawa', 3000);
INSERT INTO `state` VALUES (15, 'Salah Al-Din', 3000);
INSERT INTO `state` VALUES (16, 'Sulaymaniyah', 3000);
INSERT INTO `state` VALUES (17, 'Wasit', 3000);
INSERT INTO `state` VALUES (18, 'Karbala', 3000);

-- ----------------------------
-- Triggers structure for table order
-- ----------------------------
DROP TRIGGER IF EXISTS `time_of_buying`;
delimiter ;;
CREATE TRIGGER `time_of_buying` BEFORE INSERT ON `order` FOR EACH ROW SET NEW.time_of_order = NOW()
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
