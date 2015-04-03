<?php

namespace spec\Kabischev\Collector;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MetricSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->beConstructedWith('key', 'value', ['time' => 123, 'foo' => 'bar']);
        $this->shouldHaveType('Kabischev\Collector\Metric');
        $this->getName()->shouldReturn('key');
        $this->getValue()->shouldReturn('value');
        $this->getTime()->shouldReturn(123);
        $this->getMeta()->shouldReturn(['foo' => 'bar']);
    }
}

