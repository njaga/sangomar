-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 24 oct. 2023 à 16:04
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `sangomar`
--

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `type` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `client` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `secteur_activite` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `contact` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `telephone` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `email` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `adresse` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `date_conversion` date DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  `id_client` int(11) DEFAULT NULL,
  `date_enregistrement` datetime NOT NULL DEFAULT current_timestamp(),
  `etat` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id`, `type`, `client`, `secteur_activite`, `contact`, `telephone`, `email`, `adresse`, `date_conversion`, `id_user`, `id_client`, `date_enregistrement`, `etat`) VALUES
(1, 'Client', 'Free 2', 'Téléphonie', 'Papa Meissa Wade', '+221777985034', 'lemairebassene@gmail.com', 'Dakar', '2023-01-01', 23, NULL, '2023-01-01 08:27:44', 1),
(3, 'Client', 'CMGP', 'Industrie', 'Adama Fall', '+221777985034', 'ndiaga.ndiaye@groupevigilus.com', 'Dakar', '2022-12-29', 1, NULL, '2023-01-02 10:10:08', 1),
(4, 'Client', 'Free', 'Banques', 'Adama Sarr', '+221777985034', 'lemairebassene@gmail.com', 'Dakar', NULL, 1, NULL, '2023-03-26 09:40:01', 1),
(52, 'Client', 'Rivel', 'Industrie', 'fd', '0776664910', 'pierrembagnick@gmail.com', 'ds', NULL, 1, NULL, '2023-03-27 09:33:24', 1),
(53, 'Client', 'GCO', 'Pétrole', 'Ndack NDIAYE', ' +221 76 552 57 18', 'ndack.ndiaye@eramet.com', 'Atryum Center, 6 rte de Ouakam, BP 16844 Dakar-Fann', NULL, 1, NULL, '2023-10-15 00:29:50', 1),
(54, '', '', '', '', '', '', '', NULL, 1, NULL, '2023-10-15 00:29:50', 1);

-- --------------------------------------------------------

--
-- Structure de la table `departement`
--

CREATE TABLE `departement` (
  `id` int(11) NOT NULL,
  `nom` mediumtext DEFAULT NULL,
  `id_succursale` int(11) NOT NULL,
  `etat` int(11) NOT NULL DEFAULT 1,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `departement`
--

INSERT INTO `departement` (`id`, `nom`, `id_succursale`, `etat`, `id_user`) VALUES
(1, 'Ressources Humaines', 1, 1, 1),
(2, 'Informatique', 1, 1, 1),
(3, 'Gardiennage', 1, 1, 1),
(4, 'Comptabilite', 1, 1, 1),
(5, 'Monetique', 1, 1, 1),
(6, 'ATEX', 1, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `extincteur`
--

CREATE TABLE `extincteur` (
  `id` int(11) NOT NULL,
  `date_ajout` date DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `extincteur` text DEFAULT NULL,
  `emplacement` text NOT NULL,
  `marque` text NOT NULL,
  `annee_fabrication` int(11) NOT NULL,
  `date_derniere_verif` date DEFAULT NULL,
  `type_dernier_verif` text DEFAULT NULL,
  `verificateur` longtext DEFAULT NULL,
  `id_site` int(11) DEFAULT NULL,
  `etat` int(11) NOT NULL DEFAULT 1,
  `date_enregistrement` datetime NOT NULL DEFAULT current_timestamp(),
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `extincteur`
--

INSERT INTO `extincteur` (`id`, `date_ajout`, `type`, `extincteur`, `emplacement`, `marque`, `annee_fabrication`, `date_derniere_verif`, `type_dernier_verif`, `verificateur`, `id_site`, `etat`, `date_enregistrement`, `id_user`) VALUES
(1, '2023-03-21', 'Sparklet', 'NC 2Kg', 'Test', 'Eurofeu', 2345, NULL, NULL, NULL, 1, 1, '2023-03-21 07:35:24', 1),
(2, '0000-00-00', '', '', '', '', 0, NULL, NULL, NULL, 0, 1, '2023-03-21 07:35:24', 1),
(3, '2023-03-22', 'CO2', 'Poudre 25Kg', 'Emplacement 1', 'Eurofeu', 2022, '2023-02-28', 'V10', 'LEMAIRE', 1, 1, '2023-03-22 13:28:52', 1),
(4, '0000-00-00', '', '', '', '', 0, NULL, NULL, '', 0, 1, '2023-03-22 13:28:52', 1),
(5, '2023-03-22', 'Azote', 'NC 2Kg', 'Emplacement 1', 'Eurofeu', 2023, '2023-03-14', 'V10', '', 1, 1, '2023-03-22 14:18:43', 1),
(6, '0000-00-00', '', '', '', '', 0, NULL, NULL, '', 0, 1, '2023-03-22 14:18:43', 1),
(7, '2023-03-27', 'Sparklet', 'Poudre 9Kg', 'Emplacement 1', 'Test', 2018, NULL, NULL, '', 16, 1, '2023-03-27 09:35:31', 1),
(8, '2023-03-27', 'Azote', 'NC 5Kg', 'Emplacement 2', 'Test', 2008, NULL, NULL, '', 16, 1, '2023-03-27 09:36:14', 1),
(9, '2023-03-27', 'CO2', 'Eau + Additif 25Kg', 'Emplacement 2', 'Test', 2010, NULL, NULL, '', 15, 1, '2023-03-27 14:32:32', 1),
(10, '2023-03-27', 'CO2', 'Poudre 9Kg', 'Emplacement 1', 'Test', 2022, NULL, NULL, '', 16, 1, '2023-03-27 15:44:32', 1),
(11, '2023-10-15', 'Azote', 'Poudre 9Kg', 'caserne', 'Cefi', 2019, NULL, NULL, 'CEFI', 1, 1, '2023-10-14 23:35:30', 1),
(12, '0000-00-00', '', '', '', '', 0, NULL, NULL, '', 0, 1, '2023-10-14 23:35:31', 1),
(13, '2023-10-15', 'Azote', 'Poudre 9Kg', 'caserne', 'Cefi', 2019, NULL, NULL, 'CEFI', 17, 1, '2023-10-15 00:38:41', 1),
(14, '0000-00-00', '', '', '', '', 0, NULL, NULL, '', 0, 1, '2023-10-15 00:38:41', 1),
(15, '2023-06-27', 'Azote', 'Poudre 9Kg', 'environnement', 'Eurofeu', 2022, NULL, NULL, 'CEFI', 17, 1, '2023-10-15 00:40:15', 1),
(16, '0000-00-00', '', '', '', '', 0, NULL, NULL, '', 0, 1, '2023-10-15 00:40:16', 1);

-- --------------------------------------------------------

--
-- Structure de la table `ria_pia`
--

CREATE TABLE `ria_pia` (
  `id` int(11) NOT NULL,
  `date_ajout` date DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `emplacement` text NOT NULL,
  `marque` text NOT NULL,
  `annee_fabrication` int(11) NOT NULL,
  `date_derniere_verif` date DEFAULT NULL,
  `type_dernier_verif` text DEFAULT NULL,
  `verificateur` longtext DEFAULT NULL,
  `id_site` int(11) DEFAULT NULL,
  `etat` int(11) NOT NULL DEFAULT 1,
  `date_enregistrement` datetime NOT NULL DEFAULT current_timestamp(),
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `ria_pia`
--

INSERT INTO `ria_pia` (`id`, `date_ajout`, `type`, `emplacement`, `marque`, `annee_fabrication`, `date_derniere_verif`, `type_dernier_verif`, `verificateur`, `id_site`, `etat`, `date_enregistrement`, `id_user`) VALUES
(1, '2023-03-27', 'RIA', 'Emplacement 1', 'Test', 0, NULL, NULL, NULL, 1, 1, '2023-03-27 00:37:50', 1),
(2, '2023-02-28', 'RIA', 'Emplacement 2', 'Test', 0, '2023-03-08', 'V5', 'Lemaire', 1, 1, '2023-03-27 00:38:51', 1),
(4, '2023-03-27', 'PIA', 'Local Technique ', 'Rpons', 0, '2022-02-01', '', '', 17, 1, '2023-03-27 09:44:25', 1),
(5, '2023-03-27', 'RIA', 'Local Technique ', 'Rpons', 0, '2022-02-01', '', '', 17, 1, '2023-03-27 10:19:15', 1);

-- --------------------------------------------------------

--
-- Structure de la table `site`
--

CREATE TABLE `site` (
  `id` int(11) NOT NULL,
  `nom` mediumtext DEFAULT NULL,
  `localisation` mediumtext DEFAULT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date DEFAULT NULL,
  `id_client` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `etat` int(11) NOT NULL DEFAULT 1,
  `date_enregistrement` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `site`
--

INSERT INTO `site` (`id`, `nom`, `localisation`, `date_debut`, `date_fin`, `id_client`, `id_user`, `etat`, `date_enregistrement`) VALUES
(1, 'VIGILUS GROUPE SA', 'Mbour', '2023-01-13', NULL, 1, 1, 1, '2023-03-21 00:56:04'),
(11, 'Site 2', 'Mbour', '2023-03-22', NULL, 1, 1, 1, '2023-03-21 01:01:27'),
(12, '', '', '0000-00-00', NULL, 0, 1, 1, '2023-03-21 01:01:28'),
(13, 'Site 3', 'Mbour', '2023-03-07', NULL, 1, 1, 1, '2023-03-21 07:36:20'),
(14, '', '', '0000-00-00', NULL, 0, 1, 1, '2023-03-21 07:36:20'),
(15, 'Site 1', 'Dakar', '2023-03-13', NULL, 52, 1, 1, '2023-03-27 09:34:24'),
(16, 'Site 21', 'Mbour', '2023-03-13', NULL, 52, 1, 1, '2023-03-27 09:34:35'),
(17, 'Camp de base vie', 'Pres de Diogo', '2023-06-14', NULL, 53, 1, 1, '2023-10-15 00:32:15'),
(18, '', '', '0000-00-00', NULL, 0, 1, 1, '2023-10-15 00:32:16');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `prenom` mediumtext NOT NULL,
  `nom` mediumtext NOT NULL,
  `profil` varchar(255) DEFAULT NULL,
  `telephone` mediumtext NOT NULL,
  `email` mediumtext NOT NULL,
  `login` mediumtext NOT NULL,
  `pwd` longtext NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `etat` int(11) NOT NULL DEFAULT 1,
  `date_enregistrement` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `prenom`, `nom`, `profil`, `telephone`, `email`, `login`, `pwd`, `id_user`, `etat`, `date_enregistrement`) VALUES
(1, 'khalifa', 'bassene', 'ass_op', '77 798 50 56', 'khalifa.ababacar@vigilus-securite.com', 'bassene@vigilus', '3bbe29e8ef937d488ec97d95b0db61d8db5706da', 1, 1, '2021-01-27 13:49:36'),
(23, 'Rivel', 'Mibansa', 'ass_op', '77 798 50 56', 'khalifa.ababacar@vigilus-securite.com', 'mibansa@vigilus', '3bbe29e8ef937d488ec97d95b0db61d8db5706da', 1, 1, '2022-11-14 08:13:36'),
(24, 'Ndeye Khar', 'SOW', 'ass_op', '77 798 50 56', 'khalifa.ababacar@vigilus-securite.com', 'khar.sow@vigilus', '3bbe29e8ef937d488ec97d95b0db61d8db5706da', 1, 1, '2022-11-14 08:13:36'),
(25, 'Khady', 'FALL', 'ass_op', '77 798 50 56', 'khalifa.ababacar@vigilus-securite.com', 'khady.fall@vigilus', '3bbe29e8ef937d488ec97d95b0db61d8db5706da', 1, 1, '2022-11-14 08:13:36'),
(26, 'Coumba', 'PENE', 'ass_op', '77 798 50 56', 'khalifa.ababacar@vigilus-securite.com', 'coumba.pene@vigilus', '3bbe29e8ef937d488ec97d95b0db61d8db5706da', 1, 1, '2022-11-14 08:13:36'),
(27, 'Khadidiatou', 'Mane', 'ass_op', '77 798 50 56', 'khalifa.ababacar@vigilus-securite.com', 'khadidiatou@vigilus', '3bbe29e8ef937d488ec97d95b0db61d8db5706da', 1, 1, '2022-11-14 08:13:36');

-- --------------------------------------------------------

--
-- Structure de la table `verfi_extincteur`
--

CREATE TABLE `verfi_extincteur` (
  `id` int(11) NOT NULL,
  `date_verif` date DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `pression_relevee` float NOT NULL,
  `chargeur_ref` varchar(255) NOT NULL,
  `poids_max` float NOT NULL,
  `poids_min` int(11) NOT NULL,
  `tare` int(11) NOT NULL,
  `poids_gaz` int(11) DEFAULT NULL,
  `a_fixer` int(11) DEFAULT NULL,
  `panneau` int(11) DEFAULT NULL,
  `poids_mesurer` float DEFAULT NULL,
  `num_ext_pan` varchar(255) DEFAULT NULL,
  `ch_a_faire` text DEFAULT NULL,
  `rep_a_faire` text DEFAULT NULL,
  `commentaire` longtext DEFAULT NULL,
  `date_derniere_verif` date DEFAULT NULL,
  `id_verification` int(11) DEFAULT NULL,
  `etat` int(11) NOT NULL DEFAULT 1,
  `date_enregistrement` datetime NOT NULL DEFAULT current_timestamp(),
  `id_extincteur` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `verfi_extincteur`
--

INSERT INTO `verfi_extincteur` (`id`, `date_verif`, `type`, `pression_relevee`, `chargeur_ref`, `poids_max`, `poids_min`, `tare`, `poids_gaz`, `a_fixer`, `panneau`, `poids_mesurer`, `num_ext_pan`, `ch_a_faire`, `rep_a_faire`, `commentaire`, `date_derniere_verif`, `id_verification`, `etat`, `date_enregistrement`, `id_extincteur`, `id_user`) VALUES
(75, '2023-03-26', 'V10', 3, '0', 0, 0, 0, 0, 0, 0, 0, '', '0', '', '', NULL, 1, 1, '2023-03-26 08:38:03', 5, 1),
(76, '0000-00-00', '', 0, '0', 0, 0, 0, 0, 0, 0, 0, '', '0', '', '', NULL, 0, 1, '2023-03-26 08:38:03', 0, 1),
(77, '2023-03-26', 'VA', 0, '0', 0, 0, 0, 0, 0, 0, 0, '', '0', '', '', NULL, 1, 1, '2023-03-27 08:42:35', 75, 1),
(78, '2023-03-27', 'VA', 0, '0', 256, 252, 0, 0, 1, 1, 250, '', '0', '', 'Test', NULL, 9, 1, '2023-03-27 09:37:48', 7, 1),
(79, '2023-03-27', 'VA', 0, '0', 256, 252, 0, 0, 1, 1, 250, '', '0', '', 'Test', NULL, 9, 1, '2023-03-27 09:38:11', 78, 1);

-- --------------------------------------------------------

--
-- Structure de la table `verfi_ria`
--

CREATE TABLE `verfi_ria` (
  `id` int(11) NOT NULL,
  `date_verif` date DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `dn` int(11) DEFAULT NULL,
  `lj` int(11) DEFAULT NULL,
  `vanne_barrage` varchar(255) DEFAULT NULL,
  `vanne_ria_pia` text DEFAULT NULL,
  `boite_eau` varchar(255) DEFAULT NULL,
  `devidoir_tambour` varchar(255) DEFAULT NULL,
  `diffuseur` varchar(255) NOT NULL,
  `panneau` int(11) DEFAULT NULL,
  `hs` varchar(255) DEFAULT NULL,
  `commentaire` longtext DEFAULT NULL,
  `date_derniere_verif` date DEFAULT NULL,
  `id_verification` int(11) DEFAULT NULL,
  `etat` int(11) NOT NULL DEFAULT 1,
  `date_enregistrement` datetime NOT NULL DEFAULT current_timestamp(),
  `id_ria` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `verfi_ria`
--

INSERT INTO `verfi_ria` (`id`, `date_verif`, `type`, `dn`, `lj`, `vanne_barrage`, `vanne_ria_pia`, `boite_eau`, `devidoir_tambour`, `diffuseur`, `panneau`, `hs`, `commentaire`, `date_derniere_verif`, `id_verification`, `etat`, `date_enregistrement`, `id_ria`, `id_user`) VALUES
(1, '2023-03-27', 'VA', 25, 5, 'Pas de vanne', NULL, 'Grande fuite', 'A dégriper', 'RAS', 0, 'Hors Service', 'test', NULL, 1, 1, '2023-03-27 05:32:33', 1, 1),
(2, '2023-03-27', 'VA', 25, 5, 'Pas de vanne', NULL, 'Petite fuite', 'A redresser', 'Fuite', 1, 'Hors Service', 'test', NULL, 1, 1, '2023-03-27 05:34:20', 1, 1),
(3, '2023-03-27', 'VA', 33, 5, 'RAS', NULL, 'Petite fuite', 'A redresser', 'Fuite', 0, 'Hors Service', 'test', NULL, 2, 1, '2023-03-27 08:36:17', 2, 1),
(4, '2023-03-27', 'VA', 19, 5, 'RAS', NULL, 'RAS', 'RAS', 'RAS', 0, 'Hors Service', 'test', NULL, 1, 1, '2023-03-27 08:36:35', 1, 1),
(5, '2023-03-27', 'VA', 25, 5, 'RAS', NULL, 'RAS', 'A redresser', 'RAS', 0, 'Hors Service', 'test', NULL, 1, 1, '2023-03-27 08:37:58', 1, 1),
(6, '2023-03-27', 'VA', 25, 5, 'RAS', NULL, 'RAS', 'A redresser', 'Bloqué', 0, '', 'test', NULL, 1, 1, '2023-03-27 08:39:24', 1, 1),
(7, '2023-03-27', 'VA', 25, 5, 'RAS', NULL, 'RAS', 'A redresser', 'Bloqué', 0, '', 'test', NULL, 1, 1, '2023-03-27 08:39:34', 1, 1),
(8, '2023-03-27', 'VA', 25, 5, 'RAS', NULL, 'RAS', 'A redresser', 'Fuite', 0, '', 'test', NULL, 1, 1, '2023-03-27 08:39:49', 1, 1),
(9, '2023-03-27', 'VA', 33, 12, 'Poignée 1/4 tour cassé', 'Petite fuite', 'Petite fuite', 'A dégriper', 'RAS', 0, 'Hors Service', 'Aucun', NULL, 9, 1, '2023-03-27 09:49:33', 4, 1);

-- --------------------------------------------------------

--
-- Structure de la table `verification`
--

CREATE TABLE `verification` (
  `id` int(11) NOT NULL,
  `type_verif` varchar(255) DEFAULT NULL,
  `date_debut` date NOT NULL,
  `date_prevu_fin` date NOT NULL,
  `date_fin` date DEFAULT NULL,
  `id_client` int(11) NOT NULL,
  `commentaire` text DEFAULT NULL,
  `rapport` longtext DEFAULT NULL,
  `etat` int(11) DEFAULT 1,
  `date_enregistrement` datetime NOT NULL DEFAULT current_timestamp(),
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `verification`
--

INSERT INTO `verification` (`id`, `type_verif`, `date_debut`, `date_prevu_fin`, `date_fin`, `id_client`, `commentaire`, `rapport`, `etat`, `date_enregistrement`, `id_user`) VALUES
(1, 'Vérification Annuelle', '2023-03-19', '2023-04-08', '2023-03-27', 1, 'Test', 'OK c\'est bon', 1, '2023-03-19 15:52:05', 1),
(3, 'Vérification Annuelle', '2023-03-14', '2023-04-06', NULL, 2, '', NULL, 1, '2023-03-20 14:13:13', 1),
(4, '', '0000-00-00', '0000-00-00', NULL, 0, '', NULL, 1, '2023-03-20 14:13:14', 1),
(5, 'Vérification Annuelle', '2023-03-20', '2023-03-30', NULL, 2, 'Test', NULL, 1, '2023-03-26 23:42:58', 1),
(6, 'Vérification Annuelle', '2023-03-09', '2023-03-30', NULL, 4, 'OK pour moi', NULL, 1, '2023-03-26 23:46:17', 1),
(7, 'Vérification Annuelle', '2023-03-09', '2023-03-30', NULL, 4, 'OK pour moi', NULL, 1, '2023-03-26 23:46:23', 1),
(8, 'Vérification Annuelle', '2023-03-20', '2023-03-27', NULL, 1, 'Aucun commenatire', NULL, 1, '2023-03-27 09:32:27', 1),
(9, 'Vérification Annuelle', '2023-03-13', '2023-03-27', NULL, 52, 'C\'est un bon client', NULL, 1, '2023-03-27 09:33:55', 1),
(10, 'Vérification Annuelle', '2023-10-15', '2023-08-01', NULL, 53, '', NULL, 1, '2023-10-15 00:33:30', 1),
(11, '', '0000-00-00', '0000-00-00', NULL, 0, '', NULL, 1, '2023-10-15 00:33:31', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `departement`
--
ALTER TABLE `departement`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `extincteur`
--
ALTER TABLE `extincteur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ria_pia`
--
ALTER TABLE `ria_pia`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `site`
--
ALTER TABLE `site`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `verfi_extincteur`
--
ALTER TABLE `verfi_extincteur`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_extincteur` (`id_extincteur`),
  ADD KEY `id_verification` (`id_verification`);

--
-- Index pour la table `verfi_ria`
--
ALTER TABLE `verfi_ria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_extincteur` (`id_ria`),
  ADD KEY `id_verification` (`id_verification`);

--
-- Index pour la table `verification`
--
ALTER TABLE `verification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_client` (`id_client`),
  ADD KEY `id_user` (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT pour la table `departement`
--
ALTER TABLE `departement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `extincteur`
--
ALTER TABLE `extincteur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `ria_pia`
--
ALTER TABLE `ria_pia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `site`
--
ALTER TABLE `site`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `verfi_extincteur`
--
ALTER TABLE `verfi_extincteur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT pour la table `verfi_ria`
--
ALTER TABLE `verfi_ria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `verification`
--
ALTER TABLE `verification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
