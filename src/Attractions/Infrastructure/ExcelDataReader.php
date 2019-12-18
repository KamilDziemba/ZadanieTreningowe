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
     * @param ImportDataMapper $importDataMapper
     */
    public function __construct(ImportDataMapper $importDataMapper)
    {
        $this->importDataMapper = $importDataMapper;
    }

    /**
     * @param string $filePath
     * @return array
     * @throws InvalidFileContentException
     * @throws \PHPExcel_Exception
     * @throws \PHPExcel_Reader_Exception
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

    /**
     * @param array $array
     * @return array
     */
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
