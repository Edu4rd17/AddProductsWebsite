<?php

namespace Ediacob;

class Database
{
    const MYSQL_HOST = 'localhost';
    const MYSQL_PORT = '3306';
    const MYSQL_USER = 'root';
    const MYSQL_PASSWORD = 'Database2001';
    const MYSQL_DATABASE = 'scandiweb2';

    const DATA_SOURCE_NAME = 'mysql:dbname=' . self::MYSQL_DATABASE . ';host=' . self::MYSQL_HOST . ':' . self::MYSQL_PORT;

    private ?\PDO $connection = null;

    public function getConnection(): ?\PDO
    {
        return $this->connection;
    }

    public function __construct()
    {
        try {
            $this->connection = new \PDO(
                self::DATA_SOURCE_NAME,
                self::MYSQL_USER,
                self::MYSQL_PASSWORD
            );
        } catch (\Exception $e) {
            print $this->exceptionMessage($e);
        }
    }

    private function exceptionMessage(\Exception $e): string
    {
        $separator = "\n<pre>\n";
        $message = "--- DB error ---";
        switch ($e->getCode()) {
            case 1045:
                $message .= 'Access DENIED to db user (code 1045), check DB username/password!';
                break;

            case 2002:
                $message .= 'Connection refused (code 2002), check DB host and port!!';
                break;

            case 1049:
                $message .= 'Unknown database (code 1049), database schema name in constant MYSQL_DATABASE = "' . self::MYSQL_DATABASE . '"';
                $message .= $separator . 'Suggested solution: create schema with SQL: "CREATE DATABASE ' . self::MYSQL_DATABASE . '"';
                break;

            default:
                // just return message in the Exception ...
                $message .= $e->getMessage();
        }

        $separator = "\n<pre>\n";
        return $message . $separator;
    }
}