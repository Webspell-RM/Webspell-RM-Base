# Webspell V2.0 - Release: 2.0.2 (05.01.2020)
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
-> <?php widgets_hide (); ?> über dem < /head > entfernen

Admincenter -> Systemverwaltung -> Impressum / Datenschutz einstellen !


*************************************************************************************
**** Herzlichen Dank an die komplette RM-Community für das testen des Scriptes  *****
*************************************************************************************

~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
