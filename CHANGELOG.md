### WEBSPELL | RM - Release: 2.0.5 (17.02.2021)
---------------------------------------------------------------------
+ /includes/themes/default/index.php -> erweitert Head Section und Foot Section
+ /admin/plugin-manager.php -> erweitert Head Section und Foot Section 
+ /admin/plugin-widget.php -> Design angepasst, erweitert Head Section und Foot Section 
+ Datenbank widget und plugins -> erweitert Head Section und Foot Section
+ system/content.php erweitert Head Section und Foot Section
+ /admin/settings_templates -> erweitert Style, Button Theme bezogen
+ Datenbank settings_templates -> erweitert Style, Button Theme bezogen
- /admin/settings_button -> DB und Seite gelöscht 
- /admin/settings_style -> DB und Seite gelöscht


+ /system/content.php -> angepasst
+ /system/settings.php -> angepasst 
+ /system/plugins.php -> angepasst 
+ /components/button.css.php -> angepasst 
+ /components/style.css.php -> angepasst 
+ /includes/modules/navigation.php -> angepasst
+ /includes/modules/navigation_login.php -> angepasst, Messenger-Forum Anzeige pluginabhängig
+ /includes/modules/navigation_login.php -> angepasst, Sprach-Flaggen im Dashboard ein und ausblendbar
+ /includes/themes/default/index.php -> angepasst
+ /includes/themes/default/templates/navigation.html -> angepasst, Messenger-Forum Anzeige pluginabhängig
+ /includes/modules/loginoverview.php -> clanwars, events aus dem Kalender Anzeige, Clankasse Button pluginabhängig 


+ /components/jquery/jquery.min.js -> Update
+ /admin/users.php -> Geschlecht "divers" hinzugefügt
+ /includes/modules/myprofile.php -> Geschlecht "divers" hinzugefügt
+ /includes/modules/profile.php -> Geschlecht "divers", letzte Beiträge hinzugefügt, Statistik pluginabhängig
+ /includes/themes/default/templates/profile.html -> Geschlecht "divers", letzte Beiträge hinzugefügt, Statistik pluginabhängig
+ /includes/themes/default/templates/myprofile.html -> Geschlecht "divers" hinzugefügt
+ /languages/de/myprofile.php -> Geschlecht "divers" hinzugefügt
+ /languages/de/profile.php -> Geschlecht "divers" hinzugefügt
+ /languages/de/admin/users.php -> Geschlecht "divers" hinzugefügt
+ /includes/themes/default/templates/privacy_policy.html -> Doppelete Überschrift entfernt
+ Eintrag in der DB plugin erweitert für Static Seiten
+ Eintrag in der DB settings erweitert für letzte Beiträge in Profil Seiten

+ max 3 Widgets pro Plugin möglich
+ jedes Widget kann jetzt auch mehrfach auf einer Seite dargestellt werden
+ update aller Plugins mit Widget wurden angepasst
+ Startpage erneuert

+ Installation / update von NOR (Ver.1.2.5) und .org (Ver. 4.2.3a und 4.2.5) angepasst 
+ Die drei beliebsten Themes angepasst (cyborg, slate und spacelab) 


### WEBSPELL | RM - Release: 2.0.4 (30.12.2020)
---------------------------------------------------------------------
+ /admin/update.php 
  -> Passwort verstecken 
  -> Updatefunktion erweitert (für weitere Versionen)
+ /admin/info.php -> changelog Abfrage
+ /components/admin/css/page.css -> info.php angepasst
+ /components/admin/js/page.js -> info.php angepasst
+ /admin/admincenter.php -> angepasst JS augelagert
+ /admin/plugin-installer.php -> Design angepasst 
+ /admin/template-installer.php -> Design angepasst
+ /languages/de-en-it/admin/admincenter.php -> angepasst
+ /languages/de-en-it/admin/info.php -> angepasst
+ /languages/de-en-it/admin/overview.php -> angepasst
+ /languages/de-en-it/admin/page_statistic.php -> angepasst
+ /languages/de-en-it/admin/settings.php -> angepasst
+ /languages/de-en-it/admin/update.php -> angepasst
+ /languages/de-en-it/admin/widget.php -> angepasst
+ /languages/it/admin/plugin_installer.php -> angepasst


