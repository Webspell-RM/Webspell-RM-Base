<?php
/*
##########################################################################
#                                                                        #
#           Version 4       /                        /   /               #
#          -----------__---/__---__------__----__---/---/-               #
#           | /| /  /___) /   ) (_ `   /   ) /___) /   /                 #
#          _|/_|/__(___ _(___/_(__)___/___/_(___ _/___/___               #
#                       Free Content / Management System                 #
#                                   /                                    #
#                                                                        #
#                                                                        #
#   Copyright 2005-2015 by webspell.org                                  #
#                                                                        #
#   visit webSPELL.org, webspell.info to get webSPELL for free           #
#   - Script runs under the GNU GENERAL PUBLIC LICENSE                   #
#   - It's NOT allowed to remove this copyright-tag                      #
#   -- http://www.fsf.org/licensing/licenses/gpl.html                    #
#                                                                        #
#   Code based on WebSPELL Clanpackage (Michael Gruber - webspell.at),   #
#   Far Development by Development Team - webspell.org                   #
#                                                                        #
#   visit webspell.org                                                   #
#                                                                        #
##########################################################################
*/

$_language->readModule('overview', false, true);

if (!isanyadmin($userID) || mb_substr(basename($_SERVER[ 'REQUEST_URI' ]), 0, 15) != "admincenter.php") {
    die($_language->module[ 'access_denied' ]);
}

$phpversion = phpversion() < '4.3' ? '<font color="#FF0000">' . phpversion() . '</font>' :
    '<font color="#008000">' . phpversion() . '</font>';
$zendversion = zend_version() < '1.3' ? '<font color="#FF0000">' . zend_version() . '</font>' :
    '<font color="#008000">' . zend_version() . '</font>';
$mysqlversion = mysqli_get_server_version($_database) < '40000' ?
    '<font color="#FF0000">' . mysqli_get_server_info($_database) . '</font>' :
    '<font color="#008000">' . mysqli_get_server_info($_database) . '</font>';
$get_phpini_path = get_cfg_var('cfg_file_path');
$get_allow_url_fopen =
    get_cfg_var('allow_url_fopen') ? '<font color="#008000">' . $_language->module[ 'on' ] . '</font>' :
        '<font color="#FF0000">' . $_language->module[ 'off' ] . '</font>';
$get_allow_url_include =
    get_cfg_var('allow_url_include') ? '<font color="#FF0000">' . $_language->module[ 'on' ] . '</font>' :
        '<font color="#008000">' . $_language->module[ 'off' ] . '</font>';
$get_display_errors =
    get_cfg_var('display_errors') ? '<font color="#FFA500">' . $_language->module[ 'on' ] . '</font>' :
        '<font color="#008000">' . $_language->module[ 'off' ] . '</font>';
$get_file_uploads = get_cfg_var('file_uploads') ? '<font color="#008000">' . $_language->module[ 'on' ] . '</font>' :
    '<font color="#FF0000">' . $_language->module[ 'off' ] . '</font>';
$get_log_errors = get_cfg_var('log_errors') ? '<font color="#008000">' . $_language->module[ 'on' ] . '</font>' :
    '<font color="#FF0000">' . $_language->module[ 'off' ] . '</font>';
$get_magic_quotes =
    get_cfg_var('magic_quotes_gpc') ? '<font color="#008000">' . $_language->module[ 'on' ] . '</font>' :
        '<font color="#FFA500">' . $_language->module[ 'off' ] . '</font>';
$get_max_execution_time = get_cfg_var('max_execution_time') < 30 ?
    '<font color="#FF0000">' . get_cfg_var('max_execution_time') . '</font> <small>(min. > 30)</small>' :
    '<font color="#008000">' . get_cfg_var('max_execution_time') . '</font>';
$get_memory_limit =
    get_cfg_var('memory_limit') > 128 ? '<font color="#FFA500">' . get_cfg_var('memory_limit') . '</font>' :
        '<font color="#008000">' . get_cfg_var('memory_limit') . '</font>';
$get_open_basedir = get_cfg_var('open_basedir') ? '<font color="#008000">' . $_language->module[ 'on' ] . '</font>' :
    '<font color="#FFA500">' . $_language->module[ 'off' ] . '</font>';
$get_post_max_size =
    get_cfg_var('post_max_size') > 8 ? '<font color="#FFA500">' . get_cfg_var('post_max_size') . '</font>' :
        '<font color="#008000">' . get_cfg_var('post_max_size') . '</font>';
