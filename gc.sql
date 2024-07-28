-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 22 jan. 2022 à 12:45
-- Version du serveur :  10.4.18-MariaDB
-- Version de PHP : 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gc`
--

-- --------------------------------------------------------

--
-- Structure de la table `absence`
--

CREATE TABLE `absence` (
  `id` int(11) NOT NULL,
  `employe` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  `type` int(11) NOT NULL COMMENT '0= 1 jr / 1= demi journée',
  `etat` int(11) NOT NULL COMMENT '0 : justifié / 1 = non justifier'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `absence`
--

INSERT INTO `absence` (`id`, `employe`, `date`, `type`, `etat`) VALUES
(2, 1, '2022-01-22', 0, 0),
(3, 5, '2022-01-22', 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `conge`
--

CREATE TABLE `conge` (
  `id` int(11) NOT NULL,
  `employe` int(11) DEFAULT NULL,
  `du` date DEFAULT NULL,
  `au` date DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `certificat` text DEFAULT NULL,
  `etat` int(11) DEFAULT NULL,
  `commantaire` text DEFAULT NULL,
  `date_insertion` date DEFAULT NULL,
  `user` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `conge`
--

INSERT INTO `conge` (`id`, `employe`, `du`, `au`, `type`, `certificat`, `etat`, `commantaire`, `date_insertion`, `user`) VALUES
(116, 1, '2022-01-09', '2022-01-12', 3, '', 1, 'dd', '2022-01-08', 'tarik.amoum@gmail.com'),
(117, 4, '2022-01-08', '2022-01-12', 1, '', 1, 'dd', '2022-01-08', 'tarik.amoum@gmail.com'),
(118, 1, '2022-01-09', '2022-01-21', 2, '0cc443c491fe8ccecc3f3db1b6380614.xlsx', 1, 'dd', '2022-01-08', 'tarik.amoum@gmail.com'),
(119, 4, '2022-01-09', '2022-01-21', 2, '7b45c59b6afd2acdcd334aebb167c572.xlsx', 2, 'dd', '2022-01-08', 'tarik.amoum@gmail.com'),
(129, 1, '2022-01-09', '2022-01-16', 2, '', 1, 'dd', '2022-01-08', 'tarik.amoum@gmail.com'),
(128, 1, '2022-01-23', '2022-01-25', 1, '', 1, 'dd', '2022-01-08', 'tarik.amoum@gmail.com'),
(130, 1, '2022-01-10', '2022-01-14', 4, '', 2, 'dd', '2022-01-09', 'tarik.amoum@gmail.com'),
(131, 1, '2022-01-09', '2022-01-11', 2, '0a1829b5a90ee0f4f44d2af388c8958c.xls', 0, 'ljmljm', '2022-01-09', 'tarik.amoum@gmail.com'),
(132, 1, '2022-01-16', '2022-01-19', 1, '', 1, 'dd', '2022-01-15', 'tarik.amoum@gmail.com'),
(133, 5, '2022-02-22', '2022-02-27', 1, '', 2, 'vacance', '2022-01-22', 'abdellah.dossbennani@gmail.com'),
(134, 5, '2022-02-22', '2022-02-27', 1, '', 1, 'vacance', '2022-01-22', 'abdellah.dossbennani@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `employe`
--

CREATE TABLE `employe` (
  `id` int(11) NOT NULL,
  `nom` text DEFAULT NULL,
  `prenom` text DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `adresse` text DEFAULT NULL,
  `cin` text DEFAULT NULL,
  `tel` text DEFAULT NULL,
  `base_taux` int(11) DEFAULT NULL,
  `email` text DEFAULT NULL,
  `password` text DEFAULT NULL,
  `etat` int(11) DEFAULT NULL,
  `user` text DEFAULT NULL,
  `date_insertion` datetime DEFAULT NULL,
  `image` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `employe`
--

INSERT INTO `employe` (`id`, `nom`, `prenom`, `date_naissance`, `adresse`, `cin`, `tel`, `base_taux`, `email`, `password`, `etat`, `user`, `date_insertion`, `image`) VALUES
(1, 'AMOUM', 'TARIK', '1968-07-19', 'N7 IM52 Hay Nakhil ZOUAGHA HAUT FES', 'C179965', '0661233027', 22, 'tarik.amoum@gmail.com', 'f7acebcfade8acc6313cef4078a404edcc27bfd8', 1, 'rh@ecamaroc.com', '2020-01-27 16:40:49', NULL),
(4, 'GUEROUANI', 'Mouna', '1968-12-19', '26, Rue ex - RABAT', 'A355652', '0667679329', 23, 'admin@admin.com', 'adcd7048512e64b48da55b027577886ee5a36350', 0, 'rh@ecamaroc.com', '2020-02-05 09:27:17', NULL),
(5, 'Bennani', 'abdellah', '1985-07-09', 'Fes ATLAS', 'c947306', '060011223344', 18, 'abdellah.dossbennani@gmail.com', '10470c3b4b1fed12c3baac014be15fac67c6e815', 1, 'admin@admin.com', '2022-01-22 10:05:10', '2a87b648dc6560b987c8ceb4f7c76d5e.png'),
(7, 'HAYAT', 'Hamza', '1999-01-01', 'bensodua fes', 'C123321', '0632547896541', 18, 'hamza@gmail.com', '10470c3b4b1fed12c3baac014be15fac67c6e815', 1, 'admin@admin.com', '2022-01-22 11:58:58', '7a66adee8445b14c9d44ff4a2f60a8a9.JPG');

-- --------------------------------------------------------

--
-- Structure de la table `jour_ferier`
--

CREATE TABLE `jour_ferier` (
  `id` int(11) NOT NULL,
  `titre` text DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `jour_ferier`
--

INSERT INTO `jour_ferier` (`id`, `titre`, `date`) VALUES
(1, 'Manifeste de l’Indépendance', '2022-01-11'),
(2, 'Fête du travail', '2022-05-01'),
(3, 'Aïd Al Fitr', '2022-05-05'),
(4, 'Fête du Trône', '2022-07-30'),
(5, 'Aid al Adha', '2022-07-31'),
(6, 'Journée d’Oued Ed-Dahab', '2022-08-14'),
(7, 'La révolution du Roi et du peuple', '2022-08-20'),
(8, 'Premier Moharram', '2022-08-20'),
(9, 'Fête de la Jeunesse', '2022-08-21'),
(10, 'Aid al Mawlid Annabawi', '2022-10-29'),
(11, 'Marche verte', '2022-11-06'),
(12, 'Fête de l’indépendance', '2022-11-18');

-- --------------------------------------------------------

--
-- Structure de la table `type_conge`
--

CREATE TABLE `type_conge` (
  `id` int(11) NOT NULL,
  `titre` text DEFAULT NULL,
  `nbr_jrs` int(11) DEFAULT NULL,
  `lettre` text DEFAULT NULL,
  `accord` text DEFAULT NULL,
  `refus` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `type_conge`
--

INSERT INTO `type_conge` (`id`, `titre`, `nbr_jrs`, `lettre`, `accord`, `refus`) VALUES
(1, 'Congé payé', NULL, 'demande-conge-paye.php', 'accord-conge-paye.php', 'refus-conge-paye.php'),
(2, 'Congé maladie', NULL, 'demande-conge-maladi.php', 'reception-certificat.php', NULL),
(3, 'Congé de Naissance', 3, 'demande-conge-familial.php', 'naissance-enfant.php', NULL),
(4, 'Congé de Mariage du salarié', 4, 'demande-conge-familial.php', 'mariage-salarie.php', NULL),
(5, 'Congé de Mariage d\'un enfant du salarié', 2, 'demande-conge-familial.php', 'mariage-enfant-salarie.php', NULL),
(6, 'Congé de Mariage d\'un enfant issu d\'un précédent mariage du conjoint ', 2, 'demande-conge-familial.php', 'mariage-enfant-issu.php', NULL),
(7, 'Congé de Décès d\'un conjoint', 3, 'demande-conge-familial.php', 'reponse-absence-exeptionel.php', NULL),
(8, 'Congé de Décès d\'un enfant, d\'un petit enfant', 3, 'demande-conge-familial.php', 'reponse-absence-exeptionel.php', NULL),
(9, 'Congé de Décès d\'un ascendant ', 3, 'demande-conge-familial.php', 'reponse-absence-exeptionel.php', NULL),
(10, 'Congé de Décès d\'un enfant issu d\'un précédent mariage du conjoint ', 3, 'demande-conge-familial.php', 'reponse-absence-exeptionel.php', NULL),
(11, 'Congé de Décès d\'un frère, d\'une sœur du salarié, d\'un frère ou d\'une sœur du conjoint de celui-ci ou d\'un ascendant du conjoint', 2, 'demande-conge-familial.php', 'reponse-absence-exeptionel.php', NULL),
(12, 'Congé de Circoncision', 2, 'demande-conge-familial.php', 'reponse-absence-exeptionel2.php', NULL),
(13, 'Congé d’Opération chirurgicale du conjoint', 2, 'demande-conge-familial.php', 'reponse-absence-exeptionel3.php', NULL),
(14, 'Congé d’Opération chirurgicale d\'un enfant à charge', 2, 'demande-conge-familial.php', 'reponse-absence-exeptionel4.php', NULL),
(15, 'Congé de maternité', 98, 'demande-conge-maternite.php', 'accord-conge-maternite.php', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `absence`
--
ALTER TABLE `absence`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `conge`
--
ALTER TABLE `conge`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `employe`
--
ALTER TABLE `employe`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `jour_ferier`
--
ALTER TABLE `jour_ferier`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `type_conge`
--
ALTER TABLE `type_conge`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `absence`
--
ALTER TABLE `absence`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `conge`
--
ALTER TABLE `conge`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT pour la table `employe`
--
ALTER TABLE `employe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `jour_ferier`
--
ALTER TABLE `jour_ferier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `type_conge`
--
ALTER TABLE `type_conge`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
