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
$_language->readModule('games', false, true);

$ergebnis = safe_query("SELECT * FROM ".PREFIX."navigation_dashboard_links WHERE modulname='games'");
    while ($db=mysqli_fetch_array($ergebnis)) {
      $accesslevel = 'is'.$db['accesslevel'].'admin';

if (!$accesslevel($userID) || mb_substr(basename($_SERVER[ 'REQUEST_URI' ]), 0, 15) != "admincenter.php") {
    die($_language->module[ 'access_denied' ]);
}
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
  echo'<div class="card">
        <div class="card-header">
            <i class="fas fa-gamepad"></i> ' . $_language->module['games'] . '
        </div>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="admincenter.php?site=settings_games">' . $_language->module['games'] . '</a></li>
    <li class="breadcrumb-item active" aria-current="page">' . $_language->module['add_game'] . '</li>
  </ol>
</nav>
     <div class="card-body">';
	
	echo'<form class="form-horizontal" method="post" action="admincenter.php?site=settings_games" enctype="multipart/form-data">
	<div class="form-group row">
    <label class="col-md-2 control-label">' . $_language->module['game_icon'] . ':</label>
    <div class="col-md-8">
      <input name="icon" class="form-control-file" type="file" size="40" />
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-2 control-label">' . $_language->module['game_name'] . ':</label>
    <div class="col-md-8">
      <input class="form-control" type="text" name="name" maxlength="255" />
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-2 control-label">' . $_language->module['game_tag'] . ':</label>
    <div class="col-md-8">
      <input class="form-control" type="text" name="tag" size="7" maxlength="10" />
    </div>
  </div>
  <div class="form-group row">
    <div class="col-md-offset-2 col-md-10">
		<input type="hidden" name="captcha_hash" value="' . $hash . '" />
		<button class="btn btn-success" type="submit" name="save"  />' . $_language->module['add'] . '</button>
    </div>
  </div>
  </form>
  </div>
  </div>';

} elseif ($action == "edit") {
    $ds = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_games WHERE gameID='" . $_GET[ "gameID" ] . "'"));
    
    #if (!empty($ds[ 'tag' ])) {
    #    $pic = '<img src="../' . $filepath . $ds[ 'tag' ] . '.gif" alt="">';
    #} else {
    #    $pic = "no_upload";
    #}

    if(file_exists('../images/games/'.$ds['tag'].'.jpg')){
            $gameicon='<img style="height: 100px" src="../images/games/'.$ds['tag'].'.jpg" alt="">';
        } elseif(file_exists('../images/games/'.$ds['tag'].'.jpeg')){
            $gameicon='<img style="height: 100px" src="../images/games/'.$ds['tag'].'.jpeg" alt="">';
        } elseif(file_exists('../images/games/'.$ds['tag'].'.png')){
            $gameicon='<img style="height: 100px" src="../images/games/'.$ds['tag'].'.png" alt="">';
        } elseif(file_exists('../images/games/'.$ds['tag'].'.gif')){
            $gameicon='<img style="height: 100px" src="../images/games/'.$ds['tag'].'.gif" alt="">';
        } else{
           $gameicon='<img style="height: 100px" src="../includes/plugins/clanwars/images/no-image.jpg" alt="">';
        }

    $CAPCLASS = new \webspell\Captcha;
    $CAPCLASS->createTransaction();
    $hash = $CAPCLASS->getHash();
	
  echo'<div class="card">
        <div class="card-header">
            <i class="fas fa-gamepad"></i> ' . $_language->module['games'] . '
        </div>
            
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="admincenter.php?site=settings_games">' . $_language->module['games'] . '</a></li>
    <li class="breadcrumb-item active" aria-current="page">' . $_language->module['edit_game'] . '</li>
  </ol>
</nav>
     <div class="card-body">
';

	echo'<form class="form-horizontal" method="post" action="admincenter.php?site=settings_games" enctype="multipart/form-data">
  <input type="hidden" name="gameID" value="' . $ds['gameID'] . '" />
  
  <div class="form-group row">
    <label class="col-md-2 control-label">' . $_language->module['present_icon'] . ':</label>
    <div class="col-md-8">
      <p class="form-control-static">'.$gameicon.'</p>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-2 control-label">' . $_language->module['game_icon'] . ':</label>
    <div class="col-md-8">
      <input name="icon" class="form-control-file" type="file" size="40" />
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-2 control-label">' . $_language->module['game_name'] . ':</label>
    <div class="col-md-8">
      <input class="form-control" type="text" name="name" maxlength="255" value="' . getinput($ds['name']) . '" />
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-2 control-label">' . $_language->module['game_tag'] . ':</label>
    <div class="col-md-8">
      <input class="form-control" type="text" name="tag" size="7" maxlength="10" value="' . getinput($ds['tag']) . '" />
    </div>
  </div>
  <div class="form-group row">
    <div class="col-md-offset-2 col-md-10">
		<input type="hidden" name="captcha_hash" value="' . $hash . '" />
		<button class="btn btn-warning" type="submit" name="saveedit"  />' . $_language->module['edit'] . '</button>
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
        #if (checkforempty(array('name','tag'))) {
            $errors = array();

            //TODO: should be loaded from root language folder
            $_language->readModule('formvalidation', true, true);

             $errors = array();
 
            $upload = new \webspell\HttpUpload('icon');
            if ($upload->hasFile()) {
                if ($upload->hasError() === false) {
                    $mime_types = array('image/jpeg','image/png','image/gif');

                    if ($upload->supportedMimeType($mime_types)) {
                        $imageInformation = getimagesize($upload->getTempFile());

                        if (is_array($imageInformation)) {
                          switch ($imageInformation[ 2 ]) {
                            case 1:
                                $endung = '.gif';
                                break;
                            case 3:
                                $endung = '.png';
                                break;
                            default:
                                $endung = '.jpg';
                                break;
                            }
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

        #} else {
        #    echo $_language->module[ 'fill_correctly' ];
        #}
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
    #safe_query("INSERT INTO `".PREFIX."settings_games` (tag,name) values ('".$tag."','".$name."')");
        /*if (checkforempty(array('name','tag'))) {*/
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
                     $mime_types = array('image/jpeg','image/png','image/gif');

                    if ($upload->supportedMimeType($mime_types)) {
                    $imageInformation =  getimagesize($upload->getTempFile());
 

                        if (is_array($imageInformation)) {

                            switch ($imageInformation[ 2 ]) {
                            case 1:
                                $endung = '.gif';
                                break;
                            case 3:
                                $endung = '.png';
                                break;
                            default:
                                $endung = '.jpg';
                                break;
                            }
                            
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
        #} else {
        #    echo $_language->module[ 'fill_correctly' ];
        #}
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
  
	
  echo'<div class="card">
        <div class="card-header">
            <i class="fas fa-gamepad"></i> ' . $_language->module['games'] . '
        </div>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">' . $_language->module[ 'games' ] . '</li>
  </ol>
</nav>

<div class="card-body">

<div class="form-group row">
    <label class="col-md-1 control-label">' . $_language->module['options'] . ':</label>
    <div class="col-md-8">
      <a href="admincenter.php?site=settings_games&amp;action=add" class="btn btn-primary" type="button">' . $_language->module[ 'new_game_submit' ] . '</a>
    </div>
  </div>';
  
  $ergebnis=safe_query("SELECT * FROM " . PREFIX . "settings_games");
  
  echo'<table id="datatables" class="table table-bordered table-striped dataTable">
    <thead>
      <th><b>' . $_language->module['icons'] . '</b></th>
      <th><b>' . $_language->module['game_name'] . '</b></th>
      <th><b>' . $_language->module['game_tag'] . '</b></th>
      <th><b>' . $_language->module['actions'] . '</b></th>
    </thead><tbody>';
  
	

  $CAPCLASS = new \webspell\Captcha;
    $CAPCLASS->createTransaction();
    $hash = $CAPCLASS->getHash();

  while($ds=mysqli_fetch_array($ergebnis)) {



        if(file_exists('../images/games/'.$ds['tag'].'.jpg')){
            $gameicon='<img style="height: 100px" src="../images/games/'.$ds['tag'].'.jpg" alt="">';
        } elseif(file_exists('../images/games/'.$ds['tag'].'.jpeg')){
            $gameicon='<img style="height: 100px" src="../images/games/'.$ds['tag'].'.jpeg" alt="">';
        } elseif(file_exists('../images/games/'.$ds['tag'].'.png')){
            $gameicon='<img style="height: 100px" src="../images/games/'.$ds['tag'].'.png" alt="">';
        } elseif(file_exists('../images/games/'.$ds['tag'].'.gif')){
            $gameicon='<img style="height: 100px" src="../images/games/'.$ds['tag'].'.gif" alt="">';
        } else{
           $gameicon='<img style="height: 100px" src="../includes/plugins/clanwars/images/no-image.jpg" alt="">';
        }




    echo'<tr>
        <th>'.$gameicon.'</th>
        <th>' . getinput($ds['name']) . '</th>
        <th>' . getinput($ds['tag']) . '</th>
        <th><a href="admincenter.php?site=settings_games&amp;action=edit&amp;gameID=' . $ds['gameID'] . '" class="btn btn-warning" type="button">' . $_language->module[ 'edit' ] . '</a>

         <input class="btn btn-danger" type="button" onclick="MM_confirm(\'' . $_language->module['really_delete'] . '\', \'admincenter.php?site=settings_games&amp;delete=true&amp;gameID=' . $ds['gameID'] . '&amp;captcha_hash=' . $hash . '\')" value="' . $_language->module['delete'] . '" />  

       </th>
      </tr>';
      
      
  }
    echo'</tbody></table>';
  
}
echo '</div></div>';
?>