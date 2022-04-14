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

  'access_denied'=>'Accesso negato',
  'plugins_articles'=>'Articoli',
  'plugins_awards'=>'Premi',
  'plugins_banner'=>'Banner',
  'plugins_bannerrotation'=>'Rotazione Banner',
  'plugins_fight_us_challenge'=>'Sfide',
  'plugins_clanwars'=>'Clanwars',
  'comments'=>'Commenti',
  'contact'=>'Contatti',
  'settings_countries'=>'Paese',
  'database'=>'Database',
  'demos'=>'Demos',
  'plugins_faq'=>'FAQs',
  'plugins_faq_categories'=>'FAQ Categorie',
  'plugins_files'=>'File',
  'plugins_files_categories'=>'File Categorie',
  'plugins_forum_announcements'=>'Forum Annunci',
  'plugins_forum_boards'=>'Forum Bacheche',
  'plugins_forum_categories'=>'Forum Categorie',
  'plugins_forum_groups'=>'Forum Grouppi',
  'plugins_forum_moderators'=>'Forum Moderatori',
  'plugins_forum_posts'=>'Forum Post',
  'plugins_forum_ranks'=>'Forum Rank',
  'plugins_forum_topics'=>'Forum Topic',
  'plugins_gallery'=>'Gallerie Immagini',
  'plugins_gallery_categorys'=>'Gallerie Categorie',
  'plugins_gallery_pictures'=>'Gallerie Immagini',
  'settings_games'=>'Giochi',
  'plugins_guestbook'=>'Voci guestbook',
  'plugins_links'=>'Link',
  'plugins_links_categorys'=>'Categorie Link',
  'plugins_linkus'=>'Collegaci Banner',
  'plugins_messenger'=>'Messaggi inviati',
  'mysql_version'=>'Versione MySQL',
  'plugins_news'=>'Notizie',
  'news_languages'=>'Lingue delle notizie',
  'plugins_news_rubrics'=>'Rubriche delle notizie',
  'plugins_news_comments'=>'Commenti delle notizie',
  'optimize'=>'Ottimizza ora!',
  'overhead'=>'Overhead',
  'page_stats'=>'Pagina Statistiche',
  'plugins_partners'=>'Partner',
  'plugins_poll'=>'Sondaggi',
  'plugins_servers'=>'Server',
  'plugins_shoutbox'=>'Voci Shoutbox',
  'size'=>'Dimensione',
  'smileys'=>'Faccine',
  'plugins_sponsors'=>'Sponsor',
  'squads'=>'Squadra',
  'static'=>'Pagine Statiche',
  'tables'=>'Tablle',
  'user'=>'Utenti Registrati',
  'user_gbook'=>'Voci guestbook utente',
  'plugins_videos'=>'Video',
  'plugins_videos_categories'=>'Categorie Video',
  'plugins_videos_comments'=>'Commenti Video',
  'plugins_todo'=>'Cose da fare',
  'plugins_streams'=>'Stream',
  'plugins_pic_update'=>'Aggiorna Immagini'
);

