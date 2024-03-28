<?php
/**
 *¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
 *                  Webspell-RM      /                        /   /                                          *
 *                  -----------__---/__---__------__----__---/---/-----__---- _  _ -                         *
 *                   | /| /  /___) /   ) (_ `   /   ) /___) /   / __  /     /  /  /                          *
 *                  _|/_|/__(___ _(___/_(__)___/___/_(___ _/___/_____/_____/__/__/_                          *
 *                               Free Content / Management System                                            *
 *                                           /                                                               *
 *¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
 * @version         webspell-rm                                                                              *
 *                                                                                                           *
 * @copyright       2018-2023 by webspell-rm.de                                                              *
 * @support         For Support, Plugins, Templates and the Full Script visit webspell-rm.de                 *
 * @website         <https://www.webspell-rm.de>                                                             *
 * @forum           <https://www.webspell-rm.de/forum.html>                                                  *
 * @wiki            <https://www.webspell-rm.de/wiki.html>                                                   *
 *                                                                                                           *
 *¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
 * @license         Script runs under the GNU GENERAL PUBLIC LICENCE                                         *
 *                  It's NOT allowed to remove this copyright-tag                                            *
 *                  <http://www.fsf.org/licensing/licenses/gpl.html>                                         *
 *                                                                                                           *
 *¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
 * @author          Code based on WebSPELL Clanpackage (Michael Gruber - webspell.at)                        *
 * @copyright       2005-2011 by webspell.org / webspell.info                                                *
 *                                                                                                           *
 *¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
*/

