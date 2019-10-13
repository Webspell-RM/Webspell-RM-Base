<?php
/*¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯\
| _    _  ___  ___  ___  ___  ___  __    __      ___   __  __       |
|( \/\/ )(  _)(  ,)/ __)(  ,\(  _)(  )  (  )    (  ,) (  \/  )      |
| \    /  ) _) ) ,\\__ \ ) _/ ) _) )(__  )(__    )  \  )    (       |
|  \/\/  (___)(___/(___/(_)  (___)(____)(____)  (_)\_)(_/\/\_)      |
|                       ___          ___                            |
|                      |__ \        / _ \                           |
|                         ) |      | | | |                          |
|                        / /       | | | |                          |
|                       / /_   _   | |_| |                          |
|                      |____| (_)   \___/                           |
\___________________________________________________________________/
/                                                                   \
|        Copyright 2005-2018 by webspell.org / webspell.info        |
|        Copyright 2018-2019 by webspell-rm.de                      |
|                                                                   |
|        - Script runs under the GNU GENERAL PUBLIC LICENCE         |
|        - It's NOT allowed to remove this copyright-tag            |
|        - http://www.fsf.org/licensing/licenses/gpl.html           |
|                                                                   |
|               Code based on WebSPELL Clanpackage                  |
|                 (Michael Gruber - webspell.at)                    |
\___________________________________________________________________/
/                                                                   \
|                     WEBSPELL RM Version 2.0                       |
|           For Support, Mods and the Full Script visit             |
|                       webspell-rm.de                              |
\__________________________________________________________________*/
class Transaction
{
    private $database;
    private $success;
    private $errors = array();

    function __construct($database)
    {
        $this->database = $database;
        $this->success = true;
    }

    function addQuery($query)
    {
        if (!mysqli_query($this->database, $query)) {
            $this->success = false;
            $this->errors[] = mysqli_error($this->database);
        }
    }

    function successful()
    {
        if ($this->success) {
            $this->database->commit();
            return true;
        } else {
            //$this->error = mysqli_error($this->database);
            $this->database->rollback();
            return false;
        }
    }

    function getError()
    {
        return implode("<br/>", $this->errors);
    }
}

function update_progress($functions_to_call)
{
    return '<div id="todo_list" style="display:none;">' . json_encode($functions_to_call) . '</div><div class="progress">
  <div id="progress_bar" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
    <span class="sr-only">0%</span>
  </div>
</div><div id="details_text" style="height: 150px; overflow-y:scroll;"></div>';
}

function update_clearfolder($_database)
{
    global $_language;
    include("../system/func/filesystem.php");
    $remove_install = @rm_recursive("./");
    if ($remove_install) {
        return array('status' => 'success', 'message' => $_language->module['folder_removed']);
    } else {
        return array('status' => 'success', 'message' => $_language->module['delete_folder']);
    }
}

/** fixme */
function updateMySQLConfig()
{
    global $_language;
    include('../system/sql.php');
    /** variables from _mysql.php
     * @var string $host
     * @var string $user
     * @var string $pwd
     * @var string $db
     */
    $new_content = '<?php
$host = ' . var_export($host, true) . ';
$user = ' . var_export($user, true) . ';
$pwd = ' . var_export($pwd, true) . ';
$db = ' . var_export($db, true) . ';
if (!defined("PREFIX")) {
    define("PREFIX", ' . var_export(PREFIX, true) . ');
}
';
    $ret = file_put_contents('../system/sql.php', $new_content);
    if ($ret === false) {
        echo $_language->module['write_failed'];
    }
}

function update_base_1($_database)
{
    $transaction = new Transaction($_database);


    $transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "banned_ips`");
    $transaction->addQuery("CREATE TABLE `" . PREFIX . "banned_ips` (
  `banID` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(255) NOT NULL,
  `deltime` int(15) NOT NULL,
  `reason` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`banID`)
) AUTO_INCREMENT=1
  DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");



    $transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "forum_topics_spam`");
    $transaction->addQuery("CREATE TABLE `" . PREFIX . "forum_topics_spam` (
  `topicID` int(11) NOT NULL AUTO_INCREMENT,
  `boardID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `date` int(14) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `topic` varchar(255) NOT NULL,
  `sticky` int(1) NOT NULL,
  `message` text NOT NULL,
  `rating` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`topicID`),
  KEY `date` (`date`)
) AUTO_INCREMENT=1
  DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci"); 

  $transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "forum_posts_spam`");
    $transaction->addQuery("CREATE TABLE `" . PREFIX . "forum_posts_spam` (
  `postID` int(11) NOT NULL AUTO_INCREMENT,
  `boardID` int(11) NOT NULL DEFAULT '0',
  `topicID` int(11) NOT NULL DEFAULT '0',
  `date` int(14) NOT NULL DEFAULT '0',
  `poster` int(11) NOT NULL DEFAULT '0',
  `message` text NOT NULL,
  `rating` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`postID`)
) AUTO_INCREMENT=1
  DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci"); 


  $transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "plugins_forum_moderators`");
    $transaction->addQuery("CREATE TABLE `" . PREFIX . "plugins_forum_moderators` (
  `modID` int(11) NOT NULL AUTO_INCREMENT,
  `boardID` int(11) NOT NULL DEFAULT '0',
  `userID` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`modID`)
) AUTO_INCREMENT=1
  DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");   

 
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



$transaction->addQuery("CREATE TABLE `" . PREFIX . "captcha` (
  `hash` VARCHAR(255) NOT NULL DEFAULT '',
  `captcha` INT(11) NOT NULL DEFAULT '0',
  `deltime` INT(11) NOT NULL DEFAULT '0',
  PRIMARY KEY  (`hash`)
  ) DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");


$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "settings_recaptcha`");
    $transaction->addQuery("CREATE TABLE `" . PREFIX . "settings_recaptcha` (
   `activated` integer NOT NULL default '0',
  `webkey` varchar(255) NOT NULL,
  `seckey` varchar(255) NOT NULL
) AUTO_INCREMENT=1
  DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");

$transaction->addQuery("INSERT IGNORE INTO `" . PREFIX . "settings_recaptcha` (`activated`, `webkey`, `seckey`) VALUES
(0, 'Web-Key', 'Sec-Key')");  


if ($transaction->successful()) {
        return array('status' => 'success', 'message' => 'Created tables starting with "a"');
    } else {
        return array('status' => 'fail', 'message' => 'Failed to create tables starting with "a"<br/>' . $transaction->getError());
    }
}

function update_base_2($_database)
{

 $transaction = new Transaction($_database);




$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "cookies`");
    $transaction->addQuery("CREATE TABLE `" . PREFIX . "cookies` (
  `userID` int(11) NOT NULL,
  `cookie` binary(64) NOT NULL,
  `expiration` int(14) NOT NULL,
  PRIMARY KEY (`userID`, `cookie`),
  INDEX (`expiration`)
    )");


    $transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "counter`");
    $transaction->addQuery("CREATE TABLE `" . PREFIX . "counter` (
  `hits` int(20) NOT NULL default '0',
  `online` int(14) NOT NULL default '0',
  `maxonline` int(11) NOT NULL
) DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");

    $transaction->addQuery("INSERT IGNORE INTO `" . PREFIX . "counter` (`hits`, `online`) VALUES (1, '" . time() . "')");

    $transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "counter_iplist`");
    $transaction->addQuery("CREATE TABLE `" . PREFIX . "counter_iplist` (
  `dates` varchar(255) NOT NULL default '',
  `del` int(20) NOT NULL default '0',
  `ip` varchar(255) NOT NULL default ''
) DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");

    $transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "counter_stats`");
    $transaction->addQuery("CREATE TABLE `" . PREFIX . "counter_stats` (
  `dates` varchar(255) NOT NULL default '',
  `count` int(20) NOT NULL default '0'
) DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");


 

     if ($transaction->successful()) {
        return array('status' => 'success', 'message' => 'Created tables starting with "b"');
    } else {
        return array('status' => 'fail', 'message' => 'Failed to create tables starting with "b"<br/>' . $transaction->getError());
    }
}

function update_base_3($_database)
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
(1, '{[de]}Hauptteil{[en]}Main Panel', 'fas fa-chart-bar', 'any', 0, 1),
(2, '{[de]}Benutzer Administration{[en]}User Administration', 'fas fa-users', 'user', 0, 2),
(3, '{[de]}Spam{[en]}Spam', 'fas fa-exclamation-triangle', 'user', 0, 3),
(4, '{[de]}Layout{[en]}Layout', 'far fa-image', 'cash', 0, 4),
(5, '{[de]}Systemverwaltung{[en]}System Management', 'fas fa-cogs', 'page', 0, 5),
(6, '{[de]}Plugin Verwaltung{[en]}Plugin Administration', 'fas fa-puzzle-piece', 'page', 0, 6),
(7, '{[de]}Plugins Webseiteninhalt{[en]}Plugins Website Content', '', 'page', 0, 7),
(8, '{[de]}Plugins System / Social Media{[en]}Plugins System / Social Media', '', 'page', 0, 8),
(9, '{[de]}Plugins Webseiten Layout{[en]}Plugins Web Pages Layout', '', 'page', 0, 9)");


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
(1, 1, '{[de]}Server-Info{[en]}Overview', 'overview', 'admincenter.php?site=overview', 'any', 1),
(2, 1, '{[de]}Seiten Statistiken{[en]}Page Statistics', 'page_statistic', 'admincenter.php?site=page_statistic', 'any', 2),
(3, 1, '{[de]}Besucher Statistiken{[en]}Visitor Statistics', 'visitor_statistic', 'admincenter.php?site=visitor_statistic', 'any', 3),
(4, 2, '{[de]}Registrierte Benutzer{[en]}Registered Users', 'users', 'admincenter.php?site=users', 'forum', 1),
(5, 2, '{[de]}Teams{[en]}Squads', 'squads', 'admincenter.php?site=squads', 'user', 2),
(6, 2, '{[de]}Clanmitglieder{[en]}Clanmembers', 'members', 'admincenter.php?site=members', 'user', 3),
(7, 2, '{[de]}Kontakte{[en]}Contacts', 'contact', 'admincenter.php?site=contact', 'user', 4),
(8, 3, '{[de]}Geblockte Inhalte{[en]}Blocked Content', 'spam', 'admincenter.php?site=spam&amp;action=forum_spam', 'user', 1),
(9, 3, '{[de]}Nutzer l&ouml;schen{[en]}Remove User', 'spam', 'admincenter.php?site=spam&amp;action=user', 'user', 2),
(10, 3, '{[de]}Multi-Accounts{[en]}Multi-Accounts', 'spam', 'admincenter.php?site=spam&amp;action=multi', 'user', 3),
(11, 3, '{[de]}gebannte IP`s{[en]}banned IP`s', '', 'admincenter.php?site=banned_ips', 'user', 4),
(12, 4, '{[de]}Einstellungen{[en]}Settings', 'settings', 'admincenter.php?site=settings', 'page', 1),
(13, 4, '{[de]}Button{[en]}Button', 'buttons', 'admincenter.php?site=settings_buttons', 'feedback', 3),
(14, 4, '{[de]}Style{[en]}Style', 'styles', 'admincenter.php?site=settings_styles', 'page', 2),
(15, 4, '{[de]}Module{[en]}Module', 'moduls', 'admincenter.php?site=settings_moduls', 'page', 4),
(19, 4, '{[de]}.css{[en]}.css', 'css', 'admincenter.php?site=settings_css', 'page', 5),
(20, 4, '{[de]}Themes{[en]}Themes', 'templates', 'admincenter.php?site=settings_templates', 'page', 7),
(21, 4, '{[de]}Logo{[en]}Logo', 'logo', 'admincenter.php?site=settings_logo', 'page', 6),
(22, 5, '{[de]}Admincenter Navigation{[en]}Admincenter Navigation', 'dashnavi', 'admincenter.php?site=dashboard_navigation', 'page', 1),
(23, 5, '{[de]}Webseiten Navigation{[en]}Webside Navigation', 'webnavi', 'admincenter.php?site=webside_navigation', 'page', 2),
(24, 5, '{[de]}Startseite{[en]}Start Page', 'startpage', 'admincenter.php?site=settings_startpage', 'page', 3),
(25, 5, '{[de]}Statische Seiten{[en]}Static Pages', 'static', 'admincenter.php?site=settings_static', 'page', 4),
(27, 5, '{[de]}Spiele{[en]}Games', 'games', 'admincenter.php?site=settings_games', 'page', 5),
(28, 5, '{[de]}Mod-Rewrite{[en]}Mod-Rewrite', 'modrewrite', 'admincenter.php?site=modrewrite', 'page', 6),
(29, 5, '{[de]}E-Mail{[en]}E-Mail', 'email', 'admincenter.php?site=email', 'page', 7),
(30, 6, '{[de]}Plugin Manager{[en]}Plugin Manager', 'plugin_manager', 'admincenter.php?site=plugin-manager', 'page', 1),
(31, 6, '{[de]}Plugin Installer{[en]}Plugin Installer', 'plugin_installer', 'admincenter.php?site=plugin-installer', 'page', 2),
(32, 6, '{[de]}Themes Installer{[en]}Themes Installer', 'template_installer', 'admincenter.php?site=template-installer', 'page', 3),
(33, 6, '{[de]}Widget Verwaltung{[en]}Widget Control', 'widgets', 'admincenter.php?site=plugin-widgets', 'page', 4)");
 


$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "email`");
    $transaction->addQuery("CREATE TABLE `" . PREFIX . "email` (
  `emailID` int(1) NOT NULL,
  `user` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `host` varchar(255) NOT NULL,
  `port` int(5) NOT NULL,
  `debug` int(1) NOT NULL,
  `auth` int(1) NOT NULL,
  `html` int(1) NOT NULL,
  `smtp` int(1) NOT NULL,
  `secure` int(1) NOT NULL
) DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");

    $transaction->addQuery("INSERT INTO `" . PREFIX . "email` (emailID, user, password, host, port, debug, auth, html, smtp, secure)
VALUES (1, '', '', '', 25, 0, 0, 1, 0, 0)");


$transaction->addQuery("CREATE TABLE `" . PREFIX . "failed_login_attempts` (
  `ip` varchar(255) NOT NULL default '',
  `wrong` int(2) default '0',
  PRIMARY KEY  (`ip`)
) DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");


$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "plugins_forum_groups`");
    $transaction->addQuery("CREATE TABLE `" . PREFIX . "plugins_forum_groups` (
  `fgrID` int(11) NOT NULL auto_increment,
  `name` varchar(32) NOT NULL default '0',
  PRIMARY KEY  (`fgrID`)
  ) AUTO_INCREMENT=0
  DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");

    $transaction->addQuery("INSERT INTO `" . PREFIX . "plugins_forum_groups` ( `fgrID` , `name` ) VALUES ('1', 'Intern board users');");


$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "plugins_forum_ranks`");
    $transaction->addQuery("CREATE TABLE `" . PREFIX . "plugins_forum_ranks` (
  `rankID` int(11) NOT NULL AUTO_INCREMENT,
  `rank` varchar(255) NOT NULL default '',
  `pic` varchar(255) NOT NULL default '',
  `postmin` int(11) NOT NULL default '0',
  `postmax` int(11) NOT NULL default '0',
  `special` int(1) NULL DEFAULT '0',
  PRIMARY KEY  (`rankID`)
) AUTO_INCREMENT=9
  DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");


$transaction->addQuery("INSERT INTO `" . PREFIX . "plugins_forum_ranks` (`rankID`, `rank`, `pic`, `postmin`, `postmax`, `special`) VALUES
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


     if ($transaction->successful()) {
        return array('status' => 'success', 'message' => 'Created tables starting with "c"');
    } else {
        return array('status' => 'fail', 'message' => 'Failed to create tables starting with "c"<br/>' . $transaction->getError());
    }
}

