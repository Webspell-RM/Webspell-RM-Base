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
