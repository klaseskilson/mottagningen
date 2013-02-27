-- database.sql
-- använd denna för att installera om sidan

CREATE DATABASE IF NOT EXISTS `leg13`;

USE `leg13`;

DROP TABLE IF EXISTS `13_fadder`;
DROP TABLE IF EXISTS `13_admin`;
DROP TABLE IF EXISTS `13_users`;
DROP TABLE IF EXISTS `13_weather`;


CREATE TABLE IF NOT EXISTS `13_users` (
	`uid` INT(6) NOT NULL AUTO_INCREMENT,
	`liuid` CHAR(8) NOT NULL,
	`fname` CHAR(60) NOT NULL,
	`sname` CHAR(100) NOT NULL,
	`password` CHAR(130) NOT NULL,
	`active` BOOL default 0,
	`hash` CHAR(100) NOT NULL,
	`udate` DATE,
	PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8;

CREATE TABLE IF NOT EXISTS `13_admin` (
	`uid` INT(6) NOT NULL,
	`privil` TINYINT(1) NOT NULL,
	PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8;

ALTER TABLE `13_admin`
	ADD CONSTRAINT `13_admin_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `13_users` (`uid`);

CREATE TABLE IF NOT EXISTS `13_fadder` (
	`fadderid` INT(6) NOT NULL AUTO_INCREMENT,
	`liuid` CHAR(8) NOT NULL,
	`fname` CHAR(60) NOT NULL,
	`sname` CHAR(100) NOT NULL,
	`active` BOOL default 0,
	`hash` CHAR(100) NOT NULL,
	`searchdate` DATETIME,
	PRIMARY KEY (`fadderid`)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8;

CREATE TABLE IF NOT EXISTS `13_weather` (
	`weatherid` INT(6) NOT NULL AUTO_INCREMENT,
	`temp` DOUBLE(6,2) NOT NULL DEFAULT 0,
	`weather` CHAR(10) NOT NULL,
	`cachedate` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (`weatherid`)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8;


INSERT INTO `13_users` (`uid`, `liuid`, `fname`, `sname`, `password`, `active`, `hash`, `udate`) VALUES
(1, 'klaes950', 'Klas', 'Eskilson', '11yPiESmSzrpaqjcWspp0ODs59CaVlVfGvUkJ0M88bZQ2UXwXzHvaX8TpVyafbQtjZkKrH3OkvQ6J.vLCF8y81', 1, 'UzvTu27Jod', '2013-02-07');

INSERT INTO `13_admin` (`uid`, `privil`) VALUES
(1, 1);

