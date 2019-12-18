<?php

declare(strict_types=1);

namespace App\Attractions\Application\Service;

use App\Attractions\Application\Model\ImportData;
use App\Attractions\Domain\AttractionCreation\AttractionFactory;
use App\Attractions\Domain\AttractionCreation\CityFactory;
use App\Attractions\Domain\AttractionCreation\StreetFactory;
use App\Attractions\Domain\AttractionCreation\YearFactory;
use App\Attractions\Domain\Entity\Attractions;
use App\Attractions\Infrastructure\Repository\AttractionRepository;
use App\Attractions\Infrastructure\Repository\CityRepository;
use App\Attractions\Infrastructure\Repository\StreetRepository;
use App\Attractions\Infrastructure\Repository\YearRepository;
use App\Shared\Exception\InvalidArgumentException;

class AttractionService
{
    /**
     * @var CityRepository
     */
    private $cityRepository;

    /**
     * @var YearRepository
     */
    private $yearRepository;

    /**
     * @var StreetRepository
     */
    private $streetRepository;

    /**
     * @var AttractionRepository
     */
    private $attractionRepository;

    /**
     * @var AttractionFactory
     */
    private $attractionFactory;

    /**
     * @var StreetFactory
     */
    private $streetFactory;

    /**
     * @var CityFactory
     */
    private $cityFactory;

    /**
     * @var YearFactory
     */
    private $yearFactory;

    /**
     * AttractionService constructor.
     * @param CityRepository $cityRepository
     * @param YearRepository $yearRepository
     * @param StreetRepository $streetRepository
     * @param AttractionRepository $attractionRepository
     * @param AttractionFactory $attractionFactory
     * @param StreetFactory $streetFactory
     * @param CityFactory $cityFactory
     * @param YearFactory $yearFactory
     */
    public function __construct(
        CityRepository $cityRepository,
        YearRepository $yearRepository,
        StreetRepository $streetRepository,
        AttractionRepository $attractionRepository,
        AttractionFactory $attractionFactory,
        StreetFactory $streetFactory,
        CityFactory $cityFactory,
        YearFactory $yearFactory
    )
    {
        $this->cityRepository = $cityRepository;
        $this->yearRepository = $yearRepository;
        $this->streetRepository = $streetRepository;
        $this->attractionRepository = $attractionRepository;
        $this->attractionFactory = $attractionFactory;
        $this->streetFactory = $streetFactory;
        $this->cityFactory = $cityFactory;
        $this->yearFactory = $yearFactory;
    }

    /**
     * @param ImportData $importData
     * @return Attractions
     * @throws InvalidArgumentException
     * @throws \App\Shared\Exception\ResourceNotFoundException
     */
    public function prepareAndCreateAttraction(ImportData $importData): Attractions
    {
        $city = $this->cityRepository->findByName($importData->getCity());
        if (empty($city)) {
            $city = $this->cityFactory->createCity($importData->getCity());
        }

        $street = $this->streetRepository->findByName($importData->getCity());
        if (empty($street)) {
            $street = $this->streetFactory->createStreet($importData->getStreet(), $city);
        }
        $year = $this->yearRepository->findByName($importData->getYear());
        if (empty($year)) {
            $year = $this->yearFactory->createYear($importData->getYear());
        }
        $createdAttraction = $this->attractionFactory->createAttraction(
            $importData->getAttraction(),
            $city,
            $street,
            $year
        );

        $attraction = $this->attractionRepository->findIfAttractionExist($createdAttraction);
        if (0 != sizeof($attraction)) {
            throw new InvalidArgumentException(sprintf('Attraction already exist %s', $importData->getAttraction()));
        }

        return $createdAttraction;
    }
}
