-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 13 juil. 2021 à 13:26
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `barresoupe_symfony`
--

-- --------------------------------------------------------

--
-- Structure de la table `description`
--

DROP TABLE IF EXISTS `description`;
CREATE TABLE IF NOT EXISTS `description` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_id` int(11) NOT NULL,
  `description` varchar(1024) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prix` double NOT NULL,
  `image` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` int(11) NOT NULL,
  `aime` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_6DE44026C8121CE9` (`nom_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `description`
--

INSERT INTO `description` (`id`, `nom_id`, `description`, `prix`, `image`, `active`, `aime`) VALUES
(1, 1, 'Curabitur congue auctor magna, at mattis lectus mattis vel. Duis luctus sapien ipsum, a pretium nisl egestas eu. Nullam lobortis a nisi eu luctus. Praesent quis nisi rutrum, porta massa non, efficitur sem. Ut id luctus erat. Sed sodales eu nulla eget eleifend. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec pretium, lacus sit amet fermentum convallis, lorem ex vehicula leo, et tristique nisl elit vel neque. Quisque ligula magna, pretium sit amet velit in, sollicitudin maximus turpis. Sed non tincidunt lacus. Nulla tempus eros at congue commodo. Proin quis justo eget nisi porta cursus. Duis convallis diam ipsum, sit amet interdum erat tristique id. Phasellus ac lorem eget nibh finibus aliquam sed quis leo. Pellentesque sit amet neque sed turpis tempus vulputate tincidunt eget mi. Nulla eget purus enim.', 11, 'Soupe_20.jpg', 1, 5),
(2, 2, 'Nam porta sed diam et convallis. Proin sollicitudin venenatis sapien rutrum consectetur. Morbi id sem ullamcorper, tincidunt eros elementum, posuere ante. Curabitur elementum, ex id tincidunt ornare, lorem nibh elementum purus, eu feugiat nisl nisi ac ex. Curabitur nunc orci, imperdiet ut est a, hendrerit blandit neque. Vestibulum lacinia convallis ullamcorper. Phasellus consectetur elit et rhoncus sollicitudin.', 13, 'Soupe_11.jpg', 1, -1),
(3, 3, 'Proin congue arcu nunc, fermentum pulvinar ipsum rutrum at. Fusce congue sem mauris, non interdum risus ultricies dapibus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Praesent sit amet placerat dui. Duis sed ex et urna tempor hendrerit. Aenean feugiat, neque a finibus efficitur, mi metus gravida metus, eu cursus diam magna non libero. Vivamus odio quam, dictum sed suscipit vitae, ultrices at tortor. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Vivamus sapien tortor, molestie ac fermentum eu, fermentum efficitur nisi. Cras eu sem nec ligula pretium bibendum ut eget turpis. Phasellus aliquet purus quis quam tempor imperdiet. Integer consectetur rutrum risus sed porttitor. Morbi egestas suscipit lorem, non mattis justo pharetra in.', 14, 'Soupe_10.jpg', 1, 6),
(4, 4, 'Sed posuere viverra ante. Aliquam eget suscipit quam, in vulputate nibh. Etiam congue turpis et nibh lobortis, sit amet tincidunt erat suscipit. Aliquam placerat eleifend purus id rutrum. Integer eu orci vitae quam imperdiet porta non vitae nisl. Morbi tellus nisl, elementum non rhoncus vel, imperdiet quis nulla. Curabitur malesuada justo augue, sit amet condimentum nisi consectetur ut.', 15, 'Soupe_17.jpg', 1, -1),
(5, 5, 'Suspendisse aliquam neque quis malesuada tempus. Morbi ac tortor metus. Fusce convallis, leo lobortis posuere pulvinar, tellus lorem pellentesque tellus, in laoreet sem quam sed sem. Maecenas ullamcorper ipsum ut lorem molestie vehicula. Quisque faucibus justo sit amet dolor elementum finibus. In ac ipsum in magna pretium maximus. Cras quis condimentum nunc. Integer sollicitudin felis sed sapien cursus mattis. Nam ut lacus suscipit, lobortis quam at, suscipit purus. Nullam eleifend ac dolor quis sodales. Duis non tristique tortor, id egestas nibh.', 16, 'Soupe_21.jpg', 1, -9),
(6, 6, 'Nulla facilisi. Phasellus at imperdiet enim. Proin facilisis semper suscipit. Nam euismod, orci in aliquet pharetra, dolor metus scelerisque velit, sed lobortis massa ipsum non ipsum. Curabitur fermentum dapibus rhoncus. Praesent viverra, nulla id posuere laoreet, massa tortor volutpat diam, ac pharetra lorem magna a justo. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Suspendisse elementum in nisl tincidunt gravida. Integer fermentum non diam quis vestibulum. Nullam vel leo est. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Nulla sed ipsum a elit mollis fringilla. Morbi non turpis vitae velit suscipit lobortis. Sed quis lectus id massa rhoncus iaculis.', 17, 'Soupe_13.jpg', 1, -1),
(7, 7, 'Aenean dapibus viverra laoreet. Donec in ullamcorper justo, eu auctor lorem. Morbi rhoncus sagittis massa sed aliquet. Curabitur elementum purus massa, in scelerisque mauris pellentesque eget. Morbi eget imperdiet turpis. Ut nisi libero, imperdiet et aliquam ut, venenatis sagittis massa. Sed cursus ipsum ut quam vulputate, a efficitur leo fringilla. Ut in maximus sem. Vestibulum scelerisque, diam ac hendrerit pretium, urna metus iaculis nulla, quis mattis elit neque id nisi. Quisque rhoncus nisl varius, egestas turpis eu, tincidunt ligula.', 18, 'Soupe_9.jpg', 1, -1),
(8, 8, 'Phasellus vehicula nisi velit, in maximus arcu malesuada et. Quisque fermentum ex sit amet sem ornare vehicula. Ut ante tortor, finibus a maximus sed, commodo quis felis. Aenean vel dapibus felis, quis vestibulum massa. Aliquam pretium sem in dolor auctor, ut rhoncus ipsum accumsan. Donec sit amet ipsum sed lacus auctor pretium eget in turpis. Aliquam maximus aliquet velit vel suscipit. Aliquam et quam magna. Vestibulum maximus ullamcorper ultrices. Aenean a nulla cursus, tempor velit nec, eleifend metus.', 19, 'Soupe_14.jpg', 1, -2),
(9, 9, 'Nullam ac quam placerat odio vulputate pretium eget sed nulla. Morbi rhoncus porttitor suscipit. Integer id orci ultrices, vestibulum purus eu, vehicula dui. Maecenas sit amet sollicitudin elit. Sed faucibus gravida sem eu sollicitudin. Proin consectetur id ante vitae pulvinar. Pellentesque aliquam magna vel nisi dignissim tincidunt. Cras eget pharetra mi. Morbi consequat eget risus id pellentesque. Nunc ultrices, lacus id lobortis ornare, lectus ante vestibulum dui, vitae sollicitudin turpis eros sit amet tellus. Pellentesque ut dolor enim. Aenean quis elit et risus fringilla porttitor sit amet eu enim. Aliquam tristique tortor et dolor auctor dignissim.', 20, 'Soupe_15.jpg', 1, 6);

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `recette`
--

DROP TABLE IF EXISTS `recette`;
CREATE TABLE IF NOT EXISTS `recette` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `energy` int(11) NOT NULL,
  `fibers` int(11) NOT NULL,
  `fruit_pourcentage` int(11) NOT NULL,
  `proteins` int(11) NOT NULL,
  `satured_fats` int(11) NOT NULL,
  `sodium` int(11) NOT NULL,
  `sugar` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `recette`
--

INSERT INTO `recette` (`id`, `nom`, `energy`, `fibers`, `fruit_pourcentage`, `proteins`, `satured_fats`, `sodium`, `sugar`) VALUES
(1, 'Aliquam quis nibh', 105, 4, 60, 2, 2, 500, 10),
(2, 'Class aptent taciti', 50, 4, 80, 2, 2, 250, 10),
(3, 'Cras lacinia nulla', 108, 4, 60, 2, 2, 500, 10),
(4, 'Cras sed nunc', 105, 4, 60, 2, 2, 500, 10),
(5, 'Fusce nunc enim', 107, 4, 60, 2, 2, 500, 10),
(6, 'Morbi felis libero', 450, 4, 60, 20, 10, 350, 10),
(7, 'Nunc imperdiet lacinia', 106, 4, 60, 2, 2, 500, 10),
(8, 'Pellentesque molestie tincidunt', 107, 4, 60, 2, 2, 500, 10),
(9, 'Sed porta ac', 106, 4, 60, 2, 2, 500, 10);

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
CREATE TABLE IF NOT EXISTS `reservation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(140) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `pseudo` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `chck` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2261 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`id`, `ip`, `date`, `pseudo`, `chck`) VALUES
(2248, '::1', '2021-07-11 16:53:57', 'SPEUDO', 3),
(2249, '::1', '2021-07-11 16:55:18', 'SPEUDO', 3),
(2250, '::1', '2021-07-11 16:57:30', 'SPEUDO', 3),
(2251, '::1', '2021-07-11 16:58:23', 'SPEUDO', 3),
(2256, '::1', '2021-07-11 16:59:45', 'SPEUDO', 3),
(2258, '::1', '2021-07-11 17:02:37', 'SPEUDO', 3),
(2259, '::1', '2021-07-11 19:13:34', 'SPEUDO', 3),
(2260, '::1', '2021-07-11 19:46:22', 'SPEUDO', 3);

