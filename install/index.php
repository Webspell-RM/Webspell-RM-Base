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

session_name("ws_session");
session_start();
header('content-type: text/html; charset=utf-8');
include("../system/func/language.php");
include("../system/func/user.php");
include("../system/version.php");
if (version_compare(PHP_VERSION, '5.3.7', '>') && version_compare(PHP_VERSION, '5.5.0', '<')) {
  include('../system/func/password.php');
}

$_language = new \webspell\Language();

if (!isset($_SESSION['language'])) {
    $_SESSION['language'] = "de";
}

if (isset($_GET['lang'])) {
    if ($_language->setLanguage($_GET['lang'])) {
        $_SESSION['language'] = $_GET['lang'];
    }
    header("Location: index.php");
    exit();
}

$_language->setLanguage($_SESSION['language']);
$_language->readModule('index');

if (isset($_GET['step'])) {
    $_language->readModule('step'.(int)$_GET['step'], true);
} else {
    $_language->readModule('step0', true);
}

if(isset($_GET['step'])) { 
  $calcstep =0; } 
else { $calcstep = @$_GET['step']+1; }


// step
  if(isset($_GET['step'])) { 
    $step = $_GET['step']; 
    if($step>0) { $done_0 = '<i class="fa fa-check-circle-o green" aria-hidden="true"></i>'; } else { $done_0=""; }
    if($step>1) { $done_1 = '<i class="fa fa-check-circle-o green" aria-hidden="true"></i>'; } else { $done_1=""; }
    if($step>2) { $done_2 = '<i class="fa fa-check-circle-o green" aria-hidden="true"></i>'; } else { $done_2=""; }
    if($step>3) { $done_3 = '<i class="fa fa-check-circle-o green" aria-hidden="true"></i>'; } else { $done_3=""; }
    if($step>4) { $done_4 = '<i class="fa fa-check-circle-o green" aria-hidden="true"></i>'; } else { $done_4=""; }
    if($step>5) { $done_5 = '<i class="fa fa-check-circle-o green" aria-hidden="true"></i>'; } else { $done_5=""; }
    if($step>6) { $done_6 = '<i class="fa fa-check-circle-o green" aria-hidden="true"></i>'; } else { $done_6=""; }
  } else {
    $step = ""; $done_0=""; $done_1=""; $done_2=""; $done_3=""; $done_4=""; $done_5=""; $done_6="";
  }
