<?php

namespace Kabischev\Collector;

class Metric
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var mixed
     */
    private $value;

    /**
     * @var int
     */
    private $time;

    /**
     * @var array
     */
    private $meta;

    /**
     * @param string $name
     * @param mixed  $value
     * @param array  $meta
     */
    public function __construct($name, $value, array $meta = [])
    {
        $this->name = $name;
        $this->value = $value;
        $this->time = time();

        if (isset($meta['time'])) {
            $this->time = $meta['time'];
            unset($meta['time']);
        }

        $this->meta = $meta;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return array
     */
    public function getMeta()
    {
        return $this->meta;
    }
}
