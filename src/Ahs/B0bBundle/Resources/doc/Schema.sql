DROP SCHEMA IF EXISTS `b0b-SF2`;
CREATE SCHEMA IF NOT EXISTS `b0b-SF2`
    DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `b0b-SF2`;

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
	usr_id           INT(11) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
	usr_givenname    VARCHAR(255) ,
	usr_familyname   VARCHAR(255) ,
	usr_email        VARCHAR(255) ,
	usr_salt         CHAR(64),   --  64 character hash code
	usr_password     CHAR(128),  -- 128 character hash code
	usr_gender       ENUM('m','f'),
	usr_weight       FLOAT,
	usr_active       BOOLEAN
);