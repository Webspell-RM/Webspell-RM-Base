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

$_language->readModule('games', false, true);

if (!ispageadmin($userID) || mb_substr(basename($_SERVER[ 'REQUEST_URI' ]), 0, 15) != "admincenter.php") {
    die($_language->module[ 'access_denied' ]);
}

$filepath = "../images/games/";

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
                            <i class="fa fa-gamepad"></i> ' . $_language->module['games'] . '
                        </div>
      <div class="panel-body">
  <a href="admincenter.php?site=settings_games" class="white">' . $_language->module['games'] . '</a> &raquo; ' . $_language->module['add_game'] . '<br><br>';
	
	echo'<form class="form-horizontal" method="post" action="admincenter.php?site=settings_games" enctype="multipart/form-data">
	<div class="form-group">
    <label class="col-sm-2 control-label">' . $_language->module['game_icon'] . ':</label>
    <div class="col-sm-8">
      <input name="icon" type="file" size="40" />
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">' . $_language->module['game_name'] . ':</label>
    <div class="col-sm-8">
      <input class="form-control" type="text" name="name" maxlength="255" />
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">' . $_language->module['game_tag'] . ':</label>
    <div class="col-sm-8">
      <input class="form-control" type="text" name="tag" size="7" maxlength="10" />
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
		<input type="hidden" name="captcha_hash" value="' . $hash . '" />
		<button class="btn btn-success" type="submit" name="save"  />' . $_language->module['add_game'] . '</button>
    </div>
  </div>
  </form>
  </div>
  </div>';

} elseif ($action == "edit") {
    $ds = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_games WHERE gameID='" . $_GET[ "gameID" ] . "'"));
    
    if (!empty($ds[ 'tag' ])) {
        $pic = '<img src="../' . $filepath . $ds[ 'tag' ] . '" alt="">';
    } else {
        $pic = "no_upload";
    }

    $CAPCLASS = new \webspell\Captcha;
    $CAPCLASS->createTransaction();
    $hash = $CAPCLASS->getHash();
	
  echo'<div class="panel panel-default">
  <div class="panel-heading">
                            <i class="fa fa-gamepad"></i> ' . $_language->module['games'] . '
                        </div>
      <div class="panel-body">
  <a href="admincenter.php?site=settings_games" class="white">' . $_language->module['games'] . '</a> &raquo; ' . $_language->module['edit_game'] . '<br><br>';

	echo'<form class="form-horizontal" method="post" action="admincenter.php?site=settings_games" enctype="multipart/form-data">
  <input type="hidden" name="gameID" value="' . $ds['gameID'] . '" />
  <div class="form-group">
    <label class="col-sm-2 control-label">' . $_language->module['present_icon'] . ':</label>
    <div class="col-sm-8">
      <p class="form-control-static">'.$pic.'</p>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">' . $_language->module['game_icon'] . ':</label>
    <div class="col-sm-8">
      <input name="icon" type="file" size="40" />
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">' . $_language->module['game_name'] . ':</label>
    <div class="col-sm-8">
      <input class="form-control" type="text" name="name" maxlength="255" value="' . getinput($ds['name']) . '" />
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">' . $_language->module['game_tag'] . ':</label>
    <div class="col-sm-8">
      <input class="form-control" type="text" name="tag" size="7" maxlength="10" value="' . getinput($ds['tag']) . '" />
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
		<input type="hidden" name="captcha_hash" value="' . $hash . '" />
		<button class="btn btn-success" type="submit" name="saveedit"  />' . $_language->module['edit_game'] . '</button>
    </div>
  </div>
  </form>
  </div>
  </div>';
  
} elseif (isset($_POST[ 'save' ])) {
    $icon = $_FILES[ "icon" ];
    $name = $_POST[ "name" ];
    $tag = $_POST[ "tag" ];
    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_POST[ 'captcha_hash' ])) {
        if (checkforempty(array('name','tag'))) {
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
                                "INSERT INTO " . PREFIX . "settings_games (
                                    name,
                                    tag
                                ) VALUES (
                                    '" . $name . "',
                                    '" . $tag ."'
                                )"
                            );

                            $file = $tag . '.'.$upload->getExtension();

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
            echo $_language->module[ 'fill_correctly' ];
        }
    } else {
        echo $_language->module[ 'transaction_invalid' ];
    }
    redirect("admincenter.php?site=settings_games", "", 0);
} elseif (isset($_POST[ "saveedit" ])) {
    $icon = $_FILES[ "icon" ];
    $name = $_POST[ "name" ];
    $tag = $_POST[ "tag" ];
    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_POST[ 'captcha_hash' ])) {
        if (checkforempty(array('name','tag'))) {
            safe_query(
                "UPDATE
                    " . PREFIX . "settings_games
                SET
                    name='" . $name . "',
                    tag='" . $tag ."'
                WHERE gameID='" . $_POST[ "gameID" ] . "'"
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
                            $file = $tag . '.'. $upload->getExtension();

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
            echo $_language->module[ 'fill_correctly' ];
        }
    } else {
        echo $_language->module[ 'transaction_invalid' ];
    }
    redirect("admincenter.php?site=settings_games", "", 0);
} elseif (isset($_GET[ "delete" ])) {
    $CAPCLASS = new \webspell\Captcha();
    if ($CAPCLASS->checkCaptcha(0, $_GET[ 'captcha_hash' ])) {
        $ds = mysqli_fetch_array(
            safe_query(
                "SELECT tag FROM " . PREFIX . "settings_games WHERE gameID='" . $_GET[ "gameID" ] . "'"
            )
        );
        $extension = explode('.',$ds['tag']);
        safe_query("DELETE FROM " . PREFIX . "settings_games WHERE gameID='" . $_GET[ "gameID" ] . "'");
        $file = $ds['tag'].".gif";
        if (file_exists($filepath.$file)) {
            unlink($filepath.$file);
        }
        redirect("admincenter.php?site=settings_games", "", 0);
    } else {
        echo $_language->module[ 'transaction_invalid' ];
    }
} else {

  

  if(isset($_GET['page'])) $page=(int)$_GET['page'];
  else $page = 1;
	
  echo'<div class="panel panel-default">
   <div class="panel-heading">
                            <i class="fa fa-gamepad"></i> ' . $_language->module['games'] . '
                        </div>
  <div class="panel-body">';
  
  echo'<a href="admincenter.php?site=settings_games&amp;action=add" class="btn btn-primary" type="button">' . $_language->module[ 'new_game' ] . '</a><br /><br />';
  
  $alle=safe_query("SELECT gameID FROM ".PREFIX."settings_games");
  $gesamt = mysqli_num_rows($alle);
  $pages=1;

  $max='15';

  for ($n=$max; $n<=$gesamt; $n+=$max) {
    if($gesamt>$n) $pages++;
  }

  if($pages>1) $page_link = makepagelink("admincenter.php?site=settings_games", $page, $pages);
    else $page_link='';

  if ($page == "1") {
    $ergebnis = safe_query("SELECT * FROM ".PREFIX."settings_games ORDER BY name ASC LIMIT 0,$max");
    $n=1;
  }
  else {
    $start=$page*$max-$max;
    $ergebnis = safe_query("SELECT * FROM ".PREFIX."settings_games ORDER BY name ASC LIMIT $start,$max");
    $n = ($gesamt+1)-$page*$max+$max;
  }
  

  echo'<table class="table table-striped">
    <thead>
      <th><b>' . $_language->module['icons'] . '</b></th>
      <th><b>' . $_language->module['game_name'] . '</b></th>
      <th><b>' . $_language->module['game_tag'] . '</b></th>
      <th><b>' . $_language->module['actions'] . '</b></th>
    </thead>';
  
	 $n=1;

  $CAPCLASS = new \webspell\Captcha;
    $CAPCLASS->createTransaction();
    $hash = $CAPCLASS->getHash();

  while($ds=mysqli_fetch_array($ergebnis)) {

    

	   			
      echo'<tr>
        <td><img align="center" src="../' . $filepath . $ds['tag'] . '.gif" alt="{img}" /></td>
        <td>' . getinput($ds['name']) . '</td>
        <td>' . getinput($ds['tag']) . '</td>
        <td><a href="admincenter.php?site=settings_games&amp;action=edit&amp;gameID=' . $ds['gameID'] . '" class="hidden-xs hidden-sm btn btn-warning" type="button">' . $_language->module[ 'edit' ] . '</a>

        <input class="hidden-xs hidden-sm btn btn-danger" type="button" onclick="MM_confirm(\'' . $_language->module['really_delete'] . '\', \'admincenter.php?site=settings_games&amp;delete=true&amp;gameID=' . $ds['gameID'] . '&amp;captcha_hash=' . $hash . '\')" value="' . $_language->module['delete'] . '" />
		
    <a href="admincenter.php?site=settings_games&amp;action=edit&amp;gameID=' . $ds['gameID'] . '"  class="mobile visible-xs visible-sm" type="button"><i class="fa fa-pencil"></i></a>
        <a class="mobile visible-xs visible-sm" type="button" onclick="MM_confirm(\'' . $_language->module['really_delete'] . '\', \'admincenter.php?site=settings_games&amp;delete=true&amp;gameID=' . $ds['gameID'] . '&amp;captcha_hash=' . $hash . '\')" /><i class="fa fa-times"></i></a></td>
      </tr>';
      
      $n++;
  }
    echo'</table>';
  
if($pages>1) echo $page_link;
}
echo '</div></div>';
?>