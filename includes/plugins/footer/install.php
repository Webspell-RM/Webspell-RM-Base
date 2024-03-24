<?php
global $userID,$_database,$add_database_install,$add_database_insert;
global $str,$modulname,$info,$navi_name,$admin_file,$activate,$author,$website,$index_link,$hiddenfiles,$version,$path,$widget_link1,$widget_link2,$widget_link3,$widgetname1,$widgetname2,$widgetname3,$head_activated,$content_head_activated,$content_foot_activated,$head_section_activated,$foot_section_activated,$modul_deactivated,$modul_display,$full_activated,$plugin_settings,$plugin_module,$plugin_widget,$widget1,$widget2,$widget3,$mnavID,$navi_link,$catID,$dashnavi_link,$themes_modulname;
##### Install für Plugin und Module ###################################################################################################
$str                     =   "Footer";                      // name of the plugin
$modulname               =   "footer";                      // name to uninstall
$info                    =   "{[de]}Mit diesem Plugin könnt ihr einen neuen Footer anzeigen lassen.{[en]}With this plugin you can have a new Footer displayed.{[it]}Con questo plugin puoi visualizzare un nuovo piè di pagina.";// description of the plugin
$navi_name               =   "{[de]}Footer{[en]}Footer{[it]}Piè di pagina";// name of the Webside Navigation / Dashboard Navigation
$admin_file              =   "admin_footer";                // administration file
$activate                =   "1";                           // plugin activate 1 yes | 0 no
$author                  =   "T-Seven";                     // author
$website                 =   "https://webspell-rm.de";      // authors website
$index_link              =   "admin_footer";                // index file (without extension, also no .php)
$hiddenfiles             =   "";                            // hiddenfiles (background working, no display anywhere)
$version                 =   "0.1";                       // current version, visit authors website for updates, fixes, ..
$path                    =   "includes/plugins/footer/";    // plugin files location
##### Widget Setting ##################################################################################################################
$widget_link1            =   "widget_default_footer_content";// widget_file (visible as module/box)
$widget_link2            =   "widget_easyfooter_content";   // widget_file (visible as module/box)
$widget_link3            =   "widget_plugin_footer_content";// widget_file (visible as module/box)
$widgetname1             =   "Default Footer Content";      // widget_name (visible as module/box)
$widgetname2             =   "Easy Footer Content";          // widget_name (visible as module/box)
$widgetname3             =   "Plugin_footer Content";       // widget_name (visible as module/box)
##### Modul Setting activate yes/no ###################################################################################################
$head_activated          =   "0";                           //Modul activate 1 yes | 0 no 
$content_head_activated  =   "0";                           //Modul activate 1 yes | 0 no 
$content_foot_activated  =   "0";                           //Modul activate 1 yes | 0 no 
$head_section_activated  =   "0";                           //Modul activate 1 yes | 0 no 
$foot_section_activated  =   "0";                           //Modul activate 1 yes | 0 no 
$modul_deactivated       =   "0";                           //Modul activate 1 yes | 0 no
$modul_display           =   "1";                           //Modul activate 1 yes | 0 no
$full_activated          =   "0";                           //Modul activate 1 yes | 0 no
$plugin_settings         =   "1";                           //Modulsetting activate 1 yes | 0 no 
$plugin_module           =   "0";                           //Modulsetting activate 1 yes | 0 no 
$plugin_widget           =   "1";                           //Modulsetting activate 1 yes | 0 no 
$widget1                 =   "1";                           //Modulsetting activate 1 yes | 0 no 
$widget2                 =   "1";                           //Modulsetting activate 1 yes | 0 no 
$widget3                 =   "1";                           //Modulsetting activate 1 yes | 0 no 
##### Navigation Link #################################################################################################################
$mnavID                  =   "";                            // navigation category
$navi_link               =   "";                            // navigation link file (index.php?site=...)
$catID                   =   "7";                           // dashboard_navigation category
$dashnavi_link           =   "admin_footer";                // dashboard_navigation link file  (admincenter.php?site==...)
$themes_modulname        =   "default";
#######################################################################################################################################
if(!ispageadmin($userID)) { echo ("Access denied!"); return false; }    
      
  echo "<div class='card'><div class='card-header'>$str Database Installation</div><div class='card-body'>";
#######################################################################################################################################

