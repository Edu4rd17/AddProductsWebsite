<?php

namespace Ediacob;

class BookRepository
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
        $sql = 'SELECT * FROM book';

        $statement = $this->connection->prepare($sql);
        $statement->execute();
        $statement->setFetchMode(\PDO::FETCH_CLASS, 'Ediacob\\Book');

        $books = $statement->fetchAll();

        return $books;
    }

    public function getAllIds(): array
    {
        $sql = 'SELECT bookId FROM book';

        $statement = $this->connection->prepare($sql);
        $statement->execute();
        $statement->setFetchMode(\PDO::FETCH_CLASS, 'Ediacob\\Book');

        $bookIds = $statement->fetchAll();

        return $bookIds;
    }

    public function insertBook(Book $book)
    {
        $isValidSku = false;

        $sku = $book->getSku();
        $name = $book->getName();
        $price = $book->getPrice();
        $bookWeight = $book->getBookWeight();

        $sqlCompare = "SELECT sku FROM book WHERE sku = :sku";

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
            $sql = 'INSERT INTO book (sku, name, price, bookWeight) VALUES (:sku, :name, :price, :bookWeight)';
            $statement = $this->connection->prepare($sql);

            //Bind parameters to statement variables
            $statement->bindParam(':sku', $sku);
            $statement->bindParam(':name', $name);
            $statement->bindParam(':price', $price);
            $statement->bindParam(':bookWeight', $bookWeight);

            $noError = $statement->execute();
        }
    }

    public function deleteB($productsId = [])
    {
        if ($productsId != null) {
            foreach ($productsId as $productId) {
                $sql = 'DELETE FROM book WHERE bookId = :productId';

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
        $sql = 'DELETE FROM book';
        $numRowsAffected = $this->connection->exec($sql);
        return $numRowsAffected;
    }

    public function createTable(): void
    {
        $sql = 'CREATE TABLE IF NOT EXISTS book ('
            . 'bookId integer(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,'
            . 'sku varchar(50) NOT NULL,'
            . 'name varchar(50) NOT NULL,'
            . 'price float NOT NULL,'
            . 'bookWeight int(10) NOT NULL'
            . ')';
        $this->connection->exec($sql);
    }

    public function dropTable(): void
    {
        $sql = 'DROP TABLE book';
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