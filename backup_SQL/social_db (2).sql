-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Ven 20 Juin 2014 à 18:22
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `social_db`
--
CREATE DATABASE IF NOT EXISTS `social_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `social_db`;

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned NOT NULL,
  `post_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `state` tinyint(4) NOT NULL DEFAULT '0',
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Contenu de la table `comments`
--

INSERT INTO `comments` (`id`, `parent_id`, `post_id`, `user_id`, `state`, `content`, `created_at`, `updated_at`) VALUES
(1, 0, 1, 1, 1, 'Lorem ipsum dolor sit amet, mutat utinam nonumy ea mel.', '2014-05-28 22:40:41', '2014-05-28 22:40:41'),
(2, 0, 1, 2, 0, 'Lorem ipsum dolor sit amet, sale ceteros liberavisse duo ex, nam mazim maiestatis dissentiunt no. Iusto nominavi cu sed, has.', '2014-06-02 00:40:41', '2014-06-02 00:40:41'),
(3, 0, 1, 1, 0, 'Et consul eirmod feugait mel! Te vix iuvaret feugiat repudiandae. Solet dolore lobortis mei te, saepe habemus imperdiet ex vim. Consequat signiferumque per no, ne pri erant vocibus invidunt te.', '2014-06-12 02:40:41', '2014-06-12 02:40:41'),
(4, 0, 2, 1, 0, 'Lorem ipsum dolor sit amet, mutat utinam nonumy ea mel.', '2014-06-11 22:40:41', '2014-06-11 22:40:41'),
(5, 0, 2, 2, 0, 'Lorem ipsum dolor sit amet, sale ceteros liberavisse duo ex, nam mazim maiestatis dissentiunt no. Iusto nominavi cu sed, has.', '2014-06-14 00:40:41', '2014-06-14 00:40:41'),
(6, 0, 3, 1, 0, 'Lorem ipsum dolor sit amet, mutat utinam nonumy ea mel.', '2014-06-13 22:40:41', '2014-06-13 22:40:41');

-- --------------------------------------------------------

--
-- Structure de la table `friend_list`
--

CREATE TABLE IF NOT EXISTS `friend_list` (
  `person_id0` int(10) unsigned NOT NULL,
  `person_id1` int(10) unsigned NOT NULL,
  `accepted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`person_id0`,`person_id1`),
  KEY `person_id1` (`person_id1`),
  KEY `person_id0` (`person_id0`),
  KEY `person_id0_2` (`person_id0`),
  KEY `person_id1_2` (`person_id1`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `friend_list`
--

INSERT INTO `friend_list` (`person_id0`, `person_id1`, `accepted`) VALUES
(1, 2, 1),
(1, 3, 0),
(5, 1, 0),
(53, 2, 0),
(62, 65, 0),
(65, 2, 1),
(65, 56, 0);

-- --------------------------------------------------------

--
-- Structure de la table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `groups_name_unique` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `groups`
--

INSERT INTO `groups` (`id`, `name`, `permissions`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '{"admin":1,"users":1}', '2014-06-15 20:40:40', '2014-06-15 20:40:40'),
(2, 'Moderator', '', '2014-06-16 06:44:18', '2014-06-16 06:44:18');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2012_12_06_225921_migration_cartalyst_sentry_install_users', 1),
('2012_12_06_225929_migration_cartalyst_sentry_install_groups', 1),
('2012_12_06_225945_migration_cartalyst_sentry_install_users_groups_pivot', 1),
('2012_12_06_225988_migration_cartalyst_sentry_install_throttle', 1),
('2013_01_19_011903_create_posts_table', 2),
('2013_01_19_044505_create_comments_table', 2),
('2013_03_23_193214_update_users_table', 2);

-- --------------------------------------------------------

--
-- Structure de la table `notification`
--

CREATE TABLE IF NOT EXISTS `notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `performer_id` int(10) unsigned NOT NULL,
  `target_id` int(10) unsigned NOT NULL,
  `notification_type` tinyint(4) NOT NULL COMMENT '0-''Add'',10-''Comment'',20-''amazing'',22-''super'',24-''congrats'',26-''depends'',28-''blah'',30-''sucks''',
  `content` varchar(40) DEFAULT NULL COMMENT 'Message to be shown as a popup',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_visited` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `owner_id` (`target_id`),
  KEY `performer_id` (`performer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `notification`
--

INSERT INTO `notification` (`id`, `performer_id`, `target_id`, `notification_type`, `content`, `created_at`, `is_visited`) VALUES
(2, 2, 1, 0, 'X added Y', '2014-06-20 17:32:05', 1);

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `state` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 visible 1 invisible 2 et plus deleted',
  `Photo` text COLLATE utf8_unicode_ci,
  `meta_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_keywords` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Contenu de la table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `slug`, `content`, `state`, `Photo`, `meta_title`, `meta_description`, `meta_keywords`, `created_at`, `updated_at`) VALUES
