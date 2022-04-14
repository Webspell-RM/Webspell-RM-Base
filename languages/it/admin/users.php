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

$language_array = Array(

/* do not edit above this line */

  'about_myself' => 'Su di me',
  'access_denied' => 'Accesso negato',
  'actions' => 'Azioni',
  'activate' => 'Attivare',
  'active' => 'Attivo',
  'activity' => 'Attività',
  'add_new_user' => 'Aggiungi Nuovo Utente',
  'add_to_clan' => 'Aggiungi al Clan',
  'admin'=> 'Amministratore',
  'avatar' => 'Avatar',
  'back '=>' Indietro ',
  'banish'=>'Bannna',
  'banned'=>'Bannato',
  'ban_for' => 'Bannare per',
  'ban_status' => 'Stato del Bann',
  'ban_until' => 'Bannare',
  'ban_user' => 'Banna Utente',
  'birthday' => 'Compleanno',
  'clan_history' => 'Storia Clan',
  'clan_homepage' => 'Homepage Clan',
  'can_not_copy_file' => 'ERRORE: impossibile ottenere il file dal server',
  'clan_irc' => 'Clan IRC',
  'clanmember'=>'Membri del Clan',
  'clanname' => 'Nome Clan',
  'clantag' => 'Abbreviazione di Clan',
  'connection' => 'Connessione',
  'country' => 'Paese',
  'cpu' => 'CPU',
  'days' => 'giorni',
  'delete' => 'Cancella',
  'delete_avatar' => 'Elimina Avatar',
  'delete_picture' => 'Elimina immagine',
  'edit_ban' => 'Edita Ban',
  'edit_profile' => 'Edita Profilo',
  'email' => 'E-mail',
  'error_avatar' => 'ERRORE: l\'avatar è troppo grande (max 90x90)',
  'error_picture' => 'ERRORE: l\'immagine è troppo grande (max 285x250)',
  'female'=>'Femminile',
  'firstname' => 'Nome',
  'gender' => 'Sesso',
  'general' => 'Generale',
  'scheda grafica' => 'Scheda Grafica',
  'homepage' => 'Homepage',
  'icq' => 'ICQ',
 'inactive'=>'Inattivo',
  'invalid_format' => 'ERRORE: Formato immagine non autorizzato (consentito: * .gif, * .jpg o * .png)',
  'keyboard' => 'Tastiera',
  'lastname' => 'Cognome',
  'mainboard' => 'Scheda madre',
  'male'=>'Maschile',
  'max_90x90' => '(Massimo 90x90)',
  'max_285x250' => '(Massimo 285x250)',
  'moderator' => 'Moderatore Forum',
  'month' => 'mesi',
  'monitor' => 'Monitor',
  'mouse' => 'Mouse',
  'mousepad' => 'Mouse Pad',
  'nickname' => 'Nome Utente',
  'not_available' => 'Non specificato',
  'no_users' => 'Nessun utente trovato',
  'password' => 'Password',
  'permanently' => 'Bann Permanente?',
  'personal' => 'Personale',
  'picture' => 'Immagine',
  'pictures' => 'Immagini',
  'position'=>'Posizione',
  'profile' => 'Profilo',
  'ram'=>'Memoria Ram',
  'really_ban' => 'Sei sicuro di Bannare questo utente?',
  'really_delete' => 'Cancella davvero questo utente?',
  'really_unban' => 'Sei sicuro di rimuovere il Ban a questo utente?',
  'reason' => 'Motivo',
  'registered_since' => 'Registrato da',
  'remove_ban' => 'Rimuovi il Ban?',
  'rights'=>'Diritti',
  'signatur' => 'Firma',
  'sort' => 'Ordine',
  'soundcard' => 'Scheda Audio',
  'squad' => 'Squadra',
  'status' => 'Stato',
  'superadmin' => 'Super Amministratore',
  'town' => 'Città',
  'transaction_invalid' => 'Transizione Invalida',
  'to_clan' => 'Aggiungi al Clan',
  'to_sort' => 'Ordina',
  'undo_ban' => 'Rimuovi Ban',
  'upload_failed' => 'ERRORE: caricamento fallito',
  'user'=>'Utente',
  'user_exists' => 'Utente già esistente',
  'user_id' => 'ID utente',
  'username' => 'Nome Utente',
  'users' => 'Utenti',
  'users_available' => 'Utenti Esistenti',
  'usersearch' => 'Ricerca Utente',
  'exactsearch' => 'Ricerca esatta',
  'various' => 'Altro',
  'weeks' => 'settimane',
  'you_cant_ban' => 'Non puoi vietare questo utente! (Super Admin)',
  'you_cant_ban_yourself' => 'Non puoi Bannarti da solo!',
  'error' => 'Errore',
  'twitch' => 'Twitch',
  'youtube' => 'Youtube',
  'twitter' => 'Twitter',
  'instagram' => 'Instagram',
  'facebook' => 'facebook',
  'social-media' => 'Social media',
  'image_too_big' => 'Immagine troppo Grossa',
  'options'=>'Opzioni',
  'delete_info'=>'Sei sicuro di voler rimuovere questo utente? <br> <br> Tutto verrà eliminato definitivamente.'
);
