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
$_language->readModule('countries', false, true);

$ergebnis = safe_query("SELECT * FROM ".PREFIX."navigation_dashboard_links WHERE modulname='logo'");
    while ($db=mysqli_fetch_array($ergebnis)) {
      $accesslevel = 'is'.$db['accesslevel'].'admin';

if (!$accesslevel($userID) || mb_substr(basename($_SERVER[ 'REQUEST_URI' ]), 0, 15) != "admincenter.php") {
    die($_language->module[ 'access_denied' ]);
}
}


$filepath = "../includes/themes/$theme_name/images/";

if (isset($_GET[ 'action' ])) {
    $action = $_GET[ 'action' ];
} else {
    $action = '';
}

if ($action == "edit") {
    $ds =
        mysqli_fetch_array(safe_query(
            "SELECT * FROM " . PREFIX . "settings_logo WHERE logoID='" . $_GET[ "logoID" ] .
            "'"
        ));

    $CAPCLASS = new \webspell\Captcha;
    $CAPCLASS->createTransaction();
    $hash = $CAPCLASS->getHash();
    
    $logo = '';
    if(isset($ds['logo']) && file_exists($filepath.$ds['logo'])) {
        $logo = '<img style="max-width: 220px; max-height: 220px; "src="'.$filepath.$ds['logo'].'" alt="" title="" />';
    }    

  echo '<div class="card">
        <div class="card-header">
            <i class="fas fa-image"></i> Logo
        </div>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="admincenter.php?site=settings_logo">Logo</a></li>
    <li class="breadcrumb-item active" aria-current="page">new Logo</li>
  </ol>
</nav>

<div class="card-body">';

    echo '<form method="post" action="admincenter.php?site=settings_logo" enctype="multipart/form-data">


<div class="form-group row">
    <label class="col-md-2 control-label">' . $_language->module['present_icon'] . ':</label>
    <div class="col-md-8">
      <p class="form-control-static">'.$logo.'</p>
    </div>
  </div>
<div class="form-group row">
    <label class="col-md-2 control-label"></label>
    <div class="col-md-8">
      <input name="icon" class="form-control-file" type="file" size="40" />
    </div>
  </div>

<div class="form-group row">
    <div class="col-md-offset-2 col-md-10">
        <input type="hidden" name="captcha_hash" value="' . $hash . '" />
                <input type="hidden" name="logoID" value="' . $ds[ 'logoID' ] . '" />
                <input type="hidden" name="logo" value="' . $ds[ 'logo' ] . '" />
        <button class="btn btn-warning" type="submit" name="saveedit"  />' . $_language->module['edit'] . '</button>
    </div>
  </div>
  </form>
  </div>
  </div>';

}
elseif (isset($_POST[ "saveedit" ])) {
    $icon = $_FILES[ "icon" ];
    $logoID = $_POST[ "logoID" ];
    
    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_POST[ 'captcha_hash' ])) {
        if (checkforempty(array('logo'))) {

            $errors = array();

            //TODO: should be loaded from root language folder
            $_language->readModule('formvalidation', true);

            $upload = new \webspell\HttpUpload('icon');
            if ($upload->hasFile()) {
                if ($upload->hasError() === false) {
                    $mime_types = array('image/jpeg','image/png','image/gif');

                    if ($upload->supportedMimeType($mime_types)) {
                        $imageInformation = getimagesize($upload->getTempFile());

                        if (is_array($imageInformation)) {
							switch ($imageInformation[ 2 ]) {
								case 1:
									$endung = '.gif';
									break;
								case 3:
									$endung = '.png';
									break;
								default:
									$endung = '.jpg';
									break;
							}
                            $file = $logoID.$endung;

                            if ($upload->saveAs($filepath . $file, true)) {
                                @chmod($filepath . $file, $new_chmod);
                                safe_query("UPDATE " . PREFIX . "settings_logo SET logo='" . $file . "' WHERE logoID='" . $logoID . "'" );  
                            }
                        } else {
                            $errors[] = $_language->module['broken_image'];
                        }
                    } else {
                        $errors[] = $_language->module['unsupported_image_type'];
                    }
                } else {
                    $errors[] = $upload->translateError();
                }
            }
            if (count($errors)) {
                $errors = array_unique($errors);
                echo generateErrorBoxFromArray($_language->module['errors_there'], $errors);
            }

        } else {
            echo $_language->module['information_incomplete'];
        }
    } else {
        echo $_language->module[ 'transaction_invalid' ];
    }
    redirect("admincenter.php?site=settings_logo", "", 0);    
}
else {
    echo '<div class="card">
        <div class="card-header">
            <i class="fas fa-image"></i> Logo
        </div>
<div class="card-body">
<form method="post" action="admincenter.php?site=settings_logo">
  <table class="table table-striped">
    
<thead>

      <tr>
	  <th>Logo</th>
      <th>' . $_language->module['actions'] . ':</th>
    </tr></thead>
          <tbody>';

    $qry = safe_query("SELECT * FROM `" . PREFIX . "settings_logo` ORDER BY `logoID`");
    $anz = mysqli_num_rows($qry);
    if ($anz) {
        $CAPCLASS = new \webspell\Captcha;
        $CAPCLASS->createTransaction();
        $hash = $CAPCLASS->getHash();

        $i = 1;
        while ($ds = mysqli_fetch_array($qry)) {
            
            if ($i % 2) {
                $td = 'td1';
            } else {
                $td = 'td2';
            }
            
                $logo = '<img style="max-width: 220px; max-height: 220px; "src="'.$filepath.$ds['logo'].'" alt="" title="" />';
           
			
			echo '<tr class="table-secondary">
				<td class="' . $td . '" >'.$logo.'</td>
                <td><a href="admincenter.php?site=settings_logo&amp;action=edit&amp;logoID='. $ds[ 'logoID' ]. '" class="btn btn-warning" type="button">' . $_language->module[ 'edit' ] . '</a>';

            $i++;
        }
    } else {
        echo '<tr>
            <td class="td1" colspan="5">keine Einträge vorhanden</td>
        </tr>';
    }
    echo '</table>';	
}
?>