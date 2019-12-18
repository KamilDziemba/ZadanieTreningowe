<?php

declare(strict_types=1);

namespace App\Attractions\Infrastructure\Repository;

use App\Attractions\Domain\Entity\City;
use App\Attractions\Domain\Repository\CityRepositoryInterface;
use App\Shared\Infrastructure\Repository\AbstractEntityRepository;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;

class CityRepository extends AbstractEntityRepository implements CityRepositoryInterface
{
    /**
     * @var ObjectRepository
     */
    private $entityRepository;

    /**
     * CityRepository constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager);

        $this->entityRepository = $entityManager->getRepository(City::class);
    }

    /**
     * @param string $name
     * @return City|null
     */
    public function findByName(string $name): ?City
    {
        return $this->entityRepository->findOneBy(['name' => $name]);
    }

    /**
     * @return City[]|null
     */
    public function findAllDistinct(): ?array
    {
        $qb = $this->entityManager
            ->createQueryBuilder()
            ->select('city.name')
            ->from('App\Attractions\Domain\Entity\City', 'city')
            ->distinct()
            ->orderBy('city.name');

        return $qb->getQuery()->getResult();
    }

    public function save(City $city): void
    {
        // TODO: Implement save() method.
    }
}
