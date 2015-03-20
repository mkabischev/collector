<?php

namespace Kabischev\Collector\Storage;

use Kabischev\Collector\Metric;

interface StorageInterface
{
    /**ven
     * @param Metric[] $metrics
     */
    public function store(array $metrics);
}
