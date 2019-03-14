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

if($_POST['agree'] == "1") {
	
	
	
	//version test
	$versionerror=false;
	if(phpversion()=='5.2.6') $versionerror=true;
?>

		<div class="card">
            <div class="card-head">
                <h3 class="card-title">
					<?php if ($versionerror) {
                    echo $_language->module['error'];
                } else {
                    echo $_language->module['your_site_url'];
                } ?>
            	</h3>
			</div>
			<div class="card-body">
				<?php if ($versionerror) {
                echo '<p style="color: #FF0000; font-weight: bold;">' . $_language->module['php_version'] . ':</p>
		<p>' . $_language->module['php_info'] . '</p><br><br>';
            } else {
                echo '' . $_language->module['enter_url'] . '
				<div class="form-group">
					<label for="wheretoinstall">Adresse:</label>
					
					<div class="input-group">
						
						<input type="text" class="form-control col-md-4" name="hp_url" value="' . CurrentUrl() . '">
					</div>
				</div>
				<span id="helpBlock" class="help-block"><small>' . $_language->module['tooltip'] . '</small></span>';
            }
            ?>
                <a class="btn btn-primary" href="javascript:document.ws_install.submit()">continue</a>
			</div>
		</div><!-- row end -->

<?php
} else {
?>
<div class="row marketing">
    <div class="col-md-12">
        <div class="alert alert-danger">
			<?=$_language->module['you_have_to_agree']; ?>
            
		</div>
		<a  class="btn btn-danger" href="index.php?step=1">back</a>
    </div>
</div> <!-- row end -->
<?php
}
