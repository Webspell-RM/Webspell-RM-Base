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
chdir("../../");
$err=0;
if(file_exists("system/sql.php")) { include("system/sql.php"); } else { $err++; }
if(file_exists("system/settings.php")) { include("system/settings.php"); }  else { $err++; }

// copy pagelock information for session test + deactivated pagelock for checklogin
$closed_tmp = $closed;
$closed = 0;

if(file_exists("system/functions.php")) { include("system/functions.php");  } else { $err++; }

if (isset($_GET[ 'type' ])) {
    $type = $_GET[ 'type' ];
} else {
    $type = null;
}

if (!empty($spamapikey)) {
    if (isset($_GET[ 'postID' ])) {
        $postID = $_GET[ 'postID' ];

        $get = safe_query("SELECT * FROM " . PREFIX . "forum_posts WHERE postID='" . $postID . "'");
        if (mysqli_num_rows($get)) {
            $ds = mysqli_fetch_array($get);

            if (ispageadmin($userID) || ismoderator($userID, $ds[ 'boardID' ])) {
                $message = $ds[ 'message' ];
                $spamApi = \webspell\SpamApi::getInstance();
                if (in_array($type, array("spam", "ham"))) {
                    $spamApi->learn($message, $type);
                }
            }
        }
    } elseif (isset($_GET[ 'commentID' ])) {
        $commentID = $_GET[ 'commentID' ];
        if (ispageadmin($userID) || isfeedbackadmin($userID)) {
            $get = safe_query("SELECT * FROM " . PREFIX . "comments WHERE commentID='" . $commentID . "'");
            if (mysqli_num_rows($get)) {
                $ds = mysqli_fetch_array($get);

                $text = $ds[ 'comment' ];
                $spamApi = \webspell\SpamApi::getInstance();
                if (in_array($type, array("spam", "ham"))) {
                    $spamApi->learn($text, $type);
                }
            }
        }
    }
}
