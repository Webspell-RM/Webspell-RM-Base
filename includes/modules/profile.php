<style type="text/css">#icon {
 
  /*background: #333;*/
  
  /*padding: 20px;*/ }

#icon img {
    width: 100px !important;
  /*width: 350px !important; 
  padding-left: 90px !important;*/
   padding-top: 15px;
    -moz-transition: all 0.5s;
    -webkit-transition: all 0.5s;
    transition: all 0.5s;
    -webkit-filter: grayscale(100%);
    /* Chrome, Safari, Opera */
    filter: grayscale(100%);
    
     }
    #icon img:hover {
      -webkit-filter: grayscale(0);
      /* Chrome, Safari, Opera */
      filter: grayscale(0); }


div.gallery {
  margin: 5px;
  border: 0px solid #ccc;
  float: left;
  /*width: 80px;*/
}

div.gallery:hover {
  border: 0px solid #777;
}

div.gallery img {
  width: 100%;
  height: auto;
}

div.desc {
  padding: 15px;
  text-align: center;
}

#border-right {
        border-right: 2px solid rgb(0, 0, 0)
    }

#blue-background {
    background-color: rgba(153,41,226,1)
}
.application {color: #000}  

.profile-team-bg {
    height: 170px;
    min-width: 370px;
    background-position: 50% 50%;
    background-repeat: no-repeat;
    background-size: cover;
    filter: grayscale(100%);
    transition: all 0.4s ease 0s;
}
.profile-team-bg:hover {
    filter: grayscale(0%);
    transition: all 0.4s ease 0s;
}

.profile-team-bg h4 {
   color: #FFF;
   font-size: 18px;
   font-weight: 500;
   margin: 0px !important;
}

.profile-team-bg .top {
   position: absolute;
   top: 0;
   left: 0;
   padding: 10px;
   background: linear-gradient(270deg, rgba(15,15,15,0) 0%, rgba(15,15,15,1) 100%);
}

.profile-team-bg .bottom {
   position: absolute;
   bottom: 0;
   right: 0;
   padding: 10px;
   background: linear-gradient(90deg, rgba(15,15,15,0) 0%, rgba(15,15,15,1) 100%);
}  

</style><?php
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

        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "plugins WHERE modulname='forum'"));
        if (@$dx[ 'modulname' ] != 'forum') {
        $last_post = '';
        } else {
        $last_post = '<li class="nav-item">
    <a class="nav-link active" href="index.php?site=profile&amp;id=' . $id . '&amp;action=lastposts"> ' . $_language->module[ 'last' ] . ' ' . $profilelast . ' ' . $_language->module[ 'posts' ] . '</a>
  </li>';
        }

        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "plugins WHERE modulname='usergallery'"));
        if (@$dx[ 'modulname' ] != 'usergallery') {
        $gallery = '';
        } else {
        $gallery = '<li class="nav-item">
    <a class="nav-link" href="index.php?site=profile&amp;id=' . $id . '&amp;action=galleries"> ' . $_language->module[ 'galleries' ] . '</a>
  </li>';
        }





echo '<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link" href="index.php?site=profile&amp;id=' . $id . '">' . $_language->module[ 'profile' ] . '</a>
  </li>'.$last_post.'
  
        '.$gallery.'
  
</ul>';

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
        
        $template = $tpl->loadTemplate("profile","lastposts", $data_array);
        echo $template;


 } elseif ($action == "galleries") {
        //galleries
        $data_array = array();
        $data_array['$id'] = $id;
        $data_array['$profilelast'] = $profilelast;
        $data_array['$banned'] = $banned;
        
        $data_array['$profile'] = $_language->module[ 'profile' ];
        
        $template = $tpl->loadTemplate("profile","head", $data_array);
        echo $template;

        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "plugins WHERE modulname='forum'"));
        if (@$dx[ 'modulname' ] != 'forum') {
        $last_post = '';
        } else {
        $last_post = '<li class="nav-item">
    <a class="nav-link" href="index.php?site=profile&amp;id=' . $id . '&amp;action=lastposts"> ' . $_language->module[ 'last' ] . ' ' . $profilelast . ' ' . $_language->module[ 'posts' ] . '</a>
  </li>';
        }

        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "plugins WHERE modulname='usergallery'"));
        if (@$dx[ 'modulname' ] != 'usergallery') {
        $gallery = '';
        } else {
        $gallery = '<li class="nav-item">
    <a class="nav-link active" href="index.php?site=profile&amp;id=' . $id . '&amp;action=galleries"> ' . $_language->module[ 'galleries' ] . '</a>
  </li>';
        }





