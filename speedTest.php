<?php

echo 'Test started...' . PHP_EOL;

$location = isset($argv[1]) ? $argv[1] : 'http://download.thinkbroadband.com/50MB.zip';

$handle = fopen($location, 'r');

if(!$handle) {
     echo 'Error reading file...' . PHP_EOL;
     die(1);
}

$timeStart = time();
$packSize = 0;
while(($buffer = fgets($handle, 4096)) !== false) {
     $packSize += strlen($buffer);
}

$timeEnd = time();
fclose($handle);

$diff = $timeEnd - $timeStart;

if($diff == 0) { 
     $diff = 1; // prevent division by 0
}

$packSize = ($packSize / (1024 * 1024)) * 8;
echo round($packSize / $diff, 2) . 'Mbps' . PHP_EOL;
