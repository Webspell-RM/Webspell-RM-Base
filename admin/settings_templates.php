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

$_language->readModule('templates', false, true);

$ergebnis = safe_query("SELECT * FROM ".PREFIX."navigation_dashboard_links WHERE modulname='ac_templates'");
    while ($db=mysqli_fetch_array($ergebnis)) {
      $accesslevel = 'is'.$db['accesslevel'].'admin';

if (!$accesslevel($userID) || mb_substr(basename($_SERVER[ 'REQUEST_URI' ]), 0, 15) != "admincenter.php") {
    die($_language->module[ 'access_denied' ]);
}
}

	

if (isset($_GET[ 'action' ])) {
    $action = $_GET[ 'action' ];
} else {
    $action = '';
}


if (isset($_GET[ 'delete' ])) {
    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_GET[ 'captcha_hash' ])) {

        
        #print_r($_GET[ 'modulname' ]);
        $modulname = (int)$_GET[ 'modulname' ];

        #DeleteData("settings_buttons","modulname",$modulname);
        safe_query("DELETE FROM " . PREFIX . "settings_buttons WHERE modulname='" . $_GET[ 'modulname' ] . "' ");
        
        $themeID = (int)$_GET[ 'themeID' ];
        safe_query("DELETE FROM " . PREFIX . "settings_themes WHERE themeID='" . $themeID . "' ");

        
        
        
    } else {
        echo $_language->module[ 'transaction_invalid' ];
    }
} elseif (isset($_POST[ 'sortieren' ])) {
    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_POST[ 'captcha_hash' ])) {
        $sort = $_POST[ 'sort' ];
        foreach ($sort as $sortstring) {
            $sorter = explode("-", $sortstring);
            safe_query("UPDATE " . PREFIX . "settings_themes SET sort='".$sorter[1]."' WHERE themeID='".$sorter[0]."' ");
        }
    } else {
        echo $_language->module[ 'transaction_invalid' ];
    }

} elseif (isset($_POST[ 'save' ])) {
    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_POST[ 'captcha_hash' ])) {
      
        $name = $_POST[ 'name' ];
        $modulname = $_POST[ 'modulname' ];
        #$version = $_POST[ 'version' ];
        
    
    if(@$_POST['radio1']=="active") {
        $active = 1;
    } else {
        $active = 0;
    }
    
    if($active == '1') {
      $sql = safe_query("SELECT `themeID` FROM `".PREFIX."settings_themes` WHERE `active` = 1 LIMIT 1");
      safe_query("UPDATE `".PREFIX."settings_themes` SET active = 0 WHERE `themeID` = themeID");
    }
        
        safe_query(
            "INSERT INTO
                `" . PREFIX . "settings_themes` (
                    `name`,
                    `modulname`,
                    `version`,
                    `active`,
                    `sort`
                )
                VALUES (
                    '$name',
                    '$modulname',
                    '".$_POST[ 'version' ]."',
                    '" . $active . "',
                    '1'
                )"
        );

        safe_query(
            "INSERT INTO
                `" . PREFIX . "settings_buttons` (
                    `name`,
                    `modulname`,
                    `version`,
                    `active`
                )
                VALUES (
                    '$name',
                    '$modulname',
                    '".$_POST[ 'version' ]."',
                    '" . $active . "'
                )"
        );



        $id = mysqli_insert_id($_database);

        
    } else {
        echo  $_language->module[ 'transaction_invalid' ];
    }

} elseif (isset($_POST[ 'saveedit' ])) {
    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_POST[ 'captcha_hash' ])) {    	
        $name = $_POST[ 'name' ];
        
        if(@$_POST['radio1']=="active") {
        $active = 1;
        $deactivated = 0;
        } else {
        $active = 0;
        $deactive = 0;
        }

        if(@$_POST['radio2']=="express_active") {
        $express_active = 1;
        $deactivated = 0;
        } else {
        $express_active = 0;
        $deactive = 0;
        }
        
    if($active == '1') {
      $sql = safe_query("SELECT `themeID` FROM `".PREFIX."settings_themes` WHERE `active` = 1 LIMIT 1");
      safe_query("UPDATE `".PREFIX."settings_themes` SET active = 0 WHERE `themeID` = themeID");
    }

        $themeID = (int)$_POST[ 'themeID' ];
        $id = $themeID;


    $themeID = $_GET[ 'themeID' ];

    $ergebnis = safe_query("SELECT * FROM " . PREFIX . "settings_themes WHERE themeID='$themeID'");
    $dx = mysqli_fetch_array($ergebnis);
    $modulname = $dx[ 'modulname' ];

    if ($dx[ 'express_active' ] == '0') {
      
        safe_query(
            "UPDATE
                `" . PREFIX . "settings_themes`
            SET
                `name` = '" . $name . "',
                `active` = '" . $active . "',
                `express_active` = '" . $express_active . "',
                `modulname`='" . $_POST[ 'modulname' ] . "',
                `version`='" . $_POST[ 'version' ] . "',
                `body1`='" . $_POST[ 'body1' ] . "',
                `body2`='" . $_POST[ 'body2' ] . "',
                `body3`='" . $_POST[ 'body3' ] . "',
                `body4`='" . $_POST[ 'body4' ] . "',
                `typo1`='" . $_POST[ 'typo1' ] . "',
                `typo2`='" . $_POST[ 'typo2' ] . "',
                `typo3`='" . $_POST[ 'typo3' ] . "',
                `typo4`='" . $_POST[ 'typo4' ] . "',
                `typo5`='" . $_POST[ 'typo5' ] . "',
                `typo6`='" . $_POST[ 'typo6' ] . "',
                `typo7`='" . $_POST[ 'typo7' ] . "',
                `typo8`='" . $_POST[ 'typo8' ] . "',
                `card1`='" . $_POST[ 'card1' ] . "',
                `card2`='" . $_POST[ 'card2' ] . "',
                `foot1`='" . @$_POST[ 'foot1' ] . "',
                `foot2`='" . @$_POST[ 'foot2' ] . "',
                `foot3`='" . @$_POST[ 'foot3' ] . "',
                `foot4`='" . @$_POST[ 'foot4' ] . "',
                `foot5`='" . @$_POST[ 'foot5' ] . "',
                `foot6`='" . @$_POST[ 'foot6' ] . "',
                `nav1`='" . $_POST[ 'nav1' ] . "',
                `nav2`='" . $_POST[ 'nav2' ] . "',
                `nav3`='" . $_POST[ 'nav3' ] . "',
                `nav4`='" . $_POST[ 'nav4' ] . "',
                `nav5`='" . $_POST[ 'nav5' ] . "',
                `nav6`='" . $_POST[ 'nav6' ] . "',
                `nav7`='" . $_POST[ 'nav7' ] . "',
                `nav8`='" . $_POST[ 'nav8' ] . "',
                `nav9`='" . $_POST[ 'nav9' ] . "',
                `nav10`='" . $_POST[ 'nav10' ] . "',
                `calendar1`='" . @$_POST[ 'calendar1' ] . "',
                `calendar2`='" . @$_POST[ 'calendar2' ] . "',
                `carousel1`='" . @$_POST[ 'carousel1' ] . "',
                `carousel2`='" . @$_POST[ 'carousel2' ] . "',
                `carousel3`='" . @$_POST[ 'carousel3' ] . "',
                `carousel4`='" . @$_POST[ 'carousel4' ] . "',
                `logotext1`='" . $_POST[ 'logotext1' ] . "',
                `logotext2`='" . $_POST[ 'logotext2' ] . "',
                `reg1`='" . $_POST[ 'reg1' ] . "',
                `reg2`='" . $_POST[ 'reg2' ] . "'
                WHERE
                `themeID` = '" . $themeID . "'"
        );


$ergebnis = safe_query("SELECT * FROM " . PREFIX . "settings_buttons");
    $dy = mysqli_fetch_array($ergebnis);
safe_query(
            "UPDATE
                `" . PREFIX . "settings_buttons`
            SET
                `name` = '" . $name . "',
                `active` = '" . $active . "',
                `modulname`='" . $_POST[ 'modulname' ] . "',
                `version`='" . $_POST[ 'version' ] . "',
                button1='" . $_POST[ 'button1' ] . "',
                button2='" . $_POST[ 'button2' ] . "',
                button3='" . $_POST[ 'button3' ] . "',
                button4='" . $_POST[ 'button4' ] . "',
                button5='" . $_POST[ 'button5' ] . "',
                button6='" . $_POST[ 'button6' ] . "',
                button7='" . $_POST[ 'button7' ] . "',
                button8='" . $_POST[ 'button8' ] . "',
                button9='" . $_POST[ 'button9' ] . "',
                button10='" . $_POST[ 'button10' ] . "',
                button11='" . $_POST[ 'button11' ] . "',
                button12='" . $_POST[ 'button12' ] . "',
                button13='" . $_POST[ 'button13' ] . "',
                button14='" . $_POST[ 'button14' ] . "',
                button15='" . $_POST[ 'button15' ] . "',
                button16='" . $_POST[ 'button16' ] . "',
                button17='" . $_POST[ 'button17' ] . "',
                button18='" . $_POST[ 'button18' ] . "',
                button19='" . $_POST[ 'button19' ] . "',
                button20='" . $_POST[ 'button20' ] . "',
                button21='" . $_POST[ 'button21' ] . "',
                button22='" . $_POST[ 'button22' ] . "',
                button23='" . $_POST[ 'button23' ] . "',
                button24='" . $_POST[ 'button24' ] . "',
                button25='" . $_POST[ 'button25' ] . "',
                button26='" . $_POST[ 'button26' ] . "',
                button27='" . $_POST[ 'button27' ] . "',
                button28='" . $_POST[ 'button28' ] . "',
                button29='" . $_POST[ 'button29' ] . "',
                button30='" . $_POST[ 'button30' ] . "',
                button31='" . $_POST[ 'button31' ] . "',
                button32='" . $_POST[ 'button32' ] . "',
                button33='" . $_POST[ 'button33' ] . "',
                button34='" . $_POST[ 'button34' ] . "',
                button35='" . $_POST[ 'button35' ] . "',
                button36='" . $_POST[ 'button36' ] . "',
                button37='" . $_POST[ 'button37' ] . "',
                button38='" . $_POST[ 'button38' ] . "',
                button39='" . $_POST[ 'button39' ] . "',
                button40='" . $_POST[ 'button40' ] . "',
                button41='" . $_POST[ 'button41' ] . "',
                button42='" . $_POST[ 'button42' ] . "'
                WHERE
                `modulname` = '".getinput($dx['modulname'])."'"
        );

      
		$error = array();
        $sem = '/^#[a-fA-F0-9]{6}/';
        
        if (count($error)) {
            echo '<b>' . $_language->module[ 'errors' ] . ':</b><br /><ul>';

            foreach ($error as $err) {
                echo '<li>' . $err . '</li>';
            }
            echo '</ul>';
        } else {
            
            $file = ("../includes/themes/".$name."/css/stylesheet.css");
            $fp = fopen($file, "w");
            fwrite($fp, stripslashes(str_replace('\r\n', "\n", $_POST[ 'stylesheet' ])));
            fclose($fp);
            #redirect("admincenter.php?site=settings_templates", "", 0);
        }




		$filepath = "../includes/themes/".$name."/images/";

        //TODO: should be loaded from root language folder
        $_language->readModule('formvalidation', true, true);

        $upload = new \webspell\HttpUpload('logo');

        if ($upload->hasFile()) {
            if ($upload->hasError() === false) {
                $mime_types = array('image/jpeg','image/png','image/gif');
                if ($upload->supportedMimeType($mime_types)) {
                    $imageInformation =  getimagesize($upload->getTempFile());

                    if (is_array($imageInformation)) {
                        if ($imageInformation[0] < 1001 && $imageInformation[1] < 501) {
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
                                    "UPDATE " . PREFIX . "settings_themes
                                    SET logo='" . $file . "' WHERE themeID='" . $id . "'"
                                );
                            }
                        } else {
                            echo generateErrorBox(sprintf($_language->module[ 'image_too_big' ], 1000, 500));
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



        $upload = new \webspell\HttpUpload('reg_pic');

        if ($upload->hasFile()) {
            if ($upload->hasError() === false) {
                $mime_types = array('image/jpeg','image/png','image/gif');
                if ($upload->supportedMimeType($mime_types)) {
                    $imageInformation =  getimagesize($upload->getTempFile());

                    if (is_array($imageInformation)) {
                        if ($imageInformation[0] < 1921 && $imageInformation[1] < 1201) {
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
                            $file = "login_bg".$endung;

                            if (file_exists($filepath . $name . '.gif')) {
                                unlink($filepath . $name . '.gif');
                            }
                            if (file_exists($filepath . $name . '.jpg')) {
                                unlink($filepath . $name . '.jpg');
                            }
                            if (file_exists($filepath . $name . '.png')) {
                                unlink($filepath . $name . '.png');
                            }

                            if ($upload->saveAs($filepath.$file)) {
                                @chmod($filepath.$file, $new_chmod);
                                safe_query(
                                    "UPDATE " . PREFIX . "settings_themes
                                    SET reg_pic='" . $file . "' WHERE themeID='" . $id . "'"
                                );
                            }
                        } else {
                            echo generateErrorBox(sprintf($_language->module[ 'image_too_big' ], 1920, 1200));
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
     safe_query(
            "UPDATE
                `" . PREFIX . "settings_themes`
            SET
                `name` = '" . $name . "',
                `active` = '" . $active . "',
                `express_active` = '" . $express_active . "',
                `modulname`='" . $_POST[ 'modulname' ] . "',
                `version`='" . $_POST[ 'version' ] . "',
                `nav3`='" . $_POST[ 'gen1' ] . "',
                `nav4`='" . $_POST[ 'gen2' ] . "',
                `nav5`='" . $_POST[ 'gen1' ] . "',
                `nav8`='" . $_POST[ 'gen3' ] . "',
                `nav10`='" . $_POST[ 'gen1' ] . "',
                
                `typo4`='" . $_POST[ 'gen1' ] . "',
                
                `typo8`='" . $_POST[ 'gen3' ] . "',
                
                `carousel2`='" . $_POST[ 'gen1' ] . "',
                `carousel4`='" . $_POST[ 'gen1' ] . "',
                `foot4`='" . $_POST[ 'gen1' ] . "',
                `reg1`='" . $_POST[ 'gen4' ] . "'
                
                WHERE
                `themeID` = '" . $themeID . "'"
        );
    safe_query(
            "UPDATE
                `" . PREFIX . "settings_buttons`
            SET
                button1='" . $_POST[ 'gen1' ] . "',
                button2='" . $_POST[ 'gen3' ] . "'
                WHERE
                `modulname` = '".getinput($dx['modulname'])."'"
        );
      
}

} else {
        echo $_language->module[ 'transaction_invalid' ];
    }

}

/*------------Logo END ----------------*/

if ($action == "add") {
    $CAPCLASS = new \webspell\Captcha;
    $CAPCLASS->createTransaction();
    $hash = $CAPCLASS->getHash();


    
  
echo'<div class="card">
        <div class="card-header">
            <i class="fas fa-puzzle-piece"></i> '.$_language->module['template'].'
        </div>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="admincenter.php?site=settings_templates">'.$_language->module['template'].'</a></li>
    <li class="breadcrumb-item active" aria-current="page">'.$_language->module['new_template'].'</li>
  </ol>
</nav>
<div class="card-body">';

echo'<form class="form-horizontal" method="post" action="admincenter.php?site=settings_templates" enctype="multipart/form-data">

     <div class="row">

<div class="col-md-12">

    <div class="form-group">
    <label class="col-md-2 control-label">'.$_language->module['template_name'].':</label>
    <div class="col-md-8"><span class="text-muted small"><em>
      <input type="text" class="form-control" name="name" size="60" /><small class="fontLight">'.$_language->module['template_name_info'].'</small></em></span>
    </div>
  </div>

  <div class="form-group">
    <label class="col-md-2 control-label">'.$_language->module['modulname'].':</label>
    <div class="col-md-8"><span class="text-muted small"><em>
      <input type="text" class="form-control" name="modulname" size="60" /><small class="fontLight">'.$_language->module['modulname_info'].'</small></em></span>
    </div>
  </div>

  <div class="form-group">
    <label class="col-md-2 control-label">'.$_language->module['version'].':</label>
    <div class="col-md-8"><span class="text-muted small"><em>
      <input type="text" class="form-control" name="version" size="60" /></em></span>
    </div>
  </div>
  
<div class="form-group">
    <label class="col-md-2 control-label" for="active_on">'.$_language->module['active_on'].':</label>
    <div class="col-md-8">
  <input id="active" type="radio" name="radio1" value="active">
</div>
</div>

<div class="form-group">
    <div class="col-md-offset-2 col-md-10">
    <input type="hidden" name="captcha_hash" value="'.$hash.'" />
    <button class="btn btn-success" type="submit" name="save"  />'.$_language->module['add_template'].'</button>
    <br><br>
    </div>
  </div>

</div>
  </div>

  </form></div>
  </div>';
} elseif ($action == "edit") {
    $CAPCLASS = new \webspell\Captcha;
    $CAPCLASS->createTransaction();
    $hash = $CAPCLASS->getHash();

    
  


$themeID = $_GET[ 'themeID' ];
    $ergebnis = safe_query("SELECT * FROM " . PREFIX . "settings_themes WHERE themeID='$themeID'");
    $ds = mysqli_fetch_array($ergebnis);

    if ($ds[ 'active' ] == '1') {
        $active = '<input id="activeactive" type="radio" name="radio1" value="active" checked="checked" />';
    } else {
        $active = '<input id="active" type="radio" name="radio1" value="active">';
    }

    if ($ds[ 'express_active' ] == '1') {
        $express_active = '<input id="activeactive" type="radio" name="radio2" value="express_active" checked="checked" />';
    } else {
        $express_active = '<input id="active" type="radio" name="radio2" value="express_active">';
    }

echo'<div class="card">
        <div class="card-header">
            <i class="fas fa-puzzle-piece"></i> '.$_language->module['template'].'
        </div>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="admincenter.php?site=settings_templates">'.$_language->module['template'].'</a></li>
    <li class="breadcrumb-item active" aria-current="page">'.getinput($ds['modulname']).'-'.$_language->module['edit_template'].'</li>
  </ol>
</nav>
<div class="card-body">';   

echo'<form class="form-horizontal" method="post" action="admincenter.php?site=settings_templates&action=edit&themeID='.$themeID.'" enctype="multipart/form-data">
<div class="row">
<div class="col-md-12">

  <div class="form-group">
    <label class="col-md-2 control-label">'.$_language->module['template_name'].':</label>
    <div class="col-md-8"><span class="text-muted small"><em>
      <input type="text" class="form-control" name="name" value="'.getinput($ds['name']).'" /><small class="fontLight">'.$_language->module['template_name_info'].'</small></em></span>
    </div>
  </div>




  <div class="form-group">
    <label class="col-md-2 control-label">'.$_language->module['modulname'].':</label>
    <div class="col-md-8"><span class="text-muted small"><em>
      <input type="text" class="form-control" name="modulname" value="'.getinput($ds['modulname']).'" /><small class="fontLight">'.$_language->module['modulname_info'].'</small></em></span>
    </div>
  </div>

  <div class="form-group">
    <label class="col-md-2 control-label">'.$_language->module['version'].':</label>
    <div class="col-md-8"><span class="text-muted small"><em>
      <input type="text" class="form-control" name="version" value="'.getinput($ds['version']).'" /></em></span>
    </div>
  </div>


  <div class="form-group">
    <label class="col-md-2 control-label" for="active_on">'.$_language->module['active_on'].':</label>
    <div class="col-md-8">
  '.$active.'
</div>
</div>

<div class="form-group">
    <label class="col-md-2 control-label" for="express_active_on">'.$_language->module['express_setting'].':</label>
    <div class="col-md-8">
  '.$express_active.'
</div>
</div>


<br>
 <hr>
</div>

 <div class="col-md-12">


  <!-- ====================================================== -->
<div class="card">
  <div class="card-header">
            '.$_language->module['template_design'].'
        </div>

        <span class="text-muted small"><em><small class="fontLight">&nbsp;'.$_language->module['template_design_info'].'</small></em></span>
</div>


 ';
  
if ($ds[ 'express_active' ] == '1') {
        $express_active = '





<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true"> <!-- accordion start -->

     <!-- ================general============================ -->
  
  
  <div class="panel"> <!-- Panel 7 Start -->
   
    <h4 class="mb-0">
     <button style="width: 100%" class="btn btn-secondary text-left" type="button" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseone" aria-expanded="true" aria-controls="collapseSeven">
      <i class="fas fa-tasks"></i> Express Settings
     </button>
    </h4>
   
    <div class="card-body">
     
     <div class="row"> <!-- row start -->

    <div class="card">
      
<div class="card-body"> 
     
       <h4>Express Settings</h4>
<div class="row">
<div class="col-md-6">
<div class="form-group row">
    <label class="col-md-4 control-label">primary-bg color:</label>
    <div id="cp12" class="input-group colorpicker-component col-md-7">
    <input type="text" value="' . $ds[ 'typo4' ] . '" class="form-control" name="gen1" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>
  
<div class="form-group row">
    <label class="col-md-4 control-label">primary-bg text color:</label>
    <div id="cp14" class="input-group colorpicker-component col-md-7">
    <input type="text" value="' . $ds[ 'nav4' ] . '" class="form-control" name="gen2" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>
  </div>

  <div class="col-md-6">
<div class="form-group row">
    <label class="col-md-4 control-label">primary-bg color hover:</label>
    <div id="cp13" class="input-group colorpicker-component col-md-7">
    <input type="text" value="' . $ds[ 'typo8' ] . '" class="form-control" name="gen3" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>
  
<div class="form-group row">
    <label class="col-md-4 control-label">primary-bg Login Pic:</label><small>rgba verwenden</small>
    <div id="cp73" class="input-group colorpicker-component col-md-7">
    <input type="text" value="' . $ds[ 'reg1' ] . '" class="form-control" name="gen4" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>
  </div>
  </div>
</div></div>
</div>

     </div> <!-- row end -->
    </div> <!-- card body end -->
   </div> <!-- collapse end -->
  </div> <!-- Panel 7 End -->
  
<!-- ================general===END========================== -->


</div> <!-- accordion end -->



';
    } else {
        $express_active = '

 ';$file = ("../includes/themes/".$ds['name']."/css/stylesheet.css");
    $size = filesize($file);
    $fp = fopen($file, "r");
    $stylesheet = fread($fp, $size);
    fclose($fp);

    


$filepath = "../includes/themes/".$ds['name']."/images/";
if (!empty($ds[ 'logo' ])) {
        $pic1 = '<img id="img-upload" class="" style="width: 100%; max-width: 150px" src="../' . $filepath . $ds[ 'logo' ] . '" alt="">';
    } else {
        $pic1 = '<img id="img-upload" class="" style="width: 100%; max-width: 150px" src="../' . $filepath . 'no-image.jpg" alt="">';
    }
if (!empty($ds[ 'reg_pic' ])) {
        $pic2 = '<img id="img-upload" class="" style="width: 100%; max-width: 150px" src="../' . $filepath . $ds[ 'reg_pic' ] . '" alt="">';
    } else {
        $pic2 = '<img id="img-upload" class="" style="width: 100%; max-width: 150px" src="../' . $filepath . 'no-image.jpg" alt="">';
    }
  

echo'
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true"> <!-- accordion start -->
  
  <div class="panel"> <!-- panel 1 start -->
   <div class="card-he1ader" role="tab" id="headingOne">
    
     <button style="width: 100%" class="btn btn-secondary text-left" type="button" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
      <i class="fas fa-bars"></i> Navigation
     </button>
    
   </div>
   
   <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne"> <!-- content 1 start -->
    <div class="card-body">
     
     <div class="row"> <!-- row start -->

    
    <!-- ================navi============================= -->

  <div class="card">
        
<div class="card-body">
<h4>navigation Settings</h4>
    <div class="row"> 
<div class="col-md-6">


<div class="form-group row">
    <label class="col-md-4 control-label">Background:</label>
    <div id="cp1" class="input-group colorpicker-component col-md-7">
    <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-4 control-label">Font-size:</label>
    <div class="input-group col-md-7">
   <input class="form-control" type="text" name="nav2" value="' . $ds[ 'nav2' ] . '" />
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-4 control-label">border-top-size:</label>
    <div class="input-group col-md-7">
   <input class="form-control" type="text" name="nav6" value="' . $ds[ 'nav6' ] . '" />
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-4 control-label">border-top color:</label>
    <div id="cp2" class="input-group colorpicker-component col-md-7">
    <input type="text" value="' . $ds[ 'nav5' ] . '" class="form-control" name="nav5" /><span class="input-group-addon"><i></i></span> 
      </div>
  </div>

</div>
  <div class="col-md-6">

  <div class="form-group row">
    <label class="col-md-4 control-label">Main a:</label>
    <div id="cp3" class="input-group colorpicker-component col-md-7">
    <input type="text" value="' . $ds[ 'nav7' ] . '" class="form-control" name="nav7" /><span class="input-group-addon"><i></i></span> 
      </div>
  </div>
  <div class="form-group row">
    <label class="col-md-4 control-label">Main a:hover:</label>
    <div id="cp4" class="input-group colorpicker-component col-md-7">
    <input type="text" value="' . $ds[ 'nav8' ] . '" class="form-control" name="nav8" /><span class="input-group-addon"><i></i></span> 
      </div>
  </div>

  <div class="form-group row">
    <label class="col-md-4 control-label">Main bg a:hover:</label>
    <div id="cp69" class="input-group colorpicker-component col-md-7">
    <input type="text" value="' . $ds[ 'nav9' ] . '" class="form-control" name="nav9" /><span class="input-group-addon"><i></i></span> 
      </div>
  </div>

  
  
 </div>


</div>

<hr>


<h4>Dropdown Navigation Settings</h4>


<div class="row">


       
       <div class="col-md-6">
       <div class="form-group row">
    <label class="col-md-4 control-label">Sub a:</label>
    <div id="cp5" class="input-group colorpicker-component col-md-7">
    <input type="text" value="' . $ds[ 'nav3' ] . '" class="form-control" name="nav3" /><span class="input-group-addon"><i></i></span> 
      </div>
  </div>

  <div class="form-group row">
    <label class="col-md-4 control-label">Sub a:hover:</label>
    <div id="cp6" class="input-group colorpicker-component col-md-7">
    <input type="text" value="' . $ds[ 'nav4' ] . '" class="form-control" name="nav4" /><span class="input-group-addon"><i></i></span> 
      </div>
  </div>

   <div class="form-group row">
    <label class="col-md-4 control-label">Sub bg a:hover:</label>
    <div id="cp70" class="input-group colorpicker-component col-md-7">
    <input type="text" value="' . $ds[ 'nav10' ] . '" class="form-control" name="nav10" /><span class="input-group-addon"><i></i></span> 
      </div>
  </div>
        </div>
        



</div>
  </div>
</div>
  

<!-- ================navi===END========================== -->

  
    </div>  <!-- row end -->
     
     
     
    </div> <!-- card-body end -->
  </div> <!-- content 2 end -->
  </div> <!-- panel 2 end -->






<div class="panel"> <!-- Panel logo Start -->
   <div class="card-he1ader" role="tab" id="headingTwo">
    <h4 class="mb-0">
     <button style="width: 100%" class="btn btn-secondary text-left" type="button" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapselogo" aria-expanded="true" aria-controls="collapselogo">
      <i class="far fa-image"></i> Logo / Login
     </button>
    </h4>
   </div>
   
   <div id="collapselogo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
    <div class="card-body">
     
     <div class="row"> <!-- row start -->
     
     <!-- ================Logo==Login=========================== -->


     <div class="card">
       
<div class="card-body">


<h4>Navigation</h4>
<div class="row"> 
<div class="col-md-6">

<div class="form-group">
    <label class="col-md-3 control-label">'.$_language->module['current_banner'].':</label>
    <div class="col-md-2 table-secondary" style="margin: 5px">
      '.$pic1.'
    </div>
    </div>
<div class="form-group">
    <label class="col-md-3 control-label">'.$_language->module['banner'].':</label>
    <div class="col-md-9"><span class="text-muted small"><em>
      <input class="btn btn-info" name="logo" type="file" size="40" /> <small>(max. 1000x500)</small></em></span>
    </div>
  </div>

  </div>
  <div class="col-md-6">
<div class="form-group row" style="height:40px">
    </div>
  <div class="form-group row">
    <label class="col-md-4 control-label">Logo Text:</label>
    <div class="input-group col-md-7">
   <input class="form-control" type="text" name="logotext1" value="' . $ds[ 'logotext1' ] . '" />
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-4 control-label">Logo Text:</label>
    <div class="input-group col-md-7">
   <input class="form-control" type="text" name="logotext2" value="' . $ds[ 'logotext2' ] . '" />
    </div>
  </div>

   </div>
    </div>
<hr>
<h4>Login</h4>
    <div class="row"> 
<div class="col-md-6">

<div class="form-group">
    <label class="col-md-3 control-label">'.$_language->module['current_banner'].':</label>
    <div class="col-md-2 table-secondary" style="margin: 5px">
      '.$pic2.'
    </div>
    </div>
<div class="form-group">
    <label class="col-md-3 control-label">'.$_language->module['banner'].':</label>
    <div class="col-md-9"><span class="text-muted small"><em>
      <input class="btn btn-info" name="reg_pic" type="file" size="40" /> <small>(max. 1920x1020)</small></em></span>
    </div>
  </div>

  </div>
  <div class="col-md-6">
<div class="form-group row" style="height:40px">
    </div>
  <div class="form-group row">
    <label class="col-md-4 control-label">Image Color:</label><small>rgba verwenden</small>
    <div id="cp73" class="input-group colorpicker-component col-md-7">
    <input type="text" value="' . $ds[ 'reg1' ] . '" class="form-control" name="reg1" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>

  <div class="form-group row">
    <label class="col-md-4 control-label">Text Color:</label>
    <div id="cp74" class="input-group colorpicker-component col-md-7">
    <input type="text" value="' . $ds[ 'reg2' ] . '" class="form-control" name="reg2" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>

   </div>
    </div>
     </div>
      </div>
  

<!-- ================logo==login==END========================== -->

  
    </div>  <!-- row end -->
     
     
     
    </div> <!-- card-body end -->
  </div> <!-- content 2 end -->
  </div> <!-- panel 2 end -->

<!-- =========================================================================================================================================== -->

 <div class="panel"> <!-- Panel 3 Start -->
   <div class="card-he1ader" role="tab" id="headingThree">
    <h4 class="mb-0">
     <button style="width: 100%" class="btn btn-secondary text-left" type="button" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
      <i class="fas fa-globe"></i> Body
     </button>
    </h4>
   </div>
   
   <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
    <div class="card-body">
     
     <div class="row"> <!-- row start -->
     
     <!-- ================body============================= -->




<div class="card">
       
<div class="card-body">

<h4>Body Settings</h4>
<div class="col-md-12">
 <div class="row">
 
    <div class="col-md-4" style="background: '.$ds['typo1'].'; height: 280px;">
     (Well Background Color)
        <h1 style="color: '.$ds['typo2'].';">h1. Heading 1</h1>
        <h2 style="color: '.$ds['typo2'].';">h2. Heading 2</h2>
        <h3 style="color: '.$ds['typo2'].';">h3. Heading 3</h3>
        <h4 style="color: '.$ds['typo2'].';">h4. Heading 4</h4>
        <h5 style="color: '.$ds['typo2'].';">h5. Heading 5</h5>
        <h6 style="color: '.$ds['typo3'].';">h6. Heading 6</h6>
    </div>
    
    
    <div class="col-md-4" style="background: '.$ds['body3'].'; height: 280px;">
    (Background Color)
      <h3 style="color: '.$ds['typo2'].';">Example body text</h3>
      <p style="font-size: '.$ds['body2'].'; color: '.$ds['body4'].';">Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
      <p style="font-size: '.$ds['body2'].'; color: '.$ds['body4'].';">Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Donec sed odio dui.</p>
    </div>
  
    <div class="col-md-4" style="background: '.$ds['body3'].'; height: 280px;">
       <h3 style="color: '.$ds['typo2'].';">Example addresses</h3>
      <address  style="font-size: '.$ds['body2'].'; color: '.$ds['body4'].';">
        <strong>Twitter, Inc.</strong><br>
        795 Folsom Ave, Suite 600<br>
        San Francisco, CA 94107<br>
        <abbr title="Phone">P:</abbr> (123) 456-7890
      </address>
      <address style="font-size: '.$ds['body2'].'; color: '.$ds['body4'].';">
        <strong>Full Name</strong><br>
        <a style="color: '.$ds['typo4'].'; visited: color:'.$ds['typo8'].';" href="mailto:#">first.last@gmail.com</a>
      </address>

      <hr style="border-top: '.$ds['typo6'].' solid '.$ds['typo7'].'">
    </div>

  </div>
<br>
</div>
<hr>



<div class="row">
<div class="col-md-12">
<div class="col-md-6">

   <div class="form-group row">
    <label class="col-md-4 control-label">Font-family:</label>
    <div class="input-group col-md-7">
   <textarea class="form-control" type="text" name="body1" value="' . $ds[ 'body1' ] . '" rows="3"/>' . $ds[ 'body1' ] . '</textarea>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-md-4 control-label">Font-size:</label>
    <div class="input-group col-md-7">
   <input class="form-control" type="text" name="body2" value="' . $ds[ 'body2' ] . '" />
    </div>
  </div>

  </div>
  <div class="col-md-6">

  <div class="form-group row">
    <label class="col-md-4 control-label">Background:</label>
    <div id="cp7" class="input-group colorpicker-component col-md-7">
    <input type="text" value="' . $ds[ 'body3' ] . '" class="form-control" name="body3" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>

  <div class="form-group row">
    <label class="col-md-4 control-label">Color:</label>
    <div id="cp8" class="input-group colorpicker-component col-md-7">
    <input type="text" value="' . $ds[ 'body4' ] . '" class="form-control" name="body4" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>

</div>


</div>


<div class="col-md-12">


<div class="col-md-6">
<div class="form-group row">
    <label class="col-md-4 control-label">Well bg-color:</label>
    <div id="cp9" class="input-group colorpicker-component col-md-7">
    <input type="text" value="' . $ds[ 'typo1' ] . '" class="form-control" name="typo1" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>


  
    <div class="form-group row">
    <label class="col-md-4 control-label">H color:</label>
    <div id="cp10" class="input-group colorpicker-component col-md-7">
    <input type="text" value="' . $ds[ 'typo2' ] . '" class="form-control" name="typo2" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>


<div class="form-group row">
    <label class="col-md-4 control-label">H6 color:</label>
    <div id="cp11" class="input-group colorpicker-component col-md-7">
    <input type="text" value="' . $ds[ 'typo3' ] . '" class="form-control" name="typo3" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>


  
  <div class="form-group row">
    <label class="col-md-4 control-label">frei typo5:</label>
    <div class="input-group col-md-7">
   <input class="form-control" type="text" name="typo5" value="' . $ds[ 'typo5' ] . '" />
    </div>
  </div>


</div>
<div class="col-md-6">


<div class="form-group row">
    <label class="col-md-4 control-label">a color:</label>
    <div id="cp12" class="input-group colorpicker-component col-md-7">
    <input type="text" value="' . $ds[ 'typo4' ] . '" class="form-control" name="typo4" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>


  
<div class="form-group row">
    <label class="col-md-4 control-label">a hover:</label>
    <div id="cp13" class="input-group colorpicker-component col-md-7">
    <input type="text" value="' . $ds[ 'typo8' ] . '" class="form-control" name="typo8" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>


  
    <div class="form-group row">
    <label class="col-md-4 control-label">hr color:</label>
    <div id="cp14" class="input-group colorpicker-component col-md-7">
    <input type="text" value="' . $ds[ 'typo6' ] . '" class="form-control" name="typo6" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>


<div class="form-group row">
    <label class="col-md-4 control-label">hr border:</label>
    <div class="input-group col-md-7">
   <input class="form-control" type="text" name="typo7" value="' . $ds[ 'typo7' ] . '" />
    </div>
  </div>

</div>
</div>



</div>
<hr>
<div class="row">
<div class="col-md-6">
<h4>Card Settings</h4>
<div class="form-group row">
    <label class="col-md-4 control-label">card bg:</label>
    <div id="cp71" class="input-group colorpicker-component col-md-7">
    <input type="text" value="' . $ds[ 'card1' ] . '" class="form-control" name="card1" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>


  
<div class="form-group row">
    <label class="col-md-4 control-label">card border color:</label>
    <div id="cp72" class="input-group colorpicker-component col-md-7">
    <input type="text" value="' . $ds[ 'card2' ] . '" class="form-control" name="card2" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>
  </div>

  <div class="col-md-6">

  <div class="card" style="border-color: ' . $ds[ 'card2' ] . '">
  <div class="card-body" style="background: '.$ds['card1'].';border:1px solid ' . $ds[ 'card2' ] . '">
    <p style="font-size: '.$ds['body2'].'; color: '.$ds['body4'].';">This is some text within a card body.</p>
  </div>
</div>




  </div>
</div>

</div>

<!-- ================body===END========================== -->
     
     
     </div> <!-- row end -->
    </div> <!-- card body end -->
   </div> <!-- collapse 3 end -->
  </div> <!-- Panel 3 End -->


<!-- =========================================================================================================================================== -->





<div class="panel"> <!-- Panel 4 Start -->
   <div class="card-he1ader" role="tab" id="headingFour ">
    <h4 class="mb-0">
     <button style="width: 100%" class="btn btn-secondary text-left" type="button" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="true" aria-controls="collapseFive">
      <i class="fas fa-square"></i> Buttons
     </button>
    </h4>
   </div>
   
   <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
    <div class="card-body">
     
     <div class="row"> <!-- row start -->
     
      <!-- ================Button=========================== -->
      ';

    $ergebnis = safe_query("SELECT * FROM " . PREFIX . "settings_buttons WHERE modulname='".getinput($ds['modulname'])."'");
    $db = mysqli_fetch_array($ergebnis);
echo'
<div class="card">
        
            <div class="card-body">
            <div class="row">


<div class="col-md-12">

<div class="col-md-1 p-3 mb-2 bg-secondary text-white" align="center"><b>Button:</b></div>
<div class="col-md-2 p-3 mb-2 bg-secondary text-white" align="center"><b>background-color:</b></div>
<div class="col-md-2 p-3 mb-2 bg-secondary text-white" align="center"><b>hover background-color:</b></div>
<div class="col-md-2 p-3 mb-2 bg-secondary text-white" align="center"><b>font color:</b></div>
<div class="col-md-2 p-3 mb-2 bg-secondary text-white" align="center"><b>border color:</b></div>
<div class="col-md-2 p-3 mb-2 bg-secondary text-white" align="center"><b>hover border color:</b></div>
<div class="col-md-1 p-3 mb-2 bg-secondary text-white" align="center"><b>&nbsp;</b></div>
<div class="col-md-12 p-2" align="center"><b>&nbsp;</b></div>






<div class="col-md-1">
<div class="form-group">
<label class="control-label">
<button class="btn btn-primary custom" />Primary</button></label>

</div>
</div>


<div class="col-md-2">
  <div class="form-group">
    <label class="col-md-12">#007bff</label>
    <div id="cp18" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button1' ] . '" class="form-control" name="button1" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>
  </div>
  <div class="col-md-2">
  <div class="form-group">
  <label class="col-md-12">#0069d9</label>
    <div id="cp19" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button2' ] . '" class="form-control" name="button2" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>

  </div>
  <div class="col-md-2">
 <div class="form-group">
 <label class="col-md-12">#ffffff</label>
     <div id="cp20" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button3' ] . '" class="form-control" name="button3" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>
</div>

<div class="col-md-2">
 <div class="form-group">
 <label class="col-md-12">#007bff</label>
     <div id="cp21" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button4' ] . '" class="form-control" name="button4" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>
</div>


<div class="col-md-2">
 <div class="form-group">
 <label class="col-md-12">#0062cc</label>
     <div id="cp22" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button5' ] . '" class="form-control" name="button5" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>
</div>

<div class="col-md-12">
<div class="form-group row">
<label class="col-md-1">Code:</label>
<div class="col-md-10">
<pre><code class="language-html">&lt;button type=&quot;button&quot; class=&quot;btn btn-primary&quot;&gt;Primary&lt;/button&gt;</code></pre>
</div>
</div>
<hr>
</div>


<div class="col-md-1">
<div class="form-group">
<label class="control-label">
<button class="btn btn-secondary custom" />Secondary</button></label>

</div>
</div>


<div class="col-md-2">

<div class="form-group">
    <label class="col-md-12">#6c757d</label>
    <div id="cp23" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button6' ] . '" class="form-control" name="button6" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>
  </div>
  <div class="col-md-2">

  <div class="form-group">
  <label class="col-md-12">#5a6268</label>
    <div id="cp24" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button7' ] . '" class="form-control" name="button7" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>

  </div>
  <div class="col-md-2">
 <div class="form-group">
 <label class="col-md-12">#ffffff</label>
     <div id="cp25" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button8' ] . '" class="form-control" name="button8" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>
</div>

<div class="col-md-2">
 <div class="form-group">
 <label class="col-md-12">#6c757d</label>
     <div id="cp26" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button9' ] . '" class="form-control" name="button9" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>
</div>

<div class="col-md-2">
 <div class="form-group">
 <label class="col-md-12">#545b62</label>
     <div id="cp27" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button10' ] . '" class="form-control" name="button10" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>
</div>

<div class="col-md-12">
<div class="form-group row">
<label class="col-md-1">Code:</label>
<div class="col-md-10">
<pre><code class="language-html">&lt;button type=&quot;button&quot; class=&quot;btn btn-secondary&quot;&gt;Secondary&lt;/button&gt;</code></pre>
</div>
</div>
<hr>
</div>


<div class="col-md-1">
<div class="form-group">
<label class="control-label">
<button class="btn btn-success custom" />Success</button></label>

</div>
</div>

<div class="col-md-2">

<div class="form-group">
    <label class="col-md-12">#28a745</label>
    <div id="cp28" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button11' ] . '" class="form-control" name="button11" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>
  </div>
  <div class="col-md-2">

  <div class="form-group">
  <label class="col-md-12">#218838</label>
    <div id="cp29" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button12' ] . '" class="form-control" name="button12" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>

  </div>
  <div class="col-md-2">
 <div class="form-group">
 <label class="col-md-12">#ffffff</label>
     <div id="cp30" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button13' ] . '" class="form-control" name="button13" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>
</div>

<div class="col-md-2">
 <div class="form-group">
 <label class="col-md-12">#28a745</label>
     <div id="cp31" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button14' ] . '" class="form-control" name="button14" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>
</div>

<div class="col-md-2">
 <div class="form-group">
 <label class="col-md-12">#1e7e34</label>
     <div id="cp32" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button15' ] . '" class="form-control" name="button15" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>
</div>

<div class="col-md-12">
<div class="form-group row">
<label class="col-md-1">Code:</label>
<div class="col-md-10">
<pre><code class="language-html">&lt;button type=&quot;button&quot; class=&quot;btn btn-success&quot;&gt;Success&lt;/button&gt;</code></pre>
</div>
</div>
<hr>
</div>


<div class="col-md-1">
<div class="form-group">
<label class="control-label">
<button class="btn btn-danger custom" />Danger</button></label>

</div>
</div>

<div class="col-md-2">

<div class="form-group">
    <label class="col-md-12">#dc3545</label>
    <div id="cp33" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button16' ] . '" class="form-control" name="button16" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>
  </div>
  <div class="col-md-2">

  <div class="form-group">
  <label class="col-md-12">#c82333</label>
    <div id="cp34" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button17' ] . '" class="form-control" name="button17" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>

  </div>
  <div class="col-md-2">
 <div class="form-group">
 <label class="col-md-12">#ffffff</label>
     <div id="cp35" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button18' ] . '" class="form-control" name="button18" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>
</div>

<div class="col-md-2">
 <div class="form-group">
 <label class="col-md-12">#dc3545</label>
     <div id="cp36" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button19' ] . '" class="form-control" name="button19" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>
</div>

<div class="col-md-2">
 <div class="form-group">
 <label class="col-md-12">#bd2130</label>
     <div id="cp37" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button20' ] . '" class="form-control" name="button20" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>
</div>

<div class="col-md-12">
<div class="form-group row">
<label class="col-md-1">Code:</label>
<div class="col-md-10">
<pre><code class="language-html">&lt;button type=&quot;button&quot; class=&quot;btn btn-danger&quot;&gt;Danger&lt;/button&gt;</code></pre>
</div>
</div>
<hr>
</div>


<div class="col-md-1">
<div class="form-group">
<label class="control-label">
<button class="btn btn-warning custom" />Warning</button></label>

</div>
</div>

<div class="col-md-2">

<div class="form-group">
    <label class="col-md-12">#ffc107</label>
    <div id="cp38" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button21' ] . '" class="form-control" name="button21" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>
  </div>
  <div class="col-md-2">

  <div class="form-group">
  <label class="col-md-12">#e0a800</label>
    <div id="cp39" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button22' ] . '" class="form-control" name="button22" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>

  </div>
  <div class="col-md-2">
 <div class="form-group">
 <label class="col-md-12">#212529</label>
     <div id="cp40" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button23' ] . '" class="form-control" name="button23" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>
</div>

<div class="col-md-2">
 <div class="form-group">
 <label class="col-md-12">#ffc107</label>
     <div id="cp41" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button24' ] . '" class="form-control" name="button24" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>
</div>

<div class="col-md-2">
 <div class="form-group">
 <label class="col-md-12">#d39e00</label>
     <div id="cp42" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button25' ] . '" class="form-control" name="button25" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>
</div>

<div class="col-md-12">
<div class="form-group row">
<label class="col-md-1">Code:</label>
<div class="col-md-10">
<pre><code class="language-html">&lt;button type=&quot;button&quot; class=&quot;btn btn-warning&quot;&gt;Warning&lt;/button&gt;</code></pre>
</div>
</div>
<hr>
</div>


<div class="col-md-1">
<div class="form-group">
<label class="control-label">
<button class="btn btn-info custom" />Info</button></label>

</div>
</div>


<div class="col-md-2">

<div class="form-group">
    <label class="col-md-12">#17a2b8</label>
    <div id="cp43" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button26' ] . '" class="form-control" name="button26" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>
  </div>
  <div class="col-md-2">

  <div class="form-group">
  <label class="col-md-12">#138496</label>
    <div id="cp44" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button27' ] . '" class="form-control" name="button27" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>

  </div>
  <div class="col-md-2">
 <div class="form-group">
 <label class="col-md-12">#ffffff</label>
     <div id="cp45" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button28' ] . '" class="form-control" name="button28" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>
</div>

<div class="col-md-2">
 <div class="form-group">
 <label class="col-md-12">#17a2b8</label>
     <div id="cp46" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button29' ] . '" class="form-control" name="button29" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>
</div>

<div class="col-md-2">
 <div class="form-group">
 <label class="col-md-12">#117a8b</label>
     <div id="cp47" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button30' ] . '" class="form-control" name="button30" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>
</div>

<div class="col-md-12">
<div class="form-group row">
<label class="col-md-1">Code:</label>
<div class="col-md-10">
<pre><code class="language-html">&lt;button type=&quot;button&quot; class=&quot;btn btn-info&quot;&gt;Info&lt;/button&gt;</code></pre>
</div>
</div>
<hr>
</div>


<div class="col-md-1">
<div class="form-group">
<label class="control-label">
<button class="btn btn-light custom" />Light</button></label>

</div>
</div>


<div class="col-md-2">

<div class="form-group">
    <label class="col-md-12">#f8f9fa</label>
    <div id="cp48" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button31' ] . '" class="form-control" name="button31" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>
  </div>
  <div class="col-md-2">

  <div class="form-group">
  <label class="col-md-12">#e2e6ea</label>
    <div id="cp49" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button32' ] . '" class="form-control" name="button32" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>

  </div>
  <div class="col-md-2">
 <div class="form-group">
 <label class="col-md-12">#212529</label>
     <div id="cp50" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button33' ] . '" class="form-control" name="button33" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>
</div>

<div class="col-md-2">
 <div class="form-group">
 <label class="col-md-12">#f8f9fa</label>
     <div id="cp51" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button34' ] . '" class="form-control" name="button34" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>
</div>

<div class="col-md-2">
 <div class="form-group">
 <label class="col-md-12">#dae0e5</label>
     <div id="cp52" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button35' ] . '" class="form-control" name="button35" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>
</div>

<div class="col-md-12">
<div class="form-group row">
<label class="col-md-1">Code:</label>
<div class="col-md-10">
<pre><code class="language-html">&lt;button type=&quot;button&quot; class=&quot;btn btn-light&quot;&gt;Light&lt;/button&gt;</code></pre>
</div>
</div>
<hr>
</div>


<div class="col-md-1">
<div class="form-group">
<label class="control-label">
<button class="btn btn-dark custom" />Dark</button></label>

</div>
</div>


<div class="col-md-2">

<div class="form-group">
    <label class="col-md-12">#343a40</label>
    <div id="cp53" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button36' ] . '" class="form-control" name="button36" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>
  </div>
  <div class="col-md-2">

  <div class="form-group">
  <label class="col-md-12">#23272b</label>
    <div id="cp54" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button37' ] . '" class="form-control" name="button37" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>

  </div>
  <div class="col-md-2">
 <div class="form-group">
 <label class="col-md-12">#ffffff</label>
     <div id="cp55" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button38' ] . '" class="form-control" name="button38" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>
</div>

<div class="col-md-2">
 <div class="form-group">
 <label class="col-md-12">#343a40</label>
     <div id="cp56" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button39' ] . '" class="form-control" name="button39" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>
</div>

<div class="col-md-2">
 <div class="form-group">
 <label class="col-md-12">#1d2124</label>
     <div id="cp57" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button40' ] . '" class="form-control" name="button40" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>
</div>

<div class="col-md-12">
<div class="form-group row">
<label class="col-md-1">Code:</label>
<div class="col-md-10">
<pre><code class="language-html">&lt;button type=&quot;button&quot; class=&quot;btn btn-dark&quot;&gt;Dark&lt;/button&gt;</code></pre>
</div>
</div>
<hr>
</div>


<div class="col-md-1 p-3 mb-2 bg-secondary text-white" align="center"><b>Link:</b></div>
<div class="col-md-2 p-3 mb-2 bg-secondary text-white" align="center"><b>font color:</b></div>
<div class="col-md-2 p-3 mb-2 bg-secondary text-white" align="center"><b>color hover:</b></div>
<div class="col-md-7 p-3 mb-2 bg-secondary text-white" align="center"><b>&nbsp;</b></div>


<div class="col-md-1">
<div class="form-group">
<label class="control-label">
<button class="btn btn-link" />Link</button></label>

</div>
</div>



<div class="col-md-2">
<div class="form-group">
    <label class="col-md-12">#007bff</label>
    <div id="cp58" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button41' ] . '" class="form-control" name="button41" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>
  </div>
  <div class="col-md-2">
<div class="form-group">
  <label class="col-md-12">#0056b3</label>
    <div id="cp59" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button42' ] . '" class="form-control" name="button42" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>
</div>

<div class="col-md-12">
<div class="form-group row">
<label class="col-md-1">Code:</label>
<div class="col-md-10">
<pre><code class="language-html">&lt;button type=&quot;button&quot; class=&quot;btn btn-link&quot;&gt;Link&lt;/button&gt;</code></pre>
</div>
  </div>

  </div></div></div></div></div>
<!-- ================Button====END======================= -->

     </div> <!-- row end -->
    </div> <!-- card body end -->
   </div> <!-- collapse 4 end -->
  </div> <!-- Panel 4 End -->


<div class="panel"> <!-- Panel 5 Start -->
   <div class="card-he1ader" role="tab" id="headingFive">
    <h4 class="mb-0">
     <button style="width: 100%" class="btn btn-secondary text-left" type="button" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="true" aria-controls="collapseSix">
      <i class="fas fa-boxes"></i> Plugin Settings
     </button>
    </h4>
   </div>
   
   <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
    <div class="card-body">
     
     <div class="row"> <!-- row start -->
     
       <!-- ================Plugin Settings=========================== -->


<div class="card">
        
            <div class="card-body">

            <div class="alert alert-warning">Führe hier bitte erst Änderungen durch, wenn das zu bearbeitende Plugin auch zuvor installiert wurde! Diese Änderungen betreffen <strong>nur</strong> die jeweiligen Widgets und themebedingte Anpassungen. Übergreifende CSS Eigenschaften bleiben im jeweiligen Plugin enthalten!<br><br>Theme angepasste Plugins sind: <strong>Carousel, eSport Footer, Calendar</strong></div>

<h4>Footer Plugin Settings</h4>';

$dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "plugins WHERE modulname='footer'"));
        if (@$dx[ 'modulname' ] != 'footer') {
        echo 'No Plugin';
        } else {

echo'<div class="row">
<div class="col-md-6">
<div class="form-group row">
    <label class="col-md-4 control-label">footer bg-color:</label>
    <div id="cp15" class="input-group colorpicker-component col-md-7">
    <input type="text" value="' . $ds[ 'foot1' ] . '" class="form-control" name="foot1" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>

  <div class="form-group row">
    <label class="col-md-4 control-label">copyright bg-color:</label>
    <div id="cp62" class="input-group colorpicker-component col-md-7">
    <input type="text" value="' . $ds[ 'foot5' ] . '" class="form-control" name="foot5" /><span class="input-group-addon"><i></i></span> 
     </div>
  </div>

  <div class="form-group row">
    <label class="col-md-4 control-label">H3 color:</label>
    <div id="cp16" class="input-group colorpicker-component col-md-7">
    <input type="text" value="' . $ds[ 'foot3' ] . '" class="form-control" name="foot3" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>

  </div>
  
    <div class="col-md-6">
    <div class="form-group row">
    <label class="col-md-4 control-label">footer color:</label>
    <div id="cp68" class="input-group colorpicker-component col-md-7">
    <input type="text" value="' . $ds[ 'foot6' ] . '" class="form-control" name="foot6" /><span class="input-group-addon"><i></i></span> 
     </div>
  </div>

  
    <div class="form-group row">
    <label class="col-md-4 control-label">copyright color:</label>
    <div id="cp17" class="input-group colorpicker-component col-md-7">
    <input type="text" value="' . $ds[ 'foot2' ] . '" class="form-control" name="foot2" /><span class="input-group-addon"><i></i></span> 
     </div>
  </div>
  
    <div class="form-group row">
    <label class="col-md-4 control-label">border top color:</label>
    <div id="cp67" class="input-group colorpicker-component col-md-7">
    <input type="text" value="' . $ds[ 'foot4' ] . '" class="form-control" name="foot4" /><span class="input-group-addon"><i></i></span> 
     </div>
  </div>

  

</div>
</div>';
}
echo'
<hr>


<h4>Calendar Plugin Settings</h4>';

$dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "plugins WHERE modulname='calendar'"));
        if (@$dx[ 'modulname' ] != 'calendar') {
        echo 'No Plugin';
        } else {
echo'<div class="row">
<div class="col-md-6">
<div class="form-group row">
    <label class="col-md-4 control-label">date31 bg-color:</label>
    <div id="cp60" class="input-group colorpicker-component col-md-7">
    <input type="text" value="' . $ds[ 'calendar1' ] . '" class="form-control" name="calendar1" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>

  </div>
  
    <div class="col-md-6">

  <div class="form-group row">
    <label class="col-md-4 control-label">today  bg-color:</label>
    <div id="cp61" class="input-group colorpicker-component col-md-7">
    <input type="text" value="' . $ds[ 'calendar2' ] . '" class="form-control" name="calendar2" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>

  
  </div>
  

</div>';
}
echo'
<hr>


<h4>Carousel Plugin Settings</h4>';

$dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "plugins WHERE modulname='carousel'"));
        if (@$dx[ 'modulname' ] != 'carousel') {
        echo 'No Plugin';
        } else {
       

echo'<div class="row">
<div class="col-md-6">

<div class="form-group row">
    <label class="col-md-4 control-label">H1 color:</label>
    <div id="cp63" class="input-group colorpicker-component col-md-7">
    <input type="text" value="' . $ds[ 'carousel1' ] . '" class="form-control" name="carousel1" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>

  <div class="form-group row">
    <label class="col-md-4 control-label">H1 span color:</label>
    <div id="cp64" class="input-group colorpicker-component col-md-7">
    <input type="text" value="' . $ds[ 'carousel2' ] . '" class="form-control" name="carousel2" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>

  </div>
  
    <div class="col-md-6">

  <div class="form-group row">
    <label class="col-md-4 control-label">color:</label>
    <div id="cp65" class="input-group colorpicker-component col-md-7">
    <input type="text" value="' . $ds[ 'carousel3' ] . '" class="form-control" name="carousel3" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>

  <div class="form-group row">
    <label class="col-md-4 control-label">carousel-indicators .active color:</label>
    <div id="cp66" class="input-group colorpicker-component col-md-7">
    <input type="text" value="' . $ds[ 'carousel4' ] . '" class="form-control" name="carousel4" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>

  
  </div>
  

</div>';
}
echo'</div></div>
<!-- ================Plugin Settings====END======================= -->
     

     </div> <!-- row end -->
    </div> <!-- card body end -->
   </div> <!-- collapse 5 end -->
  </div> <!-- Panel 5 End -->
   


<div class="panel"> <!-- Panel 6 Start -->
   <div class="card-he1ader" role="tab" id="headingSix">
    <h4 class="mb-0">
     <button style="width: 100%" class="btn btn-secondary text-left" type="button" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSix" aria-expanded="true" aria-controls="collapseEight">
      <i class="far fa-file-code"></i> stylesheet.css
     </button>
    </h4>
   </div>
   
   <div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSix">
    <div class="card-body">
     
     <div class="row"> <!-- row start -->

    <div class="card">
      
<div class="card-body">

<div class="form-group row">
    <label class="col-md-3">'.$_language->module['stylesheet_info'].'<br><br><small>Ordner: <b>/includes/themes/'.$ds['name'].'/css/</b>stylesheet.css</small></label>
    <div class="col-md-8">
        <textarea class="form-control" name="stylesheet" rows="20" cols="">'.$stylesheet.'</textarea>
    </div>
  </div>

</div></div>
</div>
  

<!-- ================css===END========================== -->

  
    </div>  <!-- row end -->
    </div> <!-- card-body end -->
  </div> <!-- content 6 end -->
  </div> <!-- panel 6 end -->


</div> <!-- accordion end -->

';
    }  

echo'



'.$express_active.'








<div class="form-group">
    <div class="col-md-offset-0 col-md-12">
    <input type="hidden" name="captcha_hash" value="'.$hash.'" /><input type="hidden" name="themeID" value="'.$themeID.'" />
    <input type="hidden" name="logo" value="' . $ds[ 'logo' ] . '" />
    <button class="btn btn-warning" type="submit" name="saveedit"  />'.$_language->module['edit_template'].'</button>
    <button class="btn btn-success" type="submit" name="saveedit" formaction="admincenter.php?site=settings_templates">'.$_language->module['edit_template_back'].'</button>
    </div>
  </div>


 </div>
  </div>
</form>
 </div>
  </div>';


} else {

if (isset($_POST[ 'addedit' ])) {
    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_POST[ 'captcha_hash' ])) {
        #$name = $_POST[ 'name' ];
        
      if(@$_POST['radio1']=="active") {
        $active = 1;
        $deactivated = 0;
         
     
    } else {
        $active = 0;
        $deactive = 0;
    }
        
    if($active == '1') {
      $sql = safe_query("SELECT `themeID` FROM `".PREFIX."settings_themes` WHERE `active` = 1 LIMIT 1");
      safe_query("UPDATE `".PREFIX."settings_themes` SET active = 0 WHERE `themeID` = themeID");
    }

        $themeID = (int)$_POST[ 'themeID' ];
        $id = $themeID;

        safe_query(
            "UPDATE
                `" . PREFIX . "settings_themes`
            SET
                
                `active` = '" . $active . "'
            WHERE
                `themeID` = '" . $themeID . "'"
        );

        
    } else {
        echo $_language->module[ 'transaction_invalid' ];
    }
}

