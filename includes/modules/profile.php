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


    //profil: last posts

        echo'<div class="modal fade" id="exampleModallast" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title fs-5" id="exampleModalLabel">' . $_language->module[ 'last' ] . ' ' . $profilelast . '  ' . $_language->module[ 'posts' ] . '   ' . $_language->module[ 'from' ] . ' '.getnickname($id).'</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="' . $_language->module[ 'close' ] . '"></button>
              </div>
              <div class="modal-body">
        ';

        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='forum'"));
        if (@$dx[ 'modulname' ] != 'forum') {
        
        } else { 

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

                $topiclist .= '
                <tr>
                    <td>
                        <div class="thumb">
                            <div class="pull-right"><small>' . $posttime . '</small></div>
                            <a href="index.php?site=forum_topic&amp;topic=' . $db[ 'topicID' ] . '">
                                <strong>' . $db[ 'topic' ] . '</strong>
                            </a><br>
                            <i>' . $db[ 'views' ] . ' ' . $_language->module[ 'views' ] . ' - ' . $db[ 'replys' ] . ' ' . $_language->module[ 'replys' ] . '</i>
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

                <tr>
                    <td>
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

        }

        echo'</div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">' . $_language->module[ 'close' ] . '</button>
              </div>
            </div>
          </div>
        </div>
        ';

