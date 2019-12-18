<?php

declare(strict_types=1);

namespace App\Attractions\Application;

class ImportDataCommand
{
    /**
     * @var string
     */
    private $filePath;

    /**
     * ImportDataCommand constructor.
     */
    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    public function getFilePath(): string
    {
        return $this->filePath;
    }
}
