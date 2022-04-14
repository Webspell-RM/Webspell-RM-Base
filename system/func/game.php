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
