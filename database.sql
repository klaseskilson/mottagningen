-- database.sql
-- använd denna för att installera om sidan

CREATE DATABASE IF NOT EXISTS `leg13`;

USE `leg13`;

DROP TABLE IF EXISTS `13_post_cont`;
DROP TABLE IF EXISTS `13_posts`;
DROP TABLE IF EXISTS `13_admin`;
DROP TABLE IF EXISTS `13_users`;
DROP TABLE IF EXISTS `13_weather`;
DROP TABLE IF EXISTS `13_ad_views`;
DROP TABLE IF EXISTS `13_ads`;

CREATE TABLE IF NOT EXISTS `13_users` (
	`uid` INT(6) NOT NULL AUTO_INCREMENT,
	`liuid` CHAR(8) NOT NULL,
	`fname` CHAR(60) NOT NULL,
	`sname` CHAR(100) NOT NULL,
	`password` CHAR(130) NOT NULL,
	PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8;

CREATE TABLE IF NOT EXISTS `13_admin` (
	`uid` INT(6) NOT NULL,
	`privil` TINYINT(1) NOT NULL,
	PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8;

ALTER TABLE `13_admin`
	ADD CONSTRAINT `13_admin_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `13_users` (`uid`);

CREATE TABLE IF NOT EXISTS `13_ads` (
	`id` INT(6) NOT NULL AUTO_INCREMENT,
	`link` CHAR(100) NOT NULL,
	`company` CHAR(30) NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8;

CREATE TABLE IF NOT EXISTS `13_ad_views` (
	`view_id` INT(6) NOT NULL AUTO_INCREMENT,
	`ad_id` INT(6) NOT NULL,
	`phadderi` CHAR(6) NOT NULL,
	PRIMARY KEY (`view_id`)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8;

ALTER TABLE `13_ad_views`
	ADD CONSTRAINT `13_ad_views_ibfk_1` FOREIGN KEY (`ad_id`) REFERENCES `13_ads` (`id`);


CREATE TABLE IF NOT EXISTS `13_posts` (
	`post_id` INT(6) NOT NULL AUTO_INCREMENT,
	`title` CHAR(100) NOT NULL,
	`slug` CHAR(30) NOT NULL,
	`hash` CHAR(30) NOT NULL,
	`parentid` INT(6) NOT NULL DEFAULT 0,
	`status` TINYINT(1) DEFAULT 0,
	PRIMARY KEY (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8;

CREATE TABLE IF NOT EXISTS `13_post_cont` (
	`cont_id` INT(6) NOT NULL AUTO_INCREMENT,
	`post_id` INT(6) NOT NULL,
	`content` TEXT NOT NULL,
	`time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`cont_id`)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8;

ALTER TABLE `13_post_cont`
	ADD CONSTRAINT `13_post_cont_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `13_posts` (`post_id`);


CREATE TABLE IF NOT EXISTS `13_weather` (
	`weatherid` INT(6) NOT NULL AUTO_INCREMENT,
	`temp` CHAR(100) NOT NULL,
	`weather` CHAR(100) NOT NULL,
	`cachedate` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`windspeed` FLOAT(4,2) NOT NULL DEFAULT 0.0,
	PRIMARY KEY (`weatherid`)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8;

-- insert data!
INSERT INTO `13_users` (`uid`, `liuid`, `fname`, `sname`, `password`) VALUES
(1, 'klaes950', 'Klas', 'Eskilson', 'F.7kxJf5b.9596Nc4pnihZww1gsSyr/yMzie1CLvlrsWb6Q5cUVU/aE72lvWD8DAV17CBL8Fyi.QwfuMF7U/');

INSERT INTO `13_admin` (`uid`, `privil`) VALUES
(1, 1);

INSERT INTO `leg13`.`13_ads` (`id`, `link`, `company`) VALUES (NULL, 'http://google.se', 'Google');
INSERT INTO `leg13`.`13_ads` (`id`, `link`, `company`) VALUES (NULL, 'http://google.se?1', 'Google1');
INSERT INTO `leg13`.`13_ads` (`id`, `link`, `company`) VALUES (NULL, 'http://google.se?2', 'Google2');
INSERT INTO `leg13`.`13_ads` (`id`, `link`, `company`) VALUES (NULL, 'http://google.se?3', 'Google3');
INSERT INTO `leg13`.`13_ads` (`id`, `link`, `company`) VALUES (NULL, 'http://google.se?4', 'Google4');
INSERT INTO `leg13`.`13_ads` (`id`, `link`, `company`) VALUES (NULL, 'http://google.se?5', 'Google5');
INSERT INTO `leg13`.`13_ads` (`id`, `link`, `company`) VALUES (NULL, 'http://google.se?6', 'Google6');
INSERT INTO `leg13`.`13_ads` (`id`, `link`, `company`) VALUES (NULL, 'http://google.se?7', 'Google7');
INSERT INTO `leg13`.`13_ads` (`id`, `link`, `company`) VALUES (NULL, 'http://google.se?8', 'Google8');
INSERT INTO `leg13`.`13_ads` (`id`, `link`, `company`) VALUES (NULL, 'http://google.se?9', 'Google9');
