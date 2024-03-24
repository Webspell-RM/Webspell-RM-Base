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

$_language->readModule('settings', false, true);

$ergebnis = safe_query("SELECT * FROM ".PREFIX."navigation_dashboard_links WHERE modulname='ac_settings'");
    while ($db=mysqli_fetch_array($ergebnis)) {
      $accesslevel = 'is'.$db['accesslevel'].'admin';

if (!$accesslevel($userID) || mb_substr(basename($_SERVER[ 'REQUEST_URI' ]), 0, 15) != "admincenter.php") {
    die($_language->module[ 'access_denied' ]);
}
}

if (isset($_GET[ 'action' ])) {
    $action = $_GET[ 'action' ];
} else {
    $action = '';
}


#==== Allgemeine Einstellungen=============#
if ($action == "") {  


if(isset($_POST['submit'])) {
    $web_key = $_POST['webkey'];
    $sec_key = $_POST['seckey'];
    if (isset($_POST['onoff'])) {
        $chk = 1;
    } else { $chk = 0; }
    $run = safe_query("UPDATE ".PREFIX."settings_recaptcha SET activated='".$chk."', webkey='".$web_key."', seckey='".$sec_key."'");


    if($run) { 
        echo $_language->module[ 'success' ]; 
    } else { 
        echo $_language->module[ 'failed' ]; 
    }

} else {
    
    $get = mysqli_fetch_assoc(safe_query("SELECT * FROM `".PREFIX."settings_recaptcha`"));
    $webkey = $get['webkey'];
    $seckey = $get['seckey'];
    if ($get['activated']=="1") { $chk = 'checked="checked"'; } else { $chk = ''; }
}

if(isset($_POST['submit'])) {
    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_POST[ 'captcha_hash' ])) {
        safe_query(
            "UPDATE
                " . PREFIX . "settings
            SET
                title='" . $_POST[ 'title' ] . "',
                hpurl='" . $_POST[ 'url' ] . "',
                clanname='" . $_POST[ 'clanname' ] . "',
                clantag='" . $_POST[ 'clantag' ] . "',
                adminname='" . $_POST[ 'admname' ] . "',
                adminemail='" . $_POST[ 'admmail' ] . "',
                sessionduration='" . $_POST[ 'sessionduration' ] . "',
                default_language='" . $_POST[ 'language' ] . "',
                search_min_len='" . $_POST[ 'searchminlen' ] . "',
                max_wrong_pw='" . intval($_POST[ 'max_wrong_pw' ]) . "',
                captcha_type='" . intval($_POST[ 'captcha_type' ]) . "',
                captcha_bgcol='" . $_POST[ 'captcha_bgcol' ] . "',
                captcha_fontcol='" . $_POST[ 'captcha_fontcol' ] . "',
                captcha_math='" . $_POST[ 'captcha_math' ] . "',
                captcha_noise='" . $_POST[ 'captcha_noise' ] . "',
                captcha_linenoise='" . $_POST[ 'captcha_linenoise' ] . "',
                spam_check='" . isset($_POST[ 'spam_check' ]) . "',
                detect_language='" . isset($_POST[ 'detectLanguage' ]) . "',
                date_format='" . $_POST[ 'date_format' ] . "',
                time_format='" . $_POST[ 'time_format' ] . "',
                register_per_ip='"  . isset($_POST[ 'register_per_ip' ]) . "',
                forum_double='" . isset($_POST[ 'forumdouble' ]) . "',
                startpage='"  . $_POST[ 'startpage' ] . "',
                profilelast='" . $_POST[ 'lastposts' ] . "',
                de_lang='" . isset($_POST[ 'de_lang' ]) . "',
                en_lang='" . isset($_POST[ 'en_lang' ]) . "',
                it_lang='" . isset($_POST[ 'it_lang' ]) . "'"
        );
        
        redirect("admincenter.php?site=settings", $_language->module[ 'updated_successfully' ], 2);
    } else {
        redirect("admincenter.php?site=settings", $_language->module[ 'transaction_invalid' ], 3);  
    }
} else {


    $settings = safe_query("SELECT * FROM " . PREFIX . "settings");
    $ds = mysqli_fetch_array($settings);

        
    if ($ds[ 'register_per_ip' ]) {
        $register_per_ip = '<input class="form-check-input" type="checkbox" name="register_per_ip" value="1" checked="checked" />';
    } else {
        $register_per_ip = '<input class="form-check-input" type="checkbox" name="register_per_ip" value="1" />';
    }

    if ($ds[ 'spam_check' ]) {
        $spam_check = '<input class="form-check-input" type="checkbox" name="spam_check" value="1" checked="checked" />';
    } else {
        $spam_check = '<input class="form-check-input" type="checkbox" name="spam_check" value="1" />';
    }

    if ($ds[ 'detect_language' ]) {
        $visitor_language = '<input class="form-check-input" type="checkbox" name="detectLanguage" value="1" checked="checked" />';
    } else {
        $visitor_language = '<input class="form-check-input" type="checkbox" name="detectLanguage" value="1" />';
    }

    if ($ds[ 'forum_double' ]) {
        $forum_double = '<input class="form-check-input" type="checkbox" name="forumdouble" value="1" checked="checked" />';
    } else {
        $forum_double = '<input class="form-check-input" type="checkbox" name="forumdouble" value="1" />';
    }
    
    
    $langdirs = '';
    $filepath = "../languages/";


    $langs = array();
    if ($dh = opendir($filepath)) {
        while ($file = mb_substr(readdir($dh), 0, 2)) {
            if ($file != "." && $file != ".." && is_dir($filepath . $file)) {
                if (isset($mysql_langs[ $file ])) {
                    $name = $mysql_langs[ $file ];
                    $name = ucfirst($name);
                    $langs[ $name ] = $file;
                } else {
                    $langs[ $file ] = $file;
                }
            }
        }
        closedir($dh);
    }
    ksort($langs, SORT_NATURAL);
    foreach ($langs as $lang => $flag) {
        $langdirs .= '<option value="'.$flag .'">'.$lang .'</option>';
    }
    $lang = $default_language;
    $langdirs = str_replace('value="'.$lang .'"', 'value="'.$lang .'" selected="selected"', $langdirs);

    $captcha_style = "<option value='0'>" . $_language->module[ 'captcha_only_text' ] . "</option><option value='2'>" .
        $_language->module[ 'captcha_both' ] . "</option><option value='1'>" .
        $_language->module[ 'captcha_only_math' ] . "</option>";
    $captcha_style = str_replace(
        "value='" . $ds[ 'captcha_math' ] . "'",
        "value='" . $ds[ 'captcha_math' ] . "' selected='selected'",
        $captcha_style
    );

    $captcha_type = "<option value='0'>" . $_language->module[ 'captcha_text' ] . "</option><option value='2'>" .
        $_language->module[ 'captcha_autodetect' ] . "</option><option value='1'>" .
        $_language->module[ 'captcha_image' ] . "</option>";
    $captcha_type = str_replace(
        "value='" . $ds[ 'captcha_type' ] . "'",
        "value='" . $ds[ 'captcha_type' ] . "' selected='selected'",
        $captcha_type
    );

    

    $format_date = "<option value='d.m.y'>DD.MM.YY</option>
                    <option value='d.m.Y'>DD.MM.YYYY</option>
                    <option value='j.n.y'>D.M.YY</option>
                    <option value='j.n.Y'>D.M.YYYY</option>
                    <option value='y-m-d'>YY-MM-DD</option>
                    <option value='Y-m-d'>YYYY-MM-DD</option>
                    <option value='y/m/d'>YY/MM/DD</option>
                    <option value='Y/m/d'>YYYY/MM/DD</option>";
    $format_date = str_replace(
        "value='" . $ds[ 'date_format' ] . "'",
        "value='" . $ds[ 'date_format' ] . "' selected='selected'",
        $format_date
    );

    $format_time = "<option value='G:i'>H:MM</option>
                    <option value='H:i'>HH:MM</option>
                    <option value='G:i a'>H:MM am/pm</option>
                    <option value='H:i a'>HH:MM am/pm</option>
                    <option value='G:i A'>H:MM AM/PM</option>
                    <option value='H:i A'>HH:MM AM/PM</option>
                    <option value='G:i:s'>H:MM:SS</option>
                    <option value='H:i:s'>HH:MM:SS</option>
                    <option value='G:i:s a'>H:MM:SS am/pm</option>
                    <option value='H:i:s a'>HH:MM:SS am/pm</option>
                    <option value='G:i:s A'>H:MM:SS AM/PM</option>
                    <option value='H:i:s A'>HH:MM:SS AM/PM</option>";
    $format_time = str_replace(
        "value='" . $ds[ 'time_format' ] . "'",
        "value='" . $ds[ 'time_format' ] . "' selected='selected'",
        $format_time
    );

    if ($ds[ 'de_lang' ]) {
        $de_lang = '<input class="form-check-input" type="checkbox" name="de_lang" value="1" checked="checked" />';
    } else {
        $de_lang = '<input class="form-check-input" type="checkbox" name="de_lang" value="1" />';
    }

    if ($ds[ 'en_lang' ]) {
        $en_lang = '<input class="form-check-input" type="checkbox" name="en_lang" value="1" checked="checked" />';
    } else {
        $en_lang = '<input class="form-check-input" type="checkbox" name="en_lang" value="1" />';
    }

    if ($ds[ 'it_lang' ]) {
        $it_lang = '<input class="form-check-input" type="checkbox" name="it_lang" value="1" checked="checked" />';
    } else {
        $it_lang = '<input class="form-check-input" type="checkbox" name="it_lang" value="1" />';
    }


echo'<div class="card">
        <div class="card-header">
            '. $_language->module[ 'settings' ] .'
            </div>
            <div class="card-body">';    
echo'
    <a href="admincenter.php?site=settings" class="btn btn-primary disabled" type="button">'.$_language->module[ 'settings' ] .'</a>
    <a href="admincenter.php?site=settings&action=social_setting" class="btn btn-primary" type="button">'.$_language->module[ 'social_settings' ] .'</a>';



    $CAPCLASS = new \webspell\Captcha;
    $CAPCLASS->createTransaction();
    $hash = $CAPCLASS->getHash();
    

echo'<div class="">
    <form class="form-horizontal" method="post" id="post" name="post" action="admincenter.php?site=settings" onsubmit="return chkFormular();">

        <div class="card">
        <div class="card-header">
            '.$_language->module[ 'settings' ].' 
        </div>
            <div class="card-body">
       
                <div class="row">
                    <div class="col-md-6">
                    <div class="mb-3 row">
                            <div class="col-md-4">
                                '.$_language->module['page_title'].' :
                            </div>

                            <div class="col-md-8">
                            <span class="text-muted mdall"><em data-toggle="tooltip" data-html="true" title="'.$_language->module['tooltip_2'].'"><input class="form-control" name="title" type="text" value="'.$ds['title'].'" size="35"></em></span>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <div class="col-md-4">
                                '.$_language->module['clan_name'].' :
                            </div>

                            <div class="col-md-8">
                                <span class="text-muted mdall"><em data-toggle="tooltip" data-html="true" title="'.$_language->module['tooltip_3'].'"><input class="form-control" type="text" name="clanname" value="'.$ds['clanname'].'" size="35"></em></span>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <div class="col-md-4">
                                '.$_language->module['admin_name'].' :
                            </div>

                            <div class="col-md-8">
                                <span class="text-muted mdall"><em data-toggle="tooltip" data-html="true" title="'.$_language->module[ 'tooltip_5' ].'"><input class="form-control" type="text" name="admname" value="'.$ds['adminname'].'" size="35" ></em></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3 row">
                            <div class="col-md-4">
                                '.$_language->module['page_url'].' :
                            </div>

                            <div class="col-md-8">
                                <span class="text-muted mdall"><em data-toggle="tooltip" data-html="true" title="'.$_language->module[ 'tooltip_1' ].'"><input class="form-control" type="url" name="url" value="'.$ds['hpurl'].'" size="35"></em></span>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <div class="col-md-4">
                                '.$_language->module['clan_tag'].' :
                            </div>

                            <div class="col-md-8">
                                <span class="text-muted mdall"><em data-toggle="tooltip" data-html="true" title="'.$_language->module[ 'tooltip_4' ].'"><input class="form-control" type="text" name="clantag" value="'.$ds['clantag'].'" size="35"></em></span>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <div class="col-md-4">
                                '.$_language->module['admin_email'].' :
                            </div>

                            <div class="col-md-8">
                                <span class="text-muted mdall"><em data-toggle="tooltip" data-html="true" title="'.$_language->module[ 'tooltip_6' ].'"><input class="form-control" type="text" name="admmail" value="'.$ds['adminemail'].'" size="35"></em></span>
                            </div>
                        </div>
                    </div>
               </div>
</div></div>
       
<div class="card">
        <div class="card-header">
            '.$_language->module['additional_options_startpage'].' 
        </div>
            <div class="card-body">
                <div class="row">
                    

                    <div class="col-md-6">
                        <div class="mb-3 row">
                            <div class="col-md-4">
                                '.$_language->module['additional_options'].' :
                            </div>

                            <div class="col-md-8"><a class="btn btn-danger" href="admincenter.php?site=lock">'.$_language->module['pagelock'].' </a>
                            </div>
                        </div>
                    </div>';



        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='news_manager'"));
        if (@$dx[ 'modulname' ] != 'news_manager') {
        
        } else {
        $news = "<option value='news_manager'>News Manager</option>";
        }

        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='about_us'"));
        if (@$dx[ 'modulname' ] != 'about_us') {
        
        } else {
        $about = "<option value='about_us'>About us</option>";
        }

        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='history'"));
        if (@$dx[ 'modulname' ] != 'history') {
        
        } else {
        $history = "<option value='history'>History</option>";
        }

        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='calendar'"));
        if (@$dx[ 'modulname' ] != 'calendar') {
        
        } else {
        $calendar = "<option value='calendar'>Calendar</option>";
        }

        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='blog'"));
        if (@$dx[ 'modulname' ] != 'blog') {
        
        } else {
        $blog = "<option value='blog'>Blog</option>";
        }

        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='forum'"));
        if (@$dx[ 'modulname' ] != 'forum') {
        
        } else {
        $forum = "<option value='forum'>Forum</option>";
        }

        $widget_alle = "<option value='blank'>" . $_language->module[ 'no_startpage' ] . "</option>
        <option value='startpage'>Startpage</option>
        '".@$news."'
        '".@$about."'
        '".@$history."'
        '".@$calendar."'
        '".@$blog."'
        '".@$forum."'



        ";

        $widget_startpage = str_replace(
            "value='" . $ds[ 'startpage' ] . "'",
            "value='" . $ds[ 'startpage' ] . "' selected='selected'",
            $widget_alle
        );

echo'<div class="col-md-6">

                        <div class="mb-3 row">
                            <div class="col-md-4">
                                '.$_language->module['startpage'].' :
                            </div>

                            <div class="col-md-8">
                                <span class="text-muted mdall"><em data-toggle="tooltip" data-html="true" title="'.$_language->module[ 'tooltip_64' ].'">
                                <!--<input class="form-control" type="text" name="startpage" value="'.$ds['startpage'].'" size="35">-->

                               <!--<select id="startpage" name="startpage" class="form-select">'.$widget_startpage.'</select>-->
                               <select class="form-select" name="startpage">'.$widget_startpage.'</select>
                                            </em></span>
                            </div>
                        </div>
                    </div>
</div>                
 </div>  
   </div>  ';
   $settings = safe_query("SELECT * FROM " . PREFIX . "settings_recaptcha");
    $dx = mysqli_fetch_array($settings);
    echo'      
      
<div class="card">
        <div class="card-header">
            '.$_language->module['reCaptcha'].' 
        </div>
            <div class="card-body">

    <div class="row">
        <div class="col-md-6">
            <div class="mb-3 row">
                <label class="col-md-12">
            '.$_language->module[ 'important_text' ].' </label></div>
        </div>    

        <div class="col-md-6">
            <div class="mb-3 row">
                <label class="col-md-4 control-label">'.$_language->module['web-key'].' :</label>
                <div class="col-md-8"><span class="text-muted mdall"><em><input class="form-control" type="text" name="webkey" value="'.$dx['webkey'].'"></em></span>
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-md-4 control-label">'.$_language->module['secret-key'].' :</label>
                <div class="col-md-8"><span class="text-muted mdall"><em><input class="form-control" type="text" name="seckey" value="'.$dx['seckey'].'"></em></span>
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-md-4 control-label">'.$_language->module['activate'].' :</label>
                <div class="col-md-8 form-check form-switch" style="padding: 0px 43px;">
                <input class="form-check-input" type="checkbox" name="onoff" value="1" '.$chk .'  >
                </div>
            </div>
        </div>
    </div>


</div></div>


<div class="card">
        <div class="card-header">
            '.$_language->module['captcha'].' 
        </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3 row">
                            <div class="col-md-4">
                                '.$_language->module['captcha_type'].' :
                            </div>

                            <div class="col-md-8">
                                <span class="pull-left text-muted mdall"><em data-toggle="tooltip" data-html="true" title="'.$_language->module[ 'tooltip_44' ].'"><select class="form-select" name="captcha_type">
                                    '.$captcha_type .'
                                </select></em></span>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <div class="col-md-4">
                                '.$_language->module['captcha_bgcol'].' :
                            </div>

                            <div class="col-md-8">
                                <span class="pull-left text-muted mdall"><em data-toggle="tooltip" data-html="true" title="'.$_language->module[ 'tooltip_45' ].'"><input class="form-control" type="text" name="captcha_bgcol" size="8" value="'.$ds['captcha_bgcol'].'"></em></span>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <div class="col-md-4">
                                '.$_language->module['captcha_fontcol'].' :
                            </div>

                            <div class="col-md-8">
                                <span class="pull-left text-muted mdall"><em data-toggle="tooltip" data-html="true" title="'.$_language->module[ 'tooltip_46' ].'"><input class="form-control" type="text" name="captcha_fontcol" size="8" value="'.$ds['captcha_fontcol'].'"></em></span>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="mb-3 row">
                            <div class="col-md-4">
                                '.$_language->module['captcha_style'].' :
                            </div>

                            <div class="col-md-8">
                                <span class="pull-left text-muted mdall"><em data-toggle="tooltip" data-html="true" title="'.$_language->module[ 'tooltip_47' ].'"><select class="form-select" name="captcha_math">
                                    '.$captcha_style .'
                                </select></em></span>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <div class="col-md-4">
                                '.$_language->module['captcha_noise'].' :
                            </div>

                            <div class="col-md-8">
                                <span class="pull-left text-muted mdall"><em data-toggle="tooltip" data-html="true" title="'.$_language->module[ 'tooltip_48' ].'"><input class="form-control" type="text" name="captcha_noise" size="3" value="'.$ds['captcha_noise'].'"></em></span>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <div class="col-md-4">
                                '.$_language->module['captcha_linenoise'].' :
                            </div>

                            <div class="col-md-8">
                                <span class="pull-left text-muted mdall"><em data-toggle="tooltip" data-html="true" title="'.$_language->module[ 'tooltip_49' ].'"><input class="form-control" type="text" name="captcha_linenoise" size="3" value="'.$ds['captcha_linenoise'].'"></em></span>
                            </div>
                        </div>
                    </div>



</div></div></div>




<div class="card">
        <div class="card-header">
            '.$_language->module['other'].' 
        </div>
            <div class="card-body">


                <div class="row">
                    <div class="col-md-6">
                                   
                                        
                                    <div class="mb-3 row">
                                        <div class="col-md-4">
                                            '.$_language->module[ 'format_date' ].' :
                                        </div>

                                        <div class="col-md-8">
                                            <span class="pull-left text-muted mdall"><em data-toggle="tooltip" data-html="true" title="'.$_language->module[ 'tooltip_58' ].'"><select class="form-select" name="date_format" style="text-align: right;">
                                                '.$format_date.' 
                                            </select></em></span>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <div class="col-md-4">
                                            '.$_language->module[ 'format_time' ].' :
                                        </div>

                                        <div class="col-md-8">
                                            <span class="pull-left text-muted mdall"><em data-toggle="tooltip" data-html="true" title="'.$_language->module[ 'tooltip_59' ].'"><select class="form-select" name="time_format" style="text-align: right;">
                                                '.$format_time.' 
                                            </select></em></span>
                                        </div>
                                    </div>
                                
                                    <div class="mb-3 row">
                                        <div class="col-md-4">
                                            '.$_language->module['default_language'].' :
                                        </div>

                                        <div class="col-md-8">
                                            <span class="pull-left text-muted mdall"><em data-toggle="tooltip" data-html="true" title="'.$_language->module[ 'tooltip_40' ].'"><select class="form-select" name="language">
                                                '.$langdirs.' 
                                            </select></em></span>
                                        </div>
                                    </div>

                                    


                                    <div class="mb-3 row">
                                        <div class="col-md-12">'.$_language->module['language_navi'].' </div>
                                        </div><div class="mb-3 row">
                                        <div class="col-md-4">
                                            '.$_language->module['de_language'].' :
                                        </div>

                                        <div class="col-md-8 form-check form-switch" style="padding: 0px 43px;">
                                        <span class="text-start"><em data-toggle="tooltip" data-html="true" title="'.$_language->module[ 'tooltip_66' ].'">'.$de_lang.'</em></span>
                                    </div>
                                    </div>
                                    <div class="mb-3 row">
                                    <div class="col-md-4">
                                            '.$_language->module['en_language'].' :
                                        </div>
                                        <div class="col-md-8 form-check form-switch" style="padding: 0px 43px;">
                                        <span class="pull-left text-muted mdall"><em data-toggle="tooltip" data-html="true" title="'.$_language->module[ 'tooltip_67' ].'">'.$en_lang.'</em></span>
                                        </div>
                                        </div>
                                        <div class="mb-3 row">
                                    <div class="col-md-4">
                                            '.$_language->module['it_language'].' :
                                        </div>
                                        <div class="col-md-8 form-check form-switch" style="padding: 0px 43px;">
                                        <span class="pull-left text-muted mdall"><em data-toggle="tooltip" data-html="true" title="'.$_language->module[ 'tooltip_68' ].'">'.$it_lang.'</em></span>
                                        </div>
                                        </div>

                                    <div class="mb-3 row">
                                        <div class="col-md-4">
                                            '.$_language->module['login_duration'].' :
                                        </div>

                                        <div class="col-md-8">
                                            <span class="pull-left text-muted mdall"><em data-toggle="tooltip" data-html="true" title="'.$_language->module[ 'tooltip_33' ].'"><input class="form-control" type="text" name="sessionduration" value="'.$ds['sessionduration'].'" size="3"></em></span>
                                        </div>
                                    </div>

                                    </div>

                                    <div class="col-md-6">

                                    <div class="mb-3 row">
                                        <div class="col-md-4">
                                            '.$_language->module['profile_last_posts'].' :
                                        </div>

                                        <div class="col-md-8">
                                            <span class="pull-left text-muted mdall"><em data-toggle="tooltip" data-html="true" title="'.$_language->module[ 'tooltip_31' ].'"><input class="form-control" type="text" name="lastposts" value="'.$ds['profilelast'].'" size="3"></em></span>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <div class="col-md-4">
                                            '.$_language->module['search_min_length'].' :
                                        </div>

                                        <div class="col-md-8">
                                            <span class="pull-left text-muted mdall"><em data-toggle="tooltip" data-html="true" title="'.$_language->module[ 'tooltip_17' ].'"><input class="form-control" type="text" name="searchminlen" value="'.$ds['search_min_len'].'" size="3"></em></span>
                                        </div>
                                    </div>



                                    <div class="mb-3 row">
                                        <div class="col-md-4">
                                            '.$_language->module['max_wrong_pw'].' :
                                        </div>

                                        <div class="col-md-8">
                                            <span class="pull-left text-muted mdall"><em data-toggle="tooltip" data-html="true" title="'.$_language->module[ 'tooltip_43' ].'"><input class="form-control" type="text" name="max_wrong_pw" value="'.$ds['max_wrong_pw'].'" size="3"></em></span>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3 row">
                                        <div class="col-md-4">
                                            '.$_language->module[ 'register_per_ip' ].' :
                                        </div>

                                        <div class="col-md-8 form-check form-switch" style="padding: 0px 43px;">
                                            <span class="pull-left text-muted mdall">
                                                <em data-toggle="tooltip" data-html="true" title="'.$_language->module[ 'tooltip_63' ].'">
                                                    '.$register_per_ip.'                                              
                                                </em>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-md-4">
                                            '.$_language->module[ 'detect_visitor_language' ].' :
                                        </div>

                                        <div class="col-md-8 form-check form-switch" style="padding: 0px 43px;">
                                            <span class="pull-left text-muted mdall">
                                                <em data-toggle="tooltip" data-html="true" title="'.$_language->module[ 'tooltip_52' ].'">
                                                    '.$visitor_language.'                                                 
                                                </em>
                                            </span>
                                        </div>
                                    </div>';
                                    
                                    $ergebnis = safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='forum'"); 
                                    if(mysqli_num_rows($ergebnis) == '1') { 

                                    echo'<div class="mb-3 row">
                                        <div class="col-md-4">
                                            '.$_language->module[ 'forum_double' ].' :
                                        </div>

                                        <div class="col-md-8 form-check form-switch" style="padding: 0px 43px;">
                                            <span class="pull-left text-muted mdall">
                                                <em data-toggle="tooltip" data-html="true" title="'.$_language->module[ 'tooltip_65' ].'">
                                                    '.$forum_double.'                                              
                                                </em>
                                            </span>
                                        </div>
                                    </div>';
                                    }
                                echo'</div>
                            </div>
                        
                   
                

<div class="mb-3 row">
    <div class="col-md-12"><br>
      <input type="hidden" name="captcha_hash" value="'.$hash.'"> 
      <button class="btn btn-warning" type="submit" name="submit">'.$_language->module['update'].' </button>
    </div>
  </div>

</div>

 </div></form>';

}

