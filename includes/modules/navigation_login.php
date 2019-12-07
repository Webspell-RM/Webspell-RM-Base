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
?>
<li class="nav-item underline dropdown">
     <?php if($loggedin) {
     
        echo'<li class="nav-item dropdown mr-2">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown09" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' . ucfirst($index_language[ 'overview' ]) . '</a>
            <div class="dropdown-menu subnav" aria-labelledby="dropdown09">
            <a class="dropdown-item subnav" href="index.php?site=loginoverview">'.$index_language[ 'user_information' ].'</a>
            <a class="dropdown-item subnav" href="index.php?site=myprofile">'.$index_language[ 'edit_profile' ].'</a>
            <a class="dropdown-item subnav" href="/includes/modules/logout.php">'.$index_language[ 'log_off' ].'</a>
            </div>
            </li>';
    } else {
            echo '<a class="mr-2 nav-link login" href="index.php?site=login">' . ucfirst($index_language[ 'login' ]) . '</a>';
            } 
?>
    <li class="nav-item dropdown mr-2 d-inline-flex" style="margin-top: 7px"><?php include(MODULE."language.php")  ?></li>

<!-- END -->
</li>
                            