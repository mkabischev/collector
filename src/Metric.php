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
     * @param string $name
     * @param mixed  $value
     * @param int    $time
     */
    public function __construct($name, $value, $time = null)
    {
        $this->name = $name;
        $this->value = $value;
        $this->time = $time ?: time();
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
}
