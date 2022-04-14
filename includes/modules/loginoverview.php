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


$_language->readModule('loginoverview');

if ($loggedin && $cookievalue == 'accepted') {

    $_language->readModule('loginoverview', true);

    if ($userID && !isset($_GET[ 'userID' ]) && !isset($_POST[ 'userID' ])) {
        $data_array = array();
        $data_array['$title'] = $_language->module[ 'overview' ];
        $template = $tpl->loadTemplate("loginoverview", "head", $data_array);
        echo $template;
        $ds = mysqli_fetch_array(
            safe_query(
                "SELECT
                        `registerdate`
                    FROM `" . PREFIX . "user`
                    WHERE `userID` = " . $userID
            )
        );
        $username = '<a class="btn btn-info btn-sm" href="index.php?site=profile&amp;id=' . $userID . '"><i class="fa fa-user"></i> ' . getnickname($userID) . '</a>';
        $lastlogin = getformatdatetime($_SESSION[ 'ws_lastlogin' ]);
        $registerdate = getformatdatetime($ds[ 'registerdate' ]);

        //messages?
        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "plugins WHERE modulname='messenger'"));
        if (@$dx[ 'modulname' ] != 'messenger') {
        $newmessages = '';
        } else {
        $newmessages = $newmessages = getnewmessages($userID);
        }

        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "plugins WHERE modulname='messenger'"));
        if (@$dx[ 'modulname' ] != 'messenger') {
        $button_newmessages = '';
        } else {
        $button_newmessages = $newmessages = getnewmessages($userID);
        }
    #$newmessages = getnewmessages($userID);

    if ($newmessages == 1) {
        $newmessages = $_language->module[ 'one_new_message' ];
    } elseif ($newmessages > 1) {
        $newmessages = str_replace('%new_messages%', $newmessages, $_language->module[ 'x_new_message' ]);
    } else {
        $newmessages = $_language->module[ 'no_new_messages' ];
    }

    if ($button_newmessages == 1) {
        $button_newmessages = $_language->module[ 'button_one_new_message' ];
    } elseif ($button_newmessages > 1) {
        $button_newmessages = str_replace('%new_messages%', $button_newmessages, $_language->module[ 'button_x_new_message' ]);
    } else {
        $button_newmessages = $_language->module[ 'button_no_new_messages' ];
    }

    $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "plugins WHERE modulname='messenger'"));
        if (@$dx[ 'modulname' ] != 'messenger') {
        $new_messages = '';
        } else {
        $new_messages = '<a href="index.php?site=messenger">'.$newmessages.'</a>';    
        /*$new_messages = '<tr>
        <<td>'.$_language->module[ 'messenger' ].':</td>
        <td><a href="index.php?site=messenger">'.$newmessages.'</a></td>
    </tr>';*/
    }

    $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "plugins WHERE modulname='messenger'"));
        if (@$dx[ 'modulname' ] != 'messenger') {
        $new_messages_button = '';
        } else {
        $new_messages_button = $button_newmessages;
    }


    #--------------------------------------

    $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "plugins WHERE modulname='calendar'"));
        if (@$dx[ 'modulname' ] != 'calendar') {
        $upcoming = '';
        } else {    
        $upcoming = 
    //upcoming
    $clanwars = '';
    if (isclanmember($userID)) {
        $clanwars .= "<hr><h5>" . $_language->module[ 'upcoming_clanwars' ] . "</h5>";

        $squads = safe_query("SELECT squadID FROM `" . PREFIX . "squads_members` WHERE userID='" . $userID . "'");
        while ($squad = mysqli_fetch_array($squads)) {
            if (isgamesquad($squad[ 'squadID' ])) {
                $dn = mysqli_fetch_array(
                    safe_query(
                        "SELECT
                            name
                        FROM
                            `" . PREFIX . "squads`
                        WHERE
                            squadID='" . $squad[ 'squadID' ] . "'
                        AND
                            gamesquad='1'"
                    )
                );
                $clanwars .= '<p><b>' . $_language->module[ 'squad' ] . ':</b> ' . $dn[ 'name' ] . '</p>';
                $n = 1;
                $ergebnis = safe_query(
                    "SELECT
                        *
                    FROM
                        `" . PREFIX . "plugins_upcoming`
                    WHERE
                        type='c'
                    AND
                        squad='" . $squad[ 'squadID' ] . "'
                    AND
                        date>" . time() . "
                    ORDER BY
                        date"
                );
                $anz = mysqli_num_rows($ergebnis);

                if ($anz) {
                    $clanwars .= '<table class="table table-striped">
                    <thead>
                        <tr>
                            <th>' . $_language->module[ 'date' ] . '</th>
                            <th>' . $_language->module[ 'against' ] . '</th>
                            <th>' . $_language->module[ 'announcement' ] . '</th>
                            <th>' . $_language->module[ 'announce' ] . '</th>
                        </tr>
                    </thead><tbody>';

                    while ($ds = mysqli_fetch_array($ergebnis)) {
                        
                        $date = getformatdate($ds[ 'date' ]);

                        $anmeldung =
                            safe_query(
                                "SELECT
                                    *
                                FROM
                                    " . PREFIX . "plugins_upcoming_announce
                                WHERE
                                    upID='" . $ds[ 'upID' ] . "'"
                            );
                        if (mysqli_num_rows($anmeldung)) {
                            $i = 1;
                            $players = "";
                            while ($da = mysqli_fetch_array($anmeldung)) {
                                if ($da[ 'status' ] == "y") {
                                    $fontcolor = "label-success";
                                } elseif ($da[ 'status' ] == "n") {
                                    $fontcolor = "label-important";
                                } else {
                                    $fontcolor = "label-warning";
                                }

                                if ($i > 1) {
                                    $players .= ', <a href="index.php?site=profile&amp;id=' . $da[ 'userID' ] .
                                        '"><span class="label ' . $fontcolor . '">' .
                                        strip_tags(stripslashes(getnickname($da[ 'userID' ]))) . '</span></a>';
                                } else {
                                    $players .= '<a href="index.php?site=profile&amp;id=' . $da[ 'userID' ] .
                                        '"><span class="label ' . $fontcolor . '">' .
                                        strip_tags(stripslashes(getnickname($da[ 'userID' ]))) . '</span></a>';
                                }
                                $i++;
                            }
                        } else {
                            $players = $_language->module[ 'no_players_announced' ];
                        }

                        $tag = date("d", $ds[ 'date' ]);
                        $monat = date("m", $ds[ 'date' ]);
                        $yahr = date("Y", $ds[ 'date' ]);

                        $clanwars .= '<tr>
                            <td>' . $date . '</td>
                            <td><a href="' . $ds[ 'opphp' ] . '" target="_blank">' . $ds[ 'opptag' ] . ' / ' .
                            $ds[ 'opponent' ] . '</a></td>
                            <td>' . $players . '</td>
                            <td><a href="index.php?site=calendar&amp;action=announce&amp;upID=' . $ds[ 'upID' ] .
                            '&amp;tag=' . $tag . '&amp;month=' . $monat . '&amp;year=' . $yahr . '#event">' .
                            $_language->module[ 'click' ] . '</a></td>
                        </tr>';
                        $n++;
                    }
                    $clanwars .= '</tbody></table>';
                } else {
                    $clanwars .= $_language->module[ 'no_entries' ];
                }
            }
        }
    }
    unset($events);
#}
    $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "plugins WHERE modulname='calendar'"));
        if (@$dx[ 'modulname' ] != 'calendar') {
        $upcoming = '';
        } else {    
    $upcoming = 

    $events = '';
    $ergebnis =
        safe_query("SELECT * FROM `" . PREFIX . "plugins_upcoming` WHERE type='d' AND date>" . time() . " ORDER by date");
    $anz = mysqli_num_rows($ergebnis);
    if ($anz) {
        $events .= '<table class="table table-striped">
                    <thead>
                        <tr>
                            <th>'.$_language->module[ 'name' ].':</th>
                            <th>'.$_language->module[ 'from' ].':</th>
                            <th>'.$_language->module[ 'until' ].':</th>
                            <th>'.$_language->module[ 'location' ].':</th>
                            <th>'.$_language->module[ 'info' ].':</th>
                        </tr>
                    </thead><tbody>';
        $n = 1;
        while ($ds = mysqli_fetch_array($ergebnis)) {
            $events .= '<tr>
                <td>' . $ds[ 'title' ] . '</td>
                <td>' . date('d.m.y, H:i', $ds[ 'date' ]) . '</td>
                <td>' . date('d.m.y, H:i', $ds[ 'enddate' ]) . '</td>
                <td>' . $ds[ 'location' ] . '</td>
                <td><a href="index.php?site=calendar&amp;tag=' . date('d', $ds[ 'date' ]) . '&amp;month=' .
                date('m', $ds[ 'date' ]) . '&amp;year=' . date('Y', $ds[ 'date' ]) . '#event">' .
                $_language->module[ 'click' ] . '</a></td>
            </tr>';
            $n++;
        }
    
            $events .= '</tbody></table>';
        } else {
            $events .= $_language->module[ 'no_events' ];
        }

        }
        }
        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "plugins WHERE modulname='calendar'"));
                if (@$dx[ 'modulname' ] != 'calendar') {
                $kalender = '';
                } else {    
            $kalender = '
        <!--<h5>'.$_language->module[ 'upcoming' ].'</h5>-->
        '.$clanwars.'
        <hr>
        <h5>'.$_language->module[ 'upcoming_events' ].'</h5>
        '.$events.'
        ';
        }


        $edit_account = '<li class="list-inline-item"><div class="p-2">
        <a class="btn btn-warning" href="index.php?site=myprofile"><i class="fas fa-user-cog"></i>  '.$_language->module[ 'edit_account' ].'</a>
        </div></li>';

        $logout = '<li class="list-inline-item"><div class="p-2"><a class="btn btn-danger" href="index.php?site=logout"><i class="fas fa-sign-out-alt"></i> '.$_language->module[ 'logout' ].'</a>
        </div></li>';


        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "plugins WHERE modulname='cashbox'"));
        if (@$dx[ 'modulname' ] != 'cashbox') {
        $cash_box = '';
        } else {
            if (isclanmember($userID)) {
                $cash_box = '<li class="list-inline-item"><div class="p-2"><a class="btn btn-info" href="index.php?site=cashbox">
                    <i class="far fa-money-bill-alt"></i> '.$_language->module[ 'cashbox' ].'</a></div></li>';
            } else {
                $cash_box = '';
        }        
        }

        $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "plugins WHERE modulname='gallery'"));
        if (@$dx[ 'modulname' ] != 'gallery') {
        $usergallery = '';
        } else {
            if (isclanmember($userID)) {
                $usergallery = '<li class="list-inline-item"><div class="p-2"><a class="btn btn-warning" href="index.php?site=usergallery">
                    <i class="fas fa-images"></i> '.$_language->module[ 'usergalleries' ].'</a></div></li>';
            } else {
                $usergallery = '';
        }        
        }
    

  #----------------------------------------------  
        //clanmember/admin/referer

    if (isanyadmin($userID)) {
            $admincenterpic =
                '<li class="list-inline-item"><div class="p-2"><a class="btn btn-dark" href="admin/admincenter.php" target="_blank">
                    <i class="fas fa-cogs"></i> '.$_language->module[ 'admin' ].'</a></div></li>';
        } else {
            $admincenterpic = '';
        }

        if (isset($_SESSION[ 'referer' ])) {
            $referer_uri = '<a class="btn" href="' . $_SESSION[ 'referer' ] . '">
                <i class="fas fa-chevron-left"></i> ' .
                $_language->module[ 'back_last_page' ] . '</a>';
            unset($_SESSION[ 'referer' ]);
        } else {
            $referer_uri = '';
        }

 
        $data_array = array();
        $data_array['$_modulepath'] = MODULE;
        $data_array['$username'] = $username;
        $data_array['$lastlogin'] = $lastlogin;
        $data_array['$registerdate'] = $registerdate;
        $data_array['$admincenterpic'] = $admincenterpic;
        $data_array['$new_messages'] = $new_messages;
        $data_array['$new_messages_button'] = $new_messages_button;
        $data_array['$kalender'] = $kalender;
        $data_array['$edit_account'] = $edit_account;
        $data_array['$cash_box'] = $cash_box;
        $data_array['$usergallery'] = $usergallery;
        $data_array['$logout'] = $logout;
        
        $data_array['$buddy_list'] = $_language->module[ 'buddy_list' ];
        $data_array['$messenger'] = $_language->module[ 'messenger' ];
        #$data_array['$editaccount'] = $_language->module[ 'edit_account' ];
        #$data_array['$logout'] = $_language->module[ 'logout' ];
        $data_array['$user'] = $_language->module[ 'user' ];
        $data_array['$last_login'] = $_language->module[ 'last_login' ];
        $data_array['$registered'] = $_language->module[ 'registered' ];
        $data_array['$informations'] = $_language->module[ 'informations' ];
        $data_array['$menu'] = $_language->module[ 'menu' ];

        $template = $tpl->loadTemplate("loginoverview", "content", $data_array);
        echo $template;
    } else {
        echo $_language->module[ 'you_have_to_be_logged_in' ];
    }
} else {
        echo $_language->module[ 'you_have_to_be_logged_in' ];
}