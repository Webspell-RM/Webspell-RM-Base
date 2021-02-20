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
\------------------------------------------------------------------*/

$_language->readModule('login');
if ($loggedin && $cookievalue == 'accepted') {
    $_language->readModule('loginoverview', true);
    if ($userID && !isset($_GET[ 'userID' ]) && !isset($_POST[ 'userID' ])) {

        #Zur Seite zurÃ¼ck vor dem login
        if ( isset( $_SERVER['HTTP_REFERER'] ) && !empty( $_SERVER['HTTP_REFERER'] )) {
            ob_start();
            if($_SERVER['HTTP_REFERER'] == 'index.php?site=login') {
                header( 'Location: index.php?site=news');
            } else {
                header( 'Location: ' . $_SERVER['HTTP_REFERER'] );
            }

            ob_end_clean();
            exit( 1 );
        } else {
            print '<html><head><script type="text/javascript">history.back();</script></head><body /></html>';
            exit( 1 );
        }

    } else {
        echo $_language->module[ 'you_have_to_be_logged_in' ];
    }
} else {
    //set sessiontest variable (checks if session works correctly)
    $_SESSION[ 'ws_sessiontest' ] = true;
    $data_array=array();
    $data_array['$_modulepath'] = substr(MODULE, 0, -1);
    $data_array['$login_titel'] = $_language->module[ 'login_titel' ];
    $data_array['$login'] = $_language->module[ 'login' ];
    $data_array['$lang_register'] = $_language->module[ 'register' ];
    $data_array['$info'] = $_language->module[ 'info' ];
    $data_array['$info1'] = $_language->module[ 'info1' ];
    $data_array['$info2'] = $_language->module[ 'info2' ];
    $data_array['$info3'] = $_language->module[ 'info3' ];
    $data_array['$info4'] = $_language->module[ 'info4' ];
    $data_array['$cookie_title'] = $_language->module[ 'cookie_title' ];
    $data_array['$cookie_text'] = $_language->module[ 'cookie_text' ];
    $data_array['$register_now'] = $_language->module[ 'register_now' ];
    $data_array['$lost_password'] = $_language->module[ 'lost_password' ];
    if($cookievalue == 'accepted') {
        $loginform = $tpl->loadTemplate("login", "content", $data_array);
        echo $loginform;
    } else {
        $loginform = $tpl->loadTemplate("login", "cookie_error", $data_array);
        echo $loginform;
    }
}