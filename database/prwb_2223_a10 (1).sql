-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 06 feb 2023 om 03:23
-- Serverversie: 10.4.24-MariaDB
-- PHP-versie: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prwb_2223_a10`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `operations`
--

CREATE TABLE `operations` (
  `id` int(11) NOT NULL,
  `title` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `tricount` int(11) NOT NULL,
  `amount` double NOT NULL,
  `operation_date` date NOT NULL,
  `initiator` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `operations`
--

INSERT INTO `operations` (`id`, `title`, `tricount`, `amount`, `operation_date`, `initiator`, `created_at`) VALUES
(1, 'Colruyt', 4, 100, '2022-10-13', 2, '2022-10-13 19:09:18'),
(2, 'Plein essence', 4, 75, '2022-10-13', 1, '2022-10-13 20:10:41'),
(3, 'Grosses courses LIDL', 4, 212.47, '2022-10-13', 3, '2022-10-13 21:23:49'),
(4, 'Apéros', 4, 31.897456217, '2022-10-13', 1, '2022-10-13 23:51:20'),
(5, 'Boucherie', 4, 25.5, '2022-10-26', 2, '2022-10-26 09:59:56'),
(6, 'Loterie', 4, 35, '2022-10-26', 1, '2022-10-26 10:02:24');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `repartitions`
--

CREATE TABLE `repartitions` (
  `operation` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `weight` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `repartitions`
--

INSERT INTO `repartitions` (`operation`, `user`, `weight`) VALUES
(1, 1, 1),
(1, 2, 1),
(2, 1, 1),
(2, 2, 1),
(3, 1, 2),
(3, 2, 1),
(3, 3, 1),
(4, 1, 1),
(4, 2, 2),
(4, 3, 3),
(5, 1, 2),
(5, 2, 1),
(5, 3, 1),
(6, 1, 1),
(6, 3, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `repartition_templates`
--

CREATE TABLE `repartition_templates` (
  `id` int(11) NOT NULL,
  `title` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `tricount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `repartition_templates`
--

INSERT INTO `repartition_templates` (`id`, `title`, `tricount`) VALUES
(2, 'Benoit ne paye rien', 4),
(1, 'Boris paye double', 4);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `repartition_template_items`
--

