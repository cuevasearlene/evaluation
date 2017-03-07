-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 06, 2017 at 05:51 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cvsu_evaluation`
--

-- --------------------------------------------------------

--
-- Table structure for table `evaluation`
--

CREATE TABLE `evaluation` (
  `id` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `category` varchar(255) DEFAULT NULL,
  `page_size` int(11) DEFAULT NULL,
  `created_at` varchar(50) DEFAULT NULL,
  `expired_at` varchar(50) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `evaluation`
--

INSERT INTO `evaluation` (`id`, `title`, `description`, `category`, `page_size`, `created_at`, `expired_at`, `uid`) VALUES
('58b5f989679ef', 'john enrico comia final', 'ddsadsadasdasdsadsaddsadsadasdasdsadsaddsadsadasdasdsadsaddsadsadasdasdsadsaddsadsadasdasdsadsaddsadsadasdasdsadsaddsadsadasdasdsadsaddsadsadasdasdsadsaddsadsadasdasdsadsaddsadsadasdasdsadsaddsadsadasdasdsadsaddsadsadasdasdsadsa', 'seminar', 10, '2017-03-01 06:28:25', '2017-03-31', NULL),
('58b29e24aab43', 'Asdsadasds johnenrico', '                   cadassadcadassadcadassadcadassadcadassadcaddsadassadcadassadcadassad                   ', 'seminar', 1, '2017-02-26 17:21:40', '2017-02-26', NULL),
('58b2b83ba3845', 'tadasdtadasdtadasdtadasd', 'tadasdtadasdtadasdtadasdtadasdtadasdtadasdtadasdtadasdtadasdtadasdtadasdtadasdtadasdtadasdtadasd', 'seminar', 1, '2017-02-26 19:12:59', '2017-03-03', NULL),
('58b2b87635708', 'dasdsadasdsadasdsadasdsadasdsa', 'dasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsa', 'seminar', 1, '2017-02-26 19:13:58', '2017-03-02', NULL),
('58b2b8b5ac1e3', 'John', 'dasdadsadsadsadasdadsadsadsadasdadsadsadsadasdadsadsadsadasdadsadsadsadasdadsadsadsa', 'seminar', 1, '2017-02-26 19:15:01', '2017-03-10', NULL),
('58b2b96ebabfc', 'dasdadsadsadsadasdadsadsadsa', 'dasdadsadsadsadasdadsadsadsadasdadsadsadsadasdadsadsadsadasdadsadsadsadasdadsadsadsa', 'seminar', 1, '2017-02-26 19:18:06', '2017-03-10', NULL),
('58b2b9afe7aa6', 'dasdadsadsadsadasdadsadsadsa', 'dasdadsadsadsadasdadsadsadsadasdadsadsadsadasdadsadsadsadasdadsadsadsadasdadsadsadsa', 'seminar', 1, '2017-02-26 19:19:11', '2017-03-10', NULL),
('58b2b9cc1efb2', 'dasdadsadsadsadasdadsadsadsa', 'dasdadsadsadsadasdadsadsadsadasdadsadsadsadasdadsadsadsadasdadsadsadsadasdadsadsadsa', 'seminar', 1, '2017-02-26 19:19:40', '2017-03-10', NULL),
('58b2ba065a200', 'dasdadsadsadsadasdadsadsadsa', 'dasdadsadsadsadasdadsadsadsadasdadsadsadsadasdadsadsadsadasdadsadsadsadasdadsadsadsa', 'seminar', 1, '2017-02-26 19:20:38', '2017-03-10', NULL),
('58b2ba1459c93', 'dasdadsadsadsadasdadsadsadsa', 'dasdadsadsadsadasdadsadsadsadasdadsadsadsadasdadsadsadsadasdadsadsadsadasdadsadsadsa', 'seminar', 1, '2017-02-26 19:20:52', '2017-03-10', NULL),
('58b2ba1cdb506', 'dasdadsadsadsadasdadsadsadsa', 'dasdadsadsadsadasdadsadsadsadasdadsadsadsadasdadsadsadsadasdadsadsadsadasdadsadsadsa', 'seminar', 1, '2017-02-26 19:21:00', '2017-03-10', NULL),
('58b2ba3051d12', 'dasdadsadsadsadasdadsadsadsa', 'dasdadsadsadsadasdadsadsadsadasdadsadsadsadasdadsadsadsadasdadsadsadsadasdadsadsadsa', 'seminar', 1, '2017-02-26 19:21:20', '2017-03-10', NULL),
('58b2bb0511868', 'dasdadsadsadsadasdadsadsadsa', 'dasdadsadsadsadasdadsadsadsadasdadsadsadsadasdadsadsadsadasdadsadsadsadasdadsadsadsa', 'seminar', 1, '2017-02-26 19:24:53', '2017-03-10', NULL),
('58b2bb867c9fa', 'dsdasdasdasdsadasdsdasdasdasdsadasdsdasdasdasdsadas', 'dsdasdasdasdsadasdsdasdasdasdsadasdsdasdasdasdsadasdsdasdasdasdsadasdsdasdasdasdsadas', 'seminar', 1, '2017-02-26 19:27:02', '2017-03-10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `evaluation_attachment`
--

CREATE TABLE `evaluation_attachment` (
  `id` int(11) NOT NULL,
  `name` text,
  `evaluation_id` varchar(255) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `created_at` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `evaluation_authorize`
--

CREATE TABLE `evaluation_authorize` (
  `id` int(11) NOT NULL,
  `evaluator_id` int(11) DEFAULT NULL,
  `evaluation_id` varchar(255) DEFAULT NULL,
  `evaluated` tinyint(1) NOT NULL DEFAULT '0',
  `uid` int(11) NOT NULL,
  `created_at` varchar(50) NOT NULL,
  `evaluated_at` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `evaluation_authorize`
--

INSERT INTO `evaluation_authorize` (`id`, `evaluator_id`, `evaluation_id`, `evaluated`, `uid`, `created_at`, `evaluated_at`) VALUES
(1, 4, '58b2b8b5ac1e3', 1, 1, '2017-02-28 23:20:38', '2017-02-28 23:20:38'),
(2, 5, '58b2b8b5ac1e3', 0, 1, '2017-02-28 23:20:38', '2017-02-28 23:20:38'),
(3, 6, '58b2b8b5ac1e3', 0, 1, '2017-02-28 23:20:38', '2017-02-28 23:20:38'),
(4, 7, '58b2b8b5ac1e3', 0, 1, '2017-02-28 23:20:38', '2017-02-28 23:20:38'),
(5, 9, '58b2b8b5ac1e3', 0, 1, '2017-02-28 23:20:38', '2017-02-28 23:20:38'),
(6, 10, '58b2b8b5ac1e3', 0, 1, '2017-02-28 23:20:38', ''),
(7, 11, '58b2b8b5ac1e3', 0, 1, '2017-02-28 23:20:38', ''),
(8, 12, '58b2b8b5ac1e3', 0, 1, '2017-02-28 23:20:38', ''),
(9, 13, '58b2b8b5ac1e3', 0, 1, '2017-02-28 23:20:38', ''),
(10, 14, '58b2b8b5ac1e3', 0, 1, '2017-02-28 23:20:38', ''),
(11, 15, '58b2b8b5ac1e3', 0, 1, '2017-02-28 23:20:38', ''),
(12, 16, '58b2b8b5ac1e3', 1, 1, '2017-02-28 23:20:38', ''),
(13, 17, '58b2b8b5ac1e3', 0, 1, '2017-02-28 23:20:38', '');

-- --------------------------------------------------------

--
-- Table structure for table `evaluation_comment`
--

CREATE TABLE `evaluation_comment` (
  `id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `comment` text,
  `created_at` varchar(55) DEFAULT NULL,
  `evaluation_id` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `evaluation_comment`
