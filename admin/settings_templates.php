<?php
/*
##########################################################################
#                                                                        #
#           Version 4       /                        /   /               #
#          -----------__---/__---__------__----__---/---/-               #
#           | /| /  /___) /   ) (_ `   /   ) /___) /   /                 #
#          _|/_|/__(___ _(___/_(__)___/___/_(___ _/___/___               #
#                       Free Content / Management System                 #
#                                   /                                    #
#                                                                        #
#                                                                        #
#   Copyright 2005-2015 by webspell.org                                  #
#                                                                        #
#   visit webSPELL.org, webspell.info to get webSPELL for free           #
#   - Script runs under the GNU GENERAL PUBLIC LICENSE                   #
#   - It's NOT allowed to remove this copyright-tag                      #
#   -- http://www.fsf.org/licensing/licenses/gpl.html                    #
#                                                                        #
#   Code based on WebSPELL Clanpackage (Michael Gruber - webspell.at),   #
#   Far Development by Development Team - webspell.org                   #
#                                                                        #
#   visit webspell.org                                                   #
#                                                                        #
##########################################################################
*/

$_language->readModule('templates', false, true);

if (!ispageadmin($userID) || mb_substr(basename($_SERVER[ 'REQUEST_URI' ]), 0, 15) != "admincenter.php") {
    die($_language->module[ 'access_denied' ]);
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
        $deactive = 0;
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
  
  echo'<div class="panel panel-default">
  <div class="panel-heading">
                            <i class="fa fa-thumbs-up"></i> Setting
                        </div>
                        <div class="panel-body">
                        
  <ul class="nav nav-tabs-primary">
    <li role="presentation"><a href="./admincenter.php?site=settings">Setting</a></li>    
    <li role="presentation"><a href="./admincenter.php?site=settings_styles">Style</a></li>
    <li role="presentation"><a href="./admincenter.php?site=settings_buttons">Buttons</a></li>
    <li role="presentation"><a href="./admincenter.php?site=settings_moduls">Module</a></li>
    <li role="presentation"><a href="./admincenter.php?site=settings_head_moduls">Page Head Module</a></li>
    <li role="presentation"><a href="./admincenter.php?site=settings_content_head_moduls">Content Head Module</a></li>
    <li role="presentation"><a href="./admincenter.php?site=settings_content_foot_moduls">Content Foot Module</a></li>
    <li role="presentation"><a href="./admincenter.php?site=settings_css">.css</a></li>
    <li role="presentation" class="active"><a href="./admincenter.php?site=settings_templates">Templates</a></li>
</ul>
<ol class="breadcrumb-primary"> </ol><br>
  &nbsp;&nbsp;<a href="admincenter.php?site=settings_templates" class="white">'.$_language->module['template'].'</a> &raquo; '.$_language->module['new_template'].'<br><br>';

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
  
  echo'<div class="panel panel-default">
  <div class="panel-heading">
                            <i class="fa fa-thumbs-up"></i> Setting
                        </div>
                        <div class="panel-body">
                        
  <ul class="nav nav-tabs-primary">
    <li role="presentation"><a href="./admincenter.php?site=settings_settings">Setting</a></li>    
    <li role="presentation"><a href="./admincenter.php?site=settings_styles">Style</a></li>
    <li role="presentation"><a href="./admincenter.php?site=settings_buttons">Buttons</a></li>
    <li role="presentation"><a href="./admincenter.php?site=settings_moduls">Module</a></li>
    <li role="presentation"><a href="./admincenter.php?site=settings_head_moduls">Page Head Module</a></li>
    <li role="presentation"><a href="./admincenter.php?site=settings_content_head_moduls">Content Head Module</a></li>
    <li role="presentation"><a href="./admincenter.php?site=settings_content_foot_moduls">Content Foot Module</a></li>
    <li role="presentation"><a href="./admincenter.php?site=settings_css">.css</a></li>
    <li role="presentation" class="active"><a href="./admincenter.php?site=settings_templates">Templates</a></li>
</ul>
<ol class="breadcrumb-primary"> </ol><br>
  &nbsp;&nbsp;<a href="admincenter.php?site=settings_templates" class="white">'.$_language->module['template'].'</a> &raquo; '.$_language->module['edit_template'].'<br><br>';
  
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

  echo'<div class="panel panel-default">
  <div class="panel-heading">
                            <i class="fa fa-thumbs-up"></i> Setting
                        </div>
                        <div class="panel-body">
                        
  <ul class="nav nav-tabs-primary">
    <li role="presentation"><a href="./admincenter.php?site=settings">Setting</a></li>   
    <li role="presentation"><a href="./admincenter.php?site=settings_styles">Style</a></li>
    <li role="presentation"><a href="./admincenter.php?site=settings_buttons">Buttons</a></li>
    <li role="presentation"><a href="./admincenter.php?site=settings_moduls">Module</a></li>
    <li role="presentation"><a href="./admincenter.php?site=settings_head_moduls">Page Head Module</a></li>
    <li role="presentation"><a href="./admincenter.php?site=settings_content_head_moduls">Content Head Module</a></li>
    <li role="presentation"><a href="./admincenter.php?site=settings_content_foot_moduls">Content Foot Module</a></li>
    <li role="presentation"><a href="./admincenter.php?site=settings_css">.css</a></li>
    <li role="presentation" class="active"><a href="./admincenter.php?site=settings_templates">Templates</a></li>
</ul>
<ol class="breadcrumb-primary"> </ol><br>
';
  
  
    
          
  $row = safe_query("SELECT * FROM " . PREFIX . "settings_themes");
    $tmp = mysqli_fetch_assoc(safe_query("SELECT count(themeID) as cnt FROM " . PREFIX . "settings_themes"));
    $anzpartners = $tmp[ 'cnt' ];
    $CAPCLASS = new \webspell\Captcha;
    $CAPCLASS->createTransaction();
    $hash = $CAPCLASS->getHash();

   
  
    echo'<a href="admincenter.php?site=settings_templates&amp;action=add" class="btn btn-primary" type="button">' . $_language->module[ 'new_template' ] . '</a><br><br>';


  

     echo'   <table class="table table-striped">
    <thead>
      
      <th><b>'.$_language->module['id'].'</b></th>
      <th><b>'.$_language->module['template_name'].'</b></th>
      <th><b>'.$_language->module['active'].'</b></th>
      <th><b>'.$_language->module['actions'].'</b></th>
    </thead>';

   $i = 1;
    while ($db = mysqli_fetch_array($row)) {
            
            

        echo '<tr>
        <td>'.getinput($db['themeID']).'</td>
        <td>'.getinput($db['name']).'</td>
        
        
        ';

        $db[ 'active' ] == 1 ? $active = '<font color="green"><b>' . $_language->module[ 'active_on' ] . '</b></font>' :
            $active = '<font color="red"><b>' . $_language->module[ 'active_off' ] . '</b></font>';
            

       echo' 

      <td>'.$active.'</td>
         <td><a href="admincenter.php?site=settings_templates&amp;action=edit&amp;themeID='.$db['themeID'].'" class="hidden-xs hidden-sm btn btn-warning" type="button">' . $_language->module[ 'edit' ] . '</a>

        <input class="hidden-xs hidden-sm btn btn-danger" type="button" onclick="MM_confirm(\''.$_language->module['really_delete'].'\', \'admincenter.php?site=settings_templates&amp;delete=true&amp;themeID='.$db['themeID'].'&amp;captcha_hash='.$hash.'\')" value="'.$_language->module['delete'].'" />
		
        <a href="admincenter.php?site=settings_templates&amp;action=edit&amp;themeID='.$db['themeID'].'"  class="mobile visible-xs visible-sm" type="button"><i class="fa fa-pencil"></i></a>
        <a class="mobile visible-xs visible-sm" type="button" onclick="MM_confirm(\''.$_language->module['really_delete'].'\', \'admincenter.php?site=settings_templates&amp;delete=true&amp;themeID='.$db['themeID'].'&amp;captcha_hash='.$hash.'\')" value="'.$_language->module['delete'].'" /><i class="fa fa-times"></i></a></td>
      </tr>';
  }
	
  echo '</table>';
}
echo '</div></div>';
?>