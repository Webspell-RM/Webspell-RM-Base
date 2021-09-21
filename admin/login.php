<?php

if ($loggedin) {
            

    //echo $_language->module[ 'you_have_to_be_logged_in' ];


} else {
    //set sessiontest variable (checks if session works correctly)
    $_SESSION[ 'ws_sessiontest' ] = true;
    
    
	$login = file_get_contents('login/loginform.php');
    echo $login;
}
