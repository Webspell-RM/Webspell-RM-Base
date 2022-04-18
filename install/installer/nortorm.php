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
#Update von NOR 1.2.5 auf RM
#==========================================#

function update_nor_rm209_1($_database)
{
    $transaction = new Transaction($_database);


$transaction->addQuery("ALTER TABLE `" . PREFIX . "about` RENAME TO `" . PREFIX ."plugins_about_us`");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "plugins_about_us` ADD aboutID int(11) AUTO_INCREMENT primary key NOT NULL");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "plugins_about_us` ADD title varchar(255) NOT NULL");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "plugins_about_us` CHANGE `about` `text` text NOT NULL");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "plugins_about_us` ADD aboutchars varchar(255) NOT NULL");


$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "api_log`"); #api_log entfernt
#$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "articles`"); #articles entfernt
$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "articles_contents`"); #articles_contents entfernt
$transaction->addQuery("ALTER TABLE `" . PREFIX . "articles` RENAME TO `" . PREFIX ."plugins_articles`");
#$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "awards`"); #awards entfernt
$transaction->addQuery("ALTER TABLE `" . PREFIX . "awards` RENAME TO `" . PREFIX ."plugins_awards`");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "plugins_awards` ADD steam varchar(255) NOT NULL");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "plugins_awards` ADD twitch varchar(255) NOT NULL");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "plugins_awards` ADD youtube varchar(255) NOT NULL");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "plugins_awards` ADD instagram varchar(255) NOT NULL");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "plugins_awards` ADD facebook varchar(255) NOT NULL");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "plugins_awards` ADD twitter varchar(255) NOT NULL");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "plugins_awards` ADD liga varchar(255) NOT NULL"); 
$transaction->addQuery("ALTER TABLE `" . PREFIX . "plugins_awards` ADD banner varchar(255) NOT NULL"); 
#banned_ips
#banner
$transaction->addQuery("ALTER TABLE `" . PREFIX . "bannerrotation` RENAME TO `" . PREFIX ."plugins_bannerrotation`");
$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "buddys`"); #buddys entfernt
#captcha
#$transaction->addQuery("ALTER TABLE `" . PREFIX . "carousel` RENAME TO `" . PREFIX ."plugins_carousel`");
#$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "cash_box`"); #cash_box entfernt
$transaction->addQuery("ALTER TABLE `" . PREFIX . "cash_box` RENAME TO `" . PREFIX ."plugins_cashbox`");
#$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "cash_box_payed`"); #cash_box_payed entfernt
$transaction->addQuery("ALTER TABLE `" . PREFIX . "cash_box_payed` RENAME TO `" . PREFIX ."plugins_cashbox_payed`");

$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "challenge`"); #challenge entfernt
$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "clanwars`"); #clanwars entfernt
$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "comments`"); #comments entfernt
$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "comments_spam`"); #comments_spam entfernt
#contact
#cookies
#counter
#counter_iplist
#counter_stats
$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "countries`"); #countries entfernt
$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "dashnavi_categories`"); #dashnavi_categories  // wird gelöscht und neu installiert
$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "dashnavi_links`"); #dashnavi_links  // wird gelöscht und neu installiert
$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "demos`"); #demos entfernt
#email
#failed_login_attempts
$transaction->addQuery("ALTER TABLE `" . PREFIX . "faq` RENAME TO `" . PREFIX ."plugins_faq`");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "faq_categories` RENAME TO `" . PREFIX ."plugins_faq_categories`");

$transaction->addQuery("ALTER TABLE `" . PREFIX . "files` RENAME TO `" . PREFIX ."plugins_files`");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "files_categorys` RENAME TO `" . PREFIX ."plugins_files_categories`");

$transaction->addQuery("ALTER TABLE `" . PREFIX . "forum_announcements` RENAME TO `" . PREFIX ."plugins_forum_announcements`");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "forum_boards` RENAME TO `" . PREFIX ."plugins_forum_boards`");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "forum_categories` RENAME TO `" . PREFIX ."plugins_forum_categories`");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "forum_groups` RENAME TO `" . PREFIX ."plugins_forum_groups`");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "forum_moderators` RENAME TO `" . PREFIX ."plugins_forum_moderators`");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "forum_notify` RENAME TO `" . PREFIX ."plugins_forum_notify`");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "forum_posts` RENAME TO `" . PREFIX ."plugins_forum_posts`");
#forum_posts_spam
$transaction->addQuery("ALTER TABLE `" . PREFIX . "forum_ranks` RENAME TO `" . PREFIX ."plugins_forum_ranks`");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "forum_topics` RENAME TO `" . PREFIX ."plugins_forum_topics`");
#forum_topics_spam
#$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "gallery`"); #gallery entfernt
#$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "gallery_groups`"); #gallery_groups entfernt
#$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "gallery_pictures`"); #gallery_pictures entfernt

#$transaction->addQuery("ALTER TABLE `" . PREFIX . "games` RENAME TO `" . PREFIX ."settings_games`");
$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "games`"); #games entfernt
$transaction->addQuery("ALTER TABLE `" . PREFIX . "guestbook` RENAME TO `" . PREFIX ."plugins_guestbook`");

$transaction->addQuery("ALTER TABLE `" . PREFIX . "history` RENAME TO `" . PREFIX ."plugins_history`");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "plugins_history` ADD title varchar(255) NOT NULL");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "plugins_history` CHANGE `history` `text` text NOT NULL");

$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "imprint`");

