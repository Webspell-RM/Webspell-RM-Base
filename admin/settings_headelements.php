<?php
/**
 *¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*  
 *                                    Webspell-RM      /                        /   /                                                 *
 *                                    -----------__---/__---__------__----__---/---/-----__---- _  _ -                                *
 *                                     | /| /  /___) /   ) (_ `   /   ) /___) /   / __  /     /  /  /                                 *
 *                                    _|/_|/__(___ _(___/_(__)___/___/_(___ _/___/_____/_____/__/__/_                                 *
 *                                                 Free Content / Management System                                                   *
 *                                                             /                                                                      *
 *¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
 * @version         Webspell-RM                                                                                                       *
 *                                                                                                                                    *
 * @copyright       2018-2022 by webspell-rm.de <https://www.webspell-rm.de>                                                          *
 * @support         For Support, Plugins, Templates and the Full Script visit webspell-rm.de <https://www.webspell-rm.de/forum.html>  *
 * @WIKI            webspell-rm.de <https://www.webspell-rm.de/wiki.html>                                                             *
 *                                                                                                                                    *
 *¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
 * @license         Script runs under the GNU GENERAL PUBLIC LICENCE                                                                  *
 *                  It's NOT allowed to remove this copyright-tag <http://www.fsf.org/licensing/licenses/gpl.html>                    *
 *                                                                                                                                    *
 * @author          Code based on WebSPELL Clanpackage (Michael Gruber - webspell.at)                                                 *
 * @copyright       2005-2018 by webspell.org / webspell.info                                                                         *
 *¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
 *                                                                                                                                    *
 *¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
 */

# Sprachdateien aus dem Plugin-Ordner laden
$_language->readModule('headelements', false, true);

$ergebnis = safe_query("SELECT * FROM ".PREFIX."navigation_dashboard_links WHERE modulname='ac_headelements'");
    while ($db=mysqli_fetch_array($ergebnis)) {
      $accesslevel = 'is'.$db['accesslevel'].'admin';

if (!$accesslevel($userID) || mb_substr(basename($_SERVER[ 'REQUEST_URI' ]), 0, 15) != "admincenter.php") {
    die($_language->module[ 'access_denied' ]);
}
}

$filepath = "../images/headelements/";

if (isset($_GET[ 'action' ])) {
    $action = $_GET[ 'action' ];
} else {
    $action = '';
}

