<?php

namespace spec\Kabischev\Collector\Storage;

use Kabischev\Collector\Metric;
use Kabischev\Collector\Storage\Formatter\FormatterInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Streamer\Stream;

class StreamStorageSpec extends ObjectBehavior
{
    public function let(Stream $stream, FormatterInterface $formatter)
    {
        $this->beConstructedWith($stream, $formatter);
    }

    public function it_is_initializable(Stream $stream)
    {
        $this->shouldHaveType('Kabischev\Collector\Storage\StreamStorage');
    }

    public function it_stores_metrics(Stream $stream, FormatterInterface $formatter, Metric $metric1, Metric $metric2)
    {
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

        $this->store([$metric1, $metric2]);
    }
}
