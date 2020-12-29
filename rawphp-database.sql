-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 22, 2017 at 08:37 PM
-- Server version: 5.7.9-log
-- PHP Version: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `raw-php`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `students`;
CREATE TABLE IF NOT EXISTS `students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `usn` varchar(255) NOT NULL,
  `mobile_no` varchar(255) NOT NULL,
  `placed_year` varchar(255) NOT NULL,
  `position` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `students`(`id`, `company_id`, `first_name`, `last_name`, `usn`, `mobile_no`, `email`, `placed_year`, `position`, `created_at`, `updated_at`) VALUES
(1,3,'Manoj','Naik','1DS16IS047','9887745632','manoj@gmail.com','2019',"App Developer",'2017-07-21 17:32:22', '2017-07-21 17:32:22'),
(2,4,'Sadath','Hasan','1DS16IS053','9513571235','sadath@gmail.com','2019',"CEO",'2017-07-24 21:32:22', '2017-07-24 21:32:22'),
(3,3,'Aditya','M','1DS15IS004','9873216512','adi@gmail.com','2018',"Web Developer",'2017-07-21 17:32:22', '2017-07-21 17:32:22'),
(4,5,'Prathap','P','1DS16IS015','9638527412','prathap@gmail.com','2019',"Senior Developer",'2017-07-24 21:32:22', '2017-07-24 21:32:22');


-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`) VALUES
(1, 'Super Admin', 'This is the super admin, has all rights!'),
(2, 'Moderator', 'Fewer permissions than admin'),
(3, 'User', 'Common user');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT '3',
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `first_name`, `last_name`, `email`, `password`, `gender`, `phone`, `created_at`, `updated_at`) VALUES
(1, 1, 'Faisal', 'Khan', 'defaultadmin@gmail.com', '$2y$10$/idREEAxZSQpGaAV4ugXSO5mDyyyThE/LZnpWeUovbo8nbZaBEMRq', 'male', NULL, '2017-06-29 06:39:52', NULL),
(2, 3, 'Waseem', 'L', 'defaultuser@gmail.com', '$2y$10$/idREEAxZSQpGaAV4ugXSO5mDyyyThE/LZnpWeUovbo8nbZaBEMRq', 'female', '0802222', '2017-06-29 06:39:52', '2017-06-29 06:39:52');

DROP TABLE IF EXISTS `searches`;
CREATE TABLE IF NOT EXISTS `searches` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `companies`;
CREATE TABLE IF NOT EXISTS `companies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
 
INSERT INTO `companies`(`id`, `name`, `address`) VALUES (1,'Higher Studies',NULL); 
INSERT INTO `companies`(`id`, `name`, `address`) VALUES (2,'Not Placed','NULL'); 
INSERT INTO `companies`(`id`, `name`, `address`) VALUES (3,'Tata Consultancy Services','Mumbai');
INSERT INTO `companies`(`id`, `name`, `address`) VALUES (4,'Wipro','Bengaluru');
INSERT INTO `companies`(`id`, `name`, `address`) VALUES (5,'Cognizant','Chennai');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
