-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2014 at 01:46 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `morphology_task`
--

-- --------------------------------------------------------

--
-- Table structure for table `words_morphemes_lookup`
--

CREATE TABLE IF NOT EXISTS `words_morphemes_lookup` (
  `w_id` int(11) NOT NULL,
  `m_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `words_morphemes_lookup`
--

INSERT INTO `words_morphemes_lookup` (`w_id`, `m_id`) VALUES
(1, 1),
(1, 2),
(2, 3),
(2, 4),
(3, 5),
(3, 6),
(4, 7),
(4, 4),
(4, 8),
(5, 9),
(5, 2),
(5, 10),
(6, 11),
(6, 12),
(6, 13),
(6, 14),
(7, 15),
(8, 8),
(9, 20),
(10, 22),
(11, 24),
(12, 20),
(13, 4),
(14, 25),
(15, 6),
(16, 23);

-- --------------------------------------------------------

--
-- Table structure for table `level_table`
--

CREATE TABLE IF NOT EXISTS `level_table` (
  `level_id` int(11) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `morphemes_table`
--

CREATE TABLE IF NOT EXISTS `morphemes_table` (
  `morpheme_id` int(11) NOT NULL,
  `morpheme` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `t_id` int(11) NOT NULL,
  PRIMARY KEY (`morpheme_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `morphemes_table`
--

INSERT INTO `morphemes_table` (`morpheme_id`, `morpheme`, `t_id`) VALUES
(1, 'mak', 1),
(2, 'ing', 3),
(3, 'start', 1),
(4, 'ed', 3),
(5, 'controll', 1),
(6, 'er', 2),
(7, 'expect', 1),
(8, 'ly', 2),
(9, 'mean', 1),
(10, 'ful', 2),
(11, 'nation', 1),
(12, 'al', 2),
(13, 'iti', 2),
(14, 'es', 3),
(15, 'relent', 1),
(16, 'less', 2),
(17, 'seem', 1),
(18, 'act', 1),
(19, 'or', 2),
(20, 's', 3),
(21, 'mistak', 1),
(22, 'en', 3),
(23, 'ist', 2),
(24, 'society', 1),
(25, 'find', 1);

-- --------------------------------------------------------

--
-- Table structure for table `morpheme_type_table`
--

CREATE TABLE IF NOT EXISTS `morpheme_type_table` (
  `type_id` int(11) NOT NULL,
  `type` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `morpheme_type_table`
--

INSERT INTO `morpheme_type_table` (`type_id`, `type`) VALUES
(1, 'stem'),
(2, 'derivational'),
(3, 'inflectional');


-- --------------------------------------------------------

--
-- Table structure for table `morph_words_table`
--

CREATE TABLE IF NOT EXISTS `morph_words_table` (
  `word_id` int(11) NOT NULL,
  `word` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `m_requested_id` int(11) NOT NULL,
  `level_id` int(11) NOT NULL,
  `h_id` int(11) NOT NULL,
  PRIMARY KEY (`word_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `morph_words_table`
--

INSERT INTO `morph_words_table` (`word_id`, `word`, `m_requested_id`, `level_id`, `h_id`) VALUES
(1, 'making', 3, 1, 15),
(2, 'started', 1, 1, 16),
(3, 'controller', 2, 1, 17),
(4, 'expectedly', 3, 2, 18),
(5, 'meaningful', 2, 2, 19),
(6, 'nationalities', 1, 2, 20),
(7, 'relentlessly', 1, 3, 21),
(8, 'seemingly', 2, 3, 22),
(9, 'actors', 3, 3, 23),
(10, 'mistakenly', 3, 3, 24),
(11, 'society', 1, 4, 0),
(12, 'members', 3, 4, 0),
(13, 'arrived', 3, 4, 0),
(14, 'find', 1, 4, 0),
(15, 'master', 2, 4, 0),
(16, 'linguist', 2, 4, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;