(1, 1, 'Lorem ipsum dolor sit amet', 'lorem-ipsum-dolor-sit-amet', 'In mea autem etiam menandri, quot elitr vim ei, eos semper disputationi id? Per facer appetere eu, duo et animal maiestatis. Omnesque invidunt mnesarchum ex mel, vis no case senserit dissentias. Te mei minimum singulis inimicus, ne labores accusam necessitatibus vel, vivendo nominavi ne sed. Posidonium scriptorem consequuntur cum ex? Posse fabulas iudicabit in nec, eos cu electram forensibus, pro ei commodo tractatos reformidans. Qui eu lorem augue alterum, eos in facilis pericula mediocritatem?\n\nEst hinc legimus oporteat in. Sit ei melius delicatissimi. Duo ex qualisque adolescens! Pri cu solum aeque. Aperiri docendi vituperatoribus has ea!\n\nSed ut ludus perfecto sensibus, no mea iisque facilisi. Choro tation melius et mea, ne vis nisl insolens. Vero autem scriptorem cu qui? Errem dolores no nam, mea tritani platonem id! At nec tantas consul, vis mundi petentium elaboraret ex, mel appareat maiestatis at.\n\nSed et eros concludaturque. Mel ne aperiam comprehensam! Ornatus delicatissimi eam ex, sea an quidam tritani placerat? Ad eius iriure consequat eam, mazim temporibus conclusionemque eum ex.\n\nTe amet sumo usu, ne autem impetus scripserit duo, ius ei mutat labore inciderint! Id nulla comprehensam his? Ut eam deleniti argumentum, eam appellantur definitionem ad. Pro et purto partem mucius!\n\nCu liber primis sed, esse evertitur vis ad. Ne graeco maiorum mea! In eos nostro docendi conclusionemque. Ne sit audire blandit tractatos? An nec dicam causae meliore, pro tamquam offendit efficiendi ut.\n\nTe dicta sadipscing nam, denique albucius conclusionemque ne usu, mea eu euripidis philosophia! Qui at vivendo efficiendi! Vim ex delenit blandit oportere, in iriure placerat cum. Te cum meis altera, ius ex quis veri.\n\nMutat propriae eu has, mel ne veri bonorum tincidunt. Per noluisse sensibus honestatis ut, stet singulis ea eam, his dicunt vivendum mediocrem ei. Ei usu mutat efficiantur, eum verear aperiam definitiones an! Simul dicam instructior ius ei. Cu ius facer doming cotidieque! Quot principes eu his, usu vero dicat an.\n\nEx dicta perpetua qui, pericula intellegam scripserit id vel. Id fabulas ornatus necessitatibus mel. Prompta dolorem appetere ea has. Vel ad expetendis instructior!\n\nTe his dolorem adversarium? Pri eu rebum viris, tation molestie id pri. Mel ei stet inermis dissentias. Sed ea dolorum detracto vituperata. Possit oportere similique cu nec, ridens animal quo ex?', 1, NULL, '', '', '', '2014-05-26 20:40:41', '2014-05-26 20:40:41'),
(2, 1, 'Vivendo suscipiantur vim te vix', 'vivendo-suscipiantur-vim-te-vix', 'In mea autem etiam menandri, quot elitr vim ei, eos semper disputationi id? Per facer appetere eu, duo et animal maiestatis. Omnesque invidunt mnesarchum ex mel, vis no case senserit dissentias. Te mei minimum singulis inimicus, ne labores accusam necessitatibus vel, vivendo nominavi ne sed. Posidonium scriptorem consequuntur cum ex? Posse fabulas iudicabit in nec, eos cu electram forensibus, pro ei commodo tractatos reformidans. Qui eu lorem augue alterum, eos in facilis pericula mediocritatem?\n\nEst hinc legimus oporteat in. Sit ei melius delicatissimi. Duo ex qualisque adolescens! Pri cu solum aeque. Aperiri docendi vituperatoribus has ea!\n\nSed ut ludus perfecto sensibus, no mea iisque facilisi. Choro tation melius et mea, ne vis nisl insolens. Vero autem scriptorem cu qui? Errem dolores no nam, mea tritani platonem id! At nec tantas consul, vis mundi petentium elaboraret ex, mel appareat maiestatis at.\n\nSed et eros concludaturque. Mel ne aperiam comprehensam! Ornatus delicatissimi eam ex, sea an quidam tritani placerat? Ad eius iriure consequat eam, mazim temporibus conclusionemque eum ex.\n\nTe amet sumo usu, ne autem impetus scripserit duo, ius ei mutat labore inciderint! Id nulla comprehensam his? Ut eam deleniti argumentum, eam appellantur definitionem ad. Pro et purto partem mucius!\n\nCu liber primis sed, esse evertitur vis ad. Ne graeco maiorum mea! In eos nostro docendi conclusionemque. Ne sit audire blandit tractatos? An nec dicam causae meliore, pro tamquam offendit efficiendi ut.\n\nTe dicta sadipscing nam, denique albucius conclusionemque ne usu, mea eu euripidis philosophia! Qui at vivendo efficiendi! Vim ex delenit blandit oportere, in iriure placerat cum. Te cum meis altera, ius ex quis veri.\n\nMutat propriae eu has, mel ne veri bonorum tincidunt. Per noluisse sensibus honestatis ut, stet singulis ea eam, his dicunt vivendum mediocrem ei. Ei usu mutat efficiantur, eum verear aperiam definitiones an! Simul dicam instructior ius ei. Cu ius facer doming cotidieque! Quot principes eu his, usu vero dicat an.\n\nEx dicta perpetua qui, pericula intellegam scripserit id vel. Id fabulas ornatus necessitatibus mel. Prompta dolorem appetere ea has. Vel ad expetendis instructior!\n\nTe his dolorem adversarium? Pri eu rebum viris, tation molestie id pri. Mel ei stet inermis dissentias. Sed ea dolorum detracto vituperata. Possit oportere similique cu nec, ridens animal quo ex?', 0, NULL, '', '', '', '2014-06-07 20:40:41', '2014-06-07 20:40:41'),
(3, 1, 'In iisque similique reprimique eum', 'in-iisque-similique-reprimique-eum', 'In mea autem etiam menandri, quot elitr vim ei, eos semper disputationi id? Per facer appetere eu, duo et animal maiestatis. Omnesque invidunt mnesarchum ex mel, vis no case senserit dissentias. Te mei minimum singulis inimicus, ne labores accusam necessitatibus vel, vivendo nominavi ne sed. Posidonium scriptorem consequuntur cum ex? Posse fabulas iudicabit in nec, eos cu electram forensibus, pro ei commodo tractatos reformidans. Qui eu lorem augue alterum, eos in facilis pericula mediocritatem?\n\nEst hinc legimus oporteat in. Sit ei melius delicatissimi. Duo ex qualisque adolescens! Pri cu solum aeque. Aperiri docendi vituperatoribus has ea!\n\nSed ut ludus perfecto sensibus, no mea iisque facilisi. Choro tation melius et mea, ne vis nisl insolens. Vero autem scriptorem cu qui? Errem dolores no nam, mea tritani platonem id! At nec tantas consul, vis mundi petentium elaboraret ex, mel appareat maiestatis at.\n\nSed et eros concludaturque. Mel ne aperiam comprehensam! Ornatus delicatissimi eam ex, sea an quidam tritani placerat? Ad eius iriure consequat eam, mazim temporibus conclusionemque eum ex.\n\nTe amet sumo usu, ne autem impetus scripserit duo, ius ei mutat labore inciderint! Id nulla comprehensam his? Ut eam deleniti argumentum, eam appellantur definitionem ad. Pro et purto partem mucius!\n\nCu liber primis sed, esse evertitur vis ad. Ne graeco maiorum mea! In eos nostro docendi conclusionemque. Ne sit audire blandit tractatos? An nec dicam causae meliore, pro tamquam offendit efficiendi ut.\n\nTe dicta sadipscing nam, denique albucius conclusionemque ne usu, mea eu euripidis philosophia! Qui at vivendo efficiendi! Vim ex delenit blandit oportere, in iriure placerat cum. Te cum meis altera, ius ex quis veri.\n\nMutat propriae eu has, mel ne veri bonorum tincidunt. Per noluisse sensibus honestatis ut, stet singulis ea eam, his dicunt vivendum mediocrem ei. Ei usu mutat efficiantur, eum verear aperiam definitiones an! Simul dicam instructior ius ei. Cu ius facer doming cotidieque! Quot principes eu his, usu vero dicat an.\n\nEx dicta perpetua qui, pericula intellegam scripserit id vel. Id fabulas ornatus necessitatibus mel. Prompta dolorem appetere ea has. Vel ad expetendis instructior!\n\nTe his dolorem adversarium? Pri eu rebum viris, tation molestie id pri. Mel ei stet inermis dissentias. Sed ea dolorum detracto vituperata. Possit oportere similique cu nec, ridens animal quo ex?', 0, NULL, '', '', '', '2014-06-11 20:40:41', '2014-06-11 20:40:41');

