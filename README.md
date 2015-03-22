# collector
[![Build Status](https://travis-ci.org/mkabischev/collector.svg?branch=master)](https://travis-ci.org/mkabischev/collector)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/mkabischev/collector/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/mkabischev/collector/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/mkabischev/collector/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/mkabischev/collector/?branch=master)

## Installation

Install it with [Composer](https://getcomposer.org/):
```json
{
    "require": {
        "mkabischev/collector": "dev-master"
    }
}
```

### Sources
 - [x] _Database_
 - [ ] _Pinba_ 
 - [ ] _AWS CloudWatch_
 - [ ] _RabbitMQ_
 
### Storages
 - [x] _File_
 - [x] _Carbon (Graphite)_
 - [ ] _InfluxDB_
 
## Usage
```php
use Kabischev\Collector\Source\Database;
use Kabischev\Collector\Storage\Stream as StreamStorage;
use Kabischev\Collector\Storage\Stream\Formatter\Carbon as CarbonFormatter;
use Kabischev\Collector\Collector;
use Streamer\NetworkStream;

$source = new Database($pdo, 'SELECT `key`, `value` FROM `table`', function(array $row) {
    return new Metric($row['key'], $row['value']);
});

$storage = new StreamStorage(NetworkStream::create('tcp://graphite.host:2003'), new CarbonFormatter());

$collector = new Collector([$source], $storage);
$collector->run();
```
