CREATE TABLE `description` (
	`id_description` INT NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(256),
	`email` VARCHAR(256),
	`phone` VARCHAR(16),
	`experience` TEXT,
	`keywords` VARCHAR(512),
	`url` VARCHAR(1024),
	UNIQUE KEY `id_description` (`id_description`) USING BTREE,
	PRIMARY KEY (`id_description`)
) ENGINE=MyISAM;