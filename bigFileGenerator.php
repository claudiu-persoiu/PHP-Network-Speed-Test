<?php

function stop($message) {
    echo $message . PHP_EOL;
    exit();
}

if($argc == 1) {
    stop('Usage: ' . PHP_EOL . 'php ' . basename(__FILE__) . ' <size> [<output_file>=file.dat]');
}

echo 'File creation started...' . PHP_EOL;

$size = isset($argv[1]) ? (int) $argv[1] : 10;
$file = isset($argv[2]) ? $argv[2] : 'file.dat';

$handle = fopen($file, 'w');

if(!$handle) {
    stop('File could not be created');
}

$limit = $size;
$start = time();
for($i = 0; $i < $limit; $i++) {
    $buffer = '';
    for($j = 0; $j < 1048576; $j++) {
        $buffer .= chr(rand(0, 255));
    }
    fputs($handle, $buffer);
}

fclose($handle);

echo $file . ' of ' . $size . 'MB created' . PHP_EOL;
