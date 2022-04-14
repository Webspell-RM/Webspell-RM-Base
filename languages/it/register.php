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

    'title' => 'Registrazione',
    'info' => 'Si prega di inserire i dati di base del login nei campi visualizzati e quindi fare clic su "Registrati ora!!".',
    'activation_successful' => '<blockquote>L\'attivazione del tuo account ha avuto successo. <br> Ora puoi accedere.</blockquote>',
    'back' => 'Indietro',
    'enter_nickname' => 'Prego inserisci il nick name.',
    'enter_password' => 'Prego inserisci la password.',
    'enter_username' => 'Prego inserisci un username.',
    'errors_there' => 'Ci sono alcuni errori',
    'for_login' => 'solo per il login',
    'invalid_mail' => 'Hai inserito una Mail invalida',
    'mail' => 'E-Mail',
    'mail_activation_successful' => 'L\' attivazione del tuo indirizzo email è andata a buon fine.',
    'mail_failed' => 'La mail di attivazione non può essere inviata, si prega di informare il webmaster su questo.',
    'mail_inuse' => 'L\'indirizzo e-mail è già in uso.',
    'mail_subject' => 'E-mail di attivazione dell\'account per %homepage_url%',
    'mail_text' => 'Ciao %username%!
<p>La tua registrazione a %pagetitle% (%homepage_url%) ha avuto successo. Dati dell\'account:</p>
<p>Login di accesso: %username%</p>
<p>Per completare la registrazione è necessario attivare l\'account facendo clic sul seguente collegamento:<br>
%activationlink%</p>
<p>Grazie per la registrazione</p>
%pagetitle% - %homepage_url%',
    'nickname' => 'Nickname',
    'nickname_inuse' => 'Nickname è già Occupato .',
    'no_register_when_loggedin' => 'Hai già un account su %pagename%',
    'password' => 'Password',
    'profile_info' => 'Informazioni di registrazione',
    'privacy_policy' => 'Informativa sulla privacy',
    'register_now' => 'Registrati adesso!',
    'register_successful' => 'La tua registrazione è andata a buon fine. Riceverai un\'email con un link di attivazione dell\'account a breve.',
    'registration' => 'registrazione',
    'repeat' => 'Repeti password',
    'repeat_invalid' => 'Le password non corrispondono.',
    'security_code' => 'Codice di sicurezza',
    'username' => 'Nome Utente',
    'username_inuse' => 'Nome Utente già in uso.',
    'username_toolong' => 'Il nome utente è lungo (massimo 30 caratteri).',
    'wrong_activationkey' => 'La chiave di attivazione è errata!',
    'wrong_securitycode' => 'Il codice di sicurezza è errato!',
	'enter_password2' => 'La password deve soddisfare i seguenti criteri: Lunghezza: min. 6 caratteri, un numero, lettere minuscole & lettere maiuscole più un carattere speciale',
	'GDPRinfo' => 'Accetto che le mie informazioni personali saranno memorizzate in modo permanente.',
	'GDPRaccept' => 'Devi accettare la memorizzazione dei tuoi dati personali.',
	'GDPRterm' => '<b>Suggerimento</b>: Se accetti l\'archiviazione dei tuoi dati personali, li accetti anche per la registrazione e per l\'uscita di commenti e / o risposte nel forum - se richiede la tua registrazione.',
    'pw1' =>'La password deve contenere',
    'pw2' =>'Almeno ',
    'pw3' =>' caratteri',
    'pw4' =>'Almeno un numero',
    'pw5' =>'Almeno una lettera maiuscola',
    'pw6' =>'Almeno un carattere speciale',
	'pass_ver'=>'La password deve contenere',
	'register_per_ip'=>'Registrazione per IP',
	'default_format_date'=>'Formato della data di Default',
	'default_format_time'=>'Formato della dell\'ora di Default',
	'hp_title'=>'HP Titolo',
    'pass_text'=>'otto o più caratteri<br>Lettere minuscole e maiuscole<br>uno o più caratteri speciali<br>almeno un numero'
);

