<?php
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