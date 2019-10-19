<li class="nav-item dropdown mr-2">
<?php
                                        
// BOARDS MIT KATEGORIE
        $boards = safe_query(
            "SELECT * FROM " . PREFIX . "plugins_forum_boards"
        );
        

        while ($db = mysqli_fetch_array($boards)) {
            
            $q = safe_query(
                "SELECT topicID, topic FROM " . PREFIX .
                "plugins_forum_topics WHERE boardID='" . $db[ 'boardID' ] . "'"
            );
            
            $board_topics = array();
            while ($lp = mysqli_fetch_assoc($q)) {
               
                        if ($userID) {
                            $board_topics[ ] = $lp[ 'topicID' ];
                        } else {
                            break;
                        }
                
            }

            // get unviewed topics

            $found = false;
            global $userID;
            if ($userID) {
                $gv = mysqli_fetch_array(safe_query("SELECT topics FROM " . PREFIX . "user WHERE userID=".$userID.""));
                $array = explode("|", $gv[ 'topics' ]);

                foreach ($array as $split) {
                    if ($split != "" && in_array($split, $board_topics)) {
                        $found = true;
                        break;
                    }
                }
            }

            if ($found) {
                $icon = '<span class="badge badge-warning"><i class="fas fa-comments"></i></span>';
            } else {
                $icon = '';
            }

            $data_array = array();
            $data_array['$icon'] = $icon;
            
       }
?>

<?php if($loggedin) {

  @$newmessages = getnewmessages($userID);
  if ($newmessages == 1) {
      $newmessages = $index_language[ 'one_new_message' ];
    } elseif ($newmessages > 1) {
      $newmessages = str_replace('%new_messages%', $newmessages, $index_language[ 'more_new_message' ]);
     } else {
      $newmessages = $index_language[ 'no_new_messages' ];
    }
echo'<a class="nav-link dropdown-toggle" href="#" id="dropdown09" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' . ucfirst($index_language[ 'overview' ]) . '&nbsp;'.$newmessages.'&nbsp;'.$icon.'</a>
              

    <div style="width: 300px" class="dropdown-menu subnav" aria-labelledby="dropdown09">

        <a class="dropdown-item subnav" href="index.php?site=login">'.$index_language[ 'user_information' ].'</a>
        <a class="dropdown-item subnav" href="index.php?site=myprofile">'.$index_language[ 'edit_profile' ].'</a>
        <a class="dropdown-item subnav" href="index.php?site=forum">'.$index_language[ 'forum' ].'&nbsp;'.$icon.'</a>
        <a class="dropdown-item subnav" href="index.php?site=messenger">'.$index_language[ 'messaging_system' ].'&nbsp;'.$newmessages.'</a>
        <a class="dropdown-item" href="#" id="dropdown09" data-toggle="dropdown">'.$index_language[ 'language' ].' <i class="fas fa-caret-down"></i></a>
        <div style="margin-top: -80px;margin-left: 270px" class="dropdown-menu" aria-labelledby="dropdown09">
        ';?>
          <?php include(MODULE."language.php")  ?><?php
    echo'</div>
        <a class="dropdown-item subnav" href="/includes/modules/logout.php">'.$index_language[ 'log_off' ].'</a>

    </div>
';
    } else {
                        echo '<a class="nav-link login" href="index.php?site=login">' . ucfirst($index_language[ 'login' ]) . '</a>';
            } 
?>
</li>
                            