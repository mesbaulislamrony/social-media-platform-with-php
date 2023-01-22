/*
SQLyog Ultimate v12.09 (32 bit)
MySQL - 10.4.11-MariaDB : Database - socailbook
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`socailbook` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `socailbook`;

/*Table structure for table `friend_requests` */

DROP TABLE IF EXISTS `friend_requests`;

CREATE TABLE `friend_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `request_from_id` int(11) NOT NULL,
  `request_to_id` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8;

/*Table structure for table `friendships` */

DROP TABLE IF EXISTS `friendships`;

CREATE TABLE `friendships` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `friendship_id` varchar(11) NOT NULL,
  `auth_id` int(11) NOT NULL,
  `friend_id` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

/*Table structure for table `messages` */

DROP TABLE IF EXISTS `messages`;

CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `conversion_id` varchar(11) NOT NULL,
  `auth_id` int(11) NOT NULL,
  `message` longtext DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8;

/*Table structure for table `news_feeds` */

DROP TABLE IF EXISTS `news_feeds`;

CREATE TABLE `news_feeds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `posted_by` int(11) NOT NULL,
  `article` longtext DEFAULT NULL,
  `created_at` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Table structure for table `notifications` */

DROP TABLE IF EXISTS `notifications`;

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `auth_id` int(11) NOT NULL,
  `notification` text NOT NULL,
  `read_as` int(1) NOT NULL DEFAULT 0,
  `created_at` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `mobile_no` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