$transaction->addQuery("DROP TABLE IF EXISTS `".PREFIX."settings_imprint`");
$transaction->addQuery("CREATE TABLE IF NOT EXISTS `".PREFIX."settings_imprint` (
  `imprintID` int(11) NOT NULL AUTO_INCREMENT,
  `imprint` text COLLATE utf8_unicode_ci NOT NULL,
  `disclaimer_text` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`imprintID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");

$transaction->addQuery("INSERT INTO `" . PREFIX . "settings_imprint` (`imprintID`, `imprint`, `disclaimer_text`) VALUES
(1, '{[de]} Impressum in deutscher Sprache.<br /><span style=\"color:#c0392b\"><strong>Konfigurieren Sie bitte Ihr Impressum!</strong></span><br />{[en]} Imprint in English.<br /><span style=\"color:#c0392b\"><strong>Please configure your imprint!</strong></span>{[it]} Impronta Editoriale in Italianoh.<br /><span style=\"color:#c0392b\"><strong>Si prega di configurare l&rsquo;impronta!</strong></span>', '{[de]} Haftungsausschluss in deutscher Sprache.<br /><span style=\"color:#c0392b\"><strong>Konfigurieren Sie bitte Ihr Haftungsausschluss! </strong></span><br />{[en]} Disclaimer in English.<br /><span style=\"color:#c0392b\"><strong>Please configure your disclaimer!</strong></span>{[it]} Dichiarazione di non Responsabilità in Italiano.<br /><span style=\"color:#c0392b\"><strong>Si prega di configurare la Dichiarazione di non Responsabilità!</strong></span>')");

$transaction->addQuery("DROP TABLE IF EXISTS `".PREFIX."settings_privacy_policy`");
$transaction->addQuery("CREATE TABLE IF NOT EXISTS `".PREFIX."settings_privacy_policy` (
  `privacy_policyID` int(11) NOT NULL AUTO_INCREMENT,
  `date` int(14) NOT NULL,
  `privacy_policy_text` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`privacy_policyID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");

$transaction->addQuery("INSERT INTO `" . PREFIX . "settings_privacy_policy` (`privacy_policyID`, `date`, `privacy_policy_text`) VALUES
(1, 1576689811, '{[de]} Datenschutz-Bestimmungen in deutscher Sprache.<br /><span style=\"color:#c0392b\"><strong>Konfigurieren Sie bitte Ihre Datenschutz-Bestimmungen!</strong></span><br />{[en]} Privacy Policy in English.<br /><span style=\"color:#c0392b\"><strong>Please configure your Privacy Policy!</strong></span>{[it]} Informativa sulla privacy in Italiano.<br /><span style=\"color:#c0392b\"><strong>Si prega di configurare l&rsquo;Informativa sulla Privacy!</strong></span>')");



$transaction->addQuery("ALTER TABLE `" . PREFIX . "links` RENAME TO `" . PREFIX ."plugins_links`");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "links_categorys` RENAME TO `" . PREFIX ."plugins_links_categorys`");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "plugins_links_categorys` ADD description varchar(255) NOT NULL");

$transaction->addQuery("ALTER TABLE `" . PREFIX . "linkus` RENAME TO `" . PREFIX ."plugins_linkus`");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "plugins_linkus` ADD sort int(11) NOT NULL");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "plugins_linkus` ADD displayed VARCHAR( 255 ) NOT NULL");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "plugins_linkus` CHANGE `name` `title` VARCHAR( 255 ) NOT NULL");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "plugins_linkus` CHANGE `file` `banner_pic` VARCHAR( 255 ) NOT NULL");

$transaction->addQuery("ALTER TABLE `" . PREFIX . "messenger` RENAME TO `" . PREFIX ."plugins_messenger`");

#modrewrite // wird gelöscht und neu installiert
$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "navigation_main`"); #navigation_main // wird gelöscht und neu installiert

#$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "newsletter`"); #newsletter entfernt
$transaction->addQuery("ALTER TABLE `" . PREFIX . "newsletter` RENAME TO `" . PREFIX ."plugins_newsletter`");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "news_languages` RENAME TO `" . PREFIX ."settings_languages`");

##################### News ????????????

$transaction->addQuery("ALTER TABLE `" . PREFIX . "partners` RENAME TO `" . PREFIX ."plugins_partners`");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "plugins_partners` ADD facebook varchar(255) NOT NULL");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "plugins_partners` ADD twitter varchar(255) NOT NULL");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "plugins_partners` ADD info text NOT NULL");

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
  `hiddenfiles` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `version` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `widgetname1` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `widgetname2` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `widgetname3` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `widget_link1` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `widget_link2` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `widget_link3` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `modul_display` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pluginID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");

$transaction->addQuery("INSERT INTO `".PREFIX."plugins` (`pluginID`, `name`, `modulname`, `description`, `admin_file`, `activate`, `author`, `website`, `index_link`, `hiddenfiles`, `version`, `path`, `widgetname1`, `widgetname2`, `widgetname3`, `widget_link1`, `widget_link2`, `widget_link3`, `modul_display`) VALUES
(1, 'Navigation Default', 'navigation_default', '{[de]}Das ist die Standard-Navigation.{[en]}This is the standard navigation. ', '', 1, 'T-Seven', 'https://webspell-rm.de', '', '', '2.0.1', 'includes/plugins/navigation_default/', 'navigation_default', '', '', 'widget_navigation_default', '', '', 0)");

#$transaction->addQuery("ALTER TABLE `" . PREFIX . "plugins` DROP `sc_link`");// sc_link löschen

$transaction->addQuery("DROP TABLE IF EXISTS `".PREFIX."plugins_widgets`");
$transaction->addQuery("CREATE TABLE IF NOT EXISTS `".PREFIX."plugins_widgets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `position` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `modulname` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `themes_modulname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `plugin_folder` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `widget_file` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sort` int(11) DEFAULT '0',
  `widgetname` varchar(255) COLLATE utf8_unicode_ci DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");

$transaction->addQuery("INSERT INTO `".PREFIX."plugins_widgets` (`id`, `position`, `description`, `name`, `modulname`, `themes_modulname`, `plugin_folder`, `widget_file`, `sort`, `widgetname`) VALUES
(1, 'page_navigation_widget', 'Navigation', '', '', 'default', NULL, NULL, 1, '0'),
(2, 'page_head_widget', 'Page Head', '', '', 'default', NULL, NULL, 2, '0'),
(3, 'head_section_widget', 'Head Section', '', '', 'default', NULL, NULL, 3, '0'),
(4, 'center_head_widget', 'Content Head', '', '', 'default', NULL, NULL, 4, '0'),
(5, 'left_side_widget', 'Page Left', '', '', 'default', NULL, NULL, 5, '0'),
(6, 'right_side_widget', 'Page Right', '', '', 'default', NULL, NULL, 6, '0'),
(7, 'center_footer_widget', 'Content Foot', '', '', 'default', NULL, NULL, 7, '0'),
(8, 'foot_section_widget', 'Foot Section', '', '', 'default', NULL, NULL, 8, '0'),
(9, 'page_footer_widget', 'Page Footer', '', '', 'default', NULL, NULL, 9, '0'),
(10, 'page_navigation_widget', 'page_navigation_widget', 'Navigation Default', 'navigation_default', 'default', 'navigation_default', 'widget_navigation_default.php', 1, 'navigation_default')");


$transaction->addQuery("ALTER TABLE `" . PREFIX . "carousel` RENAME TO `" . PREFIX ."plugins_carousel`");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "plugins_carousel` ADD ani_title varchar(255) NOT NULL");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "plugins_carousel` ADD ani_link varchar(255) NOT NULL");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "plugins_carousel` ADD ani_description varchar(255) NOT NULL");

