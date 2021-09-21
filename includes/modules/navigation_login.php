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

GLOBAL $userID, $board_topics, $split, $array;

$_language->readModule('index');


    $template = $tpl->loadTemplate("navigation","login_head", $head_array);
    echo $template;

    if($loggedin) {

        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "plugins WHERE modulname='forum'"));
        if (@$dx[ 'modulname' ] != 'forum') {
        $new_forum_posts = '';
        } else {
        $new_forum_posts = 

        // BOARDS MIT KATEGORIE
        $boards = safe_query(
            "SELECT * FROM " . PREFIX . "plugins_forum_boards"
        );
        while ($db = mysqli_fetch_array($boards)) {
            $q = safe_query(
                "SELECT * FROM " . PREFIX .
                "plugins_forum_topics"
            );
            while ($lp = mysqli_fetch_assoc($q)) {
               
                        if ($userID) {
                            $board_topics[ ] = $lp[ 'topicID' ];
                        } else {
                            break;
                        }
            }

            // get unviewed topics
            $found = false;

            if ($userID) {
                $gv = mysqli_fetch_array(safe_query("SELECT topics FROM " . PREFIX . "user WHERE userID='$userID'"));
                $array = explode("|", $gv[ 'topics' ]);

                foreach ($array as $split) {
                    if ($split != "" && @in_array($split, $board_topics)) {
                        $found = true;
                        break;
                    }
                }
            }

            if ($found) {
                $icon = '<a data-toggle="tooltip" data-placement="top" title="Neuer Beitrag im Forum" href="index.php?site=forum"><span class="badge badge-warning mt-0"><i class="fas fa-comments"></i></span></a>';
            } else {
                $icon = '<a data-toggle="tooltip" data-placement="top" title="Kein neuer Beitrag im Forum" href="index.php?site=forum"><span class="badge badge-light mt-0"><i class="fas fa-comments"></i></span></a>';
            }

            

            $data_array = array();
            $data_array['$icon'] = $icon;
            
       }

        }
       

        $_SESSION[ 'ws_sessiontest' ] = true;
        $data_array=array();
        $data_array['$_modulepath'] = substr(MODULE, 0, -1);
        
        $data_array['$lang_overview'] = $index_language[ 'overview' ];
        $data_array['$lang_user_information'] = $index_language[ 'user_information' ];
        $data_array['$lang_edit_profile'] = $index_language[ 'edit_profile' ];

    $template = $tpl->loadTemplate("navigation","login_loggedin", $data_array);
    echo $template;


    if(isanyadmin($_SESSION['ws_user'])) {

        $_SESSION[ 'ws_sessiontest' ] = true;
        $data_array=array();
        $data_array['$_modulepath'] = substr(MODULE, 0, -1);
        $data_array['$lang_admincenter'] = $index_language[ 'admincenter' ];

    $template = $tpl->loadTemplate("navigation","login_admin", $data_array);
    echo $template;

    }

        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "plugins WHERE modulname='messenger'"));
        if (@$dx[ 'modulname' ] != 'messenger') {
        $new_forum_posts = '';
        } else {
        $new_forum_posts = @$newmessages = getnewmessages($userID);
        


    if ($newmessages == 1) {
      $newmessages = $index_language[ 'one_new_message' ];
    } elseif ($newmessages > 1) {
      $newmessages = str_replace('%new_messages%', $newmessages, $index_language[ 'more_new_message' ]);
     } else {
      $newmessages = $index_language[ 'no_new_messages' ];
    }
    };

        $_SESSION[ 'ws_sessiontest' ] = true;
        $data_array=array();
        @$data_array['$icon'] = $icon;
        @$data_array['$newmessages'] = $newmessages;
        $data_array['$_modulepath'] = substr(MODULE, 0, -1);
        $data_array['$lang_log_off'] = $_language->module[ 'log_off' ];

    $template = $tpl->loadTemplate("navigation","login_log_off", $data_array);
    echo $template;

    } else {

        $_SESSION[ 'ws_sessiontest' ] = true;
        $data_array=array();
        $data_array['$_modulepath'] = substr(MODULE, 0, -1);
        $data_array['$lang_login'] = $_language->module[ 'login' ];

    $template = $tpl->loadTemplate("navigation","login_login", $data_array);
    echo $template;
 
    }

    include(MODULE."language.php");

    $template = $tpl->loadTemplate("navigation","login_foot", $head_array);
    echo $template;

    
    
     

    
                            