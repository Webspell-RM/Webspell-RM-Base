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
$_language->readModule('banned_ips', false, true);

$ergebnis = safe_query("SELECT * FROM ".PREFIX."navigation_dashboard_links WHERE modulname='banned_ips'");
    while ($db=mysqli_fetch_array($ergebnis)) {
      $accesslevel = 'is'.$db['accesslevel'].'admin';

if (!$accesslevel($userID) || mb_substr(basename($_SERVER[ 'REQUEST_URI' ]), 0, 15) != "admincenter.php") {
    die($_language->module[ 'access_denied' ]);
}
}

if (isset($_GET[ 'delete' ])) {
    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_GET[ 'captcha_hash' ])) {
        $banID = (int)$_GET[ 'banID' ];
        safe_query("DELETE FROM " . PREFIX . "banned_ips WHERE banID='" . $banID . "' ");
        
    } else {
        echo $_language->module[ 'transaction_invalid' ];
    }
} 

echo'<div class="card">
        <div class="card-header">
            <i class="fas fa-exclamation-triangle"></i> '.$_language->module[ 'bannedips' ].'
        </div>
            <div class="card-body"><br>
';
  
  $row = safe_query("SELECT * FROM " . PREFIX . "banned_ips");
    $tmp = mysqli_fetch_assoc(safe_query("SELECT count(banID) as cnt FROM " . PREFIX . "banned_ips"));
    $anzpartners = $tmp[ 'cnt' ];
    $CAPCLASS = new \webspell\Captcha;
    $CAPCLASS->createTransaction();
    $hash = $CAPCLASS->getHash();

   
  
    echo'   <table class="table table-striped">
    <thead>
      
      <th><b>'.$_language->module['id'].'</b></th>
      <th><b>'.$_language->module['ip'].'</b></th>
      <th><b>'.$_language->module['deltime'].'</b></th>
      <th><b>'.$_language->module['reason'].'</b></th>
      <th><b>'.$_language->module['actions'].'</b></th>
    </thead>';

   $i = 1;
    while ($db = mysqli_fetch_array($row)) {

echo '<tr>
        <td>'.getinput($db['banID']).'</td>
        <td>'.getinput($db['ip']).'</td>
        <td>' . getformatdate($db[ 'deltime' ]) . '</td>
        <td>'.getinput($db['reason']).'</td>

        <td>

        <input class="btn btn-danger" type="button" onclick="MM_confirm(\'' . $_language->module['really_delete'] . '\', \'admincenter.php?site=banned_ips&amp;delete=true&amp;banID='.$db['banID'].'&amp;captcha_hash='.$hash.'\')" value="' . $_language->module['delete'] . '" />  
        </td>
      </tr>';
}
	
  echo '</table>';

echo '</div></div>';
?>