echo '<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link" href="index.php?site=profile&amp;id=' . $id . '">' . $_language->module[ 'profile' ] . '</a>
  </li>'.$last_post.'
  
        '.$gallery.'
  
</ul>';

// -- NEWS INFORMATION -- //
include_once("./includes/plugins/gallery/gallery_functions.php");

        $galclass = new \webspell\Gallery;

        $galleries = safe_query("SELECT * FROM " . PREFIX . "plugins_gallery WHERE userID='" . $id . "'");

        echo '<div class="card">
  <div class="card-body">
' . $_language->module[ 'galleries' ] . ' ' . $_language->module[ 'by' ] . ' ' . getnickname($id) . '
<table class="table">
        <tr>
            <td></td>
            <td><strong>' . $_language->module[ 'date' ] . '</strong></td>
            <td><strong>' . $_language->module[ 'name' ] . '</strong></td>
            <td><strong>' . $_language->module[ 'pictures' ] . '</strong></td>
        </tr>';

        
            if (mysqli_num_rows($galleries)) {
                $n = 1;
                while ($ds = mysqli_fetch_array($galleries)) {
                    
                    $piccount =
                        mysqli_num_rows(
                            safe_query(
                                "SELECT
                                    *
                                FROM
                                    " . PREFIX . "plugins_gallery_pictures
                                WHERE
                                    galleryID='" . (int)$ds[ 'galleryID' ]."'"
                            )
                        );
                    /*$commentcount = mysqli_num_rows(
                        safe_query(
                            "SELECT
                                *
                            FROM
                                " . PREFIX . "comments
                            WHERE
                                parentID='" . $ds[ 'galleryID' ] . "' AND
                                type='ga'"
                        )
                    );*/
                    
                    $ds[ 'count' ] =
                        mysqli_num_rows(
                            safe_query(
                                "SELECT
                                    `picID`
                                FROM
                                    `" . PREFIX . "plugins_gallery_pictures`
                                WHERE
                                    `galleryID` = '" . (int)$ds[ 'galleryID' ] . "'"
                            )
                        );
                    
                    if (isset($ds[ 'date' ])) {
                    $ds[ 'date' ] = date('d.m.Y', $ds[ 'date' ]);
                    }

                    $data_array = array();
                    $data_array['$date'] = $ds[ 'date' ];
                    $data_array['$picID'] = $galclass->randomPic($ds[ 'galleryID' ]);
                    $data_array['$galleryID'] = $ds[ 'galleryID' ];
                    $data_array['$title'] = $ds[ 'name' ];
                    $data_array['$count'] = $ds[ 'count' ];
                    $data_array['$id'] = $id;
                    $data_array['$profilelast'] = $profilelast;
                    
                    $template = $tpl->loadTemplate("profile","galleries", $data_array);
                    echo $template;

                    $n++;
                }
            } else {
                echo '<tr><td colspan="4">' . $_language->module[ 'no_galleries' ] . '</td></tr>';
            }
        

