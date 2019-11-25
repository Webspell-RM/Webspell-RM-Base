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
try {
    $get = mysqli_fetch_assoc(safe_query("SELECT * FROM `".PREFIX."settings_recaptcha`"));
    $webkey = $get['webkey'];
    $seckey = $get['seckey'];
    if ($get['activated']=="1") { $recaptcha=1; } else { $recaptcha=0; }
} Catch (EXCEPTION $e) {
    $recaptcha=0;
}



$_language->readModule('contact');
$_language->readModule('formvalidation', true);

    $data_array = array();
    $data_array['$title'] = $_language->module[ 'title' ];
    $template = $tpl->loadTemplate("contact","head", $data_array);
    echo $template;

if (isset($_POST["action"])) {
    $action = $_POST["action"];
} else {
    $action = '';
}

if ($action == "send") {
    $getemail = $_POST['getemail'];
    $subject = $_POST['subject'];
    $text = $_POST['text'];
    $text = str_replace('\r\n', "\n", $text);
    $name = $_POST['name'];
    $from = $_POST['from'];
    $run = 0;

    $fehler = array();
    if (!(mb_strlen(trim($name)))) {
        $fehler[] = $_language->module['enter_name'];
    }

    if (!validate_email($from)) {
        $fehler[] = $_language->module['enter_mail'];
    }
    if (!(mb_strlen(trim($subject)))) {
        $fehler[] = $_language->module['enter_subject'];
    }
    if (!(mb_strlen(trim($text)))) {
        $fehler[] = $_language->module['enter_message'];
    }

    $ergebnis = safe_query("SELECT * FROM " . PREFIX . "contact WHERE email='" . $getemail . "'");
    if (mysqli_num_rows($ergebnis) == 0) {
        $fehler[] = $_language->module['unknown_receiver'];
    }

    if ($userID) {
        $run = 1;
    } else {


    if($recaptcha!=1) {
            $CAPCLASS = new \webspell\Captcha;
            if (!$CAPCLASS->checkCaptcha($_POST['captcha'], $_POST['captcha_hash'])) {
                $fehler[] = "Securitycode Error";
                $runregister = "false";
            } else {
                $run = 1;
                $runregister = "true";
            }
        } else {
            $runregister = "false";
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
                    //reCaptcha success check 
                    if($res['success'])     {
                    $runregister="true"; $run=1;
                    }       else        {
                        $fehler[] = "reCAPTCHA Error";
                        $runregister="false";
                    }
                } else {
                    $fehler[] = "reCAPTCHA Error";
                    $runregister="false";
                }
            }
        }
    }
    if (!count($fehler) && $run) {
        $message = stripslashes(
            'This mail was send over your webSPELL - Website (IP ' . $GLOBALS['ip'] . '): ' . $hp_url .
            '<br><br><strong>' . getinput($name) . ' writes:</strong><br>' . $text
        );
        $sendmail = \webspell\Email::sendEmail($from, 'Contact', $getemail, stripslashes($subject), $message);

        if ($sendmail['result'] == 'fail') {
            if (isset($sendmail['debug'])) {
                $fehler[] = $sendmail['error'];
                $fehler[] = $sendmail['debug'];
                $showerror = generateErrorBoxFromArray($_language->module['errors_there'], $fehler);
            } else {
                $fehler[] = $sendmail['error'];
                $showerror = generateErrorBoxFromArray($_language->module['errors_there'], $fehler);
            }
        } else {
            if (isset($sendmail['debug'])) {
                $fehler[] = $sendmail[ 'debug' ];
                redirect(
                    'index.php?site=contact',
                    generateBoxFromArray($_language->module['send_successfull'], 'alert-success', $fehler),
                    3
                );
                unset($_POST['name']);
                unset($_POST['from']);
                unset($_POST['text']);
                unset($_POST['subject']);
            } else {
                redirect('index.php?site=contact', $_language->module['send_successfull'], 3);
                unset($_POST['name']);
                unset($_POST['from']);
                unset($_POST['text']);
                unset($_POST['subject']);
            }
        }
    } else {
        $showerror = generateErrorBoxFromArray($_language->module['errors_there'], $fehler);
    }
}

