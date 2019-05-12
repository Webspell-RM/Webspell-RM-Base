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
?>

<div class="card">
    <div class="card-head">
        <h3 class="card-title"><?php echo $_language->module['finish_install']; ?></h3>
    </div>
    <div class="card-body">
    <?php
        include('functions.php');
        $errors = array();

        if ($_POST['installtype'] != "full") {
            include('../system/sql.php');
            @$_database = new mysqli($host, $user, $pwd, $db);

            if (mysqli_connect_error()) {
                $errors[] = $_language->module['error_mysql'];
            }

            $type = '<b>' . $_language->module['update_complete'] . '</b>';
            $in_progress = $_language->module['update_running'];
        }

        if ($_POST['installtype'] == 'update') {
            #$update_functions = array();
            #$update_functions[] = "xyz";

        } elseif ($_POST['installtype'] == 'full') {
            $type = '<b>' . $_language->module['install_complete'] . '</b>';
            $in_progress = $_language->module['install_running'];

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

            @$_database = new mysqli($host, $user, $pwd, $db);

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
            $update_functions[] = "base_1";
            $update_functions[] = "base_2";
            $update_functions[] = "base_3";
            $update_functions[] = "base_4";
            $update_functions[] = "base_5";
            $update_functions[] = "base_6";
            $update_functions[] = "base_7";
            $update_functions[] = "base_8";
            $update_functions[] = "base_9";
            $update_functions[] = "base_10";

        }

        if (count($errors)) {
            $fehler = implode('<br>', array_unique($errors));

            $text = '<div class="alert alert-danger" role="alert">
            <strong>' . $_language->module['error'] . ':</strong> ' . $fehler . '
        </div>';
        } else {
            $text = update_progress($update_functions);
        }

        #Löschung von dem Install-Ordner nach installation!
        /*include("../includes/func/filesystem.php");
        $remove_install = @rm_recursive("./");
        if($remove_install) $delete_info = $_language->module['folder_removed'];
        else $delete_info = $_language->module['delete_folder'];*/
        ?>

        <h2><?php echo $in_progress; ?></h2>
        <?php echo $text; ?>
        <div id="result" style="display:none;">
            <h3><?=$type;?></h3>
            <center>
                <div class="pull-right">
                    <a class="btn btn-primary btn-margin btn-orange" href="../index.php">
                        <?=$_language->module['view_site']; ?>
                    </a>
                </div>
            </center>
        </div>
        <?php
            $lok = fopen("locked.txt", "w");
            $txt = "installation locked";
            fwrite($lok, $txt);
            fclose($lok);
        ?>
    </div>
</div><!-- row end -->