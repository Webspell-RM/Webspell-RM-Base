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

/*
 * plugin_manager v1.4
 * 
 * This is the first simple management for addons or modifications.
 * For a detailed documentation visit the authors website or ask 
 * in the notified board. 
 *
 * @author: Matti <Getschonnik> W. | info@Getschonnik.de
 * @version: 1.3
 * @package: plugin_manager
 * @website: www.webSPELL-NOR.de
 *
 * @modified: T-Seven | Webspell-RM.de
 * @version: 1.4
 */

 ?>

<style type="text/css">
.pato15 { padding-top: 15px; }
</style>
<?php
$_language->readModule('plugin_manager', false, true);

$ergebnis = safe_query("SELECT * FROM ".PREFIX."navigation_dashboard_links WHERE modulname='ac_plugin_manager'");
    while ($db=mysqli_fetch_array($ergebnis)) {
      $accesslevel = 'is'.$db['accesslevel'].'admin';

if (!$accesslevel($userID) || mb_substr(basename($_SERVER[ 'REQUEST_URI' ]), 0, 15) != "admincenter.php") {
    die($_language->module[ 'access_denied' ]);
}
}
    	
if(isset($_GET['do'])) { $do=$_GET['do']; } else { $do=""; }
if(isset($_GET['id'])) { $id=intval($_GET['id']); } else { $id=""; }
if($id!="" && $do=="dea") {
	try {
		safe_query("UPDATE `".PREFIX."plugins` SET `activate` = '0' WHERE `pluginID` = '".$id."';");	
		echo $_language->module[ 'success_deactivated' ];
		redirect("admincenter.php?site=plugin_manager", "", 2); return false;
	} CATCH (Exception $e) {
		 echo $_language->module[ 'success_deactivated' ]."<br /><br />".$e->getMessage();	
		 redirect("admincenter.php?site=plugin_manager", "", 5); return false;
	}
}
if($id!="" && $do=="act") {
	try {
		safe_query("UPDATE `".PREFIX."plugins` SET `activate` = '1' WHERE `pluginID` = '".$id."';");	
		echo $_language->module[ 'success_activated' ];
		redirect("admincenter.php?site=plugin_manager", "", 2); return false;
	} CATCH (Exception $e) {
		 echo $_language->module[ 'failed_activated' ]."<br /><br />".$e->getMessage();	
		 redirect("admincenter.php?site=plugin_manager", "", 5); return false;
	}
}	
if($id!="" && $do=="del") {
	try {
		safe_query("DELETE FROM `".PREFIX."plugins` WHERE `pluginID` = '".$id."' LIMIT 1");	
		echo $_language->module[ 'success_delete' ];
		redirect("admincenter.php?site=plugin_manager", "", 2); return false;
	} CATCH (Exception $e) {
		 echo $_language->module[ 'failed_delete' ]."<br /><br />".$e->getMessage();	
		 redirect("admincenter.php?site=plugin_manager", "", 5); return false;
	}
}	

