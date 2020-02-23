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
function generate_rss2()
{
    global $hp_url, $hp_title;
    global $rss_default_language;
    $_language = new \webspell\Language();
    $_language->setLanguage($rss_default_language);
    $_language->readModule('feeds');
    $date = safe_query(
        "SELECT `date` FROM `" . PREFIX . "plugins_news` WHERE `displayed` = 1  ORDER BY `date` DESC LIMIT 0,1"
    );
    if (mysqli_num_rows($date)) {
        $date = mysqli_fetch_assoc($date);
        $updated = $date['date'];
    } else {
        $updated = time();
    }
    $xmlstring = '<?xml version="1.0" encoding="UTF-8"?>
                <rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
                    <channel>
                        <title>' . $hp_title . ' ' . $_language->module['news_feed'] . '</title>
                        <link>' . $hp_url . '</link>
                        <atom:link href="' . $hp_url . '/tmp/rss.xml" rel="self" type="application/rss+xml" />
                        <description>' . $_language->module['latest_news_from'] . ' http://' . $hp_url . '</description>
                        <language>' . $rss_default_language . '-' . $rss_default_language . '</language>
                        <pubDate>' . date('D, d M Y h:i:s O', $updated) . '</pubDate>';
    $db_news = safe_query(
        "SELECT * FROM `" . PREFIX . "plugins_news` WHERE `displayed` = 1  ORDER BY `date` DESC LIMIT 0,10"
    );
    $any_news = mysqli_num_rows($db_news);
    if ($any_news) {
        while ($newscontent = mysqli_fetch_array($db_news)) {
            if ($any_news) {
                $xmlstring .= '<item>
                <title>' . htmlspecialchars(($newscontent['headline'])) . '</title>
                <description><![CDATA[' . $newscontent['content'] . ']]></description>
                <author>' .
                    getemail($newscontent['poster']) . ' (' .
                    getfirstname($newscontent['poster']) . ' ' .
                    getlastname($newscontent['poster']) . ')' .
                '</author>
                <guid>
                    <![CDATA[' . $hp_url . '/index.php?site=news_contents&newsID=' .
                    $newscontent['newsID'] . ']]>
                </guid>
                <link>
                    <![CDATA[' . $hp_url . '/index.php?site=news_contents&newsID=' .
                    $newscontent['newsID'] . ']]>
                </link>
                </item>';
            } else {
                continue;
            }
        }
    }
    $xmlstring .= '</channel></rss>';
    $rss_xml = fopen("./tmp/rss.xml", "w");
    fwrite($rss_xml, $xmlstring);
    fclose($rss_xml);
}