$getemail = '';
$ergebnis = safe_query("SELECT * FROM `" . PREFIX . "contact` ORDER BY `sort`");
if(mysqli_num_rows($ergebnis)<1) {
	$data_array = array();
    $data_array['$showerror'] = generateErrorBoxFromArray($_language->module['errors_there'], array($_language->module['no_contact_setup']));
    $template = $tpl->loadTemplate("contact","failure", $data_array);
    echo $template;
	return false;
} else {
	while ($ds = mysqli_fetch_array($ergebnis)) {
		if ($getemail === $ds['email']) {
			$getemail .= '<option value="' . $ds['email'] . '" selected="selected">' . $ds['name'] . '</option>';
		} else {
			$getemail .= '<option value="' . $ds['email'] . '">' . $ds['name'] . '</option>';
		}
	}
}
if ($loggedin) {
    if (!isset($showerror)) {
        $showerror = '';
    }
    $name = getinput(stripslashes(getnickname($userID)));
    $from = getinput(getemail($userID));
    if (isset($_POST['subject'])) {
        $subject = getforminput($_POST['subject']);
    } else {
        $subject = '';
    }
    if (isset($_POST['text'])) {
        $text = getforminput($_POST['text']);
    } else {
        $text = '';
    }


    $data_array = array();
    $data_array['$showerror'] = $showerror;
    $data_array['$getemail'] = $getemail;
    $data_array['$name'] = $name;
    $data_array['$from'] = $from;
    $data_array['$subject'] = $subject;
    $data_array['$text'] = $text;

    $data_array['$title_contact'] = $_language->module[ 'title_contact' ];
    $data_array['$description'] = $_language->module[ 'description' ];
    $data_array['$receiver'] = $_language->module[ 'receiver' ];
    $data_array['$user'] = $_language->module[ 'user' ];
    $data_array['$mail'] = $_language->module[ 'mail' ];
    $data_array['$e_mail_info'] = $_language->module[ 'e_mail_info' ];
    $data_array['$subject'] = $_language->module[ 'subject' ];
    $data_array['$message'] = $_language->module[ 'message' ];
    $data_array['$security_code'] = $_language->module[ 'security_code' ];
    $data_array['$send'] = $_language->module[ 'send' ];
    $data_array['$lang_GDPRinfo'] = $_language->module['GDPRinfo'];
    $data_array['$lang_GDPRaccept'] = $_language->module['GDPRaccept'];
    $data_array['$lang_privacy_policy'] = $_language->module['privacy_policy'];
    $data_array['$lang_GDPRaccept'] = $_language->module['GDPRaccept'];


    
    $template = $tpl->loadTemplate("contact","loggedin", $data_array);
    echo $template;


} else {
    $CAPCLASS = new \webspell\Captcha;
        $captcha = $CAPCLASS->createCaptcha();
        $hash = $CAPCLASS->getHash();
        $CAPCLASS->clearOldCaptcha();
    if (!isset($showerror)) {
        $showerror = '';
    }
    if (isset($_POST['name'])) {
        $name = getforminput($_POST['name']);
    } else {
        $name = '';
    }
    if (isset($_POST['from'])) {
        $from = getforminput($_POST['from']);
    } else {
        $from = '';
    }
    if (isset($_POST['subject'])) {
        $subject = getforminput($_POST['subject']);
    } else {
        $subject = '';
    }
    if (isset($_POST['text'])) {
        $text = getforminput($_POST['text']);
    } else {
        $text = '';
    }

    if($recaptcha=="0") { 
                $CAPCLASS = new \webspell\Captcha;
                $captcha = $CAPCLASS->createCaptcha();
                $hash = $CAPCLASS->getHash();
                $CAPCLASS->clearOldCaptcha();
                $_captcha = '
                        <span class="input-group-addon captcha-img">'.$captcha.'</span>
                        <input type="number" name="captcha" class="form-control" id="input-security-code">
                        <input name="captcha_hash" type="hidden" value="'.$hash.'">
                    ';
            } else {
                $_captcha = '
                <div class="g-recaptcha" style="width: 70%; float: left;" data-sitekey="'.$webkey.'"></div>';
            }
    
    $data_array = array();
    $data_array['$showerror'] = $showerror;
    $data_array['$getemail'] = $getemail;
    $data_array['$name'] = $name;
    $data_array['$from'] = $from;
    $data_array['$subject'] = $subject;
    $data_array['$text'] = $text;
    $data_array['$captcha'] = $captcha;
    $data_array['$_captcha'] = $_captcha;
    $data_array['$hash'] = $hash;

    $data_array['$title_contact'] = $_language->module[ 'title_contact' ];
    $data_array['$description'] = $_language->module[ 'description' ];
    $data_array['$receiver'] = $_language->module[ 'receiver' ];
    $data_array['$user'] = $_language->module[ 'user' ];
    $data_array['$mail'] = $_language->module[ 'mail' ];
    $data_array['$e_mail_info'] = $_language->module[ 'e_mail_info' ];
    $data_array['$subject'] = $_language->module[ 'subject' ];
    $data_array['$message'] = $_language->module[ 'message' ];
    $data_array['$security_code'] = $_language->module[ 'security_code' ];
    $data_array['$send'] = $_language->module[ 'send' ];
    $data_array['$lang_GDPRinfo'] = $_language->module['GDPRinfo'];
    $data_array['$lang_GDPRaccept'] = $_language->module['GDPRaccept'];
    $data_array['$lang_privacy_policy'] = $_language->module['privacy_policy'];
    $data_array['$lang_GDPRaccept'] = $_language->module['GDPRaccept'];


    
    $template = $tpl->loadTemplate("contact","notloggedin", $data_array);
    echo $template;
}