if (isset($_GET[ 'delete' ])) {
    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_GET[ 'captcha_hash' ])) {
        $ds = mysqli_fetch_array(
            safe_query(
                "SELECT side FROM " . PREFIX . "settings_headelements WHERE headelementID='" . $_GET[ "headelementID" ] . "'"
            )
        );

        $headelementID = (int)$_GET[ 'headelementID' ];
        #$name = (int)$_GET[ 'name' ];
        safe_query("DELETE FROM " . PREFIX . "settings_headelements WHERE headelementID='" . $headelementID . "' ");
        $filepath = "../images/headelements/";
        $file = $ds['side'];
        if (file_exists($filepath . $file . '.gif')) {
            unlink($filepath . $file . '.gif');
        }
        if (file_exists($filepath . $file . '.jpg')) {
            unlink($filepath . $file . '.jpg');
        }
        if (file_exists($filepath . $file . '.png')) {
            unlink($filepath . $file . '.png');
        }
    } else {
        echo $_language->module[ 'transaction_invalid' ];
    }
} elseif (isset($_POST[ 'save' ])) {
    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_POST[ 'captcha_hash' ])) {
        $name = $_POST[ 'name' ];
        $side = $_POST[ 'side' ];
        
        safe_query(
            "INSERT INTO
                `" . PREFIX . "settings_headelements` (
                    `name`,
                    `side`
                )
                VALUES (
                    '$name',
                    '$side'
                )"
        );
        $id = mysqli_insert_id($_database);

        $filepath = "../images/headelements/";

        //TODO: should be loaded from root language folder
        $_language->readModule('formvalidation',true, true);
		
        $upload = new \webspell\HttpUpload('banner');

        if ($upload->hasFile()) {
            if ($upload->hasError() === false) {
                $mime_types = array('image/jpeg','image/png','image/gif');
                if ($upload->supportedMimeType($mime_types)) {
                    $imageInformation =  getimagesize($upload->getTempFile());

                    if (is_array($imageInformation)) {
                        if ($imageInformation[0] < 1921 && $imageInformation[1] < 501) {
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
                            $file = $side.$endung;

                            if (file_exists($filepath . $side . '.gif')) {
                                unlink($filepath . $side . '.gif');
                            }
                            if (file_exists($filepath . $side . '.jpg')) {
                                unlink($filepath . $side . '.jpg');
                            }
                            if (file_exists($filepath . $side . '.png')) {
                                unlink($filepath . $side . '.png');
                            }

                            if ($upload->saveAs($filepath.$file)) {
                                @chmod($filepath.$file, $new_chmod);
                                safe_query(
                                    "UPDATE " . PREFIX . "settings_headelements
                                    SET banner='" . $file . "' WHERE headelementID='" . $id . "'"
                                );
                            }
                        } else {
                            echo generateErrorBox(sprintf($_language->module[ 'image_too_big' ], 1920, 500));
						}
                    } else {
                        echo generateErrorBox($_language->module[ 'broken_image' ]);
                    }
                } else {
                    echo generateErrorBox($_language->module[ 'unsupported_image_type' ]);
                }
            } else {
                echo  generateErrorBox($upload->translateError());
            }
        }
    } else {
        echo  $_language->module[ 'transaction_invalid' ];
    }
} elseif (isset($_POST[ 'saveedit' ])) {
    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_POST[ 'captcha_hash' ])) {
        $name = $_POST[ 'name' ];
        $side = $_POST[ 'side' ];
        
        $headelementID = (int)$_POST[ 'headelementID' ];
        $id = $headelementID;

        

        safe_query(
            "UPDATE
                `" . PREFIX . "settings_headelements`
            SET
                `name` = '" . $name . "',
                `side` = '" . $side . "'
            WHERE
                `headelementID` = '" . $headelementID . "'"
        );

        $filepath = "../images/headelements/";

        //TODO: should be loaded from root language folder
        $_language->readModule('formvalidation', true, true);

        $upload = new \webspell\HttpUpload('banner');

        if ($upload->hasFile()) {
            if ($upload->hasError() === false) {
                $mime_types = array('image/jpeg','image/png','image/gif');
                if ($upload->supportedMimeType($mime_types)) {
                    $imageInformation =  getimagesize($upload->getTempFile());

                    if (is_array($imageInformation)) {
                        if ($imageInformation[0] < 1921 && $imageInformation[1] < 501) {
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
                            $file = $side.$endung;

                            if (file_exists($filepath . $side . '.gif')) {
                                unlink($filepath . $side . '.gif');
                            }
                            if (file_exists($filepath . $side . '.jpg')) {
                                unlink($filepath . $side . '.jpg');
                            }
                            if (file_exists($filepath . $side . '.png')) {
                                unlink($filepath . $side . '.png');
                            }

                            if ($upload->saveAs($filepath.$file)) {
                                @chmod($filepath.$file, $new_chmod);
                                safe_query(
                                    "UPDATE " . PREFIX . "settings_headelements
                                    SET banner='" . $file . "' WHERE headelementID='" . $id . "'"
                                );
                            }
                        } else {
                            echo generateErrorBox(sprintf($_language->module[ 'image_too_big' ], 1920, 500));
                        }
                    } else {
                        echo generateErrorBox($_language->module[ 'broken_image' ]);
                    }
                } else {
                    echo generateErrorBox($_language->module[ 'unsupported_image_type' ]);
                }
            } else {
                echo generateErrorBox($upload->translateError());
            }
        }
    } else {
        echo $_language->module[ 'transaction_invalid' ];
    }

} elseif (isset($_POST[ 'headelements_settings_save' ])) {  

   
    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_POST[ 'captcha_hash' ])) {
        safe_query(
            "UPDATE
                " . PREFIX . "settings_headelements_settings
            SET
                
                headelements='" . $_POST[ 'headelements' ] . "' "
        );
        
        redirect("admincenter.php?site=settings_headelements&action=settings_headelements_settings", "", 0);
    } else {
        redirect("admincenter.php?site=settings_headelements&action=settings_headelements_settings", $_language->module[ 'transaction_invalid' ], 3);
    }
}

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
                            <i class="fas fa-handshake"></i> '.$_language->module['headelements'].'</div>

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="admincenter.php?site=settings_headelements">' . $_language->module[ 'headelements' ] . '</a></li>
                <li class="breadcrumb-item active" aria-current="page">'.$_language->module['add_partner'].'</li>
                </ol>
            </nav>  
                        <div class="card-body">';


	echo'<form class="form-horizontal" method="post" action="admincenter.php?site=settings_headelements" enctype="multipart/form-data">

    <div class="form-group">
    <label class="col-sm-2 control-label">'.$_language->module['headelements_name'].':</label>
    <div class="col-sm-10"><span class="text-muted small"><em>
      <input type="text" class="form-control" name="name" size="60" /></em></span>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">'.$_language->module['headelements_side_name'].':</label>
    <div class="col-sm-10"><span class="text-muted small"><em>
      <input type="text" class="form-control" name="side" size="60" /></em></span>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">'.$_language->module['banner'].':</label>
    <div class="col-sm-10"><span class="text-muted small"><em>
      <input class="btn btn-info" name="banner" type="file" size="40" /> <small>(max. 1920x500)</small></em></span>
    </div>
  </div>
   <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
		<input type="hidden" name="captcha_hash" value="'.$hash.'" />
		<button class="btn btn-success" type="submit" name="save"  />'.$_language->module['add_partner'].'</button>
    </div>
  </div>
