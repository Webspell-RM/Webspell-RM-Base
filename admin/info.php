<?php 
/*¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯\
| _    _  ___  ___  ___  ___  ___  __    __      ___   __  __       |
|( \/\/ )(  _)(  ,)/ __)(  ,\(  _)(  )  (  )    (  ,) (  \/  )      |
| \    /  ) _) ) ,\\__ \ ) _/ ) _) )(__  )(__    )  \  )    (       |
|  \/\/  (___)(___/(___/(_)  (___)(____)(____)  (_)\_)(_/\/\_)      |
|                       ___          ___                            |
|                      |__ \        / _ \                           |
|                         ) |      | | | |                          |
|                        / /       | | | |                          |
|                       / /_   _   | |_| |                          |
|                      |____| (_)   \___/                           |
\___________________________________________________________________/
/                                                                   \
|        Copyright 2005-2018 by webspell.org / webspell.info        |
|        Copyright 2018-2019 by webspell-rm.de                      |
|                                                                   |
|        - Script runs under the GNU GENERAL PUBLIC LICENCE         |
|        - It's NOT allowed to remove this copyright-tag            |
|        - http://www.fsf.org/licensing/licenses/gpl.html           |
|                                                                   |
|               Code based on WebSPELL Clanpackage                  |
|                 (Michael Gruber - webspell.at)                    |
\___________________________________________________________________/
/                                                                   \
|                     WEBSPELL RM Version 2.0                       |
|           For Support, Mods and the Full Script visit             |
|                       webspell-rm.de                              |
\__________________________________________________________________*/
$_language->readModule('overview', false, true);

if (!isanyadmin($userID) || mb_substr(basename($_SERVER[ 'REQUEST_URI' ]), 0, 15) != "admincenter.php") {
    die($_language->module[ 'access_denied' ]);
}


$username = '' . getnickname($userID) . ',<br>';
$lastlogin = getformatdatetime($_SESSION[ 'ws_lastlogin' ]);
echo'<div class="panel panel-default">
            <div class="panel-heading">Willkommen in deinem Managementcenter
                
            </div>

            <div class="panel-body">

                        <p class="title-description"> Deine Webbenutzerschnittstelle </p>

'.$_language->module['hello'].' '.$username.' '.$_language->module['last_login'].' '.$lastlogin.'.<br /><br />';
echo $_language->module['welcome_message'];

echo'<br><br>';
    echo file_get_contents('http://update.webspell-rm.de/update.php?v='.$version.'&h='.$_SERVER[ 'SERVER_NAME' ].'');
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
background-image: url(../components/admin/images/status-1.png);
background-size: 308px;
width:308px;height:150px;

}
.cart-block {
  padding: 15px; }
  .cart-block .tab-content {
    padding: 0;
    border-color: transparent; }
  @media (min-width: 1200px) {
    .cart-block {
      padding: 20px; } }
  @media (max-width: 767px) {
    .cart-block {
      padding: 10px; } }
.cart {
  background-color: #fff;
  box-shadow: 1px 1px 5px rgba(126, 142, 159, 0.1);
  margin-bottom: 10px;
  border-radius: 0;
  border: none; }
  .cart .cart {
    box-shadow: none; }
  .cart .cart-header {
    background-image: none;
    background-color: #fe821d;
    -webkit-box-align: center;
        -ms-flex-align: center;
            align-items: center;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: horizontal;
    -webkit-box-direction: normal;
        -ms-flex-direction: row;
            flex-direction: row;
    padding:.75rem 1.25rem;
    border-radius: 0;
    min-height: 50px;
    border: none;
    color: #fff; }
   .cart .cart-header { border-bottom: 1px solid #ccc;}

</style>
<link href="http://fonts.googleapis.com/css?family=Roboto:100,400,300,500,700" rel="stylesheet" type="text/css">

<div style="text-align: center;">

<div class="style_prevu_kit" style="width: 350px;"><a href="http://webspell-rm.de/index.php?site=files" target="_blank" style="text-decoration:none">
<div class="cart cart-primary">
<div class="cart-block" style="background-color: #3a4651;">
  <div class="logo1 image_caption"><span>Version x.x</span></div>
  </div>
  
  <div class="cart-header" style="text-align: center;">
    Neue Version verfügbar?
  </div>
</div></a>
</div>

<div class="style_prevu_kit" style="width: 350px;"><a href="http://webspell-rm.de/index.php?site=forum" target="_blank" style="text-decoration:none">
<div class="cart cart-primary">
<div class="cart-block" style="background-color: #3a4651; ">
  <div class="logo1 image_caption"><span>Forum</span></div>
  </div>
  
  <div class="cart-header" style="text-align: center;">
    Support
  </div>
</div></a>
</div>

<div class="style_prevu_kit" style="width: 350px;"><a href="http://webspell-rm.de/index.php?site=files" target="_blank" style="text-decoration:none">
<div class="cart cart-primary">
<div class="cart-block" style="background-color: #3a4651; ">
  <div class="logo1 image_caption"><span>Download</span></div>

  </div>
  
  <div class="cart-header" style="text-align: center;">
    Download
  </div>
</div></a>
</div>

<div class="style_prevu_kit" style="width: 350px;"><a href="https://discordapp.com/invite/SgPrVk?utm_source=Discord%20Widget&utm_medium=Connect" target="_blank" style="text-decoration:none">
<div class="cart cart-primary">
<div class="cart-block" style="background-color: #3a4651; ">
  <div class="logo1 image_caption"><span>discord</span></div>
  </div>
  
  <div class="cart-header" style="text-align: center;">
    Extra
  </div>
</div></a>
</div>


</div>

</div></div>

