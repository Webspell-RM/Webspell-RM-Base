### WEBSPELL | RM - Release: 2.1.4 (23.03.2024)
---------------------------------------------------------------------

+ Webspell-RM 2.1.4                 -> miteinem eigenen Installer. So kann man eine frische Installation aufsetzten.
                                    -> auch besteht die Möglichkeit seine installierte 2.1.3 Ver. auf die Ver. 2.1.4 upzudaten.

+ /admin/update.php                 -> Neu erstellt und es werden keine FTP Daten mehr benötigt.
+ /admin/plugin_installer.php       -> Fehler bei verschiedenen Versionen bereinigt. Global zentralisieren 
+ /admin/template_installer.php     -> Fehler bei verschiedenen Versionen bereinigt. Global zentralisieren 
+ /admin/plugin_manager.php         -> Ausgliederung von einigen Bereichen
                                    -> Side-Widgets können jetzt gleichzeitig rechts und links positioniert werden

+ /admin/settings_headelements      -> Designanpassungen vorgenommen (Ohne Bild wird eine Art Überschrift erstellt)

+ ModRewrite                        -> ModRewrite wurde für weitere Plugins erweitert

+ Neue Cookies-Abfrage              -> Die neue Cookies Abfrage wurde neu und modern gestaltet.
                                    -> Man kann jetzt bei Ablehnung verhindert das Drittanbieter Cookies gesetzt werden

+ Neue angepasste Navigation        -> Die Navigation (default) wurde angepasst und kann jetzt als normale und Sticky Navigation verwendet werden.
                                    -> Auch wurde eine neue Rubrik SOCIAL implantiert. Hier findet man alle Social Plugins

+ angepasster Login, Registrierung  -> Wurde an Bootstrap angepasst

+ neues Design Profil und myprofile  -> Wurde neu gestaltet und an Bootstrap angepasst.

+ Squad.Plugin                      -> Squad wurde ausgelagert und kann mit dem Squad-Plugin neu oder nachinstalliert werden.

+ Game_Pic-Plugin                   -> Game Pic wurden ausgelagert und kann mit dem Game-Pic-Plugin neu oder nachinstalliert werden.

+ - Webspell RM Icon Umstellung     -> Font Awesome wurde entfernt
                                    -> Bootstrap Icon ersetzt jetzt Font Awesome

- /modules/loginoverview.php        -> Alle zugehörigen Dateien wurden entfernt. Es gibt nur noch die /modules/profil.php. Hier wurden alle 
                                       nötigen Infos der loginoverview.php implantiert.

- /admin/welcome_page.php           -> neue Begrüßungsseite (wurde wieder entfernt)

+ - Languages                       -> Für die RM-Base wurden alle DE | EN | IT languages Dateien angepasst und vervollständigt
                                    -> Language Polnisch wurde vollständig entfernt

+ RM-Base                           -> Responsive angepasst. Die Webseite wird auf dem Handy richtig angezeigt

+ Pluginanpassungen                 -> Es wurden zahlreiche Plugins responsive angepasst. So wird die Webseite auf dem Handy richtig angezeigt
                                    -> Einige Plugins wurden zusammengelegt

+ Admincenter                       -> Es wurde responsive angepasst mit einer Navigation.

Zusammengefügte Plugins
Carousel                            -> Carousel Only (mit Video), Parallax Header(altes Plugin Parallax Header) , Sticky Header (Sticky Navigation) 
Userlist                            -> Widgets Last Registered, User Online
Userrights                          -> fest im Admincenter (Benutzer Verwaltung)
Servers                             -> Widget Servers, Widget Gametracker TS, Widget Gametracker Server

Neue Social Plugins
+ Facebook                          -> erweitert
+ Instagram                         -> neu
+ Twitter                           -> neu
+ Reddit                            -> neu
+ TikTok                            -> neu
+ RSS                               -> neu

Plugins die nicht mehr als eigenständige Plugins zur Verfügung stehen
- Parallax Plugin                   -> nicht mehr verfügbar
- Sticky Plugin                     -> nicht mehr verfügbar
- Gametracker TS Plugin             -> nicht mehr verfügbar
- Gametracker Server Plugin         -> nicht mehr verfügbar
- Userrights Plugin                 -> nicht mehr verfügbar
- Last Registered Plugin            -> nicht mehr verfügbar
- User Online Plugin                -> nicht mehr verfügbar


