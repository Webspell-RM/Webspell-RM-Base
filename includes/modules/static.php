<?php
/*
##########################################################################
#                                                                        #
#           Version 4       /                        /   /               #
#          -----------__---/__---__------__----__---/---/-               #
#           | /| /  /___) /   ) (_ `   /   ) /___) /   /                 #
#          _|/_|/__(___ _(___/_(__)___/___/_(___ _/___/___               #
#                       Free Content / Management System                 #
#                                   /                                    #
#                                                                        #
#                                                                        #
#   Copyright 2005-2015 by webspell.org                                  #
#                                                                        #
#   visit webSPELL.org, webspell.info to get webSPELL for free           #
#   - Script runs under the GNU GENERAL PUBLIC LICENSE                   #
#   - It's NOT allowed to remove this copyright-tag                      #
#   -- http://www.fsf.org/licensing/licenses/gpl.html                    #
#                                                                        #
#   Code based on WebSPELL Clanpackage (Michael Gruber - webspell.at),   #
#   Far Development by Development Team - webspell.org                   #
#                                                                        #
#   visit webspell.org                                                   #
#                                                                        #
##########################################################################
*/


if (isset($_GET[ 'staticID' ])) {
    $staticID = $_GET[ 'staticID' ];
} else {
    $staticID = '';
}

$ds = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "static WHERE staticID='" . $staticID . "'"));
$_language->readModule("static");
$allowed = false;
switch ($ds[ 'accesslevel' ]) {
    case 0:
        $allowed = true;
        break;
    case 1:
        if ($userID) {
            $allowed = true;
        }
        break;
    case 2:
        if (isclanmember($userID)) {
            $allowed = true;
        }
        break;
}
$_language->readModule('navigation');
if ($allowed) {


    $title = $ds[ 'title' ];
            
    
            $translate = new multiLanguage(detectCurrentLanguage());
            $translate->detectLanguages($title);
            $title = $translate->getTextByLanguage($title);
            
            $title = toggle(htmloutput($title), 1);
            $title = toggle($title, 1);
            
            
            $data_array = array();
            $data_array['$title'] = $title;
            
    $template = $tpl->loadTemplate("static","head", $data_array);
    echo $template;

            $content = $ds[ 'content' ];
    
            $translate->detectLanguages($content);
            $content = $translate->getTextByLanguage($content);
                
    
            $content = toggle(htmloutput($content), 1);
            $content = toggle($content, 1);
    
            $data_array = array();
            $data_array['$content'] = $content;
    
    $template = $tpl->loadTemplate("static","content", $data_array);
    echo $template;

} else {
	$_language->readModule('static');
    redirect("index.php", $plugin_language[ 'no_access' ], 3);
}
