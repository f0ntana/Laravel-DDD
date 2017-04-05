<?php

namespace Domain\Repository;

use Illuminate\Database\Connection;

abstract class Repository
{
    /**
     * @var Connection
     */
    private $connection;

    /**
     * Countries constructor.
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @return Connection
     */
    protected function db()
    {
        return $this->connection;
    }
}