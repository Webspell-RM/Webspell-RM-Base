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
$_language->readModule('contact', false, true);

if (!isuseradmin($userID) || mb_substr(basename($_SERVER[ 'REQUEST_URI' ]), 0, 15) != "admincenter.php") {
    die($_language->module[ 'access_denied' ]);
}

if (isset($_GET[ 'delete' ])) {
    $contactID = $_GET[ 'contactID' ];
    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_GET[ 'captcha_hash' ])) {
        safe_query("DELETE FROM " . PREFIX . "contact WHERE contactID='$contactID'");
    } else {
        echo $_language->module[ 'transaction_invalid' ];
    }
} elseif (isset($_POST[ 'sortieren' ])) {
    $sortcontact = $_POST[ 'sortcontact' ];
    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_POST[ 'captcha_hash' ])) {
        if (is_array($sortcontact)) {
            foreach ($sortcontact as $sortstring) {
                $sorter = explode("-", $sortstring);
                safe_query("UPDATE " . PREFIX . "contact SET sort='$sorter[1]' WHERE contactID='$sorter[0]' ");
            }
        }
    } else {
        echo $_language->module[ 'transaction_invalid' ];
    }
} elseif (isset($_POST[ 'save' ])) {
    $name = $_POST[ 'name' ];
    $email = $_POST[ 'email' ];
    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_POST[ 'captcha_hash' ])) {
        if (checkforempty(array('name', 'email'))) {
            safe_query("INSERT INTO " . PREFIX . "contact ( name, email, sort ) values( '$name', '$email', '1' )");
        } else {
            echo $_language->module[ 'information_incomplete' ];
        }
    } else {
        echo $_language->module[ 'transaction_invalid' ];
    }
} elseif (isset($_POST[ 'saveedit' ])) {
    $name = $_POST[ 'name' ];
    $email = $_POST[ 'email' ];
    $contactID = $_POST[ 'contactID' ];
    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_POST[ 'captcha_hash' ])) {
        if (checkforempty(array('name', 'email'))) {
            safe_query("UPDATE " . PREFIX . "contact SET name='$name', email='$email' WHERE contactID='$contactID' ");
        } else {
            echo $_language->module[ 'information_incomplete' ];
        }
    } else {
        echo $_language->module[ 'transaction_invalid' ];
    }
}

if (isset($_GET[ 'action' ])) {
    if ($_GET[ 'action' ] == "add") {
        $CAPCLASS = new \webspell\Captcha;
        $CAPCLASS->createTransaction();
        $hash = $CAPCLASS->getHash();
    
    echo'<div class="panel panel-default">
<div class="panel-heading">
                            <i class="fa fa-envelope"></i> ' . $_language->module['contact'] . '
                        </div>
     <div class="panel-body">
    <a href="admincenter.php?site=contact" class="white">' . $_language->module['contact'] . '</a> &raquo; ' . $_language->module['add_contact'] . '<br><br>';
    
    echo '<form class="form-horizontal" method="post" action="admincenter.php?site=contact" name="post">
	<div class="form-group">
    <label class="col-sm-2 control-label">' . $_language->module['contact_name'] . ':</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="name"  />
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">' . $_language->module['email'] . ':</label>
    <div class="col-sm-8">
     <input type="text" name="email" class="form-control"/>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <input type="hidden" name="captcha_hash" value="' . $hash . '" /><button class="btn btn-success" type="submit" name="save" />' . $_language->module['add_contact'] . '</button>
    </div>
  </div>
    </form>
    </div>
  </div>';
    
	 } elseif ($_GET[ 'action' ] == "edit") {
        $contactID = (int)$_GET[ 'contactID' ];

        $ergebnis = safe_query("SELECT * FROM " . PREFIX . "contact WHERE contactID='$contactID'");
        $ds = mysqli_fetch_array($ergebnis);

        $CAPCLASS = new \webspell\Captcha;
        $CAPCLASS->createTransaction();
        $hash = $CAPCLASS->getHash();
    
    echo'<div class="panel panel-default">
    <div class="panel-heading">
                            <i class="fa fa-envelope"></i> ' . $_language->module['contact'] . '
                        </div>
     <div class="panel-body">
    <a href="admincenter.php?site=contact" class="white">' . $_language->module['contact'] . '</a> &raquo; ' . $_language->module['edit_contact'] . '<br></br>';

    echo '<form class="form-horizontal" method="post" action="admincenter.php?site=contact" name="post">
  <div class="form-group">
    <label class="col-sm-2 control-label">' . $_language->module['contact_name'] . ':</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="name" value="' . getinput($ds['name']) . '" />
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">' . $_language->module['email'] . ':</label>
    <div class="col-sm-8">
     <input type="text" name="email" class="form-control" value="' . getinput($ds['email']) . '" />
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <input type="hidden" name="captcha_hash" value="' . $hash . '" /><input type="hidden" name="contactID" value="' . getforminput($contactID) . '" /><button class="btn btn-success" type="submit" name="saveedit" />' . $_language->module['edit_contact'] . '</button>
    </div>
  </div>
    </form>
    </div>
  </div>';
	}
}

