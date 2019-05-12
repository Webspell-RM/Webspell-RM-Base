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
include("system/sql.php");
include("system/settings.php");
include("system/functions.php");
include("system/plugin.php");
include("system/widget.php");
include("system/version.php");
include("system/multi_language.php");

chdir('admin');

$load = new plugin_manager();
$_language->readModule('admincenter', false, true);

if (isset($_GET['site'])) {
    $site = $_GET['site'];
} else if (isset($site)) {
    unset($site);
}

if (!$loggedin) {
    die($_language->module['not_logged_in']);
}

$admin = isanyadmin($userID);

if (!$admin) {
    die($_language->module['access_denied']);
}

if (!isset($_SERVER['REQUEST_URI'])) {
    $arr = explode("/", $_SERVER['PHP_SELF']);
    $_SERVER['REQUEST_URI'] = "/" . $arr[count($arr)-1];
    if ($_SERVER['argv'][0]!="") {
        $_SERVER['REQUEST_URI'] .= "?" . $_SERVER['argv'][0];
    }
}

function admincenternav($catID)
{
    global $userID;
    $links = '';
    $ergebnis = safe_query("SELECT * FROM ".PREFIX."navigation_dashboard_links WHERE catID='$catID' ORDER BY sort");
    while ($ds=mysqli_fetch_array($ergebnis)) {
        $accesslevel = 'is'.$ds['accesslevel'].'admin';

        $name = $ds['name'];

        $translate = new multiLanguage(detectCurrentLanguage());
        $translate->detectLanguages($name);
        $name = $translate->getTextByLanguage($name);


        $name = toggle(htmloutput($name), 1);
        $name = toggle($name, 1);

        $data_array = array();
        $data_array['$name'] = $ds['name'];

        if ($accesslevel($userID)) {
            $links .= '<li><a href="'.$ds['url'].'">'.$name.'</a></li>';
        }
    }
    return $links;
}

