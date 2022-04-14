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

	'available'=>'Disponibile',
	'check_chmod'=>'Recensione CHMOD',
	'check_requirements'=>'Verifica i requisiti',
	'chmod_error'=>'<b>DImpossibile impostare CHMOD. </ b> <br> Fornire manualmente le cartelle CHMOD 777 e i file CHMOD 766',
	'sql_error'=>'sql.php deve essere scrivibile o webSPELL non può essere installato.',
	'sql_support'=>'Supporto MySQL',
	'multibyte_support'=>'Supporto MultiByte',
	'curl_support'=>'Supporto Curl',
    'curlexec_support'=>'Supporto Curl-Exec',
	'allow_url_fopen_support'=>'Supporto allow_url_fopen',
	'no'=>'No',
	'php_version'=>'Versione PHP',
	'set_chmod'=>'Metti CHMOD',
	'setting_chmod'=>'CHMOD è impostato ...',
	'stylesheet_error'=>'stylesheet.css deve essere scrivibile o webSPELL non funziona correttamente.',
	'successful'=>'Ok!',
	'unavailable'=>'Non disponibile',
	'unwriteable'=>'Non scrivibile',
	'writeable'=>'Scrivibile',
	'yes'=>'Si',
    'back' => 'Indietro',
	'admin_email'=>'Admin E-Mail',
	'admin_password'=>'Admin Passwort',
	'admin_username'=>'Admin Username',
	'data_config'=>'Configurazione dei dati',
	'database_config'=>'Configurazione database MySQL',
	'finish_install'=>'Installazione completa',
	'finish_next'=>'Il passaggio successivo completa l\'installazione. <br><br> Non dimenticare di creare un <b>MySQL Backup</b>!',
	'host_name'=>'Nome Host',
	'mysql_database'=>'Nome database MySQL',
	'mysql_password'=>'Passwort MySQL',
	'mysql_prefix'=>'Prefisso tabelle MySQL',
	'mysql_username'=>'Nome utente MySQL',
	'tooltip_1'=>'Questo è l\'indirizzo del server del database MySQL. Di solito è localhost.',
	'tooltip_2'=>'O è qualcosa come root o un nome utente che hai ottenuto dal tuo hoster.',
	'tooltip_3'=>'Per la sicurezza del sito, una password del server MySQL è obbligatoria.',
	'tooltip_4'=>'Alcuni host consentono un solo nome di database specifico per pagina. Utilizzare il segno di tabella per questo caso.',
	'tooltip_5'=>'Per evitare conflitti di dati diversi, utilizzare un segno di tabella. Per la sicurezza, viene generato automaticamente. È inoltre possibile utilizzare un segno diverso.',
	'tooltip_6'=>'Questo è anche il tuo nome di accesso sulla pagina.',
	'tooltip_7'=>'Proteggi il tuo account amministratore con una password. Non utilizzare una password semplice. Migliore con numeri e caratteri diversi.',
	'tooltip_8'=>'Il tuo indirizzo email. Questo viene utilizzato anche come indirizzo di contatto.',
	'webspell_config'=>'Configurazione webSPELL',
	'min_requirements' =>'Requisiti minimi dello spazio Web',
	'php_ver'=>'PHP versione 5.6 o successiva<br>MYSQL versione 5.7.20 o successiva',
	'pass_ver'=>'La password deve contenere',
	'pass_text'=>'8 o più caratteri - caratteri maiuscoli e minuscoli <br> 1 o più caratteri speciali - almeno un numero'

);
?>
