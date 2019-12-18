<?php
declare(strict_types=1);

namespace App\Attractions\Domain\AttractionCreation;

use App\Attractions\Domain\Entity\Year;

class YearFactory
{
    /**
     * @param int $name
     * @return Year
     */
    public function createYear(
        int $name
    ): Year
    {
        return new Year(
            $name
        );
    }
}