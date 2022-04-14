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
  'actions'=>'Aktionen',
  'add_squad'=>'Team hinzufügen',
  'back'=>'zurück',
  'current_icon'=>'Aktuelles Symbol',
  'current_icon_small'=>'Aktuelles Symbol (klein)',
  'delete'=>'löschen',
  'edit'=>'ändern',
  'edit_squad'=>'Team ändern',
  'format_incorrect'=>'Das Format des Banner war falsch. Bitte lade nur Banner im *.gif, *.jpg oder *.png Format hoch.',
  'game'=>'Spiel',
  'gaming_squad'=>'spielendes Team',
  'icon'=>'Symbol',
  'icon_upload'=>'Symbol Upload',
  'icon_upload_info'=>'für den sc_squads include',
  'icon_upload_small'=>'Symbol Upload (klein)',
  'information_incomplete'=>'Angaben unvollständig.',
  'new_squad'=>'neues Team',
  'no_icon'=>'Kein Symbol vorhanden',
  'non_gaming_squad'=>'nicht spielendes Team',
  'really_delete'=>'Dieses Team wirklich löschen?',
  'sort'=>'Sortierung',
  'squad_info'=>'Team Info',
  'squad_name'=>'Team Name',
  'squad_type'=>'Team Type',
  'squads'=>'Teams',
  'transaction_invalid'=>'Transaktions ID ungültig',
  'to_sort'=>'sortieren',
  'wrote' => 'Wrote',
  'read_more' => 'Read more',
  'na' => 'Not available',
  'options'=>'Optionen',
  'info'=> '<div class="alert alert-warning" role="alert"><b>Sprachanwendung:</b><br>
In dem Text muss ein entsprechender Sprach-Tag hinterlegt werden, was wie folgt aussieht.<br>{[de]} Überschrift und Text in deutscher Sprache.<br>
{[en]} Heading and text in English.</div>',
  'saved successfully'=>'erfolgreich gespeichert',
  'delete_info'=>'Möchten Sie dieses Team wirklich entfernen? <br><br>Es wird alles endgültig gelöscht.'
);



