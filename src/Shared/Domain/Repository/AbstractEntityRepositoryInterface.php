<?php

declare(strict_types=1);

namespace App\Shared\Domain\Repository;

interface AbstractEntityRepositoryInterface
{
    public function flush(): void;

    public function persist($object): void;
}
