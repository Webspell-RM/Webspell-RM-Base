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
function Update_Status() {
global $version;
$Update_Status = file_get_contents('http://update.webspell-rm.de/update1.php'); 
$status = json_decode($Update_Status, true); 
if($version==$status['masterVersion'])
   {
   echo "
  Deine Webspell Version ist Aktuell
";
   }
else
   {
   echo " <a href='admincenter.php?site=update&amp;action=update'><span style='color: #ff0000;'>Du hast ".$version." diese Version ist nicht Aktuell! Bitte Update jetzt auf ".$status['masterVersion']."!</span></a>";
   }
}


$_language->readModule('update', false, true);

if (!ispageadmin($userID) || mb_substr(basename($_SERVER[ 'REQUEST_URI' ]), 0, 15) != "admincenter.php") {
    die($_language->module[ 'access_denied' ]);
}

echo '<div class="panel panel-default">
<div class="panel-heading">
                            <i class="fa fa-upload"></i> ' . $_language->module[ 'webspell_update' ] . '
                        </div>
         <div class="panel-body">';

//Where to get the newest WebSPELL from? (standard: http://update.webspell.org/)
$updateserver = "http://update.webspell-rm.de/";

// reading version

include("../system/version.php");

if (!isset($_GET[ 'action' ])) {
    if (!$getnew = file_get_contents($updateserver . "update1.php?show=version")) {
        echo '<i><b>' . $_language->module[ 'error' ] . '&nbsp;' . $updateserver . '.</b></i>';
    } else {
        $latest = explode(".", $getnew);
        $ownversion = explode(".", $version);



        if ($latest[ 0 ] > $ownversion[ 0 ]) {
            echo '<a href="admincenter.php?site=update&amp;action=update"><span style="color: #ff0000;">' .
                $_language->module[ 'new_version' ] . '!</span></a>';
        } elseif ($latest[ 0 ] == $ownversion[ 0 ] && $latest[ 1 ] == $ownversion[ 1 ]) {
            echo '<a href="admincenter.php?site=update&amp;action=update"><span style="color: #ff0000;">' . $_language->module[ 'new_functions' ] .
                '!</span></a>';
        } elseif ($latest[ 0 ] == $ownversion[ 0 ] &&
            $latest[ 1 ] == $ownversion[ 1 ] && $latest[ 2 ] > $ownversion[ 2 ]
        ) {
            echo '<a href="admincenter.php?site=update&amp;action=update"><span style="color: #ff0000;">' . $_language->module[ 'new_updates' ] .
                '!</span></a>';
        }
    }
}

if (isset($_GET[ 'action' ])) {
    $action = $_GET[ 'action' ];
} else {
    $action = '';
}

if ($action == "update") {
    //update server sends update information in following form:
    //package1:updateversion1:additional1.package2:additional2:WritttenBy2..., e.g. members:4.01.30:written by FS

    if ($getnew = file_get_contents($updateserver . "update1.php?version=" . $version . "")) {
        $updates = explode("##", $getnew);

        //get packages

        echo'<table class="table table-striped">
    <thead>
      <th><b>' . $_language->module['filename'] . '</b></th>
      <th><b>' . $_language->module['version'] . '</b></th>
      <th><b>' . $_language->module['information'] . '</b></th>
      </thead>';


        foreach ($updates as $value => $package) {
            $updateinfo = explode("#", $package);
            //get packageinfos
            if ($updateinfo[ 0 ] == "noupdates") {
                echo '<tr><td class="td1" colspan="4">' . $_language->module[ 'no_updates' ] . '</td></tr>';
            } else {
                echo '<tr>
          <td class="td1"><a href="'.$updateserver.'?package='.$updateinfo[0].'" target="_blank">'.$updateinfo[0].'.php</a></td>
          <td class="td1">'.$updateinfo[0].'.php</td>
          <td class="td1">'.$updateinfo[1].'</td>
          <td class="td1">'.$updateinfo[2].'</td>
        </tr>';
            }
        }
        echo'</table>
    <br /><br /><a class="btn btn-primary" type="button" href="'.$updateserver.'?get=true" target="_blank"><b>'.$_language->module['get_new_version'].'</b></a>';
    }
}
echo '</div></div>';
?>