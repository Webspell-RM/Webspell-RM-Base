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

	$ergebnis = safe_query("SELECT * FROM " . PREFIX . "settings_themes WHERE active= 1");
    $dx = mysqli_fetch_array($ergebnis);
    
    #Verhindert einen Fehler wenn kein Template aktiviert ist
    if (@$dx[ 'active' ] != '1') {
        
    } else {
        $themes_modulname = $dx[ 'modulname' ];
    }
	
class widgets{

	

	function safe_query($query){
			include_once("settings.php");
			return safe_query($query); 
		}
	
        #private string $_modulname;
	
	
	private function infoExists($plugin_folder){
		if(file_exists($plugin_folder."/widget_info.json")){
			return true;
		}
		return false;
	}
	
	private function getInfo($plugin_folder){
		if($this->infoExists("includes/plugins/$plugin_folder")){
			$file = file_get_contents("includes/plugins/".$plugin_folder."/widget_info.json");
			$json = json_decode($file, true);
			return $json['plugin'];
		}
		return false;
	}
	
	private function isComplete($plugin_folder){
		$info = $this->getInfo($plugin_folder);
		if($this->infoExists("includes/plugins/$plugin_folder") ){
			return true;
		}
		return false;
	}
	
	public function isSite($sitename){
		$plugins = $this->getPlugins();
		foreach($plugins as $plugin){
			$name = $plugin['plugin']['info']['name'];
			$folder = $plugin['plugin']['info']['folder'];
			$sites = $plugin['plugin']['sites'];
			$modulname = $plugin['plugin']['modulname'];
			
			if(in_array($sitename, $sites)){
				return "includes/plugins/".$folder."/".$sitename;
			}
		}
		return false;
	}
	
	
	
	public function getPlugins(){
		$plugins = array();
		$dirs = array_filter(glob('../includes/plugins/*'), 'is_dir');
		foreach($dirs as $dir){
			if(file_exists($dir."/widget_info.json")){
				$file = file_get_contents($dir."/widget_info.json");
				$json = json_decode($file, true);
				$plugins[] = $json;
			}
		}
		return $plugins;
	}
	
	
	public function showWidget($name, $curr_widgetname = "", $curr_id = ""){
		$widgetname = $this->_widgetname;
		$query = safe_query("SELECT pluginID FROM `".PREFIX."plugins` WHERE widgetname1='".$widgetname."'");
    	$data_array = mysqli_fetch_array($query);
    	if($data_array) { 
    	$plugin = new plugin_manager();
  		$plugin->set_debug(DEBUG);
  		echo $plugin->plugin_widget1($data_array["pluginID"]);
		}

		$widgetname = $this->_widgetname;
		$query = safe_query("SELECT pluginID FROM `".PREFIX."plugins` WHERE widgetname2='".$widgetname."'");
    	$data_array = mysqli_fetch_array($query);
    	if($data_array) { 
    	$plugin = new plugin_manager();
  		$plugin->set_debug(DEBUG);
  		echo $plugin->plugin_widget2($data_array["pluginID"]);
		}

		$widgetname = $this->_widgetname;
		$query = safe_query("SELECT pluginID FROM `".PREFIX."plugins` WHERE widgetname3='".$widgetname."'");
    	$data_array = mysqli_fetch_array($query);
    	if($data_array) { 
    	$plugin = new plugin_manager();
  		$plugin->set_debug(DEBUG);
  		echo $plugin->plugin_widget3($data_array["pluginID"]);
		}


		return false;
	}
	
	
	public function registerWidget($position, $template_file = "default_widget_box"){
		global $themes_modulname;
		$select_sql = "SELECT position FROM ".PREFIX."plugins_widgets WHERE position LIKE '$position' && plugin_folder IS NULL && widget_file IS NULL && themes_modulname='$themes_modulname'";
		$select_result = $this->safe_query($select_sql);
		if(!mysqli_num_rows($select_result)>0){
			#$register_sql = "INSERT INTO ".PREFIX."plugins_widgets (position, description) VALUES ('".$position."','".$description."')";
			global $themes_modulname;
			$register_sql = "INSERT INTO ".PREFIX."plugins_widgets (position) VALUES ('".$position."')";
			$result = $this->safe_query($register_sql);
		}else{
			global $themes_modulname;
			$select_all_widgets = "SELECT id, plugin_folder, widgetname, modulname, widget_file, sort FROM ".PREFIX."plugins_widgets WHERE position LIKE '$position' AND plugin_folder IS NOT NULL && widget_file IS NOT NULL && widgetname IS NOT NULL && modulname IS NOT NULL && themes_modulname='$themes_modulname' ORDER BY sort ASC";
			$result_all_widgets = $this->safe_query($select_all_widgets);
			$widgets_templates = "<div class='panel-body'>No Widgets added.</div>";
			$curr_widget_template = false;
			if(mysqli_num_rows($result_all_widgets)>0){
				$widgets_templates = "";
				while($widget = mysqli_fetch_array($result_all_widgets)){
					$curr_id 	= $widget['id'];
					$curr_widgetname 	= $widget['widgetname'];
					$curr_modulname 	= $widget['modulname'];
					$curr_plugin_folder = $widget['plugin_folder'];
					$curr_widget_file	= $widget['widget_file'];
					$this->_plugin_folder = $curr_plugin_folder;
					$this->_widgetname = $curr_widgetname;
					$this->_modulname = $curr_modulname;
					$curr_widget_template = $this->showWidget($curr_widget_file, $curr_id, $curr_widgetname, $curr_modulname);
					#$curr_widget_template = $this->showWidget($curr_id, $curr_modulname);
					
				}
			}else{
				$curr_widget_template = true;
			}
			
		}
	}

	
	public function deletePosition($position){
		global $themes_modulname;
		$delete_sql = "DELETE FROM ".PREFIX."plugins_widgets WHERE position LIKE '$position'";
		$delete_result = $this->safe_query($delete_sql);
		return $delete_result;
	}
	
