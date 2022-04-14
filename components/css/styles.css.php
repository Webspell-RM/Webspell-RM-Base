<?php

chdir("../../");

$includeFileArray = array(
    'sql',
    'settings',
    'functions'
);

foreach ($includeFileArray as $file) {

    $filePath = "system/" . $file . ".php";
    if (!file_exists($filePath)) {
        die('/* cannot create css file */');
    }

    include($filePath);

}

header('Content-type: text/css');

$ergebnis = safe_query("SELECT * FROM ".PREFIX."settings_themes WHERE active = '1'");
    $ds = mysqli_fetch_array($ergebnis);
echo'

body {
    margin: 0;
    font-family: '.$ds['body1'].';
    font-size: '.$ds['body2'].';
    color: '.$ds['body4'].';
    background-color: '.$ds['body3'].';
}

a, .text-primary {
    color:'.$ds['typo4'].';
}
a:active,
a:hover {
    color: '.$ds['typo8'].';
    text-decoration: none;
}

p {
    font-size:'.$ds['typo5'].';
    color: '.$ds['body4'].';
}

h1,
h2,
h3,
h4,
h5 {
    color:'.$ds['typo2'].';
}

h6 {
    color:'.$ds['typo3'].';
}

.page-header {
    border-bottom: '.$ds['typo7'].' solid '.$ds['nav5'].';
}

hr{margin:1rem 0;
color:inherit;
background-color:'.$ds['typo6'].';
border:0;
opacity:1.25}
hr:not([size]){height:'.$ds['typo7'].'}

/*-------cookie---------*/

#footer-cookie {
 background-color: '.$ds['nav1'].' !important; 
 border-top:1px solid '.$ds['nav5'].';
}

#footer-cookie a, .text-primary {
  color: '.$ds['typo4'].' !important;
  text-decoration: none;
}

#description {
  color: '.$ds['nav7'].' !important;
  text-decoration: none;
}

#footer-cookie #accept a {
      border: 1px solid '.$ds['nav7'].';
      padding: 5px 10px;
      text-decoration: none;
    }

    #footer-cookie #privacy_policy a {
      border: 1px solid '.$ds['nav7'].';
      padding: 5px 10px;
      text-decoration: none;
    }

/*---------------------------*/

.news-block,
.news-box .bg-primary {
  background-color: '.$ds['typo4'].' !important;
  /*color:'.$ds['nav4'].';*/
  color: '.$ds['body3'].';
}



.well {
    background-color: '.$ds['typo1'].';
}

.navbar-dark {
    border-top: '.$ds['nav6'].' solid '.$ds['nav5'].';
    text-transform: uppercase;
    font-size: '.$ds['nav2'].';
    background: '.$ds['nav1'].';
    box-shadow: 0px 4px 12px 0px rgba(0,0,0,0.25);
}

.bg-primary {
  background-color: '.$ds['nav1'].' !important;
}

a.bg-primary:hover, a.bg-primary:focus,
button.bg-primary:hover,
button.bg-primary:focus {
  background-color: '.$ds['nav1'].' !important;
}


.navbar-dark .navbar-nav .nav-link { 
  color: '.$ds['nav7'].';
  text-decoration: none; 
}

.navbar .nav-item:hover .nav-link{ 
  color: '.$ds['nav8'].';
  text-decoration: none;
  background: '.$ds['nav9'].'; 
}

.navbar .nav-item:focus .nav-link{ 
    color: '.$ds['nav8'].';
    text-decoration: none;
    background: '.$ds['nav9'].';
}

.dropdown-item{
    color: '.$ds['nav3'].';
    text-decoration: none;
    background: '.$ds['nav1'].';
}
.dropdown-item:focus,.dropdown-item:hover{
    color: '.$ds['nav4'].';
    text-decoration: none;
    background: '.$ds['nav10'].';
}
.dropdown-item.active,.dropdown-item:active{
    color: '.$ds['nav4'].';
    text-decoration: none;
    background-color: '.$ds['nav10'].';
  }

/*-------logo---------*/
.logo .bg-primary {
  background-color: '.$ds['nav1'].' !important;
  color:'.$ds['nav4'].';
}
.logo .webspell {
 color: '.$ds['nav4'].';
}

 .logo .slogan {
 color: '.$ds['nav4'].';
}
/*----------Footer---------------*/
.footer {
    color: '.$ds['foot6'].';
    background: '.$ds['foot1'].';
    border-top:1px solid '.$ds['foot4'].';
}

.footer h3 {
    color:'.$ds['foot3'].';
    
}

.copyright {
     background: '.$ds['foot5'].';
     border-top:1px solid '.$ds['foot4'].';
    color: '.$ds['foot2'].';
}

