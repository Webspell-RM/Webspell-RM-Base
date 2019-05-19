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
  `icon` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `topic` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sticky` int(1) NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `rating` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
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
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `rating` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
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
) AUTO_INCREMENT=2
  DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");

$transaction->addQuery("INSERT IGNORE INTO `" . PREFIX . "settings_buttons` (`buttonID`, `button1`, `button2`, `button3`, `button4`, `button5`, `button6`, `button7`, `button8`, `button9`, `button10`, `button11`, `button12`, `button13`, `button14`, `button15`, `button16`, `button17`, `button18`, `button19`, `button20`, `button21`, `button22`, `button23`, `button24`, `button25`, `button26`, `button27`, `button28`, `button29`, `button30`, `button31`, `button32`, `button33`, `button34`, `button35`, `button36`, `button37`, `button38`, `button39`, `button40`, `button41`, `button42`, `button43`, `button44`, `button45`) VALUES (1, '#007bff', '#0069d9', '#ffffff', '#007bff', '#0062cc', '#6c757d', '#5a6268', '#ffffff', '#6c757d', '#545b62', '#28a745', '#218838', '#ffffff', '#28a745', '#1e7e34', '#dc3545', '#c82333', '#ffffff', '#dc3545', '#bd2130', '#ffc107', '#e0a800', '#212529', '#ffc107', '#d39e00', '#17a2b8', '#138496', '#ffffff', '#17a2b8', '#117a8b', '#f8f9fa', '#e2e6ea', '#212529', '#f8f9fa', '#dae0e5', '#343a40', '#23272b', '#ffffff', '#343a40', '#1d2124', '#007bff', '#0056b3', '', '', '')");


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


 //country-list
 $transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "settings_countries`");
    $transaction->addQuery("CREATE TABLE `" . PREFIX . "settings_countries` (
  `countryID` int(11) NOT NULL AUTO_INCREMENT,
  `country` varchar(255) NOT NULL,
  `short` varchar(3) NOT NULL,
  `fav` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY ( `countryID` )
  ) AUTO_INCREMENT=261
       DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");

    $transaction->addQuery("INSERT INTO `" . PREFIX . "settings_countries` (`countryID`, `country`, `short`, `fav`) VALUES
(1, 'Argentina', 'ar', 0),
(2, 'Australia', 'au', 0),
(3, 'Austria', 'at', 0),
(4, 'Belgium', 'be', 0),
(5, 'Bosnia and Herzegowina', 'ba', 0),
(6, 'Brazil', 'br', 0),
(7, 'Bulgaria', 'bg', 0),
(8, 'Canada', 'ca', 0),
(9, 'Chile', 'cl', 0),
(10, 'China', 'cn', 0),
(11, 'Colombia', 'co', 0),
(12, 'Czech Republic', 'cz', 0),
(13, 'Croatia', 'hr', 0),
(14, 'Cyprus', 'cy', 0),
(15, 'Denmark', 'dk', 0),
(16, 'Estonia', 'ee', 0),
(17, 'Finland', 'fi', 0),
(18, 'Faroe Islands', 'fo', 0),
(19, 'France', 'fr', 0),
(20, 'Germany', 'de', 0),
(21, 'Greece', 'gr', 0),
(22, 'Hungary', 'hu', 0),
(23, 'Iceland', 'is', 0),
(24, 'Ireland', 'ie', 0),
(25, 'Israel', 'il', 0),
(26, 'Italy', 'it', 0),
(27, 'Japan', 'jp', 0),
(28, 'South Korea', 'kr', 0),
(29, 'Latvia', 'lv', 0),
(30, 'Lithuania', 'lt', 0),
(31, 'Luxembourg', 'lu', 0),
(32, 'Malaysia', 'my', 0),
(33, 'Malta', 'mt', 0),
(34, 'Netherlands', 'nl', 0),
(35, 'Mexico', 'mx', 0),
(36, 'Mongolia', 'mn', 0),
(37, 'New Zealand', 'nz', 0),
(38, 'Norway', 'no', 0),
(39, 'Poland', 'pl', 0),
(40, 'Portugal', 'pt', 0),
(41, 'Romania', 'ro', 0),
(42, 'Russia', 'ru', 0),
(43, 'Singapore', 'sg', 0),
(44, 'Slovakia', 'sk', 0),
(45, 'Slovenia', 'si', 0),
(46, 'Taiwan', 'tw', 0),
(47, 'South Africa', 'za', 0),
(48, 'Spain', 'es', 0),
(49, 'Sweden', 'se', 0),
(50, 'Syria', 'sy', 0),
(51, 'Switzerland', 'ch', 0),
(53, 'Tunisia', 'tn', 0),
(54, 'Turkey', 'tr', 0),
(55, 'Ukraine', 'ua', 0),
(56, 'United Kingdom', 'uk', 0),
(57, 'USA', 'us', 0),
(58, 'Venezuela', 've', 0),
(59, 'Yugoslavia', 'rs', 0),
(60, 'European Union', 'eu', 0),
(61, 'Albania', 'al', 0),
(62, 'Algeria', 'dz', 0),
(63, 'American Samoa', 'as', 0),
(64, 'Andorra', 'ad', 0),
(65, 'Angola', 'ao', 0),
(66, 'Anguilla', 'ai', 0),
(67, 'Antarctica', 'aq', 0),
(68, 'Antigua and Barbuda', 'ag', 0),
(69, 'Armenia', 'am', 0),
(70, 'Aruba', 'aw', 0),
(71, 'Azerbaijan', 'az', 0),
(72, 'Belize', 'bz', 0),
(73, 'Bahrain', 'bh', 0),
(74, 'Bangladesh', 'bd', 0),
(75, 'Barbados', 'bb', 0),
(76, 'Belarus', 'by', 0),
(77, 'Benelux', 'bx', 0),
(78, 'Benin', 'bj', 0),
(79, 'Bermuda', 'bm', 0),
(80, 'Bhutan', 'bt', 0),
(81, 'Bolivia', 'bo', 0),
(82, 'Botswana', 'bw', 0),
(85, 'Brunei', 'bn', 0),
(86, 'Burkina Faso', 'bf', 0),
(87, 'Burundi', 'bi', 0),
(88, 'Cambodia', 'kh', 0),
(89, 'Cameroon', 'cm', 0),
(90, 'Cape Verde', 'cv', 0),
(91, 'Cayman Islands', 'ky', 0),
(92, 'Central African Republic', 'cf', 0),
(93, 'Christmas Island', 'cx', 0),
(94, 'Cocos Islands', 'cc', 0),
(95, 'Comoros', 'km', 0),
(96, 'Congo', 'cg', 0),
(97, 'Cook Islands', 'ck', 0),
(98, 'Costa Rica', 'cr', 0),
(99, 'Ivory Coast', 'ci', 0),
(100, 'Cuba', 'cu', 0),
(101, 'Democratic Congo', 'cd', 0),
(102, 'North Korea', 'kp', 0),
(103, 'Djibouti', 'dj', 0),
(104, 'Dominica', 'dm', 0),
(105, 'Dominican Republic', 'do', 0),
(107, 'Ecuador', 'ec', 0),
(108, 'Egypt', 'eg', 0),
(109, 'El Salvador', 'sv', 0),
(110, 'England', 'en', 0),
(111, 'Eritrea', 'er', 0),
(112, 'Ethiopia', 'et', 0),
(113, 'Falkland Islands', 'fk', 0),
(114, 'Fiji', 'fj', 0),
(115, 'French Polynesia', 'pf', 0),
(116, 'French Southern Territories', 'tf', 0),
(117, 'Gabon', 'ga', 0),
(118, 'Gambia', 'gm', 0),
(119, 'Georgia', 'ge', 0),
(120, 'Ghana', 'gh', 0),
(121, 'Gibraltar', 'gi', 0),
(122, 'Greenland', 'gl', 0),
(123, 'Grenada', 'gd', 0),
(125, 'Guam', 'gu', 0),
(126, 'Guatemala', 'gt', 0),
(127, 'Guinea', 'gn', 0),
(128, 'Guinea-Bissau', 'gw', 0),
(129, 'Guyana', 'gy', 0),
(130, 'Haiti', 'ht', 0),
(132, 'Vatican City', 'va', 0),
(133, 'Honduras', 'hn', 0),
(134, 'Hong Kong', 'hk', 0),
(135, 'India', 'in', 0),
(136, 'Indonesia', 'id', 0),
(137, 'Iran', 'ir', 0),
(138, 'Iraq', 'iq', 0),
(139, 'Jamaica', 'jm', 0),
(140, 'Jordan', 'jo', 0),
(141, 'Kazakhstan', 'kz', 0),
(142, 'Kenya', 'ke', 0),
(143, 'Kiribati', 'ki', 0),
(144, 'Kuwait', 'kw', 0),
(145, 'Kyrgyzstan', 'kg', 0),
(146, 'Laos', 'la', 0),
(147, 'Lebanon', 'lb', 0),
(148, 'Lesotho', 'ls', 0),
(149, 'Liberia', 'lr', 0),
(150, 'Libya', 'ly', 0),
(151, 'Liechtenstein', 'li', 0),
(152, 'Macau', 'mo', 0),
(153, 'Macedonia', 'mk', 0),
(154, 'Madagascar', 'mg', 0),
(155, 'Malawi', 'mw', 0),
(156, 'Maldives', 'mv', 0),
(157, 'Mali', 'ml', 0),
(158, 'Marshall Islands', 'mh', 0),
(159, 'Mauritania', 'mr', 0),
(160, 'Mauritius', 'mu', 0),
(161, 'Micronesia', 'fm', 0),
(162, 'Moldova', 'md', 0),
(163, 'Monaco', 'mc', 0),
(164, 'Montserrat', 'ms', 0),
(165, 'Morocco', 'ma', 0),
(166, 'Mozambique', 'mz', 0),
(167, 'Burma', 'mm', 0),
(169, 'Nauru', 'nr', 0),
(170, 'Nepal', 'np', 0),
(171, 'Netherlands Antilles', 'an', 0),
(172, 'New Caledonia', 'nc', 0),
(173, 'Nicaragua', 'ni', 0),
(174, 'Nigeria', 'ng', 0),
(175, 'Niue', 'nu', 0),
(176, 'Norfolk Island', 'nf', 0),
(178, 'Northern Mariana Islands', 'mp', 0),
(179, 'Oman', 'om', 0),
(180, 'Pakistan', 'pk', 0),
(181, 'Palau', 'pw', 0),
(182, 'Palestinian', 'ps', 0),
(183, 'Panama', 'pa', 0),
(184, 'Papua New Guinea', 'pg', 0),
(185, 'Paraguay', 'py', 0),
(186, 'Peru', 'pe', 0),
(187, 'Philippines', 'ph', 0),
(188, 'Pitcairn', 'pn', 0),
(189, 'Puerto Rico', 'pr', 0),
(190, 'Qatar', 'qa', 0),
(191, 'Reunion', 're', 0),
(192, 'Rwanda', 'rw', 0),
(193, 'Saint Helena', 'sh', 0),
(194, 'Saint Kitts and Nevis', 'kn', 0),
(195, 'Saint Lucia', 'lc', 0),
(197, 'Saint Vincent', 'vc', 0),
(198, 'Samoa', 'ws', 0),
(199, 'San Marino', 'sm', 0),
(200, 'Sao Tome and Principe', 'st', 0),
(201, 'Saudi Arabia', 'sa', 0),
(202, 'Seychelles', 'sc', 0),
(203, 'Senegal', 'sn', 0),
(204, 'Sierra Leone', 'sl', 0),
(205, 'Solomon Islands', 'sb', 0),
(206, 'Somalia', 'so', 0),
(207, 'South Georgia and the South Sandwich Islands', 'gs', 0),
(208, 'Sri Lanka', 'lk', 0),
(209, 'Sudan', 'sd', 0),
(210, 'Suriname', 'sr', 0),
(212, 'Swaziland', 'sz', 0),
(213, 'Tajikistan', 'tj', 0),
(214, 'Tanzania', 'tz', 0),
(215, 'Thailand', 'th', 0),
(216, 'Togo', 'tg', 0),
(217, 'Tokelau', 'tk', 0),
(218, 'Tonga', 'to', 0),
(219, 'Trinidad and Tobago', 'tt', 0),
(220, 'Turkmenistan', 'tm', 0),
(221, 'Turks and Caicos Islands', 'tc', 0),
(222, 'Tuvalu', 'tv', 0),
(223, 'Uganda', 'ug', 0),
(224, 'United Arab Emirates', 'ae', 0),
(225, 'Uruguay', 'uy', 0),
(226, 'Uzbekistan', 'uz', 0),
(227, 'Vanuatu', 'vu', 0),
(228, 'Vietnam', 'vn', 0),
(229, 'Virgin Islands (British)', 'vg', 0),
(230, 'Virgin Islands (USA)', 'vi', 0),
(232, 'Wallis and Futuna', 'wf', 0),
(233, 'Western Sahara', 'eh', 0),
(234, 'Yemen', 'ye', 0),
(235, 'Zambia', 'zm', 0),
(236, 'Zimbabwe', 'zw', 0),
(237, 'Afghanistan', 'af', 0),
(238, 'Aland Islands', 'ax', 0),
(239, 'Bahamas', 'bs', 0),
(240, 'Saint Barthelemy', 'bl', 0),
(241, 'Caribbean Netherlands', 'bq', 0),
(242, 'Chad', 'td', 0),
(243, 'Curacao', 'cw', 0),
(244, 'French Guiana', 'gf', 0),
(245, 'Guernsey', 'gg', 0),
(246, 'Equatorial Guinea', 'gq', 0),
(247, 'Canary Islands', 'ic', 0),
(248, 'Isle of Man', 'im', 0),
(249, 'Jersey', 'je', 0),
(250, 'Kosovo', 'xk', 0),
(251, 'Martinique', 'mq', 0),
(252, 'Mayotte', 'yt', 0),
(253, 'Montenegro', 'me', 0),
(254, 'Namibia', 'na', 0),
(255, 'Niger', 'ne', 0),
(256, 'Saint Barthelemy', 'bl', 0),
(257, 'Saint Martin', 'mf', 0),
(258, 'Serbia', 'rs', 0),
(259, 'South Sudan', 'ss', 0),
(260, 'Timor-Leste', 'tl', 0)");

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
  `default` int(1) NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`catID`)
) AUTO_INCREMENT=10
 DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");

