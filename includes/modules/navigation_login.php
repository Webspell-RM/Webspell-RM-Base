<li class="nav-item dropdown mr-2">
    <?php if($loggedin) {


echo'<a class="nav-link dropdown-toggle" href="#" id="dropdown09" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' . ucfirst($index_language[ 'overview' ]) . '</a>
              

    <div style="width: 300px" class="dropdown-menu subnav" aria-labelledby="dropdown09">

        <a class="dropdown-item subnav" href="index.php?site=login">'.$index_language[ 'user_information' ].'</a>
        <a class="dropdown-item subnav" href="index.php?site=myprofile">'.$index_language[ 'edit_profile' ].'</a>
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

?></li>
                            