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

include_once("../system/themes.php");
    include_once("../system/template.php");

    // Theme
    $theme = new theme();
    // Template
    $tpl = new template();
    $tpl->themes_path = $theme->get_active_theme();
    $tpl->template_path = "templates/";

$_language->readModule('styles', false, true);

if (!ispageadmin($userID) || mb_substr(basename($_SERVER[ 'REQUEST_URI' ]), 0, 15) != "admincenter.php") {
    die($_language->module[ 'access_denied' ]);
}

echo '<div class="panel panel-default">
  <div class="panel-heading">
                            <i class="fa fa-thumbs-up"></i> Setting
                        </div>
                        <div class="panel-body">
                        
  <ul class="nav nav-tabs-primary">
    <li role="presentation"><a href="./admincenter.php?site=settings">Setting</a></li>   
    <li role="presentation"><a href="./admincenter.php?site=settings_styles">Style</a></li>
    <li role="presentation"><a href="./admincenter.php?site=settings_buttons">Buttons</a></li>
    <li role="presentation"><a href="./admincenter.php?site=settings_moduls">Module</a></li>
    <li role="presentation"><a href="./admincenter.php?site=settings_head_moduls">Page Head Module</a></li>
    <li role="presentation"><a href="./admincenter.php?site=settings_content_head_moduls">Content Head Module</a></li>
    <li role="presentation"><a href="./admincenter.php?site=settings_content_foot_moduls">Content Foot Module</a></li>
    <li role="presentation" class="active"><a href="./admincenter.php?site=settings_css">.css</a></li>
    <li role="presentation"><a href="./admincenter.php?site=settings_templates">Templates</a></li>
    <li role="presentation"><a href="./admincenter.php?site=settings_logo">Logo</a></li>
  </ul>
<ol class="breadcrumb-primary"> </ol><br>
 ';

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
	<div class="form-group">
    <label class="col-sm-3">Ordner: <b>'.$tpl->themes_path.'css/</b>stylesheet.css<br><br>'.$_language->module['stylesheet_info'].'</label>
    <div class="col-sm-8">
        <textarea class="mceNoEditor form-control" name="stylesheet" rows="30" cols="">'.$stylesheet.'</textarea>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <input type="hidden" name="captcha_hash" value="'.$hash.'" />
  <button class="btn btn-primary" type="submit" name="submit" />'.$_language->module['update'].'</button>
    </div>
  </div>
</form>';
}
echo '</div></div>';
?>


