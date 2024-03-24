<?php
/**
 *¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
 *                  Webspell-RM      /                        /   /                                          *
 *                  -----------__---/__---__------__----__---/---/-----__---- _  _ -                         *
 *                   | /| /  /___) /   ) (_ `   /   ) /___) /   / __  /     /  /  /                          *
 *                  _|/_|/__(___ _(___/_(__)___/___/_(___ _/___/_____/_____/__/__/_                          *
 *                               Free Content / Management System                                            *
 *                                           /                                                               *
 *¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
 * @version         webspell-rm                                                                              *
 *                                                                                                           *
 * @copyright       2018-2023 by webspell-rm.de                                                              *
 * @support         For Support, Plugins, Templates and the Full Script visit webspell-rm.de                 *
 * @website         <https://www.webspell-rm.de>                                                             *
 * @forum           <https://www.webspell-rm.de/forum.html>                                                  *
 * @wiki            <https://www.webspell-rm.de/wiki.html>                                                   *
 *                                                                                                           *
 *¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
 * @license         Script runs under the GNU GENERAL PUBLIC LICENCE                                         *
 *                  It's NOT allowed to remove this copyright-tag                                            *
 *                  <http://www.fsf.org/licensing/licenses/gpl.html>                                         *
 *                                                                                                           *
 *¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
 * @author          Code based on WebSPELL Clanpackage (Michael Gruber - webspell.at)                        *
 * @copyright       2005-2011 by webspell.org / webspell.info                                                *
 *                                                                                                           *
 *¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
*/

ob_start();

function generateCallTrace() {

    $trace = debug_backtrace();
    $trace = array_reverse($trace);
    array_pop($trace);
    array_pop($trace);
    $basepath = realpath(dirname(__FILE__)).DIRECTORY_SEPARATOR;
    $result = array();
    for ($i=0; $i < count($trace); $i++) {
        $line  = str_replace($basepath, '', $trace[$i]['file']);
        $line .= '('.$trace[$i]['line']."): ";
        $line .= "<b>".$trace[$i]['function']."</b>(";
        $params = array();
        foreach ($trace[$i]['args'] as $param) {
            $params[] = htmlspecialchars(var_export(str_replace($basepath, '', $param), true));
        }
        $line .= implode(", ", $params);
        $line .= ")";
        $result[] = $line;
    }

    return implode("\n", $result);
}

function system_error($text, $system = 1, $strace = 0) {
    
    ob_clean();
    global $_database;
    if ($strace) {
        $trace = '<pre>' . generateCallTrace() . '</pre>';
    } else {
        $trace = '';
    }
    if ($system) {
		if(file_exists('system/version.php')) { include('system/version.php'); } else { include('../system/version.php'); }
            $info = '<h1>Error 404</h1>
            <p>Die angefragte Seite konnte nicht gefunden werden.<br>The requested page could not be found.<br>La pagina richiesta non è stata trovata.<br><a class="btn btn-success" href="index.php"/>back</a>
            <br> Version: ' . $version . ', PHP Version: ' . phpversion();
        if (!mysqli_connect_error()) {
            $info .= ', MySQL Version: ' . $_database->server_info;
        }
    } else {
        $info = '<h1>Error 404</h1>
        <p>Die angefragte Seite konnte nicht gefunden werden.<br>The requested page could not be found.<br>La pagina richiesta non è stata trovata.<br><a class="btn btn-success" href="index.php"/>back</a>
        ';
    }
    die('<!DOCTYPE html>
        <html>
        <head>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta charset="utf-8">
            <meta name="description" content="Clanpage using webSPELL RM CMS">
            <meta name="author" content="webspell.org">
            <meta name="copyright" content="Copyright 2005-2018 by webspell.org / webspell-rm.de">
            <meta name="generator" content="webSPELL-RM">

            <title>webSPELL-RM - Error</title>
            <base href="$rewriteBase">
            <link href="./components/bootstrap/css/bootstrap.min.css" rel="stylesheet">
            <link href="./components/css/lockpage.css" rel="stylesheet" type="text/css">

        </head>

        <body>
        <div class="lock_wrapper">
            <div class="container text-center">
                <div class="col-lg-12">
                    <img class="img-responsive" src="images/logo.png" alt=""/>
                    <div class="shdw"></div>
                </div>
                    ' . $info . '</p>
                <h4>INFO</h4> 
                    <div>
                        <div class="alert alert-danger" role="alert"><strong>Ein Fehler ist aufgetreten<br>An error has occurred<br>Si è verificato un errore</strong></div>
                    </div>
                    <div class="alert alert-info" role="alert">
                        ' . $text . '
                    </div>
                    <div class="alert alert-warning" role="alert">
                        ' . $trace . '
                    </div>    
            </div>
        </div>
        </body>
        </html>
    ');
}
