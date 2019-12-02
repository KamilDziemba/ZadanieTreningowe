<?php

declare(strict_types=1);

namespace App\Attractions\Infrastructure;


use App\Attractions\Application\ImportDataCommand;
use App\Attractions\Application\ImportDataHandler;
use App\Shared\Exception\InvalidArgumentException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;

class ImportExcelFileCommand extends Command
{
    public static $defaultName = 'app:import-excel';

    /**
     * @var string
     */
    private $projectDir;

    /**
     * @var ImportDataHandler
     */
    private $importDataHandler;

    /**
     * ImportExcelFileCommand constructor.
     * @param string $projectDir
     * @param ImportDataHandler $importDataHandler
     */
    public function __construct(
        string $projectDir,
        ImportDataHandler $importDataHandler
    )
    {
        $this->projectDir = $projectDir;
        $this->importDataHandler = $importDataHandler;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Imports excel file.')
            ->setHelp('This command allows you to import excel file.')
            ->addArgument('filePath', InputArgument::REQUIRED);
    }


    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @throws InvalidArgumentException
     * @throws \App\Shared\Exception\InvalidFileContentException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \PHPExcel_Exception
     * @throws \PHPExcel_Reader_Exception
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $filePath = $input->getArgument('filePath');
        $basePath = sprintf('%s/var/imports/%s', $this->projectDir, $filePath);
        $filesystem = new Filesystem();
        if (!$filesystem->exists($basePath)) {
            throw new InvalidArgumentException(sprintf('File does not exist %s', $filePath));
        }

        $importDataCommand = new ImportDataCommand($basePath);
        $this->importDataHandler->handle($importDataCommand);

        return 200;
    }
}