function update_base_4($_database)
{
        $transaction = new Transaction($_database);

$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "settings_languages`");
    $transaction->addQuery("CREATE TABLE `" . PREFIX . "settings_languages` (
  `langID` int(11) NOT NULL AUTO_INCREMENT,
  `language` varchar(255) NOT NULL DEFAULT '',
  `lang` char(2) NOT NULL DEFAULT '',
  `alt` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`langID`)
) PACK_KEYS=0 AUTO_INCREMENT=37
  DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");

$transaction->addQuery("INSERT INTO `" . PREFIX . "settings_languages` (`langID`, `language`, `lang`, `alt`) VALUES
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


$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "settings_games`");
    $transaction->addQuery("CREATE TABLE `" . PREFIX . "settings_games` (
  `gameID` int(3) NOT NULL AUTO_INCREMENT,
  `tag` varchar(10) NOT NULL default '',
  `name` varchar(225) NOT NULL default '',
  PRIMARY KEY  (`gameID`)
) PACK_KEYS=0 AUTO_INCREMENT=60
  DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");

$transaction->addQuery("INSERT INTO `" . PREFIX . "settings_games` (`gameID`, `tag`, `name`) VALUES
(1, 'cs', 'Counter-Strike'),
(2, 'ut', 'Unreal Tournament'),
(3, 'to', 'Tactical Ops'),
(4, 'hl2', 'Halflife 2'),
(5, 'wc3', 'Warcraft 3'),
(6, 'hl', 'Halflife'),
(7, 'bf', 'Battlefield 1942'),
(8, 'aa', 'Americas Army'),
(9, 'aoe', 'Age of Empires 3'),
(10, 'b21', 'Battlefield 2142'),
(11, 'bf2', 'Battlefield 2'),
(12, 'bfv', 'Battlefield Vietnam'),
(13, 'c3d', 'Carom 3D'),
(14, 'cc3', 'Command &amp; Conquer'),
(15, 'cd2', 'Call of Duty 2'),
(16, 'cd4', 'Call of Duty 4'),
(17, 'cod', 'Call of Duty'),
(18, 'coh', 'Company of Heroes'),
(19, 'crw', 'Crysis Wars'),
(20, 'cry', 'Crysis'),
(21, 'css', 'Counter-Strike: Source'),
(22, 'cz', 'Counter-Strike: Condition Zero'),
(23, 'dds', 'Day of Defeat: Source'),
(24, 'dod', 'Day of Defeat'),
(25, 'dow', 'Dawn of War'),
(26, 'dta', 'DotA'),
(27, 'et', 'Enemy Territory'),
(28, 'fc', 'FarCry'),
(29, 'fer', 'F.E.A.R.'),
(30, 'fif', 'FIFA'),
(31, 'fl', 'Frontlines: Fuel of War'),
(32, 'hal', 'HALO'),
(33, 'jk2', 'Jedi Knight 2'),
(34, 'jk3', 'Jedi Knight 3'),
(35, 'lfs', 'Live for Speed'),
(36, 'lr2', 'LotR: Battle for Middle Earth 2'),
(37, 'lr', 'LotR: Battle for Middle Earth'),
(38, 'moh', 'Medal of Hornor'),
(39, 'nfs', 'Need for Speed'),
(40, 'pes', 'Pro Evolution Soccer'),
(41, 'q3', 'Quake 3'),
(42, 'q4', 'Quake 4'),
(43, 'ql', 'Quakelive'),
(44, 'rdg', 'Race Driver Grid'),
(45, 'sc2', 'Starcraft 2'),
(46, 'sc', 'Starcraft'),
(47, 'sof', 'Soldier of Fortune 2'),
(48, 'sw2', 'Star Wars: Battlefront 2'),
(49, 'sw', 'Star Wars: Battlefront'),
(50, 'swa', 'SWAT 4'),
(51, 'tf2', 'Team Fortress 2'),
(52, 'tf', 'Team Fortress'),
(53, 'tm', 'TrackMania'),
(54, 'ut3', 'Unreal Tournament 3'),
(55, 'ut4', 'Unreal Tournament 2004'),
(56, 'war', 'War Rock'),
(57, 'wic', 'World in Conflict'),
(58, 'wow', 'World of Warcraft'),
(59, 'wrs', 'Warsow')");

$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "lock`");
    $transaction->addQuery("CREATE TABLE `" . PREFIX . "lock` (
  `time` INT NOT NULL ,
  `reason` TEXT NOT NULL
 ) DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");





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
    ) AUTO_INCREMENT=1
     DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");



    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('about.html','index.php?site=about','a:0:{}','index\\\\.php\\\\?site=about','about.html','about\\\\.html','index.php?site=about')");
    
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('challenge.html','index.php?site=challenge','a:0:{}','index\\\\.php\\\\?site=challenge','challenge.html','challenge\\\\.html','index.php?site=challenge')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('challenge/{type}.html','index.php?site=challenge&type={type}','a:1:{s:4:\"type\";s:6:\"string\";}','index\\\\.php\\\\?site=challenge[&|&amp;]*type=(\\\\w*?)','challenge/$3.html','challenge\\\\/(\\\\w*?)\\\\.html','index.php?site=challenge&type=$1')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('challenge/save.html','index.php?site=challenge&action=save','a:0:{}','index\\\\.php\\\\?site=challenge[&|&amp;]*action=save','challenge/save.html','challenge\\\\/save\\\\.html','index.php?site=challenge&action=save')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('clanwars.html','index.php?site=clanwars','a:0:{}','index\\\\.php\\\\?site=clanwars','clanwars.html','clanwars\\\\.html','index.php?site=clanwars')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('clanwars/{id}.html','index.php?site=clanwars_details&cwID={id}','a:1:{s:2:\"id\";s:7:\"integer\";}','index\\\\.php\\\\?site=clanwars_details[&|&amp;]*cwID=([0-9]+)','clanwars/$3.html','clanwars\\\\/([0-9]+?)\\\\.html','index.php?site=clanwars_details&cwID=$1')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('clanwars/{only}/{id}.html','index.php?site=clanwars&action=showonly&only={only}&id={id}','a:2:{s:2:\"id\";s:7:\"integer\";s:4:\"only\";s:6:\"string\";}','index\\\\.php\\\\?site=clanwars[&|&amp;]*action=showonly[&|&amp;]*only=(\\\\w*?)[&|&amp;]*id=([0-9]+)','clanwars/$3/$4.html','clanwars\\\\/(\\\\w*?)\\\\/([0-9]+?)\\\\.html','index.php?site=clanwars&action=showonly&only=$1&id=$2')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('clanwars/{only}/{id}/{sort}/{type}/{page}.html','index.php?site=clanwars&action=showonly&id={id}&sort={sort}&type={type}&only={only}&page={page}','a:5:{s:4:\"page\";s:7:\"integer\";s:2:\"id\";s:7:\"integer\";s:4:\"sort\";s:6:\"string\";s:4:\"type\";s:6:\"string\";s:4:\"only\";s:6:\"string\";}','index\\\\.php\\\\?site=clanwars[&|&amp;]*action=showonly[&|&amp;]*id=([0-9]+)[&|&amp;]*sort=(\\\\w*?)[&|&amp;]*type=(\\\\w*?)[&|&amp;]*only=(\\\\w*?)[&|&amp;]*page=([0-9]+)','clanwars/$6/$3/$4/$5/$7.html','clanwars\\\\/(\\\\w*?)\\\\/([0-9]+?)\\\\/(\\\\w*?)\\\\/(\\\\w*?)\\\\/([0-9]+?)\\\\.html','index.php?site=clanwars&action=showonly&id=$2&sort=$3&type=$4&only=$1&page=$5')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('clanwars/{only}/{id}/{sort}/{type}/{page}.html','index.php?site=clanwars&action=showonly&id={id}&page={page}&sort={sort}&type={type}&only={only}','a:5:{s:2:\"id\";s:7:\"integer\";s:4:\"page\";s:7:\"integer\";s:4:\"sort\";s:6:\"string\";s:4:\"type\";s:6:\"string\";s:4:\"only\";s:6:\"string\";}','index\\\\.php\\\\?site=clanwars[&|&amp;]*action=showonly[&|&amp;]*id=([0-9]+)[&|&amp;]*page=([0-9]+)[&|&amp;]*sort=(\\\\w*?)[&|&amp;]*type=(\\\\w*?)[&|&amp;]*only=(\\\\w*?)','clanwars/$7/$3/$5/$6/$4.html','clanwars\\\\/(\\\\w*?)\\\\/([0-9]+?)\\\\/(\\\\w*?)\\\\/(\\\\w*?)\\\\/([0-9]+?)\\\\.html','index.php?site=clanwars&action=showonly&id=$2&page=$5&sort=$3&type=$4&only=$1')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('clanwars/{only}/{id}/{sort}/{type}/{page}.html','index.php?site=clanwars&action=showonly&id={id}&only={only}&page={page}&sort={sort}&type={type}','a:5:{s:2:\"id\";s:7:\"integer\";s:4:\"only\";s:6:\"string\";s:4:\"page\";s:7:\"integer\";s:4:\"sort\";s:6:\"string\";s:4:\"type\";s:6:\"string\";}','index\\\\.php\\\\?site=clanwars[&|&amp;]*action=showonly[&|&amp;]*id=([0-9]+)[&|&amp;]*only=(\\\\w*?)[&|&amp;]*page=([0-9]+)[&|&amp;]*sort=(\\\\w*?)[&|&amp;]*type=(\\\\w*?)','clanwars/$4/$3/$6/$7/$5.html','clanwars\\\\/(\\\\w*?)\\\\/([0-9]+?)\\\\/(\\\\w*?)\\\\/(\\\\w*?)\\\\/([0-9]+?)\\\\.html','index.php?site=clanwars&action=showonly&id=$2&only=$1&page=$5&sort=$3&type=$4')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('clanwars/{only}/{id}/{sort}/{type}/1.html','index.php?site=clanwars&action=showonly&id={id}&sort={sort}&type={type}&only={only}','a:4:{s:2:\"id\";s:7:\"integer\";s:4:\"sort\";s:6:\"string\";s:4:\"type\";s:6:\"string\";s:4:\"only\";s:6:\"string\";}','index\\\\.php\\\\?site=clanwars[&|&amp;]*action=showonly[&|&amp;]*id=([0-9]+)[&|&amp;]*sort=(\\\\w*?)[&|&amp;]*type=(\\\\w*?)[&|&amp;]*only=(\\\\w*?)','clanwars/$6/$3/$4/$5/1.html','clanwars\\\\/(\\\\w*?)\\\\/([0-9]+?)\\\\/(\\\\w*?)\\\\/(\\\\w*?)\\\\/1\\\\.html','index.php?site=clanwars&action=showonly&id=$2&sort=$3&type=$4&only=$1')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('clanwars/{only}/{squadID}/{sort}/DESC/1.html','index.php?site=clanwars&action=showonly&id={squadID}&sort={sort}&only={only}','a:3:{s:7:\"squadID\";s:7:\"integer\";s:4:\"only\";s:6:\"string\";s:4:\"sort\";s:6:\"string\";}','index\\\\.php\\\\?site=clanwars[&|&amp;]*action=showonly[&|&amp;]*id=([0-9]+)[&|&amp;]*sort=(\\\\w*?)[&|&amp;]*only=(\\\\w*?)','clanwars/$5/$3/$4/DESC/1.html','clanwars\\\\/(\\\\w*?)\\\\/([0-9]+?)\\\\/(\\\\w*?)\\\\/DESC\\\\/1\\\\.html','index.php?site=clanwars&action=showonly&id=$2&sort=$3&only=$1')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('clanwars/new.html','clanwars.php?action=new','a:0:{}','clanwars\\\\.php\\\\?action=new','clanwars/new.html','clanwars\\\\/new\\\\.html','clanwars.php?action=new')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('clanwars/stats.html','index.php?site=clanwars&action=stats','a:0:{}','index\\\\.php\\\\?site=clanwars[&|&amp;]*action=stats','clanwars/stats.html','clanwars\\\\/stats\\\\.html','index.php?site=clanwars&action=stats')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('contact.html','index.php?site=contact','a:0:{}','index\\\\.php\\\\?site=contact','contact.html','contact\\\\.html','index.php?site=contact')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('counter.html','index.php?site=counter_stats','a:0:{}','index\\\\.php\\\\?site=counter_stats','counter.html','counter\\\\.html','index.php?site=counter_stats')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('download/demo/{demoID}','download.php?demoID={demoID}','a:1:{s:6:\"demoID\";s:7:\"integer\";}','download\\\\.php\\\\?demoID=([0-9]+)','download/demo/$3','download\\\\/demo\\\\/([0-9]+?)','download.php?demoID=$1')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('download/file/{fileID}','download.php?fileID={fileID}','a:1:{s:6:\"fileID\";s:7:\"integer\";}','download\\\\.php\\\\?fileID=([0-9]+)','download/file/$3','download\\\\/file\\\\/([0-9]+?)','download.php?fileID=$1')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('faq.html','index.php?site=faq','a:0:{}','index\\\\.php\\\\?site=faq','faq.html','faq\\\\.html','index.php?site=faq')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('faq/{catID}.html','index.php?site=faq&action=faqcat&faqcatID={catID}','a:1:{s:5:\"catID\";s:7:\"integer\";}','index\\\\.php\\\\?site=faq[&|&amp;]*action=faqcat[&|&amp;]*faqcatID=([0-9]+)','faq/$3.html','faq\\\\/([0-9]+?)\\\\.html','index.php?site=faq&action=faqcat&faqcatID=$1')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('faq/{catID}/{faqID}.html','index.php?site=faq&action=faq&faqID={faqID}&faqcatID={catID}','a:2:{s:5:\"faqID\";s:7:\"integer\";s:5:\"catID\";s:7:\"integer\";}','index\\\\.php\\\\?site=faq[&|&amp;]*action=faq[&|&amp;]*faqID=([0-9]+)[&|&amp;]*faqcatID=([0-9]+)','faq/$4/$3.html','faq\\\\/([0-9]+?)\\\\/([0-9]+?)\\\\.html','index.php?site=faq&action=faq&faqID=$2&faqcatID=$1')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('files.html','index.php?site=files','a:0:{}','index\\\\.php\\\\?site=files','files.html','files\\\\.html','index.php?site=files')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('files/category/{catID}','index.php?site=files&cat={catID}','a:1:{s:5:\"catID\";s:7:\"integer\";}','index\\\\.php\\\\?site=files[&|&amp;]*cat=([0-9]+)','files/category/$3','files\\\\/category\\\\/([0-9]+?)','index.php?site=files&cat=$1')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('files/file/{fileID}','index.php?site=files&file={fileID}','a:1:{s:6:\"fileID\";s:7:\"integer\";}','index\\\\.php\\\\?site=files[&|&amp;]*file=([0-9]+)','files/file/$3','files\\\\/file\\\\/([0-9]+?)','index.php?site=files&file=$1')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('files/report/{fileID}','index.php?site=files&action=report&link={fileID}','a:1:{s:6:\"fileID\";s:7:\"integer\";}','index\\\\.php\\\\?site=files[&|&amp;]*action=report[&|&amp;]*link=([0-9]+)','files/report/$3','files\\\\/report\\\\/([0-9]+?)','index.php?site=files&action=report&link=$1')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('forum.html','index.php?site=forum','a:0:{}','index\\\\.php\\\\?site=forum','forum.html','forum\\\\.html','index.php?site=forum')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('forum/{action}/board/{board}.html','index.php?site=forum&board={board}&action={action}','a:2:{s:5:\"board\";s:7:\"integer\";s:6:\"action\";s:6:\"string\";}','index\\\\.php\\\\?site=forum[&|&amp;]*board=([0-9]+)[&|&amp;]*action=(\\\\w*?)','forum/$4/board/$3.html','forum\\\\/(\\\\w*?)\\\\/board\\\\/([0-9]+?)\\\\.html','index.php?site=forum&board=$2&action=$1')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('forum/action.html','forum.php','a:0:{}','forum\\\\.php','forum/action.html','forum\\\\/action\\\\.html','forum.php')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('forum/actions/markall.html','index.php?site=forum&action=markall','a:0:{}','index\\\\.php\\\\?site=forum[&|&amp;]*action=markall','forum/actions/markall.html','forum\\\\/actions\\\\/markall\\\\.html','index.php?site=forum&action=markall')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('forum/board/{board}.html','index.php?site=forum&board={board}','a:1:{s:5:\"board\";s:7:\"integer\";}','index\\\\.php\\\\?site=forum[&|&amp;]*board=([0-9]+)','forum/board/$3.html','forum\\\\/board\\\\/([0-9]+?)\\\\.html','index.php?site=forum&board=$1')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('forum/board/{board}/addtopic.html','index.php?site=forum&addtopic=true&board={board}','a:1:{s:5:\"board\";s:7:\"integer\";}','index\\\\.php\\\\?site=forum[&|&amp;]*addtopic=true[&|&amp;]*board=([0-9]+)','forum/board/$3/addtopic.html','forum\\\\/board\\\\/([0-9]+?)\\\\/addtopic\\\\.html','index.php?site=forum&addtopic=true&board=$1')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('forum/cat/{cat}.html','index.php?site=forum&cat={cat}','a:1:{s:3:\"cat\";s:7:\"integer\";}','index\\\\.php\\\\?site=forum[&|&amp;]*cat=([0-9]+)','forum/cat/$3.html','forum\\\\/cat\\\\/([0-9]+?)\\\\.html','index.php?site=forum&cat=$1')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('history.html','index.php?site=history','a:0:{}','index\\\\.php\\\\?site=history','history.html','history\\\\.html','index.php?site=history')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('imprint.html','index.php?site=imprint','a:0:{}','index\\\\.php\\\\?site=imprint','imprint.html','imprint\\\\.html','index.php?site=imprint')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('joinus.html','index.php?site=joinus','a:0:{}','index\\\\.php\\\\?site=joinus','joinus.html','joinus\\\\.html','index.php?site=joinus')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('joinus/save.html','index.php?site=joinus&action=save','a:0:{}','index\\\\.php\\\\?site=joinus[&|&amp;]*action=save','joinus/save.html','joinus\\\\/save\\\\.html','index.php?site=joinus&action=save')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('links.html','index.php?site=links','a:0:{}','index\\\\.php\\\\?site=links','links.html','links\\\\.html','index.php?site=links')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('links/{linkID}/edit.html','index.php?site=links&action=edit&linkID={linkID}','a:1:{s:6:\"linkID\";s:7:\"integer\";}','index\\\\.php\\\\?site=links[&|&amp;]*action=edit[&|&amp;]*linkID=([0-9]+)','links/$3/edit.html','links\\\\/([0-9]+?)\\\\/edit\\\\.html','index.php?site=links&action=edit&linkID=$1')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('links/category/{catID}.html','index.php?site=links&action=show&linkcatID={catID}','a:1:{s:5:\"catID\";s:7:\"integer\";}','index\\\\.php\\\\?site=links[&|&amp;]*action=show[&|&amp;]*linkcatID=([0-9]+)','links/category/$3.html','links\\\\/category\\\\/([0-9]+?)\\\\.html','index.php?site=links&action=show&linkcatID=$1')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('linkus.html','index.php?site=linkus','a:0:{}','index\\\\.php\\\\?site=linkus','linkus.html','linkus\\\\.html','index.php?site=linkus')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('linkus/{bannerID}/delete.html','linkus.php?delete=true&bannerID={bannerID}','a:1:{s:8:\"bannerID\";s:7:\"integer\";}','linkus\\\\.php\\\\?delete=true[&|&amp;]*bannerID=([0-9]+)','linkus/$3/delete.html','linkus\\\\/([0-9]+?)\\\\/delete\\\\.html','linkus.php?delete=true&bannerID=$1')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('linkus/{bannerID}/edit.html','index.php?site=linkus&action=edit&bannerID={bannerID}','a:1:{s:8:\"bannerID\";s:7:\"integer\";}','index\\\\.php\\\\?site=linkus[&|&amp;]*action=edit[&|&amp;]*bannerID=([0-9]+)','linkus/$3/edit.html','linkus\\\\/([0-9]+?)\\\\/edit\\\\.html','index.php?site=linkus&action=edit&bannerID=$1')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('linkus/new.html','index.php?site=linkus&action=new','a:0:{}','index\\\\.php\\\\?site=linkus[&|&amp;]*action=new','linkus/new.html','linkus\\\\/new\\\\.html','index.php?site=linkus&action=new')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('loginoverview.html','index.php?site=loginoverview','a:0:{}','index\\\\.php\\\\?site=loginoverview','loginoverview.html','loginoverview\\\\.html','index.php?site=loginoverview')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('logout.html','logout.php','a:0:{}','logout\\\\.php','logout.html','logout\\\\.html','logout.php')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('lostpassword.html','index.php?site=lostpassword','a:0:{}','index\\\\.php\\\\?site=lostpassword','lostpassword.html','lostpassword\\\\.html','index.php?site=lostpassword')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('members.html','index.php?site=members','a:0:{}','index\\\\.php\\\\?site=members','members.html','members\\\\.html','index.php?site=members')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('messenger.html','index.php?site=messenger','a:0:{}','index\\\\.php\\\\?site=messenger','messenger.html','messenger\\\\.html','index.php?site=messenger')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('messenger/{messageID}/read.html','index.php?site=messenger&action=show&id={messageID}','a:1:{s:9:\"messageID\";s:7:\"integer\";}','index\\\\.php\\\\?site=messenger[&|&amp;]*action=show[&|&amp;]*id=([0-9]+)','messenger/$3/read.html','messenger\\\\/([0-9]+?)\\\\/read\\\\.html','index.php?site=messenger&action=show&id=$1')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('messenger/{messageID}/reply.html','index.php?site=messenger&action=reply&id={messageID}','a:1:{s:9:\"messageID\";s:7:\"integer\";}','index\\\\.php\\\\?site=messenger[&|&amp;]*action=reply[&|&amp;]*id=([0-9]+)','messenger/$3/reply.html','messenger\\\\/([0-9]+?)\\\\/reply\\\\.html','index.php?site=messenger&action=reply&id=$1')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('messenger/action.html','messenger.php','a:0:{}','messenger\\\\.php','messenger/action.html','messenger\\\\/action\\\\.html','messenger.php')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('messenger/incoming.html','index.php?site=messenger&action=incoming','a:0:{}','index\\\\.php\\\\?site=messenger[&|&amp;]*action=incoming','messenger/incoming.html','messenger\\\\/incoming\\\\.html','index.php?site=messenger&action=incoming')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('messenger/new.html','index.php?site=messenger&action=newmessage','a:0:{}','index\\\\.php\\\\?site=messenger[&|&amp;]*action=newmessage','messenger/new.html','messenger\\\\/new\\\\.html','index.php?site=messenger&action=newmessage')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('messenger/outgoing.html','index.php?site=messenger&action=outgoing','a:0:{}','index\\\\.php\\\\?site=messenger[&|&amp;]*action=outgoing','messenger/outgoing.html','messenger\\\\/outgoing\\\\.html','index.php?site=messenger&action=outgoing')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('news.html','index.php?site=news','a:0:{}','index\\\\.php\\\\?site=news','news.html','news\\\\.html','index.php?site=news')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('news/{lang}/{newsID}.html','index.php?site=news_comments&newsID={newsID}&lang={lang}','a:2:{s:6:\"newsID\";s:7:\"integer\";s:4:\"lang\";s:6:\"string\";}','index\\\\.php\\\\?site=news_comments[&|&amp;]*newsID=([0-9]+)[&|&amp;]*lang=(\\\\w*?)','news/$4/$3.html','news\\\\/(\\\\w*?)\\\\/([0-9]+?)\\\\.html','index.php?site=news_comments&newsID=$2&lang=$1')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('news/{newsID}.html','index.php?site=news_comments&newsID={newsID}','a:1:{s:6:\"newsID\";s:7:\"integer\";}','index\\\\.php\\\\?site=news_comments[&|&amp;]*newsID=([0-9]+)','news/$3.html','news\\\\/([0-9]+?)\\\\.html','index.php?site=news_comments&newsID=$1')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('news/{newsID}/edit.html','news.php?action=edit&newsID={newsID}','a:1:{s:6:\"newsID\";s:7:\"integer\";}','news\\\\.php\\\\?action=edit[&|&amp;]*newsID=([0-9]+)','news/$3/edit.html','news\\\\/([0-9]+?)\\\\/edit\\\\.html','news.php?action=edit&newsID=$1')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('news/{newsID}/unpublish.html','news.php?quickactiontype=unpublish&newsID={newsID}','a:1:{s:6:\"newsID\";s:7:\"integer\";}','news\\\\.php\\\\?quickactiontype=unpublish[&|&amp;]*newsID=([0-9]+)','news/$3/unpublish.html','news\\\\/([0-9]+?)\\\\/unpublish\\\\.html','news.php?quickactiontype=unpublish&newsID=$1')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('news/action.html','news.php','a:0:{}','news\\\\.php','news/action.html','news\\\\/action\\\\.html','news.php')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('news/archive.html','index.php?site=news&action=archive','a:0:{}','index\\\\.php\\\\?site=news[&|&amp;]*action=archive','news/archive.html','news\\\\/archive\\\\.html','index.php?site=news&action=archive')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('news/archive/{sort}/{type}/{page}.html','index.php?site=news&action=archive&page={page}&sort={sort}&type={type}','a:3:{s:4:\"page\";s:7:\"integer\";s:4:\"sort\";s:6:\"string\";s:4:\"type\";s:6:\"string\";}','index\\\\.php\\\\?site=news[&|&amp;]*action=archive[&|&amp;]*page=([0-9]+)[&|&amp;]*sort=(\\\\w*?)[&|&amp;]*type=(\\\\w*?)','news/archive/$4/$5/$3.html','news\\\\/archive\\\\/(\\\\w*?)\\\\/(\\\\w*?)\\\\/([0-9]+?)\\\\.html','index.php?site=news&action=archive&page=$3&sort=$1&type=$2')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('news/archive/{sort}/{type}/1.html','index.php?site=news&action=archive&sort={sort}&type={type}','a:2:{s:4:\"sort\";s:6:\"string\";s:4:\"type\";s:6:\"string\";}','index\\\\.php\\\\?site=news[&|&amp;]*action=archive[&|&amp;]*sort=(\\\\w*?)[&|&amp;]*type=(\\\\w*?)','news/archive/$3/$4/1.html','news\\\\/archive\\\\/(\\\\w*?)\\\\/(\\\\w*?)\\\\/1\\\\.html','index.php?site=news&action=archive&sort=$1&type=$2')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('news/new.html','news.php?action=new','a:0:{}','news\\\\.php\\\\?action=new','news/new.html','news\\\\/new\\\\.html','news.php?action=new')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('news/unpublish.html','news.php?quickactiontype=unpublish','a:0:{}','news\\\\.php\\\\?quickactiontype=unpublish','news/unpublish.html','news\\\\/unpublish\\\\.html','news.php?quickactiontype=unpublish')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('news/unpublished.html','index.php?site=news&action=unpublished','a:0:{}','index\\\\.php\\\\?site=news[&|&amp;]*action=unpublished','news/unpublished.html','news\\\\/unpublished\\\\.html','index.php?site=news&action=unpublished')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('profile/{action}/{id}.html','index.php?site=profile&id={id}&action={action}','a:2:{s:2:\"id\";s:7:\"integer\";s:6:\"action\";s:6:\"string\";}','index\\\\.php\\\\?site=profile[&|&amp;]*id=([0-9]+)[&|&amp;]*action=(\\\\w*?)','profile/$4/$3.html','profile\\\\/(\\\\w*?)\\\\/([0-9]+?)\\\\.html','index.php?site=profile&id=$2&action=$1')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('profile/{action}/{id}.html','index.php?site=profile&action={action}&id={id}','a:2:{s:2:\"id\";s:7:\"integer\";s:6:\"action\";s:6:\"string\";}','index\\\\.php\\\\?site=profile[&|&amp;]*action=(\\\\w*?)[&|&amp;]*id=([0-9]+)','profile/$3/$4.html','profile\\\\/(\\\\w*?)\\\\/([0-9]+?)\\\\.html','index.php?site=profile&action=$1&id=$2')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('profile/{id}.html','index.php?site=profile&id={id}','a:1:{s:2:\"id\";s:7:\"integer\";}','index\\\\.php\\\\?site=profile[&|&amp;]*id=([0-9]+)','profile/$3.html','profile\\\\/([0-9]+?)\\\\.html','index.php?site=profile&id=$1')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('profile/edit.html','index.php?site=myprofile','a:0:{}','index\\\\.php\\\\?site=myprofile','profile/edit.html','profile\\\\/edit\\\\.html','index.php?site=myprofile')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('profile/mail.html','index.php?site=myprofile&action=editmail','a:0:{}','index\\\\.php\\\\?site=myprofile[&|&amp;]*action=editmail','profile/mail.html','profile\\\\/mail\\\\.html','index.php?site=myprofile&action=editmail')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('profile/password.html','index.php?site=myprofile&action=editpwd','a:0:{}','index\\\\.php\\\\?site=myprofile[&|&amp;]*action=editpwd','profile/password.html','profile\\\\/password\\\\.html','index.php?site=myprofile&action=editpwd')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('register.html','index.php?site=register','a:0:{}','index\\\\.php\\\\?site=register','register.html','register\\\\.html','index.php?site=register')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('search.html','index.php?site=search','a:0:{}','index\\\\.php\\\\?site=search','search.html','search\\\\.html','index.php?site=search')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('search/results.html','index.php?site=search&action=search','a:0:{}','index\\\\.php\\\\?site=search[&|&amp;]*action=search','search/results.html','search\\\\/results\\\\.html','index.php?site=search&action=search')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('search/submit.html','search.php','a:0:{}','search\\\\.php','search/submit.html','search\\\\/submit\\\\.html','search.php')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('server.html','index.php?site=server','a:0:{}','index\\\\.php\\\\?site=server','server.html','server\\\\.html','index.php?site=server')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('sponsors.html','index.php?site=sponsors','a:0:{}','index\\\\.php\\\\?site=sponsors','sponsors.html','sponsors\\\\.html','index.php?site=sponsors')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('squads.html','index.php?site=squads','a:0:{}','index\\\\.php\\\\?site=squads','squads.html','squads\\\\.html','index.php?site=squads')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('squads/{squadID}.html','index.php?site=squads&action=show&squadID={squadID}','a:1:{s:7:\"squadID\";s:7:\"integer\";}','index\\\\.php\\\\?site=squads[&|&amp;]*action=show[&|&amp;]*squadID=([0-9]+)','squads/$3.html','squads\\\\/([0-9]+?)\\\\.html','index.php?site=squads&action=show&squadID=$1')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('users.html','index.php?site=registered_users','a:0:{}','index\\\\.php\\\\?site=registered_users','users.html','users\\\\.html','index.php?site=registered_users')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('users/{type}/{sort}/{page}.html','index.php?site=registered_users&page={page}&sort={sort}&type={type}','a:3:{s:4:\"page\";s:7:\"integer\";s:4:\"sort\";s:6:\"string\";s:4:\"type\";s:6:\"string\";}','index\\\\.php\\\\?site=registered_users[&|&amp;]*page=([0-9]+)[&|&amp;]*sort=(\\\\w*?)[&|&amp;]*type=(\\\\w*?)','users/$5/$4/$3.html','users\\\\/(\\\\w*?)\\\\/(\\\\w*?)\\\\/([0-9]+?)\\\\.html','index.php?site=registered_users&page=$3&sort=$2&type=$1')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('users/ASC/{sort}/{page}.html','index.php?site=registered_users&sort={sort}&page={page}','a:2:{s:4:\"sort\";s:6:\"string\";s:4:\"page\";s:7:\"integer\";}','index\\\\.php\\\\?site=registered_users[&|&amp;]*sort=(\\\\w*?)[&|&amp;]*page=([0-9]+)','users/ASC/$3/$4.html','users\\\\/ASC\\\\/(\\\\w*?)\\\\/([0-9]+?)\\\\.html','index.php?site=registered_users&sort=$1&page=$2')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('whoisonline.html','index.php?site=whoisonline','a:0:{}','index\\\\.php\\\\?site=whoisonline','whoisonline.html','whoisonline\\\\.html','index.php?site=whoisonline')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('whoisonline.html#was','index.php?site=whoisonline#was','a:0:{}','index\\\\.php\\\\?site=whoisonline#was','whoisonline.html#was','whoisonline\\\\.html#was','index.php?site=whoisonline#was')");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "modrewrite` (`regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES('whoisonline/{sort}/{type}.html','index.php?site=whoisonline&sort={sort}&type={type}','a:2:{s:4:\"sort\";s:6:\"string\";s:4:\"type\";s:6:\"string\";}','index\\\\.php\\\\?site=whoisonline[&|&amp;]*sort=(\\\\w*?)[&|&amp;]*type=(\\\\w*?)','whoisonline/$3/$4.html','whoisonline\\\\/(\\\\w*?)\\\\/(\\\\w*?)\\\\.html','index.php?site=whoisonline&sort=$1&type=$2')");


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
(5, 'contact', '', 1, 0, 0, 0, 0, 0, 0, 5),
(6, 'lostpassword', '', 1, 0, 0, 0, 0, 0, 0, 6),
(7, 'register', '', 1, 0, 0, 0, 0, 0, 0, 7),
(8, 'startpage', '', 1, 0, 0, 0, 1, 1, 1, 8),
(9, 'static', '', 1, 0, 0, 0, 0, 0, 0, 9)");
    
  
     if ($transaction->successful()) {
        return array('status' => 'success', 'message' => 'Created tables starting with "d"');
    } else {
        return array('status' => 'fail', 'message' => 'Failed to create tables starting with "d"<br/>' . $transaction->getError());
    }
}

