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
  
  'tooltip_1' => 'This is the URL of the page, e.g. (yourdomain.de/pfad/webspell). <br> Start with http: // or https: // and do not end with a slash!',
  'tooltip_2' => 'This is the title of the page, is also displayed as the browser title',
  'tooltip_3' => 'The name of the organization',
  'tooltip_4' => 'The abbreviation of the organization',
  'tooltip_5' => 'Your name',
  'tooltip_6' => 'The email address of the webmaster',
  'tooltip_7' => 'Maximum news, which are completely displayed',
  'tooltip_8' => 'Forum topics per page',
  'tooltip_9' => 'Images per page',
  'tooltip_10' => 'News in archive per page',
  'tooltip_11' => 'Forum posts per page',
  'tooltip_12' => 'Size (width) for gallery thumbnails',
  'tooltip_13' => 'Latest news listed in sc_headlines',
  'tooltip_14' => 'Forum topics listed in latesttopics',
  'tooltip_15' => 'Storage space for user galleries per user in MByte',
  'tooltip_16' => 'Maximum length for the latest news in sc_headlines',
  'tooltip_17' => 'Minimum length of search terms',
  'tooltip_18' => 'Do you want to allow user galleries for every user?',
  'tooltip_19' => 'Would you like to manage gallery images directly on your page? (better be selected) ',
  'tooltip_20' => 'Articles per page',
  'tooltip_21' => 'Awards per page',
  'tooltip_22' => 'Article listed in sc_articles',
  'tooltip_23' => 'Demos per page',
  'tooltip_24' => 'Maximum length of the listed articles in sc_articles',
  'tooltip_25' => 'Guestbook entries per page',
  'tooltip_26' => 'Comments per page',
  'tooltip_27' => 'Private messages per page',
  'tooltip_28' => 'Clanwars per page',
  'tooltip_29' => 'Registered users per page',
  'tooltip_30' => 'Results listed in sc_results',
  'tooltip_31' => 'Last posts listed in profile',
  'tooltip_32' => 'Planned entries listed in sc_upcoming',
  'tooltip_33' => 'Registration duration [in hours] (0 = 20 minutes)',
  'tooltip_34' => 'Maximum size (width) for the content (images, text fields, etc.) (0 = deactivated)',
  'tooltip_35' => 'Maximum size (height) for images (0 = deactivated)',
  'tooltip_36' => 'Should feedback admins receive a message when there is a new guestbook entry?',
  'tooltip_37' => 'Shoutbox comments, which are displayed in the shoutbox',
  'tooltip_38' => 'Maximum saved comments in the shoutbox',
  'tooltip_39' => 'Duration (in seconds) for reloading the Shoutbox',
  'tooltip_40' => 'Standard language for the page',
  'tooltip_41' => 'Should the links to the member profiles be set automatically?',
  'tooltip_42' => 'Maximum length for the latest topics in latesttopics',
  'tooltip_43' => 'Maximum number of incorrect password entries before IP Ban',
  'tooltip_44' => 'Display type of the captcha',
  'tooltip_45' => 'Captcha background color',
  'tooltip_46' => 'Font color of the captcha',
  'tooltip_47' => 'Type of Captcha',
  'tooltip_48' => 'Number of faults',
  'tooltip_49' => 'Number of fault lines',
  'tooltip_50' => 'Selection of automatic content size adjustment',
  'tooltip_51' => 'Maximum length for the top news in sc_topnews',
  'tooltip_52' => 'Recognize the visitor`s language automatically',
  'tooltip_53' => 'Validate posts with external database',
  'tooltip_54' => 'Enter your Spam API key here if you have one',
  'tooltip_55' => 'Enter the URL to the API host server here. <br> Standard: https://api.webspell.org',
  'tooltip_56' => 'Number of posts from when will no longer be validated with external database',
  'tooltip_57' => 'Should the posts be blocked if there is an error?',
  'tooltip_58' => 'Output format of the date',
  'tooltip_59' => 'Output format of the time',
  'tooltip_60' => 'Activate user guestbooks on the site?',
  'tooltip_61' => 'What should the SC Demos module display?',
  'tooltip_62' => 'What should the SC files module show?',
  'tooltip_63' => 'Block registration with the same IP address?',
  'tooltip_64' => 'The name of your homepage',
  'tooltip_65' => 'No double post allowed in the forum?',
  'tooltip_66' => 'Show / hide German language selection in navigation',
  'tooltip_67' => 'Show / hide English language selection in navigation',
  'tooltip_68' => 'Show / hide Italian language selection in navigation',
  'tooltip_69' => 'Show / hide Polish language selection in navigation',

