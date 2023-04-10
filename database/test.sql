-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 11 avr. 2023 à 00:14
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `prwb_2223_a10`
--

-- --------------------------------------------------------

--
-- Structure de la table `tricounts`
--

CREATE TABLE `tricounts` (
  `id` int(11) NOT NULL,
  `title` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `creator` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `tricounts`
--

INSERT INTO `tricounts` (`id`, `title`, `description`, `created_at`, `creator`) VALUES
(1, 'Gers 2022', NULL, '2022-10-10 18:42:24', 1),
(2, 'Resto badminton', NULL, '2022-10-10 19:25:10', 1),
(4, 'Vacances', 'A la mer du nord', '2022-10-10 19:31:09', 1),
(5, 'vacances', 'thailande(after edit)', '2023-04-10 17:20:24', 5),
(6, 'paris', 'trttttt', '2023-04-10 19:50:28', 6);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `tricounts`
--
ALTER TABLE `tricounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Title` (`title`,`creator`),
  ADD KEY `Creator` (`creator`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `tricounts`
--
ALTER TABLE `tricounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `tricounts`
--
ALTER TABLE `tricounts`
  ADD CONSTRAINT `tricounts_ibfk_1` FOREIGN KEY (`creator`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
