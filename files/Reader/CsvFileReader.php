<?php
require_once('FileReaderInterface.php');

class CsvFileReader implements FileReaderInterface
{
    private $filePath;

    private $fp;

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    /**
     * This function will do the basic level of validation of file.
     * @return bool
     * @throws Exception
     */
    public function validate(): bool
    {
        if ($this->filePath === null) {
            throw new \Exception("Please define file with data");
        }

        if (!file_exists($this->filePath)) {
            throw new \Exception("Please define file with data");
        }

        if (!is_readable($this->filePath)) {
            throw new \Exception("We have not rights to read this file");
        }

        if (pathinfo($this->filePath, PATHINFO_EXTENSION) != 'csv') {
            throw new \Exception("Not a csv file");
        }

        return true;
    }

    public function read()
    {
        $this->fp = fopen($this->filePath, "r");

        return $this->fp;
    }

    public function close()
    {
        fclose($this->fp);
    }
}
