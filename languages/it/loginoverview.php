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

    'against' => 'contro',
    'announce' => 'annunciare',
    'announcement' => 'Annuncio',
    'back_last_page' => 'Torna all\'ultima pagina',
    'click' => 'Informazioni ',
    'date' => 'Data',
    'from' => 'Dal',
    'info' => 'Informazioni',
    'last_login' => 'Ultimo login',
    'logout' => 'Uscita',
    'location' => 'Posizione',
    'messenger' => 'Messaggi',
    'name' => 'Nome',
    'new_in_forum' => 'Nuovi Argomenti / Nuovi Post',
    'new_posts' => 'Nuovi Post',
    'new_topics' => 'Nuovi Argomenti',
    'no_entries' => 'Nessuna voce',
    'no_events' => 'Nessun Evento',
    'no_new_messages' => 'Nessun Messaggio',

    'no_new_posts' => 'Nessun nuovo Post',
    'no_new_topics' => 'Nessun nuovo Argomento',
    'no_players_announced' => 'Nessun giocatore annunciato',
    'one_new_message'=>'<span class="text-success">C\'è un nuovo messaggio.</span>',
    'x_new_message'=>'<span class="text-success">Hai %new_messages% messaggi nuovi.</span>',
    'button_no_new_messages' => '<li class="list-inline-item"><a class="btn btn-secondary" href="index.php?site=messenger"><i class="fas fa-comments"></i> Nessun Messaggio</a></li>',
    'button_x_new_message'=>'<li class="list-inline-item"><a class="btn btn-success" href="index.php?site=messenger"><i class="fas fa-comments"></i> Hai %new_messages% messaggi nuovi</a></li>',
    'button_one_new_message'=>'<li class="list-inline-item"><a class="btn btn-success" href="index.php?site=messenger"><i class="fas fa-comments"></i> C\'è un nuovo messaggio</a></li>',

    'overview' => 'Panoramica d\' accesso',
    'registered' => 'Registrato',
    'replys' => 'Replica',
    'squad' => 'Squadra',
    'until' => 'Fino al',
    'upcoming' => 'Imminente',
    'upcoming_clanwars' => 'Clanwar imminenti',
    'upcoming_events' => 'Gare imminenti',
    'user' => 'Utente',
    'informations' => 'Informazioni Utente',
    'menu' => 'Menu Utente',
    'views' => 'Visualizzazioni',
    'you_have_to_be_logged_in' => 'È necessario effettuare l\'accesso per visualizzare la panoramica di accesso!<br><br>
    &#8226; <a href="index.php?site=register">Registrati adesso</a><br>
    &#8226; <a href="index.php?site=login">Entra</a>',
     'buddy_list' => 'Lista Amici',
     'admin' => 'Amministrazione',
     'edit_account' => 'Edita Account',
     'cashbox' => 'Cassa',
     'usergalleries' => 'Gallerie utente '
);