//galleries
        echo'<div class="modal fade" id="exampleModalgall" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title fs-5" id="exampleModalLabel">' . $_language->module[ 'last' ] . ' ' . $profilelast . '  ' . $_language->module[ 'posts' ] . '   ' . $_language->module[ 'from' ] . ' '.getnickname($id).'</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="' . $_language->module[ 'close' ] . '"></button>
              </div>
              <div class="modal-body">

        '; 

        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='gallery'"));
        if (@$dx[ 'modulname' ] != 'gallery') {
        
        } else {       

        // -- NEWS INFORMATION -- //
        include_once("./includes/plugins/gallery/gallery_functions.php");

        $galclass = new \webspell\Gallery;

        $galleries = safe_query("SELECT * FROM " . PREFIX . "plugins_gallery WHERE userID='" . $id . "'");

        
        
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
                $dx[ 'count' ] =
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
                    
                $date = getformatdatetime($ds[ 'date' ]);

                $title = $ds[ 'name' ];
                $galleryID = $ds[ 'galleryID' ];

                if ( $dx['count'] == 0 ) { 
                    $picture = '<img src="./includes/plugins/gallery/icons/no-image.jpg">
                        <span>
                        <b><a href="index.php?site=gallery&amp;galleryID='.$galleryID.'">'.$title.'</a></b>
                        <b>'.$_language->module[ 'pictures' ].':</b> '.$dx[ 'count' ].'<br>
                        <b>'.$_language->module[ 'date' ].':</b> '.$date.'
                        </span>';
                }else{            
                    $randomPic = $galclass->randomPic($galleryID);
                    $picture = '<a href="index.php?site=gallery&amp;picID='.$randomPic.'">
                        <img class="img-fluid gallery" src="/includes/plugins/gallery/images/thumb/'.$randomPic.'.jpg" alt="Picture"></a>
                        <span>
                        <b><a href="index.php?site=gallery&amp;galleryID='.$galleryID.'">'.$title.'</a></b> 
                        <b>'.$_language->module[ 'pictures' ].':</b> '.$dx[ 'count' ].'<br>
                        <b>'.$_language->module[ 'date' ].':</b> '.$date.'
                        </span>';
                }                
                
                $data_array = array();
                $data_array['$picture'] = $picture;
                $data_array['$id'] = $id;
                $data_array['$profilelast'] = $profilelast;
                $data_array['$lang_pictures'] = $_language->module[ 'pictures' ];        
                
                $template = $tpl->loadTemplate("profile","galleries", $data_array);
                echo $template;
                $n++;
            }
        } else {
            echo '<div>' . $_language->module[ 'no_galleries' ] . '</div>';
        }
        
    }    
           
        echo'</div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">' . $_language->module[ 'close' ] . '</button>
              </div>
            </div>
          </div>
        </div>
        ';

    //galleries
        echo'<div class="modal fade" id="exampleModalaward" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title fs-5" id="exampleModalLabel">' . $_language->module[ 'awardslist' ] . '</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="' . $_language->module[ 'close' ] . '"></button>
              </div>
              <div class="modal-body">
        ';    
        
        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='useraward'"));
        if (@$dx[ 'modulname' ] != 'useraward') {
        
        } else { 

        $us = mysqli_num_rows(safe_query("SELECT userID FROM ".PREFIX."user"));
        $pm3 = mysqli_num_rows(safe_query("SELECT userID FROM ".PREFIX."user WHERE pmsent>='500'"));
        $pm2 = mysqli_num_rows(safe_query("SELECT userID FROM ".PREFIX."user WHERE pmsent>='250'"));
        $pm1 = mysqli_num_rows(safe_query("SELECT userID FROM ".PREFIX."user WHERE pmsent>='100'"));
        $percpm3 = round($pm3/$us*100, 4);
        $percpm2 = round($pm2/$us*100, 4);
        $percpm1 = round($pm1/$us*100, 4);


        function getawtime($id) {
            $ds1 = mysqli_fetch_array(safe_query("SELECT * FROM ".PREFIX."plugins_user_award_list WHERE uawardID = '$id'"));
            return $ds1['awardrequire'];
        }
        $translate = new multiLanguage(detectCurrentLanguage());

        //$aktuell = strtotime(time());
        $aktuell = strtotime("now");
        $membertime4 = $aktuell - (getawtime('10') * 86400);
        $membertime3 = $aktuell - (getawtime('9') * 86400);
        $membertime2 = $aktuell - (getawtime('8') * 86400);
        $membertime1 = $aktuell - (getawtime('7') * 86400);



        $member4 = mysqli_num_rows(safe_query("SELECT userID FROM ".PREFIX."user WHERE registerdate<='".$membertime4."'"));
        $member3 = mysqli_num_rows(safe_query("SELECT userID FROM ".PREFIX."user WHERE registerdate<='".$membertime3."'"));
        $member2 = mysqli_num_rows(safe_query("SELECT userID FROM ".PREFIX."user WHERE registerdate<='".$membertime2."'"));
        $member1 = mysqli_num_rows(safe_query("SELECT userID FROM ".PREFIX."user WHERE registerdate<='".$membertime1."'"));
        $percmember4 = round($member4/$us*100, 4);
        $percmember3 = round($member3/$us*100, 4);
        $percmember2 = round($member2/$us*100, 4);
        $percmember1 = round($member1/$us*100, 4);

        echo '
            <!--<div class="card">
                <div class="card-body">-->
                    <div class="row">
        ';
		
		
        $awardselect=safe_query("SELECT * FROM ".PREFIX."plugins_user_award_list ORDER BY uawardID");
        while($df=mysqli_fetch_array($awardselect)){
            $anz= mysqli_num_rows(safe_query("SELECT uwID FROM ".PREFIX."plugins_user_award WHERE awardID='".$df['uawardID']."'"));
            $perc=$anz/$us*100;
            $percentage=round($perc, 4);
            $pfad = '';
            if($df['awardrequirepoints'] == '-1') {
                $pfad = 'special/';
            }	
            $translate->detectLanguages($df['info']);
            $infolg = $translate->getTextByLanguage($df['info']);
            $translate->detectLanguages($df['name']);
            $namelg = $translate->getTextByLanguage($df['name']);

	    echo '
                        <div class="col-sm-6">
                            <div class="panel panel-default">
                                <table class="table">
                                    <tr>
                                        <td align="left" width="200">
                                            <img src="includes/plugins/useraward/images/userawards/awards_left.png" width="40" height="100" border="0" align="left" />
                                            <img src="includes/plugins/useraward/images/userawards/'.$pfad.''.$df['image'].'" data-toggle="tooltip" data-placement="bottom" height="100" border="0" title="'.$namelg.'" align="left" />
                                            <img src="includes/plugins/useraward/images/userawards/awards_right.png" width="40" height="100" border="0" align="left" />
                                        </td>
                                        <td align="left">
                                            <b>'.$namelg.'</b><br />'.$infolg.'<br /><b>'.$anz.'</b> '.$_language->module[ 'times_awarded' ].' <b>'.$percentage.'%</b> '.$_language->module[ 'awardtotal' ].')
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
            ';
        }
        echo '</div>';
    }
        echo'</div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">' . $_language->module[ 'close' ] . '</button>
              </div>
            </div>
          </div>
        </div>
        ';        

        //profil: home

        $data_array = array();
        $data_array['$id'] = $id;
        $data_array['$profilelast'] = $profilelast;
        $data_array['$banned'] = $banned;
        
        $data_array['$title'] = $_language->module[ 'profile' ];
        $data_array['$subtitle']='Profil';
        $template = $tpl->loadTemplate("profile","head", $data_array);
        echo $template;

        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='forum'"));
        if (@$dx[ 'modulname' ] != 'forum') {
        $last_post = '';
        } else {
        $last_post = '
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="modal" data-bs-target="#exampleModallast" href="index.php?site=profile"> ' . $_language->module[ 'last' ] . ' ' . $profilelast . ' ' . $_language->module[ 'posts' ] . '</a>
            </li>';
        }

        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='gallery'"));
        if (@$dx[ 'modulname' ] != 'gallery') {
        $gallery = '';
        $gallery_link = '';
        } else {
        $gallery_link = '
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="modal" data-bs-target="#exampleModalgall" href="index.php?site=profile"> ' . $_language->module[ 'galleries' ] . '</a>
            </li>';
        }

        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='useraward'"));
        if (@$dx[ 'modulname' ] != 'useraward') {
          $user_award_list = '';
        } else {
          $user_award_list = '
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="modal" data-bs-target="#exampleModalaward" href="index.php?site=profile"> ' . $_language->module[ 'awardslist' ] . '</a>
            </li>
          ';
        }

        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='useraward'"));
        if (@$dx[ 'modulname' ] != 'useraward') {
            $user_award_link = '';
        } else {
            $user_award_link = '
            <li class="nav-item">
                <a class="nav-link" id="awards-tab" data-bs-toggle="tab" href="#awards" role="tab" aria-controls="awards" aria-selected="false"> '.$_language->module[ 'headaward' ].'</a>
            </li>';
        }  
    
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
                            visitor='" . $userID."'"
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
                            visitor='" . $userID."'"
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
            $userpic = '<img class="userpic" src="images/userpics/' . $getuserpic . '" alt="">';
        } else {
            $userpic = '';
        }

        
        $nickname = $ds[ 'nickname' ];

        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='squads'"));
        if (@$dx[ 'modulname' ] != 'squads') {    
            $member = '';
            $squad_link = '';
        } else {
            if (isclanmember($id)) {
                $member = ' (<i class="bi bi-person" style="color: #5cb85c"></i> '.$_language->module[ 'clanmember' ].') ';
                $squad_link = '<li class="nav-item">
                                    <a class="nav-link" id="squad-tab" data-bs-toggle="tab" href="#squad" role="tab" aria-controls="squad" aria-selected="false">'.$_language->module[ 'squad' ].'</a>
                                </li>';
            } else {
                $member = '';
                $squad_link = '';
            }
            
        }

        $registerdate = getformatdatetime($ds[ 'registerdate' ]);
        $lastlogin = getformatdatetime($ds[ 'lastlogin' ]);
        
        if(isonline($ds[ 'userID' ])=="offline") {
          $status = '<span class="badge bg-danger">offline</span>';
        } else {
          $status = '<span class="badge bg-success">online</span>';
        }

        if ($ds[ 'email_hide' ]) {
            $email = '';
        } else {
            $email = '<td><a href="mailto:' . mail_protect($ds[ 'email' ]) .
                '"><i class="bi bi-envelope"></i> eMail</a></td>';
        }
        $sem = '/[0-9]{4,11}/si';

        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='messenger'"));
        if (@$dx[ 'modulname' ] != 'messenger') {
        
            $pm = '';


        } else {
            $pm = '';

            if ($loggedin && $ds[ 'userID' ] != $userID) {
                $pm = '<td><a href="index.php?site=messenger&amp;action=touser&amp;touser=' . $ds[ 'userID' ] . '"><i class="bi bi-messenger"></i> PM</a></td>';            
            } else {
                $pm = '';
            }
        }

        if ($ds[ 'discord' ]) {            
            $discord = '<a><i class="bi bi-discord discord" style="font-size: 1.5rem;">'.$ds[ 'discord' ].'</i></a>';
        } else {
            $discord = '';        
        }


        if ($ds['homepage'] != '') {
            if (stristr($ds[ 'homepage' ], "https://")) {
            //https
                $homepage = '<a class="homepage" href="' . htmlspecialchars($ds[ 'homepage' ]) . '" target="_blank" rel="nofollow"><i class="bi bi-house" style="font-size: 1.5rem;">Homepage</i></a>';
            } else {
            //http
                $homepage = '<a class="homepage" href="http://' . htmlspecialchars($ds[ 'homepage' ]) . '" target="_blank" rel="nofollow"><i class="bi bi-house" style="font-size: 1.5rem;">Homepage</i></a>';
            }
        } else {
            $homepage = '';
        }

        if ($ds[ 'twitch' ] != '') {
            if (stristr($ds[ 'twitch' ], "https://")) {
                $twitch = '<a class="twitch" href="' . htmlspecialchars($ds[ 'twitch' ]) . '" target="_blank" rel="nofollow"><i class="bi bi-twitch" style="font-size: 1.5rem;"><br>Twitch</i></a>&nbsp;&nbsp;';
            } else {
                $twitch = '<a class="twitch" href="http://' . htmlspecialchars($ds[ 'twitch' ]) . '" target="_blank" rel="nofollow"><i class="bi bi-twitch" style="font-size: 1.5rem;">Twitch</i></a>&nbsp;&nbsp;';
            }
        } else {
            $twitch = '';
        }

        if ($ds[ 'youtube' ] != '') {
            if (stristr($ds[ 'youtube' ], "https://")) {
                $youtube = '<a class="youtube" href="' . htmlspecialchars($ds[ 'youtube' ]) . '" target="_blank" rel="nofollow"><i class="bi bi-youtube" style="font-size: 1.5rem;">YouTube</i></a>&nbsp;&nbsp;';
            } else {
                $youtube = '<a class="youtube" href="http://' . htmlspecialchars($ds[ 'youtube' ]) . '" target="_blank" rel="nofollow"><i class="bi bi-youtube" style="font-size: 1.5rem;">YouTube</i></a>&nbsp;&nbsp;';
            }
        } else {
            $youtube = '';
        }

        if ($ds[ 'twitter' ] != '') {
            if (stristr($ds[ 'twitter' ], "https://")) {
                $twitter = '<a class="twitter" href="' . htmlspecialchars($ds[ 'twitter' ]) . '" target="_blank" rel="nofollow"><i class="bi bi-twitter-x" style="font-size: 1.5rem;">Twitter</i></a>&nbsp;&nbsp;';
            } else {
                $twitter = '<a class="twitter" href="http://' . htmlspecialchars($ds[ 'twitter' ]) . '" target="_blank" rel="nofollow"><i class="bi bi-twitter-x" style="font-size: 1.5rem;">Twitter</i></a>&nbsp;&nbsp;';
            }
        } else {
            $twitter = '';
        }

        if ($ds[ 'instagram' ] != '') {
            if (stristr($ds[ 'instagram' ], "https://")) {
                $instagram = '<a class="instagram" href="' . htmlspecialchars($ds[ 'instagram' ]) . '" target="_blank" rel="nofollow"><i class="bi bi-instagram" style="font-size: 1.5rem;">Instagram</i></a>&nbsp;&nbsp;';
            } else {
                $instagram = '<a class="instagram" href="http://' . htmlspecialchars($ds[ 'instagram' ]) . '" target="_blank" rel="nofollow"><i class="bi bi-instagram" style="font-size: 1.5rem;">Instagram</i></a>&nbsp;&nbsp;';
            }
        } else {
            $instagram = '';
        }

        if ($ds[ 'facebook' ] != '') {
            if (stristr($ds[ 'facebook' ], "https://")) {
                $facebook = '<a class="facebook" href="' . htmlspecialchars($ds[ 'facebook' ]) . '" target="_blank" rel="nofollow"><i class="bi bi-facebook" style="font-size: 1.5rem;">Facebook</i></a>&nbsp;&nbsp;';
            } else {
                $facebook = '<a class="facebook" href="http://' . htmlspecialchars($ds[ 'facebook' ]) . '" target="_blank" rel="nofollow"><i class="bi bi-facebook" style="font-size: 1.5rem;">Facebook</i></a>&nbsp;&nbsp;';
            }
        } else {
            $facebook = '';
        }

        if ($ds[ 'steam' ] != '') {
            if (stristr($ds[ 'steam' ], "https://")) {
                $steam = '<a class="steam" href="' . htmlspecialchars($ds[ 'steam' ]) . '" target="_blank" rel="nofollow"><i class="bi bi-steam" style="font-size: 1.5rem;">Steam</i></a>&nbsp;&nbsp;';
            } else {
                $steam = '<a class="steam" href="http://' . htmlspecialchars($ds[ 'steam' ]) . '" target="_blank" rel="nofollow"><i class="bi bi-steam" style="font-size: 1.5rem;">Steam</i></a>&nbsp;&nbsp;';
            }
        } else {
            $steam = '';
        }
        
        if ($ds[ 'firstname' ] || $ds[ 'lastname' ]) {            
            $firstname = '<td>'.$ds[ 'firstname' ].'';
            $lastname = ''.$ds[ 'lastname' ].'</td>';
        } else {
            $firstname = '';
            $lastname = '';         
        }        

        $birthday = getformatdate(strtotime($ds['birthday']));

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

        if ($cur[ 'age' ] == '2022') {
            $cur[ 'age' ] = $_language->module[ 'n_a' ];
        }

        $age = (int)$cur[ 'age' ];

        if ($birthday) {            
            $birth_day = '<td>'.$birthday.' / '.$_language->module[ 'age' ].': '.$age.'</td>';
        } else {
            $birth_day = '';       
        }

        
        if ($ds[ 'gender' ]) {
            if ($ds[ 'gender' ] == "female") {
                $gender = '<td>'.$_language->module[ 'female' ].'</td>';  
            } elseif ($ds[ 'gender' ] == "male") {
                $gender = '<td>'.$_language->module[ 'male' ].'</td>';  
            } elseif ($ds[ 'gender' ] == "diverse") {
                $gender = '<td>'.$_language->module[ 'diverse' ].'</td>';  
            } else {
                $gender = '';
            }

        } else {
            $gender = '';
        }
        
                
        if ($ds[ 'town' ]) {
            $town = '<td>'.$ds[ 'town' ].'</td>';            
        } else {
            $town = '';
        }


        #----forumposts ----
        function getuserforumposts($userID)
        {
        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='forum'"));
        if (@$dx[ 'modulname' ] != 'forum') {
        '';
        } else {
        return mysqli_num_rows(safe_query("SELECT `postID` FROM `" . PREFIX . "plugins_forum_posts` WHERE `poster` = " . (int)$userID));
        }
        }

        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='forum'"));
        if (@$dx[ 'modulname' ] != 'forum') {
        $new_forum_posts = '';
        } else {
        $new_forum_posts = getuserforumposts($ds['userID']);
        }


        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='forum'"));
        if (@$dx[ 'modulname' ] != 'forum') {
        $usertype = '';
        $rang = '';
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
        $specialtype = "";
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
            
            #if (!empty($tmp_rank[1]) && file_exists("/includes/plugins/forum/images/icons/ranks/" . $tmp_rank[1])) {
            if (!empty($tmp_rank[1]) && file_exists("includes/plugins/forum/images/icons/ranks/" . $tmp_rank[1]) && deleteduser($ds[ 'userID' ]) == '0') {
                #$special_rank .= '<br/>';
                $specialrank .= "<img src='/includes/plugins/forum/images/icons/ranks/" . $tmp_rank[1] . "' alt = 'rank' />";
            }
            $specialrank .= '<br/>';
            $specialrank .= '<small>(';
            $specialrank .= $tmp_rank[0];
            $specialrank .= ')</small>';
        }


        }
        /*-----------game images --------------*/

        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='games_pic'"));
        if (@$dx[ 'modulname' ] != 'games_pic') {
            $games = '';
            $game_link = '';
        }else{

            $games = "";   

            if (!empty($ds[ 'games' ])) {
                $array = unserialize($ds[ 'games' ]);
                $n = 1;
                foreach ($array as $id) {
                    if (!empty($id)) {
                        if ($n > 1) {
                            $games .= '<img id="icon" style="width: 100%; max-width: 150px;" class="img-fluid" src="../includes/plugins/games_pic/images/'.$id.'.png" alt="">';
                        } else {
                            $games .= '<img id="icon" style="width: 100%; max-width: 150px;" class="img-fluid" src="../includes/plugins/games_pic/images/'.$id.'.png" alt="">';
                        }
                        $n++;
                    }
                }
            } else {
                $games .= '';
            }

            $game_link = '<li class="nav-item">
                            <a class="nav-link" id="games-tab" data-bs-toggle="tab" href="#games" role="tab" aria-controls="games" aria-selected="false">'.$_language->module[ 'games' ].'</a>
                                </li>';
        }    
        /*-----------game images END--------------*/

        /*-----------squad images --------------*/

        $banner = ""; 
    $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='squads'"));
    if (@$dx[ 'modulname' ] != 'squads') {    
            
    } else {    
        $ergebnis = safe_query("SELECT * FROM " . PREFIX . "plugins_squads_members WHERE userID='".$ds['userID']."' ORDER BY sort");

        while ($dd = mysqli_fetch_array($ergebnis)) {
            $team = $dd[ 'squadID' ];
            $position = $dd[ 'position' ];

            $settings = safe_query("SELECT * FROM " . PREFIX . "plugins_squads WHERE squadID='".$team."' ORDER BY sort");
            while ($df = mysqli_fetch_array($settings)) {
            
            if (!empty($df[ 'icon' ])) {
                $pic = $df[ 'icon' ];
            }else{
                $pic='no-image.jpg';
            }

            $name = $df[ 'name' ];

                if (!empty($ds[ 'userID' ])) {
                
                $banner .= '
                    <div class="col-md-4"><a href="index.php?site=squads&amp;action=show&amp;squadID=' . $dd[ 'squadID' ] .
                    '">
                      <div class="profile-team-bg" style="background-image: url(/includes/plugins/squads/images/squadicons/' . $pic . ')">
                         <h4 class="top">' . $name . '</h4>
                         <h4 class="bottom">' . $position . '</h4>
                      </div></a>
                   </div>
                   ';

                } else {
                $banner .= '';
                }

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
            $about = '';
        }

        if ($ds[ 'usertext' ]) {
            $signature = $ds[ 'usertext' ];

            $translate = new multiLanguage(detectCurrentLanguage());
            $translate->detectLanguages($signature);
            $signature = $translate->getTextByLanguage($signature);
            
        } else {
            $signature = '';
        }

        #----news ----
        function getusernewsposts($userID)
        {
        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='news_manager'"));
        if (@$dx[ 'modulname' ] != 'news_manager') {
        $new_posts = '';
        } else {
        return mysqli_num_rows(safe_query("SELECT newsID FROM `" . PREFIX . "plugins_news` WHERE `poster` = " . (int)$userID));
        } 
        }

        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='news_manager'"));
        if (@$dx[ 'modulname' ] != 'news_manager') {
        $new_posts = '';
        } else {
        $new_posts = getusernewsposts($ds['userID']);
        }

        #----news_comments ----
        function getusernewscomments($userID)
        {
        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='news_manager'"));
        if (@$dx[ 'modulname' ] != 'news_manager') {
        '';
        } else {
        return mysqli_num_rows(safe_query("SELECT commentID FROM `" . PREFIX . "plugins_news_comments` WHERE `userID` = " . (int)$userID . " AND `type` = 'ne'"));
        }
        }

        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='news_manager'"));
        if (@$dx[ 'modulname' ] != 'news_manager') {
        $news_comments = '';
        } else {
        $news_comments = getusernewscomments($ds['userID']);
        }

        #----articles_comments ----
        function getuserarticlescomments($userID)
        {
        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='articles'"));
        if (@$dx[ 'modulname' ] != 'articles') {
        '';
        } else {
        return mysqli_num_rows(safe_query("SELECT commentID FROM `" . PREFIX . "plugins_articles_comments` WHERE `userID` = " . (int)$userID . " AND `type` = 'ar'"));
        }
        }

        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='articles'"));
        if (@$dx[ 'modulname' ] != 'articles') {
        $articles_comments = '';
        } else {
        $articles_comments = getuserarticlescomments($ds['userID']);
        }

        #----blog_comments ----
        function getuserblogcomments($userID)
        {
        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='blog'"));
        if (@$dx[ 'modulname' ] != 'blog') {
        '';
        } else {
        return mysqli_num_rows(safe_query("SELECT commentID FROM `" . PREFIX . "plugins_blog_comments` WHERE `userID` = " . (int)$userID . " AND `type` = 'bl'"));
        }
        }

        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='blog'"));
        if (@$dx[ 'modulname' ] != 'blog') {
        $blog_comments = '';
        } else {
        $blog_comments = getuserblogcomments($ds['userID']);
        }

        #----polls_comments ----
        function getuserpollscomments($userID)
        {
        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='polls'"));
        if (@$dx[ 'modulname' ] != 'polls') {
        '';
        } else {
        return mysqli_num_rows(safe_query("SELECT commentID FROM `" . PREFIX . "plugins_polls_comments` WHERE `userID` = " . (int)$userID . " AND `type` = 'po'"));
        }
        }

        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='polls'"));
        if (@$dx[ 'modulname' ] != 'polls') {
        $polls_comments = '';
        } else {
        $polls_comments = getuserpollscomments($ds['userID']);
        }

        #----gallery_comments ----
        function getusergallerycomments($userID)
        {
        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='gallery'"));
        if (@$dx[ 'modulname' ] != 'gallery') {
        '';
        } else {
        return mysqli_num_rows(safe_query("SELECT commentID FROM `" . PREFIX . "plugins_gallery_comments` WHERE `userID` = " . (int)$userID . " AND `type` = 'ga'"));
        }
        }

        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='gallery'"));
        if (@$dx[ 'modulname' ] != 'gallery') {
        $gallery_comments = '';
        } else {
        $gallery_comments = getusergallerycomments($ds['userID']);
        }

        #----videos_comments ----
        function getuservideoscomments($userID)
        {
        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='videos'"));
        if (@$dx[ 'modulname' ] != 'videos') {
        '';
        } else {
        return mysqli_num_rows(safe_query("SELECT commentID FROM `" . PREFIX . "plugins_videos_comments` WHERE `userID` = " . (int)$userID . " AND `type` = 'vi'"));
        }
        }

        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='videos'"));
        if (@$dx[ 'modulname' ] != 'videos') {
        $videos_comments = '';
        } else {
        $videos_comments = getuservideoscomments($ds['userID']);
        }

        #----blogtopics ----
        function getuserblogtopics($userID)
        {
        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='blog'"));
        if (@$dx[ 'modulname' ] != 'blog') {
        '';
        } else {
        return mysqli_num_rows(safe_query("SELECT `blogID` FROM `" . PREFIX . "plugins_blog` WHERE `userID` = " . (int)$userID));
        }
        }

        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='blog'"));
        if (@$dx[ 'modulname' ] != 'blog') {
        $new_blog_topics = '';
        } else {
        $new_blog_topics = getuserblogtopics($ds['userID']);
        }

        #----pollstopics ----
        function getuserpollstopics($userID)
        {
        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='polls'"));
        if (@$dx[ 'modulname' ] != 'polls') {
        '';
        } else {
        return mysqli_num_rows(safe_query("SELECT `pollID` FROM `" . PREFIX . "plugins_polls` WHERE `userIDs` = " . (int)$userID));
        }
        }

        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='polls'"));
        if (@$dx[ 'modulname' ] != 'polls') {
        $new_polls = '';
        } else {
        $new_polls = getuserpollstopics($ds['userID']);
        }

        #----forumtopics ----
        function getuserforumtopics($userID)
        {
        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='forum'"));
        if (@$dx[ 'modulname' ] != 'forum') {
        '';
        } else {
        return mysqli_num_rows(safe_query("SELECT `topicID` FROM `" . PREFIX . "plugins_forum_topics` WHERE `userID` = " . (int)$userID));
        }
        }

        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='forum'"));
        if (@$dx[ 'modulname' ] != 'forum') {
        $new_forum_topics = '';
        } else {
        $new_forum_topics = getuserforumtopics($ds['userID']);
        }
        

        #----messenger ----
        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='messenger'"));
        if (@$dx[ 'modulname' ] != 'messenger') {
        $pm_got = '';
        } else {
        $pm_got = $ds[ 'pmgot' ];
        }

        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='messenger'"));
        if (@$dx[ 'modulname' ] != 'messenger') {
        $pm_sent = '';
        } else {
        $pm_sent = $ds[ 'pmsent' ];
        }

        $lastvisits = "";
        $id = $ds[ 'userID' ];
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

                if(isonline($dv[ 'visitor' ])=="offline") {
                    $statuspic = '<span class="badge bg-danger">offline</span>';
                } else {
                    $statuspic = '<span class="badge bg-success">online</span>';
                }

                $time = time();
                
                $visittime = $dv[ 'date' ];

                $sec = $time - $visittime;
                $days = $sec / 86400;                               // sekunden / (60*60*24)
                $days = mb_substr($days, 0, mb_strpos($days, "."));     // kommastelle

                #$sec = $sec - $days * 86400;
                if (is_numeric($days) && is_numeric(86400)) {
                    $sec = ($sec - $days * 86400);
                } else {
                    // do some error handling...
                }

                $hours = $sec / 3600;
                $hours = mb_substr($hours, 0, mb_strpos($hours, "."));

                #$sec = $sec - $hours * 3600;
                if (is_numeric($days) && is_numeric(3600)) {
                    $sec = ($sec - $hours * 3600);
                } else {
                    // do some error handling...
                }

                $minutes = $sec / 60;
                $minutes = mb_substr($minutes, 0, mb_strpos($minutes, "."));

                if ($time - $visittime < 60) {
                    $now = $_language->module[ 'now' ];
                    $days = "";
                    $hours = "";
                    $minutes = "";
                } else {
                    $now = '';
                    $days == 0 ? $days = "" : $days = $days . 'd / ';
                    $hours == 0 ? $hours = "" : $hours = $hours . 'h / ';
                    $minutes == 0 ? $minutes = "" : $minutes = $minutes . 'm';
                }

                $lastvisits .= '<tr>
                <td><a href="index.php?site=profile&amp;id=' . $dv[ 'visitor' ] . '">' .
                    $nicknamevisitor . '</a></td>
                <td class="text-end">'.$now.$days.$hours.$minutes.' '. $statuspic . '</td>
            </tr>';

                $n++;
            }
        } else {
            $lastvisits = '<tr><td colspan="2">' . $_language->module[ 'no_visits' ] . '</td></tr>';
        }

        $ergebnis = safe_query("SELECT * FROM " . PREFIX . "user WHERE userID='" . $userID . "'");
        $anz = mysqli_num_rows($ergebnis);
        if ($id == $userID) {

        

        //messages?
        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='messenger'"));
        if (@$dx[ 'modulname' ] != 'messenger') {
            $newmessages = '';
        } else {
            $newmessages = $newmessages = getnewmessages($userID);
        }

        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='messenger'"));
        if (@$dx[ 'modulname' ] != 'messenger') {
            $button_newmessages = '';
        } else {
            $button_newmessages = $newmessages = getnewmessages($userID);
        }

        if ($newmessages == 1) {
            $newmessages = $_language->module[ 'one_new_message' ];
        } elseif ($newmessages > 1) {
            $newmessages = str_replace('%new_messages%', $newmessages, $_language->module[ 'x_new_message' ]);
        } else {
            $newmessages = $_language->module[ 'no_new_messages' ];
        }

        if ($button_newmessages == 1) {
            $button_newmessages = $_language->module[ 'button_one_new_message' ];
        } elseif ($button_newmessages > 1) {
            $button_newmessages = str_replace('%new_messages%', $button_newmessages, $_language->module[ 'button_x_new_message' ]);
        } else {
            $button_newmessages = $_language->module[ 'button_no_new_messages' ];
        }

        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='messenger'"));
        if (@$dx[ 'modulname' ] != 'messenger') {
            $new_messages = '';
        } else {
            $new_messages = '<a href="index.php?site=messenger">'.$newmessages.'</a>';
        }

        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='messenger'"));
            if (@$dx[ 'modulname' ] != 'messenger') {
            $new_messages_button = '';
            } else {
            $new_messages_button = $button_newmessages;
        }

        # Cashbox
        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='cashbox'"));
            if (@$dx[ 'modulname' ] != 'cashbox') {
            $cash_box = '';
            } else {
                $da = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='squads'"));
                if (@$da[ 'modulname' ] != 'squads') {
                    $cash_box = '';
                } else {    
                    if (isclanmember($userID)) {
                        $cash_box = '<a class="btn btn-info btn-sm" href="index.php?site=cashbox"><i class="bi bi-cash"></i> '.$_language->module[ 'cashbox' ].'</a>';
                    } else {
                        $cash_box = '';
                    }
                }            
            }

        # Usergallery    
        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='gallery'"));
        if (@$dx[ 'modulname' ] != 'gallery') {
            $usergallery = '';
            $gallery_link = '';
        } else {
            /*$da = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='squads'"));
            if (@$da[ 'modulname' ] != 'squads') {    
                $usergallery = '';
                $gallery_link = '';
            } else {*/
                $ergebnis = safe_query("SELECT * FROM " . PREFIX . "plugins_gallery_settings");
                $dy = mysqli_fetch_array($ergebnis);
                if ($dy[ 'usergalleries' ] == '1') {    
                    if (isclanmember($userID)) {
                        $usergallery = '<a class="btn btn-warning btn-sm" href="index.php?site=usergallery"><i class="bi bi-images"></i> '.$_language->module[ 'usergalleries' ].'</a>';
                        $gallery_link = '<li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">'.$_language->module[ 'usergalleries' ].'</a>
                                </li>';

                        $gallery_link = '<li class="nav-item">
                            <a class="nav-link" data-bs-toggle="modal" data-bs-target="#exampleModalgall" href="index.php?site=profile"> ' . $_language->module[ 'galleries' ] . '</a>
                            </li>';    
                    } else {
                        $usergallery = '';
                        $gallery_link = '';
                    }
                }else{
                    $usergallery = '';
                    $gallery_link = '';
                }
                          
            }
        #--------------------------------------

        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='calendar'"));
            if (@$dx[ 'modulname' ] != 'calendar') {
                $upcoming = '';
                $calendar_link = '';

            } else {    
                $upcoming = 
        //upcoming

                $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='clanwars'"));
                if (@$dx[ 'modulname' ] != 'clanwars') {    
                $clanwars = '';

                } else {
                    if (isclanmember($userID)) {
                        @$clanwars .= "<hr><h5>" . $_language->module[ 'upcoming_clanwars' ] . "</h5>";

                        $squads = safe_query("SELECT squadID FROM `" . PREFIX . "plugins_squads_members` WHERE userID='" . $userID . "'");
                        while ($squad = mysqli_fetch_array($squads)) {
                            if (isgamesquad($squad[ 'squadID' ])) {
                                $dn = mysqli_fetch_array(
                                    safe_query(
                                        "SELECT
                                            name
                                        FROM
                                            `" . PREFIX . "plugins_squads`
                                        WHERE
                                            squadID='" . $squad[ 'squadID' ] . "'
                                        AND
                                            gamesquad='1'"
                                    )
                                );
                                @$clanwars .= '<p><b>' . $_language->module[ 'squad' ] . ':</b> ' . $dn[ 'name' ] . '</p>';
                                $n = 1;
                                $ergebnis = safe_query(
                                    "SELECT
                                        *
                                    FROM
                                        `" . PREFIX . "plugins_upcoming`
                                    WHERE
                                        type='c'
                                    AND
                                        squad='" . $squad[ 'squadID' ] . "'
                                    AND
                                        date>" . time() . "
                                    ORDER BY
                                        date"
                                );
                                $anz = mysqli_num_rows($ergebnis);

                                if ($anz) {
                                    @$clanwars .= '<table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>' . $_language->module[ 'date' ] . '</th>
                                            <th>' . $_language->module[ 'against' ] . '</th>
                                            <th>' . $_language->module[ 'announcement' ] . '</th>
                                            <th>' . $_language->module[ 'announce' ] . '</th>
                                        </tr>
                                    </thead><tbody>';

                                    while ($ds = mysqli_fetch_array($ergebnis)) {
                                        
                                        $date = getformatdate($ds[ 'date' ]);

                                        $anmeldung =
                                            safe_query(
                                                "SELECT
                                                    *
                                                FROM
                                                    " . PREFIX . "plugins_upcoming_announce
                                                WHERE
                                                    upID='" . $ds[ 'upID' ] . "'"
                                            );
                                        if (mysqli_num_rows($anmeldung)) {
                                            $i = 1;
                                            $players = "";
                                            while ($da = mysqli_fetch_array($anmeldung)) {
                                                if ($da[ 'status' ] == "y") {
                                                    $fontcolor = "label-success";
                                                } elseif ($da[ 'status' ] == "n") {
                                                    $fontcolor = "label-important";
                                                } else {
                                                    $fontcolor = "label-warning";
                                                }

                                                if ($i > 1) {
                                                    $players .= ', <a href="index.php?site=profile&amp;id=' . $da[ 'userID' ] .
                                                        '"><span class="label ' . $fontcolor . '">' .
                                                        strip_tags(stripslashes(getnickname($da[ 'userID' ]))) . '</span></a>';
                                                } else {
                                                    $players .= '<a href="index.php?site=profile&amp;id=' . $da[ 'userID' ] .
                                                        '"><span class="label ' . $fontcolor . '">' .
                                                        strip_tags(stripslashes(getnickname($da[ 'userID' ]))) . '</span></a>';
                                                }
                                                $i++;
                                            }
                                        } else {
                                            $players = $_language->module[ 'no_players_announced' ];
                                        }

                                        $tag = date("d", $ds[ 'date' ]);
                                        $monat = date("m", $ds[ 'date' ]);
                                        $yahr = date("Y", $ds[ 'date' ]);

                                        @$clanwars .= '<tr>
                                            <td>' . $date . '</td>
                                            <td><a href="' . $ds[ 'opphp' ] . '" target="_blank">' . $ds[ 'opptag' ] . ' / ' .
                                            $ds[ 'opponent' ] . '</a></td>
                                            <td>' . $players . '</td>
                                            <!--<td><a href="index.php?site=calendar&amp;action=announce&amp;upID=' . $ds[ 'upID' ] .
                                            '&amp;tag=' . $tag . '&amp;month=' . $monat . '&amp;year=' . $yahr . '#event">' .
                                            $_language->module[ 'click' ] . '</a></td>-->

                                            <td><a href="index.php?site=calendar&amp;tag=' . $tag . '&amp;month=' . $monat . '&amp;year=' . $yahr . '">' . $_language->module[ 'click' ] . '</a></td>
                                        </tr>';
                                        $n++;
                                    }
                                    @$clanwars .= '</tbody></table>';
                                } else {
                                    @$clanwars .= $_language->module[ 'no_entries' ];
                                }
                            }
                        }
                    }
            
                }
                $calendar_link = '<li class="nav-item">
                                    <a class="nav-link" id="calendar-tab" data-bs-toggle="tab" href="#calendar" role="tab" aria-controls="calendar" aria-selected="false">' . $_language->module[ 'click' ] . '</a>
                                </li>';
            }
        unset($events);    
        # Calendar
        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='calendar'"));
        if (@$dx[ 'modulname' ] != 'calendar') {
            $upcoming = '';
        } else {    
            $upcoming = 

            $events = '';
            $ergebnis =
            safe_query("SELECT * FROM `" . PREFIX . "plugins_upcoming` WHERE type='d' AND date>" . time() . " ORDER by date");
            $anz = mysqli_num_rows($ergebnis);
            if ($anz) {
                $events .= '<table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>'.$_language->module[ 'name' ].':</th>
                                    <th>'.$_language->module[ 'from' ].':</th>
                                    <th>'.$_language->module[ 'until' ].':</th>
                                    <th>'.$_language->module[ 'location' ].':</th>
                                    <th>'.$_language->module[ 'info' ].':</th>
                                </tr>
                            </thead><tbody>';
                $n = 1;
                while ($ds = mysqli_fetch_array($ergebnis)) {
                    $events .= '<tr>
                        <td>' . $ds[ 'title' ] . '</td>
                        <td>' . date('d.m.y, H:i', $ds[ 'date' ]) . '</td>
                        <td>' . date('d.m.y, H:i', $ds[ 'enddate' ]) . '</td>
                        <td>' . $ds[ 'location' ] . '</td>
                        <td><a href="index.php?site=calendar&amp;tag=' . date('d', $ds[ 'date' ]) . '&amp;month=' .
                            date('m', $ds[ 'date' ]) . '&amp;year=' . date('Y', $ds[ 'date' ]) . '#event">' .
                            $_language->module[ 'click' ] . '</a></td>
                        </tr>';
                        $n++;
                }
                    
                $events .= '</tbody></table>';
            } else {
                $events .= $_language->module[ 'no_events' ];
            }

        }
                       
        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='calendar'"));
        if (@$dx[ 'modulname' ] != 'calendar') {
            $kalender = '';
        } else {    
            $kalender = '
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <!--<h5>'.$_language->module[ 'upcoming' ].'</h5>-->
                            '.$clanwars.'
                        </div>    
                        <div class="col-md-6"><hr>
                            <h5>'.$_language->module[ 'upcoming_events' ].'</h5><p>&nbsp;</p>
                            '.$events.'
                        </div>   
                    </div> 
                </div>   
                    ';
        } 

                  

        if (isanyadmin($userID)) {
            $admincenterpic =
                '<a class="btn btn-dark btn-sm" href="admin/admincenter.php" target="_blank"><i class="bi bi-gear"></i> '.$_language->module[ 'admin' ].'</a>';
        } else {
            $admincenterpic = '';
        }

        # Profil bearbeiten
        $edit_account = '<a class="btn btn-warning btn-sm" href="index.php?site=myprofile"><i class="bi bi-person-gear"></i>  '.$_language->module[ 'edit_account' ].'</a>';

        $logout = '<a class="btn btn-danger btn-sm" href="index.php?site=logout"><i class="bi bi-box-arrow-right"></i> '.$_language->module[ 'logout' ].'</a>';       

        } else {
           $cash_box = '';
           $usergallery = '';
           $new_messages_button = '';
           $edit_account='';
           $kalender='';
           $logout = '';
           $admincenterpic = '';
           $calendar_link='';
        }

        $data_array = array();
        $data_array['$id'] = $id;
        $data_array['$userpic'] = $userpic;
        $data_array['$nickname'] = $nickname;
        $data_array['$member'] = $member;
        $data_array['$firstname'] = $firstname;
        $data_array['$lastname'] = $lastname;
        $data_array['$gender'] = $gender;
        $data_array['$birth_day'] = $birth_day;
        $data_array['$age'] = $age;
        $data_array['$town'] = $town;
        $data_array['$status'] = $status;
        $data_array['$registerdate'] = $registerdate;
        $data_array['$lastlogin'] = $lastlogin;
        $data_array['$email'] = $email;
        $data_array['$pm'] = $pm;

        $data_array['$discord'] = $discord;
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


        $data_array['$blog_comments'] = $blog_comments;
        $data_array['$articles_comments'] = $articles_comments;
        $data_array['$polls_comments'] = $polls_comments;
        $data_array['$gallery_comments'] = $gallery_comments;
        $data_array['$videos_comments'] = $videos_comments;
        $data_array['$new_blog_topics'] = $new_blog_topics;
        $data_array['$new_polls'] = $new_polls;

        
          
        $data_array['$new_messages_button'] = $new_messages_button; 
        $data_array['$edit_account'] = $edit_account;
        $data_array['$cash_box'] = $cash_box;
        $data_array['$usergallery'] = $usergallery;
        $data_array['$kalender'] = $kalender;
        $data_array['$admincenterpic'] = $admincenterpic;
        $data_array['$logout'] = $logout;
        $data_array['$game_link'] = $game_link;
        $data_array['$calendar_link'] = $calendar_link;
        $data_array['$squad_link'] = $squad_link;
        $data_array['$gallery_link'] = $gallery_link;
        $data_array['$last_post'] = $last_post;

        $data_array['$signature'] = $signature;
        $data_array['$lang_signature'] = $_language->module[ 'signature' ];

        $data_array['$user_award_link'] = $user_award_link;
        $data_array['$user_award_list'] = $user_award_list;
        $data_array['$lang_awards'] = $_language->module[ 'headaward' ];

        $data_array['$blogcomments'] = $_language->module[ 'blogcomments' ];
        $data_array['$articlescomments'] = $_language->module[ 'articlescomments' ];
        $data_array['$pollscomments'] = $_language->module[ 'pollscomments' ];
        $data_array['$gallerycomments'] = $_language->module[ 'gallerycomments' ];
        $data_array['$videoscomments'] = $_language->module[ 'videoscomments' ];
        $data_array['$blogtopics'] = $_language->module[ 'blogtopics' ];
        $data_array['$newspolls'] = $_language->module[ 'newspolls' ];
        $data_array['$comment'] = $_language->module[ 'comment' ];
        $data_array['$messages'] = $_language->module[ 'messages' ];
        $data_array['$news'] = $_language->module[ 'news' ];
        $data_array['$squad'] = $_language->module[ 'squad' ];


        $data_array['$personal_info'] = $_language->module[ 'personal_info' ];
        $data_array['$real_name'] = $_language->module[ 'real_name' ];
        $data_array['$nick_name'] = $_language->module[ 'nickname' ];
        $data_array['$lang_age'] = $_language->module[ 'age' ];
        $data_array['$lang_birthday'] = $_language->module[ 'birthday' ];
        $data_array['$lang_gender'] = $_language->module[ 'gender' ];
        $data_array['$location'] = $_language->module[ 'location' ];
        $data_array['$status_on_off'] = $_language->module[ 'status' ];
        $data_array['$last_login'] = $_language->module[ 'last_login' ];
        $data_array['$registered'] = $_language->module[ 'registered' ];
        $data_array['$usertitle'] = $_language->module[ 'usertitle' ];
        $data_array['$contact'] = $_language->module[ 'contact' ];
        $data_array['$message'] = $_language->module[ 'message' ];
        $data_array['$iemail'] = $_language->module[ 'iemail' ];

        $data_array['$social_media'] = $_language->module[ 'social-media' ];
        $data_array['$lang_discord'] = $_language->module[ 'discord' ];
        $data_array['$lang_homepage'] = $_language->module[ 'homepage' ];
        $data_array['$newsposts'] = $_language->module[ 'newsposts' ];
        $data_array['$newscomments'] = $_language->module[ 'newscomments' ];
        $data_array['$forumtopics'] = $_language->module[ 'forumtopics' ];
        $data_array['$forumposts'] = $_language->module[ 'forumposts' ];
        $data_array['$messenger'] = $_language->module[ 'messenger' ];
        $data_array['$incoming'] = $_language->module[ 'incoming' ];
        $data_array['$outgoing'] = $_language->module[ 'outgoing' ];
        $data_array['$actions'] = $_language->module[ 'actions' ];
        $data_array['$lang_games'] = $_language->module[ 'games' ];
        $data_array['$lang_squads'] = $_language->module[ 'squads' ];
        $data_array['$lang_about'] = $_language->module[ 'about' ];
        $data_array['$social-media'] = $_language->module[ 'social-media' ];
        
        $data_array['$latest_visitors'] = $_language->module[ 'latest_visitors' ];
        $data_array['$statistics'] = $_language->module[ 'statistics' ];
        $data_array['$upcoming_events'] = $_language->module[ 'upcoming_events' ];

        $dy = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='useraward'"));
        if (@$dy[ 'modulname' ] != 'useraward') {
            $awards = '';    
        } else {

        ######    Award System    ######
        $translate = new multiLanguage(detectCurrentLanguage());


        function getawardimage($awardID) {
            $ds = mysqli_fetch_array(safe_query("SELECT * FROM ".PREFIX."plugins_user_award_list WHERE uawardID='".$awardID."'"));
            return $ds['image'];
        }

        function getawardname($awardID) {
            $translate = new multiLanguage(detectCurrentLanguage());
            $ds = mysqli_fetch_array(safe_query("SELECT * FROM ".PREFIX."plugins_user_award_list WHERE uawardID='".$awardID."'"));
            $translate->detectLanguages($ds['info']);
            $lg2 = $translate->getTextByLanguage($ds['info']);
            return $lg2;

        }

        function getawardpoints($name,$value) {
            $translate = new multiLanguage(detectCurrentLanguage());
            $test = '';
            $erg = safe_query("SELECT * FROM ".PREFIX."plugins_user_award_list WHERE name='".$name."'");
            while($ds = mysqli_fetch_array($erg)) {
                $translate->detectLanguages($ds['info']);
                $lg = $translate->getTextByLanguage($ds['info']);
                if($value >= $ds['awardrequire']) $test .= ''.$ds['uawardID'].'||'.$lg.'||'.$ds['image'].'#';
            }
            return $test;
        }

        function saveaward($userid,$awardid) {
            $dz = mysqli_num_rows(safe_query("SELECT * FROM ".PREFIX."plugins_user_award WHERE awardID = '" . $awardid . "' AND userID = '" . $userid . "'"));
            if($dz == '0') {
                safe_query("
                    INSERT INTO ".PREFIX."plugins_user_award 
                    ( userID, awardID )
                    values
                    ( '" . $userid. "', '" . $awardid . "' )
                ");
            }
        }

        $maxawardsperrow=12;
        $_language->readModule('useraward');
        $membersince=date("Y-m-d", $ds['registerdate']);
        $pmsent = $ds['pmsent'];
        $waruserID=$ds['userID'];

        $memberaward = '0';
        $forumaward = '0';
        $communityaward  = '0';
        $newsaward = '0';
        $waraward = '0';
        $pmaward = '0';
        $communityribbon = '';
        $awards = '';

        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='forum'"));
        if (@$dx[ 'modulname' ] != 'forum') {
        $anzforumposts = '';
        } else {
        $anzforumposts = mysqli_num_rows(safe_query("SELECT poster FROM ".PREFIX."plugins_forum_posts WHERE poster='" . $id . "'"));
        }

        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='news_manager'"));
        if (@$dx[ 'modulname' ] != 'news_manager') {
            $anznewsposts = '';
            #$awcomments = '';
        } else {
            $anznewsposts = mysqli_num_rows(safe_query("SELECT poster FROM ".PREFIX."plugins_news WHERE poster='" . $id . "'"));
            $comments[0] = mysqli_num_rows(safe_query("SELECT userID FROM ".PREFIX."plugins_news_comments WHERE userID='" . $id . "'"));
            $comments[1] = mysqli_num_rows(safe_query("SELECT user_id FROM ".PREFIX."plugins_news_comments_recomment WHERE user_id='" . $id . "'"));
            $comments[2] = 0;
            $comments[3] = 0;
            $awcomments = $comments[0]+$comments[1]+$comments[2]+$comments[3];
        }

        $alt = strtotime($membersince);
        $aktuell = strtotime(date("Y-m-d"));
        $membertime = $aktuell - $alt;
        $membertime = $membertime / 86400;

        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='useraward'"));
        if (@$dx[ 'modulname' ] != 'useraward') {
            $status = '';
        } else {
            $ds1 = mysqli_fetch_array(safe_query("SELECT * FROM ".PREFIX."plugins_user_award_settings"));
            if($ds1['allaward'] == '0'){
                $status = '0';
            } else {
                $status = '1';
            }
        }

        if(getawardpoints('Member',$membertime) != '' ) {
            $vari = explode('#',getawardpoints('Member',$membertime));
            $memberaward = '1';
            $x = 1;
            $length = count($vari)-1;
            $memberaw = '';
            foreach(array_filter($vari) as $animal){
                $vari = explode('||',$animal);
                saveaward($id,$vari['0']);
                if($x === $length && $status == 0){
                    $memberaw = '<img src="includes/plugins/useraward/images/userawards/'.$vari['2'].'" width="40" height="100" border="0" data-toggle="tooltip" data-placement="bottom" title="'.$vari['1'].'" />';
                } else {
                    $memberaw .= '<img src="includes/plugins/useraward/images/userawards/'.$vari['2'].'" width="40" height="100" border="0" data-toggle="tooltip" data-placement="bottom" title="'.$vari['1'].'" />';
                }
                $x++;
            }             
        }


        if(getawardpoints('Messages',$pmsent) != '' ) {
            $vari = explode('#',getawardpoints('Messages',$pmsent));
            $pmaward = '1';
            $x = 1;
            $length = count($vari)-1;
            $pmaw = '';
            foreach(array_filter($vari) as $animal){
                $vari = explode('||',$animal);
                saveaward($id,$vari['0']);
                if($x === $length && $status == 0){
                    $pmaw = '<img src="includes/plugins/useraward/images/userawards/'.$vari['2'].'" width="40" height="100" border="0" data-toggle="tooltip" data-placement="bottom" title="'.$vari['1'].'" />';
                } else {
                    $pmaw .= '<img src="includes/plugins/useraward/images/userawards/'.$vari['2'].'" width="40" height="100" border="0" data-toggle="tooltip" data-placement="bottom" title="'.$vari['1'].'" />';
                }
                $x++;
            } 
        }

        if(getawardpoints('Forum',$anzforumposts) != '' ) {
            $vari = explode('#',getawardpoints('Forum',$anzforumposts));
            $forumaward = '1';
            $x = 1;
            $length = count($vari)-1;
            $forumaw = '';
            foreach(array_filter($vari) as $animal){
                $vari = explode('||',$animal);
                saveaward($id,$vari['0']);
                if($x === $length && $status == 0){
                    $forumaw = '<img src="includes/plugins/useraward/images/userawards/'.$vari['2'].'" width="40" height="100" border="0" data-toggle="tooltip" data-placement="bottom" title="'.$vari['1'].'" />';
                } else {
                    $forumaw .= '<img src="includes/plugins/useraward/images/userawards/'.$vari['2'].'" width="40" height="100" border="0" data-toggle="tooltip" data-placement="bottom" title="'.$vari['1'].'" />';
                }
                $x++;
            } 
        }


        if(getawardpoints('News',$anznewsposts) != '' ) {
            $vari = explode('#',getawardpoints('News',$anznewsposts));
            $newsaward = '1';
            $x = 1;
            $length = count($vari)-1;
            $newsaw = '';
            foreach(array_filter($vari) as $animal){
                $vari = explode('||',$animal);
                saveaward($id,$vari['0']);
                if($x === $length && $status == 0){
                    $newsaw = '<img src="includes/plugins/useraward/images/userawards/'.$vari['2'].'" width="40" height="100" border="0" data-toggle="tooltip" data-placement="bottom" title="'.$vari['1'].'" />';
                } else {
                     $newsaw .= '<img src="includes/plugins/useraward/images/userawards/'.$vari['2'].'" width="40" height="100" border="0" data-toggle="tooltip" data-placement="bottom" title="'.$vari['1'].'" />';
                }
                $x++;
            } 
        }

        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='news_manager'"));

        if (@$dx[ 'modulname' ] != 'news_manager') {

        #$status = '';

        } else {
        
            if(getawardpoints('Comments',$awcomments) != '' ) {
                $vari = explode('#',getawardpoints('Comments',$awcomments));
                $communityaward = '1';
                $x = 1;
                $length = count($vari)-1;
                $comaw = '';
                foreach(array_filter($vari) as $animal){
                    $vari = explode('||',$animal);
                    saveaward($id,$vari['0']);
                    if($x === $length && $status == 0){
                        $comaw = '<img src="includes/plugins/useraward/images/userawards/'.$vari['2'].'" width="40" height="100" border="0" data-toggle="tooltip" data-placement="bottom" title="'.$vari['1'].'" />';
                    } else {
                        $comaw .= '<img src="includes/plugins/useraward/images/userawards/'.$vari['2'].'" width="40" height="100" border="0" data-toggle="tooltip" data-placement="bottom" title="'.$vari['1'].'" />';
                    }
                    $x++;
                } 
            }
        }
        

        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='forum'"));
        if (@$dx[ 'modulname' ] != 'forum') {
        #$communityribbon='1';
        } else {
            if($anzforumposts>=1000) {
                $communityribbon='<img src="includes/plugins/useraward/images/userawards/dist_com_rib.png" width="80" height="100" border="0" data-toggle="tooltip" data-placement="bottom" title="'.$_language->module[ 'award_plus' ].'" />';
            }
        }

        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='news_manager'"));
        if (@$dx[ 'modulname' ] != 'news_manager') {
        #$communityribbon='1';
        } else {
            if($awcomments>=1000) {
                $communityribbon='<img src="includes/plugins/useraward/images/userawards/dist_com_rib.png" width="80" height="100" border="0" data-toggle="tooltip" data-placement="bottom" title="'.$_language->module[ 'award_plus' ].'" />';
            }
        }    
        
        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='clanwars'"));
        if (@$dx[ 'modulname' ] != 'clanwars') {
            $playercws = '';
        } else {
            $playercws=safe_query("SELECT hometeam FROM ".PREFIX."plugins_clanwars");
            $wars=0;
            while($roster=mysqli_fetch_array($playercws)) {
              $hometeam=$roster['hometeam'];
              if($hometeam!="") {
                $string=$hometeam;
                $array=unserialize($string);
                $anzarray=count($array);
                foreach($array as $id) {
                  if($id==$waruserID) $wars=$wars+1;
                }
              }
            }
        }
        
        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='clanwars'"));
        if (@$dx[ 'modulname' ] != 'clanwars') {
        $playercws = '';
        } else {
        if(getawardpoints('Wars',$wars) != '' ) {
            $vari = explode('#',getawardpoints('Wars',$wars));
            $waraward = '1';
            $x = 1;
            $length = count($vari)-1;
            $waraw = '';
            foreach(array_filter($vari) as $animal){
                $vari = explode('||',$animal);
                saveaward($id,$vari['0']);
                if($x === $length && $status == 0){
                    $waraw = '<img src="includes/plugins/useraward/images/userawards/'.$vari['2'].'" width="40" height="100" border="0" data-toggle="tooltip" data-placement="bottom" title="'.$vari['1'].'" />';
                } else {
                    $waraw .= '<img src="includes/plugins/useraward/images/userawards/'.$vari['2'].'" width="40" height="100" border="0" data-toggle="tooltip" data-placement="bottom" title="'.$vari['1'].'" />';
                }
                $x++;
            } 
        }
        }  

        if($memberaward OR $forumaward OR $communityaward OR $newsaward OR $waraward OR $pmaward) {
          $awards='<img src="includes/plugins/useraward/images/userawards/awards_left.png" width="40" height="100" border="0" />';
          if($memberaward) $awards.= $memberaw;
          if($forumaward) $awards.= $forumaw;
          if($communityaward) $awards.= $comaw;
          if($pmaward) $awards .= $pmaw;
          if($newsaward) $awards.= $newsaw;
          if($waraward) $awards.= $waraw;
          $awards.='<img src="includes/plugins/useraward/images/userawards/awards_right.png" width="40" height="100" border="0" />'; 
        }
        
        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='useraward'"));
        if (@$dx[ 'modulname' ] != 'useraward') {
        
        } else {
        $specialaward = '0';
        $spawards ='';
        $awardselect=safe_query("SELECT * FROM ".PREFIX."plugins_user_award WHERE userID='".$waruserID."'");
        $awardanz=mysqli_num_rows($awardselect);
        if($awardanz!=0 OR $communityribbon) {
          $spawards.='<br /><img src="includes/plugins/useraward/images/userawards/awards_left.png" width="40" height="100" border="0" />';
          if($communityribbon) { $awards.=$communityribbon; $k=2; }
          else $k=1;
          while($df=mysqli_fetch_array($awardselect)){
            $special = mysqli_num_rows(safe_query("SELECT * FROM ".PREFIX."plugins_user_award_list WHERE awardrequirepoints = '-1' AND uawardID = '".$df['awardID']."'"));
            if($special > 0) { 
                $specialaward = '1';
                $awardpfad = '/special';
                $picturesize[]=getimagesize('./includes/plugins/useraward/images/userawards'.$awardpfad.'/'.getawardimage($df['awardID']).'');
                if($picturesize[0]==80 AND $k==$maxawardsperrow-1) 
                  $spawards.='<img src="includes/plugins/useraward/images/userawards/awards_right.png" width="40" height="100" border="0" /><br /><img src="includes/plugins/useraward/images/userawards/awards_left.png" width="40" height="100" border="0" />';
                  $spawards.='<img src="includes/plugins/useraward/images/userawards'.$awardpfad.'/'.getawardimage($df['awardID']).'" height="100" border="0" data-toggle="tooltip" data-placement="bottom" title="'.getawardname($df['awardID']).'" />';
		
                if($k==$maxawardsperrow) 
                  $spawards.='<img src="includes/plugins/useraward/images/userawards/awards_right.png" width="40" height="100" border="0" /><br /><img src="includes/plugins/useraward/images/userawards/awards_left.png" width="40" height="100" border="0" />';
                elseif($k==2*$maxawardsperrow)
                  $spawards.='<img src="includes/plugins/useraward/images/userawards/awards_right.png" width="40" height="100" border="0" /><br /><img src="includes/plugins/useraward/images/userawards/awards_left.png" width="40" height="100" border="0" />';
                elseif($k==3*$maxawardsperrow) 
                  $spawards.='<img src="includes/plugins/useraward/images/userawards/awards_right.png" width="40" height="100" border="0" /><br /><img src="includes/plugins/useraward/images/userawards/awards_left.png" width="40" height="100" border="0" />';
		
                if($picturesize[0]==80) $k=$k+2;
                else $k=$k+1;
            }

          }
          $spawards.='<img src="includes/plugins/useraward/images/userawards/awards_right.png" width="40" height="100" border="0" />'; 
        }
    
        if($specialaward == '1') { $awards .= $spawards; };
        
    }  

}        


    ######    Award System ENDE   ######
        
        $template = $tpl->loadTemplate("profile","contentstart_one", $data_array);
        echo $template;
        
        if($firstname != '' ) {
          $template = $tpl->loadTemplate("profile","name", $data_array);
          echo $template;  
        }

        if($birthday != '30.11.-0001') {
          $template = $tpl->loadTemplate("profile","birthday", $data_array);
          echo $template;  
        }

        if($gender != '' ) {
          $template = $tpl->loadTemplate("profile","gender", $data_array);
          echo $template;  
        }
        
        if($town != '' ) {
          $template = $tpl->loadTemplate("profile","town", $data_array);
          echo $template;  
        }

        if($pm != '') {
          $template = $tpl->loadTemplate("profile","pm", $data_array);
          echo $template; 
        }  

        if($email != '' ) {
          $template = $tpl->loadTemplate("profile","email", $data_array);
          echo $template;  
        }

        $template = $tpl->loadTemplate("profile","contentstart_two", $data_array);
        echo $template;

        if($rang != '') {
          $template = $tpl->loadTemplate("profile","usertitle", $data_array);
          echo $template; 
        }

        $data_array['$awards'] = $awards;
        $template = $tpl->loadTemplate("profile","contentstart_three", $data_array);
        echo $template; 

        $template = $tpl->loadTemplate("profile","contentend", $data_array);
        echo $template; 
 
} else {
    redirect('index.php', $_language->module[ 'user_doesnt_exist' ], 3);
}

