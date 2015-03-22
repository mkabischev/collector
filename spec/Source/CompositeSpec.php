<?php

namespace spec\Kabischev\Collector\Source;

use Kabischev\Collector\Metric;
use Kabischev\Collector\Source\SourceInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CompositeSpec extends ObjectBehavior
{
    public function let(SourceInterface $source1, SourceInterface $source2)
    {
        $this->beConstructedWith([$source1, $source2]);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Kabischev\Collector\Source\Composite');
    }

    public function it_returns_metrics(
        SourceInterface $source1,
        SourceInterface $source2,
        Metric $metric1,
        Metric $metric2,
        Metric $metric3,
        Metric $metric4
    ) {
        $source1
            ->getMetrics()
            ->willReturn([$metric1])
            ->shouldBeCalled();

        $source2
            ->getMetrics()
            ->willReturn([$metric2, $metric3, $metric4])
            ->shouldBeCalled();

        $result = $this->getMetrics();
        $result->shouldHaveCount(4);
        $result[0]->shouldBe($metric1);
        $result[1]->shouldBe($metric2);
        $result[2]->shouldBe($metric3);
        $result[3]->shouldBe($metric4);
    }
}
