<?php

namespace Kabischev\Collector\Storage;

use crodas\InfluxPHP\DB;
use Kabischev\Collector\Metric;
use Kabischev\Collector\Source\SourceInterface;

class InfluxDB implements StorageInterface
{
    const CHUNK_SIZE = 100;

    /**
     * @var DB
     */
    private $db;

    /**
     * @var int
     */
    private $chunkSize;

    /**
     * @param DB  $db
     * @param int $chunkSize
     */
    public function __construct(DB $db, $chunkSize = self::CHUNK_SIZE)
    {
        $this->$db = $db;
        $this->chunkSize = $chunkSize;
    }

    /**
     * @param SourceInterface $source
     */
    public function store(SourceInterface $source)
    {
        $chunk = [];
        foreach ($source->getMetrics() as $metric) {
            $chunk[] = $metric;
            if (count($chunk) === $this->chunkSize) {

            }
        }
    }

    /**
     * @param Metric[] $metrics
     */
    protected function storeChunk(array $metrics)
    {

        $metricsByKeys = [];
        foreach ($metrics as $metric) {
            if (!isset($metricsByKeys[$metric->getName()])) {
                $metricsByKeys[$metric->getName()] = [];
            }
            $metricsByKeys[$metric->getName()][] = $this->serialize($metric);
        }

        foreach($metricsByKeys as $name => $data) {
            $this->db->insert($name, $data);
        }
    }

    /**
     * @param Metric $metric
     *
     * @return array
     */
    protected function serialize(Metric $metric)
    {
        $result = [];
        if ($meta = $metric->getMeta()) {
            $result['tags'] = $meta;
        }

        $result['fields'] = ['value' => $metric->getValue()];
        $result['timestamp'] = date(DATE_RFC3339, $metric->getTime());

        return $result;
    }
}
