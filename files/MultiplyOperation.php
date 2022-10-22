<?php

require_once('OperationInterface.php');

class MultiplyOperation implements OperationInterface
{

    /**
     * @var FileReaderInterface
     */
    private $fileSourceInterface;
    /**
     * @var LoggerInterface
     */
    private $loggerInterface;
    /**
     * @var LoggerInterface
     */
    private $resultLoggerInterface;

    public function __construct(
        FileReaderInterface $fileSourceInterface,
        LoggerInterface     $loggerInterface,
        LoggerInterface     $resultLoggerInterface
    )
    {
        $this->fileSourceInterface = $fileSourceInterface;
        $this->loggerInterface = $loggerInterface;
        $this->resultLoggerInterface = $resultLoggerInterface;
    }

    public function process()
    {
        $this->loggerInterface->write("Started multiply operation");

        $fileData = $this->fileSourceInterface->read();

        while (($line = fgets($fileData)) !== false) {
            $line = explode(";", $line);
            $number1 = intval($line[0]);
            $number2 = intval($line[1]);

            if ($this->validate($number1, $number2)) {
                $result = $number1 * $number2;
                $data = $number1 . ";" . $number2 . ";" . $result;
                $this->resultLoggerInterface->write($data);
            } else {
                $this->loggerInterface->write("numbers " . $number1 . " and " . $number2 . " are wrong");
            }
        }
        $this->loggerInterface->write("Finished multiply operation");
    }

    public function __destruct()
    {
        $this->resultLoggerInterface->close();
        $this->loggerInterface->close();
        $this->fileSourceInterface->close();
    }

    public function validate(int $number1, int $number2): bool
    {
        return $number1 * $number2 > 0;
    }
}