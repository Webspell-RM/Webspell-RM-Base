<?php
/**
 *¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
 *                  Webspell-RM      /                        /   /                                          *
 *                  -----------__---/__---__------__----__---/---/-----__---- _  _ -                         *
 *                   | /| /  /___) /   ) (_ `   /   ) /___) /   / __  /     /  /  /                          *
 *                  _|/_|/__(___ _(___/_(__)___/___/_(___ _/___/_____/_____/__/__/_                          *
 *                               Free Content / Management System                                            *
 *                                           /                                                               *
 *¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
 * @version         webspell-rm                                                                              *
 *                                                                                                           *
 * @copyright       2018-2023 by webspell-rm.de                                                              *
 * @support         For Support, Plugins, Templates and the Full Script visit webspell-rm.de                 *
 * @website         <https://www.webspell-rm.de>                                                             *
 * @forum           <https://www.webspell-rm.de/forum.html>                                                  *
 * @wiki            <https://www.webspell-rm.de/wiki.html>                                                   *
 *                                                                                                           *
 *¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
 * @license         Script runs under the GNU GENERAL PUBLIC LICENCE                                         *
 *                  It's NOT allowed to remove this copyright-tag                                            *
 *                  <http://www.fsf.org/licensing/licenses/gpl.html>                                         *
 *                                                                                                           *
 *¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
 * @author          Code based on WebSPELL Clanpackage (Michael Gruber - webspell.at)                        *
 * @copyright       2005-2011 by webspell.org / webspell.info                                                *
 *                                                                                                           *
 *¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
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

    $check = safe_query("SELECT * FROM " . PREFIX . "user WHERE email='" . $ws_user . "'");
    $anz = mysqli_num_rows($check);
    $login = 0;

    if (!$closed_tmp && !isset($_SESSION[ 'ws_sessiontest' ])) {
        $error = $_language->module[ 'session_error' ];
    } else {
        if ($anz) {
            $check = safe_query("SELECT * FROM " . PREFIX . "user WHERE email='" . $ws_user . "' AND activated='1'");
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
            $return->message = str_replace('%email%', htmlspecialchars($ws_user), $_language->module[ 'no_user' ]);
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
        header ('Location: ../../index.php');
        
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="description" content="Website using webSPELL-RM CMS">
    <meta name="keywords" content="Clandesign, Webspell, Webspell | RM, Wespellanpassungen, Webdesign, Tutorials, Downloads, Webspell-rm, rm, addon, plugin, Templates Webspell Addons, Webspell-rm, rm, plungin, mods, Wespellanpassungen, Modifikationen und Anpassungen und mehr!">
    <meta name="robots" content="all">
    <meta name="abstract" content="Anpasser an Webspell | RM">
    <meta name="copyright" content="Copyright &copy; 2017-2019 by webspell-rm.de">
    <meta name="author" content="webspell-rm.de">
    <meta name="revisit-After" content="1days">
    <meta name="distribution" content="global">
    <link rel="SHORTCUT ICON" href="../../includes/themes/default/templates/favicon.ico">

    <title><?php echo PAGETITLE; ?></title>
    <base href="$rewriteBase">
    <link href="../../components/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../components/css/lockpage.css" rel="stylesheet" type="text/css">
    

        </head>

<body>
<section id="cover">
    <div id="cover-caption" class="lock_wrapper">
        <div id="container" class="container">
            <div class="row text-white">
                <div class="col-sm-9 offset-sm-1 text-center">
                  <h2><?php echo PAGETITLE; ?></h2>
            <img class="img-fluid" src="../../images/logo.png" alt=""/>
             <div class="shdw"></div>
        
        
       
       
                    <div class="info-form col-sm-6 offset-sm-3 text-center">
                         <h1 class="text-danger">ERROR</h1>
                        <?php echo $message; ?>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>
</body>
        
        </html>
        <?php
        
    }
}
