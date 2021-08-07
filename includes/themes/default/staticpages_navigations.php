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
\___________________________________________________________________/
/                                                                   \
|   staticpages_navigations: Copyright Matti 'Getschonik' W. 2021   |
\------------------------------------------------------------------*/

/*
	1. themes/default/index.php :: 	<?php include("staticpages_navigations.php");?>
	
	ADMINCENTER:
	2. create a new static page
	3. here the example to fill the content
	
	// targets: _blank (new tab) -- _self (the current tab)
	sfn1 { link=index.php; target=_self; name=Home }
	sfn2 { link=index.php?site=static&staticID=1; target=_self; name=Services }
	sfn3 { link=index.php?site=files; target=_self; name=Downloads }

	4. include the static_navigation:	footer_left_navigation (STATIC-PAGE-TITLE)	// integer (STATIC PAGE ID) // string (NEEDLE)
	
	<a class="footerlink" target="<?php echo getFooterSubNavigation("footer_left_navigation", "1", "target"); ?>" alt="<?php echo getFooterSubNavigation("footer_left_navigation", "1", "name"); ?>" title="<?php echo getFooterSubNavigation("footer_left_navigation", "1", "name"); ?>" href="<?php echo getFooterSubNavigation("footer_left_navigation", "1", "link"); ?>"><?php echo getFooterSubNavigation("footer_left_navigation", "1", "name"); ?></a>
	
	------------------------------------------------------------------------------
	The code can be much better but it was an test, so that the webmaster for 
	the footer dont need to edit the sourcecode. When i've time it get an update.

*/

function getFooterSubNavigation($xtitle, $num, $ret) {	
	$ds = mysqli_fetch_array(safe_query("SELECT * FROM " . PREFIX . "settings_static WHERE title='" . $xtitle . "'"));
	$allowed = false;
	switch ($ds[ 'accesslevel' ]) {
		case 0:
			$allowed = true;
			break;
		case 1:
			if ($userID) {
				$allowed = true;
			}
			break;
		case 2:
			if (isclanmember($userID)) {
				$allowed = true;
			}
			break;
	}
	if ($allowed) {
			$content = html_entity_decode($ds[ 'content' ]);
 
			$sfnitems = array();
			for ($i = 1; $i < 11; $i++) {
				if($i==$num) {
					$st = "sfn".$i; 
					try {
						$t1 = explode($st, $content);
						if(strlen($t1[1])>0) {
							$t2 = explode("}", $t1[1]);
							try {
								$t3 = explode(";", $t2[0]);
								if($ret=="link") {
									$x = @explode("link=", $t3[0]);
									if(!$x[1]) {
										return "";
									}
									return $x[1];
								} elseif($ret=="target") {
									$x = @explode("target=", $t3[1]);
									if(!$x[1]) {
										return "";
									}
									return $x[1];
								} elseif($ret=="name") {
									$y = @explode("name=", $t1[1]);
									$x = @explode("}", $y[1]);
									if(trim(strtolower($x[0]))=="empty") {
										return "";
									}
									return $x[0];
								} else {
									return "";			
								}														
							} CATCH (Excpetion $k) {
								//
							}
						}				
					} CATCH (Excpetion $e) {
						break;
					}			
				}
			}
			print_r($sfnitems);			
	} else {
		$_language->readModule('static');
		redirect("index.php", $_language->module['no_access' ], 3);
	}
}


