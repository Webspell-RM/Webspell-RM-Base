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
$_language->readModule('webnavi', false, true);

$ergebnis = safe_query("SELECT * FROM ".PREFIX."navigation_dashboard_links WHERE modulname='webnavi'");
    while ($db=mysqli_fetch_array($ergebnis)) {
      $accesslevel = 'is'.$db['accesslevel'].'admin';

if (!$accesslevel($userID) || mb_substr(basename($_SERVER[ 'REQUEST_URI' ]), 0, 15) != "admincenter.php") {
    die($_language->module[ 'access_denied' ]);
}
}

if (isset($_GET[ 'delete' ])) {
    $snavID = $_GET[ 'snavID' ];
    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_GET[ 'captcha_hash' ])) {
        safe_query("DELETE FROM " . PREFIX . "navigation_website_sub WHERE snavID='$snavID' ");
    } else {
        echo $_language->module[ 'transaction_invalid' ];
        redirect("admincenter.php?site=webside_navigation",3);
    return false;
    }
} elseif (isset($_GET[ 'delcat' ])) {
    $mnavID = $_GET[ 'mnavID' ];
    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_GET[ 'captcha_hash' ])) {
        safe_query("UPDATE " . PREFIX . "navigation_website_sub SET mnavID='0' WHERE mnavID='$mnavID' ");
        safe_query("DELETE FROM " . PREFIX . "navigation_website_main WHERE mnavID='$mnavID' ");
    } else {
        echo $_language->module[ 'transaction_invalid' ];
    }
} elseif (isset($_POST[ 'sortieren' ])) {
    if(isset($_POST[ 'sortcat' ])) { $sortcat = $_POST[ 'sortcat' ]; } else { $sortcat="";}
    $sortlinks = $_POST[ 'sortlinks' ];

    if (is_array($sortcat) AND !empty($sortcat)) {
        foreach ($sortcat as $sortstring) {
            $catsorter = explode("-", $sortstring);
            safe_query("UPDATE " . PREFIX . "navigation_website_main SET sort='$catsorter[1]' WHERE mnavID='$catsorter[0]' ");
        }
    }
    if (is_array($sortlinks)) {
        foreach ($sortlinks as $sortstring) {
            $sorter = explode("-", $sortstring);
            safe_query("UPDATE " . PREFIX . "navigation_website_sub SET sort='$sorter[1]' WHERE snavID='$sorter[0]' ");
        }
    }
} elseif (isset($_POST[ 'save' ])) {
    $CAPCLASS = new \webspell\Captcha;

    $url = $_POST[ 'link' ];

    if ($CAPCLASS->checkCaptcha(0, $_POST[ 'captcha_hash' ])) {
        $anz = mysqli_num_rows(
            safe_query("SELECT snavID FROM " . PREFIX . "navigation_website_sub WHERE mnavID='" . $_POST[ 'mnavID' ] . "'")
        );
        $url = $_POST[ 'link' ];
        safe_query(
            "INSERT INTO " . PREFIX . "navigation_website_sub ( mnavID, name, url, sort )
            values (
            '" . $_POST[ 'mnavID' ] . "',
            '" . $_POST[ 'name' ] . "',
            '" . $url . "',

            '1'
            )"
        );
    } else {
        echo $_language->module[ 'transaction_invalid' ];
    }



} elseif (isset($_POST[ 'savecat' ])) {
    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_POST[ 'captcha_hash' ])
    ) {

    $url = $_POST[ 'link' ];

    if (isset($_POST[ 'isdropdown' ])) {
        $isdropdown = 1;
    } else {
        $isdropdown = 0;
    }
    if (!$isdropdown) {
        $isdropdown = 0;
    }
        $anz = mysqli_num_rows(safe_query("SELECT mnavID FROM " . PREFIX . "navigation_website_main"));
        safe_query(
            "INSERT INTO " . PREFIX . "navigation_website_main ( mnavID, name, url, isdropdown, sort )
            values( '', '" . $_POST[ 'name' ] . "', '" . $url . "', '" . $isdropdown . "', '1' )"
        );
        $id = mysqli_insert_id($_database);
    } else {
        echo $_language->module[ 'transaction_invalid' ];
    }

} elseif (isset($_POST[ 'saveedit' ])) {
    $CAPCLASS = new \webspell\Captcha;
    $url = $_POST[ 'link' ];

    
    if ($CAPCLASS->checkCaptcha(0, $_POST[ 'captcha_hash' ])) {
        safe_query(
            "UPDATE " . PREFIX . "navigation_website_sub
            SET mnavID='" . $_POST[ 'mnavID' ] . "', name='" . $_POST[ 'name' ] . "', url= '" . $url . "' 
            WHERE snavID='" . $_POST[ 'snavID' ] . "'"
        );
    } else {
        echo $_language->module[ 'transaction_invalid' ];
    }

} elseif (isset($_POST[ 'saveeditcat' ])) {
    $CAPCLASS = new \webspell\Captcha;

        $url = $_POST[ "link" ];
    if (isset($_POST[ "isdropdown" ])) {
        $isdropdown = 1;
    } else {
        $isdropdown = 0;
    }
    if ($CAPCLASS->checkCaptcha(0, $_POST[ 'captcha_hash' ])) {

    

        safe_query(
            "UPDATE " . PREFIX . "navigation_website_main SET name='" . $_POST[ 'name' ] . "', url='" . $url . "', isdropdown='" . $isdropdown . "' WHERE mnavID='" . $_POST[ 'mnavID' ] . "' "
        );

        $id = $_POST[ 'mnavID' ];
    } else {
        echo $_language->module[ 'transaction_invalid' ];
    }
}

