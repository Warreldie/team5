# ************************************************************
# Sequel Ace SQL dump
# Version 3030
#
# https://sequel-ace.com/
# https://github.com/Sequel-Ace/Sequel-Ace
#
# Host: localhost (MySQL 5.7.32)
# Database: imdtok
# Generation Time: 2021-05-28 09:22:27 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE='NO_AUTO_VALUE_ON_ZERO', SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table comments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `comments`;

CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(600) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;

INSERT INTO `comments` (`id`, `text`, `timestamp`, `post_id`, `user_id`)
VALUES
	(1,'Test','2021-05-21 10:54:50',1,20),
	(2,'Dit is een comment','2021-05-21 10:55:00',1,20);

/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table followers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `followers`;

CREATE TABLE `followers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `follower_id` int(11) NOT NULL,
  `following_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table likes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `likes`;

CREATE TABLE `likes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

LOCK TABLES `likes` WRITE;
/*!40000 ALTER TABLE `likes` DISABLE KEYS */;

INSERT INTO `likes` (`id`, `user_id`, `post_id`, `status`)
VALUES
	(1,16,1,1),
	(2,4,1,1),
	(4,16,2,0),
	(5,16,3,0),
	(6,16,4,0),
	(7,1,4,1),
	(8,2,4,1),
	(9,3,4,1),
	(10,4,4,1);

/*!40000 ALTER TABLE `likes` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table posts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `posts`;

CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `post_text` varchar(300) NOT NULL,
  `post_image` varchar(300) NOT NULL,
  `timestamp` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
  `location` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;

INSERT INTO `posts` (`id`, `user_id`, `post_text`, `post_image`, `timestamp`, `location`)
VALUES
	(1,4,'Test','60a77552373655.11447038.png','2021-05-21 10:54:42.226603',NULL),
	(4,4,'Happy joy joy','60a91515eb7e18.38229723.jpg','2021-05-22 16:28:37.965169',NULL),
	(3,4,'Vogue','60a9140f6dd0a4.33761888.jpg','2021-05-22 16:24:15.450774',NULL);

/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table posts_tags
# ------------------------------------------------------------

DROP TABLE IF EXISTS `posts_tags`;

CREATE TABLE `posts_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

LOCK TABLES `posts_tags` WRITE;
/*!40000 ALTER TABLE `posts_tags` DISABLE KEYS */;

INSERT INTO `posts_tags` (`id`, `post_id`, `tag_id`)
VALUES
	(1,1,1),
	(2,2,2),
	(3,2,3),
	(4,3,4),
	(5,3,5),
	(6,4,6),
	(7,4,7);

/*!40000 ALTER TABLE `posts_tags` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tags
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tags`;

CREATE TABLE `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;

INSERT INTO `tags` (`id`, `text`)
VALUES
	(1,'test'),
	(2,'cool'),
	(3,'likeable'),
	(4,'dark'),
	(5,'moody'),
	(6,'happy'),
	(7,'joy');

/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(300) NOT NULL,
  `email` varchar(300) NOT NULL,
  `password` varchar(300) NOT NULL,
  `date_of_birth` date NOT NULL,
  `profile_picture` varchar(300) DEFAULT NULL,
  `bio` text,
  `private` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `username`, `email`, `password`, `date_of_birth`, `profile_picture`, `bio`, `private`)
VALUES
	(1,'Warrel','vanelverdinghe.ward@gmail.com','123456','1998-04-03','','',0),
	(3,'Ada','r0755066@student.thomasmore.be','654321','2000-03-01','','',0),
	(4,'Bob','r0785346@student.thomasmore.be','StormOpZee','1999-03-01','profile-pictures/60a78d005cdcb7.05524889.jpg','',0),
	(8,'ninja','r0744470@student.thomasmore.be','$2y$15$V3i69Ri3PjpV5zCTHIBXnusdTvHfm3EQSc4wGtrOP9uT4KYbrQv2i','2002-03-03','','',0),
	(11,'ninja','acid2@youtube.com','$2y$15$r.aMDn1jfeX/doE/vw2u9O/vETtqXvMGuOwdAlbhtY1OmCBlWPFAO','1998-04-03','','',0),
	(15,'Jack','jack@sparrow.be','$2y$15$3b72qlRHvYggOr.M78wXf.lrPzr.TVqLydjFO3FyA6qGqczbl3.By','2021-04-02',NULL,NULL,NULL),
	(16,'bob.storms','bob.storms@hotmail.be','$2y$15$NbwIcbJsxAqFy0oUrNSq9OBV2kWQTmMT2EF9hSY8dmuj6/uPOOstO','2001-10-04','profile-pictures/60acbf851702f8.57364069.jpg',NULL,NULL);

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
