<?php


namespace App\Attractions\UI\Service;


use App\Attractions\Domain\Entity\City as CityEntity;
use App\Attractions\Domain\Entity\Street as StreetEntity;
use App\Attractions\Domain\Entity\Year as YearEntity;
use App\Attractions\Domain\Repository\CityRepositoryInterface;
use App\Attractions\Domain\Repository\StreetRepositoryInterface;
use App\Attractions\Domain\Repository\YearRepositoryInterface;
use App\Attractions\UI\Model\Response\City;
use App\Attractions\UI\Model\Response\Street;
use App\Attractions\UI\Model\Response\Year;

class FilterService
{
    /**
     * @var CityRepositoryInterface
     */
    private $cityRepository;

    /**
     * @var StreetRepositoryInterface
     */
    private $streetRepository;

    /**
     * @var YearRepositoryInterface
     */
    private $yearRepository;

    /**
     * FilterRepository constructor.
     * @param CityRepositoryInterface $cityRepository
     * @param StreetRepositoryInterface $streetRepository
     * @param YearRepositoryInterface $yearRepository
     */
    public function __construct(
        CityRepositoryInterface $cityRepository,
        StreetRepositoryInterface $streetRepository,
        YearRepositoryInterface $yearRepository
    )
    {
        $this->cityRepository = $cityRepository;
        $this->streetRepository = $streetRepository;
        $this->yearRepository = $yearRepository;
    }

    /**
     * @return City[]|null
     */
    public function findAllCitiesDistinct(): array
    {
        $all = ['name' => 'Wszedzie'];
        $cities = $this->cityRepository->findAllDistinct();
        array_unshift($cities, $all);

        return \array_map(static function (array $row) {

            return new City(
                $row['name']
            );
        }, $cities);
    }

    /**
     * @param string $city
     * @return array
     */
    public function findAllStreetsDistinct(string $city): array
    {
        $all = ['name' => 'Wszedzie', 'cityName' => 'Wszedzie'];
        $street = $this->streetRepository->findAllDistinct($city);
        array_unshift($street, $all);

        return $this->mapStreetNamesANdCitiesNames($street);
    }


    /**
     * @return Year[]|null
     */
    public function findAllYearDistinct(): array
    {
        $all = ['name' => 0];
        $year = $this->yearRepository->findAllDistinct();
        array_unshift($year, $all);

        return \array_map(static function (array $row) {
            return new Year(
                $row['name']
            );
        }, $year);
    }

    private function mapStreetNamesANdCitiesNames(array $street){
        $resultArray = [];
        foreach ($street as $value){
            $streetKey = $this->streetExistInArray($value, $resultArray);
            if (!empty($streetKey)){
                /** @var Street $overrideStreet */
                $overrideStreet = $resultArray[$streetKey];
                $newCityName = sprintf('%s,%s', $overrideStreet->getCityName(), $value['cityName']);
                $overrideStreet->setCityName($newCityName);
            }else{
                $resultArray[] = new Street(
                    $value['name'],
                    $value['cityName']
                );
            }
        }
        return $resultArray;
    }

    /**
     * @param $newStreet
     * @param array $array
     * @return int|null
     */
    private function streetExistInArray($newStreet, array $array): ?int
    {
        /** @var Street $street */
        foreach ($array as $key => $street) {
            if ($street->getName() == $newStreet['name']) {
                return $key;
            }
        }
        return null;
    }
}