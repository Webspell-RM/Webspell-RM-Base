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

  
  'tooltip_1'=>'Dies ist die URL der Seite, z.B. (deinedomain.de/pfad/webspell).<br>Mit http:// oder https:// am Anfang und nicht mit Slash enden!',
  'tooltip_2'=>'Das ist der Titel der Seite, wird auch als Browser Titel angezeigt',
  'tooltip_3'=>'Der Name der Organisation',
  'tooltip_4'=>'Das Kürzel der Organisation',
  'tooltip_5'=>'Dein Name',
  'tooltip_6'=>'Die E-Mail Adresse des Webmasters',
  'tooltip_7'=>'Maximale Neuigkeiten, welche komplett angezeigt werden',
  'tooltip_8'=>'Forumthemen pro Seite',
  'tooltip_9'=>'Bilder pro Seite',
  'tooltip_10'=>'Neuigkeiten im Archiv pro Seite',
  'tooltip_11'=>'Forumbeiträge pro Seite',
  'tooltip_12'=>'Größe (Breite) für Galerie Vorschaubilder',
  'tooltip_13'=>'Letzte Neuigkeiten aufgelistet in sc_headlines',
  'tooltip_14'=>'Forumthemen aufgelistet in latesttopics',
  'tooltip_15'=>'Speicherplatz für Benutzer-Galerien pro Benutzer in MByte',
  'tooltip_16'=>'Maximale Länge für die letzten Neuigkeiten in sc_headlines',
  'tooltip_17'=>'Minimale Länge von Suchbegriffen',
  'tooltip_18'=>'Möchtest du Benutzer-Galerien für jeden Benutzer erlauben?',
  'tooltip_19'=>'Möchtest du Galerie Bilder direkt auf deiner Page administrieren? (besser ausgewählt lassen)',
  'tooltip_20'=>'Artikel pro Seite',
  'tooltip_21'=>'Auszeichnungen pro Seite',
  'tooltip_22'=>'Artikel aufgelistet in sc_articles',
  'tooltip_23'=>'Demos pro Seite',
  'tooltip_24'=>'Maximale Länge der aufgelisteten Artikel in sc_articles',
  'tooltip_25'=>'Gästebucheinträge pro Seite',
  'tooltip_26'=>'Kommentare pro Seite',
  'tooltip_27'=>'Private Nachrichten pro Seite',
  'tooltip_28'=>'Clanwars pro Seite',
  'tooltip_29'=>'Registrierte Benutzer pro Seite',
  'tooltip_30'=>'Resultate aufgelistet in sc_results',
  'tooltip_31'=>'Letzte Beiträge aufgelistet im Profil',
  'tooltip_32'=>'Geplante Einträge aufgelistet in sc_upcoming',
  'tooltip_33'=>'Anmeldungsdauer [in Stunden] (0 = 20 Minuten)',
  'tooltip_34'=>'Maximale Größe (Breite) für den Inhalt (Bilder, Textfelder usw.) (0 = deaktiviert)',
  'tooltip_35'=>'Maximale Größe (Höhe) für Bilder (0 = deaktiviert)',
  'tooltip_36'=>'Sollen Feedback-Admins eine Nachricht bei einem neuen Gästebuch Eintrag bekommen?',
  'tooltip_37'=>'Shoutboxkommentare, welche in der Shoutbox angezeigt werden',
  'tooltip_38'=>'Maximal gespeicherte Kommentare in der Shoutbox',
  'tooltip_39'=>'Dauer (in Sekunden) für das Nachladen der Shoutbox',
  'tooltip_40'=>'Standardsprache für die Seite',
  'tooltip_41'=>'Sollen die Links zu den Member Profilen automatisch gesetzt werden?',
  'tooltip_42'=>'Maximale Länge für die letzten Themen in latesttopics',
  'tooltip_43'=>'Maximale Anzahl falscher Password Eingaben vor IP Ban',
  'tooltip_44'=>'Anzeigeart des Captchas',
  'tooltip_45'=>'Hintergrundfarbe des Captchas',
  'tooltip_46'=>'Schriftfarbe des Captchas',
  'tooltip_47'=>'Art des Captchas',
  'tooltip_48'=>'Anzahl der Störungen',
  'tooltip_49'=>'Anzahl der Störungslinien',
  'tooltip_50'=>'Auswahl der automatischen Inhaltsgrößenanpassung',
  'tooltip_51'=>'Maximale Länge für die Top Neuigkeiten in sc_topnews',
  'tooltip_52'=>'Sprache des Besuchers automatisch erkennen',
  'tooltip_53'=>'Beiträge mit externer Datenbank validieren',
  'tooltip_54'=>'Tragen Sie hier ihren Spam API-Schlüssel ein wenn vorhanden',
  'tooltip_55'=>'Tragen Sie hier die URL zum API Host Server ein.<br>Standard: https://api.webspell.org',
  'tooltip_56'=>'Anzahl Beiträge ab wann nicht mehr mit externer Datenbank validiert wird',
  'tooltip_57'=>'Sollen die Beiträge bei einem Fehler blockiert werden?',
  'tooltip_58'=>'Ausgabeformat des Datums',
  'tooltip_59'=>'Ausgabeformat der Zeit',
  'tooltip_60'=>'Benutzer Gästebücher auf der Seite aktivieren?',
  'tooltip_61'=>'Was soll das SC Demos Modul anzeigen?',
  'tooltip_62'=>'Was soll das SC Dateien Modul anzeigen?',
  'tooltip_63'=>'Registrierung mit gleicher IP Adresse blockieren?',
  'tooltip_64'=>'Der Name deiner Startseite',
  'tooltip_65'=>'Keine Doppelpost im Forum erlaubt ?',
  'tooltip_66'=>'Deutsche Sprachauswahl in der Navigation ein/ausblenden',
  'tooltip_67'=>'Englische Sprachauswahl in der Navigation ein/ausblenden',
  'tooltip_68'=>'Italienische Sprachauswahl in der Navigation ein/ausblenden',
  'tooltip_69'=>'Polnische Sprachauswahl in der Navigation ein/ausblenden',