$transaction->addQuery("INSERT INTO `" . PREFIX . "navigation_dashboard_categories` ( `catID` , `name`, `default`, `sort` ) VALUES ('1', 'main', '1', '1');");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "navigation_dashboard_categories` ( `catID` , `name`, `default`, `sort` ) VALUES ('2', 'user', '1', '2');");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "navigation_dashboard_categories` ( `catID` , `name`, `default`, `sort` ) VALUES ('3', 'spam', '1', '3');");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "navigation_dashboard_categories` ( `catID` , `name`, `default`, `sort` ) VALUES ('4', 'privacy_policy', '1', '4');");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "navigation_dashboard_categories` ( `catID` , `name`, `default`, `sort` ) VALUES ('5', 'settings', '1', '5');");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "navigation_dashboard_categories` ( `catID` , `name`, `default`, `sort` ) VALUES ('6', 'content', '1', '6');");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "navigation_dashboard_categories` ( `catID` , `name`, `default`, `sort` ) VALUES ('7', 'forum', '1', '7');");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "navigation_dashboard_categories` ( `catID` , `name`, `default`, `sort` ) VALUES ('8', '', '1', '8');");
    $transaction->addQuery("INSERT INTO `" . PREFIX . "navigation_dashboard_categories` ( `catID` , `name`, `default`, `sort` ) VALUES ('9', 'plugins', '1', '9');");



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
) AUTO_INCREMENT=1
 DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");
 


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
  `module` varchar(255) NOT NULL default '',
  `modulname` varchar(100) NOT NULL default '',
  `le_activated` int(11) NOT NULL default '0',
  `re_activated` int(11) NOT NULL default '0',
  `activated` int(11) NOT NULL default '0',
  `deactivated` int(11) NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL default '0',
  PRIMARY KEY  (`modulID`)
) AUTO_INCREMENT=10
   DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");


  $transaction->addQuery("INSERT IGNORE INTO `" . PREFIX . "settings_moduls` (`modulID`, `module`, `modulname`, `le_activated`, `re_activated`, `activated`, `deactivated`, `sort`) VALUES (1, '','', 0, 0, 0, 1, 1)");
  $transaction->addQuery("INSERT IGNORE INTO `" . PREFIX . "settings_moduls` (`modulID`, `module`, `modulname`, `le_activated`, `re_activated`, `activated`, `deactivated`, `sort`) VALUES (2, 'myprofile','', 0, 0, 0, 1, 2)");
  $transaction->addQuery("INSERT IGNORE INTO `" . PREFIX . "settings_moduls` (`modulID`, `module`, `modulname`, `le_activated`, `re_activated`, `activated`, `deactivated`, `sort`) VALUES (3, 'profile','', 0, 0, 0, 1, 3)");
  $transaction->addQuery("INSERT IGNORE INTO `" . PREFIX . "settings_moduls` (`modulID`, `module`, `modulname`, `le_activated`, `re_activated`, `activated`, `deactivated`, `sort`) VALUES (4, 'login','', 0, 0, 0, 1, 4)");
  $transaction->addQuery("INSERT IGNORE INTO `" . PREFIX . "settings_moduls` (`modulID`, `module`, `modulname`, `le_activated`, `re_activated`, `activated`, `deactivated`, `sort`) VALUES (5, 'contact','', 0, 0, 0, 1, 5)");
  $transaction->addQuery("INSERT IGNORE INTO `" . PREFIX . "settings_moduls` (`modulID`, `module`, `modulname`, `le_activated`, `re_activated`, `activated`, `deactivated`, `sort`) VALUES (6, 'lostpassword','', 0, 0, 0, 1, 6)");
  $transaction->addQuery("INSERT IGNORE INTO `" . PREFIX . "settings_moduls` (`modulID`, `module`, `modulname`, `le_activated`, `re_activated`, `activated`, `deactivated`, `sort`) VALUES (7, 'register','', 0, 0, 0, 1, 7)");
  $transaction->addQuery("INSERT IGNORE INTO `" . PREFIX . "settings_moduls` (`modulID`, `module`, `modulname`, `le_activated`, `re_activated`, `activated`, `deactivated`, `sort`) VALUES (8, 'startpage','', 0, 0, 0, 1, 8)");
  $transaction->addQuery("INSERT IGNORE INTO `" . PREFIX . "settings_moduls` (`modulID`, `module`, `modulname`, `le_activated`, `re_activated`, `activated`, `deactivated`, `sort`) VALUES (9, 'static','', 0, 0, 0, 1, 9)");
    
  
     if ($transaction->successful()) {
        return array('status' => 'success', 'message' => 'Created tables starting with "d"');
    } else {
        return array('status' => 'fail', 'message' => 'Failed to create tables starting with "d"<br/>' . $transaction->getError());
    }
}

