<?php

namespace spec\Kabischev\Collector\Storage;

use Kabischev\Collector\Metric;
use Kabischev\Collector\Source\SourceInterface;
use Kabischev\Collector\Storage\Stream\Formatter\FormatterInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Streamer\Stream;

class StreamSpec extends ObjectBehavior
{
    public function let(Stream $stream, FormatterInterface $formatter)
    {
        $this->beConstructedWith($stream, $formatter);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Kabischev\Collector\Storage\Stream');
    }

    public function it_stores_metrics(
        Stream $stream,
        FormatterInterface $formatter,
        SourceInterface $source,
        Metric $metric1,
        Metric $metric2
    ) {
        $source
            ->getMetrics()
            ->willReturn([$metric1, $metric2])
            ->shouldBeCalled();

        $formatter
            ->format($metric1)
            ->willReturn('metric_1_formatted')
            ->shouldBeCalled();

        $formatter
            ->format($metric2)
            ->willReturn('metric_2_formatted')
            ->shouldBeCalled();

        $stream
            ->write('metric_1_formatted')
            ->shouldBeCalled();

        $stream
            ->write('metric_2_formatted')
            ->shouldBeCalled();

        $this->store($source);
    }
}
