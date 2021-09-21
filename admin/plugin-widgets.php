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

$_language->readModule('widgets', false, true);


$ergebnis = safe_query("SELECT * FROM ".PREFIX."navigation_dashboard_links WHERE modulname='widgets'");
    while ($db=mysqli_fetch_array($ergebnis)) {
      $accesslevel = 'is'.$db['accesslevel'].'admin';

if (!$accesslevel($userID) || mb_substr(basename($_SERVER[ 'REQUEST_URI' ]), 0, 15) != "admincenter.php") {
    die($_language->module[ 'access_denied' ]);
}
}
	chdir("../system/");
	
	$plugin_class = new widgets();
	
	if(isset($_GET['action'])){
		$action = $_GET['action'];
		if($action == "manager" && isset($_POST['position'])){
			$position = $_POST['position'];
			if(isset($_POST['delete'])){
				if($plugin_class->deletePosition($position)){
					echo'' . $_language->module[ 'delete_done' ] . '';
					redirect("admincenter.php?site=plugin-widgets", "", 2);
				}else{
					echo'' . $_language->module[ 'delete_error' ] . '';
					redirect("admincenter.php?site=plugin-widgets", "", 2);
				}
			}else if(isset($_POST['add'])){
				if(isset($_POST['save'])){
					$widget_file = $_POST['selected_widget'];
					$position = $_POST['position'];
					$description = $_POST['position'];
					$sort = $_POST['sort'];
					if($plugin_class->insertWidgetToPosition($position, $description, $widget_file, $sort)){
						echo'' . $_language->module[ 'add_done' ] . '';
						redirect("admincenter.php?site=plugin-widgets", "", 2);
					}else{
						echo'' . $_language->module[ 'add_error' ] . '';
						redirect("admincenter.php?site=plugin-widgets", "", 2);
					}
				}else{
					////////////////
					$all_plugins = $plugin_class->getPlugins();
					$select_options = "";
					if(count($all_plugins)>1){
						$select_options = "<select class='form-control' name='selected_widget' onfocus='this.size=25;' onblur='this.size=0;' onchange='this.size=1; this.blur();'>";
						foreach($all_plugins as $plugin){
							$select_options .= "<optgroup style='background-color: rgba(243,243,243,1);margin: 5px;border: 1px solid #ddd;' label='&nbsp;".$plugin['plugin']['info']['name']."'>";
								@$name1 = $plugin['plugin']['info1']['name1'];
								@$widgetname1 = $plugin['plugin']['info1']['widgetname1'];
								@$modulname = $plugin['plugin']['info']['modulname'];
								@$widgets1 = $plugin['plugin']['widgets1'];
								@$name2 = $plugin['plugin']['info2']['name2'];
								@$widgetname2 = $plugin['plugin']['info2']['widgetname2'];
								$modulname = $plugin['plugin']['info']['modulname'];
								@$widgets2 = $plugin['plugin']['widgets2'];
								@$name3 = $plugin['plugin']['info3']['name3'];
								@$widgetname3 = $plugin['plugin']['info3']['widgetname3'];
								$modulname = $plugin['plugin']['info']['modulname'];
								@$widgets3 = $plugin['plugin']['widgets3'];
								foreach((array)$widgets1 as $widget){
									$select_options .= "<option value='$widget'>$name1 ($widgetname1)</option>";
								}
								foreach((array)$widgets2 as $widget){
									$select_options .= "<option value='$widget'>$name2 ($widgetname2)</option>";
								}
								foreach((array)$widgets3 as $widget){
									$select_options .= "<option value='$widget'>$name3 ($widgetname3)</option>";
								}


								
							$select_options .= "</optgroup>";
						}
						$select_options .= "</select>";
					}
					//////////////////
					$sort = "<select class='form-control' name='sort'>";
						for($i = $plugin_class->countAllWidgetsOfPosition($position)+1; $i > 0; $i--){
							$sort .= "<option valuue='$i'>$i</option>";
						}
					$sort .= "</select>";

	echo'<div class="card">
        <div class="card-header">
            <i class="fas fa-arrows-alt"></i> ' . $_language->module[ 'widget' ] . '
        </div>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="admincenter.php?site=plugin-widgets">' . $_language->module['widget'] . '</a></li>
    <li class="breadcrumb-item active" aria-current="page">new & edit</li>
  </ol>
</nav>

<div class="card-body">
<div class="row">';				

echo'<form class="form col-md-8" method="post" action="admincenter.php?site=plugin-widgets&action=manager">

	<input type="hidden" name="position" value="'.$position.'" />
	<input type="hidden" name="add" value="justdoit" />
	<div class="form-group row text-right">
		<label class="control-label col-md-4">' . $_language->module[ 'sort' ] . '</label>
		<div class="col-md-8">
			'.$sort.'
		</div>
	</div>
	<div class="form-group row text-right">
		<label class="control-label col-md-4">' . $_language->module[ 'avaible_widgets' ] . '</label>
		<div class="col-md-8">
			'.$select_options.'
		</div>
	</div>
	<div class="form-group row text-right">
		<div class="col-md-4">
		</div>
		<div class="col-md-8">
			<input type="submit" name="save" class="form-control btn btn-success" value="' . $_language->module[ 'save' ] . '" />
		</div>
	</div>
</form>
</div>
	</div></div>';
				}
			}
		}else if($action=="managemulti"){
				
			if(isset($_POST['delete_row'])){
				$id = $_POST['delete_row'];
				$plugin_class->deleteWidgetByID($id);
				echo'' . $_language->module[ 'delete_done' ] . '';
					redirect("admincenter.php?site=plugin-widgets", "", 2);

			}else if(isset($_POST['sorting'])){
				#$sorts = $_POST['sort'];
				$sorts = (isset($_POST['sort'])) ? $_POST['sort'] : 'ASC';
				foreach($sorts as $id=>$sort){
					$plugin_class->sortwidget($id, $sort);
				}
				redirect("admincenter.php?site=plugin-widgets", "", 0);
			}
		}
	}else{
		$allPositions = $plugin_class->getAllWidgetsPositions(); 
		echo'<div class="card">
        <div class="card-header">
            <i class="fas fa-arrows-alt"></i> ' . $_language->module[ 'widget' ] . '
        </div>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="admincenter.php?site=plugin-widgets">' . $_language->module['widget'] . '</a></li>
    <li class="breadcrumb-item active" aria-current="page">new & edit</li>
  </ol>
</nav>

<div class="card-body">';	

		if(count($allPositions)>0){
			foreach($allPositions as $position){

				

echo'<div class="card">
<div class="card-body">
<div class="row">

<div class="col-md-2"><img style="height: 250px" class="img-fluid" src="../images/plugins/'.$position['position'].'.jpg"></div>
<div class="col-md-10"><table class="table table-striped">
		<thead>
			
				<th width="50%"><h4>'.$position['description'].'</h4></th>
				<th width="20%"><p>'.$_language->module[ 'widget_files' ].' ('.$plugin_class->countAllWidgetsOfPosition($position['position']).')</p></th>
				<th width="30%"></th>
				<!--<th width="10%"></th>-->
				<th width="10%">
					<form method="post" action="admincenter.php?site=plugin-widgets&action=manager">
						<input type="hidden" name="position" value="'.$position['position'].'"/>
						<button type="submit" name="add" class="btn btn-success">'.$_language->module[ 'add_widget' ].'</button>
					</form>
				</th>
';
				
				$allWidgetsOfCurrPosition = $plugin_class->getAllWidgetsOfPosition($position['position']);
				$ctn_all_widgets_of_curr_position = count($allWidgetsOfCurrPosition);
				

echo'<form method="post" action="admincenter.php?site=plugin-widgets&action=managemulti">

		<tr>
			<th><b>'.$_language->module[ 'plugin_name' ].'</b></th>
			<th><b>'.$_language->module[ 'plugin_folder' ].'</b></th>
			<th><b>'.$_language->module[ 'actions' ].'</b></th>
			<th><b>'.$_language->module[ 'sort' ].'</b></th>
		</tr>
	</thead>
	<tbody>';

					foreach($allWidgetsOfCurrPosition as $widget){
					$sort_number = $widget['sort'];
					$id = $widget['id'];
					$sort = "<select name='sort[$id]'>";
						for($i = 0; $i <= $ctn_all_widgets_of_curr_position; $i++){
							$selected = "";
							if($i==$sort_number){
								$selected = "selected";
							}
							$sort .= "<option value='$i' $selected>$i</option>";
						}
					$sort .= "</select>";
					
echo'<tr>
		<td>'.$widget['name'].'</td>
		<td>'.$widget['plugin_folder'].'</td>
		<td>';
		
$ergebnis = safe_query("SELECT * FROM " . PREFIX . "plugins WHERE `modulname`='".$widget['modulname']."' ORDER BY `pluginID`='".$id."'");
    while ($ds = mysqli_fetch_array($ergebnis)) {
        $activity = $ds[ 'pluginID' ];
	}

echo'<a href="admincenter.php?site=plugin-manager&id='.$activity.'&do=edit" class="btn btn-warning" type="button">' . $_language->module[ 'edit' ] . '</a>
		<button name="delete_row" type="submit" class="btn btn-danger" value="'.$id.'">'.$_language->module[ 'delete' ].'</button></td>
		<td>
				'.$sort.'
		</td>
	</tr>';
}
				
echo'</tbody>
	<tfoot>
		<tr>
			<td colspan="3">
			</td>
			<td>
				<button name="sorting" class="btn btn-success">'.$_language->module[ 'sorting' ].'</button>
			</td>
			
		</tr>
		
	</tfoot>
</table>
</form></div></div>

</div></div><br>

';

			}
		}
	}
	echo'</div></div>';
?>