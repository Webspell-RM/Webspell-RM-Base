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

class UrlUpload extends Upload
{
    private $tempFile;
    private $file;
    private $fileName;
    public function __construct($url)
    {
        parent::__construct();
        $this->file = $url;
        $this->error = UPLOAD_ERR_NO_FILE;
        $this->download();
    }

    private function download()
    {
        if (empty($this->file) === false) {
            $this->tempFile = tempnam('tmp/', 'upload_');
            $this->fileName = basename(parse_url($this->file, PHP_URL_PATH));
            if (copy($this->file, $this->tempFile)) {
                $this->error = UPLOAD_ERR_OK;
            } else {
                $this->error = self::UPLOAD_ERR_CANT_READ;
            }
        } else {
            $this->error = UPLOAD_ERR_NO_FILE;
        }
    }

    public function hasFile()
    {
        return ($this->error != UPLOAD_ERR_NO_FILE);
    }

    public function hasError()
    {
        return ($this->error !== UPLOAD_ERR_OK);
    }

    public function getError()
    {
        if ($this->hasFile()) {
            return $this->error;
        } else {
            return null;
        }
    }

    public function getTempFile()
    {
        return $this->tempFile;
    }

    public function getFileName()
    {
        return $this->fileName;
    }

    public function getSize()
    {
        return filesize($this->getTempFile());
    }

    protected function getFallbackMimeType()
    {
        $headers = get_headers($this->file, 1);
        return (isset($headers['Content-Type'])) ? $headers['Content-Type'] : "application/octet-stream";
    }

    public function saveAs($newFilePath, $override = true)
    {
        if (!file_exists($newFilePath) || $override) {
            return rename($this->getTempFile(), $newFilePath);
        } else {
            return false;
        }
    }
}
