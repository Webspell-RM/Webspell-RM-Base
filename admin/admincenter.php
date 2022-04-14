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


chdir('../');
include('system/sql.php');
include('system/settings.php');
include('system/functions.php');
include('system/plugin.php');
include('system/widget.php');
include('system/version.php');
include('system/multi_language.php');
chdir('admin');
$load = new plugin_manager();
$_language->readModule('admincenter', false, true);
if (isset($_GET['site'])) {
  $site = $_GET['site'];
} elseif (isset($site)) {
  unset($site);
}
$cookievalueadmin = 'false'; 
if(isset($_COOKIE['cookie'])) { 
    $cookievalueadmin = 'accepted';  
}

// extra login
$admin=isanyadmin($userID);
if (!$loggedin) {// START
    // include theme / content
   include("login.php"); 
}
if (!$admin || !$cookievalueadmin) {
    die($_language->module['access_denied']);
}

if (!isset($_SERVER['REQUEST_URI'])) {
  $arr = explode('/', $_SERVER['PHP_SELF']);
  $_SERVER['REQUEST_URI'] = '/' . $arr[count($arr)-1];
  if ($_SERVER['argv'][0]!='') {
    $_SERVER['REQUEST_URI'] .= '?' . $_SERVER['argv'][0];
  }
}

function getplugincatID($catname) {
  $ds = mysqli_fetch_array(safe_query("SELECT * FROM `".PREFIX."navigation_dashboard_categories` WHERE name LIKE '%$catname%'"));
  $SearchString2 = safe_query("SELECT * FROM `".PREFIX."navigation_dashboard_links` WHERE catID = '".$ds['catID']."'");
  if(mysqli_num_rows($SearchString2) >= '1') {
    return '1';
  } else {
    return '0';
  }
}

function dashnavi() {
  global $userID;
  $links = '';
  $ergebnis = safe_query("SELECT * FROM ".PREFIX."navigation_dashboard_categories ORDER BY sort");
  while ($ds=mysqli_fetch_array($ergebnis)) {
    $accesslevel = 'is'.$ds['accesslevel'].'admin';

  $name = $ds['name'];
  $fa_name = $ds['fa_name'];
    $translate = new multiLanguage(detectCurrentLanguage());
    $translate->detectLanguages($name);
    $name = $translate->getTextByLanguage($name);
    
    $data_array = array();
    $data_array['$name'] = $ds['name'];
    $data_array['$fa_name'] = $ds['fa_name'];
    $plugincheck = getplugincatID($name);
    
    if ($accesslevel($userID) && $plugincheck == '1') {
    $links .= '<li><a class=\'has-arrow\' aria-expanded=\'false\' href=\'#\'><i class=\''.$fa_name.'\'></i>  '.$name.'</a><ul class=\'nav nav-third-level\'>';
    
    $catlinks = safe_query("SELECT * FROM ".PREFIX."navigation_dashboard_links WHERE catID='".$ds['catID']."' ORDER BY sort");
    while ($db=mysqli_fetch_array($catlinks)) {
      $accesslevel = 'is'.$db['accesslevel'].'admin';

      $name = $db['name'];
    $translate = new multiLanguage(detectCurrentLanguage());
    $translate->detectLanguages($name);
    $name = $translate->getTextByLanguage($name);
    
    $data_array = array();
    $data_array['$name'] = $db['name'];

      if ($accesslevel($userID)) {
        $links .= '<li><a href=\''.$db['url'].'\'> + '.$name.'</a></li>';
      }
    }
    $links .= '</ul></li>';
  }
}
 $links .= '</ul></li>';

  return $links;
}



