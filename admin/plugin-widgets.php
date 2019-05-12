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
$_language->readModule('widgets', false, true);


if (!ispageadmin($userID) || mb_substr(basename($_SERVER[ 'REQUEST_URI' ]), 0, 15) != "admincenter.php") {
    die($_language->module[ 'access_denied' ]);
}
	chdir("../system/");
	
	
	$plugin_class = new widgets();
	
	echo'<div class="panel panel-default">
    <div class="panel-heading">
                            <i class="fa fa-arrows"></i> ' . $_language->module[ 'widget' ] . '
                        </div>
                        
	
<div class="panel-body">';
	

	if(isset($_GET['action'])){
		$action = $_GET['action'];
		if($action == "manager" && isset($_POST['position'])){
			$position = $_POST['position'];
			if(isset($_POST['delete'])){
				if($plugin_class->deletePosition($position)){
					echo'' . $_language->module[ 'delete_done' ] . '';
					redirect("admincenter.php?site=plugin-widgets", "", 3);
				}else{
					echo'' . $_language->module[ 'delete_error' ] . '';
					redirect("admincenter.php?site=plugin-widgets", "", 3);
				}
			}else if(isset($_POST['add'])){
				if(isset($_POST['save'])){
					$widget_file = $_POST['selected_widget'];
					$position = $_POST['position'];
					$sort = $_POST['sort'];
					if($plugin_class->insertWidgetToPosition($position, $widget_file, $sort)){
						echo'' . $_language->module[ 'add_done' ] . '';
						redirect("admincenter.php?site=plugin-widgets", "", 3);
					}else{
						echo'' . $_language->module[ 'add_error' ] . '';
						redirect("admincenter.php?site=plugin-widgets", "", 3);
					}
				}else{
					////////////////
					$all_plugins = $plugin_class->getPlugins();
					$select_options = "";
					if(count($all_plugins)>0){
						$select_options = "<select class='form-control' name='selected_widget'>";
						foreach($all_plugins as $plugin){
							$select_options .= "<optgroup label='".$plugin['plugin']['info']['name']."'>";
								$widgets = $plugin['plugin']['widgets'];
								foreach($widgets as $widget){
									$select_options .= "<option value='$widget'>$widget</option>";
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

					

echo'<form class="form col-sm-8" method="post" action="admincenter.php?site=plugin-widgets&action=manager">

	<input type="hidden" name="position" value="'.$position.'" />
	<input type="hidden" name="add" value="justdoit" />
	<div class="form-group row text-right">
		<label class="control-label col-sm-4">' . $_language->module[ 'sort' ] . '</label>
		<div class="col-sm-8">
			'.$sort.'
		</div>
	</div>
	<div class="form-group row text-right">
		<label class="control-label col-sm-4">' . $_language->module[ 'avaible_widgets' ] . '</label>
		<div class="col-sm-8">
			'.$select_options.'
		</div>
	</div>
	<div class="form-group row text-right">
		<div class="col-sm-4">
		</div>
		<div class="col-sm-8">
			<input type="submit" name="save" class="form-control btn btn-success" value="' . $_language->module[ 'save' ] . '" />
		</div>
	</div>
</form>';
				}
			}
		}else if($action=="managemulti"){
			if(isset($_POST['delete_row'])){
				$id = $_POST['delete_row'];
				$plugin_class->deleteWidgetByID($id);
				echo'' . $_language->module[ 'delete_done' ] . '';
					redirect("admincenter.php?site=plugin-widgets", "", 3);

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
		if(count($allPositions)>0){
			foreach($allPositions as $position){

				

echo'<div class="row card">

<div class="col-sm-2"><img class="img-responsive" src="../images/plugins/'.$position['position'].'.jpg"></div>
<div class="col-sm-10"><table class="table table-striped">
		<thead>
			<tr>
				<th>'.$_language->module[ 'widget_files' ].' ('.$plugin_class->countAllWidgetsOfPosition($position['position']).')</th>
				<th>'.$position['description'].'</th>
				<th width="30%"></th>
				<th>
					<form method="post" action="admincenter.php?site=plugin-widgets&action=manager">
						<input type="hidden" name="position" value="'.$position['position'].'"/>
						<button type="submit" name="add" class="btn btn-success">'.$_language->module[ 'add_widget' ].'</button>
					</form>
				</th>
			</tr>
		</thead>
		<tbody>';
				
				
				$allWidgetsOfCurrPosition = $plugin_class->getAllWidgetsOfPosition($position['position']);
				$ctn_all_widgets_of_curr_position = count($allWidgetsOfCurrPosition);
				

echo'<form method="post" action="admincenter.php?site=plugin-widgets&action=managemulti">
<table class="table">
	<thead>
		<tr>
			<th><b>Plugin Name</b></th>
			<th><b>'.$_language->module[ 'plugin_folder' ].'</b></th>
			<th><b>'.$_language->module[ 'widget_file' ].'</b></th>
			<th><b>'.$_language->module[ 'createdate' ].'</b></th>
			
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
		<td>'.$widget['widget_file'].'</td>
		<td>'.$widget['create_date'].'</td>
		
		<td><button name="delete_row" type="submit" class="btn btn-danger" value="'.$id.'">'.$_language->module[ 'delete' ].'</button></td>
		<td class="row">
				'.$sort.'
		</td>
	</tr>';

				}
				

echo'</tbody>
	<tfoot>
		<tr>
			<td colspan="4">
			</td>
			<td>
				<button name="sorting" class="btn btn-success">'.$_language->module[ 'sorting' ].'</button>
			</td>
			
		</tr>
	</tfoot>
</table>
</form>';

		
				
		echo'</div></div>';
			}
		}
	}
?>