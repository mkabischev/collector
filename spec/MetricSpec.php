<?php

namespace spec\Kabischev\Collector;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MetricSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith('key', 'value', 123);
        $this->shouldHaveType('Kabischev\Collector\Metric');
        $this->getName()->shouldReturn('key');
        $this->getValue()->shouldReturn('value');
        $this->getTime()->shouldReturn(123);
    }
}

