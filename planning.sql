-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : jeu. 26 sep. 2024 à 16:18
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `planning`
--

-- --------------------------------------------------------

--
-- Structure de la table `Classes`
--

CREATE TABLE `Classes` (
  `id` int(11) NOT NULL,
  `nom_classe` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Classes`
--

INSERT INTO `Classes` (`id`, `nom_classe`) VALUES
(1, 'M1dev IA'),
(2, 'M2dev IA'),
(3, 'SN1 a'),
(4, 'SN1 b'),
(5, 'SN2 a'),
(6, 'SN2 b'),
(7, 'B3 IA'),
(8, 'B3 DEVOPS'),
(9, 'M1 DEVOPS'),
(10, 'M2 DEVOPS');

-- --------------------------------------------------------

--
-- Structure de la table `Planning`
--

CREATE TABLE `Planning` (
  `id` int(11) NOT NULL,
  `id_classe` int(11) DEFAULT NULL,
  `id_salle` int(11) DEFAULT NULL,
  `id_prof` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `heure_debut` time DEFAULT NULL,
  `heure_fin` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Planning`
--

INSERT INTO `Planning` (`id`, `id_classe`, `id_salle`, `id_prof`, `date`, `heure_debut`, `heure_fin`) VALUES
(1, 1, 1, NULL, '2024-09-23', '09:00:00', '11:00:00'),
(2, 2, 2, NULL, '2024-09-23', '11:00:00', '13:00:00'),
(3, 3, 3, NULL, '2024-09-23', '09:00:00', '12:00:00'),
(4, 4, 1, NULL, '2024-09-23', '13:00:00', '16:00:00'),
(5, 5, 2, NULL, '2024-09-23', '15:00:00', '17:00:00'),
(6, 6, 3, NULL, '2024-09-24', '09:00:00', '11:00:00'),
(7, 7, 1, NULL, '2024-09-24', '14:00:00', '16:00:00'),
(8, 8, 2, NULL, '2024-09-24', '09:00:00', '12:00:00'),
(9, 9, 3, NULL, '2024-09-24', '13:00:00', '16:00:00'),
(10, 10, 1, NULL, '2024-09-24', '11:00:00', '13:00:00'),
(11, 1, 3, NULL, '2024-09-25', '09:00:00', '11:00:00'),
(12, 2, 2, NULL, '2024-09-25', '11:00:00', '13:00:00'),
(13, 3, 1, NULL, '2024-09-25', '09:00:00', '12:00:00'),
(14, 4, 2, NULL, '2024-09-25', '13:00:00', '16:00:00'),
(15, 5, 3, NULL, '2024-09-25', '15:00:00', '17:00:00'),
(16, 1, 1, NULL, '2024-09-26', '09:00:00', '12:00:00'),
(17, 2, 2, NULL, '2024-09-26', '09:00:00', '11:00:00'),
(18, 3, 3, NULL, '2024-09-26', '09:00:00', '12:00:00'),
(20, 5, 2, NULL, '2024-09-26', '11:00:00', '14:00:00'),
(21, 6, 3, NULL, '2024-09-26', '12:00:00', '15:00:00'),
(23, 8, 2, NULL, '2024-09-26', '14:00:00', '17:00:00'),
(25, 10, 1, NULL, '2024-09-26', '15:00:00', '17:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `Prof`
--

CREATE TABLE `Prof` (
  `id_prof` int(3) NOT NULL,
  `Nom` varchar(30) NOT NULL,
  `Prenom` varchar(30) NOT NULL,
  `Matiere` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Salles`
--

CREATE TABLE `Salles` (
  `id` int(11) NOT NULL,
  `nom_salle` varchar(255) NOT NULL,
  `capacite` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Salles`
--

INSERT INTO `Salles` (`id`, `nom_salle`, `capacite`) VALUES
(1, 'Salle 101', 30),
(2, 'Salle 102', 25),
(3, 'Salle 103', 20);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Classes`
--
ALTER TABLE `Classes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Planning`
--
ALTER TABLE `Planning`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_classe` (`id_classe`),
  ADD KEY `id_salle` (`id_salle`),
  ADD KEY `fk_prof` (`id_prof`);

--
-- Index pour la table `Prof`
--
ALTER TABLE `Prof`
  ADD PRIMARY KEY (`id_prof`);

--
-- Index pour la table `Salles`
--
ALTER TABLE `Salles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Classes`
--
ALTER TABLE `Classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `Planning`
--
ALTER TABLE `Planning`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pour la table `Prof`
--
ALTER TABLE `Prof`
  MODIFY `id_prof` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Salles`
--
ALTER TABLE `Salles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Planning`
--
ALTER TABLE `Planning`
  ADD CONSTRAINT `fk_prof` FOREIGN KEY (`id_prof`) REFERENCES `Prof` (`id_prof`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `planning_ibfk_1` FOREIGN KEY (`id_classe`) REFERENCES `Classes` (`id`),
  ADD CONSTRAINT `planning_ibfk_2` FOREIGN KEY (`id_salle`) REFERENCES `Salles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
