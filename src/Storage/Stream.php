<?php

namespace Kabischev\Collector\Storage;

use Kabischev\Collector\Metric;
use Kabischev\Collector\Source\SourceInterface;
use Kabischev\Collector\Storage\Stream\Formatter\FormatterInterface;
use Streamer\Stream as StreamerStream;

class Stream implements StorageInterface
{
    /**
     * @var StreamerStream
     */
    private $stream;

    /**
     * @var FormatterInterface
     */
    private $formatter;

    /**
     * @param StreamerStream     $stream
     * @param FormatterInterface $formatter
     */
    public function __construct(StreamerStream $stream, FormatterInterface $formatter)
    {
        $this->stream = $stream;
        $this->formatter = $formatter;
    }

    /**
     * @param SourceInterface $source
     */
    public function store(SourceInterface $source)
    {
        foreach ($source->getMetrics() as $metric) {
            $this->stream->write($this->formatter->format($metric));
        }
    }
}
