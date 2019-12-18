<?php

declare(strict_types=1);

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
     * @var int
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
     *
     * @throws
     */
    public function __construct(
        string $name,
        Year $year,
        City $city,
        Street $street
    ) {
        $this->name = $name;
        $this->year = $year;
        $this->city = $city;
        $this->street = $street;
        $this->createdAt = new \DateTime();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getYear(): Year
    {
        return $this->year;
    }

    public function getCity(): City
    {
        return $this->city;
    }

    public function getStreet(): Street
    {
        return $this->street;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }
}
