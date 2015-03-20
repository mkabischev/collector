<?php

namespace Kabischev\Collector\Source;

use Kabischev\Collector\Metric;

interface SourceInterface
{
    /**
     * @return Metric[]
     */
    public function getMetrics();
}
