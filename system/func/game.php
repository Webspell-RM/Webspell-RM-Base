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

function getanzcwcomments($cwID)
{
    return mysqli_num_rows(
        safe_query(
            "SELECT commentID FROM `" . PREFIX . "comments` WHERE `parentID` = " .(int)$cwID . " AND `type` = 'cw'"
        )
    );
}

function getsquads()
{
    $squads = "";
    $ergebnis = safe_query("SELECT * FROM `" . PREFIX . "squads`");
    while ($ds = mysqli_fetch_array($ergebnis)) {
        $squads .= '<option value="' . $ds[ 'squadID' ] . '">' . $ds[ 'name' ] . '</option>';
    }
    return $squads;
}

function getgamesquads()
{
    $squads = '';
    $ergebnis = safe_query("SELECT * FROM `" . PREFIX . "squads` WHERE `gamesquad` = 1");
    while ($ds = mysqli_fetch_array($ergebnis)) {
        $squads .= '<option value="' . $ds[ 'squadID' ] . '">' . $ds[ 'name' ] . '</option>';
    }
    return $squads;
}

function getsquadname($squadID)
{
    $ds = mysqli_fetch_array(
        safe_query(
            "SELECT `name` FROM `" . PREFIX . "squads` WHERE `squadID` = " . (int)$squadID
        )
    );
    return $ds[ 'name' ];
}

function issquadmember($userID, $squadID)
{
    return (
        mysqli_num_rows(
            safe_query(
                "SELECT
                    `sqmID`
                FROM
                    `" . PREFIX . "squads_members`
                WHERE
                    `userID` = " . (int)$userID . " AND
                    `squadID` = " . (int)$squadID
            )
        ) > 0);
}

function isgamesquad($squadID)
{
    return (
        mysqli_num_rows(
            safe_query(
                "SELECT
                    `squadID`
                FROM
                    `" . PREFIX . "squads`
                WHERE
                    `squadID` = " . (int)$squadID . " AND
                    gamesquad = 1"
            )
        ) > 0);
}

function getgamename($tag)
{
    $get = safe_query("SELECT `name` FROM `" . PREFIX . "settings_games` WHERE `tag` = '$tag'");
    if(mysqli_num_rows($get) > 0) {
        $ds = mysqli_fetch_array($get);
    return $ds[ 'name' ];
    } else {
        return '';
    }
}

function is_gametag($tag)
{
    return (mysqli_num_rows(safe_query("SELECT `name` FROM `" . PREFIX . "settings_games` WHERE `tag` = '$tag'")) > 0);
}

function getGamesAsOptionList($selected = null)
{
    $gamesa = safe_query("SELECT * FROM `" . PREFIX . "settings_games` ORDER BY `name`");
    $list = "";

    while ($ds = mysqli_fetch_array($gamesa)) {
        if ($ds[ 'tag' ] == $selected) {
            $list .= '<option value="' . $ds[ 'tag' ] . '" selected="selected">' . $ds[ 'name' ] . '</option>';
        } else {
            $list .= '<option value="' . $ds[ 'tag' ] . '">' . $ds[ 'name' ] . '</option>';
        }
    }

    return $list;
}
