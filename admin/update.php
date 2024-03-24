<?php
/**
 *¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
 *                  Webspell-RM      /                        /   /                                          *
 *                  -----------__---/__---__------__----__---/---/-----__---- _  _ -                         *
 *                   | /| /  /___) /   ) (_ `   /   ) /___) /   / __  /     /  /  /                          *
 *                  _|/_|/__(___ _(___/_(__)___/___/_(___ _/___/_____/_____/__/__/_                          *
 *                               Free Content / Management System                                            *
 *                                           /                                                               *
 *¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
 * @version         webspell-rm                                                                              *
 *                                                                                                           *
 * @copyright       2018-2024 by webspell-rm.de                                                              *
 * @support         For Support, Plugins, Templates and the Full Script visit webspell-rm.de                 *
 * @website         <https://www.webspell-rm.de>                                                             *
 * @forum           <https://www.webspell-rm.de/forum.html>                                                  *
 * @wiki            <https://www.webspell-rm.de/wiki.html>                                                   *
 *                                                                                                           *
 *¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
 * @license         Script runs under the GNU GENERAL PUBLIC LICENCE                                         *
 *                  It's NOT allowed to remove this copyright-tag                                            *
 *                  <http://www.fsf.org/licensing/licenses/gpl.html>                                         *
 *                                                                                                           *
 *¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
 * @author          Code based on WebSPELL Clanpackage (Michael Gruber - webspell.at)                        *
 * @copyright       2005-2011 by webspell.org / webspell.info                                                *
 *                                                                                                           *
 *¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
*/

/** ZENITH.Developments | GETSCHONNIK **/

$_language->readModule('plugin_installer', false, true);
$_language->readModule('update', false, true);
include("../system/version.php");
include('../system/func/installer.php');
include('../system/func/update_base.php');


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

####### Update #########
$url = $updateserverurl.'/base/vupdate.php';
@$check = fopen($url,"r");
if($check) {
  $update = @file_get_contents($updateserverurl.'/base/vupdate.php');
  $server_status = '(Alpha Server)';
}else{
  $update = @file_get_contents($dangerupdateserverurl.'/base/vupdate.php');
  $server_status = '(Beta Server)';
}  
#######################

