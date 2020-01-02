<?php
/*¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯\
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
\__________________________________________________________________*/

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
