<?php
/*
##########################################################################
#                                                                        #
#           Version 4       /                        /   /               #
#          -----------__---/__---__------__----__---/---/-               #
#           | /| /  /___) /   ) (_ `   /   ) /___) /   /                 #
#          _|/_|/__(___ _(___/_(__)___/___/_(___ _/___/___               #
#                       Free Content / Management System                 #
#                                   /                                    #
#                                                                        #
#                                                                        #
#   Copyright 2005-2015 by webspell.org                                  #
#                                                                        #
#   visit webSPELL.org, webspell.info to get webSPELL for free           #
#   - Script runs under the GNU GENERAL PUBLIC LICENSE                   #
#   - It's NOT allowed to remove this copyright-tag                      #
#   -- http://www.fsf.org/licensing/licenses/gpl.html                    #
#                                                                        #
#   Code based on WebSPELL Clanpackage (Michael Gruber - webspell.at),   #
#   Far Development by Development Team - webspell.org                   #
#                                                                        #
#   visit webspell.org                                                   #
#                                                                        #
##########################################################################
*/

chdir("../../");
$err=0;
if(file_exists("system/sql.php")) { include("system/sql.php"); } else { $err++; }
if(file_exists("system/settings.php")) { include("system/settings.php"); }  else { $err++; }

// copy pagelock information for session test + deactivated pagelock for checklogin
$closed_tmp = $closed;
$closed = 0;

if(file_exists("system/functions.php")) { include("system/functions.php");  } else { $err++; }

//settings

//settings

$sleep = 1; //idle status for script if password is wrong?

//settings end
$_language->readModule('checklogin');

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    $ajax = true;
} else {
    $ajax = false;
}

$return = new stdClass();
$return->state = "failed";
$return->message = "";
$reenter = false;

