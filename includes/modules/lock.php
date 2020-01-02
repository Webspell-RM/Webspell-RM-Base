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

echo'<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="description" content="Website using webSPELL-RM CMS">
	<meta name="keywords" content="Clandesign, Webspell, Webspell | RM, Wespellanpassungen, Webdesign, Tutorials, Downloads, Webspell-rm, rm, addon, plugin, Templates Webspell Addons, Webspell-rm, rm, plungin, mods, Wespellanpassungen, Modifikationen und Anpassungen und mehr!">
    <meta name="robots" content="all">
    <meta name="abstract" content="Anpasser an Webspell | RM">
    <meta name="copyright" content="Copyright &copy; 2017-2019 by webspell-rm.de">
    <meta name="author" content="webspell-rm.de">
    <meta name="revisit-After" content="1days">
    <meta name="distribution" content="global">
    <link rel="SHORTCUT ICON" href="/includes/themes/default/templates/favicon.ico">

    <title>'.$pagetitle.'</title>
    <base href="$rewriteBase">
    <link href="../components/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="../components/css/lockpage.css" rel="stylesheet" type="text/css">
    
</head>

<body>
<section id="cover">
    <div id="cover-caption" class="lock_wrapper">
        <div id="container" class="container">
            <div class="row text-white">
                <div class="col-sm-9 offset-sm-1 text-center">
                  <h2>'.$pagetitle.'</h2>
            <img class="img-fluid" src="images/logo.png" alt=""/>
             <div class="shdw"></div>
        
        <div class="card"><div class="card-body"><p>'.$reason.'</p></div></div>
        <div class="shdw"></div>
        <h5>Admin Login</h5>
       
                    <div class="info-form col-sm-6 offset-sm-3 text-center">
                        
                        <form class="form-inlin justify-content-center" method="post" name="login" action="/includes/modules/checklogin.php">
                            <div class="form-group">
                                <label class="sr-only">Email</label>
                                Email<input name="ws_user" type="text"  class="form-control" placeholder="Username">
                            </div>
                            <div class="form-group">
                                <label class="sr-only">Passwort</label>
                                Passwort<input name="password" type="password" class="form-control" placeholder="Password">
                            </div>
                            <button type="submit" name="Submit" class="btn btn-success ">okay, go!</button>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>';
