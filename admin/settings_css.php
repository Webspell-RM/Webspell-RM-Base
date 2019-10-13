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
    include_once("../system/themes.php");
    include_once("../system/template.php");

    // Theme
    $theme = new theme();
    // Template
    $tpl = new template();
    $tpl->themes_path = $theme->get_active_theme();
    $tpl->template_path = "templates/";

$_language->readModule('styles', false, true);

$ergebnis = safe_query("SELECT * FROM ".PREFIX."navigation_dashboard_links WHERE modulname='css'");
    while ($db=mysqli_fetch_array($ergebnis)) {
      $accesslevel = 'is'.$db['accesslevel'].'admin';

if (!$accesslevel($userID) || mb_substr(basename($_SERVER[ 'REQUEST_URI' ]), 0, 15) != "admincenter.php") {
    die($_language->module[ 'access_denied' ]);
}
}

echo '<div class="card">
        <div class="card-header">
            <i class="fas fa-file-code"></i> .css
        </div>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="admincenter.php?site=setings_css">.css</a></li>
    <li class="breadcrumb-item active" aria-current="page">new & edit</li>
  </ol>
</nav>            
            <div class="card-body">';

if (isset($_POST[ 'submit' ])) {
    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_POST[ 'captcha_hash' ])) {
        $error = array();
        $sem = '/^#[a-fA-F0-9]{6}/';
        
        if (count($error)) {
            echo '<b>' . $_language->module[ 'errors' ] . ':</b><br /><ul>';

            foreach ($error as $err) {
                echo '<li>' . $err . '</li>';
            }
            echo '</ul><br /><input type="button" onclick="javascript:history.back()" value="' .
                $_language->module[ 'back' ] . '" />';
        } else {
            
            $file = ("../$tpl->themes_path/css/stylesheet.css");
            $fp = fopen($file, "w");
            fwrite($fp, stripslashes(str_replace('\r\n', "\n", $_POST[ 'stylesheet' ])));
            fclose($fp);
            redirect("admincenter.php?site=settings_css", "", 0);
        }
    } else {
        echo $_language->module[ 'transaction_invalid' ];
    }
} else {
    $ergebnis = safe_query("SELECT * FROM " . PREFIX . "settings_styles");
    $ds = mysqli_fetch_array($ergebnis);

    $file = ("../$tpl->themes_path/css/stylesheet.css");
    $size = filesize($file);
    $fp = fopen($file, "r");
    $stylesheet = fread($fp, $size);
    fclose($fp);

    $CAPCLASS = new \webspell\Captcha;
    $CAPCLASS->createTransaction();
    $hash = $CAPCLASS->getHash();


    echo '<form class="form-horizontal" method="post" action="admincenter.php?site=settings_css" enctype="multipart/form-data">
	<div class="form-group row">
    <label class="col-sm-3">Ordner: <b>'.$tpl->themes_path.'css/</b>stylesheet.css<br><br>'.$_language->module['stylesheet_info'].'</label>
    <div class="col-sm-8">
        <textarea class="form-control" name="stylesheet" rows="20" cols="">'.$stylesheet.'</textarea>
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-offset-2 col-sm-10">
      <input type="hidden" name="captcha_hash" value="'.$hash.'" />
  <button class="btn btn-success" type="submit" name="submit" />'.$_language->module['update'].'</button>
    </div>
  </div>
</form>';
}
echo '</div></div>';
?>


