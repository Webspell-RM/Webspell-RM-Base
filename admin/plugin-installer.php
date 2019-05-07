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
  padding: 5px 5px; /* damit der container die höhe des großen bildes annimmt */
  /* andere formatierung, z.B. zentrieren/etc: */
  /* .... */
}

div.imageHold div {
  float: left;
  width: 320px;
  height: 74px;
  /* ab hier kann man die abstände
  und sonstiges der bilder eintragen */
  margin-left: 0px;
}

div.imageHold img {
	border: 1px solid #666666;
  width: 320px;  /* wir skalieren das große bild auf die kleine größe */
  height: 74px; /* um verpixelung beim vergößern zu verhindern       */
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


<div class="panel panel-default">
            <div class="panel-heading">
                            <i class="fa fa-puzzle-piece" aria-hidden="true"></i> Plugin Installer</div>
                        <div class="panel-body">
<?php
/** ZENITH.Developments | GETSCHONNIK **/


if(!empty(@$_GET['deinstall'] == "plugin"))
   { 
  
  $dir = $_GET['dir'];
  $name = str_replace("/", "", $dir);
  require_once('../includes/plugins'. $dir.'uninstall.php');
  recursiveRemoveDirectory('../includes/plugins'. $dir); 
  header('Location: ?site=plugin-installer');
  exit;
   }

$_language->readModule('plugin_installer', false, true);


function curl_json2array($url){
$ssl = 0;
if (substr($url, 0, 7) == "http://") { $ssl=0; } else { $ssl=1;}	
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, $ssl);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, $ssl);
$output = curl_exec($ch);
curl_close($ch);
return json_decode($output, true);
}
if(!empty($_GET['do'])) {
	$dir = $_GET['dir'];
	$dir = str_replace('/','',$dir);
	$plugin = 'http://t-seven.noip.me/plugin-base/';
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
							echo "File created: ".$file."<br />";
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
							echo "File created: ".$file."<br />";
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
							echo "File created: ".$file."<br />";
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
							echo "File created: ".$file."<br />";
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
							echo "File created: ".$file."<br />";
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
							echo "File created: ".$file."<br />";
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
			$files = @count($result['items'][$index])-1;		// @ -> deactivate error if no js necessary
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
							echo "File created: ".$file."<br />";
						} CATCH(Exception $f) {
							echo $f->message();
						}
					} CATCH(Exception $s) {
						echo $s->message();
					}
				}
			} 		

			if(file_exists('../includes/plugins/'.$dir.'/install.php')) {
				include('../includes/plugins/'.$dir.'/install.php'); 
			} else { 
				echo "<br />No installation file found";
			}
			
		}
	} CATCH (Exception $e) {
		echo $e->message();
	}
	echo "<br /><br /><h4>Installation Done</h4><br /><br />";
return false;	
}


//show all
try {
	$url = 'http://t-seven.noip.me/plugin-base/list.json';
	$result = curl_json2array($url);
	$anz = (count($result)-1);
	$output = "";
	$input = "";
	$install_datei ="";


	 for($plug=1; $plug<=$anz; $plug++) {

			$translate = new multiLanguage(detectCurrentLanguage());
            $translate->detectLanguages($result['item'.$plug]['description_de']);
            $result['item'.$plug]['description_de'] = $translate->getTextByLanguage($result['item'.$plug]['description_de']);


            $result['item'.$plug]['description_de'] = toggle(htmloutput($result['item'.$plug]['description_de']), 1);
            $result['item'.$plug]['description_de'] = toggle($result['item'.$plug]['description_de'], 1);

        	$output .= '  <tr>';
		$output .= '<th><img src="http://t-seven.noip.me/plugin-base'.$result['item'.$plug]['path'].$result['item'.$plug]['preview'].'" class="img-plugin-picture" alt="{img}" /></th>';
		$output .= '<th><strong>'.$result['item'.$plug]['name'].'</strong><br /><small class="fontLight">'.$result['item'.$plug]['description_de'].'<br />by '.$result['item'.$plug]['author'].'</small></th>';
		$output .= '<th><small class="fontLight">Plugin Ver. <span class="label label-success">'.$result['item'.$plug]['version_final'].'</span><span class="label label-warning">'.$result['item'.$plug]['version_beta'].'</span><span class="label label-danger">'.$result['item'.$plug]['version_test'].'</span><br />Req: webSpell | RM: <b>'.$result['item'.$plug]['req'].'</b><br />Language: '.$result['item'.$plug]['languages'].'<br />Update: <b>'.$result['item'.$plug]['update'].'</b></small></th>';
		
		include("../system/version.php");
			if(is_dir("../includes/plugins/".$result['item'.$plug]['path'])) {
				$output .= '<th>


<button class="btn btn-danger" style="width: 150px" data-href="?site=plugin-installer&deinstall=plugin&dir='.$result['item'.$plug]['path'].'" data-toggle="modal" data-target="#confirm-delete">
    				' . $_language->module['plugin_deinstallieren'] . '</button></th>
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
               <h4 class="modal-title" id="modalLabel">' . $_language->module['plugin_deinstallieren'] . '</h4>
            </div>
            <div class="modal-body">
               <p>' . $_language->module['delete_info'] . '</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok">' . $_language->module['plugin_deinstallieren'] . '</a>
            </div>
        </div>
    </div>
</div>';
				
				
				
			} else {
				if($result['item'.$plug]['req']==$version) {
					$output .= '<th><a class="btn btn-success" style="width: 150px" href="?site=plugin-installer&do=install&dir='.$result['item'.$plug]['path'].'">' . $_language->module['installation'] . '</a></th>';
					$output .= '  </tr>';
				} else {
					$output.= '<th><button class="btn btn-warning" style="width: 150px">' . $_language->module['incompatible'] . '</button></th>';
					$output .= '  </tr>';
				}

		} 

		
	

}	


} CATCH(Exception $e) {
	echo $e->message(); return false;
}

$_language->readModule('plugin-installer');
$_language->readModule('plugin-installer', false, true);
?>
<div class="title-block">
                        <p class="title-description"><?php echo $_language->module['info']; ?></p>
</div>
<i class="fa fa-puzzle-piece" aria-hidden="true"></i> <?php echo $_language->module['all_plugins']; ?> &nbsp; (<?php echo $anz; ?>)</strong><br><br>

<!-- END -->

<!-- plugin-installer_content -->

   
<table id="plugini" class="table table-bordered table-striped dataTable">
        <thead>
            <tr>
                <th style="width: 22%"><b><?php echo $_language->module['preview']; ?></b></th>
                <th style="width: 49%"><b><?php echo $_language->module['description']; ?></b></th>
                <th style="width: 14%"><b><?php echo $_language->module['version']; ?></b></th>
                <th><b><?php echo $_language->module['options']; ?></b></th>
            </tr>
        </thead>
        <tbody>
           <?=$output?>
        <tfoot>
            <tr>
                 <th style="width: 22%"><b><?php echo $_language->module['preview']; ?></b></th>
                <th style="width: 49%"><b><?php echo $_language->module['description']; ?></b></th>
                <th style="width: 14%"><b><?php echo $_language->module['version']; ?></b></th>
                <th><b><?php echo $_language->module['options']; ?></b></th>
            </tr>
        </tfoot>
    </table>



</div></div>



