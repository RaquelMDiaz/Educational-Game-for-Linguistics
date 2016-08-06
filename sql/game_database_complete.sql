-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 02, 2015 at 07:53 PM
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
CREATE DATABASE `elt_game` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `elt_game`;

-- --------------------------------------------------------

--
-- Table structure for table `help_source_table`
--

CREATE TABLE IF NOT EXISTS `help_source_table` (
  `help_id` int(11) NOT NULL,
  `help_source` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`help_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `help_source_table`
--

INSERT INTO `help_source_table` (`help_id`, `help_source`) VALUES
(1, '../help/linguist_pronounciation.mp3'),
(2, '../help/master_pronounciation.mp3'),
(3, '../help/transcription_pronounciation.mp3'),
(4, '../help/society_pronounciation.mp3'),
(5, '../help/secret_pronounciation.mp3'),
(6, '../help/power_pronounciation.mp3'),
(7, '../help/language_pronounciation.mp3'),
(8, '../help/famous_pronounciation.mp3'),
(9, '../help/invasion_pronounciation.mp3'),
(10, '../help/challenge_pronounciation.mp3'),
(11, '../help/university_pronounciation.mp3'),
(12, '../help/morphology_pronounciation.mp3'),
(13, '../help/syntax_pronounciation.mp3'),
(14, '../help/phonetics_pronounciation.mp3'),
(15, 'I see you have to identify an inflectional morpheme. Well what best but to remind you of its definition? An inflectional morpheme never changes a word&#39;s category -for example from an adjective to a noun-, but it does serve as tense, number, possession, or comparison markers.'),
(16, 'Oh a stem... Well let&#39;s try with its definition, shall we? A stem is the form of a word before any affixes are attached to it. So which one do you think it is in the case of this word?'),
(17, 'Well in this case you have to identify a derivational morpheme. I think this tip can point you in the right direction: a derivational morpheme always changes the category of a word -for example from a verb to a noun.'),
(18, 'Having some doubts with morphemes? Well there&#39;s more than one type in this word so let&#39;s see if this can help you: only one of these morphemes can serve as a tense marker.'),
(19, 'You need my help? Well I hope this will hint you towards a win: think of the category of this word. Which one is it? Which one is the morpheme that tells you that this word belongs to that category? It always helps to make up an example in your mind.'),
(20, 'Here I am to help you. So let&#39;s see what we have... well as usual with stems, you must take away all the morphemes that are attached to the word. It helps if you take them out one by one and from the end to the very root.'),
(21, 'I can see you&#39;re having some trouble. Ok... let&#39;s see what I can do... So here you have a word with a stem, which you must identify, and morphemes that turn it into an adjective and an adverb. Considering this, what would you say is the initial form of the word?'),
(22, 'I was told you need my help... And I can see that you have to identify a derivational morpheme. Well as you know, a derivational morpheme changes the category of word. And you might remember that one of the morphemes that you have here could be a tense marker, so you might just rule that off...'),
(23, 'Oh an inflectional morpheme... I can see… Well it might help to know that only that type of morpheme indicates number in this word.'),
(24, 'These words are kind of tricky sometimes, but we&#39;ll tackle this. No worries. Remember: which one of all of these building blocks of the word could you classify as, for example, a tense marker?'),
(25, 'Is this VP a bit tricky for you? Let me help you then by posing some questions: remember the constraints for VPs? how must this phrase branch? what&#39;s the category that immediately follows the top?'),
(26, 'I heard you requested my help... so here I am... APs are adjuncts. That means they merely modify nouns. The NP could stand on its own without it...'),
(27, 'Mmm... a short phrase doesn&#39;t necessarily mean an easy one, does it? Well think about this: what&#39;s the syntactic category of this phrase&#39;s head?'),
(28, 'You need some help? Let&#39;s get to work then, shall we? Because you need to win this now! Remember, remember: a VP must always branch into V&#39;!'),
(29, 'Oh... an AP that seems a bit difficult! Ok, let us think... is this PP a mere adjunct in reference to the head of this phrase or is it something more important?'),
(30, 'Think about how you would use this phrase in a sentence and which parts of it you could easily omit. That should point you to what kind of phrase we have here.'),
(31, 'Remember that optional constituents of a phrase should always be on the same level as a bar node, whereas obligatory constituents may appear at the same level as a terminal node.'),
(32, 'This one is not so hard - thinking about which elements an IP must contain to be complete should help you with this sentence.'),
(33, 'Got confused here? The triangle in this sentence indicates that there is a complete VP at this point, which is just not shown in detail, so don''t worry about it.'),
(34, 'Good question... I hope you find the answer soon. For now, just let me help you with a little hint on this: A WH-element is not classified as a complementizer.');

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
-- Table structure for table `phon_answers`
--

CREATE TABLE IF NOT EXISTS `phon_answers` (
  `answer_id` int(10) NOT NULL AUTO_INCREMENT,
  `wd_id` int(10) NOT NULL,
  `tr_id` int(10) NOT NULL,
  `position` int(10) NOT NULL,
  PRIMARY KEY (`answer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(14, 2, 5, 1),
(15, 2, 80, 2),
(16, 2, 3, 3),
(17, 2, 91, 4),
(18, 2, 95, 5),
(19, 2, 93, 6),
(20, 3, 95, 1),
(21, 3, 90, 2),
(22, 3, 6, 3),
(23, 3, 81, 4),
(24, 3, 5, 5),
(25, 3, 91, 6),
(26, 3, 76, 7),
(27, 3, 90, 8),
(28, 3, 74, 9),
(29, 3, 88, 10),
(30, 3, 92, 11),
(31, 3, 81, 12),
(32, 4, 91, 1),
(33, 4, 93, 2),
(34, 4, 5, 3),
(35, 4, 91, 4),
(36, 4, 1, 5),
(37, 4, 74, 6),
(38, 4, 93, 7),
(39, 4, 95, 8),
(40, 4, 72, 9),
(41, 5, 5, 1),
(42, 5, 91, 2),
(43, 5, 73, 3),
(44, 5, 76, 4),
(45, 5, 90, 5),
(46, 5, 93, 6),
(47, 5, 95, 7),
(48, 6, 5, 1),
(49, 6, 88, 2),
(50, 6, 1, 3),
(51, 6, 102, 4),
(52, 6, 93, 5),
(53, 7, 5, 1),
(54, 7, 78, 2),
(55, 7, 6, 3),
(56, 7, 82, 4),
(57, 7, 70, 5),
(58, 7, 104, 6),
(59, 7, 74, 7),
(60, 7, 9, 8),
(61, 8, 5, 1),
(62, 8, 69, 2),
(63, 8, 10, 3),
(64, 8, 74, 4),
(65, 8, 80, 5),
(66, 8, 93, 6),
(67, 8, 91, 7),
(68, 9, 74, 1),
(69, 9, 81, 2),
(70, 9, 5, 3),
(71, 9, 103, 4),
(72, 9, 10, 5),
(73, 9, 74, 6),
(74, 9, 92, 7),
(75, 9, 81, 8),
(76, 10, 5, 1),
(77, 10, 99, 2),
(78, 10, 6, 3),
(79, 10, 78, 4),
(80, 10, 74, 5),
(81, 10, 81, 6),
(82, 10, 9, 7),
(83, 11, 75, 1),
(84, 11, 101, 2),
(85, 11, 81, 3),
(86, 11, 74, 4),
(87, 11, 5, 5),
(88, 11, 103, 6),
(89, 11, 107, 7),
(90, 11, 91, 8),
(91, 11, 93, 9),
(92, 11, 95, 10),
(93, 11, 72, 11),
(94, 12, 80, 1),
(95, 12, 87, 2),
(96, 12, 5, 3),
(97, 12, 69, 4),
(98, 12, 85, 5),
(99, 12, 78, 6),
(100, 12, 93, 7),
(101, 12, 9, 8),
(102, 12, 72, 9),
(103, 13, 5, 1),
(104, 13, 91, 2),
(105, 13, 74, 3),
(106, 13, 81, 4),
(107, 13, 95, 5),
(108, 13, 6, 6),
(109, 13, 76, 7),
(110, 13, 91, 8),
(111, 14, 69, 1),
(112, 14, 93, 2),
(113, 14, 5, 3),
(114, 14, 81, 4),
(115, 14, 10, 5),
(116, 14, 95, 6),
(117, 14, 74, 7),
(118, 14, 76, 8),
(119, 14, 91, 9),
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
(228, 19, 108, 12),
(229, 19, 5, 13),
(230, 19, 73, 14),
(231, 19, 103, 15),
(232, 19, 78, 16),
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
-- Table structure for table `phon_word_transcription`
--

CREATE TABLE IF NOT EXISTS `phon_word_transcription` (
  `trans_id` int(10) NOT NULL AUTO_INCREMENT,
  `img_path` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`trans_id`),
  UNIQUE KEY `img_path` (`img_path`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(107, '../ipa_images/e3_lg.png'),
(13, '../ipa_images/e3.png'),
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(19, 'can depose evil', 0, 5),
(20, 'old Chomsky', 0, 6);

-- --------------------------------------------------------

--
-- Table structure for table `questions_table`
--

CREATE TABLE IF NOT EXISTS `questions_table` (
  `question` int(11) NOT NULL AUTO_INCREMENT,
  `quest_text` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `correct` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `incorrect1` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `incorrect2` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `incorrect3` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `quest_topic` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`question`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `questions_table`
--

INSERT INTO `questions_table` (`question`, `quest_text`, `correct`, `incorrect1`, `incorrect2`, `incorrect3`, `quest_topic`) VALUES
(1, 'What is the definition of phonology?', 'Phonology is the study of the sound system of a language.', 'Phonology is the study of the perception of sounds of a language.', 'Phonology is the study of the articulation of sounds of a language.', 'Phonology is the study of the physical production, acoustic transmission and perception of the sounds of speech.', '1'),
(2, 'What is the definition of phonetics?', 'Phonetics is the study of the physical production, acoustic transmission and perception of the sounds of speech.', 'Phonetics is the study of the sound system of a language.', 'Phonetics is the study of the structure of language.', 'Phonetics is the study of the allophones of a language.', '1'),
(3, 'What is the difference between phonology and phonetics?', 'While phonetics concerns the physical production, acoustic transmission and perception of the sounds of speech, phonology describes the way sounds function within a given language or across languages to encode meaning.', 'Phonology is concerned with the physical production of sounds, whereas phonetics studies the sound patterns of a language.', 'Both disciplines are the same thing.', 'Phonology studies the sound system of a language and phonetics studies the sound system across languages.', '1'),
(4, 'Which one is a correct place of articulation?', 'Retroflex.', 'Fricative.', 'Trill.', 'Plosive.', '1'),
(5, 'Which one is NOT a manner of articulation?', 'Glottal.', 'Lateral approximant.', 'Nasal.', 'Lateral fricative.', '1'),
(6, 'Select the correct statement.', 'The study of the physical transmission of speech sounds from the speaker to the listener is referred to as acoustic phonetics.', 'The study of the physical transmission of speech sounds from the speaker to the listener is referred to as acoustic phonology.', 'The study of the reception and perception of speech sounds by the listener is referred to as acoustic phonetics.', 'The study of the production of speech sounds by the articulatory and vocal tract by the speaker is referred to as acoustic phonetics.', '1'),
(7, 'Select the incorrect statement.', 'Tonal languages are very common in Europe.', 'An allophone is one of a set of multiple possible spoken sounds used to pronounce a single phoneme.', 'A phone is a physical realization of a speech sound.', 'A phoneme is the smallest linguistic unit that may imply a change of meaning.', '1'),
(8, 'A tone language is...', '... a language whose different tones change the meaning of the words.', '... a language with at least six different tones.', '... a language whose different tones are allophones of a series of phonemes.', '... a language whose tones entail syntactical differences among words.', '1'),
(9, 'What is a phoneme?', 'The smallest contrastive linguistic unit which may bring about a change of meaning.', 'It is a synonym of phone.', 'It is a unit of speech.', 'It is one of a set of spoken sounds used to pronounce one single phone.', '1'),
(10, 'What is a phone?', 'It is a unit of speech sound.', 'It is a unit that distinguishes meaning.', 'It is a synonym of phoneme.', 'It is one of the allophonic variances of a phoneme.', '1'),
(11, 'What is the definition of morphology?', 'Morphology is the study of the structure of words.', 'Morphology is the study of the structure of morphemes.', 'Morphology is the study of morphs.', 'Morphology is the study of the meaning of words.', '2'),
(12, 'What is a morpheme?', 'It is the smallest meaningful unit of a language.', 'It is a type of morph.', 'It is the smallest unit of a language without meaning.', 'It is a bound morph.', '2'),
(13, 'What is an allomorph?', 'It is a variant of a morpheme.', 'It is the same as a morph.', 'It is the realization of a morpheme.', 'It is a stem.', '2'),
(14, 'Select the incorrect statement.', 'Derivational morphemes do not change the word category.', 'Inflectional morphemes assign a particular grammatical category to a word, but do not change its meaning.', 'A stem is a part of a word to which affixes are attached.', 'The morpheme &#39;-ing&#39; is a type of derivational morpheme.', '2'),
(15, 'Select the correct statement.', 'Derivational morphemes are attached to the stem to change its meaning.', 'Stem and base are the same thing.', 'Inflectional morphemes do not change the word category of the word they are attached to.', 'A morph is the smallest unit of language with meaning.', '2'),
(16, 'What is a morph?', 'It is the realization of a morpheme.', 'It is one of the variants of a morpheme.', 'It is the theoretical description of a morpheme.', 'It is a synonym of morpheme.', '2'),
(17, 'What is the difference between a morph and a morpheme?', 'A morpheme is the smallest unit of meaning of from a theoretical point of view; a morph is its realization.', 'They are the same thing.', 'A morpheme consists of different morphs.', 'A moph is the building block of a word and a morpheme is its actual realization.', '2'),
(18, 'What is a compound?', 'It is a lexeme that consists of more than one stem.', 'It is a lexeme that consists of a stem and a derivational morpheme.', 'It is a lexeme that consists of a stem and an inflectional morpheme.', 'It is a word that consists of two lexemes.', '2'),
(19, 'A bound morph is...', '... a type of morph that cannot stand on its own.', '... a type of morph that can stand on its own.', '... a type of inflectional morpheme.', '... a type of morph whose position is constrained by its context.', '2'),
(20, 'Affixation is...', '... a process of word formation by which affixes are added to a stem to create a different form of that stem or a new word with a different meaning.', '... a process of word formation by which infixes are added to a stem.', '... a process of word formation by which only prefixes and suffixes are added to a stem to change its meaning.', '... a process of word formation by which the category of a word is altered.', '2'),
(21, 'What is syntax concerned with?', 'It is concerned with the study of the rules that govern the combination of words into phrases, clauses and sentences.', 'It is concerned with the study of the structure of phrases.', 'It is concerned with the study of clause structure.', 'It is concerned with the study of rules of generative grammar.', '3'),
(22, 'What is a syntactic tree?', 'It is the visual representation of a phrase or a clause&#39;s structure.', 'It is the visual representation of clausal structure.', 'It is a theory coined by generative grammarians.', 'It is the visual representation of a set of phrases combined together.', '3'),
(23, 'Select the correct constriction.', 'CP -> Spec C&#39;', 'NP -> N', 'C&#39; -> IP', 'C -> COMP IP', '3'),
(24, 'Which one of the following is NOT a correct constriction?', 'I -> INFL VP', 'VP -> V&#39;', 'V&#39; -> V&#39; NP', 'V&#39; -> V NP', '3'),
(25, 'Who was the pioneer of generative grammar?', 'Noam Chomsky.', 'Ray Jackendoff.', 'Otto Jespersen.', 'August Schleicher.', '3'),
(26, 'What is the superordinate principle of Generative Grammar?', 'Grammaticality.', 'Competence.', 'Performance.', 'X-bar syntactic analysis.', '3'),
(27, 'A lexical category is...', '... a terminal node.', '... a phrase.', '... a morpheme.', '... the top element of a tree analysis.', '3'),
(28, 'What is the definition of linguistic performance?', 'Linguistic performance is the actual use of language in concrete situations.', 'Linguistic performance is the linguistic knowledge that a native speaker has of his/her own language.', 'Linguistic performance is the ability of a native speaker to use his/her language creatively.', 'Linguistic performance is the use of language in any given, real situation.', '3'),
(29, 'Which of the following is NOT a syntactic category?', 'Subject.', 'Noun.', 'Verb.', 'Preposition.', '3'),
(30, 'What is the definition of linguistic competence?', 'Linguistic competence is the system of linguistic knowledge possessed by native speakers of a language.', 'Linguistic competence is the actual use of language by its native speakers.', 'Linguistic competence is the actual use of language by either native or non-native speakers.', 'Linguistic competence is the system of linguistic knowledge possessed by all speakers of a language.', '3');

-- --------------------------------------------------------

--
-- Table structure for table `syntax_incorrect`
--

CREATE TABLE IF NOT EXISTS `syntax_incorrect` (
  `incorrect_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tree_id` int(10) unsigned NOT NULL,
  `phrase_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`incorrect_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `topic_table`
--

CREATE TABLE IF NOT EXISTS `topic_table` (
  `topic` int(11) NOT NULL,
  `topic_name` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`topic`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `topic_table`
--

INSERT INTO `topic_table` (`topic`, `topic_name`) VALUES
(1, 'phonology'),
(2, 'morphology'),
(3, 'syntax');

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

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_ID`, `user_name`, `password`, `unlocked_towers`, `name1`, `name2`, `name3`, `name4`, `name5`, `name6`, `name7`, `collected_sentences`, `tree_task_completed`, `phon_power`, `morph_power`, `syn_power`, `phon_seen_items`, `morph_seen_items`, `syn_seen_items`, `phon_seen_mc_questions`, `morph_seen_mc_questions`, `syn_seen_mc_questions`, `everything_completed`) VALUES
(11, 'Jule', '1234', '', 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '', '', '', '', '', '', 0),
(12, 'test', '1234', '', 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '', '', '', '', '', '', 0),
(13, 'New User', '1234', '1,3,2', 1, 1, 1, 0, 0, 0, 0, 'Majla ut Unan loserorodena soni.,Hunan ut Majla Hoamanis lameonvelia soni.,Nojman Majlatis lameon san.,Mun Lihlatis losero san.,Austen Unanis purfuertan san.,Hunan Majlatis pafuertan san.', 0, 0, 1, 1, '11,6,13,14,12', '6,5,4,10,1', '6,5,9,10,8,7,3,2,4', '1,4,3,10,5,2', '', '23,24,30', 0),
(14, 'new Player', '1234', '3,1', 1, 1, 0, 0, 0, 0, 0, 'Majla ut Unan loserorodena soni.,Hunan ut Majla Hoamanis lameonvelia soni.,Nojman Majlatis lameon san.', 0, 0, 0, 0, '9,5,10,13,2,7,6,11,12,14', '', '2,4,3,6,1,5,9,7,10,8', '5', '', '25', 0);

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
