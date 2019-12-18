<?php

declare(strict_types=1);

namespace App\Attractions\Domain\AttractionCreation;

use App\Attractions\Domain\Entity\City;

class CityFactory
{
    /**
     * @param string $name
     * @return City
     */
    public function createCity(
        string $name
    ): City
    {
        return new City(
            $name
        );
    }
}