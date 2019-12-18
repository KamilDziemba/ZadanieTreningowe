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
     */
    public function __construct(string $name, string $city, string $street, int $year)
    {
        $this->name = $name;
        $this->city = $city;
        $this->street = $street;
        $this->year = $year;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function getYear(): int
    {
        return $this->year;
    }
}
