<?php
/**
 *¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
 *                  Webspell-RM      /                        /   /                                          *
 *                  -----------__---/__---__------__----__---/---/-----__---- _  _ -                         *
 *                   | /| /  /___) /   ) (_ `   /   ) /___) /   / __  /     /  /  /                          *
 *                  _|/_|/__(___ _(___/_(__)___/___/_(___ _/___/_____/_____/__/__/_                          *
 *                               Free Content / Management System                                            *
 *                                           /                                                               *
 *¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
 * @version         webspell-rm                                                                              *
 *                                                                                                           *
 * @copyright       2018-2023 by webspell-rm.de                                                              *
 * @support         For Support, Plugins, Templates and the Full Script visit webspell-rm.de                 *
 * @website         <https://www.webspell-rm.de>                                                             *
 * @forum           <https://www.webspell-rm.de/forum.html>                                                  *
 * @wiki            <https://www.webspell-rm.de/wiki.html>                                                   *
 *                                                                                                           *
 *¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
 * @license         Script runs under the GNU GENERAL PUBLIC LICENCE                                         *
 *                  It's NOT allowed to remove this copyright-tag                                            *
 *                  <http://www.fsf.org/licensing/licenses/gpl.html>                                         *
 *                                                                                                           *
 *¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
 * @author          Code based on WebSPELL Clanpackage (Michael Gruber - webspell.at)                        *
 * @copyright       2005-2011 by webspell.org / webspell.info                                                *
 *                                                                                                           *
 *¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
*/

