<?php
/*-----------------------------------------------------------------\
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
\------------------------------------------------------------------*/

function settitle($string)
{
    return $GLOBALS['hp_title'] . ' - ' . $string;
}

function extractFirstElement($element)
{
    return $element[0];
}

function getPageTitle($url = null, $prefix = true)
{
    $data = parseWebspellURL($url);
    if (isset($GLOBALS['metatags'])) {
        $GLOBALS['metatags'] = $GLOBALS['metatags'] + $data['metatags'];
    } else {
        $GLOBALS['metatags'] = $data['metatags'];
    }

    $titles = array_map("extractFirstElement", $data['titles']);
    $title = implode('&nbsp; &raquo; &nbsp;', $titles);
    if ($prefix) {
        $title = settitle($title);
    }
    return $title;
}

function parseWebspellURL($parameters = null)
{
    $_language = $GLOBALS['_language'];
    $_language->readModule('seo');

    if ($parameters === null) {
        $parameters = $_GET;
    }

    if (isset($parameters['action'])) {
        $action = $parameters['action'];
    } else {
        $action = '';
    }

    $returned_title = array();
    $metadata = array();
    if (isset($parameters['site'])) {
        switch ($parameters['site']) {

            case 'about_us':
                $returned_title[] = array($_language->module['about_us']);
                break;

            case 'articles':
                if (isset($parameters['articlecatID'])) {
                    $articlecatID = (int)$parameters['articlecatID'];
                } else {
                    $articlecatID = 0;
                }
                if (isset($parameters['articleID'])) {
                    $articleID = (int)$parameters['articleID'];
                } else {
                    $articleID = '';
                }
                $get = mysqli_fetch_array(
                    safe_query(
                        "SELECT articlecatname FROM `" . PREFIX . "plugins_articles_categorys` WHERE articlecatID=" . (int)$articlecatID
                    )
                );
                $get2 = mysqli_fetch_array(
                    safe_query("SELECT question FROM `" . PREFIX . "plugins_articles` WHERE articleID=" . (int)$articleID)
                );
                if ($action == "articlecat") {
                    $returned_title[] = array(
                        $_language->module['articles'],
                        'index.php?site=articles'
                    );
                    $returned_title[] = array($get['articlecatname']);
                } elseif ($action == "articles") {
                    $returned_title[] = array(
                        $_language->module['articles'],
                        'index.php?site=articles'
                    );
                    $returned_title[] = array(
                        $get['articlecatname'],
                        'index.php?site=articles&amp;action=articlecat&amp;articlecatID=' . $articlecatID
                    );
                    $returned_title[] = array($get2['question']);
                    $metadata['keywords'] = \webspell\Tags::getTags('articles', $articleID);
                } else {
                    $returned_title[] = array($_language->module['articles']);
                }
                break;
   

            case 'awards':
                if (isset($parameters['awardID'])) {
                    $awardID = (int)$parameters['awardID'];
                } else {
                    $awardID = '';
                }
                if ($action == "details") {
                    $get = mysqli_fetch_array(
                        safe_query("SELECT award FROM `" . PREFIX . "plugins_awards` WHERE awardID=" . (int)$awardID)
                    );
                    $returned_title[] = array(
                        $_language->module['awards'],
                        'index.php?site=awards'
                    );
                    $returned_title[] = array($get['award']);
                } else {
                    $returned_title[] = array($_language->module['awards']);
                }
                break;

            case 'buddys':
                $returned_title[] = array($_language->module['buddys']);
                break;

            case 'calendar':
                $returned_title[] = array($_language->module['calendar']);
                break;

            case 'cashbox':
                $returned_title[] = array($_language->module['cash_box']);
                break;

            case 'challenge':
                $returned_title[] = array($_language->module['challenge']);
                break;

            case 'clanwars':
                if ($action == "stats") {
                    $returned_title[] = array(
                        $_language->module['clanwars'],
                        'index.php?site=clanwars'
                    );
                    $returned_title[] = array($_language->module['stats']);
                } else {
                    $returned_title[] = array($_language->module['clanwars']);
                }
                break;

            case 'clanwars_details':
                if (isset($parameters['cwID'])) {
                    $cwID = (int)$parameters['cwID'];
                } else {
                    $cwID = '';
                }
                $get = mysqli_fetch_array(
                    safe_query("SELECT opponent FROM `" . PREFIX . "plugins_clanwars` WHERE cwID=" . (int)$cwID)
                );
                $returned_title[] = array(
                    $_language->module['clanwars'],
                    'index.php?site=clanwars'
                );
                $returned_title[] = array($_language->module['clanwars_details']);
                $returned_title[] = array($get['opponent']);
                break;

            case 'contact':
                $returned_title[] = array($_language->module['contact']);
                break;

            case 'counter_stats':
                $returned_title[] = array($_language->module['stats']);
                break;

            case 'demos':
                if (isset($parameters['demoID'])) {
                    $demoID = (int)$parameters['demoID'];
                } else {
                    $demoID = '';
                }
                if ($action == "showdemo") {
                    $get = mysqli_fetch_array(
                        safe_query(
                            "SELECT game, clan1, clan2 FROM `" . PREFIX . "demos` WHERE demoID=" . (int)$demoID
                        )
                    );
                    $returned_title[] = array(
                        $_language->module['demos'],
                        'index.php?site=demos'
                    );
                    $returned_title[] = array(
                        $get['game'] . ' ' . $_language->module['demo'] . ': ' .
                        $get['clan1'] . ' ' .
                        $_language->module['versus'] . ' ' .
                        $get['clan2']);
                } else {
                    $returned_title[] = array($_language->module['demos']);
                }
                break;

            case 'faq':
                if (isset($parameters['faqcatID'])) {
                    $faqcatID = (int)$parameters['faqcatID'];
                } else {
                    $faqcatID = 0;
                }
                if (isset($parameters['faqID'])) {
                    $faqID = (int)$parameters['faqID'];
                } else {
                    $faqID = '';
                }
                $get = mysqli_fetch_array(
                    safe_query(
                        "SELECT faqcatname FROM `" . PREFIX . "plugins_faq_categories` WHERE faqcatID=" . (int)$faqcatID
                    )
                );
                $get2 = mysqli_fetch_array(
                    safe_query("SELECT question FROM `" . PREFIX . "plugins_faq` WHERE faqID=" . (int)$faqID)
                );
                if ($action == "faqcat") {
                    $returned_title[] = array(
                        $_language->module['faq'],
                        'index.php?site=faq'
                    );
                    $returned_title[] = array($get['faqcatname']);
                } elseif ($action == "faq") {
                    $returned_title[] = array(
                        $_language->module['faq'],
                        'index.php?site=faq'
                    );
                    $returned_title[] = array(
                        $get['faqcatname'],
                        'index.php?site=faq&amp;action=faqcat&amp;faqcatID=' . $faqcatID
                    );
                    $returned_title[] = array($get2['question']);
                    $metadata['keywords'] = \webspell\Tags::getTags('faq', $faqID);
                } else {
                    $returned_title[] = array($_language->module['faq']);
                }
                break;

            case 'files':
                if (isset($parameters['cat'])) {
                    $cat = (int)$parameters['cat'];
                } else {
                    $cat = '';
                }
                if (isset($parameters['file'])) {
                    $file = (int)$parameters['file'];
                } else {
                    $file = '';
                }
                if (isset($parameters['cat'])) {
                    $cat = mysqli_fetch_array(
                        safe_query(
                            "SELECT
                                filecatID, name
                            FROM
                                " . PREFIX . "plugins_files_categories
                            WHERE
                                filecatID='" . $cat . "'"
                        )
                    );
                    $returned_title[] = array(
                        $_language->module['files'],
                        'index.php?site=files'
                    );
                    $returned_title[] = array($cat['name']);
                } elseif (isset($parameters['file'])) {
                    $file = mysqli_fetch_array(
                        safe_query(
                            "SELECT
                                fileID, filecatID, filename
                            FROM
                                " . PREFIX . "plugins_files
                            WHERE
                                fileID=" . (int)$file
                        )
                    );
                    $catname = mysqli_fetch_array(
                        safe_query(
                            "SELECT
                                name
                            FROM
                                " . PREFIX . "plugins_files_categories
                            WHERE
                                filecatID=" . (int)$file['filecatID']
                        )
                    );
                    $returned_title[] = array(
                        $_language->module['files'],
                        'index.php?site=files'
                    );
                    $returned_title[] = array(
                        $catname['name'],
                        'index.php?site=files&amp;cat=' . $cat
                    );
                    $returned_title[] = array($file['filename']);
                } else {
                    $returned_title[] = array($_language->module['files']);
                }
                break;

            case 'forum':
                if (isset($parameters['board'])) {
                    $board = (int)$parameters['board'];
                } else {
                    $board = '';
                }
                if (isset($parameters['board'])) {
                    $board = mysqli_fetch_array(
                        safe_query(
                            "SELECT boardID, name FROM " . PREFIX . "plugins_forum_boards WHERE boardID='" . $board . "'"
                        )
                    );
                    $returned_title[] = array(
                        $_language->module['forum'],
                        'index.php?site=forum'
                    );
                    $returned_title[] = array($board['name']);
                } else {
                    $returned_title[] = array($_language->module['forum']);
                }
                break;

            case 'forum_topic':
                if (isset($parameters['topic'])) {
                    $topic = (int)$parameters['topic'];
                } else {
                    $topic = '';
                }
                if (isset($parameters['topic'])) {
                    $topic = mysqli_fetch_array(
                        safe_query(
                            "SELECT
                                topicID, boardID, topic
                            FROM
                                " . PREFIX . "plugins_forum_topics
                            WHERE
                                topicID=" . (int)$topic
                        )
                    );
                    $boardname = mysqli_fetch_array(
                        safe_query(
                            "SELECT name FROM " . PREFIX . "plugins_forum_boards WHERE boardID=" . (int)$topic['boardID']
                        )
                    );
                    $returned_title[] = array(
                        $_language->module['forum'],
                        'index.php?site=forum'
                    );
                    $returned_title[] = array(
                        $boardname['name'],
                        'index.php?site=forum&amp;board=' . $topic['boardID']
                    );
                    $returned_title[] = array($topic['topic']);
                } else {
                    $returned_title[] = array($_language->module['forum']);
                }
                break;

            case 'gallery':
                if (isset($parameters['groupID'])) {
                    $groupID = (int)$parameters['groupID'];
                } else {
                    $groupID = '';
                }
                if (isset($parameters['galleryID'])) {
                    $galleryID = (int)$parameters['galleryID'];
                } else {
                    $galleryID = '';
                }
                if (isset($parameters['picID'])) {
                    $picID = (int)$parameters['picID'];
                } else {
                    $picID = '';
                }
                if (isset($parameters['groupID'])) {
                    $groupID = mysqli_fetch_array(
                        safe_query(
                            "SELECT groupID, name FROM " . PREFIX . "plugins_gallery_groups WHERE groupID=" . (int)$groupID
                        )
                    );
                    $returned_title[] = array(
                        $_language->module['gallery'],
                        'index.php?site=gallery'
                    );
                    @$returned_title[] = array($groupID['name']);
                } elseif (isset($parameters['galleryID'])) {
                    $galleryID = mysqli_fetch_array(
                        safe_query(
                            "SELECT
                                galleryID, name, groupID
                            FROM
                                " . PREFIX . "plugins_gallery
                            WHERE
                                galleryID=" . (int)$galleryID
                        )
                    );
                    $groupname = mysqli_fetch_array(
                        safe_query(
                            "SELECT
                                name
                            FROM
                                " . PREFIX . "plugins_gallery_groups
                            WHERE
                                groupID=" . (int)$galleryID['groupID']
                        )
                    );
                    if (isset($groupname['name'])) {
                        $groupname['name'] = $_language->module['usergallery'];
                    } else {
                        $groupname['name'] = '';
                    }
                    /*if ($groupname['name'] == "") {
                        $groupname['name'] = $_language->module['usergallery'];
                    } else {
                        $groupname['name'] = "";
                    }*/
                    $returned_title[] = array(
                        $_language->module['gallery'],
                        'index.php?site=gallery'
                    );
                    $returned_title[] = array(
                        $groupname['name'],
                        'index.php?site=gallery&amp;galleryID=' . $galleryID['galleryID']
                    );
                    $returned_title[] = array($galleryID['name']);
                } elseif (isset($parameters['galleryID'])) {
                    $getgalleryname = mysqli_fetch_array(
                        safe_query(
                            "SELECT
                                gal.groupID,
                                gal.galleryID,
                                gal.name
                            FROM
                                " . PREFIX . "plugins_gallery AS pic,
                                " . PREFIX . "plugins_gallery AS gal
                            WHERE
                                pic.galleryID=" . (int)$parameters['galleryID'] . " AND
                                gal.galleryID=pic.galleryID"
                        )
                    );
                    $getgroupname = mysqli_fetch_array(
                        safe_query(
                            "SELECT
                                name
                            FROM
                                " . PREFIX . "plugins_gallery_groups
                            WHERE
                                groupID=" . (int)$getgalleryname['groupID']
                        )
                    );
                    if ($getgroupname['name'] == "") {
                        $getgroupname['name'] = $_language->module['usergallery'];
                    } else {
                    }
                    $picID = mysqli_fetch_array(
                        safe_query(
                            "SELECT
                                picID, galleryID, name
                            FROM
                                " . PREFIX . "plugins_gallery
                            WHERE
                                picID=" . (int)$picID
                        )
                    );
                    $returned_title[] = array(
                        $_language->module['gallery'],
                        'index.php?site=gallery'
                    );
                    $returned_title[] = array(
                        $getgalleryname['name'],
                        'index.php?site=gallery&amp;groupID=' . $getgalleryname['galleryID']
                    );
                    $returned_title[] = array($picID['name']);
                } else {
                    $returned_title[] = array($_language->module['gallery']);
                }
                break;

            case 'guestbook':
                $returned_title[] = array($_language->module['guestbook']);
                break;

            case 'history':
                $returned_title[] = array($_language->module['history']);
                break;

            case 'imprint':
                $returned_title[] = array($_language->module['imprint']);
                break;

            case 'joinus':
                $returned_title[] = array($_language->module['joinus']);
                break;

            case 'links':
                if (isset($parameters['linkcatID'])) {
                    $linkcatID = (int)$parameters['linkcatID'];
                } else {
                    $linkcatID = 0;
                }
                if (isset($parameters['linkID'])) {
                    $linkID = (int)$parameters['linkID'];
                } else {
                    $linkID = '';
                }
                $get = mysqli_fetch_array(
                    safe_query(
                        "SELECT linkcatname FROM `" . PREFIX . "plugins_links_categorys` WHERE linkcatID=" . (int)$linkcatID
                    )
                );
                $get2 = mysqli_fetch_array(
                    safe_query("SELECT question FROM `" . PREFIX . "plugins_links` WHERE linkID=" . (int)$linkID)
                );
                if ($action == "linkcat") {
                    $returned_title[] = array(
                        $_language->module['links'],
                        'index.php?site=links'
                    );
                    $returned_title[] = array($get['linkcatname']);
                } elseif ($action == "links") {
                    $returned_title[] = array(
                        $_language->module['links'],
                        'index.php?site=links'
                    );
                    $returned_title[] = array(
                        $get['linkcatname'],
                        'index.php?site=links&amp;action=linkcat&amp;linkcatID=' . $linkcatID
                    );
                    $returned_title[] = array($get2['question']);
                    $metadata['keywords'] = \webspell\Tags::getTags('links', $linkID);
                } else {
                    $returned_title[] = array($_language->module['links']);
                }
                break;    

            case 'linkus':
                $returned_title[] = array($_language->module['linkus']);
                break;

            case 'login':
                $returned_title[] = array($_language->module['login']);
                break;

            case 'loginoverview':
                $returned_title[] = array($_language->module['loginoverview']);
                break;

            case 'lostpassword':
                $returned_title[] = array($_language->module['lostpassword']);
                break;

            case 'members':
                if (isset($parameters['squadID'])) {
                    $squadID = (int)$parameters['squadID'];
                } else {
                    $squadID = '';
                }
                if ($action == "show") {
                    $get = mysqli_fetch_array(
                        safe_query("SELECT name FROM `" . PREFIX . "squads` WHERE squadID=" . (int)$squadID)
                    );
                    $returned_title[] = array(
                        $_language->module['members'],
                        'index.php?site=members'
                    );
                    $returned_title[] = array($get['name']);
                } else {
                    $returned_title[] = array($_language->module['members']);
                }
                break;

            case 'messenger':
                $returned_title[] = array($_language->module['messenger']);
                break;

            case 'myprofile':
                $returned_title[] = array($_language->module['myprofile']);
                break;

            case 'news':
                if ($action == "archive") {
                    $returned_title[] = array(
                        $_language->module['news'],
                        'index.php?site=news'
                    );
                    $returned_title[] = array($_language->module['archive']);
                } else {
                    $returned_title[] = array($_language->module['news']);
                }
                break;

            case 'news_contents':
                if (isset($parameters['rubricID'])) {
                    $rubricID = (int)$parameters['rubricID'];
                } else {
                    $rubricID = 0;
                }
                if (isset($parameters['newsID'])) {
                    $newsID = (int)$parameters['newsID'];
                } else {
                    $newsID = '';
                }
                $get = mysqli_fetch_array(
                    safe_query(
                        "SELECT rubric FROM `" . PREFIX . "plugins_news_rubrics` WHERE rubricID=" . (int)$rubricID)
                );
                $get2 = mysqli_fetch_array(
                    safe_query("SELECT headline FROM `" . PREFIX . "plugins_news` WHERE newsID=" . (int)$newsID)
                );
                if ($action == "newscat") {
                    $returned_title[] = array(
                        $_language->module['news'],
                        'index.php?site=news'
                    );
                    $returned_title[] = array($get['rubric']);
                } elseif ($action == "news") {
                    $returned_title[] = array(
                        $_language->module['news'],
                        'index.php?site=news'
                    );

                    $returned_title[] = array(
                        $get['rubric'],
                        'index.php?site=news_contents&amp;action=newscat&amp;rubricID=' . $rubricID 
                        
                    );
                    $returned_title[] = array($get2['headline']);
                    $metadata['keywords'] = \webspell\Tags::getTags('news', $newsID);
                } else {
                    $returned_title[] = array($_language->module['news']);
                    $returned_title[] = array($get2['headline']);
                   
                }
                break;

            case 'newsletter':
                $returned_title[] = array($_language->module['newsletter']);
                break;

            case 'partners':
                $returned_title[] = array($_language->module['partners']);
                break;

            case 'polls':
                if (isset($parameters['vote'])) {
                    $vote = (int)$parameters['vote'];
                } else {
                    $vote = '';
                }
                if (isset($parameters['pollID'])) {
                    $pollID = (int)$parameters['pollID'];
                } else {
                    $pollID = '';
                }
                if (isset($parameters['vote'])) {
                    $vote = mysqli_fetch_array(
                        safe_query("SELECT titel FROM " . PREFIX . "plugins_poll WHERE pollID=" . (int)$vote)
                    );
                    $returned_title[] = array(
                        $_language->module['polls'],
                        'index.php?site=polls'
                    );
                    $returned_title[] = array($vote['titel']);
                } elseif (isset($parameters['pollID'])) {
                    $pollID = mysqli_fetch_array(
                        safe_query("SELECT titel FROM " . PREFIX . "plugins_poll WHERE pollID=" . (int)$pollID)
                    );
                    $returned_title[] = array(
                        $_language->module['polls'],
                        'index.php?site=polls'
                    );
                    $returned_title[] = array($pollID['titel']);
                } else {
                    $returned_title[] = array($_language->module['polls']);
                }
                break;

            case 'profile':
                if (isset($parameters['id'])) {
                    $id = (int)$parameters['id'];
                } else {
                    $id = '';
                }
                $returned_title[] = array($_language->module['profile']);
                $returned_title[] = array(getnickname($id));
                break;

            case 'register':
                $returned_title[] = array($_language->module['register']);
                break;

            case 'userlist':
                $returned_title[] = array($_language->module['userlist']);
                break;

            case 'search':
                $returned_title[] = array($_language->module['search']);
                break;

            case 'servers':
                $returned_title[] = array($_language->module['servers']);
                break;

            case 'shoutbox':
                $returned_title[] = array($_language->module['shoutbox']);
                break;

            case 'sponsors':
                $returned_title[] = array($_language->module['sponsors']);
                break;

            case 'squads':
                if (isset($parameters['squadID'])) {
                    $squadID = (int)$parameters['squadID'];
                } else {
                    $squadID = '';
                }
                if ($action == "show") {
                    $get = mysqli_fetch_array(
                        safe_query("SELECT name FROM `" . PREFIX . "squads` WHERE squadID=" . (int)$squadID)
                    );
                    $returned_title[] = array(
                        $_language->module['squads'],
                        'index.php?site=squads'
                    );
                    $returned_title[] = array($get['name']);
                } else {
                    $returned_title[] = array($_language->module['squads']);
                }
                break;

            case 'static':
                if (isset($parameters['staticID'])) {
                    $staticID = (int)$parameters['staticID'];
                } else {
                    $staticID = '';
                }
                $get = mysqli_fetch_array(
                    safe_query("SELECT title FROM `" . PREFIX . "settings_static` WHERE staticID=" . (int)$staticID)
                );
                $returned_title[] = array($get['title']);
                $metadata['keywords'] = \webspell\Tags::getTags('static', $staticID);
                break;

            case 'usergallery':
                $returned_title[] = array($_language->module['usergallery']);
                break;
# neu Anfang
            case 'todo':
                $returned_title[] = array($_language->module['todo']);
                break;

            case 'news_archive':
                $returned_title[] = array($_language->module['news_archive']);
                break; 

            case 'privacy_policy':
                $returned_title[] = array($_language->module['privacy_policy']);
                break;

            case 'candidature':
                $returned_title[] = array($_language->module['candidature']);
                break; 

            case 'twitter':
                $returned_title[] = array($_language->module['twitter']);
                break; 

            case 'discord':
                $returned_title[] = array($_language->module['discord']);
                break;
                
            case 'portfolio':
                $returned_title[] = array($_language->module['portfolio']);
                break;
                
            case 'streams':
                $returned_title[] = array($_language->module['streams']);
                break;
                
            case 'server_rules':
                $returned_title[] = array($_language->module['server_rules']);
                break; 
                
            case 'clan_rules':
                $returned_title[] = array($_language->module['clan_rules']);
                break;
                

            case 'videos':
                if (isset($parameters['videoscatID'])) {
                    $videoscatID = (int)$parameters['videoscatID'];
                } else {
                    $videoscatID = 0;
                }
                if (isset($parameters['videosID'])) {
                    $videosID = (int)$parameters['videosID'];
                } else {
                    $videosID = '';
                }
                $get = mysqli_fetch_array(
                    safe_query(
                        "SELECT catname FROM `" . PREFIX . "plugins_videos_categories` WHERE videoscatID=" . (int)$videoscatID
                    )
                );
                $get2 = mysqli_fetch_array(
                    safe_query("SELECT videoname FROM `" . PREFIX . "plugins_videos` WHERE videosID=" . (int)$videosID)
                );
                if ($action == "watch") {
                    $returned_title[] = array(
                        $_language->module['videos'],
                        'index.php?site=videos'
                    );
                    #$returned_title[] = array($get['catname']);
                } elseif ($action == "videos") {
                    $returned_title[] = array(
                        $_language->module['videos'],
                        'index.php?site=videos'
                    );
                    $returned_title[] = array(
                        $get['catname'],
                        'index.php?site=videos&amp;action=watch&amp;videoscatID=' . $videoscatID
                    );
                    $returned_title[] = array($get2['videoname']);
                    $metadata['keywords'] = \webspell\Tags::getTags('videos', $videosID);
                } else {
                    $returned_title[] = array($_language->module['videos']);
                    #$returned_title[] = array($get2['videoname']);
                }
                break; 


            case 'blog':
                if (isset($parameters['blogID'])) {
                    $blogID = (int)$parameters['blogID'];
                } else {
                    $blogID = 0;
                }
                $get2 = mysqli_fetch_array(
                    safe_query(
                        "SELECT headline FROM `" . PREFIX . "plugins_blog` WHERE blogID=" . (int)$blogID)
                    );
                if ($action == "show") {
                    $get = mysqli_fetch_array(
                        safe_query("SELECT headline FROM `" . PREFIX . "plugins_blog` WHERE blogID=" . (int)$blogID)
                    );
                    $returned_title[] = array(
                        $_language->module['blog'],
                        'index.php?site=blog'
                    );
                    $returned_title[] = array($get['headline']);

                } elseif ($action == "blog") {
                    $returned_title[] = array(
                        $_language->module['blog'],
                        'index.php?site=blog'
                    );

                    $returned_title[] = array(
                        $_language->module['blog'],
                        'index.php?site=blog&amp;action=archiv'
                    );

                    $returned_title[] = array(
                        $_language->module['blog'],
                        'index.php?site=blog&amp;action=show&amp;blogID=' . $blogID
                    );

                    $returned_title[] = array(
                        $_language->module['blog'],
                        'index.php?site=blog&amp;action=archiv&amp;userID=' . $userID
                    );

                    $returned_title[] = array($get['headline']);
                    $returned_title[] = array($_language->module['archive']);
                } else {
                    $returned_title[] = array($_language->module['blog']);
                    $returned_title[] = array($_language->module['archive']);
                }
                break;              
# neu ENDE
            case 'whoisonline':
                $returned_title[] = array($_language->module['whoisonline']);
                break;

            default:
                $returned_title[] = array($_language->module['news']);
                break;
        }
    } else {
        $returned_title[] = array($_language->module['news']);
    }
    return array('titles' => $returned_title, 'metatags' => $metadata);
}
