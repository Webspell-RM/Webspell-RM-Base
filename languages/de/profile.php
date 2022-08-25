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

    'about' => 'Über mich',
    'administrator' => '(Administrator)',
    'age' => 'Alter',
    'are_on' => 'sind AN',
    'bbcode' => 'BBCode',
    'by' => 'von',
    'clanmember' => 'Teammitglied',
    'contact' => 'Kontakt',
    'date' => 'Datum',
    'delete_selected' => 'Ausgewählte löschen',
    'democomments' => 'Demokommentare',
    'diverse' => 'divers',
    'select_gender' => 'n/a',
    'email'=>'email',
    'iemail'=>'email',
    'female' => 'weiblich',
    'birthday' => 'Geburtstag',
    'homepage' => 'Webseite',
    'hp'=>'HP',
    'html_off' => 'HTML ist AUS',
    'ignore_user' => 'Benutzer ignorieren',
    'incoming' => 'Eingang',
    'is_banned' => '<button type="button" class="btn btn-danger btn-lg btn-block">Dieser Benutzer ist gebannt!</button>',
    'is_on' => 'ist AN',
    'last' => 'Letzte',
    'last_login' => 'Letzte Anmeldung',
    'location' => 'Ort',
    'logged' => 'gespeichert',
    'male' => 'männlich',
    'messenger' => 'Messenger',
    'message' => 'Mitteilung',
    'moderator' => '(Moderator)',
    'n_a'=>'n/a',
    'name' => 'Name',
    'nickname' => 'Nickname',
    'no_access' => 'kein Zugriff',
    'no_buddies' => 'keine Freunde',
    'no_galleries' => 'keine Galerien',
    'no_posts' => 'keine Beiträge',
    'no_topics' => 'keine Themen',
    'no_visits' => 'keine Besuche',
    'now' => 'Jetzt',
    'now' => 'Jetzt',
    'offline' => 'offline',
    'online' => 'online',
    'options' => 'Optionen',
    'outgoing' => 'Ausgang',
    'personal_info' => 'Persönliche Informationen',
    'pictures' => 'Bilder',
    'posts' => 'Beiträge',
    'profile' => 'Profil',
    'quote' => 'zitieren',
    'real_name' => 'Name',
    'registered_since' => 'Registriert seit',
    'replys' => 'Antworten',
    'security_code' => 'Sicherheitscode eingeben',
    'select_all' => 'alle auswählen',
    'gender' => 'Geschlecht',
    'smilies' => 'Smilies',
    'sort' => 'Sortierung',
    'status' => 'Status',
    'submit' => 'abschicken',
    'unknown' => 'keine Angabe',
    'user_doesnt_exist' => 'Benutzer nicht gefunden',
    'userpic' => 'Benutzerbild',
    'usertitle' => 'Benutzer-Rank',
    'views' => 'Aufrufe',
    'wrote' => 'schrieb',
    'years' => 'Jahre',
    'yht_enter_message' => 'Du musst eine Nachricht eingeben!',
    'yht_enter_name' => 'Du musst deinen Namen eingeben!',
    'your_email' => 'Deine Email',
    'your_homepage' => 'Deine Webseite',
    'your_message' => 'Deine Nachricht',
    'your_name' => 'Dein Name',
    'twitch' => 'Twitch',
    'youtube' => 'Youtube',
    'twitter' => 'Twitter',
    'instagram' => 'Instagram',
    'facebook' => 'Facebook',
    'social-media' => 'Social Media',
    'steam' => 'Steam',
    'statistics' => 'Statistik',
    'latest_visitors' => 'Letzte Besucher',
    'newsposts' => 'Neuigkeiten',
    'forumposts' => 'Forumbeiträge',
    'forumtopics' => 'Forumthemen',
    'newscomments' => 'Kommentare',
    'link_twitch' => 'Link Twitch',
    'link_youtube' => 'Link Youtube',
    'link_twitter' => 'Link Twitter',
    'link_instagram' => 'Link Instagram',
    'link_facebook' => 'Link Facebook',
    'link_steam' => 'Link Steam',
    'link_homepage' => 'Link Homepage',
    'last_posts' => 'Letzte Beiträge',
    'last_topics' => 'Letzte Themen',
    'actions' => 'Aktionen',


    'galleries' => 'Galerien',
    'awardslist' => 'Award-Liste',
    'headaward' => 'Awards',





    'new_in_forum' => 'Neue Themen / Neue Beiträge',
    'new_posts' => 'Neue Beiträge',
    'new_topics' => 'Neue Themen',
    'no_entries' => 'keine Einträge',
    'no_events' => 'keine Ereignisse',
    'no_new_messages' => 'Keine neuen Nachrichten.',
    'no_new_posts' => 'keine neuen Beiträge',
    'no_new_topics' => 'keine neuen Themen',
    'no_players_announced' => 'keine Spieler angemeldet',
    'one_new_message'=>'<span class="text-success">Du hast eine neue Nachricht.</span>',
    'x_new_message'=>'<span class="text-success">Du hast %new_messages% neue Nachrichten.</span>',
    'button_no_new_messages' => '<li class="list-inline-item"><a class="btn btn-secondary" href="index.php?site=messenger"><i class="fas fa-comments"></i> Keine neuen Nachrichten.</a></li>',
    'button_x_new_message'=>'<li class="list-inline-item"><a class="btn btn-success" href="index.php?site=messenger"><i class="fas fa-comments"></i> Du hast %new_messages% neue Nachrichten.</a></li>',
    'button_one_new_message'=>'<li class="list-inline-item"><a class="btn btn-success" href="index.php?site=messenger"><i class="fas fa-comments"></i> Du hast eine neue Nachricht.</a></li>',
    
    'registered' => 'Registriert',
'upcoming' => 'Clanwars / Events',
    'upcoming_clanwars' => 'Demnächst stattfindende Clanwars',
    'upcoming_events' => 'Demnächst stattfindende Ereignisse',

    'menu' => '<hr>Benutzermenü',
    'squad' => 'Team',

'you_have_to_be_logged_in' => '<blockquote>Du musst angemeldet sein um diese Seite zu betrachten!</blockquote><br><br>
     <a class="btn btn-primary" href="index.php?site=login">ANMELDEN</a> <a class="btn btn-success" href="index.php?site=register">REGISTRIEREN</a> ',
     'logout' => 'abmelden',
'admin' => 'Administration',
    'edit_account' => 'Konto bearbeiten',
     'cashbox' => 'Clan Kasse',
     'usergalleries' => 'Benutzergalerien'
);