### WEBSPELL | RM - Release: 2.1.3 (06.08.2023)
---------------------------------------------------------------------
+ /Umbau der Plugin und Widget Konfiguration (vereinfachte install/update Datei, Zuordnung)
+ /admin/plugin_manager.php         -> Widgets positionieren (früher im Widget-Manager und Modul-Einstellung)
                                    -> Plugin aktivieren für das aktive Templete (früher im Modul-Einstellung) 
                                    -> bei Pluginfehler direktes neu Install möglich
                                    -> Widget Bereichseinstellung vordefiniert (settings_select_widget.php)
                                    -> es kann jetzt nur noch eine Navigation aktiviert werden
                                    -> Widget css / js werden erst bei der Zuweisung geladen 

+ /admin/settings_widgets.php       -> Sotierung der Widgets für die index,
                                    -> es ist nur noch die Sortierung der Widgets möglich

+ /admin/settings_templates.php     -> Farbeinstellung für das Template angepasst und verknüpft mit Bootstrap, 
                                    -> Hintergrundgrafik hochladbar
                                    -> 10 verschiedene Überschriften stehen zur Wahl
                                    -> einige Anpassungen durchgeführt
                                    -> Löschfunktion
                                    -> Pfadname muss separat angegeben werden (getroffene Seiten angepasst) 

+ /includes/modules/navigation.php  -> es erscheint keine Kategorie / Link in der Navigation, wenn das Plugin für das Template nicht aktiviert wurde

+ /admin/settings_startpage.php     -> Editor ein und ausschaltbar

+ /admin/settings_static.php        -> Editor ein und ausschaltbar

+ /admin/welcome_page.php           -> neue Begrüssungsseite (in Allgemeine Einstellungen / Startseite wählen)

+ user -> usertext (signature)      -> von varchar(255) in text geändert. Langer Text jetzt möglich

+ /includes/modules/profile.php     -> Spezialrank hinzugefügt
                                    -> Discord hinzugefügt
                                    -> Bug in der Statistik entfernt
                                    -> nicht ausgefüllte Felder werden ausgeblendet

+ /includes/modules/myprofile.php   -> Avatar und Userpic auf 480x480 vergrößert                                   

- /admin/settings_modules.php       -> gelöscht (in den Plugin-Manager implantiert)

+ /admin/plugin_installer.php       -> automatische Auswahl Alpha-Beta Server zum download
                                    -> Design angepasst

+ /admin/template_installer.php     -> automatische Auswahl Alpha-Beta Server zum download
                                    -> Design angepasst

+ /admin/update.php                 -> automatische Auswahl Alpha-Beta Server zum download

+ /admin/settings_headelements      -> Designanpassungen vorgenommen (/system/content.php)
                                    -> jedes Element ein und ausschaltbar
                                    -> Infotext hinzugefügt
                                    -> Seiten in einem form-select vorgegeben

+ /lock.php                         -> neues Design
                                    -> Die Seite befindet sich im Wartungsmodus. Wird auf der Seite für die Admins angezeigt, wenn die Seite gesperrt wurde

+ /system/func/tags.php             -> Systemfehler bereinigt. Tags für News, Articles, Static und FAQ möglich.

+ Plugin-Name wurde geändert        -> (News -> News_manager, nletter -> newsletter)
+ /system/plugin.php                -> jetzt kann man auch Widgets direkt in die index.php einbinden (zB: get_widget('about_us','plugin_widget1');)

+ Komplettes Admincenter auf die Bootstrap 5 Ver. angepasst
+ Kompatibel mit PHP 8.2
+ Login, Register und Lostpassword  -> Neues Design
+ alle Templates wurden durch die Änderung in der settings_templates.php angepasst
+ Das Problem mit abgeschnittenen Texten bei einer Formatierung wurde behoben.


