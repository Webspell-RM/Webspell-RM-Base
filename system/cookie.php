<?php
function getcookiescript() {
echo'
<script type="text/javascript">
    function cookie_accepted() {
        var d = new Date();
        d.setTime(d.getTime() + (1*24*60*60*1000));
        var expires = "expires="+d.toUTCString();
        document.cookie = "cookie" + "=accepted" + "; " + expires;
        document.getElementById(\'cookie\').style.display = "none";
    }
</script>

<style>
    div.cookie {
        width: 100%;
        position: fixed;
        z-index: 9999;
        background-color: rgb(0, 0, 0, 0.80);
        color: rgb(255, 255, 255);
        top: 0px;
        text-align: center;
        padding: 25px 0 15px 0;
        font-size: 15px;
        height: auto;
    }
</style>
';
}
$res = safe_query("SELECT `default_language` FROM `".PREFIX."settings` WHERE 1");
$row = mysqli_fetch_array($res);
if(isset($_SESSION[ 'language' ])) { 
    $lng=$_SESSION[ 'language' ]; 
} elseif(isset($_SESSION[ 'language' ])) { 
    $lng=$_SESSION[ 'language' ];
} else { 
    if(isset($row['default_language'])) { 
        $lng=$row['default_language']; 
    } else { 
        $lng="en"; 
    }
}
$_lng = new webspell\Language();
$_lng->setLanguage($lng, false);
$_lng->readModule('cookie');
if(!isset($_COOKIE["cookie"])) {
    $data_array = array();
    $btn1 = $_lng->module['accept'];
    $btn2 = $_lng->module['privacy_policy'];
    $txt = $_lng->module['cookie_txt'];
    echo'
       <div id="cookie" class="cookie">
           '.$txt.'
           <div class="col-sm-12 mt-3 mb-4">
           <a href="javascript:cookie_accepted()"><button type="button" class="btn btn-success">'.$btn1.'</button></a>
           <a href="index.php?site=privacy_policy"><button type="button" class="btn btn-warning">'.$btn2.'</button></a>
           </div>
       </div>
    ';
}
?>