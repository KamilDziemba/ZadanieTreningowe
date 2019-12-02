<?php


namespace App\Attractions\Domain\AttractionCreation;


use App\Attractions\Domain\Entity\City;
use App\Attractions\Domain\Entity\Street;

class StreetFactory
{
    /**
     * @param string $name
     * @param City $city
     * @return Street
     */
    public function createStreet(
        string $name,
        City $city
    ):Street
    {
        return new Street(
            $name,
            $city
        );
    }
}