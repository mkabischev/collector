<?php

namespace spec\Kabischev\Collector\Source;

use Kabischev\Collector\Metric;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DatabaseSpec extends ObjectBehavior
{
    public function it_is_initializable(\PDO $pdo)
    {
        $this->beConstructedWith($pdo, 'SELECT 1', function () {
        });
        $this->shouldHaveType('Kabischev\Collector\Source\Database');
    }

    public function it_returns_metrics(\PDO $pdo, \PDOStatement $statement)
    {
        $this->beConstructedWith($pdo, 'SELECT * FROM `table`', function (array $row) {
            return new Metric($row['key'], $row['value'], ['time' => $row['time']]);
        });

        $pdo
            ->prepare('SELECT * FROM `table`')
            ->willReturn($statement);

        $statement
            ->fetchAll(\PDO::FETCH_ASSOC)
            ->willReturn(
                [
                    [
                        'key' => 'foo.bar',
                        'value' => 123,
                        'time' => 100500
                    ],
                    [
                        'key' => 'foo.xyz',
                        'value' => 321,
                        'time' => 100500
                    ]
                ]
            )
            ->shouldBeCalled();


        /** @var Metric[] $metrics */
        $metrics = $this->getMetrics();
        $metrics->shouldHaveCount(2);

        $metrics[0]->getName()->shouldReturn('foo.bar');
        $metrics[0]->getValue()->shouldReturn(123);
        $metrics[0]->getTime()->shouldReturn(100500);

        $metrics[1]->getName()->shouldReturn('foo.xyz');
        $metrics[1]->getValue()->shouldReturn(321);
        $metrics[1]->getTime()->shouldReturn(100500);
    }
}
