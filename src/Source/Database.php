<?php

namespace Kabischev\Collector\Source;

use Kabischev\Collector\Metric;

class Database implements SourceInterface
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
        $metrics = [];
        $callback = $this->callback;
        $statement = $this->connection->prepare($this->query);
        foreach ($statement->fetchAll(\PDO::FETCH_ASSOC) as $row) {
            $metrics[] = $callback($row);
        }

        return $metrics;
    }
}
