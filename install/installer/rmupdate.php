<?php
/**
 *¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*  
 *                                    Webspell-RM      /                        /   /                                                 *
 *                                    -----------__---/__---__------__----__---/---/-----__---- _  _ -                                *
 *                                     | /| /  /___) /   ) (_ `   /   ) /___) /   / __  /     /  /  /                                 *
 *                                    _|/_|/__(___ _(___/_(__)___/___/_(___ _/___/_____/_____/__/__/_                                 *
 *                                                 Free Content / Management System                                                   *
 *                                                             /                                                                      *
 *¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
 * @version         Webspell-RM                                                                                                       *
 *                                                                                                                                    *
 * @copyright       2018-2022 by webspell-rm.de <https://www.webspell-rm.de>                                                          *
 * @support         For Support, Plugins, Templates and the Full Script visit webspell-rm.de <https://www.webspell-rm.de/forum.html>  *
 * @WIKI            webspell-rm.de <https://www.webspell-rm.de/wiki.html>                                                             *
 *                                                                                                                                    *
 *¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
 * @license         Script runs under the GNU GENERAL PUBLIC LICENCE                                                                  *
 *                  It's NOT allowed to remove this copyright-tag <http://www.fsf.org/licensing/licenses/gpl.html>                    *
 *                                                                                                                                    *
 * @author          Code based on WebSPELL Clanpackage (Michael Gruber - webspell.at)                                                 *
 * @copyright       2005-2018 by webspell.org / webspell.info                                                                         *
 *¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
 *                                                                                                                                    *
 *¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
 */

#==========================================#
#Update von RM 2.0.1 auf RM 2.0.2
#==========================================#

function update_rm_201_202_1($_database)
{
    $transaction = new Transaction($_database);

$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "navigation_dashboard_categories`");
$transaction->addQuery("CREATE TABLE `" . PREFIX . "navigation_dashboard_categories` (
    `catID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `fa_name` varchar(255) NOT NULL DEFAULT '',
  `accesslevel` varchar(255) NOT NULL,
  `default` int(1) NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`catID`)
) AUTO_INCREMENT=10
 DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");

$transaction->addQuery("INSERT INTO `" . PREFIX . "navigation_dashboard_categories` (`catID`, `name`, `fa_name`, `accesslevel`, `default`, `sort`) VALUES
(1, '{[de]}Hauptteil{[en]}Main Panel{[it]}Pannello Principale', 'fas fa-chart-bar', 'any', 0, 1),
(2, '{[de]}Benutzer Administration{[en]}User Administration{[it]}Amministrazione Utenti', 'fas fa-users', 'user', 0, 2),
(3, '{[de]}Spam{[en]}Spam{[it]}Spam', 'fas fa-exclamation-triangle', 'user', 0, 3),
(4, '{[de]}Layout{[en]}Layout{[it]}Disposizione', 'far fa-image', 'cash', 0, 4),
(5, '{[de]}Systemverwaltung{[en]}System Management{[it]}Gestione del sistema', 'fas fa-cogs', 'page', 0, 5),
(6, '{[de]}Plugin Verwaltung{[en]}Plugin Administration{[it]}Gestione Plugin', 'fas fa-puzzle-piece', 'page', 0, 6),
(7, '{[de]}Plugins Webseiteninhalt{[en]}Plugins Website Content{[it]}Gestione Contenuto Plugin', 'fas fa-folder', 'page', 0, 7),
(8, '{[de]}Plugins System / Social Media{[en]}Plugins System / Social Media{[it]}Gestione di Plugin / Social Media', 'fas fa-share-alt', 'page', 0, 8),
(9, '{[de]}Plugins Webseiten Layout{[en]}Plugins Web Pages Layout{[it]}Layout Plugins Pagine Web', 'fas fa-palette', 'page', 0, 9)");


$transaction->addQuery("ALTER TABLE `" . PREFIX . "plugins_widgets` DROP `create_date`");# entfernt

$transaction->addQuery("ALTER TABLE `" . PREFIX . "settings` ADD startpage varchar(255) NOT NULL DEFAULT 'startpage'"); #Startpage hinzugefügt

$transaction->addQuery("ALTER TABLE `" . PREFIX . "user` DROP `newsletter`");# entfernt

#Module in einer Datenbank zusammengefügt / alte gelöscht
$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "settings_content_foot_moduls`");# entfernt
$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "settings_content_head_moduls`");# entfernt
$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "settings_head_moduls`");# entfernt

