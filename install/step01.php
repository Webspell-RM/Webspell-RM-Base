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

$data_array = array();
$data_array['$licence'] = $_language->module['licence'];
$data_array['$version'] = $_language->module['version'] . ' ' . $version;
$data_array['$info'] = $_language->module['gpl_info'] . '<br />' . $_language->module['more_info'];
$data_array['$please_select'] = $_language->module['please_select'];
$data_array['$agree_not'] = $_language->module['agree_not'];
$data_array['$agree'] = $_language->module['agree'];
$step01 = $_template->loadTemplate('step01', 'content', $data_array);
echo $step01;
