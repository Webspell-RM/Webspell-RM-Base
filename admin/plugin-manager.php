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


/*
 * Plugin-Manager v1.4
 * 
 * This is the first simple management for addons or modifications.
 * For a detailed documentation visit the authors website or ask 
 * in the notified board. 
 *
 * @author: Matti <Getschonnik> W. | info@Getschonnik.de
 * @version: 1.3
 * @package: plugin-Manager
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
$_language->readModule('plugin-manager', false, true);

$ergebnis = safe_query("SELECT * FROM ".PREFIX."navigation_dashboard_links WHERE modulname='plugin_manager'");
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
		redirect("admincenter.php?site=plugin-manager", 2); return false;
	} CATCH (Exception $e) {
		 echo $_language->module[ 'success_deactivated' ]."<br /><br />".$e->getMessage();	
		 redirect("admincenter.php?site=plugin-manager", 5); return false;
	}
}
if($id!="" && $do=="act") {
	try {
		safe_query("UPDATE `".PREFIX."plugins` SET `activate` = '1' WHERE `pluginID` = '".$id."';");	
		echo $_language->module[ 'success_activated' ];
		redirect("admincenter.php?site=plugin-manager", 2); return false;
	} CATCH (Exception $e) {
		 echo $_language->module[ 'failed_activated' ]."<br /><br />".$e->getMessage();	
		 redirect("admincenter.php?site=plugin-manager", 5); return false;
	}
}	
if($id!="" && $do=="del") {
	try {
		safe_query("DELETE FROM `".PREFIX."plugins` WHERE `pluginID` = '".$id."' LIMIT 1");	
		echo $_language->module[ 'success_delete' ];
		redirect("admincenter.php?site=plugin-manager", 2); return false;
	} CATCH (Exception $e) {
		 echo $_language->module[ 'failed_delete' ]."<br /><br />".$e->getMessage();	
		 redirect("admincenter.php?site=plugin-manager", 5); return false;
	}
}	

if(isset($_POST['svn'])) {
	if(isset($_POST['activate'])) { $acti = 1; } else { $acti = 0; }
  if(isset($_POST['head_activated'])) { $head_activated = 1; } else { $head_activated = 0; }
  if(isset($_POST['content_head_activated'])) { $content_head_activated = 1; } else { $content_head_activated = 0; }
  if(isset($_POST['content_foot_activated'])) { $content_foot_activated = 1; } else { $content_foot_activated = 0; }
  
    if($_POST['radio'] == 'le_activated') {
        $le_activated = 1;
        $re_activated = 0;
        $all_activated = 0;
        $all_deactivated = 0;
    } elseif($_POST['radio'] == 're_activated') {
        $le_activated = 0;
        $re_activated = 1;
        $all_activated = 0;
        $all_deactivated = 0;
    } elseif($_POST['radio'] == 'all_activated') {
        $le_activated = 0;
        $re_activated = 0;
        $all_activated = 1;
        $all_deactivated = 0;
    } elseif($_POST['radio'] == 'all_deactivated') {
        $le_activated = 0;
        $re_activated = 0;
        $all_activated = 0;
        $all_deactivated = 1;          
     
    } else {
        $le_activated = 0;
        $re_activated = 0;
        $all_activated = 0;
        $all_deactivated = 0;
    }
	try {

    
		safe_query("INSERT INTO `".PREFIX."plugins` (
                    `pluginID`, 
                    `name`, 
                    `modulname`, 
                    `description`, 
                    `activate`, 
                    `admin_file`, 
                    `author`, 
                    `website`, 
                    `index_link`, 
                    `sc_link`, 
                    `hiddenfiles`, 
                    `version`, 
                    `path`, 
                    `le_activated`,
                    `re_activated`,
                    `all_activated`,
                    `all_deactivated`,
                    `head_activated`,
                    `content_head_activated`,
                    `content_foot_activated`) VALUES (
                    NULL, 
                    '".$_POST['name']."', 
                    '".$_POST['modulname']."', 
                    '".$_POST['description']."', 
                    '".$acti."', 
                    '".$_POST['admin_file']."', 
                    '".$_POST['author']."', 
                    '".$_POST['website']."', 
                    '".$_POST['index']."', 
                    '".$_POST['sclink']."', 
                    '".$_POST['hiddenfiles']."', 
                    '".$_POST['version']."', 
                    '".$_POST['path']."', 
                    '" . $le_activated . "',
                    '" . $re_activated . "',
                    '" . $all_activated . "',
                    '" . $all_deactivated . "',
                    '" . $head_activated . "',
                    '" . $content_head_activated . "',
                    '" . $content_foot_activated . "');");
		echo $_language->module[ 'success_save' ]."<br /><br />";	
		redirect("admincenter.php?site=plugin-manager", 3); return false;
	} CATCH (Exception $e) {
		echo $_language->module[ 'failed_save' ]."<br /><br />".$e->getMessage();	
		redirect("admincenter.php?site=plugin-manager", 5); return false;
	}
return false;	
}
if(isset($_POST['saveedit'])) {
  $modulname = $_POST[ 'modulname' ];
	if(isset($_POST['activate'])) { $acti = 1; } else { $acti = 0; }
  if(isset($_POST['head_activated'])) { $head_activated = 1; } else { $head_activated = 0; }
  if(isset($_POST['content_head_activated'])) { $content_head_activated = 1; } else { $content_head_activated = 0; }
  if(isset($_POST['content_foot_activated'])) { $content_foot_activated = 1; } else { $content_foot_activated = 0; }
	
    if($_POST['radio'] == 'le_activated') {
        $le_activated = 1;
        $re_activated = 0;
        $all_activated = 0;
        $all_deactivated = 0;
    } elseif($_POST['radio'] == 're_activated') {
        $le_activated = 0;
        $re_activated = 1;
        $all_activated = 0;
        $all_deactivated = 0;
    } elseif($_POST['radio'] == 'all_activated') {
        $le_activated = 0;
        $re_activated = 0;
        $all_activated = 1;
        $all_deactivated = 0;
    } elseif($_POST['radio'] == 'all_deactivated') {
        $le_activated = 0;
        $re_activated = 0;
        $all_activated = 0;
        $all_deactivated = 1;          
     
    } else {
        $le_activated = 0;
        $re_activated = 0;
        $all_activated = 0;
        $all_deactivated = 0;
    }

    try {
		safe_query("UPDATE `".PREFIX."plugins` SET 
      `name` = '".$_POST['name']."', 
      `modulname` = '".$_POST['modulname']."', 
      `description` = '".$_POST['description']."', 
      `activate` = '".$acti."', 
      `admin_file` = '".$_POST['admin_file']."', 
      `author` = '".$_POST['author']."', 
      `website` = '".$_POST['website']."', 
      `index_link` = '".$_POST['index']."', 
      `sc_link` = '".$_POST['sclink']."', 
      `hiddenfiles` = '".$_POST['hiddenfiles']."', 
      `version` = '".$_POST['version']."', 
      `path` = '".$_POST['path']."', 
      `le_activated` = '" . $le_activated . "',
      `re_activated` = '" . $re_activated . "',
      `all_activated` = '" . $all_activated . "',
      `all_deactivated` = '" . $all_deactivated . "',
      `head_activated` = '".$head_activated."',
      `content_head_activated` = '" . $content_head_activated . "',
      `content_foot_activated` = '" . $content_foot_activated . "'

      WHERE `pluginID` = '".intval($_POST['pid'])."';");



    if($modulname == 'startpage'){
          $geti = safe_query("SELECT * FROM " . PREFIX . "plugins WHERE modulname = ''"); 
          $rows = mysqli_num_rows($geti);
          if($rows == '0') {
            safe_query(
                "INSERT INTO
                    `" . PREFIX . "plugins` (
                    
                    `name`, 
                    `modulname`, 
                    `description`, 
                    `activate`, 
                    `admin_file`, 
                    `author`, 
                    `website`, 
                    `index_link`, 
                    `sc_link`, 
                    `hiddenfiles`, 
                    `version`, 
                    `path`, 
                    `le_activated`,
                    `re_activated`,
                    `all_activated`,
                    `all_deactivated`,
                    `head_activated`,
                    `content_head_activated`,
                    `content_foot_activated`
                    ) VALUES (
                    '".$_POST['name']."', 
                    '', 
                    '".$_POST['description']."', 
                    '".$acti."', 
                    '".$_POST['admin_file']."', 
                    '".$_POST['author']."', 
                    '".$_POST['website']."', 
                    '".$_POST['index']."', 
                    '".$_POST['sclink']."', 
                    '".$_POST['hiddenfiles']."', 
                    '".$_POST['version']."', 
                    '".$_POST['path']."', 
                    '" . $le_activated . "',
                    '" . $re_activated . "',
                    '" . $all_activated . "',
                    '" . $all_deactivated . "',
                    '" . $head_activated . "',
                    '" . $content_head_activated . "',
                    '" . $content_foot_activated . "'
                )"
            );
        }
        safe_query(
            "UPDATE
                `" . PREFIX . "plugins`
            SET
                `name` = '".$_POST['name']."', 
                `modulname` = '', 
                `description` = '".$_POST['description']."', 
                `activate` = '".$acti."', 
                `admin_file` = '".$_POST['admin_file']."', 
                `author` = '".$_POST['author']."', 
                `website` = '".$_POST['website']."', 
                `index_link` = '".$_POST['index']."', 
                `sc_link` = '".$_POST['sclink']."', 
                `hiddenfiles` = '".$_POST['hiddenfiles']."', 
                `version` = '".$_POST['version']."', 
                `path` = '".$_POST['path']."', 
                `le_activated` = '" . $le_activated . "',
                `re_activated` = '" . $re_activated . "',
                `all_activated` = '" . $all_activated . "',
                `all_deactivated` = '" . $all_deactivated . "',
                `head_activated` = '".$head_activated."',
                `content_head_activated` = '" . $content_head_activated . "',
                `content_foot_activated` = '" . $content_foot_activated . "'
                  WHERE
                `modulname` = ''"
        );
}


		echo $_language->module[ 'success_edit' ]."<br /><br />";	
		redirect("admincenter.php?site=plugin-manager", 3); return false;
	} CATCH (Exception $e) {
		echo $_language->module[ 'failed_edit' ]."<br /><br />".$e->getMessage();	
		redirect("admincenter.php?site=plugin-manager", 5); return false;
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

    if ($ds[ 'le_activated' ] == '1') {
        $le_activated = '<input id="le_activated" type="radio" name="radio" value="le_activated" checked="checked" />';
    } else {
        $le_activated = '<input id="le_activated" type="radio" name="radio" value="le_activated">';
    }

    if ($ds[ 're_activated' ] == '1') {
        $re_activated = '<input id="re_activated" type="radio" name="radio" value="re_activated" checked="checked" />';
    } else {
        $re_activated = '<input id="re_activated" type="radio" name="radio" value="re_activated">';
    }

    if ($ds[ 'all_activated' ] == '1') {
        $all_activated = '<input id="all_activated" type="radio" name="radio" value="all_activated" checked="checked" />';
    } else {
        $all_activated = '<input id="all_activated" type="radio" name="radio" value="all_activated">';
    }

    if ($ds[ 'all_deactivated' ] == '1') {
        $all_deactivated = '<input id="all_deactivated" type="radio" name="radio" value="all_deactivated" checked="checked" />';
    } else {
        $all_deactivated = '<input id="all_deactivated" type="radio" name="radio" value="all_deactivated">';
    }

    if ($ds[ 'head_activated' ] == '1') {
        $head_activated = '<input type="checkbox" name="head_activated" value="1" checked="checked">';
    } else {
        $head_activated = '<input type="checkbox" name="head_activated" value="1">';
    }

    if ($ds['content_head_activated'] == '1') {
        $content_head_activated = '<input type="checkbox" name="content_head_activated" value="1" checked="checked">';
    } else {
        $content_head_activated = '<input type="checkbox" name="content_head_activated" value="1">';
    }

    if ($ds['content_foot_activated'] == '1') {
        $content_foot_activated = '<input type="checkbox" name="content_foot_activated" value="1" checked="checked">';
    } else {
        $content_foot_activated = '<input type="checkbox" name="content_foot_activated" value="1">';
    }


	echo '<div class="card">
        <div class="card-header">
            <i class="fas fa-cogs"></i> '.$_language->module['plugin_manager'].'
        </div>
            
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="admincenter.php?site=plugin-manager">' . $_language->module['plugin_manager'] . '</a></li>
    <li class="breadcrumb-item active" aria-current="page">' . $_language->module['edit_plugin'] . '</li>
  </ol>
</nav>
     <div class="card-body">';

  echo'
	
	 	 <form class="form-horizontal" method="post" id="post" name="post" action="admincenter.php?site=plugin-manager" enctype="multipart/form-data" onsubmit="return chkFormular();"> 
  
  <div class="form-group row">
  	<input type="hidden" name="pid" value="'.$ds['pluginID'].'" />
    <label class="col-sm-4 control-label" for="name">Name:</label>
    <div class="col-sm-7"><span class="text-muted small"><em>
    <input type="name" class="form-control" name="name" value="'.$ds['name'].'"></em></span>
  </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-4 control-label" for="name">Description:</label>
    <div class="col-sm-7"><span class="text-muted small"><em>
    <input type="name" class="form-control" name="description" value="'.$ds['description'].'"></em></span>
  </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-4 control-label" for="name">Modulname (for uninstall and widget):</label>
    <div class="col-sm-7"><span class="text-muted small"><em>
    <input type="name" class="form-control" name="modulname" value="'.$ds['modulname'].'"></em></span>
  </div>
  </div>
  <div class="form-group row">
 	<label class="col-sm-4 control-label" for="admin_file">Admin file:</label>
 	<div class="col-sm-7"><span class="text-muted small"><em>
 	 <input type="name" class="form-control"  name="admin_file" value="'.$ds['admin_file'].'"></em></span>
  </div>
  </div>
  <div class="form-group row">
 	<label class="col-sm-4 control-label" for="author">Author:</label>
 	<div class="col-sm-7"><span class="text-muted small"><em>
 	 <input type="name" class="form-control" rows="5" name="author" value="'.$ds['author'].'"></em></span>
  </div>
  </div>
  <div class="form-group row">
 	<label class="col-sm-4 control-label" for="website">Website:</label>
 	<div class="col-sm-7"><span class="text-muted small"><em>
 	 <input type="name" class="form-control" placeholder="http://" rows="5"  value="'.$ds['website'].'" name="website"></em></span>
  </div>
  </div>
  <div class="form-group row">
 	<label class="col-sm-4 control-label" for="index">Index File (without extension, also no .php):</label>
 	<div class="col-sm-7"><span class="text-muted small"><em>
 	 <input type="name" class="form-control" placeholder="myplugin" rows="5"  value="'.$ds['index_link'].'" name="index"></em></span>
  </div>
  </div>
  <div class="form-group row">
 	<label class="col-sm-4 control-label" for="sclink">Widget_File (empty if not exists, else without extension):</label>
 	<div class="col-sm-7"><span class="text-muted small"><em>
 	 <input type="name" class="form-control" rows="5" placeholder="Widget_myplugin" value="'.$ds['sc_link'].'" name="sclink"></em></span>
  </div>
  </div>
  <div class="form-group row">
 	<label class="col-sm-4 control-label" for="hittenfiles">Hidden file(s) (seperate with "," [comma without space] ):</label>
 	<div class="col-sm-7"><span class="text-muted small"><em>
 	 <input type="name" class="form-control" rows="5" placeholder="myfile,secondfile,anotherfile" value="'.$ds['hiddenfiles'].'" name="hiddenfiles"></em></span>
  </div>
  </div>
  <div class="form-group row">
 	<label class="col-sm-4 control-label" for="version">Version:</label>
 	<div class="col-sm-7"><span class="text-muted small"><em>
 	 <input type="name" class="form-control" rows="5" value="'.$ds['version'].'" name="version"></em></span>
  </div>
  </div>
  <div class="form-group row">
 	<label class="col-sm-4 control-label" for="path">Folder Path: includes/plugins/myplugin/ (end with slash / )</label>
 	<div class="col-sm-7"><span class="text-muted small"><em>
 	 <input type="name" class="form-control" placeholder="includes/plugins/myplugin/"  value="'.$ds['path'].'" rows="5" name="path"></em></span>
  </div>
  </div>

  <div class="form-group row">
    <label class="col-sm-4 control-label">Activate?:</label>
    <div class="col-sm-7"><span class="text-muted small"><em>
		<input type="checkbox" name="activate" value="1" '.$acti.' ></em></span>
    </div>
  </div>



<!-- ################# Module ################################# -->


    <div class="form-group row">
<div class="col-sm-12">

    <p class="lead" style="text-align: center;">'.$_language->module['left_right_page'].' :</p>
    </div>
<div class="col-sm-2"></div>

<div class="col-sm-2">

     <label for="activated">'.$_language->module['deactivated'].'</label>
  '.$all_activated.'
<img class="img-thumbnail" src="../images/plugins/no_left_right_side_widget.jpg">
</div>
<div class="col-sm-2">
    <label for="le_activated">'.$_language->module['left_is_activated'].'</label>
  '.$le_activated.'
<img class="img-thumbnail" src="../images/plugins/left_side_widget.jpg">
</div>

<div class="col-sm-2">
    <label for="re_activated">'.$_language->module['right_is_activated'].'</label>
  '.$re_activated.'
<img class="img-thumbnail" src="../images/plugins/right_side_widget.jpg">
</div>

<div class="col-sm-2">
     <label for="deactivated">'.$_language->module['activated'].'</label>
  '.$all_deactivated.'
<img class="img-thumbnail" src="../images/plugins/left_right_side_widget.jpg">
</div>

<div class="col-sm-2"></div>

</div>

<div class="form-group row">
<div class="col-sm-2"></div>

<div class="col-sm-2">
<p class="lead">'.$_language->module['page_head'].' :</p>
 <label for="deactivated">'.$_language->module['activated'].'</label>
'.$head_activated.'
<img class="img-thumbnail" src="../images/plugins/page_head_widget.jpg">
</div>

<div class="col-sm-2">
<p class="lead">'.$_language->module['content_head'].' :</p>
<label for="deactivated">'.$_language->module['activated'].'</label>
'.$content_head_activated.'
<img class="img-thumbnail" src="../images/plugins/center_head_widget.jpg">
</div>

<div class="col-sm-2">
<p class="lead">'.$_language->module['content_foot'].' :</p>
<label for="deactivated">'.$_language->module['activated'].'</label>
'.$content_foot_activated.'
<img class="img-thumbnail" src="../images/plugins/center_footer_widget.jpg">
</div>

<div class="col-sm-4"><div class="col-sm-7">'.$_language->module['info'].'
   </div></div>

</div>

<div class="form-group row">
    <div class="col-sm-offset-2 col-sm-10">
    <input type="hidden" name="captcha_hash" value="'.$hash.'" />

    <button class="btn btn-warning" type="submit" name="saveedit"  />'.$_language->module['edit'].'</button>
    </div>
  </div>

</form>

</div>
  </div>';
return false;
	
}	
if($do=="new") {

  
	echo '<div class="card">
        <div class="card-header">
            <i class="fas fa-cogs"></i> '.$_language->module['plugin_manager'].'
        </div>
            
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="admincenter.php?site=plugin-manager">' . $_language->module['plugin_manager'] . '</a></li>
    <li class="breadcrumb-item active" aria-current="page">' . $_language->module['add_plugin'] . '</li>
  </ol>
</nav>
     <div class="card-body">';

  echo'<form class="form-horizontal" method="post" id="post" name="post" action="admincenter.php?site=plugin-manager" enctype="multipart/form-data" onsubmit="return chkFormular();"> 
  
  <div class="form-group row">
     <label class="col-sm-4 control-label" for="name">Name:</label>
    <div class="col-sm-7"><span class="text-muted small"><em>
    <input type="name" class="form-control" name="name" placeholder="name"></em></span>
  </div>
  </div>
  <div class="form-group row">
     <label class="col-sm-4 control-label" for="name">Description:</label>
    <div class="col-sm-7"><span class="text-muted small"><em>
    <input type="name" class="form-control" name="description" placeholder="description"></em></span>
  </div>
  </div>
  <div class="form-group row">
     <label class="col-sm-4 control-label" for="name">Modulname (for uninstall and widget):</label>
    <div class="col-sm-7"><span class="text-muted small"><em>
    <input type="name" class="form-control" name="modulname" placeholder="modulname"></em></span>
  </div>
  </div>
  <div class="form-group row">
 	<label class="col-sm-4 control-label" for="admin_file">Admin File:</label>
 	<div class="col-sm-7"><span class="text-muted small"><em>
 	 <input type="name" class="form-control" name="admin_file" placeholder="admin_file"></em></span>
  </div>
  </div>
  <div class="form-group row">
 	<label class="col-sm-4 control-label" for="author">Author:</label>
 	<div class="col-sm-7"><span class="text-muted small"><em>
 	 <input type="name" class="form-control" rows="5" name="author" placeholder="author"></em></span>
  </div>
  </div>
  <div class="form-group row">
 	<label class="col-sm-4 control-label" for="website">Website:</label>
 	<div class="col-sm-7"><span class="text-muted small"><em>
 	 <input type="name" class="form-control" placeholder="http://" rows="5" name="website"></em></span>
  </div>
  </div>
  <div class="form-group row">
 	<label class="col-sm-4 control-label" for="index">Index File (without extension, also no .php):</label>
 	<div class="col-sm-7"><span class="text-muted small"><em>
 	 <input type="name" class="form-control" placeholder="myplugin" rows="5" name="index"></em></span>
  </div>
  </div>
  <div class="form-group row">
 	<label class="col-sm-4 control-label" for="sclink">Widget_File (empty if not exists, else without extension):</label>
 	<div class="col-sm-7"><span class="text-muted small"><em>
 	 <input type="name" class="form-control" rows="5" placeholder="Widget_myplugin" name="sclink"></em></span>
  </div>
  </div>
  <div class="form-group row">
 	<label class="col-sm-4 control-label" for="hittenfiles">Hidden file(s) (seperate with "," [comma without space] ):</label>
 	<div class="col-sm-7"><span class="text-muted small"><em>
 	 <input type="name" class="form-control" rows="5" placeholder="myfile,secondfile,anotherfile" name="hiddenfiles"></em></span>
  </div>
  </div>
  <div class="form-group row">
 	<label class="col-sm-4 control-label" for="version">Version:</label>
 	<div class="col-sm-7"><span class="text-muted small"><em>
 	 <input type="name" class="form-control" rows="5" name="version"></em></span>
  </div>
  </div>
  <div class="form-group row">
 	<label class="col-sm-4 control-label" for="path">Folder Path: includes/plugins/myplugin/ (end with slash / )</label>
 	<div class="col-sm-7"><span class="text-muted small"><em>
 	 <input type="name" class="form-control" placeholder="includes/plugins/myplugin/" rows="5" name="path"></em></span>
  </div>
  </div>

<div class="form-group row">
    <label class="col-sm-4 control-label">Activate?:</label>
    <div class="col-sm-7"><span class="text-muted small"><em>
		<input type="checkbox" name="activate" value="1"></em></span>
    </div>
  </div>



    <!-- ################# Module ################################# -->


<div class="form-group row">
<div class="col-sm-12">

    <p class="lead" style="text-align: center;">'.$_language->module['left_right_page'].' :</p>
    </div>
<div class="col-sm-2"></div>

<div class="col-sm-2">
    <label for="activated">'.$_language->module['all_deactivated'].'</label>
  <input id="deactivated" type="radio" name="radio" value="all_activated">
<img class="img-thumbnail" src="../images/plugins/no_left_right_side_widget.jpg">
</div>
<div class="col-sm-2">
    <label for="le_activated">'.$_language->module['left_is_activated'].'</label>
  <input id="le_activated" type="radio" name="radio" value="le_activated">
<img class="img-thumbnail" src="../images/plugins/left_side_widget.jpg">
</div>
<div class="col-sm-2">
    <label for="re_activated">'.$_language->module['right_is_activated'].'</label>
  <input id="re_activated" type="radio" name="radio" value="re_activated">
<img class="img-thumbnail" src="../images/plugins/right_side_widget.jpg">
</div>
<div class="col-sm-2">
    <label for="activated">'.$_language->module['all_activated'].'</label>
  <input id="activated" type="radio" name="radio" value="all_deactivated">
<img class="img-thumbnail" src="../images/plugins/left_right_side_widget.jpg">
</div>

<div class="col-sm-2"></div>

</div>

<div class="form-group row">
<div class="col-sm-2"></div>

<div class="col-sm-2">
<p class="lead">'.$_language->module['page_head'].' :</p>
 <label for="deactivated">'.$_language->module['activated'].'</label>
 <input type="checkbox" name="head_activated" value="1">
<img class="img-thumbnail" src="../images/plugins/page_head_widget.jpg">
</div>

<div class="col-sm-2">
<p class="lead">'.$_language->module['content_head'].' :</p>
<label for="deactivated">'.$_language->module['activated'].'</label>
<input type="checkbox" name="content_head_activated" value="1">
<img class="img-thumbnail" src="../images/plugins/center_head_widget.jpg">
</div>

<div class="col-sm-2">
<p class="lead">'.$_language->module['content_foot'].' :</p>
<label for="deactivated">'.$_language->module['activated'].'</label>
<input type="checkbox" name="content_foot_activated" value="1">
<img class="img-thumbnail" src="../images/plugins/center_footer_widget.jpg">
</div>

<div class="col-sm-4"><div class="col-sm-7">'.$_language->module['info'].'
   </div></div>

</div>


<div class="form-group row">
    <div class="col-sm-offset-2 col-sm-10">
    
    <button class="btn btn-success" type="submit" name="svn"  />' . $_language->module['add'] . '</button>
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
      <a href="admincenter.php?site=plugin-manager&do=new" class="btn btn-primary" type="button">' . $_language->module[ 'new_plugin' ] . '</a>
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
                    '<a href="admincenter.php?site=plugin-manager&id='.$ds['pluginID'].'&do=dea" class="btn btn-info" type="button">' . $_language->module[ 'deactivate' ] . '</a>';
            } else {
                $actions = '<a href="admincenter.php?site=plugin-manager&id='.$ds['pluginID'].'&do=act" class="btn btn-success" type="button">' . $_language->module[ 'activate' ] . '</a>';
            }

      $translate = new multiLanguage(detectCurrentLanguage());
            $translate->detectLanguages($ds['description']);
            $ds['description'] = $translate->getTextByLanguage($ds['description']);


            #$ds['description'] = htmloutput($ds['description']), 1;
            #$ds['description'] = $ds['description'], 1;

    echo'<tr>
        <td>'.$ds['pluginID'].'</td>
        <td><b>'.$ds['name'].'</b></td>
        <td>'.$ds['description'].'</td>
        <td>'.$actions.'</td>
        <td width="16%">
        
<a href="admincenter.php?site=plugin-manager&id='.$ds['pluginID'].'&do=edit" class="btn btn-warning" type="button">' . $_language->module[ 'edit' ] . '</a>


             <input class="btn btn-danger" type="button" onclick="MM_confirm(\'' . $_language->module['really_delete'] . '\', \'admincenter.php?site=plugin-manager&id='.$ds['pluginID'].'&do=del&amp;captcha_hash='.$hash.'\')" value="' . $_language->module['delete'] . '" /> 



</td>
      </tr>';
      
 }     

    echo'</table>';
  

echo '</div></div>';








?>

