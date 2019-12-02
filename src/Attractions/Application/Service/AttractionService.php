<?php


namespace App\Attractions\Application\Service;


use App\Attractions\Application\Model\ImportData;
use App\Attractions\Domain\AttractionCreation\AttractionFactory;
use App\Attractions\Domain\AttractionCreation\StreetFactory;
use App\Attractions\Domain\Entity\Attractions;
use App\Attractions\Domain\Entity\City;
use App\Attractions\Domain\Entity\Street;
use App\Attractions\Domain\Entity\Year;
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
     * AttractionService constructor.
     * @param CityRepository $cityRepository
     * @param YearRepository $yearRepository
     * @param StreetRepository $streetRepository
     * @param AttractionRepository $attractionRepository
     * @param AttractionFactory $attractionFactory
     * @param StreetFactory $streetFactory
     */
    public function __construct(
        CityRepository $cityRepository,
        YearRepository $yearRepository,
        StreetRepository $streetRepository,
        AttractionRepository $attractionRepository,
        AttractionFactory $attractionFactory,
        StreetFactory $streetFactory
    )
    {
        $this->cityRepository = $cityRepository;
        $this->yearRepository = $yearRepository;
        $this->streetRepository = $streetRepository;
        $this->attractionRepository = $attractionRepository;
        $this->attractionFactory = $attractionFactory;
        $this->streetFactory = $streetFactory;
    }


    /**
     * @param ImportData $importData
     * @return Attractions
     * @throws InvalidArgumentException
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function prepareAndCreateAttraction(ImportData $importData): Attractions
    {
        $city = $this->cityRepository->findByName($importData->getCity());
        if (empty($city)){
            $city = new City($importData->getCity());
        }

        $street = $this->streetRepository->findByName($importData->getCity());
        if (empty($street)){
            $street = $this->streetFactory->createStreet($importData->getStreet(), $city);
        }
        $year = $this->yearRepository->findByName($importData->getYear());
        if (empty($year)){
            $year = new Year($importData->getYear());
        }
        $createdAttraction = $this->attractionFactory->createAttraction(
            $importData->getAttraction(),
            $city,
            $street,
            $year
        );

        $attraction = $this->attractionRepository->findIfAttractionExist($createdAttraction);
        if (sizeof($attraction) != 0){
            throw new InvalidArgumentException(sprintf('Attraction already exist %s', $importData->getAttraction()));
        }
        return $createdAttraction;
    }
}