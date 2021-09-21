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

namespace webspell;


if(file_exists('components/PHPMailer/PHPMailerAutoload.php')) {
	require 'components/PHPMailer/PHPMailerAutoload.php';
} else {
	require 'components/PHPMailer/PHPMailerAutoload.php';
} 

class Email
{
    public static function sendEmail($from, $module, $to, $subject, $message, $pop = true)
    {
        $GLOBALS['mail_debug'] = '';
        $get = safe_query("SELECT * FROM " . PREFIX . "email");
        if (mysqli_num_rows($get)) {
            $ds = mysqli_fetch_assoc($get);
            $host = $ds['host'];
            $user = $ds['user'];
            $password = $ds['password'];
            $port = $ds['port'];
            $debug = $ds['debug'];
            $auth = $ds['auth'];
            $html = $ds['html'];
            $smtp = $ds['smtp'];
            $secure = $ds['secure'];
        } else {
            $smtp = 0;
            $auth = 0;
        }

        if ($smtp == 0) {
            $debug = 0;
        }

        if ($smtp == 2) {
            $pop = \POP3::popBeforeSmtp($host, 110, 30, $user, $password, $debug);
        }

        $mail = new \PHPMailer();

        $mail->SMTPDebug = $debug;
        $mail->Debugoutput = function ($str, $level) {
            $GLOBALS['mail_debug'] .= $str . '<br>';
        };

        if (isset($pop)) {
            if ($smtp == 1) {
                $mail->isSMTP();
                $mail->Host = $host;
                $mail->Port = $port;
                if ($auth == 1) {
                    $mail->SMTPAuth = true;
                    $mail->Username = $user;
                    $mail->Password = $password;
                } else {
                    $mail->SMTPAuth = false;
                }

                if (extension_loaded('openssl')) {
                    switch ($secure) {
                        case 0:
                            $mail->SMTPSecure = '';
                            break;
                        case 1:
                            $mail->SMTPSecure = 'tls';
                            break;
                        case 2:
                            $mail->SMTPSecure = 'ssl';
                            break;
                    }
                } else {
                    $mail->SMTPSecure = '';
                }
            } else {
                $mail->isMail();
            }

            $fromtitle = $GLOBALS['hp_title'] . ' - (' . $module . ')';
            $mail->Subject = $subject;
            $mail->setFrom($from, $fromtitle);
            $mail->addAddress($to);
            $mail->addReplyTo($from);
            $mail->CharSet = 'utf-8';
            $mail->WordWrap = 78;

            if ($html == 1) {
                $mail->isHTML(true);
                $mail->msgHTML($message);
            } else {
                $mail->isHTML(false);
                $plain = $mail->html2text($message);
                $mail->Body = $plain;
                $mail->AltBody = $plain;
            }

            if (!$mail->send()) {
                if ($debug == 0) {
                    return array("result" => "fail", "error" => $mail->ErrorInfo);
                } else {
                    return array("result" => "fail", "error" => $mail->ErrorInfo, "debug" => $GLOBALS['mail_debug']);
                }
            } else {
                if ($debug == 0) {
                    return array("result" => "done");
                } else {
                    return array("result" => "done", "debug" => $GLOBALS['mail_debug']);
                }
            }
        } else {
            if ($debug == 0) {
                return array("result" => "fail", "error" => $mail->ErrorInfo);
            } else {
                return array("result" => "fail", "error" => $mail->ErrorInfo, "debug" => $GLOBALS['mail_debug']);
            }
        }
    }
}
