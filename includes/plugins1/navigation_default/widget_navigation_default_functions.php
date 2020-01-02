<?php 
$query = safe_query("SELECT pluginID FROM `".PREFIX."plugins` WHERE modulname='navigation_default'");
    $data_array = mysqli_fetch_array($query);
    if($data_array) { 
    $plugin = new plugin_manager();
  	$plugin->set_debug(DEBUG);
  	echo $plugin->plugin_sc($data_array['pluginID']);
}
?>