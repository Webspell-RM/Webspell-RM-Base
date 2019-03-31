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

$_language->readModule('settings', false, true);

if (!ispageadmin($userID) || mb_substr(basename($_SERVER[ 'REQUEST_URI' ]), 0, 15) != "admincenter.php") {
    die($_language->module[ 'access_denied' ]);
}



if(isset($_POST['submit'])) {
    $webkey = $_POST['webkey'];
    $seckey = $_POST['seckey'];
    if (isset($_POST['onoff'])) {
        $chk = 1;
    } else { $chk = 0; }
    $run = safe_query("UPDATE `".PREFIX."settings_recaptcha` SET `activated`='".$chk."',`webkey`='".$webkey."',`seckey`='".$seckey."' WHERE 1 ");


    if($run) { echo $_language->module[ 'success' ]; } else { echo $_language->module[ 'failed' ]; }
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
                users='" . $_POST[ 'users' ] . "',
                sessionduration='" . $_POST[ 'sessionduration' ] . "',
                picsize_l='" . $_POST[ 'picsize_l' ] . "',
                picsize_h='" . $_POST[ 'picsize_h' ] . "',
                publicadmin='" . isset($_POST[ 'publicadmin' ]) . "',
                default_language='" . $_POST[ 'language' ] . "',
                insertlinks='" . isset($_POST[ 'insertlinks' ]) . "',
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
                autoresize='" . $_POST[ 'autoresize' ] . "',
                register_per_ip='"  . isset($_POST[ 'register_per_ip' ]) . "' "
        );
        
        redirect("admincenter.php?site=settings", "", 0);
    } else {
        redirect("admincenter.php?site=settings", $_language->module[ 'transaction_invalid' ], 3);
    }
} else {
    $settings = safe_query("SELECT * FROM " . PREFIX . "settings");
    $ds = mysqli_fetch_array($settings);

        
    if ($ds[ 'register_per_ip' ]) {
        $register_per_ip = '<input type="checkbox" name="register_per_ip" value="1" checked="checked"
        />';
    } else {
        $register_per_ip = '<input type="checkbox" name="register_per_ip" value="1" />';
    }

    if ($ds[ 'spam_check' ]) {
        $spam_check = '<input type="checkbox" name="spam_check" value="1" checked="checked"
        />';
    } else {
        $spam_check = '<input type="checkbox" name="spam_check" value="1" />';
    }

    if ($ds[ 'detect_language' ]) {
        $visitor_language = '<input type="checkbox" name="detectLanguage" value="1" checked="checked"
        />';
    } else {
        $visitor_language = '<input type="checkbox" name="detectLanguage" value="1" />';
    }

    if ($ds[ 'publicadmin' ]) {
        $publicadmin = " checked=\"checked\"";
    } else {
        $publicadmin = "";
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
        $langdirs .= '<option value="' . $flag . '">' . $lang . '</option>';
    }
    $lang = $default_language;
    $langdirs = str_replace('value="' . $lang . '"', 'value="' . $lang . '" selected="selected"', $langdirs);

    if ($ds[ 'insertlinks' ]) {
        $insertlinks = '<input type="checkbox" name="insertlinks" value="1" checked="checked"
        />';
    } else {
        $insertlinks = '<input type="checkbox" name="insertlinks" value="1" />';
    }

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

    $autoresize = "<option value='0'>" . $_language->module[ 'autoresize_off' ] . "</option><option value='2'>" .
        $_language->module[ 'autoresize_js' ] . "</option><option value='1'>" . $_language->module[ 'autoresize_php' ] .
        "</option>";
    $autoresize = str_replace(
        "value='" . $ds[ 'autoresize' ] . "'",
        "value='" . $ds[ 'autoresize' ] . "' selected='selected'",
        $autoresize
    );

echo '<div class="panel panel-default">
  <div class="panel-heading">
                            <i class="fa fa-thumbs-up"></i> Setting
                        </div>
                       <div class="panel-body">
                        
                        
<ul class="nav nav-tabs-primary">
    <li role="presentation" class="active"><a href="./admincenter.php?site=settings">Setting</a></li>    
    <li role="presentation"><a href="./admincenter.php?site=settings_styles">Style</a></li>
    <li role="presentation"><a href="./admincenter.php?site=settings_buttons">Buttons</a></li>
    <li role="presentation"><a href="./admincenter.php?site=settings_moduls">Module</a></li>
    <li role="presentation"><a href="./admincenter.php?site=settings_head_moduls">Page Head Module</a></li>
    <li role="presentation"><a href="./admincenter.php?site=settings_content_head_moduls">Content Head Module</a></li>
    <li role="presentation"><a href="./admincenter.php?site=settings_content_foot_moduls">Content Foot Module</a></li>
    <li role="presentation"><a href="./admincenter.php?site=settings_css">.css</a></li>
    <li role="presentation"><a href="./admincenter.php?site=settings_templates">Templates</a></li>
</ul>
<ol class="breadcrumb-primary"> </ol>
 ';

    $CAPCLASS = new \webspell\Captcha;
    $CAPCLASS->createTransaction();
    $hash = $CAPCLASS->getHash();
    ?>
    <form class="form-horizontal" method="post" id="post" name="post" action="admincenter.php?site=settings" onsubmit="return chkFormular();">

        <div class="page-header">
            <h1><?php echo $_language->module[ 'settings' ]; ?></h1>
        </div> 

        <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row bt">
                            <div class="col-md-4">
                                <?php echo $_language->module['page_title']; ?>:
                            </div>

                            <div class="col-md-8">
                                <span class="text-muted small"><em data-toggle="tooltip" title="<?php echo $_language->module[ 'tooltip_2' ]; ?>"><input class="form-control" name="title" type="text" value="<?php echo getinput($ds['title']); ?>" size="35"></em></span>
                            </div>
                        </div>

                        <div class="row bt">
                            <div class="col-md-4">
                                <?php echo $_language->module['clan_name']; ?>:
                            </div>

                            <div class="col-md-8">
                                <span class="text-muted small"><em data-toggle="tooltip" title="<?php echo $_language->module[ 'tooltip_3' ]; ?>"><input class="form-control" type="text" name="clanname" value="<?php echo getinput($ds['clanname']); ?>" size="35"></em></span>
                            </div>
                        </div>

                        <div class="row bt">
                            <div class="col-md-4">
                                <?php echo $_language->module['admin_name']; ?>:
                            </div>

                            <div class="col-md-8">
                                <span class="text-muted small"><em data-toggle="tooltip" title="<?php echo $_language->module[ 'tooltip_5' ]; ?>"><input class="form-control" type="text" name="admname" value="<?php echo getinput($ds['adminname']); ?>" size="35" ></em></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="row bt">
                            <div class="col-md-4">
                                <?php echo $_language->module['page_url']; ?>:
                            </div>

                            <div class="col-md-8">
                                <span class="text-muted small"><em data-toggle="tooltip" title="<?php echo $_language->module[ 'tooltip_1' ]; ?>"><input class="form-control" type="text" name="url" value="<?php echo getinput($ds['hpurl']); ?>" size="35"></em></span>
                            </div>
                        </div>

                        <div class="row bt">
                            <div class="col-md-4">
                                <?php echo $_language->module['clan_tag']; ?>:
                            </div>

                            <div class="col-md-8">
                                <span class="text-muted small"><em data-toggle="tooltip" title="<?php echo $_language->module[ 'tooltip_4' ]; ?>"><input class="form-control" type="text" name="clantag" value="<?php echo getinput($ds['clantag']); ?>" size="35"></em></span>
                            </div>
                        </div>

                        <div class="row bt">
                            <div class="col-md-4">
                                <?php echo $_language->module['admin_email']; ?>:
                            </div>

                            <div class="col-md-8">
                                <span class="text-muted small"><em data-toggle="tooltip" title="<?php echo $_language->module[ 'tooltip_6' ]; ?>"><input class="form-control" type="text" name="admmail" value="<?php echo getinput($ds['adminemail']); ?>" size="35"></em></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <br>


        <div class="page-header">
            <h1><?php echo $_language->module['additional_options']; ?></h1>
        </div> 
        

            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <a class="btn btn-danger" href="admincenter.php?site=lock"><?php echo $_language->module['pagelock']; ?></a>
                    </div>
                </div>
            </div>
        
        <div class="row">
            

            <div class="col-md-12">


<div class="page-header">
            <h1>Google`s reCaptcha - I'am not a Robot</h1>
        </div>


                        <div class="panel-body">





<?php echo $_language->module[ 'important_text' ]; ?>


<br><br>
<div class="form-group">
    <label class="col-sm-2 control-label"><?php echo $_language->module['web-key']; ?>:</label>
    <div class="col-sm-8"><span class="text-muted small"><em><input class="form-control" type="text" name="webkey" value="<?php echo $webkey; ?>" style="width: 60%;"></em></span>
    </div>
  </div>
<div class="form-group">
    <label class="col-sm-2 control-label"><?php echo $_language->module['secret-key']; ?>:</label>
    <div class="col-sm-8"><span class="text-muted small"><em><input class="form-control" type="text" name="seckey" value="<?php echo $seckey; ?>" style="width: 60%;"></em></span>
    </div>
  </div>

<div class="form-group">
    <label class="col-sm-2 control-label"><?php echo $_language->module['activate']; ?>:</label>
    <div class="col-sm-8">
<input type="checkbox" name="onoff" value="1" <?php echo $chk ; ?> >
</div>
  </div>



</div>


<div class="col-md-12">
                <div class="page-header">
                    <h1><?php echo $_language->module['captcha']; ?></h1>
                </div>    

                <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row bt">
                            <div class="col-md-4">
                                <?php echo $_language->module['captcha_type']; ?>:
                            </div>

                            <div class="col-md-8">
                                <span class="pull-left text-muted small"><em data-toggle="tooltip" title="<?php echo $_language->module[ 'tooltip_44' ]; ?>"><select class="form-control" name="captcha_type">
                                    <?php echo $captcha_type;?>
                                </select></em></span>
                            </div>
                        </div>

                        <div class="row bt">
                            <div class="col-md-4">
                                <?php echo $_language->module['captcha_bgcol']; ?>:
                            </div>

                            <div class="col-md-8">
                                <span class="pull-left text-muted small"><em data-toggle="tooltip" title="<?php echo $_language->module[ 'tooltip_45' ]; ?>"><input class="form-control" type="text" name="captcha_bgcol" size="8" value="<?php echo $ds['captcha_bgcol']; ?>"></em></span>
                            </div>
                        </div>

                        <div class="row bt">
                            <div class="col-md-4">
                                <?php echo $_language->module['captcha_fontcol']; ?>:
                            </div>

                            <div class="col-md-8">
                                <span class="pull-left text-muted small"><em data-toggle="tooltip" title="<?php echo $_language->module[ 'tooltip_46' ]; ?>"><input class="form-control" type="text" name="captcha_fontcol" size="8" value="<?php echo $ds['captcha_fontcol']; ?>"></em></span>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="row bt">
                            <div class="col-md-4">
                                <?php echo $_language->module['captcha_style']; ?>:
                            </div>

                            <div class="col-md-8">
                                <span class="pull-left text-muted small"><em data-toggle="tooltip" title="<?php echo $_language->module[ 'tooltip_47' ]; ?>"><select class="form-control" name="captcha_math">
                                    <?php echo $captcha_style;?>
                                </select></em></span>
                            </div>
                        </div>

                        <div class="row bt">
                            <div class="col-md-4">
                                <?php echo $_language->module['captcha_noise']; ?>:
                            </div>

                            <div class="col-md-8">
                                <span class="pull-left text-muted small"><em data-toggle="tooltip" title="<?php echo $_language->module[ 'tooltip_48' ]; ?>"><input class="form-control" type="text" name="captcha_noise" size="3" value="<?php echo $ds['captcha_noise']; ?>"></em></span>
                            </div>
                        </div>

                        <div class="row bt">
                            <div class="col-md-4">
                                <?php echo $_language->module['captcha_linenoise']; ?>:
                            </div>

                            <div class="col-md-8">
                                <span class="pull-left text-muted small"><em data-toggle="tooltip" title="<?php echo $_language->module[ 'tooltip_49' ]; ?>"><input class="form-control" type="text" name="captcha_linenoise" size="3" value="<?php echo $ds['captcha_linenoise']; ?>"></em></span>
                            </div>
                        </div>
                    </div>



</div></div></div></div></div>





<div class="col-md-12">
                <div class="page-header">
            <h1><?php echo $_language->module['other']; ?></h1>
        </div>
        <div class="row">
            
                

                    <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                                   
                                        
                                    <div class="row bt">
                                        <div class="col-md-4">
                                            <?php echo $_language->module['registered_users']; ?>:
                                        </div>

                                        <div class="col-md-8">
                                            <span class="pull-left text-muted small"><em data-toggle="tooltip" title="<?php echo $_language->module[ 'tooltip_29' ]; ?>"><input class="form-control" type="text" name="users" value="<?php echo $ds['users']; ?>" size="3" />
                                            </em></span>
                                        </div>
                                    </div>

                                    

                                    <div class="row bt">
                                        <div class="col-md-4">
                                            <?php echo $_language->module[ 'format_date' ]; ?>:
                                        </div>

                                        <div class="col-md-8">
                                            <span class="pull-left text-muted small"><em data-toggle="tooltip" title="<?php echo $_language->module[ 'tooltip_58' ]; ?>"><select class="form-control" name="date_format" style="text-align: right;">
                                                <?php echo $format_date; ?>
                                            </select></em></span>
                                        </div>
                                    </div>

                                    <div class="row bt">
                                        <div class="col-md-4">
                                            <?php echo $_language->module[ 'format_time' ]; ?>:
                                        </div>

                                        <div class="col-md-8">
                                            <span class="pull-left text-muted small"><em data-toggle="tooltip" title="<?php echo $_language->module[ 'tooltip_59' ]; ?>"><select class="form-control" name="time_format" style="text-align: right;">
                                                <?php echo $format_time; ?>
                                            </select></em></span>
                                        </div>
                                    </div>
                                
                                    <div class="row bt">
                                        <div class="col-md-4">
                                            <?php echo $_language->module['default_language']; ?>:
                                        </div>

                                        <div class="col-md-8">
                                            <span class="pull-left text-muted small"><em data-toggle="tooltip" title="<?php echo $_language->module[ 'tooltip_40' ]; ?>"><select class="form-control" name="language">
                                                <?php echo $langdirs; ?>
                                            </select></em></span>
                                        </div>
                                    </div>

                                    

                                    <div class="row bt">
                                        <div class="col-md-4">
                                            <?php echo $_language->module['insert_links']; ?>:
                                        </div>

                                        <div class="col-md-8">
                                            <span class="pull-left text-muted small"><em data-toggle="tooltip" title="<?php echo $_language->module[ 'tooltip_41' ]; ?>"><?php echo $insertlinks; ?></em></span>
                                        </div>
                                    </div>

                                    <div class="row bt">
                                        <div class="col-md-4">
                                            <?php echo $_language->module['login_duration']; ?>:
                                        </div>

                                        <div class="col-md-8">
                                            <span class="pull-left text-muted small"><em data-toggle="tooltip" title="<?php echo $_language->module[ 'tooltip_33' ]; ?>"><input class="form-control" type="text" name="sessionduration" value="<?php echo $ds['sessionduration']; ?>" size="3"></em></span>
                                        </div>
                                    </div>

                                    </div>

                                    <div class="col-md-6">

                                    <div class="row bt">
                                        <div class="col-md-4">
                                            <?php echo $_language->module['search_min_length']; ?>:
                                        </div>

                                        <div class="col-md-8">
                                            <span class="pull-left text-muted small"><em data-toggle="tooltip" title="<?php echo $_language->module[ 'tooltip_17' ]; ?>"><input class="form-control" type="text" name="searchminlen" value="<?php echo $ds['search_min_len']; ?>" size="3"></em></span>
                                        </div>
                                    </div>



                                    <div class="row bt">
                                        <div class="col-md-4">
                                            <?php echo $_language->module['max_wrong_pw']; ?>:
                                        </div>

                                        <div class="col-md-8">
                                            <span class="pull-left text-muted small"><em data-toggle="tooltip" title="<?php echo $_language->module[ 'tooltip_43' ]; ?>"><input class="form-control" type="text" name="max_wrong_pw" value="<?php echo $ds['max_wrong_pw']; ?>" size="3"></em></span>
                                        </div>
                                    </div>

                                    <div class="row bt">
                                        <div class="col-md-4">
                                            <?php echo $_language->module['content_size']; ?>: B x H
                                        </div>
                                        <div class="col-md-8 pull-right">   
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <span class="pull-left text-muted small"><em data-toggle="tooltip" title="<?php echo $_language->module[ 'tooltip_34' ]; ?>"><input class="form-control" type="text" name="picsize_l" value="<?php echo $ds['picsize_l']; ?>" size="3"></em></span>
                                                </div>
    
                                                <div class="col-md-9">
                                                    <span class="pull-left text-muted small"><em data-toggle="tooltip" title="<?php echo $_language->module[ 'tooltip_35' ]; ?>"><input class="form-control" type="text" name="picsize_h" value="<?php echo $ds['picsize_h']; ?>" size="3"></em></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row bt">
                                        <div class="col-md-4">
                                            <?php echo $_language->module['autoresize']; ?>:
                                        </div>

                                        <div class="col-md-8">
                                            <span class="pull-left text-muted small">
                                                <em data-toggle="tooltip" title="<?php echo $_language->module[ 'tooltip_50' ]; ?>">
                                                    <select class="form-control" name="autoresize">
                                                        <?php echo $autoresize;?>
                                                    </select>
                                                </em>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="row bt">
                                        <div class="col-md-4">
                                            <?php echo $_language->module[ 'register_per_ip' ]; ?>:
                                        </div>

                                        <div class="col-md-8">
                                            <span class="pull-left text-muted small">
                                                <em data-toggle="tooltip" title="<?php echo $_language->module[ 'tooltip_63' ]; ?>">
                                                    <?php echo $register_per_ip; ?>                                             
                                                </em>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="row bt">
                                        <div class="col-md-4">
                                            <?php echo $_language->module[ 'detect_visitor_language' ]; ?>:
                                        </div>

                                        <div class="col-md-8">
                                            <span class="pull-left text-muted small">
                                                <em data-toggle="tooltip" title="<?php echo $_language->module[ 'tooltip_52' ]; ?>">
                                                    <?php echo $visitor_language; ?>                                                
                                                </em>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


<input type="hidden" name="captcha_hash" value="<?php echo $hash; ?>"> <button class="btn btn-primary" type="submit" name="submit"><?php echo $_language->module['update']; ?>
    </form>
<?php
}
echo '</div><br><br></div>';
?>