if ($userID && !isset($_GET[ 'userID' ]) && !isset($_POST[ 'userID' ])) {
$ds =
        mysqli_fetch_array(safe_query("SELECT registerdate FROM `" . PREFIX . "user` WHERE userID='" . $userID . "'"));
    $username = '<a href="../index.php?site=profile&amp;id=' . $userID . '">' . getnickname($userID) . '</a>';
    $lastlogin = getformatdatetime($_SESSION[ 'ws_lastlogin' ]);
    $registerdate = getformatdatetime($ds[ 'registerdate' ]);

    $data_array = array();
    $data_array['$username'] = $username;
    $data_array['$lastlogin'] = $lastlogin;
    $data_array['$registerdate'] = $registerdate;
}

   
    if ($getavatar = getavatar($userID)) {
        $l_avatar = '<img src="../images/avatars/' . $getavatar . '" alt="Avatar" class="img-circle profile_img">';
    } else {
        $l_avatar = $_language->module[ 'n_a' ];
    }
   
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Website using webSPELL-RM CMS">
    <meta name="copyright" content="Copyright &copy; 2017-2019 by webspell-rm.de">
    <meta name="author" content="webspell-rm.de">

    <link rel="SHORTCUT ICON" href="/admin/favicon.ico">

    <title>Webspell-RM - Bootstrap Admin Theme</title>

    <!-- Bootstrap Core CSS -->
    <link href="../components/admin/css/bootstrap.min.css" rel="stylesheet">
   
    <!-- Custom CSS -->
    <link href="../components/admin/css/page.css" rel="stylesheet">

    <!-- Menu CSS -->
    <link href="../components/admin/css/menu.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href='../components/fontawesome/css/all.css' rel='stylesheet' type='text/css'>

    <!-- Style CSS -->
    <link href="../components/admin/css/style.css" rel="stylesheet">
    <link href="../components/css/button.css.php" rel="styleSheet" type="text/css">
    
    <link href="../components/admin/css/bootstrap-switch.css" rel="stylesheet">
    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="../components/admin/css/datatables.min.css"/>
    <link rel="stylesheet" type="text/css" href="../components/admin/css/dataTables.bootstrap4.min.css"/>
   
   <?php include('../system/ckeditor.php'); ?>
   <script src="./../components/admin/js/jquery.min.331.js"></script>
   <link href='./../components/admin/css/fonts.css' rel='stylesheet' type='text/css'>
   <?php #echo getcookiescript(); ?>
  </head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="profile_info"><?php echo $_language->module[ 'welcome' ] ?></li>
                <li class="profile_info"><?php echo @$username ?></li>
                <!-- /.dropdown -->

                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-times"></i> <?php echo $_language->module[ 'logout' ] ?> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="../index.php"><i class="fa fa-undo"></i> <?php echo $_language->module[ 'back_to_website' ] ?></a>
                        </li>
                        <li><a href="../index.php?site=logout"><i class="fa fa-sign-out"></i> <?php echo $_language->module[ 'logout' ] ?></a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
               
                <!-- /.dropdown -->

            </ul>
            <!-- /.navbar-top-links -->

            <!-- sidebar-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                 <div style="padding: 0 0 10px 0; text-align: center;">
                  <img src="../components/admin/images/setting.png" style="margin-right: 5px" alt="setting">
                  <span style="font-weight: 600; font-size: 16px; text-transform: uppercase; letter-spacing: 1.2px;">Webspell RM</span>
                  </div>
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-head">
                          <a class="nav-link link-head" href="admincenter.php"> <i class="fa fa-home"></i> Dashboard</a>
                        </li>
                <?php 
             
                echo dashnavi();
                
               ?>   
                    </ul>
                
                <!-- /.sidebar-collapse -->
        <!-- Copy -->
        <div class="copy">
        <em>&nbsp;&copy; 2022 webspell | RM&nbsp;Admin Template by <a href="https://www.webspell-rm.de" target="_blank" rel="noopener">Webspell-RM</a></em>
        </div>
        </div>
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                
                <!-- /.col-lg-12 -->
                <div class="col-lg-12">
                <br>
                <?php
    if (isset($site) && $site!="news") {
        $invalide = array('\\','/','//',':','.');
        $site = str_replace($invalide, ' ', $site);
        if (file_exists($site.'.php')) {
            include($site.'.php');
        } else {
            // Load Plugins-Admin-File (if exists)
            chdir("../");
            $plugin = $load->plugin_data($site,0,true);
            $plugin_path = $plugin['path'];
            if(file_exists($plugin_path."admin/".$plugin['admin_file'].".php")) {       
                include($plugin_path."admin/".$plugin['admin_file'].".php");
            } else {
                chdir("admin");
            echo "<p class='list-group-item list-group-item-action list-group-item-danger'>Modul [or] Plugin Not found</p><br /><br />";
                include('info.php');
            }
        }
    } else {
        include('info.php');
    }

    
    ?>

            </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../components/admin/js/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" media="all" href="../components/admin/css/style-nav.css">
    <link href="../components/admin/css/bootstrap-colorpicker.min.css" rel="stylesheet">
    <script src="../components/admin/js/bootstrap-colorpicker.js"></script>
	
   
<!-- jQuery -->
    <script src="../components/admin/js/bootstrap.min.js"></script>

    <!-- Menu Plugin JavaScript -->
    <script src="../components/admin/js/menu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../components/admin/js/page.js"></script>
<script src="../components/admin/js/button.js"></script>

<script src="../components/admin/js/index.js"></script>
<script>
        var calledfrom='admin';
    </script>
    <script src='../components/js/bbcode.js'></script>
<script src="../components/admin/js/bootstrap-switch.js"></script>

 <script type="text/javascript" src="../components/admin/js/datatables.min.js"></script>

    <script>
      $(document).ready(function () {
        $('#plugini').dataTable({
          'language': {
            'url': '../components/admin/dataTables.german.lang'
          }
        });
        $('#confirm-delete').on('show.bs.modal', function (e) {
          $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
          $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
        });
      });
    </script>
</body>
</html>

