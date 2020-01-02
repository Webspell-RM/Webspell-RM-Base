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
$_language->readModule('startpage', false, true);

$ergebnis = safe_query("SELECT * FROM ".PREFIX."navigation_dashboard_links WHERE modulname='startpage'");
    while ($db=mysqli_fetch_array($ergebnis)) {
      $accesslevel = 'is'.$db['accesslevel'].'admin';

if (!$accesslevel($userID) || mb_substr(basename($_SERVER[ 'REQUEST_URI' ]), 0, 15) != "admincenter.php") {
    die($_language->module[ 'access_denied' ]);
}
}

if (isset($_POST[ 'submit' ])) {
  $title = $_POST[ 'title' ];
    $startpage_text = $_POST[ 'message' ];
    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_POST[ 'captcha_hash' ])) {
        if (mysqli_num_rows(safe_query("SELECT * FROM " . PREFIX . "settings_startpage"))) {
            safe_query("UPDATE " . PREFIX . "settings_startpage SET title='" . $title . "', date='" . time() . "', startpage_text='" . $startpage_text . "'");
        } else {
            safe_query("INSERT INTO " . PREFIX . "settings_startpage (date ,startpage_text) values( '" . time() . "', '" . $startpage_text . "') ");
        }
    } else {
        echo $_language->module[ 'transaction_invalid' ];
    }
}
$ergebnis = safe_query("SELECT * FROM " . PREFIX . "settings_startpage");
$ds = mysqli_fetch_array($ergebnis);
$CAPCLASS = new \webspell\Captcha;
$CAPCLASS->createTransaction();
$hash = $CAPCLASS->getHash();

echo'<div class="card">
        <div class="card-header">
            <i class="fa fa-info"></i> ' . $_language->module['startpage'] . '
        </div>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="admincenter.php?site=settings_startpage">'.$_language->module['startpage'].'</a></li>
    <li class="breadcrumb-item active" aria-current="page">new & edit</li>
  </ol>
</nav>            
            <div class="card-body">
<div class="row">
<div class="col-md-12">';
  
	echo'<form class="form-horizontal" method="post" id="post" name="post" action="admincenter.php?site=settings_startpage" onsubmit="return chkFormular();">
  <div class="col-md-12">' . $_language->module['title_head'] . ':</div>

  <br /><input class="form-control" type="text" name="title" size="60" maxlength="255" value="' . getinput($ds[ 'title' ]) . '" /><br>

  <div class="col-md-12">' . $_language->module['text'] . ':</div>

  <br /><textarea class="ckeditor" id="ckeditor" rows="25" cols="" name="message" style="width: 100%;">'.getinput($ds['startpage_text']).'</textarea>
  <br /><br />
  <input type="hidden" name="captcha_hash" value="'.$hash.'" />
  <button class="btn btn-warning" type="submit" name="submit" />'.$_language->module['update'].'</button>
  </form>
  </div>
  </div><div>
  </div>';
  
?>