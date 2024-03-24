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


// by ZENITH-Developments.de # read database entries (?)
$_admin_minpasslen = "6";
$_admin_maxpasslen = ""; #empty = no max
$_admin_musthavelow = true;
$_admin_musthaveupp = true;
$_admin_musthavenum = true;
$_admin_musthavespec = true;
function pass_complex($pwd,$_admin_minpasslen,$_admin_maxpasslen,$_admin_musthavelow,$_admin_musthaveupp,$_admin_musthavenum,$_admin_musthavespec) {
    if ($_admin_musthavelow==true) { $_pwd_low = "(?=\S*[a-z])"; } else { $_pwd_low=""; }
    if ($_admin_musthaveupp==true) { $_pwd_upp = "(?=\S*[A-Z])"; } else { $_pwd_upp=""; }
    if ($_admin_musthavenum==true) { $_pwd_num = "(?=\S*[\d])"; } else { $_pwd_num=""; }
    if ($_admin_musthavespec==true) { $_pwd_spec = "(?=\S*[\W])"; } else { $_pwd_spec=""; }
    if (!preg_match_all('$\S*(?=\S{'.$_admin_minpasslen.','.$_admin_maxpasslen.'})'.$_pwd_low.$_pwd_upp.$_pwd_num.$_pwd_spec.'\S*$', $pwd)) {
        return false;
    }
    return true;
}

try {
    $get = mysqli_fetch_assoc(safe_query("SELECT * FROM `".PREFIX."settings_recaptcha`"));
    $webkey = $get['webkey'];
    $seckey = $get['seckey'];
    if ($get['activated']=="1") { $recaptcha=1; } else { $recaptcha=0; }
} Catch (EXCEPTION $e) {
    $recaptcha=0;
}

$_language->readModule('register');


    $data_array = array();
    $data_array['$title'] = $_language->module[ 'title' ];
    $template = $tpl->loadTemplate("register","head", $data_array);
    echo $template;

