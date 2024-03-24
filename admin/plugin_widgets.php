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


$_language->readModule('widgets', false, true);


$ergebnis = safe_query("SELECT * FROM ".PREFIX."navigation_dashboard_links WHERE modulname='ac_widgets'");
    while ($db=mysqli_fetch_array($ergebnis)) {
      $accesslevel = 'is'.$db['accesslevel'].'admin';

if (!$accesslevel($userID) || mb_substr(basename($_SERVER[ 'REQUEST_URI' ]), 0, 15) != "admincenter.php") {
    die($_language->module[ 'access_denied' ]);
}
}

$theme_active = safe_query("SELECT * FROM " . PREFIX . "settings_themes WHERE active = '1'");
    $db = mysqli_fetch_array($theme_active);

if(!empty(@$db['active'] == 1) !== false) {

$filepath = "../includes/plugins/";

if (isset($_POST[ 'sorting_navigation' ])) {
    $sortnavigation = $_POST[ 'sortnavigation' ];

    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_POST[ 'captcha_hash' ])) {
        if (is_array($sortnavigation)) {
            foreach ($sortnavigation as $sortstring) {
                $sorter = explode("-", $sortstring);
                safe_query("UPDATE `" . PREFIX . "settings_widgets` SET `sort` = '$sorter[1]' WHERE `id` = '" . $sorter[0] . "'");
            }
        }
    } else {
        echo $_language->module[ 'transaction_invalid' ];
        redirect("admincenter.php?site=plugin_widgets", "", 0);
    }

}elseif (isset($_POST[ 'sorting_page_head' ])) {
    $sortpage_head = $_POST[ 'sortpage_head' ];

    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_POST[ 'captcha_hash' ])) {
        if (is_array($sortpage_head)) {
            foreach ($sortpage_head as $sortstring) {
                $sorter = explode("-", $sortstring);
                safe_query("UPDATE `" . PREFIX . "settings_widgets` SET `sort` = '$sorter[1]' WHERE `id` = '" . $sorter[0] . "'");
            }
        }
    } else {
        echo $_language->module[ 'transaction_invalid' ];
        redirect("admincenter.php?site=plugin_widgets", "", 0);
    }

}elseif (isset($_POST[ 'sorting_head_section' ])) {
    $sorthead_section = $_POST[ 'sorthead_section' ];

    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_POST[ 'captcha_hash' ])) {
        if (is_array($sorthead_section)) {
            foreach ($sorthead_section as $sortstring) {
                $sorter = explode("-", $sortstring);
                safe_query("UPDATE `" . PREFIX . "settings_widgets` SET `sort` = '$sorter[1]' WHERE `id` = '" . $sorter[0] . "'");
            }
        }
    } else {
        echo $_language->module[ 'transaction_invalid' ];
        redirect("admincenter.php?site=plugin_widgets", "", 0);
    }

}elseif (isset($_POST[ 'sorting_left_side' ])) {
    $sortleft_side = $_POST[ 'sortleft_side' ];

    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_POST[ 'captcha_hash' ])) {
        if (is_array($sortleft_side)) {
            foreach ($sortleft_side as $sortstring) {
                $sorter = explode("-", $sortstring);
                safe_query("UPDATE `" . PREFIX . "settings_widgets` SET `sort` = '$sorter[1]' WHERE `id` = '" . $sorter[0] . "'");
            }
        }
    } else {
        echo $_language->module[ 'transaction_invalid' ];
        redirect("admincenter.php?site=plugin_widgets", "", 0);
    }

}elseif (isset($_POST[ 'sorting_center_head' ])) {
    $sortcenter_head = $_POST[ 'sortcenter_head' ];

    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_POST[ 'captcha_hash' ])) {
        if (is_array($sortcenter_head)) {
            foreach ($sortcenter_head as $sortstring) {
                $sorter = explode("-", $sortstring);
                safe_query("UPDATE `" . PREFIX . "settings_widgets` SET `sort` = '$sorter[1]' WHERE `id` = '" . $sorter[0] . "'");
            }
        }
    } else {
        echo $_language->module[ 'transaction_invalid' ];
        redirect("admincenter.php?site=plugin_widgets", "", 0);
    }

}elseif (isset($_POST[ 'sorting_center_footer' ])) {
    $sortcenter_footer = $_POST[ 'sortcenter_footer' ];

    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_POST[ 'captcha_hash' ])) {
        if (is_array($sortcenter_footer)) {
            foreach ($sortcenter_footer as $sortstring) {
                $sorter = explode("-", $sortstring);
                safe_query("UPDATE `" . PREFIX . "settings_widgets` SET `sort` = '$sorter[1]' WHERE `id` = '" . $sorter[0] . "'");
            }
        }
    } else {
        echo $_language->module[ 'transaction_invalid' ];
        redirect("admincenter.php?site=plugin_widgets", "", 0);
    }

}elseif (isset($_POST[ 'sorting_right_side' ])) {
    $sortright_side = $_POST[ 'sortright_side' ];

    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_POST[ 'captcha_hash' ])) {
        if (is_array($sortright_side)) {
            foreach ($sortright_side as $sortstring) {
                $sorter = explode("-", $sortstring);
                safe_query("UPDATE `" . PREFIX . "settings_widgets` SET `sort` = '$sorter[1]' WHERE `id` = '" . $sorter[0] . "'");
            }
        }
    } else {
        echo $_language->module[ 'transaction_invalid' ];
    }

}elseif (isset($_POST[ 'sorting_foot_section' ])) {
    $sortfoot_section = $_POST[ 'sortfoot_section' ];

    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_POST[ 'captcha_hash' ])) {
        if (is_array($sortfoot_section)) {
            foreach ($sortfoot_section as $sortstring) {
                $sorter = explode("-", $sortstring);
                safe_query("UPDATE `" . PREFIX . "settings_widgets` SET `sort` = '$sorter[1]' WHERE `id` = '" . $sorter[0] . "'");
            }
        }
    } else {
        echo $_language->module[ 'transaction_invalid' ];
        redirect("admincenter.php?site=plugin_widgets", "", 0);
    }

}elseif (isset($_POST[ 'sorting_page_footer' ])) {
    $sortpage_footer = $_POST[ 'sortpage_footer' ];

    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_POST[ 'captcha_hash' ])) {
        if (is_array($sortpage_footer)) {
            foreach ($sortpage_footer as $sortstring) {
                $sorter = explode("-", $sortstring);
                safe_query("UPDATE `" . PREFIX . "settings_widgets` SET `sort` = '$sorter[1]' WHERE `id` = '" . $sorter[0] . "'");
            }
        }
    } else {
        echo $_language->module[ 'transaction_invalid' ];
        redirect("admincenter.php?site=plugin_widgets", "", 0);
    }

}




