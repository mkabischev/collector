<?php

namespace spec\Kabischev\Collector\Source;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ArraySourceSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->beConstructedWith([]);
        $this->shouldHaveType('Kabischev\Collector\Source\ArraySource');
    }

    public function it_returns_metrics()
    {
        $this->beConstructedWith([
            [
                'name' => 'foo.metric_1',
                'value' => 100,
                'meta' => ['time' => 100],
            ],
            [
                'name' => 'foo.metric_2',
                'value' => 200,
                'meta' => ['time' => 200],
            ],
            [
                'name' => 'foo.metric_3',
                'value' => 300,
                'meta' => ['time' => 300]
            ],
        ]);

        $metrics = $this->getMetrics();
        $metrics->shouldHaveCount(3);

        $metrics[0]->getName()->shouldReturn('foo.metric_1');
        $metrics[0]->getValue()->shouldReturn(100);

        $metrics[1]->getName()->shouldReturn('foo.metric_2');
        $metrics[1]->getValue()->shouldReturn(200);

        $metrics[2]->getName()->shouldReturn('foo.metric_3');
        $metrics[2]->getValue()->shouldReturn(300);
    }
}