function update_base_5($_database)
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
  
  $transaction->addQuery("INSERT INTO `".PREFIX."navigation_website_main` (`mnavID`, `name`, `url`, `default`, `sort`, `isdropdown`) VALUES
(1, '{[de]}HAUPT{[en]}MAIN', '#', 1, 1, 1),
(2, '{[de]}TEAM{[en]}TEAM', '#', 1, 2, 1),
(3, '{[de]}GEMEINSCHAFT{[en]}COMMUNITY', '#', 1, 3, 1),
(4, '{[de]}MEDIEN{[en]}MEDIA', '#', 1, 4, 1),
(5, '{[de]}SONSTIGES{[en]}MISCELLANEOUS', '#', 1, 5, 1);");

    $transaction->addQuery("CREATE TABLE `" . PREFIX . "navigation_website_sub` (
  `snavID` int(11) NOT NULL AUTO_INCREMENT,
  `mnavID` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `modulname` varchar(100) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `sort` int(2) NOT NULL DEFAULT '0',
  `indropdown` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY  (`snavID`)
) AUTO_INCREMENT=1
  DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");
  
  $transaction->addQuery("INSERT INTO `".PREFIX."navigation_website_sub` (`snavID`, `mnavID`, `name`, `url`, `sort`, `indropdown`) VALUES
(1, 5, '{[de]}Kontakt{[en]}Contact', 'index.php?site=contact', 1, 1);");



    if ($transaction->successful()) {
        return array('status' => 'success', 'message' => 'Created tables starting with "e"');
    } else {
        return array('status' => 'fail', 'message' => 'Failed to create tables starting with "e"<br/>' . $transaction->getError());
    }
}

function update_base_6($_database)
{
        $transaction = new Transaction($_database);

$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "plugins`");
  $transaction->addQuery("CREATE TABLE `" . PREFIX . "plugins` (
  `pluginID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `modulname` varchar(100) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL,
  `admin_file` text NOT NULL,
  `activate` int(1) NOT NULL DEFAULT '1',
  `author` varchar(200) NOT NULL DEFAULT '',
  `website` varchar(200) NOT NULL DEFAULT '',
  `index_link` varchar(255) NOT NULL DEFAULT '',
  `sc_link` varchar(255) NOT NULL DEFAULT '',
  `hiddenfiles` varchar(255) NOT NULL,
  `version` varchar(10) NOT NULL DEFAULT '',
  `path` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`pluginID`)
) AUTO_INCREMENT=1
    DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");


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
) AUTO_INCREMENT=8
   DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");

$transaction->addQuery("INSERT INTO `".PREFIX ."plugins_widgets` (`id`, `position`, `description`, `name`, `modulname`, `plugin_folder`, `widget_file`, `sort`) VALUES
(1, 'page_head_widget', 'Page Head', '', '', NULL, NULL, 1),
(2, 'left_side_widget', 'Page Left', '', '', NULL, NULL, 2),
(3, 'right_side_widget', 'Page Right', '', '', NULL, NULL, 3),
(4, 'page_footer_widget', 'Page Footer', '', '', NULL, NULL, 4),
(5, 'center_head_widget', 'Content Head', '', '', NULL, NULL, 5),
(6, 'center_footer_widget', 'Content Foot', '', '', NULL, NULL, 6)"); 


    $transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "settings_static`");
    $transaction->addQuery("CREATE TABLE `" . PREFIX . "settings_static` (
  `staticID` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `accesslevel` int(1) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`staticID`)
) AUTO_INCREMENT=1
  DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");


   if ($transaction->successful()) {
        return array('status' => 'success', 'message' => 'Created tables starting with "f"');
    } else {
        return array('status' => 'fail', 'message' => 'Failed to create tables starting with "f"<br/>' . $transaction->getError());
    }
}

