
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

/*
 * plugin_manager
 * 
 * @author: T-Seven | Webspell-RM.de
 * @version: 1.0
 * @package: plugin_manager
 * @website: www.Webspell-RM.de
 *
 * Mit dem Plugin-Manager kann man Einstellungen vornehmen, die das Plugin und die dazugehörigen Widegt's betreffen.
*/

 ?>

<style type="text/css">
.pato15 { padding-top: 15px; }
</style>
<?php
$_language->readModule('plugin_manager', false, true);

$ergebnis = safe_query("SELECT * FROM ".PREFIX."navigation_dashboard_links WHERE modulname='ac_plugin_manager'");
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

$theme_active = safe_query("SELECT * FROM " . PREFIX . "settings_themes WHERE active = '1'");
    $db = mysqli_fetch_array($theme_active);

if(!empty(@$db['active'] == 1) !== false) {
# Speichert die Widget-Position
if (isset($_POST[ 'save_widget1' ])) {

    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_POST[ 'captcha_hash' ])) {
        try {
        safe_query(
            "INSERT INTO
                `" . PREFIX . "settings_widgets` (

                    `position`,
                    `description`,
                    `modulname`,
                    `themes_modulname`,
                    `widgetname`,
                    `widgetdatei`,
                    `number`,
                    `widget`
                ) VALUES (
                    '" .$_POST['description'] ."',
                    '" . $_POST['description'] . "',
                    '" . $_POST['modulname']  . "',
                    '" . $_POST['themes_modulname'] . "',
                    '" . $_POST['widgetname1'] . "',
                    '" . $_POST['widget_link1'] . "',
                    '1',
                    'widget1'
                )"
        );
        $pluginID =  $_POST['pluginID'];


# Bei diesen Plugins werden die css und js bei der Widget-Zuweisung geladen ja / nein!

include 'settings_manager_widget_css_js_selection.php';


if($widget_css) { 
safe_query(
            "UPDATE
                `" . PREFIX . "settings_module` 
            SET
            
            `activate` = '0'
            WHERE `modulname` = '" . $_POST['modulname']  . "' AND themes_modulname='" . $_POST['themes_modulname'] . "';

            ");   

}else{
safe_query(
            "UPDATE
                `" . PREFIX . "settings_module` 
            SET
            
            `activate` = '1'
            WHERE `modulname` = '" . $_POST['modulname']  . "' AND themes_modulname='" . $_POST['themes_modulname'] . "';

            ");
}
#bei einem Widget css und js werden geladen ja/nein END

#Navigation: es wird nur eine Navigation aktiviert

include 'settings_manager_navigation_selection.php'; 

#Navigation: es wird nur eine Navigation aktiviert END


        echo $_language->module[ 'success_edit' ]."<br /><br />";
        redirect("admincenter.php?site=plugin_manager&action=edit&id=$pluginID", "", 1); return false;
    } CATCH (Exception $e) {
        echo $_language->module[ 'failed_edit' ]."<br /><br />".$e->getMessage();   
        redirect("admincenter.php?site=plugin_manager&action=edit&id=$pluginID", "", 5); return false;
    }
return false;   
}
}

# Speichert die Widget-Position
if (isset($_POST[ 'save_widget1_1' ])) {

    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_POST[ 'captcha_hash' ])) {
        try {
        safe_query(
            "INSERT INTO
                `" . PREFIX . "settings_widgets` (

                    `position`,
                    `description`,
                    `modulname`,
                    `themes_modulname`,
                    `widgetname`,
                    `widgetdatei`,
                    `number`,
                    `widget`
                ) VALUES (
                    '" .$_POST['description'] ."',
                    '" . $_POST['description'] . "',
                    '" . $_POST['modulname']  . "',
                    '" . $_POST['themes_modulname'] . "',
                    '" . $_POST['widgetname1'] . "',
                    '" . $_POST['widget_link1'] . "',
                    '2',
                    'widget1'
                )"
        );
        $pluginID =  $_POST['pluginID'];


# Bei diesen Plugins werden die css und js bei der Widget-Zuweisung geladen ja / nein!

include 'settings_manager_widget_css_js_selection.php';


if($widget_css) { 
safe_query(
            "UPDATE
                `" . PREFIX . "settings_module` 
            SET
            
            `activate` = '0'
            WHERE `modulname` = '" . $_POST['modulname']  . "' AND themes_modulname='" . $_POST['themes_modulname'] . "';

            ");   

}else{
safe_query(
            "UPDATE
                `" . PREFIX . "settings_module` 
            SET
            
            `activate` = '1'
            WHERE `modulname` = '" . $_POST['modulname']  . "' AND themes_modulname='" . $_POST['themes_modulname'] . "';

            ");
}
#bei einem Widget css und js werden geladen ja/nein END

#Navigation: es wird nur eine Navigation aktiviert

include 'settings_manager_navigation_selection.php'; 

#Navigation: es wird nur eine Navigation aktiviert END


        echo $_language->module[ 'success_edit' ]."<br /><br />";
        redirect("admincenter.php?site=plugin_manager&action=edit&id=$pluginID", "", 1); return false;
    } CATCH (Exception $e) {
        echo $_language->module[ 'failed_edit' ]."<br /><br />".$e->getMessage();   
        redirect("admincenter.php?site=plugin_manager&action=edit&id=$pluginID", "", 5); return false;
    }
return false;   
}
}






if (isset($_POST[ 'save_widget2' ])) {

    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_POST[ 'captcha_hash' ])) {
        try {
    safe_query(
            "INSERT INTO
                `" . PREFIX . "settings_widgets` (

                    `position`,
                    `description`,
                    `modulname`,
                    `themes_modulname`,
                    `widgetname`,
                    `widgetdatei`,
                    `number`,
                    `widget`
                ) VALUES (
                    '" .$_POST['description'] ."',
                    '" . $_POST['description'] . "',
                    '" . $_POST['modulname']  . "',
                    '" . $_POST['themes_modulname'] . "',
                    '" . $_POST['widgetname2'] . "',
                    '" . $_POST['widget_link2'] . "',
                    '1',
                    'widget2'
                )"
        );
    $pluginID =  $_POST['pluginID'];

# Bei diesen Plugins werden die css und js bei der Widget-Zuweisung geladen ja / nein!

include 'settings_manager_widget_css_js_selection.php';                 
if($widget_css) { 
safe_query(
            "UPDATE
                `" . PREFIX . "settings_module` 
            SET
            
            `activate` = '0'
            WHERE `modulname` = '" . $_POST['modulname']  . "' AND themes_modulname='" . $_POST['themes_modulname'] . "';

            ");   

}else{
safe_query(
            "UPDATE
                `" . PREFIX . "settings_module` 
            SET
            
            `activate` = '1'
            WHERE `modulname` = '" . $_POST['modulname']  . "' AND themes_modulname='" . $_POST['themes_modulname'] . "';

            ");
}
#bei einem Widget css und js werden geladen ja/nein END

        echo $_language->module[ 'success_edit' ]."<br /><br />";   
        redirect("admincenter.php?site=plugin_manager&action=edit&id=$pluginID", "", 1); return false;
    } CATCH (Exception $e) {
        echo $_language->module[ 'failed_edit' ]."<br /><br />".$e->getMessage();   
        redirect("admincenter.php?site=plugin_manager&action=edit&id=$pluginID", "", 5); return false;
    }
return false;   
}
}

if (isset($_POST[ 'save_widget2_1' ])) {

    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_POST[ 'captcha_hash' ])) {
        try {
    safe_query(
            "INSERT INTO
                `" . PREFIX . "settings_widgets` (

                    `position`,
                    `description`,
                    `modulname`,
                    `themes_modulname`,
                    `widgetname`,
                    `widgetdatei`,
                    `number`,
                    `widget`
                ) VALUES (
                    '" .$_POST['description'] ."',
                    '" . $_POST['description'] . "',
                    '" . $_POST['modulname']  . "',
                    '" . $_POST['themes_modulname'] . "',
                    '" . $_POST['widgetname2'] . "',
                    '" . $_POST['widget_link2'] . "',
                    '2',
                    'widget2'
                )"
        );
    $pluginID =  $_POST['pluginID'];

# Bei diesen Plugins werden die css und js bei der Widget-Zuweisung geladen ja / nein!

include 'settings_manager_widget_css_js_selection.php';                 
if($widget_css) { 
safe_query(
            "UPDATE
                `" . PREFIX . "settings_module` 
            SET
            
            `activate` = '0'
            WHERE `modulname` = '" . $_POST['modulname']  . "' AND themes_modulname='" . $_POST['themes_modulname'] . "';

            ");   

}else{
safe_query(
            "UPDATE
                `" . PREFIX . "settings_module` 
            SET
            
            `activate` = '1'
            WHERE `modulname` = '" . $_POST['modulname']  . "' AND themes_modulname='" . $_POST['themes_modulname'] . "';

            ");
}
#bei einem Widget css und js werden geladen ja/nein END

        echo $_language->module[ 'success_edit' ]."<br /><br />";   
        redirect("admincenter.php?site=plugin_manager&action=edit&id=$pluginID", "", 1); return false;
    } CATCH (Exception $e) {
        echo $_language->module[ 'failed_edit' ]."<br /><br />".$e->getMessage();   
        redirect("admincenter.php?site=plugin_manager&action=edit&id=$pluginID", "", 5); return false;
    }
return false;   
}
}

if (isset($_POST[ 'save_widget3' ])) {

    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_POST[ 'captcha_hash' ])) {
        try {
    safe_query(
            "INSERT INTO
                `" . PREFIX . "settings_widgets` (

                    `position`,
                    `description`,
                    `modulname`,
                    `themes_modulname`,
                    `widgetname`,
                    `widgetdatei`,
                    `number`,
                    `widget`
                ) VALUES (
                    '" .$_POST['description'] ."',
                    '" . $_POST['description'] . "',
                    '" . $_POST['modulname']  . "',
                    '" . $_POST['themes_modulname'] . "',
                    '" . $_POST['widgetname3'] . "',
                    '" . $_POST['widget_link3'] . "',
                    '1',
                    'widget3'
                )"
        );
    $pluginID =  $_POST['pluginID'];

# Bei diesen Plugins werden die css und js bei der Widget-Zuweisung geladen ja / nein!

include 'settings_manager_widget_css_js_selection.php';                 
if($widget_css) { 
safe_query(
            "UPDATE
                `" . PREFIX . "settings_module` 
            SET
            
            `activate` = '0'
            WHERE `modulname` = '" . $_POST['modulname']  . "' AND themes_modulname='" . $_POST['themes_modulname'] . "';

            ");   

}else{
safe_query(
            "UPDATE
                `" . PREFIX . "settings_module` 
            SET
            
            `activate` = '1'
            WHERE `modulname` = '" . $_POST['modulname']  . "' AND themes_modulname='" . $_POST['themes_modulname'] . "';

            ");
}
#bei einem Widget css und js werden geladen ja/nein END

        echo $_language->module[ 'success_edit' ]."<br /><br />";   
        redirect("admincenter.php?site=plugin_manager&action=edit&id=$pluginID", "", 1); return false;
    } CATCH (Exception $e) {
        echo $_language->module[ 'failed_edit' ]."<br /><br />".$e->getMessage();   
        redirect("admincenter.php?site=plugin_manager&action=edit&id=$pluginID", "", 5); return false;
    }
return false;   
}
}
# Speichert die Widget-Position END

if (isset($_POST[ 'save_widget3_1' ])) {

    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_POST[ 'captcha_hash' ])) {
        try {
    safe_query(
            "INSERT INTO
                `" . PREFIX . "settings_widgets` (

                    `position`,
                    `description`,
                    `modulname`,
                    `themes_modulname`,
                    `widgetname`,
                    `widgetdatei`,
                    `number`,
                    `widget`
                ) VALUES (
                    '" .$_POST['description'] ."',
                    '" . $_POST['description'] . "',
                    '" . $_POST['modulname']  . "',
                    '" . $_POST['themes_modulname'] . "',
                    '" . $_POST['widgetname3'] . "',
                    '" . $_POST['widget_link3'] . "',
                    '2',
                    'widget3'
                )"
        );
    $pluginID =  $_POST['pluginID'];

# Bei diesen Plugins werden die css und js bei der Widget-Zuweisung geladen ja / nein!

include 'settings_manager_widget_css_js_selection.php';                 
if($widget_css) { 
safe_query(
            "UPDATE
                `" . PREFIX . "settings_module` 
            SET
            
            `activate` = '0'
            WHERE `modulname` = '" . $_POST['modulname']  . "' AND themes_modulname='" . $_POST['themes_modulname'] . "';

            ");   

}else{
safe_query(
            "UPDATE
                `" . PREFIX . "settings_module` 
            SET
            
            `activate` = '1'
            WHERE `modulname` = '" . $_POST['modulname']  . "' AND themes_modulname='" . $_POST['themes_modulname'] . "';

            ");
}
#bei einem Widget css und js werden geladen ja/nein END

        echo $_language->module[ 'success_edit' ]."<br /><br />";   
        redirect("admincenter.php?site=plugin_manager&action=edit&id=$pluginID", "", 1); return false;
    } CATCH (Exception $e) {
        echo $_language->module[ 'failed_edit' ]."<br /><br />".$e->getMessage();   
        redirect("admincenter.php?site=plugin_manager&action=edit&id=$pluginID", "", 5); return false;
    }
return false;   
}
}
# Speichert die Widget-Position END

#Aktiviert das Plugin für die Moduleinstellung
global $themes_modulname,$name,$modulname,$modul_display,$sidebar,$navi_link;

if (isset($_POST[ 'save_theme' ])) {

    $modulname = $_POST['modulname'];
            
    if(isset($_POST['activate'])) { $acti = 1; } else { $acti = 0; }
    if(isset($_POST['via_navigation'])) { $via_navigation = 1; } else { $via_navigation = 0; }
    if(isset($_POST['head_activated'])) { $head_activated = 1; } else { $head_activated = 0; }
    if(isset($_POST['content_head_activated'])) { $content_head_activated = 1; } else { $content_head_activated = 0; }
    if(isset($_POST['content_foot_activated'])) { $content_foot_activated = 1; } else { $content_foot_activated = 0; }
    if(isset($_POST['head_section_activated'])) { $head_section_activated = 1; } else { $head_section_activated = 0; }
    if(isset($_POST['foot_section_activated'])) { $foot_section_activated = 1; } else { $foot_section_activated = 0; }

    if(isset($_POST['modul_display'])) { $modul_display = 1; } else { $modul_display = 0; }
    if(isset($_POST['full_activated'])) { $full_activated = 1; } else { $full_activated = 0; }
    if(isset($_POST['plugin_settings'])) { $plugin_settings = 1; } else { $plugin_settings = 0; }
    if(isset($_POST['plugin_module'])) { $plugin_module = 1; } else { $plugin_module = 0; }
    if(isset($_POST['plugin_widget'])) { $plugin_widget = 1; } else { $plugin_widget = 0; }

    if(isset($_POST['widget1'])) { $widget1 = 1; } else { $widget1 = 0; }
    if(isset($_POST['widget2'])) { $widget2 = 1; } else { $widget2 = 0; }
    if(isset($_POST['widget3'])) { $widget3 = 1; } else { $widget3 = 0; }
    

    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_POST[ 'captcha_hash' ])) {
        safe_query(
            "INSERT INTO " . PREFIX . "settings_module (
            pluginID, 
            name, 
            modulname, 
            themes_modulname,
            activate, 
            sidebar,
            via_navigation, 
            head_activated, 
            content_head_activated, 
            content_foot_activated, 
            head_section_activated, 
            foot_section_activated, 
            modul_display,
            full_activated,
            plugin_settings,
            plugin_module,
            plugin_widget,
            widget1,
            widget2,
            widget3
            ) 
            values (
            NULL, 
            '" . $_POST['name'] . "', 
            '" . $_POST['modulname'] . "', 
            '" . $_POST['themes_modulname'] . "',
            '0', 
            'activated',
            '0', 
            '0', 
            '0',  
            '0', 
            '0',  
            '0',
            '" . $_POST['modul_display'] . "', 
            '" . $_POST['full_activated'] . "', 
            '" . $_POST['plugin_settings'] . "', 
            '" . $_POST['plugin_module'] . "', 
            '" . $_POST['plugin_widget'] . "', 
            '" . $_POST['widget1'] . "', 
            '" . $_POST['widget2'] . "', 
            '" . $_POST['widget3'] . "'
        )"
        );


#bei einem Widget css und js werden geladen ja/nein bei aktivieren von dem Plugin für das Template
$modulname = $_POST[ 'modulname' ];
$themes_modulname = $_POST[ 'themes_modulname' ];

