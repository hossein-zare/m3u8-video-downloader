<?php
set_time_limit(0);

require('./vendor/autoload.php');

use App\Parser\M3U8;
use App\Fetch;
use App\Merge;

Fetch::$TEMP_DIRECTORY = "tmp";
Merge::$DESTINATION_DIRECTORY = "destination";

$fileName = "fileName.m3u8";
$outputFileName = "output.ts";

try {
    $m3u8 = new M3U8($fileName);

    $fetch = new Fetch($m3u8);
    $fetch->download();

    $merge = new Merge($fetch, $outputFileName);
    $merge->merge();
} catch (\Exception $e) {
    die($e->getMessage());
}

// Done
echo $merge->getDestinationFilePath();
