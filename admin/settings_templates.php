<style type="text/css">

div.imageHold {
  /*padding: 55px 85px; /* damit der container die höhe des großen bildes annimmt */
  /* andere formatierung, z.B. zentrieren/etc: */
  /* .... */
}

div.imageHold div {

  width: 88px;
  height: 180px;
  /* ab hier kann man die abstände
  und sonstiges der bilder eintragen */
  /*margin-left: 50px;*/
}
div.imageHold img {
  height:  100% !important;
    width: 500px;
    object-fit: cover;
    object-position: top ;
  /*width: 88px;  /* wir skalieren das große bild auf die kleine größe */
  /*height: 180px; /* um verpixelung beim vergößern zu verhindern       */
}
div.imageHold img:hover {
  position: absolute;
  margin-left: 50px; /* die hälfte des größenunterschiedes der bilder */
  margin-top: -120px;  /* hier genau so */
  width: 500px;       /* die weite beim vergrößern */
  height: 1025px!important;      /* die höhe beim vergrößern */
}
</style>
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
$_language->readModule('templates', false, true);

$ergebnis = safe_query("SELECT * FROM ".PREFIX."navigation_dashboard_links WHERE modulname='templates'");
    while ($db=mysqli_fetch_array($ergebnis)) {
      $accesslevel = 'is'.$db['accesslevel'].'admin';

if (!$accesslevel($userID) || mb_substr(basename($_SERVER[ 'REQUEST_URI' ]), 0, 15) != "admincenter.php") {
    die($_language->module[ 'access_denied' ]);
}
}

if (isset($_POST[ 'sortieren' ])) {
    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_POST[ 'captcha_hash' ])) {
        $sort = $_POST[ 'sort' ];
        foreach ($sort as $sortstring) {
            $sorter = explode("-", $sortstring);
            safe_query("UPDATE " . PREFIX . "settings_themes SET sort='".$sorter[1]."' WHERE themeID='".$sorter[0]."' ");
        }
    } else {
        echo $_language->module[ 'transaction_invalid' ];
    }
} elseif (isset($_POST[ 'saveedit' ])) {
    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_POST[ 'captcha_hash' ])) {
        #$name = $_POST[ 'name' ];
        
      if(@$_POST['radio1']=="active") {
        $active = 1;
        $deactivated = 0;
         
     
    } else {
        $active = 0;
        $deactive = 0;
    }
        
    if($active == '1') {
      $sql = safe_query("SELECT `themeID` FROM `".PREFIX."settings_themes` WHERE `active` = 1 LIMIT 1");
      safe_query("UPDATE `".PREFIX."settings_themes` SET active = 0 WHERE `themeID` = themeID");
    }

        $themeID = (int)$_POST[ 'themeID' ];
        $id = $themeID;

        safe_query(
            "UPDATE
                `" . PREFIX . "settings_themes`
            SET
                
                `active` = '" . $active . "'
            WHERE
                `themeID` = '" . $themeID . "'"
        );

        
    } else {
        echo $_language->module[ 'transaction_invalid' ];
    }
}

$_language->readModule('templates', false, true);

if (isset($_GET[ 'action' ])) {
    $action = $_GET[ 'action' ];
} else {
    $action = '';
}

echo'<div class="card">
        <div class="card-header">
            <i class="fas fa-puzzle-piece"></i> Themes
        </div>
<div class="card-body">';
  
  $row = safe_query("SELECT * FROM " . PREFIX . "settings_themes");
    $tmp = mysqli_fetch_assoc(safe_query("SELECT count(themeID) as cnt FROM " . PREFIX . "settings_themes"));
    $anzpartners = $tmp[ 'cnt' ];
    $CAPCLASS = new \webspell\Captcha;
    $CAPCLASS->createTransaction();
    $hash = $CAPCLASS->getHash();

   echo'   <table class="table table-striped">
    <thead>
      
      
      <th>'.$_language->module['template_name'].'</th>
      <th scope="col">Banner</b></th>
      <th>'.$_language->module['active'].'</th>
      <th>'.$_language->module['actions'].'</th>
    </thead>';

   $i = 1;
    while ($db = mysqli_fetch_array($row)) {

   
if($db[ 'name' ] == '') {
      $pic = 'n/a';
    } else {
      $pic = '<img src="../includes/themes/'.getinput($db['name']).'/images/'.getinput($db['name']).'.jpg" alt="{img}" />';
    }
        echo '<tr>
        
        <td>'.getinput($db['name']).'</td>
        <td style="width: 35%"><div class="imageHold">
    <div>'.$pic.'</div></div></td>';

        $db[ 'active' ] == 1 ? $active = '<font color="green"><b>' . $_language->module[ 'active_on' ] . '</b></font>' :
            $active = '<font color="red"><b>' . $_language->module[ 'active_off' ] . '</b></font>';

        $db[ 'active' ] == 1 ? $button = '' :
            $button = '<input type="hidden" name="captcha_hash" value="'.$hash.'" /><input type="hidden" name="themeID" value="'.$db['themeID'].'" />
    <button class="btn btn-success" type="submit" name="saveedit"  />'.$_language->module['edit_template'].'</button>';    
            

       echo'  
              <td>'.$active.'</td>
              <td style="width: 35%">';
    if ($db[ 'active' ] == '1') {
        $active = '<input id="activeactive" type="radio" name="radio1" value="active" checked="checked" />';
    } else {
        $active = '<input id="active" type="radio" name="radio1" value="active">';
    }

     echo'<form class="form-horizontal" method="post" action="admincenter.php?site=settings_templates" enctype="multipart/form-data">
      <div class="form-group row">
    <label class="col-md-3 control-label" for="active_on">'.$_language->module['active_on'].':</label>
    <div class="col-md-8">
  '.$active.'
</div>
</div>

<div class="form-group row">
    <div class="col-md-offset-2 col-md-10">'.$button.'
    
    </div>
  </div>

</form>
</td>
      </tr>';
  }
  
  echo '</table>';

echo '</div></div>';


?>