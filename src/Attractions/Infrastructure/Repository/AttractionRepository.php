<?php

declare(strict_types=1);

namespace App\Attractions\Infrastructure\Repository;

use App\Attractions\Domain\Entity\Attractions;
use App\Attractions\Domain\Repository\AttractionRepositoryInterface;
use App\Shared\Infrastructure\Repository\AbstractEntityRepository;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;

class AttractionRepository extends AbstractEntityRepository implements AttractionRepositoryInterface
{
    /**
     * @var ObjectRepository
     */
    private $entityRepository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager);

        $this->entityRepository = $entityManager->getRepository(Attractions::class);
    }

    /**
     * @param string $name
     * @return Attractions|null
     */
    public function findByName(string $name): ?Attractions
    {
        return $this->entityRepository->findOneBy(['name' => $name]);
    }

    /**
     * @param string|null $city
     * @param string|null $street
     * @param int|null $year
     * @return Attractions[]
     */
    public function findAllWithFilters(?string $city, ?string $street, ?int $year): array
    {
         $qb = $this->entityManager->createQueryBuilder()
             ->select('at')
             ->from('App\Attractions\Domain\Entity\Attractions', 'at');

         if (!empty($city)){
             $qb->leftJoin('at.city', 'city')
                 ->andWhere('city.name = :city')
                 ->setParameter('city', $city);
         }

        if (!empty($year)){
            $qb->leftJoin('at.year', 'year')
                ->andWhere('year.name = :year')
                ->setParameter('year', $year);
        }

        if (!empty($street)){
            $qb->leftJoin('at.street', 'street')
                ->andWhere('street.name = :street')
                ->setParameter('street', $street);
        }

        return $qb->getQuery()->getResult();
    }

    /**
     * @param Attractions $attraction
     * @return Attractions[]|null
     */
    public function findIfAttractionExist(Attractions $attraction): ?array
    {
        $qb = $this->entityManager->createQueryBuilder()
            ->select('at')
            ->from('App\Attractions\Domain\Entity\Attractions', 'at')
            ->leftJoin('at.city', 'city')
            ->leftJoin('at.year', 'year')
            ->leftJoin('at.street', 'street')
            ->where('at.name = :name')
            ->andWhere('city.name = :city')
            ->andWhere('year.name = :year')
            ->andWhere('street.name = :street')
            ->setParameter('name', $attraction->getName())
            ->setParameter('city', $attraction->getCity()->getName())
            ->setParameter('year', $attraction->getYear()->getName())
            ->setParameter('street', $attraction->getStreet()->getName());


        return $qb->getQuery()->getResult();
    }

    /**
     * @return Attractions[]|null
     */
    public function findAll(): ?array
    {
        return $this->entityRepository->findAll();
    }

    /**
     * @param Attractions $attractions
     */
    public function save(Attractions $attractions): void
    {
        // TODO: Implement save() method.
    }
}