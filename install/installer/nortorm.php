<?php
#==========================================#
#Update von NOR 1.2.5 auf RM
#==========================================#

function update_nor_rm202_1($_database)
{
    $transaction = new Transaction($_database);


$transaction->addQuery("ALTER TABLE `" . PREFIX . "about` RENAME TO `" . PREFIX ."plugins_about`");
$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "api_log`"); #api_log entfernt
$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "articles`"); #articles entfernt
$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "articles_contents`"); #articles_contents entfernt
$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "awards`"); #awards entfernt
#banned_ips
#banner
$transaction->addQuery("ALTER TABLE `" . PREFIX . "bannerrotation` RENAME TO `" . PREFIX ."plugins_bannerrotation`");
$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "buddys`"); #buddys entfernt
#captcha
#$transaction->addQuery("ALTER TABLE `" . PREFIX . "carousel` RENAME TO `" . PREFIX ."plugins_carousel`");
$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "cash_box`"); #cash_box entfernt
$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "cash_box_payed`"); #cash_box_payed entfernt
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
$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "gallery`"); #gallery entfernt
$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "gallery_groups`"); #gallery_groups entfernt
$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "gallery_pictures`"); #gallery_pictures entfernt

$transaction->addQuery("ALTER TABLE `" . PREFIX . "games` RENAME TO `" . PREFIX ."settings_games`");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "guestbook` RENAME TO `" . PREFIX ."plugins_guestbook`");

$transaction->addQuery("ALTER TABLE `" . PREFIX . "history` RENAME TO `" . PREFIX ."plugins_history`");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "plugins_history` ADD title varchar(255) NOT NULL");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "plugins_history` CHANGE `history` `text` text NOT NULL");

$transaction->addQuery("ALTER TABLE `" . PREFIX . "imprint` RENAME TO `" . PREFIX ."settings_imprint`");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "settings_imprint` ADD disclaimer_text text NOT NULL");

$transaction->addQuery("INSERT INTO `" . PREFIX . "settings_imprint` (`imprintID`, `imprint`, `disclaimer_text`) VALUES
(1, '{[de]} Impressum in deutscher Sprache.<br /><span style=\"color:#c0392b\"><strong>Konfigurieren Sie bitte Ihr Impressum!</strong></span><br />{[en]} Imprint in English.<br /><span style=\"color:#c0392b\"><strong>Please configure your imprint!</strong></span>{[it]} Impronta Editoriale in Italianoh.<br /><span style=\"color:#c0392b\"><strong>Si prega di configurare l&rsquo;impronta!</strong></span>', '{[de]} Haftungsausschluss in deutscher Sprache.<br /><span style=\"color:#c0392b\"><strong>Konfigurieren Sie bitte Ihr Haftungsausschluss! </strong></span><br />{[en]} Disclaimer in English.<br /><span style=\"color:#c0392b\"><strong>Please configure your disclaimer!</strong></span>{[it]} Dichiarazione di non Responsabilità in Italiano.<br /><span style=\"color:#c0392b\"><strong>Si prega di configurare la Dichiarazione di non Responsabilità!</strong></span>')");



$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "settings_privacy_policy`");
    $transaction->addQuery("CREATE TABLE `" . PREFIX . "settings_privacy_policy` (
  `privacy_policyID` int(11) NOT NULL AUTO_INCREMENT,
  `date` int(14) NOT NULL,
  `privacy_policy_text` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`privacy_policyID`)
  ) AUTO_INCREMENT=1
  DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");


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

$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "newsletter`"); #newsletter entfernt
$transaction->addQuery("ALTER TABLE `" . PREFIX . "news_languages` RENAME TO `" . PREFIX ."settings_languages`");

##################### News ????????????

$transaction->addQuery("ALTER TABLE `" . PREFIX . "partners` RENAME TO `" . PREFIX ."plugins_partners`");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "plugins_partners` ADD facebook varchar(255) NOT NULL");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "plugins_partners` ADD twitter varchar(255) NOT NULL");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "plugins_partners` ADD info text NOT NULL");

$transaction->addQuery("ALTER TABLE `" . PREFIX . "plugins` ADD modulname varchar(100) NOT NULL");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "plugins` CHANGE `sc_link` `sc_link` VARCHAR( 255 ) NOT NULL");#VARCHAR geändert auf 255

$transaction->addQuery("INSERT INTO `" . PREFIX . "plugins` (`pluginID`, `name`, `modulname`, `description`, `admin_file`, `activate`, `author`, `website`, `index_link`, `sc_link`, `hiddenfiles`, `version`, `path`) VALUES
('', 'Navigation Default', 'navigation_default', 'Mit diesem Plugin k&ouml;nnt ihr euch die Default Navigation anzeigen lassen.', '', 1, 'T-Seven', 'https://webspell-rm.de', '', 'widget_navigation_default', '', '1.2', 'includes/plugins/navigation_default/')");


$transaction->addQuery("ALTER TABLE `" . PREFIX . "carousel` RENAME TO `" . PREFIX ."plugins_carousel`");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "plugins_carousel` ADD ani_title varchar(255) NOT NULL");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "plugins_carousel` ADD ani_link varchar(255) NOT NULL");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "plugins_carousel` ADD ani_description varchar(255) NOT NULL");

$transaction->addQuery("ALTER TABLE `" . PREFIX . "poll` RENAME TO `" . PREFIX ."plugins_poll`");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "plugins_poll` ADD description varchar(255) NOT NULL");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "plugins_poll` ADD published varchar(255) NOT NULL");
#poll_votes

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
    $transaction->addQuery("CREATE TABLE `" . PREFIX . "settings_moduls` (
  `modulID` int(11) NOT NULL AUTO_INCREMENT,
  `module` varchar(255) NOT NULL DEFAULT '',
  `modulname` varchar(100) NOT NULL DEFAULT '',
  `activated` int(11) NOT NULL DEFAULT '0',
  `le_activated` int(11) NOT NULL DEFAULT '0',
  `re_activated` int(11) NOT NULL DEFAULT '0',
  `deactivated` int(11) NOT NULL DEFAULT '0',
  `head_activated` int(11) NOT NULL DEFAULT '0',
  `content_head_activated` int(11) NOT NULL DEFAULT '0',
  `content_foot_activated` int(11) NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY  (`modulID`)
) AUTO_INCREMENT=10
   DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");


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
(10, 'static', '', 1, 0, 0, 0, 0, 0, 0,10),
(11, 'imprint', '', 1, 0, 0, 0, 0, 0, 0, 1),
(12, 'privacy_policy', '', 1, 0, 0, 0, 0, 0, 0, 1)");

$transaction->addQuery("ALTER TABLE `" . PREFIX . "styles` RENAME TO `" . PREFIX ."settings_styles`");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "settings_styles` DROP `title`");# entfernt
$transaction->addQuery("ALTER TABLE `" . PREFIX . "settings_styles` DROP `win`");# entfernt
$transaction->addQuery("ALTER TABLE `" . PREFIX . "settings_styles` DROP `loose`");# entfernt
$transaction->addQuery("ALTER TABLE `" . PREFIX . "settings_styles` DROP `draw`");# entfernt

$transaction->addQuery("ALTER TABLE `" . PREFIX . "settings_styles` ADD nav7 varchar(255) NOT NULL");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "settings_styles` ADD nav8 varchar(255) NOT NULL");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "settings_styles` ADD foot3 varchar(255) NOT NULL");


$transaction->addQuery("ALTER TABLE `" . PREFIX . "shoutbox` RENAME TO `" . PREFIX ."plugins_shoutbox`");

$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "smileys`"); #smileys entfernt

$transaction->addQuery("ALTER TABLE `" . PREFIX . "sponsors` RENAME TO `" . PREFIX ."plugins_sponsors`");

#squads
#squads_members

$transaction->addQuery("ALTER TABLE `" . PREFIX . "static` RENAME TO `" . PREFIX ."settings_static`");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "settings_static` CHANGE `name` `title` VARCHAR( 255 ) NOT NULL");

#tags

$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "upcoming`"); #upcoming entfernt
$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "upcoming_announce`"); #upcoming_announce entfernt


$transaction->addQuery("ALTER TABLE `" . PREFIX . "user` ADD facebook varchar(255) NOT NULL");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "user` ADD twitter varchar(255) NOT NULL");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "user` ADD twitch varchar(255) NOT NULL");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "user` ADD steam varchar(255) NOT NULL");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "user` ADD instagram varchar(255) NOT NULL");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "user` ADD youtube varchar(255) NOT NULL");

$transaction->addQuery("ALTER TABLE `" . PREFIX . "user` DROP `newsletter`");// newsletter löschen
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
        return array('status' => 'success', 'message' => 'Updated from Webspell NOR 1.2.5 to Webspell RM 2.0.2 - 1');
    } else {
        return array('status' => 'fail', 'message' => 'Failed to update to Webspell-RM 2.0.2 - 1<br/>' . $transaction->getError());
    }

}


function update_nor_rm202_2($_database)
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

$transaction->addQuery("ALTER TABLE `" . PREFIX . "news_rubrics` RENAME TO `" . PREFIX ."plugins_news_rubrics`");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "plugins_news_rubrics` ADD displayed int(11) NOT NULL");

