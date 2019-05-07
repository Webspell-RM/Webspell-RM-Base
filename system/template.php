<?php

class template {

    public $themes_path = "../../includes/themes/default/";	// TODO: not default here, get the current activated theme
    public $template_path = "templates/";

    public function __construct($themes_path = "includes/themes/default/", $template_path = "templates/") {
        $this->themes_path = $themes_path;
        $this->template_path = $template_path;
    }

    public function loadTemplate($file, $content, $replaces) {

        $html_file_path = $this->themes_path . $this->template_path . $file . ".html";
        if (!file_exists($html_file_path)) {
            throw new \Exception("Unknown Template File " . $html_file_path, 0);
        }

        $file_content = file_get_contents($html_file_path);
        $a = @explode("<!-- " . $file . "_" . $content . " -->", $file_content);
        $b = @explode("<!-- END -->", $a[1]);
        return $temp = strtr($b[0], $replaces);

    }

}
