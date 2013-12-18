# ************************************************************
# Sequel Pro SQL dump
# Version 4004
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.5.29)
# Database: insta
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table insta_friends
# ------------------------------------------------------------

DROP TABLE IF EXISTS `insta_friends`;

CREATE TABLE `insta_friends` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `friend_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `insta_friends` WRITE;
/*!40000 ALTER TABLE `insta_friends` DISABLE KEYS */;

INSERT INTO `insta_friends` (`id`, `user_id`, `friend_id`)
VALUES
	(17,1,2),
	(18,1,3),
	(19,1,4),
	(28,4,1),
	(29,4,2),
	(43,2,1),
	(44,2,4);

/*!40000 ALTER TABLE `insta_friends` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table insta_images
# ------------------------------------------------------------

DROP TABLE IF EXISTS `insta_images`;

CREATE TABLE `insta_images` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `url_thumb` varchar(255) NOT NULL DEFAULT '',
  `url_large` varchar(255) NOT NULL DEFAULT '',
  `created` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `insta_images` WRITE;
/*!40000 ALTER TABLE `insta_images` DISABLE KEYS */;

INSERT INTO `insta_images` (`id`, `user_id`, `url_thumb`, `url_large`, `created`)
VALUES
	(10,4,'/users/images/l_1c63feb6cda2b7c1d52c9313f7132e93.jpg','/users/images/m_1c63feb6cda2b7c1d52c9313f7132e93.jpg',NULL),
	(11,4,'/users/images/l_b53438680146a8cbc068af4c10f4dd37.jpg','/users/images/m_b53438680146a8cbc068af4c10f4dd37.jpg',1387314442),
	(12,4,'/users/images/l_8bffceee963f22a89c584761622b8c5d.jpg','/users/images/m_8bffceee963f22a89c584761622b8c5d.jpg',1387314443),
	(13,4,'/users/images/l_0427fec634e0e88fd7d9bf10daf49616.jpg','/users/images/m_0427fec634e0e88fd7d9bf10daf49616.jpg',1387314443),
	(14,4,'/users/images/l_08bbf4ffc3f01cd14d8d478e4511816e.jpg','/users/images/m_08bbf4ffc3f01cd14d8d478e4511816e.jpg',1387314951),
	(15,4,'/users/images/l_e8c41b736b2c2922d1830350b807c187.jpg','/users/images/m_e8c41b736b2c2922d1830350b807c187.jpg',1387315070),
	(16,4,'/users/images/l_0f244b3ba61282457781eaceca5c9170.jpg','/users/images/m_0f244b3ba61282457781eaceca5c9170.jpg',1387315104),
	(17,4,'/users/images/l_ae752c38a8ee29d11a444bddabd699c5.jpg','/users/images/m_ae752c38a8ee29d11a444bddabd699c5.jpg',1387315144),
	(18,2,'/users/images/l_83f52c6a40ca93d6172aba647ea27c5d.jpg','/users/images/m_83f52c6a40ca93d6172aba647ea27c5d.jpg',1387315407),
	(19,2,'/users/images/l_542714fc074bd68aa73518fce3f7140f.jpg','/users/images/m_542714fc074bd68aa73518fce3f7140f.jpg',1387318537),
	(20,2,'/users/images/l_03b44dd418e1bb523c881d66f16bc8c5.jpg','/users/images/m_03b44dd418e1bb523c881d66f16bc8c5.jpg',1387318830),
	(21,2,'/users/images/l_7413fac20aeb1748d01f9f76b076f843.jpg','/users/images/m_7413fac20aeb1748d01f9f76b076f843.jpg',1387318831),
	(22,2,'/users/images/l_69d38232ead0eb4b7bce806eedbf5d91.jpg','/users/images/m_69d38232ead0eb4b7bce806eedbf5d91.jpg',1387321067),
	(23,2,'/users/images/l_2a61de5b03f119ecc85975447c045965.jpg','/users/images/m_2a61de5b03f119ecc85975447c045965.jpg',1387321068),
	(24,2,'/users/images/l_2774ce00d9e03d5c671f77f658a00b13.jpg','/users/images/m_2774ce00d9e03d5c671f77f658a00b13.jpg',1387383439),
	(25,2,'/users/images/l_35ca7b39f91846e2f0a80ad4324fa5d5.jpg','/users/images/m_35ca7b39f91846e2f0a80ad4324fa5d5.jpg',1387383441),
	(26,2,'/users/images/l_9283433f6f7b9900f6933a45689b5062.jpg','/users/images/m_9283433f6f7b9900f6933a45689b5062.jpg',1387383485),
	(27,2,'/users/images/l_eed73fe7f9132b5a7f26298f3a9cb320.jpg','/users/images/m_eed73fe7f9132b5a7f26298f3a9cb320.jpg',1387383494),
	(28,2,'/users/images/l_696b77418963be764ecf1a1cbc527da1.jpg','/users/images/m_696b77418963be764ecf1a1cbc527da1.jpg',1387383508),
	(29,2,'/users/images/l_b14f428cd2ee6f9eae709c8a8aeb9fcb.jpg','/users/images/m_b14f428cd2ee6f9eae709c8a8aeb9fcb.jpg',1387383541),
	(30,2,'/users/images/l_f2698a0f3d9607a070e6fe5840580997.jpg','/users/images/m_f2698a0f3d9607a070e6fe5840580997.jpg',1387383549),
	(31,2,'/users/images/l_2225899f3d8f753ea4067e512dc87dd0.jpg','/users/images/m_2225899f3d8f753ea4067e512dc87dd0.jpg',1387383549),
	(32,2,'/users/images/l_0b3076cef4578a081ebfd56eae720b60.jpg','/users/images/m_0b3076cef4578a081ebfd56eae720b60.jpg',1387383550);

/*!40000 ALTER TABLE `insta_images` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table insta_login
# ------------------------------------------------------------

DROP TABLE IF EXISTS `insta_login`;

CREATE TABLE `insta_login` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(64) NOT NULL DEFAULT '',
  `password` varchar(128) NOT NULL DEFAULT '',
  `logged_in` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `insta_login` WRITE;
/*!40000 ALTER TABLE `insta_login` DISABLE KEYS */;

INSERT INTO `insta_login` (`id`, `email`, `password`, `logged_in`)
VALUES
	(1,'jlkj','0d3169cb90c460a6c61b17c330f5dcb25965201513c4eb83bbf950b17d5eca4c455ce37410adb63c2',0),
	(2,'ericruvio@gmail.com','ae2b1fca515949e5d54fb22b8ed95575596520151dc724af18fbdd4e59189f5fe768a5f8311527050',1),
	(3,'test@test.com','0d3169cb90c460a6c61b17c330f5dcb25965201513c4eb83bbf950b17d5eca4c455ce37410adb63c2',NULL),
	(4,'another@test.com','ae2b1fca515949e5d54fb22b8ed95575596520151dc724af18fbdd4e59189f5fe768a5f8311527050',1),
	(5,'xyz@example.com','0d3169cb90c460a6c61b17c330f5dcb25965201513c4eb83bbf950b17d5eca4c455ce37410adb63c2',NULL);

/*!40000 ALTER TABLE `insta_login` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table insta_profile
# ------------------------------------------------------------

DROP TABLE IF EXISTS `insta_profile`;

CREATE TABLE `insta_profile` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `profile_image` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `insta_profile` WRITE;
/*!40000 ALTER TABLE `insta_profile` DISABLE KEYS */;

INSERT INTO `insta_profile` (`id`, `first_name`, `last_name`, `user_id`, `profile_image`)
VALUES
	(1,'Eric','Ruvio New!',1,1),
	(2,'Jim','Carey',2,1),
	(3,'Some','Person',3,NULL),
	(4,'Another','Person',4,NULL),
	(5,'One','More',5,NULL);

/*!40000 ALTER TABLE `insta_profile` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
