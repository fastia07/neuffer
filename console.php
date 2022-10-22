<?php

include 'files/Reader/CsvFileReader.php';
include 'files/Logger/TextFileLogger.php';
include 'files/Logger/CsvFileLogger.php';

$shortopts = "a:f:";
$longopts = array(
    "action:",
    "file:",
);

$options = getopt($shortopts, $longopts);

if (isset($options['a'])) {
    $action = $options['a'];
} elseif (isset($options['action'])) {
    $action = $options['action'];
} else {
    $action = "xyz";
}

if (isset($options['f'])) {
    $file = $options['f'];
} elseif (isset($options['file'])) {
    $file = $options['file'];
} else {
    $file = "notexists.csv";
}

$errorLogFile = 'log.txt';
$resultFile = 'result.csv';

// first validating the CSV file, In future if we have XML file reader so we just initiate the object here.
$readCsvFile = new CsvFileReader($file);
$readCsvFile->validate();

//In future if we have Database file logger, we just initiate the object here.
$logFile = new TextFileLogger($errorLogFile);

//In future if we have Database file logger, we just initiate the object here.
$resultCsvFile = new CsvFileLogger($resultFile);

try {
    if ($action == "plus") {
        include 'files/PlusOperation.php';
        $operation = new PlusOperation(
            $readCsvFile,
            $logFile,
            $resultCsvFile
        );
    } elseif ($action == "minus") {
        include 'files/MinusOperation.php';
        $operation = new MinusOperation(
            $readCsvFile,
            $logFile,
            $resultCsvFile
        );
    } elseif ($action == "multiply") {
        include 'files/MultiplyOperation.php';
        $operation = new MultiplyOperation(
            $readCsvFile,
            $logFile,
            $resultCsvFile
        );
    } elseif ($action == "division") {
        include 'files/DivisionOperation.php';
        $operation = new DivisionOperation(
            $readCsvFile,
            $logFile,
            $resultCsvFile
        );
    } else {
        throw new \Exception("Wrong action is selected");
    }

    $operation->process();

} catch (\Exception $exception) {
}