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
            echo $_language->module[ 'no_user_found' ];
        }
    } else {
        echo $_language->module[ 'no_mail_given' ];
    }
} else {
    $data_array = array();
    $data_array['$title'] = $_language->module[ 'title' ];
    $data_array['$forgotten_your_password'] = $_language->module[ 'forgotten_your_password' ];
    $data_array['$info'] = $_language->module[ 'info' ];
    
    $template = $tpl->loadTemplate("lostpassword","content", $data_array);
    echo $template;

    $data_array = array();
    $data_array['$your_email'] = $_language->module[ 'your_email' ];
    $data_array['$get_password'] = $_language->module[ 'get_password' ];

    $template = $tpl->loadTemplate("lostpassword","content_area", $data_array);
    echo $template;

    
    $template = $tpl->loadTemplate("lostpassword","foot", $data_array);
    echo $template;
}