if(isset($_POST['svn'])) {
  if(isset($_POST['activate'])) { $acti = 1; } else { $acti = 0; }
  
  
  try {

  
		safe_query("INSERT INTO `".PREFIX."plugins` (
                    `pluginID`, 
                    `name`, 
                    `modulname`,
                    `widgetname1`,
                    `widgetname2`,
                    `widgetname3`,  
                    `description`, 
                    `activate`, 
                    `admin_file`, 
                    `author`, 
                    `website`, 
                    `index_link`, 
                    `widget_link1`,
                    `widget_link2`, 
                    `widget_link3`,
                    `hiddenfiles`, 
                    `version`, 
                    `path`
                    ) VALUES (
                    NULL, 
                    '".$_POST['name']."', 
                    '".$_POST['modulname']."',
                    '".$_POST['widgetname1']."',
                    '".$_POST['widgetname2']."',
                    '".$_POST['widgetname3']."',  
                    '".$_POST['description']."', 
                    '".$acti."', 
                    '".$_POST['admin_file']."', 
                    '".$_POST['author']."', 
                    '".$_POST['website']."', 
                    '".$_POST['index']."', 
                    '".$_POST['widget_link1']."',
                    '".$_POST['widget_link2']."', 
                    '".$_POST['widget_link3']."',  
                    '".$_POST['hiddenfiles']."', 
                    '".$_POST['version']."', 
                    '".$_POST['path']."'
                );
                ");
        
if($_POST['widgetname1'] == '')
   {
  echo'';
  }else{        
 // data strored in array
$array = Array (
"plugin" => Array (
  
    "info" => Array (
        "name" => $_POST['name'],
        "modulname" => $_POST['modulname'],
        "folder" => $_POST['path']
    ),
    "info1" => Array (
        "widgetname1" => $_POST['widgetname1'],
        "widgets1" => [$_POST['widget_link1']]
    ),
    "info2" => Array (
        "widgetname2" => $_POST['widgetname2'],
        "widgets2" => [$_POST['widget_link2']]
        ),
    "info3" => Array (
        "widgetname3" => $_POST['widgetname3'],
        "widgets3" => [$_POST['widget_link3']]
    )
)
);
    $json = json_encode($array); 
    $bytes = file_put_contents("../".$_POST['path']."widget_info.json", $json);
}
		echo $_language->module[ 'success_save' ]."<br /><br />";	
		redirect("admincenter.php?site=plugin_manager", "", 2); return false;
	} CATCH (Exception $e) {
		echo $_language->module[ 'failed_save' ]."<br /><br />".$e->getMessage();	
		redirect("admincenter.php?site=plugin_manager", "", 5); return false;
	}
return false;	
}
if(isset($_POST['saveedit'])) {
  $modulname = $_POST[ 'modulname' ];
	if(isset($_POST['activate'])) { $acti = 1; } else { $acti = 0; }
  

    try {

      $ergebnis = safe_query("SELECT * FROM `".PREFIX."plugins` WHERE `pluginID`='".$id."' LIMIT 1");
    $ds = mysqli_fetch_array($ergebnis);

      $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "plugins WHERE modulname='".$modulname."'"));
                if (@$dx[ 'modulname' ] != $modulname) {
       $modul = safe_query("UPDATE `".PREFIX."plugins` SET 
      `name` = '".$_POST['name']."', 
      `modulname` = '".$_POST['modulname']."',
      `widgetname1` = '".$_POST['widgetname1']."',
      `widgetname2` = '".$_POST['widgetname2']."',
      `widgetname3` = '".$_POST['widgetname3']."', 
      `description` = '".$_POST['description']."', 
      `activate` = '".$acti."', 
      `admin_file` = '".$_POST['admin_file']."', 
      `author` = '".$_POST['author']."', 
      `website` = '".$_POST['website']."', 
      `index_link` = '".$_POST['index']."', 
      `widget_link1` = '".$_POST['widget_link1']."',
      `widget_link2` = '".$_POST['widget_link2']."', 
      `widget_link3` = '".$_POST['widget_link3']."',  
      `hiddenfiles` = '".$_POST['hiddenfiles']."', 
      `version` = '".$_POST['version']."', 
      `path` = '".$_POST['path']."'
      WHERE `pluginID` = '".intval($_POST['pid'])."';");;
                } else {
                    $modul = 


		safe_query("UPDATE `".PREFIX."plugins` SET 
      `name` = '".$_POST['name']."', 
      `modulname` = '".$_POST['modulname']."',
      `widgetname1` = '".$_POST['widgetname1']."',
      `widgetname2` = '".$_POST['widgetname2']."',
      `widgetname3` = '".$_POST['widgetname3']."', 
      `description` = '".$_POST['description']."', 
      `activate` = '".$acti."', 
      `admin_file` = '".$_POST['admin_file']."', 
      `author` = '".$_POST['author']."', 
      `website` = '".$_POST['website']."', 
      `index_link` = '".$_POST['index']."', 
      `widget_link1` = '".$_POST['widget_link1']."',
      `widget_link2` = '".$_POST['widget_link2']."', 
      `widget_link3` = '".$_POST['widget_link3']."',  
      `hiddenfiles` = '".$_POST['hiddenfiles']."', 
      `version` = '".$_POST['version']."', 
      `path` = '".$_POST['path']."'

      WHERE `pluginID` = '".intval($_POST['pid'])."';");


if($_POST['widgetname1'] == '')
   {
  echo'';
  }else{
    // data strored in array
$array = Array (
"plugin" => Array (
  
    "info" => Array (
        "name" => $_POST['name'],
        "modulname" => $_POST['modulname'],
        "folder" => $_POST['path']
    ),
    "info1" => Array (
        "widgetname1" => $_POST['widgetname1'],
        "widgets1" => [$_POST['widget_link1']]
    ),
    "info2" => Array (
        "widgetname2" => $_POST['widgetname2'],
        "widgets2" => [$_POST['widget_link2']]
        ),
    "info3" => Array (
        "widgetname3" => $_POST['widgetname3'],
        "widgets3" => [$_POST['widget_link3']]
    )
)
);
    $json = json_encode($array); 
    $bytes = file_put_contents("../".$_POST['path']."widget_info.json", $json);
 
}

} 

		echo $_language->module[ 'success_edit' ]."<br /><br />";	
		redirect("admincenter.php?site=plugin_manager", "", 2); return false;
	} CATCH (Exception $e) {
		echo $_language->module[ 'failed_edit' ]."<br /><br />".$e->getMessage();	
		redirect("admincenter.php?site=plugin_manager", "", 5); return false;
	}
return false;	
}
if($do=="edit") {
  $CAPCLASS = new \webspell\Captcha;
    $CAPCLASS->createTransaction();
    $hash = $CAPCLASS->getHash();


	try {
		
    $ergebnis = safe_query("SELECT * FROM `".PREFIX."plugins` WHERE `pluginID`='".$id."' LIMIT 1");
    $ds = mysqli_fetch_array($ergebnis);

    if($ds['activate'] == 1) { $acti = 'checked="checked"'; } else { $acti = ""; }
  } CATCH (Exception $e) {
      echo $e->getMessage();
    return false; 
  }

    

 
	echo '<div class="card">
        <div class="card-header">
            <i class="fas fa-cogs"></i> '.$_language->module['plugin_manager'].'
        </div>
            
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="admincenter.php?site=plugin_manager">' . $_language->module['plugin_manager'] . '</a></li>
    <li class="breadcrumb-item active" aria-current="page">' . $_language->module['edit_plugin'] . '</li>
  </ol>
</nav>
     <div class="card-body">';     
  echo'
  <form class="form-horizontal" method="post" id="post" name="post" action="admincenter.php?site=plugin_manager" enctype="multipart/form-data" onsubmit="return chkFormular();"> 
  
<div class="row">
<div class="col-sm-6">

  <div class="form-group row">
  	<input type="hidden" name="pid" value="'.$ds['pluginID'].'" />
    <label class="col-sm-5 col-form-label" for="name">Plugin Name:</label>
    <div class="col-sm-6"><span class="text-muted small"><em>
    <input type="name" class="form-control" name="name" value="'.$ds['name'].'" placeholder="plugin name"></em></span>
  </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-5 col-form-label" for="name">Description:</label>
    <div class="col-sm-6"><span class="text-muted small"><em>
    <textarea class="form-control" name="description" rows="5" cols="" style="width: 100%;" placeholder="description">'.$ds['description'].'</textarea></em></span>
  </div>
  </div>
  <div class="form-group row">
 	<label class="col-sm-5 col-form-label" for="admin_file">Admin file:</label>
 	<div class="col-sm-6"><span class="text-muted small"><em>
 	 <input type="name" class="form-control"  name="admin_file" value="'.$ds['admin_file'].'" placeholder="admin file"></em></span>
  </div>
  </div>
  <div class="form-group row">
 	<label class="col-sm-5 col-form-label" for="author">Author:</label>
 	<div class="col-sm-6"><span class="text-muted small"><em>
 	 <input type="name" class="form-control" rows="5" name="author" value="'.$ds['author'].'" placeholder="autor"></em></span>
  </div>
  </div>
  <div class="form-group row">
 	<label class="col-sm-5 col-form-label" for="website">Website:</label>
 	<div class="col-sm-6"><span class="text-muted small"><em>
 	 <input type="name" class="form-control" placeholder="http://" rows="5"  value="'.$ds['website'].'" name="website"></em></span>
  </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-5 col-form-label" for="name">Modulname: <br><small>(for uninstall)</small></label>
    <div class="col-sm-6"><span class="text-muted small"><em>
    <input type="name" class="form-control" name="modulname" value="'.$ds['modulname'].'" placeholder="modulname"></em></span>
  </div>
  </div>

  <div class="form-group row">
    <label class="col-sm-5 col-form-label" for="index">Index File: <br><small>(without extension, also no .php)</small></label>
    <div class="col-sm-6"><span class="text-muted small"><em>
     <input type="name" class="form-control" placeholder="index file" rows="5"  value="'.$ds['index_link'].'" name="index"></em></span>
  </div>
  </div>

   <div class="form-group row">
    <label class="col-sm-5 col-form-label" for="hittenfiles">Hidden file(s): <br><small>(seperate with "," [comma without space] )</small></label>
    <div class="col-sm-6"><span class="text-muted small"><em>
     <input type="name" class="form-control" rows="5" placeholder="myfile,secondfile,anotherfile" value="'.$ds['hiddenfiles'].'" name="hiddenfiles"></em></span>
  </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-5 col-form-label" for="version">Version:</label>
    <div class="col-sm-6"><span class="text-muted small"><em>
     <input type="name" class="form-control" rows="5" value="'.$ds['version'].'" name="version" placeholder="version"></em></span>
  </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-5 col-form-label" for="path">Folder Path: <br><small>(includes/plugins/myplugin/ (end with slash / ) )</small></label>
    <div class="col-sm-6"><span class="text-muted small"><em>
     <input type="name" class="form-control" placeholder="includes/plugins/myplugin/"  value="'.$ds['path'].'" rows="5" name="path"></em></span>
  </div>
  </div>

</div>
<div class="col-sm-6">

  
    
  Widget Einstellung:
  <hr>
  <div class="form-group row">
    <label class="col-sm-5 col-form-label" for="name">Widgetname 1: <br><small>(for widget 1)</small></label>
    <div class="col-sm-6"><span class="text-muted small"><em>
    <input type="name" class="form-control" placeholder="Widget_name" name="widgetname1" value="'.$ds['widgetname1'].'"></em></span>
  </div>
  </div>
  <div class="form-group row">
 	<label class="col-sm-5 col-form-label" for="widget_link">Widget_File 1: <br><small>(empty if not exists, else without extension)</small></label>
 	<div class="col-sm-6"><span class="text-muted small"><em>
 	 <input type="name" class="form-control" rows="5" placeholder="Widget_myplugin" value="'.$ds['widget_link1'].'" name="widget_link1"></em></span>
  </div>
  </div>


  
 <hr> 
 <div class="form-group row">
    <label class="col-sm-5 col-form-label" for="name">Widgetname 2: <br><small>(for widget 2)</small></label>
    <div class="col-sm-6"><span class="text-muted small"><em>
    <input type="name" class="form-control" placeholder="Widget_name" name="widgetname2" value="'.$ds['widgetname2'].'"></em></span>
  </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-5 col-form-label" for="widget_link">Widget_File 2: <br><small>(empty if not exists, else without extension)</small></label>
    <div class="col-sm-6"><span class="text-muted small"><em>
     <input type="name" class="form-control" rows="5" placeholder="Widget_myplugin" value="'.$ds['widget_link2'].'" name="widget_link2"></em></span>
  </div>
  </div>

  
  <hr>
  <div class="form-group row">
    <label class="col-sm-5 col-form-label" for="name">Widgetname 3: <br><small>(for widget3)</small></label>
    <div class="col-sm-6"><span class="text-muted small"><em>
    <input type="name" class="form-control" placeholder="Widget_name" name="widgetname3" value="'.$ds['widgetname3'].'"></em></span>
  </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-5 col-form-label" for="widget_link">Widget_File 3: <br><small>(empty if not exists, else without extension)</small></label>
    <div class="col-sm-6"><span class="text-muted small"><em>
     <input type="name" class="form-control" rows="5" placeholder="Widget_myplugin" value="'.$ds['widget_link3'].'" name="widget_link3"></em></span>
  </div>
  </div>

 

</div>



<div class="col-sm-12">

<div class="form-group row">
    <label class="col-sm-2 col-form-label">Plugin activate?:</label>
    <div class="col-sm-6"><span class="text-muted small"><em>
        <input type="checkbox" name="activate" value="1" '.$acti.'"> </em></span>
    </div>
  </div>

<div class="form-group row">
    <div class="col-sm-11">
    <input type="hidden" name="captcha_hash" value="'.$hash.'" />
    <button class="btn btn-warning" type="submit" name="saveedit"  />'.$_language->module['edit'].'</button>
    </div>
  </div>


</div>
</div>
</form>

</div>
  </div>';
return false;
	
}	
if($do=="new") {

?><script>
    <!--
    function chkFormular() {
        if (document.getElementById('name').value == "") {
            alert("Du musst einen Plugin Name angeben!");
            document.getElementById('name').focus();
            return false;
        }

        if (document.getElementById('modulname').value == "") {
            alert("Du musst einen Modul Name angeben!");
            document.getElementById('modulname').focus();
            return false;
        }

        

    }
    -->
</script><?php

	echo '<div class="card">
        <div class="card-header">
            <i class="fas fa-cogs"></i> '.$_language->module['plugin_manager'].'
        </div>
            
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="admincenter.php?site=plugin_manager">' . $_language->module['plugin_manager'] . '</a></li>
    <li class="breadcrumb-item active" aria-current="page">' . $_language->module['add_plugin'] . '</li>
  </ol>
</nav>
     <div class="card-body">';

  echo'<form class="form-horizontal" method="post" id="post" name="post" action="admincenter.php?site=plugin_manager" onsubmit="return chkFormular();" enctype="multipart/form-data">
       <form class="form-horizontal" method="post" id="post" name="post" action="admincenter.php?site=plugin_manager" enctype="multipart/form-data" onsubmit="return chkFormular();"> 
  <div class="row">
<div class="col-sm-6">

  <div class="form-group row">
     <label class="col-sm-5 col-form-label" for="name">Plugin Name:<font color="#DD0000">*</font></label>
    <div class="col-sm-6"><span class="text-muted small"><em>
    <input type="text" name="name" id="name" placeholder="plugin name" maxlength="30" autocomplete="name" class="form-control"></em></span>
  </div>
  </div>
  <div class="form-group row">
     <label class="col-sm-5 col-form-label" for="name">Description:</label>
    <div class="col-sm-6"><span class="text-muted small"><em>
    <textarea class="form-control" name="description" rows="5" cols="" style="width: 100%;" placeholder="description"></textarea></em></span>
  </div>
  </div>
  
  <div class="form-group row">
 	<label class="col-sm-5 col-form-label" for="admin_file">Admin File:</label>
 	<div class="col-sm-6"><span class="text-muted small"><em>
 	 <input type="name" class="form-control" name="admin_file" placeholder="admin_file"></em></span>
  </div>
  </div>
  <div class="form-group row">
 	<label class="col-sm-5 col-form-label" for="author">Author:</label>
 	<div class="col-sm-6"><span class="text-muted small"><em>
 	 <input type="name" class="form-control" rows="5" name="author" placeholder="author"></em></span>
  </div>
  </div>
  <div class="form-group row">
 	<label class="col-sm-5 col-form-label" for="website">Website:</label>
 	<div class="col-sm-6"><span class="text-muted small"><em>
 	 <input type="name" class="form-control" placeholder="http://" rows="5" name="website"></em></span>
  </div>
  </div>
  <div class="form-group row">
     <label class="col-sm-5 col-form-label" for="name">Modulname:<font color="#DD0000">*</font> <br><small>(for uninstall and widget)</small></label>
    <div class="col-sm-6"><span class="text-muted small"><em>
    <input type="text" name="modulname" id="modulname" placeholder="modulname" maxlength="30" autocomplete="modulname" class="form-control"></em></span>
  </div>
  </div>
  <div class="form-group row">
  <label class="col-sm-5 col-form-label" for="index">Index File: <br><small>(without extension, also no .php)</small></label>
  <div class="col-sm-6"><span class="text-muted small"><em>
   <input type="name" class="form-control" placeholder="index file" rows="5" name="index"></em></span>
  </div>
  </div>
  <div class="form-group row">
  <label class="col-sm-5 col-form-label" for="hittenfiles">Hidden file(s): <br><small>(seperate with "," [comma without space] )</small></label>
  <div class="col-sm-6"><span class="text-muted small"><em>
   <input type="name" class="form-control" rows="5" placeholder="myfile,secondfile,anotherfile" name="hiddenfiles"></em></span>
  </div>
  </div>
  <div class="form-group row">
  <label class="col-sm-5 col-form-label" for="version">Version:</label>
  <div class="col-sm-6"><span class="text-muted small"><em>
   <input type="name" class="form-control" rows="5" name="version" placeholder="version"></em></span>
  </div>
  </div>
  <div class="form-group row">
  <label class="col-sm-5 col-form-label" for="path">Folder Path: <br><small>(includes/plugins/myplugin/ (end with slash / ) )</small></label>
  <div class="col-sm-6"><span class="text-muted small"><em>
   <input type="name" class="form-control" placeholder="includes/plugins/myplugin/" rows="5" name="path"></em></span>
  </div>
  </div>

  </div>
<div class="col-sm-6">

  
    
Widget Einstellung:
  <hr>
  <div class="form-group row">
    <label class="col-sm-5 col-form-label" for="name">Widgetname 1: <br><small>(for widget 1)</small></label>
    <div class="col-sm-6"><span class="text-muted small"><em>
    <input type="name" class="form-control" placeholder="Widget_name" name="widgetname1"></em></span>
  </div>
  </div>
  <div class="form-group row">
  <label class="col-sm-5 col-form-label" for="widget_link">Widget_File 1: <br><small>(empty if not exists, else without extension)</small></label>
  <div class="col-sm-6"><span class="text-muted small"><em>
   <input type="name" class="form-control" rows="5" placeholder="Widget_myplugin" name="widget_link1"></em></span>
  </div>
  </div>


  
 <hr> 
 <div class="form-group row">
    <label class="col-sm-5 col-form-label" for="name">Widgetname 2: <br><small>(for widget 2)</small></label>
    <div class="col-sm-6"><span class="text-muted small"><em>
    <input type="name" class="form-control" placeholder="Widget_name" name="widgetname2"></em></span>
  </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-5 col-form-label" for="widget_link">Widget_File 2: <br><small>(empty if not exists, else without extension)</small></label>
    <div class="col-sm-6"><span class="text-muted small"><em>
     <input type="name" class="form-control" rows="5" placeholder="Widget_myplugin" name="widget_link2"></em></span>
  </div>
  </div>

  
  <hr>
  <div class="form-group row">
    <label class="col-sm-5 col-form-label" for="name">Widgetname 3: <br><small>(for widget3)</small></label>
    <div class="col-sm-6"><span class="text-muted small"><em>
    <input type="name" class="form-control" placeholder="Widget_name" name="widgetname3"></em></span>
  </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-5 col-form-label" for="widget_link">Widget_File 3: <br><small>(empty if not exists, else without extension)</small></label>
    <div class="col-sm-6"><span class="text-muted small"><em>
     <input type="name" class="form-control" rows="5" placeholder="Widget_myplugin" name="widget_link3"></em></span>
  </div>
  </div>

</div>



<div class="col-sm-12">

<div class="form-group row">
    <label class="col-sm-2 col-form-label">Plugin activate?:</label>
    <div class="col-sm-6"><span class="text-muted small"><em>
        <input type="checkbox" name="activate" value="1"></em></span>
    </div>
  </div>



<div class="form-group row">
<div class="col-sm-11"><font color="#DD0000">*</font>'.$_language->module['fields_star_required'] . '</div>

    <div class="col-sm-11">

    <button class="btn btn-success" type="submit" name="svn"  />' . $_language->module['add'] . '</button>
    </div>
  </div>

</div>
  </form></div>
  </div>';
return false;
  
} 


