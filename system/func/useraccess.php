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
function isanyadmin($userID)
{
    return (
        mysqli_num_rows(
            safe_query(
                "SELECT
                    userID
                FROM
                    " . PREFIX . "user_groups
                WHERE
                    `userID` = " . (int)$userID . " AND
                    (
                        `super` = 1 OR
                        `forum` = 1 OR
                        `files` = 1 OR
                        `page` = 1 OR
                        `feedback` = 1 OR
                        `news` = 1 OR
                        `news_writer` = 1 OR
                        `polls` = 1 OR
                        `clanwars` = 1 OR
                        `user` = 1 OR
                        `cash` = 1 OR
                        `gallery` = 1
                    )"
            )
        ) > 0
    );
}

function issuperadmin($userID)
{
    return (
        mysqli_num_rows(
            safe_query(
                "SELECT userID FROM " . PREFIX . "user_groups WHERE `super` = 1 AND `userID` = " . (int)$userID
            )
        ) > 0
    );
}

function isforumadmin($userID)
{
    return (
        mysqli_num_rows(
            safe_query(
                "SELECT
                    userID
                FROM
                    " . PREFIX . "user_groups
                WHERE
                    (
                        `forum` = 1 OR
                        `super` = 1
                    ) AND
                    `userID` = " . (int)$userID
            )
        ) > 0
    );
}

function isfilesadmin($userID)
{
    return (
        mysqli_num_rows(
            safe_query(
                "SELECT
                    userID
                FROM
                    " . PREFIX . "user_groups
                WHERE
                    (
                        `files` = 1 OR
                        `super` = 1
                    ) AND
                    `userID` = " . (int)$userID
            )
        ) > 0
    );
}

function ispageadmin($userID)
{
    return (
        mysqli_num_rows(
            safe_query(
                "SELECT
                    userID
                FROM
                    " . PREFIX . "user_groups
                WHERE
                    (
                        `page` = 1 OR
                        `super` = 1
                    ) AND
                    `userID` = " . (int)$userID
            )
        ) > 0
    );
}

function isfeedbackadmin($userID)
{
    return (
        mysqli_num_rows(
            safe_query(
                "SELECT
                    userID
                FROM
                    " . PREFIX . "user_groups
                WHERE
                    (
                        `feedback` = 1 OR
                        `super` = 1
                    ) AND
                    `userID` = " . (int)$userID
            )
        ) > 0
    );
}

function isnewsadmin($userID)
{
    return (
        mysqli_num_rows(
            safe_query(
                "SELECT
                    userID
                FROM
                    " . PREFIX . "user_groups
                WHERE
                    (
                        `news` = 1 OR
                        `super` = 1
                    ) AND
                    `userID` = " . (int)$userID
            )
        ) > 0
    );
}

function isnewswriter($userID)
{
    return (
        mysqli_num_rows(
            safe_query(
                "SELECT
                    userID
                FROM
                    " . PREFIX . "user_groups
                WHERE
                    (
                        `news` = 1 OR
                        `super` = 1 OR
                        `news_writer` = 1
                    ) AND
                    `userID` = " . (int)$userID
            )
        ) > 0
    );
}

function ispollsadmin($userID)
{
    return (
        mysqli_num_rows(
            safe_query(
                "SELECT
                    userID
                FROM
                    " . PREFIX . "user_groups
                WHERE
                    (
                        `polls` = 1 OR
                        `super` = 1
                    ) AND
                    `userID` = " . (int)$userID
            )
        ) > 0
    );
}

function isclanwarsadmin($userID)
{
    return (
        mysqli_num_rows(
            safe_query(
                "SELECT
                    userID
                FROM
                    " . PREFIX . "user_groups
                WHERE
                    (
                        `clanwars` = 1 OR
                        `super` = 1
                    ) AND
                    `userID` = " . (int)$userID
            )
        ) > 0
    );
}

function ismoderator($userID, $boardID)
{
    if (empty($userID) || empty($boardID)) {
        return false;
    }

    if (!isanymoderator($userID)) {
        return false;
    }

    return (
        mysqli_num_rows(
            safe_query(
                "SELECT
                    userID
                FROM
                    " . PREFIX . "plugins_forum_moderators
                WHERE
                    `userID` = " . (int)$userID . " AND
                    `boardID` = " . (int)$boardID
            )
        ) > 0
    );
}

