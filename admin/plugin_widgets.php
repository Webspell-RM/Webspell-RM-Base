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


$_language->readModule('widgets', false, true);


$ergebnis = safe_query("SELECT * FROM ".PREFIX."navigation_dashboard_links WHERE modulname='ac_widgets'");
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
		global $themes_modulname;
		if($action == "manager" && isset($_POST['position'])){
			$position = $_POST['position'];
			if(isset($_POST['delete'])){
				if($plugin_class->deletePosition($position)){
					echo'' . $_language->module[ 'delete_done' ] . '';
					redirect("admincenter.php?site=plugin_widgets", "", 2);
				}else{
					echo'' . $_language->module[ 'delete_error' ] . '';
					redirect("admincenter.php?site=plugin_widgets", "", 2);
				}
			}else if(isset($_POST['add'])){
				if(isset($_POST['save'])){
					$widget_file = $_POST['selected_widget'];
					$position = $_POST['position'];
					$description = $_POST['position'];
					$sort = $_POST['sort'];
					if($plugin_class->insertWidgetToPosition($position, $description, $widget_file, $sort)){
						echo'' . $_language->module[ 'add_done' ] . '';
						redirect("admincenter.php?site=plugin_widgets", "", 2);
					}else{
						echo'' . $_language->module[ 'add_error' ] . '';
						redirect("admincenter.php?site=plugin_widgets", "", 2);
					}
				}else{
					////////////////
					$all_plugins = $plugin_class->getPlugins();
					$select_options = "";
					if(count($all_plugins)>0){
						$select_options = "<select class='form-control' name='selected_widget' onfocus='this.size=25;' onblur='this.size=0;' onchange='this.size=1; this.blur();'>";
						foreach($all_plugins as $plugin){

								if (!empty($plugin['plugin']['info1']['widgetname1']) && ($plugin['plugin']['info1']['widgetname1'] != "")) {
									$select_options .= "<optgroup style='background-color: rgba(243,243,243,1);margin: 5px;border: 1px solid #ddd;' label='&nbsp;".$plugin['plugin']['info']['name']."'>";
								}else{
								}

								$modulname = $plugin['plugin']['info']['modulname'];
								
								if (!empty($plugin['plugin']['info1']['widgetname1']) && ($plugin['plugin']['info1']['widgetname1'] != "")) {
								$widgetname1 = $plugin['plugin']['info1']['widgetname1'];
								@$sector1 = $plugin['plugin']['info1']['sector1'];								
								$widgets1 = $plugin['plugin']['info1']['widgets1'];
									foreach((array)$widgets1 as $widget){
										$select_options .= "<option value='$widget' title='Empfohlener Widget Bereich: $sector1'>$widgetname1</option>";
									}
								}else{
								}

								if (!empty($plugin['plugin']['info2']['widgetname2']) && ($plugin['plugin']['info2']['widgetname2'] != "")) {
								$widgetname2 = $plugin['plugin']['info2']['widgetname2'];
								@$sector2 = $plugin['plugin']['info2']['sector2'];
								$widgets2 = $plugin['plugin']['info2']['widgets2'];
									foreach((array)$widgets2 as $widget){
										$select_options .= "<option value='$widget' title='Empfohlener Widget Bereich: $sector2'>$widgetname2</option>";
									}
								}else{
								}

								if (!empty($plugin['plugin']['info3']['widgetname3']) && ($plugin['plugin']['info3']['widgetname3'] != "")) {
								$widgetname3 = $plugin['plugin']['info3']['widgetname3'];
								@$sector3 = $plugin['plugin']['info3']['sector3'];
								$widgets3 = $plugin['plugin']['info3']['widgets3'];
									foreach((array)$widgets3 as $widget){
										$select_options .= "<option value='$widget' title='Empfohlener Widget Bereich: $sector3'>$widgetname3</option>";
									}
								}else{
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
    <li class="breadcrumb-item"><a href="admincenter.php?site=plugin_widgets">' . $_language->module['widget'] . '</a></li>
    <li class="breadcrumb-item active" aria-current="page">new & edit</li>
  </ol>
</nav>

<div class="card-body">';
echo'<h4>'.$_language->module[ 'modul_info' ].': '.$_language->module[ $position ].'</h4><br>';
echo'<div class="row">';				

echo'<form class="form col-md-10" method="post" action="admincenter.php?site=plugin_widgets&action=manager">

	<input type="hidden" name="position" value="'.$position.'" />
	<input type="hidden" name="add" value="justdoit" />
	<div class="form-group row text-right">
		<label class="control-label col-md-3">' . $_language->module[ 'sort' ] . '</label>
		<div class="col-md-8">
			'.$sort.'
		</div>
	</div>
	<div class="form-group row text-right">
		<label class="control-label col-md-3">' . $_language->module[ 'avaible_widgets' ] . '</label>
		<div class="col-md-8">
			'.$select_options.'
		</div>
	</div>
	<div class="form-group row text-right">
		<div class="col-md-3">
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
			global $themes_modulname;
				
			if(isset($_POST['delete_row'])){
				$id = $_POST['delete_row'];
				$plugin_class->deleteWidgetByID($id);
				echo'' . $_language->module[ 'delete_done' ] . '';
					redirect("admincenter.php?site=plugin_widgets", "", 2);

			}else if(isset($_POST['sorting'])){
				#$sorts = $_POST['sort'];
				$sorts = (isset($_POST['sort'])) ? $_POST['sort'] : 'ASC';
				foreach($sorts as $id=>$sort){
					$plugin_class->sortwidget($id, $sort);
				}
				redirect("admincenter.php?site=plugin_widgets", "", 0);
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
    <li class="breadcrumb-item"><a href="admincenter.php?site=plugin_widgets">' . $_language->module['widget'] . '</a></li>
    <li class="breadcrumb-item active" aria-current="page">new & edit</li>
  </ol>
</nav>

<div class="card-body">';	

		if(count($allPositions)>0){
			foreach($allPositions as $position){

				

echo'<div class="card">
<div class="card-body">
<div class="row">

<div class="col-md-2 text-center"><img style="height: 250px;margin-bottom: 6px;" class="img-fluid" src="../images/plugins/'.$position['position'].'.jpg"><br>
<a href="admincenter.php?site=settings_modules" type="button" class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" title="' . $_language->module[ 'info_modul_einstellung' ] . '">
' . $_language->module[ 'edit_module' ] . '
</a>
</div>
<div class="col-md-10"><table class="table table-striped">
		<thead>
			
				<th width="40%"><h4>'.$position['description'].'</h4></th>
				<th width="30%"><p>'.$_language->module[ 'widget_files' ].' ('.$plugin_class->countAllWidgetsOfPosition($position['position']).')</p></th>
				<th width="30%"></th>
				<!--<th width="10%"></th>-->
				<th width="10%">
					<form method="post" action="admincenter.php?site=plugin_widgets&action=manager">
						<input type="hidden" name="position" value="'.$position['position'].'"/>
						<button type="submit" name="add" class="btn btn-success">'.$_language->module[ 'add_widget' ].'</button>
					</form>
				</th>
';
				
				$allWidgetsOfCurrPosition = $plugin_class->getAllWidgetsOfPosition($position['position']);
				$ctn_all_widgets_of_curr_position = count($allWidgetsOfCurrPosition);
				

echo'<form method="post" action="admincenter.php?site=plugin_widgets&action=managemulti">

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

echo'<a href="admincenter.php?site=plugin_manager&id='.$activity.'&do=edit" type="button" class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" title="' . $_language->module[ 'info_modulmanager' ] . '">' . $_language->module[ 'edit' ] . '</a>



		<button name="delete_row" type="submit" class="btn btn-danger"  data-toggle="tooltip" data-placement="bottom" title="' . $_language->module['really_delete'] . '" value="'.$id.'">'.$_language->module[ 'delete' ].'</button>


		</td>
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