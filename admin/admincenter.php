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

// extra login
$admin=isanyadmin($userID);
if (!$loggedin) {// START
    // include theme / content
    include("login.php"); 
}
if (!$admin) {
    die($_language->module['access_denied']);
}



if (!isset($_SERVER['REQUEST_URI'])) {
  $arr = explode('/', $_SERVER['PHP_SELF']);
  $_SERVER['REQUEST_URI'] = '/' . $arr[count($arr)-1];
  if ($_SERVER['argv'][0]!='') {
    $_SERVER['REQUEST_URI'] .= '?' . $_SERVER['argv'][0];
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

    
    if ($accesslevel($userID)) {
    $links .= '<li><a class=\'has-arrow\' aria-expanded=\'false\' href=\'#\'><i class=\''.$fa_name.'\'></i>  '.$name.'</a><ul class=\'nav nav-second-level\'>';
    
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
        $links .= '<li><a href=\''.$db['url'].'\'>'.$name.'</a></li>';
      }
    }
    $links .= '</ul></li>';
  }
}
 $links .= '</ul></li>';

  return $links;
}


if ($userID && !isset($_GET[ 'userID' ]) && !isset($_POST[ 'userID' ])) {
  $ds = mysqli_fetch_array(
    safe_query(
      "SELECT
        `registerdate`,
        `nickname`
      FROM `" . PREFIX . "user`
      WHERE `userID` = " . $userID
    )
  );
  $username = '<a href=\'../index.php?site=profile&amp;id='. $userID .'\'>'. $ds[ 'nickname' ] .'</a>';
  $userurl = '../index.php?site=profile&amp;id='. $userID .'';
  $data_array = array();
  $data_array['$username'] = $username;
  $data_array['$lastlogin'] = getformatdatetime($_SESSION[ 'ws_lastlogin' ]);
  $data_array['$registerdate'] = getformatdatetime($ds[ 'registerdate' ]);
}
if ($getavatar = getavatar($userID)) {
  $l_avatar = '<img src=\'../images/avatars/'. $getavatar .'\' alt=\'Avatar\' class=\'img-circle profile_img\'>';
} else {
  $l_avatar = $_language->module[ 'n_a' ];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Webspell | RM - Bootstrap Admin Theme</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap Core CSS -->
    <link href='css/bootstrap.min.css' rel='stylesheet'>
    
    <!-- Custom CSS -->
     <link rel="stylesheet" href="css/bsadmin.css">
    
    <!-- Custom Fonts -->
    <link href='../components/fontawesome/css/all.css' rel='stylesheet' type='text/css'>
    <!-- Style CSS -->
    <link href='../components/admin/css/bootstrap-colorpicker.min.css' rel='stylesheet'>
    <link href='../components/css/button.css.php' rel='styleSheet' type='text/css'>
    <link href='../components/admin/css/bootstrap-switch.css' rel='stylesheet'>

    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="../components/datatables/css/jquery.dataTables.min.css"/>
    <?php include('../system/ckeditor.php'); ?>
    <script src='../components/jquery/jquery.min.js'></script> 
  
 <link href='../components/admin/css/pa1ge.css' rel='stylesheet'>

<!-- Custom CSS -->
    <link href='/admin/css/page.css' rel='stylesheet'>
 
</head>
<body>
 <div id='wrapper'>
<nav class="navbar navbar-expand navbar-dark navbar-head">
    <div class='navbar-header'>
          
          <img src='../components/admin/images/setting.png'>
        </div>
        
    <div class="navbar-collapse collapse">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown">
                    <i class="fa fa-user"></i> username
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="../index.php">Back to Website</a>
                    <a class="dropdown-item" href="/includes/modules/logout.php">Logout</a>
                </div>
            </li>
        </ul>
    </div>
</nav>

<div class="d-flex">
    <nav class="sidebar-nav sidebar">
          <ul class="metismenu" id="menu1">
            <li><a class="active-head" href="admincenter.php"><i class="fas fa-home"></i> Dashboard</a></li>
            
             <?php 
             
                echo dashnavi();
                
               ?>
            
            
          </ul>
       
<!-- Copy -->
          <div class='copy'>
            <em>&nbsp;&copy; 2019 webspell | RM&nbsp;Admin Template by <a href='http://www.webspell-rm.de' target='_blank'>T-Seven</a></em>
          </div>
           </nav>
    <div class="content p-4">
        <?php
            if (isset($site) && $site!='news') {
              $invalide = array('\\','/','//',':','.');
              $site = str_replace($invalide, ' ', $site);
              if (file_exists($site.'.php')) {
                include($site.'.php');
              } else {
                // Load Plugins-Admin-File (if exists)
                chdir('../');
                $plugin = $load->plugin_data($site,0,true);
                $plugin_path = $plugin['path'];
                if(file_exists($plugin_path.'admin/'.$plugin['admin_file'].'.php')) {
                  include($plugin_path.'admin/'.$plugin['admin_file'].'.php');
                } else {
                  chdir('admin');
                  echo '<b>Modul [or] Plugin Not found</b><br /><br />';
                  include('info.php');
                }
              }
            } else {
              include('info.php');
            }
            ?>
    </div>
</div>
</div>
<!-- jQuery -->
    <script src='../components/admin/js/jquery.min.js'></script>

<script src="js/bootstrap.min.js"></script>








<!--<script src='js/jquery.min.js'></script>-->
<script src="js/bsadmin.js"></script>
<!-- Bootstrap -->
    <!--<script src='../components/admin/js/bootstrap.min.js'></script>-->
    <script src='../components/admin/js/bootstrap-switch.js'></script>
    <!-- DataTables -->
     <script type="text/javascript" src="../components/datatables/js/jquery.dataTables.min.js"></script>
   <!--<script src='../components/datatables/js/jquery.dataTables.min.js'></script> -->

 <script src='../components/admin/js/bootstrap-colorpicker.js'></script>













    <script>  
      jQuery(function($) { 
        $('#cp1').colorpicker(); 
        $('#cp2').colorpicker();
        $('#cp3').colorpicker();
        $('#cp4').colorpicker();
        $('#cp5').colorpicker();
        $('#cp6').colorpicker();
        $('#cp7').colorpicker();
        $('#cp8').colorpicker();
        $('#cp9').colorpicker();
        $('#cp10').colorpicker();
        $('#cp11').colorpicker();
        $('#cp12').colorpicker();
        $('#cp13').colorpicker();
        $('#cp14').colorpicker();
        $('#cp15').colorpicker();
        $('#cp16').colorpicker();
        $('#cp17').colorpicker();
        $('#cp18').colorpicker();
        $('#cp19').colorpicker();
        $('#cp20').colorpicker();
        $('#cp21').colorpicker();
        $('#cp22').colorpicker();
        $('#cp23').colorpicker();
        $('#cp24').colorpicker();
        $('#cp25').colorpicker();
        $('#cp26').colorpicker();
        $('#cp27').colorpicker();
        $('#cp28').colorpicker();
        $('#cp29').colorpicker();
        $('#cp30').colorpicker();
        $('#cp31').colorpicker();
        $('#cp32').colorpicker();
        $('#cp33').colorpicker();
        $('#cp34').colorpicker();
        $('#cp35').colorpicker();
        $('#cp36').colorpicker();
        $('#cp37').colorpicker();
        $('#cp38').colorpicker();
        $('#cp39').colorpicker();
        $('#cp40').colorpicker();
        $('#cp41').colorpicker();
        $('#cp42').colorpicker();
        $('#cp43').colorpicker();
        $('#cp44').colorpicker();
        $('#cp45').colorpicker();
        $(document).ready(function(){
          $('[data-toggle=\'tooltip\']').tooltip();
        });
      }); 
    </script> 
    
    <script>
      var calledfrom='admin';
    </script>
    <script src='../components/js/bbcode.js'></script>
    <script>
      $(document).ready(function () {
        $('#plugini').dataTable({
          'language': {
            'url': '../components/datatables/langs/German.lang'
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

