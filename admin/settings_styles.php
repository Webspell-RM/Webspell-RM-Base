<?php
/*
##########################################################################
#                                                                        #
#           Version 4       /                        /   /               #
#          -----------__---/__---__------__----__---/---/-               #
#           | /| /  /___) /   ) (_ `   /   ) /___) /   /                 #
#          _|/_|/__(___ _(___/_(__)___/___/_(___ _/___/___               #
#                       Free Content / Management System                 #
#                                   /                                    #
#                                                                        #
#                                                                        #
#   Copyright 2005-2015 by webspell.org                                  #
#                                                                        #
#   visit webSPELL.org, webspell.info to get webSPELL for free           #
#   - Script runs under the GNU GENERAL PUBLIC LICENSE                   #
#   - It's NOT allowed to remove this copyright-tag                      #
#   -- http://www.fsf.org/licensing/licenses/gpl.html                    #
#                                                                        #
#   Code based on WebSPELL Clanpackage (Michael Gruber - webspell.at),   #
#   Far Development by Development Team - webspell.org                   #
#                                                                        #
#   visit webspell.org                                                   #
#                                                                        #
##########################################################################
*/

$_language->readModule('styles', false, true);

if (!ispageadmin($userID) || mb_substr(basename($_SERVER[ 'REQUEST_URI' ]), 0, 15) != "admincenter.php") {
    die($_language->module[ 'access_denied' ]);
}

echo '<div class="panel panel-default">
  <div class="panel-heading">
                            <i class="fa fa-thumbs-up"></i> Setting
                        </div>
                       <div class="panel-body">
                        
                        
  <ul class="nav nav-tabs-primary">
    <li role="presentation"><a href="./admincenter.php?site=settings">Setting</a></li>            
    <li role="presentation" class="active"><a href="./admincenter.php?site=settings_styles">Style</a></li>
    <li role="presentation"><a href="./admincenter.php?site=settings_buttons">Buttons</a></li>
    <li role="presentation"><a href="./admincenter.php?site=settings_moduls">Module</a></li>
    <li role="presentation"><a href="./admincenter.php?site=settings_head_moduls">Page Head Module</a></li>
    <li role="presentation"><a href="./admincenter.php?site=settings_content_head_moduls">Content Head Module</a></li>
    <li role="presentation"><a href="./admincenter.php?site=settings_content_foot_moduls">Content Foot Module</a></li>
    <li role="presentation"><a href="./admincenter.php?site=settings_css">.css</a></li>
    <li role="presentation"><a href="./admincenter.php?site=settings_templates">Templates</a></li>
    <li role="presentation"><a href="./admincenter.php?site=settings_logo">Logo</a></li>
  </ul>
<ol class="breadcrumb-primary"> </ol>
 ';

