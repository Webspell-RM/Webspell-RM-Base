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
$sql = safe_query("select * from ".PREFIX."settings_buttons");

$ds = mysqli_fetch_array($sql);
?>
<!-- Primary ==================================== -->

.btn-primary{}
.btn-primary{
color:<?php echo $ds['button3']?>;
background-color:<?php echo $ds['button1']?>;
border-color:<?php echo $ds['button4']?>;
}
.btn-primary.focus,.btn-primary:focus{
color:<?php echo $ds['button3']?>;
background-color:<?php echo $ds['button2']?>;
border-color:<?php echo $ds['button4']?>;
}
.btn-primary:hover{
color:<?php echo $ds['button3']?>;
background-color:<?php echo $ds['button2']?>;
border-color:<?php echo $ds['button5']?>;
}
.btn-primary.active,.btn-primary:active,.open>.dropdown-toggle.btn-primary{
color:<?php echo $ds['button3']?>;
background-color:<?php echo $ds['button2']?>;
border-color:<?php echo $ds['button5']?>;
}


<!-- Secondary ==================================== -->

.btn-secondary{}
.btn-secondary{
color:<?php echo $ds['button8']?>;
background-color:<?php echo $ds['button6']?>;
border-color:<?php echo $ds['button9']?>;
}

.btn.btn-secondary:hover {
color:<?php echo $ds['button8']?>;
background-color:<?php echo $ds['button7']?>;
border-color:<?php echo $ds['button10']?>; 
}
    
.btn.btn-secondary:focus, .btn.btn-secondary.focus {
color:<?php echo $ds['button8']?>;
background-color:<?php echo $ds['button7']?>;
border-color:<?php echo $ds['button10']?>; 
}

.btn-secondary.active,.btn-secondary:active,.open>.dropdown-toggle.btn-secondary{
color:<?php echo $ds['button8']?>;
background-color:<?php echo $ds['button7']?>;
border-color:<?php echo $ds['button10']?>;
}

<!-- Success ==================================== -->

.btn-success{}
.btn-success{
color:<?php echo $ds['button13']?>;
background-color:<?php echo $ds['button11']?>;
border-color:<?php echo $ds['button14']?>;
}
.btn-success.focus,.btn-success:focus{
color:<?php echo $ds['button13']?>;
background-color:<?php echo $ds['button12']?>;
border-color:<?php echo $ds['button15']?>;
}
.btn-success:hover{
color:<?php echo $ds['button13']?>;
background-color:<?php echo $ds['button12']?>;
border-color:<?php echo $ds['button15']?>;
}
.btn-success.active,.btn-success:active,.open>.dropdown-toggle.btn-success{
color:<?php echo $ds['button13']?>;
background-color:<?php echo $ds['button12']?>;
border-color:<?php echo $ds['button15']?>;
}

<!-- Danger ==================================== -->

.btn-danger{}
.btn-danger{
color:<?php echo $ds['button18']?>;
background-color:<?php echo $ds['button16']?>;
border-color:<?php echo $ds['button19']?>;
}
.btn-danger.focus,.btn-danger:focus{
color:<?php echo $ds['button18']?>;
background-color:<?php echo $ds['button17']?>;
border-color:<?php echo $ds['button19']?>;
}
.btn-danger:hover{
color:<?php echo $ds['button18']?>;
background-color:<?php echo $ds['button17']?>;
border-color:<?php echo $ds['button20']?>;
}
.btn-danger.active,.btn-danger:active,.open>.dropdown-toggle.btn-danger{
color:<?php echo $ds['button18']?>;
background-color:<?php echo $ds['button17']?>;
border-color:<?php echo $ds['button20']?>;
}

<!-- warning ==================================== -->

.btn-warning{}
.btn-warning{
color:<?php echo $ds['button23']?>;
background-color:<?php echo $ds['button21']?>;
border-color:<?php echo $ds['button24']?>;
}
.btn-warning.focus,.btn-warning:focus{
color:<?php echo $ds['button23']?>;
background-color:<?php echo $ds['button22']?>;
border-color:<?php echo $ds['button24']?>;
}
.btn-warning:hover{
color:<?php echo $ds['button23']?>;
background-color:<?php echo $ds['button22']?>;
border-color:<?php echo $ds['button25']?>;
}
.btn-warning.active,.btn-warning:active,.open>.dropdown-toggle.btn-warning{
color:<?php echo $ds['button23']?>;
background-color:<?php echo $ds['button22']?>;
border-color:<?php echo $ds['button25']?>;
}

<!-- Info ==================================== -->

.btn-info{}
.btn-info{
color:<?php echo $ds['button28']?>;
background-color:<?php echo $ds['button26']?>;
border-color:<?php echo $ds['button29']?>;
}
.btn-info.focus,.btn-info:focus{
color:<?php echo $ds['button28']?>;
background-color:<?php echo $ds['button27']?>;
border-color:<?php echo $ds['button29']?>;
}
.btn-info:hover{
color:<?php echo $ds['button28']?>;
background-color:<?php echo $ds['button27']?>;
border-color:<?php echo $ds['button30']?>;
}
.btn-info.active,.btn-info:active,.open>.dropdown-toggle.btn-info{
color:<?php echo $ds['button28']?>;
background-color:<?php echo $ds['button27']?>;
border-color:<?php echo $ds['button30']?>;
}

<!-- Light ==================================== -->

.btn-light{}
.btn-light{
color:<?php echo $ds['button33']?>;
background-color:<?php echo $ds['button31']?>;
border-color:<?php echo $ds['button34']?>;
}
.btn-light.focus,.btn-light:focus{
color:<?php echo $ds['button33']?>;
background-color:<?php echo $ds['button32']?>;
border-color:<?php echo $ds['button34']?>;
}
.btn-light:hover{
color:<?php echo $ds['button33']?>;
background-color:<?php echo $ds['button32']?>;
border-color:<?php echo $ds['button35']?>;
}
.btn-light.active,.btn-light:active,.open>.dropdown-toggle.btn-light{
color:<?php echo $ds['button33']?>;
background-color:<?php echo $ds['button32']?>;
border-color:<?php echo $ds['button35']?>;
}

<!-- Dark ==================================== -->

.btn-dark{}
.btn-dark{
color:<?php echo $ds['button38']?>;
background-color:<?php echo $ds['button36']?>;
border-color:<?php echo $ds['button39']?>;
}
.btn-dark.focus,.btn-dark:focus{
color:<?php echo $ds['button38']?>;
background-color:<?php echo $ds['button37']?>;
border-color:<?php echo $ds['button39']?>;
}
.btn-dark:hover{
color:<?php echo $ds['button38']?>;
background-color:<?php echo $ds['button37']?>;
border-color:<?php echo $ds['button40']?>;
}
.btn-dark.active,.btn-dark:active,.open>.dropdown-toggle.btn-dark{
color:<?php echo $ds['button38']?>;
background-color:<?php echo $ds['button37']?>;
border-color:<?php echo $ds['button40']?>;
}

<!-- Link ==================================== -->

.btn-link{}
.btn-link{
color:<?php echo $ds['button41']?>;
}
.btn-link.focus,.btn-link:focus{
color:<?php echo $ds['button41']?>;
}
.btn-link:hover{
color:<?php echo $ds['button42']?>;
}
.btn-link.active,.btn-link:active,.open>.dropdown-toggle.btn-link{
color:<?php echo $ds['button42']?>;
}