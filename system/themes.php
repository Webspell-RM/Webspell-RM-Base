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
 * THEME MANAGER v0.1 // written by Matti 'Getschonnik' W. // www.webSPELL-NOR.de
 *
 * jSON-DATA
 * %name					// test-theme
 * %description				// A dummy template
 * %license					// GnuGPL 3.0
 * %version					// 0.1
 * %author					// Matti 'Getschonnik' W.
 * %website					// www.webSPELL-NOR.de
 * %path					// themes/test-theme/
 *
 * %head_css				// first.css, second.css
 * %head_js					// first.js, second.js
 * %
 *
*/

class theme {
	
	public function get_active_theme() {

			$get = safe_query("SELECT * FROM `".PREFIX."settings_themes` WHERE `active` = 1");
			if(mysqli_num_rows($get) == '1') {
	        $ds = mysqli_fetch_array($get);
	    
	        $theme_path = "includes/themes/".$ds['name']."/";
	    } else {
	        $theme_path = "includes/themes/404/";
	    }
	    return $theme_path;

	}
}