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
	
	private string $_modulname;
	private string $_widgetname;
	
	private function isComplete($plugin_folder){
		$info = $this->getInfo($plugin_folder);
		if($this->infoExists("includes/plugins/$plugin_folder") ){
			return true;
		}
		return false;
	}
	
	public function showWidget($name, $curr_widgetname = "", $curr_id = ""){
		$widgetname = $this->_widgetname;
		$query = safe_query("SELECT pluginID FROM `" . PREFIX . "settings_plugins` WHERE widgetname1='".$widgetname."'");
    	$data_array = mysqli_fetch_array($query);
    	if($data_array) { 
	    	$plugin = new plugin_manager();
	  		$plugin->set_debug(DEBUG);
	  		echo $plugin->plugin_widget1($data_array["pluginID"]);
		}

		$widgetname = $this->_widgetname;
		$query = safe_query("SELECT pluginID FROM `" . PREFIX . "settings_plugins` WHERE widgetname2='".$widgetname."'");
    	$data_array = mysqli_fetch_array($query);
    	if($data_array) { 
	    	$plugin = new plugin_manager();
	  		$plugin->set_debug(DEBUG);
	  		echo $plugin->plugin_widget2($data_array["pluginID"]);
		}

		$widgetname = $this->_widgetname;
		$query = safe_query("SELECT pluginID FROM `" . PREFIX . "settings_plugins` WHERE widgetname3='".$widgetname."'");
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
		$select_sql = "SELECT position FROM " . PREFIX . "settings_widgets WHERE position LIKE '$position' && themes_modulname='$themes_modulname'";
		$select_result = $this->safe_query($select_sql);
		if(!mysqli_num_rows($select_result)>0){
			#$register_sql = "INSERT INTO ".PREFIX."settings_widgets (position, description) VALUES ('".$position."','".$description."')";
			#global $themes_modulname;
			#$register_sql = "INSERT INTO ".PREFIX."settings_widgets (position) VALUES ('".$position."')";
			#$result = $this->safe_query($register_sql);
		}else{
			global $themes_modulname;
			$select_all_widgets = "SELECT id, widgetname, modulname, sort FROM " . PREFIX . "settings_widgets WHERE position LIKE '$position' AND widgetname IS NOT NULL && modulname IS NOT NULL && themes_modulname='$themes_modulname' ORDER BY sort ASC";
			$result_all_widgets = $this->safe_query($select_all_widgets);
			$widgets_templates = "<div class='panel-body'>No Widgets added.</div>";
			$curr_widget_template = false;
			if(mysqli_num_rows($result_all_widgets)>0){
				$widgets_templates = "";
				while($widget = mysqli_fetch_array($result_all_widgets)){
					$curr_id 	= $widget['id'];
					$curr_widgetname 	= $widget['widgetname'];
					$curr_modulname 	= $widget['modulname'];
					$this->_widgetname = $curr_widgetname;
					$this->_modulname = $curr_modulname;
					$curr_widget_template = $this->showWidget($curr_id, $curr_widgetname, $curr_modulname);					
				}
			}else{
				$curr_widget_template = true;
			}
		}	
	}
}
?>