function update_base_7($_database)
{
        $transaction = new Transaction($_database);

    $transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "squads`");
    $transaction->addQuery("CREATE TABLE `" . PREFIX . "squads` (
  `squadID` int(11) NOT NULL AUTO_INCREMENT,
  `gamesquad` int(11) NOT NULL DEFAULT '1',
  `games` text NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `icon` varchar(255) NOT NULL DEFAULT '',
  `icon_small` varchar(255) NOT NULL DEFAULT '',
  `info` text NOT NULL,
  `sort` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`squadID`)
  ) AUTO_INCREMENT=1
  DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");

    $transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "squads_members`");
    $transaction->addQuery("CREATE TABLE `" . PREFIX . "squads_members` (
  `sqmID` int(11) NOT NULL AUTO_INCREMENT,
  `squadID` int(11) NOT NULL DEFAULT '0',
  `userID` int(11) NOT NULL DEFAULT '0',
  `position` varchar(255) NOT NULL DEFAULT '',
  `activity` int(1) NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '0',
  `joinmember` int(1) NOT NULL DEFAULT '0',
  `warmember` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`sqmID`)
) AUTO_INCREMENT=1
  DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");



$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "settings_styles`");
    $transaction->addQuery("CREATE TABLE `" . PREFIX . "settings_styles` (
  `styleID` int(11) NOT NULL AUTO_INCREMENT,
  `nav1` varchar(255) NOT NULL DEFAULT '',
  `nav2` varchar(255) NOT NULL DEFAULT '',
  `nav3` varchar(255) NOT NULL DEFAULT '',
  `nav4` varchar(255) NOT NULL DEFAULT '',
  `nav5` varchar(255) NOT NULL DEFAULT '',
  `nav6` varchar(255) NOT NULL DEFAULT '',
  `nav7` varchar(255) NOT NULL DEFAULT '',
  `nav8` varchar(255) NOT NULL DEFAULT '',
  `body1` varchar(255) NOT NULL DEFAULT '',
  `body2` varchar(255) NOT NULL DEFAULT '',
  `body3` varchar(255) NOT NULL DEFAULT '',
  `body4` varchar(255) NOT NULL DEFAULT '',
  `typo1` varchar(255) NOT NULL DEFAULT '',
  `typo2` varchar(255) NOT NULL DEFAULT '',
  `typo3` varchar(255) NOT NULL DEFAULT '',
  `typo4` varchar(255) NOT NULL DEFAULT '',
  `typo5` varchar(255) NOT NULL DEFAULT '',
  `typo6` varchar(255) NOT NULL DEFAULT '',
  `typo7` varchar(255) NOT NULL DEFAULT '',
  `typo8` varchar(255) NOT NULL DEFAULT '',
  `foot1` varchar(255) NOT NULL DEFAULT '',
  `foot2` varchar(255) NOT NULL DEFAULT '',
  `foot3` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY  (`styleID`)
) AUTO_INCREMENT=2
  DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");

    
    $transaction->addQuery("INSERT IGNORE INTO `" . PREFIX . "settings_styles` (`styleID`, `nav1`, `nav2`, `nav3`, `nav4`, `nav5`, `nav6`, `nav7`, `nav8`, `body1`, `body2`, `body3`, `body4`, `typo1`, `typo2`, `typo3`, `typo4`, `typo5`, `typo6`, `typo7`, `typo8`, `foot1`, `foot2`, `foot3`) VALUES
(1, '#333333', '16px', '#999999', '#fe821d', '#fe821d', '5px', '#999999', '#fe821d', 'Helvetica Neue, Helvetica, Arial, sans-serif', '13px', '#ffffff', '#555555', '#e3e3e3', '#555555', '#555555', '#ef7f1a', '13px', '#ef7f1a', '1px', '#c45901', '#333333', '#999999', '#999999')");


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


 $transaction->addQuery("CREATE TABLE `" . PREFIX . "tags` (
  `rel` varchar(255) NOT NULL,
  `ID` int(11) NOT NULL,
  `tag` varchar(255) NOT NULL
) DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");


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
(1, '{[de]}Willkommen zu Webspell | RM{[en]}Welcome to Webspell | RM{[pl]}Witamy w Webspell | RM', '{[de]}\r\n<p><strong><u>Was ist Webspell RM?</u></strong><br />\r\n<br />\r\nWebspell RM ist ein Clan &amp; Gamer CMS (<em>Content Management System</em>). Es basiert auf PHP, MySQL und der letzten webSPELL.org GitHub Version (4.3.0). Webspell RM l&auml;uft unter der General Public License. Siehe auch <a href=\"http://wiki.webspell-rm.de/index.php?site=static&amp;staticID=4\" target=\"_blank\">Lizenzvereinbarung</a>.</p>\r\n\r\n<p style=\"text-align:center\"><a class=\"btn btn-info\" href=\"http://demo.webspell-rm.de/\" rel=\"noopener\" role=\"button\" target=\"_blank\"><strong><u>WEBSPELL RM DEMO</u></strong></a> <a class=\"btn btn-success\" href=\"https://webspell-rm.de/index.php?site=forum\" rel=\"noopener\" role=\"button\" target=\"_blank\"><strong><u>WEBSPELL RM SUPPORT</u></strong></a></p>\r\n\r\n<p><strong><u>Was bietet Webspell | RM?</u></strong><br />\r\n<br />\r\nWebspell RM basiert auf Bootstrap und ist einfach anzupassen via Dashboard. Theoretisch sind alle Bootstrap Templates verwendbar. Als Editor wir der TinyMCE Editor verwendet. Das CMS ist Multi-Language f&auml;hig und liefert von Haus aus viele Sprachen mit. Das beliebte reCAPTCHA wurde als Spam Schutz integriert. Alle Plugins sind via Webspell RM Installer einfach und problemlos zu installieren.</p>\r\n\r\n<p><strong><u>Beispiel f&uuml;r die Startseite:</u> </strong><em>(dies kannst du bearbeiten unter: <strong>Administration ? Systemverwaltung ? <a href=\"../admin/admincenter.php?site=startpage\" target=\"_blank\">Startseite</a></strong>)</em></p>\r\n\r\n<div class=\"container\">\r\n<div class=\"row\">\r\n<div class=\"col-xs-12\">\r\n<div class=\"nav nav-fill nav-tabs\" id=\"nav-tab\"><a aria-controls=\"nav-home\" aria-selected=\"true\" class=\"nav-item nav-link active\" data-toggle=\"tab\" href=\"#nav-home\" id=\"nav-home-tab\" role=\"tab\">Startseite</a> <a aria-controls=\"nav-profile\" aria-selected=\"false\" class=\"nav-item nav-link\" data-toggle=\"tab\" href=\"#nav-profile\" id=\"nav-profile-tab\" role=\"tab\">Profil</a> <a aria-controls=\"nav-contact\" aria-selected=\"false\" class=\"nav-item nav-link\" data-toggle=\"tab\" href=\"#nav-contact\" id=\"nav-contact-tab\" role=\"tab\">Kontakt</a> <a aria-controls=\"nav-about\" aria-selected=\"false\" class=\"nav-item nav-link\" data-toggle=\"tab\" href=\"#nav-about\" id=\"nav-about-tab\" role=\"tab\">&Uuml;ber</a></div>\r\n\r\n<div class=\"px-3 px-sm-0 py-3 tab-content\" id=\"nav-tabContent\">\r\n<div class=\"active fade show tab-pane\" id=\"nav-home\">Et et consectetur ipsum labore excepteur est proident excepteur ad velit occaecat qui minim occaecat veniam. Fugiat veniam incididunt anim aliqua enim pariatur veniam sunt est aute sit dolor anim. Velit non irure adipisicing aliqua ullamco irure incididunt irure non esse consectetur nostrud minim non minim occaecat. Amet duis do nisi duis veniam non est eiusmod tempor incididunt tempor dolor ipsum in qui sit. Exercitation mollit sit culpa nisi culpa non adipisicing reprehenderit do dolore. Duis reprehenderit occaecat anim ullamco ad duis occaecat ex.</div>\r\n\r\n<div class=\"fade tab-pane\" id=\"nav-profile\">Et et consectetur ipsum labore excepteur est proident excepteur ad velit occaecat qui minim occaecat veniam. Fugiat veniam incididunt anim aliqua enim pariatur veniam sunt est aute sit dolor anim. Velit non irure adipisicing aliqua ullamco irure incididunt irure non esse consectetur nostrud minim non minim occaecat. Amet duis do nisi duis veniam non est eiusmod tempor incididunt tempor dolor ipsum in qui sit. Exercitation mollit sit culpa nisi culpa non adipisicing reprehenderit do dolore. Duis reprehenderit occaecat anim ullamco ad duis occaecat ex.</div>\r\n\r\n<div class=\"fade tab-pane\" id=\"nav-contact\">Et et consectetur ipsum labore excepteur est proident excepteur ad velit occaecat qui minim occaecat veniam. Fugiat veniam incididunt anim aliqua enim pariatur veniam sunt est aute sit dolor anim. Velit non irure adipisicing aliqua ullamco irure incididunt irure non esse consectetur nostrud minim non minim occaecat. Amet duis do nisi duis veniam non est eiusmod tempor incididunt tempor dolor ipsum in qui sit. Exercitation mollit sit culpa nisi culpa non adipisicing reprehenderit do dolore. Duis reprehenderit occaecat anim ullamco ad duis occaecat ex.</div>\r\n\r\n<div class=\"fade tab-pane\" id=\"nav-about\">Et et consectetur ipsum labore excepteur est proident excepteur ad velit occaecat qui minim occaecat veniam. Fugiat veniam incididunt anim aliqua enim pariatur veniam sunt est aute sit dolor anim. Velit non irure adipisicing aliqua ullamco irure incididunt irure non esse consectetur nostrud minim non minim occaecat. Amet duis do nisi duis veniam non est eiusmod tempor incididunt tempor dolor ipsum in qui sit. Exercitation mollit sit culpa nisi culpa non adipisicing reprehenderit do dolore. Duis reprehenderit occaecat anim ullamco ad duis occaecat ex.</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"container\">\r\n<div class=\"mb-3 row\">\r\n<div class=\"col-md-4\">\r\n<div class=\"card-content\">\r\n<div class=\"card-img\"><img alt=\"\" src=\"https://i.imgur.com/rbE6jIV.jpg\" style=\"margin-bottom:10px; margin-top:10px\" />\r\n<h4>Example small Heading</h4>\r\n</div>\r\n\r\n<div class=\"card-desc\">\r\n<h3>Example BIG Heading</h3>\r\n\r\n<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Laboriosam, voluptatum! Dolor quo, perspiciatis voluptas totam</p>\r\n<a class=\"btn-card btn btn-lg btn-primary\" href=\"#\">Read More</a></div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-md-4\">\r\n<div class=\"card-content\">\r\n<div class=\"card-img\"><img alt=\"\" src=\"https://i.imgur.com/Gd6p7ST.jpg\" style=\"margin-bottom:10px; margin-top:10px\" />\r\n<h4>Example small Heading 2</h4>\r\n</div>\r\n\r\n<div class=\"card-desc\">\r\n<h3>Example BIG Heading 2</h3>\r\n\r\n<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Laboriosam, voluptatum! Dolor quo, perspiciatis voluptas totam</p>\r\n<a class=\"btn-card btn btn-lg btn-primary\" href=\"#\">Read More</a></div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-md-4\">\r\n<div class=\"card-content\">\r\n<div class=\"card-img\"><img alt=\"\" src=\"https://i.imgur.com/CBCmxAM.jpg\" style=\"margin-bottom:10px; margin-top:10px\" />\r\n<h4>Example small Heading 3</h4>\r\n</div>\r\n\r\n<div class=\"card-desc\">\r\n<h3>Example BIG Heading 3</h3>\r\n\r\n<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Laboriosam, voluptatum! Dolor quo, perspiciatis voluptas totam</p>\r\n<a class=\"btn-card btn btn-lg btn-primary\" href=\"#\">Read More</a></div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n{[en]}\r\n\r\n<p><strong><u>What is Webspell RM?</u></strong><br />\r\n<br />\r\nWebspell RM is a Clan &amp; Gamer CMS (Content Management System). It is based on PHP, MySQL and the latest webSPELL.org GitHub version (4.3.0). Webspell RM runs under the General Public License. See also license agreement <a href=\"http://wiki.webspell-rm.de/index.php?site=static&amp;staticID=4\" target=\"_blank\">license agreement</a>.</p>\r\n\r\n<p style=\"text-align:center\"><a class=\"btn btn-info\" href=\"http://demo.webspell-rm.de/\" rel=\"noopener\" role=\"button\" target=\"_blank\"><strong><u>WEBSPELL RM DEMO</u></strong></a> <a class=\"btn btn-success\" href=\"https://webspell-rm.de/index.php?site=forum\" rel=\"noopener\" role=\"button\" target=\"_blank\"><strong><u>WEBSPELL RM SUPPORT</u></strong></a></p>\r\n\r\n<p><strong><u>What does Webspell | RM offer?</u></strong><br />\r\n<br />\r\nWebspell RM is based on bootstrap and it is easy to customize via dashboard. Theoretically, all bootstrap templates can be used. As editor we use the TinyMCE editor. The CMS is multi-language capable and comes with many native languages. The popular reCAPTCHA was integrated as spam protection. All plugins are easy to install via Webspell RM Installer.</p>\r\n\r\n<p><strong><u>Example for the homepage:</u><em> </em></strong><em>(this can be edit under: <strong>Admin ? Settings ? <a href=\"../admin/admincenter.php?site=startpage\" target=\"_blank\">Start Page</a></strong>)</em></p>\r\n\r\n<div class=\"container\">\r\n<div class=\"row\">\r\n<div class=\"col-xs-12\">\r\n<div class=\"nav nav-fill nav-tabs\" id=\"nav-tab\"><a aria-controls=\"nav-home\" aria-selected=\"true\" class=\"nav-item nav-link active\" data-toggle=\"tab\" href=\"#nav-home\" id=\"nav-home-tab\" role=\"tab\">Homepage</a> <a aria-controls=\"nav-profile\" aria-selected=\"false\" class=\"nav-item nav-link\" data-toggle=\"tab\" href=\"#nav-profile\" id=\"nav-profile-tab\" role=\"tab\">Profile</a> <a aria-controls=\"nav-contact\" aria-selected=\"false\" class=\"nav-item nav-link\" data-toggle=\"tab\" href=\"#nav-contact\" id=\"nav-contact-tab\" role=\"tab\">Contact</a> <a aria-controls=\"nav-about\" aria-selected=\"false\" class=\"nav-item nav-link\" data-toggle=\"tab\" href=\"#nav-about\" id=\"nav-about-tab\" role=\"tab\">About</a></div>\r\n\r\n<div class=\"px-3 px-sm-0 py-3 tab-content\" id=\"nav-tabContent\">\r\n<div class=\"active fade show tab-pane\" id=\"nav-home\">Et et consectetur ipsum labore excepteur est proident excepteur ad velit occaecat qui minim occaecat veniam. Fugiat veniam incididunt anim aliqua enim pariatur veniam sunt est aute sit dolor anim. Velit non irure adipisicing aliqua ullamco irure incididunt irure non esse consectetur nostrud minim non minim occaecat. Amet duis do nisi duis veniam non est eiusmod tempor incididunt tempor dolor ipsum in qui sit. Exercitation mollit sit culpa nisi culpa non adipisicing reprehenderit do dolore. Duis reprehenderit occaecat anim ullamco ad duis occaecat ex.</div>\r\n\r\n<div class=\"fade tab-pane\" id=\"nav-profile\">Et et consectetur ipsum labore excepteur est proident excepteur ad velit occaecat qui minim occaecat veniam. Fugiat veniam incididunt anim aliqua enim pariatur veniam sunt est aute sit dolor anim. Velit non irure adipisicing aliqua ullamco irure incididunt irure non esse consectetur nostrud minim non minim occaecat. Amet duis do nisi duis veniam non est eiusmod tempor incididunt tempor dolor ipsum in qui sit. Exercitation mollit sit culpa nisi culpa non adipisicing reprehenderit do dolore. Duis reprehenderit occaecat anim ullamco ad duis occaecat ex.</div>\r\n\r\n<div class=\"fade tab-pane\" id=\"nav-contact\">Et et consectetur ipsum labore excepteur est proident excepteur ad velit occaecat qui minim occaecat veniam. Fugiat veniam incididunt anim aliqua enim pariatur veniam sunt est aute sit dolor anim. Velit non irure adipisicing aliqua ullamco irure incididunt irure non esse consectetur nostrud minim non minim occaecat. Amet duis do nisi duis veniam non est eiusmod tempor incididunt tempor dolor ipsum in qui sit. Exercitation mollit sit culpa nisi culpa non adipisicing reprehenderit do dolore. Duis reprehenderit occaecat anim ullamco ad duis occaecat ex.</div>\r\n\r\n<div class=\"fade tab-pane\" id=\"nav-about\">Et et consectetur ipsum labore excepteur est proident excepteur ad velit occaecat qui minim occaecat veniam. Fugiat veniam incididunt anim aliqua enim pariatur veniam sunt est aute sit dolor anim. Velit non irure adipisicing aliqua ullamco irure incididunt irure non esse consectetur nostrud minim non minim occaecat. Amet duis do nisi duis veniam non est eiusmod tempor incididunt tempor dolor ipsum in qui sit. Exercitation mollit sit culpa nisi culpa non adipisicing reprehenderit do dolore. Duis reprehenderit occaecat anim ullamco ad duis occaecat ex.</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"container\">\r\n<div class=\"mb-3 row\">\r\n<div class=\"col-md-4\">\r\n<div class=\"card-content\">\r\n<div class=\"card-img\"><img alt=\"\" src=\"https://i.imgur.com/rbE6jIV.jpg\" style=\"margin-bottom:10px; margin-top:10px\" />\r\n<h4>Example small Heading</h4>\r\n</div>\r\n\r\n<div class=\"card-desc\">\r\n<h3>Example BIG Heading</h3>\r\n\r\n<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Laboriosam, voluptatum! Dolor quo, perspiciatis voluptas totam</p>\r\n<a class=\"btn-card btn btn-lg btn-primary\" href=\"#\">Read More</a></div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-md-4\">\r\n<div class=\"card-content\">\r\n<div class=\"card-img\"><img alt=\"\" src=\"https://i.imgur.com/Gd6p7ST.jpg\" style=\"margin-bottom:10px; margin-top:10px\" />\r\n<h4>Example small Heading 2</h4>\r\n</div>\r\n\r\n<div class=\"card-desc\">\r\n<h3>Example BIG Heading 2</h3>\r\n\r\n<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Laboriosam, voluptatum! Dolor quo, perspiciatis voluptas totam</p>\r\n<a class=\"btn-card btn btn-lg btn-primary\" href=\"#\">Read More</a></div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-md-4\">\r\n<div class=\"card-content\">\r\n<div class=\"card-img\"><img alt=\"\" src=\"https://i.imgur.com/CBCmxAM.jpg\" style=\"margin-bottom:10px; margin-top:10px\" />\r\n<h4>Example small Heading 3</h4>\r\n</div>\r\n\r\n<div class=\"card-desc\">\r\n<h3>Example BIG Heading 3</h3>\r\n\r\n<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Laboriosam, voluptatum! Dolor quo, perspiciatis voluptas totam</p>\r\n<a class=\"btn-card btn btn-lg btn-primary\" href=\"#\">Read More</a></div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n{[pl]}', 1565033094)");





$transaction->addQuery("CREATE TABLE `" . PREFIX . "settings_logo` (
  `logoID` int(11) NOT NULL,
  `logo` varchar(255) NOT NULL
) DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");

$transaction->addQuery("INSERT IGNORE INTO `" . PREFIX . "settings_logo` (`logoID`, `logo`) VALUES
(1, '1.png')");




    if ($transaction->successful()) {
        return array('status' => 'success', 'message' => 'Created tables starting with "g"');
    } else {
        return array('status' => 'fail', 'message' => 'Failed to create tables starting with "g"<br/>' . $transaction->getError());
    }
}

function update_base_8($_database)
{
        $transaction = new Transaction($_database);

        global $adminname;
        global $adminpassword;
        global $adminmail;
        global $url;
    
    $new_pepper = Gen_PasswordPepper();
    $adminhash = password_hash($adminpassword.$new_pepper,PASSWORD_BCRYPT,array('cost'=>12));

$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "user`");
    $transaction->addQuery("CREATE TABLE `" . PREFIX . "user` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `registerdate` int(14) NOT NULL DEFAULT '0',
  `lastlogin` int(14) NOT NULL DEFAULT '0',
  `password` varchar(255) NOT NULL DEFAULT '',
  `password_hash` varchar(255) NOT NULL,
  `password_pepper` varchar(255) NOT NULL,
  `nickname` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `email_hide` int(1) NOT NULL DEFAULT '1',
  `email_change` varchar(255) NOT NULL,
  `email_activate` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL DEFAULT '',
  `lastname` varchar(255) NOT NULL DEFAULT '',
  `sex` char(1) NOT NULL DEFAULT 'u',
  `town` varchar(255) NOT NULL DEFAULT '',
  `birthday` datetime NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `twitter` varchar(255) NOT NULL,
  `twitch` varchar(255) NOT NULL,
  `steam` varchar(255) NOT NULL,
  `instagram` varchar(255) NOT NULL,
  `youtube` varchar(255) NOT NULL,
  `icq` varchar(255) NOT NULL DEFAULT '',
  `avatar` varchar(255) NOT NULL DEFAULT '',
  `usertext` varchar(255) NOT NULL DEFAULT '',
  `userpic` varchar(255) NOT NULL DEFAULT '',
  `homepage` varchar(255) NOT NULL,
  `about` text NOT NULL,
  `pmgot` int(11) NOT NULL DEFAULT '0',
  `pmsent` int(11) NOT NULL DEFAULT '0',
  `visits` int(11) NOT NULL DEFAULT '0',
  `banned` varchar(255) DEFAULT NULL,
  `ban_reason` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL DEFAULT '',
  `topics` text NOT NULL,
  `articles` text NOT NULL,
  `demos` text NOT NULL,
  `files` text NOT NULL,
  `gallery_pictures` text NOT NULL,
  `special_rank` int(11) DEFAULT '0',
  `mailonpm` int(1) NOT NULL DEFAULT '0',
  `userdescription` text NOT NULL,
  `activated` varchar(255) NOT NULL DEFAULT '1',
  `language` varchar(2) NOT NULL,
  `date_format` varchar(255) NOT NULL DEFAULT 'd.m.Y',
  `time_format` varchar(255) NOT NULL DEFAULT 'H:i',
  PRIMARY KEY (`userID`)
) AUTO_INCREMENT=1
  DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");


  
  
    $transaction->addQuery("INSERT IGNORE INTO `" . PREFIX . "user` (`userID`, `registerdate`, `lastlogin`, `password`, `password_hash`, `password_pepper`, `nickname`, `email`, `email_hide`, `email_change`, `email_activate`, `firstname`, `lastname`, `sex`, `town`, `birthday`, `facebook`, `twitter`, `twitch`, `steam`, `instagram`, `youtube`, `icq`, `avatar`, `usertext`, `userpic`, `homepage`, `about`, `pmgot`, `pmsent`, `visits`, `banned`, `ban_reason`, `ip`, `topics`, `articles`, `demos`, `files`, `gallery_pictures`, `special_rank`, `mailonpm`, `userdescription`, `activated`, `language`, `date_format`, `time_format`) VALUES (1, '" . time() . "', '" . time() . "', '', '" . $adminhash . "', '".$new_pepper."', '" . $adminname . "', '" . $adminmail . "', 1, '', '', '', '', 'u', '', 0, '', '', '', '', '', '', '', '', '', '','', '', 0, 0, 0, NULL, '', '', '', '', '', '', '', 0, 0, '', '1', '', 'd.m.Y', 'H:i')");
                                            
   
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
  PRIMARY KEY (`settingID`)
) AUTO_INCREMENT=2
  DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");

    $transaction->addQuery("INSERT IGNORE INTO `" . PREFIX . "settings` (`settingID`, `title`, `hpurl`, `clanname`, `clantag`, `adminname`, `adminemail`, `sball`, `topics`, `posts`, `latesttopics`, `latesttopicchars`, `messages`, `register_per_ip`, `sessionduration`, `closed`, `imprint`, `default_language`, `insertlinks`, `search_min_len`, `max_wrong_pw`, `captcha_math`, `captcha_bgcol`, `captcha_fontcol`, `captcha_type`, `captcha_noise`, `captcha_linenoise`, `bancheck`, `spam_check`, `detect_language`, `spammaxposts`, `spamapiblockerror`, `date_format`, `time_format`, `modRewrite`) VALUES
(1, 'webSpell | RM 2.0', '" . $url . "', 'Clan Name', 'MyClan', '" . $adminname . "', '" . $adminmail . "', 30, 20, 10, 10, 18, 20, 1, 0, 0, 1, 'de', 1, 3, 10, 2, '#FFFFFF', '#000000', 2, 100, 10, 1564938159, 0, 0, 0, 0, 'd.m.Y', 'H:i', 0)");

// add contacts for mail formular
    $getadminmail = mysqli_fetch_array(mysqli_query($_database, "SELECT adminemail FROM `" . PREFIX . "settings`"));
    $adminmail = $getadminmail['adminemail'];

    $transaction->addQuery("CREATE TABLE IF NOT EXISTS `" . PREFIX . "contact` (
      `contactID` int(11) NOT NULL auto_increment,
      `name` varchar(100) NOT NULL,
      `email` varchar(200) NOT NULL,
      `sort` int(11) NOT NULL default '0',
        PRIMARY KEY ( `contactID` )
      ) AUTO_INCREMENT=2
       DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");

    $transaction->addQuery("INSERT INTO `" . PREFIX . "contact` (`contactID`, `name`, `email`, `sort`) VALUES
    (1, 'Administrator', '" . $adminmail . "', 1);");


 if ($transaction->successful()) {
        return array('status' => 'success', 'message' => 'Created tables starting with "h"');
    } else {
        return array('status' => 'fail', 'message' => 'Failed to create tables starting with "h"<br/>' . $transaction->getError());
    }
}

function update_base_9($_database)
{
        $transaction = new Transaction($_database);

$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "user_forum_groups`");
    $transaction->addQuery("CREATE TABLE `" . PREFIX . "user_forum_groups` (
  `usfgID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL DEFAULT '0',
  `1` int(1) NOT NULL,
  PRIMARY KEY (`usfgID`)
  ) AUTO_INCREMENT=1
  DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");

  $transaction->addQuery("INSERT INTO `" . PREFIX . "user_forum_groups` (`usfgID`, `userID`, `1`) VALUES
(1, 1, 1);");

  
   

    $transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "user_groups`");
    $transaction->addQuery("CREATE TABLE `" . PREFIX . "user_groups` (
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
) AUTO_INCREMENT=2
  DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");

    $transaction->addQuery("INSERT INTO " . PREFIX . "user_groups (`usgID`, `userID`, `news`, `news_writer`, `newsletter`, `polls`, `forum`, `moderator`, `clanwars`, `feedback`, `user`, `page`, `files`, `cash`, `gallery`, `super`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1)");

 
    $transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "user_visitors`");
    $transaction->addQuery("CREATE TABLE `" . PREFIX . "user_visitors` (
  `visitID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL DEFAULT '0',
  `visitor` int(11) NOT NULL DEFAULT '0',
  `date` int(14) NOT NULL DEFAULT '0',
  PRIMARY KEY (`visitID`)
) AUTO_INCREMENT=1
  DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");


$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "whoisonline`");
    $transaction->addQuery("CREATE TABLE `" . PREFIX . "whoisonline` (
  `time` int(14) NOT NULL DEFAULT '0',
  `ip` varchar(20) NOT NULL DEFAULT '',
  `userID` int(11) NOT NULL DEFAULT '0',
  `site` varchar(255) NOT NULL DEFAULT ''
) DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");

    $transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "whowasonline`");
    $transaction->addQuery("CREATE TABLE `" . PREFIX . "whowasonline` (
  `time` int(14) NOT NULL DEFAULT '0',
  `ip` varchar(20) NOT NULL DEFAULT '',
  `userID` int(11) NOT NULL DEFAULT '0',
  `site` varchar(255) NOT NULL DEFAULT ''
) DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");







   if ($transaction->successful()) {
        return array('status' => 'success', 'message' => 'Created tables starting with "i"');
    } else {
        return array('status' => 'fail', 'message' => 'Failed to create tables starting with "i"<br/>' . $transaction->getError());
    }
}

