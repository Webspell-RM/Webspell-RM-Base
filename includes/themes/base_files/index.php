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
 * @copyright       2018-2024 by webspell-rm.de <https://www.webspell-rm.de>                                                          *
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

$_language->readModule('index');

$index_language = $_language->module;

$cookievalue = 'false'; 
if(isset($_COOKIE['ws_cookie'])) { 
    $cookievalue = 'accepted';  
}
header('X-UA-Compatible: IE=edge,chrome=1');
?>
<!DOCTYPE html>
<html class="h-100" lang="<?php echo $_language->language ?>">
<head>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="description" content="Kostenlose Homepage erstellen mit webSPELL-RM CMS: Einfach, schnell &amp; kostenlos! Vorlage und Plugins wählen und in wenigen Minuten mit der eigenen Website online gehen.">
    <meta name="keywords" content="Clandesign, Webspell, Webspell-RM, Wespellanpassungen, Webdesign, Tutorials, Downloads, Webspell-rm, rm, addon, plugin, Templates Webspell Addons, plungin, mods, Webspellanpassungen, Modifikationen und Anpassungen und mehr!">
    <meta name="robots" content="all">
    <meta name="abstract" content="Anpasser an Webspell | RM">
    <meta name="copyright" content="Copyright &copy; 2018-2024 by webspell-rm.de">
    <meta name="author" content="webspell-rm.de">
    <meta name="revisit-After" content="1days">
    <meta name="distribution" content="global">
    <link rel="SHORTCUT ICON" href="./includes/themes/<?php echo $theme_name; ?>/templates/favicon.ico">
 
    <!-- Head & Title include -->
    <title><?= get_sitetitle(); ?></title>

    <base href="<?php echo $rewriteBase; ?>">

    <link href="tmp/rss.xml" rel="alternate" type="application/rss+xml" title="<?php echo $myclanname; ?> - RSS Feed">
    <link rel="stylesheet" href="../components/cookies/css/cookieconsent.css" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="../components/cookies/css/iframemanager.css" media="print" onload="this.media='all'">
    <?php
         
        /* Components & themes css */
        echo $components_css;
        echo $theme_css;
        /* Components & themes css END*/

        /* Plugin-Manager  css */
        echo ($_pluginmanager->plugin_loadheadfile_css());
        /* Plugin-Manager  css END*/

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

        /* ckeditor */
        echo get_editor();
        /* ckeditor END*/
    ?>
</head>
<body>
    
    <div class="d-flex flex-column sticky-footer-wrapper"> <!-- flex -->
        <?php if (!in_array($site, $hide9)) {echo get_via_navigation_modul();}?> 
        <!-- Navigation Modul --> 
        <?php echo get_navigation_modul();?>    
        <?php echo get_lock_modul();?>
        <?php echo get_head_modul();?>
        <?php echo get_headelements();?>
        
        <?php if (!in_array($site, $hide6)) {echo get_head_section();}?>
       
        <!-- content Center Head End-->

        <main class="flex-fill">  <!-- flex -->
        
            <div class="container con1tent_style"> <!-- container -->
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
            <!-- Foot Modul -->
            <?php echo get_foot_modul(); ?>
            <!-- Foot Modul END-->
        </footer>
    </div>  <!-- flex END -->
    <!-- scroll to top feature -->
    <div class="scroll-top-wrapper"> 
        <span class="scroll-top-inner">
            <i class="bi bi-arrow-up-circle" style="font-size: 2rem;"></i>
        </span>
    </div>
    <!-- scroll to top feature END --> 
    <div class="cookies-wrapper"> 
        <span class="cookies-top-inner">
            <i class="bi bi-gear" style="font-size: 2rem;" data-cc="c-settings" data-toggle="tooltip" data-bs-title="Cookie settings"></i>
        </span>
    </div>

    <!-- Link muss noch geändert werden-->
    <script src='https://www.google.com/recaptcha/api.js'></script>

    <!-- Cookies Abfrage -->
    <script defer src="../components/cookies/js/iframemanager.js"></script>
    <script defer src="../components/cookies/js/cookieconsent.js"></script>
    <script defer src="../components/cookies/js/cookieconsent-init.js"></script>
    <script defer src="../components/cookies/js/app.js"></script>

    <!-- Language recognition for DataTables -->
    <script>const LangDataTables = '$_language->language';</script>
<script type="text/javascript">
        // Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
})()
</script>
</body>
</html>
