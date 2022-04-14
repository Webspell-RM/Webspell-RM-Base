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

session_name("ws_session");
session_start();

header('content-type: text/html; charset=utf-8');

include("../system/func/language.php");
include("../system/func/user.php");
include("../system/template.php");
include("../system/version.php");

if (version_compare(PHP_VERSION, '5.3.7', '>') && version_compare(PHP_VERSION, '5.5.0', '<')) {
    include('../system/func/password.php');
}

$_language = new \webspell\Language();

if (!isset($_SESSION['language'])) {
    $_SESSION['language'] = "de";
}

if (isset($_GET['lang'])) {
    if ($_language->setLanguage($_GET['lang'])) {
        $_SESSION['language'] = $_GET['lang'];
    }
    header("Location: index.php");
    exit();
}

$_language->setLanguage($_SESSION['language']);
$_language->readModule('index');

$_template = new template('', 'templates/');

if (isset($_GET['step'])) {
    $step = (int)$_GET['step'];
} else {
    $step = 0;
}

$calcstep = ($step > 0) ?
    $step + 1 : 1;

if ($step >= 0 && $step <= 4) {
    $_language->readModule('step' . $step, true);
} else {
    $_language->readModule('step0', true);
}

$doneArray = array();
for ($x = 0; $x < 5; $x++) {
    $doneArray[$x] = ($step > $x) ?
        '<i class="far fa-check-circle green"></i>' : '';
}

function CurrentUrl() {
    return ((empty($_SERVER['HTTPS'])) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'];
}

function checksession($value) {
  if(isset($_SESSION[$value])) {
    $vari = $_SESSION[$value];
  }else{	
    $vari = ''; 	
  }
  return $vari;
}

function checkfunc($value) {
    global $_language;
    if (function_exists('mysqli_connect')) {
        $value = '<span class="badge bg-success">'.$_language->module['available'].'</span>';
    } else {
        $value = '<span class="badge bg-danger">'.$_language->module['unavailable'].'</span>';
        $fatal_error = false;
    }
    return $value;
}
$data_array = array();
$data_array['$lang_welcome'] = $_language->module['welcome'];
$data_array['$lang_license_agreement'] = $_language->module['license_agreement'];
$data_array['$lang_url'] = $_language->module['url'];
$data_array['$lang_permissions'] = $_language->module['permissions'];
$data_array['$lang_select_installation'] = $_language->module['select_installation'];
$data_array['$lang_configuration'] = $_language->module['configuration'];
$data_array['$lang_complete'] = $_language->module['complete'];
$data_array['$done0'] = $doneArray[0];
$data_array['$done1'] = $doneArray[1];
$data_array['$done2'] = $doneArray[2];
$data_array['$done3'] = $doneArray[3];
$data_array['$done4'] = $doneArray[4];
$data_array['$calcstep'] = $calcstep;
$installhead = $_template->loadTemplate('install', 'head', $data_array);
echo $installhead;
?>