$get_register_globals =
    get_cfg_var('register_globals') ? '<font color="#FF0000">' . $_language->module[ 'on' ] . '</font>' :
        '<font color="#008000">' . $_language->module[ 'off' ] . '</font>';
$get_safe_mode = get_cfg_var('safe_mode') ? '<font color="#008000">' . $_language->module[ 'on' ] . '</font>' :
    '<font color="#FF0000">' . $_language->module[ 'off' ] . '</font>';
$get_short_open_tag =
    get_cfg_var('short_open_tag') ? '<font color="#008000">' . $_language->module[ 'on' ] . '</font>' :
        '<font color="#FFA500">' . $_language->module[ 'off' ] . '</font>';

if (function_exists('curl_version')) {
    $curl_check = '<font color="#008000">' . $_language->module[ 'on' ] . '</font>';
} else {
    $curl_check = '<font color="#FF0000">' . $_language->module[ 'off' ] . '</font>';
    $fatal_error = true;
}

if (function_exists('allow_url_fopen')) {
    $allow_url_fopen_check = '<font color="#008000">' . $_language->module[ 'on' ] . '</font>';
} else {
    $allow_url_fopen_check = '<font color="#FF0000">' . $_language->module[ 'off' ] . '</font>';
    $fatal_error = true;
}
                       
$get_upload_max_filesize = get_cfg_var('upload_max_filesize') > 16 ?
    '<font color="#FFA500">' . get_cfg_var('upload_max_filesize') . '</font>' :
    '<font color="#008000">' . get_cfg_var('upload_max_filesize') . '</font>';
$info_na = '<font color="#8F8F8F">' . $_language->module[ 'na' ] . '</font>';
if (function_exists("gd_info")) {
    $gdinfo = gd_info();
    $get_gd_info = '<font color="#008000">' . $_language->module[ 'enable' ] . '</font>';
    $get_gdtypes = array();
    if (isset($gdinfo[ 'FreeType Support' ]) && $gdinfo[ 'FreeType Support' ] === true) {
        $get_gdtypes[ ] = "FreeType";
    }
    if (isset($gdinfo[ 'T1Lib Support' ]) && $gdinfo[ 'T1Lib Support' ] === true) {
        $get_gdtypes[ ] = "T1Lib";
    }
    if (isset($gdinfo[ 'GIF Read Support' ]) && $gdinfo[ 'GIF Read Support' ] === true) {
        $get_gdtypes[ ] = "*.gif " . $_language->module[ 'read' ];
    }
    if (isset($gdinfo[ 'GIF Create Support' ]) && $gdinfo[ 'GIF Create Support' ] === true) {
        $get_gdtypes[ ] = "*.gif " . $_language->module[ 'create' ];
    }
    if (isset($gdinfo[ 'JPG Support' ]) && $gdinfo[ 'JPG Support' ] === true) {
        $get_gdtypes[ ] = "*.jpg";
    } elseif (isset($gdinfo[ 'JPEG Support' ]) && $gdinfo[ 'JPEG Support' ] === true) {
        $get_gdtypes[ ] = "*.jpg";
    }
    if (isset($gdinfo[ 'PNG Support' ]) && $gdinfo[ 'PNG Support' ] === true) {
        $get_gdtypes[ ] = "*.png";
    }
    if (isset($gdinfo[ 'WBMP Support' ]) && $gdinfo[ 'WBMP Support' ] === true) {
        $get_gdtypes[ ] = "*.wbmp";
    }
    if (isset($gdinfo[ 'XBM Support' ]) && $gdinfo[ 'XBM Support' ] === true) {
        $get_gdtypes[ ] = "*.xbm";
    }
    if (isset($gdinfo[ 'XPM Support' ]) && $gdinfo[ 'XPM Support' ] === true) {
        $get_gdtypes[ ] = "*.xpm";
    }
    $get_gdtypes = implode(", ", $get_gdtypes);
} else {
    $get_gd_info = '<font color="#FF0000">' . $_language->module[ 'disable' ] . '</font>';
    $gdinfo[ 'GD Version' ] = '---';
    $get_gdtypes = '---';
}

if (function_exists("apache_get_modules")) {
    $apache_modules = implode(", ", apache_get_modules());
} else {
    $apache_modules = $_language->module[ 'na' ];
}

$get = safe_query("SELECT DATABASE()");
$ret = mysqli_fetch_array($get);
$db = $ret[ 0 ];
 ?>

