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
