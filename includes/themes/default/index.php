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
\¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*/
$_language->readModule('index');

$index_language = $_language->module;

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
    <meta name="keywords" content="Clandesign, Webspell, Webspell | RM, Wespellanpassungen, Webdesign, Tutorials, Downloads, Webspell-rm, rm, addon, plugin, Templates Webspell Addons, Webspell-rm, rm, plungin, mods, Webspellanpassungen, Modifikationen und Anpassungen und mehr!">
    <meta name="robots" content="all">
    <meta name="abstract" content="Anpasser an Webspell | RM">
    <meta name="copyright" content="Copyright &copy; 2018-2021 by webspell-rm.de">
    <meta name="author" content="webspell-rm.de">
    <meta name="revisit-After" content="1days">
    <meta name="distribution" content="global">
    <link rel="SHORTCUT ICON" href="./includes/themes/<?php echo $theme_name; ?>/templates/favicon.ico">
 
    <!-- Head & Title include -->
    <title><?= get_sitetitle(); ?></title>

    <base href="<?php echo $rewriteBase; ?>">

    <link href="tmp/rss.xml" rel="alternate" type="application/rss+xml" title="<?php echo $myclanname; ?> - RSS Feed">
    
    <?php
         /* Plugin-Manager  css */
        echo ($_pluginmanager->plugin_loadheadfile_css());
        /* Plugin-Manager  css END*/

        /* Components & themes css */
        echo $components_css;
        echo $theme_css;
        /* Components & themes css END*/


        /*  Components & themes js */ 
        echo $components_js;
        echo $theme_js;
        /*  Components & themes css / js  END */
    
        /* Plugin-Manager  js */
        echo ($_pluginmanager->plugin_loadheadfile_js());
        /* Plugin-Manager  js END */
    

	
    	/* Module DB Abfrage */
    	echo get_hide();
    	/* Module DB Abfrage END */

    	/* Cookie Abfrage */
    	echo getcookiescript();  
    	/* Cookie Abfrage END*/
    ?>
</head>
<body>

    
	<div class="d-flex flex-column sticky-footer-wrapper"> <!-- flex -->

        <!-- Navigation Modul -->
        <?php echo get_navigation_modul();?>
 		<!-- Navigation Modul END-->

        <!-- Head Modul -->
        <?php echo get_head_modul();?>
        <!-- Head Modul END-->

		<!-- content Center Head -->	
        <?php if (!in_array($site, $hide6)) {echo get_head_section();}?>
        <!-- content Center Head End-->

    	<main class="flex-fill">  <!-- flex -->
        
            <div class="container"> <!-- container-content container-fluid -->
            	<div class="row"> <!-- row -->

                <!-- left column linke Spalte -->
               <?php if (!in_array($site, $hide3)) { ?>
               <?php if (!in_array($site, $hide1)) { ?>
                
                <div id="leftcol" class="col-md-3"> 
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

                <!-- content Center Head -->	
                <?php if (!in_array($site, $hide5)) {echo get_center_footer();}?>
                <!-- content Center Head End-->
                
                
                </div>
				<!-- main content area END -->

                <!-- right column rechte Spalte -->
                <?php if (!in_array($site, $hide3)) { ?>
                <?php if (!in_array($site, $hide2)) { ?>
                
                <div id="rightcol" class="col-md-3">
                    <?php echo get_right_side ();?>
                </div>

                <?php } ?>
                <?php } ?>
                <!-- right column rechte Spalte END -->
				</div> <!-- row End -->
        	</div> <!-- container-content End -->

        
    	</main>
    	<!-- content Center Footer -->
        <?php if (!in_array($site, $hide7)) {echo get_foot_section();}?>
        <!-- content Center Footer END -->
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

    
   
    <?php include('./system/ckeditor.php'); ?>
    <script src='https://www.google.com/recaptcha/api.js'></script>

</body>
</html>
