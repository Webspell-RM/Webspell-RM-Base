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


$_language->readModule('user_rights', false, true);
$_language->readModule('rank_special', true, true);

$ergebnis = safe_query("SELECT * FROM ".PREFIX."navigation_dashboard_links WHERE modulname='ac_members'");
    while ($db=mysqli_fetch_array($ergebnis)) {
      $accesslevel = 'is'.$db['accesslevel'].'admin';

if (!$accesslevel($userID) || mb_substr(basename($_SERVER[ 'REQUEST_URI' ]), 0, 15) != "admincenter.php") {
    die($_language->module[ 'access_denied' ]);
}
}

if (isset($_GET[ 'action' ])) {
    $action = $_GET[ 'action' ];
} else {
    $action = '';
}

if (isset($_POST[ 'add_to_clan' ])) {
    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_POST[ 'captcha_hash' ])) {
        $anz = mysqli_num_rows(safe_query(
            "SELECT userID FROM " . PREFIX . "plugins_squads_members WHERE squadID='" .
            $_POST[ 'squad' ] . "' AND userID='" . $_POST[ 'id' ] . "'"
        ));
        if (!$anz) {
            safe_query(
                "INSERT INTO " . PREFIX . "plugins_squads_members (squadID, userID, position, activity, sort) values('" .
                $_POST[ 'squad' ] . "', '" . $_POST[ 'id' ] . "', '" . $_POST[ 'position' ] . "', '" .
                $_POST[ 'activity' ] . "', '1')"
            );
            echo'<div class="alert alert-success" role="alert">'.$_language->module['user_exists'].'</div>';
    
        } else {
            echo'<div class="alert alert-danger" role="alert">
                '.$_language->module[ 'user_not_exists' ].'</div>';
        }
    } else {
        echo $_language->module[ 'transaction_invalid' ];
    }
    redirect('admincenter.php?site=users','', 1);
} 

if (isset($_POST[ 'sortieren' ])) {
    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_POST[ 'captcha_hash' ])) {
        if (isset($_POST[ 'sort' ])) {
            $sort = $_POST[ 'sort' ];
            if (is_array($sort)) {
                foreach ($sort as $sortstring) {
                    $sorter = explode("-", $sortstring);
                    safe_query("UPDATE " . PREFIX . "plugins_squads_members SET sort='$sorter[1]' WHERE sqmID='$sorter[0]' ");
                }
            }
        }
    } else {
        echo $_language->module[ 'transaction_invalid' ];
    }
}

if (isset($_GET[ 'delete' ])) {
    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_GET[ 'captcha_hash' ])) {
        $id = $_GET[ 'id' ];
        $squadID = $_GET[ 'squadID' ];
        $squads = mysqli_num_rows(safe_query("SELECT userID FROM " . PREFIX . "plugins_squads_members WHERE userID='$id'"));
        if ($squads < 2 && !issuperadmin($id)) {
            safe_query("DELETE FROM " . PREFIX . "user_groups WHERE userID='$id'");
        }

        safe_query("DELETE FROM " . PREFIX . "plugins_squads_members WHERE userID='$id' AND squadID='$squadID'");
    } else {
        echo $_language->module[ 'transaction_invalid' ];
    }
}

