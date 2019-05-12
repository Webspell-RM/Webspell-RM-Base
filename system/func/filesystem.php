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
function detectfilesize($size, $round = '2')
{
    $filesize = $size;
    for ($i = 0; $filesize >= 1024; $i++) {
        $filesize = $filesize / 1024;
    }
    $filesize = round($filesize, $round);
    switch ($i) {
        case 0:
            $filesize = $filesize . " Byte";
            break;
        case 1:
            $filesize = $filesize . " kB";
            break;
        case 2:
            $filesize = $filesize . " MB";
            break;
        case 3:
            $filesize = $filesize . " GB";
            break;
        case 4:
            $filesize = $filesize . " TB";
            break;
        default:
            $filesize = $size . " Byte";
            break;
    }
    return $filesize;
}

function getdirsize($dir)
{

    $size = 0;
    $handle = opendir($dir);
    while (false !== ($file = readdir($handle))) {
        if ($file != "." && $file != "..") {
            if (is_dir($dir . $file)) {
                $size = $size + getdirsize($dir . $file . '/');
            } else {
                $size = $size + filesize($dir . $file);
            }
        }
    }
    return $size;
}

function rm_recursive($filepath)
{
    if (is_dir($filepath) && !is_link($filepath)) {
        if ($dh = @opendir($filepath)) {
            while (($sf = readdir($dh)) !== false) {
                if ($sf == '.' || $sf == '..') {
                    continue;
                }
                if (!rm_recursive($filepath . '/' . $sf)) {
                    return false;
                }
            }
            closedir($dh);
        }
        return @rmdir($filepath);
    }
    return @unlink($filepath);
}

function isFileURL($url)
{
    if (!empty($url)) {
        $urlInfo = parse_url($url);
		if(isset($urlInfo['scheme'])) {
			return in_array($urlInfo['scheme'], array('ftp','http','https')) && !empty($urlInfo['path']);
		} else {
			return false;
		}
    } else {
        return false;
    }
}

function isWebURL($url)
{
    $urlInfo = parse_url($url);
    return in_array($urlInfo['scheme'], array('ftp','http','https','mailto','news')) && !empty($urlInfo['path']);
}

function isWebURLorProtocolRelative($url)
{
    return (stripos($url, "http://") === 0 || stripos($url, "https://") === 0 || stripos($url, "//") === 0);
}