# update der News in update_nor_rm202_8

if ($transaction->successful()) {
        return array('status' => 'success', 'message' => 'Updated from Webspell NOR 1.2.5 to Webspell RM 2.0.2 - 2');
    } else {
        return array('status' => 'fail', 'message' => 'Failed to update to Webspell-RM 2.0.2 - 2<br/>' . $transaction->getError());
    }

}

function update_nor_rm202_3($_database)
{
    $transaction = new Transaction($_database);

$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "modrewrite`");
    $transaction->addQuery("CREATE TABLE `" . PREFIX . "modrewrite` (
    `ruleID` int(11) NOT NULL AUTO_INCREMENT,
    `regex` text NOT NULL,
    `link` text NOT NULL,
    `fields` text NOT NULL,
    `replace_regex` text NOT NULL,
    `replace_result` text NOT NULL,
    `rebuild_regex` text NOT NULL,
    `rebuild_result` text NOT NULL,
    PRIMARY KEY (`ruleID`)
    ) AUTO_INCREMENT=87
     DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");



    $transaction->addQuery("INSERT INTO `".PREFIX ."modrewrite` (`ruleID`, `regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES
(1, 'about.html', 'index.php?site=about', 'a:0:{}', 'index\\\\.php\\\\?site=about', 'about.html', 'about\\\\.html', 'index.php?site=about'),
(2, 'clan_rules.html', 'index.php?site=clan_rules', 'a:0:{}', 'index\\\\.php\\\\?site=clan_rules', 'clan_rules.html', 'clan_rules\\\\.html', 'index.php?site=clan_rules'),
(3, 'clanwars.html', 'index.php?site=clanwars', 'a:0:{}', 'index\\\\.php\\\\?site=clanwars', 'clanwars.html', 'clanwars\\\\.html', 'index.php?site=clanwars'),
(4, 'contact.html', 'index.php?site=contact', 'a:0:{}', 'index\\\\.php\\\\?site=contact', 'contact.html', 'contact\\\\.html', 'index.php?site=contact'),
(5, 'counter.html', 'index.php?site=counter_stats', 'a:0:{}', 'index\\\\.php\\\\?site=counter_stats', 'counter.html', 'counter\\\\.html', 'index.php?site=counter_stats'),
(6, 'discord.html', 'index.php?site=discord', 'a:0:{}', 'index\\\\.php\\\\?site=discord', 'discord.html', 'discord\\\\.html', 'index.php?site=discord'),
(7, 'faq.html', 'index.php?site=faq', 'a:0:{}', 'index\\\\.php\\\\?site=faq', 'faq.html', 'faq\\\\.html', 'index.php?site=faq'),
(8, 'faq/{catID}.html', 'index.php?site=faq&action=faqcat&faqcatID={catID}', 'a:1:{s:5:\"catID\";s:7:\"integer\";}', 'index\\\\.php\\\\?site=faq[&|&amp;]*action=faqcat[&|&amp;]*faqcatID=([0-9]+)', 'faq/$3.html', 'faq\\\\/([0-9]+?)\\\\.html', 'index.php?site=faq&action=faqcat&faqcatID=$1'),
(9, 'faq/{catID}/{faqID}.html', 'index.php?site=faq&action=faq&faqID={faqID}&faqcatID={catID}', 'a:2:{s:5:\"faqID\";s:7:\"integer\";s:5:\"catID\";s:7:\"integer\";}', 'index\\\\.php\\\\?site=faq[&|&amp;]*action=faq[&|&amp;]*faqID=([0-9]+)[&|&amp;]*faqcatID=([0-9]+)', 'faq/$4/$3.html', 'faq\\\\/([0-9]+?)\\\\/([0-9]+?)\\\\.html', 'index.php?site=faq&action=faq&faqID=$2&faqcatID=$1'),
(10, 'files.html', 'index.php?site=files', 'a:0:{}', 'index\\\\.php\\\\?site=files', 'files.html', 'files\\\\.html', 'index.php?site=files'),
(11, 'files/category/{catID}', 'index.php?site=files&cat={catID}', 'a:1:{s:5:\"catID\";s:7:\"integer\";}', 'index\\\\.php\\\\?site=files[&|&amp;]*cat=([0-9]+)', 'files/category/$3', 'files\\\\/category\\\\/([0-9]+?)', 'index.php?site=files&cat=$1'),
(12, 'files/file/{fileID}', 'index.php?site=files&file={fileID}', 'a:1:{s:6:\"fileID\";s:7:\"integer\";}', 'index\\\\.php\\\\?site=files[&|&amp;]*file=([0-9]+)', 'files/file/$3', 'files\\\\/file\\\\/([0-9]+?)', 'index.php?site=files&file=$1'),
(13, 'files/report/{fileID}', 'index.php?site=files&action=report&link={fileID}', 'a:1:{s:6:\"fileID\";s:7:\"integer\";}', 'index\\\\.php\\\\?site=files[&|&amp;]*action=report[&|&amp;]*link=([0-9]+)', 'files/report/$3', 'files\\\\/report\\\\/([0-9]+?)', 'index.php?site=files&action=report&link=$1'),
(14, 'forum.html', 'index.php?site=forum', 'a:0:{}', 'index\\\\.php\\\\?site=forum', 'forum.html', 'forum\\\\.html', 'index.php?site=forum'),
(15, 'forum/{action}/board/{board}.html', 'index.php?site=forum&board={board}&action={action}', 'a:2:{s:5:\"board\";s:7:\"integer\";s:6:\"action\";s:6:\"string\";}', 'index\\\\.php\\\\?site=forum[&|&amp;]*board=([0-9]+)[&|&amp;]*action=(\\\\w*?)', 'forum/$4/board/$3.html', 'forum\\\\/(\\\\w*?)\\\\/board\\\\/([0-9]+?)\\\\.html', 'index.php?site=forum&board=$2&action=$1'),
(16, 'forum/action.html', 'forum.php', 'a:0:{}', 'forum\\\\.php', 'forum/action.html', 'forum\\\\/action\\\\.html', 'forum.php'),
(17, 'forum/actions/markall.html', 'index.php?site=forum&action=markall', 'a:0:{}', 'index\\\\.php\\\\?site=forum[&|&amp;]*action=markall', 'forum/actions/markall.html', 'forum\\\\/actions\\\\/markall\\\\.html', 'index.php?site=forum&action=markall'),
(18, 'forum/board/{board}.html', 'index.php?site=forum&board={board}', 'a:1:{s:5:\"board\";s:7:\"integer\";}', 'index\\\\.php\\\\?site=forum[&|&amp;]*board=([0-9]+)', 'forum/board/$3.html', 'forum\\\\/board\\\\/([0-9]+?)\\\\.html', 'index.php?site=forum&board=$1'),
(19, 'forum/board/{board}/addtopic.html', 'index.php?site=forum&addtopic=true&board={board}', 'a:1:{s:5:\"board\";s:7:\"integer\";}', 'index\\\\.php\\\\?site=forum[&|&amp;]*addtopic=true[&|&amp;]*board=([0-9]+)', 'forum/board/$3/addtopic.html', 'forum\\\\/board\\\\/([0-9]+?)\\\\/addtopic\\\\.html', 'index.php?site=forum&addtopic=true&board=$1'),
(20, 'forum/cat/{cat}.html', 'index.php?site=forum&cat={cat}', 'a:1:{s:3:\"cat\";s:7:\"integer\";}', 'index\\\\.php\\\\?site=forum[&|&amp;]*cat=([0-9]+)', 'forum/cat/$3.html', 'forum\\\\/cat\\\\/([0-9]+?)\\\\.html', 'index.php?site=forum&cat=$1'),
(21, 'gallery.html', 'index.php?site=gallery', 'a:0:{}', 'index\\\\.php\\\\?site=gallery', 'gallery.html', 'gallery\\\\.html', 'index.php?site=gallery'),
(22, 'gallery/{gallerycatID}.html', 'index.php?site=gallery&action=show&gallerycatID={gallerycatID}', 'a:1:{s:12:\"gallerycatID\";s:7:\"integer\";}', 'index\\\\.php\\\\?site=gallery[&|&amp;]*action=show[&|&amp;]*gallerycatID=([0-9]+)', 'gallery/$3.html', 'gallery\\\\/([0-9]+?)\\\\.html', 'index.php?site=gallery&action=show&gallerycatID=$1'),
(23, 'history.html', 'index.php?site=history', 'a:0:{}', 'index\\\\.php\\\\?site=history', 'history.html', 'history\\\\.html', 'index.php?site=history'),
(24, 'imprint.html', 'index.php?site=imprint', 'a:0:{}', 'index\\\\.php\\\\?site=imprint', 'imprint.html', 'imprint\\\\.html', 'index.php?site=imprint'),
(25, 'joinus.html', 'index.php?site=joinus', 'a:0:{}', 'index\\\\.php\\\\?site=joinus', 'joinus.html', 'joinus\\\\.html', 'index.php?site=joinus'),
(26, 'joinus/save.html', 'index.php?site=joinus&action=save', 'a:0:{}', 'index\\\\.php\\\\?site=joinus[&|&amp;]*action=save', 'joinus/save.html', 'joinus\\\\/save\\\\.html', 'index.php?site=joinus&action=save'),
(27, 'links.html', 'index.php?site=links', 'a:0:{}', 'index\\\\.php\\\\?site=links', 'links.html', 'links\\\\.html', 'index.php?site=links'),
(28, 'links/category/{catID}.html', 'index.php?site=links&action=show&linkcatID={catID}', 'a:1:{s:5:\"catID\";s:7:\"integer\";}', 'index\\\\.php\\\\?site=links[&|&amp;]*action=show[&|&amp;]*linkcatID=([0-9]+)', 'links/category/$3.html', 'links\\\\/category\\\\/([0-9]+?)\\\\.html', 'index.php?site=links&action=show&linkcatID=$1'),
(29, 'linkus.html', 'index.php?site=linkus', 'a:0:{}', 'index\\\\.php\\\\?site=linkus', 'linkus.html', 'linkus\\\\.html', 'index.php?site=linkus'),
(30, 'login.html', 'index.php?site=login', 'a:0:{}', 'index\\\\.php\\\\?site=login', 'login.html', 'login\\\\.html', 'index.php?site=login'),
(31, 'logout.html', 'logout.php', 'a:0:{}', 'logout\\\\.php', 'logout.html', 'logout\\\\.html', 'logout.php'),
(32, 'lostpassword.html', 'index.php?site=lostpassword', 'a:0:{}', 'index\\\\.php\\\\?site=lostpassword', 'lostpassword.html', 'lostpassword\\\\.html', 'index.php?site=lostpassword'),
(33, 'members.html', 'index.php?site=members', 'a:0:{}', 'index\\\\.php\\\\?site=members', 'members.html', 'members\\\\.html', 'index.php?site=members'),
(34, 'members/{squadID}.html', 'index.php?site=members&action=show&squadID={squadID}', 'a:1:{s:7:\"squadID\";s:7:\"integer\";}', 'index\\\\.php\\\\?site=members[&|&amp;]*action=show[&|&amp;]*squadID=([0-9]+)', 'members/$3.html', 'members\\\\/([0-9]+?)\\\\.html', 'index.php?site=members&action=show&squadID=$1'),
(35, 'messenger.html', 'index.php?site=messenger', 'a:0:{}', 'index\\\\.php\\\\?site=messenger', 'messenger.html', 'messenger\\\\.html', 'index.php?site=messenger'),
(36, 'messenger/{messageID}/read.html', 'index.php?site=messenger&action=show&id={messageID}', 'a:1:{s:9:\"messageID\";s:7:\"integer\";}', 'index\\\\.php\\\\?site=messenger[&|&amp;]*action=show[&|&amp;]*id=([0-9]+)', 'messenger/$3/read.html', 'messenger\\\\/([0-9]+?)\\\\/read\\\\.html', 'index.php?site=messenger&action=show&id=$1'),
(37, 'messenger/{messageID}/reply.html', 'index.php?site=messenger&action=reply&id={messageID}', 'a:1:{s:9:\"messageID\";s:7:\"integer\";}', 'index\\\\.php\\\\?site=messenger[&|&amp;]*action=reply[&|&amp;]*id=([0-9]+)', 'messenger/$3/reply.html', 'messenger\\\\/([0-9]+?)\\\\/reply\\\\.html', 'index.php?site=messenger&action=reply&id=$1'),
(38, 'messenger/action.html', 'messenger.php', 'a:0:{}', 'messenger\\\\.php', 'messenger/action.html', 'messenger\\\\/action\\\\.html', 'messenger.php'),
(39, 'messenger/incoming.html', 'index.php?site=messenger&action=incoming', 'a:0:{}', 'index\\\\.php\\\\?site=messenger[&|&amp;]*action=incoming', 'messenger/incoming.html', 'messenger\\\\/incoming\\\\.html', 'index.php?site=messenger&action=incoming'),
(40, 'messenger/new.html', 'index.php?site=messenger&action=newmessage', 'a:0:{}', 'index\\\\.php\\\\?site=messenger[&|&amp;]*action=newmessage', 'messenger/new.html', 'messenger\\\\/new\\\\.html', 'index.php?site=messenger&action=newmessage'),
(41, 'messenger/outgoing.html', 'index.php?site=messenger&action=outgoing', 'a:0:{}', 'index\\\\.php\\\\?site=messenger[&|&amp;]*action=outgoing', 'messenger/outgoing.html', 'messenger\\\\/outgoing\\\\.html', 'index.php?site=messenger&action=outgoing'),
(42, 'news.html', 'index.php?site=news', 'a:0:{}', 'index\\\\.php\\\\?site=news', 'news.html', 'news\\\\.html', 'index.php?site=news'),
(43, 'news_comments/{newsID}.html', 'index.php?site=news_comments&newsID={newsID}', 'a:1:{s:6:\"newsID\";s:7:\"integer\";}', 'index\\\\.php\\\\?site=news_comments[&|&amp;]*newsID=([0-9]+)', 'news/$3.html', 'news\\\\/([0-9]+?)\\\\.html', 'index.php?site=news_comments&newsID=$1'),
(44, 'news/archive.html', 'index.php?site=news_archive', 'a:0:{}', 'index\\\\.php\\\\?site=news_archive', 'news/archive.html', 'news\\\\/archive\\\\.html', 'index.php?site=news_archive'),
(45, 'portfolio.html', 'index.php?site=portfolio', 'a:0:{}', 'index\\\\.php\\\\?site=portfolio', 'portfolio.html', 'portfolio\\\\.html', 'index.php?site=portfolio'),
(46, 'privacy_policy.html', 'index.php?site=privacy_policy', 'a:0:{}', 'index\\\\.php\\\\?site=privacy_policy', 'privacy_policy.html', 'privacy_policy\\\\.html', 'index.php?site=privacy_policy'),
(47, 'profile/{action}/{id}.html', 'index.php?site=profile&id={id}&action={action}', 'a:2:{s:2:\"id\";s:7:\"integer\";s:6:\"action\";s:6:\"string\";}', 'index\\\\.php\\\\?site=profile[&|&amp;]*id=([0-9]+)[&|&amp;]*action=(\\\\w*?)', 'profile/$4/$3.html', 'profile\\\\/(\\\\w*?)\\\\/([0-9]+?)\\\\.html', 'index.php?site=profile&id=$2&action=$1'),
(48, 'profile/{action}/{id}.html', 'index.php?site=profile&action={action}&id={id}', 'a:2:{s:2:\"id\";s:7:\"integer\";s:6:\"action\";s:6:\"string\";}', 'index\\\\.php\\\\?site=profile[&|&amp;]*action=(\\\\w*?)[&|&amp;]*id=([0-9]+)', 'profile/$3/$4.html', 'profile\\\\/(\\\\w*?)\\\\/([0-9]+?)\\\\.html', 'index.php?site=profile&action=$1&id=$2'),
(49, 'profile/{id}.html', 'index.php?site=profile&id={id}', 'a:1:{s:2:\"id\";s:7:\"integer\";}', 'index\\\\.php\\\\?site=profile[&|&amp;]*id=([0-9]+)', 'profile/$3.html', 'profile\\\\/([0-9]+?)\\\\.html', 'index.php?site=profile&id=$1'),
(50, 'profile/edit.html', 'index.php?site=myprofile', 'a:0:{}', 'index\\\\.php\\\\?site=myprofile', 'profile/edit.html', 'profile\\\\/edit\\\\.html', 'index.php?site=myprofile'),
(51, 'profile/mail.html', 'index.php?site=myprofile&action=editmail', 'a:0:{}', 'index\\\\.php\\\\?site=myprofile[&|&amp;]*action=editmail', 'profile/mail.html', 'profile\\\\/mail\\\\.html', 'index.php?site=myprofile&action=editmail'),
(52, 'profile/password.html', 'index.php?site=myprofile&action=editpwd', 'a:0:{}', 'index\\\\.php\\\\?site=myprofile[&|&amp;]*action=editpwd', 'profile/password.html', 'profile\\\\/password\\\\.html', 'index.php?site=myprofile&action=editpwd'),
(53, 'register.html', 'index.php?site=register', 'a:0:{}', 'index\\\\.php\\\\?site=register', 'register.html', 'register\\\\.html', 'index.php?site=register'),
(54, 'search.html', 'index.php?site=search', 'a:0:{}', 'index\\\\.php\\\\?site=search', 'search.html', 'search\\\\.html', 'index.php?site=search'),
(55, 'search/results.html', 'index.php?site=search&action=search', 'a:0:{}', 'index\\\\.php\\\\?site=search[&|&amp;]*action=search', 'search/results.html', 'search\\\\/results\\\\.html', 'index.php?site=search&action=search'),
(56, 'search/submit.html', 'search.php', 'a:0:{}', 'search\\\\.php', 'search/submit.html', 'search\\\\/submit\\\\.html', 'search.php'),
(57, 'server_rules.html', 'index.php?site=server_rules', 'a:0:{}', 'index\\\\.php\\\\?site=server_rules', 'server_rules.html', 'server_rules\\\\.html', 'index.php?site=server_rules'),
(58, 'server.html', 'index.php?site=servers', 'a:0:{}', 'index\\\\.php\\\\?site=servers', 'server.html', 'server\\\\.html', 'index.php?site=servers'),
(59, 'sponsors.html', 'index.php?site=sponsors', 'a:0:{}', 'index\\\\.php\\\\?site=sponsors', 'sponsors.html', 'sponsors\\\\.html', 'index.php?site=sponsors'),
(60, 'squads.html', 'index.php?site=squads', 'a:0:{}', 'index\\\\.php\\\\?site=squads', 'squads.html', 'squads\\\\.html', 'index.php?site=squads'),
(61, 'squads/{squadID}.html', 'index.php?site=squads&action=show&squadID={squadID}', 'a:1:{s:7:\"squadID\";s:7:\"integer\";}', 'index\\\\.php\\\\?site=squads[&|&amp;]*action=show[&|&amp;]*squadID=([0-9]+)', 'squads/$3.html', 'squads\\\\/([0-9]+?)\\\\.html', 'index.php?site=squads&action=show&squadID=$1'),
(62, 'static/{staticID}.html', 'index.php?site=static&staticID={staticID}', 'a:1:{s:8:\"staticID\";s:7:\"integer\";}', 'index\\\\.php\\\\?site=static[&|&amp;]*staticID=([0-9]+)', 'static/$3.html', 'static\\\\/([0-9]+?)\\\\.html', 'index.php?site=static&staticID=$1'),
(63, 'todo.html', 'index.php?site=todo', 'a:0:{}', 'index\\\\.php\\\\?site=todo', 'todo.html', 'todo\\\\.html', 'index.php?site=todo'),
(64, 'twitter.html', 'index.php?site=twitter', 'a:0:{}', 'index\\\\.php\\\\?site=twitter', 'twitter.html', 'twitter\\\\.html', 'index.php?site=twitter'),
(65, 'userlist.html', 'index.php?site=userlist', 'a:0:{}', 'index\\\\.php\\\\?site=userlist', 'userlist.html', 'userlist\\\\.html', 'index.php?site=userlist'),
(66, 'videos.html', 'index.php?site=videos', 'a:0:{}', 'index\\\\.php\\\\?site=videos', 'videos.html', 'videos\\\\.html', 'index.php?site=videos'),
(67, 'videos/{videosID}.html', 'index.php?site=videos&action=watch&videosID={videosID}', 'a:1:{s:8:\"videosID\";s:7:\"integer\";}', 'index\\\\.php\\\\?site=videos[&|&amp;]*action=watch[&|&amp;]*videosID=([0-9]+)', 'videos/$3.html', 'videos\\\\/([0-9]+?)\\\\.html', 'index.php?site=videos&action=watch&videosID=$1'),
(68, 'whoisonline.html', 'index.php?site=whoisonline', 'a:0:{}', 'index\\\\.php\\\\?site=whoisonline', 'whoisonline.html', 'whoisonline\\\\.html', 'index.php?site=whoisonline'),
(69, 'whoisonline.html#was', 'index.php?site=whoisonline#was', 'a:0:{}', 'index\\\\.php\\\\?site=whoisonline#was', 'whoisonline.html#was', 'whoisonline\\\\.html#was', 'index.php?site=whoisonline#was'),
(70, 'whoisonline/{sort}/{type}.html', 'index.php?site=whoisonline&sort={sort}&type={type}', 'a:2:{s:4:\"sort\";s:6:\"string\";s:4:\"type\";s:6:\"string\";}', 'index\\\\.php\\\\?site=whoisonline[&|&amp;]*sort=(\\\\w*?)[&|&amp;]*type=(\\\\w*?)', 'whoisonline/$3/$4.html', 'whoisonline\\\\/(\\\\w*?)\\\\/(\\\\w*?)\\\\.html', 'index.php?site=whoisonline&sort=$1&type=$2'),
(71, 'forum/topic/{topicID}.html', 'index.php?site=forum_topic&topic={topicID}', 'a:1:{s:7:\"topicID\";s:7:\"integer\";}', 'index\\\\.php\\\\?site=forum_topic[&|&amp;]*topic=([0-9]+)', 'forum/topic/$3.html', 'forum\\\\/topic\\\\/([0-9]+?)\\\\.html', 'index.php?site=forum_topic&topic=$1'),
(72, 'myprofile/deleteaccount.html', 'index.php?site=myprofile&action=deleteaccount', 'a:0:{}', 'index\\\\.php\\\\?site=myprofile[&|&amp;]*action=deleteaccount', 'myprofile/deleteaccount.html', 'myprofile\\\\/deleteaccount\\\\.html', 'index.php?site=myprofile&action=deleteaccount'),
(78, 'news/{page}.html', 'index.php?site=news&page={page}', 'a:1:{s:4:\"page\";s:7:\"integer\";}', 'index\\\\.php\\\\?site=news[&|&amp;]*page=([0-9]+)', 'news/$3.html', 'news\\\\/([0-9]+?)\\\\.html', 'index.php?site=news&page=$1'),
(79, 'shoutbox.html', 'index.php?site=shoutbox_content&action=showall', 'a:0:{}', 'index\\\\.php\\\\?site=shoutbox_content[&|&amp;]*action=showall', 'shoutbox.html', 'shoutbox\\\\.html', 'index.php?site=shoutbox_content&action=showall'),
(74, 'partners.html', 'index.php?site=partners', 'a:0:{}', 'index\\\\.php\\\\?site=partners', 'partners.html', 'partners\\\\.html', 'index.php?site=partners'),
(75, 'streams.html', 'index.php?site=streams', 'a:0:{}', 'index\\\\.php\\\\?site=streams', 'streams.html', 'streams\\\\.html', 'index.php?site=streams'),
(81, 'streams/{streamID}.html', 'index.php?site=streams&id={streamID}', 'a:1:{s:8:\"streamID\";s:7:\"integer\";}', 'index\\\\.php\\\\?site=streams[&|&amp;]*id=([0-9]+)', 'streams/$3.html', 'streams\\\\/([0-9]+?)\\\\.html', 'index.php?site=streams&id=$1'),
(77, 'forum_topic/{topicID}/{type}/{page}.html', 'index.php?site=forum_topic&topic={topicID}&type={type}&page={page}', 'a:3:{s:7:\"topicID\";s:6:\"string\";s:4:\"type\";s:6:\"string\";s:4:\"page\";s:7:\"integer\";}', 'index\\\\.php\\\\?site=forum_topic[&|&amp;]*topic=(\\\\w*?)[&|&amp;]*type=(\\\\w*?)[&|&amp;]*page=([0-9]+)', 'forum_topic/$3/$4/$5.html', 'forum_topic\\\\/(\\\\w*?)\\\\/(\\\\w*?)\\\\/([0-9]+?)\\\\.html', 'index.php?site=forum_topic&topic=$1&type=$2&page=$3'),
(80, 'calendar.html', 'index.php?site=calendar', 'a:0:{}', 'index\\\\.php\\\\?site=calendar', 'calendar.html', 'calendar\\\\.html', 'index.php?site=calendar'),
(82, 'shoutbox.html', 'index.php?site=shoutbox_content', 'a:0:{}', 'index\\\\.php\\\\?site=shoutbox_content', 'shoutbox.html', 'shoutbox\\\\.html', 'index.php?site=shoutbox_content'),
(83, 'candidature.html', 'index.php?site=candidature', 'a:0:{}', 'index\\\\.php\\\\?site=candidature', 'candidature.html', 'candidature\\\\.html', 'index.php?site=candidature'),
(84, 'candidature/new.html', 'index.php?site=candidature&action=new', 'a:0:{}', 'index\\\\.php\\\\?site=candidature[&|&amp;]*action=new', 'candidature/new.html', 'candidature\\\\/new\\\\.html', 'index.php?site=candidature&action=new'),
(85, 'loginoverview.html', 'index.php?site=loginoverview', 'a:0:{}', 'index\\\\.php\\\\?site=loginoverview', 'loginoverview.html', 'loginoverview\\\\.html', 'index.php?site=loginoverview'),
(86, 'guestbook.html', 'index.php?site=guestbook', 'a:0:{}', 'index\\\\.php\\\\?site=guestbook', 'guestbook.html', 'guestbook\\\\.html', 'index.php?site=guestbook')");



if ($transaction->successful()) {
        return array('status' => 'success', 'message' => 'Updated from Webspell NOR 1.2.5 to Webspell RM 2.0.2 - 3');
    } else {
        return array('status' => 'fail', 'message' => 'Failed to update to Webspell-RM 2.0.2 - 3<br/>' . $transaction->getError());
    }

}

