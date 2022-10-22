<?php

require_once('LoggerInterface.php');

class TextFileLogger implements LoggerInterface
{
    private $fp;

    /**
     * @param string $filePath
     */
    public function __construct(string $filePath)
    {
        $this->fp = fopen($filePath, "w+");
    }

    public function write(string $data)
    {
        fwrite($this->fp, "$data \r\n");
    }

    public function close()
    {
        fclose($this->fp);
    }
}
