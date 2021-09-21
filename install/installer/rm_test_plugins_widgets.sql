-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: dd44418
-- Erstellungszeit: 14. Jul 2021 um 17:20
-- Server-Version: 5.7.34-nmm1-log
-- PHP-Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `d030b7d6`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `rm_test_plugins_widgets`
--

CREATE TABLE `rm_next_plugins_widgets` (
  `id` int(11) NOT NULL,
  `position` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `modulname` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `plugin_folder` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `widget_file` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sort` int(11) DEFAULT '0',
  `widgetname` varchar(255) COLLATE utf8_unicode_ci DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `rm_test_plugins_widgets`
--

INSERT INTO `rm_next_plugins_widgets` (`id`, `position`, `description`, `name`, `modulname`, `plugin_folder`, `widget_file`, `sort`, `widgetname`) VALUES
(1, 'page_navigation_widget', 'Navigation', '', '', NULL, NULL, 1, 0),
(2, 'page_head_widget', 'Page Head', '', '', NULL, NULL, 2, 0),
(3, 'head_section_widget', 'Head Section', '', '', NULL, NULL, 3, 0),
(4, 'center_head_widget', 'Content Head', '', '', NULL, NULL, 4, 0),
(5, 'left_side_widget', 'Page Left', '', '', NULL, NULL, 5, 0),
(6, 'right_side_widget', 'Page Right', '', '', NULL, NULL, 6, 0),
(7, 'center_footer_widget', 'Content Foot', '', '', NULL, NULL, 7, 0),
(8, 'foot_section_widget', 'Foot Section', '', '', NULL, NULL, 8, 0),
(9, 'page_footer_widget', 'Page Footer', '', '', NULL, NULL, 9, 0),
(10, 'page_navigation_widget', 'page_navigation_widget', 'Navigation Default', 'navigation_default', 'navigation_default', 'widget_navigation_default.php', 1, 'navigation_default');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `rm_test_plugins_widgets`
--
ALTER TABLE `rm_next_plugins_widgets`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `rm_test_plugins_widgets`
--
ALTER TABLE `rm_next_plugins_widgets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
