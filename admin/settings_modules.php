<?php
/**
 *¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*  
 *                                    Webspell-RM      /                        /   /                                                 *
 *                                    -----------__---/__---__------__----__---/---/-----__---- _  _ -                                *
 *                                     | /| /  /___) /   ) (_ `   /   ) /___) /   / __  /     /  /  /                                 *
 *                                    _|/_|/__(___ _(___/_(__)___/___/_(___ _/___/_____/_____/__/__/_                                 *
 *                                                 Free Content / Management System                                                   *
 *                                                             /                                                                      *
 *¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
 * @version         Webspell-RM                                                                                                       *
 *                                                                                                                                    *
 * @copyright       2018-2022 by webspell-rm.de <https://www.webspell-rm.de>                                                          *
 * @support         For Support, Plugins, Templates and the Full Script visit webspell-rm.de <https://www.webspell-rm.de/forum.html>  *
 * @WIKI            webspell-rm.de <https://www.webspell-rm.de/wiki.html>                                                             *
 *                                                                                                                                    *
 *¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
 * @license         Script runs under the GNU GENERAL PUBLIC LICENCE                                                                  *
 *                  It's NOT allowed to remove this copyright-tag <http://www.fsf.org/licensing/licenses/gpl.html>                    *
 *                                                                                                                                    *
 * @author          Code based on WebSPELL Clanpackage (Michael Gruber - webspell.at)                                                 *
 * @copyright       2005-2018 by webspell.org / webspell.info                                                                         *
 *¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
 *                                                                                                                                    *
 *¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
 */

$_language->readModule('plugin_manager', false, true);

$ergebnis = safe_query("SELECT * FROM ".PREFIX."navigation_dashboard_links WHERE modulname='ac_modules'");
    while ($db=mysqli_fetch_array($ergebnis)) {
      $accesslevel = 'is'.$db['accesslevel'].'admin';

if (!$accesslevel($userID) || mb_substr(basename($_SERVER[ 'REQUEST_URI' ]), 0, 15) != "admincenter.php") {
    die($_language->module[ 'access_denied' ]);
}
}

global $themes_modulname,$name,$test;