if (isset($_GET[ 'action' ])) {
    $action = $_GET[ 'action' ];
} else {
    $action = '';
}

if ($action == "add") {
    echo '<div class="panel panel-default">
    <div class="panel-heading">
                            <i class="fas fa-map-marked"></i> ' . $_language->module[ 'dashnavi' ] . '
                        </div>
    <div class="panel-body">
    <a href="admincenter.php?site=webside_navigation" class="white">' . $_language->module[ 'dashnavi' ] .
        '</a> &raquo; ' . $_language->module[ 'add_link' ] . '<br><br>';

    $ergebnis = safe_query("SELECT * FROM " . PREFIX . "navigation_website_main ORDER BY sort");
    $cats = '<select class="form-control" name="mnavID">';
    while ($ds = mysqli_fetch_array($ergebnis)) {
        if ($ds[ 'default' ] == 0) {
            $name = $_language->module[ 'cat_' . getinput($ds[ 'name' ]) ];
        } else {
            $name = getinput($ds[ 'name' ]);
            
        }
        $cats .= '<option value="' . $ds[ 'mnavID' ] . '">' . $name . '</option>';
    }
    $cats .= '</select>';

    
    
    $CAPCLASS = new \webspell\Captcha;
    $CAPCLASS->createTransaction();
    $hash = $CAPCLASS->getHash();

    echo '<form class="form-horizontal" method="post" action="admincenter.php?site=webside_navigation">
    <div class="form-group">
    <label class="col-sm-2 control-label">'.$_language->module['category'].':</label>
    <div class="col-sm-8"><span class="text-muted small"><em>
      ' . $cats . '</em></span>
    </div>
    </div>
    <div class="form-group">
    <label class="col-sm-2 control-label">'.$_language->module['name'].':</label>
    <div class="col-sm-8"><span class="text-muted small"><em>
        <input class="form-control" type="text" name="name" size="60"></em></span>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">'.$_language->module['url'].':</label>
    <div class="col-sm-8"><span class="text-muted small"><em>
        <input class="form-control" type="text" name="link" size="60"/></td></em></span>
    </div>
  </div>

    
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <input type="hidden" name="captcha_hash" value="' . $hash . '">
      <input class="btn btn-success" type="submit" name="save" value="' . $_language->module[ 'add_link' ] . '">
    </div>
  </div>
   
          </form></div></div>';
} elseif ($action == "edit") {
    echo '<div class="panel panel-default">
    <div class="panel-heading">
                            <i class="fas fa-map-marked"></i> ' . $_language->module[ 'dashnavi' ] . '
                        </div>
                <div class="panel-body">
    <a href="admincenter.php?site=webside_navigation" class="white">' . $_language->module[ 'dashnavi' ] .
        '</a> &raquo; ' . $_language->module[ 'edit_link' ] . '<br><br>';

    $snavID = $_GET[ 'snavID' ];
    $ergebnis = safe_query("SELECT * FROM " . PREFIX . "navigation_website_sub WHERE snavID='$snavID'");
    $ds = mysqli_fetch_array($ergebnis);

    $category = safe_query("SELECT * FROM " . PREFIX . "navigation_website_main ORDER BY sort");
    $cats = '<select class="form-control" name="mnavID">';
    while ($dc = mysqli_fetch_array($category)) {
        if ($dc[ 'default' ] == 1) {
            $name = getinput($dc[ 'name' ]);
        }
        if ($ds[ 'mnavID' ] == $dc[ 'mnavID' ]) {
            $selected = " selected=\"selected\"";
        } else {
            $selected = "";
        }
        $cats .= '<option value="' . $dc[ 'mnavID' ] . '"' . $selected . '>' . $name . '</option>';
    }
    $cats .= '</select>';

    
    $CAPCLASS = new \webspell\Captcha;
    $CAPCLASS->createTransaction();
    $hash = $CAPCLASS->getHash();

    echo '<form class="form-horizontal" method="post" action="admincenter.php?site=webside_navigation">

    <div class="form-group">
    <label class="col-sm-2 control-label">'.$_language->module['category'].':</label>
    <div class="col-sm-8"><span class="text-muted small"><em>
      ' . $cats . '</em></span>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">'.$_language->module['name'].':</label>
    <div class="col-sm-8"><span class="text-muted small"><em>
      <input class="form-control" type="text" name="name" value="' . getinput($ds[ 'name' ]) . '" size="60"></em></span>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">'.$_language->module['url'].':</label>
    <div class="col-sm-8"><span class="text-muted small"><em>
      <input class="form-control" type="text" name="link" value="' . getinput($ds[ 'url' ]) . '" size="60"></em></span>
    </div>
  </div>

  
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <input type="hidden" name="captcha_hash" value="'.$hash.'" /><input type="hidden" name="snavID" value="' . $snavID . '">
      <input class="btn btn-success" type="submit" name="saveedit" value="' . $_language->module[ 'edit_link' ] . '">
    </div>
  </div>

    </form>
    </div></div>';

# new main navi
} elseif ($action == "addcat") {
    echo '<div class="panel panel-default">
    <div class="panel-heading">
                            <i class="fas fa-map-marked"></i> ' . $_language->module[ 'dashnavi' ] . '
                        </div>
            <div class="panel-body">
    <a href="admincenter.php?site=webside_navigation" class="white">' . $_language->module[ 'dashnavi' ] .
        '</a> &raquo; ' . $_language->module[ 'add_category' ] . '<br><br>';

    $CAPCLASS = new \webspell\Captcha;
    $CAPCLASS->createTransaction();
    $hash = $CAPCLASS->getHash();
    
   echo '<form class="form-horizontal" method="post" action="admincenter.php?site=webside_navigation">

    <div class="form-group">
    <label class="col-sm-2 control-label">'.$_language->module['name'].':</label>
    <div class="col-sm-8"><span class="text-muted small"><em>
      <input class="form-control" type="text" name="name" size="60"></em></span>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">'.$_language->module['url'].':</label>
    <div class="col-sm-8"><span class="text-muted small"><em>
      <input class="form-control" type="text" name="link" size="60"></em></span>
    </div>
  </div>
  
  <div class="form-group">
    <label class="col-sm-2 control-label">'.$_language->module['dropdown'].':</label>
    <div class="col-sm-8"><span class="text-muted small"><em>
      <input type="checkbox" name="isdropdown" id="isdropdown" checked="checked" /></em></span>
    </div>
  </div>
  

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <input type="hidden" name="captcha_hash" value="'.$hash.'" />
      <input class="btn btn-success" type="submit" name="savecat" value="' . $_language->module[ 'add_category' ] . '">
    </div>
  </div>

    </form>
    </div></div>';
} elseif ($action == "editcat") {
    echo '<div class="panel panel-default">
    <div class="panel-heading">
                            <i class="fas fa-map-marked"></i> ' . $_language->module[ 'dashnavi' ] . '
                        </div>
            <div class="panel-body">
    <a href="admincenter.php?site=webside_navigation" class="white">' . $_language->module[ 'dashnavi' ] .
        '</a> &raquo; ' . $_language->module[ 'edit_category' ] . '<br><br>';

    $mnavID = $_GET[ 'mnavID' ];
    $ergebnis = safe_query("SELECT * FROM " . PREFIX . "navigation_website_main WHERE mnavID='$mnavID'");
    $ds = mysqli_fetch_array($ergebnis);

    $CAPCLASS = new \webspell\Captcha;
    $CAPCLASS->createTransaction();
    $hash = $CAPCLASS->getHash();

    if ($ds[ 'isdropdown' ] == 1) {
        $isdropdown = '<input type="checkbox" name="isdropdown" value="1" checked="checked" />';
    } else {
        $isdropdown = '<input type="checkbox" name="isdropdown" value="1" />';
    }

    echo '<form class="form-horizontal" method="post" action="admincenter.php?site=webside_navigation">
<input type="hidden" name="mnavID" value="' . $ds[ 'mnavID' ] . '" />
        <div class="form-group">
    <label class="col-sm-2 control-label">' . $_language->module[ 'name' ] . ':</label>
    <div class="col-sm-8"><span class="text-muted small"><em>
      <input class="form-control" type="text" name="name" value="' . getinput($ds[ 'name' ]) . '" size="60"></em></span>
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">'.$_language->module['url'].':</label>
    <div class="col-sm-8"><span class="text-muted small"><em>
        
        <input class="form-control" id="link" rows="10" cols="" name="link" value="' . getinput($ds[ 'url' ]) .
        '" size="60"></em></span>
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">'.$_language->module['dropdown'].':</label>
    <div class="col-sm-8"><span class="text-muted small"><em>
    <p class="form-control-static">'.$isdropdown.'</p></em></span>
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <input type="hidden" name="captcha_hash" value="'.$hash.'" /><br>
      <input class="btn btn-success" type="submit" name="saveeditcat" value="' . $_language->module[ 'edit_category' ] . '">
    </div>
  </div>
    </form></div></div>';
} else {
    echo '<div class="panel panel-default">
    <div class="panel-heading">
                            <i class="fas fa-map-marked"></i> ' . $_language->module[ 'dashnavi' ] . '
                        </div>
        <div class="panel-body">';

    echo
        '<a class="btn btn-primary" href="admincenter.php?site=webside_navigation&amp;action=addcat" class="input">' .
        $_language->module[ 'new_category' ] . '</a>
        <a class="btn btn-primary" href="admincenter.php?site=webside_navigation&amp;action=add" class="input">' .
        $_language->module[ 'new_link' ] . '</a><br><br>';

    echo '<form method="post" action="admincenter.php?site=webside_navigation">
    <table class="table">
<thead>
    <tr>
      <th width="55%" ><b>' . $_language->module[ 'name' ] . '</b></th>
            <th width="20%" ><b>' . $_language->module[ 'actions' ] . '</b></th>
            <th width="8%" ><b>' . $_language->module[ 'sort' ] . '</b></th>
    </tr></thead>';

    $ergebnis = safe_query("SELECT * FROM " . PREFIX . "navigation_website_main ORDER BY sort");
    $tmp = mysqli_fetch_assoc(safe_query("SELECT count(mnavID) as cnt FROM " . PREFIX . "navigation_website_main"));
    $anz = $tmp[ 'cnt' ];
$CAPCLASS = new \webspell\Captcha;
    $CAPCLASS->createTransaction();
    $hash = $CAPCLASS->getHash();
    while ($ds = mysqli_fetch_array($ergebnis)) {

        $list = '<select name="sortcat[]">';
                for ($n = 1; $n <= $anz; $n++) {
                    $list .= '<option value="' . $ds[ 'mnavID' ] . '-' . $n . '">' . $n . '</option>';
                }
                $list .= '</select>';
                $list = str_replace(
                    'value="' . $ds[ 'mnavID' ] . '-' . $ds[ 'sort' ] . '"',
                    'value="' . $ds[ 'mnavID' ] . '-' . $ds[ 'sort' ] . '" selected="selected"',
                    $list
                );

        /*$list = '<select name="sortcat[]">';
                for ($x = 1; $x <= $anz; $x++) {
                    $list .= '<option value="' . $ds[ 'mnavID' ] . '-' . $x . '">' . $x . '</option>';
                }
                $list .= '</select>';
                $list = str_replace(
                    'value="' . $ds[ 'mnavID' ] . '-' . $ds[ 'sort' ] . '"',
                    'value="' . $ds[ 'mnavID' ] . '-' . $ds[ 'sort' ] . '" selected="selected"',
                    $list
                );*/


        if ($ds[ 'default' ] == 0) {
            $list = '<b>' . $ds[ 'list' ] . '</b>';
            $catactions = '';
            $name = $_language->module[ 'cat_' . getinput($ds[ 'name' ]) ];
        } else {
            $sort = $list;
            $catactions =
                '<a class="btn btn-warning" href="admincenter.php?site=webside_navigation&amp;action=editcat&amp;mnavID=' . $ds[ 'mnavID' ] .
                '" class="input">' . $_language->module[ 'edit' ] . '</a>
<input class="btn btn-danger" type="button" onclick="MM_confirm(\'' . $_language->module['really_delete_category'] . '\', \'admincenter.php?site=webside_navigation&amp;delcat=true&amp;mnavID=' . $ds[ 'mnavID' ] .
                '&amp;captcha_hash=' . $hash . '\')" value="' . $_language->module['delete'] . '" />';

            $name = $ds['name'];
                $translate = new multiLanguage(detectCurrentLanguage());
                $translate->detectLanguages($name);
                $name = $translate->getTextByLanguage($name);
                $name = toggle(htmloutput($name), 1);
                $name = toggle($name, 1);
                $data_array = array();
                $data_array['$name'] = $ds['name'];
        }

        echo '<tr bgcolor="#CCCCCC">
            <td width="60%" td_head"><b>' . $name . '</b><br><small>' . $ds[ 'url' ] . '</small></td>
            <td width="25%" td_head">' . $catactions . '</td>
            <td width="15%" td_head">' . $sort . '</td>
        </tr>';
        
       
        
        $links = safe_query("SELECT * FROM " . PREFIX . "navigation_website_sub WHERE mnavID='" . $ds[ 'mnavID' ] . "' ORDER BY sort");
        $tmp = mysqli_fetch_assoc(safe_query("SELECT count(snavID) as cnt FROM " . PREFIX . "navigation_website_sub WHERE mnavID='" . $ds[ 'mnavID' ] . "'"));
        $anzlinks = $tmp[ 'cnt' ];

        $i = 1;
        $CAPCLASS = new \webspell\Captcha;
        $CAPCLASS->createTransaction();
        $hash = $CAPCLASS->getHash();
        if (mysqli_num_rows($links)) {
            while ($db = mysqli_fetch_array($links)) {
                if ($i % 2) {
                    $td = 'td1';
                } else {
                    $td = 'td2';
                }

                $name = $db['name'];
                $translate = new multiLanguage(detectCurrentLanguage());
                $translate->detectLanguages($name);
                $name = $translate->getTextByLanguage($name);
                $name = toggle(htmloutput($name), 1);
                $name = toggle($name, 1);
                $data_array = array();
                $data_array['$name'] = $db['name'];

                $linklist = '<select name="sortlinks[]">';
                for ($n = 1; $n <= $anzlinks; $n++) {
                    $linklist .= '<option value="' . $db[ 'snavID' ] . '-' . $n . '">' . $n . '</option>';
                }
                $linklist .= '</select>';
                $linklist = str_replace(
                    'value="' . $db[ 'snavID' ] . '-' . $db[ 'sort' ] . '"',
                    'value="' . $db[ 'snavID' ] . '-' . $db[ 'sort' ] . '" selected="selected"',
                    $linklist
                );

                echo '<tr>
                    <td class="' . $td . '"><b>' . $name . '</b><br><small>' . $db[ 'url' ] . '</small></td>
                   
                   <td class="' . $td . '">
<a href="admincenter.php?site=webside_navigation&amp;action=edit&amp;snavID=' . $db[ 'snavID' ] .'" class="hidden-xs hidden-sm btn btn-warning">' . $_language->module[ 'edit' ] . '</a>

        <input class="hidden-xs hidden-sm btn btn-danger" type="button" onclick="MM_confirm(\'' . $_language->module['really_delete_link'] . '\', \'admincenter.php?site=webside_navigation&amp;delete=true&amp;snavID=' . $db[ 'snavID' ] . '&amp;captcha_hash=' . $hash . '\')" value="' . $_language->module['delete'] . '" />

      <a href="admincenter.php?site=webside_navigation&amp;action=edit&amp;snavID=' . $db[ 'snavID' ] .'"  class="mobile visible-xs visible-sm"><i class="fa fa-pencil"></i></a>
      <a class="mobile visible-xs visible-sm" onclick="MM_confirm(\'' . $_language->module['really_delete_link'] . '\', \'admincenter.php?site=webside_navigation&amp;delete=true&amp;snavID=' . $db[ 'snavID' ] . '&amp;captcha_hash=' . $hash . '\')" /><i class="fa fa-times"></i></a>
                    </td>
                    <td class="' . $td . '">' . $linklist . '</td>
                </tr>';
                $i++;
            }
        } else {
            echo '<tr>'.
                    '<td class="td1" colspan="4">' . $_language->module[ 'no_additional_links_available' ] . '</td>'.
                 '</tr>';
        }
    }
    
    echo '	<tr>
                <td class="td_head" colspan="4" align="right"><input class="btn btn-primary" type="submit" name="sortieren" value="' .
        $_language->module[ 'to_sort' ] . '"></td>
            </tr>
        </table>
    </form></div></div>';
}
