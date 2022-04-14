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

$language_array = array(

/* do not edit above this line */

  'plugin_manager' => 'Plugin Manager',
  'new_plugin' => 'New plugin',
  'deactivate' => 'Deactivate',
  'deactivated' => 'deactivated',
  'activate' => 'Activate',
  'activated' => 'Activated',
  'delete' => 'Remove',
  'id' => 'ID',
  'plugin' => 'Plugin',
  'name' => 'Name',
  'status' => 'Status',
  'description' => 'Description',
  'success_deactivated' => '<div class = "alert alert-info" role = "alert"> Plugin is now deactivated. </div>',
  'failed_deactivated' => '<div class = "alert alert-warning" role = "alert"> Deactivate plugin failed. </div>',
'success_activated' => '<div class = "alert alert-success" role = "alert"> Plugin is now activated. </div>',
  'failed_activated' => '<div class = "alert alert-warning" role = "alert"> Plugin activation failed. </div>',
'success_delete' => '<div class = "alert alert-danger" role = "alert"> Plugin has been removed. </div>',
  'failed_delete' => '<div class = "alert alert-warning" role = "alert"> Remove plugin failed. </div>',
'success_save' => '<div class = "alert alert-success" role = "alert"> Plugin saved successfully. </div>',
  'failed_save' => '<div class = "alert alert-warning" role = "alert"> Plugin could not be saved. </div>',
'success_edit' => '<div class = "alert alert-success" role = "alert"> Plugin updated successfully. </div>',
  'failed_edit' => '<div class = "alert alert-warning" role = "alert"> Plugin could not be updated. </div>',
  'option' => 'Option',
  'na' => 'not available',
  'read_more' => 'Read more',
  'wrote' => 'wrote',
  'options' => 'Options',
  'edit' => 'Change plugin',
  'add' => 'Add plugin',
  'edit_plugin' => 'Change plugin',
  'add_plugin' => 'Add plugin',
  'really_delete' => 'Are you sure you want to remove this plugin? Only the entries in the Plugin Manager are deleted. ',

  'access_denied' => 'Access Denied',
  'actions' => 'Actions',
  'add_modul' => 'Add module',
  'back' => 'back',
  'left_is_activated' => 'Links activated',
  'right_is_activated' => 'Right activated',
  'all_activated' => 'l. / r. activated ',
  'all_deactivated' => 'Base activated',
  'base' => 'Base',
  'modul_edit' => 'Module setting',
  'edit_modul' => 'Edit Module',

  'left_page' => 'Page left',
  'right_page' => 'Page right',
  'left_right_page' => 'Page left right',
  'page_head' => 'Page Head',
  'content_head' => 'Content Head',
  'content_foot' => 'Content Foot',
  'options' => 'Options',
  'activated' => 'activated?',
  'deactivated' => 'deactivated',
  'new_modul'=>'Add plugin',
  'modulname'=>'Modulname',
  'modul_info'=>'<span class="alert alert-warning" role="alert"><i class="fas fa-exclamation-triangle"></i> You must add your installed plugins so that you can use the module setting can do.</span>',
  'no' => 'No',
  'styles' => 'styles',
  'transaction_invalid' => 'Transaction ID invalid',
  'to_sort' => 'sort',
  'yes' => 'Yes',
  'head_section' => 'Head Section',
  'foot_section' => 'Foot Section',
  'description' => 'Description',
  'module name' => 'module name',
  'info' => '<div class = "col-sm-6 alert alert-warning" role = "alert"> <small>
<b> Module page name: </b> Name of the page for the setting <br>
<b> Base activated: </b> The left and right columns are deactivated and not visible <br>
<b> Left activated: </b> The left side (column) in the front end is visible <br>
<b> Right activated: </b> The right side (column) in the front end is visible <br>
<b> Left and right activated: </b> The left and right side (column) in the front end is visible </small>
</div>

<div class = "col-sm-6 alert alert-warning" role = "alert"> <small>
<b> Page Head activated: </b> The head area is visible <br>
<b> Content head activated: </b> The head in the content (middle head area) visible <br>
<b> Content foot activated: </b> The foot in the content (middle foot area) visible <br>
<b> Head Section activated: </b> The Head Section area is visible <br>
<b> Content foot activated: </b> The content foot area visible </small> </div> ',

'fields_star_required' => 'Required fields',
'no_modul_setup' => '<div class="alert alert-warning" role="alert">Description:<br>No plugin was found.</div>',
'no_modul'=>'<div class="alert alert-warning" role="alert">No plugin was found.</div>'
);

