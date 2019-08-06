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




  echo'<div class="panel panel-default">
  <div class="panel-heading">
                            <i class="fas fa-puzzle-piece"></i> Themes
                        </div>
                        <div class="panel-body"><br>
';
  
  
    
          
  $row = safe_query("SELECT * FROM " . PREFIX . "settings_themes");
    $tmp = mysqli_fetch_assoc(safe_query("SELECT count(themeID) as cnt FROM " . PREFIX . "settings_themes"));
    $anzpartners = $tmp[ 'cnt' ];
    $CAPCLASS = new \webspell\Captcha;
    $CAPCLASS->createTransaction();
    $hash = $CAPCLASS->getHash();

   echo'   <table class="table table-striped">
    <thead>
      
      <th><b>'.$_language->module['id'].'</b></th>
      <th><b>'.$_language->module['template_name'].'</b></th>
      <th><b>'.$_language->module['active'].'</b></th>
      <th><b>banner</b></th>
      <th><b>'.$_language->module['actions'].'</b></th>
    </thead>';

   $i = 1;
    while ($db = mysqli_fetch_array($row)) {

   
if($db[ 'name' ] == '') {
      $pic = 'n/a';
    } else {
      $pic = '<img class="img-thumbnail" style="width: 100%; max-width: 230px; max-height: 230px;" align="center" src="../includes/themes/'.getinput($db['name']).'/images/'.getinput($db['name']).'.jpg" alt="{img}" />';
    }
        echo '<tr>
        <td>'.getinput($db['themeID']).'</td>
        <td>'.getinput($db['name']).'</td>
        
        
        ';

        $db[ 'active' ] == 1 ? $active = '<font color="green"><b>' . $_language->module[ 'active_on' ] . '</b></font>' :
            $active = '<font color="red"><b>' . $_language->module[ 'active_off' ] . '</b></font>';
            

       echo' 

      <td>'.$active.'</td>
      <td>'.$pic.'</td>
      <td>';
     
    
  
   
 

    if ($db[ 'active' ] == '1') {
        $active = '<input id="activeactive" type="radio" name="radio1" value="active" checked="checked" />';
    } else {
        $active = '<input id="active" type="radio" name="radio1" value="active">';
    }

    

    echo'
<form class="form-horizontal" method="post" action="admincenter.php?site=settings_templates" enctype="multipart/form-data">
      <div class="form-group">
    <label class="col-sm-2 control-label" for="active_on">'.$_language->module['active_on'].':</label>
    <div class="col-sm-8">
  '.$active.'
</div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
    <input type="hidden" name="captcha_hash" value="'.$hash.'" /><input type="hidden" name="themeID" value="'.$db['themeID'].'" />
    <button class="btn btn-success" type="submit" name="saveedit"  />'.$_language->module['edit_template'].'</button>
    </div>
  </div>

</form>
</td>
      </tr>';
  }
	
  echo '</table>';

echo '</div></div>';
?>