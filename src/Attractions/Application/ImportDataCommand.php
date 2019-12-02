<?php

declare(strict_types = 1);
namespace App\Attractions\Application;


class ImportDataCommand
{
    /**
     * @var string
     */
    private $filePath;

    /**
     * ImportDataCommand constructor.
     * @param string $filePath
     */
    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    /**
     * @return string
     */
    public function getFilePath(): string
    {
        return $this->filePath;
    }
}
