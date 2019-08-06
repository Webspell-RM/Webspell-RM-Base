<?php 

$_language->readModule('overview', false, true);

if (!isanyadmin($userID) || mb_substr(basename($_SERVER[ 'REQUEST_URI' ]), 0, 15) != "admincenter.php") {
    die($_language->module[ 'access_denied' ]);
}


$nickname = '' . getnickname($userID) . ',<br>';
$lastlogin = getformatdatetime($_SESSION[ 'ws_lastlogin' ]);
echo'<div class="panel panel-default">
            <div class="panel-heading">'.$_language->module['welcome'].'
                
            </div>

            <div class="panel-body">

                        <!--<p class="title-description"> Deine Webbenutzerschnittstelle </p>-->

'.$_language->module['hello'].' <b>'.$nickname.'</b> '.$_language->module['last_login'].' '.$lastlogin.'.<br /><br />';
echo $_language->module['welcome_message'];


    
?>
<style>


.style_prevu_kit
{
    display:inline-block;
    border:0;
    
    position: relative;
    -webkit-transition: all 200ms ease-in;
    -webkit-transform: scale(1); 
    -ms-transition: all 200ms ease-in;
    -ms-transform: scale(1); 
    -moz-transition: all 200ms ease-in;
    -moz-transform: scale(1);
    transition: all 200ms ease-in;
    transform: scale(1);   

}
.style_prevu_kit:hover
{
    box-shadow: 0px 0px 150px #000000;
    z-index: 2;
    -webkit-transition: all 200ms ease-in;
    -webkit-transform: scale(1.5);
    -ms-transition: all 200ms ease-in;
    -ms-transform: scale(1.5);   
    -moz-transition: all 200ms ease-in;
    -moz-transform: scale(1.5);
    transition: all 200ms ease-in;
    transform: scale(1.5);
}
.image_caption span {
    background-color: silver;
    background-color: hsla(0, 0%, 100%, 0.0);
    position:absolute;
 right: 25px; top:120px; width:0px; height:30px;
    bottom: 0;
    width: 100%;
    line-height: 2em;
    text-align: right;
    color: #fff;
}
div.logo1 {
background-image: url(../components/admin/images/status.png);
background-size: 308px;
width:308px;height:160px;

}
.cart-block {
  padding: 15px; 
}

.cart-block .tab-content {
    padding: 0;
    border-color: transparent; 
}

@media (min-width: 1200px) {
  .cart-block {
      padding: 0px;
      background-color: #3a4651; 
  } 
}

@media (max-width: 767px) {
  .cart-block {
      padding: 0px;
      background-color: #3a4651; 
  } 
}

.cart {
  background-color: #fff;
  box-shadow: 1px 1px 5px rgba(126, 142, 159, 0.1);
  margin-bottom: 0px;
  border-radius: 0;
  border: none; 
}

.cart .cart {
    box-shadow: none; 
}

.cart .cart-header {
    background-image: none;
    background-color: #fe821d;
    
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    text-align: center;
    padding: 0.75rem 1.25rem;
    border-radius: 0;
    height: 50px;
    
    color: #fff;
    border-bottom: 1px solid #ccc;
}

</style>
<link href="http://fonts.googleapis.com/css?family=Roboto:100,400,300,500,700" rel="stylesheet" type="text/css">
<div class="col-md-12">
<div style="text-align: center;margin-top: 20px">

<div class="style_prevu_kit" style="width: 350px;"><a href="https://webspell-rm.de/index.php?site=files" target="_blank" style="text-decoration:none">
<div class="cart">
<div class="cart-block">
  <div class="logo1 image_caption"><span>Version <?=$version;?></span></div>
  </div>
  
  <div class="cart-header">
   <?php UpdateStatus(); ?>
  </div>
</div></a>
</div>

<div class="style_prevu_kit" style="width: 350px;"><a href="https://webspell-rm.de/index.php?site=forum" target="_blank" style="text-decoration:none">
<div class="cart">
<div class="cart-block">
  <div class="logo1 image_caption"><span>Forum</span></div>
  </div>
  
  <div class="cart-header" style="text-align: center;">
   Diskusionen und Support Rund um Webspell-RM
  </div>
</div></a>
</div>

<div class="style_prevu_kit" style="width: 350px;"><a href="http://wiki.webspell-rm.de/" target="_blank" style="text-decoration:none">
<div class="cart">
<div class="cart-block">
  <div class="logo1 image_caption"><span>WIKI</span></div>

  </div>
  
  <div class="cart-header" style="text-align: center;">
    Das offizielle Webspell RM Wiki
  </div>
</div></a>
</div>

<div class="style_prevu_kit" style="width: 350px;"><a href="https://discordapp.com/invite/SgPrVk?utm_source=Discord%20Widget&utm_medium=Connect" target="_blank" style="text-decoration:none">
<div class="cart">
<div class="cart-block">
  <div class="logo1 image_caption"><span>Discord</span></div>
  </div>
  
  <div class="cart-header" style="text-align: center;">
    Catte auf Discord mit uns.
  </div>
</div></a>
</div>


</div>

</div></div>