$show = true;
if (isset($_POST['save'])) {
    if (!$loggedin) {
        $nickname = htmlspecialchars(mb_substr(trim($_POST['nickname']), 0, 30));
        if (strpos($nickname, "'") !== false) {
            $nickname = "";     // contains a ' char the nickname will reset (handle as not entered)
        }
        $password = $_POST['password'];
        $password2 = $_POST['password2'];
        $gender = $_POST['gender'];
        $birthday = $_POST['birthday'];
        $homepage = $_POST['homepage'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
        $town= $_POST[ 'town' ];
        $twitch= $_POST[ 'twitch' ];
        $youtube= $_POST[ 'youtube' ];
        $twitter= $_POST[ 'twitter' ];
        $instagram= $_POST[ 'instagram' ];
        $facebook= $_POST[ 'facebook' ];
        $steam= $_POST[ 'steam' ];
        $topics= '|';

        $mail = $_POST['mail'];
        $CAPCLASS = new \webspell\Captcha;

        $error = array();
        
        // check nickname
        if (!(mb_strlen(trim($nickname)))) {
            $error[] = $_language->module['enter_nickname'];
        }

        // check nickname inuse
        $ergebnis = safe_query("SELECT * FROM " . PREFIX . "user WHERE nickname = '$nickname' ");
        $num = mysqli_num_rows($ergebnis);
        if ($num) {
            $error[] = $_language->module['nickname_inuse'];
        }

        // prüfung passwort
        
        if($password == $password2) {
            if(!(strlen(trim($password)))) 
                $error[] = $_language->module['enter_password'];
        } else {
                $error[] = $_language->module['repeat_invalid'];
        }        

        // check passwort
        if (pass_complex($password,$_admin_minpasslen,$_admin_maxpasslen,$_admin_musthavelow,$_admin_musthaveupp,$_admin_musthavenum,$_admin_musthavespec)==false) {
            $error[] = $_language->module['enter_password2'];
        }

        // check e-mail
        if (!validate_email($mail)) {
            $error[] = $_language->module['invalid_mail'];
        }

        // check e-mail inuse
        $ergebnis = safe_query("SELECT userID FROM " . PREFIX . "user WHERE email = '$mail' ");
        $num = mysqli_num_rows($ergebnis);
        if ($num) {
            $error[] = $_language->module['mail_inuse'];
        }

        // check homepage
        /*if (!(mb_strlen(trim($homepage)))) {
            $error[] = $_language->module['enter_homepage'];
        }*/

        // check captcha
        if($recaptcha=="0") { 
            if (!$CAPCLASS->checkCaptcha($_POST['captcha'], $_POST['captcha_hash'])) {
                $error[] = $_language->module['wrong_securitycode'];
            } else { 
                $runregister = "false"; 
            }
        } else {
      
            $msg='';
            if($_SERVER["REQUEST_METHOD"] == "POST") {
                $recaptcha=$_POST['g-recaptcha-response'];
                if(!empty($recaptcha)) {
                    include("system/curl_recaptcha.php");
                    $google_url="https://www.google.com/recaptcha/api/siteverify";
                    $secret=$seckey;
                    $ip=$_SERVER['REMOTE_ADDR'];
                    $url=$google_url."?secret=".$secret."&response=".$recaptcha."&remoteip=".$ip;
                    $res=getCurlData($url);
                    $res= json_decode($res, true);
                    $runregister = "true";
                    //reCaptcha success check 
                    if(!$res['success']) {
                        $error[] = "reCAPTCHA Error";
                        $runregister = "false";
                    }
                } else {
                    $error[] = "reCAPTCHA Error";
                    $runregister = "false";
                }
            }
        }
        
        // check exisitings accounts from ip with same password
        if(!$register_per_ip) {
            $get_users =
                safe_query(
                    "SELECT
                        userID
                    FROM
                        " . PREFIX . "user
                    WHERE
                        ip='" . $GLOBALS['ip'] . "'"
                );
            if (mysqli_num_rows($get_users)) {
                $error[] = 'Only one Account per IP';
            }
        }

        if (count($error)) {
            $_language->readModule('formvalidation', true);
            $showerror = generateErrorBoxFromArray($_language->module['errors_there'], $error);
        } else {
            // insert in db
            $registerdate = time();
            $activationkey = md5(RandPass(20));
            $activationlink = getCurrentUrl() . '&key=' . $activationkey;
            $newnickname = htmlspecialchars(mb_substr(trim($_POST[ 'nickname' ]), 0, 30));
        $anz = mysqli_num_rows(safe_query(
            "SELECT userID FROM " . PREFIX . "user WHERE (nickname='" . $newnickname . "') "
        ));
            safe_query(
                "INSERT INTO
                    `" . PREFIX . "user` (
                        `registerdate`,
                        `lastlogin`,
                        `nickname`,
                        `email`,
                        `firstname`,
                        `lastname`,
                        `gender`,
                        `birthday`,
                        `homepage`,
                        `town`,
                        `twitch`,
                        `youtube`,
                        `twitter`,
                        `instagram`,
                        `facebook`,
                        `steam`,
                        `topics`,
                        `activated`,
                        `ip`,
                        `date_format`,
                        `time_format`
                    )
                    VALUES (
                        '$registerdate',
                        '$registerdate',
                        '$newnickname',
                        '$mail',
                        '$firstname',
                        '$lastname',
                        '$gender',
                        '$birthday',
                        '$homepage',
                        '$town',
                        '$twitch',
                        '$youtube',
                        '$twitter',
                        '$instagram',
                        '$facebook',
                        '$steam',
                        '|',
                        '" . $activationkey . "',
                        '" . $GLOBALS['ip'] . "',
                        '" . $default_format_date . "',
                        '" . $default_format_time . "'
                    )"
            );
            safe_query("
              INSERT INTO " . PREFIX . "user_nickname ( userID,nickname ) values ('" . mysqli_insert_id($_database) ."','" . $newnickname ."')
            ");

            $insertid = mysqli_insert_id($_database);
            
            // insert Password
            $pass = Gen_PasswordHash(stripslashes($password), $insertid);
            safe_query("UPDATE `".PREFIX."user` SET `password_hash` = '".$pass."' WHERE `userID` = '".intval($insertid)."'");

            // insert in user_groups
            safe_query("INSERT INTO " . PREFIX . "user_groups ( userID ) values('$insertid' )");

            // mail to user
            $ToEmail = $mail;
            $header = str_replace(
                array('%nickname%', '%activationlink%', '%pagetitle%', '%homepage_url%'),
                array(stripslashes($nickname), stripslashes($activationlink), $hp_title, $hp_url),
                $_language->module['mail_subject']
            );
            $Message = str_replace(
                array('%nickname%', '%activationlink%', '%pagetitle%', '%homepage_url%'),
                array(stripslashes($nickname), stripslashes($activationlink), $hp_title, $hp_url),
                $_language->module['mail_text']
            );
            $sendmail = \webspell\Email::sendEmail($admin_email, 'Register', $ToEmail, $header, $Message);

            if ($sendmail['result'] == 'fail') {
                if (isset($sendmail['debug'])) {
                    $fehler = array();
                    $fehler[] = $sendmail[ 'error' ];
                    $fehler[] = $sendmail[ 'debug' ];
                    redirect(
                        "index.php",
                        generateErrorBoxFromArray($_language->module['mail_failed'], $fehler),
                        10
                    );
                    $show = false;
                } else {
                    $fehler = array();
                    $fehler[] = $sendmail['error'];
                    redirect(
                        "index.php",
                        generateErrorBoxFromArray($_language->module['mail_failed'], $fehler),
                        10
                    );
                    $show = false;
                }
            } else {
                if (isset($sendmail['debug'])) {
                    $fehler = array();
                    $fehler[] = $sendmail[ 'debug' ];
                    redirect(
                        "index.php",
                        generateBoxFromArray($_language->module['register_successful'], 'alert-success', $fehler),
                        10
                    );
                    $show = false;
                } else {
                    redirect("index.php", $_language->module['register_successful'], 3);
                    $show = false;
                }
            }
        }
    } else {
        redirect(
            "index.php?site=register",
            str_replace('%pagename%', $GLOBALS['hp_title'], $_language->module['no_register_when_loggedin']),
            3
        );
    }
}
if (isset($_GET['key'])) {
    safe_query("UPDATE `" . PREFIX . "user` SET activated='1' WHERE activated='" . $_GET['key'] . "'");
    if (mysqli_affected_rows($_database)) {
        redirect('index.php?site=login', $_language->module['activation_successful'], 3);
    } else {
        redirect('index.php?site=login', $_language->module['wrong_activationkey'], 3);
    }
} elseif (isset($_GET['mailkey'])) {
    if (mb_strlen(trim($_GET['mailkey'])) == 32) {
        safe_query(
            "UPDATE
                `" . PREFIX . "user`
            SET
                email_activate='1',
                email=email_change,
                email_change=''
            WHERE
                email_activate='" . $_GET['mailkey'] . "'"
        );
        if (mysqli_affected_rows($_database)) {
            redirect('index.php?site=login', $_language->module['mail_activation_successful'], 3);
        } else {
            redirect('index.php?site=login', $_language->module['wrong_activationkey'], 3);
        }
    }
} else {
    if ($show === true) {
        if (!$loggedin)  {
            if(isset($_COOKIE['ws_session'])) {
            
                if($recaptcha=="0") {
                    $CAPCLASS = new \webspell\Captcha;
                    $captcha = $CAPCLASS->createCaptcha();
                    $hash = $CAPCLASS->getHash();
                    $CAPCLASS->clearOldCaptcha();
                    $_captcha = '
                        <span class="input-group-addon captcha-img">'.$captcha.'</span>
                        <input type="number" name="captcha" class="form-control" id="input-security-code" required>
                        <input name="captcha_hash" type="hidden" value="'.$hash.'">
                    ';
                } else {
                    $_captcha = '<div class="g-recaptcha" style="width: 70%; float: left;" data-sitekey="'.$webkey.'"></div>';
                }
                if (!isset($showerror)) {
                    $showerror = '';
                }
                if (isset($_POST['nickname'])) {
                    $nickname = getforminput($_POST['nickname']);
                } else {
                    $nickname = '';
                }
                if (isset($_POST['password'])) {
                    $password = getforminput($_POST['password']);
                } else {
                    $password = '';
                }
                if (isset($_POST['mail'])) {
                    $mail = getforminput($_POST['mail']);
                } else {
                    $mail = '';
                }
				if (isset($_POST['firstname'])) {
                    $firstname = getforminput($_POST['firstname']);
                } else {
                    $firstname = '';
                }
				if (isset($_POST['firstname'])) {
                    $lastname = getforminput($_POST['lastname']);
                } else {
                    $lastname = '';
                }

                $gender = '
                    <option selected disabled value="select_gender">' . $_language->module['select_gender'] . '</option>
                    <option value="male">' . $_language->module['male'] . '</option>
                    <option value="female">' . $_language->module['female'] . '</option>
                    <option value="diverse">' . $_language->module['diverse'] . '</option>';                

                $data_array = array();
                $data_array['$showerror'] = $showerror;
                $data_array['$nickname'] = $nickname;
                $data_array['$password'] = $password;
                $data_array['$mail'] = $mail;
				$data_array['$firstname'] = $firstname;
				$data_array['$lastname'] = $lastname;
                $data_array['$_captcha'] = $_captcha;
                $data_array['$gender'] = $gender;

                $data_array['$registration'] = $_language->module[ 'registration' ];
                $data_array['$info'] = $_language->module[ 'info' ];
                $data_array['$nickname'] = $_language->module[ 'nickname' ];
                $data_array['$for_login'] = $_language->module[ 'for_login' ];
                $data_array['$password'] = $_language->module[ 'password' ];
                $data_array['$mail'] = $_language->module[ 'mail' ];
                $data_array['$security_code'] = $_language->module[ 'security_code' ];
                $data_array['$register_now'] = $_language->module[ 'register_now' ];
                $data_array['$profile_info'] = $_language->module[ 'profile_info' ];
                $data_array['$pass_ver'] = $_language->module[ 'pass_ver' ];
                $data_array['$pass_text'] = $_language->module[ 'pass_text' ];
                $data_array['$lang_GDPRinfo'] = $_language->module['GDPRinfo'];
                $data_array['$lang_GDPRaccept'] = $_language->module['GDPRaccept'];
                $data_array['$lang_GDPRterm'] = $_language->module['GDPRterm'];
                $data_array['$lang_privacy_policy'] = $_language->module['privacy_policy'];
                $data_array['$pw1'] = $_language->module['pw1'];
                $data_array['$pw2'] = $_language->module['pw2'];
                $data_array['$pw3'] = $_language->module['pw3'];
                $data_array['$pw4'] = $_language->module['pw4'];
                $data_array['$pw5'] = $_language->module['pw5'];
                $data_array['$pw6'] = $_language->module['pw6'];
                $data_array['$login'] = $_language->module[ 'login' ];
                $data_array['$email_address'] = $_language->module[ 'email_address' ];
                $data_array['$already_have_an_account'] = $_language->module['already_have_an_account'];
                $data_array['$enter_your_email'] = $_language->module['enter_your_email'];
                $data_array['$enter_your_name'] = $_language->module['enter_your_name'];
                $data_array['$enter_password'] = $_language->module['enter_password'];
                $data_array['$repeat'] = $_language->module['repeat'];
                $data_array['$info1'] = $_language->module['info1'];
                $data_array['$info2'] = $_language->module['info2'];
                $data_array['$date_of_birth'] = $_language->module[ 'date_of_birth' ];
                $data_array['$lang_gender'] = $_language->module[ 'gender' ];
                $data_array['$homepage1'] = $_language->module[ 'homepage1' ];
                $data_array['$homepage2'] = $_language->module[ 'homepage2' ];
                $data_array['$lang_town1'] = $_language->module[ 'town1' ];
                $data_array['$lang_town2'] = $_language->module[ 'town2' ];
                $data_array['$fields_star_required'] = $_language->module[ 'fields_star_required' ];
                $data_array['$enter_your_firstname'] = $_language->module['enter_your_firstname'];
                $data_array['$enter_your_lastname'] = $_language->module['enter_your_lastname'];
                $data_array['$firstname'] = $_language->module['firstname'];
                $data_array['$lastname'] = $_language->module['lastname'];
                $data_array['$already_account'] = $_language->module['already_account'];

                $data_array['$social_&_security_code'] = $_language->module['social_&_security_code'];
                $data_array['$login_data'] = $_language->module['login_data'];
                $data_array['$personal_data'] = $_language->module['personal_data'];
                $data_array['$next'] = $_language->module[ 'next' ];
                $data_array['$previous'] = $_language->module[ 'previous' ];

                $template = $tpl->loadTemplate("register","content", $data_array);
                echo $template;
            } else {
                redirect(
                    "index.php",
                    str_replace(
                        '%pagename%',
                        $GLOBALS['hp_title'],
                        $_language->module['no_cookie_accept']
                    ),
                    3
                );
            }
        } else {
            redirect(
                "index.php",
                str_replace(
                    '%pagename%',
                    $GLOBALS['hp_title'],
                    $_language->module['no_register_when_loggedin']
                ),
                3
            );
        }
    }
}