function update_base_5($_database)
{
        $transaction = new Transaction($_database);


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
(1, 'main', '#', 1, 1, 1),
(2, 'Team', '#', 1, 2, 1),
(3, 'community', '#', 1, 3, 1),
(4, 'media', '#', 1, 4, 1),
(5, 'miscellaneous', '#', 1, 5, 1);");

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
  `sc_link` varchar(20) NOT NULL DEFAULT '',
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
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) AUTO_INCREMENT=8
   DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");

$transaction->addQuery("INSERT INTO `".PREFIX."plugins_widgets` (`id`, `position`, `description`, `name`, `modulname`, `plugin_folder`, `widget_file`, `sort`, `create_date`) VALUES
(1, 'page_head_widget', 'Diese Box ist oben auf der Seite', '', '', NULL, NULL, 1, '2018-03-18 10:00:00'),
(2, 'left_side_widget', 'Diese Box ist auf der linken Seite', '', '', NULL, NULL, 2, '2018-03-18 11:00:00'),
(3, 'right_side_widget', 'Diese Box ist auf der rechten Seite', '', '', NULL, NULL, 3, '2018-03-18 12:00:00'),
(4, 'page_footer_widget', 'Diese Box ist unten auf der Seite', '', '', NULL, NULL, 4, '2018-03-18 13:02:11'),
(5, 'center_head_widget', 'Diese Box ist oben im Center', '', '', NULL, NULL, 5, '2018-04-12 18:30:04'),
(6, 'center_footer_widget', 'Diese Box ist unten im Center', '', '', NULL, NULL, 6, '2018-04-12 18:36:39')"); 


    $transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "static`");
    $transaction->addQuery("CREATE TABLE `" . PREFIX . "static` (
  `staticID` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `accesslevel` int(1) NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
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
  `active` int(11) DEFAULT NULL,
  `sort` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`themeID`)
) AUTO_INCREMENT=2
  DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");


