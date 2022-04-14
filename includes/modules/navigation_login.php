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

GLOBAL $userID, $board_topics, $split, $array;

$_language->readModule('index');

    $data_array = array();
    $template = $tpl->loadTemplate("navigation","login_head", $data_array);
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
                        $board_topics = array();
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
            if ($userID) {
                $gv = mysqli_fetch_array(safe_query("SELECT topics FROM " . PREFIX . "user WHERE userID='$userID'"));
                $array = explode("|", $gv[ 'topics' ]);

                foreach ($array as $split) {
                   if(!empty($split != "") && in_array($split, $board_topics, TRUE)){    
                        $found = true;
                        break;
                    }
                }
            }


            if (isset($found)) {
                $icon = '<a data-toggle="tooltip" data-placement="top" title="Neuer Beitrag im Forum" href="index.php?site=forum"><span class="badge bg-warning text-dark mt-0"><i class="fas fa-comments"></i></span></a>';
            } else {
                $icon = '<a data-toggle="tooltip" data-placement="top" title="Kein neuer Beitrag im Forum" href="index.php?site=forum"><span class="badge bg-light text-dark mt-0"><i class="fas fa-comments"></i></span></a>';
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
    }

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

    #include(MODULE."language.php");

    $data_array=array();
    $template = $tpl->loadTemplate("navigation","login_foot", $data_array);
    echo $template;

    
    
     

    
                            