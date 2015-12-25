<?php
ini_set('display_errors', 1);

$post = $_POST;
$get = $_GET;

$data = "";

$data .= date("Y-m-d H:i:s") . "\n";

$data .= "POST\n";
foreach ($post as $key => $value) {
    $data .= $key . "=" . $value . "\n";
}

$data .= "GET\n";
foreach ($get as $key => $value) {
    $data .= $key . "=" . $value . "\n";
}

$data .= "\n";

file_put_contents("../tmp/log.txt", $data, FILE_APPEND);

echo "finish!!";
