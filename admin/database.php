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

$_language->readModule('database', false, true);

$ergebnis = safe_query("SELECT * FROM ".PREFIX."navigation_dashboard_links WHERE modulname='ac_database'");
    while ($db=mysqli_fetch_array($ergebnis)) {
      $accesslevel = 'is'.$db['accesslevel'].'admin';

if (!$accesslevel($userID) || mb_substr(basename($_SERVER[ 'REQUEST_URI' ]), 0, 15) != "admincenter.php") {
    die($plugin_language[ 'access_denied' ]);
}
}


if (isset($_POST[ 'upload' ])) {
    

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

if (isset($_GET[ 'delete' ])) {

    $filepath = "myphp-backup-files/";
    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_GET[ 'captcha_hash' ])) {

        $id = $_GET[ 'id' ];
        $dg = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "backups WHERE id='" . $_GET[ 'id' ] . "'"));

        safe_query("DELETE FROM " . PREFIX . "backups WHERE id='" . $_GET[ 'id' ] . "'");
        
        $file = $dg[ 'filename' ];
        
        if (file_exists($filepath . $file)) {
            @unlink($filepath . $file);
        }
        
    } else {
        echo $_language->module[ 'transaction_invalid' ];
    }
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

/**
 * This file contains the Backup_Database class wich performs
 * a partial or complete backup of any given MySQL database
 * @author Daniel López Azaña <daniloaz@gmail.com>
 * @version 1.0
 */

/**
 * Define database parameters here
 */

include("../system/sql.php");


define("DB_USER", $user);
define("DB_PASSWORD", $pwd);
define("DB_NAME", $db);
define("DB_HOST", $host);
define("BACKUP_DIR", 'myphp-backup-files'); // Comment this line to use same script's directory ('.')
define("TABLES", '*'); // Full backup
//define("TABLES", 'table1, table2, table3'); // Partial backup
define('IGNORE_TABLES',array(
    'tbl_token_auth',
    'token_auth'
)); // Tables to ignore
define("CHARSET", 'utf8');
define("GZIP_BACKUP_FILE", true); // Set to false if you want plain SQL backup files (not gzipped)
define("DISABLE_FOREIGN_KEY_CHECKS", true); // Set to true if you are having foreign key constraint fails
define("BATCH_SIZE", 1000); // Batch size when selecting rows from database in order to not exhaust system memory
                            // Also number of rows per INSERT statement in backup file

/**
 * The Backup_Database class
 */
class Backup_Database {
    /**
     * Host where the database is located
     */
    var $host;

    /**
     * Username used to connect to database
     */
    var $user;

    /**
     * Password used to connect to database
     */
    var $pwd;

    /**
     * Database to backup
     */
    var $db;

    /**
     * Database charset
     */
    var $charset;

    /**
     * Database connection
     */
    var $conn;

    /**
     * Backup directory where backup files are stored 
     */
    var $backupDir;

    /**
     * Output backup file
     */
    var $backupFile;

    /**
     * Use gzip compression on backup file
     */
    var $gzipBackupFile;

    /**
     * Content of standard output
     */
    var $output;

    /**
     * Disable foreign key checks
     */
    var $disableForeignKeyChecks;

    /**
     * Batch size, number of rows to process per iteration
     */
    var $batchSize;

    /**
     * Constructor initializes database
     */
    public function __construct($host, $user, $pwd, $db, $charset = 'utf8') {
        $this->host                    = $host;
        $this->user                    = $user;
        $this->pwd                     = $pwd;
        $this->db                      = $db;
        $this->charset                 = $charset;
        $this->conn                    = $this->initializeDatabase();
        $this->backupDir               = BACKUP_DIR ? BACKUP_DIR : '.';
        $this->backupFile              = 'myphp-backup-'.$this->db.'-'.date("Ymd_His", time()).'.sql';
        $this->gzipBackupFile          = defined('GZIP_BACKUP_FILE') ? GZIP_BACKUP_FILE : true;
        $this->disableForeignKeyChecks = defined('DISABLE_FOREIGN_KEY_CHECKS') ? DISABLE_FOREIGN_KEY_CHECKS : true;
        $this->batchSize               = defined('BATCH_SIZE') ? BATCH_SIZE : 1000; // default 1000 rows
        $this->output                  = '';
    }