.copyright .foot .fa {
    color:'.$ds['foot3'].';
}



blockquote {
    border-left:5px solid '.$ds['nav5'].';
}

/*----------Content Head Line---------------*/

/*h2 span {
    border-bottom: 1px solid '.$ds['body4'].';
}*/
h2.head-h2 {
  color: '.$ds['typo2'].';
    border-bottom:1px solid '.$ds['typo6'].';
}

.card .list-group-item{
  background-color: '.$ds['card1'].';
  padding:.8125rem 1.875rem;
  border-bottom: 1px solid '.$ds['typo6'].' !important;
  color:'.$ds['body4'].' !important;}

/*-----------pagination--------------------*/
.pagination > li > a, .pagination > li > span {
 border: 1px solid '.$ds['typo6'].' !important;
}

.pagination>li>a,.pagination>li>span{
    border: 1px solid '.$ds['typo6'].';
}

.pagination > .active > a, .pagination > .active > a:focus, .pagination > .active > a:hover, .pagination > .active > span, .pagination > .active > span:focus, .pagination > .active > span:hover {
 background-color: '.$ds['typo4'].';
 color: #fff;
border: 1px solid '.$ds['typo6'].';
}

/* dataTable */

table.dataTable tbody tr{
  background-color: rgba(0,0,0, 0.0) !important; /*Zeilenhintergrung */
color:'.$ds['body4'].' !important;
}

.dataTables_wrapper .dataTables_paginate .paginate_button {
  color:'.$ds['body4'].' !important;
  border:1px solid #999;
}

.dataTables_wrapper .dataTables_paginate .paginate_button:hover,
.dataTables_wrapper .dataTables_paginate .paginate_button:active {
  color:'.$ds['body4'].' !important;
    background: '.$ds['nav5'].'; --over
    border:1px solid #fff;
}




.dataTables_wrapper .dataTables_paginate .paginate_button.disabled,
.dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover,
.dataTables_wrapper .dataTables_paginate .paginate_button.disabled:active{
    color:'.$ds['body4'].' !important;
    border:1px solid #999;
}

.dataTables_wrapper .dataTables_length,
.dataTables_wrapper .dataTables_filter,
.dataTables_wrapper .dataTables_info,
.dataTables_wrapper .dataTables_processing,
.dataTables_wrapper .dataTables_paginate{
    color:'.$ds['body4'].' !important;
}

.dataTables_wrapper .dataTables_paginate .paginate_button.current,
.dataTables_wrapper .dataTables_paginate .paginate_button.current:hover,
.dataTables_wrapper .dataTables_paginate .paginate_button.current:active {
    color:'.$ds['body4'].' !important;
    background: '.$ds['nav5'].'; --over
     border:1px solid #999;
}




.dataTables_wrapper .dataTables_paginate .paginate_button.next {
  color:'.$ds['body4'].' !important;
  border:1px solid #999;
}

.dataTables_wrapper .dataTables_paginate .paginate_button.next:hover,
.dataTables_wrapper .dataTables_paginate .paginate_button.next:active {
  color:'.$ds['body4'].' !important;
    background: '.$ds['nav5'].'; --over
    border:1px solid #999;
}










/*----------carousel---------------*/

.carousel-caption .hs-text h1 {
  color: '.$ds['carousel1'].';
}

.carousel-caption .hs-text h1 span {
  color: '.$ds['carousel2'].';
}

.carousel-caption .hs-text p {
  color: '.$ds['carousel3'].';
}  

.carousel-indicators> .active {
    background-color: '.$ds['carousel4'].';
}



/*----------follow_us---------------*/
.social-media h2 {
    margin: 0;
    color: '.$ds['nav5'].';
    border-bottom: 1px solid '.$ds['nav5'].'; 
}
.social-media small {
    margin: 0;
    color: '.$ds['nav5'].'; 
}

/*----------tsviewer---------------*/
#sc_tsviewer-icon {
   color: '.$ds['nav5'].';
}

#sc_tsviewer-headline {
    color: '.$ds['nav5'].';
}

.sc_tsviewer-info .fa-stack i {
    color: '.$ds['nav5'].';
}

.sc_tsviewer-infotitle {
    color: '.$ds['nav5'].';
}    

/*----------calendar---------------*/

.calendar .calendar_date31 {
 background-color: '.$ds['calendar1'].';
}

.calendar .calendar_today {
  background-color: '.$ds['calendar2'].';
}

.calendar th,
.calendar td {
  border: 1px solid '.$ds['typo6'].';
}

.calendar thead th {
  border-bottom: 1px solid '.$ds['typo6'].';
}