if (isset($_POST[ 'saveedit' ])) {
    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_POST[ 'captcha_hash' ])) {
        $id = $_POST[ 'id' ];
        $news_writer = isset($_POST[ 'news_writer' ]);
        $newsadmin = isset($_POST[ 'newsadmin' ]);
        $pollsadmin = isset($_POST[ 'pollsadmin' ]);
        $feedbackadmin = isset($_POST[ 'feedbackadmin' ]);
        $useradmin = isset($_POST[ 'useradmin' ]);
$dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='forum'"));
    if (@$dx[ 'modulname' ] != 'forum') {
        $specialrank = '';
    }else{
        $specialrank = $_POST[ 'special_rank' ];
}        
        $cwadmin = isset($_POST[ 'cwadmin' ]);
        $boardadmin = isset($_POST[ 'boardadmin' ]);
        $moderator = isset($_POST[ 'moderator' ]);
        $pageadmin = isset($_POST[ 'pageadmin' ]);
        $fileadmin = isset($_POST[ 'fileadmin' ]);
        $cashadmin = isset($_POST[ 'cashadmin' ]);
        if (isset($_POST[ 'position' ])) {
            $position = $_POST[ 'position' ];
        } else {
            $position = array();
        }

        #$userdescription = isset($_POST[ 'message' ]);
        if (isset($_POST[ 'message' ])) {
            $userdescription = $_POST[ 'message' ];
        } else {
            $userdescription = '';
        }
        if (isset($_POST[ 'activity' ])) {
            $activity = $_POST[ 'activity' ];
        } else {
            $activity = array();
        }
        if (isset($_POST[ 'join' ])) {
            $join = $_POST[ 'join' ];
        } else {
            $join = array();
        }
        if (isset($_POST[ 'war' ])) {
            $war = $_POST[ 'war' ];
        } else {
            $war = array();
        }
        $gallery = isset($_POST[ 'galleryadmin' ]);

        if ($userID != $id || issuperadmin($userID)) {
            $ergebnis = safe_query("SELECT * FROM " . PREFIX . "user_groups WHERE userID='" . $id . "'");
            if (!mysqli_num_rows($ergebnis)) {
                safe_query("INSERT INTO " . PREFIX . "user_groups (userID) values ('" . $id . "')");
            }
            safe_query(
                    "UPDATE
                        " . PREFIX . "user_groups
                    SET
                        `news` = '" . $newsadmin . "',
                        `news_writer` = '" . $news_writer . "',
                        `polls` = '" . $pollsadmin . "',
                        `feedback` = '" . $feedbackadmin . "',
                        `user` = '" . $useradmin . "',
                        `clanwars` = '" . $cwadmin . "',
                        `forum` = '" . $boardadmin . "',
                        `moderator` = '" . $moderator . "',
                        `page` = '" . $pageadmin . "',
                        `gallery` = '" . $gallery . "',
                        `files` = '" . $fileadmin . "',
                        `cash` = '" . $cashadmin . "'
                    WHERE
                        userID='" . $id . "'"
                );
            //remove from mods
    $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='forum'"));
    if (@$dx[ 'modulname' ] != 'forum') {
    }else{   
            if ($moderator === false) {
                safe_query("DELETE FROM " . PREFIX . "plugins_forum_moderators WHERE userID='" . $id . "'");
            }

            $sql = safe_query("SELECT * FROM " . PREFIX . "plugins_forum_groups");
            while ($dc = mysqli_fetch_array($sql)) {
                $name = $dc[ 'name' ];
                $fgrID = $dc[ 'fgrID' ];
                $abc = safe_query(
                    "SELECT COUNT(*) as anz FROM " . PREFIX . "plugins_forum_user_forum_groups WHERE userID='" . $id . "'"
                );
                $row = mysqli_fetch_array($abc);
                if ($row[ 'anz' ] == 1) {
                    safe_query(
                        "UPDATE " . PREFIX . "plugins_forum_user_forum_groups
                        SET `" . $fgrID . "`='" . isset($_POST[ $fgrID ]) . "'
                        WHERE userID='" . $id . "'"
                    );
                } else {
                    safe_query(
                        "INSERT INTO
                            " . PREFIX . "plugins_forum_user_forum_groups (
                                userID ,
                                `" . $fgrID . "`
                            )
                            VALUES (
                                '" . $id . "',
                                '" . isset($_POST[ $fgrID ]) . "'
                            );"
                    );
                }
            }

            safe_query(
                "UPDATE "
                . PREFIX . "user
                SET
                    special_rank = '" . $specialrank . "'
                WHERE
                    userID='" . $id . "'"
            );
        }

        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='squads'"));
    if (@$dx[ 'modulname' ] != 'squads') {
    }else{

        safe_query(
                "UPDATE "
                . PREFIX . "user
                SET
                    userdescription = '" . $userdescription . "'
                WHERE
                    userID='" . $id . "'"
            );
        }
        

            foreach ($position as $sqmID => $pos) {
                safe_query("UPDATE " . PREFIX . "plugins_squads_members SET position='$pos' WHERE sqmID='$sqmID'");
            }
            foreach ($activity as $sqmID => $act) {
                safe_query("UPDATE " . PREFIX . "plugins_squads_members SET activity='$act' WHERE sqmID='$sqmID'");
            }
            foreach ($join as $sqmID => $joi) {
                safe_query("UPDATE " . PREFIX . "plugins_squads_members SET joinmember='$joi' WHERE sqmID='$sqmID'");
            }
            foreach ($war as $sqmID => $wara) {
                safe_query("UPDATE " . PREFIX . "plugins_squads_members SET warmember='$wara' WHERE sqmID='$sqmID'");
            }
            if (issuperadmin($userID)) {
                safe_query(
                    "UPDATE " . PREFIX . "user_groups
                    SET super='" . isset($_POST[ 'superadmin' ]) . "'
                    WHERE userID='$id'"
                );
            }
        } else {
            redirect('admincenter.php?site=user_rights', $_language->module[ 'error_own_rights' ], 3);
        }
    } else {
        echo $_language->module[ 'transaction_invalid' ];
    }
    
    header("Location: " . $_POST[ 'referer' ]);
}

