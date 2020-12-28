<style type="text/css">
@import url('https://fonts.googleapis.com/css?family=Exo+2:100,400');
html, body 
.mare15 { margin-right: 15px; }
.fontLight { font-weight: 100;}
.float-right { float: right; }
img.img-plugin-picture { width: 100%; height: 100px;}
.red { color: red}
.green {color: green}
.orange {color: orange}
div.full { width: 100%; margin: 0 auto; }
div.head-pb { cursor: pointer; border: 1px solid #3ca2bc; background-color: #3ca2bc; color: white; width: 214px; padding: 6px 0 6px 8px; float: left; }
div.head-nav { cursor: pointer; border: 1px solid #333333; color: #333; width: 214px; padding: 6px 0 6px 8px; float: left; }


div.imageHold {
  width: 320px;
  height: 74px;/*120
  padding: 5px 5px; /* damit der container die hÃƒÂ¶he des groÃƒÅ¸en bildes annimmt */
  /* andere formatierung, z.B. zentrieren/etc: */
  /* .... */
}

div.imageHold div {
  float: left;
  width: 320px;
  height: 74px;
  /* ab hier kann man die abstÃƒÂ¤nde
  und sonstiges der bilder eintragen */
  margin-left: 0px;
}

div.imageHold img {
  border: 1px solid #666666;
  width: 320px;  /* wir skalieren das groÃƒÅ¸e bild auf die kleine grÃƒÂ¶ÃƒÅ¸e */
  height: 74px; /* um verpixelung beim vergÃƒÂ¶ÃƒÅ¸ern zu verhindern       */
}

blockquote {
    font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
    font-size: 12px;
    font-style: normal;
    margin: 0.25em 0;
    padding: 0.25em 40px;
    line-height: 1.45;
    position: relative;
    color: #383838;
    background:#ececec;
    border-left:5px solid #FF7F00;
    
}

</style>
<div class="card">
        <div class="card-header">
            <i class="fas fa-puzzle-piece"></i> Plugin Installer
        </div>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">Plugin Installer</li>
  </ol>
</nav>

<div class="card-body">
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
/** ZENITH.Developments | GETSCHONNIK **/

$_language->readModule('plugin_installer', false, true);

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
//echo $getversion;
if(isset($_GET['deinstall'] )== 'plugin') {
  $dir = $_GET['dir'];
  $name = str_replace("/", "", $dir);
  require_once('../includes/plugins'. $dir.'uninstall.php');
  recursiveRemoveDirectory('../includes/plugins'. $dir); 
  header('Location: ?site=plugin-installer');
  exit;
} elseif(!empty($_GET['do'])) {
  $dir = $_GET['dir'];
  $dir = str_replace('/','',$dir);
  $id = $_GET['id'];
  $plugin = 'https://pluginbase.webspell-rm.eu/plugin-base_v.'.$getversion.'/';
  $pluginlist = 'https://pluginbase.webspell-rm.eu/plugin-base_v.'.$getversion.'/list.json';
  $filesgrant = array();
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
  foreach (array_merge(array_filter($multivar)) as $dir) {
    unset($filesgrant);
    $url = $plugin.$dir.'/setup.json';
	try {
		$result = curl_json2array($url);
		if($result!="NULL") {
		  
		  // load index "php"
		  $index = 0;
		  $files = count($result['items'][$index])-1;
		  if($files) {
			for($i=1; $i<=$files; $i++) {
			  try {
				if (!file_exists('../includes/plugins/'.$dir.'/')) {
				  mkdir('../includes/plugins/'.$dir.'/', 0777, true);
				}
				$file = '../includes/plugins/'.$result['items'][$index]['file'.$i];
				$content = $plugin.$result['items'][$index]['file'.$i].'.txt';
				$curl = curl_init();
					curl_setopt($curl, CURLOPT_URL, $content);
					curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
					$content = curl_exec($curl);
					curl_close($curl);
				try {
				  file_put_contents($file, $content);
				  $filesgrant[] = 'File created: '.$file.'<br />';
				} CATCH(Exception $f) {
				  echo $f->message();
				}
			  } CATCH(Exception $s) {
				echo $s->message();
			  }
			}
		  } 

		  // load index "language"
		  $index = 1;
		  $files = @count($result['items'][$index])-1;
		  if($files) {
			for($i=1; $i<=$files; $i++) {
			  try {
				$filepath = '../includes/plugins/'.$result['items'][$index]['file'.$i];
				$path_parts = pathinfo($filepath);
				if (!file_exists($path_parts['dirname'])) {
				  mkdir($path_parts['dirname'], 0777, true);
				}
				$file = '../includes/plugins/'.$result['items'][$index]['file'.$i];
				$content = $plugin.$result['items'][$index]['file'.$i].'.txt';
				$curl = curl_init();
					curl_setopt($curl, CURLOPT_URL, $content);
					curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
					$content = curl_exec($curl);
					curl_close($curl);
				try {
				  file_put_contents($file, $content);
				  $filesgrant[] = 'File created: '.$file.'<br />';
				} CATCH(Exception $f) {
				  echo $f->message();
				}
			  } CATCH(Exception $s) {
				echo $s->message();
			  }
			}
		  } 

		  // load index "admin"
		  $index = 2;
		  $files = @count($result['items'][$index])-1;
		  if($files) {
			for($i=1; $i<=$files; $i++) {
			  try {
				$filepath = '../includes/plugins/'.$result['items'][$index]['file'.$i];
				$path_parts = pathinfo($filepath);
				if (!file_exists($path_parts['dirname'])) {
				  mkdir($path_parts['dirname'], 0777, true);
				}
				$file = '../includes/plugins/'.$result['items'][$index]['file'.$i];
				$content = $plugin.$result['items'][$index]['file'.$i].'.txt';
				$curl = curl_init();
					curl_setopt($curl, CURLOPT_URL, $content);
					curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
					$content = curl_exec($curl);
					curl_close($curl);
				try {
				  file_put_contents($file, $content);
				  $filesgrant[] = 'File created: '.$file.'<br />';
				} CATCH(Exception $f) {
				  echo $f->message();
				}

			  } CATCH(Exception $s) {
				echo $s->message();
			  }
			}
		  }   

		  // load index "html"
		  $index = 3;
		  $files = @count($result['items'][$index])-1;
		  if($files) {
			for($i=1; $i<=$files; $i++) {
			  try {
				$filepath = '../includes/plugins/'.$result['items'][$index]['file'.$i];
				$path_parts = pathinfo($filepath);
				if (!file_exists($path_parts['dirname'])) {
				  mkdir($path_parts['dirname'], 0777, true);
				}
				$file = '../includes/plugins/'.$result['items'][$index]['file'.$i];
				$content = $plugin.$result['items'][$index]['file'.$i];
				$curl = curl_init();
					curl_setopt($curl, CURLOPT_URL, $content);
					curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
					$content = curl_exec($curl);
					curl_close($curl);
				try {
				  file_put_contents($file, $content);
				  $filesgrant[] = 'File created: '.$file.'<br />';
				} CATCH(Exception $f) {
				  echo $f->message();
				}
			  } CATCH(Exception $s) {
				echo $s->message();
			  }
			}
		  }       

		  // load index "images"
		  $index = 4;
		  $files = @count($result['items'][$index])-1;
		  if($files) {
			for($i=1; $i<=$files; $i++) {
			  try {
				$filepath = '../includes/plugins/'.$result['items'][$index]['file'.$i];
				$path_parts = pathinfo($filepath);
				if (!file_exists($path_parts['dirname'])) {
				  mkdir($path_parts['dirname'], 0777, true);
				}
				$file = '../includes/plugins/'.$result['items'][$index]['file'.$i];
				$content = $plugin.$result['items'][$index]['file'.$i];
				$curl = curl_init();
					curl_setopt($curl, CURLOPT_URL, $content);
					curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
					$content = curl_exec($curl);
					curl_close($curl);
				try {
				  file_put_contents($file, $content);
				  $filesgrant[] = 'File created: '.$file.'<br />';
				} CATCH(Exception $f) {
				  echo $f->message();
				}
			  } CATCH(Exception $s) {
				echo $s->message();
			  }
			}
		  }       

				// load index "css"
		  $index = 5;
		  $files = @count($result['items'][$index])-1;
		  if($files) {
			for($i=1; $i<=$files; $i++) {
			  try {
				$filepath = '../includes/plugins/'.$result['items'][$index]['file'.$i];
				$path_parts = pathinfo($filepath);
				if (!file_exists($path_parts['dirname'])) {
				  mkdir($path_parts['dirname'], 0777, true);
				}
				$file = '../includes/plugins/'.$result['items'][$index]['file'.$i];
				$content = $plugin.$result['items'][$index]['file'.$i];
				$curl = curl_init();
					curl_setopt($curl, CURLOPT_URL, $content);
					curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
					$content = curl_exec($curl);
					curl_close($curl);
				try {
				  file_put_contents($file, $content);
				  $filesgrant[] = 'File created: '.$file.'<br />';
				} CATCH(Exception $f) {
				  echo $f->message();
				}
			  } CATCH(Exception $s) {
				echo $s->message();
			  }
			}
		  } 

		  // load index "js"
		  $index = 6;
		  $files = @count($result['items'][$index])-1;    // @ -> deactivate error if no js necessary
		  if($files) {
			for($i=1; $i<=$files; $i++) {
			  try {
				$filepath = '../includes/plugins/'.$result['items'][$index]['file'.$i];
				$path_parts = pathinfo($filepath);
				if (!file_exists($path_parts['dirname'])) {
				  mkdir($path_parts['dirname'], 0777, true);
				}
				$file = '../includes/plugins/'.$result['items'][$index]['file'.$i];
				$content = $plugin.$result['items'][$index]['file'.$i];
				$curl = curl_init();
					curl_setopt($curl, CURLOPT_URL, $content);
					curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
					$content = curl_exec($curl);
					curl_close($curl);
				try {
				  file_put_contents($file, $content);
				  $filesgrant[] = 'File created: '.$file.'<br />';
				} CATCH(Exception $f) {
				  echo $f->message();
				}
			  } CATCH(Exception $s) {
				echo $s->message();
			  }
			}
		  }     



          echo '
            <div class=\'card\'>
              <div class=\'card-header\'>
                <h3>Loading Pluginfiles</h3>
              </div>
              <div class=\'card-body\'>
                <div class="alert alert-success" role="alert">
          ';
          foreach ($filesgrant as $filesgranted) {
            echo $filesgranted;
          }
          echo '
               </div>
             </div>
           </div>
          ';









		  if(file_exists('../includes/plugins/'.$dir.'/install.php')) {
			include('../includes/plugins/'.$dir.'/install.php'); 
		  } else { 
			echo "<br />No installation file found";
		  }
		  
		}
	  } CATCH (Exception $e) {
		echo $e->message();
	  }

	  //echo "<br /><br /><h4>Installation Done</h4><br /><br />";
	  //return false;
	}
} elseif(!empty($_GET['up'])) {
  $dir = $_GET['dir'];
  $dir = str_replace('/','',$dir);
  $id = $_GET['id'];
  $plugin = 'https://pluginbase.webspell-rm.eu/plugin-base_v.'.$getversion.'/';
  $pluginlist = 'https://pluginbase.webspell-rm.eu/plugin-base_v.'.$getversion.'/list.json';
  $filesgrant = array();
  $result = curl_json2array($pluginlist);
  if(isset($result['item'.$id]['required'])){
    $replacement[] = $dir;
    // Problem beim update. Es werden 2 Einträge erstellt in DB plugins
    /*$pattern = explode(',', $result['item'.$id]['required']);
    foreach ($pattern as $value) { 
      $replacement[] .= $value;
    }*/
    $multivar = $replacement;  
  } else {
    $multivar = array($dir);  
  }
  foreach (array_merge(array_filter($multivar)) as $dir) {
    unset($filesgrant);
    $url = $plugin.$dir.'/update.json';
	try {
		$result = curl_json2array($url);
		if($result!="NULL") {
		  
		  // load index "php"
		  $index = 0;
		  $files = count($result['items'][$index])-1;
		  if($files) {
			for($i=1; $i<=$files; $i++) {
			  try {
				if (!file_exists('../includes/plugins/'.$dir.'/')) {
				  mkdir('../includes/plugins/'.$dir.'/', 0777, true);
				}
				$file = '../includes/plugins/'.$result['items'][$index]['file'.$i];
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

		  // load index "language"
		  $index = 1;
		  $files = @count($result['items'][$index])-1;
		  if($files) {
			for($i=1; $i<=$files; $i++) {
			  try {
				$filepath = '../includes/plugins/'.$result['items'][$index]['file'.$i];
				$path_parts = pathinfo($filepath);
				if (!file_exists($path_parts['dirname'])) {
				  mkdir($path_parts['dirname'], 0777, true);
				}
				$file = '../includes/plugins/'.$result['items'][$index]['file'.$i];
				$content = $plugin.$result['items'][$index]['file'.$i].'.txt';
				$curl = curl_init();
					curl_setopt($curl, CURLOPT_URL, $content);
					curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
					$content = curl_exec($curl);
					curl_close($curl);
				try {
				  file_put_contents($file, $content);
				  $filesgrant[] = 'File created: '.$file.'<br />';
				} CATCH(Exception $f) {
				  echo $f->message();
				}
			  } CATCH(Exception $s) {
				echo $s->message();
			  }
			}
		  } 

		  // load index "admin"
		  $index = 2;
		  $files = @count($result['items'][$index])-1;
		  if($files) {
			for($i=1; $i<=$files; $i++) {
			  try {
				$filepath = '../includes/plugins/'.$result['items'][$index]['file'.$i];
				$path_parts = pathinfo($filepath);
				if (!file_exists($path_parts['dirname'])) {
				  mkdir($path_parts['dirname'], 0777, true);
				}
				$file = '../includes/plugins/'.$result['items'][$index]['file'.$i];
				$content = $plugin.$result['items'][$index]['file'.$i].'.txt';
				$curl = curl_init();
					curl_setopt($curl, CURLOPT_URL, $content);
					curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
					$content = curl_exec($curl);
					curl_close($curl);
				try {
				  file_put_contents($file, $content);
				  $filesgrant[] = 'File created: '.$file.'<br />';
				} CATCH(Exception $f) {
				  echo $f->message();
				}

			  } CATCH(Exception $s) {
				echo $s->message();
			  }
			}
		  }   

		  // load index "html"
		  $index = 3;
		  $files = @count($result['items'][$index])-1;
		  if($files) {
			for($i=1; $i<=$files; $i++) {
			  try {
				$filepath = '../includes/plugins/'.$result['items'][$index]['file'.$i];
				$path_parts = pathinfo($filepath);
				if (!file_exists($path_parts['dirname'])) {
				  mkdir($path_parts['dirname'], 0777, true);
				}
				$file = '../includes/plugins/'.$result['items'][$index]['file'.$i];
				$content = $plugin.$result['items'][$index]['file'.$i];
				$curl = curl_init();
					curl_setopt($curl, CURLOPT_URL, $content);
					curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
					$content = curl_exec($curl);
					curl_close($curl);
				try {
				  file_put_contents($file, $content);
				  $filesgrant[] = 'File created: '.$file.'<br />';
				} CATCH(Exception $f) {
				  echo $f->message();
				}
			  } CATCH(Exception $s) {
				echo $s->message();
			  }
			}
		  }       

		  // load index "images"
		  $index = 4;
		  $files = @count($result['items'][$index])-1;
		  if($files) {
			for($i=1; $i<=$files; $i++) {
			  try {
				$filepath = '../includes/plugins/'.$result['items'][$index]['file'.$i];
				$path_parts = pathinfo($filepath);
				if (!file_exists($path_parts['dirname'])) {
				  mkdir($path_parts['dirname'], 0777, true);
				}
				$file = '../includes/plugins/'.$result['items'][$index]['file'.$i];
				$content = $plugin.$result['items'][$index]['file'.$i];
				$curl = curl_init();
					curl_setopt($curl, CURLOPT_URL, $content);
					curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
					$content = curl_exec($curl);
					curl_close($curl);
				try {
				  file_put_contents($file, $content);
				  $filesgrant[] = 'File created: '.$file.'<br />';
				} CATCH(Exception $f) {
				  echo $f->message();
				}
			  } CATCH(Exception $s) {
				echo $s->message();
			  }
			}
		  }       

				// load index "css"
		  $index = 5;
		  $files = @count($result['items'][$index])-1;
		  if($files) {
			for($i=1; $i<=$files; $i++) {
			  try {
				$filepath = '../includes/plugins/'.$result['items'][$index]['file'.$i];
				$path_parts = pathinfo($filepath);
				if (!file_exists($path_parts['dirname'])) {
				  mkdir($path_parts['dirname'], 0777, true);
				}
				$file = '../includes/plugins/'.$result['items'][$index]['file'.$i];
				$content = $plugin.$result['items'][$index]['file'.$i];
				$curl = curl_init();
					curl_setopt($curl, CURLOPT_URL, $content);
					curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
					$content = curl_exec($curl);
					curl_close($curl);
				try {
				  file_put_contents($file, $content);
				  $filesgrant[] = 'File created: '.$file.'<br />';
				} CATCH(Exception $f) {
				  echo $f->message();
				}
			  } CATCH(Exception $s) {
				echo $s->message();
			  }
			}
		  } 

		  // load index "js"
		  $index = 6;
		  $files = @count($result['items'][$index])-1;    // @ -> deactivate error if no js necessary
		  if($files) {
			for($i=1; $i<=$files; $i++) {
			  try {
				$filepath = '../includes/plugins/'.$result['items'][$index]['file'.$i];
				$path_parts = pathinfo($filepath);
				if (!file_exists($path_parts['dirname'])) {
				  mkdir($path_parts['dirname'], 0777, true);
				}
				$file = '../includes/plugins/'.$result['items'][$index]['file'.$i];
				$content = $plugin.$result['items'][$index]['file'.$i];
				$curl = curl_init();
					curl_setopt($curl, CURLOPT_URL, $content);
					curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
					$content = curl_exec($curl);
					curl_close($curl);
				try {
				  file_put_contents($file, $content);
				  $filesgrant[] = 'File created: '.$file.'<br />';
				} CATCH(Exception $f) {
				  echo $f->message();
				}
			  } CATCH(Exception $s) {
				echo $s->message();
			  }
			}
		  }     



          echo '
            <div class=\'card\'>
              <div class=\'card-header\'>
                <h3>Loading Pluginfiles</h3>
              </div>
              <div class=\'card-body\'>
                <div class="alert alert-success" role="alert">
          ';
          foreach ($filesgrant as $filesgranted) {
            echo $filesgranted;
          }
          echo '
               </div>
             </div>
           </div>
          ';









		  if(file_exists('../includes/plugins/'.$dir.'/update.php')) {
			include('../includes/plugins/'.$dir.'/update.php'); 
		  } else { 
			echo "<br />No installation file found";
		  }
		  
		}
	  } CATCH (Exception $e) {
		echo $e->message();
	  }

	  //echo "<br /><br /><h4>Update Done</h4><br /><br />";
	  //return false;
	}
 
} else {
try {
  $url = 'https://pluginbase.webspell-rm.eu/plugin-base_v.'.$getversion.'/list.json';
  $imgurl = 'https://pluginbase.webspell-rm.eu/plugin-base_v.'.$getversion.'';
  $result = curl_json2array($url);
  $anz = (count($result)-1);
  $output = "";
  $input = "";
  $install_datei ="";
  
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
            $output .= '  <tr>';
      $output .= '<th><img src="'.$imgurl.''.$result['item'.$plug]['path'].$result['item'.$plug]['preview'].'" class="img-plugin-picture" alt="{img}" /></th>';
      $output .= '<th><strong>'.$result['item'.$plug]['name'].'</strong><br /><small class="fontLight">'.$result['item'.$plug]['description_de'].'<br />by '.$result['item'.$plug]['author'].'</small>
      				<br>
					<span class="list-group-item list-group-item-warning" role="alert"><small class="fontLight">' . $_language->module['plus_plugin'] . ': <b>'.$result['item'.$plug]['required'].'</b></small></span>
					</th>';
	  $output .= '<th><small class="fontLight">Plugin Ver.: <span class="label label-success">'.$result['item'.$plug]['version_final'].'</span><br /><small class="fontLight">Inst. Plugin Ver.: '.$installedversion.'<span class="label label-warning">'.$result['item'.$plug]['version_beta'].'</span><span class="label label-danger">'.$result['item'.$plug]['version_test'].'</span><br />Req: webSpell | RM: <b>'.$result['item'.$plug]['req'].'</b><br />Language: '.$result['item'.$plug]['languages'].'<br />Update: <b>'.$result['item'.$plug]['update'].'</b></small></th>';
    
      include("../system/version.php");
      if(is_dir("../includes/plugins/".$result['item'.$plug]['path'])) {
        $output .= '<th>';
          if($result['item'.$plug.'']['version_final'] === $installedversion) { 
              $output .='';
          } else { 
              $output .='<a class="btn btn-info" style="width: 160px" href="?site=plugin-installer&id='.$plug.'&up=install&dir='.$result['item'.$plug]['path'].'">' . $_language->module['update'] . ' to Ver. '.$result['item'.$plug]['version_final'].'</a>';  
          }


$output .='<button class="btn btn-danger" style="width: 160px" data-href="?site=plugin-installer&deinstall=plugin&dir='.$result['item'.$plug]['path'].'" data-toggle="modal" data-target="#confirm-delete">
            ' . $_language->module['plugin_deinstallieren'] . '</button></th>
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
               <h4 class="modal-title" id="modalLabel">' . $_language->module['plugin_deinstallieren'] . '</h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
               <p>' . $_language->module['delete_info'] . '</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">' . $_language->module['plugin_back'] . '</button>
                <a class="btn btn-danger btn-ok">' . $_language->module['plugin_deinstallieren'] . '</a>
            </div>
        </div>
    </div>
</div>';
        
        
        
      } else {
        if($result['item'.$plug]['req']==$version) {
          $output .= '<th><a class="btn btn-success" style="width: 160px" href="?site=plugin-installer&do=install&id='.$plug.'&dir='.$result['item'.$plug]['path'].'">' . $_language->module['installation'] . '</a></th>';
          $output .= '  </tr>';
        } else {
          $output.= '<th><button class="btn btn-warning" style="width: 160px">' . $_language->module['incompatible'] . '</button></th>';
          $output .= '  </tr>';
        }

    } 

    
  

} 


} CATCH(Exception $e) {
  echo $e->message(); return false;
}

$_language->readModule('plugin-installer');
$_language->readModule('plugin-installer', false, true);
 
  echo'
    <div class="title-block">
      <p class="title-description">'.$_language->module['info'].'</p>
    </div>
    <i class="fas fa-puzzle-piece"></i> '.$_language->module['all_plugins'].' &nbsp; ('.$anz.')<br>
    <!-- END -->
    <!-- plugin-installer_content -->
    <table id="plugini" class="table table-bordered table-striped dataTable">
      <thead>
        <tr>
          <th style="width: 22%"><b>'. $_language->module['preview'] .'</b></th>
          <th style="width: 49%"><b>'.$_language->module['description'] .'</b></th>
          <th style="width: 14%"><b>'.$_language->module['version'] .'</b></th>
          <th><b>'.$_language->module['options'] .'</b></th>
        </tr>
      </thead>
      <tbody>
        '.$output.'
        <tfoot>
          <tr>
            <th style="width: 22%"><b>'.$_language->module['preview'] .'</b></th>
            <th style="width: 49%"><b>'.$_language->module['description'].'</b></th>
            <th style="width: 14%"><b>'.$_language->module['version'].'</b></th>
            <th><b>'.$_language->module['options'].'</b></th>
          </tr>
        </tfoot>
       </table>
      </div>
      </div>
    ';
}