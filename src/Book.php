<?php

namespace Ediacob;

class Book extends Product
{
    public int $bookId;
    public int $bookWeight;

    /**
     * @return int
     */
    public function getBookId(): int
    {
        return $this->bookId;
    }

    /**
     * @param int $bookId
     */
    public function setBookId(int $bookId): void
    {
        $this->bookId = $bookId;
    }


    /**
     * @return int
     */
    public function getBookWeight(): int
    {
        return $this->bookWeight;
    }

    /**
     * @param int $bookWeight
     */
    public function setBookWeight(int $bookWeight): void
    {
        $this->bookWeight = $bookWeight;
    }


}