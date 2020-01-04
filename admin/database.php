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


if (isset($_POST[ 'upload' ])) {
    $_language->readModule('database', false, true);

    if (!ispageadmin($userID) || mb_substr(basename($_SERVER[ 'REQUEST_URI' ]), 0, 15) != "admincenter.php") {
        die($_language->module[ 'access_denied' ]);
    }
    $upload = $_FILES[ 'sql' ];
    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_POST[ 'captcha_hash' ])) {
        if ($upload[ 'name' ] != "") {
            $get = safe_query("SELECT DATABASE()");
            $ret = mysqli_fetch_array($get);
            $db = $ret[ 0 ];
            //drop all tables from webSPELL DB
            $result = mysqli_query($_database, "SHOW TABLES FROM " . $db);
            while ($table = mysqli_fetch_array($result)) {
                safe_query("DROP TABLE `" . $table[ 0 ] . "`");
            }

            $tmpFile = tempnam('../tmp/', '.database');
            move_uploaded_file($upload[ 'tmp_name' ], $tmpFile);
            $new_query = file($tmpFile);
            foreach ($new_query as $query) {
                @mysqli_query($_database, $query);
            }
            @unlink($tmpFile);
        }
    } else {
        echo $_language->module[ 'transaction_invalid' ];
    }
}

if (isset($_GET[ 'action' ])) {
    $action = $_GET[ 'action' ];
} else {
    $action = '';
}

if (isset($_GET[ 'back' ])) {
    $returnto = $_GET[ 'back' ];
} else {
    $returnto = "database";
}

