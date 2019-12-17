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
$_language->readModule('moduls', false, true);

$ergebnis = safe_query("SELECT * FROM ".PREFIX."navigation_dashboard_links WHERE modulname='moduls'");
    while ($db=mysqli_fetch_array($ergebnis)) {
      $accesslevel = 'is'.$db['accesslevel'].'admin';

if (!$accesslevel($userID) || mb_substr(basename($_SERVER[ 'REQUEST_URI' ]), 0, 15) != "admincenter.php") {
    die($_language->module[ 'access_denied' ]);
}
}

if (isset($_GET[ 'delete' ])) {
    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_GET[ 'captcha_hash' ])) {
        $modulID = (int)$_GET[ 'modulID' ];
        safe_query("DELETE FROM " . PREFIX . "settings_moduls WHERE modulID='" . $modulID . "' ");
        
    } else {
        echo $_language->module[ 'transaction_invalid' ];
    }
} elseif (isset($_POST[ 'sortieren' ])) {
    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_POST[ 'captcha_hash' ])) {
        $sort = $_POST[ 'sort' ];
        foreach ($sort as $sortstring) {
            $sorter = explode("-", $sortstring);
            safe_query("UPDATE " . PREFIX . "settings_moduls SET sort='".$sorter[1]."' WHERE modulID='".$sorter[0]."' ");
        }
    } else {
        echo $_language->module[ 'transaction_invalid' ];
    }
} elseif (isset($_POST[ 'save' ])) {
    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_POST[ 'captcha_hash' ])) {
        $module = $_POST[ 'module' ];

    if(@$_POST['radio1']=="le_activated") {
        $le_activated = 1;
        $re_activated = 0;
        $activated = 0;
        $deactivated = 0;
    } elseif(@$_POST['radio1']=="re_activated") {
        $le_activated = 0;
        $re_activated = 1;
        $activated = 0;
        $deactivated = 0;
    } elseif(@$_POST['radio1']=="activated") {
        $le_activated = 0;
        $re_activated = 0;
        $activated = 1;
        $deactivated = 0;
    } elseif(@$_POST['radio1']=="deactivated") {
        $le_activated = 0;
        $re_activated = 0;
        $activated = 0;
        $deactivated = 1;          
     
    } else {
        $le_activated = 0;
        $re_activated = 0;
        $activated = 0;
        $deactivated = 0;
    }

    if (isset($_POST["head_activated"])) {
        $head_activated = 1;
    } else {
        $head_activated = 0;
    }
        
    if (isset($_POST["content_head_activated"])) {
        $content_head_activated = 1;
    } else {
        $content_head_activated = 0;
    }

    if (isset($_POST["content_foot_activated"])) {
        $content_foot_activated = 1;
    } else {
        $content_foot_activated = 0;
    }    
		
		
		
		
		
        
        safe_query(
            "INSERT INTO
                `" . PREFIX . "settings_moduls` (
                    `module`,
                    `le_activated`,
                    `re_activated`,
                    `activated`,
                    `deactivated`,
                    `head_activated`,
                    `content_head_activated`,
                    `content_foot_activated`,
                    `sort`
                )
                VALUES (
                    '$module',
                    '" . $le_activated . "',
                    '" . $re_activated . "',
                    '" . $activated . "',
                    '" . $deactivated . "',
                    '" . $head_activated . "',
                    '" . $content_head_activated . "',
                    '" . $content_foot_activated . "',
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
        
      if(@$_POST['radio1']=="le_activated") {
        $le_activated = 1;
        $re_activated = 0;
        $activated = 0;
        $deactivated = 0;
    } elseif(@$_POST['radio1']=="re_activated") {
        $le_activated = 0;
        $re_activated = 1;
        $activated = 0;
        $deactivated = 0;
    } elseif(@$_POST['radio1']=="activated") {
        $le_activated = 0;
        $re_activated = 0;
        $activated = 1;
        $deactivated = 0;
    } elseif(@$_POST['radio1']=="deactivated") {
        $le_activated = 0;
        $re_activated = 0;
        $activated = 0;
        $deactivated = 1;          
     
    } else {
        $le_activated = 0;
        $re_activated = 0;
        $activated = 0;
        $deactivated = 0;
    }

    if (isset($_POST["head_activated"])) {
        $head_activated = 1;
    } else {
        $head_activated = 0;
    }
        
    if (isset($_POST["content_head_activated"])) {
        $content_head_activated = 1;
    } else {
        $content_head_activated = 0;
    }

    if (isset($_POST["content_foot_activated"])) {
        $content_foot_activated = 1;
    } else {
        $content_foot_activated = 0;
    }

    

        $modulID = (int)$_POST[ 'modulID' ];
        $id = $modulID;

        safe_query(
            "UPDATE
                `" . PREFIX . "settings_moduls`
            SET
                `module` = '" . $module . "',
                `le_activated` = '" . $le_activated . "',
                `re_activated` = '" . $re_activated . "',
                `activated` = '" . $activated . "',
                `deactivated` = '" . $deactivated . "',
                `head_activated` = '" . $head_activated . "',
                `content_head_activated` = '" . $content_head_activated . "',
                `content_foot_activated` = '" . $content_foot_activated . "'
            WHERE
                `modulID` = '" . $modulID . "'"
        );

        
    } else {
        echo $_language->module[ 'transaction_invalid' ];
    }
}

$_language->readModule('moduls', false, true);

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
            <i class="fas fa-tasks"></i> '.$_language->module['module'].'
        </div>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="admincenter.php?site=settings_moduls">'.$_language->module['module'].'</a></li>
    <li class="breadcrumb-item active" aria-current="page">'.$_language->module['add_modul'].'</li>
  </ol>
</nav>
<div class="card-body">';

	echo'<form class="form-horizontal" method="post" action="admincenter.php?site=settings_moduls" enctype="multipart/form-data">

     <div class="row">

<div class="col-md-12">

    <div class="form-group row">
    <label class="col-sm-2 control-label">'.$_language->module['modul_name'].':</label>
    <div class="col-sm-8"><span class="text-muted small"><em>
      <input type="text" class="form-control" name="module" size="60" /></em></span>
    </div>
  </div>

  <br>

<div class="form-group row">
    <label class="col-sm-2 control-label">'.$_language->module[ 'description' ] . ':</label>
    <div class="col-sm-8">'.$_language->module['info'].'
   </div>
  </div>

    <div class="form-group row">
<div class="col-sm-12">

    <p class="lead" style="text-align: center;">'.$_language->module['left_right_page'].' :</p>
    </div>
<div class="col-sm-2"></div>

<div class="col-sm-2">
    <label for="activated">'.$_language->module['all_deactivated'].'</label>
  <input id="deactivated" type="radio" name="radio1" value="activated">
<img class="img-thumbnail" src="../images/plugins/no_left_right_side_widget.jpg">
</div>
<div class="col-sm-2">
    <label for="le_activated">'.$_language->module['left_is_activated'].'</label>
  <input id="le_activated" type="radio" name="radio1" value="le_activated">
<img class="img-thumbnail" src="../images/plugins/left_side_widget.jpg">
</div>
<div class="col-sm-2">
    <label for="re_activated">'.$_language->module['right_is_activated'].'</label>
  <input id="re_activated" type="radio" name="radio1" value="re_activated">
<img class="img-thumbnail" src="../images/plugins/right_side_widget.jpg">
</div>
<div class="col-sm-2">
    <label for="activated">'.$_language->module['all_activated'].'</label>
  <input id="activated" type="radio" name="radio1" value="deactivated">
<img class="img-thumbnail" src="../images/plugins/left_right_side_widget.jpg">
</div>











<div class="col-sm-2"></div>

</div>

<div class="form-group row">
<div class="col-sm-3"></div>

<div class="col-sm-2">
<p class="lead">'.$_language->module['page_head'].' :</p>
 <label for="deactivated">'.$_language->module['activated'].'</label>
 <input type="checkbox" name="head_activated" value="1" checked="checked" />
<img class="img-thumbnail" src="../images/plugins/page_head_widget.jpg">
</div>

<div class="col-sm-2">
<p class="lead">'.$_language->module['content_head'].' :</p>
<label for="deactivated">'.$_language->module['activated'].'</label>
<input type="checkbox" name="content_head_activated" value="1" checked="checked" />
<img class="img-thumbnail" src="../images/plugins/center_head_widget.jpg">
</div>

<div class="col-sm-2">
<p class="lead">'.$_language->module['content_foot'].' :</p>
<label for="deactivated">'.$_language->module['activated'].'</label>
<input type="checkbox" name="content_foot_activated" value="1" checked="checked" />
<img class="img-thumbnail" src="../images/plugins/center_footer_widget.jpg">
</div>

<div class="col-sm-3"></div>

</div>







   

  <div class="form-group row">
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
  
  echo'<div class="card">
        <div class="card-header">
            <i class="fas fa-tasks"></i> '.$_language->module['module'].'
        </div>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="admincenter.php?site=settings_moduls">'.$_language->module['module'].'</a></li>
    <li class="breadcrumb-item active" aria-current="page">'.$_language->module['edit_modul'].'</li>
  </ol>
</nav>
<div class="card-body">';
  
  $modulID = $_GET[ 'modulID' ];
    $ergebnis = safe_query("SELECT * FROM " . PREFIX . "settings_moduls WHERE modulID='$modulID'");
    $ds = mysqli_fetch_array($ergebnis);

    if ($ds[ 'le_activated' ] == '1') {
        $le_activated = '<input id="le_activated" type="radio" name="radio1" value="le_activated" checked="checked" />';
    } else {
        $le_activated = '<input id="le_activated" type="radio" name="radio1" value="le_activated">';
    }

    if ($ds[ 're_activated' ] == '1') {
        $re_activated = '<input id="re_activated" type="radio" name="radio1" value="re_activated" checked="checked" />';
    } else {
        $re_activated = '<input id="re_activated" type="radio" name="radio1" value="re_activated">';
    }

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

    




    if ($ds[ 'head_activated' ] == '1') {
        $head_activated = '<input type="checkbox" name="head_activated" value="1" checked="checked">';
    } else {
        $head_activated = '<input type="checkbox" name="head_activated" value="1">';
    }

    


    if ($ds['content_head_activated'] == '1') {
        $content_head_activated = '<input type="checkbox" name="content_head_activated" value="1" checked="checked">';
    } else {
        $content_head_activated = '<input type="checkbox" name="content_head_activated" value="1">';
    }

    
    if ($ds['content_foot_activated'] == '1') {
        $content_foot_activated = '<input type="checkbox" name="content_foot_activated" value="1" checked="checked">';
    } else {
        $content_foot_activated = '<input type="checkbox" name="content_foot_activated" value="1">';
    }

    echo'<form class="form-horizontal" method="post" action="admincenter.php?site=settings_moduls" enctype="multipart/form-data">

     
<div class="row">

<div class="col-md-12">

    
    <div class="form-group row">
    <label class="col-sm-2 control-label">'.$_language->module['modul_name'].':</label>
    <div class="col-sm-8"><span class="text-muted small"><em>
      <input type="text" class="form-control" name="module" value="'.getinput($ds['module']).'" /></em></span>
    </div>
  </div>
<br>

<div class="form-group row">
    <label class="col-sm-2 control-label">'.$_language->module[ 'description' ] . ':</label>
    <div class="col-sm-8">'.$_language->module['info'].'
   </div>
  </div>

    <div class="form-group row">
<div class="col-sm-12">

    <p class="lead" style="text-align: center;">'.$_language->module['left_right_page'].' :</p>
    </div>
<div class="col-sm-2"></div>

<div class="col-sm-2">

     <label for="activated">'.$_language->module['all_deactivated'].'</label>
  '.$activated.'
<img class="img-thumbnail" src="../images/plugins/no_left_right_side_widget.jpg">
</div>
<div class="col-sm-2">
    <label for="le_activated">'.$_language->module['left_is_activated'].'</label>
  '.$le_activated.'
<img class="img-thumbnail" src="../images/plugins/left_side_widget.jpg">
</div>

<div class="col-sm-2">
    <label for="re_activated">'.$_language->module['right_is_activated'].'</label>
  '.$re_activated.'
<img class="img-thumbnail" src="../images/plugins/right_side_widget.jpg">
</div>



<div class="col-sm-2">
     <label for="deactivated">'.$_language->module['all_activated'].'</label>
  '.$deactivated.'
<img class="img-thumbnail" src="../images/plugins/left_right_side_widget.jpg">
</div>

<div class="col-sm-2"></div>

</div>

<div class="form-group row">
<div class="col-sm-3"></div>

<div class="col-sm-2">
<p class="lead">'.$_language->module['page_head'].' :</p>
 <label for="deactivated">'.$_language->module['activated'].'</label>
'.$head_activated.'
<img class="img-thumbnail" src="../images/plugins/page_head_widget.jpg">
</div>

<div class="col-sm-2">
<p class="lead">'.$_language->module['content_head'].' :</p>
<label for="deactivated">'.$_language->module['activated'].'</label>
'.$content_head_activated.'
<img class="img-thumbnail" src="../images/plugins/center_head_widget.jpg">
</div>

<div class="col-sm-2">
<p class="lead">'.$_language->module['content_foot'].' :</p>
<label for="deactivated">'.$_language->module['activated'].'</label>
'.$content_foot_activated.'
<img class="img-thumbnail" src="../images/plugins/center_footer_widget.jpg">
</div>

<div class="col-sm-3"></div>

</div>



  
  <div class="form-group row">
    <div class="col-sm-offset-2 col-sm-10">
		<input type="hidden" name="captcha_hash" value="'.$hash.'" /><input type="hidden" name="modulID" value="'.$modulID.'" />
		<button class="btn btn-warning" type="submit" name="saveedit"  />'.$_language->module['edit_modul'].'</button>
    </div>
  </div>

  </div>
  </div>

  </form></div>
  </div>';
}

