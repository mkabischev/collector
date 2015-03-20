<?php

namespace Kabischev\Collector\Storage;

use Kabischev\Collector\Metric;
use Kabischev\Collector\Storage\Formatter\FormatterInterface;
use Streamer\Stream;

class StreamStorage implements StorageInterface
{
    /**
     * @var Stream
     */
    private $stream;

    /**
     * @var FormatterInterface
     */
    private $formatter;

    /**
     * @param Stream             $stream
     * @param FormatterInterface $formatter
     */
    public function __construct(Stream $stream, FormatterInterface $formatter)
    {
        $this->stream = $stream;
        $this->formatter = $formatter;
    }

    /**
     * @param Metric[] $metrics
     */
    public function store(array $metrics)
    {
        foreach ($metrics as $metric) {
            $this->stream->write($this->formatter->format($metric));
        }
    }
}
