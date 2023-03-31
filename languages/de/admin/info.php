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

  'access_denied'=>'Zugriff verweigert',
  'hello'=>'Hallo',
  'last_login'=>'dein letzte Anmeldung war am',
  'version'=>'Version',
  'webspell_version'=>'Webspell RM Version',
  'welcome'=>'Willkommen in deinem Management Center',
  'welcome_message'=>'<br>Dieses Administrations System erlaubt es dir, deine Seite zu managen, benutze die Navigation links.<br>Sollten Fragen vorhanden sein, benutze bitte unseren <a href="https://www.webspell-rm.de" target="_blank">Support</a>.<br><br>Danke, dass du dich für Webspell RM entschieden hast.<br><br>Dein <a href="https://www.webspell-rm.de" target="_blank">Webspell RM Entwicklungs Team</a>',
  'na'=>'Information nicht verfügbar',
  #'error' => 'Server ist nicht Update Kompatibel oder die Updatedatei ist nicht vorhanden!',
  'error' => '<p class="text-danger"><i class="fas fa-exclamation-triangle"></i> Update-Server ist offline!</p>',
  'new_version_available' => '<p class="text-warning"><i class="fas fa-exclamation-triangle"></i> Eine neue Webspellversion ist vorhanden!</p>Update dein System.',
  'update_info1' => '<p class="text-success">Deine Version ist aktuell <i class="fas fa-check text-success"></i></p>',
  'update_info2' => '<p class="text-danger">Deine Version ist h&ouml;her, wie die von Webspell-RM.</p><i class="fas fa-exclamation-triangle text-danger"></i>  Kontaktiere das Webspellteam!', 
  're_update' => 'Jetzt Updaten',
  'changelog' => 'CHANGELOG.md anzeigen',
  'install_version' => 'Installierte Version',
  'version_check' => '<h4><u>Version Check</u></h4> Es wird überprüft,<br> ob deine Webspell-RM Version aktuell ist.<br>',
  'server_check' => '<h4>Server Check</h4>',
  'serversystem_text' => 'Webspell-RM - Serversystem',
  'server_used' => 'Verwendeter Server',
  'report_text' => '<b class="text-danger">Alle Offline</b> - Bitte Reporten',
  'wiki' => '<h4>Wiki</h4> Auf unserer WIKI Website findest du viele hilfreiche<br>Informationen zu Installation, Configuration<br>und viele Tips.',
  'wiki_text' => 'Das offizielle Webspell RM Wiki',
  'discord' => '<h4>Discord</h4> Community-Treffpunkt für Gleichgesinnte<br>Chatte auf Discord mit uns.',
  'discord_text' => 'Discord',
  'forum' => '<h4>Forum</h4> Zum Austausch und Archivierung von Gedanken, Meinungen und Erfahrungen.<br>Diskusionen & Support',
  'forum_text' => 'Das Webspell-RM Forum',
  'update_plugin' => '<div class="text-warning">&nbsp;&nbsp;<i class="fas fa-exclamation-triangle"></i> Eine neue Plugin-Version ist vorhanden!</div>',
  'update_template' => '<div class="text-warning">&nbsp;&nbsp;<i class="fas fa-exclamation-triangle"></i> Eine neue Template-Version ist vorhanden!</div>',
  'plugin_update' => 'Neue Updates für installierte Plugins',
  'templates_update' => 'Neue Updates für installierte Templates',
  'update_support' => 'Webspell-RM Version und Support Info',
  'title'=>'Webspell-RM Dashboard'
  
);

