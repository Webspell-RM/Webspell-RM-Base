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
$_language->readModule('login');

if ($loggedin && $cookievalue == 'accepted') {

    $_language->readModule('loginoverview', true);

    if ($userID && !isset($_GET[ 'userID' ]) && !isset($_POST[ 'userID' ])) {

        $data_array = array();
        $data_array['$title'] = $_language->module[ 'overview' ];
        $template = $tpl->loadTemplate("loginoverview", "head", $data_array);
        echo $template;

        $ds = mysqli_fetch_array(
            safe_query(
                "SELECT
                        `registerdate`
                    FROM `" . PREFIX . "user`
                    WHERE `userID` = " . $userID
            )
        );

        $username = '<a class="btn btn-info" href="index.php?site=profile&amp;id=' . $userID . '"><i class="fa fa-user"></i> ' . getnickname($userID) . '</a>';
        $lastlogin = getformatdatetime($_SESSION[ 'ws_lastlogin' ]);
        $registerdate = getformatdatetime($ds[ 'registerdate' ]);

        //clanmember/admin/referer

        if (isanyadmin($userID)) {
            $admincenterpic =
                '<a class="btn btn-success btn-lg" href="admin/admincenter.php" target="_blank">
                    <i class="fas fa-cogs"></i> '.$_language->module[ 'admin' ].'</a>';
        } else {
            $admincenterpic = '';
        }

        if (isset($_SESSION[ 'referer' ])) {
            $referer_uri = '<a class="btn" href="' . $_SESSION[ 'referer' ] . '">
                <i class="fas fa-chevron-left"></i> ' .
                $_language->module[ 'back_last_page' ] . '</a>';
            unset($_SESSION[ 'referer' ]);
        } else {
            $referer_uri = '';
        }

        $data_array = array();
        $data_array['$_modulepath'] = MODULE;
        $data_array['$username'] = $username;
        $data_array['$lastlogin'] = $lastlogin;
        $data_array['$registerdate'] = $registerdate;
        $data_array['$referer_uri'] = $referer_uri;
        $data_array['$admincenterpic'] = $admincenterpic;

        $data_array['$buddy_list'] = $_language->module[ 'buddy_list' ];
        $data_array['$messenger'] = $_language->module[ 'messenger' ];
        $data_array['$edit_account'] = $_language->module[ 'edit_account' ];
        $data_array['$logout'] = $_language->module[ 'logout' ];
        $data_array['$user'] = $_language->module[ 'user' ];
        $data_array['$last_login'] = $_language->module[ 'last_login' ];
        $data_array['$registered'] = $_language->module[ 'registered' ];
        $data_array['$informations'] = $_language->module[ 'informations' ];
        $data_array['$menu'] = $_language->module[ 'menu' ];

        $template = $tpl->loadTemplate("loginoverview", "content", $data_array);
        echo $template;

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
