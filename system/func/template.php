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

namespace webspell;

class Template
{
    private $rootFolder;

    /**
    * @param string $rootFolder base folder where the template files are located
    */
    public function __construct($rootFolder = "templates")
    {
        $this->rootFolder = $rootFolder;
    }

    /**
    * returns the content of a template file
    *
    * @param string $template name of the template
    *
    * @return string content of the template
    * @throws \Exception when the file is not found
    */
    private function loadFile($template)
    {
        $file = $this->rootFolder . "/" . $template . ".html";
        if (file_exists($file)) {
            return file_get_contents($file);
        } else {
            throw new \Exception("Unknown Template File " . $file, 1);
        }
    }
    private function load_html($template, $content, $path=false)
    {
		if($path!=false) { $file = $path . "templates/" . $template . ".html"; } else { $file = $this->rootFolder . "/" . $template . ".html"; }
        
        if (file_exists($file)) {
			$lo = file_get_contents($file);
			$a = explode("<!-- ".$template."_".$content." -->", $lo);
			$b = explode("<!-- END -->", $a[1]);
			return $b[0];
        } else {
            throw new \Exception("Unknown Template File " . $file, 1);
        }
    }

    /**
    * Replace all keys of data with its values in the string
    * Longer keys are replaced first (users before user)
    *
    * @param string $template
    * @param array  $data
    *
    * @return string
    */
    private function replace($template, $data = array())
    {
        return strtr($template, $data);
    }

    /**
    * Replace a single template with one set of data and translate all language keys
    *
    * @param string $template name of a template
    * @param array  $data data which gets replaced
    *
    * @return string
    * @throws \Exception
    */
    public function replaceTemplate($template, $data = array())
    {
        $templateString = $this->loadFile($template);
        $templateTranslated = $this->replaceLanguage($templateString);
        return $this->replace($templateTranslated, $data);
    }
    public function loadTemplate($template, $content, $data = array(), $path=false)	# v1.1
    {
		if($path!=false) { $newpath=$path; } else { $newpath=false; }
        $templateString = $this->load_html($template, $content, $newpath);
        $templateTranslated = $this->replaceLanguage($templateString);
        return $this->replace($templateTranslated, $data);
    }
    /**
    * Replaces all language variables which are available
    *
    * @param string $template content of a template
    *
    * @return string
    */
    private function replaceLanguage($template)
    {
        return $this->replace($template, $GLOBALS[ '_language' ]->getTranslationTable());
    }

    /**
    * Return the content of one template evaluated multiple times
    * languagekeys are only translated once
    *
    * @param string $template name of the template
    * @param array  $datas multidimensional array with data for every replacements
    *
    *
    * @return string
    * @throws \Exception
    */
    public function replaceMulti($template, &$datas = array())
    {
        if (!is_array($datas) || !isset($datas[ 0 ]) || !is_array($datas[ 0 ])) {
            throw new \Exception("No multidimensional data given", 2);
        }

        $templateString = $this->loadFile($template);

        $templateBase = $this->replaceLanguage($templateString);

        $return = '';
        foreach ($datas as $data) {
            $return .= $this->replace($templateBase, $data);
        }
        unset($datas);
        return $return;
    }
}
