-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2015 at 11:40 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `elt_game`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `unlocked_towers` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name1` tinyint(3) unsigned DEFAULT NULL,
  `name2` tinyint(3) unsigned DEFAULT NULL,
  `name3` tinyint(3) unsigned DEFAULT NULL,
  `name4` tinyint(3) unsigned DEFAULT NULL,
  `name5` tinyint(3) unsigned DEFAULT NULL,
  `name6` tinyint(3) unsigned DEFAULT NULL,
  `name7` tinyint(3) unsigned DEFAULT NULL,
  `collected_sentences` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tree_task_completed` tinyint(3) unsigned DEFAULT NULL,
  `phon_power` tinyint(3) unsigned DEFAULT NULL,
  `morph_power` tinyint(3) unsigned DEFAULT NULL,
  `syn_power` tinyint(3) unsigned DEFAULT NULL,
  `phon_seen_items` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `morph_seen_items` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `syn_seen_items` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phon_seen_mc_questions` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `morph_seen_mc_questions` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `syn_seen_mc_questions` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `everything_completed` tinyint(3) unsigned DEFAULT NULL,
  PRIMARY KEY (`user_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
