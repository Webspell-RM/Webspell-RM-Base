<!DOCTYPE html>
<html lang="<?php echo $_language->language ?>">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Website using webSPELL-RM CMS">
                <meta name="copyright" content="Copyright &copy; 2017-2023 by webspell-rm.de">
                <meta name="author" content="webspell-rm.de">
                <link rel="SHORTCUT ICON" href="./favicon.ico">

    <!-- CSS STUFF -->
    <!-- Bootstrap Core CSS -->
    <link href="../components/admin/css/bootstrap.min.css" rel="stylesheet">    

    <link href="./login/style.css" rel="stylesheet">

    <link type="text/css" rel="stylesheet" href="../components/css/styles.css.php" />

    <link rel="stylesheet" href="../components/cookies/css/cookieconsent.css" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="../components/cookies/css/iframemanager.css" media="print" onload="this.media='all'">

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

$cookievalueadmin = 'false'; 
if(isset($_COOKIE['ws_session'])) { 
  $cookievalueadmin = 'accepted';  
}

if ($loggedin) {
     $load = new plugin_manager();
      $_language->readModule('admincenter', false, true);
    echo 'oben';
} else {
	 $load = new plugin_manager();
    $_language->readModule('admincenter', false, true);
    //set sessiontest variable (checks if session works correctly)
    $_SESSION[ 'ws_sessiontest' ] = true;
   


   
    

#===================================================
if(!isset($_COOKIE["ws_session"])) { 
	$load = new plugin_manager();
$_language->readModule('cookie', false, true);
echo'

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
                <h2 class="login-heading mb-4"><span>'.$_language->module[ 'signup' ].'</span></h2>
                <div>
                    <h5>'.$_language->module[ 'dashboard' ].'</h5><br />
                    <div class="alert alert-info" role="alert">
                        <h5 class="card-title">'.$_language->module[ 'cookies' ].'</h5>
                        <div class="form-group">
                        	'.$_language->module[ 'signup' ].'
                    </div>

                </div>
                <button class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2" type="submit" onclick="location.reload()">'.$_language->module[ 'signup' ].'</button>
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
                <h2 class="login-heading mb-4"><span>'.$_language->module[ 'signup' ].'</span></h2>
                <div>
                    <h5>'.$_language->module[ 'dashboard' ].'</h5><br />
                    <div class="alert alert-info" role="alert">
                    '.$_language->module[ 'welcome2' ].' '.$version.' Login.<br><br>

                    '.$_language->module[ 'insertmail' ].'.
                        
                    </div>
                </div>
              <form method="post" name="login" action="login/admincheck.php">
                <div class="form-label-group">
                    <label for="exampleInputEmail1">'.$_language->module[ 'email_address' ].'</label>
                  <input class="form-control" name="ws_user" type="text" placeholder="Email Address" id="login" required>
                </div>
                  
                <div class="form-label-group">
                    <label for="exampleInputPassword1">Password</label>
                  <input class="form-control" name="password" type="password" placeholder="Password" id="password" required>
                </div>

                
                <input type="submit" name="submit" value="'.$_language->module[ 'signup' ].'" class="fourth btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2">
  				</form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


';
}

#===================================================
}
?>

<!-- jQuery -->
<!--<script src="../components/admin/js/jquery.min.js"></script>-->

<!--<script src="../components/admin/js/page.js"></script>-->

<!-- colorpicker -->
<!--<script src="../components/admin/js/bootstrap-colorpicker.min.js"></script>-->
<!--<script src="../components/admin/js/colorpicker-rm.js"></script>-->
   
<!-- Bootstrap -->
<!--<script src="../components/admin/js/bootstrap.bundle.min.js"></script>-->
<!--<script src="../components/admin/js/bootstrap-switch.js"></script>-->

<!-- Menu Plugin JavaScript -->
<!--<script src="../components/admin/js/metisMenu.min.js"></script>-->
<!--<script src="../components/admin/js/side-bar.js"></script>-->


<!-- dataTables -->
<!--<script type="text/javascript" src="../components/admin/js/jquery.dataTables.min.js"></script>-->
<!--<script type="text/javascript" src="../components/admin/js/dataTables.bootstrap5.min.js"></script>-->

<!-- Cookies Abfrage -->
    <script defer src="../components/cookies/js/iframemanager.js"></script>
    <script defer src="../components/cookies/js/cookieconsent.js"></script>
    <script defer src="../components/cookies/js/cookieconsent-init.js"></script>

    <script defer src="../components/cookies/js/app.js"></script>


</body>
</html>