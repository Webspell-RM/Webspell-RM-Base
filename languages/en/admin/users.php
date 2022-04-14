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

  'about_myself'=>'About myself',
  'access_denied'=>'Access denied',
  'actions'=>'Actions',
  'activate'=>'activate',
  'active'=>'active',
  'activity'=>'Activity',
  'add_new_user'=>'add new User',
  'add_to_clan'=>'add to Clan',
  'admin'=>'Administrator',
  'avatar'=>'Avatar',
  'back'=>'back',
  'banish'=>'banish',
  'banned'=>'Banned',
  'ban_for'=>'ban for',
  'ban_status'=>'Ban Status',
  'ban_until'=>'ban until',
  'ban_user'=>'ban User',
  'birthday'=>'Date of Birth',
  'clan_history'=>'Clan History',
  'clan_homepage'=>'Clan Homepage',
  'can_not_copy_file'=>'ERROR: Can\'t copy File from Server',
  'clan_irc'=>'Clan IRC',
  'clanmember'=>'Clanmember',
  'clanname'=>'Clanname',
  'clantag'=>'Clantag',
  'connection'=>'Connection',
  'country'=>'Country',
  'cpu'=>'CPU',
  'days'=>'days',
  'delete'=>'delete',
  'delete_avatar'=>'delete Avatar',
  'delete_picture'=>'delete Picture',
  'diverse' => 'divers',
  'edit_ban'=>'edit Ban',
  'edit_profile'=>'edit Profile',
  'email'=>'E-Mail',
  'error_avatar'=>'ERROR: Avatar is to big (max. 90x90)',
  'error_picture'=>'ERROR: Picture is to big (max. 230x210)',
  'female'=>'female',
  'firstname'=>'Firstname',
  'gender'=>'Gender',
  'general'=>'General',
  'graphiccard'=>'Graphiccard',
  'homepage'=>'Homepage',
  'icq'=>'ICQ',
  'inactive'=>'inactive',
  'invalid_format'=>'ERROR: Invalid picture-format (allowed: *.gif, *.jpg or *.png)',
  'keyboard'=>'Keyboard',
  'lastname'=>'Lastname',
  'mainboard'=>'Mainboard',
  'male'=>'male',
  'max_90x90'=>'(max. 90x90)',
  'max_230x210'=>'(max. 230x210)',
  'moderator'=>'Forum Moderator',
  'month'=>'month',
  'monitor'=>'Monitor',
  'mouse'=>'Mouse',
  'mousepad'=>'Mousepad',
  'nickname'=>'Nickname',
  'not_available'=>'not available',
  'no_users'=>'no Users found',
  'password'=>'Password',
  'permanently'=>'ban permanently ?',
  'personal'=>'Personal',
  'picture'=>'Picture',
  'pictures'=>'Pictures',
  'position'=>'Position',
  'profile'=>'Profile',
  'ram'=>'RAM',
  'really_ban'=>'really banish',
  'really_delete'=>'Really delete this User?',
  'really_unban'=>'really unban',
  'reason'=>'Reason',
  'registered_since'=>'Registered since',
  'remove_ban'=> 'remove ban?',
  'rights'=>'Rights',
  'signatur'=>'Signatur',
  'sort'=>'Sort',
  'soundcard'=>'Soundcard',
  'squad'=>'Squad',
  'status'=>'Status',
  'superadmin'=>'Superadministrator',
  'town'=>'Town',
  'transaction_invalid'=>'Transaction ID invalid',
  'to_clan'=>'to Clan',
  'to_sort'=>'sort',
  'undo_ban'=>'undo ban',
  'upload_failed'=>'ERROR: Upload failed',
  'user'=>'User',
  'user_exists'=>'User already exists',
  'user_id'=>'User ID',
  'username'=>'Username',
  'users'=>'Users',
  'users_available'=>'Users available',
  'usersearch'=>'Usersearch',
  'exactsearch'=>'exact',
  'various'=>'Various',
  'weeks'=>'weeks',
  'you_cant_ban'=>'You can\'t ban this user! (Superadmin)',
  'you_cant_ban_yourself'=>'You can\'t ban yourself',
  'error'=>'Error',
    'twitch' => 'Twitch',
    'youtube' => 'Youtube',
    'twitter' => 'Twitter',
    'instagram' => 'Instagram',
    'facebook' => 'Facebook',
    'social-media' => 'Social Media',
  'image_too_big' => 'Picture too big'
);