$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "settings_countries`"); #Contries entfernt

$transaction->addQuery("ALTER TABLE `" . PREFIX . "plugins` CHANGE `sc_link` `sc_link` VARCHAR( 255 ) NOT NULL");#VARCHAR geändert auf 255

$transaction->addQuery("ALTER TABLE `" . PREFIX . "static` RENAME TO `" . PREFIX ."settings_static`"); #Datenbankname geändert



$transaction->addQuery("DELETE FROM `" . PREFIX . "settings_moduls` WHERE module = ''");
$transaction->addQuery("DELETE FROM `" . PREFIX . "settings_moduls` WHERE module = 'myprofile'");
$transaction->addQuery("DELETE FROM `" . PREFIX . "settings_moduls` WHERE module = 'profile'");
$transaction->addQuery("DELETE FROM `" . PREFIX . "settings_moduls` WHERE module = 'login'");
$transaction->addQuery("DELETE FROM `" . PREFIX . "settings_moduls` WHERE module = 'loginoverview'");
$transaction->addQuery("DELETE FROM `" . PREFIX . "settings_moduls` WHERE module = 'contact'");
$transaction->addQuery("DELETE FROM `" . PREFIX . "settings_moduls` WHERE module = 'lostpassword'");
$transaction->addQuery("DELETE FROM `" . PREFIX . "settings_moduls` WHERE module = 'register'");
$transaction->addQuery("DELETE FROM `" . PREFIX . "settings_moduls` WHERE module = 'startpage'");
$transaction->addQuery("DELETE FROM `" . PREFIX . "settings_moduls` WHERE module = 'static'");

$transaction->addQuery("ALTER TABLE `" . PREFIX . "settings_moduls` ADD head_activated int(11) NOT NULL"); #head_activated hinzugefügt
$transaction->addQuery("ALTER TABLE `" . PREFIX . "settings_moduls` ADD content_head_activated int(11) NOT NULL"); #content_head_activated hinzugefügt
$transaction->addQuery("ALTER TABLE `" . PREFIX . "settings_moduls` ADD content_foot_activated int(11) NOT NULL"); #content_foot_activated hinzugefügt

$transaction->addQuery("INSERT IGNORE INTO `" . PREFIX . "settings_moduls` (`modulID`, `module`, `modulname`, `activated`, `le_activated`, `re_activated`, `deactivated`, `head_activated`, `content_head_activated`, `content_foot_activated`, `sort`) VALUES
(1, '', '', 1, 0, 0, 0, 1, 1, 1, 1),
(2, 'myprofile', '', 1, 0, 0, 0, 0, 0, 0, 2),
(3, 'profile', '', 1, 0, 0, 0, 0, 0, 0, 3),
(4, 'login', '', 1, 0, 0, 0, 0, 0, 0, 4),
(5, 'loginoverview', '', 1, 0, 0, 0, 0, 0, 0, 5),
(6, 'contact', '', 1, 0, 0, 0, 0, 0, 0, 6),
(7, 'lostpassword', '', 1, 0, 0, 0, 0, 0, 0, 7),
(8, 'register', '', 1, 0, 0, 0, 0, 0, 0, 8),
(9, 'startpage', '', 1, 0, 0, 0, 1, 1, 1, 9),
(10, 'imprint', '', 1, 0, 0, 0, 0, 0, 0, 2),
(11, 'privacy_policy', '', 1, 0, 0, 0, 0, 0, 0, 2),
(12, 'static', '', 1, 0, 0, 0, 0, 0, 0,10)");



$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "settings_imprint`");
$transaction->addQuery("CREATE TABLE `" . PREFIX . "settings_imprint` (
  `imprintID` int(11) NOT NULL AUTO_INCREMENT,
  `imprint` text COLLATE utf8_unicode_ci NOT NULL,
  `disclaimer_text` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`imprintID`)
) AUTO_INCREMENT=1
  DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");


