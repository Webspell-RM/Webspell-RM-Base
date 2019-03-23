<?php
/*
##########################################################################
#                                                                        #
#           Version 4       /                        /   /               #
#          -----------__---/__---__------__----__---/---/-               #
#           | /| /  /___) /   ) (_ `   /   ) /___) /   /                 #
#          _|/_|/__(___ _(___/_(__)___/___/_(___ _/___/___               #
#                       Free Content / Management System                 #
#                                   /                                    #
#                                                                        #
#                                                                        #
#   Copyright 2005-2015 by webspell.org                                  #
#                                                                        #
#   visit webSPELL.org, webspell.info to get webSPELL for free           #
#   - Script runs under the GNU GENERAL PUBLIC LICENSE                   #
#   - It's NOT allowed to remove this copyright-tag                      #
#   -- http://www.fsf.org/licensing/licenses/gpl.html                    #
#                                                                        #
#   Code based on WebSPELL Clanpackage (Michael Gruber - webspell.at),   #
#   Far Development by Development Team - webspell.org                   #
#                                                                        #
#   visit webspell.org                                                   #
#                                                                        #
##########################################################################
*/

// -- SYSTEM ERROR DISPLAY -- //
include('error.php');
ini_set('display_errors',1);

// -- PHP FUNCTION CHECK -- //

if (!function_exists('mb_substr')) {
    system_error('PHP Multibyte String Support is not enabled.', 0);
}

// -- ERROR REPORTING -- //
define('DEBUG', "ON"); // ON = development-mode | OFF = public mode
if (DEBUG === 'ON') {
    error_reporting(E_ALL);
} else {
    error_reporting(0);
}

// -- SET ENCODING FOR MB-FUNCTIONS -- //

mb_internal_encoding("UTF-8");

// -- SET INCLUDE-PATH FOR vendors --//

 $path = __DIR__.DIRECTORY_SEPARATOR.'components';
 set_include_path(get_include_path() . PATH_SEPARATOR .$path);

// -- SET HTTP ENCODING -- //

header('content-type: text/html; charset=utf-8');

// -- INSTALL CHECK -- //

if (DEBUG == "OFF" && file_exists('install/index.php')) {
    system_error(
        'The install-folder exists. Did you run the <a href="install/">Installer</a>?<br>
        If yes, please remove the install-folder.',
        0
    );
}

// -- CONNECTION TO MYSQL -- //
if (!isset($GLOBALS[ '_database' ])) {
    $_database = @new mysqli($host, $user, $pwd, $db);

    if ($_database->connect_error) {
        system_error('Cannot connect to MySQL-Server');
    }

    $_database->query("SET NAMES 'utf8'");
}


// -- GENERAL PROTECTIONS -- //

if (function_exists("globalskiller") === false) {
    function globalskiller()
    {
        // kills all non-system variables
        $global = array(
            'GLOBALS',
            '_POST',
            '_GET',
            '_COOKIE',
            '_FILES',
            '_SERVER',
            '_ENV',
            '_REQUEST',
            '_SESSION',
            '_database'
        );

        foreach ($GLOBALS as $key => $val) {
            if (!in_array($key, $global)) {
                if (is_array($val)) {
                    unset_array($GLOBALS[ $key ]);
                } else {
                    unset($GLOBALS[ $key ]);
                }
            }
        }
    }
}

if (function_exists("unset_array") === false) {
    function unset_array($array)
    {
        foreach ($array as $key) {
            if (is_array($key)) {
                unset_array($key);
            } else {
                unset($key);
            }
        }
    }
}

globalskiller();