CREATE TABLE `repartition_template_items` (
  `user` int(11) NOT NULL,
  `repartition_template` int(11) NOT NULL,
  `weight` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `repartition_template_items`
--

INSERT INTO `repartition_template_items` (`user`, `repartition_template`, `weight`) VALUES
(1, 1, 2),
(1, 2, 1),
(2, 1, 1),
(3, 1, 1),
(3, 2, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `subscriptions`
--

CREATE TABLE `subscriptions` (
  `tricount` int(11) NOT NULL,
  `user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `subscriptions`
--

INSERT INTO `subscriptions` (`tricount`, `user`) VALUES
(1, 1),
(2, 1),
(2, 2),
(4, 1),
(4, 2),
(4, 3),
(4, 4),
(4, 5),
(5, 2),
(7, 3),
(7, 4);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tricounts`
--

CREATE TABLE `tricounts` (
  `id` int(11) NOT NULL,
  `title` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `creator` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `tricounts`
--

INSERT INTO `tricounts` (`id`, `title`, `description`, `created_at`, `creator`) VALUES
(1, 'Gers 2022', NULL, '2022-10-10 18:42:24', 1),
(2, 'Resto badminton', NULL, '2022-10-10 19:25:10', 1),
(4, 'Vacances 2023', '  A la mer du nord Englend', '2022-10-10 19:31:09', 1),
(5, 'voyage de l\'éte', ' Maroc 2023', '2023-02-06 01:56:55', 1),
(7, 'voyage à milan', '  regarder le match inter vs AC milan', '2023-02-06 02:24:22', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `mail` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `hashed_password` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `full_name` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `role` enum('user','admin') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'user',
  `iban` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `mail`, `hashed_password`, `full_name`, `role`, `iban`) VALUES
(1, 'boverhaegen@epfc.eu', '56ce92d1de4f05017cf03d6cd514d6d1', 'Boris', 'user', NULL),
(2, 'bepenelle@epfc.eu', '56ce92d1de4f05017cf03d6cd514d6d1', 'Benoît', 'user', NULL),
(3, 'xapigeolet@epfc.eu', '56ce92d1de4f05017cf03d6cd514d6d1', 'Xavier', 'user', NULL),
(4, 'mamichel@epfc.eu', '56ce92d1de4f05017cf03d6cd514d6d1', 'Marc', 'user', '1234'),
(5, 'ousama89@gmail.com', '56ce92d1de4f05017cf03d6cd514d6d1', 'Ossama Hosin', 'user', NULL);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `operations`
--
ALTER TABLE `operations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Initiator` (`initiator`),
  ADD KEY `Tricount` (`tricount`);

--
-- Indexen voor tabel `repartitions`
--
ALTER TABLE `repartitions`
  ADD PRIMARY KEY (`operation`,`user`),
  ADD KEY `User` (`user`);

--
-- Indexen voor tabel `repartition_templates`
--
ALTER TABLE `repartition_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Title` (`title`,`tricount`),
  ADD KEY `Tricount` (`tricount`);

--
-- Indexen voor tabel `repartition_template_items`
--
ALTER TABLE `repartition_template_items`
  ADD PRIMARY KEY (`user`,`repartition_template`),
  ADD KEY `Distribution` (`repartition_template`);

--
-- Indexen voor tabel `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`tricount`,`user`),
  ADD KEY `User` (`user`);

--
-- Indexen voor tabel `tricounts`
--
ALTER TABLE `tricounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Title` (`title`,`creator`),
  ADD KEY `Creator` (`creator`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Mail` (`mail`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `operations`
--
ALTER TABLE `operations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT voor een tabel `repartition_templates`
--
ALTER TABLE `repartition_templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `tricounts`
--
ALTER TABLE `tricounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `operations`
--
ALTER TABLE `operations`
  ADD CONSTRAINT `operations_ibfk_1` FOREIGN KEY (`initiator`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `operations_ibfk_2` FOREIGN KEY (`tricount`) REFERENCES `tricounts` (`id`);

--
-- Beperkingen voor tabel `repartitions`
--
ALTER TABLE `repartitions`
  ADD CONSTRAINT `repartitions_ibfk_1` FOREIGN KEY (`operation`) REFERENCES `operations` (`id`),
  ADD CONSTRAINT `repartitions_ibfk_2` FOREIGN KEY (`user`) REFERENCES `users` (`id`);

--
-- Beperkingen voor tabel `repartition_templates`
--
ALTER TABLE `repartition_templates`
  ADD CONSTRAINT `repartition_templates_ibfk_1` FOREIGN KEY (`tricount`) REFERENCES `tricounts` (`id`);

--
-- Beperkingen voor tabel `repartition_template_items`
--
ALTER TABLE `repartition_template_items`
  ADD CONSTRAINT `repartition_template_items_ibfk_1` FOREIGN KEY (`repartition_template`) REFERENCES `repartition_templates` (`id`),
  ADD CONSTRAINT `repartition_template_items_ibfk_2` FOREIGN KEY (`user`) REFERENCES `users` (`id`);

--
-- Beperkingen voor tabel `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD CONSTRAINT `subscriptions_ibfk_1` FOREIGN KEY (`tricount`) REFERENCES `tricounts` (`id`),
  ADD CONSTRAINT `subscriptions_ibfk_2` FOREIGN KEY (`user`) REFERENCES `users` (`id`);

--
-- Beperkingen voor tabel `tricounts`
--
ALTER TABLE `tricounts`
  ADD CONSTRAINT `tricounts_ibfk_1` FOREIGN KEY (`creator`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
