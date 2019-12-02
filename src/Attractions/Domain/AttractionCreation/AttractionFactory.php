<?php

declare(strict_types = 1);
namespace App\Attractions\Domain\AttractionCreation;


use App\Attractions\Domain\Entity\Attractions;
use App\Attractions\Domain\Entity\City;
use App\Attractions\Domain\Entity\Street;
use App\Attractions\Domain\Entity\Year;

class AttractionFactory
{
    /**
     * @param string $name
     * @param City $city
     * @param Street $street
     * @param Year $year
     * @return Attractions
     */
    public function createAttraction(
        string $name,
        City $city,
        Street $street,
        Year $year
    ): Attractions
    {
        return new Attractions(
            $name,
            $year,
            $city,
            $street
        );
    }
}