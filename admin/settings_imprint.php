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


$ergebnis = safe_query("SELECT * FROM ".PREFIX."navigation_dashboard_links WHERE modulname='imprint'");
    while ($db=mysqli_fetch_array($ergebnis)) {
      $accesslevel = 'is'.$db['accesslevel'].'admin';

if (!$accesslevel($userID) || mb_substr(basename($_SERVER[ 'REQUEST_URI' ]), 0, 15) != "admincenter.php") {
    die($_language->module[ 'access_denied' ]);
}
}

$_language->readModule('imprint', false, true);


if (isset($_POST[ 'submit' ])) {
    $imprint = $_POST[ 'message' ];
    $disclaimer_text = $_POST[ 'disclaimer_text' ];
    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_POST[ 'captcha_hash' ])) {
        safe_query("UPDATE `" . PREFIX . "settings` SET imprint='" . $_POST[ 'type' ] . "'");

        if (mysqli_num_rows(safe_query("SELECT * FROM `" . PREFIX . "settings_imprint`"))) {
            safe_query(
            "UPDATE
                `" . PREFIX . "settings_imprint`
            SET
                `imprint` = '" . $imprint . "',
                `disclaimer_text` = '" . $disclaimer_text . "'"
        );
        } else {
            safe_query("INSERT INTO `" . PREFIX . "settings_imprint` (imprint, disclaimer_text) values( '" . $imprint . "', '" . $disclaimer_text . "') ");
        }
        redirect("admincenter.php?site=settings_imprint", "", 0);
    } else {
        echo $_language->module[ 'transaction_invalid' ];
    }
} else {
    $type1 = '';
    $type0 = '';
    if ($imprint_type) {
        $type1 = 'checked="checked"';
    } else {
        $type0 = 'checked="checked"';
    }

    $ergebnis = safe_query("SELECT * FROM `" . PREFIX . "settings_imprint`");
    $ds = mysqli_fetch_array($ergebnis);
    $CAPCLASS = new \webspell\Captcha;
    $CAPCLASS->createTransaction();
    $hash = $CAPCLASS->getHash();

echo '<script language="JavaScript" type="text/javascript">
					<!--
						function chkFormular() {
							if(!validbbcode(document.getElementById(\'message\').value, \'admin\')){
								return false;
							}
						}
					-->
				</script>';
  
	echo'<div class="card">
    <div class="card-header">
                            <i class="fas fa-stamp"></i> ' . $_language->module['imprint'] . '</div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="admincenter.php?site=settings_imprint">'.$_language->module['imprint'].'</a></li>
                <li class="breadcrumb-item active" aria-current="page">New / Edit</li>
                </ol>
            </nav> 
<div class="card-body">

<div class="row">
<div class="col-md-12">
<form class="form-horizontal" method="post" id="post" name="post" action="admincenter.php?site=settings_imprint" onsubmit="return chkFormular();">

  <input type="radio" name="type" value="0" ' . $type0 . ' /> ' . $_language->module['automatic'] . '<br />
  <input type="radio" name="type" value="1" ' . $type1 . ' /> ' . $_language->module['manual'] . '<br /><br />

  <b>' . $_language->module['imprint'] . '</b><br /><br />
 
  <textarea class="ckeditor" id="ckeditor" name="message" rows="15" cols="" style="width: 100%;">' . getinput($ds['imprint']) . '</textarea><br /><br />

<br />
<b>' . $_language->module['disclaimer'] . '</b><br /><br />
<textarea class="ckeditor" id="ckeditor" name="disclaimer_text" rows="15" cols="" style="width: 100%;">' . getinput($ds['disclaimer_text']) . '</textarea><br /><br /><input type="hidden" name="captcha_hash" value="' . $hash . '" />
  <button class="btn btn-warning" type="submit" name="submit"  />' . $_language->module['update'] . '</button>
  </form></div></div></div></div>';
}
?>