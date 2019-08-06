<?php
/*¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯\
| _    _  ___  ___  ___  ___  ___  __    __      ___   __  __       |
|( \/\/ )(  _)(  ,)/ __)(  ,\(  _)(  )  (  )    (  ,) (  \/  )      |
| \    /  ) _) ) ,\\__ \ ) _/ ) _) )(__  )(__    )  \  )    (       |
|  \/\/  (___)(___/(___/(_)  (___)(____)(____)  (_)\_)(_/\/\_)      |
|                       ___          ___                            |
|                      |__ \        / _ \                           |
|                         ) |      | | | |                          |
|                        / /       | | | |                          |
|                       / /_   _   | |_| |                          |
|                      |____| (_)   \___/                           |
\___________________________________________________________________/
/                                                                   \
|        Copyright 2005-2018 by webspell.org / webspell.info        |
|        Copyright 2018-2019 by webspell-rm.de                      |
|                                                                   |
|        - Script runs under the GNU GENERAL PUBLIC LICENCE         |
|        - It's NOT allowed to remove this copyright-tag            |
|        - http://www.fsf.org/licensing/licenses/gpl.html           |
|                                                                   |
|               Code based on WebSPELL Clanpackage                  |
|                 (Michael Gruber - webspell.at)                    |
\___________________________________________________________________/
/                                                                   \
|                     WEBSPELL RM Version 2.0                       |
|           For Support, Mods and the Full Script visit             |
|                       webspell-rm.de                              |
\__________________________________________________________________*/

