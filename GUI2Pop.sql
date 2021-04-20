SET NAMES utf8mb4;


DROP TABLE IF EXISTS `items`;
DROP TABLE IF EXISTS `Lowell-items`;
DROP TABLE IF EXISTS `Tewksbury-items`;
DROP TABLE IF EXISTS `ItemsLowell`;
DROP TABLE IF EXISTS `ItemsTewksbury`;



CREATE TABLE `ItemsLowell` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `itemName` varchar(255) NOT NULL,
  `aisleNumber` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `itemType` varchar(255) NOT NULL,
  `tags` varchar(255) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `itemName` (`itemName`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

CREATE TABLE `ItemsTewksbury` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `itemName` varchar(255) NOT NULL,
  `aisleNumber` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `itemType` varchar(255) NOT NULL,
  `tags` varchar(255) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `itemName` (`itemName`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;