function update_base_10($_database)
{
        $transaction = new Transaction($_database);


 
    

   if ($transaction->successful()) {
        return array('status' => 'success', 'message' => 'Created tables starting with "j"');
    } else {
        return array('status' => 'fail', 'message' => 'Failed to create tables starting with "j"<br/>' . $transaction->getError());
    }
}

function update_nor_rm2011($_database)
{
    $transaction = new Transaction($_database);


$transaction->addQuery("ALTER TABLE `" . PREFIX . "about` RENAME TO `" . PREFIX ."plugins_about`");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "bannerrotation` RENAME TO `" . PREFIX ."plugins_bannerrotation`");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "carousel` RENAME TO `" . PREFIX ."plugins_carousel`");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "faq` RENAME TO `" . PREFIX ."plugins_faq`");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "faq_categories` RENAME TO `" . PREFIX ."plugins_faq_categories`");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "files` RENAME TO `" . PREFIX ."plugins_files`");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "files_categorys` RENAME TO `" . PREFIX ."plugins_files_categories`");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "history` RENAME TO `" . PREFIX ."plugins_history`");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "imprint` RENAME TO `" . PREFIX ."plugins_imprint`");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "links` RENAME TO `" . PREFIX ."plugins_links`");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "links_categorys` RENAME TO `" . PREFIX ."plugins_links_categorys`");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "linkus` RENAME TO `" . PREFIX ."plugins_linkus`");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "messenger` RENAME TO `" . PREFIX ."plugins_messenger`");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "partners` RENAME TO `" . PREFIX ."plugins_partners`");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "servers` RENAME TO `" . PREFIX ."plugins_servers`");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "shoutbox` RENAME TO `" . PREFIX ."plugins_shoutbox`");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "sponsors` RENAME TO `" . PREFIX ."plugins_sponsors`");

