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
 * @copyright       2018-2023 by webspell-rm.de                                                              *
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

class plugin_manager {
	var $_debug;
	
	//@debug 		if debug mode ON show failure messages otherwise hide this
	function set_debug($var) {
		$this->_debug = $var;
	}
	
	//@info 		check if a plugin index-link file exists that i can called by
	//				index.php?site=xxx
	function is_plugin($var) {
		try { 
			$query = safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE `activate`='1' AND `index_link` LIKE '%".$var."%'");
			if(mysqli_num_rows($query)) {	
				return 1;
			} else {
				return 0;
			}
		} CATCH (EXCPETION $e) {
			return $e->message();
		}
	}
	
	//@info 		get the plugin data from database
	function plugin_data($var, $id=0, $admin=false) {
		if($id>0) {
			$where = " WHERE `activate`='1' AND `pluginID`='".intval($id)."'";	
			$query = safe_query("SELECT * FROM " . PREFIX . "settings_plugins ".$where);
		} else {
			if($admin) {
				$where = " WHERE `activate`='1' AND `admin_file` LIKE '%".$var."%'";
			} else {
				$where = " WHERE `activate`='1' AND `index_link` LIKE '%".$var."%'";
			}
			$q = safe_query("SELECT * FROM " . PREFIX . "settings_plugins ".$where);
			if(mysqli_num_rows($q)) {
				$tmp = mysqli_fetch_array($q);
				$ifiles = $tmp['index_link'];
				$tfiles = explode(",",$ifiles);
				if(in_array($var, $tfiles)) {

					$ergebnis = safe_query("SELECT * FROM `" . PREFIX . "settings_plugins` WHERE `activate`='1' AND `index_link` LIKE '%".$var."%'");
					$dx = mysqli_fetch_array($ergebnis);

					$themeergebnis = safe_query("SELECT * FROM " . PREFIX . "settings_themes WHERE active = '1'");
					$db = mysqli_fetch_array($themeergebnis);

					$dm = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_module WHERE modulname = '".$dx['modulname']."' and themes_modulname = '".$db['modulname']."'"));

					if (@$dm[ 'modulname' ] != $dx['modulname'] && @$dm['themes_modulname'] != $db['modulname'])  {

						$where = " WHERE `activate`='0' AND `pluginID`='".$tmp['pluginID']."'";	
						$query = safe_query("SELECT * FROM " . PREFIX . "settings_plugins ".$where);   	
					}else{
		
						$where = " WHERE `activate`='1' AND `pluginID`='".$tmp['pluginID']."'";	
						$query = safe_query("SELECT * FROM " . PREFIX . "settings_plugins ".$where);
					}
				}
			}
			$w = safe_query("SELECT * FROM " . PREFIX . "settings_plugins ".$where);
			if(mysqli_num_rows($w)) {
				$tmp = mysqli_fetch_array($w);
				$afiles = $tmp['admin_file'];
				$bfiles = explode(",",$afiles);
				if(in_array($var, $bfiles)) {
					$where = " WHERE `activate`='1' AND `pluginID`='".$tmp['pluginID']."'";	
					$query = safe_query("SELECT * FROM " . PREFIX . "settings_plugins ".$where);
				}
			}


		}
		if(!isset($query)) { return false; }
		try {
			if(mysqli_num_rows($query)) {
				$row = mysqli_fetch_array($query);
				return $row;
			}
		} CATCH (EXCEPTION $e) {
			return $e->message();	
		}
	}

	
	function plugin_check($data, $site) {
		$_language = new \webspell\Language;
		$_language->readModule('plugin');
		$return = array();
                whouseronline();
		if(isset($data['activate'])==1) {
			if(isset($site)) {
				$ifiles = $data['index_link'];
				$tfiles = explode(",",$ifiles);
				if(in_array($site, $tfiles)) {
					if(file_exists($data['path'].$site.".php")) {
						$plugin_path = $data['path'];
						$return['status']=1;
						$return['data']=$data['path'].$site.".php";
						return $return;
					} else { 
						if(DEBUG==="ON") {
							echo '<!-- <br /><span class="label label-danger">'.$_language->module[ 'plugin_not_found' ].'</span> -->';		
						}
						if (!file_exists(MODULE.$site . ".php")) {
                        $site = "404";
                    }
                    	$return['status']=1;
						$return['data']=MODULE.$site . ".php";
						return $return;
					}	
				}
			} else {
				if(file_exists($data['path'].$data['index_link'].".php")) {
					$plugin_path = $data['path'];
					$return['status']=1;
					$return['data']=$data['path'].$data['index_link'].".php";
					return $return;
				} else { 
					if(DEBUG==="ON") {
						return '<!-- <br /><span class="label label-danger">'.$_language->module[ 'plugin_not_found' ].'</span> -->';		
					}
					if (!file_exists(MODULE.$site . ".php")) {
                        $site = "404";
                    }
                    $return['status']=1;
					$return['data']= MODULE.$site.".php";
					return $return;	
					}
				}
			} else {
				if(DEBUG==="ON") {
					echo ('<!-- <br /><span class="label label-warning">'.$_language->module[ 'plugin_deactivated' ].'</span> -->');
				}
				if (!file_exists(MODULE.$site . ".php")) {
                        $site = "404";
                }
                $return['status']=1;
				$return['data']= MODULE.$site.".php";
				return $return;	
			}	
		}
	


	//@info 		check if the plugin is activated and exists. 
	//				True = include the sc_file from plugin directory
	//				False = dont load this plugin
	function plugin_widget1($id, $name=false) {
		$pid = intval($id);
		$_language = new \webspell\Language;
		$_language->readModule('plugin');
		if (!empty($pid)) {
			$manager = new plugin_manager();
			$row=$manager->plugin_data("", $pid);
			
			if (@$row['activate'] != "1") {
				if($this->_debug==="ON") {
					return ('');
    			}
				return false;
			}
			if(file_exists($row['path'].$row['widget_link1'].".php")) {
				$plugin_path = $row['path'];
				require($row['path'].$row['widget_link1'].".php");
				return false;
			} else { 
				if($this->_debug==="ON") {
					return ('<span class="label label-danger">'.$_language->module['plugin_not_found'].'</span>');
				}
			}
		}	
	}

