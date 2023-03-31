<?php 
/**
 *¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*  
 *                                    Webspell-RM      /                        /   /                                                 *
 *                                    -----------__---/__---__------__----__---/---/-----__---- _  _ -                                *
 *                                     | /| /  /___) /   ) (_ `   /   ) /___) /   / __  /     /  /  /                                 *
 *                                    _|/_|/__(___ _(___/_(__)___/___/_(___ _/___/_____/_____/__/__/_                                 *
 *                                                 Free Content / Management System                                                   *
 *                                                             /                                                                      *
 *¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
 * @version         Webspell-RM                                                                                                       *
 *                                                                                                                                    *
 * @copyright       2018-2022 by webspell-rm.de <https://www.webspell-rm.de>                                                          *
 * @support         For Support, Plugins, Templates and the Full Script visit webspell-rm.de <https://www.webspell-rm.de/forum.html>  *
 * @WIKI            webspell-rm.de <https://www.webspell-rm.de/wiki.html>                                                             *
 *                                                                                                                                    *
 *¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
 * @license         Script runs under the GNU GENERAL PUBLIC LICENCE                                                                  *
 *                  It's NOT allowed to remove this copyright-tag <http://www.fsf.org/licensing/licenses/gpl.html>                    *
 *                                                                                                                                    *
 * @author          Code based on WebSPELL Clanpackage (Michael Gruber - webspell.at)                                                 *
 * @copyright       2005-2018 by webspell.org / webspell.info                                                                         *
 *¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
 *                                                                                                                                    *
 *¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
 */


$_language->readModule('info', false, true);
include('../system/func/update_base.php');
include('../system/func/dc.php');

function getter($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}



$CAPCLASS = new \webspell\Captcha;
$CAPCLASS->createTransaction();
$hash = $CAPCLASS->getHash();


$report = '';
if(getter($updateserverurl.'/base/vupdate.php') != '') {
  $updateserverurl = $updateserverurl;
  $servername = '<b class="text-success">Alpha</b>';
  $on = '<i class="fa fa-check text-success"></i>';

####### Plugins #########
$url = $updateserverurl.'/plugin/plugin-base_v.'.$version.'/list.json';
@$check = fopen($url,"r");
if($check) {
$plugin = '<i class="fa fa-check text-success"></i>';
}
else {
$plugin = '<i class="fa fa-times text-danger"></i>';
}  
#######################
####### Themes #########
$url = $updateserverurl.'/theme/style-base_v.'.$version.'/list.json';
@$check = fopen($url,"r");
if($check) {
$theme = '<i class="fa fa-check text-success"></i>';
}
else {
$theme = '<i class="fa fa-times text-danger"></i>';
}  
#######################



} elseif(getter($dangerupdateserverurl.'/base/vupdate.php') != '') {
  $updateserverurl = $dangerupdateserverurl;
  $servername = '<b class="text-warning">Beta</b>';
  $on = '<i class="fa fa-check text-success"></i>';

####### Plugins #########
$url = $dangerupdateserverurl.'/plugin/plugin-base_v.'.$version.'/list.json';
@$check = fopen($url,"r");

if($check) {
$plugin = '<i class="fa fa-check text-success"></i>';
}
else {
$plugin = '<i class="fa fa-times text-danger"></i>';
} 
############################
####### Themes #########
$url = $dangerupdateserverurl.'/theme/style-base_v.'.$version.'/list.json';
@$check = fopen($url,"r");
if($check) {
$theme = '<i class="fa fa-check text-success"></i>';
}
else {
$theme = '<i class="fa fa-times text-danger"></i>';
}  
#######################

} else {
  $on = '<i class="fa fa-times text-danger"></i>';
  $report = '
    <span style="margin-top: 5px; margin-left: 10px;">
      <a class="btn-sm btn-warning" href="admincenter.php?site=info&amp;action=report&amp;code='.$hash.'" target="_self" style="text-decoration:none">Report</a>
    </span>
  ';
  $updateserverurl = '';
  $plugin = '<i class="fa fa-times text-danger"></i>';
  $theme = '<i class="fa fa-times text-danger"></i>';
  $servername = $_language->module[ 'report_text' ];
}









