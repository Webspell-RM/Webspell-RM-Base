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