function isanymoderator($userID)
{
    return (
        mysqli_num_rows(
            safe_query(
                "SELECT
                    userID
                FROM
                    " . PREFIX . "user_groups
                WHERE
                    `userID` = " . (int)$userID . " AND
                    `moderator` = 1"
            )
        ) > 0
    );
}

function isuseradmin($userID)
{
    return (
        mysqli_num_rows(
            safe_query(
                "SELECT
                    userID
                FROM
                    `" . PREFIX . "user_groups`
                WHERE
                    (
                        `user` = 1 OR
                        `super` = 1
                    ) AND
                    `userID` = " . (int)$userID
            )
        ) > 0
    );
}

function iscashadmin($userID)
{
    return (
        mysqli_num_rows(
            safe_query(
                "SELECT
                    userID
                FROM
                    `" . PREFIX . "user_groups`
                WHERE
                    (
                        `cash` = 1 OR
                        `super` = 1
                    ) AND
                    `userID` = " . (int)$userID
            )
        ) > 0
    );
}

function isgalleryadmin($userID)
{
    return (
        mysqli_num_rows(
            safe_query(
                "SELECT
                    userID
                FROM
                    `" . PREFIX . "user_groups`
                WHERE
                    (
                        `gallery` = 1 OR
                        `super` = 1
                    ) AND
                    `userID` = " . (int)$userID
            )
        ) > 0
    );
}

function isclanmember($userID)
{
    if (mysqli_num_rows(
        safe_query(
            "SELECT userID FROM `" . PREFIX . "squads_members` WHERE `userID` = " . (int)$userID
        )
    ) > 0
    ) {
        return true;
    } else {
        return issuperadmin($userID);
    }
}

function isjoinusmember($userID)
{
    if (mysqli_num_rows(
        safe_query(
            "SELECT userID FROM `" . PREFIX . "squads_members` WHERE `userID` = " . (int)$userID
        )
    ) > 0
    ) {
        return true;
    } else {
        return issuperadmin($userID);
    }
}

function isbanned($userID)
{
    return (
        mysqli_num_rows(
            safe_query(
                "SELECT
                    userID
                FROM
                    `" . PREFIX . "user`
                WHERE
                    `userID` = " . (int)$userID . " AND
                    (
                        `banned` = 'perm' OR
                        `banned` IS NOT NULL
                    )"
            )
        ) > 0
    );
}

function iscommentposter($userID, $commID)
{
    if (empty($userID) || empty($commID)) {
        return false;
    }

    return (
        mysqli_num_rows(
            safe_query(
                "SELECT
                    commentID
                FROM
                    " . PREFIX . "plugins_comments
                WHERE
                    `commentID` = " . (int)$commID . " AND
                    `userID` = " . (int)$userID
            )
        ) > 0
    );
}

function isforumposter($userID, $postID)
{
    return (
        mysqli_num_rows(
            safe_query(
                "SELECT
                    postID
                FROM
                    " . PREFIX . "plugins_forum_posts
                WHERE
                    `postID` = " . (int)$postID . " AND
                    `poster` = " . (int)$userID
            )
        ) > 0
    );
}

function istopicpost($topicID, $postID)
{
        $ds = mysqli_fetch_array(
            safe_query(
                "SELECT
                    postID
                FROM
                    " . PREFIX . "plugins_forum_posts
                WHERE
                    `topicID` = " . (int)$topicID . "
                ORDER BY
                    `date` ASC
                LIMIT
                    0,1"
            )
        );
        if($ds[ 'postID' ] == $postID) {
	        return true;
	    }
        else {
	        return false;
	    }
}

function isinusergrp($usergrp, $userID)
{
    if ($usergrp == 'user' && !empty($userID)) {
        return true;
    }

    if (!usergrpexists($usergrp)) {
        return false;
    }

    if (mysqli_num_rows(safe_query(
        "SELECT
                userID
            FROM
                " . PREFIX . "user_forum_groups
            WHERE
                `" . $usergrp . "` = 1 AND
                `userID` = " . (int)$userID
    )) > 0
    ) {
        return true;
    }

    return isforumadmin($userID);
}