$transaction->addQuery("INSERT INTO `" . PREFIX . "settings_imprint` (`imprintID`, `imprint`, `disclaimer_text`) VALUES
(1, '<p>{[de]} Impressum in deutscher Sprache.<br /><span style=color:#c0392b><strong>Konfigurieren Sie bitte Ihr Impressum!</strong></span></p><p>{[en]} Imprint in English.<br /><span style=color:#c0392b><strong>Please configure your imprint!</strong></span></p>', '<p>{[de]} Haftungsausschluss in deutscher Sprache.<br /><span style=color:#c0392b><strong>Konfigurieren Sie bitte Ihr Haftungsausschluss!</strong></span></p><p>{[en]} Disclaimer in English.<br /><span style=color:#c0392b><strong>Please configure your disclaimer!</strong></span></p>')");


$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "settings_privacy_policy`");
$transaction->addQuery("CREATE TABLE `" . PREFIX . "settings_privacy_policy` (
  `privacy_policyID` int(11) NOT NULL AUTO_INCREMENT,
  `date` int(14) NOT NULL,
  `privacy_policy_text` text NOT NULL,
  PRIMARY KEY (`privacy_policyID`)
) AUTO_INCREMENT=1
  DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");

$transaction->addQuery("INSERT INTO `" . PREFIX . "settings_privacy_policy` (`privacy_policyID`, `date`, `privacy_policy_text`) VALUES
(1, 0, '<p>{[de]} Datenschutz-Bestimmungen in deutscher Sprache.<br /><span style=color:#c0392b><strong>Konfigurieren Sie bitte Ihre Datenschutz-Bestimmungen!</strong></span></p><p>{[en]} Privacy Policy in English.<br /><span style=color:#c0392b><strong>Please configure your Privacy Policy!</strong></span></p>{[it]} Informativa sulla privacy in Italiano.<br /><span style=\"color:#c0392b\"><strong>Si prega di configurare l&rsquo;Informativa sulla Privacy!</strong></span></p>')");


$transaction->addQuery("DELETE FROM `" . PREFIX . "navigation_dashboard_links` WHERE url = 'admincenter.php?site=settings_head_moduls'");
$transaction->addQuery("DELETE FROM `" . PREFIX . "navigation_dashboard_links` WHERE url = 'admincenter.php?site=settings_content_head_moduls'");
$transaction->addQuery("DELETE FROM `" . PREFIX . "navigation_dashboard_links` WHERE url = 'admincenter.php?site=settings_content_foot_moduls'");

$transaction->addQuery("DELETE FROM `" . PREFIX . "navigation_dashboard_links` WHERE url = 'admincenter.php?site=overview'");
$transaction->addQuery("DELETE FROM `" . PREFIX . "navigation_dashboard_links` WHERE url = 'admincenter.php?site=page_statistic'");
$transaction->addQuery("DELETE FROM `" . PREFIX . "navigation_dashboard_links` WHERE url = 'admincenter.php?site=visitor_statistic'");
$transaction->addQuery("DELETE FROM `" . PREFIX . "navigation_dashboard_links` WHERE url = 'admincenter.php?site=users'");
$transaction->addQuery("DELETE FROM `" . PREFIX . "navigation_dashboard_links` WHERE url = 'admincenter.php?site=squads'");
$transaction->addQuery("DELETE FROM `" . PREFIX . "navigation_dashboard_links` WHERE url = 'admincenter.php?site=members'");
$transaction->addQuery("DELETE FROM `" . PREFIX . "navigation_dashboard_links` WHERE url = 'admincenter.php?site=contact'");
$transaction->addQuery("DELETE FROM `" . PREFIX . "navigation_dashboard_links` WHERE url = 'admincenter.php?site=spam&amp;action=forum_spam'");
$transaction->addQuery("DELETE FROM `" . PREFIX . "navigation_dashboard_links` WHERE url = 'admincenter.php?site=spam&amp;action=user'");
$transaction->addQuery("DELETE FROM `" . PREFIX . "navigation_dashboard_links` WHERE url = 'admincenter.php?site=spam&amp;action=multi'");
$transaction->addQuery("DELETE FROM `" . PREFIX . "navigation_dashboard_links` WHERE url = 'admincenter.php?site=banned_ips'");
$transaction->addQuery("DELETE FROM `" . PREFIX . "navigation_dashboard_links` WHERE url = 'admincenter.php?site=settings'");
$transaction->addQuery("DELETE FROM `" . PREFIX . "navigation_dashboard_links` WHERE url = 'admincenter.php?site=settings_buttons'");
$transaction->addQuery("DELETE FROM `" . PREFIX . "navigation_dashboard_links` WHERE url = 'admincenter.php?site=settings_styles'");
$transaction->addQuery("DELETE FROM `" . PREFIX . "navigation_dashboard_links` WHERE url = 'admincenter.php?site=settings_moduls'");
$transaction->addQuery("DELETE FROM `" . PREFIX . "navigation_dashboard_links` WHERE url = 'admincenter.php?site=settings_css'");
$transaction->addQuery("DELETE FROM `" . PREFIX . "navigation_dashboard_links` WHERE url = 'admincenter.php?site=settings_templates'");
$transaction->addQuery("DELETE FROM `" . PREFIX . "navigation_dashboard_links` WHERE url = 'admincenter.php?site=settings_logo'");
$transaction->addQuery("DELETE FROM `" . PREFIX . "navigation_dashboard_links` WHERE url = 'admincenter.php?site=dashboard_navigation'");
$transaction->addQuery("DELETE FROM `" . PREFIX . "navigation_dashboard_links` WHERE url = 'admincenter.php?site=webside_navigation'");
$transaction->addQuery("DELETE FROM `" . PREFIX . "navigation_dashboard_links` WHERE url = 'admincenter.php?site=startpage'");
$transaction->addQuery("DELETE FROM `" . PREFIX . "navigation_dashboard_links` WHERE url = 'admincenter.php?site=static'");
$transaction->addQuery("DELETE FROM `" . PREFIX . "navigation_dashboard_links` WHERE url = 'admincenter.php?site=settings_countries'");
$transaction->addQuery("DELETE FROM `" . PREFIX . "navigation_dashboard_links` WHERE url = 'admincenter.php?site=settings_games'");
$transaction->addQuery("DELETE FROM `" . PREFIX . "navigation_dashboard_links` WHERE url = 'admincenter.php?site=modrewrite'");
$transaction->addQuery("DELETE FROM `" . PREFIX . "navigation_dashboard_links` WHERE url = 'admincenter.php?site=email'");
$transaction->addQuery("DELETE FROM `" . PREFIX . "navigation_dashboard_links` WHERE url = 'admincenter.php?site=plugin-manager'");
$transaction->addQuery("DELETE FROM `" . PREFIX . "navigation_dashboard_links` WHERE url = 'admincenter.php?site=plugin-installer'");
$transaction->addQuery("DELETE FROM `" . PREFIX . "navigation_dashboard_links` WHERE url = 'admincenter.php?site=template-installer'");
$transaction->addQuery("DELETE FROM `" . PREFIX . "navigation_dashboard_links` WHERE url = 'admincenter.php?site=plugin-widgets'");

$transaction->addQuery("INSERT INTO `" . PREFIX . "navigation_dashboard_links` (`linkID`, `catID`, `name`, `modulname`, `url`, `accesslevel`, `sort`) VALUES
(1, 1, '{[de]}Server-Info{[en]}Overview{[it]}Informazioni Server', '', 'admincenter.php?site=overview', 'any', 1),
(2, 1, '{[de]}Seiten Statistiken{[en]}Page Statistics{[it]}Pagina delle Statistiche', '', 'admincenter.php?site=page_statistic', 'any', 2),
(3, 1, '{[de]}Besucher Statistiken{[en]}Visitor Statistics{[it]}Statistiche Visitatori', '', 'admincenter.php?site=visitor_statistic', 'any', 3),
(4, 2, '{[de]}Registrierte Benutzer{[en]}Registered Users{[it]}Utenti Registrati', '', 'admincenter.php?site=users', 'forum', 1),
(5, 2, '{[de]}Teams{[en]}Squads{[it]}Squadre', '', 'admincenter.php?site=squads', 'user', 2),
(6, 2, '{[de]}Clanmitglieder{[en]}Clanmembers{[it]}Membri del Clan', '', 'admincenter.php?site=members', 'user', 3),
(7, 2, '{[de]}Kontakte{[en]}Contacts{[it]}Contatti', '', 'admincenter.php?site=contact', 'user', 4),
(8, 3, '{[de]}Geblockte Inhalte{[en]}Blocked Content{[it]}Contenuti Bloccati', '', 'admincenter.php?site=spam&amp;action=forum_spam', 'user', 1),
(9, 3, '{[de]}Nutzer l&ouml;schen{[en]}Remove User{[it]}Rimuovi Utente', '', 'admincenter.php?site=spam&amp;action=user', 'user', 2),
(10, 3, '{[de]}Multi-Accounts{[en]}Multi-Accounts{[it]}Multi-Account', '', 'admincenter.php?site=spam&amp;action=multi', 'user', 3),
(11, 3, '{[de]}gebannte IP`s{[en]}banned IP`s{[it]}IP bannati', '', 'admincenter.php?site=banned_ips', 'user', 4),
(12, 4, '{[de]}Einstellungen{[en]}Settings{[it]}Settaggi', '', 'admincenter.php?site=settings', 'page', 1),
(13, 4, '{[de]}Button{[en]}Button{[it]}Bottoni', '', 'admincenter.php?site=settings_buttons', 'feedback', 3),
(14, 4, '{[de]}Style{[en]}Style{[it]}Stili', '', 'admincenter.php?site=settings_styles', 'page', 2),
(15, 4, '{[de]}Module{[en]}Module{[it]}Moduli', '', 'admincenter.php?site=settings_moduls', 'page', 4),
(16, 4, '{[de]}.css{[en]}.css{[it]}.css', '', 'admincenter.php?site=settings_css', 'page', 5),
(17, 4, '{[de]}Themes{[en]}Themes{[it]}Temi Grafici', '', 'admincenter.php?site=settings_templates', 'page', 7),
(18, 4, '{[de]}Logo{[en]}Logo{[it]}Logo', '', 'admincenter.php?site=settings_logo', 'page', 6),
(19, 5, '{[de]}Admincenter Navigation{[en]}Admincenter Navigation{[it]}Menu Navigazione Admin', '', 'admincenter.php?site=dashboard_navigation', 'page', 1),
(20, 5, '{[de]}Webseiten Navigation{[en]}Webside Navigation{[it]}Menu Navigazione Web', '', 'admincenter.php?site=webside_navigation', 'page', 2),
(21, 5, '{[de]}Startseite{[en]}Start Page{[it]}Pagina Principale', '', 'admincenter.php?site=settings_startpage', 'page', 3),
(22, 5, '{[de]}Statische Seiten{[en]}Static Pages{[it]}Pagine Statiche', '', 'admincenter.php?site=settings_static', 'page', 4),
(23, 5, '{[de]}Spiele{[en]}Games{[it]}Giochi', '', 'admincenter.php?site=settings_games', 'page', 5),
(24, 5, '{[de]}Mod-Rewrite{[en]}Mod-Rewrite{[it]}Mod-Rewrite', '', 'admincenter.php?site=modrewrite', 'page', 6),
(25, 5, '{[de]}E-Mail{[en]}E-Mail{[it]}E-Mail', '', 'admincenter.php?site=email', 'page', 7),
(26, 5, '{[de]}Impressum{[en]}Imprint{[it]}Impronta Editoriale', '', 'admincenter.php?site=settings_imprint', 'page', 8),
(27, 5, '{[de]}Datenschutz-Bestimmungen{[en]}Privacy Policy{[it]}Informativa sulla privacy', '', 'admincenter.php?site=settings_privacy_policy', 'page', 9),
(28, 6, '{[de]}Plugin Manager{[en]}Plugin Manager{[it]}Gestione Plugin', '', 'admincenter.php?site=plugin-manager', 'page', 1),
(29, 6, '{[de]}Plugin Installer{[en]}Plugin Installer{[it]}Installazione Plugin', '', 'admincenter.php?site=plugin-installer', 'page', 2),
(30, 6, '{[de]}Themes Installer{[en]}Themes Installer{[it]}Installazione Temi', '', 'admincenter.php?site=template-installer', 'page', 3),
(31, 6, '{[de]}Widget Verwaltung{[en]}Widget Control{[it]}Gestione Widget', '', 'admincenter.php?site=plugin-widgets', 'page', 4),
(32, 5, '{[de]}Update{[en]}Update{[it]}Update', '', 'admincenter.php?site=update', 'any', 10),
(33, 5, '{[de]}Datenbank{[en]}Database', '', 'admincenter.php?site=database', 'any', 11)");



$transaction->addQuery("INSERT INTO `" . PREFIX . "navigation_website_sub` (`snavID`, `mnavID`, `name`, `modulname`, `url`, `sort`, `indropdown`) VALUES
('', 5, '{[de]}Datenschutz-Bestimmungen{[en]}Privacy Policy{[it]}Informativa sulla privacy', 'privacy_policy', 'index.php?site=privacy_policy', 1, 1),
('', 5, '{[de]}Impressum{[en]}Imprint{[it]}Impronta Editoriale', 'imprint', 'index.php?site=imprint', 1, 1)");

$transaction->addQuery("ALTER TABLE `" . PREFIX . "settings` ADD ftpip VARCHAR(100) NOT NULL");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "settings` ADD ftpport INT(11) NOT NULL");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "settings` ADD ftppath VARCHAR(100) NOT NULL");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "settings` ADD ftpuser VARCHAR(50) NOT NULL");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "settings` ADD ftppw VARCHAR(100) NOT NULL");

