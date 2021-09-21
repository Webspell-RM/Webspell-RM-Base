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

    if (isset($_GET[ 'new_lang' ])) {
    if (file_exists('languages/' . $_GET[ 'new_lang' ])) {




        $lang = preg_replace("[^a-z]", "", $_GET[ 'new_lang' ]);
        $_SESSION[ 'language' ] = $lang;
        if ($userID) {
            safe_query("UPDATE " . PREFIX . "user SET language='" . $lang . "' WHERE userID='" . $userID . "'");
        }
    }

    if (isset($_GET[ 'query' ])) {
        $query = rawurldecode($_GET[ 'query' ]);
        header("Location: ./" . $query);
        
    } else {
        header("Location: index.php");
    }
} else {
    $_language->readModule('index');

        #$template = $tpl->loadTemplate("navigation","language_head", $data_array);
        #echo $template;

        #$template = $tpl->loadTemplate("navigation","language_content_head", $data_array);
        #echo $template;

    $filepath = "languages/";
    $langs = array();
    

    if ($dh = opendir($filepath)) {
        while ($file = mb_substr(readdir($dh), 0, 2)) {
            if ($file != "." && $file != ".." && is_dir($filepath . $file)) {
                if (isset($mysql_langs[ $file ])) {
                    $name = $mysql_langs[ $file ];
                    $name = ucfirst($name);
                    $langs[ $name ] = $file;
                } else {
                    $langs[ $file ] = $file;
                }
            }
        }
        closedir($dh);
    }
    if (defined("SORT_NATURAL")) {
        $sortMode = SORT_NATURAL;
    } else {
        $sortMode = SORT_LOCALE_STRING;
    }
    ksort($langs, $sortMode);

    $querystring = '';
    if ($modRewrite === true) {
        $path = rawurlencode(str_replace($GLOBALS[ 'rewriteBase' ], '', $_SERVER[ 'REQUEST_URI' ]));

    } else {
        $path = rawurlencode($_SERVER[ 'QUERY_STRING' ]);
        if (!empty($path)) {
            $path = "?".$path;
        }
    }
    if (!empty($path)) {
        $querystring = "&amp;query=" . $path;
    }

        

    foreach ($langs as $lang => $flag) {
        
        
        }


            $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings WHERE de_lang='1'"));
                if (@$dx[ 'de_lang' ] != '1') {
                    $de_languages = '';
                } else {
                    $de_languages = '<a href="index.php?new_lang=de'. $querystring . '" data-toggle="tooltip" title="' . $index_language[ 'de' ] . '"><img class="flag" src="images/languages/de.png" alt="de"></a>';
                };

                $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings WHERE en_lang='1'"));
                if (@$dx[ 'en_lang' ] != '1') {
                    $en_languages = '';
                } else {
                    $en_languages = '<a href="index.php?new_lang=en'. $querystring . '" data-toggle="tooltip" title="' . $index_language[ 'en' ] . '"><img class="flag" src="images/languages/en.png" alt="en"></a>';
                };

                $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings WHERE it_lang='1'"));
                if (@$dx[ 'it_lang' ] != '1') {
                    $it_languages = '';
                } else {
                    $it_languages = '<a href="index.php?new_lang=it'. $querystring . '" data-toggle="tooltip" title="' . $index_language[ 'it' ] . '"><img class="flag" src="images/languages/it.png" alt="it"></a>';
                };
                $dx = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings WHERE pl_lang='1'"));
                if (@$dx[ 'pl_lang' ] != '1') {
                    $pl_languages = '';
                } else {
                    $pl_languages = '<a href="index.php?new_lang=pl'. $querystring . '" data-toggle="tooltip" title="' . $index_language[ 'pl' ] . '"><img class="flag" src="images/languages/pl.png" alt="pl"></a>';
                };

            echo '<li class="list-group-item language">'.$de_languages.' '.$en_languages.' '.$it_languages.' '.$pl_languages.'</li>';



        #$template = $tpl->loadTemplate("navigation","language_content_foot", $data_array);
        #echo $template;    
        
    

        #$template = $tpl->loadTemplate("navigation","language_foot", $data_array);
        #echo $template;
}
