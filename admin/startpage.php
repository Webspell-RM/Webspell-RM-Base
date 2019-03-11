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

$_language->readModule('startpage', false, true);

if (!ispageadmin($userID) || mb_substr(basename($_SERVER[ 'REQUEST_URI' ]), 0, 15) != "admincenter.php") {
    die($_language->module[ 'access_denied' ]);
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

echo'<div class="panel panel-default">
    <div class="panel-heading">
                            <i class="fa fa-info"></i> ' . $_language->module['startpage'] . '
                        </div>
<div class="panel-body">
<div class="col-md-10 form-group"><a href="admincenter.php?site=startpage" class="white">'.$_language->module['startpage'].'</a> &raquo; New / Edit</div>
<div class="col-md-2 form-group">
</div>

<div class="row">
<div class="col-md-12">';
  
	echo'<form class="form-horizontal" method="post" id="post" name="post" action="admincenter.php?site=startpage" onsubmit="return chkFormular();">
  <br />

  <div class="col-md-12 hidden-xs hidden-sm">
        '.$_language->module['info'].'</div>

  <div class="col-md-2">' . $_language->module['title_head'] . ':</div>

  <br /><input class="form-control" type="text" name="title" size="60" maxlength="255" value="' . getinput($ds[ 'title' ]) . '" /><br>

  <div class="col-md-2">' . $_language->module['text'] . ':</div>

  <textarea class="form-control" id="message" rows="25" cols="" name="message" style="width: 100%;">'.getinput($ds['startpage_text']).'</textarea>
  <br /><br /><input type="hidden" name="captcha_hash" value="'.$hash.'" /><button class="btn btn-success" type="submit" name="submit" />'.$_language->module['update'].'</button>
  </form>
  </div>
  </div><div>
  </div>';
  
?>