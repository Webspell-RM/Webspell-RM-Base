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

  'access_denied'=>'Accesso negato',
  'error'=>'Server non compatibile con l\'aggiornamento o File non disponibile all\'indirizzo',
  'step1' => 'Passaggio 1: Aggiornare il server online',
  'step2' => 'Passaggio 2: File di installazione remota disponibile',
  'error_step2_1' => 'File di installazione non trovato! <br />Aggiornamento interrotto.',
  'error_step2_2' => 'File di installazione trovato! <br />L\'aggiornamento continuerà con il caricamento dei file e le tabelle di installazione.',
  'file_loaded' => 'File caricato',
  'file_not_loaded' => 'File non caricato',
  'file_deleted' => 'File cancellato',
  'file_not_deleted' => 'File non cancellato',
  'all_files_have_been_edited' => 'Tutti i file sono stati modificati!<br />Risultato',
  'of' => 'di',
  'installcomplete_1' => 'Aggiornamento Di Webspell applicato correttamente alla versione',
  'installcomplete_2' => 'installato con successo!',
  'back_to_overview' => 'Torna alla Panorapica',
  'step4' => 'Passo 4: Installazione tabelle',
  'syq_error' => 'Errore MYSQL: Contattare il supporto tecnico!',
  'not_all_files_edited' => 'Non tutti i file sono stati modificati!',
  'step3' => 'Passaggio 3: Caricare i file...',
  'webspell_update'=>'Aggiornamento webSPELL',
  'webspellupdater' => 'Programma di aggiornamento Webspell',
  'check_version' => 'Controllo Versione',
  'update' => 'Aggiornamento',
  'data saved' => 'Dati memorizzati!',
  'update_now' => 'Aggiorna Ora',
  'fill_in_ftp_settings' => 'Si prega Selezionare le impostazioni di FTP !',
  'new_version_available' => 'Esiste una nuova versione di Webspell!',
  'update_info1' => 'Si prega di notare le seguenti informazioni prima dell\'aggiornamento!',
  'update_info2' => '- Backup Mysql eseguito ?<br />- File di Webspell di cui è stato eseguito il backup tramite FTP ?<br />Webspell RM non si assume alcuna responsabilità in caso di perdita e l\'aggiornamento è a proprio rischio e pericolo!',
  'update_info3' => 'La versione è aggiornata!',
  'update_info4' => 'Se si rileva che un aggiornamento è stato rilasciato all\'interno di questa versione, è anche possibile aggiornare la versione di RE!<br />Tenere presente che Mysql-Install verrà ritrasmesso e le impostazioni effettuate dopo l\'aggiornamento devono essere reimpostate !<br /><br />',
  're_update' => 'Ora RE aggiornamenti',
  'update_info5' => 'La versione è simile a quella di Webspell-RM. Contatta il team di Webspell!',
  'your_version' => 'La tua versione di Webspell',
  'latest_version' => 'Ultima versione di Webspell',
  'result' => 'Risultato',
  'ftp_settings' => 'Impostazioni-FTP',
  'server_ip' => 'IP server FTP',
  'ftp_ip' => 'Qual è l\'indirizzo IP del server (Es.: 123.345.654.899)',
  'server_port' => 'Porta FTP-Server',
  'ftp_port' => 'Qual è la porta del server? (Es.: 21 )',
  'server_pfad' => 'Percorso della directory',
  'ftp_pfad' => 'Percorso della directory webspell (Bsp.: / oder /webspell/)',
  'server_username' => 'Nome utente FTP',
  'ftp_username' => 'Nome utente del server FTP',
  'server_password' => 'FTP-Password',
  'ftp_password' => 'Password del FTP Server',
  'save' => 'Salva',

  'updateserversuccess'=>'Il server di aggiornamento è online.',
  'filename'=>'Nome File',
  'get_new_version'=>'Scarica qui la versione webSPELL più recente!',
  'information'=>'Informazioni',
  'new_functions'=>'Nuove funzioni per webSPELL disponibili',
  'new_updates'=>'Nuovi aggiornamenti per webSPELL disponibili',
  'new_version'=>'Nuova versione webSPELL disponibile',
  'no_updates'=>'Nessun aggiornamento disponibile!',
  'version'=>'Versione',
  
  'install_complete'=>'L\'installazione è riuscita!',
  'install_running'=>'L\'installazione è in corso!',
  'finish_install'=>'Installazione completa',
  'view_site'=>'Guarda la tua pagina',
  'transaction_invalid'=>'Transazione invalida'
);

