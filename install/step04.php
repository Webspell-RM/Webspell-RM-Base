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

?>
<form method="post">
    <div class="card">
        <div class="card-head">
            <h3 class="card-title"><?=$_language->module['select_install']; ?></h3>
        </div>
        <div class="card-body">
        <?=$_language->module['what_to_do']; ?>

            <div class="radio">
                <label>
                    <input type="radio" name="installtype" value="full" checked="checked" id="full_install">
                    <?=$_language->module['new_install']; ?>
                </label>
            </div>        
            <div class="pull-right">
                <input type="hidden" name="hp_url" value="<?=$hp_url;?>">
                <a class="btn btn-primary" href="javascript:document.ws_install.submit()">
                    <?=$_language->module['continue']; ?>
                </a>
            </div>
        </div>
    </div>
</form>
