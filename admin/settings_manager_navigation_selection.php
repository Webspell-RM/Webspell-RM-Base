<?php

#Navigation: es wird nur eine Navigation aktiviert

    if ($_POST['modulname'] != 'navigation_default') { 
    } else{ 
      safe_query("UPDATE  `" . PREFIX . "settings_module` SET `activate` = '1' WHERE `modulname` = 'navigation_default' AND themes_modulname='" . $_POST['themes_modulname'] . "';");
      safe_query("UPDATE  `" . PREFIX . "settings_module` SET `activate` = '0' WHERE `modulname` = 'navigation_default_two' AND themes_modulname='" . $_POST['themes_modulname'] . "';");
      safe_query("UPDATE  `" . PREFIX . "settings_widgets` SET `position` = '1',`description` = '1',`activate` = '1' WHERE `modulname` = 'navigation_default_two' AND themes_modulname='" . $_POST['themes_modulname'] . "';");
      safe_query("UPDATE  `" . PREFIX . "settings_module` SET `activate` = '0' WHERE `modulname` = 'navigation_agency' AND themes_modulname='" . $_POST['themes_modulname'] . "';");
      safe_query("UPDATE  `" . PREFIX . "settings_widgets` SET `position` = '1',`description` = '1',`activate` = '1' WHERE `modulname` = 'navigation_agency' AND themes_modulname='" . $_POST['themes_modulname'] . "';");
      safe_query("UPDATE  `" . PREFIX . "settings_module` SET `activate` = '0' WHERE `modulname` = 'navigation_sticky' AND themes_modulname='" . $_POST['themes_modulname'] . "';");
      safe_query("UPDATE  `" . PREFIX . "settings_widgets` SET `position` = '1',`description` = '1',`activate` = '1' WHERE `modulname` = 'navigation_sticky' AND themes_modulname='" . $_POST['themes_modulname'] . "';");
      safe_query("UPDATE  `" . PREFIX . "settings_module` SET `activate` = '0' WHERE `modulname` = 'navigation_skewed' AND themes_modulname='" . $_POST['themes_modulname'] . "';");
      safe_query("UPDATE  `" . PREFIX . "settings_widgets` SET `position` = '1',`description` = '1',`activate` = '1' WHERE `modulname` = 'navigation_skewed' AND themes_modulname='" . $_POST['themes_modulname'] . "';");
      safe_query("UPDATE  `" . PREFIX . "settings_module` SET `activate` = '0' WHERE `modulname` = 'navigation_2one' AND themes_modulname='" . $_POST['themes_modulname'] . "';");
      safe_query("UPDATE  `" . PREFIX . "settings_widgets` SET `position` = '1',`description` = '1',`activate` = '1' WHERE `modulname` = 'navigation_2one' AND themes_modulname='" . $_POST['themes_modulname'] . "';");
    }

    if ($_POST['modulname'] != 'navigation_default_two') { 
    } else{ 
      safe_query("UPDATE  `" . PREFIX . "settings_module` SET `activate` = '1' WHERE `modulname` = 'navigation_default_two' AND themes_modulname='" . $_POST['themes_modulname'] . "';");
      safe_query("UPDATE  `" . PREFIX . "settings_module` SET `activate` = '0' WHERE `modulname` = 'navigation_default' AND themes_modulname='" . $_POST['themes_modulname'] . "';");
      safe_query("UPDATE  `" . PREFIX . "settings_widgets` SET `position` = '1',`description` = '1',`activate` = '1' WHERE `modulname` = 'navigation_default' AND themes_modulname='" . $_POST['themes_modulname'] . "';");
      safe_query("UPDATE  `" . PREFIX . "settings_module` SET `activate` = '0' WHERE `modulname` = 'navigation_agency' AND themes_modulname='" . $_POST['themes_modulname'] . "';");
      safe_query("UPDATE  `" . PREFIX . "settings_widgets` SET `position` = '1',`description` = '1',`activate` = '1' WHERE `modulname` = 'navigation_agency' AND themes_modulname='" . $_POST['themes_modulname'] . "';");
      safe_query("UPDATE  `" . PREFIX . "settings_module` SET `activate` = '0' WHERE `modulname` = 'navigation_sticky' AND themes_modulname='" . $_POST['themes_modulname'] . "';");
      safe_query("UPDATE  `" . PREFIX . "settings_widgets` SET `position` = '1',`description` = '1',`activate` = '1' WHERE `modulname` = 'navigation_sticky' AND themes_modulname='" . $_POST['themes_modulname'] . "';");
      safe_query("UPDATE  `" . PREFIX . "settings_module` SET `activate` = '0' WHERE `modulname` = 'navigation_skewed' AND themes_modulname='" . $_POST['themes_modulname'] . "';");
      safe_query("UPDATE  `" . PREFIX . "settings_widgets` SET `position` = '1',`description` = '1',`activate` = '1' WHERE `modulname` = 'navigation_skewed' AND themes_modulname='" . $_POST['themes_modulname'] . "';");
      safe_query("UPDATE  `" . PREFIX . "settings_module` SET `activate` = '0' WHERE `modulname` = 'navigation_2one' AND themes_modulname='" . $_POST['themes_modulname'] . "';");
      safe_query("UPDATE  `" . PREFIX . "settings_widgets` SET `position` = '1',`description` = '1',`activate` = '1' WHERE `modulname` = 'navigation_2one' AND themes_modulname='" . $_POST['themes_modulname'] . "';");
    }

    if ($_POST['modulname'] != 'navigation_agency') { 
    } else{ 
      safe_query("UPDATE  `" . PREFIX . "settings_module` SET `activate` = '1' WHERE `modulname` = 'navigation_agency' AND themes_modulname='" . $_POST['themes_modulname'] . "';");
      safe_query("UPDATE  `" . PREFIX . "settings_module` SET `activate` = '0' WHERE `modulname` = 'navigation_default' AND themes_modulname='" . $_POST['themes_modulname'] . "';");
      safe_query("UPDATE  `" . PREFIX . "settings_widgets` SET `position` = '1',`description` = '1',`activate` = '1' WHERE `modulname` = 'navigation_default' AND themes_modulname='" . $_POST['themes_modulname'] . "';");
      safe_query("UPDATE  `" . PREFIX . "settings_module` SET `activate` = '0' WHERE `modulname` = 'navigation_default_two' AND themes_modulname='" . $_POST['themes_modulname'] . "';");
      safe_query("UPDATE  `" . PREFIX . "settings_widgets` SET `position` = '1',`description` = '1',`activate` = '1' WHERE `modulname` = 'navigation_default_two' AND themes_modulname='" . $_POST['themes_modulname'] . "';");
      safe_query("UPDATE  `" . PREFIX . "settings_module` SET `activate` = '0' WHERE `modulname` = 'navigation_sticky' AND themes_modulname='" . $_POST['themes_modulname'] . "';");
      safe_query("UPDATE  `" . PREFIX . "settings_widgets` SET `position` = '1',`description` = '1',`activate` = '1' WHERE `modulname` = 'navigation_sticky' AND themes_modulname='" . $_POST['themes_modulname'] . "';");
      safe_query("UPDATE  `" . PREFIX . "settings_module` SET `activate` = '0' WHERE `modulname` = 'navigation_skewed' AND themes_modulname='" . $_POST['themes_modulname'] . "';");
      safe_query("UPDATE  `" . PREFIX . "settings_widgets` SET `position` = '1',`description` = '1',`activate` = '1' WHERE `modulname` = 'navigation_skewed' AND themes_modulname='" . $_POST['themes_modulname'] . "';");
      safe_query("UPDATE  `" . PREFIX . "settings_module` SET `activate` = '0' WHERE `modulname` = 'navigation_2one' AND themes_modulname='" . $_POST['themes_modulname'] . "';");
      safe_query("UPDATE  `" . PREFIX . "settings_widgets` SET `position` = '1',`description` = '1',`activate` = '1' WHERE `modulname` = 'navigation_2one' AND themes_modulname='" . $_POST['themes_modulname'] . "';");
    }

    if ($_POST['modulname'] != 'navigation_sticky') {
    } else{ 
      safe_query("UPDATE  `" . PREFIX . "settings_module` SET `activate` = '1' WHERE `modulname` = 'navigation_sticky' AND themes_modulname='" . $_POST['themes_modulname'] . "';");
      safe_query("UPDATE  `" . PREFIX . "settings_module` SET `activate` = '0' WHERE `modulname` = 'navigation_default' AND themes_modulname='" . $_POST['themes_modulname'] . "';");
      safe_query("UPDATE  `" . PREFIX . "settings_widgets` SET `position` = '1',`description` = '1',`activate` = '1' WHERE `modulname` = 'navigation_default' AND themes_modulname='" . $_POST['themes_modulname'] . "';");
      safe_query("UPDATE  `" . PREFIX . "settings_module` SET `activate` = '0' WHERE `modulname` = 'navigation_default_two' AND themes_modulname='" . $_POST['themes_modulname'] . "';");
      safe_query("UPDATE  `" . PREFIX . "settings_widgets` SET `position` = '1',`description` = '1',`activate` = '1' WHERE `modulname` = 'navigation_default_two' AND themes_modulname='" . $_POST['themes_modulname'] . "';");
      safe_query("UPDATE  `" . PREFIX . "settings_module` SET `activate` = '0' WHERE `modulname` = 'navigation_agency' AND themes_modulname='" . $_POST['themes_modulname'] . "';");
      safe_query("UPDATE  `" . PREFIX . "settings_widgets` SET `position` = '1',`description` = '1',`activate` = '1' WHERE `modulname` = 'navigation_agency' AND themes_modulname='" . $_POST['themes_modulname'] . "';");
      safe_query("UPDATE  `" . PREFIX . "settings_module` SET `activate` = '0' WHERE `modulname` = 'navigation_skewed' AND themes_modulname='" . $_POST['themes_modulname'] . "';");
      safe_query("UPDATE  `" . PREFIX . "settings_widgets` SET `position` = '1',`description` = '1',`activate` = '1' WHERE `modulname` = 'navigation_skewed' AND themes_modulname='" . $_POST['themes_modulname'] . "';");
      safe_query("UPDATE  `" . PREFIX . "settings_module` SET `activate` = '0' WHERE `modulname` = 'navigation_2one' AND themes_modulname='" . $_POST['themes_modulname'] . "';");
      safe_query("UPDATE  `" . PREFIX . "settings_widgets` SET `position` = '1',`description` = '1',`activate` = '1' WHERE `modulname` = 'navigation_2one' AND themes_modulname='" . $_POST['themes_modulname'] . "';");
    }

    if ($_POST['modulname'] != 'navigation_skewed') {
    } else{ 
      safe_query("UPDATE  `" . PREFIX . "settings_module` SET `activate` = '1' WHERE `modulname` = 'navigation_skewed' AND themes_modulname='" . $_POST['themes_modulname'] . "';");
      safe_query("UPDATE  `" . PREFIX . "settings_module` SET `activate` = '0' WHERE `modulname` = 'navigation_default' AND themes_modulname='" . $_POST['themes_modulname'] . "';");
      safe_query("UPDATE  `" . PREFIX . "settings_widgets` SET `position` = '1',`description` = '1',`activate` = '1' WHERE `modulname` = 'navigation_default' AND themes_modulname='" . $_POST['themes_modulname'] . "';");
      safe_query("UPDATE  `" . PREFIX . "settings_module` SET `activate` = '0' WHERE `modulname` = 'navigation_default_two' AND themes_modulname='" . $_POST['themes_modulname'] . "';");
      safe_query("UPDATE  `" . PREFIX . "settings_widgets` SET `position` = '1',`description` = '1',`activate` = '1' WHERE `modulname` = 'navigation_default_two' AND themes_modulname='" . $_POST['themes_modulname'] . "';");
      safe_query("UPDATE  `" . PREFIX . "settings_module` SET `activate` = '0' WHERE `modulname` = 'navigation_agency' AND themes_modulname='" . $_POST['themes_modulname'] . "';");
      safe_query("UPDATE  `" . PREFIX . "settings_widgets` SET `position` = '1',`description` = '1',`activate` = '1' WHERE `modulname` = 'navigation_agency' AND themes_modulname='" . $_POST['themes_modulname'] . "';");
      safe_query("UPDATE  `" . PREFIX . "settings_module` SET `activate` = '0' WHERE `modulname` = 'navigation_sticky' AND themes_modulname='" . $_POST['themes_modulname'] . "';");
      safe_query("UPDATE  `" . PREFIX . "settings_widgets` SET `position` = '1',`description` = '1',`activate` = '1' WHERE `modulname` = 'navigation_sticky' AND themes_modulname='" . $_POST['themes_modulname'] . "';");
      safe_query("UPDATE  `" . PREFIX . "settings_module` SET `activate` = '0' WHERE `modulname` = 'navigation_2one' AND themes_modulname='" . $_POST['themes_modulname'] . "';");
      safe_query("UPDATE  `" . PREFIX . "settings_widgets` SET `position` = '1',`description` = '1',`activate` = '1' WHERE `modulname` = 'navigation_2one' AND themes_modulname='" . $_POST['themes_modulname'] . "';");
    }

    if ($_POST['modulname'] != 'navigation_2one') {
    } else{ 
      safe_query("UPDATE  `" . PREFIX . "settings_module` SET `activate` = '1' WHERE `modulname` = 'navigation_2one' AND themes_modulname='" . $_POST['themes_modulname'] . "';");
      safe_query("UPDATE  `" . PREFIX . "settings_module` SET `activate` = '0' WHERE `modulname` = 'navigation_default' AND themes_modulname='" . $_POST['themes_modulname'] . "';");
      safe_query("UPDATE  `" . PREFIX . "settings_widgets` SET `position` = '1',`description` = '1',`activate` = '1' WHERE `modulname` = 'navigation_default' AND themes_modulname='" . $_POST['themes_modulname'] . "';");
      safe_query("UPDATE  `" . PREFIX . "settings_module` SET `activate` = '0' WHERE `modulname` = 'navigation_default_two' AND themes_modulname='" . $_POST['themes_modulname'] . "';");
      safe_query("UPDATE  `" . PREFIX . "settings_widgets` SET `position` = '1',`description` = '1',`activate` = '1' WHERE `modulname` = 'navigation_default_two' AND themes_modulname='" . $_POST['themes_modulname'] . "';");
      safe_query("UPDATE  `" . PREFIX . "settings_module` SET `activate` = '0' WHERE `modulname` = 'navigation_agency' AND themes_modulname='" . $_POST['themes_modulname'] . "';");
      safe_query("UPDATE  `" . PREFIX . "settings_widgets` SET `position` = '1',`description` = '1',`activate` = '1' WHERE `modulname` = 'navigation_agency' AND themes_modulname='" . $_POST['themes_modulname'] . "';");
      safe_query("UPDATE  `" . PREFIX . "settings_module` SET `activate` = '0' WHERE `modulname` = 'navigation_sticky' AND themes_modulname='" . $_POST['themes_modulname'] . "';");
      safe_query("UPDATE  `" . PREFIX . "settings_widgets` SET `position` = '1',`description` = '1',`activate` = '1' WHERE `modulname` = 'navigation_sticky' AND themes_modulname='" . $_POST['themes_modulname'] . "';");
      safe_query("UPDATE  `" . PREFIX . "settings_module` SET `activate` = '0' WHERE `modulname` = 'navigation_skewed' AND themes_modulname='" . $_POST['themes_modulname'] . "';");
      safe_query("UPDATE  `" . PREFIX . "settings_widgets` SET `position` = '1',`description` = '1',`activate` = '1' WHERE `modulname` = 'navigation_skewed' AND themes_modulname='" . $_POST['themes_modulname'] . "';");
      
    }