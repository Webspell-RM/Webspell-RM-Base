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
  'access_rights'=>'Zugriffsrechte',
  'actions'=>'Aktionen',
  'active'=>'aktiv',
  'activity'=>'Aktivität',
  'cash_admin'=>'Kassen-Admin',
  'clanwar_admin'=>'Clanwar-Admin',
  'nickname'=>'Nickname',
  'delete'=>'löschen',
  'description'=>'Benutzer Beschreibung',
  'edit'=>'ändern',
  'edit_member'=>'Mitglied ändern',
  'error_own_rights'=>'FEHLER: Eigene Rechte können nicht geändert werden',
  'feedback_admin'=>'Feedback-Admin',
  'fightus_admin'=>'Herausforderung-Admin',
  'file_admin'=>'Datei-Admin',
  'gallery_admin'=>'Galerie-Admin',
  'group_access'=>'Forum Gruppen Zugriff',
  'inactive'=>'inaktiv',
  'joinus_admin'=>'Beitritt-Admin',
  'members'=>'Mitglieder',
  'messageboard_admin'=>'Forum-Admin',
  'messageboard_moderator'=>'Forum-Moderator',
  'news_admin'=>'Neuigkeiten-Admin',
  'news_writer'=>'Neuigkeiten-Autor',
  'nickname'=>'Nickname',
  'no'=>'nein',
  'page_admin'=>'Seiten-Admin',
  'polls_admin'=>'Umfragen-Admin',
  'position'=>'Position',
  'really_delete'=>'Dieses Mitglied wirklich löschen?',
  'sort'=>'Sortierung',
  'squad'=>'Team',
  'super_admin'=>'Super-Admin',
  'to_sort'=>'sortieren',
  'tooltip_1'=>'<b>Zugriff:</b><br>- Neuigkeiten Rubriken<br>- Neuigkeiten Sprachen<br>- Neuigkeiten<br>- Artikel<br>- Auszeichnungen<br>- Links',
  'tooltip_2'=>'<b>Zugriff:</b><br>- Neuigkeiten schreiben',
  'tooltip_3'=>'<b>Zugriff:</b><br>- Umfragen',
  'tooltip_4'=>'<b>Zugriff:</b><br>- Kommentare<br>- Gästebuch<br>- Benutzergästebücher<br>- Shoutbox',
  'tooltip_5'=>'<b>Zugriff:</b><br>- Benutzer<br>- Benutzer Rechte<br>- Gruppen<br>- Mitglieder<br>- Kontakte<br>- Newsletter',
  'tooltip_6'=>'<b>Zugriff:</b><br>- Clanwars<br>- Auszeichnungen<br>- Herausforderungen<br>- Kalender',
  'tooltip_7'=>'<b>Zugriff:</b><br>- Forum Kategorien<br>- Foren<br>- Forumbeiträge bearbeiten &amp; löschen<br>- Benutzergruppen<br>- Gruppen Benutzer<br>- Benutzer Ränge',
  'tooltip_8'=>'<b>Zugriff:</b><br>- Forumbeiträge bearbeiten &amp; löschen<br>(Board-Zuteilung muss vorhanden sein)',
  'tooltip_9'=>'<b>Zugriff:</b><br>- Über uns<br>- Bannerrotation<br>- Symbole<br>- Datenbank<br>- FAQ Kategorien<br>- FAQ<br>- Werdegang<br>- Impressum<br>- Link Kategorien<br>- Links<br>- Seite sperren<br>- Parnter<br>- Server<br>- Einstellungen<br>- Statische Seiten<br>- Stile<br>- Update<br>- Uns verlinken<br>- Sponsoren',
  'tooltip_10'=>'<b>Zugriff:</b><br>- Datei Kategorien<br>- Dateien<br>- Demos',
  'tooltip_11'=>'<b>Zugriff:</b><br>- Clan-Kasse',
  'tooltip_12'=>'<b>Zugriff:</b><br>- Galerie Kategorien<br>- Galerien<br>- Bilder',
  'tooltip_13'=>'<b>Zugriff:</b><br>- voller Administrations Zugriff',
  'transaction_invalid'=>'Transaktions ID ungültig',
  'user_admin'=>'Benutzer-Admin',
  'yes'=>'ja',
  'na'=>'n/a',
  'n_a'=>'n/a',
  'used_for'=>'Genutzt für',
  'special_rank'=>'Spezialrank',
  'no_special_rank'=>'kein Spezial Rank',
  'options'=>'Optionen',
  'saved successfully'=>'erfolgreich gespeichert',
  'delete_info'=>'Möchten Sie dieses Mitglied wirklich entfernen? <br><br>Es wird alles endgültig gelöscht.',
  'success'=>'<div class="alert alert-success" role="alert">Rechte erfolgreich bearbeitet</div>'
);

