CREATE DATABASE IF NOT EXISTS `app`;

USE `app`;

CREATE TABLE IF NOT EXISTS `ean` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `ean` varchar(32) NOT NULL,
  `material` varchar(32) NOT NULL,
  `price` varchar(32) NOT NULL,
  `vat` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;