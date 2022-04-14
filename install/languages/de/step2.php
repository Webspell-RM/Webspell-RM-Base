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
	
    'enter_url' => 'Bitte gebe die URL an, wohin webSPELL installiert wird',
    'error' => 'Fehler',
    'licence' => 'Lizenzvereinbarung',
    'php_info' => 'Aufgrund eines großen Fehlers in den MySQL fetch Funktionen in PHP 5.2.6 ist die Installation von webSPELL nicht möglich.<br>
	webSPELL läuft mit allen niedrigeren (bis zu PHP 4.3) und allen höheren PHP-Versionen. Nehm Kontakt mit Deinem Hoster auf, um die PHP-Version zu ändern',
    'php_version' => 'PHP Version Inkompatibilität',
    'tooltip' => 'Das ist die URL von deiner Seite, z.B. (domain.de/pfad/webspell). Kein http:// vor dem Pfad mit eingeben und nicht mit einem Schrägstrich (Slash) enden.',
    'you_have_to_agree' => 'Du musst die GNU GPL akzeptieren, um webSPELL auf Deinem Server zu installieren!',
    'your_site_url' => 'Die URL zur Seite',
    'back' => 'zur&uuml;ck',
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
	'new_install'=>'Kein Update / Neuinstallation Webspell-RM (Version: 2.0.9 )',
	'select_install'=>'Update / Installation auswählen',
	'update_200_201'=>'Update von Webspell-RM (Version: 2.0.0 - Update: 1.1 ) auf Webspell-RM (Version: 2.0.1 )',
	'update_201_202'=>'Update von Webspell-RM (Version: 2.0.1) auf Webspell-RM (Version: 2.0.3 )',
	'update_125_209'=>'Update von Webspell-NOR (Version: 1.2.5 ) auf Webspell-RM (Version: 2.0.9 )',
	'update_org_209'=>'Update von Webspell.org (Version: 4.2.5 & 4.2.3a ) auf Webspell-RM (Version: 2.0.9 )',
	'what_to_do'=>'Was möchtest Du tun?'

);
?>