function update_nor_rm202_4($_database)
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
  PRIMARY KEY  (`mnavID`)
) AUTO_INCREMENT=1
  DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");
  
  $transaction->addQuery("INSERT INTO `".PREFIX ."navigation_website_main` (`mnavID`, `name`, `url`, `default`, `sort`, `isdropdown`) VALUES
(1, '{[de]}HAUPT{[en]}MAIN{[pl]}STRONA GLÓWNA{[it]}PRINCIPALE', '#', 1, 1, 1),
(2, '{[de]}TEAM{[en]}TEAM{[pl]}DRUZYNA{[it]}TEAM', '#', 1, 2, 1),
(3, '{[de]}GEMEINSCHAFT{[en]}COMMUNITY{[pl]}SPOLECZNOSC{[it]}COMMUNITY', '#', 1, 3, 1),
(4, '{[de]}MEDIEN{[en]}MEDIA{[pl]}MEDIA{[it]}MEDIA', '#', 1, 4, 1),
(5, '{[de]}SONSTIGES{[en]}MISCELLANEOUS{[pl]}RÓZNE{[it]}VARIE', '#', 1, 5, 1)");

$transaction->addQuery("ALTER TABLE `" . PREFIX . "navigation_sub` RENAME TO `" . PREFIX ."navigation_website_sub`");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "navigation_website_sub` CHANGE `mnav_ID` `mnavID` varchar(11) NOT NULL");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "navigation_website_sub` CHANGE `link` `url` varchar(255) NOT NULL");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "navigation_website_sub` ADD modulname varchar(100) NOT NULL");