<div class="row">
<div class="col-md-6">
	<div class="card">
        <div class="card-header">
            <i class="fas fa-server"></i> <?php echo $_language->module['serverinfo']; ?>
        </div>
            
            <div class="card-body">


	<div class="row bt"><div class="col-md-6"><?php echo $_language->module['webspell_version']; ?>:</div><div class="col-md-6"><span class="pull-right text-muted small"><em><font color="#008000"><?php echo $version; ?></font></em></span></div></div>
	<div class="row bt"><div class="col-md-6"><?php echo $_language->module['php_version']; ?>:</div><div class="col-md-6"><span class="pull-right text-muted small"><em><?php echo $phpversion; ?></em></span></div></div>
	<div class="row bt"><div class="col-md-6"><?php echo $_language->module['zend_version']; ?>:</div><div class="col-md-6"><span class="pull-right text-muted small"><em><?php echo $zendversion; ?></em></span></div></div>
	<div class="row bt"><div class="col-md-6"><?php echo $_language->module['mysql_version']; ?>:</div><div class="col-md-6"><span class="pull-right text-muted small"><em><?php echo $mysqlversion; ?></em></span></div></div>
	<div class="row bt"><div class="col-md-6"><?php echo $_language->module['databasename']; ?>:</div><div class="col-md-6"><span class="pull-right text-muted small"><em><?php echo $db; ?></em></span></div></div>

	<div class="row bt"><div class="col-md-6"><?php echo $_language->module['server_os']; ?>:</div><div class="col-md-6"><span class="pull-right text-muted small"><em><?php echo (($php_s = @php_uname('s')) ? $php_s : $info_na); ?></em></span></div></div>
	<div class="row bt"><div class="col-md-6"><?php echo $_language->module['server_host']; ?>:</div><div class="col-md-6"><span class="pull-right text-muted small"><em><?php echo (($php_n = @php_uname('n')) ? $php_n : $info_na); ?></em></span></div></div>
	<div class="row bt"><div class="col-md-6"><?php echo $_language->module['server_release']; ?>:</div><div class="col-md-6"><span class="pull-right text-muted small"><em><?php echo (($php_r = @php_uname('r')) ? $php_r : $info_na); ?></em></span></div></div>
	<div class="row bt"><div class="col-md-6"><?php echo $_language->module['server_version']; ?>:</div><div class="col-md-6"><span class="pull-right text-muted small"><em><?php echo (($php_v = @php_uname('v')) ? $php_v : $info_na); ?></em></span></div></div>
	<div class="row bt"><div class="col-md-6"><?php echo $_language->module['server_machine']; ?>:</div><div class="col-md-6"><span class="pull-right text-muted small"><em><?php echo (($php_m = @php_uname('m')) ? $php_m : $info_na); ?></em></span></div></div>

</div>	
</div>

</div>

<div class="col-md-6">
	
	<div class="card">
        <div class="card-header">
            <i class="fas fa-file-image"></i> GD Graphics Library
        </div>
            
            <div class="card-body">

    <div class="row bt"><div class="col-md-4">GD Graphics Library:</div><div class="col-md-8"><span class="pull-right text-muted small"><em><?php echo $get_gd_info; ?></em></span></div></div>
    <div class="row bt"><div class="col-md-4"><?php echo $_language->module['supported_types']; ?>:</div><div class="col-md-8"><span class="pull-right text-muted small"><em><?php echo $get_gdtypes; ?></em></span></div></div>

    <div class="row bt"><div class="col-md-4">GD Lib <?php echo $_language->module['version']; ?>:</div><div class="col-md-8"><span class="pull-right text-muted small"><em><?php echo $gdinfo['GD Version']; ?></em></span></div></div>

</div>
</div>



	<div class="card">
        <div class="card-header">
            <i class="fas fa-database"></i> <?php echo $_language->module['interface']; ?>
        </div>
            
            <div class="card-body">

<div class="row">
<div class="col-md-12">
	<div class="row bt"><div class="col-md-6"><?php echo $_language->module['server_api']; ?>:</div><div class="col-md-6"><span class="pull-right text-muted small"><em><?php echo php_sapi_name(); ?></em></span></div></div>
	<div class="row bt"><div class="col-md-6"><?php echo $_language->module['apache']; ?>:</div><div class="col-md-6"><span class="pull-right text-muted small"><em><?php if(function_exists("apache_get_version")) echo apache_get_version(); else echo $_language->module['na']; ?></em></span></div></div>
	<div class="row bt"><div class="col-md-6"><?php echo $_language->module['apache_modules']; ?>:</div><div class="col-md-6"><span class="pull-right text-muted small"><em><?php if(function_exists("apache_get_modules")){if(count(apache_get_modules()) > 1) $get_apache_modules = implode(", ",apache_get_modules()); echo $get_apache_modules;} else{ echo $_language->module['na'];} ?></em></span></div></div>