if ($action == "optimize") {
    $_language->readModule('database', false, true);

    echo '<h1>&curren; ' . $_language->module[ 'database' ] . '</h1>';

    if (!ispageadmin($userID) || mb_substr(basename($_SERVER[ 'REQUEST_URI' ]), 0, 15) != "admincenter.php") {
        die($_language->module[ 'access_denied' ]);
    }

    $get = safe_query("SELECT DATABASE()");
    $ret = mysqli_fetch_array($get);
    $db = $ret[ 0 ];

    $result = mysqli_query($_database, "SHOW TABLES FROM " . $db);
    while ($table = mysqli_fetch_array($result)) {
        safe_query("OPTIMIZE TABLE `" . $table[ 0 ] . "`");
    }
    redirect('admincenter.php?site=' . $returnto, '', 0);
} elseif ($action == "write") {
    chdir('../');
include("system/sql.php");
include("system/settings.php");
include("system/version.php");
    systeminc("func/captcha");

    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_GET[ 'captcha_hash' ])) {
        //Get database information and write SQL-commands
        $final = "--   #webSPELL " . $version . ", visit webspell-RM.de#\n";
        $final .= "--   webSPELL-RM.de database backup\n";
        $final .= "--\n";
        $final .= "--   webSPELL version: " . $version . "\n";
        $final .= "--   PHP version: " . phpversion() . "\n";
        $final .= "--   MySQL version: " . mysqli_get_server_info($_database) . "\n";
        $final .= "--   Date: " . date("r") . "\n";

        $result = mysqli_query($_database, "SHOW TABLE STATUS");
        while ($table = mysqli_fetch_array($result, MYSQLI_BOTH)) {
            $i = 0;
            $result2 = mysqli_query($_database, "SHOW COLUMNS FROM $table[0]");
            $z = mysqli_num_rows($result2);
            $final .=
                "\n--\n-- webSPELL DB Export - Table structure for table `" . $table[ 0 ] . "`\n--\n\nCREATE TABLE `" .
                $table[ 0 ] . "` (";
            $prikey = false;
            $insert_keys = null;
            while ($row2 = mysqli_fetch_assoc($result2)) {
                $i++;
                $insert_keys .= "`" . $row2[ 'Field' ] . "`";
                $final .= "`" . $row2[ 'Field' ] . "` " . $row2[ 'Type' ];
                if ($row2[ 'Null' ] != "YES") {
                    $final .= " NOT NULL";
                }
                if ($row2[ 'Default' ]) {
                    $final .= " DEFAULT '" . $row2[ 'Default' ] . "'";
                }
                if ($row2[ 'Extra' ]) {
                    $final .= " " . $row2[ 'Extra' ];
                }
                if ($row2[ 'Key' ] == "PRI") {
                    $final .= ", PRIMARY KEY  (`" . $row2[ 'Field' ] . "`)";
                    $prikey = true;
                }
                if ($i < $z) {
                    $final .= ", ";
                    $insert_keys .= ", ";
                } else {
                    $final .= " ";
                }
            }
            if ($prikey) {
                if ($table[ 10 ]) {
                    $auto_inc = " AUTO_INCREMENT=" . $table[ 10 ];
                } else {
                    $auto_inc = " AUTO_INCREMENT=1";
                }
            } else {
                $auto_inc = "";
            }
            $charset = explode("_", $table[ 14 ]);
            $final .= ") ENGINE=" . $table[ 1 ] . " DEFAULT CHARSET=" . $charset[ 0 ] . " COLLATE=" . $table[ 14 ] .
                $auto_inc . ";\n\n--\n-- webSPELL DB Export - Dumping data for table `" . $table[ 0 ] . "`\n--\n";

            $inhaltq = mysqli_query($_database, "SELECT * FROM $table[0]");
            while ($inhalt = mysqli_fetch_array($inhaltq, MYSQLI_BOTH)) {
                $final .= "\nINSERT INTO `$table[0]` (";
                $final .= $insert_keys;
                $final .= ") VALUES (";
                for ($i = 0; $i < $z; $i++) {
                    $inhalt[ $i ] = str_replace("'", "`", $inhalt[ $i ]);
                    $inhalt[ $i ] = str_replace("\\", "\\\\", $inhalt[ $i ]);
                    $einschub = "'" . $inhalt[ $i ] . "'";
                    $final .= preg_replace('/\r\n|\r|\n/', '\r\n', $einschub);
                    if (($i + 1) < $z) {
                        $final .= ", ";
                    }
                }
                $final .= ");";
            }
            $final .= "\n";
        }

        systeminc('session');
        systeminc('login');

        $anz = mysqli_num_rows(safe_query(
            "SELECT userID FROM " . PREFIX .
            "user_groups WHERE (page='1' OR super='1') AND userID='$userID'"
        ));

        if ($anz) {
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("Content-Type: application/force-download");
            header("Content-Description: File Transfer");
            if (is_integer(mb_strpos(strtolower($_SERVER[ "HTTP_USER_AGENT" ]), "msie")) &&
                is_integer(mb_strpos(strtolower($_SERVER[ "HTTP_USER_AGENT" ]), "win"))
            ) {
                header("Content-Disposition: filename=backup-" . strtolower(date("D-d-M-Y")) . ".sql;");
            } else {
                header("Content-Disposition: attachment; filename=backup-" . strtolower(date("D-d-M-Y")) . ".sql;");
            }
            header("Content-Transfer-Encoding: binary");
            echo $final;
        }
    } else {
        echo $_language->readModule('database', false, true) . $_language->module[ 'transaction_invalid' ];
    }
} else {
    $_language->readModule('database', false, true);

    if (!ispageadmin($userID) || mb_substr(basename($_SERVER[ 'REQUEST_URI' ]), 0, 15) != "admincenter.php") {
        die($_language->module[ 'access_denied' ]);
    }

    $CAPCLASS = new \webspell\Captcha;
    $CAPCLASS->createTransaction();
    $hash = $CAPCLASS->getHash();
  
  echo'<div class="panel panel-default">
  <div class="panel-heading">
                            <i class="fa fa-database"></i> '.$_language->module['database'].'
                        </div>
                        <div class="panel-body">

<div class="row">

<div class="col-md-4">

    <div class="row bt"><div class="col-md-5">'.$_language->module['select_option'].':</div><div class="col-md-7"><span class="pull-right text-muted small"><em><a class="btn btn-primary" href="database.php?action=write&amp;captcha_hash='.$hash.'">'.$_language->module['export'].'</a><br><br><a class="btn btn-primary" href="admincenter.php?site=database&amp;action=optimize">'.$_language->module['optimize'].'</a></em></span></div></div>
    
</div>


<div class="col-md-8">

    <div class="row bt"><div class="col-md-5">'.$_language->module['import_info'].':</div><div class="col-md-5"><span class="pull-right text-muted small"><em>

    <form class="form-horizontal" method="post" action="admincenter.php?site=database" enctype="multipart/form-data">
      <div class="form-group">
      '.$_language->module['backup_file'].':
    <br>
       <p class="form-control-static"><!-- <input name="sql" type="file" size="40" / --></p>
    
        <input type="hidden" name="captcha_hash" value="'.$hash.'" />
        <!--<button class="btn btn-primary" type="submit" name="upload"  />'.$_language->module['upload'].'</button>-->
    </div>
  </div>
     

  </form>

  </em></span></div></div>
    
</div>







</div></div>';

  

  echo'<div class="panel panel-default">
  <div class="panel-heading">
                            <i class="fa fa-database"></i> '.$_language->module['sql_query'].'
                        </div>
            <div class="panel-body">';
	
  echo '<form method="post" action="admincenter.php?site=database">
  <table width="100%" border="0" cellspacing="1" cellpadding="3" bgcolor="#DDDDDD">
    
    <tr>
      <td class="td1">'.$_language->module['allowed_commands'].'
      <br /><br />'.$_language->module['sql_query'].':<br /><br />
      <!--<textarea class="form-group" name="query" rows="10" cols="" style="width: 100%;"></textarea>
      <br /><br /><input class="btn btn-primary" type="submit" name="submit" value="'.$_language->module['submit'].'" /> --></td>
    </tr>
  </table>
  </form>
  </div></div>';
}

?>