	function plugin_widget2($id, $name=false) {
		$pid = intval($id);
		$_language = new \webspell\Language;
		$_language->readModule('plugin');
		if (!empty($pid)) {
			$manager = new plugin_manager();
			$row=$manager->plugin_data("", $pid);
			
			if (@$row['activate'] != "1") {
				if($this->_debug==="ON") {
					return ('');
    			}
				return false;
			}
			if(file_exists($row['path'].$row['widget_link2'].".php")) {
				$plugin_path = $row['path'];
				require($row['path'].$row['widget_link2'].".php");
				return false;
			} else { 
				if($this->_debug==="ON") {
					return ('<span class="label label-danger">'.$_language->module['plugin_not_found'].'</span>');
				}
			}
		}	
	}

	function plugin_widget3($id, $name=false) {
		$pid = intval($id);
		$_language = new \webspell\Language;
		$_language->readModule('plugin');
		if (!empty($pid)) {
			$manager = new plugin_manager();
			$row=$manager->plugin_data("", $pid);
			
			if (@$row['activate'] != "1") {
				if($this->_debug==="ON") {
					return ('');
    			}
				return false;
			}
			if(file_exists($row['path'].$row['widget_link3'].".php")) {
				$plugin_path = $row['path'];
				require($row['path'].$row['widget_link3'].".php");
				return false;
			} else { 
				if($this->_debug==="ON") {
					return ('<span class="label label-danger">'.$_language->module['plugin_not_found'].'</span>');
				}
			}
		}	
	}
	
	//@info		search a plugin by name and return the ID
	function pluginID_by_name($name) {
		$request=safe_query("SELECT * FROM `" . PREFIX . "settings_plugins` WHERE `activate`='1' AND `name` LIKE '%".$name."%'");
		if(mysqli_num_rows($request)) {
			$tmp=mysqli_fetch_array($request);
			return $tmp['pluginID'];
		}
		return 0;
	}
	
	//@info		include a file which saved in hiddenfiles
	function plugin_hf($id, $name) {
		$pid = intval($id);
		$_language = new \webspell\Language;
		$_language->readModule('plugin');
		if (!empty($pid) AND !empty($name)) {
			$manager = new plugin_manager();
			$row=$manager->plugin_data("", $pid);
			$hfiles = $row['hiddenfiles'];
			$tfiles = explode(",",$hfiles);
			if(in_array($name, $tfiles)) {
				if(file_exists($row['path'].$name.".php")) {
					$plugin_path = $row['path'];
					require_once($row['path'].$name.".php");
					return false;
				} else { 
					if($this->_debug==="ON") {
						return ('<span class="label label-danger">'.$_language->module['plugin_not_found'].'</span>');
					}
				} 
			} 
		}		
	}
	
	//@info 		get the plugin directories from database and check 
	//				if in any plugin (direct) or in the subfolders (css & js)
	//				are file which must load into the <head> Tag
	function plugin_loadheadfile_css($pluginadmin=false) {
    parse_str($_SERVER['QUERY_STRING'], $qs_arr);
    $getsite = '';
    if(isset($qs_arr['site'])) {
      $getsite = $qs_arr['site'];
    }

    $css="\n";
		$query = safe_query("SELECT * FROM `" . PREFIX . "settings_plugins` WHERE `activate`='1' ");
    if($pluginadmin) { $pluginpath = "../"; } else { $pluginpath=""; }
		
    while($res=mysqli_fetch_array($query)) {
	  	$res2 = mysqli_num_rows(safe_query("SELECT * FROM `" . PREFIX . "settings_plugins` WHERE `modulname` = '".$res['modulname']."'"));

			$themeergebnis = safe_query("SELECT * FROM `" . PREFIX . "settings_themes` WHERE active = '1'");
      $db = mysqli_fetch_array($themeergebnis);

      $ergebnis = safe_query("SELECT * FROM `" . PREFIX . "settings_module` WHERE modulname = '".$res['modulname']."' and themes_modulname='".$db['modulname']."'");
      $dx = mysqli_fetch_array($ergebnis);

			if(@$dx['activate'] == 1) {

	      if($res['modulname'] == $getsite || $res2 == 1) {
	       	if(is_dir($pluginpath.$res['path']."css/")) { $subf1 = "css/"; } else { $subf1=""; }
	        $f = array();
	        $f = glob(preg_replace('/(\*|\?|\[)/', '[$1]', $pluginpath.$res['path'].$subf1).'*.css');
	        $fc = count((array($f)), COUNT_RECURSIVE);
	        if($fc>0) {
	         	for($b=0; $b<=$fc-2; $b++) {
	           	$css .= '<link type="text/css" rel="stylesheet" href="./'.$f[$b].'" />'.chr(0x0D).chr(0x0A);
	         	}
					}
				}
			}
		}
	  return $css;
	}

	function plugin_loadheadfile_js($pluginadmin=false) {
    parse_str($_SERVER['QUERY_STRING'], $qs_arr);
    $getsite = '';
    if(isset($qs_arr['site'])) {
      $getsite = $qs_arr['site'];
    }

    $js="\n";
    $query = safe_query("SELECT * FROM `" . PREFIX . "settings_plugins` WHERE `activate`='1' ");
    if($pluginadmin) { $pluginpath = "../"; } else { $pluginpath=""; }
		
    while($res=mysqli_fetch_array($query)) {
      $res2 = mysqli_num_rows(safe_query("SELECT * FROM `" . PREFIX . "settings_plugins` WHERE `modulname` = '".$res['modulname']."'"));

      $themeergebnis = safe_query("SELECT * FROM `" . PREFIX . "settings_themes` WHERE active = '1'");
      $db = mysqli_fetch_array($themeergebnis);

      $ergebnis = safe_query("SELECT * FROM `" . PREFIX . "settings_module` WHERE modulname = '".$res['modulname']."' and themes_modulname='".$db['modulname']."' and `activate` = '1'");
      $dx = mysqli_fetch_array($ergebnis);

			if(@$dx['activate'] == 1) {

        if($res['modulname'] == $getsite || $res2 == 1) {
         	if(is_dir($pluginpath.$res['path']."js/")) { $subf2 = "js/"; } else { $subf2=""; }
          $f = array();
          $f = glob(preg_replace('/(\*|\?|\[)/', '[$1]', $pluginpath.$res['path'].$subf2).'*.js');
          $fc = count((array($f)), COUNT_RECURSIVE);
         	if($fc>0) {
           	for($b=0; $b<=$fc-2; $b++) {
             	$js .= '<script defer src="./'.$f[$b].'"></script>'.chr(0x0D).chr(0x0A);
           	}
	  			}
	  		}
			} 
		}
	  return $js;
	}
	
