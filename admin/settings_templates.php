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

if (isset($_GET[ 'delete' ])) {
    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_GET[ 'captcha_hash' ])) {
        $themeID = (int)$_GET[ 'themeID' ];
        safe_query("DELETE FROM " . PREFIX . "settings_themes WHERE themeID='" . $themeID . "' ");
        
    } else {
        echo $_language->module[ 'transaction_invalid' ];
    }
} elseif (isset($_POST[ 'sortieren' ])) {
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

} elseif (isset($_POST[ 'save' ])) {
    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_POST[ 'captcha_hash' ])) {
      
        $name = $_POST[ 'name' ];
        
    
    if(@$_POST['radio1']=="active") {
        $active = 1;
    } else {
        $active = 0;
    }
    
    if($active == '1') {
      $sql = safe_query("SELECT `themeID` FROM `".PREFIX."settings_themes` WHERE `active` = 1 LIMIT 1");
      safe_query("UPDATE `".PREFIX."settings_themes` SET active = 0 WHERE `themeID` = themeID");
    }
        
        safe_query(
            "INSERT INTO
                `" . PREFIX . "settings_themes` (
                    `name`,
                    `active`,
                    `sort`
                )
                VALUES (
                    '$name',
                    '" . $active . "',
                    '1'
                )"
        );



        $id = mysqli_insert_id($_database);

        
    } else {
        echo  $_language->module[ 'transaction_invalid' ];
    }
} elseif (isset($_POST[ 'saveedit' ])) {
    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_POST[ 'captcha_hash' ])) {
        $name = $_POST[ 'name' ];
        
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
                `name` = '" . $name . "',
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

if ($action == "add") {
    $CAPCLASS = new \webspell\Captcha;
    $CAPCLASS->createTransaction();
    $hash = $CAPCLASS->getHash();
  
echo'<div class="card">
        <div class="card-header">
            <i class="fas fa-puzzle-piece"></i> '.$_language->module['template'].'
        </div>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="admincenter.php?site=settings_templates">'.$_language->module['template'].'</a></li>
    <li class="breadcrumb-item active" aria-current="page">'.$_language->module['new_template'].'</li>
  </ol>
</nav>
<div class="card-body">';

echo'<form class="form-horizontal" method="post" action="admincenter.php?site=settings_templates" enctype="multipart/form-data">

     <div class="row">

<div class="col-md-12">

    <div class="form-group">
    <label class="col-sm-2 control-label">'.$_language->module['template_name'].':</label>
    <div class="col-sm-8"><span class="text-muted small"><em>
      <input type="text" class="form-control" name="name" size="60" /></em></span>
    </div>
  </div>
  
<div class="form-group">
    <label class="col-sm-2 control-label" for="active_on">'.$_language->module['active_on'].':</label>
    <div class="col-sm-8">
  <input id="active" type="radio" name="radio1" value="active">
</div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
    <input type="hidden" name="captcha_hash" value="'.$hash.'" />
    <button class="btn btn-success" type="submit" name="save"  />'.$_language->module['add_template'].'</button>
    <br><br>
    </div>
  </div>

</div>
  </div>

  </form></div>
  </div>';
} elseif ($action == "edit") {
    $CAPCLASS = new \webspell\Captcha;
    $CAPCLASS->createTransaction();
    $hash = $CAPCLASS->getHash();
  
echo'<div class="card">
        <div class="card-header">
            <i class="fas fa-puzzle-piece"></i> '.$_language->module['template'].'
        </div>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="admincenter.php?site=settings_templates">'.$_language->module['template'].'</a></li>
    <li class="breadcrumb-item active" aria-current="page">'.$_language->module['edit_template'].'</li>
  </ol>
</nav>
<div class="card-body">';

$themeID = $_GET[ 'themeID' ];
    $ergebnis = safe_query("SELECT * FROM " . PREFIX . "settings_themes WHERE themeID='$themeID'");
    $ds = mysqli_fetch_array($ergebnis);

    if ($ds[ 'active' ] == '1') {
        $active = '<input id="activeactive" type="radio" name="radio1" value="active" checked="checked" />';
    } else {
        $active = '<input id="active" type="radio" name="radio1" value="active">';
    }

echo'<form class="form-horizontal" method="post" action="admincenter.php?site=settings_templates" enctype="multipart/form-data">

<div class="row">
<div class="col-md-12">
<div class="form-group">
    <label class="col-sm-2 control-label">'.$_language->module['template_name'].':</label>
    <div class="col-sm-8"><span class="text-muted small"><em>
      <input type="text" class="form-control" name="name" value="'.getinput($ds['name']).'" /></em></span>
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label" for="active_on">'.$_language->module['active_on'].':</label>
    <div class="col-sm-8">
  '.$active.'
</div>
</div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
    <input type="hidden" name="captcha_hash" value="'.$hash.'" /><input type="hidden" name="themeID" value="'.$themeID.'" />
    <button class="btn btn-success" type="submit" name="saveedit"  />'.$_language->module['edit_template'].'</button>
    </div>
  </div>

  </div>
  </div>

  </form></div>
  </div>';
} else {

if (isset($_POST[ 'addedit' ])) {
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
            <i class="fas fa-tasks"></i> '.$_language->module['template'].'
        </div>
<div class="card-body">

<div class="form-group row">
    <label class="col-md-1 control-label">' . $_language->module['options'] . ':</label>
    <div class="col-md-8">
      <a href="admincenter.php?site=settings_templates&amp;action=add" class="btn btn-primary" type="button">' . $_language->module[ 'new_template' ] . '</a>
    </div>
  </div>';


    $row = safe_query("SELECT * FROM " . PREFIX . "settings_themes");
    $tmp = mysqli_fetch_assoc(safe_query("SELECT count(themeID) as cnt FROM " . PREFIX . "settings_themes"));
    $anzpartners = $tmp[ 'cnt' ];
    $CAPCLASS = new \webspell\Captcha;
    $CAPCLASS->createTransaction();
    $hash = $CAPCLASS->getHash();

   echo'<table class="table table-striped">
    <thead>
      <th style="width: 10%">'.$_language->module['template_name'].'</th>
      <th style="width: 45%">'.$_language->module['banner'].'</th>
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
    <button class="btn btn-success" type="submit" name="addedit"  />'.$_language->module['edit_template'].'</button>';    
            

       echo'  
              <td>'.$active.'</td>
              <td>';
    if ($db[ 'active' ] == '1') {
        $active = '<input id="activeactive" type="radio" name="radio1" value="active" checked="checked" />';
    } else {
        $active = '<input id="active" type="radio" name="radio1" value="active">';
    }

     echo'<form class="form-horizontal" method="post" action="admincenter.php?site=settings_templates" enctype="multipart/form-data">
      <div class="form-group row">
    <label class="col-md-2 control-label" for="active_on">'.$_language->module['active_on'].':</label>
    <div class="col-md-8">
  '.$active.'
</div>
</div>

<div class="form-group row">
    <div class="col-md-6">'.$button.'
    
    </div>

    <div class="col-md-6">
    <a href="admincenter.php?site=settings_templates&amp;action=edit&amp;themeID='.$db['themeID'].'" class="btn btn-warning" type="button">' . $_language->module[ 'edit' ] . '</a>

        <input class="btn btn-danger" type="button" onclick="MM_confirm(\''.$_language->module['really_delete'].'\', \'admincenter.php?site=settings_templates&amp;delete=true&amp;themeID='.$db['themeID'].'&amp;captcha_hash='.$hash.'\')" value="'.$_language->module['delete'].'" />
</div>

  </div>

</form>
</td>
      </tr>';
  }
  
  echo '</table>';

echo '</div></div>';

}
?>