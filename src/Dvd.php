<?php

namespace Ediacob;

class Dvd extends Product
{
    public int $dvdId;
    public int $dvdSize;

    /**
     * @return int
     */
    public function getDvdId(): int
    {
        return $this->dvdId;
    }

    /**
     * @param int $dvdId
     */
    public function setDvdId(int $dvdId): void
    {
        $this->dvdId = $dvdId;
    }


    /**
     * @return int
     */
    public function getDvdSize(): int
    {
        return $this->dvdSize;
    }

    /**
     * @param int $dvdSize
     */
    public function setDvdSize(int $dvdSize): void
    {
        $this->dvdSize = $dvdSize;
    }


}