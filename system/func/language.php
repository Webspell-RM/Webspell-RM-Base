<?php
/*¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯\
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
\__________________________________________________________________*/
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
            $langFolder = './'.$this->language_path;
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
