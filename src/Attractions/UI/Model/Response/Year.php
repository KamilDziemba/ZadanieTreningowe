<?php

declare(strict_types = 1);
namespace App\Attractions\UI\Model\Response;


class Year
{

    /**
     * @var int
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
    public function getName(): int
    {
        return $this->name;
    }


}