echo'</table></div></div>';



} else {
        //profil: home

        $data_array = array();
        $data_array['$id'] = $id;
        $data_array['$profilelast'] = $profilelast;
        $data_array['$banned'] = $banned;
        
        $data_array['$profile'] = $_language->module[ 'profile' ];
        $template = $tpl->loadTemplate("profile","head", $data_array);
        echo $template;

        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "plugins WHERE modulname='forum'"));
        if (@$dx[ 'modulname' ] != 'forum') {
        $last_post = '';
        } else {
        $last_post = '<li class="nav-item">
    <a class="nav-link" href="index.php?site=profile&amp;id=' . $id . '&amp;action=lastposts"> ' . $_language->module[ 'last' ] . ' ' . $profilelast . ' ' . $_language->module[ 'posts' ] . '</a>
  </li>';
        }

        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "plugins WHERE modulname='usergallery'"));
        if (@$dx[ 'modulname' ] != 'usergallery') {
        $gallery = '';
        } else {
        $gallery = '<li class="nav-item">
    <a class="nav-link" href="index.php?site=profile&amp;id=' . $id . '&amp;action=galleries"> ' . $_language->module[ 'galleries' ] . '</a>
  </li>';
        }





echo '<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link active" href="index.php?site=profile&amp;id=' . $id . '">' . $_language->module[ 'profile' ] . '</a>
  </li>'.$last_post.'
  
        '.$gallery.'
  
