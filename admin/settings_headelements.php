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
                "SELECT * FROM " . PREFIX . "settings_headelements WHERE headelementID='" . $_GET[ "headelementID" ] . "'"
            )
        );

        $id = (int)$_GET[ 'headelementID' ];
        #$name = (int)$_GET[ 'name' ];
        safe_query("DELETE FROM " . PREFIX . "settings_headelements WHERE headelementID='" . $id . "' ");
        $filepath = "../images/headelements/";
        $file = $ds['site'];
        if (file_exists($filepath . $id . '.gif')) {
            unlink($filepath . $id . '.gif');
        }
        if (file_exists($filepath . $id . '.jpg')) {
            unlink($filepath . $id . '.jpg');
        }
        if (file_exists($filepath . $id . '.png')) {
            unlink($filepath . $id . '.png');
        }
    } else {
        echo $_language->module[ 'transaction_invalid' ];
    }
} elseif (isset($_POST[ 'save' ])) {
    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_POST[ 'captcha_hash' ])) {
        $name = $_POST[ 'name' ];
         
        $info = $_POST[ 'info' ];

        if ($_POST['site'] == "*") {
            $site = $_POST[ 'site_field' ];
            $modulname = $_POST[ 'site_field' ];
        } else {
            $site = $_POST[ 'site' ];
            $modulname = $_POST[ 'site' ];
        }

        if (isset($_POST[ "displayed" ])) {
            $displayed = 1;
        } else {
            $displayed = 0;
        }
        
        safe_query(
            "INSERT INTO
                `" . PREFIX . "settings_headelements` (
                    `name`,
                    `info`,
                    `modulname`,
                    `displayed`,
                    `site`
                )
                VALUES (
                    '$name',
                    '$info',
                    '$modulname',
                    '" . $displayed . "',
                    '$site'
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
                        if ($imageInformation[0] < 1921 && $imageInformation[1] < 631) {
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
                            $file = $id.$endung;

                            if (file_exists($filepath . $id . '.gif')) {
                                unlink($filepath . $id . '.gif');
                            }
                            if (file_exists($filepath . $id . '.jpg')) {
                                unlink($filepath . $id . '.jpg');
                            }
                            if (file_exists($filepath . $id . '.png')) {
                                unlink($filepath . $id . '.png');
                            }

                            if ($upload->saveAs($filepath.$file)) {
                                @chmod($filepath.$file, $new_chmod);
                                safe_query(
                                    "UPDATE " . PREFIX . "settings_headelements
                                    SET banner='" . $file . "' WHERE headelementID='" . $id . "'"
                                );
                            }
                        } else {
                            echo generateErrorBox(sprintf($_language->module[ 'image_to_big' ], 1920, 630));
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

        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_headelements WHERE name='Startpage'"));
        if(@$dx[ 'name' ] == $_POST[ 'name' ] OR @$dx[ 'name' ] == 'Startpage') {
            $name = $_POST[ 'name' ];
        } else {
            $name = 'Startpage';       
        }

        $info = $_POST[ 'info' ];

        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_headelements WHERE name='Startpage'"));
        if(@$dx[ 'name' ] == $_POST[ 'name' ] OR @$dx[ 'name' ] == 'Startpage') {
            if ($_POST['site'] == "*") {
            $site = $_POST[ 'site_field' ];
            $modulname = $_POST[ 'site_field' ];
            } else {
            $site = $_POST[ 'site' ];
            $modulname = $_POST[ 'site' ];
            }
        } else {
            $site = '';
            $modulname = '';           
        }
        
        if (isset($_POST[ "displayed" ])) {
            $displayed = 1;
        } else {
            $displayed = 0;
        }
        
        $headelementID = (int)$_POST[ 'headelementID' ];
        $id = $headelementID;        

        safe_query(
            "UPDATE
                `" . PREFIX . "settings_headelements`
            SET
                `name` = '" . $name . "',
                `info` = '" . $info . "',
                `displayed` = '" . $displayed . "',
                `site` = '" . $site . "',
                `modulname` = '" . $modulname . "'
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
                        if ($imageInformation[0] < 1921 && $imageInformation[1] < 631) {
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
                            $file = $id.$endung;

                            if (file_exists($filepath . $id . '.gif')) {
                                unlink($filepath . $id . '.gif');
                            }
                            if (file_exists($filepath . $id . '.jpg')) {
                                unlink($filepath . $id . '.jpg');
                            }
                            if (file_exists($filepath . $id . '.png')) {
                                unlink($filepath . $id . '.png');
                            }

                            if ($upload->saveAs($filepath.$file)) {
                                @chmod($filepath.$file, $new_chmod);
                                safe_query(
                                    "UPDATE " . PREFIX . "settings_headelements
                                    SET banner='" . $file . "' WHERE headelementID='" . $id . "'"
                                );
                            }
                        } else {
                            echo generateErrorBox(sprintf($_language->module[ 'image_to_big' ], 1920, 630));
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

    $site = '<option value="*">...</option>
                <option value="contact">Contact</option>
                <option value="imprint">Imprint</option>
                <option value="privacy_policy">Privacy Policy</option>
                <option value="articles">Articles</option>
                <option value="forum">Forum</option>
                <option value="squads">Squads</option>
                <option value="about_us">About us</option>
                <option value="userlist">User List</option>
                <option value="whoisonline">Whois online</option>
                <option value="links">Links</option>
                <option value="discord">Discord</option>
                <option value="sponsors">Sponsors</option>
                <option value="files">Files</option>
                <option value="partners">Partners</option>
                <option value="videos">Videos</option>
                <option value="counter">Counter</option>
                <option value="calendar">Calendar</option>
                <option value="faq">FAQ</option>
                <option value="news_manager">NEWS</option>';
	
echo'<div class="card">
            <div class="card-header">
                '.$_language->module['headelements'].'</div>

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="admincenter.php?site=settings_headelements">' . $_language->module[ 'headelements' ] . '</a></li>
                <li class="breadcrumb-item active" aria-current="page">'.$_language->module['add_partner'].'</li>
                </ol>
            </nav>  
            <div class="card-body">';

	echo'<form class="form-horizontal" method="post" action="admincenter.php?site=settings_headelements" enctype="multipart/form-data">

    <div class="mb-3 row">
    <label class="col-sm-2 control-label">'.$_language->module['headelements_name'].':</label>
    <div class="col-sm-10"><span class="text-muted small"><em>
      <input type="text" class="form-control" name="name" size="60" /></em></span>
    </div>
  </div>
  <div class="mb-3 row">
    <label class="col-sm-2 control-label">'.$_language->module['headelements_side_name'].':<br><small>(vordefiniert)</small></label>
    <div class="col-sm-10"><span class="text-muted small"><em>    
      <select class="form-select" name="site">'.$site.'</select></em></span>
    </div>
      <label class="col-sm-2 control-label">'.$_language->module['headelements_side_name'].':<br><small>(manuelle Eingabe)</small></label>
    <div class="col-sm-10"><span class="text-muted small"><em>
      <input type="text" class="form-control" name="site_field" size="60" /></em></span>
    </div>
  </div>
  <div class="mb-3 row">
    <label class="col-sm-2 control-label">'.$_language->module['headelements_side_info'].':</label>
    <div class="col-sm-10"><span class="text-muted small"><em>
    <textarea class="ckeditor" id="ckeditor" name="info" rows="10" cols="" ></textarea></em></span>
    </div>
  </div>
  <div class="mb-3 row">
    <label class="col-sm-2 control-label">'.$_language->module['banner'].':</label>
    <div class="col-sm-10"><span class="text-muted small"><em>
      <input class="btn btn-info" name="banner" type="file" size="40" /> <small>(max. 1920x500)</small></em></span>
    </div>
  </div>
  <div class="mb-3 row">
    <label class="col-sm-2 control-label">'.$_language->module['is_displayed'].':</label>
    <div class="col-sm-10 form-check form-switch" style="padding: 0px 43px;">
      <input class="form-check-input" type="checkbox" name="displayed" value="1" checked="checked" />
    </div>
  </div>
   <div class="mb-3 row">
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
                '.$_language->module['headelements'].'</div>

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

    if ($ds[ 'displayed' ] == '1') {
        $displayed = '<input class="form-check-input" type="checkbox" name="displayed" value="1" checked="checked" />';
    } else {
        $displayed = '<input class="form-check-input" type="checkbox" name="displayed" value="1" />';
    }

    $site = '<option value="*">...</option>
                <option value="contact">Contact</option>
                <option value="imprint">Imprint</option>
                <option value="privacy_policy">Privacy Policy</option>
                <option value="articles">Articles</option>
                <option value="forum">Forum</option>
                <option value="squads">Squads</option>
                <option value="about_us">About us</option>
                <option value="userlist">User List</option>
                <option value="whoisonline">Whois online</option>
                <option value="links">Links</option>
                <option value="discord">Discord</option>
                <option value="sponsors">Sponsors</option>
                <option value="files">Files</option>
                <option value="partners">Partners</option>
                <option value="videos">Videos</option>
                <option value="counter">Counter</option>
                <option value="calendar">Calendar</option>
                <option value="faq">FAQ</option>
                <option value="news_manager">NEWS</option>';
        $site =
        str_replace(
            'value="' . $ds[ 'site' ] . '"',
            'value="' . $ds[ 'site' ] . '" selected="selected"',
            $site
        );

    echo'<form class="form-horizontal" method="post" action="admincenter.php?site=settings_headelements" enctype="multipart/form-data">
    <div class="mb-3 row">
    <label class="col-sm-2 control-label">'.$_language->module['current_banner'].':</label>
    <div class="col-sm-10">
      '.$pic.'
    </div>
  </div>
  ';
    $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_headelements WHERE name='" . $ds[ 'name' ] . "'"));
    if(@$dx[ 'name' ] != 'Startpage') {
        echo'<div class="mb-3 row">
        <label class="col-sm-2 control-label">'.$_language->module['headelements_name'].':</label>
        <div class="col-sm-10"><span class="text-muted small"><em>
          <input type="text" class="form-control" name="name" value="'.getinput($ds['name']).'" /></em></span>
          </div>
        </div>
        <div class="mb-3 row">
        <label class="col-sm-2 control-label">'.$_language->module['headelements_side_name'].':</label>
        <div class="col-sm-10"><span class="text-muted small"><em>
        <select class="form-select" name="site">'.$site.'</select></em></span>
        </div>
          <label class="col-sm-2 control-label">'.$_language->module['headelements_side_name'].':<br><small>(manuelle Eingabe)</small></label>
        <div class="col-sm-10"><span class="text-muted small"><em>
          <input type="text" class="form-control" name="site_field" value="'.getinput($ds['site']).'" size="60" /></em></span>
        </div>
      </div>';
    }else{print_r($dx[ 'name' ]);
      echo'<div class="mb-3 row">
        <label class="col-sm-2 control-label">'.$_language->module['headelements_name'].':</label>
        <div class="col-sm-10"><span class="text-muted small"><em>
          <input type="text" class="form-control" name="name" value="Startpage" readonly /></em></span>
          </div>
      </div>
      <div class="mb-3 row">
        <label class="col-sm-2 control-label">'.$_language->module['headelements_side_name'].':</label>
        <div class="col-sm-10"><span class="text-muted small"><em>
        <input type="text" class="form-control" name="site" value="" readonly /></em></span>
        </div>
          <label class="col-sm-2 control-label">'.$_language->module['headelements_side_name'].':<br><small>(manuelle Eingabe)</small></label>
        <div class="col-sm-10"><span class="text-muted small"><em>
          <input type="text" class="form-control" name="site_field" value="" size="60" readonly  /></em></span>
        </div>
      </div>';
    }
  echo'
  <div class="mb-3 row">
    <label class="col-sm-2 control-label">'.$_language->module['headelements_side_info'].':</label>
    <div class="col-sm-10"><span class="text-muted small"><em>
      <textarea class="ckeditor" id="ckeditor" name="info" rows="10" cols="" >'.getinput($ds['info']).'</textarea></em></span>
    </div>
  </div>
<div class="mb-3 row">
    <label class="col-sm-2 control-label">'.$_language->module['banner'].':</label>
    <div class="col-sm-10"><span class="text-muted small"><em>
      <input class="btn btn-info" name="banner" type="file" size="40" /> <small>(max. 1920x500)</small></em></span>
    </div>
  </div>
  <div class="mb-3 row">
    <label class="col-sm-2 control-label">'.$_language->module['is_displayed'].':</label>
    <div class="col-sm-10 form-check form-switch" style="padding: 0px 43px;">
     '.$displayed.'
    </div>
  </div>
  <div class="mb-3 row">
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
            '.$_language->module['headelements'].'</div>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="admincenter.php?site=settings_headelements">' . $_language->module[ 'headelements' ] . '</a></li>
                <li class="breadcrumb-item active" aria-current="page">New / Edit</li>
            </ol>
        </nav>  
        <div class="card-body">

        <div class="mb-3 row row">
            <label class="col-md-1 control-label">' . $_language->module['options'] . ':</label>
            <div class="col-md-8">
              <a href="admincenter.php?site=settings_headelements&amp;action=add" class="btn btn-primary">' . $_language->module[ 'new_partner' ] . '</a>
            </div>
        </div>
            ' . $_language->module[ 'startpage_info' ] . '';


	echo'<form method="post" action="admincenter.php?site=settings_headelements">
      <table id="plugini" class="table table-bordered table-striped dataTable">
        <thead>
            <th><b>'.$_language->module['banner'].'</b></th>
            <th><b>'.$_language->module['headelements_name'].'</b></th>
            <th><b>'.$_language->module['headelements_side_info'].'</b></th>
            <th><b>'.$_language->module['headelements_side_name'].'</b></th>
            <th><b>'.$_language->module['is_displayed'].'</b></th>
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
            $pic = '<img id="img-upl1oad" class="img-thumbnail" style="height: 100%; width: 300px" src="' . $filepath . 'no-image.jpg" alt="">';
        }

        $db[ 'displayed' ] == 1 ? $displayed = '<font color="green"><b>' . $_language->module[ 'yes' ] . '</b></font>' :
        $displayed = '<font color="red"><b>' . $_language->module[ 'no' ] . '</b></font>';

        echo '<tr>
            <td style="width: 20%">'.$pic.'</td>
            <td style="width: 10%">'.getinput($db['name']).'</td>
            <td>'.getinput($db['info']).'</td>
            <td style="width: 10%">'.getinput($db['site']).'</td>
            <td style="width: 10%">'.$displayed.'</td>
            <td style="width: 10%"> <a href="admincenter.php?site=settings_headelements&amp;action=edit&amp;headelementID='.$db['headelementID'].'" class="btn btn-warning" type="button">' . $_language->module[ 'edit' ] . '</a>';
        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_headelements WHERE name='".$db['name']."'"));
        if(@$dx[ 'name' ] != 'Startpage') {                    
            echo'
            <!-- Button trigger modal -->
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirm-delete" data-href="admincenter.php?site=settings_headelements&amp;delete=true&amp;headelementID='.$db['headelementID'].'&amp;captcha_hash='.$hash.'">
                ' . $_language->module['delete'] . '
                </button>
            <!-- Button trigger modal END-->';
        } else{
            echo'';
        }
        echo'
         </td>
             <!-- Modal -->
        <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">' . $_language->module[ 'headelements' ] . '</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="' . $_language->module[ 'close' ] . '"></button>
              </div>
              <div class="modal-body"><p>' . $_language->module['really_delete'] . '</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">' . $_language->module[ 'close' ] . '</button>
                <a class="btn btn-danger btn-ok">' . $_language->module['delete'] . '</a>
              </div>
            </div>
          </div>
        </div>
        <!-- Modal END --> 
              
            </tr>';

    $i++;

	}
	echo'
  </table>
  </form></div></div>';
}
echo '';
?>