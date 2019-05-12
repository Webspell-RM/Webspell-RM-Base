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

/*
 * Plugin-Manager v1.3
 * 
 * This is the first simple management for addons or modifications.
 * For a detailed documentation visit the authors website or ask 
 * in the notified board. 
 *
 * @author: Matti <Getschonnik> W. | info@Getschonnik.de
 * @version: 1.3
 * @package: plugin-Manager
 * @website: www.webSPELL-NOR.de
 */

 ?>

<style type="text/css">
.pato15 { padding-top: 15px; }
</style>
<?php
$_language->readModule('plugin-manager', false, true);

if (!ispageadmin($userID) || mb_substr(basename($_SERVER[ 'REQUEST_URI' ]), 0, 15) != "admincenter.php") {
    die($_language->module[ 'access_denied' ]);
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

if(isset($_REQUEST['svn'])) {
	if(isset($_REQUEST['activate'])) { $acti = 1; } else { $acti = 0; }
	try {
		safe_query("INSERT INTO `".PREFIX."plugins` (`pluginID`, `name`, `description`, `activate`, `admin_file`, `author`, `website`, `index_link`, `sc_link`, `hiddenfiles`, `version`, `path`) VALUES (NULL, '".$_REQUEST['name']."', '".$_REQUEST['description']."', '".$acti."', '".$_REQUEST['admin_file']."', '".$_REQUEST['author']."', '".$_REQUEST['website']."', '".$_REQUEST['index']."', '".$_REQUEST['sclink']."', '".$_REQUEST['hiddenfiles']."', '".$_REQUEST['version']."', '".$_REQUEST['path']."');");
		echo $_language->module[ 'success_save' ]."<br /><br />";	
		redirect("admincenter.php?site=plugin-manager", 3); return false;
	} CATCH (Exception $e) {
		echo $_language->module[ 'failed_save' ]."<br /><br />".$e->getMessage();	
		redirect("admincenter.php?site=plugin-manager", 5); return false;
	}
return false;	
}
if(isset($_REQUEST['sve'])) {
	if(isset($_REQUEST['activate'])) { $acti = 1; } else { $acti = 0; }
	try {
		safe_query("UPDATE `".PREFIX."plugins` SET `name` = '".$_REQUEST['name']."', `description` = '".$_REQUEST['description']."', `activate` = '".$acti."', `admin_file` = '".$_REQUEST['admin_file']."', `author` = '".$_REQUEST['author']."', `website` = '".$_REQUEST['website']."', `index_link` = '".$_REQUEST['index']."', `sc_link` = '".$_REQUEST['sclink']."', `hiddenfiles` = '".$_REQUEST['hiddenfiles']."', `version` = '".$_REQUEST['version']."', `path` = '".$_REQUEST['path']."' WHERE `pluginID` = '".intval($_REQUEST['pid'])."';");
		echo $_language->module[ 'success_edit' ]."<br /><br />";	
		redirect("admincenter.php?site=plugin-manager", 3); return false;
	} CATCH (Exception $e) {
		echo $_language->module[ 'failed_edit' ]."<br /><br />".$e->getMessage();	
		redirect("admincenter.php?site=plugin-manager", 5); return false;
	}
return false;	
}
if($do=="edit") {
	try {
		$res = safe_query("SELECT * FROM `".PREFIX."plugins` WHERE `pluginID`='".$id."' LIMIT 1");
		$row = mysqli_fetch_array($res);
		if($row['activate'] == 1) { $acti = 'checked="checked"'; } else { $acti = ""; }
	} CATCH (Exception $e) {
			echo $e->getMessage();
		return false;	
	}
	echo '
	<div class="panel panel-default">
  <div class="panel-heading">

                              <i class="fa fa-cogs"></i> '.$_language->module['plugin_manager'].'
                        </div>
                        <div class="panel-body">
    <a href="admincenter.php?site=plugin-manager" class="white">' . $_language->module['plugin_manager'] . '</a> &raquo; Plugin edit<br><br>';

  echo'
	
	 	 <form class="form-horizontal" method="post" id="post" name="post" action="admincenter.php?site=plugin-manager" enctype="multipart/form-data" onsubmit="return chkFormular();"> 
  
  <div class="form-group">
  	<input type="hidden" name="pid" value="'.$row['pluginID'].'" />
    <label class="col-sm-4 control-label" for="name">Name:</label>
    <div class="col-sm-8"><span class="text-muted small"><em>
    <input type="name" class="form-control" name="name" value="'.$row['name'].'"></em></span>
  </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label" for="name">Description:</label>
    <div class="col-sm-8"><span class="text-muted small"><em>
    <input type="name" class="form-control" name="description" value="'.$row['description'].'"></em></span>
  </div>
  </div>
  <div class="form-group">
 	<label class="col-sm-4 control-label" for="admin_file">Admin file:</label>
 	<div class="col-sm-8"><span class="text-muted small"><em>
 	 <input type="name" class="form-control"  name="admin_file" value="'.$row['admin_file'].'"></em></span>
  </div>
  </div>
  <div class="form-group">
 	<label class="col-sm-4 control-label" for="author">Author:</label>
 	<div class="col-sm-8"><span class="text-muted small"><em>
 	 <input type="name" class="form-control" rows="5" name="author" value="'.$row['author'].'"></em></span>
  </div>
  </div>
  <div class="form-group">
 	<label class="col-sm-4 control-label" for="website">Website:</label>
 	<div class="col-sm-8"><span class="text-muted small"><em>
 	 <input type="name" class="form-control" placeholder="http://" rows="5"  value="'.$row['website'].'" name="website"></em></span>
  </div>
  </div>
  <div class="form-group">
 	<label class="col-sm-4 control-label" for="index">Index File (without extension, also no .php):</label>
 	<div class="col-sm-8"><span class="text-muted small"><em>
 	 <input type="name" class="form-control" placeholder="myplugin" rows="5"  value="'.$row['index_link'].'" name="index"></em></span>
  </div>
  </div>
  <div class="form-group">
 	<label class="col-sm-4 control-label" for="sclink">sc_ File (empty if not exists, else without extension):</label>
 	<div class="col-sm-8"><span class="text-muted small"><em>
 	 <input type="name" class="form-control" rows="5" placeholder="sc_myplugin" value="'.$row['sc_link'].'" name="sclink"></em></span>
  </div>
  </div>
  <div class="form-group">
 	<label class="col-sm-4 control-label" for="hittenfiles">Hidden file(s) (seperate with "," [comma without space] ):</label>
 	<div class="col-sm-8"><span class="text-muted small"><em>
 	 <input type="name" class="form-control" rows="5" placeholder="myfile,secondfile,anotherfile" value="'.$row['hiddenfiles'].'" name="hiddenfiles"></em></span>
  </div>
  </div>
  <div class="form-group">
 	<label class="col-sm-4 control-label" for="version">Version:</label>
 	<div class="col-sm-8"><span class="text-muted small"><em>
 	 <input type="name" class="form-control" rows="5" value="'.$row['version'].'" name="version"></em></span>
  </div>
  </div>
  <div class="form-group">
 	<label class="col-sm-4 control-label" for="path">Folder Path: (end with slash / )</label>
 	<div class="col-sm-8"><span class="text-muted small"><em>
 	 <input type="name" class="form-control" placeholder="includes/plugins/myplugin/"  value="'.$row['path'].'" rows="5" name="path"></em></span>
  </div>
  </div>

  <div class="form-group">
    <label class="col-sm-4 control-label">Activate?:</label>
    <div class="col-sm-8"><span class="text-muted small"><em>
		<input type="checkbox" name="activate" value="1" '.$acti.' ></em></span>
    </div>
  </div>

<div class="form-group">
    <div class="col-sm-offset-4 col-sm-8">
		
		<button class="btn btn-success" type="submit" name="sve"  />Save</button>
    </div>
  </div>



  
</form>
</div>
  </div>';
return false;
	
}	
if($do=="new") {
	echo '
	<div class="panel panel-default">
  <div class="panel-heading">

                              <i class="fa fa-cogs"></i> '.$_language->module['plugin_manager'].'
                        </div>
                        <div class="panel-body">
    <a href="admincenter.php?site=plugin-manager" class="white">' . $_language->module['plugin_manager'] . '</a> &raquo; Plugin hinzufügen<br><br>';

  echo'

	 
	 <form class="form-horizontal" method="post" id="post" name="post" action="admincenter.php?site=plugin-manager" enctype="multipart/form-data" onsubmit="return chkFormular();"> 
  
  <div class="form-group">
     <label class="col-sm-4 control-label" for="name">Name:</label>
    <div class="col-sm-8"><span class="text-muted small"><em>
    <input type="name" class="form-control" name="name"></em></span>
  </div>
  </div>
  <div class="form-group">
     <label class="col-sm-4 control-label" for="name">Description:</label>
    <div class="col-sm-8"><span class="text-muted small"><em>
    <input type="name" class="form-control" name="description"></em></span>
  </div>
  </div>
  <div class="form-group">
 	<label class="col-sm-4 control-label" for="admin_file">Admin File:</label>
 	<div class="col-sm-8"><span class="text-muted small"><em>
 	 <input type="name" class="form-control" name="admin_file"></em></span>
  </div>
  </div>
  <div class="form-group">
 	<label class="col-sm-4 control-label" for="author">Author:</label>
 	<div class="col-sm-8"><span class="text-muted small"><em>
 	 <input type="name" class="form-control" rows="5" name="author"></em></span>
  </div>
  </div>
  <div class="form-group">
 	<label class="col-sm-4 control-label" for="website">Website:</label>
 	<div class="col-sm-8"><span class="text-muted small"><em>
 	 <input type="name" class="form-control" placeholder="http://" rows="5" name="website"></em></span>
  </div>
  </div>
  <div class="form-group">
 	<label class="col-sm-4 control-label" for="index">Index File (without extension, also no .php):</label>
 	<div class="col-sm-8"><span class="text-muted small"><em>
 	 <input type="name" class="form-control" placeholder="myplugin" rows="5" name="index"></em></span>
  </div>
  </div>
  <div class="form-group">
 	<label class="col-sm-4 control-label" for="sclink">sc_ File (empty if not exists, else without extension):</label>
 	<div class="col-sm-8"><span class="text-muted small"><em>
 	 <input type="name" class="form-control" rows="5" placeholder="sc_myplugin" name="sclink"></em></span>
  </div>
  </div>
  <div class="form-group">
 	<label class="col-sm-4 control-label" for="hittenfiles">Hidden file(s) (seperate with "," [comma without space] ):</label>
 	<div class="col-sm-8"><span class="text-muted small"><em>
 	 <input type="name" class="form-control" rows="5" placeholder="myfile,secondfile,anotherfile" name="hiddenfiles"></em></span>
  </div>
  </div>
  <div class="form-group">
 	<label class="col-sm-4 control-label" for="version">Version:</label>
 	<div class="col-sm-8"><span class="text-muted small"><em>
 	 <input type="name" class="form-control" rows="5" name="version"></em></span>
  </div>
  </div>
  <div class="form-group">
 	<label class="col-sm-4 control-label" for="path">Folder Path: (end with slash / )</label>
 	<div class="col-sm-8"><span class="text-muted small"><em>
 	 <input type="name" class="form-control" placeholder="includes/plugins/myplugin/" rows="5" name="path"></em></span>
  </div>
  </div>

<div class="form-group">
    <label class="col-sm-4 control-label">Activate?:</label>
    <div class="col-sm-8"><span class="text-muted small"><em>
		<input type="checkbox" name="activate" value="1"></em></span>
    </div>
  </div>

<div class="form-group">
    <div class="col-sm-offset-4 col-sm-8">
		
		<button class="btn btn-success" type="submit" name="svn"  />Save</button>
    </div>
  </div>
 



  
</form></div></div>';
return false;
	
}	
			
echo'<div class="panel panel-default">
  <div class="panel-heading">

                              <i class="fa fa-cogs"></i> '.$_language->module['plugin_manager'].'
                        </div>
                        <div class="panel-body">';

?>	

<a href="admincenter.php?site=plugin-manager&do=new" class="btn btn-primary" type="button"><?php echo $_language->module[ 'new_plugin' ]; ?></a>
<br /><br />


<div class="panel panel-default">
  <div class="panel-heading">
                            <i class="fa fa-credit-card"></i> <?php echo $_language->module[ 'activated' ]; ?>
                        </div>
                        <div class="panel-body">
<div class="row">
  <div class="col-sm-1"><strong><?php echo $_language->module[ 'plugin' ]; ?> <?php echo $_language->module[ 'id' ]; ?></strong></div>
  <div class="col-sm-3"><strong><?php echo $_language->module[ 'plugin' ]; ?> <?php echo $_language->module[ 'name' ]; ?></strong></div>
  <div class="col-sm-5"><strong><?php echo $_language->module[ 'plugin' ]; ?> <?php echo $_language->module[ 'description' ]; ?></strong></div>
  <div class="col-sm-3"><strong>Plugin Manager <?php echo $_language->module[ 'option' ]; ?></strong></div>
</div>
<hr>
<?php 
$CAPCLASS = new \webspell\Captcha;
    $CAPCLASS->createTransaction();
    $hash = $CAPCLASS->getHash();
	# query activated first
	
	$res=safe_query("SELECT * FROM `".PREFIX."plugins` WHERE `activate`=1 ORDER BY `pluginID` ");
	if(mysqli_num_rows($res)) {
		while($row=mysqli_fetch_array($res)) {

			$translate = new multiLanguage(detectCurrentLanguage());
            $translate->detectLanguages($row['description']);
            $row['description'] = $translate->getTextByLanguage($row['description']);


            $row['description'] = toggle(htmloutput($row['description']), 1);
            $row['description'] = toggle($row['description'], 1);


			echo '
  <div class="row">

  				<div class="col-sm-1">'.$row['pluginID'].'</div>
 				 <div class="col-sm-3"><b>'.$row['name'].'</b></div>
 				 <div class="col-sm-5">'.$row['description'].'</strong></div>
 				 <div class="col-sm-3">

<a href="admincenter.php?site=plugin-manager&id='.$row['pluginID'].'&do=dea" class="hidden-xs hidden-sm btn btn-danger" type="button">' . $_language->module[ 'deactivate' ] . '</a>
<a href="admincenter.php?site=plugin-manager&id='.$row['pluginID'].'&do=dea" class="mobile visible-xs visible-sm" type="button"><span class="fa fa-eye-slash"></span></a>

&nbsp;

<a href="admincenter.php?site=plugin-manager&id='.$row['pluginID'].'&do=edit" class="hidden-xs hidden-sm btn btn-warning" type="button">' . $_language->module[ 'edit' ] . '</a>
<a href="admincenter.php?site=plugin-manager&id='.$row['pluginID'].'&do=edit" class="mobile visible-xs visible-sm" type="button"><i class="fa fa-pencil"></i></a>

&nbsp;

<input class="hidden-xs hidden-sm btn btn-danger" type="button" onclick="MM_confirm(\'' . $_language->module['really_delete'] . '\', \'admincenter.php?site=plugin-manager&id='.$row['pluginID'].'&do=del&amp;captcha_hash='.$hash.'\')" value="' . $_language->module['delete'] . '" />
<a class="mobile visible-xs visible-sm" type="button" onclick="MM_confirm(\'' . $_language->module['really_delete'] . '\', \'admincenter.php?site=plugin-manager&id='.$row['pluginID'].'&do=del&amp;captcha_hash='.$hash.'\')" /><i class="fa fa-times"></i></a>
</div>
				</div><hr>';
		}
	}
	# query deactivated
		
echo'</div>
</div>

<div class="panel panel-default">
  <div class="panel-heading">
                            <i class="fa fa-credit-card"></i> '.$_language->module['deactivated'].'
                        </div>
                        <div class="panel-body">';
?>

<br /><br />
<div class="row"><div class="col-sm-1"><strong><?php echo $_language->module[ 'plugin' ]; ?> <?php echo $_language->module[ 'id' ]; ?></strong></div>
  <div class="col-sm-3"><strong><?php echo $_language->module[ 'plugin' ]; ?> <?php echo $_language->module[ 'name' ]; ?></strong></div>
  <div class="col-sm-5"><strong><?php echo $_language->module[ 'plugin' ]; ?> <?php echo $_language->module[ 'description' ]; ?></strong></div>
  <div class="col-sm-3"><strong>Plugin Manager <?php echo $_language->module[ 'option' ]; ?></strong></div>
</div>
<hr>
<?php 
$CAPCLASS = new \webspell\Captcha;
    $CAPCLASS->createTransaction();
    $hash = $CAPCLASS->getHash();



	$res=safe_query("SELECT * FROM `".PREFIX."plugins` WHERE `activate`=0 ORDER BY `pluginID` ");
	if(mysqli_num_rows($res)) {
		while($row=mysqli_fetch_array($res)) {
			echo '<div class="row">
  				<div class="col-sm-1">'.$row['pluginID'].'</div>
 				 <div class="col-sm-3"><b>'.$row['name'].'</b></div>
 				 <div class="col-sm-5">'.$row['description'].'</strong></div>
 				 <div class="col-sm-3">
 				 <a href="admincenter.php?site=plugin-manager&id='.$row['pluginID'].'&do=act" class="hidden-xs hidden-sm btn btn-success" type="button">' . $_language->module[ 'activate' ] . '</a>
<a href="admincenter.php?site=plugin-manager&id='.$row['pluginID'].'&do=act" class="mobile visible-xs visible-sm" type="button"><span class="fa fa-eye-slash"></span></a>

&nbsp;

<a href="admincenter.php?site=plugin-manager&id='.$row['pluginID'].'&do=edit" class="hidden-xs hidden-sm btn btn-warning" type="button">' . $_language->module[ 'edit' ] . '</a>
<a href="admincenter.php?site=plugin-manager&id='.$row['pluginID'].'&do=edit" class="mobile visible-xs visible-sm" type="button"><i class="fa fa-pencil"></i></a>

&nbsp;

<input class="hidden-xs hidden-sm btn btn-danger" type="button" onclick="MM_confirm(\'' . $_language->module['really_delete'] . '\', \'admincenter.php?site=plugin-manager&id='.$row['pluginID'].'&do=del&amp;captcha_hash='.$hash.'\')" value="' . $_language->module['delete'] . '" />
<a class="mobile visible-xs visible-sm" type="button" onclick="MM_confirm(\'' . $_language->module['really_delete'] . '\', \'admincenter.php?site=plugin-manager&id='.$row['pluginID'].'&do=del&amp;captcha_hash='.$hash.'\')" /><i class="fa fa-times"></i></a>
</div>
</div><hr>
				';
		}
	}
?>