-- --------------------------------------------------------

--
-- Structure de la table `reservation_detail`
--

DROP TABLE IF EXISTS `reservation_detail`;
CREATE TABLE IF NOT EXISTS `reservation_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_id` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `nom_id` int(11) NOT NULL,
  `image_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_66F7360821B741A9` (`ref_id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `reservation_detail`
--

INSERT INTO `reservation_detail` (`id`, `ref_id`, `quantite`, `nom_id`, `image_id`) VALUES
(1, 2260, 1, 1, 1),
(2, 2260, 1, 2, 2),
(3, 2260, 1, 3, 3),
(4, 2259, 1, 1, 1),
(5, 2259, 1, 2, 2),
(6, 2259, 1, 3, 3),
(7, 2259, 1, 4, 4),
(8, 2259, 1, 5, 5),
(9, 2259, 1, 6, 6),
(10, 2259, 1, 7, 7),
(11, 2259, 1, 8, 8),
(12, 2259, 3, 9, 9),
(13, 2258, 2, 1, 1),
(14, 2258, 1, 2, 2),
(15, 2258, 3, 3, 3),
(16, 2258, 2, 4, 4),
(17, 2256, 1, 5, 5),
(18, 2256, 1, 6, 6),
(19, 2256, 1, 7, 7),
(20, 2256, 1, 8, 8),
(21, 2251, 1, 1, 1),
(22, 2251, 1, 2, 2),
(23, 2251, 1, 3, 3),
(24, 2251, 1, 4, 5),
(26, 2250, 1, 1, 6),
(27, 2250, 1, 2, 7),
(28, 2250, 1, 3, 8),
(29, 2249, 1, 1, 1),
(30, 2249, 1, 2, 2),
(31, 2249, 1, 3, 3),
(32, 2249, 1, 4, 4),
(33, 2248, 1, 5, 5),
(34, 2248, 1, 6, 6),
(35, 2248, 1, 7, 7),
(36, 2248, 1, 8, 8);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pass` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` int(11) NOT NULL,
  `type` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `description`
--
ALTER TABLE `description`
  ADD CONSTRAINT `FK_6DE44026C8121CE9` FOREIGN KEY (`nom_id`) REFERENCES `recette` (`id`);

--
-- Contraintes pour la table `reservation_detail`
--
ALTER TABLE `reservation_detail`
  ADD CONSTRAINT `FK_66F7360821B741A9` FOREIGN KEY (`ref_id`) REFERENCES `reservation` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
