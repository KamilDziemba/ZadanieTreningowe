<?php

declare(strict_types = 1);
namespace App\Attractions\Domain\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity()
 *
 * @ORM\Table("object")
 */
class Attractions
{

    /**
     * @var integer
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @var Year
     * @ORM\ManyToOne(targetEntity="Year", cascade={"persist"})
     * @ORM\JoinColumn(name="year_id", referencedColumnName="id")
     */
    private $year;

    /**
     * @var City
     * @ORM\ManyToOne(targetEntity="City", cascade={"persist"})
     * @ORM\JoinColumn(name="city_id", referencedColumnName="id")
     */
    private $city;

    /**
     * @var Street
     * @ORM\ManyToOne(targetEntity="Street", cascade={"persist"})
     * @ORM\JoinColumn(name="street_id", referencedColumnName="id")
     */
    private $street;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * Attractions constructor.
     * @param string $name
     * @param Year $year
     * @param City $city
     * @param Street $street
     * @throws
     */
    public function __construct(
        string $name,
        Year $year,
        City $city,
        Street $street
    )
    {
        $this->name = $name;
        $this->year = $year;
        $this->city = $city;
        $this->street = $street;
        $this->createdAt = new \DateTime();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return Year
     */
    public function getYear(): Year
    {
        return $this->year;
    }

    /**
     * @return City
     */
    public function getCity(): City
    {
        return $this->city;
    }

    /**
     * @return Street
     */
    public function getStreet(): Street
    {
        return $this->street;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }


}