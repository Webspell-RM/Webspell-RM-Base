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

GLOBAL $profilelast;

$_language->readModule('profile');

if (isset($_GET[ 'id' ])) {
    $id = (int)$_GET[ 'id' ];
} else {
    $id = $userID;
}
if (isset($_GET[ 'action' ])) {
    $action = $_GET[ 'action' ];
} else {
    $action = '';
}

if (isset($id) && getnickname($id) != '' && deleteduser($id) == '0') {
	
    if (isbanned($id)) {
        $banned =
            '' . $_language->module[ 'is_banned' ] . '';
    } else {
        $banned = '';
    }	


 if ($action == "lastposts") {
        //profil: last posts

        $data_array = array();
        $data_array['$id'] = $id;
        $data_array['$profilelast'] = $profilelast;
        $data_array['$banned'] = $banned;
        
        $data_array['$profile'] = $_language->module[ 'profile' ];
        $template = $tpl->loadTemplate("profile","head", $data_array);
        echo $template;

        echo' <ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link" href="index.php?site=profile&amp;id=' . $id . '">' . $_language->module[ 'profile' ] . '</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" href="index.php?site=profile&amp;id=' . $id . '&amp;action=lastposts"> ' . $_language->module[ 'last' ] . ' ' . $profilelast . ' ' . $_language->module[ 'posts' ] . '</a>
  </li>
  
</ul> ';

        $topiclist = "";
        $topics = safe_query(
            "SELECT
                *
            FROM
                " . PREFIX . "plugins_forum_topics
            WHERE
                userID = '" . $id . "' AND
                moveID = 0
            ORDER BY
                date DESC"
        );
        if (mysqli_num_rows($topics)) {
            $n = 1;
            while ($db = mysqli_fetch_array($topics)) {
                if ($db[ 'readgrps' ] != "") {
                    $usergrps = explode(";", $db[ 'readgrps' ]);
                    $usergrp = 0;
                    foreach ($usergrps as $value) {
                        if (isinusergrp($value, $userID)) {
                            $usergrp = 1;
                            break;
                        }
                    }
                    if (!$usergrp && !ismoderator($userID, $db[ 'boardID' ])) {
                        continue;
                    }
                }
                
                $posttime = getformatdatetime($db[ 'date' ]);

                $topiclist .= '<tr><td>
                        <div style="overflow:hidden;">
                            <div class="pull-right"><small>' . $posttime . '</small></div>
                            <a href="index.php?site=forum_topic&amp;topic=' . $db[ 'topicID' ] . '">
                                <strong>' . $db[ 'topic' ] . '</strong>
                            </a><br>
                            <i>' . $db[ 'views' ] . ' ' . $_language->module[ 'views' ] . ' - ' .
                            $db[ 'replys' ] . ' ' . $_language->module[ 'replys' ] . '</i>
                        </div>
                    </td>
                </tr>';

                if ($profilelast == $n) {
                    break;
                }
                $n++;
            }
        } else {
            $topiclist = '<tr><td colspan="2">' . $_language->module[ 'no_topics' ] . '</td></tr>';
        }

        $postlist = "";
        $posts =
            safe_query(
                "SELECT
                    " . PREFIX . "plugins_forum_topics.boardID,
                    " . PREFIX . "plugins_forum_topics.readgrps,
                    " . PREFIX . "plugins_forum_topics.topicID,
                    " . PREFIX . "plugins_forum_topics.topic,
                    " . PREFIX . "plugins_forum_posts.date,
                    " . PREFIX . "plugins_forum_posts.message
                FROM
                    " . PREFIX . "plugins_forum_posts,
                    " . PREFIX . "plugins_forum_topics
                WHERE
                    " . PREFIX . "plugins_forum_posts.poster = '" . $id . "' AND
                    " . PREFIX . "plugins_forum_posts.topicID = " . PREFIX . "plugins_forum_topics.topicID
                ORDER BY date DESC"
            );
        if (mysqli_num_rows($posts)) {
            $n = 1;
            while ($db = mysqli_fetch_array($posts)) {
                if ($db[ 'readgrps' ] != "") {
                    $usergrps = explode(";", $db[ 'readgrps' ]);
                    $usergrp = 0;
                    foreach ($usergrps as $value) {
                        if (isinusergrp($value, $userID)) {
                            $usergrp = 1;
                            break;
                        }
                    }
                    if (!$usergrp && !ismoderator($userID, $db[ 'boardID' ])) {
                        continue;
                    }
                }

               
                $posttime = getformatdatetime($db[ 'date' ]);
                if (mb_strlen($db[ 'message' ]) > 80) {
                    $message = mb_substr(
                        $db[ 'message' ],
                        0,
                        70 + mb_strpos(
                            mb_substr(
                                $db[ 'message' ],
                                70,
                                mb_strlen($db[ 'message' ])
                            ),
                            " "
                        )
                    ) . "...";
                } else {
                    $message = $db[ 'message' ];
                }

                $postlist .= '
                <style>.thumb img { object-fit: contain;
                                    width:50%;
                                    height:auto;
                                }
                </style>

                <tr><td>
                        <div class="thumb">
                        <div class="pull-right"><small>' . $posttime . '</small></div>
                            <a href="index.php?site=forum_topic&amp;topic=' . $db[ 'topicID' ] . '">
                                <strong>' . $db[ 'topic' ] . '</strong>
                            </a><br>
                            <i>' . $message . '</i>
                        </div>
                    </td>
                </tr>';

                if ($profilelast == $n) {
                    break;
                }
                $n++;
            }
        } else {
            $postlist = '<tr><td colspan="2">' . $_language->module[ 'no_posts' ] . '</td></tr>';
        }

        $data_array = array();
        $data_array['$id'] = $id;
        $data_array['$profilelast'] = $profilelast;
        $data_array['$topiclist'] = $topiclist;
        $data_array['$postlist'] = $postlist;

        $data_array['$last_topics'] = $_language->module[ 'last_topics' ];
        $data_array['$last_posts'] = $_language->module[ 'last_posts' ];
        #$profile = $GLOBALS["_template"]->replaceTemplate("profile_lastposts", $data_array);
        #echo $profile;
        $template = $tpl->loadTemplate("profile","lastposts", $data_array);
        echo $template;


} else {
        //profil: home


//profil: home
    
        $data_array = array();
        $data_array['$id'] = $id;
        $data_array['$banned'] = $banned;
        
        $data_array['$profile'] = $_language->module[ 'profile' ];
        $template = $tpl->loadTemplate("profile","head", $data_array);
        echo $template;

        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "plugins WHERE modulname='forum'"));
        if (@$dx[ 'modulname' ] != 'forum') {
        $last_post = '';
        } else {
        $last_post = '<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link active" href="index.php?site=profile&amp;id=' . $id . '">' . $_language->module[ 'profile' ] . '</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="index.php?site=profile&amp;id=' . $id . '&amp;action=lastposts"> ' . $_language->module[ 'last' ] . ' ' . $profilelast . ' ' . $_language->module[ 'posts' ] . '</a>
  </li>
  
</ul>';
        }

        $last_post = $last_post;
    
        $date = time();
        $ergebnis = safe_query("SELECT * FROM " . PREFIX . "user WHERE userID='" . $id . "'");
        $anz = mysqli_num_rows($ergebnis);
        $ds = mysqli_fetch_array($ergebnis);

        if ($userID != $id && $userID != 0) {
            safe_query("UPDATE " . PREFIX . "user SET visits=visits+1 WHERE userID='" . $id . "'");
            if (mysqli_num_rows(
                safe_query(
                    "SELECT
                            visitID
                        FROM
                            " . PREFIX . "user_visitors
                        WHERE
                            userID='" . $id . "' AND
                            visitor='" . (int)$userID."'"
                )
            )
            ) {
                safe_query(
                    "UPDATE
                        " . PREFIX . "user_visitors
                        SET
                            date='" . $date . "'
                        WHERE
                            userID='" . $id . "'AND
                            visitor='" . (int)$userID."'"
                );
            } else {
                safe_query(
                    "INSERT INTO
                        " . PREFIX . "user_visitors (
                            userID,
                            visitor,
                            date
                        )
                        values (
                            '" . $id . "',
                            '" . $userID . "',
                            '" . $date . "'
                        )"
                );
            }
        }
        $anzvisits = $ds[ 'visits' ];

        if ($ds[ 'userpic' ]) {
            $userpic = '<img class="image-responsive img-circle userpic-wh" src="images/userpics/' . $ds[ 'userpic' ] . '" alt="">';
            $profile_bg = '<img class="card-bkimg" src="images/userpics/' . $ds[ 'userpic' ] . '" alt="">';
        } else {
            $userpic = '<img class="image-responsive" src="images/userpics/nouserpic.png" alt="">';
            $profile_bg = '<img class="image-responsive" src="images/userpics/nouserpic.png" alt="">';
        }
        $nickname = $ds[ 'nickname' ];
        if (isclanmember($id)) {
            $member = ' <i class="fa fa-user" style="color: #5cb85c"></i> '.$_language->module[ 'clanmember' ].' ';
        } else {
            $member = '';
        }
        
        $registered = getformatdatetime($ds[ 'registerdate' ]);
        $lastlogin = getformatdatetime($ds[ 'lastlogin' ]);
        
        if ($ds[ 'avatar' ]) {
            $avatar = '<img src="images/avatars/' . $ds[ 'avatar' ] . '" alt="">';
        } else {
            $avatar = '<img src="images/avatars/noavatar.png" alt="">';
        }
        if(isonline($ds[ 'userID' ])=="offline") {
          $status = '<span class="label label-danger">offline</span>';
        } else {
          $status = '<span class="label label-success">online</span>';
        }

        if ($ds[ 'email_hide' ]) {
            $email = $_language->module[ 'n_a' ];
        } else {
            $email = '<a class="label label-danger" href="mailto:' . mail_protect($ds[ 'email' ]) .
                '"><i class="fa fa-envelope" title="' . $_language->module[ 'iemail' ] . '"></i> ' . $_language->module[ 'iemail' ] . '</a>';
        }
        $sem = '/[0-9]{4,11}/si';
        
        if ($loggedin && $ds[ 'userID' ] != $userID) {
            $pm = '<a class="label label-default" href="index.php?site=messenger&amp;action=touser&amp;touser=' . $ds[ 'userID' ] . '">
                <i class="fa fa-envelope" title="' . $_language->module[ 'message' ] . '"></i> ' . $_language->module['message'] . '
            </a>';
            
        } else {
            $pm = '';
        }

        if ($ds['homepage'] != '') {
            if (stristr($ds[ 'homepage' ], "https://")) {
                $homepage = '<a href="' . htmlspecialchars($ds[ 'homepage' ]) . '" target="_blank" rel="nofollow">' . $_language->module[ 'link_homepage' ] . '</a>';//https
            } else {
                $homepage = '<a href="http://' . htmlspecialchars($ds[ 'homepage' ]) . '" target="_blank" rel="nofollow">' . $_language->module[ 'link_homepage' ] . '</a>';//http
            }
        } else {
            $homepage = $_language->module[ 'n_a' ];
        }

        if ($ds[ 'twitch' ] != '') {
            if (stristr($ds[ 'twitch' ], "https://")) {
                $twitch = '<a href="' . htmlspecialchars($ds[ 'twitch' ]) . '" target="_blank" rel="nofollow">' . $_language->module[ 'link_twitch' ] . '</a>';
            } else {
                $twitch = '<a href="http://' . htmlspecialchars($ds[ 'twitch' ]) . '" target="_blank" rel="nofollow">' . $_language->module[ 'link_twitch' ] . '</a>';
            }
        } else {
            $twitch = $_language->module[ 'n_a' ];
        }

        if ($ds[ 'youtube' ] != '') {
            if (stristr($ds[ 'youtube' ], "https://")) {
                $youtube = '<a href="' . htmlspecialchars($ds[ 'youtube' ]) . '" target="_blank" rel="nofollow">' . $_language->module[ 'link_youtube' ] . '</a>';
            } else {
                $youtube = '<a href="http://' . htmlspecialchars($ds[ 'youtube' ]) . '" target="_blank" rel="nofollow">' . $_language->module[ 'link_youtube' ] . '</a>';
            }
        } else {
            $youtube = $_language->module[ 'n_a' ];
        }

        if ($ds[ 'twitter' ] != '') {
            if (stristr($ds[ 'twitter' ], "https://")) {
                $twitter = '<a href="' . htmlspecialchars($ds[ 'twitter' ]) . '" target="_blank" rel="nofollow">' . $_language->module[ 'link_twitter' ] . '</a>';
            } else {
                $twitter = '<a href="http://' . htmlspecialchars($ds[ 'twitter' ]) . '" target="_blank" rel="nofollow">' . $_language->module[ 'link_twitter' ] . '</a>';
            }
        } else {
            $twitter = $_language->module[ 'n_a' ];
        }

        if ($ds[ 'instagram' ] != '') {
            if (stristr($ds[ 'instagram' ], "https://")) {
                $instagram = '<a href="' . htmlspecialchars($ds[ 'instagram' ]) . '" target="_blank" rel="nofollow">' . $_language->module[ 'link_instagram' ] . '</a>';
            } else {
                $instagram = '<a href="http://' . htmlspecialchars($ds[ 'instagram' ]) . '" target="_blank" rel="nofollow">' . $_language->module[ 'link_instagram' ] . '</a>';
            }
        } else {
            $instagram = $_language->module[ 'n_a' ];
        }

        if ($ds[ 'facebook' ] != '') {
            if (stristr($ds[ 'facebook' ], "https://")) {
                $facebook = '<a href="' . htmlspecialchars($ds[ 'facebook' ]) . '" target="_blank" rel="nofollow">' . $_language->module[ 'link_facebook' ] . '</a>';
            } else {
                $facebook = '<a href="http://' . htmlspecialchars($ds[ 'facebook' ]) . '" target="_blank" rel="nofollow">' . $_language->module[ 'link_facebook' ] . '</a>';
            }
        } else {
            $facebook = $_language->module[ 'n_a' ];
        }

        if ($ds[ 'steam' ] != '') {
            if (stristr($ds[ 'steam' ], "https://")) {
                $steam = '<a href="' . htmlspecialchars($ds[ 'steam' ]) . '" target="_blank" rel="nofollow">' . $_language->module[ 'link_steam' ] . '</a>';
            } else {
                $steam = '<a href="http://' . htmlspecialchars($ds[ 'steam' ]) . '" target="_blank" rel="nofollow">' . $_language->module[ 'link_steam' ] . '</a>';
            }
        } else {
            $steam = $_language->module[ 'n_a' ];
        }
        
        $firstname = $ds[ 'firstname' ];
        if ($firstname == '') {
            $firstname = $_language->module[ 'n_a' ];
        }

        $lastname = $ds[ 'lastname' ];
        if ($lastname == '') {
            $lastname = "";
        }

        $birthday = getformatdate(strtotime($ds['birthday']));
        if ($birthday == '30.11.-0001') {
            $birthday = $_language->module[ 'n_a' ];
        }

        if ($lastlogin == '01.01.1970 - 01:00') {
            $lastlogin = $_language->module[ 'n_a' ];
        }

        $res =
            safe_query(
                "SELECT
                    TIMESTAMPDIFF(YEAR, birthday, NOW()) AS age
                FROM
                    " . PREFIX . "user
                WHERE
                    userID = '" . (int)$id."'"
            );
        $cur = mysqli_fetch_array($res);
        
        $birthday = $birthday . " (" . (int)$cur[ 'age' ] . " " . $_language->module[ 'years' ] . ")";

        if ($ds[ 'sex' ] == "f") {
            $sex = $_language->module[ 'female' ];
        } elseif ($ds[ 'sex' ] == "m") {
            $sex = $_language->module[ 'male' ];
        } elseif ($ds[ 'sex' ] == "d") {
            $sex = $_language->module[ 'diverse' ];
        } else {
            $sex = $_language->module[ 'unknown' ];
        }
        
                
        $town = $ds[ 'town' ];
        if ($town == '') {
            $town = $_language->module[ 'n_a' ];
        }

        if ($ds[ 'about' ]) {
            $about = $ds[ 'about' ];

            $translate = new multiLanguage(detectCurrentLanguage());
            $translate->detectLanguages($about);
            $about = $translate->getTextByLanguage($about);
            
        } else {
            $about = $_language->module[ 'n_a' ];
        }

        #----news ----
        function getusernewsposts($userID)
        {
        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "plugins WHERE modulname='news'"));
        if (@$dx[ 'modulname' ] != 'news') {
        $new_posts = '';
        } else {
        return mysqli_num_rows(safe_query("SELECT newsID FROM `" . PREFIX . "plugins_news` WHERE `poster` = " . (int)$userID));
        } 
        }

        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "plugins WHERE modulname='news'"));
        if (@$dx[ 'modulname' ] != 'news') {
        $new_posts = '';
        } else {
        $new_posts = '<tr><th>'.$_language->module[ 'newsposts' ].':</th><td>'.getusernewsposts($ds['userID']).'</td></tr>';
        }

        #----news_comments ----
        function getusernewscomments($userID)
        {
        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "plugins WHERE modulname='news'"));
        if (@$dx[ 'modulname' ] != 'news') {
        '';
        } else {
        return mysqli_num_rows(safe_query("SELECT commentID FROM `" . PREFIX . "plugins_news_comments` WHERE `userID` = " . (int)$userID . " AND `type` = 'ne'"));
        }
        }

        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "plugins WHERE modulname='news'"));
        if (@$dx[ 'modulname' ] != 'news') {
        $news_comments = '';
        } else {
        $news_comments = '<tr><th>'.$_language->module[ 'newscomments' ].':</th><td>'.getusernewscomments($ds['userID']).'</td></tr>';
        }





        #----forumposts ----
        function getuserforumposts($userID)
        {
        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "plugins WHERE modulname='forum'"));
        if (@$dx[ 'modulname' ] != 'forum') {
        '';
        } else {
        return mysqli_num_rows(safe_query("SELECT `postID` FROM `" . PREFIX . "plugins_forum_posts` WHERE `poster` = " . (int)$userID));
        }
        }

        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "plugins WHERE modulname='forum'"));
        if (@$dx[ 'modulname' ] != 'forum') {
        $new_forum_posts = '';
        } else {
        $new_forum_posts = '<tr><th>'.$_language->module[ 'forumposts' ].':</th><td>'.getuserforumposts($ds['userID']).'</td></tr>';
        }

        #----forumtopics ----
        function getuserforumtopics($userID)
        {
        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "plugins WHERE modulname='forum'"));
        if (@$dx[ 'modulname' ] != 'forum') {
        '';
        } else {
        return mysqli_num_rows(safe_query("SELECT `topicID` FROM `" . PREFIX . "plugins_forum_topics` WHERE `userID` = " . (int)$userID));
        }
        }

        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "plugins WHERE modulname='forum'"));
        if (@$dx[ 'modulname' ] != 'forum') {
        $new_forum_topics = '';
        } else {
        $new_forum_topics = '<tr><th>'.$_language->module[ 'forumtopics' ].':</th><td>'.getuserforumtopics($ds['userID']).'</td></tr>';
        }

        

        #----messenger ----
        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "plugins WHERE modulname='messenger'"));
        if (@$dx[ 'modulname' ] != 'messenger') {
        $pm_got = '';
        } else {
        $pm_got = '<tr><th>'.$_language->module[ 'messenger' ].' ('.$_language->module[ 'incoming' ].'):</th><td>'.$ds[ 'pmgot' ].'</td></tr>';
        }

        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "plugins WHERE modulname='messenger'"));
        if (@$dx[ 'modulname' ] != 'messenger') {
        $pm_sent = '';
        } else {
        $pm_sent = '<tr><th>'.$_language->module[ 'messenger' ].' ('.$_language->module[ 'outgoing' ].'):</th><td>'.$ds[ 'pmsent' ].'</td></tr>';
        }

        

        $lastvisits = "";
        $visitors = safe_query(
            "SELECT
                v.*,
                u.nickname
            FROM
                " . PREFIX . "user_visitors v
            JOIN " . PREFIX . "user u ON
                u.userID = v.visitor
            WHERE
                v.userID='" . $id . "'
            ORDER BY
                v.date DESC
                LIMIT 0,5"
        );
        if (mysqli_num_rows($visitors)) {
            $n = 1;
            while ($dv = mysqli_fetch_array($visitors)) {
                
                #$flag = '[flag]' . $dv[ 'country' ] . '[/flag]';
                #$country = flags($flag);
                $nicknamevisitor = $dv[ 'nickname' ];
                if (isonline($dv[ 'visitor' ]) == "offline") {
                    $statuspic = '' . $_language->module[ 'offline' ] . '';
                } else {
                    $statuspic = '' . $_language->module[ 'online' ] . '';
                }
                $time = time();
                $visittime = $dv[ 'date' ];

                $sec = $time - $visittime;
                $days = $sec / 86400;                                // sekunden / (60*60*24)
                $days = mb_substr($days, 0, mb_strpos($days, "."));        // kommastelle

                #$sec = $sec - $days * 86400;
                $hours = $sec / 3600;
                $hours = mb_substr($hours, 0, mb_strpos($hours, "."));

                #$sec = $sec - $hours * 3600;
                $minutes = $sec / 60;
                $minutes = mb_substr($minutes, 0, mb_strpos($minutes, "."));

                if ($time - $visittime < 60) {
                    $now = $_language->module[ 'now' ];
                    $days = "";
                    $hours = "";
                    $minutes = "";
                } else {
                    $now = '';
                    $days == 0 ? $days = "" : $days = $days . 'd';
                    $hours == 0 ? $hours = "" : $hours = $hours . 'h';
                    $minutes == 0 ? $minutes = "" : $minutes = $minutes . 'm';
                }

                $lastvisits .= '<tr>
                <td><a href="index.php?site=profile&amp;id=' . $dv[ 'visitor' ] . '"><b>' .
                    $nicknamevisitor . '</b></a></td>
                <td class="text-right"><small>' . $now . $days . $hours . '</small> ' . $statuspic . '</td>
            </tr>';

                $n++;
            }
        } else {
            $lastvisits = '<tr><td colspan="2">' . $_language->module[ 'no_visits' ] . '</td>
    </tr>';
        }

        $data_array = array();
        $data_array['$id'] = $id;
        $data_array['$userpic'] = $userpic;
        $data_array['$profile_bg'] = $profile_bg;
        $data_array['$nickname'] = $nickname;
        $data_array['$member'] = $member;
        $data_array['$firstname'] = $firstname;
        $data_array['$lastname'] = $lastname;
        $data_array['$sex'] = $sex;
        $data_array['$birthday'] = $birthday;
        $data_array['$town'] = $town;
        $data_array['$status'] = $status;
        $data_array['$registered'] = $registered;
        $data_array['$lastlogin'] = $lastlogin;
        $data_array['$email'] = $email;
        $data_array['$pm'] = $pm;
        $data_array['$homepage'] = $homepage;
        $data_array['$twitch'] = $twitch;
        $data_array['$youtube'] = $youtube;
        $data_array['$twitter'] = $twitter;
        $data_array['$instagram'] = $instagram;
        $data_array['$facebook'] = $facebook;
        $data_array['$steam'] = $steam;
        $data_array['$about'] = $about;
        $data_array['$last_post'] = $last_post;


        $data_array['$anzvisits'] = $anzvisits;
        $data_array['$lastvisits'] = $lastvisits;
        
        $data_array['$new_posts'] = $new_posts;
        $data_array['$news_comments'] = $news_comments;
        $data_array['$new_forum_topics'] = $new_forum_topics;
        $data_array['$new_forum_posts'] = $new_forum_posts;
        $data_array['$pm_got'] = $pm_got;
        $data_array['$pm_sent'] = $pm_sent;
        

        $data_array['$personal_info'] = $_language->module[ 'personal_info' ];
        $data_array['$real_name'] = $_language->module[ 'real_name' ];
        $data_array['$nick_name'] = $_language->module[ 'nickname' ];
        $data_array['$age'] = $_language->module[ 'age' ];
        $data_array['$sexuality'] = $_language->module[ 'sexuality' ];
        $data_array['$location'] = $_language->module[ 'location' ];
        $data_array['$status_on_off'] = $_language->module[ 'status' ];
        $data_array['$last_login'] = $_language->module[ 'last_login' ];
        $data_array['$usertitle'] = $_language->module[ 'usertitle' ];
        $data_array['$home_page'] = $_language->module[ 'homepage' ];
        $data_array['$contact'] = $_language->module[ 'contact' ];
        $data_array['$message'] = $_language->module[ 'message' ];
        $data_array['$iemail'] = $_language->module[ 'iemail' ];
        $data_array['$social_media'] = $_language->module[ 'social-media' ];
        $data_array['$media_twitch'] = $_language->module[ 'twitch' ];
        $data_array['$media_youtube'] = $_language->module[ 'youtube' ];
        $data_array['$media_twitter'] = $_language->module[ 'twitter' ];
        $data_array['$media_instagram'] = $_language->module[ 'instagram' ];
        $data_array['$media_facebook'] = $_language->module[ 'facebook' ];
        $data_array['$media_steam'] = $_language->module[ 'steam' ];
        $data_array['$link_twitch'] = $_language->module[ 'link_twitch' ];
        $data_array['$link_youtube'] = $_language->module[ 'link_youtube' ];
        $data_array['$link_twitter'] = $_language->module[ 'link_twitter' ];
        $data_array['$link_instagram'] = $_language->module[ 'link_instagram' ];
        $data_array['$link_facebook'] = $_language->module[ 'link_facebook' ];
        $data_array['$link_steam'] = $_language->module[ 'link_steam' ];
        $data_array['$link_home_page'] = $_language->module[ 'link_homepage' ];
        $data_array['$media_about'] = $_language->module[ 'about' ];

        $data_array['$latest_visitors'] = $_language->module[ 'latest_visitors' ];
        $data_array['$statistics'] = $_language->module[ 'statistics' ];
        
        $template = $tpl->loadTemplate("profile","content", $data_array);
        echo $template;
    }
} else {

    redirect('index.php', $_language->module[ 'user_doesnt_exist' ], 3);
}