if (isset($_GET[ 'site' ])) {
    $site = $_GET[ 'site' ];
} else {
    $site = null;
}
if ($site != "search") {
    $request = strtolower(urldecode($_SERVER[ 'QUERY_STRING' ]));
    $protarray = array(
        "union",
        "select",
        "into",
        "where",
        "update ",
        "from",
        "/*",
        "set ",
        PREFIX . "user ",
        PREFIX . "user(",
        PREFIX . "user`",
        PREFIX . "user_groups",
        "phpinfo",
        "escapeshellarg",
        "exec",
        "fopen",
        "fwrite",
        "escapeshellcmd",
        "passthru",
        "proc_close",
        "proc_get_status",
        "proc_nice",
        "proc_open",
        "proc_terminate",
        "shell_exec",
        "system",
        "telnet",
        "ssh",
        "cmd",
        "mv",
        "chmod",
        "chdir",
        "locate",
        "killall",
        "passwd",
        "kill",
        "script",
        "bash",
        "perl",
        "mysql",
        "~root",
        ".history",
        "~nobody",
        "getenv"
    );
    $check = str_replace($protarray, '*', $request);
    if ($request != $check) {
        system_error("Invalid request detected.");
    }
}

function security_slashes(&$array)
{

    global $_database;

    foreach ($array as $key => $value) {
        if (is_array($array[ $key ])) {
            security_slashes($array[ $key ]);
        } else {
            if (get_magic_quotes_gpc()) {
                $tmp = stripslashes($value);
            } else {
                $tmp = $value;
            }
            if (function_exists("mysqli_real_escape_string")) {
                $array[ $key ] = $_database->escape_string($tmp);
            } else {
                $array[ $key ] = addslashes($tmp);
            }
            unset($tmp);
        }
    }
}

security_slashes($_POST);
security_slashes($_COOKIE);
security_slashes($_GET);
security_slashes($_REQUEST);

// -- MYSQL QUERY FUNCTION -- //
$_mysql_querys = array();
function safe_query($query = "")
{

    global $_database;
    global $_mysql_querys;

    if (stristr(str_replace(' ', '', $query), "unionselect") === false and
        stristr(str_replace(' ', '', $query), "union(select") === false
    ) {
        $_mysql_querys[ ] = $query;
        if (empty($query)) {
            return false;
        }
        if (DEBUG == "OFF") {
            $result = $_database->query($query) or system_error('Query failed!');
        } else {
            $result = $_database->query($query) or
            system_error(
                '<strong>Query failed</strong> ' . '<ul>' .
                '<li>MySQL error no.: <mark>' . $_database->errno . '</mark></li>' .
                '<li>MySQL error: <mark>' . $_database->error . '</mark></li>' .
                '<li>SQL: <mark>' . $query . '</mark></li>'.
                '</ul>',
                1,
                1
            );
        }
        return $result;
    } else {
        die();
    }
}

// -- SYSTEM FILE INCLUDE -- //

function systeminc($file) {
    if (!include('system/' . $file . '.php')) {
        if (DEBUG == "OFF") {
            system_error('Could not get system file for <mark>' . $file . '</mark>');
        } else {
            system_error('Could not get system file for <mark>' . $file . '</mark>', 1, 1);
        }
    }
}

// -- GLOBAL SETTINGS -- //

$ds = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings"));
if (is_dir("development")) {
    $components = array(
        'css' => array(
            'components/bootstrap/bootstrap.min.css',
            'components/font-awesome/font-awesome.min.css',
            'components/scrolltotop/css/scrolltotop.css',
            'components/css/styles.css.php', 
            'components/css/button.css.php'
        ),
        'js' => array(
            'components/jquery/jquery.min.js',
            'components/bootstrap/bootstrap.min.js',
            'components/webshim/polyfiller.js',
            'components/scrolltotop/js/scrolltotop.js',
            'components/js/bbcode.js'
        )
    );
} else {
    $components = array(
        'css' => array(
            'components/bootstrap/bootstrap.min.css',
            'components/font-awesome/font-awesome.min.css',
            'components/scrolltotop/css/scrolltotop.css',
            'components/css/styles.css.php', 
            'components/css/button.css.php'
        ),
        'js' => array(
            'components/jquery/jquery.min.js',
            'components/bootstrap/bootstrap.min.js',
            'components/webshim/polyfiller.js',
            'components/scrolltotop/js/scrolltotop.js',
            'components/js/bbcode.js'
        )
    );
}