$language_array = array(

/* do not edit above this line */

    'about_myself' => 'Über mich',
    'activated' => 'aktiviert',
    'avatar' => 'Avatar:',
    'back' => 'zurück',
    'bbcode' => '<a href="javascript:void(0);" onclick="window.open(\'code.php\',\'BBCode\',\'scrollbars=yes,width=600,height=500\')">BBCode</a> ist AN',
    'can_not_copy' => 'Datei kann nicht vom Server kopiert werden.',
    'change_mail' => 'E-Mail ändern',
    'change_password' => 'Passwort ändern',
    'country' => 'Land',
    'cpu'=>'Prozessor',
    'date_of_birth' => 'Geburtsdatum',
    'deactivated' => 'deaktiviert',
    'delete' => 'entfernen',
    'e-mail'=>'E-Mail',
    'edit_mail' => 'E-Mail editieren',
    'edit_password' => 'Passwort editieren',
    'equipment-info' => 'Ausrüstungsinformationen',
    'errors_there' => 'Es sind Fehler aufgetreten',
    'female' => 'weiblich',
    'fields_star_required' => ' Pflichtfelder',
    'first_name' => 'Vorname',
    'forgot_new_pw' => 'Du hast vergessen ein neues Passwort anzugeben!',
    'forgot_old_pw' => 'Du hast vergessen dein altes Passwort anzugeben!',
    'format_date' => 'Datumsformat',
    'format_time' => 'Zeitformat',
    'hide_e-mail' => 'E-Mail verstecken?',
    'homepage' => 'Webseite',
    'html' => 'HTML ist AUS',
    'invalid_mail' => 'Du hast eine ungültige Mailadresse angegeben.',
    'invalid_picture-format' => 'nicht erlaubtes Bildformat (erlaubt: *.gif, *.jpg oder *.png)',
    'image_too_big'=>'Das Bild ist zu groß',
    'language' => 'Sprache',
    'last_name' => 'Nachname',
    'mail_changed' => '<blockquote>Deine Mailadresse wurde geändert. Du erhälst in Kürze eine Aktivierungsmail. Bis zur Freischaltung ist die alte Mailadresse aktiv.</blockquote>',
    'mail_failed' => 'Die Aktivierungsmail konnte nicht versandt werden. Bitte informiere den Webmaster darüber.',
    'mail_not_valid' => 'Die E-Mail - Wiederholung ist ungültig!',
    'mail_on_new_pm' => 'Bei neuer PN E-Mail senden?',
    'mail_subject' => 'E-Mail Aktivierung für %homepage_url%',
    'mail_text' => 'Hallo %nickname%!
<p>Du hast deine bei %pagetitle% (%homepage_url%) hinterlegte Email-Adresse geändert.</p>
<p>Um die Änderung zu bestätigen bitte folgende Adresse besuchen:</p>
<p>%activationlink%</p>
<p>Vielen Dank für dein Interesse</p>
%pagetitle% - %homepage_url%',
    'male' => 'männlich',
    'my_profile' => 'Mein Profil',
    'new_email' => 'neue E-Mail',
    'new_password' => 'neues Passwort',
    'newsletter' => 'Newsletter erhalten?',
    'nickname' => 'Nickname',
    'nickname_already_in_use' => 'Nickname wird bereits benutzt!',
    'no' => 'Nein',
    'not_logged_in' => '<br><blockquote>Du musst angemeldet sein um dein Profil ändern zu können!<br><br>
    &#8226; <a href="index.php?site=register">registrieren</a><br>
    &#8226; <a href="index.php?site=login">anmelden</a></blockquote>',
    'old_password' => 'altes Passwort',
    'old_pw_not_valid' => 'Dein altes Passwort ist falsch!',
    'options' => 'Optionen',
    'or' => 'oder',
    'password' => 'Passwort',
    'personal_info' => 'Persönliche Informationen',
    'picture_too_big_avatar' => 'Bild ist zu groß, maximal 90/90 Pixel',
    'picture_too_big_userpic' => 'Bild ist zu groß, maximal 230/210 Pixel',
    'profile_info' => 'Profilinformationen',
    'profile_updated' => '<blockquote>Dein Profil wurde aktualisiert. Du wirst weitergeleitet!</blockquote>',
    'pw_changed' => '<blockquote>Dein Passwort wurde geändert. Du musst dich neu anmelden.</blockquote>',
    'ram' => 'RAM',
    'repeat_new_email' => 'E-Mail Wiederholung',
    'repeat_new_password' => 'neues Passwort wiederholen',
    'repeated_pw_not_valid' => 'Deine Passwortwiederholung stimmt nicht!',
    'repeated_mail_not_valid'=>'Ihre wiederholte E-Mail ist nicht gleich!',
    'sexuality' => 'Geschlecht',
    'signature' => 'Signatur',
    'smilies' => '<a href="javascript:void(0);" onclick="window.open(\'smileys.php\',\'Smileys\',\'scrollbars=yes,width=340,height=500\')">Smilies</a> sind AN',
    'town' => 'Stadt',
    'unknown' => 'keine Angabe',
    'update_profile' => 'Profil aktualisieren',
    'upload_failed' => 'Upload fehlgeschlagen!',
    'username' => 'Benutzername',
    'username_aleady_in_use' => 'Benutzername wird bereits benutzt!',
    'userpic' => 'Benutzerbild:',
    'yes' => 'Ja',
    'you_have_to_bday' => 'Du musst dein Geburtsdatum korrekt angeben!',
    'you_have_to_email' => 'Du musst eine E-Mail Adresse angeben!',
    'you_have_to_firstname' => 'Du musst deinen Vornamen angeben!',
    'you_have_to_nickname' => 'Du musst einen Nickname angeben!',
    'you_have_to_username' => 'Du musst einen Benutzernamen angeben!',
    'you_have_to_valid_email' => 'Die E-Mail Adresse ist nicht korrekt!',
    'wrong_password'=>'Falsches Passwort',
    'twitch' => 'Twitch',
    'youtube' => 'Youtube',
    'twitter' => 'Twitter',
    'instagram' => 'Instagram',
    'facebook' => 'Facebook',
    'social_media' => 'Social Media',
    'del_acc'=>'Account löschen',
    'acc_deletet'=>'<blockquote>Dein Account wurde erfolgreich unwiderruflich gelöscht!</blockquote>',
    'del_realy'=>'Willst du wirklich deinen Account löschen? Gib dein Passwort ein!',
    'hint'  =>  'Hinweis: ',
    'privacy_policy' => 'Datenschutz-Bestimmungen',
    'GDPRinfo' => 'Durch das aktualisieren Deines Profils und die Eingabe Deiner <u>freiwilligen</u> personenbezogenen Daten, akzeptierst Du, dass diese Daten in unserer Datenbank dauerhaft gespreichert werden dürfen. Du kannst diese Daten jederzeit wieder ändern, entfernen oder berichtigen. Optional hast Du auch die Möglichkeit, Dein Profil vollständig zu löschen.',
    'GDPRaccept' => 'Du musst die Speicherung Deiner personenbezogenen Daten aktzeptieren.'
);