</div>	
</div>
</div>


</div>

</div>

<div class="col-md-12">
<div class="card">
        <div class="card-header">
            <i class="fas fa-th-list"></i> <?php echo $_language->module['php_settings']; ?>
        </div>
            
            <div class="card-body">

<div class="row bt">
<div class="col-md-12"><?php echo $_language->module['legend']; ?>::&nbsp; &nbsp;<font color="#008000"><?php echo $_language->module['green']; ?>:</font> <?php echo $_language->module['setting_ok']; ?>&nbsp; - &nbsp;<font color="#FFA500"><?php echo $_language->module['orange']; ?>:</font> <?php echo $_language->module['setting_notice']; ?>&nbsp; - &nbsp;<font color="#FF0000"><?php echo $_language->module['red']; ?>:</font> <?php echo $_language->module['setting_error']; ?></div>
</div><div class="row bt"></div>
<div class="row">
<div class="col-md-6">
	<div class="row bt"><div class="col-md-6">php.ini <?php echo $_language->module['path']; ?>:</div><div class="col-md-6"><span class="pull-right text-muted small"><em><?php echo $get_phpini_path; ?></em></span></div></div>
	<div class="row bt"><div class="col-md-6">Allow URL fopen:</div><div class="col-md-6"><span class="pull-right text-muted small"><em><?php echo $get_allow_url_fopen; ?></em></span></div></div>
	<div class="row bt"><div class="col-md-6">Allow URL Include:</div><div class="col-md-6"><span class="pull-right text-muted small"><em><?php echo $get_allow_url_include; ?></em></span></div></div>
	<div class="row bt"><div class="col-md-6">Display Errors:</div><div class="col-md-6"><span class="pull-right text-muted small"><em><?php echo $get_display_errors; ?></em></span></div></div>
	<div class="row bt"><div class="col-md-6">Error Log:</div><div class="col-md-6"><span class="pull-right text-muted small"><em><?php echo $get_log_errors; ?></em></span></div></div>
	<div class="row bt"><div class="col-md-6">File Uploads:</div><div class="col-md-6"><span class="pull-right text-muted small"><em><?php echo $get_file_uploads; ?></em></span></div></div>
	<div class="row bt"><div class="col-md-6">Magic Quotes:</div><div class="col-md-6"><span class="pull-right text-muted small"><em><?php echo $get_magic_quotes; ?></em></span></div></div>
	<div class="row bt"><div class="col-md-6">max. Execution Time:</div><div class="col-md-6"><span class="pull-right text-muted small"><em><?php echo $get_max_execution_time; ?></em></span></div></div>
	<div class="row bt"><div class="col-md-6">Open Basedir:</div><div class="col-md-6"><span class="pull-right text-muted small"><em><?php echo $get_open_basedir; ?></em></span></div></div>
	
</div>

<div class="col-md-6">
	<div class="row bt"><div class="col-md-6">max. Upload (Filesize):</div><div class="col-md-6"><span class="pull-right text-muted small"><em><?php echo $get_upload_max_filesize; ?></em></span></div></div>
	<div class="row bt"><div class="col-md-6">Memory Limit:</div><div class="col-md-6"><span class="pull-right text-muted small"><em><?php echo $get_memory_limit; ?></em></span></div></div>
	<div class="row bt"><div class="col-md-6">Post max Size:</div><div class="col-md-6"><span class="pull-right text-muted small"><em><?php echo $get_post_max_size; ?></em></span></div></div>
	<div class="row bt"><div class="col-md-6">Register Globals:</div><div class="col-md-6"><span class="pull-right text-muted small"><em><?php echo $get_register_globals; ?></em></span></div></div>
	<div class="row bt"><div class="col-md-6">Safe Mode:</div><div class="col-md-6"><span class="pull-right text-muted small"><em><?php echo $get_safe_mode; ?></em></span></div></div>
	<div class="row bt"><div class="col-md-6">Short Open Tag:</div><div class="col-md-6"><span class="pull-right text-muted small"><em><?php echo $get_short_open_tag; ?></em></span></div></div>
	<div class="row bt"><div class="col-md-6">Curl Unterstützung:</div><div class="col-md-6"><span class="pull-right text-muted small"><em><?=$curl_check; ?></em></span></div></div>
	<div class="row bt"><div class="col-md-6">allow_url_fopen Unterstützung:</div><div class="col-md-6"><span class="pull-right text-muted small"><em><?=$allow_url_fopen_check; ?></em></span></div></div>
</div>
</div>
</div>
</div>

</div></div>
