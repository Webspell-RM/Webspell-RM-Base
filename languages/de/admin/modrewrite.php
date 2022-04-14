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
    'modrewrite'=>'ModRewrite',
    'add_rule'=>'Regel hinzufügen',
    'variables'=>'Variablen',
    'variable'=>'Variable',
    'type'=>'Typ',
    'more'=>'mehr',
    'url'=>'URL',
    'replace'=>'Ersetzen',
    'save_rule'=>'Regel speichern',
    'edit_rule'=>'Regel bearbeiten',
    'transaction_invalid'=>'Transaktions ID ungültig',
    'modrewrite_settings'=>'ModRewrite Einstellungen',
    'modrewrite_rules'=>'ModRewrite Regeln',
    'apache_with_module'=>'Apache mit PHP-Modul',
    'modrewrite_is_enabled'=>'mod_rewrite ist aktiviert in der httpd.conf',
    'modrewrite_is_disabled'=>'mod_rewrite ist nicht aktiviert in der httpd.conf',
    'apache_with_cgi'=>'Apache mit CGI und PHP',
    'unsupported_webserver'=>'Nicht unterstützter Webserver',
    'can_not_write_file'=>'%s kann nicht geschrieben werden<br>Überprüfen Sie die chmod und versuchen Sie es erneut',
    'fopen_disabled'=>'url_fopen ist deaktiviert. Von Ajax Test umgangen',
    'modrewrite_failed'=>'mod_rewrite ist fehlgeschlagen',
    'htaccess_failed'=>'.htaccess fehlgeschlagen / Server-Fehler',
    'test_successful'=>'Test erfolgreich',
    'unexpected_result'=>'unerwartete Ergebnis',
    'result'=>'Resultat',
    'debug'=>'Debug',
    'enable'=>'aktivieren',
    'htaccess_exists_merge'=>'Es gibt bereits eine .htaccess. Bitte Zusammenführen mit .htaccess_ws',
    'successful'=>'erfolgreich',
    'state'=>'Zustand',
    'enabled'=>'aktiviert',
    'disable'=>'deaktivieren',
    'new_rule'=>'Neue Regel',
    'rule'=>'Regel',
    'actions'=>'Aktionen',
    'edit'=>'Bearbeiten',
    'delete'=>'löschen',
    'really_delete'=>'Wirklich diese ModRewrite Regeln löschen?',
    'no_entries'=>'Keine Einträge',
    'test_support'=>'Support Testen',
    'rebuild'=>'URLs neu generieren',
    'options'=>'Optionen',
    'add_apache_options'=>'Fügen Sie die folgende Zeile in Ihre Apache-Konfiguration: <br> Options -MultiViews',
    'modrewrite_available_but_multiview_enabled'=>'mod_rewrite ist verfügbar, aber Apache MultiViews sind aktiviert und verhindert ein mod_rewrite',
    'saved successfully'=>'erfolgreich gespeichert',
    'delete_info'=>'Möchten Sie diese ModRewrite Regeln wirklich entfernen? <br><br>Es wird alles endgültig gelöscht.',
    'htinfo1'=>'<strong>Manuelle .htaccess erstellen:</strong></br>',
    'htinfo2'=>'<strong>und wiederholen Sie den Vorgang!</strong>'
);
