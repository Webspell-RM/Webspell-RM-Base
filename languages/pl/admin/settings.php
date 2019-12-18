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

$language_array = Array(

/* do not edit above this line */

	'access_denied'=>'Odmowa dostępu',
	'activated'=>'aktywowany',
	'additional_options'=>'Opcje dodatkowe',
	'admin_email'=>'E-mail Administratora',
	'admin_name'=>'Nick Administratora',
	'allow_usergalleries'=>'Galerie użytkowników',
	'archive'=>'Archiwum',
	'articles'=>'Artykuły',
	'autoresize'=>'Funkcja zmiany rozmiaru obrazu',
	'autoresize_js'=>'JavaScript',
	'autoresize_off'=>'Wyłączona',
	'autoresize_php'=>'PHP',
	'awards'=>'Osiągnięć',
	'captcha'=>'Captcha',
	'captcha_autodetect'=>'Automatycznie',
	'captcha_bgcol'=>'Kolor tła',
	'captcha_both'=>'Obydwa style',
	'captcha_fontcol'=>'Kolor czcionki',
	'captcha_image'=>'Obrazek',
	'captcha_linenoise'=>'Linia rozpraszająca',
	'captcha_noise'=>'Rozproszenie',
	'captcha_only_math'=>'Tylko matematyczne',
	'captcha_only_text'=>'Tylko tekst',
	'captcha_text'=>'Tekst',
	'captcha_type'=>'Typ captcha',
	'captcha_style'=>'Styl captcha',
	'clan_name'=>'Nazwa klanu',
	'clan_tag'=>'Tag klanu',
	'clanwars'=>'Mecze',
	'comments'=>'Komentarzy',
	'content_size'=>'Rozmiar zawartości',
	'deactivated'=>'nieaktywny',
	'default_language'=>'Domyślny język',
	'demos'=>'Demek',
	'demos_top'=>'Top 5 Demek',
	'demos_latest'=>'Ostatnie 5 Demek',
	'detect_visitor_language'=>'Wykrj język odwidzających',												   
	'forum'=>'Forum',
	'forum_posts'=>'Postów',
	'forum_topics'=>'Tematów',
	'format_date'=>'Date format',
	'format_time'=>'Time format',
	'files'=>'Files',
	'files_top'=>'Top 5 Downloads',
	'files_latest'=>'Latest 5 Downloads',				   				   
	'gallery'=>'Galeria',
	'guestbook'=>'Księga Gości',
	'headlines'=>'Ostatnich aktualności',
	'insert_links'=>'Linki do profilu użytkownika',
	'latest_articles'=>'Ostanich artykułów',
	'latest_results'=>'Ostanich meczy',
	'latest_topics'=>'Ostanich tematów',
	'login_duration'=>'Czas trwania logowania',
	'max_length_headlines'=>'Długość ostatnich aktualności',
	'max_length_latest_articles'=>'Długość ostanich artykułów',
	'max_length_latest_topics'=>'Długość ostanich tematów',
	'max_length_topnews'=>'Długość gorącej aktualności',
	'max_wrong_pw'=>'Błędnych logowań',
	'messenger'=>'Wiadomości',
	'msg_on_gb_entry'=>'Wiadomość przy wpisie do Księgi Gości',
	'news'=>'Aktualności',
	'other'=>'Inne',
	'page_title'=>'Tytuł strony',
	'page_url'=>'URL strony',
	'pagelock'=>'Blokada strony',
	'pictures'=>'Obrazków',
	'profile_last_posts'=>'Ostatnich postów w profilu',
	'public_admin'=>'Publiczny admin',
	'registered_users'=>'Zarejestrowanych użytkoników',
	'register_per_ip'=>'Registration with the same IP?',					 
	'search_min_length'=>'Minimalna długość słowa',
	'settings'=>'Ustawienia',
	'shoutbox'=>'Shoutbox',
	'shoutbox_all_messages'=>'Wszystkich wiadomości w Shoutbox',
	'shoutbox_refresh'=>'Odświeżanie Shoutbox',
	'space_user'=>'Przestrzeń na jednego użytkownika (MByte)',
	'spam_check'=>'Validate Posts?',
	'spamapiblockerror'=>'Block Posts?',
	'spamapihost'=>'API URL',
	'spamapikey'=>'API Key',
	'spamfilter'=>'Spam Filter',
	'spammaxposts'=>'Max. Posts',
	'sc_modules'=>'SC Modules',						   																																					   
	'thumb_width'=>'Rormiar miniaturek',
	'tooltip_1'=>'To jest adres URL strony np. (twoja_strona.pl/webspell) bez http:// na początku i slasha "/" na końcu',
	'tooltip_2'=>'To jest tytuł strony, wyświetlany jako tytuł okna',
	'tooltip_3'=>'Nazwa Twojej organizacji',
	'tooltip_4'=>'Skrót nazwy Twojej oraganizacji',
	'tooltip_5'=>'Właściciel strony / Administrator strony',
	'tooltip_6'=>'E-Mail administratora',
	'tooltip_7'=>'Ilość aktualności wyświetlanych na stronie głownej',
	'tooltip_8'=>'Ilość tematów forum wyświetlanych na jednej stronie',
	'tooltip_9'=>'Ilość obrazków wyświetlanych na jednej stronie',
	'tooltip_10'=>'Ilość aktualności w archiwum wyświetlanych na jedną stronę',
	'tooltip_11'=>'Ilość postów wyświetlanych na jednej stronie',
	'tooltip_12'=>'Rozmiar miniaturek w galerii',
	'tooltip_13'=>'Ilość Ostatnich Aktualności wyświetlanych na stronie głównej',
	'tooltip_14'=>'Ilość Ostatnich Tematów na forum wyświtlanych na stronie głównej',
	'tooltip_15'=>'Przestrzeń w MByte zarezerwowana na galerię jednego użytkownika',
	'tooltip_16'=>'Długość znaków nagłówka wyświetlanych w Ostatnich Aktualnościach na stronie głównej',
	'tooltip_17'=>'Określa minimalną długość szukanego słowa w wyszukiwarce',
	'tooltip_18'=>'Zaznacz aby nadać użytkonikowi prawo do tworzenia własnej galerii',
	'tooltip_19'=>'Pozwala zarządać galerią zdjęć bezpośrednio na swojej stronie (zaleca się zaznaczenie tej opcji)',
	'tooltip_20'=>'Określa ilość wyświetlanych artykułów na jednej stronie',
	'tooltip_21'=>'Określa ilość wyświetlanych osiągnięć na jedną stronę',
	'tooltip_22'=>'Ilość artykułów wyświetlanych na stronie głownej',
	'tooltip_23'=>'Ilość demek wyświetlanych na jednej stronie',
	'tooltip_24'=>'Liczba znaków nagłówka wyświetlanych w Ostatnich Artykułach na stronie głównej',
	'tooltip_25'=>'Ilość wpisów do Księgi Gości wyświetlanych na jednej stronie',
	'tooltip_26'=>'Ilość komentarzy wyświetlanych na jednej stronie',
	'tooltip_27'=>'Ilość wiadomości wyświetlanych na jednej stronie',
	'tooltip_28'=>'Ilość meczy wyświetlanych na jednej stronie',
	'tooltip_29'=>'Ilość zarejestrowanych użytkoników wyświetlanych na jednej stronie',
	'tooltip_30'=>'Ilość ostatnich wyników meczy wyświetlanych na stronie głównej',
	'tooltip_31'=>'Ilość postów wyświetlanch w profilu',
	'tooltip_32'=>'Ilość nadchodzących wydarzeń wyświetlanych na stronie głównej',
	'tooltip_33'=>'Czas zalogowania[w godzinach] (0 = 20 minut)',
	'tooltip_34'=>'Maksymalny rozmiar (szerokość) zawartości (obrazki, pola tekstowe itp.) (0 = wyłączone)',
	'tooltip_35'=>'Maksymalny rozmiar (wysokość) zawartości (obrazki) (0 = wyłączone)',
	'tooltip_36'=>'Zaznacz jeśli chcesz aby Admin-Zaplecza dostawał wiadomości na temat dodania wpisu do Księgi Gości',
	'tooltip_37'=>'Ilość wyświetlanych wpisów w Shoutboxie',
	'tooltip_38'=>'Liczba zapisanych komentarzy w Shoutboxie',
	'tooltip_39'=>'Wpisz tutaj co ile (w sekundach) ma być odświeżany Shoutbox',
	'tooltip_40'=>'Wybierz z listy jeden z języków, który będzie głównym językiem dla Twojej strony',
	'tooltip_41'=>'Zaznacz jeśli chcesz aby linki do profilu użytkownika zostały dodawane automatycznie',
	'tooltip_42'=>'Liczba znaków nagłówka w Ostatnich Tematach pokazywanych na stronie głównej',
	'tooltip_43'=>'Liczba nieudanych logowań przed zbanowaniem',
	'tooltip_44'=>'Wybierz jeden z trzech rodzaji wyświtlania captcha na stronie',
	'tooltip_45'=>'Określ tutaj kolor tła captcha, np. #ffffff (biały)',
	'tooltip_46'=>'Określ tutaj kolor czcionki captcha, np. #000000 (czarny)',
	'tooltip_47'=>'Wybierz styl wyświetlania captcha',
	'tooltip_48'=>'Liczba rozproszenia pikseli',
	'tooltip_49'=>'Liczba linii rozpraszających',
	'tooltip_50'=>'Wybierz z listy funkcję, która będzie automatycznie pomniejszać dodane obrazy',
	'tooltip_51'=>'Długość znaków nagłówka w Gorącej Aktualności wyświtlanej na stronie głównej strony',
	'tooltip_52'=>'Detect language of the visitor automatically',
	'tooltip_53'=>'Validate Posts with external Database',
	'tooltip_54'=>'Enter your Spam API key here if available',
	'tooltip_55'=>'Enter the URL to API host server here.<br>Default: https://api.webspell.org',								  
	'tooltip_56'=>'Number of posts from when no longer will be validated with external database',
	'tooltip_57'=>'Block Posts when an error has occurred',
	'tooltip_58'=>'Output format of the date',
	'tooltip_59'=>'Output format of time',
	'tooltip_60'=>'Enable user guestbooks on the website?',
	'tooltip_61'=>'What should the SC Demos Module show?',
	'tooltip_62'=>'What should the SC Files Module show?',												
	'transaction_invalid'=>'Transakcja ID nieprawidłowa!',
	'upcoming_actions'=>'Nadchodzących wydarzeń',
	'update'=>'Uaktualnij',
	'user_guestbook'=>'User Guestbooks'								 
);
?>