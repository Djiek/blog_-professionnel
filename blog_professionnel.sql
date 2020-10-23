-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 21 oct. 2020 à 10:47
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `blog_professionnel`
--

-- --------------------------------------------------------

--
-- Structure de la table `blogpost`
--

DROP TABLE IF EXISTS `blogpost`;
CREATE TABLE IF NOT EXISTS `blogpost` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) COLLATE utf8_bin NOT NULL,
  `chapo` varchar(150) COLLATE utf8_bin NOT NULL,
  `content` longtext COLLATE utf8_bin NOT NULL,
  `dateLastModification` datetime NOT NULL,
  `status` tinyint(1) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `blogpost`
--

INSERT INTO `blogpost` (`id`, `title`, `chapo`, `content`, `dateLastModification`, `status`, `user_id`) VALUES
(27, 'erreur sur les posts', 'oui oui des erreurs !', 'Il y a des erreurs sur les posts', '2020-10-13 15:15:14', 1, 1),
(28, '^poiuytresq', '^poijuhygtfrds', 'poiuytrezsq', '2020-10-13 15:22:59', 1, 1),
(29, 'âzeofpzek  eorjvmoegkv j,', 'q^zekov êekvm', 'mrekvo keqrogkerv apfkùa\"k', '2020-10-13 15:24:44', 1, 1),
(30, 'lkiujyhgtrfghjikolkjhgv', '\r\nnirnvzrngvlkznvlks nizevzenlvzevn evnezingieznhfli lknnizehvzeligbv hlzefnzeliblejbv livlieznvglzevb epsenvhlzeignlezvn liznefvilzevlzebsd lzenlv', 'kjhgffghjolkjhg', '2020-10-13 15:28:29', 1, 1),
(31, 'blog de djiek', 'addPostForm', 'addPostForm', '2020-10-14 08:59:31', 1, 1),
(32, '$title$title$title$title$title$title$title', '$title$title$title$title$title$title$title', '$title$title$title$title$title$title$title', '2020-10-14 09:01:41', 1, 1),
(33, 'content', 'title', 'chapo', '2020-10-14 09:01:54', 1, 1),
(34, 'conyent', 'title', 'chapo', '2020-10-14 09:04:31', 1, 1),
(35, 'content', 'title', 'chapo', '2020-10-14 09:04:45', 1, 1),
(37, 'chapo', 'content', 'title', '2020-10-14 09:13:42', 1, 1),
(38, ' chapoddd', 'content', 'title', '2020-10-21 11:42:02', 1, 58),
(51, ' titleddddd', 'chapo', 'contentddddd', '2020-10-21 11:42:31', 1, 58),
(52, ' sssss', 'sss', 'sss', '2020-10-14 14:07:33', 1, 51),
(61, ' sss', 's', 's', '2020-10-21 11:41:21', 1, 58),
(62, ' test2', 'le new blog post', 'aahahhahadddd', '2020-10-21 00:00:00', 1, 58);

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) COLLATE utf8_bin NOT NULL,
  `content` text COLLATE utf8_bin NOT NULL,
  `date` datetime NOT NULL,
  `status` tinyint(1) NOT NULL,
  `user_id` int(11) NOT NULL,
  `blogPost_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `blogPost_id` (`blogPost_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=119 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id`, `title`, `content`, `date`, `status`, `user_id`, `blogPost_id`) VALUES
(90, 'blog de djiek', 'super', '2020-10-13 15:19:03', 1, 1, 27),
(91, 'ertgyhju', 'sdefrgtyh', '2020-10-14 13:57:58', 1, 1, 51),
(112, 'ddd', 'ddd', '2020-10-21 09:54:51', 1, 46, 62),
(113, 'w', 'xw', '2020-10-21 10:15:21', 1, 51, 62),
(115, 'azrezg', 'ée\"rgt', '2020-10-21 10:27:22', 1, 58, 62),
(116, 'com', 'com', '2020-10-21 12:33:15', 1, 51, 51),
(117, 'w', 'w', '2020-10-21 12:41:55', 0, 51, 51);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(30) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `mail` varchar(100) COLLATE utf8_bin NOT NULL,
  `admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `login`, `password`, `mail`, `admin`) VALUES
(1, 'Djiek', '$2y$10$VchmyoqTkWZ.spoaSbXH3uM6f5Nn68TK9V3WCCobZngiHjq6ZrQDe', 'djiek@gmail.com', 1),
(2, 'marine', '$2y$10$VYNR05cghF9Zu866pxrJGexRbhKtDHQGut8Az.zY9JpAVeae3U2WW', 'marine.djiek@gmail.com', 0),
(3, 'zs', '$2y$10$d8ytOh5syoYUtLjOXWZQD.xjAm.eHCchl59KqcTRli9DvgWVKUOza', 'marine.djiek@gmail.comz', 0),
(37, 'Djiek3z', '$2y$10$QmdN67nSg4vFNXevgazcpOPk0V1LOId4xCq4hpMO/mhWf7g30tHeK', 'marine.djiek@gmail.comzzzzzz', 0),
(38, 'Martine', '$2y$10$sfkAY5wPc8cPZ77x9/TfeeXe7Inh4O6QCy35hykHxlmkGyyZMa9lS', 'martine@gmail.com', 0),
(46, 'test', '$2y$10$0RNmTwjTnsJ.v9MMAPFkcOrJxCShpIypxmFfM/z4kp3/d8oIZ.vha', 'azefrg@mail.comaa', 0),
(47, 'test2', '$2y$10$H0B7SYQv07LNuKayejXfBeFCbb51Etb81z6zuDW7tNCJnh946fGr.', 'martine@gmail.comaaaa', 0),
(48, 'Djiektest', '$2y$10$5XmzZ8mOi6Dv7ZRO8JkvEeKxBUULF03cWr9MxTJE4K79hOc.incYC', 'azefrg@mail.comaaaaaaaa', 0),
(49, 'qsdfrgthyjukilom', '$2y$10$10mYQF.Z2OL0aT4X1j6UtuAM0I2d82N9gMKy7hNnC4vGnImSxAHVe', 'marine.djiek@gmail.comrrrr', 0),
(50, 'Djiek3s', '$2y$10$2pjbRJduJJjQ66YiLuV5kukq7h/KvnllHYxQfJvurpwxJZD3UhtHO', 'marine.djiek@gmail.comsss', 0),
(51, 'marine125', '$2y$10$A2f2a5ilLnGew08e0TzW/ObvL3Iv44hNZNYwJ/FV9z1fzA7PVyyz.', 'marine125@gmail.com', 1),
(55, 'Djiekaaaa', '$2y$10$MYmfyTibAbAt4nLwISiDiuRfxEPrWVbq9H0tfYa1vmFqqwDj2ixa.', 'azefrg@mail.comaaaa', 0),
(56, 'Djieka', '$2y$10$RUpbKFLbwVmf7XuZ7oiel.sWA.w2RQztRB.A1GAQr30Txct9vyWea', 'marine.djiek@gmail.comaa', 0),
(57, 'Typhaine', '$2y$10$QlnetzmTUn1ljoSRSG91Tuhvcft1loKzNDSq7y8UrPAYM4157dkVa', 'typaine@gmail.com', 0),
(58, 'Administrateur', '$2y$10$iO1lfQtHktiXeKaL.B44G.bzhe2RgwOJy/fKbgv9IXnLvcR.Ewmr.', 'admindusite@gmail.com', 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `blogpost`
--
ALTER TABLE `blogpost`
  ADD CONSTRAINT `blogpost_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`blogPost_id`) REFERENCES `blogpost` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
