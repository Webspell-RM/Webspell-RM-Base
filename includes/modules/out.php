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

chdir("../../");
$err=0;
if(file_exists("system/sql.php")) { include("system/sql.php"); } else { $err++; }
if(file_exists("system/settings.php")) { include("system/settings.php"); }  else { $err++; }

// copy pagelock information for session test + deactivated pagelock for checklogin
$closed_tmp = $closed;
$closed = 0;

if(file_exists("system/functions.php")) { include("system/functions.php");  } else { $err++; }

$_language->readModule('out');

//get values
if (isset($_GET[ 'bannerID' ])) {
    safe_query("UPDATE " . PREFIX . "plugins_bannerrotation SET hits=hits+1 WHERE bannerID='" . $_GET[ 'bannerID' ] . "'");
    $ds = mysqli_fetch_array(
        safe_query(
            "SELECT
                `bannerurl`
            FROM
                " . PREFIX . "plugins_bannerrotation
            WHERE
                `bannerID` = '" . (int)$_GET[ 'bannerID' ] . "'"
        )
    );
    $target = 'http://' . str_replace('http://', '', $ds[ 'bannerurl' ]);
    $type = "direct";
}

if (isset($_GET[ 'partnerID' ])) {
    safe_query("UPDATE " . PREFIX . "plugins_partners SET hits=hits+1 WHERE partnerID='" . $_GET[ 'partnerID' ] . "'");
    $ds = mysqli_fetch_array(
        safe_query(
            "SELECT
                `url`
            FROM
                " . PREFIX . "plugins_partners
            WHERE
                `partnerID` = '" . (int)$_GET[ 'partnerID' ] . "'"
        )
    );
    $target = 'http://' . str_replace('http://', '', $ds[ 'url' ]);
    $type = "direct";
}

if (isset($_GET[ 'sponsorID' ])) {
    safe_query("UPDATE " . PREFIX . "plugins_sponsors SET hits=hits+1 WHERE sponsorID='" . $_GET[ 'sponsorID' ] . "'");
    $ds = mysqli_fetch_array(
        safe_query(
            "SELECT
                `url`
            FROM
                " . PREFIX . "plugins_sponsors
            WHERE
                `sponsorID` = '" . (int)$_GET[ 'sponsorID' ] . "'"
        )
    );
    $target = 'http://' . str_replace('http://', '', $ds[ 'url' ]);
    $type = "direct";
}

#if (isset($target)) {
    //output
#    header("Location: " . $target);
#}
header("Location: ".$_SERVER['HTTP_REFERER']);
