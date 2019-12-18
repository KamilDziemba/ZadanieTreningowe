<?php

declare(strict_types=1);

namespace App\Attractions\Application\Model;

class ImportData
{
    /**
     * @var int
     */
    private $year;

    /**
     * @var string
     */
    private $street;

    /**
     * @var string
     */
    private $city;

    /**
     * @var string
     */
    private $attraction;

    /**
     * ImportData constructor.
     * @param int $year
     * @param string $street
     * @param string $city
     * @param string $attraction
     */
    public function __construct(int $year, string $street, string $city, string $attraction)
    {
        $this->year = $year;
        $this->street = $street;
        $this->city = $city;
        $this->attraction = $attraction;
    }

    /**
     * @return int
     */
    public function getYear(): int
    {
        return $this->year;
    }

    /**
     * @return string
     */
    public function getStreet(): string
    {
        return $this->street;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function getAttraction(): string
    {
        return $this->attraction;
    }
}
