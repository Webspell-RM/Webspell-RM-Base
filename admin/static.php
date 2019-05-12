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
$_language->readModule('static', false, true);

if (!ispageadmin($userID) || mb_substr(basename($_SERVER[ 'REQUEST_URI' ]), 0, 15) != "admincenter.php") {
    die($_language->module[ 'access_denied' ]);
}

if (isset($_POST[ 'save' ])) {
    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_POST[ 'captcha_hash' ])) {
        if (isset($_POST[ 'staticID' ]) && $_POST[ 'staticID' ]) {
            safe_query(
                "UPDATE
                    `" . PREFIX . "static`
                SET
                    title='" . $_POST[ 'title' ] . "',
                    accesslevel='" . $_POST[ 'accesslevel' ] . "',
                    content='" . $_POST[ 'message' ] . "'
                WHERE
                    staticID='" . $_POST[ 'staticID' ] . "'"
            );
            $id = $_POST[ 'staticID' ];
        } else {
            safe_query(
                "INSERT INTO
                    `" . PREFIX . "static` (
                        `title`, `accesslevel`,`content`
                    )
                   VALUES(
                        '" . $_POST[ 'title' ] . "', '" . $_POST[ 'accesslevel' ] . "','" . $_POST[ 'message' ] . "'
                    ) "
            );
            $id = mysqli_insert_id($_database);
        }
        \webspell\Tags::setTags('static', $id, $_POST[ 'tags' ]);
    } else {
        echo $_language->module[ 'transaction_invalid' ];
    }
} elseif (isset($_GET[ 'delete' ])) {
    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_GET[ 'captcha_hash' ])) {
        \webspell\Tags::removeTags('static', $_GET[ 'staticID' ]);
        safe_query("DELETE FROM `" . PREFIX . "static` WHERE staticID='" . $_GET[ 'staticID' ] . "'");
    } else {
        echo $_language->module[ 'transaction_invalid' ];
    }
}

