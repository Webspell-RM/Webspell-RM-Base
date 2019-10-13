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
class widgets{

	function safe_query($query){
			include_once("settings.php");
			return safe_query($query); 
		}
	
	
	private function infoExists($plugin_folder){
		if(file_exists($plugin_folder."/info.json")){
			return true;
		}
		return false;
	}
	
	private function getInfo($plugin_folder){
		if($this->infoExists("includes/plugins/$plugin_folder")){
			$file = file_get_contents("includes/plugins/".$plugin_folder."/info.json");
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
			if(file_exists($dir."/info.json")){
				$file = file_get_contents($dir."/info.json");
				$json = json_decode($file, true);
				$plugins[] = $json;
			}
		}
		return $plugins;
	}
	
	
	
	public function showWidget($name, $curr_id = ""){
		$plugin_folder = $this->_plugin_folder;
		$plugin_path   = "includes/plugins/$plugin_folder";
		if($this->isComplete($plugin_folder)){
			$plugin = $this->getInfo($plugin_folder);
			$widgets = $plugin['widgets'];
			if(in_array($name, $widgets)){
				$widget_file = "$plugin_path/".$name;
				include($widget_file);
				if(isset($widget)){
					return $widget;
				}
			}
		}
		return false;
	}

	
	public function registerWidget($position, $description, $template_file = "default_widget_box"){
		$select_sql = "SELECT position FROM ".PREFIX."plugins_widgets WHERE position LIKE '$position' && plugin_folder IS NULL && widget_file IS NULL";
		$select_result = $this->safe_query($select_sql);
		if(!mysqli_num_rows($select_result)>0){
			$register_sql = "INSERT INTO ".PREFIX."plugins_widgets (position, description) VALUES ('".$position."','".$description."')";
			$result = $this->safe_query($register_sql);
		}else{
			$select_all_widgets = "SELECT id,plugin_folder, widget_file, sort FROM ".PREFIX."plugins_widgets WHERE position LIKE '$position' AND plugin_folder IS NOT NULL && widget_file IS NOT NULL ORDER BY sort ASC";
			$result_all_widgets = $this->safe_query($select_all_widgets);
			$widgets_templates = "<div class='panel-body'>No Widgets added.</div>";
			$curr_widget_template = false;
			if(mysqli_num_rows($result_all_widgets)>0){
				$widgets_templates = "";
				while($widget = mysqli_fetch_array($result_all_widgets)){
					$curr_id 	= $widget['id'];
					$curr_plugin_folder = $widget['plugin_folder'];
					$curr_widget_file	= $widget['widget_file'];
					$this->_plugin_folder = $curr_plugin_folder;
					$curr_widget_template = $this->showWidget($curr_widget_file, $curr_id);
					
				}
			}else{
				$curr_widget_template = true;
			}
			
		}
	}

	
	public function deletePosition($position){
		$delete_sql = "DELETE FROM ".PREFIX."plugins_widgets WHERE position LIKE '$position'";
		$delete_result = $this->safe_query($delete_sql);
		return $delete_result;
	}
	
	public function insertWidgetToPosition($position, $widget_file, $sort){
		$plugins = $this->getPlugins();
		$plugin_folder = false;
		foreach($plugins as $plugin){
			if(in_array($widget_file, $plugin['plugin']['widgets'])){
				$plugin_folder = $plugin['plugin']['info']['folder'];
				$name = $plugin['plugin']['info']['name'];
				$modulname = $plugin['plugin']['info']['modulname'];
				break;
			}
		}
		if($plugin_folder){
			$insert_sql = "INSERT INTO ".PREFIX."plugins_widgets (
				position,
				name,
				modulname,
				plugin_folder,
				widget_file,
				sort
			) VALUES (
				'$position',
				'$name',
				'$plugin_folder',
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
		$update_sql =  "UPDATE ".PREFIX."plugins_widgets SET sort=$sort WHERE id LIKE '$id' ";
		$update_result = $this->safe_query($update_sql);
		return $update_result;
	}
	
	public function countAllWidgetsOfPosition($position){
		$select_query = "SELECT id FROM ".PREFIX."plugins_widgets WHERE position LIKE '$position' && plugin_folder IS NOT NULL && widget_file IS NOT NULL";
		$select_result = $this->safe_query($select_query);
		return mysqli_num_rows($select_result);
	}
	
	public function deleteWidgetByID($id){
		$delete_sql = "DELETE FROM ".PREFIX."plugins_widgets WHERE id LIKE '$id'";
		$delete_result = $this->safe_query($delete_sql);
		return $delete_result;
	}
	
	public function getAllWidgetsOfPosition($position){
		$select_query = "SELECT id, description, position, name, modulname, plugin_folder, widget_file, sort FROM ".PREFIX."plugins_widgets WHERE position LIKE '$position' && plugin_folder IS NOT NULL && widget_file IS NOT NULL ORDER BY sort ASC";
		$select_result = $this->safe_query($select_query);
		$widgets = array();
		while($widget = mysqli_fetch_array($select_result)){
			$widgets[] = $widget;
		}
		return $widgets;
	}
	
	public function getAllWidgetsPositions(){
		$select_query = "SELECT id, description, position, name, modulname FROM ".PREFIX."plugins_widgets WHERE position IS NOT NULL && plugin_folder IS NULL && widget_file IS NULL";
		$select_result = $this->safe_query($select_query);
		$positions = array();
		while($position = mysqli_fetch_array($select_result)){
			$positions[] = $position;
		}
		return $positions;
	}
	
	
	
}
?>