$transaction->addQuery("ALTER TABLE `" . PREFIX . "poll` RENAME TO `" . PREFIX ."plugins_poll`");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "plugins_poll` ADD description varchar(255) NOT NULL");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "plugins_poll` ADD published varchar(255) NOT NULL");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "poll_votes` RENAME TO `" . PREFIX ."plugins_poll_votes`");

$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "settings_recaptcha`");
    $transaction->addQuery("CREATE TABLE `" . PREFIX . "settings_recaptcha` (
   `activated` integer NOT NULL default '0',
  `webkey` varchar(255) NOT NULL,
  `seckey` varchar(255) NOT NULL
) AUTO_INCREMENT=1
  DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");

$transaction->addQuery("INSERT IGNORE INTO `" . PREFIX . "settings_recaptcha` (`activated`, `webkey`, `seckey`) VALUES
(0, 'Web-Key', 'Sec-Key')");  

$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "scrolltext`"); #scrolltext entfernt
$transaction->addQuery("ALTER TABLE `" . PREFIX . "servers` RENAME TO `" . PREFIX ."plugins_servers`");

#settings steht unten
$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "settings_moduls`");


$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "styles`");


$transaction->addQuery("ALTER TABLE `" . PREFIX . "shoutbox` RENAME TO `" . PREFIX ."plugins_shoutbox`");

$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "smileys`"); #smileys entfernt

$transaction->addQuery("ALTER TABLE `" . PREFIX . "sponsors` RENAME TO `" . PREFIX ."plugins_sponsors`");

#squads
#squads_members

$transaction->addQuery("ALTER TABLE `" . PREFIX . "static` RENAME TO `" . PREFIX ."settings_static`");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "settings_static` CHANGE `name` `title` VARCHAR( 255 ) NOT NULL");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "settings_static` ADD `date` int(14) DEFAULT '0'");

#tags

#$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "upcoming`"); #upcoming entfernt
$transaction->addQuery("ALTER TABLE `" . PREFIX . "upcoming` RENAME TO `" . PREFIX ."plugins_upcoming`");
#$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "upcoming_announce`"); #upcoming_announce entfernt
$transaction->addQuery("ALTER TABLE `" . PREFIX . "upcoming_announce` RENAME TO `" . PREFIX ."plugins_upcoming_announce`");


$transaction->addQuery("ALTER TABLE `" . PREFIX . "user` ADD facebook varchar(255) NOT NULL");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "user` ADD twitter varchar(255) NOT NULL");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "user` ADD twitch varchar(255) NOT NULL");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "user` ADD steam varchar(255) NOT NULL");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "user` ADD instagram varchar(255) NOT NULL");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "user` ADD youtube varchar(255) NOT NULL");

#$transaction->addQuery("ALTER TABLE `" . PREFIX . "user` DROP `newsletter`");// newsletter löschen
$transaction->addQuery("ALTER TABLE `" . PREFIX . "user` DROP `username`");// username löschen
$transaction->addQuery("ALTER TABLE `" . PREFIX . "user` DROP `country`");// country löschen
$transaction->addQuery("ALTER TABLE `" . PREFIX . "user` DROP `clantag`");// clantag löschen
$transaction->addQuery("ALTER TABLE `" . PREFIX . "user` DROP `clanname`");// clanname löschen
$transaction->addQuery("ALTER TABLE `" . PREFIX . "user` DROP `clanhp`");// clanhp löschen
$transaction->addQuery("ALTER TABLE `" . PREFIX . "user` DROP `clanirc`");// clanirc löschen
$transaction->addQuery("ALTER TABLE `" . PREFIX . "user` DROP `clanhistory`");// clanhistory löschen
$transaction->addQuery("ALTER TABLE `" . PREFIX . "user` DROP `cpu`");// cpu löschen
$transaction->addQuery("ALTER TABLE `" . PREFIX . "user` DROP `mainboard`");// mainboard löschen
$transaction->addQuery("ALTER TABLE `" . PREFIX . "user` DROP `ram`");// ram löschen
$transaction->addQuery("ALTER TABLE `" . PREFIX . "user` DROP `monitor`");// monitor löschen
$transaction->addQuery("ALTER TABLE `" . PREFIX . "user` DROP `graphiccard`");// graphiccard löschen
$transaction->addQuery("ALTER TABLE `" . PREFIX . "user` DROP `soundcard`");// soundcard löschen
$transaction->addQuery("ALTER TABLE `" . PREFIX . "user` DROP `verbindung`");// verbindung löschen
$transaction->addQuery("ALTER TABLE `" . PREFIX . "user` DROP `keyboard`");// keyboard löschen
$transaction->addQuery("ALTER TABLE `" . PREFIX . "user` DROP `mouse`");// mouse löschen
$transaction->addQuery("ALTER TABLE `" . PREFIX . "user` DROP `mousepad`");// mousepad löschen
$transaction->addQuery("ALTER TABLE `" . PREFIX . "user` DROP `hdd`");// hdd löschen
$transaction->addQuery("ALTER TABLE `" . PREFIX . "user` DROP `headset`");// headset löschen
$transaction->addQuery("ALTER TABLE `" . PREFIX . "user` DROP `user_guestbook`");// user_guestbook löschen
#user_forum_groups

