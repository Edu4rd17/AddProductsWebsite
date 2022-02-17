<?php

namespace Ediacob;

class FurnitureRepository
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
        $sql = 'SELECT * FROM furniture';

        $statement = $this->connection->prepare($sql);
        $statement->execute();
        $statement->setFetchMode(\PDO::FETCH_CLASS, 'Ediacob\\Furniture');

        $furnitures = $statement->fetchAll();

        return $furnitures;
    }

    public function getAllIds(): array
    {
        $sql = 'SELECT furnitureId FROM furniture';

        $statement = $this->connection->prepare($sql);
        $statement->execute();
        $statement->setFetchMode(\PDO::FETCH_CLASS, 'Ediacob\\Furniture');

        $furnitureIds = $statement->fetchAll();

        return $furnitureIds;
    }


    public function insertFurniture(Furniture $furniture)
    {
        $isValidSku = false;

        $sku = $furniture->getSku();
        $name = $furniture->getName();
        $price = $furniture->getPrice();
        $height = $furniture->getHeight();
        $width = $furniture->getWidth();
        $length = $furniture->getLength();

        $sqlCompare = "SELECT sku FROM furniture WHERE sku = :sku";

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
            $sql = 'INSERT INTO furniture (sku, name, price, height, width, length) VALUES (:sku, :name, :price, :height, :width, :length)';
            $statement = $this->connection->prepare($sql);

            //Bind parameters to statement variables
            $statement->bindParam(':sku', $sku);
            $statement->bindParam(':name', $name);
            $statement->bindParam(':price', $price);
            $statement->bindParam(':height', $height);
            $statement->bindParam(':width', $width);
            $statement->bindParam(':length', $length);

            $noError = $statement->execute();
        }
    }

    public function deleteF($productsId = [])
    {

        foreach ($productsId as $productId) {
            $sql = 'DELETE FROM furniture WHERE furnitureId = :productId';

            // Prepare SQL

            $statement = $this->connection->prepare($sql);

            // Bind parameters to statement variables
            $statement->bindParam(':productId', $productId);

            // Execute statement
            $noError = $statement->execute();

        }
    }

    public function deleteAll(): int
    {
        $sql = 'DELETE FROM furniture';
        $numRowsAffected = $this->connection->exec($sql);
        return $numRowsAffected;
    }

    public function createTable(): void
    {
        $sql = 'CREATE TABLE IF NOT EXISTS furniture ('
            . 'furnitureId integer(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,'
            . 'sku varchar(50) NOT NULL,'
            . 'name varchar(50) NOT NULL,'
            . 'price float NOT NULL,'
            . 'height int(10) NOT NULL,'
            . 'width int(10) NOT NULL,'
            . 'length int(10) NOT NULL'
            . ')';
        $this->connection->exec($sql);
    }

    public function dropTable(): void
    {
        $sql = 'DROP TABLE furniture';
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