$transaction->addQuery("INSERT IGNORE INTO `" . PREFIX . "settings_themes` (`themeID`, `name`, `active`, `sort`) VALUES
(1, 'default', 1, 1)");


 $transaction->addQuery("CREATE TABLE `" . PREFIX . "tags` (
  `rel` varchar(255) NOT NULL,
  `ID` int(11) NOT NULL,
  `tag` varchar(255) NOT NULL
) DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");


 
$transaction->addQuery("CREATE TABLE `" . PREFIX . "settings_startpage` (
  `pageID` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `startpage_text` text NOT NULL,
  `date` int(14) NOT NULL,
  PRIMARY KEY (`pageID`)
) AUTO_INCREMENT=2
  DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");

$transaction->addQuery("INSERT INTO " . PREFIX . "settings_startpage (`pageID`, `title`, `startpage_text`, `date`) VALUES
(1, '{[de]}WILLKOMMEN{[en]}WELCOME', '{[de]}
<div class=container>
  <div class=row>
    <div class=col-8>
      <p>Gl&#252;ckwunsch, Webspell RM ist vollst&#228;ndig installiert.
        <br><br>
        <strong>Zu Deiner Sicherheit l&#246;sche den Ordner INSTALL via FTP.</strong>
        <br><br>
            Logge dich nun mit deinen Daten in die Administration ein.</p>
        <br><br>
            <a class=fa href=admin/admincenter.php target=_blank rel=noopener>Administration</a>
    </div>
    <div class=col-4><br /><br />
      <ul>
        <li><a href=https://webspell-rm.de/index.php?site=forum target=_blank rel=noopener>Webspell RM Support Forum</a></li>
        <li><a href=http://wiki.webspell-rm.de/ target=_blank rel=noopener>Webspell RM Dokumentation</a></li>
        <li><a href=http://wiki.webspell-rm.de/index.php?site=static&amp;staticID=8 target=_blank rel=noopener>Webspell RM Changelog</a></li>
        <li><a href=https://webspell-rm.de/index.php?site=forum&amp;board=13 target=_blank rel=noopener>Webspell RM Bugtracker</a></li>
        <li><a href=https://www.gamer-templates.com/cms-templates/webspell-rm-templates.html target=_blank rel=noopener>Webspell RM Templates</a></li>
      </ul>
    </div>
  </div>
</div>
{[en]}
<div class=container>
  <div class=row>
    <div class=col-8>
      <p>Congratulations, Webspell RM is completely installed. 
        <br><br>
        <strong>For your security delete the INSTALL folder via FTP. </strong>
        <br><br>
            Now log into the administration with your data.</p> 
        <br><br>
            <a class=fa href=admin/admincenter.php target=_blank rel=noopener>Administration</a>
        <br>
    </div> <br>
    <div class=col-4><br><br>
      <ul>
        <li><a href=https://webspell-rm.de/index.php?site=forum target=_blank rel=noopener> Webspell RM Support Forum</a></li>
        <li><a href=http://wiki.webspell-rm.de/ target=_blank rel=noopener> Webspell RM Documentation</a></li>
        <li><a href=http://wiki.webspell-rm.de/index.php?site=static&amp;staticID=8 target=_blank rel=noopener> Webspell RM Changelog</a></li>
        <li><a href=https://webspell-rm.de/index.php?site=forum&amp;board=13 target=_blank rel=noopener> Webspell RM Bugtracker </a> </li></li>
        <li><a href=https://www.gamer-templates.com/cms-templates/webspell-rm-templates.html target=_blank rel=noopener> Webspell RM Templates</a></li>
      </ul>
    </div>
  </div>
</div>

', 1552735321)");



$transaction->addQuery("CREATE TABLE `" . PREFIX . "settings_head_moduls` (
  `modulID` int(11) NOT NULL AUTO_INCREMENT,
  `module` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `modulname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `activated` int(11) NOT NULL DEFAULT '0',
  `deactivated` int(11) NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`modulID`)
) AUTO_INCREMENT=10
  DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");

$transaction->addQuery("INSERT IGNORE INTO `" . PREFIX . "settings_head_moduls` (`modulID`, `module`, `modulname`, `activated`, `deactivated`, `sort`) VALUES
(1, 'contact', '', 1, 0, 1),
(2, 'login', '', 1, 0, 2),
(3, 'lostpassword', '', 1, 0, 3),
(4, 'myprofile', '', 1, 0, 4),
(5, 'profile', '', 1, 0, 5),
(6, 'register', '', 1, 0, 6),
(7, '', '', 1, 0, 7),
(8, 'startpage', '', 1, 0, 8),
(9, 'static', '', 1, 0, 9)");

$transaction->addQuery("CREATE TABLE `" . PREFIX . "settings_content_head_moduls` (
  `modulID` int(11) NOT NULL AUTO_INCREMENT,
  `module` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `modulname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `activated` int(11) NOT NULL DEFAULT '0',
  `deactivated` int(11) NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`modulID`)
) AUTO_INCREMENT=9
  DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");

$transaction->addQuery("INSERT IGNORE INTO `" . PREFIX . "settings_content_head_moduls` (`modulID`, `module`, `modulname`, `activated`, `deactivated`, `sort`) VALUES
(1, 'contact', '', 1, 0, 1),
(2, 'login', '', 1, 0, 2),
(3, 'lostpassword', '', 1, 0, 3),
(4, 'myprofile', '', 1, 0, 4),
(5, 'profile', '', 1, 0, 5),
(6, 'register', '', 1, 0, 6),
(7, 'startpage', '', 1, 0, 7),
(8, '', '', 1, 0, 8)");

$transaction->addQuery("CREATE TABLE `" . PREFIX . "settings_content_foot_moduls` (
  `modulID` int(11) NOT NULL AUTO_INCREMENT,
  `module` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `modulname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `activated` int(11) NOT NULL DEFAULT '0',
  `deactivated` int(11) NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`modulID`)
) AUTO_INCREMENT=8
  DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");

$transaction->addQuery("INSERT IGNORE INTO `" . PREFIX . "settings_content_foot_moduls` (`modulID`, `module`, `modulname`, `activated`, `deactivated`, `sort`) VALUES
(1, 'contact', '', 1, 0, 1),
(2, 'login', '', 1, 0, 2),
(3, 'lostpassword', '', 1, 0, 3),
(4, 'myprofile', '', 1, 0, 4),
(5, 'profile', '', 1, 0, 5),
(6, 'register', '', 1, 0, 6),
(7, 'startpage', '', 1, 0, 7)");

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
  `username` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL default '',
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
  `country` varchar(255) NOT NULL DEFAULT '',
  `town` varchar(255) NOT NULL DEFAULT '',
  `birthday` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
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
  `newsletter` int(1) NOT NULL DEFAULT '1',
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


  
  
    $transaction->addQuery("INSERT IGNORE INTO `" . PREFIX . "user` (`userID`, `registerdate`, `lastlogin`, `username`, `password`, `password_hash`, `password_pepper`, `nickname`, `email`, `email_hide`, `email_change`, `email_activate`, `firstname`, `lastname`, `sex`, `country`, `town`, `birthday`, `facebook`, `twitter`, `twitch`, `steam`, `instagram`, `youtube`, `icq`, `avatar`, `usertext`, `userpic`, `newsletter`, `homepage`, `about`, `pmgot`, `pmsent`, `visits`, `banned`, `ban_reason`, `ip`, `topics`, `articles`, `demos`, `files`, `gallery_pictures`, `special_rank`, `mailonpm`, `userdescription`, `activated`, `language`, `date_format`, `time_format`) VALUES (1, '" . time() . "', '" . time() . "', '" . $adminname . "', '', '" . $adminhash . "', '".$new_pepper."', '" . $adminname . "', '" . $adminmail . "', 1, '', '', '', '', 'u', '', '', 0, '', '', '', '', '', '', '', '', '', '', 1, '', '', 0, 0, 0, NULL, '', '', '', '', '', '', '', 0, 0, '', '1', '', 'd.m.Y', 'H:i')");
                                            
   
   $transaction->addQuery("DROP TABLE IF EXISTS `" . PREFIX . "settings`");
    $transaction->addQuery("CREATE TABLE `" . PREFIX . "settings` (
  `settingID` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `hpurl` varchar(255) NOT NULL DEFAULT '',
  `clanname` varchar(255) NOT NULL DEFAULT '',
  `clantag` varchar(255) NOT NULL DEFAULT '',
  `adminname` varchar(255) NOT NULL DEFAULT '',
  `adminemail` varchar(255) NOT NULL DEFAULT '',
  `news` int(11) NOT NULL DEFAULT '0',
  `newsarchiv` int(11) NOT NULL DEFAULT '0',
  `headlines` int(11) NOT NULL DEFAULT '0',
  `headlineschars` int(11) NOT NULL DEFAULT '0',
  `topnewschars` int(11) NOT NULL DEFAULT '0',
  `articles` int(11) NOT NULL DEFAULT '0',
  `latestarticles` int(11) NOT NULL DEFAULT '0',
  `articleschars` int(11) NOT NULL DEFAULT '0',
  `clanwars` int(11) NOT NULL DEFAULT '0',
  `results` int(11) NOT NULL DEFAULT '0',
  `upcoming` int(11) NOT NULL DEFAULT '0',
  `shoutbox` int(11) NOT NULL DEFAULT '0',
  `sball` int(11) NOT NULL DEFAULT '0',
  `sbrefresh` int(11) NOT NULL DEFAULT '0',
  `topics` int(11) NOT NULL DEFAULT '0',
  `posts` int(11) NOT NULL DEFAULT '0',
  `latesttopics` int(11) NOT NULL DEFAULT '0',
  `latesttopicchars` int(11) NOT NULL DEFAULT '0',
  `awards` int(11) NOT NULL DEFAULT '0',
  `demos` int(11) NOT NULL DEFAULT '0',
  `guestbook` int(11) NOT NULL DEFAULT '0',
  `feedback` int(11) NOT NULL DEFAULT '0',
  `messages` int(11) NOT NULL DEFAULT '0',
  `users` int(11) NOT NULL DEFAULT '0',
  `profilelast` int(11) NOT NULL DEFAULT '0',
  `topnewsID` int(11) NOT NULL DEFAULT '0',
  `register_per_ip` int(1) NOT NULL DEFAULT '1',
  `sessionduration` int(3) NOT NULL,
  `closed` int(1) NOT NULL DEFAULT '0',
  `gb_info` int(1) NOT NULL DEFAULT '1',
  `imprint` int(1) NOT NULL DEFAULT '0',
  `picsize_l` int(11) NOT NULL DEFAULT '450',
  `picsize_h` int(11) NOT NULL DEFAULT '500',
  `pictures` int(11) NOT NULL DEFAULT '12',
  `publicadmin` int(1) NOT NULL DEFAULT '1',
  `thumbwidth` int(11) NOT NULL DEFAULT '130',
  `usergalleries` int(1) NOT NULL DEFAULT '1',
  `maxusergalleries` int(11) NOT NULL DEFAULT '1048576',
  `default_language` varchar(2) NOT NULL DEFAULT 'uk',
  `insertlinks` int(1) NOT NULL DEFAULT '1',
  `search_min_len` int(3) NOT NULL DEFAULT '3',
  `max_wrong_pw` int(2) NOT NULL DEFAULT '10',
  `captcha_math` int(1) NOT NULL DEFAULT '2',
  `captcha_bgcol` varchar(7) NOT NULL DEFAULT '#FFFFFF',
  `captcha_fontcol` varchar(7) NOT NULL DEFAULT '#000000',
  `captcha_type` int(1) NOT NULL DEFAULT '2',
  `captcha_noise` int(3) NOT NULL DEFAULT '100',
  `captcha_linenoise` int(2) NOT NULL DEFAULT '10',
  `autoresize` int(1) NOT NULL DEFAULT '1',
  `bancheck` int(13) NOT NULL,
  `spam_check` int(1) NOT NULL DEFAULT '0',
  `detect_language` int(1) NOT NULL DEFAULT '0',
  `spamapikey` varchar(32) NOT NULL DEFAULT '',
  `spamapihost` varchar(255) NOT NULL DEFAULT '',
  `spammaxposts` int(11) NOT NULL DEFAULT '0',
  `spamapiblockerror` int(1) NOT NULL DEFAULT '0',
  `date_format` varchar(255) NOT NULL DEFAULT 'd.m.Y',
  `time_format` varchar(255) NOT NULL DEFAULT 'H:i',
  `user_guestbook` int(1) NOT NULL DEFAULT '1',
  `sc_files` int(1) NOT NULL DEFAULT '1',
  `sc_demos` int(1) NOT NULL DEFAULT '1',
  `modRewrite` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`settingID`)
) AUTO_INCREMENT=2
  DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");

    $transaction->addQuery("INSERT IGNORE INTO `" . PREFIX . "settings` (`settingID`, `title`, `hpurl`, `clanname`, `clantag`, `adminname`, `adminemail`, `news`, `newsarchiv`, `headlines`, `headlineschars`, `topnewschars`, `articles`, `latestarticles`, `articleschars`, `clanwars`, `results`, `upcoming`, `shoutbox`, `sball`, `sbrefresh`, `topics`, `posts`, `latesttopics`, `latesttopicchars`, `awards`, `demos`, `guestbook`, `feedback`, `messages`, `users`, `profilelast`, `topnewsID`, `register_per_ip`, `sessionduration`, `closed`, `gb_info`, `imprint`, `picsize_l`, `picsize_h`, `pictures`, `publicadmin`, `thumbwidth`, `usergalleries`, `maxusergalleries`, `default_language`, `insertlinks`, `search_min_len`, `max_wrong_pw`, `captcha_math`, `captcha_bgcol`, `captcha_fontcol`, `captcha_type`, `captcha_noise`, `captcha_linenoise`, `autoresize`, `bancheck`, `spam_check`, `detect_language`, `spamapikey`, `spamapihost`, `spammaxposts`, `spamapiblockerror`, `date_format`, `time_format`, `user_guestbook`, `sc_files`, `sc_demos`, `modRewrite`) VALUES
(1, 'webSpell | RM 2.0', '" . $url . "', 'Clan Name', 'MyClan', '" . $adminname . "', '" . $adminmail . "', 10, 20, 10, 22, 200, 20, 5, 20, 20, 5, 5, 5, 30, 60, 20, 10, 10, 18, 20, 20, 20, 20, 20, 60, 10, 27, 1, 0, 0, 1, 0, 450, 500, 12, 1, 130, 1, 1048576, 'de', 1, 3, 10, 2, '#FFFFFF', '#000000', 2, 100, 10, 1, 1504365486, 0, 0, '', 'https://api.webspell.org/', 0, 0, 'd.m.Y', 'H:i', 1, 1, 1, 0)");

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