	//@info		get the page default language and check if the user / guests
	//			change into his own language otherwise set default language to EN
	//@name		set the name of the language file to load
	/* CALL IT 
				/!\ NEVER use the variable $_language (conflict with the main module)
	
		$pm = new plugin_manager(); 
		$_lang = $pm->plugin_language("my-plugin", $plugin_path);
	
	*/
	function plugin_language($name, $plugin_path) {
		$res = safe_query("SELECT `default_language` FROM `".PREFIX."settings` WHERE 1");
		$row = mysqli_fetch_array($res);
		if(isset($_SESSION[ 'language' ])) { $lng=$_SESSION[ 'language' ]; } elseif(isset($_SESSION[ 'language' ])) { $lng=$_SESSION[ 'language' ];} 
		else { if(isset($row['default_language'])) { $lng=$row['default_language']; } else { $lng="en"; } }
		$_lang = new webspell\Language();
		$_lang->setLanguage($lng, false);
		$_lang->readModule($name, true, false, $plugin_path);
		return $_lang->module;
	}
	function plugin_adminLanguage($plugin, $file, $admin=false) {
		try {
					$res = safe_query("SELECT `default_language` FROM `".PREFIX."settings` WHERE 1");
					$row = mysqli_fetch_array($res);
					if(isset($_SESSION[ 'language' ])) { $lng=$_SESSION[ 'language' ]; } elseif(isset($_SESSION[ 'language' ])) { $lng=$_SESSION[ 'language' ];
					} else { 
						if(isset($row['default_language'])) { $lng=$row['default_language']; } else { $lng="en"; }
					}
			$p = "./".$file."";
			if(isset($admin)) { $admin = "admin"; } else { $admin = ""; }
			$arr =array(); 
			include("$p/languages/$lng/$admin/$plugin.php");
			foreach ($language_array as $key => $val) {
                $arr[ $key ] = $val;
            }
			return $arr;
		} CATCH (EXCEPTION $ex) {
			return $ex->message();
		}
	}
	
	//@info		update website title for SEO
	function plugin_updatetitle($site) {
		try {
			$pm = new plugin_manager();
				if($pm->is_plugin($_GET['site'])==1) {
					$arr = $pm->plugin_data($_GET['site']);
					if(isset($arr['name'])) {
						return settitle($arr['name']);
					}
				}
			} CATCH (EXCEPTION $x) {
				if($this->_debug==="ON") {
					return ('<span class="label label-danger">'.$x->message().'</span>');
				}
			}
		}
	}

#######################################################################################################################################

// Löscht in der Mysqli Datenbank eine Definierte Tabelle
function table_exist($table){ 
  safe_query("DROP TABLE IF EXISTS`" . PREFIX . "$table`");   // Tabelle Löschen
} 


// Loescht in der Mysqli Datenbank eine Definierte Spalte
function DeleteData($name,$where,$data) {
  if (mysqli_num_rows(safe_query("SELECT * FROM `" . PREFIX . "$name` WHERE $where='".$data."'")) >= 1 ) { 
    safe_query("DELETE FROM `" . PREFIX . "$name` WHERE $where = '$data'");    // Tabelle Loeschen
  } else {
    #echo "Keine Spalte vorhanden mit den Namen $name."; // Meldung soll nicht angezeigt werden
    echo "";
  }
}

// Loescht in der Mysqli Datenbank eine Definierte Spalte
function DeleteThemeData($name,$where,$data,$theme,$themedate) {
  if (mysqli_num_rows(safe_query("SELECT * FROM `" . PREFIX . "$name` WHERE $where='".$data."' AND $theme='".$themedate."'")) >= 1 ) { 
    safe_query("DELETE FROM `" . PREFIX . "$name` WHERE $where = '$data' AND $theme='$themedate'");    // Tabelle Loeschen
  } else {
    #echo "Keine Spalte vorhanden mit den Namen $name."; // Meldung soll nicht angezeigt werden
    echo "";
  }
}

// Loescht die Mysqli Datenbank xyz
function DeleteTable($table) {
  global $_database;
	if (safe_query("DROP TABLE IF EXISTS`" . PREFIX . "$table`")) {
	  //echo "<div class='alert alert-success'>String ausgef&uuml;hrt! <br />";
	  //return true;
	} else {
	  echo "<div class='alert alert-danger'>String failed <br />";
	  echo "String ausf&uuml;hren fehlgeschlagen!<br /></div>";
	  return "<pre>DROP TABLE IF EXISTS `" . PREFIX . "".$table."</pre>";
	  //return 'false';
	}
}

// Umbenennen der Mysqli Datenbank muss weiter getestet werden


// Umbenennen der Mysqli Datenbank muss weiter getestet werden END

