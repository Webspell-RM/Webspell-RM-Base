<?php
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
		$query = safe_query("SELECT * FROM `".PREFIX."settings_themes` WHERE `active` = 1");
		$res = mysqli_fetch_array($query);
		$theme_path = "includes/themes/".$res['name']."/";
		return $theme_path;
	}
	
	
}
// get active theme



















?>