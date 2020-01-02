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
if ($_POST['agree'] == "1") {

    //version test
    $versionerror = (phpversion()=='5.2.6') ? true : false;

    if ($versionerror) {
        $data_array = array();
        $data_array['$php_version'] = $_language->module['php_version'];
        $data_array['$php_info'] = $_language->module['php_info'];
        $step02_content = $_template->loadTemplate('step02', 'versionerror', $data_array);
    } else {
        $data_array = array();
        $data_array['$enter_url'] = $_language->module['enter_url'];
        $data_array['$hp_url'] = CurrentUrl();
        $step02_content = $_template->loadTemplate('step02', 'enterhomepage', $data_array);
    }

    $data_array = array();
    $data_array['$title'] = ($versionerror) ?
        $_language->module['error'] : $_language->module['your_site_url'];
    $data_array['$step02_content'] = $step02_content;
    $data_array['$continue'] = $_language->module['continue'];
    $step02 = $_template->loadTemplate('step02', 'content', $data_array);
    echo $step02;

} else {

    $data_array = array();
    $data_array['$you_have_to_agree'] = $_language->module['you_have_to_agree'];
    $step02 = $_template->loadTemplate('step02', 'failed', $data_array);
    echo $step02;

}
