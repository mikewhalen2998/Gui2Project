SET NAMES utf8mb4;


DROP TABLE IF EXISTS `items`;



CREATE TABLE `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `itemName` varchar(255) NOT NULL,
  `aisleNumber` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `itemType` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `tags` varchar(255) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `itemName` (`itemName`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;