# Einträge in Datenbank settings_module
function get_add_module_install () {

		global $userID, $_database,$add_module_install, $str, $modulname, $head_activated, $content_head_activated, $content_foot_activated, $head_section_activated, $foot_section_activated, $modul_display, $full_activated, $plugin_settings, $plugin_module, $plugin_widget, $widget1, $widget2, $widget3;

		add_module_install($add_module_install = "INSERT IGNORE INTO `".PREFIX."settings_module` (`pluginID`, `name`, `modulname`, `themes_modulname`, `activate`, `sidebar`, `head_activated`, `content_head_activated`, `content_foot_activated`, `head_section_activated`, `foot_section_activated`, `modul_display`, `full_activated`, `plugin_settings`, `plugin_module`, `plugin_widget`, `widget1`, `widget2`, `widget3`) VALUES ('', '$str', '$modulname', 'default', '1', 'activated', '$head_activated', '$content_head_activated', '$content_foot_activated', '$head_section_activated', '$foot_section_activated', '$modul_display', '$full_activated', '$plugin_settings', '$plugin_module', '$plugin_widget', '$widget1', '$widget2', '$widget3')");

}
function add_module_install() {
    global $_database,$add_module_install,$str,$themes_modulname,$modulname;

    		$translate = new multiLanguage(detectCurrentLanguage());
        $translate->detectLanguages($str);
        $str = $translate->getTextByLanguage($str);

        if(mysqli_num_rows(safe_query("SELECT * FROM `" . PREFIX . "settings_module` WHERE modulname ='".$modulname."' AND themes_modulname ='".$themes_modulname."'"))>0) {
                echo "<div class='alert alert-warning'><b>Moduleinträge:</b><br>".$str." Database entry already exists <br />";
                echo "".$str." Datenbank Eintrag in <b>settings_module</b> Datenbank schon vorhanden <br />";
				echo "".$str." La voce <b>settings_module</b> sono già presenti nel database<br /></div>";
                echo "<hr>";
        } else {
            try {
            if(mysqli_query($_database, $add_module_install)) { 
                echo "<div class='alert alert-success'><b>Moduleinträge:</b><br>Entries for ".$str." have been successfully added to the <b>settings_module</b> database <br />";
                echo "Einträge für ".$str." wurden der <b>settings_module</b> Datenbank erfolgreich hinzugef&uuml;gt<br />";
				echo "Le voci relative a ".$str." sono state aggiunte con successo al database <b>settings_module</b><br /></div>";
                echo "<hr>";
            } else {
                echo "<div class='alert alert-warning'>Database ".$str." entry already exists <br />";
                echo "Datenbank ".$str." Eintrag in <b>settings_module</b> Datenbank schon vorhanden <br />";
				echo "La voce ".$str." <b>settings_module</b> esiste già nel Database<br /></div>";
                echo "<hr>";
            }   
        } CATCH (EXCEPTION $x) {
                echo "<div class='alert alert-danger'><b>Moduleinträge:</b><br>Database ".$str." installation failed <br />";
                echo "Send the following line to the support team:<br />";
				echo "Invia la seguente riga al team di supporto:<br /><br /><br />";
                echo "<pre>".$x->message()."</pre>      
                      </div>";
            }
        }
}

# Einträge in Datenbank settings_themes
function add_theme_install() {
    global $_database,$add_theme_install,$str,$modulname;

    		$translate = new multiLanguage(detectCurrentLanguage());
        $translate->detectLanguages($str);
        $str = $translate->getTextByLanguage($str);

        if(mysqli_num_rows(safe_query("SELECT modulname FROM `" . PREFIX . "settings_themes` WHERE modulname ='".$modulname."'"))>0) {
                echo "<div class='alert alert-warning'><b>Themeeinträge:</b><br>".$str." Database entry already exists <br />";
                echo "".$str." Datenbank Eintrag schon vorhanden <br />";
				echo "".$str." La voce esiste già nel database <br /></div>";
                echo "<hr>";
        } else {
            try {
            if(mysqli_query($_database, $add_theme_install)) { 
                echo "<div class='alert alert-success'><b>Themeeinträge:</b><br>Entries for ".$str." have been successfully added to the <b>settings_themes</b> database <br />";
                echo "Einträge für ".$str." wurden der <b>settings_themes</b> Datenbank erfolgreich hinzugef&uuml;gt<br />";
				echo "Le voci per ".$str." sono stati aggiunti con successo al database <b>settings_themes</b><br /></div>";
                echo "<hr>";
            } else {
                echo "<div class='alert alert-warning'>Database ".$str." entry already exists <br />";
                echo "Datenbank ".$str." Eintrag schon vorhanden <br />";
				echo "Database ".$str." La voce esiste già <br /></div>";
                echo "<hr>";
            }   
        } CATCH (EXCEPTION $x) {
                echo "<div class='alert alert-danger'><b>Themeeinträge:</b><br>Database ".$str." installation failed <br />";
                echo "Send the following line to the support team:<br />";
				echo "Invia la seguente riga al team di supporto:<br /><br /><br />";
                echo "<pre>".$x->message()."</pre>      
                      </div>";
            }
        }
}

# Einträge in Datenbank settings_buttons
function add_button_install() {
    global $_database,$add_button_install,$str,$modulname;

    		$translate = new multiLanguage(detectCurrentLanguage());
        $translate->detectLanguages($str);
        $str = $translate->getTextByLanguage($str);

        if(mysqli_num_rows(safe_query("SELECT modulname FROM `" . PREFIX . "settings_buttons` WHERE modulname ='".$modulname."'"))>0) {
                echo "<div class='alert alert-warning'><b>Buttoneinträge:</b><br>".$str." Database entry already exists <br />";
                echo "".$str." Datenbank Eintrag schon vorhanden <br />";
				echo "".$str." La voce esiste già nel database <br /></div>";
                echo "<hr>";
        } else {
            try {
            if(mysqli_query($_database, $add_button_install)) { 
                echo "<div class='alert alert-success'><b>Buttoneinträge:</b><br>Entries for ".$str." have been successfully added to the <b>settings_buttons</b> database <br />";
                echo "Einträge für ".$str." wurden der <b>settings_buttons</b> Datenbank erfolgreich hinzugef&uuml;gt<br />";
				echo "Le voci per ".$str." sono stati aggiunti con successo al database <b>settings_buttons</b><br /></div>";
                echo "<hr>";
            } else {
                echo "<div class='alert alert-warning'>Database ".$str." entry already exists <br />";
                echo "Datenbank ".$str." Eintrag schon vorhanden <br />";
				echo "Database ".$str." La voce esiste già <br /></div>";
                echo "<hr>";
            }   
        } CATCH (EXCEPTION $x) {
                echo "<div class='alert alert-danger'><b>Buttoneinträge:</b><br>Database ".$str." installation failed <br />";
                echo "Send the following line to the support team:<br />";
				echo "Invia la seguente riga al team di supporto:<br /><br /><br />";
                echo "<pre>".$x->message()."</pre>      
                      </div>";
            }
        }
} 

