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

/**
 * Plugin-Manager 1.4
 * 
 * The Plugin-Manager can load plugins from a folder 
 * without overwrite the original file.
 * @author Matti 'Getschonnik' W. <info@Getschonnik.de>
 * @version: 1.3
 *
 * @modified: T-Seven | Webspell-RM.de
 * @version: 1.4
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
			$query = safe_query("SELECT * FROM ".PREFIX."plugins WHERE `activate`='1' AND `index_link` LIKE '%".$var."%'");
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
			$query = safe_query("SELECT * FROM ".PREFIX."plugins ".$where);
		} else {
			if($admin) {
				$where = " WHERE `activate`='1' AND `admin_file`='".$var."' LIMIT 3";
			} else {
				$where = " WHERE `activate`='1' AND `index_link` LIKE '%".$var."%'";
			}
			$q = safe_query("SELECT * FROM ".PREFIX."plugins ".$where);
			if(mysqli_num_rows($q)) {
				$tmp = mysqli_fetch_array($q);
				$ifiles = $tmp['index_link'];
				$tfiles = explode(",",$ifiles);
				if(in_array($var, $tfiles)) {
					$where = " WHERE `activate`='1' AND `pluginID`='".$tmp['pluginID']."'";	
					$query = safe_query("SELECT * FROM ".PREFIX."plugins ".$where);
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
					#return ('<span class="label label-warning">'.$_language->module['plugin_deactivated'].'</span>');
					return ('');
    			}
				return false;
			}
			if(file_exists($row['path'].$row['widget_link1'].".php")) {
				$plugin_path = $row['path'];
				#require_once($row['path'].$row['widget_link1'].".php");
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
					#return ('<span class="label label-warning">'.$_language->module['plugin_deactivated'].'</span>');
					return ('');
    			}
				return false;
			}
			if(file_exists($row['path'].$row['widget_link2'].".php")) {
				$plugin_path = $row['path'];
				#require_once($row['path'].$row['widget_link2'].".php");
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
					#return ('<span class="label label-warning">'.$_language->module['plugin_deactivated'].'</span>');
					return ('');
    			}
				return false;
			}
			if(file_exists($row['path'].$row['widget_link3'].".php")) {
				$plugin_path = $row['path'];
				#require_once($row['path'].$row['widget_link3'].".php");
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
		$request=safe_query("SELECT * FROM `".PREFIX."plugins` WHERE `activate`='1' AND `name` LIKE '%".$name."%'");
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
          $query = safe_query("SELECT * FROM `".PREFIX."plugins` WHERE `activate`='1' ");

        if($pluginadmin) { 
            $pluginpath = "../"; 
        } else { 
            $pluginpath=""; 
        }
	
        while($res=mysqli_fetch_array($query)) {
	    	$res2 = mysqli_num_rows(safe_query("SELECT * FROM ".PREFIX."plugins WHERE `modulname` = '$res[modulname]'"));
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
	  return $css;
	}

	function plugin_loadheadfile_js($pluginadmin=false) {
          parse_str($_SERVER['QUERY_STRING'], $qs_arr);
          $getsite = '';
          if(isset($qs_arr['site'])) {
            $getsite = $qs_arr['site'];
          }

          $js="\n";
          $query = safe_query("SELECT * FROM `".PREFIX."plugins` WHERE `activate`='1' ");
          if($pluginadmin) { $pluginpath = "../"; } else { $pluginpath=""; }
		
          while($res=mysqli_fetch_array($query)) {
            $res2 = mysqli_num_rows(safe_query("SELECT * FROM ".PREFIX."plugins WHERE `modulname` = '$res[modulname]'"));
            if($res['modulname'] == $getsite || $res2 == 1) {
             	if(is_dir($pluginpath.$res['path']."js/")) { $subf2 = "js/"; } else { $subf2=""; }
            	$f = array();
            	$f = glob(preg_replace('/(\*|\?|\[)/', '[$1]', $pluginpath.$res['path'].$subf2).'*.js');
            	$fc = count((array($f)), COUNT_RECURSIVE);
            		if($fc>0) {
                		for($b=0; $b<=$fc-2; $b++) {
                    	$js .= '<script src="./'.$f[$b].'"></script>'.chr(0x0D).chr(0x0A);
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


# if table exists
function add_database_install() {
    global $_database,$add_database_install,$str;
        if(mysqli_num_rows(safe_query("SELECT name FROM `".PREFIX."plugins` WHERE name ='".$str."'"))>0) {
                    echo "<div class='alert alert-warning'>".$str." Database entry already exists <br />";
                    echo "".$str." Datenbank Eintrag schon vorhanden <br /></div>";
                    echo "<hr>";
        } else {
            try {
            if(mysqli_query($_database, $add_database_install)) { 
                echo "<div class='alert alert-success'>Database ".$str." installation successful <br />";
                echo "Datenbank ".$str." installation erfolgreich <br /></div>";
            } else {
                    echo "<div class='alert alert-warning'>Database ".$str." entry already exists <br />";
                    echo "Datenbank ".$str." Eintrag schon vorhanden <br /></div>";
                    echo "<hr>";
            }   
        } CATCH (EXCEPTION $x) {
                echo "<div class='alert alert-danger'>Database ".$str." installation failed <br />";
                echo "Send the following line to the support team:<br /><br />";
                echo "<pre>".$x->message()."</pre>      
                      </div>";
            }
        }
}

# if table exists
function add_database_install_insert() {
    global $_database,$add_database_install_insert,$str;
        if(mysqli_num_rows(safe_query("SELECT name FROM `".PREFIX."plugins` WHERE name ='".$str."'"))>0) {
                    echo "<div class='alert alert-warning'>".$str." Database entry already exists <br />";
                    echo "".$str." Datenbank Eintrag schon vorhanden <br /></div>";
                    echo "<hr>";
        } else {
            try {
            if(mysqli_query($_database, $add_database_install)) { 
                echo "<div class='alert alert-success'>Database ".$str." installation successful <br />";
                echo "Datenbank ".$str." installation erfolgreich <br /></div>";
            } else {
                    echo "<div class='alert alert-warning'>Database ".$str." entry already exists <br />";
                    echo "Datenbank ".$str." Eintrag schon vorhanden <br /></div>";
                    echo "<hr>";
            }   
        } CATCH (EXCEPTION $x) {
                echo "<div class='alert alert-danger'>Database ".$str." installation failed <br />";
                echo "Send the following line to the support team:<br /><br />";
                echo "<pre>".$x->message()."</pre>      
                      </div>";
            }
        }
}
# Add to Plugin-Manager
function add_plugin_manager() {
    global $_database,$add_plugin_manager,$str;
        if(mysqli_num_rows(safe_query("SELECT name FROM `".PREFIX."plugins` WHERE name ='".$str."'"))>0) {
                    echo "<div class='alert alert-warning'>".$str." Plugin Manager entry already exists <br />";
                    echo "".$str." Plugin Manager Eintrag schon vorhanden <br /></div>";
                    echo "<hr>";
        } else {
            try {
                if(safe_query($add_plugin_manager)) { 
                    echo "<div class='alert alert-success'>".$str." added to the plugin manager <br />";
                    echo "".$str." wurde dem Plugin Manager hinzugef&uuml;gt <br />";
                    echo "<a href = '/admin/admincenter.php?site=plugin-manager' target='_blank'><b>LINK => Plugin Manager</b></a></div>";
                } else {
                    echo "<div class='alert alert-danger'>Add to plugin manager failed <br />";
                    echo "Zum Plugin Manager hinzuf&uuml;gen fehlgeschlagen <br /></div>";
                }   
            } CATCH (EXCEPTION $x) {
                    echo "<div class='alert alert-danger'>".$str." installation failed <br />";
                    echo "Send the following line to the support team:<br /><br />";
                    echo "<pre>".$x->message()."</pre>      
                          </div>";
            }
        }
}
# Add to Plugin-Manager (wenn ein Plugin zwei Einträge benötigt)
function add_plugin_manager_two() {
    global $_database,$add_plugin_manager_two,$str_two;
        if(mysqli_num_rows(safe_query("SELECT name FROM `".PREFIX."plugins` WHERE name ='".$str_two."'"))>0) {
                    echo "<div class='alert alert-warning'>".$str_two." Plugin Manager entry already exists <br />";
                    echo "".$str_two." Plugin Manager Eintrag schon vorhanden <br /></div>";
                    echo "<hr>";
        } else {
            try {
                if(safe_query($add_plugin_manager_two)) { 
                    echo "<div class='alert alert-success'>".$str_two." added to the plugin manager <br />";
                    echo "".$str_two." wurde dem Plugin Manager hinzugef&uuml;gt <br />";
                    echo "<a href = '/admin/admincenter.php?site=plugin-manager' target='_blank'><b>LINK => Plugin Manager</b></a></div>";
                } else {
                    echo "<div class='alert alert-danger'>Add to plugin manager failed <br />";
                    echo "Zum Plugin Manager hinzuf&uuml;gen fehlgeschlagen <br /></div>";
                }   
            } CATCH (EXCEPTION $x) {
                    echo "<div class='alert alert-danger'>".$str_two." installation failed <br />";
                    echo "Send the following line to the support team:<br /><br />";
                    echo "<pre>".$x->message()."</pre>      
                          </div>";
            }
        }
}
# Add to navigation
function add_navigation() {
    global $_database,$add_navigation,$navi_link,$str;
        if(mysqli_num_rows(safe_query("SELECT * FROM `".PREFIX."navigation_website_sub` WHERE `name`='$str' AND `url`='index.php?site=$navi_link'"))>0) {
                    echo "<div class='alert alert-warning'>".$str." Navigation entry already exists <br />";
                    echo "".$str." Navigationseintrag schon vorhanden <br /></div>";
                    
        } else {
            try {
                if(safe_query($add_navigation)) { 
                    echo "<div class='alert alert-success'>".$str." added to the Website Navigation <br />";
                    echo "".$str." wurde der Website Navigation hinzugef&uuml;gt <br />";
                    echo "<a href = '/admin/admincenter.php?site=webside_navigation' target='_blank'><b>LINK => Website Navigation</b></a></div>";
                } else {
                    echo "<div class='alert alert-danger'>Add to Website Navigation failed <br />";
                    echo "Zur Website Navigation hinzuf&uuml;gen fehlgeschlagen<br /></div>";
                }   
            } CATCH (EXCEPTION $x) {
                    echo "<div class='alert alert-danger'>".$str." installation failed <br />";
                    echo "Send the following line to the support team:<br /><br />";
                    echo "<pre>".$x->message()."</pre>      
                          </div>";
            }
        }
}
function add_dashboard_navigation() {
       global $_database,$add_dashboard_navigation,$dashnavi_link,$str;
        if(mysqli_num_rows(safe_query("SELECT * FROM `".PREFIX."navigation_dashboard_links` WHERE `name`='$str' AND `url`='admincenter.php?site=$dashnavi_link'"))>0) {
                    echo "<div class='alert alert-warning'>".$str." Dashboard Navigation entry already exists <br />";
                    echo "".$str." Dashboard Navigationseintrag schon vorhanden <br /></div>";
                    
        } else {
            try {
                if(safe_query($add_dashboard_navigation)) { 
                    echo "<div class='alert alert-success'>".$str." added to the Dashboard Navigation <br />";
                    echo "".$str." wurde der Dashboard Navigation hinzugef&uuml;gt <br />";
                    echo "<a href = '/admin/admincenter.php?site=dashnavi' target='_blank'><b>LINK => Dashboard Navigation</b></a></div>";
                } else {
                    echo "<div class='alert alert-danger'>Add to Dashboard Navigation failed <br />";
                    echo "Zur Dashboard Navigation hinzuf&uuml;gen fehlgeschlagen<br /></div>";
                }   
            } CATCH (EXCEPTION $x) {
                    echo "<div class='alert alert-danger'>".$str." installation failed <br />";
                    echo "Send the following line to the support team:<br /><br />";
                    echo "<pre>".$x->message()."</pre>      
                          </div>";
            }
        }
}

?>
