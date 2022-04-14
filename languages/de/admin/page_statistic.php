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
  'plugins_about_us'=>'About Us',
  'plugins_articles'=>'Artikel',
  'plugins_awards'=>'Auszeichnungen',
  'plugins_banner'=>'Banner',
  'plugins_bannerrotation'=>'Banner Rotation',
  'plugins_fight_us_challenge'=>'Herausforderungen',
  'plugins_clanwars'=>'Clanwars',
  'comments'=>'Kommentare',
  'contact'=>'Kontakte',
  'settings_countries'=>'Länder',
  'database'=>'Datenbank',
  'demos'=>'Demos',
  'plugins_faq'=>'FAQs',
  'plugins_faq_categories'=>'FAQ Kategorien',
  'plugins_files'=>'Dateien',
  'plugins_files_categories'=>'Datei Kategorien',
  'plugins_forum_announcements'=>'Forum Ankündigungen',
  'plugins_forum_boards'=>'Foren',
  'plugins_forum_categories'=>'Forum Kategorien',
  'plugins_forum_groups'=>'Forum Gruppen',
  'plugins_forum_moderators'=>'Forum Moderatoren',
  'plugins_forum_posts'=>'Forum Einträge',
  'plugins_forum_ranks'=>'Forum Ränge',
  'plugins_forum_topics'=>'Forum Themen',
  'plugins_gallery'=>'Galerie Bilder',
  'plugins_gallery_categorys'=>'Galerie Kategorien',
  'plugins_gallery_pictures'=>'Galerie Bilder',
  'settings_games'=>'Spiele',
  'plugins_guestbook'=>'Gästebuch Einträge',
  'plugins_links'=>'Links',
  'plugins_links_categorys'=>'Link Kategorien',
  'plugins_linkus'=>'Verlinke uns Banner',
  'plugins_messenger'=>'gesendete Nachrichten',
  'mysql_version'=>'MySQL Version',
  'plugins_news'=>'Neuigkeiten',
  'news_languages'=>'Neuigkeiten-Sprachen',
  'plugins_news_rubrics'=>'Neuigkeiten Rubriken',
  'plugins_news_comments'=>'Neuigkeiten Kommentare',
  'optimize'=>'jetzt optimieren!',
  'overhead'=>'Überschuss',
  'page_stats'=>'Seiten Statistiken',
  'plugins_partners'=>'Partner',
  'plugins_poll'=>'Umfragen',
  'plugins_servers'=>'Server',
  'plugins_shoutbox'=>'Shoutbox Einträge',
  'size'=>'Größe',
  'smileys'=>'Smilies',
  'plugins_sponsors'=>'Sponsoren',
  'squads'=>'Teams',
  'static'=>'Statische Seiten',
  'tables'=>'Tabellen',
  'user'=>'registrierte Benutzer',
  'user_gbook'=>'Benutzer-Gästebuch Einträge',
  'plugins_videos'=>'Videos',
  'plugins_videos_categories'=>'Video Kategorien',
  'plugins_videos_comments'=>'Videos Kommentare',
  'plugins_todo'=>'Todo',
  'plugins_streams'=>'Streams',
  'plugins_pic_update'=>'Bilder update'
);