-- --------------------------------------------------------

--
-- Structure de la table `throttle`
--

CREATE TABLE IF NOT EXISTS `throttle` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `attempts` int(11) NOT NULL DEFAULT '0',
  `suspended` tinyint(1) NOT NULL DEFAULT '0',
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `last_attempt_at` timestamp NULL DEFAULT NULL,
  `suspended_at` timestamp NULL DEFAULT NULL,
  `banned_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Contenu de la table `throttle`
--

INSERT INTO `throttle` (`id`, `user_id`, `ip_address`, `attempts`, `suspended`, `banned`, `last_attempt_at`, `suspended_at`, `banned_at`) VALUES
(1, 1, '127.0.0.1', 0, 0, 0, NULL, NULL, NULL),
(2, 3, '127.0.0.1', 0, 0, 0, NULL, NULL, NULL),
(3, 4, '127.0.0.1', 0, 0, 0, NULL, NULL, NULL),
(4, 5, '127.0.0.1', 2, 0, 0, '2014-06-19 20:15:05', NULL, NULL),
(5, 67, '127.0.0.1', 0, 0, 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `activated` tinyint(1) NOT NULL DEFAULT '0',
  `activation_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activated_at` timestamp NULL DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `persist_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reset_password_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gravatar` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=68 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `permissions`, `activated`, `activation_code`, `activated_at`, `last_login`, `persist_code`, `reset_password_code`, `first_name`, `last_name`, `created_at`, `updated_at`, `deleted_at`, `website`, `country`, `gravatar`) VALUES
(1, 'admin@admin.com', '$2y$10$jtSdgmKsRDRCqs1VrC1IQe5p7gDV3kzpX3QXThiwvijcwsn6xamgW', '{"admin":1,"user":1}', 1, NULL, NULL, '2014-06-20 12:17:12', '$2y$10$d2fB8yDVS//Nf6s6FkigMOsj6zL8yaRPRmMtvUDXs3Hu1iWXErN7e', NULL, 'admin', 'admin', '2014-06-15 20:40:40', '2014-06-20 12:17:12', NULL, '', '', ''),
(2, 'john.doe@example.com', '$2y$10$3zVJD0u41Od48v1JDyS2.eE05HQQX5mGoaR7bqBMVGJ.yN9rgnAfG', NULL, 1, NULL, NULL, NULL, NULL, NULL, 'John', 'Doe', '2014-06-15 20:40:41', '2014-06-16 12:59:24', NULL, '', '', ''),
(3, 'midoupa3@gmail.com', '$2y$10$VPSuCGCCZ94vIIC0RO0Jg.ua4mxw7dUXJ5JZN3At.lgOW7.3iEzb2', '{"superuser":-1}', 1, NULL, NULL, '2014-06-15 20:47:21', '$2y$10$zs5djmaUkrU3cXVdLlmFWuhyxFiAT8L74nY1CooGAKoEsRClfvoEi', NULL, 'midou', 'midou', '2014-06-15 20:46:59', '2014-06-15 20:47:21', NULL, '', '', ''),
(4, 'rachid@gmail.com', '$2y$10$Gh6yDPOf304VTVZRL97yiOxQ7Oq8SZjWpAz20SMfSR8JrzyQcepA.', NULL, 0, 'YaERvngsRQDlWeffEXSiSS5Cjar43Lj3WMuoYaVpqx', NULL, NULL, NULL, NULL, 'rachid', 'rachid', '2014-06-15 20:49:21', '2014-06-15 20:52:00', NULL, '', '', ''),
(5, 'rachid@rachid.com', 'rachid', NULL, 1, '', NULL, '2014-06-16 12:51:33', '$2y$10$vx5svoFn4KVfczDQLofU9OIw0gR/w/8mUB6NsftlLzf6AxcdSo3tS', NULL, 'rachid', 'rachid', '2014-06-16 06:39:52', '2014-06-16 12:51:33', NULL, '', '', ''),
(6, '$email', '$encrypted_password', '', 1, NULL, '2014-06-19 23:11:09', NULL, NULL, NULL, '$first_name', '$last_name', '2014-06-19 23:11:09', '2014-06-19 23:11:09', NULL, '', '', ''),
(53, 'kaka@kaka.com', 'kaka', '', 1, NULL, '2014-06-19 23:21:20', NULL, NULL, NULL, 'kaka', 'kaka', '2014-06-19 23:21:20', '2014-06-19 23:21:20', NULL, '', '', ''),
(54, 'kk', 'kk', '', 1, NULL, '2014-06-20 00:16:17', NULL, NULL, NULL, 'kk', 'kk', '2014-06-20 00:16:17', '2014-06-20 00:16:17', NULL, '', '', ''),
(56, '$email2', '$password', '', 1, NULL, '2014-06-20 00:31:02', NULL, NULL, NULL, '$first_name', '$last_name', '2014-06-20 00:31:02', '2014-06-20 00:31:02', NULL, '', '', ''),
(57, 'k', 'k', '', 1, NULL, '2014-06-20 00:32:35', NULL, NULL, NULL, 'k', 'k', '2014-06-20 00:32:35', '2014-06-20 00:32:35', NULL, '', '', ''),
(58, 'd', 'd', '', 1, NULL, '2014-06-20 00:34:30', NULL, NULL, NULL, '', '', '2014-06-20 00:34:30', '2014-06-20 00:34:30', NULL, '', '', ''),
(59, 'w', 'w', '', 1, NULL, '2014-06-20 00:41:20', NULL, NULL, NULL, '', '', '2014-06-20 00:41:20', '2014-06-20 00:41:20', NULL, '', '', ''),
(60, 'r', 'r', '', 1, NULL, '2014-06-20 00:42:05', NULL, NULL, NULL, 'r', 'r', '2014-06-20 00:42:05', '2014-06-20 00:42:05', NULL, '', '', ''),
(61, 'rw', 'rw', '', 1, NULL, '2014-06-20 00:43:59', NULL, NULL, NULL, 'rw', 'rw', '2014-06-20 00:43:59', '2014-06-20 00:43:59', NULL, '', '', ''),
(62, 'rwa', 'rwa', '', 1, NULL, '2014-06-20 00:44:52', NULL, NULL, NULL, 'rwa', 'rwa', '2014-06-20 00:44:52', '2014-06-20 00:44:52', NULL, '', '', ''),
(63, 'as', 'as', '', 1, NULL, '2014-06-20 00:48:11', NULL, NULL, NULL, '', '', '2014-06-20 00:48:11', '2014-06-20 00:48:11', NULL, '', '', ''),
(64, 'ee', 'ee', '', 1, NULL, '2014-06-20 01:32:06', NULL, NULL, NULL, 'ee', 'ee', '2014-06-20 01:32:06', '2014-06-20 01:32:06', NULL, '', '', ''),
(65, 'aa', 'aa', '', 0, NULL, '2014-06-20 01:41:57', NULL, NULL, NULL, 'aa', 'aa', '2014-06-20 01:41:57', '2014-06-20 01:41:57', NULL, '', '', ''),
(66, 'tt', 'tt', '', 1, NULL, '2014-06-20 13:22:10', NULL, NULL, NULL, 'tt', 'tt', '2014-06-20 13:22:10', '2014-06-20 11:24:21', '2014-06-20 11:24:21', '', '', ''),
(67, 'ben@ben.com', '$2y$10$QHN7UbJ8iUA1YhNgRpO/TuJHFQ16nVLN2VxGo5PbHYjSfMyZ5anRm', '{"superuser":-1}', 1, 'oTC9wzr1Sx7Y0CSDBmTrEFd6zCP3EvwMLd736Mn2jG', NULL, '2014-06-20 11:31:33', '$2y$10$8yO2xuJSqTZQos/jS6d7EumVhhKnrcItetcyZkm0wwsDMMhsO3sDm', NULL, 'wsa', 'fsaa', '2014-06-20 11:28:42', '2014-06-20 11:31:33', NULL, '', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
  `user_id` int(10) unsigned NOT NULL,
  `group_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `users_groups`
--

INSERT INTO `users_groups` (`user_id`, `group_id`) VALUES
(1, 1),
(67, 2);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `friend_list`
--
ALTER TABLE `friend_list`
  ADD CONSTRAINT `friend_list_ibfk_1` FOREIGN KEY (`person_id0`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `friend_list_ibfk_2` FOREIGN KEY (`person_id1`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`performer_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
