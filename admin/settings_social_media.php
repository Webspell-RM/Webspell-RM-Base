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
\------------------------------------------------------------------*/
$_language->readModule('social_media', false, true);

$ergebnis = safe_query("SELECT * FROM ".PREFIX."navigation_dashboard_links WHERE modulname='social_media'");
    while ($db=mysqli_fetch_array($ergebnis)) {
      $accesslevel = 'is'.$db['accesslevel'].'admin';

if (!$accesslevel($userID) || mb_substr(basename($_SERVER[ 'REQUEST_URI' ]), 0, 15) != "admincenter.php") {
    die($_language->module[ 'access_denied' ]);
}
}



if (isset($_GET[ 'action' ])) {
    $action = $_GET[ 'action' ];
} else {
    $action = '';
}

if (isset($_POST[ "saveedit" ])) {
    $twitch = $_POST[ "twitch" ];
    $facebook = $_POST[ "facebook" ];
    $twitter = $_POST[ "twitter" ];
    $youtube = $_POST[ "youtube" ];
    $rss = $_POST[ "rss" ];
    $vine = $_POST[ "vine" ];
    $flickr = $_POST[ "flickr" ];
    $linkedin = $_POST[ "linkedin" ];
    $instagram = $_POST[ "instagram" ];
    $gametracker = $_POST[ "gametracker" ];
    $discord = $_POST[ "discord" ];
    $since = $_POST[ "since" ];
    $socialID = $_POST[ "socialID" ];
    
    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_POST[ 'captcha_hash' ])) {
        
            safe_query(
                "UPDATE
                    `" . PREFIX . "settings_social_media`
                SET
                    `twitch` = '" . $twitch . "',
                    `facebook` = '" . $facebook . "',
                    `twitter` = '" . $twitter . "',
                    `facebook` = '" . $facebook . "',
                    `youtube` = '" . $youtube . "',
                    `rss` = '" . $rss . "',
                    `vine` = '" . $vine . "',
                    `flickr` = '" . $flickr . "',
                    `linkedin` = '" . $linkedin . "',
                    `instagram` = '" . $instagram . "',
                    `gametracker` = '" . $gametracker . "',
                    `discord` = '" . $discord . "',
                    `since` = '" . $since. "'
                WHERE `socialID` = '".$socialID."'"
            );

            $errors = array();
            $_language->readModule('formvalidation', true);

            if (count($errors)) {
                $errors = array_unique($errors);
                echo generateErrorBoxFromArray($_language->module['errors_there'], $errors);
            }

        } else {
            echo $_language->module['information_incomplete'];
        }
   redirect("admincenter.php?site=settings_social_media", "", 0);    
}
else {

  $ds =
        mysqli_fetch_array(safe_query(
            "SELECT * FROM " . PREFIX . "settings_social_media"));

    $CAPCLASS = new \webspell\Captcha;
    $CAPCLASS->createTransaction();
    $hash = $CAPCLASS->getHash();
    
    echo '<div class="card">
    <div class="card-header"> <i class="fa fa-info-circle"></i> ' . $_language->module[ 'title' ] . '
    </div>
    <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page"><a href="admincenter.php?site=settings_social_media" class="white">' . $_language->module[ 'title' ] . '</a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit</li>
  </ol>
</nav>
    <div class="card-body">';

    echo '<form action="admincenter.php?site=settings_social_media" method="post" name="post" role="form"
            class="form-horizontal">


<div class="form-group">
                <label for="select-squad" class="col-xs-12 col-md-2 control-label"><i class="far fa-clock"></i>&nbsp;Since:</label>

                <div class="col-xs-12 col-md-10">
                    
                    <input type="text" name="since" class="form-control" value="'.getinput($ds['since']).'">
                </div>
            </div>

<div class="form-group">
                <label for="select-squad" class="col-xs-12 col-md-2 control-label"><i class="fas fa-gamepad"></i>&nbsp;Gametracker:<br><small>(Für Social-Sidebar Widget)</small></label>

                <div class="col-xs-12 col-md-10">
                    
                    <input type="text" name="gametracker" class="form-control" value="'.getinput($ds['gametracker']).'">
                </div>
            </div>            

<div class="form-group">
                <label for="select-squad" class="col-xs-12 col-md-2 control-label"><i class="fab fa-discord"></i>&nbsp;Discord:<br><small>(Für Social-Sidebar Widget)</small></label>

                <div class="col-xs-12 col-md-10">
                    
                    <input type="text" name="discord" class="form-control" value="'.getinput($ds['discord']).'">
                </div>
            </div>

<hr>
<div class="form-group">
                <label for="select-squad" class="col-xs-12 col-md-2 control-label"><i class="fab fa-twitch"></i>&nbsp;twitch:</label>

                <div class="col-xs-12 col-md-10">
                    
                    <input type="text" name="twitch" class="form-control" value="'.getinput($ds['twitch']).'">
                </div>
            </div>             

<div class="form-group">
                <label for="select-squad" class="col-xs-12 col-md-2 control-label"><i class="fab fa-facebook-f"></i>&nbsp;facebook:</label>

                <div class="col-xs-12 col-md-10">
                    
                    <input type="text" name="facebook" class="form-control" value="'.getinput($ds['facebook']).'">
                </div>
            </div> 

 <div class="form-group">
                <label for="select-squad" class="col-xs-12 col-md-2 control-label"><i class="fab fa-twitter"></i>&nbsp;twitter:</label>

                <div class="col-xs-12 col-md-10">
                    
                    <input type="text" name="twitter" class="form-control" value="'.getinput($ds['twitter']).'">
                </div>
            </div>

<div class="form-group">
                <label for="select-squad" class="col-xs-12 col-md-2 control-label"><i class="fab fa-youtube"></i>&nbsp;youtube:</label>

                <div class="col-xs-12 col-md-10">
                    
                    <input type="text" name="youtube" class="form-control" value="'.getinput($ds['youtube']).'">
                </div>
            </div>

<div class="form-group">
                <label for="select-squad" class="col-xs-12 col-md-2 control-label"><i class="fas fa-rss"></i>&nbsp;rss:</label>

                <div class="col-xs-12 col-md-10">
                    
                    <input type="text" name="rss" class="form-control" value="'.getinput($ds['rss']).'">
                </div>
            </div>

<div class="form-group">
                <label for="select-squad" class="col-xs-12 col-md-2 control-label"><i class="fab fa-vine"></i>&nbsp;vine:</label>

                <div class="col-xs-12 col-md-10">
                    
                    <input type="text" name="vine" class="form-control" value="'.getinput($ds['vine']).'">
                </div>
            </div>

<div class="form-group">
                <label for="select-squad" class="col-xs-12 col-md-2 control-label"><i class="fab fa-flickr"></i>&nbsp;flickr:</label>

                <div class="col-xs-12 col-md-10">
                    
                    <input type="text" name="flickr" class="form-control" value="'.getinput($ds['flickr']).'">
                </div>
            </div>

<div class="form-group">
                <label for="select-squad" class="col-xs-12 col-md-2 control-label"><i class="fab fa-linkedin-in"></i>&nbsp;linkedin:</label>

                <div class="col-xs-12 col-md-10">
                    
                    <input type="text" name="linkedin" class="form-control" value="'.getinput($ds['linkedin']).'">
                </div>
            </div>

<div class="form-group">
                <label for="select-squad" class="col-xs-12 col-md-2 control-label"><i class="fab fa-instagram"></i>&nbsp;instagram:</label>

                <div class="col-xs-12 col-md-10">
                    
                    <input type="text" name="instagram" class="form-control" value="'.getinput($ds['instagram']).'">
                </div>
            </div>

<input type="hidden" name="captcha_hash" value="' . $hash . '" />
                <input type="hidden" name="socialID" value="' . $ds[ 'socialID' ] . '" />

<input class="btn btn-warning" type="submit" name="saveedit" value="' . $_language->module[ 'edit' ] . '" />

</form></div>
  </div>







































   ';
}
?>