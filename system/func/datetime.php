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

function getuserformatdate($userID)
{
    $ds = mysqli_fetch_array(safe_query("SELECT date_format FROM " . PREFIX . "user WHERE `userID` = " . (int)$userID));
    return $ds['date_format'];
}

function getuserformattime($userID)
{
    $ds = mysqli_fetch_array(safe_query("SELECT time_format FROM " . PREFIX . "user WHERE `userID` = " . (int)$userID));
    return $ds['time_format'];
}

function getformatdate($date)
{
    global $userID, $default_format_date;

    if ($userID && !isset($_GET['userID']) && !isset($_POST['userID'])) {
        $DateFormat = date(getuserformatdate($userID), $date);
    } else {
        $DateFormat = date($default_format_date, $date);
    }
    return $DateFormat;
}

function getformattime($time)
{
    global $userID, $default_format_time;

    if ($userID && !isset($_GET['userID']) && !isset($_POST['userID'])) {
        $timeFormat = date(getuserformattime($userID), $time);
    } else {
        $timeFormat = date($default_format_time, $time);
    }
    return $timeFormat;
}

function getformatdatetime($date_time)
{
    global $userID, $default_format_date, $default_format_time;

    if ($userID && !isset($_GET['userID']) && !isset($_POST['userID'])) {
        $datetimeFormat = date((getuserformatdate($userID) . " - " . getuserformattime($userID)), $date_time);
    } else {
        $datetimeFormat = date(($default_format_date . " - " . $default_format_time), $date_time);
    }
    return $datetimeFormat;
}
