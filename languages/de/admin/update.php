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

  'access_denied' => 'Zugriff verweigert',
  'error' => 'Server ist nicht Update Kompatibel oder die Updatedatei ist nicht vorhanden!',
  'step1' => 'Step 1: Updateserver Online',
  'step2' => 'Step 2: Remote Installationsfile vorhanden',
  'error_step2_1' => 'Installationsfile nicht gefunden! <br />Update abgebrochen.',
  'error_step2_2' => 'Installationsfile gefunden! <br />Update wird nun fortgesetzt mit Datei-Upload und der Tabellen Installation.',
  'file_loaded' => 'File geladen',
  'file_not_loaded' => 'File nicht geladen',
  'file_deleted' => 'File gel&ouml;scht',
  'file_not_deleted' => 'File nicht gel&ouml;scht',
  'all_files_have_been_edited' => 'Es wurden alle Dateien bearbeitet!<br />Result',
  'of' => 'von',
  'installcomplete_1' => 'Webspellupdate wurde erfolgreich auf die Version',
  'installcomplete_2' => 'erfolgreich installiert!',
  'back_to_overview' => 'Zur&uuml;ck zur &Uuml;bersicht',
  'step4' => 'Step 4: Tabellen Installation',
  'syq_error' => 'MYSQL-Fehler: Bitte melde dich beim Support!',
  'not_all_files_edited' => 'Es wurden nicht alle Dateien bearbeitet!',
  'step3' => 'Step 3: Lade Dateien...',
  'webspell_update' => 'webSPELL aktualisieren',
  'webspellupdater' => 'Webspellupdater',
  'check_version' => '&Uuml;berpr&uuml;fe Version',
  'update' => 'Update',
  'data saved' => 'Daten gespeichert!',
  'update_now' => 'Jetzt Updaten',
  'fill_in_ftp_settings' => 'Bitte FTP - Einstellungen ausf&uuml;llen!',
  'new_version_available' => 'Eine neue Webspellversion ist vorhanden!',
  'update_info1' => 'Bitte beachte vor dem Update folgende Hinweise!',
  'update_info2' => '- Mysqlbackup gemacht ?<br />- Webspelldateien via FTP gesichert ?<br />- Deine installierenten Plugins sind auf dem neusten Stand! (Prüfen unter Plugin-Installer)<br /><br />Webspell-RM &uuml;bernimmt keinerlei Haftung bei sch&auml;den und das Update erfolgt auf eigene Gefahr!',
  'update_info3' => 'Deine Version ist aktuell!',
  'update_info4' => 'Sofern du mitbekommst, das ein Update innerhalb dieser Version erschienen ist, kannst du dann auch deine Version RE-Updaten!<br />Bedenke, das die Mysql-Install wieder durchl&auml;uft und Einstellungen, die du nach dem Update gemacht hast neu eingestellt werden m&uuml;ssen !<br /><br /><p class="text-danger"><b>Wichtig:</b></p> Vergewissere dich vor dem Update, das deine installierenten Plugins auf dem neusten Stand sind! (unter Plugin-Installer)<br /><br />',
  're_update' => 'Jetzt RE-Updaten',
  'update_info5' => 'Deine Version ist h&ouml;her, wie die von Webspell-RM. Kontaktiere das Webspellteam!',
  'your_version' => 'Deine Webspellversion',
  'latest_version' => 'Aktuellste Webspellversion',
  'result' => 'Ergebnis',
  'ftp_settings' => 'FTP - Einstellungen',
  'server_ip' => 'FTP-Serverip',
  'ftp_ip' => 'Wie lautet Deine ServerIP (Bsp.: 123.345.654.899)',
  'server_port' => 'FTP-Serverport',
  'ftp_port' => 'Wie lautet dein Serverport (Bsp.: 21 )',
  'server_pfad' => 'Pfad zum Verzeichnis',
  'ftp_pfad' => 'Pfad zu deinen Webspellverzeichniss (Bsp.: / oder /webspell/)',
  'server_username' => 'FTP-Benutzername',
  'ftp_username' => 'Benutzername vom FTP-Server',
  'server_password' => 'FTP-Password',
  'ftp_password' => 'Password vom FTP-Server',
  'save' => 'Speichern',
  'ftp_path_check' => 'Pfad&uuml;berpr&uuml;fung',
  'ftp_path_error' => 'Fehler beim Pfad - Bitte &uuml;berpr&uuml;fen !',
  'ftp_login_error' => 'Fehler beim Login - Bitte &uuml;berpr&uuml;fen !',
  'ftp_login_check' => 'Login &uuml;berpr&uuml;fen !',


  'updateserversuccess'=>'Updateserver ist Online.',
  'filename'=>'Dateiname',
  'get_new_version'=>'Hol dir hier die neuste webSPELL Version!',
  'information'=>'Informationen',
  'new_functions'=>'Neue Funktionen für webSPELL vorhanden',
  'new_updates'=>'Neue Updates für webSPELL vorhanden',
  'new_version'=>'Neue webSPELL Version vorhanden',
  'no_updates'=>'Keine Updates vorhanden!',
  'version'=>'Version',
  
  'install_complete'=>'Installation war erfolgreich!',
  'install_running'=>'Installation wird ausgef&uuml;hrt!',
  'finish_install'=>'Installation abschliessen',
  'view_site'=>'Betrachte Deine Seite',
  'transaction_invalid'=>'Transaktions ID ung&uuml;ltig'
);

