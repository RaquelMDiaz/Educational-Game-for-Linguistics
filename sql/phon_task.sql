-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2014 at 10:47 PM
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
-- Table structure for table `phon_answers`
--

CREATE TABLE IF NOT EXISTS `phon_answers` (
  `answer_id` int(10) NOT NULL AUTO_INCREMENT,
  `wd_id` int(10) NOT NULL,
  `tr_id` int(10) NOT NULL,
  `position` int(10) NOT NULL,
  PRIMARY KEY (`answer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=245 ;

--
-- Dumping data for table `phon_answers`
--

INSERT INTO `phon_answers` (`answer_id`, `wd_id`, `tr_id`, `position`) VALUES
(2, 1, 5, 1),
(3, 1, 78, 2),
(4, 1, 74, 3),
(5, 1, 82, 4),
(6, 1, 70, 5),
(7, 1, 104, 6),
(8, 1, 74, 7),
(9, 1, 91, 8),
(10, 1, 95, 9),
(11, 1, 90, 0),
(12, 1, 94, 0),
(13, 1, 97, 0),
(14, 2, 5, 1),
(15, 2, 80, 2),
(16, 2, 3, 3),
(17, 2, 91, 4),
(18, 2, 95, 5),
(19, 2, 93, 6),
(120, 15, 98, 1),
(121, 15, 93, 2),
(122, 15, 108, 3),
(123, 15, 5, 4),
(124, 15, 80, 5),
(125, 15, 10, 6),
(126, 15, 80, 7),
(127, 15, 7, 8),
(128, 15, 93, 9),
(129, 15, 105, 10),
(130, 15, 108, 11),
(131, 15, 93, 12),
(132, 15, 103, 13),
(133, 15, 108, 14),
(134, 15, 98, 15),
(135, 15, 93, 16),
(136, 15, 108, 17),
(137, 15, 91, 18),
(138, 15, 93, 19),
(139, 15, 5, 20),
(140, 15, 91, 21),
(141, 15, 1, 22),
(142, 15, 74, 23),
(143, 15, 93, 24),
(144, 15, 95, 25),
(145, 15, 72, 26),
(146, 16, 71, 1),
(147, 16, 93, 2),
(148, 16, 103, 3),
(149, 16, 108, 4),
(150, 16, 93, 5),
(151, 16, 5, 6),
(152, 16, 90, 7),
(153, 16, 1, 8),
(154, 16, 74, 9),
(155, 16, 103, 10),
(156, 16, 8, 11),
(157, 16, 108, 12),
(158, 16, 95, 13),
(159, 16, 93, 14),
(160, 16, 108, 15),
(161, 16, 80, 16),
(162, 16, 1, 17),
(163, 16, 90, 18),
(164, 16, 7, 19),
(165, 16, 101, 20),
(166, 16, 90, 21),
(167, 16, 70, 22),
(168, 17, 95, 1),
(169, 17, 93, 2),
(170, 17, 108, 3),
(171, 17, 69, 4),
(172, 17, 1, 5),
(173, 17, 74, 6),
(174, 17, 81, 7),
(175, 17, 8, 8),
(176, 17, 108, 9),
(177, 17, 98, 10),
(178, 17, 10, 11),
(179, 17, 93, 12),
(180, 17, 108, 13),
(181, 17, 81, 14),
(182, 17, 75, 15),
(183, 17, 101, 16),
(184, 17, 108, 17),
(185, 17, 5, 18),
(186, 17, 80, 19),
(187, 17, 3, 20),
(188, 17, 91, 21),
(189, 17, 95, 22),
(190, 17, 93, 23),
(191, 18, 93, 1),
(192, 18, 81, 2),
(193, 18, 8, 3),
(194, 18, 108, 4),
(195, 18, 5, 5),
(196, 18, 93, 6),
(197, 18, 102, 7),
(198, 18, 81, 8),
(199, 18, 78, 9),
(200, 18, 72, 10),
(201, 18, 108, 11),
(202, 18, 93, 12),
(203, 18, 108, 13),
(204, 18, 95, 14),
(205, 18, 90, 15),
(206, 18, 101, 16),
(207, 18, 108, 17),
(208, 18, 5, 18),
(209, 18, 78, 19),
(210, 18, 74, 20),
(211, 18, 82, 21),
(212, 18, 70, 22),
(213, 18, 104, 23),
(214, 18, 74, 24),
(215, 18, 91, 25),
(216, 18, 95, 26),
(217, 19, 76, 1),
(218, 19, 93, 2),
(219, 19, 81, 3),
(220, 19, 108, 4),
(221, 19, 8, 5),
(222, 19, 74, 6),
(223, 19, 5, 7),
(224, 19, 88, 8),
(225, 19, 93, 9),
(226, 19, 102, 10),
(227, 19, 105, 11),
(233, 20, 93, 1),
(234, 20, 102, 2),
(235, 20, 78, 3),
(236, 20, 8, 4),
(237, 20, 108, 5),
(238, 20, 5, 6),
(239, 20, 99, 7),
(240, 20, 3, 8),
(241, 20, 80, 9),
(242, 20, 91, 10),
(243, 20, 76, 11),
(244, 20, 72, 12);

-- --------------------------------------------------------

--
-- Table structure for table `phon_words`
--

CREATE TABLE IF NOT EXISTS `phon_words` (
  `word_id` int(10) NOT NULL AUTO_INCREMENT,
  `word` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `h_id` int(11) NOT NULL,
  `challenge_id` int(11) NOT NULL,
  PRIMARY KEY (`word_id`),
  UNIQUE KEY `word` (`word`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=21 ;

--
-- Dumping data for table `phon_words`
--

INSERT INTO `phon_words` (`word_id`, `word`, `h_id`, `challenge_id`) VALUES
(1, 'linguist', 1, 0),
(2, 'master', 2, 0),
(3, 'transcription', 3, 0),
(4, 'society', 4, 0),
(5, 'secret', 5, 0),
(6, 'power', 6, 0),
(7, 'language', 7, 0),
(8, 'famous', 8, 0),
(9, 'invasion', 9, 0),
(10, 'challenge', 10, 0),
(11, 'university', 11, 0),
(12, 'morphology', 12, 0),
(13, 'syntax', 13, 0),
(14, 'phonetics', 14, 0),
(15, 'The members of the Society', 0, 1),
(16, 'have arrived to Marburg', 0, 2),
(17, 'to find their new Master', 0, 3),
(18, 'and only a true linguist', 0, 4),
(19, 'can depose', 0, 5),
(20, 'old Chomsky', 0, 6);

-- --------------------------------------------------------

--
-- Table structure for table `phon_word_transcription`
--

CREATE TABLE IF NOT EXISTS `phon_word_transcription` (
  `trans_id` int(10) NOT NULL AUTO_INCREMENT,
  `img_path` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`trans_id`),
  UNIQUE KEY `img_path` (`img_path`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=107 ;

--
-- Dumping data for table `phon_word_transcription`
--

INSERT INTO `phon_word_transcription` (`trans_id`, `img_path`) VALUES
(1, '../ipa_images/a1.png'),
(3, '../ipa_images/a2_lg.png'),
(2, '../ipa_images/a2.png'),
(4, '../ipa_images/a3.png'),
(5, '../ipa_images/accent.png'),
(6, '../ipa_images/ae.png'),
(7, '../ipa_images/b.png'),
(8, '../ipa_images/d.png'),
(9, '../ipa_images/dz.png'),
(10, '../ipa_images/e1.png'),
(12, '../ipa_images/e2_lg.png'),
(11, '../ipa_images/e2.png'),
(13, '../ipa_images/e3.png'),
(107, '../ipa_images/empty.png'),
(69, '../ipa_images/f.png'),
(70, '../ipa_images/g.png'),
(71, '../ipa_images/h.png'),
(73, '../ipa_images/i1_lg.png'),
(72, '../ipa_images/i1.png'),
(74, '../ipa_images/i2.png'),
(75, '../ipa_images/j.png'),
(77, '../ipa_images/k_asp.png'),
(76, '../ipa_images/k.png'),
(78, '../ipa_images/l.png'),
(79, '../ipa_images/l2.png'),
(80, '../ipa_images/m.png'),
(81, '../ipa_images/n.png'),
(82, '../ipa_images/ng.png'),
(84, '../ipa_images/o1_lg.png'),
(83, '../ipa_images/o1.png'),
(85, '../ipa_images/o2.png'),
(87, '../ipa_images/o3_lg.png'),
(86, '../ipa_images/o3.png'),
(89, '../ipa_images/p_asp.png'),
(88, '../ipa_images/p.png'),
(90, '../ipa_images/r.png'),
(91, '../ipa_images/s.png'),
(92, '../ipa_images/s2.png'),
(94, '../ipa_images/shwa_lg.png'),
(93, '../ipa_images/shwa.png'),
(108, '../ipa_images/space.png'),
(96, '../ipa_images/t_asp.png'),
(95, '../ipa_images/t.png'),
(97, '../ipa_images/th1.png'),
(98, '../ipa_images/th2.png'),
(99, '../ipa_images/ts.png'),
(101, '../ipa_images/u1_lg.png'),
(100, '../ipa_images/u1.png'),
(102, '../ipa_images/u2.png'),
(103, '../ipa_images/v.png'),
(104, '../ipa_images/w.png'),
(105, '../ipa_images/z.png'),
(106, '../ipa_images/z2.png');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
