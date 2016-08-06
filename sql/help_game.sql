-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 02, 2015 at 04:32 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `game`
--

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
(26, 'I heard you requested my help... so here I am… APs are adjuncts. That means they merely modify nouns. The NP could stand on its own without it...'),
(27, 'Mmm... a short phrase doesn&#39;t necessarily mean an easy one, does it? Well think about this: what&#39;s the syntactic category of this phrase&#39;s head?'),
(28, 'You need some help? Let&#39;s get to work then, shall we? Because you need to win this now! Remember, remember: a VP must always branch into V&#39;!'),
(29, 'Oh... an AP that seems a bit difficult! Ok, let us think... is this PP a mere adjunct in reference to the head of this phrase or is it something more important?'),
(30, 'Think about how you would use this phrase in a sentence and which parts of it you could easily omit. That should point you to what kind of phrase we have here.'),
(31, 'Remember that optional constituents of a phrase should always be on the same level as a bar node, whereas obligatory constituents may appear at the same level as a terminal node.'),
(32, 'This one is not so hard - thinking about which elements an IP must contain to be complete should help you with this sentence.'),
(33, 'Got confused here? The triangle in this sentence indicates that there is a complete VP at this point, which is just not shown in detail, so don''t worry about it.'),
(34, 'Good question... I hope you find the answer soon. For now, just let me help you with a little hint on this: A WH-element is not classified as a complementizer.');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