$transaction->addQuery("INSERT INTO `".PREFIX ."navigation_website_sub` (`snavID`, `mnavID`, `name`, `modulname`, `url`, `sort`, `indropdown`) VALUES
('', 5, '{[de]}Datenschutz-Bestimmungen{[en]}Privacy Policy{[it]}Informativa sulla privacy', 'privacy_policy', 'index.php?site=privacy_policy', 1, 1)");

$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "settings_themes`");
  $transaction->addQuery("CREATE TABLE `" . PREFIX . "settings_themes` (
  `themeID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `modulname` varchar(100) NOT NULL,
  `active` int(11) DEFAULT NULL,
  `version` varchar(11) NOT NULL,
  `sort` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`themeID`)
) AUTO_INCREMENT=2
  DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");


$transaction->addQuery("INSERT IGNORE INTO `" . PREFIX . "settings_themes` (`themeID`, `name`, `modulname`, `active`, `version`, `sort`) VALUES
(1, 'default', 'default', 1, 1.1, 1)");


if ($transaction->successful()) {
        return array('status' => 'success', 'message' => 'Updated from Webspell NOR 1.2.5 to Webspell RM 2.0.2 - 4');
    } else {
        return array('status' => 'fail', 'message' => 'Failed to update to Webspell-RM 2.0.2 - 4<br/>' . $transaction->getError());
    }

}

function update_nor_rm202_5($_database)
{
    $transaction = new Transaction($_database);



  $transaction->addQuery("ALTER TABLE `" . PREFIX . "settings` DROP `news`");
  $transaction->addQuery("ALTER TABLE `" . PREFIX . "settings` DROP `newsarchiv`");
  $transaction->addQuery("ALTER TABLE `" . PREFIX . "settings` DROP `headlines`");
  $transaction->addQuery("ALTER TABLE `" . PREFIX . "settings` DROP `headlineschars`");
  $transaction->addQuery("ALTER TABLE `" . PREFIX . "settings` DROP `topnewschars`");
  $transaction->addQuery("ALTER TABLE `" . PREFIX . "settings` DROP `articles`");
  $transaction->addQuery("ALTER TABLE `" . PREFIX . "settings` DROP `latestarticles`");
  $transaction->addQuery("ALTER TABLE `" . PREFIX . "settings` DROP `articleschars`");
  $transaction->addQuery("ALTER TABLE `" . PREFIX . "settings` DROP `clanwars`");
  $transaction->addQuery("ALTER TABLE `" . PREFIX . "settings` DROP `results`");
  $transaction->addQuery("ALTER TABLE `" . PREFIX . "settings` DROP `upcoming`");
  $transaction->addQuery("ALTER TABLE `" . PREFIX . "settings` DROP `shoutbox`");
  $transaction->addQuery("ALTER TABLE `" . PREFIX . "settings` DROP `sbrefresh`");
  $transaction->addQuery("ALTER TABLE `" . PREFIX . "settings` DROP `awards`");
  $transaction->addQuery("ALTER TABLE `" . PREFIX . "settings` DROP `demos`");
  $transaction->addQuery("ALTER TABLE `" . PREFIX . "settings` DROP `guestbook`");
  $transaction->addQuery("ALTER TABLE `" . PREFIX . "settings` DROP `feedback`");
  $transaction->addQuery("ALTER TABLE `" . PREFIX . "settings` DROP `users`");
  $transaction->addQuery("ALTER TABLE `" . PREFIX . "settings` DROP `profilelast`");
  $transaction->addQuery("ALTER TABLE `" . PREFIX . "settings` DROP `topnewsID`");
  $transaction->addQuery("ALTER TABLE `" . PREFIX . "settings` DROP `gb_info`");
  $transaction->addQuery("ALTER TABLE `" . PREFIX . "settings` DROP `picsize_l`");
  $transaction->addQuery("ALTER TABLE `" . PREFIX . "settings` DROP `picsize_h`");
  $transaction->addQuery("ALTER TABLE `" . PREFIX . "settings` DROP `pictures`");
  $transaction->addQuery("ALTER TABLE `" . PREFIX . "settings` DROP `publicadmin`");
  $transaction->addQuery("ALTER TABLE `" . PREFIX . "settings` DROP `thumbwidth`");
  $transaction->addQuery("ALTER TABLE `" . PREFIX . "settings` DROP `usergalleries`");
  $transaction->addQuery("ALTER TABLE `" . PREFIX . "settings` DROP `maxusergalleries`");
  $transaction->addQuery("ALTER TABLE `" . PREFIX . "settings` DROP `autoresize`");
  $transaction->addQuery("ALTER TABLE `" . PREFIX . "settings` DROP `user_guestbook`");
  $transaction->addQuery("ALTER TABLE `" . PREFIX . "settings` DROP `sc_files`");
  $transaction->addQuery("ALTER TABLE `" . PREFIX . "settings` DROP `sc_demos`");
  $transaction->addQuery("ALTER TABLE `" . PREFIX . "settings` DROP `spamapikey`");
  $transaction->addQuery("ALTER TABLE `" . PREFIX . "settings` DROP `spamapihost`");

  $transaction->addQuery("ALTER TABLE `" . PREFIX . "settings` ADD title varchar(255) NOT NULL");
  $transaction->addQuery("ALTER TABLE `" . PREFIX . "settings` ADD startpage varchar(255) NOT NULL");
  $transaction->addQuery("ALTER TABLE `" . PREFIX . "settings` ADD ftpip varchar(100) NOT NULL");
  $transaction->addQuery("ALTER TABLE `" . PREFIX . "settings` ADD ftpport int(11) NOT NULL");
  $transaction->addQuery("ALTER TABLE `" . PREFIX . "settings` ADD ftppath varchar(100) NOT NULL");
  $transaction->addQuery("ALTER TABLE `" . PREFIX . "settings` ADD ftpuser varchar(50) NOT NULL");
  $transaction->addQuery("ALTER TABLE `" . PREFIX . "settings` ADD ftppw varchar(100) NULL");


if ($transaction->successful()) {
        return array('status' => 'success', 'message' => 'Updated from Webspell NOR 1.2.5 to Webspell RM 2.0.2 - 5');
    } else {
        return array('status' => 'fail', 'message' => 'Failed to update to Webspell-RM 2.0.2 - 5<br/>' . $transaction->getError());
    }

}

function update_nor_rm202_6($_database)
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

$transaction->addQuery("INSERT INTO " . PREFIX . "settings_startpage (`pageID`, `title`, `startpage_text`, `date`) VALUES
(1, '{[de]}Willkommen zu Webspell | RM{[en]}Welcome to Webspell | RM{[pl]}Witamy w Webspell | RM', '{[de]}\r\n<p><strong><u>Was ist Webspell RM?</u></strong><br />\r\n<br />\r\nWebspell RM ist ein Clan &amp; Gamer CMS (<em>Content Management System</em>). Es basiert auf PHP, MySQL und der letzten webSPELL.org GitHub Version (4.3.0). Webspell RM l&auml;uft unter der General Public License. Siehe auch <a href=\"http://wiki.webspell-rm.de/index.php?site=static&amp;staticID=4\" target=\"_blank\">Lizenzvereinbarung</a>.</p>\r\n\r\n<p style=\"text-align:center\"><a class=\"btn btn-info\" href=\"http://demo.webspell-rm.de/\" rel=\"noopener\" role=\"button\" target=\"_blank\"><strong><u>WEBSPELL RM DEMO</u></strong></a> <a class=\"btn btn-success\" href=\"https://webspell-rm.de/index.php?site=forum\" rel=\"noopener\" role=\"button\" target=\"_blank\"><strong><u>WEBSPELL RM SUPPORT</u></strong></a></p>\r\n\r\n<p><strong><u>Was bietet Webspell | RM?</u></strong><br />\r\n<br />\r\nWebspell RM basiert auf Bootstrap und ist einfach anzupassen via Dashboard. Theoretisch sind alle Bootstrap Templates verwendbar. Als Editor wir der TinyMCE Editor verwendet. Das CMS ist Multi-Language f&auml;hig und liefert von Haus aus viele Sprachen mit. Das beliebte reCAPTCHA wurde als Spam Schutz integriert. Alle Plugins sind via Webspell RM Installer einfach und problemlos zu installieren.</p>\r\n\r\n<p><strong><u>Beispiel f&uuml;r die Startseite:</u> </strong><em>(dies kannst du bearbeiten unter: <strong>Administration ? Systemverwaltung ? <a href=\"../admin/admincenter.php?site=startpage\" target=\"_blank\">Startseite</a></strong>)</em></p>\r\n\r\n<div class=\"container\">\r\n<div class=\"row\">\r\n<div class=\"col-xs-12\">\r\n<div class=\"nav nav-fill nav-tabs\" id=\"nav-tab\"><a aria-controls=\"nav-home\" aria-selected=\"true\" class=\"nav-item nav-link active\" data-toggle=\"tab\" href=\"#nav-home\" id=\"nav-home-tab\" role=\"tab\">Startseite</a> <a aria-controls=\"nav-profile\" aria-selected=\"false\" class=\"nav-item nav-link\" data-toggle=\"tab\" href=\"#nav-profile\" id=\"nav-profile-tab\" role=\"tab\">Profil</a> <a aria-controls=\"nav-contact\" aria-selected=\"false\" class=\"nav-item nav-link\" data-toggle=\"tab\" href=\"#nav-contact\" id=\"nav-contact-tab\" role=\"tab\">Kontakt</a> <a aria-controls=\"nav-about\" aria-selected=\"false\" class=\"nav-item nav-link\" data-toggle=\"tab\" href=\"#nav-about\" id=\"nav-about-tab\" role=\"tab\">&Uuml;ber</a></div>\r\n\r\n<div class=\"px-3 px-sm-0 py-3 tab-content\" id=\"nav-tabContent\">\r\n<div class=\"active fade show tab-pane\" id=\"nav-home\">Et et consectetur ipsum labore excepteur est proident excepteur ad velit occaecat qui minim occaecat veniam. Fugiat veniam incididunt anim aliqua enim pariatur veniam sunt est aute sit dolor anim. Velit non irure adipisicing aliqua ullamco irure incididunt irure non esse consectetur nostrud minim non minim occaecat. Amet duis do nisi duis veniam non est eiusmod tempor incididunt tempor dolor ipsum in qui sit. Exercitation mollit sit culpa nisi culpa non adipisicing reprehenderit do dolore. Duis reprehenderit occaecat anim ullamco ad duis occaecat ex.</div>\r\n\r\n<div class=\"fade tab-pane\" id=\"nav-profile\">Et et consectetur ipsum labore excepteur est proident excepteur ad velit occaecat qui minim occaecat veniam. Fugiat veniam incididunt anim aliqua enim pariatur veniam sunt est aute sit dolor anim. Velit non irure adipisicing aliqua ullamco irure incididunt irure non esse consectetur nostrud minim non minim occaecat. Amet duis do nisi duis veniam non est eiusmod tempor incididunt tempor dolor ipsum in qui sit. Exercitation mollit sit culpa nisi culpa non adipisicing reprehenderit do dolore. Duis reprehenderit occaecat anim ullamco ad duis occaecat ex.</div>\r\n\r\n<div class=\"fade tab-pane\" id=\"nav-contact\">Et et consectetur ipsum labore excepteur est proident excepteur ad velit occaecat qui minim occaecat veniam. Fugiat veniam incididunt anim aliqua enim pariatur veniam sunt est aute sit dolor anim. Velit non irure adipisicing aliqua ullamco irure incididunt irure non esse consectetur nostrud minim non minim occaecat. Amet duis do nisi duis veniam non est eiusmod tempor incididunt tempor dolor ipsum in qui sit. Exercitation mollit sit culpa nisi culpa non adipisicing reprehenderit do dolore. Duis reprehenderit occaecat anim ullamco ad duis occaecat ex.</div>\r\n\r\n<div class=\"fade tab-pane\" id=\"nav-about\">Et et consectetur ipsum labore excepteur est proident excepteur ad velit occaecat qui minim occaecat veniam. Fugiat veniam incididunt anim aliqua enim pariatur veniam sunt est aute sit dolor anim. Velit non irure adipisicing aliqua ullamco irure incididunt irure non esse consectetur nostrud minim non minim occaecat. Amet duis do nisi duis veniam non est eiusmod tempor incididunt tempor dolor ipsum in qui sit. Exercitation mollit sit culpa nisi culpa non adipisicing reprehenderit do dolore. Duis reprehenderit occaecat anim ullamco ad duis occaecat ex.</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"container\">\r\n<div class=\"mb-3 row\">\r\n<div class=\"col-md-4\">\r\n<div class=\"card-content\">\r\n<div class=\"card-img\"><img class=\"img-fluid\" alt=\"\" src=\"https://i.imgur.com/rbE6jIV.jpg\" style=\"margin-bottom:10px; margin-top:10px\" />\r\n<h4>Example small Heading</h4>\r\n</div>\r\n\r\n<div class=\"card-desc\">\r\n<h3>Example BIG Heading</h3>\r\n\r\n<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Laboriosam, voluptatum! Dolor quo, perspiciatis voluptas totam</p>\r\n<a class=\"btn-card btn btn-lg btn-primary\" href=\"#\">Read More</a></div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-md-4\">\r\n<div class=\"card-content\">\r\n<div class=\"card-img\"><img class=\"img-fluid\" alt=\"\" src=\"https://i.imgur.com/Gd6p7ST.jpg\" style=\"margin-bottom:10px; margin-top:10px\" />\r\n<h4>Example small Heading 2</h4>\r\n</div>\r\n\r\n<div class=\"card-desc\">\r\n<h3>Example BIG Heading 2</h3>\r\n\r\n<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Laboriosam, voluptatum! Dolor quo, perspiciatis voluptas totam</p>\r\n<a class=\"btn-card btn btn-lg btn-primary\" href=\"#\">Read More</a></div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-md-4\">\r\n<div class=\"card-content\">\r\n<div class=\"card-img\"><img class=\"img-fluid\" alt=\"\" src=\"https://i.imgur.com/CBCmxAM.jpg\" style=\"margin-bottom:10px; margin-top:10px\" />\r\n<h4>Example small Heading 3</h4>\r\n</div>\r\n\r\n<div class=\"card-desc\">\r\n<h3>Example BIG Heading 3</h3>\r\n\r\n<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Laboriosam, voluptatum! Dolor quo, perspiciatis voluptas totam</p>\r\n<a class=\"btn-card btn btn-lg btn-primary\" href=\"#\">Read More</a></div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n{[en]}\r\n\r\n<p><strong><u>What is Webspell RM?</u></strong><br />\r\n<br />\r\nWebspell RM is a Clan &amp; Gamer CMS (Content Management System). It is based on PHP, MySQL and the latest webSPELL.org GitHub version (4.3.0). Webspell RM runs under the General Public License. See also license agreement <a href=\"http://wiki.webspell-rm.de/index.php?site=static&amp;staticID=4\" target=\"_blank\">license agreement</a>.</p>\r\n\r\n<p style=\"text-align:center\"><a class=\"btn btn-info\" href=\"http://demo.webspell-rm.de/\" rel=\"noopener\" role=\"button\" target=\"_blank\"><strong><u>WEBSPELL RM DEMO</u></strong></a> <a class=\"btn btn-success\" href=\"https://webspell-rm.de/index.php?site=forum\" rel=\"noopener\" role=\"button\" target=\"_blank\"><strong><u>WEBSPELL RM SUPPORT</u></strong></a></p>\r\n\r\n<p><strong><u>What does Webspell | RM offer?</u></strong><br />\r\n<br />\r\nWebspell RM is based on bootstrap and it is easy to customize via dashboard. Theoretically, all bootstrap templates can be used. As editor we use the TinyMCE editor. The CMS is multi-language capable and comes with many native languages. The popular reCAPTCHA was integrated as spam protection. All plugins are easy to install via Webspell RM Installer.</p>\r\n\r\n<p><strong><u>Example for the homepage:</u><em> </em></strong><em>(this can be edit under: <strong>Admin ? Settings ? <a href=\"../admin/admincenter.php?site=startpage\" target=\"_blank\">Start Page</a></strong>)</em></p>\r\n\r\n<div class=\"container\">\r\n<div class=\"row\">\r\n<div class=\"col-xs-12\">\r\n<div class=\"nav nav-fill nav-tabs\" id=\"nav-tab\"><a aria-controls=\"nav-home\" aria-selected=\"true\" class=\"nav-item nav-link active\" data-toggle=\"tab\" href=\"#nav-home\" id=\"nav-home-tab\" role=\"tab\">Homepage</a> <a aria-controls=\"nav-profile\" aria-selected=\"false\" class=\"nav-item nav-link\" data-toggle=\"tab\" href=\"#nav-profile\" id=\"nav-profile-tab\" role=\"tab\">Profile</a> <a aria-controls=\"nav-contact\" aria-selected=\"false\" class=\"nav-item nav-link\" data-toggle=\"tab\" href=\"#nav-contact\" id=\"nav-contact-tab\" role=\"tab\">Contact</a> <a aria-controls=\"nav-about\" aria-selected=\"false\" class=\"nav-item nav-link\" data-toggle=\"tab\" href=\"#nav-about\" id=\"nav-about-tab\" role=\"tab\">About</a></div>\r\n\r\n<div class=\"px-3 px-sm-0 py-3 tab-content\" id=\"nav-tabContent\">\r\n<div class=\"active fade show tab-pane\" id=\"nav-home\">Et et consectetur ipsum labore excepteur est proident excepteur ad velit occaecat qui minim occaecat veniam. Fugiat veniam incididunt anim aliqua enim pariatur veniam sunt est aute sit dolor anim. Velit non irure adipisicing aliqua ullamco irure incididunt irure non esse consectetur nostrud minim non minim occaecat. Amet duis do nisi duis veniam non est eiusmod tempor incididunt tempor dolor ipsum in qui sit. Exercitation mollit sit culpa nisi culpa non adipisicing reprehenderit do dolore. Duis reprehenderit occaecat anim ullamco ad duis occaecat ex.</div>\r\n\r\n<div class=\"fade tab-pane\" id=\"nav-profile\">Et et consectetur ipsum labore excepteur est proident excepteur ad velit occaecat qui minim occaecat veniam. Fugiat veniam incididunt anim aliqua enim pariatur veniam sunt est aute sit dolor anim. Velit non irure adipisicing aliqua ullamco irure incididunt irure non esse consectetur nostrud minim non minim occaecat. Amet duis do nisi duis veniam non est eiusmod tempor incididunt tempor dolor ipsum in qui sit. Exercitation mollit sit culpa nisi culpa non adipisicing reprehenderit do dolore. Duis reprehenderit occaecat anim ullamco ad duis occaecat ex.</div>\r\n\r\n<div class=\"fade tab-pane\" id=\"nav-contact\">Et et consectetur ipsum labore excepteur est proident excepteur ad velit occaecat qui minim occaecat veniam. Fugiat veniam incididunt anim aliqua enim pariatur veniam sunt est aute sit dolor anim. Velit non irure adipisicing aliqua ullamco irure incididunt irure non esse consectetur nostrud minim non minim occaecat. Amet duis do nisi duis veniam non est eiusmod tempor incididunt tempor dolor ipsum in qui sit. Exercitation mollit sit culpa nisi culpa non adipisicing reprehenderit do dolore. Duis reprehenderit occaecat anim ullamco ad duis occaecat ex.</div>\r\n\r\n<div class=\"fade tab-pane\" id=\"nav-about\">Et et consectetur ipsum labore excepteur est proident excepteur ad velit occaecat qui minim occaecat veniam. Fugiat veniam incididunt anim aliqua enim pariatur veniam sunt est aute sit dolor anim. Velit non irure adipisicing aliqua ullamco irure incididunt irure non esse consectetur nostrud minim non minim occaecat. Amet duis do nisi duis veniam non est eiusmod tempor incididunt tempor dolor ipsum in qui sit. Exercitation mollit sit culpa nisi culpa non adipisicing reprehenderit do dolore. Duis reprehenderit occaecat anim ullamco ad duis occaecat ex.</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"container\">\r\n<div class=\"mb-3 row\">\r\n<div class=\"col-md-4\">\r\n<div class=\"card-content\">\r\n<div class=\"card-img\"><img class=\"img-fluid\" alt=\"\" src=\"https://i.imgur.com/rbE6jIV.jpg\" style=\"margin-bottom:10px; margin-top:10px\" />\r\n<h4>Example small Heading</h4>\r\n</div>\r\n\r\n<div class=\"card-desc\">\r\n<h3>Example BIG Heading</h3>\r\n\r\n<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Laboriosam, voluptatum! Dolor quo, perspiciatis voluptas totam</p>\r\n<a class=\"btn-card btn btn-lg btn-primary\" href=\"#\">Read More</a></div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-md-4\">\r\n<div class=\"card-content\">\r\n<div class=\"card-img\"><img class=\"img-fluid\" alt=\"\" src=\"https://i.imgur.com/Gd6p7ST.jpg\" style=\"margin-bottom:10px; margin-top:10px\" />\r\n<h4>Example small Heading 2</h4>\r\n</div>\r\n\r\n<div class=\"card-desc\">\r\n<h3>Example BIG Heading 2</h3>\r\n\r\n<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Laboriosam, voluptatum! Dolor quo, perspiciatis voluptas totam</p>\r\n<a class=\"btn-card btn btn-lg btn-primary\" href=\"#\">Read More</a></div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-md-4\">\r\n<div class=\"card-content\">\r\n<div class=\"card-img\"><img class=\"img-fluid\" alt=\"\" src=\"https://i.imgur.com/CBCmxAM.jpg\" style=\"margin-bottom:10px; margin-top:10px\" />\r\n<h4>Example small Heading 3</h4>\r\n</div>\r\n\r\n<div class=\"card-desc\">\r\n<h3>Example BIG Heading 3</h3>\r\n\r\n<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Laboriosam, voluptatum! Dolor quo, perspiciatis voluptas totam</p>\r\n<a class=\"btn-card btn btn-lg btn-primary\" href=\"#\">Read More</a></div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n 
{[it]}\r\n\r\n<p><strong><u>Che cosa è Webspell RM?</u></strong><br />\r\n<br />\r\nWebspell RM un Clan &amp; Gamer CMS (Sistema di gestione dei contenuti). Si basa su PHP, MySQL e l&rsquo; ultima versione GSP di WebSPELL.org (4.3.0). Webspell RM funziona sotto la Licenza pubblica generale. Vedi anche il contratto di licenza <a href=\"http://wiki.webspell-rm.de/index.php?site=static&amp;staticID=4\" target=\"_blank\">accordo di licenza</a>.</p>\r\n\r\n<p style=\"text-align:center\"><a class=\"btn btn-info\" href=\"http://demo.webspell-rm.de/\" rel=\"noopener\" role=\"button\" target=\"_blank\"><strong><u>WEBSPELL RM DEMO</u></strong></a> <a class=\"btn btn-success\" href=\"https://webspell-rm.de/index.php?site=forum\" rel=\"noopener\" role=\"button\" target=\"_blank\"><strong><u>SUPPORTO WEBSPELL RM</u></strong></a></p>\r\n\r\n<p><strong><u>Cosa Offre Webspell | RM?</u></strong><br />\r\n<br />\r\nWebspell RM si basa su bootstrap ed è facile da personalizzare tramite dashboard. Teoricamente, è possibile utilizzare tutti i modelli di bootstrap. Come editor usiamo l&rsquo; editor CKEditor 4. Il CMS è multi-lingua e viene fornito con molte lingue native. Il popolare reCAPTCHA è stato integrato come protezione antispam. Tutti i plug-in sono facili da installare tramite Webspell RM Installer.</p>\r\n\r\n<p><strong><u>Esempio per la homepage:</u><em> </em></strong><em>(questo può essere modificato sotto: <strong>Admin? Impostazioni ? <a href=\"../admin/admincenter.php?site=startpage\" target=\"_blank\">Pagina iniziale</a></strong>)</em></p>\r\n\r\n<div class=\"container\">\r\n<div class=\"row\">\r\n<div class=\"col-xs-12\">\r\n<div class=\"nav nav-fill nav-tabs\" id=\"nav-tab\"><a aria-controls=\"nav-home\" aria-selected=\"true\" class=\"nav-item nav-link active\" data-toggle=\"tab\" href=\"#nav-home\" id=\"nav-home-tab\" role=\"tab\">Homepage</a> <a aria-controls=\"nav-profile\" aria-selected=\"false\" class=\"nav-item nav-link\" data-toggle=\"tab\" href=\"#nav-profile\" id=\"nav-profile-tab\" role=\"tab\">Profilo</a> <a aria-controls=\"nav-contact\" aria-selected=\"false\" class=\"nav-item nav-link\" data-toggle=\"tab\" href=\"#nav-contact\" id=\"nav-contact-tab\" role=\"tab\">Contatti</a> <a aria-controls=\"nav-about\" aria-selected=\"false\" class=\"nav-item nav-link\" data-toggle=\"tab\" href=\"#nav-about\" id=\"nav-about-tab\" role=\"tab\">Informazioni</a></div>\r\n\r\n<div class=\"px-3 px-sm-0 py-3 tab-content\" id=\"nav-tabContent\">\r\n<div class=\"active fade show tab-pane\" id=\"nav-home\">Et et consectetur ipsum labore excepteur est proident excepteur ad velit occaecat qui minim occaecat veniam. Fugiat veniam incididunt anim aliqua enim pariatur veniam sunt est aute sit dolor anim. Velit non irure adipisicing aliqua ullamco irure incididunt irure non esse consectetur nostrud minim non minim occaecat. Amet duis do nisi duis veniam non est eiusmod tempor incididunt tempor dolor ipsum in qui sit. Exercitation mollit sit culpa nisi culpa non adipisicing reprehenderit do dolore. Duis reprehenderit occaecat anim ullamco ad duis occaecat ex.</div>\r\n\r\n<div class=\"fade tab-pane\" id=\"nav-profile\">Et et consectetur ipsum labore excepteur est proident excepteur ad velit occaecat qui minim occaecat veniam. Fugiat veniam incididunt anim aliqua enim pariatur veniam sunt est aute sit dolor anim. Velit non irure adipisicing aliqua ullamco irure incididunt irure non esse consectetur nostrud minim non minim occaecat. Amet duis do nisi duis veniam non est eiusmod tempor incididunt tempor dolor ipsum in qui sit. Exercitation mollit sit culpa nisi culpa non adipisicing reprehenderit do dolore. Duis reprehenderit occaecat anim ullamco ad duis occaecat ex.</div>\r\n\r\n<div class=\"fade tab-pane\" id=\"nav-contact\">Et et consectetur ipsum labore excepteur est proident excepteur ad velit occaecat qui minim occaecat veniam. Fugiat veniam incididunt anim aliqua enim pariatur veniam sunt est aute sit dolor anim. Velit non irure adipisicing aliqua ullamco irure incididunt irure non esse consectetur nostrud minim non minim occaecat. Amet duis do nisi duis veniam non est eiusmod tempor incididunt tempor dolor ipsum in qui sit. Exercitation mollit sit culpa nisi culpa non adipisicing reprehenderit do dolore. Duis reprehenderit occaecat anim ullamco ad duis occaecat ex.</div>\r\n\r\n<div class=\"fade tab-pane\" id=\"nav-about\">Et et consectetur ipsum labore excepteur est proident excepteur ad velit occaecat qui minim occaecat veniam. Fugiat veniam incididunt anim aliqua enim pariatur veniam sunt est aute sit dolor anim. Velit non irure adipisicing aliqua ullamco irure incididunt irure non esse consectetur nostrud minim non minim occaecat. Amet duis do nisi duis veniam non est eiusmod tempor incididunt tempor dolor ipsum in qui sit. Exercitation mollit sit culpa nisi culpa non adipisicing reprehenderit do dolore. Duis reprehenderit occaecat anim ullamco ad duis occaecat ex.</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"container\">\r\n<div class=\"mb-3 row\">\r\n<div class=\"col-md-4\">\r\n<div class=\"card-content\">\r\n<div class=\"card-img\"><img alt=\"\" src=\"https://i.imgur.com/rbE6jIV.jpg\" style=\"margin-bottom:10px; margin-top:10px\" />\r\n<h4>Esempio di Intestazione Piccola</h4>\r\n</div>\r\n\r\n<div class=\"card-desc\">\r\n<h3>Esempio di Intestazione Grande</h3>\r\n\r\n<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Laboriosam, voluptatum! Dolor quo, perspiciatis voluptas totam</p>\r\n<a class=\"btn-card btn btn-lg btn-primary\" href=\"#\">Leggi di più</a></div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-md-4\">\r\n<div class=\"card-content\">\r\n<div class=\"card-img\"><img alt=\"\" src=\"https://i.imgur.com/Gd6p7ST.jpg\" style=\"margin-bottom:10px; margin-top:10px\" />\r\n<h4>Esempio di Intestazione Piccola 2</h4>\r\n</div>\r\n\r\n<div class=\"card-desc\">\r\n<h3>Esempio di Intestazione Grande 2</h3>\r\n\r\n<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Laboriosam, voluptatum! Dolor quo, perspiciatis voluptas totam</p>\r\n<a class=\"btn-card btn btn-lg btn-primary\" href=\"#\">Leggi di più</a></div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-md-4\">\r\n<div class=\"card-content\">\r\n<div class=\"card-img\"><img alt=\"\" src=\"https://i.imgur.com/CBCmxAM.jpg\" style=\"margin-bottom:10px; margin-top:10px\" />\r\n<h4>Esempio di Intestazione Piccola 3</h4>\r\n</div>\r\n\r\n<div class=\"card-desc\">\r\n<h3>Esempio di Intestazione Grande 3</h3>\r\n\r\n<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Laboriosam, voluptatum! Dolor quo, perspiciatis voluptas totam</p>\r\n<a class=\"btn-card btn btn-lg btn-primary\" href=\"#\">Leggi di più</a></div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n
{[pl]}', 1565033094)");


$transaction->addQuery("CREATE TABLE `" . PREFIX . "settings_logo` (
  `logoID` int(11) NOT NULL,
  `logo` varchar(255) NOT NULL
) DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");

$transaction->addQuery("INSERT IGNORE INTO `" . PREFIX . "settings_logo` (`logoID`, `logo`) VALUES
(1, '1.png')");


$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "plugins_widgets`");
  $transaction->addQuery("CREATE TABLE `" . PREFIX . "plugins_widgets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `position` varchar(255) NOT NULL,
  `description` varchar(1024) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `modulname` varchar(100) NOT NULL DEFAULT '',
  `plugin_folder` varchar(255) DEFAULT NULL,
  `widget_file` varchar(255) DEFAULT NULL,
  `sort` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) AUTO_INCREMENT=9
   DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");

$transaction->addQuery("INSERT INTO `".PREFIX ."plugins_widgets` (`id`, `position`, `description`, `name`, `modulname`, `plugin_folder`, `widget_file`, `sort`) VALUES
(1, 'page_navigation_widget', 'Navigation', '', '', NULL, NULL, 1),
(2, 'page_head_widget', 'Page Head', '', '', NULL, NULL, 2),
(3, 'left_side_widget', 'Page Left', '', '', NULL, NULL, 3),
(4, 'right_side_widget', 'Page Right', '', '', NULL, NULL, 4),
(5, 'page_footer_widget', 'Page Footer', '', '', NULL, NULL, 5),
(6, 'center_head_widget', 'Content Head', '', '', NULL, NULL, 6),
(7, 'center_footer_widget', 'Content Foot', '', '', NULL, NULL, 7),
(8, 'page_navigation_widget', NULL, 'Navigation Default', 'navigation_default', 'navigation_default', 'widget_navigation_default_functions.php', 8)"); 


if ($transaction->successful()) {
        return array('status' => 'success', 'message' => 'Updated from Webspell NOR 1.2.5 to Webspell RM 2.0.2 - 6');
    } else {
        return array('status' => 'fail', 'message' => 'Failed to update to Webspell-RM 2.0.2 - 6<br/>' . $transaction->getError());
    }

}

function update_nor_rm202_7($_database)
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


$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "navigation_dashboard_links`");
    $transaction->addQuery("CREATE TABLE `" . PREFIX . "navigation_dashboard_links` (
  `linkID` int(11) NOT NULL AUTO_INCREMENT,
  `catID` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `modulname` varchar(100) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `accesslevel` varchar(255) NOT NULL DEFAULT '',
  `sort` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`linkID`)
) AUTO_INCREMENT=34
 DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");

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


