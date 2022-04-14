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

    'title' => 'Registrierung',
    'info' => 'Bitte trage in den angezeigten Feldern die Grunddaten des Logins ein und drücke anschließend auf "Jetzt Registrieren!".',
    'activation_successful' => '<blockquote>Deine Registrierung wurde erfolgreich abgeschlossen.<br>Du kannst dich jetzt anmelden.</blockquote>',
    'back' => 'zurück',
    'enter_nickname' => 'Bitte einen Nicknamen eingeben.',
    'enter_password' => 'Bitte ein Passwort eingeben.',
    'errors_there' => 'Es sind folgende Fehler aufgetreten',
    'for_login' => 'wird benötigt für die Anmeldung',
    'invalid_mail' => 'Die angegebene Mailadresse ist fehlerhaft.',
    'mail' => 'E-Mail',
    'mail_activation_successful' => 'Das Freischalten deiner Mailadresse war erfolgreich.',
    'mail_failed' => 'Die Freischaltmail konnte nicht versandt werden, bitte informiere den Webmaster darüber.',
    'mail_inuse' => 'Es existiert bereits eine Anmeldung für diese Mailadresse.',
    'mail_subject' => 'Anmeldebestätigung für %homepage_url%',
    'mail_text' => 'Hallo %nickname%!
<p>Deine Anmeldung auf %pagetitle% (%homepage_url%) war erfolgreich. Hier noch einmal deine Zugangsdaten:</p>
<p>Dein Benutzername: %nickname%</p>
<p>Um deine Registrierung jetzt abzuschließen, aktiviere deinen Account, indem du folgenden Link besuchst:<br>
%activationlink%</p>
<p>Vielen Dank für deine Anmeldung</p>
%pagetitle% - %homepage_url%',
    'nickname' => 'Nickname',
    'nickname_inuse' => 'Der Nickname ist bereits vergeben.',
    'no_register_when_loggedin' => 'Du hast bereits einen Accout auf %pagename%.',
    'password' => 'Passwort',
    'profile_info' => 'Anmeldeinformationen',
    'privacy_policy' => 'Datenschutz-Bestimmungen',
    'register_now' => 'Jetzt Registrieren!',
    'register_successful' => '<blockquote>Deine Anmeldung wurde erfolgreich abgeschlossen. Du wirst in wenigen Minuten eine E-Mail mit dem Freischaltcode erhalten, damit du deinen Account aktivieren kannst. Danach ist die Registrierung vollständig.</blockquote>',
    'registration' => 'Registrierung',
    'repeat' => 'Passwort wiederholen',
    'repeat_invalid' => 'Die Passwortwiederholung ist falsch.',
    'security_code' => 'Sicherheitscode',
    'wrong_activationkey' => '<blockquote>Dein Freischaltcode ist falsch!</blockquote>',
    'wrong_securitycode' => 'Der Sicherheitscode ist falsch!',
    'enter_password2' => 'Das Kennwort muss folgende Kriterien erf&uuml;llen:<br />Länge:min. 6 Zeichen, eine Zahl, ein Klein- &amp; Gro&szligbuchstaben, ein Sonderzeichen',
    'GDPRinfo' => 'Ich willige ein, dass meine personenbezogene Angaben dauerhaft gespeichert werden.',
    'GDPRaccept' => 'Sie müssen die Speicherung Ihrer personenbezogenen Daten aktzeptieren.',
    'GDPRterm' => 'Hinweis: Wenn Du der Speicherung Deiner personenbezogenen Daten zustimmst, so akzeptierst Du diese ebenfalls für die Anmeldung so wie das hinterlassen von Kommentaren und/oder Antworten im Forum - sofern es Ihre Anmeldung erfordert. ',
    'pw1' =>'Das Passwort muss haben',
    'pw2' =>'Mindestens ',
    'pw3' =>' Zeichen',
    'pw4' =>'Mindestens eine Zahl',
    'pw5' =>'Mindestens ein Großbuchstabe',
    'pw6' =>'Mindestens ein Sonderzeichen',
    'pass_ver'=>'Dein Passwort muss enthalten',
    'pass_text'=>'Dein Passwort muss enthalten: 8 oder mehr Zeichen / Groß- und Kleinbuchstaben / 1 oder mehr Sonderzeichen / mindestens eine Zahl',
    'no_cookie_accept' => 'Du hast die Cookies nicht akzeptiert! Kein Registrieren m&ouml;glich!',
    'full-name'=>'',
    'email_address'=>'Email Adresse',
    'enter_your_email'=>'Gib deine E-Mail Adresse ein',
    'enter_your_name'=>'Gib deinen Nickname ein',
    'enter_password'=>'Passwort eingeben',
    'already_have_an_account'=>'Du hast bereits ein Konto?',
    'login'=>'Login',
    'info1'=>'Sieht aus, als wärst du neu hier!',
    'info2'=>'Trete unserer Community in wenigen Minuten bei! Melde dich mit deinen Daten an, um loszulegen',

    'homepage1' => 'Webseite',
    'homepage2' => 'Gib deine Webseite ein.',
    'sexuality' => 'Geschlecht',
    'female' => 'weiblich',
    'diverse' => 'divers',
    'male' => 'männlich',
    'unknown' => 'keine Angabe',
    'date_of_birth' => 'Geburtsdatum',
    'fields_star_required' => ' Pflichtfelder',
    'enter_homepage' => 'Du hast deine Webseiten-Adresse nicht eingeben.'

);