$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "user_gbook`"); #user_gbook entfernt

#user_groups
#user_visitors
#whoisonline
#whowasonline


if ($transaction->successful()) {
        return array('status' => 'success', 'message' => 'Updated from Webspell NOR 1.2.5 to Webspell-RM 2.0.9 - 1');
    } else {
        return array('status' => 'fail', 'message' => 'Failed to update to Webspell-RM 2.0.9 - 1<br/>' . $transaction->getError());
    }

}


function update_nor_rm209_2($_database)
{

  $transaction = new Transaction($_database);


$transaction->addQuery("ALTER TABLE `" . PREFIX . "news` RENAME TO `" . PREFIX ."plugins_news`");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "plugins_news` DROP `link3`");// link3 löschen
$transaction->addQuery("ALTER TABLE `" . PREFIX . "plugins_news` DROP `url3`");// url3 löschen
$transaction->addQuery("ALTER TABLE `" . PREFIX . "plugins_news` DROP `window3`");// window3 löschen
$transaction->addQuery("ALTER TABLE `" . PREFIX . "plugins_news` DROP `link4`");// link4 löschen
$transaction->addQuery("ALTER TABLE `" . PREFIX . "plugins_news` DROP `url4`");// url4 löschen
$transaction->addQuery("ALTER TABLE `" . PREFIX . "plugins_news` DROP `window4`");// window4 löschen
$transaction->addQuery("ALTER TABLE `" . PREFIX . "plugins_news` DROP `saved`");// saved löschen
$transaction->addQuery("ALTER TABLE `" . PREFIX . "plugins_news` DROP `published`");// published löschen
$transaction->addQuery("ALTER TABLE `" . PREFIX . "plugins_news` DROP `cwID`");// cwID löschen
$transaction->addQuery("ALTER TABLE `" . PREFIX . "plugins_news` DROP `intern`");// intern löschen

$transaction->addQuery("ALTER TABLE `" . PREFIX . "plugins_news` ADD displayed int(11)  DEFAULT '1'");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "plugins_news` ADD headline varchar(255) NOT NULL");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "plugins_news` ADD content text NOT NULL");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "plugins_news` ADD recomments  int(1) NOT NULL");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "plugins_news` ADD banner varchar(255) NOT NULL");


$transaction->addQuery("ALTER TABLE `" . PREFIX . "news_rubrics` RENAME TO `" . PREFIX ."plugins_news_rubrics`");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "plugins_news_rubrics` ADD displayed int(11) NOT NULL");

# update der News in update_nor_rm209_8

if ($transaction->successful()) {
        return array('status' => 'success', 'message' => 'Updated from Webspell NOR 1.2.5 to Webspell-RM 2.0.9 - 2');
    } else {
        return array('status' => 'fail', 'message' => 'Failed to update to Webspell-RM 2.0.9 - 2<br/>' . $transaction->getError());
    }

}

function update_nor_rm209_3($_database)
{
    $transaction = new Transaction($_database);

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



if ($transaction->successful()) {
        return array('status' => 'success', 'message' => 'Updated from Webspell NOR 1.2.5 to Webspell-RM 2.0.9 - 3');
    } else {
        return array('status' => 'fail', 'message' => 'Failed to update to Webspell-RM 2.0.9 - 3<br/>' . $transaction->getError());
    }

}