if (isset($_POST[ 'submit' ])) {
    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_POST[ 'captcha_hash' ])) {
        $error = array();
        $sem = '/^#[a-fA-F0-9]{6}/';
        
        
        if (count($error)) {
            echo '<b>' . $_language->module[ 'errors' ] . ':</b><br /><ul>';

            foreach ($error as $err) {
                echo '<li>' . $err . '</li>';
            }
            echo '</ul><br /><input type="button" onclick="javascript:history.back()" value="' .
                $_language->module[ 'back' ] . '" />';
        } else {
            safe_query(
                "UPDATE " . PREFIX . "settings_styles
                SET body1='" . $_POST[ 'body1' ] . "',
                body2='" . $_POST[ 'body2' ] . "',
                body3='" . $_POST[ 'body3' ] . "',
                body4='" . $_POST[ 'body4' ] . "',
                typo1='" . $_POST[ 'typo1' ] . "',
                typo2='" . $_POST[ 'typo2' ] . "',
                typo3='" . $_POST[ 'typo3' ] . "',
                typo4='" . $_POST[ 'typo4' ] . "',
                typo5='" . $_POST[ 'typo5' ] . "',
                typo6='" . $_POST[ 'typo6' ] . "',
                typo7='" . $_POST[ 'typo7' ] . "',
                typo8='" . $_POST[ 'typo8' ] . "',
                foot1='" . $_POST[ 'foot1' ] . "',
                foot2='" . $_POST[ 'foot2' ] . "',
                foot3='" . $_POST[ 'foot3' ] . "',
                nav1='" . $_POST[ 'nav1' ] . "',
                nav2='" . $_POST[ 'nav2' ] . "',
                nav3='" . $_POST[ 'nav3' ] . "',
                nav4='" . $_POST[ 'nav4' ] . "',
                nav5='" . $_POST[ 'nav5' ] . "',
                nav6='" . $_POST[ 'nav6' ] . "',
                nav7='" . $_POST[ 'nav7' ] . "',
                nav8='" . $_POST[ 'nav8' ] . "' "
            );
           
            redirect("admincenter.php?site=settings_styles", "", 0);
        }
    } else {
        echo $_language->module[ 'transaction_invalid' ];
    }
} else {
    $ergebnis = safe_query("SELECT * FROM " . PREFIX . "settings_styles");
    $ds = mysqli_fetch_array($ergebnis);

    

    $CAPCLASS = new \webspell\Captcha;
    $CAPCLASS->createTransaction();
    $hash = $CAPCLASS->getHash();


    echo '<form class="form-horizontal" method="post" action="admincenter.php?site=settings_styles" enctype="multipart/form-data">

  <div class="page-header">
  <h1>Navi</h1>
</div> 
<div class="row"> 
<div class="col-md-6">

<div class="form-group">
    <label class="col-sm-2 control-label">Background:</label>
    <div id="cp12" class="input-group colorpicker-component col-sm-8"><span class="text-muted small"><em>
    <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /></em></span> <span class="input-group-addon"><i></i></span> 
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Font-size:</label>
    <div class="col-sm-8"><span class="text-muted small"><em>
   <input class="form-control" type="text" name="nav2" value="' . $ds[ 'nav2' ] . '" /></em></span>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">border-top-size:</label>
    <div class="col-sm-8"><span class="text-muted small"><em>
   <input class="form-control" type="text" name="nav6" value="' . $ds[ 'nav6' ] . '" /></em></span>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">border-top color:</label>
    <div id="cp15" class="input-group colorpicker-component col-sm-8"><span class="text-muted small"><em>
    <input type="text" value="' . $ds[ 'nav5' ] . '" class="form-control" name="nav5" /></em></span> <span class="input-group-addon"><i></i></span> 
      </div>
  </div>

</div>
  <div class="col-md-6">

  <div class="form-group">
    <label class="col-sm-2 control-label">Main a:</label>
    <div id="cp25" class="input-group colorpicker-component col-sm-8"><span class="text-muted small"><em>
    <input type="text" value="' . $ds[ 'nav7' ] . '" class="form-control" name="nav7" /></em></span> <span class="input-group-addon"><i></i></span> 
      </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Main a:hover:</label>
    <div id="cp26" class="input-group colorpicker-component col-sm-8"><span class="text-muted small"><em>
    <input type="text" value="' . $ds[ 'nav8' ] . '" class="form-control" name="nav8" /></em></span> <span class="input-group-addon"><i></i></span> 
      </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">Sub a:</label>
    <div id="cp13" class="input-group colorpicker-component col-sm-8"><span class="text-muted small"><em>
    <input type="text" value="' . $ds[ 'nav3' ] . '" class="form-control" name="nav3" /></em></span> <span class="input-group-addon"><i></i></span> 
      </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Sub a:hover:</label>
    <div id="cp14" class="input-group colorpicker-component col-sm-8"><span class="text-muted small"><em>
    <input type="text" value="' . $ds[ 'nav4' ] . '" class="form-control" name="nav4" /></em></span> <span class="input-group-addon"><i></i></span> 
      </div>
  </div>
  
 </div>

</div>
  
<div class="page-header">
  <h1>Body</h1>
</div> 
<div class="row"> 
<div class="col-md-6">

<div class="form-group">
    <label class="col-sm-2 control-label">Font-family:</label>
    <div class="col-sm-8"><span class="text-muted small"><em>
   <input class="form-control" type="text" name="body1" value="' . $ds[ 'body1' ] . '" /></em></span>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Font-size:</label>
    <div class="col-sm-8"><span class="text-muted small"><em>
   <input class="form-control" type="text" name="body2" value="' . $ds[ 'body2' ] . '" /></em></span>
    </div>
  </div>

</div>
  <div class="col-md-6">

  <div class="form-group">
    <label class="col-sm-2 control-label">Background:</label>
    <div id="cp1" class="input-group colorpicker-component col-sm-8"><span class="text-muted small"><em>
    <input type="text" value="' . $ds[ 'body3' ] . '" class="form-control" name="body3" /></em></span> <span class="input-group-addon"><i></i></span> 
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">Color:</label>
    <div id="cp2" class="input-group colorpicker-component col-sm-8"><span class="text-muted small"><em>
    <input type="text" value="' . $ds[ 'body4' ] . '" class="form-control" name="body4" /></em></span> <span class="input-group-addon"><i></i></span> 
    </div>
  </div>

</div>

</div>


<div class="page-header">
    <h1>Typography</h1>
  </div>

  
  <div class="row">
    

    <div class="col-md-4">
      <div class="well" style="background: '.$ds['typo1'].';">
        <h1 style="color: '.$ds['typo2'].';">h1. Heading 1</h1>
        <h2 style="color: '.$ds['typo2'].';">h2. Heading 2</h2>
        <h3 style="color: '.$ds['typo2'].';">h3. Heading 3</h3>
        <h4 style="color: '.$ds['typo2'].';">h4. Heading 4</h4>
        <h5 style="color: '.$ds['typo2'].';">h5. Heading 5</h5>
        <h6 style="color: '.$ds['typo3'].';">h6. Heading 6</h6>
      </div>
    </div>
    
   <div class="col-md-4">
      <h3 style="color: '.$ds['typo2'].';">Example body text</h3>
      <p style="font-size: '.$ds['typo5'].'; color: '.$ds['body4'].';">Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
      <p style="font-size: '.$ds['typo5'].'; color: '.$ds['body4'].';">Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Donec sed odio dui.</p>
    
    </div>
  
    <div class="col-md-4">
       <h3 style="color: '.$ds['typo2'].';">Example addresses</h3>
      <address  style="font-size: '.$ds['body2'].'; color: '.$ds['body4'].';">
        <strong>Twitter, Inc.</strong><br>
        795 Folsom Ave, Suite 600<br>
        San Francisco, CA 94107<br>
        <abbr title="Phone">P:</abbr> (123) 456-7890
      </address>
      <address style="font-size: '.$ds['body2'].'; color: '.$ds['body4'].';">
        <strong>Full Name</strong><br>
        <a style="color: '.$ds['typo4'].'; visited: color:'.$ds['typo8'].';" href="mailto:#">first.last@gmail.com</a>
      </address>
    </div>

  

   </div>

<div class="row">
<div class="col-md-3">
<div class="form-group">
    <label class="col-sm-5 control-label">Well bg-color:</label>
    <div id="cp3" class="input-group colorpicker-component col-sm-7"><span class="text-muted small"><em>
    <input type="text" value="' . $ds[ 'typo1' ] . '" class="form-control" name="typo1" /></em></span> <span class="input-group-addon"><i></i></span> 
    </div>
  </div>


  </div>
  
    <div class="col-md-3">
    <div class="form-group">
    <label class="col-sm-5 control-label">H color:</label>
    <div id="cp4" class="input-group colorpicker-component col-sm-7"><span class="text-muted small"><em>
    <input type="text" value="' . $ds[ 'typo2' ] . '" class="form-control" name="typo2" /></em></span> <span class="input-group-addon"><i></i></span> 
    </div>
  </div>

</div>

<div class="col-md-3">
<div class="form-group">
    <label class="col-sm-5 control-label">H6 color:</label>
    <div id="cp5" class="input-group colorpicker-component col-sm-7"><span class="text-muted small"><em>
    <input type="text" value="' . $ds[ 'typo3' ] . '" class="form-control" name="typo3" /></em></span> <span class="input-group-addon"><i></i></span> 
    </div>
  </div>


  </div>
  <div class="col-md-3">
  <div class="form-group">
    <label class="col-sm-5 control-label">p font-size:</label>
    <div class="col-sm-7"><span class="text-muted small"><em>
   <input class="form-control" type="text" name="typo5" value="' . $ds[ 'typo5' ] . '" /></em></span>
    </div>
  </div>

  </div>

</div>

<div class="row">
<div class="col-md-3">
<div class="form-group">
    <label class="col-sm-5 control-label">a color:</label>
    <div id="cp6" class="input-group colorpicker-component col-sm-7"><span class="text-muted small"><em>
    <input type="text" value="' . $ds[ 'typo4' ] . '" class="form-control" name="typo4" /></em></span> <span class="input-group-addon"><i></i></span> 
    </div>
  </div>


  </div>
  <div class="col-md-3">
<div class="form-group">
    <label class="col-sm-5 control-label">a hover:</label>
    <div id="cp8" class="input-group colorpicker-component col-sm-7"><span class="text-muted small"><em>
    <input type="text" value="' . $ds[ 'typo8' ] . '" class="form-control" name="typo8" /></em></span> <span class="input-group-addon"><i></i></span> 
    </div>
  </div>


  </div>
  
    <div class="col-md-3">
    <div class="form-group">
    <label class="col-sm-5 control-label">Page-header divider:</label>
    <div id="cp7" class="input-group colorpicker-component col-sm-7"><span class="text-muted small"><em>
    <input type="text" value="' . $ds[ 'typo6' ] . '" class="form-control" name="typo6" /></em></span> <span class="input-group-addon"><i></i></span> 
    </div>
  </div>

</div>

<div class="col-md-3">
<div class="form-group">
    <label class="col-sm-5 control-label">Page-header border:</label>
    <div class="col-sm-7"><span class="text-muted small"><em>
   <input class="form-control" type="text" name="typo7" value="' . $ds[ 'typo7' ] . '" /></em></span>
    </div>
  </div>

  </div>
  

</div>


<div class="page-header">
    <h1>Footer</h1>
  </div>


<div class="row">
<div class="col-md-6">
<div class="form-group">
    <label class="col-sm-2 control-label">bg-color:</label>
    <div id="cp16" class="input-group colorpicker-component col-sm-8"><span class="text-muted small"><em>
    <input type="text" value="' . $ds[ 'foot1' ] . '" class="form-control" name="foot1" /></em></span> <span class="input-group-addon"><i></i></span> 
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">H3 color:</label>
    <div id="cp27" class="input-group colorpicker-component col-sm-8"><span class="text-muted small"><em>
    <input type="text" value="' . $ds[ 'foot3' ] . '" class="form-control" name="foot3" /></em></span> <span class="input-group-addon"><i></i></span> 
    </div>
  </div>

  </div>
  
    <div class="col-md-6">
    <div class="form-group">
    <label class="col-sm-2 control-label">color:</label>
    <div id="cp17" class="input-group colorpicker-component col-sm-8"><span class="text-muted small"><em>
    <input type="text" value="' . $ds[ 'foot2' ] . '" class="form-control" name="foot2" /></em></span> <span class="input-group-addon"><i></i></span> 
    </div>
  </div>

</div>

</div>

<div class="form-group">
    <div class="col-sm-12">
      <input type="hidden" name="captcha_hash" value="'.$hash.'" />
  <button class="btn btn-primary" type="submit" name="submit" />'.$_language->module['update'].'</button>
    </div>
  </div>
</form>';
}
echo '</div></div>';
?>