if (isset($_GET[ 'action' ]) && $_GET[ 'action' ] == "add") {
    $CAPCLASS = new \webspell\Captcha;
    $CAPCLASS->createTransaction();
    $hash = $CAPCLASS->getHash();
    

  echo '<div class="panel panel-default">
  <div class="panel-heading">
                            <i class="fa fa-pencil-square"></i> ' . $_language->module[ 'static_pages' ] . '
                        </div>
                    <div class="panel-body">';  
	
  echo'<a href="admincenter.php?site=static" class="white">' . $_language->module['static_pages'] . '</a> &raquo; ' . $_language->module['add_static_page'] . '<br><br>';
  
 
  
  echo'<form class="form-horizontal" method="post" id="post" name="post" action="admincenter.php?site=static" enctype="post" onsubmit="return chkFormular();">
  <div class="row">

<div class="col-md-6">

  <div class="form-group">
    <label class="col-sm-2 control-label">' . $_language->module['title'] . ':</label>
    <div class="col-sm-8"><span class="text-muted small"><em>
      <input class="form-control" type="text" name="title" size="60" value="new" /></em></span>
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">' . $_language->module[ 'tags' ] . ':</label>
    <div class="col-sm-8"><span class="text-muted small"><em>
      <input class="form-control" type="text" name="tags" size="60" value="" /></em></span>
    </div>
  </div>

</div>
<div class="col-md-6">

  <div class="form-group">
    <label class="col-sm-2 control-label">' . $_language->module[ 'accesslevel' ] . ':</label>
    <div class="col-sm-8"><span class="text-muted small"><em>
		<input name="accesslevel" type="radio" value="0" checked="checked" /> ' . $_language->module[ 'public' ] .
        '<br />
      <input name="accesslevel" type="radio" value="1" /> ' . $_language->module[ 'registered_only' ] . '<br />
      <input name="accesslevel" type="radio" value="2" /> ' . $_language->module[ 'clanmember_only' ] . '</em></span>
    </div>
  </div>

  </div>

  </div>


  <div class="row">
  <div class="col-md-12">
 '.$_language->module['info'].'
  <div class="form-group">
    
    <div class="col-md-12"><span class="text-muted small"><em>
      <textarea class="ckeditor" id="ckeditor"  id="message" name="message" rows="20" cols="" style="width: 100%;"></textarea>
    </div>
  </div>
  <div class="form-group">
    <div class="col-md-12">
		<input type="hidden" name="captcha_hash" value="' . $hash . '" />
		<button class="btn btn-success" type="submit" name="save"  />' . $_language->module['add_static_page'] . '</button>
    </div>
  </div>

  </div>
  </div>
  </form></div></div>';
  
} elseif (isset($_GET[ 'action' ]) && $_GET[ 'action' ] == "edit") {
    $_language->readModule('bbcode', true, true);

    $staticID = $_GET[ 'staticID' ];
    $ergebnis = safe_query("SELECT * FROM `" . PREFIX . "static` WHERE staticID='" . $staticID . "'");
    $ds = mysqli_fetch_array($ergebnis);
    $content = getinput($ds[ 'content' ]);

    $clanmember = "";
    $user = "";
    $public = "";
    if ($ds[ 'accesslevel' ] == 2) {
        $clanmember = "checked=\"checked\"";
    } elseif ($ds[ 'accesslevel' ] == 1) {
        $user = "checked=\"checked\"";
    } else {
        $public = "checked=\"checked\"";
    }

    $tags = \webspell\Tags::getTags('static', $staticID);

    $CAPCLASS = new \webspell\Captcha;
    $CAPCLASS->createTransaction();
    $hash = $CAPCLASS->getHash();

    $tags = \webspell\Tags::getTags('static', $staticID);

     echo '<div class="panel panel-default">
  <div class="panel-heading">
                            <i class="fa fa-pencil-square"></i> ' . $_language->module[ 'static_pages' ] . '
                        </div>
                    <div class="panel-body">';  
	
	echo'<a href="admincenter.php?site=static" class="white">' . $_language->module['static_pages'] . '</a> &raquo; ' . $_language->module['edit_static_page'] . '<br><br>';
	
	

	echo '<form class="form-horizontal" method="post" id="post" name="post" action="admincenter.php?site=static" enctype="post" onsubmit="return chkFormular();">
	<div class="row">

<div class="col-md-6">

  <div class="form-group">
    <label class="col-sm-2 control-label">' . $_language->module[ 'title' ] . ':</label>
    <div class="col-sm-8"><span class="text-muted small"><em>
      <input class="form-control" type="text" name="title" size="60" value="' . getinput($ds[ 'title' ]) . '" /></em></span>
    </div>
  </div>

<div class="form-group">
    <label class="col-sm-2 control-label">' . $_language->module[ 'tags' ] . ':</label>
    <div class="col-sm-8"><span class="text-muted small"><em>
    <input class="form-control" type="text" name="tags" size="60" value="' . getinput($tags) . '" /></em></span>
    </div>
  </div>

</div>
<div class="col-md-6">

  <div class="form-group">
    <label class="col-sm-2 control-label">' . $_language->module[ 'accesslevel' ] . ':</label>
    <div class="col-sm-8"><span class="text-muted small"><em>
		<input name="accesslevel" type="radio" value="0" ' . $public . ' /> ' . $_language->module[ 'public' ] .
        '<br />
      <input name="accesslevel" type="radio" value="1" ' . $user . ' /> ' .
        $_language->module[ 'registered_only' ] . '<br />
      <input name="accesslevel" type="radio" value="2" ' . $clanmember . ' /> ' .
        $_language->module[ 'clanmember_only' ] . '</em></span>
    </div>
  </div>

  </div>

  </div>


  <div class="row">
  <div class="col-md-12">
 '.$_language->module['info'].'
  <div class="form-group">
    
    <div class="col-md-12"><span class="text-muted small"><em>
      <textarea class="form-control" id="message" name="message" rows="20" cols="" style="width: 100%;">' . $content . '</textarea></em></span>
    </div>
  </div>
  <div class="form-group">
    <div class="col-md-12">
		<input type="hidden" name="captcha_hash" value="' . $hash . '" />
	<input type="hidden" name="staticID" value="' . $staticID . '" />
		<button class="btn btn-success" type="submit" name="save"  />' . $_language->module['edit_static_page'] . '</button>
    </div>
  </div>

  </div>
  </div>
	</form></div></div>';
} else {

    echo '<div class="panel panel-default">
  <div class="panel-heading">
                            <i class="fa fa-pencil-square"></i> ' . $_language->module[ 'static_pages' ] . '
                        </div>
                    <div class="panel-body">
          <div class="col-md-10 form-group"><a href="admincenter.php?site=admin_history" class="white">' . $_language->module[ 'static_pages' ] .
    '</a> &raquo; New / Edit</div>
<div class="col-md-2 form-group"><br></div>';

    echo '<a href="admincenter.php?site=static&amp;action=add" class="btn btn-primary" type="button">' . $_language->module[ 'new_static_page' ] . '</a>
<br><br>';

    $ergebnis = safe_query("SELECT * FROM " . PREFIX . "static ORDER BY staticID");
	
  echo'<table class="table table-striped">
    <thead>
      <th><b>' . $_language->module['id'] . '</b></th>
      <th><b>' . $_language->module['title'] . '</b></th>
      <th><b>' . $_language->module['accesslevel'] . '</b></th>
      <th><b>' . $_language->module['actions'] . '</b></th>
    </thead>';

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
        if ($ds[ 'accesslevel' ] == 2) {
            $accesslevel = $_language->module[ 'clanmember_only' ];
        } elseif ($ds[ 'accesslevel' ] == 1) {
            $accesslevel = $_language->module[ 'registered_only' ];
        } else {
            $accesslevel = $_language->module[ 'public' ];
        }

            $title = $ds[ 'title' ];

            $translate = new multiLanguage(detectCurrentLanguage());
            $translate->detectLanguages($title);
            $title = $translate->getTextByLanguage($title);
                
            $title = toggle(htmloutput($title), 1);
            $title = toggle($title, 1);

        echo '<tr>
      <td>' . $ds['staticID'] . '</td>
      <td><a href="../index.php?site=static&amp;staticID=' . $ds['staticID'] . '" target="_blank">' . $title . '</a></td>
      <td>' . $accesslevel . '</td>
      <td><a href="admincenter.php?site=static&amp;action=edit&amp;staticID=' . $ds['staticID'] . '" class="hidden-xs hidden-sm btn btn-warning" type="button">' . $_language->module[ 'edit' ] . '</a>

        <input class="hidden-xs hidden-sm btn btn-danger" type="button" onclick="MM_confirm(\'' . $_language->module['really_delete'] . '\', \'admincenter.php?site=static&amp;delete=true&amp;staticID=' . $ds['staticID'] . '&amp;captcha_hash=' . $hash . '\')" value="' . $_language->module['delete'] . '" />

	  <a href="admincenter.php?site=static&amp;action=edit&amp;staticID=' . $ds['staticID'] . '"  class="mobile visible-xs visible-sm" type="button"><i class="fa fa-pencil"></i></a>
      <a class="mobile visible-xs visible-sm" type="button" onclick="MM_confirm(\'' . $_language->module['really_delete'] . '\', \'admincenter.php?site=static&amp;delete=true&amp;staticID=' . $ds['staticID'] . '&amp;captcha_hash=' . $hash . '\')" /><i class="fa fa-times"></i></a></td>
    </tr>';
    
    $i++;
	}
	echo'</table>';
}
echo '</div></div>';
?>