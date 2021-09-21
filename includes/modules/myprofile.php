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

$_language->readModule('myprofile');

if (!$userID) {
    echo $_language->module['not_logged_in'];
} else {
    $showerror = '';
    
    $data_array['$profile_info'] = $_language->module[ 'profile_info' ];
    $template = $tpl->loadTemplate("myprofile","head", $data_array);
    echo $template;

    if (isset($_POST['submit'])) {
        $nickname = htmlspecialchars(mb_substr(trim($_POST['nickname']), 0, 30));
        if (strpos($nickname, "'") !== false) {
            $nickname = ""; 
        }
        if (isset($_POST['mail'])) {
            $mail = $_POST['mail'];
        } else {
            $mail = "";
        }

        if (isset($_POST['newsletter'])) {
            $newsletter = $_POST['newsletter'];
        } else {
            $newsletter = "0";
        }
        
        $usertext = $_POST['usertext'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $birthday = date("Y-m-d", strtotime($_POST['birthday']));
        $sex = $_POST['sex'];
        $town = $_POST['town'];
        $about = $_POST['messageabout'];
        $email_hide = $_POST['email_hide'];
        $twitch = $_POST['twitch'];
        $youtube = $_POST['youtube'];
        $twitter = $_POST['twitter'];
        $instagram = $_POST['instagram'];
        $facebook = $_POST['facebook'];
        $steam = $_POST['steam'];
        $homepage = str_replace('http://', '', $_POST['homepage']);
        $pm_mail = $_POST['pm_mail'];
        $language = $_POST['language'];
        $date_format = $_POST['date_format'];
        $time_format = $_POST['time_format'];
        
        $id = $userID;

        $error_array = array();

        if (isset($_POST['userID']) || isset($_GET['userID']) || $userID == "") {
            die($_language->module['not_logged_in']);
        }

        if (isset($_POST['delavatar'])) {
            $filepath = "./images/avatars/";
            if (file_exists($filepath . $id . '.gif')) {
                @unlink($filepath . $id . '.gif');
            }
            if (file_exists($filepath . $id . '.jpg')) {
                @unlink($filepath . $id . '.jpg');
            }
            if (file_exists($filepath . $id . '.png')) {
                @unlink($filepath . $id . '.png');
            }
            safe_query("UPDATE " . PREFIX . "user SET avatar='' WHERE userID='" . $id . "'");
        }
        if (isset($_POST['deluserpic'])) {
            $filepath = "./images/userpics/";
            if (file_exists($filepath . $id . '.gif')) {
                @unlink($filepath . $id . '.gif');
            }
            if (file_exists($filepath . $id . '.jpg')) {
                @unlink($filepath . $id . '.jpg');
            }
            if (file_exists($filepath . $id . '.png')) {
                @unlink($filepath . $id . '.png');
            }
            safe_query("UPDATE " . PREFIX . "user SET userpic='' WHERE userID='" . $id . "'");
        }

        //avatar
        $filepath = "./images/avatars/";

        $_language->readModule('formvalidation', true);

        $upload = new \webspell\HttpUpload('avatar');
        if (!$upload->hasFile()) {
            $upload = new \webspell\UrlUpload($_POST['avatar_url']);
        }

        if ($upload->hasFile()) {
            if ($upload->hasError() === false) {
                $mime_types = array('image/jpeg','image/png','image/gif');
                if ($upload->supportedMimeType($mime_types)) {
                    $imageInformation =  getimagesize($upload->getTempFile());
                    if (is_array($imageInformation)) {
                        if ($imageInformation[0] < 101 && $imageInformation[1] < 101) {
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
                            $error_array[] = sprintf($_language->module[ 'image_too_big' ], 100, 100);
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
        $filepath = "./images/userpics/";

        $upload = new \webspell\HttpUpload('userpic');
        if (!$upload->hasFile()) {
            $upload = new \webspell\UrlUpload($_POST['userpic_url']);
        }

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

        if (empty($nickname)) {
            $error_array[] = $_language->module['you_have_to_nickname'];
        }

        $qry = "SELECT userID FROM " . PREFIX . "user WHERE nickname = '" . $nickname . "' AND userID!=" . $userID .
            " LIMIT 0,1";
        if (mysqli_num_rows(safe_query($qry))) {
            $error_array[] = $_language->module['nickname_already_in_use'];
        }

        if (count($error_array)) {
            $showerror = generateErrorBoxFromArray($_language->module['errors_there'], $error_array);
        } else {
            safe_query(
                "UPDATE `" . PREFIX . "user`
                    SET
                        nickname='" . $nickname . "',
                        email_hide='" . $email_hide . "',
                        firstname='" . $firstname . "',
                        lastname='" . $lastname . "',
                        sex='" . $sex . "',
                        town='" . $town . "',
                        newsletter='" . $newsletter . "',
                        birthday='" . $birthday . "',
                        usertext='" . $usertext . "',
                        mailonpm='" . $pm_mail . "',
                        homepage='" . $homepage . "',
                        twitch='" . $twitch . "',
                        youtube='" . $youtube . "',
                        twitter='" . $twitter . "',
                        instagram='" . $instagram . "',
                        facebook='" . $facebook . "',
                        steam='" . $steam . "',
                        about='" . $about . "',
                        date_format='" . $date_format . "',
                        time_format='" . $time_format . "',
                        language='" . $language . "'
                    WHERE
                        userID='" . $id . "'"
            );

            redirect("index.php?site=profile&amp;id=$id", $_language->module['profile_updated'], 3);
        }
    }

    if (isset($_GET['action']) && $_GET['action'] == "editpwd") {
        
        $data_array = array();
        $data_array['$userID'] = $userID;
        
        $data_array['$edit_password'] = $_language->module[ 'edit_password' ];
        $data_array['$old_password'] = $_language->module[ 'old_password' ];
        $data_array['$new_password'] = $_language->module[ 'new_password' ];
        $data_array['$repeat_new_password'] = $_language->module[ 'repeat_new_password' ];
        $data_array['$back'] = $_language->module[ 'back' ];
        $data_array['$change_password'] = $_language->module[ 'change_password' ];
        
        $template = $tpl->loadTemplate("myprofile","editpwd", $data_array);
        echo $template;
    } elseif (isset($_POST['savepwd'])) {
        $oldpwd = $_POST['oldpwd'];
        $pwd1 = $_POST['pwd1'];
        $pwd2 = $_POST['pwd2'];
        $id = $userID;

        $error = "";

        $ergebnis = safe_query("SELECT password_hash, password_pepper FROM " . PREFIX . "user WHERE userID='" . intval($id) . "'");
        $ds = mysqli_fetch_array($ergebnis);

		$valid = password_verify($oldpwd.$ds['password_pepper'], $ds['password_hash']);
		
        if (!$valid) {
            $error = $_language->module['forgot_old_pw'];
        }
		
		$old_pwd = Gen_PasswordHash($oldpwd, $userID);
		$new_pwd = Gen_PasswordHash($pwd1, $userID);
		$new_verify = Gen_PasswordHash($pwd2, $userID);
		$p = Get_PasswordPepper($userID);
		$valid = password_verify($oldpwd.$p, $ds['password_hash']);
		if (!$valid) {
            $error = $_language->module['old_pw_not_valid'];
        }
		
        if ($pwd1!=$pwd2) {
            $error = $_language->module['repeated_pw_not_valid'];
        }

        if (empty($error)) {
			
			// delete old pepper hash
			destroy_PasswordPepper($userID);
			// generate a new pepper
			$new_pepper = Gen_PasswordPepper();
			// set new pepper into database
			Set_PasswordPepper($new_pepper, $userID);
			// Generate the new password with the new pepper
			$pass = Gen_PasswordHash($pwd1, $userID);
			
			// set new password into the database
            safe_query("UPDATE " . PREFIX . "user SET password_hash='" . $pass . "' WHERE userID='" . intval($userID) . "'");
            //logout
            unset($_SESSION['ws_user']);
            unset($_SESSION['ws_lastlogin']);
            session_destroy();

            redirect('/index.php?site=logout', $_language->module['pw_changed'], 3);
        } else {
            echo '<blockquote><strong>ERROR: ' . $error . '</strong><br><br>
                <input type="button" onclick="javascript:history.back()" value="' . $_language->module['back'] . '"></blockquote>';
        }

       
    } elseif (isset($_GET['action']) && $_GET['action'] == "editmail") {
        
        $data_array = array();
        $data_array['$userID'] = $userID;
        
        $data_array['$edit_mail'] = $_language->module[ 'edit_mail' ];
        $data_array['$password'] = $_language->module[ 'password' ];
        $data_array['$new_email'] = $_language->module[ 'new_email' ];
        $data_array['$repeat_new_email'] = $_language->module[ 'repeat_new_email' ];
        $data_array['$back'] = $_language->module[ 'back' ];
        $data_array['$change_mail'] = $_language->module[ 'change_mail' ];
        
        $template = $tpl->loadTemplate("myprofile","editmail", $data_array);
        echo $template;
    } elseif (isset($_POST['savemail'])) {
        $activationkey = md5(RandPass(20));
        $activationlink = '<a href="' . $hp_url . '/index.php?site=register&mailkey=' . $activationkey. '">' . $hp_url . '/index.php?site=register&mailkey=' . $activationkey.'</a>';
        $pwd = $_POST['oldpwd'];
        $mail1 = $_POST['mail1'];
        $mail2 = $_POST['mail2'];

        $ergebnis = safe_query("SELECT password_hash, password_pepper, password, nickname FROM " . PREFIX . "user WHERE userID='" . $userID . "'");
        $ds = mysqli_fetch_array($ergebnis);
        $error = "";
        $nickname = $ds['nickname'];
        $valid = password_verify($pwd.$ds['password_pepper'], $ds['password_hash']);
        if (!(mb_strlen(trim($pwd)))) {
            $error = $_language->module['forgot_old_pw'];
        }
        if (!$valid) {
            $error = $_language->module['wrong_password'];
        }
        if ($mail1 == $mail2) {
            if (!(mb_strlen(trim($mail1)))) {
                $error = $_language->module['mail_not_valid'];
            }
        } else {
            $error = $_language->module['repeated_mail_not_valid'];
        }

        // check e-mail

        if (!validate_email($mail1)) {
            $error = $_language->module['invalid_mail'];
        }

        if (empty($error)) {
            safe_query(
                "UPDATE
                    " . PREFIX . "user
                SET
                    email_change = '" . $mail1 . "', email_activate = '" . $activationkey . "'
                WHERE
                    userID='" . $userID . "'"
            );

            $ToEmail = $mail1;
            $header = str_replace(array('%homepage_url%'), array($hp_url), $_language->module['mail_subject']);
            $Message = str_replace(
                array('%nickname%', '%activationlink%', '%pagetitle%', '%homepage_url%'),
                array(stripslashes($nickname), stripslashes($activationlink), $hp_title, $hp_url),
            
                $_language->module['mail_text']
            );

            $sendmail = \webspell\Email::sendEmail($admin_email, 'Profile', $ToEmail, $header, $Message);

            if ($sendmail['result'] == 'fail') {
                if (isset($sendmail['debug'])) {
                    $fehler = array();
                    $fehler[] = $sendmail['error'];
                    $fehler[] = $sendmail['debug'];
                    echo generateErrorBoxFromArray($_language->module['mail_failed'], $fehler);
                } else {
                    $fehler = array();
                    $fehler[] = $sendmail['error'];
                    echo generateErrorBoxFromArray($_language->module['mail_failed'], $fehler);
                }
            } else {
                if (isset($sendmail['debug'])) {
                    $fehler = array();
                    $fehler[] = $sendmail[ 'debug' ];
                    echo generateBoxFromArray($_language->module['mail_changed'], 'alert-success', $fehler);
                } else {
                    redirect('/index.php', $_language->module['mail_changed'], 3);
                }
            }
        } else {
            echo '<blockquote><strong>ERROR: ' . $error . '</strong><br><br>
            <input type="button" onclick="javascript:history.back()" value="' . $_language->module['back'] . '"></blockquote>';
        }
    } elseif(isset($_GET['action']) && $_GET['action'] == "deleteaccount") {
	    
	    $data_array = array();
        $data_array['$userID'] = $userID;
        
        $data_array['$del_realy']=$_language->module[ 'del_realy' ];
        $data_array['$password']=$_language->module[ 'password' ];
        $data_array['$back']=$_language->module[ 'back' ];
        $data_array['$del_acc']=$_language->module[ 'del_acc' ];

        $template = $tpl->loadTemplate("myprofile","deleteaccount", $data_array);
        echo $template;
    	
    } elseif(isset($_POST['deleteAccount'])) {
	    $pwd = $_POST['pwd'];
	    $ergebnis = safe_query("SELECT password_hash, password_pepper, password, userID FROM " . PREFIX . "user WHERE userID='" . $userID . "'");
        $ds = mysqli_fetch_array($ergebnis);
        
        $valid = password_verify($pwd.$ds['password_pepper'], $ds['password_hash']);
        if (!(mb_strlen(trim($pwd)))) {
            $error = $_language->module['forgot_old_pw'];
        }
        if (!$valid) {
            $error = $_language->module['wrong_password'];
        }
        
        if(empty($error)) {
	        safe_query("DELETE FROM ".PREFIX."squads_members WHERE userID='" .$ds['userID']. "'");
			safe_query("DELETE FROM ".PREFIX."user WHERE userID='" .$ds['userID']. "'");
			safe_query("DELETE FROM ".PREFIX."user_groups WHERE userID='" .$ds['userID']. "'");
			
			$userfiles = array('images/avatars/' . $ds['userID'] . '.jpg', 'images/avatars/' . $ds['userID'] . '.png', 'images/avatars/' . $ds['userID'] . '.gif', 'images/userpics/' . $ds['userID'] . '.jpg', 'images/userpics/' . $ds['userID'] . '.gif', 'images/userpics/' . $ds['userID'] . '.png');
			foreach($userfiles as $file) {
				if(file_exists($file)) {
					unlink($file);
				}
			}
			redirect('/index.php?site=logout', $_language->module['acc_deletet'], 8);
       
			unset($_SESSION['ws_auth']);
			unset($_SESSION['ws_lastlogin']);
			session_destroy();	        
        } else {
	        echo '<blockquote><strong>ERROR: ' . $error . '</strong><br><br>
            <input type="button" onclick="javascript:history.back()" value="' . $_language->module['back'] . '"></blockquote>';
        }
	    
	} else {
        $ergebnis = safe_query("SELECT * FROM " . PREFIX . "user WHERE userID='" . $userID . "'");
        $anz = mysqli_num_rows($ergebnis);
        if ($anz) {
            $ds = mysqli_fetch_array($ergebnis);
            
            $sex = '<option value="m">' . $_language->module['male'] . '</option><option value="f">' .
                $_language->module['female'] . '</option><option value="d">' .
                $_language->module['diverse'] . '</option><option value="u">' . $_language->module['unknown'] .
                '</option>';
            $sex =
                str_replace('value="' . $ds['sex'] . '"', 'value="' . $ds['sex'] . '" selected="selected"', $sex);
            if ($ds['mailonpm'] == "1") {
                $pm_mail = '<option value="1" selected="selected">' . $_language->module['yes'] .
                    '</option><option value="0">' . $_language->module['no'] . '</option>';
            } else {
                $pm_mail = '<option value="1">' . $_language->module['yes'] .
                    '</option><option value="0" selected="selected">' . $_language->module['no'] . '</option>';
            }
            
            if ($ds['email_hide'] == "1") {
                $email_hide = '<option value="1" selected="selected">' . $_language->module['yes'] .
                    '</option><option value="0">' . $_language->module['no'] . '</option>';
            } else {
                $email_hide = '<option value="1">' . $_language->module['yes'] .
                    '</option><option value="0" selected="selected">' . $_language->module['no'] . '</option>';
            };

            if ($ds['newsletter'] == "1") {
                $letter = '<option value="1" selected="selected">' . $_language->module['yes'] .
                    '</option><option value="0">' . $_language->module['no'] . '</option>';
            } else {
                $letter = '<option value="1">' . $_language->module['yes'] .
                    '</option><option value="0" selected="selected">' . $_language->module['no'] . '</option>';
            };

            $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "plugins WHERE modulname='nletter'"));
                if (@$dx[ 'modulname' ] != 'nletter') {
                    $newsletter = '';
                } else {
                    $newsletter = '<div class="form-group">
                                    <label for="newsletter" class="control-label">' . $_language->module['newsletter'] . '</label>
                                    <select id="newsletter" name="newsletter" class="form-control">' . $letter . '</select>
                                    </div>';
                };



            $format_date = "<option value='d.m.y'>DD.MM.YY</option>
                <option value='d.m.Y'>DD.MM.YYYY</option>
                <option value='j.n.y'>D.M.YY</option>
                <option value='j.n.Y'>D.M.YYYY</option>
                <option value='y-m-d'>YY-MM-DD</option>
                <option value='Y-m-d'>YYYY-MM-DD</option>
                <option value='y/m/d'>YY/MM/DD</option>
                <option value='Y/m/d'>YYYY/MM/DD</option>";
            $format_date = str_replace(
                "value='" . $ds['date_format'] . "'",
                "value='" . $ds['date_format'] . "' selected='selected'",
                $format_date
            );

            $format_time = "<option value='G:i'>H:MM</option>
                <option value='H:i'>HH:MM</option>
                <option value='G:i a'>H:MM am/pm</option>
                <option value='H:i a'>HH:MM am/pm</option>
                <option value='G:i A'>H:MM AM/PM</option>
                <option value='H:i A'>HH:MM AM/PM</option>
                <option value='G:i:s'>H:MM:SS</option>
                <option value='H:i:s'>HH:MM:SS</option>
                <option value='G:i:s a'>H:MM:SS am/pm</option>
                <option value='H:i:s a'>HH:MM:SS am/pm</option>
                <option value='G:i:s A'>H:MM:SS AM/PM</option>
                <option value='H:i:s A'>HH:MM:SS AM/PM</option>";
            $format_time = str_replace(
                "value='" . $ds['time_format'] . "'",
                "value='" . $ds['time_format'] . "' selected='selected'",
                $format_time
            );
            
            $birthday = date("Y-m-d", strtotime($ds[ 'birthday' ]));
            
            if ($ds[ 'avatar' ]) {
                $viewavatar = '<a href="javascript:void(0);" onclick="window.open(\'images/avatars/' .
                    $ds[ 'avatar' ] . '\',\'avatar\',\'width=120,height=120\')">' . $_language->module[ 'avatar' ] .
                    '</a>';
            } else {
                $viewavatar = $_language->module['avatar'];
            }
            if ($ds[ 'userpic' ]) {
                $viewpic = '&#8226; <a href="javascript:void(0);" onclick="window.open(\'images/userpics/' .
                    $ds[ 'userpic' ] . '\',\'userpic\',\'width=250,height=285\')">' . $_language->module[ 'userpic' ] .
                    '</a>';
            } else {
                $viewpic = $_language->module['userpic'];
            }

            $usertext = getinput($ds['usertext']);
            
            
            $firstname = $ds['firstname'];
            $lastname = $ds['lastname'];
            $town = $ds['town'];
            
            $about = getinput($ds['about']);
            $nickname = $ds['nickname'];
            $email = getinput($ds['email']);
            $homepage = getinput($ds['homepage']);
            $twitch = getinput($ds['twitch']);
            $youtube = getinput($ds['youtube']);
            $twitter = getinput($ds['twitter']);
            $instagram = getinput($ds['instagram']);
            $facebook = getinput($ds['facebook']);
            $steam = getinput($ds['steam']);

            // Select all possible languages
            $langdirs = '';
            $filepath = "./languages/";

            $mysql_langs = array();
            $query = safe_query("SELECT lang, language FROM " . PREFIX . "settings_languages");
            while ($sql_lang = mysqli_fetch_assoc($query)) {
                $mysql_langs[$sql_lang['lang']] = $sql_lang['language'];
            }
            $langs = array();
            if ($dh = opendir($filepath)) {
                while ($file = mb_substr(readdir($dh), 0, 2)) {
                    if ($file != "." && $file != ".." && is_dir($filepath . $file)) {
                        if (isset($mysql_langs[$file])) {
                            $name = $mysql_langs[$file];
                            $name = ucfirst($name);
                            $langs[$name] = $file;
                        } else {
                            $langs[$file] = $file;
                        }
                    }
                }
                closedir($dh);
            }
            ksort($langs, SORT_NATURAL);
            foreach ($langs as $lang => $flag) {
                $langdirs .= '<option value="' . $flag . '">' . $lang . '</option>';
            }

            if ($ds['language']) {
                $langdirs =
                    str_replace(
                        '"' . $ds['language'] . '"',
                        '"' . $ds['language'] . '" selected="selected"',
                        $langdirs
                    );
            } else {
                $langdirs =
                    str_replace(
                        '"' . $_language->language . '"',
                        '"' . $_language->language . '" selected="selected"',
                        $langdirs
                    );
            }

            
        $data_array = array();
        $data_array['$showerror'] = $showerror;
        $data_array['$nickname'] = $nickname;
        $data_array['$email'] = $email;
        $data_array['$viewavatar'] = $viewavatar;
        $data_array['$viewpic'] = $viewpic;
        $data_array['$usertext'] = $usertext;
        $data_array['$firstname'] = $firstname;
        $data_array['$lastname'] = $lastname;
        $data_array['$town'] = $town;
        $data_array['$birthday'] = $birthday;
        $data_array['$sex'] = $sex;
        $data_array['$homepage'] = $homepage;
        $data_array['$twitch'] = $twitch;
        $data_array['$youtube'] = $youtube;
        $data_array['$twitter'] = $twitter;
        $data_array['$instagram'] = $instagram;
        $data_array['$facebook'] = $facebook;
        $data_array['$steam'] = $steam;
        $data_array['$about'] = $about;
        $data_array['$langdirs'] = $langdirs;
        $data_array['$pm_mail'] = $pm_mail;
        $data_array['$email_hide'] = $email_hide;
        $data_array['$format_date'] = $format_date;
        $data_array['$format_time'] = $format_time;
        $data_array['$newsletter'] = $newsletter;
            
        $data_array['$profile_info'] = $_language->module[ 'profile_info' ];
        $data_array['$nick_name'] = $_language->module[ 'nickname' ];
        $data_array['$edit_password'] = $_language->module[ 'edit_password' ];
        $data_array['$edit_mail'] = $_language->module[ 'edit_mail' ];
        $data_array['$del_acc'] = $_language->module[ 'del_acc' ];
        $data_array['$delete'] = $_language->module[ 'delete' ];
        $data_array['$or'] = $_language->module[ 'or' ];
        $data_array['$signature'] = $_language->module[ 'signature' ];

        $data_array['$personal_info'] = $_language->module[ 'personal_info' ];
        $data_array['$first_name'] = $_language->module[ 'first_name' ];
        $data_array['$last_name'] = $_language->module[ 'last_name' ];
        $data_array['$lang_town'] = $_language->module[ 'town' ];
        $data_array['$date_of_birth'] = $_language->module[ 'date_of_birth' ];
        $data_array['$sexuality'] = $_language->module[ 'sexuality' ];
        $data_array['$home_page'] = $_language->module[ 'homepage' ];
        $data_array['$about_myself'] = $_language->module[ 'about_myself' ];

        $data_array['$options'] = $_language->module[ 'options' ];
        $data_array['$language'] = $_language->module[ 'language' ];
        $data_array['$mail_on_new_pm'] = $_language->module[ 'mail_on_new_pm' ];
        $data_array['$hide_e-mail'] = $_language->module[ 'hide_e-mail' ];
        $data_array['$formatdate'] = $_language->module[ 'format_date' ];
        $data_array['$formattime'] = $_language->module[ 'format_time' ];
        
        $data_array['$social_media'] = $_language->module[ 'social_media' ];
        $data_array['$media_twitch'] = $_language->module[ 'twitch' ];
        $data_array['$media_youtube'] = $_language->module[ 'youtube' ];
        $data_array['$media_twitter'] = $_language->module[ 'twitter' ];
        $data_array['$media_instagram'] = $_language->module[ 'instagram' ];
        $data_array['$media_facebook'] = $_language->module[ 'facebook' ];
        $data_array['$media_steam'] = $_language->module[ 'steam' ];
        $data_array['$fields_star_required'] = $_language->module[ 'fields_star_required' ];
        $data_array['$update_profile'] = $_language->module[ 'update_profile' ];
        $data_array['$lang_you_have_to_nickname'] = $_language->module[ 'you_have_to_nickname' ];
        $data_array['$lang_you_have_to_firstname'] = $_language->module[ 'you_have_to_firstname' ];
        $data_array['$lang_you_have_to_bday'] = $_language->module[ 'you_have_to_bday' ];

        $data_array['$lang_hint'] = $_language->module['hint'];
        $data_array['$lang_GDPRinfo'] = $_language->module['GDPRinfo'];
        $data_array['$lang_GDPRaccept'] = $_language->module['GDPRaccept'];
        $data_array['$lang_privacy_policy'] = $_language->module['privacy_policy'];

            $template = $tpl->loadTemplate("myprofile","content", $data_array);
            echo $template;
        } else {
            echo $_language->module['not_logged_in'];
        }
    }
}