    protected function initializeDatabase() {
        try {
            $conn = mysqli_connect($this->host, $this->user, $this->pwd, $this->db);
            if (mysqli_connect_errno()) {
                throw new Exception('ERROR connecting database: ' . mysqli_connect_error());
                die();
            }
            if (!mysqli_set_charset($conn, $this->charset)) {
                mysqli_query($conn, 'SET NAMES '.$this->charset);
            }
        } catch (Exception $e) {
            print_r($e->getMessage());
            die();
        }

        return $conn;
    }

    /**
     * Backup the whole database or just some tables
     * Use '*' for whole database or 'table1 table2 table3...'
     * @param string $tables
     */
    public function backupTables($tables = '*') {
        try {
            /**
             * Tables to export
             */
            if($tables == '*') {
                $tables = array();
                $result = mysqli_query($this->conn, 'SHOW TABLES');
                while($row = mysqli_fetch_row($result)) {
                    $tables[] = $row[0];
                }
            } else {
                $tables = is_array($tables) ? $tables : explode(',', str_replace(' ', '', $tables));
            }

            $sql = 'CREATE DATABASE IF NOT EXISTS `'.$this->db.'`'.";\n\n";
            $sql .= 'USE `'.$this->db."`;\n\n";

            /**
             * Disable foreign key checks 
             */
            if ($this->disableForeignKeyChecks === true) {
                $sql .= "SET foreign_key_checks = 0;\n\n";
            }

            /**
             * Iterate tables
             */
            foreach($tables as $table) {
                if( in_array($table, IGNORE_TABLES) )
                    continue;
                $this->obfPrint("Backing up `".$table."` table...".str_repeat('.', 50-strlen($table)), 0, 0);

                /**
                 * CREATE TABLE
                 */
                $sql .= 'DROP TABLE IF EXISTS `'.$table.'`;';
                $row = mysqli_fetch_row(mysqli_query($this->conn, 'SHOW CREATE TABLE `'.$table.'`'));
                $sql .= "\n\n".$row[1].";\n\n";

                /**
                 * INSERT INTO
                 */

                $row = mysqli_fetch_row(mysqli_query($this->conn, 'SELECT COUNT(*) FROM `'.$table.'`'));
                $numRows = $row[0];

                // Split table in batches in order to not exhaust system memory 
                $numBatches = intval($numRows / $this->batchSize) + 1; // Number of while-loop calls to perform

                for ($b = 1; $b <= $numBatches; $b++) {
                    
                    $query = 'SELECT * FROM `' . $table . '` LIMIT ' . ($b * $this->batchSize - $this->batchSize) . ',' . $this->batchSize;
                    $result = mysqli_query($this->conn, $query);
                    $realBatchSize = mysqli_num_rows ($result); // Last batch size can be different from $this->batchSize
                    $numFields = mysqli_num_fields($result);

                    if ($realBatchSize !== 0) {
                        $sql .= 'INSERT INTO `'.$table.'` VALUES ';

                        for ($i = 0; $i < $numFields; $i++) {
                            $rowCount = 1;
                            while($row = mysqli_fetch_row($result)) {
                                $sql.='(';
                                for($j=0; $j<$numFields; $j++) {
                                    if (isset($row[$j])) {
                                        $row[$j] = addslashes($row[$j]);
                                        $row[$j] = str_replace("\n","\\n",$row[$j]);
                                        $row[$j] = str_replace("\r","\\r",$row[$j]);
                                        $row[$j] = str_replace("\f","\\f",$row[$j]);
                                        $row[$j] = str_replace("\t","\\t",$row[$j]);
                                        $row[$j] = str_replace("\v","\\v",$row[$j]);
                                        $row[$j] = str_replace("\a","\\a",$row[$j]);
                                        $row[$j] = str_replace("\b","\\b",$row[$j]);
                                        if ($row[$j] == 'true' or $row[$j] == 'false' or preg_match('/^-?[1-9][0-9]*$/', $row[$j]) or $row[$j] == 'NULL' or $row[$j] == 'null') {
                                            $sql .= $row[$j];
                                        } else {
                                            $sql .= '"'.$row[$j].'"' ;
                                        }
                                    } else {
                                        $sql.= 'NULL';
                                    }
    
                                    if ($j < ($numFields-1)) {
                                        $sql .= ',';
                                    }
                                }
    
                                if ($rowCount == $realBatchSize) {
                                    $rowCount = 0;
                                    $sql.= ");\n"; //close the insert statement
                                } else {
                                    $sql.= "),\n"; //close the row
                                }
    
                                $rowCount++;
                            }
                        }
    
                        $this->saveFile($sql);
                        $sql = '';
                    }
                }

                /**
                 * CREATE TRIGGER
                 */

                // Check if there are some TRIGGERS associated to the table
                /*$query = "SHOW TRIGGERS LIKE '" . $table . "%'";
                $result = mysqli_query ($this->conn, $query);
                if ($result) {
                    $triggers = array();
                    while ($trigger = mysqli_fetch_row ($result)) {
                        $triggers[] = $trigger[0];
                    }
                    
                    // Iterate through triggers of the table
                    foreach ( $triggers as $trigger ) {
                        $query= 'SHOW CREATE TRIGGER `' . $trigger . '`';
                        $result = mysqli_fetch_array (mysqli_query ($this->conn, $query));
                        $sql.= "\nDROP TRIGGER IF EXISTS `" . $trigger . "`;\n";
                        $sql.= "DELIMITER $$\n" . $result[2] . "$$\n\nDELIMITER ;\n";
                    }

                    $sql.= "\n";

                    $this->saveFile($sql);
                    $sql = '';
                }*/
 
                $sql.="\n\n";

                $this->obfPrint('OK');
            }

            /**
             * Re-enable foreign key checks 
             */
            if ($this->disableForeignKeyChecks === true) {
                $sql .= "SET foreign_key_checks = 1;\n";
            }

            $this->saveFile($sql);

            if ($this->gzipBackupFile) {
                $this->gzipBackupFile();
            } else {
                $this->obfPrint('Backup file succesfully saved to ' . $this->backupDir.'/'.$this->backupFile, 1, 1);
            }
        } catch (Exception $e) {
            print_r($e->getMessage());
            return false;
        }

        return true;
    }

