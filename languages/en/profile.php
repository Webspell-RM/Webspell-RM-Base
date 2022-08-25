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

    'about' => 'About',
    'administrator' => '(Administrator)',
    'age' => 'Age',
    'are_on' => 'are ON',
    'bbcode' => 'BBCode',
    'by' => 'by',
    'clanmember' => 'Teammember',
    'contact' => 'Contact',
    'date' => 'Date',
    'delete_selected' => 'delete selected',
    'democomments' => 'Democomments',
    'diverse' => 'diverse',
    'email'=>'email',
    'iemail'=>'email',
    'female' => 'female',
    'homepage' => 'Website',
    'hp'=>'HP',
    'html_off' => 'HTML is OFF',
    'ignore_user' => 'ignore User',
    'incoming' => 'Incoming',
    'is_banned' => '<button type="button" class="btn btn-danger btn-lg btn-block">This user is banned!</button>',
    'is_on' => 'is ON',
    'last' => 'Last',
    'last_login' => 'Last Login',
    'location' => 'Location',
    'logged' => 'logged',
    'male' => 'male',
    'messenger' => 'Messenger',
    'message' => 'Message',
    'moderator' => '(Moderator)',
    'n_a'=>'n/a',
    'name' => 'Name',
    'nickname' => 'Nickname',
    'no_access' => 'No Access',
    'no_buddies' => 'No Buddies',
    'no_galleries' => 'No Galeries',
    'no_posts' => 'No Posts',
    'no_topics' => 'No Topics',
    'no_visits' => 'No Visits',
    'now' => 'Now',
    'now' => 'Now',
    'offline' => 'offline',
    'online' => 'online',
    'options' => 'Options',
    'outgoing' => 'Outgoing',
    'personal_info' => 'Personal Informations',
    'pictures' => 'Pictures',
    'posts' => 'Posts',
    'profile' => 'Profile',
    'quote' => 'Quote',
    'real_name' => 'Name',
    'registered_since' => 'Registered since',
    'replys' => 'Replys',
    'security_code' => 'enter Security Code',
    'select_all' => 'select all',
    'sexuality' => 'Gender',
    'smilies' => 'Smilies',
    'sort' => 'Sortierung',
    'status' => 'Status',
    'submit' => 'submit',
    'unknown' => 'Unknown',
    'user_doesnt_exist' => 'User not found',
    'userpic' => 'Userpic',
    'usertitle' => 'User-Rank',
    'views' => 'Views',
    'wrote' => 'wrote',
    'years' => 'Years',
    'yht_enter_message' => 'You have to enter a message!',
    'yht_enter_name' => 'You have to enter your name!',
    'your_email' => 'Your E-mail',
    'your_homepage' => 'Your Website',
    'your_message' => 'Your Message',
    'your_name' => 'Your Name',
    'twitch' => 'Twitch',
    'youtube' => 'Youtube',
    'twitter' => 'Twitter',
    'instagram' => 'Instagram',
    'facebook' => 'Facebook',
    'social-media' => 'Social Media',
    'steam' => 'Steam',
    'statistics' => 'Statistics',
    'latest_visitors' => 'Last Visitors',
    'newsposts' => 'Newsposts',
    'forumposts' => 'Forumposts',
    'forumtopics' => 'Forumtopics',
    'newscomments' => 'Comments',
    'link_twitch' => 'Link Twitch',
    'link_youtube' => 'Link Youtube',
    'link_twitter' => 'Link Twitter',
    'link_instagram' => 'Link Instagram',
    'link_facebook' => 'Link Facebook',
    'link_steam' => 'Link Steam',
    'link_homepage' => 'Link Homepage',
    'last_posts' => 'Last Posts',
    'last_topics' => 'Last Topics',
    'actions' => 'Actions',


    'galleries' => 'Galleries',
    'awardslist' => 'award list',
    'headaward' => 'Awards',




    'new_in_forum' => 'New Topics / New Posts',
    'new_posts' => 'New Posts',
    'new_topics' => 'New Topics',
    'no_entries' => 'No Entries',
    'no_events' => 'No Entries',
    'no_new_messages' => 'No new Messages.',
    'no_new_posts' => 'No new Posts',
    'no_new_topics' => 'No new Topics',
    'no_players_announced' => 'No player announced',
    'one_new_message'=>'<span class="text-success">You have a new Message.</span>',
    'x_new_message'=>'<span class="text-success">You have %new_messages% new Messages.</span>',
    'button_no_new_messages' => '<li class="list-inline-item"><a class="btn btn-secondary" href="index.php?site=messenger"><i class="fas fa-comments"></i> No new Messages.</a></li>',
    'button_x_new_message'=>'<li class="list-inline-item"><a class="btn btn-success" href="index.php?site=messenger"><i class="fas fa-comments"></i> You have new_messages% new Messages.</a></li>',
    'button_one_new_message'=>'<li class="list-inline-item"><a class="btn btn-success" href="index.php?site=messenger"><i class="fas fa-comments"></i> You have a new Message.</a></li>',
    
    'registered' => 'Registered',
'upcoming' => 'Clanwars / Events',
    'upcoming_clanwars' => 'Upcoming Clanwars',
    'upcoming_events' => 'Upcoming Events',

    'menu' => '<hr>Usermenu',
    'squad' => 'Team',

'you_have_to_be_logged_in' => '<blockquote>You have to be logged in to view this page!</blockquote><br><br>
     <a class="btn btn-primary" href="index.php?site=login">ANMELDEN</a> <a class="btn btn-success" href="index.php?site=register">REGISTER</a> ',
     'logout' => 'logout',
'admin' => 'Administration',
    'edit_account' => 'edit Account',
     'cashbox' => 'Cashbox',
     'usergalleries' => 'Usergalleries'
);