.calendar tbody + tbody {
  border-top: 1px solid '.$ds['typo6'].';
}

/*----------social-sidebar---------------*/

.social li a {
  background-color: '.$ds['typo4'].' !important;
}

.social li a:hover {
  background-color: '.$ds['typo4'].' !important;
}

.social li a div {
  background-color: '.$ds['typo4'].' !important;
}

.social li div:after {
  border: 10px solid transparent;
  border-right: 10px solid '.$ds['typo4'].';
}


/*----------card---------------*/
.card {
  background-color: '.$ds['card1'].';
  border: 1px solid '.$ds['card2'].';
}

/*----------table---------------*/
.table {
  color:'.$ds['body4'].' !important;
  border-top: 1px solid '.$ds['typo6'].';
}

.table th,
.table td {
  border-top: 1px solid '.$ds['typo6'].';
}

.table th,
.table td small{
  color:'.$ds['body4'].' !important;
}

.table thead th {
  border-bottom: 1px solid '.$ds['typo6'].';
}

.table tbody + tbody {
  border-top: 1px solid '.$ds['typo6'].';
}

tbody,td,tfoot,th,thead,tr{color:'.$ds['body4'].' !important;border-bottom: 1px solid '.$ds['typo6'].';}



/*----------profil---------------*/

#application {
    background-color: '.$ds['typo4'].' !important;
}

.nav-tabs {
   border-bottom: 1px solid '.$ds['typo4'].';
}

.nav-tabs .nav-link.active {
    border: 1px solid '.$ds['typo4'].';
    background-color: '.$ds['typo4'].';
    color: #000;
}

.nav-tabs .nav-link:hover {
  border: 1px solid '.$ds['typo4'].';
}



';
$ergebnis = safe_query("SELECT * FROM ".PREFIX."settings_buttons WHERE modulname='".getinput($ds['modulname'])."'");
    $db = mysqli_fetch_array($ergebnis);
echo'



<!-- Primary ==================================== -->

.btn-primary{}
.btn-primary{
color: '.$db['button3'].';
background-color: '.$db['button1'].';
border-color: '.$db['button4'].';
}
.btn-primary.focus,.btn-primary:focus{
color: '.$db['button3'].';
background-color: '.$db['button2'].';
border-color: '.$db['button4'].';
}
.btn-primary:hover{
color: '.$db['button3'].';
background-color: '.$db['button2'].';
border-color: '.$db['button5'].';
}
.btn-primary.active,.btn-primary:active,.open>.dropdown-toggle.btn-primary{
color: '.$db['button3'].';
background-color: '.$db['button2'].';
border-color: '.$db['button5'].';
}


<!-- Secondary ==================================== -->

.btn-secondary{}
.btn-secondary{
color: '.$db['button8'].';
background-color: '.$db['button6'].';
border-color: '.$db['button9'].';
}

.btn.btn-secondary:hover {
color: '.$db['button8'].';
background-color: '.$db['button7'].';
border-color: '.$db['button10'].'; 
}
    
.btn.btn-secondary:focus, .btn.btn-secondary.focus {
color: '.$db['button8'].';
background-color: '.$db['button7'].';
border-color: '.$db['button10'].'; 
}

.btn-secondary.active,.btn-secondary:active,.open>.dropdown-toggle.btn-secondary{
color: '.$db['button8'].';
background-color: '.$db['button7'].';
border-color: '.$db['button10'].';
}

<!-- Success ==================================== -->

.btn-success{}
.btn-success{
color: '.$db['button13'].';
background-color: '.$db['button11'].';
border-color: '.$db['button14'].';
}
.btn-success.focus,.btn-success:focus{
color: '.$db['button13'].';
background-color: '.$db['button12'].';
border-color: '.$db['button15'].';
}
.btn-success:hover{
color: '.$db['button13'].';
background-color: '.$db['button12'].';
border-color: '.$db['button15'].';
}
.btn-success.active,.btn-success:active,.open>.dropdown-toggle.btn-success{
color: '.$db['button13'].';
background-color: '.$db['button12'].';
border-color: '.$db['button15'].';
}

<!-- Danger ==================================== -->

.btn-danger{}
.btn-danger{
color: '.$db['button18'].';
background-color: '.$db['button16'].';
border-color: '.$db['button19'].';
}
.btn-danger.focus,.btn-danger:focus{
color: '.$db['button18'].';
background-color: '.$db['button17'].';
border-color: '.$db['button19'].';
}
.btn-danger:hover{
color: '.$db['button18'].';
background-color: '.$db['button17'].';
border-color: '.$db['button20'].';
}
.btn-danger.active,.btn-danger:active,.open>.dropdown-toggle.btn-danger{
color: '.$db['button18'].';
background-color: '.$db['button17'].';
border-color: '.$db['button20'].';
}

