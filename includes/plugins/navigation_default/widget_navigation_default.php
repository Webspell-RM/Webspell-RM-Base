<?php
/*-----------------------------------------------------------------\
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
\------------------------------------------------------------------*/

# Sprachdateien aus dem Plugin-Ordner laden
    $pm = new plugin_manager(); 
    $plugin_language = $pm->plugin_language("navigation", $plugin_path);
    GLOBAL $logo,$theme_name,$themes,$tpl,$loggedin,$index_language,$modRewrite,$action;


    $ergebnis=safe_query("SELECT * FROM ".PREFIX."settings_themes WHERE active = 1");
        $ds=mysqli_fetch_array($ergebnis);
    ?>
    <link href="/includes/plugins/navigation_default/css/styles.css" rel="stylesheet" />
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container logo-box">
             
            <span class="logo"><a class="navbar-brand" href="#"><img class="float-left bg-primary rounded" src="./includes/themes/<?php echo $theme_name; ?>/images/<?php echo $logo; ?>" alt=""></span>
                <div class="box">
                    <span class="webspell"><?php echo $ds[ 'logotext1' ];?></span>
                    <span class="slogan"><?php echo $ds[ 'logotext2' ];?></span>
               </div>
            </a>
             
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mob-navbar" aria-label="Toggle">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mob-navbar">
                <ul class="navbar-nav mb-2 mb-lg-0 mx-auto">
                    <?php include("./includes/modules/navigation.php"); ?>
                    <?php include("./includes/modules/navigation_login.php"); ?>
                    <?php include("./includes/modules/language.php"); ?>
                </ul>
            </div>
        </div>
    </nav>