# Einträge in Datenbank settings_widgets
function add_widget_install() {
    global $_database,$add_widget_install,$str,$themes_modulname;

    		$translate = new multiLanguage(detectCurrentLanguage());
        $translate->detectLanguages($str);
        $str = $translate->getTextByLanguage($str);

        if(mysqli_num_rows(safe_query("SELECT themes_modulname FROM `" . PREFIX . "settings_widgets` WHERE themes_modulname ='".$themes_modulname."'"))>0) {
                echo "<div class='alert alert-warning'><b>Widgeteinträge:</b><br>".$str." Database entry already exists <br />";
                echo "".$str." Datenbank Eintrag schon vorhanden <br />";
				echo "".$str." La voce del database esiste già <br /></div>";
                echo "<hr>";
        } else {
            try {
            if(mysqli_query($_database, $add_widget_install)) { 
                echo "<div class='alert alert-success'><b>Widgeteinträge:</b><br>Entries for ".$str." have been successfully added to the <b>settings_widgets</b> database <br />";
                echo "Einträge für ".$str." wurden der <b>settings_widgets</b> Datenbank erfolgreich hinzugef&uuml;gt<br />";
				echo "Le voci per ".$str." sono stati aggiunti con successo al database <b>settings_widget</b><br /></div>";
                echo "<hr>";
            } else {
                echo "<div class='alert alert-warning'>Database ".$str." entry already exists <br />";
                echo "Datenbank ".$str." Eintrag schon vorhanden <br />";
				echo "Database ".$str." La voce esiste già <br /></div>";
                echo "<hr>";
            }   
        } CATCH (EXCEPTION $x) {
                echo "<div class='alert alert-danger'><b>Widgeteinträge:</b><br>Database ".$str." installation failed <br />";
                echo "Send the following line to the support team:<br />";
				echo "Invia la seguente riga al team di supporto:<br /><br /><br />";
                echo "<pre>".$x->message()."</pre>      
                      </div>";
            }
        }
}  

# Einträge in Datenbank
function add_database_insert() {
    global $_database,$add_database_insert,$str,$modulname,$version;

    		$translate = new multiLanguage(detectCurrentLanguage());
        $translate->detectLanguages($str);
        $str = $translate->getTextByLanguage($str);

        if(mysqli_num_rows(safe_query("SELECT * FROM `" . PREFIX . "settings_plugins` WHERE modulname ='".$modulname."' AND version = '".$version."'"))>0) {
                echo "<div class='alert alert-warning'><b>Datenbankeinträge:</b><br><b>Database ".$str.":</b><br>".$str." Database entry already exists <br />";
                echo "Alle Einträge für die ".$str." Datenbank schon vorhanden <br />";
				echo "Tutte le voci per il database ".$str." esistono già <br /></div>";
                echo "<hr>";
        } else {
            try {
            if(mysqli_query($_database, $add_database_insert)) { 
                echo "<div class='alert alert-success'><b>Datenbankeinträge:</b><br>All entries for the plugin ".$str." have been successfully added to the database <br />";
                echo "Alle Einträge für das Plugin ".$str." wurden der Datenbank erfolgreich hinzugef&uuml;gt <br />";
				echo "Tutte le voci per il plugin ".$str." sono state aggiunte con successo al database <br /></div>";
                echo "<hr>";
            } else {
                echo "<div class='alert alert-warning'><b>Datenbankeinträge:</b><br>All entries for the plugin ".$str." already available <br />";
                echo "Alle Einträge für das Plugin ".$str." schon vorhanden <br />";
				echo "Tutte le voci per il plugin ".$str." esistono già <br /></div>";
                echo "<hr>";
            }   
        } CATCH (EXCEPTION $x) {
                echo "<div class='alert alert-danger'><b>Datenbankeinträge:</b><br>Database ".$str." installation failed <br />";
                echo "Send the following line to the support team:<br />";
				echo "Invia la seguente riga al team di supporto:<br /><br /><br />";
                echo "<pre>".$x->message()."</pre>      
                      </div>";
            }
        }
}

# Einträge in Datenbank
function add_database_install() {
    global $_database,$add_database_install,$str,$modulname,$version;

    		$translate = new multiLanguage(detectCurrentLanguage());
        $translate->detectLanguages($str);
        $str = $translate->getTextByLanguage($str);

        if(mysqli_num_rows(safe_query("SELECT * FROM `" . PREFIX . "settings_plugins` WHERE modulname ='".$modulname."' AND version = '".$version."'"))>0) {
                echo "<div class='alert alert-warning'><b>Database ".$str.":</b><br>".$str." Database entry already exists <br />";
                echo "".$str." Datenbank Eintrag schon vorhanden <br />";
				echo "".$str." La voce del database esiste già <br /></div>";
                echo "<hr>";
        } else {
            try {
            if(mysqli_query($_database, $add_database_install)) { 
                echo "<div class='alert alert-success'><b>Database ".$str.":</b><br>All database entries for the plugin ".$str." have been successfully installed <br />";
                echo "Alle Datenbankeinträge für das Plugin ".$str." wurden  erfolgreich installiert <br />";
				echo "Tutte le voci del database per il plugin ".$str." sono state installate con successo <br /></div>";
                echo "<hr>";
            } else {
                echo "<div class='alert alert-warning'><b>Database ".$str.":</b><br>Database ".$str." entry already exists <br />";
                echo "Datenbank ".$str." Eintrag schon vorhanden <br />";
				echo "Database ".$str." La voce esiste già <br /></div>";
                echo "<hr>";
            }   
        } CATCH (EXCEPTION $x) {
                echo "<div class='alert alert-danger'><b>Database ".$str.":</b><br>Database ".$str." installation failed <br />";
                echo "Send the following line to the support team:<br />";
				echo "Invia la seguente riga al team di supporto:<br /><br /><br />";
                echo "<pre>".$x->message()."</pre>      
                      </div>";
            }
        }
}

