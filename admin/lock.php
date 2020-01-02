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
$_language->readModule('lock', false, true);

if (!ispageadmin($userID) || mb_substr(basename($_SERVER[ 'REQUEST_URI' ]), 0, 15) != "admincenter.php") {
    die($_language->module[ 'access_denied' ]);
}

echo '<div class="panel panel-default">
  <div class="panel-heading">
                            <i class="fa fa-credit-card"></i> '.$_language->module['settings'].'
                        </div>
                        <div class="panel-body">
                        <a href="admincenter.php?site=settings" class="white">' . $_language->module[ 'settings' ] .
    '</a> &raquo; ' . $_language->module[ 'pagelock' ] . '<br><br>';

if (!$closed) {
    if (isset($_POST[ 'submit' ]) != "" && ispageadmin($userID)) {
        $CAPCLASS = new \webspell\Captcha;
        if ($CAPCLASS->checkCaptcha(0, $_POST[ 'captcha_hash' ])) {
            if (mysqli_num_rows(safe_query("SELECT * FROM `" . PREFIX . "lock`"))) {
                safe_query(
                    "UPDATE " . PREFIX . "lock SET reason='" . $_POST[ 'reason' ] . "', time='" . time() .
                    "'"
                );
            } else {
                safe_query(
                    "INSERT INTO " . PREFIX . "lock (`time`, `reason`) values( '" . time() . "', '" .
                    $_POST[ 'reason' ] . "') "
                );
            }
            safe_query("UPDATE " . PREFIX . "settings SET closed='1'");

            redirect("admincenter.php?site=lock", $_language->module[ 'page_locked' ], 3);
        } else {
            redirect("admincenter.php?site=lock", $_language->module[ 'transaction_invalid' ], 3);
        }
    } else {
        $ergebnis = safe_query("SELECT * FROM " . PREFIX . "lock");
        $ds = mysqli_fetch_array($ergebnis);
        $CAPCLASS = new \webspell\Captcha;
        $CAPCLASS->createTransaction();
        $hash = $CAPCLASS->getHash();

        echo '<form method="post" action="admincenter.php?site=lock"><b>' . $_language->module[ 'pagelock' ] .
            '</b><br /><small>' . $_language->module[ 'you_can_use_html' ] . '</small><br /><br />
            <textarea class="ckeditor" id="ckeditor" name="reason" rows="30" cols="" style="width: 100%;">' . getinput($ds[ 'reason' ]) .
            '</textarea><br /><br /><input type="hidden" name="captcha_hash" value="' . $hash . '" />
            <input class="btn btn-danger" type="submit" name="submit" value="' . $_language->module[ 'lock' ] . '" /></form>';
    }
} else {
    if (isset($_POST[ 'submit' ]) != "" && isset($_POST[ 'unlock' ]) && ispageadmin($userID)) {
        $CAPCLASS = new \webspell\Captcha;
        if ($CAPCLASS->checkCaptcha(0, $_POST[ 'captcha_hash' ])) {

            safe_query("UPDATE " . PREFIX . "settings SET closed='0'");

            redirect("admincenter.php?site=lock", $_language->module[ 'page_unlocked' ], 3);
        } else {
            redirect("admincenter.php?site=lock", $_language->module[ 'transaction_invalid' ], 3);
        }
    } else {
        $ergebnis = safe_query("SELECT * FROM " . PREFIX . "lock");
        $ds = mysqli_fetch_array($ergebnis);
        $CAPCLASS = new \webspell\Captcha;
        $CAPCLASS->createTransaction();
        $hash = $CAPCLASS->getHash();

        echo '<form method="post" action="admincenter.php?site=lock">
    ' . $_language->module[ 'locked_since' ] . '&nbsp;' . date("d.m.Y - H:i", $ds[ 'time' ]) . '.<br /><br />
    <input type="checkbox" name="unlock" /> ' . $_language->module[ 'unlock_page' ] . '<br /><br />
    <input type="hidden" name="captcha_hash" value="' . $hash . '" />
    <input class="btn btn-success" type="submit" name="submit" value="' . $_language->module[ 'unlock' ] . '" />
    </form>
    </div></div>';
    }
}
