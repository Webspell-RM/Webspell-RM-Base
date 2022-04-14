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

    'about' => 'Informazioni',
    'add_buddylist' => 'Aggiungi a Lista-Amici',
    'administrator' => 'Amministratore',
    'age' => 'Età',
    'are_on' => 'Sono ON',
    'articlecomments' => 'Commenti Articoli',
    'back_buddylist' => 'Torna a Lista-Amici',
    'bbcode' => 'BBCode',
    'buddylist' => 'Lista-Amici',
    'buddys' => 'Amici',
    'by' => 'Di',
    'clan' => 'Team',
    'clan_equipment' => 'Team / Equipaggiamento',
    'clan_history' => 'Team-Storia',
    'clanmember' => 'Menbro del Team',
    'clanwarcomments' => 'Clanwarcomments',
    'contact' => 'Contatto',
    'cpu' => 'CPU',
    'date' => 'Data',
    'delete_selected' => 'Cancella selezionato',
    'democomments' => 'Commenti Demo',
    'diverse' => 'diverse',
    'e-mail' => 'E-Mail',
    'iemail'=>'Email',
    'femmina' => 'Femminile',
    'forumposts' => 'Post Forum',
    'forumtopics' => 'Topic Forum',
    'galleries' => 'Gallerie',
    'graphiccard' => 'Scheda grafica',
    'guestbook' => 'Guestbook',
    'hdd' => 'Disco rigido',
    'headset' => 'Auricolare',
    'homepage' => 'Homepage',
    'hp' => 'HP',
    'html_off' => 'HTML è OFF',
    'i_connection' => 'I-Connessione',
    'ignore_user' => 'Ignora utente',
    'incoming' => 'In entrata',
    'irc_channel' => 'Canale-Irc',
    'is_banned' => 'Questo utente è bannato!',
    'is_on' => 'è ON',
    'keyboard' => 'Keyboard',
    'last' => 'Ultimo',
    'last_login' => 'Ultimo Accesso',
    'last_posts' => 'Ultimi Messaggi',
    'last_topics' => 'Ultimi Argomenti',
    'latest_visitors' => 'Ultimi Visitatori',
    'location' => 'Posizione',
    'logged' => 'loggato',
    'mainboard' => 'Mainboard',
    'male' => 'Maschile',
    'messenger' => 'Messaggi',
    'message' => 'Messaggio',
    'moderatore' => 'Moderatore',
    'monitor' => 'Monitor',
    'mouse' => 'Mouse',
    'mousepad' => 'Mousepad',
    'n_a' => 'Nessun dato',
    'name' => 'Nome',
    'new_entry' => 'Nuovo',
    'new_guestbook_entry' => 'Nuova voce del guestbook nel tuo profilo!',
    'new_guestbook_entry_msg' => '[b]C\'è una nuova voce nel guestbook! [/ b] [URL = index.php? site = profile & action = guestbook & id =% guestbook_id%] Clicca qui [/ URL]',
    'newscomments' => 'Commenti News',
    'newsposts' => 'Posta Notizie',
    'nickname' => 'Nickname',
    'no_access' => 'Nessun accesso!',
    'no_buddies' => 'Nessun amico',
    'no_galleries' => 'No gallerie',
    'no_posts' => 'Nessun post',
    'no_topics' => 'Nessun topic',
    'no_visits' => 'Nessuna visita',
    'now' => 'Adesso',
    'offline' => 'Offline <span class="spinner-grow faa-flash animated text-danger" style="width: 1rem; height: 1rem;"></span>',
    'online' => 'Online  <span class="spinner-grow faa-flash animated text-success" style="width: 0.8rem; height: 0.85rem;"></span>',
    'options' => 'Opzioni',
    'outgoing' => 'In uscita',
    'personal_info' => 'Informazioni personali',
    'pictures' => 'Immagini',
    'posts' => 'post',
    'profile' => 'Profilo',
    'quote' => 'Quota',
    'ram' => 'RAM',
    'real_name' => 'Nome Reale',
    'registered' => 'Registrato dal',
    'replys' => 'Repliche',
    'security_code' => 'Inserisci il codice di sicurezza',
    'select_all' => 'Seleziona tutto',
    'sexuality' => 'Sesso',
    'smilies' => 'Faccine',
    'sort' => 'Ordina',
    'soundcard' => 'Soundcard',
    'statistics' => 'Statistiche',
    'status' => 'Stato',
    'submit' => 'Invia',
    'unknown' => 'non disponibile',
    'user_doesnt_exist' => 'Questo utente non esiste.',
    'usergalleries_disabled' => 'Gallerie utente disabilitate.',
    'userpic' => 'Immagine Utente',
    'usertitle' => 'Titolo Utente',
    'views' => 'Nessunisualizzati',
    'written' => 'scritti',
    'years' => 'Anni',
    'yht_enter_message' => 'Devi inserire un messaggio!',
    'yht_enter_name' => 'Devi inserire il tuo nome!',
    'your_email' => 'la tua e-mail',
    'your_homepage' => 'la tua home page',
    'your_message' => 'il tuo messaggio',
    'your_name' => 'il tuo nome',
    'twitch' => 'Twitch',
    'youtube' => 'Youtube',
    'twitter' => 'Twitter',
    'instagram' => 'Instagram',
	'steam' => 'Steam',
    'facebook' => 'Facebook',
    'social-media' => 'Social Media',
    'newscomments' => 'Commenti News',
    'link_twitch' => 'Link Twitch',
    'link_youtube' => 'Link Youtube',
    'link_twitter' => 'Link Twitter',
    'link_instagram' => 'Link Instagram',
    'link_facebook' => 'Link Facebook',
    'link_steam' => 'Link Steam',
    'link_homepage' => 'Link Homepage',
    'last_posts' => 'Ultimo Post',
	'actions' => 'Azioni',
    'last_topics' => 'Ultimo Topics'
);
