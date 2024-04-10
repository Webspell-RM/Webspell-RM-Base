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

$_language->readModule('users', false, true);
$_language->readModule('rank_special', true, true);

$ergebnis = safe_query("SELECT * FROM ".PREFIX."navigation_dashboard_links WHERE modulname='ac_users'");
    while ($db=mysqli_fetch_array($ergebnis)) {
      $accesslevel = 'is'.$db['accesslevel'].'admin';

if (!$accesslevel($userID) || mb_substr(basename($_SERVER[ 'REQUEST_URI' ]), 0, 15) != "admincenter.php") {
    die($_language->module[ 'access_denied' ]);
}
}

if (isset($_POST[ 'edit' ])) {
    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_POST[ 'captcha_hash' ])) {
        $id = $_POST[ 'id' ];

        $error_array = array();

        //avatar
        $filepath = "../images/avatars/";

        //TODO: should be loaded from root language folder
        $_language->readModule('formvalidation', true);

        $upload = new \webspell\HttpUpload('avatar');
        if ($upload->hasFile()) {
            if ($upload->hasError() === false) {
                $mime_types = array('image/jpeg','image/png','image/gif');
                if ($upload->supportedMimeType($mime_types)) {
                    $imageInformation =  getimagesize($upload->getTempFile());

                    if (is_array($imageInformation)) {
                        if ($imageInformation[0] < 480 && $imageInformation[1] < 481) {
                            switch ($imageInformation[ 2 ]) {
                                case 1:
                                    $endung = '.gif';
                                    break;
                                case 3:
                                    $endung = '.png';
                                    break;
                                default:
                                    $endung = '.jpg';
                                    break;
                            }
                            $file = $id.$endung;

                            if (file_exists($filepath . $id . '.gif')) {
                                unlink($filepath . $id . '.gif');
                            }
                            if (file_exists($filepath . $id . '.jpg')) {
                                unlink($filepath . $id . '.jpg');
                            }
                            if (file_exists($filepath . $id . '.png')) {
                                unlink($filepath . $id . '.png');
                            }

                            if ($upload->saveAs($filepath.$file)) {
                                @chmod($filepath.$file, $new_chmod);
                                safe_query(
                                    "UPDATE "
                                    . PREFIX . "user
                                    SET
                                      avatar='" . $file .
                                    "' WHERE
                                      userID='" . $id . "'"
                                );
                            }
                        } else {
                            $error_array[] = sprintf($_language->module[ 'image_too_big' ], 480, 480);
                        }
                    } else {
                        $error_array[] = $_language->module[ 'broken_image' ];
                    }
                } else {
                    $error_array[] = $_language->module[ 'unsupported_image_type' ];
                }
            } else {
                $error_array[] = $upload->translateError();
            }
        }

        //userpic
        $filepath = "../images/userpics/";

        $upload = new \webspell\HttpUpload('userpic');
        if ($upload->hasFile()) {
            if ($upload->hasError() === false) {
                $mime_types = array('image/jpeg','image/png','image/gif');
                if ($upload->supportedMimeType($mime_types)) {
                    $imageInformation =  getimagesize($upload->getTempFile());

                    if (is_array($imageInformation)) {
                        if ($imageInformation[0] < 480 && $imageInformation[1] < 481) {
                            switch ($imageInformation[ 2 ]) {
                                case 1:
                                    $endung = '.gif';
                                    break;
                                case 3:
                                    $endung = '.png';
                                    break;
                                default:
                                    $endung = '.jpg';
                                    break;
                            }
                            $file = $id.$endung;

                            if (file_exists($filepath . $id . '.gif')) {
                                unlink($filepath . $id . '.gif');
                            }
                            if (file_exists($filepath . $id . '.jpg')) {
                                unlink($filepath . $id . '.jpg');
                            }
                            if (file_exists($filepath . $id . '.png')) {
                                unlink($filepath . $id . '.png');
                            }

                            if ($upload->saveAs($filepath.$file)) {
                                @chmod($filepath.$file, $new_chmod);
                                safe_query(
                                    "UPDATE "
                                    . PREFIX . "user
                                    SET
                                      userpic='" . $file .
                                    "' WHERE userID='" . $id . "'"
                                );
                            }
                        } else {
                            $error_array[] = sprintf($_language->module[ 'image_too_big' ], 480, 480);
                        }
                    } else {
                        $error_array[] = $_language->module[ 'broken_image' ];
                    }
                } else {
                    $error_array[] = $_language->module[ 'unsupported_image_type' ];
                }
            } else {
                $error_array[] = $upload->translateError();
            }
        }

        $b_day = $_POST[ 'b_day' ];
        $b_month = $_POST[ 'b_month' ];
        $b_year = $_POST[ 'b_year' ];
        $birthday = $b_year . '.' . $b_month . '.' . $b_day;
        $nickname = htmlspecialchars(mb_substr(trim($_POST[ 'nickname' ]), 0, 30));

        if (mysqli_num_rows(
            safe_query(
                "SELECT userID FROM " . PREFIX . "user WHERE nickname='" . $nickname .
                "' AND userID!=" . $id
            )
        )) {
            $error_array[] = $_language->module[ 'user_exists' ];
        }

        if (count($error_array) > 0) {
            echo generateErrorBoxFromArray($_language->module[ 'error' ], $error_array);
        } else {

            $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='forum'"));
            if (@$dx[ 'modulname' ] != 'forum') {
                $specialrank = '';
            }else{
                $specialrank = "special_rank = '".$_POST['special_rank']."',"; 
            }
            safe_query(
                "UPDATE " . PREFIX . "user SET nickname='" . $nickname . "',
									 email='" . $_POST[ 'email' ] . "',
									 firstname='" . $_POST[ 'firstname' ] . "',
									 lastname='" . $_POST[ 'lastname' ] . "',
									 gender='" . $_POST[ 'gender' ] . "',
									 town='" . $_POST[ 'town' ] . "',
									 birthday='" . $birthday . "',
									 discord='" . $_POST[ 'discord' ] . "',
									 usertext='" . $_POST[ 'usertext' ] . "',
									 twitch='" . $_POST[ 'twitch' ] . "',
                                     youtube='" . $_POST[ 'youtube' ] . "',
                                     twitter='" . $_POST[ 'twitter' ] . "',
                                     instagram='" . $_POST[ 'instagram' ] . "',
                                     facebook='" . $_POST[ 'facebook' ] . "',
                                     steam='" . $_POST[ 'steam' ] . "',
									 homepage='" . $_POST[ 'homepage' ] . "',
                                     $specialrank
									 about='" . $_POST[ 'about' ] . "'
                                     WHERE userID='" . $id . "' "
            );
            safe_query(
                "UPDATE " . PREFIX . "user_nickname SET nickname='" . $nickname . "' WHERE userID='" . $id . "' "
            );

            if (isset($_POST[ 'avatar' ])) {
                safe_query("UPDATE " . PREFIX . "user SET avatar='' WHERE userID='" . $id . "'");
                @unlink('../images/avatars/' . $id . '.gif');
                @unlink('../images/avatars/' . $id . '.jpg');
                @unlink('../images/avatars/' . $id . '.png');
            }
            if (isset($_POST[ 'userpic' ])) {
                safe_query("UPDATE " . PREFIX . "user SET userpic='' WHERE userID='" . $id . "'");
                @unlink('../images/userpics/' . $id . '.gif');
                @unlink('../images/userpics/' . $id . '.jpg');
                @unlink('../images/userpics/' . $id . '.png');
            }
        }
    } else {
        echo $_language->module[ 'transaction_invalid' ];
    }
} elseif (isset($_POST[ 'newuser' ])) {
    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_POST[ 'captcha_hash' ])) {
        $newnickname = htmlspecialchars(mb_substr(trim($_POST[ 'nickname' ]), 0, 30));
        $anz = mysqli_num_rows(safe_query(
            "SELECT userID FROM " . PREFIX . "user WHERE (nickname='" . $newnickname . "') "
        ));
        if (!$anz && $newnickname != "") {
            safe_query(
                "INSERT INTO " . PREFIX .
                "user ( nickname, email, password, registerdate, activated, topics) VALUES('" .
                $newnickname . "', '" .$_POST[ 'email' ] . "', '" . generatePasswordHash(stripslashes($_POST[ 'pass' ])) . "', '" . time() .
                "', 1, '|') "
            );
            safe_query("
              INSERT INTO " . PREFIX . "user_nickname ( userID,nickname ) values ('" . mysqli_insert_id($_database) ."','" . $newnickname ."')
            ");
            safe_query(
                "INSERT INTO " . PREFIX . "user_groups ( userID ) values('" . mysqli_insert_id($_database) .
                "' )"
            );
        } else {
            echo $_language->module[ 'user_exists' ];
        }
    } else {
        echo $_language->module[ 'transaction_invalid' ];
    }
} elseif (isset($_GET[ 'delete' ])) {
    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_GET[ 'captcha_hash' ])) {
        $id = $_GET[ 'id' ];
        if (!issuperadmin($id) || (issuperadmin($id) && issuperadmin($userID))) {
          @  safe_query("DELETE FROM " . PREFIX . "plugins_forum_moderators WHERE userID='$id'");
          #  safe_query("DELETE FROM " . PREFIX . "plugins_messenger WHERE touser='$id'");
          $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='squads'"));
            if (@$dx[ 'modulname' ] != 'squads') {
            } else {
                @  safe_query("DELETE FROM " . PREFIX . "plugins_squads_members WHERE userID='$id'");
            }    
          #  safe_query("DELETE FROM " . PREFIX . "upcoming_announce WHERE userID='$id'");
             safe_query("DELETE FROM " . PREFIX . "user WHERE userID='$id'");
             safe_query("DELETE FROM " . PREFIX . "user_groups WHERE userID='$id'");
            $userfiles = array(
                '../images/avatars/' . $id . '.jpg',
                '../images/avatars/' . $id . '.gif',
                '../images/userpics/' . $id . '.jpg',
                '../images/userpics/' . $id . '.gif'
            );
            foreach ($userfiles as $file) {
                if (file_exists($file)) {
                    unlink($file);
                }
            }
        }
    } else {
        echo $_language->module[ 'transaction_invalid' ];
    }

} elseif  (isset($_GET[ 'user_rights_delete' ])) {
    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_GET[ 'captcha_hash' ])) {
        safe_query("DELETE FROM `" . PREFIX . "user_groups` WHERE usgID='" . $_GET[ 'usgID' ] . "'");
        safe_query("DELETE FROM `" . PREFIX . "plugins_forum_user_forum_groups` WHERE userID='" . $_GET[ 'userID' ] . "'");
    } else {
        echo $_language->module[ 'transaction_invalid' ];
    }

} elseif (isset($_POST[ 'ban' ])) {
    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_POST[ 'captcha_hash' ])) {
        $id = $_POST[ 'id' ];
        if (isset($_POST[ 'permanent' ])) {
            $permanent = $_POST[ 'permanent' ];
        } else {
            $permanent = 0;
        }
        if (isset($_POST[ 'ban_num' ])) {
            $ban_num = ($_POST[ 'ban_num' ]);
        } else {
            $ban_num = 0;
        }
        if (isset($_POST[ 'ban_multi' ])) {
            $ban_multi = ($_POST[ 'ban_multi' ]);
        } else {
            $ban_multi = 0;
        }
        $reason = $_POST[ 'reason' ];

        if (isset($_POST[ 'remove_ban' ])) {
            safe_query("UPDATE " . PREFIX . "user SET banned=(NULL), ban_reason='' WHERE userID='$id'");
        } else {
            if ($permanent == "1") {
                safe_query(
                    "UPDATE " . PREFIX . "user SET banned='perm', ban_reason='" . $reason .
                    "' WHERE userID='$id'"
                );
            } else {
                if ($ban_num && $ban_multi) {
                    $ban_time = time() + (60 * 60 * 24 * $ban_num * $ban_multi);
                    safe_query(
                        "UPDATE " . PREFIX . "user SET banned='" . $ban_time . "', ban_reason='" . $reason .
                        "' WHERE userID='$id'"
                    );
                } else {
                    $ban_time = mktime(0, 0, 0, $_POST[ 'u_month' ], $_POST[ 'u_day' ], $_POST[ 'u_year' ]);
                    safe_query(
                        "UPDATE " . PREFIX . "user SET banned='" . $ban_time . "', ban_reason='" . $reason .
                        "' WHERE userID='$id'"
                    );
                }
            }
        }
    } else {
        echo $_language->module[ 'transaction_invalid' ];
    }
}

