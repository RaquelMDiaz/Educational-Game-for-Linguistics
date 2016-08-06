-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 22, 2014 at 03:15 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=31 ;

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
