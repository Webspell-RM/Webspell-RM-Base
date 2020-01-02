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
#Funktionen für die index.php (/includes/themes/default/)

#Title Ausgabe für die Webseite
function get_sitetitle() {

    $sitetitle = new plugin_manager();
    if(isset($_GET['site']) AND $sitetitle->plugin_updatetitle($_GET['site'])) {
        echo $sitetitle->plugin_updatetitle($_GET['site']);
    } else {
        echo PAGETITLE;
    }
}


/*function get_sitecss() {

    $sitetitle = new plugin_manager();
    if(isset($_GET['site'])) {
        echo $_GET['site'];
    } else {
        #echo PAGETITLE;
    }
}*/

#function hide / r/l Spalte, head, foot, content_head und conten foot
function get_hide () { 
    global $hide, $hide1, $hide2, $hide3, $hide4, $hide5;

$sql = safe_query("SELECT module, head_activated FROM ".PREFIX."settings_moduls WHERE head_activated = '0'");
if(mysqli_num_rows($sql)) {
    while($row = mysqli_fetch_array($sql)) {
        $hide[] = $row['module'];
    }
}
else {
    $hide = array();
}

$sql = safe_query("SELECT module, re_activated FROM ".PREFIX."settings_moduls WHERE re_activated = '1'");
if(mysqli_num_rows($sql)) {
    while($row = mysqli_fetch_array($sql)) {
        $hide1[] = $row['module'];
    }
}
else {
    $hide1 = array();
}

$sql = safe_query("SELECT module, le_activated FROM ".PREFIX."settings_moduls WHERE le_activated = '1'");
if(mysqli_num_rows($sql)) {
    while($row = mysqli_fetch_array($sql)) {
        $hide2[] = $row['module'];
    }
}
else {
    $hide2 = array();
}

$sql = safe_query("SELECT module, activated FROM ".PREFIX."settings_moduls WHERE activated = '1'");
if(mysqli_num_rows($sql)) {
    while($row = mysqli_fetch_array($sql)) {
        $hide3[] = $row['module'];
    }
}
else {
    $hide3 = array();
}

$sql = safe_query("SELECT module, content_head_activated FROM ".PREFIX."settings_moduls WHERE content_head_activated = '0'");
if(mysqli_num_rows($sql)) {
    while($row = mysqli_fetch_array($sql)) {
        $hide4[] = $row['module'];
    }
}
else {
    $hide4 = array();
}

$sql = safe_query("SELECT module, content_foot_activated FROM ".PREFIX."settings_moduls WHERE content_foot_activated = '0'");
if(mysqli_num_rows($sql)) {
    while($row = mysqli_fetch_array($sql)) {
        $hide5[] = $row['module'];
    }
}
else {
    $hide5 = array();
}

}

# die Breite von content wird automatisch angepasst / linke - rechte Spalte activated oder deactivated

function get_mainhide () { 
    global $class_maincol, $site, $hide1, $hide2, $hide3;

if (in_array($site, $hide1)) {
                echo "col-lg-9 col-sm-9 col-xs-12";
            }
            elseif (in_array($site, $hide2)) {
                echo "col-lg-9 col-sm-9 col-xs-12";
            }
            elseif (in_array($site, $hide3)) {
                echo "col-lg-12 col-sm-12 col-xs-12";
            } else {
                echo "col-lg-6 col-sm-9 col-xs-12";
            }
}  

# content Ausgabe für die index.php
function get_mainContent () { 

# muss noch getestet werden was alles benötigt wird
    global $cookievalue, $userID, $date, $loggedin, $_language, $tpl, $myclanname, $hp_url, $imprint_type, $admin_email, $admin_name;
    global $maxtopics, $plugin_path, $maxposts, $page, $action, $preview, $message, $topicID, $_database, $maxmessages;
    

                /* Startpage */
                $settings = safe_query("SELECT * FROM " . PREFIX . "settings");
                $ds = mysqli_fetch_array($settings);
                /* Main Content */
                
                if (!isset($_GET['site'])) {
                    $site = $ds['startpage'];
                } else {
                    $site = getinput($_GET['site']);
                }


                $invalide = array('\\', '/', '/\/', ':', '.');
                $site = str_replace($invalide, ' ', $site);
                $_plugin = new plugin_manager();
                $_plugin->set_debug(DEBUG);
                if (!empty($site) AND $_plugin->is_plugin($site)>0) {
                    $data = $_plugin->plugin_data($site);
                    $plugin_path = $data['path'];
                    $check = $_plugin->plugin_check($data, $site);
                    if ($check['status']==1) {
                        $inc = $check['data'];
                        if ($inc=="exit") {
                            if($notfoundpage=true) {
                                $site = "404";
                            } else {
                                $site = $ds['startpage'];
                            }
                            include("includes/modules/".$site . ".php");
                        } else {
                            include($check['data']);
                        }
                    } else {
                        echo $check['data'];
                    }
                } else {
                    if (!file_exists("includes/modules/".$site . ".php")) {
                        if ($notfoundpage=true) {
                            $site = "404";
                        } else {
                            $site = $ds['startpage'];
                        }
                    }
                    include("includes/modules/".$site . ".php");
                }
               echo'<br />';
} 


#Ausgabe Foot
function get_navigation_modul(){
            GLOBAL $logo,$theme_name,$themes,$site,$_language,$loggedin,$url;
            
    $widget_menu = new widgets();
    $widget_menu->registerWidget("page_navigation_widget");
}


#Ausgabe Head
function get_head_modul() {

    GLOBAL $hide;
    GLOBAL $site;
   
        if (!in_array($site, $hide)) {
            echo "<div id='headcol'></div>";
            $widget_menu = new widgets();
            $widget_menu->registerWidget("page_head_widget");
        } else {
            echo"<div id='noheadcol'></div>";
        } 
}

#Ausgabe Foot
function get_foot_modul(){
            
    $widget_menu = new widgets();
    $widget_menu->registerWidget("page_footer_widget");
}

#Ausgabe Left Side
function get_left_side() {

    $widget_menu = new widgets();
    $widget_menu->registerWidget("left_side_widget");
    
}

#Ausgabe Right Side
function get_right_side() {

    $widget_menu = new widgets();
    $widget_menu->registerWidget("right_side_widget");
    
}

#Ausgabe content Head
function get_center_head() {
    $widget_menu = new widgets();
    $widget_menu->registerWidget("center_head_widget");
}

#Ausgabe content Foot
function get_center_footer() {
    $widget_menu = new widgets();
    $widget_menu->registerWidget("center_footer_widget");
}