add_database_install($add_database_install = "CREATE TABLE IF NOT EXISTS`" . PREFIX . "plugins_footer` (
  `footID` int(11) NOT NULL AUTO_INCREMENT,
  `banner` varchar(255) NOT NULL DEFAULT '',
  `about` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `strasse` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefon` varchar(255) NOT NULL,
  `since` varchar(255) NOT NULL DEFAULT '',
  `linkname1` varchar(255) NOT NULL,
  `navilink1` varchar(255) NOT NULL,
  `linkname2` varchar(255) NOT NULL,
  `navilink2` varchar(255) NOT NULL,
  `linkname3` varchar(255) NOT NULL,
  `navilink3` varchar(255) NOT NULL,
  `linkname4` varchar(255) NOT NULL,
  `navilink4` varchar(255) NOT NULL,
  `linkname5` varchar(255) NOT NULL,
  `navilink5` varchar(255) NOT NULL,
  `linkname6` varchar(255) NOT NULL,
  `navilink6` varchar(255) NOT NULL,
  `linkname7` varchar(255) NOT NULL,
  `navilink7` varchar(255) NOT NULL,
  `linkname8` varchar(255) NOT NULL,
  `navilink8` varchar(255) NOT NULL,
  `linkname9` varchar(255) NOT NULL,
  `navilink9` varchar(255) NOT NULL,
  `linkname10` varchar(255) NOT NULL,
  `navilink10` varchar(255) NOT NULL,
  `social_text` varchar(255) NOT NULL,
  `social_link_name1` text NOT NULL,
  `social_link1` varchar(255) NOT NULL,
  `social_link_name2` varchar(255) NOT NULL,
  `social_link2` varchar(255) NOT NULL,
  `social_link_name3` varchar(255) NOT NULL,
  `social_link3` varchar(255) NOT NULL,
  `copyright_link_name1` varchar(255) NOT NULL,
  `copyright_link1` varchar(255) NOT NULL,
  `copyright_link_name2` varchar(255) NOT NULL,
  `copyright_link2` varchar(255) NOT NULL,
  `copyright_link_name3` varchar(255) NOT NULL,
  `copyright_link3` varchar(255) NOT NULL,
  `copyright_link_name4` varchar(255) NOT NULL,
  `copyright_link4` varchar(255) NOT NULL,
  `copyright_link_name5` varchar(255) NOT NULL,
  `copyright_link5` varchar(255) NOT NULL,
  `widget_left` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `widget_center` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `widget_right` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `widgetname_left` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `widgetname_center` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `widgetname_right` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`footID`)
) AUTO_INCREMENT=1
  DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");

add_database_insert($add_database_insert = "INSERT IGNORE INTO `".PREFIX."plugins_footer` (`footID`, `banner`, `about`, `name`, `strasse`, `email`, `telefon`, `since`, `linkname1`, `navilink1`, `linkname2`, `navilink2`, `linkname3`, `navilink3`, `linkname4`, `navilink4`, `linkname5`, `navilink5`, `linkname6`, `navilink6`, `linkname7`, `navilink7`, `linkname8`, `navilink8`, `linkname9`, `navilink9`, `linkname10`, `navilink10`, `social_text`, `social_link_name1`, `social_link1`, `social_link_name2`, `social_link2`, `social_link_name3`, `social_link3`, `copyright_link_name1`, `copyright_link1`, `copyright_link_name2`, `copyright_link2`, `copyright_link_name3`, `copyright_link3`, `copyright_link_name4`, `copyright_link4`, `copyright_link_name5`, `copyright_link5`, `widget_left`, `widget_center`, `widget_right`, `widgetname_left`, `widgetname_center`, `widgetname_right`) VALUES
(1, '', 'Team Clanname ist eine 1999 gegründete deutsche E-Sport-Organisation, welche über professionelle Spieler in unterschiedlichen Disziplinen verfügt...', 'Hans Mustermann', 'Musterhausen 11, Germany', 'mail@Clanname-esport.de', '(123) 456-7890', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Impressum', 'index.php?site=imprint', 'Datenschutz', 'index.php?site=privacy_policy', 'Kontakt', 'index.php?site=contact', 'Counter', 'index.php?site=counter', '', '', '', '', '', '', '', '');");

add_database_install($add_database_install = "CREATE TABLE IF NOT EXISTS`" . PREFIX . "plugins_footer_target` (
  `targetID` int(11) NOT NULL AUTO_INCREMENT,
  `windows1` int(1) NOT NULL DEFAULT '1',
  `windows2` int(1) NOT NULL DEFAULT '1',
  `windows3` int(1) NOT NULL DEFAULT '1',
  `windows4` int(1) NOT NULL DEFAULT '1',
  `windows5` int(1) NOT NULL DEFAULT '1',
  `windows6` int(1) NOT NULL DEFAULT '1',
  `windows7` int(1) NOT NULL DEFAULT '1',
  `windows8` int(1) NOT NULL DEFAULT '1',
  `windows9` int(1) NOT NULL DEFAULT '1',
  `windows10` int(1) NOT NULL DEFAULT '1',
  `windows11` int(1) NOT NULL DEFAULT '1',
  `windows12` int(1) NOT NULL DEFAULT '1',
  `windows13` int(1) NOT NULL DEFAULT '1',
  `windows14` int(1) NOT NULL DEFAULT '1',
  `windows15` int(1) NOT NULL DEFAULT '1',
  `windows16` int(1) NOT NULL DEFAULT '1',
  `windows17` int(1) NOT NULL DEFAULT '1',
  `windows18` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`targetID`)
) AUTO_INCREMENT=1
  DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_unicode_ci");

add_database_insert($add_database_insert = "INSERT IGNORE INTO `".PREFIX."plugins_footer_target` (`targetID`, `windows1`, `windows2`, `windows3`, `windows4`, `windows5`, `windows6`, `windows7`, `windows8`, `windows9`, `windows10`, `windows11`, `windows12`, `windows13`, `windows14`, `windows15`, `windows16`, `windows17`, `windows18`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1)");

get_add_module_install ();
get_add_plugin_manager();
get_add_dashboard_navigation ();

#######################################################################################################################################

echo "</div></div>";
  
 ?>