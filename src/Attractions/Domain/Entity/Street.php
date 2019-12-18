<?php

declare(strict_types=1);

namespace App\Attractions\Domain\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 *
 * @ORM\Table("street")
 */
class Street
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
     * @var City
     * @ORM\ManyToOne(targetEntity="City", cascade={"persist"})
     * @ORM\JoinColumn(name="city_id", referencedColumnName="id")
     */
    private $city;

    /**
     * Street constructor.
     */
    public function __construct(
        string $name,
        City $city
    ) {
        $this->name = $name;
        $this->city = $city;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCity(): City
    {
        return $this->city;
    }
}
