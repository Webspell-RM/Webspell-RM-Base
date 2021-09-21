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

hr {
    border-top: '.$ds['typo7'].' solid '.$ds['typo6'].';
}

/*-------cookie---------*/

#footer-cookie a, .text-primary {
  color: '.$ds['typo4'].' !important;
  text-decoration: none;
}

.news-block,
.news-box .bg-primary {
  background-color: '.$ds['typo4'].' !important;
  /*color:'.$ds['nav4'].';*/
  color: '.$ds['body3'].';
}

/*-------logo---------*/
.logo .bg-primary {
  background-color: '.$ds['typo4'].' !important;
  color:'.$ds['nav4'].';
}

.nav-item::before {
 /* background-color: '.$ds['typo4'].' !important;*/
}

.well {
    background-color: '.$ds['typo1'].';
}

.navbar-default {
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

.navbar-nav .dropdown-menu {
    background: '.$ds['nav1'].';
}

.dropdown-menu a {
    color: '.$ds['nav3'].';
    text-decoration: none;
    background: '.$ds['nav1'].';
}
.dropdown-menu a:hover {
    color: '.$ds['nav4'].';
    text-decoration: none;
    background: '.$ds['nav10'].';
}


.navbar-nav > li > a {
    color: '.$ds['nav7'].';
    text-decoration: none;
}
.navbar-nav > li > a:hover {
    color: '.$ds['nav8'].';
    text-decoration: none;
    background: '.$ds['nav9'].';
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

h2 span {
    border-bottom: 1px solid '.$ds['nav5'].';
}

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

table.dataTable tbody tr{background-color: rgba(0,0,0, 0.0) !important; /*Zeilenhintergrung */
color: '.$ds['nav5'].';
}

.dataTables_wrapper .dataTables_paginate .paginate_button{box-sizing:border-box;
    color:'.$ds['nav5'].';
}

.dataTables_wrapper .dataTables_paginate .paginate_button.disabled,
.dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover,
.dataTables_wrapper .dataTables_paginate .paginate_button.disabled:active{
    color:'.$ds['nav5'].';
}

.dataTables_wrapper .dataTables_length,
.dataTables_wrapper .dataTables_filter,
.dataTables_wrapper .dataTables_info,
.dataTables_wrapper .dataTables_processing,
.dataTables_wrapper .dataTables_paginate{
    color:'.$ds['nav5'].';
}

.dataTables_wrapper .dataTables_paginate .paginate_button.current,
.dataTables_wrapper .dataTables_paginate .paginate_button.current:hover,
.dataTables_wrapper .dataTables_paginate .paginate_button.current:active {
    color:'.$ds['nav5'].';
    background: '.$ds['nav5'].';
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

.calendar_date31 {
 background-color: '.$ds['calendar1'].';
}

.calendar_today {
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
  color: '.$ds['body4'].';
  border-top: 1px solid '.$ds['typo6'].';
}

.table th,
.table td {
  border-top: 1px solid '.$ds['typo6'].';
}

.table thead th {
  border-bottom: 1px solid '.$ds['typo6'].';
}

.table tbody + tbody {
  border-top: 1px solid '.$ds['typo6'].';
}


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








<!-- Primary ==================================== -->

.btn-primary{}
.btn-primary{
color: '.$ds['button3'].';
background-color: '.$ds['button1'].';
border-color: '.$ds['button4'].';
}
.btn-primary.focus,.btn-primary:focus{
color: '.$ds['button3'].';
background-color: '.$ds['button2'].';
border-color: '.$ds['button4'].';
}
.btn-primary:hover{
color: '.$ds['button3'].';
background-color: '.$ds['button2'].';
border-color: '.$ds['button5'].';
}
.btn-primary.active,.btn-primary:active,.open>.dropdown-toggle.btn-primary{
color: '.$ds['button3'].';
background-color: '.$ds['button2'].';
border-color: '.$ds['button5'].';
}


<!-- Secondary ==================================== -->

.btn-secondary{}
.btn-secondary{
color: '.$ds['button8'].';
background-color: '.$ds['button6'].';
border-color: '.$ds['button9'].';
}

.btn.btn-secondary:hover {
color: '.$ds['button8'].';
background-color: '.$ds['button7'].';
border-color: '.$ds['button10'].'; 
}
    
.btn.btn-secondary:focus, .btn.btn-secondary.focus {
color: '.$ds['button8'].';
background-color: '.$ds['button7'].';
border-color: '.$ds['button10'].'; 
}

.btn-secondary.active,.btn-secondary:active,.open>.dropdown-toggle.btn-secondary{
color: '.$ds['button8'].';
background-color: '.$ds['button7'].';
border-color: '.$ds['button10'].';
}

<!-- Success ==================================== -->

.btn-success{}
.btn-success{
color: '.$ds['button13'].';
background-color: '.$ds['button11'].';
border-color: '.$ds['button14'].';
}
.btn-success.focus,.btn-success:focus{
color: '.$ds['button13'].';
background-color: '.$ds['button12'].';
border-color: '.$ds['button15'].';
}
.btn-success:hover{
color: '.$ds['button13'].';
background-color: '.$ds['button12'].';
border-color: '.$ds['button15'].';
}
.btn-success.active,.btn-success:active,.open>.dropdown-toggle.btn-success{
color: '.$ds['button13'].';
background-color: '.$ds['button12'].';
border-color: '.$ds['button15'].';
}

<!-- Danger ==================================== -->

.btn-danger{}
.btn-danger{
color: '.$ds['button18'].';
background-color: '.$ds['button16'].';
border-color: '.$ds['button19'].';
}
.btn-danger.focus,.btn-danger:focus{
color: '.$ds['button18'].';
background-color: '.$ds['button17'].';
border-color: '.$ds['button19'].';
}
.btn-danger:hover{
color: '.$ds['button18'].';
background-color: '.$ds['button17'].';
border-color: '.$ds['button20'].';
}
.btn-danger.active,.btn-danger:active,.open>.dropdown-toggle.btn-danger{
color: '.$ds['button18'].';
background-color: '.$ds['button17'].';
border-color: '.$ds['button20'].';
}

<!-- warning ==================================== -->

.btn-warning{}
.btn-warning{
color: '.$ds['button23'].';
background-color: '.$ds['button21'].';
border-color: '.$ds['button24'].';
}
.btn-warning.focus,.btn-warning:focus{
color: '.$ds['button23'].';
background-color: '.$ds['button22'].';
border-color: '.$ds['button24'].';
}
.btn-warning:hover{
color: '.$ds['button23'].';
background-color: '.$ds['button22'].';
border-color: '.$ds['button25'].';
}
.btn-warning.active,.btn-warning:active,.open>.dropdown-toggle.btn-warning{
color: '.$ds['button23'].';
background-color: '.$ds['button22'].';
border-color: '.$ds['button25'].';
}

<!-- Info ==================================== -->

.btn-info{}
.btn-info{
color: '.$ds['button28'].';
background-color: '.$ds['button26'].';
border-color: '.$ds['button29'].';
}
.btn-info.focus,.btn-info:focus{
color: '.$ds['button28'].';
background-color: '.$ds['button27'].';
border-color: '.$ds['button29'].';
}
.btn-info:hover{
color: '.$ds['button28'].';
background-color: '.$ds['button27'].';
border-color: '.$ds['button30'].';
}
.btn-info.active,.btn-info:active,.open>.dropdown-toggle.btn-info{
color: '.$ds['button28'].';
background-color: '.$ds['button27'].';
border-color: '.$ds['button30'].';
}

<!-- Light ==================================== -->

.btn-light{}
.btn-light{
color: '.$ds['button33'].';
background-color: '.$ds['button31'].';
border-color: '.$ds['button34'].';
}
.btn-light.focus,.btn-light:focus{
color: '.$ds['button33'].';
background-color: '.$ds['button32'].';
border-color: '.$ds['button34'].';
}
.btn-light:hover{
color: '.$ds['button33'].';
background-color: '.$ds['button32'].';
border-color: '.$ds['button35'].';
}
.btn-light.active,.btn-light:active,.open>.dropdown-toggle.btn-light{
color: '.$ds['button33'].';
background-color: '.$ds['button32'].';
border-color: '.$ds['button35'].';
}

<!-- Dark ==================================== -->

.btn-dark{}
.btn-dark{
color: '.$ds['button38'].';
background-color: '.$ds['button36'].';
border-color: '.$ds['button39'].';
}
.btn-dark.focus,.btn-dark:focus{
color: '.$ds['button38'].';
background-color: '.$ds['button37'].';
border-color: '.$ds['button39'].';
}
.btn-dark:hover{
color: '.$ds['button38'].';
background-color: '.$ds['button37'].';
border-color: '.$ds['button40'].';
}
.btn-dark.active,.btn-dark:active,.open>.dropdown-toggle.btn-dark{
color: '.$ds['button38'].';
background-color: '.$ds['button37'].';
border-color: '.$ds['button40'].';
}

<!-- Link ==================================== -->

.btn-link{}
.btn-link{
color: '.$ds['button41'].';
}
.btn-link.focus,.btn-link:focus{
color: '.$ds['button41'].';
}
.btn-link:hover{
color: '.$ds['button42'].';
}
.btn-link.active,.btn-link:active,.open>.dropdown-toggle.btn-link{
color: '.$ds['button42'].';
}


/**************** INPUT ANIMATION ****************/

/* Border bottom effects */
}
.form-group {
  position: relative;
}
.form-input {
  position: relative;
  width: 100%;
  border: none;
  box-shadow: none;
  outline: none;
}
/* Border bottom effects */
.form-input.border-bottom {
  position: relative;
  background: transparent;
  padding: 0;
  /* border-bottom: 2px solid rgba(0, 0, 0, .2); */
}
.form-input.border-bottom ~ .border-bottom-animation {
  position: absolute;
  content: "";
  width: 0;
  /* background: rgba(0, 0, 0, .2); */
  height: 2px;
  z-index: 99;
  -webkit-transition: all .4s ease;
     -moz-transition: all .4s ease;
      -ms-transition: all .4s ease;
       -o-transition: all .4s ease;
          transition: all .4s ease;
}
/* Border bottom left */
.form-input.border-bottom ~ .border-bottom-animation.left {
  left: 0;
  bottom: 0;
}
.form-input.border-bottom:focus ~ .border-bottom-animation.left {
  background: '.$ds['nav5'].';
  width: 100%;
}
/* Border bottom right */
.form-input.border-bottom ~ .border-bottom-animation.right {
  right: 0;
  bottom: 0;
}
.form-input.border-bottom:focus ~ .border-bottom-animation.right {
  background: '.$ds['nav5'].';
  width: 100%;
}
/* Border bottom center */
.form-input.border-bottom ~ .border-bottom-animation.center {
  left: 0;
  right: 0;
  bottom: 0;
  margin: 0 auto;
}
.form-input.border-bottom:focus ~ .border-bottom-animation.center {
  background: '.$ds['nav5'].';
  width: 100%;
}
/* Border bottom both side */
.form-input.border-bottom ~ .border-bottom-animation.both-side {
  height: 0px;
  width: 100%;
  left: 0;
  right: 0;
  bottom: 0;
}
.form-input.border-bottom ~ .border-bottom-animation.both-side:before,
.form-input.border-bottom ~ .border-bottom-animation.both-side:after {
  position: absolute;
  content: " ";
  bottom: 0;
  width: 0;
  height: 2px;
  -webkit-transition: all .4s ease;
     -moz-transition: all .4s ease;
      -ms-transition: all .4s ease;
       -o-transition: all .4s ease;
          transition: all .4s ease;
}
.form-input.border-bottom ~ .border-bottom-animation.both-side:before {
  left: 0;
}
.form-input.border-bottom ~ .border-bottom-animation.both-side:after {
  right: 0;
}
.form-input.border-bottom:focus ~ .border-bottom-animation.both-side:before,
.form-input.border-bottom:focus ~ .border-bottom-animation.both-side:after {
  background: '.$ds['nav5'].';
  width: 50%;
}

/* Border Animations */
/* Style 1 */
.form-input.border-animation ~ .border-line-animation.top-bottom:before,
.form-input.border-animation ~ .border-line-animation.top-bottom:after,
.form-input.border-animation ~ .border-line-animation.left-right:before,
.form-input.border-animation ~ .border-line-animation.left-right:after,
.form-input.border-animation ~ .border-line-animation.top:before,
.form-input.border-animation ~ .border-line-animation.top:after,
.form-input.border-animation ~ .border-line-animation.bottom:before,
.form-input.border-animation ~ .border-line-animation.bottom:after,
.form-input.border-animation ~ .border-line-animation.left:before,
.form-input.border-animation ~ .border-line-animation.left:after,
.form-input.border-animation ~ .border-line-animation.right:before,
.form-input.border-animation ~ .border-line-animation.right:after{
  position: absolute;
  content: " ";
  right: 0;
  background: '.$ds['nav5'].';
  -webkit-transition: all .4s linear;
     -moz-transition: all .4s linear;
      -ms-transition: all .4s linear;
       -o-transition: all .4s linear;
          transition: all .4s linear;
}
.form-input.border-animation ~ .border-line-animation.top-bottom:before,
.form-input.border-animation ~ .border-line-animation.top-bottom:after,
.form-input.border-animation ~ .border-line-animation.top:before,
.form-input.border-animation ~ .border-line-animation.top:after,
.form-input.border-animation ~ .border-line-animation.bottom:before,
.form-input.border-animation ~ .border-line-animation.bottom:after
 {
  width: 0;
  height: 2px;
}
.form-input.border-animation ~ .border-line-animation.left-right:before,
.form-input.border-animation ~ .border-line-animation.left-right:after,
.form-input.border-animation ~ .border-line-animation.left:before,
.form-input.border-animation ~ .border-line-animation.left:after,
.form-input.border-animation ~ .border-line-animation.right:before,
.form-input.border-animation ~ .border-line-animation.right:after
 {
  width: 2px;
  height: 0;
}
.form-input.border-animation.set-1 ~ .border-line-animation.top-bottom:before {
  bottom: 0;
  left: 0;
}
.form-input.border-animation.set-1 ~ .border-line-animation.top-bottom:after {
  top: 0;
  right: 0;
}
.form-input.border-animation.set-1 ~ .border-line-animation.left-right:before {
  left: 0;
  bottom: 0;
  left: 0;
}
.form-input.border-animation.set-1 ~ .border-line-animation.left-right:after {
  top: 0;
  right: 0;
  bottom: 0;
}
.form-input.border-animation.set-1:focus ~ .border-line-animation.top-bottom:before,
.form-input.border-animation.set-1:focus ~ .border-line-animation.top-bottom:after {
  width: 100%;
}
.form-input.border-animation.set-1:focus ~ .border-line-animation.left-right:before,
.form-input.border-animation.set-1:focus ~ .border-line-animation.left-right:after {
  height: 100%;
}




/**************** EINSTELLUNGEN ENDE *********************************/
/*#noheadcol {
  width: 100%;
  height: 300px;
  background-image: url("/includes/themes/'.$theme_name.'/images/header-pic.jpg");
  background-repeat: no-repeat;
  background-size: 100% 300px;

}*/
';