if (isset($_POST[ 'save' ])) {

    $fieldvalue = explode(':',$_POST['plugin']);
    $modulname = $fieldvalue['0'];
    $name = $fieldvalue['1'];
    $themes_modulname = $themes_modulname;
            
    if(isset($_POST['activate'])) { $acti = 1; } else { $acti = 0; }
    if(isset($_POST['head_activated'])) { $head_activated = 1; } else { $head_activated = 0; }
    if(isset($_POST['content_head_activated'])) { $content_head_activated = 1; } else { $content_head_activated = 0; }
    if(isset($_POST['content_foot_activated'])) { $content_foot_activated = 1; } else { $content_foot_activated = 0; }
    if(isset($_POST['head_section_activated'])) { $head_section_activated = 1; } else { $head_section_activated = 0; }
    if(isset($_POST['foot_section_activated'])) { $foot_section_activated = 1; } else { $foot_section_activated = 0; }
    if(isset($_POST['modul_deactivated'])) { $modul_deactivated = 1; } else { $modul_deactivated = 0; }
  
    if($_POST['radio'] == 'le_activated') {
        $le_activated = 1;
        $re_activated = 0;
        $all_activated = 0;
        $all_deactivated = 0;
    } elseif($_POST['radio'] == 're_activated') {
        $le_activated = 0;
        $re_activated = 1;
        $all_activated = 0;
        $all_deactivated = 0;
    } elseif($_POST['radio'] == 'all_activated') {
        $le_activated = 0;
        $re_activated = 0;
        $all_activated = 1;
        $all_deactivated = 0;
    } elseif($_POST['radio'] == 'all_deactivated') {
        $le_activated = 0;
        $re_activated = 0;
        $all_activated = 0;
        $all_deactivated = 1;          
     
    } else {
        $le_activated = 0;
        $re_activated = 0;
        $all_activated = 1;
        $all_deactivated = 0;
    }   
    

    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_POST[ 'captcha_hash' ])) {
        safe_query(
            "INSERT INTO " . PREFIX . "settings_module (pluginID, name, modulname, themes_modulname, le_activated, re_activated, all_activated, all_deactivated, head_activated, content_head_activated, content_foot_activated, head_section_activated, foot_section_activated, modul_display) values (NULL, '" . $name . "', '" . $modulname . "', '" . $themes_modulname . "', '" . $le_activated . "', '" . $re_activated . "', '" . $all_activated . "', '" . $all_deactivated . "', '".$head_activated."', '" . $content_head_activated . "', '" . $content_foot_activated . "', '" . $head_section_activated . "', '" . $foot_section_activated . "', '1')"
        );

        if($modulname == 'forum' && $themes_modulname){
          $topi = safe_query("SELECT * FROM " . PREFIX . "settings_module WHERE modulname = 'forum_topic' AND themes_modulname='".$themes_modulname."'"); 
          $rows = mysqli_num_rows($topi);
          if($rows == '0') {
            safe_query(
                "INSERT INTO
                    `" . PREFIX . "settings_module` (
                    `name`,
                    `modulname`,
                    `themes_modulname`,                   
                    `le_activated`,
                    `re_activated`,
                    `all_activated`,
                    `all_deactivated`,
                    `head_activated`,
                    `content_head_activated`,
                    `content_foot_activated`,
                    `head_section_activated`,
                    `foot_section_activated`
                    ) VALUES (
                    'forum_topic',
                    'forum_topic',
                    '" . $themes_modulname . "',                    
                    '" . $le_activated . "',
                    '" . $re_activated . "',
                    '" . $all_activated . "',
                    '" . $all_deactivated . "',
                    '" . $head_activated . "',
                    '" . $content_head_activated . "',
                    '" . $content_foot_activated . "',
                    '" . $head_section_activated . "',
                    '" . $foot_section_activated . "'
                )"
            );
        }
    }

        $id = mysqli_insert_id($_database);

        $errors = array();

        //TODO: should be loaded from root language folder
        $_language->readModule('formvalidation', true);

        if (count($errors)) {
            $errors = array_unique($errors);
            echo generateErrorBoxFromArray($_language->module['errors_there'], $errors);
        } else {
            redirect("admincenter.php?site=settings_modules", "", 0);
        }
    } else {
        echo $_language->module[ 'transaction_invalid' ];
    }
} elseif (isset($_POST[ 'saveedit' ])) {
    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_POST[ 'captcha_hash' ])) {
      $modulname = $_POST[ 'modulname' ];
            
    if(isset($_POST['activate'])) { $acti = 1; } else { $acti = 0; }
    if(isset($_POST['head_activated'])) { $head_activated = 1; } else { $head_activated = 0; }
    if(isset($_POST['content_head_activated'])) { $content_head_activated = 1; } else { $content_head_activated = 0; }
    if(isset($_POST['content_foot_activated'])) { $content_foot_activated = 1; } else { $content_foot_activated = 0; }
    if(isset($_POST['head_section_activated'])) { $head_section_activated = 1; } else { $head_section_activated = 0; }
    if(isset($_POST['foot_section_activated'])) { $foot_section_activated = 1; } else { $foot_section_activated = 0; }
    if(isset($_POST['modul_deactivated'])) { $modul_deactivated = 1; } else { $modul_deactivated = 0; }
  
    if(@$_POST['radio'] == 'le_activated') {
        $le_activated = 1;
        $re_activated = 0;
        $all_activated = 0;
        $all_deactivated = 0;
    } elseif(@$_POST['radio'] == 're_activated') {
        $le_activated = 0;
        $re_activated = 1;
        $all_activated = 0;
        $all_deactivated = 0;
    } elseif(@$_POST['radio'] == 'all_activated') {
        $le_activated = 0;
        $re_activated = 0;
        $all_activated = 1;
        $all_deactivated = 0;
    } elseif(@$_POST['radio'] == 'all_deactivated') {
        $le_activated = 0;
        $re_activated = 0;
        $all_activated = 0;
        $all_deactivated = 1;          
    } else {
        $le_activated = 0;
        $re_activated = 0;
        $all_activated = 0;
        $all_deactivated = 0;
    }
        

        $pluginID = (int)$_POST[ 'pluginID' ];
        $id = $pluginID;

        safe_query(
            "UPDATE
                `" . PREFIX . "settings_module`
            SET
                `modulname` = '" . $modulname . "',
                `le_activated` = '" . $le_activated . "',
                `re_activated` = '" . $re_activated . "',
                `all_activated` = '" . $all_activated . "',
                `all_deactivated` = '" . $all_deactivated . "',
                `head_activated` = '".$head_activated."',
                `content_head_activated` = '" . $content_head_activated . "',
                `content_foot_activated` = '" . $content_foot_activated . "',
                `head_section_activated` = '" . $head_section_activated . "',
                `foot_section_activated` = '" . $foot_section_activated . "'
                      WHERE
                `pluginID` = '" . $pluginID . "'"
        );


         if($modulname == 'startpage' && $themes_modulname){
          global $themes_modulname;
          $geti = safe_query("SELECT * FROM " . PREFIX . "settings_module WHERE modulname = '' AND themes_modulname='".$themes_modulname."'"); 
          $rows = mysqli_num_rows($geti);
          if($rows == '0') {
            safe_query(
                "INSERT INTO
                    `" . PREFIX . "settings_module` (
                                       
                    `le_activated`,
                    `re_activated`,
                    `all_activated`,
                    `all_deactivated`,
                    `head_activated`,
                    `content_head_activated`,
                    `content_foot_activated`,
                    `head_section_activated`,
                    `foot_section_activated`
                    ) VALUES (
                    
                    '" . $le_activated . "',
                    '" . $re_activated . "',
                    '" . $all_activated . "',
                    '" . $all_deactivated . "',
                    '" . $head_activated . "',
                    '" . $content_head_activated . "',
                    '" . $content_foot_activated . "',
                    '" . $head_section_activated . "',
                    '" . $foot_section_activated . "'
                )"
            );
        }
        safe_query(
            "UPDATE
                `" . PREFIX . "settings_module`
            SET
                
                `le_activated` = '" . $le_activated . "',
                `re_activated` = '" . $re_activated . "',
                `all_activated` = '" . $all_activated . "',
                `all_deactivated` = '" . $all_deactivated . "',
                `head_activated` = '".$head_activated."',
                `content_head_activated` = '" . $content_head_activated . "',
                `content_foot_activated` = '" . $content_foot_activated . "',
                `head_section_activated` = '" . $head_section_activated . "',
                `foot_section_activated` = '" . $foot_section_activated . "'
                  WHERE
                `modulname` = '' AND themes_modulname='".$themes_modulname."'"
        );
}

if($modulname == 'forum' && $themes_modulname){
          $topi = safe_query("SELECT * FROM " . PREFIX . "settings_module WHERE modulname = 'forum_topic' AND themes_modulname='".$themes_modulname."'"); 
          $rows = mysqli_num_rows($topi);
          if($rows == '0') {
            safe_query(
                "INSERT INTO
                    `" . PREFIX . "settings_module` (
                    `name`,
                    `modulname`,
                    `themes_modulname`,                   
                    `le_activated`,
                    `re_activated`,
                    `all_activated`,
                    `all_deactivated`,
                    `head_activated`,
                    `content_head_activated`,
                    `content_foot_activated`,
                    `head_section_activated`,
                    `foot_section_activated`
                    ) VALUES (
                    'forum_topic',
                    'forum_topic',
                    '" . $themes_modulname . "',                    
                    '" . $le_activated . "',
                    '" . $re_activated . "',
                    '" . $all_activated . "',
                    '" . $all_deactivated . "',
                    '" . $head_activated . "',
                    '" . $content_head_activated . "',
                    '" . $content_foot_activated . "',
                    '" . $head_section_activated . "',
                    '" . $foot_section_activated . "'
                )"
            );
        }

        safe_query(
            "UPDATE
                `" . PREFIX . "settings_module`
            SET
               `name` = 'forum_topic',
               `modulname` = 'forum_topic',
               `themes_modulname` = '" . $themes_modulname . "', 
                `le_activated` = '" . $le_activated . "',
                `re_activated` = '" . $re_activated . "',
                `all_activated` = '" . $all_activated . "',
                `all_deactivated` = '" . $all_deactivated . "',
                `head_activated` = '".$head_activated."',
                `content_head_activated` = '" . $content_head_activated . "',
                `content_foot_activated` = '" . $content_foot_activated . "',
                `head_section_activated` = '" . $head_section_activated . "',
                `foot_section_activated` = '" . $foot_section_activated . "'
                  WHERE
                `modulname` = 'forum_topic' AND themes_modulname='".$themes_modulname."'"
        );
}

if($modulname == '' && $themes_modulname){
  global $themes_modulname;
          $geti = safe_query("SELECT * FROM " . PREFIX . "settings_module WHERE modulname = 'startpage' AND themes_modulname='".$themes_modulname."'"); 
          $rows = mysqli_num_rows($geti);
          if($rows == '0') {
            safe_query(
                "INSERT INTO
                    `" . PREFIX . "settings_module` (
                                       
                    `le_activated`,
                    `re_activated`,
                    `all_activated`,
                    `all_deactivated`,
                    `head_activated`,
                    `content_head_activated`,
                    `content_foot_activated`,
                    `head_section_activated`,
                    `foot_section_activated`
                    ) VALUES (
                    
                    '" . $le_activated . "',
                    '" . $re_activated . "',
                    '" . $all_activated . "',
                    '" . $all_deactivated . "',
                    '" . $head_activated . "',
                    '" . $content_head_activated . "',
                    '" . $content_foot_activated . "',
                    '" . $head_section_activated . "',
                    '" . $foot_section_activated . "'
                )"
            );
        }
        safe_query(
            "UPDATE
                `" . PREFIX . "settings_module`
            SET
                
                `le_activated` = '" . $le_activated . "',
                `re_activated` = '" . $re_activated . "',
                `all_activated` = '" . $all_activated . "',
                `all_deactivated` = '" . $all_deactivated . "',
                `head_activated` = '".$head_activated."',
                `content_head_activated` = '" . $content_head_activated . "',
                `content_foot_activated` = '" . $content_foot_activated . "',
                `head_section_activated` = '" . $head_section_activated . "',
                `foot_section_activated` = '" . $foot_section_activated . "'
                  WHERE
                `modulname` = 'startpage' AND themes_modulname='".$themes_modulname."'"
        );
}

        
    } else {
        echo $_language->module[ 'transaction_invalid' ];
    }
}

