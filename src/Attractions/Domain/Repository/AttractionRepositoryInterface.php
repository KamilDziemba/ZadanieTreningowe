<?php

declare(strict_types=1);

namespace App\Attractions\Domain\Repository;

use App\Attractions\Domain\Entity\Attractions;
use App\Shared\Domain\Repository\AbstractEntityRepositoryInterface;
use App\Shared\Exception\ResourceNotFoundException;

interface AttractionRepositoryInterface extends AbstractEntityRepositoryInterface
{
    public function save(Attractions $attractions): void;

    /**
     * @param string $name
     * @return Attractions|null
     * @throws ResourceNotFoundException
     */
    public function findByName(string $name): ?Attractions;

    /**
     * @param string $city
     * @param string $street
     * @param int $year
     * @return array
     */
    public function findAllWithFilters(string $city, string $street, int $year): array;

    /**
     * @return Attractions[]|null
     */
    public function findAll(): ?array;
}
