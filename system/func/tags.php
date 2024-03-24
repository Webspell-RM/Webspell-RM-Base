<?php
/**
 *¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
 *                  Webspell-RM      /                        /   /                                          *
 *                  -----------__---/__---__------__----__---/---/-----__---- _  _ -                         *
 *                   | /| /  /___) /   ) (_ `   /   ) /___) /   / __  /     /  /  /                          *
 *                  _|/_|/__(___ _(___/_(__)___/___/_(___ _/___/_____/_____/__/__/_                          *
 *                               Free Content / Management System                                            *
 *                                           /                                                               *
 *¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
 * @version         webspell-rm                                                                              *
 *                                                                                                           *
 * @copyright       2018-2023 by webspell-rm.de                                                              *
 * @support         For Support, Plugins, Templates and the Full Script visit webspell-rm.de                 *
 * @website         <https://www.webspell-rm.de>                                                             *
 * @forum           <https://www.webspell-rm.de/forum.html>                                                  *
 * @wiki            <https://www.webspell-rm.de/wiki.html>                                                   *
 *                                                                                                           *
 *¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
 * @license         Script runs under the GNU GENERAL PUBLIC LICENCE                                         *
 *                  It's NOT allowed to remove this copyright-tag                                            *
 *                  <http://www.fsf.org/licensing/licenses/gpl.html>                                         *
 *                                                                                                           *
 *¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
 * @author          Code based on WebSPELL Clanpackage (Michael Gruber - webspell.at)                        *
 * @copyright       2005-2011 by webspell.org / webspell.info                                                *
 *                                                                                                           *
 *¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
*/

namespace webspell;

class Tags
{
    public static function setTags($relType, $relID, $tags)
    {
        self::removeTags($relType, $relID);
        if (is_string($tags)) {
            $tags = explode(",", $tags);
        }
        $tags = array_map("trim", $tags);
        $tags = array_unique($tags);
        $values = array();
        foreach ($tags as $tag) {
            if (!empty($tag)) {
                $values[] = '("' . $tag . '","' . $relType . '","' . $relID . '")';
            }
        }
        if (count($values)) {
            safe_query("INSERT INTO " . PREFIX . "tags (tag, rel, ID) VALUES " . implode(",", $values));
        }
    }

    public static function getTags($relType, $relID, $asArray = false)
    {
        $tags = array();
        $get = safe_query("SELECT * FROM " . PREFIX . "tags WHERE rel='" . $relType . "' AND ID='" . $relID . "'");
        while ($ds = mysqli_fetch_assoc($get)) {
            $tags[] = $ds['tag'];
        }
        $tags = array_unique($tags);
        return ($asArray === true) ? $tags : implode(", ", $tags);
    }

    public static function getTagsLinked($relType, $relID)
    {
        $tags = array();
        foreach (self::getTags($relType, $relID, true) as $tag) {
            $tags[] = '<a href="index.php?site=tags&amp;tag=' . $tag . '">' . $tag . '</a>';
        }
        return implode(", ", $tags);
    }

    public static function getTagsPlain($array = false)
    {
        $tags = array();
        $get = safe_query("SELECT * FROM " . PREFIX . "tags");
        while ($ds = mysqli_fetch_assoc($get)) {
            if (!empty($ds['tag'])) {
                $tags[] = $ds['tag'];
            }
        }
        $tags = array_unique($tags);
        return ($array === true) ? $tags : implode(", ", $tags);
    }

    public static function getTagCloud()
    {
        $get = safe_query("SELECT tag, COUNT(ID) AS `count` FROM " . PREFIX . "tags GROUP BY tag");
        $data = array();
        $data['min'] = 999999999999;
        $data['max'] = 0;
        $data['tags'] = array();
        while ($ds = mysqli_fetch_assoc($get)) {
            $data['tags'][] = array('name' => $ds['tag'], 'count' => $ds['count']);
            $data['min'] = min($data['min'], $ds['count']);
            $data['max'] = max($data['max'], $ds['count']);
        }
        return $data;
    }

    public static function removeTags($relType, $relID)
    {
        safe_query("DELETE FROM " . PREFIX . "tags WHERE rel='" . $relType . "' AND ID='" . $relID . "'");
    }

    public static function getTagSizeLogarithmic($count, $mincount, $maxcount, $minsize, $maxsize, $tresholds)
    {
        if (!is_int($tresholds) || $tresholds < 2) {
            $tresholds = $maxsize - $minsize;
            $treshold = 1;
        } else {
            $treshold = ($maxsize - $minsize) / ($tresholds - 1);
        }
        $a = $tresholds * log($count - $mincount + 2) / log($maxcount - $mincount + 2) - 1;
        return round($minsize + round($a) * $treshold);
    }

