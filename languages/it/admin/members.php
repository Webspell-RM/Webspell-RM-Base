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
  'access_rights'=>'Diritti di accesso',
  'actions'=>'Azioni',
  'active'=>'Attivo',
  'activity'=>'Attività',
  'cash_admin'=>'Amministratore di Cassa',
  'clanwar_admin'=>'Amministratore di Clanwar',
  'country_nickname'=>'Paese / Soprannome',
  'delete'=>'Cancella',
  'description'=>'Descrizione Utente',
  'edit'=>'Edita',
  'edit_member'=>'Modifica Membro',
  'error_own_rights'=>'ERRORE: impossibile modificare il proprio Profilo',
  'feedback_admin'=>'Amministratore Feedback',
  'fightus_admin'=>'Amministratore Fightus',
  'file_admin'=>'Amministratore File',
  'gallery_admin'=>'Amministratore Galleria',
  'group_access'=>'Accesso al gruppo del Forum',
  'inactive'=>'Inattivo',
  'joinus_admin'=>'Amministratore Entra con noi',
  'members'=>'Membro',
  'messageboard_admin'=>'Amministratore Messaggi',
  'messageboard_moderator'=>'Moderatore Messaggi',
  'news_admin'=>'Amministratore Notizie',
  'news_writer'=>'Scrittore Notizie',
  'nickname'=>'Nickname',
  'no'=>'No',
  'page_admin'=>'Amministrazione Pagina',
  'polls_admin'=>'Amministrazione Sondaggi',
  'position'=>'Posizione',
  'really_delete'=>'Davvero eliminare questo membro?',
  'sort'=>'Ordine',
  'squad'=>'Squadra',
  'super_admin'=>'Super-Amministratre',
  'to_sort'=>'Ordina',
  'tooltip_1'=>'<b>Accesso:</b><br>- Notizie Rubriche<br>- Notizie Lingue<br> - Notizie<br>- Articoli<br>- Awards<br>- Links',
  'tooltip_2'=>'<b>Accesso:</b><br>- Scrittore di Notizie',
  'tooltip_3'=>'<b>Accesso:</b><br>- Sondaggi',
  'tooltip_4'=>'<b>Accesso:</b><br>- Commenti<br>- Guestbook<br>- Utenti-Guestbook<br>- Shoutbox',
  'tooltip_5'=>'<b>Accesso:</b><br>- Utenti<br>- Diritti Utente<br>- Squadre<br>- Membri<br> Contatti<br>- Newsletter',
  'tooltip_6'=>'<b>Accesso:</b><br>- Clanwars<br>- Premi<br>- Sfide<br>- Calendario',
  'tooltip_7'=>'<b>Accesso:</b><br>- Categorie Forum<br>- Bacheche<br>- Argomenti/Modifica Post ed eliminazione<br>- Gruppi-Utenti<br>- Utenti-Gruppo<br>- Classifica Utenti',
  'tooltip_8'=>'<b>Accesso:</b><br>- Topics/Posts edita &amp; cancella<br>(L\'assegnazione del consiglio di amministrazione deve esistere)',
  'tooltip_9'=>'<b>Accesso:</b><br>- About us<br>- Rotazione Banner<br>- Icone<br>- Database<br>- FAQ Categorie<br>- FAQ<br>- Storia<br>- Imprint<br>- Link Categorie<br>- Link<br>- Blocca Sito<br>- Parnter<br>- Server<br>- Settaggi<br>- Pagine Statiche<br>- Stili<br>- Aggiornamenti<br>- Link us<br>- Sponsor',
  'tooltip_10'=>'<b>Accesso:</b><br>- File Categories<br>- Files<br>- Demo',
  'tooltip_11'=>'<b>Accesso:</b><br>- Cassa',
  'tooltip_12'=>'<b>Accesso:</b><br>- Categorie Galleria<br>- Gallerie<br>- Immagini',
  'tooltip_13'=>'<b>Accesso:</b><br>- Amministrazione Completa',
  'transaction_invalid'=>'ID transazione non valido',
  'user_admin'=>'Amministratore Utente',
  'yes'=>'Si',
  'na'=>'Nessun Dato',
  'n_a'=>'Nessun Dato',
  'used_for'=>'Usato per',
  'special_rank'=>'Rank Spaciali',
  'no_special_rank'=>'Nessun Rank Spaciale',
  'options'=>'Opzioni',
  'saved successfully'=>'Salvato Correttamente',
  'delete_info'=>'Sei sicuro di voler rimuovere questo membro? <br> <br> Tutto verrà eliminato definitivamente.'
);

