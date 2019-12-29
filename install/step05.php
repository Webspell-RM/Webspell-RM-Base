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
$hp_url = (isset($_POST['hp_url'])) ?
    $_POST['hp_url'] : CurrentUrl();

if ($_POST['installtype']=="full" && $_POST['hp_url']) {

?>

    <div class="card">
        <div class="card-head">
            <h3 class="card-title"><?=$_language->module['data_config']; ?></h3>
        </div>
        <div class="card-body">
            <div class="form-horizontal">
                <div class="row">
                    <div class="col-md-3">
                        <br>
                        <i class="fa fa-exclamation-triangle fa-2x" style="color: #ee5f5b;"></i> <b style="color: #ee5f5b;"><?=$_language->module['min_requirements']; ?>:</b><br>
                        <p><?=$_language->module['php_ver']; ?></p>
                    </div>
                    <div class="col-md-9">
                        
                        <div class="form-grouprow">
                            <label for="hostname" class="control-label col-md-6 "><?=$_language->module['host_name']; ?>:</label>
                            <div class="input-group col-md-6 ">
                                <input type="text" class="form-control" name="host" value="localhost">
                                <div class="input-group-addon"><a href="#" data-toggle="tooltip" data-placement="top" title="<?=$_language->module['tooltip_1']; ?>">&nbsp;<i class="fa fa-question-circle fa-2x"></i></a></div>
                            </div>
                        </div> <!-- form-group-end -->

                        <div class="form-group">
                            <label for="mysql" class="col-md-6 control-label"><?=$_language->module['mysql_username']; ?>:</label>
                            <div class="input-group col-md-6">
                                <input type="text" class="form-control" name="user">
                                <div class="input-group-addon"><a href="#" data-toggle="tooltip" data-placement="top" title="<?=$_language->module['tooltip_2']; ?>">&nbsp;<i class="fa fa-question-circle fa-2x"></i></a></div>
                            </div>
                        </div> <!-- form-group-end -->

                        <div class="form-group">
                            <label for="mysqlpw" class="col-md-6 control-label"><?=$_language->module['mysql_password']; ?>:</label>
                            <div class="input-group col-md-6">
                                <input type="password" class="form-control" name="pwd">
                                <div class="input-group-addon"><a href="#" data-toggle="tooltip" data-placement="top" title="<?=$_language->module['tooltip_3']; ?>">&nbsp;<i class="fa fa-question-circle fa-2x"></i></a></div>
                            </div>
                        </div> <!-- form-group-end -->

                        <div class="form-group">
                            <label for="db" class="col-md-6 control-label"><?=$_language->module['mysql_database']; ?>:</label>
                            <div class="input-group col-md-6">
                                <input type="text" class="form-control" name="db">
                                <div class="input-group-addon"><a href="#" data-toggle="tooltip" data-placement="top" title="<?=$_language->module['tooltip_4']; ?>">&nbsp;<i class="fa fa-question-circle fa-2x"></i></a></div>
                            </div>
                        </div> <!-- form-group-end -->
                        <div class="form-group">
                            <label for="mysqlprefix" class="col-md-6 control-label">
                                <?=$_language->module['mysql_prefix']; ?>:
                            </label>
                            <div class="input-group col-md-6">
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
                    <div class="col-md-3">
                        <br>
                        <i class="fa fa-exclamation-triangle fa-2x" style="color: #ee5f5b;"></i> <b style="color: #ee5f5b;"><?php echo $_language->module['pass_ver']; ?>:</b><br>
                        <p><?php echo $_language->module['pass_text']; ?></p>
                    </div>
                    <div class="col-md-9">
                        <div class="form-group">
                            <label for="adminname" class="col-md-6 control-label"><?php echo $_language->module['admin_username']; ?>:</label>
                            <div class="input-group col-md-6">
                                <input type="text" class="form-control" name="adminname">
                                <div class="input-group-addon"><a href="#" data-toggle="tooltip" data-placement="top" title="<?php echo $_language->module['tooltip_6']; ?>">&nbsp;<i class="fa fa-question-circle fa-2x"></i></a></div>
                            </div>
                        </div> <!-- form-group-end -->

                        <div class="form-group">
                            <label for="adminpwd" class="col-md-6 control-label"><?php echo $_language->module['admin_password']; ?>:</label>
                            <div class="input-group col-md-6">
                                <input type="password" class="form-control" name="adminpwd">
                                <div class="input-group-addon"><a href="#" data-toggle="tooltip" data-placement="top" title="<?php echo $_language->module['tooltip_7']; ?>">&nbsp;<i class="fa fa-question-circle fa-2x"></i></a></div>
                            </div>
                        </div> <!-- form-group-end -->

                        <div class="form-group">
                            <label for="adminemail" class="col-md-6 control-label"><?php echo $_language->module['admin_email']; ?>:</label>
                            <div class="input-group col-md-6">
                                <input type="text" class="form-control" name="adminmail">
                                <div class="input-group-addon"><a href="#" data-toggle="tooltip" data-placement="top" title="<?php echo $_language->module['tooltip_8']; ?>">&nbsp;<i class="fa fa-question-circle fa-2x"></i></a></div>
                            </div>
                        </div> <!-- form-group-end -->
                        <input type="hidden" name="installtype" value="<?php echo $_POST['installtype']; ?>">
                    </div> <!-- form-horizontal-end -->
                </div>
                <div class="float-right">
                    <input type="hidden" name="hp_url" value="<?=$hp_url;?>">
                    <a class="btn btn-primary" href="javascript:document.ws_install.submit()">
                        <?=$_language->module['continue']; ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
 
        <?php
        } else echo '<div class="row marketing col-md-12">
						
						
    
		<div class="card col-md-12">
            <div class="card-head">
                <h3 class="card-title">' . $_language->module['finish_install'] . '</h3>
			</div>
			<div class="card-body">
				' . $_language->module['finish_next'] . '
				<input type="hidden" name="installtype" value="'.$_POST['installtype'].'">
                <div class="float-right">
                    <a class="btn btn-primary" href="javascript:document.ws_install.submit()">
                        ' . $_language->module['continue'] . '
                    </a>
                </div>
			</div>
		</div>
        </div>';
?>