global $myclanname;
$ergebnis = safe_query("SELECT * FROM `".PREFIX."settings_social_media`");
if(mysqli_num_rows($ergebnis)){
    while ($ds = mysqli_fetch_array($ergebnis)) {
        $since=$ds['since'];

        if ($ds[ 'twitch' ] != '') {
            if (stristr($ds[ 'twitch' ], "https://")) {
                $twitch = '<a class="twitch" href="' . htmlspecialchars($ds[ 'twitch' ]) . '" target="_blank" rel="nofollow"><i class="bi bi-twitch" style="font-size: 2rem;"></i></a>';//https
            } else {
                $twitch = '<a class="twitch" href="http://' . htmlspecialchars($ds[ 'twitch' ]) . '" target="_blank" rel="nofollow"><i class="bi bi-twitch" style="font-size: 2rem;"></i></a>';//http
            }
        } else {
            $twitch = '';
        }

        if ($ds[ 'facebook' ] != '') {
            if (stristr($ds[ 'facebook' ], "https://")) {
                $facebook = '<a class="facebook" href="' . htmlspecialchars($ds[ 'facebook' ]) . '" target="_blank" rel="nofollow"><i class="bi bi-facebook" style="font-size: 2rem;"></i></a>';//https
            } else {
                $facebook = '<a class="facebook" href="http://' . htmlspecialchars($ds[ 'facebook' ]) . '" target="_blank" rel="nofollow"><i class="bi bi-facebook" style="font-size: 2rem;"></i></a>';//http
            }
        } else {
            $facebook = '';
        }

        if ($ds[ 'twitter' ] != '') {
            if (stristr($ds[ 'twitter' ], "https://")) {
                $twitter = '<a class="twitter" href="' . htmlspecialchars($ds[ 'twitter' ]) . '" target="_blank" rel="nofollow"><i class="bi bi-twitter" style="font-size: 2rem;"></i></a>';//https
            } else {
                $twitter = '<a class="twitter" href="http://' . htmlspecialchars($ds[ 'twitter' ]) . '" target="_blank" rel="nofollow"><i class="bi bi-twitter" style="font-size: 2rem;"></i></a>';//http
            }
        } else {
            $twitter = '';
        }

        if ($ds[ 'youtube' ] != '') {
            if (stristr($ds[ 'youtube' ], "https://")) {
                $youtube = '<a class="youtube" href="' . htmlspecialchars($ds[ 'youtube' ]) . '" target="_blank" rel="nofollow"><i class="bi bi-youtube" style="font-size: 2rem;"></i></a>';//https
            } else {
                $youtube = '<a class="youtube" href="http://' . htmlspecialchars($ds[ 'youtube' ]) . '" target="_blank" rel="nofollow"><i class="bi bi-youtube" style="font-size: 2rem;"></i></a>';//http
            }
        } else {
            $youtube = '';
        }

        if ($ds[ 'rss' ] != '') {
            if (stristr($ds[ 'rss' ], "https://")) {
                $rss = '<a class="rss" href="' . htmlspecialchars($ds[ 'rss' ]) . '" target="_blank" rel="nofollow"><i class="bi bi-rss" style="font-size: 2rem;"></i></a>';//https
            } else {
                $rss = '<a class="rss" href="http://' . htmlspecialchars($ds[ 'rss' ]) . '" target="_blank" rel="nofollow"><i class="bi bi-rss" style="font-size: 2rem;"></i></a>';//http
            }
        } else {
            $rss = '';
        }

        if ($ds[ 'vine' ] != '') {
            if (stristr($ds[ 'vine' ], "https://")) {
                $vine = '<a class="vine" href="' . htmlspecialchars($ds[ 'vine' ]) . '" target="_blank" rel="nofollow"><svg style="fill: rgba(var(--bs-link-color),1);margin-top: -15px;" xmlns="http://www.w3.org/2000/svg" height="34" width="33" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path d="M384 254.7v52.1c-18.4 4.2-36.9 6.1-52.1 6.1-36.9 77.4-103 143.8-125.1 156.2-14 7.9-27.1 8.4-42.7-.8C137 452 34.2 367.7 0 102.7h74.5C93.2 261.8 139 343.4 189.3 404.5c27.9-27.9 54.8-65.1 75.6-106.9-49.8-25.3-80.1-80.9-80.1-145.6 0-65.6 37.7-115.1 102.2-115.1 114.9 0 106.2 127.9 81.6 181.5 0 0-46.4 9.2-63.5-20.5 3.4-11.3 8.2-30.8 8.2-48.5 0-31.3-11.3-46.6-28.4-46.6-18.2 0-30.8 17.1-30.8 50 .1 79.2 59.4 118.7 129.9 101.9z"/></svg></a>';//https
            } else {
                $vine = '<a class="vine" href="http://' . htmlspecialchars($ds[ 'vine' ]) . '" target="_blank" rel="nofollow"><svg style="fill: rgba(var(--bs-link-color),1);margin-top: -15px;" xmlns="http://www.w3.org/2000/svg" height="34" width="33" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path d="M384 254.7v52.1c-18.4 4.2-36.9 6.1-52.1 6.1-36.9 77.4-103 143.8-125.1 156.2-14 7.9-27.1 8.4-42.7-.8C137 452 34.2 367.7 0 102.7h74.5C93.2 261.8 139 343.4 189.3 404.5c27.9-27.9 54.8-65.1 75.6-106.9-49.8-25.3-80.1-80.9-80.1-145.6 0-65.6 37.7-115.1 102.2-115.1 114.9 0 106.2 127.9 81.6 181.5 0 0-46.4 9.2-63.5-20.5 3.4-11.3 8.2-30.8 8.2-48.5 0-31.3-11.3-46.6-28.4-46.6-18.2 0-30.8 17.1-30.8 50 .1 79.2 59.4 118.7 129.9 101.9z"/></svg></a>';//http
            }
        } else {
            $vine = '';
        }

        if ($ds[ 'flickr' ] != '') {
            if (stristr($ds[ 'flickr' ], "https://")) {
                $flickr = '<a class="flickr" href="' . htmlspecialchars($ds[ 'flickr' ]) . '" target="_blank" rel="nofollow"><svg style="fill: rgba(var(--bs-link-color),1);margin-top: -14px;" xmlns="http://www.w3.org/2000/svg" height="34" width="33" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path d="M400 32H48C21.5 32 0 53.5 0 80v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V80c0-26.5-21.5-48-48-48zM144.5 319c-35.1 0-63.5-28.4-63.5-63.5s28.4-63.5 63.5-63.5 63.5 28.4 63.5 63.5-28.4 63.5-63.5 63.5zm159 0c-35.1 0-63.5-28.4-63.5-63.5s28.4-63.5 63.5-63.5 63.5 28.4 63.5 63.5-28.4 63.5-63.5 63.5z"/></svg></a>';//https
            } else {
                $flickr = '<a class="flickr" href="http://' . htmlspecialchars($ds[ 'flickr' ]) . '" target="_blank" rel="nofollow"><svg style="fill: rgba(var(--bs-link-color),1);margin-top: -15px;" xmlns="http://www.w3.org/2000/svg" height="34" width="33" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path d="M400 32H48C21.5 32 0 53.5 0 80v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V80c0-26.5-21.5-48-48-48zM144.5 319c-35.1 0-63.5-28.4-63.5-63.5s28.4-63.5 63.5-63.5 63.5 28.4 63.5 63.5-28.4 63.5-63.5 63.5zm159 0c-35.1 0-63.5-28.4-63.5-63.5s28.4-63.5 63.5-63.5 63.5 28.4 63.5 63.5-28.4 63.5-63.5 63.5z"/></svg></a>';//http
            }
        } else {
            $flickr = '';
        }

        if ($ds[ 'linkedin' ] != '') {
            if (stristr($ds[ 'linkedin' ], "https://")) {
                $linkedin = '<a class="linkedin" href="' . htmlspecialchars($ds[ 'linkedin' ]) . '" target="_blank" rel="nofollow"><i class="bi bi-linkedin-in" style="font-size: 2rem;"></i></a>';//https
            } else {
                $linkedin = '<a class="linkedin" href="http://' . htmlspecialchars($ds[ 'linkedin' ]) . '" target="_blank" rel="nofollow"><i class="bi bi-linkedin-in" style="font-size: 2rem;"></i></a>';//http
            }
        } else {
            $linkedin = '';
        }

        if ($ds[ 'instagram' ] != '') {
            if (stristr($ds[ 'instagram' ], "https://")) {
                $instagram = '<a class="instagram" class="url-link" href="' . htmlspecialchars($ds[ 'instagram' ]) . '" target="_blank" rel="nofollow"><i class="bi bi-instagram" style="font-size: 2rem;"></i></a>';//https
            } else {
                $instagram = '<a class="instagram" class="url-link" href="http://' . htmlspecialchars($ds[ 'instagram' ]) . '" target="_blank" rel="nofollow"><i class="bi bi-instagram" style="font-size: 2rem;"></i></a>';//http
            }
        } else {
            $instagram = '';
        }

        if ($ds[ 'steam' ] != '') {
            if (stristr($ds[ 'steam' ], "https://")) {
                $steam = '<a class="steam" href="' . htmlspecialchars($ds[ 'steam' ]) . '" target="_blank" rel="nofollow"><i class="bi bi-steam" style="font-size: 2rem;"></i></a>';//https
        } else {
                $steam = '<a class="steam" href="http://' . htmlspecialchars($ds[ 'steam' ]) . '" target="_blank" rel="nofollow"><i class="bi bi-steam" style="font-size: 2rem;"></i></a>';//http
            }
        } else {
            $steam = '';
        }

        if ($ds[ 'discord' ] != '') {
            if (stristr($ds[ 'discord' ], "https://")) {
                $discord = '<a class="discord" href="' . htmlspecialchars($ds[ 'discord' ]) . '" target="_blank" rel="nofollow"><i class="bi bi-discord" style="font-size: 2rem;"></i></a>';//https
            } else {
                $discord = '<a class="discord" href="http://' . htmlspecialchars($ds[ 'discord' ]) . '" target="_blank" rel="nofollow"><i class="bi bi-discord" style="font-size: 2rem;"></i></a>';//http
            }
        } else {
            $discord = '';
        }
    }

    // Prüfen ob Social gesetzt ist
    if($twitch == "") { $data_array['social1'] = "invisible"; } else { $data_array['social1'] = "visible"; }
    if($facebook == "") { $data_array['social2'] = "invisible"; } else { $data_array['social2'] = "visible"; }
    if($twitter == "") { $data_array['social3'] = "invisible"; } else { $data_array['social3'] = "visible"; }
    if($youtube == "") { $data_array['social4'] = "invisible"; } else { $data_array['social4'] = "visible"; }
    if($rss == "") { $data_array['social5'] = "invisible"; } else { $data_array['social5'] = "visible"; }
    if($vine == "") { $data_array['social6'] = "invisible"; } else { $data_array['social6'] = "visible"; }
    if($flickr == "") { $data_array['social7'] = "invisible"; } else { $data_array['social7'] = "visible"; }
    if($linkedin == "") { $data_array['social8'] = "invisible"; } else { $data_array['social8'] = "visible"; }
    if($instagram == "") { $data_array['social9'] = "invisible"; } else { $data_array['social9'] = "visible"; }
    if($steam == "") { $data_array['social10'] = "invisible"; } else { $data_array['social10'] = "visible"; }
    if($discord == "") { $data_array['social11'] = "invisible"; } else { $data_array['social11'] = "visible"; }
}

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
        <link type="text/css" rel="stylesheet" href="../components/bootstrap/css/bootstrap-icons.css" />        
    </head>
    <body>

    <header id="header" class="text-center">
        <img src="images/webspell-logo-lock.png" alt="" style="height: 150px"/>
    </header>
    <main id="main" class="container text-center">
    <div class="row justify-content-center">
        <h2>
            We’re Launching Our Website Soon
        </h2>
    </div>
    </main>
    <section id="about" class="about">
        <div class="container login_card text-center">
        <!--<h3>'.$pagetitle.'</h3>-->
                    <h5>Information</h5>
            <div class="row justify-content-center">
                <div class="col-4" style="background: #fff;color: #000">
                    <p>'.$reason.'</p>
                </div>    
            </div>
        </div>
    </section>
    <section id="contact" class="contact text-center">
        <div class="card container login_card text-center">
            <div class="card-body">
                <h3>Admin Login</h3>
                <form class="row g-3 form-inlin justify-content-center" method="post" name="login" action="/includes/modules/checklogin.php">
                    <div class="col-auto">
                        <label for="staticEmail2" class="visually-hidden">Email</label>
                        <input name="ws_user" type="text"  class="form-control" placeholder="Enter email">
                    </div>
                    <div class="col-auto">
                        <label for="inputPassword2" class="visually-hidden">Password</label>
                        <input name="password" type="password" class="form-control" placeholder="Password">
                    </div>
                    <div class="col-auto">
                        <button type="submit" name="Submit" class="btn btn-success ">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <section id="social" class="social">
        <div class="social-links text-center">
            <h4>Follow us<small> on Social Media</small></h4>
        
            <span class="social1 social-media-circle twitch">'.$twitch.'</span>
            <span class="social2 social-media-circle facebook">'.$facebook.'</span>
            <span class="social3 social-media-circle twitter">'.$twitter.'</span>
            <span class="social4 social-media-circle youtube">'.$youtube.'</span>
            <span class="social5 social-media-circle rss">'.$rss.'</span>
            <span class="social6 social-media-circle vine">'.$vine.'</span>
            <span class="social7 social-media-circle flickr">'.$flickr.'</span>
            <span class="social8 social-media-circle linkedin">'.$linkedin.'</span>
            <span class="social9 social-media-circle instagram">'.$instagram.'</span>
            <span class="social10 social-media-circle steam">'.$steam.'</span>
            <span class="social11 social-media-circle discord">'.$discord.'</span>
        </div>
    </section>

    <section id="foot">
        <footer class="footer">
            <div class="container text-center"><small>
                All content copyright '.$myclanname.'  &copy; Date | '.$since.' | All rights reserved.</small>
            </div>
        </footer>
    </section>
    </body>
</html>';