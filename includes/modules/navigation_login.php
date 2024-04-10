<?php
/**
 *¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
 *                  Webspell-RM      /                        /   /                                          *
 *                  -----------__---/__---__------__----__---/---/-----__---- _  _ -                         *
 *                   | /| /  /___) /   ) (_ `   /   ) /___) /   / __  /     /  /  /                          *
 *                  _|/_|/__(___ _(___/_(__)___/___/_(___ _/___/_____/_____/__/__/_                          *
 *                               Free Content / Management System                                            *
 *                                           /                                                               *
 *¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
 * @version         webspell-rm                                                                              *
 *                                                                                                           *
 * @copyright       2018-2023 by webspell-rm.de                                                              *
 * @support         For Support, Plugins, Templates and the Full Script visit webspell-rm.de                 *
 * @website         <https://www.webspell-rm.de>                                                             *
 * @forum           <https://www.webspell-rm.de/forum.html>                                                  *
 * @wiki            <https://www.webspell-rm.de/wiki.html>                                                   *
 *                                                                                                           *
 *¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
 * @license         Script runs under the GNU GENERAL PUBLIC LICENCE                                         *
 *                  It's NOT allowed to remove this copyright-tag                                            *
 *                  <http://www.fsf.org/licensing/licenses/gpl.html>                                         *
 *                                                                                                           *
 *¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
 * @author          Code based on WebSPELL Clanpackage (Michael Gruber - webspell.at)                        *
 * @copyright       2005-2011 by webspell.org / webspell.info                                                *
 *                                                                                                           *
 *¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
*/

GLOBAL $userID, $board_topics, $split, $array;

$_language->readModule('index');

    $data_array = array();
    $template = $tpl->loadTemplate("navigation","login_head", $data_array);
    echo $template;

