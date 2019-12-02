<?php

declare(strict_types = 1);
namespace App\Attractions\Domain\Repository;


use App\Attractions\Domain\Entity\City;
use App\Shared\Domain\Repository\AbstractEntityRepositoryInterface;

interface CityRepositoryInterface extends AbstractEntityRepositoryInterface
{
    /**
     * @param City $city
     */
    public function save(City $city): void;

    /**
     * @param string $name
     * @return City|null
     */
    public function findByName(string $name): ?City;

    /**
     * @return array|null
     */
    public function findAllDistinct(): ?array ;
}