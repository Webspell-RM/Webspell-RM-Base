<?php
/**
 *¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
 *                  Webspell-RM      /                        /   /                                          *
 *                  -----------__---/__---__------__----__---/---/-----__---- _  _ -                         *
 *                   | /| /  /___) /   ) (_ `   /   ) /___) /   / __  /     /  /  /                          *
 *                  _|/_|/__(___ _(___/_(__)___/___/_(___ _/___/_____/_____/__/__/_                          *
 *                               Free Content / Management System                                            *
 *                                           /                                                               *
 *¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
 * @version         webspell-rm                                                                              *
 *                                                                                                           *
 * @copyright       2018-2024 by webspell-rm.de                                                              *
 * @support         For Support, Plugins, Templates and the Full Script visit webspell-rm.de                 *
 * @website         <https://www.webspell-rm.de>                                                             *
 * @forum           <https://www.webspell-rm.de/forum.html>                                                  *
 * @wiki            <https://www.webspell-rm.de/wiki.html>                                                   *
 *                                                                                                           *
 *¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
 * @license         Script runs under the GNU GENERAL PUBLIC LICENCE                                         *
 *                  It's NOT allowed to remove this copyright-tag                                            *
 *                  <http://www.fsf.org/licensing/licenses/gpl.html>                                         *
 *                                                                                                           *
 *¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
 * @author          Code based on WebSPELL Clanpackage (Michael Gruber - webspell.at)                        *
 * @copyright       2005-2011 by webspell.org / webspell.info                                                *
 *                                                                                                           *
 *¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
*/

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

#function hide / r / l Spalte, head, foot, content_head und content foot
function get_hide () { 
    global $hide, $hide1, $hide2, $hide3, $hide4, $hide5, $hide6, $hide7, $hide8, $hide9, $themes_modulname;

    $sql = safe_query("SELECT themes_modulname, modulname, head_activated FROM ".PREFIX."settings_module WHERE head_activated = '0' AND themes_modulname='$themes_modulname'");
    if(mysqli_num_rows($sql)) {
        while($row = mysqli_fetch_array($sql)) {
            $hide[] = $row['modulname'];
        }
    }
    else {
        $hide = array();
    }

    $sql = safe_query("SELECT themes_modulname, modulname, sidebar FROM ".PREFIX."settings_module WHERE sidebar = 're_activated' AND themes_modulname='$themes_modulname'");
    if(mysqli_num_rows($sql)) {
        while($row = mysqli_fetch_array($sql)) {
            $hide1[] = $row['modulname'];
        }
    }
    else {
        $hide1 = array();
    }

    $sql = safe_query("SELECT themes_modulname, modulname, sidebar FROM ".PREFIX."settings_module WHERE sidebar = 'le_activated' AND themes_modulname='$themes_modulname'");
    if(mysqli_num_rows($sql)) {
        while($row = mysqli_fetch_array($sql)) {
            $hide2[] = $row['modulname'];
        }
    }
    else {
        $hide2 = array();
    }

    $sql = safe_query("SELECT themes_modulname, modulname, sidebar FROM ".PREFIX."settings_module WHERE sidebar = 'activated' AND themes_modulname='$themes_modulname'");
    if(mysqli_num_rows($sql)) {
        while($row = mysqli_fetch_array($sql)) {
            $hide3[] = $row['modulname'];
        }
    }
    else {
        $hide3 = array();
    }

    $sql = safe_query("SELECT themes_modulname, modulname, content_head_activated FROM ".PREFIX."settings_module WHERE content_head_activated = '0' AND themes_modulname='$themes_modulname'");
    if(mysqli_num_rows($sql)) {
        while($row = mysqli_fetch_array($sql)) {
            $hide4[] = $row['modulname'];
        }
    }
    else {
        $hide4 = array();
    }

    $sql = safe_query("SELECT themes_modulname, modulname, content_foot_activated FROM ".PREFIX."settings_module WHERE content_foot_activated = '0' AND themes_modulname='$themes_modulname'");
    if(mysqli_num_rows($sql)) {
        while($row = mysqli_fetch_array($sql)) {
            $hide5[] = $row['modulname'];
        }
    }
    else {
        $hide5 = array();
    }

    $sql = safe_query("SELECT themes_modulname, modulname, head_section_activated FROM ".PREFIX."settings_module WHERE head_section_activated = '0' AND themes_modulname='$themes_modulname'");
    if(mysqli_num_rows($sql)) {
        while($row = mysqli_fetch_array($sql)) {
            $hide6[] = $row['modulname'];
        }
    }
    else {
        $hide6 = array();
    }

    $sql = safe_query("SELECT themes_modulname, modulname, foot_section_activated FROM ".PREFIX."settings_module WHERE foot_section_activated = '0' AND themes_modulname='$themes_modulname'");
    if(mysqli_num_rows($sql)) {
        while($row = mysqli_fetch_array($sql)) {
            $hide7[] = $row['modulname'];
        }
    }
    else {
        $hide7 = array();
    }

    $sql = safe_query("SELECT themes_modulname, modulname, custom_activated FROM ".PREFIX."settings_module WHERE custom_activated = '0' AND themes_modulname='$themes_modulname'");
    if(mysqli_num_rows($sql)) {
        while($row = mysqli_fetch_array($sql)) {
            $hide8[] = $row['modulname'];
        }
    }
    else {
        $hide8 = array();
    }

    $sql = safe_query("SELECT themes_modulname, modulname, via_navigation FROM ".PREFIX."settings_module WHERE via_navigation = '0' AND themes_modulname='$themes_modulname'");
    if(mysqli_num_rows($sql)) {
        while($row = mysqli_fetch_array($sql)) {
            $hide9[] = $row['modulname'];
        }
    }
    else {
        $hide9 = array();
    }
}

