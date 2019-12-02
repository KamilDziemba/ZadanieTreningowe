<?php

declare(strict_types = 1);
namespace App\Attractions\UI\Model\Response;


class Street
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $cityName;

    /**
     * Street constructor.
     * @param string $name
     * @param string $cityName
     */
    public function __construct(string $name, string $cityName)
    {
        $this->name = $name;
        $this->cityName = $cityName;
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
    public function getCityName(): string
    {
        return $this->cityName;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param string $cityName
     */
    public function setCityName(string $cityName): void
    {
        $this->cityName = $cityName;
    }
}