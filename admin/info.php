<?php 
/*-----------------------------------------------------------------\
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
\------------------------------------------------------------------*/

$_language->readModule('info', false, true);

$updateserver = "aHR0cHM6Ly9iYXNlLndlYnNwZWxsLXJtLmV1Lw==";
if (!$getnew = file_get_contents(base64_decode($updateserver) . "vupdate.php")) {
  echo '<i><b>' . $_language->module[ 'error' ] . '&nbsp;' . $updateserver . '.</b></i>';
} else {
    $latest = explode(".", $getnew);
    $latestversion = ''.$latest['0'].''.$latest['1'].''.$latest['2'].'';
    $ownversion = explode(".", $version);     
    $ownversion = ''.$ownversion['0'].''.$ownversion['1'].''.$ownversion['2'].'';
    $updatebutton = '';
    $newupdateversion = ($ownversion + 1) * 18;
    $newreupdateversion = $ownversion * 18;
    

    if ($ownversion < $latestversion) {
      $updatetxt = $_language->module['new_version_available'];
      $updatebutton = '<a href="admincenter.php?site=update">
              <button class="btn btn-success" type="submit" name="submit">'.$_language->module['re_update'].'</button>
          </a>';
    } elseif ($ownversion == $latestversion) {
      
        $updatetxt =  $_language->module['update_info1']; 
      
    } else {
      $updatetxt =  $_language->module['update_info2'];
    }
  }

if (!isanyadmin($userID) || mb_substr(basename($_SERVER[ 'REQUEST_URI' ]), 0, 15) != "admincenter.php") {
    die($_language->module[ 'access_denied' ]);
}


$nickname = '' . getnickname($userID) . ',<br>';
$lastlogin = getformatdatetime($_SESSION[ 'ws_lastlogin' ]);
echo'<div class="card">
        <div class="card-header">
            '.$_language->module['welcome'].'
        </div>
            
            <div class="card-body">

                        <!--<p class="title-description"> Deine Webbenutzerschnittstelle </p>-->

'.$_language->module['hello'].' <b>'.$nickname.'</b> '.$_language->module['last_login'].' '.$lastlogin.'.
'. $_language->module['welcome_message'].'

<br /><br />

<div class="row">
    


<link href="http://fonts.googleapis.com/css?family=Roboto:100,400,300,500,700" rel="stylesheet" type="text/css">
<div class="col-md-12">
<div style="text-align: center;margin-top: 20px">

<div class="style_prevu_kit" style="width: 350px;"><a href="admincenter.php?site=update&action=update" target="_self" style="text-decoration:none">
<div class="cart">
<div class="cart-block">
  <div class="logo1 image_caption text-center"><span>'.$updatetxt.'</span></div>
  </div>
  
  <div class="cart-header" style="text-align: center;">
    Version '.$version.'
   
  </div>
</div></a>
</div>

<div class="style_prevu_kit" style="width: 350px;"><a href="https://webspell-rm.de/index.php?site=forum" target="_blank" style="text-decoration:none">
<div class="cart">
<div class="cart-block">
  <div class="logo1 image_caption"><span>'.$_language->module['forum'].'</span></div>
  </div>
  
  <div class="cart-header" style="text-align: center;">
   '.$_language->module['forum_text'].'
  </div>
</div></a>
</div>

<div class="style_prevu_kit" style="width: 350px;"><a href="https://www.webspell-rm.de/wiki.html" target="_blank" style="text-decoration:none">
<div class="cart">
<div class="cart-block">
  <div class="logo1 image_caption"><span>'.$_language->module['wiki'].'</span></div>

  </div>
  
  <div class="cart-header" style="text-align: center;">
  '.$_language->module['wiki_text'].'    
  </div>
</div></a>
</div>

<div class="style_prevu_kit" style="width: 350px;"><a href="https://discordapp.com/invite/SgPrVk?utm_source=Discord%20Widget&utm_medium=Connect" target="_blank" style="text-decoration:none">
<div class="cart">
<div class="cart-block">
  <div class="logo1 image_caption"><span>'.$_language->module['discord'].'</span></div>
  </div>
  
  <div class="cart-header" style="text-align: center;">
  '.$_language->module['discord_text'].'
  </div>
</div></a>
</div>


</div>

</div>
<div class="col-sm-offset-1 col-sm-10"><div class="" style="margin-left: -56px; margin-right: -56px"><br>'.$updatebutton.'</div><br></div>
<div class="col-sm-offset-1 col-sm-10">

<div class="card" style="margin-left: -56px; margin-right: -56px">
        <div class="card-header">
            <i class="fas fa-puzzle-piece"></i> CHANGELOG.md
        </div>
<div class="card-body">
  <a href="#changelog" class="btn btn-primary" data-toggle="collapse">'.$_language->module['changelog'].'</a>
  <div id="changelog" class="collapse">
  <pre>';
include("../CHANGELOG.md");
echo'</pre>
</div>
</div>

</div>
</div>


<br></div>

</div>';
