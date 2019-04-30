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

$_language->readModule('head_moduls', false, true);

if (!ispageadmin($userID) || mb_substr(basename($_SERVER[ 'REQUEST_URI' ]), 0, 15) != "admincenter.php") {
    die($_language->module[ 'access_denied' ]);
}

if (isset($_GET[ 'delete' ])) {
    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_GET[ 'captcha_hash' ])) {
        $modulID = (int)$_GET[ 'modulID' ];
        safe_query("DELETE FROM " . PREFIX . "settings_content_foot_moduls WHERE modulID='" . $modulID . "' ");
        
    } else {
        echo $_language->module[ 'transaction_invalid' ];
    }
} elseif (isset($_POST[ 'sortieren' ])) {
    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_POST[ 'captcha_hash' ])) {
        $sort = $_POST[ 'sort' ];
        foreach ($sort as $sortstring) {
            $sorter = explode("-", $sortstring);
            safe_query("UPDATE " . PREFIX . "settings_content_foot_moduls SET sort='".$sorter[1]."' WHERE modulID='".$sorter[0]."' ");
        }
    } else {
        echo $_language->module[ 'transaction_invalid' ];
    }
} elseif (isset($_POST[ 'save' ])) {
    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_POST[ 'captcha_hash' ])) {
        $module = $_POST[ 'module' ];
		
		
		if(@$_POST['radio1']=="activated") {
            $activated = 1;
            $deactivated = 0;
            } elseif(@$_POST['radio1']=="deactivated") {
            $activated = 0;
            $deactivated = 1;    
     
    } else {
        $activated = 0;
        $deactivated = 0;
    }
		
		    safe_query(
            "INSERT INTO
                `" . PREFIX . "settings_content_foot_moduls` (
                    `module`,
                    `activated`,
                    `deactivated`,
                    `sort`
                )
                VALUES (
                    '$module',
                    '" . $activated . "',
                    '" . $deactivated . "',
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
        $module = $_POST[ 'module' ];
        
      if(@$_POST['radio1']=="activated") {
        $activated = 1;
        $deactivated = 0;
    } elseif(@$_POST['radio1']=="deactivated") {
        $activated = 0;
        $deactivated = 1;          
     
    } else {
        $activated = 0;
        $deactivated = 0;
    }
        
    

        $modulID = (int)$_POST[ 'modulID' ];
        $id = $modulID;

        safe_query(
            "UPDATE
                `" . PREFIX . "settings_content_foot_moduls`
            SET
                `module` = '" . $module . "',
                `activated` = '" . $activated . "',
                `deactivated` = '" . $deactivated . "'
            WHERE
                `modulID` = '" . $modulID . "'"
        );

        
    } else {
        echo $_language->module[ 'transaction_invalid' ];
    }
}

$_language->readModule('head_moduls', false, true);

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
    <li role="presentation" class="active"><a href="./admincenter.php?site=settings_content_foot_moduls">Content Foot Module</a></li>
    <li role="presentation"><a href="./admincenter.php?site=settings_css">.css</a></li>
    <li role="presentation"><a href="./admincenter.php?site=settings_templates">Templates</a></li>
    <li role="presentation"><a href="./admincenter.php?site=settings_logo">Logo</a></li>
</ul>
<ol class="breadcrumb-primary"> </ol><br>
	&nbsp;&nbsp;<a href="admincenter.php?site=settings_content_foot_moduls" class="white">'.$_language->module['module'].'</a> &raquo; '.$_language->module['add_modul'].'<br><br>';

	echo'<form class="form-horizontal" method="post" action="admincenter.php?site=settings_content_foot_moduls" enctype="multipart/form-data">

     <div class="row">

<div class="col-md-12">

    <div class="form-group">
    <label class="col-sm-2 control-label">'.$_language->module['modul_name'].':</label>
    <div class="col-sm-8"><span class="text-muted small"><em>
      <input type="text" class="form-control" name="module" size="60" /></em></span>
    </div>
  </div>

<div class="form-group">
<label class="col-sm-2 control-label"></label>


<div class="col-sm-2">
    <label for="activated">'.$_language->module['activated'].'</label>
  <input id="activated" type="radio" name="radio1" value="deactivated">
<img class="img-thumbnail" src="../images/plugins/layout-foot-content.jpg">
</div>
<div class="col-sm-2">
    <label for="activated">'.$_language->module['deactivated'].'</label>
  <input id="deactivated" type="radio" name="radio1" value="activated">
<img class="img-thumbnail" src="../images/plugins/layout-foot-content-ohne.jpg">
</div>
<label class="col-sm-2 control-label"></label>
</div>
   

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
		<input type="hidden" name="captcha_hash" value="'.$hash.'" />
		<button class="btn btn-success" type="submit" name="save"  />'.$_language->module['add_modul'].'</button>
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
    <li role="presentation"><a href="./admincenter.php?site=settings">Setting</a></li>    
    <li role="presentation"><a href="./admincenter.php?site=settings_styles">Style</a></li>
    <li role="presentation"><a href="./admincenter.php?site=settings_buttons">Buttons</a></li>
    <li role="presentation"><a href="./admincenter.php?site=settings_moduls">Module</a></li>
    <li role="presentation"><a href="./admincenter.php?site=settings_head_moduls">Page Head Module</a></li>
    <li role="presentation"><a href="./admincenter.php?site=settings_content_head_moduls">Content Head Module</a></li>
    <li role="presentation" class="active"><a href="./admincenter.php?site=settings_content_foot_moduls">Content Foot Module</a></li>
    <li role="presentation"><a href="./admincenter.php?site=settings_css">.css</a></li>
    <li role="presentation"><a href="./admincenter.php?site=settings_templates">Templates</a></li>
    <li role="presentation"><a href="./admincenter.php?site=settings_logo">Logo</a></li>
</ul>
<ol class="breadcrumb-primary"> </ol><br>
  &nbsp;&nbsp;<a href="admincenter.php?site=settings_content_foot_moduls" class="white">'.$_language->module['module'].'</a> &raquo; '.$_language->module['edit_modul'].'<br><br>';
  
  $modulID = $_GET[ 'modulID' ];
    $ergebnis = safe_query("SELECT * FROM " . PREFIX . "settings_content_foot_moduls WHERE modulID='$modulID'");
    $ds = mysqli_fetch_array($ergebnis);

    if ($ds[ 'activated' ] == '1') {
        $activated = '<input id="activated" type="radio" name="radio1" value="activated" checked="checked" />';
    } else {
        $activated = '<input id="activated" type="radio" name="radio1" value="activated">';
    }

    if ($ds[ 'deactivated' ] == '1') {
        $deactivated = '<input id="deactivated" type="radio" name="radio1" value="deactivated" checked="checked" />';
    } else {
        $deactivated = '<input id="deactivated" type="radio" name="radio1" value="deactivated">';
    }

    echo'<form class="form-horizontal" method="post" action="admincenter.php?site=settings_content_foot_moduls" enctype="multipart/form-data">

     
<div class="row">

<div class="col-md-12">

    
    <div class="form-group">
    <label class="col-sm-2 control-label">'.$_language->module['modul_name'].':</label>
    <div class="col-sm-8"><span class="text-muted small"><em>
      <input type="text" class="form-control" name="module" value="'.getinput($ds['module']).'" /></em></span>
    </div>
  </div>

    <div class="form-group">
<div class="col-sm-2"></div>

<div class="col-sm-2">
     <label for="activated">'.$_language->module['activated'].'</label>
  '.$deactivated.'
<img class="img-thumbnail" src="../images/plugins/layout-foot-content.jpg">
</div>

<div class="col-sm-2">
     <label for="deactivated">'.$_language->module['deactivated'].'</label>
  '.$activated.'
<img class="img-thumbnail" src="../images/plugins/layout-foot-content-ohne.jpg">
</div>
<div class="col-sm-2"></div>

</div>

  
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
		<input type="hidden" name="captcha_hash" value="'.$hash.'" /><input type="hidden" name="modulID" value="'.$modulID.'" />
		<button class="btn btn-primary" type="submit" name="saveedit"  />'.$_language->module['edit_modul'].'</button>
    </div>
  </div>

  </div>
  </div>

  </form></div>
  </div>';
}

