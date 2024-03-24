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

    if(@$ds["background_pic"] == 'background_bg.jpg') {
        $rm_body_pic = "/includes/themes/".$ds["pfad"]."/images/".$ds["background_pic"]."";
        $content_style =  substr($ds["card1"], 4, -1);
    }else{
        $rm_body_pic = "/includes/themes/default/images/no_background.png";
        $content_style =  "transparent";
    }

$font_family = $ds["body1"];

$d_color = substr($ds["typo4"], 4, -1);
#$s_color = substr($db["secondarycolor"], 4, -1);
$p_color = substr($ds["typo3"], 4, -1);
$s_color = substr($ds["typo4"], 4, -1);

$rm_body_bg = substr($ds["body3"], 4, -1);
$rm_body_color = substr($ds["body4"], 4, -1);
$rm_body2_color = substr($ds["body5"], 4, -1);
$body_font_size = $ds["body2"];

$link_color = substr($ds["typo4"], 4, -1);
$link_hover_color = substr($ds["typo8"], 4, -1);

/*Background:nav1*/
$nav_border_top_color = substr($ds["nav5"], 4, -1);
$nav_border_top_size = $ds["nav6"];
$nav_bg = substr($ds["nav1"], 4, -1);
$nav_bg_sec = substr($ds["nav12"], 4, -1);
$nav_font_size = $ds["nav2"];

$nav_link_color = substr($ds["nav7"], 4, -1);
$nav_link_hover_color = substr($ds["nav8"], 4, -1);
$nav_link_hover_bg = substr($ds["nav9"], 4, -1);

$navdrp_link_color = substr($ds["nav3"], 4, -1);
$navdrp_link_hover_color = substr($ds["nav4"], 4, -1);
$navdrp_link_bg = substr($ds["nav10"], 4, -1);
$navdrp_link_hover_bg = substr($ds["nav11"], 4, -1);

/*card */
$card_bg = substr($ds["card1"], 4, -1);
$card_border_color = substr($ds["card2"], 4, -1);
$card_border_radius = $ds["border_radius"];
$btn_border_radius = $ds["border_radius"];

/*Footer*/
$rm_foot_bg = substr($ds["foot1"], 4, -1);

/*Carousel*/
$rm_carousel_h1 = substr($ds["carousel1"], 4, -1);
$rm_carousel_h1_span = substr($ds["carousel2"], 4, -1);
$rm_carousel_text = substr($ds["carousel3"], 4, -1);
$rm_carousel_indicators = substr($ds["carousel4"], 4, -1);

$reg_1 = substr($ds['reg1'], 4, -1);

$reg_2 = substr($ds['reg2'], 4, -1);

$buttons = safe_query("SELECT * FROM ".PREFIX."settings_buttons WHERE modulname= '".$ds["modulname"]."'");
$dx = mysqli_fetch_array($buttons);

/*Button Radius*/
$button_border_radius = $dx["btn_border_radius"];

echo'

:root {
  --bs-primary: '.$p_color.';
  
  --bs-secondary: '.$s_color.';

  --bs-primary-rgb: '.$d_color.';

/* Body */
  --bs-rm-body-bg: '.$rm_body_bg.';
  --bs-body-color: '.$rm_body_color.';
  --bs-body-secondary-color: '.$rm_body2_color.'; 
  --bs-body-font-size: '.$body_font_size.'; 
  --bs-font-family: '.$font_family.';
  --bs-rm-body-pic: url('.$rm_body_pic.');
  --bs-rm-content-style-bg: '.$content_style.';

/* Links */
  --bs-link-color: '.$link_color.';
  --bs-link-hover-color: '.$link_hover_color.';

/* Navigaton */
  --bs-nav-border-top-color-rgb: '.$nav_border_top_color.';
  --bs-nav-border-top-size: '.$nav_border_top_size.';
  --bs-nav-bg-rgb: '.$nav_bg.';
  --bs-nav-sec-bg-rgb: '.$nav_bg_sec.';
  --bs-nav-font-size: '.$nav_font_size.';

  --bs-rm-nav-link-color-rgb: '.$nav_link_color.';
  --bs-rm-nav-link-hover-color-rgb: '.$nav_link_hover_color.';
  --bs-rm-nav-link-hover-bg-rgb: '.$nav_link_hover_bg.';

/* Navigaton Dropdown*/
  --bs-rm-navdrp-link-color-rgb: '.$navdrp_link_color.';
  --bs-rm-navdrp-link-hover-color-rgb: '.$navdrp_link_hover_color.';
  --bs-rm-navdrp-link-bg-rgb: '.$navdrp_link_bg.';  
  --bs-rm-navdrp-link-hover-bg-rgb: '.$navdrp_link_hover_bg.';

/* Card */
  --bs-card-border-color-rgb: '.$card_border_color.';
  --bs-card-bg-rgb: '.$card_bg.';

/*Button & Card Radius*/  
    --bs-button-border-radius: '.$button_border_radius.';
    --bs-border-radius: '.$card_border_radius.';
    --bs-rm-card-inner-border-radius: calc('.$card_border_radius.' - 1px);

/*Footer*/
    --bs-rm-foot-bg-rgb: '.$rm_foot_bg.';  

/*Login*/
   --bs-login_color-rgb: '.$reg_1.';

/*Login*/
--bs-login_color_pic_text-rgb: '.$reg_2.';      

/*Carousel*/
--bs-carousel_h1_color-rgb: '.$rm_carousel_h1.';
--bs-carousel_h1_span_color-rgb: '.$rm_carousel_h1_span.';
--bs-carousel_text_color-rgb: '.$rm_carousel_text.';
--bs-carousel_indicators_color-rgb: '.$rm_carousel_indicators.';

}


/* Login ==================================== */

.bg-image {
background-image: url(/includes/themes/'.$theme_name.'/images/'.$ds['reg_pic'].'); 
}
';


$button = safe_query("SELECT * FROM ".PREFIX."settings_buttons WHERE modulname='".getinput($ds['modulname'])."'");
    $db = mysqli_fetch_array($button);
echo'



<!-- Primary ==================================== -->

.btn-primary{}
.btn-primary{
color: '.$db['button3'].';
background-color: '.$db['button1'].';
border-color: '.$db['button4'].';
}
.btn-primary:hover{
color: '.$db['button3'].';
background-color: '.$db['button2'].';
border-color: '.$db['button5'].';
}
.btn-primary.focus,.btn-primary:focus{
color: '.$db['button3'].';
background-color: '.$db['button2'].';
border-color: '.$db['button4'].';
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
';