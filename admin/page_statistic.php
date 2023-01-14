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


$_language->readModule('page_statistic', false, true);

$ergebnis = safe_query("SELECT * FROM ".PREFIX."navigation_dashboard_links WHERE modulname='ac_page_statistic'");
    while ($db=mysqli_fetch_array($ergebnis)) {
      $accesslevel = 'is'.$db['accesslevel'].'admin';

if (!$accesslevel($userID) || mb_substr(basename($_SERVER[ 'REQUEST_URI' ]), 0, 15) != "admincenter.php") {
    die($_language->module[ 'access_denied' ]);
}
}

global $_database;
$count_array = array();
$tables_array = array(
    PREFIX . "plugins_about_us",
    PREFIX . "plugins_articles",
    PREFIX . "plugins_awards",
    PREFIX . "plugins_bannerrotation",
    PREFIX . "plugins_fight_us_challenge",
    PREFIX . "plugins_clanwars",
    PREFIX . "contact",
    PREFIX . "plugins_faq",
    PREFIX . "plugins_faq_categories",
    PREFIX . "plugins_files",
    PREFIX . "plugins_files_categories",
    PREFIX . "plugins_forum_announcements",
    PREFIX . "plugins_forum_boards",
    PREFIX . "plugins_forum_categories",
    PREFIX . "plugins_forum_groups",
    PREFIX . "plugins_forum_moderators",
    PREFIX . "plugins_forum_posts",
    PREFIX . "plugins_forum_ranks",
    PREFIX . "plugins_forum_topics",
    PREFIX . "plugins_gallery",
    PREFIX . "plugins_gallery_categorys",
    PREFIX . "settings_games",
    PREFIX . "plugins_guestbook",
    PREFIX . "plugins_links",
    PREFIX . "plugins_links_categorys",
    PREFIX . "plugins_linkus",
    PREFIX . "plugins_messenger",
    PREFIX . "plugins_news",
    PREFIX . "plugins_news_rubrics",
    PREFIX . "plugins_news_comments",
    PREFIX . "plugins_partners",
    PREFIX . "plugins_poll",
    PREFIX . "plugins_servers",
    PREFIX . "plugins_shoutbox",
    PREFIX . "plugins_sponsors",
    PREFIX . "squads",
    PREFIX . "static",
    PREFIX . "user",
    PREFIX . "plugins_videos",
    PREFIX . "plugins_videos_categories",
    PREFIX . "plugins_videos_comments",
    PREFIX . "plugins_todo",
    PREFIX . "plugins_streams",
    PREFIX . "plugins_pic_update",
);
$db_size = 0;
$db_size_op = 0;
if (!isset($db)) {
    $get = safe_query("SELECT DATABASE()");
    $ret = mysqli_fetch_array($get);
    $db = $ret[ 0 ];
}
$query = safe_query("SHOW TABLES");

$count_tables = mysqli_num_rows($query);
foreach ($tables_array as $table) {
    if(mysqli_num_rows(safe_query("SHOW TABLE STATUS FROM `" . $db . "` LIKE '" . $table . "'"))) {
        $check = mysqli_query($_database, "SELECT * FROM $table");
        $table_name = $table;
        if($check) {
          $sql = safe_query("SHOW TABLE STATUS FROM `" . $db . "` LIKE '" . $table_name . "'");
          $data = mysqli_fetch_array($sql);
          $db_size += ($data[ 'Data_length' ] + $data[ 'Index_length' ]);
          if (strtolower($data[ 'Engine' ]) == "myisam") {
              $db_size_op += $data[ 'Data_free' ];
          }

          $table_base_name = str_replace(PREFIX, "", $table_name);
          if (isset($_language->module[ $table_base_name ])) {
              $table_name = $_language->module[ $table_base_name ];
          } else {
              $table_name = ucfirst(str_replace("_", " ", $table_name));
          }
          $count_array[ ] = array($table_name, $data[ 'Rows' ]);
        }
    }
}
?>

<div class="card">
        <div class="card-header">
            <i class="fas fa-database"></i> <?php echo $_language->module['database']; ?>
        </div>
            
            <div class="card-body">

<div class="row">
<div class="col-md-6">

	<div class="row bt"><div class="col-md-6"><?php echo $_language->module['mysql_version']; ?>:</div><div class="col-md-6"><span class="pull-right text-muted small"><em><?php echo mysqli_get_server_info($_database); ?></em></span></div></div>
	<div class="row bt"><div class="col-md-6"><?php echo $_language->module['size']; ?>:</div><div class="col-md-6"><span class="pull-right text-muted small"><em><?php echo $db_size; ?> Bytes (<?php echo round($db_size / 1024 / 1024, 2); ?> MB)</em></span></div></div>

</div>



<div class="col-md-6">
	<div class="row bt"><div class="col-md-6"><?php echo $_language->module['overhead']; ?>:</div><div class="col-md-6"><span class="pull-right text-muted small"><em><?php echo $db_size_op; ?> Bytes
    <?php
    if($db_size_op != 0) {
    	echo'<a href="admincenter.php?site=database&amp;action=optimize&amp;back=page_statistic"><font color="red"><b>'.$_language->module['optimize'].'</b></font></a>';
    }
    ?></em></span></div></div>
	<div class="row bt"><div class="col-md-6"><?php echo $_language->module['tables']; ?>:</div><div class="col-md-6"><span class="pull-right text-muted small"><em><?php echo $count_tables; ?></em></span></div></div>
</div>
</div>
</div>
</div>

<div class="card">
        <div class="card-header">
            <i class="fas fa-chart-pie"></i> <?php echo $_language->module['page_stats']; ?>
        </div>
            
            <div class="card-body">

                <div class="panel panel-default">

<div class="row">

<?php
  for($i = 0; $i < count($count_array); $i += 1) {
    if($i%4) { $td='td1'; }
    else { $td='td2'; }
  ?>
<div class="col-md-6">
<div class="row bte"><div class="col-md-6"><?php echo $count_array[$i][0]; ?>:</div><div class="col-md-6"><span class="pull-right text-muted small"><em><?php echo $count_array[$i][1]; ?></em></span></div></div>
</div>

<?php if(isset($count_array[$i + 1])) { ?>
	<div class="col-md-6">
<div class="row bte"><div class="col-md-6"><?php echo $count_array[$i + 1][0]; ?>:</div><div class="col-md-6"><span class="pull-right text-muted small"><em><?php echo $count_array[$i + 1][1]; ?></em></span></div></div>
</div>
    <?php 
		} 
  	else { ?>

    <?php } ?>

<?php
$i++;
}
?>

</div>
</div>
</div>
