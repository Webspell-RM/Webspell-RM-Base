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
$_language->readModule('index');

$index_language = $_language->module;
// end important data include
$cookievalue = 'false'; 
if(isset($_COOKIE['cookie'])) { 
    $cookievalue = 'accepted';  
}
header('X-UA-Compatible: IE=edge,chrome=1');
?>
<!DOCTYPE html>
<html class="h-100" lang="<?php echo $_language->language ?>">
<head>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="description" content="Website using webSPELL-RM CMS">
    <meta name="keywords" content="Clandesign, Webspell, Webspell | RM, Wespellanpassungen, Webdesign, Tutorials, Downloads, Webspell-rm, rm, addon, plugin, Templates Webspell Addons, Webspell-rm, rm, plungin, mods, Wespellanpassungen, Modifikationen und Anpassungen und mehr!">
    <meta name="robots" content="all">
    <meta name="abstract" content="Anpasser an Webspell | RM">
    <meta name="copyright" content="Copyright &copy; 2018-2019 by webspell-rm.de">
    <meta name="author" content="webspell-rm.de">
    <meta name="revisit-After" content="1days">
    <meta name="distribution" content="global">
    <link rel="SHORTCUT ICON" href="./includes/themes/<?php echo $theme_name; ?>/templates/favicon.ico">
 
    <!-- Head & Title include -->
    <title><?= get_sitetitle(); ?></title>

    <!--<base href="<?php echo $hp_url; ?>">-->
    <base href="<?php echo $rewriteBase; ?>">

    <link href="tmp/rss.xml" rel="alternate" type="application/rss+xml" title="<?php echo $myclanname; ?> - RSS Feed">

    <?php
        /* Components & themes css / js */
        echo $components_css;
        echo $components_js;
        echo $theme_css;
        echo $theme_js;
        /* Components & themes css / js END*/

        /* Plugin-Manager  css */
        echo ($_pluginmanager->plugin_loadheadfile_css());
        /* Plugin-Manager  css END*/
        
        /*function setplugincss($modul) {
          global $_pluginmanager;
          $modul == '';
          if($modul !== ''){
            echo $_pluginmanager->plugin_loadheadfile_css('',$modul);
          }
        }*/
    ?>
    <!-- <link type="text/css" rel="stylesheet" href="./includes/plugins/<?php #get_sitecss(); ?>/css/<?php #get_sitecss(); ?>.css">-->
    
    <link rel='stylesheet' id='font-roboto-css'  href='//fonts.googleapis.com/css?family=Roboto%3A300%2C400%2C700&#038;ver=4.7.2' type='text/css' media='all' />
    <link href="tmp/rss.xml" rel="alternate" type="application/rss+xml" title="<?php echo $myclanname; ?> - RSS Feed">

    <!-- Module DB Abfrage -->
    <?php echo get_hide(); ?>
    <!-- Module DB Abfrage END -->

    <script src='https://www.google.com/recaptcha/api.js'></script>
    <?php include('./system/ckeditor.php'); ?>
    <?php echo getcookiescript(); ?> 
    
</head>
<body>
	<div class="d-flex flex-column sticky-footer-wrapper"> <!-- flex -->

        <!-- Navigation Modul -->
        <?php #include(MODULE."navigation_content.php"); ?>
 		<!-- Navigation Modul END-->

        <!-- Head Modul -->
        <?php echo get_navigation_modul();?>
        <!-- Head Modul END-->

		<!-- Head Modul -->
        <?php echo get_head_modul();?>
        <!-- Head Modul END-->

    <main class="flex-fill">  <!-- flex -->
        <div class="container"> <!-- container-content -->
            <div class="row"> <!-- row -->

                <!-- left column linke Spalte -->
               <?php if (!in_array($site, $hide3)) { ?>
               <?php if (!in_array($site, $hide1)) { ?>
                
                <div id="leftcol" class="col-md-3" >
                    <h2><span><i class="fa fa-info"></i>&nbsp;Info</span></h2>
                    <?php echo get_left_side ();?>
                </div>

                <?php } ?>
                <?php } ?>
                <!-- left column linke Spalte END -->

                <!-- main content area -->
                <div id="maincol" class="<?php echo get_mainhide(); ?>">
                
                <!-- content Center Head -->	
                <?php if (!in_array($site, $hide4)) {echo get_center_head();}?>
                <!-- content Center Head End-->

                <!-- Main Content -->
                <?php echo get_mainContent(); ?>
                <!-- Main Content End-->

                <!-- content Center Footer -->
                <?php if (!in_array($site, $hide5)) {echo get_center_footer();}?>
                <!-- content Center Footer END -->

                </div>
				<!-- main content area END -->

                <!-- right column rechte Spalte -->
                <?php if (!in_array($site, $hide3)) { ?>
                <?php if (!in_array($site, $hide2)) { ?>
                
                <div id="rightcol" class="col-md-3">
                    <h2><span><i class="fa fa-info"></i>&nbsp;Info</span></h2>
                    <?php echo get_right_side ();?>
                </div>

                <?php } ?>
                <?php } ?>
                <!-- right column rechte Spalte END -->
                
            </div> <!-- row End -->
        </div> <!-- container-content End -->
    </main>
    <footer>
        <!-- Foot top Abstand zum main content -->
        <div id="footcol"></div>
        <!-- Foot top Abstand zum main content END -->
        <!-- Foot Modul -->
        <?php echo get_foot_modul(); ?>
        <!-- Foot Modul END-->
    </footer>
</div>  <!-- flex END -->
    <!-- scroll to top feature -->
    <div class="scroll-top-wrapper"> 
        <span class="scroll-top-inner">
            <i class="fa fa-2x fa-arrow-circle-up"></i>
        </span>
    </div>
    <!-- scroll to top feature END -->
    
    <!-- Plugin-Manager  js -->
    <?=  ($_pluginmanager->plugin_loadheadfile_js());?>
    <!-- Plugin-Manager  js END-->


    <script language="javascript">

        $(document).ready(function () {
          $('.dropdown').hover(function () {
            $('.dropdown-toggle', this).trigger('click');
          });
        });

        webshim.setOptions('basePath', 'components/webshim/js-webshim/minified/shims/');
        //request the features you need:
        webshim.setOptions("forms-ext",
        {
            replaceUI: false,
            types: "date time datetime-local"
        });
        webshim.polyfill('forms forms-ext');

        $(document).ready(function () {

            $("body").tooltip({
                selector: "[data-toggle='tooltip']",
                container: "body"
            });

        });

    </script>
</body>
</html>
