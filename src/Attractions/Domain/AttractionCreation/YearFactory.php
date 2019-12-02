<?php


namespace App\Attractions\Domain\AttractionCreation;

use App\Attractions\Domain\Entity\Year;

class YearFactory
{
    /**
     * @param string $name
     * @return Year
     */
    public function createYear(
        int $name
    ):Year
    {
        return new Year(
            $name
        );
    }
}