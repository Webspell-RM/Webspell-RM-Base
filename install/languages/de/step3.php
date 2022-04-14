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
	
	'available'=>'vorhanden',
	'check_chmod'=>'CHMOD Überprüfung',
	'check_requirements'=>'Überprüfe Anforderungen',
	'chmod_error'=>'<b>Der CHMOD konnte nicht gesetzt werden.</b><br>Bitte gebe den Ordnern CHMOD 777 und den Dateien CHMOD 766 manuell',
	'sql_error'=>'sql.php muss beschreibbar sein oder webSPELL kann nicht installiert werden.',
	'sql_support'=>'MySQL Unterstützung',
	'multibyte_support'=>'MultiByte Unterstützung',
	'curl_support'=>'Curl Unterstützung',
	'curlexec_support'=>'Curl-Exec Unterstützung',
	'allow_url_fopen_support'=>'allow_url_fopen Unterstützung',
	'no'=>'nein',
	'php_version'=>'PHP Version',
	'set_chmod'=>'CHMOD setzen',
	'setting_chmod'=>'CHMOD wird gesetzt...',
	'stylesheet_error'=>'stylesheet.css muss beschreibbar sein oder webSPELL läuft nicht korrekt.',
	'successful'=>'erfolgreich!',
	'unavailable'=>'Nicht vorhanden',
	'unwriteable'=>'Nicht beschreibbar',
	'writeable'=>'beschreibbar',
	'yes'=>'Ja',
    'back' => 'zur&uuml;ck',
	'admin_email'=>'Admin E-Mail',
	'admin_password'=>'Admin Passwort',
	'admin_username'=>'Admin Benutzername',
	'data_config'=>'Daten Konfiguration',
	'database_config'=>'MySQL Datenbank Konfiguration',
	'finish_install'=>'Installation abschließen',
	'finish_next'=>'Mit dem nächsten Schritt wird die Installation abgeschlossen.<br><br>Vergiss nicht ein <b>MySQL Backup</b> zu erstellen!',
	'host_name'=>'Host Name',
	'mysql_database'=>'MySQL Datenbankname',
	'mysql_password'=>'MySQL Passwort',
	'mysql_prefix'=>'MySQL Tabellen Vorzeichen',
	'mysql_username'=>'MySQL Benutzername',
	'tooltip_1'=>'Das ist die Serveradresse von deiner MySQL Datenbank. Normalerweise ist es localhost.',
	'tooltip_2'=>'Entweder ist es etwas wie root oder ein Benutzername, den Du von deinem Hoster erhalten hast.',
	'tooltip_3'=>'Für die Sicherheit der Seite ist ein MySQL-Server Passwort Pflicht.',
	'tooltip_4'=>'Manche Hoster erlauben nur einen bestimmten Datenbankname pro Seite. Benutze das Tabellen Vorzeichen für diesen Fall.',
	'tooltip_5'=>'Um eine Kollision verschiedener Daten zu vermeiden, benutze ein Tabellen Vorzeichen. Zur Sicherheit ist es automatisch generiert. Du kannst auch ein anderes Vorzeichen verwenden.',
	'tooltip_6'=>'Dieser ist zugleich dein Loginname auf der Seite.',
	'tooltip_7'=>'Schütze deinen Admin Konto mit einem Passwort. Benutze kein einfaches Passwort. Am besten mit Zahlen und verschiedenen Zeichen.',
	'tooltip_8'=>'Deine E-Mail Adresse. Diese wird zugleich auch als Kontakt Adresse benutzt.',
	'webspell_config'=>'webSPELL Konfiguration',
	'min_requirements' =>'Webspace Mindestvoraussetzungen',
	'php_ver'=>'PHP-Version 5.6 oder höher<br>MYSQL-Version 5.7.20 oder höher',
	'pass_ver'=>'Ihr Passwort muss enthalten',
	'pass_text'=>'8 oder mehr Zeichen<br>Groß- und Kleinbuchstaben<br>1 oder mehr Sonderzeichen<br>mindestens eine Zahl'

);
?>
