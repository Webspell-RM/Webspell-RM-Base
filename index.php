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

// INCLUDE
// the neccessary files
include_once("system/sql.php");
include_once("system/settings.php");
include_once("system/functions.php");
include_once("system/themes.php");
include_once("system/template.php");
include_once("system/plugin.php");
include_once("system/widget.php");
include_once("system/multi_language.php");

// INITIALIZE
// Theme
$theme = new theme();
// Template
$tpl = new template();
$tpl->themes_path = $theme->get_active_theme();
$tpl->template_path = "templates/";

// Plugin Manager
$_pluginmanager = new plugin_manager();

// DEFINES
define("MODULE", "./includes/modules/");

// PLUGINS
define("PLUGIN", "./includes/plugins/");

// DATABASE
// >

// LANGUAGE
// Language
$_language->readModule('index');
$index_language = $_language->module;

// CHECK
// CROWDIN (removed)

// CSS / JS
// //!!\\ MOVE THIS FILES INTO THE THEME DIRECTORY !!
$components_css = "";
foreach ($components['css'] as $component) {
    $components_css .= '<link href="' . $component . '" rel="stylesheet">';
}

$components_js = "";
foreach ($components['js'] as $component) {
    $components_js .= '<script src="' . $component . '"></script>';
}

// load from theme directory the .css and .js filesize
$theme_css = headfiles("css", $tpl->themes_path);
$theme_js = headfiles("js", $tpl->themes_path);

// START
// include theme / content
include($theme->get_active_theme()."index.php");

?>