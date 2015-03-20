<?php

namespace Kabischev\Collector\Source;

use Kabischev\Collector\Metric;

class Mysql implements SourceInterface
{
    /**
     * @var \PDO
     */
    protected $connection;

    /**
     * @var string
     */
    protected $query;

    /**
     * @var \Closure
     */
    protected $callback;

    /**
     * @param \PDO     $connection
     * @param string   $query
     * @param \Closure $callback
     */
    public function __construct(\PDO $connection, $query, \Closure $callback)
    {
        $this->connection = $connection;
        $this->query = $query;
        $this->callback = $callback;
    }

    /**
     * @return Metric[]
     */
    public function getMetrics()
    {
        // TODO: Implement getMetrics() method.
    }

}
