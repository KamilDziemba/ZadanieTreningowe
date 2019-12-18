<?php

declare(strict_types=1);

namespace App\Attractions\Infrastructure\Repository;

use App\Attractions\Domain\Entity\Street;
use App\Attractions\Domain\Repository\StreetRepositoryInterface;
use App\Shared\Infrastructure\Repository\AbstractEntityRepository;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;

class StreetRepository extends AbstractEntityRepository implements StreetRepositoryInterface
{
    /**
     * @var ObjectRepository
     */
    private $entityRepository;

    /**
     * StreetRepository constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager);

        $this->entityRepository = $entityManager->getRepository(Street::class);
    }

    /**
     * @param string $name
     * @return Street|null
     */
    public function findByName(string $name): ?Street
    {
        return $this->entityRepository->findOneBy(['name' => $name]);
    }

    /**
     * @param string|null $city
     * @return array|null
     */
    public function findAllDistinct(string $city = null): ?array
    {
        $qb = $this->entityManager
            ->createQueryBuilder()
            ->select('st.name, city.name as cityName')
            ->from('App\Attractions\Domain\Entity\Street', 'st')
            ->leftJoin('st.city', 'city')
            ->distinct('st.name')
            ->orderBy('st.name');

        if (!empty($city)) {
            $qb->andWhere('city.name = :city')
                ->setParameter('city', $city);
        }

        return $qb->getQuery()->getResult();
    }

    public function save(Street $street): void
    {
        // TODO: Implement save() method.
    }
}
