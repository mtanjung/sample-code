CREATE TABLE `animals` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `age` tinyint unsigned DEFAULT NULL,
  `favorite_food` varchar(255) DEFAULT NULL,
  `past_names` varchar(255) DEFAULT NULL,
  `speak_counter` int unsigned DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `animals` (`name`,`age`,`favorite_food`,`past_names`,`speak_counter`,`type`) 
VALUES ('Garfield',5,'fish','[\"garlan\",\"sharky\",\"tigger\"]',4,'cat'),
('Woffie',7,'bone','[\"enzo\",\"fire\"]',3,'dog'),
('Sophia',9,'bully sticks','[\"princess\",\"queen\"]',6,'dog'),
('Tigger',10,'crackers','[\"cracker\",\"garfield\"]',2,'cat');