Pluginänderungen:
Alle Plugins:       Sind kompatibel mit der neuen Überschriftseinstellung und wurden im Dashbord in der Navi neu sortiert
Forum:              Spezialrank hinzugefügt, Umfrageanzeige angepasst
Candidature:        Änderung der Eingabefelder
Joinus:             Änderung der Eingabefelder
Newsletter Widget:  Text hinzugefügt
News:               Darstellungsfehler bei re-comment beseitigt, ein Weiteres Plugin
News Headlines:     Datumsdarstellung angepasst
Streams:            Generelle Darstellung angepasst 
Textslider:         Angepasst mit Hintergrundgrafik
Fact:               Hintergrundgrafik und Code angepasst
Ticketcenter:       Linkfehler bereinigt
Portfolio:          Pic automatische Anpassung, Zufallssortierung
Clan-Kasse:         Info Ausgabe wurde hinzugefügt
Navigation Agency:  Pic über Admincenter wechselbar
Useronline:         Die Zeit angepasst
Projectlist:        Um viele Punkte erweitert
Shoutbox Widget:    Angepasst und man bleibt auf der Seite nach dem posten seiner Nachricht. Nicht reg. user schreibrecht ja/nein einstellbar
Search:             Kein Suchergebnis bei deaktivierten Plugins
Quicksuche:         Durchsucht jetzt die ganze Webseite. Kein Suchergebnis bei deaktivierten Plugins
Userlist:           Widget Neueste Mitglieder / Reg.Datum (heute, gestern, Datum) 
Clanwar:            Fehler bereinigt. Design der Detailansicht geändert. Neu: Bisherige Begegnungen
Calender:           Widget-Veranstalltung hinzugefügt, Darstellungsfehler bereinigt, Design angepasst 
Blog:               Neues modernes Aussehen, Bild hochladbar, Anzahl der Beiträge auf der Blogstartseite im Dashbord einstellbar
FAQ:                Design überarbeitet
Squads:             Widget Squads_Roster angepasst, zwei verschiedene Ansichten auswählbar
Articles:           Hat jetzt eine Kommentarfunktion und ein Widget wurde hinzugefügt
Gallery:            Mit der Kommentarfunktion erweitert





### WEBSPELL | RM - Release: 2.1.2 (24.02.2023)
---------------------------------------------------------------------

+ /admin/update.php -> RM-Update jetzt mit PHP 8.1 und Zugang FTP / FTPS / SFTP möglich.


### WEBSPELL | RM - Release: 2.1.1 (25.08.2022)
---------------------------------------------------------------------

+ /admin/admincenter.php -> Fehlermeldung bei nicht vorhandenem Plugin bereinigt
+ /admin/info.php -> ausblenden der Plugin und Template felder wenn kein Update ansteht
+ /admin/settings_templates.php -> Fehler bereinigt beim erstellen eines eigenem Template
+ /includes/modules/register.php -> check homepage rausgenommen Design angepasst
+ /includes/modules/report.php -> tote Links melden
+ /includes/modules/loginoverview.php -> Fehler lastlogin bereiniget
+ /includes/modules/profile.php -> Fehler lastlogin bereiniget, alter /gender hinzugefügt
+ /includes/modules/myprofile.php -> Fehler lastlogin bereiniget, alter /gender hinzugefügt
+ /includes/modules/login.php -> Design angepasst
+ index.php Templates Design angepasst
+ /system/functions.php -> Fehler lastlogin bereiniget
+ /system/settings.php Fehlermeldung wird angezeigt

- /components/bootstrap/js/bootstrap.min.js -> gelöscht, fehler der Navigation in der Handyansicht
- /components/bootstrap/js/bootstrap.min.js.map -> gelöscht, fehler der Navigation in der Handyansicht

Neue Plugins und Theme stehen zur Verfügung:

Game-Server Plugin
Useraward Plugin

Watch Theme
Zay Theme


### WEBSPELL | RM - Release: 2.1.0 (08.05.2022)
---------------------------------------------------------------------

+ /admin/info.php -> Fehlermeldung: Update Server nicht gefunden
+ /admin/plugin_installer.php -> Fehlermeldung: Update Server nicht gefunden
+ /admin/template_installer.php -> Fehlermeldung: Update Server nicht gefunden
+ /admin/updater.php -> Fehlermeldung: Update Server nicht gefunden

+ /system/func/installer.php -> Fehlermeldung: Update Server nicht gefunden
+ /system/func/update_base.php -> Fehlermeldung: Update Server nicht gefunden


### WEBSPELL | RM - Release: 2.0.9 (12.03.2022)
---------------------------------------------------------------------

+ /includes/modules/register.php -> Passwort widerholen
+ /includes/themes/default/templates/register.html -> Passwort widerholen
+ /navigation_dashboard_links modulname=headelements -> Modulname geändert
+ /navigation_dashboard_links modulname=ac_contact -> verschoben in Systemverwaltung
+ /navigation_dashboard_links modulname=ac_email -> verschoben in Systemverwaltung
+ /admin/plugin_manager.php -> Moduleinstellung angepasst
+ /admin/database.php -> mysql updaten / downloaden / impotieren

Datenbanken geändert / Widget und Mobuleinstellung templetbezogen einstellbar.
+/- plugins
+/- settings_module
+/- plugins_widgets

Template Installer geändert / Template und Plugins templetbezogen installierbar.
+ /admin/plugin_installer.php
+ /admin/template_installer.php
+ /system/func/installer.php

### WEBSPELL | RM - Release: 2.0.8 (12.03.2022)
---------------------------------------------------------------------

+ /admin/update.php


