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

$_language->readModule('startpage');


$ergebnis = safe_query("SELECT * FROM " . PREFIX . "settings_startpage");
if (mysqli_num_rows($ergebnis)) {
    $ds = mysqli_fetch_array($ergebnis);

    $title = $ds[ 'title' ];
            
        $translate = new multiLanguage(detectCurrentLanguage());
        $translate->detectLanguages($title);
        $title = $translate->getTextByLanguage($title);
                
        $title = toggle(htmloutput($title), 1);
        $title = toggle($title, 1);
                        
        $data_array = array();
        $data_array['$title'] = $title;
            
    $template = $tpl->loadTemplate("startpage","head", $data_array);
    echo $template;

   
    $startpage_text = $ds[ 'startpage_text' ];
	
	$translate->detectLanguages($startpage_text);
    $startpage_text = $translate->getTextByLanguage($startpage_text);

    $data_array = array();
    $data_array['$startpage_text'] = $startpage_text;
    $data_array['$date'] = $date;
    $data_array['$myclanname'] = $myclanname;

    $data_array['$startpage']=$_language->module[ 'startpage' ];
    $data_array['$stand1']=$_language->module[ 'stand1' ];
    $data_array['$stand2']=$_language->module[ 'stand2' ];

    
    $template = $tpl->loadTemplate("startpage","content", $data_array);
    echo $template;

} else {
    echo generateAlert($_language->module['no_startpage'], 'alert-info');
}
