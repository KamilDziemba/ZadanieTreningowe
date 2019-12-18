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
     * @param int $name
     * @return Year|null
     */
    public function findByName(int $name): ?Year;

    /**
     * @return array|null
     */
    public function findAllDistinct(): ?array;
}
