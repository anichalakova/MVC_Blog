CREATE DATABASE  IF NOT EXISTS `mvc_blog` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `mvc_blog`;
-- MySQL dump 10.13  Distrib 5.6.17, for Win64 (x86_64)
--
-- Host: localhost    Database: mvc_blog
-- ------------------------------------------------------
-- Server version	5.6.16

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` varchar(200) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `post_id` (`post_id`),
  CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (4,'This is a comment to post 5',2,5,'2015-05-06 22:43:37'),(5,'Another comment for id=5',1,5,'2015-05-06 22:44:01'),(6,'comment by admin',1,5,'2015-05-07 20:27:46'),(7,'Some comment',1,5,'2015-05-07 20:48:03'),(8,'Another comment',1,5,'2015-05-07 20:50:35'),(9,'Comment from ani2',3,6,'2015-05-07 21:23:23'),(10,'I am monka.',5,5,'2015-05-10 00:28:22'),(11,'Testing comments',1,6,'2015-05-10 07:36:15');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `text` varchar(5000) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `visits` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (5,'One','Test post One','2015-05-06 21:52:49',33),(6,'Two','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. \r\n\r\nBut I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure? Edit, edit.                    ','2015-05-06 21:53:08',1000),(7,'Three - the Post with the Veeeeeeeeeeeeeeeeeeeeeeeeery Long Title','Test post three','2015-05-06 21:53:31',0),(9,'Пет','Test post Five ','2015-05-08 12:43:15',0),(10,'SixSixSix','The number of the beast','2015-05-08 12:43:48',0),(11,'Another post','Some text','2015-05-09 23:14:36',0),(13,'aetat','zdzehh','2015-05-09 23:25:58',0),(14,'sdklfjwlkgaj\'lwgk','wlrntwlkn;l','2015-05-09 23:27:09',0),(15,'metal','metal','2015-05-09 23:35:23',0),(16,'ueryiuwryuiw','owieryowiuwoi','2015-05-09 23:37:23',0),(17,'alukeryulqryuir','ile;rlw;irw;ur','2015-05-09 23:40:47',0),(19,'zzzzzzzzzzzzzzz','iluaniuin','2015-05-09 23:59:37',0),(21,'beer','beeeeer','2015-05-10 00:07:49',0),(23,'vodka vodka','vodkaaaaaaaaaaa','2015-05-10 00:21:53',0),(24,'jfhkajfhkafj','sjaajkf;jkaf;','2015-05-10 07:34:18',0);
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts_tags`
--

DROP TABLE IF EXISTS `posts_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts_tags` (
  `post_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`post_id`,`tag_id`),
  KEY `tag_id` (`tag_id`),
  CONSTRAINT `posts_tags_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `posts_tags_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts_tags`
--

LOCK TABLES `posts_tags` WRITE;
/*!40000 ALTER TABLE `posts_tags` DISABLE KEYS */;
INSERT INTO `posts_tags` VALUES (5,1),(6,1),(10,1),(11,1),(15,1),(24,1),(5,3),(6,4),(9,162),(21,162),(24,162),(5,165),(15,165),(23,165),(9,256),(10,256),(11,256),(13,256),(14,256),(15,256),(21,256),(24,256),(5,312),(15,321),(15,329),(9,336),(9,345),(11,347),(13,347),(11,350),(24,354);
/*!40000 ALTER TABLE `posts_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tag_UNIQUE` (`tag`)
) ENGINE=InnoDB AUTO_INCREMENT=359 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags`
--

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
INSERT INTO `tags` VALUES (256,''),(11,'animals'),(162,'beer'),(9,'buildings'),(121,'cars'),(15,'explode'),(7,'flowers'),(295,'kitten'),(312,'little'),(4,'lorem'),(321,'metal'),(150,'newTag'),(354,'novTag'),(2,'one'),(142,'split'),(329,'tarator'),(1,'test'),(3,'two'),(336,'vodk'),(165,'vodka'),(145,'агнешку'),(345,'бира'),(350,'карамел'),(347,'крем');
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `pass_hash` char(60) NOT NULL,
  `is_admin` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','$2y$10$83PL1rXFS.FUPRdXk/MZ0.Z2kaGD9Nt2Ke6mFtCTSOLjfVx7tcAay',''),(2,'ani','$2y$10$vPExbFeYmduDsDj/yRNBjOxSnnpj8ZVwW8VYtczbhXZ9rvd62dEwm','\0'),(3,'ani2','$2y$10$2yQ4dQDzhl69NDE5eAJ1eep7kjdyLL.Pydnw.X1YbQ/TQou2Z.rA2','\0'),(4,'nonka','$2y$10$c6SeGl9znNaWBIkuisCN8.8P5CSAjX4tbmde91hEs5PmTGzK4bYpa','\0'),(5,'monka','$2y$10$z2ADWpJtzqm/Ca18x7GdM.0fT7iIYaq1EP7Aaog3fASJfIQUJYTOm','\0');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-05-12 14:39:52