$_language->readModule('templates', false, true);

if (isset($_GET[ 'action' ])) {
    $action = $_GET[ 'action' ];
} else {
    $action = '';
}

echo'<div class="card">
        <div class="card-header">
            <i class="fas fa-tasks"></i> '.$_language->module['template'].'
        </div>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="admincenter.php?site=settings_templates">'.$_language->module['template'].'</a></li>
    <li class="breadcrumb-item active" aria-current="page">new & edit</li>
  </ol>
</nav>   
<div class="card-body">

<div class="form-group row">
    <label class="col-md-1 control-label">' . $_language->module['options'] . ':</label>
    <div class="col-md-7">
      <a href="admincenter.php?site=settings_templates&amp;action=add" class="btn btn-primary" type="button">' . $_language->module[ 'new_template' ] . '</a>
    </div>
  </div>';


    $row = safe_query("SELECT * FROM " . PREFIX . "settings_themes");
    $tmp = mysqli_fetch_assoc(safe_query("SELECT count(themeID) as cnt FROM " . PREFIX . "settings_themes"));
    $anzpartners = $tmp[ 'cnt' ];
    $CAPCLASS = new \webspell\Captcha;
    $CAPCLASS->createTransaction();
    $hash = $CAPCLASS->getHash();

   echo'<table id="plugini" class="table table-bordered table-striped dataTable">
    <thead>
      
      <th style="width: 25%">'.$_language->module['banner'].'</th>
      <th style="width: 35%">'.$_language->module['template_name'].'</th>
      <th style="width: 24%">'.$_language->module['active'].'</th>
      <th>'.$_language->module['actions'].'</th>
    </thead>';

   $i = 1;
    while ($db = mysqli_fetch_array($row)) {


                if (file_exists("../includes/themes/".getinput($db['name'])."/images/".getinput($db['name']).".jpg")) {
                    $bannerpic = ".jpg";
                    $pic_info = $db[ 'name' ];
                } elseif (file_exists("../includes/themes/".getinput($db['name'])."/images/".getinput($db['name']).".gif")) {
                    $bannerpic = ".gif";
                    $pic_info = $db[ 'name' ];
                } elseif (file_exists("../includes/themes/".getinput($db['name'])."/images/".getinput($db['name']).".png")) {
                    $bannerpic = ".png";
                    $pic_info = $db[ 'name' ];
                } else {
                    $bannerpic = ".jpg";
                    $pic_info = "../../../../images/no-image";
                }


        echo '<tr>
        
        
        <td>

<div class="imageHold">
    <div><img class="featured-image img-thumbnail" src="../includes/themes/'.getinput($db['name']).'/images/'.$pic_info.''.$bannerpic.'" alt="Bannerpic"></div>
</div>

        </td>

        <td><strong>Templatename: '.getinput($db['name']).'</strong>
        <br><small class="fontLight">Modulname: '.$db['modulname'].'</small>
        <br><small class="fontLight">Version: '.$db['version'].'</small>
        <br><small class="fontLight">Ordner: /includes/themes/'.getinput($db['name']).'</small>
        </td>';

        $db[ 'active' ] == 1 ? $active = '<font color="green"><b>' . $_language->module[ 'active_on' ] . '</b></font>' :
            $active = '<font color="red"><b>' . $_language->module[ 'active_off' ] . '</b></font>';

        $db[ 'active' ] == 1 ? $button = '' :
            $button = '<input type="hidden" name="captcha_hash" value="'.$hash.'" /><input type="hidden" name="themeID" value="'.$db['themeID'].'" />
    <button class="btn btn-success" type="submit" name="addedit"  />'.$_language->module['edit_template'].'</button>';    
            

       echo'  
              <td>'.$active.'';
    if ($db[ 'active' ] == '1') {
        $active = '<input id="activeactive" type="radio" name="radio1" value="active" checked="checked" />';
    } else {
        $active = '<input id="active" type="radio" name="radio1" value="active">';
    }

     echo'<form class="form-horizontal" method="post" action="admincenter.php?site=settings_templates" enctype="multipart/form-data">
      <div class="form-group row">
    <label class="col-md-2 control-label" for="active_on"></label>
    <div class="col-md-7">
  '.$active.'
</div>
</div>

<div class="form-group row">
    <div class="col-md-12">'.$button.'
    
    </div>

   

  </div>

</form>
</td>
<td>
 <a href="admincenter.php?site=settings_templates&amp;action=edit&amp;themeID='.$db['themeID'].'" class="btn btn-warning" type="button">' . $_language->module[ 'template_edit' ] . '</a>

        <input class="btn btn-danger" type="button" onclick="MM_confirm(\''.$_language->module['really_delete'].'\', \'admincenter.php?site=settings_templates&amp;delete=true&amp;themeID='.$db['themeID'].'&amp;modulname='.$db['modulname'].'&amp;captcha_hash='.$hash.'\')" value="'.$_language->module['delete'].'" />
        </td>

      </tr>';
  }
  
  echo '</table>';

echo '</div></div>';

}
?><script type="text/javascript">

    $('.collapse').collapse()

    $('#myCollapsible').collapse({
  toggle: false
})

    $('#myCollapsible').on('hidden.bs.collapse', function () {
  // do something…
})
</script>