function update_rm_1($_database) {

$transaction = new Transaction($_database);
global $adminname;
global $adminpassword;
global $adminmail;
global $url;
    
$new_pepper = Gen_PasswordPepper();
$adminhash = password_hash($adminpassword.$new_pepper,PASSWORD_BCRYPT,array('cost'=>12));


$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "backups`");
$transaction->addQuery("CREATE TABLE `" . PREFIX . "backups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `createdby` int(11) NOT NULL DEFAULT '0',
  `createdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;");

##############################################################################################################################
##############################################################################################################################
if ($transaction->successful()) {
        return array('status' => 'success', 'message' => '<div class="list-group-item list-group-item-success">&nbsp;Install successful for Webspell RM Database: <i>backups</i> <i class="bi bi-check2"></i></div>');
    } else {
        return array('status' => 'fail', 'message' => '<div class="list-group-item list-group-item-success">Failed to install Webspell-RM Database: <i>backups</i> <i class="bi bi-x-lg"></i></div><br/>' . $transaction->getError());
    }
}
function update_rm_2($_database) {
  $transaction = new Transaction($_database);
##############################################################################################################################
##############################################################################################################################


$transaction->addQuery("DROP TABLE IF EXISTS `".PREFIX."banned_ips`");
$transaction->addQuery("CREATE TABLE IF NOT EXISTS `".PREFIX."banned_ips` (
  `banID` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deltime` int(15) NOT NULL,
  `reason` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`banID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;");

##############################################################################################################################
##############################################################################################################################
if ($transaction->successful()) {
        return array('status' => 'success', 'message' => '<div class="list-group-item list-group-item-success">&nbsp;Install successful for Webspell RM Database: <i>banned_ips</i> <i class="bi bi-check2"></i></div>');
    } else {
        return array('status' => 'fail', 'message' => '- Failed to install Webspell-RM<br/>' . $transaction->getError());
    }
}
function update_rm_3($_database) {
  $transaction = new Transaction($_database);
##############################################################################################################################
##############################################################################################################################

$transaction->addQuery("DROP TABLE IF EXISTS `".PREFIX."captcha`");
$transaction->addQuery("CREATE TABLE IF NOT EXISTS `".PREFIX."captcha` (
  `hash` VARCHAR(255) NOT NULL DEFAULT '',
  `captcha` INT(11) NOT NULL DEFAULT '0',
  `deltime` INT(11) NOT NULL DEFAULT '0',
  PRIMARY KEY  (`hash`)
  ) ENGINE=MyISAM DEFAULT COLLATE utf8_unicode_ci");

##############################################################################################################################
##############################################################################################################################
if ($transaction->successful()) {
        return array('status' => 'success', 'message' => '<div class="list-group-item list-group-item-success">&nbsp;Install successful for Webspell RM Database: <i>captcha</i> <i class="bi bi-check2"></i></div>');
    } else {
        return array('status' => 'fail', 'message' => '- Failed to install Webspell-RM<br/>' . $transaction->getError());
    }
}
function update_rm_4($_database) {
  $transaction = new Transaction($_database);
##############################################################################################################################
##############################################################################################################################

global $adminmail;
$transaction->addQuery("DROP TABLE IF EXISTS `".PREFIX."contact`");
$transaction->addQuery("CREATE TABLE IF NOT EXISTS `".PREFIX."contact` (
  `contactID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`contactID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;");

$transaction->addQuery("INSERT INTO `".PREFIX."contact` (`contactID`, `name`, `email`, `sort`) VALUES
(1, 'Administrator', '" . $adminmail . "', 1)");

##############################################################################################################################
##############################################################################################################################
if($transaction->successful()) {
        return array('status' => 'success', 'message' => '<div class="list-group-item list-group-item-success">&nbsp;Install successful for Webspell RM Database: <i>contact</i> <i class="bi bi-check2"></i></div>');
    } else {
        return array('status' => 'fail', 'message' => '- Failed to install Webspell-RM<br/>' . $transaction->getError());
    }
}
function update_rm_5($_database) {
  $transaction = new Transaction($_database);
##############################################################################################################################
##############################################################################################################################

$transaction->addQuery("DROP TABLE IF EXISTS `".PREFIX."cookies`");
$transaction->addQuery("CREATE TABLE IF NOT EXISTS `".PREFIX."cookies` (
  `userID` int(11) NOT NULL,
  `cookie` binary(64) NOT NULL,
  `expiration` int(14) NOT NULL,
  PRIMARY KEY (`userID`,`cookie`),
  KEY `expiration` (`expiration`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4");

##############################################################################################################################
##############################################################################################################################
if ($transaction->successful()) {
        return array('status' => 'success', 'message' => '<div class="list-group-item list-group-item-success">&nbsp;Install successful for Webspell RM Database: <i>cookies</i> <i class="bi bi-check2"></i></div>');
    } else {
        return array('status' => 'fail', 'message' => '- Failed to install Webspell-RM<br/>' . $transaction->getError());
    }
}
function update_rm_6($_database) {
  $transaction = new Transaction($_database);
##############################################################################################################################
##############################################################################################################################

$transaction->addQuery("DROP TABLE IF EXISTS `".PREFIX."counter`");
$transaction->addQuery("CREATE TABLE IF NOT EXISTS `".PREFIX."counter` (
  `hits` int(20) NOT NULL DEFAULT '0',
  `online` int(14) NOT NULL DEFAULT '0',
  `maxonline` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;");

$transaction->addQuery("INSERT INTO `".PREFIX."counter` (`hits`, `online`, `maxonline`) VALUES (1, '".time()."', 1)");

$transaction->addQuery("DROP TABLE IF EXISTS `".PREFIX."counter_iplist`");
$transaction->addQuery("CREATE TABLE IF NOT EXISTS `".PREFIX."counter_iplist` (
  `dates` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `del` int(20) NOT NULL DEFAULT '0',
  `ip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;");

$transaction->addQuery("DROP TABLE IF EXISTS `".PREFIX."counter_stats`");
$transaction->addQuery("CREATE TABLE IF NOT EXISTS `".PREFIX."counter_stats` (
  `dates` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `count` int(20) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;");

##############################################################################################################################
##############################################################################################################################
if ($transaction->successful()) {
        return array('status' => 'success', 'message' => '
          <div class="list-group-item list-group-item-success">&nbsp;Install successful for Webspell RM Database: <i>counter</i> <i class="bi bi-check2"></i></div><br/> 
          <div class="list-group-item list-group-item-success">&nbsp;Install successful for Webspell RM Database: <i>counter_iplist</i> <i class="bi bi-check2"></i></div><br/>
          <div class="list-group-item list-group-item-success">&nbsp;Install successful for Webspell RM Database: <i>counter_stats</i> <i class="bi bi-check2"></i></div>');
    } else {
        return array('status' => 'fail', 'message' => '- Failed to install Webspell-RM<br/>' . $transaction->getError());
    }
}
function update_rm_7($_database) {
  $transaction = new Transaction($_database);
##############################################################################################################################
##############################################################################################################################
  
$transaction->addQuery("DROP TABLE IF EXISTS `".PREFIX."email`");
$transaction->addQuery("CREATE TABLE IF NOT EXISTS `".PREFIX."email` (
  `emailID` int(1) NOT NULL,
  `user` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `host` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `port` int(5) NOT NULL,
  `debug` int(1) NOT NULL,
  `auth` int(1) NOT NULL,
  `html` int(1) NOT NULL,
  `smtp` int(1) NOT NULL,
  `secure` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;");

$transaction->addQuery("INSERT INTO `".PREFIX."email` (`emailID`, `user`, `password`, `host`, `port`, `debug`, `auth`, `html`, `smtp`, `secure`) VALUES
(1, '', '', '', 25, 0, 0, 1, 0, 0)");

##############################################################################################################################
##############################################################################################################################
if ($transaction->successful()) {
        return array('status' => 'success', 'message' => '<div class="list-group-item list-group-item-success">&nbsp;Install successful for Webspell RM Database: <i>email</i> <i class="bi bi-check2"></i></div>');
    } else {
        return array('status' => 'fail', 'message' => '- Failed to install Webspell-RM<br/>' . $transaction->getError());
    }
}
function update_rm_8($_database) {
  $transaction = new Transaction($_database);
##############################################################################################################################
##############################################################################################################################
  
$transaction->addQuery("DROP TABLE IF EXISTS `".PREFIX."failed_login_attempts`");
$transaction->addQuery("CREATE TABLE IF NOT EXISTS `".PREFIX."failed_login_attempts` (
  `id` int(11) NOT NULL auto_increment,
  `ip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `wrong` int(2) default '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;");

##############################################################################################################################
##############################################################################################################################
if ($transaction->successful()) {
        return array('status' => 'success', 'message' => '<div class="list-group-item list-group-item-success">&nbsp;Install successful for Webspell RM Database: <i>failed_login_attempts</i> <i class="bi bi-check2"></i></div>');
    } else {
        return array('status' => 'fail', 'message' => '- Failed to install Webspell-RM<br/>' . $transaction->getError());
    }
}
function update_rm_9($_database) {
  $transaction = new Transaction($_database);
##############################################################################################################################
##############################################################################################################################


$transaction->addQuery("DROP TABLE IF EXISTS `".PREFIX."lock`");
$transaction->addQuery("CREATE TABLE IF NOT EXISTS `".PREFIX."lock` (
  `time` int(11) NOT NULL,
  `reason` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;");

##############################################################################################################################
##############################################################################################################################
if ($transaction->successful()) {
        return array('status' => 'success', 'message' => '<div class="list-group-item list-group-item-success">&nbsp;Install successful for Webspell RM Database: <i>lock</i> <i class="bi bi-check2"></i></div>');
    } else {
        return array('status' => 'fail', 'message' => '- Failed to install Webspell-RM<br/>' . $transaction->getError());
    }
}
function update_rm_10($_database) {
  $transaction = new Transaction($_database);
##############################################################################################################################
##############################################################################################################################

$transaction->addQuery("DROP TABLE IF EXISTS `".PREFIX."modrewrite`");
$transaction->addQuery("CREATE TABLE IF NOT EXISTS `".PREFIX."modrewrite` (
  `ruleID` int(11) NOT NULL AUTO_INCREMENT,
  `regex` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `fields` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `replace_regex` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `replace_result` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `rebuild_regex` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `rebuild_result` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`ruleID`)
) ENGINE=MyISAM AUTO_INCREMENT=85 DEFAULT CHARSET=utf8mb4;");


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
(42, 'news.html', 'index.php?site=news_manager', 'a:0:{}', 'index\\.php\\?site=news_manager', 'news.html', 'news\\.html', 'index.php?site=news_manager'),
(43, 'news_contents/{newsID}.html', 'index.php?site=news&action=news_contents&newsID={newsID}', 'a:1:{s:6:\"newsID\";s:7:\"integer\";}', 'index\\.php\\?site=news[&|&amp;]*action=news_contents[&|&amp;]*newsID=([0-9]+)', 'news_contents/$3.html', 'news_contents\\/([0-9]+?)\\.html', 'index.php?site=news&action=news_contents&newsID=$1'),
(44, 'news/archive.html', 'index.php?site=news_manager&action=news_archive', 'a:0:{}', 'index\\.php\\?site=news_manager[&|&amp;]*action=news_archive', 'news/archive.html', 'news\\/archive\\.html', 'index.php?site=news_manager&action=news_archive'),
(45, 'portfolio.html', 'index.php?site=portfolio', 'a:0:{}', 'index\\.php\\?site=portfolio', 'portfolio.html', 'portfolio\\.html', 'index.php?site=portfolio'),
(46, 'privacy_policy.html', 'index.php?site=privacy_policy', 'a:0:{}', 'index\\.php\\?site=privacy_policy', 'privacy_policy.html', 'privacy_policy\\.html', 'index.php?site=privacy_policy'),
(47, 'profile/{action}/{id}.html', 'index.php?site=profile&id={id}&action={action}', 'a:2:{s:2:\"id\";s:7:\"integer\";s:6:\"action\";s:6:\"string\";}', 'index\\.php\\?site=profile[&|&amp;]*id=([0-9]+)[&|&amp;]*action=(\\w*?)', 'profile/$4/$3.html', 'profile\\/(\\w*?)\\/([0-9]+?)\\.html', 'index.php?site=profile&id=$2&action=$1'),
(48, 'profile/{action}/{id}.html', 'index.php?site=pr1ofile&action={action}&id={id}', 'a:2:{s:2:\"id\";s:7:\"integer\";s:6:\"action\";s:6:\"string\";}', 'index\\.php\\?site=pr1ofile[&|&amp;]*action=(\\w*?)[&|&amp;]*id=([0-9]+)', 'profile/$3/$4.html', 'profile\\/(\\w*?)\\/([0-9]+?)\\.html', 'index.php?site=pr1ofile&action=$1&id=$2'),
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
(78, 'news/{page}.html', 'index.php?site=news_manager&action=news_contents&newsID={page}', 'a:1:{s:4:\"page\";s:7:\"integer\";}', 'index\\.php\\?site=news_manager[&|&amp;]*action=news_contents[&|&amp;]*newsID=([0-9]+)', 'news/$3.html', 'news\\/([0-9]+?)\\.html', 'index.php?site=news_manager&action=news_contents&newsID=$1'),
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
(87, 'news_contents/{newsID}.html', 'index.php?site=news_contents&newsID={newsID}', 'a:1:{s:6:\"newsID\";s:7:\"integer\";}', 'index\\.php\\?site=news_contents[&|&amp;]*newsID=([0-9]+)', 'news_contents/$3.html', 'news_contents\\/([0-9]+?)\\.html', 'index.php?site=news_contents&newsID=$1'),
(88, 'clanwars/result.html', 'index.php?site=clanwars&action=clanwar_result', 'a:0:{}', 'index\\.php\\?site=clanwars[&|&amp;]*action=clanwar_result', 'clanwars/result.html', 'clanwars\\/result\\.html', 'index.php?site=clanwars&action=clanwar_result'),
(89, 'facebook.html', 'index.php?site=facebook', 'a:0:{}', 'index\\.php\\?site=facebook', 'facebook.html', 'facebook\\.html', 'index.php?site=facebook'),
(90, 'reddit.html', 'index.php?site=reddit', 'a:0:{}', 'index\\.php\\?site=reddit', 'reddit.html', 'reddit\\.html', 'index.php?site=reddit'),
(91, 'instagram.html', 'index.php?site=instagram', 'a:0:{}', 'index\\.php\\?site=instagram', 'instagram.html', 'instagram\\.html', 'index.php?site=instagram'),
(92, 'tiktok.html', 'index.php?site=tiktok', 'a:0:{}', 'index\\.php\\?site=tiktok', 'tiktok.html', 'tiktok\\.html', 'index.php?site=tiktok'),
(93, 'rss.html', 'index.php?site=rss', 'a:0:{}', 'index\\.php\\?site=rss', 'rss.html', 'rss\\.html', 'index.php?site=rss'),
(94, 'projectlist.html', 'index.php?site=projectlist', 'a:0:{}', 'index\\.php\\?site=projectlist', 'projectlist.html', 'projectlist\\.html', 'index.php?site=projectlist'),
(95, 'projectlist/{catID}.html', 'index.php?site=projectlist&action=show&projectlistcatID={catID}', 'a:1:{s:5:\"catID\";s:7:\"integer\";}', 'index\\.php\\?site=projectlist[&|&amp;]*action=show[&|&amp;]*projectlistcatID=([0-9]+)', 'projectlist/$3.html', 'projectlist\\/([0-9]+?)\\.html', 'index.php?site=projectlist&action=show&projectlistcatID=$1'),
(96, 'logout.html', 'index.php?site=logout', 'a:0:{}', 'index\\.php\\?site=logout', 'logout.html', 'logout\\.html', 'index.php?site=logout'),
(97, 'usergallery.html', 'index.php?site=usergallery', 'a:0:{}', 'index\\.php\\?site=usergallery', 'usergallery.html', 'usergallery\\.html', 'index.php?site=usergallery'),
(98, 'usergallery/add.html', 'index.php?site=usergallery&action=add', 'a:0:{}', 'index\\.php\\?site=usergallery[&|&amp;]*action=add', 'usergallery/add.html', 'usergallery\\/add\\.html', 'index.php?site=usergallery&action=add'),
(99, 'cashbox.html', 'index.php?site=cashbox', 'a:0:{}', 'index\\.php\\?site=cashbox', 'cashbox.html', 'cashbox\\.html', 'index.php?site=cashbox'),
(100, 'calendar/event.html', 'index.php?site=calendar#event', 'a:0:{}', 'index\\.php\\?site=calendar#event', 'calendar/event.html', 'calendar\\/event\\.html', 'index.php?site=calendar#event'),
(101, 'awaylist.html', 'index.php?site=awaylist', 'a:0:{}', 'index\\.php\\?site=awaylist', 'awaylist.html', 'awaylist\\.html', 'index.php?site=awaylist'),
(102, 'awaylist/add.html', 'index.php?site=awaylist&action=add', 'a:0:{}', 'index\\.php\\?site=awaylist[&|&amp;]*action=add', 'awaylist/add.html', 'awaylist\\/add\\.html', 'index.php?site=awaylist&action=add'),
(103, 'awaylist/edit/{id}.html', 'index.php?site=awaylist&action=edit&id={id}', 'a:1:{s:2:\"id\";s:7:\"integer\";}', 'index\\.php\\?site=awaylist[&|&amp;]*action=edit[&|&amp;]*id=([0-9]+)', 'awaylist/edit/$3.html', 'awaylist\\/edit\\/([0-9]+?)\\.html', 'index.php?site=awaylist&action=edit&id=$1'),
(104, 'awaylist/show/{id}.html', 'index.php?site=awaylist&action=show&id={id}', 'a:1:{s:2:\"id\";s:7:\"integer\";}', 'index\\.php\\?site=awaylist[&|&amp;]*action=show[&|&amp;]*id=([0-9]+)', 'awaylist/show/$3.html', 'awaylist\\/show\\/([0-9]+?)\\.html', 'index.php?site=awaylist&action=show&id=$1'),
(105, 'mc_status.html', 'index.php?site=mc_status', 'a:0:{}', 'index\\.php\\?site=mc_status', 'mc_status.html', 'mc_status\\.html', 'index.php?site=mc_status'),
(106, 'planning.html', 'index.php?site=planning', 'a:0:{}', 'index\\.php\\?site=planning', 'planning.html', 'planning\\.html', 'index.php?site=planning'),
(107, 'memberslist.html', 'index.php?site=memberslist', 'a:0:{}', 'index\\.php\\?site=memberslist', 'memberslist.html', 'memberslist\\.html', 'index.php?site=memberslist'),
(108, 'cup.html', 'index.php?site=cup', 'a:0:{}', 'index\\.php\\?site=cup', 'cup.html', 'cup\\.html', 'index.php?site=cup'),
(109, 'cup/teams.html', 'index.php?site=cup&action=teams', 'a:0:{}', 'index\\.php\\?site=cup[&|&amp;]*action=teams', 'cup/teams.html', 'cup\\/teams\\.html', 'index.php?site=cup&action=teams'),
(110, 'newsletter.html', 'index.php?site=newsletter', 'a:0:{}', 'index\\.php\\?site=newsletter', 'newsletter.html', 'newsletter\\.html', 'index.php?site=newsletter'),
(111, 'tsviewer.html', 'index.php?site=tsviewer', 'a:0:{}', 'index\\.php\\?site=tsviewer', 'tsviewer.html', 'tsviewer\\.html', 'index.php?site=tsviewer'),
(112, 'gallery/category{groupID}.html', 'index.php?site=gallery&groupID={groupID}', 'a:1:{s:7:\"groupID\";s:7:\"integer\";}', 'index\\.php\\?site=gallery[&|&amp;]*groupID=([0-9]+)', 'gallery/category$3.html', 'gallery\\/category([0-9]+?)\\.html', 'index.php?site=gallery&groupID=$1'),
(113, 'blog.html', 'index.php?site=blog', 'a:0:{}', 'index\\.php\\?site=blog', 'blog.html', 'blog\\.html', 'index.php?site=blog'),
(114, 'blog/archiv.html', 'index.php?site=blog&action=archiv', 'a:0:{}', 'index\\.php\\?site=blog[&|&amp;]*action=archiv', 'blog/archiv.html', 'blog\\/archiv\\.html', 'index.php?site=blog&action=archiv'),
(115, 'gallery/gallery{galleryID}.html', 'index.php?site=gallery&galleryID={galleryID}', 'a:1:{s:9:\"galleryID\";s:7:\"integer\";}', 'index\\.php\\?site=gallery[&|&amp;]*galleryID=([0-9]+)', 'gallery/gallery$3.html', 'gallery\\/gallery([0-9]+?)\\.html', 'index.php?site=gallery&galleryID=$1'),
(116, 'blog/show/{blogID}.html', 'index.php?site=blog&action=show&blogID={blogID}', 'a:1:{s:6:\"blogID\";s:7:\"integer\";}', 'index\\.php\\?site=blog[&|&amp;]*action=show[&|&amp;]*blogID=([0-9]+)', 'blog/show/$3.html', 'blog\\/show\\/([0-9]+?)\\.html', 'index.php?site=blog&action=show&blogID=$1'),
(117, 'blog/detail/{id}.html', 'index.php?site=blog&action=detail&user={id}', 'a:1:{s:2:\"id\";s:7:\"integer\";}', 'index\\.php\\?site=blog[&|&amp;]*action=detail[&|&amp;]*user=([0-9]+)', 'blog/detail/$3.html', 'blog\\/detail\\/([0-9]+?)\\.html', 'index.php?site=blog&action=detail&user=$1'),
(119, 'blog/add.html', 'index.php?site=blog&action=new', 'a:0:{}', 'index\\.php\\?site=blog[&|&amp;]*action=new', 'blog/add.html', 'blog\\/add\\.html', 'index.php?site=blog&action=new'),
(120, 'blog/edit/{blogID}.html', 'index.php?site=blog&action=edit&blogID={blogID}', 'a:1:{s:6:\"blogID\";s:7:\"integer\";}', 'index\\.php\\?site=blog[&|&amp;]*action=edit[&|&amp;]*blogID=([0-9]+)', 'blog/edit/$3.html', 'blog\\/edit\\/([0-9]+?)\\.html', 'index.php?site=blog&action=edit&blogID=$1')");

##############################################################################################################################
##############################################################################################################################
if ($transaction->successful()) {
        return array('status' => 'success', 'message' => '<div class="list-group-item list-group-item-success">&nbsp;Install successful for Webspell RM Database: <i>modrewrite</i> <i class="bi bi-check2"></i></div>');
    } else {
        return array('status' => 'fail', 'message' => '- Failed to install Webspell-RM<br/>' . $transaction->getError());
    }
}
function update_rm_11($_database) {
  $transaction = new Transaction($_database);
##############################################################################################################################
##############################################################################################################################

$transaction->addQuery("DROP TABLE IF EXISTS `".PREFIX."navigation_dashboard_categories`");
$transaction->addQuery("CREATE TABLE IF NOT EXISTS `".PREFIX."navigation_dashboard_categories` (
  `catID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `fa_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `accesslevel` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `default` int(1) NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`catID`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;");

$transaction->addQuery("INSERT INTO `".PREFIX."navigation_dashboard_categories` (`catID`, `name`, `fa_name`, `accesslevel`, `default`, `sort`) VALUES
(1, '{[de]}Webseiten Info - Einstellungen{[en]}Website Info - Settings{[it]}Informazioni-Impostazioni Sito', 'bi bi-gear', 'any', 0, 1),
(2, '{[de]}Spam{[en]}Spam{[it]}Spam', 'bi bi-exclamation-triangle', 'user', 0, 2),
(3, '{[de]}Benutzer Administration{[en]}User Administration{[it]}Amministrazione Utenti', 'bi bi-person', 'user', 0, 3),
(4, '{[de]}Team Verwaltung{[en]}Team Administration{[it]}Amministrazione della squadra', 'bi bi-people', 'any', 0, 4),
(5, '{[de]}Template - Layout{[en]}Template - Layout{[it]}Template - Disposizione', 'bi bi-layout-text-window-reverse', 'page', 0, 5),
(6, '{[de]}Plugin Verwaltung{[en]}Plugin Administration{[it]}Gestione Plugin', 'bi bi-puzzle', 'page', 0, 6),
(7, '{[de]}Webseiteninhalte{[en]}Website Content{[it]}Contenuto del sito web', 'bi bi-card-checklist', 'page', 0, 7),
(8, '{[de]}Grafik - Video - Projekte{[en]}Grafik - Video - Projekte{[it]}Grafica - Video - Progetti', 'bi bi-image ', 'gallery', 0, 8),
(9, '{[de]}Header - Slider{[en]}Header - Slider{[it]}Slider-Header', 'bi bi-fast-forward-btn', 'page', 0, 9),
(10, '{[de]}Game - Voice Server Tools{[en]}Game - Voice Server Tools{[it]}Voce Server Tools', 'bi bi-controller', 'clanwars', 0, 10),
(11, '{[de]}Social Media{[en]}Social Media{[it]}Social Media', 'bi bi-steam', 'feedback', 0, 11),
(12, '{[de]}Links - Download - Sponsoren{[en]}Links - Download - Sponsore{[it]}Link - Download - Sponsor', 'bi bi-link', 'any', 0, 12)");

$transaction->addQuery("DROP TABLE IF EXISTS `".PREFIX."navigation_dashboard_links`");
$transaction->addQuery("CREATE TABLE IF NOT EXISTS `".PREFIX."navigation_dashboard_links` (
  `linkID` int(11) NOT NULL AUTO_INCREMENT,
  `catID` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `modulname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `accesslevel` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `sort` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`linkID`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4;");

$transaction->addQuery("INSERT INTO `".PREFIX."navigation_dashboard_links` (`linkID`, `catID`, `name`, `modulname`, `url`, `accesslevel`, `sort`) VALUES
(1, 1, '{[de]}Webserver-Info{[en]}Webserver-Info{[it]}Informazioni Sul Sito', 'ac_overview', 'admincenter.php?site=overview', 'any', 1),
(2, 1, '{[de]}Seiten Statistiken{[en]}Page Statistics{[it]}Pagina delle Statistiche', 'ac_page_statistic', 'admincenter.php?site=page_statistic', 'any', 2),
(3, 1, '{[de]}Besucher Statistiken{[en]}Visitor Statistics{[it]}Statistiche Visitatori', 'ac_visitor_statistic', 'admincenter.php?site=visitor_statistic', 'any', 3),
(4, 1, '{[de]}Allgemeine Einstellungen{[en]}General Settings{[it]}Impostazioni Generali', 'ac_settings', 'admincenter.php?site=settings', 'page', 4),
(5, 1, '{[de]}Admincenter Navigation{[en]}Admincenter Navigation{[it]}Menu Navigazione Admin', 'ac_dashboard_navigation', 'admincenter.php?site=dashboard_navigation', 'page', 5),
(6, 1, '{[de]}E-Mail{[en]}E-Mail{[it]}E-Mail', 'ac_email', 'admincenter.php?site=email', 'page', 6),
(7, 1, '{[de]}Kontakte{[en]}Contacts{[it]}Contatti', 'ac_contact', 'admincenter.php?site=contact', 'page', 7),
(8, 1, '{[de]}Mod-Rewrite{[en]}Mod-Rewrite{[it]}Mod-Rewrite', 'ac_modrewrite', 'admincenter.php?site=modrewrite', 'page', 8),
(9, 1, '{[de]}Datenbank{[en]}Database{[it]}Database', 'ac_database', 'admincenter.php?site=database', 'page', 9),
(10, 1, '{[de]}Webspell-RM Update{[en]}Webspell-RM Update{[it]}Aggiornamento Webspell-RM', 'ac_update', 'admincenter.php?site=update', 'page', 10),
(11, 3, '{[de]}Registrierte Benutzer{[en]}Registered Users{[it]}Utenti Registrati', 'ac_users', 'admincenter.php?site=users', 'user', 1),
(12, 2, '{[de]}Geblockte Inhalte{[en]}Blocked Content{[it]}Contenuti Bloccati', 'ac_spam_forum', 'admincenter.php?site=spam&amp;action=forum_spam', 'user', 1),
(13, 2, '{[de]}Nutzer l&ouml;schen{[en]}Remove User{[it]}Banna Utente', 'ac_spam_user', 'admincenter.php?site=spam&amp;action=user', 'user', 2),
(14, 2, '{[de]}Multi-Accounts{[en]}Multi-Accounts{[it]}Multi-Account', 'ac_spam_multi', 'admincenter.php?site=spam&amp;action=multi', 'user', 3),
(15, 2, '{[de]}gebannte IPs{[en]}banned IPs{[it]}IP bannati', 'ac_spam_banned_ips', 'admincenter.php?site=banned_ips', 'user', 4),
(16, 5, '{[de]}Webseiten Navigation{[en]}Webside Navigation{[it]}Menu Navigazione Web', 'ac_webside_navigation', 'admincenter.php?site=webside_navigation', 'page', 1),
(17, 5, '{[de]}Templates Installer{[en]}Templates Installer{[it]}Installazione Temi', 'ac_template_installer', 'admincenter.php?site=template_installer', 'page', 2),
(18, 5, '{[de]}Templates - Style{[en]}Templates - Style{[it]}Templates Grafici', 'ac_templates', 'admincenter.php?site=settings_templates', 'page', 3),
(19, 5, '{[de]}Head Elements{[en]}Head Elements{[it]}Elementi Head', 'ac_headelements', 'admincenter.php?site=settings_headelements', 'page', 4),
(20, 5, '{[de]}Startseite{[en]}Start Page{[it]}Pagina Principale', 'ac_startpage', 'admincenter.php?site=settings_startpage', 'page', 5),
(21, 5, '{[de]}Statische Seiten{[en]}Static Pages{[it]}Pagine Statiche', 'ac_static', 'admincenter.php?site=settings_static', 'page', 6),
(22, 5, '{[de]}Impressum{[en]}Imprint{[it]}Impronta Editoriale', 'ac_imprint', 'admincenter.php?site=settings_imprint', 'page', 7),
(23, 5, '{[de]}Datenschutz-Bestimmungen{[en]}Privacy Policy{[it]}Informativa sulla Privacy', 'ac_privacy_policy', 'admincenter.php?site=settings_privacy_policy', 'page', 8),
(24, 6, '{[de]}Plugin Manager{[en]}Plugin Manager{[it]}Gestione Plugin', 'ac_plugin_manager', 'admincenter.php?site=plugin_manager', 'page', 1),
(25, 6, '{[de]}Plugin Installer{[en]}Plugin Installer{[it]}Installazione Plugin', 'ac_plugin_installer', 'admincenter.php?site=plugin_installer', 'page', 2),
(26, 6, '{[de]}Widget Verwaltung{[en]}Widget Control{[it]}Gestione Widget', 'ac_plugin_widgets', 'admincenter.php?site=plugin_widgets', 'page', 3),
(27, 7, '{[de]}Footer{[en]}Footer{[it]}Elementi Footer', 'footer', 'admincenter.php?site=admin_footer', 'page', 1)");

##############################################################################################################################
##############################################################################################################################
if ($transaction->successful()) {
        return array('status' => 'success', 'message' => '
          <div class="list-group-item list-group-item-success">&nbsp;Install successful for Webspell RM Database: <i>navigation_dashboard_categories</i> <i class="bi bi-check2"></i></div><br/> 
          <div class="list-group-item list-group-item-success">&nbsp;Install successful for Webspell RM Database: <i>navigation_dashboard_links</i> <i class="bi bi-check2"></i></div>');
    } else {
        return array('status' => 'fail', 'message' => '- Failed to install Webspell-RM<br/>' . $transaction->getError());
    }
}
function update_rm_12($_database) {
  $transaction = new Transaction($_database);
##############################################################################################################################
##############################################################################################################################

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
) AUTO_INCREMENT=6
  DEFAULT CHARSET=utf8mb4");
  
$transaction->addQuery("INSERT INTO `".PREFIX ."navigation_website_main` (`mnavID`, `name`, `url`, `default`, `sort`, `isdropdown`, `windows`) VALUES
(1, '{[de]}HAUPT{[en]}MAIN{[it]}PRINCIPALE', '#', 1, 1, 1, 1),
(2, '{[de]}TEAM{[en]}TEAM{[it]}TEAM', '#', 1, 2, 1, 1),
(3, '{[de]}GEMEINSCHAFT{[en]}COMMUNITY{[it]}COMMUNITY', '#', 1, 3, 1, 1),
(4, '{[de]}MEDIEN{[en]}MEDIA{[it]}MEDIA', '#', 1, 4, 1, 1),
(5, '{[de]}SOCIAL{[en]}SOCIAL{[it]}SOCIAL', '#', 1, 5, 1, 1),
(6, '{[de]}SONSTIGES{[en]}MISCELLANEOUS{[it]}VARIE', '#', 1, 6, 1, 1)");  

$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "navigation_website_sub`");
$transaction->addQuery("CREATE TABLE `" . PREFIX . "navigation_website_sub` (
  `snavID` int(11) NOT NULL AUTO_INCREMENT,
  `mnavID` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `modulname` varchar(100) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `sort` int(2) NOT NULL DEFAULT '0',
  `indropdown` int(1) NOT NULL DEFAULT '1',
  `themes_modulname` varchar(255) DEFAULT 'default',
  PRIMARY KEY  (`snavID`)
) AUTO_INCREMENT=4
  DEFAULT CHARSET=utf8mb4");
  
$transaction->addQuery("INSERT INTO `" . PREFIX . "navigation_website_sub` (`snavID`, `mnavID`, `name`, `modulname`, `url`, `sort`, `indropdown`, `themes_modulname`) VALUES
(1, 6, '{[de]}Kontakt{[en]}Contact{[it]}Contatti', 'contact', 'index.php?site=contact', 1, 1, 'default'),
(2, 6, '{[de]}Datenschutz-Bestimmungen{[en]}Privacy Policy{[it]}Informativa sulla Privacy', 'privacy_policy', 'index.php?site=privacy_policy', 2, 1, 'default'),
(3, 6, '{[de]}Impressum{[en]}Imprint{[it]}Impronta Editoriale', 'imprint', 'index.php?site=imprint', 3, 1, 'default')");

##############################################################################################################################
##############################################################################################################################
if ($transaction->successful()) {
        return array('status' => 'success', 'message' => '
          <div class="list-group-item list-group-item-success">&nbsp;Install successful for Webspell RM Database: <i>navigation_website_main</i> <i class="bi bi-check2"></i></div><br/> 
          <div class="list-group-item list-group-item-success">&nbsp;Install successful for Webspell RM Database: <i>navigation_website_sub</i> <i class="bi bi-check2"></i></div>');
    } else {
        return array('status' => 'fail', 'message' => '- Failed to install Webspell-RM<br/>' . $transaction->getError());
    }
}
function update_rm_13($_database) {
  $transaction = new Transaction($_database);
##############################################################################################################################
##############################################################################################################################

$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "plugins_footer`");
$transaction->addQuery("CREATE TABLE `" . PREFIX . "plugins_footer` (
  `footID` int(11) NOT NULL AUTO_INCREMENT,
  `banner` varchar(255) NOT NULL DEFAULT '',
  `about` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `strasse` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefon` varchar(255) NOT NULL,
  `since` varchar(255) NOT NULL DEFAULT '',
  `linkname1` varchar(255) NOT NULL,
  `navilink1` varchar(255) NOT NULL,
  `linkname2` varchar(255) NOT NULL,
  `navilink2` varchar(255) NOT NULL,
  `linkname3` varchar(255) NOT NULL,
  `navilink3` varchar(255) NOT NULL,
  `linkname4` varchar(255) NOT NULL,
  `navilink4` varchar(255) NOT NULL,
  `linkname5` varchar(255) NOT NULL,
  `navilink5` varchar(255) NOT NULL,
  `linkname6` varchar(255) NOT NULL,
  `navilink6` varchar(255) NOT NULL,
  `linkname7` varchar(255) NOT NULL,
  `navilink7` varchar(255) NOT NULL,
  `linkname8` varchar(255) NOT NULL,
  `navilink8` varchar(255) NOT NULL,
  `linkname9` varchar(255) NOT NULL,
  `navilink9` varchar(255) NOT NULL,
  `linkname10` varchar(255) NOT NULL,
  `navilink10` varchar(255) NOT NULL,
  `social_text` varchar(255) NOT NULL,
  `social_link_name1` text NOT NULL,
  `social_link1` varchar(255) NOT NULL,
  `social_link_name2` varchar(255) NOT NULL,
  `social_link2` varchar(255) NOT NULL,
  `social_link_name3` varchar(255) NOT NULL,
  `social_link3` varchar(255) NOT NULL,
  `copyright_link_name1` varchar(255) NOT NULL,
  `copyright_link1` varchar(255) NOT NULL,
  `copyright_link_name2` varchar(255) NOT NULL,
  `copyright_link2` varchar(255) NOT NULL,
  `copyright_link_name3` varchar(255) NOT NULL,
  `copyright_link3` varchar(255) NOT NULL,
  `copyright_link_name4` varchar(255) NOT NULL,
  `copyright_link4` varchar(255) NOT NULL,
  `copyright_link_name5` varchar(255) NOT NULL,
  `copyright_link5` varchar(255) NOT NULL,
  `widget_left` varchar(255) NOT NULL,
  `widget_center` varchar(255) NOT NULL,
  `widget_right` varchar(255) NOT NULL,
  `widgetname_left` varchar(255) NOT NULL,
  `widgetname_center` varchar(255) NOT NULL,
  `widgetname_right` varchar(255) NOT NULL,
  PRIMARY KEY  (`footID`)
) AUTO_INCREMENT=2
  DEFAULT CHARSET=utf8mb4");

$transaction->addQuery("INSERT INTO `" . PREFIX . "plugins_footer` (`footID`, `banner`, `about`, `name`, `strasse`, `email`, `telefon`, `since`, `linkname1`, `navilink1`, `linkname2`, `navilink2`, `linkname3`, `navilink3`, `linkname4`, `navilink4`, `linkname5`, `navilink5`, `linkname6`, `navilink6`, `linkname7`, `navilink7`, `linkname8`, `navilink8`, `linkname9`, `navilink9`, `linkname10`, `navilink10`, `social_text`, `social_link_name1`, `social_link1`, `social_link_name2`, `social_link2`, `social_link_name3`, `social_link3`, `copyright_link_name1`, `copyright_link1`, `copyright_link_name2`, `copyright_link2`, `copyright_link_name3`, `copyright_link3`, `copyright_link_name4`, `copyright_link4`, `copyright_link_name5`, `copyright_link5`, `widget_left`, `widget_center`, `widget_right`, `widgetname_left`, `widgetname_center`, `widgetname_right`) VALUES
(1, '', 'Team Clanname ist eine 1999 gegr&#252;ndete deutsche E-Sport-Organisation, welche &#252;ber professionelle Spieler in unterschiedlichen Disziplinen verf&#252;gt...', 'Hans Mustermann', 'Musterhausen 11, Germany', 'mail@Clanname-esport.de', '(123) 456-7890', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Impressum', 'index.php?site=imprint', 'Datenschutz', 'index.php?site=privacy_policy', 'Kontakt', 'index.php?site=contact', 'Counter', 'index.php?site=counter', '', '', '', '', '', '', '', '')");

$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "plugins_footer_target`");
$transaction->addQuery("CREATE TABLE `" . PREFIX . "plugins_footer_target` (
  `targetID` int(11) NOT NULL AUTO_INCREMENT,
  `windows1` int(1) NOT NULL DEFAULT '1',
  `windows2` int(1) NOT NULL DEFAULT '1',
  `windows3` int(1) NOT NULL DEFAULT '1',
  `windows4` int(1) NOT NULL DEFAULT '1',
  `windows5` int(1) NOT NULL DEFAULT '1',
  `windows6` int(1) NOT NULL DEFAULT '1',
  `windows7` int(1) NOT NULL DEFAULT '1',
  `windows8` int(1) NOT NULL DEFAULT '1',
  `windows9` int(1) NOT NULL DEFAULT '1',
  `windows10` int(1) NOT NULL DEFAULT '1',
  `windows11` int(1) NOT NULL DEFAULT '1',
  `windows12` int(1) NOT NULL DEFAULT '1',
  `windows13` int(1) NOT NULL DEFAULT '1',
  `windows14` int(1) NOT NULL DEFAULT '1',
  `windows15` int(1) NOT NULL DEFAULT '1',
  `windows16` int(1) NOT NULL DEFAULT '1',
  `windows17` int(1) NOT NULL DEFAULT '1',
  `windows18` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`targetID`)
) AUTO_INCREMENT=1
  DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");

$transaction->addQuery("INSERT INTO `" . PREFIX . "plugins_footer_target` (`targetID`, `windows1`, `windows2`, `windows3`, `windows4`, `windows5`, `windows6`, `windows7`, `windows8`, `windows9`, `windows10`, `windows11`, `windows12`, `windows13`, `windows14`, `windows15`, `windows16`, `windows17`, `windows18`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1)");

##############################################################################################################################
##############################################################################################################################
if ($transaction->successful()) {
        return array('status' => 'success', 'message' => '<div class="list-group-item list-group-item-success">&nbsp;Install successful for Webspell RM Database: <i>plugins_footer</i> <i class="bi bi-check2"></i></div>');
    } else {
        return array('status' => 'fail', 'message' => '- Failed to install Webspell-RM<br/>' . $transaction->getError());
    }
}
function update_rm_14($_database) {
  $transaction = new Transaction($_database);
##############################################################################################################################
##############################################################################################################################

global $adminname;
global $adminmail;
global $url;

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
  `forum_double` int(1) NOT NULL DEFAULT '1',
  `profilelast` int(11) NOT NULL DEFAULT '10',
  `de_lang` int(1) DEFAULT '1',
  `en_lang` int(1) DEFAULT '1',
  `it_lang` int(1) DEFAULT '1',
  `birthday` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`settingID`)
) AUTO_INCREMENT=2
  DEFAULT CHARSET=utf8mb4");

    $transaction->addQuery("INSERT IGNORE INTO `" . PREFIX . "settings` (`settingID`, `title`, `hpurl`, `clanname`, `clantag`, `adminname`, `adminemail`, `sball`, `topics`, `posts`, `latesttopics`, `latesttopicchars`, `messages`, `register_per_ip`, `sessionduration`, `closed`, `imprint`, `default_language`, `insertlinks`, `search_min_len`, `max_wrong_pw`, `captcha_math`, `captcha_bgcol`, `captcha_fontcol`, `captcha_type`, `captcha_noise`, `captcha_linenoise`, `bancheck`, `spam_check`, `detect_language`, `spammaxposts`, `spamapiblockerror`, `date_format`, `time_format`, `modRewrite`, `startpage`, `forum_double`, `profilelast`, `de_lang`, `en_lang`, `it_lang`, `birthday`) VALUES
(1, 'Webspell-RM', '" . $url . "', 'Clan Name', 'MyClan', '" . $adminname . "', '" . $adminmail . "', 30, 20, 10, 10, 18, 20, 1, 0, 0, 1, 'de', 1, 3, 10, 2, '#FFFFFF', '#000000', 2, 100, 10, 1564938159, 0, 0, 0, 0, 'd.m.Y', 'H:i', 0, 'startpage', 1, 10, 1, 1, 1, 0)");

##############################################################################################################################
##############################################################################################################################
if ($transaction->successful()) {
        return array('status' => 'success', 'message' => '<div class="list-group-item list-group-item-success">&nbsp;Install successful for Webspell RM Database: <i>settings</i> <i class="bi bi-check2"></i></div>');
    } else {
        return array('status' => 'fail', 'message' => '- Failed to install Webspell-RM<br/>' . $transaction->getError());
    }
}
function update_rm_15($_database) {
  $transaction = new Transaction($_database);
##############################################################################################################################
##############################################################################################################################

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
  `btn_border_radius` varchar(255) DEFAULT '0',
  PRIMARY KEY  (`buttonID`)
) AUTO_INCREMENT=2
  DEFAULT CHARSET=utf8mb4");

$transaction->addQuery("INSERT IGNORE INTO `" . PREFIX . "settings_buttons` (`buttonID`, `name`, `modulname`, `active`, `version`, `button1`, `button2`, `button3`, `button4`, `button5`, `button6`, `button7`, `button8`, `button9`, `button10`, `button11`, `button12`, `button13`, `button14`, `button15`, `button16`, `button17`, `button18`, `button19`, `button20`, `button21`, `button22`, `button23`, `button24`, `button25`, `button26`, `button27`, `button28`, `button29`, `button30`, `button31`, `button32`, `button33`, `button34`, `button35`, `button36`, `button37`, `button38`, `button39`, `button40`, `button41`, `button42`, `btn_border_radius`) VALUES
(1, 'default', 'default', 1, '0.1', 'rgb(254,130,29)', 'rgb(196,89,1)', 'rgb(255,255,255)', 'rgb(254,130,29)', 'rgb(196,89,1)', 'rgb(108,117,125)', 'rgb(90,98,104)', 'rgb(255,255,255)', 'rgb(108,117,125)', 'rgb(84,91,98)', 'rgb(40,167,69)', 'rgb(33,136,56)', 'rgb(255,255,255)', 'rgb(40,167,69)', 'rgb(30,126,52)', 'rgb(220,53,69)', 'rgb(200,35,51)', 'rgb(255,255,255)', 'rgb(220,53,69)', 'rgb(189,33,48)', 'rgb(255,193,7)', 'rgb(224,168,0)', 'rgb(33,37,41)', 'rgb(255,193,7)', 'rgb(211,158,0)', 'rgb(23,162,184)', 'rgb(19,132,150)', 'rgb(255,255,255)', 'rgb(23,162,184)', 'rgb(17,122,139)', 'rgb(248,249,250)', 'rgb(226,230,234)', 'rgb(33,37,41)', 'rgb(248,249,250)', 'rgb(218,224,229)', 'rgb(52,58,64)', 'rgb(35,39,43)', 'rgb(255,255,255)', 'rgb(52,58,64)', 'rgb(29,33,36)', 'rgb(254,130,29)', 'rgb(196,89,1)', '0px')");

##############################################################################################################################
##############################################################################################################################
if ($transaction->successful()) {
        return array('status' => 'success', 'message' => '<div class="list-group-item list-group-item-success">&nbsp;Install successful for Webspell RM Database: <i>settings_buttons</i> <i class="bi bi-check2"></i></div>');
    } else {
        return array('status' => 'fail', 'message' => '- Failed to install Webspell-RM<br/>' . $transaction->getError());
    }
}
function update_rm_16($_database) {
  $transaction = new Transaction($_database);
##############################################################################################################################
##############################################################################################################################

$transaction->addQuery("DROP TABLE IF EXISTS `".PREFIX."settings_headelements`");
$transaction->addQuery("CREATE TABLE IF NOT EXISTS `".PREFIX."settings_headelements` (
  `headelementID` int(11) NOT NULL AUTO_INCREMENT,
  `banner` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `name` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `site` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `modulname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `info` text NOT NULL,
  `displayed` int(1) DEFAULT '0',
PRIMARY KEY  (`headelementID`)
) AUTO_INCREMENT=1
  DEFAULT CHARSET=utf8mb4");

$transaction->addQuery("INSERT IGNORE INTO `" . PREFIX . "settings_headelements` (`headelementID`, `banner`, `name`, `site`, `modulname`, `info`, `displayed`) VALUES
(1, '', 'Startpage', '', '', '', 0)");

##############################################################################################################################
##############################################################################################################################
if ($transaction->successful()) {
        return array('status' => 'success', 'message' => '<div class="list-group-item list-group-item-success">&nbsp;Install successful for Webspell RM Database: <i>settings_headelements</i> <i class="bi bi-check2"></i></div>');
    } else {
        return array('status' => 'fail', 'message' => '- Failed to install Webspell-RM<br/>' . $transaction->getError());
    }
}
function update_rm_17($_database) {
  $transaction = new Transaction($_database);
##############################################################################################################################
##############################################################################################################################

$transaction->addQuery("DROP TABLE IF EXISTS `".PREFIX."settings_imprint`");
$transaction->addQuery("CREATE TABLE IF NOT EXISTS `".PREFIX."settings_imprint` (
  `imprintID` int(11) NOT NULL AUTO_INCREMENT,
  `imprint` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `disclaimer_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`imprintID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;");

$transaction->addQuery("INSERT INTO `" . PREFIX . "settings_imprint` (`imprintID`, `imprint`, `disclaimer_text`) VALUES
(1, '{[de]} Impressum in deutscher Sprache.<br /><span style=\"color:#c0392b\"><strong>Konfigurieren Sie bitte Ihr Impressum!</strong></span><br />{[en]} Imprint in English.<br /><span style=\"color:#c0392b\"><strong>Please configure your imprint!</strong></span>{[it]} Impronta Editoriale in Italiano.<br /><span style=\"color:#c0392b\"><strong>Si prega di configurare l&rsquo;impronta!</strong></span>', '{[de]} Haftungsausschluss in deutscher Sprache.<br /><span style=\"color:#c0392b\"><strong>Konfigurieren Sie bitte Ihr Haftungsausschluss! </strong></span><br />{[en]} Disclaimer in English.<br /><span style=\"color:#c0392b\"><strong>Please configure your disclaimer!</strong></span>{[it]} Dichiarazione di non Responsabilità in Italiano.<br /><span style=\"color:#c0392b\"><strong>Si prega di configurare la Dichiarazione di non Responsabilità!</strong></span>')");

##############################################################################################################################
##############################################################################################################################
if ($transaction->successful()) {
        return array('status' => 'success', 'message' => '<div class="list-group-item list-group-item-success">&nbsp;Install successful for Webspell RM Database: <i>settings_imprint</i> <i class="bi bi-check2"></i></div>');
    } else {
        return array('status' => 'fail', 'message' => '- Failed to install Webspell-RM<br/>' . $transaction->getError());
    }
}
function update_rm_18($_database) {
  $transaction = new Transaction($_database);
##############################################################################################################################
##############################################################################################################################

$transaction->addQuery("DROP TABLE IF EXISTS `".PREFIX."settings_languages`");
$transaction->addQuery("CREATE TABLE IF NOT EXISTS `".PREFIX."settings_languages` (
  `langID` int(11) NOT NULL AUTO_INCREMENT,
  `language` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `lang` char(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `alt` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`langID`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4;");

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

##############################################################################################################################
##############################################################################################################################
if ($transaction->successful()) {
        return array('status' => 'success', 'message' => '<div class="list-group-item list-group-item-success">&nbsp;Install successful for Webspell RM Database: <i>settings_languages</i> <i class="bi bi-check2"></i></div>');
    } else {
        return array('status' => 'fail', 'message' => '- Failed to install Webspell-RM<br/>' . $transaction->getError());
    }
}
function update_rm_19($_database) {
  $transaction = new Transaction($_database);
##############################################################################################################################
##############################################################################################################################

$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "settings_module`");
$transaction->addQuery("CREATE TABLE `" . PREFIX . "settings_module` (
  `pluginID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `modulname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `themes_modulname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_activated` int(1) DEFAULT 0,
  `custom_activated` int(1) DEFAULT 0,
  `via_navigation` int(1) DEFAULT 0,
  `head_activated` int(1) DEFAULT 0,
  `content_head_activated` int(1) DEFAULT 0,
  `content_foot_activated` int(1) DEFAULT 0,
  `head_section_activated` int(1) DEFAULT 0,
  `foot_section_activated` int(1) DEFAULT 0,
  `modul_display` int(1) DEFAULT 0,
  `activate` int(1) DEFAULT 0,
  `sidebar` varchar(255) DEFAULT 'activated',
  `plugin_settings` int(1) DEFAULT 0,
  `plugin_module` int(1) DEFAULT 0,
  `plugin_widget` int(1) DEFAULT 0,
  `widget1` int(1) DEFAULT 0,
  `widget2` int(1) DEFAULT 0,
  `widget3` int(1) DEFAULT 0,
  PRIMARY KEY (`pluginID`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;");

$transaction->addQuery("INSERT INTO `".PREFIX."settings_module` (`pluginID`, `name`, `modulname`, `themes_modulname`, `full_activated`, `custom_activated`, `via_navigation`, `head_activated`, `content_head_activated`, `content_foot_activated`, `head_section_activated`, `foot_section_activated`, `modul_display`, `activate`, `sidebar`, `plugin_settings`, `plugin_module`, `plugin_widget`, `widget1`, `widget2`, `widget3`) VALUES
(1, 'Startpage', '', 'default', 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 'activated', 0, 1, 0, 0, 0, 0),
(2, '', 'startpage', 'default', 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 'activated', 0, 1, 0, 0, 0, 0),
(3, 'report', 'report', 'default', 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 'activated', 0, 0, 0, 0, 0, 0),
(4, 'My Profile', 'myprofile', 'default', 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 'activated', 0, 0, 0, 0, 0, 0),
(5, 'Error_404', 'error_404', 'default', 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 'activated', 0, 0, 0, 0, 0, 0),
(6, 'Static', 'static', 'default', 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 'activated', 0, 0, 0, 0, 0, 0),
(7, 'Imprint', 'imprint', 'default', 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 'activated', 0, 0, 0, 0, 0, 0),
(8, 'Privacy Policy', 'privacy_policy', 'default', 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 'activated', 0, 0, 0, 0, 0, 0),
(9, 'Contact', 'contact', 'default', 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 'activated', 0, 0, 0, 0, 0, 0),
(10, 'Loginoverview', 'loginoverview', 'default', 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 'activated', 0, 0, 0, 0, 0, 0),
(11, 'Register', 'register', 'default', 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 'activated', 0, 0, 0, 0, 0, 0),
(12, 'Lost Password', 'lostpassword', 'default', 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 'activated', 0, 0, 0, 0, 0, 0),
(13, 'Login', 'login', 'default', 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 'activated', 0, 0, 0, 0, 0, 0),
(14, 'Profile', 'profile', 'default', 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 'activated', 0, 0, 0, 0, 0, 0),
(15, 'Navigation Default', 'navigation_default', 'default', 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 'activated', 1, 0, 1, 1, 0, 0),
(16, 'Footer', 'footer', 'default', 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 'activated', 1, 0, 1, 1, 1, 1)");

##############################################################################################################################
##############################################################################################################################
if ($transaction->successful()) {
        return array('status' => 'success', 'message' => '<div class="list-group-item list-group-item-success">&nbsp;Install successful for Webspell RM Database: <i>settings_module</i> <i class="bi bi-check2"></i></div>');
    } else {
        return array('status' => 'fail', 'message' => '- Failed to install Webspell-RM<br/>' . $transaction->getError());
    }
}
function update_rm_20($_database) {
  $transaction = new Transaction($_database);
##############################################################################################################################
##############################################################################################################################

$transaction->addQuery("DROP TABLE IF EXISTS `".PREFIX."settings_plugins`");
$transaction->addQuery("CREATE TABLE IF NOT EXISTS `".PREFIX."settings_plugins` (
  `pluginID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `modulname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `info` text NOT NULL,
  `admin_file` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `activate` int(1) NOT NULL DEFAULT 1,
  `author` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `website` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `index_link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `hiddenfiles` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `version` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `widgetname1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
  `widgetname2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
  `widgetname3` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
  `widget_link1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
  `widget_link2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
  `widget_link3` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
  `modul_display` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`pluginID`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;");

$transaction->addQuery("INSERT INTO `".PREFIX."settings_plugins` (`pluginID`, `name`, `modulname`, `info`, `admin_file`, `activate`, `author`, `website`, `index_link`, `hiddenfiles`, `version`, `path`, `widgetname1`, `widgetname2`, `widgetname3`, `widget_link1`, `widget_link2`, `widget_link3`, `modul_display`) VALUES
(1, 'Startpage', '', '{[de]}STARTPAGE Hier kannst du die Einstellung f&#252;r deine Startseite vornehmen!!!{[it]}PAGINA INIZIALE Qui puoi effettuare le impostazioni per la tua home page!!!{[en]}START PAGE Here you can make the settings for your home page!!!', '', 1, '', '', '', '', '', '', '', '', '', '', '', '', 1),
(2, '', 'startpage', '{[de]}Kein Plugin. Bestandteil vom System!!!{[en]}No plugin. Part of the system!!!{[it]}Nessun plug-in. Parte del sistema!!!', '', 1, '', '', '', '', '', '', '', '', '', '', '', '', 0),
(3, 'Privacy Policy', 'privacy_policy', '{[de]}Kein Plugin. Bestandteil vom System!!!{[en]}No plugin. Part of the system!!!{[it]}Nessun plug-in. Parte del sistema!!!', '', 1, '', '', 'privacy_policy', '', '', '', '', '', '', '', '', '', 0),
(4, 'Imprint', 'imprint', '{[de]}Kein Plugin. Bestandteil vom System!!!{[en]}No plugin. Part of the system!!!{[it]}Nessun plug-in. Parte del sistema!!!', '', 1, '', '', 'imprint', '', '', '', '', '', '', '', '', '', 0),
(5, 'Static', 'static', '{[de]}Kein Plugin. Bestandteil vom System!!!{[en]}No plugin. Part of the system!!!{[it]}Nessun plug-in. Parte del sistema!!!', '', 1, '', '', 'static', '', '', '', '', '', '', '', '', '', 0),
(6, 'Error_404', 'error_404', '{[de]}Kein Plugin. Bestandteil vom System!!!{[en]}No plugin. Part of the system!!!{[it]}Nessun plug-in. Parte del sistema!!!', '', 1, '', '', 'error_404', '', '', '', '', '', '', '', '', '', 0),
(7, 'Profile', 'profile', '{[de]}Kein Plugin. Bestandteil vom System!!!{[en]}No plugin. Part of the system!!!{[it]}Nessun plug-in. Parte del sistema!!!', '', 1, '', '', 'profile', '', '', '', '', '', '', '', '', '', 0),
(8, 'Login', 'login', '{[de]}Kein Plugin. Bestandteil vom System!!!{[en]}No plugin. Part of the system!!!{[it]}Nessun plug-in. Parte del sistema!!!', '', 1, '', '', 'login', '', '', '', '', '', '', '', '', '', 0),
(9, 'Lost Password', 'lostpassword', '{[de]}Kein Plugin. Bestandteil vom System!!!{[en]}No plugin. Part of the system!!!{[it]}Nessun plug-in. Parte del sistema!!!', '', 1, '', '', 'lostpassword', '', '', '', '', '', '', '', '', '', 0),
(10, 'Contact', 'contact', '{[de]}Kein Plugin. Bestandteil vom System!!!{[en]}No plugin. Part of the system!!!{[it]}Nessun plug-in. Parte del sistema!!!', '', 1, '', '', 'contact', '', '', '', '', '', '', '', '', '', 0),
(11, 'Register', 'register', '{[de]}Kein Plugin. Bestandteil vom System!!!{[en]}No plugin. Part of the system!!!{[it]}Nessun plug-in. Parte del sistema!!!', '', 1, '', '', 'register', '', '', '', '', '', '', '', '', '', 0),
(12, 'My Profile', 'myprofile', '{[de]}Kein Plugin. Bestandteil vom System!!!{[en]}No plugin. Part of the system!!!{[it]}Nessun plug-in. Parte del sistema!!!', '', 1, '', '', 'myprofile', '', '', '', '', '', '', '', '', '', 0),
(13, 'Report', 'report', '{[de]}Kein Plugin. Bestandteil vom System!!!{[en]}No plugin. Part of the system!!!{[it]}Nessun plug-in. Parte del sistema!!!', '', 1, '', '', 'report', '', '', '', '', '', '', '', '', '', 0),
(14, 'Navigation Default', 'navigation_default', '{[de]}Mit diesem Plugin k&#246;nnt ihr euch die Default Navigation anzeigen lassen.{[en]}With this plugin you can display the default navigation.{[it]}Con questo plugin puoi visualizzare la navigazione predefinita. ', '', 1, 'T-Seven', 'https://webspell-rm.de', '', '', '0.1', 'includes/plugins/navigation_default/', 'Navigation Default', '', '', 'widget_navigation_default', '', '', 1),
(15, 'Footer', 'footer', '{[de]}Mit diesem Plugin k&#246;nnt ihr einen neuen Footer anzeigen lassen.{[en]}With this plugin you can have a new Footer displayed.{[it]}Con questo plugin puoi visualizzare un nuovo piè di pagina.', 'admin_footer', 1, 'T-Seven', 'https://webspell-rm.de', 'admin_footer', '', '0.1', 'includes/plugins/footer/', 'Default Footer Content', 'Easy Footer Content', 'Plugin_footer Content', 'widget_default_footer_content', 'widget_easyfooter_content', 'widget_plugin_footer_content', 1)");

##############################################################################################################################
##############################################################################################################################
if ($transaction->successful()) {
        return array('status' => 'success', 'message' => '<div class="list-group-item list-group-item-success">&nbsp;Install successful for Webspell RM Database: <i>settings_plugins</i> <i class="bi bi-check2"></i></div>');
    } else {
        return array('status' => 'fail', 'message' => '- Failed to install Webspell-RM<br/>' . $transaction->getError());
    }
}
function update_rm_21($_database) {
  $transaction = new Transaction($_database);
##############################################################################################################################
##############################################################################################################################


$transaction->addQuery("DROP TABLE IF EXISTS `".PREFIX."settings_privacy_policy`");
$transaction->addQuery("CREATE TABLE IF NOT EXISTS `".PREFIX."settings_privacy_policy` (
  `privacy_policyID` int(11) NOT NULL AUTO_INCREMENT,
  `date` int(14) NOT NULL,
  `privacy_policy_text` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`privacy_policyID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;");

$transaction->addQuery("INSERT INTO `" . PREFIX . "settings_privacy_policy` (`privacy_policyID`, `date`, `privacy_policy_text`) VALUES
(1, 1576689811, '{[de]} Datenschutz-Bestimmungen in deutscher Sprache.<br /><span style=\"color:#c0392b\"><strong>Konfigurieren Sie bitte Ihre Datenschutz-Bestimmungen!</strong></span><br />{[en]} Privacy Policy in English.<br /><span style=\"color:#c0392b\"><strong>Please configure your Privacy Policy!</strong></span>{[it]} Informativa sulla Privacy in Italiano.<br /><span style=\"color:#c0392b\"><strong>Si prega di configurare l&rsquo;Informativa sulla Privacy!</strong></span>')");

##############################################################################################################################
##############################################################################################################################
if ($transaction->successful()) {
        return array('status' => 'success', 'message' => '<div class="list-group-item list-group-item-success">&nbsp;Install successful for Webspell RM Database: <i>settings_privacy_policy</i> <i class="bi bi-check2"></i></div>');
    } else {
        return array('status' => 'fail', 'message' => '- Failed to install Webspell-RM<br/>' . $transaction->getError());
    }
}
function update_rm_22($_database) {
  $transaction = new Transaction($_database);
##############################################################################################################################
############################################################################################################################## 

$transaction->addQuery("DROP TABLE IF EXISTS `".PREFIX."settings_recaptcha`");
$transaction->addQuery("CREATE TABLE IF NOT EXISTS `".PREFIX."settings_recaptcha` (
  `activated` int(11) NOT NULL DEFAULT '0',
  `webkey` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `seckey` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;");

$transaction->addQuery("INSERT INTO `".PREFIX."settings_recaptcha` (`activated`, `webkey`, `seckey`) VALUES
(0, 'Web-Key', 'Sec-Key')");

##############################################################################################################################
##############################################################################################################################
if ($transaction->successful()) {
        return array('status' => 'success', 'message' => '<div class="list-group-item list-group-item-success">&nbsp;Install successful for Webspell RM Database: <i>settings_recaptcha</i> <i class="bi bi-check2"></i></div>');
    } else {
        return array('status' => 'fail', 'message' => '- Failed to install Webspell-RM<br/>' . $transaction->getError());
    }
}
function update_rm_23($_database) {
  $transaction = new Transaction($_database);
##############################################################################################################################
##############################################################################################################################

$transaction->addQuery("DROP TABLE IF EXISTS `".PREFIX."settings_social_media`");
$transaction->addQuery("CREATE TABLE IF NOT EXISTS `".PREFIX."settings_social_media` (
  `socialID` int(11) NOT NULL AUTO_INCREMENT,
  `twitch` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `facebook` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `twitter` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `youtube` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `rss` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `vine` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `flickr` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `linkedin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `instagram` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `since` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gametracker` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `discord` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `steam` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`socialID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;");

$transaction->addQuery("INSERT INTO `".PREFIX."settings_social_media` (`socialID`, `twitch`, `facebook`, `twitter`, `youtube`, `rss`, `vine`, `flickr`, `linkedin`, `instagram`, `since`, `gametracker`, `discord`, `steam`) VALUES
(1, 'https://www.twitch.tv/pulsradiocom', 'https://www.facebook.com/WebspellRM', 'https://twitter.com/webspell_rm', 'https://www.youtube.com/channel/UCE5yTn9ljzSnC_oMp9Jnckg', '-', '-', '-', '-', '-', '2023', '85.14.228.228:28960', '428995618971582473', '-')");

##############################################################################################################################
##############################################################################################################################
if ($transaction->successful()) {
        return array('status' => 'success', 'message' => '<div class="list-group-item list-group-item-success">&nbsp;Install successful for Webspell RM Database: <i>settings_social_media</i> <i class="bi bi-check2"></i></div>');
    } else {
        return array('status' => 'fail', 'message' => '- Failed to install Webspell-RM<br/>' . $transaction->getError());
    }
}
function update_rm_24($_database) {
  $transaction = new Transaction($_database);
##############################################################################################################################
##############################################################################################################################

$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "settings_startpage`");
$transaction->addQuery("CREATE TABLE `" . PREFIX . "settings_startpage` (
  `pageID` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `startpage_text` longtext NOT NULL,
  `date` int(14) NOT NULL,
  `displayed` varchar(255) DEFAULT '0',
  PRIMARY KEY (`pageID`)
) AUTO_INCREMENT=2
  DEFAULT CHARSET=utf8mb4");

$transaction->addQuery("INSERT INTO `".PREFIX."settings_startpage` (`pageID`, `title`, `startpage_text`, `date`, `displayed`) VALUES (1, '{[de]}Willkommen zu Webspell | RM{[en]}Welcome to Webspell | RM{[it]}Benvenuti su Webspell | RM', '<!-- Page Content -->\r\n<div class=\"container\"><!-- Jumbotron Header -->\r\n<h1>Webspell RM!</h1>\r\n\r\n<p>{[de]}</p>\r\n\r\n<p><strong><u>Was ist Webspell RM?</u></strong><br />\r\n<br />\r\nWebspell RM ist ein Clan &amp; Gamer CMS (<em>Content Management System</em>). Es basiert auf PHP, MySQL und der letzten webSPELL.org GitHub Version (4.3.0). Webspell RM l&auml;uft unter der General Public License. Siehe auch <a href=\"http://wiki.webspell-rm.de/index.php?site=static&amp;staticID=4\" target=\"_blank\">Lizenzvereinbarung</a>.</p>\r\n\r\n<p style=\"text-align:center\"><a class=\"btn btn-info\" href=\"http://demo.webspell-rm.de/\" rel=\"noopener\" role=\"button\" target=\"_blank\"><strong><u>WEBSPELL RM DEMO</u></strong></a> <a class=\"btn btn-success\" href=\"https://webspell-rm.de/index.php?site=forum\" rel=\"noopener\" role=\"button\" target=\"_blank\"><strong><u>WEBSPELL RM SUPPORT</u></strong></a></p>\r\n\r\n<p><strong><u>Was bietet Webspell | RM?</u></strong><br />\r\n<br />\r\nWebspell RM basiert auf Bootstrap und ist einfach anzupassen via Dashboard. Theoretisch sind alle Bootstrap Templates verwendbar. Als Editor wir der CKEditor verwendet. Das CMS ist Multi-Language f&auml;hig und liefert von Haus aus viele Sprachen mit. Das beliebte reCAPTCHA wurde als Spam Schutz integriert. Alle Plugins sind via Webspell RM Installer einfach und problemlos zu installieren.</p>\r\n<!-- Page Features -->\r\n\r\n<div class=\"row text-center\">\r\n<div class=\"col mb-4\">\r\n<div class=\"card h-100\" style=\"width:15rem\"><img alt=\"\" class=\"card-img-top img-fluid\" src=\"https://www.webspell-rm.de/includes/plugins/pic_update/images/173.jpg\" />\r\n<div class=\"card-body\">\r\n<h4>Webside</h4>\r\n\r\n</div>\r\n\r\n<div class=\"card-footer\"><a class=\"btn btn-primary\" href=\"#\">Find Out More!</a></div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col mb-4\">\r\n<div class=\"card h-100\" style=\"width:15rem\"><img alt=\"\" class=\"card-img-top\" src=\"https://www.webspell-rm.de//includes/plugins/pic_update/images/170.jpg\" />\r\n<div class=\"card-body\">\r\n<h4>Dashboard</h4>\r\n\r\n</div>\r\n\r\n<div class=\"card-footer\"><a class=\"btn btn-primary\" href=\"/admin/admincenter.php\" target=\"_blank\">Find Out More!</a></div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col mb-4\">\r\n<div class=\"card h-100\" style=\"width:15rem\"><img alt=\"\" class=\"card-img-top img-fluid\" src=\"https://www.webspell-rm.de/includes/plugins/pic_update/images/171.jpg\" />\r\n<div class=\"card-body\">\r\n<h4>Layout</h4>\r\n\r\n</div>\r\n\r\n<div class=\"card-footer\"><a class=\"btn btn-primary\" href=\"/admin/admincenter.php?site=settings_templates\" target=\"_blank\">Find Out More!</a></div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col mb-4\">\r\n<div class=\"card h-100\" style=\"width:15rem\"><img alt=\"\" class=\"card-img-top img-fluid\" src=\"https://www.webspell-rm.de/includes/plugins/pic_update/images/172.jpg\" />\r\n<div class=\"card-body\">\r\n<h4>Plugin-Installer</h4>\r\n\r\n</div>\r\n\r\n<div class=\"card-footer\"><a class=\"btn btn-primary\" href=\"/admin/admincenter.php?site=plugin_installer\" target=\"_blank\">Find Out More!</a></div>\r\n</div>\r\n</div>\r\n<!-- zweite Reihe -->\r\n\r\n<div class=\"col mb-4\">\r\n<div class=\"card h-100\" style=\"width:15rem\"><img alt=\"\" class=\"card-img-top img-fluid\" src=\"https://www.webspell-rm.de/includes/plugins/pic_update/images/174.jpg\" />\r\n<div class=\"card-body\">\r\n<h4>Theme-Installer</h4>\r\n\r\n</div>\r\n\r\n<div class=\"card-footer\"><a class=\"btn btn-primary\" href=\"/admin/admincenter.php?site=template_installer\" target=\"_blank\">Find Out More!</a></div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col mb-4\">\r\n<div class=\"card h-100\" style=\"width:15rem\"><img alt=\"\" class=\"card-img-top img-fluid\" src=\"https://www.webspell-rm.de/includes/plugins/pic_update/images/175.jpg\" />\r\n<div class=\"card-body\">\r\n<h4>Updater</h4>\r\n\r\n</div>\r\n\r\n<div class=\"card-footer\"><a class=\"btn btn-primary\" href=\"/admin/admincenter.php?site=update\" target=\"_blank\">Find Out More!</a></div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col mb-4\">\r\n<div class=\"card h-100\" style=\"width:15rem\"><img alt=\"\" class=\"card-img-top img-fluid\" src=\"https://www.webspell-rm.de/includes/plugins/pic_update/images/176.jpg\" />\r\n<div class=\"card-body\">\r\n<h4>Startpage</h4>\r\n\r\n</div>\r\n\r\n<div class=\"card-footer\"><a class=\"btn btn-primary\" href=\"/admin/admincenter.php?site=settings_startpage\" target=\"_blank\">Find Out More!</a></div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col mb-4\">\r\n<div class=\"card h-100\" style=\"width:15rem\"><img alt=\"\" class=\"card-img-top img-fluid\" src=\"https://www.webspell-rm.de/includes/plugins/pic_update/images/177.jpg\" />\r\n<div class=\"card-body\">\r\n<h4>Webspell-RM</h4>\r\n\r\n</div>\r\n\r\n<div class=\"card-footer\"><a class=\"btn btn-primary\" href=\"https://www.webspell-rm.de/forum.html\" target=\"_blank\">Support</a> <a class=\"btn btn-primary\" href=\"https://www.webspell-rm.de/wiki.html\" target=\"_blank\">WIKI</a></div>\r\n</div>\r\n</div>\r\n</div>\r\n<!-- /.row --></div>\r\n<!-- /.container -->\r\n\r\n<p>{[en]}</p>\r\n\r\n<p><strong><u>What is Webspell RM?</u></strong><br />\r\n<br />\r\nWebspell RM is a Clan &amp; Gamer CMS (Content Management System). It is based on PHP, MySQL and the latest webSPELL.org GitHub version (4.3.0). Webspell RM runs under the General Public License. See also license agreement <a href=\"http://wiki.webspell-rm.de/index.php?site=static&amp;staticID=4\" target=\"_blank\">license agreement</a>.</p>\r\n\r\n<p style=\"text-align:center\"><a class=\"btn btn-info\" href=\"http://demo.webspell-rm.de/\" rel=\"noopener\" role=\"button\" target=\"_blank\"><strong><u>WEBSPELL RM DEMO</u></strong></a> <a class=\"btn btn-success\" href=\"https://webspell-rm.de/index.php?site=forum\" rel=\"noopener\" role=\"button\" target=\"_blank\"><strong><u>WEBSPELL RM SUPPORT</u></strong></a></p>\r\n\r\n<p><strong><u>What does Webspell | RM offer?</u></strong><br />\r\n<br />\r\nWebspell RM is based on bootstrap and it is easy to customize via dashboard. Theoretically, all bootstrap templates can be used. As editor we use the CKEditor. The CMS is multi-language capable and comes with many native languages. The popular reCAPTCHA was integrated as spam protection. All plugins are easy to install via Webspell RM Installer.</p>\r\n<!-- Page Features -->\r\n\r\n<div class=\"row text-center\">\r\n<div class=\"col mb-4\">\r\n<div class=\"card h-100\" style=\"width:15rem\"><img alt=\"\" class=\"card-img-top img-fluid\" src=\"https://www.webspell-rm.de/includes/plugins/pic_update/images/173.jpg\" />\r\n<div class=\"card-body\">\r\n<h4>Webside</h4>\r\n\r\n</div>\r\n\r\n<div class=\"card-footer\"><a class=\"btn btn-primary\" href=\"#\">Find Out More!</a></div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col mb-4\">\r\n<div class=\"card h-100\" style=\"width:15rem\"><img alt=\"\" class=\"card-img-top\" src=\"https://www.webspell-rm.de//includes/plugins/pic_update/images/170.jpg\" />\r\n<div class=\"card-body\">\r\n<h4>Dashboard</h4>\r\n\r\n</div>\r\n\r\n<div class=\"card-footer\"><a class=\"btn btn-primary\" href=\"/admin/admincenter.php\" target=\"_blank\">Find Out More!</a></div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col mb-4\">\r\n<div class=\"card h-100\" style=\"width:15rem\"><img alt=\"\" class=\"card-img-top img-fluid\" src=\"https://www.webspell-rm.de/includes/plugins/pic_update/images/171.jpg\" />\r\n<div class=\"card-body\">\r\n<h4>Layout</h4>\r\n\r\n</div>\r\n\r\n<div class=\"card-footer\"><a class=\"btn btn-primary\" href=\"/admin/admincenter.php?site=settings_templates\" target=\"_blank\">Find Out More!</a></div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col mb-4\">\r\n<div class=\"card h-100\" style=\"width:15rem\"><img alt=\"\" class=\"card-img-top img-fluid\" src=\"https://www.webspell-rm.de/includes/plugins/pic_update/images/172.jpg\" />\r\n<div class=\"card-body\">\r\n<h4>Plugin-Installer</h4>\r\n\r\n</div>\r\n\r\n<div class=\"card-footer\"><a class=\"btn btn-primary\" href=\"/admin/admincenter.php?site=plugin_installer\" target=\"_blank\">Find Out More!</a></div>\r\n</div>\r\n</div>\r\n<!-- zweite Reihe -->\r\n\r\n<div class=\"col mb-4\">\r\n<div class=\"card h-100\" style=\"width:15rem\"><img alt=\"\" class=\"card-img-top img-fluid\" src=\"https://www.webspell-rm.de/includes/plugins/pic_update/images/174.jpg\" />\r\n<div class=\"card-body\">\r\n<h4>Theme-Installer</h4>\r\n\r\n</div>\r\n\r\n<div class=\"card-footer\"><a class=\"btn btn-primary\" href=\"/admin/admincenter.php?site=template_installer\" target=\"_blank\">Find Out More!</a></div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col mb-4\">\r\n<div class=\"card h-100\" style=\"width:15rem\"><img alt=\"\" class=\"card-img-top img-fluid\" src=\"https://www.webspell-rm.de/includes/plugins/pic_update/images/175.jpg\" />\r\n<div class=\"card-body\">\r\n<h4>Updater</h4>\r\n\r\n</div>\r\n\r\n<div class=\"card-footer\"><a class=\"btn btn-primary\" href=\"/admin/admincenter.php?site=update\" target=\"_blank\">Find Out More!</a></div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col mb-4\">\r\n<div class=\"card h-100\" style=\"width:15rem\"><img alt=\"\" class=\"card-img-top img-fluid\" src=\"https://www.webspell-rm.de/includes/plugins/pic_update/images/176.jpg\" />\r\n<div class=\"card-body\">\r\n<h4>Startpage</h4>\r\n\r\n</div>\r\n\r\n<div class=\"card-footer\"><a class=\"btn btn-primary\" href=\"/admin/admincenter.php?site=settings_startpage\" target=\"_blank\">Find Out More!</a></div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col mb-4\">\r\n<div class=\"card h-100\" style=\"width:15rem\"><img alt=\"\" class=\"card-img-top img-fluid\" src=\"https://www.webspell-rm.de/includes/plugins/pic_update/images/177.jpg\" />\r\n<div class=\"card-body\">\r\n<h4>Webspell-RM</h4>\r\n\r\n</div>\r\n\r\n<div class=\"card-footer\"><a class=\"btn btn-primary\" href=\"https://www.webspell-rm.de/forum.html\" target=\"_blank\">Support</a> <a class=\"btn btn-primary\" href=\"https://www.webspell-rm.de/wiki.html\" target=\"_blank\">WIKI</a></div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n<!-- /.row --></div><!-- /.container -->\r\n\r\n<p>{[it]}</p>\r\n\r\n<p><strong><u>Che cosa &egrave; Webspell RM? </u> </strong><br />\r\n<br />\r\nWebspell RM &egrave; un Clan Gamer CMS (Content Management System). Basato su PHP, MySQL ultima versione di webSPELL.org GitHub (4.3.0). Webspell RM funziona con la General Public License. Vedi anche il contratto di licenza <a href=\"http://wiki.webspell-rm.de/index.php?site=static&amp;staticID=4\" target=\"_blank\"> contratto di licenza </a>.</p>\r\n\r\n<p style=\"text-align:center\"><a class=\"btn btn-info\" href=\"http://demo.webspell-rm.de/\" rel=\"noopener\" role=\"button\" target=\"_blank\"><strong><u>DEMO WEBSPELL RM </u> </strong> </a> <a class=\"btn btn-success\" href=\"https://webspell-rm.de/index. php? site = forum \" rel=\" noopener \" role=\" button \" target=\" _ blank \"> <strong> <u> SUPPORTO RM WEBSPELL </u> </strong> </a></p>\r\n\r\n<p><strong><u>Cosa fa Webspell RM? </u> </strong><br />\r\n<br />\r\nWebspell RM &egrave; basato su bootstrap ed &egrave; facile da personalizzare tramite dashboard. Teoricamente, possono essere utilizzati tutti i modelli di bootstrap. Come editor usiamo CKEditor. Il CMS &egrave; multilingue e viene fornito con molte lingue native. Il popolare reCAPTCHA &egrave; stato integrato come protezione antispam. Tutti i plugin sono facili da installare tramite Webspell RM Installer.</p>\r\n<!-- Page Features -->\r\n\r\n<div class=\"row text-center\">\r\n<div class=\"col mb-4\">\r\n<div class=\"card h-100\" style=\"width:15rem\"><img alt=\"\" class=\"card-img-top img-fluid\" src=\"https://www.webspell-rm.de/includes/plugins/pic_update/images/173.jpg\" />\r\n<div class=\"card-body\">\r\n<h4>Sito Web</h4>\r\n\r\n</div>\r\n\r\n<div class=\"card-footer\"><a class=\"btn btn-primary\" href=\"#\">Find Out More!</a></div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col mb-4\">\r\n<div class=\"card h-100\" style=\"width:15rem\"><img alt=\"\" class=\"card-img-top\" src=\"https://www.webspell-rm.de//includes/plugins/pic_update/images/170.jpg\" />\r\n<div class=\"card-body\">\r\n<h4>Dashboard</h4>\r\n\r\n</div>\r\n\r\n<div class=\"card-footer\"><a class=\"btn btn-primary\" href=\"/admin/admincenter.php\" target=\"_blank\">Find Out More!</a></div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col mb-4\">\r\n<div class=\"card h-100\" style=\"width:15rem\"><img alt=\"\" class=\"card-img-top img-fluid\" src=\"https://www.webspell-rm.de/includes/plugins/pic_update/images/171.jpg\" />\r\n<div class=\"card-body\">\r\n<h4>Layout</h4>\r\n\r\n</div>\r\n\r\n<div class=\"card-footer\"><a class=\"btn btn-primary\" href=\"/admin/admincenter.php?site=settings_templates\" target=\"_blank\">Find Out More!</a></div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col mb-4\">\r\n<div class=\"card h-100\" style=\"width:15rem\"><img alt=\"\" class=\"card-img-top img-fluid\" src=\"https://www.webspell-rm.de/includes/plugins/pic_update/images/172.jpg\" />\r\n<div class=\"card-body\">\r\n<h4>Plugin-Installer</h4>\r\n\r\n</div>\r\n\r\n<div class=\"card-footer\"><a class=\"btn btn-primary\" href=\"/admin/admincenter.php?site=plugin_installer\" target=\"_blank\">Find Out More!</a></div>\r\n</div>\r\n</div>\r\n<!-- zweite Reihe -->\r\n\r\n<div class=\"col mb-4\">\r\n<div class=\"card h-100\" style=\"width:15rem\"><img alt=\"\" class=\"card-img-top img-fluid\" src=\"https://www.webspell-rm.de/includes/plugins/pic_update/images/174.jpg\" />\r\n<div class=\"card-body\">\r\n<h4>Theme-Installer</h4>\r\n\r\n</div>\r\n\r\n<div class=\"card-footer\"><a class=\"btn btn-primary\" href=\"/admin/admincenter.php?site=template_installer\" target=\"_blank\">Find Out More!</a></div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col mb-4\">\r\n<div class=\"card h-100\" style=\"width:15rem\"><img alt=\"\" class=\"card-img-top img-fluid\" src=\"https://www.webspell-rm.de/includes/plugins/pic_update/images/175.jpg\" />\r\n<div class=\"card-body\">\r\n<h4>Updater</h4>\r\n\r\n</div>\r\n\r\n<div class=\"card-footer\"><a class=\"btn btn-primary\" href=\"/admin/admincenter.php?site=update\" target=\"_blank\">Find Out More!</a></div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col mb-4\">\r\n<div class=\"card h-100\" style=\"width:15rem\"><img alt=\"\" class=\"card-img-top img-fluid\" src=\"https://www.webspell-rm.de/includes/plugins/pic_update/images/176.jpg\" />\r\n<div class=\"card-body\">\r\n<h4>Startpage</h4>\r\n\r\n</div>\r\n\r\n<div class=\"card-footer\"><a class=\"btn btn-primary\" href=\"/admin/admincenter.php?site=settings_startpage\" target=\"_blank\">Find Out More!</a></div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col mb-4\">\r\n<div class=\"card h-100\" style=\"width:15rem\"><img alt=\"\" class=\"card-img-top img-fluid\" src=\"https://www.webspell-rm.de/includes/plugins/pic_update/images/177.jpg\" />\r\n<div class=\"card-body\">\r\n<h4>Webspell-RM</h4>\r\n\r\n</div>\r\n\r\n<div class=\"card-footer\"><a class=\"btn btn-primary\" href=\"https://www.webspell-rm.de/forum.html\" target=\"_blank\">Support</a> <a class=\"btn btn-primary\" href=\"https://www.webspell-rm.de/wiki.html\" target=\"_blank\">WIKI</a></div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n<!-- /.row --></div><!-- /.container -->', 1616526018, 1)");

##############################################################################################################################
##############################################################################################################################
if ($transaction->successful()) {
        return array('status' => 'success', 'message' => '<div class="list-group-item list-group-item-success">&nbsp;Install successful for Webspell RM Database: <i>settings_startpage</i> <i class="bi bi-check2"></i></div>');
    } else {
        return array('status' => 'fail', 'message' => '- Failed to install Webspell-RM<br/>' . $transaction->getError());
    }
}
function update_rm_25($_database) {
  $transaction = new Transaction($_database);
##############################################################################################################################
##############################################################################################################################

$transaction->addQuery("DROP TABLE IF EXISTS `".PREFIX."settings_static`");
$transaction->addQuery("CREATE TABLE IF NOT EXISTS `".PREFIX."settings_static` (
  `staticID` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `accesslevel` int(1) NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` int(14) NOT NULL,
  `displayed` int(1) DEFAULT '0',
  PRIMARY KEY (`staticID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;");

##############################################################################################################################
##############################################################################################################################
if ($transaction->successful()) {
        return array('status' => 'success', 'message' => '<div class="list-group-item list-group-item-success">&nbsp;Install successful for Webspell RM Database: <i>settings_static</i> <i class="bi bi-check2"></i></div>');
    } else {
        return array('status' => 'fail', 'message' => '- Failed to install Webspell-RM<br/>' . $transaction->getError());
    }
}
function update_rm_26($_database) {
  $transaction = new Transaction($_database);
##############################################################################################################################
##############################################################################################################################

$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "settings_themes`");
$transaction->addQuery("CREATE TABLE `" . PREFIX . "settings_themes` (
  `themeID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `modulname` varchar(100) NOT NULL,
  `pfad` varchar(255) DEFAULT '''0''',
  `version` varchar(11) NOT NULL,
  `active` int(11) DEFAULT NULL,
  `express_active` int(11) NOT NULL DEFAULT 0,
  `nav1` varchar(255) NOT NULL DEFAULT '',
  `nav2` varchar(255) NOT NULL DEFAULT '',
  `nav3` varchar(255) NOT NULL DEFAULT '',
  `nav4` varchar(255) NOT NULL DEFAULT '',
  `nav5` varchar(255) NOT NULL DEFAULT '',
  `nav6` varchar(255) NOT NULL DEFAULT '',
  `nav7` varchar(255) NOT NULL DEFAULT '',
  `nav8` varchar(255) NOT NULL DEFAULT '',
  `nav9` varchar(255) NOT NULL DEFAULT '',
  `nav10` varchar(255) NOT NULL DEFAULT '',
  `nav11` varchar(255) NOT NULL DEFAULT '',
  `nav12` varchar(255) NOT NULL DEFAULT '',
  `nav_text_alignment` varchar(255) DEFAULT '0',
  `body1` text NOT NULL,
  `body2` varchar(255) NOT NULL DEFAULT '',
  `body3` varchar(255) NOT NULL DEFAULT '',
  `body4` varchar(255) NOT NULL DEFAULT '',
  `body5` varchar(255) NOT NULL DEFAULT '',
  `background_pic` varchar(255) DEFAULT '0',
  `border_radius` varchar(255) DEFAULT '0',
  `typo1` varchar(255) NOT NULL DEFAULT '',
  `typo2` varchar(255) NOT NULL DEFAULT '',
  `typo3` varchar(255) NOT NULL DEFAULT '',
  `typo4` varchar(255) NOT NULL DEFAULT '',
  `typo5` varchar(255) NOT NULL DEFAULT '',
  `typo6` varchar(255) NOT NULL DEFAULT '',
  `typo7` varchar(255) NOT NULL DEFAULT '',
  `typo8` varchar(255) NOT NULL DEFAULT '',
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
  `logo_pic` varchar(255) DEFAULT '0',
  `logotext1` varchar(255) NOT NULL DEFAULT '',
  `logotext2` varchar(255) NOT NULL DEFAULT '',
  `reg_pic` varchar(255) NOT NULL DEFAULT '',
  `reg1` varchar(255) NOT NULL DEFAULT '',
  `reg2` varchar(255) NOT NULL DEFAULT '',
  `headlines` varchar(255) DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '0',
PRIMARY KEY  (`themeID`)
) AUTO_INCREMENT=2
  DEFAULT CHARSET=utf8mb4");


$transaction->addQuery("INSERT IGNORE INTO `" . PREFIX . "settings_themes` (`themeID`, `name`, `modulname`, `pfad`, `version`, `active`, `express_active`, `nav1`, `nav2`, `nav3`, `nav4`, `nav5`, `nav6`, `nav7`, `nav8`, `nav9`, `nav10`, `nav11`, `nav12`, `nav_text_alignment`, `body1`, `body2`, `body3`, `body4`, `body5`, `background_pic`, `border_radius`, `typo1`, `typo2`, `typo3`, `typo4`, `typo5`, `typo6`, `typo7`, `typo8`, `card1`, `card2`, `foot1`, `foot2`, `foot3`, `foot4`, `foot5`, `foot6`, `calendar1`, `calendar2`, `carousel1`, `carousel2`, `carousel3`, `carousel4`, `logo_pic`, `logotext1`, `logotext2`, `reg_pic`, `reg1`, `reg2`, `headlines`, `sort`) VALUES
(1, 'Default', 'default', 'default', '0.2', 1, 0, 'rgb(51,51,51)', '16px', 'rgb(221,221,221)', 'rgb(254,130,29)', 'rgb(254,130,29)', '2px', 'rgb(221,221,221)', 'rgb(196,89,1)', '', 'rgb(51,51,51)', 'rgb(221,221,221)', 'rgb(101,100,100)', 'ms-auto', 'Roboto', '13px', 'rgb(255,255,255)', 'rgb(85,85,85)', 'rgb(236,236,236)', '', '0px', '', '', '', 'rgb(254,130,29)', '', '', '', 'rgb(196,89,1)', 'rgb(255,255,255)', 'rgb(221,221,221)', 'rgb(51,51,51)', '', '', '', '', '', '', '', 'rgb(255,255,255)', 'rgb(254,130,29)', 'rgb(255,255,255)', 'rgb(254,130,29)', 'logo.png', '', '', 'login_bg.png', 'rgb(254,130,29)', 'rgb(255,255,255)', 'headlines_01.css', 1)");

##############################################################################################################################
##############################################################################################################################
if ($transaction->successful()) {
        return array('status' => 'success', 'message' => '<div class="list-group-item list-group-item-success">&nbsp;Install successful for Webspell RM Database: <i>settings_themes</i> <i class="bi bi-check2"></i></div>');
    } else {
        return array('status' => 'fail', 'message' => '- Failed to install Webspell-RM<br/>' . $transaction->getError());
    }
}
function update_rm_27($_database) {
  $transaction = new Transaction($_database);
##############################################################################################################################
##############################################################################################################################



$transaction->addQuery("DROP TABLE IF EXISTS `".PREFIX."settings_widgets`");
$transaction->addQuery("CREATE TABLE IF NOT EXISTS `".PREFIX."settings_widgets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `position` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `modulname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `themes_modulname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `widget` varchar(255) DEFAULT 0,
  `widgetname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 0,
  `widgetdatei` varchar(255) DEFAULT 0,
  `activate` int(11) DEFAULT 0,
  `number` int(1) NOT NULL,
  `sort` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;");

$transaction->addQuery("INSERT INTO `".PREFIX."settings_widgets` (`id`, `position`, `description`, `modulname`, `themes_modulname`, `widget`, `widgetname`, `widgetdatei`, `activate`, `number`, `sort`) VALUES
(1, 'page_navigation_widget', 'page_navigation_widget', 'navigation_default', 'default', 'widget1', 'Navigation Default', 'widget_navigation_default', 0, 1, 1),
(2, 'page_footer_widget', 'page_footer_widget', 'footer', 'default', 'widget2', 'Easy Footer Content', 'widget_easyfooter_content', 0, 1, 0)");

##############################################################################################################################
##############################################################################################################################
if ($transaction->successful()) {
        return array('status' => 'success', 'message' => '<div class="list-group-item list-group-item-success">&nbsp;Install successful for Webspell RM Database: <i>settings_widgets</i> <i class="bi bi-check2"></i></div>');
    } else {
        return array('status' => 'fail', 'message' => '- Failed to install Webspell-RM<br/>' . $transaction->getError());
    }
}
function update_rm_28($_database) {
  $transaction = new Transaction($_database);
##############################################################################################################################
##############################################################################################################################


$transaction->addQuery("DROP TABLE IF EXISTS `".PREFIX."tags`");
$transaction->addQuery("CREATE TABLE IF NOT EXISTS `".PREFIX."tags` (
  `rel` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ID` int(11) NOT NULL,
  `tag` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;");

##############################################################################################################################
##############################################################################################################################
if ($transaction->successful()) {
        return array('status' => 'success', 'message' => '<div class="list-group-item list-group-item-success">&nbsp;Install successful for Webspell RM Database: <i>tags</i> <i class="bi bi-check2"></i></div>');
    } else {
        return array('status' => 'fail', 'message' => '- Failed to install Webspell-RM<br/>' . $transaction->getError());
    }
}
function update_rm_29($_database) {
  $transaction = new Transaction($_database);
##############################################################################################################################
##############################################################################################################################

global $adminname;
global $adminpassword;
global $adminmail;
    
$new_pepper = Gen_PasswordPepper();
$adminhash = password_hash($adminpassword.$new_pepper,PASSWORD_BCRYPT,array('cost'=>12));

$transaction->addQuery("DROP TABLE IF EXISTS `".PREFIX."user`");
$transaction->addQuery("CREATE TABLE IF NOT EXISTS `".PREFIX."user` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `registerdate` int(14) NOT NULL DEFAULT '0',
  `lastlogin` int(14) NOT NULL DEFAULT '0',
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `password_hash` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `password_pepper` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `nickname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `email_hide` int(1) NOT NULL DEFAULT '1',
  `email_change` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_activate` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `lastname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `gender` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'select_gender',
  `town` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `birthday` date NOT NULL,
  `facebook` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `twitter` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `twitch` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `steam` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `instagram` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `youtube` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `discord` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `usertext` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `userpic` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `homepage` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `about` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pmgot` int(11) NOT NULL DEFAULT '0',
  `pmsent` int(11) NOT NULL DEFAULT '0',
  `visits` int(11) NOT NULL DEFAULT '0',
  `banned` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ban_reason` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `topics` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `articles` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `demos` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `files` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gallery_pictures` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `special_rank` int(11) DEFAULT '0',
  `mailonpm` int(1) NOT NULL DEFAULT '0',
  `userdescription` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `activated` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `language` varchar(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_format` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'd.m.Y',
  `time_format` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'H:i',
  `newsletter` int(1) DEFAULT '1',
  `links` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `videos` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `games` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `projectlist` text NOT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;");


$transaction->addQuery("INSERT INTO `".PREFIX."user` (`userID`, `registerdate`, `lastlogin`, `password`, `password_hash`, `password_pepper`, `nickname`, `email`, `email_hide`, `email_change`, `email_activate`, `firstname`, `lastname`, `gender`, `town`, `birthday`, `facebook`, `twitter`, `twitch`, `steam`, `instagram`, `youtube`, `discord`, `avatar`, `usertext`, `userpic`, `homepage`, `about`, `pmgot`, `pmsent`, `visits`, `banned`, `ban_reason`, `ip`, `topics`, `articles`, `demos`, `files`, `gallery_pictures`, `special_rank`, `mailonpm`, `userdescription`, `activated`, `language`, `date_format`, `time_format`, `newsletter`, `links`, `videos`, `games`, `projectlist`) VALUES
(1, '".time()."', '".time()."', '', '".$adminhash."', '".$new_pepper."', '".$adminname."', '".$adminmail."', 1, '', '', '', '', 'select_gender', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, NULL, '', '', '|', '', '', '', '', 0, 0, '', '1', '', 'd.m.Y', 'H:i', 1, '', '', '', '')");

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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;");

$transaction->addQuery("INSERT INTO `".PREFIX."user_groups` (`usgID`, `userID`, `news`, `news_writer`, `newsletter`, `polls`, `forum`, `moderator`, `clanwars`, `feedback`, `user`, `page`, `files`, `cash`, `gallery`, `super`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1)"); 

global $adminname;
$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "user_nickname`");
$transaction->addQuery("CREATE TABLE `" . PREFIX . "user_nickname` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `nickname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`userID`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;");

$transaction->addQuery("INSERT INTO `".PREFIX."user_nickname` (`userID`, `nickname`) VALUES (1, '".$adminname."')");

$transaction->addQuery("DROP TABLE IF EXISTS `".PREFIX."user_visitors`");
$transaction->addQuery("CREATE TABLE IF NOT EXISTS `".PREFIX."user_visitors` (
  `visitID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL DEFAULT '0',
  `visitor` int(11) NOT NULL DEFAULT '0',
  `date` int(14) NOT NULL DEFAULT '0',
  PRIMARY KEY (`visitID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;");

##############################################################################################################################
##############################################################################################################################
if ($transaction->successful()) {
        return array('status' => 'success', 'message' => '
          <div class="list-group-item list-group-item-success">&nbsp;Install successful for Webspell RM Database: <i>user</i> <i class="bi bi-check2"></i></div><br/>
          <div class="list-group-item list-group-item-success">&nbsp;Install successful for Webspell RM Database: <i>user_groups</i> <i class="bi bi-check2"></i></div><br/>
          <div class="list-group-item list-group-item-success">&nbsp;Install successful for Webspell RM Database: <i>user_nickname</i> <i class="bi bi-check2"></i></div><br/>
          <div class="list-group-item list-group-item-success">&nbsp;Install successful for Webspell RM Database: <i>user_visitors</i> <i class="bi bi-check2"></i></div>');
    } else {
        return array('status' => 'fail', 'message' => '- Failed to install Webspell-RM<br/>' . $transaction->getError());
    }
}
function update_rm_30($_database) {
  $transaction = new Transaction($_database);
##############################################################################################################################
##############################################################################################################################

$transaction->addQuery("DROP TABLE IF EXISTS `".PREFIX."whoisonline`");
$transaction->addQuery("CREATE TABLE IF NOT EXISTS `".PREFIX."whoisonline` (
  `time` int(14) NOT NULL DEFAULT '0',
  `ip` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `userID` int(11) NOT NULL DEFAULT '0',
  `site` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;");

$transaction->addQuery("DROP TABLE IF EXISTS `".PREFIX."whowasonline`");
$transaction->addQuery("CREATE TABLE IF NOT EXISTS `".PREFIX."whowasonline` (
  `time` int(14) NOT NULL DEFAULT '0',
  `ip` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `userID` int(11) NOT NULL DEFAULT '0',
  `site` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;");

##############################################################################################################################
##############################################################################################################################
if ($transaction->successful()) {
        return array('status' => 'success', 'message' => '
          <div class="list-group-item list-group-item-success">&nbsp;Install successful for Webspell RM Database: <i>whoisonline</i> <i class="bi bi-check2"></i></div><br/>
          <div class="list-group-item list-group-item-success">&nbsp;Install successful for Webspell RM Database: <i>whowasonline</i> <i class="bi bi-check2"></i></div>');
    } else {
        return array('status' => 'fail', 'message' => '- Failed to install Webspell-RM<br/>' . $transaction->getError());
    }
}
function update_rm_31($_database) {
  $transaction = new Transaction($_database);
##############################################################################################################################
##############################################################################################################################
 if ($transaction->successful()) {
      return array('status' => 'success', 'message' => '&nbsp;Webspell-RM Installation Ver.: <span class="badge bg-success">2.1.4</span> / <b>Last Stand:</b> <span class="badge bg-success">25.03.2024</span><br>');
  } else {
      return array('status' => 'fail', 'message' => '-   Webspell-RM Installation Ver.: <b>2.1.4 / <b>Last Stand:</b> 02.01.2024<br/>' . $transaction->getError());
  }

}

?>