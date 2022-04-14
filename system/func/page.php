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

function redirect($url, $info, $time = 1)
{
    if ($url == "back" && $info != '' && isset($_SERVER['HTTP_REFERER'])) {
        $url = $_SERVER['HTTP_REFERER'];
        $info = '';
    } elseif ($url == "back" && $info != '') {
        $url = $info;
        $info = '';
    }
    echo
        '<meta http-equiv="refresh" content="' . $time . ';URL=' . $url . '"><br />' .
        '<p style="color:#000000">' . $info . '</p><br /><br />';
}

function isStaticPage($staticID = null)
{
    if ($GLOBALS['site'] != "static") {
        return false;
    }

    if ($staticID !== null) {
        if ($_GET['staticID'] != $staticID) {
            return false;
        }
    }

    return true;
}

function generateAlert($text, $class = 'alert-warning', $dismissible = false)
{
    $classes = 'alert ' . $class;
    if ($dismissible) {
        $classes .= ' alert-dismissible';
    }
    $return = '<div class="' . $classes . '" role="alert">';
    if ($dismissible) {
        $return .= '<button type="button" class="close" data-dismiss="alert">';
        $return .= '<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>';
        $return .= '</button>';
    }
    $return .= $text;
    $return .= '</div>';
    return $return;
}

function generateErrorBox($message, $dismissible = false)
{
    return generateAlert($message, 'alert-danger', $dismissible);
}

function generateSuccessBox($message, $dismissible = false)
{
    return generateAlert($message, 'alert-success', $dismissible);
}

function generateErrorBoxFromArray($intro, $errors, $dismissible = false)
{
    $message = '<strong>' . $intro . ':</strong><br/><ul>';
    foreach ($errors as $error) {
        $message .= '<li>' . $error . '</li>';
    }
    $message .= '</ul>';
    return generateAlert($message, 'alert-danger', $dismissible);
}

function generateBoxFromArray($intro, $class, $errors, $dismissible = false)
{
    $message = '<strong>' . $intro . ':</strong><br/><ul>';
    foreach ($errors as $error) {
        $message .= '<li>' . $error . '</li>';
    }
    $message .= '</ul>';
    return generateAlert($message, $class, $dismissible);
}

function generateComponents($components, $type)
{
    $return = '';
    foreach ($components as $component) {
        if ($type === 'js') {
            $return .= '<script src="' . $component . '"></script>';
        } elseif ($type === 'css') {
            $return .= '<link href="' . $component . '" rel="stylesheet">';
        }
    }

    return $return;
}
