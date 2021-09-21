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

 /*
 * staticLanguageDetection
 *
 * (c) Matti W. <getschonnik@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * https://github.com/Getschonnik/class_detectStaticLanguage/blob/master/LICENSE
 */
class multiLanguage {
	
	public $language;
	public $availableLanguages = array();
	
	public function __construct($lang) {
		$this->language = $lang;
	}
	
	// detect languages 
	public function detectLanguages($text) {
		$sox = explode('{[',$text);
		for($a=0; $a<count($sox);$a++) {
			$eox = explode(']}', $sox[$a]);
			if(!in_array($eox[0], $this->availableLanguages)) {
				if(!empty($eox[0])) {
					$this->availableLanguages[] = $eox[0];
				}
			}
		}
	}	
	
	// Get only the selected language text
	public function getTextByLanguage($text) {
		if(in_array($this->language, $this->availableLanguages)) {
			$output = "";
			$fix = explode('{['.$this->language.']}', $text);
			for($b=0; $b<count($fix); $b++) {
				$tmp = explode('{[', $fix[$b]);
				$output .= $tmp[0];
			}
			return $output;
		} elseif(!empty($this->availableLanguages)) {
			// if the string contains language tags but not the selected language
			// so get another language. Otherwise it wont print an output.
			$output = "";
			 $language =$this->availableLanguages[0];
			$fix = explode('{['.$language.']}', $text);
			for($b=0; $b<count($fix); $b++) {
				$tmp = explode('{[', $fix[$b]);
				$output .= $tmp[0];
			}
			return $output;
		} else {
			return $text;
		}
	}
	
}
?>