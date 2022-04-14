<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Website using webSPELL-RM CMS">
                <meta name="copyright" content="Copyright &copy; 2017-2022 by webspell-rm.de">
                <meta name="author" content="webspell-rm.de">

    <!-- CSS STUFF -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@200;300;400;500&display=swap" rel="stylesheet"> 
    <link href="../components/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="./login/style.css" rel="stylesheet">
    <link href='../components/css/cookie.css' rel='stylesheet' type='text/css'>

    
    <title>webSpell | RM - Bootstrap Admin Theme</title>

   </head>

<body>

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
 * @copyright       2018-2022 by webspell-rm.de <https://www.webspell-rm.de>                                                          *
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

if ($loggedin && $cookievalue == 'accepted') {
     $load = new plugin_manager();
$_language->readModule('admincenter', false, true);
    echo 'oben';
} else {
	 $load = new plugin_manager();
$_language->readModule('admincenter', false, true);
    //set sessiontest variable (checks if session works correctly)
    $_SESSION[ 'ws_sessiontest' ] = true;
   


   
    

#===================================================
if(!isset($_COOKIE["cookie"])) { 
	$load = new plugin_manager();
$_language->readModule('cookie', false, true);
echo'

  <link href="./login/style.css" rel="stylesheet">
      
      <div class="container-fluid">
  <div class="row no-gutter">
    <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image">
        <div class="logo">
            <img class="mw-100 mh-100" src="./login/images/logo.png" width="auto" height="auto">
            <p class="text1">webspell <span>rm</span>
        </div>
    </div>
    <div class="col-md-8 col-lg-6 no-bg">
      <div class="login d-flex align-items-center py-5">
        <div class="container">
          <div class="row">
            <div class="col-md-9 col-lg-8 mx-auto">
                <h2 class="login-heading mb-4"><span>Sign up!</span></h2>
                <div>
                    <h5>Dashboard Login.</h5><br />
                    <div class="alert alert-info" role="alert">
                        <h5 class="card-title">Cookies akzeptieren!</h5>
                        <div class="form-group">
                        	Diese Website verwendet Cookies. Wenn Sie diese Website nutzen stimmen Sie der Verwendung von Cookies zu!
                    </div>

                </div>
                <button class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2" type="submit" onclick="location.reload()">sign up</button>
                </div>
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>';
  
    
    } else {
        
echo'    

<!DOCTYPE html>

<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Website using webSPELL-RM CMS">
    <meta name="copyright" content="Copyright &copy; 2017-2019 by webspell-rm.de">
    <meta name="author" content="webspell-rm.de">

    <link rel="SHORTCUT ICON" href="/admin/favicon.ico">

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
<script src="../components/bootstrap/bootstrap.min.css"></script>
<script src="../components/jquery/jquery.min.js"></script>

<link href="/admin/login/style.css" rel="stylesheet">
<title>Admin Login</title>
</head>
<body>
<div class="container-fluid">
  <div class="row no-gutter">
    <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image">
        <div class="logo">
            <img class="mw-100 mh-100" src="./login/images/logo.png" width="auto" height="auto">
            <p class="text1">webspell <span>rm</span>
        </div>
    </div>
    <div class="col-md-8 col-lg-6 no-bg">
      <div class="login d-flex align-items-center py-5">
        <div class="container">
          <div class="row">
            <div class="col-md-9 col-lg-8 mx-auto">
                <h2 class="login-heading mb-4"><span>Sign up!</span></h2>
                <div>
                    <h5>Dashboard Login.</h5><br />
                    <div class="alert alert-info" role="alert">
                    Willkommen im Webspell-RM Dasbord Ver. '.$version.' Login.<br><br>

                    Bitte gib deine E-Mail-Adresse und dein Passwort ein. Anschließend gelangst du direkt in dein Dashbord. 
                        
                    </div>
                </div>
              <form method="post" name="login" action="login/admincheck.php">
                <div class="form-label-group">
                    <label for="exampleInputEmail1">Email Address</label>
                  <input  class="form-control"  name="ws_user" type="text" placeholder="Email Address" id="login" required>
                </div>
                  
                <div class="form-label-group">
                    <label for="exampleInputPassword1">Password</label>
                  <input  class="form-control" name="password" type="password" placeholder="Password" id="password" required>
                </div>

                
                <input type="submit" name="submit" value="sign up" class="fourth btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2">
  				</form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>


';
}

#===================================================
}
?>

<!-- jQuery -->
    <script src="../components/jquery/jquery.min.js"></script>
    <!-- jQuery -->
    <script src="../components/bootstrap/js/bootstrap.min.js"></script>

<div id="footer-cookie">
    <span id="description">Wir nutzen Cookies, um unsere Dienste zu erbringen und zu verbessern. Mit Nutzung dieser Seite akzeptieren Sie Cookies.
       <span id="privacy_policy"><a href="index.php?site=privacy_policy">Hier erfahrt ihr alles zum Datenschutz</a></span>
    </span>
    <span id="accept"><a href="javascript:void(0)" title="Akzeptieren">Akzeptieren</a></span>
  </div>

  <script>    
    var footerCookie = document.querySelector("#footer-cookie");
    var footerCookieAccept = document.querySelector("#accept");

    if (document.cookie.indexOf("cookie=") == -1) {
      footerCookie.style.display = "block";
    }

    footerCookieAccept.onclick = function(e) {

        var cookieDate = new Date();
            cookieDate.setTime(cookieDate.getTime() + (1*24*60*60*1000));
            var expires = "expires="+cookieDate.toUTCString();
            document.cookie = "cookie" + "=accepted" + "; " + expires + cookieDate.toUTCString();
            footerCookie.style.display = "none";
    };
  </script>


</body>
</html>