$ergebnis = safe_query("SELECT * FROM `" . PREFIX . "navigation_website_sub` WHERE modulname = '".$modulname."' and themes_modulname = '".$themes_modulname."'");
$dx = mysqli_fetch_array($ergebnis);    
# Bei diesen Plugins werden die css und js bei der Widget-Zuweisung geladen ja / nein! Wenn es dem Themplate zugewiesen wird.

include 'settings_manager_widget_css_js_selection.php';                 
#if($widget_akti) {
if($widget_css) { 

    safe_query(
            "UPDATE
                `" . PREFIX . "settings_module` 
            SET
            
            `activate` = '0'
            WHERE `modulname` = '".$modulname."' AND themes_modulname='$themes_modulname';

            ");
            
}else{
    safe_query(
            "UPDATE
                `" . PREFIX . "settings_module` 
            SET
            
            `activate` = '1'
            WHERE `modulname` = '".$modulname."' AND themes_modulname='$themes_modulname';

            ");
}

#bei einem Widget css und js werden geladen ja/nein END

$ergebnis = safe_query("SELECT * FROM `" . PREFIX . "navigation_website_sub` WHERE modulname = '".$modulname."' and themes_modulname = 'default'");
$dx = mysqli_fetch_array($ergebnis);    
# Themplate default kann man nicht löschen! // Alle Plugins die kein Navilink besitzen / also nur Widgets

include 'settings_manager_widget_css_js_selection.php';                 
if($widget_nav) {

    $dm = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_module WHERE modulname = '".$modulname."'"));
        #Zwei Navigationseinträge für news und clanwar
        if (@$modulname != 'news_manager') {
        }else{               
            safe_query(
                "INSERT INTO
                    `" . PREFIX . "navigation_website_sub` (`mnavID`, `name`, `modulname`, `url`, `sort`, `indropdown`, `themes_modulname`) 
                    VALUES ('" . $dx['mnavID'] . "','{[de]}News Archive{[en]}News Archive', 'news_manager', 'index.php?site=news_manager&action=news_archive', '1', '1','" . $_POST['themes_modulname'] . "')"
            );
            safe_query(
                "INSERT INTO
                    `" . PREFIX . "navigation_website_sub` (`mnavID`, `name`, `modulname`, `url`, `sort`, `indropdown`, `themes_modulname`) 
                    VALUES ('" . $dx['mnavID'] . "','{[de]}News{[en]}News{[it]}Notizia', 'news_manager', 'index.php?site=news_manager', '1', '1','" . $_POST['themes_modulname'] . "')"
            );
        }

        if (@$modulname != 'clanwars') {
        }else{
            safe_query(
                "INSERT INTO
                    `" . PREFIX . "navigation_website_sub` (`mnavID`, `name`, `modulname`, `url`, `sort`, `indropdown`, `themes_modulname`) 
                    VALUES ('" . $dx['mnavID'] . "','{[de]}Clanwars Statistiken{[en]}Clanwars Statistics{[pl]}Clanwars{[it]}Guerre del Clan Statistica', 'clanwars', 'index.php?site=clanwars&action=clanwar_result', '1', '1','" . $_POST['themes_modulname'] . "')"
            );
            safe_query(
                "INSERT INTO
                    `" . PREFIX . "navigation_website_sub` (`mnavID`, `name`, `modulname`, `url`, `sort`, `indropdown`, `themes_modulname`) 
                    VALUES ('" . $dx['mnavID'] . "','{[de]}Clanwars{[en]}Clanwars{[pl]}Clanwars{[it]}Guerre del Clan', 'clanwars', 'index.php?site=clanwars', '1', '1','" . $_POST['themes_modulname'] . "')"
            );
        } 
        #Zwei Navigationseinträge für news und clanwar END
    }else{
            safe_query(
                "INSERT INTO
                    `" . PREFIX . "navigation_website_sub` (`mnavID`, `name`, `modulname`, `url`, `sort`, `indropdown`, `themes_modulname`) 
                    VALUES ('" . $dx['mnavID'] . "', '" . $dx['name'] . "', '$modulname', '" . $dx['url'] . "', '1', '1','" . $_POST['themes_modulname'] . "')"
            ); 

        #Zwei Datenbankeinträge Gallery und Usergallery

        $dm = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_module WHERE modulname = '".$modulname."'"));

            if (@$modulname != 'gallery') {
            }else{
            safe_query(
            "INSERT INTO " . PREFIX . "settings_module (
            pluginID, 
            name, 
            modulname, 
            themes_modulname,
            activate, 
            sidebar,
            via_navigation, 
            head_activated, 
            content_head_activated, 
            content_foot_activated, 
            head_section_activated, 
            foot_section_activated, 
            modul_display,
            full_activated,
            plugin_settings,
            plugin_module,
            plugin_widget,
            widget1,
            widget2,
            widget3
            ) 
            values (
            NULL, 
            'Usergallery', 
            'usergallery', 
            '" . $_POST['themes_modulname'] . "',
            '1', 
            'activated', 
            '0',
            '0', 
            '0',  
            '0', 
            '0',  
            '0',
            '0', 
            '0', 
            '0', 
            '0', 
            '0', 
            '0', 
            '0', 
            '0'
        )"
        );
            }     
}
        ############################## Forum ####################################
        if($modulname = 'forum' && $themes_modulname){
        global $themes_modulname;
          $topi = safe_query("SELECT * FROM " . PREFIX . "settings_module WHERE modulname = 'forum_topic' AND themes_modulname='".$themes_modulname."'"); 
          $rows = mysqli_num_rows($topi);
        if($rows == '0') {
            safe_query(
            "INSERT INTO " . PREFIX . "settings_module (
            pluginID, 
            name, 
            modulname, 
            themes_modulname,
            activate, 
            sidebar,
            via_navigation, 
            head_activated, 
            content_head_activated, 
            content_foot_activated, 
            head_section_activated, 
            foot_section_activated, 
            modul_display,
            full_activated,
            plugin_settings,
            plugin_module,
            plugin_widget,
            widget1,
            widget2,
            widget3
                    ) VALUES (
                    NULL, 
            'Forum Topic', 
            'forum_topic', 
            '" . $_POST['themes_modulname'] . "',
            '1', 
            'activated',
            '0', 
            '0', 
            '0',  
            '0', 
            '0',  
            '0',
            '0', 
            '" . $_POST['full_activated'] . "', 
            '" . $_POST['plugin_settings'] . "', 
            '" . $_POST['plugin_module'] . "', 
            '" . $_POST['plugin_widget'] . "', 
            '" . $_POST['widget1'] . "', 
            '" . $_POST['widget2'] . "', 
            '" . $_POST['widget3'] . "'
                )"
            );
        }
        }

        $id = mysqli_insert_id($_database);

        $errors = array();

        //TODO: should be loaded from root language folder
        $_language->readModule('formvalidation', true);

        if (count($errors)) {
            $errors = array_unique($errors);
            echo generateErrorBoxFromArray($_language->module['errors_there'], $errors);
        } else {
            echo $_language->module[ 'success_plugin_to_template_activate' ];
            redirect("admincenter.php?site=plugin_manager", "", 1);
        }
    } else {
        echo $_language->module[ 'transaction_invalid' ];
    }
}
#Aktiviert das Plugin für die Moduleinstellung END

        
if(isset($_GET['do'])) { $do=$_GET['do']; } else { $do=""; }
if(isset($_GET['id'])) { $id=intval($_GET['id']); } else { $id=""; }
if(isset($_GET['modulname'])) { $modulname=intval($_GET['modulname']); } else { $modulname=""; }
if($id !="" && $modulname != "" && $do == "dea") {
    
    try {

        safe_query("UPDATE `" . PREFIX . "settings_plugins` SET `activate` = '0' WHERE `pluginID` = '".$id."';"); 
        safe_query("UPDATE `" . PREFIX . "navigation_website_sub` SET `indropdown` = '0' WHERE `modulname` =  '".$_GET['modulname']."';"); 
        echo $_language->module[ 'success_deactivated' ];
        redirect("admincenter.php?site=plugin_manager", "", 1); return false;
    } CATCH (Exception $e) {
         echo $_language->module[ 'success_deactivated' ]."<br /><br />".$e->getMessage();  
         redirect("admincenter.php?site=plugin_manager", "", 5); return false;
    }
}
if($id != "" && $modulname != "" && $do == "act") {
    try {
        safe_query("UPDATE `" . PREFIX . "settings_plugins` SET `activate` = '1' WHERE `pluginID` = '".$id."';");
        safe_query("UPDATE `" . PREFIX . "navigation_website_sub` SET `indropdown` = '1' WHERE `modulname` =  '".$_GET['modulname']."';");   
        echo $_language->module[ 'success_activated' ];
        redirect("admincenter.php?site=plugin_manager", "", 1); return false;
    } CATCH (Exception $e) {
         echo $_language->module[ 'failed_activated' ]."<br /><br />".$e->getMessage(); 
         redirect("admincenter.php?site=plugin_manager", "", 5); return false;
    }
}   
/*if($id != "" && $modulname != "" && $themes_modulname != "" && $do == "del") {
    try {
        #safe_query("DELETE FROM `" . PREFIX . "settings_plugins` WHERE `pluginID` = '".$id."' LIMIT 1");  

        safe_query("DELETE FROM `" . PREFIX . "settings_module` WHERE `modulname` =  '".$_GET['modulname']."' AND themes_modulname='".$_GET['themes_modulname']."'");     
        echo $_language->module[ 'success_delete' ];
        redirect("admincenter.php?site=plugin_manager", "", 2); return false;
    } CATCH (Exception $e) {
         echo $_language->module[ 'failed_delete' ]."<br /><br />".$e->getMessage();    
         redirect("admincenter.php?site=plugin_manager", "", 5); return false;
    }
} */ 

if (isset($_GET[ "delete" ])) {
    $CAPCLASS = new \webspell\Captcha();
    if ($CAPCLASS->checkCaptcha(0, $_GET[ 'captcha_hash' ])) {

        safe_query("DELETE FROM " . PREFIX . "settings_widgets WHERE modulname='" . $_GET[ 'modulname' ] . "' AND themes_modulname='" . $themes_modulname . "'");
        safe_query("DELETE FROM " . PREFIX . "settings_module WHERE modulname='" . $_GET[ 'modulname' ] . "' AND themes_modulname='" . $themes_modulname . "'");

        safe_query("DELETE FROM " . PREFIX . "navigation_website_sub WHERE modulname='" . $_GET[ 'modulname' ] . "' AND themes_modulname='" . $themes_modulname . "'");

        echo $_language->module[ 'success_delete' ];
        redirect("admincenter.php?site=plugin_manager", "", 1);
    } else {
        echo $_language->module[ 'failed_delete' ]."<br /><br />".$e->getMessage();
        echo $_language->module[ 'transaction_invalid' ];
    }
} 

#Speichert die komplette Einstellung
if(isset($_POST['svn'])) {
  if(isset($_POST['activate'])) { $acti = 1; } else { $acti = 0; }
  
  
  try { safe_query(
            "INSERT INTO `" . PREFIX . "settings_plugins` (
                    `pluginID`, 
                    `name`, 
                    `modulname`,
                    `widgetname1`,
                    `widgetname2`,
                    `widgetname3`,  
                    `info`, 
                    `activate`, 
                    `admin_file`, 
                    `author`, 
                    `website`, 
                    `index_link`, 
                    `widget_link1`,
                    `widget_link2`, 
                    `widget_link3`,
                    `hiddenfiles`, 
                    `version`, 
                    `path`,
                    `modul_display`
                    ) VALUES (
                    NULL, 
                    '".$_POST['name']."', 
                    '".$_POST['modulname']."',
                    '".$_POST['widgetname1']."',
                    '".$_POST['widgetname2']."',
                    '".$_POST['widgetname3']."',  
                    '".$_POST['info']."', 
                    '1', 
                    '".$_POST['admin_file']."', 
                    '".$_POST['author']."', 
                    '".$_POST['website']."', 
                    '".$_POST['index']."', 
                    '".$_POST['widget_link1']."',
                    '".$_POST['widget_link2']."', 
                    '".$_POST['widget_link3']."',  
                    '".$_POST['hiddenfiles']."', 
                    '".$_POST['version']."', 
                    '".$_POST['path']."',
                    '1'
                );
            ");

        safe_query(
            "INSERT INTO " . PREFIX . "settings_module (
            pluginID, 
            name, 
            modulname, 
            themes_modulname,
            activate, 
            sidebar,
            via_navigation, 
            head_activated, 
            content_head_activated, 
            content_foot_activated, 
            head_section_activated, 
            foot_section_activated, 
            modul_display,
            full_activated,
            plugin_settings,
            plugin_module,
            plugin_widget,
            widget1,
            widget2,
            widget3
            ) 
            values (
            NULL, 
            '" . $_POST['name'] . "', 
            '" . $_POST['modulname'] . "', 
            '" . $_POST['themes_modulname'] . "',
            '1', 
            'activated',
            '0', 
            '0', 
            '0',  
            '0', 
            '0',  
            '0',
            '1', 
            '0', 
            '1', 
            '1', 
            '1', 
            '1', 
            '1', 
            '1'
        )"
        );

        echo $_language->module[ 'success_save' ]."<br /><br />";   
        redirect("admincenter.php?site=plugin_manager", "", 1); return false;
    } CATCH (Exception $e) {
        echo $_language->module[ 'failed_save' ]."<br /><br />".$e->getMessage();   
        redirect("admincenter.php?site=plugin_manager", "", 5); return false;
    }
return false;   
}
#Speichert die komplette Einstellung END

