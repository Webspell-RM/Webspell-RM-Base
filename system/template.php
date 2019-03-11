<?php

class template {
	
	public $themes_path = "../../includes/themes/default/";	// TODO: not default here, get the current activated theme 
	public $template_path = "templates/";
	
	public function __construct($value1="includes/themes/default/", $value2="templates/") {
        $this->themes_path = $value1;
        $this->template_path = $value2;
    }

	public function loadTemplate($file, $content, $replaces) {
		$thp = $this->themes_path;
		$tep = $this->template_path;
		if(file_exists($thp.$tep.$file.".html")) {
			$file_content = file_get_contents($thp.$tep.$file.".html");
			$a = @explode("<!-- ".$file."_".$content." -->", $file_content);
			$b = @explode("<!-- END -->", $a[1]);
			return $temp = strtr($b[0], $replaces); 
		} else {
			throw new \Exception("Unknown Template File " . $file, 0);
		}
		
	} 
	
	
}



























?>