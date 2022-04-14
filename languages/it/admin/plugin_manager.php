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

    'plugin_manager' => 'Plug-In Manager',
    'new_plugin' => 'Nuovo Plug-In',
    'edit' => 'Edita',
	'edit_plugin' => 'Salva Plug-In',
    'deactivate' => 'Disattiva',
    'deactivated' => 'Disattiva Sinistra e Destra',
	'all_deactivated' => 'Tutti Disattivati',
	'all_activated' => 'Tutti Attivati',
    'activate' => 'Attiva',
    'activated' => 'Attiva/Disattiva',
    'delete' => 'Cancella',
    'id' => 'ID',
    'plugin' => 'Plug-In', 
	'add'=>'Aggiungi',
    'name' => 'Nome',
	'status' => 'Stato',
    'description' => 'Descrizione',
    'success_deactivated' => 'Il Plug-In è ora Disattivato.',
    'failed_deactivated' => 'Disattivazione Plug-In  non riuscita.',    
	'success_activated' => 'Il Plug-In è ora Attivato.',
    'failed_activated' => 'Attivazione Plug-In non riuscita.',    
	'success_delete' => 'Il Plug-In è stato Eliminato.',
    'failed_delete' => 'Non si può eliminare il Plug-In.',    
	'success_save' => 'Salvataggio del Plug-In riuscito.',
    'failed_save' => 'Salvataggio del Plug-In non riuscito.',    
	'success_edit' => 'Plug-In aggiornamento riuscito.',
    'failed_edit' => 'Non è possibile aggiornare il Plug-In.',
    'option' => 'Opzioni',
    'really_delete'=>'Davvero vuoi eliminare questo Plug-In?',

  'access_denied'=>'Accesso Negato',
  'actions'=>'Azioni',
  'add_modul'=>'Aggiungi Modulo',
  'back'=>'Indietro',
  'left_is_activated'=>'S. Attivato',
  'right_is_activated'=>'D. Attivato',
  'all_activated'=>'S. / D. Attivati',
  'all_deactivated'=>'Disattivati',
  'base'=>'Base',
  'modul_edit'=>'Eddita Modulo',
  'edit_modul' => 'Edita Modulo',

    'na'=>'Non disponibile',
    'read_more'=>'Leggi altro',
	'add_plugin'=>'Aggiungi Plug-In',
	'options'=>'Opzioni',
	'delete_info'=>'Vuoi veramente rimuovere questo Plug-In? <br> <br> Solo le voci nel gestore plug-in verranno rimosse in modo permanente.',
	'left_page'=>'Sinistra.',
  'right_page'=>'Destra.',
  'left_right_page'=>'Plugin a Sinistra e Destra',
  'page_head'=>'Testa di pagina',
  'content_head'=>'Contenuto Testa',
  'content_foot'=>'Contenuto Piede.',
  'no'=>'No',
  'yes'=>'Si',
  'head_section'=>'Sezione Testa.',
  'foot_section'=>'Sezione Piede.',
   'left_is_activated'=>'Sinistra Attivati',
  'right_is_activated'=>'Destra Attivati',
  'modul_edit'=>'Edita Modulo',
  'modulname'=>'Nome Modulo',
  'modul_info'=>'<span class="alert alert-warning" role="alert"><i class="fas fa-exclamation-triangle"></i> Devi aggiungere i plugin installati in modo da poter eseguire l\'impostazione del modulo.</span>',
  'new_modul'=>'Aggiungi Plugin',
  'no_modul_setup' => '<div class="alert alert-warning" role="alert">Descrizione:<br>Nessun plugin trovato.</div>',
  'info'=> '<div class="col-sm-6 alert alert-warning" role="alert"><small>
  <b>Nome Modulo: </b> Nome della pagina per l\'impostazione <br>
<b> Disattivati: </b> Le colonne di sinistra e destra sono disattivate e non visibili <br>
<b> Sinistra Attivati: </b> Il lato sinistro (colonna) nel Frontend è visibile <br>
<b> Destra Attivati: </b> Il lato destro (colonna) nel Frontend è visibile <br>
</small>
</div>

<div class="col-sm-6 alert alert-warning" role="alert"><small>
<b> Sin./Des. Attivati: </b> Il lato sinistro e destro (colonne) nel Frontend è visibile <br>
<b> Testata: </b> L\'area della Testata è visibile <br>
<b> Cont. Alto: </b> Il contenuto sotto la Testata è visibile (area sotto la Testata centrale) <br>
<b> Cont. Basso </b> Il contenuto sopra al Piè di Pagina è visibile <br> </div> ',
    'wrote'=>'ha scritto</small></div>'
);