else {
	
  echo'<div class="card">
        <div class="card-header">
            <i class="fas fa-tasks"></i> '.$_language->module['module'].'
        </div>
<div class="card-body">

<div class="form-group row">
    <label class="col-md-1 control-label">' . $_language->module['options'] . ':</label>
    <div class="col-md-8">
      <a href="admincenter.php?site=settings_moduls&amp;action=add" class="btn btn-primary" type="button">' . $_language->module[ 'new_modul' ] . '</a>
    </div>
  </div>';
  
  echo'<table class="">
    <thead>
    <th style="width: 2%"></th>
     
      <th style="width: 0%"><img style="width: 285px;" class="img-thumbnail" src="../images/plugins/no_left_right_side_widget.jpg"><br>'.$_language->module['all_deactivated'].'</th>
       
      <th style="width: 0%"><img style="width: 285px;" class="img-thumbnail" src="../images/plugins/left_side_widget.jpg"><br>'.$_language->module['left_is_activated'].'</th>
      
      <th style="width: 0%"><img style="width: 285px;" class="img-thumbnail" src="../images/plugins/right_side_widget.jpg"><br>'.$_language->module['right_is_activated'].'</th>
       <th style="width: 0%"><img style="width: 285px;" class="img-thumbnail" src="../images/plugins/left_right_side_widget.jpg"><br>'.$_language->module['all_activated'].'</th>


      <th style="width: 0%"><img style="width: 285px;" class="img-thumbnail" src="../images/plugins/page_head_widget.jpg"><br>'.$_language->module['page_head'].' '.$_language->module['activated'].'</th>
      
      <th style="width: 0%"><img style="width: 285px;" class="img-thumbnail" src="../images/plugins/center_head_widget.jpg"><br>'.$_language->module['content_head'].' '.$_language->module['activated'].'</th>
      <th style="width: 0%"><img style="width: 285px;" class="img-thumbnail" src="../images/plugins/center_footer_widget.jpg"><br>'.$_language->module['content_foot'].' '.$_language->module['activated'].'</th>
      <th style="width: 2%"></th>
    </thead></table>
<br>
  <table id="plugini" class="table table-bordered table-striped dataTable">
    <thead>
      <th><b>'.$_language->module['modul_name'].'</b></th>
      <th><b>'.$_language->module['base'].'</b></th>
      <th><b>'.$_language->module['left_page'].'</b></th>
      <th><b>'.$_language->module['right_page'].'</b></th>
      <th><b>'.$_language->module['left_right_page'].'</b></th>
      <th><b>'.$_language->module['page_head'].'</b></th>
      <th><b>'.$_language->module['content_head'].'</b></th>
      <th><b>'.$_language->module['content_foot'].'</b></th>
      <th><b>'.$_language->module['actions'].'</b></th>
    </thead>';

	$moduls = safe_query("SELECT * FROM " . PREFIX . "settings_moduls");
    $CAPCLASS = new \webspell\Captcha;
    $CAPCLASS->createTransaction();
    $hash = $CAPCLASS->getHash();

    while ($db = mysqli_fetch_array($moduls)) {
        
        $db[ 'le_activated' ] == 1 ? $le_activated = '<font color="green"><b>' . $_language->module[ 'yes' ] . '</b></font>' :
            $le_activated = '<font color="red"><b>' . $_language->module[ 'no' ] . '</b></font>';
        $db[ 're_activated' ] == 1 ? $re_activated = '<font color="green"><b>' . $_language->module[ 'yes' ] . '</b></font>' :
            $re_activated = '<font color="red"><b>' . $_language->module[ 'no' ] . '</b></font>';
        $db[ 'activated' ] == 1 ? $activated = '<font color="green"><b>' . $_language->module[ 'yes' ] . '</b></font>' :
            $activated = '<font color="red"><b>' . $_language->module[ 'no' ] . '</b></font>';
        $db[ 'deactivated' ] == 1 ? $deactivated = '<font color="green"><b>' . $_language->module[ 'yes' ] . '</b></font>' :
            $deactivated = '<font color="red"><b>' . $_language->module[ 'no' ] . '</b></font>';

        $db[ 'head_activated' ] == 1 ? $head_activated = '<font color="green"><b>' . $_language->module[ 'yes' ] . '</b></font>' :
            $head_activated = '<font color="red"><b>' . $_language->module[ 'no' ] . '</b></font>';
        $db[ 'content_head_activated' ] == 1 ? $content_head_activated = '<font color="green"><b>' . $_language->module[ 'yes' ] . '</b></font>' :
            $content_head_activated = '<font color="red"><b>' . $_language->module[ 'no' ] . '</b></font>';
        $db[ 'content_foot_activated' ] == 1 ? $content_foot_activated = '<font color="green"><b>' . $_language->module[ 'yes' ] . '</b></font>' :
            $content_foot_activated = '<font color="red"><b>' . $_language->module[ 'no' ] . '</b></font>';                    
        
      echo '<tr>
      <td>'.getinput($db['module']).'</td>
      <td>'.$activated.'</td>
      <td>'.$le_activated.'</td>
      <td>'.$re_activated.'</td>
      <td>'.$deactivated.'</td>
      <td>'.$head_activated.'</td>
      <td>'.$content_head_activated.'</td>
      <td>'.$content_foot_activated.'</td>
      
      <td><a href="admincenter.php?site=settings_moduls&amp;action=edit&amp;modulID='.$db['modulID'].'" class="hidden-xs hidden-sm btn btn-warning" type="button">' . $_language->module[ 'edit' ] . '</a>

    <!-- Button trigger modal -->
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
  ' . $_language->module['delete'] . '
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">' . $_language->module['really_delete'] . '</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ' . $_language->module['delete_info'] . '
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a href="admincenter.php?site=admincenter.php?site=settings_moduls&amp;delete=true&amp;modulID='.$db['modulID'].'&amp;captcha_hash='.$hash.'" class="btn btn-danger" role="button" aria-pressed="true">' . $_language->module['delete'] . '</a>
      </div>
    </div>
  </div>
</div>


      </td>
      </tr>';
        
	}
	echo'</table>';
}
echo '</div></div>';
?>