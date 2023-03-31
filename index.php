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

$filename = 'locked.txt';
if (file_exists($filename)) {


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
    $components_css .= '<link type="text/css" rel="stylesheet" href="' . $component . '" />';
    $components_css .= "\n";
}

$components_js = "";
foreach ($components['js'] as $component) {
    $components_js .= '<script src="' . $component . '"></script>';
    $components_js .= "\n";
}

// load from theme directory the .css and .js filesize
$theme_css = headfiles("css", $tpl->themes_path);
$theme_js = headfiles("js", $tpl->themes_path);

// START
// include theme / content
include($theme->get_active_theme()."index.php");
	
} else {
   echo'<link href="/components/bootstrap/css/bootstrap.min.css" rel="stylesheet">';
    echo '<style type="text/css">
body {
    background: radial-gradient(ellipse at center, #444 20%,#333333 40%,#222 60%,#111 80%);
    margin-top: 80px
  
}   
.titlehead {
    border: 3px solid;
    border-color: #c4183c; 
    background-color: #fff}
</style>
<div class="container" style="margin-top: 30px">
<div class="card">
    <div class="card-body titlehead"><br>
            <center>
        <img class="img-fluid" src="/images/install-logo.jpg" alt="" style="height: 150px"/><br>
		      <sm1all>Ohje !</small><br>
		      <h1 style="font-family: Roboto, serif;font-size: 58px;">Webseite nicht gefunden.</h1>
              <p>Es wurde noch keine Installation durchgef&uuml;hrt!</p>
        
              <p><a class="btn btn-warning" href="./install/index.php">Webspell-RM installieren</a></p>
	          <br />
	        </center>
        
    </div>
</div>
</div>';}
?>