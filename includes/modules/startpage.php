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
