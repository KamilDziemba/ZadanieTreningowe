<?php

declare(strict_types = 1);
namespace App\Attractions\Domain\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity()
 *
 * @ORM\Table("year")
 */
class Year
{
    /**
     * @var integer
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var integer
     * @ORM\Column(type="integer")
     */
    private $name;

    /**
     * Year constructor.
     * @param int $name
     */
    public function __construct(int $name)
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getName(): int
    {
        return $this->name;
    }


}