$maxresults = $ds[ 'results' ];
if (empty($maxresults)) {
    $maxresults = 5;
}
$maxupcoming = $ds[ 'upcoming' ];
if (empty($maxupcoming)) {
    $maxupcoming = 5;
}
$maxsball = $ds[ 'sball' ];
if (empty($maxsball)) {
    $maxsball = 5;
}
$sbrefresh = $ds[ 'sbrefresh' ];
if (empty($sbrefresh)) {
    $sbrefresh = 60;
}
$maxtopics = $ds[ 'topics' ];
if (empty($maxtopics)) {
    $maxtopics = 20;
}
$maxposts = $ds[ 'posts' ];
if (empty($maxposts)) {
    $maxposts = 10;
}
$maxfeedback = $ds[ 'feedback' ];
if (empty($maxfeedback)) {
    $maxfeedback = 5;
}
$maxmessages = $ds[ 'messages' ];
if (empty($maxmessages)) {
    $maxmessages = 5;
}
$maxusers = $ds[ 'users' ];
if (empty($maxusers)) {
    $maxusers = 5;
}
$hp_url = $ds[ 'hpurl' ];
$hp_title = stripslashes($ds[ 'title' ]);
$register_per_ip = $ds[ 'register_per_ip' ];
$admin_name = $ds[ 'adminname' ];
$admin_email = $ds[ 'adminemail' ];
$myclantag = $ds[ 'clantag' ];
$myclanname = $ds[ 'clanname' ];
$profilelast = $ds[ 'profilelast' ];
if (empty($profilelast)) {
    $profilelast = 20;
}
$sessionduration = $ds[ 'sessionduration' ];
if (empty($sessionduration)) {
    $sessionduration = 24;
}
$closed = (int)$ds[ 'closed' ];
$imprint_type = $ds[ 'imprint' ];
$picsize_l = $ds[ 'picsize_l' ];
if (empty($picsize_l)) {
    $picsize_l = 9999;
}
$picsize_h = $ds[ 'picsize_h' ];
if (empty($picsize_h)) {
    $picsize_h = 9999;
}
$gallerypictures = $ds[ 'pictures' ];
$publicadmin = $ds[ 'publicadmin' ];
$thumbwidth = $ds[ 'thumbwidth' ];
if (empty($thumbwidth)) {
    $thumbwidth = 120;
}
$default_language = $ds[ 'default_language' ];
if (empty($default_language)) {
    $default_language = 'en';
}
$rss_default_language = $ds[ 'default_language' ];
if (empty($rss_default_language)) {
    $rss_default_language = 'en';
}
$search_min_len = $ds[ 'search_min_len' ];
if (empty($search_min_len)) {
    $search_min_len = '4';
}
$autoresize = $ds[ 'autoresize' ];
if (!isset($autoresize)) {
    $autoresize = 2;
}
$max_wrong_pw = $ds[ 'max_wrong_pw' ];
if (empty($max_wrong_pw)) {
    $max_wrong_pw = 3;
}
$lastBanCheck = $ds[ 'bancheck' ];
$insertlinks = $ds[ 'insertlinks' ];
$autoDetectLanguage = (int)$ds[ 'detect_language' ];
$spamCheckMaxPosts = $ds[ 'spammaxposts' ];
if (empty($spamCheckMaxPosts)) {
    $spamCheckMaxPosts = 30;
}
$spamCheckEnabled = (int)$ds[ 'spam_check' ];
$spamCheckRating = 0.95;
$default_format_date = $ds[ 'date_format' ];
if (empty($default_format_date)) {
    $default_format_date = 'd.m.Y';
}
$default_format_time = $ds[ 'time_format' ];
if (empty($default_format_time)) {
    $default_format_time = 'H:i';
}
$modRewrite = (bool)$ds[ 'modRewrite' ];
if (empty($modRewrite)) {
    $modRewrite = false;
}

$new_chmod = 0666;

// -- STYLES -- //

$ergebnis = safe_query("SELECT * FROM " . PREFIX . "settings_styles");
$ds = mysqli_fetch_array($ergebnis);