if (isset($_GET[ 'action' ])) {
    $action = $_GET[ 'action' ];
} else {
    $action = '';
}

if ($action == 'report') { 
  $CAPCLASS = new \webspell\Captcha;
  if ($CAPCLASS->checkCaptcha(0, $_GET[ 'code' ])) {
    discordmsg($msg, $webhook);
    redirect("admincenter.php", $_language->module[ 'report_successfully' ], 3);
  } else {
    redirect("admincenter.php", $_language->module[ 'transaction_invalid' ], 3);  
  }
}


if (!$getnew = @file_get_contents($updateserverurl.'/base/vupdate.php')) {
  echo '';
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
            '.$_language->module['title'].'
        </div>
<div class="card-body">
<div class="row">
            <div class="col-md-6">

            <div class="card">
        <div class="card-he1ader">
            <img src="/components/admin/images/info-logo.jpg" style="max-width: 100%;height: auto;">
        </div>
            
            <div class="card-body" style="height: 270px">
<h4>'.$_language->module['welcome'].'</h4>
            

                        <!--<p class="title-description"> Deine Webbenutzerschnittstelle </p>-->

'.$_language->module['hello'].' <b>'.$nickname.'</b> '.$_language->module['last_login'].' '.$lastlogin.'.
'. $_language->module['welcome_message'].'



</div></div></div>
<div class="col-md-6">';




echo'






<div class="card" style="margin-left: 50px; margin-right: 50px">
        <div class="card-header">
            <i class="fas fa-exclamation-triangle text-warning"></i> Live Ticker
        </div>
<div class="card-body" style="height: 400px">';?>
<style>

.anyClass {
  height:360px;
  overflow-y: auto;
}
</style>
<?php
echo'
<div class="anyClass">
<div class="alert alert-warning" role="alert">';
echo getter('https://www.webspell-rm.de/includes/modules/live_ticker.php');


  echo'</div></div></div>
</div>



</div>
</div>



<div class="card" style="margin-left: 50px; margin-right: 50px">
  <div class="card-header">
    <i class="fas fa-exclamation-triangle text-warning"></i> '.$_language->module['update_support'].'
  </div>
  <div class="card-body">
    <div class="style_prevu_kit" style="width: 300px;">
      <a href="admincenter.php?site=update&action=update" target="_self" style="text-decoration:none">
        <div class="cart">
          <div class="cart-block">
            <div class="logo1 image_caption text-center" style="height:220px"><span style="margin-top: -35px">'.$_language->module['version_check'].'
            ';
            if (!$getnew = @file_get_contents($updateserverurl.'/base/vupdate.php')) {
              echo '<i><b>' . $_language->module[ 'error' ] . '</b></i>';
            } else {
              echo ''.$updatetxt.'';
            }    
            echo'</span></div>
          </div>
          <div class="cart-header" style="text-align: center;">
            <p style="margin-top: 8px"> '.$_language->module['install_version'].' <b>'.$version.'</b></p>
          </div>
        </div>
      </a>
    </div>

    <div class="style_prevu_kit" style="width: 300px;">
      <div class="cart">
        <div class="cart-block">
          <div class="logo1 image_caption text-center" style="height:220px"><span style="margin-top: -35px">'.$_language->module['server_check'].'
            
              Basesystem '.$on.'<br>
              Pluginsystem '.$plugin.'<br>
              Themesystem  '.$theme.'<br>
              '.$_language->module['server_used'].': '.$servername.'
            </span>
          </div>
        </div>
        <div class="cart-header" style="text-align: center;">
          <p style="margin-top: 8px">'.$_language->module['serversystem_text'].'</p>
          '.$report.'
        </div>
      </div>
    </div>


    <div class="style_prevu_kit" style="width: 300px;">
      <a href="https://webspell-rm.de/index.php?site=forum" target="_blank" style="text-decoration:none">
        <div class="cart">
          <div class="cart-block">
            <div class="logo1 image_caption text-center" style="height:220px"><span style="margin-top: -35px">'.$_language->module['forum'].'</span></div>
          </div>
          <div class="cart-header" style="text-align: center;">
            <p style="margin-top: 8px">'.$_language->module['forum_text'].'</p>
          </div>
        </div>
      </a>
    </div>

    <div class="style_prevu_kit" style="width: 300px;">
      <a href="https://www.webspell-rm.de/wiki.html" target="_blank" style="text-decoration:none">
        <div class="cart">
          <div class="cart-block">
            <div class="logo1 image_caption text-center" style="height:220px"><span style="margin-top: -35px">'.$_language->module['wiki'].'</span></div>
          </div>
          <div class="cart-header" style="text-align: center;">
            <p style="margin-top: 8px">'.$_language->module['wiki_text'].'</p>   
          </div>
        </div>
      </a>
    </div>

    <div class="style_prevu_kit" style="width: 300px;">
      <a href="https://discordapp.com/invite/SgPrVk?utm_source=Discord%20Widget&utm_medium=Connect" target="_blank" style="text-decoration:none">
        <div class="cart">
          <div class="cart-block">
            <div class="logo1 image_caption text-center" style="height:220px"><span style="margin-top: -35px">'.$_language->module['discord'].'</span></div>
          </div>
          <div class="cart-header" style="text-align: center;">
            <p style="margin-top: 8px">'.$_language->module['discord_text'].'</p>
          </div>
        </div>
      </a>
    </div>
  </div>
</div>';
if (!$getnew = @file_get_contents($updateserverurl.'/base/vupdate.php')) {
  echo '';
} else {
    echo '<div class="" style="margin-left: 50px; margin-right: -56px"><br>'.$updatebutton.'</div>';
}




function curl_json2array($url){
$ssl = 0;
if (substr($url, 0, 7) == "http://") { $ssl=0; } else { $ssl=1;}  
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
$output = curl_exec($ch);
curl_close($ch);
return json_decode($output, true);
}
$getversion = $version;

if (!$getnew = @file_get_contents($updateserverurl.'/plugin/plugin-base_v.'.$getversion.'/list.json')) {
  echo '';
} else {
if(!empty($_GET['up'])) {
  
       echo'test';    
 
} else { 
try {
  $url = $updateserverurl.'/plugin/plugin-base_v.'.$getversion.'/list.json';
  $imgurl = $updateserverurl.'/plugin/plugin-base_v.'.$getversion.'';
  $result = curl_json2array($url);
  $anz = (count($result)-1);
  $output = "";
  $input = "";
  
   for($plug=1; $plug<=$anz; $plug++) {
      $installedversion = '';
      $translate = new multiLanguage(detectCurrentLanguage());
      $translate->detectLanguages($result['item'.$plug]['description_de']);
      $result['item'.$plug]['description_de'] = $translate->getTextByLanguage($result['item'.$plug]['description_de']);
      $ergebnis = safe_query("SELECT * FROM `".PREFIX."plugins` WHERE `modulname`='".$result['item'.$plug]['modulname']."'");

            if(mysqli_num_rows($ergebnis) == '1') {
                $row = mysqli_fetch_assoc($ergebnis);
                if($row['version'] !== ''){
                    $installedversion = $row['version'];
                }
            }
            
      include("../system/version.php");
      if(is_dir("../includes/plugins/".$result['item'.$plug]['path'])) {
        #$output .= '<tr><td>';

          if($result['item'.$plug.'']['version_final'] === $installedversion) { 
              #$output .='';
            $input = "test";
          } else {

              $output .='


              <div class="style_prevu_kit" style="width: 350px;">
              <a href="?site=plugin_installer&id='.$plug.'&up=install&dir='.$result['item'.$plug]['path'].'" target="_self" style="text-decoration:none">
              <div class="cart">
              <div class="cart-block">
                <div class="log1o1 image_caption"><img class="img-fluid" style="max-width: 100%;height: auto;" src="'.$imgurl.''.$result['item'.$plug]['path'].$result['item'.$plug]['preview'].'" alt="{img}" />

                <span style="margin-top: -30px">Plugin '.$result['item'.$plug]['name'].'</span></div>
                <span>'.$_language->module['update_plugin'].'</span>
              </div>
  
              <div class="cart-header" style="text-align: center;"><p style="margin-top: 8px">Version '.$result['item'.$plug]['version_final'].'</p>
  
              </div>
              </div>
              </a>
              </div>';
            }
        
      } else { 

    }   

} 


} CATCH(Exception $e) {
  echo $e->message(); return false;
}

echo'<div class="card" style="margin-left: 50px; margin-right: 50px">
        <div class="card-header">
            <i class="fas fa-exclamation-triangle text-warning"></i> '.$_language->module['plugin_update'].'
        </div>
<div class="card-body">

'.$output.'</div>

</div>
    ';
}
}

$getversion = $version;

if (!$getnew = @file_get_contents($updateserverurl.'/theme/style-base_v.'.$getversion.'/list.json')) {
  echo '';
} else {
if(!empty($_GET['up'])) {
  
       echo'test';    
 
} else { 
try {
  $url = $updateserverurl.'/theme/style-base_v.'.$getversion.'/list.json';
  $imgurl = $updateserverurl.'/theme/style-base_v.'.$getversion.'';
  $result = curl_json2array($url);
  $anz = (count($result)-1);
  $output = "";
  $input = "";
  
   for($plug=1; $plug<=$anz; $plug++) {
      $installedversion = '';
      $translate = new multiLanguage(detectCurrentLanguage());
      $translate->detectLanguages($result['item'.$plug]['description_de']);
      $result['item'.$plug]['description_de'] = $translate->getTextByLanguage($result['item'.$plug]['description_de']);
      $ergebnis = safe_query("SELECT * FROM `".PREFIX."settings_themes` WHERE `modulname`='".$result['item'.$plug]['modulname']."'");

            if(mysqli_num_rows($ergebnis) == '1') {
                $row = mysqli_fetch_assoc($ergebnis);
                if($row['version'] !== ''){
                    $installedversion = $row['version'];
                }
            }
            
      include("../system/version.php");
      if(is_dir("../includes/themes/".$result['item'.$plug]['path'])) {
        #$output .= '<tr><td>';

          if($result['item'.$plug.'']['version_final'] === $installedversion) { 
              #$output .='';
            $input = "test";
          } else {

              $output .='


              <div class="style_prevu_kit" style="width: 350px;">
              <a href="?site=template_installer&id='.$plug.'&up=install&dir='.$result['item'.$plug]['path'].'" target="_self" style="text-decoration:none">
              <div class="cart">
              <div class="cart-block">
                <div class="log1o1 image_caption"><img class="img-fluid" style="max-width: 100%;height: auto;" src="'.$imgurl.''.$result['item'.$plug]['path'].$result['item'.$plug]['preview'].'" alt="{img}" />
                <span style="margin-top: -30px">Template '.$result['item'.$plug]['name'].'</span></div>
                <span>'.$_language->module['update_template'].'</span>
              </div>
  
              <div class="cart-header" style="text-align: center;"><p style="margin-top: 8px">Version '.$result['item'.$plug]['version_final'].'</p>
  
              </div>
              </div>
              </a>
              </div>';
            }


        
      } else {
 

    } 

  
  

} 


} CATCH(Exception $e) {
  echo $e->message(); return false;
}

echo'<div class="card" style="margin-left: 50px; margin-right: 50px">
        <div class="card-header">
            <i class="fas fa-exclamation-triangle text-warning"></i> '.$_language->module['templates_update'].'
        </div>
<div class="card-body">

'.$output.'</div>

</div>
    ';
}

}




  echo'<div class="card" style="margin-left: 50px; margin-right: 50px">
        <div class="card-header">
            <h3>CHANGELOG.md</h3>
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
</div>

';
