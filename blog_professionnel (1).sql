-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 28 oct. 2020 à 08:28
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
  `title` varchar(200) COLLATE utf8_bin NOT NULL,
  `chapo` varchar(300) COLLATE utf8_bin NOT NULL,
  `content` longtext COLLATE utf8_bin NOT NULL,
  `dateLastModification` datetime NOT NULL,
  `status` tinyint(1) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `blogpost`
--

INSERT INTO `blogpost` (`id`, `title`, `chapo`, `content`, `dateLastModification`, `status`, `user_id`) VALUES
(1, '   La planète Mars est à présent plus brillante que Jupiter', 'Quelques jours avant son passage au plus près de la Terre, l’éclat de la planète rouge est de plus en plus intense.', 'La planète Mars passera au plus près de la Terre le 6 octobre et elle profite de cette proximité relative – 62 millions de kilomètres tout de même ! – pour devenir plus éclatante que Jupiter, la plus grande planète du Système solaire, durant plusieurs semaines. Vous pouvez le constater aisément en comparant à l’œil nu la luminosité de ces deux planètes deux heures après le coucher du Soleil. Mars brille alors à une douzaine de degrés de hauteur au-dessus de l’horizon est et Jupiter se signale à une vingtaine de degrés de hauteur au-dessus de l’horizon sud-sud-ouest. La coloration orangée de l’éclat martien permet généralement de l’identifier sans peine, mais si vous avez un doute profitez du passage de la Lune encore pratiquement pleine juste à côté de Mars durant la nuit du 2 au 3 octobre (voir plus bas).', '2020-10-21 15:15:04', 1, 1),
(2, 'Récital planétaire dans le ciel de septembre', ' Jupiter, Saturne, Mars et Vénus se passent le relais pour animer le ciel du crépuscule à l’aube.', 'En septembre, Jupiter et Saturne sont éclatantes au-dessus de l’horizon sud à la fin du crépuscule, un peu plus d’une heure et demie après le coucher du Soleil. Elles brillent alors à une vingtaine de degrés de hauteur au-dessus de l’horizon sud, soit l’équivalent de la hauteur de votre main grande ouverte bras tendu. Vous ne pouvez les manquer à l’œil nu, si aucun obstacle naturel ou artificiel ne les cache, même si vous observez depuis un milieu urbain offrant un ciel dégradé par la pollution lumineuse. Dans le classement des planètes les plus brillantes, l’éclat jovien n’est en effet dépassé que par celui de Vénus et, durant de rares et brèves périodes, par celui de Mars.\r\n\r\nSaturne est bien moins brillante, mais elle attire tout de même le regard à près de huit degrés sur la gauche de Jupiter. Huit degrés, cela reste un écart apparent conséquent sur le ciel – à peine moins que la largeur du poing bras tendu – pourtant l’attraction visuelle de cette paire planétaire est évidente et elle ne fera que croître dans les prochains mois car le déplacement de Jupiter va l’amener à croiser Saturne à seulement 0,1 degré, moins que l’épaisseur de la mine d’un crayon à papier tenu à bout de bras. Cette conjonction exceptionnelle se produira le 21 décembre prochain et nous aurons bien évidemment l’occasion d’en reparler.', '2020-10-21 15:16:00', 1, 1),
(3, 'Vous avez rendez-vous avec les planètes et les étoiles', 'La trentième édition des Nuits des étoiles se déroule du 7 au 9 août dans toute la France.', 'Alors que le spectacle exceptionnel offert par la comète NEOWISE s’achève, les planètes, la Lune, les étoiles filantes et la Voie lactée prennent le relais pour animer les nuits aoûtiennes. La comète n’est plus visible à l’œil nu depuis la fin du mois de juillet, mais si vous possédez des jumelles ou un télescope, elle est toujours observable en début de nuit au-dessus de l’horizon ouest, une dizaine de degrés sous l’étoile très brillante Arcturus du Bouvier. C’est par elle que commenceront les observations, deux heures après le coucher du Soleil, lors des trois nuits des étoiles, du vendredi 7 au dimanche 9 août. À présent que son éclat a baissé, un ciel protégé des lumières artificielles est indispensable pour la voir. Je vous suggère donc de profiter du week-end pour vous éloigner des villes et des illuminations nocturnes envahissantes ; avec la canicule annoncée, passer quelques heures au frais sous les étoiles sera une sortie bienvenue. Prévoyez des pulls, des pantalons et des chaussures fermées, ainsi qu’une ou deux couvertures pour vous allonger sur le sol et vous promener à l’œil nu entre les étoiles. Si votre ciel est bien sombre, vous pourrez contempler la magnifique Voie lactée estivale qui barre le ciel du nord au sud avant que l’éclat lunaire ne l’efface en milieu de nuit.', '2020-10-21 15:16:40', 1, 1),
(4, ' Une très belle comète est visible à l’aube', ' La comète C/2020 F3 tient toutes ses promesses et elle brille superbement au nord-est dans le ciel de l’aube', 'Quelques jours après son passage au plus près du Soleil – 44 millions de kilomètres le 3 juillet –, la comète C/2020 F3 (NEOWISE) vient de faire son apparition dans le ciel de l’aube et elle est vraiment très belle et très brillante. Dans une atmosphère limpide, elle est aisément visible à l’œil nu une heure et demie avant le lever du Soleil à quelques degrés de hauteur au-dessus d’un horizon nord-est bien dégagé et on distingue sans peine sa queue de gaz, même sur un fond de ciel déjà éclairci et coloré par l’aube. Dans les jours qui viennent, cette magnifique comète sera observable à l’aube dans des conditions un peu meilleures chaque matin puis, après le 10 juillet, elle basculera progressivement dans le ciel crépusculaire du soir et devrait devenir superbe dans un ciel bien noir après le 14 juillet.', '2020-10-21 15:17:47', 1, 1),
(5, '  Observer le ciel en période de confinement', 'Que vous habitiez en milieu urbain ou à la campagne, dans un appartement ou une maison, si vous voyez un bout de ciel vous pouvez faire des observations en avril.', 'Si je ne peux pas vous promettre d’observer le ciel en votre compagnie dans les semaines qui viennent, je peux néanmoins vous offrir un moment de quiétude et de contemplation des étoiles. J’ai assemblé dans le court-métrage d’une quinzaine de minutes qui ouvre ce billet plusieurs dizaines de milliers d’images prises à toutes les saisons sous le ciel des Cévennes. Les séquences se succèdent au rythme de la rotation terrestre et du passage des mois : le coucher de la Voie lactée avec son reflet dans le lac des Pises, un hêtre automnal éclairé par la Lune, une pleine lune sur le Lingas enneigé, le crépuscule et l’aube au sommet du mont Aigoual, Vénus et la Lune qui tombent sur l’observatoire des Pises, un champignon lunaire poussant sur le causse Méjan, la Voie lactée balayée par les nuages au-dessus des gorges du Tarn, Jupiter et Saturne entourées par les étoiles du Scorpion et du Sagittaire, la beauté d’un ciel d’été, la Voie lactée, les avions et les étoiles filantes du mois d’août sur le causse Noir, le coucher de Vénus dans la lumière zodiacale sur le causse Méjan au mois de février dernier et sur l’Aigoual début mars (remarquez les dizaines d’avions et de satellites Starlink visibles sur ces deux vidéos récentes) et le lever d’un mince croissant lunaire déformé par l’atmosphère. La bande-son a été enregistrée dans une prairie sur le causse Méjan lors d’une belle nuit de printemps. Éteignez les lumières, mettez la vidéo en plein écran à la meilleure résolution accessible, montez un peu le son et évadez-vous dans la nuit étoilée !', '2020-10-21 15:18:33', 1, 1),
(6, ' L’éclat de Vénus est somptueux dans le ciel du soir en mars', 'Vous ne pouvez pas manquer Vénus à l’ouest après le coucher du Soleil, il y a des mois qu’elle n’avait pas été aussi brillante et bien placée.', 'Par la fenêtre d’une pièce bien orientée, en voiture, en courant ou en faisant des courses avant de rentrer dîner, vous ne pouvez pas manquer l’éclat de Vénus dans le ciel du soir. La deuxième planète en s’éloignant du Soleil atteint ce mois-ci son élongation maximale, soit la période durant laquelle son écart apparent avec le Soleil culmine à plus de 46°. Lorsque l’inclinaison de sa trajectoire dans notre ciel est favorable, comme c’est le cas en ce début d’année dans l’hémisphère Nord, son élongation extrême lui permet de se coucher près de quatre heures après l’astre du jour et d’apparaître dans un ciel bien sombre à la fin du crépuscule et en début de nuit. Vénus est une planète à peine plus petite que la Terre, enveloppée d’une épaisse atmosphère nuageuse qui réfléchit vivement l’éclat du Soleil. Dans une lunette ou un télescope avec un grossissement d’une centaine de fois, Vénus nous montre actuellement son dernier quartier. Les chants des mésanges charbonnières et les coassements des grenouilles accompagnent la symphonie lumineuse de Vénus en soirée. Si vous avez la possibilité d’admirer un ciel suffisamment préservé des excès de l’éclairage artificiel, vous pouvez pivoter vers la gauche à partir de Vénus pour repérer la constellation d’Orion vers le sud (voir la carte un peu plus loin dans ce billet). Je vous parlais le mois dernier de son étoile principale, Bételgeuse, dont l’éclat bien plus faible que d’habitude intriguait les observateurs. Certains annonçaient déjà sa fin et son explosion prochaine, mais il ne s’agissait apparemment que d’un minimum un peu plus marqué pour cette étoile dont la variabilité est connue de longue date car, fin février, sa luminosité est repartie à la hausse et elle devrait bientôt retrouver sa dixième place sur la liste des étoiles les plus brillantes de la sphère céleste.', '2020-10-21 15:19:07', 1, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id`, `title`, `content`, `date`, `status`, `user_id`, `blogPost_id`) VALUES
(1, 'Bravo', 'Hello, j\'adore cet article, bravo au créateur.', '2020-10-28 09:13:18', 1, 3, 6),
(2, 'Un peu de gaieté', 'Un peu de gaieté en levant les yeux au ciel...', '2020-10-28 09:14:02', 1, 3, 5),
(3, 'Super', 'Merci pour l\'info, je vais regarder ça !', '2020-10-28 09:16:19', 1, 2, 6),
(4, 'Evasion étoilée', 'Je vais suivre votre conseil et m\'évader dans la nuit étoilée ! :) ', '2020-10-28 09:17:22', 1, 2, 5),
(5, 'Top', 'Bonjour, \r\nMerci pour cette information, je ne connaissais pas la nuits des étoiles.', '2020-10-28 09:18:23', 1, 2, 3),
(6, 'Triste', 'Je vis en ville et avec la pollution lumineuse je ne pourrais pas observer le ciel.. :( ', '2020-10-28 09:19:40', 1, 5, 6),
(7, 'Merci', 'Merci pour vos beaux articles qui réchauffe le cœur.', '2020-10-28 09:20:11', 1, 5, 1),
(8, 'Bon à savoir ! ', 'Je serais à la montagne donc je pense avoir une très bonne occasion d\'apercevoir tout ça ! ', '2020-10-28 09:21:22', 1, 5, 2),
(9, 'Sympa', 'Sympa votre blog !', '2020-10-28 09:23:25', 1, 7, 4),
(10, 'Pareil', 'Pareil que Marine, je ne vais pas pouvoir observer le ciel depuis mon appartement en ville, la nuit il y a des lampadaires qui éclairent à fond ! ', '2020-10-28 09:24:31', 1, 7, 6),
(11, 'Whouaou !', 'Je viens d\'voir un super télescope pour mon anniversaire et je vais pouvoir le tester à cette occasion !', '2020-10-28 09:26:17', 1, 8, 6),
(12, 'jolie article', 'Bel article très poétique...', '2020-10-28 09:27:26', 1, 4, 6);

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `login`, `password`, `mail`, `admin`) VALUES
(1, 'administrateur', '$2y$10$2/jMJ5WRXfgZhIbULbcvEey4F7w2SynTVS1tc/vk0QxiI1bRt0WE6', 'admindusite@gmail.com', 1),
(2, 'Martine', '$2y$10$2/jMJ5WRXfgZhIbULbcvEey4F7w2SynTVS1tc/vk0QxiI1bRt0WE6', 'martine@gmail.com', 0),
(3, 'Eric', '$2y$10$p8ZPTxRz3CAhSpLT6ChJ3eLAuxWDBbZQ0K/UXjxvdOx.qdL0Ykhdi', 'Eric@gmail.com', 0),
(4, 'Djiek', '$2y$10$DahvhqA.Y3NRrbAI/yCaHet2l4Xpmz0zCAM/e.L.qBHU0Fe8pFBgC', 'djiek@gmail.com', 0),
(5, 'Marine', '$2y$10$VL46ki2U8y2LG1o87tsRtONEG46fYnwg1U4xL1JwccBp5MOGKQG3K', 'marine@gmail.com', 0),
(6, 'Etienne', '$2y$10$hOsJpo8EUxIoEn6SPXa/c.2BqX2SgpxSOhmQX553FQm8MgikDUry.', 'etienne@gmail.com', 0),
(7, 'Arnaud', '$2y$10$kXXes7.ekws51mCjdWX71u9m8VqbKw0T0Ok9BiUnwQ.ppXESO2X1a', 'arnaud@gmail.com', 0),
(8, 'Melissa', '$2y$10$9f/uCauMrYD536d81ZJeZ.hOBzBAzjnsFS1F6fBfx0kSqBHZ0/D7m', 'melissa@gmail.com', 0);

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