/*allgemeine einstellung*/
    'access_denied'=>'<h3>Info</h3><div class="alert alert-danger"><span class="sr-only">Error:</span><strong>Zugriff verweigert</strong></div>',
    'info'=>'<div class="alert alert-warning" role="alert">Hier steht dann eine Beschreibung</div>',
    'updated_successfully'=>'<div class="col-md-12"><div class="alert alert-success" role="alert">Erfolgreich aktualisiert.</div></div>',
    'transaction_invalid' => '<div class="alert alert-danger" role="alert">Transaktions ID ungültig.</div>',
    'update'=>'aktualisieren',



/*===================================================================*/
/*Einstellungen */
  'settings'=>'Einstellungen',
  'additional_options_startpage'=>'Frontend (Website) deaktivieren und Startpage wählen',
  'page_title'=>'Homepage Titel',
  'page_url'=>'Homepage URL',
  'admin_email'=>'Admin E-Mail',
  'admin_name'=>'Admin Name',
  'clan_name'=>'Clan Name',
  'clan_tag'=>'Clan Tag',

/*Frontend (Website) deaktivieren und Startpage wählen */
  'additional_options'=>'Website deaktivieren',
  'pagelock'=>'Seite sperren',
  'startpage' => 'Startseite wählen',
  
 
  /*Google reCaptcha */
  'reCaptcha'=>'Google reCaptcha',
  'important_text' => 'Bevor Du diese Modifikation aktivierst benötigst Du die reCaptcha APi-Keys. <br />Dazu gehe wiefolgt vor.<br /><br />1. <a href="https://www.google.com/recaptcha/intro/index.html" target="_blank">reCaptcha Account</a> anlegen. <br />2. Deine Internetadresse angeben. <br /> 3. reCAPTCHA-Typ: <b>V2</b> (Kästchen) auswählen <br /> 4. Die Zwei erhaltenen Schlüssel hier eintragen.',
  'activate' => 'Aktiviert',
  'web-key' => 'Webseiten-Schl&uuml;ssel',
  'secret-key' => 'Geheimer-Schl&uuml;ssel',
  'success' => '<div class="col-md-12"><div class="alert alert-success" role="alert">reCaptcha Account erfolgreich aktualisiert.</div></div>',
  'failed' => '<div class="col-md-12"><div class="alert alert-danger" role="alert">reCaptcha Account Vorgang fehlgeschlagen.</div></div>',
  
/*captcha*/
  'captcha'=>'Captcha',
  'captcha_autodetect'=>'automatisch',
  'captcha_bgcol'=>'Hintergrundfarbe',
  'captcha_both'=>'beides',
  'captcha_fontcol'=>'Schriftfarbe',
  'captcha_image'=>'Bild',
  'captcha_linenoise'=>'Linien Störung',
  'captcha_noise'=>'Störung',
  'captcha_only_math'=>'nur Mathe',
  'captcha_only_text'=>'nur Text',
  'captcha_text'=>'Text',
  'captcha_type'=>'Captcha Typ',
  'captcha_style'=>'Captcha Stil',

  /*Sonstiges */
  'other'=>'Sonstiges',
  'format_date'=>'Datumsformat',
  'format_time'=>'Zeitformat',
  'language_navi'=>'Sprachauswahl in der Navigation ein/ausblenden',
  'de_language' => 'deutsch',
  'en_language' => 'englisch',
  'it_language' => 'italienisch',
  'pl_language' => 'polnisch',

  'login_duration'=>'Anmeldungsdauer',
  'register_per_ip'=>'Registrierung mit gleicher IP?',
  'search_min_length'=>'min. Länge der Suche',
  'profile_last_posts'=>'letzte Beiträge im Profil',
  'default_language'=>'Standardsprache',

  'detect_visitor_language'=>'Besuchersprache erkennen?',
  'max_wrong_pw'=>'max. falsche Passwörter',
  'forum_double'=>'Forum - Keine Doppelpost',
/*===================================================================*/
  /*social settings*/
  'social_settings'=>'Social Media Einstellungen',
  'title_social_media'=>'Einstellungen',

/*===================================================================*/
  /*plugin settings*/
  'plugin_settings'=>'Plugin Einstellungen',
  /*joinus*/
  'title_join_us'=>'Join us',
  'admin_info'=>'Alle Squads anzeigen<br><small>(aktive und inaktive Teams)</small>',
  'terms_of_use'=>'Akzeptieren der Clan-Regeln',
  /*members*/
  'title_members' => 'Mitglieder',
  'max_registered_members'=>'Mitglieder pro Seite',
  'tooltip_members'=>'Mitglieder pro Seite',
  /*userlist*/
  'title_userlist' => 'Registrierte Benutzer',
  'max_registered_userslist'=>'Reg. Benutzer pro Seite',
  'tooltip_userlist'=>'Registrierte Benutzer pro Seite',

  /*useronline*/
  'title_useronline' => 'Benutzer online',
  'max_registered_useronline'=>'Benutzer pro Seite',
  'tooltip_useronline'=>'Benutzer pro Seite',

  /*facebook*/
  'title_facebook'=>'Facebook',
  'fb1_activ' => 'Darstellung 1',
  'fb2_activ' => 'Darstellung 2',
  'fb3_activ' => 'Darstellung 3',
  'fb4_activ' => 'Darstellung 4',

    
    

);