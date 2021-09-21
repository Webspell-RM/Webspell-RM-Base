<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Website using webSPELL-RM CMS">
    <meta name="copyright" content="Copyright &copy; 2017-2019 by webspell-rm.de">
    <meta name="author" content="webspell-rm.de">

    <link rel="SHORTCUT ICON" href="/admin/favicon.ico">

    
    
    <link href="../components/admin/css/bootstrap-switch.css" rel="stylesheet">
    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="../components/admin/css/datatables.min.css"/>
    <link rel="stylesheet" type="text/css" href="../components/admin/css/dataTables.bootstrap4.min.css"/>
   
   <?php include('../system/ckeditor.php'); ?>
   <script src="../components/admin/js/jquery.min.331.js"></script>
   <link href='../components/admin/css/fonts.css' rel='stylesheet' type='text/css'>
   <link href='../components/css/cookie.css' rel='stylesheet' type='text/css'>
    <title>webSpell | RM - Bootstrap Admin Theme</title>

    <!-- Bootstrap Core CSS -->
    
   <?php #echo getcookiescript(); ?>
  </head>

<body>

	<?php
$load = new plugin_manager();
$_language->readModule('admincenter', false, true);


if ($loggedin && $cookievalue == 'accepted') {
     $load = new plugin_manager();
$_language->readModule('admincenter', false, true);
    echo 'oben';
} else {
	 $load = new plugin_manager();
$_language->readModule('admincenter', false, true);
    //set sessiontest variable (checks if session works correctly)
    $_SESSION[ 'ws_sessiontest' ] = true;
   


   
    


if(!isset($_COOKIE["cookie"])) { 
	$load = new plugin_manager();
$_language->readModule('cookie', false, true);
?>
	
 <!-- Bootstrap Core CSS -->
    <link href="../components/admin/css/bootstrap.min.css" rel="stylesheet">
   
    <!-- Custom CSS -->
    <link href="../components/admin/css/page.css" rel="stylesheet">

    <!-- Menu CSS -->
    <link href="../components/admin/css/menu.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href='../components/fontawesome/css/all.css' rel='stylesheet' type='text/css'>

    <!-- Style CSS -->
    <link href="../components/admin/css/style.css" rel="stylesheet">
    <link href="../components/css/button.css.php" rel="styleSheet" type="text/css">
<div class="" style="margin: 2.4em;">
            <div class="col-md-12">
                <div class="card card-hp">
                    <div class="card-body">
                    	<h2>
    <span><i class="fas fa-sign-in-alt"></i>&nbsp;Anmeldung</span>
</h2>
<hr>
                        <h3 class="card-title"><i class="fas fa-stop-circle"></i> Cookies akzeptieren</h3>
                        <div class="form-group">
                        	Diese Website verwendet Cookies. Wenn Sie diese Website nutzen stimmen Sie der Verwendung von Cookies zu!
                    </div>
                </div>
            </div>
        </div>
</div><?php
    
    } else {
        
        echo '<!DOCTYPE html>
			<head>
			<meta charset="utf-8">
			    <meta http-equiv="X-UA-Compatible" content="IE=edge">
			    <meta name="viewport" content="width=device-width, initial-scale=1">
			    <meta name="description" content="Website using webSPELL-RM CMS">
			    <meta name="copyright" content="Copyright &copy; 2017-2019 by webspell-rm.de">
			    <meta name="author" content="webspell-rm.de">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
<script src="../components/bootstrap/css/bootstrap.min.css"></script>
<script src="../components/jquery/jquery.min.js"></script>

<link href="/admin/login/style.css" rel="stylesheet">
			    
				<title>Admin Login</title>
			</head>
			<body>
				<div class="wrapper fad1eInDown">
			 		<div id="formContent">
			  			<div class="fadeIn first"><span class="fa-stack fa-2x"> <i class="fas fa-user fa-stack-1x"></i> <i class="fas fa-ban fa-stack-2x" style="color:Tomato"></i></span><br /><b><u>ADMIN ONLY</u></b> </div>
			  				<form method="post" name="login" action="../admin/login/admincheck.php">
			   					<div class="input-group mb-2">
			                        <div class="input-group-prepend">
			                            <div class="input-group-text"><i class="fa fa-envelope fa-fw"></i></div>
			                        </div>
			                        <input class="fad1eIn second"  name="ws_user" type="text" placeholder="email" id="login" required>
			                    </div>

			   					<div class="input-group mb-2">
			                        <div class="input-group-prepend">
			                            <div class="input-group-text"><i class="fa fa-lock fa-fw"></i></div>
			                        </div>
			                        <input class="fad1eIn third" name="password" type="password" placeholder="Password" id="password" required>
			                    </div>


			   					<input type="submit" name="submit" value="Login" class="fourth" onclick="location.reload()" />

			   					 </form>
			 		</div>
				</div>
			</body>
			</head>';
    
}
}





?>

<!-- jQuery -->
    <script src="../components/admin/js/jquery.min.js"></script>
    <!-- jQuery -->
    <script src="../components/admin/js/bootstrap.min.js"></script>

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