<?php

declare(strict_types=1);

namespace App\Attractions\Application;

use App\Attractions\Application\Model\ImportData;
use App\Attractions\Application\Service\AttractionService;
use App\Attractions\Infrastructure\ExcelDataReader;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;

class ImportDataHandler
{
    /**
     * @var ExcelDataReader
     */
    private $importDataReader;

    /**
     * @var AttractionService
     */
    private $attractionService;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(
        ExcelDataReader $importDataReader,
        AttractionService $attractionService,
        EntityManagerInterface $entityManager,
        LoggerInterface $logger
    ) {
        $this->importDataReader = $importDataReader;
        $this->attractionService = $attractionService;
        $this->entityManager = $entityManager;
        $this->logger = $logger;
    }

    /**
     * @throws \App\Shared\Exception\InvalidFileContentException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \PHPExcel_Exception
     * @throws \PHPExcel_Reader_Exception
     */
    public function handle(ImportDataCommand $importDataCommand): int
    {
        $recordsCreated = 0;
        $filePath = $importDataCommand->getFilePath();
        $importDataArray = $this->importDataReader->read($filePath);

        /** @var ImportData $importData */
        foreach ($importDataArray as $importData) {
            try {
                $attraction = $this->attractionService->prepareAndCreateAttraction($importData);
                $this->entityManager->persist($attraction);
                ++$recordsCreated;
            } catch (\Exception $exception) {
                $message = sprintf('Attraction creation failed because of %s ', $exception);
                $this->logger->info($message);
            }
        }
        $this->entityManager->flush();

        return $recordsCreated;
    }
}