$themeergebnis = safe_query("SELECT * FROM " . PREFIX . "settings_themes WHERE active = '1'");
    $db = mysqli_fetch_array($themeergebnis);



		echo'<div class="card">
        <div class="card-header">
            ' . $_language->module[ 'widget' ] . '
        </div>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="admincenter.php?site=plugin_widgets">' . $_language->module['widget'] . '</a></li>
    <li class="breadcrumb-item active" aria-current="page">new & edit</li>
  </ol>
</nav>
<div class="card-body">';

$thergebnis = safe_query("SELECT * FROM " . PREFIX . "settings_themes WHERE active = '1'");
    $db = mysqli_fetch_array($thergebnis);
  echo'<div class="mb-12 row">
    <label class="col-md-1 control-label"><h4>Template:</h4></label>
    <div class="col-md-3"><div class="alert alert-info" role="alert" style="padding: 0px 5px">
<h4>'.$themes_modulname.'</h4></div>
    </div>
  </div>
<hr>';	

		
echo'
<div class="col-md-12">
  <div class="row">
    '; 

    
$moduls = safe_query("SELECT * FROM " . PREFIX . "settings_widgets WHERE position = 'page_navigation_widget' and themes_modulname= '".$db['modulname']."' ORDER BY sort");
echo'<div class="col-md-2 text-center"><img class="img-thumbnail" style="height: 250px;margin-bottom: 6px;" class="img-fluid" src="../images/plugins/page_navigation_widget.jpg"></div>
<div class="col-md-10">
<form method="post" action="admincenter.php?site=plugin_widgets">
<table class="table table-striped">

<thead>
            <th style="width: 80%"><b>'.$_language->module[ 'plugin_name' ].'</b></th>
            <th style="width: 10%"><b>'.$_language->module[ 'actions' ].'</b></th>
            <th style="width: 10%"><b>'.$_language->module[ 'sort' ].'</b></th>
</thead>
<tbody>';

