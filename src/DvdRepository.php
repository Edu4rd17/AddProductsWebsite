<?php

namespace Ediacob;

class DvdRepository
{
    private ?\PDO $connection;

    public function __construct()
    {
        $db = new Database();
        $this->connection = $db->getConnection();

        if (null == $this->connection) {
            die('There was an error connection to the database!!');
        }
    }

    public function findAll(): array
    {
        $sql = 'SELECT * FROM dvd';

        $statement = $this->connection->prepare($sql);
        $statement->execute();
        $statement->setFetchMode(\PDO::FETCH_CLASS, 'Ediacob\\Dvd');

        $dvds = $statement->fetchAll();

        return $dvds;
    }

    public function getAllIds(): array
    {
        $sql = 'SELECT dvdId FROM dvd';

        $statement = $this->connection->prepare($sql);
        $statement->execute();
        $statement->setFetchMode(\PDO::FETCH_CLASS, 'Ediacob\\Dvd');

        $dvdIds = $statement->fetchAll();

        return $dvdIds;
    }

    public function insertDvd(Dvd $dvd)
    {
        $isValidSku = false;

        $sku = $dvd->getSku();
        $name = $dvd->getName();
        $price = $dvd->getPrice();
        $dvdSize = $dvd->getDvdSize();

        $sqlCompare = "SELECT sku FROM dvd WHERE sku = :sku";

        $skuCheck = filter_input(INPUT_POST, 'sku');
        $statementCompare = $this->connection->prepare($sqlCompare);
        $statementCompare->bindParam(':sku', $skuCheck, \PDO::PARAM_STR);
        $statementCompare->execute();

        $result = $statementCompare->fetchAll(\PDO::FETCH_ASSOC);

        if (count($result) == 0) {
            $isValidSku = true;
        }

        // Prepare INSERT statement
        // no ID since that is AUTO-INCREMENTED by DB
        if ($isValidSku == true) {
            $sql = 'INSERT INTO dvd (sku, name, price, dvdSize) VALUES (:sku, :name, :price, :dvdSize)';
            $statement = $this->connection->prepare($sql);

            //Bind parameters to statement variables
            $statement->bindParam(':sku', $sku);
            $statement->bindParam(':name', $name);
            $statement->bindParam(':price', $price);
            $statement->bindParam(':dvdSize', $dvdSize);

            $noError = $statement->execute();
        }
    }

    public function deleteD($productsId = [])
    {
        if ($productsId != null) {
            foreach ($productsId as $productId) {
                $sql = 'DELETE FROM dvd WHERE dvdId = :productId';

                // Prepare SQL

                $statement = $this->connection->prepare($sql);

                // Bind parameters to statement variables
                $statement->bindParam(':productId', $productId);

                // Execute statement
                $noError = $statement->execute();
            }
        }
    }

    public function deleteAll(): int
    {
        $sql = 'DELETE FROM dvd';
        $numRowsAffected = $this->connection->exec($sql);
        return $numRowsAffected;
    }

    public function createTable(): void
    {
        $sql = 'CREATE TABLE IF NOT EXISTS dvd ('
            . 'dvdId integer(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,'
            . 'sku varchar(50) NOT NULL,'
            . 'name varchar(50) NOT NULL,'
            . 'price float NOT NULL,'
            . 'dvdSize int(10) NOT NULL'
            . ')';
        $this->connection->exec($sql);
    }

    public function dropTable(): void
    {
        $sql = 'DROP TABLE dvd';
        $this->connection->exec($sql);
    }

    public function resetTable()
    {
        $this->createTable();
        $this->dropTable();
        $this->createTable();
        $this->deleteAll();
    }
}