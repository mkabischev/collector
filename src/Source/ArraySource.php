<?php

namespace Kabischev\Collector\Source;

use Kabischev\Collector\Metric;

class ArraySource implements SourceInterface
{
    /**
     * @var array
     */
    private $data;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return Metric[]
     */
    public function getMetrics()
    {
        return array_map(function(array $item) {
            return new Metric($item['name'], $item['value']);
        }, $this->data);
    }
}
