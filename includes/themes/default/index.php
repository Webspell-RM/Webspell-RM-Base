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



$_language->readModule('index');

$index_language = $_language->module;
// end important data include

header('X-UA-Compatible: IE=edge,chrome=1');
?>
<!DOCTYPE html>
<html lang="<?php echo $_language->language ?>">
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
    <link rel="SHORTCUT ICON" href="/includes/themes/default/templates/favicon.ico">
 
    <!-- Head & Title include -->
    <title><?php
    $sitetitle = new plugin_manager();
    if(isset($_GET['site']) AND $sitetitle->plugin_updatetitle($_GET['site'])) {
        echo $sitetitle->plugin_updatetitle($_GET['site']);
    } else {
        echo PAGETITLE;
    }
     ?></title>
    <base href="<?php echo $rewriteBase; ?>">

    <link href="tmp/rss.xml" rel="alternate" type="application/rss+xml" title="<?php echo $myclanname; ?> - RSS Feed">

    <!-- Plugin-Manager 1.2 load css/js -->
    <?php
        $load = new plugin_manager();
        echo ($load->plugin_loadheadfile());
    ?>

    <!-- end Head & Title include -->
   <?php
        /* Components & themes css / js */
        echo $components_css;
        echo $components_js;
        echo $theme_css;
        echo $theme_js;
        /* Plugin-Manager  css / js */
        echo ($_pluginmanager->plugin_loadheadfile());

    ?>
    <link rel='stylesheet' id='font-roboto-css'  href='//fonts.googleapis.com/css?family=Roboto%3A300%2C400%2C700&#038;ver=4.7.2' type='text/css' media='all' />
    <link href="tmp/rss.xml" rel="alternate" type="application/rss+xml" title="<?php echo $myclanname; ?> - RSS Feed">

    <?php get_hide(); ?>
    <?php widgets_hide (); ?>

    <script src='https://www.google.com/recaptcha/api.js'></script>

</head>
<body>

     <nav class="nav navbar navbar-expand-md navbar-default fixed-top">

        <div class="container navi">
            <a class="navbar-brand" href="#">
                <img src="./includes/themes/<?php echo $theme_name; ?>/images/<?php echo $logo; ?>" alt="">
            </a>
            <button class="navbar-toggler"
                    type="button"
                    data-toggle="collapse"
                    data-target="#navbarsExampleDefault"
                    aria-controls="navbarsExampleDefault"
                    aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExampleDefault" style="height: 85px">
                <ul class="navbar-nav mr-auto animated fadeInDown">
                    <?php include(MODULE."navigation.php"); ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?site=login">
                            <?php
                            echo ($loggedin) ?
                                ucfirst($index_language[ 'overview' ]) : ucfirst($index_language[ 'login' ]);
                            ?>
                        </a>
                    </li>
                </ul>
            </div>

        </div>

        <!-- Switscher -->
        <div class="switcher mr-auto">
            <div class=" d-flex justify-content-end">
                <div class="deu pl-2 ">
                    <?php  include(MODULE."language.php"); ?>
                </div>

            </div>
        </div>

    </nav>

    <div class="wrapper">

            <?php
            if (!in_array($site, $hide)) {
                echo "<div id='headcol'></div>";
                $widget_menu = new widgets();
                $widget_menu->registerWidget("page_head_widget","Diese Box ist oben auf der Seite", "vertical_widget_box");
            } else {
                echo"<div id='noheadcol'></div>";
            }
            ?>

        <div class="container">

            <div class="row">
               <?php /* show left column */ if (!in_array($site, $hide3)) { ?>
               <?php /* show left column */ if (!in_array($site, $hide1)) { ?>

                <!-- left column -->
                <div id="leftcol" class="col-lg-3 visible-lg" >

                    <h2><span><i class="fa fa-info"></i>&nbsp;Info</span></h2>
                    <?php
                        $widget_menu = new widgets();
                        $widget_menu->registerWidget("Left_Side_Widget","Diese Box ist auf der linken Seite", "vertical_widget_box");
                    ?>

                </div>

                <?php /* end of show left column*/ } ?>
                <?php /* end of show right column */ } ?>

                <!-- main content area -->
                <div id="maincol" class="<?php echo get_mainhide(); ?>">

                <?php

                if (!in_array($site, $hide4)) {
                    $widget_menu = new widgets();
                    $widget_menu->registerWidget("center_head_Widget","Diese Box ist oben im Center", "vertical_widget_box");
                } else {
                    echo "";
                }

                if (!isset($_GET['site'])) {
                    $site = "startpage";
                } else {
                    $site = getinput($_GET['site']);
                }


                $invalide = array('\\', '/', '/\/', ':', '.');
                $site = str_replace($invalide, ' ', $site);
                $_plugin = new plugin_manager();
                $_plugin->set_debug(DEBUG);
                if (!empty($site) AND $_plugin->is_plugin($site)>0) {
                    $data = $_plugin->plugin_data($site);
                    $plugin_path = $data['path'];
                    $check = $_plugin->plugin_check($data, $site);
                    if ($check['status']==1) {
                        $inc = $check['data'];
                        if ($inc=="exit") {
                            if($notfoundpage=true) {
                                $site = "404";
                            } else {
                                $site = "startpage";
                            }
                            include(MODULE.$site . ".php");
                        } else {
                            include($check['data']);
                        }
                    } else {
                        echo $check['data'];
                    }
                } else {
                    if (!file_exists(MODULE.$site . ".php")) {
                        if ($notfoundpage=true) {
                            $site = "404";
                        } else {
                            $site = "startpage";
                        }
                    }
                    include(MODULE.$site . ".php");
                }
                ?>

                    <br />

                    <?php
                    if (!in_array($site, $hide5)) {
                        $widget_menu = new widgets();
                        $widget_menu->registerWidget("center_footer_Widget","Diese Box ist unten im Center", "vertical_widget_box");
                    } else {
                        echo "";
                    }
                    ?>

                </div>

                <?php /* show right column */ if (!in_array($site, $hide3)) { ?>
                <?php /* show right column */ if (!in_array($site, $hide2)) { ?>

                <!-- right column -->
                <div id="rightcol" class="col-md-3 col-sm-3 hidden-xs">

                    <!-- right include -->
                    <h2><span><i class="fa fa-info"></i>&nbsp;Info</span></h2>
                    <?php
                        $widget_menu = new widgets();
                        $widget_menu->registerWidget("Right_Side_Widget","Diese Box ist auf der rechten Seite", "vertical_widget_box");
                    ?>

                </div>

                <?php /* end of show right column */ } ?>
                <?php /* end of show right column */ } ?>

            </div> <!-- row-end -->
        </div> <!-- container-content-end -->

        <div id="footcol"></div>

        <?php
            $widget_menu = new widgets();
            $widget_menu->registerWidget("page_footer_Widget","Diese Box ist unten auf der Seite", "vertical_widget_box");
        ?>

    </div>  <!-- wrapper-end -->

    <div class="scroll-top-wrapper">  <!-- scroll to top feature -->
        <span class="scroll-top-inner">
            <i class="fa fa-2x fa-arrow-circle-up"></i>
        </span>
    </div>

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
