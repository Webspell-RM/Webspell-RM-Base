<script>
function goBack() {
    window.history.back();
}
</script>
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

function rmmodinstall($rubric,$modus,$dir,$id,$getversion){
  include('../system/func/update_base.php');

  $list = array('0', '1', '2', '3', '4', '5', '6');
  if($modus == 'install') {
    $installmodus = 'setup';
    $installmodustwo = 'install';
  } else {
    $installmodus = 'update';
    $installmodustwo = 'update';
  }

  if($rubric == 'temp') {
    $plugin = $updateserverurl.'/theme/style-base_v.'.$getversion.'/';
    $pluginlist = $updateserverurl.'/theme/style-base_v.'.$getversion.'/list.json';
    $instdir = 'themes';
    $contenthead = 'Themefiles';
  } else {
    $plugin = $updateserverurl.'/plugin/plugin-base_v.'.$getversion.'/';
    $pluginlist = $updateserverurl.'/plugin/plugin-base_v.'.$getversion.'/list.json';
    $instdir = 'plugins';
    $contenthead = 'Pluginfiles';

  }

  $dir = str_replace('/','',$dir);

  $filesgrant = array();
  if($rubric == 'temp') {
    $result = curl_json2array($pluginlist);
    if(isset($result['item'.$id]['required'])){
      $replacement[] = $dir;
      $pattern = explode(',', $result['item'.$id]['required']);
      foreach ($pattern as $value) { 
        $replacement[] .= $value;
      }
      $multivar = array($dir);	
      unset($replacement['0']);
      $multivarplugin = $replacement;
    } else {
      $multivar = array($dir);	
      $multivarplugin = '';
    }
  } else {
    $result = curl_json2array($pluginlist);
    if(isset($result['item'.$id]['required'])){
      $replacement[] = $dir;
      $pattern = explode(',', $result['item'.$id]['required']);
      foreach ($pattern as $value) { 
        $replacement[] .= $value;
      }
      $multivar = $replacement;	
    } else {
      $multivar = array($dir);	
    }
  }

  foreach (array_merge(array_filter($multivar)) as $dir) {
    unset($filesgrant);
    $url = $plugin.$dir.'/'.$installmodus.'.json';
    try {
      $result = curl_json2array($url);
      if($result!="NULL") {
        foreach ($list as $value) {
          // load index "php"
          $index = $value;
          $files = count($result['items'][$index])-1;
          if($files != '0') {
            for($i=1; $i<=$files; $i++) {
              try {
                if (!file_exists('../includes/'.$instdir.'/'.$dir.'/')) {
                  mkdir('../includes/'.$instdir.'/'.$dir.'/', 0777, true);
                }

                $filepath = '../includes/'.$instdir.'/'.$result['items'][$index]['file'.$i];
                $path_parts = pathinfo($filepath);
                if (!file_exists($path_parts['dirname'])) {
                  mkdir($path_parts['dirname'], 0777, true);
                }

                $file = '../includes/'.$instdir.'/'.$result['items'][$index]['file'.$i];
                $content = $plugin.$result['items'][$index]['file'.$i].'.txt';
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, $content);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                $content = curl_exec($curl);
                file_put_contents($file, $content);
                curl_close($curl);
                try {
                  //file_put_contents($file, $content);
                  $filesgrant[] = 'File created: '.$file.'<br />';
                } CATCH(Exception $f) {
                  echo $f->message();
                }
              } CATCH(Exception $s) {
                echo $s->message();
              }
            }
          }
        }

        echo'
          <div class=\'card\'>
            <div class=\'card-header\'>
              <h3>Loading '.$contenthead.'</h3>
            </div>
            <div class=\'card-body\'>
              <div class="alert alert-success" role="alert">
        ';
        foreach ($filesgrant as $filesgranted) {
                echo $filesgranted;
        }
        echo'
              </div>
            </div>
          </div>
        ';
        if(file_exists('../includes/'.$instdir.'/'.$dir.'/'.$installmodustwo.'.php')) {
          include('../includes/'.$instdir.'/'.$dir.'/'.$installmodustwo.'.php'); 
        } else { 
          echo '<br />No installation file found';
        }
      }
    } CATCH (Exception $e) {
      echo $e->message();
    }
  }
#echo "<h4>Installation Done</h4><a class='btn btn-secondary' href='admincenter.php?site=plugin-installer'>Go Back</a>";
  if(@$multivarplugin != '') {
    $plugin = 'https://www.webspell-rm.eu/plugin/plugin-base_v.'.$getversion.'/';
    $pluginlist = 'https://www.webspell-rm.eu/plugin/plugin-base_v.'.$getversion.'/list.json';
    $instdir = 'plugins';
    $contenthead = 'Pluginfiles';

  foreach (array_merge(array_filter($multivarplugin)) as $dir) {
    unset($filesgrant);
    unset($add_plugin);
    $url = $plugin.$dir.'/'.$installmodus.'.json';
    try {
      $result = curl_json2array($url);
      if($result!="NULL") {
        foreach ($list as $value) {
          // load index "php"
          $index = $value;
          $files = count($result['items'][$index])-1;
          if($files != '0') {
            for($i=1; $i<=$files; $i++) {
              try {
                if (!file_exists('../includes/'.$instdir.'/'.$dir.'/')) {
                  mkdir('../includes/'.$instdir.'/'.$dir.'/', 0777, true);
                }

                $filepath = '../includes/'.$instdir.'/'.$result['items'][$index]['file'.$i];
                $path_parts = pathinfo($filepath);
                if (!file_exists($path_parts['dirname'])) {
                  mkdir($path_parts['dirname'], 0777, true);
                }

                $file = '../includes/'.$instdir.'/'.$result['items'][$index]['file'.$i];
                $content = $plugin.$result['items'][$index]['file'.$i].'.txt';
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, $content);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                $content = curl_exec($curl);
                file_put_contents($file, $content);
                curl_close($curl);
                try {
                  //file_put_contents($file, $content);
                  $filesgrant[] = 'File created: '.$file.'<br />';
                } CATCH(Exception $f) {
                  echo $f->message();
                }
              } CATCH(Exception $s) {
                echo $s->message();
              }
            }
          }
        }

        echo'
          <div class=\'card\'>
            <div class=\'card-header\'>
              <h3>Loading '.$contenthead.'</h3>
            </div>
            <div class=\'card-body\'>
              <div class="alert alert-success" role="alert">
        ';
        foreach ($filesgrant as $filesgranted) {
                echo $filesgranted;
        }
        echo'
              </div>
            </div>
          </div>
        ';
        if(file_exists('../includes/'.$instdir.'/'.$dir.'/'.$installmodustwo.'.php')) {
          include('../includes/'.$instdir.'/'.$dir.'/'.$installmodustwo.'.php'); 
        } else { 
          echo '<br />No installation file found';
        }
      }
    } CATCH (Exception $e) {
      echo $e->message();
    }
  }
  }
echo "<h4>Installation Done</h4><button class='btn btn-secondary' onclick='goBack()'>Go Back</button>";
}
?>