if (!$getnew = $update) {
  echo '<div class="card">
        <div class="card-header">
            Plugin Installer
        </div>
        <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item" aria-current="page"><a href="admincenter.php?site=plugin_installer">Plugin Installer</a></li>
          <li class="breadcrumb-item active" aria-current="page">Error</li>
        </ol>
      </nav>

    <div class="card-body">

      <div class="alert alert-success" role="alert">
        <h4 class="alert-heading">Plugin Installer</h4>
          '.$_language->module['info_error'].'
          <hr>
          <i><b>' . $_language->module[ 'error' ] . '</b></i>
      </div></div></div>';
} else {
  $action = '';
  if (isset($_GET[ 'action' ])) {
    $action = $_GET[ 'action' ];
  }

  $v = '';
  if(isset($_GET['v'])) {
    $v = $_GET['v'];
  }
  
  $updatedocroot = $_SERVER['DOCUMENT_ROOT'];
  include("../system/version.php");
  include('../system/func/update_base.php');
  $_language->readModule('update', false, true);

  if($action == 'update' && $v !== '') {

    ####### Update #########
    $url = $updateserverurl.'/base/vupdate.php';
    @$check = fopen($url,"r");
    if($check) {
      $update = @file_get_contents($updateserverurl.'/base/vupdate.php');
      $server_status = '(Alpha Server)';
    }else{
      $update = @file_get_contents($dangerupdateserverurl.'/base/vupdate.php');
      $server_status = '(Beta Server)';
    }  
    #######################

    $result = curl_json2array($url);
    if($result!="NULL") {
      if(!(@file(''.$updatepfad.'/install.php.txt'))) {
        $noinstall = '
          <div class=\'card\'>
            <div class=\'card-header\'>
              '.$_language->module[ 'step2' ].'
            </div>
            <div class=\'card-body\'>
            <div class=\'alert alert-danger\' role=\'alert\'>
              <i><b>'.$_language->module[ 'error_step2_1' ].'</b></i>
            </div>
          </div>
          </div>
        ';
        $updatestop = '1'; 
      } else {  
        $noinstall = '
          <div class=\'card\'>
            <div class=\'card-header\'>
              '.$_language->module[ 'step2' ].'
            </div>
            <div class=\'card-body\'>
            <div class=\'alert alert-success\' role=\'alert\'>
              <i><b>'.$_language->module[ 'error_step2_2' ].'</b></i>
            </div>
          </div>
          </div>
        ';
      }

      if (!$getnew = $update) {
        $getserverstatus = '
          <div class=\'card\'>
            <div class=\'card-header\'>
              '.$_language->module[ 'step1' ].'
            </div>
            <div class=\'card-body\'>
            <div class=\'alert alert-danger\' role=\'alert\'>
              <i><b>'.$_language->module[ 'error' ].'</b></i>
            </div>
            </div>
          </div>
        '; 

      } else {
        $getserverstatus = '
          <div class=\'card\'>
            <div class=\'card-header\'>
              '.$_language->module[ 'step1' ].'
            </div>
            <div class=\'card-body\'>
            <div class=\'alert alert-success\' role=\'alert\'>
              <i><b>'.$_language->module[ 'updateserversuccess' ].'</b></i>
            </div>
            </div>
          </div>
        '; 
      }

  $settings = safe_query("SELECT * FROM " . PREFIX . "settings");
  $ds = mysqli_fetch_array($settings);
  $dir = $v / 18;
  $versionsplit = str_split($dir);

  $url = $updateserverurl.'/base/vupdate.php';
  @$check = fopen($url,"r");
  if($check) {
    $url = ''.$updateserverurl.'/base/'.$dir.'/setup.json';
    $updatepfad = $updateserverurl.'/base/'.$dir;
  }else{
    $url = ''.$dangerupdateserverurl.'/base/'.$dir.'/setup.json';
    $updatepfad = $dangerupdateserverurl.'/base/'.$dir;
  }  

  $filesgrant = array();
  $noinstall = ''.'' .$loadfiles1 = ''. '' .$loadfiles2 = ''. '' .$loadfiles3 = ''. '' .$instfileerr = ''. '' .$resulttable = ''. '' .$wsinstallcomplete = ''. '' .$loadinstaller = '';
  $wsinstall = '0'.'' .$filesgranted = '0'.''.$cal = '0';
  $updatestop = '';
  $newreupdateversion = '';

try {

  echo'
    <div class="col-lg-12"><br>
      <div class="card">
        <div class="card-header">
          '.$_language->module[ 'webspell_update' ].'
        </div>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="admincenter.php?site=update">'.$_language->module[ 'webspellupdater' ].'</a></li>
            
            <li class="breadcrumb-item active" aria-current="page">'.$_language->module[ 'update' ].'</li>
          </ol>
        </nav>  
        <div class="card-body">';

    $result = curl_json2array($url);
    if($result!="NULL") {
      if(!(@file(''.$updatepfad.'/install.php.txt'))) {
        $noinstall = '
          <div class=\'card\'>
            <div class=\'card-header\'>
              '.$_language->module[ 'step2' ].'
            </div>
            <div class=\'card-body\'>
            <div class=\'alert alert-danger\' role=\'alert\'>
              <i><b>'.$_language->module[ 'error_step2_1' ].'</b></i>
            </div>
          </div>
          </div>
        ';
        $updatestop = '1'; 
      } else {  
        $noinstall = '
          <div class=\'card\'>
            <div class=\'card-header\'>
              '.$_language->module[ 'step2' ].'
            </div>
            <div class=\'card-body\'>
            <div class=\'alert alert-success\' role=\'alert\'>
              <i><b>'.$_language->module[ 'error_step2_2' ].'</b></i>
            </div>
          </div>
          </div>
        ';

// erstellt einen Ordner
      $index = 0;
      $files = count($result['items'][$index])-1;
      if($files) {
        for($i=1; $i<=$files; $i++) {
          $cal++;
          try {
            $file = './../'.$result['items'][$index]['file'.$i];
            $content = ''.$updatepfad.'/'.$result['items'][$index]['file'.$i].'.txt';
            $ftp['file'] = ''.$result['items'][$index]['file'.$i].'';

            if (!file_exists('../'.$result['items'][$index]['file'.$i].'/')) {
              mkdir('../'.$result['items'][$index]['file'.$i].'/', 0777, true);
            }
                
            try {                  

              if(file_exists($file)) {
                $filesgrant[] = ''.$_language->module[ 'file_loaded' ].': '.$ftp['file'].'<br />';
                $filesgranted++;
              } else {
                $filesgrant[] = '<span style="color: #ff0000;">'.$_language->module[ 'file_not_loaded' ].': '.$ftp['file'].'</span><br />';
              }            

            } CATCH(Exception $f) {
              echo $f->message();
            }
          } CATCH(Exception $s) {
            echo $s->message();
          }
        }
      }
// Files werden auf den Server geladen
      $index = 1;
      $files = count($result['items'][$index])-1;
      if($files) {
        for($i=1; $i<=$files; $i++) {
          $cal++;
          $result = curl_json2array($url);
          try {
            $exfile = ''.$result['items'][$index]['file'.$i];
            $file = './../'.$result['items'][$index]['file'.$i];
            $content = ''.$updatepfad.''.$result['items'][$index]['file'.$i].'.txt';
            $ftp['file'] = '..'.$result['items'][$index]['file'.$i].'';

            $filename = $ftp['file'];

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $content);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            $content = curl_exec($curl);
            @file_put_contents($filename, $content);
            curl_close($curl);

            try {

              if(file_exists($filename)) {
                $filesgrant[] = $_language->module[ 'file_loaded' ].': '.$filename.'<br />';
                $filesgranted++;
              } else {
                $filesgrant[] = '<span style="color: #ff0000;">'.$_language->module[ 'file_not_loaded' ].': '.$filename.'</span><br />';
              }
            
            } CATCH(Exception $f) {
              echo $f->message();
            }
          } CATCH(Exception $s) {
            echo $s->message();
          }
        }
      } 
// Files werden vom Server gelöscht
      $index = 2;
      $files = count($result['items'][$index])-1;
      if($files) {
        for($i=1; $i<=$files; $i++) {
          $cal++;
          try {
            $delfile = ''.$result['items'][$index]['file'.$i];
            $delfiles = '../'.$result['items'][$index]['file'.$i];
            $ftp['file'] = '..'.$result['items'][$index]['file'.$i].'';
            $file = ''.$result['items'][$index]['file'.$i];
            $content = ''.$updatepfad.'/'.$result['items'][$index]['file'.$i].'.txt';
           
            // Löscht die Datei vom Server
            $filename = $ftp['file'];

            if(@unlink($filename)) {
              $filesgrant[] = $_language->module[ 'file_deleted' ].': '.$filename .'<br />';
              $filesgranted++;
            } else {
              $filesgrant[] = '<span class="fst-italic" style="color: #ff0000;">'.$_language->module[ 'file_not_deleted' ].':</span> <span class="fst-italic">'.$filename.'</span><br />';
              $filesgranted++;
            }
            
          } CATCH(Exception $s) {
            echo $s->message();
          }
        }
      }
    }
  }
} CATCH (Exception $e) {
  echo $e->message();
}

if($updatestop != '1') {
    if($cal - $filesgranted == '0') {
      $loadinstaller = '<i><b>'.$_language->module[ 'all_files_have_been_edited' ].':  '.$filesgranted.' '.$_language->module[ 'of' ].' '.$cal.' </b></i>';
      if(file_exists('../install.php')) {
        include('../install.php');
        $instfileerr = $resulttable;
        if($wsinstall == '1') {
          $wsinstallcomplete = '
          <div class=\'card\'>
              <div class=\'card-header\'>
                '.$_language->module[ 'step5' ].'
              </div>
              <div class=\'card-body\'>
            <div class="alert alert-success"><i>'.$_language->module[ 'installcomplete_1' ].': <strong>'.$versionsplit['0'].'.'.$versionsplit['1'].'.'.$versionsplit['2'].'</strong> '.$_language->module[ 'installcomplete_2' ].'</i></div>
            </div>
            </div>';

          $wsinstallcomplete_button = '<a href="admincenter.php?site=update">
              <button class="btn btn-primary" type="submit" name="submit">'.$_language->module[ 'back_to_overview' ].'</button>
            </a>';

          // Löscht die install.php Datei vom Server
          $datei = '../install.php';

          if ( @ unlink ( $datei ) )
          {
            $wsinstallcompletedel = '<div class=\'card\'>
              <div class=\'card-header\'>
                '.$_language->module[ 'step6' ].'
              </div>
              <div class=\'card-body\'><div class="alert alert-success" role="alert">'.$_language->module[ 'teh_file' ].' ' . $datei . ' '.$_language->module[ 'successfully_deleted' ].'</div>
              </div>
            </div>';
          }
          else
          {
            $wsinstallcompletedel = '<div class=\'card\'>
              <div class=\'card-header\'>
                '.$_language->module[ 'step6' ].'
              </div>
              <div class=\'card-body\'><div class="alert alert-danger" role="alert">'.$_language->module[ 'file_not_deleted' ].' ' . $datei . '</div>
              </div>
            </div>';
          }

          
        } else {
          $wsinstallcomplete = '
            <div class=\'card\'>
              <div class=\'card-header\'>
                '.$_language->module[ 'step4' ].'
              </div>
              <div class=\'card-body\'>
              <div class=\'alert alert-danger\' role=\'alert\'>
                <i><b>'.$_language->module[ 'syq_error' ].'</b></i>
              </div>
            </div>
            </div>
          ';
          $wsinstallcompletedel='';
          $wsinstallcomplete_button = '<a href="admincenter.php?site=update">
                        <button class="btn btn-primary" type="submit" name="submit">'.$_language->module[ 'back_to_overview' ].'</button>
            </a>';

        }
      }
    } else {
      $loadinstaller = '<br /><span style="color: #ff0000;"><i><b>'.$_language->module[ 'not_all_files_edited' ].'<br />Result:   '.$filesgranted.' '.$_language->module[ 'of' ].'  '.$cal.'</b></i></span>';
      $wsinstallcompletedel='';
      $wsinstallcomplete_button = '<a href="admincenter.php?site=update">
                        <button class="btn btn-primary" type="submit" name="submit">'.$_language->module[ 'back_to_overview' ].'</button>
            </a>';
    }
  
    $loadfiles1 = '
          <div class=\'card\'>
            <div class=\'card-header\'>
              '.$_language->module[ 'step3' ].'
            </div>
            <div class=\'card-body\'>
            <div class=\'alert alert-info\' role=\'alert\'>
        ';
        foreach ($filesgrant as $filesgranted) {
          $loadfiles2 .= $filesgranted;
        }
        $loadfiles2 .= $loadinstaller;
        $loadfiles3 = '
             </div>
           </div>
           </div>
    ';
  } 
  

  echo'
            '.$getserverstatus.'<br />
            '.$noinstall.'<br />
            '.$loadfiles1.' '.$loadfiles2.' '.$loadfiles3.'
            '.$instfileerr.'
            '.$wsinstallcomplete.'
            '.$wsinstallcompletedel.'
            '.$wsinstallcomplete_button.'
          </div>
        </div>
      </div>
  ';
}

} elseif($action == '') {

####### Update #########
$url = $updateserverurl.'/base/vupdate.php';
@$check = fopen($url,"r");
if($check) {
  $update = @file_get_contents($updateserverurl.'/base/vupdate.php');
  $server_status = '(Alpha Server)';
}else{
  $update = @file_get_contents($dangerupdateserverurl.'/base/vupdate.php');
  $server_status = '(Beta Server)';
}  
#######################

  if (!$getnew = $update) {
    echo '<i><b>' . $_language->module[ 'error' ] . '&nbsp;' . $updateserverurl . '.</b></i>';
  } else {
    $latest = explode(".", $getnew);
    $latestversion = ''.$latest['0'].''.$latest['1'].''.$latest['2'].'';
    $ownversion = explode(".", $version);     
    $ownversion = ''.$ownversion['0'].''.$ownversion['1'].''.$ownversion['2'].'';
    $updatebutton = '';
    $newupdateversion = ($ownversion + 1) * 18;
    $newreupdateversion = $ownversion * 18;

    if($ownversion !== $newupdateversion) { 
        $updatebuttontrue = '
            <a href="admincenter.php?site=update&amp;action=update&v='.$newupdateversion.'">
                <button class="btn btn-primary" type="submit" name="submit">'.$_language->module['update_now'].'</button>
            </a>
        ';
        
    } else { 
        $updatebuttontrue = '
            <button class="btn btn-primary" type="submit" name="submit" disabled>'.$_language->module['fill_in_ftp_settings'].'</button>
        ';
    }
 
    if ($ownversion < $latestversion) {
      $updatetxt = '<span style="color: #ff0000;">'.$_language->module['new_version_available'].'</span>';
      $updatebutton = '
        <div class="alert alert-info"> 
          <h4><strong>'.$_language->module['update_info1'].'</strong></h4><br />
          '.$_language->module['update_info2'].'</div><br />
        '.$updatebuttontrue.'
      ';
    } elseif ($ownversion == $latestversion) {
      $updatetxt =  '
          <span style="color: #ff0000;">'.$_language->module['update_info3'].'</span><br /><br />';
         $updatebutton = '<div class="alert alert-info"><h4><strong>'.$_language->module['update_info1'].'</strong></h4><br />
          '.$_language->module['update_info2'].'<br /><br /> '.$_language->module['update_info4'].'</div>
        <a href="admincenter.php?site=update&amp;action=update&v='.$newreupdateversion.'">
              <button class="btn btn-primary" type="submit" name="submit">'.$_language->module['re_update'].'</button>
          </a>
        ';
    } else {
      $updatetxt =  '<span style="color: #ff0000;">'.$_language->module['update_info5'].'</span>';
    }
  }

  echo'
    <div class="col-lg-12"><br>
      <div class="card">
        <div class="card-header">
          '.$_language->module[ 'webspell_update' ].'
        </div>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">'.$_language->module[ 'webspellupdater' ].'</li>
            <!--<li class="breadcrumb-item"><a href="admincenter.php?site=update">'.$_language->module[ 'check_version' ].'</a></li>-->
          </ol>
        </nav>  
        <div class="card-body">
            <div class="alert alert-success"> 
            <p class="text-sm-start">'.$server_status.'</p>
              <strong>'.$_language->module[ 'your_version' ].':</strong> '.$version.'<br /><strong>'.$_language->module[ 'latest_version' ].':</strong> '.$getnew.' <br />
              <strong>'.$_language->module[ 'result' ].':</strong> '.$updatetxt.'
            </div>
            '.$updatebutton.'
          </div>
       
      </div>
    </div>
  ';
}
}
?>