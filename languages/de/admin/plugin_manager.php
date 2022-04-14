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

  'access_denied'=>'Zugriff verweigert',
  'actions'=>'Aktionen',
  'activate' => 'Aktivieren',
  'activated' => 'Aktiviert',
  'activated'=>'aktiviert?',
  'add_modul'=>'Modul hinzufügen',
  'add_plugin'=>'Plugin hinzufügen',
  'add'=>'Plugin hinzufügen',
  'all_activated'=>'l. / r. aktiviert',
  'all_deactivated'=>'Base aktiviert',
  'back'=>'zurück',
  'base'=>'Base',
  'content_foot'=>'Content Foot',
  'content_head'=>'Content Head',
  'deactivate' => 'Deaktivieren',
  'deactivated' => 'Deaktiviert',
  'deactivated'=>'deaktiviert',
  'delete' => 'Entfernen',
  'description' => 'Beschreibung',
  'description'=>'Beschreibung',
  'edit_modul' => 'Edit Module',
  'edit_plugin'=>'Plugin ändern',
  'edit'=>'Plugin ändern',
  'failed_activated' => '<div class="alert alert-warning" role="alert">Plugin aktivierung fehlgeschlagen.</div>',    
  'failed_deactivated' => '<div class="alert alert-warning" role="alert">Plugin deaktivieren fehlgeschlagen.</div>',    
  'failed_delete' => '<div class="alert alert-warning" role="alert">Plugin entfernen fehlgeschlagen.</div>',    
  'failed_edit' => '<div class="alert alert-warning" role="alert">Plugin konnte nicht aktualisiert werden.</div>',
  'failed_save' => '<div class="alert alert-warning" role="alert">Plugin konnte nicht gespeichert werden.</div>',    
  'fields_star_required' => ' Pflichtfelder',
  'foot_section'=>'Foot Section',
  'head_section'=>'Head Section',
  'id' => 'ID',
  'info'=> '<div class="col-sm-6 alert alert-warning" role="alert"><small>
    <b>Modul Seiten Name:</b> Name der  Seite für die Einstellung<br>
    <b>Basis aktiviert:</b> Die linke und rechte Spalte wird deaktiviert und nicht sichbar<br>
    <b>Links aktiviert:</b> Die linke Seite (Spalte) im Frontend ist sichtbar<br>
    <b>Rechts aktiviert:</b> Die rechte Seite (Spalte) im Frontend ist sichtbar<br>
    <b>Linkls und Rechts aktiviert:</b> Die linke und rechte Seite (Spalte) im Frontend ist sichtbar</small>
    </div>

    <div class="col-sm-6 alert alert-warning" role="alert"><small>
    <b>Page Head aktiviert:</b> Der Head Bereich ist sichtbar<br>
    <b>Content Head aktiviert:</b> Der Head im Content ( Mittleren Kopfbereich ) sichtbar<br>
    <b>Content Foot aktiviert:</b> Der Foot im Content ( Mittlerer Foot bereich) sichtbar<br>
    <b>Head Section aktiviert:</b> Der Head Section Bereich sichtbar<br>
    <b>Content Foot aktiviert:</b> Der Content Foot Bereich sichtbar</small></div>',
  'left_is_activated'=>'Links aktiviert',
  'left_page'=>'Page left',
  'left_right_page'=>'Page left right',
  'modul_edit'=>'Modul Einstellung',
  'modul_info'=>'<span class="alert alert-warning" role="alert"><i class="fas fa-exclamation-triangle"></i> Du musst deine installierten Plugins hinzufügen, damit du die Moduleinstellung vornehmen kannst.</span>',
  'modulname'=>'Modulname',
  'na'=>'nicht verfügbar',
  'name' => 'Name',
  'new_modul'=>'Plugin hinzufügen',
  'new_plugin' => 'Neues Plugin',
  'no_modul_setup' => '<div class="alert alert-warning" role="alert">Beschreibung:<br>Es wurde kein Plugin gefunden.</div>',
  'no'=>'Nein',
  'option' => 'Option',
  'options'=>'Optionen',
  'options'=>'Optionen',
  'page_head'=>'Page Head',
  'plugin' => 'Plugin',
  'plugin_manager' => 'Plugin Manager',
  'read_more'=>'Mehr lesen',
  'really_delete'=>'Möchten Sie dieses Plugin wirklich entfernen? Es werden nur die Einträge im Plugin Manager gelöscht.',
  'right_is_activated'=>'Rechts aktiviert',
  'right_page'=>'Page right',
  'select' => 'Wähle dein Plugin.',
  'status' => 'Status',
  'styles' => 'Stile',
  'success_activated' => '<div class="alert alert-success" role="alert">Plugin ist jetzt aktiviert.</div>',
  'success_deactivated' => '<div class="alert alert-info" role="alert">Plugin ist jetzt deaktiviert.</div>',
  'success_delete' => '<div class="alert alert-danger" role="alert">Plugin wurde entfernt.</div>',
  'success_edit' => '<div class="alert alert-success" role="alert">Plugin erfolgreich aktualisiert.</div>',
  'success_save' => '<div class="alert alert-success" role="alert">Plugin erfolgreich gespeichert.</div>',
  'to_sort'=>'sortieren',
  'transaction_invalid'=>'Transaktions ID ungültig',
  'wrote'=>'schrieb',
  'yes'=>'Ja',
  'no_modul'=>'<div class="alert alert-warning" role="alert">Es wurde kein Plugin gefunden.</div>'

);

