<?php

declare(strict_types=1);

namespace App\Attractions\UI\Repository;

use App\Attractions\Domain\Entity\Attractions as AttractionEntity;
use App\Attractions\Domain\Repository\AttractionRepositoryInterface;
use App\Attractions\UI\Model\Response\Attraction;

class AttractionRepository
{
    /**
     * @var AttractionRepositoryInterface
     */
    private $attractionRepository;

    /**
     * AttractionRepository constructor.
     * @param AttractionRepositoryInterface $attractionRepository
     */
    public function __construct(AttractionRepositoryInterface $attractionRepository)
    {
        $this->attractionRepository = $attractionRepository;
    }

    /**
     * @param string|null $city
     * @param string|null $street
     * @param int|null $year
     * @return array
     */
    public function getAttractionsWithFilters(?string $city, ?string $street, ?int $year): array
    {
        $attractions = $this->attractionRepository->findAllWithFilters($city, $street, $year);

        return \array_map(static function (AttractionEntity $entity) {
            return new Attraction(
                $entity->getName(),
                $entity->getCity()->getName(),
                $entity->getStreet()->getName(),
                $entity->getYear()->getName()
            );
        }, $attractions);
    }
}