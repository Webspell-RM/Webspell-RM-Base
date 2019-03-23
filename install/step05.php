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

if ($_POST['installtype']=="full" && $_POST['hp_url']) {
?>

		<div class="card">
            <div class="card-head">
                <h3 class="card-title"><?=$_language->module['data_config']; ?></h3>
			</div>
			<div class="card-body">
                <div class="form-horizontal">
                	<div class="row">
                	<div class="col-sm-3">
						<br>
						<i class="fa fa-exclamation-triangle fa-2x" style="color: #ee5f5b;"></i> <b style="color: #ee5f5b;"><?=$_language->module['min_requirements']; ?>:</b><br>
						<p><?=$_language->module['php_ver']; ?></p>
					</div>
					<div class="col-sm-9">
                
					<div class="form-group">
						<label for="hostname" class="col-sm-4 control-label"><?=$_language->module['host_name']; ?>:</label>
						<div class="input-group col-sm-5">
							<input type="text" class="form-control" name="host" value="localhost">
                            <div class="input-group-addon"><a href="#" data-toggle="tooltip" data-placement="top" title="<?=$_language->module['tooltip_1']; ?>">&nbsp;<i class="fa fa-question-circle fa-2x"></i></a></div>
						</div>
					</div> <!-- form-group-end -->
                    
					<div class="form-group">
						<label for="mysql" class="col-sm-4 control-label"><?=$_language->module['mysql_username']; ?>:</label>
						<div class="input-group col-sm-5">
							<input type="text" class="form-control" name="user">
                            <div class="input-group-addon"><a href="#" data-toggle="tooltip" data-placement="top" title="<?=$_language->module['tooltip_2']; ?>">&nbsp;<i class="fa fa-question-circle fa-2x"></i></a></div>
						</div>
					</div> <!-- form-group-end -->
                    
					<div class="form-group">
						<label for="mysqlpw" class="col-sm-4 control-label"><?=$_language->module['mysql_password']; ?>:</label>
						<div class="input-group col-sm-5">
							<input type="password" class="form-control" name="pwd">
                            <div class="input-group-addon"><a href="#" data-toggle="tooltip" data-placement="top" title="<?=$_language->module['tooltip_3']; ?>">&nbsp;<i class="fa fa-question-circle fa-2x"></i></a></div>
						</div>
					</div> <!-- form-group-end -->
                    
					<div class="form-group">
						<label for="db" class="col-sm-4 control-label"><?=$_language->module['mysql_database']; ?>:</label>
						<div class="input-group col-sm-5">
							<input type="text" class="form-control" name="db">
                            <div class="input-group-addon"><a href="#" data-toggle="tooltip" data-placement="top" title="<?=$_language->module['tooltip_4']; ?>">&nbsp;<i class="fa fa-question-circle fa-2x"></i></a></div>
						</div>
					</div> <!-- form-group-end -->
					<div class="form-group">
						<label for="mysqlprefix" class="col-sm-4 control-label"><?=$_language->module['mysql_prefix']; ?>:</label>
						<div class="input-group col-sm-2">
							<input type="text" class="form-control" name="prefix" value="<?='rm_' . RandPass(3) . '_'; ?>">
                            <div class="input-group-addon"><a href="#" data-toggle="tooltip" data-placement="top" title="<?=$_language->module['tooltip_5']; ?>">&nbsp;<i class="fa fa-question-circle fa-2x"></i></a></div>
						</div>
					</div> <!-- form-group-end -->   
                    </div>
                </div> <!-- form-horizontal-end -->
			</div>
		</div>
	</div>
		<div class="card">
            <div class="card-head">
                <h3 class="card-title"><?php echo $_language->module['webspell_config']; ?></h3>
			</div>
			<div class="card-body">
                <div class="form-horizontal">
                	<div class="row">
					<div class="col-sm-3">
						<br>
						<i class="fa fa-exclamation-triangle fa-2x" style="color: #ee5f5b;"></i> <b style="color: #ee5f5b;"><?php echo $_language->module['pass_ver']; ?>:</b><br>
						<p><?php echo $_language->module['pass_text']; ?></p>
					</div>
					<div class="col-sm-9">
					<div class="form-group">
						<label for="adminname" class="col-sm-4 control-label"><?php echo $_language->module['admin_username']; ?>:</label>
						<div class="input-group col-sm-5">
							<input type="text" class="form-control" name="adminname">
                            <div class="input-group-addon"><a href="#" data-toggle="tooltip" data-placement="top" title="<?php echo $_language->module['tooltip_6']; ?>">&nbsp;<i class="fa fa-question-circle fa-2x"></i></a></div>
						</div>
					</div> <!-- form-group-end -->
                    
					<div class="form-group">
						<label for="adminpwd" class="col-sm-4 control-label"><?php echo $_language->module['admin_password']; ?>:</label>
						<div class="input-group col-sm-5">
							<input type="password" class="form-control" name="adminpwd">
                            <div class="input-group-addon"><a href="#" data-toggle="tooltip" data-placement="top" title="<?php echo $_language->module['tooltip_7']; ?>">&nbsp;<i class="fa fa-question-circle fa-2x"></i></a></div>
						</div>
					</div> <!-- form-group-end -->
                    
					<div class="form-group">
						<label for="adminemail" class="col-sm-4 control-label"><?php echo $_language->module['admin_email']; ?>:</label>
						<div class="input-group col-sm-5">
							<input type="text" class="form-control" name="adminmail">
                            <div class="input-group-addon"><a href="#" data-toggle="tooltip" data-placement="top" title="<?php echo $_language->module['tooltip_8']; ?>">&nbsp;<i class="fa fa-question-circle fa-2x"></i></a></div>
						</div>
					</div> <!-- form-group-end -->
                    <input type="hidden" name="installtype" value="<?php echo $_POST['installtype']; ?>">
                </div> <!-- form-horizontal-end -->
            </div>
                <div class="pull-right"><a class="btn btn-primary" href="javascript:document.ws_install.submit()">continue</a></div>
			</div>
		</div>
    </div><!-- row end -->
        <input type="hidden" name="url" value="<?=CurrentUrl();?>">

        <?php
        } else echo '<div class="row marketing">
						
						
    
		<div class="card">
            <div class="card-head">
                <h3 class="card-title">' . $_language->module['finish_install'] . '</h3>
			</div>
			<div class="card-body">
				' . $_language->module['finish_next'] . '
				<input type="hidden" name="installtype" value="'.$_POST['installtype'].'">
                <div class="pull-right"><a class="btn btn-primary" href="javascript:document.ws_install.submit()">continue</a></div>
			</div>
		</div>';
?>