function update_nor_rm209_4($_database)
{
    $transaction = new Transaction($_database);

$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "navigation_website_main`");
$transaction->addQuery("CREATE TABLE `" . PREFIX . "navigation_website_main` (
  `mnavID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `default` int(11) NOT NULL DEFAULT '1',
  `sort` int(2) NOT NULL DEFAULT '0',
  `isdropdown` int(1) NOT NULL DEFAULT '1',
  `windows` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY  (`mnavID`)
) AUTO_INCREMENT=1
  DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");
  
$transaction->addQuery("INSERT INTO `".PREFIX ."navigation_website_main` (`mnavID`, `name`, `url`, `default`, `sort`, `isdropdown`, `windows`) VALUES
(1, '{[de]}HAUPT{[en]}MAIN{[pl]}STRONA GLÃ“WNA{[it]}PRINCIPALE', '#', 1, 1, 1, 1),
(2, '{[de]}TEAM{[en]}TEAM{[pl]}DRUZYNA{[it]}TEAM', '#', 1, 2, 1, 1),
(3, '{[de]}GEMEINSCHAFT{[en]}COMMUNITY{[pl]}SPOLECZNOSC{[it]}COMMUNITY', '#', 1, 3, 1, 1),
(4, '{[de]}MEDIEN{[en]}MEDIA{[pl]}MEDIA{[it]}MEDIA', '#', 1, 4, 1, 1),
(5, '{[de]}SONSTIGES{[en]}MISCELLANEOUS{[pl]}RÃ“ZNE{[it]}VARIE', '#', 1, 5, 1, 1)");  

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
(1, 5, '{[de]}Kontakt{[en]}Contact{[it]}Contatti', 'contact', 'index.php?site=contact', 1, 1),
(2, 5, '{[de]}Datenschutz-Bestimmungen{[en]}Privacy Policy{[it]}Informativa sulla privacy', 'privacy_policy', 'index.php?site=privacy_policy', 2, 1),
(3, 5, '{[de]}Impressum{[en]}Imprint{[it]}Impronta Editoriale', 'imprint', 'index.php?site=imprint', 3, 1)");




$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "settings_themes`");
    $transaction->addQuery("CREATE TABLE `" . PREFIX . "settings_themes` (
  `themeID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `modulname` varchar(100) NOT NULL,
  `active` int(11) DEFAULT NULL,
  `version` varchar(11) NOT NULL,
  `nav1` varchar(255) NOT NULL DEFAULT '',
  `nav2` varchar(255) NOT NULL DEFAULT '',
  `nav5` varchar(255) NOT NULL DEFAULT '',
  `nav6` varchar(255) NOT NULL DEFAULT '',
  `body1` text NOT NULL,
  `body2` varchar(255) NOT NULL DEFAULT '',
  `body3` varchar(255) NOT NULL DEFAULT '',
  `body4` varchar(255) NOT NULL DEFAULT '',
  `typo1` varchar(255) NOT NULL DEFAULT '',
  `typo2` varchar(255) NOT NULL DEFAULT '',
  `typo3` varchar(255) NOT NULL DEFAULT '',
  `typo5` varchar(255) NOT NULL DEFAULT '',
  `typo6` varchar(255) NOT NULL DEFAULT '',
  `typo7` varchar(255) NOT NULL DEFAULT '',
  `card1` varchar(255) NOT NULL DEFAULT '',
  `card2` varchar(255) NOT NULL DEFAULT '',
  `foot1` varchar(255) NOT NULL DEFAULT '',
  `foot2` varchar(255) NOT NULL DEFAULT '',
  `foot3` varchar(255) NOT NULL DEFAULT '',
  `foot4` varchar(255) NOT NULL DEFAULT '',
  `foot5` varchar(255) NOT NULL DEFAULT '',
  `foot6` varchar(255) NOT NULL DEFAULT '',
  `calendar1` varchar(255) NOT NULL DEFAULT '',
  `calendar2` varchar(255) NOT NULL DEFAULT '',
  `carousel1` varchar(255) NOT NULL DEFAULT '',
  `carousel2` varchar(255) NOT NULL DEFAULT '',
  `carousel3` varchar(255) NOT NULL DEFAULT '',
  `carousel4` varchar(255) NOT NULL DEFAULT '',
  `sort` int(11) NOT NULL DEFAULT '0',
  `logo` varchar(255) NOT NULL DEFAULT '',
  `express_active` int(11) NOT NULL DEFAULT '0',
  `reg1` varchar(255) NOT NULL DEFAULT '',
  `reg2` varchar(255) NOT NULL DEFAULT '',
  `reg_pic` varchar(255) NOT NULL DEFAULT '',
  `logotext1` varchar(255) NOT NULL DEFAULT '',
  `logotext2` varchar(255) NOT NULL DEFAULT '',
  `nav3` varchar(255) NOT NULL DEFAULT '',
  `nav4` varchar(255) NOT NULL DEFAULT '',
  `nav7` varchar(255) NOT NULL DEFAULT '',
  `nav8` varchar(255) NOT NULL DEFAULT '',
  `nav9` varchar(255) NOT NULL DEFAULT '',
  `nav10` varchar(255) NOT NULL DEFAULT '',
  `typo4` varchar(255) NOT NULL DEFAULT '',
  `typo8` varchar(255) NOT NULL DEFAULT '',
PRIMARY KEY  (`themeID`)
) AUTO_INCREMENT=2
  DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");


$transaction->addQuery("INSERT IGNORE INTO `" . PREFIX . "settings_themes` (`themeID`, `name`, `modulname`, `active`, `version`, `nav1`, `nav2`, `nav5`, `nav6`, `body1`, `body2`, `body3`, `body4`, `typo1`, `typo2`, `typo3`, `typo5`, `typo6`, `typo7`, `card1`, `card2`, `foot1`, `foot2`, `foot3`, `foot4`, `foot5`, `foot6`, `calendar1`, `calendar2`, `carousel1`, `carousel2`, `carousel3`, `carousel4`, `sort`, `logo`, `express_active`, `reg1`, `reg2`, `reg_pic`, `logotext1`, `logotext2`, `nav3`, `nav4`, `nav7`, `nav8`, `nav9`, `nav10`, `typo4`, `typo8`) VALUES
(1, 'default', 'default', 1, '2.0', '#333333', '16px', '#fe821d', '5px', '\'Roboto\', sans-serif', '13px', '#f0efef', '#555555', '#e3e3e3', '#555555', '#555555', '13px', '#908e8e', '1px', '#bababa', '#ffffff', '#bababa', '#dddddd', '#555555', '#908e8e', '#333333', '#333333', '#d0d0d0', '#9d9b9b', '#aaaaaa', '#fe821d', '#aaaaaa', '#fe821d', 1, '1.png', 0, 'rgba(254,130,29,0.74)', '#ffffff', 'login_bg.jpg', 'webspell rm', 'your bootstrap gaming cms', '#dddddd', '#fe821d', '#dddddd', '#fe821d', '', '', '#c45901', '#863d01')");

$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "settings_buttons`");
    $transaction->addQuery("CREATE TABLE `" . PREFIX . "settings_buttons` (
    `buttonID` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL DEFAULT '',
  `modulname` varchar(255) NOT NULL DEFAULT '',
  `active` int(11) DEFAULT NULL,
  `version` varchar(11) NOT NULL,
  `button1` varchar(255) NOT NULL DEFAULT '',
  `button2` varchar(255) NOT NULL DEFAULT '',
  `button3` varchar(255) NOT NULL DEFAULT '',
  `button4` varchar(255) NOT NULL DEFAULT '',
  `button5` varchar(255) NOT NULL DEFAULT '',
  `button6` varchar(255) NOT NULL DEFAULT '',
  `button7` varchar(255) NOT NULL DEFAULT '',
  `button8` varchar(255) NOT NULL DEFAULT '',
  `button9` varchar(255) NOT NULL DEFAULT '',
  `button10` varchar(255) NOT NULL DEFAULT '',
  `button11` varchar(255) NOT NULL DEFAULT '',
  `button12` varchar(255) NOT NULL DEFAULT '',
  `button13` varchar(255) NOT NULL DEFAULT '',
  `button14` varchar(255) NOT NULL DEFAULT '',
  `button15` varchar(255) NOT NULL DEFAULT '',
  `button16` varchar(255) NOT NULL DEFAULT '',
  `button17` varchar(255) NOT NULL DEFAULT '',
  `button18` varchar(255) NOT NULL DEFAULT '',
  `button19` varchar(255) NOT NULL DEFAULT '',
  `button20` varchar(255) NOT NULL DEFAULT '',
  `button21` varchar(255) NOT NULL DEFAULT '',
  `button22` varchar(255) NOT NULL DEFAULT '',
  `button23` varchar(255) NOT NULL DEFAULT '',
  `button24` varchar(255) NOT NULL DEFAULT '',
  `button25` varchar(255) NOT NULL DEFAULT '',
  `button26` varchar(255) NOT NULL DEFAULT '',
  `button27` varchar(255) NOT NULL DEFAULT '',
  `button28` varchar(255) NOT NULL DEFAULT '',
  `button29` varchar(255) NOT NULL DEFAULT '',
  `button30` varchar(255) NOT NULL DEFAULT '',
  `button31` varchar(255) NOT NULL DEFAULT '',
  `button32` varchar(255) NOT NULL DEFAULT '',
  `button33` varchar(255) NOT NULL DEFAULT '',
  `button34` varchar(255) NOT NULL DEFAULT '',
  `button35` varchar(255) NOT NULL DEFAULT '',
  `button36` varchar(255) NOT NULL DEFAULT '',
  `button37` varchar(255) NOT NULL DEFAULT '',
  `button38` varchar(255) NOT NULL DEFAULT '',
  `button39` varchar(255) NOT NULL DEFAULT '',
  `button40` varchar(255) NOT NULL DEFAULT '',
  `button41` varchar(255) NOT NULL DEFAULT '',
  `button42` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY  (`buttonID`)
) AUTO_INCREMENT=2
  DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");

$transaction->addQuery("INSERT IGNORE INTO `" . PREFIX . "settings_buttons` (`buttonID`, `name`, `modulname`, `active`, `version`, `button1`, `button2`, `button3`, `button4`, `button5`, `button6`, `button7`, `button8`, `button9`, `button10`, `button11`, `button12`, `button13`, `button14`, `button15`, `button16`, `button17`, `button18`, `button19`, `button20`, `button21`, `button22`, `button23`, `button24`, `button25`, `button26`, `button27`, `button28`, `button29`, `button30`, `button31`, `button32`, `button33`, `button34`, `button35`, `button36`, `button37`, `button38`, `button39`, `button40`, `button41`, `button42`) VALUES
(1, 'default', 'default', 0, '2.0', '#fe821d', '#c45901', '#000000', '#908e8e', '#c45901', '#6c757d', '#5a6268', '#ffffff', '#6c757d', '#545b62', '#28a745', '#218838', '#ffffff', '#28a745', '#1e7e34', '#dc3545', '#c82333', '#ffffff', '#dc3545', '#bd2130', '#ffc107', '#e0a800', '#212529', '#ffc107', '#d39e00', '#17a2b8', '#138496', '#ffffff', '#17a2b8', '#117a8b', '#f8f9fa', '#e2e6ea', '#212529', '#f8f9fa', '#dae0e5', '#343a40', '#23272b', '#ffffff', '#343a40', '#1d2124', '#007bff', '#0056b3')");




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


if ($transaction->successful()) {
        return array('status' => 'success', 'message' => 'Updated from Webspell NOR 1.2.5 to Webspell-RM 2.0.9 - 4');
    } else {
        return array('status' => 'fail', 'message' => 'Failed to update to Webspell-RM 2.0.9 - 4<br/>' . $transaction->getError());
    }

}

function update_nor_rm209_5($_database)
{
    $transaction = new Transaction($_database);


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

if ($transaction->successful()) {
        return array('status' => 'success', 'message' => 'Updated from Webspell NOR 1.2.5 to Webspell-RM 2.0.9 - 5');
    } else {
        return array('status' => 'fail', 'message' => 'Failed to update to Webspell-RM 2.0.9 - 5<br/>' . $transaction->getError());
    }

}

function update_nor_rm209_6($_database)
{
    $transaction = new Transaction($_database);



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

$transaction->addQuery("CREATE TABLE `" . PREFIX . "settings_logo` (
  `logoID` int(11) NOT NULL,
  `logo` varchar(255) NOT NULL
) DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");

$transaction->addQuery("INSERT IGNORE INTO `" . PREFIX . "settings_logo` (`logoID`, `logo`) VALUES
(1, '1.png')");



if ($transaction->successful()) {
        return array('status' => 'success', 'message' => 'Updated from Webspell NOR 1.2.5 to Webspell-RM 2.0.9 - 6');
    } else {
        return array('status' => 'fail', 'message' => 'Failed to update to Webspell-RM 2.0.9 - 6<br/>' . $transaction->getError());
    }

}

function update_nor_rm209_7($_database)
{
    $transaction = new Transaction($_database);



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
(4, '{[de]}Template / Layout{[en]}Template / Layout{[it]}Template / Disposizione', 'far fa-image', 'page', 0, 4),
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
(1, 1, '{[de]}Server-Info{[en]}Overview{[it]}Informazioni Server', 'ac_overview', 'admincenter.php?site=overview', 'any', 1),
(2, 1, '{[de]}Seiten Statistiken{[en]}Page Statistics{[it]}Pagina delle Statistiche', 'ac_page_statistic', 'admincenter.php?site=page_statistic', 'any', 2),
(3, 1, '{[de]}Besucher Statistiken{[en]}Visitor Statistics{[it]}Statistiche Visitatori', 'ac_visitor_statistic', 'admincenter.php?site=visitor_statistic', 'any', 3),
(4, 2, '{[de]}Registrierte Benutzer{[en]}Registered Users{[it]}Utenti Registrati', 'ac_users', 'admincenter.php?site=users', 'forum', 1),
(5, 2, '{[de]}Teams{[en]}Squads{[it]}Squadre', 'ac_squads', 'admincenter.php?site=squads', 'user', 2),
(6, 2, '{[de]}Clanmitglieder{[en]}Clanmembers{[it]}Membri del Clan', 'ac_members', 'admincenter.php?site=members', 'user', 3),
(7, 3, '{[de]}Geblockte Inhalte{[en]}Blocked Content{[it]}Contenuti Bloccati', 'ac_spam_forum', 'admincenter.php?site=spam&amp;action=forum_spam', 'user', 1),
(8, 3, '{[de]}Nutzer l&ouml;schen{[en]}Remove User{[it]}Rimuovi Utente', 'ac_spam_user', 'admincenter.php?site=spam&amp;action=user', 'user', 2),
(9, 3, '{[de]}Multi-Accounts{[en]}Multi-Accounts{[it]}Multi-Account', 'ac_spam_multi', 'admincenter.php?site=spam&amp;action=multi', 'user', 3),
(10, 3, '{[de]}gebannte IP`s{[en]}banned IP`s{[it]}IP bannati', 'ac_spam_banned_ips', 'admincenter.php?site=banned_ips', 'user', 4),
(11, 4, '{[de]}Webseiten Navigation{[en]}Webside Navigation{[it]}Menu Navigazione Web', 'ac_webside_navigation', 'admincenter.php?site=webside_navigation', 'page', 1),
(12, 4, '{[de]}Startseite{[en]}Start Page{[it]}Pagina Principale', 'ac_settings_startpage', 'admincenter.php?site=settings_startpage', 'page', 2),
(13, 4, '{[de]}Statische Seiten{[en]}Static Pages{[it]}Pagine Statiche', 'ac_settings_static', 'admincenter.php?site=settings_static', 'page', 3),
(14, 4, '{[de]}Templates Installer{[en]}Templates Installer{[it]}Installazione Temi', 'ac_template-installer', 'admincenter.php?site=template-installer', 'page', 4),
(15, 4, '{[de]}Templates / Style{[en]}Templates / Style{[it]}Templates Grafici / stile', 'ac_settings_templates', 'admincenter.php?site=settings_templates', 'page', 5),
(16, 4, '{[de]}Module Einstellung{[en]}Module Setting {[it]}Impostazione del modulo', 'ac_settings_moduls', 'admincenter.php?site=settings_moduls', 'page', 6),
(17, 4, '{[de]}Head Elements{[en]}Head Elements{[it]}Head Elements', 'ac_headelements', 'admincenter.php?site=settings_headelements', 'page', 7),
(18, 5, '{[de]}Allgemeine Einstellungen{[en]}General Settings{[it]}Impostazioni Generali', 'ac_settings', 'admincenter.php?site=settings', 'page', 1),
(19, 5, '{[de]}Admincenter Navigation{[en]}Admincenter Navigation{[it]}Menu Navigazione Admin', 'ac_dashboard_navigation', 'admincenter.php?site=dashboard_navigation', 'page', 2),
(20, 5, '{[de]}E-Mail{[en]}E-Mail{[it]}E-Mail', 'ac_email', 'admincenter.php?site=email', 'page', 3),
(21, 5, '{[de]}Kontakte{[en]}Contacts{[it]}Contatti', 'ac_contact', 'admincenter.php?site=contact', 'page', 4),
(22, 5, '{[de]}Mod-Rewrite{[en]}Mod-Rewrite{[it]}Mod-Rewrite', 'ac_modrewrite', 'admincenter.php?site=modrewrite', 'page', 5),
(23, 5, '{[de]}Impressum{[en]}Imprint{[it]}Impronta Editoriale', 'ac_settings_imprint', 'admincenter.php?site=settings_imprint', 'page', 6),
(24, 5, '{[de]}Datenschutz-Bestimmungen{[en]}Privacy Policy{[it]}Informativa sulla privacy', 'ac_settings_privacy_policy', 'admincenter.php?site=settings_privacy_policy', 'page', 7),
(25, 5, '{[de]}Spiele{[en]}Games{[it]}Giochi', 'ac_settings_games', 'admincenter.php?site=settings_games', 'page', 8),
(26, 5, '{[de]}Datenbank{[en]}Database', 'ac_database', 'admincenter.php?site=database', 'any', 9),
(27, 5, '{[de]}Webspell-RM Update{[en]}Webspell-RM Update{[it]}Webspell-RM Update', 'ac_update', 'admincenter.php?site=update', 'any', 10),
(28, 6, '{[de]}Plugin Manager{[en]}Plugin Manager{[it]}Gestione Plugin', 'ac_plugin-manager', 'admincenter.php?site=plugin-manager', 'page', 1),
(29, 6, '{[de]}Plugin Installer{[en]}Plugin Installer{[it]}Installazione Plugin', 'ac_plugin-installer', 'admincenter.php?site=plugin-installer', 'page', 2),
(30, 6, '{[de]}Widget Verwaltung{[en]}Widget Control{[it]}Gestione Widget', 'ac_plugin-widgets', 'admincenter.php?site=plugin-widgets', 'page', 3)");




$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "tags`");
$transaction->addQuery("CREATE TABLE `" . PREFIX . "tags` (
  `rel` varchar(255) NOT NULL,
  `ID` int(11) NOT NULL,
  `tag` varchar(255) NOT NULL
) DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");

$transaction->addQuery("DROP TABLE IF EXISTS `".PREFIX."settings_headelements`");
$transaction->addQuery("CREATE TABLE IF NOT EXISTS `".PREFIX."settings_headelements` (
  `headelementID` int(11) NOT NULL AUTO_INCREMENT,
  `banner` varchar(225) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `name` varchar(225) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `modulname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
PRIMARY KEY  (`headelementID`)
) AUTO_INCREMENT=2
  DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");

$transaction->addQuery("DROP TABLE IF EXISTS `".PREFIX."settings_social_media`");
$transaction->addQuery("CREATE TABLE IF NOT EXISTS `".PREFIX."settings_social_media` (
  `socialID` int(11) NOT NULL AUTO_INCREMENT,
  `twitch` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `facebook` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `twitter` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `youtube` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rss` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vine` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `flickr` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `linkedin` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `instagram` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `since` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gametracker` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `discord` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`socialID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");

$transaction->addQuery("INSERT INTO `".PREFIX."settings_social_media` (`socialID`, `twitch`, `facebook`, `twitter`, `youtube`, `rss`, `vine`, `flickr`, `linkedin`, `instagram`, `since`, `gametracker`, `discord`) VALUES
(1, 'https://www.twitch.tv/pulsradiocom', 'https://www.facebook.com/WebspellRM', 'https://twitter.com/webspell_rm', 'https://www.youtube.com/channel/UCE5yTn9ljzSnC_oMp9Jnckg', '-', '-', '-', '-', '-', '2021', '85.14.228.228:28960', '428995618971582473')");



$transaction->addQuery("DROP TABLE IF EXISTS `".PREFIX."nickname`");
$transaction->addQuery("CREATE TABLE IF NOT EXISTS `".PREFIX."nickname` (
  `userID` int(11) NOT NULL,
  `nickname` varchar(255) NOT NULL,
PRIMARY KEY (`userID`)
) AUTO_INCREMENT=2
  DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");

$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "settings_module`");
$transaction->addQuery("CREATE TABLE `" . PREFIX . "settings_module` (
  `pluginID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `modulname` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `themes_modulname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `full_activated` int(11) NOT NULL DEFAULT '0',
  `le_activated` int(11) NOT NULL,
  `re_activated` int(11) NOT NULL,
  `all_activated` int(11) NOT NULL,
  `all_deactivated` int(11) NOT NULL,
  `head_activated` int(11) NOT NULL,
  `content_head_activated` int(11) NOT NULL,
  `content_foot_activated` int(11) NOT NULL,
  `head_section_activated` int(11) NOT NULL,
  `foot_section_activated` int(11) NOT NULL,
  `modul_display` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pluginID`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");

$transaction->addQuery("INSERT INTO `".PREFIX."settings_module` (`pluginID`, `name`, `modulname`, `themes_modulname`, `full_activated`, `le_activated`, `re_activated`, `all_activated`, `all_deactivated`, `head_activated`, `content_head_activated`, `content_foot_activated`, `head_section_activated`, `foot_section_activated`, `modul_display`) VALUES
(1, '', 'startpage', 'default', 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0),
(2, 'Startpage', '', 'default', 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 1),
(3, 'Profile', 'profile', 'default', 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0),
(4, 'Login', 'login', 'default', 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0),
(5, 'Lost Password', 'lostpassword', 'default', 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0),
(6, 'Register', 'register', 'default', 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0),
(7, 'Loginoverview', 'loginoverview', 'default', 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0),
(8, 'Contact', 'contact', 'default', 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0),
(9, 'Privacy Policy', 'privacy_policy', 'default', 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0),
(10, 'Imprint', 'imprint', 'default', 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0),
(11, 'Static', 'static', 'default', 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 1),
(12, 'Error_404', 'error_404', 'default', 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0),
(13, 'My Profile', 'myprofile', 'default', 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0)");

$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "backups`");
$transaction->addQuery("CREATE TABLE `" . PREFIX . "backups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `createdby` int(11) NOT NULL DEFAULT '0',
  `createdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");


    if ($transaction->successful()) {
        return array('status' => 'success', 'message' => 'Updated from Webspell NOR 1.2.5 to Webspell-RM 2.0.9 - 7');
    } else {
        return array('status' => 'fail', 'message' => 'Failed to update to Webspell-RM 2.0.9 - 7<br/>' . $transaction->getError());
    }

}

function update_nor_rm209_8($_database)
{
    $transaction = new Transaction($_database);
    // update user passwords for new hashing
    $q = mysqli_query($_database, "SELECT newsID, content, headline FROM `" . PREFIX . "news_contents`");
    $rows = mysqli_num_rows($q);
    $cal == '0';
    while ($ds = mysqli_fetch_array($q)) {
        $transaction->addQuery("UPDATE `" . PREFIX . "plugins_news` SET content='" . $ds['content'] . "', headline='" . $ds['headline'] . "'  WHERE newsID='" . $ds['newsID']. "'");
        $cal++;
    }

$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "news_contents`");  

    if ($rows - $cal == '0') {
        return array('status' => 'success', 'message' => 'Updated from Webspell NOR 1.2.5 to Webspell-RM 2.0.9 - 8');
    } else {
        return array('status' => 'fail', 'message' => 'Failed to update to Webspell-RM 2.0.9 - 8<br/>' . $transaction->getError());
    }
}

function update_nor_rm_1($_database) {
  global $adminname;
  $transaction = new Transaction($_database);



  if ($transaction->successful()) {
      return array('status' => 'success', 'message' => '- Webspell-RM Update  Ver.: <span class="badge badge-warning">2.0.8</span> / <b>Last Stand:</b> <span class="badge badge-warning">25.12.2021</span>');
  } else {
      return array('status' => 'fail', 'message' => '-  Webspell-RM Update  Ver.: <span class="badge badge-warning">2.0.8</span> / <b>Last Stand:</b> <span class="badge badge-warning">25.12.2021</span><br/>' . $transaction->getError());
  }

}

?>