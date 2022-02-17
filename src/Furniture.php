<?php

namespace Ediacob;

class Furniture extends Product
{
    public int $furnitureId;
    public int $height;
    public int $width;
    public int $length;

    /**
     * @return int
     */
    public function getFurnitureId(): int
    {
        return $this->furnitureId;
    }

    /**
     * @param int $furnitureId
     */
    public function setFurnitureId(int $furnitureId): void
    {
        $this->furnitureId = $furnitureId;
    }


    /**
     * @return int
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * @param int $height
     */
    public function setHeight(int $height): void
    {
        $this->height = $height;
    }

    /**
     * @return int
     */
    public function getWidth(): int
    {
        return $this->width;
    }

    /**
     * @param int $width
     */
    public function setWidth(int $width): void
    {
        $this->width = $width;
    }

    /**
     * @return int
     */
    public function getLength(): int
    {
        return $this->length;
    }

    /**
     * @param int $length
     */
    public function setLength(int $length): void
    {
        $this->length = $length;
    }


}