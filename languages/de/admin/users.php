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

  'about_myself'=>'Über mich selbst',
  'access_denied'=>'Zugriff verweigert',
  'actions'=>'Aktionen',
  'activate'=>'aktivieren',
  'active'=>'aktiv',
  'activity'=>'Aktivität',
  'add_new_user'=>'neuen Benutzer hinzufügen',
  'add_to_clan'=>'zum Clan hinzufügen',
  'admin'=>'Administrator',
  'avatar'=>'Avatar',
  'back'=>'zurück',
  'banish'=>'bannen',
  'banned'=>'gebannt',
  'ban_for'=>'Bannen für',
  'ban_status'=>'Bann Status',
  'ban_until'=>'Bannen bis',
  'ban_user'=>'Benutzer bannen',
  'birthday'=>'Geburtstag',
  'clan_history'=>'Clan Werdegang',
  'clan_homepage'=>'Clan Homepage',
  'can_not_copy_file'=>'FEHLER: Kann die Datei nicht vom Server beziehen',
  'clan_irc'=>'Clan IRC',
  'clanmember'=>'Clanmitglied',
  'clanname'=>'Clan Name',
  'clantag'=>'Clan Kürzel',
  'connection'=>'Verbindung',
  'country'=>'Land',
  'cpu'=>'CPU',
  'days'=>'Tage',
  'delete'=>'entfernen',
  'delete_avatar'=>'Avatar löschen',
  'delete_picture'=>'Bild löschen',
  'diverse' => 'divers',
  'edit_ban'=>'Ban ändern',
  'edit_profile'=>'Profil ändern',
  'email'=>'E-Mail',
  'error_avatar'=>'FEHLER: Avatar ist zu Groß (max. 90x90)',
  'error_picture'=>'FEHLER: Bild ist zu Groß (max. 285x250)',
  'female'=>'weiblich',
  'firstname'=>'Vorname',
  'gender'=>'Geschlecht',
  'general'=>'Allgemeines',
  'graphiccard'=>'Grafikkarte',
  'homepage'=>'Homepage',
  'icq'=>'ICQ',
  'inactive'=>'inaktiv',
  'invalid_format'=>'FEHLER: Unerlaubtes Bild Format (erlaubt: *.gif, *.jpg oder *.png)',
  'keyboard'=>'Tastatur',
  'lastname'=>'Nachname',
  'mainboard'=>'Mainboard',
  'male'=>'männlich',
  'max_90x90'=>'(max. 90x90)',
  'max_285x250'=>'(max. 285x250)',
  'moderator'=>'Forum Moderator',
  'month'=>'Monate',
  'monitor'=>'Monitor',
  'mouse'=>'Maus',
  'mousepad'=>'Mauspad',
  'nickname'=>'Nickname',
  'not_available'=>'keine Angabe',
  'no_users'=>'keine Benutzer gefunden',
  'password'=>'Passwort',
  'permanently'=>'Permanent Bannen ?',
  'personal'=>'Persönliches',
  'picture'=>'Bild',
  'pictures'=>'Bilder',
  'position'=>'Position',
  'profile'=>'Profil',
  'ram'=>'Arbeitsspeicher',
  'really_ban'=>'Benutzer bannen:',
  'really_delete'=>'Diesen Benutzer wirklich löschen?',
  'really_unban'=>'Benutzer entbannen:',
  'reason'=>'Begründung',
  'registered_since'=>'Registriert seit',
  'remove_ban'=> 'Ban entfernen?',
  'rights'=>'Rechte',
  'signatur'=>'Signatur',
  'sort'=>'Sortierung',
  'soundcard'=>'Soundkarte',
  'squad'=>'Team',
  'status'=>'Status',
  'superadmin'=>'Superadministrator',
  'town'=>'Wohnort',
  'transaction_invalid'=>'Transaktions ID ungültig',
  'to_clan'=>'zum Clan',
  'to_sort'=>'sortieren',
  'undo_ban'=>'entbannen',
  'upload_failed'=>'FEHLER: Upload fehlgeschlagen',
  'user'=>'Benutzer',
  'user_exists'=>'Benutzer bereits vorhanden',
  'user_id'=>'Benutzer ID',
  'username'=>'Benutzername',
  'users'=>'Benutzer',
  'users_available'=>'Benutzer vorhanden',
  'usersearch'=>'Benutzer Suche',
  'exactsearch'=>'exakt',
  'various'=>'Sonstiges',
  'weeks'=>'Wochen',
  'you_cant_ban'=>'Du kannst diesen Benutzer nicht bannen! (Superadmin)',
  'you_cant_ban_yourself'=>'Du kannst dich nicht selbst bannen!',
  'error'=>'Fehler',
  'twitch' => 'Twitch',
  'youtube' => 'Youtube',
  'twitter' => 'Twitter',
  'instagram' => 'Instagram',
  'facebook' => 'Facebook',
  'stream' => 'Stream',
  'social-media' => 'Social Media',
  'image_too_big' => 'Bild zu groß',
  'options'=>'Optionen',
  'delete_info'=>'Möchten Sie diesen Benutzer wirklich entfernen? <br><br>Es wird alles endgültig gelöscht.'
);

