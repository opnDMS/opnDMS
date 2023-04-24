SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Datenbank: `<database_name>`
--
CREATE DATABASE IF NOT EXISTS `<database_name>` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `<database_name>`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL,
  `name` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `for_classes` json NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- TRUNCATE Tabelle vor dem Einfügen `categories`
--

TRUNCATE TABLE `categories`;
--
-- Daten für Tabelle `categories`
--

INSERT INTO `categories` (`id`, `name`, `for_classes`) VALUES
(1, 'Posteingang', '[1]'),
(2, 'Postausgang', '[1]');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `classes`
--

DROP TABLE IF EXISTS `classes`;
CREATE TABLE IF NOT EXISTS `classes` (
  `id` int NOT NULL,
  `name` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  UNIQUE KEY `ID` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- TRUNCATE Tabelle vor dem Einfügen `classes`
--

TRUNCATE TABLE `classes`;
--
-- Daten für Tabelle `classes`
--

INSERT INTO `classes` (`id`, `name`) VALUES
(1, 'Post'),
(2, 'Notiz'),
(3, 'Foto');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `documents`
--

DROP TABLE IF EXISTS `documents`;
CREATE TABLE IF NOT EXISTS `documents` (
  `class` int NOT NULL,
  `category` int NOT NULL,
  `subcategory` int DEFAULT NULL,
  `subsubcategory` int DEFAULT NULL,
  `subject` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `title` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `summary` varchar(1024) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date` date NOT NULL,
  `date_started` date DEFAULT NULL,
  `date_finished` date DEFAULT NULL,
  `last_changed` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tags` json DEFAULT NULL,
  `pages` int NOT NULL DEFAULT '0',
  `shelf_num` int DEFAULT NULL,
  `binder_num` int DEFAULT NULL,
  `identifier` int NOT NULL,
  `display_identifier` varchar(24) COLLATE utf8mb4_general_ci NOT NULL,
  `filename` varchar(256) COLLATE utf8mb4_general_ci NOT NULL,
  UNIQUE KEY `Unique` (`identifier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- TRUNCATE Tabelle vor dem Einfügen `documents`
--

TRUNCATE TABLE `documents`;
-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `subcategories`
--

DROP TABLE IF EXISTS `subcategories`;
CREATE TABLE IF NOT EXISTS `subcategories` (
  `id` int NOT NULL,
  `name` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `for_categories` json NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- TRUNCATE Tabelle vor dem Einfügen `subcategories`
--

TRUNCATE TABLE `subcategories`;
-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `subsubcategories`
--

DROP TABLE IF EXISTS `subsubcategories`;
CREATE TABLE IF NOT EXISTS `subsubcategories` (
  `id` int NOT NULL,
  `name` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `for_categories` json NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- TRUNCATE Tabelle vor dem Einfügen `subsubcategories`
--

TRUNCATE TABLE `subsubcategories`;SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
