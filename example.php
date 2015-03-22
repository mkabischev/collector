<?php

require_once 'vendor/autoload.php';

use Kabischev\Collector\Storage\Stream as StreamStorage;
use Kabischev\Collector\Storage\Stream\Formatter\Carbon as CarbonFormatter;

$source = new \Kabischev\Collector\Source\ArraySource([
   [
       'name' => 'foo.bar',
       'value' => 100
   ]
]);
$storage = new StreamStorage(\Streamer\FileStream::create('output.log', 'w+'), new CarbonFormatter());
$storage->store($source);
