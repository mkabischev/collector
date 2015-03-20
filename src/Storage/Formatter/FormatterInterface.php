<?php

namespace Kabischev\Collector\Storage\Formatter;

use Kabischev\Collector\Metric;

interface FormatterInterface
{
    /**
     * @param Metric $metric
     *
     * @return string
     */
    public function format(Metric $metric);
}