### WEBSPELL | RM - Release: 2.0.3 (27.10.2020)
---------------------------------------------------------------------
+ /system/settings.php -> magic_quotes entfernt
+ /system/seo.php -> implode gefixt
+ /install/step3.php
  -> Neue Ansicht für Chmod
  -> Ordnercheck für themes eingefügt
  -> Buttoncheck bei Fehler
+ /system/sqlsample.php eingefügt
+ /admin/overview.php -> curl-exec hinzugefügt
+ /admin/page_statistic -> Auslesung existierter Einträge der Tabellen
+ /admin/visitor_statistic -> Notice + Auslesefehler behoben
+ /admin/users.php
  -> Redirect angepasst ( users - members )
  -> Savepunkt für Nickname hinzugefügt
+ /language/de/admin/members.php -> Variable "success" hinzugefügt
+ /admin/lock.php -> Anpassung an PHP < 7.4 
+ /admin/template-installer -> überprüfung, ob Datei geladen wurde
+ /admin/update.php
  -> Standart-FTPport auf 21 geändert
  -> Curl - SSL angepasst für PHP > 7.4
+ /admin/templates-installer.php
  -> Curl - SSL angepasst für PHP > 7.4
  -> Bildvorschau für SSL-Benutzer gefixt ( SSL / NON-SSL möglich )
+ /admin/settings.php -> Auswahl für Forum-Doppelpost hinzugefügt
+ /language/de/admin/settings.php
  -> Sprachelemente für Forum hinzugefügt
+ /modules/profil.php
  -> Variablencheck für nicht existierte User eingefügt
+ /admin/spam.php -> Escapeschutz
+ /system/login.php -> Escapeschutz
+ /rewrite.php -> Escapeschutz
+ Änderung des Copyrights zwecks ständiger Fehler in allen Dateien ( ca. 310 Dateien )
+ /components/ckeditor/config.js < p > code wieder akitivert für blockquote
+ /admin/settings_module -> entfernt und in den Plugin-Manager integriert (alle Plugins angepasst)
+ /admin/settings_games -> neue Game Pic's
+ Passwort im Updater ausblenden

WICHTIG NACH DEM UPDATE:
+ Forum muss geupdated werden !!
+ Neues Forumplugin mit Votesystem + Bedanksystem ( Beta )

### WEBSPELL | RM - Release: 2.0.2 (05.01.2020)
---------------------------------------------------------------------
+ Viele Bugfixes gefixt
+ Update von webSPELL.org / Webspell-NOR auf Webspell-RM im Installer eingebaut
+ Neuer Updater (hier werden in Zukunft Updates und Fixes hochgeladen)
+ Neue Plugins
+ Impressum und Datenschutz jetzt in der Base
+ Admincenter ab sofort Bootstrap 4
+ Neue Sprache: italienisch
+ Neues SEO System
- Plugin Impressum / Datenschutz entfernt, da fest im System implementiert
+ /admin/plugin-installer.php
+ /admin/admincenter.php -> Anpassung der CSS includes
+ /admin/settings_modul.php -> Variablenfehler behoben
+ /components/admin/js/jquery.min.331.js (localer load, sonst https error )
+ /components/admin/js/jquery.min.js -> Mapextension entfernt
+ /components/admin/css/fonts.css ( localer load, sonst https error )
+ /components/admin/css/bootstrap.min.css -> Mapsource entfernt
+ /system/content.php -> Rechtevergabe von Avatar und Userpics, reg. Problem  behoben 
+ /system/func/useraccess.php -> Fehlende Rechte für die Admin-Navigation behoben
+ Plugin Database aktualisiert


Anpassungen nach der Install:
---------------------------------------------------------------------
Datei: /includes/themes/DEINTHEME/index.php 
- widgets_hide () über dem  /head  entfernen

Admincenter -> Systemverwaltung -> Impressum / Datenschutz einstellen !


*************************************************************************************
**** Herzlichen Dank an die komplette RM-Community für das testen des Scriptes  *****
*************************************************************************************

~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~