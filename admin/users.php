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
$_language->readModule('users', false, true);
$_language->readModule('rank_special', true, true);

if (!isuseradmin($userID) || mb_substr(basename($_SERVER[ 'REQUEST_URI' ]), 0, 15) != "admincenter.php") {
    die($_language->module[ 'access_denied' ]);
}

if (isset($_POST[ 'add' ])) {
    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_POST[ 'captcha_hash' ])) {
        $anz = mysqli_num_rows(safe_query(
            "SELECT userID FROM " . PREFIX . "squads_members WHERE squadID='" .
            $_POST[ 'squad' ] . "' AND userID='" . $_POST[ 'id' ] . "'"
        ));
        if (!$anz) {
            safe_query(
                "INSERT INTO " . PREFIX . "squads_members (squadID, userID, position, activity, sort) values('" .
                $_POST[ 'squad' ] . "', '" . $_POST[ 'id' ] . "', '" . $_POST[ 'position' ] . "', '" .
                $_POST[ 'activity' ] . "', '1')"
            );
        } else {
            echo $_language->module[ 'user_exists' ];
        }
    } else {
        echo $_language->module[ 'transaction_invalid' ];
    }
} elseif (isset($_POST[ 'edit' ])) {
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
                        if ($imageInformation[0] < 91 && $imageInformation[1] < 91) {
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
                            if ($upload->saveAs($filepath.$file, true)) {
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
                            $error_array[] = sprintf($_language->module[ 'image_too_big' ], 90, 90);
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
                        if ($imageInformation[0] < 251 && $imageInformation[1] < 286) {
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
                            if ($upload->saveAs($filepath.$file, true)) {
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
                            $error_array[] = sprintf($_language->module[ 'image_too_big' ], 250, 285);
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
            safe_query(
                "UPDATE " . PREFIX . "user SET nickname='" . $nickname . "',
									 email='" . $_POST[ 'email' ] . "',
									 firstname='" . $_POST[ 'firstname' ] . "',
									 lastname='" . $_POST[ 'lastname' ] . "',
									 sex='" . $_POST[ 'sex' ] . "',
									 town='" . $_POST[ 'town' ] . "',
									 birthday='" . $birthday . "',
									 icq='" . $_POST[ 'icq' ] . "',
									 usertext='" . $_POST[ 'usertext' ] . "',
									 twitch='" . $_POST[ 'twitch' ] . "',
                                     youtube='" . $_POST[ 'youtube' ] . "',
                                     twitter='" . $_POST[ 'twitter' ] . "',
                                     instagram='" . $_POST[ 'instagram' ] . "',
                                     facebook='" . $_POST[ 'facebook' ] . "',
									 homepage='" . $_POST[ 'homepage' ] . "',
									 about='" . $_POST[ 'about' ] . "',
									 special_rank = '".$_POST['special_rank']."' WHERE userID='" . $id . "' "
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
                "user ( nickname, email, password, registerdate, activated) VALUES('" .
                $newnickname . "', '" .$_POST[ 'email' ] . "', '" . generatePasswordHash(stripslashes($_POST[ 'pass' ])) . "', '" . time() .
                "', 1) "
            );
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
          @  safe_query("DELETE FROM " . PREFIX . "squads_members WHERE userID='$id'");
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
            <i class="fas fa-user-cog"></i> ' . $_language->module[ 'users' ] . '
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

             <div class="form-group row">
                <label class="col-md-2 control-label">' . $_language->module[ 'nickname' ] . ':</label>
            <div class="col-md-8"><span class="text-muted"><b>' . $nickname . '</b></span>
            </div>
            </div>   
  
            <div class="form-group row"  id="until_date" ' . $hide . '>
                <label class="col-md-2 control-label">' . $_language->module[ 'ban_until' ] . ':</label>
            <div class="col-md-1">
                <input class="form-control" type="text" name="u_day" onchange="kill_form(\'until\');" id="u_day" size="2" value="' . $u_day . '" />.
            </div>
            <div class="col-md-1"> 
                <input class="form-control" type="text" onchange="kill_form(\'until\');" name="u_month" id="u_month" size="2" value="' . $u_month . '" />.
            </div>
            <div class="col-md-1">  
                <input class="form-control" type="text" onchange="kill_form(\'until\');" name="u_year" id="u_year" size="4" value="' . $u_year . '" />
            </div>   
            <div class="col-md-3"> 
                <i>dd.mm.YY</i>
            </div>
            </div>
            

            <div class="form-group row" id="ban_for" ' . $hide . '>
                <label class="col-md-2 control-label">' . $_language->module[ 'ban_for' ] . ':</label>
            <div class="col-md-3">
                <input class="form-control" type="text" name="ban_num" onchange="kill_form(\'\');" id="ban_num" size="3" />
            </div>   
            <div class="col-md-3"><select class="form-control" name="ban_multi"><option value="1">' .
                $_language->module[ 'days' ] . '</option><option value="7">' . $_language->module[ 'weeks' ] .
                '</option><option value="28">' . $_language->module[ 'month' ] . '</option></select>
            </div>
            </div>
            
            
            <div class="form-group row">
                <label class="col-md-2 control-label">' . $_language->module[ 'permanently' ] . ':</label>
            <div class="col-md-1">
                <input type="checkbox" id="permanent" onchange="hide_forms();" value="1" name="permanent" ' . $checked . ' />
            </div>
            </div>   

            <div class="form-group row">
                <label class="col-md-2 control-label">' . $_language->module[ 'reason' ] . ':</label>
            <div class="col-md-8"><span class="text-muted small"><em>
                <textarea class="ckeditor" id="ckeditor" name="reason" rows="3" cols="" style="width: 50%;">' . $reason . '</textarea></em></span>
            </div>
            </div>';

            if ($data[ 'banned' ]) {
                echo '<div class="form-group row">
                            <label class="col-md-2 control-label">' . $_language->module[ 'remove_ban' ] . ':</label>
                        <div class="col-md-8"><span class="text-muted small"><em>
                            <input type="checkbox" name="remove_ban" value="1" /></em></span>
                        </div>
                    </div>  ';
            }
            echo '
			


            <div class="form-group row">
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
} elseif ($action == "addtoclan") {
    echo '<div class="card">
        <div class="card-header">
            <i class="fas fa-user-cog"></i> ' . $_language->module[ 'users' ] . '
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

    



 echo'<form class="form-horizontal" method="post" action="admincenter.php?site=users&amp;page='.(int)$_GET['page'].'">
    <div class="form-group row">
        <label class="col-md-2 control-label">'.$_language->module['nickname'].':</label>
        <div class="col-md-8">'.$nickname.'
        </div>
    </div>

    <div class="form-group row">
        <label class="col-md-2 control-label">'.$_language->module['squad'].':</label>
        <div class="col-md-8"><select class="form-control" name="squad">'.$squads.'</select>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-md-2 control-label">'.$_language->module['position'].':</label>
        <div class="col-md-8"><input class="form-control" type="text" name="position" size="20" />
        </div>
    </div>
 
    <div class="form-group row">
        <label class="col-md-2 control-label">'.$_language->module['activity'].':</label>
        <div class="col-md-8">
        <input type="radio" name="activity" value="1" checked="checked" /> '.$_language->module['active'].' &nbsp; 
        <input type="radio" name="activity" value="0" /> '.$_language->module['inactive'].'
        </div>
    </div>

    <div class="form-group row">
        <div class="col-md-offset-2 col-md-8"><input type="hidden" name="captcha_hash" value="'.$hash.'" /><input type="hidden" name="id" value="'.$id.'" />
        <button class="btn btn-success" type="submit" name="add">'.$_language->module['add_to_clan'].'</button>
        </div>
    </div>
  </form>
  </div></div>';
} elseif ($action == "adduser") {
    $CAPCLASS = new \webspell\Captcha;
    $CAPCLASS->createTransaction();
    $hash = $CAPCLASS->getHash();

    echo '<div class="card">
        <div class="card-header">
            <i class="fas fa-user-plus"></i> ' . $_language->module[ 'users' ] . '
        </div>
            
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="admincenter.php?site=users">' . $_language->module[ 'users' ] . '</a></li>
    <li class="breadcrumb-item active" aria-current="page">' . $_language->module[ 'add_new_user' ] . '</li>
  </ol>
</nav>
     <div class="card-body">';

    echo '<form class="form-horizontal" method="post" action="admincenter.php?site=users" enctype="multipart/form-data">



<div class="form-group row">
    <label class="col-md-2 control-label">' . $_language->module[ 'nickname' ] . ':</label>
    <div class="col-md-8"><span class="text-muted small"><em>
    <input class="form-control" type="text" name="nickname" size="60" /></em></span>
    </div>
  </div>

  <div class="form-group row">
    <label class="col-md-2 control-label">' . $_language->module[ 'email' ] . ':</label>
    <div class="col-md-8"><span class="text-muted small"><em>
    <input class="form-control" type="text" name="email" size="60" /></em></span>
    </div>
  </div>

<div class="form-group row">
    <label class="col-md-2 control-label">' . $_language->module[ 'password' ] . ':</label>
    <div class="col-md-8"><span class="text-muted small"><em>
    <input class="form-control" type="password" name="pass" size="60" /></em></span>
    </div>
  </div>
<div class="form-group row">
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
            <i class="fas fa-user-edit"></i> ' . $_language->module[ 'users' ] . '
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

    if ($ds[ 'userpic' ]) {
        $viewpic = '<a href="javascript:void(0);" onclick="window.open(\'../images/userpics/' . $ds[ 'userpic' ] .
            '\',\'userpic\',\'width=250,height=230\')">' . $_language->module[ 'picture' ] . '</a>';
    } else {
        $viewpic = $_language->module[ 'picture' ];
    }
    if ($ds[ 'avatar' ]) {
        $viewavatar = '<a href="javascript:void(0);" onclick="window.open(\'../images/avatars/' . $ds[ 'avatar' ] .
            '\',\'avatar\',\'width=120,height=120\')">' . $_language->module[ 'avatar' ] . '</a>';
    } else {
        $viewavatar = $_language->module[ 'avatar' ];
    }
    $sex = '<option value="m">' . $_language->module[ 'male' ] . '</option><option value="f">' .
        $_language->module[ 'female' ] . '</option><option value="u">' . $_language->module[ 'not_available' ] .
        '</option>';
    $sex = str_replace('value="' . $ds[ 'sex' ] . '"', 'value="' . $ds[ 'sex' ] . '" selected="selected"', $sex);
    $b_day = mb_substr($ds[ 'birthday' ], 8, 2);
    $b_month = mb_substr($ds[ 'birthday' ], 5, 2);
    $b_year = mb_substr($ds[ 'birthday' ], 0, 4);

    $CAPCLASS = new \webspell\Captcha;
    $CAPCLASS->createTransaction();
    $hash = $CAPCLASS->getHash();

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

    echo '<form class="form-horizontal" method="post" enctype="multipart/form-data" action="admincenter.php?site=users&amp;page='.$_GET['page'].'">

   <div class="form-group row">
    <label class="col-md-2 control-label">'.$_language->module['user_id'].'</label>
    <div class="col-md-8">
      <p class="form-control-static">'.$ds['userID'].'</p>
    </div>
  </div>
  <form class="form-horizontal">
  <div class="form-group row">
    <label class="col-md-2 control-label"><i>'.$_language->module['general'].'</i></label>
    <div class="col-md-8">
      <p class="form-control-static"></p>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-2 control-label">'.$_language->module['nickname'].'</label>
    <div class="col-md-8">
    <input class="form-control" type="text" name="nickname" value="'.$ds['nickname'].'" />
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-2 control-label">'.$_language->module['email'].'</label>
    <div class="col-md-8">
    <input class="form-control" type="text" name="email" value="'.getinput($ds['email']).'" />
    </div>
  </div>
<div class="form-group row">
    <label class="col-md-2 control-label">'.$_language->module['special_rank'].'</label>
    <div class="col-md-8">
    <select class="form-control" name="special_rank">' . $ranks . '</select>
    </div>
  </div>









  <form class="form-horizontal">
  <div class="form-group row">
    <label class="col-md-2 control-label"><i>'.$_language->module['pictures'].'</i></label>
    <div class="col-md-8">
      <p class="form-control-static"></p>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-2 control-label">'.$viewavatar.'</label>
    <div class="col-md-8">
    <input name="avatar" type="file" size="40" /> <small>'.$_language->module['max_90x90'].'</small><br><input type="checkbox" name="avatar" value="1" /> '.$_language->module['delete_avatar'].'
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-2 control-label">'.$viewpic.'</label>
    <div class="col-md-8">
    <input name="userpic" type="file" size="40" /> <small>'.$_language->module['max_285x250'].'</small><br><input type="checkbox" name="userpic" value="1" /> '.$_language->module['delete_picture'].'
    </div>
  </div>
  <form class="form-horizontal">
  <div class="form-group row">
    <label class="col-md-2 control-label"><i>'.$_language->module['personal'].'</i></label>
    <div class="col-md-8">
      <p class="form-control-static"></p>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-2 control-label">'.$_language->module['firstname'].'</label>
    <div class="col-md-8">
    <input class="form-control" type="text" name="firstname" value="'.getinput($ds['firstname']).'" />
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-2 control-label">'.$_language->module['lastname'].'</label>
    <div class="col-md-8">
    <input class="form-control" type="text" name="lastname" value="'.getinput($ds['lastname']).'" />
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-2 control-label">'.$_language->module['birthday'].'</label>
    <div class="col-md-1">
    <input class="form-control" type="text" name="b_day" value="'.getinput($b_day).'" size="2" />
      .</div><div class="col-md-1">
      <input class="form-control" type="text" name="b_month" value="'.getinput($b_month).'" size="2" />
      .</div><div class="col-md-1">
      <input class="form-control" type="text" name="b_year" value="'.getinput($b_year).'" size="4" />
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-2 control-label">'.$_language->module['gender'].'</label>
    <div class="col-md-8">
    <select class="form-control" name="sex">'.$sex.'</select>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-2 control-label">'.$_language->module['town'].'</label>
    <div class="col-md-8">
    <input class="form-control" type="text" name="town" value="'.getinput($ds['town']).'" size="60" />
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-2 control-label">'.$_language->module['icq'].'</label>
    <div class="col-md-8">
    <input class="form-control" type="text" name="icq" value="'.getinput($ds['icq']).'" size="60" />
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-2 control-label">'.$_language->module['homepage'].'</label>
    <div class="col-md-8">
    <input class="form-control" type="text" name="homepage" value="'.getinput($ds['homepage']).'" size="60" />
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-2 control-label">'.$_language->module['signatur'].'</label>
    <div class="col-md-8">
    <textarea class="ckeditor" id="ckeditor" name="usertext" rows="5" cols="">'.getinput($ds['usertext']).'</textarea>
    </div>
  </div><div class="form-group row">
    <label class="col-md-2 control-label">'.$_language->module['about_myself'].'</label>
    <div class="col-md-8">
    <textarea class="ckeditor" id="ckeditor" name="about" rows="5" cols="">'.getinput($ds['about']).'</textarea>
    </div>
  </div>
  <form class="form-horizontal">
  <div class="form-group row">
    <label class="col-md-2 control-label"><b>'.$_language->module['social-media'].'</b></label>
    <div class="col-md-8">
      <p class="form-control-static"></p>
    </div>
  </div>
  

  <div class="form-group row">
    <label class="col-md-2 control-label">'.$_language->module['twitch'].'</label>
    <div class="col-md-8">
    <input class="form-control" type="text" name="twitch" value="'.getinput($ds['twitch']).'" size="60" />
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-2 control-label">'.$_language->module['youtube'].'</label>
    <div class="col-md-8">
    <input class="form-control" type="text" name="youtube" value="'.getinput($ds['youtube']).'" size="60" />
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-2 control-label">'.$_language->module['twitter'].'</label>
    <div class="col-md-8">
    <input class="form-control" type="text" name="twitter" value="'.getinput($ds['twitter']).'" size="60" />
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-2 control-label">'.$_language->module['instagram'].'</label>
    <div class="col-md-8">
    <input class="form-control" type="text" name="instagram" value="'.getinput($ds['instagram']).'" size="60" />
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-2 control-label">'.$_language->module['facebook'].'</label>
    <div class="col-md-8">
    <input class="form-control" type="text" name="facebook" value="'.getinput($ds['facebook']).'" size="60" />
    </div>
  </div>
  



  <div class="form-group row">
    <div class="col-md-offset-2 col-md-8">
    <input type="hidden" name="captcha_hash" value="'.$hash.'" /><input type="hidden" name="id" value="'.$id.'" />
      <button class="btn btn-primary" type="submit" name="edit" />'.$_language->module['edit_profile'].'</button>
    </div>
  </div>
    </form>';
} else {
    echo '<div class="card">
        <div class="card-header">
            <i class="fas fa-users-cog"></i> ' . $_language->module[ 'users' ] . '
        </div>
<div class="card-body">';

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
	  				            forum='1' OR user='1' OR news='1' OR clanwars='1' OR feedback='1' OR super='1' OR
	  				            gallery='1' OR cash='1' OR files='1') LIMIT 0,1) =u.userID,2,
	  					IF( 	(SELECT userID FROM " . PREFIX . "user_groups WHERE userID=u.userID AND
	  					    moderator='1' LIMIT 0,1) = u.userID, 3,
	  						IF( 	(SELECT userID FROM " . PREFIX . "squads_members WHERE
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
        if (!isset($_GET[ 'sort' ])) {
            $_GET[ 'sort' ] = '';
        }
        if ($status === true) {
            $sort = "status";
        } elseif (($_GET[ 'sort' ] == 'nickname') || ($_GET[ 'sort' ] == 'registerdate')) {
            $sort = $_GET[ 'sort' ];
        }
        

        echo '<table width="100%" border="0" cellspacing="1" cellpadding="3">
     
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
        <th><b>' . $_language->module[ 'sort' ] . '</b></th>
      </tr></thead>
          <tbody>';

        $n = 1;
        $i = 1;
        while ($ds = mysqli_fetch_array($ergebnis)) {
            

            $id = $ds[ 'userID' ];
            $registered = getformatdatetime($ds[ 'registerdate' ]);
            $nickname = getnickname($ds[ 'userID' ]);

            if (issuperadmin($ds[ 'userID' ]) && isclanmember($ds[ 'userID' ])) {
                $status = $_language->module[ 'superadmin' ] . '<br />&amp; ' . $_language->module[ 'clanmember' ];
            } elseif (issuperadmin($ds[ 'userID' ])) {
                $status = $_language->module[ 'superadmin' ];
            } elseif (isanyadmin($ds[ 'userID' ]) && isclanmember($ds[ 'userID' ])) {
                $status = $_language->module[ 'admin' ] . '<br />&amp; ' . $_language->module[ 'clanmember' ];
            } elseif (isanyadmin($ds[ 'userID' ])) {
                $status = $_language->module[ 'admin' ];
            } elseif (isanymoderator($ds[ 'userID' ]) && isclanmember($ds[ 'userID' ])) {
                $status = $_language->module[ 'moderator' ] . '<br />&amp; ' . $_language->module[ 'clanmember' ];
            } elseif (isanymoderator($ds[ 'userID' ])) {
                $status = $_language->module[ 'moderator' ];
            } elseif (isclanmember($ds[ 'userID' ])) {
                $status = $_language->module[ 'clanmember' ];
            } else {
                $status = $_language->module[ 'user' ];
            }

            if (isbanned($ds[ 'userID' ])) {
                $banned = '<a class="btn btn-success" href="admincenter.php?site=users&amp;action=ban&amp;id=' . $ds[ 'userID' ] .
                    '" class="input">' . $_language->module[ 'undo_ban' ] . '</a>';
            } else {
                $banned = '<a class="btn btn-danger" href="admincenter.php?site=users&amp;action=ban&amp;id=' . $ds[ 'userID' ] .
                    '" class="input">' . $_language->module[ 'banish' ] . '</a>';
            }

            if ($ds[ 'activated' ] == "1") {
                $actions =
                    '<a class="btn btn-success" href="admincenter.php?site=users&amp;page=' . $page . '&amp;action=addtoclan&amp;id=' . $ds[ 'userID' ] .
                    '" class="input">' . $_language->module[ 'to_clan' ] . '</a> |
                     <a class="btn btn-warning" href="admincenter.php?site=members&amp;action=edit&amp;id=' . $ds[ 'userID' ] .
                    '" class="input">' . $_language->module[ 'rights' ] . '</a> |
                    <a class="btn btn-success" href="admincenter.php?site=users&amp;action=profile&amp;page=' . $page . '&amp;id=' . $ds[ 'userID' ] .
                    '" class="input">' . $_language->module[ 'profile' ] . '</a>';
            } else {
                $actions = '<a class="btn btn-info" href="admincenter.php?site=users&amp;action=activate&amp;id=' .
                    $ds[ 'userID' ] . '&amp;captcha_hash=' . $hash . '" class="input">' .
                    $_language->module[ 'activate' ] . '</a>';
            }

            echo '<tr>
        <td>' . $registered . '</td>
        <td><a href="../index.php?site=profile&amp;id=' . $id . '" target="_blank">' .
                strip_tags(stripslashes($nickname)) . '</a></td>
        <td><small>' . $status . '</small></td>
        <td>' . $banned . '</td>
        <td>' . $actions . '</td>
        <td align="center" width="6%">
        <input class="btn btn-danger" type="button" onclick="MM_confirm(\'' . $_language->module['really_delete'] . '\', \'admincenter.php?site=users&amp;page=' . $page .
                '&amp;delete=true&amp;id=' .
                $ds[ 'userID' ] . '&amp;captcha_hash=' . $hash . '\')" value="' . $_language->module['del'] . '" />     

      
     </td>
        </tr>';

            $i++;
        }
        echo '</tbody></table>
    <br /><br /><a class="btn btn-primary" type="button" href="admincenter.php?site=users&amp;action=adduser"><b>' .
            $_language->module[ 'add_new_user' ] . '</b></a>';
    } else {
        echo $_language->module[ 'no_users' ];
    }
echo '</div><div>';

}
?>
