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

$_language->readModule('styles', false, true);

$ergebnis = safe_query("SELECT * FROM ".PREFIX."navigation_dashboard_links WHERE modulname='ac_styles'");
    while ($db=mysqli_fetch_array($ergebnis)) {
      $accesslevel = 'is'.$db['accesslevel'].'admin';

if (!$accesslevel($userID) || mb_substr(basename($_SERVER[ 'REQUEST_URI' ]), 0, 15) != "admincenter.php") {
    die($_language->module[ 'access_denied' ]);
}
}


echo '<style>
    label {
     font-weight: 600;
     cursor: pointer;
     margin-top: 5px;
    }
    
    h3 {
     padding: 5px 0px 15px 10px;
     margin: 0px;
    }
    
    .btn-update {
     background-color: #54d416;
     color: #FFF;
     font-weight: 600;
     text-transform: uppercase;
     text-shadow: 0px 1px rgba(0,0,0,0.2);
     border-bottom: 1px solid #57ca20;
     padding: 15px;
     margin-bottom: 0px;
     transition: 0.3s;
     border-radius: 3px;
    }
    
    .btn-update:hover {
      background-color: #62db27;
      color: #FFF;
      border: 1px solid transparent;
      box-shadow: none;
      transition: 0.3s;
    }
    
    .no-padd {
     padding-left: 0px;
     padding-right: 0px;
    }
    
    .btn-sticky {
     position: absolute;
     top: 0;
     right: 0;
     margin: 50px;
     box-shadow: 0 8px 9px -6px rgba(0,0,0,0.4);
   }
    
    .tooltip {
     font-size: 14px;
    }
    
    .file {
     visibility: hidden;
     position: absolute;
    }
    .bbot {
     border-bottom: 1px solid #EFEFEF; 
     margin-bottom: 16px;
    }
   </style><div class="">';

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
                nav8='" . $_POST[ 'nav8' ] . "',
                gen1='" . $_POST[ 'gen1' ] . "',
                gen2='" . $_POST[ 'gen2' ] . "',
                gen3='" . $_POST[ 'gen3' ] . "',
                gen4='" . $_POST[ 'gen4' ] . "'"
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
    
 <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true"> <!-- accordion start -->
  
  <div class="panel panel-default"> <!-- panel 1 start -->
   <div class="card-header" role="tab" id="headingOne">
    <h4 class="mb-0">
     <button class="btn btn-link" type="button" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
      <i class="fas fa-globe"></i> Global Settings
     </button>
    </h4>
   </div>
   
   <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne"> <!-- content 1 start -->
    <div class="card-body">
     
     <div class="row"> <!-- row start -->

       <h3>Background settings</h3>
       <div class="col-md-12 bbot">
       <div class="form-group row">
        <label class="col-md-2" data-toggle="tooltip" data-placement="top" title="<?php echo $tooltip1 ?>">Background color:</label>
        <div id="cp12" class="input-group colorpicker-component col-md-3">
         <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
        </div>
       </div>
       </div>
      
       <div class="col-md-12 bbot">
       <div class="form-group row">
        <label class="col-md-2" data-toggle="tooltip" data-placement="top" title="<?php echo $tooltip1 ?>">Header picture:</label>
        <div class="col-md-10 no-padd">
         <div class="col-md-2 no-padd">
          <input type="file" name="img[]" class="file" accept="image/*">
           <input type="text" class="form-control" disabled placeholder="Upload File" id="file"><br>
             <button type="button" class="browse btn btn-primary">upload</button>
         </div>
         <div class="col-md-10">
          <img src="https://place-hold.it/300x100" id="preview" class="img-thumbnail">
         </div>
        </div>
       </div>
       </div>
      
       <h3>hr settings</h3>
       <div class="col-md-12 bbot">
       <div class="form-group row">
        <label class="col-md-2" data-toggle="tooltip" data-placement="top" title="<?php echo $tooltip6 ?>">hr color:</label>
        <div id="cp12" class="input-group colorpicker-component col-md-3">
         <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
        </div>
       </div>
        </div>
      
       <h3>Dark container settings</h3>
       <div class="col-md-12 bbot no-padd">
       <div class="col-md-6">
       <div class="form-group row">
        <label class="col-md-4" data-toggle="tooltip" data-placement="top" title="<?php echo $tooltip10 ?>">Background color:</label>
        <div id="cp12" class="input-group colorpicker-component col-md-7 no-padd">
         <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
        </div>
       </div>
        </div>
      
       <div class="col-md-6">
       <div class="form-group row">
        <label class="col-md-4" data-toggle="tooltip" data-placement="top" title="<?php echo $tooltip10 ?>">Text color:</label>
        <div id="cp12" class="input-group colorpicker-component col-md-7">
         <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
        </div>
       </div>
        </div>
      
       <div class="col-md-6">
       <div class="form-group row">
        <label class="col-md-4" data-toggle="tooltip" data-placement="top" title="<?php echo $tooltip10 ?>">border-top color:</label>
        <div id="cp12" class="input-group colorpicker-component col-md-7">
         <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
        </div>
       </div>
        </div>
      
       <div class="col-md-6">
       <div class="form-group row">
        <label class="col-md-4" data-toggle="tooltip" data-placement="top" title="<?php echo $tooltip10 ?>">h2 text color:</label>
        <div id="cp12" class="input-group colorpicker-component col-md-7">
         <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
        </div>
       </div>
        </div>
      
       <div class="col-md-6">
       <div class="form-group row">
        <label class="col-md-4" data-toggle="tooltip" data-placement="top" title="<?php echo $tooltip10 ?>">h2 bottom border:</label>
        <div id="cp12" class="input-group colorpicker-component col-md-7">
         <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
        </div>
       </div>
        </div>
      
       <div class="col-md-6">
       <div class="form-group row">
        <label class="col-md-4" data-toggle="tooltip" data-placement="top" title="<?php echo $tooltip10 ?>">h2 span border:</label>
        <div id="cp12" class="input-group colorpicker-component col-md-7">
         <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
        </div>
       </div>
        </div>
        </div>
   
      
       <h3>Pagination settings</h3>
       <div class="col-md-12 no-padd">
       <div class="col-md-6">
       <div class="form-group row">
        <label class="col-md-4" data-toggle="tooltip" data-placement="top" title="<?php echo $tooltip10 ?>">li background color:</label>
        <div id="cp12" class="input-group colorpicker-component col-md-7">
         <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
        </div>
       </div>
        </div>
      
       <div class="col-md-6">
       <div class="form-group row">
        <label class="col-md-4" data-toggle="tooltip" data-placement="top" title="<?php echo $tooltip10 ?>">li background color:hover</label>
        <div id="cp12" class="input-group colorpicker-component col-md-7">
         <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
        </div>
       </div>
        </div>
      
       <div class="col-md-6">
       <div class="form-group row">
        <label class="col-md-4" data-toggle="tooltip" data-placement="top" title="<?php echo $tooltip10 ?>">li text color</label>
        <div id="cp12" class="input-group colorpicker-component col-md-7">
         <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
        </div>
       </div>
        </div>
      
       <div class="col-md-6">
       <div class="form-group row">
        <label class="col-md-4" data-toggle="tooltip" data-placement="top" title="<?php echo $tooltip10 ?>">li text color:hover</label>
        <div id="cp12" class="input-group colorpicker-component col-md-7">
         <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
        </div>
       </div>
        </div>
      
       <div class="col-md-6">
       <div class="form-group row">
        <label class="col-md-4" data-toggle="tooltip" data-placement="top" title="<?php echo $tooltip10 ?>">h2 bottom border:</label>
        <div id="cp12" class="input-group colorpicker-component col-md-7">
         <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
        </div>
       </div>
        </div>
      
       <div class="col-md-6">
       <div class="form-group row">
        <label class="col-md-4" data-toggle="tooltip" data-placement="top" title="<?php echo $tooltip10 ?>">h2 span border:</label>
        <div id="cp12" class="input-group colorpicker-component col-md-7">
         <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
        </div>
       </div>
        </div>
        </div>

  
    </div>  <!-- row end -->
     
     
     
    </div> <!-- card-body end -->
  </div> <!-- content 1 end -->
  </div> <!-- panel 1 end -->
  
  <div class="panel panel-default"> <!-- Panel 2 Start -->
   <div class="card-header" role="tab" id="headingTwo">
    <h4 class="mb-0">
     <button class="btn btn-link" type="button" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-font"></i> Typography
     </button>
    </h4>
   </div>
   
   <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
    <div class="card-body">
     
     <div class="row"> <!-- row start -->
     
     <h3>Font settings</h3>
     <div class="col-md-12 bbot no-padd">
       <div class="col-md-6">
       <div class="form-group row">
        <label class="col-md-4" data-toggle="tooltip" data-placement="top" title="<?php echo $tooltip10 ?>">font size:</label>
        <div id="cp12" class="input-group colorpicker-component col-md-7">
         <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
        </div>
       </div>
        </div>
      
       <div class="col-md-6">
       <div class="form-group row">
        <label class="col-md-4" data-toggle="tooltip" data-placement="top" title="<?php echo $tooltip10 ?>">font color:</label>
        <div id="cp12" class="input-group colorpicker-component col-md-7">
         <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
        </div>
       </div>
        </div>
      
       <div class="col-md-6">
       <div class="form-group row">
        <label class="col-md-4" data-toggle="tooltip" data-placement="top" title="<?php echo $tooltip10 ?>">link color a</label>
        <div id="cp12" class="input-group colorpicker-component col-md-7">
         <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
        </div>
       </div>
        </div>
      
       <div class="col-md-6">
       <div class="form-group row">
        <label class="col-md-4" data-toggle="tooltip" data-placement="top" title="<?php echo $tooltip10 ?>">link color a:hover</label>
        <div id="cp12" class="input-group colorpicker-component col-md-7">
         <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
        </div>
       </div>
        </div>
        </div>
      
       <h3>h2 settings</h3>
       <div class="col-md-12 bbot no-padd">
       <div class="col-md-6">
       <div class="form-group row">
        <label class="col-md-4" data-toggle="tooltip" data-placement="top" title="<?php echo $tooltip7 ?>">h2 text color:</label>
        <div id="cp12" class="input-group colorpicker-component col-md-7">
         <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
        </div>
       </div>
        </div>
      
       <div class="col-md-6">
       <div class="form-group row">
        <label class="col-md-4" data-toggle="tooltip" data-placement="top" title="<?php echo $tooltip8 ?>">h2 text weight:</label>
        <div id="cp12" class="input-group colorpicker-component col-md-7">
         <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
        </div>
       </div>
        </div>
      
       <div class="col-md-6">
       <div class="form-group row">
        <label class="col-md-4" data-toggle="tooltip" data-placement="top" title="<?php echo $tooltip9 ?>">h2 bottom border:</label>
        <div id="cp12" class="input-group colorpicker-component col-md-7">
         <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
        </div>
       </div>
        </div>
      
       <div class="col-md-6">
       <div class="form-group row">
        <label class="col-md-4" data-toggle="tooltip" data-placement="top" title="<?php echo $tooltip10 ?>">h2 span border:</label>
        <div id="cp12" class="input-group colorpicker-component col-md-7">
         <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
        </div>
       </div>
        </div>
        </div>
      
       <h3>Color settings</h3>
       <div class="col-md-12 no-padd">
       <div class="col-md-6">
       <div class="form-group row">
        <label class="col-md-4"  data-toggle="tooltip" data-placement="top" title="<?php echo $tooltip6 ?>">bg-primary:</label>
        <div id="cp12" class="input-group colorpicker-component col-md-7">
         <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
        </div>
       </div>
       </div>
        </div>
     
     
     </div> <!-- row end -->
    </div> <!-- card body end -->
   </div> <!-- collapse end -->
  </div> <!-- Panel 2 End -->
  
  <div class="panel panel-default"> <!-- Panel 3 Start -->
   <div class="card-header" role="tab" id="headingThree">
    <h4 class="mb-0">
     <button class="btn btn-link" type="button" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
      <i class="fas fa-bars"></i> Navigation
     </button>
    </h4>
   </div>
   
   <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
    <div class="card-body">
     
     <div class="row"> <!-- row start -->
     
       <h3>Main navigation settings</h3>
       <div class="col-md-12 bbot no-padd">
       <div class="col-md-6">
       <div class="form-group row">
        <label class="col-md-4" data-toggle="tooltip" data-placement="top" title="<?php echo $tooltip7 ?>">link color a:</label>
        <div id="cp12" class="input-group colorpicker-component col-md-7">
         <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
        </div>
       </div>
        </div>
      
       <div class="col-md-6">
       <div class="form-group row">
        <label class="col-md-4" data-toggle="tooltip" data-placement="top" title="<?php echo $tooltip8 ?>">link color a:hover</label>
        <div id="cp12" class="input-group colorpicker-component col-md-7">
         <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
        </div>
       </div>
        </div>
      
       <div class="col-md-6">
       <div class="form-group row">
        <label class="col-md-4" data-toggle="tooltip" data-placement="top" title="<?php echo $tooltip9 ?>">background color a:hover</label>
        <div id="cp12" class="input-group colorpicker-component col-md-7">
         <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
        </div>
       </div>
        </div>
      
       <div class="col-md-6">
       <div class="form-group row">
        <label class="col-md-4" data-toggle="tooltip" data-placement="top" title="<?php echo $tooltip10 ?>">border-top color:</label>
        <div id="cp12" class="input-group colorpicker-component col-md-7">
         <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
        </div>
       </div>
        </div>
        </div>
      
       <h3>Dropdown navigation settings</h3>
       <div class="col-md-12 no-padd">
       <div class="col-md-6">
       <div class="form-group row">
        <label class="col-md-4" data-toggle="tooltip" data-placement="top" title="<?php echo $tooltip7 ?>">link color a:</label>
        <div id="cp12" class="input-group colorpicker-component col-md-7">
         <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
        </div>
       </div>
        </div>
      
       <div class="col-md-6">
       <div class="form-group row">
        <label class="col-md-4" data-toggle="tooltip" data-placement="top" title="<?php echo $tooltip8 ?>">link color a:hover</label>
        <div id="cp12" class="input-group colorpicker-component col-md-7">
         <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
        </div>
       </div>
        </div>
      
       <div class="col-md-6">
       <div class="form-group row">
        <label class="col-md-4" data-toggle="tooltip" data-placement="top" title="<?php echo $tooltip9 ?>">background color a:hover</label>
        <div id="cp12" class="input-group colorpicker-component col-md-7">
         <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
        </div>
       </div>
        </div>
        </div>
     

     </div> <!-- row end -->
    </div> <!-- card body end -->
   </div> <!-- collapse end -->
  </div> <!-- Panel 3 End -->
  
  <div class="panel panel-default"> <!-- Panel 4 Start -->
   <div class="card-header" role="tab" id="headingFour">
    <h4 class="mb-0">
     <button class="btn btn-link" type="button" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
      <i class="fas fa-square"></i> Buttons
     </button>
    </h4>
   </div>
   
   <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
    <div class="card-body">
     
     <div class="row"> <!-- row start -->
     
       <h3>Button settings</h3>


      
       <table class="table">
         <thead>
           <tr>
             <th scope="col">Button:</th>
             <th scope="col">Background color:</th>
             <th scope="col">Background color hover:</th>
             <th scope="col">font color:</th>
             <th scope="col">font color hover:</th>
             <th scope="col">border color:</th>
             <th scope="col">border color hover:</th>
           </tr>
         </thead>
         <tbody>
           <tr>
             <th scope="row"><btn class="btn btn-primary">Primary</btn></th>
             <td>
              <div class="form-group row">
               <div id="cp12" class="input-group colorpicker-component col-md-8">
                <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
               </div>
              </div>
             </td>
             <td>
              <div class="form-group row">
               <div id="cp12" class="input-group colorpicker-component col-md-8">
                <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
               </div>
              </div>
             </td>
             <td>
              <div class="form-group row">
               <div id="cp12" class="input-group colorpicker-component col-md-8">
                <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
               </div>
              </div>
             </td>
             <td>
              <div class="form-group row">
               <div id="cp12" class="input-group colorpicker-component col-md-8">
                <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
               </div>
              </div>
             </td>
             <td>
              <div class="form-group row">
               <div id="cp12" class="input-group colorpicker-component col-md-8">
                <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
               </div>
              </div>
             </td>
             <td>
              <div class="form-group row">
               <div id="cp12" class="input-group colorpicker-component col-md-8">
                <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
               </div>
              </div>
             </td>
           </tr>
           <tr>
             <th scope="row"><btn class="btn btn-secondary">Secondary</btn></th>
             <td>
              <div class="form-group row">
               <div id="cp12" class="input-group colorpicker-component col-md-8">
                <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
               </div>
              </div>
             </td>
             <td>
              <div class="form-group row">
               <div id="cp12" class="input-group colorpicker-component col-md-8">
                <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
               </div>
              </div>
             </td>
             <td>
              <div class="form-group row">
               <div id="cp12" class="input-group colorpicker-component col-md-8">
                <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
               </div>
              </div>
             </td>
             <td>
              <div class="form-group row">
               <div id="cp12" class="input-group colorpicker-component col-md-8">
                <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
               </div>
              </div>
             </td>
             <td>
              <div class="form-group row">
               <div id="cp12" class="input-group colorpicker-component col-md-8">
                <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
               </div>
              </div>
             </td>
             <td>
              <div class="form-group row">
               <div id="cp12" class="input-group colorpicker-component col-md-8">
                <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
               </div>
              </div>
             </td>
           </tr>
           <tr>
             <th scope="row"><btn class="btn btn-success">Success</btn></th>
             <td>
              <div class="form-group row">
               <div id="cp12" class="input-group colorpicker-component col-md-8">
                <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
               </div>
              </div>
             </td>
             <td>
              <div class="form-group row">
               <div id="cp12" class="input-group colorpicker-component col-md-8">
                <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
               </div>
              </div>
             </td>
             <td>
              <div class="form-group row">
               <div id="cp12" class="input-group colorpicker-component col-md-8">
                <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
               </div>
              </div>
             </td>
             <td>
              <div class="form-group row">
               <div id="cp12" class="input-group colorpicker-component col-md-8">
                <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
               </div>
              </div>
             </td>
             <td>
              <div class="form-group row">
               <div id="cp12" class="input-group colorpicker-component col-md-8">
                <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
               </div>
              </div>
             </td>
             <td>
              <div class="form-group row">
               <div id="cp12" class="input-group colorpicker-component col-md-8">
                <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
               </div>
              </div>
             </td>
           </tr>
          <tr>
             <th scope="row"><btn class="btn btn-danger">Danger</btn></th>
             <td>
              <div class="form-group row">
               <div id="cp12" class="input-group colorpicker-component col-md-8">
                <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
               </div>
              </div>
             </td>
             <td>
              <div class="form-group row">
               <div id="cp12" class="input-group colorpicker-component col-md-8">
                <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
               </div>
              </div>
             </td>
             <td>
              <div class="form-group row">
               <div id="cp12" class="input-group colorpicker-component col-md-8">
                <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
               </div>
              </div>
             </td>
             <td>
              <div class="form-group row">
               <div id="cp12" class="input-group colorpicker-component col-md-8">
                <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
               </div>
              </div>
             </td>
             <td>
              <div class="form-group row">
               <div id="cp12" class="input-group colorpicker-component col-md-8">
                <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
               </div>
              </div>
             </td>
             <td>
              <div class="form-group row">
               <div id="cp12" class="input-group colorpicker-component col-md-8">
                <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
               </div>
              </div>
             </td>
           </tr>
          <tr>
             <th scope="row"><btn class="btn btn-warning">Warning</btn></th>
             <td>
              <div class="form-group row">
               <div id="cp12" class="input-group colorpicker-component col-md-8">
                <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
               </div>
              </div>
             </td>
             <td>
              <div class="form-group row">
               <div id="cp12" class="input-group colorpicker-component col-md-8">
                <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
               </div>
              </div>
             </td>
             <td>
              <div class="form-group row">
               <div id="cp12" class="input-group colorpicker-component col-md-8">
                <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
               </div>
              </div>
             </td>
             <td>
              <div class="form-group row">
               <div id="cp12" class="input-group colorpicker-component col-md-8">
                <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
               </div>
              </div>
             </td>
             <td>
              <div class="form-group row">
               <div id="cp12" class="input-group colorpicker-component col-md-8">
                <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
               </div>
              </div>
             </td>
             <td>
              <div class="form-group row">
               <div id="cp12" class="input-group colorpicker-component col-md-8">
                <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
               </div>
              </div>
             </td>
           </tr>
          <tr>
             <th scope="row"><btn class="btn btn-info">Info</btn></th>
             <td>
              <div class="form-group row">
               <div id="cp12" class="input-group colorpicker-component col-md-8">
                <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
               </div>
              </div>
             </td>
             <td>
              <div class="form-group row">
               <div id="cp12" class="input-group colorpicker-component col-md-8">
                <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
               </div>
              </div>
             </td>
             <td>
              <div class="form-group row">
               <div id="cp12" class="input-group colorpicker-component col-md-8">
                <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
               </div>
              </div>
             </td>
             <td>
              <div class="form-group row">
               <div id="cp12" class="input-group colorpicker-component col-md-8">
                <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
               </div>
              </div>
             </td>
             <td>
              <div class="form-group row">
               <div id="cp12" class="input-group colorpicker-component col-md-8">
                <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
               </div>
              </div>
             </td>
             <td>
              <div class="form-group row">
               <div id="cp12" class="input-group colorpicker-component col-md-8">
                <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
               </div>
              </div>
             </td>
           </tr>
          <tr>
             <th scope="row"><btn class="btn btn-light">Light</btn></th>
             <td>
              <div class="form-group row">
               <div id="cp12" class="input-group colorpicker-component col-md-8">
                <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
               </div>
              </div>
             </td>
             <td>
              <div class="form-group row">
               <div id="cp12" class="input-group colorpicker-component col-md-8">
                <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
               </div>
              </div>
             </td>
             <td>
              <div class="form-group row">
               <div id="cp12" class="input-group colorpicker-component col-md-8">
                <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
               </div>
              </div>
             </td>
             <td>
              <div class="form-group row">
               <div id="cp12" class="input-group colorpicker-component col-md-8">
                <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
               </div>
              </div>
             </td>
             <td>
              <div class="form-group row">
               <div id="cp12" class="input-group colorpicker-component col-md-8">
                <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
               </div>
              </div>
             </td>
             <td>
              <div class="form-group row">
               <div id="cp12" class="input-group colorpicker-component col-md-8">
                <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
               </div>
              </div>
             </td>
           </tr>
          <tr>
             <th scope="row"><btn class="btn btn-dark">Dark</btn></th>
             <td>
              <div class="form-group row">
               <div id="cp12" class="input-group colorpicker-component col-md-8">
                <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
               </div>
              </div>
             </td>
             <td>
              <div class="form-group row">
               <div id="cp12" class="input-group colorpicker-component col-md-8">
                <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
               </div>
              </div>
             </td>
             <td>
              <div class="form-group row">
               <div id="cp12" class="input-group colorpicker-component col-md-8">
                <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
               </div>
              </div>
             </td>
             <td>
              <div class="form-group row">
               <div id="cp12" class="input-group colorpicker-component col-md-8">
                <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
               </div>
              </div>
             </td>
             <td>
              <div class="form-group row">
               <div id="cp12" class="input-group colorpicker-component col-md-8">
                <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
               </div>
              </div>
             </td>
             <td>
              <div class="form-group row">
               <div id="cp12" class="input-group colorpicker-component col-md-8">
                <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
               </div>
              </div>
             </td>
           </tr>
         </tbody>
       </table>

     </div> <!-- row end -->
    </div> <!-- card body end -->
   </div> <!-- collapse end -->
  </div> <!-- Panel 4 End -->
  
  <div class="panel panel-default"> <!-- Panel 5 Start -->
   <div class="card-header" role="tab" id="headingFive">
    <h4 class="mb-0">
     <button class="btn btn-link" type="button" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
      <i class="fab fa-wpforms"></i> Form Settings
     </button>
    </h4>
   </div>
   
   <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
    <div class="card-body">
     
     <div class="row"> <!-- row start -->
     
       <h3>Form control settings</h3>
       <div class="col-md-12 no-padd">
       <div class="col-md-6">
       <div class="form-group row">
        <label class="col-md-4" data-toggle="tooltip" data-placement="top" title="<?php echo $tooltip7 ?>">text color:</label>
        <div id="cp12" class="input-group colorpicker-component col-md-7">
         <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
        </div>
       </div>
        </div>
      
       <div class="col-md-6">
       <div class="form-group row">
        <label class="col-md-4" data-toggle="tooltip" data-placement="top" title="<?php echo $tooltip8 ?>">border bottom color: </label>
        <div id="cp12" class="input-group colorpicker-component col-md-7">
         <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
        </div>
       </div>
        </div>
      
       <div class="col-md-6">
       <div class="form-group row">
        <label class="col-md-4" data-toggle="tooltip" data-placement="top" title="<?php echo $tooltip9 ?>">text color :focus</label>
        <div id="cp12" class="input-group colorpicker-component col-md-7">
         <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
        </div>
       </div>
        </div>
      
       <div class="col-md-6">
       <div class="form-group row">
        <label class="col-md-4" data-toggle="tooltip" data-placement="top" title="<?php echo $tooltip10 ?>">input anim. border color:</label>
        <div id="cp12" class="input-group colorpicker-component col-md-7">
         <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
        </div>
       </div>
        </div>
        </div>
     

     </div> <!-- row end -->
    </div> <!-- card body end -->
   </div> <!-- collapse end -->
  </div> <!-- Panel 5 End -->
  
  <div class="panel panel-default"> <!-- Panel 6 Start -->
   <div class="card-header" role="tab" id="headingSix">
    <h4 class="mb-0">
     <button class="btn btn-link" type="button" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
      <i class="fas fa-boxes"></i> Plugins Settings
     </button>
    </h4>
   </div>
   
   <div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSix">
    <div class="card-body">
     
     <div class="alert alert-warning">Führe hier bitte erst Änderungen durch, wenn das zu bearbeitende Plugin auch zuvor installiert wurde! Diese Änderungen betreffen <strong>nur</strong> die jeweiligen Widgets und themebedingte Anpassungen. Übergreifende CSS Eigenschaften bleiben im jeweiligen Plugin enthalten!<br><br>Theme angepasste Plugins sind: <strong>Navigation Default, Carousel, News, eSport Footer, Clanwars, Squads, Streams, Videos, Sponsors </strong></div>
     
     <div class="row"> <!-- row start -->
     
       <h3>Carousel plugin settings</h3>
       <div class="col-md-12 bbot no-padd">
       <div class="col-md-6">
       <div class="form-group row">
        <label class="col-md-4" data-toggle="tooltip" data-placement="top" title="<?php echo $tooltip7 ?>">Items height (in vh):</label>
        <div class="col-md-7 no-padd">
         <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" />
        </div>
       </div>
        </div>
      
       <div class="col-md-6">
       <div class="form-group row">
        <label class="col-md-4" data-toggle="tooltip" data-placement="top" title="<?php echo $tooltip8 ?>">h1 text color: </label>
        <div id="cp12" class="input-group colorpicker-component col-md-7">
         <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
        </div>
       </div>
        </div>
      
       <div class="col-md-6">
       <div class="form-group row">
        <label class="col-md-4" data-toggle="tooltip" data-placement="top" title="<?php echo $tooltip9 ?>">indicator color:</label>
        <div id="cp12" class="input-group colorpicker-component col-md-7">
         <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
        </div>
       </div>
        </div>
        </div>
      
       <h3>News plugin settings</h3>
       <div class="col-md-12 bbot no-padd">
       <div class="col-md-6">
       <div class="form-group row">
        <label class="col-md-4" data-toggle="tooltip" data-placement="top" title="<?php echo $tooltip6 ?>">newsbox background:</label>
        <div id="cp12" class="input-group colorpicker-component col-md-7">
         <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
        </div>
       </div>
       </div>
        </div>
      
       <h3>Clanwars plugin settings</h3>
       <div class="col-md-12 bbot">
       <div class="col-md-6">
       <div class="form-group row">
        <label class="col-md-4" data-toggle="tooltip" data-placement="top" title="<?php echo $tooltip7 ?>">text color:</label>
        <div id="cp12" class="input-group colorpicker-component col-md-7">
         <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
        </div>
       </div>
        </div>
      
       <div class="col-md-6">
       <div class="form-group row">
        <label class="col-md-4" data-toggle="tooltip" data-placement="top" title="<?php echo $tooltip8 ?>">border bottom color: </label>
        <div id="cp12" class="input-group colorpicker-component col-md-7">
         <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
        </div>
       </div>
        </div>
      
       <div class="col-md-6">
       <div class="form-group row">
        <label class="col-md-4" data-toggle="tooltip" data-placement="top" title="<?php echo $tooltip9 ?>">background color:hover</label>
        <div id="cp12" class="input-group colorpicker-component col-md-7">
         <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
        </div>
       </div>
        </div>
        </div>
      
       <h3>Squads plugin settings</h3>
       <div class="col-md-12 bbot no-padd">
       <div class="col-md-6">
       <div class="form-group row">
        <label class="col-md-4" data-toggle="tooltip" data-placement="top" title="<?php echo $tooltip7 ?>">h1 color:</label>
        <div id="cp12" class="input-group colorpicker-component col-md-7">
         <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
        </div>
       </div>
        </div>
      
       <div class="col-md-6">
       <div class="form-group row">
        <label class="col-md-4" data-toggle="tooltip" data-placement="top" title="<?php echo $tooltip8 ?>">h5 color: </label>
        <div id="cp12" class="input-group colorpicker-component col-md-7">
         <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
        </div>
       </div>
        </div>
      
       <div class="col-md-6">
       <div class="form-group row">
        <label class="col-md-4" data-toggle="tooltip" data-placement="top" title="<?php echo $tooltip9 ?>">text color:hover</label>
        <div id="cp12" class="input-group colorpicker-component col-md-7">
         <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
        </div>
       </div>
        </div>
        </div>
      
       <h3>eSport footer plugin settings</h3>
       <div class="col-md-12 no-padd">
       <div class="col-md-6">
       <div class="form-group row">
        <label class="col-md-4" data-toggle="tooltip" data-placement="top" title="<?php echo $tooltip7 ?>">background color:</label>
        <div id="cp12" class="input-group colorpicker-component col-md-7">
         <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
        </div>
       </div>
        </div>
      
       <div class="col-md-6">
       <div class="form-group row">
        <label class="col-md-4" data-toggle="tooltip" data-placement="top" title="<?php echo $tooltip7 ?>">text color:</label>
        <div id="cp12" class="input-group colorpicker-component col-md-7">
         <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
        </div>
       </div>
        </div>
      
       <div class="col-md-6">
       <div class="form-group row">
        <label class="col-md-4" data-toggle="tooltip" data-placement="top" title="<?php echo $tooltip8 ?>">h4 color:</label>
        <div id="cp12" class="input-group colorpicker-component col-md-7">
         <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
        </div>
       </div>
        </div>
      
       <div class="col-md-6">
       <div class="form-group row">
        <label class="col-md-4" data-toggle="tooltip" data-placement="top" title="<?php echo $tooltip9 ?>">border top color:</label>
        <div id="cp12" class="input-group colorpicker-component col-md-7">
         <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
        </div>
       </div>
        </div>
        </div>
      
       <h3>Lower footer</h3>
       <div class="col-md-12 no-padd">
       <div class="col-md-6">
       <div class="form-group row">
        <label class="col-md-4" data-toggle="tooltip" data-placement="top" title="<?php echo $tooltip8 ?>">background color:</label>
        <div id="cp12" class="input-group colorpicker-component col-md-7">
         <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
        </div>
       </div>
        </div>
      
       <div class="col-md-6">
       <div class="form-group row">
        <label class="col-md-4" data-toggle="tooltip" data-placement="top" title="<?php echo $tooltip9 ?>">border top color:</label>
        <div id="cp12" class="input-group colorpicker-component col-md-7">
         <input type="text" value="' . $ds[ 'nav1' ] . '" class="form-control" name="nav1" /><span class="input-group-addon"><i></i></span> 
        </div>
       </div>
        </div>
        </div>

     </div> <!-- row end -->
    </div> <!-- card body end -->
   </div> <!-- collapse end -->
  </div> <!-- Panel 6 End -->
  
 
</div> <!-- accordion end -->




    <div class="btn-sticky">
      <input type="hidden" name="captcha_hash" value="'.$hash.'" />
  <button class="btn btn-update" type="submit" name="submit" />'.$_language->module['update'].'</button>
    </div>
  </div>
</form>  <script>
   $(function () {
  $(\'[data-toggle="tooltip"]\').tooltip()
})
    $(document).on("click", ".browse", function() {
  var file = $(this).parents().find(".file");
  file.trigger("click");
});
$(\'input[type="file"]\').change(function(e) {
  var fileName = e.target.files[0].name;
  $("#file").val(fileName);

  var reader = new FileReader();
  reader.onload = function(e) {
    // get loaded data and render thumbnail.
    document.getElementById("preview").src = e.target.result;
  };
  // read the image file as a data URL.
  reader.readAsDataURL(this.files[0]);
});
   </script> ';
}
echo '</div>';