$_language->readModule('plugin_manager', false, true);

if (isset($_GET[ 'action' ])) {
    $action = $_GET[ 'action' ];
} else {
    $action = '';
}




if ($action == "add") {

echo'<div class="card">
        <div class="card-header">
            <i class="fas fa-tasks"></i> '.$_language->module['modul_edit'].'
        </div>
            
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="admincenter.php?site=settings_modules">' . $_language->module['modul_edit'] . '</a></li>
    <li class="breadcrumb-item active" aria-current="page">' . $_language->module['edit_modul'] . '</li>
  </ol>
</nav>
     <div class="card-body">';


    $CAPCLASS = new \webspell\Captcha;
    $CAPCLASS->createTransaction();
    $hash = $CAPCLASS->getHash();

    $plugin = '';
    $button = '';
    $text ='';
    $ergebnis = safe_query("SELECT * FROM " . PREFIX . "plugins WHERE modul_display='1'");

    if(mysqli_num_rows($ergebnis)<1) {
        echo'' . $_language->module['no_modul_setup'] . '';
        return false;
    } else {
        while ($ds = mysqli_fetch_array($ergebnis)) {
            $ergebniss = mysqli_num_rows(safe_query("SELECT * FROM " . PREFIX . "settings_module WHERE modulname='".$ds['modulname']."' AND themes_modulname='".$themes_modulname."'"));
            
            if($ergebniss == '0') {
                $plugin .= '<option value="' . $ds['modulname'] . ':' . $ds['name'] . '">' . $ds['name'] . '</option>';
                $button ='<button class="btn btn-success" type="submit" name="save"  />'.$_language->module['edit_modul'].'</button>';
            } else {
                $plugin .= '';
            }
        }    
    }    
       
    if ($button) {
        $text = '

<form method="post" id="post" name="post" action="admincenter.php?site=settings_modules" enctype="multipart/form-data" onsubmit="return chkFormular();">
    <div class="form-group">
        <select name="plugin" id="select-receiver" class="form-control">
            '.$plugin.'
        </select>
        '.@$text.'
    </div>

<div class="col-sm-12">
<table class="table">
  <thead>
    <tr>
      <th scope="col">'.$_language->module['deactivated'].'</th>
      <th scope="col">'.$_language->module['left_is_activated'].'</th>
      <th scope="col">'.$_language->module['right_is_activated'].'</th>
      <th scope="col">'.$_language->module['all_activated'].'</th>
      <th scope="col">'.$_language->module['page_head'].'</th>
      <th scope="col">'.$_language->module['head_section'].'</th>
      <th scope="col">'.$_language->module['content_head'].'</th>
      <th scope="col">'.$_language->module['content_foot'].'</th>
      <th scope="col">'.$_language->module['foot_section'].'</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td scope="row"><input id="deactivated" type="radio" name="radio" value="all_activated" checked></td>
      <td><input id="le_activated" type="radio" name="radio" value="le_activated"></td>
      <td><input id="re_activated" type="radio" name="radio" value="re_activated"></td>
      <td><input id="activated" type="radio" name="radio" value="all_deactivated"></td>
      <td><input type="checkbox" name="head_activated" value="1"></td>
      <td><input type="checkbox" name="head_section_activated" value="1"></td>
      <td><input type="checkbox" name="content_head_activated" value="1"></td>
      <td><input type="checkbox" name="content_foot_activated" value="1"></td>
      <td><input type="checkbox" name="foot_section_activated" value="1"></td>
    </tr>
    <tr>
      <th scope="row"><img style="width: 120px;" class="img-thumbnail" src="../images/plugins/no_left_right_side_widget.jpg"></th>
      <td><img style="width: 120px;" class="img-thumbnail" src="../images/plugins/left_side_widget.jpg"></td>
      <td><img style="width: 120px;" class="img-thumbnail" src="../images/plugins/right_side_widget.jpg"></td>
      <td><img style="width: 120px;" class="img-thumbnail" src="../images/plugins/left_right_side_widget.jpg"></td>
      <td><img style="width: 120px;" class="img-thumbnail" src="../images/plugins/page_head_widget.jpg"></td>
      <td><img style="width: 120px;" class="img-thumbnail" src="../images/plugins/head_section_widget.jpg"></td>
      <td><img style="width: 120px;" class="img-thumbnail" src="../images/plugins/center_head_widget.jpg"></td>
      <td><img style="width: 120px;" class="img-thumbnail" src="../images/plugins/center_footer_widget.jpg"></td>
      <td><img style="width: 120px;" class="img-thumbnail" src="../images/plugins/foot_section_widget.jpg"></td>
    </tr>    
  </tbody>
</table>
</div>

<div class="row">
<div class="col-sm-12">'.$_language->module['info'].'</div>

 
  <div class="form-group">
    <div class="col-sm-offset-1 col-sm-10">
    <input type="hidden" name="captcha_hash" value="'.$hash.'" />
    <!--<button class="btn btn-success" type="submit" name="save"  />'.$_language->module['edit_modul'].'</button>-->
    '.@$button.'
    </div>
</div>
</div> 
  </form>

  ';
    } else {
        $text = '' . $_language->module['no_modul'] . '';
                
    }
echo' '.$text.'
    </div>
</div>';
} elseif ($action == "edit") {
    $CAPCLASS = new \webspell\Captcha;
    $CAPCLASS->createTransaction();
    $hash = $CAPCLASS->getHash();

    echo '<div class="card">
        <div class="card-header">
            <i class="fas fa-tasks"></i> '.$_language->module['modul_edit'].'
        </div>
            
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="admincenter.php?site=settings_modules">' . $_language->module['modul_edit'] . '</a></li>
    <li class="breadcrumb-item active" aria-current="page">' . $_language->module['edit_modul'] . '</li>
  </ol>
</nav>
     <div class="card-body">';

  
  
  $pluginID = $_GET[ 'pluginID' ];
    $ergebnis = safe_query("SELECT * FROM " . PREFIX . "settings_module WHERE pluginID='$pluginID'");
    $ds = mysqli_fetch_array($ergebnis);

    if ($ds[ 'le_activated' ] == '1') {
        $le_activated = '<input id="le_activated" type="radio" name="radio" value="le_activated" checked="checked" />';
    } else {
        $le_activated = '<input id="le_activated" type="radio" name="radio" value="le_activated">';
    }

    if ($ds[ 're_activated' ] == '1') {
        $re_activated = '<input id="re_activated" type="radio" name="radio" value="re_activated" checked="checked" />';
    } else {
        $re_activated = '<input id="re_activated" type="radio" name="radio" value="re_activated">';
    }

    if ($ds[ 'all_activated' ] == '1') {
        $all_activated = '<input id="all_activated" type="radio" name="radio" value="all_activated" checked="checked" />';
    } else {
        $all_activated = '<input id="all_activated" type="radio" name="radio" value="all_activated">';
    }

    if ($ds[ 'all_deactivated' ] == '1') {
        $all_deactivated = '<input id="all_deactivated" type="radio" name="radio" value="all_deactivated" checked="checked" />';
    } else {
        $all_deactivated = '<input id="all_deactivated" type="radio" name="radio" value="all_deactivated">';
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

    if ($ds['head_section_activated'] == '1') {
        $head_section_activated = '<input type="checkbox" name="head_section_activated" value="1" checked="checked">';
    } else {
        $head_section_activated = '<input type="checkbox" name="head_section_activated" value="1">';
    }

    if ($ds['foot_section_activated'] == '1') {
        $foot_section_activated = '<input type="checkbox" name="foot_section_activated" value="1" checked="checked">';
    } else {
        $foot_section_activated = '<input type="checkbox" name="foot_section_activated" value="1">';
    }

echo'<form class="form-horizontal" method="post" action="admincenter.php?site=settings_modules" enctype="multipart/form-data">

     
<div class="row">

<div class="col-md-12">

    
    <div class="form-group">
    <label class="col-sm-1 control-label">'.$_language->module['plugin'].':</label>
    <div class="col-sm-2"><span class="text-muted small"><em>
      <input type="text" class="form-control" name="modulname" value="'.getinput($ds['name']).'" readonly /></em></span>
    </div>
  </div>

  <div class="form-group row">
    <label class="col-sm-1 control-label">'.$_language->module['modulname'].':</label>
    <div class="col-sm-2"><span class="text-muted small"><em>
      <input type="text" class="form-control" name="modulname" value="'.getinput($ds['modulname']).'" readonly /></em></span>
    </div>
  </div>
<br>

<div class="col-sm-12">
<table class="table">
  <thead>
    <tr>
      <th scope="col">'.$_language->module['deactivated'].'</th>
      <th scope="col">'.$_language->module['left_is_activated'].'</th>
      <th scope="col">'.$_language->module['right_is_activated'].'</th>
      <th scope="col">'.$_language->module['all_activated'].'</th>
      <th scope="col">'.$_language->module['page_head'].'</th>
      <th scope="col">'.$_language->module['head_section'].'</th>
      <th scope="col">'.$_language->module['content_head'].'</th>
      <th scope="col">'.$_language->module['content_foot'].'</th>
      <th scope="col">'.$_language->module['foot_section'].'</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">'.$all_activated.'</th>
      <td>'.$le_activated.'</td>
      <td>'.$re_activated.'</td>
      <td>'.$all_deactivated.'</td>
      <td>'.$head_activated.'</td>
      <td>'.$head_section_activated.'</td>
      <td>'.$content_head_activated.'</td>
      <td>'.$content_foot_activated.'</td>
      <td>'.$foot_section_activated.'</td>
    </tr>
    <tr>
      <th scope="row"><img style="width: 120px;" class="img-thumbnail" src="../images/plugins/no_left_right_side_widget.jpg"></th>
      <td><img style="width: 120px;" class="img-thumbnail" src="../images/plugins/left_side_widget.jpg"></td>
      <td><img style="width: 120px;" class="img-thumbnail" src="../images/plugins/right_side_widget.jpg"></td>
      <td><img style="width: 120px;" class="img-thumbnail" src="../images/plugins/left_right_side_widget.jpg"></td>
      <td><img style="width: 120px;" class="img-thumbnail" src="../images/plugins/page_head_widget.jpg"></td>
      <td><img style="width: 120px;" class="img-thumbnail" src="../images/plugins/head_section_widget.jpg"></td>
      <td><img style="width: 120px;" class="img-thumbnail" src="../images/plugins/center_head_widget.jpg"></td>
      <td><img style="width: 120px;" class="img-thumbnail" src="../images/plugins/center_footer_widget.jpg"></td>
      <td><img style="width: 120px;" class="img-thumbnail" src="../images/plugins/foot_section_widget.jpg"></td>
    </tr>
    
  </tbody>
</table>
</div>


     <div class="form-group row">

<div class="col-sm-12">'.$_language->module['info'].'</div>

</div>  
  <div class="form-group">
    <div class="col-sm-offset-1 col-sm-10">
		<input type="hidden" name="captcha_hash" value="'.$hash.'" /><input type="hidden" name="pluginID" value="'.$pluginID.'" />
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
            <i class="fas fa-cogs"></i> '.$_language->module['modul_edit'].'
        </div>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">' . $_language->module[ 'modul_edit' ] . '</li>
  </ol>
</nav>

<div class="card-body">
<div class="form-group row">
    <label class="col-md-1 control-label">' . $_language->module['options'] . ':</label>
    <div class="col-md-2">
      <a href="admincenter.php?site=settings_modules&amp;action=add" class="btn btn-primary" style="margin-top: -10px"> ' . $_language->module[ 'new_modul' ] . '</a></div>
      <div class="col-md-6"> ' . $_language->module[ 'modul_info' ] . '
    </div>
  </div>';
  
  echo'<table id="plugini" class="table table-bordered table-striped dataTable">
    <thead>
      <th>'.$_language->module['plugin'].'</th>
      <th><img style="width: 100px;" class="" src="../images/plugins/no_left_right_side_widget.jpg"><br>'.$_language->module['all_deactivated'].'</th>
      <th><img style="width: 100px;" class="" src="../images/plugins/left_side_widget.jpg"><br>'.$_language->module['left_is_activated'].'</th>
      <th><img style="width: 100px;" class="" src="../images/plugins/right_side_widget.jpg"><br>'.$_language->module['right_is_activated'].'</th>
      <th><img style="width: 100px;" class="" src="../images/plugins/left_right_side_widget.jpg"><br>'.$_language->module['all_activated'].'</th>
      <th><img style="width: 100px;" class="" src="../images/plugins/page_head_widget.jpg"><br>'.$_language->module['page_head'].'</th>
      <th><img style="width: 100px;" class="" src="../images/plugins/head_section_widget.jpg"><br>'.$_language->module['head_section'].'</th>
      <th><img style="width: 100px;" class="" src="../images/plugins/center_head_widget.jpg"><br>'.$_language->module['content_head'].'</th>
      <th><img style="width: 100px;" class="" src="../images/plugins/center_footer_widget.jpg"><br>'.$_language->module['content_foot'].'</th>
      <th><img style="width: 100px;" class="" src="../images/plugins/foot_section_widget.jpg"><br>'.$_language->module['foot_section'].'</th>
      <th>'.$_language->module['actions'].'</th>
    </thead>';


$moduls = safe_query("SELECT * FROM " . PREFIX . "settings_module WHERE modul_display='1' AND themes_modulname='$themes_modulname' ");










    $CAPCLASS = new \webspell\Captcha;
    $CAPCLASS->createTransaction();
    $hash = $CAPCLASS->getHash();

    while ($db = mysqli_fetch_array($moduls)) {
        
        $db[ 'le_activated' ] == 1 ? $le_activated = '<font color="green">' . $_language->module[ 'yes' ] . '</font>' :
            $le_activated = '<font color="red">' . $_language->module[ 'no' ] . '</font>';
        $db[ 're_activated' ] == 1 ? $re_activated = '<font color="green">' . $_language->module[ 'yes' ] . '</font>' :
            $re_activated = '<font color="red">' . $_language->module[ 'no' ] . '</font>';
        $db[ 'all_activated' ] == 1 ? $all_activated = '<font color="green">' . $_language->module[ 'yes' ] . '</font>' :
            $all_activated = '<font color="red">' . $_language->module[ 'no' ] . '</font>';
        $db[ 'all_deactivated' ] == 1 ? $all_deactivated = '<font color="green">' . $_language->module[ 'yes' ] . '</font>' :
            $all_deactivated = '<font color="red">' . $_language->module[ 'no' ] . '</font>';
        $db[ 'head_activated' ] == 1 ? $head_activated = '<font color="green">' . $_language->module[ 'yes' ] . '</font>' :
            $head_activated = '<font color="red">' . $_language->module[ 'no' ] . '</font>';
        $db[ 'head_section_activated' ] == 1 ? $head_section_activated = '<font color="green">' . $_language->module[ 'yes' ] . '</font>' :
            $head_section_activated = '<font color="red">' . $_language->module[ 'no' ] . '</font>';
        $db[ 'content_head_activated' ] == 1 ? $content_head_activated = '<font color="green">' . $_language->module[ 'yes' ] . '</font>' :
            $content_head_activated = '<font color="red">' . $_language->module[ 'no' ] . '</font>';
        $db[ 'content_foot_activated' ] == 1 ? $content_foot_activated = '<font color="green">' . $_language->module[ 'yes' ] . '</font>' :
            $content_foot_activated = '<font color="red">' . $_language->module[ 'no' ] . '</font>';
        $db[ 'foot_section_activated' ] == 1 ? $foot_section_activated = '<font color="green">' . $_language->module[ 'yes' ] . '</font>' :
            $foot_section_activated = '<font color="red">' . $_language->module[ 'no' ] . '</font>';            
                               
        
      echo '<tr>
      <td>'.getinput($db['name']).'</td>
      <td>'.$all_activated.'</td>
      <td>'.$le_activated.'</td>
      <td>'.$re_activated.'</td>
      <td>'.$all_deactivated.'</td>
      <td>'.$head_activated.'</td>
      <td>'.$head_section_activated.'</td>
      <td>'.$content_head_activated.'</td>
      <td>'.$content_foot_activated.'</td>
      <td>'.$foot_section_activated.'</td>
      
      <td><a href="admincenter.php?site=settings_modules&amp;action=edit&amp;pluginID='.$db['pluginID'].'" class="btn btn-warning" type="button">' . $_language->module[ 'edit_modul' ] . '</a>

      </td>
      </tr>';
        
	}
	echo'</table>';
}
echo '</div></div>';
?>