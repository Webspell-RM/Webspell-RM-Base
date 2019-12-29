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

$_language->readModule('privacy_policy', false, true);

$ergebnis = safe_query("SELECT * FROM ".PREFIX."navigation_dashboard_links WHERE modulname='privacy_policy'");
    while ($db=mysqli_fetch_array($ergebnis)) {
      $accesslevel = 'is'.$db['accesslevel'].'admin';

if (!$accesslevel($userID) || mb_substr(basename($_SERVER[ 'REQUEST_URI' ]), 0, 15) != "admincenter.php") {
    die($_language->module[ 'access_denied' ]);
}
}

if (isset($_POST[ 'submit' ])) {
    $privacy_policy_text = $_POST[ 'message' ];
    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_POST[ 'captcha_hash' ])) {
        if (mysqli_num_rows(safe_query("SELECT * FROM " . PREFIX . "settings_privacy_policy"))) {
            safe_query("UPDATE " . PREFIX . "settings_privacy_policy SET date='" . time() . "', privacy_policy_text='" . $privacy_policy_text . "'");
        } else {
            safe_query("INSERT INTO " . PREFIX . "settings_privacy_policy (date ,privacy_policy_text) values( '" . time() . "', '" . $privacy_policy_text . "') ");
        }
    } else {
        echo $_language->module[ 'transaction_invalid' ];
    }
}
$ergebnis = safe_query("SELECT * FROM " . PREFIX . "settings_privacy_policy");
$ds = mysqli_fetch_array($ergebnis);
$CAPCLASS = new \webspell\Captcha;
$CAPCLASS->createTransaction();
$hash = $CAPCLASS->getHash();

echo '<script>
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
                            <i class="fas fa-paragraph"></i> ' . $_language->module['privacy_policy'] . '
                        </div>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="admincenter.php?site=settings_privacy_policy">'.$_language->module['privacy_policy'].'</a></li>
                <li class="breadcrumb-item active" aria-current="page">New / Edit</li>
                </ol>
            </nav>
<div class="card-body">

<div class="row">
<div class="col-md-12">

<form class="form-horizontal" method="post" id="post" name="post" action="admincenter.php?site=settings_privacy_policy" onsubmit="return chkFormular();">
  <br /><br /><textarea class="ckeditor" id="ckeditor" rows="25" cols="" name="message" style="width: 100%;">'.getinput($ds['privacy_policy_text']).'</textarea>
  <br /><br /><input type="hidden" name="captcha_hash" value="'.$hash.'" /><button class="btn btn-warning" type="submit" name="submit" />'.$_language->module['update'].'</button>
</form>
  </div>
  </div><div>
  </div>';
  
?>