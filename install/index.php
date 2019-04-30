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
    $step = (int)$_GET['step']; 
} else {
    $step = 0;
}

$calcstep = ($step > 0) ?
    $step + 1 : 1;

if (isset($_GET['step'])) {
    $_language->readModule('step' . $step, true);
} else {
    $_language->readModule('step0', true);
}

$doneArray = array();
for ($x = 0; $x < 7; $x++) {
    $doneArray[$x] = ($step > $x) ?
        '<i class="fa fa-check-circle-o green" aria-hidden="true"></i>' : '';
}

function CurrentUrl() {
    return ((empty($_SERVER['HTTPS'])) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'];
}

?>
<!DOCTYPE html>
<html>
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="description" content="Webspell | RM 2.0 - Setup">
    <meta name="author" content="Webspell-RM.de">
    <meta name="copyright" content="Copyright 2005-2014 by webspell.org +++ Updating and modified since 2019 by webspell-rm.de">
    <title>webSPELL | RM 2.0 Installation</title>

    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,800,700,600" rel="stylesheet">
    <link href="./css/navistep.css" rel="stylesheet">
    <link href="../components/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="../components/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">
    <link href="./css/custom.css" rel="stylesheet">

    <script src="../components/jquery/jquery.min.js"></script>
    <script src="./install.js"></script>

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
            <div class="content">
                <br />
                <div class="nav-step1">
                    <ul class="navistep">
                        <li>
                            <a href="index.php">
                                <?php echo $_language->module['welcome'] . ' ' . $doneArray[0]; ?>
                            </a>
                        </li>
                        <li>
                            <a href="index.php?step=1">
                                <?php echo $_language->module['license_agreement'] . ' ' . $doneArray[1]; ?>
                            </a>
                        </li>
                        <li>
                            <a href="index.php?step=2">
                                <?php echo $_language->module['url'] . ' ' . $doneArray[2]; ?>
                            </a>
                        </li>
                        <li>
                            <a href="index.php?step=3">
                                <?php echo $_language->module['permissions'] . ' ' . $doneArray[3]; ?>
                            </a>
                        </li>
                        <li>
                            <a href="index.php?step=4">
                                <?php echo $_language->module['select_installation'] . ' ' . $doneArray[4]; ?>
                            </a>
                        </li>
                        <li>
                            <a href="index.php?step=5">
                                <?php echo $_language->module['configuration'] . ' ' . $doneArray[5]; ?>
                            </a>
                        </li>
                        <li>
                            <a href="index.php?step=6">
                                <?php echo $_language->module['complete'] . ' ' . $doneArray[6]; ?></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="content">
                <div class="col-lg-12">
                    <form action="index.php?step=<?php echo $calcstep; ?>" method="post" name="ws_install">
                        <?php include('step0' . $step . '.php'); ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="../node_modules/popper.js/dist/umd/popper.min.js"></script>
    <script src="../node_modules/tooltip.js/dist/umd/tooltip.min.js"></script>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script>
    $("body").tooltip({
        selector: "[data-toggle='tooltip']",
        container: "body"
    })
    </script>
</body>
</html>