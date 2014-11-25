-- phpMyAdmin SQL Dump
-- version 3.5.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 14, 2014 at 06:06 AM
-- Server version: 5.5.40-36.1
-- PHP Version: 5.4.23

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `justasr_tester`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_answer`
--

CREATE TABLE IF NOT EXISTS `tbl_answer` (
  `idanswer` int(11) NOT NULL AUTO_INCREMENT,
  `answer_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `answer_corrent` int(1) DEFAULT '0',
  `answer_question_id` int(9) NOT NULL,
  `answer_create_date` datetime NOT NULL,
  `answer_update_date` datetime NOT NULL,
  PRIMARY KEY (`idanswer`),
  KEY `answer_question_id` (`answer_question_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=314 ;

--
-- Dumping data for table `tbl_answer`
--

INSERT INTO `tbl_answer` (`idanswer`, `answer_name`, `answer_corrent`, `answer_question_id`, `answer_create_date`, `answer_update_date`) VALUES
(292, 'A', 1, 108, '2014-11-14 05:44:24', '0000-00-00 00:00:00'),
(293, 'B', 0, 108, '2014-11-14 05:44:24', '0000-00-00 00:00:00'),
(294, 'C', 0, 108, '2014-11-14 05:44:24', '0000-00-00 00:00:00'),
(295, 'D', 0, 108, '2014-11-14 05:44:24', '0000-00-00 00:00:00'),
(296, 'A', 1, 107, '2014-11-14 05:44:44', '0000-00-00 00:00:00'),
(297, 'B', 0, 107, '2014-11-14 05:44:44', '0000-00-00 00:00:00'),
(298, 'C', 0, 107, '2014-11-14 05:44:44', '0000-00-00 00:00:00'),
(299, 'D', 0, 107, '2014-11-14 05:44:44', '0000-00-00 00:00:00'),
(300, 'ABC', 1, 109, '2014-11-14 05:45:31', '0000-00-00 00:00:00'),
(301, 'AB', 1, 109, '2014-11-14 05:45:31', '0000-00-00 00:00:00'),
(302, 'A', 1, 109, '2014-11-14 05:45:31', '0000-00-00 00:00:00'),
(303, 'yes', 1, 110, '2014-11-14 05:45:52', '0000-00-00 00:00:00'),
(304, 'no', 0, 110, '2014-11-14 05:45:52', '0000-00-00 00:00:00'),
(305, 'A', 1, 111, '2014-11-14 05:47:42', '0000-00-00 00:00:00'),
(306, 'B', 0, 111, '2014-11-14 05:47:42', '0000-00-00 00:00:00'),
(307, 'C', 0, 111, '2014-11-14 05:47:42', '0000-00-00 00:00:00'),
(308, 'yes', 1, 112, '2014-11-14 05:48:11', '0000-00-00 00:00:00'),
(309, 'no', 0, 112, '2014-11-14 05:48:11', '0000-00-00 00:00:00'),
(310, 'A', 1, 113, '2014-11-14 05:52:46', '0000-00-00 00:00:00'),
(311, 'B', 0, 113, '2014-11-14 05:52:46', '0000-00-00 00:00:00'),
(312, 'C', 0, 113, '2014-11-14 05:52:46', '0000-00-00 00:00:00'),
(313, 'D', 0, 113, '2014-11-14 05:52:46', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_groups`
--

CREATE TABLE IF NOT EXISTS `tbl_groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_groups`
--

INSERT INTO `tbl_groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_question`
--

CREATE TABLE IF NOT EXISTS `tbl_question` (
  `idquestion` int(11) NOT NULL AUTO_INCREMENT,
  `question_test_id` int(9) NOT NULL,
  `question_name` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `question_type` int(1) DEFAULT NULL,
  `question_create_date` datetime NOT NULL,
  `question_update_date` datetime NOT NULL,
  PRIMARY KEY (`idquestion`),
  KEY `question_test_id` (`question_test_id`),
  KEY `question_type` (`question_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=114 ;

--
-- Dumping data for table `tbl_question`
--

INSERT INTO `tbl_question` (`idquestion`, `question_test_id`, `question_name`, `question_type`, `question_create_date`, `question_update_date`) VALUES
(107, 54, 'Multiple Choice Question Example', 1, '2014-11-14 05:43:49', '2014-11-14 05:44:44'),
(108, 54, 'Multiple Response Question Example', 2, '2014-11-14 05:44:24', '0000-00-00 00:00:00'),
(109, 54, 'Blank Question Example', 3, '2014-11-14 05:45:31', '0000-00-00 00:00:00'),
(110, 54, 'TRUE / FALSE Question Example', 4, '2014-11-14 05:45:52', '0000-00-00 00:00:00'),
(111, 55, 'Multiple Choice Question Example', 1, '2014-11-14 05:47:42', '0000-00-00 00:00:00'),
(112, 55, 'TRUE / FALSE Question Example', 4, '2014-11-14 05:48:11', '0000-00-00 00:00:00'),
(113, 56, 'Multiple Choice Question', 1, '2014-11-14 05:52:46', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_question_type`
--

CREATE TABLE IF NOT EXISTS `tbl_question_type` (
  `idquestion_type` int(11) NOT NULL AUTO_INCREMENT,
  `question_type_name` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idquestion_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_question_type`
--

INSERT INTO `tbl_question_type` (`idquestion_type`, `question_type_name`) VALUES
(1, 'multiple_choise'),
(2, 'multiple_response'),
(3, 'blank'),
(4, 'true_false');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_test`
--

CREATE TABLE IF NOT EXISTS `tbl_test` (
  `idtest` int(11) NOT NULL AUTO_INCREMENT,
  `test_name` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `test_type` int(1) DEFAULT NULL,
  `test_user_id` int(11) DEFAULT NULL,
  `test_status` int(1) NOT NULL DEFAULT '0',
  `test_question_pass_count` int(9) NOT NULL DEFAULT '1',
  `test_create_time` datetime NOT NULL,
  `test_update_time` datetime NOT NULL,
  PRIMARY KEY (`idtest`),
  KEY `test_type` (`test_type`),
  KEY `test_user_id` (`test_user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=57 ;

--
-- Dumping data for table `tbl_test`
--

INSERT INTO `tbl_test` (`idtest`, `test_name`, `test_type`, `test_user_id`, `test_status`, `test_question_pass_count`, `test_create_time`, `test_update_time`) VALUES
(54, 'Exam Example', 3, 12, 2, 2, '2014-11-14 05:42:36', '2014-11-14 05:46:10'),
(55, 'Survey Example', 2, 12, 2, 1, '2014-11-14 05:47:14', '2014-11-14 05:48:23'),
(56, 'Poll Example', 1, 12, 2, 1, '2014-11-14 05:52:09', '2014-11-14 05:52:54');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_test_type`
--

CREATE TABLE IF NOT EXISTS `tbl_test_type` (
  `idtest_type` int(11) NOT NULL AUTO_INCREMENT,
  `test_type_name` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idtest_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_test_type`
--

INSERT INTO `tbl_test_type` (`idtest_type`, `test_type_name`) VALUES
(1, 'poll'),
(2, 'survey'),
(3, 'exam');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE IF NOT EXISTS `tbl_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varbinary(16) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(80) NOT NULL,
  `salt` varchar(40) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `last_login_ip` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `last_login_ip`) VALUES
(7, '\0\0', 'admin', 'eeaf456bd14236e8632f04530d22286e7007c701', NULL, 'justas.ruika@gmail.com', 'ceeb30a0e08a1568fcd9700392dba7c2a73889b5', NULL, NULL, NULL, 1392606340, 1400003201, 1, NULL, NULL, ''),
(12, 'Ôuå', 'user', '1de3751058d8678cf577be8b18eb28dbe74ce9e3', NULL, 'user_v1@gmail.com', NULL, NULL, NULL, NULL, 1395589645, 1415964793, 1, 'user', 'user', '212.117.17.229'),
(13, 'Ôuå', 'user_v2', '1de3751058d8678cf577be8b18eb28dbe74ce9e3', NULL, 'user_v1@gmail.com', NULL, NULL, NULL, NULL, 1395589645, 1415959890, 1, 'user', 'user', '212.117.17.229');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users_groups`
--

CREATE TABLE IF NOT EXISTS `tbl_users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `tbl_users_groups`
--

INSERT INTO `tbl_users_groups` (`id`, `user_id`, `group_id`) VALUES
(8, 7, 1),
(13, 12, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_test_taken`
--

CREATE TABLE IF NOT EXISTS `tbl_user_test_taken` (
  `user_test_taken_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_test_test_id` int(11) NOT NULL,
  `user_test_user_id` int(11) NOT NULL,
  `user_test_taken_score` int(11) NOT NULL DEFAULT '0',
  `user_test_create_time` datetime NOT NULL,
  PRIMARY KEY (`user_test_taken_id`),
  KEY `user_test_test_id` (`user_test_test_id`),
  KEY `user_test_user_id` (`user_test_user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=49 ;

--
-- Dumping data for table `tbl_user_test_taken`
--

INSERT INTO `tbl_user_test_taken` (`user_test_taken_id`, `user_test_test_id`, `user_test_user_id`, `user_test_taken_score`, `user_test_create_time`) VALUES
(46, 54, 12, 0, '2014-11-14 06:04:53'),
(47, 55, 12, 0, '2014-11-14 06:05:05'),
(48, 56, 12, 0, '2014-11-14 06:05:18');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_test_taken_answers`
--

CREATE TABLE IF NOT EXISTS `tbl_user_test_taken_answers` (
  `test_taken_answers_id` int(11) NOT NULL AUTO_INCREMENT,
  `test_tanken_id` int(11) DEFAULT NULL,
  `test_taken_question_id` int(11) DEFAULT NULL,
  `test_taken_answer_id` int(11) DEFAULT NULL,
  `test_taken_answer_input` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`test_taken_answers_id`),
  KEY `test_tanken_id` (`test_tanken_id`),
  KEY `test_taken_question_id` (`test_taken_question_id`),
  KEY `test_taken_answer_id` (`test_taken_answer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=100 ;

--
-- Dumping data for table `tbl_user_test_taken_answers`
--

INSERT INTO `tbl_user_test_taken_answers` (`test_taken_answers_id`, `test_tanken_id`, `test_taken_question_id`, `test_taken_answer_id`, `test_taken_answer_input`) VALUES
(92, 46, 107, 297, NULL),
(93, 46, 108, 292, NULL),
(94, 46, 108, 294, NULL),
(95, 46, 109, NULL, 'AbC'),
(96, 46, 110, 303, NULL),
(97, 47, 111, 306, NULL),
(98, 47, 112, 308, NULL),
(99, 48, 113, 311, NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_answer`
--
ALTER TABLE `tbl_answer`
  ADD CONSTRAINT `tbl_answer_ibfk_1` FOREIGN KEY (`answer_question_id`) REFERENCES `tbl_question` (`idquestion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_question`
--
ALTER TABLE `tbl_question`
  ADD CONSTRAINT `tbl_question_ibfk_2` FOREIGN KEY (`question_test_id`) REFERENCES `tbl_test` (`idtest`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_question_ibfk_1` FOREIGN KEY (`question_type`) REFERENCES `tbl_question_type` (`idquestion_type`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_test`
--
ALTER TABLE `tbl_test`
  ADD CONSTRAINT `tbl_test_ibfk_1` FOREIGN KEY (`test_type`) REFERENCES `tbl_test_type` (`idtest_type`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_user_test_taken`
--
ALTER TABLE `tbl_user_test_taken`
  ADD CONSTRAINT `tbl_user_test_taken_ibfk_1` FOREIGN KEY (`user_test_test_id`) REFERENCES `tbl_test` (`idtest`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_user_test_taken_answers`
--
ALTER TABLE `tbl_user_test_taken_answers`
  ADD CONSTRAINT `tbl_user_test_taken_answers_ibfk_3` FOREIGN KEY (`test_taken_question_id`) REFERENCES `tbl_question` (`idquestion`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_user_test_taken_answers_ibfk_1` FOREIGN KEY (`test_tanken_id`) REFERENCES `tbl_user_test_taken` (`user_test_taken_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
