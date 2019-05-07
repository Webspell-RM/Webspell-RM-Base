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
    $step00_content = $_template->loadTemplate('step00_success', 'content', $data_array);

}

$data_array = array();
$data_array['$welcome_to'] = $_language->module['welcome_to'];
$data_array['$select_a_language'] = $_language->module['select_a_language'];
$data_array['$languages'] = $languages;
$data_array['$step00_content'] = $step00_content;
$step00 = $_template->loadTemplate('step00', 'content', $data_array);
echo $step00;
