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
        // BOARDS MIT KATEGORIE
        $boards = safe_query(
            "SELECT * FROM " . PREFIX . "plugins_forum_boards"
        );
        while ($db = mysqli_fetch_array($boards)) {
            $q = safe_query(
                "SELECT * FROM " . PREFIX .
                "plugins_forum_topics"
            );
            while ($lp = mysqli_fetch_assoc($q)) {
               
                        if ($userID) {
                            $board_topics[ ] = $lp[ 'topicID' ];
                        } else {
                            break;
                        }
            }

            // get unviewed topics
            $found = false;

            if ($userID) {
                $gv = mysqli_fetch_array(safe_query("SELECT topics FROM " . PREFIX . "user WHERE userID='$userID'"));
                $array = explode("|", $gv[ 'topics' ]);

                foreach ($array as $split) {
                    if ($split != "" && in_array($split, $board_topics)) {
                        $found = true;
                        break;
                    }
                }
            }


            if ($found) {
                $icon = '<span style="margin-top: -15px" class="badge badge-warning"><i class="fas fa-comments"></i></span>';
            } else {
                $icon = '';
            }


            $data_array = array();
            $data_array['$icon'] = $icon;
            
       }

  @$newmessages = getnewmessages($userID);
  if ($newmessages == 1) {
      $newmessages = $index_language[ 'one_new_message' ];
    } elseif ($newmessages > 1) {
      $newmessages = str_replace('%new_messages%', $newmessages, $index_language[ 'more_new_message' ]);
     } else {
      $newmessages = $index_language[ 'no_new_messages' ];
    }
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
                            