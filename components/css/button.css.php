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
.btn-default{}
.btn-default{
color:<?php echo $ds['button3']?>;
background-color:<?php echo $ds['button1']?>;
border-color:<?php echo $ds['button4']?>;
}
.btn-default.focus,.btn-default:focus{
color:<?php echo $ds['button3']?>;
background-color:<?php echo $ds['button2']?>;
border-color:<?php echo $ds['button4']?>;
}
.btn-default:hover{
color:<?php echo $ds['button3']?>;
background-color:<?php echo $ds['button2']?>;
border-color:<?php echo $ds['button5']?>;
}
.btn-default.active,.btn-default:active,.open>.dropdown-toggle.btn-default{
color:<?php echo $ds['button3']?>;
background-color:<?php echo $ds['button2']?>;
border-color:<?php echo $ds['button5']?>;
}


<!-- Primary ==================================== -->

.btn-primary{}
.btn-primary{
color:<?php echo $ds['button8']?>;
background-color:<?php echo $ds['button6']?>;
border-color:<?php echo $ds['button9']?>;
}

.btn.btn-primary:hover {
color:<?php echo $ds['button8']?>;
background-color:<?php echo $ds['button7']?>;
border-color:<?php echo $ds['button10']?>; 
}
    
.btn.btn-primary:focus, .btn.btn-primary.focus {
color:<?php echo $ds['button8']?>;
background-color:<?php echo $ds['button7']?>;
border-color:<?php echo $ds['button10']?>; 
}

.btn-primary.active,.btn-primary:active,.open>.dropdown-toggle.btn-primary{
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

<!-- info ==================================== -->

.btn-info{}
.btn-info{
color:<?php echo $ds['button18']?>;
background-color:<?php echo $ds['button16']?>;
border-color:<?php echo $ds['button19']?>;
}
.btn-info.focus,.btn-info:focus{
color:<?php echo $ds['button18']?>;
background-color:<?php echo $ds['button17']?>;
border-color:<?php echo $ds['button19']?>;
}
.btn-info:hover{
color:<?php echo $ds['button18']?>;
background-color:<?php echo $ds['button17']?>;
border-color:<?php echo $ds['button20']?>;
}
.btn-info.active,.btn-info:active,.open>.dropdown-toggle.btn-info{
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

<!-- warning ==================================== -->

.btn-danger{}
.btn-danger{
color:<?php echo $ds['button28']?>;
background-color:<?php echo $ds['button26']?>;
border-color:<?php echo $ds['button29']?>;
}
.btn-danger.focus,.btn-danger:focus{
color:<?php echo $ds['button28']?>;
background-color:<?php echo $ds['button27']?>;
border-color:<?php echo $ds['button29']?>;
}
.btn-danger:hover{
color:<?php echo $ds['button28']?>;
background-color:<?php echo $ds['button27']?>;
border-color:<?php echo $ds['button30']?>;
}
.btn-danger.active,.btn-danger:active,.open>.dropdown-toggle.btn-danger{
color:<?php echo $ds['button28']?>;
background-color:<?php echo $ds['button27']?>;
border-color:<?php echo $ds['button30']?>;
}