<?php
chdir("../../");
$err=0;
if(file_exists("system/sql.php")) { include("system/sql.php"); } else { $err++; }
if(file_exists("system/settings.php")) { include("system/settings.php"); }  else { $err++; }

// copy pagelock information for session test + deactivated pagelock for checklogin
$closed_tmp = $closed;
$closed = 0;

if(file_exists("system/functions.php")) { include("system/functions.php");  } else { $err++; }


header('Content-type: text/css');

$sql = safe_query("select * from ".PREFIX."settings_styles");

$ds = mysqli_fetch_array($sql);

?>
body {
  margin: 0;
  font-family: <?php echo $ds['body1']?>;
  font-size: <?php echo $ds['body2']?>;
  color: <?php echo $ds['body4']?>;
  background-color: <?php echo $ds['body3']?>;
}

a {color:<?php echo $ds['typo4']?>;
} 
a:active,a:hover{
outline:0
}

a:hover, a:visited:hover {
	color: <?php echo $ds['typo8']?>;
	text-decoration: none;
}

p {font-size:<?php echo $ds['typo5']?>
}

h1,
h2,
h3,
h4,
h5 {color:<?php echo $ds['typo2']?>
}

h6 {color:<?php echo $ds['typo3']?>
}

.page-header {border-bottom: <?php echo $ds['typo7']?> solid <?php echo $ds['typo6']?>
}

hr {border-top: <?php echo $ds['typo7']?> solid <?php echo $ds['typo6']?>
}

.well {background-color: <?php echo $ds['typo1']?>
}

.navbar-default {
	border-top: <?php echo $ds['nav6']?> solid <?php echo $ds['nav5']?>;
	text-transform: uppercase;
}

.navbar-default {
font-size: <?php echo $ds['nav2']?>;
background: <?php echo $ds['nav1']?>;
box-shadow: 0px 0px 6px rgba(0,0,0,0.15)
}

.nav .dropdown-menu {
	
    background: <?php echo $ds['nav1']?>;
}


.nav .subnav a {
	color: <?php echo $ds['nav3']?>;
    text-decoration: none;
    background: <?php echo $ds['nav1']?>;
}
.nav .subnav a:hover {
	color: <?php echo $ds['nav4']?>;
	text-decoration: none;
	background: <?php echo $ds['nav1']?>;
}


.navbar .navbar-nav > li > a {
	color: <?php echo $ds['nav7']?>;
    text-decoration: none;
}
.navbar .navbar-nav > li > a:hover {
	color: <?php echo $ds['nav8']?>;
	text-decoration: none;
}













.footer {background: <?php echo $ds['foot1']?>;
border-top:1px solid <?php echo $ds['typo6']?>;
}

#footer {background: <?php echo $ds['foot1']?>;
border-top:1px solid <?php echo $ds['typo6']?>;
}

.copyright {color: <?php echo $ds['foot2']?>;}


.copyright h3 {color:<?php echo $ds['foot3']?>
}
.copyright .foot .fa {color:<?php echo $ds['foot3']?>
}


<!-- NAVI LANGUAGE-->

