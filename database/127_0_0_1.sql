-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 05 fév. 2023 à 18:35
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
-- Base de données : `my_social_network_base`
--
CREATE DATABASE IF NOT EXISTS `my_social_network_base` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `my_social_network_base`;

-- --------------------------------------------------------

--
-- Structure de la table `follows`
--

CREATE TABLE `follows` (
  `follower` varchar(128) NOT NULL,
  `followee` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `follows`
--

INSERT INTO `follows` (`follower`, `followee`) VALUES
('admin', 'ben'),
('admin', 'guest'),
('ben', 'admin'),
('ben', 'caro'),
('ben', 'fred'),
('ben', 'guest'),
('bob', 'ben'),
('caro', 'ben'),
('caro', 'fred');

-- --------------------------------------------------------

--
-- Structure de la table `members`
--

CREATE TABLE `members` (
  `pseudo` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `profile` text DEFAULT NULL,
  `picture_path` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `members`
--

INSERT INTO `members` (`pseudo`, `password`, `profile`, `picture_path`) VALUES
('admin', 'c6aa01bd261e501b1fea93c41fe46dc7', 'Je suis l\'admin.', 'admin1510834604.png'),
('ben', 'cc4902e2506fc6de54e53489314c615a', 'Je suis benoit13.', 'ben1510834588.png'),
('bob', '6bc8d5a0ad1818c0924255f5e56e68c6', NULL, NULL),
('caro', 'e82d99e3aaa83e1746bda2a58b99ba17', NULL, NULL),
('fred', '90598d58045d3548866f853df199fb55', NULL, NULL),
('guest', 'b6384a74aaf072666c8fd7c9ce58c428', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `post_id` int(11) NOT NULL,
  `author` varchar(128) NOT NULL,
  `recipient` varchar(128) NOT NULL,
  `body` text NOT NULL,
  `private` tinyint(1) NOT NULL DEFAULT 0,
  `date_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`post_id`, `author`, `recipient`, `body`, `private`, `date_time`) VALUES
(2, 'ben', 'ben', 'message 1', 0, '2015-07-09 10:11:33'),
(3, 'ben', 'ben', 'message 2', 0, '2015-07-09 10:12:59'),
(5, 'caro', 'ben', 'message de caro', 0, '2015-07-09 10:14:03'),
(8, 'ben', 'ben', 'test', 1, '2015-07-09 10:58:10'),
(9, 'ben', 'ben', 'test', 0, '2015-07-09 10:58:15'),
(19, 'caro', 'caro', 'myself', 0, '2015-07-09 11:29:20'),
(47, 'ben', 'caro', 'a longer message for caro in order to see how it wrapped around in the message table.', 0, '2015-07-09 11:34:44'),
(48, 'ben', 'fred', 'this is a message to fred', 0, '2015-07-09 18:15:27'),
(49, 'ben', 'fred', 'this is a private message to fred', 1, '2015-07-09 18:15:36'),
(58, 'ben', 'fred', 'hello', 0, '2015-07-19 00:16:01'),
(59, 'ben', 'fred', 'aaa', 0, '2015-07-19 00:17:41'),
(61, 'admin', 'admin', 'test', 0, '2015-10-30 11:32:37'),
(86, 'ben', 'caro', 'ben to caro', 0, '2015-12-16 12:50:29');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `follows`
--
ALTER TABLE `follows`
  ADD PRIMARY KEY (`follower`,`followee`),
  ADD KEY `members_followee_fk` (`followee`);

--
-- Index pour la table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`pseudo`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `members_author_fk` (`author`),
  ADD KEY `members_recipient_fk` (`recipient`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `follows`
--
ALTER TABLE `follows`
  ADD CONSTRAINT `members_followee_fk` FOREIGN KEY (`followee`) REFERENCES `members` (`pseudo`),
  ADD CONSTRAINT `members_follower_fk` FOREIGN KEY (`follower`) REFERENCES `members` (`pseudo`);

--
-- Contraintes pour la table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `members_author_fk` FOREIGN KEY (`author`) REFERENCES `members` (`pseudo`),
  ADD CONSTRAINT `members_recipient_fk` FOREIGN KEY (`recipient`) REFERENCES `members` (`pseudo`);
--
-- Base de données : `phpmyadmin`
--
CREATE DATABASE IF NOT EXISTS `phpmyadmin` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `phpmyadmin`;

-- --------------------------------------------------------

--
-- Structure de la table `pma__bookmark`
--

CREATE TABLE `pma__bookmark` (
  `id` int(10) UNSIGNED NOT NULL,
  `dbase` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `query` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks';

-- --------------------------------------------------------

--
-- Structure de la table `pma__central_columns`
--

CREATE TABLE `pma__central_columns` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_type` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_length` text COLLATE utf8_bin DEFAULT NULL,
  `col_collation` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_isNull` tinyint(1) NOT NULL,
  `col_extra` varchar(255) COLLATE utf8_bin DEFAULT '',
  `col_default` text COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Central list of columns';

-- --------------------------------------------------------

--
-- Structure de la table `pma__column_info`
--

CREATE TABLE `pma__column_info` (
  `id` int(5) UNSIGNED NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `column_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `transformation` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `transformation_options` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `input_transformation` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `input_transformation_options` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Structure de la table `pma__designer_settings`
--

CREATE TABLE `pma__designer_settings` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `settings_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Settings related to Designer';

--
-- Déchargement des données de la table `pma__designer_settings`
--

INSERT INTO `pma__designer_settings` (`username`, `settings_data`) VALUES
('root', '{\"relation_lines\":\"true\",\"angular_direct\":\"direct\",\"snap_to_grid\":\"off\"}');

-- --------------------------------------------------------

--
-- Structure de la table `pma__export_templates`
--

CREATE TABLE `pma__export_templates` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `export_type` varchar(10) COLLATE utf8_bin NOT NULL,
  `template_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `template_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved export templates';

-- --------------------------------------------------------

--
-- Structure de la table `pma__favorite`
--

CREATE TABLE `pma__favorite` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `tables` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Favorite tables';

-- --------------------------------------------------------

--
-- Structure de la table `pma__history`
--

CREATE TABLE `pma__history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp(),
  `sqlquery` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin';

-- --------------------------------------------------------

--
-- Structure de la table `pma__navigationhiding`
--

CREATE TABLE `pma__navigationhiding` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `item_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `item_type` varchar(64) COLLATE utf8_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Hidden items of navigation tree';

-- --------------------------------------------------------

--
-- Structure de la table `pma__pdf_pages`
--

CREATE TABLE `pma__pdf_pages` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `page_nr` int(10) UNSIGNED NOT NULL,
  `page_descr` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin';

-- --------------------------------------------------------

--
-- Structure de la table `pma__recent`
--

CREATE TABLE `pma__recent` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `tables` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';

--
-- Déchargement des données de la table `pma__recent`
--

INSERT INTO `pma__recent` (`username`, `tables`) VALUES
('root', '[{\"db\":\"prwb_2223_a10\",\"table\":\"operations\"},{\"db\":\"prwb_2223_a10\",\"table\":\"repartitions\"},{\"db\":\"prwb_2223_a10\",\"table\":\"users\"},{\"db\":\"prwb_2223_a10\",\"table\":\"tricounts\"},{\"db\":\"prwb_2223_a10\",\"table\":\"subscriptions\"},{\"db\":\"my_social_network_base\",\"table\":\"messages\"},{\"db\":\"my_social_network_base\",\"table\":\"members\"},{\"db\":\"prwb_2223_a10\",\"table\":\"repartition_templates\"},{\"db\":\"prwb_2223_a10\",\"table\":\"repartition_template_items\"},{\"db\":\"tgpr-msn\",\"table\":\"members\"}]');

-- --------------------------------------------------------

--
-- Structure de la table `pma__relation`
--

CREATE TABLE `pma__relation` (
  `master_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Structure de la table `pma__savedsearches`
--

CREATE TABLE `pma__savedsearches` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `search_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `search_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved searches';

-- --------------------------------------------------------

--
-- Structure de la table `pma__table_coords`
--

CREATE TABLE `pma__table_coords` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT 0,
  `x` float UNSIGNED NOT NULL DEFAULT 0,
  `y` float UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

--
-- Structure de la table `pma__table_info`
--

CREATE TABLE `pma__table_info` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `display_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Structure de la table `pma__table_uiprefs`
--

CREATE TABLE `pma__table_uiprefs` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `prefs` text COLLATE utf8_bin NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

--
-- Déchargement des données de la table `pma__table_uiprefs`
--

INSERT INTO `pma__table_uiprefs` (`username`, `db_name`, `table_name`, `prefs`, `last_update`) VALUES
('root', 'prwb_2223_a10', 'operations', '{\"sorted_col\":\"`operations`.`operation_date` DESC\"}', '2023-01-21 12:38:59'),
('root', 'prwb_2223_a10', 'users', '{\"sorted_col\":\"`repartitions`.`weight` DESC\"}', '2023-01-21 01:42:45');

-- --------------------------------------------------------

--
-- Structure de la table `pma__tracking`
--

CREATE TABLE `pma__tracking` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `version` int(10) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text COLLATE utf8_bin NOT NULL,
  `schema_sql` text COLLATE utf8_bin DEFAULT NULL,
  `data_sql` longtext COLLATE utf8_bin DEFAULT NULL,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') COLLATE utf8_bin DEFAULT NULL,
  `tracking_active` int(1) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Structure de la table `pma__userconfig`
--

CREATE TABLE `pma__userconfig` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `config_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

--
-- Déchargement des données de la table `pma__userconfig`
--

INSERT INTO `pma__userconfig` (`username`, `timevalue`, `config_data`) VALUES
('root', '2023-01-26 08:53:15', '{\"Console\\/Mode\":\"collapse\",\"lang\":\"fr\"}');

-- --------------------------------------------------------

--
-- Structure de la table `pma__usergroups`
--

CREATE TABLE `pma__usergroups` (
  `usergroup` varchar(64) COLLATE utf8_bin NOT NULL,
  `tab` varchar(64) COLLATE utf8_bin NOT NULL,
  `allowed` enum('Y','N') COLLATE utf8_bin NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User groups with configured menu items';

-- --------------------------------------------------------

--
-- Structure de la table `pma__users`
--

CREATE TABLE `pma__users` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `usergroup` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users and their assignments to user groups';

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `pma__central_columns`
--
ALTER TABLE `pma__central_columns`
  ADD PRIMARY KEY (`db_name`,`col_name`);

--
-- Index pour la table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`);

--
-- Index pour la table `pma__designer_settings`
--
ALTER TABLE `pma__designer_settings`
  ADD PRIMARY KEY (`username`);

--
-- Index pour la table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_user_type_template` (`username`,`export_type`,`template_name`);

--
-- Index pour la table `pma__favorite`
--
ALTER TABLE `pma__favorite`
  ADD PRIMARY KEY (`username`);

--
-- Index pour la table `pma__history`
--
ALTER TABLE `pma__history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`,`db`,`table`,`timevalue`);

--
-- Index pour la table `pma__navigationhiding`
--
ALTER TABLE `pma__navigationhiding`
  ADD PRIMARY KEY (`username`,`item_name`,`item_type`,`db_name`,`table_name`);

--
-- Index pour la table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  ADD PRIMARY KEY (`page_nr`),
  ADD KEY `db_name` (`db_name`);

--
-- Index pour la table `pma__recent`
--
ALTER TABLE `pma__recent`
  ADD PRIMARY KEY (`username`);

--
-- Index pour la table `pma__relation`
--
ALTER TABLE `pma__relation`
  ADD PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  ADD KEY `foreign_field` (`foreign_db`,`foreign_table`);

--
-- Index pour la table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_savedsearches_username_dbname` (`username`,`db_name`,`search_name`);

--
-- Index pour la table `pma__table_coords`
--
ALTER TABLE `pma__table_coords`
  ADD PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`);

--
-- Index pour la table `pma__table_info`
--
ALTER TABLE `pma__table_info`
  ADD PRIMARY KEY (`db_name`,`table_name`);

--
-- Index pour la table `pma__table_uiprefs`
--
ALTER TABLE `pma__table_uiprefs`
  ADD PRIMARY KEY (`username`,`db_name`,`table_name`);

--
-- Index pour la table `pma__tracking`
--
ALTER TABLE `pma__tracking`
  ADD PRIMARY KEY (`db_name`,`table_name`,`version`);

--
-- Index pour la table `pma__userconfig`
--
ALTER TABLE `pma__userconfig`
  ADD PRIMARY KEY (`username`);

--
-- Index pour la table `pma__usergroups`
--
ALTER TABLE `pma__usergroups`
  ADD PRIMARY KEY (`usergroup`,`tab`,`allowed`);

--
-- Index pour la table `pma__users`
--
ALTER TABLE `pma__users`
  ADD PRIMARY KEY (`username`,`usergroup`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pma__history`
--
ALTER TABLE `pma__history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  MODIFY `page_nr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Base de données : `prwb_2223_a10`
--
CREATE DATABASE IF NOT EXISTS `prwb_2223_a10` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `prwb_2223_a10`;

-- --------------------------------------------------------

--
-- Structure de la table `operations`
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
-- Déchargement des données de la table `operations`
--

INSERT INTO `operations` (`id`, `title`, `tricount`, `amount`, `operation_date`, `initiator`, `created_at`) VALUES
(1, 'LIDLLLLLL', 2, 210, '2023-01-06', 3, '2023-01-10 22:29:42'),
(3, 'yassin pay', 2, 130, '2023-01-06', 1, '2023-01-10 22:29:30'),
(4, 'IMAD PAY', 2, 67, '2023-01-06', 2, '2023-01-10 22:29:30'),
(5, 'abdessalem pay', 3, 212.47, '2023-01-06', 5, '2023-01-10 22:29:30'),
(6, 'amin pay', 2, 222, '2023-01-11', 3, '2023-01-21 01:32:52'),
(7, 'action', 2, 310, '0000-00-00', 5, '2023-01-25 21:21:19'),
(8, 'Action', 2, 110, '2023-01-06', 5, '2023-01-25 21:23:30');

-- --------------------------------------------------------

--
-- Structure de la table `repartitions`
--

CREATE TABLE `repartitions` (
  `operation` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `weight` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `repartitions`
--

INSERT INTO `repartitions` (`operation`, `user`, `weight`) VALUES
(1, 1, 1),
(1, 3, 2),
(3, 1, 3),
(6, 1, 1),
(6, 2, 1),
(6, 5, 2);

-- --------------------------------------------------------

--
-- Structure de la table `repartition_templates`
--

CREATE TABLE `repartition_templates` (
  `id` int(11) NOT NULL,
  `title` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `tricount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `repartition_template_items`
--

CREATE TABLE `repartition_template_items` (
  `user` int(11) NOT NULL,
  `repartition_template` int(11) NOT NULL,
  `weight` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `tricount` int(11) NOT NULL,
  `user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `subscriptions`
--

INSERT INTO `subscriptions` (`tricount`, `user`) VALUES
(2, 1),
(2, 2),
(2, 3),
(2, 5),
(3, 3),
(3, 5),
(5, 2);

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
(1, 'BRUXELLES', 'vacances BXL', '0000-00-00 00:00:00', 3),
(2, 'paris', '  vacances paris', '0000-00-00 00:00:00', 5),
(3, 'VACANCES', 'VACANCES IN PARIS', '0000-00-00 00:00:00', 5),
(5, 'thailand', 'got to thailand', '2023-01-15 11:20:08', 5),
(6, 'tunis', 'vacances to tunisia ', '2023-01-16 11:52:17', 5);

-- --------------------------------------------------------

--
-- Structure de la table `users`
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
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `mail`, `hashed_password`, `full_name`, `role`, `iban`) VALUES
(1, 'YASSIN@GMAIL.com', 'Baganda', 'howari', 'user', 'BE359693604'),
(2, 'imad@GMAIL.com', 'Baganda', 'imad', 'user', 'BE3559693604'),
(3, 'AMIN@GMAIL.com', 'Baganda', 'AMIN', 'user', 'BE3554593604'),
(5, 'Abd@gmail.com', '63203ba11b7875bd0a3280a1fe726b5e', 'ABDESSALEMAAA', 'user', 'BE82967179809468'),
(6, 'Abdo@gmail.com', '63203ba11b7875bd0a3280a1fe726b5e', 'Saadaoui abd', 'user', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `operations`
--
ALTER TABLE `operations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `initiator` (`initiator`),
  ADD KEY `tricount` (`tricount`);

--
-- Index pour la table `repartitions`
--
ALTER TABLE `repartitions`
  ADD PRIMARY KEY (`operation`,`user`),
  ADD KEY `user` (`user`);

--
-- Index pour la table `repartition_templates`
--
ALTER TABLE `repartition_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`,`tricount`),
  ADD KEY `tricount` (`tricount`);

--
-- Index pour la table `repartition_template_items`
--
ALTER TABLE `repartition_template_items`
  ADD PRIMARY KEY (`user`,`repartition_template`),
  ADD KEY `tepartition_template` (`repartition_template`);

--
-- Index pour la table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`tricount`,`user`),
  ADD KEY `user` (`user`);

--
-- Index pour la table `tricounts`
--
ALTER TABLE `tricounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`,`creator`),
  ADD KEY `creator` (`creator`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mail` (`mail`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `operations`
--
ALTER TABLE `operations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `repartition_templates`
--
ALTER TABLE `repartition_templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `tricounts`
--
ALTER TABLE `tricounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `operations`
--
ALTER TABLE `operations`
  ADD CONSTRAINT `operations_ibfk_1` FOREIGN KEY (`initiator`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `operations_ibfk_2` FOREIGN KEY (`tricount`) REFERENCES `tricounts` (`id`);

--
-- Contraintes pour la table `repartitions`
--
ALTER TABLE `repartitions`
  ADD CONSTRAINT `repartitions_ibfk_1` FOREIGN KEY (`operation`) REFERENCES `operations` (`id`),
  ADD CONSTRAINT `repartitions_ibfk_2` FOREIGN KEY (`user`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `repartition_templates`
--
ALTER TABLE `repartition_templates`
  ADD CONSTRAINT `repartition_templates_ibfk_1` FOREIGN KEY (`tricount`) REFERENCES `tricounts` (`id`);

--
-- Contraintes pour la table `repartition_template_items`
--
ALTER TABLE `repartition_template_items`
  ADD CONSTRAINT `repartition_template_items_ibfk_1` FOREIGN KEY (`repartition_template`) REFERENCES `repartition_templates` (`id`),
  ADD CONSTRAINT `repartition_template_items_ibfk_2` FOREIGN KEY (`user`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD CONSTRAINT `subscriptions_ibfk_1` FOREIGN KEY (`tricount`) REFERENCES `tricounts` (`id`),
  ADD CONSTRAINT `subscriptions_ibfk_2` FOREIGN KEY (`user`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `tricounts`
--
ALTER TABLE `tricounts`
  ADD CONSTRAINT `tricounts_ibfk_1` FOREIGN KEY (`creator`) REFERENCES `users` (`id`);
--
-- Base de données : `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test`;
--
-- Base de données : `tgpr-msn`
--
CREATE DATABASE IF NOT EXISTS `tgpr-msn` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `tgpr-msn`;

-- --------------------------------------------------------

--
-- Structure de la table `follows`
--

CREATE TABLE `follows` (
  `follower` varchar(128) NOT NULL,
  `followee` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `follows`
--

INSERT INTO `follows` (`follower`, `followee`) VALUES
('admin', 'ben'),
('admin', 'guest'),
('ben', 'admin'),
('ben', 'caro'),
('ben', 'fred'),
('ben', 'guest'),
('bob', 'ben'),
('caro', 'ben'),
('caro', 'fred');

-- --------------------------------------------------------

--
-- Structure de la table `members`
--

CREATE TABLE `members` (
  `pseudo` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `profile` text DEFAULT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0,
  `birthdate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `members`
--

INSERT INTO `members` (`pseudo`, `password`, `profile`, `admin`, `birthdate`) VALUES
('admin', 'c6aa01bd261e501b1fea93c41fe46dc7', 'Je suis l\'admin.', 1, NULL),
('ben', 'cc4902e2506fc6de54e53489314c615a', 'Benoît Penelle', 0, '1970-07-01'),
('bob', '6bc8d5a0ad1818c0924255f5e56e68c6', 'Bob l\'éponge', 0, NULL),
('caro', 'e82d99e3aaa83e1746bda2a58b99ba17', 'Caroline de Monaco', 0, NULL),
('fred', '90598d58045d3548866f853df199fb55', NULL, 0, NULL),
('guest', 'b6384a74aaf072666c8fd7c9ce58c428', NULL, 0, NULL),
('marc', 'b41216a574ab900d4911cce4f4941a00', 'Marc Michel', 0, '1987-02-26');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `post_id` int(11) NOT NULL,
  `author` varchar(128) NOT NULL,
  `recipient` varchar(128) NOT NULL,
  `body` text NOT NULL,
  `private` tinyint(1) NOT NULL DEFAULT 0,
  `date_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`post_id`, `author`, `recipient`, `body`, `private`, `date_time`) VALUES
(2, 'ben', 'ben', 'message 1', 0, '2021-07-09 10:11:33'),
(3, 'ben', 'ben', 'message 2', 0, '2021-07-09 10:12:59'),
(5, 'caro', 'ben', 'message de caro', 0, '2021-07-09 10:14:03'),
(8, 'ben', 'ben', 'test', 1, '2021-07-09 10:58:10'),
(9, 'ben', 'ben', 'test', 0, '2021-07-09 10:58:15'),
(19, 'caro', 'caro', 'myself', 0, '2021-07-09 11:29:20'),
(47, 'ben', 'caro', 'a longer message for caro in order to see how it is wrapped around in the message table.', 0, '2021-07-09 11:34:44'),
(48, 'ben', 'fred', 'this is a message to fred', 0, '2021-07-09 18:15:27'),
(49, 'ben', 'fred', 'this is a private message to fred', 1, '2021-07-09 18:15:36'),
(58, 'ben', 'fred', 'hello', 0, '2021-07-19 00:16:01'),
(59, 'ben', 'fred', 'aaa', 0, '2021-07-19 00:17:41'),
(61, 'admin', 'admin', 'test', 0, '2021-10-30 11:32:37'),
(86, 'ben', 'caro', 'ben to caro', 0, '2021-12-16 12:50:29');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `follows`
--
ALTER TABLE `follows`
  ADD PRIMARY KEY (`follower`,`followee`),
  ADD KEY `members_followee_fk` (`followee`);

--
-- Index pour la table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`pseudo`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `members_author_fk` (`author`),
  ADD KEY `members_recipient_fk` (`recipient`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `follows`
--
ALTER TABLE `follows`
  ADD CONSTRAINT `members_followee_fk` FOREIGN KEY (`followee`) REFERENCES `members` (`pseudo`),
  ADD CONSTRAINT `members_follower_fk` FOREIGN KEY (`follower`) REFERENCES `members` (`pseudo`);

--
-- Contraintes pour la table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `members_author_fk` FOREIGN KEY (`author`) REFERENCES `members` (`pseudo`),
  ADD CONSTRAINT `members_recipient_fk` FOREIGN KEY (`recipient`) REFERENCES `members` (`pseudo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