else {
	
  echo '<div class="panel panel-default">
  <div class="panel-heading">
                            <i class="fa fa-envelope"></i> ' . $_language->module['contact'] . '
                        </div>
  <div class="panel-body">


  <a href="admincenter.php?site=contact&amp;action=add" class="btn btn-primary" type="button">' . $_language->module[ 'new_contact' ] . '</a><br /><br />';	

	echo'<form method="post" action="admincenter.php?site=contact">
  <table class="table table-striped">
    
<thead>

      <tr>
      <th><b>' . $_language->module['contact_name'] . ':</b></th>
      <th><b>' . $_language->module['email'] . ':</b></th>
      <th><b>' . $_language->module['actions'] . ':</b></th>
      <th class="hidden-xs hidden-sm"><b>' . $_language->module['sort'] . ':</b></th>
    </tr></thead>
          <tbody>';

	$ergebnis = safe_query("SELECT * FROM `" . PREFIX . "contact` ORDER BY `sort`");
    $tmp = mysqli_fetch_assoc(safe_query("SELECT count(contactID) as cnt FROM `" . PREFIX . "contact`"));
    $anz = $tmp[ 'cnt' ];

    $i = 1;
    $CAPCLASS = new \webspell\Captcha;
    $CAPCLASS->createTransaction();
    $hash = $CAPCLASS->getHash();

    while ($ds = mysqli_fetch_array($ergebnis)) {
        if ($i % 2) {
            $td = 'td1';
        } else {
            $td = 'td2';
        }

        echo '<tr>
      <td>' . getinput($ds['name']) . '</td>
		<td>' . getinput($ds['email']) . '</td>
      <td><a href="admincenter.php?site=contact&amp;action=edit&amp;contactID=' . $ds['contactID'] . '" class="hidden-xs hidden-sm btn btn-warning" type="button">' . $_language->module[ 'edit' ] . '</a>

        <input class="hidden-xs hidden-sm btn btn-danger" type="button" onclick="MM_confirm(\'' . $_language->module['really_delete'] . '\', \'admincenter.php?site=contact&amp;delete=true&amp;contactID=' . $ds['contactID'] . '&amp;captcha_hash=' . $hash . '\')" value="' . $_language->module['delete'] . '" />

    


    <a href="admincenter.php?site=contact&amp;action=edit&amp;contactID=' . $ds['contactID'] . '"  class="mobile visible-xs visible-sm" type="button"><i class="fa fa-pencil"></i></a>
    <a class="mobile visible-xs visible-sm" onclick="MM_confirm(\'' . $_language->module['really_delete'] . '\', \'admincenter.php?site=contact&amp;delete=true&amp;contactID=' . $ds['contactID'] . '&amp;captcha_hash=' . $hash . '\')" /><i class="fa fa-times"></i></a>
    


      </td>
	  <td class="hidden-xs hidden-sm"><select name="sortcontact[]">';
		
    for($n=1; $n<=$anz; $n++) {
			if($ds['sort'] == $n) echo'<option value="' . $ds['contactID'] . '-' . $n . '" selected="selected">' . $n . '</option>';
			else echo'<option value="' . $ds['contactID'] . '-' . $n . '">' . $n . '</option>';
		}
    
		echo'</select></td>
    </tr>';
    
    $i++;
	}
	echo'<tr>
      <td class="td_head" colspan="4" align="right"><input type="hidden" name="captcha_hash" value="' . $hash . '" /><input class="btn btn-primary" type="submit" name="sortieren" value="' . $_language->module['to_sort'] . '" /></td>
    </tr>
  </tbody></table>
  </form>';
}
echo '</div></div>';
?>