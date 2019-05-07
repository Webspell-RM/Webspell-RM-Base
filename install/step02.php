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