$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "settings_buttons`");
    $transaction->addQuery("CREATE TABLE `" . PREFIX . "settings_buttons` (
  `buttonID` int(11) NOT NULL AUTO_INCREMENT,
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
  `button43` varchar(255) NOT NULL DEFAULT '',
  `button44` varchar(255) NOT NULL DEFAULT '',
  `button45` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`buttonID`)
) AUTO_INCREMENT=2
  DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");

$transaction->addQuery("INSERT IGNORE INTO `" . PREFIX . "settings_buttons` (`buttonID`, `button1`, `button2`, `button3`, `button4`, `button5`, `button6`, `button7`, `button8`, `button9`, `button10`, `button11`, `button12`, `button13`, `button14`, `button15`, `button16`, `button17`, `button18`, `button19`, `button20`, `button21`, `button22`, `button23`, `button24`, `button25`, `button26`, `button27`, `button28`, `button29`, `button30`, `button31`, `button32`, `button33`, `button34`, `button35`, `button36`, `button37`, `button38`, `button39`, `button40`, `button41`, `button42`, `button43`, `button44`, `button45`) VALUES
(1, '#007bff', '#0069d9', '#ffffff', '#007bff', '#0062cc', '#6c757d', '#5a6268', '#ffffff', '#6c757d', '#545b62', '#28a745', '#218838', '#ffffff', '#28a745', '#1e7e34', '#dc3545', '#c82333', '#ffffff', '#dc3545', '#bd2130', '#ffc107', '#e0a800', '#212529', '#ffc107', '#d39e00', '#17a2b8', '#138496', '#ffffff', '#17a2b8', '#117a8b', '#f8f9fa', '#e2e6ea', '#212529', '#f8f9fa', '#dae0e5', '#343a40', '#23272b', '#ffffff', '#343a40', '#1d2124', '#007bff', '#0056b3', '#ffffff', '#ffffff', '#ffffff')"); 




    if ($transaction->successful()) {
        return array('status' => 'success', 'message' => 'Updated from Webspell NOR 1.2.5 to Webspell RM 2.0.2 - 7');
    } else {
        return array('status' => 'fail', 'message' => 'Failed to update to Webspell-RM 2.0.2 - 7<br/>' . $transaction->getError());
    }

}

function update_nor_rm202_8($_database)
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
        return array('status' => 'success', 'message' => 'Updated from Webspell NOR 1.2.5 to Webspell RM 2.0 - 8');
    } else {
        return array('status' => 'fail', 'message' => 'Failed to update to Webspell-RM 2.0 - 8<br/>' . $transaction->getError());
    }
}
?>