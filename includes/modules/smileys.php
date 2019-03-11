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

$smilies_files = '<a class="btn btn-primary btn-marg" role="button" data-toggle="collapse" href="#smileys" aria-expanded="false" aria-controls="smileys">Smileys</a>
<div class="collapse" id="smileys">
    <div class="row">
   
        <div class="col-md-12 col-xs-12 col-sm-12">
            <ul id="emoticons" class="list-inline" style="height: 150px; overflow: auto;">
                $import_li
            </ul>
        </div>
   
    </div></div>';