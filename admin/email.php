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

$_language->readModule('email', false, true);

$ergebnis = safe_query("SELECT * FROM ".PREFIX."navigation_dashboard_links WHERE modulname='email'");
    while ($db=mysqli_fetch_array($ergebnis)) {
      $accesslevel = 'is'.$db['accesslevel'].'admin';

if (!$accesslevel($userID) || mb_substr(basename($_SERVER[ 'REQUEST_URI' ]), 0, 15) != "admincenter.php") {
    die($_language->module[ 'access_denied' ]);
}
}

if (isset($_GET[ 'action' ])) {
    $action = $_GET[ 'action' ];
} else {
    $action = '';
}

if (isset($_POST[ 'submit' ])) {
    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_POST[ 'captcha_hash' ])) {
        safe_query(
            "UPDATE
                " . PREFIX . "email
            SET
                host='" . $_POST[ 'host' ] . "',
                user='" . $_POST[ 'user' ] . "',
                password='" . $_POST[ 'password' ] . "',
                port='" . intval($_POST[ 'port' ]) . "',
                secure='" . intval($_POST[ 'secure' ]) . "',
                auth='" . intval($_POST[ 'auth' ]) . "',
                debug='" . intval($_POST[ 'debug' ]) . "',
                smtp='" . intval($_POST[ 'smtp' ]) . "',
                html='" . intval($_POST[ 'html' ]) . "'"
        );
        redirect("admincenter.php?site=email", "", 0);
    } else {
        redirect("admincenter.php?site=email", $_language->module[ 'transaction_invalid' ], 3);
    }
} elseif (isset($_POST[ 'send' ])) {
    $to = $_POST[ 'email' ];
    $subject = $_language->module[ 'test_subject' ];
    $message = $_language->module[ 'test_message' ];

    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_POST[ 'captcha_hash' ])) {
        $sendmail = \webspell\Email::sendEmail($admin_email, 'Test eMail', $to, $subject, $message);
        if ($sendmail['result'] == 'fail') {
            if (isset($sendmail['debug'])) {
                echo '<b>' . $_language->module[ 'test_fail' ] . '</b>';
                echo '<br>' . $sendmail[ 'error' ];
                echo '<br>' . $sendmail[ 'debug' ];
                redirect("admincenter.php?site=email&amp;action=test", $_language->module[ 'test_fail' ], 10);
            } else {
                echo '<b>' . $_language->module[ 'test_fail' ] . '</b>';
                echo '<br>' . $sendmail[ 'error' ];
                redirect("admincenter.php?site=email&amp;action=test", $_language->module[ 'test_fail' ], 10);
            }
        } else {
            if (isset($sendmail[ 'debug' ])) {
                echo '<b> Debug </b>';
                echo '<br>' . $sendmail[ 'debug' ];
                redirect("admincenter.php?site=email&amp;action=test", $_language->module[ 'test_ok' ], 10);
            } else {
                redirect("admincenter.php?site=email&amp;action=test", $_language->module[ 'test_ok' ], 3);
            }
        }
    } else {
        redirect("admincenter.php?site=email&amp;action=test", $_language->module[ 'transaction_invalid' ], 3);
    }
} elseif ($action == "test") {
    $CAPCLASS = new \webspell\Captcha;
    $CAPCLASS->createTransaction();
    $hash = $CAPCLASS->getHash();

    echo '<h1>&curren; <a href="admincenter.php?site=email" class="white">' . $_language->module[ 'email' ] .
        '</a> &raquo; ' . $_language->module[ 'test_email' ] . '</h1>';

    echo '<form method="post" action="admincenter.php?site=email&amp;action=test" enctype="multipart/form-data">
  <table width="100%" border="0" cellspacing="1" cellpadding="3">
    <tr>
      <td width="15%"><b>' . $_language->module[ 'email' ] . '</b></td>
      <td width="85%"><input name="email" type="text" size="35" /></td>
    </tr>
    <tr>
      <td><input type="hidden" name="captcha_hash" value="' . $hash . '" /></td>
      <td><input type="submit" name="send" value="' . $_language->module[ 'send' ] . '" /></td>
    </tr>
  </table>
  </form>';
} else {
    $CAPCLASS = new \webspell\Captcha;
    $CAPCLASS->createTransaction();
    $hash = $CAPCLASS->getHash();

    $settings = safe_query("SELECT * FROM " . PREFIX . "email");
    $ds = mysqli_fetch_array($settings);

    if ($ds[ 'smtp' ] == '0') {
        if ($ds[ 'auth' ]) {
            $auth = " checked=\"checked\"";
        } else {
            $auth = "";
        }
        $show_auth = " style=\"display: none;\"";
        $show_auth2 = " style=\"display: none;\"";
    } else {
        if ($ds[ 'auth' ]) {
            $auth = " checked=\"checked\"";
            $show_auth = "";
        } else {
            $auth = "";
            $show_auth = " style=\"display: none;\"";
        }
        $show_auth2 = "";
    }

    if ($ds[ 'html' ]) {
        $html = " checked=\"checked\"";
    } else {
        $html = "";
    }

    $smtp = "<option value='0'>" . $_language->module[ 'type_phpmail' ] . "</option><option value='1'>" .
        $_language->module[ 'type_smtp' ] . "</option><option value='2'>" . $_language->module[ 'type_pop' ] .
        "</option>";
    $smtp = str_replace("value='" . $ds[ 'smtp' ] . "'", "value='" . $ds[ 'smtp' ] . "' selected='selected'", $smtp);

    if (extension_loaded('openssl')) {
        $secure = "<option value='0'>" . $_language->module[ 'secure_none' ] . "</option><option value='1'>" .
            $_language->module[ 'secure_tls' ] . "</option><option value='2'>" . $_language->module[ 'secure_ssl' ] .
            "</option>";
    } else {
        $secure = "<option value='0'>" . $_language->module[ 'secure_none' ] . "</option>";
    }

    $secure =
        str_replace("value='" . $ds[ 'secure' ] . "'", "value='" . $ds[ 'secure' ] . "' selected='selected'", $secure);

    $debug = "<option value='0'>" . $_language->module[ 'debug_0' ] . "</option><option value='1'>" .
        $_language->module[ 'debug_1' ] . "</option><option value='2'>" . $_language->module[ 'debug_2' ] .
        "</option><option value='3'>" . $_language->module[ 'debug_3' ] . "</option><option value='4'>" .
        $_language->module[ 'debug_4' ] . "</option>";
    $debug =
        str_replace("value='" . $ds[ 'debug' ] . "'", "value='" . $ds[ 'debug' ] . "' selected='selected'", $debug);

    echo '<div class="card">
        <div class="card-header">
            <i class="fas fa-envelope"></i> ' . $_language->module[ 'email' ] . '
        </div>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">' . $_language->module[ 'email' ] . '</li>
  </ol>
</nav>

<div class="card-body">

<div class="form-group row">
    <label class="col-md-1 control-label">' . $_language->module['options'] . ':</label>
    <div class="col-md-8">
      <a href="admincenter.php?site=email&amp;action=test" class="btn btn-primary" type="button">' . $_language->module[ 'test_email' ] . '</a>
    </div>
  </div>';

    echo '<script type="text/javascript">
        function HideFields(state){
            if(state == true){
                document.getElementById(\'tr_user\').style.display = "";
                document.getElementById(\'tr_password\').style.display = "";
            }
            else{
                document.getElementById(\'tr_user\').style.display = "none";
                document.getElementById(\'tr_password\').style.display = "none";
            }
        }

        function SetPort(){
            var x = document.getElementById(\'select_secure\').selectedIndex;
            switch(x) {
                case 0:
                    var port = \'25\'
                    break;
                case 1:
                    var port = \'587\'
                    break;
                case 2:
                    var port = \'465\'
                    break;
                default:
                    var port = \'25\'
            }
            document.getElementById(\'input_port\').value = port;
        }

        function HideFields2(){
            var x = document.getElementById(\'select_smtp\').selectedIndex;
            if(x == \'0\'){
                document.getElementById(\'tr_user\').style.display = "none";
                document.getElementById(\'tr_password\').style.display = "none";
                document.getElementById(\'tr_auth\').style.display = "none";
                document.getElementById(\'tr_host\').style.display = "none";
                document.getElementById(\'tr_debug\').style.display = "none";
                document.getElementById(\'tr_port\').style.display = "none";
                document.getElementById(\'tr_secure\').style.display = "none";
            }
            else{
                var y = document.getElementById(\'check_auth\').checked;
                if(y === true){
                    document.getElementById(\'tr_user\').style.display = "";
                    document.getElementById(\'tr_password\').style.display = "";
                    document.getElementById(\'tr_auth\').style.display = "";
                    document.getElementById(\'tr_host\').style.display = "";
                    document.getElementById(\'tr_port\').style.display = "";
                    document.getElementById(\'tr_secure\').style.display = "";
                    document.getElementById(\'tr_debug\').style.display = "";
                } else {
                    document.getElementById(\'tr_host\').style.display = "";
                    document.getElementById(\'tr_auth\').style.display = "";
                    document.getElementById(\'tr_port\').style.display = "";
                    document.getElementById(\'tr_secure\').style.display = "";
                    document.getElementById(\'tr_debug\').style.display = "";
                }
            }
        }
    </script>

    <form method="post" action="admincenter.php?site=email" enctype="multipart/form-data">
    <div class="tooltip" id="id1">' . $_language->module[ 'tooltip_1' ] . '</div>
    <div class="tooltip" id="id2">' . $_language->module[ 'tooltip_2' ] . '</div>
    <div class="tooltip" id="id3">' . $_language->module[ 'tooltip_3' ] . '</div>
    <div class="tooltip" id="id4">' . $_language->module[ 'tooltip_4' ] . '</div>
    <div class="tooltip" id="id5">' . $_language->module[ 'tooltip_5' ] . '</div>
    <div class="tooltip" id="id6">' . $_language->module[ 'tooltip_6' ] . '</div>
    <div class="tooltip" id="id7">' . $_language->module[ 'tooltip_7' ] . '</div>
    <div class="tooltip" id="id8">' . $_language->module[ 'tooltip_8' ] . '</div>
    <div class="tooltip" id="id9">' . $_language->module[ 'tooltip_9' ] . '</div>

        <table width="50%" border="0" cellspacing="1" cellpadding="3">
        <tr>
            <td width="15%"><b>' . $_language->module[ 'type' ] . '</b></td>
            <td width="35%"><select class="form-control row" id="select_smtp" name="smtp" onchange="javascript:HideFields2();"
                onmouseover="showWMTT(\'id1\')"
                onmouseout="hideWMTT()">' . $smtp . '</select></td>
        </tr>
        <tr id="tr_auth"' . $show_auth2 . '>
            <td width="15%"><b>' . $_language->module[ 'auth' ] . '</b></td>
            <td width="35%"><input class="form-control row" type="checkbox" id="check_auth" name="auth"
                onchange="javascript:HideFields(this.checked);" onmouseover="showWMTT(\'id2\')"
                onmouseout="hideWMTT()" value="1" ' . $auth . '/></td>
        </tr>
        <tr id="tr_user"' . $show_auth . '>
            <td width="15%"><b>' . $_language->module[ 'user' ] . '</b></td>
            <td width="35%"><input class="form-control row" name="user" type="text" value="' . getinput($ds[ 'user' ]) . '" size="35"
                onmouseover="showWMTT(\'id3\')" onmouseout="hideWMTT()"/></td>
        </tr>
        <tr id="tr_password"' . $show_auth . '>
            <td width="15%"><b>' . $_language->module[ 'password' ] . '</b></td>
            <td width="35%"><input class="form-control row" type="password" name="password" value="' . getinput($ds[ 'password' ]) . '"
                size="35" onmouseover="showWMTT(\'id4\')" onmouseout="hideWMTT()"/></td>
        </tr>
        <tr id="tr_host"' . $show_auth2 . '>
            <td width="15%"><b>' . $_language->module[ 'host' ] . '</b></td>
            <td width="35%"><input class="form-control row" type="text" name="host" value="' . getinput($ds[ 'host' ]) . '" size="35"
                onmouseover="showWMTT(\'id6\')" onmouseout="hideWMTT()"/></td>
        </tr>
        <tr id="tr_port"' . $show_auth2 . '>
            <td width="15%"><b>' . $_language->module[ 'port' ] . '</b></td>
            <td width="35%"><input class="form-control row" id="input_port" type="text" name="port"
                value="' . getinput($ds[ 'port' ]) . '" size="5"
                onmouseover="showWMTT(\'id5\')" onmouseout="hideWMTT()"/></td>
        </tr>
        <tr id="tr_html">
            <td width="15%"><b>' . $_language->module[ 'html' ] . '</b></td>
            <td width="35%"><input class="form-control row" type="checkbox" id="check_html" name="html"
                onmouseover="showWMTT(\'id7\')"
                onmouseout="hideWMTT()" value="1" ' . $html . '/></td>
        </tr>
        <tr id="tr_secure"' . $show_auth2 . '>
            <td width="15%"><b>' . $_language->module[ 'secure' ] . '</b></td>
            <td width="35%"><select class="form-control row" id="select_secure" name="secure" onmouseover="showWMTT(\'id8\')"
                onchange="javascript:SetPort();"
                onmouseout="hideWMTT()">' . $secure . '</select></td>
        </tr>
        <tr id="tr_debug"' . $show_auth2 . '>
            <td width="15%"><b>' . $_language->module[ 'debug' ] . '</b></td>
            <td width="35%"><select class="form-control row" id="select_debug" name="debug" onmouseover="showWMTT(\'id9\')"
                onmouseout="hideWMTT()">' . $debug . '</select></td>
        </tr>

    </table>
    <br/><br/>

    <div style="clear: both; padding-top: 20px;">
        <input type="hidden" name="captcha_hash" value="' . $hash . '">
        <input class="btn btn-success" type="submit" name="submit" value="' . $_language->module[ 'update' ] . '">
    </div>
    </form></div></div>';
}
