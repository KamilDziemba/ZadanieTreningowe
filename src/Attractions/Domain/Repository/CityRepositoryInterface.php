<?php

declare(strict_types=1);

namespace App\Attractions\Domain\Repository;

use App\Attractions\Domain\Entity\City;
use App\Shared\Domain\Repository\AbstractEntityRepositoryInterface;

interface CityRepositoryInterface extends AbstractEntityRepositoryInterface
{
    public function save(City $city): void;

    public function findByName(string $name): ?City;

    public function findAllDistinct(): ?array;
}
