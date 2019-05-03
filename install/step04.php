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

$hp_url = (isset($_POST['hp_url'])) ?
    $_POST['hp_url'] : CurrentUrl();

?>
<form method="post">
    <div class="card">
        <div class="card-head">
            <h3 class="card-title"><?=$_language->module['select_install']; ?></h3>
        </div>
        <div class="card-body">
        <?=$_language->module['what_to_do']; ?>

            <div class="radio">
                <label>
                    <input type="radio" name="installtype" value="full" checked="checked" id="full_install">
                    <?=$_language->module['new_install']; ?>
                </label>
            </div>        
            <div class="pull-right">
                <input type="hidden" name="hp_url" value="<?=$hp_url;?>">
                <a class="btn btn-primary" href="javascript:document.ws_install.submit()">
                    <?=$_language->module['continue']; ?>
                </a>
            </div>
        </div>
    </div>
</form>
