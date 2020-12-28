<?php
/*-----------------------------------------------------------------\
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
\------------------------------------------------------------------*/

$_language->readModule('report');
if (isset($run)) {
    $run = 1;
} else {
    $run = 0;
}
if ($userID) {
    $run = 1;
} else {
    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha($_POST[ 'captcha' ], $_POST[ 'captcha_hash' ])) {
        $run = 1;
    }
}

if ($_POST[ 'mode' ] && $run) {
    $mode = $_POST[ 'mode' ];
    $type = $_POST[ 'type' ];
    $info = $_POST[ 'description' ];
    $id = $_POST[ 'id' ];

    if ($info) {
        $info = clearfromtags($info);
    } else {
        $info = $_language->module[ 'no_informations' ];
    }

    $date = time();
    $message = sprintf($_language->module[ 'report_message' ], $mode, $type, $id, $info, $id);

    //send message to file-admins

    $ergebnis = safe_query("SELECT userID FROM " . PREFIX . "user_groups WHERE files='1'");
    while ($ds = mysqli_fetch_array($ergebnis)) {
        sendmessage($ds[ 'userID' ], $type . ': ' . $mode, $message);
    }

    redirect("index.php?site=" . $type, $_language->module[ 'report_recognized' ], "3");
} else {
    echo $_language->module[ 'wrong_securitycode' ];
}
