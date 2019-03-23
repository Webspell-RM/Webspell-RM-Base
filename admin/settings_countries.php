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

$_language->readModule('countries', false, true);

if (!ispageadmin($userID) || mb_substr(basename($_SERVER[ 'REQUEST_URI' ]), 0, 15) != "admincenter.php") {
    die($_language->module[ 'access_denied' ]);
}

$filepath = "../images/flags/";

if (isset($_GET[ 'action' ])) {
    $action = $_GET[ 'action' ];
} else {
    $action = '';
}

if ($action == "add") {
    $CAPCLASS = new \webspell\Captcha;
    $CAPCLASS->createTransaction();
    $hash = $CAPCLASS->getHash();
  echo'<div class="panel panel-default">
  <div class="panel-heading">
                            <i class="fa fa-globe"></i> ' . $_language->module['countries'] . '
                        </div>
    <div class="panel-body">
  <a href="admincenter.php?site=settings_countries" class="white">'.$_language->module['countries'].':</a> &raquo; '.$_language->module['add_country'].'<br><br>';
	
	echo'<form class="form-horizontal" method="post" action="admincenter.php?site=settings_countries" enctype="multipart/form-data">
  <div class="form-group">
    <label class="col-sm-2 control-label">'.$_language->module['icon_upload'].':</label>
    <div class="col-sm-8">
      <input name="icon" type="file" size="40" /> <small>'.$_language->module['max_18x12'].'</small>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">'.$_language->module['country'].':</label>
    <div class="col-sm-8">
      <input class="form-control" type="text" name="country" maxlength="255" />
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">'.$_language->module['shorthandle'].':</label>
    <div class="col-sm-8">
      <input class="form-control" type="text" name="shorthandle" size="5" maxlength="3" />
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
		<input type="hidden" name="captcha_hash" value="'.$hash.'" />
		<button class=" btn btn-success" type="submit" name="save"  />'.$_language->module['add_country'].'</button>
    </div>
  </div>
  </form>
  </div>
  </div>';


} elseif ($action == "edit") {
    $ds =
        mysqli_fetch_array(safe_query(
            "SELECT * FROM " . PREFIX . "settings_countries WHERE countryID='" . $_GET[ "countryID" ] .
            "'"
        ));
    
    if (!empty($ds[ 'short' ])) {
        $pic = '<img src="../' . $filepath . $ds[ 'short' ] . '" alt="">';
    } else {
        $pic = "no_upload";
    }
        
    if ($ds[ 'fav' ] == '1') {
        $fav = '<input type="checkbox" name="fav" value="1" checked="checked" />';
    } else {
        $fav = '<input type="checkbox" name="fav" value="1" />';
    }

    $CAPCLASS = new \webspell\Captcha;
    $CAPCLASS->createTransaction();
    $hash = $CAPCLASS->getHash();
	
  echo'<div class="panel panel-default">
  <div class="panel-heading">
                            <i class="fa fa-globe"></i> ' . $_language->module['countries'] . '
                        </div>
    <div class="panel-body">
  <a href="admincenter.php?site=settings_countries" class="white">'.$_language->module['countries'].'</a> &raquo; '.$_language->module['edit_country'].'<br><br>';

	echo'<form class="form-horizontal" method="post" action="admincenter.php?site=settings_countries" enctype="multipart/form-data">
  <input type="hidden" name="countryID" value="'.$ds['countryID'].'" />
  <div class="form-group">
    <label class="col-sm-2 control-label">'.$_language->module['present_icon'].':</label>
    <div class="col-sm-8">
      <p class="form-control-static">'.$pic.'</p>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">'.$_language->module['icon_upload'].':</label>
    <div class="col-sm-8">
      <input name="icon" type="file" size="40" /> <small>'.$_language->module['max_18x12'].'</small>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">'.$_language->module['country'].':</label>
    <div class="col-sm-8">
      <input class="form-control" type="text" name="country" maxlength="255" value="'.getinput($ds['country']).'" />
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">'.$_language->module['shorthandle'].':</label>
    <div class="col-sm-8">
      <input class="form-control" type="text" name="shorthandle" size="5" maxlength="3" value="'.getinput($ds['short']).'" />
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
		<input type="hidden" name="captcha_hash" value="'.$hash.'" />
		<button class=" btn btn-success" type="submit" name="saveedit"  />'.$_language->module['edit_country'].'</button>
    </div>
  </div>
  </form>
  </div>
  </div>';


} elseif (isset($_POST[ 'save' ])) {
    $icon = $_FILES[ "icon" ];
    $country = $_POST[ "country" ];
    $short = $_POST[ "shorthandle" ];
    if (isset($POST[ "fav" ])) {
        $fav = 1;
    } else {
        $fav = 0;
    }
    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_POST[ 'captcha_hash' ])) {
        if (checkforempty(array('shorthandle','country'))) {
            $errors = array();

            //TODO: should be loaded from root language folder
            $_language->readModule('formvalidation', true, true);

            $upload = new \webspell\HttpUpload('icon');
            if ($upload->hasFile()) {
                if ($upload->hasError() === false) {
                    $mime_types = array('image/gif','image/jpg','image/png');

                    if ($upload->supportedMimeType($mime_types)) {
                        $imageInformation = getimagesize($upload->getTempFile());

                        if (is_array($imageInformation)) {
                            safe_query(
                                "INSERT INTO
                                    `" . PREFIX . "settings_countries` (
                                        `country`,
                                        `short`,
                                        `fav`
                                    ) VALUES (
                                        '" . $country . "',
                                        '" . $short . "',
                                        '" . $fav . "'
                                    )"
                            );

                            $file = $short . '.'.$upload->getExtension();

                            if ($upload->saveAs($filepath . $file, true)) {
                                @chmod($filepath . $file, $new_chmod);
                            }
                        } else {
                            $errors[] = $_language->module['broken_image'];
                        }
                    } else {
                        $errors[] = $_language->module['unsupported_image_type'];
                    }
                } else {
                    $errors[] = $upload->translateError();
                }
            }
            if (count($errors)) {
                $errors = array_unique($errors);
                echo generateErrorBoxFromArray($_language->module['errors_there'], $errors);
            }
        } else {
            echo $_language->module['information_incomplete'];
        }
    } else {
        echo $_language->module[ 'transaction_invalid' ];
    }
    redirect("admincenter.php?site=settings_countries", "", 0);
} elseif (isset($_POST[ "saveedit" ])) {
    $icon = $_FILES[ "icon" ];
    $country = $_POST[ "country" ];
    $short = $_POST[ "shorthandle" ];
    if (isset($POST[ "fav" ])) {
        $fav = 1;
    } else {
        $fav = 0;
    }
    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_POST[ 'captcha_hash' ])) {
        if (checkforempty(array('shorthandle','country'))) {
            safe_query(
                "UPDATE
                    `" . PREFIX . "settings_countries`
                SET
                    `country` = '" . $country . "',
                    `short` = '" . $short . "',
                    `fav` = '" . $fav . "'
                WHERE `countryID` = '" . $_POST[ "countryID" ] . "'"
            );

            $errors = array();

            //TODO: should be loaded from root language folder
            $_language->readModule('formvalidation', true);

            $upload = new \webspell\HttpUpload('icon');
            if ($upload->hasFile()) {
                if ($upload->hasError() === false) {
                    $mime_types = array('image/gif','image/jpg','image/png');

                    if ($upload->supportedMimeType($mime_types)) {
                        $imageInformation = getimagesize($upload->getTempFile());

                        if (is_array($imageInformation)) {
                            $file = $short . '.'. $upload->getExtension();

                            if ($upload->saveAs($filepath . $file, true)) {
                                @chmod($filepath . $file, $new_chmod);
                            }
                        } else {
                            $errors[] = $_language->module['broken_image'];
                        }
                    } else {
                        $errors[] = $_language->module['unsupported_image_type'];
                    }
                } else {
                    $errors[] = $upload->translateError();
                }
            }
            if (count($errors)) {
                $errors = array_unique($errors);
                echo generateErrorBoxFromArray($_language->module['errors_there'], $errors);
            }
        } else {
            echo $_language->module['information_incomplete'];
        }
    } else {
        echo $_language->module[ 'transaction_invalid' ];
    }
    redirect("admincenter.php?site=settings_countries", "", 0);
} elseif (isset($_GET[ "delete" ])) {
    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_GET[ 'captcha_hash' ])) {
        $countryID = (int) $_GET[ "countryID" ];
        $ds = mysqli_fetch_array(
            safe_query(
                "SELECT short FROM `" . PREFIX . "settings_countries` WHERE `countryID` = '" . $countryID . "'"
            )
        );
        safe_query("DELETE FROM `" . PREFIX . "settings_countries` WHERE `countryID` = '" . $countryID . "'");
        $file = $ds['short'].".gif";
        if (file_exists($filepath.$file)) {
            unlink($filepath.$file);
        }
        redirect("admincenter.php?site=settings_countries", "", 0);
    } else {
        echo $_language->module[ 'transaction_invalid' ];
    }
} else {


if(isset($_GET['page'])) $page=(int)$_GET['page'];
  else $page = 1;

    echo'<div class="panel panel-default">
    <div class="panel-heading">
                            <i class="fa fa-globe"></i> ' . $_language->module['countries'] . '
                        </div>
    <div class="panel-body">';
	
    echo'<a href="admincenter.php?site=settings_countries&amp;action=add" class="btn btn-primary" type="button">' . $_language->module[ 'new_country' ] . '</a><br><br>';


    $alle=safe_query("SELECT countryID FROM " . PREFIX . "settings_countries");
  $gesamt = mysqli_num_rows($alle);
  $pages=1;

  $max='15';

  for ($n=$max; $n<=$gesamt; $n+=$max) {
    if($gesamt>$n) $pages++;
  }

  if($pages>1) $page_link = makepagelink("admincenter.php?site=settings_countries", $page, $pages);
    else $page_link='';

  if ($page == "1") {
    $ergebnis = safe_query("SELECT * FROM " . PREFIX . "settings_countries ORDER BY country ASC LIMIT 0,$max");
    $n=1;
  }
  else {
    $start=$page*$max-$max;
    $ergebnis = safe_query("SELECT * FROM " . PREFIX . "settings_countries ORDER BY country ASC LIMIT $start,$max");
    $n = ($gesamt+1)-$page*$max+$max;
  }  

    echo'   <table class="table table-striped">
    <thead>
      <th><b>' . $_language->module['icons'] . '</b></th>
      <th><b>' . $_language->module['country'] . '</b></th>
      <th><b>' . $_language->module['shorthandle'] . '</b></th>
      <th><b>' . $_language->module['actions'] . '</b></th>
    </thead>';

     $n=1;

  $CAPCLASS = new \webspell\Captcha;
    $CAPCLASS->createTransaction();
    $hash = $CAPCLASS->getHash();

  while($ds=mysqli_fetch_array($ergebnis)) {
            
            
            
            echo '<tr>
        <td><img align="center" src="../' . $filepath . $ds[ 'short' ] . '" alt="{img}" /></td>
        <td>'.getinput($ds['country']).'</td>
        <td>'.getinput($ds['short']).'</td>
        <td><a href="admincenter.php?site=settings_countries&amp;action=edit&amp;countryID='.$ds['countryID'].'" class="hidden-xs hidden-sm btn btn-warning" type="button">' . $_language->module[ 'edit' ] . '</a>

        <input class="hidden-xs hidden-sm btn btn-danger" type="button" onclick="MM_confirm(\''.$_language->module['really_delete'].'\', \'admincenter.php?site=settings_countries&amp;delete=true&amp;countryID='.$ds['countryID'].'&amp;captcha_hash='.$hash.'\')" value="'.$_language->module['delete'].'" />
		
        <a href="admincenter.php?site=settings_countries&amp;action=edit&amp;countryID='.$ds['countryID'].'"  class="mobile visible-xs visible-sm" type="button"><i class="fa fa-pencil"></i></a>
        <a class="mobile visible-xs visible-sm" type="button" onclick="MM_confirm(\''.$_language->module['really_delete'].'\', \'admincenter.php?site=settings_countries&amp;delete=true&amp;countryID='.$ds['countryID'].'&amp;captcha_hash='.$hash.'\')" value="'.$_language->module['delete'].'" /><i class="fa fa-times"></i></a></td>
      </tr>';
      
     $n++;
  }
    echo'</table>';
  
if($pages>1) echo $page_link;
}
echo '</div></div>';
?>