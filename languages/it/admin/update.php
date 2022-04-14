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

  'access_denied' => 'Accesso negato',
  'errore' => 'Il server non è compatibile con gli aggiornamenti o il file di aggiornamento non è disponibile!',
  'step1' => 'Step 1: Aggiorna il server online',
  'step2' => 'Step 2: File di installazione remota disponibile',
  'error_step2_1' => 'File di installazione non trovato! <br />Aggiornamento interrotto.',
  'error_step2_2' => 'File di installazione trovato! <br />L\'aggiornamento procederà ora con il caricamento del file e l\'installazione della tabella.',
  'file_loaded' => 'File caricato',
  'file_not_loaded' => 'File non caricato',
  'file_deleted' => 'File eliminato',
  'file_not_deleted' => 'File non cancellato',
  'all_files_have_been_edited' => 'Tutti i file sono stati modificati!<br />Risultato',
  'di' => 'di',
  'installcomplete_1' => 'Aggiornamento Webspell riuscito alla versione',
  'installcomplete_2' => 'Installato con successo!',
  'back_to_overview' => 'Torna alla panoramica',
  'step4' => 'Step 4: installazione della tabella',
  'syq_error' => 'Errore MySQL: contattare l\'assistenza!',
  'not_all_files_edited' => 'Non tutti i file sono stati modificati!',
  'step3' => 'Step 3: caricamento dei file...',
  'webspell_update' => 'aggiorna webSPELL',
  'webspellupdater' => 'Webspell Updater',
  'check_version' => 'Verifica versione',
  'aggiornamento' => 'aggiornamento',
  'dati salvati' => 'Dati salvati!',
  'of' => 'da',
  'result' => 'Risultato',
  'save' => 'Salva',
  'update_now' => 'Aggiorna ora',
  'fill_in_ftp_settings' => 'Compila le impostazioni FTP!',
  'new_version_available' => 'È disponibile una nuova versione di webspell!',
  'update_info1' => 'Si prega di notare quanto segue prima di aggiornare!',
  'update_info2' => '- Mysqlbackup eseguito ?<br />- File Webspell salvati tramite FTP ?<br />- I plugin installati sono aggiornati! (Controlla in Plugin-Installer)<br /><br />Webspell-RM non si assume alcuna responsabilità per danni e l\'aggiornamento è a proprio rischio!',
  'update_info3' => 'La tua versione è aggiornata!',
  'update_info4' => 'Se noti che è stato rilasciato un aggiornamento all\'interno di questa versione, puoi anche aggiornare di nuovo la tua versione!<br />Ricorda che l\'installazione di mysql viene eseguita di nuovo e le impostazioni che pubblichi dopo l\'aggiornamento devono essere ripristinato!<br /><br /><p class="text-danger"><b>Importante:</b></p> assicurati prima dell\'aggiornamento che i plug-in installati siano aggiornati! (sotto Plugin Installer)<br /><br />',
  're_update' => 'Aggiorna ora',
  'update_info5' => 'La tua versione è superiore a Webspell-RM. Contatta il team di webspell!',
  'your_version' => 'La tua versione webspell',
  'latest_version' => 'Ultima versione webspell',
  'risultato' => 'Risultato',
  'ftp_settings' => 'Impostazioni FTP',
  'server_ip' => 'IP server FTP',
  'ftp_ip' => 'Qual è l\'IP del tuo server (es.: 123.345.654.899)',
  'server_port' => 'Porta server FTP',
  'ftp_port' => 'Qual è la tua porta del server (es.: 21 )',
  'server_path' => 'Percorso della directory',
  'ftp_pfad' => 'Percorso della tua directory webspell (es.: / o /webspell/)',
  'server_username' => 'nome utente FTP',
  'ftp_username' => 'Nome utente dal server FTP',
  'server_pfad' => 'Percorso della directory',
  'server_password' => 'Password FTP',
  'ftp_password' => 'Password dal server FTP',
  'salva' => 'Salva',
  'ftp_path_check' => 'Verifica percorso',
  'ftp_path_error' => 'Errore di percorso - per favore controlla!',
  'ftp_login_error' => 'Errore di accesso - per favore controlla!',
  'ftp_login_check' => 'Controlla login!',


  'updateserversuccess'=>'Il server di aggiornamento è online.',
  'nomefile'=>'nomefile',
  'get_new_version'=>'Ottieni l\'ultima versione di webSPELL qui!',
  'informazioni'=>'informazioni',
  'new_functions'=>'Nuove funzioni disponibili per webSPELL',
  'new_updates'=>'Nuovi aggiornamenti disponibili per webSPELL',
  'new_version'=>'Nuova versione webSPELL disponibile',
  'no_updates'=>'Nessun aggiornamento disponibile!',
  'versione' => 'versione',
  
  'install_complete'=>'Installazione riuscita!',
  'install_running'=>'Installazione in esecuzione!',
  'finish_install'=>'Fine installazione',
  'view_site'=>'Visualizza il tuo sito',
  'transaction_invalid'=>'ID transazione non valido' 
  
);