else {
	
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
    <li role="presentation" class="active"><a href="./admincenter.php?site=settings_content_foot_moduls">Content Foot Module</a></li>
    <li role="presentation"><a href="./admincenter.php?site=settings_css">.css</a></li>
    <li role="presentation"><a href="./admincenter.php?site=settings_templates">Templates</a></li>
    <li role="presentation"><a href="./admincenter.php?site=settings_logo">Logo</a></li>
</ul>
<ol class="breadcrumb-primary"> </ol><br>
';
  
  echo'<a href="admincenter.php?site=settings_content_foot_moduls&amp;action=add" class="btn btn-primary" type="button">' . $_language->module[ 'new_modul' ] . '</a><br /><br />';

	echo'<form method="post" action="admincenter.php?site=settings_content_foot_moduls">
  <table class="table table-striped">
    <thead>
      <th><b>'.$_language->module['module'].'</b></th>
      <th class="hidden-sm hidden-xs"><img style="width: 250px;" class="img-thumbnail" src="../images/plugins/layout-foot-content.jpg"><br><b>'.$_language->module['activated'].'</b></th>
      
      <th class="hidden-sm hidden-xs"><img style="width: 250px;" class="img-thumbnail" src="../images/plugins/layout-foot-content-ohne.jpg"><br><b>'.$_language->module['deactivated'].'</b></th>
      <th><b>'.$_language->module['actions'].'</b></th>
      <th><b>'.$_language->module['sort'].'</b></th>
    </thead>';

	$moduls = safe_query("SELECT * FROM " . PREFIX . "settings_content_foot_moduls ORDER BY sort");
    $tmp = mysqli_fetch_assoc(safe_query("SELECT count(modulID) as cnt FROM " . PREFIX . "settings_content_foot_moduls"));
    $anzmoduls = $tmp[ 'cnt' ];
    $CAPCLASS = new \webspell\Captcha;
    $CAPCLASS->createTransaction();
    $hash = $CAPCLASS->getHash();

    $CAPCLASS->createTransaction();
    $hash_2 = $CAPCLASS->getHash();

    $i = 1;
    while ($db = mysqli_fetch_array($moduls)) {
        if ($i % 2) {
            $td = 'td1';
        } else {
            $td = 'td2';
        }

        $db[ 'activated' ] == 1 ? $activated = '<font color="green"><b>' . $_language->module[ 'yes' ] . '</b></font>' :
            $activated = '<font color="red"><b>' . $_language->module[ 'no' ] . '</b></font>';        
        $db[ 'deactivated' ] == 1 ? $deactivated = '<font color="green"><b>' . $_language->module[ 'yes' ] . '</b></font>' :
            $deactivated = '<font color="red"><b>' . $_language->module[ 'no' ] . '</b></font>';

        

        echo '<tr>
      <td>'.getinput($db['module']).'</td>
      <td>'.$deactivated.'</td>
      <td>'.$activated.'</td>
      
      <td><a href="admincenter.php?site=settings_content_foot_moduls&amp;action=edit&amp;modulID='.$db['modulID'].'" class="hidden-xs hidden-sm btn btn-warning" type="button">' . $_language->module[ 'edit' ] . '</a>

        <input class="hidden-xs hidden-sm btn btn-danger" type="button" onclick="MM_confirm(\'' . $_language->module['really_delete'] . '\', \'admincenter.php?site=settings_content_foot_moduls&amp;delete=true&amp;modulID='.$db['modulID'].'&amp;captcha_hash='.$hash.'\')" value="' . $_language->module['delete'] . '" />

	  <a href="admincenter.php?site=settings_content_foot_moduls&amp;action=edit&amp;modulID='.$db['modulID'].'"  class="mobile visible-xs visible-sm" type="button"><i class="fa fa-pencil"></i></a>
      <a class="mobile visible-xs visible-sm" type="button" onclick="MM_confirm(\'' . $_language->module['really_delete'] . '\', \'admincenter.php?site=settings_content_foot_moduls&amp;delete=true&amp;modulID='.$db['modulID'].'&amp;captcha_hash='.$hash.'\')" /><i class="fa fa-times"></i></a>


      </td>
      <td>
      <select name="sort[]">';

        for ($j = 1; $j <= $anzmoduls; $j++) {
            if ($db[ 'sort' ] == $j) {
                echo '<option value="' . $db[ 'modulID' ] . '-' . $j . '" selected="selected">' . $j . '</option>';
            } else {
                echo '<option value="' . $db[ 'modulID' ] . '-' . $j . '">' . $j . '</option>';
            }
        }

        echo '</select>
      </td>
    </tr>';
    $i++;
         
	}
	echo'<tr class="td_head">
      <td colspan="6" align="right"><input type="hidden" name="captcha_hash" value="'.$hash_2.'" /><button class="btn btn-primary" type="submit" name="sortieren" />'.$_language->module['to_sort'].'</button></td>
    </tr>
  </table>
  </form>';
}
echo '</div></div>';
?>