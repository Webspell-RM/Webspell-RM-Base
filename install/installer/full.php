<?php
function update_base_1($_database) {

$transaction = new Transaction($_database);
global $adminname;
global $adminpassword;
global $adminmail;
global $url;
    
$new_pepper = Gen_PasswordPepper();
$adminhash = password_hash($adminpassword.$new_pepper,PASSWORD_BCRYPT,array('cost'=>12));


$transaction->addQuery("DROP TABLE IF EXISTS `".PREFIX."banned_ips`");
$transaction->addQuery("CREATE TABLE IF NOT EXISTS `".PREFIX."banned_ips` (
  `banID` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `deltime` int(15) NOT NULL,
  `reason` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`banID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");

$transaction->addQuery("DROP TABLE IF EXISTS `".PREFIX."captcha`");
$transaction->addQuery("CREATE TABLE IF NOT EXISTS `".PREFIX."captcha` (
  `hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `captcha` int(11) NOT NULL DEFAULT '0',
  `deltime` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`hash`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");

$transaction->addQuery("INSERT INTO `".PREFIX."captcha` (`hash`, `captcha`, `deltime`) VALUES
('826febab3d8083ba01f6b544241412fa', 0, 1578479835)");

$transaction->addQuery("DROP TABLE IF EXISTS `".PREFIX."contact`");
$transaction->addQuery("CREATE TABLE IF NOT EXISTS `".PREFIX."contact` (
  `contactID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `sort` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`contactID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");

$transaction->addQuery("INSERT INTO `".PREFIX."contact` (`contactID`, `name`, `email`, `sort`) VALUES
(1, 'Administrator', '" . $adminmail . "', 1)");

$transaction->addQuery("DROP TABLE IF EXISTS `".PREFIX."cookies`");
$transaction->addQuery("CREATE TABLE IF NOT EXISTS `".PREFIX."cookies` (
  `userID` int(11) NOT NULL,
  `cookie` binary(64) NOT NULL,
  `expiration` int(14) NOT NULL,
  PRIMARY KEY (`userID`,`cookie`),
  KEY `expiration` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1");

$transaction->addQuery("DROP TABLE IF EXISTS `".PREFIX."counter`");
$transaction->addQuery("CREATE TABLE IF NOT EXISTS `".PREFIX."counter` (
  `hits` int(20) NOT NULL DEFAULT '0',
  `online` int(14) NOT NULL DEFAULT '0',
  `maxonline` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");

$transaction->addQuery("INSERT INTO `".PREFIX."counter` (`hits`, `online`, `maxonline`) VALUES
(2, 1578422663, 2)");

$transaction->addQuery("DROP TABLE IF EXISTS `".PREFIX."counter_iplist`");
$transaction->addQuery("CREATE TABLE IF NOT EXISTS `".PREFIX."counter_iplist` (
  `dates` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `del` int(20) NOT NULL DEFAULT '0',
  `ip` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");

$transaction->addQuery("INSERT INTO `".PREFIX."counter_iplist` (`dates`, `del`, `ip`) VALUES
('07.01.2020', 1578422668, '87.178.133.56')");

$transaction->addQuery("DROP TABLE IF EXISTS `".PREFIX."counter_stats`");
$transaction->addQuery("CREATE TABLE IF NOT EXISTS `".PREFIX."counter_stats` (
  `dates` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `count` int(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");

$transaction->addQuery("INSERT INTO `".PREFIX."counter_stats` (`dates`, `count`) VALUES
('07.01.2020', 1)");

$transaction->addQuery("DROP TABLE IF EXISTS `".PREFIX."email`");
$transaction->addQuery("CREATE TABLE IF NOT EXISTS `".PREFIX."email` (
  `emailID` int(1) NOT NULL,
  `user` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `host` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `port` int(5) NOT NULL,
  `debug` int(1) NOT NULL,
  `auth` int(1) NOT NULL,
  `html` int(1) NOT NULL,
  `smtp` int(1) NOT NULL,
  `secure` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");

$transaction->addQuery("INSERT INTO `".PREFIX."email` (`emailID`, `user`, `password`, `host`, `port`, `debug`, `auth`, `html`, `smtp`, `secure`) VALUES
(1, '', '', '', 25, 0, 0, 1, 0, 0)");

$transaction->addQuery("DROP TABLE IF EXISTS `".PREFIX."failed_login_attempts`");
$transaction->addQuery("CREATE TABLE IF NOT EXISTS `".PREFIX."failed_login_attempts` (
  `ip` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `wrong` int(2) DEFAULT '0',
  PRIMARY KEY (`ip`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");

$transaction->addQuery("DROP TABLE IF EXISTS `".PREFIX."forum_posts_spam`");
$transaction->addQuery("CREATE TABLE IF NOT EXISTS `".PREFIX."forum_posts_spam` (
  `postID` int(11) NOT NULL AUTO_INCREMENT,
  `boardID` int(11) NOT NULL DEFAULT '0',
  `topicID` int(11) NOT NULL DEFAULT '0',
  `date` int(14) NOT NULL DEFAULT '0',
  `poster` int(11) NOT NULL DEFAULT '0',
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `rating` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`postID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");

$transaction->addQuery("DROP TABLE IF EXISTS `".PREFIX."forum_topics_spam`");
$transaction->addQuery("CREATE TABLE IF NOT EXISTS `".PREFIX."forum_topics_spam` (
  `topicID` int(11) NOT NULL AUTO_INCREMENT,
  `boardID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `date` int(14) NOT NULL,
  `icon` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `topic` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sticky` int(1) NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `rating` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`topicID`),
  KEY `date` (`date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");

$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "plugins_forum_ranks`");
$transaction->addQuery("CREATE TABLE IF NOT EXISTS `" . PREFIX . "plugins_forum_ranks` (
  `rankID` int(11) NOT NULL AUTO_INCREMENT,
  `rank` varchar(255) NOT NULL default '',
  `pic` varchar(255) NOT NULL default '',
  `postmin` int(11) NOT NULL default '0',
  `postmax` int(11) NOT NULL default '0',
  `special` int(1) NULL DEFAULT '0',
  PRIMARY KEY  (`rankID`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");


$transaction->addQuery("INSERT INTO `".PREFIX."plugins_forum_ranks` (`rankID`, `rank`, `pic`, `postmin`, `postmax`, `special`) VALUES
(1, 'Rank 0', 'rank0.png', 0, 9, 0),
(2, 'Rank 1', 'rank1.png', 10, 29, 0),    
(3, 'Rank 2', 'rank2.png', 30, 49, 0),
(4, 'Rank 3', 'rank3.png', 50, 69, 0),
(5, 'Rank 4', 'rank4.png', 70, 89, 0),
(6, 'Rank 5', 'rank5.png', 90, 119, 0),
(7, 'Rank 6', 'rank6.png', 100, 299, 0),
(8, 'Rank 7', 'rank7.png', 300, 599, 0),
(9, 'Rank 8', 'rank8.png', 600, 899, 0),
(10, 'Rank 9', 'rank9.png', 900, 1299, 0),
(11, 'Rank 10', 'rank10.png', 1300, 1599, 0),
(12, 'Rank 11', 'rank11.png', 1600, 1999, 0),
(13, 'Rank 12', 'rank12.png', 2000, 2147483647, 0),
(14, 'Administrator', 'admin.png', 0, 0, 1),
(15, 'Moderator', 'moderator.png', 0, 0, 1)");


$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "plugins_forum_groups`");
$transaction->addQuery("CREATE TABLE IF NOT EXISTS `" . PREFIX . "plugins_forum_groups` (
  `fgrID` int(11) NOT NULL auto_increment,
  `name` varchar(32) NOT NULL default '0',
  PRIMARY KEY  (`fgrID`)
  ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");

$transaction->addQuery("INSERT INTO `".PREFIX."plugins_forum_groups` ( `fgrID` , `name` ) VALUES ('1', 'Intern board users')");

$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "plugins_forum_moderators`");
$transaction->addQuery("CREATE TABLE IF NOT EXISTS `" . PREFIX . "plugins_forum_moderators` (
  `modID` int(11) NOT NULL AUTO_INCREMENT,
  `boardID` int(11) NOT NULL DEFAULT '0',
  `userID` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`modID`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");


$transaction->addQuery("DROP TABLE IF EXISTS `".PREFIX."lock`");
$transaction->addQuery("CREATE TABLE IF NOT EXISTS `".PREFIX."lock` (
  `time` int(11) NOT NULL,
  `reason` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");

$transaction->addQuery("DROP TABLE IF EXISTS `".PREFIX."modrewrite`");
$transaction->addQuery("CREATE TABLE IF NOT EXISTS `".PREFIX."modrewrite` (
  `ruleID` int(11) NOT NULL AUTO_INCREMENT,
  `regex` text COLLATE utf8_unicode_ci NOT NULL,
  `link` text COLLATE utf8_unicode_ci NOT NULL,
  `fields` text COLLATE utf8_unicode_ci NOT NULL,
  `replace_regex` text COLLATE utf8_unicode_ci NOT NULL,
  `replace_result` text COLLATE utf8_unicode_ci NOT NULL,
  `rebuild_regex` text COLLATE utf8_unicode_ci NOT NULL,
  `rebuild_result` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ruleID`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");

$transaction->addQuery("DROP TABLE IF EXISTS `".PREFIX."navigation_dashboard_categories`");
$transaction->addQuery("CREATE TABLE IF NOT EXISTS `".PREFIX."navigation_dashboard_categories` (
  `catID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `fa_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `accesslevel` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `default` int(1) NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`catID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");

$transaction->addQuery("INSERT INTO `".PREFIX."navigation_dashboard_categories` (`catID`, `name`, `fa_name`, `accesslevel`, `default`, `sort`) VALUES
(1, '{[de]}Hauptteil{[en]}Main Panel{[it]}Pannello Principale', 'fas fa-chart-bar', 'any', 0, 1),
(2, '{[de]}Benutzer Administration{[en]}User Administration{[it]}Amministrazione Utenti', 'fas fa-users', 'user', 0, 2),
(3, '{[de]}Spam{[en]}Spam{[it]}Spam', 'fas fa-exclamation-triangle', 'user', 0, 3),
(4, '{[de]}Layout{[en]}Layout{[it]}Disposizione', 'far fa-image', 'cash', 0, 4),
(5, '{[de]}Systemverwaltung{[en]}System Management{[it]}Gestione del sistema', 'fas fa-cogs', 'page', 0, 5),
(6, '{[de]}Plugin Verwaltung{[en]}Plugin Administration{[it]}Gestione Plugin', 'fas fa-puzzle-piece', 'page', 0, 6),
(7, '{[de]}Plugins Webseiteninhalt{[en]}Plugins Website Content{[it]}Gestione Contenuto Plugin', 'fas fa-folder', 'page', 0, 7),
(8, '{[de]}Plugins System / Social Media{[en]}Plugins System / Social Media{[it]}Gestione di Plugin / Social Media', 'fas fa-share-alt', 'page', 0, 8),
(9, '{[de]}Plugins Webseiten Layout{[en]}Plugins Web Pages Layout{[it]}Layout Plugins Pagine Web', 'fas fa-palette', 'page', 0, 9)");

$transaction->addQuery("DROP TABLE IF EXISTS `".PREFIX."navigation_dashboard_links`");
$transaction->addQuery("CREATE TABLE IF NOT EXISTS `".PREFIX."navigation_dashboard_links` (
  `linkID` int(11) NOT NULL AUTO_INCREMENT,
  `catID` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `modulname` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `accesslevel` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `sort` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`linkID`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");

$transaction->addQuery("INSERT INTO `".PREFIX."navigation_dashboard_links` (`linkID`, `catID`, `name`, `modulname`, `url`, `accesslevel`, `sort`) VALUES
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
(16, 4, '{[de]}.css{[en]}.css{[it]}.css', '', 'admincenter.php?site=settings_css', 'page', 5),
(17, 4, '{[de]}Themes / Style{[en]}Themes / Style{[it]}Temi Grafici / stile', '', 'admincenter.php?site=settings_templates', 'page', 7),
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

$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "navigation_website_main`");
$transaction->addQuery("CREATE TABLE `" . PREFIX . "navigation_website_main` (
  `mnavID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `default` int(11) NOT NULL DEFAULT '1',
  `sort` int(2) NOT NULL DEFAULT '0',
  `isdropdown` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY  (`mnavID`)
) AUTO_INCREMENT=1
  DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");
  
  $transaction->addQuery("INSERT INTO `".PREFIX ."navigation_website_main` (`mnavID`, `name`, `url`, `default`, `sort`, `isdropdown`) VALUES
(1, '{[de]}HAUPT{[en]}MAIN{[pl]}STRONA GLÓWNA{[it]}PRINCIPALE', '#', 1, 1, 1),
(2, '{[de]}TEAM{[en]}TEAM{[pl]}DRUZYNA{[it]}TEAM', '#', 1, 2, 1),
(3, '{[de]}GEMEINSCHAFT{[en]}COMMUNITY{[pl]}SPOLECZNOSC{[it]}COMMUNITY', '#', 1, 3, 1),
(4, '{[de]}MEDIEN{[en]}MEDIA{[pl]}MEDIA{[it]}MEDIA', '#', 1, 4, 1),
(5, '{[de]}SONSTIGES{[en]}MISCELLANEOUS{[pl]}RÓZNE{[it]}VARIE', '#', 1, 5, 1)");

$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "navigation_website_sub`");
$transaction->addQuery("CREATE TABLE `" . PREFIX . "navigation_website_sub` (
  `snavID` int(11) NOT NULL AUTO_INCREMENT,
  `mnavID` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `modulname` varchar(100) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `sort` int(2) NOT NULL DEFAULT '0',
  `indropdown` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY  (`snavID`)
) AUTO_INCREMENT=4
  DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");
  
$transaction->addQuery("INSERT INTO `" . PREFIX . "navigation_website_sub` (`snavID`, `mnavID`, `name`, `modulname`, `url`, `sort`, `indropdown`) VALUES
(1, 5, '{[de]}Kontakt{[en]}Contact{[it]}Contatti', '', 'index.php?site=contact', 1, 1),
(2, 5, '{[de]}Datenschutz-Bestimmungen{[en]}Privacy Policy{[it]}Informativa sulla privacy', '', 'index.php?site=privacy_policy', 2, 1),
(3, 5, '{[de]}Impressum{[en]}Imprint{[it]}Impronta Editoriale', '', 'index.php?site=imprint', 3, 1)");


$transaction->addQuery("DROP TABLE IF EXISTS `".PREFIX."plugins`");
$transaction->addQuery("CREATE TABLE IF NOT EXISTS `".PREFIX."plugins` (
  `pluginID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `modulname` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `admin_file` text COLLATE utf8_unicode_ci NOT NULL,
  `activate` int(1) NOT NULL DEFAULT '1',
  `author` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `website` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `index_link` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `sc_link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hiddenfiles` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `version` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `le_activated` int(11) NOT NULL,
  `re_activated` int(11) NOT NULL,
  `all_activated` int(11) NOT NULL,
  `all_deactivated` int(11) NOT NULL,
  `head_activated` int(11) NOT NULL,
  `content_head_activated` int(11) NOT NULL,
  `content_foot_activated` int(11) NOT NULL,
  `head_section_activated` int(1) DEFAULT '0',
  `foot_section_activated` int(1) DEFAULT '0',
  `widgetname1` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `widgetname2` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `widgetname3` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `widget_link1` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `widget_link2` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `widget_link3` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `modul_deactivated` int(1) DEFAULT '0',
  PRIMARY KEY (`pluginID`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");

$transaction->addQuery("INSERT INTO `".PREFIX."plugins` (`pluginID`, `name`, `modulname`, `description`, `admin_file`, `activate`, `author`, `website`, `index_link`, `sc_link`, `hiddenfiles`, `version`, `path`, `le_activated`, `re_activated`, `all_activated`, `all_deactivated`, `head_activated`, `content_head_activated`, `content_foot_activated`, `head_section_activated`, `foot_section_activated`, `widgetname1`, `widgetname2`, `widgetname3`, `widget_link1`, `widget_link2`, `widget_link3`, `modul_deactivated`) VALUES
(1, 'Navigation Default', 'navigation_default', 'Mit diesem Plugin koennt ihr euch die Default Navigation anzeigen lassen..', '', 1, 'T-Seven', 'https://www.webspell-rm.de', '', '', '', '1.0', 'includes/plugins/navigation_default/', 0, 0, 0, 0, 0, 0, 0, 0, 0, 'navigation_default', '', '', 'widget_navigation_default', '', '', 0),
(2, 'My Profile', 'myprofile', 'Kein Plugin. Bestandteil vom System!!!', 'n/a', 1, 'T-Seven', 'https://www.webspell-rm.de', 'n/a', 'n/a', 'n/a', 'n/a', 'n/a', 0, 0, 1, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', 0),
(3, 'Profile', 'profile', 'Kein Plugin. Bestandteil vom System!!!', 'n/a', 1, 'T-Seven', 'https://www.webspell-rm.de', 'n/a', 'n/a', 'n/a', 'n/a', 'n/a', 0, 0, 1, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', 0),
(4, 'Login', 'login', 'Kein Plugin. Bestandteil vom System!!!', 'n/a', 1, 'T-Seven', 'https://www.webspell-rm.de', 'n/a', 'n/a', 'n/a', 'n/a', 'n/a', 0, 0, 1, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', 0),
(5, 'Loginoverview', 'loginoverview', 'Kein Plugin. Bestandteil vom System!!!', 'n/a', 1, 'T-Seven', 'https://www.webspell-rm.de', 'n/a', 'n/a', 'n/a', 'n/a', 'n/a', 0, 0, 1, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', 0),
(6, 'Contact', 'contact', 'Kein Plugin. Bestandteil vom System!!!', 'n/a', 1, 'T-Seven', 'https://www.webspell-rm.de', 'n/a', 'n/a', 'n/a', 'n/a', 'n/a', 0, 0, 1, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', 0),
(7, 'Lost Password', 'lostpassword', 'Kein Plugin. Bestandteil vom System!!!', 'n/a', 1, 'T-Seven', 'https://www.webspell-rm.de', 'n/a', 'n/a', 'n/a', 'n/a', 'n/a', 0, 0, 1, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', 0),
(8, 'Register', 'register', 'Kein Plugin. Bestandteil vom System!!!', 'n/a', 1, 'T-Seven', 'https://www.webspell-rm.de', 'n/a', 'n/a', 'n/a', 'n/a', 'n/a', 0, 0, 1, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', 0),
(9, '', 'startpage', 'Kein Plugin. Bestandteil vom System!!!', 'n/a', 1, 'T-Seven', 'https://www.webspell-rm.de', 'n/a', 'n/a', 'n/a', 'n/a', 'n/a', 0, 0, 1, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', 1),
(10, 'Startpage', '', 'Kein Plugin. Bestandteil vom System!!!', 'n/a', 1, 'T-Seven', 'https://www.webspell-rm.de', 'n/a', 'n/a', 'n/a', 'n/a', 'n/a', 0, 0, 1, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', 0),
(11, 'Privacy Policy', 'privacy_policy', 'Kein Plugin. Bestandteil vom System!!!', 'n/a', 1, 'T-Seven', 'https://www.webspell-rm.de', 'n/a', 'n/a', 'n/a', 'n/a', 'n/a', 0, 0, 1, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', 0),
(12, 'Imprint', 'imprint', 'Kein Plugin. Bestandteil vom System!!!', 'n/a', 1, 'T-Seven', 'https://www.webspell-rm.de', 'n/a', 'n/a', 'n/a', 'n/a', 'n/a', 0, 0, 1, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', 0),
(13, 'Static', 'static', 'Kein Plugin. Bestandteil vom System!!!', 'n/a', 1, 'T-Seven', 'https://www.webspell-rm.de', 'n/a', '', 'n/a', 'n/a', 'n/a', 0, 0, 1, 0, 0, 0, 0, 0, 0, '', '', '', 'n/a', '', '', 0)");

$transaction->addQuery("ALTER TABLE `" . PREFIX . "plugins` DROP `sc_link`");// sc_link löschen

$transaction->addQuery("DROP TABLE IF EXISTS `".PREFIX."plugins_widgets`");
$transaction->addQuery("CREATE TABLE IF NOT EXISTS `".PREFIX."plugins_widgets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `position` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `modulname` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `plugin_folder` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `widget_file` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sort` int(11) DEFAULT '0',
  `widgetname` varchar(255) COLLATE utf8_unicode_ci DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");

$transaction->addQuery("INSERT INTO `".PREFIX."plugins_widgets` (`id`, `position`, `description`, `name`, `modulname`, `plugin_folder`, `widget_file`, `sort`, `widgetname`) VALUES
(1, 'page_navigation_widget', 'Navigation', '', '', NULL, NULL, 1, 0),
(2, 'page_head_widget', 'Page Head', '', '', NULL, NULL, 2, 0),
(3, 'head_section_widget', 'Head Section', '', '', NULL, NULL, 3, 0),
(4, 'center_head_widget', 'Content Head', '', '', NULL, NULL, 4, 0),
(5, 'left_side_widget', 'Page Left', '', '', NULL, NULL, 5, 0),
(6, 'right_side_widget', 'Page Right', '', '', NULL, NULL, 6, 0),
(7, 'center_footer_widget', 'Content Foot', '', '', NULL, NULL, 7, 0),
(8, 'foot_section_widget', 'Foot Section', '', '', NULL, NULL, 8, 0),
(9, 'page_footer_widget', 'Page Footer', '', '', NULL, NULL, 9, 0),
(10, 'page_navigation_widget', 'page_navigation_widget', 'Navigation Default', 'navigation_default', 'navigation_default', 'widget_navigation_default.php', 1, 'navigation_default')");


$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "settings`");
    $transaction->addQuery("CREATE TABLE `" . PREFIX . "settings` (
  `settingID` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `hpurl` varchar(255) NOT NULL DEFAULT '',
  `clanname` varchar(255) NOT NULL DEFAULT '',
  `clantag` varchar(255) NOT NULL DEFAULT '',
  `adminname` varchar(255) NOT NULL DEFAULT '',
  `adminemail` varchar(255) NOT NULL DEFAULT '',
  `sball` int(11) NOT NULL DEFAULT '0',
  `topics` int(11) NOT NULL DEFAULT '0',
  `posts` int(11) NOT NULL DEFAULT '0',
  `latesttopics` int(11) NOT NULL,
  `latesttopicchars` int(11) NOT NULL DEFAULT '0',
  `messages` int(11) NOT NULL DEFAULT '0',
  `register_per_ip` int(1) NOT NULL DEFAULT '1',
  `sessionduration` int(3) NOT NULL,
  `closed` int(1) NOT NULL DEFAULT '0',
  `imprint` int(1) NOT NULL DEFAULT '0',
  `default_language` varchar(2) NOT NULL DEFAULT 'en',
  `insertlinks` int(1) NOT NULL DEFAULT '1',
  `search_min_len` int(3) NOT NULL DEFAULT '3',
  `max_wrong_pw` int(2) NOT NULL DEFAULT '10',
  `captcha_math` int(1) NOT NULL DEFAULT '2',
  `captcha_bgcol` varchar(7) NOT NULL DEFAULT '#FFFFFF',
  `captcha_fontcol` varchar(7) NOT NULL DEFAULT '#000000',
  `captcha_type` int(1) NOT NULL DEFAULT '2',
  `captcha_noise` int(3) NOT NULL DEFAULT '100',
  `captcha_linenoise` int(2) NOT NULL DEFAULT '10',
  `bancheck` int(13) NOT NULL,
  `spam_check` int(1) NOT NULL DEFAULT '0',
  `detect_language` int(1) NOT NULL DEFAULT '0',
  `spammaxposts` int(11) NOT NULL DEFAULT '0',
  `spamapiblockerror` int(1) NOT NULL DEFAULT '0',
  `date_format` varchar(255) NOT NULL DEFAULT 'd.m.Y',
  `time_format` varchar(255) NOT NULL DEFAULT 'H:i',
  `modRewrite` int(1) NOT NULL DEFAULT '0',
  `startpage` varchar(255) NOT NULL DEFAULT '',
  `ftpip` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ftpport` int(11) NOT NULL,
  `ftppath` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ftpuser` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `ftppw` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `forum_double` INT(1) NOT NULL DEFAULT '1',
  `profilelast` int(11) NOT NULL DEFAULT '10',
  `de_lang` int(1) DEFAULT '1',
  `en_lang` int(1) DEFAULT '1',
  `it_lang` int(1) DEFAULT '1',
  `pl_lang` int(1) DEFAULT '1',
  PRIMARY KEY (`settingID`)
) AUTO_INCREMENT=2
  DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");

    $transaction->addQuery("INSERT IGNORE INTO `" . PREFIX . "settings` (`settingID`, `title`, `hpurl`, `clanname`, `clantag`, `adminname`, `adminemail`, `sball`, `topics`, `posts`, `latesttopics`, `latesttopicchars`, `messages`, `register_per_ip`, `sessionduration`, `closed`, `imprint`, `default_language`, `insertlinks`, `search_min_len`, `max_wrong_pw`, `captcha_math`, `captcha_bgcol`, `captcha_fontcol`, `captcha_type`, `captcha_noise`, `captcha_linenoise`, `bancheck`, `spam_check`, `detect_language`, `spammaxposts`, `spamapiblockerror`, `date_format`, `time_format`, `modRewrite`, `startpage`, `ftpip`, `ftpport`, `ftppath`, `ftpuser`, `ftppw`, `forum_double`, `profilelast`, `de_lang`, `en_lang`, `it_lang`, `pl_lang`) VALUES
(1, 'webSpell | RM 2.0', '" . $url . "', 'Clan Name', 'MyClan', '" . $adminname . "', '" . $adminmail . "', 30, 20, 10, 10, 18, 20, 1, 0, 0, 1, 'de', 1, 3, 10, 2, '#FFFFFF', '#000000', 2, 100, 10, 1564938159, 0, 0, 0, 0, 'd.m.Y', 'H:i', 0, 'startpage', '', '', '', '', '', 1, 10, 1, 1, 1, 1)");

$transaction->addQuery("DROP TABLE IF EXISTS `".PREFIX."settings_buttons`");
$transaction->addQuery("CREATE TABLE IF NOT EXISTS `".PREFIX."settings_buttons` (
  `buttonID` int(11) NOT NULL AUTO_INCREMENT,
  `button1` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button2` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button3` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button4` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button5` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button6` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button7` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button8` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button9` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button10` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button11` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button12` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button13` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button14` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button15` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button16` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button17` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button18` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button19` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button20` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button21` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button22` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button23` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button24` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button25` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button26` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button27` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button28` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button29` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button30` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button31` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button32` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button33` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button34` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button35` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button36` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button37` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button38` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button39` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button40` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button41` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button42` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button43` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button44` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button45` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`buttonID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");

$transaction->addQuery("INSERT INTO `".PREFIX."settings_buttons` (`buttonID`, `button1`, `button2`, `button3`, `button4`, `button5`, `button6`, `button7`, `button8`, `button9`, `button10`, `button11`, `button12`, `button13`, `button14`, `button15`, `button16`, `button17`, `button18`, `button19`, `button20`, `button21`, `button22`, `button23`, `button24`, `button25`, `button26`, `button27`, `button28`, `button29`, `button30`, `button31`, `button32`, `button33`, `button34`, `button35`, `button36`, `button37`, `button38`, `button39`, `button40`, `button41`, `button42`, `button43`, `button44`, `button45`) VALUES
(1, '#007bff', '#0069d9', '#ffffff', '#007bff', '#0062cc', '#6c757d', '#5a6268', '#ffffff', '#6c757d', '#545b62', '#28a745', '#218838', '#ffffff', '#28a745', '#1e7e34', '#dc3545', '#c82333', '#ffffff', '#dc3545', '#bd2130', '#ffc107', '#e0a800', '#212529', '#ffc107', '#d39e00', '#17a2b8', '#138496', '#ffffff', '#17a2b8', '#117a8b', '#f8f9fa', '#e2e6ea', '#212529', '#f8f9fa', '#dae0e5', '#343a40', '#23272b', '#ffffff', '#343a40', '#1d2124', '#007bff', '#0056b3', '#ffffff', '#ffffff', '#ffffff')");

$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "settings_games`");
    $transaction->addQuery("CREATE TABLE `" . PREFIX . "settings_games` (
  `gameID` int(11) NOT NULL AUTO_INCREMENT,
  `tag` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `name` varchar(225) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
PRIMARY KEY  (`gameID`)
) AUTO_INCREMENT=52
  DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");

$transaction->addQuery("INSERT IGNORE INTO `" . PREFIX . "settings_games` (`gameID`, `tag`, `name`) VALUES
(1, 'apex_l', 'Apex Legends'),
(2, 'ark_se', 'ARK: Survival Evolved'),
(3, 'ac', 'Assetto Corsa'),
(4, 'bf_1', 'Battlefield'),
(5, 'bf_4', 'Battlefield 4'),
(6, 'bf_5', 'Battlefield 5'),
(7, 'bd', 'Black Desert'),
(8, 'cod_mw', 'Call of Duty: Modern Warfare'),
(9, 'cod_wz', 'Call of Duty: Warzone'),
(10, 'ce', 'Conan Exiles'),
(11, 'cs_go', 'Counter-Strike: GO'),
(12, 'cs_s', 'Counter-Strike: Source'),
(13, 'dbd', 'Dead by Daylight'),
(14, 'd_2', 'Destiny 2'),
(15, 'di_3', 'Diablo III'),
(16, 'dac', 'Dota Auto Chess'),
(17, 'do_2', 'Dota 2'),
(18, 'd_ul', 'Dota Underlords'),
(19, 'teso', 'The Elder Scrolls Online'),
(20, 'f1_2020', 'F1 2020'),
(21, 'fifa_20', 'FIFA 20'),
(22, 'ff_14', 'Final Fantasy XIV'),
(23, 'fort', 'Fortnite'),
(24, 'gta_on', 'Grand Theft Auto Online'),
(25, 'gw_2', 'Guild Wars 2'),
(26, 'hs_how', 'Hearthstone: Heroes of Warcraft'),
(27, 'h_sd', 'Hunt: Showdown'),
(28, 'lol', 'League of Legends'),
(29, 'lor', 'Legends of Runeterra'),
(30, 'mc', 'Minecraft'),
(31, 'mc_d', 'Minecraft Dungeons'),
(32, 'mh_w', 'Monster Hunter: World'),
(33, 'ow', 'Overwatch'),
(34, 'poe', 'Path of Exile'),
(35, 'pd_2', 'Payday 2'),
(36, 'pubg', 'Playerunknown\'s Battlegrounds'),
(37, 'rs_s', 'Rainbow Six: Siege'),
(38, 'rd_o', 'Red Dead Online'),
(39, 'rl', 'Rocket League'),
(40, 'smi', 'Smite'),
(41, 'sc2_wol', 'StarCraft II: Wings of Liberty'),
(42, 'swbf2', 'Star Wars Battlefront II'),
(43, 'swbf1', 'Star Wars: Battlefront'),
(44, 'tf_t', 'Teamfight Tactics'),
(45, 'td2', 'The Division 2'),
(46, 'vt', 'Valorant'),
(47, 'war_f', 'Warframe'),
(48, 'wc3_roc', 'Warcraft III: Reign of Chaos'),
(49, 'wc3_ref', 'Warcraft III: Reforged'),
(50, 'wot', 'World of Tanks'),
(51, 'wow', 'World of Warcraft')");

$transaction->addQuery("DROP TABLE IF EXISTS `".PREFIX."settings_imprint`");
$transaction->addQuery("CREATE TABLE IF NOT EXISTS `".PREFIX."settings_imprint` (
  `imprintID` int(11) NOT NULL AUTO_INCREMENT,
  `imprint` text COLLATE utf8_unicode_ci NOT NULL,
  `disclaimer_text` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`imprintID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");

$transaction->addQuery("INSERT INTO `" . PREFIX . "settings_imprint` (`imprintID`, `imprint`, `disclaimer_text`) VALUES
(1, '{[de]} Impressum in deutscher Sprache.<br /><span style=\"color:#c0392b\"><strong>Konfigurieren Sie bitte Ihr Impressum!</strong></span><br />{[en]} Imprint in English.<br /><span style=\"color:#c0392b\"><strong>Please configure your imprint!</strong></span>{[it]} Impronta Editoriale in Italianoh.<br /><span style=\"color:#c0392b\"><strong>Si prega di configurare l&rsquo;impronta!</strong></span>', '{[de]} Haftungsausschluss in deutscher Sprache.<br /><span style=\"color:#c0392b\"><strong>Konfigurieren Sie bitte Ihr Haftungsausschluss! </strong></span><br />{[en]} Disclaimer in English.<br /><span style=\"color:#c0392b\"><strong>Please configure your disclaimer!</strong></span>{[it]} Dichiarazione di non Responsabilità in Italiano.<br /><span style=\"color:#c0392b\"><strong>Si prega di configurare la Dichiarazione di non Responsabilità!</strong></span>')");

$transaction->addQuery("DROP TABLE IF EXISTS `".PREFIX."settings_languages`");
$transaction->addQuery("CREATE TABLE IF NOT EXISTS `".PREFIX."settings_languages` (
  `langID` int(11) NOT NULL AUTO_INCREMENT,
  `language` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `lang` char(2) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `alt` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`langID`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci PACK_KEYS=0");

$transaction->addQuery("INSERT INTO `".PREFIX."settings_languages` (`langID`, `language`, `lang`, `alt`) VALUES
(1, 'danish', 'da', 'danish'),
(2, 'dutch', 'nl', 'dutch'),
(3, 'english', 'en', 'english'),
(4, 'finnish', 'fi', 'finnish'),
(5, 'french', 'fr', 'french'),
(6, 'german', 'de', 'german'),
(7, 'hungarian', 'hu', 'hungarian'),
(8, 'italian', 'it', 'italian'),
(9, 'norwegian', 'no', 'norwegian'),
(10, 'spanish', 'es', 'spanish'),
(11, 'swedish', 'sv', 'swedish'),
(12, 'czech', 'cs', 'czech'),
(13, 'croatian', 'hr', 'croatian'),
(14, 'lithuanian', 'lt', 'lithuanian'),
(15, 'polish', 'pl', 'polish'),
(16, 'portuguese', 'pt', 'portuguese'),
(17, 'slovak', 'sk', 'slovak'),
(18, 'arabic', 'ar', 'arabic'),
(19, 'bosnian', 'bs', 'bosnian'),
(20, 'estonian', 'et', 'estonian'),
(21, 'georgian', 'ka', 'georgian'),
(22, 'macedonian', 'mk', 'macedonian'),
(23, 'persian', 'fa', 'persian'),
(24, 'romanian', 'ro', 'romanian'),
(25, 'russian', 'ru', 'russian'),
(26, 'serbian', 'sr', 'serbian'),
(27, 'slovenian', 'sl', 'slovenian'),
(28, 'latvian', 'lv', 'latvian'),
(29, 'turkish', 'tr', 'turkish'),
(30, 'albanian', 'sq', 'albanian'),
(31, 'bulgarian', 'bg', 'bulgarian'),
(32, 'greek', 'el', 'greek'),
(33, 'ukrainian', 'uk', 'ukrainian'),
(34, 'luxembourgish', 'lb', 'luxembourgish'),
(35, 'afrikaans', 'af', 'afrikaans'),
(36, 'acholi', 'ac', 'acholi')");

$transaction->addQuery("DROP TABLE IF EXISTS `".PREFIX."settings_logo`");
$transaction->addQuery("CREATE TABLE IF NOT EXISTS `".PREFIX."settings_logo` (
  `logoID` int(11) NOT NULL,
  `logo` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");

$transaction->addQuery("INSERT INTO `".PREFIX."settings_logo` (`logoID`, `logo`) VALUES
(1, '1.png')");

$transaction->addQuery("DROP TABLE IF EXISTS `".PREFIX."settings_privacy_policy`");
$transaction->addQuery("CREATE TABLE IF NOT EXISTS `".PREFIX."settings_privacy_policy` (
  `privacy_policyID` int(11) NOT NULL AUTO_INCREMENT,
  `date` int(14) NOT NULL,
  `privacy_policy_text` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`privacy_policyID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");

$transaction->addQuery("INSERT INTO `" . PREFIX . "settings_privacy_policy` (`privacy_policyID`, `date`, `privacy_policy_text`) VALUES
(1, 1576689811, '{[de]} Datenschutz-Bestimmungen in deutscher Sprache.<br /><span style=\"color:#c0392b\"><strong>Konfigurieren Sie bitte Ihre Datenschutz-Bestimmungen!</strong></span><br />{[en]} Privacy Policy in English.<br /><span style=\"color:#c0392b\"><strong>Please configure your Privacy Policy!</strong></span>{[it]} Informativa sulla privacy in Italiano.<br /><span style=\"color:#c0392b\"><strong>Si prega di configurare l&rsquo;Informativa sulla Privacy!</strong></span>')");

$transaction->addQuery("DROP TABLE IF EXISTS `".PREFIX."settings_recaptcha`");
$transaction->addQuery("CREATE TABLE IF NOT EXISTS `".PREFIX."settings_recaptcha` (
  `activated` int(11) NOT NULL DEFAULT '0',
  `webkey` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `seckey` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");

$transaction->addQuery("INSERT INTO `".PREFIX."settings_recaptcha` (`activated`, `webkey`, `seckey`) VALUES
(0, 'Web-Key', 'Sec-Key')");

$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "settings_startpage`");
$transaction->addQuery("CREATE TABLE `" . PREFIX . "settings_startpage` (
  `pageID` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `startpage_text` longtext NOT NULL,
  `date` int(14) NOT NULL,
  PRIMARY KEY (`pageID`)
) AUTO_INCREMENT=2
  DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");

$transaction->addQuery("INSERT INTO `".PREFIX."settings_startpage` (`pageID`, `title`, `startpage_text`, `date`) VALUES (1, '{[de]}Willkommen zu Webspell | RM{[en]}Welcome to Webspell | RM{[pl]}Witamy w Webspell | RM', '<!-- Page Content -->\r\n<div class=\"container\"><!-- Jumbotron Header -->\r\n<h1>Webspell RM!</h1>\r\n\r\n<p>{[de]}</p>\r\n\r\n<p><strong><u>Was ist Webspell RM?</u></strong><br />\r\n<br />\r\nWebspell RM ist ein Clan &amp; Gamer CMS (<em>Content Management System</em>). Es basiert auf PHP, MySQL und der letzten webSPELL.org GitHub Version (4.3.0). Webspell RM l&auml;uft unter der General Public License. Siehe auch <a href=\"http://wiki.webspell-rm.de/index.php?site=static&amp;staticID=4\" target=\"_blank\">Lizenzvereinbarung</a>.</p>\r\n\r\n<p style=\"text-align:center\"><a class=\"btn btn-info\" href=\"http://demo.webspell-rm.de/\" rel=\"noopener\" role=\"button\" target=\"_blank\"><strong><u>WEBSPELL RM DEMO</u></strong></a> <a class=\"btn btn-success\" href=\"https://webspell-rm.de/index.php?site=forum\" rel=\"noopener\" role=\"button\" target=\"_blank\"><strong><u>WEBSPELL RM SUPPORT</u></strong></a></p>\r\n\r\n<p><strong><u>Was bietet Webspell | RM?</u></strong><br />\r\n<br />\r\nWebspell RM basiert auf Bootstrap und ist einfach anzupassen via Dashboard. Theoretisch sind alle Bootstrap Templates verwendbar. Als Editor wir der CKEditor verwendet. Das CMS ist Multi-Language f&auml;hig und liefert von Haus aus viele Sprachen mit. Das beliebte reCAPTCHA wurde als Spam Schutz integriert. Alle Plugins sind via Webspell RM Installer einfach und problemlos zu installieren.</p>\r\n<!-- Page Features -->\r\n\r\n<div class=\"row text-center\">\r\n<div class=\"col-lg-3 col-md-6 col-xl mb-4\">\r\n<div class=\"card h-100\" style=\"width:15rem\"><img alt=\"\" class=\"card-img-top img-fluid\" src=\"https://www.webspell-rm.de/includes/plugins/pic_update/images/173.jpg\" />\r\n<div class=\"card-body\">\r\n<h4>Webside</h4>\r\n\r\n</div>\r\n\r\n<div class=\"card-footer\"><a class=\"btn btn-primary\" href=\"#\">Find Out More!</a></div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-lg-3 col-md-6 col-xl mb-4\">\r\n<div class=\"card h-100\" style=\"width:15rem\"><img alt=\"\" class=\"card-img-top\" src=\"https://www.webspell-rm.de//includes/plugins/pic_update/images/170.jpg\" />\r\n<div class=\"card-body\">\r\n<h4>Dashboard</h4>\r\n\r\n</div>\r\n\r\n<div class=\"card-footer\"><a class=\"btn btn-primary\" href=\"/admin/admincenter.php\" target=\"_blank\">Find Out More!</a></div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-lg-3 col-md-6 col-xl mb-4\">\r\n<div class=\"card h-100\" style=\"width:15rem\"><img alt=\"\" class=\"card-img-top img-fluid\" src=\"https://www.webspell-rm.de/includes/plugins/pic_update/images/171.jpg\" />\r\n<div class=\"card-body\">\r\n<h4>Layout</h4>\r\n\r\n</div>\r\n\r\n<div class=\"card-footer\"><a class=\"btn btn-primary\" href=\"/admin/admincenter.php?site=settings_templates\" target=\"_blank\">Find Out More!</a></div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-lg-3 col-md-6 col-xl mb-4\">\r\n<div class=\"card h-100\" style=\"width:15rem\"><img alt=\"\" class=\"card-img-top img-fluid\" src=\"https://www.webspell-rm.de/includes/plugins/pic_update/images/172.jpg\" />\r\n<div class=\"card-body\">\r\n<h4>Plugin-Installer</h4>\r\n\r\n</div>\r\n\r\n<div class=\"card-footer\"><a class=\"btn btn-primary\" href=\"/admin/admincenter.php?site=plugin-installer\" target=\"_blank\">Find Out More!</a></div>\r\n</div>\r\n</div>\r\n<!-- zweite Reihe -->\r\n\r\n<div class=\"col-lg-3 col-md-6 col-xl mb-4\">\r\n<div class=\"card h-100\" style=\"width:15rem\"><img alt=\"\" class=\"card-img-top img-fluid\" src=\"https://www.webspell-rm.de/includes/plugins/pic_update/images/174.jpg\" />\r\n<div class=\"card-body\">\r\n<h4>Theme-Installer</h4>\r\n\r\n</div>\r\n\r\n<div class=\"card-footer\"><a class=\"btn btn-primary\" href=\"/admin/admincenter.php?site=template-installer\" target=\"_blank\">Find Out More!</a></div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-lg-3 col-md-6 col-xl mb-4\">\r\n<div class=\"card h-100\" style=\"width:15rem\"><img alt=\"\" class=\"card-img-top img-fluid\" src=\"https://www.webspell-rm.de/includes/plugins/pic_update/images/175.jpg\" />\r\n<div class=\"card-body\">\r\n<h4>Updater</h4>\r\n\r\n</div>\r\n\r\n<div class=\"card-footer\"><a class=\"btn btn-primary\" href=\"/admin/admincenter.php?site=update\" target=\"_blank\">Find Out More!</a></div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-lg-3 col-md-6 col-xl mb-4\">\r\n<div class=\"card h-100\" style=\"width:15rem\"><img alt=\"\" class=\"card-img-top img-fluid\" src=\"https://www.webspell-rm.de/includes/plugins/pic_update/images/176.jpg\" />\r\n<div class=\"card-body\">\r\n<h4>Startpage</h4>\r\n\r\n</div>\r\n\r\n<div class=\"card-footer\"><a class=\"btn btn-primary\" href=\"/admin/admincenter.php?site=settings_startpage\" target=\"_blank\">Find Out More!</a></div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-lg-3 col-md-6 col-xl mb-4\">\r\n<div class=\"card h-100\" style=\"width:15rem\"><img alt=\"\" class=\"card-img-top img-fluid\" src=\"https://www.webspell-rm.de/includes/plugins/pic_update/images/177.jpg\" />\r\n<div class=\"card-body\">\r\n<h4>Webspell-RM</h4>\r\n\r\n</div>\r\n\r\n<div class=\"card-footer\"><a class=\"btn btn-primary\" href=\"https://www.webspell-rm.de/forum.html\" target=\"_blank\">Support</a> <a class=\"btn btn-primary\" href=\"https://www.webspell-rm.de/wiki.html\" target=\"_blank\">WIKI</a></div>\r\n</div>\r\n</div>\r\n</div>\r\n<!-- /.row --></div>\r\n<!-- /.container -->\r\n\r\n<p>{[en]}</p>\r\n\r\n<p><strong><u>What is Webspell RM?</u></strong><br />\r\n<br />\r\nWebspell RM is a Clan &amp; Gamer CMS (Content Management System). It is based on PHP, MySQL and the latest webSPELL.org GitHub version (4.3.0). Webspell RM runs under the General Public License. See also license agreement <a href=\"http://wiki.webspell-rm.de/index.php?site=static&amp;staticID=4\" target=\"_blank\">license agreement</a>.</p>\r\n\r\n<p style=\"text-align:center\"><a class=\"btn btn-info\" href=\"http://demo.webspell-rm.de/\" rel=\"noopener\" role=\"button\" target=\"_blank\"><strong><u>WEBSPELL RM DEMO</u></strong></a> <a class=\"btn btn-success\" href=\"https://webspell-rm.de/index.php?site=forum\" rel=\"noopener\" role=\"button\" target=\"_blank\"><strong><u>WEBSPELL RM SUPPORT</u></strong></a></p>\r\n\r\n<p><strong><u>What does Webspell | RM offer?</u></strong><br />\r\n<br />\r\nWebspell RM is based on bootstrap and it is easy to customize via dashboard. Theoretically, all bootstrap templates can be used. As editor we use the CKEditor. The CMS is multi-language capable and comes with many native languages. The popular reCAPTCHA was integrated as spam protection. All plugins are easy to install via Webspell RM Installer.</p>\r\n<!-- Page Features -->\r\n\r\n<div class=\"row text-center\">\r\n<div class=\"col-lg-3 col-md-6 col-xl mb-4\">\r\n<div class=\"card h-100\" style=\"width:15rem\"><img alt=\"\" class=\"card-img-top img-fluid\" src=\"https://www.webspell-rm.de/includes/plugins/pic_update/images/173.jpg\" />\r\n<div class=\"card-body\">\r\n<h4>Webside</h4>\r\n\r\n</div>\r\n\r\n<div class=\"card-footer\"><a class=\"btn btn-primary\" href=\"#\">Find Out More!</a></div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-lg-3 col-md-6 col-xl mb-4\">\r\n<div class=\"card h-100\" style=\"width:15rem\"><img alt=\"\" class=\"card-img-top\" src=\"https://www.webspell-rm.de//includes/plugins/pic_update/images/170.jpg\" />\r\n<div class=\"card-body\">\r\n<h4>Dashboard</h4>\r\n\r\n</div>\r\n\r\n<div class=\"card-footer\"><a class=\"btn btn-primary\" href=\"/admin/admincenter.php\" target=\"_blank\">Find Out More!</a></div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-lg-3 col-md-6 col-xl mb-4\">\r\n<div class=\"card h-100\" style=\"width:15rem\"><img alt=\"\" class=\"card-img-top img-fluid\" src=\"https://www.webspell-rm.de/includes/plugins/pic_update/images/171.jpg\" />\r\n<div class=\"card-body\">\r\n<h4>Layout</h4>\r\n\r\n</div>\r\n\r\n<div class=\"card-footer\"><a class=\"btn btn-primary\" href=\"/admin/admincenter.php?site=settings_templates\" target=\"_blank\">Find Out More!</a></div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-lg-3 col-md-6 col-xl mb-4\">\r\n<div class=\"card h-100\" style=\"width:15rem\"><img alt=\"\" class=\"card-img-top img-fluid\" src=\"https://www.webspell-rm.de/includes/plugins/pic_update/images/172.jpg\" />\r\n<div class=\"card-body\">\r\n<h4>Plugin-Installer</h4>\r\n\r\n</div>\r\n\r\n<div class=\"card-footer\"><a class=\"btn btn-primary\" href=\"/admin/admincenter.php?site=plugin-installer\" target=\"_blank\">Find Out More!</a></div>\r\n</div>\r\n</div>\r\n<!-- zweite Reihe -->\r\n\r\n<div class=\"col-lg-3 col-md-6 col-xl mb-4\">\r\n<div class=\"card h-100\" style=\"width:15rem\"><img alt=\"\" class=\"card-img-top img-fluid\" src=\"https://www.webspell-rm.de/includes/plugins/pic_update/images/174.jpg\" />\r\n<div class=\"card-body\">\r\n<h4>Theme-Installer</h4>\r\n\r\n</div>\r\n\r\n<div class=\"card-footer\"><a class=\"btn btn-primary\" href=\"/admin/admincenter.php?site=template-installer\" target=\"_blank\">Find Out More!</a></div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-lg-3 col-md-6 col-xl mb-4\">\r\n<div class=\"card h-100\" style=\"width:15rem\"><img alt=\"\" class=\"card-img-top img-fluid\" src=\"https://www.webspell-rm.de/includes/plugins/pic_update/images/175.jpg\" />\r\n<div class=\"card-body\">\r\n<h4>Updater</h4>\r\n\r\n</div>\r\n\r\n<div class=\"card-footer\"><a class=\"btn btn-primary\" href=\"/admin/admincenter.php?site=update\" target=\"_blank\">Find Out More!</a></div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-lg-3 col-md-6 col-xl mb-4\">\r\n<div class=\"card h-100\" style=\"width:15rem\"><img alt=\"\" class=\"card-img-top img-fluid\" src=\"https://www.webspell-rm.de/includes/plugins/pic_update/images/176.jpg\" />\r\n<div class=\"card-body\">\r\n<h4>Startpage</h4>\r\n\r\n</div>\r\n\r\n<div class=\"card-footer\"><a class=\"btn btn-primary\" href=\"/admin/admincenter.php?site=settings_startpage\" target=\"_blank\">Find Out More!</a></div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-lg-3 col-md-6 col-xl mb-4\">\r\n<div class=\"card h-100\" style=\"width:15rem\"><img alt=\"\" class=\"card-img-top img-fluid\" src=\"https://www.webspell-rm.de/includes/plugins/pic_update/images/177.jpg\" />\r\n<div class=\"card-body\">\r\n<h4>Webspell-RM</h4>\r\n\r\n</div>\r\n\r\n<div class=\"card-footer\"><a class=\"btn btn-primary\" href=\"https://www.webspell-rm.de/forum.html\" target=\"_blank\">Support</a> <a class=\"btn btn-primary\" href=\"https://www.webspell-rm.de/wiki.html\" target=\"_blank\">WIKI</a></div>\r\n</div>\r\n</div>\r\n</div>\r\n<!-- /.row --><!-- /.container -->\r\n\r\n<p>{[it]}</p>\r\n\r\n<p><strong><u>Che cos&#39;&Atilde;&uml; Webspell RM? </u> </strong><br />\r\n<br />\r\nWebspell RM &Atilde;&uml; un Clan &amp; amp; Gamer CMS (Content Management System). &Atilde;&circ; basato su PHP, MySQL e l&#39;ultima versione di webSPELL.org GitHub (4.3.0). Webspell RM funziona con la General Public License. Vedi anche il contratto di licenza <a href=\"http://wiki.webspell-rm.de/index.php?site=static&amp;staticID=4\" target=\"_blank\"> contratto di licenza </a>.</p>\r\n\r\n<p style=\"text-align:center\"><a class=\"btn btn-info\" href=\"http://demo.webspell-rm.de/\" rel=\"noopener\" role=\"button\" target=\"_blank\"><strong><u>DEMO WEBSPELL RM </u> </strong> </a> <a class=\"btn btn-success\" href=\"https://webspell-rm.de/index. php? site = forum \" rel=\" noopener \" role=\" button \" target=\" _ blank \"> <strong> <u> SUPPORTO RM WEBSPELL </u> </strong> </a></p>\r\n\r\n<p><strong><u>Cosa fa Webspell | Offerta RM? </u> </strong><br />\r\n<br />\r\nWebspell RM &Atilde;&uml; basato su bootstrap ed &Atilde;&uml; facile da personalizzare tramite dashboard. Teoricamente, possono essere utilizzati tutti i modelli di bootstrap. Come editor usiamo CKEditor. Il CMS &Atilde;&uml; multilingue e viene fornito con molte lingue native. Il popolare reCAPTCHA &Atilde;&uml; stato integrato come protezione antispam. Tutti i plugin sono facili da installare tramite Webspell RM Installer.</p>\r\n<!-- Page Features -->\r\n\r\n<div class=\"row text-center\">\r\n<div class=\"col-lg-3 col-md-6 col-xl mb-4\">\r\n<div class=\"card h-100\" style=\"width:15rem\"><img alt=\"\" class=\"card-img-top img-fluid\" src=\"https://www.webspell-rm.de/includes/plugins/pic_update/images/173.jpg\" />\r\n<div class=\"card-body\">\r\n<h4>Webside</h4>\r\n\r\n</div>\r\n\r\n<div class=\"card-footer\"><a class=\"btn btn-primary\" href=\"#\">Find Out More!</a></div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-lg-3 col-md-6 col-xl mb-4\">\r\n<div class=\"card h-100\" style=\"width:15rem\"><img alt=\"\" class=\"card-img-top\" src=\"https://www.webspell-rm.de//includes/plugins/pic_update/images/170.jpg\" />\r\n<div class=\"card-body\">\r\n<h4>Dashboard</h4>\r\n\r\n</div>\r\n\r\n<div class=\"card-footer\"><a class=\"btn btn-primary\" href=\"/admin/admincenter.php\" target=\"_blank\">Find Out More!</a></div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-lg-3 col-md-6 col-xl mb-4\">\r\n<div class=\"card h-100\" style=\"width:15rem\"><img alt=\"\" class=\"card-img-top img-fluid\" src=\"https://www.webspell-rm.de/includes/plugins/pic_update/images/171.jpg\" />\r\n<div class=\"card-body\">\r\n<h4>Layout</h4>\r\n\r\n</div>\r\n\r\n<div class=\"card-footer\"><a class=\"btn btn-primary\" href=\"/admin/admincenter.php?site=settings_templates\" target=\"_blank\">Find Out More!</a></div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-lg-3 col-md-6 col-xl mb-4\">\r\n<div class=\"card h-100\" style=\"width:15rem\"><img alt=\"\" class=\"card-img-top img-fluid\" src=\"https://www.webspell-rm.de/includes/plugins/pic_update/images/172.jpg\" />\r\n<div class=\"card-body\">\r\n<h4>Plugin-Installer</h4>\r\n\r\n</div>\r\n\r\n<div class=\"card-footer\"><a class=\"btn btn-primary\" href=\"/admin/admincenter.php?site=plugin-installer\" target=\"_blank\">Find Out More!</a></div>\r\n</div>\r\n</div>\r\n<!-- zweite Reihe -->\r\n\r\n<div class=\"col-lg-3 col-md-6 col-xl mb-4\">\r\n<div class=\"card h-100\" style=\"width:15rem\"><img alt=\"\" class=\"card-img-top img-fluid\" src=\"https://www.webspell-rm.de/includes/plugins/pic_update/images/174.jpg\" />\r\n<div class=\"card-body\">\r\n<h4>Theme-Installer</h4>\r\n\r\n</div>\r\n\r\n<div class=\"card-footer\"><a class=\"btn btn-primary\" href=\"/admin/admincenter.php?site=template-installer\" target=\"_blank\">Find Out More!</a></div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-lg-3 col-md-6 col-xl mb-4\">\r\n<div class=\"card h-100\" style=\"width:15rem\"><img alt=\"\" class=\"card-img-top img-fluid\" src=\"https://www.webspell-rm.de/includes/plugins/pic_update/images/175.jpg\" />\r\n<div class=\"card-body\">\r\n<h4>Updater</h4>\r\n\r\n</div>\r\n\r\n<div class=\"card-footer\"><a class=\"btn btn-primary\" href=\"/admin/admincenter.php?site=update\" target=\"_blank\">Find Out More!</a></div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-lg-3 col-md-6 col-xl mb-4\">\r\n<div class=\"card h-100\" style=\"width:15rem\"><img alt=\"\" class=\"card-img-top img-fluid\" src=\"https://www.webspell-rm.de/includes/plugins/pic_update/images/176.jpg\" />\r\n<div class=\"card-body\">\r\n<h4>Startpage</h4>\r\n\r\n</div>\r\n\r\n<div class=\"card-footer\"><a class=\"btn btn-primary\" href=\"/admin/admincenter.php?site=settings_startpage\" target=\"_blank\">Find Out More!</a></div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-lg-3 col-md-6 col-xl mb-4\">\r\n<div class=\"card h-100\" style=\"width:15rem\"><img alt=\"\" class=\"card-img-top img-fluid\" src=\"https://www.webspell-rm.de/includes/plugins/pic_update/images/177.jpg\" />\r\n<div class=\"card-body\">\r\n<h4>Webspell-RM</h4>\r\n\r\n</div>\r\n\r\n<div class=\"card-footer\"><a class=\"btn btn-primary\" href=\"https://www.webspell-rm.de/forum.html\" target=\"_blank\">Support</a> <a class=\"btn btn-primary\" href=\"https://www.webspell-rm.de/wiki.html\" target=\"_blank\">WIKI</a></div>\r\n</div>\r\n</div>\r\n</div>\r\n<!-- /.row --><!-- /.container -->', 1616526018)");

$transaction->addQuery("DROP TABLE IF EXISTS `".PREFIX."settings_static`");
$transaction->addQuery("CREATE TABLE IF NOT EXISTS `".PREFIX."settings_static` (
  `staticID` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `accesslevel` int(1) NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`staticID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");


$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "settings_themes`");
    $transaction->addQuery("CREATE TABLE `" . PREFIX . "settings_themes` (
  `themeID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `modulname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `active` int(11) DEFAULT NULL,
  `version` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `nav1` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `nav2` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `nav3` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `nav4` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `nav5` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `nav6` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `nav7` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `nav8` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `nav9` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `nav10` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `body1` text COLLATE utf8_unicode_ci NOT NULL,
  `body2` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `body3` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `body4` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `typo1` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `typo2` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `typo3` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `typo4` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `typo5` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `typo6` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `typo7` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `typo8` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `card1` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `card2` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `foot1` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `foot2` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `foot3` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `foot4` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `foot5` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `foot6` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button1` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button2` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button3` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button4` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button5` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button6` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button7` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button8` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button9` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button10` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button11` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button12` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button13` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button14` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button15` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button16` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button17` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button18` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button19` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button20` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button21` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button22` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button23` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button24` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button25` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button26` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button27` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button28` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button29` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button30` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button31` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button32` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button33` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button34` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button35` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button36` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button37` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button38` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button39` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button40` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button41` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button42` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button43` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button44` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `button45` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `calendar1` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `calendar2` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `carousel1` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `carousel2` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `carousel3` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `carousel4` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `sort` int(11) NOT NULL DEFAULT '0',
PRIMARY KEY  (`themeID`)
) AUTO_INCREMENT=2
  DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");


$transaction->addQuery("INSERT IGNORE INTO `" . PREFIX . "settings_themes` (`themeID`, `name`, `modulname`, `active`, `version`, `nav1`, `nav2`, `nav3`, `nav4`, `nav5`, `nav6`, `nav7`, `nav8`, `nav9`, `nav10`, `body1`, `body2`, `body3`, `body4`, `typo1`, `typo2`, `typo3`, `typo4`, `typo5`, `typo6`, `typo7`, `typo8`, `card1`, `card2`, `foot1`, `foot2`, `foot3`, `foot4`, `foot5`, `foot6`, `button1`, `button2`, `button3`, `button4`, `button5`, `button6`, `button7`, `button8`, `button9`, `button10`, `button11`, `button12`, `button13`, `button14`, `button15`, `button16`, `button17`, `button18`, `button19`, `button20`, `button21`, `button22`, `button23`, `button24`, `button25`, `button26`, `button27`, `button28`, `button29`, `button30`, `button31`, `button32`, `button33`, `button34`, `button35`, `button36`, `button37`, `button38`, `button39`, `button40`, `button41`, `button42`, `button43`, `button44`, `button45`, `calendar1`, `calendar2`, `carousel1`, `carousel2`, `carousel3`, `carousel4`, `sort`) VALUES
(1, 'default', 'default', 1, '1.5', '#1e1e1e', '16px', '#dddddd', '#fe821d', '#fe821d', '5px', '#dddddd', '#fe821d', '', '', '\'Roboto\', sans-serif', '13px', '#f0efef', '#555555', '#e3e3e3', '#555555', '#555555', '#c45901', '13px', '#908e8e', '1px', '#863d01', '#bababa', '#ffffff', '#bababa', '#dddddd', '#555555', '#908e8e', '#1e1e1e', '#333333', '#fe821d', '#c45901', '#ffffff', '#908e8e', '#c45901', '#6c757d', '#5a6268', '#ffffff', '#908e8e', '#545b62', '#28a745', '#218838', '#ffffff', '#908e8e', '#1e7e34', '#dc3545', '#c82333', '#ffffff', '#908e8e', '#bd2130', '#ffc107', '#e0a800', '#212529', '#908e8e', '#d39e00', '#17a2b8', '#138496', '#ffffff', '#908e8e', '#117a8b', '#f8f9fa', '#e2e6ea', '#212529', '#908e8e', '#dae0e5', '#343a40', '#23272b', '#ffffff', '#908e8e', '#1d2124', '#007bff', '#0056b3', '#ffffff', '#ffffff', '#ffffff', '#d0d0d0', '#9d9b9b', '#aaaaaa', '#fe821d', '#aaaaaa', '#fe821d', 1)");


$transaction->addQuery("DROP TABLE IF EXISTS `".PREFIX."squads`");
$transaction->addQuery("CREATE TABLE IF NOT EXISTS `".PREFIX."squads` (
  `squadID` int(11) NOT NULL AUTO_INCREMENT,
  `gamesquad` int(11) NOT NULL DEFAULT '1',
  `games` text COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `icon` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `icon_small` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `info` text COLLATE utf8_unicode_ci NOT NULL,
  `sort` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`squadID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");

$transaction->addQuery("DROP TABLE IF EXISTS `".PREFIX."squads_members`");
$transaction->addQuery("CREATE TABLE IF NOT EXISTS `".PREFIX."squads_members` (
  `sqmID` int(11) NOT NULL AUTO_INCREMENT,
  `squadID` int(11) NOT NULL DEFAULT '0',
  `userID` int(11) NOT NULL DEFAULT '0',
  `position` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `activity` int(1) NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '0',
  `joinmember` int(1) NOT NULL DEFAULT '0',
  `warmember` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`sqmID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");

$transaction->addQuery("DROP TABLE IF EXISTS `".PREFIX."tags`");
$transaction->addQuery("CREATE TABLE IF NOT EXISTS `".PREFIX."tags` (
  `rel` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ID` int(11) NOT NULL,
  `tag` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");

$transaction->addQuery("DROP TABLE IF EXISTS `".PREFIX."user`");
$transaction->addQuery("CREATE TABLE IF NOT EXISTS `".PREFIX."user` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `registerdate` int(14) NOT NULL DEFAULT '0',
  `lastlogin` int(14) NOT NULL DEFAULT '0',
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `password_pepper` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `nickname` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `email_hide` int(1) NOT NULL DEFAULT '1',
  `email_change` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_activate` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `lastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `sex` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'u',
  `town` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `birthday` date NOT NULL,
  `facebook` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `twitter` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `twitch` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `steam` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `instagram` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `youtube` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `icq` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `avatar` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `usertext` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `userpic` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `homepage` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `about` text COLLATE utf8_unicode_ci NOT NULL,
  `pmgot` int(11) NOT NULL DEFAULT '0',
  `pmsent` int(11) NOT NULL DEFAULT '0',
  `visits` int(11) NOT NULL DEFAULT '0',
  `banned` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ban_reason` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `topics` text COLLATE utf8_unicode_ci NOT NULL,
  `articles` text COLLATE utf8_unicode_ci NOT NULL,
  `demos` text COLLATE utf8_unicode_ci NOT NULL,
  `files` text COLLATE utf8_unicode_ci NOT NULL,
  `gallery_pictures` text COLLATE utf8_unicode_ci NOT NULL,
  `special_rank` int(11) DEFAULT '0',
  `mailonpm` int(1) NOT NULL DEFAULT '0',
  `userdescription` text COLLATE utf8_unicode_ci NOT NULL,
  `activated` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `language` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `date_format` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'd.m.Y',
  `time_format` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'H:i',
  `newsletter` int(1) DEFAULT '1',
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");


$transaction->addQuery("INSERT INTO `".PREFIX."user` (`userID`, `registerdate`, `lastlogin`, `password`, `password_hash`, `password_pepper`, `nickname`, `email`, `email_hide`, `email_change`, `email_activate`, `firstname`, `lastname`, `sex`, `town`, `birthday`, `facebook`, `twitter`, `twitch`, `steam`, `instagram`, `youtube`, `icq`, `avatar`, `usertext`, `userpic`, `homepage`, `about`, `pmgot`, `pmsent`, `visits`, `banned`, `ban_reason`, `ip`, `topics`, `articles`, `demos`, `files`, `gallery_pictures`, `special_rank`, `mailonpm`, `userdescription`, `activated`, `language`, `date_format`, `time_format`, `newsletter`) VALUES
(1, '".time()."', '".time()."', '', '".$adminhash."', '".$new_pepper."', '".$adminname."', '".$adminmail."', 1, '', '', '', '', 'u', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, NULL, '', '', '', '', '', '', '', 0, 0, '', '1', '', 'd.m.Y', 'H:i', 1)");

$transaction->addQuery("DROP TABLE IF EXISTS `".PREFIX."user_forum_groups`");
$transaction->addQuery("CREATE TABLE IF NOT EXISTS `".PREFIX."user_forum_groups` (
  `usfgID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL DEFAULT '0',
  `1` int(1) NOT NULL,
  PRIMARY KEY (`usfgID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");

$transaction->addQuery("INSERT INTO `".PREFIX."user_forum_groups` (`usfgID`, `userID`, `1`) VALUES
(1, 1, 1)");

$transaction->addQuery("DROP TABLE IF EXISTS `".PREFIX."user_groups`");
$transaction->addQuery("CREATE TABLE IF NOT EXISTS `".PREFIX."user_groups` (
  `usgID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL DEFAULT '0',
  `news` int(1) NOT NULL DEFAULT '0',
  `news_writer` int(1) NOT NULL,
  `newsletter` int(1) NOT NULL DEFAULT '0',
  `polls` int(1) NOT NULL DEFAULT '0',
  `forum` int(1) NOT NULL DEFAULT '0',
  `moderator` int(1) NOT NULL DEFAULT '0',
  `clanwars` int(1) NOT NULL DEFAULT '0',
  `feedback` int(1) NOT NULL DEFAULT '0',
  `user` int(1) NOT NULL DEFAULT '0',
  `page` int(1) NOT NULL DEFAULT '0',
  `files` int(1) NOT NULL DEFAULT '0',
  `cash` int(1) NOT NULL DEFAULT '0',
  `gallery` int(1) NOT NULL,
  `super` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`usgID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");

$transaction->addQuery("INSERT INTO `".PREFIX."user_groups` (`usgID`, `userID`, `news`, `news_writer`, `newsletter`, `polls`, `forum`, `moderator`, `clanwars`, `feedback`, `user`, `page`, `files`, `cash`, `gallery`, `super`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1)");

$transaction->addQuery("DROP TABLE IF EXISTS `".PREFIX."user_visitors`");
$transaction->addQuery("CREATE TABLE IF NOT EXISTS `".PREFIX."user_visitors` (
  `visitID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL DEFAULT '0',
  `visitor` int(11) NOT NULL DEFAULT '0',
  `date` int(14) NOT NULL DEFAULT '0',
  PRIMARY KEY (`visitID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");

$transaction->addQuery("DROP TABLE IF EXISTS `".PREFIX."whoisonline`");
$transaction->addQuery("CREATE TABLE IF NOT EXISTS `".PREFIX."whoisonline` (
  `time` int(14) NOT NULL DEFAULT '0',
  `ip` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `userID` int(11) NOT NULL DEFAULT '0',
  `site` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");

$transaction->addQuery("DROP TABLE IF EXISTS `".PREFIX."whowasonline`");
$transaction->addQuery("CREATE TABLE IF NOT EXISTS `".PREFIX."whowasonline` (
  `time` int(14) NOT NULL DEFAULT '0',
  `ip` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `userID` int(11) NOT NULL DEFAULT '0',
  `site` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");


$transaction->addQuery("DROP TABLE IF EXISTS ".PREFIX ."modrewrite");
$transaction->addQuery("CREATE TABLE ".PREFIX ."modrewrite (
  ruleID int(11) NOT NULL,
  regex text COLLATE utf8_unicode_ci NOT NULL,
  link text COLLATE utf8_unicode_ci NOT NULL,
  fields text COLLATE utf8_unicode_ci NOT NULL,
  replace_regex text COLLATE utf8_unicode_ci NOT NULL,
  replace_result text COLLATE utf8_unicode_ci NOT NULL,
  rebuild_regex text COLLATE utf8_unicode_ci NOT NULL,
  rebuild_result text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");

$transaction->addQuery("ALTER TABLE ".PREFIX."modrewrite
  ADD PRIMARY KEY (ruleID)");

$transaction->addQuery("ALTER TABLE ".PREFIX."modrewrite
  MODIFY ruleID int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87");


$transaction->addQuery("INSERT INTO `".PREFIX."modrewrite` (`ruleID`, `regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES
(1, 'about.html', 'index.php?site=about_us', 'a:0:{}', 'index\\.php\\?site=about_us', 'about.html', 'about\\.html', 'index.php?site=about_us'),
(2, 'clan_rules.html', 'index.php?site=clan_rules', 'a:0:{}', 'index\\.php\\?site=clan_rules', 'clan_rules.html', 'clan_rules\\.html', 'index.php?site=clan_rules'),
(3, 'clanwars.html', 'index.php?site=clanwars', 'a:0:{}', 'index\\.php\\?site=clanwars', 'clanwars.html', 'clanwars\\.html', 'index.php?site=clanwars'),
(4, 'contact.html', 'index.php?site=contact', 'a:0:{}', 'index\\.php\\?site=contact', 'contact.html', 'contact\\.html', 'index.php?site=contact'),
(5, 'counter.html', 'index.php?site=counter', 'a:0:{}', 'index\\.php\\?site=counter', 'counter.html', 'counter\\.html', 'index.php?site=counter'),
(6, 'discord.html', 'index.php?site=discord', 'a:0:{}', 'index\\.php\\?site=discord', 'discord.html', 'discord\\.html', 'index.php?site=discord'),
(7, 'faq.html', 'index.php?site=faq', 'a:0:{}', 'index\\.php\\?site=faq', 'faq.html', 'faq\\.html', 'index.php?site=faq'),
(8, 'faq/{catID}.html', 'index.php?site=faq&action=faqcat&faqcatID={catID}', 'a:1:{s:5:\"catID\";s:7:\"integer\";}', 'index\\.php\\?site=faq[&|&amp;]*action=faqcat[&|&amp;]*faqcatID=([0-9]+)', 'faq/$3.html', 'faq\\/([0-9]+?)\\.html', 'index.php?site=faq&action=faqcat&faqcatID=$1'),
(9, 'faq/{catID}/{faqID}.html', 'index.php?site=faq&action=faq&faqID={faqID}&faqcatID={catID}', 'a:2:{s:5:\"faqID\";s:7:\"integer\";s:5:\"catID\";s:7:\"integer\";}', 'index\\.php\\?site=faq[&|&amp;]*action=faq[&|&amp;]*faqID=([0-9]+)[&|&amp;]*faqcatID=([0-9]+)', 'faq/$4/$3.html', 'faq\\/([0-9]+?)\\/([0-9]+?)\\.html', 'index.php?site=faq&action=faq&faqID=$2&faqcatID=$1'),
(10, 'files.html', 'index.php?site=files', 'a:0:{}', 'index\\.php\\?site=files', 'files.html', 'files\\.html', 'index.php?site=files'),
(11, 'files/category/{catID}', 'index.php?site=files&cat={catID}', 'a:1:{s:5:\"catID\";s:7:\"integer\";}', 'index\\.php\\?site=files[&|&amp;]*cat=([0-9]+)', 'files/category/$3', 'files\\/category\\/([0-9]+?)', 'index.php?site=files&cat=$1'),
(12, 'files/file/{fileID}', 'index.php?site=files&file={fileID}', 'a:1:{s:6:\"fileID\";s:7:\"integer\";}', 'index\\.php\\?site=files[&|&amp;]*file=([0-9]+)', 'files/file/$3', 'files\\/file\\/([0-9]+?)', 'index.php?site=files&file=$1'),
(13, 'files/report/{fileID}', 'index.php?site=files&action=report&link={fileID}', 'a:1:{s:6:\"fileID\";s:7:\"integer\";}', 'index\\.php\\?site=files[&|&amp;]*action=report[&|&amp;]*link=([0-9]+)', 'files/report/$3', 'files\\/report\\/([0-9]+?)', 'index.php?site=files&action=report&link=$1'),
(14, 'forum.html', 'index.php?site=forum', 'a:0:{}', 'index\\.php\\?site=forum', 'forum.html', 'forum\\.html', 'index.php?site=forum'),
(15, 'forum/{action}/board/{board}.html', 'index.php?site=forum&board={board}&action={action}', 'a:2:{s:5:\"board\";s:7:\"integer\";s:6:\"action\";s:6:\"string\";}', 'index\\.php\\?site=forum[&|&amp;]*board=([0-9]+)[&|&amp;]*action=(\\w*?)', 'forum/$4/board/$3.html', 'forum\\/(\\w*?)\\/board\\/([0-9]+?)\\.html', 'index.php?site=forum&board=$2&action=$1'),
(16, 'forum/action.html', 'forum.php', 'a:0:{}', 'forum\\.php', 'forum/action.html', 'forum\\/action\\.html', 'forum.php'),
(17, 'forum/actions/markall.html', 'index.php?site=forum&action=markall', 'a:0:{}', 'index\\.php\\?site=forum[&|&amp;]*action=markall', 'forum/actions/markall.html', 'forum\\/actions\\/markall\\.html', 'index.php?site=forum&action=markall'),
(18, 'forum/board/{board}.html', 'index.php?site=forum&board={board}', 'a:1:{s:5:\"board\";s:7:\"integer\";}', 'index\\.php\\?site=forum[&|&amp;]*board=([0-9]+)', 'forum/board/$3.html', 'forum\\/board\\/([0-9]+?)\\.html', 'index.php?site=forum&board=$1'),
(19, 'forum/board/{board}/addtopic.html', 'index.php?site=forum&addtopic=true&board={board}', 'a:1:{s:5:\"board\";s:7:\"integer\";}', 'index\\.php\\?site=forum[&|&amp;]*addtopic=true[&|&amp;]*board=([0-9]+)', 'forum/board/$3/addtopic.html', 'forum\\/board\\/([0-9]+?)\\/addtopic\\.html', 'index.php?site=forum&addtopic=true&board=$1'),
(20, 'forum/cat/{cat}.html', 'index.php?site=forum&cat={cat}', 'a:1:{s:3:\"cat\";s:7:\"integer\";}', 'index\\.php\\?site=forum[&|&amp;]*cat=([0-9]+)', 'forum/cat/$3.html', 'forum\\/cat\\/([0-9]+?)\\.html', 'index.php?site=forum&cat=$1'),
(21, 'gallery.html', 'index.php?site=gallery', 'a:0:{}', 'index\\.php\\?site=gallery', 'gallery.html', 'gallery\\.html', 'index.php?site=gallery'),
(22, 'gallery/{gallerycatID}.html', 'index.php?site=gallery&action=show&gallerycatID={gallerycatID}', 'a:1:{s:12:\"gallerycatID\";s:7:\"integer\";}', 'index\\.php\\?site=gallery[&|&amp;]*action=show[&|&amp;]*gallerycatID=([0-9]+)', 'gallery/$3.html', 'gallery\\/([0-9]+?)\\.html', 'index.php?site=gallery&action=show&gallerycatID=$1'),
(23, 'history.html', 'index.php?site=history', 'a:0:{}', 'index\\.php\\?site=history', 'history.html', 'history\\.html', 'index.php?site=history'),
(24, 'imprint.html', 'index.php?site=imprint', 'a:0:{}', 'index\\.php\\?site=imprint', 'imprint.html', 'imprint\\.html', 'index.php?site=imprint'),
(25, 'joinus.html', 'index.php?site=joinus', 'a:0:{}', 'index\\.php\\?site=joinus', 'joinus.html', 'joinus\\.html', 'index.php?site=joinus'),
(26, 'joinus/save.html', 'index.php?site=joinus&action=save', 'a:0:{}', 'index\\.php\\?site=joinus[&|&amp;]*action=save', 'joinus/save.html', 'joinus\\/save\\.html', 'index.php?site=joinus&action=save'),
(27, 'links.html', 'index.php?site=links', 'a:0:{}', 'index\\.php\\?site=links', 'links.html', 'links\\.html', 'index.php?site=links'),
(28, 'links/category/{catID}.html', 'index.php?site=links&action=show&linkcatID={catID}', 'a:1:{s:5:\"catID\";s:7:\"integer\";}', 'index\\.php\\?site=links[&|&amp;]*action=show[&|&amp;]*linkcatID=([0-9]+)', 'links/category/$3.html', 'links\\/category\\/([0-9]+?)\\.html', 'index.php?site=links&action=show&linkcatID=$1'),
(29, 'linkus.html', 'index.php?site=linkus', 'a:0:{}', 'index\\.php\\?site=linkus', 'linkus.html', 'linkus\\.html', 'index.php?site=linkus'),
(30, 'login.html', 'index.php?site=login', 'a:0:{}', 'index\\.php\\?site=login', 'login.html', 'login\\.html', 'index.php?site=login'),
(31, 'logout.html', 'logout.php', 'a:0:{}', 'logout\\.php', 'logout.html', 'logout\\.html', 'logout.php'),
(32, 'lostpassword.html', 'index.php?site=lostpassword', 'a:0:{}', 'index\\.php\\?site=lostpassword', 'lostpassword.html', 'lostpassword\\.html', 'index.php?site=lostpassword'),
(33, 'members.html', 'index.php?site=members', 'a:0:{}', 'index\\.php\\?site=members', 'members.html', 'members\\.html', 'index.php?site=members'),
(34, 'members/{squadID}.html', 'index.php?site=members&action=show&squadID={squadID}', 'a:1:{s:7:\"squadID\";s:7:\"integer\";}', 'index\\.php\\?site=members[&|&amp;]*action=show[&|&amp;]*squadID=([0-9]+)', 'members/$3.html', 'members\\/([0-9]+?)\\.html', 'index.php?site=members&action=show&squadID=$1'),
(35, 'messenger.html', 'index.php?site=messenger', 'a:0:{}', 'index\\.php\\?site=messenger', 'messenger.html', 'messenger\\.html', 'index.php?site=messenger'),
(36, 'messenger/{messageID}/read.html', 'index.php?site=messenger&action=show&id={messageID}', 'a:1:{s:9:\"messageID\";s:7:\"integer\";}', 'index\\.php\\?site=messenger[&|&amp;]*action=show[&|&amp;]*id=([0-9]+)', 'messenger/$3/read.html', 'messenger\\/([0-9]+?)\\/read\\.html', 'index.php?site=messenger&action=show&id=$1'),
(37, 'messenger/{messageID}/reply.html', 'index.php?site=messenger&action=reply&id={messageID}', 'a:1:{s:9:\"messageID\";s:7:\"integer\";}', 'index\\.php\\?site=messenger[&|&amp;]*action=reply[&|&amp;]*id=([0-9]+)', 'messenger/$3/reply.html', 'messenger\\/([0-9]+?)\\/reply\\.html', 'index.php?site=messenger&action=reply&id=$1'),
(38, 'messenger/action.html', 'messenger.php', 'a:0:{}', 'messenger\\.php', 'messenger/action.html', 'messenger\\/action\\.html', 'messenger.php'),
(39, 'messenger/incoming.html', 'index.php?site=messenger&action=incoming', 'a:0:{}', 'index\\.php\\?site=messenger[&|&amp;]*action=incoming', 'messenger/incoming.html', 'messenger\\/incoming\\.html', 'index.php?site=messenger&action=incoming'),
(40, 'messenger/new.html', 'index.php?site=messenger&action=newmessage', 'a:0:{}', 'index\\.php\\?site=messenger[&|&amp;]*action=newmessage', 'messenger/new.html', 'messenger\\/new\\.html', 'index.php?site=messenger&action=newmessage'),
(41, 'messenger/outgoing.html', 'index.php?site=messenger&action=outgoing', 'a:0:{}', 'index\\.php\\?site=messenger[&|&amp;]*action=outgoing', 'messenger/outgoing.html', 'messenger\\/outgoing\\.html', 'index.php?site=messenger&action=outgoing'),
(42, 'news.html', 'index.php?site=news', 'a:0:{}', 'index\\.php\\?site=news', 'news.html', 'news\\.html', 'index.php?site=news'),
(43, 'news_contents/{newsID}.html', 'index.php?site=news&action=news_contents&newsID={newsID}', 'a:1:{s:6:\"newsID\";s:7:\"integer\";}', 'index\\.php\\?site=news[&|&amp;]*action=news_contents[&|&amp;]*newsID=([0-9]+)', 'news_contents/$3.html', 'news_contents\\/([0-9]+?)\\.html', 'index.php?site=news&action=news_contents&newsID=$1'),
(44, 'news/archive.html', 'index.php?site=news_archive', 'a:0:{}', 'index\\.php\\?site=news_archive', 'news/archive.html', 'news\\/archive\\.html', 'index.php?site=news_archive'),
(45, 'portfolio.html', 'index.php?site=portfolio', 'a:0:{}', 'index\\.php\\?site=portfolio', 'portfolio.html', 'portfolio\\.html', 'index.php?site=portfolio'),
(46, 'privacy_policy.html', 'index.php?site=privacy_policy', 'a:0:{}', 'index\\.php\\?site=privacy_policy', 'privacy_policy.html', 'privacy_policy\\.html', 'index.php?site=privacy_policy'),
(47, 'profile/{action}/{id}.html', 'index.php?site=profile&id={id}&action={action}', 'a:2:{s:2:\"id\";s:7:\"integer\";s:6:\"action\";s:6:\"string\";}', 'index\\.php\\?site=profile[&|&amp;]*id=([0-9]+)[&|&amp;]*action=(\\w*?)', 'profile/$4/$3.html', 'profile\\/(\\w*?)\\/([0-9]+?)\\.html', 'index.php?site=profile&id=$2&action=$1'),
(48, 'profile/{action}/{id}.html', 'index.php?site=profile&action={action}&id={id}', 'a:2:{s:2:\"id\";s:7:\"integer\";s:6:\"action\";s:6:\"string\";}', 'index\\.php\\?site=profile[&|&amp;]*action=(\\w*?)[&|&amp;]*id=([0-9]+)', 'profile/$3/$4.html', 'profile\\/(\\w*?)\\/([0-9]+?)\\.html', 'index.php?site=profile&action=$1&id=$2'),
(49, 'profile/{id}.html', 'index.php?site=profile&id={id}', 'a:1:{s:2:\"id\";s:7:\"integer\";}', 'index\\.php\\?site=profile[&|&amp;]*id=([0-9]+)', 'profile/$3.html', 'profile\\/([0-9]+?)\\.html', 'index.php?site=profile&id=$1'),
(50, 'profile/edit.html', 'index.php?site=myprofile', 'a:0:{}', 'index\\.php\\?site=myprofile', 'profile/edit.html', 'profile\\/edit\\.html', 'index.php?site=myprofile'),
(51, 'profile/mail.html', 'index.php?site=myprofile&action=editmail', 'a:0:{}', 'index\\.php\\?site=myprofile[&|&amp;]*action=editmail', 'profile/mail.html', 'profile\\/mail\\.html', 'index.php?site=myprofile&action=editmail'),
(52, 'profile/password.html', 'index.php?site=myprofile&action=editpwd', 'a:0:{}', 'index\\.php\\?site=myprofile[&|&amp;]*action=editpwd', 'profile/password.html', 'profile\\/password\\.html', 'index.php?site=myprofile&action=editpwd'),
(53, 'register.html', 'index.php?site=register', 'a:0:{}', 'index\\.php\\?site=register', 'register.html', 'register\\.html', 'index.php?site=register'),
(54, 'search.html', 'index.php?site=search', 'a:0:{}', 'index\\.php\\?site=search', 'search.html', 'search\\.html', 'index.php?site=search'),
(55, 'search/results.html', 'index.php?site=search&action=search', 'a:0:{}', 'index\\.php\\?site=search[&|&amp;]*action=search', 'search/results.html', 'search\\/results\\.html', 'index.php?site=search&action=search'),
(56, 'search/submit.html', 'search.php', 'a:0:{}', 'search\\.php', 'search/submit.html', 'search\\/submit\\.html', 'search.php'),
(57, 'server_rules.html', 'index.php?site=server_rules', 'a:0:{}', 'index\\.php\\?site=server_rules', 'server_rules.html', 'server_rules\\.html', 'index.php?site=server_rules'),
(58, 'server.html', 'index.php?site=servers', 'a:0:{}', 'index\\.php\\?site=servers', 'server.html', 'server\\.html', 'index.php?site=servers'),
(59, 'sponsors.html', 'index.php?site=sponsors', 'a:0:{}', 'index\\.php\\?site=sponsors', 'sponsors.html', 'sponsors\\.html', 'index.php?site=sponsors'),
(60, 'squads.html', 'index.php?site=squads', 'a:0:{}', 'index\\.php\\?site=squads', 'squads.html', 'squads\\.html', 'index.php?site=squads'),
(61, 'squads/{squadID}.html', 'index.php?site=squads&action=show&squadID={squadID}', 'a:1:{s:7:\"squadID\";s:7:\"integer\";}', 'index\\.php\\?site=squads[&|&amp;]*action=show[&|&amp;]*squadID=([0-9]+)', 'squads/$3.html', 'squads\\/([0-9]+?)\\.html', 'index.php?site=squads&action=show&squadID=$1'),
(62, 'static/{staticID}.html', 'index.php?site=static&staticID={staticID}', 'a:1:{s:8:\"staticID\";s:7:\"integer\";}', 'index\\.php\\?site=static[&|&amp;]*staticID=([0-9]+)', 'static/$3.html', 'static\\/([0-9]+?)\\.html', 'index.php?site=static&staticID=$1'),
(63, 'todo.html', 'index.php?site=todo', 'a:0:{}', 'index\\.php\\?site=todo', 'todo.html', 'todo\\.html', 'index.php?site=todo'),
(64, 'twitter.html', 'index.php?site=twitter', 'a:0:{}', 'index\\.php\\?site=twitter', 'twitter.html', 'twitter\\.html', 'index.php?site=twitter'),
(65, 'userlist.html', 'index.php?site=userlist', 'a:0:{}', 'index\\.php\\?site=userlist', 'userlist.html', 'userlist\\.html', 'index.php?site=userlist'),
(66, 'videos.html', 'index.php?site=videos', 'a:0:{}', 'index\\.php\\?site=videos', 'videos.html', 'videos\\.html', 'index.php?site=videos'),
(67, 'videos/{videosID}.html', 'index.php?site=videos&action=watch&videosID={videosID}', 'a:1:{s:8:\"videosID\";s:7:\"integer\";}', 'index\\.php\\?site=videos[&|&amp;]*action=watch[&|&amp;]*videosID=([0-9]+)', 'videos/$3.html', 'videos\\/([0-9]+?)\\.html', 'index.php?site=videos&action=watch&videosID=$1'),
(68, 'whoisonline.html', 'index.php?site=whoisonline', 'a:0:{}', 'index\\.php\\?site=whoisonline', 'whoisonline.html', 'whoisonline\\.html', 'index.php?site=whoisonline'),
(69, 'whoisonline.html#was', 'index.php?site=whoisonline#was', 'a:0:{}', 'index\\.php\\?site=whoisonline#was', 'whoisonline.html#was', 'whoisonline\\.html#was', 'index.php?site=whoisonline#was'),
(70, 'whoisonline/{sort}/{type}.html', 'index.php?site=whoisonline&sort={sort}&type={type}', 'a:2:{s:4:\"sort\";s:6:\"string\";s:4:\"type\";s:6:\"string\";}', 'index\\.php\\?site=whoisonline[&|&amp;]*sort=(\\w*?)[&|&amp;]*type=(\\w*?)', 'whoisonline/$3/$4.html', 'whoisonline\\/(\\w*?)\\/(\\w*?)\\.html', 'index.php?site=whoisonline&sort=$1&type=$2'),
(71, 'forum/topic/{topicID}.html', 'index.php?site=forum_topic&topic={topicID}', 'a:1:{s:7:\"topicID\";s:7:\"integer\";}', 'index\\.php\\?site=forum_topic[&|&amp;]*topic=([0-9]+)', 'forum/topic/$3.html', 'forum\\/topic\\/([0-9]+?)\\.html', 'index.php?site=forum_topic&topic=$1'),
(72, 'myprofile/deleteaccount.html', 'index.php?site=myprofile&action=deleteaccount', 'a:0:{}', 'index\\.php\\?site=myprofile[&|&amp;]*action=deleteaccount', 'myprofile/deleteaccount.html', 'myprofile\\/deleteaccount\\.html', 'index.php?site=myprofile&action=deleteaccount'),
(78, 'news/{page}.html', 'index.php?site=news&page={page}', 'a:1:{s:4:\"page\";s:7:\"integer\";}', 'index\\.php\\?site=news[&|&amp;]*page=([0-9]+)', 'news/$3.html', 'news\\/([0-9]+?)\\.html', 'index.php?site=news&page=$1'),
(79, 'shoutbox.html', 'index.php?site=shoutbox_content&action=showall', 'a:0:{}', 'index\\.php\\?site=shoutbox_content[&|&amp;]*action=showall', 'shoutbox.html', 'shoutbox\\.html', 'index.php?site=shoutbox_content&action=showall'),
(74, 'partners.html', 'index.php?site=partners', 'a:0:{}', 'index\\.php\\?site=partners', 'partners.html', 'partners\\.html', 'index.php?site=partners'),
(75, 'streams.html', 'index.php?site=streams', 'a:0:{}', 'index\\.php\\?site=streams', 'streams.html', 'streams\\.html', 'index.php?site=streams'),
(81, 'streams/{streamID}.html', 'index.php?site=streams&id={streamID}', 'a:1:{s:8:\"streamID\";s:7:\"integer\";}', 'index\\.php\\?site=streams[&|&amp;]*id=([0-9]+)', 'streams/$3.html', 'streams\\/([0-9]+?)\\.html', 'index.php?site=streams&id=$1'),
(77, 'forum_topic/{topicID}/{type}/{page}.html', 'index.php?site=forum_topic&topic={topicID}&type={type}&page={page}', 'a:3:{s:7:\"topicID\";s:6:\"string\";s:4:\"type\";s:6:\"string\";s:4:\"page\";s:7:\"integer\";}', 'index\\.php\\?site=forum_topic[&|&amp;]*topic=(\\w*?)[&|&amp;]*type=(\\w*?)[&|&amp;]*page=([0-9]+)', 'forum_topic/$3/$4/$5.html', 'forum_topic\\/(\\w*?)\\/(\\w*?)\\/([0-9]+?)\\.html', 'index.php?site=forum_topic&topic=$1&type=$2&page=$3'),
(80, 'calendar.html', 'index.php?site=calendar', 'a:0:{}', 'index\\.php\\?site=calendar', 'calendar.html', 'calendar\\.html', 'index.php?site=calendar'),
(82, 'shoutbox.html', 'index.php?site=shoutbox_content', 'a:0:{}', 'index\\.php\\?site=shoutbox_content', 'shoutbox.html', 'shoutbox\\.html', 'index.php?site=shoutbox_content'),
(83, 'candidature.html', 'index.php?site=candidature', 'a:0:{}', 'index\\.php\\?site=candidature', 'candidature.html', 'candidature\\.html', 'index.php?site=candidature'),
(84, 'candidature/new.html', 'index.php?site=candidature&action=new', 'a:0:{}', 'index\\.php\\?site=candidature[&|&amp;]*action=new', 'candidature/new.html', 'candidature\\/new\\.html', 'index.php?site=candidature&action=new'),
(85, 'loginoverview.html', 'index.php?site=loginoverview', 'a:0:{}', 'index\\.php\\?site=loginoverview', 'loginoverview.html', 'loginoverview\\.html', 'index.php?site=loginoverview'),
(86, 'guestbook.html', 'index.php?site=guestbook', 'a:0:{}', 'index\\.php\\?site=guestbook', 'guestbook.html', 'guestbook\\.html', 'index.php?site=guestbook'),
(87, 'news_contents/{newsID}.html', 'index.php?site=news_contents&newsID={newsID}', 'a:1:{s:6:\"newsID\";s:7:\"integer\";}', 'index\\.php\\?site=news_contents[&|&amp;]*newsID=([0-9]+)', 'news_contents/$3.html', 'news_contents\\/([0-9]+?)\\.html', 'index.php?site=news_contents&newsID=$1')");


$transaction->addQuery("DROP TABLE IF EXISTS `".PREFIX."nickname`");
$transaction->addQuery("CREATE TABLE IF NOT EXISTS `".PREFIX."nickname` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `nickname` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");




    if ($transaction->successful()) {
        return array('status' => 'success', 'message' => '- Install successful for Webspell RM 2.0');
    } else {
        return array('status' => 'fail', 'message' => '- Failed to install Webspell-RM 2.0<br/>' . $transaction->getError());
    }


}
function update_rm_1($_database) {
  global $adminname;
  $transaction = new Transaction($_database);



  if ($transaction->successful()) {
      return array('status' => 'success', 'message' => '- Webspell-Update 20.02.2021');
  } else {
      return array('status' => 'fail', 'message' => '-  Webspell-Update 20.02.2021<br/>' . $transaction->getError());
  }

}

?>