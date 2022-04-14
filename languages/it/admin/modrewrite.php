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
	'access_denied'=>'Accesso Negato',
	'modrewrite'=>'ModRewrite',
	'add_rule'=>'Aggiungi Regola',
	'variables'=>'Variabili',
	'variable'=>'Variabile',
	'type'=>'Tipo',
	'more'=>'Ancora',
	'url'=>'URL',
	'options'=>'Opzioni',
	'replace'=>'Sostituire',
	'save_rule'=>'Salva Regola',
	'edit_rule'=>'Edita Regola',
	'transaction_invalid'=>'ID transazione non valida',
	'modrewrite_settings'=>'Settaggi ModRewrite',
	'modrewrite_rules'=>'Regole ModRewrite',
	'apache_with_module'=>'Apache con Modulo-PHP',
	'modrewrite_is_enabled'=>'mod_rewrite è abilitato in httpd.conf',
	'modrewrite_is_disabled'=>'mod_rewrite non è abilitato in httpd.conf',
	'apache_with_cgi'=>'Apache con cgi e php',
	'unsupported_webserver'=>'Server Web non supportato',
	'can_not_write_file'=>'Non riesco a scrivere %s<br>Controllare chmod e riprovare',
	'fopen_disabled'=>'url_fopen è disabilitato. Baypassato dal test ajax',
	'modrewrite_failed'=>'mod_rewrite fallito',
	'htaccess_failed'=>'.htaccess fallito / Errore Server',
	'test_successful'=>'Test Riuscito',
	'unexpected_result'=>'Risultato imprevisto',
	'result'=>'Risultato',
	'debug'=>'Debug',
	'enable'=>'Adilitato',
	'htaccess_exists_merge'=>'Esiste già un accesso .htaccess. Si prega di unire con .htaccess_ws',
	'successful'=>'<span class="badge badge-success">Riuscito</span>',
	'state'=>'Stato',
	'enabled'=>'Abilitato',
	'disable'=>'Disabilitato',
	'new_rule'=>'Nuova Regola',
	'rule'=>'Regola',
	'actions'=>'Azioni',
	'edit'=>'Edita',
	'delete'=>'Cancella',
	'really_delete'=>'Eliminare davvero?',
	'no_entries'=>'Nessun Dato',
	'test_support'=>'Supporto per Test',
	'rebuild'=>'Ricostruisci URLs',
	'add_apache_options'=>'Aggiungere la riga seguente a apache config:<br>Options-MultiViews',
	'modrewrite_available_but_multiview_enabled'=>'mod_rewrite è disponibile, ma Apache MultiViews sono abilitati e impediscono mod_rewrite',
    'saved successfully'=>'Salvato correttamente',
    'delete_info'=>'Vuoi veramente rimuovere queste Regole ModRewrite? <br> <br> Tutto verrà rimosso in modo permanente.',
    'htinfo1'=>'<strong>Crea .htaccess in modo manuale:</strong></br>',
    'htinfo2'=>'<strong>e ripeti il processo!</strong>'
	);