$CAPCLASS = new \webspell\Captcha;
    $CAPCLASS->createTransaction();
    $hash = $CAPCLASS->getHash();
    while ($ds = mysqli_fetch_array($moduls)) {

    $xergebnis = safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='".$ds['modulname']."'");
    $dp = mysqli_fetch_array($xergebnis);

        $tmp = mysqli_fetch_assoc(safe_query("SELECT count(id) as cnt FROM " . PREFIX . "settings_widgets WHERE position = 'page_navigation_widget' and themes_modulname= '".$db['modulname']."'"));
        $anznavigation = $tmp[ 'cnt' ];


        $navigationlist = '<select name="sortnavigation[]">';
                for ($n = 1; $n <= $anznavigation; $n++) {
                    $navigationlist .= '<option value="' . $ds['id'] . '-' . $n . '">' . $n . '</option>';
                }
                $navigationlist .= '</select>';
                $navigationlist = str_replace(
                    'value="' . $ds['id'] . '-' . $ds[ 'sort' ] . '"',
                    'value="' . $ds['id'] . '-' . $ds[ 'sort' ] . '" selected="selected"',
                    $navigationlist
                );

            
        if(file_exists($filepath.$ds[ 'modulname' ].'/images/'.$ds['widgetdatei'].'.jpg')){
            $pic='<img class="img-thumbnail" style="height: 200px" src="'.$filepath.$ds[ 'modulname' ].'/images/'.$ds['widgetdatei'].'.jpg" alt="">';
        } elseif(file_exists($filepath.$ds[ 'modulname' ].'/images/'.$ds['widgetdatei'].'.jpeg')){
            $pic='<img class="img-thumbnail" style="height: 200px" src="'.$filepath.$ds[ 'modulname' ].'/images/'.$ds['widgetdatei'].'.jpeg" alt="">';
        } elseif(file_exists($filepath.$ds[ 'modulname' ].'/images/'.$ds['widgetdatei'].'.png')){
            $pic='<img class="img-thumbnail" style="height: 200px" src="'.$filepath.$ds[ 'modulname' ].'/images/'.$ds['widgetdatei'].'.png" alt="">';
        } elseif(file_exists($filepath.$ds[ 'modulname' ].'/images/'.$ds['widgetdatei'].'.gif')){
            $pic='<img class="img-thumbnail" style="height: 200px" src="'.$filepath.$ds[ 'modulname' ].'/images/'.$ds['widgetdatei'].'.gif" alt="">';
        } else{
           $pic='<img class="img-thumbnail" style="height: 200px" src="../images/plugins/no-image.jpg" alt="">';
        }

     echo'
<tr>
<td>
<table><tr><td>
'.$pic.'
</td><td>
<span class="badge badge-secondary" style="width: 100%"><h5 style="color: #000">'.$ds['widgetname'].'</h5></span>
</td>
</tr>
</table>
<td><a href="admincenter.php?site=plugin_manager&action=edit&id='.$dp['pluginID'].'&do=edit" class="btn btn-warning" type="button">' . $_language->module[ 'edit' ] . '</a></td>
<td>' . $navigationlist . '</td>
</tr>

'; }
echo'<tr><td colspan="2">
            </td>
<td><input type="hidden" name="captcha_hash" value="'.$hash.'" /><input class="btn btn-success" type="submit" name="sorting_navigation" value="'.$_language->module[ 'sorting' ].'" /></td>
</tr>
  </tbody>
</table>
  </div>';



echo'
</div></div>
<div class="col-md-12">
  <div class="row">';




    
$moduls = safe_query("SELECT * FROM " . PREFIX . "settings_widgets WHERE position = 'page_head_widget' and themes_modulname= '".$db['modulname']."' ORDER BY sort");
echo'<div class="col-md-2 text-center"><img class="img-thumbnail" style="height: 250px;margin-bottom: 6px;" class="img-fluid" src="../images/plugins/page_head_widget.jpg"></div>
<div class="col-md-10"><table class="table table-striped">

<thead>
            <th style="width: 80%"><b>'.$_language->module[ 'plugin_name' ].'</b></th>
            <th style="width: 10%"><b>'.$_language->module[ 'actions' ].'</b></th>
            <th style="width: 10%"><b>'.$_language->module[ 'sort' ].'</b></th>
</thead>
<tbody>';
    while ($ds = mysqli_fetch_array($moduls)) {

    $xergebnis = safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='".$ds['modulname']."'");
    $dp = mysqli_fetch_array($xergebnis);
    
        $tmp = mysqli_fetch_assoc(safe_query("SELECT count(id) as cnt FROM " . PREFIX . "settings_widgets WHERE position = 'page_head_widget' and themes_modulname= '".$db['modulname']."'"));
        $anzpage_head = $tmp[ 'cnt' ];


        $page_headlist = '<select name="sortpage_head[]">';
                for ($n = 1; $n <= $anzpage_head; $n++) {
                    $page_headlist .= '<option value="' . $ds['id'] . '-' . $n . '">' . $n . '</option>';
                }
                $page_headlist .= '</select>';
                $page_headlist = str_replace(
                    'value="' . $ds['id'] . '-' . $ds[ 'sort' ] . '"',
                    'value="' . $ds['id'] . '-' . $ds[ 'sort' ] . '" selected="selected"',
                    $page_headlist
                );
            

        if(file_exists($filepath.$ds[ 'modulname' ].'/images/'.$ds['widgetdatei'].'.jpg')){
            $pic='<img class="img-thumbnail" style="height: 200px" src="'.$filepath.$ds[ 'modulname' ].'/images/'.$ds['widgetdatei'].'.jpg" alt="">';
        } elseif(file_exists($filepath.$ds[ 'modulname' ].'/images/'.$ds['widgetdatei'].'.jpeg')){
            $pic='<img class="img-thumbnail" style="height: 200px" src="'.$filepath.$ds[ 'modulname' ].'/images/'.$ds['widgetdatei'].'.jpeg" alt="">';
        } elseif(file_exists($filepath.$ds[ 'modulname' ].'/images/'.$ds['widgetdatei'].'.png')){
            $pic='<img class="img-thumbnail" style="height: 200px" src="'.$filepath.$ds[ 'modulname' ].'/images/'.$ds['widgetdatei'].'.png" alt="">';
        } elseif(file_exists($filepath.$ds[ 'modulname' ].'/images/'.$ds['widgetdatei'].'.gif')){
            $pic='<img class="img-thumbnail" style="height: 200px" src="'.$filepath.$ds[ 'modulname' ].'/images/'.$ds['widgetdatei'].'.gif" alt="">';
        } else{
           $pic='<img class="img-thumbnail" style="height: 200px" src="../images/plugins/no-image.jpg" alt="">';
        }

      echo'
<tr>
<td>
<table><tr><td>
'.$pic.'
</td><td>
<span class="badge badge-secondary" style="width: 100%"><h5 style="color: #000">'.$ds['widgetname'].'</h5></span>
</td>
</tr>
</table>
</td>
<td><a href="admincenter.php?site=plugin_manager&action=edit&id='.$dp['pluginID'].'&do=edit" class="btn btn-warning" type="button">' . $_language->module[ 'edit' ] . '</a></td>
<td>' . $page_headlist . '</td>
</tr>

'; }
echo'<tr><td colspan="2">
            </td>
<td><input type="hidden" name="captcha_hash" value="'.$hash.'" /><input class="btn btn-success" type="submit" name="sorting_page_head" value="'.$_language->module[ 'sorting' ].'" /></td>
</tr>
  </tbody>
</table>
  </div>';


echo'
</div></div>
<div class="col-md-12">
  <div class="row">';


$moduls = safe_query("SELECT * FROM " . PREFIX . "settings_widgets WHERE position = 'head_section_widget' and themes_modulname= '".$db['modulname']."' ORDER BY sort");
echo'<div class="col-md-2 text-center"><img class="img-thumbnail" style="height: 250px;margin-bottom: 6px;" class="img-fluid" src="../images/plugins/head_section_widget.jpg"></div>
<div class="col-md-10"><table class="table table-striped">

<thead>
            <th style="width: 80%"><b>'.$_language->module[ 'plugin_name' ].'</b></th>
            <th style="width: 10%"><b>'.$_language->module[ 'actions' ].'</b></th>
            <th style="width: 10%"><b>'.$_language->module[ 'sort' ].'</b></th>
</thead>
<tbody>';
    while ($ds = mysqli_fetch_array($moduls)) {

    $xergebnis = safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='".$ds['modulname']."'");
    $dp = mysqli_fetch_array($xergebnis);

        $tmp = mysqli_fetch_assoc(safe_query("SELECT count(id) as cnt FROM " . PREFIX . "settings_widgets WHERE position = 'head_section_widget' and themes_modulname= '".$db['modulname']."'"));
        $anzhead_section = $tmp[ 'cnt' ];


        $head_sectionlist = '<select name="sorthead_section[]">';
                for ($n = 1; $n <= $anzhead_section; $n++) {
                    $head_sectionlist .= '<option value="' . $ds['id'] . '-' . $n . '">' . $n . '</option>';
                }
                $head_sectionlist .= '</select>';
                $head_sectionlist = str_replace(
                    'value="' . $ds['id'] . '-' . $ds[ 'sort' ] . '"',
                    'value="' . $ds['id'] . '-' . $ds[ 'sort' ] . '" selected="selected"',
                    $head_sectionlist
                );

        if(file_exists($filepath.$ds[ 'modulname' ].'/images/'.$ds['widgetdatei'].'.jpg')){
            $pic='<img class="img-thumbnail" style="height: 200px" src="'.$filepath.$ds[ 'modulname' ].'/images/'.$ds['widgetdatei'].'.jpg" alt="">';
        } elseif(file_exists($filepath.$ds[ 'modulname' ].'/images/'.$ds['widgetdatei'].'.jpeg')){
            $pic='<img class="img-thumbnail" style="height: 200px" src="'.$filepath.$ds[ 'modulname' ].'/images/'.$ds['widgetdatei'].'.jpeg" alt="">';
        } elseif(file_exists($filepath.$ds[ 'modulname' ].'/images/'.$ds['widgetdatei'].'.png')){
            $pic='<img class="img-thumbnail" style="height: 200px" src="'.$filepath.$ds[ 'modulname' ].'/images/'.$ds['widgetdatei'].'.png" alt="">';
        } elseif(file_exists($filepath.$ds[ 'modulname' ].'/images/'.$ds['widgetdatei'].'.gif')){
            $pic='<img class="img-thumbnail" style="height: 200px" src="'.$filepath.$ds[ 'modulname' ].'/images/'.$ds['widgetdatei'].'.gif" alt="">';
        } else{
           $pic='<img class="img-thumbnail" style="height: 200px" src="../images/plugins/no-image.jpg" alt="">';
        }

     echo'
<tr>
<td>
<table><tr><td>
'.$pic.'
</td><td>
<span class="badge badge-secondary" style="width: 100%"><h5 style="color: #000">'.$ds['widgetname'].'</h5></span>
</td>
</tr>
</table>
</td>
<td><a href="admincenter.php?site=plugin_manager&action=edit&id='.$dp['pluginID'].'&do=edit" class="btn btn-warning" type="button">' . $_language->module[ 'edit' ] . '</a></td>
<td>' . $head_sectionlist . '</td>
</tr>

'; }
echo'<tr><td colspan="2">
            </td>
<td><input type="hidden" name="captcha_hash" value="'.$hash.'" /><input class="btn btn-success" type="submit" name="sorting_head_section" value="'.$_language->module[ 'sorting' ].'" /></td>
</tr>
  </tbody>
</table>
  </div>';


  echo'
</div></div>
<div class="col-md-12">
  <div class="row">';


$moduls = safe_query("SELECT * FROM " . PREFIX . "settings_widgets WHERE position = 'left_side_widget' and themes_modulname= '".$db['modulname']."' ORDER BY sort");
echo'<div class="col-md-2 text-center"><img class="img-thumbnail" style="height: 250px;margin-bottom: 6px;" class="img-fluid" src="../images/plugins/left_side_widget.jpg"></div>
<div class="col-md-10"><table class="table table-striped">

<thead>
            <th style="width: 80%"><b>'.$_language->module[ 'plugin_name' ].'</b></th>
            <th style="width: 10%"><b>'.$_language->module[ 'actions' ].'</b></th>
            <th style="width: 10%"><b>'.$_language->module[ 'sort' ].'</b></th>
</thead>
<tbody>';
    while ($ds = mysqli_fetch_array($moduls)) {

    $xergebnis = safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='".$ds['modulname']."'");
    $dp = mysqli_fetch_array($xergebnis);

        $tmp = mysqli_fetch_assoc(safe_query("SELECT count(id) as cnt FROM " . PREFIX . "settings_widgets WHERE position = 'left_side_widget' and themes_modulname= '".$db['modulname']."'"));
        $anzleft_side = $tmp[ 'cnt' ];


        $left_sidelist = '<select name="sortleft_side[]">';
                for ($n = 1; $n <= $anzleft_side; $n++) {
                    $left_sidelist .= '<option value="' . $ds['id'] . '-' . $n . '">' . $n . '</option>';
                }
                $left_sidelist .= '</select>';
                $left_sidelist = str_replace(
                    'value="' . $ds['id'] . '-' . $ds[ 'sort' ] . '"',
                    'value="' . $ds['id'] . '-' . $ds[ 'sort' ] . '" selected="selected"',
                    $left_sidelist
                );

        if(file_exists($filepath.$ds[ 'modulname' ].'/images/'.$ds['widgetdatei'].'.jpg')){
            $pic='<img class="img-thumbnail" style="height: 200px" src="'.$filepath.$ds[ 'modulname' ].'/images/'.$ds['widgetdatei'].'.jpg" alt="">';
        } elseif(file_exists($filepath.$ds[ 'modulname' ].'/images/'.$ds['widgetdatei'].'.jpeg')){
            $pic='<img class="img-thumbnail" style="height: 200px" src="'.$filepath.$ds[ 'modulname' ].'/images/'.$ds['widgetdatei'].'.jpeg" alt="">';
        } elseif(file_exists($filepath.$ds[ 'modulname' ].'/images/'.$ds['widgetdatei'].'.png')){
            $pic='<img class="img-thumbnail" style="height: 200px" src="'.$filepath.$ds[ 'modulname' ].'/images/'.$ds['widgetdatei'].'.png" alt="">';
        } elseif(file_exists($filepath.$ds[ 'modulname' ].'/images/'.$ds['widgetdatei'].'.gif')){
            $pic='<img class="img-thumbnail" style="height: 200px" src="'.$filepath.$ds[ 'modulname' ].'/images/'.$ds['widgetdatei'].'.gif" alt="">';
        } else{
           $pic='<img class="img-thumbnail" style="height: 200px" src="../images/plugins/no-image.jpg" alt="">';
        }

      echo'
<tr>
<td>
<table><tr><td>
'.$pic.'
</td><td>
<span class="badge badge-secondary" style="width: 100%"><h5 style="color: #000">'.$ds['widgetname'].'</h5></span>
</td>
</tr>
</table>
</td>
<td><a href="admincenter.php?site=plugin_manager&action=edit&id='.$dp['pluginID'].'&do=edit" class="btn btn-warning" type="button">' . $_language->module[ 'edit' ] . '</a></td>
<td>' . $left_sidelist . '</td>
</tr>

'; }
echo'<tr><td colspan="2">
            </td>
<td><input type="hidden" name="captcha_hash" value="'.$hash.'" /><input class="btn btn-success" type="submit" name="sorting_left_side" value="'.$_language->module[ 'sorting' ].'" /></td>
</tr>
  </tbody>
</table>
  </div>';

 echo'
</div></div>
<div class="col-md-12">
  <div class="row">';



  $moduls = safe_query("SELECT * FROM " . PREFIX . "settings_widgets WHERE position = 'center_head_widget' and themes_modulname= '".$db['modulname']."' ORDER BY sort");
echo'<div class="col-md-2 text-center"><img class="img-thumbnail" style="height: 250px;margin-bottom: 6px;" class="img-fluid" src="../images/plugins/center_head_widget.jpg"></div>
<div class="col-md-10"><table class="table table-striped">

<thead>
            <th style="width: 80%"><b>'.$_language->module[ 'plugin_name' ].'</b></th>
            <th style="width: 10%"><b>'.$_language->module[ 'actions' ].'</b></th>
            <th style="width: 10%"><b>'.$_language->module[ 'sort' ].'</b></th>
</thead>
<tbody>';
    while ($ds = mysqli_fetch_array($moduls)) {

    $xergebnis = safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='".$ds['modulname']."'");
    $dp = mysqli_fetch_array($xergebnis);

        $tmp = mysqli_fetch_assoc(safe_query("SELECT count(id) as cnt FROM " . PREFIX . "settings_widgets WHERE position = 'center_head_widget' and themes_modulname= '".$db['modulname']."'"));
        $anzcenter_head = $tmp[ 'cnt' ];


        $center_headlist = '<select name="sortcenter_head[]">';
                for ($n = 1; $n <= $anzcenter_head; $n++) {
                    $center_headlist .= '<option value="' . $ds['id'] . '-' . $n . '">' . $n . '</option>';
                }
                $center_headlist .= '</select>';
                $center_headlist = str_replace(
                    'value="' . $ds['id'] . '-' . $ds[ 'sort' ] . '"',
                    'value="' . $ds['id'] . '-' . $ds[ 'sort' ] . '" selected="selected"',
                    $center_headlist
                );

        if(file_exists($filepath.$ds[ 'modulname' ].'/images/'.$ds['widgetdatei'].'.jpg')){
            $pic='<img class="img-thumbnail" style="height: 200px" src="'.$filepath.$ds[ 'modulname' ].'/images/'.$ds['widgetdatei'].'.jpg" alt="">';
        } elseif(file_exists($filepath.$ds[ 'modulname' ].'/images/'.$ds['widgetdatei'].'.jpeg')){
            $pic='<img class="img-thumbnail" style="height: 200px" src="'.$filepath.$ds[ 'modulname' ].'/images/'.$ds['widgetdatei'].'.jpeg" alt="">';
        } elseif(file_exists($filepath.$ds[ 'modulname' ].'/images/'.$ds['widgetdatei'].'.png')){
            $pic='<img class="img-thumbnail" style="height: 200px" src="'.$filepath.$ds[ 'modulname' ].'/images/'.$ds['widgetdatei'].'.png" alt="">';
        } elseif(file_exists($filepath.$ds[ 'modulname' ].'/images/'.$ds['widgetdatei'].'.gif')){
            $pic='<img class="img-thumbnail" style="height: 200px" src="'.$filepath.$ds[ 'modulname' ].'/images/'.$ds['widgetdatei'].'.gif" alt="">';
        } else{
           $pic='<img class="img-thumbnail" style="height: 200px" src="../images/plugins/no-image.jpg" alt="">';
        }

      echo'
<tr>
<td>
<table><tr><td>
'.$pic.'
</td><td>
<span class="badge badge-secondary" style="width: 100%"><h5 style="color: #000">'.$ds['widgetname'].'</h5></span>
</td>
</tr>
</table>
</td>
<td><a href="admincenter.php?site=plugin_manager&action=edit&id='.$dp['pluginID'].'&do=edit" class="btn btn-warning" type="button">' . $_language->module[ 'edit' ] . '</a></td>
<td>' . $center_headlist . '</td>
</tr>

'; }
echo'<tr><td colspan="2">
            </td>
<td><input type="hidden" name="captcha_hash" value="'.$hash.'" /><input class="btn btn-success" type="submit" name="sorting_center_head" value="'.$_language->module[ 'sorting' ].'" /></td>
</tr>
  </tbody>
</table>
  </div>';


echo'
</div></div>
<div class="col-md-12">
  <div class="row">';

  $moduls = safe_query("SELECT * FROM " . PREFIX . "settings_widgets WHERE position = 'center_footer_widget' and themes_modulname= '".$db['modulname']."' ORDER BY sort");
echo'<div class="col-md-2 text-center"><img class="img-thumbnail" style="height: 250px;margin-bottom: 6px;" class="img-fluid" src="../images/plugins/center_footer_widget.jpg"></div>
<div class="col-md-10"><table class="table table-striped">

<thead>
            <th style="width: 80%"><b>'.$_language->module[ 'plugin_name' ].'</b></th>
            <th style="width: 10%"><b>'.$_language->module[ 'actions' ].'</b></th>
            <th style="width: 10%"><b>'.$_language->module[ 'sort' ].'</b></th>
</thead>
<tbody>';
    while ($ds = mysqli_fetch_array($moduls)) {

    $xergebnis = safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='".$ds['modulname']."'");
    $dp = mysqli_fetch_array($xergebnis);

        $tmp = mysqli_fetch_assoc(safe_query("SELECT count(id) as cnt FROM " . PREFIX . "settings_widgets WHERE position = 'center_footer_widget' and themes_modulname= '".$db['modulname']."'"));
        $anzcenter_footer = $tmp[ 'cnt' ];


        $center_footerlist = '<select name="sortcenter_footer[]">';
                for ($n = 1; $n <= $anzcenter_footer; $n++) {
                    $center_footerlist .= '<option value="' . $ds['id'] . '-' . $n . '">' . $n . '</option>';
                }
                $center_footerlist .= '</select>';
                $center_footerlist = str_replace(
                    'value="' . $ds['id'] . '-' . $ds[ 'sort' ] . '"',
                    'value="' . $ds['id'] . '-' . $ds[ 'sort' ] . '" selected="selected"',
                    $center_footerlist
                );

        if(file_exists($filepath.$ds[ 'modulname' ].'/images/'.$ds['widgetdatei'].'.jpg')){
            $pic='<img class="img-thumbnail" style="height: 200px" src="'.$filepath.$ds[ 'modulname' ].'/images/'.$ds['widgetdatei'].'.jpg" alt="">';
        } elseif(file_exists($filepath.$ds[ 'modulname' ].'/images/'.$ds['widgetdatei'].'.jpeg')){
            $pic='<img class="img-thumbnail" style="height: 200px" src="'.$filepath.$ds[ 'modulname' ].'/images/'.$ds['widgetdatei'].'.jpeg" alt="">';
        } elseif(file_exists($filepath.$ds[ 'modulname' ].'/images/'.$ds['widgetdatei'].'.png')){
            $pic='<img class="img-thumbnail" style="height: 200px" src="'.$filepath.$ds[ 'modulname' ].'/images/'.$ds['widgetdatei'].'.png" alt="">';
        } elseif(file_exists($filepath.$ds[ 'modulname' ].'/images/'.$ds['widgetdatei'].'.gif')){
            $pic='<img class="img-thumbnail" style="height: 200px" src="'.$filepath.$ds[ 'modulname' ].'/images/'.$ds['widgetdatei'].'.gif" alt="">';
        } else{
           $pic='<img class="img-thumbnail" style="height: 200px" src="../images/plugins/no-image.jpg" alt="">';
        }

      echo'
<tr>
<td>
<table><tr><td>
'.$pic.'
</td><td>
<span class="badge badge-secondary" style="width: 100%"><h5 style="color: #000">'.$ds['widgetname'].'</h5></span>
</td>
</tr>
</table>
</td>
<td><a href="admincenter.php?site=plugin_manager&action=edit&id='.$dp['pluginID'].'&do=edit" class="btn btn-warning" type="button">' . $_language->module[ 'edit' ] . '</a></td>
<td>' . $center_footerlist . '</td>
</tr>
'; }
echo'<tr><td colspan="2">
            </td>
<td><input type="hidden" name="captcha_hash" value="'.$hash.'" /><input class="btn btn-success" type="submit" name="sorting_center_footer" value="'.$_language->module[ 'sorting' ].'" /></td>
</tr>
  </tbody>
</table>
  </div>';

echo'
</div></div>
<div class="col-md-12">
  <div class="row">';



$moduls = safe_query("SELECT * FROM " . PREFIX . "settings_widgets WHERE position = 'right_side_widget' and themes_modulname= '".$db['modulname']."' ORDER BY sort");
echo'<div class="col-md-2 text-center"><img class="img-thumbnail" style="height: 250px;margin-bottom: 6px;" class="img-fluid" src="../images/plugins/right_side_widget.jpg"></div>
<div class="col-md-10"><table class="table table-striped">

<thead>
            <th style="width: 80%"><b>'.$_language->module[ 'plugin_name' ].'</b></th>
            <th style="width: 10%"><b>'.$_language->module[ 'actions' ].'</b></th>
            <th style="width: 10%"><b>'.$_language->module[ 'sort' ].'</b></th>
</thead>
<tbody>';

    while ($ds = mysqli_fetch_array($moduls)) {

    $xergebnis = safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='".$ds['modulname']."'");
    $dp = mysqli_fetch_array($xergebnis);

        $tmp = mysqli_fetch_assoc(safe_query("SELECT count(id) as cnt FROM " . PREFIX . "settings_widgets WHERE position = 'right_side_widget' and themes_modulname= '".$db['modulname']."'"));
        $anzright_side = $tmp[ 'cnt' ];


        $right_sidelist = '<select name="sortright_side[]">';
                for ($n = 1; $n <= $anzright_side; $n++) {
                    $right_sidelist .= '<option value="' . $ds['id'] . '-' . $n . '">' . $n . '</option>';
                }
                $right_sidelist .= '</select>';
                $right_sidelist = str_replace(
                    'value="' . $ds['id'] . '-' . $ds[ 'sort' ] . '"',
                    'value="' . $ds['id'] . '-' . $ds[ 'sort' ] . '" selected="selected"',
                    $right_sidelist
                );

        if(file_exists($filepath.$ds[ 'modulname' ].'/images/'.$ds['widgetdatei'].'.jpg')){
            $pic='<img class="img-thumbnail" style="height: 200px" src="'.$filepath.$ds[ 'modulname' ].'/images/'.$ds['widgetdatei'].'.jpg" alt="">';
        } elseif(file_exists($filepath.$ds[ 'modulname' ].'/images/'.$ds['widgetdatei'].'.jpeg')){
            $pic='<img class="img-thumbnail" style="height: 200px" src="'.$filepath.$ds[ 'modulname' ].'/images/'.$ds['widgetdatei'].'.jpeg" alt="">';
        } elseif(file_exists($filepath.$ds[ 'modulname' ].'/images/'.$ds['widgetdatei'].'.png')){
            $pic='<img class="img-thumbnail" style="height: 200px" src="'.$filepath.$ds[ 'modulname' ].'/images/'.$ds['widgetdatei'].'.png" alt="">';
        } elseif(file_exists($filepath.$ds[ 'modulname' ].'/images/'.$ds['widgetdatei'].'.gif')){
            $pic='<img class="img-thumbnail" style="height: 200px" src="'.$filepath.$ds[ 'modulname' ].'/images/'.$ds['widgetdatei'].'.gif" alt="">';
        } else{
           $pic='<img class="img-thumbnail" style="height: 200px" src="../images/plugins/no-image.jpg" alt="">';
        }

      echo'
<tr>
<td>
<table><tr><td>
'.$pic.'
</td><td>
<span class="badge badge-secondary" style="width: 100%"><h5 style="color: #000">'.$ds['widgetname'].'</h5></span>
</td>
</tr>
</table>
</td>
<td><a href="admincenter.php?site=plugin_manager&action=edit&id='.$dp['pluginID'].'&do=edit" class="btn btn-warning" type="button">' . $_language->module[ 'edit' ] . '</a></td>
<td>' . $right_sidelist . '</td>
</tr>

'; }
echo'<tr><td colspan="2">
            </td>
<td><input type="hidden" name="captcha_hash" value="'.$hash.'" /><input class="btn btn-success" type="submit" name="sorting_right_side" value="'.$_language->module[ 'sorting' ].'" /></td>
</tr>
  </tbody>
</table>
  </div>';


echo'
</div></div>
<div class="col-md-12">
  <div class="row">';


$moduls = safe_query("SELECT * FROM " . PREFIX . "settings_widgets WHERE position = 'foot_section_widget' and themes_modulname= '".$db['modulname']."' ORDER BY sort");
echo'<div class="col-md-2 text-center"><img class="img-thumbnail" style="height: 250px;margin-bottom: 6px;" class="img-fluid" src="../images/plugins/foot_section_widget.jpg"></div>
<div class="col-md-10"><table class="table table-striped">

<thead>
            <th style="width: 80%"><b>'.$_language->module[ 'plugin_name' ].'</b></th>
            <th style="width: 10%"><b>'.$_language->module[ 'actions' ].'</b></th>
            <th style="width: 10%"><b>'.$_language->module[ 'sort' ].'</b></th>
</thead>
<tbody>';
    while ($ds = mysqli_fetch_array($moduls)) {

    $xergebnis = safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='".$ds['modulname']."'");
    $dp = mysqli_fetch_array($xergebnis);

        $tmp = mysqli_fetch_assoc(safe_query("SELECT count(id) as cnt FROM " . PREFIX . "settings_widgets WHERE position = 'foot_section_widget' and themes_modulname= '".$db['modulname']."'"));
        $anzfoot_section = $tmp[ 'cnt' ];


        $foot_sectionlist = '<select name="sortfoot_section[]">';
                for ($n = 1; $n <= $anzfoot_section; $n++) {
                    $foot_sectionlist .= '<option value="' . $ds['id'] . '-' . $n . '">' . $n . '</option>';
                }
                $foot_sectionlist .= '</select>';
                $foot_sectionlist = str_replace(
                    'value="' . $ds['id'] . '-' . $ds[ 'sort' ] . '"',
                    'value="' . $ds['id'] . '-' . $ds[ 'sort' ] . '" selected="selected"',
                    $foot_sectionlist
                );
        if(file_exists($filepath.$ds[ 'modulname' ].'/images/'.$ds['widgetdatei'].'.jpg')){
            $pic='<img class="img-thumbnail" style="height: 200px" src="'.$filepath.$ds[ 'modulname' ].'/images/'.$ds['widgetdatei'].'.jpg" alt="">';
        } elseif(file_exists($filepath.$ds[ 'modulname' ].'/images/'.$ds['widgetdatei'].'.jpeg')){
            $pic='<img class="img-thumbnail" style="height: 200px" src="'.$filepath.$ds[ 'modulname' ].'/images/'.$ds['widgetdatei'].'.jpeg" alt="">';
        } elseif(file_exists($filepath.$ds[ 'modulname' ].'/images/'.$ds['widgetdatei'].'.png')){
            $pic='<img class="img-thumbnail" style="height: 200px" src="'.$filepath.$ds[ 'modulname' ].'/images/'.$ds['widgetdatei'].'.png" alt="">';
        } elseif(file_exists($filepath.$ds[ 'modulname' ].'/images/'.$ds['widgetdatei'].'.gif')){
            $pic='<img class="img-thumbnail" style="height: 200px" src="'.$filepath.$ds[ 'modulname' ].'/images/'.$ds['widgetdatei'].'.gif" alt="">';
        } else{
           $pic='<img class="img-thumbnail" style="height: 200px" src="../images/plugins/no-image.jpg" alt="">';
        }

      echo'
<tr>
<td>
<table><tr><td>
'.$pic.'
</td><td>
<span class="badge badge-secondary" style="width: 100%"><h5 style="color: #000">'.$ds['widgetname'].'</h5></span>
</td>
</tr>
</table>
</td>
<td><a href="admincenter.php?site=plugin_manager&action=edit&id='.$dp['pluginID'].'&do=edit" class="btn btn-warning" type="button">' . $_language->module[ 'edit' ] . '</a></td>
<td>' . $foot_sectionlist . '</td>
</tr>

'; }
echo'<tr><td colspan="2">
            </td>
<td><input type="hidden" name="captcha_hash" value="'.$hash.'" /><input class="btn btn-success" type="submit" name="sorting_foot_section" value="'.$_language->module[ 'sorting' ].'" /></td>
</tr>
  </tbody>
</table>
  </div>';


  echo'
</div></div>
<div class="col-md-12">
  <div class="row">';


  $moduls = safe_query("SELECT * FROM " . PREFIX . "settings_widgets WHERE position = 'page_footer_widget' and themes_modulname= '".$db['modulname']."' ORDER BY sort");
echo'<div class="col-md-2 text-center"><img class="img-thumbnail" style="height: 250px;margin-bottom: 6px;" class="img-fluid" src="../images/plugins/page_footer_widget.jpg"></div>
<div class="col-md-10"><table class="table table-striped">

<thead>
            <th style="width: 80%"><b>'.$_language->module[ 'plugin_name' ].'</b></th>
            <th style="width: 10%"><b>'.$_language->module[ 'actions' ].'</b></th>
            <th style="width: 10%"><b>'.$_language->module[ 'sort' ].'</b></th>
</thead>
<tbody>';
    while ($ds = mysqli_fetch_array($moduls)) {

    $xergebnis = safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='".$ds['modulname']."'");
    $dp = mysqli_fetch_array($xergebnis);  

        $tmp = mysqli_fetch_assoc(safe_query("SELECT count(id) as cnt FROM " . PREFIX . "settings_widgets WHERE position = 'page_footer_widget' and themes_modulname= '".$db['modulname']."'"));
        $anzpage_footer = $tmp[ 'cnt' ];


        $page_footerlist = '<select name="sortpage_footer[]">';
                for ($n = 1; $n <= $anzpage_footer; $n++) {
                    $page_footerlist .= '<option value="' . $ds['id'] . '-' . $n . '">' . $n . '</option>';
                }
                $page_footerlist .= '</select>';
                $page_footerlist = str_replace(
                    'value="' . $ds['id'] . '-' . $ds[ 'sort' ] . '"',
                    'value="' . $ds['id'] . '-' . $ds[ 'sort' ] . '" selected="selected"',
                    $page_footerlist
                );

        if(file_exists($filepath.$ds[ 'modulname' ].'/images/'.$ds['widgetdatei'].'.jpg')){
            $pic='<img class="img-thumbnail" style="height: 200px" src="'.$filepath.$ds[ 'modulname' ].'/images/'.$ds['widgetdatei'].'.jpg" alt="">';
        } elseif(file_exists($filepath.$ds[ 'modulname' ].'/images/'.$ds['widgetdatei'].'.jpeg')){
            $pic='<img class="img-thumbnail" style="height: 200px" src="'.$filepath.$ds[ 'modulname' ].'/images/'.$ds['widgetdatei'].'.jpeg" alt="">';
        } elseif(file_exists($filepath.$ds[ 'modulname' ].'/images/'.$ds['widgetdatei'].'.png')){
            $pic='<img class="img-thumbnail" style="height: 200px" src="'.$filepath.$ds[ 'modulname' ].'/images/'.$ds['widgetdatei'].'.png" alt="">';
        } elseif(file_exists($filepath.$ds[ 'modulname' ].'/images/'.$ds['widgetdatei'].'.gif')){
            $pic='<img class="img-thumbnail" style="height: 200px" src="'.$filepath.$ds[ 'modulname' ].'/images/'.$ds['widgetdatei'].'.gif" alt="">';
        } else{
           $pic='<img class="img-thumbnail" style="height: 200px" src="../images/plugins/no-image.jpg" alt="">';
        }

 echo'
<tr>
<td>
<table><tr><td>
'.$pic.'
</td><td>
<span class="badge badge-secondary" style="width: 100%"><h5 style="color: #000">'.$ds['widgetname'].'</h5></span>
</td>
</tr>
</table>
</td>
<td><a href="admincenter.php?site=plugin_manager&action=edit&id='.$dp['pluginID'].'&do=edit" class="btn btn-warning" type="button">' . $_language->module[ 'edit' ] . '</a></td>
<td>' . $page_footerlist . '</td>
</tr>


'; }
echo'<tr><td colspan="2">
            </td>
<td><input type="hidden" name="captcha_hash" value="'.$hash.'" /><input class="btn btn-success" type="submit" name="sorting_page_footer" value="'.$_language->module[ 'sorting' ].'" /></td>
</tr>
  </tbody>
</table>
  </div>';


echo'</div></div>';



echo'.</div></div></div> ';

} else {

    echo '<style type="text/css">
 p.test {
    font-family: Georgia, serif;
    font-size: 78px;
    font-style: italic;
}
.titlehead {
    border: 3px solid;
    border-color: #c4183c; 
    background-color: #fff}
</style>
<div class="card">
    <div class="card-body">
        <div class="titlehead"><br>
            <center>
        <div>
            <img class="img-fluid" src="/images/install-logo.jpg" alt="" style="height: 150px"/><br>
              <small>Ohje !</small><br>
              <p class="test">404 Error.</p><br>
              '.$_language->module["info"].'
        </div>
        <br />
              <p><a class="btn btn-warning" href="/admin/admincenter.php?site=settings_templates">'.$_language->module["activate_template"].'</a></p>
              <br />
            </center>
        </div>
    </div>
</div>

';}
