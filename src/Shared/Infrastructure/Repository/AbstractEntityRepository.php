<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Repository;

use App\Shared\Domain\Repository\AbstractEntityRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;

abstract class AbstractEntityRepository implements AbstractEntityRepositoryInterface
{
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function flush(): void
    {
        $this->entityManager->flush();
    }

    public function persist($object): void
    {
        $this->entityManager->persist($object);
    }

    public function persistMany(array $objects): void
    {
        foreach ($objects as $object) {
            $this->entityManager->persist($object);
        }
    }

    protected function createQueryBuilder(): QueryBuilder
    {
        return $this->entityManager->createQueryBuilder();
    }
}