#Speichert die Widget-Einstellung
if(isset($_POST['edit_widget1'])) {
    try {
safe_query(
            "UPDATE
                `" . PREFIX . "settings_widgets`
            SET
                `position` = '".$_POST['description'] ."',
                `description` = '" . $_POST['description'] . "',
                `widgetname` = '" . $_POST['widgetname1'] . "',
                `widgetdatei` = '" . $_POST['widget_link1'] . "',
                activate = '".$_POST['description'] ."'
        WHERE `id` = '".intval($_POST['wid1id'])."' AND number=1;");

$pluginID =  $_POST['pid'];


#bei einem Widget css und js werden geladen ja/nein
$modulname = $_POST[ 'modulname' ];
$themes_modulname = $_POST[ 'themes_modulname' ];
$ergebnis = safe_query("SELECT * FROM `" . PREFIX . "navigation_website_sub` WHERE modulname = '".$modulname."' and themes_modulname = '".$themes_modulname."'");
$dx = mysqli_fetch_array($ergebnis);

# Bei diesen Plugins werden die css und js bei der Widget-Zuweisung geladen ja / nein!



include 'settings_manager_widget_css_js_selection.php';                 
if($widget_css) { 

  

    $active = safe_query("SELECT * FROM " . PREFIX . "settings_widgets WHERE modulname = '$modulname' AND themes_modulname='$themes_modulname' and widget='widget1'");
    $dx = mysqli_fetch_array($active);
    $active = safe_query("SELECT * FROM " . PREFIX . "settings_widgets WHERE modulname = '$modulname' AND themes_modulname='$themes_modulname' and widget='widget2'");
    $dy = mysqli_fetch_array($active);
    $active = safe_query("SELECT * FROM " . PREFIX . "settings_widgets WHERE modulname = '$modulname' AND themes_modulname='$themes_modulname' and widget='widget3'");
    $dz = mysqli_fetch_array($active);

# Prüft ob der Datenbankeintrag vorhanden ist!
if ( mysqli_num_rows(safe_query( "SELECT * FROM " . PREFIX . "settings_widgets WHERE modulname = '$modulname' AND themes_modulname='$themes_modulname' and widget='widget1'" ) ) == 0 ) {
    // Es wurden 0 Datensätze gefunden
    $activate1 = '1';
}else{
    @$activate1 = $dx['activate'];
}

if ( mysqli_num_rows(safe_query( "SELECT * FROM " . PREFIX . "settings_widgets WHERE modulname = '$modulname' AND themes_modulname='$themes_modulname' and widget='widget2'" ) ) == 0 ) {
    // Es wurden 0 Datensätze gefunden
    $activate2 = '1';
}else{
    @$activate2 = $dy['activate'];
}

if ( mysqli_num_rows(safe_query( "SELECT * FROM " . PREFIX . "settings_widgets WHERE modulname = '$modulname' AND themes_modulname='$themes_modulname' and widget='widget3'" ) ) == 0 ) {
    // Es wurden 0 Datensätze gefunden
    $activate3 = '1';
}else{
    @$activate3 = $dz['activate'];
}
# Prüft ob der Datenbankeintrag vorhanden ist! END

if(!empty(@$activate1 == 1 && @$activate2 == 1 && @$activate3 == 1) !== false) { 


    safe_query(
            "UPDATE
                `" . PREFIX . "settings_module` 
            SET
            
            `activate` = '0'
            WHERE `modulname` = '".$modulname."' AND themes_modulname='$themes_modulname';

            ");
            
}else{
    safe_query(
            "UPDATE
                `" . PREFIX . "settings_module` 
            SET
            
            `activate` = '1'
            WHERE `modulname` = '".$modulname."' AND themes_modulname='$themes_modulname';

            ");
}
}else{}
#bei einem Widget css und js werden geladen ja/nein END

#Navigation: es wird nur eine Navigation aktiviert

include 'settings_manager_navigation_selection.php';

#Navigation: es wird nur eine Navigation aktiviert END

    echo $_language->module[ 'success_edit' ]."<br /><br />";
    redirect("admincenter.php?site=plugin_manager&action=edit&id=$pluginID", "", 1); return false;
    } CATCH (Exception $e) {
        echo $_language->module[ 'failed_edit' ]."<br /><br />".$e->getMessage();   
        redirect("admincenter.php?site=plugin_manager&action=edit&id=$pluginID", "", 5); return false;
    }
return false;   
}

#Speichert die Widget-Einstellung
if(isset($_POST['edit_widget1_1'])) {
    try {
safe_query(
            "UPDATE
                `" . PREFIX . "settings_widgets`
            SET
                `position` = '".$_POST['description'] ."',
                `description` = '" . $_POST['description'] . "',
                `widgetname` = '" . $_POST['widgetname1'] . "',
                `widgetdatei` = '" . $_POST['widget_link1'] . "',
                activate = '".$_POST['description'] ."'
        WHERE `id` = '".intval($_POST['wid1id'])."' AND number=2;");

$pluginID =  $_POST['pid'];


#bei einem Widget css und js werden geladen ja/nein
$modulname = $_POST[ 'modulname' ];
$themes_modulname = $_POST[ 'themes_modulname' ];
$ergebnis = safe_query("SELECT * FROM `" . PREFIX . "navigation_website_sub` WHERE modulname = '".$modulname."' and themes_modulname = '".$themes_modulname."'");
        $dx = mysqli_fetch_array($ergebnis);

# Bei diesen Plugins werden die css und js bei der Widget-Zuweisung geladen ja / nein!

include 'settings_manager_widget_css_js_selection.php';                 
if($widget_css) {   

    $active = safe_query("SELECT * FROM " . PREFIX . "settings_widgets WHERE modulname = '$modulname' AND themes_modulname='$themes_modulname' and widget='widget1'");
    $dx = mysqli_fetch_array($active);
    $active = safe_query("SELECT * FROM " . PREFIX . "settings_widgets WHERE modulname = '$modulname' AND themes_modulname='$themes_modulname' and widget='widget2'");
    $dy = mysqli_fetch_array($active);
    $active = safe_query("SELECT * FROM " . PREFIX . "settings_widgets WHERE modulname = '$modulname' AND themes_modulname='$themes_modulname' and widget='widget3'");
    $dz = mysqli_fetch_array($active);

# Prüft ob der Datenbankeintrag vorhanden ist!
if ( mysqli_num_rows(safe_query( "SELECT * FROM " . PREFIX . "settings_widgets WHERE modulname = '$modulname' AND themes_modulname='$themes_modulname' and widget='widget1'" ) ) == 0 ) {
    // Es wurden 0 Datensätze gefunden
    $activate1 = '1';
}else{
    @$activate1 = $dx['activate'];
}

if ( mysqli_num_rows(safe_query( "SELECT * FROM " . PREFIX . "settings_widgets WHERE modulname = '$modulname' AND themes_modulname='$themes_modulname' and widget='widget2'" ) ) == 0 ) {
    // Es wurden 0 Datensätze gefunden
    $activate2 = '1';
}else{
    @$activate2 = $dy['activate'];
}

if ( mysqli_num_rows(safe_query( "SELECT * FROM " . PREFIX . "settings_widgets WHERE modulname = '$modulname' AND themes_modulname='$themes_modulname' and widget='widget3'" ) ) == 0 ) {
    // Es wurden 0 Datensätze gefunden
    $activate3 = '1';
}else{
    @$activate3 = $dz['activate'];
}
# Prüft ob der Datenbankeintrag vorhanden ist! END

if(!empty(@$activate1 == 1 && @$activate2 == 1 && @$activate3 == 1) !== false) { 


    safe_query(
            "UPDATE
                `" . PREFIX . "settings_module` 
            SET
            
            `activate` = '0'
            WHERE `modulname` = '".$modulname."' AND themes_modulname='$themes_modulname';

            ");
            
}else{
    safe_query(
            "UPDATE
                `" . PREFIX . "settings_module` 
            SET
            
            `activate` = '1'
            WHERE `modulname` = '".$modulname."' AND themes_modulname='$themes_modulname';

            ");
}
}else{}
#bei einem Widget css und js werden geladen ja/nein END

#Navigation: es wird nur eine Navigation aktiviert

include 'settings_manager_navigation_selection.php';

#Navigation: es wird nur eine Navigation aktiviert END



        echo $_language->module[ 'success_edit' ]."<br /><br />";
        redirect("admincenter.php?site=plugin_manager&action=edit&id=$pluginID", "", 1); return false;
    } CATCH (Exception $e) {
        echo $_language->module[ 'failed_edit' ]."<br /><br />".$e->getMessage();   
        redirect("admincenter.php?site=plugin_manager&action=edit&id=$pluginID", "", 5); return false;
    }
return false;   
}

if(isset($_POST['edit_widget2'])) {
    try {
safe_query(
            "UPDATE
                `" . PREFIX . "settings_widgets`
            SET
                `position` = '".$_POST['description']."',
                `description` = '".$_POST['description']."',
                `widgetname` = '".$_POST['widgetname2']."',
                `widgetdatei` = '".$_POST['widget_link2']."',
                activate = '".$_POST['description'] ."'
            WHERE `id` = '".intval($_POST['wid2id'])."';");

$pluginID =  $_POST['pid'];

#bei einem Widget css und js werden geladen ja/nein
$modulname = $_POST[ 'modulname' ];
$themes_modulname = $_POST[ 'themes_modulname' ];
$ergebnis = safe_query("SELECT * FROM `" . PREFIX . "navigation_website_sub` WHERE modulname = '".$modulname."' and themes_modulname = '".$themes_modulname."'");
$dx = mysqli_fetch_array($ergebnis);

# Bei diesen Plugins werden die css und js bei der Widget-Zuweisung geladen ja / nein!

include 'settings_manager_widget_css_js_selection.php';                 
if($widget_css) {  

    $active = safe_query("SELECT * FROM " . PREFIX . "settings_widgets WHERE modulname = '$modulname' AND themes_modulname='$themes_modulname' and widget='widget1'");
    $dx = mysqli_fetch_array($active);
    $active = safe_query("SELECT * FROM " . PREFIX . "settings_widgets WHERE modulname = '$modulname' AND themes_modulname='$themes_modulname' and widget='widget2'");
    $dy = mysqli_fetch_array($active);
    $active = safe_query("SELECT * FROM " . PREFIX . "settings_widgets WHERE modulname = '$modulname' AND themes_modulname='$themes_modulname' and widget='widget3'");
    $dz = mysqli_fetch_array($active);

# Prüft ob der Datenbankeintrag vorhanden ist!
if ( mysqli_num_rows(safe_query( "SELECT * FROM " . PREFIX . "settings_widgets WHERE modulname = '$modulname' AND themes_modulname='$themes_modulname' and widget='widget1'" ) ) == 0 ) {
    // Es wurden 0 Datensätze gefunden
    $activate1 = '1';
}else{
    @$activate1 = $dx['activate'];
}

if ( mysqli_num_rows(safe_query( "SELECT * FROM " . PREFIX . "settings_widgets WHERE modulname = '$modulname' AND themes_modulname='$themes_modulname' and widget='widget2'" ) ) == 0 ) {
    // Es wurden 0 Datensätze gefunden
    $activate2 = '1';
}else{
    @$activate2 = $dy['activate'];
}

if ( mysqli_num_rows(safe_query( "SELECT * FROM " . PREFIX . "settings_widgets WHERE modulname = '$modulname' AND themes_modulname='$themes_modulname' and widget='widget3'" ) ) == 0 ) {
    // Es wurden 0 Datensätze gefunden
    $activate3 = '1';
}else{
    @$activate3 = $dz['activate'];
}
# Prüft ob der Datenbankeintrag vorhanden ist! END

if(!empty(@$activate1 == 1 && @$activate2 == 1 && @$activate3 == 1) !== false) { 

    safe_query(
            "UPDATE
                `" . PREFIX . "settings_module` 
            SET
            
            `activate` = '0'
            WHERE `modulname` = '".$modulname."' AND themes_modulname='$themes_modulname';

            ");
            
}else{
    safe_query(
            "UPDATE
                `" . PREFIX . "settings_module` 
            SET
            
            `activate` = '1'
            WHERE `modulname` = '".$modulname."' AND themes_modulname='$themes_modulname';

            ");
}
}else{}
#bei einem Widget css und js werden geladen ja/nein END

        echo $_language->module[ 'success_edit' ]."<br /><br />";   
        redirect("admincenter.php?site=plugin_manager&action=edit&id=$pluginID", "", 1); return false;
    } CATCH (Exception $e) {
        echo $_language->module[ 'failed_edit' ]."<br /><br />".$e->getMessage();   
        redirect("admincenter.php?site=plugin_manager&action=edit&id=$pluginID", "", 5); return false;
    }
return false;   
} #kommt von settings_select_widget_css.php


if(isset($_POST['edit_widget2_1'])) {
    try {
safe_query(
            "UPDATE
                `" . PREFIX . "settings_widgets`
            SET
                `position` = '".$_POST['description']."',
                `description` = '".$_POST['description']."',
                `widgetname` = '".$_POST['widgetname2']."',
                `widgetdatei` = '".$_POST['widget_link2']."',
                activate = '".$_POST['description'] ."'
            WHERE `id` = '".intval($_POST['wid2id'])."';");

$pluginID =  $_POST['pid'];

#bei einem Widget css und js werden geladen ja/nein
$modulname = $_POST[ 'modulname' ];
$themes_modulname = $_POST[ 'themes_modulname' ];
$ergebnis = safe_query("SELECT * FROM `" . PREFIX . "navigation_website_sub` WHERE modulname = '".$modulname."' and themes_modulname = '".$themes_modulname."'");
        $dx = mysqli_fetch_array($ergebnis);

# Bei diesen Plugins werden die css und js bei der Widget-Zuweisung geladen ja / nein!

include 'settings_manager_widget_css_js_selection.php';                 
if($widget_css) {  

    $active = safe_query("SELECT * FROM " . PREFIX . "settings_widgets WHERE modulname = '$modulname' AND themes_modulname='$themes_modulname' and widget='widget1'");
    $dx = mysqli_fetch_array($active);
    $active = safe_query("SELECT * FROM " . PREFIX . "settings_widgets WHERE modulname = '$modulname' AND themes_modulname='$themes_modulname' and widget='widget2'");
    $dy = mysqli_fetch_array($active);
    $active = safe_query("SELECT * FROM " . PREFIX . "settings_widgets WHERE modulname = '$modulname' AND themes_modulname='$themes_modulname' and widget='widget3'");
    $dz = mysqli_fetch_array($active);

# Prüft ob der Datenbankeintrag vorhanden ist!
if ( mysqli_num_rows(safe_query( "SELECT * FROM " . PREFIX . "settings_widgets WHERE modulname = '$modulname' AND themes_modulname='$themes_modulname' and widget='widget1'" ) ) == 0 ) {
    // Es wurden 0 Datensätze gefunden
    $activate1 = '1';
}else{
    @$activate1 = $dx['activate'];
}

if ( mysqli_num_rows(safe_query( "SELECT * FROM " . PREFIX . "settings_widgets WHERE modulname = '$modulname' AND themes_modulname='$themes_modulname' and widget='widget2'" ) ) == 0 ) {
    // Es wurden 0 Datensätze gefunden
    $activate2 = '1';
}else{
    @$activate2 = $dy['activate'];
}

if ( mysqli_num_rows(safe_query( "SELECT * FROM " . PREFIX . "settings_widgets WHERE modulname = '$modulname' AND themes_modulname='$themes_modulname' and widget='widget3'" ) ) == 0 ) {
    // Es wurden 0 Datensätze gefunden
    $activate3 = '1';
}else{
    @$activate3 = $dz['activate'];
}
# Prüft ob der Datenbankeintrag vorhanden ist! END

if(!empty(@$activate1 == 1 && @$activate2 == 1 && @$activate3 == 1) !== false) { 

    safe_query(
            "UPDATE
                `" . PREFIX . "settings_module` 
            SET
            
            `activate` = '0'
            WHERE `modulname` = '".$modulname."' AND themes_modulname='$themes_modulname';

            ");
            
}else{
    safe_query(
            "UPDATE
                `" . PREFIX . "settings_module` 
            SET
            
            `activate` = '1'
            WHERE `modulname` = '".$modulname."' AND themes_modulname='$themes_modulname';

            ");
}
}else{}
#bei einem Widget css und js werden geladen ja/nein END

        echo $_language->module[ 'success_edit' ]."<br /><br />";   
        redirect("admincenter.php?site=plugin_manager&action=edit&id=$pluginID", "", 1); return false;
    } CATCH (Exception $e) {
        echo $_language->module[ 'failed_edit' ]."<br /><br />".$e->getMessage();   
        redirect("admincenter.php?site=plugin_manager&action=edit&id=$pluginID", "", 5); return false;
    }
return false;   
} #kommt von settings_select_widget_css.php

if(isset($_POST['edit_widget3'])) {
    try {
safe_query(
            "UPDATE
                `" . PREFIX . "settings_widgets`
            SET
                `position` = '".$_POST['description'] ."',
                `description` = '" . $_POST['description'] . "',
                `widgetname` = '" . $_POST['widgetname3'] . "',
                `widgetdatei` = '" . $_POST['widget_link3'] . "',
                activate = '".$_POST['description'] ."'
            WHERE `id` = '".intval($_POST['wid3id'])."';");

$pluginID =  $_POST['pid'];

#bei einem Widget css und js werden geladen ja/nein
$modulname = $_POST[ 'modulname' ];
$themes_modulname = $_POST[ 'themes_modulname' ];
$ergebnis = safe_query("SELECT * FROM `" . PREFIX . "navigation_website_sub` WHERE modulname = '".$modulname."' and themes_modulname = '".$themes_modulname."'");
$dx = mysqli_fetch_array($ergebnis);

# Bei diesen Plugins werden die css und js bei der Widget-Zuweisung geladen ja / nein!

include 'settings_manager_widget_css_js_selection.php';                 
if($widget_css) { 

    $active = safe_query("SELECT * FROM " . PREFIX . "settings_widgets WHERE modulname = '$modulname' AND themes_modulname='$themes_modulname' and widget='widget1'");
    $dx = mysqli_fetch_array($active);
    $active = safe_query("SELECT * FROM " . PREFIX . "settings_widgets WHERE modulname = '$modulname' AND themes_modulname='$themes_modulname' and widget='widget2'");
    $dy = mysqli_fetch_array($active);
    $active = safe_query("SELECT * FROM " . PREFIX . "settings_widgets WHERE modulname = '$modulname' AND themes_modulname='$themes_modulname' and widget='widget3'");
    $dz = mysqli_fetch_array($active);

# Prüft ob der Datenbankeintrag vorhanden ist!
if ( mysqli_num_rows(safe_query( "SELECT * FROM " . PREFIX . "settings_widgets WHERE modulname = '$modulname' AND themes_modulname='$themes_modulname' and widget='widget1'" ) ) == 0 ) {
    // Es wurden 0 Datensätze gefunden
    $activate1 = '1';
}else{
    @$activate1 = $dx['activate'];
}

if ( mysqli_num_rows(safe_query( "SELECT * FROM " . PREFIX . "settings_widgets WHERE modulname = '$modulname' AND themes_modulname='$themes_modulname' and widget='widget2'" ) ) == 0 ) {
    // Es wurden 0 Datensätze gefunden
    $activate2 = '1';
}else{
    @$activate2 = $dy['activate'];
}

if ( mysqli_num_rows(safe_query( "SELECT * FROM " . PREFIX . "settings_widgets WHERE modulname = '$modulname' AND themes_modulname='$themes_modulname' and widget='widget3'" ) ) == 0 ) {
    // Es wurden 0 Datensätze gefunden
    $activate3 = '1';
}else{
    @$activate3 = $dz['activate'];
}
# Prüft ob der Datenbankeintrag vorhanden ist! END

if(!empty(@$activate1 == 1 && @$activate2 == 1 && @$activate3 == 1) !== false) {   

    safe_query(
            "UPDATE
                `" . PREFIX . "settings_module` 
            SET
            
            `activate` = '0'
            WHERE `modulname` = '".$modulname."' AND themes_modulname='$themes_modulname';

            ");
            
}else{
    safe_query(
            "UPDATE
                `" . PREFIX . "settings_module` 
            SET
            
            `activate` = '1'
            WHERE `modulname` = '".$modulname."' AND themes_modulname='$themes_modulname';

            ");
}
}else{}
#bei einem Widget css und js werden geladen ja/nein END

        echo $_language->module[ 'success_edit' ]."<br /><br />";   
        redirect("admincenter.php?site=plugin_manager&action=edit&id=$pluginID", "", 1); return false;
    } CATCH (Exception $e) {
        echo $_language->module[ 'failed_edit' ]."<br /><br />".$e->getMessage();   
        redirect("admincenter.php?site=plugin_manager&action=edit&id=$pluginID", "", 5); return false;
    }
return false;   
} #kommt von settings_select_widget_css.php

if(isset($_POST['edit_widget3_1'])) {
    try {
safe_query(
            "UPDATE
                `" . PREFIX . "settings_widgets`
            SET
                `position` = '".$_POST['description'] ."',
                `description` = '" . $_POST['description'] . "',
                `widgetname` = '" . $_POST['widgetname3'] . "',
                `widgetdatei` = '" . $_POST['widget_link3'] . "',
                activate = '".$_POST['description'] ."'
            WHERE `id` = '".intval($_POST['wid3id'])."';");

$pluginID =  $_POST['pid'];

#bei einem Widget css und js werden geladen ja/nein
$modulname = $_POST[ 'modulname' ];
$themes_modulname = $_POST[ 'themes_modulname' ];
$ergebnis = safe_query("SELECT * FROM `" . PREFIX . "navigation_website_sub` WHERE modulname = '".$modulname."' and themes_modulname = '".$themes_modulname."'");
$dx = mysqli_fetch_array($ergebnis);

# Bei diesen Plugins werden die css und js bei der Widget-Zuweisung geladen ja / nein!

include 'settings_manager_widget_css_js_selection.php';                 
if($widget_css) { 

    $active = safe_query("SELECT * FROM " . PREFIX . "settings_widgets WHERE modulname = '$modulname' AND themes_modulname='$themes_modulname' and widget='widget1'");
    $dx = mysqli_fetch_array($active);
    $active = safe_query("SELECT * FROM " . PREFIX . "settings_widgets WHERE modulname = '$modulname' AND themes_modulname='$themes_modulname' and widget='widget2'");
    $dy = mysqli_fetch_array($active);
    $active = safe_query("SELECT * FROM " . PREFIX . "settings_widgets WHERE modulname = '$modulname' AND themes_modulname='$themes_modulname' and widget='widget3'");
    $dz = mysqli_fetch_array($active);

# Prüft ob der Datenbankeintrag vorhanden ist!
if ( mysqli_num_rows(safe_query( "SELECT * FROM " . PREFIX . "settings_widgets WHERE modulname = '$modulname' AND themes_modulname='$themes_modulname' and widget='widget1'" ) ) == 0 ) {
    // Es wurden 0 Datensätze gefunden
    $activate1 = '1';
}else{
    @$activate1 = $dx['activate'];
}

if ( mysqli_num_rows(safe_query( "SELECT * FROM " . PREFIX . "settings_widgets WHERE modulname = '$modulname' AND themes_modulname='$themes_modulname' and widget='widget2'" ) ) == 0 ) {
    // Es wurden 0 Datensätze gefunden
    $activate2 = '1';
}else{
    @$activate2 = $dy['activate'];
}

if ( mysqli_num_rows(safe_query( "SELECT * FROM " . PREFIX . "settings_widgets WHERE modulname = '$modulname' AND themes_modulname='$themes_modulname' and widget='widget3'" ) ) == 0 ) {
    // Es wurden 0 Datensätze gefunden
    $activate3 = '1';
}else{
    @$activate3 = $dz['activate'];
}
# Prüft ob der Datenbankeintrag vorhanden ist! END

if(!empty(@$activate1 == 1 && @$activate2 == 1 && @$activate3 == 1) !== false) {   

    safe_query(
            "UPDATE
                `" . PREFIX . "settings_module` 
            SET
            
            `activate` = '0'
            WHERE `modulname` = '".$modulname."' AND themes_modulname='$themes_modulname';

            ");
            
}else{
    safe_query(
            "UPDATE
                `" . PREFIX . "settings_module` 
            SET
            
            `activate` = '1'
            WHERE `modulname` = '".$modulname."' AND themes_modulname='$themes_modulname';

            ");
}
}else{}
#bei einem Widget css und js werden geladen ja/nein END

        echo $_language->module[ 'success_edit' ]."<br /><br />";   
        redirect("admincenter.php?site=plugin_manager&action=edit&id=$pluginID", "", 1); return false;
    } CATCH (Exception $e) {
        echo $_language->module[ 'failed_edit' ]."<br /><br />".$e->getMessage();   
        redirect("admincenter.php?site=plugin_manager&action=edit&id=$pluginID", "", 5); return false;
    }
return false;   
} #kommt von settings_select_widget_css.php
#Speichert die Widget-Einstellung END

#Editiert die komplette Einstellung
if(isset($_POST['saveedit'])) {
  @$modulname = $_POST[ 'modulname' ];
  $themes_modulname = $_POST[ 'themes_modulname' ];

    try {

      $ergebnis = safe_query("SELECT * FROM `" . PREFIX . "settings_plugins` WHERE `pluginID`='".$id."' LIMIT 1");
    $ds = mysqli_fetch_array($ergebnis);

      $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='".$modulname."'"));
      if (@$dx[ 'modulname' ] != $modulname) {

       $modul = safe_query("UPDATE `" . PREFIX . "settings_plugins` SET 
      `name` = '".$_POST['name']."',      
      `widgetname1` = '".@$_POST['widget_name1']."',
      `widgetname2` = '".@$_POST['widgetname2']."',
      `widgetname3` = '".@$_POST['widgetname3']."', 
      `info` = '".$_POST['info']."',       
      `admin_file` = '".$_POST['admin_file']."', 
      `author` = '".$_POST['author']."', 
      `website` = '".$_POST['website']."', 
      `index_link` = '".$_POST['index']."', 
      `widget_link1` = '".@$_POST['widget_link_1']."',
      `widget_link2` = '".@$_POST['widget_link2']."', 
      `widget_link3` = '".@$_POST['widget_link3']."',
      `version` = '".$_POST['version']."', 
      `path` = '".$_POST['path']."'

      WHERE `pluginID` = '".intval($_POST['pid'])."'");

      } else {
       
       $modul = safe_query("UPDATE `" . PREFIX . "settings_plugins` SET 
      `name` = '".$_POST['name']."',      
      `widgetname1` = '".@$_POST['widget_name1']."',
      `widgetname2` = '".@$_POST['widgetname2']."',
      `widgetname3` = '".@$_POST['widgetname3']."', 
      `info` = '".$_POST['info']."',       
      `admin_file` = '".$_POST['admin_file']."', 
      `author` = '".$_POST['author']."', 
      `website` = '".$_POST['website']."', 
      `index_link` = '".$_POST['index']."', 
      `widget_link1` = '".@$_POST['widget_link_1']."',
      `widget_link2` = '".@$_POST['widget_link2']."', 
      `widget_link3` = '".@$_POST['widget_link3']."',
      `version` = '".$_POST['version']."', 
      `path` = '".$_POST['path']."'

      WHERE `pluginID` = '".intval($_POST['pid'])."'");

        ############################

        if($modulname == 'startpage'){
          $geti = safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname = ''"); 
          $rows = mysqli_num_rows($geti);
            if($rows == '0') {
            safe_query(
                "INSERT INTO
                    `" . PREFIX . "settings_plugins` (
                    
                    `name`, 
                    `modulname`, 
                    `info`, 
                    
                    `admin_file`, 
                    `author`, 
                    `website`, 
                    `index_link`, 
                    `widget_link1`,
                    `widget_link2`, 
                    `widget_link3`,  
                    `hiddenfiles`, 
                    `version`, 
                    `path`'
                    ) VALUES (
                    '".$_POST['name']."', 
                    '', 
                    '".$_POST['info']."', 
                    
                    '".$_POST['admin_file']."', 
                    '".$_POST['author']."', 
                    '".$_POST['website']."', 
                    '".$_POST['index']."', 
                    '".$_POST['widget_link1']."',
                    '".$_POST['widget_link2']."', 
                    '".$_POST['widget_link3']."',  
                    '".$_POST['hiddenfiles']."', 
                    '".$_POST['version']."', 
                    '".$_POST['path']."'
                )"
            );
            }
            safe_query(
            "UPDATE
                `" . PREFIX . "settings_plugins`
            SET
                `name` = '".$_POST['name']."', 
                `modulname` = '', 
                `info` = '".$_POST['info']."', 
                
                `admin_file` = '".$_POST['admin_file']."', 
                `author` = '".$_POST['author']."', 
                `website` = '".$_POST['website']."', 
                `index_link` = '".$_POST['index']."', 
                `widget_link1` = '".$_POST['widget_link1']."',
                `widget_link2` = '".$_POST['widget_link2']."', 
                `widget_link3` = '".$_POST['widget_link3']."',  
                `hiddenfiles` = '".$_POST['hiddenfiles']."', 
                `version` = '".$_POST['version']."', 
                `path` = '".$_POST['path']."'
                  WHERE
                `modulname` = ''"
            );
        }


##########################################################

        if($modulname == '' && $themes_modulname){
          global $themes_modulname;
          $geti = safe_query("SELECT * FROM " . PREFIX . "settings_module WHERE modulname = 'startpage' AND themes_modulname='".$themes_modulname."'"); 
          $rows = mysqli_num_rows($geti);
        if($rows == '0') {

            
            safe_query(
                "INSERT INTO
                    `" . PREFIX . "settings_module` (
                                       
                    `sidebar`,
                    `via_navigation`,
                    `head_activated`,
                    `content_head_activated`,
                    `content_foot_activated`,
                    `head_section_activated`,
                    `foot_section_activated`
                    ) VALUES (
                    
                    '" . $sidebar . "',
                    '" . $via_navigation . "',
                    '" . $head_activated . "',
                    '" . $content_head_activated . "',
                    '" . $content_foot_activated . "',
                    '" . $head_section_activated . "',
                    '" . $foot_section_activated . "'
                )"
            );
        }
        safe_query(
            "UPDATE
                `" . PREFIX . "settings_module`
            SET
                
                `sidebar` = '" . @$_POST['sidebar'] . "',
                `via_navigation` = '" . @$_POST['via_navigation'] . "',
                `head_activated` = '" . @$_POST['head_activated'] . "',
                `content_head_activated` = '" . @$_POST['content_head_activated'] . "',
                `content_foot_activated` = '" . @$_POST['content_foot_activated'] . "',
                `head_section_activated` = '" . @$_POST['head_section_activated'] . "',
                `foot_section_activated` = '" . @$_POST['foot_section_activated'] . "'
                  WHERE
                `modulname` = 'startpage' AND themes_modulname='".$themes_modulname."'"
        );
        }
############################## Forum ####################################
        if($modulname == 'forum' && $themes_modulname){
        global $themes_modulname;
          $topi = safe_query("SELECT * FROM " . PREFIX . "settings_module WHERE modulname = 'forum_topic' AND themes_modulname='".$themes_modulname."'"); 
          $rows = mysqli_num_rows($topi);
        if($rows == '0') {
            safe_query(
                "INSERT INTO
                    `" . PREFIX . "settings_module` (
                    `name`,
                    `modulname`,
                    `themes_modulname`,                   
                    `sidebar`,
                    `via_navigation`,
                    `head_activated`,
                    `content_head_activated`,
                    `content_foot_activated`,
                    `head_section_activated`,
                    `foot_section_activated`
                    ) VALUES (
                    'Forum Topic',
                    'forum_topic',
                    '" . $themes_modulname . "',
                    '" . $sidebar . "',
                    '" . $via_navigation . "',
                    '" . $head_activated . "',
                    '" . $content_head_activated . "',
                    '" . $content_foot_activated . "',
                    '" . $head_section_activated . "',
                    '" . $foot_section_activated . "'
                )"
            );
        }
        safe_query(
            "UPDATE
                `" . PREFIX . "settings_module`
            SET
                `name` = 'Forum Topic',
               `modulname` = 'forum_topic',
               `themes_modulname` = '" . $themes_modulname . "',
                `sidebar` = '" . @$_POST['sidebar'] . "',
                `via_navigation` = '" . @$_POST['via_navigation'] . "',
                `head_activated` = '" . @$_POST['head_activated'] . "',
                `content_head_activated` = '" . @$_POST['content_head_activated'] . "',
                `content_foot_activated` = '" . @$_POST['content_foot_activated'] . "',
                `head_section_activated` = '" . @$_POST['head_section_activated'] . "',
                `foot_section_activated` = '" . @$_POST['foot_section_activated'] . "'
                  WHERE
                `modulname` = 'forum_topic' AND themes_modulname='".$themes_modulname."'"
        );
        }
        ######################

    if(isset($_POST['via_navigation'])) { $via_navigation = 1; } else { $via_navigation = 0; }    
    if(isset($_POST['head_activated'])) { $head_activated = 1; } else { $head_activated = 0; }
    if(isset($_POST['content_head_activated'])) { $content_head_activated = 1; } else { $content_head_activated = 0; }
    if(isset($_POST['content_foot_activated'])) { $content_foot_activated = 1; } else { $content_foot_activated = 0; }
    if(isset($_POST['head_section_activated'])) { $head_section_activated = 1; } else { $head_section_activated = 0; }
    if(isset($_POST['foot_section_activated'])) { $foot_section_activated = 1; } else { $foot_section_activated = 0; }
    if(isset($_POST['modul_deactivated'])) { $modul_deactivated = 1; } else { $modul_deactivated = 0; }
  
    
#### Fehler???
        safe_query(
            "UPDATE
                `" . PREFIX . "settings_module`
            SET
                `sidebar` = '" . @$_POST['sidebar'] . "',
                `via_navigation` = '".@$via_navigation."',
                `head_activated` = '".@$head_activated."',
                `content_head_activated` = '" . @$content_head_activated . "',
                `content_foot_activated` = '" . @$content_foot_activated . "',
                `head_section_activated` = '" . @$head_section_activated . "',
                `foot_section_activated` = '" . @$foot_section_activated . "'
               
        WHERE `pluginID` = '".intval(@$_POST['mid'])."'
        ");

}

        echo $_language->module[ 'success_edit' ]."<br /><br />";   
        redirect("admincenter.php?site=plugin_manager", "", 1); return false;
    } CATCH (Exception $e) {
        echo $_language->module[ 'failed_edit' ]."<br /><br />".$e->getMessage();   
        redirect("admincenter.php?site=plugin_manager", "", 5); return false;
    }
return false;   
}


#Editiert die komplette Einstellung END


if ($action == "edit") {
$id = $_GET[ 'id' ];  

  $CAPCLASS = new \webspell\Captcha;
    $CAPCLASS->createTransaction();
    $hash = $CAPCLASS->getHash();

    echo '<div class="card">
        <div class="card-header"><i class="bi bi-puzzle" style="font-size: 1rem;"></i> 
            '.$_language->module['plugin_manager'].'
        </div>
            
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="admincenter.php?site=plugin_manager">' . $_language->module['plugin_manager'] . '</a></li>
    <li class="breadcrumb-item active" aria-current="page">' . $_language->module['edit_plugin'] . '</li>
  </ol>
</nav>


     <div class="card-body">';

    $ergebnis = safe_query("SELECT * FROM `" . PREFIX . "settings_plugins` WHERE `pluginID`='".$id."' LIMIT 1");
    $ds = mysqli_fetch_array($ergebnis);       
        
    $ergebnis = safe_query("SELECT * FROM `" . PREFIX . "settings_plugins` WHERE `pluginID`='".$id."' LIMIT 1");
    $dx = mysqli_fetch_array($ergebnis);

    $translate = new multiLanguage(detectCurrentLanguage());
    $translate->detectLanguages($ds['name']);
    $name = $translate->getTextByLanguage($ds['name']);
    $translate->detectLanguages($ds['info']);
    $info = $translate->getTextByLanguage($ds['info']);


if (@$ds[ 'admin_file' ] != '') {     

echo'<div class="mb-3 row">
    <label class="col-md-1 control-label">' . $_language->module['options'] . ':</label>
    <div class="col-md-8">
<a class="btn btn-primary" href="admincenter.php?site='.$ds['admin_file'].'">'.$name.'</a>
    </div></div>';
}else{

}    
echo'<form class="form-horizontal" method="post" id="post" name="post" action="admincenter.php?site=plugin_manager&id='.$id.'&do=edit" enctype="multipart/form-data" onsubmit="return chkFormular();"><input type="hidden" name="pid" value="'.$ds['pluginID'].'" /><input type="hidden" name="themes_modulname" value="'.$themes_modulname.'" />';


echo'<div class="row">
<div class="col-sm-6">';
	
$ergebnis = safe_query("SELECT * FROM `" . PREFIX . "settings_plugins` WHERE `pluginID`='".$id."' LIMIT 1");
    $dx = mysqli_fetch_array($ergebnis);

$themeergebnis = safe_query("SELECT * FROM " . PREFIX . "settings_themes WHERE active = '1'");
    $db = mysqli_fetch_array($themeergebnis);


#Speichern muss noch angepasst werden Startpage!!!
$dm_plugin_settings = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_module WHERE modulname = '".$dx['modulname']."' and themes_modulname = '".$db['modulname']."' and plugin_settings = '0'"));

if (@$dm_plugin_settings[ 'modulname' ] != $ds['modulname'] && @$dm_plugin_settings['themes_modulname'] != $db['modulname'] && @$dm_plugin_module['plugin_settings'] != '0') {      

echo'

<b>'.$_language->module['plugin_basic_setting'].':</b>
  <hr>

  <div class="mb-3 row">
  	<input type="hidden" name="pid" value="'.$ds['pluginID'].'" />    
    <label class="col-sm-5 col-form-label" for="name">Plugin '.$_language->module['name'].':<br>
    '.$_language->module['multi_language_info_name'].'
    </label>
    <div class="col-sm-7">
    <h4>'.$name.'</h4>
    <span class="text-muted small"><em>
    <input type="name" class="form-control" name="name" value="'.$ds['name'].'" placeholder="plugin name"></em></span>
  </div>
  </div>
  <div class="mb-3 row">
    <label class="col-sm-5 col-form-label" for="name">'.$_language->module['description'].':<br>
    '.$_language->module['multi_language_info_description'].'
    </label>
    <div class="col-sm-7">
    <p style="margin-top: 7px">'.$info.'</p>
    <spanclass="text-muted small"><em>
    <textarea class="form-control" name="info" rows="10" cols="" style="width: 100%;" placeholder="info">'.$ds['info'].'</textarea></em></span>
  </div>
  </div>
  <div class="mb-3 row">
 	<label class="col-sm-5 col-form-label" for="admin_file">'.$_language->module['admin_file'].': <br><small>('.$_language->module['index_file_nophp'].')</small></label>
 	<div class="col-sm-7"><span class="text-muted small"><em>
 	 <input type="name" class="form-control"  name="admin_file" value="'.$ds['admin_file'].'" placeholder="admin file"></em></span>
  </div>
  </div>
  <div class="mb-3 row">
 	<label class="col-sm-5 col-form-label" for="author">'.$_language->module['author'].':</label>
 	<div class="col-sm-7"><span class="text-muted small"><em>
 	 <input type="name" class="form-control" rows="5" name="author" value="'.$ds['author'].'" placeholder="autor"></em></span>
  </div>
  </div>
  <div class="mb-3 row">
 	<label class="col-sm-5 col-form-label" for="website">'.$_language->module['website'].':</label>
 	<div class="col-sm-7"><span class="text-muted small"><em>
 	 <input type="name" class="form-control" placeholder="http://" rows="5"  value="'.$ds['website'].'" name="website"></em></span>
  </div>
  </div>
  <div class="mb-3 row">
    <label class="col-sm-5 col-form-label" for="name">'.$_language->module['modulname'].': <br><small>('.$_language->module['for_uninstall'].')</small></label>
    <div class="col-sm-7"><span class="text-muted small"><em>
    <input type="name" class="form-control" name="modulname" value="'.$ds['modulname'].'" disabled></em></span>
  </div>
  </div>

  <div class="mb-3 row">
    <label class="col-sm-5 col-form-label" for="index">'.$_language->module['index_file'].': <br><small>('.$_language->module['index_file_nophp'].')</small></label>
    <div class="col-sm-7"><span class="text-muted small"><em>
     <input type="name" class="form-control" placeholder="index file" rows="5"  value="'.$ds['index_link'].'" name="index"></em></span>
  </div>
  </div>

  <div class="mb-3 row">
    <label class="col-sm-5 col-form-label" for="hittenfiles">'.$_language->module['hidden_file'].': <br><small>('.$_language->module['hidden_file_seperate'].')</small></label>
    <div class="col-sm-7"><span class="text-muted small"><em>
     <input type="name" class="form-control" rows="5" placeholder="myfile,secondfile,anotherfile" value="'.$ds['hiddenfiles'].'" name="hiddenfiles"></em></span>
  </div>
  </div>
  <div class="mb-3 row">
    <label class="col-sm-5 col-form-label" for="version">'.$_language->module['version_file'].':</label>
    <div class="col-sm-7"><span class="text-muted small"><em>
     <input type="name" class="form-control" rows="5" value="'.$ds['version'].'" name="version" placeholder="version"></em></span>
  </div>
  </div>
  <div class="mb-3 row">
    <label class="col-sm-5 col-form-label" for="path">'.$_language->module['folder_file'].': <br><small>('.$_language->module['folder_file_slash'].')</small></label>
    <div class="col-sm-7"><span class="text-muted small"><em>
     <input type="name" class="form-control" placeholder="includes/plugins/myplugin/"  value="'.$ds['path'].'" rows="5" name="path"></em></span>
  </div>
  </div>';
  #Speichern muss noch angepasst werden Startpage!!!
}else{
    echo'
    <h4>Plugin '.$_language->module['name'].': '.$ds['name'].'</h4>';

}


#Anzeige nur  für die Startpage!!!
$dm_plugin_module = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_module WHERE name = 'Startpage' and modulname = '".$dx['modulname']."' and themes_modulname = '".$db['modulname']."' and plugin_module = '1'"));

if (@$dm_plugin_module[ 'name' ] != $ds['name'] || @$dm_plugin_module[ 'modulname' ] != $ds['modulname'] && @$dm_plugin_module['themes_modulname'] != $db['modulname'] && @$dm_plugin_module['plugin_module'] != '1') {  


echo''; #Keine Anzeige bei allen Plugins
} else {

    $ergebnis = safe_query("SELECT * FROM " . PREFIX . "settings_module WHERE modulname = '".$ds['modulname']."' AND themes_modulname='".$db['modulname']."'");
    $dxsidebar = mysqli_fetch_array($ergebnis);
            $sidebar = '
			<option value="activated">'.$_language->module['sidebar_all_disable'].'</option>
            <option value="le_activated">'.$_language->module['left_sidebar_activated'].'</option>
            <option value="re_activated">'.$_language->module['right_sidebar_activated'].'</option>
            <option value="full_activated">'.$_language->module['all_sidebars_activated'].'</option>';
			
            $sidebar = str_replace('value="' . $dxsidebar['sidebar'] . '"', 'value="' . $dxsidebar['sidebar'] . '" selected="selected"', $sidebar);

    $moduls = safe_query("SELECT * FROM " . PREFIX . "settings_module WHERE modulname = '".$ds['modulname']."' AND themes_modulname='".$db['modulname']."'");

    while ($dy = mysqli_fetch_array($moduls)) {
        

        if ($dy[ 'via_navigation' ] == '1') {
            $via_navigation = '<input class="form-check-input" type="checkbox" name="via_navigation" value="1" checked="checked">';
        } else {
            $via_navigation = '<input class="form-check-input" type="checkbox" name="via_navigation" value="1">';
        }
        
        if ($dy[ 'head_activated' ] == '1') {
            $head_activated = '<input class="form-check-input" type="checkbox" name="head_activated" value="1" checked="checked">';
        } else {
            $head_activated = '<input class="form-check-input" type="checkbox" name="head_activated" value="1">';
        }

        if ($dy['content_head_activated'] == '1') {
            $content_head_activated = '<input class="form-check-input" type="checkbox" name="content_head_activated" value="1" checked="checked">';
        } else {
            $content_head_activated = '<input class="form-check-input" type="checkbox" name="content_head_activated" value="1">';
        }

        if ($dy['content_foot_activated'] == '1') {
            $content_foot_activated = '<input class="form-check-input" type="checkbox" name="content_foot_activated" value="1" checked="checked">';
        } else {
            $content_foot_activated = '<input class="form-check-input" type="checkbox" name="content_foot_activated" value="1">';
        }

        if ($dy['head_section_activated'] == '1') {
            $head_section_activated = '<input class="form-check-input" type="checkbox" name="head_section_activated" value="1" checked="checked">';
        } else {
            $head_section_activated = '<input class="form-check-input" type="checkbox" name="head_section_activated" value="1">';
        }

        if ($dy['foot_section_activated'] == '1') {
            $foot_section_activated = '<input class="form-check-input" type="checkbox" name="foot_section_activated" value="1" checked="checked">';
        } else {
            $foot_section_activated = '<input class="form-check-input" type="checkbox" name="foot_section_activated" value="1">';
        } 

		
        echo'

        <b>'.$_language->module['modul_basic_setting'].':</b>
          <hr>
    <div class="alert alert-success" role="alert">
			

          <div class="mb-3 row">
          <input type="hidden" name="mid" value="'.$dxsidebar['pluginID'].'" />
            <label class="col-sm-3 col-form-label" for="widget_link">'.$_language->module['sidebar_area'].'</label>
            <div class="col-sm-8">
            <select id="sidebar" name="sidebar" class="form-select">'.$sidebar.'</select>
        </div>
        </div>

        <div class="row">


            <div class="col-sm-6">

                <div class="custom-control custom-checkbox mb-3 row">
                    <label type="button" data-toggle="popover" data-img="../images/plugins/page_via_navigation_widget.jpg" class="col-sm-6 col-form-label" for="widget_link">'.$_language->module['via_navigation'].'</label>
                <div class="col-sm-6 form-check form-switch">
                    '.$via_navigation.'
                </div>
                </div>

            </div>
            <div class="col-sm-6">

                <div class="custom-control custom-checkbox mb-3 row">
                    <label type="button" data-toggle="popover" data-img="../images/plugins/page_head_widget.jpg" class="col-sm-6 col-form-label" for="widget_link">'.$_language->module['pagehead'].'</label>
                <div class="col-sm-6 form-check form-switch">
                    '.$head_activated.'
                </div>
                </div>

            </div>
        </div>
        <div class="row">   
            <div class="col-sm-6">

                <div class="custom-control custom-checkbox mb-3 row">
                    <label type="button" data-toggle="popover" data-img="../images/plugins/head_section_widget.jpg" class="col-sm-6 col-form-label" for="widget_link">'.$_language->module['headsection'].'</label>
                <div class="col-sm-6 form-check form-switch">
                    '.$head_section_activated.'
                </div>
                </div>

            </div>
          
            <div class="col-sm-6">

                <div class="custom-control custom-checkbox mb-3 row">
                    <label type="button" data-toggle="popover" data-img="../images/plugins/center_head_widget.jpg" class="col-sm-6 col-form-label" for="widget_link">'.$_language->module['headcontent'].'</label>
                <div class="col-sm-6 form-check form-switch">
                    '.$content_head_activated.'
                </div>
                </div>

            </div>          
            <div class="col-sm-6">

                <div class="custom-control custom-checkbox mb-3 row">
                    <label type="button" data-toggle="popover" data-img="../images/plugins/center_footer_widget.jpg" class="col-sm-6 col-form-label" for="widget_link">'.$_language->module['footcontent'].'</label>
                <div class="col-sm-6 form-check form-switch">
                    '.$content_foot_activated.'
                </div>
                </div>

            </div>
            <div class="col-sm-6">

                <div class="custom-control custom-checkbox mb-3 row">
                    <label type="button" data-toggle="popover" data-img="../images/plugins/foot_section_widget.jpg" class="col-sm-6 col-form-label" for="widget_link">'.$_language->module['footselection'].'</label>
                <div class="col-sm-6 form-check form-switch">
                    '.$foot_section_activated.'
                </div>
                </div>
            </div>

        </div>
    </div>
    <input type="hidden" name="captcha_hash" value="'.$hash.'" />
    <input type="hidden" name="pid" value="'.$ds['pluginID'].'" />
    <input type="hidden" name="activate" value="'.@$acti.'" />
    <input type="hidden" name="name" value="'.$ds['name'].'" />
    <input type="hidden" name="info" value="'.$ds['info'].'" />
    <input type="hidden" name="admin_file" value="'.$ds['admin_file'].'" />
    <input type="hidden" name="author" value="'.$ds['author'].'" />
    <input type="hidden" name="website" value="'.$ds['website'].'" />
    <input type="hidden" name="modulname" value="'.$ds['modulname'].'" />
    <input type="hidden" name="index" value="'.$ds['index_link'].'" />
    <input type="hidden" name="hiddenfiles" value="'.$ds['hiddenfiles'].'" />
    <input type="hidden" name="version" value="'.$ds['version'].'" />
    <input type="hidden" name="path" value="'.$ds['path'].'" />
    

    <input type="hidden" name="widgetname1" value="'.$ds['widgetname1'].'" />
    <input type="hidden" name="widget_link1" value="'.$ds['widget_link1'].'" />
    <input type="hidden" name="widgetname2" value="'.$ds['widgetname2'].'" />
    <input type="hidden" name="widget_link2" value="'.$ds['widget_link2'].'" />
    <input type="hidden" name="widgetname3" value="'.$ds['widgetname3'].'" />
    <input type="hidden" name="widget_link3" value="'.$ds['widget_link3'].'" />';
        echo'</div><div class="col-sm-6" style="height: 150px">';
    }
}
#Anzeige für die Startpage END

$dm_plugin_module = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_module WHERE modulname = '".$dx['modulname']."' and themes_modulname = '".$db['modulname']."' and plugin_module = '0'"));

if (@$dm_plugin_settings[ 'modulname' ] != $ds['modulname'] && @$dm_plugin_module['themes_modulname'] != $db['modulname'] && @$dm_plugin_module['plugin_module'] != '0') {

    $ergebnis = safe_query("SELECT * FROM " . PREFIX . "settings_module WHERE modulname = '".$ds['modulname']."' AND themes_modulname='".$db['modulname']."'");
    $dx_sidebar = mysqli_fetch_array($ergebnis);
            $sidebar = '
            <option value="activated">'.$_language->module['sidebar_all_disable'].'</option>
            <option value="le_activated">'.$_language->module['left_sidebar_activated'].'</option>
            <option value="re_activated">'.$_language->module['right_sidebar_activated'].'</option>
            <option value="full_activated">'.$_language->module['all_sidebars_activated'].'</option>';
            $sidebar = str_replace('value="' . $dx_sidebar['sidebar'] . '"', 'value="' . $dx_sidebar['sidebar'] . '" selected="selected"', $sidebar);

    $moduls = safe_query("SELECT * FROM " . PREFIX . "settings_module WHERE modulname = '".$ds['modulname']."' AND themes_modulname='".$db['modulname']."'");

    while ($dy = mysqli_fetch_array($moduls)) {
        
        
        if ($dy[ 'via_navigation' ] == '1') {
            $via_navigation = '<input class="form-check-input" type="checkbox" name="via_navigation" value="1" checked="checked">';
        } else {
            $via_navigation = '<input class="form-check-input" type="checkbox" name="via_navigation" value="1">';
        }

        if ($dy[ 'head_activated' ] == '1') {
            $head_activated = '<input class="form-check-input" type="checkbox" name="head_activated" value="1" checked="checked">';
        } else {
            $head_activated = '<input class="form-check-input" type="checkbox" name="head_activated" value="1">';
        }

        if ($dy['content_head_activated'] == '1') {
            $content_head_activated = '<input class="form-check-input" type="checkbox" name="content_head_activated" value="1" checked="checked">';
        } else {
            $content_head_activated = '<input class="form-check-input" type="checkbox" name="content_head_activated" value="1">';
        }

        if ($dy['content_foot_activated'] == '1') {
            $content_foot_activated = '<input class="form-check-input" type="checkbox" name="content_foot_activated" value="1" checked="checked">';
        } else {
            $content_foot_activated = '<input class="form-check-input" type="checkbox" name="content_foot_activated" value="1">';
        }

        if ($dy['head_section_activated'] == '1') {
            $head_section_activated = '<input class="form-check-input" type="checkbox" name="head_section_activated" value="1" checked="checked">';
        } else {
            $head_section_activated = '<input class="form-check-input" type="checkbox" name="head_section_activated" value="1">';
        }

        if ($dy['foot_section_activated'] == '1') {
            $foot_section_activated = '<input class="form-check-input" type="checkbox" name="foot_section_activated" value="1" checked="checked">';
        } else {
            $foot_section_activated = '<input class="form-check-input" type="checkbox" name="foot_section_activated" value="1">';
        } 


        echo'
        <b>'.$_language->module[ 'modul_basic_setting' ].':</b>
          <hr>
    <div class="alert alert-success" role="alert">

          <div class="mb-3 row">
          <input type="hidden" name="mid" value="'.$dx_sidebar['pluginID'].'" />
            <label class="col-sm-3 col-form-label" for="widget_link">'.$_language->module[ 'sidebar_area' ].'</label>
            <div class="col-sm-8">
            <select id="sidebar" name="sidebar" class="form-select">'.$sidebar.'</select>
        </div>
        </div>

        <div class="row">


            <div class="col-sm-6">

                <div class="custom-control custom-checkbox mb-3 row">
                    <label type="button" data-toggle="popover" data-bs-placement="top" data-img="../images/plugins/page_via_navigation_widget.jpg" class="col-sm-6 col-form-label" for="widget_link">'.$_language->module['via_navigation'].'</label>
                <div class="col-sm-6 form-check form-switch" style="padding: 0px 43px;">
                    '.$via_navigation.'
                </div>
                </div>

            </div>
            <div class="col-sm-6">

                <div class="custom-control custom-checkbox mb-3 row">
                    <label type="button" data-toggle="popover" data-bs-placement="top" data-img="../images/plugins/page_head_widget.jpg" class="col-sm-6 col-form-label" for="widget_link">'.$_language->module['pagehead'].'</label>
                <div class="col-sm-6 form-check form-switch" style="padding: 0px 43px;">
                    '.$head_activated.'
                </div>
                </div>

            </div>
        </div>
        <div class="row">   
            <div class="col-sm-6">

                <div class="custom-control custom-checkbox mb-3 row">
                    <label type="button" data-toggle="popover" data-bs-placement="top" data-img="../images/plugins/head_section_widget.jpg" class="col-sm-6 col-form-label" for="widget_link">'.$_language->module['headsection'].'</label>
                <div class="col-sm-6 form-check form-switch" style="padding: 0px 43px;">
                    '.$head_section_activated.'
                </div>
                </div>

            </div>
          
            <div class="col-sm-6">

                <div class="custom-control custom-checkbox mb-3 row">
                    <label type="button" data-toggle="popover" data-bs-placement="top" data-img="../images/plugins/center_head_widget.jpg" class="col-sm-6 col-form-label" for="widget_link">'.$_language->module['headcontent'].'</label>
                <div class="col-sm-6 form-check form-switch" style="padding: 0px 43px;">
                    '.$content_head_activated.'
                </div>
                </div>

            </div>          
            <div class="col-sm-6">

                <div class="custom-control custom-checkbox mb-3 row">
                    <label type="button" data-toggle="popover" data-bs-placement="top" data-img="../images/plugins/center_footer_widget.jpg" class="col-sm-6 col-form-label" for="widget_link">'.$_language->module['footcontent'].'</label>
                <div class="col-sm-6 form-check form-switch" style="padding: 0px 43px;">
                    '.$content_foot_activated.'
                </div>
                </div>

            </div>
            <div class="col-sm-6">

                <div class="custom-control custom-checkbox mb-3 row">
                    <label type="button" data-toggle="popover" data-bs-placement="top" data-img="../images/plugins/foot_section_widget.jpg" class="col-sm-6 col-form-label" for="widget_link">'.$_language->module['footselection'].'</label>
                <div class="col-sm-6 form-check form-switch" style="padding: 0px 43px;">
                    '.$foot_section_activated.'
                </div>
                </div>
            </div>

        </div>
    </div>';

    }

    echo'';
#Anzeige Bereich Plugin Module
}else{

}
#Anzeige Bereich Plugin Module END
echo'</div><div class="col-sm-6">';

# Plugin Widget Bereich

$dm_plugin_widget = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_module WHERE modulname = '".$dx['modulname']."' and themes_modulname = '".$db['modulname']."' and plugin_widget = '0'"));

if (@$dm_plugin_widget[ 'modulname' ] != $ds['modulname'] && @$dm_plugin_widget['themes_modulname'] != $db['modulname'] && @$dm_plugin_widget['plugin_widget'] != '0')  {

include 'settings_manager_widget_area_selection.php';


    $themeergebnis = safe_query("SELECT * FROM " . PREFIX . "settings_themes WHERE active = '1'");
    $db = mysqli_fetch_array($themeergebnis);

    $ergebnis = safe_query("SELECT * FROM " . PREFIX . "settings_module WHERE modulname = '".$ds['modulname']."' AND themes_modulname='".$db['modulname']."'");
    $dy = mysqli_fetch_array($ergebnis);
    
    $ergebnis = safe_query("SELECT * FROM " . PREFIX . "settings_widgets WHERE modulname = '".$ds['modulname']."' AND themes_modulname='".$db['modulname']."' AND widget='widget1' AND number='1'");
    $dx = mysqli_fetch_array($ergebnis);

    $ergebnis = safe_query("SELECT * FROM " . PREFIX . "settings_widgets WHERE modulname = '".$ds['modulname']."' AND themes_modulname='".$db['modulname']."' AND widget='widget1' AND number='2'");
    $dl = mysqli_fetch_array($ergebnis);

   
    $pic="<img src='../components/admin/images/info-logo.jpg'";
    $dm = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_widgets WHERE modulname = '".$ds['modulname']."' AND themes_modulname='".$db['modulname']."' AND widget='widget1'"));
    

        if (@$dm[ 'widget' ] != 'widget1' || @$dx[ 'number' ] == '') {
            $widget_1 = '<div class="alert alert-success" role="alert">
            <form class="form-horizontal" method="post" action="admincenter.php?site=plugin_manager" enctype="multipart/form-data">
            <input type="hidden" name="themes_modulname" value="'.$dy['themes_modulname'].'" />
            <input type="hidden" name="widgetname1" value="'.$ds['widgetname1'].'" />
            <input type="hidden" name="widget_link1" value="'.$ds['widget_link1'].'" />
            <input type="hidden" name="modulname" value="'.$ds['modulname'].'" />
            <input type="hidden" name="pluginID" value="'.$ds['pluginID'].'" />
            <input type="hidden" name="number" value="1" />
                <div class="mb-3 row">
                    <label class="col-sm-5 col-form-label" for="widget_link">'.$_language->module['area_widget'].'<br><br>
                    <button type="button" class="btn btn btn-info" data-toggle="popover" data-placement="top" data-img="../includes/plugins/'.$ds['modulname'].'/images/'.$ds['widget_link1'].'.jpg" title="Widget 1" >'.$_language->module['preview_widget'].'</button></label>
                    <div class="col-sm-7"><span class="text-muted small"><em>
                        <select id="description" name="description" class="form-select">'.$widget1.'</select></em></span>
                        <input type="hidden" name="captcha_hash" value="'.$hash.'" />
                        <button class="btn btn-warning" type="submit" name="save_widget1">'.$_language->module['add_widget'].'</button>
                    </div>
                </div>
            </form>';
            }elseif (@$dm[ 'widget' ] != 'widget1' || @$dx[ 'number' ] == '1') {
            $widget11 = str_replace('value="' . $dx['description'] . '"', 'value="' . $dx['description'] . '" selected="selected"', $widget1);
            
            $widget_1 = '<input type="hidden" name="wid" value="'.$dx['id'].'" />
            <form class="form-horizontal" method="post" action="admincenter.php?site=plugin_manager" enctype="multipart/form-data">
                <div class="alert alert-success" role="alert"><div class="mb-3 row">
                    <input type="hidden" name="themes_modulname" value="'.$dy['themes_modulname'].'" />
                    <input type="hidden" name="modulname" value="'.$ds['modulname'].'" />
                    <input type="hidden" name="wid1id" value="'.$dx['id'].'" />
                    <input type="hidden" name="pid" value="'.$ds['pluginID'].'" />
                    <input type="hidden" name="widgetname1" value="'.$ds['widgetname1'].'" />
                    <input type="hidden" name="widget_link1" value="'.$ds['widget_link1'].'" />
                    <label class="col-sm-5 col-form-label" for="widget_link">'.$_language->module['area_widget'].'<br><br>
                    <button type="button" class="btn btn btn-info" data-toggle="popover" data-placement="top" data-img="../includes/plugins/'.$ds['modulname'].'/images/'.$ds['widget_link1'].'.jpg" title="Widget 1" >'.$_language->module['preview_widget'].'</button></label>
                    <div class="col-sm-7"><span class="text-muted small"><em>
                        <select id="description" name="description" class="form-select">'.$widget11.'</select></em></span>                
                        <input type="hidden" name="captcha_hash" value="'.$hash.'" /><input type="hidden" name="id" value="'.$dx['id'].'" />
                        <button class="btn btn-warning" type="submit" name="edit_widget1">'.$_language->module['edit_widget'].'</button>           
                    </div>
                </div>
            </form>'; 
            } 

#Wird aus der settings_manager_widget_area_selection.php gelesen
if($widget_area_1) {


            if (@$dm[ 'widget' ] != 'widget1' || @$dl[ 'number' ] == '') {
            $widget_12 = '<form class="form-horizontal" method="post" action="admincenter.php?site=plugin_manager" enctype="multipart/form-data">
            <input type="hidden" name="themes_modulname" value="'.$dy['themes_modulname'].'" />
            <input type="hidden" name="widgetname1" value="'.$ds['widgetname1'].'" />
            <input type="hidden" name="widget_link1" value="'.$ds['widget_link1'].'" />
            <input type="hidden" name="modulname" value="'.$ds['modulname'].'" />
            <input type="hidden" name="pluginID" value="'.$ds['pluginID'].'" />
            <input type="hidden" name="number" value="2" />
                <div class="mb-3 row">
                    <label class="col-sm-5 col-form-label" for="widget_link">'.$_language->module['another_area'].'</label>
                    <div class="col-sm-7"><span class="text-muted small"><em>
                        <select id="description" name="description" class="form-select">'.$widget1.'</select></em></span>
                        <input type="hidden" name="captcha_hash" value="'.$hash.'" />
                        <button class="btn btn-warning" type="submit" name="save_widget1_1">'.$_language->module['add_widget'].'</button>
                    </div>
                </div>
            </form></div>';
            }elseif (@$dm[ 'widget' ] != 'widget1' || @$dl[ 'number' ] == '2') {
            $widget12 = str_replace('value="' . $dl['description'] . '"', 'value="' . $dl['description'] . '" selected="selected"', $widget1);
            
            $widget_12 = '<input type="hidden" name="wid" value="'.$dl['id'].'" />
            <form class="form-horizontal" method="post" action="admincenter.php?site=plugin_manager" enctype="multipart/form-data">             
                <input type="hidden" name="themes_modulname" value="'.$dy['themes_modulname'].'" />
                <input type="hidden" name="modulname" value="'.$ds['modulname'].'" />
                <input type="hidden" name="wid1id" value="'.$dl['id'].'" />
                <input type="hidden" name="pid" value="'.$ds['pluginID'].'" />
                <input type="hidden" name="widgetname1" value="'.$ds['widgetname1'].'" />
                <input type="hidden" name="widget_link1" value="'.$ds['widget_link1'].'" />               
                <div class="mb-3 row">
                    <label class="col-sm-5 col-form-label" for="widget_link">'.$_language->module['another_area'].'</label>
                    <div class="col-sm-7"><span class="text-muted small"><em>
                        <select id="description" name="description" class="form-select">'.$widget12.'</select></em></span>                
                        <input type="hidden" name="captcha_hash" value="'.$hash.'" /><input type="hidden" name="id" value="'.$dl['id'].'" />
                        <button class="btn btn-warning" type="submit" name="edit_widget1_1">'.$_language->module['edit_widget'].'</button>
                    </div>
                </div>
            </form></div>'; 
            }  

    }else{
        $widget_12 = '</div>';
    }           

    $themeergebnis = safe_query("SELECT * FROM " . PREFIX . "settings_themes WHERE active = '1'");
    $db = mysqli_fetch_array($themeergebnis);

    $ergebnis = safe_query("SELECT * FROM " . PREFIX . "settings_module WHERE modulname = '".$ds['modulname']."' AND themes_modulname='".$db['modulname']."'");
    $dy = mysqli_fetch_array($ergebnis);

    $ergebnis = safe_query("SELECT * FROM " . PREFIX . "settings_widgets WHERE modulname = '".$ds['modulname']."' AND themes_modulname='".$db['modulname']."' AND widget='widget2' AND number='1'");
    $dx = mysqli_fetch_array($ergebnis);

    $ergebnis = safe_query("SELECT * FROM " . PREFIX . "settings_widgets WHERE modulname = '".$ds['modulname']."' AND themes_modulname='".$db['modulname']."' AND widget='widget2' AND number='2'");
    $dl = mysqli_fetch_array($ergebnis);

    


$pic="<img src='../components/admin/images/info-logo.jpg'";
    $dm = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_widgets WHERE modulname = '".$ds['modulname']."' AND themes_modulname='".$db['modulname']."' AND widget='widget2'"));
    

        if (@$dm[ 'widget' ] != 'widget2' || @$dx[ 'number' ] == '') {
            $widget_2 = '<div class="alert alert-success" role="alert">
            <form class="form-horizontal" method="post" action="admincenter.php?site=plugin_manager" enctype="multipart/form-data">
            <input type="hidden" name="themes_modulname" value="'.$dy['themes_modulname'].'" />
            <input type="hidden" name="widgetname2" value="'.$ds['widgetname2'].'" />
            <input type="hidden" name="widget_link2" value="'.$ds['widget_link2'].'" />
            <input type="hidden" name="modulname" value="'.$ds['modulname'].'" />
            <input type="hidden" name="pluginID" value="'.$ds['pluginID'].'" />
            <input type="hidden" name="number" value="1" />
                <div class="mb-3 row">
                    <label class="col-sm-5 col-form-label" for="widget_link">'.$_language->module['area_widget'].'<br><br>
                    <button type="button" class="btn btn btn-info" data-toggle="popover" data-placement="top" data-img="../includes/plugins/'.$ds['modulname'].'/images/'.$ds['widget_link2'].'.jpg" title="Widget 2" >'.$_language->module['preview_widget'].'</button></label>
                    <div class="col-sm-7"><span class="text-muted small"><em>
                        <select id="description" name="description" class="form-select">'.$widget2.'</select></em></span>
                        <input type="hidden" name="captcha_hash" value="'.$hash.'" />
                        <button class="btn btn-warning" type="submit" name="save_widget2">'.$_language->module['add_widget'].'</button>
                    </div>
                </div>
            </form>';
            }elseif (@$dm[ 'widget' ] != 'widget2' || @$dx[ 'number' ] == '1') {
            $widget21 = str_replace('value="' . $dx['description'] . '"', 'value="' . $dx['description'] . '" selected="selected"', $widget2);
            
            $widget_2 = '<input type="hidden" name="wid" value="'.$dx['id'].'" />
            <form class="form-horizontal" method="post" action="admincenter.php?site=plugin_manager" enctype="multipart/form-data">
                <div class="alert alert-success" role="alert"><div class="mb-3 row">
                    <input type="hidden" name="themes_modulname" value="'.$dy['themes_modulname'].'" />
                    <input type="hidden" name="modulname" value="'.$ds['modulname'].'" />
                    <input type="hidden" name="wid2id" value="'.$dx['id'].'" />
                    <input type="hidden" name="pid" value="'.$ds['pluginID'].'" />
                    <input type="hidden" name="widgetname2" value="'.$ds['widgetname2'].'" />
                    <input type="hidden" name="widget_link2" value="'.$ds['widget_link2'].'" />
                    <label class="col-sm-5 col-form-label" for="widget_link">'.$_language->module['area_widget'].'<br><br>
                    <button type="button" class="btn btn btn-info" data-toggle="popover" data-placement="top" data-img="../includes/plugins/'.$ds['modulname'].'/images/'.$ds['widget_link2'].'.jpg" title="Widget 1" >'.$_language->module['preview_widget'].'</button></label>
                    <div class="col-sm-7"><span class="text-muted small"><em>
                        <select id="description" name="description" class="form-select">'.$widget21.'</select></em></span>                
                        <input type="hidden" name="captcha_hash" value="'.$hash.'" /><input type="hidden" name="id" value="'.$dx['id'].'" />
                        <button class="btn btn-warning" type="submit" name="edit_widget2">'.$_language->module['edit_widget'].'</button>           
                    </div>
                </div>
            </form>'; 
            } 

#Wird aus der settings_manager_widget_area_selection.php gelesen
if($widget_area_2) {


            if (@$dm[ 'widget' ] != 'widget2' || @$dl[ 'number' ] == '') {
            $widget_22 = '<form class="form-horizontal" method="post" action="admincenter.php?site=plugin_manager" enctype="multipart/form-data">
            <input type="hidden" name="themes_modulname" value="'.$dy['themes_modulname'].'" />
            <input type="hidden" name="widgetname2" value="'.$ds['widgetname2'].'" />
            <input type="hidden" name="widget_link2" value="'.$ds['widget_link2'].'" />
            <input type="hidden" name="modulname" value="'.$ds['modulname'].'" />
            <input type="hidden" name="pluginID" value="'.$ds['pluginID'].'" />
            <input type="hidden" name="number" value="2" />
                <div class="mb-3 row">
                    <label class="col-sm-5 col-form-label" for="widget_link">'.$_language->module['another_area'].'</label>
                    <div class="col-sm-7"><span class="text-muted small"><em>
                        <select id="description" name="description" class="form-select">'.$widget2.'</select></em></span>
                        <input type="hidden" name="captcha_hash" value="'.$hash.'" />
                        <button class="btn btn-warning" type="submit" name="save_widget2_1">'.$_language->module['add_widget'].'</button>
                    </div>
                </div>
            </form></div>';
            }elseif (@$dm[ 'widget' ] != 'widget2' || @$dl[ 'number' ] == '2') {
            $widget2 = str_replace('value="' . $dl['description'] . '"', 'value="' . $dl['description'] . '" selected="selected"', $widget2);
            
            $widget_22 = '<input type="hidden" name="wid" value="'.$dl['id'].'" />
            <form class="form-horizontal" method="post" action="admincenter.php?site=plugin_manager" enctype="multipart/form-data">             
                <input type="hidden" name="themes_modulname" value="'.$dy['themes_modulname'].'" />
                <input type="hidden" name="modulname" value="'.$ds['modulname'].'" />
                <input type="hidden" name="wid2id" value="'.$dl['id'].'" />
                <input type="hidden" name="pid" value="'.$ds['pluginID'].'" />
                <input type="hidden" name="widgetname2" value="'.$ds['widgetname2'].'" />
                <input type="hidden" name="widget_link2" value="'.$ds['widget_link2'].'" />               
                <div class="mb-3 row">
                    <label class="col-sm-5 col-form-label" for="widget_link">'.$_language->module['another_area'].'</label>
                    <div class="col-sm-7"><span class="text-muted small"><em>
                        <select id="description" name="description" class="form-select">'.$widget2.'</select></em></span>                
                        <input type="hidden" name="captcha_hash" value="'.$hash.'" /><input type="hidden" name="id" value="'.$dl['id'].'" />
                        <button class="btn btn-warning" type="submit" name="edit_widget2_1">'.$_language->module['edit_widget'].'</button>
                    </div>
                </div>
            </form></div>'; 
            }  

    }else{
        $widget_22 = '</div>';
    }       
               
    $themeergebnis = safe_query("SELECT * FROM " . PREFIX . "settings_themes WHERE active = '1'");
    $db = mysqli_fetch_array($themeergebnis);

    $ergebnis = safe_query("SELECT * FROM " . PREFIX . "settings_module WHERE modulname = '".$ds['modulname']."' AND themes_modulname='".$db['modulname']."'");
    $dy = mysqli_fetch_array($ergebnis);
    
    $ergebnis = safe_query("SELECT * FROM " . PREFIX . "settings_widgets WHERE modulname = '".$ds['modulname']."' AND themes_modulname='".$db['modulname']."' AND widget='widget3' AND number='1'");
    $dx = mysqli_fetch_array($ergebnis);

    $ergebnis = safe_query("SELECT * FROM " . PREFIX . "settings_widgets WHERE modulname = '".$ds['modulname']."' AND themes_modulname='".$db['modulname']."' AND widget='widget3' AND number='2'");
    $dl = mysqli_fetch_array($ergebnis);

    


$pic="<img src='../components/admin/images/info-logo.jpg'";
    $dm = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_widgets WHERE modulname = '".$ds['modulname']."' AND themes_modulname='".$db['modulname']."' AND widget='widget3'"));
    

        if (@$dm[ 'widget' ] != 'widget3' || @$dx[ 'number' ] == '') {
            $widget_3 = '<div class="alert alert-success" role="alert">
            <form class="form-horizontal" method="post" action="admincenter.php?site=plugin_manager" enctype="multipart/form-data">
            <input type="hidden" name="themes_modulname" value="'.$dy['themes_modulname'].'" />
            <input type="hidden" name="widgetname3" value="'.$ds['widgetname3'].'" />
            <input type="hidden" name="widget_link3" value="'.$ds['widget_link3'].'" />
            <input type="hidden" name="modulname" value="'.$ds['modulname'].'" />
            <input type="hidden" name="pluginID" value="'.$ds['pluginID'].'" />
            <input type="hidden" name="number" value="1" />
                <div class="mb-3 row">
                    <label class="col-sm-5 col-form-label" for="widget_link">'.$_language->module['area_widget'].'<br><br>
                    <button type="button" class="btn btn btn-info" data-toggle="popover" data-placement="top" data-img="../includes/plugins/'.$ds['modulname'].'/images/'.$ds['widget_link3'].'.jpg" title="Widget 1" >'.$_language->module['preview_widget'].'</button></label>
                    <div class="col-sm-7"><span class="text-muted small"><em>
                        <select id="description" name="description" class="form-select">'.$widget3.'</select></em></span>
                        <input type="hidden" name="captcha_hash" value="'.$hash.'" />
                        <button class="btn btn-warning" type="submit" name="save_widget3">'.$_language->module['add_widget'].'</button>
                    </div>
                </div>
            </form>';
            }elseif (@$dm[ 'widget' ] != 'widget3' || @$dx[ 'number' ] == '1') {
            $widget31 = str_replace('value="' . $dx['description'] . '"', 'value="' . $dx['description'] . '" selected="selected"', $widget3);
            
            $widget_3 = '<input type="hidden" name="wid" value="'.$dx['id'].'" />

            <form class="form-horizontal" method="post" action="admincenter.php?site=plugin_manager" enctype="multipart/form-data">
                <div class="alert alert-success" role="alert"><div class="mb-3 row">
                    <input type="hidden" name="themes_modulname" value="'.$dy['themes_modulname'].'" />
                    <input type="hidden" name="modulname" value="'.$ds['modulname'].'" />
                    <input type="hidden" name="wid3id" value="'.$dx['id'].'" />
                    <input type="hidden" name="pid" value="'.$ds['pluginID'].'" />
                    <input type="hidden" name="widgetname3" value="'.$ds['widgetname3'].'" />
                    <input type="hidden" name="widget_link3" value="'.$ds['widget_link3'].'" />
                    <label class="col-sm-5 col-form-label" for="widget_link">'.$_language->module['area_widget'].'<br><br>
                    <button type="button" class="btn btn btn-info" data-toggle="popover" data-placement="top" data-img="../includes/plugins/'.$ds['modulname'].'/images/'.$ds['widget_link3'].'.jpg" title="Widget 1" >'.$_language->module['preview_widget'].'</button></label>
                    <div class="col-sm-7"><span class="text-muted small"><em>
                        <select id="description" name="description" class="form-select">'.$widget31.'</select></em></span>                
                        <input type="hidden" name="captcha_hash" value="'.$hash.'" /><input type="hidden" name="id" value="'.$dx['id'].'" />
                        <button class="btn btn-warning" type="submit" name="edit_widget3">'.$_language->module['edit_widget'].'</button>           
                    </div>
                </div>
            </form>'; 
            } 

#Wird aus der settings_manager_widget_area_selection.php gelesen
if($widget_area_3) {


            if (@$dm[ 'widget' ] != 'widget3' || @$dl[ 'number' ] == '') {
            $widget_32 = '<form class="form-horizontal" method="post" action="admincenter.php?site=plugin_manager" enctype="multipart/form-data">
            <input type="hidden" name="themes_modulname" value="'.$dy['themes_modulname'].'" />
            <input type="hidden" name="widgetname3" value="'.$ds['widgetname3'].'" />
            <input type="hidden" name="widget_link3" value="'.$ds['widget_link3'].'" />
            <input type="hidden" name="modulname" value="'.$ds['modulname'].'" />
            <input type="hidden" name="pluginID" value="'.$ds['pluginID'].'" />
            <input type="hidden" name="number" value="2" />
                <div class="mb-3 row">
                <label class="col-sm-5 col-form-label" for="widget_link">'.$_language->module['another_area'].'</label>
                <div class="col-sm-7"><span class="text-muted small"><em>
                <select id="description" name="description" class="form-select">'.$widget3.'</select></em></span>
                <input type="hidden" name="captcha_hash" value="'.$hash.'" />
                <button class="btn btn-warning" type="submit" name="save_widget3_1"  />'.$_language->module['add_widget'].'</button>
            </div>
            </div>
            </form></div>';
            }elseif (@$dm[ 'widget' ] != 'widget3' || @$dl[ 'number' ] == '2') {
            $widget3 = str_replace('value="' . $dl['description'] . '"', 'value="' . $dl['description'] . '" selected="selected"', $widget3);
            
            $widget_32 = '<input type="hidden" name="wid" value="'.$dl['id'].'" />
            <form class="form-horizontal" method="post" action="admincenter.php?site=plugin_manager" enctype="multipart/form-data">             
                <input type="hidden" name="themes_modulname" value="'.$dy['themes_modulname'].'" />
                <input type="hidden" name="modulname" value="'.$ds['modulname'].'" />
                <input type="hidden" name="wid3id" value="'.$dl['id'].'" />
                <input type="hidden" name="pid" value="'.$ds['pluginID'].'" />
                <input type="hidden" name="widgetname3" value="'.$ds['widgetname3'].'" />
                <input type="hidden" name="widget_link3" value="'.$ds['widget_link3'].'" />               
                <div class="mb-3 row">
                <label class="col-sm-5 col-form-label" for="widget_link">'.$_language->module['another_area'].'</label>
                <div class="col-sm-7"><span class="text-muted small"><em>
                <select id="description" name="description" class="form-select">'.$widget3.'</select></em></span>                
                <input type="hidden" name="captcha_hash" value="'.$hash.'" /><input type="hidden" name="id" value="'.$dl['id'].'" />
                <button class="btn btn-warning" type="submit" name="edit_widget3_1"  />'.$_language->module['edit_widget'].'</button>
            </div>
            </div>
            </form></div>'; 
            }  

    }else{
        $widget_32 = '</div>';
    }  
            
            # Widget Bereich wird nicht angezeigt
            $widgetone = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_module WHERE modulname = '".$ds['modulname']."' AND themes_modulname='".$db['modulname']."' AND widget1 ='0'"));
            if (@$widgetone[ 'widget1' ] != '0') {
            # Widget Bereich wird nicht angezeigt 

            echo'<b>'.$_language->module['widget_setting'].':</b>
            <hr>';        
            echo'<div class="mb-3 row">  
                <label class="col-sm-5 col-form-label" for="name">'.$_language->module['widgetname1'].': <br><small>('.$_language->module['for_widgetname1'].')</small></label>
                <div class="col-sm-7"><span class="text-muted small"><em>
                <input type="name" class="form-control" placeholder="Widget_name" name="widget_name1" value="'.$ds['widgetname1'].'"></em></span>
              </div>
              </div>
              <div class="mb-3 row">
                <label class="col-sm-5 col-form-label" for="widget_link">'.$_language->module['widgetfile1'].': <br><small>('.$_language->module['widgetfile1_empty'].')</small></label>
                <div class="col-sm-7"><span class="text-muted small"><em>
                 <input type="name" class="form-control" rows="5" placeholder="Widget_myplugin" value="'.$ds['widget_link1'].'" name="widget_link_1"></em></span>
              </div>
              </div>
                
                '.$widget_1.''.$widget_12.'<hr>';
            }else{echo'';}
                # Widget Bereich wird nicht angezeigt
                $widgettwo = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_module WHERE modulname = '".$ds['modulname']."' AND themes_modulname='".$db['modulname']."' AND widget2 ='0'"));
                if (@$widgettwo[ 'widget2' ] != '0') {
                # Widget Bereich wird nicht angezeigt 
            echo' 
             <div class="mb-3 row">
                <label class="col-sm-5 col-form-label" for="name">'.$_language->module['widgetname2'].': <br><small>('.$_language->module['for_widgetname2'].')</small></label>
                <div class="col-sm-7"><span class="text-muted small"><em>
                <input type="name" class="form-control" placeholder="Widget_name" name="widgetname2" value="'.$ds['widgetname2'].'"></em></span>
              </div>
              </div>
              <div class="mb-3 row">
                <label class="col-sm-5 col-form-label" for="widget_link">'.$_language->module['widgetfile2'].': <br><small>('.$_language->module['widgetfile1_empty'].')</small></label>
                <div class="col-sm-7"><span class="text-muted small"><em>
                 <input type="name" class="form-control" rows="5" placeholder="Widget_myplugin" value="'.$ds['widget_link2'].'" name="widget_link2"></em></span>
              </div>
              </div> 
                '.$widget_2.''.$widget_22.'<hr>';
            }else{echo'';}

                # Widget Bereich wird nicht angezeigt
                $widgetthree = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_module WHERE modulname = '".$ds['modulname']."' AND themes_modulname='".$db['modulname']."' AND widget3 ='0'"));
                if (@$widgetthree[ 'widget3' ] != '0') {
                # Widget Bereich wird nicht angezeigt 
            echo' 
              <div class="mb-3 row">
                <label class="col-sm-5 col-form-label" for="name">'.$_language->module['widgetname3'].': <br><small>('.$_language->module['for_widgetname3'].')</small></label>
                <div class="col-sm-7"><span class="text-muted small"><em>
                <input type="name" class="form-control" placeholder="Widget_name" name="widgetname3" value="'.$ds['widgetname3'].'"></em></span>
              </div>
              </div>
              <div class="mb-3 row">
                <label class="col-sm-5 col-form-label" for="widget_link">'.$_language->module['widgetfile3'].': <br><small>('.$_language->module['widgetfile1_empty'].')</small></label>
                <div class="col-sm-7"><span class="text-muted small"><em>
                 <input type="name" class="form-control" rows="5" placeholder="Widget_myplugin" value="'.$ds['widget_link3'].'" name="widget_link3"></em></span>
              </div>
              </div>
            '.$widget_3.''.$widget_32.'';
            }else{echo'';}

    echo'</div>';
# Plugin Widget Bereich
}else{
    echo'</div>';
}
# Plugin Widget Bereich END

echo'<div class="col-sm-12">';

echo'<div class="mb-3 row">
    <label class="col-sm- col-form-label" for="name"></label>
    <div class="col-sm-6">
    
    

    <button class="btn btn-warning" type="submit" name="saveedit">'.$_language->module['edit_plugin_widget'].'</button>
    </div>
  </div>
</div>

</div>
</div>
</form>
</div>
  </div>';

return false;

} elseif ($action == "new") {
?><script>
    <!--
    function chkFormular() {
        if (document.getElementById('name').value == "") {
            alert('<? echo $_language->module['no_plugin_name'];?>');
            document.getElementById('name').focus();
            return false;
        }

        if (document.getElementById('modulname').value == "") {
            alert('<? echo $_language->module['no_modul_name'];?>');
            document.getElementById('modulname').focus();
            return false;
        }        

    }
    -->
</script><?php


$themeergebnis = safe_query("SELECT * FROM " . PREFIX . "settings_themes WHERE active = '1'");
    $db = mysqli_fetch_array($themeergebnis);


	echo '<div class="card">
        <div class="card-header"><i class="bi bi-puzzle" style="font-size: 1rem;"></i> 
            '.$_language->module['plugin_manager'].'
        </div>
            
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="admincenter.php?site=plugin_manager">' . $_language->module['plugin_manager'] . '</a></li>
    <li class="breadcrumb-item active" aria-current="page">' . $_language->module['add_plugin'] . '</li>
  </ol>
</nav>
     <div class="card-body">';

  echo'<form class="form-horizontal" method="post" id="post" name="post" action="admincenter.php?site=plugin_manager" onsubmit="return chkFormular();" enctype="multipart/form-data">
       <form class="form-horizontal" method="post" id="post" name="post" action="admincenter.php?site=plugin_manager" enctype="multipart/form-data" onsubmit="return chkFormular();"> 
  <div class="row">
<div class="col-sm-6">

  <div class="mb-3 row">
     <label class="col-sm-5 col-form-label" for="name">'.$_language->module['name'].':<font color="#DD0000">*</font></label>
    <div class="col-sm-6"><span class="text-muted small"><em>
    <input type="text" name="name" id="name" placeholder="plugin name" maxlength="30" autocomplete="name" class="form-control"></em></span>
  </div>
  </div>
  <div class="mb-3 row">
     <label class="col-sm-5 col-form-label" for="name">'.$_language->module['description'].':</label>
    <div class="col-sm-6"><span class="text-muted small"><em>
    <textarea class="form-control" name="info" rows="5" cols="" style="width: 100%;" placeholder="info"></textarea></em></span>
  </div>
  </div>
  
  <div class="mb-3 row">
 	<label class="col-sm-5 col-form-label" for="admin_file">'.$_language->module['admin_file'].': <br><small>('.$_language->module['index_file_nophp'].')</small></label>
 	<div class="col-sm-6"><span class="text-muted small"><em>
 	 <input type="name" class="form-control" name="admin_file" placeholder="admin_file"></em></span>
  </div>
  </div>
  <div class="mb-3 row">
 	<label class="col-sm-5 col-form-label" for="author">'.$_language->module['author'].':</label>
 	<div class="col-sm-6"><span class="text-muted small"><em>
 	 <input type="name" class="form-control" rows="5" name="author" placeholder="author"></em></span>
  </div>
  </div>
  <div class="mb-3 row">
 	<label class="col-sm-5 col-form-label" for="website">'.$_language->module['website'].':</label>
 	<div class="col-sm-6"><span class="text-muted small"><em>
 	 <input type="name" class="form-control" placeholder="http://" rows="5" name="website"></em></span>
  </div>
  </div>
  <div class="mb-3 row">
     <label class="col-sm-5 col-form-label" for="name">'.$_language->module['modulname'].': <font color="#DD0000">*</font> <br><small>('.$_language->module['for_uninstall'].')</small></label>
    <div class="col-sm-6"><span class="text-muted small"><em>
    <input type="text" name="modulname" id="modulname" placeholder="modulname" maxlength="30" autocomplete="modulname" class="form-control"></em></span>
  </div>
  </div>
  <div class="mb-3 row">
  <label class="col-sm-5 col-form-label" for="index">'.$_language->module['index_file'].': <br><small>('.$_language->module['index_file_nophp'].')</small></label>
  <div class="col-sm-6"><span class="text-muted small"><em>
   <input type="name" class="form-control" placeholder="index file" rows="5" name="index"></em></span>
  </div>
  </div>
  <div class="mb-3 row">
  <label class="col-sm-5 col-form-label" for="hittenfiles">'.$_language->module['hidden_file'].': <br><small>('.$_language->module['hidden_file_seperate'].')</small></label>
  <div class="col-sm-6"><span class="text-muted small"><em>
   <input type="name" class="form-control" rows="5" placeholder="myfile,secondfile,anotherfile" name="hiddenfiles"></em></span>
  </div>
  </div>
  <div class="mb-3 row">
  <label class="col-sm-5 col-form-label" for="version">'.$_language->module['version_file'].':</label>
  <div class="col-sm-6"><span class="text-muted small"><em>
   <input type="name" class="form-control" rows="5" name="version" placeholder="version"></em></span>
  </div>
  </div>
  <div class="mb-3 row">
  <label class="col-sm-5 col-form-label" for="path">'.$_language->module['folder_file'].': <br><small>('.$_language->module['folder_file_slash'].')</small></label>
  <div class="col-sm-6"><span class="text-muted small"><em>
   <input type="name" class="form-control" placeholder="includes/plugins/myplugin/" rows="5" name="path"></em></span>
  </div>
  </div>

  </div>
<div class="col-sm-6">

  
    
'.$_language->module['widget_setting'].':
  <hr>
  <div class="mb-3 row">
    <label class="col-sm-5 col-form-label" for="name">'.$_language->module['widgetname1'].': <br><small>('.$_language->module['for_widgetname1'].')</small></label>
    <div class="col-sm-6"><span class="text-muted small"><em>
    <input type="name" class="form-control" placeholder="Widget_name" name="widgetname1"></em></span>
  </div>
  </div>
  <div class="mb-3 row">
  <label class="col-sm-5 col-form-label" for="widget_link">'.$_language->module['widgetfile1'].': <br><small>('.$_language->module['widgetfile1_empty'].')</small></label>
  <div class="col-sm-6"><span class="text-muted small"><em>
   <input type="name" class="form-control" rows="5" placeholder="Widget_myplugin" name="widget_link1"></em></span>
  </div>
  </div>


  
 <hr> 
 <div class="mb-3 row">
    <label class="col-sm-5 col-form-label" for="name">'.$_language->module['widgetname2'].': <br><small>('.$_language->module['for_widgetname2'].')</small></label>
    <div class="col-sm-6"><span class="text-muted small"><em>
    <input type="name" class="form-control" placeholder="Widget_name" name="widgetname2"></em></span>
  </div>
  </div>
  <div class="mb-3 row">
    <label class="col-sm-5 col-form-label" for="widget_link">'.$_language->module['widgetfile2'].': <br><small>('.$_language->module['widgetfile1_empty'].')</small></label>
    <div class="col-sm-6"><span class="text-muted small"><em>
     <input type="name" class="form-control" rows="5" placeholder="Widget_myplugin" name="widget_link2"></em></span>
  </div>
  </div>

  
  <hr>
  <div class="mb-3 row">
    <label class="col-sm-5 col-form-label" for="name">'.$_language->module['widgetname3'].': <br><small>('.$_language->module['for_widgetname3'].')</small></label>
    <div class="col-sm-6"><span class="text-muted small"><em>
    <input type="name" class="form-control" placeholder="Widget_name" name="widgetname3"></em></span>
  </div>
  </div>
  <div class="mb-3 row">
    <label class="col-sm-5 col-form-label" for="widget_link">'.$_language->module['widgetfile3'].': <br><small>('.$_language->module['widgetfile1_empty'].')</small></label>
    <div class="col-sm-6"><span class="text-muted small"><em>
     <input type="name" class="form-control" rows="5" placeholder="Widget_myplugin" name="widget_link3"></em></span>
  </div>
  </div>

</div>



<div class="col-sm-12">

<div class="mb-3 row">
<div class="col-sm-11"><font color="#DD0000">*</font>'.$_language->module['fields_star_required'] . '</div>

    <div class="col-sm-11">
<input type="hidden" name="themes_modulname" value="'.$db['modulname'].'" />
    <button class="btn btn-success" type="submit" name="svn"  />' . $_language->module['add'] . '</button>
    </div>
  </div>

</div>
  </form></div>
  </div>';
return false;
  

echo'</div></div>';
} else {
echo'<div class="card">
        <div class="card-header"><i class="bi bi-puzzle" style="font-size: 1rem;"></i> 
            '.$_language->module['plugin_manager'].'
        </div>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="admincenter.php?site=plugin_manager">' . $_language->module[ 'plugin_manager' ] . '</a></li>
    <li class="breadcrumb-item active" aria-current="page">new & edit</li>
  </ol>
</nav>

<div class="card-body">';
$thergebnis = safe_query("SELECT * FROM " . PREFIX . "settings_themes WHERE active = '1'");
    $db = mysqli_fetch_array($thergebnis);
  echo'<div class="mb-12 row">
    <label class="col-md-1 control-label"><h4>Template:</h4></label>
    <div class="col-md-3"><div class="alert alert-info" role="alert" style="padding: 0px 5px">
<h4>'.$themes_modulname.'</h4></div>
    </div>
  </div>
<hr>
<div class="mb-3 row">
    <label class="col-md-1 control-label">' . $_language->module['options'] . ':</label>
    <div class="col-md-8">
      <a href="admincenter.php?site=plugin_manager&action=new" class="btn btn-primary" type="button">' . $_language->module[ 'new_plugin' ] . '</a>
    </div>
  </div>

  ';
  
  
    $CAPCLASS = new \webspell\Captcha;
    $CAPCLASS->createTransaction();
    $hash = $CAPCLASS->getHash();
  
  $ergebnis=safe_query("SELECT * FROM " . PREFIX . "settings_plugins where modul_display='1'");

  echo'<table id="plugini" class="table table-striped table-bordered" style="width:100%">
    <thead>
      <th><strong>' . $_language->module[ 'id' ] . '</strong></th>
      <th width="10%"><strong>' . $_language->module[ 'plugin' ] . ' ' . $_language->module[ 'name' ] . '</th>
      <th><strong>' . $_language->module[ 'plugin' ] . ' ' . $_language->module[ 'description' ] . '</th>
      <th width="20%"><strong>' . $_language->module[ 'status' ] . '</th>
      <th width="20%"><strong>' . $_language->module[ 'option' ] . '</th>
    </thead>';
    while ($ds = mysqli_fetch_array($ergebnis)) {

            if ($ds[ 'activate' ] == "1") {
                $actions=
                    '<a href="admincenter.php?site=plugin_manager&id='.$ds['pluginID'].'&modulname='.$ds['modulname'].'&do=dea" class="btn btn-info" data-toggle="tooltip" data-html="true" title="' . $_language->module[ 'tooltip_2' ]. ' " type="button">' . $_language->module[ 'deactivate' ] . '</a>';
            } else {
                $actions= '<a href="admincenter.php?site=plugin_manager&id='.$ds['pluginID'].'&modulname='.$ds['modulname'].'&do=act" class="btn btn-success" data-toggle="tooltip" data-html="true" title="' . $_language->module[ 'tooltip_1' ]. ' " type="button">' . $_language->module[ 'activate' ] . '</a>';
            }

            $translate = new multiLanguage(detectCurrentLanguage());
            $translate->detectLanguages($ds['name']);
            $ds['name'] = $translate->getTextByLanguage($ds['name']);
            $translate->detectLanguages($ds['info']);
            $ds['info'] = $translate->getTextByLanguage($ds['info']);

    echo'<tr>
        <td>'.$ds['pluginID'].'</td>
        <td><b>'.$ds['name'].'</b></td>
        <td>'.$ds['info'].'</td>';


    $xergebnis = safe_query("SELECT * FROM " . PREFIX . "settings_module WHERE modulname='".$ds['modulname']."'");
    $dp = mysqli_fetch_array($xergebnis);

    $themeergebnis = safe_query("SELECT * FROM " . PREFIX . "settings_themes WHERE active = '1'");
    $db_theme = mysqli_fetch_array($themeergebnis);

    $themeergebnis = safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname = '".$ds['modulname']."'");
    $ipdb = mysqli_fetch_array($themeergebnis);    



$dttp = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_module WHERE modulname = '".$ds['modulname']."' and themes_modulname = 'default' and modul_display = '1'"));

if (@$dttp[ 'modulname' ] != $ds['modulname'] && @$db_theme['themes_modulname'] != 'default' && @$dttp['modul_display'] != '1') {  

echo'<td><a href="admincenter.php?site=plugin_installer&id='.$ds['pluginID'].'&up=install&dir=/'.$ds['modulname'].'/" class="btn btn-primary" data-toggle="tooltip" data-html="true" title="' . $_language->module[ 'tooltip_3' ]. ' " type="button">' . $_language->module[ 'reinstall_plugin' ] . '</a></td><td><div class="alert alert-danger" role="alert">' . $_language->module[ 'settings_are_not_available' ] . '</div></td>';
      
}else{   

    $dttp = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_module WHERE themes_modulname = '".$db_theme['modulname']."' and modulname = '".$ds['modulname']."' and modul_display = '1'"));

    if (@$dttp[ 'modulname' ] != $ds['modulname'] && @$dttp['themes_modulname'] != @$db_theme['modulname']) {  

    echo'<td>
            <form method="post" id="post" name="post" action="admincenter.php?site=plugin_manager" enctype="multipart/form-data" onsubmit="return chkFormular();">
                <input type="hidden" name="name" value="'.$ds['name'].'" />
                <input type="hidden" name="modulname" value="'.$ds['modulname'].'" />
                <input type="hidden" name="themes_modulname" value="'.$db_theme['modulname'].'" />
                <input type="hidden" name="sidebar" value="'.@$dp['sidebar'].'" />
                <input type="hidden" name="via_navigation" value="'.@$dp['via_navigation'].'" />
                <input type="hidden" name="head_activated" value="'.@$dp['head_activated'].'" />
                <input type="hidden" name="content_head_activated" value="'.@$dp['content_head_activated'].'" />
                <input type="hidden" name="content_foot_activated" value="'.@$dp['content_foot_activated'].'" />
                <input type="hidden" name="head_section_activated" value="'.@$dp['head_section_activated'].'" />
                <input type="hidden" name="foot_section_activated" value="'.@$dp['foot_section_activated'].'" />
                <input type="hidden" name="modul_display" value="'.@$dp['modul_display'].'" />
                <input type="hidden" name="full_activated" value="'.@$dp['full_activated'].'" />
                <input type="hidden" name="plugin_settings" value="'.@$dp['plugin_settings'].'" />
                <input type="hidden" name="plugin_module" value="'.@$dp['plugin_module'].'" />
                <input type="hidden" name="plugin_widget" value="'.@$dp['plugin_widget'].'" />
                <input type="hidden" name="widget1" value="'.@$dp['widget1'].'" />
                <input type="hidden" name="widget2" value="'.@$dp['widget2'].'" />
                <input type="hidden" name="widget3" value="'.@$dp['widget3'].'" />
                <input type="hidden" name="captcha_hash" value="'.$hash.'" /><button class="btn btn-success" data-toggle="tooltip" data-html="true" title="' . $_language->module[ 'tooltip_5' ]. ' " type="submit" name="save_theme"  />' . $_language->module[ 'theme_activate' ] . '</button>
            </form>
            </td>
            <td>
                <div class="alert alert-success" role="alert">' . $_language->module[ 'plugin_to_template_activate' ] . '</div>
            </td>';
        }else{

           echo'<td>';
            $dm_startpage = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_module WHERE name = 'Startpage' and modulname = '".$ds['modulname']."'"));

    if (@$dm_startpage[ 'name' ] != 'Startpage') {
                echo''.$actions.''; 
            }else{
                echo'';
            }

            $themes_modulname = $db_theme['modulname'];
            echo'</td>
                <td>
                
                <a href="admincenter.php?site=plugin_manager&action=edit&id='.$ds['pluginID'].'&do=edit" class="btn btn-warning" data-toggle="tooltip" data-html="true" title="' . $_language->module[ 'tooltip_4' ]. ' " type="button">' . $_language->module[ 'edit' ] . '</a>';

$dm_startpage = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_module WHERE name = 'Startpage' and modulname = '".$ds['modulname']."'"));

    if (@$dm_startpage[ 'name' ] != 'Startpage') {
    echo'<!-- Button trigger modal -->
    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirm-delete" data-toggle="tooltip" data-html="true" title="' . $_language->module[ 'tooltip_6' ]. ' " data-href="admincenter.php?site=plugin_manager&amp;delete=true&amp;themes_modulname ='.$db['modulname'].'&amp;modulname='.$ds['modulname'].'&amp;captcha_hash=' . $hash . '">
    ' . $_language->module['theme_deactivate'] . '
    </button>
    <!-- Button trigger modal END-->';
    echo'</td>';
    echo'<!-- Modal -->
    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">' . $_language->module[ 'name' ] . '</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="' . $_language->module[ 'close' ] . '"></button>
          </div>
          <div class="modal-body"><p>' . $_language->module['really_delete1'] . '</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">' . $_language->module[ 'close' ] . '</button>
            <a class="btn btn-danger btn-ok">' . $_language->module['delete'] . '</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal END -->'; 
        }else{
            echo'';
        }


        }

}
echo'</tr>';
   
}     

echo'</table>';  

echo '</div></div>';
}


} else {

    echo '<style type="text/css">
     p.test {
        font-family: Georgia, serif;
        font-size: 78px;
        font-style: italic;
    }
    .titlehead {
        border: 3px solid;
        border-color: #c4183c; 
        background-color: #fff}
    </style>
    <div class="card">
        <div class="card-body">
            <div class="titlehead"><br>
                <center>
            <div>
                <img class="img-fluid" src="/images/install-logo.jpg" alt="" style="height: 150px"/><br>
                  <small>Ohje !</small><br>
                  <p class="test">404 Error.</p><br>
                  '.$_language->module["info"].'
            </div>
            <br />
                  <p><a class="btn btn-warning" href="/admin/admincenter.php?site=settings_templates">'.$_language->module["activate_template"].'</a></p>
                  <br />
                </center>
            </div>
        </div>
    </div>';
}
?>
