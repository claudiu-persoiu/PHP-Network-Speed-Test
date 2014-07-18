<?php
echo 'Test started...' . PHP_EOL;
$location = isset($argv[1]) ? $argv[1] : 'http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.js';

$handle = fopen($location, 'r');

if(!$handle) {
     echo 'Error reading file...' . PHP_EOL;
     die(1);
}

$timeStart = microtime(true);
$packSize = 0;
while(($buffer = fgets($handle, 4096)) !== false) {
     $packSize += strlen($buffer);
}

$timeEnd = microtime(true);
fclose($handle);

$diff = round($timeEnd - $timeStart, 4);

if($diff == 0) { 
     $diff = 0.0001; // prevent division by 0
}

$packSize = ($packSize / (1024 * 1024)) * 8;
echo round($packSize, 2) . 'Mb in ' . round($diff, 2) . ' seconds, ';
echo round($packSize / $diff, 2) . 'Mb/s' . PHP_EOL;