if (isset($_GET[ 'action' ])) {
    $action = $_GET[ 'action' ];
} else {
    $action = '';
}

if ($action == "activate") {
    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_GET[ 'captcha_hash' ])) {
        $id = $_GET[ 'id' ];
        safe_query("UPDATE " . PREFIX . "user SET activated='1' WHERE userID='$id'");
        redirect('admincenter.php?site=users', '', 0);
    } else {
        echo $_language->module[ 'transaction_invalid' ];
    }
} elseif ($action == "ban") {
    echo '<div class="card">
        <div class="card-header">
            ' . $_language->module[ 'users' ] . '
        </div>
            
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="admincenter.php?site=users">' . $_language->module[ 'users' ] . '</a></li>
    <li class="breadcrumb-item active" aria-current="page">' . $_language->module[ 'ban_user' ] . '</li>
  </ol>
</nav>
     <div class="card-body">';

    $id = $_GET[ 'id' ];

    if ($userID != $id) {
        if (!issuperadmin($id) || (issuperadmin($id) && issuperadmin($userID))) {
            $CAPCLASS = new \webspell\Captcha;
            $CAPCLASS->createTransaction();
            $hash = $CAPCLASS->getHash();
            $get = safe_query("SELECT nickname,banned,ban_reason FROM " . PREFIX . "user WHERE userID='" . $id . "'");
            $data = mysqli_fetch_assoc($get);
            $nickname = $data[ 'nickname' ];

            if ($data[ 'banned' ] == "perm") {
                $checked = "checked='checked'";
                $u_day = '';
                $u_month = '';
                $u_year = '';
                $hide = "style='display:none;'";
            } else {
                $checked = '';
                $hide = '';
                if ($data[ 'banned' ]) {
                    $u_day = date("d", $data[ 'banned' ]);
                    $u_month = date("m", $data[ 'banned' ]);
                    $u_year = date("Y", $data[ 'banned' ]);
                } else {
                    $u_day = "";
                    $u_month = "";
                    $u_year = "";
                }
            }
            $reason = $data[ 'ban_reason' ];

            echo '<script type="text/javascript">
				function hide_forms() {
					if(document.getElementById("permanent").checked){
						document.getElementById("until_date").style.display = "none";
						document.getElementById("ban_for").style.display = "none";
					}
					else {
						document.getElementById("until_date").style.display = "";
						document.getElementById("ban_for").style.display = "";
					}
					document.getElementById("u_day").value = "";
					document.getElementById("u_month").value = "";
					document.getElementById("u_year").value = "";
					document.getElementById("ban_num").value = "";
				}
				function kill_form(type) {
					if(type == "until") {
						document.getElementById("permanent").checked == false;
						document.getElementById("ban_num").value = "";
					}
					else {
						document.getElementById("permanent").checked == false;
						document.getElementById("u_day").value = "";
						document.getElementById("u_month").value = "";
						document.getElementById("u_year").value = "";
					}
				}
			</script>
			
            <form class="form-horizontal" method="post" action="admincenter.php?site=users" enctype="multipart/form-data">

             <div class="mb-3 row">
                <label class="col-md-2 control-label">' . $_language->module[ 'nickname' ] . ':</label>
            <div class="col-md-8"><h4>' . $nickname . '</h4>
            </div>
            </div>   
  
            <div class="mb-3 row"  id="until_date" ' . $hide . '>
                <label class="col-md-2 control-label">' . $_language->module[ 'ban_until' ] . ':</label>
            <div class="col-md-1">
                <input class="form-control" type="text" name="u_day" onchange="kill_form(\'until\');" id="u_day" size="2" value="' . $u_day . '" placeholder="dd"/>.
            </div>
            <div class="col-md-1"> 
                <input class="form-control" type="text" onchange="kill_form(\'until\');" name="u_month" id="u_month" size="2" value="' . $u_month . '" placeholder="mm"/>.
            </div>
            <div class="col-md-1">  
                <input class="form-control" type="text" onchange="kill_form(\'until\');" name="u_year" id="u_year" size="4" value="' . $u_year . '" placeholder="yyyy"/>
            </div>   
            <div class="col-md-3"> 
                <i>dd.mm.YY</i>
            </div>
            </div>            

            <div class="mb-3 row" id="ban_for" ' . $hide . '>
                <label class="col-md-2 control-label">' . $_language->module[ 'ban_for' ] . ':</label>
            <div class="col-md-1">
                <input class="form-control" type="text" name="ban_num" onchange="kill_form(\'\');" id="ban_num" size="1" placeholder="No."/>
            </div>   
            <div class="col-md-3"><select class="form-control" name="ban_multi"><option value="1">' .
                $_language->module[ 'days' ] . '</option><option value="7">' . $_language->module[ 'weeks' ] .
                '</option><option value="28">' . $_language->module[ 'month' ] . '</option></select>
            </div>
            </div>
            
            
            <div class="mb-3 row">
                <label class="col-md-2 control-label">' . $_language->module[ 'permanently' ] . ':</label>
            <div class="col-md-1">
                <input type="checkbox" id="permanent" onchange="hide_forms();" value="1" name="permanent" ' . $checked . ' />
            </div>
            </div>   

            <div class="mb-3 row">
                <label class="col-md-2 control-label">' . $_language->module[ 'reason' ] . ':</label>
            <div class="col-md-8"><span class="text-muted small"><em>
                <textarea class="ckeditor" id="ckeditor" name="reason" rows="3" cols="" style="width: 50%;">' . $reason . '</textarea></em></span>
            </div>
            </div>';

            if ($data[ 'banned' ]) {
                echo '<div class="mb-3 row">
                            <label class="col-md-2 control-label">' . $_language->module[ 'remove_ban' ] . ':</label>
                        <div class="col-md-8"><span class="text-muted small"><em>
                            <input type="checkbox" name="remove_ban" value="1" /></em></span>
                        </div>
                    </div>  ';
            }

            echo '
            <div class="mb-3 row">
            <div class="col-md-offset-2 col-md-10">
                <input type="hidden" name="captcha_hash" value="'.$hash.'" /><input type="hidden" name="id" value="' . $id . '" />
                <button class="btn btn-success" type="submit" name="ban"  />' . $_language->module[ 'edit_ban' ] . '</button>
            </div>
            </div>

			</form>
            </div></div>';
        } else {
            echo $_language->module[ 'you_cant_ban' ] . '<br /><br />&laquo; <a href="javascript:history.back()">' .
                $_language->module[ 'back' ] . '</a>';
        }
    } else {
        echo
            $_language->module[ 'you_cant_ban_yourself' ] . '<br /><br />&laquo; <a href="javascript:history.back()">' .
            $_language->module[ 'back' ] . '</a>';
    }

} elseif ($action == "adduser") {
    $CAPCLASS = new \webspell\Captcha;
    $CAPCLASS->createTransaction();
    $hash = $CAPCLASS->getHash();

    echo '<div class="card">
        <div class="card-header">
            ' . $_language->module[ 'users' ] . '
        </div>
            
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="admincenter.php?site=users">' . $_language->module[ 'users' ] . '</a></li>
    <li class="breadcrumb-item active" aria-current="page">' . $_language->module[ 'add_new_user' ] . '</li>
  </ol>
</nav>
     <div class="card-body">';

    echo '<form class="form-horizontal" method="post" action="admincenter.php?site=users" enctype="multipart/form-data">



<div class="mb-3 row">
    <label class="col-md-2 control-label">' . $_language->module[ 'nickname' ] . ':</label>
    <div class="col-md-8"><span class="text-muted small"><em>
    <input class="form-control" type="text" name="nickname" size="60" /></em></span>
    </div>
  </div>

  <div class="mb-3 row">
    <label class="col-md-2 control-label">' . $_language->module[ 'email' ] . ':</label>
    <div class="col-md-8"><span class="text-muted small"><em>
    <input class="form-control" type="text" name="email" size="60" /></em></span>
    </div>
  </div>

<div class="mb-3 row">
    <label class="col-md-2 control-label">' . $_language->module[ 'password' ] . ':</label>
    <div class="col-md-8"><span class="text-muted small"><em>
    <input class="form-control" type="password" name="pass" size="60" /></em></span>
    </div>
  </div>
<div class="mb-3 row">
    <div class="col-md-offset-2 col-md-10">
        <input type="hidden" name="captcha_hash" value="'.$hash.'" />
        <button class="btn btn-success" type="submit" name="newuser"  />' . $_language->module[ 'add_new_user' ] . '</button>
    </div>
  </div>

  
  </form>
  </div></div>';
} elseif ($action == "profile") {
    echo '<div class="card">
        <div class="card-header">
            ' . $_language->module[ 'users' ] . '
        </div>
            
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="admincenter.php?site=users">' . $_language->module[ 'users' ] . '</a></li>
    <li class="breadcrumb-item active" aria-current="page">' . $_language->module['edit_profile'] . '</li>
  </ol>
</nav>
     <div class="card-body">';

    $id = $_GET[ 'id' ];
    $ds = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "user WHERE userID='$id'"));

    if (!empty($ds[ 'userpic' ])) {
        $viewpic = '<img id="img-upload" class="img-thumbnail" style="width: 100%; max-width: 150px" src="../images/userpics/' . $ds[ 'userpic' ] . '" alt="">';
    } else {
        $viewpic = '<img id="img-upload" class="img-thumbnail" style="width: 100%; max-width: 150px" src="../images/userpics/' . 'nouserpic.png" alt="">';
    }

    if (!empty($ds[ 'avatar' ])) {
        $viewavatar = '<img id="img-upload" class="img-thumbnail" style="width: 100%; max-width: 150px" src="../images/avatars/' . $ds[ 'avatar' ] . '" alt="">';
    } else {
        $viewavatar = '<img id="img-upload" class="img-thumbnail" style="width: 100%; max-width: 150px" src="../images/avatars/' . 'noavatar.png" alt="">';
    }


    $gender = '<option value="male">' . $_language->module[ 'male' ] . '</option><option value="female">' .
        $_language->module[ 'female' ] . '</option><option value="divers">' .
        $_language->module[ 'diverse' ] . '</option><option value="select_gender">' . $_language->module[ 'select_gender' ] .
        '</option>';
    $gender = str_replace('value="' . $ds[ 'gender' ] . '"', 'value="' . $ds[ 'gender' ] . '" selected="selected"', $gender);

    $b_day = mb_substr($ds[ 'birthday' ], 8, 2);
    $b_month = mb_substr($ds[ 'birthday' ], 5, 2);
    $b_year = mb_substr($ds[ 'birthday' ], 0, 4);

    $CAPCLASS = new \webspell\Captcha;
    $CAPCLASS->createTransaction();
    $hash = $CAPCLASS->getHash();

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
            "value='" . $get_rank[ 'special_rank' ] . "",
            "value='" . $get_rank[ 'special_rank' ] . "' selected='selected'",
            $ranks
        );
    } else {
        $ranks = str_replace("value='0", "value='0' selected='selected'", $ranks);
    }

}

    echo '<form class="form-horizontal" method="post" enctype="multipart/form-data" action="admincenter.php?site=users&amp;page='.$_GET['page'].'">

   <div class="mb-3 row">
    <label class="col-md-2 control-label">'.$_language->module['user_id'].'</label>
    <div class="col-md-8">
      <p class="form-control-static">'.$ds['userID'].'</p>
    </div>
  </div>  
  <div class="mb-3 row">
    <label class="col-md-2 control-label"><h3>'.$_language->module['general'].'</h3></label>
    <div class="col-md-8">
      <p class="form-control-static"></p>
    </div>
  </div>
  <div class="mb-3 row">
    <label class="col-md-2 control-label">'.$_language->module['nickname'].'</label>
    <div class="col-md-8">
    <input class="form-control" type="text" name="nickname" value="'.$ds['nickname'].'" />
    </div>
  </div>
  <div class="mb-3 row">
    <label class="col-md-2 control-label">'.$_language->module['email'].'</label>
    <div class="col-md-8">
    <input class="form-control" type="text" name="email" value="'.getinput($ds['email']).'" />
    </div>
  </div>';
  $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='forum'"));
    if (@$dx[ 'modulname' ] != 'forum') {
    }else{ echo'
<div class="mb-3 row">
    <label class="col-md-2 control-label">'.$_language->module['special_rank'].'</label>
    <div class="col-md-8">
    <select class="form-control" name="special_rank">' . $ranks . '</select>
    </div>
  </div>';
}
echo'  
  <div class="mb-3 row">
    <label class="col-md-2 control-label"><h3>'.$_language->module['pictures'].'</h3></label>
    <div class="col-md-8">
      <p class="form-control-static"></p>
    </div>
  </div>
  <div class="mb-3 row">
    <label class="col-md-2 control-label">'.$_language->module[ 'avatar' ].'</label>
    <div class="col-md-8">
    '.$viewavatar.'
    <input class="btn btn-info" name="avatar" type="file" size="40" /> <small>'.$_language->module['max_90x90'].'</small><br><input type="checkbox" name="avatar" value="1" /> '.$_language->module['delete_avatar'].'
    </div>
  </div>
  <div class="mb-3 row">
    <label class="col-md-2 control-label">'.$_language->module[ 'picture' ].'</label>
    <div class="col-md-8">
    '.$viewpic.'
    <input class="btn btn-info" name="userpic" type="file" size="40" /> <small>'.$_language->module['max_285x250'].'</small><br><input type="checkbox" name="userpic" value="1" /> '.$_language->module['delete_picture'].'
    </div>
  </div>
  <div class="mb-3 row">
    <label class="col-md-2 control-label"><h3>'.$_language->module['personal'].'</h3></label>
    <div class="col-md-8">
      <p class="form-control-static"></p>
    </div>
  </div>
  <div class="mb-3 row">
    <label class="col-md-2 control-label">'.$_language->module['firstname'].'</label>
    <div class="col-md-8">
    <input class="form-control" type="text" name="firstname" value="'.getinput($ds['firstname']).'" />
    </div>
  </div>
  <div class="mb-3 row">
    <label class="col-md-2 control-label">'.$_language->module['lastname'].'</label>
    <div class="col-md-8">
    <input class="form-control" type="text" name="lastname" value="'.getinput($ds['lastname']).'" />
    </div>
  </div>
  <div class="mb-3 row">
    <label class="col-md-2 control-label">'.$_language->module['birthday'].'</label>
    <div class="col-md-1">
    <input class="form-control" type="text" name="b_day" value="'.getinput($b_day).'" size="2" />
      .</div><div class="col-md-1">
      <input class="form-control" type="text" name="b_month" value="'.getinput($b_month).'" size="2" />
      .</div><div class="col-md-1">
      <input class="form-control" type="text" name="b_year" value="'.getinput($b_year).'" size="4" />
    </div>
  </div>
  <div class="mb-3 row">
    <label class="col-md-2 control-label">'.$_language->module['gender'].'</label>
    <div class="col-md-8">
    <select class="form-control" name="gender">'.$gender.'</select>
    </div>
  </div>
  <div class="mb-3 row">
    <label class="col-md-2 control-label">'.$_language->module['town'].'</label>
    <div class="col-md-8">
    <input class="form-control" type="text" name="town" value="'.getinput($ds['town']).'" size="60" />
    </div>
  </div>
  <div class="mb-3 row">
    <label class="col-md-2 control-label">'.$_language->module['discord'].'</label>
    <div class="col-md-8">
    <input class="form-control" type="text" name="discord" value="'.getinput($ds['discord']).'" size="60" />
    </div>
  </div>
  <div class="mb-3 row">
    <label class="col-md-2 control-label">'.$_language->module['homepage'].'</label>
    <div class="col-md-8">
    <input class="form-control" type="text" name="homepage" value="'.getinput($ds['homepage']).'" size="60" />
    </div>
  </div>
  <div class="mb-3 row">
    <label class="col-md-2 control-label">'.$_language->module['signatur'].'</label>
    <div class="col-md-8">
    <textarea class="ckeditor" id="ckeditor" name="usertext" rows="10" cols="" style="width: 100%;">'.getinput($ds['usertext']).'</textarea>
    </div>
  </div><div class="mb-3 row">
    <label class="col-md-2 control-label">'.$_language->module['about_myself'].'</label>
    <div class="col-md-8">
    <textarea class="ckeditor" id="ckeditor" name="about" rows="10" cols="" style="width: 100%;">'.getinput($ds['about']).'</textarea>
    </div>
  </div>
  <div class="mb-3 row">
    <label class="col-md-2 control-label"><h3>'.$_language->module['social-media'].'</h3></label>
    <div class="col-md-8">
      <p class="form-control-static"></p>
    </div>
  </div>
  <div class="mb-3 row">
    <label class="col-md-2 control-label">'.$_language->module['twitch'].'</label>
    <div class="col-md-8">
    <input class="form-control" type="text" name="twitch" value="'.getinput($ds['twitch']).'" size="60" />
    </div>
  </div>
  <div class="mb-3 row">
    <label class="col-md-2 control-label">'.$_language->module['youtube'].'</label>
    <div class="col-md-8">
    <input class="form-control" type="text" name="youtube" value="'.getinput($ds['youtube']).'" size="60" />
    </div>
  </div>
  <div class="mb-3 row">
    <label class="col-md-2 control-label">'.$_language->module['twitter'].'</label>
    <div class="col-md-8">
    <input class="form-control" type="text" name="twitter" value="'.getinput($ds['twitter']).'" size="60" />
    </div>
  </div>
  <div class="mb-3 row">
    <label class="col-md-2 control-label">'.$_language->module['instagram'].'</label>
    <div class="col-md-8">
    <input class="form-control" type="text" name="instagram" value="'.getinput($ds['instagram']).'" size="60" />
    </div>
  </div>
  <div class="mb-3 row">
    <label class="col-md-2 control-label">'.$_language->module['facebook'].'</label>
    <div class="col-md-8">
    <input class="form-control" type="text" name="facebook" value="'.getinput($ds['facebook']).'" size="60" />
    </div>
  </div>
  <div class="mb-3 row">
    <label class="col-md-2 control-label">'.$_language->module['stream'].'</label>
    <div class="col-md-8">
    <input class="form-control" type="text" name="steam" value="'.getinput($ds['steam']).'" size="60" />
    </div>
  </div>
  <div class="mb-3 row">
    <div class="col-md-offset-2 col-md-8">
    <input type="hidden" name="captcha_hash" value="'.$hash.'" /><input type="hidden" name="id" value="'.$id.'" />
      <button class="btn btn-primary" type="submit" name="edit" />'.$_language->module['edit_profile'].'</button>
    </div>
  </div>
    </form>';

} elseif ($action == "user_rights") {

echo '<div class="card">
        <div class="card-header"> 
            ' . $_language->module[ 'user_rights' ] . '
        </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="admincenter.php?site=users">' . $_language->module[ 'users' ] .'</a></li>
                <li class="breadcrumb-item">' . $_language->module[ 'user_rights' ].'</li>
                </ol>
            </nav>
    <div class="card-body">

    <div class="alert alert-success" role="alert">' . $_language->module[ 'info' ] . '</div>

    <div class="table-responsive">
        <table id="plugini" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th><center>' . $_language->module[ 'user' ] . '</center></th>';

                    $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='news_manager'"));
                    if (@$dx[ 'modulname' ] != 'news_manager') {
                    }else{echo'<th><center>' . $_language->module['news' ] . '</center></th>
                                <th><center>' . $_language->module['news_writer' ] . '</center></th>';
                    }

                    $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='polls'"));
                    if (@$dx[ 'modulname' ] != 'polls') {
                    }else{
                        echo'<th><center>' . $_language->module['poll' ] . '</center></th>';
                    }

                    $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='forum'")); 
                    if (@$dx[ 'modulname' ] != 'forum') {
                    }else{
                        echo'<th><center>' . $_language->module['forum' ] . '</center></th>
                        <th><center>' . $_language->module['mod' ] . '</center></th>';
                    }
                          
                    $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='clanwars'"));
                    if (@$dx[ 'modulname' ] != 'clanwars') {
                    }else{
                        echo'<th><center>' . $_language->module['war' ] . '</center></th>';
                    }

                    echo'<th><center>' . $_language->module['feed' ] . '</center></th>
                    <th><center>' . $_language->module['user' ] . '</center></th>
                    <th><center>' . $_language->module['page' ] . '</center></th>
                    <th><center>' . $_language->module['file' ] . '</center></th>';

                    $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='cashbox'"));
                    if (@$dx[ 'modulname' ] != 'cashbox') {
                    }else{
                        echo'<th><center>' . $_language->module['cash' ] . '</center></th>';
                    }
                    echo'<th><center>' . $_language->module['gallery' ] . '</center></th>
                    <th><center>' . $_language->module['super' ] . '</center></th>
                    <th><center>' . $_language->module['forum_group' ] . '</center></th>
                    <th style="width: 12%;"><center>' . $_language->module[ 'actions' ] . '</center></th>
                </tr>
            </thead>
            <tbody>
                <tr>';

   /* $result=safe_query("SELECT * FROM `".PREFIX."user_groups` WHERE (

                news='1' 
                OR news_writer='1' 
                OR polls='1' 
                OR forum='1' 
                OR moderator='1' 
                OR clanwars='1' 
                OR feedback='1' 
                OR user='1' 
                OR page='1' 
                OR files='1' 
                OR cash='1' 
                OR gallery='1' 
                OR super='1')");*/


    $result = safe_query(
        "SELECT
            w.*, u.*
        FROM
            " . PREFIX . "user_groups w
        LEFT JOIN
            " . PREFIX . "plugins_forum_user_forum_groups u
            ON
            w.userID = u.userID
        WHERE
            w.news='1' 
                OR w.news_writer='1' 
                OR w.polls='1' 
                OR w.forum='1' 
                OR w.moderator='1' 
                OR w.clanwars='1' 
                OR w.feedback='1' 
                OR w.user='1' 
                OR w.page='1' 
                OR w.files='1' 
                OR w.cash='1' 
                OR w.gallery='1' 
                OR w.super='1'
                OR u.userID=w.userID
            ");

    $CAPCLASS = new \webspell\Captcha;
        $CAPCLASS->createTransaction();
        $hash = $CAPCLASS->getHash();
    $i=1;
    while ($ds=mysqli_fetch_array($result)) {
        if($i%2) { $td='td1'; }
        else { $td='td2'; }

        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='news_manager'"));
        if (@$dx[ 'modulname' ] != 'news_manager') {
        }else{
        if($ds['news']=='1') { $news = '<font class="text-success">' . $_language->module['on' ] . '</font>'; } else { $news = '<i><font class="text-danger">' . $_language->module['off' ] . '</i></font>'; }
        if($ds['news_writer']=='1') { $news_writer = '<font class="text-success">' . $_language->module['on' ] . '</font>'; } else { $news_writer = '<i><font class="text-danger">' . $_language->module['off' ] . '</i></font>'; }
        }

        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='polls'"));
        if (@$dx[ 'modulname' ] != 'polls') {
        }else{
            if($ds['polls']=='1') { $polls = '<font class="text-success">' . $_language->module['on' ] . '</font>'; } else { $polls = '<i><font class="text-danger">' . $_language->module['off' ] . '</i></font>'; }
        }

        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='forum'"));
        if (@$dx[ 'modulname' ] != 'forum') {
        }else{
            if($ds['forum']=='1') { $forum = '<font class="text-success">' . $_language->module['on' ] . '</font>'; } else { $forum = '<i><font class="text-danger">' . $_language->module['off' ] . '</i></font>'; }
            if($ds['moderator']=='1') { $moderator = '<font class="text-success">' . $_language->module['on' ] . '</font>'; } else { $moderator = '<i><font class="text-danger">' . $_language->module['off' ] . '</i></font>'; }
        }
        
        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='clanwars'"));
        if (@$dx[ 'modulname' ] != 'clanwars') {
        }else{    
            if($ds['clanwars']=='1') { $clanwars = '<font class="text-success">' . $_language->module['on' ] . '</font>'; } else{ $clanwars = '<i><font class="text-danger">' . $_language->module['off' ] . '</i></font>'; }
        }
            
        if($ds['feedback']=='1') { $feedback = '<font class="text-success">' . $_language->module['on' ] . '</font>'; } else { $feedback = '<i><font class="text-danger">' . $_language->module['off' ] . '</i></font>'; }
        if($ds['user']=='1') { $user = '<font class="text-success">' . $_language->module['on' ] . '</font>'; } else { $user = '<i><font class="text-danger">' . $_language->module['off' ] . '</i></font>'; }
        if($ds['page']=='1') { $page = '<font class="text-success">' . $_language->module['on' ] . '</font>'; } else { $page = '<i><font class="text-danger">' . $_language->module['off' ] . '</i></font>'; }
        if($ds['files']=='1') { $files = '<font class="text-success">' . $_language->module['on' ] . '</font>'; } else { $files = '<i><font class="text-danger">' . $_language->module['off' ] . '</i></font>'; }

        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='cashbox'"));
        if (@$dx[ 'modulname' ] != 'cashbox') {
        }else{ 
            if($ds['cash']=='1') { $cash = '<font class="text-success">' . $_language->module['on' ] . '</font>'; } else { $cash = '<i><font class="text-danger">' . $_language->module['off' ] . '</i></font>'; }
        }    

        if($ds['gallery']=='1') { $gallery = '<font class="text-success">' . $_language->module['on' ] . '</font>'; } else { $gallery = '<i><font class="text-danger">' . $_language->module['off' ] . '</i></font>'; }

        if($ds['super']=='1') { $super = '<font class="text-success">' . $_language->module['on' ] . '</font>'; } else { $super = '<i><font class="text-danger">' . $_language->module['off' ] . '</i></font>'; }

$id = $ds['userID'];

 $usergrp = array();
    $ergebnis = safe_query("SELECT * FROM " . PREFIX . "plugins_forum_groups");
    while ($db = mysqli_fetch_array($ergebnis)) {
        $name = $db[ 'name' ];
        $fgrID = $db[ 'fgrID' ];
        if (isinusergrp($fgrID, $id)) {
            $usergrp[ $fgrID ] = '<font class="text-success">' . $_language->module['on' ] . '</font>';
        } else {
            $usergrp[ $fgrID ] = '<i><font class="text-danger">' . $_language->module['off' ] . '</i></font>';
        }
    }

     
        
        echo '<td class="'.$td.'">
            <b>'.getnickname($ds['userID']).'</b>
            </td>';
            $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='news_manager'"));
            if (@$dx[ 'modulname' ] != 'news_manager') {
            }else{echo'<td class="'.$td.'"><center>'.$news.'</center></td>
                        <td class="'.$td.'"><center>'.$news_writer.'</center></td>';
            }
                    
            $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='polls'"));
            if (@$dx[ 'modulname' ] != 'polls') {
            }else{echo'<td class="'.$td.'"><center>'.$polls.'</center></td>';
            }

            $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='forum'")); 
            if (@$dx[ 'modulname' ] != 'forum') {
            }else{echo'<td class="'.$td.'"><center>'.$forum.'</center></td>
                <td class="'.$td.'"><center>'.$moderator.'</center></td>';
            }
              
            $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='clanwars'"));
            if (@$dx[ 'modulname' ] != 'clanwars') {
            }else{echo'<td class="'.$td.'"><center>'.$clanwars.'</center></td>';
            }
            
            echo'  <td class="'.$td.'"><center>'.$feedback.'</center></td>
            <td class="'.$td.'"><center>'.$user.'</center></td>
            <td class="'.$td.'"><center>'.$page.'</center></td>
            <td class="'.$td.'"><center>'.$files.'</center></td>';

            $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='cashbox'"));
            if (@$dx[ 'modulname' ] != 'cashbox') {
            }else{echo'<td class="'.$td.'"><center>'.$cash.'</center></td>';
            }
            
            echo'<td class="'.$td.'"><center>'.$gallery.'</center></td>
            <td class="'.$td.'"><center>'.$super.'</center></td>
            <td class="'.$td.'"><center>';

    $sql = safe_query("SELECT * FROM " . PREFIX . "plugins_forum_groups");
    
    $i = 1;
    while ($df = mysqli_fetch_array($sql)) {
        $name = $df[ 'name' ];
        $fgrID = $df[ 'fgrID' ];
        echo '<div class="row bt"><label class="col-md-8 control-label text-start">' . $name . ':</b></label>
    <div class="col-md-4">' . $usergrp[ $fgrID ] . '
    </div>
    </div>
    ';
        
        $i++;
    }
$referer = "admincenter.php?site=users&action=user_rights";
    echo'</center></td>
            
            <td class="'.$td.'">

            <a type="button" class="btn btn-warning" href="admincenter.php?site=user_rights&amp;action=edit&amp;id='.$ds['userID' ] . '&amp;referer=' . urlencode($referer) . '" type="button">' . $_language->module[ 'edit' ] . '</a>
            
            <!-- Button trigger modal -->
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirm-delete" data-href="admincenter.php?site=users&action=user_rights&amp;user_rights_delete=true&amp;usgID=' . $ds['usgID'] . '&amp;userID=' . $ds['userID'] . '&amp;captcha_hash=' . $hash . '">
                ' . $_language->module['delete'] . '
                </button>
                <!-- Button trigger modal END-->

         </td>
                <!-- Modal -->
            <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">' . $_language->module[ 'user_rights' ] . '</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="' . $_language->module[ 'close' ] . '"></button>
                  </div>
                  <div class="modal-body"><p>' . $_language->module['really_rights_delete'] . '</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">' . $_language->module[ 'close' ] . '</button>
                    <a class="btn btn-danger btn-ok">' . $_language->module['delete'] . '</a>
                  </div>
                </div>
              </div>
            </div>
            <!-- Modal END -->
        </tr>';
        $i++;
    }
    echo'</tbody>
        </table>
        </div>
    </div>
</div>';

} else {
    echo'<div class="card">
            <div class="card-header">
                ' . $_language->module[ 'users' ] . '
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="admincenter.php?site=users">' . $_language->module[ 'users' ] .'</a></li>
                    <li class="breadcrumb-item active" aria-current="page">' . $_language->module[ 'user_management' ] . '</li>
                </ol>
            </nav>
            <div class="card-body">

                <div class="mb-3 row">
                    <label class="col-md-1 control-label">' . $_language->module['options'] . ':</label>
                    <div class="col-md-8">
                        <a class="btn btn-primary" type="button" href="admincenter.php?site=users&amp;action=adduser">' . $_language->module[ 'add_new_user' ] . '</a>
                        <a class="btn btn-primary" type="button" href="admincenter.php?site=users&amp;action=user_rights">' . $_language->module[ 'user_rights' ] . '</a>
                    </div>
                </div>';

    if (isset($_GET[ 'page' ])) {
        $page = (int)$_GET[ 'page' ];
    } else {
        $page = 1;
    }
    $sort = "nickname";
    $status = false;
    if (isset($_GET[ 'sort' ])) {
        if (($_GET[ 'sort' ] == 'nickname') || ($_GET[ 'sort' ] == 'registerdate')) {
            $sort = "u." . $_GET[ 'sort' ];
        } elseif ($_GET[ 'sort' ] == 'status') {
            $sort = "IF(	(SELECT super FROM " . PREFIX . "user_groups WHERE userID=u.userID LIMIT 0,1) = 1,'1',
	  				IF( 	(SELECT userID FROM " . PREFIX . "user_groups WHERE userID=u.userID AND (page='1' OR
	  				            forum='1' OR user='1' OR news='1' or news_writer='1' OR clanwars='1' OR feedback='1' OR super='1' OR
	  				            gallery='1' OR cash='1' OR files='1') LIMIT 0,1) =u.userID,2,
	  					IF( 	(SELECT userID FROM " . PREFIX . "user_groups WHERE userID=u.userID AND
	  					    moderator='1' LIMIT 0,1) = u.userID, 3,
	  						IF( 	(SELECT userID FROM " . PREFIX . "plugins_squads_members WHERE
	  						userID=u.userID LIMIT 0,1) = u.userID,4,5 )
	  					)
	  				)
	  			)";
            $status = true;
        }
    }

    $alle = safe_query("SELECT userID FROM " . PREFIX . "user");
    $gesamt = mysqli_num_rows($alle);
    $pages = 1;

    $pages = ceil($gesamt);
    $ergebnis = safe_query("SELECT u.* FROM " . PREFIX . "user u ORDER BY $sort");
    
    $anz = mysqli_num_rows($ergebnis);
    if ($anz) {
        $CAPCLASS = new \webspell\Captcha;
        $CAPCLASS->createTransaction();
        $hash = $CAPCLASS->getHash();

echo'<table width="100%" border="0" cellspacing="1" cellpadding="3">     
        <tr>
            <td colspan="2"><b>' . $gesamt . '</b> ' . $_language->module[ 'users_available' ] . '</td>
        </tr>
    </table>';

        echo '<br />
    <table id="plugini" class="table table-striped table-bordered" style="width:100%">    
        <thead>
            <tr>      
                <th><b>' . $_language->module[ 'registered_since' ] . '</b></th>
                <th><b>' . $_language->module[ 'nickname' ] . '</b></th>
                <th><b>' . $_language->module[ 'status' ] . '</b></th>
                <th><b>' . $_language->module[ 'ban_status' ] . '</b></th>
                <th><b>' . $_language->module[ 'actions' ] . '</b></th>
                <th><b>' . $_language->module[ 'member_delete' ] . '</b></th>
            </tr>
        </thead>
        <tbody>';

        $n = 1;
        $i = 1;
        while ($ds = mysqli_fetch_array($ergebnis)) {
            

            $id = $ds[ 'userID' ];
            $registered = getformatdatetime($ds[ 'registerdate' ]);
            $nickname = getnickname($ds[ 'userID' ]);
################# anpassen ###########################

#was für Adminechte hat der User

#####################################################

            $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='squads'"));
            if (@$dx[ 'modulname' ] != 'squads') {
                
                if (issuperadmin($ds[ 'userID' ])) {
                    $status = $_language->module[ 'superadmin' ];                
                } elseif (isanyadmin($ds[ 'userID' ])) {
                    $status = $_language->module[ 'admin' ];
                } elseif (isanymoderator($ds[ 'userID' ])) {
                    $status = $_language->module[ 'moderator' ];
                } else {
                    $status = $_language->module[ 'user' ];
                }
            } else {

                if (issuperadmin($ds[ 'userID' ]) && isclanmember($ds[ 'userID' ])) {
                    $status = $_language->module[ 'superadmin' ] . ' &amp; ' . $_language->module[ 'clanmember' ];
                } elseif (issuperadmin($ds[ 'userID' ])) {
                    $status = $_language->module[ 'superadmin' ];
                } elseif (isanyadmin($ds[ 'userID' ]) && isclanmember($ds[ 'userID' ])) {
                    $status = $_language->module[ 'admin' ] . ' &amp; ' . $_language->module[ 'clanmember' ];
                } elseif (isanyadmin($ds[ 'userID' ])) {
                    $status = $_language->module[ 'admin' ];
                } elseif (isanymoderator($ds[ 'userID' ]) && isclanmember($ds[ 'userID' ])) {
                    $status = $_language->module[ 'moderator' ] . ' &amp; ' . $_language->module[ 'clanmember' ];
                } elseif (isanymoderator($ds[ 'userID' ])) {
                    $status = $_language->module[ 'moderator' ];
                } elseif (isclanmember($ds[ 'userID' ])) {
                    $status = $_language->module[ 'clanmember' ];
                } else {
                    $status = $_language->module[ 'user' ];
                } 
            }

#was für Adminechte hat der User END
$referer = "admincenter.php?site=users";

            if (isbanned($ds[ 'userID' ])) {
                $banned = '<a class="btn btn-success" href="admincenter.php?site=users&amp;action=ban&amp;id=' . $ds[ 'userID' ] .
                    '" class="input">' . $_language->module[ 'undo_ban' ] . '</a>';
            } else {
                $banned = '<a class="btn btn-danger" href="admincenter.php?site=users&amp;action=ban&amp;id=' . $ds[ 'userID' ] .
                    '" class="input">' . $_language->module[ 'banish' ] . '</a>';
            }

             if ($ds[ 'activated' ] == "1") {
                $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='squads'"));
                if (@$dx[ 'modulname' ] != 'squads') {
                    $actions =
                    '<a class="btn btn-warning" href="admincenter.php?site=user_rights&amp;action=edit&amp;id=' . $ds[ 'userID' ] .
                    '&amp;referer=' . urlencode($referer) . '" class="input">' . $_language->module[ 'rights' ] . '</a> |
                    <a class="btn btn-success" href="admincenter.php?site=users&amp;action=profile&amp;page=' . $page . '&amp;id=' . $ds[ 'userID' ] .
                    '" class="input">' . $_language->module[ 'profile' ] . '</a>';
                }else{    
                
                    $actions =
                    '<a class="btn btn-success" href="admincenter.php?site=user_rights&amp;page=' . $page . '&amp;action=addtoclan&amp;id=' . $ds[ 'userID' ] .
                    '" class="input">' . $_language->module[ 'to_clan' ] . '</a> |


                    <a class="btn btn-warning" href="admincenter.php?site=user_rights&amp;action=edit&amp;id=' . $ds[ 'userID' ] .
                    '&amp;referer=' . urlencode($referer) . '" class="input">' . $_language->module[ 'rights' ] . '</a> |
                    <a class="btn btn-success" href="admincenter.php?site=users&amp;action=profile&amp;page=' . $page . '&amp;id=' . $ds[ 'userID' ] .
                    '" class="input">' . $_language->module[ 'profile' ] . '</a>';

                }    
            } else {
                $actions = '<a class="btn btn-info" href="admincenter.php?site=users&amp;action=activate&amp;id=' .
                    $ds[ 'userID' ] . '&amp;captcha_hash=' . $hash . '" class="input">' .
                    $_language->module[ 'activate' ] . '</a>';
            }

            echo '<tr>
        <td>' . $registered . '</td>
        <td><a href="../index.php?site=profile&amp;id=' . $id . '" target="_blank">' .
                strip_tags(stripslashes($nickname)) . '</a></td>
        <td>' . $status . '</td>
        <td>' . $banned . '</td>
        <td>' . $actions . '</td>
        <td> 

<!-- Button trigger modal -->
    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirm-delete" data-href="admincenter.php?site=users&amp;page=' . $page .
                '&amp;delete=true&amp;id=' .
                $ds[ 'userID' ] . '&amp;captcha_hash=' . $hash . '">
    ' . $_language->module['delete'] . '
    </button></th>
     </td>
        </tr>';

            $i++;
            echo'<!-- Button trigger modal END-->            

              <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                      <div class="modal-content">
                          <div class="modal-header">
                             <h5 class="modal-title" id="modalLabel">' . $_language->module['user'] . '</h5>
                             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="' . $_language->module[ 'close' ] . '"></button>
                          </div>
                          <div class="modal-body">
                             <p>' . $_language->module['really_delete'] . '</p>
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">' . $_language->module[ 'close' ] . '</button>
                              <a class="btn btn-danger btn-ok">' . $_language->module['delete'] . '</a>
                          </div>
                      </div>
                  </div>
              </div>
<!-- Modal END -->';
        }
        echo '</tbody></table>';
    } else {
        echo $_language->module[ 'no_users' ];
    }
echo '</div><div>';

}
?>