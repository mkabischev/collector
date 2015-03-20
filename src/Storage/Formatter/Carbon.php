<?php

namespace Kabischev\Collector\Storage\Formatter;

use Kabischev\Collector\Metric;

class Carbon implements FormatterInterface
{
    /**
     * @param Metric $metric
     *
     * @return string
     */
    public function format(Metric $metric)
    {
        return sprintf("%s %s %s\n", $metric->getName(), $metric->getValue(), $metric->getTime());
    }
}