#==== Social Einstellungen=============#

} elseif ($action == "social_setting") {


if (isset($_POST[ "saveedit" ])) {
    $twitch = $_POST[ "twitch" ];
    $facebook = $_POST[ "facebook" ];
    $twitter = $_POST[ "twitter" ];
    $youtube = $_POST[ "youtube" ];
    $rss = $_POST[ "rss" ];
    $vine = $_POST[ "vine" ];
    $flickr = $_POST[ "flickr" ];
    $linkedin = $_POST[ "linkedin" ];
    $instagram = $_POST[ "instagram" ];
    $steam = $_POST[ "steam" ];
    $gametracker = $_POST[ "gametracker" ];
    $discord = $_POST[ "discord" ];
    $since = $_POST[ "since" ];
    $socialID = $_POST[ "socialID" ];
    
    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_POST[ 'captcha_hash' ])) {
        
            safe_query(
                "UPDATE
                    `" . PREFIX . "settings_social_media`
                SET
                    `twitch` = '" . $twitch . "',
                    `facebook` = '" . $facebook . "',
                    `twitter` = '" . $twitter . "',
                    `facebook` = '" . $facebook . "',
                    `youtube` = '" . $youtube . "',
                    `rss` = '" . $rss . "',
                    `vine` = '" . $vine . "',
                    `flickr` = '" . $flickr . "',
                    `linkedin` = '" . $linkedin . "',
                    `instagram` = '" . $instagram . "',
                    `gametracker` = '" . $gametracker . "',
                    `steam` = '" . $steam . "',
                    `discord` = '" . $discord . "',
                    `since` = '" . $since. "'
                WHERE `socialID` = '".$socialID."'"
            );

            
        redirect("admincenter.php?site=settings&action=social_setting", $_language->module[ 'updated_successfully' ], 2);
    } else {
        redirect("admincenter.php?site=settings&action=social_setting", $_language->module[ 'transaction_invalid' ], 3);  
    }

} else {

    echo'<div class="card">
            <div class="card-header">
                '. $_language->module[ 'social_settings' ] .'
                </div>
            <div class="card-body">';    
echo'
    <a href="admincenter.php?site=settings" class="btn btn-primary" type="button">'.$_language->module[ 'settings' ] .'</a>
    <a href="admincenter.php?site=settings&action=social_setting" class="btn btn-primary disabled" type="button">'.$_language->module[ 'social_settings' ] .'</a>';

  $ds =
        mysqli_fetch_array(safe_query(
            "SELECT * FROM " . PREFIX . "settings_social_media"));

    $CAPCLASS = new \webspell\Captcha;
    $CAPCLASS->createTransaction();
    $hash = $CAPCLASS->getHash();
    
    
    echo '<div class="card">
        <div class="card-header">
            '. $_language->module[ 'title_social_media' ] .'
        </div>
            <div class="card-body">

            <form action="admincenter.php?site=settings&action=social_setting" method="post" name="post" role="form"
            class="form-horizontal">


<div class="mb-3 row">
                <label for="select-squad" class="col-xs-12 col-md-2 control-label"><i class="bi bi-clock"></i>&nbsp;Since:</label>

                <div class="col-xs-12 col-md-10">
                    
                    <input type="text" name="since" class="form-control" value="'.getinput($ds['since']).'">
                </div>
            </div>

<div class="mb-3 row">
                <label for="select-squad" class="col-xs-12 col-md-2 control-label"><i class="bi bi-controller"></i>&nbsp;Gametracker:<br><small>('. $_language->module[ 'social_sidebar_widget' ] .')</small></label>

                <div class="col-xs-12 col-md-10">
                    
                    <input type="text" name="gametracker" class="form-control" value="'.getinput($ds['gametracker']).'">
                </div>
            </div>            

<div class="mb-3 row">
                <label for="select-squad" class="col-xs-12 col-md-2 control-label"><i class="bi bi-discord"></i>&nbsp;Discord:<br><small>('. $_language->module[ 'social_sidebar_widget' ] .')</small></label>

                <div class="col-xs-12 col-md-10">
                    
                    <input type="text" name="discord" class="form-control" value="'.getinput($ds['discord']).'">
                </div>
            </div>

<hr>
<div class="mb-3 row">
                <label for="select-squad" class="col-xs-12 col-md-2 control-label"><i class="bi bi-twitch"></i>&nbsp;twitch:</label>

                <div class="col-xs-12 col-md-10">
                    
                    <input type="text" name="twitch" class="form-control" value="'.getinput($ds['twitch']).'">
                </div>
            </div>
<div class="mb-3 row">            
            <label for="select-squad" class="col-xs-12 col-md-2 control-label"><i class="bi bi-steam"></i>&nbsp;steam:</label>

            <div class="col-xs-12 col-md-10">
                
                <input type="text" name="steam" class="form-control" value="'.getinput($ds['steam']).'">
            </div>
        </div>             

<div class="mb-3 row">
                <label for="select-squad" class="col-xs-12 col-md-2 control-label"><i class="bi bi-facebook"></i>&nbsp;facebook:</label>

                <div class="col-xs-12 col-md-10">
                    
                    <input type="text" name="facebook" class="form-control" value="'.getinput($ds['facebook']).'">
                </div>
            </div> 

 <div class="mb-3 row">
                <label for="select-squad" class="col-xs-12 col-md-2 control-label"><i class="bi bi-twitter-x"></i>&nbsp;twitter:</label>

                <div class="col-xs-12 col-md-10">
                    
                    <input type="text" name="twitter" class="form-control" value="'.getinput($ds['twitter']).'">
                </div>
            </div>

<div class="mb-3 row">
                <label for="select-squad" class="col-xs-12 col-md-2 control-label"><i class="bi bi-youtube"></i>&nbsp;youtube:</label>

                <div class="col-xs-12 col-md-10">
                    
                    <input type="text" name="youtube" class="form-control" value="'.getinput($ds['youtube']).'">
                </div>
            </div>

<div class="mb-3 row">
                <label for="select-squad" class="col-xs-12 col-md-2 control-label"><i class="bi bi-rss"></i>&nbsp;rss:</label>

                <div class="col-xs-12 col-md-10">
                    
                    <input type="text" name="rss" class="form-control" value="'.getinput($ds['rss']).'">
                </div>
            </div>

<div class="mb-3 row">
                <label for="select-squad" class="col-xs-12 col-md-2 control-label"><svg xmlns="http://www.w3.org/2000/svg" height="16" width="12" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path d="M384 254.7v52.1c-18.4 4.2-36.9 6.1-52.1 6.1-36.9 77.4-103 143.8-125.1 156.2-14 7.9-27.1 8.4-42.7-.8C137 452 34.2 367.7 0 102.7h74.5C93.2 261.8 139 343.4 189.3 404.5c27.9-27.9 54.8-65.1 75.6-106.9-49.8-25.3-80.1-80.9-80.1-145.6 0-65.6 37.7-115.1 102.2-115.1 114.9 0 106.2 127.9 81.6 181.5 0 0-46.4 9.2-63.5-20.5 3.4-11.3 8.2-30.8 8.2-48.5 0-31.3-11.3-46.6-28.4-46.6-18.2 0-30.8 17.1-30.8 50 .1 79.2 59.4 118.7 129.9 101.9z"/></svg>&nbsp;vine:</label>

                <div class="col-xs-12 col-md-10">
                    
                    <input type="text" name="vine" class="form-control" value="'.getinput($ds['vine']).'">
                </div>
            </div>

<div class="mb-3 row">
                <label for="select-squad" class="col-xs-12 col-md-2 control-label"><svg xmlns="http://www.w3.org/2000/svg" height="16" width="12" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path d="M400 32H48C21.5 32 0 53.5 0 80v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V80c0-26.5-21.5-48-48-48zM144.5 319c-35.1 0-63.5-28.4-63.5-63.5s28.4-63.5 63.5-63.5 63.5 28.4 63.5 63.5-28.4 63.5-63.5 63.5zm159 0c-35.1 0-63.5-28.4-63.5-63.5s28.4-63.5 63.5-63.5 63.5 28.4 63.5 63.5-28.4 63.5-63.5 63.5z"/></svg></i>&nbsp;flickr:</label>

                <div class="col-xs-12 col-md-10">
                    
                    <input type="text" name="flickr" class="form-control" value="'.getinput($ds['flickr']).'">
                </div>
            </div>

<div class="mb-3 row">
                <label for="select-squad" class="col-xs-12 col-md-2 control-label"><i class="bi bi-linkedin"></i>&nbsp;linkedin:</label>

                <div class="col-xs-12 col-md-10">
                    
                    <input type="text" name="linkedin" class="form-control" value="'.getinput($ds['linkedin']).'">
                </div>
            </div>

<div class="mb-3 row">
                <label for="select-squad" class="col-xs-12 col-md-2 control-label"><i class="bi bi-instagram"></i>&nbsp;instagram:</label>

                <div class="col-xs-12 col-md-10">
                    
                    <input type="text" name="instagram" class="form-control" value="'.getinput($ds['instagram']).'">
                </div>
            </div>

<input type="hidden" name="captcha_hash" value="'.$hash .'" />
                <input type="hidden" name="socialID" value="'.$ds[ 'socialID' ] .'" />

<input class="btn btn-warning" type="submit" name="saveedit" value="'.$_language->module['update'] .'" />

</form></div></div>';


}