	public function insertWidgetToPosition($position, $description, $widget_file, $sort){
		$plugins = $this->getPlugins();
		$plugin_folder = false;
		foreach($plugins as $plugin){
			if(!empty($plugin['plugin']['info1']['widgets1']) && in_array($widget_file, $plugin['plugin']['info1']['widgets1'], TRUE)){
				$plugin_folder = $plugin['plugin']['info']['folder'];
				#$name = $plugin['plugin']['info1']['name1'];
				$modulname = $plugin['plugin']['info']['modulname'];
				$widgetname = $plugin['plugin']['info1']['widgetname1'];
				break;
			}
			if(!empty($plugin['plugin']['info2']['widgets2']) && in_array($widget_file, $plugin['plugin']['info2']['widgets2'], TRUE)){
				$plugin_folder = $plugin['plugin']['info']['folder'];
				#$name = $plugin['plugin']['info2']['name2'];
				$modulname = $plugin['plugin']['info']['modulname'];
				$widgetname = $plugin['plugin']['info2']['widgetname2'];
				break;
			}
			if(!empty($plugin['plugin']['info3']['widgets3']) && in_array($widget_file, $plugin['plugin']['info3']['widgets3'], TRUE)){
				$plugin_folder = $plugin['plugin']['info']['folder'];
				#$name = $plugin['plugin']['info3']['name3'];
				$modulname = $plugin['plugin']['info']['modulname'];
				$widgetname = $plugin['plugin']['info3']['widgetname3'];
				break;
			}
		}
		if($plugin_folder){
			global $themes_modulname;
			$insert_sql = "INSERT INTO ".PREFIX."plugins_widgets (
				position,
				description,
				name,
				modulname,
				themes_modulname,
				widgetname,
				plugin_folder,
				widget_file,
				sort
			) VALUES (
				'$position',
				'$description',
				'$widgetname',
				'$modulname',
				'$themes_modulname',
				'$widgetname',
				'$plugin_folder',
				'$widget_file',
				$sort
			)";
			$result = $this->safe_query($insert_sql);
			return $result;
		}else{
			echo "plugin not found";
			return false;
		}
	}
	
	public function sortwidget($id, $sort){
		global $themes_modulname;
		$update_sql =  "UPDATE ".PREFIX."plugins_widgets SET sort=$sort WHERE id LIKE '$id' ";
		$update_result = $this->safe_query($update_sql);
		return $update_result;
	}
	
	public function countAllWidgetsOfPosition($position){
		global $themes_modulname;
		$select_query = "SELECT id FROM ".PREFIX."plugins_widgets WHERE position LIKE '$position' && plugin_folder IS NOT NULL && widget_file IS NOT NULL && themes_modulname='$themes_modulname'";
		$select_result = $this->safe_query($select_query);
		return mysqli_num_rows($select_result);
	}
	
	public function deleteWidgetByID($id){
		global $themes_modulname;
		$delete_sql = "DELETE FROM ".PREFIX."plugins_widgets WHERE id LIKE '$id'";
		$delete_result = $this->safe_query($delete_sql);
		return $delete_result;
	}
	
	public function getAllWidgetsOfPosition($position){
		global $themes_modulname;
		$select_query = "SELECT id, description, position, name, widgetname, modulname, plugin_folder, widget_file, sort, themes_modulname FROM ".PREFIX."plugins_widgets WHERE position LIKE '$position' && plugin_folder IS NOT NULL && widget_file IS NOT NULL && themes_modulname='$themes_modulname' ORDER BY sort ASC";
		$select_result = $this->safe_query($select_query);
		$widgets = array();
		while($widget = mysqli_fetch_array($select_result)){
			$widgets[] = $widget;
		}
		return $widgets;
	}
	
	public function getAllWidgetsPositions(){
		global $themes_modulname;
		$select_query = "SELECT id, description, position, name, widgetname, modulname, themes_modulname, sort FROM ".PREFIX."plugins_widgets WHERE position IS NOT NULL && plugin_folder IS NULL && widget_file IS NULL && themes_modulname='$themes_modulname' ORDER BY sort ASC";
		$select_result = $this->safe_query($select_query);
		$positions = array();
		while($position = mysqli_fetch_array($select_result)){
			$positions[] = $position;
		}
		return $positions;
	}
	
	
	
}
?>