<?php

declare(strict_types=1);

namespace App\Attractions\Application\ImportDataMapper;


use App\Attractions\Application\Model\ImportData;

class ImportDataMapper
{
    /**
     * @param array $row
     * @return ImportData
     */
    public function createImportData(array $row): ImportData
    {
        $importData = new ImportData(
            (int)$row['Rok'],
            (string)$row['Ulica'],
            (string)$row['Miasto'],
            (string)$row['Nazwa obiektu']
        );

        return $importData;
    }
}