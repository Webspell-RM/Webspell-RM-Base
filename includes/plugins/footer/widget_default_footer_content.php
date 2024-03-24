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
# Sprachdateien aus dem Plugin-Ordner laden
	$pm = new plugin_manager(); 
	$plugin_language = $pm->plugin_language("footer", $plugin_path);

GLOBAL $myclanname;    

$sortierung = 'socialID ASC'; 

$ergebnis = safe_query("SELECT * FROM `".PREFIX."settings_social_media` ORDER BY $sortierung");
if(mysqli_num_rows($ergebnis)){
	while ($db = mysqli_fetch_array($ergebnis)) {

        if ($db[ 'twitch' ] != '') {
            $twitch = '<a href="' . htmlspecialchars($db[ 'twitch' ]) . '" target="_blank" rel="nofollow"><i class="bi bi-twitch"></i></a>';
        } else {
            $twitch = 'n_a';
        }

        if ($db[ 'facebook' ] != '') {
            $facebook = '<a href="' . htmlspecialchars($db[ 'facebook' ]) . '" target="_blank" rel="nofollow"><i class="bi bi-facebook"></i></a>';
        } else {
            $facebook = 'n_a';
        }

        if ($db[ 'twitter' ] != '') {
            $twitter = '<a href="' . htmlspecialchars($db[ 'twitter' ]) . '" target="_blank" rel="nofollow"><i class="bi bi-twitter"></i></a>';
        } else {
            $twitter = 'n_a';
        }

        if ($db[ 'youtube' ] != '') {
            $youtube = '<a href="' . htmlspecialchars($db[ 'youtube' ]) . '" target="_blank" rel="nofollow"><i class="bi bi-youtube"></i></a>';
        } else {
            $youtube = 'n_a';
        }

        if ($db[ 'rss' ] != '') {
            $rss = '<a href="' . htmlspecialchars($db[ 'rss' ]) . '" target="_blank" rel="nofollow"><i class="bi bi-rss"></i></a>';
        } else {
            $rss = 'n_a';
        }

        if ($db[ 'vine' ] != '') {
            $vine = '<a href="' . htmlspecialchars($db[ 'vine' ]) . '" target="_blank" rel="nofollow"><svg style="fill: rgba(var(--bs-link-color),1);margin-top: -4px;" xmlns="http://www.w3.org/2000/svg" height="13" width="12" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path d="M384 254.7v52.1c-18.4 4.2-36.9 6.1-52.1 6.1-36.9 77.4-103 143.8-125.1 156.2-14 7.9-27.1 8.4-42.7-.8C137 452 34.2 367.7 0 102.7h74.5C93.2 261.8 139 343.4 189.3 404.5c27.9-27.9 54.8-65.1 75.6-106.9-49.8-25.3-80.1-80.9-80.1-145.6 0-65.6 37.7-115.1 102.2-115.1 114.9 0 106.2 127.9 81.6 181.5 0 0-46.4 9.2-63.5-20.5 3.4-11.3 8.2-30.8 8.2-48.5 0-31.3-11.3-46.6-28.4-46.6-18.2 0-30.8 17.1-30.8 50 .1 79.2 59.4 118.7 129.9 101.9z"/></svg></a>';
        } else {
            $vine = 'n_a';
        }

        if ($db[ 'flickr' ] != '') {
            $flickr = '<a href="' . htmlspecialchars($db[ 'flickr' ]) . '" target="_blank" rel="nofollow"><svg style="fill: rgba(var(--bs-link-color),1);margin-top: -4px;" xmlns="http://www.w3.org/2000/svg" height="13" width="12" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path d="M400 32H48C21.5 32 0 53.5 0 80v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V80c0-26.5-21.5-48-48-48zM144.5 319c-35.1 0-63.5-28.4-63.5-63.5s28.4-63.5 63.5-63.5 63.5 28.4 63.5 63.5-28.4 63.5-63.5 63.5zm159 0c-35.1 0-63.5-28.4-63.5-63.5s28.4-63.5 63.5-63.5 63.5 28.4 63.5 63.5-28.4 63.5-63.5 63.5z"/></svg></a>';
        } else {
            $flickr = 'n_a';
        }

        if ($db[ 'linkedin' ] != '') {
            $linkedin = '<a href="' . htmlspecialchars($db[ 'linkedin' ]) . '" target="_blank" rel="nofollow"><i class="bi bi-linkedin-in"></i></a>';
        } else {
            $linkedin = 'n_a';
        }

        if ($db[ 'instagram' ] != '') {
            $instagram = '<a href="' . htmlspecialchars($db[ 'instagram' ]) . '" target="_blank" rel="nofollow"><i class="bi bi-instagram"></i></a>';
        } else {
            $instagram = 'n_a';
        }

$since = $db[ 'since' ];
   


if($db[ 'socialID'] == 1){   
$ergebnis = safe_query("SELECT * FROM `".PREFIX."plugins_footer`");
if(mysqli_num_rows($ergebnis)){
    while ($ds = mysqli_fetch_array($ergebnis)) {

        $settings = safe_query("SELECT * FROM " . PREFIX . "plugins_footer_target");
        $db = mysqli_fetch_array($settings);

        if ($db[ 'windows1' ]) {
            $windows1 = '';
        } else {
            $windows1 = 'target="_blank"';
        }

        if ($db[ 'windows2' ]) {
            $windows2 = '';
        } else {
            $windows2 = 'target="_blank"';
        }

        if ($db[ 'windows3' ]) {
            $windows3 = '';
        } else {
            $windows3 = 'target="_blank"';
        }

        if ($db[ 'windows4' ]) {
            $windows4 = '';
        } else {
            $windows4 = 'target="_blank"';
        }
        
        if ($db[ 'windows5' ]) {
            $windows5 = '';
        } else {
            $windows5 = 'target="_blank"';
        }

        if ($db[ 'windows6' ]) {
            $windows6 = '';
        } else {
            $windows6 = 'target="_blank"';
        }

        if ($db[ 'windows7' ]) {
            $windows7 = '';
        } else {
            $windows7 = 'target="_blank"';
        }

        if ($db[ 'windows8' ]) {
            $windows8 = '';
        } else {
            $windows8 = 'target="_blank"';
        }

        if ($db[ 'windows9' ]) {
            $windows9 = '';
        } else {
            $windows9 = 'target="_blank"';
        }

        if ($db[ 'windows10' ]) {
            $windows10 = '';
        } else {
            $windows10 = 'target="_blank"';
        }

        if ($db[ 'windows11' ]) {
            $windows11 = '';
        } else {
            $windows11 = 'target="_blank"';
        }

        if ($db[ 'windows12' ]) {
            $windows12 = '';
        } else {
            $windows12 = 'target="_blank"';
        }

        if ($db[ 'windows13' ]) {
            $windows13 = '';
        } else {
            $windows13 = 'target="_blank"';
        }

        if ($db[ 'windows14' ]) {
            $windows14 = '';
        } else {
            $windows14 = 'target="_blank"';
        }

        if ($db[ 'windows15' ]) {
            $windows15 = '';
        } else {
            $windows15 = 'target="_blank"';
        }

        if ($db[ 'windows16' ]) {
            $windows16 = '';
        } else {
            $windows16 = 'target="_blank"';
        }

        if ($db[ 'windows17' ]) {
            $windows17 = '';
        } else {
            $windows17 = 'target="_blank"';
        }

        if ($db[ 'windows18' ]) {
            $windows18 = '';
        } else {
            $windows18 = 'target="_blank"';
        }
		

        if ($ds[ 'navilink1' ] != '') {
            $navilink1 = '<li class="list-group-item list-footer"><i class="bi bi-chevron-double-right text-white"></i> <a href="' . htmlspecialchars($ds[ 'navilink1' ]) . '" '.$windows1.' rel="nofollow">' . htmlspecialchars($ds[ 'linkname1' ]) . '</a></li>';
        } else {
            $navilink1 = '';
        }

        if ($ds[ 'navilink2' ] != '') {
            $navilink2 = '<li class="list-group-item list-footer"><i class="bi bi-chevron-double-right text-white"></i> <a href="' . htmlspecialchars($ds[ 'navilink2' ]) . '" '.$windows2.' rel="nofollow">' . htmlspecialchars($ds[ 'linkname2' ]) . '</a></li>';
        } else {
            $navilink2 = '';
        }

        if ($ds[ 'navilink3' ] != '') {
            $navilink3 = '<li class="list-group-item list-footer"><i class="bi bi-chevron-double-right text-white"></i> <a href="' . htmlspecialchars($ds[ 'navilink3' ]) . '" '.$windows3.' rel="nofollow">' . htmlspecialchars($ds[ 'linkname3' ]) . '</a></li>';
        } else {
            $navilink3 = '';
        }

        if ($ds[ 'navilink4' ] != '') {
            $navilink4 = '<li class="list-group-item list-footer"><i class="bi bi-chevron-double-right text-white"></i> <a href="' . htmlspecialchars($ds[ 'navilink4' ]) . '" '.$windows4.' rel="nofollow">' . htmlspecialchars($ds[ 'linkname4' ]) . '</a></li>';
        } else {
            $navilink4 = '';
        }

        if ($ds[ 'navilink5' ] != '') {
            $navilink5 = '<li class="list-group-item list-footer"><i class="bi bi-chevron-double-right text-white"></i> <a href="' . htmlspecialchars($ds[ 'navilink5' ]) . '" '.$windows5.' rel="nofollow">' . htmlspecialchars($ds[ 'linkname5' ]) . '</a></li>';
        } else {
            $navilink5 = '';
        }

        if ($ds[ 'navilink6' ] != '') {
            $navilink6 = '<li class="list-group-item list-footer"><i class="bi bi-chevron-double-right text-white"></i> <a href="' . htmlspecialchars($ds[ 'navilink6' ]) . '" '.$windows6.' rel="nofollow">' . htmlspecialchars($ds[ 'linkname6' ]) . '</a></li>';
        } else {
            $navilink6 = '';
        }

        if ($ds[ 'navilink7' ] != '') {
            $navilink7 = '<li class="list-group-item list-footer"><i class="bi bi-chevron-double-right text-white"></i> <a href="' . htmlspecialchars($ds[ 'navilink7' ]) . '" '.$windows7.' rel="nofollow">' . htmlspecialchars($ds[ 'linkname7' ]) . '</a></li>';
        } else {
            $navilink7 = '';
        }

        if ($ds[ 'navilink8' ] != '') {
            $navilink8 = '<li class="list-group-item list-footer"><i class="bi bi-chevron-double-right text-white"></i> <a href="' . htmlspecialchars($ds[ 'navilink8' ]) . '" '.$windows8.' rel="nofollow">' . htmlspecialchars($ds[ 'linkname8' ]) . '</a></li>';
        } else {
            $navilink8 = '';
        }

        if ($ds[ 'navilink9' ] != '') {
            $navilink9 = '<li class="list-group-item list-footer"><i class="bi bi-chevron-double-right text-white"></i> <a href="' . htmlspecialchars($ds[ 'navilink9' ]) . '" '.$windows9.' rel="nofollow">' . htmlspecialchars($ds[ 'linkname9' ]) . '</a></li>';
        } else {
            $navilink9 = '';
        }

        if ($ds[ 'navilink10' ] != '') {
            $navilink10 = '<li class="list-group-item list-footer"><i class="bi bi-chevron-double-right text-white"></i> <a href="' . htmlspecialchars($ds[ 'navilink10' ]) . '" '.$windows10.' rel="nofollow">' . htmlspecialchars($ds[ 'linkname10' ]) . '</a></li>';
        } else {
            $navilink10 = '';
        }

			$about = $ds[ 'about' ];
    
    		$data_array = array();
	        $data_array['$about'] = $about;
	        $data_array['$name'] = $ds['name'];
	        $data_array['$strasse'] = $ds['strasse'];
	        $data_array['$email'] = $ds['email'];
			$data_array['$telefon'] = $ds['telefon'];


			$data_array['$navilink1'] = $navilink1;
            $data_array['$navilink2'] = $navilink2;
            $data_array['$navilink3'] = $navilink3;
            $data_array['$navilink4'] = $navilink4;
            $data_array['$navilink5'] = $navilink5;
            
            $data_array['$navilink6'] = $navilink6;
            $data_array['$navilink7'] = $navilink7;
            $data_array['$navilink8'] = $navilink8;
            $data_array['$navilink9'] = $navilink9;
            $data_array['$navilink10'] = $navilink10;
			
			$data_array['$twitch'] = $twitch;
			$data_array['$facebook'] = $facebook;
			$data_array['$twitter'] = $twitter;
			$data_array['$youtube'] = $youtube;
			$data_array['$rss'] = $rss;
			$data_array['$vine'] = $vine;
			$data_array['$flickr'] = $flickr;
			$data_array['$linkedin'] = $linkedin;
            $data_array['$instagram'] = $instagram;

			$data_array['$since'] = $since;
            $data_array['$myclanname'] = $myclanname;
			$data_array['$lang_aboutus'] = $plugin_language[ 'aboutus' ];
			$data_array['$lang_phone'] = $plugin_language[ 'phone' ];
			$data_array['$lang_address'] = $plugin_language[ 'address' ];
			$data_array['$lang_name'] = $plugin_language[ 'name' ];
			$data_array['$navigation'] = $plugin_language[ 'navigation' ];
			$data_array['$links'] = $plugin_language[ 'links' ];
			$data_array['$contact'] = $plugin_language[ 'contact' ];
			        

        	// Prüfen ob Navigation gesetzt ist
        	if($data_array['$navilink1'] == "n_a") { $data_array['inv1'] = "invisible"; } else { $data_array['inv1'] = "visible"; }
        	if($data_array['$navilink2'] == "n_a") { $data_array['inv2'] = "invisible"; } else { $data_array['inv2'] = "visible"; }
        	if($data_array['$navilink3'] == "n_a") { $data_array['inv3'] = "invisible"; } else { $data_array['inv3'] = "visible"; }
        	if($data_array['$navilink4'] == "n_a") { $data_array['inv4'] = "invisible"; } else { $data_array['inv4'] = "visible"; }
        	if($data_array['$navilink5'] == "n_a") { $data_array['inv5'] = "invisible"; } else { $data_array['inv5'] = "visible"; }
            if($data_array['$navilink6'] == "n_a") { $data_array['inv6'] = "invisible"; } else { $data_array['inv6'] = "visible"; }
            if($data_array['$navilink7'] == "n_a") { $data_array['inv7'] = "invisible"; } else { $data_array['inv7'] = "visible"; }
            if($data_array['$navilink8'] == "n_a") { $data_array['inv8'] = "invisible"; } else { $data_array['inv8'] = "visible"; }
            if($data_array['$navilink9'] == "n_a") { $data_array['inv9'] = "invisible"; } else { $data_array['inv9'] = "visible"; }
            if($data_array['$navilink10'] == "n_a") { $data_array['inv10'] = "invisible"; } else { $data_array['inv10'] = "visible"; }
        	
        	
        	// Prüfen ob Social gesetzt ist
        	if($data_array['$twitch'] == "n_a") { $data_array['social1'] = "invisible"; } else { $data_array['social1'] = "visible"; }
        	if($data_array['$facebook'] == "n_a") { $data_array['social2'] = "invisible"; } else { $data_array['social2'] = "visible"; }
        	if($data_array['$twitter'] == "n_a") { $data_array['social3'] = "invisible"; } else { $data_array['social3'] = "visible"; }
        	if($data_array['$youtube'] == "n_a") { $data_array['social4'] = "invisible"; } else { $data_array['social4'] = "visible"; }
        	if($data_array['$rss'] == "n_a") { $data_array['social5'] = "invisible"; } else { $data_array['social5'] = "visible"; }
        	if($data_array['$vine'] == "n_a") { $data_array['social6'] = "invisible"; } else { $data_array['social6'] = "visible"; }
        	if($data_array['$flickr'] == "n_a") { $data_array['social7'] = "invisible"; } else { $data_array['social7'] = "visible"; }
        	if($data_array['$linkedin'] == "n_a") { $data_array['social8'] = "invisible"; } else { $data_array['social8'] = "visible"; }
            if($data_array['$instagram'] == "n_a") { $data_array['social9'] = "invisible"; } else { $data_array['social9'] = "visible"; }
        			
	        
        
            $template = $GLOBALS["_template"]->loadTemplate("default_footer","content", $data_array, $plugin_path);
            echo $template;
            }
        }
    }
}
}
?>