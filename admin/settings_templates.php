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

if(isset($_GET[ 'delete' ])) {

    #$dir = $_GET['dir'];
    $dir = $_GET['modulname'];
    $name = $_GET['modulname'];
    // Name Tabelle | Where Klause | ID name
    DeleteData("settings_themes","modulname",$name);
    DeleteData("settings_module","themes_modulname",$name);
    DeleteData("settings_widgets","themes_modulname",$name);
    DeleteData("settings_buttons","modulname",$name);
    DeleteData("navigation_website_sub","themes_modulname",$name);
    recursiveRemoveDirectory('../includes/themes/'. $dir);
    safe_query("UPDATE `".PREFIX."settings_themes` SET active = 1 WHERE modulname = 'default'");   
    header('Location: ?site=settings_templates');
    exit;  

  /*$dir = $_GET[ 'modulname' ];
  $name = str_replace("/", "", $dir);
  require_once('../includes/themes/' . $_GET[ 'modulname' ] . '/uninstall.php');
  recursiveRemoveDirectory('../includes/themes/'. $dir);
  safe_query("UPDATE `".PREFIX."settings_themes` SET active = 1 WHERE modulname = 'default'");  
  header('Location: ?site=settings_templates');
  exit;*/


} elseif (isset($_GET["delete_pic"])) {

    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_GET['captcha_hash'])) {
        $themeID = (int)$_GET[ 'themeID' ];
        $filepath = "../includes/themes/".$dx['pfad']."/images/";
        if (
        safe_query(
                "UPDATE
                            `" . PREFIX . "settings_themes`
                        SET
                            `background_pic` = ''
                        WHERE
                            `themeID` = '" . $themeID . "'"
            )    
        ) {
            if (file_exists($filepath . 'background_bg.jpg')) {
                unlink($filepath . 'background_bg.jpg');
            }
            if (file_exists($filepath . 'background_bg.gif')) {
                unlink($filepath . 'background_bg.gif');
            }
            if (file_exists($filepath . 'background_bg.png')) {
                unlink($filepath . 'background_bg.png');
            }
            redirect("admincenter.php?site=settings_templates", "", 0);
        } else {
            redirect("admincenter.php?site=settings_templates", "", 0);
        }
    } else {
        echo $_language->module['transaction_invalid'];
        redirect("admincenter.php?site=settings_templates", "", 0);
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
        $pfad = $_POST[ 'pfad' ];
        $modulname = $_POST[ 'modulname' ];
        $version = $_POST[ 'version' ];
        $themes_modulname = $_POST[ 'modulname' ];
        
    
    if(@$_POST['radio1']=="active") {
        $active = 1;
    } else {
        $active = 0;
    }

/* Zielpfad definieren */
 $path = '../includes/themes/'.$pfad.'';
if (!file_exists($path)) {
    mkdir($path, 0777, true);
}

/* Quell- und Zielpfad definieren */
/* Datei in den Zielpfad verschieben (kopieren) */
$source = '../includes/themes/base_files';
$target = '../includes/themes/'.$pfad.'';

$objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);

foreach($objects as $nname => $object){

    $tpath = substr_replace($nname, $target, 0, strlen($source));

    if($object->isDir() && ! is_dir($tpath)) {

        mkdir($tpath);

    } elseif ($object->isFile()) {

        copy($nname, $tpath);

    }

}
   
@unlink("../includes/themes/$pfad/install.php");
#@unlink("../includes/themes/$pfad/uninstall.php");
@unlink("../includes/themes/$pfad/update.php");

