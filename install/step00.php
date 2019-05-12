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
$languages = '';
if ($handle = opendir('./languages/')) {
    while (false !== ($file = readdir($handle))) {
        if (is_dir('./languages/' . $file) && $file != ".." && $file != "." && $file != ".svn") {
            $languages .= '<a class="btn btn-default btn-margin btn-sm" href="index.php?lang=' . $file . '"><img src="../images/languages/' . $file . '.gif"
            alt="' . $file . '"></a>';
        }
    }
    closedir($handle);
}

if (file_exists("locked.txt")) {
    $step00_content = $_language->module['installerlocked'];
} else {

    $data_array = array();
    $data_array['$welcome_text'] = $_language->module['welcome_text'] . '<br />' . $_language->module['webspell_team'];
    $data_array['$continue'] = $_language->module['continue'];
    $step00_content = $_template->loadTemplate('step00', 'success', $data_array);

}

$data_array = array();
$data_array['$welcome_to'] = $_language->module['welcome_to'];
$data_array['$select_a_language'] = $_language->module['select_a_language'];
$data_array['$languages'] = $languages;
$data_array['$step00_content'] = $step00_content;
$step00 = $_template->loadTemplate('step00', 'content', $data_array);
echo $step00;
