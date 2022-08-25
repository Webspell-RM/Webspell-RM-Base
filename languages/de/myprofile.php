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

    'about_myself' => 'Über mich',
    'acc_deletet'=>'<blockquote>Dein Account wurde erfolgreich unwiderruflich gelöscht!</blockquote>',
    'activated' => 'aktiviert',
    'avatar' => 'Avatar:',
    'back' => 'zurück',
    'can_not_copy' => 'Datei kann nicht vom Server kopiert werden.',
    'change_mail' => 'E-Mail ändern',
    'change_password' => 'Passwort ändern',
    'country' => 'Land',
    'cpu'=>'Prozessor',
    'date_of_birth' => 'Geburtsdatum',
    'deactivated' => 'deaktiviert',
    'del_acc'=>'Account löschen',
    'del_realy'=>'Willst du wirklich deinen Account löschen? Gib dein Passwort ein!',
    'delete' => 'entfernen',
    'diverse' => 'divers',
    'edit_mail' => 'E-Mail editieren',
    'edit_password' => 'Passwort editieren',
    'e-mail'=>'E-Mail',
    'equipment-info' => 'Ausrüstungsinformationen',
    'errors_there' => 'Es sind Fehler aufgetreten',
    'facebook' => 'Facebook',
    'female' => 'weiblich',
    'fields_star_required' => ' Pflichtfelder',
    'first_name' => 'Vorname',
    'forgot_new_pw' => 'Du hast vergessen ein neues Passwort anzugeben!',
    'forgot_old_pw' => 'Du hast vergessen dein altes Passwort anzugeben!',
    'format_date' => 'Datumsformat',
    'format_time' => 'Zeitformat',
    'game_selection' =>'Mehrfachauswahl möglich',
    'games' => 'Games',
    'GDPRaccept' => 'Du musst die Speicherung Deiner personenbezogenen Daten aktzeptieren.',
    'GDPRinfo' => 'Durch das aktualisieren Deines Profils und die Eingabe Deiner <u>freiwilligen</u> personenbezogenen Daten, akzeptierst Du, dass diese Daten in unserer Datenbank dauerhaft gespeichert werden dürfen. Du kannst diese Daten jederzeit wieder ändern, entfernen oder berichtigen. Optional hast Du auch die Möglichkeit, Dein Profil vollständig zu löschen.',
    'hide_e-mail' => 'E-Mail verstecken?',
    'hint'  =>  'Hinweis: ',
    'homepage' => 'Webseite',
    'html' => 'HTML ist AUS',
    'image_too_big'=>'Das Bild ist zu groß',
    'instagram' => 'Instagram',
    'invalid_mail' => 'Du hast eine ungültige Mailadresse angegeben.',
    'invalid_picture-format' => 'nicht erlaubtes Bildformat (erlaubt: *.gif, *.jpg oder *.png)',
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
    'privacy_policy' => 'Datenschutz-Bestimmungen',
    'profile_info' => 'Profilinformationen',
    'profile_updated' => '<blockquote>Dein Profil wurde aktualisiert. Du wirst weitergeleitet!</blockquote>',
    'pw_changed' => '<blockquote>Dein Passwort wurde geändert. Du musst dich neu anmelden.</blockquote>',
    'ram' => 'RAM',
    'repeat_new_email' => 'E-Mail Wiederholung',
    'repeat_new_password' => 'neues Passwort wiederholen',
    'repeated_mail_not_valid'=>'Ihre wiederholte E-Mail ist nicht gleich!',
    'repeated_pw_not_valid' => 'Deine Passwortwiederholung stimmt nicht!',
    'gender' => 'Geschlecht',
    'select_gender' => 'wähle dein Geschlecht aus',
    'signature' => 'Signatur',
    'smilies' => '<a href="javascript:void(0);" onclick="window.open(\'smileys.php\',\'Smileys\',\'scrollbars=yes,width=340,height=500\')">Smilies</a> sind AN',
    'social_media' => 'Social Media',
    'steam' => 'Steam',
    'town' => 'Stadt',
    'twitch' => 'Twitch',
    'twitter' => 'Twitter',
    'unknown' => 'keine Angabe',
    'update_profile' => 'Profil aktualisieren',
    'upload_failed' => 'Upload fehlgeschlagen!',
    'username' => 'Benutzername',
    'username_aleady_in_use' => 'Benutzername wird bereits benutzt!',
    'userpic' => 'Benutzerbild:',
    'wrong_password'=>'Falsches Passwort',
    'yes' => 'Ja',
    'you_have_to_bday' => 'Du musst dein Geburtsdatum korrekt angeben!',
    'you_have_to_email' => 'Du musst eine E-Mail Adresse angeben!',
    'you_have_to_firstname' => 'Du musst deinen Vornamen angeben!',
    'you_have_to_nickname' => 'Du musst einen Nickname angeben!',
    'you_have_to_username' => 'Du musst einen Benutzernamen angeben!',
    'you_have_to_valid_email' => 'Die E-Mail Adresse ist nicht korrekt!',
    'youtube' => 'Youtube'

);

