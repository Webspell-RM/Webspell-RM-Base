<?php
/**
 *¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*  
 *                                    Webspell-RM      /                        /   /                                                 *
 *                                    -----------__---/__---__------__----__---/---/-----__---- _  _ -                                *
 *                                     | /| /  /___) /   ) (_ `   /   ) /___) /   / __  /     /  /  /                                 *
 *                                    _|/_|/__(___ _(___/_(__)___/___/_(___ _/___/_____/_____/__/__/_                                 *
 *                                                 Free Content / Management System                                                   *
 *                                                             /                                                                      *
 *¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
 * @version         Webspell-RM                                                                                                       *
 *                                                                                                                                    *
 * @copyright       2018-2022 by webspell-rm.de <https://www.webspell-rm.de>                                                          *
 * @support         For Support, Plugins, Templates and the Full Script visit webspell-rm.de <https://www.webspell-rm.de/forum.html>  *
 * @WIKI            webspell-rm.de <https://www.webspell-rm.de/wiki.html>                                                             *
 *                                                                                                                                    *
 *¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
 * @license         Script runs under the GNU GENERAL PUBLIC LICENCE                                                                  *
 *                  It's NOT allowed to remove this copyright-tag <http://www.fsf.org/licensing/licenses/gpl.html>                    *
 *                                                                                                                                    *
 * @author          Code based on WebSPELL Clanpackage (Michael Gruber - webspell.at)                                                 *
 * @copyright       2005-2018 by webspell.org / webspell.info                                                                         *
 *¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
 *                                                                                                                                    *
 *¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
 */


$_language->readModule('contact', false, true);

$ergebnis = safe_query("SELECT * FROM ".PREFIX."navigation_dashboard_links WHERE modulname='ac_contact'");
    while ($db=mysqli_fetch_array($ergebnis)) {
      $accesslevel = 'is'.$db['accesslevel'].'admin';

if (!$accesslevel($userID) || mb_substr(basename($_SERVER[ 'REQUEST_URI' ]), 0, 15) != "admincenter.php") {
    die($_language->module[ 'access_denied' ]);
}
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
    
    echo'<div class="card">
        <div class="card-header">
            ' . $_language->module['contact'] . '
        </div>
            
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="admincenter.php?site=contact">' . $_language->module['contact'] . '</a></li>
    <li class="breadcrumb-item active" aria-current="page">' . $_language->module['add_contact'] . '</li>
  </ol>
</nav>
     <div class="card-body">';
    
    echo '<form class="form-horizontal" method="post" action="admincenter.php?site=contact" name="post">
	<div class="mb-3 row">
    <label class="col-sm-2 control-label">' . $_language->module['contact_name'] . ':</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="name"  />
    </div>
  </div>
  <div class="mb-3 row">
    <label class="col-sm-2 control-label">' . $_language->module['email'] . ':</label>
    <div class="col-sm-8">
     <input type="text" name="email" class="form-control"/>
    </div>
  </div>
  <div class="mb-3 row">
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
    
    echo'<div class="card">
        <div class="card-header">
            ' . $_language->module['contact'] . '
        </div>
            
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="admincenter.php?site=contact">' . $_language->module['contact'] . '</a></li>
    <li class="breadcrumb-item active" aria-current="page">' . $_language->module['edit_contact'] . '</li>
  </ol>
</nav>
     <div class="card-body">';

    echo '<form class="form-horizontal" method="post" action="admincenter.php?site=contact" name="post">
  <div class="mb-3 row">
    <label class="col-sm-2 control-label">' . $_language->module['contact_name'] . ':</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="name" value="' . getinput($ds['name']) . '" />
    </div>
  </div>
  <div class="mb-3 row">
    <label class="col-sm-2 control-label">' . $_language->module['email'] . ':</label>
    <div class="col-sm-8">
     <input type="text" name="email" class="form-control" value="' . getinput($ds['email']) . '" />
    </div>
  </div>
  <div class="mb-3 row">
    <div class="col-sm-offset-2 col-sm-10">
      <input type="hidden" name="captcha_hash" value="' . $hash . '" /><input type="hidden" name="contactID" value="' . getforminput($contactID) . '" /><button class="btn btn-warning" type="submit" name="saveedit" />' . $_language->module['edit_contact'] . '</button>
    </div>
  </div>
    </form>
    </div>
  </div>';
	}
}

else {
	
  echo '<div class="card">
        <div class="card-header">
            ' . $_language->module['contact'] . '
        </div>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">' . $_language->module['contact'] . '</li>
  </ol>
</nav>

<div class="card-body">

<div class="mb-3 row">
    <label class="col-md-1 control-label">' . $_language->module['options'] . ':</label>
    <div class="col-md-8">
      <a href="admincenter.php?site=contact&amp;action=add" class="btn btn-primary" type="button">' . $_language->module[ 'new_contact' ] . '</a>
    </div>
  </div>';	

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

<!-- Button trigger modal -->
    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirm-delete" data-href="admincenter.php?site=contact&amp;delete=true&amp;contactID=' . $ds['contactID'] . '&amp;captcha_hash=' . $hash . '">
    ' . $_language->module['delete'] . '
    </button>
    <!-- Button trigger modal END-->

     <!-- Modal -->
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">' . $_language->module[ 'contact' ] . '</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="' . $_language->module[ 'close' ] . '"></button>
      </div>
      <div class="modal-body"><p>' . $_language->module['really_delete'] . '</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">' . $_language->module[ 'close' ] . '</button>
        <a class="btn btn-danger btn-ok">' . $_language->module['delete'] . '</a>
      </div>
    </div>
  </div>
</div>
<!-- Modal END -->


</td>
	  <td><select name="sortcontact[]">';
		
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