    public static function getNews($newsID)
    {
        global $userID;
        $result = safe_query(
            "SELECT
                *,
                content,
                headline
            FROM
                " . PREFIX . "plugins_news
            
            WHERE
                newsID = " . (int)$newsID
        );
        if ($result->num_rows) {
            $ds = mysqli_fetch_array($result);
            $content = $ds['content'];
            if (strlen($ds['content']) > 255) {
                $string = wordwrap($ds['content'], 255);
                $string = substr($ds['content'], 0, strpos($ds['content'], "\n")) . '...';
            } else {
                $string = $ds['content'];
            }

            $_language = new \webspell\Language();
            $_language->readModule('tags');    
            return array(
                'date' => time(),
                'type' => 'News',
                'content' => $string,
                'title' => $ds['headline'],
                'link' => 'index.php?site=news_manager&action=news_contents&amp;newsID=' . $newsID,
                'cat' => $_language->module['news'],
                'link_cat' => $_language->module['news_link']
            );
        } else {
            return false;
        }
    }

    public static function getArticle($articleID)
    {
        global $userID;
        
        $get = safe_query(
            "SELECT
                articleID,
                articlecatID,
                date,
                question,
                answer
            FROM
                " . PREFIX . "plugins_articles
            WHERE
                articleID = " . (int)$articleID 
        );
        if ($get->num_rows) {
            $ds = mysqli_fetch_array($get);
            $answer = $ds['answer'];
            if (mb_strlen($answer) > 255) {
                $string = wordwrap($answer, 255);
                $string = substr($answer, 0, strpos($answer, "\n")) . '...';
            } else {
                $string = $answer;
            }

            $_language = new \webspell\Language();
            $_language->readModule('tags');
            return array(
                'date' => $ds['date'],
                'type' => 'Artikel',
                'content' => $string,
                'title' => $ds['question'],
                'link' => 'index.php?site=articles&action=watch&articleID=' . $articleID,
                'cat' => $_language->module['articles'],
                'link_cat' => $_language->module['articles_link']
            );
        } else {
            return false;
        }
    }


    public static function getStaticPage($staticID)
    {
        global $userID;
        $get = safe_query("SELECT * FROM " . PREFIX . "settings_static WHERE staticID='" . $staticID . "'");
        if ($get->num_rows) {
            $ds = mysqli_fetch_array($get);
            $allowed = false;
            switch ($ds['accesslevel']) {
                case 0:
                    $allowed = true;
                    break;
                case 1:
                    if ($userID) {
                        $allowed = true;
                    }
                    break;
                case 2:
                    if (isclanmember($userID)) {
                        $allowed = true;
                    }
                    break;
            }
            if ($allowed) {
                if (strlen($ds['content']) > 255) {
                    $string = wordwrap($ds['content'], 255);
                    $string = substr($ds['content'], 0, strpos($ds['content'], "\n")) . '...';
                } else {
                    $string = $ds['content'];
                }

                $_language = new \webspell\Language();
                $_language->readModule('tags');
                return array(
                    'date' => time(),
                    'type' => 'StaticPage',
                    'content' => $string,
                    'title' => $ds['title'],
                    'link' => 'index.php?site=static&amp;staticID=' . $staticID,
                    'cat' => $_language->module['static'],
                    'link_cat' => $_language->module['static_link']
                );
            } else {
                return false;
            }
        } else {
            return false;
        }
    }


    public static function getFaq($faqID)
    {
        global $userID;
        $get = safe_query(
            "SELECT
                `faqID`,
                `faqcatID`,
                `date`,
                `question`,
                `answer`
            FROM
                `" . PREFIX . "plugins_faq`
            WHERE
                `faqID` = " . (int)$faqID
        );
        if ($get->num_rows) {
            $ds = mysqli_fetch_array($get);
            $answer = $ds['answer'];
            if (mb_strlen($answer) > 255) {
                $string = wordwrap($answer, 255);
                $string = substr($answer, 0, strpos($answer, "\n")) . '...';
            } else {
                $string = $answer;
            }

            $_language = new \webspell\Language();
            $_language->readModule('tags');
            return array(
                'date' => $ds['date'],
                'type' => 'FAQ',
                'content' => $string,
                'title' => $ds['question'],
                'link' => 'index.php?site=faq&amp;action=faq&amp;faqID=' . $ds['faqID'] . '&amp;faqcatID=' . $ds['faqcatID'],
                'cat' => $_language->module['faq'],
                'link_cat' => $_language->module['faq_link']
            );
        } else {
            return false;
        }
    }

    public static function sortByDate($tag1, $tag2)
    {
        if ($tag1['date'] == $tag2['date']) {
            return 0;
        } else {
            return ($tag1['date'] < $tag2['date']) ? 1 : -1;
        }
    }
}
