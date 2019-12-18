<?php

declare(strict_types=1);

namespace App\Attractions\Domain\Repository;

use App\Attractions\Domain\Entity\Street;
use App\Shared\Domain\Repository\AbstractEntityRepositoryInterface;
use App\Shared\Exception\ResourceNotFoundException;

interface StreetRepositoryInterface extends AbstractEntityRepositoryInterface
{
    public function save(Street $street): void;

    /**
     * @throws ResourceNotFoundException
     */
    public function findByName(string $name): ?Street;

    public function findAllDistinct(string $city): ?array;
}
