<?php

namespace spec\Kabischev\Collector\Storage\Stream\Formatter;

use Kabischev\Collector\Metric;
use PhpSpec\ObjectBehavior;
use Streamer\Stream;

class CarbonSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Kabischev\Collector\Storage\Stream\Formatter\Carbon');
    }

    public function it_formats_metric(Metric $metric)
    {
        $metric
            ->getName()
            ->willReturn('foo.bar')
            ->shouldBeCalled();

        $metric
            ->getValue()
            ->willReturn(100500)
            ->shouldBeCalled();

        $metric
            ->getTime()
            ->willReturn(1426422536)
            ->shouldBeCalled();

        $this
            ->format($metric)
            ->shouldReturn("foo.bar 100500 1426422536\n");
    }
}
