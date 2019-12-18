<?php

declare(strict_types=1);

namespace App\Attractions\Infrastructure\Repository;

use App\Attractions\Domain\Entity\Year;
use App\Attractions\Domain\Repository\YearRepositoryInterface;
use App\Shared\Infrastructure\Repository\AbstractEntityRepository;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;

class YearRepository extends AbstractEntityRepository implements YearRepositoryInterface
{
    /**
     * @var ObjectRepository
     */
    private $entityRepository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager);

        $this->entityRepository = $entityManager->getRepository(Year::class);
    }

    /**
     * @param int $name
     * @return Year|null
     */
    public function findByName(int $name): ?Year
    {
        return $this->entityRepository->findOneBy(['name' => $name]);
    }

    /**
     * @return Year[]|null
     */
    public function findAllDistinct(): ?array
    {
        $qb = $this->entityManager
            ->createQueryBuilder()
            ->select('year.name')
            ->from('App\Attractions\Domain\Entity\Year', 'year')
            ->distinct()
            ->orderBy('year.name');

        return $qb->getQuery()->getResult();
    }

    public function save(Year $year): void
    {
        // TODO: Implement save() method.
    }
}
