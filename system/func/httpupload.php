<?php
/*-----------------------------------------------------------------\
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
\------------------------------------------------------------------*/

namespace webspell;

class HttpUpload extends Upload
{
    private $field;

    public function __construct($field_name)
    {
        parent::__construct();
        $this->field = $field_name;
        $this->error = $_FILES[ $this->field ][ 'error' ];
    }

    public function hasFile()
    {
        return (isset($_FILES[ $this->field ]) && $_FILES[ $this->field ][ 'error' ] != UPLOAD_ERR_NO_FILE);
    }

    public function hasError()
    {
        return $_FILES[ $this->field ][ 'error' ] !== UPLOAD_ERR_OK;
    }

    public function getError()
    {
        if ($this->hasFile()) {
            return $_FILES[ $this->field ][ 'error' ];
        } else {
            return null;
        }
    }

    public function getTempFile()
    {
        return $_FILES[ $this->field ][ 'tmp_name' ];
    }

    public function getFileName()
    {
        return basename($_FILES[ $this->field ][ 'name' ]);
    }

    public function getSize()
    {
        return $_FILES[ $this->field ]['size'];
    }

    public function saveAs($newFilePath, $override = true)
    {
        if (!file_exists($newFilePath) || $override) {
            return move_uploaded_file($this->getTempFile(), $newFilePath);
        } else {
            return false;
        }
    }

    protected function getFallbackMimeType()
    {
        return $_FILES[ $this->field ][ 'type' ];
    }
}
