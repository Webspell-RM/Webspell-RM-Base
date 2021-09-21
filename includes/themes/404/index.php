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
    <link href="components/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="components/fontawesome/css/all.css" rel="stylesheet">
 
    <!-- Head & Title include -->
    <title><?= get_sitetitle(); ?></title>

    <base href="<?php echo $rewriteBase; ?>">

    <link href="tmp/rss.xml" rel="alternate" type="application/rss+xml" title="<?php echo $myclanname; ?> - RSS Feed">
    
   
</head>
<body>

    <div class="d-flex flex-column sticky-footer-wrapper"> <!-- flex -->

        <main class="flex-fill">  <!-- flex -->
        
            <div class="container"> <!-- container-content container-fluid -->



	<style type="text/css">
p.test {font-family: Georgia, serif;
    font-size: 78px;
    font-style: italic;}

.titlehead {     border: 3px solid;
border-color: #c4183c;}
</style>
<div class="card">
    <div class="card-body">
        <div class="titlehead"><br>
            <center>
        <div>
              <small>Ohje !</small><br>
              <p class="test">404 Error.</p><br>
              <p>Die angefragte Seite konnte nicht gefunden werden. <i><b>Aktiviere ein Template im Dashbord!</b></i><br>The requested page could not be found. <i><b>Activate a template in the dashboard!</b></i></p>
        </div>
              <p><a class="btn btn-warning" href="/admin/admincenter.php?site=settings_templates">Theme / Style</a></p>
              <br />
            </center>
        </div>
    </div>
</div>

</div></main></div>

</body>
</html>
