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

    '_tag_if_wish' => ' Anweisung umgeben.',
    '_tags_retained' => 'Anweisung umgeben sind, werden beibehalten.',
    'adding_image' => 'Bilder zu einem Beitrag hinzufügen',
    'all_formating_' => 'Alle Formatierungen die mit der',
    'as_noted_url_' => 'Du kannst z.B. das Bild mit einer ',
    'back_top' => 'Wieder an den Anfang',
    'bb_code_tags_color_size' => 'Um die Textfarbe oder Textgrösse abzuändern, kannst du folgende Anweisungen benutzen. Vergesse aber nicht, dass je nach Betriebssystem und Webbrowser alles etwas anders aussehen kann:',
    'bb_code_tags_text_syle' => 'BBCode hat Anweisungen, die Ihnen erlauben einfach den Textstill zu ändern:',
    'bbcode_guide' => 'BBCode Anleitung',
    'becomes' => 'wird',
    'blue' => 'Blau',
    'bold_text' => 'Fett gedruckt',
    'can_combine_formatting' => 'Kombinieren von BBCode Anweisungen',
    'close_tags_is_up_to_you' => 'Vergess nicht, dass es deine Aufgabe ist, die Anweisungen korrekt zu schliessen.',
    'creating_links' => 'WebLinks',
    'creating_ordered_list' => 'Geortnete Listen',
    'creating_unordered_list' => 'Ungeordnete Listen',
    'email_me' => 'schreib mir!',
    'generating_lists' => 'Listen erstellen',
    'good_morning' => 'Guten Morgen',
    'great' => 'Grossartig!',
    'hello' => 'Hallo',
    'how_to_change_cs' => 'Ändern der Textfarbe und Textgrösse',
    'how_to_create_biu' => 'Fett gedruckter, kursiver und unterstrichener Text',
    'huge' => 'GROSS!',
    'italic_text' => 'Kursiv',
    'linking_another_site' => 'Andere Seiten verlinken',
    'look_at_me' => 'SCHAU MICH AN!',
    'mr_blobby' => 'Globby',
    'or' => 'oder',
    'outputting_code' => 'Quellcode hervorheben',
    'quoting_outputting_text' => 'Zitieren und Hervorheben von Texten',
    'quoting_replys' => 'Zitieren',
    'red' => 'Rot',
    'showing_images' => 'Bilder',
    'small' => 'KLEIN',
    'text_formatting' => 'Textformatierung',
    'text_of_mr_blobby' => 'Der Text der Globby geschrieben hat',
    'this_is_some_code' => 'Das ist der ultimative Quellcode',
    'this_would_output' => 'wird ausgeben',
    'underlined_text' => 'Unterstrichen',
    'which_will_output' => 'würde ausgeben',
    'will_be' => 'wird',
    'will_become' => 'wird zu',
    'will_both_output' => 'Beide werden ausgeben',
    'will_generally_be' => 'wird normalerweise',
    'would_generate' => 'würde ergeben',
    'would_generate_link' => 'Dies würde folgender Link erstellen, ',
    'would_generate_list' => 'Würde folgende Liste erstellen',
    'would_give' => 'Würde ausgeben',
    'yellow' => 'Gelb',
    'yes_can_combine' => 'Beispiel:'
);

