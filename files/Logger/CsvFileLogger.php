<?php

require_once('LoggerInterface.php');

class CsvFileLogger implements LoggerInterface
{
    private $fp;

    /**
     * @param string $filePath
     */
    public function __construct(string $filePath)
    {
        $this->fp = fopen($filePath, "a+");
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
