<?php

namespace Kabischev\Collector\Source;

use Kabischev\Collector\Metric;

class Composite implements SourceInterface
{
    /**
     * @var SourceInterface[]
     */
    private $sources;

    /**
     * @param SourceInterface[] $sources
     */
    public function __construct(array $sources)
    {
        $this->sources = $sources;
    }

    /**
     * @return Metric[]
     */
    public function getMetrics()
    {
        $result = [];
        foreach ($this->sources as $source) {
            $result = array_merge($result, $source->getMetrics());
        }

        return $result;
    }
}