$get = safe_query("SELECT * FROM " . PREFIX . "banned_ips WHERE ip='" . $GLOBALS[ 'ip' ] . "'");
if (mysqli_num_rows($get) == 0) {
    $ws_user = $_POST[ 'ws_user' ];

    $check = safe_query("SELECT * FROM " . PREFIX . "user WHERE username='" . $ws_user . "'");
    $anz = mysqli_num_rows($check);
    $login = 0;

    if (!$closed_tmp && !isset($_SESSION[ 'ws_sessiontest' ])) {
        $error = $_language->module[ 'session_error' ];
    } else {
        if ($anz) {
            $check = safe_query("SELECT * FROM " . PREFIX . "user WHERE username='" . $ws_user . "' AND activated='1'");
            if (mysqli_num_rows($check)) {
                $ds = mysqli_fetch_array($check);
                $login = 0;
                        
            // /!\ check (old) password                                                                     
            $ws_pwd = generatePasswordHash(stripslashes($_POST[ 'password' ]));
            if(!empty($ds['password']) AND !empty($_POST[ 'password' ])) {
                if (hash_equals($ws_pwd, $ds[ 'password' ])) {
                    $new_pepper = Gen_PasswordPepper();
                    Set_PasswordPepper($new_pepper, $ds['userID']);
                    $pass = Gen_PasswordHash($_POST['password'], $ds['userID']);
                    safe_query("UPDATE " . PREFIX . "user SET password='', password_hash='" . $pass . "' WHERE userID='" . intval($ds['userID']) . "' LIMIT 1");
                } else {
                    if ($sleep) {
                        sleep(3);
                    }
                    $get = safe_query(
                        "SELECT
                            `wrong`
                        FROM
                            `" . PREFIX . "failed_login_attempts`
                        WHERE
                            `ip` = '" . $GLOBALS[ 'ip' ]."'"
                    );
                    if (mysqli_num_rows($get)) {
                        safe_query(
                            "UPDATE
                                `" . PREFIX . "failed_login_attempts`
                            SET
                                `wrong` = wrong+1 WHERE ip = '" . $GLOBALS[ 'ip' ]."'"
                        );
                    } else {
                        safe_query(
                            "INSERT INTO
                                `" . PREFIX . "failed_login_attempts` (
                                    `ip`,
                                    `wrong`
                                )
                                VALUES (
                                    '" . $GLOBALS[ 'ip' ] . "',
                                    1
                                )"
                        );
                    }
                    $get = safe_query(
                        "SELECT
                            `wrong`
                        FROM
                            `" . PREFIX . "failed_login_attempts`
                        WHERE
                            `ip` = '" . $GLOBALS[ 'ip' ]."'"
                    );
                    if (mysqli_num_rows($get)) {
                        $ban = mysqli_fetch_assoc($get);
                        if ($ban[ 'wrong' ] == $max_wrong_pw) {
                            $bantime = time() + (60 * 60 * 3); // 3 hours
                            safe_query(
                                "INSERT INTO
                                    `" . PREFIX . "banned_ips` (
                                        `ip`,
                                        `deltime`,
                                        `reason`
                                    )
                                    VALUES (
                                        '" . $GLOBALS[ 'ip' ] . "',
                                        " . $bantime . ",
                                        'Possible brute force attack'
                                    )"
                            );
                            safe_query(
                                "DELETE FROM
                                    `" . PREFIX . "failed_login_attempts`
                                WHERE
                                    `ip` = '" . $GLOBALS[ 'ip' ]."'"
                            );
                        }
                    }
                    $reenter = true;
                    $return->message = $_language->module[ 'invalid_password' ];
                    $return->code = 'invalid_password';
                }
            }   // END OF OLD PASSWORD                                                                  # <<
                
                
                // check new password
                $ws_pwd = stripslashes($_POST[ 'password' ]).$ds['password_pepper'];
                $valid = password_verify($ws_pwd,$ds['password_hash']);
                if ($valid==1) {                                            
                    //session
                    $_SESSION[ 'referer' ] = $_SERVER[ 'HTTP_REFERER' ];
                    //remove sessiontest variable
                    if (isset($_SESSION[ 'ws_sessiontest' ])) {
                        unset($_SESSION[ 'ws_sessiontest' ]);
                    }
                    //cookie
                    \webspell\LoginCookie::set('ws_auth', $ds[ 'userID' ], $sessionduration * 60 * 60);

                    //Delete visitor with same IP from whoisonline
                    safe_query("DELETE FROM " . PREFIX . "whoisonline WHERE ip='" . $GLOBALS[ 'ip' ] . "'");
                    //Delete IP from failed logins
                    safe_query("DELETE FROM " . PREFIX . "failed_login_attempts WHERE ip = '" . $GLOBALS[ 'ip' ] . "'");
                    $return->state = "success";
                    $return->message = $_language->module[ 'login_successful' ];
                } else {
                    if ($sleep) {
                        sleep(3);
                    }
                    $get = safe_query(
                        "SELECT
                            `wrong`
                        FROM
                            `" . PREFIX . "failed_login_attempts`
                        WHERE
                            `ip` = '" . $GLOBALS[ 'ip' ]."'"
                    );
                    if (mysqli_num_rows($get)) {
                        safe_query(
                            "UPDATE
                                `" . PREFIX . "failed_login_attempts`
                            SET
                                `wrong` = wrong+1 WHERE ip = '" . $GLOBALS[ 'ip' ]."'"
                        );
                    } else {
                        safe_query(
                            "INSERT INTO
                                `" . PREFIX . "failed_login_attempts` (
                                    `ip`,
                                    `wrong`
                                )
                                VALUES (
                                    '" . $GLOBALS[ 'ip' ] . "',
                                    1
                                )"
                        );
                    }
                    $get = safe_query(
                        "SELECT
                            `wrong`
                        FROM
                            `" . PREFIX . "failed_login_attempts`
                        WHERE
                            `ip` = '" . $GLOBALS[ 'ip' ]."'"
                    );
                    if (mysqli_num_rows($get)) {
                        $ban = mysqli_fetch_assoc($get);
                        if ($ban[ 'wrong' ] == $max_wrong_pw) {
                            $bantime = time() + (60 * 60 * 3); // 3 hours
                            safe_query(
                                "INSERT INTO
                                    `" . PREFIX . "banned_ips` (
                                        `ip`,
                                        `deltime`,
                                        `reason`
                                    )
                                    VALUES (
                                        '" . $GLOBALS[ 'ip' ] . "',
                                        " . $bantime . ",
                                        'Possible brute force attack'
                                    )"
                            );
                            safe_query(
                                "DELETE FROM
                                    `" . PREFIX . "failed_login_attempts`
                                WHERE
                                    `ip` = '" . $GLOBALS[ 'ip' ]."'"
                            );
                        }
                    }
                    $reenter = true;
                    $return->message = $_language->module[ 'invalid_password' ];
                    $return->code = 'invalid_password';
                }
        
            } else {
                $return->message = $_language->module[ 'not_activated' ];
                $return->code = 'not_activated';
            }
        } else {
            $return->message = str_replace('%username%', htmlspecialchars($ws_user), $_language->module[ 'no_user' ]);
            $return->code = 'no_user';
            $reenter = true;
        }
    }
} else {
    $data = mysqli_fetch_assoc($get);
    $return->message = str_replace('%reason%', $data[ 'reason' ], $_language->module[ 'ip_banned' ]);
    $return->code = 'ip_banned';
}

if ($ajax === true) {
    header('Cache-Control: no-cache, must-revalidate');
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
    header('Content-type: application/json');
    echo json_encode($return);
} else {
    if ($return->state == "success") {
        header("Location: $_modulepath/index.php?site=login");
    } else {
        $message = $return->message;
        if ($reenter === true) {
            $message .= '<br><br>'.$_language->module[ 'return_reenter' ];
        } else {
            $message .= '<br><br>'.$_language->module[ 'return' ];
        }
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8">
            <meta name="description" content="Clanpage using webSPELL 4 CMS">
            <meta name="author" content="webspell.org">
            <meta name="copyright" content="Copyright 2005-2015 by webspell.org">
            <meta name="generator" content="webSPELL">
            <title><?php echo PAGETITLE; ?></title>
            <link href="_stylesheet.css" rel="stylesheet" type="text/css">
            <link href="../../components/bootstrap/bootstrap.min.css" rel="stylesheet">
            <link href="../../components/font-awesome/font-awesome.min.css" rel="stylesheet">
            <link href="../../system/css/styles.css.php" rel="styleSheet" type="text/css"> 
            <link href="../../system/css/button.css.php" rel="styleSheet" type="text/css">
            <link type="text/css" rel="stylesheet" href="../../inc/themes/default/css/page.css">
        </head>
        <body><center>
        <table class="table">
            <tr>
                <td height="500" class="text-center">
                    <table width="350" border="0" cellpadding="10" cellspacing="0">
                        <tr>
                            <td class="text-center"><blockquote><?php echo $message; ?></blockquote></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table></center>
        </body>
        </html>
        <?php
        
    }
}