if (isset($_GET[ 'action' ]) && $_GET[ 'action' ] == "edit") {
    echo '<div class="card">
        <div class="card-header">
            '.$_language->module['users'].'
        </div>
            
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="admincenter.php?site=users">' . $_language->module[ 'users' ] .'</a></li>
    <li class="breadcrumb-item active" aria-current="page">' . $_language->module[ 'edit_member' ] . '</li>
  </ol>
</nav>
     <div class="card-body">';


    $CAPCLASS = new \webspell\Captcha;
    $CAPCLASS->createTransaction();
    $hash = $CAPCLASS->getHash();

    $id = $_GET[ 'id' ];
    $squads = '';
    /*==========================================================*/
    $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='squads'"));
    if (@$dx[ 'modulname' ] != 'squads') {
    }else{            
    $ergebnis =
        safe_query("SELECT * FROM " . PREFIX . "plugins_squads_members WHERE userID='$id' AND squadID!='0' GROUP BY squadID");
    $anz = mysqli_num_rows($ergebnis);
    if ($anz) {
        while ($ds = mysqli_fetch_array($ergebnis)) {
            if ($ds[ 'activity' ]) {
                $activity = ' <select class="form-select" name="activity[' . $ds[ 'sqmID' ] . ']"><option value="1" selected="selected">' .
                    $_language->module[ 'active' ] . '</option><option value="0">' . $_language->module[ 'inactive' ] .
                    '</option></select>';
            } else {
                $activity = ' <select class="form-select col-md-6" name="activity[' . $ds[ 'sqmID' ] . ']"><option value="1">' .
                    $_language->module[ 'active' ] . '</option><option value="0" selected="selected">' .
                    $_language->module[ 'inactive' ] . '</option></select>';
            }
            

            if ($ds[ 'joinmember' ]) {
                $join = '<select class="form-select" name="join[' . $ds[ 'sqmID' ] . ']"><option value="1" selected="selected">' .
                    $_language->module[ 'yes' ] . '</option><option value="0">' . $_language->module[ 'no' ] .
                    '</option></select>';
            } else {
                $join = '<select class="form-select" name="join[' . $ds[ 'sqmID' ] . ']"><option value="1">' . $_language->module[ 'yes' ] .
                    '</option><option value="0" selected="selected">' . $_language->module[ 'no' ] .
                    '</option></select>';
            }
            if ($ds[ 'warmember' ]) {
                $fight = '<select class="form-select" name="war[' . $ds[ 'sqmID' ] . ']"><option value="1" selected="selected">' .
                    $_language->module[ 'yes' ] . '</option><option value="0">' . $_language->module[ 'no' ] .
                    '</option></select>';
            } else {
                $fight = '<select class="form-select" name="war[' . $ds[ 'sqmID' ] . ']"><option value="1">' . $_language->module[ 'yes' ] .
                    '</option><option value="0" selected="selected">' . $_language->module[ 'no' ] .
                    '</option></select>';
            }

$squads .= '




    <div class="mb-3 row bt alert alert-info" role="alert">
    <label class="col-md-2 control-label">' . $_language->module[ 'squad' ] . ':</label>
    <div class="col-md-10">
      <p class="form-control-static"><b>' . getsquadname($ds[ 'squadID' ]) . '</b></p>
    </div>
    </div>
 
<div class="row">
<div class="col-md-12 row">
<div class="col-md-6">
    <div class="mb-3 row bt">
    <label class="col-md-4 control-label">' . $_language->module[ 'position' ] . ':</label>
    <div class="col-md-8">
      <p class="form-control-static"><input class="form-control" type="text" name="position[' . $ds[ 'sqmID' ] . ']" value="' . getinput($ds[ 'position' ]) . '" size="20" /></p>
    </div>
    </div>

    <div class="mb-3 row bt">
    <label class="col-md-4 control-label">' . $_language->module[ 'activity' ] . ':</label>
    <div class="col-md-8">
      <p class="form-control-static">' . $activity . '</p>
    </div>
    </div>

    </div>
    <div class="col-md-6">


    <div class="mb-3 row bt">
    <label class="col-md-5 control-label">' . $_language->module[ 'joinus_admin' ] . ':&nbsp;<small>(' . $_language->module[ 'access_rights' ] . '</small>)</label>
    <div class="col-md-7">
      <p class="form-control-static">' . $join . '</p>
    </div>
    </div>

    <div class="mb-3 row bt">
    <label class="col-md-5 control-label">' . $_language->module[ 'fightus_admin' ] . ':&nbsp;<small>(' . $_language->module[ 'access_rights' ] . '</small>)</label>
    <div class="col-md-7">
      <p class="form-control-static">' . $fight . '</p>
    </div>
    </div>

    
</div>
</div>
</div>

';
        }
    }
}
    if (isnewsadmin($id)) {
        $news =
            '<input class="form-check-input" type="checkbox" name="newsadmin" value="1" data-bs-toggle="tooltip" data-bs-html="true" title="' . $_language->module[ 'tooltip_1' ] . '" checked="checked" />';
    } else {
        $news =
            '<input class="form-check-input" type="checkbox" name="newsadmin" data-on-color="success" value="1" data-bs-toggle="tooltip" data-bs-html="true" title="' . $_language->module[ 'tooltip_1' ] . '">';
    }

    if (isnewswriter($id)) {
        $newswriter =
            '<input class="form-check-input" type="checkbox" name="news_writer" value="1" data-bs-toggle="tooltip" data-bs-html="true" title="' . $_language->module[ 'tooltip_2' ] . '" checked="checked" />';
    } else {
        $newswriter =
            '<input class="form-check-input" type="checkbox" name="news_writer" value="1" data-bs-toggle="tooltip" data-bs-html="true" title="' . $_language->module[ 'tooltip_2' ] . '" />';
    }
$dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='polls'"));
    if (@$dx[ 'modulname' ] != 'polls') {
    }else{
    if (ispollsadmin($id)) {
        $polls =
            '<input class="form-check-input" type="checkbox" name="pollsadmin" value="1" data-bs-toggle="tooltip" data-bs-html="true" title="' . $_language->module[ 'tooltip_3' ] . '" checked="checked" />';
    } else {
        $polls =
            '<input class="form-check-input" type="checkbox" name="pollsadmin" value="1" data-bs-toggle="tooltip" data-bs-html="true" title="' . $_language->module[ 'tooltip_3' ] . '" />';
    }
}
    if (isfeedbackadmin($id)) {
        $feedback =
            '<input class="form-check-input" type="checkbox" name="feedbackadmin" value="1" data-bs-toggle="tooltip" data-bs-html="true" title="' . $_language->module[ 'tooltip_4' ] . '" checked="checked" />';
    } else {
        $feedback =
            '<input class="form-check-input" type="checkbox" name="feedbackadmin" value="1" data-bs-toggle="tooltip" data-bs-html="true" title="' . $_language->module[ 'tooltip_4' ] . '" />';
    }

    if (isuseradmin($id)) {
        $useradmin =
            '<input class="form-check-input" type="checkbox" name="useradmin" value="1" data-bs-toggle="tooltip" data-bs-html="true" title="' . $_language->module[ 'tooltip_5' ] . '" checked="checked" />';
    } else {
        $useradmin =
            '<input class="form-check-input" type="checkbox" name="useradmin" value="1" data-bs-toggle="tooltip" data-bs-html="true" title="' . $_language->module[ 'tooltip_5' ] . '" />';
    }

    if (isclanwarsadmin($id)) {
        $cwadmin =
            '<input class="form-check-input" type="checkbox" name="cwadmin" value="1" data-bs-toggle="tooltip" data-bs-html="true" title="' . $_language->module[ 'tooltip_6' ] . '" checked="checked" />';
    } else {
        $cwadmin =
            '<input class="form-check-input" type="checkbox" name="cwadmin" value="1" data-bs-toggle="tooltip" data-bs-html="true" title="' . $_language->module[ 'tooltip_6' ] . '" />';
    }
$dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='forum'"));
    if (@$dx[ 'modulname' ] != 'forum') {
    }else{

    if (isforumadmin($id)) {
        $board =
            '<input class="form-check-input" type="checkbox" name="boardadmin" value="1" data-bs-toggle="tooltip" data-bs-html="true" title="' . $_language->module[ 'tooltip_7' ] . '" checked="checked" />';
    } else {
        $board =
            '<input class="form-check-input" type="checkbox" name="boardadmin" value="1" data-bs-toggle="tooltip" data-bs-html="true" title="' . $_language->module[ 'tooltip_7' ] . '" />';
    }

    if (isanymoderator($id)) {
        $mod =
            '<input class="form-check-input" type="checkbox" name="moderator" value="1" data-bs-toggle="tooltip" data-bs-html="true" title="' . $_language->module[ 'tooltip_8' ] . '" checked="checked" />';
    } else {
        $mod =
            '<input class="form-check-input" type="checkbox" name="moderator" value="1" data-bs-toggle="tooltip" data-bs-html="true" title="' . $_language->module[ 'tooltip_8' ] . '" />';
    }
}
    if (ispageadmin($id)) {
        $page =
            '<input class="form-check-input" type="checkbox" name="pageadmin" value="1" data-bs-toggle="tooltip" data-bs-html="true" title="' . $_language->module[ 'tooltip_9' ] . '" checked="checked" />';
    } else {
        $page =
            '<input class="form-check-input" type="checkbox" name="pageadmin" value="1" data-bs-toggle="tooltip" data-bs-html="true" title="' . $_language->module[ 'tooltip_9' ] . '" />';
    }

    if (isfilesadmin($id)) {
        $file =
            '<input class="form-check-input" type="checkbox" name="fileadmin" value="1" data-bs-toggle="tooltip" data-bs-html="true" title="' . $_language->module[ 'tooltip_10' ] . '" checked="checked" />';
    } else {
        $file =
            '<input class="form-check-input" type="checkbox" name="fileadmin" value="1" data-bs-toggle="tooltip" data-bs-html="true" title="' . $_language->module[ 'tooltip_10' ] . '" />';
    }

    if (iscashadmin($id)) {
        $cash =
            '<input class="form-check-input" type="checkbox" name="cashadmin" value="1" data-bs-toggle="tooltip" data-bs-html="true" title="' . $_language->module[ 'tooltip_11' ] . '" checked="checked" />';
    } else {
        $cash =
            '<input class="form-check-input" type="checkbox" name="cashadmin" value="1" data-bs-toggle="tooltip" data-bs-html="true" title="' . $_language->module[ 'tooltip_11' ] . '" />';
    }

    if (isgalleryadmin($id)) {
        $gallery =
            '<input class="form-check-input" type="checkbox" name="galleryadmin" value="1" data-bs-toggle="tooltip" data-bs-html="true" title="' . $_language->module[ 'tooltip_12' ] . '" checked="checked" />';
    } else {
        $gallery =
            '<input class="form-check-input" type="checkbox" name="galleryadmin" value="1" data-bs-toggle="tooltip" data-bs-html="true" title="' . $_language->module[ 'tooltip_12' ] . '" />';
    }

    if (issuperadmin($id)) {
        $super =
            '<input class="form-check-input" type="checkbox" name="superadmin" value="1" data-bs-toggle="tooltip" data-bs-html="true" title="' . $_language->module[ 'tooltip_13' ] . '" checked="checked" />';
    } else {
        $super =
            '<input class="form-check-input" type="checkbox" name="superadmin" value="1" data-bs-toggle="tooltip" data-bs-html="true" title="' . $_language->module[ 'tooltip_13' ] . '" />';
    }

$dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='forum'"));
    if (@$dx[ 'modulname' ] != 'forum') {
    }else{  

    $usergrp = array();
    $ergebnis = safe_query("SELECT * FROM " . PREFIX . "plugins_forum_groups");
    while ($ds = mysqli_fetch_array($ergebnis)) {
        $name = $ds[ 'name' ];
        $fgrID = $ds[ 'fgrID' ];
        if (isinusergrp($fgrID, $id)) {
            $usergrp[ $fgrID ] = '<input class="form-check-input" type="checkbox" name="' . $fgrID . '" value="1" checked="checked" />';
        } else {
            $usergrp[ $fgrID ] = '<input class="form-check-input" type="checkbox" name="' . $fgrID . '" value="1" />';
        }
    }
}

$dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='squads'"));
    if (@$dx[ 'modulname' ] != 'squads') {
    }else{

        if (isclanmember($id)) {

        $userdes = '<div class="col-md-12">
            <div class="col-md-12 row"></div>
                <div class="mb-3 row bt">
                    <label class="col-md-4 control-label"><b>' . $_language->module[ 'description' ] . ':</b></label>
                <div class="col-md-8">
                    <p class="form-control-static"></p>
                </div>
                </div>
            <div class="col-md-12"><textarea class="ckeditor" id="ckeditor" rows="5" cols="" name="message" style="width: 100%;">' . getuserdescription($id) . '</textarea><br>
            </div>
            </div>';

    } else {
        $userdes = '';
    }
}


$dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='forum'"));
    if (@$dx[ 'modulname' ] != 'forum') {
    }else{ 
    $get_rank = mysqli_fetch_assoc(
        safe_query(
            "SELECT
              special_rank
            FROM
              " . PREFIX . "user
            WHERE
              userID='" . $id . "'"
        )
    );

    $ranks = "<option value='0'>" . $_language->module[ 'no_special_rank' ] . "</option>";
    $get = safe_query("SELECT * FROM " . PREFIX . "plugins_forum_ranks WHERE special='1'");
    while ($rank = mysqli_fetch_assoc($get)) {
        $ranks .="<option value='" . $rank[ 'rankID' ] . "'>" . $rank[ 'rank' ] . "</option>";
    }
    if ($get_rank[ 'special_rank' ]) {
        $ranks = str_replace(
            "value='" . $get_rank[ 'special_rank'] . "",
            "value='" . $get_rank[ 'special_rank' ] . "' selected='selected'",
            $ranks
        );
    } else {
        $ranks = str_replace("value='0", "value='0' selected='selected'", $ranks);
    }
}
    echo '<script>
        function chkFormular() {
            if(!validbbcode(document.getElementById(\'message\').value, \'admin\')){
                return false;
            }
        }
    </script>';

    echo '
    <form method="post" id="post" name="post" action="admincenter.php?site=user_rights" onsubmit="return chkFormular();">
    <div class="mb-3 row bt alert alert-warning" role="alert">
    <label class="col-md-2 control-label"><h3>' . $_language->module[ 'nickname' ] . ':</h3></label>
    <div class="col-md-8"><a class="form-control-static" href="../index.php?site=profile&amp;id=' . $id . '" target="_blank"><h3>' .
            strip_tags(stripslashes(getnickname($id))) . '</h3></a>
    </div>
    </div>


<div class="row">
<div class="col-md-12">
        
        ' . $squads . '
        ';
      
    $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='squads'"));
    if (@$dx[ 'modulname' ] != 'squads') {
    }else{    
        echo''.$userdes.'';
    }
    echo' 


    <div class="mb-3 row bt">
    <label class="col-md-4 control-label"><b>' . $_language->module[ 'access_rights' ] . ':</b></label>
    <div class="col-md-8">
      <p class="form-control-static"></p>
    </div>
    </div>
<hr>

<div class="row">

<div class="col-md-4">
    <div class="mb-3 row bt">
    <label class="col-md-6 control-label">' . $_language->module[ 'news_admin' ] . ':</b></label>
    <div class="col-md-6 form-check form-switch">' . $news . '
    </div>
    </div>

    <div class="mb-3 row bt">
    <label class="col-md-6 control-label">' . $_language->module[ 'news_writer' ] . ':</b></label>
    <div class="col-md-6 form-check form-switch">' . $newswriter . '
    </div>
    </div>';
$dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='polls'"));
    if (@$dx[ 'modulname' ] != 'polls') {
    }else{echo'
    <div class="mb-3 row bt">
    <label class="col-md-6 control-label">' . $_language->module[ 'polls_admin' ] . ':</b></label>
    <div class="col-md-6 form-check form-switch">' . $polls . '
    </div>
    </div>';
    }

echo '

    <div class="mb-3 row bt">
    <label class="col-md-6 control-label">' . $_language->module[ 'feedback_admin' ] . ':</b></label>
    <div class="col-md-6 form-check form-switch">' . $feedback . '
    </div>
    </div>

';
 if (issuperadmin($userID)) {
echo '<div class="mb-3 row bt alert alert-warning" role="alert">
    <label class="col-md-6 control-label">' . $_language->module[ 'super_admin' ] . ':</b></label>
    <div class="col-md-6 form-check form-switch">' . $super . '
    </div>
    </div>';
    }

echo '
<br>
</div>

<div class="col-md-4">';
$dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='forum'"));
    if (@$dx[ 'modulname' ] != 'forum') {
    }else{ 
        echo'
    <div class="mb-3 row bt">
    <label class="col-md-6 control-label">' . $_language->module[ 'messageboard_admin' ] . ':</b></label>
    <div class="col-md-6 form-check form-switch">' . $board . '
    </div>
    </div>

    <div class="mb-3 row bt">
    <label class="col-md-6 control-label">' . $_language->module[ 'messageboard_moderator' ] . ':</b></label>
    <div class="col-md-6 form-check form-switch">' . $mod . '
    </div>
    </div>';
}
echo'
    <div class="mb-3 row bt">
    <label class="col-md-6 control-label">' . $_language->module[ 'gallery_admin' ] . ':</b></label>
    <div class="col-md-6 form-check form-switch">' . $gallery . '
    </div>
    </div>

    <div class="mb-3 row bt">
    <label class="col-md-6 control-label">' . $_language->module[ 'page_admin' ] . ':</b></label>
    <div class="col-md-6 form-check form-switch">' . $page . '
    </div>
    </div>

</div>

<div class="col-md-4">';
$dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='clanwar'"));
    if (@$dx[ 'modulname' ] != 'clanwar') {
    }else{ 
        echo'

    <div class="mb-3 row bt">
    <label class="col-md-6 control-label">' . $_language->module[ 'clanwar_admin' ] . ':</b></label>
    <div class="col-md-6 form-check form-switch">' . $cwadmin . '
    </div>
    </div>';
}
$dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='cashbox'"));
    if (@$dx[ 'modulname' ] != 'cashbox') {
    }else{ 
echo'<div class="mb-3 row bt">
    <label class="col-md-6 control-label">' . $_language->module[ 'cash_admin' ] . ':</b></label>
    <div class="col-md-6 form-check form-switch">' . $cash . '
    </div>
    </div>';
}
echo'<div class="mb-3 row bt">
    <label class="col-md-6 control-label">' . $_language->module[ 'user_admin' ] . ':</b></label>
    <div class="col-md-6 form-check form-switch">' . $useradmin . '
    </div>
    </div>

    <div class="mb-3 row bt">
    <label class="col-md-6 control-label">' . $_language->module[ 'file_admin' ] . ':</b></label>
    <div class="col-md-6 form-check form-switch">' . $file . '
    </div>
    </div>

</div>';
$dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='forum'"));
    if (@$dx[ 'modulname' ] != 'forum') {
    }else{ 
        echo'
<br><br>

<div class="col-md-12">

    <div class="mb-3 row bt">
    <label class="col-md-4 control-label"><b>' . $_language->module[ 'group_access' ] . ':</b></label>
    <div class="col-md-8">
      <p class="form-control-static"></p>
    </div>
    </div>
 


    <div class="mb-3 row bt">
    <label class="col-md-2 control-label">' . $_language->module[ 'special_rank' ] . ':</b></label>
    <div class="col-md-4">
      <select class="form-select" name="special_rank">' . $ranks . '</select>
    </div>
    </div>

';

    $sql = safe_query("SELECT * FROM " . PREFIX . "plugins_forum_groups");
    
    $i = 1;
    while ($dc = mysqli_fetch_array($sql)) {
        $name = $dc[ 'name' ];
        $fgrID = $dc[ 'fgrID' ];
        echo '<div class="mb-3 row bt"><label class="col-md-2 control-label">' . $name . ':</b></label>
    <div class="col-md-4 form-check form-switch">' . $usergrp[ $fgrID ] . '
    </div>
    </div>
    ';
        
        $i++;
    }
}

echo '</div></div>  


<div class="col-md-12"><br>
<input type="hidden" name="id" value="' . $id . '" /><input type="hidden" name="captcha_hash" value="' .
        $hash . '" /><input type="hidden" name="referer" value="'.$_GET['referer'].'">

      <input class="btn btn-warning" type="submit" name="saveedit" value="' . $_language->module[ 'edit_member' ] . '" />
    </div>

</form>
  </div></div>';

    unset($squads);
    unset($userdes);

} elseif ($action == "addtoclan") {
    echo '<div class="card">
        <div class="card-header">
            ' . $_language->module[ 'users' ] . '
        </div>
            
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="admincenter.php?site=users">' . $_language->module[ 'users' ] . '</a></li>
    <li class="breadcrumb-item active" aria-current="page">' . $_language->module[ 'add_to_clan' ] . '</li>
  </ol>
</nav>
     <div class="card-body">';

    $id = $_GET[ 'id' ];
    $nickname = getnickname($id);
    $squads = getsquads();
    $CAPCLASS = new \webspell\Captcha;
    $CAPCLASS->createTransaction();
    $hash = $CAPCLASS->getHash();

    



 #echo'<form class="form-horizontal" method="post" action="admincenter.php?site=users&amp;page='.(int)$_GET['page'].'">
 
 echo'<form class="form-horizontal" method="post" action="admincenter.php?site=user_rights">
    <div class="mb-3 row">
        <label class="col-md-2 control-label">'.$_language->module['nickname'].':</label>
        <div class="col-md-8"><h4>'.$nickname.'</h4>
        </div>
    </div>

    <div class="mb-3 row">
        <label class="col-md-2 control-label">'.$_language->module['squad'].':</label>
        <div class="col-md-8"><select class="form-select" name="squad">'.$squads.'</select>
        </div>
    </div>

    <div class="mb-3 row">
        <label class="col-md-2 control-label">'.$_language->module['position'].':</label>
        <div class="col-md-8"><input class="form-control" type="text" name="position" size="20" />
        </div>
    </div>
 
    <div class="mb-3 row">
        <label class="col-md-2 control-label">'.$_language->module['activity'].':</label>
        <div class="col-md-8 form-check form-switch">
        <input class="form-check-input" type="radio" name="activity" value="1" checked="checked" />&nbsp;&nbsp;'.$_language->module['active'].'  <br><br>
        <input class="form-check-input" type="radio" name="activity" value="0" />&nbsp;&nbsp;'.$_language->module['inactive'].'
        </div>
    </div>

    <div class="mb-3 row">
        <div class="col-md-offset-2 col-md-8"><input type="hidden" name="captcha_hash" value="'.$hash.'" /><input type="hidden" name="id" value="'.$id.'" />
        <button class="btn btn-success" type="submit" name="add_to_clan">'.$_language->module['add_to_clan'].'</button>
        </div>
    </div>
  </form>
  </div></div>';    
} else {
    

}