############# Plugin und Modul Einstellung ############################################################################################
safe_query("UPDATE `".PREFIX."settings_themes` SET active = 0 WHERE `active` = '1'");
#@info: Widgets werden an der richtigen Position in der Index positioniert / anpassen ab ID 10
safe_query("INSERT INTO `" . PREFIX . "settings_widgets` (`id`, `position`, `description`, `modulname`, `themes_modulname`, `widget`, `widgetname`, `widgetdatei`, `activate`, `number`, `sort`) VALUES
('', 'page_navigation_widget', 'page_navigation_widget', 'navigation_default', '$themes_modulname', 'widget1', 'Navigation Default', 'widget_navigation_default', 0, 1, 1),
('', 'page_footer_widget', 'page_footer_widget', 'footer', '$themes_modulname', 'widget2', 'Easy Footer Content', 'widget_easyfooter_content', 0, 1, 0);");

#@info: Base Modul Einstellung // # Die Startseite / Bereiche müssen angepasst werden
safe_query("INSERT INTO `".PREFIX."settings_module` (`pluginID`, `name`, `modulname`, `themes_modulname`, `full_activated`, `custom_activated`, `via_navigation`, `head_activated`, `content_head_activated`, `content_foot_activated`, `head_section_activated`, `foot_section_activated`, `modul_display`, `activate`, `sidebar`, `plugin_settings`, `plugin_module`, `plugin_widget`, `widget1`, `widget2`, `widget3`) VALUES
('', 'Startpage', '', '$themes_modulname', 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 'activated', 0, 1, 0, 0, 0, 0),
('', '', 'startpage', '$themes_modulname', 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 'activated', 0, 1, 0, 0, 0, 0),
('', 'Profile', 'profile', '$themes_modulname', 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 'activated', 0, 0, 0, 0, 0, 0),
('', 'Login', 'login', '$themes_modulname', 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 'activated', 0, 0, 0, 0, 0, 0),
('', 'Lost Password', 'lostpassword', '$themes_modulname', 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 'activated', 0, 0, 0, 0, 0, 0),
('', 'Register', 'register', '$themes_modulname', 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 'activated', 0, 0, 0, 0, 0, 0),
('', 'Contact', 'contact', '$themes_modulname', 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 'activated', 0, 0, 0, 0, 0, 0),
('', 'Imprint', 'imprint', '$themes_modulname', 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 'activated', 0, 0, 0, 0, 0, 0),
('', 'Privacy Policy', 'privacy_policy', '$themes_modulname', 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 'activated', 0, 0, 0, 0, 0, 0),
('', 'Static', 'static', '$themes_modulname', 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 'activated', 0, 0, 0, 0, 0, 0),
('', 'Error_404', 'error_404', '$themes_modulname', 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 'activated', 0, 0, 0, 0, 0, 0),
('', 'My Profile', 'myprofile', '$themes_modulname', 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 'activated', 0, 0, 0, 0, 0, 0),
('', 'report', 'report', '$themes_modulname', 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 'activated', 0, 0, 0, 0, 0, 0),
('', 'Navigation Default', 'navigation_default', '$themes_modulname', 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 'activated', 1, 0, 1, 1, 0, 0),
('', 'Footer', 'footer', '$themes_modulname', 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 'activated', 1, 0, 1, 1, 1, 1);");

safe_query("INSERT INTO `".PREFIX."settings_buttons` (`buttonID`, `name`, `modulname`, `active`, `version`, `button1`, `button2`, `button3`, `button4`, `button5`, `button6`, `button7`, `button8`, `button9`, `button10`, `button11`, `button12`, `button13`, `button14`, `button15`, `button16`, `button17`, `button18`, `button19`, `button20`, `button21`, `button22`, `button23`, `button24`, `button25`, `button26`, `button27`, `button28`, `button29`, `button30`, `button31`, `button32`, `button33`, `button34`, `button35`, `button36`, `button37`, `button38`, `button39`, `button40`, `button41`, `button42`, `btn_border_radius`) VALUES
('', '$name', '$modulname', '$active', '$version', 'rgb(254,130,29)', 'rgb(196,89,1)', 'rgb(255,255,255)', 'rgb(254,130,29)', 'rgb(196,89,1)', 'rgb(108,117,125)', 'rgb(90,98,104)', 'rgb(255,255,255)', 'rgb(108,117,125)', 'rgb(84,91,98)', 'rgb(40,167,69)', 'rgb(33,136,56)', 'rgb(255,255,255)', 'rgb(40,167,69)', 'rgb(30,126,52)', 'rgb(220,53,69)', 'rgb(200,35,51)', 'rgb(255,255,255)', 'rgb(220,53,69)', 'rgb(189,33,48)', 'rgb(255,193,7)', 'rgb(224,168,0)', 'rgb(33,37,41)', 'rgb(255,193,7)', 'rgb(211,158,0)', 'rgb(23,162,184)', 'rgb(19,132,150)', 'rgb(255,255,255)', 'rgb(23,162,184)', 'rgb(17,122,139)', 'rgb(248,249,250)', 'rgb(226,230,234)', 'rgb(33,37,41)', 'rgb(248,249,250)', 'rgb(218,224,229)', 'rgb(52,58,64)', 'rgb(35,39,43)', 'rgb(255,255,255)', 'rgb(52,58,64)', 'rgb(29,33,36)', 'rgb(254,130,29)', 'rgb(196,89,1)', '0px');");

safe_query("INSERT INTO `".PREFIX."settings_themes` (`themeID`, `name`, `modulname`, `pfad`, `version`, `active`, `express_active`, `nav1`, `nav2`, `nav3`, `nav4`, `nav5`, `nav6`, `nav7`, `nav8`, `nav9`, `nav10`, `nav11`, `nav12`, `nav_text_alignment`, `body1`, `body2`, `body3`, `body4`, `body5`, `background_pic`, `border_radius`, `typo1`, `typo2`, `typo3`, `typo4`, `typo5`, `typo6`, `typo7`, `typo8`, `card1`, `card2`, `foot1`, `foot2`, `foot3`, `foot4`, `foot5`, `foot6`, `calendar1`, `calendar2`, `carousel1`, `carousel2`, `carousel3`, `carousel4`, `logo_pic`, `logotext1`, `logotext2`, `reg_pic`, `reg1`, `reg2`, `headlines`, `sort`) VALUES
('', '$name', '$modulname', '$pfad', '$version', $active, 0, 'rgb(51,51,51)', '16px', 'rgb(221,221,221)', 'rgb(254,130,29)', 'rgb(254,130,29)', '2px', 'rgb(221,221,221)', 'rgb(196,89,1)', '', 'rgb(51,51,51)', 'rgb(221,221,221)', 'rgb(101,100,100)', 'ms-auto', 'Roboto', '13px', 'rgb(255,255,255)', 'rgb(85,85,85)', 'rgb(236,236,236)', '', '0px', '', '', '', 'rgb(254,130,29)', '', '', '', 'rgb(196,89,1)', 'rgb(255,255,255)', 'rgb(221,221,221)', 'rgb(51,51,51)', '', '', '', '', '', '', '', 'rgb(255,255,255)', 'rgb(254,130,29)', 'rgb(255,255,255)', 'rgb(254,130,29)', 'logo.png', '', '', 'login_bg.png', 'rgb(254,130,29)', 'rgb(255,255,255)', 'headlines_01.css', 1);");

safe_query("INSERT INTO `".PREFIX."navigation_website_sub` (`snavID`, `mnavID`, `name`, `modulname`, `url`, `sort`, `indropdown`, `themes_modulname`) VALUES
('', 6, '{[de]}Kontakt{[en]}Contact{[it]}Contatti', 'contact', 'index.php?site=contact', 1, 1, '$themes_modulname'),
('', 6, '{[de]}Datenschutz-Bestimmungen{[en]}Privacy Policy{[it]}Informativa sulla privacy', 'privacy_policy', 'index.php?site=privacy_policy', 2, 1, '$themes_modulname'),
('', 6, '{[de]}Impressum{[en]}Imprint{[it]}Impronta Editoriale', 'imprint', 'index.php?site=imprint', 3, 1, '$themes_modulname');");

        $id = mysqli_insert_id($_database);

        $filepath = "../includes/themes/".$pfad."/images/";

        //TODO: should be loaded from root language folder
        $_language->readModule('formvalidation', true, true);

        $upload = new \webspell\HttpUpload('theme_pic');

        if ($upload->hasFile()) {
            if ($upload->hasError() === false) {
                $mime_types = array('image/jpeg','image/png','image/gif');
                if ($upload->supportedMimeType($mime_types)) {
                    $imageInformation =  getimagesize($upload->getTempFile());

                    if (is_array($imageInformation)) {
                        if ($imageInformation[0] < 1651 && $imageInformation[1] < 501) {
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
                            $file = $modulname.$endung;

                            if (file_exists($filepath . $modulname . '.gif')) {
                                unlink($filepath . $modulname . '.gif');
                            }
                            if (file_exists($filepath . $modulname . '.jpg')) {
                                unlink($filepath . $modulname . '.jpg');
                            }
                            if (file_exists($filepath . $modulname . '.png')) {
                                unlink($filepath . $modulname . '.png');
                            }

                            if ($upload->saveAs($filepath.$file)) {
                                @chmod($filepath.$file, $new_chmod);
                                
                            }
                        } else {
                            echo generateErrorBox(sprintf($_language->module[ 'image_too_big' ], 1650, 500));
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
        echo  $_language->module[ 'transaction_invalid' ];
    }

} elseif (isset($_POST[ 'saveedit' ])) {
    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_POST[ 'captcha_hash' ])) {    	
        #$name = $_POST[ 'name' ];
        
        if(@$_POST['radio1']=="active") {
        $active = 1;
        #$deactivated = 0;
        } else {
        $active = 0;
        #$deactive = 0;
        }

        if(@$_POST['radio2']=="express_active") {
        $express_active = 1;
        $deactivated = 0;
        } else {
        $express_active = 0;
        $deactive = 0;
        }

        if ($_POST['radio3'] == "headlines_01.css") {
            $headlines = 'headlines_01.css';
        }else if ($_POST['radio3'] == "headlines_02.css") {
            $headlines = 'headlines_02.css';
        }else if ($_POST['radio3'] == "headlines_03.css") {
            $headlines = 'headlines_03.css';
        }else if ($_POST['radio3'] == "headlines_04.css") {
            $headlines = 'headlines_04.css'; 
        }else if ($_POST['radio3'] == "headlines_05.css") {
            $headlines = 'headlines_05.css';
        }else if ($_POST['radio3'] == "headlines_06.css") {
            $headlines = 'headlines_06.css';
        }else if ($_POST['radio3'] == "headlines_07.css") {
            $headlines = 'headlines_07.css';
        }else if ($_POST['radio3'] == "headlines_08.css") {
            $headlines = 'headlines_08.css';
        }else if ($_POST['radio3'] == "headlines_09.css") {
            $headlines = 'headlines_09.css';
        }else if ($_POST['radio3'] == "headlines_10.css") {
            $headlines = 'headlines_10.css';   
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
                `active`= '" . $active . "',
                `express_active` = '" . $express_active . "',
                
                `version`='" . $_POST[ 'version' ] . "',
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
                `nav11`='" . $_POST[ 'nav11' ] . "',
                `nav12`='" . $_POST[ 'nav12' ] . "',
                `body1`='" . $_POST[ 'body1' ] . "',
                `body2`='" . $_POST[ 'body2' ] . "',
                `body3`='" . $_POST[ 'body3' ] . "',
                `body4`='" . $_POST[ 'body4' ] . "',
                `body5`='" . $_POST[ 'body5' ] . "',
                
                `typo4`='" . $_POST[ 'typo4' ] . "',
                
                
                `typo8`='" . $_POST[ 'typo8' ] . "',
                `card1`='" . $_POST[ 'card1' ] . "',
                `card2`='" . $_POST[ 'card2' ] . "',
                `border_radius`='" . $_POST[ 'border_radius' ] . "',
                `foot1`='" . @$_POST[ 'foot1' ] . "',
                `foot2`='" . @$_POST[ 'foot2' ] . "',
                `foot3`='" . @$_POST[ 'foot3' ] . "',
                `foot4`='" . @$_POST[ 'foot4' ] . "',
                `foot5`='" . @$_POST[ 'foot5' ] . "',
                `foot6`='" . @$_POST[ 'foot6' ] . "',                
                `calendar1`='" . @$_POST[ 'calendar1' ] . "',
                `calendar2`='" . @$_POST[ 'calendar2' ] . "',
                `carousel1`='" . @$_POST[ 'carousel1' ] . "',
                `carousel2`='" . @$_POST[ 'carousel2' ] . "',
                `carousel3`='" . @$_POST[ 'carousel3' ] . "',
                `carousel4`='" . @$_POST[ 'carousel4' ] . "',
                `logotext1`='" . $_POST[ 'logotext1' ] . "',
                `logotext2`='" . $_POST[ 'logotext2' ] . "',
                
                `reg2`='" . $_POST[ 'reg2' ] . "',
                `nav_text_alignment`='" . $_POST[ 'nav_text_alignment' ] . "',
                `headlines`='" . $headlines . "'
                WHERE
                `themeID` = '" . $themeID . "'"
        );


$ergebnis = safe_query("SELECT * FROM " . PREFIX . "settings_buttons");
    $dy = mysqli_fetch_array($ergebnis);
safe_query(
            "UPDATE
                `" . PREFIX . "settings_buttons`
            SET
                
                `active` = '" . $active . "',
                
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
                button42='" . $_POST[ 'button42' ] . "',
                `btn_border_radius`='" . $_POST[ 'btn_border_radius' ] . "'
                WHERE
                `modulname` = '".getinput($dx['modulname'])."'"
        );

safe_query("DELETE FROM " . PREFIX . "settings_widgets WHERE themes_modulname='' ");
safe_query("DELETE FROM " . PREFIX . "settings_module WHERE themes_modulname='' ");

		$error = array();
        $sem = '/^#[a-fA-F0-9]{6}/';
        
        if (count($error)) {
            echo '<b>' . $_language->module[ 'errors' ] . ':</b><br /><ul>';

            foreach ($error as $err) {
                echo '<li>' . $err . '</li>';
            }
            echo '</ul>';
        } else {
            
            $file = ("../includes/themes/".$dx['pfad']."/css/stylesheet.css");
            $fp = fopen($file, "w");
            fwrite($fp, stripslashes(str_replace('\r\n', "\n", $_POST[ 'stylesheet' ])));
            fclose($fp);
        }


		$filepath = "../includes/themes/".$dx['pfad']."/images/";

        //TODO: should be loaded from root language folder
        $_language->readModule('formvalidation', true, true);

        $upload = new \webspell\HttpUpload('logo_pic');

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
                            $file = "logo".$endung;

                            if (file_exists($filepath . "logo" . '.gif')) {
                                unlink($filepath . "logo" . '.gif');
                            }
                            if (file_exists($filepath . "logo" . '.jpg')) {
                                unlink($filepath . "logo" . '.jpg');
                            }
                            if (file_exists($filepath . "logo" . '.png')) {
                                unlink($filepath . "logo" . '.png');
                            }

                            if ($upload->saveAs($filepath.$file)) {
                                @chmod($filepath.$file, $new_chmod);
                                safe_query(
                                    "UPDATE " . PREFIX . "settings_themes
                                    SET logo_pic='" . $file . "' WHERE themeID='" . $id . "'"
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
                        if ($imageInformation[0] < 3921 && $imageInformation[1] < 2281) {
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

                            if (file_exists($filepath . 'login_bg.gif')) {
                                unlink($filepath . 'login_bg.gif');
                            }
                            if (file_exists($filepath . 'login_bg.jpg')) {
                                unlink($filepath . 'login_bg.jpg');
                            }
                            if (file_exists($filepath . 'login_bg.png')) {
                                unlink($filepath . 'login_bg.png');
                            }

                            if ($upload->saveAs($filepath.$file)) {
                                @chmod($filepath.$file, $new_chmod);
                                safe_query(
                                    "UPDATE " . PREFIX . "settings_themes
                                    SET reg_pic='" . $file . "' WHERE themeID='" . $id . "'"
                                );
                            }
                        } else {
                            echo generateErrorBox(sprintf($_language->module[ 'image_too_big' ], 3920, 2280));
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


        $upload = new \webspell\HttpUpload('background_pic');

        if ($upload->hasFile()) {
            if ($upload->hasError() === false) {
                $mime_types = array('image/jpeg','image/png','image/gif');
                if ($upload->supportedMimeType($mime_types)) {
                    $imageInformation =  getimagesize($upload->getTempFile());

                    if (is_array($imageInformation)) {
                        if ($imageInformation[0] < 3921 && $imageInformation[1] < 2281) {
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
                            $file = "background_bg".$endung;

                            if (file_exists($filepath . 'background_bg.gif')) {
                                unlink($filepath . 'background_bg.gif');
                            }
                            if (file_exists($filepath . 'background_bg.jpg')) {
                                unlink($filepath . 'background_bg.jpg');
                            }
                            if (file_exists($filepath . 'background_bg.png')) {
                                unlink($filepath . 'background_bg.png');
                            }

                            if ($upload->saveAs($filepath.$file)) {
                                @chmod($filepath.$file, $new_chmod);
                                safe_query(
                                    "UPDATE " . PREFIX . "settings_themes
                                    SET background_pic='" . $file . "' WHERE themeID='" . $id . "'"
                                );
                            }
                        } else {
                            echo generateErrorBox(sprintf($_language->module[ 'image_too_big' ], 3920, 2280));
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


$filepath = "../includes/themes/".$dx['pfad']."/images/";
$ergebnis = safe_query("SELECT * FROM " . PREFIX . "settings_themes WHERE themeID='$themeID'");
    $dx = mysqli_fetch_array($ergebnis);
    $modulname = $dx[ 'modulname' ];

        //TODO: should be loaded from root language folder
        $_language->readModule('formvalidation', true, true);

        $upload = new \webspell\HttpUpload('theme_pic');

        if ($upload->hasFile()) {
            if ($upload->hasError() === false) {
                $mime_types = array('image/jpeg','image/png','image/gif');
                if ($upload->supportedMimeType($mime_types)) {
                    $imageInformation =  getimagesize($upload->getTempFile());

                    if (is_array($imageInformation)) {
                        if ($imageInformation[0] < 1651 && $imageInformation[1] < 501) {
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
                            $file = $modulname.$endung;

                            if (file_exists($filepath . $modulname . '.gif')) {
                                unlink($filepath . $modulname . '.gif');
                            }
                            if (file_exists($filepath . $modulname . '.jpg')) {
                                unlink($filepath . $modulname . '.jpg');
                            }
                            if (file_exists($filepath . $modulname . '.png')) {
                                unlink($filepath . $modulname . '.png');
                            }

                            if ($upload->saveAs($filepath.$file)) {
                                @chmod($filepath.$file, $new_chmod);
                                
                            }
                        } else {
                            echo generateErrorBox(sprintf($_language->module[ 'image_too_big' ], 1650, 500));
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

     safe_query(
            "UPDATE
                `" . PREFIX . "settings_themes`
            SET                
                `active`= '" . $active . "',
                `express_active` = '" . $express_active . "',
                `nav1`='" . $_POST[ 'gen1' ] . "',
                `card2`='" . $_POST[ 'gen1' ] . "',
                `carousel2`='" . $_POST[ 'gen1' ] . "',
                `carousel4`='" . $_POST[ 'gen1' ] . "',
                `nav5`='" . $_POST[ 'gen1' ] . "',
                `nav7`='" . $_POST[ 'gen2' ] . "',
                `nav3`='" . $_POST[ 'gen2' ] . "',
                `body4`='" . $_POST[ 'gen2' ] . "',
                `body3`='rgb(245,245,245)',
                `card1`='rgb(245,245,245)',
                `nav4`='" . $_POST[ 'gen4' ] . "',
                `nav8`='" . $_POST[ 'gen4' ] . "',
                `typo8`='" . $_POST[ 'gen4' ] . "',
                `typo4`='" . $_POST[ 'gen3' ] . "', 
                `nav9`='',
                `nav10`='rgb(245,245,245)',
                `nav11`='rgb(245,245,245)',                
                `foot4`='" . $_POST[ 'gen1' ] . "',
                `reg1`='" . $_POST[ 'gen5' ] . "'                
                WHERE
                `themeID` = '" . $themeID . "'"
        );
    safe_query(
            "UPDATE
                `" . PREFIX . "settings_buttons`
            SET
                button1='" . $_POST[ 'gen3' ] . "',
                button2='" . $_POST[ 'gen4' ] . "',
                button3='" . $_POST[ 'gen2' ] . "',
                button4='" . $_POST[ 'gen2' ] . "',
                button5='" . $_POST[ 'gen2' ] . "'
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
            '.$_language->module['template'].'
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

    <div class="mb-3 row">
    <label class="col-md-2 control-label">Info:</label>
    <div class="col-md-8"><div class="alert alert-warning" role="alert">
  '.$_language->module['new_template_alert'].'
</div>

    </div>
  </div>

  <div class="mb-3 row">
    <label class="col-md-2 control-label">'.$_language->module['template_name'].':</label>
    <div class="col-md-8"><span class="text-muted small"><em>
      <input type="text" class="form-control" name="name" size="60" /><small class="fontLight">'.$_language->module['template_name_info'].'</small></em></span>
    </div>
  </div>

  <div class="mb-3 row">
    <label class="col-md-2 control-label">'.$_language->module['modulname'].':</label>
    <div class="col-md-8"><span class="text-muted small"><em>
      <input type="text" class="form-control" name="modulname" size="60" /><small class="fontLight">'.$_language->module['modulname_info'].'</small></em></span>
    </div>
  </div>

  <div class="mb-3 row">
    <label class="col-md-2 control-label">'.$_language->module['pfad'].':</label>
    <div class="col-md-8"><span class="text-muted small"><em>
      <input type="text" class="form-control" name="pfad" size="60" /><small class="fontLight">'.$_language->module['pfad_info'].'</small></em></span>
    </div>
  </div>

<div class="mb-3 row">
    <label class="col-md-2 control-label">'.$_language->module['banner'].':</label>
    <div class="col-md-8"><span class="text-muted small"><em>
      <input class="btn btn-info" name="theme_pic" type="file" size="40" /> <small>(max. 1000x500)</small></em></span>
    </div>
  </div>

  <div class="mb-3 row">
    <label class="col-md-2 control-label">'.$_language->module['version'].':</label>
    <div class="col-md-8"><span class="text-muted small"><em>
      <input type="text" class="form-control" name="version" size="60" /></em></span>
    </div>
  </div>
  
<div class="mb-3 row">
    <label class="col-md-2 control-label" for="active_on">'.$_language->module['active_on'].':</label>
    <div class="col-md-8 form-check form-switch" style="padding: 0px 40px;">
  <input class="form-check-input" id="active" type="checkbox" name="radio1" value="active">
</div>
</div>

<div class="mb-3 row">
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
        $active = '<input class="form-check-input" id="active" type="checkbox" name="radio1" value="active" checked="checked" />';
    } else {
        $active = '<input class="form-check-input" id="active" type="checkbox" name="radio1" value="active">';
    }

    if ($ds[ 'express_active' ] == '1') {
        $express_active = '<input class="form-check-input" id="active" type="checkbox" name="radio2" value="express_active" checked="checked" />';
    } else {
        $express_active = '<input class="form-check-input" id="active" type="checkbox" name="radio2" value="express_active">';
    }

    if(file_exists('../includes/themes/'.$ds['pfad'].'/images/'.$ds['modulname'].'.jpg')){
            $themepic='<img style="height: 100px" src="../includes/themes/'.$ds['pfad'].'/images/'.$ds['modulname'].'.jpg" alt="">';
        } elseif(file_exists('../includes/themes/'.$ds['pfad'].'/images/'.$ds['modulname'].'.jpeg')){
            $themepic='<img style="height: 100px" src="../includes/themes/'.$ds['pfad'].'/images/'.$ds['modulname'].'.jpeg" alt="">';
        } elseif(file_exists('../includes/themes/'.$ds['pfad'].'/images/'.$ds['modulname'].'.png')){
            $themepic='<img style="height: 100px" src="../includes/themes/'.$ds['pfad'].'/images/'.$ds['modulname'].'.png" alt="">';
        } elseif(file_exists('../includes/themes/'.$ds['pfad'].'/images/'.$ds['modulname'].'.gif')){
            $themepic='<img style="height: 100px" src="../includes/themes/'.$ds['pfad'].'/images/'.$ds['modulname'].'.gif" alt="">';
        } else{
           $themepic='<img style="height: 100px" src="../images/no-image.jpg" alt="">';
        }

echo'<div class="card">
        <div class="card-header">
            '.$_language->module['template'].'
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

  <div class="mb-3 row">
    <label class="col-md-2 control-label">'.$_language->module['template_name'].':</label>
    <div class="col-md-8"><span class="text-muted small"><em>
      <input type="text" class="form-control" placeholder="'.getinput($ds['name']).'" / disabled></em></span>
    </div>
  </div>

  <div class="mb-3 row">
    <label class="col-md-2 control-label">'.$_language->module['folder_template'].':</label>
    <div class="col-md-8"><span class="text-muted small"><em>
      <input type="text" class="form-control" placeholder=" /includes/themes/'.getinput($ds['pfad']).'" / disabled></em></span>
    </div>
  </div>

  <div class="mb-3 row">
    <label class="col-md-2 control-label">'.$_language->module['modulname'].':</label>
    <div class="col-md-8"><span class="text-muted small"><em>
      <input type="text" class="form-control" placeholder="'.getinput($ds['modulname']).'" / disabled></em></span>
    </div>
  </div>

  <div class="mb-3 row">
    <label class="col-md-2 control-label">'.$_language->module['current_banner'].':</label>
    <div class="col-md-4 btn btn-info border border-secondary" style="margin: 5px;margin-left: 10px;">
      '.$themepic.'
    </div>
    </div>
  <div class="mb-3 row">
    <label class="col-md-2 control-label">'.$_language->module['banner'].':</label>
    <div class="col-md-8"><span class="text-muted small"><em>
      <input class="btn btn-info" name="theme_pic" type="file" size="40" /> <small>(max. 1000x500)</small></em></span>
    </div>
  </div>

  <div class="mb-3 row">
    <label class="col-md-2 control-label">'.$_language->module['version'].':</label>
    <div class="col-md-8"><span class="text-muted small"><em>
      <input type="text" class="form-control" name="version" value="'.getinput($ds['version']).'" /></em></span>
    </div>
  </div>


  <div class="mb-3 row">
    <label class="col-md-2 control-label" for="active_on">'.$_language->module['active_on'].':</label>
    <div class="col-md-8 form-check form-switch" style="padding: 0px 40px;">
  '.$active.'
</div>
</div>
<!--
<div class="mb-3 row">
    <label class="col-md-2 control-label" for="express_active_on">'.$_language->module['express_setting'].':</label>
    <div class="col-md-8 form-check form-switch" style="padding: 0px 40px;">
  '.$express_active.'
</div>
</div>
-->

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
</div>';
  
if ($ds[ 'express_active' ] == '1') {
        $express_active = '


<div class="accordion accordion-flush" id="accordionFlushExample">
  <div class="accordion-item">
    <h2 class="accordion-header" id="Express_Settings">
      <button class="accordion-button collapsed alert alert-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#Express_Settings" aria-expanded="false" aria-controls="Express_Settings">
       Express Settings
      </button>
    </h2>
    <div id="Express_Settings" class="accordion-collapse collapse" aria-labelledby="Express_Settings" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">
        <h4>Express Settings</h4>




<div class="row">
    <div class="col-md-6">
        <div class="mb-3 row">
        <label class="col-md-4">primary-bg:gen1 background</label>
        <div id="cp12" class="input-group colorpicker-component col-md-7">
        <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="gen1" /><span class="input-group-text input-group-addon"><i></i></span> 
        </div>
        </div>
      
        <div class="mb-3 row">
        <label class="col-md-4 control-label">text color:gen2 Schriftfarbe / Navilink </label>
        <div id="cp13" class="input-group colorpicker-component col-md-7">
        <input type="text" value="' . $ds[ 'nav7' ] . '" class="form-control" name="gen2" /><span class="input-group-text input-group-addon"><i></i></span> 
        </div>
        </div>
    </div>

    <div class="col-md-6">
          <div class="mb-3 row">
            <label class="col-md-4 control-label">text color link:gen3 Linkschrift</label>
            <div id="cp14" class="input-group colorpicker-component col-md-7">
            <input type="text" value="' . $ds[ 'typo4' ] . '" class="form-control" name="gen3" /><span class="input-group-text input-group-addon"><i></i></span> 
            </div>
          </div>
          
        <div class="mb-3 row">
            <label class="col-md-4 control-label" for="name">text color hoverlink:gen4 Linkschrift Hover</label>
            <div id="cp73" class="input-group colorpicker-component col-md-7">
            <input type="text" value="' . $ds[ 'typo8' ] . '" class="form-control" name="gen4" /><span class="input-group-text input-group-addon"><i></i></span> 
            </div>
          </div>

        <div class="mb-3 row">
            <label class="col-md-4 control-label">primary-bg Login Pic:gen5</label><small>rgba verwenden</small>
            <div id="cp74" class="input-group colorpicker-component col-md-7">
            <input type="text" value="' . $ds[ 'reg1' ] . '" class="form-control" name="gen5" /><span class="input-group-text input-group-addon"><i></i></span> 
            </div>
  </div>

       </div>

</div></div>
       
      
      
    </div>
  </div> <!-- accordion end -->
<br> <br>
';
    } else {
        $express_active = '

 ';$file = ("../includes/themes/".$ds['pfad']."/css/stylesheet.css");
    $size = filesize($file);
    $fp = fopen($file, "r");
    $stylesheet = fread($fp, $size);
    fclose($fp);    


$filepath = "../includes/themes/".$ds['pfad']."/images/";
if (!empty($ds[ 'logo_pic' ])) {
        $pic1 = '<img id="img-upload" class="" style="width: 100%; max-width: 150px" src="../' . $filepath . $ds[ 'logo_pic' ] . '" alt="">';
    } else {
        $pic1 = '<img id="img-upload" class="" style="width: 100%; max-width: 150px" src="../images/no-image.jpg" alt="">';
    }
if (!empty($ds[ 'reg_pic' ])) {
        $pic2 = '<img id="img-upload" class="" style="width: 100%; max-width: 150px" src="../' . $filepath . $ds[ 'reg_pic' ] . '" alt="">';
    } else {
        $pic2 = '<img id="img-upload" class="" style="width: 100%; max-width: 150px" src="../images/no-image.jpg" alt="">';
    }
if (!empty($ds[ 'background_pic' ])) {
        $pic3 = '<img id="img-upload" class="" style="width: 100%; max-width: 150px" src="../' . $filepath . $ds[ 'background_pic' ] . '" alt="">';
    } else {
        $pic3 = '<img id="img-upload" class="" style="width: 100%; max-width: 150px" src="../images/no-image.jpg" alt="">';
    }    
  

echo'
<div class="accordion accordion-flush" id="accordionFlushExample">
  <div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingOne">
      <button class="accordion-button collapsed alert alert-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
       '.$_language->module['navi_navigation'].'
      </button>
    </h2>
    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">
        <h4>'.$_language->module['navi_setting'].'</h4>
<div class="row">   
<div class="col-md-6">

<div class="mb-3 row">
    <label class="col-md-4 control-label">'.$_language->module['background_primare'].':</label>
    <div id="cp1" class="input-group colorpicker-component col-md-7">
    <input data-toggle="tooltip" data-html="true" title="'.$_language->module['tooltip_1'].'" type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-text input-group-addon"><i></i></span>
    </div>
  </div>

  <div class="mb-3 row">
    <label class="col-md-4 control-label">'.$_language->module['background_secondar'].':</label>
    <div id="cp76" class="input-group colorpicker-component col-md-7">
    <input data-toggle="tooltip" data-html="true" title="'.$_language->module['tooltip_1_2'].'" type="text" value="' . $ds[ 'nav12' ] . '" class="form-control" name="nav12" /><span class="input-group-text input-group-addon"><i></i></span>
    </div>
  </div>


  <div class="mb-3 row">
    <label class="col-md-4 control-label">Font-size:</label>
    <div class="input-group col-md-7">
   <input data-toggle="tooltip" data-html="true" title="'.$_language->module['tooltip_2'].'" class="form-control" type="text" name="nav2" value="' . $ds[ 'nav2' ] . '" />
    </div>
  </div>
  <div class="mb-3 row">
    <label class="col-md-4 control-label">Border-Top-Size:</label>
    <div class="input-group col-md-7">
   <input data-toggle="tooltip" data-html="true" title="'.$_language->module['tooltip_3'].'" class="form-control" type="text" name="nav6" value="' . $ds[ 'nav6' ] . '" />
    </div>
  </div>
  <div class="mb-3 row">
    <label class="col-md-4 control-label">Border-Top-Color:</label>
    <div id="cp2" class="input-group colorpicker-component col-md-7">
    <input data-toggle="tooltip" data-html="true" title="'.$_language->module['tooltip_4'].'" type="text" value="' . $ds[ 'nav5' ] . '" class="form-control" name="nav5" /><span class="input-group-text input-group-addon"><i></i></span> 
      </div>
  </div>

</div>
  <div class="col-md-6">

  <div class="mb-3 row">
    <label class="col-md-4 control-label">Main a:link:</label>
    <div id="cp3" class="input-group colorpicker-component col-md-7">
    <input data-toggle="tooltip" data-html="true" title="'.$_language->module['tooltip_5'].'" type="text" value="' . $ds[ 'nav7' ] . '" class="form-control" name="nav7" /><span class="input-group-text input-group-addon"><i></i></span> 
      </div>
  </div>
  <div class="mb-3 row">
    <label class="col-md-4 control-label">Main a:link hover:</label>
    <div id="cp4" class="input-group colorpicker-component col-md-7">
    <input data-toggle="tooltip" data-html="true" title="'.$_language->module['tooltip_6'].'" type="text" value="' . $ds[ 'nav8' ] . '" class="form-control" name="nav8" /><span class="input-group-text input-group-addon"><i></i></span> 
      </div>
  </div>

  <div class="mb-3 row">
    <label class="col-md-4 control-label">Main bg a:link hover:</label>
    <div id="cp69" class="input-group colorpicker-component col-md-7">
    <input data-toggle="tooltip" data-html="true" title="'.$_language->module['tooltip_7'].'" type="text" value="' . $ds[ 'nav9' ] . '" class="form-control" name="nav9" /><span class="input-group-text input-group-addon"><i></i></span> 
      </div>
  </div>

<div class="mb-3 row">
    <label class="col-md-4 control-label">Navi Text Alignment:</label>
    <div class="input-group col-md-7">

';   $nav_text = "<option value='ms-auto'>" . $_language->module[ 'navi_right_align' ] . "</option>
                    <option value='me-auto'>" . $_language->module[ 'navi_left_align' ] . "</option>";
    $nav_text = str_replace(
        "value='" . $ds[ 'nav_text_alignment' ] . "'",
        "value='" . $ds[ 'nav_text_alignment' ] . "' selected='selected'",
        $nav_text
    );

echo'
   <select class="form-select" name="nav_text_alignment" aria-label="Default select example">
   '.$nav_text.'
</select>

    </div>
  </div>  
  
 </div>

<hr>

<h4>'.$_language->module['navi_dropdown'].'</h4>

       
       <div class="col-md-6">
       <div class="mb-3 row">
    <label class="col-md-4 control-label">Sub a:link</label>
    <div id="cp5" class="input-group colorpicker-component col-md-7">
    <input data-toggle="tooltip" data-html="true" title="'.$_language->module['tooltip_8'].'" type="text" value="' . $ds[ 'nav3' ] . '" class="form-control" name="nav3" /><span class="input-group-text input-group-addon"><i></i></span> 
      </div>
  </div>

  <div class="mb-3 row">
    <label class="col-md-4 control-label">Sub a:link hover:</label>
    <div id="cp6" class="input-group colorpicker-component col-md-7">
    <input data-toggle="tooltip" data-html="true" title="'.$_language->module['tooltip_9'].'" type="text" value="' . $ds[ 'nav4' ] . '" class="form-control" name="nav4" /><span class="input-group-text input-group-addon"><i></i></span> 
      </div>
  </div>  

</div>

 <div class="col-md-6">  

  <div class="mb-3 row">
    <label class="col-md-4 control-label">Sub bg:</label>
    <div id="cp75" class="input-group colorpicker-component col-md-7">
    <input data-toggle="tooltip" data-html="true" title="'.$_language->module['tooltip_10'].'" type="text" value="' . $ds[ 'nav10' ] . '" class="form-control" name="nav10" /><span class="input-group-text input-group-addon"><i></i></span> 
      </div>
  </div>

   <div class="mb-3 row">
    <label class="col-md-4 control-label">Sub bg a:hover:</label>
    <div id="cp70" class="input-group colorpicker-component col-md-7">
    <input data-toggle="tooltip" data-html="true" title="'.$_language->module['tooltip_11'].'" type="text" value="' . $ds[ 'nav11' ] . '" class="form-control" name="nav11" /><span class="input-group-text input-group-addon"><i></i></span> 
      </div>
  </div>

       </div>

</div></div>
       
      
      
    </div>
  </div>

<!-- =========================================================================================================================================== -->


<div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingTwo">
      <button class="accordion-button collapsed alert alert-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
        '.$_language->module['logo_logo_login'].'
      </button>
    </h2>
    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">
        <h4>'.$_language->module['navi_navigation'].'</h4>
<div class="row"> 
<div class="col-md-6">

<div class="mb-6 row">
    <label class="col-md-4 control-label">'.$_language->module['current_banner'].':</label>
    <div class="col-md-2 btn btn-info border border-secondary" style="margin: 5px;margin-left: 10px;">
      '.$pic1.'
    </div>
    </div>
<div class="mb-6 row">
    <label class="col-md-4 control-label">'.$_language->module['banner'].':</label>
    <div class="col-md-8"><span class="text-muted small"><em>
      <input class="btn btn-info" name="logo_pic" type="file" size="40" /> <small>(max. 1000x500)</small></em></span>

    </div>
  </div>

  </div>
  <div class="col-md-6">

  <div class="mb-6 row">
    <label class="col-md-4 control-label">'.$_language->module['logo_name_web'].':</label>
    <div class="input-group col-md-7">
   <input data-toggle="tooltip" data-html="true" title="'.$_language->module['tooltip_12'].'" class="form-control" type="text" name="logotext1" value="' . $ds[ 'logotext1' ] . '" />
    </div>
  </div>
  <div class="mb-6 row">
    <label class="col-md-4 control-label">'.$_language->module['logo_name_slogan'].':</label>
    <div class="input-group col-md-7">
   <input data-toggle="tooltip" data-html="true" title="'.$_language->module['tooltip_13'].'" class="form-control" type="text" name="logotext2" value="' . $ds[ 'logotext2' ] . '" />
    </div>
  </div>

   </div>
    </div>
<hr>
<h4>Login</h4>
    <div class="row"> 
<div class="col-md-6">

<div class="mb-6 row">
    <label class="col-md-4 control-label">'.$_language->module['login_banner'].':</label>
    <div class="col-md-2 btn btn-info border border-secondary" style="margin: 5px;margin-left: 10px;">
      '.$pic2.'
    </div>
    </div>
<div class="mb-6 row">
    <label class="col-md-4 control-label">'.$_language->module['banner'].':</label>
    <div class="col-md-8"><span class="text-muted small"><em>
      <input class="btn btn-info" name="reg_pic" type="file" size="40" /> <small>(max. 1920x1020)</small></em></span>
    </div>
  </div>

  </div>
  <div class="col-md-6">

  <!--<div class="mb-6 row">
    <label class="col-md-4 control-label">Image Color:</label>
    <div id="cp73" class="input-group colorpicker-component col-md-7">
    <input data-toggle="tooltip" data-html="true" title="'.$_language->module['tooltip_14'].'" type="text" value="' . $ds[ 'reg1' ] . '" class="form-control" name="reg1" /><span class="input-group-text input-group-addon"><i></i></span> 
    </div>
  </div>-->

  <div class="mb-6 row">
    <label class="col-md-4 control-label">Image Text Color:</label>
    <div id="cp74" class="input-group colorpicker-component col-md-7">
    <input data-toggle="tooltip" data-html="true" title="'.$_language->module['tooltip_15'].'" type="text" value="' . $ds[ 'reg2' ] . '" class="form-control" name="reg2" /><span class="input-group-text input-group-addon"><i></i></span> 
    </div>
  </div>

   </div>
    </div>
      </div>
    </div>
  </div>

<!-- =========================================================================================================================================== -->

<div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingThree">
      <button class="accordion-button collapsed alert alert-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
        Body
      </button>
    </h2>
    <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">
        <h4>'.$_language->module['body_setting'].'</h4>
<div class="col-md-12">
 <div class="row">
 
    <div class="col-md-4" style="background: '.$ds['body3'].'; height: 280px;">
     <p style="color: '.$ds['body4'].';">(Background Color)</p>
        <h1 style="color: '.$ds['body4'].';">h1. Heading 1</h1>
        <h2 style="color: '.$ds['body4'].';">h2. Heading 2</h2>
        <h3 style="color: '.$ds['body4'].';">h3. Heading 3</h3>
        <h4 style="color: '.$ds['body4'].';">h4. Heading 4</h4>
        <h5 style="color: '.$ds['body4'].';">h5. Heading 5</h5>
        <h6 style="color: '.$ds['body4'].';">h6. Heading 6</h6>
    </div>
    
    
    <div class="col-md-4" style="background: '.$ds['body3'].'; height: 280px;">
      <h3 style="color: '.$ds['body4'].';">'.$_language->module['body_example'].'</h3>
      <p style="font-size: '.$ds['body2'].'; color: '.$ds['body4'].';">Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
      <p style="font-size: '.$ds['body2'].'; color: '.$ds['body4'].';">Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Donec sed odio dui.</p>
    </div>
  
    <div class="col-md-4" style="background: '.$ds['body3'].'; height: 280px;">
       <h3 style="color: '.$ds['body4'].';">'.$_language->module['body_example_addresses'].'</h3>
      <address  style="font-size: '.$ds['body2'].'; color: '.$ds['body4'].';">
        <strong>Twitter, Inc.</strong><br>
        795 Folsom Ave, Suite 600<br>
        San Francisco, CA 94107<br>
        <abbr title="Phone">P:</abbr> (123) 456-7890
      </address>
      <address style="font-size: '.$ds['body2'].'; color: '.$ds['body4'].';">
        <strong>Full Name</strong><br>
        <a style="color: '.$ds['typo4'].';" href="mailto:#">first.last@gmail.com</a>
      </address>

      <hr>
    </div>

  </div>
<br>
</div>
<hr>

<div class="row">
<div class="col-md-12 row">
<div class="col-md-6">

   <div class="mb-3 row">
    <label class="col-md-4 control-label">Font-family:</label>
    <div class="input-group col-md-7">
   <!--<textarea class="form-control" type="text" name="body1" value="' . $ds[ 'body1' ] . '" rows="3"/>' . $ds[ 'body1' ] . '</textarea>-->

';   $body_font_family = "<option value='Default'>Standart</option>
                    <option value='Roboto'>Roboto</option>
                    <option value='Rajdhani'>Rajdhani</option>                    
                    <option value='Neucha'>Neucha</option>
                    <option value='Noto'>Noto Sans</option>
                    <option value='Playfair'>Playfair Display</option>";
    $body_font_family = str_replace(
        "value='" . $ds[ 'body1' ] . "'",
        "value='" . $ds[ 'body1' ] . "' selected='selected'",
        $body_font_family
    );


echo'
   <select class="form-select" name="body1" aria-label="Default select example">
   '.$body_font_family.'
</select>

    </div>
  </div>
  <div class="mb-3 row">
    <label class="col-md-4 control-label">Font-size:</label>
    <div class="input-group col-md-7">
   <input class="form-control" type="text" name="body2" value="' . $ds[ 'body2' ] . '" />
    </div>
  </div>


  <div class="mb-3 row">
  <label class="col-md-4 control-label">'.$_language->module['background_pic'].':</label>
  <div class="col-md-12">
    <div class="input-group col-md-12 btn btn-info border border-secondary">
      '.$pic3.'
    </div>
    </div>
    </div>
  <div class="mb-3 row">
    <label class="col-md-3 control-label">'.$_language->module['banner'].':</label>
    <div class="col-md-12">
    <div class="col-md-12"><span class="text-muted small"><em>
      <input class="btn btn-info" name="background_pic" type="file" size="40" /></em></span> 
       <!-- Button trigger modal -->
    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirm-delete" data-href="admincenter.php?site=settings_templates&amp;delete_pic=true&amp;themeID='.$ds['themeID'].'&amp;captcha_hash='.$hash.'">
    ' . $_language->module['delete_background_pic'] . '
    </button><br> <small>(max. 1000x500)</small>
    <!-- Button trigger modal END-->

     <!-- Modal -->
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">'.$_language->module['background_pic'].'</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="'.$_language->module['close'].'"></button>
      </div>
      <div class="modal-body"><p>' . $_language->module['really_delete_background_pic'].'</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">'.$_language->module['close'].'</button>
        <a class="btn btn-danger btn-ok">' . $_language->module['delete_background_pic'] . '</a>
      </div>
    </div>
  </div>
</div>
<!-- Modal END -->

    </div>
  </div>
</div>


  </div>
  <div class="col-md-6">

  <div class="mb-3 row">
    <label class="col-md-4 control-label">Background Primare:</label>
    <div id="cp7" class="input-group colorpicker-component col-md-7">
    <input type="text" value="' . $ds[ 'body3' ] . '" class="form-control" name="body3" /><span class="input-group-text input-group-addon"><i></i></span> 
    </div>
  </div>
  <div class="mb-3 row">
    <label class="col-md-4 control-label">Background Secondar:</label>
    <div id="cp77" class="input-group colorpicker-component col-md-7">
    <input type="text" value="' . $ds[ 'body5' ] . '" class="form-control" name="body5" /><span class="input-group-text input-group-addon"><i></i></span> 
    </div>
  </div>

  <div class="mb-3 row">
    <label class="col-md-4 control-label">Font Color:</label>
    <div id="cp8" class="input-group colorpicker-component col-md-7">
    <input type="text" value="' . $ds[ 'body4' ] . '" class="form-control" name="body4" /><span class="input-group-text input-group-addon"><i></i></span> 
    </div>
  </div>

  <div class="mb-3 row">
    <label class="col-md-4 control-label">Font a color:</label>
    <div id="cp12" class="input-group colorpicker-component col-md-7">
    <input type="text" value="' . $ds[ 'typo4' ] . '" class="form-control" name="typo4" /><span class="input-group-text input-group-addon"><i></i></span> 
    </div>
  </div>
  
<div class="mb-3 row">
    <label class="col-md-4 control-label">Font a hover:</label>
    <div id="cp13" class="input-group colorpicker-component col-md-7">
    <input type="text" value="' . $ds[ 'typo8' ] . '" class="form-control" name="typo8" /><span class="input-group-text input-group-addon"><i></i></span> 
    </div>
  </div>

</div>


<!--</div>

<hr>
<div class="col-md-12 row">-->


<div class="col-md-6">
<!--
<div class="mb-3 row">
    <label class="col-md-4 control-label">Well bg-color:</label>
    <div id="cp9" class="input-group colorpicker-component col-md-7">
    <input type="text" value="' . $ds[ 'typo1' ] . '" class="form-control" name="typo1" /><span class="input-group-text input-group-addon"><i></i></span> 
    </div>
  </div>
  
    <div class="mb-3 row">
    <label class="col-md-4 control-label">H color:</label>
    <div id="cp10" class="input-group colorpicker-component col-md-7">
    <input type="text" value="' . $ds[ 'typo2' ] . '" class="form-control" name="typo2" /><span class="input-group-text input-group-addon"><i></i></span> 
    </div>
  </div>

<div class="mb-3 row">
    <label class="col-md-4 control-label">H6 color:</label>
    <div id="cp11" class="input-group colorpicker-component col-md-7">
    <input type="text" value="' . $ds[ 'typo3' ] . '" class="form-control" name="typo3" /><span class="input-group-text input-group-addon"><i></i></span> 
    </div>
  </div>
  
  <div class="mb-3 row">
    <label class="col-md-4 control-label">frei typo5:</label>
    <div class="input-group col-md-7">
   <input class="form-control" type="text" name="typo5" value="' . $ds[ 'typo5' ] . '" />
    </div>
  </div>
-->

</div>
<div class="col-md-6">

<!--

  
    <div class="mb-3 row">
    <label class="col-md-4 control-label">hr color:</label>
    <div id="cp14" class="input-group colorpicker-component col-md-7">
    <input type="text" value="' . $ds[ 'typo6' ] . '" class="form-control" name="typo6" /><span class="input-group-text input-group-addon"><i></i></span> 
    </div>
  </div>

<div class="mb-3 row">
    <label class="col-md-4 control-label">hr border:</label>
    <div class="input-group col-md-7">
   <input class="form-control" type="text" name="typo7" value="' . $ds[ 'typo7' ] . '" />
    </div>
  </div>
-->
</div>
</div>


</div>
<hr>
<div class="row">
<div class="col-md-6">
<h4>Card Settings</h4>
<div class="mb-3 row">
    <label class="col-md-4 control-label">card bg:</label>
    <div id="cp71" class="input-group colorpicker-component col-md-7">
    <input type="text" value="' . $ds[ 'card1' ] . '" class="form-control" name="card1" /><span class="input-group-text input-group-addon"><i></i></span> 
    </div>
  </div>

  
<div class="mb-3 row">
    <label class="col-md-4 control-label">card border color:</label>
    <div id="cp72" class="input-group colorpicker-component col-md-7">
    <input type="text" value="' . $ds[ 'card2' ] . '" class="form-control" name="card2" /><span class="input-group-text input-group-addon"><i></i></span> 
    </div>
  </div>

  <div class="mb-3 row">
<label class="col-md-4 control-label">border-radius:</label>
    <div class="input-group col-md-12">
    <input class="form-control" type="text" name="border_radius" value="' . $ds[ 'border_radius' ] . '" /> 
    </div>
  </div>
</div>

  <div class="col-md-6">

  <div class="card">
  <div class="card-body" style="background-color: '.$ds['card1'].';border-color: ' . $ds[ 'card2' ] . ';border-radius: ' . $ds[ 'border_radius' ] . ';">
    <p style="color: '.$ds['body4'].';">This is some text within a card body.</p>
  </div>
</div>

  </div>
</div>

      </div>
    </div>
  </div>

<!-- =========================================================================================================================================== -->
';


$themeID = $_GET[ 'themeID' ];
    $ergebnis = safe_query("SELECT * FROM " . PREFIX . "settings_themes WHERE themeID='$themeID'");
    $dy = mysqli_fetch_array($ergebnis);

if ($dy[ 'headlines' ] == 'headlines_01.css') {
        $headlines_01 = '<input class="form-check-input" id="activeactive" type="radio" name="radio3" value="headlines_01.css" checked="checked" />';
    } else {
        $headlines_01 = '<input class="form-check-input" id="active" type="radio" name="radio3" value="headlines_01.css">';
    }

    if ($dy[ 'headlines' ] == 'headlines_02.css') {
        $headlines_02 = '<input class="form-check-input" id="activeactive" type="radio" name="radio3" value="headlines_02.css" checked="checked" />';
    } else {
        $headlines_02 = '<input class="form-check-input" id="active" type="radio" name="radio3" value="headlines_02.css">';
    }

    if ($dy[ 'headlines' ] == 'headlines_03.css') {
        $headlines_03 = '<input class="form-check-input" id="activeactive" type="radio" name="radio3" value="headlines_03.css" checked="checked" />';
    } else {
        $headlines_03 = '<input class="form-check-input" id="active" type="radio" name="radio3" value="headlines_03.css">';
    }

    if ($dy[ 'headlines' ] == 'headlines_04.css') {
        $headlines_04 = '<input class="form-check-input" id="activeactive" type="radio" name="radio3" value="headlines_04.css" checked="checked" />';
    } else {
        $headlines_04 = '<input class="form-check-input" id="active" type="radio" name="radio3" value="headlines_04.css">';
    }

    if ($dy[ 'headlines' ] == 'headlines_05.css') {
        $headlines_05 = '<input class="form-check-input" id="activeactive" type="radio" name="radio3" value="headlines_05.css" checked="checked" />';
    } else {
        $headlines_05 = '<input class="form-check-input" id="active" type="radio" name="radio3" value="headlines_05.css">';
    }

    if ($dy[ 'headlines' ] == 'headlines_06.css') {
        $headlines_06 = '<input class="form-check-input" id="activeactive" type="radio" name="radio3" value="headlines_06.css" checked="checked" />';
    } else {
        $headlines_06 = '<input class="form-check-input" id="active" type="radio" name="radio3" value="headlines_06.css">';
    }

    if ($dy[ 'headlines' ] == 'headlines_07.css') {
        $headlines_07 = '<input class="form-check-input" id="activeactive" type="radio" name="radio3" value="headlines_07.css" checked="checked" />';
    } else {
        $headlines_07 = '<input class="form-check-input" id="active" type="radio" name="radio3" value="headlines_07.css">';
    }

    if ($dy[ 'headlines' ] == 'headlines_08.css') {
        $headlines_08 = '<input class="form-check-input" id="activeactive" type="radio" name="radio3" value="headlines_08.css" checked="checked" />';
    } else {
        $headlines_08 = '<input class="form-check-input" id="active" type="radio" name="radio3" value="headlines_08.css">';
    }

    if ($dy[ 'headlines' ] == 'headlines_09.css') {
        $headlines_09 = '<input class="form-check-input" id="activeactive" type="radio" name="radio3" value="headlines_09.css" checked="checked" />';
    } else {
        $headlines_09 = '<input class="form-check-input" id="active" type="radio" name="radio3" value="headlines_09.css">';
    }

    if ($dy[ 'headlines' ] == 'headlines_10.css') {
        $headlines_10 = '<input class="form-check-input" id="activeactive" type="radio" name="radio3" value="headlines_10.css" checked="checked" />';
    } else {
        $headlines_10 = '<input class="form-check-input" id="active" type="radio" name="radio3" value="headlines_10.css">';
    }

echo'

<div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingFour">
      <button class="accordion-button collapsed alert alert-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseTwo">
        '.$_language->module['head_headlines'].'
      </button>
    </h2>
    <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">
        <h4>Headlines</h4>
<div class="row"> 
<div class="col-md-6">

<div class="form-check">
  '.$headlines_01.'
  <label class="form-check-label" for="flexRadioDefault1">
    '.$_language->module['head_headlines1'].'</label> 
</div>
<img style="border:1px solid #000;height:185px" src="/../components/admin/images/headlines/headlines-01.jpg" title="'.$_language->module['head_headlines1'].'" >
<hr>
<div class="form-check">
  '.$headlines_02.'
  <label class="form-check-label" for="flexRadioDefault2">
    '.$_language->module['head_headlines2'].'
  </label>
</div>
<img style="border:1px solid #000;height:185px" src="/../components/admin/images/headlines/headlines-02.jpg" title="'.$_language->module['head_headlines2'].'" >
<hr>
<div class="form-check">
  '.$headlines_03.'
  <label class="form-check-label" for="flexRadioDefault3">
    '.$_language->module['head_headlines3'].' 
  </label>
</div>
<img style="border:1px solid #000;height:185px" src="/../components/admin/images/headlines/headlines-03.jpg" title="'.$_language->module['head_headlines3'].'" >
<hr>
<div class="form-check">
  '.$headlines_04.'
  <label class="form-check-label" for="flexRadioDefault4">
    '.$_language->module['head_headlines4'].' 
  </label>
</div>
<img style="border:1px solid #000;height:185px" src="/../components/admin/images/headlines/headlines-04.jpg" title="'.$_language->module['head_headlines4'].'" >
<hr>
<div class="form-check">
  '.$headlines_05.'
  <label class="form-check-label" for="flexRadioDefault5">
    '.$_language->module['head_headlines5'].' 
  </label>
</div>
<img style="border:1px solid #000;height:185px" src="/../components/admin/images/headlines/headlines-05.jpg" title="'.$_language->module['head_headlines5'].'" >

  </div>
  <div class="col-md-6">

  <div class="form-check">
  '.$headlines_06.'
  <label class="form-check-label" for="flexRadioDefault6">
    '.$_language->module['head_headlines6'].'  
  </label>
</div>
<img style="border:1px solid #000;height:185px" src="/../components/admin/images/headlines/headlines-06.jpg" title="'.$_language->module['head_headlines6'].'" >
<hr>
<div class="form-check">
  '.$headlines_07.'
  <label class="form-check-label" for="flexRadioDefault7">
    '.$_language->module['head_headlines7'].'  
  </label>
</div>
<img style="border:1px solid #000;height:185px" src="/../components/admin/images/headlines/headlines-07.jpg" title="'.$_language->module['head_headlines7'].'" >
<hr>
<div class="form-check">
  '.$headlines_08.'
  <label class="form-check-label" for="flexRadioDefault8">
    '.$_language->module['head_headlines8'].'  
  </label>
</div>
<img style="border:1px solid #000;height:185px" src="/../components/admin/images/headlines/headlines-08.jpg" title="'.$_language->module['head_headlines8'].'" >
<hr>
<div class="form-check">
  '.$headlines_09.'
  <label class="form-check-label" for="flexRadioDefault9">
    '.$_language->module['head_headlines9'].'  
  </label>
</div>
<img style="border:1px solid #000;height:185px" src="/../components/admin/images/headlines/headlines-09.jpg" title="'.$_language->module['head_headlines9'].'" >
<hr>
<div class="form-check">
  '.$headlines_10.'
  <label class="form-check-label" for="flexRadioDefault10">
    '.$_language->module['head_headlines10'].'  
  </label>
</div>
<img style="border:1px solid #000;height:185px" src="/../components/admin/images/headlines/headlines-10.jpg" title="'.$_language->module['head_headlines10'].'" >

   </div>
    </div>
      </div>
    </div>
  </div>


<!-- =========================================================================================================================================== -->

<div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingFive">
      <button class="accordion-button collapsed alert alert-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFour">
        '.$_language->module['buttons_set'].'
      </button>
    </h2>
    <div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingFive" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">
  
      <!-- ================Button=========================== -->
      ';

    $ergebnis = safe_query("SELECT * FROM " . PREFIX . "settings_buttons WHERE modulname='".getinput($ds['modulname'])."'");
    $db = mysqli_fetch_array($ergebnis);
echo'
      <div class="col-md-12 row">

<div class="col-md-1 p-3 mb-2 bg-secondary text-white" align="center"><b>'.$_language->module['buttons_button'].':</b></div>
<div class="col-md-2 p-3 mb-2 bg-secondary text-white" align="center"><b>'.$_language->module['buttons_background'].':</b></div>
<div class="col-md-2 p-3 mb-2 bg-secondary text-white" align="center"><b>'.$_language->module['buttons_hover'].':</b></div>
<div class="col-md-2 p-3 mb-2 bg-secondary text-white" align="center"><b>'.$_language->module['buttons_font'].':</b></div>
<div class="col-md-2 p-3 mb-2 bg-secondary text-white" align="center"><b>'.$_language->module['buttons_border'].':</b></div>
<div class="col-md-2 p-3 mb-2 bg-secondary text-white" align="center"><b>'.$_language->module['buttons_hover_color'].':</b></div>
<div class="col-md-1 p-3 mb-2 bg-secondary text-white" align="center"><b>&nbsp;</b></div>
<div class="col-md-12 p-2" align="center"><b>&nbsp;</b></div>

<div class="col-md-1">
<div class="mb-3 row">
<label class="control-label">
<button class="btn btn-primary custom" />Primary</button></label>

</div>
</div>


<div class="col-md-2">
  <div class="mb-3 row">
    <label class="col-md-12">#007bff</label>
    <div id="cp18" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button1' ] . '" class="form-control" name="button1" /><span class="input-group-text input-group-addon"><i></i></span> 
    </div>
  </div>
  </div>
  <div class="col-md-2">
  <div class="mb-3 row">
  <label class="col-md-12">#0069d9</label>
    <div id="cp19" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button2' ] . '" class="form-control" name="button2" /><span class="input-group-text input-group-addon"><i></i></span> 
    </div>
  </div>

  </div>
  <div class="col-md-2">
 <div class="mb-3 row">
 <label class="col-md-12">#ffffff</label>
     <div id="cp20" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button3' ] . '" class="form-control" name="button3" /><span class="input-group-text input-group-addon"><i></i></span> 
    </div>
  </div>
</div>

<div class="col-md-2">
 <div class="mb-3 row">
 <label class="col-md-12">#007bff</label>
     <div id="cp21" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button4' ] . '" class="form-control" name="button4" /><span class="input-group-text input-group-addon"><i></i></span> 
    </div>
  </div>
</div>


<div class="col-md-2">
 <div class="mb-3 row">
 <label class="col-md-12">#0062cc</label>
     <div id="cp22" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button5' ] . '" class="form-control" name="button5" /><span class="input-group-text input-group-addon"><i></i></span> 
    </div>
  </div>
</div>

<div class="col-md-12">
<div class="mb-3 row">
<label class="col-md-1">Code:</label>
<div class="col-md-10">
<pre><code class="language-html">&lt;button type=&quot;button&quot; class=&quot;btn btn-primary&quot;&gt;Primary&lt;/button&gt;</code></pre>
</div>
</div>
<hr>
</div>


<div class="col-md-1">
<div class="mb-3 row">
<label class="control-label">
<button class="btn btn-secondary custom" />Secondary</button></label>

</div>
</div>


<div class="col-md-2">

<div class="mb-3 row">
    <label class="col-md-12">#6c757d</label>
    <div id="cp23" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button6' ] . '" class="form-control" name="button6" /><span class="input-group-text input-group-addon"><i></i></span> 
    </div>
  </div>
  </div>
  <div class="col-md-2">

  <div class="mb-3 row">
  <label class="col-md-12">#5a6268</label>
    <div id="cp24" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button7' ] . '" class="form-control" name="button7" /><span class="input-group-text input-group-addon"><i></i></span> 
    </div>
  </div>

  </div>
  <div class="col-md-2">
 <div class="mb-3 row">
 <label class="col-md-12">#ffffff</label>
     <div id="cp25" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button8' ] . '" class="form-control" name="button8" /><span class="input-group-text input-group-addon"><i></i></span> 
    </div>
  </div>
</div>

<div class="col-md-2">
 <div class="mb-3 row">
 <label class="col-md-12">#6c757d</label>
     <div id="cp26" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button9' ] . '" class="form-control" name="button9" /><span class="input-group-text input-group-addon"><i></i></span> 
    </div>
  </div>
</div>

<div class="col-md-2">
 <div class="mb-3 row">
 <label class="col-md-12">#545b62</label>
     <div id="cp27" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button10' ] . '" class="form-control" name="button10" /><span class="input-group-text input-group-addon"><i></i></span> 
    </div>
  </div>
</div>

<div class="col-md-12">
<div class="mb-3 row">
<label class="col-md-1">Code:</label>
<div class="col-md-10">
<pre><code class="language-html">&lt;button type=&quot;button&quot; class=&quot;btn btn-secondary&quot;&gt;Secondary&lt;/button&gt;</code></pre>
</div>
</div>
<hr>
</div>


<div class="col-md-1">
<div class="mb-3 row">
<label class="control-label">
<button class="btn btn-success custom" />Success</button></label>

</div>
</div>

<div class="col-md-2">

<div class="mb-3 row">
    <label class="col-md-12">#28a745</label>
    <div id="cp28" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button11' ] . '" class="form-control" name="button11" /><span class="input-group-text input-group-addon"><i></i></span> 
    </div>
  </div>
  </div>
  <div class="col-md-2">

  <div class="mb-3 row">
  <label class="col-md-12">#218838</label>
    <div id="cp29" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button12' ] . '" class="form-control" name="button12" /><span class="input-group-text input-group-addon"><i></i></span> 
    </div>
  </div>

  </div>
  <div class="col-md-2">
 <div class="mb-3 row">
 <label class="col-md-12">#ffffff</label>
     <div id="cp30" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button13' ] . '" class="form-control" name="button13" /><span class="input-group-text input-group-addon"><i></i></span> 
    </div>
  </div>
</div>

<div class="col-md-2">
 <div class="mb-3 row">
 <label class="col-md-12">#28a745</label>
     <div id="cp31" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button14' ] . '" class="form-control" name="button14" /><span class="input-group-text input-group-addon"><i></i></span> 
    </div>
  </div>
</div>

<div class="col-md-2">
 <div class="mb-3 row">
 <label class="col-md-12">#1e7e34</label>
     <div id="cp32" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button15' ] . '" class="form-control" name="button15" /><span class="input-group-text input-group-addon"><i></i></span> 
    </div>
  </div>
</div>

<div class="col-md-12">
<div class="mb-3 row">
<label class="col-md-1">Code:</label>
<div class="col-md-10">
<pre><code class="language-html">&lt;button type=&quot;button&quot; class=&quot;btn btn-success&quot;&gt;Success&lt;/button&gt;</code></pre>
</div>
</div>
<hr>
</div>


<div class="col-md-1">
<div class="mb-3 row">
<label class="control-label">
<button class="btn btn-danger custom" />Danger</button></label>

</div>
</div>

<div class="col-md-2">

<div class="mb-3 row">
    <label class="col-md-12">#dc3545</label>
    <div id="cp33" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button16' ] . '" class="form-control" name="button16" /><span class="input-group-text input-group-addon"><i></i></span> 
    </div>
  </div>
  </div>
  <div class="col-md-2">

  <div class="mb-3 row">
  <label class="col-md-12">#c82333</label>
    <div id="cp34" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button17' ] . '" class="form-control" name="button17" /><span class="input-group-text input-group-addon"><i></i></span> 
    </div>
  </div>

  </div>
  <div class="col-md-2">
 <div class="mb-3 row">
 <label class="col-md-12">#ffffff</label>
     <div id="cp35" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button18' ] . '" class="form-control" name="button18" /><span class="input-group-text input-group-addon"><i></i></span> 
    </div>
  </div>
</div>

<div class="col-md-2">
 <div class="mb-3 row">
 <label class="col-md-12">#dc3545</label>
     <div id="cp36" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button19' ] . '" class="form-control" name="button19" /><span class="input-group-text input-group-addon"><i></i></span> 
    </div>
  </div>
</div>

<div class="col-md-2">
 <div class="mb-3 row">
 <label class="col-md-12">#bd2130</label>
     <div id="cp37" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button20' ] . '" class="form-control" name="button20" /><span class="input-group-text input-group-addon"><i></i></span> 
    </div>
  </div>
</div>

<div class="col-md-12">
<div class="mb-3 row">
<label class="col-md-1">Code:</label>
<div class="col-md-10">
<pre><code class="language-html">&lt;button type=&quot;button&quot; class=&quot;btn btn-danger&quot;&gt;Danger&lt;/button&gt;</code></pre>
</div>
</div>
<hr>
</div>


<div class="col-md-1">
<div class="mb-3 row">
<label class="control-label">
<button class="btn btn-warning custom" />Warning</button></label>

</div>
</div>

<div class="col-md-2">

<div class="mb-3 row">
    <label class="col-md-12">#ffc107</label>
    <div id="cp38" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button21' ] . '" class="form-control" name="button21" /><span class="input-group-text input-group-addon"><i></i></span> 
    </div>
  </div>
  </div>
  <div class="col-md-2">

  <div class="mb-3 row">
  <label class="col-md-12">#e0a800</label>
    <div id="cp39" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button22' ] . '" class="form-control" name="button22" /><span class="input-group-text input-group-addon"><i></i></span> 
    </div>
  </div>

  </div>
  <div class="col-md-2">
 <div class="mb-3 row">
 <label class="col-md-12">#212529</label>
     <div id="cp40" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button23' ] . '" class="form-control" name="button23" /><span class="input-group-text input-group-addon"><i></i></span> 
    </div>
  </div>
</div>

<div class="col-md-2">
 <div class="mb-3 row">
 <label class="col-md-12">#ffc107</label>
     <div id="cp41" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button24' ] . '" class="form-control" name="button24" /><span class="input-group-text input-group-addon"><i></i></span> 
    </div>
  </div>
</div>

<div class="col-md-2">
 <div class="mb-3 row">
 <label class="col-md-12">#d39e00</label>
     <div id="cp42" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button25' ] . '" class="form-control" name="button25" /><span class="input-group-text input-group-addon"><i></i></span> 
    </div>
  </div>
</div>

<div class="col-md-12">
<div class="mb-3 row">
<label class="col-md-1">Code:</label>
<div class="col-md-10">
<pre><code class="language-html">&lt;button type=&quot;button&quot; class=&quot;btn btn-warning&quot;&gt;Warning&lt;/button&gt;</code></pre>
</div>
</div>
<hr>
</div>


<div class="col-md-1">
<div class="mb-3 row">
<label class="control-label">
<button class="btn btn-info custom" />Info</button></label>

</div>
</div>


<div class="col-md-2">

<div class="mb-3 row">
    <label class="col-md-12">#17a2b8</label>
    <div id="cp43" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button26' ] . '" class="form-control" name="button26" /><span class="input-group-text input-group-addon"><i></i></span> 
    </div>
  </div>
  </div>
  <div class="col-md-2">

  <div class="mb-3 row">
  <label class="col-md-12">#138496</label>
    <div id="cp44" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button27' ] . '" class="form-control" name="button27" /><span class="input-group-text input-group-addon"><i></i></span> 
    </div>
  </div>

  </div>
  <div class="col-md-2">
 <div class="mb-3 row">
 <label class="col-md-12">#ffffff</label>
     <div id="cp45" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button28' ] . '" class="form-control" name="button28" /><span class="input-group-text input-group-addon"><i></i></span> 
    </div>
  </div>
</div>

<div class="col-md-2">
 <div class="mb-3 row">
 <label class="col-md-12">#17a2b8</label>
     <div id="cp46" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button29' ] . '" class="form-control" name="button29" /><span class="input-group-text input-group-addon"><i></i></span> 
    </div>
  </div>
</div>

<div class="col-md-2">
 <div class="mb-3 row">
 <label class="col-md-12">#117a8b</label>
     <div id="cp47" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button30' ] . '" class="form-control" name="button30" /><span class="input-group-text input-group-addon"><i></i></span> 
    </div>
  </div>
</div>

<div class="col-md-12">
<div class="mb-3 row">
<label class="col-md-1">Code:</label>
<div class="col-md-10">
<pre><code class="language-html">&lt;button type=&quot;button&quot; class=&quot;btn btn-info&quot;&gt;Info&lt;/button&gt;</code></pre>
</div>
</div>
<hr>
</div>


<div class="col-md-1">
<div class="mb-3 row">
<label class="control-label">
<button class="btn btn-light custom" />Light</button></label>

</div>
</div>


<div class="col-md-2">

<div class="mb-3 row">
    <label class="col-md-12">#f8f9fa</label>
    <div id="cp48" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button31' ] . '" class="form-control" name="button31" /><span class="input-group-text input-group-addon"><i></i></span> 
    </div>
  </div>
  </div>
  <div class="col-md-2">

  <div class="mb-3 row">
  <label class="col-md-12">#e2e6ea</label>
    <div id="cp49" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button32' ] . '" class="form-control" name="button32" /><span class="input-group-text input-group-addon"><i></i></span> 
    </div>
  </div>

  </div>
  <div class="col-md-2">
 <div class="mb-3 row">
 <label class="col-md-12">#212529</label>
     <div id="cp50" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button33' ] . '" class="form-control" name="button33" /><span class="input-group-text input-group-addon"><i></i></span> 
    </div>
  </div>
</div>

<div class="col-md-2">
 <div class="mb-3 row">
 <label class="col-md-12">#f8f9fa</label>
     <div id="cp51" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button34' ] . '" class="form-control" name="button34" /><span class="input-group-text input-group-addon"><i></i></span> 
    </div>
  </div>
</div>

<div class="col-md-2">
 <div class="mb-3 row">
 <label class="col-md-12">#dae0e5</label>
     <div id="cp52" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button35' ] . '" class="form-control" name="button35" /><span class="input-group-text input-group-addon"><i></i></span> 
    </div>
  </div>
</div>

<div class="col-md-12">
<div class="mb-3 row">
<label class="col-md-1">Code:</label>
<div class="col-md-10">
<pre><code class="language-html">&lt;button type=&quot;button&quot; class=&quot;btn btn-light&quot;&gt;Light&lt;/button&gt;</code></pre>
</div>
</div>
<hr>
</div>


<div class="col-md-1">
<div class="mb-3 row">
<label class="control-label">
<button class="btn btn-dark custom" />Dark</button></label>

</div>
</div>


<div class="col-md-2">

<div class="mb-3 row">
    <label class="col-md-12">#343a40</label>
    <div id="cp53" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button36' ] . '" class="form-control" name="button36" /><span class="input-group-text input-group-addon"><i></i></span> 
    </div>
  </div>
  </div>
  <div class="col-md-2">

  <div class="mb-3 row">
  <label class="col-md-12">#23272b</label>
    <div id="cp54" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button37' ] . '" class="form-control" name="button37" /><span class="input-group-text input-group-addon"><i></i></span> 
    </div>
  </div>

  </div>
  <div class="col-md-2">
 <div class="mb-3 row">
 <label class="col-md-12">#ffffff</label>
     <div id="cp55" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button38' ] . '" class="form-control" name="button38" /><span class="input-group-text input-group-addon"><i></i></span> 
    </div>
  </div>
</div>

<div class="col-md-2">
 <div class="mb-3 row">
 <label class="col-md-12">#343a40</label>
     <div id="cp56" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button39' ] . '" class="form-control" name="button39" /><span class="input-group-text input-group-addon"><i></i></span> 
    </div>
  </div>
</div>

<div class="col-md-2">
 <div class="mb-3 row">
 <label class="col-md-12">#1d2124</label>
     <div id="cp57" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button40' ] . '" class="form-control" name="button40" /><span class="input-group-text input-group-addon"><i></i></span> 
    </div>
  </div>
</div>

<div class="col-md-12">
<div class="mb-3 row">
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
<div class="mb-3 row">
<label class="control-label">
<button class="btn btn-link" />Link</button></label>

</div>
</div>



<div class="col-md-2">
<div class="mb-3 row">
    <label class="col-md-12">#007bff</label>
    <div id="cp58" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button41' ] . '" class="form-control" name="button41" /><span class="input-group-text input-group-addon"><i></i></span> 
    </div>
  </div>
  </div>
  <div class="col-md-2">
<div class="mb-3 row">
  <label class="col-md-12">#0056b3</label>
    <div id="cp59" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $db[ 'button42' ] . '" class="form-control" name="button42" /><span class="input-group-text input-group-addon"><i></i></span> 
    </div>
  </div>
</div>

<div class="col-md-12">
<div class="mb-3 row">
<label class="col-md-1">Code:</label>
<div class="col-md-10">
<pre><code class="language-html">&lt;button type=&quot;button&quot; class=&quot;btn btn-link&quot;&gt;Link&lt;/button&gt;</code></pre>
</div>
  </div>
<div class="col-md-12">
  <div class="mb-3 row">
<label class="col-md-1">border-radius:</label>
<div class="col-md-3">
  <label class="col-md-12"></label>
    <div class="input-group col-md-12">
    <input class="form-control" type="text" name="btn_border_radius" value="' . $db[ 'btn_border_radius' ] . '" /> 
    </div>
  </div>
</div></div>

  </div></div>
<!-- ================Button====END======================= -->



      </div>
    </div>
  </div>

<!-- =========================================================================================================================================== -->



<div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingSix">
      <button class="accordion-button collapsed alert alert-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSix" aria-expanded="false" aria-controls="flush-collapseFive">
        '.$_language->module['plugin_set'].'
      </button>
    </h2>
    <div id="flush-collapseSix" class="accordion-collapse collapse" aria-labelledby="flush-headingSix" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">


     <!--<div class="alert alert-warning">Führe hier bitte erst Änderungen durch, wenn das zu bearbeitende Plugin auch zuvor installiert wurde! Diese Änderungen betreffen <strong>nur</strong> die jeweiligen Widgets und themebedingte Anpassungen. Übergreifende CSS Eigenschaften bleiben im jeweiligen Plugin enthalten!<br><br>Theme angepasste Plugins sind: <strong>Carousel, eSport Footer, Calendar</strong></div>-->

<h4>'.$_language->module['plugin_foot_set'].'</h4>';

$dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='footer'"));
        if (@$dx[ 'modulname' ] != 'footer') {
        echo 'No Plugin';
        } else {

echo'<div class="row">
<div class="col-md-6">
<div class="mb-3 row">
    <label class="col-md-4 control-label">footer bg-color:</label>
    <div id="cp15" class="input-group colorpicker-component col-md-7">
    <input type="text" value="' . $ds[ 'foot1' ] . '" class="form-control" name="foot1" /><span class="input-group-text input-group-addon"><i></i></span> 
    </div>
  </div>
<!--
  <div class="mb-3 row">
    <label class="col-md-4 control-label">copyright bg-color:</label>
    <div id="cp62" class="input-group colorpicker-component col-md-7">
    <input type="text" value="' . $ds[ 'foot5' ] . '" class="form-control" name="foot5" /><span class="input-group-text input-group-addon"><i></i></span> 
     </div>
  </div>

  <div class="mb-3 row">
    <label class="col-md-4 control-label">H3 color:</label>
    <div id="cp16" class="input-group colorpicker-component col-md-7">
    <input type="text" value="' . $ds[ 'foot3' ] . '" class="form-control" name="foot3" /><span class="input-group-text input-group-addon"><i></i></span> 
    </div>
  </div>
-->
  </div>
  
    <div class="col-md-6">
    <!--
    <div class="mb-3 row">
    <label class="col-md-4 control-label">footer color:</label>
    <div id="cp68" class="input-group colorpicker-component col-md-7">
    <input type="text" value="' . $ds[ 'foot6' ] . '" class="form-control" name="foot6" /><span class="input-group-text input-group-addon"><i></i></span> 
     </div>
  </div>

  
    <div class="mb-3 row">
    <label class="col-md-4 control-label">copyright color:</label>
    <div id="cp17" class="input-group colorpicker-component col-md-7">
    <input type="text" value="' . $ds[ 'foot2' ] . '" class="form-control" name="foot2" /><span class="input-group-text input-group-addon"><i></i></span> 
     </div>
  </div>
  
    <div class="mb-3 row">
    <label class="col-md-4 control-label">border top color:</label>
    <div id="cp67" class="input-group colorpicker-component col-md-7">
    <input type="text" value="' . $ds[ 'foot4' ] . '" class="form-control" name="foot4" /><span class="input-group-text input-group-addon"><i></i></span> 
     </div>
  </div>
-->
  

</div>
</div>';
}/*
echo'
<hr>


<h4>Calendar Plugin Settings</h4>';

$dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='calendar'"));
        if (@$dx[ 'modulname' ] != 'calendar') {
        echo 'No Plugin';
        } else {
echo'<div class="row">
<div class="col-md-6">
<div class="mb-3 row">
    <label class="col-md-4 control-label">date31 bg-color:</label>
    <div id="cp60" class="input-group colorpicker-component col-md-7">
    <input type="text" value="' . $ds[ 'calendar1' ] . '" class="form-control" name="calendar1" /><span class="input-group-text input-group-addon"><i></i></span> 
    </div>
  </div>

  </div>
  
    <div class="col-md-6">

  <div class="mb-3 row">
    <label class="col-md-4 control-label">today  bg-color:</label>
    <div id="cp61" class="input-group colorpicker-component col-md-7">
    <input type="text" value="' . $ds[ 'calendar2' ] . '" class="form-control" name="calendar2" /><span class="input-group-text input-group-addon"><i></i></span> 
    </div>
  </div>

  
  </div>
  

</div>';
}*/
echo'
<hr>


<h4>'.$_language->module['plugin_carousel_set'].'</h4>';

$dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='carousel'"));
        if (@$dx[ 'modulname' ] != 'carousel') {
        echo 'No Plugin';
        } else {
       

echo'<div class="row">
<div class="col-md-6">

<div class="mb-3 row">
    <label class="col-md-4 control-label">H1 color:</label>
    <div id="cp63" class="input-group colorpicker-component col-md-7">
    <input type="text" value="' . $ds[ 'carousel1' ] . '" class="form-control" name="carousel1" /><span class="input-group-text input-group-addon"><i></i></span> 
    </div>
  </div>

  <div class="mb-3 row">
    <label class="col-md-4 control-label">H1 span color:</label>
    <div id="cp64" class="input-group colorpicker-component col-md-7">
    <input type="text" value="' . $ds[ 'carousel2' ] . '" class="form-control" name="carousel2" /><span class="input-group-text input-group-addon"><i></i></span> 
    </div>
  </div>

  </div>
  
    <div class="col-md-6">

  <div class="mb-3 row">
    <label class="col-md-4 control-label">color:</label>
    <div id="cp65" class="input-group colorpicker-component col-md-7">
    <input type="text" value="' . $ds[ 'carousel3' ] . '" class="form-control" name="carousel3" /><span class="input-group-text input-group-addon"><i></i></span> 
    </div>
  </div>

  <div class="mb-3 row">
    <label class="col-md-4 control-label">carousel-indicators .active color:</label>
    <div id="cp66" class="input-group colorpicker-component col-md-7">
    <input type="text" value="' . $ds[ 'carousel4' ] . '" class="form-control" name="carousel4" /><span class="input-group-text input-group-addon"><i></i></span> 
    </div>
  </div>

';
}
echo'

</div>
    
    </div>
  </div>
</div>


<!-- =========================================================================================================================================== -->



<div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingSeven">
      <button class="accordion-button collapsed alert alert-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSeven" aria-expanded="false" aria-controls="flush-collapseSix">
        '.$_language->module['stylesheet_set'].'
      </button>
    </h2>
    <div id="flush-collapseSeven" class="accordion-collapse collapse" aria-labelledby="flush-headingSeven" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">

      <div class="mb-3 row">
    <label class="col-md-3">'.$_language->module['stylesheet_info'].'<br><br><small>'.$_language->module['folder_template'].': <b>/includes/themes/'.$ds['pfad'].'/css/</b>stylesheet.css</small></label>
    <div class="col-md-8">
        <textarea class="form-control" name="stylesheet" rows="20" cols="">'.$stylesheet.'</textarea>
    </div>
  </div>

      </div>
    </div>
  </div>
</div>


</div> <!-- accordion end -->

';
    }  

echo'

'.$express_active.'



<div class="mb-3 row">
    <div class="col-md-offset-0 col-md-12">
    <input type="hidden" name="captcha_hash" value="'.$hash.'" /><input type="hidden" name="themeID" value="'.$themeID.'" />
    <input type="hidden" name="logo_pic" value="' . $ds[ 'logo_pic' ] . '" />
    <button class="btn btn-warning" type="submit" name="saveedit"  />'.$_language->module['edit_template'].'</button>
    <!--<button class="btn btn-success" type="submit" name="saveedit" formaction="admincenter.php?site=settings_templates">'.$_language->module['edit_template_back'].'</button>-->
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
            '.$_language->module['template'].'
        </div>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="admincenter.php?site=settings_templates">'.$_language->module['template'].'</a></li>
    <li class="breadcrumb-item active" aria-current="page">new & edit</li>
  </ol>
</nav>   
<div class="card-body">

<div class="mb-3 row">
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

   echo'<div class="table-responsive"><table id="plugini" class="table table-bordered table-striped dataTable">
    <thead>
      
      <th style="width: 25%">'.$_language->module['banner'].'</th>
      <th style="width: 35%">'.$_language->module['template_name'].'</th>
      <th style="width: 24%">'.$_language->module['active'].'</th>
      <th>'.$_language->module['actions'].'</th>
    </thead>';
    
   $i = 1;
    while ($db = mysqli_fetch_array($row)) {


                if (file_exists("../includes/themes/".getinput($db['pfad'])."/images/".getinput($db['modulname']).".jpg")) {
                    $bannerpic = ".jpg";
                    $pic_info = $db[ 'modulname' ];
                } elseif (file_exists("../includes/themes/".getinput($db['pfad'])."/images/".getinput($db['modulname']).".gif")) {
                    $bannerpic = ".gif";
                    $pic_info = $db[ 'modulname' ];
                } elseif (file_exists("../includes/themes/".getinput($db['pfad'])."/images/".getinput($db['modulname']).".png")) {
                    $bannerpic = ".png";
                    $pic_info = $db[ 'modulname' ];
                } else {
                    $bannerpic = ".jpg";
                    $pic_info = "../../../../images/no-image";
                }

        echo '<tr>
        
        
        <td>

<div class="imageHold">
    <div><img class="featured-image img-thumbnail" src="../includes/themes/'.getinput($db['pfad']).'/images/'.$pic_info.''.$bannerpic.'" alt="Bannerpic"></div>
</div>

        </td>

        <td style="width: 45%"><h5>'.getinput($db['name']).'</h5><br>
        '.$_language->module['template_name'].': '.getinput($db['name']).'
        <br>'.$_language->module['modulname'].': '.$db['modulname'].'
        <br>'.$_language->module['folder_template'].': /includes/themes/'.getinput($db['pfad']).'
        <br>'.$_language->module['version'].': '.$db['version'].'';
        

        if (@$db[ 'modulname' ] != 'default') {
        }else{
        echo'<p class="text-danger">' . $_language->module[ 'template_default' ] . '</p>';
        }

        echo'</td>';

        $db[ 'active' ] == 1 ? $act = '<font color="green"><b>' . $_language->module[ 'active_on' ] . '</b></font>' :
            $act = '<font color="red"><b>' . $_language->module[ 'active_off' ] . '</b></font>';

        $db[ 'active' ] == 1 ? $button = '' :
            $button = '<input type="hidden" name="captcha_hash" value="'.$hash.'" /><input type="hidden" name="themeID" value="'.$db['themeID'].'" />
    <button class="btn btn-success" type="submit" name="addedit"  />'.$_language->module['template_active'].'</button>';    
            

       echo'<td style="width: 15%">';

    if ($db[ 'active' ] == '1') {
        $active = '<input class="form-check-input" id="active" type="checkbox" name="radio1" value="active"  checked="checked" disabled />';
    } else {
        $active = '<input class="form-check-input" id="active" type="checkbox" name="radio1" value="active" />';
    }

     echo'<form class="form-horizontal" method="post" action="admincenter.php?site=settings_templates" enctype="multipart/form-data">
      <div class="row">
    <label class="col-md-5 control-label" for="active_on">'.$act.'</label>
    <div class="col-md-3 form-check form-switch" style="padding: 0px 40px;">
'.$active.' 
</div>
<div class="col-md-12">'.$button.'
</div>
</div>



</form>
</td>
<td style="width: 15%">
 <a href="admincenter.php?site=settings_templates&amp;action=edit&amp;themeID='.$db['themeID'].'" class="btn btn-warning" type="button">' . $_language->module[ 'template_edit' ] . '</a>';

# Themplate default kann man nicht löschen!
if (@$db[ 'modulname' ] != 'default') {
                    
echo' <!-- Button trigger modal -->
    <button type="button" class="btn btn-danger" data-toggle="tooltip" data-html="true" title="' . $_language->module[ 'tooltip_16' ]. ' " data-bs-toggle="modal" data-bs-target="#confirm-delete" data-href="admincenter.php?site=settings_templates&amp;delete=true&themeID='.$db['themeID'].'&name='.$db['name'].'&pfad='.$db['pfad'].'&modulname='.$db['modulname'].'&amp;captcha_hash='.$hash.'">
    ' . $_language->module['delete'] . '
    </button></th>';echo'
    <!-- Button trigger modal END-->  ';

} else {
        #Template Default kann nicht gelöscht werden!!!
}
    echo'</td>
          <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                      <div class="modal-content">
                          <div class="modal-header">
                             <h5 class="modal-title" id="modalLabel">' . $_language->module['title'] . '</h5>
                             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="'.$_language->module['close'].'"></button>
                          </div>
                          <div class="modal-body">
                             <p>' . $_language->module['really_delete'] . '</p>
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">'.$_language->module['close'].'</button>
                              <a class="btn btn-danger btn-ok">' . $_language->module['delete'] . '</a>
                          </div>
                      </div>
                  </div>
              </div>
       <!-- Modal END -->

      </tr>';
  }
 
  echo '</table>';

echo '</div></div></div>';

}
?>