function CurrentUrl() {
        return ((empty($_SERVER['HTTPS'])) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'];
   		 }
?>


<!DOCTYPE html>
<head><head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="description" content="Webspell | RM 2.0 - Setup">
    <meta name="author" content="Webspell-RM.de">
    <meta name="copyright" content="Copyright 2005-2014 by webspell.org +++ Updating and modified since 2019 by webspell-rm.de">
    <title>webSPELL | RM 2.0 Installation</title>
  
 
<link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,800,700,600" rel="stylesheet">
  <link rel="stylesheet" href="css/navistep.css">
  <link rel="stylesheet" href="css/font-awesome.min.css">
  
  <link href="/components/bootstrap/bootstrap.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
    <script src="../components/jquery/jquery.min.js"></script>
    <script src="install.js"></script>
<style type="text/css">
body { width: 100%; min-height: 100%; position: relative; font-family:"Raleway", Lucida Sans Unicode, Verdana, Helvetica, sans-serif; font-size: 14px; line-height: 24px; color: #575757; color: #999; font-weight: 400; 
letter-spacing: normal; -webkit-font-smoothing: antialiased!important; text-rendering: optimizeLegibility; font-weight: 500; color: #7a7a7a;}
a, a:visited { -webkit-transition: all 150ms ease-in; -moz-transition: all 150ms ease-in; -o-transition: all 150ms ease-in; transition: all 150ms ease-in;}
a { color: #fe821d; -webkit-transition: all .2s ease-in-out; -moz-transition: all .2s ease-in-out; transition: all .2s ease-in-out;}
a:hover,
a:focus { text-decoration: none; color: #000; outline: none; } 
  div.wrapper { width: 82%; margin: 0 auto; }
  div.content { width: 100%; clear: left; float: left; }
  div.head-logo { width: 30%; float: left; }
  
  div.nav-step1 { width: 100%; float: left; color: white; }
  
  div.lng-btn-on { padding: 6px 10px; background-color: #000; color: white; float: right; margin-right: 10px; cursor: pointer; }
  div.lng-btn-off { padding: 6px 10px; background-color: #ccc; color: black; float: right; margin-right: 10px; cursor: pointer; }
  div.buttn { padding: 6px 10px; background-color: #ef7f1a !important; color: white; margin-right: 10px; cursor: pointer; }
  input[type=submit] {
    padding:6px 10px; 
    background:#ef7f1a; 
    border:0 none;
    color: #fff;
    font-size: 100%;
    cursor:pointer;
  }
  div.agree { float: left; padding-top: 5px;}
  
  .maindiv { padding: 2%; background-color: #ffffff;}
  .border-bdo1 { border-bottom: dotted #ccc 1px; }
  textarea.license { width: 98%; height: 345px; padding: 8px; border: 1px solid #ccc;}
  span.message { font-size: 105%; }
  span.status-message { font-size: 105%; font-weight: normal; }
  .green { color: #c5f6cb }
  .left { float: left; }
  .right {float: right; }
  .hidden { display: none !important; }
  .display { display: block !important; }
  label { font-weight: normal; }
  /*.card {border-radius: 0px; border: 1px solid #ccc; margin: 2px;padding: 8px; }
  .card .card-header { border-bottom: 1px solid #ccc;}*/
  .card {margin: 2px;padding: 8px; }
  #step2-head {background-color: hsla(34,85%,45%,1); color: #fff;  font: 18px Sans-Serif; border-radius: 0px;}
  #step3-head {background-color: hsla(34,85%,55%,1); color: #fff;  font: 18px Sans-Serif; border-radius: 0px;}
  .form-control  {border-radius: 0px; border: 1px solid #ccc;}
  .btn-margin {border-radius: 0px; border: 1px solid #ccc;; margin: 2px;}
  

  .btn {
  background-image: none;
  border-radius: 0;
  margin-bottom: 5px; }
  .btn.btn-primary {
    color: #ffffff;
    background-color: #fe821d;
    border-color: #fe821d; }
    .btn.btn-primary:hover {
      color: #ffffff;
      background-color: #e76901;
      border-color: #dd6401; }
    .btn.btn-primary:focus, .btn.btn-primary.focus {
      color: #ffffff;
      background-color: #e76901;
      border-color: #dd6401; }
    .btn.btn-primary:active, .btn.btn-primary.active,
  /* .alert { width:12%; }*/
</style>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="description" content="Page using webSPELL-RM 2.0 CMS">
    <meta name="author" content="webspell-rm.de">
    <meta name="copyright" content="Copyright 2005-2014 by webspell.org">
    <meta name="generator" content="webSPELL-RM">
    <title>webSPELL | RM 2.0 Installation</title>
    
</head>
<body style="background: #e3e3e3">
  <div class="wrapper">
  <div class="content maindiv">
    <div class="content border-bdo1">
    <div class="row">
    <div class="col-md-12">
      
        <img class="img-fluid" src="images/webspell_logo.png" alt="{ws.logo}" />
      
      </div>
      
    </div>
    </div>
    <div class="content"><br />
      <div class="nav-step1">
        <ul class="navistep">
          <li><a href="index.php"><?=$_language->module['welcome'];?> <?=$done_0; ?></a> </li>
          <li><a href="index.php?step=1"><?=$_language->module['license_agreement'];?> <?=$done_1; ?></a> </li>
          <li><a href="index.php?step=2"><?=$_language->module['url'];?> <?=$done_2; ?></a></li>
          <li><a href="index.php?step=3"><?=$_language->module['permissions'];?> <?=$done_3; ?></a></li>
          <li><a href="index.php?step=4"><?=$_language->module['select_installation'];?> <?=$done_4; ?></a></li>
          <li><a href="index.php?step=5"><?=$_language->module['configuration'];?> <?=$done_5; ?></a></li>
          <li><a href="index.php?step=6"><?=$_language->module['complete'];?> <?=$done_6; ?></a></li>
          <li><a href="index.php?step=2">&nbsp;</a></li>
        </ul>
      </div>
    </div>
  <div class="content">
    <div class="col-xs-12">
            <?php
                echo '<form action="index.php?step=' . (@$_GET['step'] + 1) . '" method="post" name="ws_install">';
                include('step0' . @$_GET['step'] . '.php');
            ?>
		</div>
  </div> <!-- /container --> </div>
</div>

<script src="../components/bootstrap/bootstrap.min.js"></script>
	<script>
	  $("body").tooltip({   
		selector: "[data-toggle='tooltip']",
		container: "body"
	})
	</script>
</body>
</html>