# Add to Plugin-Manager
function get_add_plugin_manager () {

  	global $userID, $_database, $str, $modulname, $add_plugin_manager, $info, $admin_file, $activate, $author, $website, $index_link, $hiddenfiles, $version, $path, $widgetname1, $widgetname2, $widgetname3, $widget_link1, $widget_link2, $widget_link3, $modul_display;

		add_plugin_manager($add_plugin_manager = "INSERT IGNORE INTO `".PREFIX."settings_plugins` (`pluginID`, `name`, `modulname`, `info`, `admin_file`, `activate`, `author`, `website`, `index_link`, `hiddenfiles`, `version`, `path`, `widgetname1`, `widgetname2`, `widgetname3`, `widget_link1`, `widget_link2`, `widget_link3`, `modul_display`) VALUES ('', '$str', '$modulname', '$info', '$admin_file', '$activate', '$author', '$website', '$index_link', '$hiddenfiles', '$version', '$path', '$widgetname1', '$widgetname2', '$widgetname3', '$widget_link1', '$widget_link2', '$widget_link3', '$modul_display')");
}

function add_plugin_manager() {
    global $_database,$add_plugin_manager,$str,$modulname,$version;

    		$translate = new multiLanguage(detectCurrentLanguage());
        $translate->detectLanguages($str);
        $str = $translate->getTextByLanguage($str);

        if(mysqli_num_rows(safe_query("SELECT modulname,version FROM `" . PREFIX . "settings_plugins` WHERE modulname ='".$modulname."' AND version = '".$version."'"))>0) {
                    echo "<div class='alert alert-warning'><b>Plugin Manager:</b><br>".$str." Plugin Manager entry already exists <br />";
                    echo "".$str." Plugin Manager Eintrag schon vorhanden <br />";
					echo "".$str." La voce Plugin Manager esiste già <br /></div>";
                    echo "<hr>";
        } else {
            try {
                if(safe_query($add_plugin_manager)) { 
                    echo "<div class='alert alert-success'><b>Plugin Manager:</b><br>".$str." added to the plugin manager <br />";
                    echo "".$str." wurde dem Plugin Manager hinzugef&uuml;gt <br />";
					echo "".$str." è stato aggiunto al Gestore dei Plugin <br />";
                    echo "<a href = '/admin/admincenter.php?site=plugin_manager' target='_blank'><b>LINK => Plugin Manager</b></a></div>";
                } else {
                    echo "<div class='alert alert-danger'><b>Plugin Manager:</b><br>Add to plugin manager failed <br />";
                    echo "Zum Plugin Manager hinzuf&uuml;gen fehlgeschlagen <br />";
					echo "Aggiunta al Plugin Manager non riuscita <br /></div>";
                }   
            } CATCH (EXCEPTION $x) {
                    echo "<div class='alert alert-danger'><b>Plugin Manager:</b><br>".$str." installation failed <br />";
                    echo "Send the following line to the support team:<br />";
					echo "Invia la seguente riga al team di supporto:<br /><br /><br />";
                    echo "<pre>".$x->message()."</pre>      
                          </div>";
            }
        }
}

# Add to Plugin-Manager (wenn ein Plugin zwei Einträge benötigt)
function add_plugin_manager_two() {
    global $_database,$add_plugin_manager_two,$str_two,$modulname_two,$version;

    		$translate = new multiLanguage(detectCurrentLanguage());
        $translate->detectLanguages($str_two);
        $str = $translate->getTextByLanguage($str_two);

        if(mysqli_num_rows(safe_query("SELECT modulname,version FROM `" . PREFIX . "settings_plugins` WHERE modulname ='".$modulname_two."' AND version = '".$version."'"))>0) {
                    echo "<div class='alert alert-warning'><b>Plugin Manager:</b><br>".$str." Plugin Manager entry already exists <br />";
                    echo "".$str." Plugin Manager Eintrag schon vorhanden <br />";
					echo "".$str_two." La voce Plugin Manager esiste già <br /></div>";
                    echo "<hr>";
        } else {
            try {
                if(safe_query($add_plugin_manager_two)) { 
                    echo "<div class='alert alert-success'><b>Plugin Manager:</b><br>".$str." added to the plugin manager <br />";
                    echo "".$str_two." wurde dem Plugin Manager hinzugef&uuml;gt <br />";
					echo "".$str_two." è stato aggiunto al Gestore dei Plugin <br />";
                    echo "<a href = '/admin/admincenter.php?site=plugin_manager' target='_blank'><b>LINK => Plugin Manager</b></a></div>";
                } else {
                    echo "<div class='alert alert-danger'><b>Plugin Manager:</b><br>Add to plugin manager failed <br />";
                    echo "Zum Plugin Manager hinzuf&uuml;gen fehlgeschlagen <br />";
					echo "Aggiunta al Plugin Manager non riuscita <br /></div>";
                }   
            } CATCH (EXCEPTION $x) {
                    echo "<div class='alert alert-danger'><b>Plugin Manager:</b><br>".$str." installation failed <br />";
                    echo "Send the following line to the support team:<br />";
					echo "Invia la seguente riga al team di supporto:<br /><br /><br />";
                    echo "<pre>".$x->message()."</pre>      
                          </div>";
            }
        }
}

