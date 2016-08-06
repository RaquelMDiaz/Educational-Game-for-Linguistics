-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 22, 2014 at 06:18 PM
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
-- Table structure for table `syntax_incorrect`
--

CREATE TABLE IF NOT EXISTS `syntax_incorrect` (
  `incorrect_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tree_id` int(10) unsigned NOT NULL,
  `phrase_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`incorrect_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=21 ;

--
-- Dumping data for table `syntax_incorrect`
--

INSERT INTO `syntax_incorrect` (`incorrect_id`, `tree_id`, `phrase_id`) VALUES
(1, 2, 1),
(2, 3, 1),
(3, 5, 2),
(4, 6, 2),
(5, 7, 3),
(6, 9, 3),
(7, 10, 4),
(8, 11, 4),
(9, 14, 5),
(10, 15, 5),
(11, 16, 6),
(12, 18, 6),
(13, 19, 7),
(14, 20, 7),
(15, 23, 8),
(16, 24, 8),
(17, 25, 9),
(18, 27, 9),
(19, 28, 10),
(20, 29, 10),
(21, 32, 11),
(22, 33, 11),
(23, 35, 12),
(24, 36, 12),
(25, 38, 13),
(26, 39, 13),
(27, 41, 14),
(28, 42, 14),
(29, 44, 15),
(30, 45, 15),
(31, 47, 16),
(32, 48, 16);

-- --------------------------------------------------------

--
-- Table structure for table `syntax_phrases`
--

CREATE TABLE IF NOT EXISTS `syntax_phrases` (
  `phrase_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `phrase` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `correct_id` int(10) unsigned NOT NULL,
  `level` int(10) unsigned DEFAULT NULL,
  `h_id` int(11) NOT NULL,
  PRIMARY KEY (`phrase_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `syntax_phrases`
--

INSERT INTO `syntax_phrases` (`phrase_id`, `phrase`, `correct_id`, `level`, `h_id`) VALUES
(1, 'prove your ablities to the linguists', 1, 2, 25),
(2, 'our powerful master', 4, 1, 26),
(3, 'very complicated', 8, 1, 27),
(4, 'invade the PhilFak', 12, 1, 28),
(5, 'fond of the syntactic analysis of sentences', 13, 2, 29),
(6, 'right into an linguistic adventure', 17, 2, 30),
(7, 'Chomsky will never surrender his control of the society.', 21, 3, 31),
(8, 'that we are very sophisticated linguists', 22, 3, 32),
(9, 'our hopes which we pin on you', 26, 3, 33),
(10, 'Why has the society come to Marburg?', 30, 3, 34),
(11, 'The members of the Society', 31, 4, 0),
(12, 'have arrived to Marburg', 34, 4, 0),
(13, 'their new Master', 37, 4, 0),
(14, 'a true linguist', 40, 4, 0),
(15, 'can depose old Chomsky!', 43, 4, 0),
(16, 'The members of the Society have arrived to Marburg to find their new Master and only a true linguist can depose old Chomsky!', 46, 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `syntax_trees`
--

CREATE TABLE IF NOT EXISTS `syntax_trees` (
  `tree_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `path` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`tree_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=31 ;

--
-- Dumping data for table `syntax_trees`
--

INSERT INTO `syntax_trees` (`tree_id`, `path`) VALUES
(1, '../syntax_trees/tree1.png'),
(2, '../syntax_trees/tree2.png'),
(3, '../syntax_trees/tree3.png'),
(4, '../syntax_trees/tree4.png'),
(5, '../syntax_trees/tree5.png'),
(6, '../syntax_trees/tree6.png'),
(7, '../syntax_trees/tree7.png'),
(8, '../syntax_trees/tree8.png'),
(9, '../syntax_trees/tree9.png'),
(10, '../syntax_trees/tree10.png'),
(11, '../syntax_trees/tree11.png'),
(12, '../syntax_trees/tree12.png'),
(13, '../syntax_trees/tree13.png'),
(14, '../syntax_trees/tree14.png'),
(15, '../syntax_trees/tree15.png'),
(16, '../syntax_trees/tree16.png'),
(17, '../syntax_trees/tree17.png'),
(18, '../syntax_trees/tree18.png'),
(19, '../syntax_trees/tree19.png'),
(20, '../syntax_trees/tree20.png'),
(21, '../syntax_trees/tree21.png'),
(22, '../syntax_trees/tree22.png'),
(23, '../syntax_trees/tree23.png'),
(24, '../syntax_trees/tree24.png'),
(25, '../syntax_trees/tree25.png'),
(26, '../syntax_trees/tree26.png'),
(27, '../syntax_trees/tree27.png'),
(28, '../syntax_trees/tree28.png'),
(29, '../syntax_trees/tree29.png'),
(30, '../syntax_trees/tree30.png'),
(31, '../syntax_trees/tree31.png'),
(32, '../syntax_trees/tree32.png'),
(33, '../syntax_trees/tree33.png'),
(34, '../syntax_trees/tree34.png'),
(35, '../syntax_trees/tree35.png'),
(36, '../syntax_trees/tree36.png'),
(37, '../syntax_trees/tree37.png'),
(38, '../syntax_trees/tree38.png'),
(39, '../syntax_trees/tree39.png'),
(40, '../syntax_trees/tree40.png'),
(41, '../syntax_trees/tree41.png'),
(42, '../syntax_trees/tree42.png'),
(43, '../syntax_trees/tree43.png'),
(44, '../syntax_trees/tree44.png'),
(45, '../syntax_trees/tree45.png'),
(46, '../syntax_trees/tree46.png'),
(47, '../syntax_trees/tree47.png'),
(48, '../syntax_trees/tree48.png');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
