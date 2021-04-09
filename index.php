<?php
set_time_limit(0);

require('./vendor/autoload.php');

use App\Parser\M3U8;
use App\Fetch;
use App\Merge;

$fileName = "fileName.m3u8";
$outputFileName = "output.ts";

$m3u8 = new M3U8($name);
$fetch = new Fetch($m3u8);
$fetch->download();

$merge = new Merge($fetch, $outputName);
$merge->merge();