/*general attitude*/
    'access_denied' => '<h3> Info </h3> <div class = "alert alert-danger"> <span class = "sr-only"> Error: </span> <strong> Access denied </strong> </div> ',
    'info' => '<div class = "alert alert-warning" role = "alert"> Here is a description </div>',
    'updated_successfully' => '<div class = "col-md-12"> <div class = "alert alert-success" role = "alert"> Updated successfully. </div> </div>',
    'transaction_invalid' => '<div class = "alert alert-danger" role = "alert"> Invalid transaction ID. </div>',
    'update' => 'update',



/*===============================================================================================*/
/*Ideas */
  'settings' => 'Settings',
  'additional_options_startpage' => 'Deactivate frontend (website) and select startpage',
  'page_title' => 'Homepage title',
  'page_url' => 'Homepage URL',
  'admin_email' => 'Admin E-Mail',
  'admin_name' => 'Admin Name',
  'clan_name' => 'Clan Name',
  'clan_tag' => 'Clan Tag',

/* Deactivate frontend (website) and select startpage */
  'additional_options' => 'Deactivate website',
  'pagelock' => 'Lock page',
  'startpage' => 'Choose homepage',
  
 
  /* Google reCaptcha */
  'reCaptcha' => 'Google reCaptcha',
  'important_text' => 'Before you activate this modification you need the reCaptcha APi-Keys. <br /> To do this, proceed as follows. <br /> <br /> 1. <a href="https://www.google.com/recaptcha/intro/index.html" target="_blank"> create a reCaptcha account </a>. <br /> 2. Enter your internet address. <br /> 3. reCAPTCHA type: <b> V2 </b> (check box) select <br /> 4. Enter the two keys you received here. ',
  'activate' => 'activated',
  'web-key' => 'Website key',
  'secret-key' => 'Secret-key',
  'success' => '<div class = "col-md-12"> <div class = "alert alert-success" role = "alert"> reCaptcha account updated successfully. </div> </div>',
  'failed' => '<div class = "col-md-12"> <div class = "alert alert-danger" role = "alert"> reCaptcha account operation failed. </div> </div>',
  
/* captcha */
  'captcha' => 'Captcha',
  'captcha_autodetect' => 'automatically',
  'captcha_bgcol' => 'Background color',
  'captcha_both' => 'both',
  'captcha_fontcol' => 'Font color',
  'captcha_image' => 'Image',
  'captcha_linenoise' => 'Lines disturbance',
  'captcha_noise' => 'Disturbance',
  'captcha_only_math' => 'only math',
  'captcha_only_text' => 'only text',
  'captcha_text' => 'Text',
  'captcha_type' => 'Captcha type',
  'captcha_style' => 'Captcha style',

  /* Others */
  'other' => 'Other',
  'format_date' => 'Date format',
  'format_time' => 'Time format',
  'language_navi' => 'Show / hide language selection in navigation',
  'de_language' => 'German',
  'en_language' => 'English',
  'it_language' => 'Italian',
  'pl_language' => 'polish',

  'login_duration' => 'Login duration',
  'register_per_ip' => 'Registration with the same IP?',
  'search_min_length' => 'min. Length of search ',
  'profile_last_posts' => 'last posts in profile',
  'default_language' => 'Standard language',

  'detect_visitor_language' => 'Detect visitor language?',
  'max_wrong_pw' => 'max. wrong passwords',
  'forum_double' => 'Forum - No double post',
/* =========================================================================== ==================== */
  /* social settings */
  'social_settings' => 'Social Media Settings',
  'title_social_media' => 'Settings',

/* =========================================================================== ==================== */
  /* plugin settings */
  'plugin_settings' => 'Plugin Settings',
  /* joinus */
  'title_join_us' => 'Join us',
  'admin_info' => 'Show all squads <br> <small> (active and inactive teams) </small>',
  'terms_of_use' => 'Accept the clan rules',
  /* members */
  'title_members' => 'Members',
  'max_registered_members' => 'Members per page',
  'tooltip_members' => 'Members per page',
  /* userlist */
  'title_userlist' => 'Registered users',
  'max_registered_userslist' => 'Reg. Users per page ',
  'tooltip_userlist' => 'Registered users per page',

  /* useronline */
  'title_useronline' => 'User online',
  'max_registered_useronline' => 'Users per page',
  'tooltip_useronline' => 'Users per page',

  /* facebook */
  'title_facebook' => 'Facebook',
  'fb1_activ' => 'Representation 1',
  'fb2_activ' => 'Representation 2',
  'fb3_activ' => 'Representation 3',
  'fb4_activ' => 'Representation 4', 

    
    

);