#==== Social Einstellungen=============#

} elseif ($action == "plugin_setting") {


if (isset($_POST[ 'submit_members' ])) {
    #$users = $_POST[ "users" ];
    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_POST[ 'captcha_hash' ])) {
        safe_query("UPDATE `" . PREFIX . "plugins_memberslist` SET users='" . $_POST[ 'users' ] . "'");
        
        
        redirect("admincenter.php?site=settings&action=plugin_setting", $_language->module[ 'updated_successfully' ], 2);
    } else {
        redirect("admincenter.php?site=settings&action=plugin_setting", $_language->module[ 'transaction_invalid' ], 3);
    }



} else {


echo'<div class="card">
        <div class="card-header">
            '. $_language->module[ 'plugin_settings' ] .'
            </div>
            <div class="card-body">';    
echo'
    <a href="admincenter.php?site=settings" class="btn btn-primary" type="button">'.$_language->module[ 'settings' ] .'</a>
    <a href="admincenter.php?site=settings&action=social_setting" class="btn btn-primary" type="button">'.$_language->module[ 'social_settings' ] .'</a>
    <a href="admincenter.php?site=settings&action=plugin_setting" class="btn btn-primary disabled" type="button">'.$_language->module[ 'plugin_settings' ] .'</a>';

echo'<div class="row">';



#=========members===============#


$dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='memberslist'"));
        if (@$dx[ 'modulname' ] != 'memberslist') {
        $member = '';
        } else {
        $member = 


$ergebnis = safe_query("SELECT * FROM `" . PREFIX . "plugins_memberslist`");
    $ds = mysqli_fetch_array($ergebnis);
    $CAPCLASS = new \webspell\Captcha;
    $CAPCLASS->createTransaction();
    $hash = $CAPCLASS->getHash();


    echo '<div class="col-md-6" style="height: 250px">
    <div class="card">
        <div class="card-header">
            '.$_language->module[ 'title_members' ] .'
        </div>
            <div class="card-body">

        <form class="form-horizontal" method="post" id="post" name="post" action="admincenter.php?site=settings&action=plugin_setting" onsubmit="return chkFormular();">
<div class="row">
    <div class="col-md-6">
            <div class="mb-3 row">
                <label for="select-squad" class="col-xs-12 col-md-6 control-label">'.$_language->module['max_registered_members'] .'</label>

                <div class="col-xs-12 col-md-3">
                    <span class="pull text-muted small"><em data-toggle="tooltip" data-html="true" title="'.$_language->module[ 'tooltip_members' ] .'"><input class="form-control" type="text" name="users" value="'.$ds['users'] .'" size="35"></em></span>
                </div>
            </div>    
    </div>
    <div class="col-md-6">
                    
            <img alt="" src="https://www.webspell-rm.de/includes/plugins/pic_update/images/99.jpg" style="width:100%">
    </div>             
</div>
        <input type="hidden" name="captcha_hash" value="'.$hash .'"> <br>
        <button class="btn btn-warning" type="submit" name="submit_members"  />'.$_language->module['update'] .'</button>

        </form></div></div></div>
        ';

}








}


}
echo '</div></div>
  </div>';
?>