if($loggedin) {

    $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='forum' AND activate= 1"));
    if (@$dx[ 'modulname' ] != 'forum') {
        $new_forum_posts = '';
        $icon = '';
    } else {
        $new_forum_posts = 

        // BOARDS MIT KATEGORIE
        $boards = safe_query("SELECT * FROM " . PREFIX . "plugins_forum_boards");
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
            $ergebnisz=safe_query("SELECT topics FROM " . PREFIX . "user WHERE userID='$userID'");
            $gv=mysqli_fetch_array($ergebnisz);
            $icon='<a data-toggle="tooltip" data-placement="bottom" title="'.$index_language[ 'no_forum_post' ].'" href="index.php?site=forum"><span class="icon badge bg-light text-dark mt-0 position-relative">
                    <i class="bi bi-chat"></i></span></a>';
            if(!empty($gv['topics'])) $topic=explode("|", $gv[ 'topics' ]);
                $calc = count($topic);
                if(is_array($topic)) {
                    $n=1;
                    foreach($topic as $topics) {
                        if($topics!="") { 

                            if($n==1){ 
                                $icon = '<a data-toggle="tooltip" data-placement="bottom" title="'.$index_language[ 'one_new_forum_post' ].'" href="index.php?site=forum"><span class="icon badge bg-warning text-dark mt-0 position-relative">
                                        <i class="bi bi-chat-dots"></i>
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        1
                                        <span class="visually-hidden">unread messages</span>
                                        </span>
                                        </span></a>';
                            }elseif($n==2){ 
                                $icon = '<a data-toggle="tooltip" data-placement="bottom" title="'.$index_language[ 'more_new_forum_post' ].'" href="index.php?site=forum"><span class="icon badge bg-warning text-dark mt-0 position-relative">
                                        <i class="bi bi-chat-dots"></i>
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        2
                                        <span class="visually-hidden">unread messages</span>
                                        </span>
                                        </span></a>';
                            }elseif($n==3){ 
                                $icon = '<a data-toggle="tooltip" data-placement="bottom" title="'.$index_language[ 'more_new_forum_post' ].'" href="index.php?site=forum"><span class="icon badge bg-warning text-dark mt-0 position-relative">
                                        <i class="bi bi-chat-dots"></i>
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        3
                                        <span class="visually-hidden">unread messages</span>
                                        </span>
                                        </span></a>';
                            }elseif($n==4){ 
                                $icon = '<a data-toggle="tooltip" data-placement="bottom" title="'.$index_language[ 'more_new_forum_post' ].'" href="index.php?site=forum"><span class="icon badge bg-warning text-dark mt-0 position-relative">
                                        <i class="bi bi-chat-dots"></i>
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        4
                                        <span class="visually-hidden">unread messages</span>
                                        </span>
                                        </span></a>';
                            }elseif($n==5){ 
                                $icon = '<a data-toggle="tooltip" data-placement="bottom" title="'.$index_language[ 'more_new_forum_post' ].'" href="index.php?site=forum"><span class="icon badge bg-warning text-dark mt-0 position-relative">
                                        <i class="bi bi-chat-dots"></i>
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        5
                                        <span class="visually-hidden">unread messages</span>
                                        </span>
                                        </span></a>';
                            }elseif($n==6){ 
                                $icon = '<a data-toggle="tooltip" data-placement="bottom" title="'.$index_language[ 'more_new_forum_post' ].'" href="index.php?site=forum"><span class="icon badge bg-warning text-dark mt-0 position-relative">
                                        <i class="bi bi-chat-dots"></i>
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        6
                                        <span class="visually-hidden">unread messages</span>
                                        </span>
                                        </span></a>';
                            }elseif($n==7){ 
                                $icon = '<a data-toggle="tooltip" data-placement="bottom" title="'.$index_language[ 'more_new_forum_post' ].'" href="index.php?site=forum"><span class="icon badge bg-warning text-dark mt-0 position-relative">
                                        <i class="bi bi-chat-dots"></i>
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        7
                                        <span class="visually-hidden">unread messages</span>
                                        </span>
                                        </span></a>';
                            }elseif($n==8){ 
                                $icon = '<a data-toggle="tooltip" data-placement="bottom" title="'.$index_language[ 'more_new_forum_post' ].'" href="index.php?site=forum"><span class="icon badge bg-warning text-dark mt-0 position-relative">
                                        <i class="bi bi-chat-dots"></i>
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        8
                                        <span class="visually-hidden">unread messages</span>
                                        </span>
                                        </span></a>';                            
                            }elseif($n==9){ 
                                $icon = '<a data-toggle="tooltip" data-placement="bottom" title="'.$index_language[ 'more_new_forum_post' ].'" href="index.php?site=forum"><span class="icon badge bg-warning text-dark mt-0 position-relative">
                                        <i class="bi bi-chat-dots"></i>
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        9
                                        <span class="visually-hidden">unread messages</span>
                                        </span>
                                        </span></a>';    
                            }elseif($n>=10){ 
                                $icon = '<a data-toggle="tooltip" data-placement="bottom" title="'.$index_language[ 'more_new_forum_post' ].'" href="index.php?site=forum"><span class="icon badge bg-warning text-dark mt-0 position-relative">
                                        <i class="bi bi-chat-dots"></i>
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        10+
                                        <span class="visually-hidden">unread messages</span>
                                        </span>
                                        </span></a>';    
                            }else{ 
                                $icon = '<a data-toggle="tooltip" data-placement="bottom" title="'.$index_language[ 'no_forum_post' ].'" href="index.php?site=forum"><span class="icon badge bg-light text-dark mt-0 position-relative">
                                        <i class="bi bi-chat"></i>
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        0
                                        <span class="visually-hidden">unread messages</span>
                                        </span>
                                    </span></a>';
                            }
                                $n++;
                        }
                    }
                }
            }
        }
    }
       
	$_SESSION[ 'ws_sessiontest' ] = true;
    global $userID;
    $data_array=array();
    $data_array['$_modulepath'] = substr(MODULE, 0, -1);
    $data_array['$userID'] = $userID;
    $data_array['$lang_overview'] = $index_language[ 'overview' ];
    $data_array['$to_profil'] = $index_language[ 'to_profil' ];
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

    $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_plugins WHERE modulname='messenger' AND activate= 1"));
    if (@$dx[ 'modulname' ] != 'messenger') {
        $new_forum_posts = '';
        $newmessages = '';
    } else {
        $new_forum_posts = @$newmessages = getnewmessages($userID);
        
    	if ($newmessages == 1) {
      		$newmessages = '<a data-toggle="tooltip" data-placement="bottom" title="'.$index_language[ 'one_new_message' ].'" href="index.php?site=messenger"><span class="icon badge text-bg-success position-relative">
                            <i class="bi bi-envelope-check"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            1
                            <span class="visually-hidden">unread messages</span>
                            </span>
                            </span></a>'; 
    	} elseif ($newmessages == 2) {
      		$newmessages = '<a data-toggle="tooltip" data-placement="bottom" title="'.$index_language[ 'more_new_message' ].'" href="index.php?site=messenger"><span class="icon badge text-bg-success position-relative">
                            <i class="bi bi-envelope-check"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            2
                            <span class="visually-hidden">unread messages</span>
                            </span>
                            </span></a>';
        } elseif ($newmessages == 3) {
            $newmessages = '<a data-toggle="tooltip" data-placement="bottom" title="'.$index_language[ 'more_new_message' ].'" href="index.php?site=messenger"><span class="icon badge text-bg-success position-relative">
                            <i class="bi bi-envelope-check"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            3
                            <span class="visually-hidden">unread messages</span>
                            </span>
                            </span></a>';
        } elseif ($newmessages == 4) {
            $newmessages = '<a data-toggle="tooltip" data-placement="bottom" title="'.$index_language[ 'more_new_message' ].'" href="index.php?site=messenger"><span class="icon badge text-bg-success position-relative">
                            <i class="bi bi-envelope-check"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            4
                            <span class="visually-hidden">unread messages</span>
                            </span>
                            </span></a>';
        } elseif ($newmessages == 5) {
            $newmessages = '<a data-toggle="tooltip" data-placement="bottom" title="'.$index_language[ 'more_new_message' ].'" href="index.php?site=messenger"><span class="icon badge text-bg-success position-relative">
                            <i class="bi bi-envelope-check"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            5
                            <span class="visually-hidden">unread messages</span>
                            </span>
                            </span></a>';
        } elseif ($newmessages == 6) {
            $newmessages = '<a data-toggle="tooltip" data-placement="bottom" title="'.$index_language[ 'more_new_message' ].'" href="index.php?site=messenger"><span class="icon badge text-bg-success position-relative">
                            <i class="bi bi-envelope-check"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            6
                            <span class="visually-hidden">unread messages</span>
                            </span>
                            </span></a>';
        } elseif ($newmessages == 7) {
            $newmessages = '<a data-toggle="tooltip" data-placement="bottom" title="'.$index_language[ 'more_new_message' ].'" href="index.php?site=messenger"><span class="icon badge text-bg-success position-relative">
                            <i class="bi bi-envelope-check"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            7
                            <span class="visually-hidden">unread messages</span>
                            </span>
                            </span></a>';
        } elseif ($newmessages == 8) {
            $newmessages = '<a data-toggle="tooltip" data-placement="bottom" title="'.$index_language[ 'more_new_message' ].'" href="index.php?site=messenger"><span class="icon badge text-bg-success position-relative">
                            <i class="bi bi-envelope-check"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            8
                            <span class="visually-hidden">unread messages</span>
                            </span>
                            </span></a>';
        } elseif ($newmessages == 9) {
            $newmessages = '<a data-toggle="tooltip" data-placement="bottom" title="'.$index_language[ 'more_new_message' ].'" href="index.php?site=messenger"><span class="icon badge text-bg-success position-relative">
                            <i class="bi bi-envelope-check"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            9
                            <span class="visually-hidden">unread messages</span>
                            </span>
                            </span></a>';
        } elseif ($newmessages >= 10) {
            $newmessages = '<a data-toggle="tooltip" data-placement="bottom" title="'.$index_language[ 'more_new_message' ].'" href="index.php?site=messenger"><span class="icon badge text-bg-success position-relative">
                            <i class="bi bi-envelope-check"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            10+
                            <span class="visually-hidden">unread messages</span>
                            </span>
                            </span></a>';
        } else {
      		$newmessages = '<a data-toggle="tooltip" data-placement="bottom" title="'.$index_language[ 'no_new_messages' ].'" href="index.php?site=messenger"><span class="icon badge text-bg-light position-relative">
                            <i class="bi bi-envelope"></i>
                            </span></a>';
    	}
    }
        
        $_SESSION[ 'ws_sessiontest' ] = true;
        $data_array=array();
        $data_array['$icon'] = $icon;
        $data_array['$newmessages'] = $newmessages;
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

$data_array=array();
$template = $tpl->loadTemplate("navigation","login_foot", $data_array);
echo $template;