    /**
     * Save SQL to file
     * @param string $sql
     */
    protected function saveFile(&$sql) {
        if (!$sql) return false;

        try {

            if (!file_exists($this->backupDir)) {
                mkdir($this->backupDir, 0777, true);
            }

            file_put_contents($this->backupDir.'/'.$this->backupFile, $sql, FILE_APPEND | LOCK_EX);

        } catch (Exception $e) {
            print_r($e->getMessage());
            return false;
        }

        return true;
    }

    /*
     * Gzip backup file
     *
     * @param integer $level GZIP compression level (default: 9)
     * @return string New filename (with .gz appended) if success, or false if operation fails
     */
    protected function gzipBackupFile($level = 9) {
        if (!$this->gzipBackupFile) {
            return true;
        }

        $source = $this->backupDir . '/' . $this->backupFile;
        $backupFile = $this->backupFile . '.gz';
        $dest =  $source . '.gz';

        $this->obfPrint('Gzipping backup file to ' . $dest . '... ', 1, 0);
global $userID;
        safe_query(
        "INSERT INTO
            " . PREFIX . "backups (
                filename,
                description,
                createdby
            )
            VALUES (
                '" . $backupFile . "',
                '" . $backupFile . "',
                '" . $userID . "'
                )"
    );
    


        $mode = 'wb' . $level;
        if ($fpOut = gzopen($dest, $mode)) {
            if ($fpIn = fopen($source,'rb')) {
                while (!feof($fpIn)) {
                    gzwrite($fpOut, fread($fpIn, 1024 * 256));
                }
                fclose($fpIn);
            } else {
                return false;
            }
            gzclose($fpOut);
            if(!unlink($source)) {
                return false;
            }
        } else {
            return false;
        }
        
        $this->obfPrint('OK');
        return $dest;


         
    }