# Einträge in Datenbank navigation_website_sub
function get_add_navigation () {

		global $userID, $_database, $mnavID, $navi_name, $modulname, $add_navigation, $navi_link, $themes_modulname, $navi_cat_name;

		if ($mnavID=="1"){
		  $navi_cat_name = "{[de]}HAUPT{[en]}MAIN{[it]}PRINCIPALE";
		  $sort = '1';
		}elseif ($mnavID=="2"){
		  $navi_cat_name = "{[de]}TEAM{[en]}TEAM{[it]}TEAM";
		  $sort = '2';
		}elseif ($mnavID=="3"){
		  $navi_cat_name = "{[de]}GEMEINSCHAFT{[en]}COMMUNITY{[it]}COMMUNITY";
		  $sort = '3';
		}elseif ($mnavID=="4"){
		  $navi_cat_name = "{[de]}MEDIEN{[en]}MEDIA{[it]}MEDIA";
		  $sort = '4';
		}elseif ($mnavID=="5"){
		  $navi_cat_name = "{[de]}SOCIAL{[en]}SOCIAL[it]}SOCIAL";
		  $sort = '5';  
		}elseif ($mnavID=="6"){
		  $navi_cat_name = "{[de]}SONSTIGES{[en]}MISCELLANEOUS[it]}VARIE";
		  $sort = '6';
		}else{
		  $navi_cat_name = "mistake";
		  $sort = '7';
		}

		$dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "navigation_website_main WHERE mnavID=$mnavID"));
		if (@$dx[ 'mnavID' ] != $mnavID) {
		add_navigation($add_navigation = "INSERT INTO `".PREFIX."navigation_website_main` (`mnavID`, `name`, `url`, `default`, `sort`, `isdropdown`, `windows`) VALUES
		($mnavID, '$navi_cat_name', '#', 1, '$sort', 1, 1)");

		add_navigation($add_navigation = "INSERT IGNORE INTO `".PREFIX."navigation_website_sub` (`mnavID`, `name`, `modulname`, `url`, `sort`, `indropdown`, `themes_modulname`) 
		          VALUES ('$mnavID','$navi_name', '$modulname', 'index.php?site=$navi_link', '1', '1', '$themes_modulname')");

		} else {

		add_navigation($add_navigation = "INSERT IGNORE INTO `".PREFIX."navigation_website_sub` (`mnavID`, `name`, `modulname`, `url`, `sort`, `indropdown`, `themes_modulname`) 
		          VALUES ('$mnavID','$navi_name', '$modulname', 'index.php?site=$navi_link', '1', '1', '$themes_modulname')");
		}
}

function add_navigation() {
    global $_database,$add_navigation,$navi_link,$str,$modulname,$themes_modulname;

    		$translate = new multiLanguage(detectCurrentLanguage());
        $translate->detectLanguages($str);
        $str = $translate->getTextByLanguage($str);

        if(mysqli_num_rows(safe_query("SELECT * FROM `".PREFIX."navigation_website_sub` WHERE modulname ='".$modulname."' AND themes_modulname ='".$themes_modulname."'"))>0) {
                    echo "<div class='alert alert-warning'><b>Website Navigation:</b><br>".$str." Navigation entry already exists <br />";
                    echo "".$str." Navigationseintrag schon vorhanden <br />";
					echo "".$str." La voce di navigazione esiste già <br /></div>";
                    
        } else {
            try {
                if(safe_query($add_navigation)) { 
                    echo "<div class='alert alert-success'><b>Website Navigation:</b><br>".$str." added to the Website Navigation <br />";
                    echo "".$str." wurde der Website Navigation hinzugef&uuml;gt <br />";
					echo "".$str." è stato aggiunto alla navigazione del sito <br />";
                    echo "<a href = '/admin/admincenter.php?site=webside_navigation' target='_blank'><b>LINK => Website Navigation</b></a></div>";
                } else {
                    echo "<div class='alert alert-danger'><b>Website Navigation:</b><br>Add to Website Navigation failed <br />";
                    echo "Zur Website Navigation hinzuf&uuml;gen fehlgeschlagen<br />";
					echo "Aggiunta alla navigazione del sito non riuscita<br /></div>";
                }   
            } CATCH (EXCEPTION $x) {
                    echo "<div class='alert alert-danger'><b>Website Navigation:</b><br>".$str." installation failed <br />";
                    echo "Send the following line to the support team:<br />";
					echo "Invia la seguente riga al team di supporto:<br /><br /><br />";
                    echo "<pre>".$x->message()."</pre>      
                          </div>";
            }
        }
}

function get_add_two_navigation () {

		global $userID, $_database, $mnavID, $add_two_navigation,$two_navi_link,$str,$two_modulname,$themes_modulname,$two_navi_name,$modulname;

		if ($mnavID=="1"){
		  $navi_cat_name = "{[de]}HAUPT{[en]}MAIN{[it]}PRINCIPALE";
		  $sort = '1';
		}elseif ($mnavID=="2"){
		  $navi_cat_name = "{[de]}TEAM{[en]}TEAM{[it]}TEAM";
		  $sort = '2';
		}elseif ($mnavID=="3"){
		  $navi_cat_name = "{[de]}GEMEINSCHAFT{[en]}COMMUNITY{[it]}COMMUNITY";
		  $sort = '3';
		}elseif ($mnavID=="4"){
		  $navi_cat_name = "{[de]}MEDIEN{[en]}MEDIA{[it]}MEDIA";
		  $sort = '4';
		}elseif ($mnavID=="5"){
		  $navi_cat_name = "{[de]}SOCIAL{[en]}SOCIAL[it]}SOCIAL";
		  $sort = '5';  
		}elseif ($mnavID=="6"){
		  $navi_cat_name = "{[de]}SONSTIGES{[en]}MISCELLANEOUS[it]}VARIE";
		  $sort = '6';
		}else{
		  $navi_cat_name = "mistake";
		  $sort = '7';
		}

		$dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "navigation_website_main WHERE mnavID=$mnavID"));
		if (@$dx[ 'mnavID' ] != $mnavID) {
		add_navigation($add_navigation = "INSERT INTO `".PREFIX."navigation_website_main` (`mnavID`, `name`, `url`, `default`, `sort`, `isdropdown`, `windows`) VALUES
		($mnavID, '$navi_cat_name', '#', 1, '$sort', 1, 1)");

		add_navigation($add_navigation = "INSERT IGNORE INTO `".PREFIX."navigation_website_sub` (`mnavID`, `name`, `modulname`, `url`, `sort`, `indropdown`, `themes_modulname`) 
          VALUES ('1','$two_navi_name', '$two_modulname', 'index.php?site=$two_navi_link', '1', '1', '$themes_modulname')");

		} else {

		add_navigation($add_navigation = "INSERT IGNORE INTO `".PREFIX."navigation_website_sub` (`mnavID`, `name`, `modulname`, `url`, `sort`, `indropdown`, `themes_modulname`) 
          VALUES ('1','$two_navi_name', '$two_modulname', 'index.php?site=$two_navi_link', '1', '1', '$themes_modulname')");
		}
}

function add_two_navigation() {
    global $_database,$add_two_navigation,$two_navi_link,$str,$two_modulname,$themes_modulname,$two_navi_name,$modulname;

    		$translate = new multiLanguage(detectCurrentLanguage());
        $translate->detectLanguages($str);
        $str = $translate->getTextByLanguage($str);

        if(mysqli_num_rows(safe_query("SELECT * FROM `".PREFIX."navigation_website_sub` WHERE modulname ='".$two_modulname."' AND themes_modulname ='".$themes_modulname."'"))>0) {
                    echo "<div class='alert alert-warning'><b>Website Navigation 2:</b><br>".$str." Navigation entry already exists <br />";
                    echo "".$str." Navigationseintrag schon vorhanden <br />";
					echo "".$str." La voce di navigazione esiste già <br /></div>";
                    
        } else {
            try {
                if(safe_query($add_two_navigation)) { 
                    echo "<div class='alert alert-success'><b>Website Navigation 2:</b><br>".$str." added to the Website Navigation <br />";
                    echo "".$str." wurde der Website Navigation hinzugef&uuml;gt <br />";
					echo "".$str." è stato aggiunto alla Barra di Navigazione del sito <br />";
                    echo "<a href = '/admin/admincenter.php?site=webside_navigation' target='_blank'><b>LINK => Website Navigation</b></a></div>";
                } else {
                    echo "<div class='alert alert-danger'><b>Website Navigation 2:</b><br>Add to Website Navigation failed <br />";
                    echo "Zur Website Navigation hinzuf&uuml;gen fehlgeschlagen<br />";
					echo "Aggiunta alla Barra di Navigazione del sito non riuscita<br /></div>";
                }   
            } CATCH (EXCEPTION $x) {
                    echo "<div class='alert alert-danger'><b>Website Navigation 2:</b><br>".$str." installation failed <br />";
                    echo "Send the following line to the support team:<br />";
					echo "Invia la seguente riga al team di supporto:<br /><br /><br />";
                    echo "<pre>".$x->message()."</pre>      
                          </div>";
            }
        }
}
# Einträge in Datenbank navigation_dashboard_links
function get_add_dashboard_navigation () {

		global $userID, $_database, $catID, $navi_name, $modulname, $add_dashboard_navigation, $dashnavi_link;

		add_dashboard_navigation($add_dashboard_navigation = "INSERT INTO `".PREFIX."navigation_dashboard_links` (`catID`, `name`, `modulname`, `url`, `accesslevel`, `sort`) 
		          VALUES ('$catID','$navi_name', '$modulname', 'admincenter.php?site=$dashnavi_link', 'page', '1')");
}

# Einträge in Datenbank navigation_dashboard_links
function add_dashboard_navigation() {
       global $_database,$add_dashboard_navigation,$dashnavi_link,$str,$modulname;

       	$translate = new multiLanguage(detectCurrentLanguage());
        $translate->detectLanguages($str);
        $str = $translate->getTextByLanguage($str);

        if(mysqli_num_rows(safe_query("SELECT * FROM `".PREFIX."navigation_dashboard_links` WHERE modulname ='".$modulname."'"))>0) {
                    echo "<div class='alert alert-warning'><b>Dashboard Navigation:</b><br>".$str." Dashboard Navigation entry already exists <br />";
                    echo "".$str." Dashboard Navigationseintrag schon vorhanden <br />";
					echo "".$str." La voce di Navigazione della Dashboard esiste già <br /></div>";
                    
        } else {
            try {
                if(safe_query($add_dashboard_navigation)) { 
                    echo "<div class='alert alert-success'><b>Dashboard Navigation:</b><br>".$str." added to the Dashboard Navigation <br />";
                    echo "".$str." wurde der Dashboard Navigation hinzugef&uuml;gt <br />";
					echo "".$str." è stato aggiunto alla Navigazione della Dashboard <br />";
                    echo "<a href = '/admin/admincenter.php?site=dashboard_navigation' target='_blank'><b>LINK => Dashboard Navigation</b></a></div>";
                } else {
                    echo "<div class='alert alert-danger'><b>Dashboard Navigation:</b><br>Add to Dashboard Navigation failed <br />";
                    echo "Zur Dashboard Navigation hinzuf&uuml;gen fehlgeschlagen<br />";
					echo "Aggiunta alla Navigazione della Dashboard non riuscita<br /></div>";
                }   
            } CATCH (EXCEPTION $x) {
                    echo "<div class='alert alert-danger'><b>Dashboard Navigation:</b><br>".$str." installation failed <br />";
                    echo "Send the following line to the support team:<br />";
					echo "Invia la seguente riga al team di supporto:<br /><br /><br />";
                    echo "<pre>".$x->message()."</pre>      
                          </div>";
            }
        }
}

/*Plugins manuell einbinden 
get_widget('about_us','plugin_widget1'); #für das erste Plugin
get_widget('about_us','plugin_widget2'); #für das zweite Plugin
get_widget('about_us','plugin_widget3'); #für das dritte Plugin
*/
function get_widget($modulname, $widgetnummer) {
  $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='".$modulname."'"));
  if (@$dx[ 'modulname' ] != $modulname) {
    $test = '';
  } else {
    $test = $query = safe_query("SELECT pluginID FROM `".PREFIX."settings_plugins` WHERE modulname='".$modulname."'");
        	  $data_array = mysqli_fetch_array($query);
              if($data_array) { 
            		$plugin = new plugin_manager();
            		$plugin->set_debug(DEBUG);
            		echo $plugin->$widgetnummer($data_array['pluginID']);
          		}                    
  };
}


?>