echo'<div class="card">
        <div class="card-header">
            <i class="fas fa-cogs"></i> '.$_language->module['plugin_manager'].'
        </div>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">' . $_language->module[ 'plugin_manager' ] . '</li>
  </ol>
</nav>

<div class="card-body">

<div class="form-group row">
    <label class="col-md-1 control-label">' . $_language->module['options'] . ':</label>
    <div class="col-md-8">
      <a href="admincenter.php?site=plugin_manager&do=new" class="btn btn-primary" type="button">' . $_language->module[ 'new_plugin' ] . '</a>
    </div>
  </div>';
  
    $CAPCLASS = new \webspell\Captcha;
    $CAPCLASS->createTransaction();
    $hash = $CAPCLASS->getHash();
  
  $ergebnis=safe_query("SELECT * FROM " . PREFIX . "plugins");
  

    echo'<table id="plugini" class="table table-striped table-bordered" style="width:100%">
    <thead>
      <th><strong>' . $_language->module[ 'id' ] . '</strong></th>
      <th><strong>' . $_language->module[ 'plugin' ] . ' ' . $_language->module[ 'name' ] . '</th>
      <th><strong>' . $_language->module[ 'plugin' ] . ' ' . $_language->module[ 'description' ] . '</th>
      <th><strong>' . $_language->module[ 'status' ] . '</th>
      <th><strong>' . $_language->module[ 'option' ] . '</th>
    </thead>';
    while ($ds = mysqli_fetch_array($ergebnis)) {

      if ($ds[ 'activate' ] == "1") {
                $actions =
                    '<a href="admincenter.php?site=plugin_manager&id='.$ds['pluginID'].'&do=dea" class="btn btn-info" type="button">' . $_language->module[ 'deactivate' ] . '</a>';
            } else {
                $actions = '<a href="admincenter.php?site=plugin_manager&id='.$ds['pluginID'].'&do=act" class="btn btn-success" type="button">' . $_language->module[ 'activate' ] . '</a>';
            }

      $translate = new multiLanguage(detectCurrentLanguage());
            $translate->detectLanguages($ds['description']);
            $ds['description'] = $translate->getTextByLanguage($ds['description']);

    echo'<tr>
        <td>'.$ds['pluginID'].'</td>
        <td><b>'.$ds['name'].'</b></td>
        <td>'.$ds['description'].'</td>
        <td>'.$actions.'</td>
        <td width="16%">
        
<a href="admincenter.php?site=plugin_manager&id='.$ds['pluginID'].'&do=edit" class="btn btn-warning" type="button">' . $_language->module[ 'edit' ] . '</a>


             <input class="btn btn-danger" type="button" onclick="MM_confirm(\'' . $_language->module['really_delete'] . '\', \'admincenter.php?site=plugin_manager&id='.$ds['pluginID'].'&do=del&amp;captcha_hash='.$hash.'\')" value="' . $_language->module['delete'] . '" /> 

</td>
      </tr>';
   
 }     

    echo'</table>';  

echo '</div></div>';

?>