# die Breite von content wird automatisch angepasst / linke - rechte Spalte activated oder deactivated

function get_mainhide () { 
    global $class_maincol, $site, $hide1, $hide2, $hide3;

    if (in_array($site, $hide1)) {
        echo "col-lg-9 col-sm-9 col-xs-12";
    }elseif (in_array($site, $hide2)) {
        echo "col-lg-9 col-sm-9 col-xs-12";
    }elseif (in_array($site, $hide3)) {
        echo "col-lg-12 col-sm-12 col-xs-12";
    } else {
        echo "col-lg-6 col-sm-9 col-xs-12";
    }
}  

# content Ausgabe für die index.php
function get_mainContent() { 
    
    global $cookievalue, $userID, $date, $loggedin, $_language, $tpl, $myclanname, $hp_url, $imprint_type, $admin_email, $admin_name;
    global $maxtopics, $plugin_path, $maxposts, $page, $action, $preview, $message, $topicID, $_database, $maxmessages, $new_chmod;
    global $hp_title, $default_format_date, $default_format_time, $register_per_ip, $rewriteBase;
    
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
        //$plugin_path = $data['path'];
        if(!empty($data['path'])){
            $plugin_path = $data['path'];
        }else{
            $plugin_path = '';
        }
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
}

#Ausgabe über der Navi
function get_via_navigation_modul() {
    $widget_menu = new widgets();
    $widget_menu->registerWidget("via_navigation_widget");
}

#Ausgabe Navi
function get_navigation_modul(){
    GLOBAL $logo, $theme_name, $themes, $site, $_language, $loggedin, $url;
    $widget_menu = new widgets();
    $widget_menu->registerWidget("page_navigation_widget");
}

#Ausgabe Head elements
function get_head_modul() {
    GLOBAL $hide, $site,$modulname;
   
    if (!in_array($site, $hide)) {
        $widget_menu = new widgets();
        $widget_menu->registerWidget("page_head_widget");
    }
}

#Ausgabe Head elements
function get_headelements() {
    GLOBAL $hide, $site,$modulname;
   
    if (!in_array($site, $hide)) {
        echo'';
    } else {
        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_headelements WHERE site='".$site."' AND modulname='".$site."' AND displayed='1'"));
        if(@$dx[ 'modulname' ] != $site || @$dx[ 'site' ] == 'startpage') {
        $head_elements = '';
        } else {
            if(@$dx[ 'headelementID' ] != '') {
                $headelementID = $dx[ 'headelementID' ];
            } else {
                $headelementID = '';
            } 
            if(@$dx[ 'name' ] != '') {   
                $name = $dx[ 'name' ];
            } else {
                $name = '';
            }
            if(@$dx[ 'info' ] != '') {  
                $info = $dx[ 'info' ];
            } else {
                $info = '';
            }

            if(file_exists('./images/headelements/'.$headelementID.'.jpg')){
                $pic='<style>
                        .head-boxes {display: none;}
                        </style>
                        <figure class="overlay">
                        <img src="./images/headelements/'.$headelementID.'.jpg" class="figure-img im1g-fluid rounded" alt="...">
                        <figcaption class="figure-caption"><p class="animated fadeInUp noheadcol_title">'.$name.'</p>
                        <p class="noheadcol_text">'.$info.'</p>
                        <p class="noheadcol_link"><a href="#">Home</a> / '.$name.'</p></figcaption>
                        </figure>';
            } elseif(file_exists('./images/headelements/'.$headelementID.'.jpeg')){
                $pic='<style>
                        .head-boxes {display: none;}
                        </style>
                        <figure class="overlay">
                        <img src="./images/headelements/'.$headelementID.'.jpeg" class="figure-img im1g-fluid rounded" alt="...">
                        <figcaption class="figure-caption"><p class="animated fadeInUp noheadcol_title">'.$name.'</p>
                        <p class="noheadcol_text">'.$info.'</p>
                        <p class="noheadcol_link"><a href="#">Home</a> / '.$name.'</p></figcaption>
                        </figure>';
            } elseif(file_exists('./images/headelements/'.$headelementID.'.png')){
                $pic='<style>
                        .head-boxes {display: none;}
                        </style>
                        <figure class="overlay">
                        <img src="./images/headelements/'.$headelementID.'.png" class="figure-img im1g-fluid rounded" alt="...">
                        <figcaption class="figure-caption"><p class="animated fadeInUp noheadcol_title">'.$name.'</p>
                        <p class="noheadcol_text">'.$info.'</p>
                        <p class="noheadcol_link"><a href="#">Home</a> / '.$name.'</p></figcaption>
                        </figure>';
            } elseif(file_exists('./images/headelements/'.$headelementID.'.gif')){
                $pic='<style>
                        .head-boxes {display: none;}
                        </style>
                        <figure class="overlay">
                        <img src="./images/headelements/'.$headelementID.'.gif" class="figure-img im1g-fluid rounded" alt="...">
                        <figcaption class="figure-caption"><p class="animated fadeInUp noheadcol_title">'.$name.'</p>
                        <p class="noheadcol_text">'.$info.'</p>
                        <p class="noheadcol_link"><a href="#">Home</a> / '.$name.'</p></figcaption>
                        </figure>';
            } else{
                $db = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_headelements WHERE site='".$site."' AND modulname='".$site."' AND displayed='0'"));
                if(@$db[ 'name' ] == 'Startpage') {
                    $pic='';
                } else{
                    $pic='<!--<style>
                        .head-boxes {display: none;}
                        </style>-->
                        <div class="container-fluid noheadcol_no_pic">
                            <div class="container">
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="noheadcol_title_no_pic">'.$name.'</p>
                                    <p class="noheadcol_link_no_pic"><a href="#">Home</a> / '.$name.'</p>
                                </div>
                            </div>
                        </div>';
                }
            }
                $head_elements = $pic;
        }
        echo''.$head_elements.'';
            
    } 
}