function dashnavi()
{
    global $userID;

    $links = '';
    $ergebnis = safe_query("SELECT * FROM ".PREFIX."navigation_dashboard_categories WHERE sort>'9' ORDER BY sort");
    while ($ds=mysqli_fetch_array($ergebnis)) {
        $links .= '<li><a href="#"><i class="fa fa-plus"></i> '.$ds['name'].'<span class="fa arrow"></span></a><ul class="nav nav-second-level">';
        $catlinks = safe_query("SELECT * FROM ".PREFIX."navigation_dashboard_links WHERE catID='".$ds['catID']."' ORDER BY sort");
        while ($db=mysqli_fetch_array($catlinks)) {
             
            $accesslevel = 'is'.$db['accesslevel'].'admin';
            if ($accesslevel($userID)) {
                $links .= '<li><a href="'.$db['url'].'">'.$db['name'].'</a></li>';
            }
        }
        $links .= '</ul></li>';
    }
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
    
    $username = '<a href="../index.php?site=profile&amp;id=' . $userID . '">' . $ds[ 'nickname' ] . '</a>';

    $data_array = array();
    $data_array['$username'] = $username;
    $data_array['$lastlogin'] = getformatdatetime($_SESSION[ 'ws_lastlogin' ]);
    $data_array['$registerdate'] = getformatdatetime($ds[ 'registerdate' ]);

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

    <link rel="SHORTCUT ICON" href="./favicon.ico">

    <title>webSPELL | RM - Bootstrap Admin Theme</title>

    <!-- Bootstrap Core CSS -->
    <link href="../components/admin/css/bootstrap.min.css" rel="stylesheet">
    <link href="../components/admin/css/bootstrap-switch.css" rel="stylesheet">
    <link href="../components/admin/css/bootstrap-colorpicker.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../components/admin/css/page.css" rel="stylesheet">

    <!-- Menu CSS -->
    <link href="../components/admin/css/menu.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Style CSS -->
    <link href="../components/admin/css/style.css" rel="stylesheet">
    <link href="../components/admin/css/style-nav.css" rel="stylesheet" type="text/css" media="all">
    <link href="../components/css/button.css.php" rel="styleSheet" type="text/css">
    
    <!-- DataTables -->
    <link href="../components/datatables/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />

    <?php include('../system/ckeditor.php'); ?>
    <script src="../components/jquery/jquery.min.js"></script>
   
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
                <img src="../components/admin/images/setting.png">
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="profile_info">Welcome</li>
                <li class="profile_info"><?php echo $username ?></li>
                <!-- /.dropdown -->

                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-times"></i> Logout <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        
                        <li><a href="../index.php"><i class="fa fa-undo"></i> Back to Website</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="/includes/modules/logout.php"><i class="fa fa-sign-out"></i> Logout</a>
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

                    <ul class="nav" id="side-menu">
                        
                        <li class="sidebar-head">
                                    <a class="nav-link link-head" href="admincenter.php"> <i class="fa fa-home"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-area-chart"></i> <?php echo $_language->module['main_panel']; ?><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="admincenter.php?site=overview"><?php echo $_language->module['overview']; ?></a></li>
                                <li><a href="admincenter.php?site=page_statistic"><?php echo $_language->module['page_statistics']; ?></a></li>
                                <li><a href="admincenter.php?site=visitor_statistic"><?php echo $_language->module['visitor_statistics']; ?></a></li>
                                       <?php echo admincenternav(1); ?>
                                                                        
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        
                        <?php if(isuseradmin($userID)) { ?>    
                        <li>
                            <a href="#"><i class="fa fa-user"></i> <?php echo $_language->module['user_administration']; ?><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="admincenter.php?site=users"><?php echo $_language->module['registered_users']; ?></a></li>
                                <li><a href="admincenter.php?site=squads"><?php echo $_language->module['squads']; ?></a></li>
                                <li><a href="admincenter.php?site=members"><?php echo $_language->module['clanmembers']; ?></a></li>
                                <li><a href="admincenter.php?site=contact"><?php echo $_language->module['contact']; ?></a></li>

                                <?php echo admincenternav(2); ?>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                        <?php } if (ispageadmin($userID)) { ?>
                        <li>
                            <a href="#"><i class="fa fa-warning"></i> <?php echo $_language->module['spam']; ?><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="admincenter.php?site=spam&amp;action=forum_spam"><?php echo $_language->module['blocked_content']; ?></a></li>
                                <li><a href="admincenter.php?site=spam&amp;action=user"><?php echo $_language->module['spam_user']; ?></a></li>
                                <li><a href="admincenter.php?site=spam&amp;action=multi"><?php echo $_language->module['multiaccounts']; ?></a></li>
                                <?php echo admincenternav(3); ?>   
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                       
                        <?php }if(isnewsadmin($userID) || isfileadmin($userID) || ispageadmin($userID)) { ?>
                        <li>
                            <a href="#"><i class="fa fa-indent"></i> <?php echo $_language->module['privacy_policy']; ?><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                        <?php } if(isnewsadmin($userID)) { ?>        
                                 <?php echo admincenternav(4); ?>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                        <?php } if(ispageadmin($userID)) { ?>   
                        <li>
                            <a href="#"><i class="fa fa-pencil-square"></i> <?php echo $_language->module['settings']; ?><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="admincenter.php?site=settings"><?php echo $_language->module['settings']; ?></a></li>
                                <li><a href="admincenter.php?site=dashboard_navigation"><?php echo $_language->module['dashnavi']; ?></a></li>
                                <li><a href="admincenter.php?site=webside_navigation"><?php echo $_language->module['web_navigation']; ?></a></li>
                                <li><a href="admincenter.php?site=startpage"><?php echo $_language->module['startpage']; ?></a></li>
                                <li><a href="admincenter.php?site=static"><?php echo $_language->module['static_pages']; ?></a></li>
                                <li><a href="admincenter.php?site=settings_countries"><?php echo $_language->module['countries']; ?></a></li>
                                <li><a href="admincenter.php?site=settings_games"><?php echo $_language->module['games']; ?></a></li>
                                <li><a href="admincenter.php?site=modrewrite"><?php echo $_language->module['modrewrite']; ?></a></li>
                                <li><a href="admincenter.php?site=email"><?php echo $_language->module['email']; ?></a></li>
                                <?php echo admincenternav(5); ?>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-font"></i> <?php echo $_language->module['content']; ?><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">                              
                                <?php echo admincenternav(6); ?>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                        <?php } if (isforumadmin($userID)) { ?>

                        <li>
                            <a href="#"><i class="fa fa-list"></i> <?php echo $_language->module['forum']; ?><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <?php echo admincenternav(7); ?>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
 
                        <?php } if (ispageadmin($userID)) { ?>
                        <li>
                            <a href="#"><i class="fa fa-arrow-right"></i> <?php echo $_language->module['plugin_base']; ?><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="admincenter.php?site=plugin-manager"><?php echo $_language->module['plugin_manages']; ?></a></li>
                                <li><a href="admincenter.php?site=plugin-installer"><?php echo $_language->module['plugin_installer']; ?></a></li>
                                <li><a href="admincenter.php?site=plugin-widgets"><?php echo $_language->module['plugin-widgets']; ?></a></li>
                                <?php echo admincenternav(9); ?>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        
                        <?php
                        } 
                        
                        if (isuseradmin($userID)) {
                            echo dashnavi();
                        }
                        ?>
                       
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->

                <!-- Copy -->
                <div class="copy">
                <em>&nbsp;&copy; 2019 webspell | RM&nbsp;Admin Template by <a href="http://www.webspell-rm.de" target="_blank">T-Seven</a></em>
                </div>
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                
                <!-- /.col-lg-12 -->
                <div class="col-lg-12">
                    <br />
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
                echo "<b>Modul [or] Plugin Not found</b><br /><br />";
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
    <script src="../components/admin/js/bootstrap-colorpicker.js"></script>
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
			$(document).ready(function(){
				$('[data-toggle="tooltip"]').tooltip(); 
			});
		}); 
    </script>
   
    <!-- Bootstrap -->
    <script src="../components/admin/js/bootstrap.min.js"></script>
    <script src="../components/admin/js/bootstrap-switch.js"></script>

    <!-- DataTables -->
    <script src="../components/datatables/js/jquery.dataTables.min.js"></script>

    <!-- Menu Plugin JavaScript -->
    <script src="../components/admin/js/menu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../components/admin/js/page.js"></script>

    <script src="../components/admin/js/index.js"></script>
    <script>
        var calledfrom='admin';
    </script>
    <script src="../components/js/bbcode.js"></script>
    <script>
    $(document).ready(function () {

        $('#plugini').dataTable({
            "language": {
                "url": "../components/datatables/langs/German.lang"
            }
        });

        $('#confirm-delete').on('show.bs.modal', function (e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
            
            $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
        });

    });
    </script>
    <script>
  initSample();
</script>
</body>
</html>