    /**
     * Prints message forcing output buffer flush
     *
     */
    public function obfPrint ($msg = '', $lineBreaksBefore = 0, $lineBreaksAfter = 1) {
        if (!$msg) {
            return false;
        }

        if ($msg != 'OK' and $msg != 'KO') {
            $msg = date("Y-m-d H:i:s") . ' - ' . $msg;
        }
        $output = '';

        if (php_sapi_name() != "cli") {
            $lineBreak = "<br />";
        } else {
            $lineBreak = "\n";
        }

        if ($lineBreaksBefore > 0) {
            for ($i = 1; $i <= $lineBreaksBefore; $i++) {
                $output .= $lineBreak;
            }                
        }

        $output .= $msg;

        if ($lineBreaksAfter > 0) {
            for ($i = 1; $i <= $lineBreaksAfter; $i++) {
                $output .= $lineBreak;
            }                
        }


        // Save output for later use
        $this->output .= str_replace('<br />', '\n', $output);

        echo $output;


        if (php_sapi_name() != "cli") {
            if( ob_get_level() > 0 ) {
                ob_flush();
            }
        }

        $this->output .= " ";

        flush();
    }

    /**
     * Returns full execution output
     *
     */
    public function getOutput() {
        return $this->output;
    }
    /**
     * Returns name of backup file
     *
     */
    public function getBackupFile() {
        if ($this->gzipBackupFile) {
            return $this->backupDir.'/'.$this->backupFile.'.gz';
        } else
        return $this->backupDir.'/'.$this->backupFile;
    }

    /**
     * Returns backup directory path
     *
     */
    public function getBackupDir() {
        return $this->backupDir;
    }

    /**
     * Returns array of changed tables since duration
     *
     */
    public function getChangedTables($since = '1 day') {
        @$query = "SELECT TABLE_NAME,update_time FROM information_schema.tables WHERE table_schema='" . $this->dbName . "'";

        $result = mysqli_query($this->conn, $query);
        while($row=mysqli_fetch_assoc($result)) {
            $resultset[] = $row;
            }       
        if(empty($resultset))
            return false;
        $tables = [];
        for ($i=0; $i < count($resultset); $i++) {
            if( in_array($resultset[$i]['TABLE_NAME'], IGNORE_TABLES) ) // ignore this table
                continue;
            if(strtotime('-' . $since) < strtotime($resultset[$i]['update_time']))
                $tables[] = $resultset[$i]['TABLE_NAME'];
        }
        return ($tables) ? $tables : false;
    }
}


/**
 * Instantiate Backup_Database and perform backup
 */

// Report all errors
error_reporting(E_ALL);
// Set script max execution time
set_time_limit(900); // 15 minutes

if (php_sapi_name() != "cli") {
    echo '<div class="card">
  <div class="card-header">
            Backup
        </div>
  <div class="card-body"><div class="alert alert-success" role="alert">';
}

$backupDatabase = new Backup_Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, CHARSET);

// Option-1: Backup tables already defined above
$result = $backupDatabase->backupTables(TABLES) ? 'OK' : 'KO';

// Option-2: Backup changed tables only - uncomment block below
/*
$since = '1 day';
$changed = $backupDatabase->getChangedTables($since);
if(!$changed){
  $backupDatabase->obfPrint('No tables modified since last ' . $since . '! Quitting...', 1);
  redirect("admincenter.php?site=database", "", );
  die();
}
$result = $backupDatabase->backupTables($changed) ? 'OK' : 'KO';
*/


$backupDatabase->obfPrint('Backup result: ' . $result, 1);

// Use $output variable for further processing, for example to send it by email
$output = $backupDatabase->getOutput();