--

INSERT INTO `evaluation_comment` (`id`, `uid`, `comment`, `created_at`, `evaluation_id`) VALUES
(1, 1, 'dsadsadsadsa', '2017-02-28 23:20:38', '58b5f989679ef'),
(2, 1, 'dsadsadsadsa', '2017-02-28 23:20:38', '58b5f989679ef');

-- --------------------------------------------------------

--
-- Table structure for table `evaluation_ratings`
--

CREATE TABLE `evaluation_ratings` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  `evaluation_id` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `evaluation_ratings`
--

INSERT INTO `evaluation_ratings` (`id`, `uid`, `rate`, `evaluation_id`, `created_at`) VALUES
(1, 1, 1, '58b5f989679ef', '2017-02-28 23:20:38');

-- --------------------------------------------------------

--
-- Table structure for table `evaluation_summary`
--

CREATE TABLE `evaluation_summary` (
  `id` int(11) NOT NULL,
  `question_id` int(11) DEFAULT NULL,
  `answer_id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `evaluation_summary`
--

INSERT INTO `evaluation_summary` (`id`, `question_id`, `answer_id`, `uid`, `created_at`) VALUES
(1, 1, 24, 1, NULL),
(2, 3, 25, 3, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `evaluation_summary_other`
--

CREATE TABLE `evaluation_summary_other` (
  `id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `text` text NOT NULL,
  `uid` int(11) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `evaluation_summary_other`
--

INSERT INTO `evaluation_summary_other` (`id`, `question_id`, `text`, `uid`, `created_at`) VALUES
(1, 1, 'asdasd', 1, ''),
(2, 1, 'dsadasda', 4, '');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `action` varchar(50) NOT NULL,
  `details` text NOT NULL,
  `created_at` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE `module` (
  `modid` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT '0',
  `mod_name` varchar(255) DEFAULT NULL,
  `mod_alias` varchar(255) DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `permalink` varchar(255) DEFAULT NULL,
  `mod_order` int(11) DEFAULT '0',
  `published` enum('y','n') DEFAULT 'y',
  `created` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`modid`, `parent_id`, `mod_name`, `mod_alias`, `icon`, `permalink`, `mod_order`, `published`, `created`) VALUES
(1, 0, 'Evaluation', 'evaluation', 'fa fa-check', 'evaluation', 2, 'y', NULL),
(2, 0, 'Users', 'users', 'ion-android-social', 'users', 4, 'y', NULL),
(3, 0, 'User Group', 'user_group', 'fa fa-lock', 'usergroup', 5, 'y', NULL),
(4, 0, 'Question', 'question', 'fa fa-question', 'question', 3, 'y', NULL),
(5, 0, 'Settings', 'settings', 'ion-gear-a', 'settings', 6, 'y', NULL),
(6, 0, 'Logs', 'logs', ' md-history', 'logs', 7, 'y', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `id` int(11) NOT NULL,
  `type` enum('single','multiple','single_custom','multiple_custom') NOT NULL,
  `question` text,
  `category` varchar(255) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `created_at` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`id`, `type`, `question`, `category`, `uid`, `created_at`) VALUES
(1, 'single_custom', 'johnendasdasjohnendasdasjohnendasdasjohnendasdasjohnendasdasjohnendasdasjohnendasdasjohnendasdas', 'seminar', 1, '2017-02-25 00:07:46'),
(2, 'single_custom', 'test johntest johntest johntest john', 'seminar', 1, '2017-02-25 00:07:50'),
(3, 'single', 'dasddasddasddasddasddasddasddasddasddasddasddasddasddasddasddasddasddasddasddasddasddasddasddasddasddasddasddasddasddasddasddasddasddasddasd', '', 1, '2017-02-25 00:22:59'),
(4, 'single', 'dasdsaddasdsaddasdsaddasdsaddasdsaddasdsaddasdsadadadasddasdsaddasdsaddasdsaddasdsaddasdsaddasdsaddasdsadadadasddasdsaddasdsaddasdsaddasdsaddasdsaddasdsaddasdsadadadasd', '', 1, '2017-02-25 00:29:14'),
(5, 'single', 'dasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdas', '', 1, '2017-02-25 00:32:02'),
(6, 'single', 'sadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasd', '', 1, '2017-02-25 00:35:22'),
(7, 'single', 'sadsasadsasadsasadsasadsasadsasadsasadsasadsasadsa', '', 1, '2017-02-25 00:37:28'),
(8, 'single', 'dsadsasasasadsadsasasasadsadsasasasadsadsasasasadsadsasasasadsadsasasasadsadsasasasadsadsasasasadsadsasasasa', '', 1, '2017-02-25 00:38:57'),
(9, 'single', 'adsaadsaadsaadsaadsaadsaadsaadsaadsaadsaadsaadsa', '', 1, '2017-02-25 00:41:20'),
(10, 'single', 'dasdasdsadasdasdasdasdsadasdasdasdasdsadasdasdasdasdsadasdasdasdasdsadasdasdasdasdsadasdas', '', 1, '2017-02-25 00:44:06'),
(11, 'single', 'dasdasdsadasdasdasdasdsadasdas', '', 1, '2017-02-25 00:44:09'),
(12, 'single', 'dasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsa', '', 1, '2017-02-25 00:45:26'),
(13, 'single', 'dasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsa', '', 1, '2017-02-25 00:47:51'),
(14, 'single', 'dasdsaadasdsaadasdsaadasdsaadasdsaadasdsaadasdsaadasdsaadasdsaadasdsaadasdsaadasdsaadasdsaadasdsaadasdsaadasdsaadasdsaadasdsaadasdsaadasdsaadasdsaadasdsaadasdsaadasdsaa', '', 1, '2017-02-25 10:15:18'),
(15, 'single', 'sadsadsadsadsadsadsadsadsadsadsadsadsadsadsadsadsadsadsadsadsadsadsadsadsadsadsadsad', '', 1, '2017-02-25 10:20:32'),
(16, 'single', 'dsadadasdsadadasdsadadasdsadadasdsadadasdsadadasdsadadasdsadadasdsadadasdsadadasdsadadasdsadadas', '', 1, '2017-02-25 10:20:45'),
(17, 'single', 'ddassdsddassdsddassdsddassdsddassdsddassdsddassdsddassds', '', 1, '2017-02-25 10:47:52'),
(18, 'single', 'dasdasdsadasdasdasdsadasdasdasdsadasdasdasdsadasdasdasdsadas', '', 1, '2017-02-25 10:48:20'),
(24, 'single', 'what is bla bla blawhat is bla bla blawhat is bla bla bla', '', 1, '2017-02-28 21:05:07'),
(25, 'single', 'testingtestingtestingtestingtestingtestingtestingtestingtestingtestingtestingtestingtestingtestingtestingtestingtestingtestingtestingtestingtestingtestingtestingtestingtestingtestingtestingtestingtestingtesting', 'type', 1, '2017-02-28 21:09:37'),
(20, 'single', 'sdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasda', 'seminar', 1, '2017-02-25 16:22:23'),
(21, 'single', 'fasfsafasfsafasfsafasfsafasfsafasfsafasfsafasfsafasfsafasfsafasfsafasfsafasfsafasfsafasfsafasfsafasfsafasfsafasfsafasfsafasfsafasfsafasfsafasfsafasfsafasfsafasfsafasfsafasfsafasfsafasfsafasfsafasfsafasfsafasfsafasfsafasfsafasfsafasfsafasfsafasfsafasfsafasfsafasfsafasfsafasfsafasfsafasfsafasfsafasfsafasfsafasfsafasfsafasfsafasfsafasfsafasfsafasfsafasfsafasfsa', 'seminar', 1, '2017-02-25 16:22:57'),
(22, 'single', '`asdas`asdas`asdas`asdas`asdas`asdas`asdas`asdas`asdas`asdas`asdas`asdas`asdas`asdas`asdas', 'seminar', 1, '2017-02-25 16:27:52'),
(23, 'single', 'tsdsadsatsdsadsatsdsadsatsdsadsatsdsadsatsdsadsatsdsadsatsdsadsatsdsadsadsadsa', 'seminar', 1, '2017-02-25 16:28:11'),
(26, 'single', 'dsadadsadsaddsadadsadsaddsadadsadsaddsadadsadsaddsadadsadsaddsadadsadsaddsadadsadsaddsadadsadsaddsadadsadsaddsadadsadsaddsadadsadsaddsadadsadsaddsadadsadsaddsadadsadsaddsadadsadsaddsadadsadsaddsadadsadsaddsadadsadsaddsadadsadsaddsadadsadsad', '', 1, '2017-02-28 21:43:09'),
(27, 'single', '                          dsadsa', '', 1, '2017-02-28 21:45:34'),
(28, 'single', '                          sdad', '', 1, '2017-02-28 21:45:47'),
(29, 'single', 'dsadsadsadsasadsadasdsadsadsadsasadsadasdsadsadsadsasadsadas', '', 1, '2017-02-28 21:46:48'),
(30, 'single', 'sadsadsasadsadsasadsadsasadsadsasadsadsa', 'seminar', 1, '2017-02-28 21:47:53'),
(31, 'single', 'dsadsadsadsadsadsadsadsadsadsadsadsadsadsadsadsadsadsadsadsadsadsadsadsa', 'seminar', 1, '2017-02-28 21:48:19'),
(32, 'single', 'dasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasddasdasd', '', 1, '2017-02-28 23:54:08'),
(33, 'single', 'dsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadasdsadas', 'seminar', 1, '2017-03-07 00:46:19');

-- --------------------------------------------------------

--
-- Table structure for table `question_choices`
--

CREATE TABLE `question_choices` (
  `id` int(11) NOT NULL,
  `text` text,
  `question_eval_id` int(11) DEFAULT NULL,
  `created_at` varchar(55) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question_choices`
--

INSERT INTO `question_choices` (`id`, `text`, `question_eval_id`, `created_at`) VALUES
(24, 'True', 1, NULL),
(25, 'True', 6, NULL),
(26, 'False', 1, NULL),
(27, 'False', 15, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `question_evaluation`
--

CREATE TABLE `question_evaluation` (
  `id` int(11) NOT NULL,
  `evaluation_id` varchar(255) NOT NULL,
  `question_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question_evaluation`
--

INSERT INTO `question_evaluation` (`id`, `evaluation_id`, `question_id`) VALUES
(1, '58b2b8b5ac1e3', 1),
(15, '58b2b8b5ac1e3', 2),
(16, '58b5f989679ef', 33);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `data` text,
  `uid` int(11) DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `data`, `uid`, `created_at`) VALUES
(1, 'filetype', 'jpeg,docs,docx,png,jpg', 1, NULL),
(2, 'user', 'seminar,exam', 1, NULL),
(4, 'question', 'seminar,exam,rating', 1, NULL),
(3, 'topic', 'seminar,exam', 1, NULL),
(5, 'sms', '{"device_id":"34397","email":"evaluationApp@gmail.com","password":"thesisthree3"}', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `guid` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `remember_token` text,
  `verification_code` varchar(255) DEFAULT NULL,
  `reset_code` varchar(50) DEFAULT NULL,
  `created_at` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `category`, `username`, `password`, `guid`, `name`, `email`, `phone`, `remember_token`, `verification_code`, `reset_code`, `created_at`) VALUES
(1, 'seminar', 'supersu', 'YzNWd1pYSnpkVEV5TXpRPQ==', 1, 'Earl', 'erl@yahoo.com', '', 'TVRBMU9HSXdaVGd5TWpkbE1qWXg=', '', NULL, ''),
(4, 'seminar', 'johnenrico21', 'WVhOa1lYTmtNVEl6', 2, 'tes', 'johnenricocomia212@yahoo.com', '+639331885367', NULL, '89aee', NULL, '2017-02-24 16:02:34'),
(5, 'seminar', 'jodjopasjdpsa', 'WVhOa1lYTmtNVEl6', 2, 'dadsadasdsa', 'dsadsadasdsa@yahoo.com', '+639331885367', NULL, '8ea79', NULL, '2017-02-25 11:24:26'),
(6, 'seminar', 'johnenricocomia', 'WVhOa1lYTmtNVEl6', 2, 'dasdsadsadsadasdsadsadsa', 'johnenricocomia@yahoo.com', '+639331885367', NULL, '93b63', NULL, '2017-02-25 11:25:47'),
(7, 'seminar', 'dsadasdasda', 'WVhOa1lYTmtNVEl6', 2, 'dasdadadasdadadasdada', 'adasdasdsa@yahoo.com', '+639331854542', NULL, NULL, NULL, '2017-02-25 19:50:26'),
(9, 'seminar', 'dsadasdasda', 'WVhOa1lYTmtNVEl6', 2, 'dasdadadasdadadasdada', 'adasdasdsa@yahoo.com', '+639331854542', NULL, NULL, NULL, '2017-02-25 19:50:26'),
(10, 'seminar', 'dsadasdasda', 'WVhOa1lYTmtNVEl6', 2, 'dasdadadasdadadasdada', 'adasdasdsa@yahoo.com', '+639331854542', NULL, NULL, NULL, '2017-02-25 19:50:26'),
(11, 'seminar', 'dsadasdasda', 'WVhOa1lYTmtNVEl6', 2, 'dasdadadasdadadasdada', 'adasdasdsa@yahoo.com', '+639331854542', NULL, NULL, NULL, '2017-02-25 19:50:26'),
(12, 'seminar', 'dsadasdasda', 'WVhOa1lYTmtNVEl6', 2, 'dasdadadasdadadasdada', 'adasdasdsa@yahoo.com', '+639331854542', NULL, NULL, NULL, '2017-02-25 19:50:26'),
(13, 'seminar', 'dsadasdasda', 'WVhOa1lYTmtNVEl6', 2, 'dasdadadasdadadasdada', 'adasdasdsa@yahoo.com', '+639331854542', NULL, NULL, NULL, '2017-02-25 19:50:26'),
(14, 'seminar', 'dsadasdasda', 'WVhOa1lYTmtNVEl6', 2, 'dasdadadasdadadasdada', 'adasdasdsa@yahoo.com', '+639331854542', NULL, NULL, NULL, '2017-02-25 19:50:26'),
(15, 'seminar', 'dsadasdasda', 'WVhOa1lYTmtNVEl6', 2, 'dasdadadasdadadasdada', 'adasdasdsa@yahoo.com', '+639331854542', NULL, NULL, NULL, '2017-02-25 19:50:26'),
(16, 'seminar', 'dsadasdasda', 'WVhOa1lYTmtNVEl6', 2, 'dasdadadasdadadasdada', 'adasdasdsa@yahoo.com', '+639331854542', NULL, NULL, NULL, '2017-02-25 19:50:26'),
(17, 'seminar', 'dsadasdasda', 'WVhOa1lYTmtNVEl6', 2, 'dasdadadasdadadasdada', 'adasdasdsa@yahoo.com', '+639331854542', NULL, NULL, NULL, '2017-02-25 19:50:26');

-- --------------------------------------------------------

--
-- Table structure for table `user_group`
--

CREATE TABLE `user_group` (
  `guid` int(11) NOT NULL,
  `gname` varchar(255) DEFAULT NULL,
  `role` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_group`
--

INSERT INTO `user_group` (`guid`, `gname`, `role`) VALUES
(1, 'Super Admin', '{"view":"1,4,2,3,5","create":"1,4,2,3,5","alter":"1,4,2,3,5","drop":"1,4,2,3,5"}'),
(2, 'Evaluator', '{"view":"2,3,1","create":"2,3,1","alter":"2,3,1","drop":"2,3,1"}');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `evaluation`
--
ALTER TABLE `evaluation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `evaluation_attachment`
--
ALTER TABLE `evaluation_attachment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `evaluation_authorize`
--
ALTER TABLE `evaluation_authorize`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `evaluation_comment`
--
ALTER TABLE `evaluation_comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `evaluation_ratings`
--
ALTER TABLE `evaluation_ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `evaluation_summary`
--
ALTER TABLE `evaluation_summary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `evaluation_summary_other`
--
ALTER TABLE `evaluation_summary_other`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`modid`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question_choices`
--
ALTER TABLE `question_choices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question_evaluation`
--
ALTER TABLE `question_evaluation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `guid` (`guid`);

--
-- Indexes for table `user_group`
--
ALTER TABLE `user_group`
  ADD PRIMARY KEY (`guid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `evaluation_attachment`
--
ALTER TABLE `evaluation_attachment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;
--
-- AUTO_INCREMENT for table `evaluation_authorize`
--
ALTER TABLE `evaluation_authorize`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `evaluation_comment`
--
ALTER TABLE `evaluation_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `evaluation_ratings`
--
ALTER TABLE `evaluation_ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `evaluation_summary`
--
ALTER TABLE `evaluation_summary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `evaluation_summary_other`
--
ALTER TABLE `evaluation_summary_other`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `module`
--
ALTER TABLE `module`
  MODIFY `modid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `question_choices`
--
ALTER TABLE `question_choices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `question_evaluation`
--
ALTER TABLE `question_evaluation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `user_group`
--
ALTER TABLE `user_group`
  MODIFY `guid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