</ul>';

        
    
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

        $id = $ds[ 'userID' ];

        if ($getuserpic = getuserpic($id)) {
            $userpic = '<img style="width: 250px;height: 250px;border-radius: 100%; vertical-align:middle;" class="img-fluid rounded-circle" src="images/userpics/' . $getuserpic . '" alt="">';
        } else {
            $userpic = '';
        }

        
        $nickname = $ds[ 'nickname' ];
        if (isclanmember($id)) {
            $member = ' <i class="fa fa-user" style="color: #5cb85c"></i> '.$_language->module[ 'clanmember' ].' ';
        } else {
            $member = '';
        }
        
        $registerdate = getformatdatetime($ds[ 'registerdate' ]);
        $lastlogin = getformatdatetime($ds[ 'lastlogin' ]);
        
        if(isonline($ds[ 'userID' ])=="offline") {
          $status = '<span class="badge bg-danger">offline</span>';
        } else {
          $status = '<span class="badge bg-success">online</span>';
        }

        if ($ds[ 'email_hide' ]) {
            $email = $_language->module[ 'n_a' ];
        } else {
            $email = '<a href="mailto:' . mail_protect($ds[ 'email' ]) .
                '"><i class="fas fa-at fa-2x"></i></a>';
        }
        $sem = '/[0-9]{4,11}/si';
        
        if ($loggedin && $ds[ 'userID' ] != $userID) {
            $pm = '<a href="index.php?site=messenger&amp;action=touser&amp;touser=' . $ds[ 'userID' ] . '">
                <i class="fas fa-comment fa-2x"></i></a>';
            
        } else {
            $pm = $_language->module[ 'n_a' ];
        }


        if ($ds['homepage'] != '') {
            if (stristr($ds[ 'homepage' ], "https://")) {
                $homepage = '<a href="' . htmlspecialchars($ds[ 'homepage' ]) . '" target="_blank" rel="nofollow"><i class="fas fa-globe-europe fa-2x"></i></a>';//https
            } else {
                $homepage = '<a href="http://' . htmlspecialchars($ds[ 'homepage' ]) . '" target="_blank" rel="nofollow"><i class="fas fa-globe-europe fa-2x"></i></a>';//http
            }
        } else {
            $homepage = $_language->module[ 'n_a' ];
        }

        if ($ds[ 'twitch' ] != '') {
            if (stristr($ds[ 'twitch' ], "https://")) {
                $twitch = '<a href="' . htmlspecialchars($ds[ 'twitch' ]) . '" target="_blank" rel="nofollow"><i class="fab fa-twitch fa-3x"></i></a>';
            } else {
                $twitch = '<a href="http://' . htmlspecialchars($ds[ 'twitch' ]) . '" target="_blank" rel="nofollow"><i class="fab fa-twitch fa-3x"></i></a>';
            }
        } else {
            $twitch = '';
        }

        if ($ds[ 'youtube' ] != '') {
            if (stristr($ds[ 'youtube' ], "https://")) {
                $youtube = '<a href="' . htmlspecialchars($ds[ 'youtube' ]) . '" target="_blank" rel="nofollow"><i class="fab fa-youtube fa-3x"></i></a>';
            } else {
                $youtube = '<a href="http://' . htmlspecialchars($ds[ 'youtube' ]) . '" target="_blank" rel="nofollow"><i class="fab fa-youtube fa-3x"></i></a>';
            }
        } else {
            $youtube = '';
        }

        if ($ds[ 'twitter' ] != '') {
            if (stristr($ds[ 'twitter' ], "https://")) {
                $twitter = '<a href="' . htmlspecialchars($ds[ 'twitter' ]) . '" target="_blank" rel="nofollow"><i class="fab fa-twitter-square fa-3x"></i></a>';
            } else {
                $twitter = '<a href="http://' . htmlspecialchars($ds[ 'twitter' ]) . '" target="_blank" rel="nofollow"><i class="fab fa-twitter-square fa-3x"></i></a>';
            }
        } else {
            $twitter = '';
        }

        if ($ds[ 'instagram' ] != '') {
            if (stristr($ds[ 'instagram' ], "https://")) {
                $instagram = '<a href="' . htmlspecialchars($ds[ 'instagram' ]) . '" target="_blank" rel="nofollow"><i class="fab fa-instagram fa-3x"></i></a>';
            } else {
                $instagram = '<a href="http://' . htmlspecialchars($ds[ 'instagram' ]) . '" target="_blank" rel="nofollow"><i class="fab fa-instagram fa-3x"></i></a>';
            }
        } else {
            $instagram = '';
        }

        if ($ds[ 'facebook' ] != '') {
            if (stristr($ds[ 'facebook' ], "https://")) {
                $facebook = '<a href="' . htmlspecialchars($ds[ 'facebook' ]) . '" target="_blank" rel="nofollow"><i class="fab fa-facebook-square fa-3x"></i></a>';
            } else {
                $facebook = '<a href="http://' . htmlspecialchars($ds[ 'facebook' ]) . '" target="_blank" rel="nofollow"><i class="fab fa-facebook-square fa-3x"></i></a>';
            }
        } else {
            $facebook = '';
        }

        if ($ds[ 'steam' ] != '') {
            if (stristr($ds[ 'steam' ], "https://")) {
                $steam = '<a href="' . htmlspecialchars($ds[ 'steam' ]) . '" target="_blank" rel="nofollow"><i class="fab fa-steam fa-3x"></i></a>';
            } else {
                $steam = '<a href="http://' . htmlspecialchars($ds[ 'steam' ]) . '" target="_blank" rel="nofollow"><i class="fab fa-steam fa-3x"></i></a>';
            }
        } else {
            $steam = '';
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
        $new_forum_posts = '<i  class="application fas fa-times"></i>';
        } else {
        $new_forum_posts = getuserforumposts($ds['userID']);
        }





        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "plugins WHERE modulname='forum'"));
        if (@$dx[ 'modulname' ] != 'forum') {
        $usertype = '';
        $rang = $_language->module[ 'n_a' ];
        $specialrank = '';
        } else {
        
        if (isforumadmin($ds[ 'userID' ])) {
            $usertype = $_language->module[ 'administrator' ];
            $rang = '<img src="/includes/plugins/forum/images/icons/ranks/admin.png" alt="">';
        } elseif (isanymoderator($ds[ 'userID' ])) {
            $usertype = $_language->module[ 'moderator' ];
            $rang = '<img src="/includes/plugins/forum/images/icons/ranks/moderator.png" alt="">';
        } else {
            $posts = getuserforumposts($ds[ 'userID' ]);
            
            $ergebnis =
                safe_query(
                    "SELECT
                        *
                    FROM
                        " . PREFIX . "plugins_forum_ranks
                    WHERE
                        " . $posts . " >= postmin AND
                        " . $posts . " <= postmax AND
                        postmax > 0 AND
                        special='0'"
                );
            $dt = mysqli_fetch_array($ergebnis);
            $usertype = $dt[ 'rank' ];
            $rang = '<img src="/includes/plugins/forum/images/icons/ranks/' . $dt[ 'pic' ] . '" alt="">';
        }

        $specialrank = '';
        $getrank = safe_query(
            "SELECT IF
                (u.special_rank = 0, 0, CONCAT_WS('__', r.rank, r.pic)) as RANK
            FROM
                " . PREFIX . "user u LEFT JOIN " . PREFIX . "plugins_forum_ranks r ON u.special_rank = r.rankID
            WHERE
                userID='" . $ds[ 'userID' ] . "'"
        );
        $rank_data = mysqli_fetch_assoc($getrank);

        if ($rank_data[ 'RANK' ] != '0') {
            $specialrank  = '<br/>';
            $tmp_rank = explode("__", $rank_data[ 'RANK' ], 2);
            $specialrank .= $tmp_rank[0];
            if (!empty($tmp_rank[1]) && file_exists("/includes/plugins/forum/images/icons/ranks/" . $tmp_rank[1])) {
                $specialrank .= '<br/>';
                $specialrank .= "<img src='/includes/plugins/forum/images/icons/ranks/" . $tmp_rank[1] . "' alt = '' />";
            }
        }


        }
        /*-----------game images --------------*/

        $games = "";   

        if (!empty($ds[ 'games' ])) {
            $array = unserialize($ds[ 'games' ]);
            $n = 1;
            foreach ($array as $id) {
                if (!empty($id)) {
                    if ($n > 1) {
                        $games .= '<img id="icon" style="width: 100%; max-width: 150px;" class="img-fluid" src="images/games/'.$id.'.png" alt="">';
                    } else {
                        $games .= '<img id="icon" style="width: 100%; max-width: 150px;" class="img-fluid" src="images/games/'.$id.'.png" alt="">';
                    }
                    $n++;
                }
            }
        } else {
            $games .= $_language->module[ 'n_a' ];
        }

        /*-----------game images END--------------*/

        /*-----------squad images --------------*/


        $banner = ""; 

        $ergebnis = safe_query("SELECT * FROM " . PREFIX . "squads_members WHERE userID='".$ds['userID']."' ORDER BY sort");

        while ($dd = mysqli_fetch_array($ergebnis)) {
            $team = $dd[ 'squadID' ];
            $position = $dd[ 'position' ];

            $settings = safe_query("SELECT * FROM " . PREFIX . "squads WHERE squadID='".$team."' ORDER BY sort");
            while ($df = mysqli_fetch_array($settings)) {
            $pic = $df[ 'icon' ];
            $name = $df[ 'name' ];

                if (!empty($ds[ 'userID' ])) {
                
                $banner .= '<a href="index.php?site=squads&amp;action=show&amp;squadID=' . $dd[ 'squadID' ] .
                    '">
                    <div style="margin: 5px;">
                      <div class="profile-team-bg col-md-3" style="background-image: url(images/squadicons/' . $pic . ')">
                         <h4 class="top">' . $name . '</h4>
                         <h4 class="bottom">' . $position . '</h4>
                      </div>
                   </div>
                   </a>';

                } else {
                $banner .= $_language->module[ 'n_a' ];
                }

            }
            
        }
        /*-----------squad images END--------------*/ 




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
        $new_posts = '<i  class="application fas fa-times"></i>';
        } else {
        $new_posts = getusernewsposts($ds['userID']);
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
        $news_comments = '<i  class="application fas fa-times"></i>';
        } else {
        $news_comments = getusernewscomments($ds['userID']);
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
        $new_forum_topics = '<i  class="application fas fa-times"></i>';
        } else {
        $new_forum_topics = getuserforumtopics($ds['userID']);
        }

        

        #----messenger ----
        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "plugins WHERE modulname='messenger'"));
        if (@$dx[ 'modulname' ] != 'messenger') {
        $pm_got = '<i  class="application fas fa-times"></i>';
        } else {
        $pm_got = $ds[ 'pmgot' ];
        }

        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "plugins WHERE modulname='messenger'"));
        if (@$dx[ 'modulname' ] != 'messenger') {
        $pm_sent = '<i  class="application fas fa-times"></i>';
        } else {
        $pm_sent = $ds[ 'pmsent' ];
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
                
                $nicknamevisitor = $dv[ 'nickname' ];
                if (isonline($dv[ 'visitor' ]) == "offline") {
                    $statuspic = '<small>' . $_language->module[ 'offline' ] . '</small>';
                } else {
                    $statuspic = '<small>' . $_language->module[ 'online' ] . '</small>';
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
                <td><a href="index.php?site=profile&amp;id=' . $dv[ 'visitor' ] . '">' .
                    $nicknamevisitor . '</a></td>
                <td class="text-right"><small>' . $now . $days . $hours . '</small> ' . $statuspic . '</td>
            </tr>';

                $n++;
            }
        } else {
            $lastvisits = '<tr><td colspan="2">' . $_language->module[ 'no_visits' ] . '</td></tr>';
        }


        $data_array = array();
        $data_array['$id'] = $id;
        $data_array['$userpic'] = $userpic;
        $data_array['$nickname'] = $nickname;
        $data_array['$member'] = $member;
        $data_array['$firstname'] = $firstname;
        $data_array['$lastname'] = $lastname;
        $data_array['$sex'] = $sex;
        $data_array['$birthday'] = $birthday;
        $data_array['$town'] = $town;
        $data_array['$status'] = $status;
        $data_array['$registerdate'] = $registerdate;
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
        $data_array['$games'] = $games;
        $data_array['$usertype'] = $usertype;
        $data_array['$rang'] = $rang;
        $data_array['$specialrank'] = $specialrank;
        $data_array['$banner'] = $banner;
        
        $data_array['$anzvisits'] = $anzvisits;
        $data_array['$lastvisits'] = $lastvisits;
        $data_array['$new_posts'] = $new_posts;
        $data_array['$news_comments'] = $news_comments;
        $data_array['$new_forum_topics'] = $new_forum_topics;
        $data_array['$new_forum_posts'] = $new_forum_posts;
        $data_array['$pm_got'] = $pm_got;
        $data_array['$pm_sent'] = $pm_sent;
        $data_array['$about'] = $about;


        $data_array['$personal_info'] = $_language->module[ 'personal_info' ];
        $data_array['$real_name'] = $_language->module[ 'real_name' ];
        $data_array['$nick_name'] = $_language->module[ 'nickname' ];
        $data_array['$age'] = $_language->module[ 'age' ];
        $data_array['$sexuality'] = $_language->module[ 'sexuality' ];
        $data_array['$location'] = $_language->module[ 'location' ];
        $data_array['$status_on_off'] = $_language->module[ 'status' ];
        $data_array['$last_login'] = $_language->module[ 'last_login' ];
        $data_array['$registered'] = $_language->module[ 'registered' ];
        $data_array['$usertitle'] = $_language->module[ 'usertitle' ];
        $data_array['$contact'] = $_language->module[ 'contact' ];
        $data_array['$message'] = $_language->module[ 'message' ];
        $data_array['$iemail'] = $_language->module[ 'iemail' ];

        $data_array['$social_media'] = $_language->module[ 'social-media' ];
        $data_array['$lang_homepage'] = $_language->module[ 'homepage' ];
        $data_array['$media_about'] = $_language->module[ 'about' ];
        $data_array['$newsposts'] = $_language->module[ 'newsposts' ];
        $data_array['$newscomments'] = $_language->module[ 'newscomments' ];
        $data_array['$forumtopics'] = $_language->module[ 'forumtopics' ];
        $data_array['$forumposts'] = $_language->module[ 'forumposts' ];
        $data_array['$messenger'] = $_language->module[ 'messenger' ];
        $data_array['$incoming'] = $_language->module[ 'incoming' ];
        $data_array['$outgoing'] = $_language->module[ 'outgoing' ];
        $data_array['$actions'] = $_language->module[ 'actions' ];
        
        $data_array['$latest_visitors'] = $_language->module[ 'latest_visitors' ];
        $data_array['$statistics'] = $_language->module[ 'statistics' ];
        
        $template = $tpl->loadTemplate("profile","content", $data_array);
        echo $template;
     
} 
} else {
    redirect('index.php', $_language->module[ 'user_doesnt_exist' ], 3);
}