$transaction->addQuery("INSERT INTO `" . PREFIX . "plugins` (`pluginID`, `name`, `modulname`, `description`, `admin_file`, `activate`, `author`, `website`, `index_link`, `sc_link`, `hiddenfiles`, `version`, `path`) VALUES
('', 'Navigation Default', 'navigation_default', 'Mit diesem Plugin k&ouml;nnt ihr euch die Default Navigation anzeigen lassen.', '', 1, 'T-Seven', 'https://webspell-rm.de', '', 'widget_navigation_default', '', '1.2', 'includes/plugins/navigation_default/')");

$transaction->addQuery("INSERT INTO `" . PREFIX . "plugins_widgets` (`id`, `position`, `description`, `name`, `modulname`, `plugin_folder`, `widget_file`, `sort`) VALUES
('', 'page_navigation_widget', 'Diese Box ist die Navigation auf der Seite', '', '', NULL, NULL, 1),
('', 'page_navigation_widget', NULL, 'Navigation Default', 'navigation_default', 'navigation_default', 'widget_navigation_default_functions.php', 1)");




if ($transaction->successful()) {
        return array('status' => 'success', 'message' => 'Updated from Webspell-RM 2.0.1 to Webspell RM 2.0.2 - 1');
    } else {
        return array('status' => 'fail', 'message' => 'Failed to update to Webspell-RM 2.0.2 - 1<br/>' . $transaction->getError());
    }

}

function update_rm_201_202_2($_database)
{
    $transaction = new Transaction($_database);



if ($transaction->successful()) {
        return array('status' => 'success', 'message' => 'Updated from Webspell-RM 2.0.1 to Webspell RM 2.0.2 - 2');
    } else {
        return array('status' => 'fail', 'message' => 'Failed to update to Webspell-RM 2.0.2 - 6<br/>' . $transaction->getError());
    }

}

function update_base_2($_database) {
  global $adminname;
  $transaction = new Transaction($_database);

  //Nicknametabelle erstellen
  $transaction->addQuery("DROP TABLE IF EXISTS ".PREFIX."nickname");
  $transaction->addQuery("CREATE TABLE ".PREFIX."nickname (
  userID int(11) NOT NULL,
  nickname varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8");

  $transaction->addQuery("ALTER TABLE ".PREFIX."nickname
  ADD PRIMARY KEY (userID)");

  $transaction->addQuery("ALTER TABLE ".PREFIX."nickname
  MODIFY userID int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2");
  $transaction->addQuery("INSERT INTO ".PREFIX."nickname (userID, nickname) VALUES (1, '".$adminname."')");

  //FORUM - Doppelpost
  $transaction->addQuery("ALTER TABLE `".PREFIX."settings` ADD `forum_double` INT(1) NOT NULL DEFAULT '1'"); 

  if ($transaction->successful()) {
      return array('status' => 'success', 'message' => '- Webspell-Update 20.02.2021');
  } else {
      return array('status' => 'fail', 'message' => '-  Webspell-Update 20.02.2021<br/>' . $transaction->getError());
  }

}
?>