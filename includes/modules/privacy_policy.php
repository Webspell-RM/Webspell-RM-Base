<?php
/*-----------------------------------------------------------------\
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
\------------------------------------------------------------------*/


$_language->readModule('privacy_policy');


$data_array = array();
$data_array['$privacy_policy']=$_language->module[ 'privacy_policy' ];

$template = $tpl->loadTemplate("privacy_policy","head", $data_array);
echo $template;

$ergebnis = safe_query("SELECT * FROM " . PREFIX . "settings_privacy_policy");
if (mysqli_num_rows($ergebnis)) {
    $ds = mysqli_fetch_array($ergebnis);

    // reading settings
    $privacy_policy_text = $ds[ 'privacy_policy_text' ];
	
	$translate = new multiLanguage(detectCurrentLanguage());
	$translate->detectLanguages($privacy_policy_text);
	$privacy_policy_text = $translate->getTextByLanguage($privacy_policy_text);
	
    $date = getformatdatetime($ds[ 'date' ]);

    $data_array = array();
    $data_array['$privacy_policy_text'] = $privacy_policy_text;
    $data_array['$date'] = $date;
    $data_array['$myclanname'] = $myclanname;

    $data_array['$privacy_policy']=$_language->module[ 'privacy_policy' ];
    $data_array['$stand1']=$_language->module[ 'stand1' ];
    $data_array['$stand2']=$_language->module[ 'stand2' ];

    $template = $tpl->loadTemplate("privacy_policy","content", $data_array);
    echo $template;
    
} else {
    echo generateAlert($_language->module['no_privacy_policy'], 'alert-info');
}