#Ausgabe Foot
function get_foot_modul(){
    global $themes_modulname;

    $widget_menu = new widgets();
    $widget_menu->registerWidget("page_footer_widget");
}

#Ausgabe Left Side
function get_left_side() {
    global $themes_modulname;
    $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_widgets WHERE description='left_side_widget' AND themes_modulname='$themes_modulname'"));
    if (@$dx[ 'description' ] != 'left_side_widget') {
        $left_page = '<div class="head-boxes">
                        <span class="head-boxes-head">Info<small style="font-size: 10px;">(left side)</small></span>
                        <h2 class="head-h2">
                        <span class="head-boxes-title">Info<small style="font-size: 10px;">(left side)</small></span>
                        </h2>
                            <p class="head-boxes-foot">(left side)</p>
                        </div>
                        <div class="alert alert-danger" role="alert">Widget not found!</div>';
        return $left_page;
    } else {
        $left_page = $widget_menu = new widgets();
        $widget_menu->registerWidget("left_side_widget");
    }
}

#Ausgabe Right Side
function get_right_side() {
    global $themes_modulname;
    $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_widgets WHERE description='right_side_widget' AND themes_modulname='$themes_modulname'"));
    if (@$dx[ 'description' ] != 'right_side_widget') {
        $right_page = '<div class="head-boxes">
                        <span class="head-boxes-head">Info<small style="font-size: 10px;">(right side)</small></span>
                        <h2 class="head-h2">
                            <span class="head-boxes-title">Info<small style="font-size: 10px;">(right side)</small></span>
                        </h2>
                            <p class="head-boxes-foot">(right side)</p>
                        </div>
                        <div class="alert alert-danger" role="alert">Widget not found!</div>';
        return $right_page;
    } else {
        $right_page = $widget_menu = new widgets();
        $widget_menu->registerWidget("right_side_widget");
    }
}

#Ausgabe center Head
function get_center_head() {
    $widget_menu = new widgets();
    $widget_menu->registerWidget("center_head_widget");
}

#Ausgabe center Foot
function get_center_footer() {
    $widget_menu = new widgets();
    $widget_menu->registerWidget("center_footer_widget");
}

#Ausgabe content Head
function get_head_section() {
    $widget_menu = new widgets();
    $widget_menu->registerWidget("head_section_widget");
}

#Ausgabe content Foot
function get_foot_section() {
    $widget_menu = new widgets();
    $widget_menu->registerWidget("foot_section_widget");
}

#Wartungsmodus wird anezeigt
function get_lock_modul() {
    global $closed;
    $dm = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings where closed='1'"));
    if (@$closed != '1') { 

    } else {
        echo'<div class="alert alert-danger" role="alert"><center>
            Die Seite befindet sich im Wartungsmodus | The site is in maintenance mode | Il sito è in modalità manutenzione
            </center></div>';   
    }
}

#ckeditor Quelltext Button wird angezeigt für Superadmin
function get_editor() {
global $userID;
    if (issuperadmin($userID)) {
        echo'<script src="./components/ckeditor/ckeditor.js"></script>
             <script src="./components/ckeditor/config.js"></script>';
    } else {
        echo'<script src="./components/ckeditor/ckeditor.js"></script>
             <script src="./components/ckeditor/user_config.js"></script>';
    } 
}

