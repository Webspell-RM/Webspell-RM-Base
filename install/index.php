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

include('head.php');

if($step == '1') {
  //$accepted = checksession('agree');
  $accepted1 = '';
  $accepted2 = '';
  $update = '';
  if(checksession('agree')) {
      $accepted1 = 'selected="selected"';    
  } else {
      $accepted2 = 'selected="selected"'; 
  }
  $data_array = array();
  $data_array['$accepted1'] = $accepted1;
  $data_array['$accepted2'] = $accepted2;
  $data_array['$licence'] = $_language->module['licence'];
  $data_array['$version'] = $_language->module['version'] . ' ' . $version;
  $data_array['$update'] = $_language->module['update'] . ' ' . $update;
  $data_array['$info'] = $_language->module['gpl_info'] . '<br />' . $_language->module['more_info'];
  $data_array['$please_select'] = $_language->module['please_select'];
  $data_array['$agree_not'] = $_language->module['agree_not'];
  $data_array['$agree'] = $_language->module['agree'];
  $data_array['$continue'] = $_language->module['continue'];
  $step01 = $_template->loadTemplate('step01', 'content', $data_array);
  echo $step01;
} elseif($step == '2') {
    
    if(isset($_POST['agree'])) {
        $_SESSION['agree'] = $_POST['agree'];
    }

    $accepted1 = '';
    $accepted2 = '';
    $accepted3 = '';
    $accepted4 = '';
    $accepted5 = '';
    if(checksession('installtype') == 'org') {
        $accepted1 = 'checked="checked"';    
    } elseif(checksession('installtype') == 'nor') {
        $accepted2 = 'checked="checked"'; 
    }  elseif(checksession('installtype') == 'rm200') {
        $accepted3 = 'checked="checked"'; 
    } elseif(checksession('installtype') == 'rm201') {
        $accepted4 = 'checked="checked"'; 
    } else {
        $accepted5 = 'checked="checked"';
    }

    if(checksession('agree') == '1') {
        $versionerror = (phpversion()=='5.2.6') ? true : false;
        if ($versionerror) {
            $data_array = array();
            $data_array['$php_version'] = $_language->module['php_version'];
            $data_array['$php_info'] = $_language->module['php_info'];
            $step02_content = $_template->loadTemplate('step02', 'versionerror', $data_array);
        } else {
            $data_array = array();
            $data_array['$enter_url'] = $_language->module['enter_url'];
            $data_array['$hp_url'] = CurrentUrl();
            $step02_content = $_template->loadTemplate('step02', 'enterhomepage', $data_array);
        }

        $data_array = array();
        $data_array['$title'] = ($versionerror) ? $_language->module['error'] : $_language->module['your_site_url'];
        $data_array['$step02_content'] = $step02_content;
        $data_array['$back'] = $_language->module['back'];

        $data_array['$new_install'] = $_language->module['new_install'];
        $data_array['$what_to_do'] = $_language->module['what_to_do'];
        $data_array['$select_install'] = $_language->module['select_install'];
        $data_array['$accepted1'] = $accepted1;
        $data_array['$accepted2'] = $accepted2;
        $data_array['$accepted3'] = $accepted3;
        $data_array['$accepted4'] = $accepted4;
        $data_array['$accepted5'] = $accepted5;
        $fatal2_error = ''; 

        $step02 = $_template->loadTemplate('step02', 'content', $data_array);
        echo $step02;

        $filename = '../includes/themes/default/css/stylesheet.css';

        if (file_exists($filename)) {
            $stylesheet = '<div class="alert alert-success text-center" role="alert">'. $_language->module['the_file'] .' "<i>'.$filename.'</i>" '. $_language->module['exists'] .' <i class="bi bi-check-lg"></i></div>';
        } else {
            $stylesheet = '<div class="alert alert-danger text-center" role="alert">'. $_language->module['the_file'] .' "<i>'.$filename.'</i>" '. $_language->module['does not exist'] .' <i class="bi bi-x-lg"></i></div>';
        }


        if (version_compare(PHP_VERSION, '8.0.0', '<')) {
            $php_version_check = '<div class="alert alert-danger text-center" role="alert">'. $_language->module['your_php_version'] .': ' . phpversion() . ' '. $_language->module['is_not_compatible'] .' <i class="bi bi-x-lg"></i></div>';
            $weiter='';
        } else {
            $php_version_check = '<div class="alert alert-success text-center" role="alert">'. $_language->module['your_php_version'] .': ' . phpversion() . ' '. $_language->module['is_compatible'] .' <i class="bi bi-check-lg"></i></div>';
            $weiter='<a class="btn btn-primary text-end $buttondisabled" aria-disabled="true" href="javascript:document.ws_install.submit()">
            '.$_language->module['continue'].'
        </a>';
        }

        $chmodfiles = array(
            '/includes/themes/default/css/stylesheet.css',
            '/images/avatars',
            '/images/userpics',
            '/includes/plugins',
            '/includes/themes',
            '/system/sql.php',
            '/tmp/'
        );
        $error = array();
        foreach ($chmodfiles as $file) {
            if (!is_writable('..' . $file)) {
                if (!@chmod('..' . $file, 0777)) {
                    $error[] = $file;
                }
            }

        }

        $values = '';
        if (count($error)) {
            $fatal2_error = 'true';
            sort($error);
            $chmod_errors = '<div class="alert alert-danger text-center" role="alert">'.$_language->module['chmod_error'].' <i class="bi bi-x-lg"></i></div>';

            $values = '';

            foreach ($error as $value) {
                $values .= '<div class="alert alert-danger text-center" role="alert"> '. $_language->module['unwriteable1'] .' "<i>'.$value.'</i> " '. $_language->module['unwriteable2'] .' <i class="bi bi-x-lg"></i></div>';
            }
        } else {
            $chmod_errors = '<div class="alert alert-success text-center" role="alert">' . $_language->module['successful'] . ' <i class="bi bi-check-lg"></i></div>';
        }

        $data_array = array();
        $data_array['$mysqli_check'] = checkfunc('mysqli_connect');
        $data_array['$mb_check'] = checkfunc('mb_substr');
        $data_array['$curl_check'] = checkfunc('curl_version');
        $data_array['$curlexec_check'] = checkfunc('curl_exec');
        $data_array['$allow_url_fopen_check'] = checkfunc('allow_url_fopen');
        $data_array['$php_version_check'] = $php_version_check;
        $data_array['$stylesheet'] = $stylesheet;
        $data_array['$values'] = $values;
        $data_array['$weiter'] = $weiter;
        $data_array['$successful'] = $_language->module['successful'];
        $data_array['$setting_chmod'] = $_language->module['setting_chmod'];
        $data_array['$chmod_errors'] = $chmod_errors;
        $data_array['$version_from'] = $_language->module['version_from'];
        $data_array['$or_higher'] = $_language->module['or_higher'];

        $data_array['$the_file'] = $_language->module['the_file'];
        $data_array['$exists'] = $_language->module['exists'];
        $data_array['$does not exist'] = $_language->module['does not exist'];

        $step02_chmod = $_template->loadTemplate('step02', 'chmod', $data_array);
        echo $step02_chmod;

        $data_array['$back'] = $_language->module['back'];
        $data_array['$continue'] = $_language->module['continue'];
        $data_array['$new_install'] = $_language->module['new_install'];
        $data_array['$what_to_do'] = $_language->module['what_to_do'];
        $data_array['$select_install'] = $_language->module['select_install'];

        $data_array['$accepted1'] = $accepted1;
        $data_array['$accepted2'] = $accepted2;
        $data_array['$accepted3'] = $accepted3;
        $data_array['$accepted4'] = $accepted4;
        $data_array['$accepted5'] = $accepted5;

        $fatal2_error = '';            
            
        if($fatal2_error == 'true') {
            $data_array['$buttondisabled'] = 'disabled';
        } else {
            $data_array['$buttondisabled'] = '';
        }

        $step02_select = $_template->loadTemplate('step02', 'select', $data_array);
        echo $step02_select;
    } else {
        $data_array = array();
        $data_array['$you_have_to_agree'] = $_language->module['you_have_to_agree'];
        $data_array['$back'] = $_language->module['back'];
        $step02 = $_template->loadTemplate('step02', 'failed', $data_array);
        echo $step02;
    }
} elseif($step == '3') {

    $adminname = '';
    $adminpwd = '';
    $adminmail = '';
    $getuser = '';
    $getpwd = '';
    $getdb = '';


    if(isset($_POST['installtype'])) {
        $_SESSION['installtype'] = $_POST['installtype'];
    }
    if(isset($_POST['hp_url'])) {
        $_SESSION['hp_url'] = $_POST['hp_url'];
    }

    if(checksession('adminname')) {
        $adminname = checksession('adminname');    
    }
    if(checksession('adminpwd')) {
        $adminpwd = checksession('adminpwd');    
    }
    if(checksession('adminmail')) {
        $adminmail = checksession('adminmail');    
    }
    if(checksession('user')) {
        $getuser = checksession('user');    
    }
    if(checksession('pwd')) {
        $getpwd = checksession('pwd');    
    }
    if(checksession('db')) {
        $getdb = checksession('db');    
    }
    if(checksession('prefix')) {
        $getprefix = checksession('prefix');    
    } else {
        $getprefix = 'rm_'.RandPass(3).'_';
    }
    if (checksession('installtype') == 'full' && checksession('hp_url')) {
        $data_array['$continue'] = $_language->module['continue'];
        $data_array['$back'] = $_language->module['back'];
        $data_array['$data_config'] = $_language->module['data_config'];
        $data_array['$min_requirements'] = $_language->module['min_requirements'];
        $data_array['$pass_info'] = $_language->module['pass_info'];
        $data_array['$php_info'] = $_language->module['php_info'];
        $data_array['$php_ver'] = $_language->module['php_ver'];
        $data_array['$host_name'] = $_language->module['host_name'];
        $data_array['$mysql_username'] = $_language->module['mysql_username'];
        $data_array['$mysql_password'] = $_language->module['mysql_password'];
        $data_array['$mysql_database'] = $_language->module['mysql_database'];
        $data_array['$mysql_prefix'] = $_language->module['mysql_prefix'];
        $data_array['$RandPass'] = $getprefix;
        $data_array['$tooltip_1'] = $_language->module['tooltip_1'];
        $data_array['$tooltip_2'] = $_language->module['tooltip_2'];
        $data_array['$tooltip_3'] = $_language->module['tooltip_3'];
        $data_array['$tooltip_4'] = $_language->module['tooltip_4'];
        $data_array['$tooltip_5'] = $_language->module['tooltip_5'];
        $data_array['$webspell_config'] = $_language->module['webspell_config'];
        $data_array['$pass_ver'] = $_language->module['pass_ver'];
        $data_array['$pass_text'] = $_language->module['pass_text'];
        $data_array['$admin_username'] = $_language->module['admin_username'];
        $data_array['$admin_password'] = $_language->module['admin_password'];
        $data_array['$admin_email'] = $_language->module['admin_email'];
        $data_array['$tooltip_6'] = $_language->module['tooltip_6'];
        $data_array['$tooltip_7'] = $_language->module['tooltip_7'];
        $data_array['$tooltip_8'] = $_language->module['tooltip_8'];
        $data_array['$postinstalltype'] = $_POST['installtype'];
        $data_array['$hp_url'] = $_SESSION['hp_url'];
        $data_array['$adminname'] = $adminname;
        $data_array['$adminpwd'] = $adminpwd;
        $data_array['$adminmail'] = $adminmail;
        $data_array['$getuser'] = $getuser;
        $data_array['$getpwd'] = $getpwd;
        $data_array['$getdb'] = $getdb;
        $data_array['$getprefix'] = $getprefix;
        $step03 = $_template->loadTemplate('step03', 'mysqlconfig', $data_array);
        echo $step03;
    } else {
        $data_array['$continue'] = $_language->module['continue'];
        $data_array['$back'] = $_language->module['back'];
        $data_array['$finish_install'] = $_language->module['finish_install'];
        $data_array['$finish_next'] = $_language->module['finish_next'];
        $data_array['$postinstalltype'] = $_POST['installtype'];
        $step03 = $_template->loadTemplate('step03', 'update', $data_array);
        echo $step03;
    }
}  elseif($step == '4') {

        if(checksession('hp_url')) {
            $_SESSION['hp_url'] = checksession('hp_url');
        } 
        if(checksession('installtype')) {
            $_SESSION['installtype'] = checksession('installtype');
        }

        if(isset($_POST['adminname'])) {
            $_SESSION['adminname'] = $_POST['adminname'];
        }
        if(isset($_POST['adminpwd'])) {
            $_SESSION['adminpwd'] = $_POST['adminpwd'];
        }
        if(isset($_POST['adminmail'])) {
            $_SESSION['adminmail'] = $_POST['adminmail'];
        }
        if(isset($_POST['user'])) {
            $_SESSION['user'] = $_POST['user'];
        }
        if(isset($_POST['pwd'])) {
            $_SESSION['pwd'] = $_POST['pwd'];
        }
        if(isset($_POST['db'])) {
            $_SESSION['db'] = $_POST['db'];
        }
        if(isset($_POST['prefix'])) {
            $_SESSION['prefix'] = $_POST['prefix'];
        }
        $data_array = array();
        $data_array['$finish_install'] = $_language->module['finish_install'];

        $step04 = $_template->loadTemplate('step04', 'head', $data_array);
        echo $step04;
       
        include('functions.php');
        $errors = array();

        if ($_SESSION['installtype'] != "full") {
            include('../system/sql.php');
            @$_database = new mysqli($host, $user, $pwd, $db);

            if (mysqli_connect_error()) {
                $errors[] = $_language->module['error_mysql'];
            }

            $type = '<div class="list-group-item list-group-item-success"><b>' . $_language->module['update_complete'] . '</b></div>';
            $in_progress = $_language->module['update_running'];
        }

        if ($_SESSION['installtype'] == 'full') {
    
            $type = '<div class="text-center"><h5>' . $_language->module['install_complete'] . '</h5></div>';
            $in_progress = $_language->module['install_running'];
            $is_complete = $_language->module['install_finished'];

            $host = $_POST['host'];
            $user = $_POST['user'];
            $pwd = $_POST['pwd'];
            $db = $_POST['db'];
            $prefix = $_POST['prefix'];
            $adminname = $_POST['adminname'];
            $adminpwd = $_POST['adminpwd'];
            $adminmail = $_POST['adminmail'];

            $hp_url = (isset($_POST['hp_url'])) ?
                $_POST['hp_url'] : CurrentUrl();

            if (!(mb_strlen(trim($host)))) {
                $errors[] = $_language->module['verify_data'];
            }
            if (!(mb_strlen(trim($db)))) {
                $errors[] = $_language->module['verify_data'];
            }
            if (!(mb_strlen(trim($adminname)))) {
                $errors[] = $_language->module['verify_data'];
            }
            if (!(mb_strlen(trim($adminpwd)))) {
                $errors[] = $_language->module['verify_data'];
            }
            if (!(mb_strlen(trim($adminmail)))) {
                $errors[] = $_language->module['verify_data'];
            }
            if (!(mb_strlen(trim($hp_url)))) {
                $errors[] = $_language->module['verify_data'];
            }

            $_database = new mysqli($host, $user, $pwd, $db);

            if (mysqli_connect_error()) {
                $errors[] = $_language->module['error_mysql'];
            }

            $file = ('../system/sql.php');
            if ($fp = fopen($file, 'wb')) {
                $string = '<?php
                $host = "' . $host . '";
                $user = "' . $user . '";
                $pwd = "' . $pwd . '";
                $db = "' . $db . '";
                if (!defined("PREFIX")) {
                    define("PREFIX", \'' . $prefix . '\');
                }
                ?>';

                fwrite($fp, $string);
                fclose($fp);
            } else {
                $errors[] = $_language->module['write_failed'];
            }

            $_SESSION['adminpassword'] = $adminpwd;
            $_SESSION['adminname'] = $adminname;
            $_SESSION['adminmail'] = $adminmail;
            $_SESSION['url'] = $hp_url;

            $update_functions = array();
            $update_functions[] = "rm_1";
            $update_functions[] = "rm_2";
            $update_functions[] = "rm_3";
            $update_functions[] = "rm_4";
            $update_functions[] = "rm_5";
            $update_functions[] = "rm_6";
            $update_functions[] = "rm_7";
            $update_functions[] = "rm_8";
            $update_functions[] = "rm_9";
            $update_functions[] = "rm_10";
            $update_functions[] = "rm_11";
            $update_functions[] = "rm_12";
            $update_functions[] = "rm_13";
            $update_functions[] = "rm_14";
            $update_functions[] = "rm_15";
            $update_functions[] = "rm_16";
            $update_functions[] = "rm_17";
            $update_functions[] = "rm_18";
            $update_functions[] = "rm_19";
            $update_functions[] = "rm_20";
            $update_functions[] = "rm_21";
            $update_functions[] = "rm_22";
            $update_functions[] = "rm_23";
            $update_functions[] = "rm_24";
            $update_functions[] = "rm_25";
            $update_functions[] = "rm_26";
            $update_functions[] = "rm_27";
            $update_functions[] = "rm_28";
            $update_functions[] = "rm_29";
            $update_functions[] = "rm_30";
            $update_functions[] = "rm_31";
            /*$update_functions[] = "rm_32";
            $update_functions[] = "rm_33";
            $update_functions[] = "rm_34";
            $update_functions[] = "rm_35";
            $update_functions[] = "rm_36";
            $update_functions[] = "rm_37";
            $update_functions[] = "rm_38";
            $update_functions[] = "rm_39";
            $update_functions[] = "rm_40";*/

            $update_functions[] = "clearfolder";
        } elseif ($_SESSION['installtype'] == 'org') {
            $update_functions = array();
            $update_functions[] = "org_rm209_1";
            $update_functions[] = "org_rm209_2";
            $update_functions[] = "org_rm209_3";
            $update_functions[] = "org_rm209_4";
            $update_functions[] = "org_rm209_5";
            $update_functions[] = "org_rm209_6";
            $update_functions[] = "org_rm209_7";
            $update_functions[] = "org_rm209_8";
            $update_functions[] = "org_rm_1";
            $update_functions[] = "clearfolder";

        } elseif ($_SESSION['installtype'] == 'nor') {
            $update_functions = array();
            $update_functions[] = "nor_rm209_1";
            $update_functions[] = "nor_rm209_2";
            $update_functions[] = "nor_rm209_3";
            $update_functions[] = "nor_rm209_4";
            $update_functions[] = "nor_rm209_5";
            $update_functions[] = "nor_rm209_6";
            $update_functions[] = "nor_rm209_7";
            $update_functions[] = "nor_rm209_8";
            $update_functions[] = "nor_rm_1";
            $update_functions[] = "clearfolder";

        } elseif ($_SESSION['installtype'] == 'rm200') {
            $update_functions = array();
            $update_functions[] = "rm_200_201_1";
            $update_functions[] = "rm_200_201_2";
            $update_functions[] = "rm_200_201_3";
            $update_functions[] = "rm_200_201_4";
            $update_functions[] = "rm_200_201_5";
            $update_functions[] = "rm_200_201_6";
            $update_functions[] = "base_2";
            $update_functions[] = "clearfolder";

        } elseif ($_SESSION['installtype'] == 'rm201') {
            $update_functions = array();
            $update_functions[] = "rm_201_202_1";
            $update_functions[] = "rm_201_202_2";
            $update_functions[] = "base_2";
            $update_functions[] = "clearfolder";
        }
        if (count($errors)) {
            $fehler = implode('<br>', array_unique($errors));
            $text = '<div class="list-group-item list-group-item-danger">
            <strong>' . $_language->module['error'] . ':</strong> ' . $fehler . '
        </div>';
        } else {
            $text = update_progress($update_functions);
        }

        $data_array = array();
        $data_array['$in_progress'] = $in_progress;
        $data_array['$is_complete'] = $is_complete;
        $data_array['$text'] = $text;
        $data_array['$type'] = $type;
        $data_array['$view_site'] = $_language->module['view_site'];

        $step04 = $_template->loadTemplate('step04', 'content', $data_array);
        echo $step04;

        $lok = fopen("locked.txt", "w");
        $txt = "installation locked";
        fwrite($lok, $txt);
        fclose($lok);

        $lok = fopen("../locked.txt", "w");
        $txt = "installation locked";
        fwrite($lok, $txt);
        fclose($lok);

        $step04 = $_template->loadTemplate('step04', 'foot', $data_array);
        echo $step04;
} else {
$languages = '';
if ($handle = opendir('./languages/')) {
    while (false !== ($file = readdir($handle))) {
        if (is_dir('./languages/' . $file) && $file != ".." && $file != "." && $file != ".svn") {
            $languages .= '<a class="btn btn-default btn-margin btn-sm" href="index.php?lang=' . $file . '"><img style="width: 25px" src="../images/languages/' . $file . '.png"
            alt="' . $file . '"></a>';
        }
    }
    closedir($handle);
}
if (file_exists("locked.txt")) {
    $step00_content = '<div class="alert alert-danger">'.$_language->module['installerlocked'].'</div>';
} else {
    $data_array = array();
    $data_array['$welcome_text_1'] = $_language->module['welcome_text_1'];
    $data_array['$welcome_text_2'] = $_language->module['welcome_text_2'];
    $data_array['$welcome_text_3'] = $_language->module['welcome_text_3'] . '<br />' . $_language->module['webspell_team'];
    $data_array['$continue'] = $_language->module['continue'];
    $step00_content = $_template->loadTemplate('step00', 'success', $data_array);

}
$data_array = array();
$data_array['$welcome_to'] = $_language->module['welcome_to'];
$data_array['$select_a_language'] = $_language->module['select_a_language'];
$data_array['$languages'] = $languages;
$data_array['$step00_content'] = $step00_content;
$step00 = $_template->loadTemplate('step00', 'content', $data_array);
echo $step00;
}

include('foot.php');
?>
                        

