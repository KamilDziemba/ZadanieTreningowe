<?php

declare(strict_types=1);

namespace App\Attractions\Infrastructure;

use App\Attractions\Application\ImportDataMapper\ImportDataMapper;
use App\Shared\Exception\InvalidFileContentException;

class ExcelDataReader
{
    /**
     * @var ImportDataMapper
     */
    private $importDataMapper;

    /**
     * ExcelDataReader constructor.
     */
    public function __construct(ImportDataMapper $importDataMapper)
    {
        $this->importDataMapper = $importDataMapper;
    }

    /**
     * @throws \PHPExcel_Exception
     * @throws \PHPExcel_Reader_Exception
     * @throws InvalidFileContentException
     */
    public function read(string $filePath): array
    {
        $importDataArray = [];
        $reader = \PHPExcel_IOFactory::createReaderForFile($filePath);

        $file = $reader->load($filePath);
        $sheet = $file->getActiveSheet();
        $array = $sheet->toArray();

        if (empty($array)) {
            throw new InvalidFileContentException('Imported file have invalid values in sheet');
        }

        $importArray = $this->mapKeysWithHeadings($array);
        foreach ($importArray as $row) {
            $importDataArray[] = $this->importDataMapper->createImportData($row);
        }

        return $importDataArray;
    }

    private function mapKeysWithHeadings(array $array): array
    {
        $headings = array_shift($array);
        array_walk(
            $array,
            function (&$row) use ($headings) {
                $row = array_combine($headings, $row);
            }
        );

        return $array;
    }
}
