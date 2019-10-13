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
if (isset($_GET[ 'staticID' ])) {
    $staticID = $_GET[ 'staticID' ];
} else {
    $staticID = '';
}

$ds = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_static WHERE staticID='" . $staticID . "'"));
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
            
            $data_array = array();
            $data_array['$title'] = $title;
            
    $template = $tpl->loadTemplate("static","head", $data_array);
    echo $template;

            $content = $ds[ 'content' ];
    
            $translate->detectLanguages($content);
            $content = $translate->getTextByLanguage($content);
                
            $data_array = array();
            $data_array['$content'] = $content;
    
    $template = $tpl->loadTemplate("static","content", $data_array);
    echo $template;

} else {
	$_language->readModule('static');
    redirect("index.php", $plugin_language[ 'no_access' ], 3);
}
