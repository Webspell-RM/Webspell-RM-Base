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

$_language->readModule('members', false, true);
$_language->readModule('rank_special', true, true);

$ergebnis = safe_query("SELECT * FROM ".PREFIX."navigation_dashboard_links WHERE modulname='members'");
    while ($db=mysqli_fetch_array($ergebnis)) {
      $accesslevel = 'is'.$db['accesslevel'].'admin';

if (!$accesslevel($userID) || mb_substr(basename($_SERVER[ 'REQUEST_URI' ]), 0, 15) != "admincenter.php") {
    die($_language->module[ 'access_denied' ]);
}
}

if (isset($_POST[ 'sortieren' ])) {
    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_POST[ 'captcha_hash' ])) {
        if (isset($_POST[ 'sort' ])) {
            $sort = $_POST[ 'sort' ];
            if (is_array($sort)) {
                foreach ($sort as $sortstring) {
                    $sorter = explode("-", $sortstring);
                    safe_query("UPDATE " . PREFIX . "squads_members SET sort='$sorter[1]' WHERE sqmID='$sorter[0]' ");
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
        $squads = mysqli_num_rows(safe_query("SELECT userID FROM " . PREFIX . "squads_members WHERE userID='$id'"));
        if ($squads < 2 && !issuperadmin($id)) {
            safe_query("DELETE FROM " . PREFIX . "user_groups WHERE userID='$id'");
        }

        safe_query("DELETE FROM " . PREFIX . "squads_members WHERE userID='$id' AND squadID='$squadID'");
    } else {
        echo $_language->module[ 'transaction_invalid' ];
    }
}

if (isset($_POST[ 'saveedit' ])) {
    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_POST[ 'captcha_hash' ])) {
        $id = $_POST[ 'id' ];
        $newswriter = isset($_POST[ 'newswriter' ]);
        $newsadmin = isset($_POST[ 'newsadmin' ]);
        $pollsadmin = isset($_POST[ 'pollsadmin' ]);
        $feedbackadmin = isset($_POST[ 'feedbackadmin' ]);
        $useradmin = isset($_POST[ 'useradmin' ]);
        $specialrank = $_POST[ 'special_rank' ];
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
                        `news_writer` = '" . $newswriter . "',
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
            if ($moderator === false) {
                safe_query("DELETE FROM " . PREFIX . "plugins_forum_moderators WHERE userID='" . $id . "'");
            }

            $sql = safe_query("SELECT * FROM " . PREFIX . "plugins_forum_groups");
            while ($dc = mysqli_fetch_array($sql)) {
                $name = $dc[ 'name' ];
                $fgrID = $dc[ 'fgrID' ];
                $abc = safe_query(
                    "SELECT COUNT(*) as anz FROM " . PREFIX . "user_forum_groups WHERE userID='" . $id . "'"
                );
                $row = mysqli_fetch_array($abc);
                if ($row[ 'anz' ] == 1) {
                    safe_query(
                        "UPDATE " . PREFIX . "user_forum_groups
                        SET `" . $fgrID . "`='" . isset($_POST[ $fgrID ]) . "'
                        WHERE userID='" . $id . "'"
                    );
                } else {
                    safe_query(
                        "INSERT INTO
                            " . PREFIX . "user_forum_groups (
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
                    userdescription='" . $userdescription . "',
                    special_rank = '" . $specialrank . "'
                WHERE
                    userID='" . $id . "'"
            );

            foreach ($position as $sqmID => $pos) {
                safe_query("UPDATE " . PREFIX . "squads_members SET position='$pos' WHERE sqmID='$sqmID'");
            }
            foreach ($activity as $sqmID => $act) {
                safe_query("UPDATE " . PREFIX . "squads_members SET activity='$act' WHERE sqmID='$sqmID'");
            }
            foreach ($join as $sqmID => $joi) {
                safe_query("UPDATE " . PREFIX . "squads_members SET joinmember='$joi' WHERE sqmID='$sqmID'");
            }
            foreach ($war as $sqmID => $wara) {
                safe_query("UPDATE " . PREFIX . "squads_members SET warmember='$wara' WHERE sqmID='$sqmID'");
            }
            if (issuperadmin($userID)) {
                safe_query(
                    "UPDATE " . PREFIX . "user_groups
                    SET super='" . isset($_POST[ 'superadmin' ]) . "'
                    WHERE userID='$id'"
                );
            }
        } else {
            redirect('admincenter.php?site=members', $_language->module[ 'error_own_rights' ], 3);
        }
    } else {
        echo $_language->module[ 'transaction_invalid' ];
    }
    redirect('admincenter.php?site=users','', 0);
}

if (isset($_GET[ 'action' ]) && $_GET[ 'action' ] == "edit") {
    echo '<div class="card">
        <div class="card-header">
            <i class="fas fa-users"></i> '.$_language->module['members'].'
        </div>
            
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="admincenter.php?site=members">' . $_language->module[ 'members' ] .'</a></li>
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
    $ergebnis =
        safe_query("SELECT * FROM " . PREFIX . "squads_members WHERE userID='$id' AND squadID!='0' GROUP BY squadID");
    $anz = mysqli_num_rows($ergebnis);
    if ($anz) {
        while ($ds = mysqli_fetch_array($ergebnis)) {
            if ($ds[ 'activity' ]) {
                $activity = ' <select class="form-control" name="activity[' . $ds[ 'sqmID' ] . ']"><option value="1" selected="selected">' .
                    $_language->module[ 'active' ] . '</option><option value="0">' . $_language->module[ 'inactive' ] .
                    '</option></select>';
            } else {
                $activity = ' <select class="form-control col-md-6" name="activity[' . $ds[ 'sqmID' ] . ']"><option value="1">' .
                    $_language->module[ 'active' ] . '</option><option value="0" selected="selected">' .
                    $_language->module[ 'inactive' ] . '</option></select>';
            }
            

            if ($ds[ 'joinmember' ]) {
                $join = '<select class="form-control" name="join[' . $ds[ 'sqmID' ] . ']"><option value="1" selected="selected">' .
                    $_language->module[ 'yes' ] . '</option><option value="0">' . $_language->module[ 'no' ] .
                    '</option></select>';
            } else {
                $join = '<select class="form-control" name="join[' . $ds[ 'sqmID' ] . ']"><option value="1">' . $_language->module[ 'yes' ] .
                    '</option><option value="0" selected="selected">' . $_language->module[ 'no' ] .
                    '</option></select>';
            }
            if ($ds[ 'warmember' ]) {
                $fight = '<select class="form-control" name="war[' . $ds[ 'sqmID' ] . ']"><option value="1" selected="selected">' .
                    $_language->module[ 'yes' ] . '</option><option value="0">' . $_language->module[ 'no' ] .
                    '</option></select>';
            } else {
                $fight = '<select class="form-control" name="war[' . $ds[ 'sqmID' ] . ']"><option value="1">' . $_language->module[ 'yes' ] .
                    '</option><option value="0" selected="selected">' . $_language->module[ 'no' ] .
                    '</option></select>';
            }

$squads .= '<div class="col-md-6">
<div class="col-md-12"></div>
    <div class="form-group row bt">
    <label class="col-md-4 control-label">' . $_language->module[ 'squad' ] . ':</label>
    <div class="col-md-8">
      <p class="form-control-static">' . getsquadname($ds[ 'squadID' ]) . '</p>
    </div>
    </div>

    <div class="form-group row bt">
    <label class="col-md-4 control-label">' . $_language->module[ 'position' ] . ':</label>
    <div class="col-md-8">
      <p class="form-control-static"><input class="form-control" type="text" name="position[' . $ds[ 'sqmID' ] . ']" value="' . getinput($ds[ 'position' ]) . '" size="20" /></p>
    </div>
    </div>

    <div class="form-group row bt">
    <label class="col-md-4 control-label">' . $_language->module[ 'activity' ] . ':</label>
    <div class="col-md-8">
      <p class="form-control-static">' . $activity . '</p>
    </div>
    </div>

    </div>
    <div class="col-md-6">
<div class="col-md-12"></div>
    <div class="form-group row bt">
    <label class="col-md-4 control-label">' . $_language->module[ 'joinus_admin' ] . ':<br><small>(' . $_language->module[ 'access_rights' ] . '</small>)</label>
    <div class="col-md-8">
      <p class="form-control-static">' . $join . '</p>
    </div>
    </div>

    <div class="form-group row bt">
    <label class="col-md-4 control-label">' . $_language->module[ 'fightus_admin' ] . ':<br><small>(' . $_language->module[ 'access_rights' ] . '</small>)</label>
    <div class="col-md-8">
      <p class="form-control-static">' . $fight . '</p>
    </div>
    </div>

</div>


';
        }
    }

    if (isnewsadmin($id)) {
        $news =
            '<input id="switch-onColor" type="checkbox" data-on-color="success" data-off-color="danger" name="newsadmin" value="1" onmouseover="showWMTT(\'id1\')"
onmouseout="hideWMTT()" checked="checked" />';
    } else {
        $news =
            '<input id="switch-onColor" type="checkbox" data-on-color="success" data-off-color="danger" name="newsadmin" value="1" onmouseover="showWMTT(\'id1\')"
onmouseout="hideWMTT()">';
    }

    if (isnewswriter($id)) {
        $newswriter =
            '<input id="switch-onColor" type="checkbox" data-on-color="success" data-off-color="danger" name="newswriter" value="1" onmouseover="showWMTT(\'id2\')"
onmouseout="hideWMTT()" checked="checked" />';
    } else {
        $newswriter =
            '<input id="switch-onColor" type="checkbox" data-on-color="success" data-off-color="danger" name="newswriter" value="1" onmouseover="showWMTT(\'id2\')"
onmouseout="hideWMTT()" />';
    }

    if (ispollsadmin($id)) {
        $polls =
            '<input id="switch-onColor" type="checkbox" data-on-color="success" data-off-color="danger" name="pollsadmin" value="1" onmouseover="showWMTT(\'id3\')"
onmouseout="hideWMTT()" checked="checked" />';
    } else {
        $polls =
            '<input id="switch-onColor" type="checkbox" data-on-color="success" data-off-color="danger" name="pollsadmin" value="1" onmouseover="showWMTT(\'id3\')"
onmouseout="hideWMTT()" />';
    }

    if (isfeedbackadmin($id)) {
        $feedback =
            '<input id="switch-onColor" type="checkbox" data-on-color="success" data-off-color="danger" name="feedbackadmin" value="1" onmouseover="showWMTT(\'id4\')"
onmouseout="hideWMTT()" checked="checked" />';
    } else {
        $feedback =
            '<input id="switch-onColor" type="checkbox" data-on-color="success" data-off-color="danger" name="feedbackadmin" value="1" onmouseover="showWMTT(\'id4\')"
onmouseout="hideWMTT()" />';
    }

    if (isuseradmin($id)) {
        $useradmin =
            '<input id="switch-onColor" type="checkbox" data-on-color="success" data-off-color="danger" name="useradmin" value="1" onmouseover="showWMTT(\'id5\')"
onmouseout="hideWMTT()" checked="checked" />';
    } else {
        $useradmin =
            '<input id="switch-onColor" type="checkbox" data-on-color="success" data-off-color="danger" name="useradmin" value="1" onmouseover="showWMTT(\'id5\')"
onmouseout="hideWMTT()" />';
    }

    if (isclanwarsadmin($id)) {
        $cwadmin =
            '<input id="switch-onColor" type="checkbox" data-on-color="success" data-off-color="danger" name="cwadmin" value="1" onmouseover="showWMTT(\'id6\')"
onmouseout="hideWMTT()" checked="checked" />';
    } else {
        $cwadmin =
            '<input id="switch-onColor" type="checkbox" data-on-color="success" data-off-color="danger" name="cwadmin" value="1" onmouseover="showWMTT(\'id6\')"
onmouseout="hideWMTT()" />';
    }

    if (isforumadmin($id)) {
        $board =
            '<input id="switch-onColor" type="checkbox" data-on-color="success" data-off-color="danger" name="boardadmin" value="1" onmouseover="showWMTT(\'id7\')"
onmouseout="hideWMTT()" checked="checked" />';
    } else {
        $board =
            '<input id="switch-onColor" type="checkbox" data-on-color="success" data-off-color="danger" name="boardadmin" value="1" onmouseover="showWMTT(\'id7\')"
onmouseout="hideWMTT()" />';
    }

    if (isanymoderator($id)) {
        $mod =
            '<input id="switch-onColor" type="checkbox" data-on-color="success" data-off-color="danger" name="moderator" value="1" onmouseover="showWMTT(\'id8\')"
onmouseout="hideWMTT()" checked="checked" />';
    } else {
        $mod =
            '<input id="switch-onColor" type="checkbox" data-on-color="success" data-off-color="danger" name="moderator" value="1" onmouseover="showWMTT(\'id8\')"
onmouseout="hideWMTT()" />';
    }

    if (ispageadmin($id)) {
        $page =
            '<input id="switch-onColor" type="checkbox" data-on-color="success" data-off-color="danger" name="pageadmin" value="1" onmouseover="showWMTT(\'id9\')"
onmouseout="hideWMTT()" checked="checked" />';
    } else {
        $page =
            '<input id="switch-onColor" type="checkbox" data-on-color="success" data-off-color="danger" name="pageadmin" value="1" onmouseover="showWMTT(\'id9\')"
onmouseout="hideWMTT()" />';
    }

    if (isfilesadmin($id)) {
        $file =
            '<input id="switch-onColor" type="checkbox" data-on-color="success" data-off-color="danger" name="fileadmin" value="1" onmouseover="showWMTT(\'id10\')"
onmouseout="hideWMTT()" checked="checked" />';
    } else {
        $file =
            '<input id="switch-onColor" type="checkbox" data-on-color="success" data-off-color="danger" name="fileadmin" value="1" onmouseover="showWMTT(\'id10\')"
onmouseout="hideWMTT()" />';
    }

    if (iscashadmin($id)) {
        $cash =
            '<input type="checkbox" name="cashadmin" value="1" onmouseover="showWMTT(\'id11\')"
onmouseout="hideWMTT()" checked="checked" />';
    } else {
        $cash =
            '<input id="switch-onColor" type="checkbox" data-on-color="success" data-off-color="danger" name="cashadmin" value="1" onmouseover="showWMTT(\'id11\')"
onmouseout="hideWMTT()" />';
    }

    if (isgalleryadmin($id)) {
        $gallery =
            '<input id="switch-onColor" type="checkbox" data-on-color="success" data-off-color="danger" name="galleryadmin" value="1" onmouseover="showWMTT(\'id12\')"
onmouseout="hideWMTT()" checked="checked" />';
    } else {
        $gallery =
            '<input id="switch-onColor" type="checkbox" data-on-color="success" data-off-color="danger" name="galleryadmin" value="1" onmouseover="showWMTT(\'id12\')"
onmouseout="hideWMTT()" />';
    }

    if (issuperadmin($id)) {
        $super =
            '<input id="switch-onColor" type="checkbox" data-on-color="success" data-off-color="danger" name="superadmin" value="1" onmouseover="showWMTT(\'id13\')"
onmouseout="hideWMTT()" checked="checked" />';
    } else {
        $super =
            '<input id="switch-onColor" type="checkbox" data-on-color="success" data-off-color="danger" name="superadmin" value="1" onmouseover="showWMTT(\'id13\')"
onmouseout="hideWMTT()" />';
    }

    $usergrp = array();
    $ergebnis = safe_query("SELECT * FROM " . PREFIX . "plugins_forum_groups");
    while ($ds = mysqli_fetch_array($ergebnis)) {
        $name = $ds[ 'name' ];
        $fgrID = $ds[ 'fgrID' ];
        if (isinusergrp($fgrID, $id)) {
            $usergrp[ $fgrID ] = '<input id="switch-onColor" type="checkbox" data-on-color="success" data-off-color="danger" name="' . $fgrID . '" value="1" checked="checked" />';
        } else {
            $usergrp[ $fgrID ] = '<input id="switch-onColor" type="checkbox" data-on-color="success" data-off-color="danger" name="' . $fgrID . '" value="1" />';
        }
    }

    if (isclanmember($id)) {

        $userdes = '<div class="col-md-12">
            <div class="col-md-12 row"></div>
                <div class="form-group row bt">
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

    echo '<script>
        function chkFormular() {
            if(!validbbcode(document.getElementById(\'message\').value, \'admin\')){
                return false;
            }
        }
    </script>';

    echo '
    <form method="post" id="post" name="post" action="admincenter.php?site=members" onsubmit="return chkFormular();">
        <div class="tooltip" id="id1">' . $_language->module[ 'tooltip_1' ] . '</div>
        <div class="tooltip" id="id2">' . $_language->module[ 'tooltip_2' ] . '</div>
        <div class="tooltip" id="id3">' . $_language->module[ 'tooltip_3' ] . '</div>
        <div class="tooltip" id="id4">' . $_language->module[ 'tooltip_4' ] . '</div>
        <div class="tooltip" id="id5">' . $_language->module[ 'tooltip_5' ] . '</div>
        <div class="tooltip" id="id6">' . $_language->module[ 'tooltip_6' ] . '</div>
        <div class="tooltip" id="id7">' . $_language->module[ 'tooltip_7' ] . '</div>
        <div class="tooltip" id="id8">' . $_language->module[ 'tooltip_8' ] . '</div>
        <div class="tooltip" id="id9">' . $_language->module[ 'tooltip_9' ] . '</div>
        <div class="tooltip" id="id10">' . $_language->module[ 'tooltip_10' ] . '</div>
        <div class="tooltip" id="id11">' . $_language->module[ 'tooltip_11' ] . '</div>
        <div class="tooltip" id="id12">' . $_language->module[ 'tooltip_12' ] . '</div>
        <div class="tooltip" id="id13">' . $_language->module[ 'tooltip_13' ] . '</div>
        
        



<div class="">

    <div class="form-group row bt alert alert-warning" role="alert">
    <label class="col-md-2 control-label"><h3>' . $_language->module[ 'nickname' ] . ':</h3></label>
    <div class="col-md-8"><a class="form-control-static" href="../index.php?site=profile&amp;id=' . $id . '" target="_blank"><h3>' .
            strip_tags(stripslashes(getnickname($id))) . '</h3></a>
    </div>
    </div>
</div>

<div class="row">

        
        ' . $squads . '
    
        ' . $userdes . '
 
<div class="col-md-12">

    <div class="form-group row bt">
    <label class="col-md-4 control-label"><b>' . $_language->module[ 'access_rights' ] . ':</b></label>
    <div class="col-md-8">
      <p class="form-control-static"></p>
    </div>
    </div>
<hr>

<div class="row">

<div class="col-md-4">
    <div class="form-group row bt">
    <label class="col-md-6 control-label">' . $_language->module[ 'news_admin' ] . ':</b></label>
    <div class="col-md-6">
      <p class="form-control-static">' . $news . '</p>
    </div>
    </div>

    <div class="form-group row bt">
    <label class="col-md-6 control-label">' . $_language->module[ 'news_writer' ] . ':</b></label>
    <div class="col-md-6">
      <p class="form-control-static">' . $newswriter . '</p>
    </div>
    </div>

    <div class="form-group row bt">
    <label class="col-md-6 control-label">' . $_language->module[ 'polls_admin' ] . ':</b></label>
    <div class="col-md-6">
      <p class="form-control-static">' . $polls . '</p>
    </div>
    </div>

    <div class="form-group row bt">
    <label class="col-md-6 control-label">' . $_language->module[ 'feedback_admin' ] . ':</b></label>
    <div class="col-md-6">
      <p class="form-control-static">' . $feedback . '</p>
    </div>
    </div>

';
 if (issuperadmin($userID)) {
echo '<div class="form-group row bt alert alert-warning" role="alert">
    <label class="col-md-6 control-label">' . $_language->module[ 'super_admin' ] . ':</b></label>
    <div class="col-md-6">
      <p class="form-control-static">' . $super . '</p>
    </div>
    </div>';
    }

echo '
<br>
</div>

<div class="col-md-4">
    <div class="form-group row bt">
    <label class="col-md-6 control-label">' . $_language->module[ 'messageboard_admin' ] . ':</b></label>
    <div class="col-md-6">
      <p class="form-control-static">' . $board . '</p>
    </div>
    </div>

    <div class="form-group row bt">
    <label class="col-md-6 control-label">' . $_language->module[ 'messageboard_moderator' ] . ':</b></label>
    <div class="col-md-6">
      <p class="form-control-static">' . $mod . '</p>
    </div>
    </div>

    <div class="form-group row bt">
    <label class="col-md-6 control-label">' . $_language->module[ 'gallery_admin' ] . ':</b></label>
    <div class="col-md-6">
      <p class="form-control-static">' . $gallery . '</p>
    </div>
    </div>

    <div class="form-group row bt">
    <label class="col-md-6 control-label">' . $_language->module[ 'page_admin' ] . ':</b></label>
    <div class="col-md-6">
      <p class="form-control-static">' . $page . '</p>
    </div>
    </div>

</div>

<div class="col-md-4">

    <div class="form-group row bt">
    <label class="col-md-6 control-label">' . $_language->module[ 'clanwar_admin' ] . ':</b></label>
    <div class="col-md-6">
      <p class="form-control-static">' . $cwadmin . '</p>
    </div>
    </div>

    <div class="form-group row bt">
    <label class="col-md-6 control-label">' . $_language->module[ 'cash_admin' ] . ':</b></label>
    <div class="col-md-6">
      <p class="form-control-static">' . $cash . '</p>
    </div>
    </div>

    <div class="form-group row bt">
    <label class="col-md-6 control-label">' . $_language->module[ 'user_admin' ] . ':</b></label>
    <div class="col-md-6">
      <p class="form-control-static">' . $useradmin . '</p>
    </div>
    </div>

    <div class="form-group row bt">
    <label class="col-md-6 control-label">' . $_language->module[ 'file_admin' ] . ':</b></label>
    <div class="col-md-6">
      <p class="form-control-static">' . $file . '</p>
    </div>
    </div>

</div>

<br><br>

<div class="col-md-12">

    <div class="form-group row bt">
    <label class="col-md-4 control-label"><b>' . $_language->module[ 'group_access' ] . ':</b></label>
    <div class="col-md-8">
      <p class="form-control-static"></p>
    </div>
    </div>
 


    <div class="form-group row bt">
    <label class="col-md-2 control-label">' . $_language->module[ 'special_rank' ] . ':</b></label>
    <div class="col-md-4">
      <p class="form-control-static"><select class="form-control" name="special_rank">' . $ranks . '</select></p>
    </div>
    </div>

';

    $sql = safe_query("SELECT * FROM " . PREFIX . "plugins_forum_groups");
    
    $i = 1;
    while ($dc = mysqli_fetch_array($sql)) {
        $name = $dc[ 'name' ];
        $fgrID = $dc[ 'fgrID' ];
        echo '<div class="form-group row bt"><label class="col-md-2 control-label">' . $name . ':</b></label>
    <div class="col-md-4">
      <p class="form-control-static">' . $usergrp[ $fgrID ] . '</p></div>
    </div>
    ';
        
        $i++;
    }

echo '</div></div>  


<div class="col-md-12"><br>
<input type="hidden" name="id" value="' . $id . '" /><input type="hidden" name="captcha_hash" value="' .
        $hash . '" />
      <input class="btn btn-warning" type="submit" name="saveedit" value="' . $_language->module[ 'edit_member' ] . '" />
    </div>

</form>
  </div></div>';

    unset($squads);
    unset($userdes);
} else {
    
    $CAPCLASS = new \webspell\Captcha;
    $CAPCLASS->createTransaction();
    $hash = $CAPCLASS->getHash();
echo'<div class="card">
        <div class="card-header">
            <i class="fas fa-users"></i> '.$_language->module['members'].'
        </div>
            
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">' . $_language->module[ 'members' ] .'</li>
  </ol>
</nav>
     <div class="card-body">';

    $squads = safe_query("SELECT * FROM " . PREFIX . "squads ORDER BY sort");
    echo '<form method="post" action="admincenter.php?site=members">';
    while ($ds = mysqli_fetch_array($squads)) {
        echo'<div class="card">
        <div class="card-header">
            <i class="fas fa-users"></i> ' . $ds[ 'name' ] . ' <span class="small"><em>'.$_language->module['members'].'</em></span>
        </div>
            
<div class="card-body">';
        echo '<table class="table table-striped">
    
<thead>';

        $members = safe_query(
            "SELECT * FROM " . PREFIX . "squads_members WHERE squadID='" . $ds[ 'squadID' ] . "' ORDER BY sort"
        );
        $tmp = mysqli_fetch_assoc(
            safe_query(
                "SELECT count(squadID) as cnt
                FROM " . PREFIX . "squads_members
                WHERE squadID='" . $ds[ 'squadID' ] . "'"
            )
        );
        $anzmembers = $tmp[ 'cnt' ];

        echo '<tr>
      <th>' . $_language->module[ 'nickname' ] . ':</th>
      <th>' . $_language->module[ 'position' ] . ':</th>
      <th>' . $_language->module[ 'activity' ] . ':</th>
      <th>' . $_language->module[ 'actions' ] . ':</th>
      <th>' . $_language->module[ 'sort' ] . ':</th>
    </tr></thead>
          <tbody>';

        $i = 1;
        while ($dm = mysqli_fetch_array($members)) {
            if ($i % 2) {
                $td = 'td1';
            } else {
                $td = 'td2';
            }

            $nickname = '<a href="../index.php?site=profile&amp;id=' . $dm[ 'userID' ] . '" target="_blank">' .
                strip_tags(stripslashes(getnickname($dm[ 'userID' ]))) . '</a>';
            if ($dm[ 'activity' ]) {
                $activity = '<font color="green">' . $_language->module[ 'active' ] . '</font>';
            } else {
                $activity = '<font color="red">' . $_language->module[ 'inactive' ] . '</font>';
            }

            echo '<tr>
        <td>' . $nickname . '</td>
        <td>' . $dm[ 'position' ] . '</td>
        <td>' . $activity . '</td>
        <td>


        <a href="admincenter.php?site=members&amp;action=edit&amp;id=' . $dm[ 'userID' ] . '" class="hidden-xs hidden-sm btn btn-warning" type="button">' . $_language->module[ 'edit' ] . '</a>

        <input class="btn btn-danger" type="button" onclick="MM_confirm(\'' . $_language->module['really_delete'] . '\', \'admincenter.php?site=members&amp;delete=true&amp;id=' . $dm[ 'userID' ] . '&amp;squadID=' . $dm[ 'squadID' ] . '&amp;captcha_hash=' . $hash . '\')" value="' . $_language->module['delete'] . '" />     

       
    </td>
        <td><select name="sort[]">';
            for ($j = 1; $j <= $anzmembers; $j++) {
                if ($dm[ 'sort' ] == $j) {
                    echo '<option value="' . $dm[ 'sqmID' ] . '-' . $j . '" selected="selected">' . $j . '</option>';
                } else {
                    echo '<option value="' . $dm[ 'sqmID' ] . '-' . $j . '">' . $j . '</option>';
                }
            }
            echo '</select></td>
        </tr>';

            $i++;
        }


        echo '</tbody></table> <div align="right"><input type="hidden" name="captcha_hash" value="' . $hash .
        '" /><input type="submit" name="sortieren" class="btn btn-primary" value="' . $_language->module[ 'to_sort' ] . '" /></div></div>
        </div>';
    }
    echo '
        </form></div>
        </div>
       <br />';

}
