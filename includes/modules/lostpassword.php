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


$_language->readModule('lostpassword');

    $data_array = array();
    $data_array['$title'] = $_language->module[ 'title' ];
    $template = $tpl->loadTemplate("lostpassword","head", $data_array);
    echo $template;

if (isset($_POST[ 'submit' ])) {
    $email = trim($_POST[ 'email' ]);
    if ($email != '') {
        $ergebnis = safe_query(
            "SELECT
                *
            FROM
                " . PREFIX . "user
            WHERE
                email = '" . $email . "'"
        );
        $anz = mysqli_num_rows($ergebnis);

        if ($anz) {
            $ds = mysqli_fetch_array($ergebnis);
	
			$newpass_random = Gen_PasswordPepper();
			$newpass_hash = Gen_PasswordHash($newpass_random, $ds['userID']);
	
            safe_query(
                "UPDATE
                    " . PREFIX . "user
                SET
                    password='', password_hash='" . $newpass_hash . "'
                WHERE
                    userID='" . intval($ds[ 'userID' ]) . "'"
            );

            $ToEmail = $ds[ 'email' ];
            $vars = array('%pagetitle%', '%email%', '%new_password%', '%homepage_url%');
            $repl = array($hp_title, $ds[ 'email' ], $newpass_random, $hp_url);
            $header = str_replace($vars, $repl, $_language->module[ 'email_subject' ]);
            $Message = str_replace($vars, $repl, $_language->module[ 'email_text' ]);

            $sendmail = \webspell\Email::sendEmail($admin_email, 'Lost Password', $ToEmail, $header, $Message);

            if ($sendmail['result'] == 'fail') {
                if (isset($sendmail['debug'])) {
                    $fehler = array();
                    $fehler[] = $sendmail[ 'error' ];
                    $fehler[] = $sendmail[ 'debug' ];
                    echo generateErrorBoxFromArray($_language->module['email_failed'], $fehler);
                } else {
                    $fehler = array();
                    $fehler[] = $sendmail[ 'error' ];
                    echo generateErrorBoxFromArray($_language->module['email_failed'], $fehler);
                }
            } else {
                if (isset($sendmail['debug'])) {
                    $fehler = array();
                    $fehler[] = $sendmail[ 'debug' ];
                    echo generateBoxFromArray($_language->module[ 'successful' ], 'alert-success', $fehler);
                    echo str_replace($vars, $repl, $_language->module[ 'successful' ]);
                } else {
                    echo str_replace($vars, $repl, $_language->module[ 'successful' ]);
                }
            }
        } else {
            redirect('index.php?site=lostpassword', $_language->module[ 'no_user_found' ], 3);
        }
    } else {
        redirect('index.php?site=lostpassword', $_language->module[ 'no_mail_given' ], 3);
    }
} else {
    $data_array = array();
    $data_array['$title'] = $_language->module[ 'title' ];
    $data_array['$forgotten_your_password'] = $_language->module[ 'forgotten_your_password' ];
    $data_array['$info1'] = $_language->module['info1'];
    $data_array['$info2'] = $_language->module['info2'];
    
    $template = $tpl->loadTemplate("lostpassword","content", $data_array);
    echo $template;

    $data_array = array();
    $data_array['$title'] = $_language->module[ 'title' ];
    $data_array['$forgotten_your_password'] = $_language->module[ 'forgotten_your_password' ];
    $data_array['$info3'] = $_language->module[ 'info3' ];
    $data_array['$your_email'] = $_language->module[ 'your_email' ];
    $data_array['$get_password'] = $_language->module[ 'get_password' ];
    $data_array['$return_to'] = $_language->module[ 'return_to' ];
    $data_array['$login'] = $_language->module[ 'login' ];
    $data_array['$email-address'] = $_language->module[ 'email-address' ];
    

    $template = $tpl->loadTemplate("lostpassword","content_area", $data_array);
    echo $template;

    
    $template = $tpl->loadTemplate("lostpassword","foot", $data_array);
    echo $template;
}
