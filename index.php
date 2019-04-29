<?php
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