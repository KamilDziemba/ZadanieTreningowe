<?php

declare(strict_types=1);

namespace App\Attractions\Domain\Repository;

use App\Attractions\Domain\Entity\Year;
use App\Shared\Domain\Repository\AbstractEntityRepositoryInterface;
use App\Shared\Exception\ResourceNotFoundException;

interface YearRepositoryInterface extends AbstractEntityRepositoryInterface
{
    public function save(Year $year): void;

    /**
     * @throws ResourceNotFoundException
     */
    public function findByName(string $name): ?Year;

    public function findAllDistinct(): ?array;
}