$transaction->addQuery("ALTER TABLE `" . PREFIX . "forum_announcements` RENAME TO `" . PREFIX ."plugins_forum_announcements`");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "forum_boards` RENAME TO `" . PREFIX ."plugins_forum_boards`");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "forum_categories` RENAME TO `" . PREFIX ."plugins_forum_categories`");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "forum_groups` RENAME TO `" . PREFIX ."plugins_forum_groups`");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "forum_moderators` RENAME TO `" . PREFIX ."plugins_forum_moderators`");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "forum_notify` RENAME TO `" . PREFIX ."plugins_forum_notify`");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "forum_posts` RENAME TO `" . PREFIX ."plugins_forum_posts`");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "forum_ranks` RENAME TO `" . PREFIX ."plugins_forum_ranks`");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "forum_topics` RENAME TO `" . PREFIX ."plugins_forum_topics`");

$transaction->addQuery("ALTER TABLE `" . PREFIX . "recaptcha` RENAME TO `" . PREFIX ."settings_recaptcha`");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "news_languages` RENAME TO `" . PREFIX ."settings_languages`");



$transaction->addQuery("ALTER TABLE `" . PREFIX . "countries` RENAME TO `" . PREFIX ."settings_countries`");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "games` RENAME TO `" . PREFIX ."settings_games`");


if ($transaction->successful()) {
        return array('status' => 'success', 'message' => 'Updated from Webspell NOR 1.2.5 to Webspell RM 2.0.1 - 1');
    } else {
        return array('status' => 'fail', 'message' => 'Failed to update to Webspell-RM 2.0.1 - 1<br/>' . $transaction->getError());
    }

}


function update_nor_rm2012($_database)
{

  $transaction = new Transaction($_database);

$transaction->addQuery("ALTER TABLE `" . PREFIX . "settings` ADD title varchar(255) NOT NULL");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "plugins` ADD modulname varchar(100) NOT NULL");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "settings_moduls` ADD modulname varchar(100) NOT NULL");

$transaction->addQuery("ALTER TABLE `" . PREFIX . "dashnavi_categories` RENAME TO `" . PREFIX ."navigation_dashboard_categories`");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "dashnavi_links` RENAME TO `" . PREFIX ."navigation_dashboard_links`");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "navigation_main` RENAME TO `" . PREFIX ."navigation_website_main`");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "navigation_sub` RENAME TO `" . PREFIX ."navigation_website_sub`");

$transaction->addQuery("ALTER TABLE `" . PREFIX . "navigation_website_sub` ADD modulname varchar(100) NOT NULL");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "navigation_website_sub` CHANGE `link` `url` VARCHAR( 255 ) NOT NULL");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "navigation_website_sub` CHANGE `mnav_ID` `mnavID` VARCHAR( 255 ) NOT NULL");

$transaction->addQuery("ALTER TABLE `" . PREFIX . "plugins_links_categorys` ADD description varchar(255) NOT NULL");

$transaction->addQuery("ALTER TABLE `" . PREFIX . "plugins_linkus` ADD sort int(11) NOT NULL");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "plugins_linkus` ADD displayed VARCHAR( 255 ) NOT NULL");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "plugins_linkus` CHANGE `name` `title` VARCHAR( 255 ) NOT NULL");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "plugins_linkus` CHANGE `file` `banner_pic` VARCHAR( 255 ) NOT NULL");

$transaction->addQuery("ALTER TABLE `" . PREFIX . "plugins_history` ADD title varchar(255) NOT NULL");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "plugins_history` CHANGE `history` `text` text NOT NULL");

$transaction->addQuery("ALTER TABLE `" . PREFIX . "plugins_partners` ADD facebook varchar(255) NOT NULL");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "plugins_partners` ADD twitter varchar(255) NOT NULL");
$transaction->addQuery("ALTER TABLE `" . PREFIX . "plugins_partners` ADD info text NOT NULL");

$transaction->addQuery("ALTER TABLE `" . PREFIX . "plugins_imprint` ADD disclaimer_text text NOT NULL");

 
$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "articles`");
$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "articles_contents`");
$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "awards`");
$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "cash_box`");
$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "cash_box_payed`");
$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "challenge`");
$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "clanwars`");
$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "demos`");
$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "gallery`");
$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "gallery_groups`");
$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "gallery_pictures`");
$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "guestbook`");
$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "newsletter`");
$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "news`");
$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "news_content`");
$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "news_rubrics`");
$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "poll`");
$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "poll_votes`");
$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "scrolltext`");
$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "smileys`");
$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "styles`");
$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "upcoming`");
$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "upcoming_announce`");
$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "user_gbook`");


if ($transaction->successful()) {
        return array('status' => 'success', 'message' => 'Updated from Webspell NOR 1.2.5 to Webspell RM 2.0.1 - 2');
    } else {
        return array('status' => 'fail', 'message' => 'Failed to update to Webspell-RM 2.0.1 - 2<br/>' . $transaction->getError());
    }

}

function update_nor_rm2013($_database)
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
    ) AUTO_INCREMENT=71
     DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");



  $transaction->addQuery("INSERT INTO `".PREFIX ."modrewrite` (`ruleID`, `regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES
(1, 'about.html', 'index.php?site=about', 'a:0:{}', 'index\\.php\\?site=about', 'about.html', 'about\\.html', 'index.php?site=about'),
(2, 'clan_rules.html', 'index.php?site=clan_rules', 'a:0:{}', 'index\\.php\\?site=clan_rules', 'clan_rules.html', 'clan_rules\\.html', 'index.php?site=clan_rules'),
(3, 'clanwars.html', 'index.php?site=clanwars', 'a:0:{}', 'index\\.php\\?site=clanwars', 'clanwars.html', 'clanwars\\.html', 'index.php?site=clanwars'),
(4, 'contact.html', 'index.php?site=contact', 'a:0:{}', 'index\\.php\\?site=contact', 'contact.html', 'contact\\.html', 'index.php?site=contact'),
(5, 'counter.html', 'index.php?site=counter_stats', 'a:0:{}', 'index\\.php\\?site=counter_stats', 'counter.html', 'counter\\.html', 'index.php?site=counter_stats'),
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
(43, 'news_comments/{newsID}.html', 'index.php?site=news_comments&newsID={newsID}', 'a:1:{s:6:\"newsID\";s:7:\"integer\";}', 'index\\.php\\?site=news_comments[&|&amp;]*newsID=([0-9]+)', 'news/$3.html', 'news\\/([0-9]+?)\\.html', 'index.php?site=news_comments&newsID=$1'),
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
(84, 'candidature/new.html', 'index.php?site=candidature&action=new', 'a:0:{}', 'index\\.php\\?site=candidature[&|&amp;]*action=new', 'candidature/new.html', 'candidature\\/new\\.html', 'index.php?site=candidature&action=new');");

if ($transaction->successful()) {
        return array('status' => 'success', 'message' => 'Updated from Webspell NOR 1.2.5 to Webspell RM 2.0.1 - 3');
    } else {
        return array('status' => 'fail', 'message' => 'Failed to update to Webspell-RM 2.0.1 - 3<br/>' . $transaction->getError());
    }

}

function update_nor_rm2014($_database)
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
(1, '{[de]}HAUPT{[en]}MAIN', '#', 1, 1, 1),
(2, '{[de]}TEAM{[en]}TEAM', '#', 1, 2, 1),
(3, '{[de]}GEMEINSCHAFT{[en]}COMMUNITY', '#', 1, 3, 1),
(4, '{[de]}MEDIEN{[en]}MEDIA', '#', 1, 4, 1),
(5, '{[de]}SONSTIGES{[en]}MISCELLANEOUS', '#', 1, 5, 1);");



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
        return array('status' => 'success', 'message' => 'Updated from Webspell NOR 1.2.5 to Webspell RM 2.0.1 - 4');
    } else {
        return array('status' => 'fail', 'message' => 'Failed to update to Webspell-RM 2.0.1 - 4<br/>' . $transaction->getError());
    }

}

function update_nor_rm2015($_database)
{
    $transaction = new Transaction($_database);

// username löschen

  $transaction->addQuery("ALTER TABLE `" . PREFIX . "user` DROP `username`");






// dateien löschen

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
  #$transaction->addQuery("ALTER TABLE `" . PREFIX . "settings` DROP `latesttopics`");
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


if ($transaction->successful()) {
        return array('status' => 'success', 'message' => 'Updated from Webspell NOR 1.2.5 to Webspell RM 2.0.1 - 5');
    } else {
        return array('status' => 'fail', 'message' => 'Failed to update to Webspell-RM 2.0.1 - 5<br/>' . $transaction->getError());
    }

}

