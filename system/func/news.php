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
function getanzcomments($id, $type)
{
    return mysqli_num_rows(
        safe_query(
            "SELECT commentID FROM `" . PREFIX . "plugins_comments` WHERE `parentID` = " . (int)$id . " AND type='$type'"
        )
    );
}

function getlastcommentposter($id, $type)
{
    $ds = mysqli_fetch_array(
        safe_query(
            "SELECT
                `userID`,
                `nickname`
            FROM
                `" . PREFIX . "plugins_comments`
            WHERE
                `parentID` = " . (int)$id . " AND
                `type` = '$type'
            ORDER BY
                `date` DESC
            LIMIT 0,1"
        )
    );
    if ($ds['userID']) {
        return getnickname($ds['userID']);
    }

    return htmlspecialchars($ds['nickname']);
}

function getlastcommentdate($id, $type)
{
    $ds = mysqli_fetch_array(
        safe_query(
            "SELECT
                `date`
            FROM
                `" . PREFIX . "plugins_comments`
            WHERE
                `parentID` = " . (int)$id . " AND
                `type` = '$type'
            ORDER BY
                `date` DESC
            LIMIT 0,1"
        )
    );
    return $ds['date'];
}

function getusernewsposts($userID)
{
    return mysqli_num_rows(safe_query("SELECT newsID FROM `" . PREFIX . "plugins_news` WHERE `poster` = " . (int)$userID));
}

function getusernewscomments($userID)
{
    return mysqli_num_rows(
        safe_query(
            "SELECT commentID FROM `" . PREFIX . "plugins_comments` WHERE `userID` = " . (int)$userID . " AND `type` = 'ne'"
        )
    );
}

function getrubricname($rubricID)
{
    $ds = mysqli_fetch_array(
        safe_query(
            "SELECT rubric FROM `" . PREFIX . "plugins_news_rubrics` WHERE `rubricID` = " . (int)$rubricID
        )
    );
    return $ds['rubric'];
}

function getrubricpic($rubricID)
{
    $ds = mysqli_fetch_array(
        safe_query(
            "SELECT pic FROM `" . PREFIX . "plugins_news_rubrics` WHERE `rubricID` = " . (int)$rubricID
        )
    );
    return $ds['pic'];
}

/*function getlanguage($lang)
{
    $ds = mysqli_fetch_array(
        safe_query(
            "SELECT language FROM `" . PREFIX . "plugins_news_languages` WHERE `lang` = '$lang'"
        )
    );
    return $ds['language'];
}

function select_language($message_array)
{
    if (isset($_SESSION['language'])) {
        $i = 0;
        foreach ($message_array as $val) {
            if ($val['lang'] == $_SESSION['language']) {
                return $i;
            }
            $i++;
        }
    }
    return 0;
}*/

function getlanguageid($lang, $message_array)
{
    $i = 0;
    foreach ($message_array as $val) {
        if ($val['lang'] == $lang) {
            return $i;
        }
        $i++;
    }
    return 0;
}
