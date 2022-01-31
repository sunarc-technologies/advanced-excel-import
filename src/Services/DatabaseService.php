<?php

namespace Sunarc\ImportExcel\Services;

use Doctrine\DBAL\Platforms\MySQLPlatform;
use Illuminate\Support\Facades\DB;

class DatabaseService
{
    private $connection;

    public function __construct()
    {
        $this->connection = DB::connection(config('database.default'));
    }

    private function driver()
    {
        return $this->connection->getDriverName();
    }

    /**
     * Return the name of current database used in SQL connection.
     *
     * @return string
     */

    private function database(): string
    {
        return $this->connection->getDatabaseName();
    }

    /**
     * This function will return all the table list from the current database connection
     *
     * @return array
     */

    public function tables(): array
    {
        return $this->connection->getDoctrineSchemaManager()->listTableNames();
    }

    /**
     * This function will return the schema of specific table.
     * 
     * @param string $table
     * @param string|null $database
     * @return array
     */

    public function tableSchema(string $table, string $database = null): array
    {
        if (!$database) {
            $database = $this->database();
        }

        return $this->connection->select((new MySQLPlatform())->getListTableColumnsSQL($table, $database));
    }
}
