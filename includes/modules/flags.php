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
include("_mysql.php");
include("_settings.php");
include("_functions.php");
$componentsCss = generateComponents($components['css'], 'css');
$componentsJs = generateComponents($components['js'], 'js');
echo '<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="description" content="Clanpage using webSPELL 4 CMS">
    <meta name="author" content="webspell.org">
    <meta name="copyright" content="Copyright 2005-2015 by webspell.org">
    <meta name="generator" content="webSPELL">
    <title>Flags</title>
    <base href="'.$rewriteBase.'">
    '.$componentsCss.'
</head>
<body>
<table class="table table-striped">
    <tr>
        <th>Flag:</th>
        <th>Tag:</th>
    </tr>';


$filepath = "./images/flags/";
unset($files);
if ($dh = opendir($filepath)) {
    while ($file = readdir($dh)) {
        if (preg_match("/\.gif/si", $file)) {
            $files[ ] = $file;
        }
    }
    closedir($dh);
}

if (is_array($files)) {
    sort($files);
    foreach ($files as $file) {
        $flag = explode(".", $file);

        echo '<tr>
            <td align="center"><a href="javascript:AddCodeFromWindow(\'[flag]' . $flag[ 0 ] .
                '[/flag]\')"><img src="images/flags/' . $file . '" alt=""></a></td>
            <td align="center"><a href="javascript:AddCodeFromWindow(\'[flag]' . $flag[ 0 ] .
                '[/flag]\')">' . $flag[ 0 ] . '</a></td>
        </tr>';
    }
}
echo $componentsJs;
echo '<script src="js/bbcode.js"></script>';
echo '</table></body></html>';
