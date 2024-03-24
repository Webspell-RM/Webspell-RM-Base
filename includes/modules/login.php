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


$_language->readModule('login');
#if ($loggedin && $cookievalue == 'accepted') {
if ($loggedin) {
    #$_language->readModule('loginoverview', true);
    if ($userID && !isset($_GET[ 'userID' ]) && !isset($_POST[ 'userID' ])) {

        #Zur Seite zurÃ¼ck vor dem login
        if(isset($_SESSION['HTTP_REFERER']) && !empty($_SESSION['HTTP_REFERER'])) {
            ob_start();
            if($_SESSION['HTTP_REFERER'] == 'index.php?site=login') {
                header( 'Location: index.php?site=news');
            } elseif ($_SESSION['HTTP_REFERER'] != "") {
                header( 'Location: index.php');
            } else {
                header( 'Location: ' . $_SESSION['HTTP_REFERER'] );
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
    GLOBAL $logo,$theme_name,$themes;
    //set sessiontest variable (checks if session works correctly)
    $_SESSION[ 'ws_sessiontest' ] = true;
    $data_array=array();
    $data_array['$_modulepath'] = substr(MODULE, 0, -1);
    $data_array['$login_titel'] = $_language->module[ 'login_titel' ];
    $data_array['$login'] = $_language->module[ 'login' ];
    $data_array['$lang_register'] = $_language->module[ 'register' ];
    $data_array['$cookie_title'] = $_language->module[ 'cookie_title' ];
    $data_array['$cookie_text'] = $_language->module[ 'cookie_text' ];
    $data_array['$register_now'] = $_language->module[ 'register_now' ];
    $data_array['$lost_password'] = $_language->module[ 'lost_password' ];
    $data_array['$have_an_account'] = $_language->module['have_an_account'];
    $data_array['$info1'] = $_language->module['info1'];
    $data_array['$info2'] = $_language->module['info2'];
    $data_array['$reg'] = $_language->module['reg'];
    $data_array['$forgotten_your_login'] = $_language->module['forgotten_your_login'];
    $data_array['$info_login'] = $_language->module['info_login'];
    $data_array['$enter_your_email'] = $_language->module['enter_your_email'];
    $data_array['$enter_password'] = $_language->module['enter_password'];
    $data_array['$need_account'] = $_language->module['need_account'];

    #if($cookievalue == 'accepted') {
    if(isset($_COOKIE['ws_session'])) { 
        $loginform = $tpl->loadTemplate("login", "content", $data_array);
        echo $loginform;
    } else {
        $data_array=array();
        $data_array['$login_titel'] = $_language->module[ 'login_titel' ];
        $data_array['$cookie_title'] = $_language->module[ 'cookie_title' ];
        $data_array['$cookie_text'] = $_language->module[ 'cookie_text' ];
        $data_array['$login'] = $_language->module[ 'login' ];
        $data_array['$info3'] = $_language->module[ 'info3' ];
        $data_array['$info4'] = $_language->module[ 'info4' ];
        $data_array['$log_in'] = $_language->module[ 'log_in' ];
        $data_array['$return_to'] = $_language->module[ 'return_to' ];


        $loginform = $tpl->loadTemplate("login", "cookie_error", $data_array);
        echo $loginform;
    }
}