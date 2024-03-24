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
class Language
{
    public $language = 'en';
    public $module = array();
    private $language_path = 'languages/';
    public function setLanguage($to, $admin = false, $pluginpath=false)
    {
        if ($admin) {
            $this->language_path = '../'.$this->language_path;
        }
        if ($pluginpath) {
            $this->language_path = $pluginpath.$this->language_path;
        }
        $langs = array();
        foreach (new \DirectoryIterator($this->language_path) as $fileInfo) {
            if ($fileInfo->isDot() === false && $fileInfo->isDir() === true) {
                $langs[ ] = $fileInfo->getFilename();
            }
        }
        if (in_array($to, $langs)) {
            $this->language = $to;
            $this->language_path = 'languages/';
            return true;
        } else {
            return false;
        }
    }
    public function getRootPath()
    {
        return $this->language_path;
    }
    public function readModule($module, $add = false, $admin = false, $pluginpath=false)
    {
        global $default_language;
        if ($admin) {
            $langFolder = '../'.$this->language_path;
            $folderPath = '%s%s/admin/%s.php';
        } elseif ($pluginpath) {
            $langFolder = $pluginpath.$this->language_path;
            $folderPath = '%s%s/%s.php';
        } else {
            $langFolder = $this->language_path;
            $folderPath = '%s%s/%s.php';
        }
        $languageFallbackTable = array(
                            $this->language,
                            $default_language,
                            'en');
        $module = str_replace(array('\\', '/', '.'), '', $module);
        foreach ($languageFallbackTable as $folder) {
            $path = sprintf($folderPath, $langFolder, $folder, $module);
            if (file_exists($path)) {
                $module_file = $path;
                break;
            }
        }
        if (!isset($module_file)) {
            return false;
        }
        if (isset($module_file)) {
            include($module_file);
            if (!$add) {
                $this->module = array();
            }
            foreach ($language_array as $key => $val) {
                $this->module[ $key ] = $val;
            }
        }
        return true;
    }
    public function replace($template)
    {
        foreach ($this->module as $key => $val) {
            $template = str_replace('%' . $key . '%', $val, $template);
        }
        return $template;
    }
    public function getTranslationTable()
    {
        $map = array();
        foreach ($this->module as $key => $val) {
            $newKey = '%' . $key . '%';
            $map[ $newKey ] = $val;
        }
        return $map;
    }
}
?>