if (php_sapi_name() != "cli") {
    echo '</div><a class="btn btn-secondary" href="admincenter.php?site=database" role="button">Go Back</a></div></div>';
}


} elseif ($action == "back") {

    /**
 * This file contains the Restore_Database class wich performs
 * a partial or complete restoration of any given MySQL database
 * @author Daniel López Azaña <daniloaz@gmail.com>
 * @version 1.0
 */

/**
 * Define database parameters here
 */

$ds = mysqli_fetch_array(safe_query(
            "SELECT * FROM " . PREFIX . "backups WHERE id='" . $_GET[ "id" ] . "'AND filename=filename"));  
include("../system/sql.php");
global $filename;

define("DB_USER", $user);
define("DB_PASSWORD", $pwd);
define("DB_NAME", $db);
define("DB_HOST", $host);
define("BACKUP_DIR", 'myphp-backup-files'); // Comment this line to use same script's directory ('.')
define("BACKUP_FILE", $ds['filename']); // Script will autodetect if backup file is gzipped based on .gz extension
define("CHARSET", 'utf8');
define("DISABLE_FOREIGN_KEY_CHECKS", true); // Set to true if you are having foreign key constraint fails
print_r($filename);
/**
 * The Restore_Database class
 */
class Restore_Database {
    /**
     * Host where the database is located
     */
    var $host;

    /**
     * Username used to connect to database
     */
    var $user;

    /**
     * Password used to connect to database
     */
    var $pwd;

    /**
     * Database to backup
     */
    var $db;

    /**
     * Database charset
     */
    var $charset;

    /**
     * Database connection
     */
    var $conn;

    /**
     * Disable foreign key checks
     */
    var $disableForeignKeyChecks;

    /**
     * Constructor initializes database
     */
    public function __construct($host, $user, $pwd, $db, $charset = 'utf8') {
        $this->host                    = $host;
        $this->user                    = $user;
        $this->pwd                     = $pwd;
        $this->db                      = $db;
        $this->charset                 = $charset;
        $this->disableForeignKeyChecks = defined('DISABLE_FOREIGN_KEY_CHECKS') ? DISABLE_FOREIGN_KEY_CHECKS : true;
        $this->conn                    = $this->initializeDatabase();
        $this->backupDir               = defined('BACKUP_DIR') ? BACKUP_DIR : '.';
        $this->backupFile              = defined('BACKUP_FILE') ? BACKUP_FILE : null;
    }

    /**
     * Destructor re-enables foreign key checks
     */
    function __destructor() {
        /**
         * Re-enable foreign key checks 
         */
        if ($this->disableForeignKeyChecks === true) {
            mysqli_query($this->conn, 'SET foreign_key_checks = 1');
        }
    }

    protected function initializeDatabase() {
        try {
            $conn = mysqli_connect($this->host, $this->user, $this->pwd, $this->db);
            if (mysqli_connect_errno()) {
                throw new Exception('ERROR connecting database: ' . mysqli_connect_error());
                die();
            }
            if (!mysqli_set_charset($conn, $this->charset)) {
                mysqli_query($conn, 'SET NAMES '.$this->charset);
            }

            /**
             * Disable foreign key checks 
             */
            if ($this->disableForeignKeyChecks === true) {
                mysqli_query($conn, 'SET foreign_key_checks = 0');
            }

        } catch (Exception $e) {
            print_r($e->getMessage());
            die();
        }

        return $conn;
    }

    /**
     * Backup the whole database or just some tables
     * Use '*' for whole database or 'table1 table2 table3...'
     * @param string $tables
     */
    public function restoreDb() {
        try {
            $sql = '';
            $multiLineComment = false;

            $backupDir = $this->backupDir;
            $backupFile = $this->backupFile;

            /**
             * Gunzip file if gzipped
             */
            $backupFileIsGzipped = substr($backupFile, -3, 3) == '.gz' ? true : false;
            if ($backupFileIsGzipped) {
                if (!$backupFile = $this->gunzipBackupFile()) {
                    throw new Exception("ERROR: couldn't gunzip backup file " . $backupDir . '/' . $backupFile);
                }
            }

            /**
            * Read backup file line by line
            */
            $handle = fopen($backupDir . '/' . $backupFile, "r");
            if ($handle) {
                while (($line = fgets($handle)) !== false) {
                    $line = ltrim(rtrim($line));
                    if (strlen($line) > 1) { // avoid blank lines
                        $lineIsComment = false;
                        if (preg_match('/^\/\*/', $line)) {
                            $multiLineComment = true;
                            $lineIsComment = true;
                        }
                        if ($multiLineComment or preg_match('/^\/\//', $line)) {
                            $lineIsComment = true;
                        }
                        if (!$lineIsComment) {
                            $sql .= $line;
                            if (preg_match('/;$/', $line)) {
                                // execute query
                                if(mysqli_query($this->conn, $sql)) {
                                    if (preg_match('/^CREATE TABLE `([^`]+)`/i', $sql, $tableName)) {
                                        $this->obfPrint("Table succesfully created: `" . $tableName[1] . "`");
                                    }
                                    $sql = '';
                                } else {
                                    throw new Exception("ERROR: SQL execution error: " . mysqli_error($this->conn));
                                }
                            }
                        } else if (preg_match('/\*\/$/', $line)) {
                            $multiLineComment = false;
                        }
                    }
                }
                fclose($handle);
            } else {
                throw new Exception("ERROR: couldn't open backup file " . $backupDir . '/' . $backupFile);
            } 
        } catch (Exception $e) {
            print_r($e->getMessage());
            return false;
        }

        if ($backupFileIsGzipped) {
            unlink($backupDir . '/' . $backupFile);
        }

        return true;
    }

    /*
     * Gunzip backup file
     *
     * @return string New filename (without .gz appended and without backup directory) if success, or false if operation fails
     */
    protected function gunzipBackupFile() {
        // Raising this value may increase performance
        $bufferSize = 4096; // read 4kb at a time
        $error = false;

        $source = $this->backupDir . '/' . $this->backupFile;
        $dest = $this->backupDir . '/' . date("Ymd_His", time()) . '_' . substr($this->backupFile, 0, -3);

        $this->obfPrint('Gunzipping backup file ' . $source . '... ', 1, 1);

        // Remove $dest file if exists
        if (file_exists($dest)) {
            if (!unlink($dest)) {
                return false;
            }
        }
        
        // Open gzipped and destination files in binary mode
        if (!$srcFile = gzopen($this->backupDir . '/' . $this->backupFile, 'rb')) {
            return false;
        }
        if (!$dstFile = fopen($dest, 'wb')) {
            return false;
        }

        while (!gzeof($srcFile)) {
            // Read buffer-size bytes
            // Both fwrite and gzread are binary-safe
            if(!fwrite($dstFile, gzread($srcFile, $bufferSize))) {
                return false;
            }
        }

        fclose($dstFile);
        gzclose($srcFile);

        // Return backup filename excluding backup directory
        return str_replace($this->backupDir . '/', '', $dest);
    }

    /**
     * Prints message forcing output buffer flush
     *
     */
    public function obfPrint ($msg = '', $lineBreaksBefore = 0, $lineBreaksAfter = 1) {
        if (!$msg) {
            return false;
        }

        $msg = date("Y-m-d H:i:s") . ' - ' . $msg;
        $output = '';

        if (php_sapi_name() != "cli") {
            $lineBreak = "<br />";
        } else {
            $lineBreak = "\n";
        }

        if ($lineBreaksBefore > 0) {
            for ($i = 1; $i <= $lineBreaksBefore; $i++) {
                $output .= $lineBreak;
            }                
        }

        $output .= $msg;

        if ($lineBreaksAfter > 0) {
            for ($i = 1; $i <= $lineBreaksAfter; $i++) {
                $output .= $lineBreak;
            }                
        }

        if (php_sapi_name() == "cli") {
            $output .= "\n";
        }

        echo $output;

        if (php_sapi_name() != "cli") {
            ob_flush();
        }

        flush();
    }
}

/**
 * Instantiate Restore_Database and perform backup
 */
// Report all errors
error_reporting(E_ALL);
// Set script max execution time
set_time_limit(900); // 15 minutes

if (php_sapi_name() != "cli") {
     echo '<div class="card">
  <div class="card-header">
            Backup
        </div>
  <div class="card-body"><div class="alert alert-info" role="alert">';
}

$restoreDatabase = new Restore_Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$result = $restoreDatabase->restoreDb(BACKUP_DIR, BACKUP_FILE) ? 'OK' : 'KO';
$restoreDatabase->obfPrint("Restoration result: ".$result, 1);

if (php_sapi_name() != "cli") {
    echo '</div><a class="btn btn-secondary" href="admincenter.php?site=database" role="button">Go Back</a></div></div>';
}


} else {
    $_language->readModule('database', false, true);

    if (!ispageadmin($userID) || mb_substr(basename($_SERVER[ 'REQUEST_URI' ]), 0, 15) != "admincenter.php") {
        die($_language->module[ 'access_denied' ]);
    }

    $CAPCLASS = new \webspell\Captcha;
    $CAPCLASS->createTransaction();
    $hash = $CAPCLASS->getHash();
  
  echo'<div class="card">
  <div class="card-header">
                            <i class="fa fa-database"></i> '.$_language->module['database'].'
                        </div>
                        <div class="card-body">

<div class="row">

<div class="col-md-6">

    <div class="row bt"><div class="col-md-4">'.$_language->module['select_option'].':</div>
    <div class="col-md-7"><span class="pull-right text-muted small"><em>
    <a class="btn btn-primary" href="admincenter.php?site=database&amp;action=write&amp;captcha_hash='.$hash.'">'.$_language->module['export'].'</a><br><br>
    '.$_language->module['import_info1'].'</em></span></div></div>
    
</div>


<div class="col-md-6">

    <div class="row bt">
    <div class="col-md-6">
    <span class="text-muted small"><em>

    <form class="form-horizontal" method="post" action="admincenter.php?site=database" enctype="multipart/form-data">
        <div class="form-group">
        '.$_language->module['backup_file'].': <input name="sql" type="file" size="40" / ><br>
    
        <input type="hidden" name="captcha_hash" value="'.$hash.'" />
        <button class="btn btn-primary" type="submit" name="upload"  />'.$_language->module['upload'].'</button>
    
        </div>
    </form>
    </em></span>
    </div>
    <div class="col-md-6">
        <a class="btn btn-primary" href="admincenter.php?site=database&amp;action=optimize">'.$_language->module['optimize'].'</a>
    </div>


    <form class="form-horizontal" method="post" action="admincenter.php?site=database" enctype="multipart/form-data">
      <div class="form-group">
      '.$_language->module['backup_file'].':
    <br>
       <p class="form-control-static"> <input name="sql" type="file" size="40" / ></p>
    
        <input type="hidden" name="captcha_hash" value="'.$hash.'" />
        <button class="btn btn-primary" type="submit" name="upload"  />'.$_language->module['upload'].'</button>
    </div>
  </div>
     

  </form>





  </div>
  </div>
    
</div>

</div></div>';

  

  echo'<div class="card">
  <div class="card-header">
                            <i class="fa fa-database"></i> '.$_language->module['sql_query'].'
                        </div>
            <div class="card-body">';
	
  echo '<form method="post" action="admincenter.php?site=database">
  <table class="table">
  <thead>
    <tr>
    <td colspan="8" bgcolor="#ffe6e6" style="font-weight: bold; color: #333; line-height: 20px;padding: 10px;">
    '.$_language->module['import_info2'].'
    </td></tr>
    <tr>
      <th>ID</th>
      <th>Datei</th>
      <th>Datum</th>
      <th>Erstellt von</th>
      <th>Actions</th>
    </tr>
    </thead>
  <tbody>';

  $CAPCLASS = new \webspell\Captcha;
    $CAPCLASS->createTransaction();
    $hash = $CAPCLASS->getHash();

    $select_query = "SELECT * FROM ".PREFIX."backups";
        $result = safe_query($select_query);
        $backups = array();
        while($ds = mysqli_fetch_array($result)) {

    
        $id             = $ds['id'];
        $filename       = $ds['filename'];
        $description    = $ds['description'];
        $createdby      = getnickname($ds['createdby']);
        $createdate     = date("d/m/Y h:i:sa", strtotime($ds['createdate']));
        $file_exists    = "<img src='../images/icons/offline.gif' alt='' />";
        $download_url   = "/admin/myphp-backup-files/";

        echo'<tr>
    <td>'.$ds['id'].'</td>
    <td>'.$ds['description'].'</td>
    <td>'.$ds['createdate'].'</td>
    <td>'.$createdby.'</td>
    
    <td>
        <a class="btn btn-primary" href="'.$download_url.''.$description.'" role="button">Download</a>

        <a type="button" class="btn btn-warning" href="admincenter.php?site=database&amp;action=back&amp;id='. $ds[ 'id' ]. '" >'.$_language->module['upload'].'</a>

<input class="btn btn-danger" type="button" onclick="MM_confirm(\''.$_language->module['really_delete'].'\', \'admincenter.php?site=database&amp;delete=true&amp;id='. $ds[ 'id' ]. '&amp;captcha_hash='.$hash.'\')" value="'.$_language->module['delete'].'" />

        
  </td>
  </tr>';
        $first_line = "";
    }
    
    echo'</tbody></table>


  </form>
  </div></div>';
}

?>