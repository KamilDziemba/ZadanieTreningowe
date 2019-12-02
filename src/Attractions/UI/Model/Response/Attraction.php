<?php


namespace App\Attractions\UI\Model\Response;


class Attraction
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $city;

    /**
     * @var string
     */
    private $street;

    /**
     * @var int
     */
    private $year;

    /**
     * Attraction constructor.
     * @param string $name
     * @param string $city
     * @param string $street
     * @param int $year
     */
    public function __construct(string $name, string $city, string $street, int $year)
    {
        $this->name = $name;
        $this->city = $city;
        $this->street = $street;
        $this->year = $year;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
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
    public function getStreet(): string
    {
        return $this->street;
    }

    /**
     * @return int
     */
    public function getYear(): int
    {
        return $this->year;
    }
}