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

$language_array = array(

/* do not edit above this line */

    'against' => 'against',
    'announce' => 'announce',
    'announcement' => 'Announcement',
    'back_last_page' => 'Back to last page',
    'click' => 'click',
    'date' => 'Date',
    'from' => 'From',
    'info' => 'Info',
    'last_login' => 'Last login',
    'logout' => 'logout',
    'location' => 'Location',
    'messenger' => 'Messenger',
    'name' => 'Name',
    'new_in_forum' => 'New Topics / New Posts',
    'new_posts' => 'New posts',
    'new_topics' => 'New topics',
    'no_entries' => 'no entries',
    'no_events' => 'no events',
    'no_new_messages' => 'No new messages.',
    'no_new_posts' => 'no new posts',
    'no_new_topics' => 'no new topics',
    'no_players_announced' => 'no players announced',
    'one_new_message'=>'<span class="text-success">You have a new message.</span>',
    'x_new_message'=>'<span class="text-success">You have %new_messages% new messages.</span>',
    'button_no_new_messages' => '<li class="list-inline-item"><a class="btn btn-secondary" href="index.php?site=messenger"><i class="fas fa-comments"></i> No new messages.</a></li>',
    'button_x_new_message'=>'<li class="list-inline-item"><a class="btn btn-success" href="index.php?site=messenger"><i class="fas fa-comments"></i> You have %new_messages% new messages.</a></li>',
    'button_one_new_message'=>'<li class="list-inline-item"><a class="btn btn-success" href="index.php?site=messenger"><i class="fas fa-comments"></i> You have a new message.</a></li>',
    'overview' => 'Overview',
    'registered' => 'Registered',
    'replys' => 'replys',
    'squad' => 'Squad',
    'until' => 'until',
    'upcoming' => 'Upcoming',
    'upcoming_clanwars' => 'Upcoming clanwars',
    'upcoming_events' => 'Upcoming events',
    'user' => 'User',
    'informations' => 'Userinformation',
    'menu' => 'Usermenu',
    'views' => 'views',
    'you_have_to_be_logged_in' => 'You have to be logged in to view the login overview!<br><br>
    &#8226; <a href="index.php?site=register">register now</a><br>
    &#8226; <a href="index.php?site=login">log in</a>',
     'buddy_list' => 'buddy list',
     'admin' => 'administration',
	 'cashbox' => 'Cashbox',
    'usergalleries' => 'User Galleries',
     'edit_account' => 'edit account'
);