### WEBSPELL | RM - Release: 2.0.7 (21.11.2021)
---------------------------------------------------------------------
Webspell-RM betreiben mit PHP 8.x
+ /system/functions.php
+ /system/version.php
+ /system/plugin.php
+ /system/widget.php
+ /system/func/spam.php
+ /admin/plugin-installer.php => re-update möglich
+ /includes/modules/navigation_login.php
+ /admin/plugin-installer.php -> ssl Probleme
+ /admin/template-installer.php -> ssl Probleme
+ /admin/update.php -> ssl Probleme
+ /admin/info.php -> ssl Probleme
+ /admin/settings_templates.php -> Logo Text editierbar
+ /admin/info.php -> offene Upadets von Plugins / Live Ticker (Wichtige Infos werden angezeigt)
+ /system/error.php -> Erroranzeige angepasst
+ /includes/modules/lock.php -> Design angepasst
+ /includes/modules/login.html -> Design angepasst
+ /includes/modules/lostpassword.html -> Design angepasst
+ /includes/modules/register.html -> Design angepasst
+ /includes/modules/contact.html -> Design angepasst
+ /includes/modules/imprint.html -> Beschreibung angepasst
+ /system/content.php -> Design für Login angepasst (volle Breite) 


### WEBSPELL | RM - Release: 2.0.6 (20.09.2021)
---------------------------------------------------------------------
+ /includes/themes/default/index.php -> neue Cookieabfrage (laden der style.css.php jetzt möglich)
+ /admin/admincenter.php -> neue Cookieabfrage
+ /admin/login.php -> neue Cookieabfrage
+ /system/functions.php -> neue Cookieabfrage
+ /loginoverview php/html/language -> Vorbereitung für die neue Galerie
+ /system/seo.php -> Vorbereitung für die neue Galerie
+ /includes/modules/profile.php -> Profil responsive
+ /includes/themes/default/templates/profile.html -> Profil responsive
+ /languages/ -> Verschiedene Sprachdaten angepasst
+ /admin/login.php -> 404 Seite bei deaktivierten Template
+ /includes/themes/404/css/page/index.php ->  404 Seite bei deaktivierten Template
+ /includes/themes/default/templates/navigation.html ->  Navigation Angepasst
+ /includes/navigation_default/widget_navigation_default.php ->  Navigation Angepasst
+ /includes/navigation_defaultcss/styles.css ->  Navigation Angepasst
+ /includes/modules/language.php ->  Navigation Angepasst
+ /admin/settings_themes.php -> neue Express Setting (mit wenigen Klicks das Aussehen der Webseite verändern)
+ /admin/settings_social_media.php -> Alle Social Links zentralisiert.
+ /includes/modules/module.php -> Modul Einstellung (Überblick und einstellung der Module)
+ /includes/modules/profile.php -> Profil Ansicht geändert (Squad und Game Screens Darstellung)
+ /includes/modules/myprofile.php -> Myprofil (Games die man spielt können ausgewählt werden)
+ /includes/admin/update.php -> Hinweis hinzugefügt (alle installierten Plugins vor dem updaten auf den neusten Stand bringen)
+ /includes/plugins/widget_navigation_default.php -> angepasst an die Express Settings Einstellung
+ /components/css/styles.css.php -> angepasst an die Express Settings Einstellung 
+ /system/seo.php -> angepasst


- /admin/login/loginform.php -> neue Cookieabfrage (gelöscht)
- /system/cookie.php -> neue Cookieabfrage (gelöscht)

+ Der CKEditor 4 wurde auf die Version v4.16.0 upgedatet.
  - Somit wurden 2 Sicherheitslücken XSS und ReDos geschlossen!!!
+ Personalisierte Avatar-Icons mittels PHP generieren lassen
  für Forum, Userlist, Whoisonline und Shoutbox.
+ Neuordnung der Dashboard Navigation 
+ Express Settings für das Template Design (mit drei Farben das Aussehen der Webseite ändern)



### WEBSPELL | RM - Release: 2.0.5 (17.02.2021)
---------------------------------------------------------------------
+ /includes/themes/default/index.php -> erweitert Head Section und Foot Section
+ /admin/plugin-manager.php -> erweitert Head Section und Foot Section 
+ /admin/plugin-widget.php -> Design angepasst, erweitert Head Section und Foot Section 
+ Datenbank widget und plugins -> erweitert Head Section und Foot Section
+ /system/content.php -> erweitert Head Section und Foot Section
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

Weitere folgen (noch in arbeit)
ckeditor für Admin und Puplic
-ckeditor
-system/ckeditor.php


Templates konform machen

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