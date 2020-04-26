<?php

use app\parse\CSVParser;

// get the file from POST request data and call parse_csv() in CSVParser class
// output will be printed so it is available in json format to the caller
require("src\app\parse\CSVParser.php");
$transactions = CSVParser::parse_csv($_FILES["file"]["tmp_name"]);
echo json_encode($transactions);
?>
