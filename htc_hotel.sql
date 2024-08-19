-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 13 jan. 2022 à 13:15
-- Version du serveur :  10.4.17-MariaDB
-- Version de PHP : 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `htc_hotel`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `ID_CATEGORIE` int(11) NOT NULL,
  `CODE_CATEGORI` text NOT NULL,
  `CATEGORIE` varchar(255) NOT NULL,
  `PRIX_CATEGORI` varchar(255) NOT NULL,
  `PRIX_PASSAGE` varchar(30) NOT NULL,
  `DEVISE` varchar(200) NOT NULL,
  `IS_ACTIF` int(1) NOT NULL DEFAULT 1,
  `DATE_CREATION` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`ID_CATEGORIE`, `CODE_CATEGORI`, `CATEGORIE`, `PRIX_CATEGORI`, `PRIX_PASSAGE`, `DEVISE`, `IS_ACTIF`, `DATE_CREATION`) VALUES
(8, 'CATd06f4eb6b9c80ff95a04a74f7dfc7d9361df5e7869958', 'VIP', '1000', '500', 'Franc Congolais', 1, '2022-01-13 00:04:24');

-- --------------------------------------------------------

--
-- Structure de la table `chambres`
--

CREATE TABLE `chambres` (
  `ID_CHAMBRE` int(11) NOT NULL,
  `CODE_CHAMPRE` text NOT NULL,
  `NUMERO_CHAMBRE` varchar(255) NOT NULL,
  `CODE_CATEGORI` text NOT NULL,
  `CODE_TYPE_CLIENT` text NOT NULL,
  `DESCRIPTION` text NOT NULL,
  `DATE_CREATION` datetime NOT NULL DEFAULT current_timestamp(),
  `IS_ACTIF` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `chambres`
--

INSERT INTO `chambres` (`ID_CHAMBRE`, `CODE_CHAMPRE`, `NUMERO_CHAMBRE`, `CODE_CATEGORI`, `CODE_TYPE_CLIENT`, `DESCRIPTION`, `DATE_CREATION`, `IS_ACTIF`) VALUES
(6, 'CHB_62542ca9d994d1c2861edf1c78d8a5a461df62f03c82a', '23', 'CATd06f4eb6b9c80ff95a04a74f7dfc7d9361df5e7869958', '', 'oui', '2022-01-13 00:23:28', 1),
(7, 'CHB_62542ca9d994d1c2861edf1c78d8a5a461df6db63ac63', '15', 'CATd06f4eb6b9c80ff95a04a74f7dfc7d9361df5e7869958', 'CHB_1b5b7a7bce3fa1afff19dd458204007c61df6d0465ef1', 'oui', '2022-01-13 01:09:26', 1);

-- --------------------------------------------------------

--
-- Structure de la table `location_chambres`
--

CREATE TABLE `location_chambres` (
  `ID_LOCATION` int(11) NOT NULL,
  `CODE_LOCATION` text NOT NULL,
  `CODE_CHAMBRE` text NOT NULL,
  `DELAIT_LOCATION` varchar(15) NOT NULL,
  `DATE_ENTRE` varchar(20) NOT NULL,
  `DATE_SORTI` varchar(20) NOT NULL,
  `CODE_TYPE_SEJOURS` text NOT NULL,
  `PRIX_PAYER` varchar(20) NOT NULL,
  `DATE_CREATION` datetime NOT NULL DEFAULT current_timestamp(),
  `IS_ACTIF` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `role_utilisateur`
--

CREATE TABLE `role_utilisateur` (
  `ID_ROLE` int(11) NOT NULL,
  `CODE_ROLE` text NOT NULL,
  `ROLE` varchar(255) NOT NULL,
  `DATE_CREATION` datetime NOT NULL DEFAULT current_timestamp(),
  `IS_ACTIF` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `role_utilisateur`
--

INSERT INTO `role_utilisateur` (`ID_ROLE`, `CODE_ROLE`, `ROLE`, `DATE_CREATION`, `IS_ACTIF`) VALUES
(2, 'ROL_3c3de33063dca231aad7e0bc12feb2ca61df7316b6b6b', 'Admin', '2022-01-13 01:32:22', 1);

-- --------------------------------------------------------

--
-- Structure de la table `type_client`
--

CREATE TABLE `type_client` (
  `ID_TYPE_CLIENT` int(11) NOT NULL,
  `CODE_TYPE_CLIENT` text NOT NULL,
  `TYPE_CLIENT` varchar(255) NOT NULL,
  `NOMBRE_ENFANT` int(11) NOT NULL,
  `DATE_CREATION` datetime NOT NULL DEFAULT current_timestamp(),
  `IS_ACTIF` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `type_client`
--

INSERT INTO `type_client` (`ID_TYPE_CLIENT`, `CODE_TYPE_CLIENT`, `TYPE_CLIENT`, `NOMBRE_ENFANT`, `DATE_CREATION`, `IS_ACTIF`) VALUES
(2, 'CHB_1b5b7a7bce3fa1afff19dd458204007c61df6cdc7f438', 'Celibataire', 1, '2022-01-13 01:04:29', 1),
(3, 'CHB_1b5b7a7bce3fa1afff19dd458204007c61df6d0465ef1', 'Marie', 3, '2022-01-13 01:06:28', 1),
(4, 'TYC_1b5b7a7bce3fa1afff19dd458204007c61df749bf1bfe', 'Celibataire', 2, '2022-01-13 01:38:51', 1);

-- --------------------------------------------------------

--
-- Structure de la table `type_sejours`
--

CREATE TABLE `type_sejours` (
  `ID_TYPE_SEJOURS` int(11) NOT NULL,
  `CODE_TYPE_SEJOURS` text NOT NULL,
  `TYPE_SEJOURS` varchar(255) NOT NULL,
  `DATE_CREATION` datetime NOT NULL DEFAULT current_timestamp(),
  `IS_ACTIF` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `type_sejours`
--

INSERT INTO `type_sejours` (`ID_TYPE_SEJOURS`, `CODE_TYPE_SEJOURS`, `TYPE_SEJOURS`, `DATE_CREATION`, `IS_ACTIF`) VALUES
(2, 'TYS_b372676ab0564fbd350ed7aa467caf8261df748238e8e', 'Nuit', '2022-01-13 01:38:26', 1);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `ID_UTILISATEURS` int(11) NOT NULL,
  `CODE_UTILISATEUR` text NOT NULL,
  `NOM_UTILISATEUR` varchar(255) NOT NULL,
  `PSUEDO_UTILISATEUR` varchar(255) NOT NULL,
  `MOT_DE_PASS` text NOT NULL,
  `CODE_ROLE` text NOT NULL,
  `DATE_CREATION` datetime NOT NULL DEFAULT current_timestamp(),
  `IS_ACTIF` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`ID_UTILISATEURS`, `CODE_UTILISATEUR`, `NOM_UTILISATEUR`, `PSUEDO_UTILISATEUR`, `MOT_DE_PASS`, `CODE_ROLE`, `DATE_CREATION`, `IS_ACTIF`) VALUES
(1, 'UTI_d0c49d142941ba3ad8ec312ec96ebe4161df76f653f1d', 'mby', 'ou', '123', 'ROL_3c3de33063dca231aad7e0bc12feb2ca61df7316b6b6b', '2022-01-13 01:48:54', 1),
(2, 'UTI_d0c49d142941ba3ad8ec312ec96ebe4161df7834b79fb', 'Ramses', 'mby', '000', 'ROL_3c3de33063dca231aad7e0bc12feb2ca61df7316b6b6b', '2022-01-13 01:54:12', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`ID_CATEGORIE`);

--
-- Index pour la table `chambres`
--
ALTER TABLE `chambres`
  ADD PRIMARY KEY (`ID_CHAMBRE`);

--
-- Index pour la table `location_chambres`
--
ALTER TABLE `location_chambres`
  ADD PRIMARY KEY (`ID_LOCATION`);

--
-- Index pour la table `role_utilisateur`
--
ALTER TABLE `role_utilisateur`
  ADD PRIMARY KEY (`ID_ROLE`);

--
-- Index pour la table `type_client`
--
ALTER TABLE `type_client`
  ADD PRIMARY KEY (`ID_TYPE_CLIENT`);

--
-- Index pour la table `type_sejours`
--
ALTER TABLE `type_sejours`
  ADD PRIMARY KEY (`ID_TYPE_SEJOURS`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`ID_UTILISATEURS`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `ID_CATEGORIE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `chambres`
--
ALTER TABLE `chambres`
  MODIFY `ID_CHAMBRE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `location_chambres`
--
ALTER TABLE `location_chambres`
  MODIFY `ID_LOCATION` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `role_utilisateur`
--
ALTER TABLE `role_utilisateur`
  MODIFY `ID_ROLE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `type_client`
--
ALTER TABLE `type_client`
  MODIFY `ID_TYPE_CLIENT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `type_sejours`
--
ALTER TABLE `type_sejours`
  MODIFY `ID_TYPE_SEJOURS` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `ID_UTILISATEURS` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
