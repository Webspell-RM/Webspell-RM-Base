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
@File:Navigation
@Author:Getschonnik
@Version:1.1
@Modefiziert: T-Seven
*/
$_language->readModule('navigation');

function navigation_nodropdown($default_url) {
    # run if mod_Rewrite is activated
    $set = 1;
    $mr_res = mysqli_fetch_array(safe_query("SELECT * FROM `".PREFIX."settings` WHERE 1"));
    if($mr_res['modRewrite']==1) {
        $rem1 = explode("/",$_SERVER["REQUEST_URI"]); # "/.."
        $chks = explode("/",$rem1[1]);
        if(strpos($chks[0], '.') !== false) {
            $tmp = explode(".",$chks[0]);
            $newurl = "index.php?site=".$tmp[0];
            $set=1;
        } else {
            $tmp = explode("/",$chks[0]);
            $newurl = "index.php?site=".$tmp[0];
            $set=1;
        }
    }
    # run if mod_Rewrite deactivated
    try {
        if($set==0) {
            $url = explode("/",$_SERVER["REQUEST_URI"]);
            if(isset($url[1]))
                if($url[1]=="index.php") { $newurl = $default_url; } else { $newurl = $url[1];
            }
        }
        $rex = safe_query("SELECT * FROM `".PREFIX."navigation_website_sub` WHERE `url`='".$newurl."'");
        if(mysqli_num_rows($rex)) {
            $output = "";
            $rox = mysqli_fetch_array($rex);
            $res = safe_query("SELECT * FROM `".PREFIX."navigation_website_sub` WHERE `mnavID`='".intval($rox['mnavID'])."' AND `indropdown`='0' ORDER BY `sort`");
            while($row=mysqli_fetch_array($res)) {
                if(isset($_language->module[strtolower($row['name'])])) { $name = $_language->module[strtolower($row['name'])]; } else { $name = $row['name']; }
                $output .= '<li class="nav-item"><a class="dropdown-item" href="'.$row['url'].'">'.$name.'</a></li>';
            }
            return $output;
        }
    } catch (Exception $e) {
        if(DEBUG==="ON") {
            return $e->message();
        }
    }
}
# load main-nav && dropdown
try {
    $res = safe_query("SELECT * FROM `".PREFIX."navigation_website_main` ORDER BY `sort`");
    $lo = 0;
    while($row=mysqli_fetch_array($res)) {
        if($row['isdropdown']==1) {
            $head_array = array();
            if(isset($_language->module[strtolower($row['name'])])) { 
                $head_array['$name'] = $_language->module[strtolower($row['name'])]; 
            } else { 
                $head_array['$name'] = $row['name']; 
            }

            $head_array['$url'] = $row['url'];            
            $name = $row[ 'name' ];
            $translate = new multiLanguage(detectCurrentLanguage());
            $translate->detectLanguages($name);
            $name = $translate->getTextByLanguage($name);
            $head_array['$name'] = $name; 
            if($lo==1) {
                if($loggedin) {
                    $login_overview = '<li class="nav-item"><a class="dropdown-item" href="index.php?site=loginoverview">'.$_language->module['overview'].'</a></li>';
                } else {
                    $login_overview = '<li class="nav-item"><a class="dropdown-item" href="index.php?site=login">'.$_language->module['login'].'</a></li>';
                }
                $ar = array(); $head_array['$login_overview'] =$login_overview;
            } else { $head_array['$login_overview'] =""; }
            $lo++;
            /* Dropdown */
            $rex = safe_query("SELECT * FROM `".PREFIX."navigation_website_sub` WHERE `mnavID`='".$row['mnavID']."' ORDER BY `sort`");
            if(mysqli_num_rows($rex)) {
                $head = $tpl->loadTemplate("navigation","dd_head", $head_array);
                echo $head;

                $sopen = $tpl->loadTemplate("navigation","sub_open", $head_array);
                echo $sopen;
                while($rox=mysqli_fetch_array($rex)) {
                    if($rox['indropdown'] == 1) {
                        $sub_array = array();
                        if (strpos($rox['url'], 'http://') !== false) {
                             $sub_array['$url'] = $rox['url'].'" target="_blank';
                         } else {
                             $sub_array['$url'] = $rox['url'];
                        }
                        $name = $rox[ 'name' ];
                        $translate = new multiLanguage(detectCurrentLanguage());
                        $translate->detectLanguages($name);
                        $name = $translate->getTextByLanguage($name);
                        $sub_array['$name'] = $name; 

                        $sub = $tpl->loadTemplate("navigation","sub_nav", $sub_array);
                        echo $sub;
                    }
                }
                $sclose = $tpl->loadTemplate("navigation","sub_close", array());
                echo $sclose;
                
            }
        } else {
            $head_array = array();
            if(isset($_language->module[strtolower($row['name'])])) { 
                $head_array['$name'] = $_language->module[strtolower($row['name'])]; 
            } else { 
                $head_array['$name'] = $row['name']; 
            }
            $head_array['$url'] = $row['url'];
            
            if ($row[ 'windows' ]) {
                $windows = '';
            } else {
                $windows = '_blank';
            }

            $head_array['$windows'] = $windows;
            $name = $row[ 'name' ];
            $translate = new multiLanguage(detectCurrentLanguage());
            $translate->detectLanguages($name);
            $name = $translate->getTextByLanguage($name);
            $head_array['$name'] = $name; 
            $main_head = $tpl->loadTemplate("navigation","main_head", $head_array);
            echo $main_head;
        }
        unset($sub_array, $sub);
        $head = $tpl->loadTemplate("navigation","dd_foot", array());
        echo $head;

    }
} catch (Exception $e) {
    echo $e->message();
    return false;
}