function update_nor_rm2016($_database)
{
    $transaction = new Transaction($_database);

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
(1, '{[de]}Willkommen zu Webspell | RM{[en]}Welcome to Webspell | RM{[pl]}Witamy w Webspell | RM', '{[de]}\r\n<p><strong><u>Was ist Webspell RM?</u></strong><br />\r\n<br />\r\nWebspell RM ist ein Clan &amp; Gamer CMS (<em>Content Management System</em>). Es basiert auf PHP, MySQL und der letzten webSPELL.org GitHub Version (4.3.0). Webspell RM l&auml;uft unter der General Public License. Siehe auch <a href=\"http://wiki.webspell-rm.de/index.php?site=static&amp;staticID=4\" target=\"_blank\">Lizenzvereinbarung</a>.</p>\r\n\r\n<p style=\"text-align:center\"><a class=\"btn btn-info\" href=\"http://demo.webspell-rm.de/\" rel=\"noopener\" role=\"button\" target=\"_blank\"><strong><u>WEBSPELL RM DEMO</u></strong></a> <a class=\"btn btn-success\" href=\"https://webspell-rm.de/index.php?site=forum\" rel=\"noopener\" role=\"button\" target=\"_blank\"><strong><u>WEBSPELL RM SUPPORT</u></strong></a></p>\r\n\r\n<p><strong><u>Was bietet Webspell | RM?</u></strong><br />\r\n<br />\r\nWebspell RM basiert auf Bootstrap und ist einfach anzupassen via Dashboard. Theoretisch sind alle Bootstrap Templates verwendbar. Als Editor wir der TinyMCE Editor verwendet. Das CMS ist Multi-Language f&auml;hig und liefert von Haus aus viele Sprachen mit. Das beliebte reCAPTCHA wurde als Spam Schutz integriert. Alle Plugins sind via Webspell RM Installer einfach und problemlos zu installieren.</p>\r\n\r\n<p><strong><u>Beispiel f&uuml;r die Startseite:</u> </strong><em>(dies kannst du bearbeiten unter: <strong>Administration ? Systemverwaltung ? <a href=\"../admin/admincenter.php?site=startpage\" target=\"_blank\">Startseite</a></strong>)</em></p>\r\n\r\n<div class=\"container\">\r\n<div class=\"row\">\r\n<div class=\"col-xs-12\">\r\n<div class=\"nav nav-fill nav-tabs\" id=\"nav-tab\"><a aria-controls=\"nav-home\" aria-selected=\"true\" class=\"nav-item nav-link active\" data-toggle=\"tab\" href=\"#nav-home\" id=\"nav-home-tab\" role=\"tab\">Startseite</a> <a aria-controls=\"nav-profile\" aria-selected=\"false\" class=\"nav-item nav-link\" data-toggle=\"tab\" href=\"#nav-profile\" id=\"nav-profile-tab\" role=\"tab\">Profil</a> <a aria-controls=\"nav-contact\" aria-selected=\"false\" class=\"nav-item nav-link\" data-toggle=\"tab\" href=\"#nav-contact\" id=\"nav-contact-tab\" role=\"tab\">Kontakt</a> <a aria-controls=\"nav-about\" aria-selected=\"false\" class=\"nav-item nav-link\" data-toggle=\"tab\" href=\"#nav-about\" id=\"nav-about-tab\" role=\"tab\">&Uuml;ber</a></div>\r\n\r\n<div class=\"px-3 px-sm-0 py-3 tab-content\" id=\"nav-tabContent\">\r\n<div class=\"active fade show tab-pane\" id=\"nav-home\">Et et consectetur ipsum labore excepteur est proident excepteur ad velit occaecat qui minim occaecat veniam. Fugiat veniam incididunt anim aliqua enim pariatur veniam sunt est aute sit dolor anim. Velit non irure adipisicing aliqua ullamco irure incididunt irure non esse consectetur nostrud minim non minim occaecat. Amet duis do nisi duis veniam non est eiusmod tempor incididunt tempor dolor ipsum in qui sit. Exercitation mollit sit culpa nisi culpa non adipisicing reprehenderit do dolore. Duis reprehenderit occaecat anim ullamco ad duis occaecat ex.</div>\r\n\r\n<div class=\"fade tab-pane\" id=\"nav-profile\">Et et consectetur ipsum labore excepteur est proident excepteur ad velit occaecat qui minim occaecat veniam. Fugiat veniam incididunt anim aliqua enim pariatur veniam sunt est aute sit dolor anim. Velit non irure adipisicing aliqua ullamco irure incididunt irure non esse consectetur nostrud minim non minim occaecat. Amet duis do nisi duis veniam non est eiusmod tempor incididunt tempor dolor ipsum in qui sit. Exercitation mollit sit culpa nisi culpa non adipisicing reprehenderit do dolore. Duis reprehenderit occaecat anim ullamco ad duis occaecat ex.</div>\r\n\r\n<div class=\"fade tab-pane\" id=\"nav-contact\">Et et consectetur ipsum labore excepteur est proident excepteur ad velit occaecat qui minim occaecat veniam. Fugiat veniam incididunt anim aliqua enim pariatur veniam sunt est aute sit dolor anim. Velit non irure adipisicing aliqua ullamco irure incididunt irure non esse consectetur nostrud minim non minim occaecat. Amet duis do nisi duis veniam non est eiusmod tempor incididunt tempor dolor ipsum in qui sit. Exercitation mollit sit culpa nisi culpa non adipisicing reprehenderit do dolore. Duis reprehenderit occaecat anim ullamco ad duis occaecat ex.</div>\r\n\r\n<div class=\"fade tab-pane\" id=\"nav-about\">Et et consectetur ipsum labore excepteur est proident excepteur ad velit occaecat qui minim occaecat veniam. Fugiat veniam incididunt anim aliqua enim pariatur veniam sunt est aute sit dolor anim. Velit non irure adipisicing aliqua ullamco irure incididunt irure non esse consectetur nostrud minim non minim occaecat. Amet duis do nisi duis veniam non est eiusmod tempor incididunt tempor dolor ipsum in qui sit. Exercitation mollit sit culpa nisi culpa non adipisicing reprehenderit do dolore. Duis reprehenderit occaecat anim ullamco ad duis occaecat ex.</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"container\">\r\n<div class=\"mb-3 row\">\r\n<div class=\"col-md-4\">\r\n<div class=\"card-content\">\r\n<div class=\"card-img\"><img alt=\"\" src=\"https://i.imgur.com/rbE6jIV.jpg\" style=\"margin-bottom:10px; margin-top:10px\" />\r\n<h4>Example small Heading</h4>\r\n</div>\r\n\r\n<div class=\"card-desc\">\r\n<h3>Example BIG Heading</h3>\r\n\r\n<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Laboriosam, voluptatum! Dolor quo, perspiciatis voluptas totam</p>\r\n<a class=\"btn-card btn btn-lg btn-primary\" href=\"#\">Read More</a></div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-md-4\">\r\n<div class=\"card-content\">\r\n<div class=\"card-img\"><img alt=\"\" src=\"https://i.imgur.com/Gd6p7ST.jpg\" style=\"margin-bottom:10px; margin-top:10px\" />\r\n<h4>Example small Heading 2</h4>\r\n</div>\r\n\r\n<div class=\"card-desc\">\r\n<h3>Example BIG Heading 2</h3>\r\n\r\n<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Laboriosam, voluptatum! Dolor quo, perspiciatis voluptas totam</p>\r\n<a class=\"btn-card btn btn-lg btn-primary\" href=\"#\">Read More</a></div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-md-4\">\r\n<div class=\"card-content\">\r\n<div class=\"card-img\"><img alt=\"\" src=\"https://i.imgur.com/CBCmxAM.jpg\" style=\"margin-bottom:10px; margin-top:10px\" />\r\n<h4>Example small Heading 3</h4>\r\n</div>\r\n\r\n<div class=\"card-desc\">\r\n<h3>Example BIG Heading 3</h3>\r\n\r\n<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Laboriosam, voluptatum! Dolor quo, perspiciatis voluptas totam</p>\r\n<a class=\"btn-card btn btn-lg btn-primary\" href=\"#\">Read More</a></div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n{[en]}\r\n\r\n<p><strong><u>What is Webspell RM?</u></strong><br />\r\n<br />\r\nWebspell RM is a Clan &amp; Gamer CMS (Content Management System). It is based on PHP, MySQL and the latest webSPELL.org GitHub version (4.3.0). Webspell RM runs under the General Public License. See also license agreement <a href=\"http://wiki.webspell-rm.de/index.php?site=static&amp;staticID=4\" target=\"_blank\">license agreement</a>.</p>\r\n\r\n<p style=\"text-align:center\"><a class=\"btn btn-info\" href=\"http://demo.webspell-rm.de/\" rel=\"noopener\" role=\"button\" target=\"_blank\"><strong><u>WEBSPELL RM DEMO</u></strong></a> <a class=\"btn btn-success\" href=\"https://webspell-rm.de/index.php?site=forum\" rel=\"noopener\" role=\"button\" target=\"_blank\"><strong><u>WEBSPELL RM SUPPORT</u></strong></a></p>\r\n\r\n<p><strong><u>What does Webspell | RM offer?</u></strong><br />\r\n<br />\r\nWebspell RM is based on bootstrap and it is easy to customize via dashboard. Theoretically, all bootstrap templates can be used. As editor we use the TinyMCE editor. The CMS is multi-language capable and comes with many native languages. The popular reCAPTCHA was integrated as spam protection. All plugins are easy to install via Webspell RM Installer.</p>\r\n\r\n<p><strong><u>Example for the homepage:</u><em> </em></strong><em>(this can be edit under: <strong>Admin ? Settings ? <a href=\"../admin/admincenter.php?site=startpage\" target=\"_blank\">Start Page</a></strong>)</em></p>\r\n\r\n<div class=\"container\">\r\n<div class=\"row\">\r\n<div class=\"col-xs-12\">\r\n<div class=\"nav nav-fill nav-tabs\" id=\"nav-tab\"><a aria-controls=\"nav-home\" aria-selected=\"true\" class=\"nav-item nav-link active\" data-toggle=\"tab\" href=\"#nav-home\" id=\"nav-home-tab\" role=\"tab\">Homepage</a> <a aria-controls=\"nav-profile\" aria-selected=\"false\" class=\"nav-item nav-link\" data-toggle=\"tab\" href=\"#nav-profile\" id=\"nav-profile-tab\" role=\"tab\">Profile</a> <a aria-controls=\"nav-contact\" aria-selected=\"false\" class=\"nav-item nav-link\" data-toggle=\"tab\" href=\"#nav-contact\" id=\"nav-contact-tab\" role=\"tab\">Contact</a> <a aria-controls=\"nav-about\" aria-selected=\"false\" class=\"nav-item nav-link\" data-toggle=\"tab\" href=\"#nav-about\" id=\"nav-about-tab\" role=\"tab\">About</a></div>\r\n\r\n<div class=\"px-3 px-sm-0 py-3 tab-content\" id=\"nav-tabContent\">\r\n<div class=\"active fade show tab-pane\" id=\"nav-home\">Et et consectetur ipsum labore excepteur est proident excepteur ad velit occaecat qui minim occaecat veniam. Fugiat veniam incididunt anim aliqua enim pariatur veniam sunt est aute sit dolor anim. Velit non irure adipisicing aliqua ullamco irure incididunt irure non esse consectetur nostrud minim non minim occaecat. Amet duis do nisi duis veniam non est eiusmod tempor incididunt tempor dolor ipsum in qui sit. Exercitation mollit sit culpa nisi culpa non adipisicing reprehenderit do dolore. Duis reprehenderit occaecat anim ullamco ad duis occaecat ex.</div>\r\n\r\n<div class=\"fade tab-pane\" id=\"nav-profile\">Et et consectetur ipsum labore excepteur est proident excepteur ad velit occaecat qui minim occaecat veniam. Fugiat veniam incididunt anim aliqua enim pariatur veniam sunt est aute sit dolor anim. Velit non irure adipisicing aliqua ullamco irure incididunt irure non esse consectetur nostrud minim non minim occaecat. Amet duis do nisi duis veniam non est eiusmod tempor incididunt tempor dolor ipsum in qui sit. Exercitation mollit sit culpa nisi culpa non adipisicing reprehenderit do dolore. Duis reprehenderit occaecat anim ullamco ad duis occaecat ex.</div>\r\n\r\n<div class=\"fade tab-pane\" id=\"nav-contact\">Et et consectetur ipsum labore excepteur est proident excepteur ad velit occaecat qui minim occaecat veniam. Fugiat veniam incididunt anim aliqua enim pariatur veniam sunt est aute sit dolor anim. Velit non irure adipisicing aliqua ullamco irure incididunt irure non esse consectetur nostrud minim non minim occaecat. Amet duis do nisi duis veniam non est eiusmod tempor incididunt tempor dolor ipsum in qui sit. Exercitation mollit sit culpa nisi culpa non adipisicing reprehenderit do dolore. Duis reprehenderit occaecat anim ullamco ad duis occaecat ex.</div>\r\n\r\n<div class=\"fade tab-pane\" id=\"nav-about\">Et et consectetur ipsum labore excepteur est proident excepteur ad velit occaecat qui minim occaecat veniam. Fugiat veniam incididunt anim aliqua enim pariatur veniam sunt est aute sit dolor anim. Velit non irure adipisicing aliqua ullamco irure incididunt irure non esse consectetur nostrud minim non minim occaecat. Amet duis do nisi duis veniam non est eiusmod tempor incididunt tempor dolor ipsum in qui sit. Exercitation mollit sit culpa nisi culpa non adipisicing reprehenderit do dolore. Duis reprehenderit occaecat anim ullamco ad duis occaecat ex.</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"container\">\r\n<div class=\"mb-3 row\">\r\n<div class=\"col-md-4\">\r\n<div class=\"card-content\">\r\n<div class=\"card-img\"><img alt=\"\" src=\"https://i.imgur.com/rbE6jIV.jpg\" style=\"margin-bottom:10px; margin-top:10px\" />\r\n<h4>Example small Heading</h4>\r\n</div>\r\n\r\n<div class=\"card-desc\">\r\n<h3>Example BIG Heading</h3>\r\n\r\n<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Laboriosam, voluptatum! Dolor quo, perspiciatis voluptas totam</p>\r\n<a class=\"btn-card btn btn-lg btn-primary\" href=\"#\">Read More</a></div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-md-4\">\r\n<div class=\"card-content\">\r\n<div class=\"card-img\"><img alt=\"\" src=\"https://i.imgur.com/Gd6p7ST.jpg\" style=\"margin-bottom:10px; margin-top:10px\" />\r\n<h4>Example small Heading 2</h4>\r\n</div>\r\n\r\n<div class=\"card-desc\">\r\n<h3>Example BIG Heading 2</h3>\r\n\r\n<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Laboriosam, voluptatum! Dolor quo, perspiciatis voluptas totam</p>\r\n<a class=\"btn-card btn btn-lg btn-primary\" href=\"#\">Read More</a></div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-md-4\">\r\n<div class=\"card-content\">\r\n<div class=\"card-img\"><img alt=\"\" src=\"https://i.imgur.com/CBCmxAM.jpg\" style=\"margin-bottom:10px; margin-top:10px\" />\r\n<h4>Example small Heading 3</h4>\r\n</div>\r\n\r\n<div class=\"card-desc\">\r\n<h3>Example BIG Heading 3</h3>\r\n\r\n<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Laboriosam, voluptatum! Dolor quo, perspiciatis voluptas totam</p>\r\n<a class=\"btn-card btn btn-lg btn-primary\" href=\"#\">Read More</a></div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n{[pl]}', 1565033094)");





$transaction->addQuery("CREATE TABLE `" . PREFIX . "settings_logo` (
  `logoID` int(11) NOT NULL,
  `logo` varchar(255) NOT NULL
) DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");

$transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "plugins`");
  $transaction->addQuery("CREATE TABLE `" . PREFIX . "plugins` (
  `pluginID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `modulname` varchar(100) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL,
  `admin_file` text NOT NULL,
  `activate` int(1) NOT NULL DEFAULT '1',
  `author` varchar(200) NOT NULL DEFAULT '',
  `website` varchar(200) NOT NULL DEFAULT '',
  `index_link` varchar(255) NOT NULL DEFAULT '',
  `sc_link` varchar(255) NOT NULL DEFAULT '',
  `hiddenfiles` varchar(255) NOT NULL,
  `version` varchar(10) NOT NULL DEFAULT '',
  `path` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`pluginID`)
) AUTO_INCREMENT=1
    DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");

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
) AUTO_INCREMENT=8
   DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");

$transaction->addQuery("INSERT INTO `".PREFIX ."plugins_widgets` (`id`, `position`, `description`, `name`, `modulname`, `plugin_folder`, `widget_file`, `sort`) VALUES
(1, 'page_head_widget', 'Page Head', '', '', NULL, NULL, 1),
(2, 'left_side_widget', 'Page Left', '', '', NULL, NULL, 2),
(3, 'right_side_widget', 'Page Right', '', '', NULL, NULL, 3),
(4, 'page_footer_widget', 'Page Footer', '', '', NULL, NULL, 4),
(5, 'center_head_widget', 'Content Head', '', '', NULL, NULL, 5),
(6, 'center_footer_widget', 'Content Foot', '', '', NULL, NULL, 6)"); 

$transaction->addQuery("INSERT IGNORE INTO `" . PREFIX . "settings_logo` (`logoID`, `logo`) VALUES
(1, '1.png')");

if ($transaction->successful()) {
        return array('status' => 'success', 'message' => 'Updated from Webspell NOR 1.2.5 to Webspell RM 2.0.1 - 6');
    } else {
        return array('status' => 'fail', 'message' => 'Failed to update to Webspell-RM 2.0.1 - 6<br/>' . $transaction->getError());
    }

}

function update_nor_rm2017($_database)
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
(1, '{[de]}Hauptteil{[en]}Main Panel', 'fas fa-chart-bar', 'any', 0, 1),
(2, '{[de]}Benutzer Administration{[en]}User Administration', 'fas fa-users', 'user', 0, 2),
(3, '{[de]}Spam{[en]}Spam', 'fas fa-exclamation-triangle', 'user', 0, 3),
(4, '{[de]}Layout{[en]}Layout', 'far fa-image', 'cash', 0, 4),
(5, '{[de]}Systemverwaltung{[en]}System Management', 'fas fa-cogs', 'page', 0, 5),
(6, '{[de]}Plugin Verwaltung{[en]}Plugin Administration', 'fas fa-puzzle-piece', 'page', 0, 6),
(7, '{[de]}Plugins Webseiteninhalt{[en]}Plugins Website Content', '', 'page', 0, 7),
(8, '{[de]}Plugins System / Social Media{[en]}Plugins System / Social Media', '', 'page', 0, 8),
(9, '{[de]}Plugins Webseiten Layout{[en]}Plugins Web Pages Layout', '', 'page', 0, 9)");


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
(1, 1, '{[de]}Server-Info{[en]}Overview', 'overview', 'admincenter.php?site=overview', 'any', 1),
(2, 1, '{[de]}Seiten Statistiken{[en]}Page Statistics', 'page_statistic', 'admincenter.php?site=page_statistic', 'any', 2),
(3, 1, '{[de]}Besucher Statistiken{[en]}Visitor Statistics', 'visitor_statistic', 'admincenter.php?site=visitor_statistic', 'any', 3),
(4, 2, '{[de]}Registrierte Benutzer{[en]}Registered Users', 'users', 'admincenter.php?site=users', 'forum', 1),
(5, 2, '{[de]}Teams{[en]}Squads', 'squads', 'admincenter.php?site=squads', 'user', 2),
(6, 2, '{[de]}Clanmitglieder{[en]}Clanmembers', 'members', 'admincenter.php?site=members', 'user', 3),
(7, 2, '{[de]}Kontakte{[en]}Contacts', 'contact', 'admincenter.php?site=contact', 'user', 4),
(8, 3, '{[de]}Geblockte Inhalte{[en]}Blocked Content', 'spam', 'admincenter.php?site=spam&amp;action=forum_spam', 'user', 1),
(9, 3, '{[de]}Nutzer l&ouml;schen{[en]}Remove User', 'spam', 'admincenter.php?site=spam&amp;action=user', 'user', 2),
(10, 3, '{[de]}Multi-Accounts{[en]}Multi-Accounts', 'spam', 'admincenter.php?site=spam&amp;action=multi', 'user', 3),
(11, 3, '{[de]}gebannte IP`s{[en]}banned IP`s', '', 'admincenter.php?site=banned_ips', 'user', 4),
(12, 4, '{[de]}Einstellungen{[en]}Settings', 'settings', 'admincenter.php?site=settings', 'page', 1),
(13, 4, '{[de]}Button{[en]}Button', 'buttons', 'admincenter.php?site=settings_buttons', 'feedback', 3),
(14, 4, '{[de]}Style{[en]}Style', 'styles', 'admincenter.php?site=settings_styles', 'page', 2),
(15, 4, '{[de]}Module{[en]}Module', 'moduls', 'admincenter.php?site=settings_moduls', 'page', 4),
(19, 4, '{[de]}.css{[en]}.css', 'css', 'admincenter.php?site=settings_css', 'page', 5),
(20, 4, '{[de]}Themes{[en]}Themes', 'templates', 'admincenter.php?site=settings_templates', 'page', 7),
(21, 4, '{[de]}Logo{[en]}Logo', 'logo', 'admincenter.php?site=settings_logo', 'page', 6),
(22, 5, '{[de]}Admincenter Navigation{[en]}Admincenter Navigation', 'dashnavi', 'admincenter.php?site=dashboard_navigation', 'page', 1),
(23, 5, '{[de]}Webseiten Navigation{[en]}Webside Navigation', 'webnavi', 'admincenter.php?site=webside_navigation', 'page', 2),
(24, 5, '{[de]}Startseite{[en]}Start Page', 'startpage', 'admincenter.php?site=settings_startpage', 'page', 3),
(25, 5, '{[de]}Statische Seiten{[en]}Static Pages', 'static', 'admincenter.php?site=settings_static', 'page', 4),
(27, 5, '{[de]}Spiele{[en]}Games', 'games', 'admincenter.php?site=settings_games', 'page', 5),
(28, 5, '{[de]}Mod-Rewrite{[en]}Mod-Rewrite', 'modrewrite', 'admincenter.php?site=modrewrite', 'page', 6),
(29, 5, '{[de]}E-Mail{[en]}E-Mail', 'email', 'admincenter.php?site=email', 'page', 7),
(30, 6, '{[de]}Plugin Manager{[en]}Plugin Manager', 'plugin_manager', 'admincenter.php?site=plugin-manager', 'page', 1),
(31, 6, '{[de]}Plugin Installer{[en]}Plugin Installer', 'plugin_installer', 'admincenter.php?site=plugin-installer', 'page', 2),
(32, 6, '{[de]}Themes Installer{[en]}Themes Installer', 'template_installer', 'admincenter.php?site=template-installer', 'page', 3),
(33, 6, '{[de]}Widget Verwaltung{[en]}Widget Control', 'widgets', 'admincenter.php?site=plugin-widgets', 'page', 4)");


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
        return array('status' => 'success', 'message' => 'Updated from Webspell NOR 1.2.5 to Webspell RM 2.0.1 - 7');
    } else {
        return array('status' => 'fail', 'message' => 'Failed to update to Webspell-RM 2.0.1 - 7<br/>' . $transaction->getError());
    }

}

function update_nor_rm2018($_database)
{
    $transaction = new Transaction($_database);



if ($transaction->successful()) {
        return array('status' => 'success', 'message' => 'Updated from Webspell NOR 1.2.5 to Webspell RM 2.0.1 - 8');
    } else {
        return array('status' => 'fail', 'message' => 'Failed to update to Webspell-RM 2.0.1 - 8<br/>' . $transaction->getError());
    }

}

function update_rm_200_201_1($_database)
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
(1, '{[de]}Hauptteil{[en]}Main Panel', 'fas fa-chart-bar', 'any', 0, 1),
(2, '{[de]}Benutzer Administration{[en]}User Administration', 'fas fa-users', 'user', 0, 2),
(3, '{[de]}Spam{[en]}Spam', 'fas fa-exclamation-triangle', 'user', 0, 3),
(4, '{[de]}Layout{[en]}Layout', 'far fa-image', 'cash', 0, 4),
(5, '{[de]}Systemverwaltung{[en]}System Management', 'fas fa-cogs', 'page', 0, 5),
(6, '{[de]}Plugin Verwaltung{[en]}Plugin Administration', 'fas fa-puzzle-piece', 'page', 0, 6),
(7, '{[de]}Plugins Webseiteninhalt{[en]}Plugins Website Content', '', 'page', 0, 7),
(8, '{[de]}Plugins System / Social Media{[en]}Plugins System / Social Media', '', 'page', 0, 8),
(9, '{[de]}Plugins Webseiten Layout{[en]}Plugins Web Pages Layout', '', 'page', 0, 9)");

if ($transaction->successful()) {
        return array('status' => 'success', 'message' => 'Updated from Webspell-RM 2.0.0 to Webspell RM 2.0.1 - 1');
    } else {
        return array('status' => 'fail', 'message' => 'Failed to update to Webspell-RM 2.0.1 - 1<br/>' . $transaction->getError());
    }

}



function update_rm_200_201_2($_database)
{

  $transaction = new Transaction($_database);

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
(1, 1, '{[de]}Server-Info{[en]}Overview', 'overview', 'admincenter.php?site=overview', 'any', 1),
(2, 1, '{[de]}Seiten Statistiken{[en]}Page Statistics', 'page_statistic', 'admincenter.php?site=page_statistic', 'any', 2),
(3, 1, '{[de]}Besucher Statistiken{[en]}Visitor Statistics', 'visitor_statistic', 'admincenter.php?site=visitor_statistic', 'any', 3),
(4, 2, '{[de]}Registrierte Benutzer{[en]}Registered Users', 'users', 'admincenter.php?site=users', 'forum', 1),
(5, 2, '{[de]}Teams{[en]}Squads', 'squads', 'admincenter.php?site=squads', 'user', 2),
(6, 2, '{[de]}Clanmitglieder{[en]}Clanmembers', 'members', 'admincenter.php?site=members', 'user', 3),
(7, 2, '{[de]}Kontakte{[en]}Contacts', 'contact', 'admincenter.php?site=contact', 'user', 4),
(8, 3, '{[de]}Geblockte Inhalte{[en]}Blocked Content', 'spam', 'admincenter.php?site=spam&amp;action=forum_spam', 'user', 1),
(9, 3, '{[de]}Nutzer l&ouml;schen{[en]}Remove User', 'spam', 'admincenter.php?site=spam&amp;action=user', 'user', 2),
(10, 3, '{[de]}Multi-Accounts{[en]}Multi-Accounts', 'spam', 'admincenter.php?site=spam&amp;action=multi', 'user', 3),
(11, 3, '{[de]}gebannte IP`s{[en]}banned IP`s', '', 'admincenter.php?site=banned_ips', 'user', 4),
(12, 4, '{[de]}Einstellungen{[en]}Settings', 'settings', 'admincenter.php?site=settings', 'page', 1),
(13, 4, '{[de]}Button{[en]}Button', 'buttons', 'admincenter.php?site=settings_buttons', 'feedback', 3),
(14, 4, '{[de]}Style{[en]}Style', 'styles', 'admincenter.php?site=settings_styles', 'page', 2),
(15, 4, '{[de]}Module{[en]}Module', 'moduls', 'admincenter.php?site=settings_moduls', 'page', 4),
(19, 4, '{[de]}.css{[en]}.css', 'css', 'admincenter.php?site=settings_css', 'page', 5),
(20, 4, '{[de]}Themes{[en]}Themes', 'templates', 'admincenter.php?site=settings_templates', 'page', 7),
(21, 4, '{[de]}Logo{[en]}Logo', 'logo', 'admincenter.php?site=settings_logo', 'page', 6),
(22, 5, '{[de]}Admincenter Navigation{[en]}Admincenter Navigation', 'dashnavi', 'admincenter.php?site=dashboard_navigation', 'page', 1),
(23, 5, '{[de]}Webseiten Navigation{[en]}Webside Navigation', 'webnavi', 'admincenter.php?site=webside_navigation', 'page', 2),
(24, 5, '{[de]}Startseite{[en]}Start Page', 'startpage', 'admincenter.php?site=settings_startpage', 'page', 3),
(25, 5, '{[de]}Statische Seiten{[en]}Static Pages', 'static', 'admincenter.php?site=settings_static', 'page', 4),
(27, 5, '{[de]}Spiele{[en]}Games', 'games', 'admincenter.php?site=settings_games', 'page', 5),
(28, 5, '{[de]}Mod-Rewrite{[en]}Mod-Rewrite', 'modrewrite', 'admincenter.php?site=modrewrite', 'page', 6),
(29, 5, '{[de]}E-Mail{[en]}E-Mail', 'email', 'admincenter.php?site=email', 'page', 7),
(30, 6, '{[de]}Plugin Manager{[en]}Plugin Manager', 'plugin_manager', 'admincenter.php?site=plugin-manager', 'page', 1),
(31, 6, '{[de]}Plugin Installer{[en]}Plugin Installer', 'plugin_installer', 'admincenter.php?site=plugin-installer', 'page', 2),
(32, 6, '{[de]}Themes Installer{[en]}Themes Installer', 'template_installer', 'admincenter.php?site=template-installer', 'page', 3),
(33, 6, '{[de]}Widget Verwaltung{[en]}Widget Control', 'widgets', 'admincenter.php?site=plugin-widgets', 'page', 4)");



if ($transaction->successful()) {
        return array('status' => 'success', 'message' => 'Updated from Webspell-RM 2.0.0 to Webspell RM 2.0.1 - 2');
    } else {
        return array('status' => 'fail', 'message' => 'Failed to update to Webspell-RM 2.0.1 - 2<br/>' . $transaction->getError());
    }

}

function update_rm_200_201_3($_database)
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
    ) AUTO_INCREMENT=71
     DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");



  $transaction->addQuery("INSERT INTO `".PREFIX."modrewrite` (`ruleID`, `regex`, `link`, `fields`, `replace_regex`, `replace_result`, `rebuild_regex`, `rebuild_result`) VALUES
(1, 'about.html', 'index.php?site=about', 'a:0:{}', 'index\\.php\\?site=about', 'about.html', 'about\\.html', 'index.php?site=about'),
(2, 'clan_rules.html', 'index.php?site=clan_rules', 'a:0:{}', 'index\\.php\\?site=clan_rules', 'clan_rules.html', 'clan_rules\\.html', 'index.php?site=clan_rules'),
(3, 'clanwars.html', 'index.php?site=clanwars', 'a:0:{}', 'index\\.php\\?site=clanwars', 'clanwars.html', 'clanwars\\.html', 'index.php?site=clanwars'),
(4, 'contact.html', 'index.php?site=contact', 'a:0:{}', 'index\\.php\\?site=contact', 'contact.html', 'contact\\.html', 'index.php?site=contact'),
(5, 'counter.html', 'index.php?site=counter_stats', 'a:0:{}', 'index\\.php\\?site=counter_stats', 'counter.html', 'counter\\.html', 'index.php?site=counter_stats'),
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
(43, 'news_comments/{newsID}.html', 'index.php?site=news_comments&newsID={newsID}', 'a:1:{s:6:\"newsID\";s:7:\"integer\";}', 'index\\.php\\?site=news_comments[&|&amp;]*newsID=([0-9]+)', 'news/$3.html', 'news\\/([0-9]+?)\\.html', 'index.php?site=news_comments&newsID=$1'),
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
(84, 'candidature/new.html', 'index.php?site=candidature&action=new', 'a:0:{}', 'index\\.php\\?site=candidature[&|&amp;]*action=new', 'candidature/new.html', 'candidature\\/new\\.html', 'index.php?site=candidature&action=new');");

if ($transaction->successful()) {
        return array('status' => 'success', 'message' => 'Updated from Webspell-RM 2.0.0 to Webspell RM 2.0.1 - 3');
    } else {
        return array('status' => 'fail', 'message' => 'Failed to update to Webspell-RM 2.0.1 - 3<br/>' . $transaction->getError());
    }

}

function update_rm_200_201_4($_database)
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
  
  $transaction->addQuery("INSERT INTO `".PREFIX."navigation_website_main` (`mnavID`, `name`, `url`, `default`, `sort`, `isdropdown`) VALUES
(1, '{[de]}HAUPT{[en]}MAIN', '#', 1, 1, 1),
(2, '{[de]}TEAM{[en]}TEAM', '#', 1, 2, 1),
(3, '{[de]}GEMEINSCHAFT{[en]}COMMUNITY', '#', 1, 3, 1),
(4, '{[de]}MEDIEN{[en]}MEDIA', '#', 1, 4, 1),
(5, '{[de]}SONSTIGES{[en]}MISCELLANEOUS', '#', 1, 5, 1);");



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
        return array('status' => 'success', 'message' => 'Updated from Webspell-RM 2.0.0 to Webspell RM 2.0.1 - 4');
    } else {
        return array('status' => 'fail', 'message' => 'Failed to update to Webspell-RM 2.0.1 - 4<br/>' . $transaction->getError());
    }

}

function update_rm_200_201_5($_database)
{
    $transaction = new Transaction($_database);

// username löschen

  $transaction->addQuery("ALTER TABLE `" . PREFIX . "user` DROP `username`");






// dateien löschen

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
  #$transaction->addQuery("ALTER TABLE `" . PREFIX . "settings` DROP `latesttopics`");
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


if ($transaction->successful()) {
        return array('status' => 'success', 'message' => 'Updated from Webspell-RM 2.0.0 to Webspell RM 2.0.1 - 5');
    } else {
        return array('status' => 'fail', 'message' => 'Failed to update to Webspell-RM 2.0.1 - 5<br/>' . $transaction->getError());
    }

}

function update_rm_200_201_6($_database)
{
    $transaction = new Transaction($_database);



if ($transaction->successful()) {
        return array('status' => 'success', 'message' => 'Updated from Webspell-RM 2.0.0 to Webspell RM 2.0.1 - 6');
    } else {
        return array('status' => 'fail', 'message' => 'Failed to update to Webspell-RM 2.0.1 - 6<br/>' . $transaction->getError());
    }

}