<!-- warning ==================================== -->

.btn-warning{}
.btn-warning{
color: '.$db['button23'].';
background-color: '.$db['button21'].';
border-color: '.$db['button24'].';
}
.btn-warning.focus,.btn-warning:focus{
color: '.$db['button23'].';
background-color: '.$db['button22'].';
border-color: '.$db['button24'].';
}
.btn-warning:hover{
color: '.$db['button23'].';
background-color: '.$db['button22'].';
border-color: '.$db['button25'].';
}
.btn-warning.active,.btn-warning:active,.open>.dropdown-toggle.btn-warning{
color: '.$db['button23'].';
background-color: '.$db['button22'].';
border-color: '.$db['button25'].';
}

<!-- Info ==================================== -->

.btn-info{}
.btn-info{
color: '.$db['button28'].';
background-color: '.$db['button26'].';
border-color: '.$db['button29'].';
}
.btn-info.focus,.btn-info:focus{
color: '.$db['button28'].';
background-color: '.$db['button27'].';
border-color: '.$db['button29'].';
}
.btn-info:hover{
color: '.$db['button28'].';
background-color: '.$db['button27'].';
border-color: '.$db['button30'].';
}
.btn-info.active,.btn-info:active,.open>.dropdown-toggle.btn-info{
color: '.$db['button28'].';
background-color: '.$db['button27'].';
border-color: '.$db['button30'].';
}

<!-- Light ==================================== -->

.btn-light{}
.btn-light{
color: '.$db['button33'].';
background-color: '.$db['button31'].';
border-color: '.$db['button34'].';
}
.btn-light.focus,.btn-light:focus{
color: '.$db['button33'].';
background-color: '.$db['button32'].';
border-color: '.$db['button34'].';
}
.btn-light:hover{
color: '.$db['button33'].';
background-color: '.$db['button32'].';
border-color: '.$db['button35'].';
}
.btn-light.active,.btn-light:active,.open>.dropdown-toggle.btn-light{
color: '.$db['button33'].';
background-color: '.$db['button32'].';
border-color: '.$db['button35'].';
}

<!-- Dark ==================================== -->

.btn-dark{}
.btn-dark{
color: '.$db['button38'].';
background-color: '.$db['button36'].';
border-color: '.$db['button39'].';
}
.btn-dark.focus,.btn-dark:focus{
color: '.$db['button38'].';
background-color: '.$db['button37'].';
border-color: '.$db['button39'].';
}
.btn-dark:hover{
color: '.$db['button38'].';
background-color: '.$db['button37'].';
border-color: '.$db['button40'].';
}
.btn-dark.active,.btn-dark:active,.open>.dropdown-toggle.btn-dark{
color: '.$db['button38'].';
background-color: '.$db['button37'].';
border-color: '.$db['button40'].';
}

<!-- Link ==================================== -->

.btn-link{}
.btn-link{
color: '.$db['button41'].';
}
.btn-link.focus,.btn-link:focus{
color: '.$db['button41'].';
}
.btn-link:hover{
color: '.$db['button42'].';
}
.btn-link.active,.btn-link:active,.open>.dropdown-toggle.btn-link{
color: '.$db['button42'].';
}


<!-- Login ==================================== -->
.pic {

}

.foto {

   background:
    -webkit-linear-gradient('.$ds['reg1'].', '.$ds['reg1'].' 100%), 
    url(/includes/themes/'.$theme_name.'/images/'.$ds['reg_pic'].') no-repeat center center ; 
  background:
    linear-gradient('.$ds['reg1'].', '.$ds['reg1'].' 100%), 
    url(/includes/themes/'.$theme_name.'/images/'.$ds['reg_pic'].') no-repeat center center ; 
}
.reg_pic_text {
  color: '.$ds['reg2'].';
}

<!-- portfolio ==================================== -->

.portfolio-content-head ul li:hover {
    color: '.$ds['typo4'].';
}

.mixitup-control-active {
    color: '.$ds['typo4'].'!important;
}

.portfolio-item:hover .portfolio-overlay::before {
    border-top: 1px solid '.$ds['typo4'].';
    border-right: 1px solid '.$ds['typo4'].';
}

.portfolio-item:hover .portfolio-overlay::after {
    border-bottom: 1px solid '.$ds['typo4'].';
    border-left: 1px solid '.$ds['typo4'].';
}

.portfolio-overlay .magnify-icon {
   background: '.$ds['typo4'].';
}

.portfolio-overlay .magnify-icon:hover {
    background: '.$ds['typo4'].';
}

';