<?php


namespace App\Attractions\UI\Model\Response;


class City
{
    /**
     * @var string
     */
    private $name;

    /**
     * City constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }


}