<?php
/*-----------------------------------------------------------------\
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
\------------------------------------------------------------------*/

#global $_glob;

$_language->readModule('imprint');

        $data_array = array();
        $data_array['$imprint']=$_language->module[ 'imprint' ];

        $template = $tpl->loadTemplate("imprint","head", $data_array);
        echo $template;


$ergebnis =
    safe_query(
        "SELECT
            u.firstname, u.lastname, u.nickname, u.userID
        FROM
            " . PREFIX . "user_groups as g, " . PREFIX . "user as u
        WHERE
            u.userID = g.userID
        AND
            (g.page='1'
        OR
            g.forum='1'
        OR
            g.user='1'
        OR
            g.news='1'
        OR
            g.clanwars='1'
        OR
            g.feedback='1'
        OR
            g.super='1'
        OR
            g.gallery='1'
        OR
            g.cash='1'
        OR
            g.files='1')"
    );
$administrators = '';
while ($ds = mysqli_fetch_array($ergebnis)) {
    $administrators .= "<a href='index.php?site=profile&amp;id=" . $ds[ 'userID' ] . "'>" . $ds[ 'firstname' ] . " '" .
        $ds[ 'nickname' ] . "' " . $ds[ 'lastname' ] . "</a><br>";
}
$ergebnis =
    safe_query(
        "SELECT
            u.firstname, u.lastname, u.nickname, u.userID
        FROM
            " . PREFIX . "user_groups as g, " . PREFIX . "user as u
        WHERE
            u.userID = g.userID
        AND
            g.moderator='1'"
    );
$moderators = '';
while ($ds = mysqli_fetch_array($ergebnis)) {
    $moderators .= "<a href='index.php?site=profile&amp;id=" . $ds[ 'userID' ] . "'>" . $ds[ 'firstname' ] . " '" .
        $ds[ 'nickname' ] . "' " . $ds[ 'lastname' ] . "</a><br>";
}


// reading version
include('./system/version.php');

$headline1 = $_language->module[ 'imprint' ];
$headline2 = $_language->module[ 'coding' ];

if ($imprint_type) {
    $ds = mysqli_fetch_array(safe_query("SELECT imprint FROM `" . PREFIX . "settings_imprint`"));
    $imprint_head = $ds[ 'imprint' ];

        $translate = new multiLanguage(detectCurrentLanguage());
        $translate->detectLanguages($imprint_head);
        $imprint_head = $translate->getTextByLanguage($imprint_head);
        
    
} else {
    $imprint_head = '<div class="form-horizontal">
        <div class="form-group">
            <label class="col-sm-3 control-label">' . $_language->module[ 'webmaster' ] . '</label>
            <div class="col-sm-9">
                <p class="form-control-static">
                    <a href="mailto:' . mail_protect($admin_email) . '">' . $admin_name . '</a>
                </p>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">' . $_language->module[ 'admins' ] . '</label>
            <div class="col-sm-9">
                <p class="form-control-static">' . $administrators . '</p>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">' . $_language->module[ 'mods' ] . '</label>
            <div class="col-sm-9">
                <p class="form-control-static">' . $moderators . '</p>
            </div>
        </div>
    </div>';
}




$ergebnis = safe_query("SELECT * FROM " . PREFIX . "settings_imprint");
if (mysqli_num_rows($ergebnis)) {
    $ds = mysqli_fetch_array($ergebnis);

    $disclaimer_text = $ds[ 'disclaimer_text' ];
    
    $translate = new multiLanguage(detectCurrentLanguage());
    $translate->detectLanguages($disclaimer_text);
    $disclaimer_text = $translate->getTextByLanguage($disclaimer_text);
    

    }

$data_array = array();
$data_array['$headline1'] = $headline1;
$data_array['$imprint_head'] = $imprint_head;
$data_array['$headline2'] = $headline2;
$data_array['$version'] = $version;
$data_array['$disclaimer_text'] = $disclaimer_text;

$data_array['$headline1']=$_language->module[ 'imprint' ];
$data_array['$headline2']=$_language->module[ 'coding' ];
$data_array['$disclaimer']=$_language->module['disclaimer'];
$data_array['$coding_info']=$_language->module['coding_info'];
$data_array['$coding_info1']=$_language->module['coding_info1'];

    $template = $tpl->loadTemplate("imprint","content", $data_array);
    echo $template;

?>