</form>
</div>
  </div>';
} elseif ($action == "edit") {
    $CAPCLASS = new \webspell\Captcha;
    $CAPCLASS->createTransaction();
    $hash = $CAPCLASS->getHash();
  
echo'<div class="card">
            <div class="card-header">
                            <i class="fas fa-handshake"></i> '.$_language->module['headelements'].'</div>

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="admincenter.php?site=settings_headelements">' . $_language->module[ 'headelements' ] . '</a></li>
                <li class="breadcrumb-item active" aria-current="page">'.$_language->module['edit_partner'].'</li>
                </ol>
            </nav>  
                        <div class="card-body">';

  
  $headelementID = $_GET[ 'headelementID' ];
    $ergebnis = safe_query("SELECT * FROM " . PREFIX . "settings_headelements WHERE headelementID='$headelementID'");
    $ds = mysqli_fetch_array($ergebnis);

    if (!empty($ds[ 'banner' ])) {
        $pic = '<img id="img-upload" class="img-thumbnail" style="width: 100%; max-width: 550px" src="../' . $filepath . $ds[ 'banner' ] . '" alt="">';
    } else {
        $pic = '<img id="img-upload" class="img-thumbnail" style="width: 100%; max-width: 550px" src="../' . $filepath . 'no-image.jpg" alt="">';
    }

    echo'<form class="form-horizontal" method="post" action="admincenter.php?site=settings_headelements" enctype="multipart/form-data">
    <div class="form-group">
    <label class="col-sm-2 control-label">'.$_language->module['current_banner'].':</label>
    <div class="col-sm-10">
      '.$pic.'
    </div>
  </div>
	<div class="form-group">
    <label class="col-sm-2 control-label">'.$_language->module['headelements_name'].':</label>
    <div class="col-sm-10"><span class="text-muted small"><em>
      <input type="text" class="form-control" name="name" value="'.getinput($ds['name']).'" /></em></span>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">'.$_language->module['headelements_side_name'].':</label>
    <div class="col-sm-10"><span class="text-muted small"><em>
      <input type="text" class="form-control" name="side" value="'.getinput($ds['side']).'" /></em></span>
    </div>
  </div>
<div class="form-group">
    <label class="col-sm-2 control-label">'.$_language->module['banner'].':</label>
    <div class="col-sm-10"><span class="text-muted small"><em>
      <input class="btn btn-info" name="banner" type="file" size="40" /> <small>(max. 1920x500)</small></em></span>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
		<input type="hidden" name="captcha_hash" value="'.$hash.'" /><input type="hidden" name="headelementID" value="'.$headelementID.'" />
		<button class="btn btn-warning" type="submit" name="saveedit"  />'.$_language->module['edit_partner'].'</button>
    </div>
  </div>
</form>
</div>
  </div>';




} elseif ($action == "") {
	
echo'<div class="card">
            <div class="card-header">
                            <i class="fas fa-handshake"></i> '.$_language->module['headelements'].'</div>

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="admincenter.php?site=settings_headelements">' . $_language->module[ 'headelements' ] . '</a></li>
                <li class="breadcrumb-item active" aria-current="page">New / Edit</li>
                </ol>
            </nav>  
                        <div class="card-body">

<div class="form-group row">
    <label class="col-md-1 control-label">' . $_language->module['options'] . ':</label>
    <div class="col-md-8">
      <a href="admincenter.php?site=settings_headelements&amp;action=add" class="btn btn-primary">' . $_language->module[ 'new_partner' ] . '</a>
    </div>
  </div>';


	echo'<form method="post" action="admincenter.php?site=settings_headelements">
  <table id="plugini" class="table table-bordered table-striped dataTable">
    <thead>
      <th><b>'.$_language->module['banner'].'</b></th>
      <th><b>'.$_language->module['headelements_name'].'</b></th>
      <th><b>'.$_language->module['headelements_side_name'].'</b></th>
      <th><b>'.$_language->module['actions'].'</b></th>
    </thead>';

	$headelements = safe_query("SELECT * FROM " . PREFIX . "settings_headelements");
    $tmp = mysqli_fetch_assoc(safe_query("SELECT count(headelementID) as cnt FROM " . PREFIX . "settings_headelements"));
    $anzheadelements = $tmp[ 'cnt' ];
    $CAPCLASS = new \webspell\Captcha;
    $CAPCLASS->createTransaction();
    $hash = $CAPCLASS->getHash();

    $CAPCLASS->createTransaction();
    $hash_2 = $CAPCLASS->getHash();

    if(file_exists('./images/headelements/'.$site.'.jpg')){
                    $banner=''.$site.'.jpg';
                    $style= '';
                } elseif(file_exists('./images/headelements/'.$site.'.jpeg')){
                    $banner=''.$site.'.jpeg';
                    $style= '';
                } elseif(file_exists('./images/headelements/'.$site.'.png')){
                    $banner=''.$site.'.png';
                    $style= '';
                } elseif(file_exists('./images/headelements/'.$site.'.gif')){
                    $banner=''.$site.'.gif';
                    $style= '';
                } else{
                   $banner='./images/headelements/no_pic.jpeg';
                   $style= 'style="margin-top: 0px;';
                }

    $i = 1;
    while ($db = mysqli_fetch_array($headelements)) {
        if ($i % 2) {
            $td = 'td1';
        } else {
            $td = 'td2';
        }

        if (!empty($db[ 'banner' ])) {
            $pic = '<img id="img-upload" class="img-thumbnail" style="width: 100%; max-width: 450px" src="' . $filepath . $db[ 'banner' ] . '" alt="">';
        } else {
            $pic = '<img id="img-upload" class="img-thumbnail" style="width: 100%; max-width: 450px" src="' . $filepath . 'no-image.jpg" alt="">';
        }

        echo '<tr>
        <td>'.$pic.'</td>
      <td>'.getinput($db['name']).'</td>
      <td>'.getinput($db['side']).'</td>
      <td><a href="admincenter.php?site=settings_headelements&amp;action=edit&amp;headelementID='.$db['headelementID'].'" class="btn btn-warning" type="button">' . $_language->module[ 'edit' ] . '</a>

        <input class="btn btn-danger" type="button" onclick="MM_confirm(\'' . $_language->module['really_delete'] . '\', \'admincenter.php?site=settings_headelements&amp;delete=true&amp;headelementID='.$db['headelementID'].'&amp;captcha_hash='.$hash.'\')" value="' . $_language->module['delete'] . '" />

	 
      </td>
      
    </tr>';
    $i++;
         
	}
	echo'
  </table>
  </form></div></div>';
}
echo '';
?>